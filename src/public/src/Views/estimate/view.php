<?php
$menu = "Service";
$page = "ServiceEstimate";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\Estimate;

$ESTIMATE = new Estimate();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $ESTIMATE->estimate_view([$uuid]);
$items = $ESTIMATE->estimate_item_view([$uuid]);
$files = $ESTIMATE->estimate_file_view([$uuid]);
$remarks = $ESTIMATE->estimate_remark_view([$uuid]);
?>

<div class="card shadow">
  <h4 class="card-header text-center">Estimate Budget</h4>
  <div class="card-body">

    <form action="/estimate/estimate-update" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
      <div class="row mb-2" style="display: none;">
        <label class="col-xl-2 offset-xl-2 col-form-label">ID</label>
        <div class="col-xl-2">
          <input type="text" class="form-control form-control-sm" name="id" value="<?php echo $row['id'] ?>" readonly>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2" style="display: none;">
        <label class="col-xl-2 offset-xl-2 col-form-label">UUID</label>
        <div class="col-xl-2">
          <input type="text" class="form-control form-control-sm" name="uuid" value="<?php echo $row['uuid'] ?>" readonly>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">พนักงานขาย</label>
            <div class="col-xl-4 text-underline">
              <?php echo $row['username'] ?>
            </div>
          </div>
          <div class="old-customer">
            <div class="row mb-2">
              <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อลูกค้า</label>
              <div class="col-xl-4">
                <select class="form-control form-control-sm customer-select" name="customer_id" required>
                  <?php
                  if (!empty($row['customer_id'])) {
                    echo "<option value='{$row['customer_id']}'>{$row['customer_name']}</option>";
                  }
                  ?>
                </select>
                <div class="invalid-feedback">
                  กรุณากรอกข้อมูล!!
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่สัญญา</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="order_number" value="<?php echo $row['order_number'] ?>" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">สินค้า</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="product_name" value="<?php echo $row['product_name'] ?>" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">หัวข้อเรื่อง</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="title_name" value="<?php echo $row['title_name'] ?>" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อการขาย</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="sales_name" value="<?php echo $row['sales_name'] ?>" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">งบประมาณ</label>
            <div class="col-xl-4">
              <input type="number" class="form-control form-control-sm" name="budget" min="0" step="0.01" value="<?php echo $row['budget'] ?>" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ประเภท</label>
            <div class="col-xl-8">
              <div class="row pb-2">
                <div class="col-xl-3">
                  <label class="form-check-label px-3">
                    <input class="form-check-input" type="radio" name="type" value="1" <?php echo (intval($row['type']) === 1 ? "checked" : "") ?> required>
                    <span class="text-success">Event</span>
                  </label>
                </div>
                <div class="col-xl-3">
                  <label class="form-check-label px-3">
                    <input class="form-check-input" type="radio" name="type" value="2" <?php echo (intval($row['type']) === 2 ? "checked" : "") ?> required>
                    <span class="text-danger">Online</span>
                  </label>
                </div>
                <div class="col-xl-3">
                  <label class="form-check-label px-3">
                    <input class="form-check-input" type="radio" name="type" value="3" <?php echo (intval($row['type']) === 3 ? "checked" : "") ?> required>
                    <span class="text-primary">รับจ้างผลิต</span>
                  </label>
                </div>
                <div class="col-xl-3">
                  <label class="form-check-label px-3">
                    <input class="form-check-input" type="radio" name="type" value="4" <?php echo (intval($row['type']) === 4 ? "checked" : "") ?> required>
                    <span class="text-info">อื่นๆ</span>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="row justify-content-center mb-2">
            <div class="col-sm-12">
              <div class="table-responsive">
                <table class="table table-bordered table-sm item-table">
                  <thead>
                    <tr>
                      <th width="10%">#</th>
                      <th width="40%">รายจ่าย</th>
                      <th width="20%">งบประมาณ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($items as $item) :
                    ?>
                      <tr>
                        <td class="text-center">
                          <a href="javascript:void(0)" class="badge badge-danger font-weight-light item-delete" id="<?php echo $item['id'] ?>">ลบ</a>
                          <input type="hidden" class="form-control form-control-sm text-center" name="item__id[]" value="<?php echo $item['id'] ?>" readonly>
                        </td>
                        <td class="text-left"><?php echo $item['expense_name'] ?></td>
                        <td class="text-left">
                          <input type="number" class="form-control form-control-sm" name="item__estimate[]" value="<?php echo $item['estimate'] ?>" min="1" required>
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
                      <td class="text-left">
                        <select class="form-control form-control-sm expense-select" name="item_expense[]"></select>
                        <div class="invalid-feedback">
                          กรุณากรอกข้อมูล!
                        </div>
                      </td>
                      <td>
                        <input type="number" class="form-control form-control-sm" name="item_estimate[]" min="1">
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
                        <a href="/src/Publics/estimate/<?php echo $file['name'] ?>" class="text-primary" target="_blank">
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
                <tr class="tr-file">
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
              <textarea class="form-control form-control-sm" rows="5" name="remark"><?php echo $row['remark'] ?></textarea>
              <div class="invalid-feedback">
                กรุณา กรอกข้อมูล!
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php if (COUNT($remarks) > 0) : ?>
        <div class="row justify-content-center mb-2">
          <div class="col-xl-10">
            <hr>
            <div class="h5 text-primary">รายละเอียดการดำเนินการ</div>
            <div class="table-responsive">
              <table class="table table-sm table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="10%">#</th>
                    <th width="20%">ผู้ดำเนินการ</th>
                    <th width="60%">รายละเอียดการ</th>
                    <th width="10%">วันที่</th>
                  </tr>
                </thead>
                <?php
                foreach ($remarks as $remark) :
                ?>
                  <tr>
                    <td class="text-center">
                      <span class="badge badge-<?php echo $remark['status_color'] ?> font-weight-light">
                        <?php echo $remark['status_name'] ?>
                      </span>
                    </td>
                    <td class="text-center"><?php echo $remark['username'] ?></td>
                    <td class="text-left"><?php echo str_replace("\r\n", "<br>", $remark['text']) ?></td>
                    <td class="text-center"><?php echo $remark['created'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="row justify-content-center">
        <div class="col-sm-6 col-xl-3 mb-2">
          <button type="submit" class="btn btn-success btn-sm btn-block">
            <i class="fas fa-check pr-2"></i>ยืนยัน
          </button>
        </div>
        <div class="col-sm-6 col-xl-3 mb-2">
          <a class="btn btn-primary btn-sm btn-block" href="/estimate/print/<?php echo $row['uuid'] ?>" target="_blank">
            <i class="fas fa-print pr-2"></i>พิมพ์
          </a>
        </div>
        <div class="col-sm-6 col-xl-3 mb-2">
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
  initializeSelect2(".expense-select", "/estimate/expense-select", "-- รายชื่อรายจ่าย --");

  $(".item-decrease").hide();
  $(document).on("click", ".item-increase", function() {
    $(".expense-select").select2('destroy');
    let row = $(".item-tr:last");
    let clone = row.clone();
    clone.find("input, select").val("");
    clone.find("span").text("");
    clone.find(".item-increase").hide();
    clone.find(".item-decrease").show();
    clone.find(".item-decrease").on("click", function() {
      $(this).closest("tr").remove();
    });

    row.after(clone);
    clone.show();
    initializeSelect2(".expense-select", "/estimate/expense-select", "-- รายชื่อรายจ่าย --");
  });

  $(".file-decrease").hide();
  $(document).on("click", ".file-increase", function() {
    let row = $(".tr-file:last");
    let clone = row.clone();
    clone.find("input").val("");
    clone.find(".file-increase").hide();
    clone.find(".file-decrease").show();
    clone.find(".file-decrease").on("click", function() {
      $(this).closest("tr").remove();
    });
    row.after(clone);
    clone.show();
  });

  $(document).on("change", "input[name='file[]']", function() {
    let file = $(this).val();
    let size = ($(this)[0].files[0].size / (1024 * 1024)).toFixed(2);
    let extension = file.split(".").pop().toLowerCase();
    let allow = ["png", "jpeg", "jpg", "pdf", "doc", "docx", "xls", "xlsx"];
    if (size > 5) {
      Swal.fire({
        icon: "error",
        title: "ไฟล์เอกสารไม่เกิน 5 Mb!",
      })
      $(this).val("");
    }

    if ($.inArray(extension, allow) === -1) {
      Swal.fire({
        icon: "error",
        title: "เฉพาะไฟล์นามสกุล JPG, PNG, WORD และ EXCEL เท่านั้น",
      })
      $(this).val("");
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
        axios.post("/estimate/item-delete", {
          id: id
        }).then((res) => {
          let result = res.data;
          console.log(result)
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
        axios.post("/estimate/file-delete", {
          id: id
        }).then((res) => {
          let result = res.data;
          console.log(result)
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