<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Borrow;
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

$BORROW = new Borrow();
$VALIDATION = new Validation();

if ($action === "create") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
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
    $objective = (isset($_POST['objective']) ? $VALIDATION->input($_POST['objective']) : "");
    $borrow_last = $BORROW->borrow_last();

    $borrow_count = $BORROW->borrow_count([$login_id, $date, $event_date, $event_name, $objective]);
    if (intval($borrow_count) > 0) {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/borrow");
    }

    $BORROW->borrow_insert([$borrow_last, $login_id, $date, $event_date, $event_start, $event_end, $event_name, $sale, $location_start, $location_end, $objective]);
    $request_id = $BORROW->last_insert_id();

    foreach ($_POST['asset_id'] as $key => $row) {
      $asset_id = (isset($_POST['asset_id'][$key]) ? $VALIDATION->input($_POST['asset_id'][$key]) : "");
      $item_text = (isset($_POST['item_text'][$key]) ? $VALIDATION->input($_POST['item_text'][$key]) : "");

      $item_count = $BORROW->item_count([$request_id, $asset_id, $item_text]);
      if (intval($item_count) === 0) {
        $BORROW->item_insert([$request_id, $asset_id, $item_text]);
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
          $file_path = (__DIR__ . "/../../Publics/borrow/{$file_rename}");
          move_uploaded_file($file_tmp, $file_path);
        }
        if (in_array($file_extension, $file_image)) {
          $file_rename = "{$file_random}.webp";
          $file_path = (__DIR__ . "/../../Publics/borrow/{$file_rename}");
          $VALIDATION->image_upload($file_tmp, $file_path);
        }

        $file_count = $BORROW->file_count([$request_id, $file_rename]);
        if (intval($file_count) === 0) {
          $BORROW->file_insert([$request_id, $file_rename]);
        }
      }
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/borrow");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "update") {
  try {
    $request_id = (isset($_POST['id']) ? $VALIDATION->input($_POST['id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
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
    $objective = (isset($_POST['objective']) ? $VALIDATION->input($_POST['objective']) : "");
    $BORROW->borrow_update([$date, $event_date, $event_start, $event_end, $event_name, $sale, $location_start, $location_end, $objective, $uuid]);

    foreach ($_POST['item__id'] as $key => $row) {
      $item__id = (isset($_POST['item__id'][$key]) ? $VALIDATION->input($_POST['item__id'][$key]) : "");
      $item__text = (isset($_POST['item__text'][$key]) ? $VALIDATION->input($_POST['item__text'][$key]) : "");

      $BORROW->item_update([$item__text, $item__id]);
    }

    if (isset($_POST['asset_id'])) {
      foreach ($_POST['asset_id'] as $key => $row) {
        $asset_id = (isset($_POST['asset_id'][$key]) ? $VALIDATION->input($_POST['asset_id'][$key]) : "");
        $item_text = (isset($_POST['item_text'][$key]) ? $VALIDATION->input($_POST['item_text'][$key]) : "");

        $item_count = $BORROW->item_count([$request_id, $asset_id, $item_text]);
        if (intval($item_count) === 0) {
          $BORROW->item_insert([$request_id, $asset_id, $item_text]);
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
          $file_path = (__DIR__ . "/../../Publics/borrow/{$file_rename}");
          move_uploaded_file($file_tmp, $file_path);
        }
        if (in_array($file_extension, $file_image)) {
          $file_rename = "{$file_random}.webp";
          $file_path = (__DIR__ . "/../../Publics/borrow/{$file_rename}");
          $VALIDATION->image_upload($file_tmp, $file_path);
        }

        $file_count = $BORROW->file_count([$request_id, $file_rename]);
        if (intval($file_count) === 0) {
          $BORROW->file_insert([$request_id, $file_rename]);
        }
      }
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/borrow/view/{$uuid}");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "process") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $request_id = (isset($_POST['id']) ? $VALIDATION->input($_POST['id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $date = (isset($_POST['date']) ? $VALIDATION->input($_POST['date']) : "");
    $date = (!empty($date) ? date("Y-m-d", strtotime(str_replace("/", "-", trim($date)))) : "");
    $status = (isset($_POST['status']) ? $VALIDATION->input($_POST['status']) : "");
    $reason = (isset($_POST['reason']) ? $VALIDATION->input($_POST['reason']) : "");

    $BORROW->borrow_process([$status, $uuid]);
    $BORROW->remark_insert([$request_id, $login_id, $date, $reason, $status]);

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/borrow");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "request-data") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $result = $BORROW->request_data($login_id);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "process-data") {
  try {
    $result = $BORROW->process_data();

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
    $result = $BORROW->manage_data($start, $end, $user);

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
      $BORROW->item_delete([$id]);
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
      $BORROW->file_delete([$id]);
      echo json_encode(200);
    } else {
      echo json_encode(500);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "item-view") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $asset = (isset($data['asset']) ? $data['asset'] : "");
    $result = $BORROW->asset_view([$asset]);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "asset-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $BORROW->asset_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "user-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $BORROW->user_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
