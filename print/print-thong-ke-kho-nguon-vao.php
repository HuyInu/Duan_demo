<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print</title>
<style type="text/css">
	*{
		margin:0px;
		padding:0px;
	}
	body {
		font-family:"Times New Roman", Times, serif;
		font-size:14px;
		color:#000000;
		margin:0;
	}
	.TitleTopPrint {
		/*background:#000000;*/
		color: #000000;
		font-weight: bold;
		font-size:14px;
		padding:10px 0;
		
	}
	.XuatkhoPrint {
		color: #000000;
		font-weight: bold;
		font-size:20px;
		padding:10px 0 0 0;
		text-align:left;
		
	}
	
	.DatedPrint {
		font-family:"Times New Roman", Times, serif;
		font-size:16px;
		font-style:italic;
		padding-top:10px;
		display:block;
		text-align:left;
		font-weight: bold;
		
	}
	.DatedPhieuchi{
		
		margin-left:0px;	
	}
	.CodePrint{
		color: #000000;
		font-size:14px;
		padding:5px 0 0 10px;
	}
	.MaPhieu{
		font-family:Arial, Helvetica, sans-serif;
		font-weight:normal;
		 padding-left:30px;	
		 font-style:normal;
	}
	.NamePrintAll{
		clear:both;
		width:100%;
		margin:5px 0;
	}
		.NamePrint{
			float:left;
		}
		.LinePrint{
			float:left;
			/*border-bottom:1px #000000 dashed;*/
			padding:0 0 0 5px;
			margin:0 0 0 2px;
		}
		.LinePrintRight{
			float:left;
			border-bottom:1px #000 dashed;
			padding:0 30px 0 5px;
			margin:0 0 0 4px;
		}
		.Fl{
			float:left;
		}
		.Kyten{
			font-style:italic;
		}
		.FontTime{
			font-family:"Times New Roman", Times, serif;
			font-size:10px;
		}
		.AddressPrint{
			line-height:22px;
			font-size:16px;	
			
		}
		.kyten{
			padding-top:80px;
			font-weight:bold;
		}
		.kyhoten{
			font-style:italic;	
		}
		.numchu{
			font-size:16px;	
		}
	td{ padding:2px 4px;}
	.tableMain{
		margin:10px 0 0 0;	
	}
	.TongTKKhoNVPrint {
		color: #000000;
		font-weight: bold;
		font-size:20px;
		padding:10px 0 0 0;
		text-align:left;
		margin:0;
	}
@page{
	margin:0;
	padding:20px;
	size: auto;
}
</style>
</head>
<body onload="window.print();">

<?php
include_once("../#include/config.php");
include_once("../functions/function.php");
//ini_set("display_errors",1); 
CheckLogin();
$dateGetnow = date("d-m-Y");
$fromDates = $fromDateGach = trim($_GET['fromdays']);
$toDates = $toDateGach = trim($_GET['todays']);

$fromDate = explode('/',$fromDates);
$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
$toDate = explode('/',$toDates);
$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
$table = isset($_REQUEST['table'])?$_REQUEST['table']:"";
$typevkc = isset($_REQUEST['typevkc'])?$_REQUEST['typevkc']:1;
$cid = isset($_REQUEST['cid'])?$_REQUEST['cid']:0;
$idname = isset($_REQUEST['idname'])?$_REQUEST['idname']:0;
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idloaivang = trim($_REQUEST['idloaivang']);

$tieude = $checkDatechuyen =  '';
$i = 1;

if($table == 'khonguonvao_khoachinct' && $act == 'nhapkho')
	$tieude = 'Kho Anh Chín Nhập Kho';
else if($table == 'khonguonvao_khoachinct' && $act == 'xuatkho')
	$tieude = 'Kho Anh Chín Xuất Kho';
else if($table == 'khonguonvao_vangchusonct' && $act == 'nhapkho')
	$tieude = 'Kho Vàng Chú Sơn Nhập Kho';
