<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = $_REQUEST['cid'];
$nhomdanhmuc = getTableRow('categories', 'and id = 70 and active = 1');
$smarty->assign('nhomdanhmuc',$nhomdanhmuc);
switch($act) {
    case 'add':
        $dateNow = date('d/m/Y');
        $maxNum = "select max(numphieu) from $GLOBALS[db_sp].khonguonvao_khoachin";
        if($maxNum <= 0) {
            $maxNum = 1;
        }
        $maso = convertMaso($maxNum);
        $toa['maphieu'] = 'PNKACHIN'.$maso;
        $toa['datedchungtu'] = $toa['datedhachtoan'] = $dateNow;

        $smarty->assign('toa',$toa);
        $template = 'Kho-A9-Huy-Nhap-Kho/edit.tpl';
    break;
    case 'edit':
        $idToa = $_REQUEST['id'];

        $sqlToa = "select * from $GLOBALS[db_sp].khonguonvao_khoachin where id = $idToa and type = 1";
        $toa = $GLOBALS['sp']->getRow($sqlToa);

        $sqlCtToaVang = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where idctnx = $idToa and type = 1 and typevkc = 1 order by id asc";
        $ctToaVang = $GLOBALS['sp']->getAll($sqlCtToaVang);
        $countCtToaVang = count($ctToaVang);
        
        $smarty->assign('toa',$toa);
        $smarty->assign('coutndongvang',$countCtToaVang + 1);
        $smarty->assign('ctToaVang',$ctToaVang);
        $template = 'Kho-A9-Huy-Nhap-Kho/edit.tpl';
    break;
    case 'addsm': case 'editsm':
        Editsm();
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

function Editsm () {
    global $idpem;
    $act = $_GET['act'];
    $idToa = isset($_POST['id']) ? $_POST['id'] : '';

    $dateNow = date('Y-m-d');
    $timeNow = date('H:i:s');
    $datedchungtu = explode('/',trim($_POST["datedchungtu"]));
    $datedhachtoan = explode('/',trim($_POST["datedhachtoan"]));

    $toa = [];
    $ctToa = [];
    
    try {
    $toa['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
    $toa['nguoilapphieu'] = $_POST['nguoilapphieu'];
    $toa['donvilapphieu'] = $_POST['donvilapphieu'];
    $toa['nguoiduyetphieu'] = $_POST['nguoiduyetphieu'];
    $toa['donviduyetphieu'] = $_POST['donviduyetphieu'];
    $toa['lydo'] = $_POST['lydo'];
    $ctToa['dated'] = $toa['datedchungtu'] = $datedchungtu[2].'-'.$datedchungtu[1].'-'.$datedchungtu[0];
    $toa['datedhachtoan'] = $datedhachtoan[2].'-'.$datedhachtoan[1].'-'.$datedhachtoan[0];
    
    if ($act === 'addsm') {
        $sql = "select max(numphieu)+1 from $GLOBALS[db_sp].khonguonvao_khoachin";
        $maxNum = $GLOBALS['sp']->getOne($sql);
        if($maxNum <= 0) {
            $maxNum = 1;
        }
        var_dump($maxNum);
        $maso = convertMaso($maxNum);
        $toa['numphieu'] = $maso;
        $toa['maphieu'] = 'PNKACHIN'.$maso;
        $toa['phongban'] = $idpem;
        $toa['type'] = 1;
        
        $idctnx = vaInsert('khonguonvao_khoachin', $toa); 
    }
    die();
    $idctnxvang = $_POST['idctnxvang'];
    $nhomnguyenlieuvangct = $_POST['nhomnguyenlieuvang'];
    $tennguyenlieuvangct = $_POST['tennguyenlieuvang'];
    $loaivangct = $_POST['loaivang'];
    $cannangvhct = $_POST['cannangvh'];
    $cannanghct = $_POST['cannangh'];
    //$cannangvct = $_POST['cannangv'];
    $tuoivangct = $_POST['tuoivang'];
    $tienmatvangct = $_POST['tienmatvang'];
    $ghichuvangct = $_POST['ghichuvang'];

    foreach($idctnxvang as $index => $idctvang) {
        $cannangvh = str_replace(',','',trim($cannangvhct[$index]));
        $cannangh = str_replace(',','',trim($cannanghct[$index]));
        if($nhomnguyenlieuvangct[$index] > 0 && $tennguyenlieuvangct[$index] > 0 && $loaivangct[$index] >0) {
            $ctToa['nhomnguyenlieuvang'] = $nhomnguyenlieuvangct[$index];
            $ctToa['tennguyenlieuvang'] = $tennguyenlieuvangct[$index];
            $ctToa['loaivang'] = $loaivangct[$index];
            $ctToa['cannangvh'] =  $cannangvh;
            $ctToa['cannangh'] = $cannangh;
            $ctToa['cannangv'] = $cannangvh - $cannangh;
            $ctToa['tuoivang'] = $tuoivangct[$index];
            $ctToa['tienmatvang'] = $tienmatvangct[$index];
            $ctToa['ghichuvang'] = $ghichuvangct[$index];
            if($idctvang > 0) {
                vaUpdate('khonguonvao_khoachinct',$ctToa, "id = $idctvang");
            } else {
                $ctToa['idctnx'] = $idctnx;
                $ctToa['mid'] = 
            }
        } else {

        }
    }

    } catch (Exception $e) {
        var_dump($e);
    }
}
?>