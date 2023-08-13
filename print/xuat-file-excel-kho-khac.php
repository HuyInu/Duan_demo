<?php
include_once("../#include/config.php");
//include_once("../functions/function.php");
//CheckLogin();
require_once '../Classes-PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$datenow = date("d-m-Y");

$typevkc = isset($_REQUEST['typevkc'])?$_REQUEST['typevkc']:1;
$cid = ceil(trim($_REQUEST['cid']));
$idname = ceil(trim($_REQUEST['idname']));

$fromdays = trim($_GET['fromdays']);
$todays = trim($_GET['todays']);
$idloaivang = trim(isset($_REQUEST['idloaivang'])?$_REQUEST['idloaivang']:0);	
$act = trim(isset($_REQUEST['act'])?$_REQUEST['act']:"");	
$type = trim(isset($_REQUEST['type'])?$_REQUEST['type']:"");
switch($act){	
	case"KhoKhacThongKeTongDeCucSauCheTac":
		$wh = '';
		if($cid > 0){
			$wh.=' and cid = '.$cid.'  ';	
		}
		if(!empty($fromdays)){
			$fromDate = explode('/',$fromdays);
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
			$wh.=' and datechuyen >= "'.$fromDate.'"  ';
		}
		if(!empty($todays)){
			$toDate = explode('/',$todays);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$wh.=' and datechuyen <= "'.$toDate.'" ';
		}
		if(ceil($idloaivang) > 0){
			$wh.=' and idloaivang =  '.$idloaivang.' ';
		}


		$sql_sum = "select count(id) from $GLOBALS[db_sp].khokhac_khotongdecuc 
					where typesauchetac=2
					$wh 
		";
			
		$total = ceil($GLOBALS['sp']->getOne($sql_sum));
		$num_rows_page = 100;
		$num_page = ceil($total/$num_rows_page);
		
		$titleExcle = 'KhoKhac-KhoSauCheTac-ThongKe-NhapKho';
		$setTitle = 'KhoSauCheTac-ThongKe-NhapKho';

		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle($setTitle);
		
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(70);
				
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(13); //Cỡ chữ
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true); //Tô đậm chữ
		
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NGÀY');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'MÃ PHIẾU');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'LOẠI VÀNG');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'TỔNG TL VÀNG SAU CHẾ TÁC');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'TUỔI VÀNG SAU CHẾ TÁC');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'HỘI CHẾ TÁC');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'HAO');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'DƯ');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'GHI CHÚ');
		$numRow = 2;
		$tonghao = $tongdu = 0;
		for($i=1; $i<=$num_page; $i++){
			$begin = ($i - 1)*$num_rows_page;
			$sql = "select * from $GLOBALS[db_sp].khokhac_khotongdecuc 
					where typesauchetac=2
					$wh 
					order by maphieu asc, id asc
					limit $begin,$num_rows_page
			";
			$rs = $GLOBALS["sp"]->getAll($sql);
			
			foreach($rs as $item){
				$loaivang = '';
				if($item['idloaivang'] > 0){
					$loaivang = getNameAll('loaivang', 'name_vn', $item['idloaivang']);
				}
				$tonghao = $tonghao + $item["hao"];
				$tongdu = $tongdu + $item["du"];
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':O'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':O'.$numRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,$item['datechuyen']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,$item['maphieu']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$loaivang);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,number_format($item["trongluongvangsauchetac"],3,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,number_format($item["tuoivangsauchetac"],3,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,number_format($item["hoiche"],3,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,number_format($item["hao"],3,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,number_format($item["du"],3,".",","));
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,$item["ghichu"]);
				$numRow++;		
			}
		}
		
		$objPHPExcel->getActiveSheet()->getStyle('D'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':O'.$numRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':O'.$numRow)->getFont()->setBold(true); //Tô đậm chữ
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,'');
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,'');
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,'');
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,'');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,'');
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,'');
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,number_format($tonghao,3,".",","));
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,number_format($tongdu,3,".",","));
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,'');
		
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();
	break;
	//////////////////////////////////////////VŨ THÊM EXCEL KHO BỘT///////////////////////////////////////////////
	////Export bột nấu chờ nhập kho+ bột nấu xuất kho
	case"ChoNhapKhoKhoBot":
	case"xuatkhoKhoBot":		
		$wh = '';
		if(!empty($fromdays)){
			$fromDate = explode('/',$fromdays);
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];				
		}
		if(!empty($todays)){
			$toDate = explode('/',$todays);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];			
		}		
		if(ceil($idloaivang) > 0){
			$wh.=' and idloaivang =  '.$idloaivang.' ';
		}
		$sqlFrom = " from $GLOBALS[db_sp].bot_khobot ";	
		$sqlRound = " ROUND(SUM(cannangv), 3) as cannangv ";		
		$sqlGroupOrder = " group by idloaivang
						   order by idloaivang asc";
		if($act=="ChoNhapKhoKhoBot"){
			$titleExcle = 'KhoKhac-KhoBot-ThongKe-BotNauChoNhapKho';
			$setTitle = 'KhoBot-ThongKe-BotNauChoNhapKho';
			$tieudeNoiDung = 'THỐNG KÊ BỘT NẤU CHỜ NHẬP KHO';
			$sqlWhere = " where type=3 and trangthai=1 $wh ";
			$sqlDatedChuyen = " and datechuyen >= '".$fromDate."' and datechuyen <= '".$toDate."' ";
			$sqlOrderDatedChuyen = " order by datechuyen desc, id desc ";
			$datedXuatChuyen = "datechuyen";
			$sql = "select *".$sqlFrom.$sqlWhere.$sqlDatedChuyen.$sqlOrderDatedChuyen;//sql lấy bột nấu chờ nhập kho
			$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlDatedChuyen.$sqlGroupOrder;//tổng theo loại vàng
			$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere.$sqlDatedChuyen;	//sql tính tổng cân nặng vàng
			$sql_sum = "select count(id) ".$sqlFrom.$sqlWhere;//sql tính tổng dòng			
			}
		if($act=="xuatkhoKhoBot"){
			$titleExcle = 'KhoKhac-KhoBot-ThongKe-BotNauXuatKho';
			$setTitle = 'KhoBot-ThongKe-BotNauXuatKho';	
			$tieudeNoiDung = 'THỐNG KÊ BỘT NẤU XUẤT KHO';
			$sqlDatedXuat = " and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' ";
			$sqlWhere = " where type=3 and trangthai=2 $wh ";
			$datedXuatChuyen = "datedxuat";
			$sql = "select * ".$sqlFrom.$sqlWhere.$sqlDatedXuat."
					order by datedxuat desc, id desc"; //sql lấy bột nấu chờ xuất kho
			$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlDatedXuat.$sqlGroupOrder; //tổng theo loại vàng
			$sql_tong = "select ROUND(SUM(cannangv), 3) as cannangv ".$sqlFrom.$sqlWhere.$sqlDatedXuat; //sql tính tổng cân nặng vàng
			$sql_sum = "select count(id) ".$sqlFrom.$sqlWhere;	
			}
		$total = ceil($GLOBALS['sp']->getOne($sql_sum));
		$num_rows_page = 100;
		$num_page = ceil($total/$num_rows_page);
		
		
		//khởi tạo objPHPExcel
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle($setTitle);
		//gán giá trị cho tiêu đề	
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Từ ngày: '.$fromdays.' - Đến ngày: '.$todays);		
		$objPHPExcel->getActiveSheet()->setCellValue('A1', $tieudeNoiDung);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', 'STT');		
		$objPHPExcel->getActiveSheet()->setCellValue('B3', 'NGÀY XUẤT');
		$objPHPExcel->getActiveSheet()->setCellValue('C3', 'MÃ PHIẾU');
		$objPHPExcel->getActiveSheet()->setCellValue('D3', 'NHÓM NGUYÊN LIỆU');
		$objPHPExcel->getActiveSheet()->setCellValue('E3', 'TÊN NGUYÊN LIỆU');
		$objPHPExcel->getActiveSheet()->setCellValue('F3', 'LOẠI VÀNG DẺ NẤU');
		$objPHPExcel->getActiveSheet()->setCellValue('G3', 'TỔNG TL VÀNG SAU NẤU');
		$objPHPExcel->getActiveSheet()->setCellValue('H3', 'TỔNG TL VÀNG TRƯỚC NẤU');
		$objPHPExcel->getActiveSheet()->setCellValue('I3', 'TUỔI VÀNG SAU NẤU');
		$objPHPExcel->getActiveSheet()->setCellValue('J3', 'HAO Q10');
		$objPHPExcel->getActiveSheet()->setCellValue('K3', 'DƯ Q10');
		$objPHPExcel->getActiveSheet()->setCellValue('L3', 'PHÒNG CHUYỂN');
		$objPHPExcel->getActiveSheet()->setCellValue('M3', 'GHI CHÚ');
		//lấy chi tiết phiếu			
		$numRow = 4;		
		$j = 1;
		$i=0;
		$tonghao = $tongdu = $tongvangxuat = 0;	
		for($i=1; $i<=$num_page; $i++){		
			$begin = ($i - 1)*$num_rows_page;
			$sql .= ' limit '.$begin.','.$num_rows_page;					
			$rs = $GLOBALS["sp"]->getAll($sql);							
			foreach($rs as $item){
				$loaivang = '';
				if($item['idloaivang'] > 0){
					$loaivang = getNameAll('loaivang', 'name_vn', $item['idloaivang']);
					}
				$tonghao = $tonghao + $item["hao"];
				$tongdu = $tongdu + $item["du"];
				$tongvangsaunau = $tongvangsaunau + $item["cannangv"];								
				
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,$j);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,date("d/m/Y",strtotime($item[$datedXuatChuyen])));
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$item['maphieu']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,getNameAll('categories', 'name_vn',$item['nhomnguyenlieuvang']));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,getNameAll('categories', 'name_vn',$item['tennguyenlieuvang']));
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$loaivang);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$item["cannangv"]);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,$item['tlvangtruocnau']);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,$item["tuoivang"] );
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numRow,$item["hao"]);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$numRow,$item["du"]);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$numRow,'KHO KHÁC » KHO TỔNG DẺ CỤC » NGHIỆP VỤ » Chờ Nhập Kho');
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$numRow,$item["ghichuvang"]);				
				$numRow++;	
				$j++;	
				}
			}			
			//tông vàng theo loại vàng	
			$dongFirst = $numRow;				
			$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);
			foreach($rstongloaivang as $vltongloaivang){
				$tenloaivang = getNameAll('loaivang', 'name_vn', $vltongloaivang['idloaivang']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$tenloaivang);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$vltongloaivang['cannangv']);											
				$numRow++;
				}
			//tổng cân nặng vàng
			$dongLast = $numRow;		
			$rstong = $GLOBALS['sp']->getRow($sql_tong);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,'Tổng tất cả: ');
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$rstong['cannangv']);	
			//////kết thúc tính tổng			
		//định dạng nội dung Excel
		//set chiều rộng cột//
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);	
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);	
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);	
		//set chiều cao dòng+ border//	
		for($vtDong = 1; $vtDong <= $numRow; $vtDong++){
				$objPHPExcel->getActiveSheet()->getRowDimension($vtDong)->setRowHeight(25);	
				$objPHPExcel->getActiveSheet()->getStyle('A1:M'.$vtDong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
				$objPHPExcel->getActiveSheet()->getStyle('A2:M'.$vtDong)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				if($vtDong >=3 ){				
					for($char = 'A'; $char <= 'M'; $char++) {					
						$objPHPExcel->getActiveSheet()->getStyle($char.$vtDong)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);					
						}
					if($vtDong % 2 != 0){
						$objPHPExcel->getActiveSheet()->getStyle('A'.$vtDong.':M'.$vtDong)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('f9f9f9');
						}
				}
			}		
		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
		//set kiểu chữ và size chung//
		$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
		$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
		//set align cho từng dòng//		
		$objPHPExcel->getActiveSheet()->getStyle('A4:E'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('A4:B'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('F4:K'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->getStyle('L4:M'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		// set format number		
		$objPHPExcel->getActiveSheet()->getStyle('G4:K'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.000');
		$objPHPExcel->getActiveSheet()->getStyle('I4:I'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.0000');	
		$objPHPExcel->getActiveSheet()->getStyle('F4:F'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.00');	
		//set font cho từng dòng
		$objPHPExcel->getActiveSheet()->mergeCells('A1:M1');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:M2');		
		$objPHPExcel->getActiveSheet()->getStyle('A1:M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getFont()->setSize(17); //Cỡ chữ
		$objPHPExcel->getActiveSheet()->getStyle('A2:M2')->getFont()->setSize(14); //Cỡ chữ
		$objPHPExcel->getActiveSheet()->getStyle('A1:M3')->getFont()->setBold(true); //Tô đậm chữ
		$objPHPExcel->getActiveSheet()->getStyle('A3:M3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('d7d7db');                                                                                                                       // backgroundcolor
		//set cho các dòng Tổng Vàng
		$objPHPExcel->getActiveSheet()->getStyle('A'.$dongFirst.':M'.$dongLast)->getFont()->setSize(13);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$dongFirst.':M'.$dongLast)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$dongFirst.':E'.$dongLast);
		$objPHPExcel->getActiveSheet()->mergeCells('H'.$dongFirst.':M'.$dongLast);		
		//tạo tên file Excel		
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();
	break;
	////////Export chi tiết tồn+ chi tiết nhập kho+ chi tiết xuất kho
	case"CTTonKhoBot":
	case"CTNhapKhoKhoBot":
	case"CTXuatKhoKhoBot":
		$wh = $titleExcle = $setTitle = $sql_sum = $sql = $sqlNX =  $tieudeNoiDung = $loaiphong = '';
		$ngayNX = "NGÀY NHẬP";
		$phongChuyenSX = "PHÒNG SX";		
		$datedNX = 'dated';	
		if($act == "CTXuatKhoKhoBot"){
			$datedNX = 'datedxuat';
		}		
		if(ceil($idloaivang) > 0){
			$wh.=' and idloaivang =  '.$idloaivang.' ';
		}	
		if(!empty($fromdays)){
			$fromDate = explode('/',$fromdays);
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
			$wh.=' and '.$datedNX.' >= "'.$fromDate.'"  ';
		}
		if(!empty($todays)){
			$toDate = explode('/',$todays);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$wh.=' and '.$datedNX.' <= "'.$toDate.'" ';
		}
		
		$sqlFrom = " from $GLOBALS[db_sp].bot_khobot ";	
		$sqlRound = " ROUND(SUM(cannangvh), 3) as cannangvh, 
					 ROUND(SUM(cannangh), 3) as cannangh, 
					 ROUND(SUM(cannangv), 3) as cannangv";	
		$sqlOrderDated = " order by dated desc, id desc";
		$sqlGroupOrder = " group by idloaivang
						  order by idloaivang asc";
		if($act == "CTTonKhoBot" || $act == "CTNhapKhoKhoBot" ){	
			//thống kê tồn kho chi tiết		  
			if($act == "CTTonKhoBot"){			
				$titleExcle = 'KhoKhac-KhoBot-ThongKe-BotTonKhoChuaNau';
				$setTitle = 'KhoBot-ThongKe-BotTonKhoChuaNau';
				$tieudeNoiDung = 'THỐNG KÊ BỘT TỒN KHO CHƯA NẤU';
				$sqlWhere = " where type=1 and typechuyen=2 and trangthai=0 $wh ";
				$sql_sum = "select count(id) ".$sqlFrom.$sqlWhere;//sql tính tổng dòng
				$sql = "select *".$sqlFrom.$sqlWhere.$sqlOrderDated;//sql lấy phiếu tồn thỏa đk
				$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere;	//sql tính tổng cân nặng V+H					
				$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlGroupOrder;//tổng theo loại vàng
				}
			//thống kê nhập kho chi tiết	
			if($act == "CTNhapKhoKhoBot"){
				$titleExcle = 'KhoKhac-KhoBot-ThongKe-BotNhapKho';
				$setTitle = 'KhoBot-ThongKe-BotNhapKho';
				$tieudeNoiDung = 'THỐNG KÊ BỘT NHẬP KHO';
				$sqlWhere = " where type=1 and typechuyen=2 $wh  ";
				$sql_sum = "select count(id) ".$sqlFrom.$sqlWhere;//sql tính tổng dòng
				$sql = "select * ".$sqlFrom.$sqlWhere.$sqlOrderDated;//sql lấy phiếu thỏa đk
				$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere;	//sql tính tổng cân nặng V+H					
				$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlGroupOrder;//tổng theo loại vàng
				}
			$rstong = $GLOBALS['sp']->getRow($sql_tong);
			$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);	
			$total = ceil($GLOBALS['sp']->getOne($sql_sum));			
			$num_rows_page = 100;
			$num_page = ceil($total/$num_rows_page);		
			//khởi tạo objPHPExcel
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle($setTitle);				
			//gán giá trị cho tiêu đề				
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Từ ngày: '.$fromdays.' - Đến ngày: '.$todays);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $tieudeNoiDung);
			$objPHPExcel->getActiveSheet()->setCellValue('A3', 'STT');
			$objPHPExcel->getActiveSheet()->setCellValue('B3', $ngayNX);
			$objPHPExcel->getActiveSheet()->setCellValue('C3', 'MÃ PHIẾU');
			$objPHPExcel->getActiveSheet()->setCellValue('D3', 'LOẠI VÀNG');
			$objPHPExcel->getActiveSheet()->setCellValue('E3', 'CÂN NẶNG V+H');
			$objPHPExcel->getActiveSheet()->setCellValue('F3', 'CÂN NẶNG H ');
			$objPHPExcel->getActiveSheet()->setCellValue('G3', 'CÂN NẶNG V');
			$objPHPExcel->getActiveSheet()->setCellValue('H3', $phongChuyenSX);
			$objPHPExcel->getActiveSheet()->setCellValue('I3', 'GHI CHÚ');
			//lấy chi tiết phiếu
			$numRow = 4;
			$tonghao = $tongdu = $tongvangxuat = 0;
			$j=1;
			$string = "";
			for($i=1; $i<=$num_page; $i++){
				$begin = ($i - 1)*$num_rows_page;			
				$sql .= ' limit '.$begin.','.$num_rows_page;			
				$rs = $GLOBALS["sp"]->getAll($sql);			
				foreach($rs as $item){
					$loaivang = '';
					if($item['idloaivang'] > 0){
						$loaivang = getNameAll('loaivang', 'name_vn', $item['idloaivang']);
						}
					$tonghao = $tonghao + $item["hao"];
					$tongdu = $tongdu + $item["du"];
					$tongvangsaunau = $tongvangsaunau + $item["cannangv"];				
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,$j);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,date_format(date_create($item[$datedNX]),"d/m/Y"));				
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$item['maphieu']);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$loaivang);				
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$item["cannangvh"]);
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$item["cannangh"]);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$item["cannangv"]);				
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,$item['typekhodau']);				
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,$item["ghichuvang"]);
					$numRow++;
					$j++;		
				}			
			}
			//tổng theo loại vàng
			$dongFirst = $numRow;
			foreach($rstongloaivang as $vltongloaivang){
				if($vltongloaivang['idloaivang'] > 0){
					$tenloaivang = getNameAll('loaivang', 'name_vn', $vltongloaivang['idloaivang']);
					}						
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$tenloaivang);				
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$vltongloaivang["cannangvh"]);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$vltongloaivang["cannangh"]);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$vltongloaivang["cannangv"]);
				$numRow++;
				}
			$dongLast = $numRow;
			//tổng vàng			
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,'Tổng tất cả: ');				
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$rstong["cannangvh"]);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$rstong["cannangh"]);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$rstong["cannangv"]);
			//định dạng nội dung Excel
			//set chiều rộng cột//
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			//set chiều cao dòng+ border//	
			for($vtDong = 1; $vtDong <= $numRow; $vtDong++){
					$objPHPExcel->getActiveSheet()->getRowDimension($vtDong)->setRowHeight(25);	
					$objPHPExcel->getActiveSheet()->getStyle('A1:I'.$vtDong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
					$objPHPExcel->getActiveSheet()->getStyle('A2:I'.$vtDong)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					if($vtDong >=3 ){				
						for($char = 'A'; $char <= 'I'; $char++) {					
							$objPHPExcel->getActiveSheet()->getStyle($char.$vtDong)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);					
							}
						if($vtDong % 2 != 0){
							$objPHPExcel->getActiveSheet()->getStyle('A'.$vtDong.':I'.$vtDong)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('f9f9f9');
							}
					}
				}
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
			//set align cho từng dòng//
			$objPHPExcel->getActiveSheet()->getStyle('A4:C'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('A4:B'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('D4:G'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle('H4:I'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('D4:D'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('E4:G'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.000');
			//set kiểu chữ và size chung//
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
			$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
			//set font cho từng dòng
			$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
			$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');		
			$objPHPExcel->getActiveSheet()->getStyle('A1:I3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(17);
			$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getFont()->setSize(14); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A1:I3')->getFont()->setBold(true); //Tô đậm chữ
			$objPHPExcel->getActiveSheet()->getStyle('A3:I3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('d7d7db');                                                                                                                       // backgroundcolor
			//set cho các dòng Tổng Vàng
			$objPHPExcel->getActiveSheet()->getStyle('A'.$dongFirst.':I'.$dongLast)->getFont()->setSize(13);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$dongFirst.':I'.$dongLast)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$dongFirst.':C'.$dongLast);
			$objPHPExcel->getActiveSheet()->mergeCells('H'.$dongFirst.':I'.$dongLast);
			//tạo tên file Excel	
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
			PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
			exit();
			}
		if($act == "CTXuatKhoKhoBot"){
			$ngayNX = "NGÀY XUẤT";
			$phongChuyenSX = "PHÒNG CHUYỂN";
			$loaiphong = "KHO KHÁC»KHO TỔNG DẺ CỤC»NGHIỆP VỤ»Chờ Nhập Kho";

			$titleExcle = 'KhoKhac-KhoBot-ThongKe-BotXuatKho';
			$setTitle = 'KhoBot-ThongKe-BotNau';
			$tieudeNoiDung = 'THỐNG KÊ BỘT XUẤT KHO';	
			$sqlWhere = " where type=1 and trangthai=2 $wh ";		
			$sql_sum = "select count(id) ".$sqlFrom.$sqlWhere;//sql tính tổng dòng
			$sql = "select * ".$sqlFrom.$sqlWhere."order by datedxuat desc, idchonphieunhap desc";//sql lấy phiếu thỏa đk
			$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere;//sql tính tổng cân nặng V+H
			$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlGroupOrder;//tổng theo loại vàng	
			
			$rstong = $GLOBALS['sp']->getRow($sql_tong);
			$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);	
			$total = ceil($GLOBALS['sp']->getOne($sql_sum));			
			$num_rows_page = 100;
			$num_page = ceil($total/$num_rows_page);		
			//khởi tạo objPHPExcel
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle($setTitle);				
			//gán giá trị cho tiêu đề				
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Từ ngày: '.$fromdays.' - Đến ngày: '.$todays);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $tieudeNoiDung);
			$objPHPExcel->getActiveSheet()->setCellValue('A3', 'STT');
			$objPHPExcel->getActiveSheet()->setCellValue('B3', $ngayNX);
			$objPHPExcel->getActiveSheet()->setCellValue('C3', 'MÃ PHIẾU XUẤT KHO');
			$objPHPExcel->getActiveSheet()->setCellValue('D3', 'MÃ PHIẾU');
			$objPHPExcel->getActiveSheet()->setCellValue('E3', 'LOẠI VÀNG');
			$objPHPExcel->getActiveSheet()->setCellValue('F3', 'CÂN NẶNG V+H');
			$objPHPExcel->getActiveSheet()->setCellValue('G3', 'CÂN NẶNG H ');
			$objPHPExcel->getActiveSheet()->setCellValue('H3', 'CÂN NẶNG V');
			$objPHPExcel->getActiveSheet()->setCellValue('I3', $phongChuyenSX);
			$objPHPExcel->getActiveSheet()->setCellValue('J3', 'GHI CHÚ');
			//lấy chi tiết phiếu
			$numRow = 4;
			$tonghao = $tongdu = $tongvangxuat = 0;
			$j=1;
			$string = "";			
			for($i=1; $i<=$num_page; $i++){
				$begin = ($i - 1)*$num_rows_page;			
				$sql .= ' limit '.$begin.','.$num_rows_page;			
				$rs = $GLOBALS["sp"]->getAll($sql);			
				foreach($rs as $item){
					$loaivang = '';
					if($item['idloaivang'] > 0){
						$loaivang = getNameAll('loaivang', 'name_vn', $item['idloaivang']);
						}
					$tonghao = $tonghao + $item["hao"];
					$tongdu = $tongdu + $item["du"];
					$tongvangsaunau = $tongvangsaunau + $item["cannangv"];				
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,$j);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,date_format(date_create($item[$datedNX]),"d/m/Y"));
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,getNameAll('bot_khobot', 'maphieu', $item["idchonphieunhap"]));				
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$item['maphieu']);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$loaivang);
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$item["cannangvh"]);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$item["cannangh"]);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,$item["cannangv"]);	
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,$loaiphong);				
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$numRow,$item["ghichuvang"]);
					$numRow++;
					$j++;		
					}			
				}
			//tổng theo loại vàng
			$dongFirst = $numRow;
			foreach($rstongloaivang as $vltongloaivang){
				if($vltongloaivang['idloaivang'] > 0){
					$tenloaivang = getNameAll('loaivang', 'name_vn', $vltongloaivang['idloaivang']);
					}						
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$tenloaivang);	
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$vltongloaivang["cannangvh"]);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$vltongloaivang["cannangh"]);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,$vltongloaivang["cannangv"]);
				$numRow++;
				}
			$dongLast = $numRow;
			//tổng vàng			
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,'Tổng tất cả: ');				
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$rstong["cannangvh"]);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$rstong["cannangh"]);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,$rstong["cannangv"]);
			//định dạng nội dung Excel
			//set chiều rộng cột//
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('j')->setAutoSize(true);
			//set chiều cao dòng+ border//	
			for($vtDong = 1; $vtDong <= $numRow; $vtDong++){
					$objPHPExcel->getActiveSheet()->getRowDimension($vtDong)->setRowHeight(25);	
					$objPHPExcel->getActiveSheet()->getStyle('A1:J'.$vtDong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
					$objPHPExcel->getActiveSheet()->getStyle('A2:J'.$vtDong)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					if($vtDong >=3 ){				
						for($char = 'A'; $char <= 'J'; $char++) {					
							$objPHPExcel->getActiveSheet()->getStyle($char.$vtDong)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);					
							}
						if($vtDong % 2 != 0){
							$objPHPExcel->getActiveSheet()->getStyle('A'.$vtDong.':J'.$vtDong)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('f9f9f9');
							}
					}
				}
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
			//set align cho từng dòng//
			$objPHPExcel->getActiveSheet()->getStyle('A4:D'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('A4:B'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('E4:H'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle('I4:J'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('E4:E'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('F4:H'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.000');
			//set kiểu chữ và size chung//
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
			$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
			//set font cho từng dòng//
			$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
			$objPHPExcel->getActiveSheet()->mergeCells('A2:J2');		
			$objPHPExcel->getActiveSheet()->getStyle('A1:J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setSize(17);
			$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getFont()->setSize(14); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A1:J3')->getFont()->setBold(true); //Tô đậm chữ
			$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('d7d7db');                                                                                                                       // backgroundcolor
			//set cho các dòng Tổng Vàng
			$objPHPExcel->getActiveSheet()->getStyle('A'.$dongFirst.':J'.$dongLast)->getFont()->setSize(13);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$dongFirst.':J'.$dongLast)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$dongFirst.':D'.$dongLast);
			$objPHPExcel->getActiveSheet()->mergeCells('I'.$dongFirst.':J'.$dongLast);
			//tạo tên file Excel	
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
			PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
			exit();
			}		
	break;
	//=================================THÊM KHO KHÁC LƯU MẪU====================================================//
	case"nhapkhoVangKKLM":
			$wh = '';
			if(!empty($fromdays)){
				$fromDate = explode('/',$fromdays);
				$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];				
			}
			if(!empty($todays)){
				$toDate = explode('/',$todays);
				$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];			
			}		
			if(ceil($idloaivang) > 0){
				$wh.=' and idloaivang =  '.$idloaivang.' ';
			}
			$sqlFrom = " from $GLOBALS[db_sp].khokhac_luumau";	
			$sqlRound = " ROUND(SUM(cannangvh), 3) as cannangvh,
						  ROUND(SUM(cannangh), 3) as cannangh,
						  ROUND(SUM(cannangv), 3) as cannangv ";		
			$sqlGroupOrder = " group by idloaivang
							   order by idloaivang asc";		
			
			$titleExcle = 'KhoKhac-LuuMau-ThongKe-NhapKho';
			$setTitle = 'KhoKhac-LuuMau-ThongKe-NhapKho';	
			$sqlWhere = " where type=1 and typechuyen=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh ";
			$datedXuatChuyen = "datedxuat";
			$sql = "select * ".$sqlFrom.$sqlWhere.$sqlDatedXuat."
					order by datedxuat desc, id desc"; 
			$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlGroupOrder; //tổng theo loại vàng
			$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere; //sql tính tổng cân nặng vàng
			$sql_sum = "select count(id) ".$sqlFrom.$sqlWhere;	
				
			$total = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = 100;
			$num_page = ceil($total/$num_rows_page);		
			
			//khởi tạo objPHPExcel
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle($setTitle);
			//gán giá trị cho tiêu đề	
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'KHO KHÁC LƯU MẪU THỐNG KÊ NHẬP KHO');
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Từ ngày: '.$fromdays.' - Đến ngày: '.$todays);		
			$objPHPExcel->getActiveSheet()->setCellValue('A3', 'STT');	
			$objPHPExcel->getActiveSheet()->setCellValue('B3', 'NGÀY NHẬP');	
			$objPHPExcel->getActiveSheet()->setCellValue('C3', 'MÃ PHIẾU');
			$objPHPExcel->getActiveSheet()->setCellValue('D3', 'LOẠI VÀNG');		
			$objPHPExcel->getActiveSheet()->setCellValue('E3', 'CÂN NẶNG V+H');
			$objPHPExcel->getActiveSheet()->setCellValue('F3', 'CÂN NẶNG H');
			$objPHPExcel->getActiveSheet()->setCellValue('G3', 'CÂN NẶNG V');
			$objPHPExcel->getActiveSheet()->setCellValue('H3', 'PHÒNG SX');
			$objPHPExcel->getActiveSheet()->setCellValue('I3','MÃ ĐH' );
			$objPHPExcel->getActiveSheet()->setCellValue('J3', 'GHI CHÚ');			
			
			//lấy chi tiết phiếu			
			$numRow = 4;		
			$j = 1;
			$i=0;
			$tenlv = $maPN = "";
			$tonghao = $tongdu = $tongvangxuat = 0;	
			for($i=1; $i<=$num_page; $i++){		
				$begin = ($i - 1)*$num_rows_page;
				$sql .= ' limit '.$begin.','.$num_rows_page;					
				$rs = $GLOBALS["sp"]->getAll($sql);							
				foreach($rs as $item){	
					$maPN = getNameAll("khokhac_luumau","maphieu",$item['idpnk']);
					$tenlv = getNameAll("loaivang","name_vn",$item['idloaivang']);			
																	
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,$j);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,date("d/m/Y",strtotime($item['dated'])));
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$item['maphieu']);									
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$tenlv);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$item["cannangvh"]);							
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$item['cannangh']);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$item["cannangv"]);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,getLinkTitle($item['chonphongbanin'],1));
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,getNamMaDonHangCatalog($item['madhin']));
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$numRow,$item["ghichuvang"]);
					$numRow++;	
					$j++;					
					}
				}			
				//tông vàng theo loại vàng	
				$dongFirst = $numRow;				
				$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);
				foreach($rstongloaivang as $vltongloaivang){
					$tenloaivang = getNameAll('loaivang', 'name_vn', $vltongloaivang['idloaivang']);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$tenloaivang);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$vltongloaivang['cannangvh']);
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$vltongloaivang['cannangh']);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$vltongloaivang['cannangv']);											
					$numRow++;
					}
				//tổng cân nặng vàng
				$dongLast = $numRow;		
				$rstong = $GLOBALS['sp']->getRow($sql_tong);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,'Tổng tất cả: ');
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$rstong['cannangvh']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$rstong['cannangh']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$rstong['cannangv']);	
				//////kết thúc tính tổng			
			//định dạng nội dung Excel
			//set chiều rộng cột//
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
			//set chiều cao dòng+ border//	
			for($vtDong = 1; $vtDong <= $numRow; $vtDong++){
					$objPHPExcel->getActiveSheet()->getRowDimension($vtDong)->setRowHeight(25);	
					$objPHPExcel->getActiveSheet()->getStyle('A1:J'.$vtDong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
					$objPHPExcel->getActiveSheet()->getStyle('A2:J'.$vtDong)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					if($vtDong >=3 ){				
						for($char = 'A'; $char <= 'J'; $char++) {					
							$objPHPExcel->getActiveSheet()->getStyle($char.$vtDong)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);					
							}
						if($vtDong % 2 != 0){
							$objPHPExcel->getActiveSheet()->getStyle('A'.$vtDong.':J'.$vtDong)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('f9f9f9');
							}
					}
				}		
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
			//set kiểu chữ và size chung//
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
			$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
			//set align cho từng dòng//		
			$objPHPExcel->getActiveSheet()->getStyle('A4:B'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('D4:G'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle('D4:D'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('E4:G'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.000');	
			
			//set font cho từng dòng
			$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
			$objPHPExcel->getActiveSheet()->mergeCells('A2:J2');		
			$objPHPExcel->getActiveSheet()->getStyle('A1:J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setSize(17); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getFont()->setSize(14); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A1:J3')->getFont()->setBold(true); //Tô đậm chữ
			$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('d7d7db');                                                                                                                       // backgroundcolor
			//set cho các dòng Tổng Vàng
			$objPHPExcel->getActiveSheet()->getStyle('A'.$dongFirst.':J'.$dongLast)->getFont()->setSize(13);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$dongFirst.':J'.$dongLast)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$dongFirst.':C'.$dongLast);
			$objPHPExcel->getActiveSheet()->mergeCells('H'.$dongFirst.':J'.$dongLast);	
				
			//tạo tên file Excel		
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
			PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
			exit();
		//===================================//
		case"xuatkhoVangKKLM":
			$wh = '';
			if(!empty($fromdays)){
				$fromDate = explode('/',$fromdays);
				$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];				
			}
			if(!empty($todays)){
				$toDate = explode('/',$todays);
				$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];			
			}		
			if(ceil($idloaivang) > 0){
				$wh.=' and idloaivang =  '.$idloaivang.' ';
			}
			$sqlFrom = " from $GLOBALS[db_sp].khokhac_luumau";	
			$sqlRound = " ROUND(SUM(cannangvh), 3) as cannangvh,
						  ROUND(SUM(cannangh), 3) as cannangh,
						  ROUND(SUM(cannangv), 3) as cannangv ";		
			$sqlGroupOrder = " group by idloaivang
							   order by idloaivang asc";		
			
			$titleExcle = 'KhoKhac-LuuMau-ThongKe-XuatKho';
			$setTitle = 'KhoKhac-LuuMau-ThongKe-XuatKho';	
			$sqlWhere = " where type=3 and trangthai=2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh ";
			$datedXuatChuyen = "datedxuat";
			$sql = "select * ".$sqlFrom.$sqlWhere.$sqlDatedXuat."
					order by datedxuat desc, id desc"; 
			$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlGroupOrder; //tổng theo loại vàng
			$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere; //sql tính tổng cân nặng vàng
			$sql_sum = "select count(id) ".$sqlFrom.$sqlWhere;	
				
			$total = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = 100;
			$num_page = ceil($total/$num_rows_page);		
			
			//khởi tạo objPHPExcel
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle($setTitle);
			//gán giá trị cho tiêu đề	
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'KHO KHÁC LƯU MẪU THỐNG KÊ XUẤT KHO');
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Từ ngày: '.$fromdays.' - Đến ngày: '.$todays);		
			$objPHPExcel->getActiveSheet()->setCellValue('A3', 'STT');	
			$objPHPExcel->getActiveSheet()->setCellValue('B3', 'NGÀY XUẤT');	
			$objPHPExcel->getActiveSheet()->setCellValue('C3', 'MÃ PHIẾU');
			$objPHPExcel->getActiveSheet()->setCellValue('D3', 'MÃ PHIẾU NHẬP KHO');		
			$objPHPExcel->getActiveSheet()->setCellValue('E3', 'LOẠI VÀNG');
			$objPHPExcel->getActiveSheet()->setCellValue('F3', 'CÂN NẶNG V+H');
			$objPHPExcel->getActiveSheet()->setCellValue('G3', 'CÂN NẶNG H');
			$objPHPExcel->getActiveSheet()->setCellValue('H3', 'CÂN NẶNG V');
			$objPHPExcel->getActiveSheet()->setCellValue('I3', 'PHÒNG SX');
			$objPHPExcel->getActiveSheet()->setCellValue('J3', 'MÃ ĐH');			
			$objPHPExcel->getActiveSheet()->setCellValue('K3', 'GHI CHÚ');
			
			//lấy chi tiết phiếu			
			$numRow = 4;		
			$j = 1;
			$i=0;
			$tenlv = $maPN = "";
			$tonghao = $tongdu = $tongvangxuat = 0;	
			for($i=1; $i<=$num_page; $i++){		
				$begin = ($i - 1)*$num_rows_page;
				$sql .= ' limit '.$begin.','.$num_rows_page;					
				$rs = $GLOBALS["sp"]->getAll($sql);							
				foreach($rs as $item){	
					$maPN = getNameAll("khokhac_luumau","maphieu",$item['idpnk']);
					$tenlv = getNameAll("loaivang","name_vn",$item['idloaivang']);			
																	
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,$j);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,date("d/m/Y",strtotime($item['datedxuat'])));
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$item['maphieu']);									
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$maPN);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$tenlv);							
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$item["cannangvh"]);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$item['cannangh']);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,$item["cannangv"]);
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,getLinkTitle($item['chonphongbanin'],1));
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$numRow,getNamMaDonHangCatalog($item['madhin']));
					$objPHPExcel->getActiveSheet()->setCellValue('K'.$numRow,$item["ghichuvang"]);				
					$numRow++;	
					$j++;					
					}
				}			
				//tông vàng theo loại vàng	
				$dongFirst = $numRow;				
				$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);
				foreach($rstongloaivang as $vltongloaivang){
					$tenloaivang = getNameAll('loaivang', 'name_vn', $vltongloaivang['idloaivang']);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$tenloaivang);
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$vltongloaivang['cannangvh']);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$vltongloaivang['cannangh']);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,$vltongloaivang['cannangv']);											
					$numRow++;
					}
				//tổng cân nặng vàng
				$dongLast = $numRow;		
				$rstong = $GLOBALS['sp']->getRow($sql_tong);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,'Tổng tất cả: ');
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$rstong['cannangvh']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$rstong['cannangh']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,$rstong['cannangv']);	
				//////kết thúc tính tổng			
			//định dạng nội dung Excel
			//set chiều rộng cột//
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);	
			//set chiều cao dòng+ border//	
			for($vtDong = 1; $vtDong <= $numRow; $vtDong++){
					$objPHPExcel->getActiveSheet()->getRowDimension($vtDong)->setRowHeight(25);	
					$objPHPExcel->getActiveSheet()->getStyle('A1:K'.$vtDong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
					$objPHPExcel->getActiveSheet()->getStyle('A2:K'.$vtDong)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					if($vtDong >=3 ){				
						for($char = 'A'; $char <= 'K'; $char++) {					
							$objPHPExcel->getActiveSheet()->getStyle($char.$vtDong)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);					
							}
						if($vtDong % 2 != 0){
							$objPHPExcel->getActiveSheet()->getStyle('A'.$vtDong.':K'.$vtDong)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('f9f9f9');
							}
					}
				}		
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
			//set kiểu chữ và size chung//
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
			$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
			//set align cho từng dòng//		
			$objPHPExcel->getActiveSheet()->getStyle('A4:B'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('C4:C'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('E4:H'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle('E4:E'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('F4:H'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.000');	
			
			//set font cho từng dòng
			$objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
			$objPHPExcel->getActiveSheet()->mergeCells('A2:K2');		
			$objPHPExcel->getActiveSheet()->getStyle('A1:K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(17); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A2:K2')->getFont()->setSize(14); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A1:K3')->getFont()->setBold(true); //Tô đậm chữ
			$objPHPExcel->getActiveSheet()->getStyle('A3:K3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('d7d7db');                                                                                                                       // backgroundcolor
			//set cho các dòng Tổng Vàng
			$objPHPExcel->getActiveSheet()->getStyle('A'.$dongFirst.':K'.$dongLast)->getFont()->setSize(13);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$dongFirst.':K'.$dongLast)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$dongFirst.':D'.$dongLast);
			$objPHPExcel->getActiveSheet()->mergeCells('I'.$dongFirst.':K'.$dongLast);	
				
			//tạo tên file Excel		
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
			PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
			exit();
		break;
		//================//
		case"nhapHaoDuVangKKLM":
			$wh = '';
			if(!empty($fromdays)){
				$fromDate = explode('/',$fromdays);
				$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];				
			}
			if(!empty($todays)){
				$toDate = explode('/',$todays);
				$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];			
			}		
			if(ceil($idloaivang) > 0){
				$wh.=' and idloaivang =  '.$idloaivang.' ';
			}
			$sqlFrom = " ";	
			$sqlRound = "  ";		
			$sqlGroupOrder = " group by idloaivang
							   order by idloaivang asc";		
			
			$titleExcle = 'KhoKhac-LuuMau-ThongKe-HaoDu';
			$setTitle = 'KhoKhac-LuuMau-ThongKe-HaoDu';	
			$sqlWhere = "  ";
			$sql = "select * 
					from $GLOBALS[db_sp].khokhac_luumauhaodu 
					where dated >= '".$fromDate."' and dated <= '".$toDate."' $wh
					order by  numphieu asc, dated asc"; 
			$sql_tong = "select ROUND(SUM(haochenhlech), 3) as haochenhlech,
								ROUND(SUM(duchenhlech), 3) as duchenhlech
						 from $GLOBALS[db_sp].khokhac_luumauhaodu 
						 where dated >= '".$fromDate."' and dated <= '".$toDate."' $wh";
			$sql_sum = "select count(id) 
			            from $GLOBALS[db_sp].khokhac_luumauhaodu 
						where dated >= '".$fromDate."' and dated <= '".$toDate."' $wh";	
				
			$total = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = 100;
			$num_page = ceil($total/$num_rows_page);		
			
			//khởi tạo objPHPExcel
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle($setTitle);
			
			//gán giá trị cho tiêu đề	
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'KHO KHÁC LƯU MẪU THỐNG KÊ HAO DƯ');
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Từ ngày: '.$fromdays.' - Đến ngày: '.$todays);		
			$objPHPExcel->getActiveSheet()->setCellValue('A3', 'STT');	
			$objPHPExcel->getActiveSheet()->setCellValue('B3', 'NGÀY XUẤT');	
			$objPHPExcel->getActiveSheet()->setCellValue('C3', 'MÃ PHIẾU');
			$objPHPExcel->getActiveSheet()->setCellValue('D3', 'MÃ PHIẾU NHẬP KHO');		
			$objPHPExcel->getActiveSheet()->setCellValue('E3', 'LOẠI VÀNG');
			$objPHPExcel->getActiveSheet()->setCellValue('F3', 'HAO CHÊNH LỆCH');
			$objPHPExcel->getActiveSheet()->setCellValue('G3', 'DƯ CHÊNH LỆCH');	
			$objPHPExcel->getActiveSheet()->setCellValue('H3', 'MÃ ĐH');		
			$objPHPExcel->getActiveSheet()->setCellValue('I3', 'GHI CHÚ');
			
			//lấy chi tiết phiếu			
			$numRow = 4;		
			$j = 1;
			$i=0;
			$tenlv = $maPN = "";
			$tonghao = $tongdu = $tongvangxuat = 0;	
			for($i=1; $i<=$num_page; $i++){		
				$begin = ($i - 1)*$num_rows_page;
				$sql .= ' limit '.$begin.','.$num_rows_page;					
				$rs = $GLOBALS["sp"]->getAll($sql);							
				foreach($rs as $item){	
					$maPN = getNameAll("khokhac_luumau","maphieu",$item['idpnk']);
					$tenlv = getNameAll("loaivang","name_vn",$item['idloaivang']);			
																	
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,$j);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,date("d/m/Y",strtotime($item['dated'])));
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$item['maphieu']);									
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$maPN);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$tenlv);							
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$item["haochenhlech"]);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$item['duchenhlech']);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,getNamMaDonHangCatalog(getNameAll("khokhac_luumau","madhin",$item['idpnk'])));
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,$item["ghichu"]);				
					$numRow++;	
					$j++;					
					}
				}			
			$dongLast = $numRow;		
			$rstong = $GLOBALS['sp']->getRow($sql_tong);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,'Tổng tất cả: ');
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$rstong['haochenhlech']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$rstong['duchenhlech']);
			
			//////kết thúc tính tổng			
			//định dạng nội dung Excel
			//set chiều rộng cột//
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);	
			//set chiều cao dòng+ border//	
			for($vtDong = 1; $vtDong <= $numRow; $vtDong++){
					$objPHPExcel->getActiveSheet()->getRowDimension($vtDong)->setRowHeight(25);	
					$objPHPExcel->getActiveSheet()->getStyle('A1:I'.$vtDong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
					$objPHPExcel->getActiveSheet()->getStyle('A2:I'.$vtDong)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					if($vtDong >=3 ){				
						for($char = 'A'; $char <= 'I'; $char++) {					
							$objPHPExcel->getActiveSheet()->getStyle($char.$vtDong)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);					
							}
						if($vtDong % 2 != 0){
							$objPHPExcel->getActiveSheet()->getStyle('A'.$vtDong.':I'.$vtDong)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('f9f9f9');
							}
					}
				}		
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
			//set kiểu chữ và size chung//
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
			$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
			//set align cho từng dòng//		
			$objPHPExcel->getActiveSheet()->getStyle('A4:B'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('E4:G'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle('E4:E'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('F4:G'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.000');	
			
			//set font cho từng dòng
			$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
			$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');		
			$objPHPExcel->getActiveSheet()->getStyle('A1:I3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(17); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getFont()->setSize(14); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A1:I3')->getFont()->setBold(true); //Tô đậm chữ
			$objPHPExcel->getActiveSheet()->getStyle('A3:I3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('d7d7db'); 
			//tạo tên file Excel		
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
			PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
			exit();
		break;
	//===================================KẾT THÚC KHO KHÁC LƯU MẪU===================================================//
	///////////////////////////////////////////KẾT THÚC VŨ THÊM//////////////////////////////////////////////////////		
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