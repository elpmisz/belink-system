<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\AdvanceClear;
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

$ADVANCE = new AdvanceClear();
$VALIDATION = new Validation();

if ($action === "create") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $department_number = (isset($_POST['department_number']) ? $VALIDATION->input($_POST['department_number']) : "");
    $doc_date = (isset($_POST['doc_date']) ? $VALIDATION->input($_POST['doc_date']) : "");
    $doc_date = (!empty($doc_date) ? DateTime::createFromFormat('d/m/Y', $doc_date)->format('Y-m-d') : "");
    $advance_number = (isset($_POST['advance_number']) ? $VALIDATION->input($_POST['advance_number']) : "");
    $amount = (isset($_POST['amount']) ? $VALIDATION->input($_POST['amount']) : "");
    $advance_last = $ADVANCE->advance_last();

    $advance_count = $ADVANCE->advance_count([$login_id, $department_number, $doc_date, $advance_number, $amount]);
    if (intval($advance_count) === 0) {
      $ADVANCE->advance_insert([$advance_last, $login_id, $department_number, $doc_date, $advance_number, $amount]);
      $request_id = $ADVANCE->last_insert_id();

      foreach ($_POST['expense_id'] as $key => $row) {
        $expense_id = (isset($_POST['expense_id'][$key]) ? $VALIDATION->input($_POST['expense_id'][$key]) : "");
        $item_text = (isset($_POST['item_text'][$key]) ? $VALIDATION->input($_POST['item_text'][$key]) : "");
        $item_amount = (isset($_POST['item_amount'][$key]) ? $VALIDATION->input($_POST['item_amount'][$key]) : "");
        $item_vat = (isset($_POST['item_vat'][$key]) ? $VALIDATION->input($_POST['item_vat'][$key]) : "");
        $item_wt = (isset($_POST['item_wt'][$key]) ? $VALIDATION->input($_POST['item_wt'][$key]) : "");

        $advance_item_count = $ADVANCE->advance_item_count([$request_id, $expense_id]);
        if (intval($advance_item_count) === 0) {
          $ADVANCE->advance_item_insert([$request_id, $expense_id, $item_text, $item_amount, $item_vat, $item_wt]);
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
            $file_path = (__DIR__ . "/../../Publics/advance-clear/{$file_rename}");
            move_uploaded_file($file_tmp, $file_path);
          }
          if (in_array($file_extension, $file_image)) {
            $file_rename = "{$file_random}.webp";
            $file_path = (__DIR__ . "/../../Publics/advance-clear/{$file_rename}");
            $VALIDATION->image_upload($file_tmp, $file_path);
          }

          $advance_file_count = $ADVANCE->advance_file_count([$request_id, $file_rename]);
          if (intval($advance_file_count) === 0) {
            $ADVANCE->advance_file_insert([$request_id, $file_rename]);
          }
        }
      }
      $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/advance-clear");
    } else {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/advance-clear");
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
    $doc_date = (isset($_POST['doc_date']) ? $VALIDATION->input($_POST['doc_date']) : "");
    $doc_date = (!empty($doc_date) ? DateTime::createFromFormat('d/m/Y', $doc_date)->format('Y-m-d') : "");
    $ADVANCE->advance_update([$department_number, $doc_date, $uuid]);

    foreach ($_POST['item__id'] as $key => $row) {
      $item__id = (isset($_POST['item__id'][$key]) ? $VALIDATION->input($_POST['item__id'][$key]) : "");
      $item__text = (isset($_POST['item__text'][$key]) ? $VALIDATION->input($_POST['item__text'][$key]) : "");
      $item__amount = (isset($_POST['item__amount'][$key]) ? $VALIDATION->input($_POST['item__amount'][$key]) : "");
      $item__vat = (isset($_POST['item__vat'][$key]) ? $VALIDATION->input($_POST['item__vat'][$key]) : "");
      $item__wt = (isset($_POST['item__wt'][$key]) ? $VALIDATION->input($_POST['item__wt'][$key]) : "");

      $ADVANCE->advance_item_update([$item__text, $item__amount, $item__vat, $item__wt, $item__id]);
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
          $file_path = (__DIR__ . "/../../Publics/advance-clear/{$file_rename}");
          move_uploaded_file($file_tmp, $file_path);
        }
        if (in_array($file_extension, $file_image)) {
          $file_rename = "{$file_random}.webp";
          $file_path = (__DIR__ . "/../../Publics/advance-clear/{$file_rename}");
          $VALIDATION->image_upload($file_tmp, $file_path);
        }

        $advance_file_count = $ADVANCE->advance_file_count([$request_id, $file_rename]);
        if (intval($advance_file_count) === 0) {
          $ADVANCE->advance_file_insert([$request_id, $file_rename]);
        }
      }
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/advance-clear/view/{$uuid}");
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

    $ADVANCE->advance_approve([$action, $status, $uuid]);
    $ADVANCE->advance_remark_insert([$request_id, $login_id, $reason, $status]);

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/advance-clear");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "request-data") {
  try {
    $result = $ADVANCE->request_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "approve-data") {
  try {
    $result = $ADVANCE->approve_data();

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
      $ADVANCE->advance_item_delete([$id]);
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
      $ADVANCE->advance_file_delete([$id]);
      echo json_encode(200);
    } else {
      echo json_encode(500);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "advance-amount") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $advance = (isset($data['advance']) ? $data['advance'] : "");
    $result = $ADVANCE->advance_amount([$advance]);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "advance-order") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $advance = (isset($data['advance']) ? $data['advance'] : "");
    $result = $ADVANCE->advance_order([$advance]);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "advance-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ADVANCE->advance_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
