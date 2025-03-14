<?php

namespace App\Classes;

use PDO;

class Position
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function position_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.position a
    WHERE a.status = 1
    AND a.name_th = ?
    AND a.name_en = ?
    AND a.amount_min = ?
    AND a.amount_max = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function position_insert($data)
  {
    $sql = "INSERT INTO belink.position(`name_th`, `name_en`, `amount_min`, `amount_max`) VALUES(?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function position_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.`name_th`,
      a.name_en,
      a.amount_min,
      a.amount_max,
      a.`status`
    FROM belink.position a
    WHERE a.id = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function position_update($data)
  {
    $sql = "UPDATE belink.position SET
    name_th = ?,
    name_en = ?,
    amount_min = ?,
    amount_max = ?,
    status = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function request_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.position a WHERE a.status IN (1,2)";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $column = ["a.id", "a.name"];

    $keyword = (isset($_POST['search']['value']) ? trim($_POST['search']['value']) : "");
    $filter_order = (isset($_POST['order']) ? $_POST['order'] : "");
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : "");
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : "");
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : "");
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : "");
    $draw = (isset($_REQUEST['draw']) ? $_REQUEST['draw'] : "");

    $sql = "SELECT 
      a.id,
      a.name_th,a.name_en,
      CONCAT('[',a.name_en,'] ',a.name_th) `name`,
      a.amount_min,a.amount_max,
      IF(a.`status` = 1,'ใช้งาน','ระงับการใช้งาน') status_name,
      IF(a.`status` = 1,'success','danger') status_color
    FROM belink.position a
    WHERE a.`status` IN (1,2) ";

    if (!empty($keyword)) {
      $sql .= " AND (a.name_th LIKE '%{$keyword}%' OR a.name_en LIKE '%{$keyword}%') ";
    }

    if ($filter_order) {
      $sql .= " ORDER BY {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " ORDER BY a.status ASC, a.amount_min ";
    }

    $sql2 = "";
    if ($limit_length) {
      $sql2 .= "LIMIT {$limit_start}, {$limit_length}";
    }

    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $filter = $stmt->rowCount();
    $stmt = $this->dbcon->prepare($sql . $sql2);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($result as $row) {
      $action = "<a href='/position/view/{$row['id']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['name'],
        number_format($row['amount_min'],0),
        number_format($row['amount_max'],0),
      ];
    }

    $output = [
      "draw" => $draw,
      "recordsTotal" =>  $total,
      "recordsFiltered" => $filter,
      "data" => $data
    ];
    return $output;
  }
}
