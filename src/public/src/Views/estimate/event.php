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
?>

<div class="card shadow">
  <h4 class="card-header text-center">ระบบใบ Estimate Budget</h4>
  <div class="card-body">

    <form action="/estimate/sale-update" method="POST" class="needs-validation" novalidate>
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
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อพนักงานขาย</label>
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
      <div class="old-customer">
        <div class="row mb-2">
          <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อลูกค้า</label>
          <div class="col-xl-4 text-underline">
            <?php echo $row['customer_name'] ?>
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่สัญญา SO</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['order_number'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่อสินค้า</label>
        <div class="col-xl-4 text-underline">
          <?php echo $row['product_name'] ?>
        </div>
      </div>
      <div class="row mb-2">
        <label class="col-xl-2 offset-xl-2 col-form-label">ชื่องาน</label>
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

      <div class="row justify-content-center mb-2">
        <div class="col-sm-12">
          <div class="table-responsive">
            <table class="table table-bordered table-sm item-table">
              <thead>
                <tr>
                  <th width="10%">#</th>
                  <th width="30%">Item Description</th>
                  <th width="20%">Detail 1</th>
                  <th width="20%">Detail 2</th>
                  <th width="20%">Amount (THB)</th>
                </tr>
              </thead>
              <tbody>
                <tr class="item-tr">
                  <td class="text-center">
                    <button type="button" class="btn btn-sm btn-success item-increase">+</button>
                    <button type="button" class="btn btn-sm btn-danger item-decrease">-</button>
                  </td>
                  <td>
                    <select class="form-control form-control-sm expense-select" name="item_expense[]" required></select>
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm text-left text-item" name="item_text[]" required>
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm text-left text2-item" name="item_text2[]" required>
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm text-right item-estimate" name="item_estimate[]" min="1" required>
                    <div class="invalid-feedback">
                      กรุณากรอกข้อมูล!
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right">รวมทั้งสิ้น</td>
                  <td class="text-right">
                    <span class="item-total"></span>
                  </td>
                </tr>
              </tbody>
            </table>
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
        <div class="col-xl-3 mb-2">
          <button type="submit" class="btn btn-success btn-sm btn-block">
            <i class="fas fa-check pr-2"></i>ยืนยัน
          </button>
        </div>
        <div class="col-xl-3 mb-2">
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
  initializeSelect2(".expense-select", "/estimate/expense-select", "-- รายชื่อรายจ่าย --");

  $(".item-decrease").hide();
  $(document).on("click", ".item-increase", function() {
    $(".expense-select").select2('destroy');

    let row = $(".item-tr:last");
    let clone = row.clone();
    clone.find("input, select").val("").empty();
    clone.find("span").text("");
    clone.find(".item-increase").hide();
    clone.find(".item-decrease").show();

    clone.find(".item-decrease").off("click").on("click", function() {
      $(this).closest("tr").remove();
    });

    row.after(clone);
    initializeSelect2(".expense-select", "/estimate/expense-select", "-- รายชื่อรายจ่าย --");

    $('.item-amount, .item-vat, .item-wt, .item-estimate').on('blur', function() {
      var value = $(this).val();

      value = value.replace(/[^0-9.]/g, '');

      var parts = value.split('.');
      if (parts.length > 2) {
        value = parts[0] + '.' + parts.slice(1).join('');
      }

      if (value) {
        value = parseFloat(value).toFixed(2);
      }

      $(this).val(value);
    });
  });

  updateTotal();

  $(document).on("input", ".item-estimate", function() {
    updateTotal();
  });

  function updateTotal() {
    let totalEstimate = 0;

    $(".item-estimate").each(function() {
      const estimate = +($(this).val() || 0);

      totalEstimate += estimate;
    });

    $(".item-total").text(totalEstimate.toFixed(2));
  }

  $('.item-amount, .item-vat, .item-wt, .item-estimate').on('blur', function() {
    var value = $(this).val();

    value = value.replace(/[^0-9.]/g, '');

    var parts = value.split('.');
    if (parts.length > 2) {
      value = parts[0] + '.' + parts.slice(1).join('');
    }

    if (value) {
      value = parseFloat(value).toFixed(2);
    }

    $(this).val(value);
  });
</script>