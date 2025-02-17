<?php
$menu = "Service";
$page = "ServiceExpense";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="card shadow">
  <h4 class="card-header text-center">ข้อมูลรายจ่าย</h4>
  <div class="card-body">

    <form action="/expense/expense-create" method="POST" class="needs-validation" novalidate>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่</label>
        <div class="col-xl-2">
          <input type="text" class="form-control form-control-sm" name="code" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อ</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="name" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ประเภท</label>
        <div class="col-xl-8">
          <div class="row pb-2">
            <div class="col-xl-3">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="type" value="1" required>
                <span class="text-success">หลัก</span>
              </label>
            </div>
            <div class="col-xl-3">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="type" value="2" required>
                <span class="text-danger">รอง</span>
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-2 reference-div">
        <label class="col-xl-2 offset-xl-2 col-form-label">หัวข้อหลัก</label>
        <div class="col-xl-4">
          <select class="form-control form-control-sm expense-select" name="reference"></select>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
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
          <a href="/expense" class="btn btn-sm btn-danger btn-block">
            <i class="fa fa-arrow-left pr-2"></i>กลับ
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  $(".reference-div").hide();
  $(document).on("click", "input[name='type']", function() {
    let type = parseInt($(this).val());
    if (type === 2) {
      $(".reference-div").show();
      $(".expense-select").prop("required", true);
    } else {
      $(".reference-div").hide();
      $(".expense-select").prop("required", false);
      $(".expense-select").empty();
    }
  });

  initializeSelect2(".expense-select", "/expense/expense-select", "-- ประเภทรายจ่าย --");
</script>