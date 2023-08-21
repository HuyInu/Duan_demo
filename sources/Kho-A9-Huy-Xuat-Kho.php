<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';
$smarty->assign('phongbanchuyen', $idpem);

switch($act) {
    default:
        $template = 'Kho-A9-Huy-Xuat-Kho/listvang.tpl';
        try {
            $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where type = 2 and trangthai = 0 and typevkc = 1 order by numphieu asc, id desc";
            $phieuXuatList = $GLOBALS['sp']->getAll($sql);
            //var_dump($phieuXuatList);die();
            $smarty->assign('phieuXuatList', $phieuXuatList);
        } catch(Exception $e) {
            die();
        }
        
    break;
}

$smarty->display('header.tpl');
$smarty->display($template);
$smarty->display('footer.tpl');
?>