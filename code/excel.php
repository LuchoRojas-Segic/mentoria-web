<?php

require "util/db.php";
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$db = connectDB();

$sql = "SELECT * FROM users";
//statement

$stmt = $db->prepare($sql);
$stmt -> execute();
$users = $stmt ->fetchAll(PDO::FETCH_ASSOC);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', '#');
$sheet->setCellValue('B1', 'Id');
$sheet->setCellValue('C1', 'Nombre');
$sheet->setCellValue('D1', 'Nombre Usuario');
$sheet->setCellValue('E1', 'Correo');

foreach ($users as $key => $user){
    $fil=$key + 2;
    $sheet->setCellValue('A'.$fil,$key + 1);
    $sheet->setCellValue('B'.$fil,$user['id']);
    $sheet->setCellValue('C'.$fil,$user['full_name']);
    $sheet->setCellValue('D'.$fil,$user['user_name']);
    $sheet->setCellValue('E'.$fil,$user['e_mail']);    
}
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="usuarios.xls"');
$writer->save('php://output');
