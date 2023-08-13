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
include_once("../functions/functionNhom.php");
CheckLogin();

$wh = $whdated = '';
$datenow = date("d/m/Y");
$timenow = date('H:i:s');

$fromDates = trim($_GET['fromdays']);
$toDates = trim($_GET['todays']);
if(!empty($fromDates)){
	$fromDate = explode('/',$fromDates);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
	$whdated.=' and dated >= "'.$fromDate.'"';
}
if(!empty($toDates)){
	$toDate = explode('/',$toDates);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
	$whdated.=' and datexuat <= "'.$toDate.'"';
}
$cid = isset($_REQUEST['cid'])?$_REQUEST['cid']:0;
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$table = isset($_REQUEST['table'])?$_REQUEST['table']:"";

$thanhtien = $tongsoluong = $tongsotien = 0;
$i = 1;

switch($act){
	// ANH VŨ THÊM BEGIN THỐNG KÊ KHO TEM HỘP
	case 'XuatKhoTemHop':
	case 'NhapKhoTemHop':
		if($act == 'NhapKhoTemHop'){
			$tieude = 'THỐNG KÊ NHẬP KHO KHO TEM HỘP';
			$sql = "select * from $GLOBALS[db_sp].da_temhop where type = 1 and trangthai = 2 $whdated order by dated desc, id desc";
		}
		if($act == 'XuatKhoTemHop'){
			$tieude = 'THỐNG KÊ XUẤT KHO KHO TEM HỘP';
			$sql = "select * from $GLOBALS[db_sp].da_temhop where type = 2 and trangthai = 2 $whdated order by dated desc, id desc";
		}
		$rs = $GLOBALS['sp']->getAll($sql);

		foreach ($rs as $item) {
			$sqldm = "select dongia, size from $GLOBALS[db_sp].dm_temhop where id = ".$item['idtemhop'];
			$rsdm = $GLOBALS['sp']->getRow($sqldm);

			$thanhtien = round($item['soluong'] * $rsdm['dongia'],3);
			$tongsoluong = round($tongsoluong + $item['soluong'],3);
			$tongsotien = round($tongsotien + $thanhtien,3);
			$styleColorRow = "";
			if(ceil($item['id']) > 0){
				if( $i % 2 == 0 ){
					$styleColorRow = "style='background-color:#f2f2f2;'";
				}
				$str .='
					<tr '.$styleColorRow.'>
						<td height="25" align="center">
							'.$i.'
						</td>
						<td height="25" align="left">
							'.date('d/m/Y',strtotime($item['dated'])).'
						</td>
						<td height="25" align="left">
							'.$item['maphieu'].'
						</td>
						<td height="25" align="left">
							'.$rsdm['size'].'
						</td>
						<td  height="25" align="right">
							'.number_format($item['soluong'],0,".",",").'
						</td>
						<td height="25" align="right">
							'.number_format($rsdm['dongia'],0,".",",").'
						</td>
						<td height="25" align="right">
							'.number_format($thanhtien,3,".",",").'
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
								<td width="100%" colspan="2" valign="top" align="right" class="logan red">
									Ngày in phiếu: '.$datenow.' <br/>
									Thời gian: '.$timenow.'
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
								<td height="25" align="center" class="brbottom brleft" width="5%">
									<strong>STT</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft" width="10%">
									<strong>Ngày Duyệt</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft" width="20%">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft" width="10%">
									<strong>Size Tem Hộp</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Đơn Giá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Thành Tiền</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="4" class="brbottom brleft"> <span class="colorXanh">Tổng tất cả:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongsoluong,0,".",",").' </strong></td>
								<td align="right"></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongsotien,3,".",",").' </strong></td>
							</tr>
						</table>
					</td>
				</tr> 
				<tr>
					<td valign="top" align="left" style="padding:7px 0;">
						<table cellspacing="0" cellpadding="0" border="0" width="100%" class="AddressPrint">
							<tbody>
								<tr>
									<td align="center" width="31%" valign="top">
										<strong>Tổng Giám Đốc</strong> <br />
										<span class="kyhoten">(Ký, họ tên, đóng dấu)</span>
										<div class="kyten">Nguyễn Ngọc Sơn</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>TP. Kế Toán</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten">N.T Ngọc Diễm</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>Người lập phiếu</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten"></div>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		';
	break;

	case 'ThongKeChiTietTemHop':
		$tieude = "THỐNG KÊ TỒN KHO CHI TIẾT KHO TEM HỘP";
		$sql = "select * from $GLOBALS[db_sp].dm_temhop where active = 1 and id IN(select idtemhop from $GLOBALS[db_sp].da_temhop) order by id asc";
		$rs = $GLOBALS['sp']->getAll($sql);
		foreach($rs as $item){
			$viewdl = array();
			$viewdl = thongKeTonKhoChiTietDaTemHop($cid, $item['id'], $fromDates, $toDates);
			if(ceil($viewdl['idtemhop']) > 0){
				if($i % 2 == 0)
					$styleColorRow = "style='background-color:#f2f2f2;'";
				$str .= '
					<tr '.$styleColorRow.' height="25" align="right">
						<td align="center">
							'.$i.'
						</td>
						<td align="left">
							'.$item['code'].'
						</td>
						<td align="left">
							'.$item['size'].'
						</td>
						<td>
							'.number_format($viewdl['sltonsddk'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['soluongnhap'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['soluongxuat'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['soluongton'],0,".",",").'
						</td>				
						<td>
							'.number_format($item['dongia'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['dongiaton'],3,".",",").'
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
								<td width="100%" colspan="2" valign="top" align="right" class="logan red">
									Ngày in phiếu: '.$datenow.'<strong> | </strong>'.$timenow.'
								</td>
							</tr>
							<tr>
								<td width="30%" valign="top" align="left" class="logan red">
									<img width="120" src="../images/logo.png"/> <br>
								</td>
								<td width="70%" valign="top" align="left">
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
								<td height="25" align="center" class="brbottom brleft">
									<strong>STT</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Mã Tem Hộp</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Size Tem Hộp</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Dư Đầu Kỳ</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng Nhập</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng Xuất</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng Tồn</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Đơn Giá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tiền Tồn</strong>
								</td>
							</tr>
							'.$str.' 
						</table>	
					</td>
				</tr>
				<tr>
					<td valign="top" align="left" style="padding:7px 0;">
						<table cellspacing="0" cellpadding="0" border="0" width="100%" class="AddressPrint">
							<tbody>
								<tr>
									<td align="center" width="31%" valign="top">
										<strong>Tổng Giám Đốc</strong> <br />
										<span class="kyhoten">(Ký, họ tên, đóng dấu)</span>
										<div class="kyten">Nguyễn Ngọc Sơn</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>TP. Kế Toán</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten">N.T Ngọc Diễm</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>Người lập phiếu</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten"></div>
									</td>							
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		';
	break;
	// ANH VŨ THÊM END THỐNG KÊ KHO TEM HỘP

	// ANH VŨ THÊM BEGIN THỐNG KÊ KHO TEM GIẤY
	case 'XuatKhoTemGiay':
	case 'NhapKhoTemGiay':
		if($act == 'NhapKhoTemGiay'){
			$tieude = 'THỐNG KÊ NHẬP KHO TEM GIẤY';
			$sql = "select * from $GLOBALS[db_sp].da_temgiay where type = 1 and trangthai = 2 $whdated order by dated desc, id desc";
			$rs = $GLOBALS['sp']->getAll($sql);
		}
		if($act == 'XuatKhoTemGiay'){
			$tieude = 'THỐNG KÊ XUẤT KHO TEM GIẤY';
			$sql = "select * from $GLOBALS[db_sp].da_temgiay where type = 2 and trangthai = 2 $whdated order by dated desc, id desc";
			$rs = $GLOBALS['sp']->getAll($sql);
		}
		foreach($rs as $item){
			$sqldm = "select dongia, code, size from $GLOBALS[db_sp].dm_temgiay where id = ".$item['idtemgiay'];
			$rsdm = $GLOBALS['sp']->getRow($sqldm);

			$thanhtien = round($item['soluong'] * $rsdm['dongia'],3);
			$tongsoluong = round($tongsoluong + $item['soluong'],3);
			$tongsotien = round($tongsotien + $thanhtien,3);
			$styleColorRow = '';
			if(ceil($item['id']) > 0){
				if($i % 2 == 0) $styleColorRow = "style='background-color:#f2f2f2'";
				$str .='
					<tr '.$styleColorRow.'>
						<td height="25" align="center">
							'.$i.'
						</td>
						<td height="25" align="left">
							'.date('d/m/Y',strtotime($item['dated'])).'
						</td>
						<td height="25" align="left">
							'.$item['maphieu'].'
						</td>
						<td height="25" align="left">
							'.$rsdm['code'].'
						</td>
						<td height="25" align="left">
							'.$rsdm['size'].'
						</td>
						<td  height="25" align="right">
							'.number_format($item['soluong'],0,".",",").'
						</td>
						<td height="25" align="right">
							'.number_format($rsdm['dongia'],0,".",",").'
						</td>
						<td height="25" align="right">
							'.number_format($thanhtien,3,".",",").'
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
								<td width="100%" colspan="2" valign="top" align="right" class="logan red">
									Ngày in phiếu: '.$datenow.' <br/>
									Thời gian: '.$timenow.'
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
								<td height="25" align="center" class="brbottom brleft" width="5%">
									<strong>STT</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft" width="10%">
									<strong>Ngày Duyệt</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft" width="20%">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft" width="10%">
									<strong>Mã Tem Hộp</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft" width="10%">
									<strong>Size Tem Hộp</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Đơn Giá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Thành Tiền</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="5" class="brbottom brleft"> <span class="colorXanh">Tổng tất cả:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongsoluong,0,".",",").' </strong></td>
								<td align="right"></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongsotien,3,".",",").' </strong></td>
							</tr>
						</table>
					</td>
				</tr> 
				<tr>
					<td valign="top" align="left" style="padding:7px 0;">
						<table cellspacing="0" cellpadding="0" border="0" width="100%" class="AddressPrint">
							<tbody>
								<tr>
									<td align="center" width="31%" valign="top">
										<strong>Tổng Giám Đốc</strong> <br />
										<span class="kyhoten">(Ký, họ tên, đóng dấu)</span>
										<div class="kyten">Nguyễn Ngọc Sơn</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>TP. Kế Toán</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten">N.T Ngọc Diễm</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>Người lập phiếu</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten"></div>
									</td>							
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		';
		
		
	break;

	case 'ThongKeChiTietTemGiay':
		$tieude = "THỐNG KÊ TỒN KHO CHI TIẾT KHO TEM GIẤY";
		$sql = "select * from $GLOBALS[db_sp].dm_temgiay where active = 1 and id IN(select idtemgiay from $GLOBALS[db_sp].da_temgiay) order by id asc";
		$rs = $GLOBALS['sp']->getAll($sql);
		
		foreach($rs as $item){
			$viewdl = array();
			$viewdl = thongKeTonKhoChiTietDaTemGiay($cid, $item['id'], $fromDates, $toDates);
			if(ceil($viewdl['idtemgiay']) > 0){
				if($i % 2 == 0){
					$styleColorRow = "style='background-color:#f2f2f2;'";
				}
				$str .= '
					<tr '.$styleColorRow.' height="25" align="right">
						<td align="center">
							'.$i.'
						</td>
						<td align="left">
							'.$item['code'].'
						</td>
						<td align="left">
							'.$item['size'].'
						</td>
						<td>
							'.number_format($viewdl['sltonsddk'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['soluongnhap'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['soluongxuat'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['soluongton'],0,".",",").'
						</td>				
						<td>
							'.number_format($item['dongia'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['dongiaton'],3,".",",").'
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
								<td width="100%" colspan="2" valign="top" align="right" class="logan red">
									Ngày in phiếu: '.$datenow.'<strong> | </strong>'.$timenow.'
								</td>
							</tr>
							<tr>
								<td width="30%" valign="top" align="left" class="logan red">
									<img width="120" src="../images/logo.png"/> <br>
								</td>
								<td width="70%" valign="top" align="left">
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
								<td height="25" align="center" class="brbottom brleft">
									<strong>STT</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Mã Tem Giấy</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Size Tem Giấy</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Dư Đầu Kỳ</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng Nhập</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng Xuất</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng Tồn</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Đơn Giá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tiền Tồn</strong>
								</td>
							</tr>
							'.$str.' 
						</table>	
					</td>
				</tr>
				<tr>
					<td valign="top" align="left" style="padding:7px 0;">
						<table cellspacing="0" cellpadding="0" border="0" width="100%" class="AddressPrint">
							<tbody>
								<tr>
									<td align="center" width="31%" valign="top">
										<strong>Tổng Giám Đốc</strong> <br />
										<span class="kyhoten">(Ký, họ tên, đóng dấu)</span>
										<div class="kyten">Nguyễn Ngọc Sơn</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>TP. Kế Toán</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten">N.T Ngọc Diễm</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>Người lập phiếu</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten"></div>
									</td>							
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		';
	break;
	// ANH VŨ THÊM END THỐNG KÊ KHO TEM GIẤY

	// ANH VŨ THÊM BEGIN THỐNG KÊ KHO TEM ĐÁ
	
	case 'NhapKhoTemDa':
		$tieude = 'THỐNG KÊ NHẬP KHO TEM ĐÁ';
			$sql = "select * from $GLOBALS[db_sp].da_temda where type = 1 and trangthai IN(1,2) and dated >= '".$fromDate."' and dated <= '".$toDate."' order by maphieu desc";
			$rs = $GLOBALS['sp']->getAll($sql);
		foreach($rs as $item){
			$tongsoluong = round($tongsoluong + $item['soluongda'],3);
			$tongsotien = round($tongsotien + $item['tongtienda'],3);
			$styleColorRow = '';
			if(ceil($item['id']) > 0){
				if($i % 2 == 0) $styleColorRow = "style='background-color:#f2f2f2'";
				$str .='
					<tr '.$styleColorRow.'>
						<td height="25" align="center">
							'.$i.'
						</td>
						<td height="25" align="left">
							'.date('d/m/Y',strtotime($item['dated'])).'
						</td>
						<td height="25" align="left">
							'.$item['maphieu'].'
						</td>
						<td height="25" align="left">
							'.$item['mada'].'
						</td>
						<td height="25" align="left">
							'.$item['tenda'].'
						</td>
						<td height="25" align="left">
							'.$item['sizeda'].'
						</td>
						<td  height="25" align="right">
							'.number_format($item['soluongda'],0,".",",").'
						</td>
						<td height="25" align="right">
							'.number_format($item['dongiada'],0,".",",").'
						</td>
						<td height="25" align="right">
							'.number_format($item['tongtienda'],3,".",",").'
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
								<td width="100%" colspan="2" valign="top" align="right" class="logan red">
									Ngày in phiếu: '.$datenow.' <br/>
									Thời gian: '.$timenow.'
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
								<td height="25" align="center" class="brbottom brleft" width="5%">
									<strong>STT</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft" width="10%">
									<strong>Ngày Duyệt</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft" width="20%">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft" width="10%">
									<strong>Mã Đá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft" width="10%">
									<strong>Tên Đá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Size Đá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Đơn Giá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Thành Tiền</strong>
								</td>
							</tr>
							'.$str.'
							<tr>
								<td align="right" colspan="6" class="brbottom brleft"> <span class="colorXanh">Tổng tất cả:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongsoluong,0,".",",").' </strong></td>
								<td align="right"></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongsotien,3,".",",").' </strong></td>
							</tr>
						</table>
					</td>
				</tr> 
				<tr>
					<td valign="top" align="left" style="padding:7px 0;">
						<table cellspacing="0" cellpadding="0" border="0" width="100%" class="AddressPrint">
							<tbody>
								<tr>
									<td align="center" width="31%" valign="top">
										<strong>Tổng Giám Đốc</strong> <br />
										<span class="kyhoten">(Ký, họ tên, đóng dấu)</span>
										<div class="kyten">Nguyễn Ngọc Sơn</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>TP. Kế Toán</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten">N.T Ngọc Diễm</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>Người lập phiếu</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten"></div>
									</td>							
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		';
	break;

	case 'XuatKhoTemDa':
		$tieude = 'THỐNG KÊ XUẤT KHO TEM ĐÁ';
		$sqlFrom = " from $GLOBALS[db_sp].da_temda ";
		$sqlWhere = " where type = 2 and trangthai = 2 and datexuat >= '".$fromDate."' and datexuat <= '".$toDate."'";
		$sqlOrderBy = " order by datexuat desc, id desc ";
		$sql = "select * $sqlFrom $sqlWhere $sqlOrderBy";
		$rs = $GLOBALS['sp']->getAll($sql);
		//Tính tổng idda
		$sqltong = "select * $sqlFrom $sqlWhere group by idda $sqlOrderBy";
		$rstong = $GLOBALS['sp']->getAll($sqltong);

		foreach($rs as $item){
			$tongsoluong = round($tongsoluong + $item['soluongda'],3);
			$tongsotien = round($tongsotien + $item['tongtienda'],3);
			$typePhongChuyenSX = getLinkTitleKhoShort1($item['phongbanin'],1);
			$styleColorRow = '';
			if(ceil($item['id']) > 0){
				if($i % 2 == 0) $styleColorRow = "style='background-color:#f2f2f2'";
				$str .='
					<tr '.$styleColorRow.'>
						<td height="25" align="center">
							'.$i.'
						</td>
						<td height="25" align="left">
							'.date('d/m/Y',strtotime($item['dated'])).'
						</td>
						<td height="25" align="left">
							'.$item['maphieu'].'
						</td>
						<td height="25" align="left">
							'.$item['mada'].'
						</td>
						<td height="25" align="left">
							'.$item['tenda'].'
						</td>
						<td height="25" align="left">
							'.$item['sizeda'].'
						</td>
						<td  height="25" align="right">
							'.number_format($item['soluongda'],0,".",",").'
						</td>
						<td height="25" align="right">
							'.number_format($item['dongiada'],0,".",",").'
						</td>
						<td height="25" align="right">
							'.number_format($item['tongtienda'],3,".",",").'
						</td>
						<td height="25" align="left">
							'.$typePhongChuyenSX.'
						</td>
						<td height="25" align="left">
							'.$item['ghichu'].'
						</td>
					</tr>
				';
				$i++;
			}
		}
		foreach($rstong as $value){
			$sqlSum = "select ROUND(SUM(soluongda),3) as soluongda, ROUND(SUM(tongtienda),3) as tongtienda $sqlFrom $sqlWhere and idda = ".$value['idda'];
			// die($sqlSum);
			$rsSum = $GLOBALS['sp']->getRow($sqlSum);
			if(ceil($value['id']) > 0){
				$strTong .='
					<tr>
						<td colspan="3"></td>
						<td align="left" class="brbottom brleft"> <strong class="colorXanh"> '.$value['mada'].' </strong> </td>
						<td align="left" class="brbottom brleft"> <strong class="colorXanh"> '.$value['tenda'].' </strong> </td>
						<td align="left" class="brbottom brleft"> <strong class="colorXanh"> '.$value['sizeda'].' </strong> </td>
						<td align="right" class="brbottom brleft"> <strong class="colorXanh"> '.number_format($rsSum['soluongda'],0,".",",").' </strong> </td>
						<td align="right" class="brbottom brleft"> <strong class="colorXanh"> '.number_format($value['dongiada'],0,".",",").' </strong> </td>
						<td align="right" class="brbottom brleft"> <strong class="colorXanh"> '.number_format($rsSum['tongtienda'],0,".",",").' </strong> </td>
						<td align="right" colspan="2" class="brbottom brleft"></td>
					</tr>
				';
			}
		}
		echo '
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" height="80" >
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100%" colspan="2" valign="top" align="right" class="logan red">
									Ngày in phiếu: '.$datenow.' <br/>
									Thời gian: '.$timenow.'
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
								<td height="25" align="center" class="brbottom brleft" width="5%">
									<strong>STT</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft" width="10%">
									<strong>Ngày Duyệt</strong>
								</td>
								<td height="25"  align="center" class="brbottom brleft" width="20%">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft" width="10%">
									<strong>Mã Đá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft" width="10%">
									<strong>Tên Đá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Size Đá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Đơn Giá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Thành Tiền</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Phòng Chuyển</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ghi Chú</strong>
								</td>
							</tr>
							'.$str.'
							'.$strTong.'
							<tr>
								<td align="right" colspan="6" class="brbottom brleft"> <span class="colorXanh">Tổng tất cả:</span> </td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongsoluong,0,".",",").' </strong></td>
								<td align="right"></td>
								<td align="right" class="brbottom brleft"><strong class="colorXanh"> '.number_format($tongsotien,3,".",",").' </strong></td>
								<td align="right" colspan="2" class="brbottom brleft"> </td>
							</tr>
						</table>
					</td>
				</tr> 
				<tr>
					<td valign="top" align="left" style="padding:7px 0;">
						<table cellspacing="0" cellpadding="0" border="0" width="100%" class="AddressPrint">
							<tbody>
								<tr>
									<td align="center" width="31%" valign="top">
										<strong>Tổng Giám Đốc</strong> <br />
										<span class="kyhoten">(Ký, họ tên, đóng dấu)</span>
										<div class="kyten">Nguyễn Ngọc Sơn</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>TP. Kế Toán</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten">N.T Ngọc Diễm</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>Người lập phiếu</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten"></div>
									</td>							
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		';
	break;

	case 'ThongKeChiTietDaTemDa':
		$tieude = "THỐNG KÊ TỒN KHO CHI TIẾT KHO TEM ĐÁ";
		$sql = "select * from $GLOBALS[db_sp].da_temda where trangthai = 2 $wh group by idda";
		$rs = $GLOBALS['sp']->getAll($sql);
		foreach($rs as $item){
			$styleColorRow = '';
			$viewdl = array();
			$viewdl = thongKeTonKhoChiTietDaTemDa($cid, $item['idda'], $fromDates, $toDates); 
			if(ceil($viewdl['idda']) > 0){
				if($i % 2 == 0){
					$styleColorRow = "style='background-color:#f2f2f2;'";
				}
				$str.='
					<tr '.$styleColorRow.' height="25" align="right">
						<td align="center">
							'.$i.'
						</td>
						<td align="left">
							'.$item['mada'].'
						</td>
						<td align="left">
							'.$item['sizeda'].'
						</td>
						<td>
							'.number_format($viewdl['sltonsddk'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['soluongnhap'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['soluongxuat'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['soluongton'],0,".",",").'
						</td>				
						<td>
							'.number_format($item['dongiada'],0,".",",").'
						</td>
						<td>
							'.number_format($viewdl['dongiaton'],3,".",",").'
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
								<td width="100%" colspan="2" valign="top" align="right" class="logan red">
									Ngày in phiếu: '.$datenow.'<strong> | </strong>'.$timenow.'
								</td>
							</tr>
							<tr>
								<td width="30%" valign="top" align="left" class="logan red">
									<img width="120" src="../images/logo.png"/> <br>
								</td>
								<td width="70%" valign="top" align="left">
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
								<td height="25" align="center" class="brbottom brleft">
									<strong>STT</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Mã Đá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Size Đá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Dư Đầu Kỳ</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng Nhập</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng Xuất</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Số Lượng Tồn</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Đơn Giá</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Tiền Tồn</strong>
								</td>
							</tr>
							'.$str.' 
						</table>	
					</td>
				</tr>
				<tr>
					<td valign="top" align="left" style="padding:7px 0;">
						<table cellspacing="0" cellpadding="0" border="0" width="100%" class="AddressPrint">
							<tbody>
								<tr>
									<td align="center" width="31%" valign="top">
										<strong>Tổng Giám Đốc</strong> <br />
										<span class="kyhoten">(Ký, họ tên, đóng dấu)</span>
										<div class="kyten">Nguyễn Ngọc Sơn</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>TP. Kế Toán</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten">N.T Ngọc Diễm</div>
									</td>
									<td align="center" width="23%" valign="top">
										<strong>Người lập phiếu</strong> <br />
										<span class="kyhoten">(Ký, họ tên)<span>
										<div class="kyten"></div>
									</td>							
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		';
	break;
	// ANH VŨ THÊM END THỐNG KÊ KHO TEM ĐÁ

	// ANH VŨ THÊM BEGIN THỐNG KÊ KHO TEM ĐÁ LƯU TRỮ
	case 'KhoTemDaLuuTru':
		if(!empty($tenchinhanhs) && $tenchinhanhs != ''){
			$wh.=' and tenchinhanh like "%'.$tenchinhanhs.'%"';
		}
		if(!empty($ghichus) && $ghichus != ''){
			$wh.=' and ghichuvang like "%'.$ghichus.'%"';
		}
		$tieude = "THỐNG KÊ TỒN KHO TEM ĐÁ KHO CHÚ SƠN LƯU TRỮ VÀNG";
		$sql = "select * from $GLOBALS[db_sp].da_temda_luutru where type = 1 and trangthai = 2 and typechuyen = 2 $wh $whdated order by maphieu asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
		
		foreach($rs as $item){
			$styleColorRow = '';
			$sqllv = "select name_vn from $GLOBALS[db_sp].loaivang where id = ".$item['idloaivang'];
			$loaivang = $GLOBALS['sp']->getOne($sqllv);
			if(ceil($item['id']) > 0){
				if($i % 2 == 0){
					$styleColorRow = "style='background-color:#f2f2f2;'";
				}
				$str.='
					<tr '.$styleColorRow.' height="25">
						<td align="center">
							'.$i.'
						</td>
						<td>
							'.date('d/m/Y',strtotime($item['dated'])).'
						</td>
						<td>
							'.$item['tenchinhanh'].'
						</td>
						<td>
							'.$item['maphieu'].'
						</td>
						<td>
							'.$item['ghichuvang'].'
						</td>
						<td>
							'.$loaivang.'
						</td>
						<td align="right">
							'.number_format($item['cannangvh'],3,".",",").'
						</td>				
						<td align="right">
							'.number_format($item['cannangh'],3,".",",").'
						</td>
						<td align="right">
							'.number_format($item['cannangv'],3,".",",").'
						</td>
					</tr>
				';
				$i++;
			}
		}
		echo '
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" height="80">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100%" colspan="2" valign="top" align="right" class="logan red">
									Ngày in phiếu: '.$datenow.'<strong> | </strong>'.$timenow.'
								</td>
							</tr>
							<tr>
								<td width="30%" valign="top" align="left" class="logan red">
									<img width="120" src="../images/logo.png"/> <br>
								</td>
								<td width="70%" valign="top" align="left">
									<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div>
									<div class="DatedPrint DatedPhieuchi"> '.$tieudedate.'</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
		
				<tr>
					<td valign="top" align="left">
						<table width="100%" border="1" cellpadding="0" cellspacing="0">
							<tr bgcolor="#e9e8e8">
								<td height="25" align="center" class="brbottom brleft">
									<strong>STT</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ngày Duyệt</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Chi Nhánh</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Mã Phiếu</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Ghi Chú</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Loại Vàng</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Cân Nặng V + H</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Cân Nặng H</strong>
								</td>
								<td height="25" align="center" class="brbottom brleft">
									<strong>Cân Nặng V</strong>
								</td>
							</tr>
							'.$str.' 
						</table>	
					</td>
				</tr>
			</table>
		';
	break;
	// ANH VŨ THÊM END THỐNG KÊ KHO TEM ĐÁ LƯU TRỮ
	
	//=========================KẾT THÚC THÊM KHO KHÁC KHO LƯU MẪU===========================//
	default:
		die('Vui lòng liên hệ với admin.');
	break;
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