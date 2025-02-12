<?php

namespace App\Classes;

use PDO;

class Borrow
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function borrow_last()
  {
    $sql = "SELECT 
      a.last
    FROM belink.borrow_request a
    WHERE YEAR(a.created) = YEAR(NOW())
    ORDER BY a.id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (!empty($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function borrow_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.borrow_request a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.start = ?
    AND a.end = ?
    AND a.objective = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function borrow_insert($data)
  {
    $sql = "INSERT INTO belink.borrow_request(`uuid`, `last`, `login_id`, `start`, `end`, `objective`) VALUES(uuid(),?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function borrow_view($data)
  {
    $sql = "SELECT a.id,
    a.`uuid`,
    CONCAT('BR',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    CONCAT(DATE_FORMAT(a.start,'%d/%m/%Y'),' - ',DATE_FORMAT(a.end,'%d/%m/%Y')) `date`,
    a.objective,
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.borrow_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    WHERE a.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function borrow_update($data)
  {
    $sql = "UPDATE belink.borrow_request SET
    `start` = ?,
    `end` = ?,
    objective = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.borrow_item a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.asset_id = ?
    AND a.text = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function item_insert($data)
  {
    $sql = "INSERT INTO belink.borrow_item(`request_id`, `asset_id`, `text`) VALUES(?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_view($data)
  {
    $sql = "SELECT a.id,CONCAT(IF(c.`code` = '','',CONCAT('[',c.`code`,'] ')),c.`name`) asset_name,a.text
    FROM belink.borrow_item a
    LEFT JOIN belink.borrow_request b
    ON a.request_id = b.id
    LEFT JOIN belink.asset c
    ON a.asset_id = c.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?
    ORDER BY a.id ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function item_update($data)
  {
    $sql = "UPDATE belink.borrow_item SET
    `text` = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_delete($data)
  {
    $sql = "UPDATE belink.borrow_item SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function file_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.borrow_file a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function file_insert($data)
  {
    $sql = "INSERT INTO belink.borrow_file(`request_id`, `name`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function file_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.`name`
    FROM belink.borrow_file a
    LEFT JOIN belink.borrow_request b
    ON a.request_id = b.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function file_delete($data)
  {
    $sql = "UPDATE belink.borrow_file SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function borrow_process($data)
  {
    $sql = "UPDATE belink.borrow_request SET
    status = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function remark_insert($data)
  {
    $sql = "INSERT INTO belink.borrow_remark(`request_id`, `login_id`, `date`, `text`, `status`) VALUES(?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function remark_view($data)
  {
    $sql = "SELECT CONCAT(c.firstname,' ',c.lastname) username,
    DATE_FORMAT(a.date,'%d/%m/%Y') `date`,
    a.text,
    (
    CASE
      WHEN a.`status` = 2 THEN 'ส่งมอบแล้ว'
      WHEN a.`status` = 3 THEN 'รับคืนแล้ว'
      WHEN a.`status` = 4 THEN 'รายการถูกยกเลิก'
    END
    ) status_name,
    (
    CASE
      WHEN a.`status` = 2 THEN 'primary'
      WHEN a.`status` = 3 THEN 'success'
      WHEN a.`status` = 4 THEN 'danger'
    END
    ) status_color,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.borrow_remark a
    LEFT JOIN belink.borrow_request b
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
    $sql = "SELECT COUNT(*) FROM belink.borrow_request a WHERE a.status IN (1,2,3,4) AND a.login_id = '{$login_id}'";
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
    CONCAT('BR',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    GROUP_CONCAT(DISTINCT CONCAT(IF(d.`code` = '','',CONCAT('[',d.`code`,'] ')),d.name)) items,
    CONCAT(DATE_FORMAT(a.start,'%d/%m/%Y'),' - ',DATE_FORMAT(a.end,'%d/%m/%Y')) `date`,
    a.objective,
    (
      CASE
        WHEN a.`status` = 1 THEN 'รอส่งมอบทรัพย์สิน'
        WHEN a.`status` = 2 THEN 'รอรับคืนทรัพย์สิน'
        WHEN a.`status` = 3 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 4 THEN 'รายการถูกยกเลิก'
      END
    ) status_name,
    (
      CASE
        WHEN a.`status` = 1 THEN 'warning'
        WHEN a.`status` = 2 THEN 'primary'
        WHEN a.`status` = 3 THEN 'success'
        WHEN a.`status` = 4 THEN 'danger'
      END
    ) status_color,
    (
      CASE
        WHEN a.`status` = 1 THEN 'view'
        ELSE 'complete'
      END
    ) `page`,
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.borrow_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN belink.borrow_item c
    ON a.id = c.request_id
    LEFT JOIN belink.asset d
    ON c.asset_id = d.id
    WHERE a.status IN (1,2,3,4)
    AND c.status = 1
    AND a.login_id = '{$login_id}' ";

    if (!empty($keyword)) {
      $sql .= " AND (a.objective LIKE '%{$keyword}%') ";
    }

    $sql .= "GROUP BY a.id ";

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
      $action = "<a href='/borrow/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        str_replace(",", ",<br>", $row['items']),
        str_replace("\n", "<br>", $row['objective']),
        str_replace("-", "-<br>", $row['date']),
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

  public function process_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.borrow_request a WHERE a.status IN (1,2)";
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
    CONCAT('BR',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    GROUP_CONCAT(DISTINCT CONCAT(IF(d.`code` = '','',CONCAT('[',d.`code`,'] ')),d.name)) items,
    CONCAT(DATE_FORMAT(a.start,'%d/%m/%Y'),' - ',DATE_FORMAT(a.end,'%d/%m/%Y')) `date`,
    a.objective,
    (
      CASE
        WHEN a.`status` = 1 THEN 'รอส่งมอบทรัพย์สิน'
        WHEN a.`status` = 2 THEN 'รอรับคืนทรัพย์สิน'
        WHEN a.`status` = 3 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 4 THEN 'รายการถูกยกเลิก'
      END
    ) status_name,
    (
      CASE
        WHEN a.`status` = 1 THEN 'warning'
        WHEN a.`status` = 2 THEN 'primary'
        WHEN a.`status` = 3 THEN 'success'
        WHEN a.`status` = 4 THEN 'danger'
      END
    ) status_color,
    (
      CASE
        WHEN a.`status` = 1 THEN 'send'
        WHEN a.`status` = 2 THEN 'receive'
        ELSE NULL
      END
    ) `page`,
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.borrow_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN belink.borrow_item c
    ON a.id = c.request_id
    LEFT JOIN belink.asset d
    ON c.asset_id = d.id
    WHERE a.status IN (1,2)
    AND c.status = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (a.objective LIKE '%{$keyword}%') ";
    }

    $sql .= "GROUP BY a.id ";

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
      $action = "<a href='/borrow/{$row['page']}/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      if (!empty($row['id'])) {
        $data[] = [
          $action,
          $row['ticket'],
          $row['username'],
          str_replace(",", ",<br>", $row['items']),
          str_replace("\n", "<br>", $row['objective']),
          str_replace("-", "-<br>", $row['date']),
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
    $sql = "SELECT COUNT(*) FROM belink.borrow_request a";
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
    CONCAT('BR',YEAR(a.created),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    GROUP_CONCAT(DISTINCT CONCAT(IF(d.`code` = '','',CONCAT('[',d.`code`,'] ')),d.name)) items,
    CONCAT(DATE_FORMAT(a.start,'%d/%m/%Y'),' - ',DATE_FORMAT(a.end,'%d/%m/%Y')) `date`,
    a.objective,
    (
      CASE
        WHEN a.`status` = 1 THEN 'รอส่งมอบทรัพย์สิน'
        WHEN a.`status` = 2 THEN 'รอรับคืนทรัพย์สิน'
        WHEN a.`status` = 3 THEN 'ดำเนินการเรียบร้อย'
        WHEN a.`status` = 4 THEN 'รายการถูกยกเลิก'
      END
    ) status_name,
    (
      CASE
        WHEN a.`status` = 1 THEN 'warning'
        WHEN a.`status` = 2 THEN 'primary'
        WHEN a.`status` = 3 THEN 'success'
        WHEN a.`status` = 4 THEN 'danger'
      END
    ) status_color,
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.borrow_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN belink.borrow_item c
    ON a.id = c.request_id
    LEFT JOIN belink.asset d
    ON c.asset_id = d.id
    WHERE c.status = 1 ";

    if (!empty($keyword)) {
      $sql .= " AND (a.objective LIKE '%{$keyword}%') ";
    }

    $sql .= "GROUP BY a.id ";

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
      $action = "<a href='/borrow/edit/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      if (!empty($row['id'])) {
        $data[] = [
          $action,
          $row['ticket'],
          $row['username'],
          str_replace(",", ",<br>", $row['items']),
          str_replace("\n", "<br>", $row['objective']),
          str_replace("-", "-<br>", $row['date']),
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

  public function asset_select($keyword)
  {
    $sql = "SELECT id, CONCAT(IF(`code` = '','',CONCAT('[',`code`,'] ')),name) `text`
    FROM belink.asset
    WHERE status = 1 ";
    if (!empty($keyword)) {
      $sql .= " AND (name LIKE '%{$keyword}%') ";
    }
    $sql .= " ORDER BY name ASC LIMIT 20";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function last_insert_id()
  {
    return $this->dbcon->lastInsertId();
  }
}
