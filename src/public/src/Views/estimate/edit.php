<?php
$menu = "Service";
$page = "ServiceEstimate";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\Estimate;

$ESTIMATE = new Estimate();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $ESTIMATE->estimate_view([$uuid]);
$files = $ESTIMATE->estimate_file_view([$uuid]);
$remarks = $ESTIMATE->estimate_remark_view([$uuid]);
$reference = $ESTIMATE->estimate_item_reference([$uuid]);
$payments = $ESTIMATE->payment_order([$row['order_number']]);
$profit = ($row['budget'] - $row['cost']);
$gp = (($profit * 100) / $row['budget']);
?>

<div class="card shadow">
  <h4 class="card-header text-center">ระบบใบ Estimate Budget</h4>
  <div class="card-body">

    <form action="/estimate/approve" method="POST" class="needs-validation" novalidate>
      <div style="display: none;">
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ID</label>
          <div class="col-xl-2">
            <input type="text" class="form-control form-control-sm" name="id" value="<?php echo $row['id'] ?>" readonly>
            <div class="invalid-feedback">
              กรุณากรอกข้อมูล!
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">UUID</label>
          <div class="col-xl-2">
            <input type="text" class="form-control form-control-sm" name="uuid" value="<?php echo $row['uuid'] ?>" readonly>
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
        <label class="col-xl-2 offset-xl-2 col-form-label">พนักงานขาย</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['username'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่เอกสาร</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['doc_date'] ?>
        </div>
      </div>
      <div class="old-customer">
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อลูกค้า</label>
          <div class="col-xl-4 text-underline">
            <?php echo $row['customer_name'] ?>
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
        <label class="col-xl-2 offset-xl-2 col-form-label">สินค้า</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['product_name'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">หัวข้อเรื่อง</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['title_name'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อการขาย</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['sales_name'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">งบประมาณ</label>
        <div class="col-xl-4 text-underline text-primary">
          <?php echo number_format($row['budget'], 2) ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">รายจ่าย</label>
        <div class="col-xl-4 text-underline text-danger">
          <?php echo number_format($row['cost'], 2) ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">GP</label>
        <div class="col-xl-4 text-underline text-success">
          <?php echo number_format($profit, 2) . ' (' . round($gp, 2) . '% )' ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ประเภท</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['type_name'] ?>
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
                </tr>
            <?php
              endif;
            endforeach;
            ?>
          </table>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">หมายเหตุ</label>
        <div class="col-xl-4 text-underline">
          <?php echo str_replace("\n", "<br>", $row['remark']) ?>
        </div>
      </div>

      <?php
      if (COUNT($reference) > 0) :
        foreach ($reference as $ref) :
      ?>
          <div class="row justify-content-center mb-2">
            <div class="col-sm-12">
              <div class="h5"><?php echo $ref['reference_name'] ?></div>
              <div class="table-responsive">
                <table class="table table-bordered table-sm item-table">
                  <thead>
                    <tr>
                      <th width="10%">#</th>
                      <th width="30%">รายจ่าย</th>
                      <th width="15%">งบประมาณ</th>
                      <th width="15%">จำนวน</th>
                      <th width="15%">ยอดใช้</th>
                      <th width="15%">คงเหลือ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $items = $ESTIMATE->estimate_item_view([$uuid], $ref['reference']);
                    $total = 0;
                    foreach ($items as $key => $item) :
                      $key++;
                      $total += $item['estimate'];
                    ?>
                      <tr>
                        <td class="text-center"><?php echo $key ?></td>
                        <td class="text-left"><?php echo $item['expense_name'] ?></td>
                        <td class="text-right"><?php echo number_format($item['estimate'], 2) ?></td>
                        <td class="text-center"><?php echo $item['count'] ?></td>
                        <td class="text-right"><?php echo number_format($item['usage'], 2) ?></td>
                        <td class="text-right"><?php echo number_format($item['remain'], 2) ?></td>
                      </tr>
                    <?php endforeach; ?>
                    <tr>
                      <td class="text-center h5" colspan="2">รวม</td>
                      <td class="text-right h5"><?php echo number_format($total, 2) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      <?php
        endforeach;
      endif;
      ?>

      <?php if (COUNT($payments) > 0) : ?>
        <div class="row justify-content-center mb-2">
          <div class="col-xl-10">
            <hr>
            <div class="h5 text-primary">รายการใบอนุมัติสั่งจ่าย</div>
            <div class="table-responsive">
              <table class="table table-sm table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="10%">#</th>
                    <th width="10%">เลขที่เอกสาร</th>
                    <th width="10%">ผู้ใช้บริการ</th>
                    <th width="10%">เลขที่สัญญา</th>
                    <th width="10%">จ่ายให้</th>
                    <th width="10%">ยอดรวม</th>
                    <th width="10%">วันที่</th>
                  </tr>
                </thead>
                <?php
                foreach ($payments as $payment) :
                ?>
                  <tr>
                    <td class="text-center">
                      <a href="/payment/complete/<?php echo $payment['uuid'] ?>" class="badge badge-<?php echo $payment['status_color'] ?> font-weight-light" target="_blank">
                        <?php echo $payment['status_name'] ?>
                      </a>
                    </td>
                    <td class="text-center"><?php echo $payment['ticket'] ?></td>
                    <td class="text-left"><?php echo $payment['username'] ?></td>
                    <td class="text-center"><?php echo $payment['order_number'] ?></td>
                    <td class="text-left"><?php echo $payment['receiver'] ?></td>
                    <td class="text-right"><?php echo number_format($payment['total'], 2) ?></td>
                    <td class="text-center"><?php echo $payment['created'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      <?php endif; ?>

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
        <div class="col-xl-3 mb-2">
          <a class="btn btn-primary btn-sm btn-block" href="/estimate/print/<?php echo $row['uuid'] ?>" target="_blank">
            <i class="fas fa-print pr-2"></i>พิมพ์
          </a>
        </div>
        <div class="col-xl-3 mb-2">
          <a class="btn btn-danger btn-sm btn-block" href="/estimate/manage">
            <i class="fas fa-arrow-left pr-2"></i>หน้าหลัก
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>