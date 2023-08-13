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
$fromDateGach = $fromDates = trim($_GET['fromdays']);
$toDateGach = $toDates = trim($_GET['todays']);
$fromDate = $toDate = '';
if(!empty($fromDates)){
	$fromDate = explode('/',$fromDates);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];	
   $fromDateGach[2].'/'.$fromDateGach[1].'/'.$fromDateGach[0];
}
if(!empty($toDates)){
	$toDate = explode('/',$toDates);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
}
$table = isset($_REQUEST['table'])?$_REQUEST['table']:"";
$typevkc = isset($_REQUEST['typevkc'])?$_REQUEST['typevkc']:1;
$cid = isset($_REQUEST['cid'])?$_REQUEST['cid']:0;
$idname = isset($_REQUEST['idname'])?$_REQUEST['idname']:0;
$idloaivang = isset($_REQUEST['idloaivang'])?$_REQUEST['idloaivang']:0;
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";

$tieude = $title = $checkDatechuyen =  '';
$i = 1;
if(ceil($cid) > 0){
	$title = getLinkTitle($cid,1);
	if(!empty($title)){
		$title = explode('&raquo;',$title);
		$title = $title[1];	
	}
}

if($act == 'nhapkho')
	$tieude = $title.' NHẬP KHO';
else if($act == 'xuatkho')
	$tieude = $title.' XUẤT KHO';
else if($act == 'haodu')
	$tieude = $title.' HAO DƯ';
else if($act == 'tonkho')
	$tieude = $title.' TỒN KHO CHI TIẾT';
else if($act == 'tonkhohientai' || $act == 'khophankimTonKhoCT')
	$tieude = $title.' TỒN KHO';
else if($act == 'TonKhoDonHangCT')
	$tieude = $title.' TỒN KHO CHI TIẾT ĐƠN HÀNG';
	
