<?php
$wh = $whnx = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));
$codes = trim(striptags($_GET['codes']));
$daychungtus = trim(striptags($_GET['daychungtus']));
$idloaivang = trim(striptags($_GET['idloaivang']));
$trongluongvangs = trim(striptags($_GET['trongluongvangs']));
$ghichus = trim(striptags($_GET['ghichus']));
$madonhangsxs = trim(striptags($_GET['madonhangsxs']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);
$smarty->assign("codes",$codes);
$smarty->assign("daychungtus",$daychungtus);
$smarty->assign("idloaivang",$idloaivang);
$smarty->assign("trongluongvangs",$trongluongvangs);
$smarty->assign("ghichus",$ghichus);
$smarty->assign("madonhangsxs",$madonhangsxs);

if(!empty($fromDate)){
	$strSearch .= '&fromdays='.$fromDate;
	$fromDate = explode('/',$fromDate);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
	$wh.=' and dated >= "'.$fromDate.'" ';
	$whnx.=' and datedhachtoan >= "'.$fromDate.'" ';
}
if(!empty($toDate)){
	$strSearch .= '&todays='.$toDate;				
	$toDate = explode('/',$toDate);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
	$wh.=' and dated <= "'.$toDate.'" ';
}
if(!empty($daychungtus)){
	$strSearch .= '&daychungtus='.$daychungtus;
	$daychungtus = explode('/',$daychungtus);
	$daychungtus = $daychungtus[2].'-'.$daychungtus[1].'-'.$daychungtus[0];
	$wh.=' and dated = "'.$daychungtus.'" ';
	
}
if(!empty($codes)){
	$strSearch .= '&codes='.$codes;
	$wh.=' and maphieu like "%'.$codes.'%" ';
}
if(!empty($madonhangsxs)){
	$strSearch .= '&madonhangsxs='.$madonhangsxs;
	$wh.=' and madonhang like "%'.$madonhangsxs.'%" ';
}
if(!empty($idloaivang)){
	$strSearch .= '&idloaivang='.$idloaivang;
	$wh.=' and idloaivang =  '.$idloaivang.' ';
}
if(!empty($trongluongvangs)){
	$strSearch .= '&trongluongvangs='.$trongluongvangs;
	$wh.=' and trongluongvang like "%'.$trongluongvangs.'%" ';
}
if(!empty($ghichus)){
	$strSearch .= '&ghichus='.$ghichus;
	$wh.=' and ghichu  like "%'.$ghichus.'%" ';
	$whnx.=' and ghichu  like "%'.$ghichus.'%" ';
}
?>