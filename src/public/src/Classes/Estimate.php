<?php

namespace App\Classes;

use PDO;

class Estimate
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function estimate_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.estimate_request a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.customer_id = ?
    AND a.order_number = ?
    AND a.product_name = ?
    AND a.title_name = ?
    AND a.sales_name = ?
    AND a.budget = ?
    AND a.type = ?
    AND a.remark = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function estimate_last()
  {
    $sql = "SELECT 
      a.last
    FROM belink.estimate_request a
    WHERE YEAR(a.created) = YEAR(NOW())
    ORDER BY a.id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (!empty($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function estimate_insert($data)
  {
    $sql = "INSERT INTO belink.estimate_request(`uuid`, `last`, `login_id`, `customer_id`, `order_number`, `product_name`, `title_name`, `sales_name`, `budget`, `type`, `remark`) VALUES(uuid(),?,?,?,?,?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function estimate_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.`uuid`,
      CONCAT('EB',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
      a.login_id,
      CONCAT(c.firstname,' ',c.lastname) username,
      a.customer_id,
      b.`name` customer_name,
      a.order_number,
      a.product_name,
      a.title_name,
      a.sales_name,
      a.budget,
      a.`type`,
      (
      CASE
        WHEN a.`type` = 1 THEN 'Event'
        WHEN a.`type` = 2 THEN 'Online'
        WHEN a.`type` = 3 THEN 'รับจ้างผลิต'
        WHEN a.`type` = 4 THEN 'อื่นๆ'
      END
      ) type_name,
      a.remark,
      DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.estimate_request a
    LEFT JOIN belink.customer b
    ON a.customer_id = b.id
    LEFT JOIN belink.user c
    ON a.login_id = c.login
    WHERE a.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function estimate_update($data)
  {
    $sql = "UPDATE belink.estimate_request SET
    customer_id = ?,
    order_number = ?,
    product_name = ?,
    title_name = ?,
    sales_name = ?,
    budget = ?,
    type = ?,
    remark = ?,
    action = 1,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function estimate_approve($data)
  {
    $sql = "UPDATE belink.estimate_request SET
    action = ?,
    status = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function estimate_item_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.estimate_item a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.expense_id = ?
    AND a.estimate = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function estimate_item_insert($data)
  {
    $sql = "INSERT INTO belink.estimate_item(`request_id`, `expense_id`, `estimate`) VALUES(?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function estimate_item_view($data, $reference = null)
  {
    $sql = "SELECT 
      a.id,
      CONCAT('[',c.`code`,'] ',c.`name`) expense_name,
      a.estimate
    FROM belink.estimate_item a
    LEFT JOIN belink.estimate_request b
    ON a.request_id = b.id
    LEFT JOIN belink.expense c
    ON a.expense_id = c.id
    WHERE a.`status` = 1
    AND b.`uuid` = ? ";
    if (!empty($reference)) {
      $sql .= " AND c.reference = '{$reference}' ";
    }
    $sql .= " ORDER BY c.reference ASC, a.id ASC ";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function estimate_item_reference($data)
  {
    $sql = "SELECT 
      c.`reference`,
      d.`name` reference_name
    FROM belink.estimate_item a
    LEFT JOIN belink.estimate_request b
    ON a.request_id = b.id
    LEFT JOIN belink.expense c
    ON a.expense_id = c.id
    LEFT JOIN belink.expense d
    ON c.`reference` = d.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?
    GROUP BY c.`reference` 
    ORDER BY c.`reference` ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function estimate_item_update($data)
  {
    $sql = "UPDATE belink.estimate_item SET
    estimate = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }


  public function estimate_item_delete($data)
  {
    $sql = "UPDATE belink.estimate_item SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function estimate_file_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.estimate_file a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function estimate_file_insert($data)
  {
    $sql = "INSERT INTO belink.estimate_file(`request_id`, `name`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function estimate_file_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.`name`
    FROM belink.estimate_file a
    LEFT JOIN belink.estimate_request b
    ON a.request_id = b.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function estimate_file_delete($data)
  {
    $sql = "UPDATE belink.estimate_file SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function estimate_remark_insert($data)
  {
    $sql = "INSERT INTO belink.estimate_remark(`request_id`, `login_id`, `text`, `status`) VALUES(?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function estimate_remark_view($data)
  {
    $sql = "SELECT CONCAT(c.firstname,' ',c.lastname) username,a.text,
    (
    CASE
      WHEN a.`status` = 1 AND b.action = 1 THEN 'ไม่ผ่านอนุมัติ รอผู้ใช้บริการแก้ไข'
      WHEN a.`status` = 2 THEN 'ผ่านการอนุมัติจากฝ่ายขาย'
      WHEN a.`status` = 3 THEN 'ผ่านการอนุมัติจากฝ่ายงบประมาณ'
      WHEN a.`status` = 4 THEN 'ผ่านการอนุมัติจากฝ่ายการเงิน'
    END
    ) status_name,
    (
    CASE
      WHEN a.`status` = 1 THEN 'danger'
      WHEN a.`status` = 2 THEN 'primary'
      WHEN a.`status` = 3 THEN 'info'
      WHEN a.`status` = 4 THEN 'warning'
    END
    ) status_color,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.estimate_remark a
    LEFT JOIN belink.estimate_request b
    ON a.request_id = b.id
    LEFT JOIN belink.`user` c
    ON a.login_id = c.login
    WHERE b.`uuid` = ?
    ORDER BY a.created DESC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function customer_select($keyword)
  {
    $sql = "SELECT 
      a.id, 
      CONCAT('[',a.`code`,'] ',a.`name`) `text`
    FROM belink.customer a
    WHERE a.`status` = 1 ";
    if (!empty($keyword)) {
      $sql .= " AND (a.code LIKE '%{$keyword}%' OR a.name LIKE '%{$keyword}%') ";
    }
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function expense_select($keyword)
  {
    $sql = "SELECT a.id,
      CONCAT('[',a.`code`,'] ',a.`name`) `text`
    FROM belink.expense a
    WHERE a.`status` = 1
    AND a.type = 2 ";
    if (!empty($keyword)) {
      $sql .= " AND (a.code LIKE '%{$keyword}%' OR a.name LIKE '%{$keyword}%') ";
    }
    $sql .= " ORDER BY a.code ASC ";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function request_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.estimate_request a WHERE a.status IN (1,2,3,4,5)";
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

    $sql = "SELECT 
      a.id,
      a.`uuid`,
      CONCAT('EB',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
      a.login_id,
      CONCAT(c.firstname,' ',c.lastname) username,
      a.customer_id,
      b.`name` customer_name,
      a.order_number,
      a.product_name,
      a.title_name,
      a.sales_name,
      a.budget,
      a.`type`,
      (
      CASE
        WHEN a.`type` = 1 THEN 'Event'
        WHEN a.`type` = 2 THEN 'Online'
        WHEN a.`type` = 3 THEN 'รับจ้างผลิต'
        WHEN a.`type` = 4 THEN 'อื่นๆ'
      END
      ) type_name,
      a.remark,
      a.`status`,
      (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'รอฝ่ายขายดำเนินการ'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'รอผู้ขอใช้บริการแก้ไข'
        WHEN a.`status` = 2 THEN 'รอฝ่ายงบประมาณดำเนินการ'
        WHEN a.`status` = 3 THEN 'รอฝ่ายการเงินดำเนินการ'
        WHEN a.`status` = 4 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 5 THEN 'รายการถูกยกเลิก'
      END
      ) status_name,
      (
      CASE
        WHEN a.`status` = 1 AND a.action = 1 THEN 'primary'
        WHEN a.`status` = 1 AND a.action = 2 THEN 'danger'
        WHEN a.`status` = 2 THEN 'info'
        WHEN a.`status` = 3 THEN 'warning'
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
    FROM belink.estimate_request a
    LEFT JOIN belink.customer b
    ON a.customer_id = b.id
    LEFT JOIN belink.user c
    ON a.login_id = c.login
    WHERE a.`status` IN (1,2,3,4,5) ";

    if (!empty($keyword)) {
      $sql .= " AND (b.name LIKE '%{$keyword}%' OR a.order_number LIKE '%{$keyword}%' OR a.product_name LIKE '%{$keyword}%' OR a.title_name LIKE '%{$keyword}%' OR a.sales_name LIKE '%{$keyword}%') ";
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
      $action = "<a href='/estimate/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['order_number'],
        $row['product_name'],
        $row['title_name'],
        number_format($row['budget'], 2),
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

  public function approve_data($status)
  {
    $sql = "SELECT COUNT(*) FROM belink.estimate_request a WHERE a.status IN (1,2,3,4,5)";
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

    $sql = "SELECT 
      a.id,
      a.`uuid`,
      CONCAT('EB',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
      a.login_id,
      CONCAT(c.firstname,' ',c.lastname) username,
      a.customer_id,
      b.`name` customer_name,
      a.order_number,
      a.product_name,
      a.title_name,
      a.sales_name,
      a.budget,
      a.`type`,
      (
      CASE
        WHEN a.`type` = 1 THEN 'Event'
        WHEN a.`type` = 2 THEN 'Online'
        WHEN a.`type` = 3 THEN 'รับจ้างผลิต'
        WHEN a.`type` = 4 THEN 'อื่นๆ'
      END
      ) type_name,
      a.remark,
      a.`status`,
      (
      CASE
        WHEN a.`status` = 1 THEN 'รอฝ่ายขายดำเนินการ'
        WHEN a.`status` = 2 THEN 'รอฝ่ายงบประมาณดำเนินการ'
        WHEN a.`status` = 3 THEN 'รอฝ่ายการเงินดำเนินการ'
        WHEN a.`status` = 4 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 5 THEN 'รายการถูกยกเลิก'
      END
      ) status_name,
      (
      CASE
        WHEN a.`status` = 1 THEN 'primary'
        WHEN a.`status` = 2 THEN 'info'
        WHEN a.`status` = 3 THEN 'warning'
        WHEN a.`status` = 4 THEN 'success'
        WHEN a.`status` = 5 THEN 'danger'
      END
      ) status_color,
      (
      CASE
        WHEN a.`status` = 1 THEN 'approve-sale'
        WHEN a.`status` = 2 THEN 'approve-budget'
        WHEN a.`status` = 3 THEN 'approve-finance'
      END
      ) `page`,
      DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.estimate_request a
    LEFT JOIN belink.customer b
    ON a.customer_id = b.id
    LEFT JOIN belink.user c
    ON a.login_id = c.login
    WHERE a.`status` = '{$status}'
    AND a.action = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (b.name LIKE '%{$keyword}%' OR a.order_number LIKE '%{$keyword}%' OR a.product_name LIKE '%{$keyword}%' OR a.title_name LIKE '%{$keyword}%' OR a.sales_name LIKE '%{$keyword}%') ";
    }

    if ($filter_order) {
      $sql .= " ORDER BY {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " ORDER BY a.status ASC, a.created ASC ";
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
      $action = "<a href='/estimate/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['order_number'],
        $row['product_name'],
        $row['title_name'],
        number_format($row['budget'], 2),
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
