<?php
$menu = "Setting";
$page = "SettingUser";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\Position;

$POSITION = new Position();

$param = (isset($params) ? explode("/", $params) : "");
$id = (!empty($param[0]) ? $param[0] : "");

$row = $POSITION->position_view([$id]);
?>

<div class="card shadow">
  <h4 class="card-header text-center">ตำแหน่ง</h4>
  <div class="card-body">

    <form action="/position/update" method="POST" class="needs-validation" novalidate>
      <div class="row mb-2" style="display: none;">
        <label class="col-xl-2 offset-xl-2 col-form-label">ID</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="id" value="<?php echo $row['id'] ?>" readonly>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อ (TH)</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="name_th" value="<?php echo $row['name_th'] ?>" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อ (ENG)</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="name_en" value="<?php echo $row['name_en'] ?>" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วงเงินอนุมัติ (MIN)</label>
        <div class="col-xl-4">
          <input type="number" class="form-control form-control-sm" name="amount_min" value="<?php echo $row['amount_min'] ?>" min="1" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วงเงินอนุมัติ (MAX)</label>
        <div class="col-xl-4">
          <input type="number" class="form-control form-control-sm" name="amount_max" value="<?php echo $row['amount_max'] ?>" min="1" required>
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
          <a href="/position" class="btn btn-sm btn-danger btn-block">
            <i class="fa fa-arrow-left pr-2"></i>กลับ
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>