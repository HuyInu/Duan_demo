<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';
$smarty->assign('phongbanchuyen', $idpem);

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
        if ( $_COOKIE["typeVangKimCuong"] == 'kimcuong') {
            $template = 'KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho/editkimcuong.tpl';  
        } else {
            $slqLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1";
            $loaiVang = $GLOBALS['sp']->getAll($slqLoaiVang);
            $smarty->assign('typegold', $loaiVang);

            $template = 'KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho/edit.tpl';
        }
        $smarty->assign('edit', $rs);
    break;
    case 'edit':
        try{
                $isExistRecord = isExistRecord('khosanxuat_khovmnt', "id=".$_GET['id']." and typevkc in (1, 2) and trangthai in (1,2)");
                if($isExistRecord) {
                    dd('Phiếu đã được nhập');
                }
                $sqlPhieu = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where id=".$_REQUEST['id'];
                $phieu = $GLOBALS['sp']->getRow($sqlPhieu);
                if ($phieu['typevkc'] == 1) {
                    $slqLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1";
                    $loaiVang = $GLOBALS['sp']->getAll($slqLoaiVang);
                    $smarty->assign('typegold', $loaiVang);

                    $template = 'KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho/edit.tpl';   
                } else {

                    $template = 'KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho/editkimcuong.tpl';  
                }   
                $smarty->assign('edit', $phieu); 
        }catch(Exception $e) {
            dd($e);
        }  
    break;
    case "addsm": case "editsm":
        $dateNow = date("Y-m-d");
        $timeNow = date("H:i:s");
        $phieuXuat = [];
        try{
            if ( $_COOKIE["typeVangKimCuong"] == 'kimcuong') {
                EditKimCuong();
            } else {
                $phieuXuat['idloaivang'] = $_POST['idloaivang'];
                $phieuXuat['cannangvh'] = $_POST['cannangvh'];
                $phieuXuat['cannangh'] = $_POST['cannangh'];
                $phieuXuat['cannangv'] = $_POST['cannangv'];
                $phieuXuat['tuoivang'] = $_POST['tuoivang'];
                $phieuXuat['chonphongbanin'] = $_POST['chonphongbanin'];
                $phieuXuat['madhin'] = $_POST['madhin'];
                $phieuXuat['ghichuvang'] = $_POST['ghichuvang'];

                if($act == 'addsm') {
                    $numphieu = StringToNum($_POST['maphieu']);
                    $phieuXuat['numphieu'] = $numphieu;
                    $phieuXuat['maphieu'] = $_POST['maphieu'];
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
            }
        }catch(Exception $e) {
            var_dump($e);die();
        }
        $url = "KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?cid=".$_GET['cid'];
		page_transfer2($url);
        break;
    case 'dellist':
        $GLOBALS["sp"]->BeginTrans();
		try{
            $iddel = $_POST['iddel'];
            $whereDelete = implode(',', $iddel);
            $sql = "Delete from $GLOBALS[db_sp].khosanxuat_khovmnt where id in ($whereDelete)";
            $GLOBALS["sp"]->execute($sql);

            $GLOBALS["sp"]->CommitTrans();
        } catch(Exception $e) {
            $GLOBALS["sp"]->RollbackTrans();
			die($errorTransetion);
        }
        $url = "KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?cid=".$_GET['cid'];
		page_transfer2($url);
        break;
    default:
        include_once("search/KhoNguonVaoXuatKhoVangSearch.php");
        $sql = "select *from $GLOBALS[db_sp].khosanxuat_khovmnt where cid=$idpem and trangthai = 0 and type = 2 and typevkc in (1,2) $wh order by dated asc, id asc";
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
}
function EditKimCuong () {
    global $idpem;
    $dateNow = date("Y-m-d");
    $timeNow = date("H:i:s");
    $phieuXuat = [];

    $phieuXuat['tienmatkimcuong'] = $_POST['tienmatkimcuong'];
    $phieuXuat['dongiaban'] = $_POST['dongiaban'];
    $phieuXuat['chonphongbanin'] = $_POST['chonphongbanin'];

    if ($_GET['act'] == 'addsm') {
        $numphieu = StringToNum($_POST['maphieu']);
        $phieuXuat['numphieu'] = $numphieu;
        $phieuXuat['maphieu'] = $_POST['maphieu'];
        $phieuXuat['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
        $phieuXuat['cid'] = $idpem;
        $phieuXuat['phongban'] = $idpem;
        $phieuXuat['time'] = $timeNow;
        $phieuXuat['dated'] = $dateNow;
        $phieuXuat['type'] = 2;
        $phieuXuat['typevkc'] = 2;

        vaInsert('khosanxuat_khovmnt', $phieuXuat); 
    } else {
        vaUpdate('khosanxuat_khovmnt', $phieuXuat, 'id='.$_POST['id']);
    }
}
?>
