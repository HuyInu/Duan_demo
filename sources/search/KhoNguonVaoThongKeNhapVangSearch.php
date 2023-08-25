<?php
$wh = $strSearch = '';
$fromDate = isset($_GET['fromdays']) ? trim(striptags($_GET['fromdays'])) : '';
$toDate = isset($_GET['todays']) ? trim(striptags($_GET['todays'])) : '';

if($act != 'ChiTietTon' && $act != 'ChoNhapKho' && $act != ''){
	if(empty($fromDate)){ /// nếu chưa chọn ngày lấy ngày hiện tại
		$fromDate = date("d/m/Y");
	}
	if(empty($toDate)){ /// nếu chưa chọn ngày lấy ngày hiện tại
		$toDate = date("d/m/Y");
	}
}

$codes = isset($_GET['codes']) ? trim(striptags($_GET['codes'])) : '';
$nhomnguyenlieus = isset($_GET['nhomnguyenlieus']) ? trim(striptags($_GET['nhomnguyenlieus'])) : '';
$tennguyenlieus = isset($_GET['tennguyenlieus']) ? trim(striptags($_GET['tennguyenlieus'])) : '';
$loaivangs = isset($_GET['loaivangs']) ? trim(striptags($_GET['loaivangs'])) : '';
$cannangvhs = isset($_GET['cannangvhs']) ? trim(striptags($_GET['cannangvhs'])) : '';
$cannanghs = isset($_GET['cannanghs']) ? trim(striptags($_GET['cannanghs'])) : '';
$cannangvs = isset($_GET['cannangvs']) ? trim(striptags($_GET['cannangvs'])) : '';
$tuoivangs = isset($_GET['tuoivangs']) ? trim(striptags($_GET['tuoivangs'])) : '';

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);

$smarty->assign("codes",$codes);
$smarty->assign("nhomnguyenlieus",$nhomnguyenlieus);
$smarty->assign("tennguyenlieus",$tennguyenlieus);
$smarty->assign("loaivangs",$loaivangs);
$smarty->assign("idloaivang",$loaivangs);
$smarty->assign("cannangvhs",$cannangvhs);
$smarty->assign("cannanghs",$cannanghs);
$smarty->assign("cannangvs",$cannangvs);
$smarty->assign("tuoivangs",$tuoivangs);


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
	$codeReplace = str_replace("PNK", "PXK", $codes);
	$wh.=' and maphieu like "%'.$codeReplace.'%" ';
}
if(!empty($nhomnguyenlieus)){
	$strSearch .= '&nhomnguyenlieus='.$nhomnguyenlieus;
	$wh.=' and nhomnguyenlieuvang = '.$nhomnguyenlieus.' ';
}
if(!empty($tennguyenlieus)){
	$strSearch .= '&tennguyenlieus='.$tennguyenlieus;
	$wh.=' and tennguyenlieuvang = '.$tennguyenlieus.' ';
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
?>