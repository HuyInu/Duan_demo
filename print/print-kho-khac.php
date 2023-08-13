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
include_once("../functions/functionVu.php");//VŨ Thêm 15-10-2019//
//ini_set("display_errors",1); 
CheckLogin();
$fromDates = trim($_GET['fromdays']);
$toDates = trim($_GET['todays']);
$datenow = date("d-m-Y");///Vũ thêm 15-10-2019
$timnow = date('H:i:s');//Vũ thêm 28-11-19
if(!empty($fromDates)){
	$fromDate = explode('/',$fromDates);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
}
if(!empty($toDates)){
	$toDate = explode('/',$toDates);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
}
$table = isset($_REQUEST['table'])?$_REQUEST['table']:"";
$cid = isset($_REQUEST['cid'])?$_REQUEST['cid']:0;
$idname = isset($_REQUEST['idname'])?$_REQUEST['idname']:0;
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$type = isset($_REQUEST['type'])?$_REQUEST['type']:"";
$tieudeget = isset($_REQUEST['tieude'])?$_REQUEST['tieude']:"";
$idloaivang = isset($_REQUEST['idloaivang'])?$_REQUEST['idloaivang']:"";
$wh = $whloaivang = $whdatechuyen = $whdated = '';
$i = 1;
if($idname > 0){
	if($type == 2)
		$tieude = 'Kho Lưu Trữ, '.getName('categories', 'name_vn', $idname);
	else
		$tieude = 'Kho Giám Đốc Ký Nhận, '.getName('categories', 'name_vn', $idname);
		
	if($tieudeget == "khokhac"){
		$getname = $strtieude = '';
		$getname = getNameCap1($idname,1);
		$getname = explode(';',$getname);
		$strtieude = $getname['1'];
		$tieude = 'Kho Khác, '.$strtieude.' '.getName('categories', 'name_vn', $idname);
	}
}
if($cid > 0){
	$wh .= " and cid= ".$cid;
}
if($idloaivang > 0){
	$whloaivang = " and idloaivang= ".$idloaivang;
}
if(!empty($fromDate)){
	$whdated.=' and dated >= "'.$fromDate.'" ';
	$whdatechuyen.=' and datechuyen >= "'.$fromDate.'" ';
}
if(!empty($toDate)){
	$whdated.=' and dated <= "'.$toDate.'" ';
	$whdatechuyen.=' and datechuyen <= "'.$toDate.'" ';
}
switch($act){
	case"ThongKeTongKhoKhacNhapKho":
		$str = '';
		if(!empty($fromDate) && !empty($toDate)){
			$strKhoKhacKhoTongDeCuc = $strKhoKhacKhoSauCheTac = $strKhoKhacKhoKhoLamMoi = $strKhoKhacKhoKimCuongEpTem = $strKhoKhacKhoKimSauCuongEpTem = '';	
			$whkhokhac = '';
			///////////load nhập Kho Khac kho Tổng Dể Cục
			$whkhokhac = ' where type=2 ' . $whdatechuyen;
			$strKhoKhacKhoTongDeCuc = getListTableKhoKhacKhoTongDeCucPrint('khokhac_khotongdecucct' ,$whkhokhac);
			if(!empty($strKhoKhacKhoTongDeCuc)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Khác, Kho Tổng Dẻ Cục </div> 
							</td>
						</tr>
					</table>
					'.$strKhoKhacKhoTongDeCuc.'
				';	
			}
			///////////load nhập kho Kho khác kho Sau Che Tac
			$whkhokhac = '';
			$whsaucheta = ' where typesauchetac=2 ' . $whdatechuyen;
			$strKhoKhacKhoSauCheTac = getListTableKhoKhacKhoSauCheTacPrint('khokhac_khotongdecuc' ,$whsaucheta);
			if(!empty($strKhoKhacKhoSauCheTac)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Khác, Kho Sau Chế Tác </div> 
							</td>
						</tr>
					</table>
					'.$strKhoKhacKhoSauCheTac.'
				';	
			}
			///////////load nhập Kho khác kho làm mới
			$whkhokhac = '';
			$whkhokhac = ' where 1=1 and (type = 2 or type=3) ' . $whdatechuyen;
			$strKhoKhacKhoKhoLamMoi = getListTableKhoKhacKhoTongDeCucPrint('khokhac_kholammoict' ,$whkhokhac);
			if(!empty($strKhoKhacKhoKhoLamMoi)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Khác, Kho Khác, Kho Làm Mới </div> 
							</td>
						</tr>
					</table>
					'.$strKhoKhacKhoKhoLamMoi.'
				';	
			}
			///////////load nhập Kho khác kho ép tem kim cương
			$whkhokhac = '';
			$whkhokhac = ' where type=2 ' . $whdatechuyen;
			$strKhoKhacKhoKimCuongEpTem = getListTableKhoKhacKhoKimCuongEpTemPrint('khokhac_khokimcuongeptemct' ,$whkhokhac);
			if(!empty($strKhoKhacKhoKimCuongEpTem)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Khác, Kho Kim Cương Ép Tem </div> 
							</td>
						</tr>
					</table>
					'.$strKhoKhacKhoKimCuongEpTem.'
				';	
			}
			///////////load nhập Kho khác kho  kim cương sau ép tem kim cương
			$whkhokhac = '';
			$whkhokhac = ' where type=2 and trangthai=2 ' . $whdatechuyen;
			$strKhoKhacKhoKimSauCuongEpTem = getListTableKhoKhacKhoKimCuongEpTemPrint('khokhac_khokimcuongsaueptem' ,$whkhokhac);
			if(!empty($strKhoKhacKhoKimSauCuongEpTem)){
				$str .= '
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" valign="top" align="left" >
								<div class="TongTKKhoNVPrint"> Kho Khác, Kho Kim Cương Sau Ép Tem </div> 
							</td>
						</tr>
					</table>
					'.$strKhoKhacKhoKimSauCuongEpTem.'
				';	
			}
			echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
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
											<div class="XuatkhoPrint PrintPhieuchi">Thống Kê Tổng Kho Khác</div> 
											<div class="DatedPrint DatedPhieuchi"> Từ Ngày '.$fromDates.' -  Đến Ngày '.$toDates.'</div>
											
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
		' . $str; die('');
		}
	break;
	case"KhoKhacKhoKimCuongSauEpTemTKXuatKho":
		$whday = '';
		if(!empty($fromDate)){
			$whday .=" and datechuyen >= '".$fromDate."' ";
		}
		if(!empty($toDate)){
			$whday .=" and datechuyen <= '".$toDate."' ";
		}
		$sql = "select * from $GLOBALS[db_sp].khokhac_khokimcuongsaueptem 
					where type=2 
					and trangthai=2
					$whday 
					order by maphieu asc, dated asc
		";
		
		$sql_tong = "select ROUND(count(id), 3) as tongsoluong, 
							ROUND(SUM(dongiaban), 3) as tongdongia 
							from $GLOBALS[db_sp].khokhac_khokimcuongsaueptem 
							where type=2 
							and trangthai=2
							$whday
					";
		
		$rstong = $GLOBALS['sp']->getRow($sql_tong);
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.date("d/m/Y", strtotime($value['datechuyen'])).'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
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
				<td height="25" align="right"s>
					1
				</td>
				<td height="25" align="right">
					 '.number_format($value['dongiaban'],3,".",",").'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
								<strong>Ngày Nhận</strong>
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
							<td class="text-right">
								Số Lượng
						   </td> 
							<td height="25" align="center" class="brbottom brleft">
								<strong>Đơn Giá</strong>
							</td>
						</tr>
						'.$str.'
						<tr>
							<td align="right" colspan="14" class="brbottom brleft"> <span class="colorXanh">Tổng tất cả:</span> </td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstong['tongsoluong'],3,".",",").' </strong></td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstong['tongdongia'],3,".",",").' </strong></td>
							<td align="right"></td>
						</tr>    
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
	break;
	
	case"KhoKhacKhoKimCuongSauEpTemTKNhapKho":
		$whday = $whdayxuat = '';
		if(!empty($fromDate)){
			$whday .=" and datechuyen >= '".$fromDate."' ";
		}
		if(!empty($toDate)){
			$whday .=" and datechuyen <= '".$toDate."' ";
		}
		$sql = "select * from $GLOBALS[db_sp].khokhac_khokimcuongsaueptem 
					where type=2 
					$whday
					order by maphieu asc, dated asc
		";
		
		$sql_tongnhap = "select ROUND(count(id), 3) as tongsoluong, 
							ROUND(SUM(dongiaban), 3) as tongdongia 
							from $GLOBALS[db_sp].khokhac_khokimcuongsaueptem 
							where type=2 
							$whday
					";
		
		$rstongnhap = $GLOBALS['sp']->getRow($sql_tongnhap);
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.date("d/m/Y", strtotime($value['datechuyen'])).'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
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
				<td height="25" align="right"s>
					1
				</td>
				<td height="25" align="right">
					 '.number_format($value['dongiaban'],3,".",",").'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
								<strong>Ngày Nhận</strong>
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
							<td class="text-right">
								Số Lượng
						   </td> 
							<td height="25" align="center" class="brbottom brleft">
								<strong>Đơn Giá</strong>
							</td>
						</tr>
						'.$str.'
						<tr>
							<td align="right" colspan="14" class="brbottom brleft"> <span class="colorXanh">Tổng tất cả:</span> </td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['tongsoluong'],3,".",",").' </strong></td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['tongdongia'],3,".",",").' </strong></td>
							<td align="right"></td>
						</tr>    
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
	break;
	
	case"KhoKhacKhoKimCuongSauEpTemTKChiTietTon":
		$sql = "select * from $GLOBALS[db_sp].khokhac_khokimcuongsaueptem 
				where type=2 
				and trangthai < 2
				$whdatechuyen
				order by maphieu asc, dated desc
		";
		$sql_tong = "select ROUND(count(id), 3) as tongsoluong, 
							ROUND(SUM(dongiaban), 3) as tongdongia 
							from $GLOBALS[db_sp].khokhac_khokimcuongsaueptem 
							where type=2 
							and trangthai < 2
							$whdatechuyen
					";
		
		$rstong = $GLOBALS['sp']->getRow($sql_tong);
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.date("d/m/Y", strtotime($value['datechuyen'])).'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
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
				<td height="25" align="right"s>
					1
				</td>
				<td height="25" align="right">
					 '.number_format($value['dongiaban'],3,".",",").'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
								<strong>Ngày Nhận</strong>
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
							<td class="text-right">
								Số Lượng
						   </td> 
							<td height="25" align="center" class="brbottom brleft">
								<strong>Đơn Giá</strong>
							</td>
						</tr>
						'.$str.'
						<tr>
							<td align="right" colspan="14" class="brbottom brleft"> <span class="colorXanh">Tổng tất cả:</span> </td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstong['tongsoluong'],3,".",",").' </strong></td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstong['tongdongia'],3,".",",").' </strong></td>
							<td align="right"></td>
						</tr>    
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
	break;
	
	case"KhoKhacKhoKimCuongEpTemTKXuatKho":
		$whday = '';
		if(!empty($fromDate)){
			$whday .=" and datechuyen >= '".$fromDate."' ";
		}
		if(!empty($toDate)){
			$whday .=" and datechuyen <= '".$toDate."' ";
		}
		$sql = "select * from $GLOBALS[db_sp].khokhac_khokimcuongeptemct 
					where type=2 
					and trangthai=2
					$whday
					order by maphieu asc, dated asc
		";
		$sql_tong = "select ROUND(count(id), 3) as tongsoluong, 
							ROUND(SUM(dongiaban), 3) as tongdongia 
							from $GLOBALS[db_sp].khokhac_khokimcuongeptemct 
							where type=2 
							and trangthai=2
							$whday
					";
		
		$rstong = $GLOBALS['sp']->getRow($sql_tong);
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.date("d/m/Y", strtotime($value['datechuyen'])).'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
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
				<td height="25" align="right"s>
					1
				</td>
				<td height="25" align="right">
					 '.number_format($value['dongiaban'],3,".",",").'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
								<strong>Ngày Nhận</strong>
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
							<td class="text-right">
								Số Lượng
						   </td> 
							<td height="25" align="center" class="brbottom brleft">
								<strong>Đơn Giá</strong>
							</td>
						</tr>
						'.$str.'
						<tr>
							<td align="right" colspan="14" class="brbottom brleft"> <span class="colorXanh">Tổng tất cả:</span> </td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstong['tongsoluong'],3,".",",").' </strong></td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstong['tongdongia'],3,".",",").' </strong></td>
							<td align="right"></td>
						</tr>    
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
	break;
	
	case"KhoKhacKhoKimCuongEpTemTKNhapKho":
		$sql = "select * from $GLOBALS[db_sp].khokhac_khokimcuongeptemct 
					where type=2 
					$whdatechuyen
					order by maphieu asc, dated asc
		";
		
		$sql_tong = "select ROUND(count(id), 3) as tongsoluong, 
							ROUND(SUM(dongiaban), 3) as tongdongia 
							from $GLOBALS[db_sp].khokhac_khokimcuongeptemct 
							where type=2
							$whdatechuyen
		";
		
		$rstong = $GLOBALS['sp']->getRow($sql_tong);
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.date("d/m/Y", strtotime($value['datechuyen'])).'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
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
				<td height="25" align="right"s>
					1
				</td>
				<td height="25" align="right">
					 '.number_format($value['dongiaban'],3,".",",").'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
								<strong>Ngày Nhận</strong>
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
							<td class="text-right">
								Số Lượng
						   </td> 
							<td height="25" align="center" class="brbottom brleft">
								<strong>Đơn Giá</strong>
							</td>
						</tr>
						'.$str.'
						<tr>
							<td align="right" colspan="14" class="brbottom brleft"> <span class="colorXanh">Tổng tất cả:</span> </td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstong['tongsoluong'],3,".",",").' </strong></td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstong['tongdongia'],3,".",",").' </strong></td>
							<td align="right"></td>
						</tr>    
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
	break;
	
	case"KhoKhacKhoKimCuongEpTemTKChiTietTon":
		$sql = "select * from $GLOBALS[db_sp].khokhac_khokimcuongeptemct 
				where type=2 
				and trangthai < 2
				$whdatechuyen
				order by maphieu asc, dated desc
		";
		$sql_tong = "select ROUND(count(id), 3) as tongsoluong, 
							ROUND(SUM(dongiaban), 3) as tongdongia 
							from $GLOBALS[db_sp].khokhac_khokimcuongeptemct 
							where type=2 
							and trangthai < 2
							$whdatechuyen
		";
		
		$rstong = $GLOBALS['sp']->getRow($sql_tong);
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.date("d/m/Y", strtotime($value['datechuyen'])).'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
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
				<td height="25" align="right"s>
					1
				</td>
				<td height="25" align="right">
					 '.number_format($value['dongiaban'],3,".",",").'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
								<strong>Ngày Nhận</strong>
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
							<td class="text-right">
								Số Lượng
						   </td> 
							<td height="25" align="center" class="brbottom brleft">
								<strong>Đơn Giá</strong>
							</td>
						</tr>
						'.$str.'
						<tr>
							<td align="right" colspan="14" class="brbottom brleft"> <span class="colorXanh">Tổng tất cả:</span> </td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstong['tongsoluong'],3,".",",").' </strong></td>
							<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstong['tongdongia'],3,".",",").' </strong></td>
							<td align="right"></td>
						</tr>    
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
	break;
	
	
	case"KhoKhacKhoLamMoiTKXuatKho":
		$sql = "select * from $GLOBALS[db_sp].khokhac_kholammoict 
				where trangthai = 2
				and (type = 2 or type=3)
				and datedxuat IS NOT NULL
				$whdatechuyen 
				$whloaivang
				order by maphieu asc, id asc
		";
		$sql_tongnhap = "select ROUND(SUM(cannangv), 3) as tongsoluongnhap ,
							ROUND(SUM(hao), 3) as hao, 
							ROUND(SUM(du), 3) as du  
					from $GLOBALS[db_sp].khokhac_kholammoict 
					where trangthai = 2
					and (type = 2 or type=3)
					and datedxuat IS NOT NULL
					$whdatechuyen 
					$whloaivang
				";
		$rstongnhap = $GLOBALS['sp']->getRow($sql_tongnhap);
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
			$str .= '
				<tr> 
					<td height="25" align="left">
						'.$i.'
					</td>
					<td height="25" align="left">
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td height="25" align="left">
						'.$value['maphieu'].'
					</td>
					<td height="25" align="left">
						'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
					</td>
					<td height="25" align="left">
						'.getName("categories","name_vn",$value['tennguyenlieuvang']).'
					</td>
					<td height="25" align="left">
						'.getName("loaivang","name_vn",$value['idloaivang']).'
					</td>
					<td height="25" align="right">
						'.number_format($value['cannangv'],3,".",",").'
					</td>
					<td height="25"  align="right">
						'.number_format($value['tuoivang'],4,".",",").'
					</td>
					
					<td height="25" align="left" >
						 '.$value['tienmatvang'].'
					</td>
					<td height="25" align="right" >
						 '.number_format($value['hao'],3,".",",").'
					</td>
					<td height="25" align="right" >
						 '.number_format($value['du'],3,".",",").'
					</td>
					<td height="25" align="left" >
						 '.$value['ghichu'].'
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
									<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
									<strong>Ngày Nhận</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Nhóm N Liệu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Tên N Liệu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Loại Vàng</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Vàng Xuất</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tuổi Vàng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tiền Mặt</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Hao</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Dư</strong>
								</td>
								
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ghi chú</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="6" class="brbottom brleft"> <span class="colorXanh">Tổng Kho:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['tongsoluongnhap'],3,".",",").' </strong></td>
								<td align="right" class="brbottom brleft"></td>
								<td align="right" class="brbottom brleft"></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['hao'],3,".",",").' </strong></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['du'],3,".",",").' </strong></td>
								<td align="center"></td>
							</tr>     
						</table>
			
					</td>
				</tr>
				 
			</table>
		';
	break;
	
	case"KhoKhacKhoLamMoiTKNhapKho":
		$sql = "select * from $GLOBALS[db_sp].khokhac_kholammoict 
				where 1=1
				and (type = 2 or type=3)
				$whdatechuyen 
				$whloaivang
				order by maphieu asc, id asc
		";
		
		$sql_tongnhap = "select ROUND(SUM(cannangv), 3) as tongsoluongnhap,
							ROUND(SUM(hao), 3) as hao, 
							ROUND(SUM(du), 3) as du  
					from $GLOBALS[db_sp].khokhac_kholammoict 
					where 1=1
					and (type = 2 or type=3)
					$whdatechuyen 
					$whloaivang
		";
		$rstongnhap = $GLOBALS['sp']->getRow($sql_tongnhap);
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
			$str .= '
				<tr> 
					<td height="25" align="left">
						'.$i.'
					</td>
					<td height="25" align="left">
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td height="25" align="left">
						'.$value['maphieu'].'
					</td>
					<td height="25" align="left">
						'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
					</td>
					<td height="25" align="left">
						'.getName("categories","name_vn",$value['tennguyenlieuvang']).'
					</td>
					<td height="25" align="left">
						'.getName("loaivang","name_vn",$value['idloaivang']).'
					</td>
					<td height="25" align="right">
						'.number_format($value['cannangv'],3,".",",").'
					</td>
					<td height="25"  align="right">
						'.number_format($value['tuoivang'],4,".",",").'
					</td>
					
					<td height="25" align="left" >
						 '.$value['tienmatvang'].'
					</td>
					<td height="25" align="right" >
						 '.number_format($value['hao'],3,".",",").'
					</td>
					<td height="25" align="right" >
						 '.number_format($value['du'],3,".",",").'
					</td>
					<td height="25" align="left" >
						 '.$value['ghichu'].'
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
									<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
									<strong>Ngày Nhận</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Nhóm N Liệu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Tên N Liệu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Loại Vàng</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Vàng Nhập</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tuổi Vàng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tiền Mặt</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Hao</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Dư</strong>
								</td>
								
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ghi chú</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="6" class="brbottom brleft"> <span class="colorXanh">Tổng Kho:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['tongsoluongnhap'],3,".",",").' </strong></td>
								<td align="right" class="brbottom brleft"></td>
								<td align="right" class="brbottom brleft"></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['hao'],3,".",",").' </strong></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['du'],3,".",",").' </strong></td>
								<td align="center"></td>
							</tr>     
						</table>
			
					</td>
				</tr>
				 
			</table>
		';
	break;
	
	case"KhoKhacKhoLamMoiTKChiTietTonKho":
		$sql = "select * from $GLOBALS[db_sp].khokhac_kholammoict 
				where trangthai < 2
				and (type = 2 or type=3)
				and datedxuat IS NULL
				$whloaivang
				$whdatechuyen
				order by maphieu asc, id asc
		";
		$sql_tongnhap = "select ROUND(SUM(cannangv), 3) as tongsoluongnhap,
							ROUND(SUM(hao), 3) as hao, 
							ROUND(SUM(du), 3) as du  
				from $GLOBALS[db_sp].khokhac_kholammoict 
				where trangthai < 2
				and (type = 2 or type=3)
				and datedxuat IS NULL
				$whloaivang
				$whdatechuyen
		";
		$rstongnhap = $GLOBALS['sp']->getRow($sql_tongnhap);
		$rscth = $GLOBALS["sp"]->getAll($sql);
		$tongVangNhap = $tongVangTon = $tongQ10 = $SLQ10 = 0;
		foreach($rscth as $value){
			$SLQ10 = 0;
			if($value['tuoivang'] > 0){
				$SLQ10 = $value['cannangv'] * $value['tuoivang'];
				$tongQ10 = $tongQ10 + $SLQ10;
			}
			$str .= '
				<tr> 
					<td height="25" align="left">
						'.$i.'
					</td>
					<td height="25" align="left">
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td height="25" align="left">
						'.$value['maphieu'].'
					</td>
					<td height="25" align="left">
						'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
					</td>
					<td height="25" align="left">
						'.getName("categories","name_vn",$value['tennguyenlieuvang']).'
					</td>
					<td height="25" align="left">
						'.getName("loaivang","name_vn",$value['idloaivang']).'
					</td>
					<td height="25" align="right">
						'.number_format($value['cannangv'],3,".",",").'
					</td>
					<td height="25"  align="right">
						'.number_format($value['tuoivang'],4,".",",").'
					</td>
					<td  height="25" align="right">
						'.number_format($SLQ10,3,".",",").'
					</td>
					
					<td height="25" align="left" >
						 '.$value['tienmatvang'].'
					</td>
					<td height="25" align="right" >
						 '.number_format($value['hao'],3,".",",").'
					</td>
					<td height="25" align="right" >
						 '.number_format($value['du'],3,".",",").'
					</td>
					<td height="25" align="left" >
						 '.$value['ghichu'].'
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
									<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
									<strong>Ngày Nhận</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Nhóm N Liệu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Tên N Liệu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Loại Vàng</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Vàng Tồn</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tuổi Vàng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>TT Vàng Q10</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tiền Mặt</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Hao</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Dư</strong>
								</td>
								
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ghi chú</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="6" class="brbottom brleft"> <span class="colorXanh">Tổng Kho:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['tongsoluongnhap'],3,".",",").' </strong></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"></strong></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongQ10,3,".",",").' </strong></td>
								<td align="right"></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['du'],3,".",",").' </strong></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['hao'],3,".",",").' </strong></td>
								<td align="center"></td>
							</tr>     
						</table>
			
					</td>
				</tr>
				 
			</table>
		';
	break;
	
	case"KhoKhacKhoSauCheTacTKXuatKho":
		$sql = "select * from $GLOBALS[db_sp].khokhac_khotongdecuc 
				where typesauchetac=2
				and trangthai=2
				$whdatechuyen 
				order by maphieu asc, id asc
		";
		$sql_tongnhap = "select ROUND(SUM(trongluongvangsauchetac), 3) as tongsoluongnhap,
						ROUND(SUM(hao), 3) as hao, 
						ROUND(SUM(du), 3) as du  
						from $GLOBALS[db_sp].khokhac_khotongdecuc 
						where typesauchetac=2
						and trangthai=2
						$whdatechuyen 
		";
		$rstongnhap = $GLOBALS['sp']->getRow($sql_tongnhap);
		
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
			$str .= '
				<tr> 
					<td height="25" align="left">
						'.$i.'
					</td>
					<td height="25" align="left">
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td height="25" align="left">
						'.$value['maphieu'].'
					</td>
					<td height="25" align="left">
						'.getName("loaivang","name_vn",$value['idloaivang']).'
					</td>
					<td height="25" align="right">
						'.number_format($value['trongluongvangsauchetac'],3,".",",").'
					</td>
					<td height="25"  align="right">
						'.number_format($value['tuoivangsauchetac'],4,".",",").'
					</td>
					<td  height="25" align="right">
						'.number_format($value['hao'],3,".",",").'
					</td>
					<td  height="25" align="right">
						'.number_format($value['du'],3,".",",").'
					</td>
					<td height="25" align="left" >
						 '.$value['ghichu'].'
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
									<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
									<strong>Ngày Nhận</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Loại Vàng</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Tổng TL vàng sau chế tác</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tuổi vàng sau chế tác</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Hao</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Dư</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ghi chú</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="4" class="brbottom brleft"> <span class="colorXanh">Tổng Nhập Kho:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['tongsoluongnhap'],3,".",",").' </strong></td>
								<td align="right"></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['hao'],3,".",",").' </strong></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['du'],3,".",",").' </strong></td>
								<td align="center"></td>
							</tr>     
						</table>
			
					</td>
				</tr>
				 
			</table>
		';
	break;
	
	case"KhoKhacKhoSauCheTacTKNhapKho":
		$sql = "select * from $GLOBALS[db_sp].khokhac_khotongdecuc 
				where typesauchetac=2
				$whdatechuyen 
				$whloaivang
				order by maphieu asc, id asc
		";
		
		$sql_tongnhap = "select ROUND(SUM(trongluongvangsauchetac), 3) as tongsoluongnhap,
						ROUND(SUM(hao), 3) as hao, 
						ROUND(SUM(du), 3) as du  
						from $GLOBALS[db_sp].khokhac_khotongdecuc 
						where typesauchetac=2
						$whdatechuyen 
						$whloaivang
		";
		$rstongnhap = $GLOBALS['sp']->getRow($sql_tongnhap);
		
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
			$str .= '
				<tr> 
					<td height="25" align="left">
						'.$i.'
					</td>
					<td height="25" align="left">
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td height="25" align="left">
						'.$value['maphieu'].'
					</td>
					<td height="25" align="left">
						'.getName("loaivang","name_vn",$value['idloaivang']).'
					</td>
					<td height="25" align="right">
						'.number_format($value['trongluongvangsauchetac'],3,".",",").'
					</td>
					<td height="25"  align="right">
						'.number_format($value['tuoivangsauchetac'],4,".",",").'
					</td>
					<td  height="25" align="right">
						'.number_format($value['hao'],3,".",",").'
					</td>
					<td  height="25" align="right">
						'.number_format($value['du'],3,".",",").'
					</td>
					<td height="25" align="left" >
						 '.$value['ghichu'].'
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
									<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
									<strong>Ngày Nhận</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Loại Vàng</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Tổng TL vàng sau chế tác</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tuổi vàng sau chế tác</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Hao</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Dư</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ghi chú</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="4" class="brbottom brleft"> <span class="colorXanh">Tổng Nhập Kho:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['tongsoluongnhap'],3,".",",").' </strong></td>
								<td align="right"></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['hao'],3,".",",").' </strong></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['du'],3,".",",").' </strong></td>
								<td align="right"></td>
								<td align="center"></td>
							</tr>     
						</table>
			
					</td>
				</tr>
				 
			</table>
		';
	break;
	
	case"KhoKhacKhoSauCheTacTKChiTietTon":
		$sql = "select * from $GLOBALS[db_sp].khokhac_khotongdecuc 
				where trangthai < 2
				and typesauchetac=2
				$whloaivang
				$whdatechuyen
				order by maphieu asc, id asc
		";
		$sql_sum = "select count(id) from $GLOBALS[db_sp].khokhac_khotongdecuc 
					where trangthai < 2
					and typesauchetac=2
					$whloaivang 
					$whdatechuyen
		";
		
		$sql_tongnhap = "select ROUND(SUM(trongluongvangsauchetac), 3) as tongsoluongnhap,
						ROUND(SUM(hao), 3) as hao, 
						ROUND(SUM(du), 3) as du  
						from $GLOBALS[db_sp].khokhac_khotongdecuc 
						where trangthai < 2
						and typesauchetac=2
						$whloaivang 
						$whdatechuyen
		";
		$rstongnhap = $GLOBALS['sp']->getRow($sql_tongnhap);
		
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
			$str .= '
				<tr> 
					<td height="25" align="left">
						'.$i.'
					</td>
					<td height="25" align="left">
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td height="25" align="left">
						'.$value['maphieu'].'
					</td>
					<td height="25" align="left">
						'.getName("loaivang","name_vn",$value['idloaivang']).'
					</td>
					<td height="25" align="right">
						'.number_format($value['trongluongvangsauchetac'],3,".",",").'
					</td>
					<td height="25"  align="right">
						'.number_format($value['tuoivangsauchetac'],4,".",",").'
					</td>
					<td  height="25" align="right">
						'.number_format($value['hao'],3,".",",").'
					</td>
					<td  height="25" align="right">
						'.number_format($value['du'],3,".",",").'
					</td>
					<td height="25" align="left" >
						 '.$value['ghichu'].'
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
									<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
									<strong>Ngày Nhận</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Loại Vàng</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Tổng TL vàng sau chế tác</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tuổi vàng sau chế tác</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Hao</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Dư</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ghi chú</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="4" class="brbottom brleft"> <span class="colorXanh">Tổng Nhập Kho:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['tongsoluongnhap'],3,".",",").' </strong></td>
								<td align="right"></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['hao'],3,".",",").' </strong></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['du'],3,".",",").' </strong></td>
								<td align="center"></td>
							</tr>     
						</table>
			
					</td>
				</tr>
				 
			</table>
		';
	break;

	case"KhoKhacKhoTongDeCucTKXuatKho":
		$sql = "select * from $GLOBALS[db_sp].khokhac_khotongdecucct 
					where type=2
					and id in ( select idmaphieu from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac where dated >= '".$fromDate."' and dated <= '".$toDate."' group by idmaphieu )
					$whloaivang 
					order by dated asc, id asc
			";
			
		$sql_tongnhap = "select ROUND(sum(tlvangcat), 3) as tongsoluong
			from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
			where 1=1 
			and dated >= '".$fromDate."' 
			and dated <= '".$toDate."'
		";
		//die($sql);
		$rstongnhap = $GLOBALS['sp']->getRow($sql_tongnhap);
		
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
			$vangXuatkho = getKhoKhacKhoTongDeCucVangxuatkho($value['id'], $value['cannangv'], $fromDate, $toDate);
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
					<td height="25" align="left">
						'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
					</td>
					<td height="25" align="left">
						'.getName("categories","name_vn",$value['tennguyenlieuvang']).'
					</td>
					<td height="25"  align="left">
						'.getName("loaivang","name_vn",$value['idloaivang']).'
					</td>
					<td  height="25" align="right">
						'.number_format($vangXuatkho,3,".",",").'
					</td>
					<td height="25" align="right">
						'.$value['tuoivang'].'
					</td>
					<td height="25" align="left">
						'.$value['tienmatvang'].'
					</td>
					<td height="25" align="right">
						 '.number_format($value['hao'],3,".",",").'
					</td>
					<td height="25" align="right">
						 '.number_format($value['du'],3,".",",").'
					</td>
					<td height="25" align="left" >
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
									<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
									<strong>Ngày Nhận</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Nhóm N Liệu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Tên N Liệu</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Loại Vàng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Vàng Xuất</strong>
								</td>
								
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tuổi Vàng</strong>
								</td>
								
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tiền Mặt</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Hao</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Dư</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ghi chú</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="6" class="brbottom brleft"> <span class="colorXanh">Tổng Xuất Kho:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['tongsoluong'],3,".",",").' </strong></td>
								<td align="right"></td>
								<td align="right"></td>
								<td align="center"></td>
								<td align="right"> </td>
								<td align="right"></td>
							</tr>     
						</table>
			
					</td>
				</tr>
				 
			</table>
		';
	break;
	
	case"KhoKhacKhoTongDeCucTKNhapKho":
		$sql = "select * from $GLOBALS[db_sp].khokhac_khotongdecucct 
				where type=2
				$whloaivang 
				$whdatechuyen
				order by datechuyen asc, id asc
		";
			
		$sql_tongnhap = "select ROUND(sum(cannangv), 3) as tongsoluong
			from $GLOBALS[db_sp].khokhac_khotongdecucct 
			where type=2
			$whloaivang 
			$whdatechuyen
		";
		$rstongnhap = $GLOBALS['sp']->getRow($sql_tongnhap);
		
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
			$str .= '
				<tr> 
					<td height="25" align="left">
						'.$i.'
					</td>
					<td height="25" align="left">
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td height="25" align="left">
						'.$value['maphieu'].'
					</td>
					<td height="25" align="left">
						'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
					</td>
					<td height="25" align="left">
						'.getName("categories","name_vn",$value['tennguyenlieuvang']).'
					</td>
					<td height="25"  align="left">
						'.getName("loaivang","name_vn",$value['idloaivang']).'
					</td>
					<td  height="25" align="right">
						'.number_format($value['cannangv'],3,".",",").'
					</td>
					<td height="25" align="right">
						'.$value['tuoivang'].'
					</td>
					<td height="25" align="left">
						'.$value['tienmatvang'].'
					</td>
					<td height="25" align="right">
						 '.number_format($value['hao'],3,".",",").'
					</td>
					<td height="25" align="right">
						 '.number_format($value['du'],3,".",",").'
					</td>
					<td height="25" align="right" >
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
									<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
									<strong>Ngày Nhận</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Nhóm N Liệu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Tên N Liệu</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Loại Vàng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Vàng Nhập</strong>
								</td>
								
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tuổi Vàng</strong>
								</td>
								
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tiền Mặt</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Hao</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Dư</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ghi chú</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="6" class="brbottom brleft"> <span class="colorXanh">Tổng Nhập Kho:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($rstongnhap['tongsoluong'],3,".",",").' </strong></td>
								<td align="right"></td>
								<td align="right"></td>
								<td align="center"></td>
								<td align="right"> </td>
								<td align="right"></td>
							</tr>     
						</table>
			
					</td>
				</tr>
				 
			</table>
		';
	break;
	
	case"KhoKhacKhoTongDeCucTKChiTietTon":
		$sql = "select * from $GLOBALS[db_sp].khokhac_khotongdecucct 
				where trangthai <> 3 
				and type=".$type."
				$whloaivang 
				$whdatechuyen
				and slcannangvcon > 0
				order by trangthai asc, datechuyen asc, id asc
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);
		$tongVangNhap = $tongVangTon = $tongQ10 = 0;
		foreach($rscth as $value){
			$vangTonQ10 = getKhoKhacKhoTongDeCucVangton($value['id'], $value['cannangv'], $toDate);
			
			if($vangTonQ10 > 0){
				$tongVangNhap = $tongVangNhap + $value['cannangv'];
				$tongVangTon = $tongVangTon + $vangTonQ10; 
				$SLQ10 = $vangTonQ10 * $value['tuoivang'];
				$tongQ10 = $tongQ10 + $SLQ10;
				$str .= '
					<tr> 
						<td height="25" align="left">
							'.$i.'
						</td>
						<td height="25" align="left">
							'.date("d/m/Y", strtotime($value['datechuyen'])).'
						</td>
						<td height="25" align="left">
							'.$value['maphieu'].'
						</td>
						<td height="25" align="left">
							'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
						</td>
						<td height="25" align="left">
							'.getName("categories","name_vn",$value['tennguyenlieuvang']).'
						</td>
						<td height="25"  align="left">
							'.getName("loaivang","name_vn",$value['idloaivang']).'
						</td>
						<td  height="25" align="right">
							'.number_format($value['cannangv'],3,".",",").'
						</td>
						<td height="25" align="right">
							'.number_format($vangTonQ10,3,".",",").'
						</td>
						<td height="25" align="right">
							'.$value['tuoivang'].'
						</td>
						<td height="25" align="right">
							'.number_format($SLQ10,3,".",",").'
						</td>
						<td height="25" align="left">
							'.$value['tienmatvang'].'
						</td>
						<td height="25" align="right">
							 '.number_format($value['hao'],3,".",",").'
						</td>
						<td height="25" align="right">
							 '.number_format($value['du'],3,".",",").'
						</td>
						<td height="25" align="left" >
							 '.$value['ghichuvang'].'
						</td>
					</tr>
				';	
				$i++;
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
									<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
									<strong>Ngày Nhận</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Nhóm N Liệu</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft">
									<strong>Tên N Liệu</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Loại Vàng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Vàng Nhập</strong>
								</td>
								
								<td height="25" align="center" class="brbottom brleft">
									<strong>Vàng Tồn</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tuổi Vàng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>TT Vàng Q10</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tiền Mặt</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Hao</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Dư</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ghi chú</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="6" class="brbottom brleft"> <span class="colorXanh">Tổng Kho:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongVangNhap,3,".",",").' </strong></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongVangTon,3,".",",").' </strong></td>
								<td align="right" class="brbottom brleft"></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongQ10,3,".",",").' </strong></td>
								<td align="right"> </td>
								<td align="right"> </td>
								<td align="right"> </td>
								<td align="right"></td>
							</tr>     
						</table>
			
					</td>
				</tr>
				 
			</table>
		';
	break;

	case"KhoKimCuongSauEpTemKhoLuuTru":
		$sql = "select * from $GLOBALS[db_sp].khoeptepsaukimcuong_giamdockynhan 
				where type=".$type." 
				and trangthai=0
				$whdatechuyen
				order by datechuyen asc, idmaphieukho asc
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.date("d/m/Y", strtotime($value['datechuyen'])).'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
								<strong>Ngày Nhận</strong>
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
						</tr>
						'.$str.'
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
	break;
	
	case"KhoKimCuongEpTemKhoLuuTru":
		$sql = "select * from $GLOBALS[db_sp].khoeptepkimcuong_giamdockynhan 
				where type=".$type." 
				and trangthai=0
				$whdatechuyen
				order by dated asc, idmaphieukho asc
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
								<strong>Ngày Nhập</strong>
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
						</tr>
						'.$str.'
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
	break;
	
	case"KhoLamMoiKhoLuuTru":
		$sql = "select * from $GLOBALS[db_sp].kholammoi_giamdockynhan 
				where type=".$type." 
				and trangthai=0
				$whdatechuyen
				order by datechuyen asc, idmaphieukho asc
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.date("d/m/Y", strtotime($value['datechuyen'])).'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
				</td>
				<td height="25" align="left">
					'.$value['madonhangsx'].'
				</td>
				<td height="25"  align="left">
					'.getName("loaivang","name_vn",$value['idloaivang']).'
				</td>
				<td  height="25" align="right">
					'.number_format($value['trongluongvangtrenso'],3,".",",").'
				</td>
				<td height="25" align="right">
					'.number_format($value['trongluongvangcan'],3,".",",").'
				</td>
				<td height="25" align="right">
					 '.number_format($value['hao'],3,".",",").'
				</td>
				<td height="25" align="right">
					 '.number_format($value['du'],3,".",",").'
				</td>
				<td height="25" align="right" >
					 '.$value['ghichu'].'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
								<strong>Ngày Nhận</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Phiếu</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Đơn Hàng</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Loại Vàng</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tổng TL Vàng Trên Sổ</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tổng TL Vàng Cân TT</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Hao</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Dư</strong>
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
	break;
	
	case"KhoSauCheTacKhoLuuTru":
		$sql = "select * from $GLOBALS[db_sp].khosauchetac_giamdockynhan 
				where type=".$type." 
				and trangthai=0
				$wh 
				$whdatechuyen
				order by datechuyen asc, idmaphieukho asc
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.date("d/m/Y", strtotime($value['datechuyen'])).'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
				</td>
				<td height="25"  align="left">
					'.getName("loaivang","name_vn",$value['idloaivang']).'
				</td>
				<td  height="25" align="right">
					'.number_format($value['trongluongvangsauchetac'],3,".",",").'
				</td>
				<td height="25" align="right">
					'.number_format($value['tuoivangsauchetac'],4,".",",").'
				</td>
				<td height="25" align="right">
					 '.number_format($value['hao'],3,".",",").'
				</td>
				<td height="25" align="right">
					 '.number_format($value['du'],3,".",",").'
				</td>
				<td height="25" align="right" >
					 '.$value['ghichu'].'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
								<strong>Ngày Nhận</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Phiếu</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Loại Vàng</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tổng TL vàng sau chế tác</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tuổi vàng sau chế tác</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Hao</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Dư</strong>
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
	break;
	
	case"KhoDeCucPhanKimKhoLuuTru":
		$sql = "select * from $GLOBALS[db_sp].khotongdecuc_giamdockynhan 
				where type=".$type." and trangthai=0
				order by dated asc, idmaphieukho asc
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);
		foreach($rscth as $value){
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
					'.getName("loaivang","name_vn",$value['idloaivang']).'
				</td>
				<td  height="25" align="right">
					'.number_format($value['trongluongvangsauchetac'],3,".",",").'
				</td>
				<td height="25" align="right">
					'.number_format($value['tuoivangsauchetac'],3,".",",").'
				</td>
				<td height="25" align="right">
					 '.number_format($value['hoiche'],3,".",",").'
				</td>
				<td height="25" align="right" >
					 '.$value['ghichu'].'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
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
								<strong>Ngày Nhập</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Phiếu</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Loại Vàng</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tổng TL vàng sau chế tác</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tuổi vàng sau chế tác</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Hội chế tác</strong>
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
	break;
	////////////////////////////////////////////VŨ THÊM KHO BỘT////////////////////////////////////////////
	/////Print chi tiết phiếu xuất kho được chọn theo Id
	case"PrintIdXuatKhoKhoBot":
		$str = "";
		$stt = 1;
		$id = ceil($_GET["id"]);
		$sql = "select * from $GLOBALS[db_sp].bot_khobot where id=$id";
		$rs = $GLOBALS["sp"]->getRow($sql);
		$sqlct = "select * from $GLOBALS[db_sp].bot_khobot where idchonphieunhap=".$id." and type=1 order by id desc";
		$rsct = $GLOBALS["sp"]->getAll($sqlct);
		foreach($rsct as $value){
			$str .= '
					<tr>
						<td align="center">'.$stt.'</td>
						<td align="center">
							<input type="checkbox" checked disabled/>
						</td>
						<td align="left">
							'.$value['maphieu'].'
						</td>
						<td align="right">
							'.getName("loaivang","name_vn",$value['idloaivang']).'
						</td>
						<td align="right">
							'.number_format($value['cannangvh'],3,".",",").'
						</td>
						<td align="right">
							'.number_format($value['cannangh'],3,".",",").'
						</td>
						<td align="right">
							'.number_format($value['cannangv'],3,".",",").'
						</td>
						<td align="right">
							'.number_format(getTongQ10($value['cannangv'],$value['idloaivang']),3,".",",").'
						</td>
						<td align="left">
							'.$value['ghichuvang'].'
						</td>
					</tr>
					';
			$stt++;
			}
		echo'
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" height="80" >
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100%" colspan="2" valign="top" align="right" class="logan red">
									Ngày in phiếu: '.$datenow.'
								</td>
							</tr>
							<tr>
								<td width="30%" valign="top" align="left" class="logan red">
									<img width="120" src="../images/logo.png"/> <br>
								</td>
								<td width="70%" valign="top" align="left" >
									<div class="XuatkhoPrint PrintPhieuchi">THÔNG TIN CHI TIẾT PHIẾU XUẤT KHO CỦA KHO BỘT</div> 								
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						 <table style="width:80%">
						 	<tr>
								<td colspan="2"></td>
							</tr>						 	
						 	<tr>
								<td>Người Lập Phiếu: '.$rs["nguoilapphieu"].'</td>
								<td>Mã phiếu: '.$rs['maphieu'].'</td>
							</tr>
							<tr>
								<td>Loại Vàng Dẻ Nấu: '.getName("loaivang","name_vn",$rs['idloaivang']) .'   </td>
								<td>Ngày nhập: '.date("d/m/Y", strtotime($rs['dated'])).'</td>
							</tr>
							<tr>
								<td>TL Vàng Sau Nấu: '.number_format($rs['cannangv'],3,".",",").'</td>
								<td>Tổng TL vàng trước nấu: '.number_format($rs['tlvangtruocnau'],3,".",",").'</td>
							</tr>
							<tr>
								<td>Tuổi Vàng Sau Nấu: '.$rs['tuoivang'].'</td>
								<td>Q10 trước nấu: '.number_format($rs['q10truocnau'],3,".",",").'</td>
							</tr>
							<tr>
								<td>Q10 sau nấu: '.number_format($rs['q10saunau'],3,".",",").'</td>
								<td>Hao Q10: '.number_format($rs['hao'],3,".",",").'</td>
							</tr>
							<tr>
								<td></td>
								<td>Dư Q10: '.number_format($rs['du'],3,".",",").'</td>
							</tr>
							<tr>
								<td colspan="2"></td>
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
									<strong>Chọn</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Mã phiếu</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Loại vàng</strong>
								</td>							
								
								<td height="25" align="center" class="brbottom brleft">
									<strong>Cân nặng V+H </strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Cân nặng H </strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Cân nặng V</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Q10</strong>
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
		
	break;
	/////Thống kê tồn kho hiện tại
	case"tonkhoKhoBot":
		$fromDateGach = $fromDates;
		$toDateGach = $toDates;
		$strFromTo = "Từ Ngày: ".date("d/m/Y")." -  Đến Ngày: ".date("d/m/Y");
		if(!empty($fromDates)){
			$fromDate = explode('/',$fromDates);
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
		    $fromDateGach[2].'/'.$fromDateGach[1].'/'.$fromDateGach[0];
			$strFromTo = "Từ Ngày: ".$fromDates." -  Đến Ngày: ".$toDates;
		}		
		$wh = '';
		if(ceil($idloaivang) > 0)
			$wh = " and id = ".$idloaivang." ";
		$sqlvang1 = "select * from $GLOBALS[db_sp].loaivang where active=1 $wh order by id asc"; 
		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);	
		
		foreach($rscth as $value){
			$viewdl = array();
			$viewdl = thongKeTonKhoKhoKhacKhoBot($cid, $value['id'], $fromDateGach, $toDateGach);		
			$styleColorRow = "";							
			if(ceil($viewdl['idloaivang']) > 0){
				if( $i % 2 == 0 ){
					$styleColorRow = "style='background-color:#f9f9f9;'";
					}				
				$str .= '
					<tr '.$styleColorRow.'> 
						<td height="25" align="right">
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
							 '.number_format($viewdl['slhaochenhlech'],3,".",",").'
						</td>
						<td height="25" align="right">
							 '.number_format($viewdl['slduchenhlech'],3,".",",").'
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
				$i++;
				}							
			}			
	echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="80" >
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" colspan="2" valign="top" align="right" class="logan red">
								Ngày in phiếu: '.$datenow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">THỐNG KÊ TỒN KHO</div> 
								<div class="DatedPrint DatedPhieuchi" style="margin-bottom:10px">'.$strFromTo.'</div>								
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
								<strong>Hao </strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Dư </strong>
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
							<td height="25" align="right" colspan="7"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
							<td align="right"><strong class="colorXanh">'.number_format($tongtongQ10,3,".",",").'</strong></td>
						</tr>   
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
	break;
	/////Thống kê bột nấu chờ nhập kho+ bột nấu xuất kho
	case"ChoNhapKhoKhoBot":
	case"xuatkhoKhoBot":	
		$sqlFrom = " from $GLOBALS[db_sp].bot_khobot ";	
		$sqlRound = " ROUND(SUM(cannangv), 3) as cannangv ";	
		$sqlGroupOrder = " group by idloaivang
						   order by idloaivang asc";	
		$tieude = "";	
		//thống kê bột nấu chờ nhập kho
		if($act=="ChoNhapKhoKhoBot"){
			$tieude = "THỐNG KÊ BỘT NẤU CHỜ NHẬP KHO";
			$sqlWhere = " where type = 3 and trangthai = 1 ";
			$sqlDatedChuyen = " and datechuyen >= '".$fromDate."' and datechuyen <= '".$toDate."' ";
			$sqlOrderDatedChuyen = " order by datechuyen desc, id desc ";
			$datedXuatChuyen = "datechuyen";
			$sql = "select * ".$sqlFrom.$sqlWhere.$whloaivang.$sqlDatedChuyen.$sqlOrderDatedChuyen; //sql lấy phiếu thỏa đk
			$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$whloaivang.$sqlDatedChuyen.$sqlGroupOrder; //sql tính tông cân nặng vàng theo loại vàng	
			$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere.$sqlDatedChuyen; //sql tính tổng cân nặng vàng
			}
		//thống kê bột nấu xuất kho
		 if($act=="xuatkhoKhoBot"){
			$tieude = "THỐNG KÊ BỘT NẤU XUẤT KHO";
			$sqlWhere = " where type = 3 and trangthai = 2 ";	
			$sqlDatedXuat = " and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' ";	
			$sqlOrderDatedXuat = " order by datedxuat desc, id desc ";	
			$datedXuatChuyen = "datedxuat";
			$sql = "select * ".$sqlFrom. $sqlWhere.$whloaivang.$sqlDatedXuat.$sqlOrderDatedXuat; //sql lấy phiếu thỏa đk
			$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$whloaivang.$sqlDatedXuat.$sqlGroupOrder; //sql tính tông cân nặng vàng loại vàng	
			$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere.$sqlDatedXuat;//sql tính tổng cân nặng vàng
			}
		$rscth = $GLOBALS["sp"]->getAll($sql);				
		$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);		
		$rstong = $GLOBALS['sp']->getRow($sql_tong);
		//////
		$i = 1;
			foreach($rscth as $value){
				$datedshow = $phongchuyen = '';
				$phongchuyen = 'Phòng SX';
				$styleColorRow = "";
				if($i %2 == 0){
					$styleColorRow = "style='background-color:#f9f9f9;'";
					}
				$str .= '
						<tr '.$styleColorRow.'>
							<td height="25" align="center">
							'.$i.'
							</td>
							<td height="25" align="center">
								'.date("d/m/Y", strtotime($value[$datedXuatChuyen])).'
							</td>
							<td height="25" align="left">
								'.$value['maphieu'].'
							</td>
							<td>
								'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
							</td>
							<td>
								'.getName("categories","name_vn",$value['tennguyenlieuvang']).'
							</td>
							<td height="25" align="right">
								'.getName("loaivang","name_vn",$value['idloaivang']).' 
							</td>
							<td height="25" align="right">
								 '.number_format($value['cannangv'],3,".",",").'
							</td>
							<td height="25" align="right">
								'.number_format($value['tlvangtruocnau'],3,".",",").'
							</td>				
							<td height="25" align="right">
								 '.number_format($value['tuoivang'],4,".",",").'
							</td>
							<td height="25" align="right">
								 '.number_format($value['hao'],3,".",",").'
							</td>
							<td height="25" align="right">
								 '.number_format($value['du'],3,".",",").'
							</td>
							<td height="25" align="left">						
								 '.getLinkTitle($value['chonphongbanin'],1).'
							</td>
							<td height="25" align="left">
								 '.$value['ghichuvang'].'
							</td>
						</tr>
						';
						$i++;
					}
				$strStyle1 = 'height="25" align="right" style="font-size:16px;font-weight:bold;"';
				foreach($rstongloaivang as $vltongloaivang){
					$str .= '
						<tr>
							<td colspan="5" ></td>
							<td '.$strStyle1.'>
								'.getName("loaivang","name_vn",$vltongloaivang['idloaivang']).'
							 </td>
							<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangv'],3,".",",").'</td>
							<td colspan="6" ></td>
						</tr>
						';
					}
				$strStyle2 = 'height="25" align="right" style="font-size:17px;font-weight: bold;"';
				$str .= '
					<tr>
							<td colspan="5" ></td>
							<td '.$strStyle2.'>Tổng tất cả: </td>
							<td '.$strStyle2.' >'.number_format($rstong['cannangv'],3,".",",").'</td>
							<td colspan="6" ></td
						</tr>
					';
		echo '
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="80" >
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" colspan="2" valign="top" align="right" class="logan red">
								Ngày in phiếu: '.$datenow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
								<div class="DatedPrint DatedPhieuchi" style="margin-bottom:10px"> Từ Ngày '.$fromDates.' -  Đến Ngày '.$toDates.'</div>
								
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
								<strong>Ngày Xuất</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Phiếu</strong>
							</td>
							<td><strong>Nhóm Nguyên Liệu</strong></td>
							<td><strong>Tên Nguyên Liệu</strong></td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Loại vàng dẻ nấu</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tổng TL Vàng Sau Nấu</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tổng TL Vàng Trước Nấu</strong>
							</td>								
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tuổi Vàng Sau Nấu</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Hao Q10</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Dư Q10</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Phòng Chuyển</strong>
							</td>							
							<td height="25" align="center" class="brbottom brleft">
								<strong>Ghi Chú</strong>
							</td>
						</tr>
						'.$str.'
					</table>		
				</td>
			</tr>			 
		</table>
	';
	break;	
	/////Thống kê tồn kho chi tiết+ nhập kho chi tiết+ xuất kho chi tiết	
	case"CTTonKhoBot":
	case"CTNhapKhoKhoBot":
	case"CTXuatKhoKhoBot":
		$typephieu = 1; // 1 là phiếu nhập, 2 là phiếu xuất
		$dateNX = "dated";
		$ngaynhapxuat = 'Ngày nhập';
		$phongChuyenSX = 'Phòng SX';
		$loaiphong = '';
		$sqlFrom = " from $GLOBALS[db_sp].bot_khobot ";	
		$sqlRound = " ROUND(SUM(cannangvh), 3) as cannangvh, 
					 ROUND(SUM(cannangh), 3) as cannangh, 
					 ROUND(SUM(cannangv), 3) as cannangv";	
		$sqlOrderDated = " order by dated desc, id desc";
		$sqlGroupOrder = " group by idloaivang
						  order by idloaivang asc";
		if($act=="CTTonKhoBot" || $act=="CTNhapKhoKhoBot"){			
			//thống kê tồn kho chi tiết
			if($act=="CTTonKhoBot"){
				$tieude = "THỐNG KÊ BỘT TỒN KHO CHƯA NẤU";
				$sqlWhere = " where type=1 and typechuyen=2 and trangthai=0 $whloaivang and dated >= '".$fromDate."' and dated <= '".$toDate."'";			
				$sql = "select * ".$sqlFrom.$sqlWhere.$sqlOrderDated;//sql lấy phiếu thỏa đk		    
				$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere;	//sql tính tổng cân nặng V+H					
				$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlGroupOrder;//tổng theo loại vàng			
				}					
			//thống kê nhập kho chi tiết
			if($act=="CTNhapKhoKhoBot"){
				$tieude = "THỐNG KÊ BỘT NHẬP KHO";
				$sqlWhere = " where type=1 and typechuyen=2 $whloaivang and dated >= '".$fromDate."' and dated <= '".$toDate."'";			
				$sql = "select * ".$sqlFrom.$sqlWhere.$sqlOrderDated;//sql lấy phiếu thỏa đk			
				$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere;	//sql tính tổng cân nặng V+H					
				$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlGroupOrder;//tổng theo loại vàng				
				}
			$rstong = $GLOBALS['sp']->getRow($sql_tong);
			$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);		
			$rscth = $GLOBALS["sp"]->getAll($sql);
			foreach($rscth as $value){
				$styleColorRow = "";
				if($i %2 == 0){
					$styleColorRow = "style='background-color:#f9f9f9;'";
					}		
				if($typephieu == 1){
					$loaiphong = $value['typekhodau'];
					}			
				$str .= '
					<tr '.$styleColorRow.'> 
						<td height="25"  align="center">
							'.$i.'
						</td>
						<td height="25"  align="center">
							'.date("d/m/Y", strtotime($value[$dateNX])).'
						</td>
						<td height="25" align="left">
							'.$value['maphieu'].'
						</td>
						<td height="25"  align="right">
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
						<td>
							'.$loaiphong.'
						</td>
						<td height="25" align="left" >
							 '.$value['ghichuvang'].'
						</td>
					</tr>
					';
					$i++;
				}
			$strStyle1 = 'height="25" align="right" style="font-size:16px;font-weight: bold;"';
			foreach($rstongloaivang as $vltongloaivang){			
				$str .= '
					<tr>
						<td colspan="4" '.$strStyle1.' >
							'.getName("loaivang","name_vn",$vltongloaivang['idloaivang']).'
						 </td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangvh'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangh'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangv'],3,".",",").'</td>
						<td></td>
						<td></td>
					</tr>
				';
				}
			$strStyle2 = 'height="25" align="right" style="font-size:17px;font-weight: bold;"';
			$str .= '
				<tr>
						<td colspan="4" '.$strStyle2.'>Tổng tất cả: </td>
						<td '.$strStyle2.'>'.number_format($rstong['cannangvh'],3,".",",").'</td>
						<td '.$strStyle2.'>'.number_format($rstong['cannangh'],3,".",",").'</td>
						<td '.$strStyle2.'>'.number_format($rstong['cannangv'],3,".",",").'</td>
						<td></td>
						<td></td>
					</tr>
				';
			echo '
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center" height="80" >
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100%" colspan="2" valign="top" align="right" class="logan red">
										Ngày in phiếu: '.$datenow.'
									</td>
								</tr>
								<tr>
									<td width="30%" valign="top" align="left" class="logan red">
										<img width="120" src="../images/logo.png"/> <br>
									</td>
									<td width="70%" valign="top" align="left" >
										<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
										<div class="DatedPrint DatedPhieuchi" style="margin-bottom:10px"> Từ Ngày '.$fromDates.' -  Đến Ngày '.$toDates.'</div>
										
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
										<strong>'.$ngaynhapxuat.'</strong>
									</td>
									<td height="25"  align="center" class="brbottom brleft">
										<strong>Mã Phiếu</strong>
									</td>
									<td height="25"  align="center" class="brbottom brleft">
										<strong>Loại Vàng</strong>
									</td>								
									<td height="25" align="center" class="brbottom brleft">
										<strong>Cân nặng V+H</strong>
									</td>
									<td height="25" align="center" class="brbottom brleft">
										<strong>Cân nặng H</strong>
									</td>
									<td height="25" align="center" class="brbottom brleft">
										<strong>Cân nặng V</strong>
									</td>
									<td height="25"  align="center" class="brbottom brleft">
										<strong>'.$phongChuyenSX.'</strong>
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
		//thống kê xuất kho chi tiết
		if($act=="CTXuatKhoKhoBot"){
			$tieude = "THỐNG KÊ BỘT XUẤT KHO";
			$typephieu = 2;
			$loaiphong = getLinkTitle('169',1);
			$phongChuyenSX = 'Phòng chuyển';
			$dateNX = "datedxuat";
			$ngaynhapxuat = 'Ngày xuất';			
			$sqlWhere =" where type=1 and trangthai=2 $whloaivang and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."'";
			$sql = "select * ".$sqlFrom.$sqlWhere." order by datedxuat desc, idchonphieunhap desc";//sql lấy phiếu thỏa đk
			$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere;//sql tính tổng cân nặng V+H
			$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlGroupOrder;//tổng theo loại vàng	
			
			$rstong = $GLOBALS['sp']->getRow($sql_tong);
			$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);		
			$rscth = $GLOBALS["sp"]->getAll($sql);
			foreach($rscth as $value){
				$styleColorRow = "";
				if($i %2 == 0){
					$styleColorRow = "style='background-color:#f9f9f9;'";
					}		
				if($typephieu == 1){
					$loaiphong = $value['typekhodau'];
					}			
				$str .= '
					<tr '.$styleColorRow.'> 
						<td height="25" align="center">
							'.$i.'
						</td>
						<td height="25" align="center">
							'.date("d/m/Y", strtotime($value[$dateNX])).'
						</td>
						<td>
							'.getName('bot_khobot', 'maphieu', $value['idchonphieunhap']).'
						</td>
						<td height="25" align="left">
							'.$value['maphieu'].'
						</td>
						<td height="25"  align="right">
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
						<td>
							'.$loaiphong.'
						</td>
						<td height="25" align="left" >
							 '.$value['ghichuvang'].'
						</td>
					</tr>
					';
					$i++;
				}
			$strStyle1 = 'height="25" align="right" style="font-size:16px;font-weight: bold;"';
			foreach($rstongloaivang as $vltongloaivang){			
				$str .= '
					<tr>
						<td colspan="5" '.$strStyle1.' >
							'.getName("loaivang","name_vn",$vltongloaivang['idloaivang']).'
						 </td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangvh'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangh'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangv'],3,".",",").'</td>
						<td></td>
						<td></td>
					</tr>
				';
				}
			$strStyle2 = 'height="25" align="right" style="font-size:17px;font-weight: bold;"';
			$str .= '
				<tr>
						<td colspan="5" '.$strStyle2.'>Tổng tất cả: </td>
						<td '.$strStyle2.'>'.number_format($rstong['cannangvh'],3,".",",").'</td>
						<td '.$strStyle2.'>'.number_format($rstong['cannangh'],3,".",",").'</td>
						<td '.$strStyle2.'>'.number_format($rstong['cannangv'],3,".",",").'</td>
						<td></td>
						<td></td>
					</tr>
				';
			echo '
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center" height="80" >
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100%" colspan="2" valign="top" align="right" class="logan red">
										Ngày in phiếu: '.$datenow.'
									</td>
								</tr>
								<tr>
									<td width="30%" valign="top" align="left" class="logan red">
										<img width="120" src="../images/logo.png"/> <br>
									</td>
									<td width="70%" valign="top" align="left" >
										<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
										<div class="DatedPrint DatedPhieuchi" style="margin-bottom:10px"> Từ Ngày '.$fromDates.' -  Đến Ngày '.$toDates.'</div>
										
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
										<strong>'.$ngaynhapxuat.'</strong>
									</td>
									<td height="25"  align="center" class="brbottom brleft">
										<strong>Mã Phiếu Xuất Kho</strong>
									</td>
									<td height="25"  align="center" class="brbottom brleft">
										<strong>Mã Phiếu </strong>
									</td>
									<td height="25"  align="center" class="brbottom brleft">
										<strong>Loại Vàng</strong>
									</td>								
									<td height="25" align="center" class="brbottom brleft">
										<strong>Cân nặng V+H</strong>
									</td>
									<td height="25" align="center" class="brbottom brleft">
										<strong>Cân nặng H</strong>
									</td>
									<td height="25" align="center" class="brbottom brleft">
										<strong>Cân nặng V</strong>
									</td>
									<td height="25"  align="center" class="brbottom brleft">
										<strong>'.$phongChuyenSX.'</strong>
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
	break;
	////////////////////////////////////////////KẾT THÚC VŨ THÊM KHO BỘT////////////////////////////////////////
	//===================VŨ THÊM KHO KHÁC KHO LƯU MẪU=======================================//
	case"xuatkhoIdKhoKhacKhoLuuMau":
		$str = "";
		$stt = 1;
		$id = ceil($_GET["id"]);
		$sql = "select * from $GLOBALS[db_sp].khokhac_luumau where id=$id";
		$rs = $GLOBALS["sp"]->getRow($sql);
		$sqlct = "select * from $GLOBALS[db_sp].khokhac_luumau where id=".$id;
		$rsct = $GLOBALS["sp"]->getAll($sqlct);
		foreach($rsct as $value){
			$str .= '
					<tr height="25">
						<td>
							'.getName('khokhac_luumau', 'maphieu', $value['idpnk']).'
						</td>
						<td align="right">
							'.number_format($value['cannangvh'],3,".",",").'
						</td>
						<td align="right">
							'.number_format($value['cannangh'],3,".",",").'
						</td>
						<td align="right">
							'.number_format($value['cannangv'],3,".",",").'
						</td>
						<td>
							'.getNamMaDonHangCatalog($value['madhin']).'
						</td>
						<td align="right">
							'.$value['hao'].'
						</td>
						<td align="right">
							'.$value['du'].'
						</td>						
						<td>
							'.$value['ghichuvang'].'
						</td>						
					</tr>
					';
			}
		echo'
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" height="80" >
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100%" colspan="2" valign="top" align="right" class="logan red">
									Ngày in phiếu: '.$datenow.'<strong> | </strong>'.$timnow.'
								</td>
							</tr>
							<tr>
								<td width="30%" valign="top" align="left" class="logan red">
									<img width="120" src="../images/logo.png"/> <br>
								</td>
								<td width="70%" valign="top" align="left" >
									<div class="XuatkhoPrint PrintPhieuchi">PHIẾU GIAO ĐỒ THỢ</div> 
									<div style="padding-top:5px">Mã Phiếu: <strong>'.$value['maphieu'].'</strong></div>								
								</td>
							</tr>
						</table>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="padding-top:10px" width="75%">
									Phòng Giao: KHO KHÁC &raquo; <strong>KHO LƯU MẪU</strong>
								</td>
								<td  width="25%">
									Loại Vàng: '.getName("loaivang","name_vn",$value['idloaivang']).'
								</td>
							</tr>
							<tr>
								<td style="padding-bottom:10px" colspan="2">
									Phòng Nhận: '.getLinkTitleKhoShort($value['chonphongbanin'],1).'
								</td>
							</tr>							
						</table>
					</td>
				</tr>				
				<tr>
					<td valign="top" align="left">
						<table width="100%" border="1" cellpadding="0" cellspacing="0">
							<tr bgcolor="#e9e8e8" align="center"> 
								<td>
									<strong>Phiếu Nhập Kho</strong>
								</td>
								<td>
									<strong>Cân nặng V+H </strong>
								</td>
								<td>
									<strong>Cân nặng H </strong>
								</td>
								<td>
									<strong>Cân nặng V</strong>
								</td>
								<td>
									<strong>Mã ĐH</strong>
								</td>
								<td>
									<strong>Hao</strong>
								</td>
								<td>
									<strong>Dư</strong>
								</td>
								<td>
									<strong>Ghi chú</strong>
								</td>								
							</tr>
							'.$str.'						  
						</table>			
					</td>
				</tr>			 
			</table>
			<div style=" font-size:14px;margin-top:10px;width:100%">
				<div style="text-align:center;width:50%;float:left">
					Người Giao
				</div>
				<div style="text-align:center;width:50%;float:left">
					Người Nhận
				</div>
				<div style="clear:both"></div>
			</div>
			';
	break;
	//========================//
	case"TonKhoChiTietVangKKLM":
		$wh = '';
		if(ceil($idloaivang) > 0)
			$wh = " and id = ".$idloaivang." ";
		$sqlvang1 = "select * from $GLOBALS[db_sp].loaivang where active=1 $wh order by id asc"; 
		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);	
		foreach($rscth as $value){
		$viewdl = array();
		$viewdl = thongKeTonKhoSanXuat($cid, $value['id'], $fromDates, $toDates);
		
		if(ceil($viewdl['idloaivang']) > 0){
			$str .= '
				<tr  height="25" align="right"> 
					<td>
						'.$value['name_vn'].'
					</td>
					<td>
						'.number_format($viewdl['sltonsddk'],3,".",",").'
					</td>
					<td>
						'.number_format($viewdl['slnhap'],3,".",",").'
					</td>
					<td>
						 '.number_format($viewdl['slxuat'],3,".",",").'
					</td>					
					<td>
						 '.number_format($viewdl['slhao'],3,".",",").'
					</td>
					<td>
						 '.number_format($viewdl['sldu'],3,".",",").'
					</td>					
					<td>
						 '.number_format($viewdl['slhaochenhlech'],3,".",",").'
					</td>
					<td>
						 '.number_format($viewdl['slduchenhlech'],3,".",",").'
					</td>					
					<td>
						 '.number_format($viewdl['slton'],3,".",",").'
					</td>
					<td>
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
							<td width="100%" colspan="2" valign="top" align="right" class="logan red">
								Ngày in phiếu: '.$datenow.'<strong> | </strong>'.$timnow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">KHO KHÁC LƯU MẪU TỒN KHO CHI TIẾT</div> 
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
								<strong>Hao Kết Dẻ</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Dư Kết Dẻ</strong>
							</td>
							
							<td height="25" align="center" class="brbottom brleft">
								<strong>Hao Chênh Lệch</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Dư Chênh Lệch</strong>
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
							<td align="right" colspan="9"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
							<td align="right"><strong class="colorXanh">'.number_format($tongtongQ10,3,".",",").'</strong></td>
						</tr>   
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
	break;
	//=====================//
	case"TonKhoDHChiTietVangKKLM":
	case"TonKhoDHTongVangKKLM":
		$wh = $title = '';
		if($idloaivang > 0)
			$wh .=" and idloaivang = '".$idloaivang."' ";
		if(!empty($fromDate))
			$wh .=" and dated  >= '".$fromDate."' ";
		if(!empty($toDate))
			$wh .=" and dated  <= '".$toDate."' ";
			
		$sqlFrom = " from $GLOBALS[db_sp].khokhac_luumau ";
		/*	
		$sqlRound = "ROUND(SUM(cannangvh), 3) as cannangvh, 
					 ROUND(SUM(cannangh), 3) as cannangh, 
					 ROUND(SUM(cannangv), 3) as cannangv,
					 ROUND(SUM(slvangcat),3) as slvangcat,
					 ROUND(SUM(slvangcon),3) as slvangcon";	
			
		$sqlGroupOrder = " group by idloaivang
					   	   order by idloaivang asc";
		*/
		$sqlOrderDated = "order by dated desc, id desc";
		if($act=="TonKhoDHChiTietVangKKLM"){
			$title = 'KHO KHÁC LƯU MẪU TỒN KHO ĐƠN HÀNG CHI TIẾT';
			$sqlWhere = " where type=1 and typechuyen=2 and cannangv > 0 and slvangcon <> 0 $wh ";		
			}
		if($act=="TonKhoDHTongVangKKLM"){
			$title = 'KHO KHÁC LƯU MẪU TỒN KHO ĐƠN HÀNG TỔNG';
			$sqlWhere = "where ( type=1 and typechuyen=2 and cannangv > 0 and slvangcon <> 0 $wh)
						        or id in ( select idpnk from $GLOBALS[db_sp].khokhac_luumau where type in (2,3) and trangthai in (0,1) $wh) ";
			}	
			
		$sqlvang1 = "select *".$sqlFrom.$sqlWhere.$sqlOrderDated;	
		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);
		/*
		$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere;//sql tính tổng cân nặng V+H		
		$rstong = $GLOBALS['sp']->getRow($sql_tong);
		
		$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlGroupOrder;//tổng theo loại vàng	
		$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);
		*/		
		$tongcannangvh = $tongcannangh = $tongcannangv = $tongslvangcat = $tongslvangcon = 0;
		foreach($rscth as $value){
			$madh = '';
			$datedshow = date("d/m/Y", strtotime($value['dated']));
			if(ceil($value['madhin']) > 0)
				$madh = getNamMaDonHangCatalog($value['madhin']);
				
			$tongcannangvh = round($tongcannangvh + $value['cannangvh'],3);
			$tongcannangh = round($tongcannangh + $value['cannangh'],3);
			$tongcannangv = round($tongcannangv + $value['cannangv'],3);
			$tongslvangcat = round($tongslvangcat + $value['slvangcat'],3);
			$tongslvangcon = round($tongslvangcon + $value['slvangcon'],3);
			$str .= '
					<tr height="25"> 
					<td align="center">
						'.$i.'
					</td>
					<td align="center">
						'.$datedshow.'
					</td>
					<td>
						'.$value['maphieu'].'
					</td>
					<td align="right">
						'.getName("loaivang","name_vn",$value['idloaivang']).' 
					</td>
					<td align="right">
						'.number_format($value['cannangvh'],3,".",",").'
					</td>
					<td align="right">
						'.number_format($value['cannangh'],3,".",",").'
					</td>
					<td align="right">
						 '.number_format($value['cannangv'],3,".",",").'
					</td>
					<td align="right">
						 '.number_format($value['slvangcat'],3,".",",").'
					</td>
					<td align="right">
						 '.number_format($value['slvangcon'],3,".",",").'
					</td>
					<td>
						 '.$madh.'
					</td>			
					<td>
						'.$value['ghichuvang'].'
					</td>
				</tr>
				';
			$i++;
		}
		/*
		$strStyle1 = 'height="25" align="right" style="font-size:16px;font-weight: bold;"';
			foreach($rstongloaivang as $vltongloaivang){			
				$str .= '
					<tr>
						<td colspan="4" '.$strStyle1.' >
							'.getName("loaivang","name_vn",$vltongloaivang['idloaivang']).'
						 </td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangvh'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangh'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangv'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['slvangcat'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['slvangcon'],3,".",",").'</td>
						<td colspan="3" '.$strStyle1.' ></td>
					</tr>
				';
				}
		*/ 
		$strStyle2 = 'height="25" align="right" style="font-size:17px;font-weight: bold;"';
		$str .= '
			<tr>
					<td colspan="4" '.$strStyle2.'>Tổng tất cả: </td>
					<td '.$strStyle2.'>'.number_format($tongcannangvh,3,".",",").'</td>
					<td '.$strStyle2.'>'.number_format($tongcannangh,3,".",",").'</td>
					<td '.$strStyle2.'>'.number_format($tongcannangv,3,".",",").'</td>
					<td '.$strStyle2.'>'.number_format($tongslvangcat,3,".",",").'</td>
					<td '.$strStyle2.'>'.number_format($tongslvangcon,3,".",",").'</td>
					<td colspan="3" '.$strStyle2.' ></td>
				</tr>
			';
	echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="80" >
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" colspan="2" valign="top" align="right" class="logan red">
								Ngày in phiếu: '.$datenow.'<strong> | </strong>'.$timnow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">'.$title.'</div> 
								<div class="DatedPrint DatedPhieuchi">Từ Ngày: '.$fromDates.'- Đến Ngày: '.$toDates.'</div>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>	
			<tr>
				<td valign="top" align="left">
					<table width="100%" border="1" cellpadding="0" cellspacing="0">
						<tr bgcolor="#e9e8e8" height="25" align="center" class="brbottom brleft"> 
							<td >
								<strong>STT</strong>
							</td>
							<td>
								<strong>Ngày nhập</strong>
							</td>
							<td>
								<strong>Mã Phiếu</strong>
							</td>
							<td>
								<strong>Loại Vàng</strong>
							</td>
							<td>
								<strong>Cân Nặng V+H</strong>
							</td>
							<td>
								<strong>Cân Nặng Hột</strong>
							</td>
							<td>
								<strong>Cân Nặng Vàng</strong>
							</td>
							<td>
								<strong>Vàng Cắt</strong>
							</td>
							<td>
								<strong>Vàng Còn Lại</strong>
							</td>
							<td>
								<strong>Mã ĐH</strong>
							</td>
							<td>
								<strong>Ghi Chú</strong>
							</td>
						</tr>
						'.$str.'						
					</table>		
				</td>
			</tr>			 
		</table>
	';
	break;
	//==================//
	case"nhapkhoVangKKLM":
		$wh = $title = $ngayNNhapXuat = $phongChuyenSX = $typePhongChuyenSX = '';
		if($idloaivang > 0)
			$wh .=" and idloaivang = '".$idloaivang."' ";
		if(!empty($fromDate))
			$wh .=" and dated  >= '".$fromDate."' ";
		if(!empty($toDate))
			$wh .=" and dated  <= '".$toDate."' ";
			
		$sqlFrom = " from $GLOBALS[db_sp].khokhac_luumau ";	
		$sqlRound = "ROUND(SUM(cannangvh), 3) as cannangvh, 
					 ROUND(SUM(cannangh), 3) as cannangh, 
					 ROUND(SUM(cannangv), 3) as cannangv,
					 ROUND(SUM(slvangcat),3) as slvangcat,
					 ROUND(SUM(slvangcon),3) as slvangcon";	
		$sqlOrderDated = "order by dated desc, id desc";	
		$sqlGroupOrder = " group by idloaivang
					   	   order by idloaivang asc";
		
		$title = 'KHO KHÁC LƯU MẪU THỐNG KÊ NHẬP KHO';
		$ngayNNhapXuat = "Ngày Nhập";
		$phongChuyenSX = "Phòng Chuyển";
		$sqlWhere = " where type=1 and typechuyen=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh ";		
		
		$sqlvang1 = "select *".$sqlFrom.$sqlWhere.$sqlOrderDated;	//sql list vàng
		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);
		
		$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere;//sql tính tổng cân nặng V+H		
		$rstong = $GLOBALS['sp']->getRow($sql_tong);
		
		$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlGroupOrder;//tổng theo loại vàng	
		$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);
				
		foreach($rscth as $value){
			$madh = '';
			$datedshow = date("d/m/Y", strtotime($value['dated']));
			if(ceil($value['madhin']) > 0)
				$madh = getNamMaDonHangCatalog($value['madhin']);
			$typePhongChuyenSX = $value['typekhodau'];			
							
			$str .= '
					<tr height="25"> 
					<td align="center">
						'.$i.'
					</td>
					<td align="center">
						'.$datedshow.'
					</td>
					<td>
						'.$value['maphieu'].'
					</td>
					<td align="right">
						'.getName("loaivang","name_vn",$value['idloaivang']).' 
					</td>
					<td align="right">
						'.number_format($value['cannangvh'],3,".",",").'
					</td>
					<td align="right">
						'.number_format($value['cannangh'],3,".",",").'
					</td>
					<td align="right">
						 '.number_format($value['cannangv'],3,".",",").'
					</td>
					<td>
						'.$typePhongChuyenSX.'
					</td>
					<td>
						 '.$madh.'
					</td>			
					<td>
						'.$value['ghichuvang'].'
					</td>
				</tr>
				';
			$i++;
		}
		$strStyle1 = 'height="25" align="right" style="font-size:16px;font-weight: bold;"';
			foreach($rstongloaivang as $vltongloaivang){			
				$str .= '
					<tr>
						<td colspan="4" '.$strStyle1.' >
							'.getName("loaivang","name_vn",$vltongloaivang['idloaivang']).'
						 </td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangvh'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangh'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangv'],3,".",",").'</td>						
						<td colspan="3" '.$strStyle1.' ></td>
					</tr>
				';
				}
		$strStyle2 = 'height="25" align="right" style="font-size:17px;font-weight: bold;"';
		$str .= '
			<tr>
					<td colspan="4" '.$strStyle2.'>Tổng tất cả: </td>
					<td '.$strStyle2.'>'.number_format($rstong['cannangvh'],3,".",",").'</td>
					<td '.$strStyle2.'>'.number_format($rstong['cannangh'],3,".",",").'</td>
					<td '.$strStyle2.'>'.number_format($rstong['cannangv'],3,".",",").'</td>
					<td colspan="3" '.$strStyle2.' ></td>
				</tr>
			';
	echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="80" >
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" colspan="2" valign="top" align="right" class="logan red">
								Ngày in phiếu: '.$datenow.'<strong> | </strong>'.$timnow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">'.$title.'</div> 
								<div class="DatedPrint DatedPhieuchi">Từ Ngày: '.$fromDates.'- Đến Ngày: '.$toDates.'</div>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>	
			<tr>
				<td valign="top" align="left">
					<table width="100%" border="1" cellpadding="0" cellspacing="0">
						<tr bgcolor="#e9e8e8" height="25" align="center" class="brbottom brleft"> 
							<td >
								<strong>STT</strong>
							</td>
							<td>
								<strong>'.$ngayNNhapXuat.'</strong>
							</td>
							<td>
								<strong>Mã Phiếu</strong>
							</td>
							<td>
								<strong>Loại Vàng</strong>
							</td>
							<td>
								<strong>Cân Nặng V+H</strong>
							</td>
							<td>
								<strong>Cân Nặng Hột</strong>
							</td>
							<td>
								<strong>Cân Nặng Vàng</strong>
							</td>
							<td>
								<strong>'.$phongChuyenSX.'</strong>
							</td>
							<td>
								<strong>Mã ĐH</strong>
							</td>
							<td>
								<strong>Ghi Chú</strong>
							</td>
						</tr>
						'.$str.'						
					</table>		
				</td>
			</tr>			 
		</table>
	';
	break;
	//====================//
	case"xuatkhoVangKKLM":
		$wh = $title = $ngayNNhapXuat = $phongChuyenSX = $typePhongChuyenSX = '';
		if($idloaivang > 0)
			$wh .=" and idloaivang = '".$idloaivang."' ";
		if(!empty($fromDate))
			$wh .=" and datedxuat  >= '".$fromDate."' ";
		if(!empty($toDate))
			$wh .=" and datedxuat  <= '".$toDate."' ";
			
		$sqlFrom = " from $GLOBALS[db_sp].khokhac_luumau ";	
		$sqlRound = "ROUND(SUM(cannangvh), 3) as cannangvh, 
					 ROUND(SUM(cannangh), 3) as cannangh, 
					 ROUND(SUM(cannangv), 3) as cannangv,
					 ROUND(SUM(slvangcat),3) as slvangcat,
					 ROUND(SUM(slvangcon),3) as slvangcon";	
		$sqlOrderDated = "order by dated desc, id desc";	
		$sqlGroupOrder = " group by idloaivang
					   	   order by idloaivang asc";
		
		$title = 'KHO KHÁC LƯU MẪU THỐNG KÊ XUẤT KHO';
		$ngayNNhapXuat = "Ngày Xuất";
		$phongChuyenSX = "Phòng SX";
		$sqlWhere = " where type in(2,3) and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh ";			
			
		$sqlvang1 = "select *".$sqlFrom.$sqlWhere.$sqlOrderDated;	//sql list vàng

		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);
		
		$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere;//sql tính tổng cân nặng V+H		
		$rstong = $GLOBALS['sp']->getRow($sql_tong);
		
		$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$sqlGroupOrder;//tổng theo loại vàng	
		$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);
				
		foreach($rscth as $value){
			$madh = '';
			$datedshow = date("d/m/Y", strtotime($value['dated']));
			if(ceil($value['madhin']) > 0)
				$madh = getNamMaDonHangCatalog($value['madhin']);			
			 $typePhongChuyenSX = getLinkTitleKhoShort($value['chonphongbanin'],1);
			
			$str .= '
					<tr height="25"> 
					<td align="center">
						'.$i.'
					</td>
					<td align="center">
						'.$datedshow.'
					</td>
					<td>
						'.$value['maphieu'].'
					</td>
					<td>
						'.getName("khokhac_luumau","maphieu",$value["idpnk"]).'
					</td>
					<td align="right">
						'.getName("loaivang","name_vn",$value['idloaivang']).' 
					</td>
					<td align="right">
						'.number_format($value['cannangvh'],3,".",",").'
					</td>
					<td align="right">
						'.number_format($value['cannangh'],3,".",",").'
					</td>
					<td align="right">
						 '.number_format($value['cannangv'],3,".",",").'
					</td>
					<td>
						'.$typePhongChuyenSX.'
					</td>
					<td>
						 '.$madh.'
					</td>			
					<td>
						'.$value['ghichuvang'].'
					</td>
				</tr>
				';
			$i++;
		}
		$strStyle1 = 'height="25" align="right" style="font-size:16px;font-weight: bold;"';
			foreach($rstongloaivang as $vltongloaivang){			
				$str .= '
					<tr>
						<td colspan="5" '.$strStyle1.' >
							'.getName("loaivang","name_vn",$vltongloaivang['idloaivang']).'
						 </td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangvh'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangh'],3,".",",").'</td>
						<td '.$strStyle1.'>'.number_format($vltongloaivang['cannangv'],3,".",",").'</td>						
						<td colspan="3" '.$strStyle1.' ></td>
					</tr>
				';
				}
		$strStyle2 = 'height="25" align="right" style="font-size:17px;font-weight: bold;"';
		$str .= '
			<tr>
					<td colspan="5" '.$strStyle2.'>Tổng tất cả: </td>
					<td '.$strStyle2.'>'.number_format($rstong['cannangvh'],3,".",",").'</td>
					<td '.$strStyle2.'>'.number_format($rstong['cannangh'],3,".",",").'</td>
					<td '.$strStyle2.'>'.number_format($rstong['cannangv'],3,".",",").'</td>
					<td colspan="3" '.$strStyle2.' ></td>
				</tr>
			';
	echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="80" >
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="100%" colspan="2" valign="top" align="right" class="logan red">
								Ngày in phiếu: '.$datenow.'<strong> | </strong>'.$timnow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">'.$title.'</div> 
								<div class="DatedPrint DatedPhieuchi">Từ Ngày: '.$fromDates.'- Đến Ngày: '.$toDates.'</div>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>	
			<tr>
				<td valign="top" align="left">
					<table width="100%" border="1" cellpadding="0" cellspacing="0">
						<tr bgcolor="#e9e8e8" height="25" align="center" class="brbottom brleft"> 
							<td >
								<strong>STT</strong>
							</td>
							<td>
								<strong>'.$ngayNNhapXuat.'</strong>
							</td>
							<td>
								<strong>Mã Phiếu</strong>
							</td>
							<td>
								<strong>Mã Phiếu Nhập</strong>
							</td>
							<td>
								<strong>Loại Vàng</strong>
							</td>
							<td>
								<strong>Cân Nặng V+H</strong>
							</td>
							<td>
								<strong>Cân Nặng Hột</strong>
							</td>
							<td>
								<strong>Cân Nặng Vàng</strong>
							</td>
							<td>
								<strong>'.$phongChuyenSX.'</strong>
							</td>
							<td>
								<strong>Mã ĐH</strong>
							</td>
							<td>
								<strong>Ghi Chú</strong>
							</td>
						</tr>
						'.$str.'						
					</table>		
				</td>
			</tr>			 
		</table>
	';
	break;
	//=======================//
	case"HaoDuKKLM":	
		$wh = "";
		if($idloaivang > 0)
			$wh .=" and idloaivang = '".$idloaivang."' ";	
		$sql = "select * from $GLOBALS[db_sp].khokhac_luumauhaodu
				where dated >= '".$fromDate."' 
				and dated <= '".$toDate."' $wh 
				order by numphieu asc, dated asc
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);
		
		$sql_tong = "select ROUND(SUM(hao), 3) as hao, 
							ROUND(SUM(du), 3) as du,
							ROUND(SUM(haochenhlech), 3) as haochenhlech, 
							ROUND(SUM(duchenhlech), 3) as duchenhlech
					from $GLOBALS[db_sp].khokhac_luumauhaodu 
					where dated >= '".$fromDate."' and dated <= '".$toDate."' $wh";
		$rstong = $GLOBALS['sp']->getRow($sql_tong);
		
		foreach($rscth as $value){
			$datedshow = date("d/m/Y", strtotime($value['dated']));
			$str .= '
				<tr height="25"> 
					<td align="center">
						'.$i.'
					</td>
					<td align="center">
						'.$datedshow.'
					</td>
					<td>
						'.$value['maphieu'].'
					</td>
					<td>
						'.getName("khokhac_luumau","maphieu",$value["idpnk"]).'
					</td>
					<td align="right">
						'.getName("loaivang","name_vn",$value['idloaivang']).' 
					</td>
					<td align="right">
						'.number_format($value['haochenhlech'],3,".",",").'
					</td>
					<td align="right">
						'.number_format($value['duchenhlech'],3,".",",").'
					</td>
					<td>
						'.getNamMaDonHangCatalog(getName("khokhac_luumau","madhin",$value['idpnk'])).'
					</td>				
					<td>
						'.$value['ghichu'].'
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
							<td width="100%" colspan="2" valign="top" align="right" class="logan red">
								Ngày in phiếu: '.$datenow.'<strong> | </strong>'.$timnow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">KHO KHÁC LƯU MẪU THỐNG KÊ HAO DƯ</div> 
								<div class="DatedPrint DatedPhieuchi"> Từ Ngày '.$fromDates.' -  Đến Ngày '.$toDates.'</div>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>	
			<tr>
				<td valign="top" align="left">
					<table width="100%" border="1" cellpadding="0" cellspacing="0">
						<tr bgcolor="#e9e8e8" height="25"  class="brbottom brleft" align="center"> 
							<td>
								<strong>STT</strong>
							</td>
							<td>
								<strong>Ngày Nhập</strong>
							</td>
							<td>
								<strong>Mã Phiếu</strong>
							</td>
							<td>
								<strong>Mã Phiếu Nhập Kho</strong>
							</td>
							<td>
								<strong>Loại Vàng</strong>
							</td>
							<td>
								<strong>Hao Chênh Lệch</strong>
							</td>
							<td>
								<strong>Dư Chênh Lệch</strong>
							</td>
							<td>
								<strong>Mã ĐH</strong>
							</td>
							<td>
								<strong>Ghi Chú</strong>
							</td>
						</tr>
						'.$str.'
						 <tr class="Paging fontSizeTon">
							<td align="right" colspan="5"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
							<td align="right"><span class="colorXanh">'.$rstong["haochenhlech"].'</span></td>
							<td align="right"><span class="colorXanh">'.$rstong["duchenhlech"].'</span></td>
							<td align="right" colspan="2"><span class="colorXanh"></span></td>
						</tr> 
					</table>		
				</td>
			</tr>			 
		</table>
	';	
	break;
	//=======KIM CƯƠNG===========//
	case"TonKhoChiTietKimCuongKKLM":
	case"TonKhoDHCTKimCuongKKLM":
	case"XuatKhoKCKhoLuuMau":
	    $typeTK = trim($_GET['typeTK']);
		$wh = $tieudedated = $tieudeCol = $vlCol = $ngayXuatChuyen = $tdCol = '';
		$checkDatechuyen = "Ok";
		$tieudedated = 'Ngày Nhập';	
		$str_sqlSelectTong = "select ROUND(count(id), 3) as tongsoluong, 
								ROUND(SUM(dongiaban), 3) as tongdongia ";
		$str_sqlFrom = "from $GLOBALS[db_sp].khokhac_luumau";
		$str_sqlNgayNhapXuat = " and typevkc = 2 and dated >= '".$fromDate."' and dated <= '".$toDate."'";
		$str_sqlOrder = "order by numphieu asc, dated asc";
		//========//
		if($act == 'TonKhoChiTietKimCuongKKLM'){
			$tieude = ' TỒN KHO CHI TIẾT';	
			$str_sqlWhere = " where type=2 and trangthai<>2 ";
			$sql = "select * ".$str_sqlFrom.$str_sqlWhere.$str_sqlNgayNhapXuat.$str_sqlOrder;			
			$sql_tong = $str_sqlSelectTong.$str_sqlFrom.$str_sqlWhere.$str_sqlNgayNhapXuat;
			}		
		//========//
		if($act == 'TonKhoDHCTKimCuongKKLM'){
			if($typeTK==1){
				$tieude = 'TỒN KHO ĐƠN HÀNG CHI TIẾT';
				}
			if($typeTK==2){
				$tieude = 'TỒN KHO ĐƠN HÀNG TỔNG';
				}
			if($typeTK==3){
				$tieude = 'THỐNG KÊ NHẬP KHO';
				}			
			$str_sqlWhere = " where type=2 ";			
			$sql = "select * ".$str_sqlFrom.$str_sqlWhere.$str_sqlNgayNhapXuat.$str_sqlOrder;			
			$sql_tong = $str_sqlSelectTong.$str_sqlFrom.$str_sqlWhere.$str_sqlNgayNhapXuat;
			}
		//========//
		if($act=="XuatKhoKCKhoLuuMau"){
			$checkDatechuyen = "XK";
			$tieudedated = 'Ngày Xuất';
			$tieudeCol = "<td><strong>Mã ĐH</strong></td>";
			$tdCol = '<td></td>';
			if($typeTK==4){
				$ngayXuatChuyen = 'datedxuat';
				$tieude = 'THỐNG KÊ XUẤT KHO';	
				$str_sqlWhere = " where type=2 and trangthai=2 ";
				$str_sqlNgayNhapXuat = " and typevkc = 2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."'";
				}
			if($typeTK==5){
				$ngayXuatChuyen = 'datechuyen';
				$tieude = 'THỐNG KÊ CHỜ NHẬP KHO';	
				$str_sqlWhere = " where type=2 and trangthai=1 ";
				$str_sqlNgayNhapXuat = " and typevkc = 2 and datechuyen >= '".$fromDate."' and datechuyen <= '".$toDate."'";
				}
			$sql = "select * ".$str_sqlFrom.$str_sqlWhere.$str_sqlNgayNhapXuat.$str_sqlOrder;			
			$sql_tong = $str_sqlSelectTong.$str_sqlFrom.$str_sqlWhere.$str_sqlNgayNhapXuat;
			}		
		//========//
		$rscth = $GLOBALS["sp"]->getAll($sql);
		$rstong = $GLOBALS['sp']->getRow($sql_tong);
		//========//
		foreach($rscth as $value){
			$datedshow = '';
			if($checkDatechuyen == 'Ok'){/// xuất datechuyen
				$datedshow = date("d/m/Y", strtotime($value['datechuyen']));
				$maphieu = $value['maphieu'];
				}
			if($checkDatechuyen == 'XK'){
				$datedshow = date("d/m/Y", strtotime($value[$ngayXuatChuyen]));
				$maphieu = str_replace("PNK","PXK", $value['maphieu']);				
				$vlCol= "<td>
							".getNamMaDonHangCatalog($value['madhin'])."
						</td>";
				}
			$str .= '
				<tr height="25"> 
					<td align="center">
						'.$i.'
					</td>
					<td>
						'.$datedshow.'
					</td>
					<td>
						'.$maphieu.'
					</td>
					<td>
						'.getName("categories","name_vn",$value['nhomnguyenlieukimcuong']).'
					</td>
					<td>
						'.getName("categories","name_vn",$value['tennguyenlieukimcuong']).'
					</td>
					<td>
						'.getName("loaikimcuonghotchu","size",$value['idkimcuong']).'::'.getName("loaikimcuonghotchu","name_vn",$value['idkimcuong']).'
					</td>
					<td align="right">
						'.$value['codegdpnj'].'
					</td>
					<td align="right">
						'.$value['codecgta'].'
					</td>
					<td align="right">
						'.$value['kichthuoc'].'
					</td>
					<td align="right">
						'.$value['trongluonghot'].'
					</td>
					<td align="right">
						 '.$value['dotinhkhiet'].'
					</td>
					<td align="right">
						 '.$value['capdomau'].'
					</td>
					<td align="right">
						'.$value['domaibong'].'
					</td>
					<td align="right">
						'.$value['kichthuocban'].'
					</td>
					<td  align="right">
						1
					</td>
					<td  align="right">
						 '.number_format($value['dongiaban'],3,".",",").'
					</td>
					'.$vlCol.'
					<td>
						'.$value['ghichukimcuong'].'
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
							<td width="100%" colspan="2" valign="top" align="right" class="logan red">
								Ngày in phiếu: '.$datenow.'<strong> | </strong>'.$timnow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">KHO KHÁC LƯU MẪU '. $tieude.' (Kim Cương)</div> 
								<div class="DatedPrint DatedPhieuchi"> Từ Ngày '.$fromDates.' -  Đến Ngày '.$toDates.'</div>								
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top" align="left">
					<table width="100%" border="1" cellpadding="0" cellspacing="0">
						<tr bgcolor="#e9e8e8" height="25" align="center" class="brbottom brleft"> 
							<td align="center" class="brbottom brleft">
								<strong>STT</strong>
							</td>
							<td>
								<strong>'.$tieudedated.'</strong>
							</td>
							<td>
								<strong>Mã Phiếu</strong>
							</td>
							<td>
								<strong>Nhóm Nguyên Liệu</strong>
							</td>
							<td>
								<strong>Tên Nguyên Liệu</strong>
							</td>
							<td>
								<strong>Tên Kim Cương</strong>
							</td>
							<td>
								<strong>MS GĐPNJ</strong>
							</td>
							<td>
								<strong>MS Cạnh GIA</strong>
							</td>
							<td>
								<strong>Kích Thước</strong>
							</td>
							<td>
								<strong>TL Hột</strong>
							</td>
							<td>
								<strong>Độ Tinh Khiết</strong>
							</td>
							<td>
								<strong>Cấp Độ Màu</strong>
							</td>
							<td>
								<strong>Độ Mài Bóng</strong>
							</td>
							<td>
								<strong>Kích Thước Bán</strong>
							</td>
							<td>
								<strong>Số Lượng</strong>
							</td>
							<td>
								<strong>Đơn Giá</strong>
							</td>
							'.$tieudeCol.'
							<td>
								<strong>Ghi chú</strong>
							</td>
						</tr>
						'.$str.'
						<tr class="Paging fontSizeTon">
							<td align="right" colspan="14"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
							<td align="right">'.number_format($rstong['tongsoluong'],3,".",",").'</td>
							<td align="right">'.number_format($rstong['tongdongia'],3,".",",").'</td>
							<td></td>
							'.$tdCol.'
						</tr> 
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
	break;
	//=========================KẾT THÚC THÊM KHO KHÁC KHO LƯU MẪU===========================//
	default:
		die('Vui lòng liên hệ với admin.');
	break;
}
/*
if($typevkc == 1){
	
}
else{
	foreach($rscth as $value){
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.$value['dated'].'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.' (Kim Cương)</div> 
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
								<strong>Ngày Nhập</strong>
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
						</tr>
						'.$str.'
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
}
*/
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