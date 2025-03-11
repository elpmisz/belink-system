<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Department;
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

$DEPARTMENT = new Department();
$VALIDATION = new Validation();

if ($action === "create") {
  try {
    $name = (isset($_POST['name']) ? $VALIDATION->input($_POST['name']) : "");

    $department_count = $DEPARTMENT->department_count([$name]);

    if (intval($department_count) > 0) {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/department");
    }

    $DEPARTMENT->department_insert([$name]);
    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/department");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "update") {
  try {
    $id = (isset($_POST['id']) ? $VALIDATION->input($_POST['id']) : "");
    $name = (isset($_POST['name']) ? $VALIDATION->input($_POST['name']) : "");
    $status = (isset($_POST['status']) ? $VALIDATION->input($_POST['status']) : "");

    $DEPARTMENT->department_update([$name, $status, $id]);
    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/department/view/{$id}");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "request-data") {
  try {
    $result = $DEPARTMENT->request_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
