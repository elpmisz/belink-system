<?php

namespace App\Classes;

use PDO;

class Asset
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function asset_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.asset a
    WHERE a.status = 1
    AND a.name = ?
    AND a.code = ?
    AND a.type_id = ?
    AND a.warehouse_id = ?
    AND a.location_id = ?
    AND a.brand_id = ?
    AND a.unit_id = ?
    AND a.size = ?
    AND a.material = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function asset_insert($data)
  {
    $sql = "INSERT INTO belink.asset(`uuid`, `name`, `code`, `type_id`, `warehouse_id`, `location_id`, `brand_id`, `unit_id`, `size`, `material`, `text`) VALUES(uuid(),?,?,?,?,?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function asset_view($data)
  {
    $sql = "SELECT a.id,
    a.`uuid`,
    a.`code`,
    a.`name`,
    a.type_id,b.`name` type_name,
    a.warehouse_id,c.`name` warehouse_name,
    a.location_id,d.`name` location_name,
    a.brand_id,e.`name` brand_name,
    a.unit_id,f.`name` unit_name,
    a.size,
    a.material,
    a.text,
    a.`status`,
    IF(a.`status` = 1,'ใช้งาน','ระงับการใช้งาน') status_name,
    IF(a.`status` = 1,'success','danger') status_color,
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.asset a
    LEFT JOIN belink.asset_type b
    ON a.type_id = b.id
    LEFT JOIN belink.asset_warehouse c
    ON a.warehouse_id = c.id
    LEFT JOIN belink.asset_location d
    ON a.location_id = d.id
    LEFT JOIN belink.asset_brand e
    ON a.brand_id = e.id
    LEFT JOIN belink.asset_unit f
    ON a.unit_id = f.id
    WHERE a.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function asset_update($data)
  {
    $sql = "UPDATE belink.asset SET
    name = ?,
    code = ?,
    type_id = ?,
    warehouse_id = ?,
    location_id = ?,
    brand_id = ?,
    unit_id = ?,
    `size`= ?,
    material = ?,
    `text` = ?,
    `status` = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function asset_download($type, $warehouse, $location, $brand)
  {
    $sql = "SELECT a.`code`,
    a.`name`,
    b.`name` type_name,
    c.`name` warehouse_name,
    d.`name` location_name,
    e.`name` brand_name,
    f.`name` unit_name,
    a.size,
    a.material,
    a.text
    FROM belink.asset a
    LEFT JOIN belink.asset_type b
    ON a.type_id = b.id
    LEFT JOIN belink.asset_warehouse c
    ON a.warehouse_id = c.id
    LEFT JOIN belink.asset_location d
    ON a.location_id = d.id
    LEFT JOIN belink.asset_brand e
    ON a.brand_id = e.id
    LEFT JOIN belink.asset_unit f
    ON a.unit_id = f.id
    WHERE a.`status` IN (1,2) ";

    if (!empty($type)) {
      $sql .= " AND a.type_id = '{$type}' ";
    }
    if (!empty($warehouse)) {
      $sql .= " AND a.warehouse_id = '{$warehouse}' ";
    }
    if (!empty($location)) {
      $sql .= " AND a.location_id = '{$location}' ";
    }
    if (!empty($brand)) {
      $sql .= " AND a.brand_id = '{$brand}' ";
    }

    $sql .= " ORDER BY a.`status` ASC, a.`code` ASC, a.`name` ASC  ";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_NUM);
  }

  public function file_create($data)
  {
    $sql = "INSERT INTO belink.asset_file(`asset_id`, `name`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function file_view($data)
  {
    $sql = "SELECT * 
    FROM belink.asset_file a
    WHERE a.asset_id = ?
    AND a.status = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function file_delete($data)
  {
    $sql = "UPDATE belink.asset_file SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function brand_id($data)
  {
    $sql = "SELECT id
    FROM belink.asset_brand a
    WHERE a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    $row = $stmt->fetch();
    return (isset($row['id']) ? $row['id'] : "");
  }

  public function type_id($data)
  {
    $sql = "SELECT id
    FROM belink.asset_type a
    WHERE a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    $row = $stmt->fetch();
    return (isset($row['id']) ? $row['id'] : "");
  }

  public function unit_id($data)
  {
    $sql = "SELECT id
    FROM belink.asset_unit a
    WHERE a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    $row = $stmt->fetch();
    return (isset($row['id']) ? $row['id'] : "");
  }

  public function warehouse_id($data)
  {
    $sql = "SELECT id
    FROM belink.asset_warehouse a
    WHERE a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    $row = $stmt->fetch();
    return (isset($row['id']) ? $row['id'] : "");
  }

  public function location_id($data)
  {
    $sql = "SELECT id
    FROM belink.asset_location a
    WHERE a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    $row = $stmt->fetch();
    return (isset($row['id']) ? $row['id'] : "");
  }

  public function request_data($type, $warehouse, $location, $brand)
  {
    $sql = "SELECT COUNT(*) FROM belink.asset a WHERE a.status IN (1,2)";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $column = ["a.id", "a.name"];

    $keyword = (isset($_POST['search']['value']) ? trim($_POST['search']['value']) : "");
    $filter_order = (isset($_POST['order']) ? $_POST['order'] : "");
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : "");
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : "");
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : "");
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : "");
    $draw = (isset($_REQUEST['draw']) ? $_REQUEST['draw'] : "");

    $sql = "SELECT a.id,
    a.`uuid`,
    a.`code`,
    a.`name`,
    a.type_id,b.`name` type_name,
    a.warehouse_id,c.`name` warehouse_name,
    a.location_id,d.`name` location_name,
    a.brand_id,e.`name` brand_name,
    a.unit_id,f.`name` unit_name,
    a.size,
    a.material,
    a.text,
    a.`status`,
    IF(a.`status` = 1,'ใช้งาน','ระงับการใช้งาน') status_name,
    IF(a.`status` = 1,'success','danger') status_color,
    DATE_FORMAT(a.created, '%d/%m/%Y, %H:%i น.') created
    FROM belink.asset a
    LEFT JOIN belink.asset_type b
    ON a.type_id = b.id
    LEFT JOIN belink.asset_warehouse c
    ON a.warehouse_id = c.id
    LEFT JOIN belink.asset_location d
    ON a.location_id = d.id
    LEFT JOIN belink.asset_brand e
    ON a.brand_id = e.id
    LEFT JOIN belink.asset_unit f
    ON a.unit_id = f.id
    WHERE a.`status` IN (1,2) ";

    if (!empty($type)) {
      $sql .= " AND a.type_id = '{$type}' ";
    }
    if (!empty($warehouse)) {
      $sql .= " AND a.warehouse_id = '{$warehouse}' ";
    }
    if (!empty($location)) {
      $sql .= " AND a.location_id = '{$location}' ";
    }
    if (!empty($brand)) {
      $sql .= " AND a.brand_id = '{$brand}' ";
    }
    if (!empty($keyword)) {
      $sql .= " AND (a.code LIKE '%{$keyword}%' OR a.name LIKE '%{$keyword}%' OR a.text LIKE '%{$keyword}%' OR b.name LIKE '%{$keyword}%' OR c.name LIKE '%{$keyword}%' OR d.name LIKE '%{$keyword}%' OR e.name LIKE '%{$keyword}%' OR f.name LIKE '%{$keyword}%') ";
    }

    if ($filter_order) {
      $sql .= " ORDER BY {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " ORDER BY a.`status` ASC, a.`code` ASC, a.`name` ASC  ";
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
      $action = "<a href='/asset/view/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a>";

      $data[] = [
        $action,
        $row['code'],
        $row['name'],
        $row['brand_name'],
        $row['type_name'],
        $row['warehouse_name'],
        $row['location_name'],
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

  public function type_select($keyword)
  {
    $sql = "SELECT id, name `text`
    FROM belink.asset_type
    WHERE status = 1 ";
    if (!empty($keyword)) {
      $sql .= " AND (name LIKE '%{$keyword}%') ";
    }
    $sql .= " ORDER BY name ASC LIMIT 20";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function warehouse_select($keyword)
  {
    $sql = "SELECT id, name `text`
    FROM belink.asset_warehouse
    WHERE status = 1 ";
    if (!empty($keyword)) {
      $sql .= " AND (name LIKE '%{$keyword}%') ";
    }
    $sql .= " ORDER BY name ASC LIMIT 20";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function location_select($keyword)
  {
    $sql = "SELECT id, name `text`
    FROM belink.asset_location
    WHERE status = 1 ";
    if (!empty($keyword)) {
      $sql .= " AND (name LIKE '%{$keyword}%') ";
    }
    $sql .= " ORDER BY name ASC LIMIT 20";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function brand_select($keyword)
  {
    $sql = "SELECT id, name `text`
    FROM belink.asset_brand
    WHERE status = 1 ";
    if (!empty($keyword)) {
      $sql .= " AND (name LIKE '%{$keyword}%') ";
    }
    $sql .= " ORDER BY name ASC LIMIT 20";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function unit_select($keyword)
  {
    $sql = "SELECT id, name `text`
    FROM belink.asset_unit
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
