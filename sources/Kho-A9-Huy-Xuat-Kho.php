<?php
include_once("../maininclude.php");
require_once '../Classes-PHPExcel/PHPExcel.php';
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';
$smarty->assign('phongbanchuyen', $idpem);
$idPhieu = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

switch($act) {
    case 'edit':
        $isExistRecord = isExistRecord('khonguonvao_khoachinct', "id=$idPhieu and typevkc=1 and trangthai in (1,2)");
        if(!$isExistRecord) {
            $sqlPhieu = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where id=$idPhieu";
            $phieu = $GLOBALS['sp']->getRow($sqlPhieu);
            $smarty->assign('phieuXuat', $phieu);
            $template = 'Kho-A9-Huy-Xuat-Kho/editvang.tpl';
        } else {
            dd('Phiếu đã được nhập.');
        }
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
    case 'print':
        if (!isset($_GET['id'])) {
            die();
        } 
        $idPhieu = $_GET['id'];
        $sqlPhieu = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where id in (12, 13)";
        $phieu = $GLOBALS['sp']->getAll($sqlPhieu);
        $excel = new PHPExcel();
        $excel->createSheet();
        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->setTitle('Demo excel.');
        foreach ($phieu as $rowIndex => $row) {
            $excel->getActiveSheet()->setCellValue('A'.($rowIndex+1), $row['maphieu']);
            $excel->getActiveSheet()->setCellValue('B'.($rowIndex+1), getName('categories','namevn', $row['nhomnguyenlieuvang']));
        }
        ob_end_clean();
        ob_start();
        header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=demoExcel.xls');
		PHPExcel_IOFactory::createWriter($excel, 'Excel5')->save('php://output');
        exit();
        break;
    default:
        if($_COOKIE["typeVangKimCuong"] == 'kimcuong'){
            //include_once("search/KhoNguonVaoXuatKhoKimCuongSearch.php");
            $whereTypevkc = 'typevkc = 2';
            $template = 'Kho-A9-Huy-Xuat-Kho/listkimcuong.tpl';
        } else {
            include_once("search/KhoNguonVaoXuatKhoVangSearch.php");
            $whereTypevkc = 'typevkc = 1';
            $template = 'Kho-A9-Huy-Xuat-Kho/listvang.tpl';
        }
        
        $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where type = 2 and trangthai = 0 and $whereTypevkc $wh order by numphieu asc, id desc";
        $phieuXuatList = $GLOBALS['sp']->getAll($sql);

        $smarty->assign('view', $phieuXuatList);
    break;
}

$smarty->display('header.tpl');
$smarty->display($template);
$smarty->display('footer.tpl');
?>