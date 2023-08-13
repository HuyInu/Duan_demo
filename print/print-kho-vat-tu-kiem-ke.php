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

$year = date("Y");
$month = date("m");
$day = date("d");
$datenow = $day.'/'.$month.'/'.$year;
$timnow = date('H:i:s');
$id = ceil(trim($_REQUEST['id']));
$tablekiemke = isset($_REQUEST['tablekiemke'])?$_REQUEST['tablekiemke']:"";
$tablekiemkect = isset($_REQUEST['tablekiemkect'])?$_REQUEST['tablekiemkect']:"";
// die("id: ".$id." tablekiemke: ".$tablekiemke." tablekiemkect: ".$tablekiemkect);

if($id > 0){
    // Load phiếu lớn từ table
	$sql = "SELECT * FROM $GLOBALS[db_sp].".$tablekiemke." where id=$id";
	$rs = $GLOBALS["sp"]->getRow($sql);

	// Load phiếu nhỏ từ tablect
	$sqlcth = "select * from $GLOBALS[db_sp].".$tablekiemkect." where idctnx=".$id." order by id asc ";
    $rscth = $GLOBALS["sp"]->getAll($sqlcth);
    
    $tileshow = 'PHIẾU KIỂM KÊ';

}

$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$i=1;

switch($act) {
    case "PhieuKiemKe":
		// Chạy vòng lặp load các dòng của tablect
		foreach($rscth as $value){
			// Lấy thông tin vật tư dựa theo idmavattu
			$sqlvattu = "SELECT mavattu, name_vn, donvitinh FROM $GLOBALS[db_sp].loaivattu WHERE id=".$value['idmavattu'];
			$rsvattu = $GLOBALS['sp']->getRow($sqlvattu);

			$str .= '
				<tr>
					<td align="center">
						'.$i.'
					</td>
					<td align="left">
						'.$rsvattu['mavattu'].'
					</td>

					<td align="left">
						'.$rsvattu['name_vn'].'
					</td>
					
					<td align="left">
						'.$rsvattu['donvitinh'].'
					</td>

					<td align="right">
						'.number_format($value['soluongtonpm'],2,".",",").'
					</td>
					
					<td align="right">
                        '.number_format($value['soluongtontt'],2,".",",").'
                    </td>
                    
                    <td align="right">
						'.number_format($value['chenhlechnhap'],2,".",",").'
                    </td>  
                    
                    <td align="right">
						'.number_format($value['chenhlechxuat'],2,".",",").'
					</td>  
				</tr>
			';
			$i++;
		}
		
		// Get tên phòng ban dựa theo typephongban
		$sqlphongban = "select name_vn from $GLOBALS[db_sp].categories where id=".$rs['typephongban'];
		$namePhongBan = $GLOBALS['sp']->getOne($sqlphongban);
		// die($namePhongBan);

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
									<div class="XuatkhoPrint PrintPhieuchi">'.$tileshow.'</div> 
									<div class="DatedPrint DatedPhieuchi">Ngày '.$day.' tháng  '.$month.'  năm  '.$year.' 
										<span class="MaPhieu">
											Số: ' .$rs['maphieu'].'
										</span>  
										<span class="MaPhieu">
											Ngày lập: ' .date("d/m/Y", strtotime($rs['datedchungtu'])) .'
										</span>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			
				<tr>
					<td valign="top" align="left">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100%">
									<div class="NamePrintAll">
										<div class="NamePrint">
											<strong>Phòng ban: </strong> &nbsp;
										</div> 
											'.$namePhongBan.'
									</div>
									<div class="NamePrintAll">
										<div class="NamePrint">
											<strong>Nhân viên lập phiếu: </strong> &nbsp;
										</div> 
											'.$rs['nguoilapphieu'].'
									</div>
									<div class="NamePrintAll">
										<div class="NamePrint">
											<strong>Diễn giải:</strong> &nbsp;
										</div> 
											'.$rs['lydo'].'
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
								<td width="3%" height="25" align="center" class="brbottom brleft">
									<strong>STT</strong>
								</td>
								<td width="10%" height="25" align="center" class="brbottom brleft">
									<strong>Mã Vật Tư</strong>
								</td>
								<td width="20%" height="25" align="center" class="brbottom brleft">
									<strong>Tên Vật Tư</strong>
								</td>
								<td width="9%"  height="25" align="center" class="brbottom brleft">
									<strong>Đơn Vị Tính</strong>
								</td>
								<td width="17%"  height="25" align="center" class="brbottom brleft">
									<strong>Tổng số lượng tồn trên phần mềm</strong>
								</td>
								<td width="15%"  height="25" align="center" class="brbottom brleft">
									<strong>Tổng số lượng tồn thực tế</strong>
								</td>
								<td width="14%"  height="25" align="center" class="brbottom brleft">
									<strong>Chênh lệch (Nhập Kho)</strong>
								</td>
								<td width="20%"  height="25" align="center" class="brbottom brleft">
									<strong>Chênh lệch (Xuất Kho)</strong>
								</td>
							</tr>
                            '.$str.'
                            <tr bgcolor="#e9e8e8">
								<td width="3%" height="25"></td>
								<td width="10%" height="25"></td>
								<td width="20%" height="25"></td>
                                <td width="9%"  height="25" align="right">
                                    <strong>Tổng Số Lượng</strong>
								</td>
                                <td width="17%"  height="25" align="right">
                                    <strong>
                                        '.number_format($rs['tongsoluongtonpm'],2,".",",").'
                                    </strong>
								</td>
                                <td width="15%"  height="25" align="right">
                                    <strong>
                                        '.number_format($rs['tongsoluongtontt'],2,".",",").'
                                    </strong>
								</td>
                                <td width="14%"  height="25" align="right">
                                    <strong>                                
                                        '.number_format($rs['tongchenhlechnhap'],2,".",",").'
                                    </strong>
								</td>
                                <td width="20%"  height="25" align="right">
                                    <strong>                                
                                        '.number_format($rs['tongchenhlechxuat'],2,".",",").'
                                    </strong>
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
										<div class="kyten">'.$rs['nguoilapphieu'].'</div>
									</td>							
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		';
	break;
}

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