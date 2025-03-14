<?php
$menu = "Setting";
$page = "SettingUser";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">ตำแหน่ง</h4>
      </div>
      <div class="card-body">

        <div class="row justify-content-end mb-2">
          <div class="col-xl-3 mb-2">
            <a href="/position/create" class="btn btn-success btn-sm btn-block">
              <i class="fas fa-plus pr-2"></i>เพิ่ม
            </a>
          </div>
        </div>

        <div class="row my-3">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-sm table-bordered table-hover request-data">
                <thead>
                  <tr>
                    <th width="10%">#</th>
                    <th width="50%">ชื่อ</th>
                    <th width="20%">MIN</th>
                    <th width="20%">MAX</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>

        <div class="row justify-content-center mb-2">
          <div class="col-xl-3 mb-2">
            <a href="/user" class="btn btn-danger btn-sm btn-block">
              <i class="fas fa-arrow-left pr-2"></i>กลับ
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  filter_datatable();

  function filter_datatable(expense) {
    $(".request-data").DataTable({
      serverSide: true,
      searching: false,
      order: [],
      pageLength: 25,
      ajax: {
        url: "/position/request-data",
        type: "POST",
        data: {
          expense: expense
        }
      },
      columnDefs: [{
        targets: [0],
        className: "text-center",
      }, {
        targets: [1],
        className: "text-left",
      }, {
        targets: [2,3],
        className: "text-right",
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