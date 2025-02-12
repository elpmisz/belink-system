<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Service;
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

$SERVICE = new Service();
$VALIDATION = new Validation();

if ($action === "create") {
  try {
    if (isset($_POST['item_sequence'])) {
      foreach ($_POST['item_sequence'] as $key => $value) {
        $item_sequence = (isset($_POST['item_sequence'][$key]) ? $VALIDATION->input($_POST['item_sequence'][$key]) : "");
        $item_name = (isset($_POST['item_name'][$key]) ? $VALIDATION->input($_POST['item_name'][$key]) : "");
        $item_url = (isset($_POST['item_url'][$key]) ? $VALIDATION->input($_POST['item_url'][$key]) : "");

        $service_count = $SERVICE->service_count([$item_name, $item_url]);
        if (intval($service_count) === 0 && !empty($item_sequence)) {
          $SERVICE->service_insert([$item_sequence, $item_name, $item_url]);
        }
      }
    }

    if (isset($_POST['item__uuid'])) {
      foreach ($_POST['item__uuid'] as $key => $value) {
        $item__uuid = (isset($_POST['item__uuid'][$key]) ? $VALIDATION->input($_POST['item__uuid'][$key]) : "");
        $item__sequence = (isset($_POST['item__sequence'][$key]) ? $VALIDATION->input($_POST['item__sequence'][$key]) : "");
        $item__name = (isset($_POST['item__name'][$key]) ? $VALIDATION->input($_POST['item__name'][$key]) : "");
        $item__url = (isset($_POST['item__url'][$key]) ? $VALIDATION->input($_POST['item__url'][$key]) : "");

        $SERVICE->service_update([$item__sequence, $item__name, $item__url, $item__uuid]);
      }
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/service");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "delete") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $uuid = $data['uuid'];

    if (!empty($uuid)) {
      $SERVICE->service_delete([$uuid]);
      echo json_encode(200);
    } else {
      echo json_encode(500);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
