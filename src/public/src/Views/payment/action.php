<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Payment;
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

$PAYMENT = new Payment();
$VALIDATION = new Validation();

if ($action === "create") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $department_number = (isset($_POST['department_number']) ? $VALIDATION->input($_POST['department_number']) : "");
    $doc_date = (isset($_POST['doc_date']) ? $VALIDATION->input($_POST['doc_date']) : "");
    $doc_date = (!empty($doc_date) ? DateTime::createFromFormat('d/m/Y', $doc_date)->format('Y-m-d') : "");
    $order_number = (isset($_POST['order_number']) ? $VALIDATION->input($_POST['order_number']) : "");
    $purchase_number = (isset($_POST['purchase_number']) ? $VALIDATION->input($_POST['purchase_number']) : "");
    $receiver = (isset($_POST['receiver']) ? $VALIDATION->input($_POST['receiver']) : "");
    $type = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
    $cheque_bank = (isset($_POST['cheque_bank']) ? $VALIDATION->input($_POST['cheque_bank']) : "");
    $cheque_branch = (isset($_POST['cheque_branch']) ? $VALIDATION->input($_POST['cheque_branch']) : "");
    $cheque_number = (isset($_POST['cheque_number']) ? $VALIDATION->input($_POST['cheque_number']) : "");
    $cheque_date = (isset($_POST['cheque_date']) ? $VALIDATION->input($_POST['cheque_date']) : "");
    $cheque_date = (!empty($cheque_date) ? date("Y-m-d", strtotime(str_replace("/", "-", $cheque_date))) : "");
    $payment_last = $PAYMENT->payment_last();

    $payment_count = $PAYMENT->payment_count([$login_id, $department_number, $doc_date, $order_number, $purchase_number, $receiver, $type, $cheque_bank, $cheque_branch, $cheque_number, $cheque_date]);

    if (intval($payment_count) === 0) {
      $PAYMENT->payment_insert([$payment_last, $login_id, $department_number, $doc_date, $order_number, $purchase_number, $receiver, $type, $cheque_bank, $cheque_branch, $cheque_number, $cheque_date]);
      $request_id = $PAYMENT->last_insert_id();

      foreach ($_POST['expense_id'] as $key => $row) {
        $expense_id = (isset($_POST['expense_id'][$key]) ? $VALIDATION->input($_POST['expense_id'][$key]) : "");
        $item_text = (isset($_POST['item_text'][$key]) ? $VALIDATION->input($_POST['item_text'][$key]) : "");
        $item_text2 = (isset($_POST['item_text2'][$key]) ? $VALIDATION->input($_POST['item_text2'][$key]) : "");
        $item_amount = (isset($_POST['item_amount'][$key]) ? $VALIDATION->input($_POST['item_amount'][$key]) : "");
        $item_vat = (isset($_POST['item_vat'][$key]) ? $VALIDATION->input($_POST['item_vat'][$key]) : "");
        $item_wt = (isset($_POST['item_wt'][$key]) ? $VALIDATION->input($_POST['item_wt'][$key]) : "");

        $payment_item_count = $PAYMENT->payment_item_count([$request_id, $expense_id, $item_text, $item_text2, $item_amount]);
        if (!empty($expense_id) && intval($payment_item_count) === 0 && !empty($item_text) && !empty($item_text2) && !empty($item_amount)) {
          $PAYMENT->payment_item_insert([$request_id, $expense_id, $item_text, $item_text2, $item_amount, $item_vat, $item_wt]);
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
            $file_path = (__DIR__ . "/../../Publics/payment/{$file_rename}");
            move_uploaded_file($file_tmp, $file_path);
          }
          if (in_array($file_extension, $file_image)) {
            $file_rename = "{$file_random}.webp";
            $file_path = (__DIR__ . "/../../Publics/payment/{$file_rename}");
            $VALIDATION->image_upload($file_tmp, $file_path);
          }

          $payment_file_count = $PAYMENT->payment_file_count([$request_id, $file_rename]);
          if (intval($payment_file_count) === 0) {
            $PAYMENT->payment_file_insert([$request_id, $file_rename]);
          }
        }
      }
      $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/payment");
    } else {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/payment");
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
    $receiver = (isset($_POST['receiver']) ? $VALIDATION->input($_POST['receiver']) : "");
    $cheque_bank = (isset($_POST['cheque_bank']) ? $VALIDATION->input($_POST['cheque_bank']) : "");
    $cheque_branch = (isset($_POST['cheque_branch']) ? $VALIDATION->input($_POST['cheque_branch']) : "");
    $cheque_number = (isset($_POST['cheque_number']) ? $VALIDATION->input($_POST['cheque_number']) : "");
    $cheque_date = (isset($_POST['cheque_date']) ? $VALIDATION->input($_POST['cheque_date']) : "");
    $cheque_date = (!empty($cheque_date) ? date("Y-m-d", strtotime(str_replace("/", "-", $cheque_date))) : "");
    $PAYMENT->payment_update([$doc_date, $receiver, $cheque_bank, $cheque_branch, $cheque_number, $cheque_date, $uuid]);

    if (isset($_POST['expense_id'])) {
      foreach ($_POST['expense_id'] as $key => $row) {
        $expense_id = (isset($_POST['expense_id'][$key]) ? $VALIDATION->input($_POST['expense_id'][$key]) : "");
        $item_text = (isset($_POST['item_text'][$key]) ? $VALIDATION->input($_POST['item_text'][$key]) : "");
        $item_text2 = (isset($_POST['item_text2'][$key]) ? $VALIDATION->input($_POST['item_text2'][$key]) : "");
        $item_amount = (isset($_POST['item_amount'][$key]) ? $VALIDATION->input($_POST['item_amount'][$key]) : "");
        $item_vat = (isset($_POST['item_vat'][$key]) ? $VALIDATION->input($_POST['item_vat'][$key]) : "");
        $item_wt = (isset($_POST['item_wt'][$key]) ? $VALIDATION->input($_POST['item_wt'][$key]) : "");

        $payment_item_count = $PAYMENT->payment_item_count([$request_id, $expense_id, $item_text, $item_text2, $item_amount]);
        if (!empty($expense_id) && intval($payment_item_count) === 0) {
          $PAYMENT->payment_item_insert([$request_id, $expense_id, $item_text, $item_text2, $item_amount, $item_vat, $item_wt]);
        }
      }
    }

    if (isset($_FILES['file']['name'])) {
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
            $file_path = (__DIR__ . "/../../Publics/payment/{$file_rename}");
            move_uploaded_file($file_tmp, $file_path);
          }
          if (in_array($file_extension, $file_image)) {
            $file_rename = "{$file_random}.webp";
            $file_path = (__DIR__ . "/../../Publics/payment/{$file_rename}");
            $VALIDATION->image_upload($file_tmp, $file_path);
          }

          $payment_file_count = $PAYMENT->payment_file_count([$request_id, $file_rename]);
          if (intval($payment_file_count) === 0) {
            $PAYMENT->payment_file_insert([$request_id, $file_rename]);
          }
        }
      }
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/payment/view/{$uuid}");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "request-data") {
  try {
    $result = $PAYMENT->request_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "check-data") {
  try {
    $result = $PAYMENT->check_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "account-data") {
  try {
    $result = $PAYMENT->account_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "approve-data") {
  try {
    $result = $PAYMENT->approve_data();

    echo json_encode($result);
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

    $PAYMENT->payment_approve([$action, $status, $uuid]);
    $PAYMENT->payment_remark_insert([$request_id, $login_id, $reason, $status]);

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/payment");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "item-delete") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    if (!empty($id)) {
      $PAYMENT->payment_item_delete([$id]);
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
      $PAYMENT->payment_file_delete([$id]);
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
    $expense = $data['expense'];
    $order = $data['order'];
    $purchase = $data['purchase'];
    $result = $PAYMENT->order_view($expense, $order, $purchase);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === 'get-expense') {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $order = (isset($data['order']) ? $data['order'] : "");
    $purchase = (isset($data['purchase']) ? $data['purchase'] : "");
    $result = $PAYMENT->get_expense($order, $purchase);

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === 'expense-select') {
  try {
    $keyword = (isset($_POST['keyword']) ? $VALIDATION->input($_POST['keyword']) : "");
    $order = (isset($_POST['order']) ? $VALIDATION->input($_POST['order']) : "");
    $purchase = (isset($_POST['purchase']) ? $VALIDATION->input($_POST['purchase']) : "");
    if (!empty($order) || !empty($purchase)) {
      $result = $PAYMENT->expense_order_select($keyword, $order, $purchase);
    } else {
      $result = $PAYMENT->expense_select($keyword, $order);
    }

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
