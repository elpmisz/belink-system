<?php
$menu = "Service";
$page = "ServiceIssue";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="card shadow">
  <div class="card-header">
    <h4 class="text-center">จัดการระบบ</h4>
  </div>
  <div class="card-body">

    <div class="row justify-content-end mb-2">
      <div class="col-xl-3 mb-2">
        <input type="text" class="form-control form-control-sm date-select" placeholder="-- วันที่ --">
      </div>
      <div class="col-xl-3 mb-2">
        <select class="form-control form-control-sm user-select"></select>
      </div>
      <div class="col-xl-3 mb-2">
        <select class="form-control form-control-sm type-select"></select>
      </div>
      <div class="col-xl-3 mb-2">
        <a href="/issue/authorize" class="btn btn-primary btn-sm btn-block">
          <i class="fas fa-bars pr-2"></i>สิทธิ์
        </a>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-xl-12">
        <div class="table-responsive">
          <table class="table table-sm table-bordered table-hover manage-data">
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

<div class="row justify-content-center my-3">
  <div class="col-xl-3">
    <a class="btn btn-danger btn-sm btn-block" href="/issue">
      <i class="fas fa-arrow-left pr-2"></i>หน้าหลัก
    </a>
  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  initializeSelect2(".user-select", "/issue/user-select", "-- ผู้ใช้บริการ --");
  initializeSelect2(".type-select", "/issue/type-select", "-- ประเภท --");

  filter_datatable();

  $(document).on("change", ".date-select ,.user-select, .type-select", function() {
    filter();
  });

  function filter() {
    let date = ($('.date-select').val() !== null ? $('.date-select').val() : '');
    let user = ($('.user-select').val() !== null ? $('.user-select').val() : '');
    let type = ($('.type-select').val() !== null ? $('.type-select').val() : '');

    if (date || user || type) {
      $('.manage-data').DataTable().destroy();
      filter_datatable(date,user,type);
    } else {
      $('.manage-data').DataTable().destroy();
      filter_datatable();
    }
  }

  function filter_datatable(date,user,type) {
    $(".manage-data").DataTable({
      serverSide: true,
      searching: true,
      order: false,
      ajax: {
        url: "/issue/manage-data",
        type: "POST",
        data: {
          date,
          user,
          type,
        }
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

  $(".date-select").on("keydown paste", function(e) {
    e.preventDefault();
  });

  $(".date-select").daterangepicker({
    autoUpdateInput: false,
    showDropdowns: true,
    startDate: moment(),
    endDate: moment().startOf("day").add(1, "day"),
    locale: {
      "format": "DD/MM/YYYY",
      "applyLabel": "ยืนยัน",
      "cancelLabel": "ยกเลิก",
      "daysOfWeek": [
        "อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"
      ],
      "monthNames": [
        "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
        "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
      ]
    },
    "applyButtonClasses": "btn-success",
    "cancelClass": "btn-danger"
  });

  $(".date-select").on("apply.daterangepicker", function(ev, picker) {
    $(this).val(picker.startDate.format("DD/MM/YYYY") + " - " + picker.endDate.format("DD/MM/YYYY"));
    filter();
  });

  $(".date-select").on("cancel.daterangepicker", function(ev, picker) {
    $(this).val("");
    filter();
  });
</script>