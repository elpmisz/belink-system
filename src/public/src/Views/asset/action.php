<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/../../../vendor/autoload.php");

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

use App\Classes\Asset;
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

$ASSET = new Asset();
$VALIDATION = new Validation();

if ($action === "create") {
  try {
    $name = (isset($_POST['name']) ? $VALIDATION->input($_POST['name']) : "");
    $code = (isset($_POST['code']) ? $VALIDATION->input($_POST['code']) : "");
    $type_id = (isset($_POST['type_id']) ? $VALIDATION->input($_POST['type_id']) : "");
    $warehouse_id = (isset($_POST['warehouse_id']) ? $VALIDATION->input($_POST['warehouse_id']) : "");
    $location_id = (isset($_POST['location_id']) ? $VALIDATION->input($_POST['location_id']) : "");
    $brand_id = (isset($_POST['brand_id']) ? $VALIDATION->input($_POST['brand_id']) : "");
    $unit_id = (isset($_POST['unit_id']) ? $VALIDATION->input($_POST['unit_id']) : "");
    $size = (isset($_POST['size']) ? $VALIDATION->input($_POST['size']) : "");
    $material = (isset($_POST['material']) ? $VALIDATION->input($_POST['material']) : "");
    $text = (isset($_POST['text']) ? $VALIDATION->input($_POST['text']) : "");

    $asset_count = $ASSET->asset_count([$name, $code, $type_id, $warehouse_id, $location_id, $brand_id, $unit_id, $size, $material]);
    if (intval($asset_count) > 0) {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/asset");
    }

    $ASSET->asset_insert([$name, $code, $type_id, $warehouse_id, $location_id, $brand_id, $unit_id, $size, $material, $text]);
    $asset_id = $ASSET->last_insert_id();

    foreach ($_FILES['file']['name'] as $key => $row) {
      $file_name = (isset($_FILES['file']['name']) ? $_FILES['file']['name'][$key] : "");
      $file_tmp = (isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'][$key] : "");
      $file_random = md5(microtime());
      $file_image = ["png", "jpeg", "jpg"];
      $file_document = ["pdf", "doc", "docx", "xls", "xlsx"];
      $file_allow = array_merge($file_image);
      $file_extension = pathinfo(strtolower($file_name), PATHINFO_EXTENSION);

      if (!empty($file_name) && in_array($file_extension, $file_allow)) {
        if (in_array($file_extension, $file_document)) {
          $file_rename = "{$file_random}.{$file_extension}";
          $file_path = (__DIR__ . "/../../Publics/asset/{$file_rename}");
          move_uploaded_file($file_tmp, $file_path);
        }
        if (in_array($file_extension, $file_image)) {
          $file_rename = "{$file_random}.webp";
          $file_path = (__DIR__ . "/../../Publics/asset/{$file_rename}");
          $VALIDATION->image_upload($file_tmp, $file_path);
        }
        $ASSET->file_create([$asset_id, $file_rename]);
      }
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/asset");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "update") {
  try {
    $asset_id = (isset($_POST['id']) ? $VALIDATION->input($_POST['id']) : "");
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $name = (isset($_POST['name']) ? $VALIDATION->input($_POST['name']) : "");
    $code = (isset($_POST['code']) ? $VALIDATION->input($_POST['code']) : "");
    $type_id = (isset($_POST['type_id']) ? $VALIDATION->input($_POST['type_id']) : "");
    $warehouse_id = (isset($_POST['warehouse_id']) ? $VALIDATION->input($_POST['warehouse_id']) : "");
    $location_id = (isset($_POST['location_id']) ? $VALIDATION->input($_POST['location_id']) : "");
    $brand_id = (isset($_POST['brand_id']) ? $VALIDATION->input($_POST['brand_id']) : "");
    $unit_id = (isset($_POST['unit_id']) ? $VALIDATION->input($_POST['unit_id']) : "");
    $size = (isset($_POST['size']) ? $VALIDATION->input($_POST['size']) : "");
    $material = (isset($_POST['material']) ? $VALIDATION->input($_POST['material']) : "");
    $text = (isset($_POST['text']) ? $VALIDATION->input($_POST['text']) : "");
    $status = (isset($_POST['status']) ? $VALIDATION->input($_POST['status']) : "");

    $ASSET->asset_update([$name, $code, $type_id, $warehouse_id, $location_id, $brand_id, $unit_id, $size, $material, $text, $status, $uuid]);

    foreach ($_FILES['file']['name'] as $key => $row) {
      $file_name = (isset($_FILES['file']['name']) ? $_FILES['file']['name'][$key] : "");
      $file_tmp = (isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'][$key] : "");
      $file_random = md5(microtime());
      $file_image = ["png", "jpeg", "jpg"];
      $file_document = ["pdf", "doc", "docx", "xls", "xlsx"];
      $file_allow = array_merge($file_image);
      $file_extension = pathinfo(strtolower($file_name), PATHINFO_EXTENSION);

      if (!empty($file_name) && in_array($file_extension, $file_allow)) {
        if (in_array($file_extension, $file_document)) {
          $file_rename = "{$file_random}.{$file_extension}";
          $file_path = (__DIR__ . "/../../Publics/asset/{$file_rename}");
          move_uploaded_file($file_tmp, $file_path);
        }
        if (in_array($file_extension, $file_image)) {
          $file_rename = "{$file_random}.webp";
          $file_path = (__DIR__ . "/../../Publics/asset/{$file_rename}");
          $VALIDATION->image_upload($file_tmp, $file_path);
        }
        $ASSET->file_create([$asset_id, $file_rename]);
      }
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/asset/view/{$uuid}");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "upload") {
  try {
    $file_name = (isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '');
    $file_tmp = (isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'] : '');
    $file_allow = ["xls", "xlsx", "csv"];
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

    if (!in_array($file_extension, $file_allow)) :
      $VALIDATION->alert("danger", "เฉพาะเอกสาร XLS XLSX CSV!", "/asset");
    endif;

    if ($file_extension === "xls") {
      $READER = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    } elseif ($file_extension === "xlsx") {
      $READER = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    } else {
      $READER = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    }

    $READ = $READER->load($file_tmp);
    $result = $READ->getActiveSheet()->toArray();

    $data = [];
    foreach ($result as $value) {
      $data[] = array_map("trim", $value);
    }

    foreach ($data as $key => $value) {
      if (!in_array($key, [0])) {
        $code = (isset($value[0]) ? $value[0] : "");
        $name = (isset($value[1]) ? $value[1] : "");
        $type = (isset($value[2]) ? $value[2] : "");
        $type_id = (!empty($type) ? $ASSET->type_id([$type]) : "");
        $warehouse = (isset($value[3]) ? $value[3] : "");
        $warehouse_id = (!empty($warehouse) ? $ASSET->warehouse_id([$warehouse]) : "");
        $location = (isset($value[4]) ? $value[4] : "");
        $location_id = (!empty($location) ? $ASSET->location_id([$location]) : "");
        $brand = (isset($value[5]) ? $value[5] : "");
        $brand_id = (!empty($brand) ? $ASSET->brand_id([$brand]) : "");
        $unit = (isset($value[6]) ? $value[6] : "");
        $unit_id = (!empty($unit) ? $ASSET->unit_id([$unit]) : "");
        $size = (isset($value[7]) ? $value[7] : "");
        $material = (isset($value[8]) ? $value[8] : "");
        $text = (isset($value[9]) ? $value[9] : "");

        $asset_count = $ASSET->asset_count([$name, $code, $type_id, $warehouse_id, $location_id, $brand_id, $unit_id, $size, $material, $text]);
        if (intval($asset_count) === 0) {
          $ASSET->asset_insert([$name, $code, $type_id, $warehouse_id, $location_id, $brand_id, $unit_id, $size, $material, $text]);
        }
      }
    }

    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/asset");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "file-delete") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    if (!empty($id)) {
      $ASSET->file_delete([$id]);
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
    $type = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
    $warehouse = (isset($_POST['warehouse']) ? $VALIDATION->input($_POST['warehouse']) : "");
    $location = (isset($_POST['location']) ? $VALIDATION->input($_POST['location']) : "");
    $brand = (isset($_POST['brand']) ? $VALIDATION->input($_POST['brand']) : "");
    $result = $ASSET->request_data($type, $warehouse, $location, $brand);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "type-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ASSET->type_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "warehouse-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ASSET->warehouse_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "location-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ASSET->location_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "brand-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ASSET->brand_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "unit-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $ASSET->unit_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
