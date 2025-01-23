<?php
$menu = "Service";
$page = "ServicePayment";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="card shadow">
  <h4 class="card-header text-center">Payment Order</h4>
  <div class="card-body">

    <form action="/payment/create" method="POST" class="needs-validation" novalidate>
      <div class="row">
        <div class="col-xl-12">
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ผู้ใช้บริการ</label>
            <div class="col-xl-4 text-underline">
              <?php echo $user['fullname'] ?>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่สัญญา</label>
            <div class="col-xl-4">
              <select class="form-control form-control-sm order-select" name="order_number" required></select>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">จ่ายให้</label>
            <div class="col-xl-4">
              <input type="text" class="form-control form-control-sm" name="order_number" required>
              <div class="invalid-feedback">
                กรุณากรอกข้อมูล!
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-xl-2 offset-xl-2 col-form-label">ประเภท</label>
            <div class="col-xl-8">
              <div class="row pb-2">
                <div class="col-xl-4">
                  <label class="form-check-label px-3">
                    <input class="form-check-input" type="radio" name="type" value="1" required>
                    <span class="text-success">เงินสด / โอนเข้าบัญชี</span>
                  </label>
                </div>
                <div class="col-xl-4">
                  <label class="form-check-label px-3">
                    <input class="form-check-input" type="radio" name="type" value="2" required>
                    <span class="text-danger">เช็ค</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="cheque-div" style="display: none;">
            <div class="row mb-2">
              <label class="col-xl-2 offset-xl-2 col-form-label">ธนาคาร</label>
              <div class="col-xl-4">
                <input type="text" class="form-control form-control-sm" name="cheque_bank">
                <div class="invalid-feedback">
                  กรุณากรอกข้อมูล!
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <label class="col-xl-2 offset-xl-2 col-form-label">สาขา</label>
              <div class="col-xl-4">
                <input type="text" class="form-control form-control-sm" name="cheque_branch">
                <div class="invalid-feedback">
                  กรุณากรอกข้อมูล!
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <label class="col-xl-2 offset-xl-2 col-form-label">เลขที่เช็ค</label>
              <div class="col-xl-4">
                <input type="text" class="form-control form-control-sm" name="cheque_number">
                <div class="invalid-feedback">
                  กรุณากรอกข้อมูล!
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <label class="col-xl-2 offset-xl-2 col-form-label">ลงวันที่</label>
              <div class="col-xl-4">
                <input type="text" class="form-control form-control-sm" name="cheque_date">
                <div class="invalid-feedback">
                  กรุณากรอกข้อมูล!
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-2 items-div" style="display: none;">
            <div class="col-xl-12">
              <div class="table-responsive">
                <table class="table table-bordered items-table"></table>
              </div>
            </div>
          </div>

          <div class="row mb-2 items-custom-div">
          </div>

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
                    <tr class="item-tr">
                      <td class="text-center">
                        <button type="button" class="btn btn-sm btn-success item-increase">+</button>
                        <button type="button" class="btn btn-sm btn-danger item-decrease">-</button>
                      </td>
                      <td>
                        <select class="form-control form-control-sm expense-select" name="item_expense[]"></select>
                        <div class="invalid-feedback">
                          กรุณากรอกข้อมูล!
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control form-control-sm text-right">
                        <div class="invalid-feedback">
                          กรุณา กรอกข้อมูล!
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control form-control-sm text-right">
                        <div class="invalid-feedback">
                          กรุณา กรอกข้อมูล!
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control form-control-sm text-right">
                        <div class="invalid-feedback">
                          กรุณา กรอกข้อมูล!
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control form-control-sm text-right">
                        <div class="invalid-feedback">
                          กรุณา กรอกข้อมูล!
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control form-control-sm text-right">
                        <div class="invalid-feedback">
                          กรุณา กรอกข้อมูล!
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control form-control-sm text-right" required>
                        <div class="invalid-feedback">
                          กรุณา กรอกข้อมูล!
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-6 col-xl-3 mb-2">
          <button type="submit" class="btn btn-success btn-sm btn-block">
            <i class="fas fa-check pr-2"></i>ยืนยัน
          </button>
        </div>
        <div class="col-sm-6 col-xl-3 mb-2">
          <a class="btn btn-danger btn-sm btn-block" href="/payment">
            <i class="fas fa-arrow-left pr-2"></i>หน้าหลัก
          </a>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  initializeSelect2(".order-select", "/payment/order-select", "-- รายชื่อเลขที่สัญญา --");
  initializeSelect2(".expense-select", "/estimate/expense-select", "-- รายชื่อรายจ่าย --");

  $(".item-decrease").hide();
  $(document).on("click", ".item-increase", function() {
    $(".expense-select").select2('destroy');
    cloneRow(".item-tr", "input, select, span", ".item-increase", ".item-decrease");
    initializeSelect2(".expense-select", "/estimate/expense-select", "-- รายชื่อรายจ่าย --");
  });

  $(document).on("click", "input[name='type']", function() {
    const type = parseInt($(this).val()) || 0;
    const isCheque = type === 2;

    $(".cheque-div").toggle(isCheque);
    $("input[name='cheque_bank'], input[name='cheque_branch'], input[name='cheque_number'], input[name='cheque_date']")
      .prop("required", isCheque)
      .val(isCheque ? "" : "");
  });

  $(document).on("change", ".order-select", function() {
    const order = $(this).val() || 0;
    if (order === 0) {
      $(".items-custom-div").show();
    } else {
      $(".items-custom-div").hide();
    }

    axios.post("/payment/order-view", {
        order
      })
      .then((res) => {
        const items = res.data;
        let tableContent = '';

        if (items.length > 0) {
          tableContent = `
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
        `;

          items.forEach((item, index) => {
            tableContent += `
            <tr>
              <td class="text-center">${index + 1}</td>
              <td class="text-left">${item.expense_name}</td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
          `;
          });

          $(".items-div").show();
        } else {
          $(".items-div").hide();
        }

        $(".items-table").html(tableContent);
      })
      .catch((error) => {
        console.error(error);
      });
  });
</script>