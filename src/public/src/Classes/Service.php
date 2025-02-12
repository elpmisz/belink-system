<?php

namespace App\Classes;

use PDO;

class Service
{
  public $dbcon;

  public function __construct()
  {
    $database = new Database();
    $this->dbcon = $database->getConnection();
  }

  public function service_count($data)
  {
    $sql = "SELECT COUNT(*)
    FROM belink.service a
    WHERE a.`name` = ?
    AND a.`url` = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function service_insert($data)
  {
    $sql = "INSERT INTO belink.service( `uuid`, `sequence`, `name`, `url`) VALUES(uuid(),?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function service_update($data)
  {
    $sql = "UPDATE belink.service SET
    sequence = ?,
    name = ?,
    url = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function service_read()
  {
    $sql = "SELECT * FROM belink.service a WHERE a.status = 1 ORDER BY a.sequence ASC";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function service_delete($data)
  {
    $sql = "UPDATE belink.service SET
    status = 2,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }
}
