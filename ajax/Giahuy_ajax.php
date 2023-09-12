<?php
    include_once("../maininclude.php");
    $act = (isset($_POST['act']))? $_POST['act'] : '';
    require_once '../Classes-PHPExcel/PHPExcel.php';
    
    switch($act) {
        case 'import':
            if (isset($_FILES['file'])) {
                try {
                    $show = [];
                    $file = $_FILES['file'];
                    $objFile  = PHPExcel_IOFactory::createReader('Excel2007');
                    $objPHPExcel = $objFile->load($file['tmp_name']);
                    $sheet = $objPHPExcel->setActiveSheetIndex(0);
                    $lastCol = $sheet->getHighestColumn();
                    $totalCol = PHPExcel_Cell::columnIndexFromString($lastCol);
                    for ($i = 1; $i <=$totalCol; $i++) {
                        $show[$i] = $sheet->getCell($i)->getValue();
                    }
                    echo json_encode($show);
                } catch (Exception $e) {
                    echo json_encode($e);
                }
            }
        break;
        default:
        echo json_encode(1);
    }
?>