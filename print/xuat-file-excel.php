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
	$type = isset($_REQUEST['type'])?$_REQUEST['type']:'';
	
	$fromdays = trim($_GET['fromdays']);
	$todays = trim($_GET['todays']);
	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";	
	$table = isset($_REQUEST['table'])?$_REQUEST['table']:"kho_giamdockynhan";
	$idloaivang = ceil(trim($_REQUEST['idloaivang']));
	
	switch($act){
		case"KhoSanXuatNhapXuatHaoDu":
			$wh = '';
			if($cid > 0){
				$titlegiao = getLinkTitle($cid,1);
				if(!empty($titlegiao)){
					$titlegiao = explode('-',$titlegiao);
					$setTitle = $titlegiao[1];	
				}
			}
			if(!empty($fromdays)){
				$fromDate = explode('/',$fromdays);
				$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
				$wh.=' and dated >= "'.$fromDate.'"  ';
			}
			if(!empty($todays)){
				$toDate = explode('/',$todays);
				$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
				$wh.=' and dated <= "'.$toDate.'" ';
			}
			if($idloaivang > 0){
				$wh.=' and idloaivang = '.$idloaivang.'  ';
			}
			
			$sql_sum = "select count(id) from $GLOBALS[db_sp].".$table." where 1=1 $wh";
			
			$total = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = 100;
			$num_page = ceil($total/$num_rows_page);
			
			$titleExcle = $type;
			$setTitle = $setTitle;
	
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle($setTitle);
			
			$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(100);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			
			$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(13); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true); //Tô đậm chữ
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $ngay);
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'MÃ PHIẾU');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'LOẠI VÀNG');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'HAO');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'DƯ');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'HAO CHÊNH LỆCH');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'DƯ CHÊNH LỆCH');
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'GHI CHÚ');
			$objPHPExcel->getActiveSheet()->setCellValue('I1', 'MÃ PHIẾU NHẬP');
			$numRow = 2;
			
			for($i=1; $i<=$num_page; $i++){
				$begin = ($i - 1)*$num_rows_page;
				$sql = "select * from $GLOBALS[db_sp].".$table." where 1=1 $wh order by idloaivang asc, dated desc, id desc";
				$rs = $GLOBALS["sp"]->getAll($sql);
				
				foreach($rs as $item){
					if(ceil($item['madhin']) > 0){
						$titledhsx = getNamMaDonHangCatalog($item['madhin']);
					}	
					
					$maphieunhap = '';
					if(ceil($item['idpnk']) > 0){
						$maphieunhap =	getNameAll('khosanxuat_khothanhpham', 'maphieu', $item['idpnk']);
					}
					
					$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$numRow.':F'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow, $dated);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow, $item['maphieu']);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow, getNameAll('loaivang', 'name_vn', $item['idloaivang']));
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,number_format($item["hao"],3,".",","));
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,number_format($item["du"],3,".",","));
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,number_format($item["haochenhlech"],3,".",","));
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,number_format($item["duchenhlech"],3,".",","));
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,$item['ghichu']);
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,$maphieunhap);
					
					//$objPHPExcel->getActiveSheet()->setCellValue('O'.$numRow,number_format($item["dongiaban"],3,".",","));
	
					$numRow++;		
				}
			}	
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
			PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
			exit();
		break;
		
		case"KhoSanXuatNhapXuat":
			$wh = '';
			if($cid > 0){
				$titlegiao = getLinkTitle($cid,1);
				if(!empty($titlegiao)){
					$titlegiao = explode('-',$titlegiao);
					$setTitle = $titlegiao[1];	
				}
			}
			if(!empty($fromdays)){
				$fromDate = explode('/',$fromdays);
				$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
				if($type == 'nhapkho')
					$wh.=' and datechuyen >= "'.$fromDate.'"  ';
				else // xuất kho
					$wh.=' and datedxuat >= "'.$fromDate.'"  ';
			}
			if(!empty($todays)){
				$toDate = explode('/',$todays);
				$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
				if($type == 'nhapkho')
					$wh.=' and datechuyen <= "'.$toDate.'" ';
				else // xuất kho
					$wh.=' and datedxuat <= "'.$toDate.'"  ';
			}
			if($idloaivang > 0){
				$wh.=' and idloaivang = '.$idloaivang.'  ';
			}
			
			if($type == 'nhapkho'){
				$ngay = "NGÀY NHẬP";
				$NamePhongChuyen = 'Phòng Chuyển';
				$sql_sum = "select count(id) from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 $wh";	
			}
			else{// xuất kho
				$ngay = "NGÀY XUẤT";
				$NamePhongChuyen = 'Phòng SX';
				$sql_sum = "select count(id) from $GLOBALS[db_sp].".$table." where type in(2,3) $wh";	
			}
			$total = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = 100;
			$num_page = ceil($total/$num_rows_page);
			
			$titleExcle = $type;
			$setTitle = $setTitle;
	
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle($setTitle);
			
			$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(60);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(100);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			
			$objPHPExcel->getActiveSheet()->getStyle('A1:j1')->getFont()->setSize(13); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A1:j1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:j1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:j1')->getFont()->setBold(true); //Tô đậm chữ
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $ngay);
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'MÃ PHIẾU');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'LOẠI VÀNG');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'CÂN NẶNG V+H');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'CÂN NẶNG H');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'CÂN NẶNG V');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', $NamePhongChuyen);
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'MÃ ĐƠN HÀNG');
			$objPHPExcel->getActiveSheet()->setCellValue('I1', 'GHI CHÚ');
			$objPHPExcel->getActiveSheet()->setCellValue('j1', 'MÃ PHIẾU NHẬP');
			$numRow = 2;
			
			for($i=1; $i<=$num_page; $i++){
				$begin = ($i - 1)*$num_rows_page;
				if($type == 'nhapkho'){
					$sql = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 $wh order by numphieu asc, datechuyen asc limit $begin,$num_rows_page";	
				}
				else{// xuất kho
					$sql = "select * from $GLOBALS[db_sp].".$table." where type in(2,3) $wh order by numphieu asc, datedxuat asc limit $begin,$num_rows_page";	
				}
				$rs = $GLOBALS["sp"]->getAll($sql);
				
				foreach($rs as $item){
					$phongchuyen = $titledhsx = '';
					if($type == 'nhapkho'){
						$dated = date("d/m/Y", strtotime($item['datechuyen']));
						if($item['cidchuyen'] > 0){ 
							$phongchuyen = getLinkTitle($item['cidchuyen'],1);
							
						}
					}
					else{// xuất kho
						$dated = date("d/m/Y", strtotime($item['datedxuat']));	
						if($item['chonphongbanin'] > 0){ 
							$phongchuyen = getLinkTitle($item['chonphongbanin'],1);
							
						}
					}
					if(ceil($item['madhin']) > 0){
						$titledhsx = getNamMaDonHangCatalog($item['madhin']);
					}	
					
					$maphieunhap = '';
					if(ceil($item['idpnk']) > 0){
						$maphieunhap =	getNameAll('khosanxuat_khothanhpham', 'maphieu', $item['idpnk']);
					}
					
					$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$numRow.':F'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow, $dated);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow, $item['maphieu']);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow, getNameAll('loaivang', 'name_vn', $item['idloaivang']));
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,number_format($item["cannangvh"],3,".",","));
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,number_format($item["cannangh"],3,".",","));
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,number_format($item["cannangv"],3,".",","));
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$phongchuyen);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,$titledhsx);
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,$item['ghichuvang']);
					$objPHPExcel->getActiveSheet()->setCellValue('j'.$numRow, $maphieunhap);
					
					//$objPHPExcel->getActiveSheet()->setCellValue('O'.$numRow,number_format($item["dongiaban"],3,".",","));
	
					$numRow++;		
				}
			}	
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
			PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
			exit();
		break;
		case"khoLuuTruKhoNguonVao":
			$wh = '';
			if($cid > 0){
				$wh.=" and ( cid= ".$cid." or cid = ".$idname.") ";	
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
			
			$sql_sum = " select count(id) from $GLOBALS[db_sp].".$table." where type=2 and typevkc=".$typevkc." $wh ";
			
			$total = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = 100;
			$num_page = ceil($total/$num_rows_page);
			
			$titleExcle = 'Danh-Muc-Hot-Xoan';
			$setTitle = 'Danh Mục Hột Xoànn';
	
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle($setTitle);
			
			$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
			
			$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->getFont()->setSize(13); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true); //Tô đậm chữ
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'In');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Cửa hàng');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Loại nữ trang');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Mã nữ trang');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Tên');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Ngày kiểm định');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Mã số kiểm định');
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Mã số cạnh');
			$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Kích thước');
			$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Trọng lượng');
			$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Độ tinh khiết');
			$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Cấp độ màu');
			$objPHPExcel->getActiveSheet()->setCellValue('M1', 'Độ mài bóng');
			$objPHPExcel->getActiveSheet()->setCellValue('N1', 'Kích thước bán');
			$objPHPExcel->getActiveSheet()->setCellValue('O1', 'Đơn giá bán');
			$numRow = 2;
			
			for($i=1; $i<=$num_page; $i++){
				$begin = ($i - 1)*$num_rows_page;
				$sql = "select * from $GLOBALS[db_sp].".$table." where type=2 and typevkc=".$typevkc." $wh order by idkimcuong asc , datechuyen asc limit $begin,$num_rows_page";
				$rs = $GLOBALS["sp"]->getAll($sql);
				
				foreach($rs as $item){
					$capdomau = $kichthuocban = '';
					if($item['idkimcuong'] > 0){
						$capdomau = getNameAll('loaikimcuonghotchu', 'name_vn', $item['idkimcuong']);
						$kichthuocban = getNameAll('loaikimcuonghotchu', 'size', $item['idkimcuong']);
					}
					$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':O'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':O'.$numRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow, '');
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow, '');
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow, 'HX');
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow, '');
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow, 'HX');
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,'');
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$item['codegdpnj']);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow,$item['codecgta']);
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,$item['kichthuoc']);
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$numRow,$item['trongluonghot']);
					$objPHPExcel->getActiveSheet()->setCellValue('K'.$numRow,$item['dotinhkhiet']);
					$objPHPExcel->getActiveSheet()->setCellValue('L'.$numRow,$capdomau);
					$objPHPExcel->getActiveSheet()->setCellValue('M'.$numRow,$item['domaibong']);
					$objPHPExcel->getActiveSheet()->setCellValue('N'.$numRow,$kichthuocban);
					$objPHPExcel->getActiveSheet()->setCellValue('O'.$numRow,number_format($item["dongiaban"],3,".",","));
	
					$numRow++;		
				}
			}	
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
			PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
			exit();
		break;	
		//===================VŨ THÊM KHO SẢN XUẤT PHỤ KIỆN==================================//
		case "KhoSanXuatPhuKienXuatKho":
		case "KhoSanXuatPhuKienNhapKho":
			$wh = $fromDate = $toDate = '';
			if(!empty($fromdays)){
				$fromDate = explode('/',$fromdays);
				$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];				
				}
			if(!empty($todays)){
				$toDate = explode('/',$todays);
				$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];			
				}		
			if(ceil($idloaivang) > 0){
				$wh.=' and idloaivang =  '.$idloaivang;
				}
				
			$sqlFrom = " from $GLOBALS[db_sp].khosanxuat_phukien ";	
			$sqlRound = " ROUND(SUM(cannangv), 3) as cannangv ";		
			$sqlGroupOrder = " group by idloaivang
							   order by idloaivang asc";
			$titleExcle = $setTitle = $tieudeNoiDung = $typePhong = "";
			$sqlWhere = $sqlDatedChuyen = $sqlOrderDatedChuyen = $sqlOrderDatedChuyen = $datedXuatChuyen = "";
			$sql = $sql_tongloaivang = $sql_tong = $sql_sum = "";
			
			if($act == "KhoSanXuatPhuKienNhapKho"){
				$titleExcle = 'KhoSanXuat-KhoPhuKien-ThongKe-NhapKho';
				$setTitle = 'KhoSanXuat-KhoPhuKien-ThongKe-NhapKho';
				$tieudeNoiDung = 'KHO SẢN XUẤT KHO PHỤ KIỆN THỐNG KÊ NHẬP KHO';
				$sqlWhere = " where type=1 and typechuyen=2 $wh ";
				$sqlDatedChuyen = " and datechuyen >= '".$fromDate."' and datechuyen <= '".$toDate."' ";
				$sqlOrderDatedChuyen = " order by datechuyen desc, id desc ";
				$datedXuatChuyen = "datechuyen";
				$sql = "select *".$sqlFrom.$sqlWhere.$sqlDatedChuyen.$sqlOrderDatedChuyen;//sql lấy bột nấu chờ nhập kho
				$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlDatedChuyen.$sqlGroupOrder;//tổng theo loại vàng
				$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere.$sqlDatedChuyen;	//sql tính tổng cân nặng vàng
				$sql_sum = "select count(id) ".$sqlFrom.$sqlWhere;//sql tính tổng dòng	
				$typePhong = "PHÒNG CHUYỂN";		
				}
			if($act == "KhoSanXuatPhuKienXuatKho"){
				$titleExcle = 'KhoSanXuat-KhoPhuKien-ThongKe-XuatKho';
				$setTitle = 'KhoSanXuat-KhoPhuKien-ThongKe-NhapKho';	
				$tieudeNoiDung = 'KHO SẢN XUẤT KHO PHỤ KIỆN THỐNG KÊ XUẤT KHO';
				$sqlDatedXuat = " and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' ";
				$sqlWhere = " where type=3 and trangthai=2 $wh ";
				$datedXuatChuyen = "datedxuat";
				$sql = "select * ".$sqlFrom.$sqlWhere.$sqlDatedXuat."
						order by datedxuat desc, id desc"; //sql lấy bột nấu chờ xuất kho
				$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlDatedXuat.$sqlGroupOrder; //tổng theo loại vàng
				$sql_tong = "select ROUND(SUM(cannangv), 3) as cannangv ".$sqlFrom.$sqlWhere.$sqlDatedXuat; //sql tính tổng cân nặng vàng
				$sql_sum = "select count(id) ".$sqlFrom.$sqlWhere;	
				$typePhong = "PHÒNG SX";
				}
			$total = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = 100;
			$num_page = ceil($total/$num_rows_page);	
			
			//khởi tạo objPHPExcel
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(0);
			//$objPHPExcel->getActiveSheet()->setTitle($setTitle);
			
			//gán giá trị cho tiêu đề	
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Từ ngày: '.$fromdays.' - Đến ngày: '.$todays);		
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $tieudeNoiDung);
			$objPHPExcel->getActiveSheet()->setCellValue('A3', 'STT');		
			$objPHPExcel->getActiveSheet()->setCellValue('B3', 'NGÀY XUẤT');
			$objPHPExcel->getActiveSheet()->setCellValue('C3', 'MÃ PHIẾU');
			$objPHPExcel->getActiveSheet()->setCellValue('D3', 'LOẠI VÀNG');
			$objPHPExcel->getActiveSheet()->setCellValue('E3', 'CÂN NẶNG V+H');
			$objPHPExcel->getActiveSheet()->setCellValue('F3', 'CÂN NẶNG H');
			$objPHPExcel->getActiveSheet()->setCellValue('G3', 'CÂN NẶNG V');
			$objPHPExcel->getActiveSheet()->setCellValue('H3', $typePhong);
			$objPHPExcel->getActiveSheet()->setCellValue('I3', 'MÃ ĐH');
			$objPHPExcel->getActiveSheet()->setCellValue('J3', 'GHI CHÚ');
			$objPHPExcel->getActiveSheet()->setCellValue('K3', 'MÃ PHỤ KIỆN');
			$objPHPExcel->getActiveSheet()->setCellValue('L3', 'TÊN PHỤ KIỆN');
			$objPHPExcel->getActiveSheet()->setCellValue('M3', 'SỐ LƯỢNG');
			//lấy chi tiết phiếu			
			$numRow = 4;		
			$j = 1;
			$i=0;
			$tonghao = $tongdu = $tongvangxuat = $tongvangsaunau = 0;	
			$typePhongChuyen = "";
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
					
					if($act == "KhoSanXuatPhuKienNhapKho"){
						$typePhongChuyen = $item["typekhodau"];
						}
					if($act == "KhoSanXuatPhuKienXuatKho"){
						$typePhongChuyen = getLinkTitle($item["chonphongbanin"],1);
						}							
					$maPK = getPhuKienCatalog($item['idphukien']);
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow,$j);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow,date("d/m/Y",strtotime($item[$datedXuatChuyen])));
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow,$item['maphieu']);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow,$loaivang);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow,$item["cannangvh"]);
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow,$item["cannangh"]);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow,$item["cannangv"]);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow, $typePhongChuyen);
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow,$item["madhin"]);
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$numRow,$item["ghichuvang"]);
					$objPHPExcel->getActiveSheet()->setCellValue('K'.$numRow,$maPK['code']);
					$objPHPExcel->getActiveSheet()->setCellValue('L'.$numRow,$maPK['name_vn']);
					$objPHPExcel->getActiveSheet()->setCellValue('M'.$numRow,$item['soluongphukien']);				
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
			$objPHPExcel->getActiveSheet()->getStyle('D4:G'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle('H4:J'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('K4:L'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('M4:M'.$dongLast)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle('E4:G'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.000');	
			$objPHPExcel->getActiveSheet()->getStyle('D4:D'.$dongLast)->getNumberFormat()->setFormatCode('#,##0.00');	
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
		//========================KẾT THÚC THÊM KHO SẢN XUẤT PHỤ KIỆN=============================//

		// M.Tân thêm export Excel các phiếu Nhập và các phiếu Xuất, Hao Dư sinh ra của Kho Thành Phẩm
		case "ExportExcelTongKhoThanhPham":

			$page = ceil(trim($_REQUEST['page']));

			if(!empty($fromdays)){
				$fromDate = explode('/',$fromdays);
				$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
				$wh.=' and datedxuat >= "'.$fromDate.'"  ';
			}
			if(!empty($todays)){
				$toDate = explode('/',$todays);
				$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
				$wh.=' and datedxuat <= "'.$toDate.'" ';
			}
			if($idloaivang > 0){
				$wh.=' and idloaivang = '.$idloaivang.'  ';
			}


			$titleExcle = 'View-Phieu-Nhap-Kho-Thanh-Pbam';
			$setTitle = 'View Phiếu Nhập Kho Thành Phẩm';
			
			$num_rows_page = 100;
			if($page > 0) {
				$begin = ($page - 1)*$num_rows_page;
			} else {
				$begin = (1 - 1)*$num_rows_page;
			}

			// Lấy ra distinct tất cả các id phiếu nhập
			$sqlidpnk = "select distinct(idpnk) from $GLOBALS[db_sp].".$table." where idpnk>0 $wh order by numphieu asc, datedxuat asc limit ".$begin.",".$num_rows_page;
			$rsidpnk = $GLOBALS["sp"]->getAll($sqlidpnk);

			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle($setTitle);

			$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');   
			$objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
					
			$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
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

			$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setSize(11); //Cỡ chữ
			$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true); //Tô đậm chữ
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Ngày Nhập');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Số Phiếu Nhập');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Loại Vàng');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Cân V+H Nhập');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Cân H Nhập');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Cân V Nhập');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Mã ĐH');
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Ngày Xuất');
			$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Số Phiếu Xuất');
			$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Cân V+H Xuất');
			$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Cân H Xuất');
			$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Cân V Xuất');
			
			$numRow = 2;

			foreach($rsidpnk as $itemidpnk){
				// Get phiếu nhập kho
				$sqlpnk = "select * from $GLOBALS[db_sp].khosanxuat_khothanhpham where id=".$itemidpnk['idpnk'];
				$rspnk = $GLOBALS["sp"]->getAll($sqlpnk);		

				foreach($rspnk as $itempnk){

					$objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':C'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$numRow.':F'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					$objPHPExcel->getActiveSheet()->getStyle('G'.$numRow.':G'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow, date("d/m/Y", strtotime($itempnk['dated'])));
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow, $itempnk['maphieu']);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow, getNameAll('loaivang', 'name_vn', $itempnk['idloaivang']));
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow, number_format($itempnk['cannangvh'],3,".",","));
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow, number_format($itempnk['cannangh'],3,".",","));
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow, number_format($itempnk['cannangv'],3,".",","));
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow, getNamMaDonHangCatalog($itempnk['madhin']));

					$numRow++;

					// Get các phiếu xuất kho được tạo từ phiếu nhập kho này
					$sqlpxk = "select * from $GLOBALS[db_sp].khosanxuat_khothanhpham where idpnk=".$itemidpnk['idpnk'];
					$rspxk = $GLOBALS["sp"]->getAll($sqlpxk);

					foreach($rspxk as $itempxk){

						$objPHPExcel->getActiveSheet()->getStyle('H'.$numRow.':I'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$objPHPExcel->getActiveSheet()->getStyle('J'.$numRow.':L'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

						$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow, date("d/m/Y", strtotime($itempxk['datedxuat'])));
						$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow, $itempxk['maphieu']);
						$objPHPExcel->getActiveSheet()->setCellValue('J'.$numRow, number_format($itempxk['cannangvh'],3,".",","));
						$objPHPExcel->getActiveSheet()->setCellValue('K'.$numRow, number_format($itempxk['cannangh'],3,".",","));
						$objPHPExcel->getActiveSheet()->setCellValue('L'.$numRow, number_format($itempxk['cannangv'],3,".",","));
						
						$numRow++;

					}

					// Get các phiếu hao dư được tạo từ phiếu nhập kho này
					$sqlhaodu = "select * from $GLOBALS[db_sp].khosanxuat_khothanhphamhaodu where idpnk=".$itemidpnk['idpnk'];
					$rshaodu = $GLOBALS["sp"]->getAll($sqlhaodu);

					foreach($rshaodu as $itemhaodu){

						if($itemhaodu['hao'] > 0 || $itemhaodu['haochenhlech'] > 0 ) {
							$varHaoDu = $itemhaodu['hao'] + $itemhaodu['haochenhlech'];
						} else {
							$varHaoDu = $itemhaodu['du'] + $itemhaodu['duchenhlech'];
							$varHaoDu = '-'.$varHaoDu;
						}

						$objPHPExcel->getActiveSheet()->getStyle('H'.$numRow.':I'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$objPHPExcel->getActiveSheet()->getStyle('J'.$numRow.':L'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

						$objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow, date("d/m/Y", strtotime($itemhaodu['dated'])));
						$objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow, $itemhaodu['maphieu']);
						$objPHPExcel->getActiveSheet()->setCellValue('J'.$numRow, number_format($varHaoDu,3,".",","));
						$objPHPExcel->getActiveSheet()->setCellValue('K'.$numRow, number_format(0,3,".",","));
						$objPHPExcel->getActiveSheet()->setCellValue('L'.$numRow, number_format($varHaoDu,3,".",","));
						
						$numRow++;

					}
	
				}
			}				

			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
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
	//=================//
	function getLinkTitle($cid,$live){
		global $path_url,$lang;
		$sql = "select * from $GLOBALS[db_sp].categories where id=$cid";
		$item = $GLOBALS["sp"]->getRow($sql);
		if($item["pid"] == 2)
			$str=$item["name_vn"];
		else{
			$str=' - ' .$item["name_vn"];			
		}
		if($item['pid'] != 2)
			return getLinkTitle($item["pid"],2).$str;	
		else
			return $str;	
	}
	//=================//
	function getPhuKienCatalog($id){
			$sql = "select * from $GLOBALS[db_catalog].products where id=".$id;
			$rs = $GLOBALS["catalog"]->getRow($sql);
			return $rs;
			}
	//================//
	function getNamMaDonHangCatalog($madhin){
		$rs = '';
		if($madhin > 0){
			$sql = "select code from $GLOBALS[db_catalog].ordersanxuat where id=".$madhin; 
			$rs = $GLOBALS["catalog"]->getOne($sql);
		}
		return $rs;	
	}
?>