<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';

switch($act) {
    case 'add':
        $rs = [];
        $rs['dated'] = date('Y-m-d');
        $sql = "select max(numphieu)+1 from $GLOBALS[db_sp].khosanxuat_khovmnt";
        $numphieuMax = $GLOBALS['sp']->getOne($sql);
        if($numphieuMax = 0) {
            $numphieuMax = 1;
        }
        $maso = convertMaso($numphieuMax);
        $rs['maphieu'] = 'PXSNKVMNT'.$maso;

        $smarty->assign('edit', $rs);
        $template = 'KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho/edit.tpl';
    break;
    default:
        $sql = "select *from $GLOBALS[db_sp].khosanxuat_khovmnt where cid=$idpem and trangthai = 0 and type = 2 and typevkc = 1 order by dated asc, id asc";
        $phieuXuat = $GLOBALS["sp"]->getAll($sql);

        $smarty->assign('phieuXuat', $phieuXuat);
        $template = 'KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho/list.tpl';
    break;
}
$smarty->display('header.tpl');
$smarty->display($template);
$smarty->display('footer.tpl');
?>