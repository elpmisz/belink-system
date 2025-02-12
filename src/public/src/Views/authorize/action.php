<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Authorize;
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

$AUTHORIZE = new Authorize();
$VALIDATION = new Validation();

if ($action === "update") {
  try {
    $login_id = (isset($_POST['login_id']) ? $VALIDATION->input($_POST['login_id']) : "");
    $service = implode(',', $_POST['service']);

    $authorize_count = $AUTHORIZE->authorize_count([$login_id]);
    if (intval($authorize_count) === 0) {
      $AUTHORIZE->authorize_insert([$login_id, $service]);
    } else {
      $AUTHORIZE->authorize_update([$service, $login_id]);
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/authorize");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
