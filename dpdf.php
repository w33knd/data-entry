<?php
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
$html2pdf = new Html2Pdf('L','A4');
$header='<h1 style="color:pink;">Kriparam Ji</h1><h3>List of Entries</h3>';
$body="";
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
$body=$body."Error: " . $e->getMessage();
}
$body=$body."<table width='100%' border=1 style=\"table-layout: fixed;border-collapse: collapse;\">
<tbody>";
$body=$body."<thead><tr>";
            $body=$body."<th style=\"padding: 10px;\">Name</th>";
            $body=$body."<th style=\"padding: 10px;\">F/H Name</th>";
            $body=$body."<th style=\"padding: 10px;\">Age</th>";
            $body=$body."<th style=\"padding: 10px;\">Education</th>";
            // $body=$body."<th style=\"padding: 10px;\">Email</th>";
            $body=$body."<th style=\"padding: 10px;\">Phone</th>";
            $body=$body."<th style=\"padding: 10px;\">Address</th>";
            $body=$body."<th style=\"padding: 10px;\">Business</th>";
            $body=$body."<th style=\"padding: 10px;\">Gurumantra Place</th>";
            $body=$body."<th style=\"padding: 10px;\">Trees</th>";
            $body=$body."<th style=\"padding: 10px;\">Addiction</th>";
            $body=$body."</tr></thead>";
foreach($result as $post){
        $body=$body."<tr>";
        $body=$body."<td style=\"word-break: break-all;width: 100px;padding: 5px;\" >".$post['name']." </td>";
        $body=$body."<td style=\"word-break: break-all;width: 100px;padding: 5px;\" >".$post['fhname']." </td>";
        $body=$body."<td  style=\"word-break: break-all;width: 25px;padding: 5px;\">".$post['age']." </td>";
        $body=$body."<td  style=\"word-break: break-all;width: 75px;padding: 5px;\">".$post['education']." </td>";
        //$body=$body."<td  style=\"word-break: break-all; max-width: 125px; padding: 5px;\">".$post['email']." </td>";
        $body=$body."<td  style=\"word-break: break-all;width: 100px;padding: 5px;\">".$post['phone']." </td>";
        $body=$body."<td  style=\"word-break: break-all;width: 125px;padding: 5px;\">".$post['address']." </td>";
        $body=$body."<td  style=\"word-break: break-all;width: 100px;padding: 5px;\">".$post['business']." </td>";
        $body=$body."<td  style=\"word-break: break-all;width: 100px;padding: 5px;\">".$post['gurumantra']." </td>";
        $body=$body."<td  style=\"word-break: break-all;width: 25px;padding: 5px;\">".$post['hmt']." </td>";
        $body=$body."<td  style=\"word-break: break-all;width: 50px;padding: 5px;\">".$post['addiction']." </td>";
        $body=$body."</tr>";
    
}
$body=$body."</tbody>
</table>";
// echo $header.$body;
$html2pdf->writeHTML($header.$body);
$html2pdf->output('data.pdf'); 
?>  