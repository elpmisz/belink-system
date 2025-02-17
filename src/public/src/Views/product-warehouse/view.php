<?php
$menu = "Service";
$page = "ServiceProduct";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\ProductWarehouse;

$PRODUCT = new ProductWarehouse();

$param = (isset($params) ? explode("/", $params) : "");
$id = (!empty($param[0]) ? $param[0] : "");

$row = $PRODUCT->product_warehouse_view([$id]);
?>

<div class="card shadow">
  <h4 class="card-header text-center">ข้อมูลคลัง</h4>
  <div class="card-body">

    <form action="/product-warehouse/update" method="POST" class="needs-validation" novalidate>
      <div class="row mb-2" style="display: none;">
        <label class="col-xl-2 offset-xl-2 col-form-label">ID</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="id" value="<?php echo $row['id'] ?>" readonly>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อ</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="name" value="<?php echo $row['name'] ?>" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">สถานะ</label>
        <div class="col-xl-8">
          <div class="row pb-2">
            <div class="col-xl-3">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="status" value="1" <?php echo intval($row['status']) === 1 ? "checked" : "" ?> required>
                <span class="text-success">ใช้งาน</span>
              </label>
            </div>
            <div class="col-xl-3">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="status" value="2" <?php echo intval($row['status']) === 2 ? "checked" : "" ?> required>
                <span class="text-danger">ระงับการใช้งาน</span>
              </label>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center mb-2">
        <div class="col-xl-3 mb-2">
          <button type="submit" class="btn btn-sm btn-success btn-block">
            <i class="fas fa-check pr-2"></i>ยืนยัน
          </button>
        </div>
        <div class="col-xl-3 mb-2">
          <a href="/product-warehouse" class="btn btn-sm btn-danger btn-block">
            <i class="fa fa-arrow-left pr-2"></i>กลับ
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>