<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Issue;
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

$ISSUE = new Issue();
$VALIDATION = new Validation();

if ($action === "create") {
  $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
  $type = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
  $date = (isset($_POST['date']) ? $VALIDATION->input($_POST['date']) : "");
  $date = (!empty($date) ? date("Y-m-d", strtotime(str_replace("/", "-", trim($date)))) : "");
  $event_date = (isset($_POST['event_date']) ? $VALIDATION->input($_POST['event_date']) : "");
  $event_date_array = (!empty($event_date) ? explode(" - ", $event_date) : "");
  $event_start = (!empty($event_date) ? DateTime::createFromFormat('d/m/Y', $event_date_array[0])->format('Y-m-d') : "");
  $event_end = (!empty($event_date) ? DateTime::createFromFormat('d/m/Y', $event_date_array[1])->format('Y-m-d') : "");
  $event_name = (isset($_POST['event_name']) ? $VALIDATION->input($_POST['event_name']) : "");
  $sale = (isset($_POST['sale']) ? $VALIDATION->input($_POST['sale']) : "");
  $location_start = (isset($_POST['location_start']) ? $VALIDATION->input($_POST['location_start']) : "");
  $location_end = (isset($_POST['location_end']) ? $VALIDATION->input($_POST['location_end']) : "");
  $outcome = (isset($_POST['outcome']) ? $VALIDATION->input($_POST['outcome']) : "");
  $text = (isset($_POST['text']) ? $VALIDATION->input($_POST['text']) : "");
  $issue_last = $ISSUE->issue_last();

  $issue_count = $ISSUE->issue_count([$login_id, $type, $date, $text]);
  if (intval($issue_count) > 0) {
    $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/issue");
  }

  $ISSUE->issue_insert([$issue_last, $login_id, $type, $date, $event_date, $event_start, $event_end, $event_name, $sale, $location_start, $location_end, $outcome, $text]);
  $request_id = $ISSUE->last_insert_id();

  foreach ($_POST['product_id'] as $key => $row) {
    $product_id = (isset($_POST['product_id'][$key]) ? $VALIDATION->input($_POST['product_id'][$key]) : "");
    $warehouse_id = (isset($_POST['warehouse_id'][$key]) ? $VALIDATION->input($_POST['warehouse_id'][$key]) : "");
    $item_amount = (isset($_POST['item_amount'][$key]) ? $VALIDATION->input($_POST['item_amount'][$key]) : "");

    $item_count = $ISSUE->item_count([$request_id, $product_id, $warehouse_id, $type, $item_amount]);
    if (intval($item_count) === 0) {
      $ISSUE->item_insert([$request_id, $product_id, $warehouse_id, $type, $item_amount]);
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
        $file_path = (__DIR__ . "/../../Publics/issue/{$file_rename}");
        move_uploaded_file($file_tmp, $file_path);
      }
      if (in_array($file_extension, $file_image)) {
        $file_rename = "{$file_random}.webp";
        $file_path = (__DIR__ . "/../../Publics/issue/{$file_rename}");
        $VALIDATION->image_upload($file_tmp, $file_path);
      }

      $file_count = $ISSUE->file_count([$request_id, $file_rename]);
      if (intval($file_count) === 0) {
        $ISSUE->file_insert([$request_id, $file_rename]);
      }
    }
  }

  $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/issue");
}

