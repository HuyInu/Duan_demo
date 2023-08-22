<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';
$smarty->assign('phongbanchuyen', $idpem);
$idPhieu = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

switch($act) {
    case 'edit':
        $sqlPhieu = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where id=$idPhieu";
        $phieu = $GLOBALS['sp']->getRow($sqlPhieu);
        $smarty->assign('phieuXuat', $phieu);
        $template = 'Kho-A9-Huy-Xuat-Kho/editvang.tpl';
    break;
    case 'editsmVang':
        $id = $_POST['id'];
        $idct = $_POST['idct'];

        $arrvangxuatkho = [];
        $arrvangnhapkho = [];

        $arrvangxuatkho['midedit'] = $_SESSION['admin_qlsxntjcorg_id'];
        $arrvangxuatkho['chonphongbanin'] = $_POST['chonphongbanin'];
        $arrvangxuatkho['ghichuvang'] = $arrvangxuatkho['ghichueditvang'] =  $_POST['ghichueditvang'];

        $arrvangnhapkho['midedit'] = $_SESSION['admin_qlsxntjcorg_id'];
        $arrvangnhapkho['ghichuvang'] = $arrvangnhapkho['ghichueditvang'] =  $_POST['ghichueditvang'];

        $GLOBALS["sp"]->BeginTrans();
        try{
            vaUpdate('khonguonvao_khoachinct',$arrvangxuatkho,' id='.$id);
            vaUpdate('khonguonvao_khoachinct',$arrvangnhapkho,' id='.$idct);
            $GLOBALS["sp"]->CommitTrans();
            
            $url = "Kho-A9-Huy-Xuat-Kho.php?cid=".$_GET['cid'];
			page_transfer2($url);
        } 
        catch (Exception $e){
            $GLOBALS["sp"]->RollbackTrans();
            die($errorTransetion);
        }	
    break;
    default:
        $template = 'Kho-A9-Huy-Xuat-Kho/listvang.tpl';
            $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where type = 2 and trangthai = 0 and typevkc = 1 order by numphieu asc, id desc";
            $phieuXuatList = $GLOBALS['sp']->getAll($sql);

            $smarty->assign('phieuXuatList', $phieuXuatList);
    break;
}

$smarty->display('header.tpl');
$smarty->display($template);
$smarty->display('footer.tpl');
?>