else if($table == 'khonguonvao_vangchusonct' && $act == 'xuatkho')
	$tieude = 'Kho Vàng Chú Sơn Xuất Kho';
else if($table == 'khonguonvao_dochinhanhtravect' && $act == 'nhapkho')
	$tieude = 'Kho Đồ Chi Nhánh Trả Về Nhập Kho';
else if($table == 'khonguonvao_dochinhanhtravect' && $act == 'xuatkho')
	$tieude = 'Kho Đồ Chi Nhánh Trả Về Xuất Kho';
else if($table == 'khonguonvao_nhaxuongtravect' && $act == 'nhapkho')
	$tieude = 'Kho Nhà Xưởng Trả Về Nhập Kho';
else if($table == 'khonguonvao_nhaxuongtravect' && $act == 'xuatkho')
	$tieude = 'Kho Nhà Xưởng Trả Về Xuất Kho';
else if($table == 'khonguonvao_nguyenlieusict' && $act == 'nhapkho')
	$tieude = 'Kho Nguyên Liệu Sỉ Nhập Kho';
else if($table == 'khonguonvao_nguyenlieusict' && $act == 'xuatkho')
	$tieude = 'Kho Nguyên Liệu Sỉ Xuất Kho';
else if($table == 'khonguonvao_khonguyenlieusinutrangct' && $act == 'nhapkho')
	$tieude = 'Kho Nguyên Liệu Sỉ Nữ Trang Nhập Kho';
else if($table == 'khonguonvao_khonguyenlieusinutrangct' && $act == 'xuatkho')
	$tieude = 'Kho Nguyên Liệu Sỉ Nữ Trang Xuất Kho';
else if($table == 'khonguonvao_phongdosuacacchinhanhct' && $act == 'nhapkho')
	$tieude = 'Phòng Đồ Sửa Các Chi Nhanh Nhập Kho';
else if($table == 'khonguonvao_phongdosuacacchinhanhct' && $act == 'xuatkho')
	$tieude = 'Phòng Đồ Sửa Các Chi Nhanh Xuất Kho';
else if($table == 'khonguonvao_khonhaxuonggiaonutrangct' && $act == 'nhapkho')
	$tieude = 'Kho Nhà Xưởng Giao Nữ Trang (KTP + Nhẫn Trơn Tiệm Vàng) Nhập Kho';
else if($table == 'khonguonvao_khonhaxuonggiaonutrangct' && $act == 'xuatkho')
	$tieude = 'Kho Nhà Xưởng Giao Nữ Trang (KTP + Nhẫn Trơn Tiệm Vàng) Xuất Kho';	
else if($table == 'kho_giamdockynhan')
	$tieude = 'Kho Lưu Trữ, Tổng Kho Nguồn Vào';	
if($table == 'khonguonvao_khomuahangct' && $act == 'nhapkho')
	$tieude = 'Kho Mua Hàng Nhập Kho';
else if($table == 'khonguonvao_khomuahangct' && $act == 'xuatkho')
	$tieude = 'Kho Mua Hàng Nhập Xuất Kho';	


if($act == 'nhapkho')
	$tieude = ' NHẬP KHO';
else if($act == 'xuatkho')
	$tieude = ' XUẤT KHO';
else if($act == 'haodu')
	$tieude = ' HAO DƯ';
else if($act == 'tonkho')
	$tieude = ' TỒN KHO';
else if($act == 'tonkhochitiet' || $act == 'tonkhochitietKhothanhpham')
	$tieude = ' TỒN KHO CHI TIẾT';

if(ceil($cid) > 0){
	$title = getLinkTitle($cid,1);
	if(!empty($title)){
		$title = explode('&raquo;',$title);
		$title = $title[1];	
	}
}	

if($typevkc == 1){
	$orderBy = " order by nhomnguyenlieuvang asc , idloaivang asc , dated asc ";		
}
else{
	$orderBy = " order by nhomnguyenlieukimcuong asc , idkimcuong asc , dated asc ";	
}

