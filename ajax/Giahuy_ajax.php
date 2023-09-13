<?php
    include_once("../maininclude.php");

    $act = (isset($_POST['act']))? $_POST['act'] : '';
    require_once '../Classes-PHPExcel/PHPExcel.php';
    
    switch($act) {
        case 'import':
            if (isset($_FILES['file'])) {
                try {
                    $show = [];
                    $phieuNhap = [];
                    $chiTietNhapVang = [];
                    $chiTietNhapKc = [];
                    $phieuNhapKey = [
                        'nguoilapphieu', 
                        'donvilapphieu', 
                        'nguoiduyetphieu',
                        'donviduyetphieu',
                        'lydo'
                    ];
                    $chiTietNhapVangKey = [
                        'nhomnguyenlieuvang', 
                        'tennguyenlieuvang',
                        'idloaivang',
                        'cannangvh',
                        'cannangh',
                        'cannangv',
                        'tuoivang',
                        'tienmatvang',
                        'ghichu'
                    ];
                    $chiTietNhapKcKey = [
                        'nhomnguyenlieukimcuong',
                        'tennguyenlieukimcuong',
                        'idkimcuong',
                        'codegdpnj',
                        'codecgta',
                        'kichthuoc',
                        'trongluonghot',
                        'dotinhkhiet',
                        'capdomau',
                        'domaibong',
                        'kichthuocban',
                        'tienmatkimcuong',
                        'dongiaban'
                    ];
                    $file = $_FILES['file'];
                    $objFile  = PHPExcel_IOFactory::createReader('Excel2007');
                    $objPHPExcel = $objFile->load($file['tmp_name']);
                    $sheet = $objPHPExcel->setActiveSheetIndex(0);
                    for ($i = 0; $i < 5; $i++) {
                        $colName = $phieuNhapKey[$i];
                        $phieuNhap[$colName] = $sheet->getCellByColumnAndRow($i,2)->getValue();
                    }
                    $lastRow = $sheet->getHighestRow();
                    for ($i = 4; $i <= $lastRow; $i++) {
                        for ($j = 0; $j < 22; $j++) {
                            $colValue = $sheet->getCellByColumnAndRow($j,$i)->getCalculatedValue();
                            if ($colValue != null) {
                                if ($j < 9) {
                                    $colName = $chiTietNhapVangKey[$j];
                                    $chiTietNhapVang[$i-4][$colName] = $colValue;
                                } else {
                                    $colName = $chiTietNhapKcKey[$j-9];
                                    $chiTietNhapKc[$i-4][$colName] = $colValue;
                                }
                            }
                        }
                    }
                    //AddsmImportExcel($phieuNhapKey, $chiTietNhapVangKey, $chiTietNhapKcKey);
                    echo json_encode($chiTietNhapVang);
                } catch (Exception $e) {
                    echo json_encode($e);
                }
            }
        break;
        default:
        echo json_encode(1);
    }
?>