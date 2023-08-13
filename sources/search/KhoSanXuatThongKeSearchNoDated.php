<?php
$wh = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));

$codes = trim(striptags($_GET['codes']));
$loaivangs = trim(striptags($_GET['loaivangs']));
$cannangvhs = trim(striptags($_GET['cannangvhs']));
$cannanghs = trim(striptags($_GET['cannanghs']));
$cannangvs = trim(striptags($_GET['cannangvs']));
$tuoivangs = trim(striptags($_GET['tuoivangs']));

$phongchuyens = trim(striptags($_GET['phongchuyens']));
$ghichus = trim(striptags($_GET['ghichus']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);

$smarty->assign("codes",$codes);
$smarty->assign("loaivangs",$loaivangs);
$smarty->assign("cannangvhs",$cannangvhs);
$smarty->assign("cannanghs",$cannanghs);
$smarty->assign("cannangvs",$cannangvs);
$smarty->assign("tuoivangs",$tuoivangs);

$smarty->assign("phongchuyens",$phongchuyens);
$smarty->assign("ghichus",$ghichus);


if(!empty($fromDate)){
	$strSearch .= '&fromdays='.$fromDate;
	$fromDate = explode('/',$fromDate);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
}
if(!empty($toDate)){
	$strSearch .= '&todays='.$toDate;				
	$toDate = explode('/',$toDate);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
}

if(!empty($codes)){
	$strSearch .= '&codes='.$codes;
	$wh.=' and maphieu like "%'.$codes.'%" ';
}

if(!empty($loaivangs)){
	$strSearch .= '&loaivangs='.$loaivangs;
	$wh.=' and idloaivang = '.$loaivangs.' ';
}
if(!empty($cannangvhs)){
	$strSearch .= '&cannangvhs='.$cannangvhs;
	$wh.=' and cannangvh  like "%'.$cannangvhs.'%" ';
}
if(!empty($cannanghs)){
	$strSearch .= '&cannanghs='.$cannanghs;
	$wh.=' and cannangh  like "%'.$cannanghs.'%" ';
}
if(!empty($cannangvs)){
	$strSearch .= '&cannangvs='.$cannangvs;
	$wh.=' and cannangv  like "%'.$cannangvs.'%" ';
}
if(!empty($tuoivangs)){
	$strSearch .= '&tuoivangs='.$tuoivangs;
	$wh.=' and tuoivang  like "%'.$tuoivangs.'%" ';
}

if(!empty($phongchuyens)){
	$strSearch .= '&phongchuyens='.$phongchuyens;
	$wh.=' and typekhodau  like "%'.$phongchuyens.'%" ';
}
if(!empty($ghichus)){
	$strSearch .= '&ghichus='.$ghichus;
	$wh.=' and ghichuvang  like "%'.$ghichus.'%" ';
}
?>