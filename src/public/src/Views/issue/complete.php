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
$remarks = $ISSUE->remark_view([$uuid]);
?>

<div class="card shadow">
  <h4 class="card-header text-center"><?php echo "{$row['type_name']}สินค้า" ?></h4>
  <div class="card-body">

    <form action="/issue/approve" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
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
            <input type="text" class="form-control form-control-sm" name="type" value="<?php echo $row['type'] ?>" readonly>
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
        <label class="col-xl-2 offset-xl-2 col-form-label">ประเภท</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['type_name'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['date'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">รายละเอียด</label>
        <div class="col-xl-6 text-underline">
          <?php echo str_replace("\n", "<br>", $row['text']) ?>
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
                  <th width="20%">คลัง</th>
                  <th width="20%">ปริมาณ (<?php echo $row['type_name'] ?>)</th>
                  <th width="20%">ปริมาณ (ตรวจสอบ)</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($items as $key => $item) : $key++; ?>
                  <tr>
                    <td class="text-center">
                      <?php echo $key ?>
                      <input type="hidden" class="form-control form-control-sm text-center" name="item__id[]" value="<?php echo $item['id'] ?>" readonly>
                    </td>
                    <td class="text-left">
                      <a href="/product/view/<?php echo $item['uuid'] ?>" target="_blank"><?php echo $item['product_name'] ?></a>
                    </td>
                    <td class="text-left"><?php echo $item['warehouse_name'] ?></td>
                    <td class="text-right"><?php echo $item['amount'] ?></td>
                    <td class="text-right"><?php echo $item['confirm'] ?></td>
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
                    <a href="/src/Publics/issue/<?php echo $file['name'] ?>" class="text-primary" target="_blank">
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
                    <th width="40%">รายละเอียดการ</th>
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
                    <td class="text-left"><?php echo str_replace("\n", "<br>", $remark['text']) ?></td>
                    <td class="text-center"><?php echo $remark['created'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="row justify-content-center">
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