<?php
$menu = "Service";
$page = "ServiceBorrow";
include_once(__DIR__ . "/../layout/header.php");

$borrow_authorize = $BORROW->borrow_authorize([$user['login_id']]);
?>

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">ระบบใบยืมทรัพย์สิน</h4>
      </div>
      <div class="card-body">
        <div class="row justify-content-end mb-2">
          <?php if (intval($user['level']) === 9 || intval($borrow_authorize) > 0) : ?>
            <div class="col-xl-3 mb-2">
              <a href="/borrow/manage" class="btn btn-primary btn-sm btn-block">
                <i class="fas fa-bars pr-2"></i>จัดการระบบ
              </a>
            </div>
          <?php endif; ?>
          <div class="col-xl-3 mb-2">
            <a href="/borrow/create" class="btn btn-success btn-sm btn-block">
              <i class="fas fa-plus pr-2"></i>เพิ่ม
            </a>
          </div>
        </div>

        <?php if (intval($user['level']) === 9 || intval($borrow_authorize) === 1) : ?>
          <div class="row my-3">
            <div class="col-sm-12">
              <div class="card shadow">
                <div class="card-header">
                  <h4 class="text-center">รายการรอส่งมอบ - รอรับคืน</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover process-data">
                      <thead>
                        <tr>
                          <th width="10%">#</th>
                          <th width="10%">เลขที่เอกสาร</th>
                          <th width="10%">ผู้ใช้บริการ</th>
                          <th width="20%">ทรัพย์สิน</th>
                          <th width="10%">ระยะเวลา</th>
                          <th width="20%">วัตถุประสงค์</th>
                          <th width="10%">วันที่</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <div class="row my-3">
          <div class="col-sm-12">
            <div class="card shadow">
              <div class="card-header">
                <h4 class="text-center">รายการขอใช้บริการ</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-sm table-bordered table-hover request-data">
                    <thead>
                      <tr>
                        <th width="10%">#</th>
                        <th width="10%">เลขที่เอกสาร</th>
                        <th width="10%">ผู้ใช้บริการ</th>
                        <th width="20%">ทรัพย์สิน</th>
                        <th width="10%">ระยะเวลา</th>
                        <th width="20%">วัตถุประสงค์</th>
                        <th width="10%">วันที่</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  filter_datatable();

  function filter_datatable() {
    $(".request-data").DataTable({
      serverSide: true,
      searching: true,
      order: false,
      ajax: {
        url: "/borrow/request-data",
        type: "POST",
      },
      columnDefs: [{
        targets: [0, 1],
        className: "text-center",
      }, {
        targets: [2, 3, 4, 5, 6],
        className: "text-left",
      }],
      "oLanguage": {
        "sLengthMenu": "แสดง _MENU_ ลำดับ ต่อหน้า",
        "sZeroRecords": "ไม่พบข้อมูลที่ค้นหา",
        "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ ลำดับ",
        "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 ลำดับ",
        "sInfoFiltered": "",
        "sSearch": "ค้นหา :",
        "oPaginate": {
          "sFirst": "หน้าแรก",
          "sLast": "หน้าสุดท้าย",
          "sNext": "ถัดไป",
          "sPrevious": "ก่อนหน้า"
        }
      },
    });

    $(".process-data").DataTable({
      serverSide: true,
      searching: true,
      order: false,
      ajax: {
        url: "/borrow/process-data",
        type: "POST",
      },
      columnDefs: [{
        targets: [0, 1],
        className: "text-center",
      }, {
        targets: [2, 3, 4, 5, 6],
        className: "text-left",
      }],
      "oLanguage": {
        "sLengthMenu": "แสดง _MENU_ ลำดับ ต่อหน้า",
        "sZeroRecords": "ไม่พบข้อมูลที่ค้นหา",
        "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ ลำดับ",
        "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 ลำดับ",
        "sInfoFiltered": "",
        "sSearch": "ค้นหา :",
        "oPaginate": {
          "sFirst": "หน้าแรก",
          "sLast": "หน้าสุดท้าย",
          "sNext": "ถัดไป",
          "sPrevious": "ก่อนหน้า"
        }
      },
    });
  };
</script>