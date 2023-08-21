<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';

switch($act) {
    default:
        $sqlPhieuNhap = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where type = 1 and typechuyen = 1 and trangthai = 0 order by typechuyen asc, datechuyen asc, id desc";
        $phieuNhap = $GLOBALS['sp']->getAll($sqlPhieuNhap);

        $smarty->assign('phieuNhap', $phieuNhap);
        $template = 'KhoSanXuat-Huy-Kho-Kv-Nhap-Kho/list.tpl';
    break;
}

$smarty->display('header.tpl');
$smarty->display($template);
$smarty->display('footer.tpl');
?>