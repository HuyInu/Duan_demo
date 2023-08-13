<?php
$wh = $whdatechuyen = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));
$codes = trim(striptags($_GET['codes']));
$daychungtus = trim(striptags($_GET['daychungtus']));

$nhomnguyenlieus = trim(striptags($_GET['nhomnguyenlieus']));
$tennguyenlieus = trim(striptags($_GET['tennguyenlieus']));
$loaivangs = trim(striptags($_GET['loaivangs']));
$cannangvhs = trim(striptags($_GET['cannangvhs']));
$cannanghs = trim(striptags($_GET['cannanghs']));
$cannangvs = trim(striptags($_GET['cannangvs']));
$maphieus = trim(striptags($_GET['maphieus']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);
$smarty->assign("codes",$codes);
$smarty->assign("daychungtus",$daychungtus);

$smarty->assign("nhomnguyenlieus",$nhomnguyenlieus);
$smarty->assign("tennguyenlieus",$tennguyenlieus);
$smarty->assign("loaivangs",$loaivangs);
$smarty->assign("cannangvhs",$cannangvhs);
$smarty->assign("cannanghs",$cannanghs);
$smarty->assign("cannangvs",$cannangvs);
$smarty->assign("maphieus",$maphieus);

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
if(!empty($nhomnguyenlieus)){
	$strSearch .= '&nhomnguyenlieus='.$nhomnguyenlieus;
	$wh.=' and nhomnguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$nhomnguyenlieus.'%" ) ';
}
if(!empty($tennguyenlieus)){
	$strSearch .= '&tennguyenlieus='.$tennguyenlieus;
	$wh.=' and tennguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$tennguyenlieus.'%" ) ';
}
if(!empty($loaivangs)){
	$strSearch .= '&loaivangs='.$loaivangs;
	$wh.=' and idloaivang in ( select id from '.$GLOBALS['db_sp'].'.loaivang where active=1 and name_vn like "%'.$loaivangs.'%" ) ';
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
if(!empty($maphieus)){
	$strSearch .= '&maphieus='.$maphieus;
	$wh.=' and maphieu  like "%'.$maphieus.'%" ';
}
?>