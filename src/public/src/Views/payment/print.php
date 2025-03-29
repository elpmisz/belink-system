<?php
$menu = "Service";
$page = "ServicePayment";

use App\Classes\Payment;
use App\Classes\Validation;

$PAYMENT = new Payment();
$VALIDATION = new Validation();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $PAYMENT->payment_view([$uuid]);
$total = $PAYMENT->payment_item_total([$uuid]);

ob_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>ระบบใบอนุมัติสั่งจ่าย Payment Order</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 75%;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 5px;
    }

    @page {
      margin: 1cm;
    }

    .no-border {
      border: 0 !important;
    }

    .bottom-border {
      border: 0;
      border-bottom: 1px solid #000 !important;
    }

    .text-center {
      vertical-align: middle;
      text-align: center;
    }

    .text-left {
      vertical-align: middle;
      text-align: left;
    }

    .text-right {
      vertical-align: middle;
      text-align: right;
    }
  </style>
</head>

<body>

  <!-- Header Section -->
  <table>
    <tr>
      <td class="text-left no-border" width="10%"></td>
      <td class="text-center no-border" width="50%">
        <h2>บริษัท บีลิงค์ มีเดีย จำกัด</h2>
      </td>
      <td class="no-border" width="20%">เลขที่เอกสาร</td>
      <td class="bottom-border" width="20%">
        <?php echo htmlspecialchars($row['department_number'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <tr>
      <td class="text-left no-border" width="10%"></td>
      <td class="text-center no-border" width="50%">
        <h2>ใบอนุมัติสั่งจ่าย Payment Order</h2>
      </td>
      <td class="no-border" width="20%">วันที่</td>
      <td class="bottom-border" width="20%">
        <?php echo htmlspecialchars($row['doc_date'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
  </table>

  <table style="margin-top: 10px;">
    <tr>
      <td class="no-border" width="20%">จ่ายให้</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['receiver'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%">จำนวนเงิน</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars(number_format($total['total'], 2), ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="20%">งบประมาณ /<br> ค่าใช้จ่ายของฝ่าย</td>
      <td colspan="3" class="bottom-border" width="80%">
        <?php echo htmlspecialchars(number_format($total['budget'], 2), ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
  </table>

  <table style="margin-top: 10px;">
    <tr>
      <td width="10%" class="text-center no-border">[<?php echo (intval($row['type']) === 1 ? "/" : "") ?>]</td>
      <td colspan="8" class="no-border">เงินสด/โอนเข้าบัญชี</td>
    </tr>
    <tr>
      <td width="10%" class="text-center no-border">[<?php echo (intval($row['type']) === 2 ? "/" : " ") ?>]</td>
      <td width="10%" class="no-border">เช็คธนาคาร</td>
      <td width="10%" class="bottom-border"></td>
      <td width="10%" class="text-center no-border">สาขา</td>
      <td width="10%" class="bottom-border"></td>
      <td width="10%" class="text-center no-border">เลขที่เช็ค</td>
      <td width="10%" class="bottom-border"></td>
      <td width="10%" class="text-center no-border">ลงวันที่</td>
      <td width="10%" class="bottom-border"></td>
    </tr>
  </table>

  <!-- Items Section -->
  <table style="margin-top: 10px;">
    <tr>
      <th width="5%">#</th>
      <th width="15%">รายจ่าย</th>
      <th width="15%">รายละเอียด</th>
      <th width="15%">รายละเอียด</th>
      <th width="10%">จำนวนเงิน</th>
      <th width="10%">VAT 7%</th>
      <th width="10%">W/T</th>
      <th width="10%">ยอดสุทธิ</th>
    </tr>
    <?php
    $items = $PAYMENT->payment_item_view([$uuid]);
    foreach ($items as $key => $item) :
      $key++;
    ?>
      <tr>
        <td class="text-center"><?php echo $key ?></td>
        <td class="text-left"><?php echo $item['expense_name'] ?></td>
        <td class="text-left"><?php echo $item['text'] ?></td>
        <td class="text-left"><?php echo $item['text2'] ?></td>
        <td class="text-right"><?php echo number_format($item['amount'], 2) ?></td>
        <td class="text-right"><?php echo number_format($item['vat'], 2) ?></td>
        <td class="text-right"><?php echo number_format($item['wt'], 2) ?></td>
        <td class="text-right"><?php echo number_format($item['total'], 2) ?></td>
      </tr>
    <?php
    endforeach;
    for ($i = (count($items) + 1); $i <= 20; $i++) :
    ?>
      <tr>
        <td class="text-center"><?php echo $i ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    <?php endfor; ?>
    <tr>
      <td colspan="3" class="text-center"><?php echo $VALIDATION->bathformat($total['total']) ?></td>
      <td class="text-right">รวมทั้งสิ้น</td>
      <td class="text-right"><?php echo number_format($total['amount'], 2) ?></td>
      <td class="text-right"><?php echo number_format($total['vat'], 2) ?></td>
      <td class="text-right"><?php echo number_format($total['wt'], 2) ?></td>
      <td class="text-right"><?php echo number_format($total['total'], 2) ?></td>
    </tr>
  </table>

  <!-- Footer Section -->
  <table style="margin-top: 10px;">
    <tr>
      <td rowspan="2" class="text-center" width="20%"><br><br>____________<br>ผู้ขอเบิก<br><br>วันที่____________</td>
      <td rowspan="2" class="text-center" width="20%"><br><br>____________<br>ผู้อนุมัติ<br><br>วันที่____________</td>
      <td rowspan="2" class="text-center" width="20%"><br><br>____________<br>ผู้รับเงิน<br><br>วันที่____________</td>
    </tr>
  </table>


</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'default_font' => 'garuda']);
$mpdf->WriteHTML($html);
$date = date('Ymd');
$mpdf->Output("{$date}_estimate_budget.pdf", 'I');
