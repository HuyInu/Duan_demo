<?php
$wh = $whdatechuyen = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));
$codes = trim(striptags($_GET['codes']));
$daychungtus = trim(striptags($_GET['daychungtus']));

$loaivangs = trim(striptags($_GET['loaivangs']));
$haos = trim(striptags($_GET['haos']));
$dus = trim(striptags($_GET['dus']));
$ghichus = trim(striptags($_GET['ghichus']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);
$smarty->assign("codes",$codes);
$smarty->assign("daychungtus",$daychungtus);
$smarty->assign("loaivangs",$loaivangs);
$smarty->assign("haos",$haos);
$smarty->assign("dus",$dus);
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

if(!empty($loaivangs)){
	$strSearch .= '&loaivangs='.$loaivangs;
	$wh.=' and idloaivang in ( select id from '.$GLOBALS['db_sp'].'.loaivang where active=1 and name_vn like "%'.$loaivangs.'%" ) ';
}
if(!empty($haos)){
	$strSearch .= '&haos='.$haos;
	$wh.=' and hao  like "%'.$haos.'%" ';
}
if(!empty($dus)){
	$strSearch .= '&dus='.$dus;
	$wh.=' and du  like "%'.$dus.'%" ';
}
if(!empty($ghichus)){
	$strSearch .= '&ghichus='.$ghichus;
	$wh.=' and ghichu  like "%'.$ghichus.'%" ';
}
?>