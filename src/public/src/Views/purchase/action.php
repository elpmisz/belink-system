<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Purchase;
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

$PURCHASE = new Purchase();
$VALIDATION = new Validation();

if ($action === "create") {
  try {
    echo "<pre>";
    print_r($_POST);
    die();
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $department_number = (isset($_POST['department_number']) ? $VALIDATION->input($_POST['department_number']) : "");
    $department = (isset($_POST['department']) ? $VALIDATION->input($_POST['department']) : "");
    $doc_date = (isset($_POST['doc_date']) ? $VALIDATION->input($_POST['doc_date']) : "");
    $doc_date = (!empty($doc_date) ? date("Y-m-d", strtotime(str_replace("/", "-", $doc_date))) : "");
    $po = (isset($_POST['po']) ? $VALIDATION->input($_POST['po']) : "");
    $date = (isset($_POST['date']) ? $VALIDATION->input($_POST['date']) : "");
    $date = (!empty($date) ? date("Y-m-d", strtotime(str_replace("/", "-", $date))) : "");
    $order_number = (isset($_POST['order_number']) ? $VALIDATION->input($_POST['order_number']) : "");
    $reference = (isset($_POST['reference']) ? $VALIDATION->input($_POST['reference']) : "");
    $objective = (isset($_POST['objective']) ? $VALIDATION->input($_POST['objective']) : "");
    $remark = (isset($_POST['remark']) ? $VALIDATION->input($_POST['remark']) : "");
    $purchase_last = $PURCHASE->purchase_last();

    $purchase_count = $PURCHASE->purchase_count([$login_id, $department_number, $doc_date, $po, $department, $date, $order_number, $reference, $objective, $remark]);
    if (intval($purchase_count) === 0) {
      $PURCHASE->purchase_insert([$purchase_last, $login_id, $department_number, $doc_date, $po, $department, $date, $order_number, $reference, $objective, $remark]);
      $request_id = $PURCHASE->last_insert_id();

      foreach ($_POST['item_name'] as $key => $row) {
        $item_name = (isset($_POST['item_name'][$key]) ? $VALIDATION->input($_POST['item_name'][$key]) : "");
        $item_amount = (isset($_POST['item_amount'][$key]) ? $VALIDATION->input($_POST['item_amount'][$key]) : "");
        $item_unit = (isset($_POST['item_unit'][$key]) ? $VALIDATION->input($_POST['item_unit'][$key]) : "");
        $item_estimate = (isset($_POST['item_estimate'][$key]) ? $VALIDATION->input($_POST['item_estimate'][$key]) : "");

        $purchase_item_count = $PURCHASE->purchase_item_count([$request_id, $item_name, $item_amount, $item_unit, $item_estimate]);
        if (intval($purchase_item_count) === 0) {
          $PURCHASE->purchase_item_insert([$request_id, $item_name, $item_amount, $item_unit, $item_estimate]);
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
            $file_path = (__DIR__ . "/../../Publics/purchase/{$file_rename}");
            move_uploaded_file($file_tmp, $file_path);
          }
          if (in_array($file_extension, $file_image)) {
            $file_rename = "{$file_random}.webp";
            $file_path = (__DIR__ . "/../../Publics/purchase/{$file_rename}");
            $VALIDATION->image_upload($file_tmp, $file_path);
          }

          $purchase_file_count = $PURCHASE->purchase_file_count([$request_id, $file_rename]);
          if (intval($purchase_file_count) === 0) {
            $PURCHASE->purchase_file_insert([$request_id, $file_rename]);
          }
        }
      }
      $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/purchase");
    } else {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/purchase");
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "update") {
  try {
    $request_id = (isset($_POST['id']) ? $VALIDATION->input($_POST['id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $department_number = (isset($_POST['department_number']) ? $VALIDATION->input($_POST['department_number']) : "");
    $department = (isset($_POST['department']) ? $VALIDATION->input($_POST['department']) : "");
    $doc_date = (isset($_POST['doc_date']) ? $VALIDATION->input($_POST['doc_date']) : "");
    $doc_date = (!empty($doc_date) ? date("Y-m-d", strtotime(str_replace("/", "-", $doc_date))) : "");
    $po = (isset($_POST['po']) ? $VALIDATION->input($_POST['po']) : "");
    $date = (isset($_POST['date']) ? $VALIDATION->input($_POST['date']) : "");
    $date = (!empty($date) ? date("Y-m-d", strtotime(str_replace("/", "-", $date))) : "");
    $order_number = (isset($_POST['order_number']) ? $VALIDATION->input($_POST['order_number']) : "");
    $reference = (isset($_POST['reference']) ? $VALIDATION->input($_POST['reference']) : "");
    $objective = (isset($_POST['objective']) ? $VALIDATION->input($_POST['objective']) : "");
    $remark = (isset($_POST['remark']) ? $VALIDATION->input($_POST['remark']) : "");
    $PURCHASE->purchase_update([$department_number, $doc_date, $po, $department, $date, $order_number, $reference, $objective, $remark, $uuid]);

    foreach ($_POST['item__id'] as $key => $row) {
      $item__id = (isset($_POST['item__id'][$key]) ? $VALIDATION->input($_POST['item__id'][$key]) : "");
      $item__name = (isset($_POST['item__name'][$key]) ? $VALIDATION->input($_POST['item__name'][$key]) : "");
      $item__amount = (isset($_POST['item__amount'][$key]) ? $VALIDATION->input($_POST['item__amount'][$key]) : "");
      $item__unit = (isset($_POST['item__unit'][$key]) ? $VALIDATION->input($_POST['item__unit'][$key]) : "");
      $item__estimate = (isset($_POST['item__estimate'][$key]) ? $VALIDATION->input($_POST['item__estimate'][$key]) : "");

      $PURCHASE->purchase_item_update([$item__name, $item__amount, $item__unit, $item__estimate, $item__id]);
    }

    if (isset($_POST['item_name'])) {
      foreach ($_POST['item_name'] as $key => $row) {
        $item_name = (isset($_POST['item_name'][$key]) ? $VALIDATION->input($_POST['item_name'][$key]) : "");
        $item_amount = (isset($_POST['item_amount'][$key]) ? $VALIDATION->input($_POST['item_amount'][$key]) : "");
        $item_unit = (isset($_POST['item_unit'][$key]) ? $VALIDATION->input($_POST['item_unit'][$key]) : "");
        $item_estimate = (isset($_POST['item_estimate'][$key]) ? $VALIDATION->input($_POST['item_estimate'][$key]) : "");

        $purchase_item_count = $PURCHASE->purchase_item_count([$request_id, $item_name, $item_amount, $item_unit, $item_estimate]);
        if (!empty($item_name) && intval($purchase_item_count) === 0) {
          $PURCHASE->purchase_item_insert([$request_id, $item_name, $item_amount, $item_unit, $item_estimate]);
        }
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
          $file_path = (__DIR__ . "/../../Publics/purchase/{$file_rename}");
          move_uploaded_file($file_tmp, $file_path);
        }
        if (in_array($file_extension, $file_image)) {
          $file_rename = "{$file_random}.webp";
          $file_path = (__DIR__ . "/../../Publics/purchase/{$file_rename}");
          $VALIDATION->image_upload($file_tmp, $file_path);
        }

        $purchase_file_count = $PURCHASE->purchase_file_count([$request_id, $file_rename]);
        if (intval($purchase_file_count) === 0) {
          $PURCHASE->purchase_file_insert([$request_id, $file_rename]);
        }
      }
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/purchase/view/{$uuid}");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "approve") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $request_id = (isset($_POST['id']) ? $VALIDATION->input($_POST['id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $status = (isset($_POST['status']) ? $VALIDATION->input($_POST['status']) : "");
    $reason = (isset($_POST['reason']) ? $VALIDATION->input($_POST['reason']) : "");
    $action = (intval($status) === 1 ? 2 : 1);

    $PURCHASE->purchase_approve([$action, $status, $uuid]);
    $PURCHASE->purchase_remark_insert([$request_id, $login_id, $reason, $status]);

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/purchase");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "request-data") {
  try {
    $result = $PURCHASE->request_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "approve-data") {
  try {
    $result = $PURCHASE->approve_data();

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
      $PURCHASE->purchase_item_delete([$id]);
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
      $PURCHASE->purchase_file_delete([$id]);
      echo json_encode(200);
    } else {
      echo json_encode(500);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "order-view") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $order = $data['order'];
    $result = $PURCHASE->order_view([$order]);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
