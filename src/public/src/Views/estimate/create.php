<?php
$menu = "Service";
$page = "ServiceEstimate";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="card shadow">
  <h4 class="card-header text-center">ระบบใบ Estimate Budget</h4>
  <div class="card-body">

    <form action="/estimate/estimate-create" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อพนักงานขาย</label>
        <div class="col-xl-4 text-underline">
          <?php echo $user['fullname'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่เอกสารฝ่าย</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="department_number" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่เอกสาร</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm date-select" name="doc_date" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="old-customer">
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อลูกค้า</label>
          <div class="col-xl-4">
            <select class="form-control form-control-sm customer-select" name="customer_id" required></select>
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!!
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่สัญญา SO</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="order_number" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อสินค้า</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="product_name" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่องาน</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="title_name" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อการขาย</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="sales_name" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ยอดขาย</label>
        <div class="col-xl-4">
          <input type="number" class="form-control form-control-sm" name="budget" min="0" step="0.01" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ประเภท</label>
        <div class="col-xl-8">
          <div class="row pb-2">
            <div class="col-xl-2">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="type" value="1" required>
                <span class="text-success">Event</span>
              </label>
            </div>
            <div class="col-xl-2">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="type" value="2" required>
                <span class="text-danger">Online</span>
              </label>
            </div>
            <div class="col-xl-3">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="type" value="3" required>
                <span class="text-primary">รับจ้างผลิต</span>
              </label>
            </div>
            <div class="col-xl-2">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="type" value="4" required>
                <span class="text-warning">Media</span>
              </label>
            </div>
            <div class="col-xl-2">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="type" value="5" required>
                <span class="text-info">อื่นๆ</span>
              </label>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เอกสารแนบ</label>
        <div class="col-xl-6">
          <table class="table-sm">
            <tr class="file-tr">
              <td>
                <a href="javascript:void(0)" class="btn btn-success btn-sm file-increase">+</a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm file-decrease">-</a>
              </td>
              <td>
                <input type="file" class="form-control" name="file[]" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">หมายเหตุ</label>
        <div class="col-xl-6">
          <textarea class="form-control form-control-sm" rows="5" name="remark"></textarea>
          <div class="invalid-feedback">
            กรุณา กรอกข้อมูล!
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-xl-3 mb-2">
          <button type="submit" class="btn btn-success btn-sm btn-block">
            <i class="fas fa-check pr-2"></i>ยืนยัน
          </button>
        </div>
        <div class="col-xl-3 mb-2">
          <a class="btn btn-danger btn-sm btn-block" href="/estimate">
            <i class="fas fa-arrow-left pr-2"></i>หน้าหลัก
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  initializeSelect2(".customer-select", "/estimate/customer-select", "-- รายชื่อลูกค้า --");

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
    const allowedExtensions = ["png", "jpeg", "jpg", "pdf", "doc", "docx", "xls", "xlsx"];

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
        title: "เฉพาะไฟล์นามสกุล JPG, PNG, WORD และ EXCEL เท่านั้น",
      });
      return $(this).val("");
    }
  });

  $(".date-select").daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
      "format": "DD/MM/YYYY",
      "applyLabel": "ยืนยัน",
      "cancelLabel": "ยกเลิก",
      "daysOfWeek": [
        "อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"
      ],
      "monthNames": [
        "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
        "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
      ]
    },
    "applyButtonClasses": "btn-success",
    "cancelClass": "btn-danger"
  });

  $(".date-select").on("apply.daterangepicker", function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY'));
  });

  $(".date-select").on("keydown paste", function(e) {
    e.preventDefault();
  });
</script>