$whidloaivang = '';
if($idloaivang > 0)
	$whidloaivang = " and idloaivang=".$idloaivang." ";
switch($act){
	case"tonkho":
		$wh = '';
		if(ceil($idloaivang) > 0)
			$wh = " and id = ".$idloaivang." ";
		$sqlvang1 = "select * from $GLOBALS[db_sp].loaivang where active=1 $wh order by num asc, id asc"; 
		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);	
	break;
	case"tonkhochitietKhothanhpham":
		$wh = '';
		$sqlvang1 = "select * from $GLOBALS[db_sp].khosanxuat_khothanhpham 
						where type=2 
						and trangthai<>2
						and typevkc = 2 
						order by numphieu asc, dated asc
		";
		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);	
	break;
	case"tonkhochitiet":
		$wh = '';
		if(!empty($fromDateGach)){
			$wh.=' and dated >= "'.$fromDate.'"  ';
		}
		if(!empty($toDateGach)){			
			$wh.=' and dated <= "'.$toDate.'" ';
		}
		if(ceil($idloaivang) > 0)
			$wh = " and idloaivang = ".$idloaivang." ";
			
		$sqlvang1 = "select * from $GLOBALS[db_sp].".$table." where trangthai<>2 and type=2 and typevkc = 1 $wh order by numphieu asc, dated asc";
		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);	
	break;
	case"ThongKeTongKhoNguonVaoNhapKho":
		$wh = '';
		if(!empty($fromDate)){
			$wh.=' and dated >= "'.$fromDate.'"  ';
		}
		if(!empty($toDate)){			
			$wh.=' and dated <= "'.$toDate.'" ';
		}
		if(!empty($fromDate) && !empty($toDate)){
			$str = '';
			$strKhoAnhChinVangPrint = $strKhoAnhChinKimCuongPrint = $strKhoVangChuSonVangPrint = $strKhoVangChuSonKimCuongPrint = $strKhoDoChiNhanhTraVeVang = $strKhoDoChiNhanhTraVeKimCuong = $strKhoNhaXuongTraVeVang = $strKhoNhaXuongTraVeKimCuong = $strKhoNguyenLieuSiVang = $strKhoNguyenLieuSiKimCuong = $strKhoNhaXuongGiaNuTrangVang = $strKhoNhaXuongGiaNuTrangKimCuong = $strKhoMuaHangVang = $strKhoMuaHangKimCuong = '';
			///////////load nhập kho anh chín Vàng
			$strKhoAnhChinVang = getListTableVangPrint('khonguonvao_khoachinct' ,$wh);
			$strKhoAnhChinKimCuong = getListTableKimCuongPrint('khonguonvao_khoachinct' ,$wh);
			if(!empty($strKhoAnhChinVang) || !empty($strKhoAnhChinKimCuong)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Nguồn Vào, Kho Anh Chín </div> 
							</td>
						</tr>
					</table>
					'.$strKhoAnhChinVang.'
					'.$strKhoAnhChinKimCuong.'
				';	
			}
			///////////load nhập kho vàng Chú Sơn Vàng
			$strKhoVangChuSonVang = getListTableVangPrint('khonguonvao_vangchusonct' ,$wh);
			$strKhoVangChuSonKimCuong = getListTableKimCuongPrint('khonguonvao_vangchusonct' ,$wh);
			if(!empty($strKhoVangChuSonVang) || !empty($strKhoVangChuSonKimCuong)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Nguồn Vào, Kho Vàng Chú Sơn </div> 
							</td>
						</tr>
					</table>
					
					'.$strKhoVangChuSonVang.'
					'.$strKhoVangChuSonKimCuong.'
				';	
			}
			
			///////////load nhập Kho Đồ Chi Nhánh Trả Về Vàng
			$strKhoDoChiNhanhTraVeVang = getListTableVangPrint('khonguonvao_dochinhanhtravect' ,$wh);
			$strKhoDoChiNhanhTraVeKimCuong = getListTableKimCuongPrint('khonguonvao_dochinhanhtravect' ,$wh);
			if(!empty($strKhoDoChiNhanhTraVeVang) || !empty($strKhoDoChiNhanhTraVeKimCuong)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Nguồn Vào, Kho Đồ Chi Nhánh Trả Về </div> 
							</td>
						</tr>
					</table>
					'.$strKhoDoChiNhanhTraVeVang.'
					'.$strKhoDoChiNhanhTraVeKimCuong.'
				';	
			}
			
			///////////load nhập Kho Nhà Xưởng Trả Về
			$strKhoNhaXuongTraVeVang = getListTableVangPrint('khonguonvao_nhaxuongtravect' ,$wh);
			$strKhoNhaXuongTraVeKimCuong = getListTableKimCuongPrint('khonguonvao_nhaxuongtravect' ,$wh);
			if(!empty($strKhoNhaXuongTraVeVang) || !empty($strKhoNhaXuongTraVeKimCuong)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Nguồn Vào, Kho Nhà Xưởng Trả Về </div> 
							</td>
						</tr>
					</table>
					'.$strKhoNhaXuongTraVeVang.'
					'.$strKhoNhaXuongTraVeKimCuong.'
				';	
			}
			
			///////////load nhập Kho Nguyên Liệu Sỉ
			$strKhoNguyenLieuSiVang = getListTableVangPrint('khonguonvao_nguyenlieusict' ,$wh);
			$strKhoNguyenLieuSiKimCuong = getListTableKimCuongPrint('khonguonvao_nguyenlieusict' ,$wh);
			if(!empty($strKhoNguyenLieuSiVang) || !empty($strKhoNguyenLieuSiKimCuong)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Nguồn Vào, Kho Nguyên Liệu Sỉ </div> 
							</td>
						</tr>
					</table>
					'.$strKhoNguyenLieuSiVang.'
					'.$strKhoNguyenLieuSiKimCuong.'	
				';	
			}
			
			///////////load nhập Kho Nhà Xưởng Giao Nữ Trang
			$strKhoNhaXuongGiaNuTrangVang = getListTableVangPrint('khonguonvao_khonhaxuonggiaonutrangct' ,$wh);
			$strKhoNhaXuongGiaNuTrangKimCuong = getListTableKimCuongPrint('khonguonvao_khonhaxuonggiaonutrangct' ,$wh);
			if(!empty($strKhoNhaXuongGiaNuTrangVang) || !empty($strKhoNhaXuongGiaNuTrangKimCuong)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Nguồn Vào, Kho Nhà Xưởng Giao Nữ Trang (KTP + Nhẫn Trơn Tiệm Vàng)</div> 
							</td>
						</tr>
					</table>
					'.$strKhoNhaXuongGiaNuTrangVang.'
					'.$strKhoNhaXuongGiaNuTrangKimCuong.'	
				';	
			}
			
			///////////load nhập kho Kho Mua Hàng
			$strKhoMuaHangVang = getListTableVangPrint('khonguonvao_khomuahangct' ,$wh);
			$strKhoMuaHangKimCuong = getListTableKimCuongPrint('khonguonvao_khomuahangct' ,$wh);
			if(!empty($strKhoMuaHangVang) || !empty($strKhoMuaHangKimCuong)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Nguồn Vào, Kho Mua Hàng </div> 
							</td>
						</tr>
					</table>
					'.$strKhoMuaHangVang.'
					'.$strKhoMuaHangKimCuong.'
				';	
			}
			
			$str = '
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center" height="80" >
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100%" colspan="2" valign="top" align="left" class="logan red">
										'.$datenow.'
									</td>
								</tr>
								<tr>
									<td width="30%" valign="top" align="left" class="logan red">
										<img width="120" src="../images/logo.png"/> <br>
									</td>
									<td width="70%" valign="top" align="left" >
										<div class="XuatkhoPrint PrintPhieuchi"> Thông Kê Tổng Kho Nguồn Vào </div> 
										<div class="DatedPrint DatedPhieuchi"> Từ Ngày '.$fromDates.' -  Đến Ngày '.$toDates.'</div>
										
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				'.$str.'
			';
			echo $str; die();
		}
	break;
	
	case"tongKhoNguonVao":
		$checkDatechuyen = 'Ok';
		$wh = '';
		if($cid > 0)
			$wh = " and cid= ".$cid;
			
		if($idname > 0){
			$tieude = 'Kho Giám Đốc Ký Nhận, '.getName('categories', 'name_vn', $idname);
		}
			
		$sql = "select * from $GLOBALS[db_sp].".$table." 
				where type=1 
				and typevkc = ".$typevkc."
				and datechuyen >= '".$fromDate."' 
				and datechuyen <= '".$toDate."' 
				$wh
				".$orderBy."
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);	
	break;
	case"khoLuuTruTong":
		$checkDatechuyen = 'Ok';
		$wh = '';
		if($cid > 0)
			$wh = " and ( cid= ".$cid." or cid = ".$idname.") "; /// idname là ở kho lưu trữ
			
		if($idname > 0){
			$tieude = 'Kho Lưu Trữ, '.getName('categories', 'name_vn', $idname);
		}
			
		$sql = "select * from $GLOBALS[db_sp].".$table." 
				where type=2 
				and typevkc = ".$typevkc."
				and datechuyen >= '".$fromDate."' 
				and datechuyen <= '".$toDate."' 
				$wh
				".$orderBy."
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);	
	break;
	case"nhapkho":
		$sql = "select * from $GLOBALS[db_sp].".$table." 
				where type=2 
				and typevkc = ".$typevkc."
				and dated >= '".$fromDate."' 
				and dated <= '".$toDate."' 
				$whidloaivang
				".$orderBy."
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);	
	break;
	case"xuatkho":
		$sql = "select * from $GLOBALS[db_sp].".$table." 
				where type=2 
				and trangthai=2
				and typevkc = ".$typevkc."
				and datedxuat >= '".$fromDate."' 
				and datedxuat <= '".$toDate."' 
				$whidloaivang
				".$orderBy."
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);	
	break;
	default:
		die('Vui lòng liên hệ với admin.');
	break;
}
if($act == 'nhapkho'){/// xuất datechuyen
	$tieudedated = 'Ngày nhập';
}
else{
	$tieudedated = 'Ngày xuất';
}

