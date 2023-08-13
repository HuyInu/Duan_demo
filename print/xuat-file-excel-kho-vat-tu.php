<?php
include_once("../#include/config.php");
require_once '../Classes-PHPExcel/PHPExcel.php';

$objPHPExcel = new PHPExcel();
$datenow = date("d-m-Y");

$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";	

// Show từ ngày đến ngày 
$showTuNgay = $_GET['fromdays'];
$showDenNgay = $_GET['todays'];
if(empty($showTuNgay)){
    $showTuNgay = date("d/m/Y");
}
if(empty($showDenNgay)){
    $showDenNgay = date("d/m/Y");
}

$cid = ceil(trim($_REQUEST['cid']));
$typephongban = ceil(trim($_REQUEST['typephongban']));

switch($act){
    case "danhmuckhovattu":
        $titleExcle = 'Danh-Muc-Kho-Vat-Tu';
        $setTitle = 'Danh Mục Kho Vật Tư';

        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle($setTitle);
        
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(60);
        
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setSize(13); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true); //Tô đậm chữ
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'MÃ');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'TÊN ĐỒ NGHỀ');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'ĐVT');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'NHÓM');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'ĐƠN GIÁ');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'NCC');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Mô tả đồ nghề');

        $wh = '';
		$mavattus = $_GET['mavattus'];
        $tenvattus = $_GET['tenvattus'];
        $nhacungcaps = $_GET['nhacungcaps'];
        $motavattus = $_GET['motavattus'];
        
        
        if(!empty($mavattus)){
            $wh.=' and mavattu like "%'.$mavattus.'%" ';
        }
        if(!empty($tenvattus)){
            $wh.=' and name_vn like "%'.$tenvattus.'%" ';
        }
        if(!empty($nhacungcaps)){
            $wh.=' and nhacungcap like "%'.$nhacungcaps.'%" ';
        }
        if(!empty($motavattus)){
            $wh.=' and noidung like "%'.$motavattus.'%" ';
        }

        $sql = "SELECT * FROM $GLOBALS[db_sp].loaivattu WHERE 1=1 $wh ORDER BY num asc, id asc";
        $rs = $GLOBALS["sp"]->getAll($sql);

        $numRow = 2; 

        foreach($rs as $item){
            
            $objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$numRow.':F'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow, $item['mavattu']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow, $item['name_vn']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow, $item['donvitinh']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow, $item['nhom']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow, number_format($item['dongia'],2,".",","));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow, $item['nhacungcap']);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow, $item['noidung']);
            
            $numRow++;
        }
        
        header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();
    break;

    case "ThongKeTonKho":
        
        // Lấy tên kho dựa vào typephongban
        $sqlphongban = "select * from $GLOBALS[db_sp].categories where id=".$typephongban;
        $rsphongban= $GLOBALS['sp']->getRow($sqlphongban);
        $namephongban = $rsphongban['name_vn'];
        $tablehachtoan = $rsphongban['tablehachtoan'];

        // Chuyển đổi tên phòng ban có dấu thành tên phòng ban không dấu
        $namePhongBanKhongDau = vn_to_str($namephongban);
                
        $titleExcle = 'Thong-Ke-Ton-Kho-'.$namePhongBanKhongDau;
        $setTitle = $namephongban.' - '.$datenow;

        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle($setTitle);

        $objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');   
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(11);

        $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(25);
        
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(17); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(13); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A3:E3')->getFont()->setSize(13); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A1:E3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:E3')->getFont()->setBold(true); //Tô đậm chữ
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(false);
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1', $namephongban.' THỐNG KÊ TỒN KHO');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Ngày: '.date("d/m/Y"));
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'HÌNH');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'MÃ VẬT TƯ');
        $objPHPExcel->getActiveSheet()->setCellValue('C3', 'TÊN VẬT TƯ');
        $objPHPExcel->getActiveSheet()->setCellValue('D3', 'ĐƠN VỊ TÍNH');
        $objPHPExcel->getActiveSheet()->setCellValue('E3', 'SỐ LƯỢNG TỒN KHO');

        $wh = '';
		$mavattus = $_GET['mavattus'];
        $tenvattus = $_GET['tenvattus'];
        $donvitinhs = $_GET['donvitinhs'];
        
        
        if(!empty($mavattus)){
            $wh.=' and b.mavattu like "%'.$mavattus.'%" ';
        }
        if(!empty($tenvattus)){
            $wh.=' and b.name_vn like "%'.$tenvattus.'%" ';
        }
        if(!empty($donvitinhs)){
            $wh.=' and b.donvitinh like "%'.$donvitinhs.'%" ';
        }

        $sql = "SELECT * from $GLOBALS[db_sp].".$tablehachtoan." as a LEFT JOIN $GLOBALS[db_sp].loaivattu as b on b.id=a.idmavattu WHERE dated=(select max(dated) from $GLOBALS[db_sp].".$tablehachtoan." WHERE idmavattu=a.idmavattu) $wh";
        $rs = $GLOBALS["sp"]->getAll($sql);

        $numRow = 4; 

        foreach($rs as $item){
            
            $objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$numRow.':E'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow, $item['']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow, $item['mavattu']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow, $item['name_vn']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow, $item['donvitinh']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow, number_format($item['soluongton'],2,".",","));
            
            $numRow++;
        }
        
        header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();

    break;

    case "ThongKeNhapXuatTonKho":

        // Lấy tên kho dựa vào typephongban
        $sqlphongban = "select * from $GLOBALS[db_sp].categories where id=".$typephongban;
        $rsphongban= $GLOBALS['sp']->getRow($sqlphongban);
        $namephongban = $rsphongban['name_vn'];
        $tablehachtoan = $rsphongban['tablehachtoan'];

        // Chuyển đổi tên phòng ban có dấu thành tên phòng ban không dấu
        $namePhongBanKhongDau = vn_to_str($namephongban);
                
        $titleExcle = 'Thong-Ke-Nhap-Xuat-Ton-Kho-'.$namePhongBanKhongDau;
        $setTitle = $namephongban.' - '.$datenow;

        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle($setTitle);

        $objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');   
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
        
        $objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(25);
       
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(33);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(33);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(33);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(33);

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(17); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(13); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A3:H3')->getFont()->setSize(11); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A1:H3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:H3')->getFont()->setBold(true); //Tô đậm chữ
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(false);
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1', $namephongban.' THỐNG KÊ NHẬP XUẤT TỒN KHO');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Từ ngày: '.$showTuNgay.' - Đến ngày: '.$showDenNgay);
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'HÌNH');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'MÃ VẬT TƯ');
        $objPHPExcel->getActiveSheet()->setCellValue('C3', 'TÊN VẬT TƯ');
        $objPHPExcel->getActiveSheet()->setCellValue('D3', 'ĐƠN VỊ TÍNH');
        $objPHPExcel->getActiveSheet()->setCellValue('E3', 'SỐ LƯỢNG TỒN KHO ĐẦU KỲ');
        $objPHPExcel->getActiveSheet()->setCellValue('F3', 'SỐ LƯỢNG NHẬP TRONG KỲ');
        $objPHPExcel->getActiveSheet()->setCellValue('G3', 'SỐ LƯỢNG XUẤT TRONG KỲ');
        $objPHPExcel->getActiveSheet()->setCellValue('H3', 'SỐ LƯỢNG TỒN KHO CUỐI KỲ');

        $wh = '';
		$mavattus = $_GET['mavattus'];
        $tenvattus = $_GET['tenvattus'];
        $donvitinhs = $_GET['donvitinhs'];
        
        
        if(!empty($mavattus)){
            $wh.=' and b.mavattu like "%'.$mavattus.'%" ';
        }
        if(!empty($tenvattus)){
            $wh.=' and b.name_vn like "%'.$tenvattus.'%" ';
        }
        if(!empty($donvitinhs)){
            $wh.=' and b.donvitinh like "%'.$donvitinhs.'%" ';
        }

        $sql = "SELECT * from $GLOBALS[db_sp].".$tablehachtoan." as a LEFT JOIN $GLOBALS[db_sp].loaivattu as b on b.id=a.idmavattu WHERE 1=1 $wh GROUP BY idmavattu";
        $rs = $GLOBALS["sp"]->getAll($sql);
        // print_r($rs);
        // die($sql);

        $numRow = 4; 

        foreach($rs as $item){

            $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlnhaptndt = $sqlnhapdt = $rsnhapdt = $sqlxuatdt = $rsxuatdt =  '';
	        $slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
            
            $idmavattu = $item['idmavattu'];
            $fromDate = $_GET['fromdays'];
            $toDate = $_GET['todays'];

            $sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
            $rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
            
            $tablect = $rsgettable['tablect'];
            $tablehachtoan = $rsgettable['tablehachtoan'];
            //die('tablect: '.$tablect.' tablehachtoan: '.$tablehachtoan);

            if(!empty($tablect) && !empty($tablehachtoan)){
		
                if(!empty($fromDate)){
                    $fromDate = explode('/',$fromDate);
                    $datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
                    $fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
                } else {
                    $fromDate = date("d/m/Y");
                    $fromDate = explode('/',$fromDate);
                    $datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
                    $fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
                }
                if(!empty($toDate)){			
                    $toDate = explode('/',$toDate);
                    $toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
                } else {
                    $toDate = date("d/m/Y");
                    $toDate = explode('/',$toDate);
                    $toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
                }
        
                if($idmavattu > 0){
                        
                    $thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
                    $thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
                    // die($thangtruoc);
        
                    // Get số lượng đầu kỳ
                    $sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idmavattu=".$idmavattu." and dated <= '".$thangtruoc."' order by id desc limit 1";
                    $rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
                    
                    $sltonsddk = round($rstonsddk['soluongton'],3);	
                    $thangdauky = $rstonsddk['dated']; 
        
                    // Get số lượng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
                    $sqlnhapdt = "select ROUND(SUM(soluong), 3)  as soluongnhap from $GLOBALS[db_sp].".$tablect." 
                                    where idmavattu=".$idmavattu." 
                                    and type=1
                                    and trangthai = 2
                                    and datedhachtoan < '".$fromDate."'  
                                    and datedhachtoan >= '".$datedauthang."' 
                    "; 
                    
                    $rsnhapdt = $GLOBALS["sp"]->getRow($sqlnhapdt);	
                    //die($sqlnhaptndt);
                    $sqlxuatdt = "select ROUND(SUM(soluong), 3) as soluongxuat from $GLOBALS[db_sp].".$tablect." 
                                    where idmavattu=".$idmavattu."
                                    and type=2
                                    and trangthai = 2 
                                    and datedhachtoan < '".$fromDate."'  
                                    and datedhachtoan >= '".$datedauthang."' 
                    "; 
                    //die($sqlxuattndt);
                    $rsxuatdt = $GLOBALS["sp"]->getRow($sqlxuatdt);	
                    
                    $sltondt = round(($rsnhapdt['soluongnhap'] - $rsxuatdt['soluongxuat']),3); 
                    $sltonsddk = round(($sltonsddk + $sltondt),3);
        
                    // Get số lượng nhập, xuất, tồn từ ngày đến ngày 
                    $sqlnhap = "select ROUND(SUM(soluong), 3) as soluongnhap from $GLOBALS[db_sp].".$tablect." 
                                    where idmavattu=".$idmavattu." 
                                    and type=1
                                    and trangthai = 2
                                    and datedhachtoan >= '".$fromDate."'  
                                    and datedhachtoan <= '".$toDate."' 
                    "; 
                    $rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
                    
                    $sqlxuat = "select ROUND(SUM(soluong), 3) as soluongxuat from $GLOBALS[db_sp].".$tablect." 
                                    where idmavattu=".$idmavattu."
                                    and type=2
                                    and trangthai = 2
                                    and datedhachtoan >= '".$fromDate."'  
                                    and datedhachtoan <= '".$toDate."' 
                    "; 
                    $rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
        
                    $sltontndn = round(($rsnhap['soluongnhap'] - $rsxuat['soluongxuat']),3);
                    $slton = $sltonsddk + $sltontndn;
                    
                    $soLuongNhap = $rsnhap['soluongnhap'];
                    $soLuongXuat = $rsxuat['soluongxuat'];
                    
                    $sLTonDauKy= $sltonsddk;
                    $sLTonCuoiKy = $slton;

                    $objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':D'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $objPHPExcel->getActiveSheet()->getStyle('E'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow, $item['']);
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow, $item['mavattu']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow, $item['name_vn']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow, $item['donvitinh']);
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow, number_format($sLTonDauKy,2,".",","));
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow, number_format($soLuongNhap,2,".",","));
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow, number_format($soLuongXuat,2,".",","));
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow, number_format($sLTonCuoiKy,2,".",","));
            
                    $numRow++;
                    
                }
            }
        }

        header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();

    break;
        
    case "ThongKeNhapKho":

        // Lấy tên kho dựa vào typephongban
        $sqlphongban = "select * from $GLOBALS[db_sp].categories where id=".$typephongban;
        $rsphongban= $GLOBALS['sp']->getRow($sqlphongban);
        $namephongban = $rsphongban['name_vn'];
        $tablect = $rsphongban['tablect'];

        // Chuyển đổi tên phòng ban có dấu thành tên phòng ban không dấu
        $namePhongBanKhongDau = vn_to_str($namephongban);
        
        $titleExcle = 'Thong-Ke-Nhap-Kho-'.$namePhongBanKhongDau;
        $setTitle = $namephongban.' - '.$datenow;

        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle($setTitle);

        $objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');   
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
        
        $objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(25);
        
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(17); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(13); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A3:H3')->getFont()->setSize(11); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A1:H3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:H3')->getFont()->setBold(true); //Tô đậm chữ
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(false);
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1', $namephongban.' THỐNG KÊ NHẬP KHO');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Từ ngày: '.$showTuNgay.' - Đến ngày: '.$showDenNgay);
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'STT');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'MÃ PHIẾU NHẬP KHO');
        $objPHPExcel->getActiveSheet()->setCellValue('C3', 'NGÀY');
        $objPHPExcel->getActiveSheet()->setCellValue('D3', 'PHÒNG BAN CHUYỂN');
        $objPHPExcel->getActiveSheet()->setCellValue('E3', 'MÃ VẬT TƯ');
        $objPHPExcel->getActiveSheet()->setCellValue('F3', 'TÊN VẬT TƯ');
        $objPHPExcel->getActiveSheet()->setCellValue('G3', 'ĐƠN VỊ TÍNH');
        $objPHPExcel->getActiveSheet()->setCellValue('H3', 'SỐ LƯỢNG NHẬP KHO');

        $wh = '';
        $fromDate = $_GET['fromdays'];
        $toDate = $_GET['todays'];
        $maphieus = $_GET['maphieus'];
		$mavattus = $_GET['mavattus'];
        $tenvattus = $_GET['tenvattus'];
        $donvitinhs = $_GET['donvitinhs'];
        
        if(!empty($fromDate)){
            $fromDate = explode('/',$fromDate);
            $fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
            $wh.=' and a.datedhachtoan >= "'.$fromDate.'" ';
        }
        if(!empty($toDate)){				
            $toDate = explode('/',$toDate);
            $toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
            $wh.=' and a.datedhachtoan <= "'.$toDate.'" ';
        }
        if(!empty($maphieus)){
            $wh.=' and maphieu like "%'.$maphieus.'%" ';
        }
        if(!empty($mavattus)){
            $wh.=' and b.mavattu like "%'.$mavattus.'%" ';
        }
        if(!empty($tenvattus)){
            $wh.=' and b.name_vn like "%'.$tenvattus.'%" ';
        }
        if(!empty($donvitinhs)){
            $wh.=' and b.donvitinh like "%'.$donvitinhs.'%" ';
        }

        $sql = "SELECT * FROM $GLOBALS[db_sp].".$tablect." as a LEFT JOIN $GLOBALS[db_sp].loaivattu as b on b.id=a.idmavattu WHERE type=1 AND trangthai=2 $wh ORDER BY datedhachtoan desc";
        $rs = $GLOBALS["sp"]->getAll($sql);

        $numRow = 4; 

        foreach($rs as $item){

            if($item['typephongbanchuyen'] > 0) {
                // Lấy tên phòng ban chuyển phiếu nhập kho đến dựa theo typephongbanchuyen
                $sqlnamephongban = "select name_vn from $GLOBALS[db_sp].categories where id=".$item['typephongbanchuyen'];
                $namephongbanchuyen = $GLOBALS['sp']->getOne($sqlnamephongban);
            }
            
            $objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':A'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$numRow.':G'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':H'.$numRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow, $numRow - 3);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow, $item['maphieu']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow, date("d/m/Y", strtotime($item['datedhachtoan'])));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow, $namephongbanchuyen);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow, $item['mavattu']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow, $item['name_vn']);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow, $item['donvitinh']);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow, number_format($item['soluong'],2,".",","));
            
            $numRow++;
        }
        
        header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();

    break;
        
    case "ThongKeXuatKho":
        // Lấy tên kho dựa vào typephongban
        $sqlphongban = "select * from $GLOBALS[db_sp].categories where id=".$typephongban;
        $rsphongban= $GLOBALS['sp']->getRow($sqlphongban);
        $namephongban = $rsphongban['name_vn'];
        $tablect = $rsphongban['tablect'];

        // Chuyển đổi tên phòng ban có dấu thành tên phòng ban không dấu
        $namePhongBanKhongDau = vn_to_str($namephongban);
        
        $titleExcle = 'Thong-Ke-Xuat-Kho-'.$namePhongBanKhongDau;
        $setTitle = $namephongban.' - '.$datenow;

        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle($setTitle);

        $objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');   
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
        
        $objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(25);
        
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(17); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(13); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A3:I3')->getFont()->setSize(11); //Cỡ chữ
        $objPHPExcel->getActiveSheet()->getStyle('A1:I3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:I3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:I3')->getFont()->setBold(true); //Tô đậm chữ
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(false);
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1', $namephongban.' THỐNG KÊ XUẤT KHO');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Từ ngày: '.$showTuNgay.' - Đến ngày: '.$showDenNgay);
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'STT');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'MÃ PHIẾU XUẤT KHO');
        $objPHPExcel->getActiveSheet()->setCellValue('C3', 'NGÀY');
        $objPHPExcel->getActiveSheet()->setCellValue('D3', 'PHÒNG BAN CHUYỂN');
        $objPHPExcel->getActiveSheet()->setCellValue('E3', 'MÃ VẬT TƯ');
        $objPHPExcel->getActiveSheet()->setCellValue('F3', 'TÊN VẬT TƯ');
        $objPHPExcel->getActiveSheet()->setCellValue('G3', 'ĐƠN VỊ TÍNH');
        $objPHPExcel->getActiveSheet()->setCellValue('H3', 'SỐ LƯỢNG XUẤT KHO');
        $objPHPExcel->getActiveSheet()->setCellValue('I3', 'MỤC ĐÍCH SỬ DỤNG');

        $wh = '';
        $fromDate = $_GET['fromdays'];
        $toDate = $_GET['todays'];
        $maphieus = $_GET['maphieus'];
		$mavattus = $_GET['mavattus'];
        $tenvattus = $_GET['tenvattus'];
        $donvitinhs = $_GET['donvitinhs'];
        $mucdichsudungs = $_GET['mucdichsudungs'];
        
        if(!empty($fromDate)){
            $fromDate = explode('/',$fromDate);
            $fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
            $wh.=' and a.datedhachtoan >= "'.$fromDate.'" ';
        }
        if(!empty($toDate)){				
            $toDate = explode('/',$toDate);
            $toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
            $wh.=' and a.datedhachtoan <= "'.$toDate.'" ';
        }
        if(!empty($maphieus)){
            $wh.=' and maphieu like "%'.$maphieus.'%" ';
        }
        if(!empty($mavattus)){
            $wh.=' and b.mavattu like "%'.$mavattus.'%" ';
        }
        if(!empty($tenvattus)){
            $wh.=' and b.name_vn like "%'.$tenvattus.'%" ';
        }
        if(!empty($donvitinhs)){
            $wh.=' and b.donvitinh like "%'.$donvitinhs.'%" ';
        }
        if(!empty($mucdichsudungs)){
            $wh.=' and a.mucdichsudung like "%'.$mucdichsudungs.'%" ';
        }

        $sql = "SELECT * FROM $GLOBALS[db_sp].".$tablect." as a LEFT JOIN $GLOBALS[db_sp].loaivattu as b on b.id=a.idmavattu WHERE type=2 AND trangthai=2 $wh ORDER BY datedhachtoan desc";
        $rs = $GLOBALS["sp"]->getAll($sql);

        $numRow = 4; 

        foreach($rs as $item){
            if($item['typephongbanchuyen'] > 0) {
                // Lấy tên phòng ban chuyển phiếu xuất kho đi dựa theo typephongbanchuyen
                $sqlnamephongban = "select name_vn from $GLOBALS[db_sp].categories where id=".$item['typephongbanchuyen'];
                $namephongbanchuyen = $GLOBALS['sp']->getOne($sqlnamephongban);
            }
            
            $objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':A'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$numRow.':G'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$numRow.':I'.$numRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$numRow.':H'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$numRow.':I'.$numRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow, $numRow - 3);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow, $item['maphieu']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow, date("d/m/Y", strtotime($item['datedhachtoan'])));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow, $namephongbanchuyen);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow, $item['mavattu']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow, $item['name_vn']);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow, $item['donvitinh']);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow, number_format($item['soluong'],2,".",","));
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow, $item['mucdichsudung']);
            
            $numRow++;
        }

        header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$titleExcle.'-'.$datenow.'.xls');
		PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5')->save('php://output');
		exit();

    break;
}

// Hàm chuyển chuỗi dấu Tiếng Việt thành không dấu và thêm gạch nối giữa các từ (VD: KHO VẬT TƯ --> Kho-Vat-Tu)
function vn_to_str($str){ 
	$unicode = array( 
	'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ', 
	'd'=>'đ', 
	'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 
	'i'=>'í|ì|ỉ|ĩ|ị', 
	'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ', 
	'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 
	'y'=>'ý|ỳ|ỷ|ỹ|ỵ', 
	'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ', 
	'D'=>'Đ', 
	'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ', 
	'I'=>'Í|Ì|Ỉ|Ĩ|Ị', 
	'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ', 
	'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự', 
	'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ', 
	); 
	foreach($unicode as $nonUnicode=>$uni){ 
	$str = preg_replace("/($uni)/i", $nonUnicode, $str);	}
    $str = str_replace(' ',' ',$str);
    $str = ucwords(strtolower($str));
    $str = str_replace(' ','-',$str);	 
	return $str; 
}

?>