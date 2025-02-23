<?php

namespace App\Classes;

use PDO;

class Petty
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function petty_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.petty_request a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.doc_date = ?
    AND a.objective = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function petty_last()
  {
    $sql = "SELECT 
      a.last
    FROM belink.petty_request a
    WHERE YEAR(a.created) = YEAR(NOW())
    ORDER BY a.id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (!empty($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function petty_insert($data)
  {
    $sql = "INSERT INTO belink.petty_request(`uuid`, `last`, `login_id`, `doc_date`, `objective`) VALUES(uuid(),?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function petty_view($data)
  {
    $sql = "SELECT a.id,
      a.`uuid`,
      CONCAT('PC',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
      CONCAT(b.firstname,' ',b.lastname) username,
      DATE_FORMAT(a.doc_date,'%d/%m/%Y') `doc_date`,
      a.objective,
      DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.petty_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    WHERE a.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function petty_update($data)
  {
    $sql = "UPDATE belink.petty_request SET
    doc_date = ?,
    objective = ?,
    `action` = 1,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function petty_item_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.petty_item a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.expense_id = ?
    AND a.text = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function petty_item_insert($data)
  {
    $sql = "INSERT INTO belink.petty_item( `request_id`, `expense_id`, `text`, `amount`) VALUES(?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function petty_item_view($data)
  {
    $sql = "SELECT b.id,
    b.text,
    b.amount
    FROM belink.petty_request a
    LEFT JOIN belink.petty_item b
    ON a.id = b.request_id
    WHERE a.`uuid` = ?
    AND b.`status` = 1
    ORDER BY b.id ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function petty_item_total($data)
  {
    $sql = "SELECT SUM(a.amount) total
    FROM belink.petty_item a
    LEFT JOIN belink.petty_request b
    ON a.request_id = b.id
    WHERE b.`uuid` = ?
    AND a.`status` = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function petty_item_update($data)
  {
    $sql = "UPDATE belink.petty_item SET
    `text` = ?,
    `amount` = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function petty_item_delete($data)
  {
    $sql = "UPDATE belink.petty_item SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function petty_file_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.petty_file a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function petty_file_insert($data)
  {
    $sql = "INSERT INTO belink.petty_file(`request_id`, `name`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function petty_file_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.`name`
    FROM belink.petty_file a
    LEFT JOIN belink.petty_request b
    ON a.request_id = b.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function petty_file_delete($data)
  {
    $sql = "UPDATE belink.petty_file SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function petty_approve($data)
  {
    $sql = "UPDATE belink.petty_request SET
    action = ?,
    status = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function petty_remark_insert($data)
  {
    $sql = "INSERT INTO belink.petty_remark(`request_id`, `login_id`, `text`, `status`) VALUES(?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function petty_remark_view($data)
  {
    $sql = "SELECT CONCAT(c.firstname,' ',c.lastname) username,a.text,
    (
    CASE
      WHEN a.`status` = 1 AND b.action = 1 THEN 'ดำเนินการแก้ไขเรียบร้อย'
      WHEN a.`status` = 1 AND b.action = 2 THEN 'ไม่ผ่านอนุมัติ รอผู้ใช้บริการแก้ไข'
      WHEN a.`status` = 2 THEN 'ผ่านการอนุมัติจากผู้อนุมัติ'
    END
    ) status_name,
    (
    CASE
      WHEN a.`status` = 1 AND b.action = 1 THEN 'primary'
      WHEN a.`status` = 1 AND b.action = 2 THEN 'danger'
      WHEN a.`status` = 2 THEN 'success'
    END
    ) status_color,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.petty_remark a
    LEFT JOIN belink.petty_request b
    ON a.request_id = b.id
    LEFT JOIN belink.`user` c
    ON a.login_id = c.login
    WHERE b.`uuid` = ?
    ORDER BY a.created DESC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function request_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.petty_request a WHERE a.status IN (1,2,3)";
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

    $sql = "SELECT a.id,
    a.`uuid`,
    CONCAT('PC',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.objective,
    c.total,
    a.`status`,
      (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'รอผู้อนุมัติดำเนินการ'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'รอผู้ขอใช้บริการแก้ไข'
        WHEN a.`status` = 2 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 3 THEN 'รายการถูกยกเลิก'
      END
      ) status_name,
      (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'primary'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'danger'
        WHEN a.`status` = 2 THEN 'success'
        WHEN a.`status` = 3 THEN 'danger'
      END
      ) status_color,
      (
      CASE
        WHEN a.`status` = 1 THEN 'view'
        ELSE 'complete'
      END
      ) `page`,
      DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.petty_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
      SELECT request_id,SUM(amount) total
      FROM belink.petty_item
      WHERE	`status` = 1
      GROUP BY request_id
    ) c
    ON a.id = c.request_id
    WHERE a.status IN (1,2,3) ";

    if (!empty($keyword)) {
      $sql .= " AND (b.name LIKE '%{$keyword}%' OR a.order_number LIKE '%{$keyword}%' OR a.receiver LIKE '%{$keyword}%') ";
    }

    if ($filter_order) {
      $sql .= " ORDER BY {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " ORDER BY a.status ASC, a.created DESC ";
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
      $action = "<a href='/petty/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        str_replace("\n", "<br>", $row['objective']),
        number_format($row['total'], 2),
        $row['created'],
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

  public function approve_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.petty_request a WHERE a.status = 1";
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

    $sql = "SELECT a.id,
    a.`uuid`,
    CONCAT('PC',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.objective,
    c.total,
    a.`status`,
      (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'รอผู้อนุมัติดำเนินการ'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'รอผู้ขอใช้บริการแก้ไข'
        WHEN a.`status` = 2 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 3 THEN 'รายการถูกยกเลิก'
      END
      ) status_name,
      (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'primary'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'danger'
        WHEN a.`status` = 2 THEN 'success'
        WHEN a.`status` = 3 THEN 'danger'
      END
      ) status_color,
      DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.petty_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
      SELECT request_id,SUM(amount) total
      FROM belink.petty_item
      WHERE	`status` = 1
      GROUP BY request_id
    ) c
    ON a.id = c.request_id
    WHERE a.status = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (b.name LIKE '%{$keyword}%' OR a.order_number LIKE '%{$keyword}%' OR a.receiver LIKE '%{$keyword}%') ";
    }

    if ($filter_order) {
      $sql .= " ORDER BY {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " ORDER BY a.status ASC, a.created DESC ";
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
      $action = "<a href='/petty/approve/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        str_replace("\n", "<br>", $row['objective']),
        number_format($row['total'], 2),
        $row['created'],
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

  public function last_insert_id()
  {
    return $this->dbcon->lastInsertId();
  }
}
