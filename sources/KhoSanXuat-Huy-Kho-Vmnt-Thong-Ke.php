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
        include_once("search/KhoSanXuatThongKeTonKho.php");
        $wh = '';
        if(ceil($loaivang) > 0) {
            $wh = " and id = $loaivang";
        }
        $sqlLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1 $wh order by num asc, id asc";
        $loaiVang = $GLOBALS["sp"]->getAll($sqlLoaiVang);

        $smarty->assign("typegoldview",$loaiVang);
        $template = "KhoSanXuat-Huy-Kho-Vmnt-Thong-Ke/ton-kho.tpl";
    break;
}

$smarty->assign("fromdayCheck",$fromDate);
$smarty->assign("todaycheck",$toDate);
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>