if($act == 'tonkho'){
	foreach($rscth as $value){
		$viewdl = array();
		$viewdl = thongKeKhoNguonVaoTonKho($cid, $value['id'], $fromDateGach, $toDateGach);
		
		if(ceil($viewdl['idloaivang']) > 0){
			$str .= '
				<tr> 
					<td height="25" align="left">
						'.$value['name_vn'].'
					</td>
					<td  height="25" align="right">
						'.number_format($viewdl['sltonsddk'],3,".",",").'
					</td>
					<td height="25" align="right">
						'.number_format($viewdl['slnhap'],3,".",",").'
					</td>
					<td height="25" align="right">
						 '.number_format($viewdl['slxuat'],3,".",",").'
					</td>
					
					<td height="25" align="right">
						 '.number_format($viewdl['slhao'],3,".",",").'
					</td>
					<td height="25" align="right">
						 '.number_format($viewdl['sldu'],3,".",",").'
					</td>
					
					<td height="25" align="right">
						 '.number_format($viewdl['slton'],3,".",",").'
					</td>
					<td height="25" align="right">
						 '.number_format($viewdl['tongQ10'],3,".",",").'
					</td>
				</tr>
			';
			$tongtongQ10 = $tongtongQ10 + $viewdl['tongQ10'];
		}
	}
	echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="80" >
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" colspan="2" valign="top" align="left" class="logan red">
								'.$datenow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">'.$title . $tieude.'</div> 
								<div class="DatedPrint DatedPhieuchi"> Từ Ngày '.$fromDates.' -  Đến Ngày '.$toDates.'</div>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
	
			<tr>
				<td valign="top" align="left">
					<table width="100%" border="1" cellpadding="0" cellspacing="0">
						<tr bgcolor="#e9e8e8"> 
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Loại Vàng</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Số Dư Đầu Kỳ</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Số Lượng Nhập</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Số Lượng Xuất</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Hao</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Dư</strong>
							</td>
							
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tồn</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tổng Trọng Lượng Q10</strong>
							</td>
						</tr>
						'.$str.'
						<tr class="Paging fontSizeTon">
							<td align="right" colspan="7"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
							<td align="right"><strong class="colorXanh">'.number_format($tongtongQ10,3,".",",").'</strong></td>
						</tr>   
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
}


