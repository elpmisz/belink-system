<?php
$menu = "Setting";
$page = "SettingAuthorize";
include_once(__DIR__ . "/../layout/header.php");

$users = $USER->user_read();
?>
<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">จัดการสิทธิ์</h4>
      </div>
      <div class="card-body">

        <div class="row mb-2">
          <div class="col-xl-12">
            <form method="GET" action="">
              <input type="text" name="keyword" class="form-control" placeholder="ค้นหาชื่อ" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
            </form>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="10%">#</th>
                    <th width="20%">ชื่อ</th>
                    <?php foreach ($services as $service) : ?>
                      <th><?php echo $service['name'] ?></th>
                    <?php endforeach; ?>
                  </tr>
                  <?php
                  foreach ($users as $row) :
                    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                    if ($keyword && stripos($row['fullname'], $keyword) === false) {
                      continue;
                    }
                  ?>
                    <tr>
                      <form action="/authorize/update" method="POST">
                        <td class="text-center">
                          <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-check"></i></button>
                          <input type="hidden" name="login_id" value="<?php echo $row['login_id'] ?>" readonly>
                        </td>
                        <td><?php echo $row['fullname'] ?></td>
                        <?php
                        $user_authorize = explode(",", $row['service']);
                        foreach ($services as $key => $value) :
                          $checked = (isset($user_authorize[$key]) ? $user_authorize[$key] : "");
                        ?>
                          <td class="text-center">
                            <input type="hidden" name="<?php echo "service[{$key}]" ?>" value="0">
                            <input type="checkbox" name="<?php echo "service[{$key}]" ?>" value="1" <?php echo (intval($checked) === 1 ? "checked" : "") ?>>
                          </td>
                        <?php endforeach; ?>
                      </form>
                    </tr>
                  <?php endforeach; ?>
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