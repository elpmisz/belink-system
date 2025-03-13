<?php
$menu = "Service";
$page = "ServicePayment";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\Payment;

$PAYMENT = new Payment();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $PAYMENT->payment_view([$uuid]);
$items = $PAYMENT->payment_item_view([$uuid]);
$files = $PAYMENT->payment_file_view([$uuid]);
$total = $PAYMENT->payment_item_total([$uuid]);
$remarks = $PAYMENT->payment_remark_view([$uuid]);
?>

<div class="card shadow">
  <h4 class="card-header text-center">Payment Order</h4>
  <div class="card-body">

    <form action="/payment/approve" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
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
          <label class="col-xl-2 offset-xl-2 col-form-label">TYPE</label>
          <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm type-select" value="<?php echo $row['type'] ?>" readonly>
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
        <div class="col-xl-4 text-underline-link">
          <a href="/estimate/complete/<?php echo $row['estimate_uuid'] ?>" target="_blank"><?php echo $row['order_number'] ?></a>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">จ่ายให้</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['receiver'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ประเภท</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['type_name'] ?>
        </div>
      </div>

      <?php if (intval($row['type']) === 2) : ?>
        <div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ธนาคาร</label>
            <div class="col-xl-4 text-underline">
              <?php echo $row['cheque_bank'] ?>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">สาขา</label>
            <div class="col-xl-4 text-underline">
              <?php echo $row['cheque_branch'] ?>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่เช็ค</label>
            <div class="col-xl-4 text-underline">
              <?php echo $row['cheque_number'] ?>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ลงวันที่</label>
            <div class="col-xl-4 text-underline">
              <?php echo $row['cheque_date'] ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="row mb-2 items-custom-div">
        <div class="col-xl-12">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th width="15%">รายจ่าย</th>
                  <th width="15%">รายละเอียด</th>
                  <th width="15%">รายละเอียด</th>
                  <th width="10%">จำนวนเงิน</th>
                  <th width="10%">VAT 7%</th>
                  <th width="10%">W/T</th>
                  <th width="10%">ยอดสุทธิ</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($items as $key => $item) : $key++; ?>
                  <tr>
                    <td class="text-center"><?php echo $key ?></td>
                    <td class="text-left"><?php echo $item['expense_name'] ?></td>
                    <td class="text-left"><?php echo $item['text'] ?></td>
                    <td class="text-left"><?php echo $item['text2'] ?></td>
                    <td class="text-right"><?php echo number_format($item['amount'], 2) ?></td>
                    <td class="text-right"><?php echo number_format($item['vat'], 2) ?></td>
                    <td class="text-right"><?php echo number_format($item['wt'], 2) ?></td>
                    <td class="text-right">
                      <?php echo number_format($item['total'], 2) ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td colspan="4" class="text-right">รวมทั้งสิ้น</td>
                  <td class="text-right">
                    <span class="amount-total"><?php echo number_format($total['amount'], 2) ?></span>
                  </td>
                  <td class="text-right">
                    <span class="vat-total"><?php echo number_format($total['vat'], 2) ?></span>
                  </td>
                  <td class="text-right">
                    <span class="wt-total"><?php echo number_format($total['wt'], 2) ?></span>
                  </td>
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
                    <a href="/src/Publics/payment/<?php echo $file['name'] ?>" class="text-primary" target="_blank">
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
          <a class="btn btn-primary btn-sm btn-block" href="/payment/print/<?php echo $row['uuid'] ?>" target="_blank">
            <i class="fas fa-print pr-2"></i>พิมพ์
          </a>
        </div>
        <div class="col-xl-3 mb-2">
          <a class="btn btn-danger btn-sm btn-block" href="/payment">
            <i class="fas fa-arrow-left pr-2"></i>หน้าหลัก
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>