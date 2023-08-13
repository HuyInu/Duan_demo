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
	.PrintPhieuchi {
		margin-left:40px;
		
	}
	.DatedPrint {
		font-family:"Times New Roman", Times, serif;
		font-size:16px;
		font-style:italic;
		margin-left:40px;
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
			border-bottom:1px #000000 dashed;
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
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$year = date("Y");
$month = date("m");
$day = date("d");
$datenow = $day.'/'.$month.'/'.$year;
$timnow = date('H:i:s');
$id = ceil(trim($_REQUEST['id']));
$table = isset($_REQUEST['table'])?$_REQUEST['table']:"";
switch($act){
	case"KhoSanXuat":
		$sql = "select * from $GLOBALS[db_sp].".$table." where id=$id";
		$rs = $GLOBALS["sp"]->getRow($sql);
	break;
	
	default:
		die('Vui lòng liên hệ với admin.');
	break;
}
if(ceil($rs['cid']) > 0){
	$titlegiao = getLinkTitle($rs['cid'],1);
	if(!empty($titlegiao)){
		$titlegiao = explode('&raquo;',$titlegiao);
		$titlegiao = $titlegiao[1];	
	}
}
if(ceil($rs['chonphongbanin']) > 0){
	$titlenhan = getLinkTitle($rs['chonphongbanin'],1);
	$titlenhan = explode('&raquo;',$titlenhan);
	$titlenhan = $titlenhan[0].' &raquo; '. $titlenhan[1];
	//$titlenhan = getLinkTitle($rs['chonphongbanin'],1);
	/*
	if(!empty($titlenhan) && $rs['chonphongbanin'] == 706){
		$titlenhan = explode('&raquo;',$titlenhan);
		$titlenhan = $titlenhan[0];	
	}
	else{
		$titlenhan = explode('&raquo;',$titlenhan);
		$titlenhan = $titlenhan[1];		
	}
	*/
}
echo '
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" height="80" >
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100%" colspan="2" valign="top" align="left" class="logan red">
							'.$datenow.' | '.$timnow.'
						</td>
					</tr>
					<tr>
						<td width="30%" valign="top" align="left" class="logan red">
							<img width="120" src="../images/logo.png"/> <br>
						</td>
						<td width="70%" valign="top" align="left" >
							<div class="XuatkhoPrint PrintPhieuchi">Phiếu Giao Đồ Thợ</div> 
							<div class="DatedPrint DatedPhieuchi">Giao Ngày '.$datenow.' <span class="MaPhieu">Số: '.$rs['maphieu'].'</span>  </div>
							
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top" align="left">
				<table width="100%" border="0" style="BORDER-COLLAPSE: collapse;" bordercolor="#ccc" cellpadding="0" cellspacing="0">
					<tr>
						<td width="50%">
							<div class="NamePrintAll">
								<div class="NamePrint"><strong>Phòng Giao:</strong> &nbsp;</div> '.$titlegiao.'
							</div>
						</td>
						<td width="50%">
							<div class="NamePrintAll">
								<div class="NamePrint"><strong>Phòng Nhận:</strong> &nbsp;</div> '.$titlenhan.'
							</div>
						</td>
					</tr>
					<tr>
						<td width="50%">
							<div class="NamePrintAll">
								<div class="NamePrint"><strong>Toa Hàng:</strong> &nbsp;</div> '.getNamMaDonHangCatalog($rs['madhin']).'
							</div>
							<div class="NamePrintAll">
								<div class="NamePrint"><strong>Loại Vàng:</strong> &nbsp;</div> <strong class="numchu">'.getName('loaivang', 'name_vn', $rs['idloaivang']).'</strong>
							</div>
						</td>
						<td width="50%">
							<div class="NamePrintAll">
								<div class="NamePrint"><strong>Cân Bì:</strong> &nbsp;</div> 
							</div>
						</td>
					</tr> 
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top" align="left">
				<table width="100%" border="1" style="BORDER-COLLAPSE: collapse;" bordercolor="#ccc" cellpadding="0" cellspacing="0">
					<tr bgcolor="#e9e8e8"> 
						<td height="25"  align="center" class="brbottom brleft">
							<strong>Tên Hàng</strong>
						</td>
						<td height="25" align="center" class="brbottom brleft">
							<strong>CV + Hột</strong>
						</td>
						<td height="25" align="center" class="brbottom brleft">
							<strong>Cân Hột</strong>
						</td>
						<td height="25" align="center" class="brbottom brleft">
							<strong>Cân Vàng</strong>
						</td>
						<td height="25" align="center" class="brbottom brleft">
							<strong>Tuổi Vàng</strong>
						</td>
					</tr>
					<tr> 
						<td height="25"  align="left">
							'.$rs['ghichuvang'].'
						</td>
						<td height="25" align="right">
							'.number_format($rs['cannangvh'],3,".",",").' 
						</td>
						<td height="25" align="right">
							'.number_format($rs['cannangh'],3,".",",").'
						</td>
						<td  height="25" align="right">
							'.number_format($rs['cannangv'],3,".",",").'
						</td>
						<td  height="25" align="right">
							'.number_format($rs['tuoivang'],4,".",",").'
						</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td valign="top" align="left" style="padding:7px 0;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%" class="AddressPrint">
					<tbody>
						<tr>
							<td align="center" width="50%" valign="top">
								<strong>Người Giao</strong>
							</td>
							
							<td align="center" width="50%" valign="top">
								<strong>Người Nhận</strong>
							</td>					
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>	
';
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