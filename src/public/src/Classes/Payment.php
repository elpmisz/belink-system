<?php

namespace App\Classes;

use PDO;

class Payment
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function payment_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.payment_request a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.department_number = ?
    AND a.doc_date = ?
    AND a.order_number = ?
    AND a.receiver = ?
    AND a.type = ?
    AND a.cheque_bank = ?
    AND a.cheque_branch = ?
    AND a.cheque_number = ?
    AND a.cheque_date = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function payment_last()
  {
    $sql = "SELECT 
      a.last
    FROM belink.payment_request a
    WHERE YEAR(a.created) = YEAR(NOW())
    ORDER BY a.id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (!empty($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function payment_insert($data)
  {
    $sql = "INSERT INTO belink.payment_request(`uuid`, `last`, `login_id`, `department_number`, `doc_date`, `order_number`, `receiver`, `type`, `cheque_bank`, `cheque_branch`, `cheque_number`, `cheque_date`) VALUES(uuid(),?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function payment_view($data)
  {
    $sql = "SELECT a.id,
      CONCAT('PV-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
      a.`uuid`,
      c.`uuid` estimate_uuid,
      CONCAT(b.firstname,' ',b.lastname) username,
      a.department_number,
      a.order_number,
      a.receiver,
      a.`type`,
      IF(a.type = 1,'เงินสด / โอนเข้าบัญชี','เช็ค') type_name,
      a.cheque_bank,
      a.cheque_branch,
      a.cheque_number,
      DATE_FORMAT(a.doc_date, '%d/%m/%Y') doc_date,
      DATE_FORMAT(a.cheque_date, '%d/%m/%Y') cheque_date,
      DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.payment_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN belink.estimate_request c
    ON a.order_number = c.order_number
    WHERE a.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function payment_update($data)
  {
    $sql = "UPDATE belink.payment_request SET
    doc_date = ?,
    receiver = ?,
    cheque_bank = ?,
    cheque_branch = ?,
    cheque_number = ?,
    cheque_date = ?,
    `action` = 1,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function payment_item_total($data)
  {
    $sql = "SELECT SUM(a.amount) amount, 
      SUM(a.vat) vat, 
      SUM(a.wt) wt,
      (SUM(a.amount) + SUM(a.vat) - SUM(a.wt)) total
    FROM belink.payment_item a
    LEFT JOIN belink.payment_request b
    ON a.request_id = b.id
    WHERE b.`uuid` = ?
    AND a.`status` = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function payment_item_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.payment_item a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.expense_id = ?
    AND a.text = ?
    AND a.text2 = ?
    AND a.amount = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function payment_item_insert($data)
  {
    $sql = "INSERT INTO belink.payment_item(`request_id`, `expense_id`, `text`, `text2`, `amount`, `vat`, `wt`) VALUES(?,?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function payment_item_view($data)
  {
    $sql = "SELECT b.id,
      b.expense_id,
      CONCAT('[',c.`code`,'] ',c.`name`) expense_name,
      b.text,
      b.text2,
      b.amount,
      b.vat,
      b.wt,
      (b.amount + b.vat - b.wt) total,
      d.usage,
      d.estimate,
      d.remain
    FROM belink.payment_request a
    LEFT JOIN belink.payment_item b
    ON a.id = b.request_id
    LEFT JOIN belink.expense c
    ON b.expense_id = c.id
    LEFT JOIN 
    (
      SELECT a.order_number,
      b.expense_id,
      b.estimate,
      (SUM(c.amount) + SUM(c.vat) - SUM(c.wt)) `usage`,
      (b.estimate - (SUM(c.amount) + SUM(c.vat) - SUM(c.wt))) remain
      FROM belink.estimate_request a
      LEFT JOIN belink.estimate_item b
      ON a.id = b.request_id
      LEFT JOIN belink.payment_item c
      ON b.expense_id = c.expense_id
      LEFT JOIN belink.payment_request d
      ON c.request_id = d.id
      WHERE a.order_number = d.order_number
      and b.`status` = 1
      AND c.`status` = 1
      GROUP BY a.order_number,b.expense_id
    ) d
    ON a.order_number = d.order_number
    AND b.expense_id = d.expense_id
    WHERE a.`uuid` = ?
    AND b.`status` = 1
    ORDER BY c.reference ASC, c.code ASC, b.id ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function payment_item_update($data)
  {
    $sql = "UPDATE belink.payment_item SET
    `text` = ?,
    `text2` = ?,
    `amount` = ?,
    `vat` = ?,
    `wt` = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function payment_item_delete($data)
  {
    $sql = "UPDATE belink.payment_item SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function payment_file_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.payment_file a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function payment_file_insert($data)
  {
    $sql = "INSERT INTO belink.payment_file(`request_id`, `name`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function payment_file_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.`name`
    FROM belink.payment_file a
    LEFT JOIN belink.payment_request b
    ON a.request_id = b.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function payment_file_delete($data)
  {
    $sql = "UPDATE belink.payment_file SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function payment_approve($data)
  {
    $sql = "UPDATE belink.payment_request SET
    action = ?,
    status = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function payment_remark_insert($data)
  {
    $sql = "INSERT INTO belink.payment_remark(`request_id`, `login_id`, `text`, `status`) VALUES(?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function payment_remark_view($data)
  {
    $sql = "SELECT CONCAT(c.firstname,' ',c.lastname) username,a.text,
    (
    CASE
      WHEN a.`status` = 1 AND b.action = 1 THEN 'ดำเนินการแก้ไขเรียบร้อย'
      WHEN a.`status` = 1 AND b.action = 2 THEN 'ไม่ผ่านอนุมัติ รอผู้ใช้บริการแก้ไข'
      WHEN a.`status` = 2 THEN 'ผ่านการตรวจรับมอบงาน'
      WHEN a.`status` = 3 THEN 'ผ่านการอนุมัติจากฝ่ายบัญชี'
      WHEN a.`status` = 4 THEN 'ผ่านการอนุมัติจากผู้อนุมัติ'
    END
    ) status_name,
    (
    CASE
      WHEN a.`status` = 1 THEN 'danger'
      WHEN a.`status` = 2 THEN 'info'
      WHEN a.`status` = 3 THEN 'primary'
      WHEN a.`status` = 4 THEN 'success'
    END
    ) status_color,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.payment_remark a
    LEFT JOIN belink.payment_request b
    ON a.request_id = b.id
    LEFT JOIN belink.`user` c
    ON a.login_id = c.login
    WHERE b.`uuid` = ?
    ORDER BY a.created DESC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function order_view($data)
  {
    $sql = "SELECT b.expense_id,
      CONCAT('[',c.`code`,'] ',c.`name`) expense_name,
      b.estimate,
      IFNULL(d.payment,0) payment,
      IFNULL((b.estimate - IFNULL(d.payment,0)),0) remain
    FROM belink.estimate_request a
    LEFT JOIN belink.estimate_item b
    ON a.id = b.request_id
    LEFT JOIN belink.expense c
    ON b.expense_id = c.id
    LEFT JOIN 
    (
      SELECT a.order_number,b.expense_id,(SUM(b.amount) + SUM(b.vat) - SUM(b.wt)) payment
      FROM belink.payment_request a
      LEFT JOIN belink.payment_item b
      ON a.id = b.request_id
      WHERE b.status = 1
      GROUP BY a.order_number,b.expense_id
    ) d
    ON a.order_number = d.order_number
    AND b.expense_id = d.expense_id
    WHERE a.order_number = ?
    AND b.expense_id = ?
    AND b.`status` = 1
    ORDER BY c.`reference` ASC, b.id ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function order_select($keyword)
  {
    $sql = "SELECT 
      a.order_number id, 
      a.order_number `text`
    FROM belink.estimate_request a
    WHERE a.`status` NOT IN (5) ";
    if (!empty($keyword)) {
      $sql .= " AND (a.order_number LIKE '%{$keyword}%') ";
    }
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function get_expense($data)
  {
    $sql = "SELECT b.expense_id,
      CONCAT('[',c.`code`,'] ',c.`name`) expense_name,
      b.estimate,
      IFNULL(d.payment,0) payment,
      IFNULL((b.estimate - IFNULL(d.payment,0)),0) remain
    FROM belink.estimate_request a
    LEFT JOIN belink.estimate_item b
    ON a.id = b.request_id
    LEFT JOIN belink.expense c
    ON b.expense_id = c.id
    LEFT JOIN 
    (
      SELECT a.order_number,b.expense_id,(SUM(b.amount) + SUM(b.vat) - SUM(b.wt)) payment
      FROM belink.payment_request a
      LEFT JOIN belink.payment_item b
      ON a.id = b.request_id
      WHERE b.status = 1
      GROUP BY a.order_number,b.expense_id
    ) d
    ON a.order_number = d.order_number
    AND b.expense_id = d.expense_id
    WHERE a.order_number = ?
    AND b.`status` = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function expense_select($keyword, $order)
  {
    $sql = "SELECT a.id,CONCAT('[',a.`code`,'] ',a.`name`) `text`
    FROM belink.expense a
    WHERE a.`status` = 1
    AND a.`type` = 2 ";
    if (!empty($keyword)) {
      $sql .= " AND (a.code LIKE '%{$keyword}%' OR a.name LIKE '%{$keyword}%') ";
    }
    if (!empty($order)) {
      $sql .= " AND b.order_number = '{$order}' ";
    }
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function expense_fix_select($keyword, $order)
  {
    $sql = "SELECT a.expense_id id,
    CONCAT('[',c.`code`,'] ',c.`name`) `text`
    FROM belink.estimate_item a
    LEFT JOIN belink.estimate_request b
    ON a.request_id = b.id
    LEFT JOIN belink.expense c
    ON a.expense_id = c.id
    WHERE a.`status` = 1 ";
    if (!empty($keyword)) {
      $sql .= " AND (c.code LIKE '%{$keyword}%' OR c.name LIKE '%{$keyword}%') ";
    }
    if (!empty($order)) {
      $sql .= " AND b.order_number = '{$order}' ";
    }
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function request_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.payment_request a WHERE a.status IN (1,2,3,4)";
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
    CONCAT('PV-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
    a.order_number,
    a.receiver,
    CONCAT(b.firstname,' ',b.lastname) username,
    c.total,
    a.`status`,
    (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'รอตรวจรับมอบงาน'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'รอผู้ขอใช้บริการแก้ไข'
        WHEN a.`status` = 2 THEN 'รอฝ่ายบัญชีดำเนินการ'
        WHEN a.`status` = 3 THEN 'รอผู้อนุมัติดำเนินการ'
        WHEN a.`status` = 4 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 5 THEN 'รายการถูกยกเลิก'
      END
    ) status_name,
    (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'primary'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'danger'
        WHEN a.`status` = 2 THEN 'info'
        WHEN a.`status` = 3 THEN 'primary'
        WHEN a.`status` = 4 THEN 'success'
        WHEN a.`status` = 5 THEN 'danger'
    END
    ) status_color,
    (
      CASE
        WHEN a.`status` = 1 THEN 'view'
        ELSE 'complete'
      END
    ) `page`,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.payment_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
      SELECT request_id,(SUM(amount) + SUM(vat) - SUM(wt)) total
      FROM belink.payment_item
      WHERE	`status` = 1
      GROUP BY request_id
    ) c
    ON a.id = c.request_id
    WHERE a.status IN (1,2,3,4) ";

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
      $action = "<a href='/payment/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $row['order_number'],
        $row['receiver'],
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

  public function check_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.payment_request a WHERE a.status = 1";
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
    CONCAT('PV-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
    a.order_number,
    a.receiver,
    CONCAT(b.firstname,' ',b.lastname) username,
    c.total,
    a.`status`,
    (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'รอตรวจรับมอบงาน'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'รอผู้ขอใช้บริการแก้ไข'
        WHEN a.`status` = 2 THEN 'รอฝ่ายบัญชีดำเนินการ'
        WHEN a.`status` = 3 THEN 'รอผู้อนุมัติดำเนินการ'
        WHEN a.`status` = 4 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 5 THEN 'รายการถูกยกเลิก'
      END
    ) status_name,
    (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'primary'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'danger'
        WHEN a.`status` = 2 THEN 'info'
        WHEN a.`status` = 3 THEN 'primary'
        WHEN a.`status` = 4 THEN 'success'
        WHEN a.`status` = 5 THEN 'danger'
    END
    ) status_color,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.payment_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
      SELECT request_id,(SUM(amount) + SUM(vat) - SUM(wt)) total
      FROM belink.payment_item
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
      $action = "<a href='/payment/check/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $row['order_number'],
        $row['receiver'],
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

  public function account_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.payment_request a WHERE a.status = 2";
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
    CONCAT('PV-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
    a.order_number,
    a.receiver,
    CONCAT(b.firstname,' ',b.lastname) username,
    c.total,
    a.`status`,
    (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'รอตรวจรับมอบงาน'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'รอผู้ขอใช้บริการแก้ไข'
        WHEN a.`status` = 2 THEN 'รอฝ่ายบัญชีดำเนินการ'
        WHEN a.`status` = 3 THEN 'รอผู้อนุมัติดำเนินการ'
        WHEN a.`status` = 4 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 5 THEN 'รายการถูกยกเลิก'
      END
    ) status_name,
    (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'primary'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'danger'
        WHEN a.`status` = 2 THEN 'info'
        WHEN a.`status` = 3 THEN 'primary'
        WHEN a.`status` = 4 THEN 'success'
        WHEN a.`status` = 5 THEN 'danger'
    END
    ) status_color,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.payment_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
      SELECT request_id,(SUM(amount) + SUM(vat) - SUM(wt)) total
      FROM belink.payment_item
      WHERE	`status` = 1
      GROUP BY request_id
    ) c
    ON a.id = c.request_id
    WHERE a.status = 2 ";

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
      $action = "<a href='/payment/account/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $row['order_number'],
        $row['receiver'],
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
    $sql = "SELECT COUNT(*) FROM belink.payment_request a WHERE a.status = 3";
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
    CONCAT('PV-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
    a.order_number,
    a.receiver,
    CONCAT(b.firstname,' ',b.lastname) username,
    c.total,
    (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'รอตรวจรับมอบงาน'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'รอผู้ขอใช้บริการแก้ไข'
        WHEN a.`status` = 2 THEN 'รอฝ่ายบัญชีดำเนินการ'
        WHEN a.`status` = 3 THEN 'รอผู้อนุมัติดำเนินการ'
        WHEN a.`status` = 4 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 5 THEN 'รายการถูกยกเลิก'
      END
    ) status_name,
    (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'primary'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'danger'
        WHEN a.`status` = 2 THEN 'info'
        WHEN a.`status` = 3 THEN 'primary'
        WHEN a.`status` = 4 THEN 'success'
        WHEN a.`status` = 5 THEN 'danger'
    END
    ) status_color,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.payment_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
      SELECT request_id,(SUM(amount) + SUM(vat) - SUM(wt)) total
      FROM belink.payment_item
      WHERE	`status` = 1
      GROUP BY request_id
    ) c
    ON a.id = c.request_id
    WHERE a.status = 3 ";

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
      $action = "<a href='/payment/approve/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $row['order_number'],
        $row['receiver'],
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
