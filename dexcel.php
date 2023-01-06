<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

include 'databaseinfo.php';

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//parameters for filter
$nameq=$_GET['name'];
$emailq=$_GET['email'];
$cityq=$_GET['city'];
$phoneq=$_GET['phone'];
$professionq=$_GET['profession'];
$sort=$_GET['sort'];
if(is_null($nameq)){$nameq="";}
if(is_null($emailq)){$emailq="";}
if(is_null($cityq)){$cityq="";}
if(is_null($phoneq)){$phoneq="";}
if(is_null($professionq)){$professionq="";}
if(is_null($sort)){$sort="DESC";}
if($sort=="DESC"){
    $getallpostsquery = $conn->prepare("SELECT * FROM datatable WHERE name LIKE ? AND email LIKE ? AND phone LIKE ? AND address LIKE ? AND business LIKE ? ORDER BY entrydate DESC");
}else{
    $getallpostsquery = $conn->prepare("SELECT * FROM datatable WHERE name LIKE ? AND email LIKE ? AND phone LIKE ? AND address LIKE ? AND business LIKE ? ORDER BY entrydate ASC");
}
$getallpostsquery->execute(array("%$nameq%","%$emailq%","$phoneq%","%$cityq%","%$professionq%"));
$result= $getallpostsquery->fetchAll();
} catch(PDOException $e) {
echo "Error: " . $e->getMessage();
}
            $sheet->setCellValue('A1', 'Name');
            $sheet->setCellValue('B1', 'Father/Husband Name');
            $sheet->setCellValue('C1', 'Age');
            $sheet->setCellValue('D1', 'Education');
            $sheet->setCellValue('E1', 'Email');
            $sheet->setCellValue('F1', 'Phone');
            $sheet->setCellValue('G1', 'Address');
            $sheet->setCellValue('H1', 'Business');
            $sheet->setCellValue('I1', 'Gurumantra Place');
            $sheet->setCellValue('J1', 'Trees');
            $sheet->setCellValue('K1', 'Addiction');
            $spreadsheet->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold( true );
$line=2;
foreach($result as $post){
    $sheet->setCellValue('A'.$line, $post['name']);
    $sheet->setCellValue('B'.$line, $post['fhname']);
    $sheet->setCellValue('C'.$line, $post['age']);
    $sheet->setCellValue('D'.$line, $post['education']);
    $sheet->setCellValue('E'.$line, $post['email']);
    $sheet->setCellValue('F'.$line, $post['phone']);
    $sheet->setCellValue('G'.$line, $post['address']);
    $sheet->setCellValue('H'.$line, $post['business']);
    $sheet->setCellValue('I'.$line, $post['gurumantra']);
    $sheet->setCellValue('L'.$line, $post['hmt']);
    $sheet->setCellValue('K'.$line, $post['addiction']);
    $line++;
}
$writer = new Xlsx($spreadsheet);
$writer->save('/tmp/data.xlsx');
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="data.xlsx"');
readfile('/tmp/data.xlsx');
?>