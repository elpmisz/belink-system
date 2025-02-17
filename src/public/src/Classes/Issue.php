<?php

namespace App\Classes;

use PDO;

class Issue
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function issue_authorize($data)
  {
    $sql = "SELECT a.`type`
    FROM belink.issue_authorize a
    WHERE a.`status` = 1
    AND login_id = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $row = $stmt->fetchColumn();
  }

  public function issue_last()
  {
    $sql = "SELECT 
      a.last
    FROM belink.issue_request a
    WHERE YEAR(a.created) = YEAR(NOW())
    ORDER BY a.id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (!empty($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function issue_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.issue_request a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.type = ?
    AND a.date = ?
    AND a.text = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function issue_insert($data)
  {
    $sql = "INSERT INTO belink.issue_request(`uuid`, `last`, `login_id`, `type`, `date`, `event_date`, `event_start`, `event_end`, `event_name`, `sale`, `location_start`, `location_end`, `outcome`, `text`) VALUES(uuid(),?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function issue_view($data)
  {
    $sql = "SELECT a.id,
    a.`uuid`,
    CONCAT('IS',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.type,IF(a.type = 1,'นำเข้า','เบิกออก') type_name,
    DATE_FORMAT(a.date,'%d/%m/%Y') `date`,
    a.outcome,
    CONCAT('[',CONCAT('IS',YEAR(c.created),LPAD(c.`last`,4,'0')),'] ',c.text) outcome_name,
    a.event_date,
    a.event_name,
    a.sale,
    a.location_start,
    a.location_end,
    a.text,
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.issue_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN belink.issue_request c
    ON a.outcome = c.id
    WHERE a.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function issue_update($data)
  {
    $sql = "UPDATE belink.issue_request SET
    `date` = ?,
    event_date = ?,
    event_start = ?,
    event_end = ?,
    event_name = ?,
    sale = ?,
    location_start = ?,
    location_end = ?,
    outcome = ?,
    `text` = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.issue_item a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.product_id = ?
    AND a.warehouse_id = ?
    AND a.type = ?
    AND a.amount = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function item_insert($data)
  {
    $sql = "INSERT INTO belink.issue_item(`request_id`, `product_id`, `warehouse_id`, `type`, `amount`) VALUES(?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_view($data)
  {
    $sql = "SELECT a.id,
    c.uuid,
    a.product_id,c.`name` product_name,
    a.warehouse_id,d.`name` warehouse_name,
    c.location_id,f.`name` location_name,
    a.amount,
    a.confirm,
    (e.income - e.outcome) remain
    FROM belink.issue_item a
    LEFT JOIN belink.issue_request b
    ON a.request_id = b.id
    LEFT JOIN belink.product c
    ON a.product_id = c.id
    LEFT JOIN belink.product_warehouse d
    ON a.warehouse_id = d.id
    LEFT JOIN 
    (
      SELECT b.product_id,b.warehouse_id,
      SUM(IF(b.`type` = 1,b.confirm,0)) income,
      SUM(IF(b.`type` = 2,b.confirm,0)) outcome
      FROM belink.issue_request a
      LEFT JOIN belink.issue_item b
      ON a.id = b.request_id
      WHERE a.`status` = 2
      AND b.`status` = 1
      GROUP BY b.product_id,b.warehouse_id
    ) e
    ON a.product_id = e.product_id
    AND a.warehouse_id = e.warehouse_id 
    LEFT JOIN belink.product_location f
    ON c.location_id = f.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?
    ORDER BY a.id ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function item_update($data)
  {
    $sql = "UPDATE belink.issue_item SET
    amount = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_confirm($data)
  {
    $sql = "UPDATE belink.issue_item SET
    confirm = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_delete($data)
  {
    $sql = "UPDATE belink.issue_item SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function product_remain($data)
  {
    $sql = "SELECT a.id,
    a.`name` product_name,
    c.`name` location_name,
    IFNULL((b.income - b.outcome),0) remain
    FROM belink.product a
    LEFT JOIN 
    (
      SELECT b.product_id,b.warehouse_id,
      SUM(IF(b.`type` = 1,b.confirm,0)) income,
      SUM(IF(b.`type` = 2,b.confirm,0)) outcome
      FROM belink.issue_request a
      LEFT JOIN belink.issue_item b
      ON a.id = b.request_id
      WHERE a.`status` IN (1,2)
      AND b.`status` = 1
      AND b.warehouse_id = ?
      GROUP BY b.product_id,b.warehouse_id
    ) b
    ON a.id = b.product_id
    LEFT JOIN belink.product_location c
    ON a.location_id = c.id
    WHERE a.id = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function file_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.issue_file a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function file_insert($data)
  {
    $sql = "INSERT INTO belink.issue_file(`request_id`, `name`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function file_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.`name`
    FROM belink.issue_file a
    LEFT JOIN belink.issue_request b
    ON a.request_id = b.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function file_delete($data)
  {
    $sql = "UPDATE belink.issue_file SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function issue_approve($data)
  {
    $sql = "UPDATE belink.issue_request SET
    status = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function remark_insert($data)
  {
    $sql = "INSERT INTO belink.issue_remark(`request_id`, `login_id`, `text`, `status`) VALUES(?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function remark_view($data)
  {
    $sql = "SELECT CONCAT(c.firstname,' ',c.lastname) username,
    a.text,
    (
    CASE
      WHEN a.`status` = 2 THEN 'ผ่านการตรวจสอบ'
      WHEN a.`status` = 3 THEN 'รายการถูกยกเลิก'
    END
    ) status_name,
    (
    CASE
      WHEN a.`status` = 2 THEN 'success'
      WHEN a.`status` = 3 THEN 'danger'
    END
    ) status_color,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.issue_remark a
    LEFT JOIN belink.issue_request b
    ON a.request_id = b.id
    LEFT JOIN belink.`user` c
    ON a.login_id = c.login
    WHERE b.`uuid` = ?
    ORDER BY a.created DESC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function request_data($login_id)
  {
    $sql = "SELECT COUNT(*) FROM belink.issue_request a WHERE a.status IN (1,2,3) AND a.login_id = '{$login_id}'";
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
    CONCAT('IS',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.type,
    IF(a.type = 1,'นำเข้า','เบิกออก') type_name,
    IF(a.type = 1,'success','danger') type_color,
    GROUP_CONCAT(DISTINCT CONCAT(IF(d.`code` = '','',CONCAT('[',d.`code`,'] ')),d.name)) items,
    CONCAT(DATE_FORMAT(a.event_start,'%d/%m/%Y'),' - ',DATE_FORMAT(a.event_end,'%d/%m/%Y')) `date`,
    a.text,
    (
      CASE
        WHEN a.`status` = 1 THEN 'รอตรวจสอบ'
        WHEN a.`status` = 2 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 3 THEN 'รายการถูกยกเลิก'
      END
    ) status_name,
    (
      CASE
        WHEN a.`status` = 1 THEN 'primary'
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
    FROM belink.issue_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN belink.issue_item c
    ON a.id = c.request_id
    LEFT JOIN belink.product d
    ON c.product_id = d.id
    WHERE a.status IN (1,2,3)
    AND c.status = 1
    AND a.login_id = '{$login_id}' ";

    if (!empty($keyword)) {
      $sql .= " AND (a.text LIKE '%{$keyword}%') ";
    }

    $sql .= " GROUP BY a.id ";

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
      $action = "<a href='/issue/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";
      $type = "<a href='javascript:void(0)' class='badge badge-{$row['type_color']} font-weight-light'>{$row['type_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $type,
        str_replace(",", ",<br>", $row['items']),
        (intval($row['type']) === 1 ? "" : str_replace("-", "-<br>", $row['date'])),
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
    $sql = "SELECT COUNT(*) FROM belink.issue_request a WHERE a.status = 1";
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
    CONCAT('IS',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.type,
    IF(a.type = 1,'นำเข้า','เบิกออก') type_name,
    IF(a.type = 1,'success','danger') type_color,
    GROUP_CONCAT(DISTINCT CONCAT(IF(d.`code` = '','',CONCAT('[',d.`code`,'] ')),d.name)) items,
    CONCAT(DATE_FORMAT(a.event_start,'%d/%m/%Y'),' - ',DATE_FORMAT(a.event_end,'%d/%m/%Y')) `date`,
    a.text,
    (
      CASE
        WHEN a.`status` = 1 THEN 'รอตรวจสอบ'
        WHEN a.`status` = 2 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 3 THEN 'รายการถูกยกเลิก'
      END
    ) status_name,
    (
      CASE
        WHEN a.`status` = 1 THEN 'primary'
        WHEN a.`status` = 2 THEN 'success'
        WHEN a.`status` = 3 THEN 'danger'
      END
    ) status_color,
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.issue_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN belink.issue_item c
    ON a.id = c.request_id
    LEFT JOIN belink.product d
    ON c.product_id = d.id
    WHERE a.status = 1
    AND c.status = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (a.text LIKE '%{$keyword}%') ";
    }

    $sql .= " GROUP BY a.id ";

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
      $action = "<a href='/issue/approve/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";
      $type = "<a href='javascript:void(0)' class='badge badge-{$row['type_color']} font-weight-light'>{$row['type_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $type,
        str_replace(",", ",<br>", $row['items']),
        (intval($row['type']) === 1 ? "" : str_replace("-", "-<br>", $row['date'])),
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

  public function manage_data($start, $end, $user, $type)
  {
    $sql = "SELECT COUNT(*) FROM belink.issue_request a WHERE a.status IN (1,2,3)";
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
    CONCAT('IS',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.type,
    IF(a.type = 1,'นำเข้า','เบิกออก') type_name,
    IF(a.type = 1,'success','danger') type_color,
    GROUP_CONCAT(DISTINCT CONCAT(IF(d.`code` = '','',CONCAT('[',d.`code`,'] ')),d.name)) items,
    CONCAT(DATE_FORMAT(a.event_start,'%d/%m/%Y'),' - ',DATE_FORMAT(a.event_end,'%d/%m/%Y')) `date`,
    a.text,
    (
      CASE
        WHEN a.`status` = 1 THEN 'รอตรวจสอบ'
        WHEN a.`status` = 2 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 3 THEN 'รายการถูกยกเลิก'
      END
    ) status_name,
    (
      CASE
        WHEN a.`status` = 1 THEN 'primary'
        WHEN a.`status` = 2 THEN 'success'
        WHEN a.`status` = 3 THEN 'danger'
      END
    ) status_color,
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.issue_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN belink.issue_item c
    ON a.id = c.request_id
    LEFT JOIN belink.product d
    ON c.product_id = d.id
    WHERE a.status IN (1,2,3)
    AND c.status = 1 ";

    if (!empty($start)) {
      $sql .= " AND (a.date BETWEEN '{$start}' AND '{$end}') ";
    }
    if (!empty($user)) {
      $sql .= " AND (a.login_id = '{$user}') ";
    }
    if (!empty($type)) {
      $sql .= " AND (a.type = '{$type}') ";
    }
    if (!empty($keyword)) {
      $sql .= " AND (a.text LIKE '%{$keyword}%') ";
    }

    $sql .= " GROUP BY a.id ";

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
      $action = "<a href='/issue/edit/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";
      $type = "<a href='javascript:void(0)' class='badge badge-{$row['type_color']} font-weight-light'>{$row['type_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $type,
        str_replace(",", ",<br>", $row['items']),
        (intval($row['type']) === 1 ? "" : str_replace("-", "-<br>", $row['date'])),
        str_replace("\n", "<br>", $row['text']),
        $row['created'],
      ];
    }

    $output = [
      "draw" => $draw,
      "recordsTotal" =>  $total,
      "recordsFiltered" => $filter,
      "data" => $data,
      "sql" => $sql
    ];
    return $output;
  }

  public function product_select($keyword)
  {
    $sql = "SELECT a.id, CONCAT(IF(a.`code` = '','',CONCAT('[',a.`code`,'] ')),a.name) `text`
    FROM belink.product a
    LEFT JOIN belink.product_brand b
    ON a.brand_id = b.id 
    WHERE a.status = 1 ";
    if (!empty($keyword)) {
      $sql .= " AND (a.name LIKE '%{$keyword}%' OR b.name LIKE '%{$keyword}%') ";
    }
    $sql .= " ORDER BY b.name ASC, a.name ASC LIMIT 20";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function product_stock_select($keyword)
  {
    $sql = "SELECT b.product_id `id`,CONCAT(IF(c.`code` = '','',CONCAT('[',c.`code`,'] ')),c.name) `text`
    FROM belink.issue_request a
    LEFT JOIN belink.issue_item b
    ON a.id = b.request_id
    LEFT JOIN belink.product c
    ON b.product_id = c.id
    WHERE a.`status` = 2
    AND b.`status` = 1 ";
    if (!empty($keyword)) {
      $sql .= " AND (c.name LIKE '%{$keyword}%') ";
    }
    $sql .= "  GROUP BY b.product_id
    HAVING (SUM(IF(b.`type` = 1,b.confirm,0)) - SUM(IF(b.`type` = 2,b.confirm,0))) > 0
    ORDER BY c.`name` ASC LIMIT 20";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function warehouse_select($keyword)
  {
    $sql = "SELECT id, name `text`
    FROM belink.product_warehouse
    WHERE status = 1 ";
    if (!empty($keyword)) {
      $sql .= " AND (name LIKE '%{$keyword}%') ";
    }
    $sql .= " ORDER BY name ASC LIMIT 20";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function outcome_select($keyword)
  {
    $sql = "SELECT id, CONCAT('[',CONCAT('IS',YEAR(created),LPAD(`last`,4,'0')),'] ',`text`) `text`
    FROM belink.issue_request
    WHERE type = 2
    AND status = 2 ";
    if (!empty($keyword)) {
      $sql .= " AND (`text` LIKE '%{$keyword}%') ";
    }
    $sql .= " ORDER BY id ASC LIMIT 20";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function type_select($keyword)
  {
    $data = [
      1 => "นำเข้า",
      2 => "เบิกออก"
    ];

    $result = [];
    foreach ($data as $key => $value) {
      $result[] = [
        "id" => $key,
        "text" => $value,
      ];
    }
    return $result;
  }

  public function user_select($keyword)
  {
    $sql = "SELECT a.login_id `id`,CONCAT(b.firstname,' ',b.lastname) `text`
    FROM belink.issue_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login ";
    if (!empty($keyword)) {
      $sql .= " WHERE (b.firstname LIKE '%{$keyword}%' OR b.lastname LIKE '%{$keyword}%') ";
    }
    $sql .= " GROUP BY a.login_id
    ORDER BY b.firstname ASC LIMIT 20";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function last_insert_id()
  {
    return $this->dbcon->lastInsertId();
  }
}
