<?php

namespace App\Classes;

use PDO;

class Authorize
{
  public $dbcon;

  public function __construct()
  {
    $database = new Database();
    $this->dbcon = $database->getConnection();
  }

  public function authorize_count($data)
  {
    $sql = "SELECT COUNT(*)
    FROM belink.service_authorize a
    WHERE a.login_id = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function authorize_insert($data)
  {
    $sql = "INSERT INTO belink.service_authorize( `login_id`, `service`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function authorize_update($data)
  {
    $sql = "UPDATE belink.service_authorize SET
    service = ?,
    updated = NOW()
    WHERE login_id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }
}
