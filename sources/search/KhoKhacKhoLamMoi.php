<?php
$wh = $whnx = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));
$codes = trim(striptags($_GET['codes']));
$madonhangsxs = trim(striptags($_GET['madonhangsxs']));
$idloaivang = trim(striptags($_GET['idloaivang']));
$ghichus = trim(striptags($_GET['ghichus']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);
$smarty->assign("codes",$codes);
$smarty->assign("madonhangsxs",$madonhangsxs);
$smarty->assign("idloaivang",$idloaivang);
$smarty->assign("ghichus",$ghichus);

if(!empty($fromDate)){
	$strSearch .= '&fromdays='.$fromDate;
	$fromDate = explode('/',$fromDate);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
	$wh.=' and dated >= "'.$fromDate.'" ';
}
if(!empty($toDate)){
	$strSearch .= '&todays='.$toDate;				
	$toDate = explode('/',$toDate);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
	$wh.=' and dated <= "'.$toDate.'" ';
}

if(!empty($codes)){
	$strSearch .= '&codes='.$codes;
	$wh.=' and maphieu like "%'.$codes.'%" ';
}
if(!empty($madonhangsxs)){
	$strSearch .= '&madonhangsxs='.$madonhangsxs;
	$wh.=' and madonhangsx like "%'.$madonhangsxs.'%" ';
}
if(!empty($idloaivang)){
	$strSearch .= '&idloaivang='.$idloaivang;
	$wh.=' and idloaivang =  '.$idloaivang.' ';
}
if(!empty($ghichus)){
	$strSearch .= '&ghichus='.$ghichus;
	$wh.=' and ghichu  like "%'.$ghichus.'%" ';
}
?>