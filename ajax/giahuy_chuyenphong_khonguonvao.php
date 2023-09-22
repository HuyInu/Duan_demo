<?php
include("../#include/config.php");
include("../functions/function.php");
CheckLogin();
global $path_url,$path_dir;
date_default_timezone_set("Asia/Ho_Chi_Minh");

if(!isset($_SESSION["store_qlsxntjcorg_login"])){
	die('Vui long dang nhap lai');	
}

$dateNow = date('Y-m-d');
$timeNow = date('H:i:s');
$act = isset($_POST['act']) ? $_POST['act'] : '';
$idPhieuChon = isset($_POST['id']) ? $_POST['id'] : '';
$phongban= isset($_POST['phongban']) ? $_POST['phongban'] : '';
$phongbanchuyen = $cid = isset($_POST['phongbanchuyen']) ? $_POST['phongbanchuyen'] : '';
$macode = isset($_POST['maphieu'])?$_POST['maphieu']:"";

$error = 'success';
switch($act) {
    case 'TaoPhieuXuatKho':
        $GLOBALS["sp"]->BeginTrans();
        try {
            $sqltc = "select * from $GLOBALS[db_sp].categories where id = '$cid'";
            $rstc = $GLOBALS['sp']->getRow($sqltc);
            $table = $rstc['table'];
            $tablect = $rstc['tablect'];
            $tablehachtoan = $rstc['tablehachtoan'];
            
            $ctToaList = getTableAll($tablect,' and idctnx='.$idPhieuChon.' order by id asc');
            if(count($ctToaList) > 0 ) {
                $sqlCheckExisted = "select count(*) from $GLOBALS[db_sp].$table where id=$idPhieuChon and type = 3";
                $checkExisted = $GLOBALS['sp']->getOne($sqlCheckExisted);
                if($checkExisted <=0 ) {
                    $toa = [];
                    $toa['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
                    $toa['phongban'] = $phongban;
                    $toa['phongbanchuyen'] =  $phongbanchuyen;
                    $toa['datechuyen'] = $dateNow;
                    $toa['timechuyen'] = $timeNow;
                    $toa['type'] = 3;
                    vaUpdate($table, $toa, "id = $idPhieuChon");

                    $ctToa = [];
                    foreach($ctToaList as $item) {
                        $sqlmpt = "select max(numphieu)+1 from $GLOBALS[db_sp].".$tablect."";                 
                        $rsmpt = $GLOBALS['sp']->getone($sqlmpt);
                        if($rsmpt <= 0)
                            $rsmpt = 1;	
                        $maso = convertMaso($rsmpt);

                        $ctToa['idctnx'] = $item['idctnx'];
                        $ctToa['idct'] = $item['id'];
                        $ctToa['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
                        $ctToa['numphieu'] = $maso;
                        $ctToa['maphieu'] = $macode.$maso;
                        $ctToa['nhomdm'] = $item['nhomdm'];

                        $ctToa['nhomnguyenlieuvang'] = $item['nhomnguyenlieuvang'];
                        $ctToa['tennguyenlieuvang'] = $item['tennguyenlieuvang'];
                        $ctToa['idloaivang'] = $item['idloaivang'];
                        $ctToa['cannangvh'] = $item['cannangvh'];
                        $ctToa['cannangh'] = $item['cannangh'];
                        $ctToa['cannangv'] = $item['cannangv'];
                        $ctToa['tuoivang'] = $item['tuoivang'];
                        $ctToa['tienmatvang'] = $item['tienmatvang'];
                        $ctToa['ghichuvang'] = $item['ghichuvang'];

                        $ctToa['nhomnguyenlieukimcuong'] = $item['nhomnguyenlieukimcuong'];
						$ctToa['tennguyenlieukimcuong'] = $item['tennguyenlieukimcuong'];
						$ctToa['idkimcuong'] = $item['idkimcuong'];
						$ctToa['codegdpnj'] = $item['codegdpnj'];
						$ctToa['codecgta'] = $item['codecgta'];
						$ctToa['kichthuoc'] = $item['kichthuoc'];
						$ctToa['trongluonghot'] = $item['trongluonghot'];
						$ctToa['dotinhkhiet'] = $item['dotinhkhiet'];
						$ctToa['capdomau'] = $item['capdomau'];
						$ctToa['domaibong'] = $item['domaibong'];
						$ctToa['kichthuocban'] = $item['kichthuocban'];
						$ctToa['tienmatkimcuong'] = $item['tienmatkimcuong'];
						$ctToa['dongiaban'] = $item['dongiaban'];

                        $ctToa['type'] = 2;
                        $ctToa['typevkc'] = $item['typevkc'];
                        $ctToa['time'] = $timeNow;
                        $ctToa['dated'] = $dateNow;

                        vaInsert($tablect, $ctToa);
                        giahuy_ghiSoHachToan($tablehachtoan, $tablect, $item['id'], '');
                    }
                } else {
                    $error = 'Toa hàng này đã được nhâp.';	
                }
            } else {
                $error = 'Toa hàng này chưa có nhập dữ liệu Vàng hoặc Kim Cương.';	
            }
            $GLOBALS["sp"]->CommitTrans();
        } catch(Exception $e) {
            $GLOBALS["sp"]->RollbackTrans();
            $error = $e;
        }
    break;
    case 'duyetchuyenimport':
        $GLOBALS["sp"]->BeginTrans();
        try {
            $phieuUpdate = [];
            $phieuCtUpdate = [];
            $phieuUpdate['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
            $phieuUpdate['phongbanchuyen'] = $phongbanchuyen;
            $phieuUpdate['phongban'] = $phongban;
            $phieuUpdate['datedchuyen'] = $dateNow;
            $phieuUpdate['timechuyen'] = $timeNow;
            $phieuUpdate['typeimport'] = 1;
            vaUpdate('khonguonvao_khonutrangtrave', $phieuUpdate, "id = $idPhieuChon");

            $phieuCtUpdate['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
            $phieuCtUpdate['phongbanchuyen'] = $phongbanchuyen;
            $phieuCtUpdate['datedchuyen'] = $dateNow;
            $phieuCtUpdate['timechuyen'] = $timeNow;
            $phieuCtUpdate['phongban'] = $phongban;
            $phieuCtUpdate['typeimport'] = 1;
            vaUpdate('khonguonvao_khonutrangtravect', $phieuCtUpdate, "idctnx = $idPhieuChon");
            
            $GLOBALS["sp"]->CommitTrans();
        } catch (Exception $e) {
            $GLOBALS["sp"]->RollbackTrans();
            $error = $e;
        }
    break;
    case 'nhapkhonutrangtrave':
        $GLOBALS["sp"]->BeginTrans();
        try { 
            $sqlCateg = "select * from $GLOBALS[db_sp].categories where id=$cid";
            $categ = $GLOBALS['sp']->getRow($sqlCateg);
            $tableCt = $categ['tablect'];
            $tablehachtoan = $categ['tablehachtoan'];

            $phieuCtUpdate = [];
            $phieuCtUpdate['midnhap'] = $_SESSION['admin_qlsxntjcorg_id'];
            $phieuCtUpdate['phongbanchuyen'] = $phongbanchuyen;
            $phieuCtUpdate['phongban'] = $phongban;
            $phieuCtUpdate['datednhap'] = $dateNow;
            $phieuCtUpdate['timenhap'] = $timeNow;
            $phieuCtUpdate['type'] = 1;
            //vaUpdate('khonguonvao_khonutrangtravect', $phieuCtUpdate, "id = $idPhieuChon");
            giahuy_GhiHachToanKhoNuTrangTraVe ($tablehachtoan, $tableCt, $idPhieuChon);
            $GLOBALS["sp"]->CommitTrans();
        } catch (Exception $e) {
            $GLOBALS["sp"]->RollbackTrans();
            $error = $e;
        }
        break;
    }
die(json_encode(array('status'=>$error)));

?>