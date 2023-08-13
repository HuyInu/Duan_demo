<?php
$wh = $whnx = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));
if(empty($fromDate) && ($act == 'KhoLamMoiKhoLuuTru')){ /// nếu chưa chọn ngày lấy ngày hiện tại
	$fromDate = date("d/m/Y");
}
if(empty($toDate) && ($act == 'KhoLamMoiKhoLuuTru')){ /// nếu chưa chọn ngày lấy ngày hiện tại
	$toDate = date("d/m/Y");
}
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
	$wh.=' and datechuyen >= "'.$fromDate.'" ';
	$whnx.=' and datedxuat >= "'.$fromDate.'" ';
}
if(!empty($toDate)){
	$strSearch .= '&todays='.$toDate;				
	$toDate = explode('/',$toDate);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
	$wh.=' and datechuyen <= "'.$toDate.'" ';
	$whnx.=' and datedxuat <= "'.$toDate.'" ';
}

if(!empty($codes)){
	$strSearch .= '&codes='.$codes;
	$wh.=' and maphieu like "%'.$codes.'%" ';
	$whnx.=' and maphieu like "%'.$codes.'%" ';
}
if(!empty($madonhangsxs)){
	$strSearch .= '&madonhangsxs='.$madonhangsxs;
	$wh.=' and madonhangsx like "%'.$madonhangsxs.'%" ';
	$whnx.=' and madonhangsx like "%'.$madonhangsxs.'%" ';
}
if(!empty($idloaivang)){
	$strSearch .= '&idloaivang='.$idloaivang;
	$wh.=' and idloaivang =  '.$idloaivang.' ';
	$whnx.=' and idloaivang =  '.$idloaivang.' ';
}
if(!empty($ghichus)){
	$strSearch .= '&ghichus='.$ghichus;
	$wh.=' and ghichu  like "%'.$ghichus.'%" ';
	$whnx.=' and ghichu  like "%'.$ghichus.'%" ';
}
?>