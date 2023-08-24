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

            $sqlCheckExisted = "select count(*) from $GLOBALS[db_sp].$tableChuyen where id=$idPhieu and trangthai = 1";
            $checkExisted = $GLOBALS['sp']->getOne($sqlCheckExisted);
            if($checkExisted <= 0) {
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
            } else {
                $error = "Phiếu đã được chuyển.";
            }

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

            $sqlCheckExisted = "select * from $GLOBALS[db_sp].$tableNhan where id=$idPhieu";
            $checkExisted = $GLOBALS['sp']->getRow($sqlCheckExisted);
            if(!empty($checkExisted['typechuyen']) && $checkExisted['typechuyen'] == 1) {
                $sqlCategChuyen = "select * from $GLOBALS[db_sp].categories where id=".$phieuNhap['phongbanchuyen'];
                $CategChuyen = $GLOBALS['sp']->getRow($sqlCategChuyen);
                $tableChuyen =$CategChuyen['tablect'];
            
                $phieuXuatUpdate = [];
                $phieuXuatUpdate['phongban'] = $phieuNhap['phongbanchuyen'];
                $phieuXuatUpdate['trangthai'] = 0;
                $phieuXuatUpdate['tralai'] = 1;

                vaDelete($tableNhan, 'id='.$phieuNhap['id']);
                vaUpdate($tableChuyen, $phieuXuatUpdate, 'id='.$phieuNhap['idmaphieukho']);
            } else if (!empty($checkExisted['typechuyen']) && $checkExisted['typechuyen'] != 1) {
                $error = "Phiếu đã được xác nhận nhập.";
            }
            else {
                $error = "Phiếu đã được trả lại.";
            } 

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

            $sqlCheckExisted = "select * from $GLOBALS[db_sp].$tableNhan where id=$idPhieu";
            $checkExisted = $GLOBALS['sp']->getRow($sqlCheckExisted);
            if(!empty($checkExisted['typechuyen']) && $checkExisted['typechuyen'] != 2) {

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
            } else if(!empty($checkExisted['typechuyen']) && $checkExisted['typechuyen'] == 2) {
                $error = 'Phiếu đã được xác nhận nhập.';
            } else {
                $error = "Phiếu đã được trả lại.";	
            }

            $GLOBALS["sp"]->CommitTrans();
        } catch(Exception $e) {
            $GLOBALS["sp"]->RollbackTrans();
            $error = $errorTransetion;
        }
    break;
    case 'chuyenkhosanxuat':
        $GLOBALS["sp"]->BeginTrans();
        try{
            $sqlCategChuyen = "select * from $GLOBALS[db_sp].categories where id=".$idCategChuyen;
            $categChuyen = $GLOBALS['sp']->getRow($sqlCategChuyen);
            $tableChuyen = $categChuyen['tablect'];
            $tableHachToanChuyen = $categChuyen['tablehachtoan'];

            $sqlTableNhan = "select * from $GLOBALS[db_sp].categories where id=".$idCategNhan;
            $categNhan = $GLOBALS['sp']->getRow($sqlTableNhan);
            $tableNhan = $categNhan['tablect'];
            $tableHachToanNhan = $categNhan['tablehachtoan'];

            $sqlPhieuXuat = "select * from $GLOBALS[db_sp].$tableChuyen where id=$idPhieu";
            $phieuXuat = $GLOBALS['sp']->getRow($sqlPhieuXuat);

            $phieuNhapMoi = [];
            $sqlcount = "select * from $GLOBALS[db_sp].$tableNhan where maphieu='".$phieuXuat['maphieu']."' and cidchuyen=".$idCategChuyen;
            $count = ceil(count($GLOBALS['sp']->getAll($sqlcount)));
        
            if($count == 0) {
                if(!empty($typeKhoDau)){   
                    $phieuNhapMoi['typekho'] = explode('_',$typeKhoDau)[0];
                }
                $phieuNhapMoi['typekhodau'] = $typeKhoDau;
                $phieuNhapMoi['slcannangvcon'] = 0;
                $phieuNhapMoi['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
                $phieuNhapMoi['cidchuyen'] = $idCategChuyen;
                $phieuNhapMoi['idmaphieukho'] = $phieuXuat['idmaphieukho'];
                $phieuNhapMoi['ghichuvang'] = $phieuXuat['ghichuvang'];
                $phieuNhapMoi['ghichu'] = $phieuXuat['ghichu'];
                $phieuNhapMoi['typechuyen'] = 1;
                $phieuNhapMoi['tuoivang'] = $phieuXuat['tuoivang'];
                $phieuNhapMoi['phongban'] = $idCategNhan;
                $phieuNhapMoi['idpnk'] = $phieuXuat['idpnk'];
                $phieuNhapMoi['madhin'] = $phieuXuat['madhin'];
                $phieuNhapMoi['chonphongbanin'] = $phieuXuat['chonphongbanin'];
            //$phieuNhapMoi['idphukien'] = $phieuXuat['idphukien'];
                //$phieuNhapMoi['soluongphukien'] = $phieuXuat['soluongphukien'];
                $phieuNhapMoi['cid'] = $idCategNhan;
                $phieuNhapMoi['maphieu'] = $phieuXuat['maphieu'];
                $phieuNhapMoi['idloaivang'] = $phieuXuat['idloaivang'];
                $phieuNhapMoi['type'] = 1;
                $phieuNhapMoi['dated'] = $dateNow;
                $phieuNhapMoi['time'] = $timeNow;
                $phieuNhapMoi['phongbanchuyen'] = $idCategChuyen;
                $phieuNhapMoi['datedchuyen'] = $dateNow;
                $phieuNhapMoi['timechuyen'] = $timeNow;
                $phieuNhapMoi['trangthai'] = 0;
                $phieuNhapMoi['mid'] = $phieuXuat['mid'];;
                $phieuNhapMoi['cannangvh'] = $phieuXuat['cannangvh'];
                $phieuNhapMoi['cannangh'] = $phieuXuat['cannangh'];
                $phieuNhapMoi['cannangv'] = $phieuXuat['cannangv'];
                $phieuNhapMoi['typevkc'] = $phieuXuat['typevkc'];
                $phieuNhapMoi['typevkc'] = $phieuXuat['typevkc'];

                //vaInsert($tableNhan,$phieuNhapMoi);

                $phieuXuatUpdate = [];
                $phieuXuatUpdate['trangthai'] = 1;
                $phieuXuatUpdate['datechuyen'] = $dateNow;
                $phieuXuatUpdate['timechuyen'] = $timeNow;
                $phieuXuatUpdate['type'] = $timeNow;
                $phieuXuatUpdate['phongban'] = $idCategNhan;

                vaUpdate($tableChuyen, $phieuNhapUpdate, 'id='.$phieuXuat['id']);
            }
            $GLOBALS["sp"]->CommitTrans();
        }catch(Exception $e) {
            $GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
        }
    break;
}

die(json_encode(array('status'=>$error,'name'=>$name,'soducon'=>$soducon)));
?>