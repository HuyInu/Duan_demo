<?php
include("../#include/config.php");
include("../functions/function.php");
include("../functions/functionVu.php");//Vũ thêm 28-11-19
include("../functions/functionNhom.php");//Anh Vũ Thêm
$error = 'success';

$act = isset($_POST['act']) ? $_POST['act'] : '';
$idCategNhan = isset($_POST['cid']) ? $_POST['cid'] : '';
$idCategChuyen = isset($_POST['phongbanchuyen']) ? $_POST['phongbanchuyen'] : '';
$idPhieu = isset($_POST['id']) ? $_POST['id'] : '';
$typeKhoDau = isset($_POST['typeKho']) ? $_POST['typeKho'] : '';
$typeKho = isset($_POST['type']) ? $_POST['type'] : '';

$timeNow = date('H:i:s');
$dateNow = date('Y-m-d');
switch($act) {
    case 'chuyenkhokhac':
        $GLOBALS["sp"]->BeginTrans();
		try{
            $sqlCatogChuyen = "select * from $GLOBALS[db_sp].categories where id=$idCategChuyen";
            $CategChuyen = $GLOBALS['sp']->getRow($sqlCatogChuyen);
            $tableChuyen = $CategChuyen['tablect'];

            $sqlCategNhan = "select * from $GLOBALS[db_sp].categories where id=$idCategNhan";
            $CategNhan = $GLOBALS['sp']->getRow($sqlCategNhan);
            $tableNhan = $CategNhan['tablect'];

            $sqlPhieuXuat = "select * from $GLOBALS[db_sp].$tableChuyen where id=$idPhieu";
            $phieuXuat = $GLOBALS['sp']->getRow($sqlPhieuXuat);

            $typeKho = explode('_', $typeKhoDau)[0];

            $phieuNhapMoi = [];
            $phieuNhapMoi['mid'] = $phieuXuat['mid'];
            $phieuNhapMoi['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
            $phieuNhapMoi['cid'] = $idCategNhan;
            $phieuNhapMoi['cidchuyen'] = $idCategChuyen;
            $phieuNhapMoi['typekhodau'] = $typeKhoDau;
            $phieuNhapMoi['typekho'] = $typeKho;
            $phieuNhapMoi['idmaphieukho'] = $idPhieu;
            $phieuNhapMoi['idctnx'] = $phieuXuat['idctnx'];
            $phieuNhapMoi['maphieu'] = $phieuXuat['maphieu'];
            $phieuNhapMoi['nhomdm'] = $phieuXuat['nhomdm'];
            $phieuNhapMoi['nhomnguyenlieuvang'] = $phieuXuat['nhomnguyenlieuvang'];
            $phieuNhapMoi['tennguyenlieuvang'] = $phieuXuat['tennguyenlieuvang'];
            $phieuNhapMoi['idloaivang'] = $phieuXuat['idloaivang'];
            $phieuNhapMoi['cannangvh'] = ($phieuXuat['cannangvh'] + $phieuXuat['du']) - $phieuXuat['hao'];
            $phieuNhapMoi['cannangv'] = ($phieuXuat['cannangv'] + $phieuXuat['du']) - $phieuXuat['hao'];
            $phieuNhapMoi['cannangh'] = $phieuXuat['cannangh'];
            $phieuNhapMoi['tuoivang'] = $phieuXuat['tuoivang'];
            $phieuNhapMoi['tienmatvang'] = $phieuXuat['tienmatvang'];
            $phieuNhapMoi['ghichuvang'] = $phieuXuat['ghichuvang'];
            $phieuNhapMoi['haochuyen'] = $phieuXuat['hao'];
            $phieuNhapMoi['duchuyen'] = $phieuXuat['du'];
            $phieuNhapMoi['ghichu'] = $phieuXuat['ghichu'];
            $phieuNhapMoi['type'] = 1;
            $phieuNhapMoi['typechuyen'] = 1;
            $phieuNhapMoi['typevkc'] = 1;
            $phieuNhapMoi['time'] = $timeNow;
            $phieuNhapMoi['dated'] = $dateNow;
            $phieuNhapMoi['phongbanchuyen'] = $idCategChuyen;
            $phieuNhapMoi['timechuyen'] = $timeNow;
            $phieuNhapMoi['datechuyen'] = $dateNow;
            $phieuNhapMoi['trangthai'] = 0;

            vaInsert($tableNhan, $phieuNhapMoi);

            $phieuXuatUpdate = [];
            $phieuXuatUpdate['phongban'] = $idCategNhan;
            $phieuXuatUpdate['timechuyen'] = $timeNow;
            $phieuXuatUpdate['datechuyen'] = $dateNow;
            $phieuXuatUpdate['trangthai'] = 1;

            vaUpdate($tableChuyen, $phieuXuatUpdate, "id=".$phieuXuat['id']);

            $GLOBALS["sp"]->CommitTrans();
        }catch(Exception $e) {
            $GLOBALS["sp"]->RollbackTrans();
            $error = $errorTransetion;
        }
    break;
    case 'tralaichuyenKhoSanXuat':
        $GLOBALS["sp"]->BeginTrans();
		try{
            $sqlCategNhan = "select * from $GLOBALS[db_sp].categories where id=$idCategNhan";
            $CategNhan = $GLOBALS['sp']->getRow($sqlCategNhan);
            $tableNhan = $CategNhan['tablect'];

            $sqlPhieuNhap = "select * from $GLOBALS[db_sp].$tableNhan where id=$idPhieu";
            $phieuNhap = $GLOBALS['sp']->getRow($sqlPhieuNhap);

            $sqlCategChuyen = "select * from $GLOBALS[db_sp].categories where id=".$phieuNhap['phongbanchuyen'];
            $CategChuyen = $GLOBALS['sp']->getRow($sqlCategChuyen);
            $tableChuyen =$CategChuyen['tablect'];

            $phieuXuatUpdate = [];
            $phieuXuatUpdate['trangthai'] = 0;
            $phieuXuatUpdate['tralai'] = 1;

            vaDelete($tableNhan, 'id='.$phieuNhap['id']);
            vaUpdate($tableChuyen, $phieuXuatUpdate, 'id='.$phieuNhap['idmaphieukho']);

            $GLOBALS["sp"]->CommitTrans();
        }catch(Exception $e) {
            $GLOBALS["sp"]->RollbackTrans();
            $error = $errorTransetion;
        }
    break;
    case 'xacnhanchuyenKhoSanXuat':
        $GLOBALS["sp"]->BeginTrans();
		try{
            $sqlCategNhan = "select * from $GLOBALS[db_sp].categories where id=$idCategNhan";
            $CategNhan = $GLOBALS['sp']->getRow($sqlCategNhan);
            $tableNhan = $CategNhan['tablect'];
            $tableHachToanNhan = $CategNhan['tablehachtoan'];

            $sqlPhieuNhan = "select * from $GLOBALS[db_sp].$tableNhan where id=$idPhieu";
            $phieuNhap = $GLOBALS['sp']->getRow($sqlPhieuNhan);

            $sqlCategChuyen = "select * from $GLOBALS[db_sp].categories where id=".$phieuNhap['phongbanchuyen'];
            $CategChuyen = $GLOBALS['sp']->getRow($sqlCategChuyen);
            $tableChuyen = $CategChuyen['tablect'];
            $tableHachToanChuyen = $CategChuyen['tablehachtoan'];

            if(!empty($tableHachToanNhan) && !empty($tableChuyen) && !empty($tableNhan)){
                $idPhieuNhap = $phieuNhap['id'];
                $idMaPhieuKho = $phieuNhap['idmaphieukho'];

                $phieuXuatUpdate = [];
                $phieuNhapUpdate = [];
                
                $phieuXuatUpdate['timexuat'] = $timeNow;
                $phieuXuatUpdate['datedxuat'] = $dateNow;
                $phieuXuatUpdate['phongban'] = $idCategNhan;
                $phieuXuatUpdate['trangthai'] = 2;
                vaUpdate($tableChuyen, $phieuXuatUpdate, 'id='.$idMaPhieuKho);

                $phieuNhapUpdate['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
                $phieuNhapUpdate['time'] = $timeNow;
                $phieuNhapUpdate['dated'] = $dateNow;
                $phieuNhapUpdate['timechuyen'] = $timeNow;
                $phieuNhapUpdate['datechuyen'] = $dateNow;
                $phieuNhapUpdate['typechuyen'] = 2;
                vaUpdate($tableNhan, $phieuNhapUpdate, 'id='.$idPhieuNhap);

                ghiSoHachToan($tableHachToanChuyen, $tableChuyen, $idMaPhieuKho, 'xuatkho');
                giahuy_ghiSoHachToanKhoSanXuat($tableHachToanNhan, $tableNhan, $idPhieuNhap);
            } else {
				$error = 'Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.';	
			}

            $GLOBALS["sp"]->CommitTrans();
        } catch(Exception $e) {
            $GLOBALS["sp"]->RollbackTrans();
            $error = $errorTransetion;
        }
    break;
}

die(json_encode(array('status'=>$error,'name'=>$name,'soducon'=>$soducon)));
?>