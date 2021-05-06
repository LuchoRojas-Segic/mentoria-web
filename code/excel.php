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
$sheet->setCellValue('C1', 'Nombres');
$sheet->setCellValue('D1', 'Usuario');
$sheet->setCellValue('E1', 'Correo Usuario');

/*$sheet->setCellValueByColumnAndRow(1, 1, '#');
$sheet->setCellValueByColumnAndRow(2, 1, 'Id');
$sheet->setCellValueByColumnAndRow(3, 1, 'Nombres');
$sheet->setCellValueByColumnAndRow(4, 1, 'Usuario');
$sheet->setCellValueByColumnAndRow(5, 1, 'Correo Usuario');*/

foreach ($users as $key => $user){
    $fil=$key + 2;
    $sheet->setCellValue(1, $fil,$key + 1);
    $sheet->setCellValue('B'.$fil,$user['id']);
    $sheet->setCellValue('C'.$fil,$user['full_name']);
    $sheet->setCellValue('D'.$fil,$user['user_name']);
    $sheet->setCellValue('E'.$fil,$user['email']);   

    /*$sheet->setCellValueByColumnAndRow(2, $fil,$user['id']);
    $sheet->setCellValueByColumnAndRow(3, $fil,$user['full_name']);
    $sheet->setCellValueByColumnAndRow(4, $fil,$user['user_name']);
    $sheet->setCellValueByColumnAndRow(5, $fil,$user['email']);*/   
}
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="usuarios.xlsx"');
//header("Content-Type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename=usuarios.xls");
$writer->save('php://output');
//$writer->save('usuarios.xlsx');
