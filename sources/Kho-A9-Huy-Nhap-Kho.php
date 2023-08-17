<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
switch($act) {
    case 'edit':
        $template = 'Kho-A9-Huy-Nhap-Kho/edit.tpl';
    break;
    default:
        $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachin where type = 1 order by datedchungtu desc, maphieu asc";
        $phieuNhap = $GLOBALS["sp"]->getAll($sql);

        $smarty->assign('phieuNhap',$phieuNhap);
        $template = 'Kho-A9-Huy-Nhap-Kho/list.tpl';
    break;
}

$smarty->display('header.tpl');
$smarty->display($template);
$smarty->display('footer.tpl');
?>