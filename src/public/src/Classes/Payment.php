<?php

namespace App\Classes;

use PDO;

class Payment
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function order_view($data)
  {
    $sql = "SELECT b.expense_id,
      CONCAT('[',c.`code`,'] ',c.`name`) expense_name,
      b.estimate
    FROM belink.estimate_request a
    LEFT JOIN belink.estimate_item b
    ON a.id = b.request_id
    LEFT JOIN belink.expense c
    ON b.expense_id = c.id
    WHERE a.order_number = ?
    AND b.`status` = 1
    ORDER BY c.`reference` ASC, b.id ASC  ";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function order_select($keyword)
  {
    $sql = "SELECT 
      a.order_number id, 
      a.order_number `text`
    FROM belink.estimate_request a
    WHERE a.`status` NOT IN (5) ";
    if (!empty($keyword)) {
      $sql .= " AND (a.order_number LIKE '%{$keyword}%') ";
    }
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }
}