switch($act){
	case"TonKhoDonHangCT":
		$wh = '';
		if($idloaivang > 0)
			$wh .=" and idloaivang = '".$idloaivang."' ";
		if(!empty($fromDate))
			$wh .=" and dated  <= '".$fromDate."' ";		
		$sqlvang1 = "select * from $GLOBALS[db_sp].khosanxuat_khothanhpham where type=1 
		    		 and typechuyen=2 
					 and cannangv > 0 
					 and slvangcon <> 0  
					 $wh 
					 order by dated asc, id asc
		";	
		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);	
	break;
	case"khophankimTonKhoCT":
		$sqlvang1 = "select * from $GLOBALS[db_sp].khokhac_khophankim where type = 1 
					 and trangthai=0 
					 and dalaydulieu=0 
					 and dated >= '".$fromDate."' 
					 and dated <= '".$toDate."'
					 order by dated asc, id desc
		"; 
		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);	
	break;
	case"tonkhohientai":
		$sqlvang1 = "select * from $GLOBALS[db_sp].loaivang where active=1 $wh order by num asc, id asc"; 
		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);	
	break;
	case"tonkho":
		$wh = '';
		if(ceil($idloaivang) > 0)
			$wh = " and id = ".$idloaivang." ";
		$sqlvang1 = "select * from $GLOBALS[db_sp].loaivang where active=1 $wh order by num asc, id asc"; 
		$rscth = $GLOBALS["sp"]->getAll($sqlvang1);	
	break;
	case"nhapkho":
		$checkDatechuyen = 'Ok';
		$sql = "select * from $GLOBALS[db_sp].".$table." 
				where type=1 
				and typechuyen=2 
				and dated >= '".$fromDate."' 
				and dated <= '".$toDate."' 
				order by numphieu asc, dated asc
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);	
	break;
	case"xuatkho":
		$sql = "select * from $GLOBALS[db_sp].".$table." 
				where type in(2,3)
				and datedxuat >= '".$fromDate."' 
				and datedxuat <= '".$toDate."' 
				order by numphieu asc, datedxuat asc
		";
		$rscth = $GLOBALS["sp"]->getAll($sql);	
	break;
	
	case"haodu":
		$checkDatechuyen = 'Ok';
		$sql = "select * from $GLOBALS[db_sp].".$table." 
				where dated >= '".$fromDate."' 
				and dated <= '".$toDate."' 
				order by numphieu asc, dated asc
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
if($act == 'haodu'){
	foreach($rscth as $value){
		$datedshow = date("d/m/Y", strtotime($value['dated']));
		$str .= '
			<tr> 
				<td height="25" align="left">
					'.$i.'
				</td>
				<td height="25" align="left">
					'.$datedshow.'
				</td>
				<td height="25" align="left">
					'.$value['maphieu'].'
				</td>
				<td height="25" align="left">
					'.getName("loaivang","name_vn",$value['idloaivang']).' 
				</td>
				<td  height="25" align="right">
					'.number_format($value['hao'],3,".",",").'
				</td>
				<td height="25" align="right">
					'.number_format($value['du'],3,".",",").'
				</td>
				
				<td height="25" align="left">
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
								<strong>'.$tieudedated.'</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Phiếu</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Loại Vàng</strong>
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
}





else if($act == 'TonKhoDonHangCT'){
	foreach($rscth as $value){
		$madh = '';
		$datedshow = date("d/m/Y", strtotime($value['dated']));
		if(ceil($value['madhin']) > 0)
			$madh = getNamMaDonHangCatalog($value['madhin']);
		$str .= '
			<tr> 
			<td height="25" align="left">
				'.$i.'
			</td>
			<td height="25" align="left">
				'.$datedshow.'
			</td>
			<td height="25" align="left">
				'.$value['maphieu'].'
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
			<td height="25" align="right">
				 '.number_format($value['slvangcat'],3,".",",").'
			</td>
			<td height="25" align="right">
				 '.number_format($value['slvangcon'],3,".",",").'
			</td>
			<td height="25" align="left">
				 '.$madh.'
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
								'.$datedshow.'
							</td>
						</tr>
						<tr>
							<td width="30%" valign="top" align="left" class="logan red">
								<img width="120" src="../images/logo.png"/> <br>
							</td>
							<td width="70%" valign="top" align="left" >
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
								<div class="DatedPrint DatedPhieuchi">Ngày '.$fromDates.'</div>
								
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
								<strong>Ngày nhập</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Phiếu</strong>
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
								<strong>Vàng Cắt</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Vàng Còn Lại</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Mã ĐH</strong>
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




else if($act == 'khophankimTonKhoCT'){
	foreach($rscth as $value){

		$str .= '
			<tr> 
			<td height="25" align="left">
				'.$i.'
			</td>
			<td height="25" align="left">
				'.$datedshow.'
			</td>
			<td height="25" align="left">
				'.$value['maphieu'].'
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
			<td height="25" align="right">
				 '.$value['tuoivang'].'
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
								<strong>'.$tieudedated.'</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Phiếu</strong>
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
								<strong>Tuổi vàng</strong>
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
else if($act == 'tonkhohientai'){
	foreach($rscth as $value){
		$viewdl = array();
		$viewdl = thongKeTonKhoSanXuat($cid, $value['id'], '', '');
		if(ceil($viewdl['idloaivang']) > 0){
			$str .= '
				<tr> 
					<td height="25" align="left">
						'.$value['name_vn'].'
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
								<div class="XuatkhoPrint PrintPhieuchi">'.$tieude.'</div> 
								<div class="DatedPrint DatedPhieuchi"> Ngày '.$dateGetnow.'</div>
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
							
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tồn</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Tổng Trọng Lượng Q10</strong>
							</td>
						</tr>
						'.$str.'
						<tr class="Paging fontSizeTon">
							<td align="right" colspan="2"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
							<td align="right"><strong class="colorXanh">'.number_format($tongtongQ10,3,".",",").'</strong></td>
						</tr>   
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
}
else if($act == 'tonkho'){
	foreach($rscth as $value){
		$viewdl = array();
		$viewdl = thongKeTonKhoSanXuat($cid, $value['id'], $fromDateGach, $toDateGach);
		
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
							<td align="right" colspan="7"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
							<td align="right"><strong class="colorXanh">'.number_format($tongtongQ10,3,".",",").'</strong></td>
						</tr>   
					</table>
		
				</td>
			</tr>
			 
		</table>
	';
}
else{
	foreach($rscth as $value){
		$datedshow = $phongchuyen = '';
		if($act == 'nhapkho'){/// nhập kho
			$datedshow = date("d/m/Y", strtotime($value['dated']));
			$phongchuyen = 'Phòng Chuyển';
			
			if(ceil($value['cidchuyen']) > 0){
				$titlegiao = getLinkTitle($value['cidchuyen'],1);
				if(!empty($titlegiao)){
					$titlegiao = explode('&raquo;',$titlegiao);
					$titlegiao = $titlegiao[1];	
				}
			}
		}
		else{/// xuat kho
			$datedshow = date("d/m/Y", strtotime($value['datedxuat']));
			$phongchuyen = 'Phòng SX';
			
			if(ceil($value['chonphongbanin']) > 0){
				$titlegiao = getLinkTitle($value['chonphongbanin'],1);
				if(!empty($titlegiao)){
					$titlegiao = explode('&raquo;',$titlegiao);
					$titlegiao = $titlegiao[1];	
				}
			}
		}
		
		if(ceil($value['madhin']) > 0){
			$titledhsx = getNamMaDonHangCatalog($value['madhin']);
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
					'.$value['maphieu'].'
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
				<td height="25" align="left" >
					 '.$titlegiao.'
				</td>
				<td height="25" align="left" >
					 '.$titledhsx.'
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
								<strong>'.$tieudedated.'</strong>
							</td>
							<td height="25"  align="center" class="brbottom brleft">
								<strong>Mã Phiếu</strong>
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
								<strong>'.$phongchuyen.'</strong>
							</td>
							<td height="25" align="center" class="brbottom brleft">
								<strong>Mã ĐH</strong>
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