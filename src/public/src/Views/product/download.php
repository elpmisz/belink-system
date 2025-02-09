<?php
require_once(__DIR__ . "/../../../vendor/autoload.php");

use App\Classes\Product;
use App\Classes\Validation;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$PRODUCT = new Product();
$VALIDATION = new Validation();
$SPREADSHEET = new Spreadsheet();
$WRITER = new Xlsx($SPREADSHEET);

$param = (isset($params) ? explode("/", $params) : header("location: /error"));
$type = (!empty($param[0]) ? $param[0] : "");
$warehouse = (!empty($param[1]) ? $param[1] : "");
$location = (!empty($param[2]) ? $param[2] : "");
$brand = (!empty($param[3]) ? $param[3] : "");

$result = $PRODUCT->product_download($type, $warehouse, $location, $brand);

$SPREADSHEET->setActiveSheetIndex(0);
$ACTIVESHEET = $SPREADSHEET->getActiveSheet();

$STYLEHEADER = [
  'font' => [
    'bold' => true,
  ],
  'alignment' => [
    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
  ],
  'borders' => [
    'allBorders' => [
      'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    ],
  ]
];

$columns = ["เลขที่ทรัพย์สิน", "ชื่อ", "ประเภท", "คลัง", "สถานที่", "ยี่ห้อ", "หน่วยนับ", "หมายเหตุ"];
$letter = $VALIDATION->letters((COUNT($columns) + 1));
$letters = [];
for ($i = "A"; $i !== $letter; $i++) {
  $letters[] = $i;
}
$ACTIVESHEET->getStyle("A1:" . end($letters) . "1")->applyFromArray($STYLEHEADER);

$arr_columns = array_combine($letters, $columns);
foreach ($arr_columns as $key => $value) {
  $ACTIVESHEET->setCellValue($key . "1", $value);
  $ACTIVESHEET->getColumnDimension($key)->setAutoSize(true);
}

foreach ($result as $key => $value) {
  $key++;
  foreach ($letters as $k => $v) {
    $ACTIVESHEET->setCellValue($v . ($key + 1), html_entity_decode(str_replace("\r\n", " ", $value[$k])));
  }
}

$date = date('Ym');
$filename = "{$date}_product.xlsx";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=" . $filename);
header("Cache-Control: max-age=0");
$WRITER->save("php://output");
exit();
