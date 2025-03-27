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
$remarks = $PURCHASE->purchase_remark_view([$uuid]);
?>

<div class="card shadow">
  <h4 class="card-header text-center">ระบบใบขอซื้อ Purchase Request</h4>
  <div class="card-body">

    <form action="/purchase/approve" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
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
          <?php echo $user['fullname'] ?>
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
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่ PO</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['po'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">หน่วยงานที่ขอซื้อ</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['department'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">วันที่ต้องการใช้</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['date'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่สัญญา SO</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['order_number'] ?>
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
        <label class="col-xl-2 offset-xl-2 col-form-label">อ้างอิงเอกสาร(ถ้ามี)</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['reference'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เหตุผลในการขอซื้อ <br>/ งบประมาณที่เตรียมไว้</label>
        <div class="col-xl-6 text-underline">
          <?php echo str_replace("\n", "<br>", $row['objective']) ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">หมายเหตุ</label>
        <div class="col-xl-6 text-underline">
          <?php echo str_replace("\n", "<br>", $row['remark']) ?>
        </div>
      </div>

      <div class="row mb-2 items-custom-div">
        <div class="col-xl-12">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th width="20%">รายจ่าย</th>
                  <th width="20%">รายละเอียด</th>
                  <th width="10%">จำนวนเงิน</th>
                  <th width="10%">หน่วย</th>
                  <th width="10%">ประมาณการ<br>ราคา</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($items as $key => $item) : $key++; ?>
                  <tr>
                    <td class="text-center"><?php echo $key ?></td>
                    <td class="text-left"><?php echo $item['expense_name'] ?></td>
                    <td class="text-left"><?php echo $item['text'] ?></td>
                    <td class="text-right"><?php echo $item['amount'] ?></td>
                    <td class="text-center"><?php echo $item['unit'] ?></td>
                    <td class="text-right"><?php echo number_format($item['estimate'], 2) ?></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td colspan="5" class="text-right">รวมทั้งสิ้น</td>
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