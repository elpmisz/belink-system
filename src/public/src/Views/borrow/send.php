<?php
$menu = "Service";
$page = "ServiceBorrow";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\Borrow;

$BORROW = new Borrow();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $BORROW->borrow_view([$uuid]);
$items = $BORROW->item_view([$uuid]);
$files = $BORROW->file_view([$uuid]);
?>

<div class="card shadow">
  <h4 class="card-header text-center">ระบบยืมทรัพย์สิน</h4>
  <div class="card-body">

    <form action="/borrow/process" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
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
        <label class="col-xl-2 offset-xl-2 col-form-label">ผู้ใช้บริการ</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['username'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่ขึ้นของ</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['date'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่จัดงาน</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['event_date'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่องาน</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['event_name'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">พนักงานขาย</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['sale'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">สถานที่ต้นทาง</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['location_start'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">สถานที่ปลายทาง</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['location_end'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วัตถุประสงค์</label>
        <div class="col-xl-6 text-underline">
          <?php echo str_replace("\n", "<br>", $row['objective']) ?>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-xl-12">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="10%">#</th>
                  <th width="20%">ทรัพย์สิน</th>
                  <th width="20%">สถานที่</th>
                  <th width="60%">รายละเอียด</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($items as $key => $item) : $key++; ?>
                  <tr>
                    <td class="text-center"><?php echo $key ?></td>
                    <td><?php echo $item['asset_name'] ?></td>
                    <td><?php echo $item['location_name'] ?></td>
                    <td><?php echo $item['text'] ?></td>
                  </tr>
                <?php endforeach; ?>
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
                    <a href="/src/Publics/borrow/<?php echo $file['name'] ?>" class="text-primary" target="_blank">
                      <span class="badge badge-primary font-weight-light">ดาวน์โหลด!</span>
                    </a>
                  </td>
                </tr>
            <?php
              endif;
            endforeach;
            ?>
          </table>
        </div>
      </div>

      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">สถานะ</label>
        <div class="col-xl-8">
          <div class="form-group pl-3 pt-2">
            <label class="form-check-label px-3">
              <input class="form-check-input" type="radio" name="status" value="2" required>
              <span class="text-success">ส่งมอบ</span>
            </label>
            <label class="form-check-label px-3">
              <input class="form-check-input" type="radio" name="status" value="4" required>
              <span class="text-danger">ไม่ผ่านอนุมัติ</span>
            </label>
          </div>
        </div>
      </div>
      <div class="row mb-2 div-send-date" style="display: none;">
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่ส่งมอบ</label>
        <div class="col-xl-4">
          <input type="text" class="form-control form-control-sm date-select" name="date">
          <div class="invalid-feedback">
            กรุณากรอกข้อมูล!
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">หมายเหตุ</label>
        <div class="col-sm-6">
          <textarea class="form-control" name="reason" rows="4" required></textarea>
          <div class="invalid-feedback">
            กรุณา กรอกข้อมูล!
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-xl-3 mb-2">
          <button type="submit" class="btn btn-success btn-sm btn-block">
            <i class="fas fa-check pr-2"></i>ยืนยัน
          </button>
        </div>
        <div class="col-xl-3 mb-2">
          <a class="btn btn-danger btn-sm btn-block" href="/borrow">
            <i class="fas fa-arrow-left pr-2"></i>หน้าหลัก
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  $(document).on("click", "input[name='status']", function() {
    const status = ($(this).val() || "");

    if (parseInt(status) === 4) {
      $(".div-send-date").hide();
      $(".date-select").prop("required", false);
    } else {
      $(".div-send-date").show();
      $(".date-select").prop("required", true);
    }
  });

  $(".date-select").daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
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
</script>