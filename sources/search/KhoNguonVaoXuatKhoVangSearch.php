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
$tuoivangs = trim(striptags($_GET['tuoivangs']));
$tienmats = trim(striptags($_GET['tienmats']));
$ghichus = trim(striptags($_GET['ghichus']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);
$smarty->assign("codes",$codes);
$smarty->assign("daychungtus",$daychungtus);

$smarty->assign("nhomnguyenlieus",$nhomnguyenlieus);
$smarty->assign("tennguyenlieus",$tennguyenlieus);
$smarty->assign("loaivangs",$loaivangs);
$smarty->assign("idloaivang",$loaivangs);
$smarty->assign("cannangvhs",$cannangvhs);
$smarty->assign("cannanghs",$cannanghs);
$smarty->assign("cannangvs",$cannangvs);
$smarty->assign("tuoivangs",$tuoivangs);
$smarty->assign("tienmats",$tienmats);
$smarty->assign("ghichus",$ghichus);

if(!empty($fromDate)){
	$strSearch .= '&fromdays='.$fromDate;
	$fromDate = explode('/',$fromDate);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
	$wh.=' and dated >= "'.$fromDate.'" ';
	$whdatechuyen.=' and datedxuat >= "'.$fromDate.'" ';
}
if(!empty($toDate)){
	$strSearch .= '&todays='.$toDate;				
	$toDate = explode('/',$toDate);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
	$wh.=' and dated <= "'.$toDate.'" ';
	$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
}
if(!empty($daychungtus)){
	$strSearch .= '&daychungtus='.$daychungtus;
	$daychungtus = explode('/',$daychungtus);
	$daychungtus = $daychungtus[2].'-'.$daychungtus[1].'-'.$daychungtus[0];
	$wh.=' and dated = "'.$daychungtus.'" ';
	$whdatechuyen.=' and dated = "'.$daychungtus.'" ';
}
if(!empty($codes)){
	$strSearch .= '&codes='.$codes;
	$wh.=' and maphieu like "%'.$codes.'%" ';
	$whdatechuyen.=' and maphieu like "%'.$codes.'%" ';
}
if(!empty($nhomnguyenlieus)){
	$strSearch .= '&nhomnguyenlieus='.$nhomnguyenlieus;
	$wh.=' and nhomnguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$nhomnguyenlieus.'%" ) ';
	$whdatechuyen.=' and nhomnguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$nhomnguyenlieus.'%" ) ';
}
if(!empty($tennguyenlieus)){
	$strSearch .= '&tennguyenlieus='.$tennguyenlieus;
	$wh.=' and tennguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$tennguyenlieus.'%" ) ';
	$whdatechuyen.=' and tennguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$tennguyenlieus.'%" ) ';
}
if(!empty($loaivangs)){
	$strSearch .= '&loaivangs='.$loaivangs;
	$wh.=' and idloaivang in ( select id from '.$GLOBALS['db_sp'].'.loaivang where active=1 and name_vn like "%'.$loaivangs.'%" ) ';
	$whdatechuyen.=' and idloaivang in ( select id from '.$GLOBALS['db_sp'].'.loaivang where active=1 and name_vn like "%'.$loaivangs.'%" ) ';
}
if(!empty($cannangvhs)){
	$strSearch .= '&cannangvhs='.$cannangvhs;
	$wh.=' and cannangvh  like "%'.$cannangvhs.'%" ';
	$whdatechuyen.=' and cannangvh  like "%'.$cannangvhs.'%" ';
}
if(!empty($cannanghs)){
	$strSearch .= '&cannanghs='.$cannanghs;
	$wh.=' and cannangh  like "%'.$cannanghs.'%" ';
	$whdatechuyen.=' and cannangh  like "%'.$cannanghs.'%" ';
}
if(!empty($cannangvs)){
	$strSearch .= '&cannangvs='.$cannangvs;
	$wh.=' and cannangv  like "%'.$cannangvs.'%" ';
	$whdatechuyen.=' and cannangv  like "%'.$cannangvs.'%" ';
}
if(!empty($tuoivangs)){
	$strSearch .= '&tuoivangs='.$tuoivangs;
	$wh.=' and tuoivang  like "%'.$tuoivangs.'%" ';
	$whdatechuyen.=' and tuoivang  like "%'.$tuoivangs.'%" ';
}
if(!empty($tienmats)){
	$strSearch .= '&tienmats='.$tienmats;
	$wh.=' and tienmatvang  like "%'.$tienmats.'%" ';
	$whdatechuyen.=' and tienmatvang  like "%'.$tienmats.'%" ';
}
if(!empty($ghichus)){
	$strSearch .= '&ghichus='.$ghichus;
	$wh.=' and ghichuvang  like "%'.$ghichus.'%" ';
	$whdatechuyen.=' and ghichuvang  like "%'.$ghichus.'%" ';
}
?>