<?php

namespace App\Classes;

use PDO;

class BorrowAuthorize
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function authorize_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.borrow_authorize a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.type = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function authorize_insert($data)
  {
    $sql = "INSERT INTO belink.borrow_authorize(`login_id`, `type`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function authorize_delete($data)
  {
    $sql = "UPDATE belink.borrow_authorize SET
    status = 0,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }
}
