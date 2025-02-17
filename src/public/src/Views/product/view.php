<?php
$menu = "Service";
$page = "ServiceProduct";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\Product;

$PRODUCT = new Product();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $PRODUCT->product_view([$uuid]);
$files = $PRODUCT->file_view([$row['id']]);
$issue = $PRODUCT->product_issue([$row['id']]);
$summary = $PRODUCT->product_summary([$row['id']]);
?>

<div class="card shadow">
  <h4 class="card-header text-center">ข้อมูลทรัพย์สิน</h4>
  <div class="card-body">

    <form action="/product/update" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">

      <?php if (count($files) > 0) : ?>
        <div class="row mb-2 justify-content-center">
          <div class="col-xl-4">
            <div id="control" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <?php foreach ($files as $key => $file) : ?>
                  <div class="carousel-item <?php echo ($key === 0 ? "active" : "") ?>">
                    <img src="/src/Publics/product/<?php echo $file['name'] ?>" class="d-block w-100 product-image" alt="product-image">
                  </div>
                <?php endforeach; ?>
              </div>
              <button class="carousel-control-prev" type="button" data-target="#control" data-slide="prev">
              </button>
              <button class="carousel-control-next" type="button" data-target="#control" data-slide="next">
              </button>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label"></label>
          <div class="col-xl-8">
            <table class="table table-sm table-borderless">
              <?php
              foreach ($files as $key => $file) :
                $key++;
              ?>
                <tr>
                  <td width="10%">
                    <a href="javascript:void(0)" class="badge badge-danger font-weight-light file-delete" id="<?php echo $file['id'] ?>">ลบ</a>
                  </td>
                  <td width="90%">
                    <a href="/src/Publics/product/<?php echo $file['name'] ?>" target="_blank">
                      <?php echo "{$row['name']}_{$key}" ?>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
        </div>
      <?php endif; ?>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">รูปทรัพย์สิน</label>
        <div class="col-xl-6">
          <table class="table table-borderless">
            <tr class="file-tr">
              <td class="text-center" width="5%">
                <button type="button" class="btn btn-sm btn-success file-increase">+</button>
                <button type="button" class="btn btn-sm btn-danger file-decrease">-</button>
              </td>
              <td>
                <input type="file" class="form-control-file" name="file[]" accept=".jpeg, .png, .jpg">
              </td>
            </tr>
          </table>
        </div>
      </div>
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
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อ</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="name" value="<?php echo $row['name'] ?>" required>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่ทรัพย์สิน</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm" name="code" value="<?php echo $row['code'] ?>">
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ประเภท</label>
        <div class="col-sm-4">
          <select class="form-control form-control-sm type-select" name="type_id" required>
            <?php
            if (!empty($row['type_id'])) {
              echo "<option value='{$row['type_id']}' selected>{$row['type_name']}</option>";
            }
            ?>
          </select>
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-xl-6">
          <div class="row mb-2">
            <label class="col-xl-3 offset-xl-1 col-form-label">คลัง</label>
            <div class="col-xl-8">
              <select class="form-control form-control-sm warehouse-select" name="warehouse_id" required>
                <?php
                if (!empty($row['warehouse_id'])) {
                  echo "<option value='{$row['warehouse_id']}' selected>{$row['warehouse_name']}</option>";
                }
                ?>
              </select>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-3 offset-xl-1 col-form-label">สถานที่</label>
            <div class="col-xl-8">
              <select class="form-control form-control-sm location-select" name="location_id">
                <?php
                if (!empty($row['location_id'])) {
                  echo "<option value='{$row['location_id']}' selected>{$row['location_name']}</option>";
                }
                ?>
              </select>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6">
          <div class="row mb-2">
            <label class="col-xl-3 offset-xl-1 col-form-label">ยี่ห้อ</label>
            <div class="col-xl-8">
              <select class="form-control form-control-sm brand-select" name="brand_id">
                <?php
                if (!empty($row['brand_id'])) {
                  echo "<option value='{$row['brand_id']}' selected>{$row['brand_name']}</option>";
                }
                ?>
              </select>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-3 offset-xl-1 col-form-label">หน่วยนับ</label>
            <div class="col-xl-8">
              <select class="form-control form-control-sm unit-select" name="unit_id">
                <?php
                if (!empty($row['unit_id'])) {
                  echo "<option value='{$row['unit_id']}' selected>{$row['unit_name']}</option>";
                }
                ?>
              </select>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">หมายเหตุ</label>
        <div class="col-xl-6">
          <textarea class="form-control form-control-sm" name="text" rows="4"><?php echo $row['text'] ?></textarea>
        </div>
      </div>

      <?php if (count($summary) > 0) : ?>
        <div class="row mb-2">
          <div class="col-xl-12">
            <h5>สรุป</h5>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="20%">คลัง</th>
                    <th width="20%">นำเข้า</th>
                    <th width="20%">เบิกออก</th>
                    <th width="20%">คงเหลือ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($summary as $key => $sum) : $key++; ?>
                    <tr>
                      <td class="text-left"><?php echo $sum['warehouse_name'] ?></td>
                      <td class="text-right text-success"><?php echo number_format($sum['income'], 2) ?></td>
                      <td class="text-right text-danger"><?php echo number_format($sum['outcome'], 2) ?></td>
                      <td class="text-right text-primary"><?php echo number_format($sum['remain'], 2) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if (count($issue) > 0) : ?>
        <div class="row mb-2">
          <div class="col-xl-12">
            <h5>ประวัติการทำรายการ</h5>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="10%">เลขที่เอกสาร</th>
                    <th width="20%">ผู้ใช้บริการ</th>
                    <th width="10%">ประเภท</th>
                    <th width="20%">คลัง</th>
                    <th width="20%">จำนวน</th>
                    <th width="10%">วันที่</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($issue as $key => $item) : $key++; ?>
                    <tr>
                      <td class="text-center">
                        <a href="/issue/complete/<?php echo $item['uuid'] ?>" target="_blank"><?php echo $item['ticket'] ?></a>
                      </td>
                      <td class="text-left"><?php echo $item['username'] ?></td>
                      <td class="text-center">
                        <span class="badge badge-<?php echo $item['type_color'] ?> font-weight-light"><?php echo $item['type_name'] ?></span>
                      </td>
                      <td class="text-left"><?php echo $item['warehouse_name'] ?></td>
                      <td class="text-right"><?php echo number_format($item['confirm'], 2) ?></td>
                      <td class="text-right"><?php echo $item['created'] ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">สถานะ</label>
        <div class="col-xl-8">
          <div class="row pb-2">
            <div class="col-xl-3">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="status" value="1" <?php echo intval($row['status']) === 1 ? "checked" : "" ?> required>
                <span class="text-success">ใช้งาน</span>
              </label>
            </div>
            <div class="col-xl-3">
              <label class="form-check-label px-3">
                <input class="form-check-input" type="radio" name="status" value="2" <?php echo intval($row['status']) === 2 ? "checked" : "" ?> required>
                <span class="text-danger">ระงับการใช้งาน</span>
              </label>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center mb-2">
        <div class="col-xl-3 mb-2">
          <button type="submit" class="btn btn-sm btn-success btn-block">
            <i class="fas fa-check pr-2"></i>ยืนยัน
          </button>
        </div>
        <div class="col-xl-3 mb-2">
          <a href="/product" class="btn btn-sm btn-danger btn-block">
            <i class="fa fa-arrow-left pr-2"></i>กลับ
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
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
    const allowedExtensions = ["png", "jpeg", "jpg"];

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
        title: "เฉพาะไฟล์นามสกุล JPG และ PNG เท่านั้น",
      });
      return $(this).val("");
    }
  });

  initializeSelect2(".type-select", "/product/type-select", "-- ประเภท --");
  initializeSelect2(".warehouse-select", "/product/warehouse-select", "-- คลัง --");
  initializeSelect2(".location-select", "/product/location-select", "-- สถานที่ --");
  initializeSelect2(".brand-select", "/product/brand-select", "-- ยี่ห้อ --");
  initializeSelect2(".unit-select", "/product/unit-select", "-- หน่วยนับ --");

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
        axios.post("/product/file-delete", {
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