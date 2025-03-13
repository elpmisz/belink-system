<?php

namespace App\Classes;

use PDO;

class Quotation
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function quotation_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.quotation_request a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.doc_date = ?
    AND a.biller_id = ?
    AND a.customer_id = ?
    AND a.customer_name = ?
    AND a.customer_address = ?
    AND a.text = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function quotation_last()
  {
    $sql = "SELECT 
      a.last
    FROM belink.quotation_request a
    WHERE YEAR(a.created) = YEAR(NOW())
    ORDER BY a.id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (!empty($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function quotation_insert($data)
  {
    $sql = "INSERT INTO belink.quotation_request(`uuid`, `last`, `login_id`, `doc_date`, `biller_id`, `customer_type`, `customer_id`, `customer_name`, `customer_address`, `text`) VALUES(uuid(),?,?,?,?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function quotation_update($data)
  {
    $sql = "UPDATE belink.quotation_request SET
    doc_date = ?,
    biller_id = ?,
    customer_id = ?,
    customer_name = ?,
    customer_address = ?,
    `text` = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function quotation_view($data)
  {
    $sql = "SELECT a.id,
    a.`uuid`,
    CONCAT('QU-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    a.biller_id,
    CONCAT('[',c.`code`,'] ',c.`name`) biller_name,
    c.`name` biller_text,
    c.contact biller_address,
    a.customer_type,
    IF(a.customer_type = 1,'ลูกค้าเก่า','ลูกค้าใหม่') customer_type_name,
    a.customer_id,
    IF(a.customer_type = 1,CONCAT('[',d.`code`,'] ',d.`name`),a.customer_name) customer_name,
    IF(a.customer_type = 1,d.`name`,a.customer_name) customer_text,
    IF(a.customer_type = 1,d.contact,a.customer_address) customer_address,
    a.text,
    DATE_FORMAT(a.doc_date,'%d/%m/%Y') doc_date,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.quotation_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN belink.customer c
    ON a.biller_id = c.id
    LEFT JOIN belink.customer d
    ON a.customer_id = d.id
    WHERE a.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function quotation_item_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.quotation_item a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.product = ?
    AND a.price = ?
    AND a.discount = ?
    AND a.amount = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function quotation_item_insert($data)
  {
    $sql = "INSERT INTO belink.quotation_item(`request_id`, `product`, `price`, `discount`, `amount`) VALUES(?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function quotation_item_update($data)
  {
    $sql = "UPDATE belink.quotation_item SET
    product = ?,
    price = ?,
    discount = ?,
    amount = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function quotation_item_view($data)
  {
    $sql = "SELECT b.id,b.product,b.price,b.discount,b.amount
    FROM belink.quotation_request a
    LEFT JOIN belink.quotation_item b
    ON a.id = b.request_id
    WHERE b.`status` = 1
    AND a.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function quotation_item_total($data)
  {
    $sql = "SELECT 
    SUM((b.price -
    (
    CASE
      WHEN b.discount LIKE '%%' THEN (b.price * CAST(SUBSTRING(b.discount, 1, LENGTH(b.discount)-1) AS DECIMAL(10,2))) / 100
      ELSE b.discount
    END
    )) * b.amount) total
    FROM belink.quotation_request a
    LEFT JOIN belink.quotation_item b
    ON a.id = b.request_id
    WHERE a.`uuid` = ?
    AND b.`status` = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    $row = $stmt->fetch();
    return (isset($row['total']) ? $row['total'] : 0);
  }

  public function quotation_item_delete($data)
  {
    $sql = "UPDATE belink.quotation_item SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function quotation_file_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.quotation_file a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function quotation_file_insert($data)
  {
    $sql = "INSERT INTO belink.quotation_file(`request_id`, `name`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function quotation_file_view($data)
  {
    $sql = "SELECT 
      a.id,
      a.`name`
    FROM belink.quotation_file a
    LEFT JOIN belink.quotation_request b
    ON a.request_id = b.id
    WHERE a.`status` = 1
    AND b.`uuid` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function quotation_file_delete($data)
  {
    $sql = "UPDATE belink.quotation_file SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function biller_view($data)
  {
    $sql = "SELECT *
    FROM belink.customer a
    WHERE a.id = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function request_data()
  {
    $sql = "SELECT COUNT(*) FROM belink.quotation_request a WHERE a.status IN (1,2)";
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
    CONCAT('QU-',RIGHT((YEAR(a.created) + 543),2),LPAD(a.`last`,4,'0')) ticket,
    CONCAT(b.firstname,' ',b.lastname) username,
    CONCAT('[',c.`code`,'] ',c.`name`) biller_name,
    IF(a.customer_type = 1,'ลูกค่าเก่า','ลูกค้าใหม่') customer_type,
    IF(a.customer_type = 1,CONCAT('[',d.`code`,'] ',d.`name`),a.customer_name) customer_name,
    a.text,
    DATE_FORMAT(a.doc_date,'%d/%m/%Y') doc_date,
    DATE_FORMAT(a.created,'%d/%m/%Y, %H:%i น.') created
    FROM belink.quotation_request a
    LEFT JOIN belink.`user` b
    ON a.login_id = b.login
    LEFT JOIN belink.customer c
    ON a.biller_id = c.id
    LEFT JOIN belink.customer d
    ON a.customer_id = d.id
    WHERE a.status IN (1,2) ";

    if (!empty($keyword)) {
      $sql .= " AND (a.customer_name LIKE '%{$keyword}%' OR a.customer_address LIKE '%{$keyword}%' OR a.text LIKE '%{$keyword}%' OR c.code LIKE '%{$keyword}%' OR c.name LIKE '%{$keyword}%' OR d.code LIKE '%{$keyword}%' OR d.name LIKE '%{$keyword}%') ";
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
      $action = "<a href='/quotation/view/{$row['uuid']}' class='badge badge-success font-weight-light'>รายละเอียด</a>";

      $data[] = [
        $action,
        $row['ticket'],
        $row['username'],
        $row['biller_name'],
        $row['customer_type'],
        $row['customer_name'],
        str_replace("\n", "<br>", $row['text']),
        $row['doc_date'],
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
