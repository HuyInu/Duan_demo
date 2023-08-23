<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);

$sqlvang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
$rsvang = $GLOBALS["sp"]->getAll($sqlvang);
$smarty->assign("typegold",$rsvang);
switch($act) {
    default:
        $sqlLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1 order by num asc, id desc";
        $loaiVang = $smarty->assign("typegoldview",$sqlLoaiVang);	

        $template = 'Kho-A9-Huy-Thong-Ke/tonvang.tpl';
    break;
}

$smarty->assign("fromdayCheck",$fromDate);
$smarty->assign("todaycheck",$toDate);
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>