<?php
$menu = "Service";
$page = "ServiceAdvanceClear";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="card shadow">
  <h4 class="card-header text-center">ระบบใบขอเคลียร์ Clear Advance Payment</h4>
  <div class="card-body">

    <form action="/advance-clear/create" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ผู้ใช้บริการ</label>
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
          <input type="text" class="form-control form-control-sm date-select" name="date" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่ใบเบิก</label>
        <div class="col-xl-4">
          <select class="form-control form-control-sm advance-select" name="advance_number" required></select>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ยอดเงินเบิก</label>
        <div class="col-xl-4">
          <input type="number" class="form-control form-control-sm advance-amount" name="amount" readonly>
        </div>
      </div>

      <div class="row mb-2 items-div" style="display: none;">
        <div class="col-xl-12">
          <div class="table-responsive">
            <table class="table table-bordered items-table"></table>
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

      <div class="row justify-content-center">
        <div class="col-xl-3 mb-2">
          <button type="submit" class="btn btn-success btn-sm btn-block">
            <i class="fas fa-check pr-2"></i>ยืนยัน
          </button>
        </div>
        <div class="col-xl-3 mb-2">
          <a class="btn btn-danger btn-sm btn-block" href="/advance-clear">
            <i class="fas fa-arrow-left pr-2"></i>หน้าหลัก
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  initializeSelect2(".advance-select", "/advance-clear/advance-select", "-- รายชื่อเลขที่สัญญา --");
  initializeSelect2(".expense-select", "/estimate/expense-select", "-- รายชื่อรายจ่าย --");

  $(".item-decrease, .file-decrease").hide();
  $(document).on("click", ".item-increase", function() {
    $(".expense-select").select2('destroy');

    let row = $(".item-tr:last");
    let clone = row.clone();
    clone.find("input, select").val("").empty();
    clone.find("span").text("");
    clone.find(".item-increase").hide();
    clone.find(".item-decrease").show();

    clone.find(".item-decrease").off("click").on("click", function() {
      $(this).closest("tr").remove();
      updateTotal();
    });

    row.after(clone);
    initializeSelect2(".expense-select", "/estimate/expense-select", "-- รายชื่อรายจ่าย --");
    updateTotal();
  });

  $(document).on("change", ".expense-select", function() {
    const expense = ($(this).val() || "");
    if (expense) {
      $("input[name='item_text[]'], input[name='item_amount[]']").prop("required", true);
    } else {
      $("input[name='item_text[]'], input[name='item_amount[]']").prop("required", false);
    }
  });

  $(document).on("blur", ".amount-item, .vat-item, .wt-item", function() {
    const row = $(this).closest("tr");
    const amount = parseFloat(row.find(".amount-item").val() || 0);
    const vat = parseFloat(row.find(".vat-item").val() || 0);
    const wt = parseFloat(row.find(".wt-item").val() || 0);

    const total = (amount + vat - wt).toFixed(2);
    row.find(".total-item").text(total);

    updateTotal();
  });

  function updateTotal() {
    let totalAmount = 0;
    let totalVat = 0;
    let totalWt = 0;

    $("tr.item-tr").each(function() {
      const amount = parseFloat($(this).find(".amount-item").val() || 0);
      const vat = parseFloat($(this).find(".vat-item").val() || 0);
      const wt = parseFloat($(this).find(".wt-item").val() || 0);

      totalAmount += amount;
      totalVat += vat;
      totalWt += wt;
    });

    $(".amount-total").text(totalAmount.toFixed(2));
    $(".vat-total").text(totalVat.toFixed(2));
    $(".wt-total").text(totalWt.toFixed(2));
    $(".all-total").text((totalAmount + totalVat - totalWt).toFixed(2));
  }

  $(document).on("change", ".advance-select", function() {
    const advance = ($(this).val() || "");

    if (advance) {
      axios.post("/advance-clear/advance-amount", {
          advance,
        })
        .then((res) => {
          let result = res.data;
          $(".advance-amount").val(result);
        }).catch((error) => {
          console.log(error);
        });

      axios.post("/advance-clear/advance-order", {
          advance
        })
        .then((res) => {
          const items = res.data;

          let tableContent = '';
          if (items.length > 0) {
            tableContent = `
          <tr>
            <th width="5%">#</th>
            <th width="15%">รายจ่าย</th>
            <th width="30%">รายละเอียด</th>
            <th width="10%">จำนวนเงิน</th>
            <th width="10%">VAT 7%</th>
            <th width="10%">W/T</th>
            <th width="10%">ยอดสุทธิ</th>
            <th width="10%">ยอดที่เบิก</th>
          </tr>
        `;

            items.forEach((item, index) => {
              let amount = parseFloat(item.amount).toLocaleString('th-TH', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              });
              tableContent += `
            <tr class="item-tr">
              <td class="text-center">${index + 1}</td>
              <td class="text-left">
              ${item.expense_name}
              <input type="hidden" class="form-control form-control-sm text-left" name="expense_id[]" value="${item.expense_id}" readonly>
                <div class="invalid-feedback">กรุณากรอกข้อมูล!</div>
              </td>
              <td>
                <input type="text" class="form-control form-control-sm text-left" name="item_text[]" required>
                <div class="invalid-feedback">กรุณากรอกข้อมูล!</div>
              </td>
              <td>
                <input type="number" class="form-control form-control-sm text-right amount-item" min="1" max="${item.estimate}" step="0.01" name="item_amount[]" required><div class="invalid-feedback">กรุณากรอกข้อมูล!</div>
              </td>
              <td>
                <input type="number" class="form-control form-control-sm text-right vat-item" min="1" step="0.01" name="item_vat[]">
              </td>
              <td>
                <input type="number" class="form-control form-control-sm text-right wt-item" min="1" step="0.01" name="item_wt[]">
              </td>
              <td class="text-right"><span class="total-item"></span></td>
              <td class="text-right">${amount}</span></td>
            </tr>
          `;
            });

            tableContent += `
            <tr>
              <td colspan="3" class="text-right">รวมทั้งสิ้น</td>
              <td class="text-right"><span class="amount-total"></span></td>
              <td class="text-right"><span class="vat-total"></span></td>
              <td class="text-right"><span class="wt-total"></span></td>
              <td class="text-right"><span class="all-total"></span></td>
            </tr>
          `;

            $(".items-div").show();
          } else {
            $(".items-div").hide();
          }

          $(".items-table").html(tableContent);
        })
        .catch((error) => {
          console.error(error);
        });
    } else {
      $(".advance-amount").val("");
    }
  });

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