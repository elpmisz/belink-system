<?php
$Home = (isset($menu) && ($menu === "home") ? "show" : "");
$HomeIndex = ($page === "HomeIndex" ? 'class="active"' : "");

$ServiceMenu = (isset($menu) && ($menu === "Service") ? "show" : "");
$ServiceEstimate = ($page === "ServiceEstimate" ? 'class="active"' : "");
$ServicePayment = ($page === "ServicePayment" ? 'class="active"' : "");
$ServiceAdvance = ($page === "ServiceAdvance" ? 'class="active"' : "");
$ServicePurchase = ($page === "ServicePurchase" ? 'class="active"' : "");
$ServiceBorrow = ($page === "ServiceBorrow" ? 'class="active"' : "");
$ServiceIssue = ($page === "ServiceIssue" ? 'class="active"' : "");

$UserMenu = (isset($menu) && ($menu === "User") ? "show" : "");
$UserProfile = ($page === "UserProfile" ? 'class="active"' : "");
$UserChange = ($page === "UserChange" ? 'class="active"' : "");

$SettingMenu = (isset($menu) && ($menu === "Setting") ? "show" : "");
$SettingSystem = ($page === "SettingSystem" ? 'class="active"' : "");
$SettingUser = ($page === "SettingUser" ? 'class="active"' : "");
$SettingService = ($page === "SettingService" ? 'class="active"' : "");
$SettingAuthorize = ($page === "SettingAuthorize" ? 'class="active"' : "");

function formatUrl($text)
{
  $text = ltrim($text, '/');

  if (strpos($text, '-') !== false) {
    $text = str_replace('-', ' ', $text);
    $text = ucwords($text);
    $text = str_replace(' ', '', $text);
  } else {
    $text = ucwords($text);
  }

  return $text;
}
?>
<nav id="sidebar">
  <ul class="list-unstyled">
    <li <?php echo $HomeIndex ?>>
      <a href="/home">หน้าหลัก</a>
    </li>
    <li>
      <a href="#user-menu" data-toggle="collapse" class="dropdown-toggle">ข้อมูลส่วนตัว</a>
      <ul class="collapse list-unstyled <?php echo $UserMenu ?>" id="user-menu">
        <li <?php echo $UserProfile ?>>
          <a href="/user/profile">
            <i class="fa fa-address-book pr-2"></i>
            รายละเอียด
          </a>
        </li>
        <li <?php echo $UserChange ?>>
          <a href="/user/change">
            <i class="fa fa-key pr-2"></i>
            เปลี่ยนรหัสผ่าน
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#service-menu" data-toggle="collapse" class="dropdown-toggle">
        บริการ
      </a>
      <ul class="collapse list-unstyled <?php echo $ServiceMenu ?>" id="service-menu">
        <?php
        foreach ($services as $key => $service) :
          $authorize_check = (isset($user_authorize[$key]) ? intval($user_authorize[$key]) : "");
          if ($authorize_check === 1) :
        ?>
            <li <?php echo ($page === "Service" . formatUrl($service['url']) ? 'class="active"' : "") ?>>
              <a href="<?php echo $service['url']  ?>">
                <i class="fa fa-bars pr-2"></i>
                <?php echo $service['name'] ?>
              </a>
            </li>
        <?php
          endif;
        endforeach;
        ?>
      </ul>
    </li>
    <?php if (intval($user['level']) === 9) : ?>
      <li>
        <a href="#setting-menu" data-toggle="collapse" class="dropdown-toggle">ตั้งค่า</a>
        <ul class="collapse list-unstyled <?php echo $SettingMenu ?>" id="setting-menu">
          <li <?php echo $SettingSystem ?>>
            <a href="/system">
              <i class="fa fa-gear pr-2"></i>
              ข้อมูลระบบ
            </a>
          </li>
          <li <?php echo $SettingUser ?>>
            <a href="/user">
              <i class="fa fa-gear pr-2"></i>
              ข้อมูลผู้ใช้งาน
            </a>
          </li>
          <li <?php echo $SettingService ?>>
            <a href="/service">
              <i class="fa fa-gear pr-2"></i>
              ข้อมูลบริการ
            </a>
          </li>
          <li <?php echo $SettingAuthorize ?>>
            <a href="/authorize">
              <i class="fa fa-gear pr-2"></i>
              ข้อมูลสิทธิ์
            </a>
          </li>
        </ul>
      </li>
    <?php endif; ?>
  </ul>
</nav>