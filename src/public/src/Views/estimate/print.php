<?php
$menu = "Service";
$page = "ServiceEstimate";

use App\Classes\Estimate;

$ESTIMATE = new Estimate();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $ESTIMATE->estimate_view([$uuid]);
$reference = $ESTIMATE->estimate_item_reference([$uuid]);
ob_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Estimate Budget</title>
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
        <h2>Estimate Budget</h2>
      </td>
      <td class="text-right no-border" width="10%"></td>
    </tr>
  </table>

  <!-- Information Section -->
  <table>
    <tr>
      <td class="no-border" width="20%">ชื่อลูกค้า</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['customer_name'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%">เลขที่เอกสาร</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['ticket'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="20%">เลขที่สัญญา</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['order_number'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%">วันที่</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['doc_date'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="20%">พนักงานขาย</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%"></td>
      <td class="no-border" width="30%"></td>
    </tr>
    <tr>
      <td class="no-border" width="20%">สินค้า</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%"></td>
      <td class="no-border" width="30%"></td>
    </tr>
    <tr>
      <td class="no-border" width="20%">หัวข้อเรื่อง</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['title_name'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%"></td>
      <td class="no-border" width="30%"></td>
    </tr>
    <tr>
      <td class="no-border" width="20%">ชื่อการขาย</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['sales_name'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%"></td>
      <td class="no-border" width="30%"></td>
    </tr>
  </table>

  <!-- Items Section -->
  <?php
  if (COUNT($reference) > 0) :
    foreach ($reference as $ref) :
  ?>
      <table style="margin-top: 10px;">
        <tr>
          <th class="text-left no-border" colspan="6"><?php echo $ref['reference_name'] ?></th>
        </tr>
        <tr>
          <th width="10%">No.</th>
          <th width="40%">Item Description</th>
          <th width="10%">Day</th>
          <th width="10%">Quantity<br>(ea.)</th>
          <th width="10%">Unit Price<br>(THB)</th>
          <th width="10%">Amount<br>(THB)</th>
        </tr>
        <?php
        $items = $ESTIMATE->estimate_item_view([$uuid], $ref['reference']);
        $total = 0;
        foreach ($items as $key => $item) :
          $key++;
          $total += $item['estimate'];
        ?>
          <tr>
            <td class="text-center"><?php echo $key ?></td>
            <td class="text-left"><?php echo $item['expense_name'] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right"><?php echo number_format($item['estimate'], 2) ?></td>
          </tr>
        <?php endforeach; ?>
        <tr>
          <td class="text-center" colspan="5">รวม</td>
          <td class="text-right"><?php echo number_format($total, 2) ?></td>
        </tr>
      </table>
  <?php
    endforeach;
  endif;
  ?>


  <!-- Information Section -->
  <table style="margin-top: 10px;">
    <tr>
      <td style="vertical-align: top;" rowspan="8" class="no-border" width="20%">รายละเอียด</td>
      <td style="vertical-align: top;" rowspan="8" class="no-border" width="50%">
        <?php echo nl2br(htmlspecialchars($row['remark'], ENT_QUOTES, 'UTF-8')); ?>
      </td>
      <td class="no-border" width="10%"></td>
      <td class="no-border" width="10%">Budget A</td>
      <td class="text-right no-border" width="10%">
        <?php
        $totalA = $ESTIMATE->estimate_item_total([$uuid, 1]);
        echo number_format($totalA, 2);
        ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="10%"></td>
      <td class="bottom-border" width="10%">Budget B</td>
      <td class="text-right bottom-border" width="10%">
        <?php
        $totalB = $ESTIMATE->estimate_item_total([$uuid, 2]);
        echo number_format($totalB, 2);
        ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="10%"></td>
      <td class="bottom-border" width="10%">Total</td>
      <td class="text-right bottom-border" width="10%">
        <?php
        $total = ($totalA + $totalB);
        echo number_format($total, 2);
        ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="10%"></td>
      <td class="no-border" width="10%"></td>
      <td class="text-right no-border" width="10%"></td>
    </tr>
    <tr>
      <td class="no-border" width="10%"></td>
      <td class="no-border" width="10%">Sales</td>
      <td class="text-right no-border" width="10%">
        <?php echo number_format($row['budget'], 2) ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="10%"></td>
      <td class="bottom-border" width="10%">Cost</td>
      <td class="text-right bottom-border" width="10%">
        <?php echo number_format($total, 2) ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="10%"></td>
      <td class="bottom-border" width="10%">GP</td>
      <td class="text-right bottom-border" width="10%">
        <?php
        $gp = ($row['budget'] - $total);
        echo number_format($gp, 2);
        ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="10%"></td>
      <td class="no-border" width="10%">%GP</td>
      <td class="text-right no-border" width="10%">
        <?php
        $gpPer = (($row['budget'] - $total) * 100) / $row['budget'];
        echo number_format($gpPer, 2) . "%";
        ?>
      </td>
    </tr>
  </table>

  <!-- Footer Section -->
  <table style="margin-top: 10px;">
    <tr>
      <td rowspan="2" class="text-center" width="20%"><br><br>____________<br>ตรวจสอบโดย<br>Budget<br>วันที่____________</td>
      <td rowspan="2" class="text-center" width="20%"><br><br>____________<br>อนุมัติโดย<br>CFO<br>วันที่____________</td>
      <td rowspan="2" class="text-center" width="20%"><br><br>____________<br>จัดทำโดย<br>Sales Person<br>วันที่____________</td>
      <td rowspan="2" class="text-center" width="20%"><br><br>____________<br>Tanachai Thanomsub<br>Chief Marketing Officer<br>วันที่____________</td>
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
