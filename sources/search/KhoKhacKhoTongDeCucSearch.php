<?php
$wh = $whfromToDate = $whToDate = $whxk = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));
if($act != 'ChiTietTon'){
	if(empty($fromDate)){ /// nếu chưa chọn ngày lấy ngày hiện tại
		$fromDate = date("d/m/Y");
	}
	if(empty($toDate)){ /// nếu chưa chọn ngày lấy ngày hiện tại
		$toDate = date("d/m/Y");
	}
}
$codes = trim(striptags($_GET['codes']));

$nhomnguyenlieus = trim(striptags($_GET['nhomnguyenlieus']));
$tennguyenlieus = trim(striptags($_GET['tennguyenlieus']));
$loaivangs = trim(striptags($_GET['loaivangs']));
$idloaivang = trim(striptags($_GET['idloaivang']));
$cannangvs = trim(striptags($_GET['cannangvs']));
$tuoivangs = trim(striptags($_GET['tuoivangs']));
$tienmats = trim(striptags($_GET['tienmats']));
$ghichus = trim(striptags($_GET['ghichus']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);

$smarty->assign("codes",$codes);
$smarty->assign("nhomnguyenlieus",$nhomnguyenlieus);
$smarty->assign("tennguyenlieus",$tennguyenlieus);
$smarty->assign("loaivangs",$loaivangs);
$smarty->assign("idloaivang",$idloaivang);
$smarty->assign("cannangvs",$cannangvs);
$smarty->assign("tuoivangs",$tuoivangs);
$smarty->assign("tienmats",$tienmats);
$smarty->assign("ghichus",$ghichus);

if(!empty($fromDate)){
	$strSearch .= '&fromdays='.$fromDate;
	$fromDate = explode('/',$fromDate);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
	$wh.=' and datechuyen >= "'.$fromDate.'"  ';
	$whfromToDate .= ' and dated >= "'.$fromDate.'"  ';
}
if(!empty($toDate)){
	$strSearch .= '&todays='.$toDate;				
	$toDate = explode('/',$toDate);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
	$wh.=' and datechuyen <= "'.$toDate.'"  ';
	$whfromToDate .= ' and dated <= "'.$toDate.'"  ';
	$whToDate = ' and dated <= "'.$toDate.'"  ';
}

if(!empty($codes)){
	$strSearch .= '&codes='.$codes;
	$wh.=' and maphieu like "%'.$codes.'%" ';
	$whxk.=' and maphieu like "%'.$codes.'%" ';
}
if(!empty($nhomnguyenlieus)){
	$strSearch .= '&nhomnguyenlieus='.$nhomnguyenlieus;
	$wh.=' and nhomnguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$nhomnguyenlieus.'%" ) ';
	$whxk.=' and nhomnguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$nhomnguyenlieus.'%" ) ';
}
if(!empty($tennguyenlieus)){
	$strSearch .= '&tennguyenlieus='.$tennguyenlieus;
	$wh.=' and tennguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$tennguyenlieus.'%" ) ';
	$whxk.=' and tennguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$tennguyenlieus.'%" ) ';
}

if(!empty($cannangvs)){
	$strSearch .= '&cannangvs='.$cannangvs;
	$wh.=' and cannangv  like "%'.$cannangvs.'%" ';
	$whxk.=' and cannangv  like "%'.$cannangvs.'%" ';
}
if(!empty($tuoivangs)){
	$strSearch .= '&tuoivangs='.$tuoivangs;
	$wh.=' and tuoivang  like "%'.$tuoivangs.'%" ';
	$whxk.=' and tuoivang  like "%'.$tuoivangs.'%" ';
}
if(!empty($loaivangs)){
	$strSearch .= '&loaivangs='.$loaivangs;
	$wh.=' and idloaivang = '.$loaivangs.' ';
	$whxk.=' and idloaivang = '.$loaivangs.' ';
}
if(!empty($tienmats)){
	$strSearch .= '&tienmats='.$tienmats;
	$wh.=' and tienmatvang  like "%'.$tienmats.'%" ';
	$whxk.=' and tienmatvang  like "%'.$tienmats.'%" ';
}
if(!empty($ghichus)){
	$strSearch .= '&ghichus='.$ghichus;
	$wh.=' and ghichuvang  like "%'.$ghichus.'%" ';
	$whxk.=' and ghichuvang  like "%'.$ghichus.'%" ';
}
?>