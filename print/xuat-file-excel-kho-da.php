<?php
include_once("../#include/config.php");
//include_once("../functions/function.php");
//CheckLogin();
require_once '../Classes-PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$datenow = date("d-m-Y");

$year = date("Y");
$month = date("m");
$day = date("d");
$hour = date("h");
$hours = date("h");
$minutes = date("i");
$seconds = date("s");
$datenow = $day.'/'.$month.'/'.$year;
$dateExcel = $day.'-'.$month.'-'.$year;
$datehms = date("h:i:s A");
$tencongty = 'Công Ty TNHH VBĐQ Ngọc Thẫm';
$diachi = 'Địa chỉ: 25/2 Nguyễn Huỳnh Đức, P.8, TP. Mỹ Tho, Tiền Giang.';
$gioin = 'Giờ in: '.$datehms;
$thangnam = 'Tháng '.$month.'/'.$year;

$wh = $whdate = '';

$fromdays = trim($_GET['fromdays']);
$todays = trim($_GET['todays']);
if(!empty($fromdays)){
	$fromDate = explode('/',$fromdays);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
	$whdate.=' and dated >= "'.$fromDate.'"';
}
if(!empty($todays)){
	$toDate = explode('/',$todays);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
	$whdate.=' and dated <= "'.$toDate.'"';
}

$act = trim(isset($_REQUEST['act'])?$_REQUEST['act']:"");	
$type = trim(isset($_REQUEST['type'])?$_REQUEST['type']:"");
$table = isset($_REQUEST['table'])?$_REQUEST['table']:"";
$cid = isset($_REQUEST['cid'])?$_REQUEST['cid']:"";

