<?php 
include_once("../#include/config.php");
require_once("../functions/function.php");

$idmavattu = ceil($_REQUEST['idphukien']);
$numdong = ceil($_REQUEST['numdong']);

$smarty->assign("idphukien",$idphukien);
$smarty->assign("numdong",$numdong);
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
switch($act){
    case "chonMaPhuKien":
		$smarty->display("popup/DanhMucNguyenLieu/phukien.tpl");
	break;
}