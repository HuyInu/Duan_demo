<?php
$wh = $strSearch = '';
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
$tenkimcuongs = trim(striptags($_GET['tenkimcuongs']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);

$smarty->assign("codes",$codes);
$smarty->assign("nhomnguyenlieus",$nhomnguyenlieus);
$smarty->assign("tennguyenlieus",$tennguyenlieus);
$smarty->assign("tenkimcuongs",$tenkimcuongs);

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
	$wh.=' and nhomnguyenlieukimcuong = '.$nhomnguyenlieus.' ';
}
if(!empty($tennguyenlieus)){
	$strSearch .= '&tennguyenlieus='.$tennguyenlieus;
	$wh.=' and tennguyenlieukimcuong = '.$tennguyenlieus.' ';
}
if(!empty($tenkimcuongs)){
	$strSearch .= '&tenkimcuongs='.$tenkimcuongs;
	$wh.=' and idkimcuong in ('.$tenkimcuongs.') ';
}

?>