<?php
$menu = "Service";
$page = "ServicePurchase";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\Purchase;

$PURCHASE = new Purchase();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $PURCHASE->purchase_view([$uuid]);
$items = $PURCHASE->purchase_item_view([$uuid]);
$total = $PURCHASE->purchase_item_total([$uuid]);
$files = $PURCHASE->purchase_file_view([$uuid]);
?>

<div class="card shadow">
  <h4 class="card-header text-center">Purchase Request</h4>
  <div class="card-body">

    <form action="/purchase/update" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
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
        <label class="col-xl-2 offset-xl-2 col-form-label">ผู้ใช้บริการ</label>
        <div class="col-xl-4 text-underline">
          <?php echo $user['fullname'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">หน่วยงานที่ขอซื้อ</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="department" value="<?php echo $row['department'] ?>" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่ต้องการใช้</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm date-select" name="date" value="<?php echo $row['date'] ?>">
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่สัญญา</label>
        <div class="col-xl-4">
          <select class="form-control form-control-sm order-select" name="order_number">
            <?php
            if (!empty($row['order_number'])) {
              echo "<option value='{$row['order_number']}'>{$row['order_number']}</option>";
            }
            ?>
          </select>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <?php if (!empty($row['order_number'])) : ?>
        <div class="order-div">
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อลูกค้า</label>
            <div class="col-xl-4 text-underline">
              <span class="order-customer"><?php echo $row['customer_name'] ?></span>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">สินค้า</label>
            <div class="col-xl-4 text-underline">
              <span class="order-product"><?php echo $row['product_name'] ?></span>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วัตถุประสงค์</label>
        <div class="col-xl-6">
          <textarea class="form-control form-control-sm" rows="5" name="objective" required><?php echo $row['objective'] ?></textarea>
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
                  <th width="50%">รายการสินค้า/บริการ</th>
                  <th width="10%">จำนวน</th>
                  <th width="10%">หน่วย</th>
                  <th width="10%">ราคา</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($items as $key => $item) : $key++; ?>
                  <tr>
                    <td class="text-center">
                      <a href="javascript:void(0)" class="badge badge-danger font-weight-light item-delete" id="<?php echo $item['id'] ?>">ลบ</a>
                      <input type="hidden" class="form-control form-control-sm text-center" name="item__id[]" value="<?php echo $item['id'] ?>" readonly>
                    </td>
                    <td class="text-left">
                      <input type="text" class="form-control form-control-sm" name="item__name[]" value="<?php echo $item['name'] ?>" required>
                      <div class="invalid-feedback">
                        กรุณากรอกข้อมูล!
                      </div>
                    </td>
                    <td>
                      <input type="number" class="form-control form-control-sm text-right amount-item" name="item__amount[]" value="<?php echo $item['amount'] ?>" required>
                      <div class="invalid-feedback">
                        กรุณากรอกข้อมูล!
                      </div>
                    </td>
                    <td>
                      <input type="text" class="form-control form-control-sm item-unit" name="item__unit[]" value="<?php echo $item['unit'] ?>" required>
                      <div class="invalid-feedback">
                        กรุณากรอกข้อมูล!
                      </div>
                    </td>
                    <td>
                      <input type="number" class="form-control form-control-sm text-right item-estimate" value="<?php echo $item['estimate'] ?>" min="1" step="0.01" name="item__estimate[]" required>
                      <div class="invalid-feedback">
                        กรุณากรอกข้อมูล!
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <tr class="item-tr">
                  <td class="text-center">
                    <button type="button" class="btn btn-sm btn-success item-increase">+</button>
                    <button type="button" class="btn btn-sm btn-danger item-decrease">-</button>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm text-left item-name" name="item_name[]">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm text-right item-amount" min="1" step="0.01" name="item_amount[]">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm item-unit" name="item_unit[]">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm text-right item-estimate" min="1" step="0.01" name="item_estimate[]">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right">รวมทั้งสิ้น</td>
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
                    <a href="/src/Publics/purchase/<?php echo $file['name'] ?>" class="text-primary" target="_blank">
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
          <a class="btn btn-primary btn-sm btn-block" href="/purchase/print/<?php echo $row['uuid'] ?>" target="_blank">
            <i class="fas fa-print pr-2"></i>พิมพ์
          </a>
        </div>
        <div class="col-xl-3 mb-2">
          <a class="btn btn-danger btn-sm btn-block" href="/purchase">
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

  $(".item-decrease, .file-decrease").hide();
  $(document).on("click", ".item-increase", function() {
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
    updateTotal();
  });

  $(document).on("blur", ".item-name", function() {
    const name = ($(this).val() || "");
    if (name) {
      $(".item-amount, .item-unit, .item-estimate").prop("required", true);
    } else {
      $(".item-amount, .item-unit, .item-estimate").prop("required", false);
    }
  });

  $(document).on("blur", ".item-estimate", function() {
    updateTotal();
  })

  function updateTotal() {
    let totalEstimate = 0;

    $('.item-estimate').each(function() {
      var estimate = parseFloat($(this).val()) || 0;
      totalEstimate += estimate;
    });

    $(".all-total").text(totalEstimate.toFixed(2).toLocaleString('th-TH', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }));
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
    minDate: new Date(),
    locale: {
      "format": "DD/MM/YYYY",
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

  $(document).on("change", ".order-select", function() {
    const order = $(this).val() || 0;

    if (order) {
      $(".order-div").show();
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
    } else {
      $(".order-div").hide();
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
        axios.post("/purchase/item-delete", {
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
        axios.post("/purchase/file-delete", {
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
</script>