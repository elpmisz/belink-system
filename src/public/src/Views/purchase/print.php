<?php
$menu = "Service";
$page = "ServicePurchase";

use App\Classes\Purchase;
use App\Classes\Validation;

$PURCHASE = new Purchase();
$VALIDATION = new Validation();

$param = (isset($params) ? explode("/", $params) : "");
$uuid = (!empty($param[0]) ? $param[0] : "");

$row = $PURCHASE->purchase_view([$uuid]);
$total = $PURCHASE->purchase_item_total([$uuid]);

$signature_1 = $_SERVER['DOCUMENT_ROOT'] . "/src/Publics/signature/signature-demo-1.jpg";
$signature_2 = $_SERVER['DOCUMENT_ROOT'] . "/src/Publics/signature/signature-demo-2.jpg";
$signature_3 = $_SERVER['DOCUMENT_ROOT'] . "/src/Publics/signature/signature-demo-3.jpg";


ob_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>ระบบใบขอซื้อ Purchase Request</title>
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

    .no-border-right {
      border-right: 1px solid #FFF !important;
    }

    .no-border-bottom {
      border-bottom: 1px solid #FFF !important;
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

    .signature {
      width: 100px;
      height: 60px;
      background-size: cover;
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
        <h2>ใบขอซื้อ Purchase Request</h2>
      </td>
      <td class="no-border" width="20%">วันที่</td>
      <td class="bottom-border" width="20%">
        <?php echo htmlspecialchars($row['doc_date'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <tr>
      <td class="text-left no-border" width="10%"></td>
      <td class="text-center no-border" width="50%"></td>
      <td class="no-border" width="20%">เลขที่ PO</td>
      <td class="bottom-border" width="20%">
        <?php echo htmlspecialchars($row['po'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
  </table>

  <table>
    <tr>
      <td class="no-border" width="20%">หน่วยงานที่ขอซื้อ</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['department'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%">วันที่ต้องการใช้</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="20%">เหตุผลในการขอซื้อ /<br> งบประมาณที่เตรียมไว้</td>
      <td colspan="3" class="bottom-border" width="80%">
        <?php echo str_replace("\n", "<br>", $row['objective']) ?>
      </td>
    </tr>
    <tr>
      <td class="no-border" width="20%">อ้างอิงเอกสาร(ถ้ามี)</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['reference'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%"></td>
      <td class="no-border" width="30%"></td>
    </tr>
    <tr>
      <td class="no-border" width="20%">เลขที่ SO</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['order_number'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td class="no-border" width="20%"></td>
      <td class="no-border" width="30%"></td>
    </tr>
    <tr>
      <td class="no-border" width="20%">ชื่อลูกค้า</td>
      <td class="bottom-border" width="30%">
        <?php echo htmlspecialchars($row['customer_name'], ENT_QUOTES, 'UTF-8'); ?>
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
  </table>

  <!-- Items Section -->
  <table style="margin-top: 10px;">
    <tr>
      <th width="10%">#</th>
      <th width="50%">รายการสินค้า/บริการ</th>
      <th width="10%">จำนวน</th>
      <th width="10%">หน่วย</th>
      <th width="10%">ราคา</th>
    </tr>
    <?php
    $items = $PURCHASE->purchase_item_view([$uuid]);
    foreach ($items as $key => $item) :
      $key++;
    ?>
      <tr>
        <td class="text-center"><?php echo $key ?></td>
        <td class="text-left"><?php echo $item['name'] ?></td>
        <td class="text-center"><?php echo $item['amount'] ?></td>
        <td class="text-center"><?php echo $item['unit'] ?></td>
        <td class="text-right"><?php echo number_format($item['estimate'], 2) ?></td>
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
      </tr>
    <?php endfor; ?>
    <tr>
      <td colspan="3" class="text-center"><?php echo $VALIDATION->bathformat($total['total']) ?></td>
      <td class="text-right">รวมทั้งสิ้น</td>
      <td class="text-right"><?php echo number_format($total['total'], 2) ?></td>
    </tr>
  </table>

  <table style="margin-top: 10px;">
    <tr>
      <td class="no-border" width="20%">หมายเหตุ</td>
      <td colspan="3" class="bottom-border" width="80%">
        <?php echo str_replace("\n", "<br>", $row['remark']) ?>
      </td>
    </tr>
  </table>

  <!-- Footer Section -->
  <table style="margin-top: 10px;">
    <tr>
      <td class="text-center no-border-bottom" colspan="2">
        หน่วยงานที่ขอซื้อ
      </td>
      <td class="text-center no-border-bottom">
        หน่วยงานที่จัดซื้อ
      </td>
    </tr>
    <tr>
      <td class="text-center no-border-bottom no-border-right">
        <?php echo $row['username'] ?>
      </td>
      <td class="text-center no-border-bottom">
        <img src="<?php echo $signature_2 ?>" alt="signature" class="signature">
      </td>
      <td class="text-center no-border-bottom">
        <img src="<?php echo $signature_3 ?>" alt="signature" class="signature">
      </td>
    </tr>
    <tr>
      <td class="text-center no-border-bottom no-border-right">
        (<?php echo "คุณ{$row['fullname']}" ?>)
      </td>
      <td class="text-center no-border-bottom">
        (<?php echo "คุณ{$row['fullname']}" ?>)
      </td>
      <td class="text-center no-border-bottom">
        (<?php echo "คุณ{$row['fullname']}" ?>)
      </td>
    </tr>
    <tr>
      <td class="text-center no-border-right">ผู้จัดทำ</td>
      <td class="text-center">ผู้มีอำนาจอนุมัติ</td>
      <td class="text-center">ผู้ตรวจสอบ</td>
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
