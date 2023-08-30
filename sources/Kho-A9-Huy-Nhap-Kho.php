<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = $_GET['cid'];
$nhomdanhmuc = getTableRow('categories', 'and id = 70 and active = 1');

$smarty->assign('phongbanchuyen',$idpem);
$smarty->assign('nhomdanhmuc',$nhomdanhmuc);

switch($act) {
    case 'add':
        $dateNow = date('d/m/Y');
        $sql = "select max(numphieu)+1 from $GLOBALS[db_sp].khonguonvao_khoachin";
        $maxNum = $GLOBALS['sp']->getOne($sql);
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
        $isExistRecord = isExistRecord('khonguonvao_khoachin', "id=".$_GET['id']." and type = 3");
        if($isExistRecord) {
            dd('Phiếu đã được nhập');
        }
        $idToa = $_REQUEST['id'];

        $sqlToa = "select * from $GLOBALS[db_sp].khonguonvao_khoachin where id = $idToa and type = 1";
        $toa = $GLOBALS['sp']->getRow($sqlToa);

        $sqlCtToaVang = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where idctnx = $idToa and type = 1 and typevkc = 1 order by id asc";
        $ctToaVang = $GLOBALS['sp']->getAll($sqlCtToaVang);
        $countCtToaVang = count($ctToaVang);

        $sqlCtToaKimCuong = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where idctnx = $idToa and type = 1 and typevkc = 2 order by id asc";
        $ctToaKimCuong = $GLOBALS['sp']->getAll($sqlCtToaKimCuong);
        $countCtToaKimCuong = count($ctToaKimCuong);
        
        $smarty->assign('toa',$toa);
        $smarty->assign('coutndongvang',$countCtToaVang + 1);
        $smarty->assign('coutndongkimcuong',$countCtToaKimCuong + 1);
        $smarty->assign('ctToaVang',$ctToaVang);
        $smarty->assign('viewtcctkimcuong',$ctToaKimCuong);
        $template = 'Kho-A9-Huy-Nhap-Kho/edit.tpl';
    break;
    case 'addsm': case 'editsm':
        Editsm();
        $url = "Kho-A9-Huy-Nhap-Kho.php?cid=".$_GET['cid'];
		page_transfer2($url);
    break;
    case 'dellist':
        $GLOBALS["sp"]->BeginTrans();
        try {
            $iddel = isset($_POST['iddel']) ? $_POST['iddel'] : null;
            if(count($iddel) > 0) {
                $idToaDel = implode(",", $iddel);
                vaDelete('khonguonvao_khoachin', "id in ($idToaDel)");
                vaDelete('khonguonvao_khoachinct', "idctnx in ($idToaDel)");
            }
            $GLOBALS["sp"]->CommitTrans();
            $url = "Kho-A9-Huy-Nhap-Kho.php?cid=".$_GET['cid'];
		    page_transfer2($url);
        } catch (Exception $e) {
            $GLOBALS["sp"]->RollbackTrans();
            die();
        }
        
    break;
    default:
        $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachin where type = 1 and phongban = $idpem order by datedchungtu desc, maphieu asc";
        $phieuNhap = $GLOBALS["sp"]->getAll($sql);

        $smarty->assign('phieuNhap',$phieuNhap);
        $template = 'Kho-A9-Huy-Nhap-Kho/list.tpl';
    break;
}

$smarty->display('header.tpl');
$smarty->display($template);
$smarty->display('footer.tpl');

