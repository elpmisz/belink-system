<?php
$menu = "Service";
$page = "ServiceOutstanding";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\Outstanding;

$OUTSTANDING = new Outstanding();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $OUTSTANDING->outstanding_view([$uuid]);
$items = $OUTSTANDING->outstanding_item_view([$uuid]);
$files = $OUTSTANDING->outstanding_file_view([$uuid]);
$remarks = $OUTSTANDING->outstanding_remark_view([$uuid]);
$total = $OUTSTANDING->outstanding_item_total([$uuid]);
?>

<div class="card shadow">
  <div class="card-header">
    <h4 class="text-center">ระบบใบค้างจ่าย Outstanding Invoice</h4>
  </div>
  <div class="card-body">

    <form action="/outstanding/update" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
      <div style="display: none;">
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ID</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" name="id" value="<?php echo $row['id'] ?>" readonly>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">UUID</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" name="uuid" value="<?php echo $row['uuid'] ?>" readonly>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ORDER NUMBER</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm order-select" value="<?php echo $row['order_number'] ?>" readonly>
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่เอกสาร</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['ticket'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ผู้ใช้บริการ</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['username'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่เอกสารฝ่าย</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="department_number" value="<?php echo $row['department_number'] ?>" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่เอกสาร</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm date-select" name="doc_date" value="<?php echo $row['doc_date'] ?>" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่สัญญา</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['order_number'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">รายละเอียด</label>
        <div class="col-xl-6">
          <textarea class="form-control form-control-sm" rows="5" name="text" required><?php echo $row['text'] ?></textarea>
          <div class="invalid-feedback">
            กรุณา กรอกข้อมูล!
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
                <?php foreach ($items as $key => $item) : $key++; ?>
                  <tr>
                    <td class="text-center">
                      <a href="javascript:void(0)" class="badge badge-danger font-weight-light item-delete" id="<?php echo $item['id'] ?>">ลบ</a>
                      <input type="hidden" class="form-control form-control-sm text-center" name="item__id[]" value="<?php echo $item['id'] ?>" readonly>
                    </td>
                    <td class="text-left"><?php echo $item['expense_name'] ?></td>
                    <td class="text-left"><?php echo $item['text'] ?></td>
                    <td>
                      <input type="number" class="form-control form-control-sm text-right item-amount" name="item__amount[]" value="<?php echo $item['amount'] ?>" readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control form-control-sm item-unit" name="item__unit[]" value="<?php echo $item['unit'] ?>" readonly>
                    </td>
                    <td>
                      <input type="number" class="form-control form-control-sm text-right item-estimate" value="<?php echo $item['estimate'] ?>" min="1" step="0.01" name="item__estimate[]" readonly>
                    </td>
                    <td class="text-right"><span class="item-remain"></span></td>
                  </tr>
                <?php endforeach; ?>
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
                    <span class="total-all"><?php echo number_format($total['total'], 2) ?></span>
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
            <?php
            foreach ($files as $file) :
              if (!empty($file['name'])) :
            ?>
                <tr>
                  <td>
                    <a href="/src/Publics/outstanding/<?php echo $file['name'] ?>" class="text-primary" target="_blank">
                      <span class="badge badge-primary font-weight-light">ดาวน์โหลด!</span>
                    </a>
                  </td>
                  <td>
                    <a href="javascript:void(0)" class="file-delete" id="<?php echo $file['id'] ?>">
                      <span class="badge badge-danger font-weight-light">ลบ!</span>
                    </a>
                  </td>
                </tr>
            <?php
              endif;
            endforeach;
            ?>
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

      row.find(".item-text, .item-amount, .item-unit, .item-estimate").prop("required", true);
    } else {
      row.find(".item-text, .item-amount, .item-unit, .item-estimate").prop("required", false);
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
    let totalEstimate = 0;

    $('.item-estimate').each(function() {
      let estimate = parseFloat($(this).val()) || 0;
      totalEstimate += estimate;
    });

    let formattedTotalEstimate = totalEstimate.toLocaleString('en-US', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });

    $(".total-all").text(formattedTotalEstimate);
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