else if($act == 'tonkhochitiet'){
	foreach($rscth as $value){
		$SLQ10 =  getTongQ10($value['cannangv'],$value['idloaivang']);
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.date("d/m/Y", strtotime($value['dated'])).'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
				</td>
				<td height="25"  align="left">
					'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
				</td>
				<td height="25" align="left">
					'.getName("categories","name_vn",$value['tennguyenlieuvang']).'
				</td>
				<td height="25" align="left">
					'.getName("loaivang","name_vn",$value['idloaivang']).' 
				</td>
				<td  height="25" align="right">
					'.number_format($value['cannangvh'],3,".",",").'
				</td>
				<td height="25" align="right">
					'.number_format($value['cannangh'],3,".",",").'
				</td>
				<td height="25" align="right">
					 '.number_format($value['cannangv'],3,".",",").'
				</td>
				<td height="25" align="right" >
					 '.$value['tuoivang'].'
				</td>
				<td height="25" align="right" >
					 '.$value['tienmatvang'].'
				</td>
				<td height="25" align="right">
					 '.number_format($SLQ10,3,".",",").'
				</td>
				<td height="25" align="left">
					'.$value['ghichuvang'].'
				</td>
			</tr>
		';	
		$i++;
	}
	echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="80" >
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" colspan="2" valign="top" align="left" class="logan red">
								'.$datenow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">'.$title . $tieude.' (Vàng)</div> 
								<div class="DatedPrint DatedPhieuchi"> Từ Ngày '.$fromDates.' -  Đến Ngày '.$toDates.'</div>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td valign="top" align="left">
					<table width="100%" border="1" cellpadding="0" cellspacing="0">
						<tr bgcolor="#e9e8e8"> 
							<td height="25"  align="center" class="brbottom brleft">
								<strong>STT</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Ngày</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Phiếu</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Nhóm Nguyên Liệu</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tên Nguyên Liệu</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Loại Vàng</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Cân Nặng V+H</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Cân Nặng Hột</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Cân Nặng Vàng</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tuổi Vàng</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tiền mặt</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>TT Vàng Q10</strong>
							</td>
							
							<td height="25" align="center" class="brbottom brleft">
								<strong>Ghi chú</strong>
							</td>
						</tr>
						'.$str.'
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
}

