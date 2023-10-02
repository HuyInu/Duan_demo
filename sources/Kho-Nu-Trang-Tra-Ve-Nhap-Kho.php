<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';
$smarty->assign("phongbanchuyen",$idpem);

switch ($act) {
    case 'view':
        $idPhieuSelectedArray = $_GET['phieuid'];
        $whereIdSql = implode(',',$idPhieuSelectedArray);
        $sql = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where id in ($whereIdSql)";
        $phieuNhap = $GLOBALS['sp']->getAll($sql);
        $smarty->assign("view",$phieuNhap);
        $template = 'Kho-Nu-Trang-Tra-Ve-Nhap-Kho/view.tpl';
        break;
    case 'exportexcel':
        require_once("../Classes-PHPExcel/PHPExcel.php");
        $objPHPExcel = new PHPExcel();
        include_once("search/Kho-Nu-Trang-Tra-Ve-Ct-Search.php");
        $tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"";
        $dateNow = date('Y-m-d');
        $timeNow = date('H:i:s');
        $whereSort = $wh;
        if (!empty($fromDate) && !empty($toDate)) {
            $whereSort .= " and datedimport >= '$fromDate' and datedimport <= '$toDate'";
        }
        $sqlTypeWhere = "type in (0, 1)";
        switch($tab) {
            case 'insertedShow':
                $sqlTypeWhere = "type = 1";
                break;
            case 'uninsertShow':
                $sqlTypeWhere = "type = 0";
                break;
        }
        $sql = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where typeimport = 1 and (phongban = $idpem or phongbanchuyen = $idpem) and $sqlTypeWhere $whereSort order by datednhap desc, timenhap desc";
        $phieuCt = $GLOBALS["sp"]->getAll($sql);
        $sqlCount = "select count(*) from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where typeimport = 1 and (phongban = $idpem or phongbanchuyen = $idpem) and $sqlTypeWhere $whereSort order by datednhap desc, timenhap desc";
        $row_last = $GLOBALS["sp"]->getOne($sqlCount);

        $objPHPExcel->setActiveSheetIndex(0);
		$sheet = $objPHPExcel->getActiveSheet();
        $titleExcle = 'KHONUTRANGTRAVE-NHAPKHO-'.$datenow;
		$setTitle = 'KHO NU TRANG';
		$title = 'KHO NỮ TRANG NHẬP KHO';
		$strdate = 'Ngày in: '.date("d/m/Y",strtotime($datenow)).' Giờ in: '.$timenow;
        $objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle($setTitle);
        $BStyle = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);
		$ColorStyle = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'bab8b8')
			)  
		);
        $arrCell = [
			['STT',5,'center'],
            ['MÃ PHIẾU IMPORT', 20]
        ];

        $column = 'A';
		$row_last = $row_last + 4; // + 3 ROW TIÊU ĐỀ + 1 ROW TỔNG
		foreach($arrCell as $key => $value){
			$sheet->getColumnDimension($column)->setWidth($value[1]);
			$sheet->setCellValue($column.'3', $value[0]);
			if($value[2] == 'right')
				$sheet->getStyle($column.'4:'.$column.$row_last)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			else if($value[2] == 'center')
				$sheet->getStyle($column.'4:'.$column.$row_last)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			else
				$sheet->getStyle($column.'4:'.$column.$row_last)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$col_last = $column;
			$column++;
		}

        $sheet->getDefaultRowDimension()->setRowHeight(25);
        $sheet->mergeCells('A1:'.$col_last.'1');
		$sheet->mergeCells('A2:'.$col_last.'2');
        $sheet->getDefaultRowDimension()->setRowHeight(25);
		$sheet->mergeCells('A1:'.$col_last.'1');
		$sheet->mergeCells('A2:'.$col_last.'2');
		$sheet->getStyle('A1')->getFont()->setSize(16);
		$sheet->getStyle('A1:'.$col_last.$row_last)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle('A1:'.$col_last.'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A1:'.$col_last.'3')->getFont()->setBold(true);
		$sheet->getStyle('A'.$row_last.':'.$col_last.$row_last)->getFont()->setBold(true);
		$sheet->setCellValue('A1', $title);
		$sheet->setCellValue('A2', $strdate);
		$sheet->getStyle('A3:'.$col_last.'3')->applyFromArray($ColorStyle);
		$sheet->getStyle('A3:'.$col_last.'3')->getAlignment()->setWrapText(true);
		$sheet->getStyle('A3:'.$col_last.$row_last)->applyFromArray($BStyle);

        $numRow = 4;
        foreach($phieuCt as $index => $phieu) {
            $arr_body = [];
            $arr_body[] = $index + 1;
            $arr_body[] = $phieu['maphieuimport'];
            $sheet->fromArray($arr_body, NULL, 'A'.$numRow);
        }

        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
        die();
        break;
    default:
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url."/sources/main.php";
            page_transfer2($page);
        } else {
            include_once("search/Kho-Nu-Trang-Tra-Ve-Ct-Search.php");
            $whereSort = $wh;
            if (!empty($fromDate) && !empty($toDate)) {
                $whereSort .= " and datedimport >= '$fromDate' and datedimport <= '$toDate'";
            }
            $sqlTypeWhere = "type in (0, 1)";
            switch($act) {
                case 'insertedShow':
                    $sqlTypeWhere = "type = 1";
                    break;
                case 'uninsertShow':
                    $sqlTypeWhere = "type = 0";
                    break;
            }
            $sqlTong = "select sum(slmon) as tongallslmon,
                sum(Round(cannangvh, 3)) as tongallcannangvh,
                sum(Round(cannangh, 3)) as tongallcannangh,
                sum(Round(cannangv, 3)) as tongallcannangv,
                sum(tienh) as tongalltienh,
                sum(tiencong) as tongalltiencong,
                sum(tiendangoctrai) as tongalltiendangoctrai from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where typeimport = 1 and (phongban = $idpem or phongbanchuyen = $idpem) and $sqlTypeWhere $whereSort";
            $tongAll = $GLOBALS['sp']->getRow($sqlTong);
            $smarty->assign("tongAll",$tongAll);
            $sql = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where typeimport = 1 and (phongban = $idpem or phongbanchuyen = $idpem) and $sqlTypeWhere $whereSort order by datednhap desc, timenhap desc";
            $sql_sum = "select count(*) from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where typeimport = 1 and (phongban = $idpem or phongbanchuyen = $idpem) and $sqlTypeWhere $whereSort";
            $total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
            $num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = $path_url."/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?cid=".$idpem;
			$link_url = "";

            if($num_page > 1 ) {
                $link_url = paginator($num_page,$page,$iSEGSIZE,$url,$strSearch);
            }
			$sql = $sql." limit $begin,$num_rows_page";
			$rs = $GLOBALS["sp"]->getAll($sql);
			if($page!=1)
            {
                $number=$num_rows_page * ($page-1);
                $smarty->assign("number",$number);
            }
            $smarty->assign("total",$num_page);
			$smarty->assign("link_url",$link_url);
            $smarty->assign("view",$rs);
            if(checkPermision($idpem,2))
				$smarty->assign("checkPer2","true");
            if(checkPermision($idpem,3))
				$smarty->assign("checkPer3","true");
            if(checkPermision($idpem,7))
				$smarty->assign("checkPer7","true");
            if(checkPermision($idpem,8))
				$smarty->assign("checkPer8","true");

            $template = 'Kho-Nu-Trang-Tra-Ve-Nhap-Kho/list.tpl';
        }
        break;
}
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>