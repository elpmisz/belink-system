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
?>

<div class="card shadow">
  <div class="card-header">
    <h4 class="text-center">ระบบใบค้างจ่าย Outstanding Invoice</h4>
  </div>
  <div class="card-body">

    <form action="/outstanding/approve" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
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
        <div class="col-xl-4 text-underline">
          <?php echo $row['department_number'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่เอกสาร</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['doc_date'] ?>
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
        <div class="col-xl-6 text-underline">
          <?php echo str_replace("\n", "<br>", $row['text']) ?>
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
                </tr>
              </thead>
              <tbody>
                <?php foreach ($items as $key => $item) : $key++; ?>
                  <tr>
                    <td class="text-center"><?php echo $key ?></td>
                    <td class="text-left"><?php echo $item['expense_name'] ?></td>
                    <td class="text-left"><?php echo $item['text'] ?></td>
                    <td class="text-right"><?php echo $item['amount'] ?></td>
                    <td class="text-left"><?php echo $item['unit'] ?></td>
                    <td class="text-right"><?php echo number_format($item['estimate'], 2) ?></td>
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
                    <a href="/src/Publics/outstanding/<?php echo $file['name'] ?>" class="text-primary" target="_blank">
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
              <span class="text-success">ผ่านอนุมัติ</span>
            </label>
            <label class="form-check-label px-3">
              <input class="form-check-input" type="radio" name="status" value="1" required>
              <span class="text-danger">ไม่ผ่านอนุมัติ</span>
            </label>
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เหตุผล</label>
        <div class="col-sm-6">
          <textarea class="form-control" name="reason" rows="4"></textarea>
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
  $(document).on("click", "input[name='status']", function() {
    let status = +($(this).val() || 0);
    if (status === 1) {
      $("textarea[name='reason']").prop("required", true);
    } else {
      $("textarea[name='reason']").prop("required", false);
    }
  });
</script>