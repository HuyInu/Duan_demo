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
        if($numphieuMax == 0) {
            $numphieuMax = 1;
        }
        $maso = convertMaso($numphieuMax);
        $rs['maphieu'] = 'PXSNKVMNT'.$maso;

        $slqLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1";
        $loaiVang = $GLOBALS['sp']->getAll($slqLoaiVang);

        $smarty->assign('typegold', $loaiVang);
        $smarty->assign('edit', $rs);
        $template = 'KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho/edit.tpl';
    break;
    case 'edit':
        try{
        $sqlPhieu = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where id=".$_REQUEST['id'];
        $phieu = $GLOBALS['sp']->getRow($sqlPhieu);

        $slqLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1";
        $loaiVang = $GLOBALS['sp']->getAll($slqLoaiVang);
        }catch(Exception $e) {
            var_dump($e);die();
        }
        $smarty->assign('typegold', $loaiVang);
        $smarty->assign('edit', $phieu);
        $template = 'KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho/edit.tpl';        
    break;
    case "addsm": case "editsm":
        $dateNow = date("Y-m-d");
        $timeNow = date("H:i:s");
        $phieuXuat = [];

        try{
            $phieuXuat['idloaivang'] = $_POST['idloaivang'];
            $phieuXuat['cannangvh'] = $_POST['cannangvh'];
            $phieuXuat['cannangh'] = $_POST['cannangh'];
            $phieuXuat['cannangv'] = $_POST['cannangv'];
            $phieuXuat['tuoivang'] = $_POST['tuoivang'];
            $phieuXuat['chonphongbanin'] = $_POST['chonphongbanin'];
            $phieuXuat['madhin'] = $_POST['madhin'];
            $phieuXuat['ghichuvang'] = $_POST['ghichuvang'];

            if($act == 'addsm') {
                $maso = StringToNum($_POST['maphieu']);
                $phieuXuat['numphieu'] = $maso;
                $phieuXuat['maphieu'] = 'PXSNKVMNT'.$maso;
                $phieuXuat['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
                $phieuXuat['cid'] = $idpem;
                $phieuXuat['phongban'] = $idpem;
                $phieuXuat['time'] = $timeNow;
                $phieuXuat['dated'] = $dateNow;
                $phieuXuat['type'] = 2;

                vaInsert('khosanxuat_khovmnt', $phieuXuat);  
            } else {
                vaUpdate('khosanxuat_khovmnt', $phieuXuat, 'id='.$_POST['id']);  
            }
        }catch(Exception $e) {
            var_dump($e);die();
        }
        $url = "KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho.php?cid=".$_GET['cid'];
		page_transfer2($url);
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

function StringToNum($str) {
    $num = 0;
    foreach (str_split($str) as $index => $char) {
        if($char != '0' && is_numeric($char)) {
            $num = substr($str, $index);
            return $num;
        }
    }
    die("Đã xảy ra lỗi!.");
}
?>
