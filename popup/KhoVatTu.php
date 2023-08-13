<?php 
include_once("../#include/config.php");
require_once("../functions/function.php");

$idmavattu = ceil($_REQUEST['idmavattu']);
$numdong = ceil($_REQUEST['numdong']);

$smarty->assign("idmavattu",$idmavattu);
$smarty->assign("numdong",$numdong);
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
switch($act){
    case "chonMaVatDung":
    
		$smarty->display("popup/DanhMucNguyenLieu/vattu.tpl");

	break;
}