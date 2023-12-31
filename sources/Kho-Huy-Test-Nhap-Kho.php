<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';

switch($act) {
    
    case 'import':
        $template = 'KhoSanXuat-Huy-Kho-Test-Nhap-Kho/import.tpl';
		$smarty->assign("checkPer10","true");
        break;
    case 'nhap':
        $template = 'KhoSanXuat-Huy-Kho-Test-Nhap-Kho/nhap.tpl';
        $smarty->assign("checkPer10","true");
        break;
    case 'xuat':
        $template = 'KhoSanXuat-Huy-Kho-Test-Nhap-Kho/xuat.tpl';
        $smarty->assign("checkPer1","true");
        $smarty->assign("checkPer3","true");
        $smarty->assign("checkPer10","true");
        break;
    case 'xuatedit':
        $template = 'KhoSanXuat-Huy-Kho-Test-Nhap-Kho/xuatedit.tpl';
        break;
    case 'tonkho':
        $template = 'KhoSanXuat-Huy-Kho-Test-Nhap-Kho/ton-kho.tpl';
        break;
    case 'tonkhochitiet':
        $template = 'KhoSanXuat-Huy-Kho-Test-Nhap-Kho/ton-kho-chi-tiet.tpl';
        break;
    default:
        $sqlPhieu = "select * from $GLOBALS[db_sp].khosanxuat_khotest where cid=$idpem and type = 1 and typechuyen = 1 and trangthai = 0 order by typechuyen asc, datechuyen asc, id desc";
        $phieu = $GLOBALS['sp']->getAll($sqlPhieu);

        $smarty->assign('phieuNhap', $phieu);
        $template = 'KhoSanXuat-Huy-Kho-Test-Nhap-Kho/list.tpl';
    break;
}

$smarty->display('header.tpl');
$smarty->display($template);
$smarty->display('footer.tpl');
?>