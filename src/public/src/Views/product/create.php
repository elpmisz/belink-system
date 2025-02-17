<?php
$menu = "Service";
$page = "ServiceProduct";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="card shadow">
  <h4 class="card-header text-center">ข้อมูลสินค้า</h4>
  <div class="card-body">

    <form action="/product/create" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">

      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">รูปสินค้า</label>
        <div class="col-xl-6">
          <table class="table table-borderless">
            <tr class="file-tr">
              <td class="text-center" width="5%">
                <button type="button" class="btn btn-sm btn-success file-increase">+</button>
                <button type="button" class="btn btn-sm btn-danger file-decrease">-</button>
              </td>
              <td>
                <input type="file" class="form-control-file" name="file[]" accept=".jpeg, .png, .jpg">
              </td>
            </tr>
          </table>
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
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่สินค้า</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="code">
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ประเภท</label>
        <div class="col-sm-4">
          <select class="form-control form-control-sm type-select" name="type_id" required></select>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-xl-6">
          <div class="row mb-2">
            <label class="col-xl-3 offset-xl-1 col-form-label">คลัง</label>
            <div class="col-xl-8">
              <select class="form-control form-control-sm warehouse-select" name="warehouse_id" required></select>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-3 offset-xl-1 col-form-label">สถานที่</label>
            <div class="col-xl-8">
              <select class="form-control form-control-sm location-select" name="location_id"></select>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6">
          <div class="row mb-2">
            <label class="col-xl-3 offset-xl-1 col-form-label">ยี่ห้อ</label>
            <div class="col-xl-8">
              <select class="form-control form-control-sm brand-select" name="brand_id"></select>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-3 offset-xl-1 col-form-label">หน่วยนับ</label>
            <div class="col-xl-8">
              <select class="form-control form-control-sm unit-select" name="unit_id"></select>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">หมายเหตุ</label>
        <div class="col-xl-6">
          <textarea class="form-control form-control-sm" name="text" rows="4"></textarea>
        </div>
      </div>

      <div class="row justify-content-center mb-2">
        <div class="col-xl-3 mb-2">
          <button type="submit" class="btn btn-sm btn-success btn-block">
            <i class="fas fa-check pr-2"></i>ยืนยัน
          </button>
        </div>
        <div class="col-xl-3 mb-2">
          <a href="/product" class="btn btn-sm btn-danger btn-block">
            <i class="fa fa-arrow-left pr-2"></i>กลับ
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  $(".file-decrease").hide();
  $(document).on("click", ".file-increase", function() {
    let row = $(".file-tr:last");
    let clone = row.clone();
    clone.find("input, select").val("").empty();
    clone.find("span").text("");
    clone.find(".file-increase").hide();
    clone.find(".file-decrease").show();

    clone.find(".file-decrease").off("click").on("click", function() {
      $(this).closest("tr").remove();
    });

    row.after(clone);
  });

  $(document).on("change", "input[name='file[]']", function() {
    const file = $(this).val();
    const size = ($(this)[0].files[0].size / (1024 * 1024)).toFixed(2);
    const extension = file.split(".").pop().toLowerCase();
    const allowedExtensions = ["png", "jpeg", "jpg"];

    if (size > 5) {
      Swal.fire({
        icon: "error",
        title: "ไฟล์เอกสารไม่เกิน 5 Mb!",
      });
      return $(this).val("");
    }

    if (!allowedExtensions.includes(extension)) {
      Swal.fire({
        icon: "error",
        title: "เฉพาะไฟล์นามสกุล JPG และ PNG เท่านั้น",
      });
      return $(this).val("");
    }
  });

  initializeSelect2(".type-select", "/product/type-select", "-- ประเภท --");
  initializeSelect2(".warehouse-select", "/product/warehouse-select", "-- คลัง --");
  initializeSelect2(".location-select", "/product/location-select", "-- สถานที่ --");
  initializeSelect2(".brand-select", "/product/brand-select", "-- ยี่ห้อ --");
  initializeSelect2(".unit-select", "/product/unit-select", "-- หน่วยนับ --");
</script>