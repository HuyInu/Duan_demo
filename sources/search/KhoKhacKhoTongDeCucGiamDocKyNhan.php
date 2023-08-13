<?php
$wh = $whnx = $whdatechuyen = $whnodate = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));
if(empty($fromDate) && ($act == 'KhoSauCheTacKhoLuuTru')){ /// nếu chưa chọn ngày lấy ngày hiện tại
	$fromDate = date("d/m/Y");
}
if(empty($toDate) && ($act == 'KhoSauCheTacKhoLuuTru')){ /// nếu chưa chọn ngày lấy ngày hiện tại
	$toDate = date("d/m/Y");
}
$codes = trim(striptags($_GET['codes']));
$daychungtus = trim(striptags($_GET['daychungtus']));
$loaivangs = trim(striptags($_GET['loaivangs']));
$idloaivang = trim(striptags($_GET['idloaivang']));
$tongtlvangsauchetacs = trim(striptags($_GET['tongtlvangsauchetacs']));
$tuoivangsauchetacs = trim(striptags($_GET['tuoivangsauchetacs']));
$hoichetacs = trim(striptags($_GET['hoichetacs']));
$ghichus = trim(striptags($_GET['ghichus']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);
$smarty->assign("codes",$codes);
$smarty->assign("daychungtus",$daychungtus);
$smarty->assign("loaivangs",$loaivangs);
$smarty->assign("idloaivang",$idloaivang);
$smarty->assign("tongtlvangsauchetacs",$tongtlvangsauchetacs);
$smarty->assign("tuoivangsauchetacs",$tuoivangsauchetacs);
$smarty->assign("hoichetacs",$hoichetacs);
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

if(!empty($idloaivang)){
	$strSearch .= '&idloaivang='.$idloaivang;
	$wh.=' and idloaivang =  '.$idloaivang.' ';
}
if(!empty($tongtlvangsauchetacs)){
	$strSearch .= '&tongtlvangsauchetacs='.$tongtlvangsauchetacs;
	$wh.=' and trongluongvangsauchetac like "%'.$tongtlvangsauchetacs.'%" ';
}

if(!empty($tuoivangsauchetacs)){
	$strSearch .= '&tuoivangsauchetacs='.$tuoivangsauchetacs;
	$wh.=' and tuoivangsauchetac like "%'.$tuoivangsauchetacs.'%" ';
}
if(!empty($hoichetacs)){
	$strSearch .= '&hoichetacs='.$hoichetacs;
	$wh.=' and hoiche like "%'.$hoichetacs.'%" ';
}
if(!empty($ghichus)){
	$strSearch .= '&ghichus='.$ghichus;
	$wh.=' and ghichu  like "%'.$ghichus.'%" ';
}
?>