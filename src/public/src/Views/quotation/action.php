<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Quotation;
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

$QUOTATION = new Quotation();
$VALIDATION = new Validation();

if ($action === "create") {
  try {
    $login_id = (isset($user['login_id']) ? $VALIDATION->input($user['login_id']) : "");
    $doc_date = (isset($_POST['doc_date']) ? $VALIDATION->input($_POST['doc_date']) : "");
    $doc_date = (!empty($doc_date) ? DateTime::createFromFormat('d/m/Y', $doc_date)->format('Y-m-d') : "");
    $biller = (isset($_POST['biller']) ? $VALIDATION->input($_POST['biller']) : "");
    $customer_type = (isset($_POST['customer_type']) ? $VALIDATION->input($_POST['customer_type']) : "");
    $customer_id = (isset($_POST['customer_id']) ? $VALIDATION->input($_POST['customer_id']) : "");
    $customer_name = (isset($_POST['customer_name']) ? $VALIDATION->input($_POST['customer_name']) : "");
    $customer_address = (isset($_POST['customer_address']) ? $VALIDATION->input($_POST['customer_address']) : "");
    $text = (isset($_POST['text']) ? $VALIDATION->input($_POST['text']) : "");
    $quotation_last = $QUOTATION->quotation_last();

    $quotation_count = $QUOTATION->quotation_count([$login_id, $doc_date, $biller, $customer_id, $customer_name, $customer_address, $text]);
    if (intval($quotation_count) === 0) {
      $QUOTATION->quotation_insert([$quotation_last, $login_id, $doc_date, $biller, $customer_type, $customer_id, $customer_name, $customer_address, $text]);
      $request_id = $QUOTATION->last_insert_id();

      foreach ($_POST['item_product'] as $key => $row) {
        $item_product = (isset($_POST['item_product'][$key]) ? $VALIDATION->input($_POST['item_product'][$key]) : "");
        $item_price = (isset($_POST['item_price'][$key]) ? $VALIDATION->input($_POST['item_price'][$key]) : "");
        $item_discount = (isset($_POST['item_discount'][$key]) ? $VALIDATION->input($_POST['item_discount'][$key]) : "");
        $item_amount = (isset($_POST['item_amount'][$key]) ? $VALIDATION->input($_POST['item_amount'][$key]) : "");

        $quotation_item_count = $QUOTATION->quotation_item_count([$request_id, $item_product, $item_price, $item_discount, $item_amount]);
        if (intval($quotation_item_count) === 0) {
          $QUOTATION->quotation_item_insert([$request_id, $item_product, $item_price, $item_discount, $item_amount]);
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
              $file_path = (__DIR__ . "/../../Publics/quotation/{$file_rename}");
              move_uploaded_file($file_tmp, $file_path);
            }
            if (in_array($file_extension, $file_image)) {
              $file_rename = "{$file_random}.webp";
              $file_path = (__DIR__ . "/../../Publics/quotation/{$file_rename}");
              $VALIDATION->image_upload($file_tmp, $file_path);
            }

            $quotation_file_count = $QUOTATION->quotation_file_count([$request_id, $file_rename]);
            if (intval($quotation_file_count) === 0) {
              $QUOTATION->quotation_file_insert([$request_id, $file_rename]);
            }
          }
        }
      }

      $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/quotation");
    } else {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/quotation");
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "update") {
  try {
    $request_id = (isset($_POST['id']) ? $VALIDATION->input($_POST['id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $doc_date = (isset($_POST['doc_date']) ? $VALIDATION->input($_POST['doc_date']) : "");
    $doc_date = (!empty($doc_date) ? DateTime::createFromFormat('d/m/Y', $doc_date)->format('Y-m-d') : "");
    $biller = (isset($_POST['biller']) ? $VALIDATION->input($_POST['biller']) : "");
    $customer_id = (isset($_POST['customer_id']) ? $VALIDATION->input($_POST['customer_id']) : "");
    $customer_name = (isset($_POST['customer_name']) ? $VALIDATION->input($_POST['customer_name']) : "");
    $customer_address = (isset($_POST['customer_address']) ? $VALIDATION->input($_POST['customer_address']) : "");
    $text = (isset($_POST['text']) ? $VALIDATION->input($_POST['text']) : "");
    $QUOTATION->quotation_update([$doc_date, $biller, $customer_id, $customer_name, $customer_address, $text, $uuid]);

    foreach ($_POST['item__id'] as $key => $row) {
      $item__id = (isset($_POST['item__id'][$key]) ? $VALIDATION->input($_POST['item__id'][$key]) : "");
      $item__product = (isset($_POST['item__product'][$key]) ? $VALIDATION->input($_POST['item__product'][$key]) : "");
      $item__price = (isset($_POST['item__price'][$key]) ? $VALIDATION->input($_POST['item__price'][$key]) : "");
      $item__discount = (isset($_POST['item__discount'][$key]) ? $VALIDATION->input($_POST['item__discount'][$key]) : "");
      $item__amount = (isset($_POST['item__amount'][$key]) ? $VALIDATION->input($_POST['item__amount'][$key]) : "");

      $QUOTATION->quotation_item_update([$item__product, $item__price, $item__discount, $item__amount, $item__id]);
    }

    if (isset($_POST['item_product'])) {
      foreach ($_POST['item_product'] as $key => $row) {
        $item_product = (isset($_POST['item_product'][$key]) ? $VALIDATION->input($_POST['item_product'][$key]) : "");
        $item_price = (isset($_POST['item_price'][$key]) ? $VALIDATION->input($_POST['item_price'][$key]) : "");
        $item_discount = (isset($_POST['item_discount'][$key]) ? $VALIDATION->input($_POST['item_discount'][$key]) : "");
        $item_amount = (isset($_POST['item_amount'][$key]) ? $VALIDATION->input($_POST['item_amount'][$key]) : "");

        $quotation_item_count = $QUOTATION->quotation_item_count([$request_id, $item_product, $item_price, $item_discount, $item_amount]);
        if (intval($quotation_item_count) === 0) {
          $QUOTATION->quotation_item_insert([$request_id, $item_product, $item_price, $item_discount, $item_amount]);
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
            $file_path = (__DIR__ . "/../../Publics/quotation/{$file_rename}");
            move_uploaded_file($file_tmp, $file_path);
          }
          if (in_array($file_extension, $file_image)) {
            $file_rename = "{$file_random}.webp";
            $file_path = (__DIR__ . "/../../Publics/quotation/{$file_rename}");
            $VALIDATION->image_upload($file_tmp, $file_path);
          }

          $quotation_file_count = $QUOTATION->quotation_file_count([$request_id, $file_rename]);
          if (intval($quotation_file_count) === 0) {
            $QUOTATION->quotation_file_insert([$request_id, $file_rename]);
          }
        }
      }
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/quotation/view/{$uuid}");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "request-data") {
  try {
    $result = $QUOTATION->request_data();

    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "address-view") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $customer = $data['customer'];
    $result = $QUOTATION->biller_view([$customer]);

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
      $QUOTATION->quotation_item_delete([$id]);
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
      $QUOTATION->quotation_file_delete([$id]);
      echo json_encode(200);
    } else {
      echo json_encode(500);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
