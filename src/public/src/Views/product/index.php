<?php
$menu = "Setting";
$page = "SettingProduct";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">ข้อมูลสินค้า</h4>
      </div>
      <div class="card-body">

        <div class="row mb-2">
          <div class="col-xl-3 mb-2">
            <a href="/product-warehouse" class="btn btn-info btn-sm btn-block">
              <i class="fas fa-list pr-2"></i>คลัง
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/product-location" class="btn btn-info btn-sm btn-block">
              <i class="fas fa-list pr-2"></i>สถานที่
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/product-type" class="btn btn-info btn-sm btn-block">
              <i class="fas fa-list pr-2"></i>ประเภท
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/product-brand" class="btn btn-info btn-sm btn-block">
              <i class="fas fa-list pr-2"></i>ยี่ห้อ
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/product-unit" class="btn btn-info btn-sm btn-block">
              <i class="fas fa-list pr-2"></i>หน่วยนับ
            </a>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-xl-3 mb-2">
            <select class="form-control form-control-sm type-select"></select>
          </div>
          <div class="col-xl-3 mb-2">
            <select class="form-control form-control-sm warehouse-select"></select>
          </div>
          <div class="col-xl-3 mb-2">
            <select class="form-control form-control-sm location-select"></select>
          </div>
          <div class="col-xl-3 mb-2">
            <select class="form-control form-control-sm brand-select"></select>
          </div>
        </div>

        <div class="row justify-content-end mb-2">
          <div class="col-xl-3 mb-2">
            <button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#modal-upload">
              <i class="fas fa-upload pr-2"></i>นำข้อมูลเข้า
            </button>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block btn-download">
              <i class="fas fa-download pr-2"></i>นำข้อมูลออก
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/product/create" class="btn btn-success btn-sm btn-block">
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
                    <th width="10%">เลขที่ทรัพย์สิน</th>
                    <th width="40%">ชื่อ</th>
                    <th width="10%">ยี่ห้อ</th>
                    <th width="10%">ประเภท</th>
                    <th width="10%">คลัง</th>
                    <th width="10%">สถานที่</th>
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

<div class="modal fade" id="modal-upload" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form action="/product/upload" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
          <div class="row mb-2">
            <label class="col-xl-4 col-form-label text-right">เอกสาร</label>
            <div class="col-xl-8">
              <input type="file" class="form-control form-control-sm" name="file" required>
              <div class="invalid-feedback">
                กรุณาเลือกเอกสาร!
              </div>
            </div>
          </div>
          <div class="row justify-content-center mb-2">
            <div class="col-xl-4 mb-2">
              <button type="submit" class="btn btn-success btn-sm btn-block btn-submit">
                <i class="fas fa-check pr-2"></i>ยืนยัน
              </button>
            </div>
            <div class="col-xl-4 mb-2">
              <button class="btn btn-danger btn-sm btn-block" data-dismiss="modal">
                <i class="fa fa-times mr-2"></i>ปิด
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  filter_datatable();

  $(document).on("change", ".type-select, .warehouse-select, .location-select, .brand-select", function() {
    const type = ($(".type-select").val() || "");
    const warehouse = ($(".warehouse-select").val() || "");
    const location = ($(".location-select").val() || "");
    const brand = ($(".brand-select").val() || "");

    if (type || warehouse || location || brand) {
      $(".request-data").DataTable().destroy();
      filter_datatable(type, warehouse, location, brand);
    } else {
      $(".request-data").DataTable().destroy();
      filter_datatable();
    }
  });

  $(document).on("click", ".btn-download", function() {
    const type = ($(".type-select").val() || "");
    const warehouse = ($(".warehouse-select").val() || "");
    const location = ($(".location-select").val() || "");
    const brand = ($(".brand-select").val() || "");

    window.open("/product/download/" + type + "/" + warehouse + "/" + location + "/" + brand);
  });


  initializeSelect2(".type-select", "/product/type-select", "-- ประเภท --");
  initializeSelect2(".warehouse-select", "/product/warehouse-select", "-- คลัง --");
  initializeSelect2(".location-select", "/product/location-select", "-- สถานที่ --");
  initializeSelect2(".brand-select", "/product/brand-select", "-- ยี่ห้อ --");

  function filter_datatable(type, warehouse, location, brand) {
    $(".request-data").DataTable({
      serverSide: true,
      searching: true,
      order: false,
      pageLength: 25,
      ajax: {
        url: "/product/request-data",
        type: "POST",
        data: {
          type,
          warehouse,
          location,
          brand
        }
      },
      columnDefs: [{
        targets: [0, 1, 3, 4, 5, 6],
        className: "text-center",
      }, {
        targets: [2],
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