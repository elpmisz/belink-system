<?php

namespace App\Classes;

use PDO;

class Cash
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function manager_count($data)
  {
    $sql = "SELECT COUNT(*)
    FROM belink.cash_request a
    LEFT JOIN cpl.emp_user b
    ON a.user_id = b.user_id
    WHERE a.`status` = 1
    AND b.approver_1 = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function manager2_count($data)
  {
    $sql = "SELECT COUNT(*)
    FROM belink.cash_request a
    LEFT JOIN cpl.emp_user b
    ON a.user_id = b.user_id
    LEFT JOIN cpl.emp_user c
    ON b.approver_1 = c.user_id
    WHERE a.`status` = 2
    AND c.approver_1 = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }


  public function approve_count()
  {
    $sql = "SELECT COUNT(*)
    FROM belink.cash_request a
    LEFT JOIN cpl.emp_user b
    ON a.user_id = b.user_id
    WHERE a.`status` = 3";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function finance_count()
  {
    $sql = "SELECT COUNT(*)
    FROM belink.cash_request a
    LEFT JOIN cpl.emp_user b
    ON a.user_id = b.user_id
    WHERE a.`status` IN (4,5)";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function request_last()
  {
    $sql = "select last from belink.cash_request where year(created) = year(NOW()) order by id DESC limit 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (isset($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function request_count($data)
  {
    $sql = "SELECT COUNT(*) FROM belink.cash_request WHERE status NOT IN (6,7) AND login_id = ? AND objective = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function request_insert($data)
  {
    $sql = "INSERT INTO belink.cash_request(`uuid`, `last`, `login_id`, `objective`) VALUES(uuid(),?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function request_view($data)
  {
    $sql = "select a.id,a.uuid,concat('C',year(a.created),LPAD(a.last, greatest(LENGTH(a.last),4),'0')) ticket,
    concat(b.firstname,' ',b.lastname) username,a.objective,sum(c.amount) total,
    (
      case
        when a.pay_type = 1 then 'เงินสด'
        when a.pay_type = 2 then 'โอนเงิน'
        when a.pay_type = 3 then 'เช็ค (Cheque)'
        else null
      end
    ) pay_name,a.pay_type,a.cheque,a.payment,
    (
      case
        when a.receive_type = 1 then 'เหลือคืน'
        when a.receive_type = 2 then 'ไม่เหลือคืน'
        when a.receive_type = 3 then 'ใช้เกิน'
        else null
      end
    ) receive_name,a.receive_type,a.receive,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    from belink.cash_request a
    left join belink.user b
    on a.login_id = b.login 
    left join belink.cash_item c 
    on a.id = c.request_id
    where a.uuid = ?
    and c.status = 1
    group by a.id,a.uuid,a.created,a.last,b.firstname,b.lastname,a.objective,a.status";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function request_update($data)
  {
    $sql = "UPDATE belink.cash_request SET 
    objective = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function request_approve($data)
  {
    $sql = "UPDATE belink.cash_request SET 
    status = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function request_pay($data)
  {
    $sql = "UPDATE belink.cash_request SET 
    pay_type = ?,
    cheque = ?,
    payment = ?,
    status = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function request_receive($data)
  {
    $sql = "UPDATE belink.cash_request SET 
    receive_type = ?,
    receive = ?,
    status = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_count($data)
  {
    $sql = "SELECT COUNT(*) FROM belink.cash_item WHERE request_id = ? AND `text` = ? AND amount = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function item_insert($data)
  {
    $sql = "INSERT INTO belink.cash_item(`request_id`, `text`, `amount`) VALUES(?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_view($data)
  {
    $sql = "SELECT a.id,a.text,a.amount
    FROM belink.cash_item a
    LEFT JOIN belink.cash_request b
    ON a.request_id = b.id
    WHERE a.status = 1
    AND b.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function item_update($data)
  {
    $sql = "UPDATE belink.cash_item SET 
    `text` = ?,
    amount = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_delete($data)
  {
    $sql = "UPDATE belink.cash_item SET 
    status = 2,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function remark_insert($data)
  {
    $sql = "INSERT INTO belink.cash_remark(`request_id`, `login_id`, `text`, `status`) VALUES(?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function remark_view($data)
  {
    $sql = "SELECT CONCAT(c.firstname,' ',c.lastname) username,a.text,
    (
      CASE
        WHEN a.status = 1 THEN 'รอผู้จัดการดำเนินการ'
        WHEN a.status = 2 THEN 'ผ่านการอนุมัติจากผู้จัดการ'
        WHEN a.status = 3 THEN 'ผ่านการอนุมัติจากผู้อนุมัติ'
        WHEN a.status = 4 THEN 'ผ่านการอนุมัติจากผู้จัดการการเงิน'
        WHEN a.status = 5 THEN 'จ่ายเงินแล้ว'
        WHEN a.status = 6 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.status = 7 THEN 'รายการถูกยกเลิก'
        ELSE NULL 
      END
    ) status_name,
    (
      CASE
        WHEN a.status = 1 THEN 'danger'
        WHEN a.status = 2 THEN 'success'
        WHEN a.status = 3 THEN 'success'
        WHEN a.status = 4 THEN 'success'
        WHEN a.status = 5 THEN 'info'
        WHEN a.status = 6 THEN 'success'
        WHEN a.status = 7 THEN 'danger'
        ELSE NULL 
      END
    ) status_color,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created 
    FROM belink.cash_remark a
    LEFT JOIN belink.cash_request b
    ON a.request_id = b.id 
    LEFT JOIN belink.user c
    ON a.login_id = c.login 
    WHERE b.uuid = ?
    ORDER BY a.status DESC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function file_insert($data)
  {
    $sql = "INSERT INTO belink.cash_file(`request_id`, `name`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function file_view($data)
  {
    $sql = "SELECT a.id,a.name
    FROM belink.cash_file a
    LEFT JOIN belink.cash_request b
    ON a.request_id = b.id
    WHERE a.status = 1
    AND b.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function file_delete($data)
  {
    $sql = "UPDATE belink.file SET 
    status = 2,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }


  public function request_data($user)
  {
    $sql = "select COUNT(*) from belink.cash_request a where a.login_id = '{$user}'";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $column = ["a.id", "a.last", "b.firstname", "a.objective", "sum(c.amount)", "a.created"];

    $keyword = (isset($_POST['search']['value']) ? trim($_POST['search']['value']) : "");
    $filter_order = (isset($_POST['order']) ? $_POST['order'] : "");
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : "");
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : "");
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : "");
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : "");
    $draw = (isset($_REQUEST['draw']) ? $_REQUEST['draw'] : "");

    $sql = "select a.id,a.uuid,concat('C',year(a.created),LPAD(a.last, greatest(LENGTH(a.last),4),'0')) ticket,
    concat(b.firstname,' ',b.lastname) username,a.objective,sum(c.amount) total,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created,
    (
      CASE
        WHEN a.status = 1 THEN 'รอผู้จัดการดำเนินการ'
        WHEN a.status = 2 THEN 'รออนุมัติดำเนินการ'
        WHEN a.status = 3 THEN 'รอผู้จัดการการเงินดำเนินการ'
        WHEN a.status = 4 THEN 'รอดำเนินการจ่ายเงิน'
        WHEN a.status = 5 THEN 'รอดำเนินการรับคืน'
        WHEN a.status = 6 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.status = 7 THEN 'รายการถูกยกเลิก'
        ELSE NULL 
      END
    ) status_name,
    (
      CASE
        WHEN a.status = 1 THEN 'danger'
        WHEN a.status = 2 THEN 'danger'
        WHEN a.status = 3 THEN 'primary'
        WHEN a.status = 4 THEN 'info'
        WHEN a.status = 5 THEN 'warning'
        WHEN a.status = 6 THEN 'success'
        WHEN a.status = 7 THEN 'danger'
        ELSE NULL 
      END
    ) status_color,
    IF(a.status = 1,'view','complete') `page`
    from belink.cash_request a
    left join belink.user b
    on a.login_id = b.login 
    left join belink.cash_item c 
    on a.id = c.request_id
    where a.login_id = '{$user}'
    and c.status = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (a.objective LIKE '%{$keyword}%') ";
    }

    $sql .= " group by a.id,a.uuid,a.created,a.last,b.firstname,b.lastname,a.objective,a.status ";

    if ($filter_order) {
      $sql .= " order by {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " order by a.status asc, a.created desc ";
    }

    $sql2 = "";
    if ($limit_length) {
      $sql2 .= "limit {$limit_start}, {$limit_length}";
    }

    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $filter = $stmt->rowCount();
    $stmt = $this->dbcon->prepare($sql . $sql2);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($result as $row) {
      $action = "<a href='/cash/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      if (!empty($row['id'])) {
        $data[] = [
          $action,
          $row['ticket'],
          $row['username'],
          str_replace("\n", "<br>", $row['objective']),
          number_format($row['total'], 2),
          $row['created'],
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

  public function manager_data()
  {
    $sql = "select COUNT(*) from belink.cash_request a where a.status = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $column = ["a.id", "a.last", "b.firstname", "a.objective", "sum(c.amount)", "a.created"];

    $keyword = (isset($_POST['search']['value']) ? trim($_POST['search']['value']) : "");
    $filter_order = (isset($_POST['order']) ? $_POST['order'] : "");
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : "");
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : "");
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : "");
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : "");
    $draw = (isset($_REQUEST['draw']) ? $_REQUEST['draw'] : "");

    $sql = "select a.id,a.uuid,concat('C',year(a.created),LPAD(a.last, greatest(LENGTH(a.last),4),'0')) ticket,
    concat(b.firstname,' ',b.lastname) username,a.objective,sum(c.amount) total,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created,
    (
      CASE
        WHEN a.status = 1 THEN 'รอผู้จัดการดำเนินการ'
        WHEN a.status = 2 THEN 'รออนุมัติดำเนินการ'
        WHEN a.status = 3 THEN 'รอผู้จัดการการเงินดำเนินการ'
        WHEN a.status = 4 THEN 'รอดำเนินการจ่ายเงิน'
        WHEN a.status = 5 THEN 'รอดำเนินการรับคืน'
        WHEN a.status = 6 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.status = 7 THEN 'รายการถูกยกเลิก'
        ELSE NULL 
      END
    ) status_name,
    (
      CASE
        WHEN a.status = 1 THEN 'danger'
        WHEN a.status = 2 THEN 'danger'
        WHEN a.status = 3 THEN 'primary'
        WHEN a.status = 4 THEN 'info'
        WHEN a.status = 5 THEN 'warning'
        WHEN a.status = 6 THEN 'success'
        WHEN a.status = 7 THEN 'danger'
        ELSE NULL 
      END
    ) status_color
    from belink.cash_request a
    left join belink.user b
    on a.login_id = b.login 
    left join belink.cash_item c 
    on a.id = c.request_id
    where a.status = 1
    and c.status = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (a.objective LIKE '%{$keyword}%') ";
    }

    $sql .= " group by a.id,a.uuid,a.created,a.last,b.firstname,b.lastname,a.objective,a.status ";

    if ($filter_order) {
      $sql .= " order by {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " order by a.status asc, a.created desc ";
    }

    $sql2 = "";
    if ($limit_length) {
      $sql2 .= "limit {$limit_start}, {$limit_length}";
    }

    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $filter = $stmt->rowCount();
    $stmt = $this->dbcon->prepare($sql . $sql2);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($result as $row) {
      $action = "<a href='/cash/manager/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      if (!empty($row['id'])) {
        $data[] = [
          $action,
          $row['ticket'],
          $row['username'],
          str_replace("\n", "<br>", $row['objective']),
          number_format($row['total'], 2),
          $row['created'],
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

  public function approve_data()
  {
    $sql = "select COUNT(*) from belink.cash_request a where a.status = 2";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $column = ["a.id", "a.last", "b.firstname", "a.objective", "sum(c.amount)", "a.created"];

    $keyword = (isset($_POST['search']['value']) ? trim($_POST['search']['value']) : "");
    $filter_order = (isset($_POST['order']) ? $_POST['order'] : "");
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : "");
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : "");
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : "");
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : "");
    $draw = (isset($_REQUEST['draw']) ? $_REQUEST['draw'] : "");

    $sql = "select a.id,a.uuid,concat('C',year(a.created),LPAD(a.last, greatest(LENGTH(a.last),4),'0')) ticket,
    concat(b.firstname,' ',b.lastname) username,a.objective,sum(c.amount) total,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created,
    (
      CASE
        WHEN a.status = 1 THEN 'รอผู้จัดการดำเนินการ'
        WHEN a.status = 2 THEN 'รออนุมัติดำเนินการ'
        WHEN a.status = 3 THEN 'รอผู้จัดการการเงินดำเนินการ'
        WHEN a.status = 4 THEN 'รอดำเนินการจ่ายเงิน'
        WHEN a.status = 5 THEN 'รอดำเนินการรับคืน'
        WHEN a.status = 6 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.status = 7 THEN 'รายการถูกยกเลิก'
        ELSE NULL 
      END
    ) status_name,
    (
      CASE
        WHEN a.status = 1 THEN 'danger'
        WHEN a.status = 2 THEN 'danger'
        WHEN a.status = 3 THEN 'primary'
        WHEN a.status = 4 THEN 'info'
        WHEN a.status = 5 THEN 'warning'
        WHEN a.status = 6 THEN 'success'
        WHEN a.status = 7 THEN 'danger'
        ELSE NULL 
      END
    ) status_color
    from belink.cash_request a
    left join belink.user b
    on a.login_id = b.login 
    left join belink.cash_item c 
    on a.id = c.request_id
    where a.status = 2
    and c.status = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (a.objective LIKE '%{$keyword}%') ";
    }

    $sql .= " group by a.id,a.uuid,a.created,a.last,b.firstname,b.lastname,a.objective,a.status ";

    if ($filter_order) {
      $sql .= " order by {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " order by a.status asc, a.created desc ";
    }

    $sql2 = "";
    if ($limit_length) {
      $sql2 .= "limit {$limit_start}, {$limit_length}";
    }

    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $filter = $stmt->rowCount();
    $stmt = $this->dbcon->prepare($sql . $sql2);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($result as $row) {
      $action = "<a href='/cash/approve/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      if (!empty($row['id'])) {
        $data[] = [
          $action,
          $row['ticket'],
          $row['username'],
          str_replace("\n", "<br>", $row['objective']),
          number_format($row['total'], 2),
          $row['created'],
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

  public function manager_finance_data()
  {
    $sql = "select COUNT(*) from belink.cash_request a where a.status = 3";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $column = ["a.id", "a.last", "b.firstname", "a.objective", "sum(c.amount)", "a.created"];

    $keyword = (isset($_POST['search']['value']) ? trim($_POST['search']['value']) : "");
    $filter_order = (isset($_POST['order']) ? $_POST['order'] : "");
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : "");
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : "");
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : "");
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : "");
    $draw = (isset($_REQUEST['draw']) ? $_REQUEST['draw'] : "");

    $sql = "select a.id,a.uuid,concat('C',year(a.created),LPAD(a.last, greatest(LENGTH(a.last),4),'0')) ticket,
    concat(b.firstname,' ',b.lastname) username,a.objective,sum(c.amount) total,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created,
    (
      CASE
        WHEN a.status = 1 THEN 'รอผู้จัดการดำเนินการ'
        WHEN a.status = 2 THEN 'รออนุมัติดำเนินการ'
        WHEN a.status = 3 THEN 'รอผู้จัดการการเงินดำเนินการ'
        WHEN a.status = 4 THEN 'รอดำเนินการจ่ายเงิน'
        WHEN a.status = 5 THEN 'รอดำเนินการรับคืน'
        WHEN a.status = 6 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.status = 7 THEN 'รายการถูกยกเลิก'
        ELSE NULL 
      END
    ) status_name,
    (
      CASE
        WHEN a.status = 1 THEN 'danger'
        WHEN a.status = 2 THEN 'danger'
        WHEN a.status = 3 THEN 'primary'
        WHEN a.status = 4 THEN 'info'
        WHEN a.status = 5 THEN 'warning'
        WHEN a.status = 6 THEN 'success'
        WHEN a.status = 7 THEN 'danger'
        ELSE NULL 
      END
    ) status_color
    from belink.cash_request a
    left join belink.user b
    on a.login_id = b.login 
    left join belink.cash_item c 
    on a.id = c.request_id
    where a.status = 3
    and c.status = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (a.objective LIKE '%{$keyword}%') ";
    }

    $sql .= " group by a.id,a.uuid,a.created,a.last,b.firstname,b.lastname,a.objective,a.status ";

    if ($filter_order) {
      $sql .= " order by {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " order by a.status asc, a.created desc ";
    }

    $sql2 = "";
    if ($limit_length) {
      $sql2 .= "limit {$limit_start}, {$limit_length}";
    }

    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $filter = $stmt->rowCount();
    $stmt = $this->dbcon->prepare($sql . $sql2);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($result as $row) {
      $action = "<a href='/cash/finance/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      if (!empty($row['id'])) {
        $data[] = [
          $action,
          $row['ticket'],
          $row['username'],
          str_replace("\n", "<br>", $row['objective']),
          number_format($row['total'], 2),
          $row['created'],
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

  public function finance_data()
  {
    $sql = "select COUNT(*) from belink.cash_request a where a.status IN (4,5)";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $column = ["a.id", "a.last", "b.firstname", "a.objective", "sum(c.amount)", "a.created"];

    $keyword = (isset($_POST['search']['value']) ? trim($_POST['search']['value']) : "");
    $filter_order = (isset($_POST['order']) ? $_POST['order'] : "");
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : "");
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : "");
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : "");
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : "");
    $draw = (isset($_REQUEST['draw']) ? $_REQUEST['draw'] : "");

    $sql = "select a.id,a.uuid,concat('C',year(a.created),LPAD(a.last, greatest(LENGTH(a.last),4),'0')) ticket,
    concat(b.firstname,' ',b.lastname) username,a.objective,sum(c.amount) total,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created,
    (
      CASE
        WHEN a.status = 1 THEN 'รอผู้จัดการดำเนินการ'
        WHEN a.status = 2 THEN 'รออนุมัติดำเนินการ'
        WHEN a.status = 3 THEN 'รอผู้จัดการการเงินดำเนินการ'
        WHEN a.status = 4 THEN 'รอดำเนินการจ่ายเงิน'
        WHEN a.status = 5 THEN 'รอดำเนินการรับคืน'
        WHEN a.status = 6 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.status = 7 THEN 'รายการถูกยกเลิก'
        ELSE NULL 
      END
    ) status_name,
    (
      CASE
        WHEN a.status = 1 THEN 'danger'
        WHEN a.status = 2 THEN 'danger'
        WHEN a.status = 3 THEN 'primary'
        WHEN a.status = 4 THEN 'info'
        WHEN a.status = 5 THEN 'warning'
        WHEN a.status = 6 THEN 'success'
        WHEN a.status = 7 THEN 'danger'
        ELSE NULL 
      END
    ) status_color,
    IF(a.status = 4,'pay','receive') `page`
    from belink.cash_request a
    left join belink.user b
    on a.login_id = b.login 
    left join belink.cash_item c 
    on a.id = c.request_id
    where a.status IN (4,5)
    and c.status = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (a.objective LIKE '%{$keyword}%') ";
    }

    $sql .= " group by a.id,a.uuid,a.created,a.last,b.firstname,b.lastname,a.objective,a.status ";

    if ($filter_order) {
      $sql .= " order by {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " order by a.status asc, a.created desc ";
    }

    $sql2 = "";
    if ($limit_length) {
      $sql2 .= "limit {$limit_start}, {$limit_length}";
    }

    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $filter = $stmt->rowCount();
    $stmt = $this->dbcon->prepare($sql . $sql2);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($result as $row) {
      $action = "<a href='/cash/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      if (!empty($row['id'])) {
        $data[] = [
          $action,
          $row['ticket'],
          $row['username'],
          str_replace("\n", "<br>", $row['objective']),
          number_format($row['total'], 2),
          $row['created'],
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

  public function manage_data()
  {
    $sql = "select COUNT(*) from belink.cash_request a";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $column = ["a.id", "a.last", "b.firstname", "a.objective", "sum(c.amount)", "a.created"];

    $keyword = (isset($_POST['search']['value']) ? trim($_POST['search']['value']) : "");
    $filter_order = (isset($_POST['order']) ? $_POST['order'] : "");
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : "");
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : "");
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : "");
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : "");
    $draw = (isset($_REQUEST['draw']) ? $_REQUEST['draw'] : "");

    $sql = "select a.id,a.uuid,concat('C',year(a.created),LPAD(a.last, greatest(LENGTH(a.last),4),'0')) ticket,
    concat(b.firstname,' ',b.lastname) username,a.objective,sum(c.amount) total,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created,
    (
      CASE
        WHEN a.status = 1 THEN 'รอผู้จัดการดำเนินการ'
        WHEN a.status = 2 THEN 'รออนุมัติดำเนินการ'
        WHEN a.status = 3 THEN 'รอผู้จัดการการเงินดำเนินการ'
        WHEN a.status = 4 THEN 'รอดำเนินการจ่ายเงิน'
        WHEN a.status = 5 THEN 'รอดำเนินการรับคืน'
        WHEN a.status = 6 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.status = 7 THEN 'รายการถูกยกเลิก'
        ELSE NULL 
      END
    ) status_name,
    (
      CASE
        WHEN a.status = 1 THEN 'danger'
        WHEN a.status = 2 THEN 'danger'
        WHEN a.status = 3 THEN 'primary'
        WHEN a.status = 4 THEN 'info'
        WHEN a.status = 5 THEN 'warning'
        WHEN a.status = 6 THEN 'success'
        WHEN a.status = 7 THEN 'danger'
        ELSE NULL 
      END
    ) status_color
    from belink.cash_request a
    left join belink.user b
    on a.login_id = b.login 
    left join belink.cash_item c 
    on a.id = c.request_id
    where c.status = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (a.objective LIKE '%{$keyword}%') ";
    }

    $sql .= " group by a.id,a.uuid,a.created,a.last,b.firstname,b.lastname,a.objective,a.status ";

    if ($filter_order) {
      $sql .= " order by {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " order by a.status asc, a.created desc ";
    }

    $sql2 = "";
    if ($limit_length) {
      $sql2 .= "limit {$limit_start}, {$limit_length}";
    }

    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $filter = $stmt->rowCount();
    $stmt = $this->dbcon->prepare($sql . $sql2);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($result as $row) {
      $action = "<a href='/cash/edit/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      if (!empty($row['id'])) {
        $data[] = [
          $action,
          $row['ticket'],
          $row['username'],
          str_replace("\n", "<br>", $row['objective']),
          number_format($row['total'], 2),
          $row['created'],
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

  public function last_insert_id()
  {
    return $this->dbcon->lastInsertId();
  }
}