else if($typevkc == 1){
	foreach($rscth as $value){
		$datedshow = '';
		if($act == 'nhapkho'){/// xuất datechuyen
			$datedshow = date("d/m/Y", strtotime($value['dated']));
			$maphieu = str_replace("PXK", "PNK", $value['maphieu']);
			
		}
		else{
			$datedshow = date("d/m/Y", strtotime($value['datedxuat']));
			$maphieu = $value['maphieu'];
		}
		
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.$datedshow.'
				</td>
				<td height="25" align="left">
					'.$maphieu.'
				</td>
				<td height="25"  align="left">
					'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
				</td>
				<td height="25" align="left">
					'.getName("categories","name_vn",$value['tennguyenlieuvang']).'
				</td>
				<td height="25" align="left">
					'.getName("loaivang","name_vn",$value['idloaivang']).' 
				</td>
				<td  height="25" align="right">
					'.number_format($value['cannangvh'],3,".",",").'
				</td>
				<td height="25" align="right">
					'.number_format($value['cannangh'],3,".",",").'
				</td>
				<td height="25" align="right">
					 '.number_format($value['cannangv'],3,".",",").'
				</td>
				<td height="25" align="right" >
					 '.$value['tuoivang'].'
				</td>
				<td height="25" align="right" >
					 '.$value['tienmatvang'].'
				</td>
				<td height="25" align="right">
					 '.number_format($value['hao'],3,".",",").'
				</td>
				<td height="25" align="right">
					 '.number_format($value['du'],3,".",",").'
				</td>
				<td height="25" align="left">
					 '.$value['typekhodau'].'
				</td>
				<td height="25" align="left">
					'.$value['ghichuvang'].'
				</td>
			</tr>
		';	
		$i++;
	}
	echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="80" >
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" colspan="2" valign="top" align="left" class="logan red">
								'.$datenow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">'.$title . $tieude.' (Vàng)</div> 
								<div class="DatedPrint DatedPhieuchi"> Từ Ngày '.$fromDates.' -  Đến Ngày '.$toDates.'</div>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td valign="top" align="left">
					<table width="100%" border="1" cellpadding="0" cellspacing="0">
						<tr bgcolor="#e9e8e8"> 
							<td height="25"  align="center" class="brbottom brleft">
								<strong>STT</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>'.$tieudedated.'</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Phiếu</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Nhóm Nguyên Liệu</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tên Nguyên Liệu</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Loại Vàng</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Cân Nặng V+H</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Cân Nặng Hột</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Cân Nặng Vàng</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tuổi Vàng</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tiền mặt</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Hao</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Dư</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Phòng Ban C</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Ghi chú</strong>
							</td>
						</tr>
						'.$str.'
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
}
else{
	foreach($rscth as $value){
		$datedshow = '';
		if($checkDatechuyen == 'Ok'){/// xuất datechuyen
			$datedshow = date("d/m/Y", strtotime($value['datechuyen']));
			$maphieu = $value['maphieu'];
		}
		else{
			$datedshow = date("d/m/Y", strtotime($value['dated']));
			$maphieu = str_replace("PXK", "PNK", $value['maphieu']);
			
		}
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.$datedshow.'
				</td>
				<td height="25" align="left">
					'.$maphieu.'
				</td>
				<td height="25"  align="left">
					'.getName("categories","name_vn",$value['nhomnguyenlieukimcuong']).'
				</td>
				<td height="25" align="left">
					'.getName("categories","name_vn",$value['tennguyenlieukimcuong']).'
				</td>
				<td height="25" align="left">
					'.getName("loaikimcuonghotchu","size",$value['idkimcuong']).'::'.getName("loaikimcuonghotchu","name_vn",$value['idkimcuong']).'
				</td>
				<td  height="25" align="left">
					'.$value['codegdpnj'].'
				</td>
				<td  height="25" align="left">
					'.$value['codecgta'].'
				</td>
				<td  height="25" align="left">
					'.$value['kichthuoc'].'
				</td>
				<td height="25" align="left">
					'.$value['trongluonghot'].'
				</td>
				<td height="25" align="left">
					 '.$value['dotinhkhiet'].'
				</td>
				<td height="25" align="left" >
					 '.$value['capdomau'].'
				</td>
				<td height="25" align="left">
					'.$value['domaibong'].'
				</td>
				<td height="25" align="left">
					'.$value['kichthuocban'].'
				</td>
				<td height="25" align="right">
					 '.number_format($value['dongiaban'],3,".",",").'
				</td>
				<td height="25" align="left">
					'.$value['ghichueditkimcuong'].'
				</td>
			</tr>
		';	
		$i++;
	}
	echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="80" >
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" colspan="2" valign="top" align="left" class="logan red">
								'.$datenow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">'.$title . $tieude.' (Kim Cương)</div> 
								<div class="DatedPrint DatedPhieuchi"> Từ Ngày '.$fromDates.' -  Đến Ngày '.$toDates.'</div>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top" align="left">
					<table width="100%" border="1" cellpadding="0" cellspacing="0">
						<tr bgcolor="#e9e8e8"> 
							<td height="25"  align="center" class="brbottom brleft">
								<strong>STT</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>'.$tieudedated.'</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Phiếu</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Nhóm Nguyên Liệu</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tên Nguyên Liệu</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tên Kim Cương</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>MS GĐPNJ</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>MS Cạnh GIA</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Kích Thước</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>TL Hột</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Độ Tinh Khiết</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Cấp Độ Màu</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Độ Mài Bóng</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Kích Thước Bán</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Đơn Giá</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Ghi chú</strong>
							</td>
						</tr>
						'.$str.'
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
}
?>
</body>
</html>
<?php

