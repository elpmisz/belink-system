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
    $text = (isset($_POST['text']) ? $VALIDATION->input($_POST['text']) : "");
    $outstanding_last = $OUTSTANDING->outstanding_last();

    $outstanding_count = $OUTSTANDING->outstanding_count([$login_id, $department_number, $doc_date, $order_number, $text]);

    if (intval($outstanding_count) > 0) {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/outstanding");
    }

    $OUTSTANDING->outstanding_insert([$outstanding_last, $login_id, $department_number, $doc_date, $order_number, $text]);
    $request_id = $OUTSTANDING->last_insert_id();

    $items = $OUTSTANDING->get_item_view([$order_number]);

    $selected  = [];
    foreach ($_POST['item_index'] as $index) {
      $selected[] = $items[$index];
    }

    foreach ($selected as $item) {
      $name = (isset($item['name']) ? $VALIDATION->input($item['name']) : "");
      $amount = (isset($item['amount']) ? $VALIDATION->input($item['amount']) : "");
      $unit = (isset($item['unit']) ? $VALIDATION->input($item['unit']) : "");
      $estimate = (isset($item['estimate']) ? $VALIDATION->input($item['estimate']) : "");

      $outstanding_item_count = $OUTSTANDING->outstanding_item_count([$request_id, $name, $amount, $unit, $estimate]);
      if (intval($outstanding_item_count) === 0) {
        $OUTSTANDING->outstanding_item_insert([$request_id, $name, $amount, $unit, $estimate]);
      }
    }

    foreach ($_FILES['file']['name'] as $key => $row) {
      $file_name = (isset($_FILES['file']['name']) ? $_FILES['file']['name'][$key] : "");
      $file_tmp = (isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'][$key] : "");
      $file_random = md5(microtime());
      $file_image = ["png", "jpeg", "jpg"];
      $file_document = ["pdf", "doc", "docx", "xls", "xlsx"];
      $file_allow = array_merge($file_image, $file_document);
      $file_extension = pathinfo(strtolower($file_name), PATHINFO_EXTENSION);

      if (!empty($file_name) && in_array($file_extension, $file_allow)) {
        if (in_array($file_extension, $file_document)) {
          $file_rename = "{$file_random}.{$file_extension}";
          $file_path = (__DIR__ . "/../../Publics/outstanding/{$file_rename}");
          move_uploaded_file($file_tmp, $file_path);
        }
        if (in_array($file_extension, $file_image)) {
          $file_rename = "{$file_random}.webp";
          $file_path = (__DIR__ . "/../../Publics/outstanding/{$file_rename}");
          $VALIDATION->image_upload($file_tmp, $file_path);
        }

        $outstanding_file_count = $PAYMENT->outstanding_file_count([$request_id, $file_rename]);
        if (intval($outstanding_file_count) === 0) {
          $PAYMENT->outstanding_file_insert([$request_id, $file_rename]);
        }
      }
    }

    $VALIDATION->alert("success", "บันทึกข้อมูลเรียบร้อย!", "/outstanding");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "request-data") {
  try {
    $result = $OUTSTANDING->request_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "approve-data") {
  try {
    $result = $OUTSTANDING->approve_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "item-view") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $item = (isset($data['item']) ? $data['item'] : "");
    $order = (isset($data['order']) ? $data['order'] : "");
    $result = $OUTSTANDING->item_view([$order, $item]);

    echo json_encode($result);
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

if ($action === "item-delete") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    if (!empty($id)) {
      $OUTSTANDING->outstanding_item_delete([$id]);
      echo json_encode(200);
    } else {
      echo json_encode(500);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "file-delete") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    if (!empty($id)) {
      $OUTSTANDING->outstanding_file_delete([$id]);
      echo json_encode(200);
    } else {
      echo json_encode(500);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === 'item-select') {
  try {
    $keyword = (isset($_POST['keyword']) ? $VALIDATION->input($_POST['keyword']) : "");
    $order = (isset($_POST['order']) ? $VALIDATION->input($_POST['order']) : "");
    $result = $OUTSTANDING->item_select($keyword, [$order]);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
