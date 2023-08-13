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
$tenkimcuongs = trim(striptags($_GET['tenkimcuongs']));
$masogdpnjs = trim(striptags($_GET['masogdpnjs']));
$mscanhgtas = trim(striptags($_GET['mscanhgtas']));
$kichthuocs = trim(striptags($_GET['kichthuocs']));
$trongluonghots = trim(striptags($_GET['trongluonghots']));
$dotinhkhiets = trim(striptags($_GET['dotinhkhiets']));
$capdomaus = trim(striptags($_GET['capdomaus']));
$domaibongs = trim(striptags($_GET['domaibongs']));
$kichthuocbans = trim(striptags($_GET['kichthuocbans']));
$tienmats = trim(striptags($_GET['tienmats']));
$dongias = trim(striptags($_GET['dongias']));
$ghichus = trim(striptags($_GET['ghichus']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);
$smarty->assign("codes",$codes);
$smarty->assign("daychungtus",$daychungtus);
$smarty->assign("tenkimcuongs",$tenkimcuongs);
$smarty->assign("masogdpnjs",$masogdpnjs);
$smarty->assign("mscanhgtas",$mscanhgtas);
$smarty->assign("kichthuocs",$kichthuocs);
$smarty->assign("trongluonghots",$trongluonghots);
$smarty->assign("dotinhkhiets",$dotinhkhiets);
$smarty->assign("capdomaus",$capdomaus);
$smarty->assign("domaibongs",$domaibongs);
$smarty->assign("kichthuocbans",$kichthuocbans);
$smarty->assign("tienmats",$tienmats);
$smarty->assign("dongias",$dongias);
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
	$wh.=' and maphieu like "%'.$codes.'%" ';;
}
if(!empty($tenkimcuongs)){
	$strSearch .= '&tenkimcuongs='.$tenkimcuongs;
	$wh.=' and idkimcuong in ( select id from '.$GLOBALS['db_sp'].'.loaikimcuonghotchu where active=1 and name_vn like "%'.$tenkimcuongs.'%" ) ';
}
if(!empty($masogdpnjs)){
	$strSearch .= '&masogdpnjs='.$masogdpnjs;
	$wh.=' and codegdpnj  like "%'.$masogdpnjs.'%" ';
}
if(!empty($mscanhgtas)){
	$strSearch .= '&mscanhgtas='.$mscanhgtas;
	$wh.=' and codecgta  like "%'.$mscanhgtas.'%" ';
}
if(!empty($kichthuocs)){
	$strSearch .= '&kichthuocs='.$kichthuocs;
	$wh.=' and kichthuoc  like "%'.$kichthuocs.'%" ';
}
if(!empty($trongluonghots)){
	$strSearch .= '&trongluonghots='.$trongluonghots;
	$wh.=' and trongluonghot  like "%'.$trongluonghots.'%" ';
}
if(!empty($dotinhkhiets)){
	$strSearch .= '&dotinhkhiets='.$dotinhkhiets;
	$wh.=' and dotinhkhiet  like "%'.$dotinhkhiets.'%" ';
}
if(!empty($capdomaus)){
	$strSearch .= '&capdomaus='.$capdomaus;
	$wh.=' and capdomau  like "%'.$capdomaus.'%" ';
}
if(!empty($domaibongs)){
	$strSearch .= '&domaibongs='.$domaibongs;
	$wh.=' and domaibong  like "%'.$domaibongs.'%" ';
}
if(!empty($kichthuocbans)){
	$strSearch .= '&kichthuocbans='.$kichthuocbans;
	$wh.=' and kichthuocban  like "%'.$kichthuocbans.'%" ';
}
if(!empty($tienmats)){
	$strSearch .= '&tienmats='.$tienmats;
	$wh.=' and tienmatkimcuong  like "%'.$tienmats.'%" ';
}
if(!empty($dongias)){
	$strSearch .= '&dongias='.$dongias;
	$wh.=' and dongiaban  like "%'.$dongias.'%" ';
}
if(!empty($ghichus)){
	$strSearch .= '&ghichus='.$ghichus;
	$wh.=' and ghichukimcuong  like "%'.$ghichus.'%" ';
}
?>