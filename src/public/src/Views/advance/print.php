<?php
$menu = "Service";
$page = "ServiceAdvance";

use App\Classes\Advance;
use App\Classes\Validation;

$ADVANCE = new Advance();
$VALIDATION = new Validation();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $ADVANCE->advance_view([$uuid]);
$total = $ADVANCE->advance_item_total([$uuid]);

ob_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>ใบเคลียร์เงินทดรองจ่าย (Advance Clearing Voucher)</title>
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
      <td class="text-center no-border" width="60%">
        <h2>บริษัท บีลิงค์ มีเดีย จำกัด</h2>
      </td>
      <td class="no-border" width="10%">เลขที่เอกสาร</td>
      <td class="bottom-border" width="20%">
        <?php echo htmlspecialchars($row['ticket'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <tr>
      <td class="text-left no-border" width="10%"></td>
      <td class="text-center no-border" width="60%">
        <h3>ใบเคลียร์เงินทดรองจ่าย (Advance Clearing Voucher)</h3>
      </td>
      <td class="no-border" width="10%">วันที่</td>
      <td class="bottom-border" width="20%">
        <?php echo htmlspecialchars($row['created'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <tr>
      <td class="text-left no-border" width="10%"></td>
      <td class="text-center no-border" width="60%"></td>
      <td class="no-border" width="10%">เลขที่สัญญา</td>
      <td class="bottom-border" width="20%">
        <?php echo htmlspecialchars($row['order_number'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
  </table>

  <table>
    <tr>
      <td class="no-border" width="20%">ผู้เบิกเงิน</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%"></td>
      <td class="no-border" width="30%"></td>
    </tr>
    <tr>
      <td class="no-border" width="20%">วัตถุประสงค์</td>
      <td class="bottom-border" width="30%">
        <?php echo str_replace("\n", "<br>", $row['objective']) ?>
      </td>
      <td class="no-border" width="20%"></td>
      <td class="no-border" width="30%"></td>
    </tr>
    <tr>
      <td class="no-border" width="20%">ยอดเงินเบิก</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars(number_format($row['amount'], 2), ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%">ยอดเงินที่ใช้จริง</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars(number_format($row['usage'], 2), ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="20%">ยอดเงินที่เหลือคืน</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars(number_format($row['remain'], 2), ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%">ยอดเงินที่คืน</td>
      <td class="bottom-border" width="30%"></td>
    </tr>
  </table>

  <!-- Items Section -->
  <table style="margin-top: 10px;">
    <tr>
      <th width="5%">#</th>
      <th width="15%">รายจ่าย</th>
      <th width="15%">รายละเอียด</th>
      <th width="10%">จำนวนเงิน</th>
      <th width="10%">VAT 7%</th>
      <th width="10%">W/T</th>
      <th width="10%">ยอดสุทธิ</th>
    </tr>
    <?php
    $items = $ADVANCE->advance_item_view([$uuid]);
    foreach ($items as $key => $item) :
      $key++;
    ?>
      <tr>
        <td class="text-center"><?php echo $key ?></td>
        <td class="text-left"><?php echo $item['expense_name'] ?></td>
        <td class="text-left"><?php echo $item['text'] ?></td>
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
      </tr>
    <?php endfor; ?>
    <tr>
      <td colspan="2" class="text-center"><?php echo $VALIDATION->bathformat($total['total']) ?></td>
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