switch($act){	
	case 'KhoTemHopNhapXuat':
		if($type == 'nhapkho' && !empty($type)){
			$wh.=' and type = 1';
			$titleExcle = $setTitle = 'Da-Tem-Hop-Thong-Ke-Nhap-Kho';
			$tieude = 'THỐNG KÊ NHẬP KHO TEM HỘP';
		}
		else{
			$wh.=' and type = 2';
			$titleExcle = $setTitle = 'Da-Tem-Hop-Thong-Ke-Xuat-Kho';
			$tieude = 'THỐNG KÊ XUẤT KHO TEM HỘP';
		}
		$sql_sum = "select count(id) from $GLOBALS[db_sp].da_temhop where trangthai = 2 $wh $whdate order by dated desc, id desc";	
		$total = ceil($GLOBALS['sp']->getOne($sql_sum));

		$num_rows_page = 1;
		$num_page = ceil($total/$num_rows_page);
		
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

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . (string)(3) . ':' . 'F' . (string)(3)); // xếp dòng
		$objPHPExcel->getActiveSheet()->mergeCells('F' . (string)(1) . ':' . 'F' . (string)(1));
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);			
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setSize(13); //Cỡ chữ
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true); //Tô đậm chữ
		$objPHPExcel->getActiveSheet()->getStyle('A1:F2')->getFont()->setItalic(true);
		$objPHPExcel->getActiveSheet()->getStyle("A1:F2")->getFont()->setSize(11);
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setSize(18);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setSize(11);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $tieude);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', $tencongty);
		$objPHPExcel->getActiveSheet()->setCellValue('A2', $diachi);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $thangnam);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', $gioin);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'NGÀY NHẬP');
		$objPHPExcel->getActiveSheet()->setCellValue('B4', 'SỐ CHỨNG TỪ');
		$objPHPExcel->getActiveSheet()->setCellValue('C4', 'SIZE TEM HỘP');
		$objPHPExcel->getActiveSheet()->setCellValue('D4', 'SỐ LƯỢNG');
		$objPHPExcel->getActiveSheet()->setCellValue('E4', 'ĐƠN GIÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('F4', 'THÀNH TIỀN');
		$objPHPExcel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:F4')->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true);
		cellColor('A4:F4', 'F0F8FF');
		$numRow = 5;
		$thanhtien = $tongsl = $tongst = 0;
		for($i=1; $i<=$num_page; $i++){
			
			$begin = ($i - 1)*$num_rows_page;
			$sql = "select * from $GLOBALS[db_sp].da_temhop where trangthai = 2 $wh $whdate order by dated desc, id desc limit $begin,$num_rows_page";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				if($numRow % 2 == 0) cellColor('A'.$numRow.':F'.$numRow, 'f2f2f2');

				$sqldm = "select dongia, size from $GLOBALS[db_sp].dm_temhop where id = ".$item['idtemhop'];
				$rsdm = $GLOBALS['sp']->getRow($sqldm);

				$thanhtien = round($rsdm['dongia'] * $item['soluong'],3);
				$tongsl = round($tongsl + $item['soluong'],3);
				$tongst = round($tongst + $thanhtien,3);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':C'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$numRow.':F'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':F'.$numRow)->applyFromArray($BStyle);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,date('d/m/Y',strtotime($item['dated'])));
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,$item['maphieu']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$rsdm['size']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,number_format($item["soluong"],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,number_format($rsdm['dongia'],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,number_format($thanhtien,3,".",","));
				$numRow++;
			}
		}
		//Phan cuoi bang
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':F'.$numRow)->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':F'.$numRow)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$numRow.':F'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		// $objPHPExcel->getActiveSheet()->mergeCells('D' . (string)($numRow+1) . ':' . 'F' . (string)($numRow+1));
		// $objPHPExcel->getActiveSheet()->mergeCells('D' . (string)($numRow+3) . ':' . 'F' . (string)($numRow+3));
		$objPHPExcel->getActiveSheet()->setCellValue('C'.($numRow),"Tổng tất cả:");
		$objPHPExcel->getActiveSheet()->setCellValue('D'.($numRow),number_format($tongsl,0,".",","));
		
		$objPHPExcel->getActiveSheet()->setCellValue('F'.($numRow),number_format($tongst,3,".",","));

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$day.'-'.$month.'-'.$year.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();
	break;

	case 'KhoTemGiayNhapXuat':
		if($type == 'nhapkho' && !empty($type)){
			$wh.=' and type = 1';
			$titleExcle = $setTitle = 'Da-Tem-Giay-Thong-Ke-Nhap-Kho';
			$tieude = 'THỐNG KÊ NHẬP KHO TEM GIẤY';
		}
		else{
			$wh.=' and type = 2';
			$titleExcle = $setTitle = 'Da-Tem-Giay-Thong-Ke-Xuat-Kho';
			$tieude = 'THỐNG KÊ XUẤT KHO TEM GIẤY';
		}
		$sql_sum = "select count(id) from $GLOBALS[db_sp].da_temgiay where trangthai = 2 $wh $whdate order by dated desc, id desc";	
		$total = ceil($GLOBALS['sp']->getOne($sql_sum));

		$num_rows_page = 1;
		$num_page = ceil($total/$num_rows_page);

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

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . (string)(3) . ':' . 'G' . (string)(3)); // xếp dòng
		$objPHPExcel->getActiveSheet()->mergeCells('F' . (string)(1) . ':' . 'G' . (string)(1));	
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);			
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setSize(13); //Cỡ chữ
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true); //Tô đậm chữ
		$objPHPExcel->getActiveSheet()->getStyle('A1:G2')->getFont()->setItalic(true);
		$objPHPExcel->getActiveSheet()->getStyle("A1:G2")->getFont()->setSize(11);
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setSize(18);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setSize(11);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $tieude);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', $tencongty);
		$objPHPExcel->getActiveSheet()->setCellValue('A2', $diachi);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $thangnam);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', $gioin);	
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'NGÀY NHẬP');
		$objPHPExcel->getActiveSheet()->setCellValue('B4', 'SỐ CHỨNG TỪ');
		$objPHPExcel->getActiveSheet()->setCellValue('C4', 'CODE TEM GIẤY');
		$objPHPExcel->getActiveSheet()->setCellValue('D4', 'SIZE TEM GIẤY');
		$objPHPExcel->getActiveSheet()->setCellValue('E4', 'SỐ LƯỢNG');
		$objPHPExcel->getActiveSheet()->setCellValue('F4', 'ĐƠN GIÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('G4', 'THÀNH TIỀN');
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getFont()->setBold(true);
		cellColor('A4:G4', 'F0F8FF');

		$numRow = 5;
		$thanhtien = $tongsoluong = $tongsotien = 0;
		for($i=1; $i<=$num_page; $i++){
			$begin = ($i - 1)*$num_rows_page;
			$sql = "select * from $GLOBALS[db_sp].da_temgiay where trangthai = 2 $wh $whdate order by dated desc, id desc limit $begin,$num_rows_page";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				if($numRow % 2 == 0) cellColor('A'.$numRow.':G'.$numRow, 'f2f2f2');
				$sqldm = "select dongia, code, size from $GLOBALS[db_sp].dm_temgiay where id = ".$item['idtemgiay'];
				$rsdm = $GLOBALS['sp']->getRow($sqldm);
				$thanhtien = round($rsdm['dongia'] * $item['soluong'],3);
				$tongsoluong = round($tongsoluong + $item['soluong'],3);
				$tongsotien = round($tongsotien + $thanhtien,3);		
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':D'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$numRow.':G'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->applyFromArray($BStyle);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,date('d/m/Y',strtotime($item['dated'])));
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,$item['maphieu']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$rsdm['code']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$rsdm['size']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,number_format($item["soluong"],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,number_format($rsdm['dongia'],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,number_format($thanhtien,3,".",","));
				$numRow++;
			}
		}
		//Phan cuoi bang
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$numRow.':G'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.($numRow),"Tổng tất cả:");
		$objPHPExcel->getActiveSheet()->setCellValue('E'.($numRow),number_format($tongsoluong,0,".",","));	
		$objPHPExcel->getActiveSheet()->setCellValue('G'.($numRow),number_format($tongsotien,3,".",","));

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$day.'-'.$month.'-'.$year.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();
	break;

	case 'KhoTemDaNhapXuat':
		if($type == 'nhapkho' && !empty($type)){
			$wh.=' and type = 1 and trangthai > 0';
			$titleExcle = $setTitle = 'Da-Tem-Da-Thong-Ke-Nhap-Kho';
			$tieude = 'THỐNG KÊ NHẬP KHO TEM ĐÁ';
		}
		else{
			$wh.=' and type = 2 and trangthai = 2';
			$titleExcle = $setTitle = 'Da-Tem-Da-Thong-Ke-Xuat-Kho';
			$tieude = 'THỐNG KÊ XUẤT KHO TEM ĐÁ';
		}
		$sql_sum = "select count(id) from $GLOBALS[db_sp].da_temda where 1=1 $wh $whdate order by maphieu desc";
		$total = ceil($GLOBALS['sp']->getOne($sql_sum));

		$num_rows_page = 100;
		$num_page = ceil($total/$num_rows_page);

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

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . (string)(3) . ':' . 'H' . (string)(3)); // xếp dòng
		$objPHPExcel->getActiveSheet()->mergeCells('E' . (string)(1) . ':' . 'H' . (string)(1));	
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);	
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);		
		$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getFont()->setSize(13); //Cỡ chữ
		$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getFont()->setBold(true); //Tô đậm chữ
		$objPHPExcel->getActiveSheet()->getStyle('A1:H2')->getFont()->setItalic(true);
		$objPHPExcel->getActiveSheet()->getStyle("A1:H2")->getFont()->setSize(11);
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setSize(18);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setSize(11);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $tieude);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', $tencongty);
		$objPHPExcel->getActiveSheet()->setCellValue('A2', $diachi);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $thangnam);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', $gioin);	
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'NGÀY NHẬP');
		$objPHPExcel->getActiveSheet()->setCellValue('B4', 'MÃ PHIẾU');
		$objPHPExcel->getActiveSheet()->setCellValue('C4', 'MÃ ĐÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('D4', 'TÊN ĐÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('E4', 'SIZE ĐÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('F4', 'SỐ LƯỢNG');
		$objPHPExcel->getActiveSheet()->setCellValue('G4', 'ĐƠN GIÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('H4', 'THÀNH TIỀN');
		$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getFont()->setBold(true);
		cellColor('A4:H4', 'F0F8FF');

		$numRow = 5;
		$tongsoluong = $tongsotien = 0;
		for($i=1; $i<=$num_page; $i++){
			$begin = ($i - 1)*$num_rows_page;
			$sql = "select * from $GLOBALS[db_sp].da_temda where 1=1 $wh $whdate order by maphieu desc limit $begin,$num_rows_page";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				if($numRow % 2 == 0) cellColor('A'.$numRow.':H'.$numRow, 'f2f2f2');

				$tongsoluong = round($tongsoluong + $item['soluongda'],3);
				$tongsotien = round($tongsotien + $item['tongtienda'],3);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':E'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->applyFromArray($BStyle);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,date('d/m/Y',strtotime($item['dated'])));
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,$item['maphieu']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$item['mada']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$item['tenda']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$item['sizeda']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,number_format($item["soluongda"],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,number_format($item['dongiada'],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,number_format($item['tongtienda'],3,".",","));
				$numRow++;
			}
		}
		//Phan cuoi bang
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.($numRow),"Tổng tất cả:");
		$objPHPExcel->getActiveSheet()->setCellValue('F'.($numRow),number_format($tongsoluong,0,".",","));	
		$objPHPExcel->getActiveSheet()->setCellValue('H'.($numRow),number_format($tongsotien,3,".",","));

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$day.'-'.$month.'-'.$year.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();
	break;

	case 'KhoTemDaXuatKho':
		$titleExcle = $setTitle = 'Da-Tem-Da-Thong-Ke-Xuat-Kho';
		$tieude = 'THỐNG KÊ XUẤT KHO TEM ĐÁ';
		$sql_sum = "select count(id) from $GLOBALS[db_sp].da_temda where type = 2 and trangthai = 2 $whdate order by maphieu desc";
		$total = ceil($GLOBALS['sp']->getOne($sql_sum));

		$num_rows_page = 100;
		$num_page = ceil($total/$num_rows_page);

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

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . (string)(3) . ':' . 'J' . (string)(3)); // xếp dòng
		$objPHPExcel->getActiveSheet()->mergeCells('I' . (string)(1) . ':' . 'J' . (string)(1));	
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);	
		$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFont()->setSize(13); //Cỡ chữ
		$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(true); //Tô đậm chữ
		$objPHPExcel->getActiveSheet()->getStyle('A1:J2')->getFont()->setItalic(true);
		$objPHPExcel->getActiveSheet()->getStyle("A1:J2")->getFont()->setSize(11);
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setSize(18);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setSize(11);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $tieude);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', $tencongty);
		$objPHPExcel->getActiveSheet()->setCellValue('A2', $diachi);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $thangnam);
		$objPHPExcel->getActiveSheet()->setCellValue('I1', $gioin);	
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'NGÀY NHẬP');
		$objPHPExcel->getActiveSheet()->setCellValue('B4', 'MÃ PHIẾU');
		$objPHPExcel->getActiveSheet()->setCellValue('C4', 'MÃ ĐÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('D4', 'TÊN ĐÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('E4', 'SIZE ĐÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('F4', 'SỐ LƯỢNG');
		$objPHPExcel->getActiveSheet()->setCellValue('G4', 'ĐƠN GIÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('H4', 'THÀNH TIỀN');
		$objPHPExcel->getActiveSheet()->setCellValue('I4', 'PHÒNG CHUYỂN');
		$objPHPExcel->getActiveSheet()->setCellValue('J4', 'GHI CHÚ');
		$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(true);
		cellColor('A4:J4', 'F0F8FF');

		$numRow = 5;
		$tongsoluong = $tongsotien = 0;
		for($i=1; $i<=$num_page; $i++){
			$begin = ($i - 1)*$num_rows_page;
			$sql = "select * from $GLOBALS[db_sp].da_temda where type = 2 and trangthai = 2 $whdate order by maphieu desc limit $begin,$num_rows_page";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				if($numRow % 2 == 0) cellColor('A'.$numRow.':J'.$numRow, 'f2f2f2');

				$tongsoluong = round($tongsoluong + $item['soluongda'],3);
				$tongsotien = round($tongsotien + $item['tongtienda'],3);	
				$typePhongChuyenSX = getLinkTitleKhoShort1($item['phongbanin'],1);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':E'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$numRow.':J'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':J'.$numRow)->applyFromArray($BStyle);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,date('d/m/Y',strtotime($item['dated'])));
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,$item['maphieu']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$item['mada']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$item['tenda']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$item['sizeda']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,number_format($item["soluongda"],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,number_format($item['dongiada'],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,number_format($item['tongtienda'],3,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,$typePhongChuyenSX);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numRow,$item['ghichu']);
				$numRow++;
			}
		}
		//Phan cuoi bang
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':J'.$numRow)->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':J'.$numRow)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.($numRow),"Tổng tất cả:");
		$objPHPExcel->getActiveSheet()->setCellValue('F'.($numRow),number_format($tongsoluong,0,".",","));
		$objPHPExcel->getActiveSheet()->setCellValue('H'.($numRow),number_format($tongsotien,3,".",","));

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$day.'-'.$month.'-'.$year.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();
	
	break;

	case"exportExcelNhapXuatTemGiay":
		$wh = '';
		
		if($cid > 0){
			// $wh.=' and cid = '.$cid.'  ';	
		}
		if(!empty($fromdays)){
			$fromDate = explode('/',$fromdays);
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
			$wh.=' and dated >= "'.$fromDate.'"';
		}
		if(!empty($todays)){
			$toDate = explode('/',$todays);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$wh.=' and dated <= "'.$toDate.'"';
		}
		if(!empty($dateds) || $dateds != ''){
			$strSearch .= '&dateds='.$dateds;
			$dateds = explode('/',$dateds);
			$dateds = $dateds[2].'-'.$dateds[1].'-'.$dateds[0];
			$wh.=' and dated = "'.$dateds.'"';
		}
		if($type > 0){
			$wh .= " and type= ".$type;
		}
		if(!empty($sochungtus) || $sochungtus != ''){
			$wh.=' and maphieu like "%'.$sochungtus.'%" ';
		}
		if(!empty($nguoiduyets) || $nguoiduyets != ''){
			$wh.=' and midduyet IN ('.$sqlIdAdmin.' and fullname like "%'.$nguoiduyets.'%")';
		}
		if(!empty($codetems) || $codetems != ''){
			$wh.=' and idtemgiay IN ('.$sqlIdTem.' and code like "%'.$codetems.'%")';
		}
		if(!empty($sizetems) || $sizetems != ''){
			$wh.=' and idtemgiay IN ('.$sqlIdTem.' and size like "%'.$sizetems.'%")';
		}
		$sql_sum = "select count(id) from $GLOBALS[db_sp].da_temgiay where trangthai = 2 $wh order by dated desc, id desc";	
		$total = ceil($GLOBALS['sp']->getOne($sql_sum));

		$num_rows_page = 100;
		$num_page = ceil($total/$num_rows_page);

		$titleExcle = ($type == 1)?'Da-Tem-Giay-Thong-Ke-Nhap-Kho':'Da-Tem-Giay-Thong-Ke-Xuat-Kho';
		$setTitle = ($type == 1)?'Da-Tem-Giay-Thong-Ke-Nhap-Kho':'Da-Tem-Giay-Thong-Ke-Xuat-Kho';
		
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

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . (string)(3) . ':' . 'G' . (string)(3)); // xếp dòng
		$objPHPExcel->getActiveSheet()->mergeCells('F' . (string)(1) . ':' . 'G' . (string)(1));
		
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setSize(13); //Cỡ chữ
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true); //Tô đậm chữ

		$objPHPExcel->getActiveSheet()->getStyle('A1:G2')->getFont()->setItalic(true);
		$objPHPExcel->getActiveSheet()->getStyle("A1:G2")->getFont()->setSize(11);
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setSize(18);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setSize(11);

		$tieude = ($type == 1)?'THỐNG KÊ NHẬP KHO TEM GIẤY':'THỐNG KÊ XUẤT KHO TEM GIẤY';
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $tieude);

		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->setCellValue('A1', $tencongty);
		$objPHPExcel->getActiveSheet()->setCellValue('A2', $diachi);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $thangnam);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', $gioin);
		
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'NGÀY NHẬP');
		$objPHPExcel->getActiveSheet()->setCellValue('B4', 'SỐ CHỨNG TỪ');
		$objPHPExcel->getActiveSheet()->setCellValue('C4', 'MÃ TEM GIẤY');
		$objPHPExcel->getActiveSheet()->setCellValue('D4', 'SIZE TEM GIẤY');
		$objPHPExcel->getActiveSheet()->setCellValue('E4', 'SỐ LƯỢNG');
		$objPHPExcel->getActiveSheet()->setCellValue('F4', 'ĐƠN GIÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('G4', 'THÀNH TIỀN');

		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getFont()->setBold(true);

		cellColor('A4:G4', 'F0F8FF');

		$numRow = 5;
		$tonghao = $tongdu = $thanhtien = $tongsl = $tongst = 0;
		for($i=1; $i<=$num_page; $i++){
			
			$begin = ($i - 1)*$num_rows_page;
			$sql = "select * from $GLOBALS[db_sp].da_temgiay where trangthai = 2 $wh order by dated desc, id desc limit $begin,$num_rows_page";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				if($numRow % 2 == 0) cellColor('A'.$numRow.':G'.$numRow, 'f2f2f2');

				$codetem = $sizetem = $dongia = '';
				if($item['idtemgiay'] > 0){
					$codetem = getNameAll('dm_temgiay', 'code', $item['idtemgiay']);
					$sizetem = getNameAll('dm_temgiay', 'size', $item['idtemgiay']);
					$dongia = getNameAll('dm_temgiay', 'dongia', $item['idtemgiay']);

				}
				$thanhtien = round($dongia * $item['soluong'],3);
				$tongsl = round($tongsl + $item['soluong'],3);
				$tongst = round($tongst + $thanhtien,3);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':D'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$numRow.':G'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->applyFromArray($BStyle);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,date('d/m/Y',strtotime($item['dated'])));
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,$item['maphieu']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$codetem);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$sizetem);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,number_format($item["soluong"],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,number_format($dongia,0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,number_format($thanhtien,0,".",","));
				$numRow++;
			}
		}
		//Phan cuoi bang
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$numRow.':G'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->mergeCells('D' . (string)($numRow+1) . ':' . 'G' . (string)($numRow+1));
		$objPHPExcel->getActiveSheet()->mergeCells('D' . (string)($numRow+3) . ':' . 'G' . (string)($numRow+3));
		$objPHPExcel->getActiveSheet()->setCellValue('D'.($numRow),"Tổng Số Lượng");
		$objPHPExcel->getActiveSheet()->setCellValue('E'.($numRow),number_format($tongsl,0,".",","));
		$objPHPExcel->getActiveSheet()->setCellValue('F'.($numRow),"Tổng Tiền");
		$objPHPExcel->getActiveSheet()->setCellValue('G'.($numRow),number_format($tongst,0,".",","));

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$day.'-'.$month.'-'.$year.'-'.$hours.$minutes.$seconds.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();
	break;
	case"exportExcelNhapXuatTemHop":
		$wh = '';
		
		if($cid > 0){
			// $wh.=' and cid = '.$cid.'  ';	
		}
		if(!empty($fromdays)){
			$fromDate = explode('/',$fromdays);
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
			$wh.=' and dated >= "'.$fromDate.'"';
		}
		if(!empty($todays)){
			$toDate = explode('/',$todays);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$wh.=' and dated <= "'.$toDate.'"';
		}
		if(!empty($dateds) || $dateds != ''){
			$strSearch .= '&dateds='.$dateds;
			$dateds = explode('/',$dateds);
			$dateds = $dateds[2].'-'.$dateds[1].'-'.$dateds[0];
			$wh.=' and dated = "'.$dateds.'"';
		}
		if($type > 0){
			$wh .= " and type= ".$type;
		}
		if(!empty($sochungtus) || $sochungtus != ''){
			$wh.=' and maphieu like "%'.$sochungtus.'%" ';
		}
		if(!empty($nguoiduyets) || $nguoiduyets != ''){
			$wh.=' and midduyet IN ('.$sqlIdAdmin.' and fullname like "%'.$nguoiduyets.'%")';
		}
		if(!empty($codetems) || $codetems != ''){
			$wh.=' and idtemhop IN ('.$sqlIdTem.' and code like "%'.$codetems.'%")';
		}
		if(!empty($sizetems) || $sizetems != ''){
			$wh.=' and idtemhop IN ('.$sqlIdTem.' and size like "%'.$sizetems.'%")';
		}
		$sql_sum = "select count(id) from $GLOBALS[db_sp].da_temhop where trangthai = 2 $wh order by dated desc, id desc";	
		$total = ceil($GLOBALS['sp']->getOne($sql_sum));

		$num_rows_page = 100;
		$num_page = ceil($total/$num_rows_page);

		$titleExcle = ($type == 1)?'Da-Tem-Hop-Thong-Ke-Nhap-Kho':'Da-Tem-Hop-Thong-Ke-Xuat-Kho';
		$setTitle = ($type == 1)?'Da-Tem-Hop-Thong-Ke-Nhap-Kho':'Da-Tem-Hop-Thong-Ke-Xuat-Kho';
		
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

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . (string)(3) . ':' . 'G' . (string)(3)); // xếp dòng
		$objPHPExcel->getActiveSheet()->mergeCells('F' . (string)(1) . ':' . 'G' . (string)(1));
		
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setSize(13); //Cỡ chữ
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true); //Tô đậm chữ

		$objPHPExcel->getActiveSheet()->getStyle('A1:G2')->getFont()->setItalic(true);
		$objPHPExcel->getActiveSheet()->getStyle("A1:G2")->getFont()->setSize(11);
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setSize(18);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setSize(11);

		$tieude = ($type == 1)?'THỐNG KÊ NHẬP KHO TEM HỘP':'THỐNG KÊ XUẤT KHO TEM HỘP';
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $tieude);

		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->setCellValue('A1', $tencongty);
		$objPHPExcel->getActiveSheet()->setCellValue('A2', $diachi);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $thangnam);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', $gioin);
		
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'NGÀY NHẬP');
		$objPHPExcel->getActiveSheet()->setCellValue('B4', 'SỐ CHỨNG TỪ');
		$objPHPExcel->getActiveSheet()->setCellValue('C4', 'MÃ TEM HỘP');
		$objPHPExcel->getActiveSheet()->setCellValue('D4', 'SIZE TEM HỘP');
		$objPHPExcel->getActiveSheet()->setCellValue('E4', 'SỐ LƯỢNG');
		$objPHPExcel->getActiveSheet()->setCellValue('F4', 'ĐƠN GIÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('G4', 'THÀNH TIỀN');

		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getFont()->setBold(true);

		cellColor('A4:G4', 'F0F8FF');

		$numRow = 5;
		$tonghao = $tongdu = $thanhtien = $tongsl = $tongst = 0;
		for($i=1; $i<=$num_page; $i++){
			
			$begin = ($i - 1)*$num_rows_page;
			$sql = "select * from $GLOBALS[db_sp].da_temhop where trangthai = 2 $wh order by dated desc, id desc limit $begin,$num_rows_page";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				if($numRow % 2 == 0) cellColor('A'.$numRow.':G'.$numRow, 'f2f2f2');

				$codetem = $sizetem = $dongia = '';
				if($item['idtemhop'] > 0){
					$codetem = getNameAll('dm_temhop', 'code', $item['idtemhop']);
					$sizetem = getNameAll('dm_temhop', 'size', $item['idtemhop']);
					$dongia = getNameAll('dm_temhop', 'dongia', $item['idtemhop']);

				}
				$thanhtien = round($dongia * $item['soluong'],3);
				$tongsl = round($tongsl + $item['soluong'],3);
				$tongst = round($tongst + $thanhtien,3);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':D'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$numRow.':G'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->applyFromArray($BStyle);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,date('d/m/Y',strtotime($item['dated'])));
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,$item['maphieu']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$codetem);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$sizetem);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,number_format($item["soluong"],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,number_format($dongia,0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,number_format($thanhtien,0,".",","));
				$numRow++;
			}
		}
		//Phan cuoi bang
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$numRow.':G'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->mergeCells('D' . (string)($numRow+1) . ':' . 'G' . (string)($numRow+1));
		$objPHPExcel->getActiveSheet()->mergeCells('D' . (string)($numRow+3) . ':' . 'G' . (string)($numRow+3));
		$objPHPExcel->getActiveSheet()->setCellValue('D'.($numRow),"Tổng Số Lượng");
		$objPHPExcel->getActiveSheet()->setCellValue('E'.($numRow),number_format($tongsl,0,".",","));
		$objPHPExcel->getActiveSheet()->setCellValue('F'.($numRow),"Tổng Tiền");
		$objPHPExcel->getActiveSheet()->setCellValue('G'.($numRow),number_format($tongst,0,".",","));

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$day.'-'.$month.'-'.$year.'-'.$hours.$minutes.$seconds.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();
	break;
	case"exportExcelNhapXuatTemDa":
		$wh = '';
		
		if($cid > 0){
			// $wh.=' and cid = '.$cid.'  ';	
		}
		if(!empty($fromdays)){
			$fromDate = explode('/',$fromdays);
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
			$wh.=' and dated >= "'.$fromDate.'"';
		}
		if(!empty($todays)){
			$toDate = explode('/',$todays);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$wh.=' and dated <= "'.$toDate.'"';
		}
		if(!empty($dateds) || $dateds != ''){
			$strSearch .= '&dateds='.$dateds;
			$dateds = explode('/',$dateds);
			$dateds = $dateds[2].'-'.$dateds[1].'-'.$dateds[0];
			$wh.=' and dated = "'.$dateds.'"';
		}
		if($type > 0){
			$wh .= " and type= ".$type;
		}
		
		$sql_sum = "select count(id) from $GLOBALS[db_sp].da_temda where trangthai = 2 $wh order by dated desc, id desc";	
		$total = ceil($GLOBALS['sp']->getOne($sql_sum));

		$num_rows_page = 100;
		$num_page = ceil($total/$num_rows_page);

		$titleExcle = ($type == 1)?'Da-Tem-Da-Thong-Ke-Nhap-Kho':'Da-Tem-Da-Thong-Ke-Xuat-Kho';
		$setTitle = ($type == 1)?'Da-Tem-Da-Thong-Ke-Nhap-Kho':'Da-Tem-Da-Thong-Ke-Xuat-Kho';
		
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

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . (string)(3) . ':' . 'G' . (string)(3)); // xếp dòng
		$objPHPExcel->getActiveSheet()->mergeCells('F' . (string)(1) . ':' . 'G' . (string)(1));
		
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(false);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
				
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setSize(13); //Cỡ chữ
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true); //Tô đậm chữ

		$objPHPExcel->getActiveSheet()->getStyle('A1:G2')->getFont()->setItalic(true);
		$objPHPExcel->getActiveSheet()->getStyle("A1:G2")->getFont()->setSize(11);
		$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setSize(18);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setSize(11);

		$tieude = ($type == 1)?'THỐNG KÊ NHẬP KHO TEM ĐÁ':'THỐNG KÊ XUẤT KHO TEM ĐÁ';
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $tieude);

		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->setCellValue('A1', $tencongty);
		$objPHPExcel->getActiveSheet()->setCellValue('A2', $diachi);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $thangnam);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', $gioin);
		
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'NGÀY NHẬP');
		$objPHPExcel->getActiveSheet()->setCellValue('B4', 'MÃ PHIẾU');
		$objPHPExcel->getActiveSheet()->setCellValue('C4', 'MÃ ĐÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('D4', 'TÊN ĐÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('E4', 'SỐ LƯỢNG');
		$objPHPExcel->getActiveSheet()->setCellValue('F4', 'ĐƠN GIÁ');
		$objPHPExcel->getActiveSheet()->setCellValue('G4', 'THÀNH TIỀN');

		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getFont()->setBold(true);

		cellColor('A4:G4', 'F0F8FF');

		$numRow = 5;
		$tongsl = $tongst = 0;
		for($i=1; $i<=$num_page; $i++){
			
			$begin = ($i - 1)*$num_rows_page;
			$sql = "select * from $GLOBALS[db_sp].da_temda where trangthai = 2 $wh order by maphieu desc, id desc limit $begin,$num_rows_page";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				if($numRow % 2 == 0) cellColor('A'.$numRow.':G'.$numRow, 'f2f2f2');

				$tongsl = round($tongsl + $item['soluongda'],3);
				$tongst = round($tongst + $item['tongtienda'],3);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':D'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$numRow.':G'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->applyFromArray($BStyle);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,date('d/m/Y',strtotime($item['dated'])));
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,$item['maphieu']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$item['mada']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$item['tenda']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,number_format($item["soluongda"],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,number_format($item["dongiada"],0,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,number_format($item["tongtienda"],0,".",","));
				$numRow++;
			}
		}
		//Phan cuoi bang
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':G'.$numRow)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$numRow.':G'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->mergeCells('D' . (string)($numRow+1) . ':' . 'G' . (string)($numRow+1));
		$objPHPExcel->getActiveSheet()->mergeCells('D' . (string)($numRow+3) . ':' . 'G' . (string)($numRow+3));
		$objPHPExcel->getActiveSheet()->setCellValue('D'.($numRow),"Tổng Số Lượng");
		$objPHPExcel->getActiveSheet()->setCellValue('E'.($numRow),number_format($tongsl,0,".",","));
		$objPHPExcel->getActiveSheet()->setCellValue('F'.($numRow),"Tổng Tiền");
		$objPHPExcel->getActiveSheet()->setCellValue('G'.($numRow),number_format($tongst,0,".",","));

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$day.'-'.$month.'-'.$year.'-'.$hours.$minutes.$seconds.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();
	break;

	
}
function getNameAll($table, $names, $id){
	$name = '';
	if($id > 0){
		$sql = "select ".$names." from $GLOBALS[db_sp].".$table." where id= ".$id;
		$name = $GLOBALS["sp"]->getOne($sql);
	}
	return $name;
}
//============Vũ thêm Function===================//
function getNamMaDonHangCatalog($madhin){
	$rs = '';
	if($madhin > 0){
		$sql = "select code from $GLOBALS[db_catalog].ordersanxuat where id=".$madhin; 
		$rs = $GLOBALS["catalog"]->getOne($sql);
	}
	return $rs;	
}
//==/==============/
function getLinkTitle($cid,$live){
	global $path_url,$lang;
	$sql = "select * from $GLOBALS[db_sp].categories where id=$cid";
	$item = $GLOBALS["sp"]->getRow($sql);
	if($item["pid"] == 2)
		$str=$item["name_vn"];
	else{
		$str='»'.$item["name_vn"];
		}
	if($item['pid'] != 2)
		return getLinkTitle($item["pid"],2).$str;
	else
		return $str;
}
//======================//
function getLinkTitleKhoShort1($id,$type){
	$title = '';
	$title = getLinkTitle($id,$type);
	// $title = explode('&raquo;',$title);
	$title = explode('»',$title);
	$title = $title[0].'-'.$title[1];
	return $title;
}
function cellColor($cells,$color){
    global $objPHPExcel;
    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}
//============Kết thúc Vũ thêm Function===================//
/*
function StripSql($data){
	$str = str_replace("'", "''", $data);
	return str_replace("\''", "''", $str);
}


function getNameList($table, $names, $id){
	$str = '';
	if($id > 0){
		$sql = "select ".$names." from $GLOBALS[db_sp].".$table." where id in (".$id.")";
		$rs = $GLOBALS["sp"]->getCol($sql);
		$str = implode(', ', $rs);
	}
	return $str;
}
*/
?>