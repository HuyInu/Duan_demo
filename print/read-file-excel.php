<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print</title>
<?php
include_once("../#include/config.php");
include_once("../functions/function.php");
CheckLogin();
require_once '../Classes-PHPExcel/PHPExcel.php';
$inputFileType = 'Excel2007';

$id = ceil($_GET['id']);
$type = ceil($_GET['type']);
$table = isset($_REQUEST['table'])?$_REQUEST['table']:"";

$sql = "SELECT * FROM $GLOBALS[db_sp].$table where id=$id";
$rs = $GLOBALS["sp"]->getRow($sql);
if(!empty($rs['fileexcel'])){
	$inputFileName = '../'.$rs['fileexcel'];
	
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($inputFileName);
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
	$objWriter->save('php://output');
	exit;
}
else{
	die('File excel không tồn tại, vui lòng liên hệ với người quản trị.');
}
?>