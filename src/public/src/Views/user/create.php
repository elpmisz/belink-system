<?php
$menu = "Setting";
$page = "SettingUser";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">ข้อมูลผู้ใช้งาน</h4>
      </div>
      <div class="card-body">
        <form action="/user/create" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">

          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">อีเมล</label>
            <div class="col-xl-4">
              <input type="email" class="form-control form-control-sm" name="email" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อใช้งานระบบ</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="username" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อ</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="firstname" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">นามสกุล</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="lastname" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ฝ่าย / แผนก</label>
            <div class="col-xl-4">
              <select class="form-control form-control-sm department-select" name="department_id" required></select>
              <div class="invalid-feedback">
                กรุณา กรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ตำแหน่ง</label>
            <div class="col-xl-4">
              <select class="form-control form-control-sm position-select" name="position_id" required></select>
              <div class="invalid-feedback">
                กรุณา กรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ติดต่อ</label>
            <div class="col-xl-4">
              <textarea class="form-control form-control-sm" name="contact" rows="4"></textarea>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ผู้จัดการ / ผู้อนุมัติ</label>
            <div class="col-xl-4">
              <select class="form-control form-control-sm user-select" name="manager_id" required></select>
              <div class="invalid-feedback">
                กรุณา กรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ผู้จัดการ / ผู้อนุมัติ 2</label>
            <div class="col-xl-4">
              <select class="form-control form-control-sm user-select" name="manager_id2" required></select>
              <div class="invalid-feedback">
                กรุณา กรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ผู้จัดการ / ผู้อนุมัติ 3</label>
            <div class="col-xl-4">
              <select class="form-control form-control-sm user-select" name="manager_id3" required></select>
              <div class="invalid-feedback">
                กรุณา กรอกข้อมูล!
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