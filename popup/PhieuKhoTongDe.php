<?php
include_once("../#include/config.php");
require_once("../functions/function.php");
$act = trim($_REQUEST['act']);
$idmaphieu = ceil($_REQUEST['idmaphieu']);
$idshow = ceil($_REQUEST['idshow']);

$smarty->assign("idmaphieu",$idmaphieu);
$smarty->assign("idshow",$idshow);
$smarty->display("popup/DanhMucNguyenLieu/PhieuKhoTongDeCuc.tpl");
?>