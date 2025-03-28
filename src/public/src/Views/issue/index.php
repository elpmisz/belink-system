<?php
$menu = "Service";
$page = "ServiceIssue";
include_once(__DIR__ . "/../layout/header.php");

$issue_authorize = $ISSUE->issue_authorize([$user['login_id']]);
?>

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">ระบบใบนำเข้า-เบิกออก</h4>
      </div>
      <div class="card-body">

        <div class="row justify-content-end mb-2">
          <?php if (intval($user['level']) === 9 || intval($issue_authorize) > 0) : ?>
            <div class="col-xl-3 mb-2">
              <a href="/issue/manage" class="btn btn-primary btn-sm btn-block">
                <i class="fas fa-bars pr-2"></i>จัดการระบบ
              </a>
            </div>
          <?php endif; ?>
          <div class="col-xl-3 mb-2">
            <a href="/issue/income" class="btn btn-success btn-sm btn-block">
              <i class="fas fa-plus pr-2"></i>นำเข้าสินค้า
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/issue/outcome" class="btn btn-danger btn-sm btn-block">
              <i class="fas fa-plus pr-2"></i>นำออกสินค้า
            </a>
          </div>
        </div>

        <?php if (intval($user['level']) === 9 || intval($issue_authorize) === 1) : ?>
          <div class="row my-3">
            <div class="col-sm-12">
              <div class="card shadow">
                <div class="card-header">
                  <h4 class="text-center">รายการรอตรวจสอบ</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover approve-data">
                      <thead>
                        <tr>
                          <th width="10%">#</th>
                          <th width="10%">เลขที่เอกสาร</th>
                          <th width="10%">ผู้ใช้บริการ</th>
                          <th width="10%">ประเภท</th>
                          <th width="20%">สินค้า</th>
                          <th width="10%">วันที่</th>
                          <th width="20%">รายละเอียด</th>
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
                        <th width="10%">ประเภท</th>
                        <th width="20%">สินค้า</th>
                        <th width="10%">วันที่</th>
                        <th width="20%">รายละเอียด</th>
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
        url: "/issue/request-data",
        type: "POST",
      },
      columnDefs: [{
        targets: [0, 1, 3],
        className: "text-center",
      }, {
        targets: [2, 4, 5, 6, 7],
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

    $(".approve-data").DataTable({
      serverSide: true,
      searching: true,
      order: false,
      ajax: {
        url: "/issue/approve-data",
        type: "POST",
      },
      columnDefs: [{
        targets: [0, 1, 3],
        className: "text-center",
      }, {
        targets: [2, 4, 5, 6, 7],
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