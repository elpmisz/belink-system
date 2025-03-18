<?php

namespace App\Classes;

use PDO;

class Outstanding
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function get_item_view($data)
  {
    $sql = "SELECT *
    FROM 
    (
      SELECT b.name,b.amount,b.unit,b.estimate,a.order_number
      FROM belink.purchase_request a
      LEFT JOIN belink.purchase_item b
      ON a.id = b.request_id
      WHERE b.`status` = 1
      UNION 
      SELECT CONCAT('[',c.`name`,'] ',b.text,' ',b.text2) `name`, 1 amount,'' unit,(b.amount + b.vat - b.wt) total,a.order_number
      FROM belink.payment_request a
      LEFT JOIN belink.payment_item b
      ON a.id = b.request_id
      LEFT JOIN belink.expense c
      ON b.expense_id = c.id
      WHERE b.`status` = 1
    ) d
    WHERE d.order_number = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function outstanding_count($data)
  {
    $sql = "SELECT 
      COUNT(*)
    FROM belink.outstanding_request a
    WHERE a.status = 1
    AND a.login_id = ?
    AND a.department_number = ?
    AND a.doc_date = ?
    AND a.order_number = ?
    AND a.remark = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function outstanding_last()
  {
    $sql = "SELECT 
      a.last
    FROM belink.outstanding_request a
    WHERE YEAR(a.created) = YEAR(NOW())
    ORDER BY a.id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return (!empty($row['last']) ? intval($row['last']) + 1 : 1);
  }

  public function last_insert_id()
  {
    return $this->dbcon->lastInsertId();
  }
}
