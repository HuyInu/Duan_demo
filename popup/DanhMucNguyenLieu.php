<?php
include_once("../#include/config.php");
require_once("../functions/function.php");
$type = trim($_REQUEST['type']);
$idnhomdm = ceil($_REQUEST['idnhomdm']);
$idshow = ceil($_REQUEST['idshow']);
$smarty->assign("idnhomdm",$idnhomdm);
$smarty->assign("idshow",$idshow);
$sql = "select * from $GLOBALS[db_sp].categories where pid=$idnhomdm and active=1 order by num asc, id asc ";
$rs = $GLOBALS["sp"]->getAll($sql);
$smarty->assign("nhomnguyenlieu",$rs);

if($type == 'vang'){
	$idnhomnguyenlieuvang = ceil($_REQUEST['idnhomnguyenlieuvang']);
	$idtennguyenlieuvang = ceil($_REQUEST['idtennguyenlieuvang']);
	$smarty->assign("nhomnguyenlieuvangactive",$idnhomnguyenlieuvang);
	$smarty->assign("tennguyenlieuvangactive",$idtennguyenlieuvang);
	$smarty->display("popup/DanhMucNguyenLieu/vang.tpl");
}
else{////là kim cương
	$idnhomnguyenlieukimcuong = ceil($_REQUEST['idnhomnguyenlieukimcuong']);
	$idtennguyenlieukimcuong = ceil($_REQUEST['idtennguyenlieukimcuong']);
	$smarty->assign("nhomnguyenlieukimcuongactive",$idnhomnguyenlieukimcuong);
	$smarty->assign("tennguyenlieukimcuongactive",$idtennguyenlieukimcuong);
	
	$smarty->display("popup/DanhMucNguyenLieu/kimcuong.tpl");
}
?>