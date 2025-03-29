<?php

namespace App\Classes;

use PDO;

class Purchase
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function order_view($data)
  {
    $sql = "SELECT a.order_number,
    a.customer_id,
    b.name customer_name,
    a.product_name,
    a.title_name,
    a.sales_name,
    a.budget
    FROM belink.estimate_request a
    LEFT JOIN belink.customer b
    ON a.customer_id = b.id
    WHERE a.order_number = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function purchase_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.purchase_request a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.department_number = ?
    AND a.doc_date = ?
    AND a.po = ?
    AND a.department = ?
    AND a.date = ?
    AND a.order_number = ?
    AND a.reference = ?
    AND a.objective = ?
    AND a.remark = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function purchase_last()
  {
    $sql = "SELECT 
      a.last
    FROM belink.purchase_request a
    WHERE YEAR(a.created) = YEAR(NOW())
    ORDER BY a.id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (!empty($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function purchase_insert($data)
  {
    $sql = "INSERT INTO belink.purchase_request( `uuid`, `last`, `login_id`, `department_number`, `doc_date`, `po`, `department`, `date`, `order_number`, `reference`, `objective`, `remark`) VALUES(uuid(),?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function purchase_view($data)
  {
    $sql = "SELECT a.id,
    a.`uuid`,
    CONCAT('PR-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
    f.username,
    CONCAT(b.firstname,' ',b.lastname) fullname,
    a.department_number,
    a.department,
    DATE_FORMAT(a.doc_date, '%d/%m/%Y') `doc_date`,
    DATE_FORMAT(a.date, '%d/%m/%Y') `date`,
    a.po,
    a.order_number,
    a.reference,
    e.`name` customer_name,
    d.product_name,
    a.objective,
    a.remark,
    c.total,
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.purchase_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
      SELECT request_id,SUM(estimate) total
      FROM belink.purchase_item
      WHERE	`status` = 1
      GROUP BY request_id
    ) c
    ON a.id = c.request_id
    LEFT JOIN belink.estimate_request d
    ON a.order_number = d.order_number
    LEFT JOIN belink.customer e
    ON d.customer_id = e.id
    LEFT JOIN belink.login f
    ON a.login_id = f.id
    WHERE a.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function purchase_update($data)
  {
    $sql = "UPDATE belink.purchase_request SET
    department_number = ?,
    doc_date = ?,
    po = ?,
    department =?,
    `date` = ?,
    order_number = ?,
    reference = ?,
    objective = ?,
    remark = ?,
    `action` = 1,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function purchase_item_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.purchase_item a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.expense_id = ?
    AND a.text = ?
    AND a.amount = ?
    AND a.unit = ?
    AND a.estimate = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function purchase_item_insert($data)
  {
    $sql = "INSERT INTO belink.purchase_item(`request_id`, `expense_id`, `text`, `amount`, `unit`, `estimate`) VALUES(?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function purchase_item_view($data)
  {
    $sql = "SELECT b.id,
    b.expense_id,
    CONCAT('[',c.code,'] ',c.name) expense_name,
    b.`text`,
    b.amount,
    b.unit,
    b.estimate
    FROM belink.purchase_request a
    LEFT JOIN belink.purchase_item b
    ON a.id = b.request_id
    LEFT JOIN belink.expense c
    ON b.expense_id = c.id
    WHERE a.`uuid` = ?
    AND b.`status` = 1
    ORDER BY b.id ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function purchase_item_total($data)
  {
    $sql = "SELECT SUM(b.estimate) total
    FROM belink.purchase_request a
    LEFT JOIN belink.purchase_item b
    ON a.id = b.request_id
    WHERE a.`uuid` = ?
    AND b.`status` = 1
    ORDER BY b.id ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function purchase_item_update($data)
  {
    $sql = "UPDATE belink.purchase_item SET
    `expense_id` = ?,
    `text` = ?,
    `amount` = ?,
    `unit` = ?,
    estimate = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function purchase_item_delete($data)
  {
    $sql = "UPDATE belink.purchase_item SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function purchase_file_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.purchase_file a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function purchase_file_insert($data)
  {
    $sql = "INSERT INTO belink.purchase_file(`request_id`, `name`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function purchase_file_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.`name`
    FROM belink.purchase_file a
    LEFT JOIN belink.purchase_request b
    ON a.request_id = b.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function purchase_file_delete($data)
  {
    $sql = "UPDATE belink.purchase_file SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function purchase_approve($data)
  {
    $sql = "UPDATE belink.purchase_request SET
    action = ?,
    status = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function purchase_remark_insert($data)
  {
    $sql = "INSERT INTO belink.purchase_remark(`request_id`, `login_id`, `text`, `status`) VALUES(?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function purchase_remark_view($data)
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
    FROM belink.purchase_remark a
    LEFT JOIN belink.purchase_request b
    ON a.request_id = b.id
    LEFT JOIN belink.`user` c
    ON a.login_id = c.login
    WHERE b.`uuid` = ?
    ORDER BY a.created DESC";
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

  public function purchase_select($keyword)
  {
    $sql = "SELECT a.department_number `id`,
    a.department_number `text`
    FROM belink.purchase_request a  ";
    if (!empty($keyword)) {
      $sql .= " WHERE (a.department_number LIKE '%{$keyword}%') ";
    }
    $sql .= " GROUP BY a.department_number ORDER BY a.department_number ASC ";
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
      SELECT a.order_number,a.purchase_number,a.expense_id,(a.payment + IFNULL(b.amount, 0) + IFNULL(c.amount,0)) payment
      FROM 
      (
        SELECT IF(a.order_number = '',c.order_number,a.order_number) order_number,a.purchase_number,b.expense_id,
        (SUM(b.amount) + SUM(b.vat) - SUM(b.wt)) payment
        FROM belink.payment_request a
        LEFT JOIN belink.payment_item b
        ON a.id = b.request_id
        LEFT JOIN belink.purchase_request c
        ON a.purchase_number = c.department_number
        WHERE b.status = 1
        GROUP BY a.order_number,a.purchase_number,b.expense_id
      ) a
      LEFT JOIN
      (
        SELECT a.order_number,b.expense_id,SUM(b.amount) amount
        FROM belink.advance_request a
        LEFT JOIN belink.advance_item b
        ON a.id = b.request_id
        WHERE b.`status` = 1
        GROUP BY a.order_number,b.expense_id
      ) b
      ON a.order_number = b.order_number 
      AND a.expense_id = b.expense_id
      LEFT JOIN
      (
        SELECT a.order_number,b.expense_id,SUM(b.estimate) amount
        FROM belink.outstanding_request a
        LEFT JOIN belink.outstanding_item b
        ON a.id = b.request_id
        WHERE b.`status` = 1
        GROUP BY a.order_number,b.expense_id
      ) c
      ON a.order_number = c.order_number
      AND a.expense_id = c.expense_id
    ) d
    ON b.expense_id = d.expense_id
    AND (a.order_number = d.order_number OR a.department_number = d.purchase_number)
    WHERE b.`status` = 1
    AND a.order_number = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function request_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.purchase_request a WHERE a.status IN (1,2,3)";
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
    CONCAT('PR-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.department,
    DATE_FORMAT(a.date, '%d/%m/%Y') `date`,
    a.order_number,
    a.objective,
    c.total,
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
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.purchase_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
      SELECT request_id,SUM(estimate) total
      FROM belink.purchase_item
      WHERE	`status` = 1
      GROUP BY request_id
    ) c
    ON a.id = c.request_id
    WHERE a.status IN (1,2,3) ";

    if (!empty($keyword)) {
      $sql .= " AND (a.department LIKE '%{$keyword}%' OR a.order_number LIKE '%{$keyword}%' OR a.objective LIKE '%{$keyword}%' OR b.firstname LIKE '%{$keyword}%' OR b.lastname LIKE '%{$keyword}%') ";
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
      $action = "<a href='/purchase/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $row['department'],
        $row['order_number'],
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
    $sql = "SELECT COUNT(*) FROM belink.purchase_request a WHERE a.status = 1";
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
    CONCAT('PR-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.department,
    DATE_FORMAT(a.date, '%d/%m/%Y') `date`,
    a.order_number,
    a.objective,
    c.total,
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
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.purchase_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
      SELECT request_id,SUM(estimate) total
      FROM belink.purchase_item
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
      $action = "<a href='/purchase/approve/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $row['department'],
        $row['order_number'],
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
