<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Estimate;
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

$ESTIMATE = new Estimate();
$VALIDATION = new Validation();

if ($action === "estimate-create") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $customer_id = (isset($_POST['customer_id']) ? $VALIDATION->input($_POST['customer_id']) : "");
    $department_number = (isset($_POST['department_number']) ? $VALIDATION->input($_POST['department_number']) : "");
    $doc_date = (isset($_POST['doc_date']) ? $VALIDATION->input($_POST['doc_date']) : "");
    $doc_date = (!empty($doc_date) ? DateTime::createFromFormat('d/m/Y', $doc_date)->format('Y-m-d') : "");
    $order_number = (isset($_POST['order_number']) ? $VALIDATION->input($_POST['order_number']) : "");
    $product_name = (isset($_POST['product_name']) ? $VALIDATION->input($_POST['product_name']) : "");
    $title_name = (isset($_POST['title_name']) ? $VALIDATION->input($_POST['title_name']) : "");
    $sales_name = (isset($_POST['sales_name']) ? $VALIDATION->input($_POST['sales_name']) : "");
    $budget = (isset($_POST['budget']) ? $VALIDATION->input($_POST['budget']) : "");
    $type = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
    $remark = (isset($_POST['remark']) ? $VALIDATION->input($_POST['remark']) : "");
    $estimate_last = $ESTIMATE->estimate_last();

    $estimate_count = $ESTIMATE->estimate_count([$login_id, $department_number, $customer_id, $doc_date, $order_number, $product_name, $title_name, $sales_name, $budget, $type, $remark]);
    if (intval($estimate_count) > 0) {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/estimate");
    }

    $ESTIMATE->estimate_insert([$estimate_last, $login_id, $department_number, $customer_id, $doc_date, $order_number, $product_name, $title_name, $sales_name, $budget, $type, $remark]);
    $request_id = $ESTIMATE->last_insert_id();

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
          $file_path = (__DIR__ . "/../../Publics/estimate/{$file_rename}");
          move_uploaded_file($file_tmp, $file_path);
        }
        if (in_array($file_extension, $file_image)) {
          $file_rename = "{$file_random}.webp";
          $file_path = (__DIR__ . "/../../Publics/estimate/{$file_rename}");
          $VALIDATION->image_upload($file_tmp, $file_path);
        }

        $estimate_file_count = $ESTIMATE->estimate_file_count([$request_id, $file_rename]);
        if (intval($estimate_file_count) === 0) {
          $ESTIMATE->estimate_file_insert([$request_id, $file_rename]);
        }
      }
    }
    
    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/estimate");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "estimate-update") {
  try {
    $request_id = (isset($_POST['id']) ? $VALIDATION->input($_POST['id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $department_number = (isset($_POST['department_number']) ? $VALIDATION->input($_POST['department_number']) : "");
    $customer_id = (isset($_POST['customer_id']) ? $VALIDATION->input($_POST['customer_id']) : "");
    $doc_date = (isset($_POST['doc_date']) ? $VALIDATION->input($_POST['doc_date']) : "");
    $doc_date = (!empty($doc_date) ? DateTime::createFromFormat('d/m/Y', $doc_date)->format('Y-m-d') : "");
    $order_number = (isset($_POST['order_number']) ? $VALIDATION->input($_POST['order_number']) : "");
    $product_name = (isset($_POST['product_name']) ? $VALIDATION->input($_POST['product_name']) : "");
    $title_name = (isset($_POST['title_name']) ? $VALIDATION->input($_POST['title_name']) : "");
    $sales_name = (isset($_POST['sales_name']) ? $VALIDATION->input($_POST['sales_name']) : "");
    $budget = (isset($_POST['budget']) ? $VALIDATION->input($_POST['budget']) : "");
    $type = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
    $remark = (isset($_POST['remark']) ? $VALIDATION->input($_POST['remark']) : "");

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
          $file_path = (__DIR__ . "/../../Publics/estimate/{$file_rename}");
          move_uploaded_file($file_tmp, $file_path);
        }
        if (in_array($file_extension, $file_image)) {
          $file_rename = "{$file_random}.webp";
          $file_path = (__DIR__ . "/../../Publics/estimate/{$file_rename}");
          $VALIDATION->image_upload($file_tmp, $file_path);
        }

        $estimate_file_count = $ESTIMATE->estimate_file_count([$request_id, $file_rename]);
        if (intval($estimate_file_count) === 0) {
          $ESTIMATE->estimate_file_insert([$request_id, $file_rename]);
        }
      }
    }

    $ESTIMATE->estimate_update([$department_number, $customer_id, $doc_date, $order_number, $product_name, $title_name, $sales_name, $budget, $type, $remark, $uuid]);

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/estimate/view/{$uuid}");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "sale-update") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $request_id = (isset($_POST['id']) ? $VALIDATION->input($_POST['id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $status = 2;
    $reason = (isset($_POST['reason']) ? $VALIDATION->input($_POST['reason']) : "");
    $action = (intval($status) === 1 ? 2 : 1);

    foreach ($_POST['item_expense'] as $key => $row) {
      $item_expense = (isset($_POST['item_expense'][$key]) ? $VALIDATION->input($_POST['item_expense'][$key]) : "");
      $item_estimate = (isset($_POST['item_estimate'][$key]) ? $VALIDATION->input($_POST['item_estimate'][$key]) : "");

      $estimate_item_count = $ESTIMATE->estimate_item_count([$request_id, $item_expense, $item_estimate]);
      if (intval($estimate_item_count) === 0) {
        $ESTIMATE->estimate_item_insert([$request_id, $item_expense, $item_estimate]);
      }
    }

    $ESTIMATE->estimate_approve([$action, $status, $uuid]);
    $ESTIMATE->estimate_remark_insert([$request_id, $login_id, $reason, $status]);

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/estimate");
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

    $ESTIMATE->estimate_approve([$action, $status, $uuid]);
    $ESTIMATE->estimate_remark_insert([$request_id, $login_id, $reason, $status]);

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/estimate");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "request-data") {
  try {
    $result = $ESTIMATE->request_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "event-data") {
  try {
    $result = $ESTIMATE->approve_data(1);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "budget-data") {
  try {
    $result = $ESTIMATE->approve_data(2);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "approve-data") {
  try {
    $result = $ESTIMATE->approve_data(3);

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
      $ESTIMATE->estimate_item_delete([$id]);
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
      $ESTIMATE->estimate_file_delete([$id]);
      echo json_encode(200);
    } else {
      echo json_encode(500);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "customer-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ESTIMATE->customer_select($keyword);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "expense-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ESTIMATE->expense_select($keyword);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
