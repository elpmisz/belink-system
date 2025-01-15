<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Expense;
use App\Classes\Validation;
use App\Classes\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

try {
  define("JWT_SECRET", "SECRET-KEY");
  define("JWT_ALGO", "HS512");
  $jwt = (isset($_COOKIE['jwt']) ? $_COOKIE['jwt'] : "");
  if (empty($jwt)) {
    header("Location: /");
    exit();
  }
  $decode = JWT::decode($jwt, new Key(JWT_SECRET, JWT_ALGO));
  $email = (isset($decode->data) ? $decode->data : "");
} catch (Exception $e) {
  $msg = $e->getMessage();
  if ($msg === "Expired token") {
    header("Location: /logout");
    exit;
  }
}

$USER = new User();
$user = $USER->user_view([$email, $email]);

$EXPENSE = new Expense();
$VALIDATION = new Validation();

if ($action === "expense-create") {
  try {
    $code = (isset($_POST['code']) ? $VALIDATION->input($_POST['code']) : "");
    $name = (isset($_POST['name']) ? $VALIDATION->input($_POST['name']) : "");
    $type = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
    $reference = (isset($_POST['reference']) ? $VALIDATION->input($_POST['reference']) : "");

    $expense_count = $EXPENSE->expense_count([$code, $name, $type, $reference]);
    if (intval($expense_count) === 0) {
      $EXPENSE->expense_insert([$code, $name, $type, $reference]);
      $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/expense");
    } else {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/expense");
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "expense-update") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $code = (isset($_POST['code']) ? $VALIDATION->input($_POST['code']) : "");
    $name = (isset($_POST['name']) ? $VALIDATION->input($_POST['name']) : "");
    $type = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
    $reference = (isset($_POST['reference']) ? $VALIDATION->input($_POST['reference']) : "");
    $status = (isset($_POST['status']) ? $VALIDATION->input($_POST['status']) : "");

    $EXPENSE->expense_update([$code, $name, $type, $reference, $status, $login_id, $uuid]);
    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/expense/view/{$uuid}");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "request-data") {
  try {
    $expense = (isset($_POST['expense']) ? $VALIDATION->input($_POST['expense']) : "");
    $result = $EXPENSE->request_data($expense);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "expense-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $EXPENSE->expense_select($keyword);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
