<?php

namespace App\Classes;

use PDO;

class IssueAuthorize
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function authorize_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.issue_authorize a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.type = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function authorize_insert($data)
  {
    $sql = "INSERT INTO belink.issue_authorize(`login_id`, `type`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function authorize_delete($data)
  {
    $sql = "UPDATE belink.issue_authorize SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function request_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.issue_authorize a";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $column = ["a.id", "a.last", "a.order_number", "a.product_name", "a.title_name", "a.budget"];

    $keyword = (isset($_POST['search']['value']) ? trim($_POST['search']['value']) : "");
    $filter_order = (isset($_POST['order']) ? $_POST['order'] : "");
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : "");
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : "");
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : "");
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : "");
    $draw = (isset($_REQUEST['draw']) ? $_REQUEST['draw'] : "");

    $sql = "SELECT a.id,a.login_id,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.`type`,
    IF(a.`type` = 1,'ผู้อนุมัติ','ผู้จัดการระบบ') type_name,
    IF(a.`type` = 1,'success','danger') type_color
    FROM belink.issue_authorize a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    WHERE a.`status` = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (a.objective LIKE '%{$keyword}%') ";
    }

    if ($filter_order) {
      $sql .= " ORDER BY {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " ORDER BY a.status ASC, a.type ASC, a.created DESC ";
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
      $action = "<a href='javascript:void(0)' class='badge badge-danger font-weight-light btn-delete' id='{$row['id']}'>ลบ</a>";
      $type = "<span class='badge badge-{$row['type_color']} font-weight-light'>{$row['type_name']}</span>";

      if (!empty($row['id'])) {
        $data[] = [
          $action,
          $type,
          $row['username'],
        ];
      }
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
