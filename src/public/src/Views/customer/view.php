<?php
$menu = "Service";
$page = "ServiceCustomer";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\Customer;

$CUSTOMER = new Customer();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $CUSTOMER->customer_view([$uuid]);
?>

<div class="card shadow">
  <h4 class="card-header text-center">ข้อมูลลูกค้า</h4>
  <div class="card-body">

    <form action="/customer/customer-update" method="POST" class="needs-validation" novalidate>
      <div class="row mb-2" style="display: none;">
        <label class="col-xl-2 offset-xl-2 col-form-label">รหัส</label>
        <div class="col-xl-2">
          <input type="text" class="form-control form-control-sm" name="uuid" value="<?php echo $row['uuid'] ?>" readonly>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่</label>
        <div class="col-xl-2">
          <input type="text" class="form-control form-control-sm" name="code" value="<?php echo $row['code'] ?>" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
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
        <label class="col-xl-2 offset-xl-2 col-form-label">ติดต่อ</label>
        <div class="col-xl-4">
          <textarea class="form-control form-control-sm" name="contact" rows="4"><?php echo $row['contact'] ?></textarea>
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
          <a href="/customer" class="btn btn-sm btn-danger btn-block">
            <i class="fa fa-arrow-left pr-2"></i>กลับ
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>