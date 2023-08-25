<?php
$wh = $strSearch = '';
$fromDate = isset($_POST['fromdays']) ? trim(striptags($_POST['fromdays'])) : '';
$toDate = isset($_POST['todays']) ? trim(striptags($_POST['todays'])) : '';
if(empty($fromDate)){ /// nếu chưa chọn ngày lấy ngày hiện tại
	$fromDate = date("d/m/Y");
}
if(empty($toDate)){ /// nếu chưa chọn ngày lấy ngày hiện tại
	$toDate = date("d/m/Y");
}
$idloaivang = isset($_POST['idloaivang']) ? ceil(trim($_POST['idloaivang'])) : '';
$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);
$smarty->assign("idloaivang",$idloaivang);

$fromDate = explode('/',$fromDate);
$fromDateDauthang = $fromDate[2].'-'.$fromDate[1].'-01'; //lấy ngày đầu tháng
$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];

$toDate = explode('/',$toDate);
$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];

if($idloaivang > 0){
	$wh = ' and id = '.$idloaivang.' ';
}
?>