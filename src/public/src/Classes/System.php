<?php

namespace App\Classes;

use PDO;

class System
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function read()
  {
    $sql = "SELECT * FROM belink.system WHERE id = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update($data)
  {
    $sql = "UPDATE belink.system SET
    name = ?,
    email = ?,
    password_email = ?,
    password_default = ?,
    updated = NOW()
    WHERE id = 1";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }
}
