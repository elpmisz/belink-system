<?php
$menu = "Service";
$page = "ServiceAdvanceClear";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\AdvanceClear;

$ADVANCE = new AdvanceClear();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $ADVANCE->advance_view([$uuid]);
$items = $ADVANCE->advance_item_view([$uuid]);
$total = $ADVANCE->advance_item_total([$uuid]);
$files = $ADVANCE->advance_file_view([$uuid]);
?>

<div class="card shadow">
  <h4 class="card-header text-center">Advance Clearing</h4>
  <div class="card-body">

    <form action="/advance-clear/update" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
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
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่เอกสาร</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm date-select" name="doc_date" value="<?php echo $row['doc_date'] ?>" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่ใบเบิก</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['advance_ticket'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ยอดเงินเบิก</label>
        <div class="col-xl-4 text-underline">
          <span class="usage"><?php echo number_format($row['amount'], 2) ?></span>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ยอดเงินที่ใช้จริง</label>
        <div class="col-xl-4 text-underline">
          <span class="usage"><?php echo number_format($row['usage'], 2) ?></span>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ยอดเงินที่เหลือคืน</label>
        <div class="col-xl-4 text-underline">
          <span class="remain"><?php echo number_format($row['remain'], 2) ?></span>
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
                  <th width="10%">จำนวนเงิน</th>
                  <th width="10%">VAT 7%</th>
                  <th width="10%">W/T</th>
                  <th width="10%">ยอดสุทธิ</th>
                  <th width="10%">ยอดที่เบิก</th>
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
                    <td class="text-left">
                      <input type="text" class="form-control form-control-sm text-left" name="item__text[]" value="<?php echo $item['text'] ?>" required>
                    </td>
                    <td>
                      <input type="number" class="form-control form-control-sm text-right amount-item" name="item__amount[]" value="<?php echo $item['amount'] ?>" max="<?php echo $item['remain'] ?>" required>
                      <div class="invalid-feedback">
                        กรุณากรอกข้อมูล!
                      </div>
                    </td>
                    <td>
                      <input type="number" class="form-control form-control-sm text-right vat-item" name="item__vat[]" value="<?php echo $item['vat'] ?>">
                    </td>
                    <td>
                      <input type="number" class="form-control form-control-sm text-right wt-item" name="item__wt[]" value="<?php echo $item['wt'] ?>">
                    </td>
                    <td class="text-right">
                      <span class="total-item"><?php echo number_format($item['total'], 2) ?></span>
                    </td>
                    <td class="text-right">
                      <?php echo number_format($item['request'], 2) ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td colspan="3" class="text-right">รวมทั้งสิ้น</td>
                  <td class="text-right">
                    <span class="amount-total"><?php echo number_format($total['amount'], 2) ?></span>
                  </td>
                  <td class="text-right">
                    <span class="vat-total"><?php echo number_format($total['vat'], 2) ?></span>
                  </td>
                  <td class="text-right">
                    <span class="wt-total"><?php echo number_format($total['wt'], 2) ?></span>
                  </td>
                  <td class="text-right">
                    <span class="all-total"><?php echo number_format($total['total'], 2) ?></span>
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
                    <a href="/src/Publics/advance-clear/<?php echo $file['name'] ?>" class="text-primary" target="_blank">
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
          <a class="btn btn-primary btn-sm btn-block" href="/advance-clear/print/<?php echo $row['uuid'] ?>" target="_blank">
            <i class="fas fa-print pr-2"></i>พิมพ์
          </a>
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
  initializeSelect2(".order-select", "/payment/order-select", "-- รายชื่อเลขที่สัญญา --");
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

    $('.amount-item').each(function() {
      var amount = parseFloat($(this).val()) || 0;
      totalAmount += amount;
    });

    $('.vat-item').each(function() {
      var vat = parseFloat($(this).val()) || 0;
      totalVat += vat;
    });

    $('.wt-item').each(function() {
      var wt = parseFloat($(this).val()) || 0;
      totalWt += wt;
    });

    grandTotal = totalAmount + totalVat - totalWt;

    $(".amount-total").text(totalAmount.toFixed(2).toLocaleString('th-TH', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }));
    $(".vat-total").text(totalVat.toFixed(2).toLocaleString('th-TH', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }));
    $(".wt-total").text(totalWt.toFixed(2).toLocaleString('th-TH', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }));
    $(".all-total").text(grandTotal.toFixed(2).toLocaleString('th-TH', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }));
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

  $(document).on("click", ".item-delete", function(e) {
    let id = $(this).prop("id");
    e.preventDefault();
    Swal.fire({
      title: "ยืนยันที่จะลบ?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ปิด",
    }).then((result) => {
      if (result.value) {
        axios.post("/advance-clear/item-delete", {
          id
        }).then((res) => {
          let result = res.data;
          if (result === 200) {
            Swal.fire({
              title: "ดำเนินการเรียบร้อย!",
              text: "",
              icon: "success"
            }).then((result) => {
              location.reload()
            });
          } else {
            Swal.fire({
              title: "ระบบมีปัญหา\nกรุณาลองใหม่อีกครั้ง!",
              text: "",
              icon: "error"
            }).then((result) => {
              location.reload()
            });
          }
        }).catch((error) => {
          console.log(error);
        });
      } else {
        return false;
      }
    })
  });

  $(document).on("click", ".file-delete", function(e) {
    let id = $(this).prop("id");
    e.preventDefault();
    Swal.fire({
      title: "ยืนยันที่จะลบ?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ปิด",
    }).then((result) => {
      if (result.value) {
        axios.post("/advance-clear/file-delete", {
          id
        }).then((res) => {
          let result = res.data;
          if (result === 200) {
            Swal.fire({
              title: "ดำเนินการเรียบร้อย!",
              text: "",
              icon: "success"
            }).then((result) => {
              location.reload()
            });
          } else {
            Swal.fire({
              title: "ระบบมีปัญหา\nกรุณาลองใหม่อีกครั้ง!",
              text: "",
              icon: "error"
            }).then((result) => {
              location.reload()
            });
          }
        }).catch((error) => {
          console.log(error);
        });
      } else {
        return false;
      }
    })
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