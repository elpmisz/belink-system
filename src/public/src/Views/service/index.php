<?php
$menu = "Setting";
$page = "SettingService";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\Service;

$SERVICE = new Service();
$services = $SERVICE->service_read();
?>

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">เมนูบริการ</h4>
      </div>
      <div class="card-body">

        <form action="/service/create" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">

          <div class="row justify-content-center mb-2">
            <div class="col-sm-11">
              <div class="table-responsive">
                <table class="table table-bordered table-sm item-table">
                  <thead>
                    <tr>
                      <th width="10%">#</th>
                      <th width="10%">ลำดับ</th>
                      <th width="40%">บริการ</th>
                      <th width="20%">URL</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($services as $key => $service) : $key++ ?>
                      <tr>
                        <td class="text-center">
                          <a href='javascript:void(0)' class='badge badge-danger font-weight-light item-delete' id='<?php echo $service['uuid'] ?>'>ลบ</a>
                          <input type="hidden" class="form-control form-control-sm text-center item-sequence" name="item__uuid[]" value="<?php echo $service['uuid'] ?>">
                        </td>
                        <td>
                          <input type="text" class="form-control form-control-sm text-center item-sequence" name="item__sequence[]" value="<?php echo $key ?>">
                        </td>
                        <td>
                          <input type="text" class="form-control form-control-sm text-left item-sequence" name="item__name[]" value="<?php echo $service['name'] ?>">
                        </td>
                        <td>
                          <input type="text" class="form-control form-control-sm text-left item-url" name="item__url[]" value="<?php echo $service['url'] ?>">
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <tr class="item-tr">
                      <td class="text-center">
                        <button type="button" class="btn btn-sm btn-success item-increase">+</button>
                        <button type="button" class="btn btn-sm btn-danger item-decrease">-</button>
                      </td>
                      <td>
                        <input type="text" class="form-control form-control-sm text-center item-sequence" name="item_sequence[]">
                        <div class="invalid-feedback">
                          กรุณากรอกข้อมูล!
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control form-control-sm text-left item-name" name="item_name[]">
                        <div class="invalid-feedback">
                          กรุณากรอกข้อมูล!
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control form-control-sm text-left item-url" name="item_url[]">
                        <div class="invalid-feedback">
                          กรุณากรอกข้อมูล!
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="row justify-content-center mb-2">
            <div class="col-xl-3 mb-2">
              <button type="submit" class="btn btn-sm btn-success btn-block">
                <i class="fas fa-check pr-2"></i>ยืนยัน
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
  $(".item-decrease").hide();
  $(document).on("click", ".item-increase", function() {
    $(".item-select").select2('destroy');
    const row = $(".item-tr:last");
    const clone = row.clone();
    clone.find("input, select, textarea, span").val("").empty();
    clone.find(".item-increase").hide();
    clone.find(".item-decrease").show();
    clone.find(".item-decrease").on("click", function() {
      $(this).closest("tr").remove();
    });
    row.after(clone);
    clone.show();
  });

  $(document).on("blur", ".item-sequence", function() {
    const sequence = +($(this).val() || 0);
    if (sequence !== 0) {
      $(".item-name").prop("required", true);
    } else {
      $(".item-name").prop("required", false);
    }
  });

  $(document).on("click", ".item-delete", function(e) {
    const uuid = $(this).prop("id");
    e.preventDefault();
    Swal.fire({
      title: "ยืนยันที่จะทำรายการ?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ปิด",
    }).then((result) => {
      if (result.value) {
        axios.post("/service/delete", {
          uuid
        }).then((res) => {
          let result = parseInt(res.data);
          if (result === 200) {
            Swal.fire({
              title: "ดำเนินการเรียบร้อย!",
              text: "",
              icon: "success"
            }).then((result) => {
              location.reload()
            });
          } else {
            Swal.fire({
              title: "ระบบมีปัญหา\nกรุณาลองใหม่อีกครั้ง!",
              text: "",
              icon: "error"
            }).then((result) => {
              location.reload()
            });
          }
        }).catch((error) => {
          console.log(error);
        });
      } else {
        return false;
      }
    })
  });
</script>