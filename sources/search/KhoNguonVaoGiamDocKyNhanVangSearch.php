<?php
$wh = $whdatechuyen = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));
if(empty($fromDate) && ($act == 'KhoLuuTru' || $act == 'TongKhoNguonVaoKhoLuuTru')){ /// nếu chưa chọn ngày lấy ngày hiện tại
	$fromDate = date("d/m/Y");
}
if(empty($toDate) && ($act == 'KhoLuuTru' || $act == 'TongKhoNguonVaoKhoLuuTru')){ /// nếu chưa chọn ngày lấy ngày hiện tại
	$toDate = date("d/m/Y");
}
$codes = trim(striptags($_GET['codes']));
$daychungtus = trim(striptags($_GET['daychungtus']));

$nhomnguyenlieus = trim(striptags($_GET['nhomnguyenlieus']));
$tennguyenlieus = trim(striptags($_GET['tennguyenlieus']));
$loaivangs = trim(striptags($_GET['loaivangs']));
$idloaivang = trim(striptags($_GET['idloaivang']));
$cannangvhs = trim(striptags($_GET['cannangvhs']));
$cannanghs = trim(striptags($_GET['cannanghs']));
$cannangvs = trim(striptags($_GET['cannangvs']));
$tuoivangs = trim(striptags($_GET['tuoivangs']));
$tienmats = trim(striptags($_GET['tienmats']));
$madhsxs = trim(striptags($_GET['madhsxs']));
$ghichus = trim(striptags($_GET['ghichus']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);
$smarty->assign("codes",$codes);
$smarty->assign("daychungtus",$daychungtus);

$smarty->assign("nhomnguyenlieus",$nhomnguyenlieus);
$smarty->assign("tennguyenlieus",$tennguyenlieus);
$smarty->assign("loaivangs",$loaivangs);
$smarty->assign("idloaivangs",$idloaivang);
$smarty->assign("cannangvhs",$cannangvhs);
$smarty->assign("cannanghs",$cannanghs);
$smarty->assign("cannangvs",$cannangvs);
$smarty->assign("tuoivangs",$tuoivangs);
$smarty->assign("tienmats",$tienmats);
$smarty->assign("madhsxs",$madhsxs);
$smarty->assign("ghichus",$ghichus);

if(!empty($fromDate)){
	$strSearch .= '&fromdays='.$fromDate;
	$fromDate = explode('/',$fromDate);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
	$wh.=' and datechuyen >= "'.$fromDate.'" ';
}
if(!empty($toDate)){
	$strSearch .= '&todays='.$toDate;				
	$toDate = explode('/',$toDate);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
	$wh.=' and datechuyen <= "'.$toDate.'" ';
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
if(!empty($idloaivang)){
	$strSearch .= '&idloaivang='.$idloaivang;
	$wh.=' and idloaivang =  '.$idloaivang.' ';
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
if(!empty($tienmats)){
	$strSearch .= '&tienmats='.$tienmats;
	$wh.=' and tienmatvang  like "%'.$tienmats.'%" ';
}

if(!empty($madhsxs)){
	$strSearch .= '&madhsxs='.$madhsxs;
	$sqlctl = "select id from $GLOBALS[db_catalog].ordersanxuat where code like '%".$madhsxs."%'  and huydh=0 order by id desc limit 100"; 
	$rsctl = $GLOBALS["catalog"]->getCol($sqlctl);
	$idmadhsx = "-1";
	if(ceil(count($rsctl)) > 0){
		$idmadhsx = implode(',',$rsctl);
	}
	$wh.=' and madhin in ('.$idmadhsx.') ';
}

if(!empty($ghichus)){
	$strSearch .= '&ghichus='.$ghichus;
	$wh.=' and ghichuvang  like "%'.$ghichus.'%" ';
}
?>