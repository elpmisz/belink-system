<?php
$menu = "Service";
$page = "ServiceIssue";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\Issue;

$ISSUE = new Issue();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $ISSUE->issue_view([$uuid]);
$items = $ISSUE->item_view([$uuid]);
$files = $ISSUE->file_view([$uuid]);
?>

<div class="card shadow">
  <h4 class="card-header text-center">ระบบใบนำเข้า-เบิกออก</h4>
  <div class="card-body">

    <form action="/issue/update" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
      <div style="display: none;">
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ID</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" name="id" value="<?php echo $row['id'] ?>" readonly>
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">UUID</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" name="uuid" value="<?php echo $row['uuid'] ?>" readonly>
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">TYPE</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm type-id" name="type" value="<?php echo $row['type'] ?>" readonly>
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
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
        <label class="col-xl-2 offset-xl-2 col-form-label">ประเภท</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['type_name'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่ขึ้นของ</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm date-select" name="date" value="<?php echo $row['date'] ?>" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <?php if (intval($row['type']) === 1) : ?>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">เลขอ้างอิง</label>
          <div class="col-xl-4">
            <select class="form-control form-control-sm outcome-select" name="outcome">
              <?php
              if (!empty($row['outcome'])) {
                echo "<option value='{$row['outcome']}' selected>{$row['outcome_name']}</option>";
              }
              ?>
            </select>
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
      <?php
      endif;

      if (intval($row['type']) === 2) :
      ?>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">วันที่จัดงาน</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm date-between-select" name="event_date" value="<?php echo $row['event_date'] ?>" required>
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ชื่องาน</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" name="event_name" value="<?php echo $row['event_name'] ?>" required>
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">พนักงานขาย</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" name="sale" value="<?php echo $row['sale'] ?>" required>
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">สถานที่ต้นทาง</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" name="location_start" value="<?php echo $row['location_start'] ?>" required>
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">สถานที่ปลายทาง</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" name="location_end" value="<?php echo $row['location_end'] ?>" required>
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">รายละเอียด</label>
        <div class="col-xl-6">
          <textarea class="form-control form-control-sm" rows="5" name="text" required><?php echo $row['text'] ?></textarea>
          <div class="invalid-feedback">
            กรุณา กรอกข้อมูล!
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-xl-12">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="10%">#</th>
                  <th width="20%">สินค้า</th>
                  <th width="10%">คลัง</th>
                  <th width="10%">ตำแหน่ง</th>
                  <th width="20%">ปริมาณ (คงเหลือ)</th>
                  <th width="20%">ปริมาณ (นำเข้า)</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($items as $key => $item) : $key++; ?>
                  <tr>
                    <td class="text-center">
                      <a href="javascript:void(0)" class="badge badge-danger font-weight-light item-delete" id="<?php echo $item['id'] ?>">ลบ</a>
                      <input type="hidden" class="form-control form-control-sm text-center" name="item__id[]" value="<?php echo $item['id'] ?>" readonly>
                    </td>
                    <td class="text-left"><?php echo $item['product_name'] ?></td>
                    <td class="text-center"><?php echo $item['warehouse_name'] ?></td>
                    <td class="text-center"><?php echo $item['location_name'] ?></td>
                    <td class="text-right"><?php echo $item['remain'] ?></td>
                    <td>
                      <input type="number" class="form-control form-control-sm text-right" value="<?php echo $item['amount'] ?>" min="1" max="<?php echo $item['remain'] ?>" step="0.01" name="item__amount[]" required>
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
                    <select class="form-control form-control-sm product-select" name="product_id[]"></select>
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <select class="form-control form-control-sm warehouse-select" name="warehouse_id[]">
                      <option value="1" selected>สาทร</option>
                    </select>
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td class="text-center product-location">
                  <td class="text-right product-remain">
                  <td>
                    <input type="number" class="form-control form-control-sm text-right item-amount" name="item_amount[]" min="1">
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
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
                    <a href="/src/Publics/issue/<?php echo $file['name'] ?>" class="text-primary" target="_blank">
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
          <a class="btn btn-danger btn-sm btn-block" href="/issue">
            <i class="fas fa-arrow-left pr-2"></i>หน้าหลัก
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  const typeId = parseInt($(".type-id").val() || 0);
  console.log(typeId)
  initializeSelect2(".outcome-select", "/issue/outcome-select", "-- ใบเบิกออก --");
  if (typeId === 1) {
    initializeSelect2(".product-select", "/issue/product-select", "-- สินค้า --");
  } else {
    initializeSelect2(".product-select", "/issue/product-stock-select", "-- สินค้า --");
  }
  initializeSelect2(".warehouse-select", "/issue/warehouse-select", "-- คลัง --");

  const selected = new Option("สาทร", 1, true, true);
  $(".warehouse-select").append(selected).trigger("change");

  $(".item-decrease, .file-decrease").hide();
  $(document).on("click", ".item-increase", function() {
    const row = $(".item-tr:last");
    const clone = row.clone();
    const typeId = parseInt($(".type-id").val() || 0);
    const selected = new Option("สาทร", 1, true, true);
    row.find(".warehouse-select").append(selected).trigger("change");
    clone.find("input, span, .product-select").val("").empty();
    clone.find("span").text("");
    clone.find(".item-increase").hide();
    clone.find(".item-decrease").show();
    clone.find(".item-decrease").off("click").on("click", function() {
      $(this).closest("tr").remove();
    });

    row.after(clone);
    if (typeId === 1) {
      initializeSelect2(".product-select", "/issue/product-select", "-- สินค้า --");
    } else {
      initializeSelect2(".product-select", "/issue/product-stock-select", "-- สินค้า --");
    }
    initializeSelect2(".warehouse-select", "/issue/warehouse-select", "-- คลัง --");
  });

  $(document).on("change", ".product-select, .warehouse-select", function() {
    const row = $(this).closest("tr");
    const product = (row.find(".product-select").val() || "");
    const warehouse = (row.find(".warehouse-select").val() || "");

    $(".product-select, .warehouse-select, .item-amount").prop("required", true);

    if (product && warehouse) {
      axios.post("/issue/product-remain", {
          product,
          warehouse,
        })
        .then((res) => {
          let result = res.data;
          row.find(".product-location").text(result.location_name);
          row.find(".product-remain").text(result.remain);
        }).catch((error) => {
          console.log(error);
        });
    } else {
      row.find(".product-remain").text("");
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
        axios.post("/issue/item-delete", {
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
        axios.post("/issue/file-delete", {
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