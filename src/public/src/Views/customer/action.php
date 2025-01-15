<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Customer;
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

$CUSTOMER = new Customer();
$VALIDATION = new Validation();

if ($action === "customer-create") {
  try {
    $code = (isset($_POST['code']) ? $VALIDATION->input($_POST['code']) : "");
    $name = (isset($_POST['name']) ? $VALIDATION->input($_POST['name']) : "");
    $contact = (isset($_POST['contact']) ? $VALIDATION->input($_POST['contact']) : "");

    $customer_count = $CUSTOMER->customer_count([$code, $name, $contact]);
    if (intval($customer_count) === 0) {
      $CUSTOMER->customer_insert([$code, $name, $contact]);
      $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/customer");
    } else {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/customer");
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "customer-update") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $code = (isset($_POST['code']) ? $VALIDATION->input($_POST['code']) : "");
    $name = (isset($_POST['name']) ? $VALIDATION->input($_POST['name']) : "");
    $contact = (isset($_POST['contact']) ? $VALIDATION->input($_POST['contact']) : "");
    $status = (isset($_POST['status']) ? $VALIDATION->input($_POST['status']) : "");

    $CUSTOMER->customer_update([$code, $name, $contact, $status, $login_id, $uuid]);
    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/customer/view/{$uuid}");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "request-data") {
  try {
    $result = $CUSTOMER->request_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
