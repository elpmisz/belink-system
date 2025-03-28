<?php
$menu = "Setting";
$page = "SettingUser";
include_once(__DIR__ . "/../layout/header.php");

$param = (isset($params) ? explode("/", $params) : die(header("Location: /error")));
$uuid = (isset($param[0]) ? $param[0] : die(header("Location: /error")));

use App\Classes\User;

$USER = new User();

$row = $USER->user_view([$uuid, $uuid]);
?>

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">ข้อมูลผู้ใช้งาน</h4>
      </div>
      <div class="card-body">
        <form action="/user/update" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">

          <div class="row mb-2" style="display: none;">
            <label class="col-xl-2 offset-xl-2 col-form-label">UUID</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="uuid" value="<?php echo $row['uuid'] ?>" readonly>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">อีเมล</label>
            <div class="col-xl-4">
              <input type="email" class="form-control form-control-sm" name="email" value="<?php echo $row['email'] ?>" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อใช้งานระบบ</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="username" value="<?php echo $row['username'] ?>" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อ</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="firstname" value="<?php echo $row['firstname'] ?>" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">นามสกุล</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="lastname" value="<?php echo $row['lastname'] ?>" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ฝ่าย / แผนก</label>
            <div class="col-xl-4">
              <select class="form-control form-control-sm department-select" name="department_id" required>
                <?php
                if (!empty($row['department_id'])) {
                  echo "<option value='{$row['department_id']}' selected>{$row['department_name']}</option>";
                }
                ?>
              </select>
              <div class="invalid-feedback">
                กรุณา กรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ตำแหน่ง</label>
            <div class="col-xl-4">
              <select class="form-control form-control-sm position-select" name="position_id">
                <?php
                if (!empty($row['position_id'])) {
                  echo "<option value='{$row['position_id']}' selected>{$row['position_name']}</option>";
                }
                ?>
              </select>
              <div class="invalid-feedback">
                กรุณา กรอกข้อมูล!
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
            <label class="col-xl-2 offset-xl-2 col-form-label">ผู้จัดการ / ผู้อนุมัติ</label>
            <div class="col-xl-4">
              <select class="form-control form-control-sm user-select" name="manager_id" required>
                <?php
                if (!empty($row['manager_id'])) {
                  echo "<option value='{$row['manager_id']}' selected>{$row['manager_name']}</option>";
                }
                ?>
              </select>
              <div class="invalid-feedback">
                กรุณา กรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ผู้จัดการ / ผู้อนุมัติ 2</label>
            <div class="col-xl-4">
              <select class="form-control form-control-sm user-select" name="manager_id2" required>
                <?php
                if (!empty($row['manager_id2'])) {
                  echo "<option value='{$row['manager_id2']}' selected>{$row['manager_name2']}</option>";
                }
                ?>
              </select>
              <div class="invalid-feedback">
                กรุณา กรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ผู้จัดการ / ผู้อนุมัติ 3</label>
            <div class="col-xl-4">
              <select class="form-control form-control-sm user-select" name="manager_id3">
                <?php
                if (!empty($row['manager_id3'])) {
                  echo "<option value='{$row['manager_id3']}' selected>{$row['manager_name3']}</option>";
                }
                ?>
              </select>
              <div class="invalid-feedback">
                กรุณา กรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">สิทธิ์</label>
            <div class="col-xl-8">
              <div class="row pb-2">
                <div class="col-xl-3">
                  <label class="form-check-label px-3">
                    <input class="form-check-input" type="radio" name="level" value="1" <?php echo (intval($row['level']) === 1 ? "checked" : "") ?> required>
                    <span class="text-info">ผู้ใช้งาน</span>
                  </label>
                </div>
                <div class="col-xl-3">
                  <label class="form-check-label px-3">
                    <input class="form-check-input" type="radio" name="level" value="9" <?php echo (intval($row['level']) === 9 ? "checked" : "") ?> required>
                    <span class="text-primary">ผู้ดูแลระบบ</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">สถานะ</label>
            <div class="col-xl-8">
              <div class="row pb-2">
                <div class="col-xl-3">
                  <label class="form-check-label px-3">
                    <input class="form-check-input" type="radio" name="status" value="1" <?php echo (intval($row['status']) === 1 ? "checked" : "") ?> required>
                    <span class="text-success">ใช้งาน</span>
                  </label>
                </div>
                <div class="col-xl-3">
                  <label class="form-check-label px-3">
                    <input class="form-check-input" type="radio" name="status" value="2" <?php echo (intval($row['status']) === 2 ? "checked" : "") ?> required>
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
              <a href="/user" class="btn btn-sm btn-danger btn-block">
                <i class="fa fa-arrow-left pr-2"></i>กลับ
              </a>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  initializeSelect2(".department-select", "/user/department-select", "-- เลือก --");
  initializeSelect2(".position-select", "/user/position-select", "-- เลือก --");
  initializeSelect2(".user-select", "/user/user-select", "-- เลือก --");
</script>