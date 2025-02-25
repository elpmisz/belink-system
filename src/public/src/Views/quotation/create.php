<?php
$menu = "Service";
$page = "ServiceQuotation";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="card shadow">
  <h4 class="card-header text-center">Quotation</h4>
  <div class="card-body">

    <form action="/quotation/create" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ผู้ใช้บริการ</label>
        <div class="col-xl-4 text-underline">
          <?php echo $user['fullname'] ?>
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
        <label class="col-xl-2 offset-xl-2 col-form-label">ที่อยู่ผู้เปิด</label>
        <div class="col-xl-4">
          <select class="form-control form-control-sm biller-select" name="biller" required></select>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2 div-biller-address">
        <label class="col-xl-2 offset-xl-2 col-form-label">ที่อยู่ผู้เปิด</label>
        <div class="col-xl-4">
          <textarea class="form-control form-control-sm biller-address-view" rows="5" readonly></textarea>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ประเภทลูกค้า</label>
        <div class="col-xl-8">
          <div class="row pb-2">
            <div class="col-xl-4">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="customer_type" value="1" required>
                <span class="text-success">ลูกค้าเก่า</span>
              </label>
            </div>
            <div class="col-xl-4">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="customer_type" value="2" required>
                <span class="text-danger">ลูกค้าใหม่</span>
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-2 div-old-customer">
        <label class="col-xl-2 offset-xl-2 col-form-label">ที่อยู่ผู้รับ</label>
        <div class="col-xl-4">
          <select class="form-control form-control-sm customer-select" name="customer_id"></select>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2 div-customer-address">
        <label class="col-xl-2 offset-xl-2 col-form-label">ที่อยู่ผู้รับ</label>
        <div class="col-xl-4">
          <textarea class="form-control form-control-sm customer-address-view" rows="5" readonly></textarea>
          <div class="invalid-feedback">
            กรุณา กรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="div-new-customer">
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อผู้รับ</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm customer-name" name="customer_name">
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ที่อยู่ผู้รับ</label>
          <div class="col-xl-4">
            <textarea class="form-control form-control-sm customer-address" rows="5" name="customer_address"></textarea>
            <div class="invalid-feedback">
              กรุณา กรอกข้อมูล!
            </div>
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

      <div class="row mb-2">
        <div class="col-xl-12">
          <div class="table-responsive">
            <table class="table table-bordered table-sm">
              <tr>
                <th width="10%">#</th>
                <th width="30%">รายการสินค้า</th>
                <th width="15%">ราคา</th>
                <th width="15%">ส่วนลด</th>
                <th width="15%">จำนวน</th>
                <th width="15%">รวม</th>
              </tr>
              <tr class="item-tr">
                <td class="text-center">
                  <button type="button" class="btn btn-sm btn-success item-increase">+</button>
                  <button type="button" class="btn btn-sm btn-danger item-decrease">-</button>
                </td>
                <td>
                  <input type="text" class="form-control form-control-sm text-left item-product" name="item_product[]" required>
                  <div class="invalid-feedback">
                    กรุณากรอกข้อมูล!
                  </div>
                </td>
                <td>
                  <input type="number" class="form-control form-control-sm text-center item-price" name="item_price[]" required>
                  <div class="invalid-feedback">
                    กรุณากรอกข้อมูล!
                  </div>
                </td>
                <td>
                  <input type="text" class="form-control form-control-sm text-center item-discount" name="item_discount[]">
                </td>
                <td>
                  <input type="number" class="form-control form-control-sm text-center item-amount" name="item_amount[]" required>
                  <div class="invalid-feedback">
                    กรุณากรอกข้อมูล!
                  </div>
                </td>
                <td>
                  <input type="text" class="form-control form-control-sm text-center item-total" readonly>
                </td>
              </tr>
              <tr>
                <td colspan="5" class="text-right">ยอดรวม</td>
                <td class="text-right total"></td>
              </tr>
              <tr>
                <td colspan="5" class="text-right">Vat 7%</td>
                <td class="text-right vat"></td>
              </tr>
              <tr>
                <td colspan="5" class="text-right">ยอดรวมทั้งหมด</td>
                <td class="text-right summary"></td>
              </tr>
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
          <a class="btn btn-danger btn-sm btn-block" href="/quotation">
            <i class="fas fa-arrow-left pr-2"></i>หน้าหลัก
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  initializeSelect2(".biller-select", "/estimate/customer-select", "-- รายชื่อผู้เปิด --");
  initializeSelect2(".customer-select", "/estimate/customer-select", "-- รายชื่อผู้รับ --");

  $(".item-decrease, .file-decrease, .div-old-customer, .div-new-customer, .div-biller-address, .div-customer-address").hide();

  $(document).on("change", ".biller-select", function(){
    const customer = $(this).val() || '';
    
    if (customer) {
      $(".div-biller-address").show();
      axios.post("/quotation/address-view", {
        customer
        })
        .then((res) => {
          const result = res.data;
          $(".biller-address-view").val(result.contact)
        })
        .catch((error) => {
          console.error(error);
        });
    } else {
      $(".div-biller-address").hide();
    }
  });

  $(document).on("change", ".customer-select", function(){
    const customer = $(this).val() || '';
    
    if (customer) {
      $(".div-customer-address").show();
      axios.post("/quotation/address-view", {
        customer
        })
        .then((res) => {
          const result = res.data;
          $(".customer-address-view").val(result.contact)
        })
        .catch((error) => {
          console.error(error);
        });
    } else {
      $(".div-customer-address").hide();
    }
  });

  $(document).on("click", "input[name='customer_type']", function(){
    const isOldCustomer = +$(this).val() === 1;

    $(".div-old-customer").toggle(isOldCustomer);
    $(".div-new-customer").toggle(!isOldCustomer);
    
    $(".customer-select").prop("required", isOldCustomer);
    $(".customer-name, .customer-address").prop("required", !isOldCustomer);
  });

  $(document).on("click", ".item-increase", function() {
    let row = $(".item-tr:last");
    let clone = row.clone();
    clone.find("input, select").val("");
    clone.find(".item-increase").hide();
    clone.find(".item-decrease").show();
    clone.find(".item-decrease").on("click", function() {
      $(this).closest("tr").remove();
    });
    row.after(clone);
  });

  $(document).on("click", ".file-increase", function() {
    let row = $(".file-tr:last");
    let clone = row.clone();
    clone.find("input, select").val("").empty();
    clone.find("span").text("");
    clone.find(".file-increase").hide();
    clone.find(".file-decrease").show();
    clone.find(".file-decrease").on("click", function() {
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

  $(document).on("blur", ".item-price, .item-discount, .item-amount", function() {
    let row = $(this).closest("tr");
    const price = parseFloat(row.find(".item-price").val()) || 0;
    const amount = +row.find(".item-amount").val() || 0;
    let discount = row.find(".item-discount").val();

    if (price) {
      if (discount.includes('%')) {
        discount = parseFloat(discount.replace('%', '')) || 0;
        discount = (discount / 100) * price;
      } else {
        discount = parseFloat(discount) || 0;
      }

      const total = (price - discount) * amount;
      row.find(".item-total").val(total);
    }

    calculateTotal();
  });

  function calculateTotal() {
    let total = 0;
    let vat = 0;

    $(".item-total").each(function() {
      let value = parseFloat($(this).val()) || 0;
      total += value;
    });

    vat = total * 0.07;

    let summary = total + vat;

    console.log(total)
    console.log(vat)
    console.log(summary)
    

    $(".total").text(formatNumber(total));
    $(".vat").text(formatNumber(vat));
    $(".summary").text(formatNumber(summary));
  }

  function formatNumber(number) {
    return number.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

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