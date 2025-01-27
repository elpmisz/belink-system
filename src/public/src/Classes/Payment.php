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

  public function payment_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.payment_request a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.order_number = ?
    AND a.receiver = ?
    AND a.type = ?
    AND a.cheque_bank = ?
    AND a.cheque_branch = ?
    AND a.cheque_number = ?
    AND a.cheque_date = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function payment_last()
  {
    $sql = "SELECT 
      a.last
    FROM belink.payment_request a
    WHERE YEAR(a.created) = YEAR(NOW())
    ORDER BY a.id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (!empty($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function payment_insert($data)
  {
    $sql = "INSERT INTO belink.payment_request(`uuid`, `last`, `login_id`, `order_number`, `receiver`, `type`, `cheque_bank`, `cheque_branch`, `cheque_number`, `cheque_date`) VALUES(uuid(),?,?,?,?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function payment_item_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.payment_item a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.expense_id = ?
    AND a.text = ?
    AND a.text2 = ?
    AND a.amount = ?
    AND a.vat = ?
    AND a.wt = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function payment_item_insert($data)
  {
    $sql = "INSERT INTO belink.payment_item(`request_id`, `expense_id`, `text`, `text2`, `amount`, `vat`, `wt`) VALUES(?,?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function payment_file_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.payment_file a
    WHERE a.status = 1
    AND a.request_id = ?
    AND a.name = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function payment_file_insert($data)
  {
    $sql = "INSERT INTO belink.payment_file(`request_id`, `name`) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
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

  public function last_insert_id()
  {
    return $this->dbcon->lastInsertId();
  }
}
