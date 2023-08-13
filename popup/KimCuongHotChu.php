<?php
include_once("../#include/config.php");
require_once("../functions/function.php");
$idkimcuong = ceil($_REQUEST['idkimcuong']);
$idshow = ceil($_REQUEST['idshow']);

$smarty->assign("idkimcuong",$idkimcuong);
$smarty->assign("idshow",$idshow);

$smarty->display("popup/DanhMucNguyenLieu/kimcuonghotchu.tpl");
?>