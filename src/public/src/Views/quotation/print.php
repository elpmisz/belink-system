<?php
$menu = "Service";
$page = "ServiceQuotation";

use App\Classes\Quotation;

$QUOTATION = new Quotation();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $QUOTATION->quotation_view([$uuid]);
$items = $QUOTATION->quotation_item_view([$uuid]);
$total = $QUOTATION->quotation_item_total([$uuid]);
$vat = ($total * 0.07);
$summary = ($total + $vat);
ob_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>ระบบใบเสนอราคา Quotation</title>
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
      <td class="text-center no-border" width="80%">
        <h2>บริษัท บีลิงค์ มีเดีย จำกัด</h2>
      </td>
      <td class="text-right no-border" width="10%"></td>
    </tr>
    <tr>
      <td class="text-left no-border" width="10%"></td>
      <td class="text-center no-border" width="80%">
        <h2>ใบเสนอราคา Quotation</h2>
      </td>
      <td class="text-right no-border" width="10%"></td>
    </tr>
  </table>

  <table>
    <tr>
      <td class="no-border" width="40%">
        <h4>ที่อยู่สำหรับติดต่อ</h4>
      </td>
      <td class="no-border" width="10%"></td>
      <td class="no-border" width="40%">
        <h4>ที่อยู่ผู้รับ</h4>
      </td>
      <td class="no-border" width="10%"></td>
    </tr>
    <tr>
      <td class="no-border" width="40%">
        <h4><?php echo $row['biller_text'] ?></h4>
      </td>
      <td class="no-border" width="10%"></td>
      <td class="no-border" width="40%">
        <h4><?php echo $row['customer_text'] ?></h4>
      </td>
      <td class="no-border" width="10%"></td>
    </tr>
    <tr>
      <td class="no-border" width="40%">
        <?php echo $row['biller_address'] ?>
      </td>
      <td class="no-border" width="10%"></td>
      <td class="no-border" width="40%">
        <?php echo $row['customer_address'] ?>
      </td>
      <td class="no-border" width="10%"></td>
    </tr>
  </table>

  <table>
    <tr>
      <td class="no-border" width="10%">วันที่เอกสาร</td>
      <td class="no-border" width="90%"><?php echo $row['doc_date'] ?></td>
    </tr>
    <tr>
      <td class="no-border" width="10%">เลขที่เอกสาร</td>
      <td class="no-border" width="90%"><?php echo $row['ticket'] ?></td>
    </tr>
  </table>

  <table style="margin-top: 10px;">
    <tr>
      <th width="10%">#</th>
      <th width="30%">รายการสินค้า</th>
      <th width="15%">ราคา</th>
      <th width="15%">ส่วนลด</th>
      <th width="15%">จำนวน</th>
      <th width="15%">รวม</th>
    </tr>
    <?php
    $items = $QUOTATION->quotation_item_view([$uuid]);
    foreach ($items as $key => $item) :
      $key++;
      $discount = (strpos($item['discount'], '%') !== false
        ? ($item['price'] * intval($item['discount'])) / 100
        : $item['discount']
      );
      $sum = (($item['price'] - $discount) * $item['amount']);
    ?>
      <tr>
        <td class="text-center"><?php echo $key ?></td>
        <td class="text-left"><?php echo $item['product'] ?></td>
        <td class="text-right"><?php echo number_format($item['price'], 2) ?></td>
        <td class="text-right"><?php echo $item['discount'] ?></td>
        <td class="text-right"><?php echo $item['amount'] ?></td>
        <td class="text-right"><?php echo number_format($sum, 2) ?></td>
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
      </tr>
    <?php endfor; ?>
    <tr>
      <td class="text-right" colspan="5">ยอดรวม</td>
      <td class="text-right"><?php echo number_format($total, 2) ?></td>
    </tr>
    <tr>
      <td class="text-right" colspan="5">Vat 7%</td>
      <td class="text-right"><?php echo number_format($vat, 2) ?></td>
    </tr>
    <tr>
      <td class="text-right" colspan="5">ยอดรวมทั้งหมด</td>
      <td class="text-right"><?php echo number_format($summary, 2) ?></td>
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
$mpdf->Output("{$date}_quotation.pdf", 'I');