if ($action === "update") {
  try {
    $request_id = (isset($_POST['id']) ? $VALIDATION->input($_POST['id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $type = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
    $date = (isset($_POST['date']) ? $VALIDATION->input($_POST['date']) : "");
    $date = (!empty($date) ? date("Y-m-d", strtotime(str_replace("/", "-", trim($date)))) : "");
    $event_date = (isset($_POST['event_date']) ? $VALIDATION->input($_POST['event_date']) : "");
    $event_date_array = (!empty($event_date) ? explode(" - ", $event_date) : "");
    $event_start = (!empty($event_date) ? DateTime::createFromFormat('d/m/Y', $event_date_array[0])->format('Y-m-d') : "");
    $event_end = (!empty($event_date) ? DateTime::createFromFormat('d/m/Y', $event_date_array[1])->format('Y-m-d') : "");
    $event_name = (isset($_POST['event_name']) ? $VALIDATION->input($_POST['event_name']) : "");
    $sale = (isset($_POST['sale']) ? $VALIDATION->input($_POST['sale']) : "");
    $location_start = (isset($_POST['location_start']) ? $VALIDATION->input($_POST['location_start']) : "");
    $location_end = (isset($_POST['location_end']) ? $VALIDATION->input($_POST['location_end']) : "");
    $outcome = (isset($_POST['outcome']) ? $VALIDATION->input($_POST['outcome']) : "");
    $text = (isset($_POST['text']) ? $VALIDATION->input($_POST['text']) : "");

    $ISSUE->issue_update([$date, $event_date, $event_start, $event_end, $event_name, $sale, $location_start, $location_end, $outcome, $text, $uuid]);

    foreach ($_POST['item__id'] as $key => $row) {
      $item__id = (isset($_POST['item__id'][$key]) ? $VALIDATION->input($_POST['item__id'][$key]) : "");
      $item__amount = (isset($_POST['item__amount'][$key]) ? $VALIDATION->input($_POST['item__amount'][$key]) : "");

      $ISSUE->item_update([$item__amount, $item__id]);
    }

    if (isset($_POST['product_id'])) {
      foreach ($_POST['product_id'] as $key => $row) {
        $product_id = (isset($_POST['product_id'][$key]) ? $VALIDATION->input($_POST['product_id'][$key]) : "");
        $warehouse_id = (isset($_POST['warehouse_id'][$key]) ? $VALIDATION->input($_POST['warehouse_id'][$key]) : "");
        $item_amount = (isset($_POST['item_amount'][$key]) ? $VALIDATION->input($_POST['item_amount'][$key]) : "");

        $item_count = $ISSUE->item_count([$request_id, $product_id, $warehouse_id, $type, $item_amount]);
        if (intval($item_count) === 0) {
          $ISSUE->item_insert([$request_id, $product_id, $warehouse_id, $type, $item_amount]);
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
          $file_path = (__DIR__ . "/../../Publics/issue/{$file_rename}");
          move_uploaded_file($file_tmp, $file_path);
        }
        if (in_array($file_extension, $file_image)) {
          $file_rename = "{$file_random}.webp";
          $file_path = (__DIR__ . "/../../Publics/issue/{$file_rename}");
          $VALIDATION->image_upload($file_tmp, $file_path);
        }

        $file_count = $ISSUE->file_count([$request_id, $file_rename]);
        if (intval($file_count) === 0) {
          $ISSUE->file_insert([$request_id, $file_rename]);
        }
      }
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/issue/view/{$uuid}");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "approve") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $request_id = (isset($_POST['id']) ? $VALIDATION->input($_POST['id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $type = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
    $reason = "ผ่านการตรวจสอบ";
    $status = 2;

    foreach ($_POST['item__id'] as $key => $row) {
      $item__id = (isset($_POST['item__id'][$key]) ? $VALIDATION->input($_POST['item__id'][$key]) : "");
      $item__confirm = (isset($_POST['item__confirm'][$key]) ? $VALIDATION->input($_POST['item__confirm'][$key]) : "");

      $ISSUE->item_confirm([$item__confirm, $item__id]);
    }

    $ISSUE->issue_approve([$status, $uuid]);
    $ISSUE->remark_insert([$request_id, $login_id, $reason, $status]);

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/issue");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "item-delete") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    if (!empty($id)) {
      $ISSUE->item_delete([$id]);
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
      $ISSUE->file_delete([$id]);
      echo json_encode(200);
    } else {
      echo json_encode(500);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "request-data") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $result = $ISSUE->request_data($login_id);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "approve-data") {
  try {
    $result = $ISSUE->approve_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "manage-data") {
  try {
    $date = (isset($_POST['date']) ? explode(" - ", $_POST['date']) : '');
    $start = (!empty($date[0]) ? DateTime::createFromFormat('d/m/Y', trim($date[0]))->format('Y-m-d') : "");
    $end = (!empty($date[1]) ? DateTime::createFromFormat('d/m/Y', trim($date[1]))->format('Y-m-d') : "");
    $user = (isset($_POST['user']) ? $_POST['user'] : '');
    $type = (isset($_POST['type']) ? $_POST['type'] : '');
    $result = $ISSUE->manage_data($start, $end, $user, $type);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "product-remain") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $product = (isset($data['product']) ? $data['product'] : "");
    $warehouse = (isset($data['warehouse']) ? $data['warehouse'] : "");
    $result = $ISSUE->product_remain([$warehouse, $product]);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "product-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ISSUE->product_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "product-stock-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ISSUE->product_stock_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "warehouse-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ISSUE->warehouse_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "outcome-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ISSUE->outcome_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "user-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ISSUE->user_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "type-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ISSUE->type_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
