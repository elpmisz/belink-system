<?php
$menu = "Service";
$page = "ServicePayment";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="card shadow">
  <h4 class="card-header text-center">ระบบใบอนุมัติสั่งจ่าย Payment Order</h4>
  <div class="card-body">

    <form action="/payment/create" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
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
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่ใบขอซื้อ PR</label>
        <div class="col-xl-4">
          <select class="form-control form-control-sm purchase-select" name="purchase_number"></select>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">จ่ายให้</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="receiver" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ประเภท</label>
        <div class="col-xl-8">
          <div class="row pb-2">
            <div class="col-xl-4">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="type" value="1" required>
                <span class="text-success">เงินสด / โอนเข้าบัญชี</span>
              </label>
            </div>
            <div class="col-xl-4">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="type" value="2" required>
                <span class="text-danger">เช็ค</span>
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="cheque-div" style="display: none;">
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ธนาคาร</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" name="cheque_bank">
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">สาขา</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" name="cheque_branch">
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่เช็ค</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" name="cheque_number">
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ลงวันที่</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm date-select" name="cheque_date">
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
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

      <div class="row mb-2">
        <div class="col-xl-12">
          <h5>รายการเพิ่มเติม</h5>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th width="15%">รายจ่าย</th>
                  <th width="15%">รายละเอียด</th>
                  <th width="15%">รายละเอียด</th>
                  <th width="10%">จำนวนเงิน</th>
                  <th width="10%">VAT 7%</th>
                  <th width="10%">W/T</th>
                  <th width="10%">ยอดสุทธิ</th>
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
                    <select class="form-control form-control-sm expense-select" name="expense_id[]"></select>
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm text-left item-text" name="item_text[]">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm text-left item-text" name="item_text2[]">
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
                    <input type="number" class="form-control form-control-sm text-right item-vat" name="item_vat[]" min="1" step="0.01">
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm text-right item-wt" name="item_wt[]" min="1" step="0.01">
                  </td>
                  <td class="text-right">
                    <span class="item-total"></span>
                  </td>
                  <td class="text-right">
                    <span class="item-remain"></span>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right">รวมทั้งสิ้น</td>
                  <td class="text-right">
                    <span class=" total-amount"></span>
                  </td>
                  <td class="text-right">
                    <span class=" total-vat"></span>
                  </td>
                  <td class="text-right">
                    <span class=" total-wt"></span>
                  </td>
                  <td class="text-right">
                    <span class=" total-all"></span>
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
          <a class="btn btn-danger btn-sm btn-block" href="/payment">
            <i class="fas fa-arrow-left pr-2"></i>หน้าหลัก
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  initializeSelect2(".order-select", "/estimate/order-select", "-- เลขที่สัญญา SO --");
  initializeSelect2(".purchase-select", "/purchase/purchase-select", "-- เลขที่ใบขอซื้อ PR --");

  const order = ($(".order-select").val() || "");
  const purchase = ($(".purchase-select").val() || "");
  $(".expense-select").select2({
    placeholder: "-- รายจ่าย --",
    width: "100%",
    allowClear: true,
    ajax: {
      url: "/payment/expense-select",
      method: "POST",
      data: function(params) {
        return {
          keyword: params.term,
          order,
          purchase
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

  $(document).on("change", ".order-select, .purchase-select", function() {
    $(".expense-select").empty();
    $(".item-text, .item-amount, .item-vat, .item-wt").val("");
    $(".item-total, .item-remain, .total-amount, .total-vat, .total-wt, .total-all").text("");
    const order = ($(".order-select").val() || "");
    const purchase = ($(".purchase-select").val() || "");

    if (order || purchase) {
      $(".items-div").show();

      axios.post("/payment/get-expense", {
          order,
          purchase
        })
        .then((res) => {
          let result = res.data;
          let tableContent = '';
          if (result.length > 0) {
            tableContent = `
              <tr>
                <th width="15%">รายจ่าย</th>
                <th width="15%">รายละเอียด</th>
                <th width="15%">รายละเอียด</th>
                <th width="10%">จำนวนเงิน</th>
                <th width="10%">VAT 7%</th>
                <th width="10%">W/T</th>
                <th width="10%">ยอดสุทธิ</th> 
                <th width="10%">ยอดคงเหลือ</th>   
              </tr>
            `;

            result.forEach((item, index) => {
              tableContent += `
                <tr class="item-tr">
                  <td class="text-left">
                    ${item.expense_name}
                    <input type="hidden" class="form-control form-control-sm text-left" name="expense_id[]" value="${item.expense_id}">
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm text-left item-text" name="item_text[]" value="${item.text}">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm text-left item-text" name="item_text2[]">
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
                    <input type="number" class="form-control form-control-sm text-right item-vat" name="item_vat[]" min="1" step="0.01">
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm text-right item-wt" name="item_wt[]" min="1" step="0.01">
                  </td>
                  <td class="text-right"><span class="item-total"></span></td>
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
          url: "/payment/expense-select",
          method: "POST",
          data: function(params) {
            return {
              keyword: params.term,
              order,
              purchase
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
      $(".items-div").hide();

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

  $(document).on("input", ".item-text", function() {
    const text = $(this).val() || "";
    const row = $(this).closest("tr");
    if (text) {
      row.find(".item-text, .item-amount").prop("required", true);
    } else {
      row.find(".item-text, .item-amount").prop("required", false);
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

    const order = ($(".order-select").val() || "");
    const purchase = ($(".purchase-select").val() || "");
    $(".expense-select").select2({
      placeholder: "-- รายจ่าย --",
      width: "100%",
      allowClear: true,
      ajax: {
        url: "/payment/expense-select",
        method: "POST",
        data: function(params) {
          return {
            keyword: params.term,
            order,
            purchase
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

    $('.item-amount, .item-vat, .item-wt').on('blur', function() {
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

    updateTotal();
  });

  $(document).on("click", "input[name='type']", function() {
    const type = parseInt($(this).val()) || 0;
    const isCheque = type === 2;

    $(".cheque-div").toggle(isCheque);
    $("input[name='cheque_bank'], input[name='cheque_branch'], input[name='cheque_number'], input[name='cheque_date']")
      .prop("required", isCheque)
      .val(isCheque ? "" : "");
  });

  $(document).on("change", ".expense-select", function() {
    const expense = ($(this).val() || "");
    const order = ($(".order-select").val() || "");
    const purchase = ($(".purchase-select").val() || "");
    const row = $(this).closest("tr");
    row.find(".item-text, .item-amount, .item-vat, .item-wt").val("");
    row.find(".item-total").text("");

    if (expense && (order || purchase)) {
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

  $(document).on("input", ".item-amount, .item-vat, .item-wt", function() {
    const order = ($(".order-select").val() || "");
    const purchase = ($(".purchase-select").val() || "");
    const row = $(this).closest("tr");
    const amount = parseFloat(row.find(".item-amount").val() || 0);
    const vat = parseFloat(row.find(".item-vat").val() || 0);
    const wt = parseFloat(row.find(".item-wt").val() || 0);
    let remain = parseFloat(row.find(".item-remain").text() || 0);
    const total = (amount + vat - wt);

    if (order || purchase) {
      row.find(".item-amount").prop("max", remain);
    } else {
      row.find(".item-amount").prop("max", false);
    }

    if (remain && total > remain) {
      Swal.fire({
        icon: "error",
        title: "รายจ่ายเกินวงเงิน \nกรุณาตรวจสอบอีกครั้ง!",
      });
      row.find(".item-amount, .item-vat, .item-wt").val("");
      row.find(".item-total").text("");
    } else {
      row.find(".item-total").text(total.toFixed(2));
    }

    updateTotal();

    $('.item-amount, .item-vat, .item-wt').on('blur', function() {
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

  function updateTotal() {
    let totalAmount = 0;
    let totalVat = 0;
    let totalWt = 0;

    $("tr.item-tr").each(function() {
      const amount = parseFloat($(this).find(".item-amount").val() || 0);
      const vat = parseFloat($(this).find(".item-vat").val() || 0);
      const wt = parseFloat($(this).find(".item-wt").val() || 0);

      totalAmount += amount;
      totalVat += vat;
      totalWt += wt;
    });

    let grandTotal = totalAmount + totalVat - totalWt;

    $(".total-amount").text(totalAmount.toFixed(2));
    $(".total-vat").text(totalVat.toFixed(2));
    $(".total-wt").text(totalWt.toFixed(2));
    $(".total-all").text(grandTotal.toFixed(2));
  }

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

  $('.item-amount, .item-vat, .item-wt').on('blur', function() {
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