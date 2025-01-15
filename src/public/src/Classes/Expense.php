<?php

namespace App\Classes;

use PDO;

class Expense
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function expense_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.expense a
    WHERE a.status = 1
    AND a.code = ?
    AND a.name = ?
    AND a.type = ?
    AND a.reference = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function expense_insert($data)
  {
    $sql = "INSERT INTO belink.expense(`uuid`, `code`, `name`, `type`, `reference`) VALUES(uuid(),?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function expense_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.uuid,
      a.`code`,
      a.`name`,
      a.`type`,
      a.`reference`,
      b.`name` reference_name,
      a.`status`
    FROM belink.expense a
    LEFT JOIN belink.expense b
    ON a.`reference` = b.id
    WHERE a.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function expense_update($data)
  {
    $sql = "UPDATE belink.expense SET
    code = ?,
    name = ?,
    type = ?,
    reference = ?,
    status = ?,
    login_id = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function expense_select($keyword)
  {
    $sql = "SELECT 
      a.id, 
      CONCAT('[',a.`code`,'] ',a.`name`) `text`
    FROM belink.expense a
    WHERE a.`status` = 1
    AND a.type = 1";
    if (!empty($keyword)) {
      $sql .= " AND (a.code LIKE '%{$keyword}%' OR a.name LIKE '%{$keyword}%') ";
    }
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function request_data($expense)
  {
    $sql = "SELECT COUNT(*) FROM belink.expense a WHERE a.status IN (1,2)";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $column = ["a.id", "a.code", "a.name", "a.reference"];

    $keyword = (isset($_POST['search']['value']) ? trim($_POST['search']['value']) : "");
    $filter_order = (isset($_POST['order']) ? $_POST['order'] : "");
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : "");
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : "");
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : "");
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : "");
    $draw = (isset($_REQUEST['draw']) ? $_REQUEST['draw'] : "");

    $sql = "SELECT 
      a.id,
      a.uuid,
      a.`code`,
      a.`name`,
      a.`reference`,
      b.`name` reference_name,
      IF(a.`status` = 1,'ใช้งาน','ระงับการใช้งาน') status_name,
      IF(a.`status` = 1,'success','danger') status_color
    FROM belink.expense a
    LEFT JOIN belink.expense b
    ON a.`reference` = b.id
    WHERE a.`status` IN (1,2) ";

    if (!empty($expense)) {
      $sql .= " AND (a.id = '{$expense}' OR a.reference = '{$expense}') ";
    }

    if (!empty($keyword)) {
      $sql .= " AND (a.code LIKE '%{$keyword}%' OR a.name LIKE '%{$keyword}%' OR b.name LIKE '%{$keyword}%') ";
    }

    if ($filter_order) {
      $sql .= " ORDER BY {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " ORDER BY a.type ASC, a.status ASC, a.code ASC ";
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
      $action = "<a href='/expense/view/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['code'],
        $row['name'],
        $row['reference_name'],
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