function Editsm () {
    global $idpem, $nhomdanhmuc;
    $act = $_GET['act'];
    $idToa = isset($_POST['id']) ? $_POST['id'] : '';

    $dateNow = date('Y-m-d');
    $timeNow = date('H:i:s');
    $datedchungtu = explode('/',trim($_POST["datedchungtu"]));
    $datedhachtoan = explode('/',trim($_POST["datedhachtoan"]));
    $maphieu = $_POST['maphieu'];
    $numphieu = StringToNum($maphieu);

    $toa = [];
    $ctToa = [];
    
    $GLOBALS["sp"]->BeginTrans();
    try {  
        $toa['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
        $toa['nguoilapphieu'] = $_POST['nguoilapphieu'];
        $toa['donvilapphieu'] = $_POST['donvilapphieu'];
        $toa['nguoiduyetphieu'] = $_POST['nguoiduyetphieu'];
        $toa['donviduyetphieu'] = $_POST['donviduyetphieu'];
        $toa['lydo'] = $_POST['lydo'];
        $toa['datedchungtu'] = $datedchungtu[2].'-'.$datedchungtu[1].'-'.$datedchungtu[0];
        $toa['datedhachtoan'] = $datedhachtoan[2].'-'.$datedhachtoan[1].'-'.$datedhachtoan[0];

        if ($act === 'addsm') {
            $toa['numphieu'] = $numphieu;
            $toa['maphieu'] = $maphieu;
            $toa['phongban'] = $idpem;
            $toa['type'] = 1;
            
            $idctnx = vaInsert('khonguonvao_khoachin', $toa); 
        } else {
            $idctnx = $_POST['id'];
            vaUpdate('khonguonvao_khoachin', $toa, "id = $idctnx");
            
        }
        $idctnxvang = $_POST['idctnxvang'];
        $nhomnguyenlieuvangct = $_POST['nhomnguyenlieuvang'];
        $tennguyenlieuvangct = $_POST['tennguyenlieuvang'];
        $idloaivangct = $_POST['idloaivang'];
        $cannangvhct = $_POST['cannangvh'];
        $cannanghct = $_POST['cannangh'];
        //$cannangvct = $_POST['cannangv'];
        $tuoivangct = $_POST['tuoivang'];
        $tienmatvangct = $_POST['tienmatvang'];
        $ghichuvangct = $_POST['ghichuvang'];

        foreach($idctnxvang as $index => $idctvang) {         
            $cannangvh = str_replace(',','',trim($cannangvhct[$index]));
            $cannangh = str_replace(',','',trim($cannanghct[$index]));
            $tuoivang = str_replace(',','',trim($tuoivangct[$index]));
            if((int)$nhomnguyenlieuvangct[$index] > 0 && (int)$tennguyenlieuvangct[$index] > 0 && (int)$idloaivangct[$index] > 0) {
                $ctToa['idctnx'] = $idctnx;
                $ctToa['maphieu'] = $maphieu;
                $ctToa['nhomdm'] = $nhomdanhmuc['id'];
                $ctToa['nhomnguyenlieuvang'] = $nhomnguyenlieuvangct[$index];
                $ctToa['tennguyenlieuvang'] = $tennguyenlieuvangct[$index];
                $ctToa['idloaivang'] = $idloaivangct[$index];
                $ctToa['cannangvh'] = $cannangvh;
                $ctToa['cannangh'] = $cannangh;
                $ctToa['cannangv'] = $cannangvh - $cannangh;
                $ctToa['tuoivang'] = $tuoivang;
                $ctToa['tienmatvang'] = trim($tienmatvangct[$index]);
                $ctToa['ghichuvang'] = trim($ghichuvangct[$index]);
                $ctToa['type'] = 1;
                $ctToa['typevkc'] = 1;
                if($idctvang > 0) {
                    vaUpdate('khonguonvao_khoachinct',$ctToa, "id = $idctvang");
                } else {
                    $ctToa['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
                    $ctToa['time'] = $timeNow;
                    $ctToa['dated'] = $dateNow;
                    vaInsert('khonguonvao_khoachinct', $ctToa);
                }
            } else {
                if($idctvang > 0) {
                    vaDelete('khonguonvao_khoachinct', "id = $idctvang");
                }
            }
        }
        $idctnxkimcuong = $_POST['idctnxkimcuong'];
        $nhomnguyenlieukimcuong = $_POST['nhomnguyenlieukimcuong'];
        $tennguyenlieukimcuong = $_POST['tennguyenlieukimcuong'];
        $idkimcuong = $_POST['idkimcuong'];
        $codegdpnj = $_POST['codegdpnj'];
        $codecgta = $_POST['codecgta'];
        $kichthuoc = $_POST['kichthuoc'];
        $trongluonghot = $_POST['trongluonghot'];
        $dotinhkhiet = $_POST['dotinhkhiet'];
        $capdomau = $_POST['capdomau'];
        $domaibong = $_POST['domaibong'];
        $kichthuocban = $_POST['kichthuocban'];
        $tienmatkimcuong = $_POST['tienmatkimcuong'];
        $dongiaban = $_POST['dongiaban'];
        foreach($idctnxkimcuong as $index => $idctKimCuong) {
            $ctToaKC = [];
            if(trim($nhomnguyenlieukimcuong[$index]) > 0 && trim($tennguyenlieukimcuong[$index]) > 0 && trim($idkimcuong[$index]) > 0){
                $ctToaKC['nhomnguyenlieukimcuong'] = trim($tennguyenlieukimcuong[$index]);
                $ctToaKC['tennguyenlieukimcuong'] = trim($tennguyenlieukimcuong[$index]);
                $ctToaKC['idkimcuong'] = trim($idkimcuong[$index]);
                $ctToaKC['codegdpnj'] = trim($codegdpnj[$index]);
                $ctToaKC['codecgta'] = trim($codecgta[$index]);
                $ctToaKC['kichthuoc'] = trim($kichthuoc[$index]);
                $ctToaKC['trongluonghot'] = trim($trongluonghot[$index]);
                $ctToaKC['dotinhkhiet'] = trim($dotinhkhiet[$index]);
                $ctToaKC['capdomau'] = trim($capdomau[$index]);
                $ctToaKC['domaibong'] = trim($domaibong[$index]);
                $ctToaKC['kichthuocban'] = trim($kichthuocban[$index]);
                $ctToaKC['tienmatkimcuong'] = trim($tienmatkimcuong[$index]);
                $ctToaKC['dongiaban'] = trim($dongiaban[$index]);
                if($idctKimCuong > 0) {
                    vaUpdate('khonguonvao_khoachinct', $ctToaKC, $idctKimCuong);
                } else {
                    $ctToaKC['maphieu'] = $maphieu;
                    $ctToaKC['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
                    $ctToaKC['idctnx'] =  $idctnx;
                    $ctToaKC['nhomdm'] =  $nhomdanhmuc['id'];
                    $ctToaKC['time'] = $timeNow;
                    $ctToaKC['dated'] = $dateNow;
                    $ctToaKC['type'] = 1;
                    $ctToaKC['typevkc'] = 2;

                    vaInsert('khonguonvao_khoachinct', $ctToaKC);
                }
            } else {
                vaDelete('khonguonvao_khoachinct', 'id='.$idctKimCuong);
            }
        }

        $GLOBALS["sp"]->CommitTrans();
    } catch (Exception $e) {
        $GLOBALS["sp"]->RollbackTrans();
		die($e);
    }
}

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