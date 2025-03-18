<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Outstanding;
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

$OUTSTANDING = new Outstanding();
$VALIDATION = new Validation();

if ($action === "create") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $department_number = (isset($_POST['department_number']) ? $VALIDATION->input($_POST['department_number']) : "");
    $doc_date = (isset($_POST['doc_date']) ? $VALIDATION->input($_POST['doc_date']) : "");
    $doc_date = (!empty($doc_date) ? DateTime::createFromFormat('d/m/Y', $doc_date)->format('Y-m-d') : "");
    $order_number = (isset($_POST['order_number']) ? $VALIDATION->input($_POST['order_number']) : "");
    $objective = (isset($_POST['objective']) ? $VALIDATION->input($_POST['objective']) : "");
    // $outstanding_last = $OUTSTANDING->outstanding_last();

    $items = $OUTSTANDING->get_item_view([$order_number]);

    echo "<pre>";
    print_r($_POST);
    print_r($items);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "get-item-view") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $order = (isset($data['order']) ? $data['order'] : "");
    $result = $OUTSTANDING->get_item_view([$order]);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
