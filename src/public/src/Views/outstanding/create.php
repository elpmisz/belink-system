<?php
$menu = "Service";
$page = "ServiceOutstanding";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="card shadow">
  <div class="card-header">
    <h4 class="text-center">ระบบใบค้างจ่าย Outstanding Invoice</h4>
  </div>
  <div class="card-body">

    <form action="/outstanding/create" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
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
          <input type="text" class="form-control form-control-sm date-select" name="doc_date" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่สัญญา SO</label>
        <div class="col-xl-4">
          <select class="form-control form-control-sm order-select" name="order_number"></select>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">รายละเอียด</label>
        <div class="col-xl-6">
          <textarea class="form-control form-control-sm" rows="5" name="text" required></textarea>
          <div class="invalid-feedback">
            กรุณา กรอกข้อมูล!
          </div>
        </div>
      </div>

      <div class="row mb-2 items-div">
        <div class="col-xl-12">
          <div class="table-responsive">
            <table class="table table-bordered table-sm items-table"></table>
          </div>
        </div>
      </div>

      <div class="row mb-2 items-custom-div">
        <div class="col-xl-12">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="10%">#</th>
                  <th width="20%">รายจ่าย</th>
                  <th width="20%">รายละเอียด</th>
                  <th width="10%">จำนวน</th>
                  <th width="10%">หน่วย</th>
                  <th width="10%">จำนวนเงิน</th>
                  <th width="10%">ยอดคงเหลือ</th>
                </tr>
              </thead>
              <tbody>
                <tr class="item-tr">
                  <td class="text-center">
                    <button type="button" class="btn btn-sm btn-success item-increase">+</button>
                    <button type="button" class="btn btn-sm btn-danger item-decrease">-</button>
                  </td>
                  <td>
                    <select class="form-control form-control-sm expense-select" name="expense_id[]" required></select>
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm text-left item-text" name="item_text[]" required>
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm text-right item-amount" name="item_amount[]" min="1" step="0.01">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm text-left item-unit" name="item_unit[]">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm text-right item-estimate" name="item_estimate[]" min="1" step="0.01">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td class="text-right"><span class="item-remain"></span></td>
                </tr>
                <tr>
                  <td colspan="5" class="text-right">รวมทั้งสิ้น</td>
                  <td class="text-right">
                    <span class="total-all"></span>
                  </td>
                </tr>
              </tbody>
            </table>
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
          <a class="btn btn-danger btn-sm btn-block" href="/outstanding">
            <i class="fas fa-arrow-left pr-2"></i>หน้าหลัก
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  initializeSelect2(".order-select", "/estimate/order-select", "-- รายชื่อเลขที่สัญญา --");

  const order = ($(".order-select").val() || "");
  $(".expense-select").select2({
    placeholder: "-- รายจ่าย --",
    width: "100%",
    allowClear: true,
    ajax: {
      url: "/purchase/expense-select",
      method: "POST",
      data: function(params) {
        return {
          keyword: params.term,
          order
        };
      },
      dataType: "json",
      delay: 100,
      processResults: function(data) {
        return {
          results: data
        };
      },
      cache: true
    }
  });

  $(document).on("change", ".order-select", function() {
    $(".expense-select").empty();
    $(".item-text, .item-amount, .item-vat, .item-wt").val("");
    $(".item-total, .item-remain, .total-amount, .total-vat, .total-wt, .total-all").text("");
    const order = ($(this).val() || "");

    if (order) {
      $(".order-div, .items-div").show();
      axios.post("/purchase/order-view", {
          order
        })
        .then((res) => {
          const result = res.data;
          if (result) {
            $(".order-customer").text(result.customer_name);
            $(".order-product").text(result.product_name);
          }
        })
        .catch((error) => {
          console.error(error);
        });

      axios.post("/purchase/get-expense", {
          order,
        })
        .then((res) => {
          let result = res.data;
          let tableContent = '';
          if (result.length > 0) {
            tableContent = `
              <tr>
                <th width="10%">#</th>
                <th width="20%">รายจ่าย</th>
                <th width="20%">รายละเอียด</th>
                <th width="10%">จำนวน</th>
                <th width="10%">หน่วย</th>
                <th width="10%">จำนวนเงิน</th>
                <th width="10%">ยอดคงเหลือ</th>
              </tr>
            `;

            result.forEach((item, index) => {
              tableContent += `
                <tr class="item-tr">
                  <td class="text-center">${++index}</td>
                  <td class="text-left">
                    ${item.expense_name}
                    <input type="hidden" class="form-control form-control-sm text-left" name="expense_id[]" value="${item.expense_id}">
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm text-left item-text" name="item_text[]" required>
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm text-right item-amount" name="item_amount[]" min="1" step="0.01">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm text-left item-unit" name="item_unit[]">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm text-right item-estimate" name="item_estimate[]" min="1" step="0.01">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td class="text-right"><span class="item-remain">${item.remain}</span></td>
                </tr>
              `;
            });
          }

          $(".items-table").html(tableContent);
        }).catch((error) => {
          console.log(error);
        });

      $(".expense-select").select2({
        placeholder: "-- รายจ่าย --",
        width: "100%",
        allowClear: true,
        ajax: {
          url: "/purchase/expense-select",
          method: "POST",
          data: function(params) {
            return {
              keyword: params.term,
              order
            };
          },
          dataType: "json",
          delay: 100,
          processResults: function(data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });
    } else {
      $(".order-div, .items-div").hide();

      $(".expense-select").select2({
        placeholder: "-- รายจ่าย --",
        width: "100%",
        allowClear: true,
        ajax: {
          url: "/purchase/expense-select",
          method: "POST",
          data: function(params) {
            return {
              keyword: params.term,
              order
            };
          },
          dataType: "json",
          delay: 100,
          processResults: function(data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });
    }
  });

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

    const order = ($(".order-select").val() || "");
    $(".expense-select").select2({
      placeholder: "-- รายจ่าย --",
      width: "100%",
      allowClear: true,
      ajax: {
        url: "/purchase/expense-select",
        method: "POST",
        data: function(params) {
          return {
            keyword: params.term,
            order
          };
        },
        dataType: "json",
        delay: 100,
        processResults: function(data) {
          return {
            results: data
          };
        },
        cache: true
      }
    });

    $('.item-amount, .item-estimate').on('blur', function() {
      var value = $(this).val();

      value = value.replace(/[^0-9.]/g, '');

      var parts = value.split('.');
      if (parts.length > 2) {
        value = parts[0] + '.' + parts.slice(1).join('');
      }

      if (value) {
        value = parseFloat(value).toFixed(2);
      }

      $(this).val(value);
    });
  });

  $(document).on("change", ".expense-select", function() {
    const expense = ($(this).val() || "");
    const order = ($(".order-select").val() || "");
    const purchase = ($(".purchase-select").val() || "");
    const row = $(this).closest("tr");
    row.find(".item-text, .item-amount, .item-vat, .item-wt").val("");
    row.find(".item-total").text("");

    if (expense && order) {
      axios.post("/payment/order-view", {
          expense,
          order,
          purchase
        })
        .then((res) => {
          const result = res.data;
          row.find(".item-remain").text(result.remain);
        })
        .catch((error) => {
          console.error(error);
        });

      row.find(".item-text, .item-amount").prop("required", true);
    } else {
      row.find(".item-text, .item-amount").prop("required", false);
    }
  });

  $(document).on("input", ".item-estimate", function() {
    const order = ($(".order-select").val() || "");
    const row = $(this).closest("tr");
    const estimate = parseFloat(row.find(".item-estimate").val() || 0);
    let remain = parseFloat(row.find(".item-remain").text() || 0);

    if (order) {
      row.find(".item-estimate").prop("max", remain);
    } else {
      row.find(".item-estimate").prop("max", false);
    }

    if (remain && estimate > remain) {
      Swal.fire({
        icon: "error",
        title: "รายจ่ายเกินวงเงิน \nกรุณาตรวจสอบอีกครั้ง!",
      });
      row.find(".item-estimate").val("");
    }

    updateTotal();

    $('.item-amount, .item-estimate').on('blur', function() {
      var value = $(this).val();

      value = value.replace(/[^0-9.]/g, '');

      var parts = value.split('.');
      if (parts.length > 2) {
        value = parts[0] + '.' + parts.slice(1).join('');
      }

      if (value) {
        value = parseFloat(value).toFixed(2);
      }

      $(this).val(value);
    });
  });

  function updateTotal() {
    let totalAmount = 0;

    $("tr.item-tr").each(function() {
      const amount = parseFloat($(this).find(".item-estimate").val() || 0);

      totalAmount += amount;
    });

    $(".total-all").text(totalAmount.toFixed(2));
  }

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

  $('.item-amount, .item-estimate').on('blur', function() {
    var value = $(this).val();

    value = value.replace(/[^0-9.]/g, '');

    var parts = value.split('.');
    if (parts.length > 2) {
      value = parts[0] + '.' + parts.slice(1).join('');
    }

    if (value) {
      value = parseFloat(value).toFixed(2);
    }

    $(this).val(value);
  });
</script>