function convert_number_to_words($number) {
	$hyphen      = ' ';
	$conjunction = '  ';
	$separator   = ' ';
	$negative    = 'âm ';
	$decimal     = ' phẩy ';
	$dictionary  = array(
		0                   => 'không',
		1                   => 'một',
		2                   => 'hai',
		3                   => 'ba',
		4                   => 'bốn',
		5                   => 'năm',
		6                   => 'sáu',
		7                   => 'bảy',
		8                   => 'tám',
		9                   => 'chín',
		10                  => 'mười',
		11                  => 'mười một',
		12                  => 'mười hai',
		13                  => 'mười ba',
		14                  => 'mười bốn',
		15                  => 'mười năm',
		16                  => 'mười sáu',
		17                  => 'mười bảy',
		18                  => 'mười tám',
		19                  => 'mười chín',
		20                  => 'hai mươi',
		30                  => 'ba mươi',
		40                  => 'bốn mươi',
		50                  => 'năm mươi',
		60                  => 'sáu mươi',
		70                  => 'bảy mươi',
		80                  => 'tám mươi',
		90                  => 'chín mươi',
		100                 => 'trăm',
		1000                => 'ngàn',
		1000000             => 'triệu',
		1000000000          => 'tỷ',
		1000000000000       => 'nghìn tỷ',
		1000000000000000    => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ'
	);
 
	if (!is_numeric($number)) {
		return false;
	}
	if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
		trigger_error(
			'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
			E_USER_WARNING
		);
		return false;
	}
 
	if ($number < 0) {
		return $negative . convert_number_to_words(abs($number));
	}
 
	$string = $fraction = null;
 
	if (strpos($number, '.') !== false) {
		list($number, $fraction) = explode('.', $number);
	}
 
	switch (true) {
		case $number < 21:
			$string = $dictionary[$number];
		break;
		case $number < 100:
			$tens   = ((int) ($number / 10)) * 10;
			$units  = $number % 10;
			$string = $dictionary[$tens];
			if ($units) {
				$string .= $hyphen . $dictionary[$units];
			}
		break;
		case $number < 1000:
			$hundreds  = $number / 100;
			$remainder = $number % 100;
			$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
			if ($remainder) {
				$string .= $conjunction . convert_number_to_words($remainder);
			}
		break;
		default:
			$baseUnit = pow(1000, floor(log($number, 1000)));
			$numBaseUnits = (int) ($number / $baseUnit);
			$remainder = $number % $baseUnit;
			$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
			if ($remainder) {
				$string .= $remainder < 100 ? $conjunction : $separator;
				$string .= convert_number_to_words($remainder);
			}
		break;
	}
 
	if (null !== $fraction && is_numeric($fraction)) {
		$string .= $decimal;
		$words = array();
		foreach (str_split((string) $fraction) as $number) {
			$words[] = $dictionary[$number];
		}
		$string .= implode(' ', $words);
	}
	return $string ;
}
?>