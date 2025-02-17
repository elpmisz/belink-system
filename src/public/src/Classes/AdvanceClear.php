<?php

namespace App\Classes;

use PDO;

class AdvanceClear
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function advance_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.advance_clear_request a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.advance_id = ?
    AND a.amount = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function advance_last()
  {
    $sql = "SELECT 
      a.last
    FROM belink.advance_clear_request a
    WHERE YEAR(a.created) = YEAR(NOW())
    ORDER BY a.id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (!empty($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function advance_insert($data)
  {
    $sql = "INSERT INTO belink.advance_clear_request( `uuid`, `last`, `login_id`, `advance_id`, `amount`) VALUES(uuid(),?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function advance_view($data)
  {
    $sql = "SELECT a.id,
      a.`uuid`,
      CONCAT('AC',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
      CONCAT(b.firstname,' ',b.lastname) username,
      a.advance_id,
      CONCAT('AR',YEAR(d.created),LPAD(d.`last`,4,'0')) advance_ticket,
      a.amount,
      c.usage,
      (a.amount - c.usage) remain,
      DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.advance_clear_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
    SELECT request_id,(SUM(amount) + SUM(vat) - SUM(wt)) `usage`
    FROM belink.advance_clear_item
    WHERE	`status` = 1
    GROUP BY request_id
    ) c
    ON a.id = c.request_id
    LEFT JOIN belink.advance_request d
    ON a.advance_id = d.id
    WHERE a.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function advance_update($data)
  {
    $sql = "UPDATE belink.advance_clear_request SET
    order_number = ?,
    amount = ?,
    objective = ?,
    `action` = 1,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function advance_item_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.advance_clear_item a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.expense_id = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function advance_item_insert($data)
  {
    $sql = "INSERT INTO belink.advance_clear_item(`request_id`, `expense_id`, `text`, `amount`, `vat`, `wt`) VALUES(?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function advance_item_view($data)
  {
    $sql = "SELECT b.id,
    b.expense_id,
    CONCAT('[',c.`code`,'] ',c.`name`) expense_name,
    b.text,
    b.amount,
    b.vat,
    b.wt,
    (b.amount + b.vat - b.wt) total,
    d.amount request
    FROM belink.advance_clear_request a
    LEFT JOIN belink.advance_clear_item b
    ON a.id = b.request_id
    LEFT JOIN belink.expense c
    ON b.expense_id = c.id
    LEFT JOIN belink.advance_item d
    ON a.advance_id = d.request_id
    AND b.expense_id = d.expense_id
    WHERE a.`uuid` = ?
    AND b.`status` = 1
    ORDER BY c.`code` ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function advance_item_total($data)
  {
    $sql = "SELECT SUM(a.amount) amount, 
      SUM(a.vat) vat, 
      SUM(a.wt) wt,
      (SUM(a.amount) + SUM(a.vat) - SUM(a.wt)) total
    FROM belink.advance_clear_item a
    LEFT JOIN belink.advance_clear_request b
    ON a.request_id = b.id
    WHERE b.`uuid` = ?
    AND a.`status` = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function advance_item_update($data)
  {
    $sql = "UPDATE belink.advance_clear_item SET
    `text` = ?,
    `amount` = ?,
    `vat` = ?,
    `wt` = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function advance_item_delete($data)
  {
    $sql = "UPDATE belink.advance_clear_item SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function advance_file_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.advance_clear_file a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function advance_file_insert($data)
  {
    $sql = "INSERT INTO belink.advance_clear_file(`request_id`, `name`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function advance_file_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.`name`
    FROM belink.advance_clear_file a
    LEFT JOIN belink.advance_clear_request b
    ON a.request_id = b.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function advance_file_delete($data)
  {
    $sql = "UPDATE belink.advance_clear_file SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function advance_approve($data)
  {
    $sql = "UPDATE belink.advance_clear_request SET
    action = ?,
    status = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function advance_remark_insert($data)
  {
    $sql = "INSERT INTO belink.advance_clear_remark(`request_id`, `login_id`, `text`, `status`) VALUES(?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function advance_remark_view($data)
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
    FROM belink.advance_clear_remark a
    LEFT JOIN belink.advance_clear_request b
    ON a.request_id = b.id
    LEFT JOIN belink.`user` c
    ON a.login_id = c.login
    WHERE b.`uuid` = ?
    ORDER BY a.created DESC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function advance_select($keyword)
  {
    $sql = "SELECT a.id,
      CONCAT('AR',YEAR(a.created),LPAD(a.`last`,4,'0')) `text`
    FROM belink.advance_request a
    WHERE a.`status` = 2 ";
    if (!empty($keyword)) {
      $sql .= " AND (a.objective LIKE '%{$keyword}%') ";
    }
    $sql .= " ORDER BY  a.last ASC LIMIT 20";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function advance_amount($data)
  {
    $sql = "SELECT SUM(b.amount) total
    FROM belink.advance_clear_request a
    LEFT JOIN belink.advance_item b
    ON b.`status` = 1
    WHERE a.id = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    $row = $stmt->fetch();
    return (isset($row['total']) ? $row['total'] : "");
  }

  public function advance_order($data)
  {
    $sql = "SELECT a.expense_id,CONCAT('[',b.`code`,'] ',b.`name`) expense_name,a.amount
    FROM belink.advance_item a
    LEFT JOIN belink.expense b
    ON a.expense_id = b.id
    WHERE a.request_id = ?
    AND a.`status` = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function request_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.advance_clear_request a WHERE a.status IN (1,2,3)";
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
    CONCAT('AC',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.advance_id,
    CONCAT('AR',YEAR(d.created),LPAD(d.`last`,4,'0')) advance_ticket,
    a.amount,
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
    FROM belink.advance_clear_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
      SELECT request_id,(SUM(amount) + SUM(vat) - SUM(wt)) total
      FROM belink.advance_clear_item
      WHERE	`status` = 1
      GROUP BY request_id
    ) c
    ON a.id = c.request_id
    LEFT JOIN belink.advance_request d
    ON a.advance_id = d.id
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
      $action = "<a href='/advance-clear/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $row['advance_ticket'],
        number_format($row['amount'], 2),
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
    $sql = "SELECT COUNT(*) FROM belink.advance_clear_request a WHERE a.status = 1";
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
    CONCAT('AC',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.advance_id,
    CONCAT('AR',YEAR(d.created),LPAD(d.`last`,4,'0')) advance_ticket,
    a.amount,
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
    FROM belink.advance_clear_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN 
    (
      SELECT request_id,(SUM(amount) + SUM(vat) - SUM(wt)) total
      FROM belink.advance_clear_item
      WHERE	`status` = 1
      GROUP BY request_id
    ) c
    ON a.id = c.request_id
    LEFT JOIN belink.advance_request d
    ON a.advance_id = d.id
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
      $action = "<a href='/advance-clear/approve/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $row['advance_ticket'],
        number_format($row['amount'], 2),
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
