<?php

namespace App\Classes;

use PDO;

class Outstanding
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function get_item_view($data)
  {
    $sql = "SELECT *
    FROM 
    (
      SELECT b.name,b.amount,b.unit,b.estimate,a.order_number
      FROM belink.purchase_request a
      LEFT JOIN belink.purchase_item b
      ON a.id = b.request_id
      WHERE b.`status` = 1
      UNION 
      SELECT CONCAT('[',c.`name`,'] ',b.text,' ',b.text2) `name`, 1 amount,'' unit,(b.amount + b.vat - b.wt) total,a.order_number
      FROM belink.payment_request a
      LEFT JOIN belink.payment_item b
      ON a.id = b.request_id
      LEFT JOIN belink.expense c
      ON b.expense_id = c.id
      WHERE b.`status` = 1
    ) d
    WHERE d.order_number = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function item_view($data)
  {
    $sql = "SELECT *
    FROM 
    (
      SELECT b.name,b.amount,b.unit,b.estimate,a.order_number
      FROM belink.purchase_request a
      LEFT JOIN belink.purchase_item b
      ON a.id = b.request_id
      WHERE b.`status` = 1
      UNION 
      SELECT CONCAT('[',c.`name`,'] ',b.text,' ',b.text2) `name`, 1 amount,'' unit,(b.amount + b.vat - b.wt) total,a.order_number
      FROM belink.payment_request a
      LEFT JOIN belink.payment_item b
      ON a.id = b.request_id
      LEFT JOIN belink.expense c
      ON b.expense_id = c.id
      WHERE b.`status` = 1
    ) d
    WHERE d.order_number = ?
    AND d.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function item_select($keyword, $data)
  {
    $sql = "SELECT d.name `id`, d.name `text`
    FROM 
    (
      SELECT b.name,b.amount,b.unit,b.estimate,a.order_number
      FROM belink.purchase_request a
      LEFT JOIN belink.purchase_item b
      ON a.id = b.request_id
      WHERE b.`status` = 1
      UNION 
      SELECT CONCAT('[',c.`name`,'] ',b.text,' ',b.text2) `name`, 1 amount,'' unit,(b.amount + b.vat - b.wt) total,a.order_number
      FROM belink.payment_request a
      LEFT JOIN belink.payment_item b
      ON a.id = b.request_id
      LEFT JOIN belink.expense c
      ON b.expense_id = c.id
      WHERE b.`status` = 1
    ) d
    WHERE d.order_number = ?";
    if (!empty($keyword)) {
      $sql .= " AND (d.name LIKE '%{$keyword}%') ";
    }
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function outstanding_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.outstanding_request a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.department_number = ?
    AND a.doc_date = ?
    AND a.order_number = ?
    AND a.text = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function outstanding_last()
  {
    $sql = "SELECT 
      a.last
    FROM belink.outstanding_request a
    WHERE YEAR(a.created) = YEAR(NOW())
    ORDER BY a.id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (!empty($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function outstanding_insert($data)
  {
    $sql = "INSERT INTO belink.outstanding_request
    (`uuid`, `last`, `login_id`, `department_number`, `doc_date`, `order_number`, `text`)
    VALUES (uuid(), ?, ?, ?, ?, ?, ?)";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
  }

  public function outstanding_view($data)
  {
    $sql = "SELECT a.id,
      a.`uuid`,
      CONCAT('OI-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
      CONCAT(b.firstname,' ',b.lastname) username,
      a.department_number,
      a.order_number,
      DATE_FORMAT(a.doc_date,'%d/%m/%Y') `doc_date`,
      a.text,
      DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.outstanding_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    WHERE a.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function outstanding_update($data)
  {
    $sql = "UPDATE belink.outstanding_request SET
    `department_number` = ?,
    `doc_date` = ?,
    `text` = ?,
    `updated` = NOW()
    WHERE `uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function outstanding_item_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.outstanding_item a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.name = ?
    AND a.amount = ?
    AND a.unit = ?
    AND a.estimate = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function outstanding_item_total($data)
  {
    $sql = "SELECT SUM(b.estimate) total
    FROM belink.outstanding_request a
    LEFT JOIN belink.outstanding_item b
    ON a.id = b.request_id
    WHERE a.`uuid` = ?
    AND b.`status` = 1
    ORDER BY b.id ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function outstanding_item_insert($data)
  {
    $sql = "INSERT INTO belink.outstanding_item
    (`request_id`, `name`, `amount`, `unit`, `estimate`)
    VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
  }

  public function outstanding_item_view($data)
  {
    $sql = "SELECT b.id,
    b.name,
    b.amount,
    b.unit,
    b.estimate
    FROM belink.outstanding_request a
    LEFT JOIN belink.outstanding_item b
    ON a.id = b.request_id
    WHERE a.`uuid` = ?
    AND b.`status` = 1
    ORDER BY b.id ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function outstanding_item_update($data)
  {
    $sql = "UPDATE belink.outstanding_item SET
    `unit` = ?,
    `estimate` = ?,
    `updated` = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function outstanding_item_delete($data)
  {
    $sql = "UPDATE belink.outstanding_item SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function outstanding_file_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.outstanding_file a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function outstanding_file_insert($data)
  {
    $sql = "INSERT INTO belink.outstanding_file
    (`request_id`, `name`) 
    VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function outstanding_file_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.`name`
    FROM belink.outstanding_file a
    LEFT JOIN belink.outstanding_request b
    ON a.request_id = b.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function outstanding_file_delete($data)
  {
    $sql = "UPDATE belink.outstanding_file SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function outstanding_approve($data)
  {
    $sql = "UPDATE belink.outstanding_request SET
    action = ?,
    status = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function outstanding_remark_insert($data)
  {
    $sql = "INSERT INTO belink.outstanding_remark(`request_id`, `login_id`, `text`, `status`) VALUES(?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function outstanding_remark_view($data)
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
    FROM belink.outstanding_remark a
    LEFT JOIN belink.outstanding_request b
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
    CONCAT('OI-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.department_number,
    a.order_number,
    a.text,
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
    FROM belink.outstanding_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
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
      $action = "<a href='/outstanding/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['department_number'],
        $row['order_number'],
        $row['username'],
        str_replace("\n", "<br>", $row['text']),
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
    CONCAT('OI-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.department_number,
    a.order_number,
    a.text,
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
    FROM belink.outstanding_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
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
      $action = "<a href='/outstanding/approve/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['department_number'],
        $row['order_number'],
        $row['username'],
        str_replace("\n", "<br>", $row['text']),
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
