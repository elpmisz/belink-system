<?php
$menu = "Service";
$page = "ServiceAccrued";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">ระบบใบค้างจ่าย Outstanding Invoice</h4>
      </div>
      <div class="card-body">

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