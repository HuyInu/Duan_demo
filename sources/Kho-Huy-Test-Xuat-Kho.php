<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';

$smarty->assign('phongbanchuyen', $idpem);

switch($act) {
    case 'add':
        $rs = [];

        $rs['dated'] = date('Y-m-d');
        
        $template = 'KhoSanXuat-Huy-Kho-Test-Xuat-Kho/edit.tpl';
        $sqlMaxNum ="select max(numphieu)+1 from $GLOBALS[db_sp].khosanxuat_khotest";
        $maxNum = $GLOBALS["sp"]->getOne($sqlMaxNum);

        $maso = convertMaso($maxNum);
        $rs['maphieu'] = 'PXSNKTEST'.$maso;

        $slqLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1";
        $loaiVang = $GLOBALS['sp']->getAll($slqLoaiVang);

        $smarty->assign('typegold', $loaiVang);
        $smarty->assign('edit', $rs);
        $template = 'KhoSanXuat-Huy-Kho-Test-Xuat-Kho/edit.tpl';
        break;
    case 'edit':
        $isExistRecord = isExistRecord('khosanxuat_khotest', "id=".$_GET['id']." and typevkc=1 and trangthai in (1,2)");
        if($isExistRecord) {
            dd('Phiếu đã được nhập');
        }
        $idPhieu = $_GET['id'];
        $sql = "select * from $GLOBALS[db_sp].khosanxuat_khotest where id=$idPhieu";
        $rs = $GLOBALS['sp']->getRow($sql);

        $slqLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1";
        $loaiVang = $GLOBALS['sp']->getAll($slqLoaiVang);

        $smarty->assign('edit', $rs);
        $smarty->assign('typegold', $loaiVang);
        $template = 'KhoSanXuat-Huy-Kho-Test-Xuat-Kho/edit.tpl';
        break;
    case 'addsm': case 'editsm':
        $dateNow = date("Y-m-d");
        $timeNow = date("H:i:s");
        $phieuXuat = [];

        $phieuXuat['idloaivang'] = $_POST['idloaivang'];
        $phieuXuat['cannangvh'] = $_POST['cannangvh'];
        $phieuXuat['cannangh'] = $_POST['cannangh'];
        $phieuXuat['cannangv'] = $_POST['cannangv'];
        $phieuXuat['tuoivang'] = $_POST['tuoivang'];
        $phieuXuat['chonphongbanin'] = $_POST['chonphongbanin'];
        $phieuXuat['ghichuvang'] = $_POST['ghichuvang'];

        if($_GET['act'] == 'addsm') {
            $phieuXuat['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
            $phieuXuat['cid'] = $idpem;
            $phieuXuat['numphieu'] = StringToNum($_POST['maphieu']);
            $phieuXuat['maphieu'] = $_POST['maphieu'];
            $phieuXuat['type'] = 2;
            $phieuXuat['typevkc'] = 1;
            $phieuXuat['time'] = $timeNow;
            $phieuXuat['dated'] = $dateNow;
            $phieuXuat['typevkc'] = 1;
            $phieuXuat['phongban'] = $idpem;
            $phieuXuat['trangthai'] = 0;

            vaInsert('khosanxuat_khotest', $phieuXuat);
        } else {
            vaUpdate('khosanxuat_khotest', $phieuXuat, 'id='.$_POST['id']);
        }

        $url = "Kho-Huy-Test-Xuat-Kho.php?cid=".$_GET['cid'];
        
		page_transfer2($url);
        break;
    default:
        include_once("search/KhoNguonVaoXuatKhoVangSearch.php");
        $template = 'KhoSanXuat-Huy-Kho-Test-Xuat-Kho/list.tpl';
        $sql = "select * from $GLOBALS[db_sp].khosanxuat_khotest where type=2 and trangthai = 0 and typevkc=1 $wh order by dated asc, id asc";
        $phieuXuat = $GLOBALS["sp"]->getAll($sql);

        $smarty->assign('view', $phieuXuat);
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