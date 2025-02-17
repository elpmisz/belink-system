<?php
$menu = "Service";
$page = "ServiceExpense";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">ข้อมูลรายจ่าย</h4>
      </div>
      <div class="card-body">

        <div class="row justify-content-end mb-2">
          <div class="col-xl-3 mb-2">
            <select class="form-control form-control-sm expense-select" name="reference"></select>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/expense/create" class="btn btn-success btn-sm btn-block">
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
                    <th width="10%">เลขที่</th>
                    <th width="40%">ชื่อ</th>
                    <th width="40%">อ้างอิง</th>
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


<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  filter_datatable();

  $(document).on("change", ".expense-select", function() {
    let expense = ($(this).val() ? $(this).val() : "");
    if (expense) {
      $(".request-data").DataTable().destroy();
      filter_datatable(expense);
    } else {
      $(".request-data").DataTable().destroy();
      filter_datatable();
    }
  });

  initializeSelect2(".expense-select", "/expense/expense-select", "-- ประเภทรายจ่าย --");

  function filter_datatable(expense) {
    $(".request-data").DataTable({
      serverSide: true,
      searching: false,
      order: [],
      pageLength: 25,
      ajax: {
        url: "/expense/request-data",
        type: "POST",
        data: {
          expense: expense
        }
      },
      columnDefs: [{
        targets: [0, 1],
        className: "text-center",
      }, {
        targets: [2, 3],
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