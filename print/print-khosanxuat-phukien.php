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
	.XuatkhoPrintDate {
		color: #000000;
		font-size:16px;
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
	font-size:12px;
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
	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
	$table = isset($_REQUEST['table'])?$_REQUEST['table']:"";
	$codes = isset($_REQUEST['codes'])?$_REQUEST['codes']:"";
	$idloaivang = isset($_REQUEST['idloaivang'])?$_REQUEST['idloaivang']:"";
	$maphukiens = isset($_REQUEST['maphukiens'])?$_REQUEST['maphukiens']:"";
	$fromDate = trim(striptags($_GET['fromdays']));
	$toDate = trim(striptags($_GET['todays']));
	
	if(!empty($codes)){
		$wh.=' and maphieu like "%'.$codes.'%" ';
	}
	if(!empty($idloaivang)){
		$wh.=' and idloaivang = '.$idloaivang;
	}
	if(!empty($maphukiens)){
		
		// Lấy ra tất cả idphukien ứng với chuỗi search mã phụ kiên
		$sqlIdPKCatalog = "select id from $GLOBALS[db_catalog].products WHERE (cid IN (SELECT id FROM $GLOBALS[db_catalog].categories WHERE pid=815)) and (name_vn LIKE '%" . $maphukiens . "%' or code LIKE '%" . $maphukiens . "%')";
		$rsIdPKCatalog = $GLOBALS["catalog"]->getCol($sqlIdPKCatalog);

		if(ceil(count($rsIdPKCatalog)) > 0){
			// Biến mảng $rsIdPKCatalog thành chuỗi idphukien
			$idPKCatalog = implode(',',$rsIdPKCatalog);
			$wh.=" and idphukien in (".$idPKCatalog.")";
		} else {
			$wh.=" and idphukien in (0)";
		}
	}	
		
	if(!empty($fromDate)){
		$fromDateNX = explode('/',$fromDate);
		$fromDateNX = $fromDateNX[2].'-'.$fromDateNX[1].'-'.$fromDateNX[0];				
	}
	if(!empty($toDate)){
		$toDateNX = explode('/',$toDate);
		$toDateNX = $toDateNX[2].'-'.$toDateNX[1].'-'.$toDateNX[0];
	}
		
				
	switch($act){
		//======================XUATKHOID============================//
		case"XuatKhoId":			
			$sql = "select * from $GLOBALS[db_sp].".$table." where id=$id";
			$rs = $GLOBALS["sp"]->getRow($sql);		

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
										<div class="XuatkhoPrint PrintPhieuchi">Phiếu Xuất Kho</div> 
										<div class="DatedPrint DatedPhieuchi">Ngày '.$datenow.' <span class="MaPhieu">Mã Phiếu: '.$rs['maphieu'].'</span> </div>									
									</td>
								</tr>
								<tr>
									<td width="40%">
										<strong>Phòng Giao: </strong>'.$titlegiao.'
									</td>
									<td>
										<strong>Phòng Nhận: </strong>'.$titlenhan.'
									</td>
								</tr>
								<tr>
									<td>
										<strong>Toa Hàng: '.getNamMaDonHangCatalog($rs['madhin']).'</strong>
									</td>
									<td>
										<strong>Cân bì:</strong>  
									</td>
								</tr>
								<tr>
									<td>
										<strong>Loại vàng: '.getName('loaivang', 'name_vn', $rs['idloaivang']).'</strong>
									</td>
								</tr>
							</table>
						</td>
					</tr>					
					<tr>
						<td valign="top" align="left">
							<table width="100%" border="1" style="BORDER-COLLAPSE: collapse;" bordercolor="#ccc" cellpadding="0" cellspacing="0">
								<tr bgcolor="#e9e8e8" align="center"> 
									<td height="25" class="brbottom brleft">
										<strong>Tên Hàng</strong>
									</td>
									<td height="25" class="brbottom brleft">
										<strong>CV + Hột</strong>
									</td>
									<td height="25" class="brbottom brleft">
										<strong>Cân Hột</strong>
									</td>
									<td height="25" class="brbottom brleft">
										<strong>Cân Vàng</strong>
									</td>
									<td>
										<strong>Mã Phụ Kiện</strong>
									</td>
									<td>
										<strong>Số Lượng</strong>
									</td>
									<td height="25" class="brbottom brleft">
										<strong>Tuổi Vàng</strong>
									</td>
								</tr>
								<tr> 
									<td height="25" align="left">									
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
									<td>
										'.getMaPhuKienCatalog($rs['idphukien']).'
									</td>
									<td height="25" align="right">
										'.number_format($rs['soluongphukien'],1,".",",").'
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
			
		break;
		//===============NHẬP KHO - XUẤT KHO========================//
		case"XuatKho":
		case"NhapKho":			
			$sqlFrom = " from $GLOBALS[db_sp].khosanxuat_phukien";	
			$sqlRound = " ROUND(SUM(cannangv), 3) as cannangv ";	
			$sqlGroupOrder = " group by idloaivang
							   order by idloaivang asc";	
			$tieude = "";	
			if($act=="NhapKho"){
				$tieude = "KHO SẢN XUẤT KHO PHỤ KIỆN PHIẾU NHẬP KHO";
				$dateNX = "Ngày Nhập";
				$sqlWhere = " where type=1 and typechuyen=2 ";
				$sqlDatedChuyen = " and datechuyen >= '".$fromDateNX."' and datechuyen <= '".$toDateNX."' ";
				$sqlOrderDatedChuyen = " order by datechuyen desc, id desc ";
				$datedXuatChuyen = "datechuyen";
				$sql = "select * ".$sqlFrom.$sqlWhere.$wh.$sqlDatedChuyen.$sqlOrderDatedChuyen; //sql lấy phiếu thỏa đk
				$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$wh.$sqlDatedChuyen.$sqlGroupOrder; //sql tính tông cân nặng vàng theo loại vàng	
				$sql_tong = "select ".$sqlRound.$sqlFrom.$sqlWhere.$sqlDatedChuyen; //sql tính tổng cân nặng vàng
				}
			if($act=="XuatKho"){
				$tieude = "KHO SẢN XUẤT KHO PHỤ KIỆN PHIẾU XUẤT KHO";
				$dateNX = "Ngày Xuất";
				$sqlWhere = " where type = 3 and trangthai = 2 ";	
				$sqlDatedXuat = " and datedxuat >= '".$fromDateNX."' and datedxuat <= '".$toDateNX."' ";	
				$sqlOrderDatedXuat = " order by datedxuat desc, id desc ";	
				$datedXuatChuyen = "datedxuat";
				$sql = "select * ".$sqlFrom. $sqlWhere.$wh.$sqlDatedXuat.$sqlOrderDatedXuat; //sql lấy phiếu thỏa đk
				$sql_tongloaivang = "select idloaivang, ".$sqlRound.$sqlFrom.$sqlWhere.$wh.$sqlDatedXuat.$sqlGroupOrder; //sql tính tông cân nặng vàng loại vàng	
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
					$str.="	<tr ".$styleColorRow." height='30px'>
								<td align='center'>".$i."</td>
								<td align='center'>".date("d/m/Y", strtotime($value[$datedXuatChuyen]))."</td>
								<td>".$value['maphieu']."</td>
								<td align='right'>".getName('loaivang', 'name_vn', $value['idloaivang'])."</td>
								<td align='right'>".number_format($value['cannangvh'],3,".",",")."</td>
								<td align='right'>".number_format($value['cannangh'],3,".",",")."</td>
								<td align='right'>".number_format($value['cannangv'],3,".",",")."</td>
								<td>".getLinkTitle($value['chonphongbanin'],1)."</td>
								<td></td>
								<td>".$value['ghichuvang']."</td>
								<td>".getMaPhuKienCatalog($value['idphukien'])."</td>
								<td align='right'>".number_format($value['soluongphukien'],3,".",",")."</td>
							</tr>";
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
										'.$datenow.' | '.$timnow.'
									</td>
								</tr>
								<tr>
									<td width="30%" valign="top" align="left" class="logan red">
										<img width="120" src="../images/logo.png"/> <br>
									</td>
									<td width="70%" valign="top" align="left" >
										<div class="XuatkhoPrint">'.$tieude.'</div> 
										<div class="XuatkhoPrintDate" >Từ ngày '.$fromDate.' Đến ngày '.$toDate.'</div>					
									</td>
								</tr>
							</table>
						</td>
					</tr>					
					<tr>
						<td valign="top" align="left">
							<table width="100%" border="1" style="BORDER-COLLAPSE: collapse;" bordercolor="#ccc" cellpadding="0" cellspacing="0" >
								<tr bgcolor="#e9e8e8" height="30px" align="center"> 
									<td class="tdSTT" >
										<strong>STT</strong>
									</td>
									<td>
										<strong>'.$dateNX.'</strong>
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
										<strong>Cân Nặng H</strong>
									</td>
									<td>
										<strong>Cân Nặng V</strong>
									</td>                    
									<td >
										<strong>Phòng SX</strong>
									</td>
									<td>
										<strong>Mã ĐH</strong>
									</td>
									<td>
										<strong>Ghi Chú</strong>
									</td>
									<td>
										<strong>Mã Phụ Kiện</strong>
									</td>
									<td>
										<strong>Số Lượng</strong>
									</td>
								</tr>
								'.$str.'								
							</table>
						</td>
					</tr>						
				</table>	
			';
		break;
		//==========Thống Kê Hao Dư=====================//
		case "HaoDu":
			$checkDatechuyen = 'Ok';
			$sql = "select * from $GLOBALS[db_sp].".$table." 
					where dated >= '".$fromDate."' 
					and dated <= '".$toDate."' 
					order by numphieu asc, dated asc
			";
			$rscth = $GLOBALS["sp"]->getAll($sql);	
			foreach($rscth as $value){
				$datedshow = date("d/m/Y", strtotime($value['dated']));
				$str .= '
					<tr> 
						<td height="25" align="left">
							'.$i.'
						</td>
						<td height="25" align="left">						
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
						<td></td>
						<td></td>
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
										<div class="XuatkhoPrint PrintPhieuchi">KHO SẢN XUẤT KHO PHỤ KIỆN THỐNG KÊ HAO DƯ</div> 
										<div class="DatedPrint"> Từ Ngày '.$fromDate.' -  Đến Ngày '.$toDate.'</div>
										
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
									<td height="25" align="center" class="brbottom brleft">
										<strong>Loại Vàng</strong>
									</td>
									<td height="25" align="center" class="brbottom brleft">
										<strong>Hao Kết Dẻo</strong>
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
		//////////////////

		// Thống kê nhập xuất tồn phụ kiện
		case "NhapXuatTonPhuKien":

			$sql = "SELECT * from $GLOBALS[db_sp].khosanxuat_phukienma_sodudauky WHERE 1=1 $wh GROUP BY idphukien, idloaivang";
			$rs = $GLOBALS["sp"]->getAll($sql);
			// print_R($rs); die();

			$i = 1;
			foreach($rs as $item){
				$sqlhaodusddk = $rshaodusddk = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt = $sqlhaodu = $rshaodu = $sqlnhap = $rsnhap = $sqlxuat = $rsxuat = '';
				$sltonVsddk = $sltonPKsddk = $sltonPKtndt = $sltonVtndt = $sltonPKtndn = $sltonVtndn = $slnhap = $slxuat = $sltontndt = 0;

				$idphukien = $item['idphukien'];
				$idloaivang = $item['idloaivang'];

				$table = 'khosanxuat_phukien';
				$tablehachtoanma = 'khosanxuat_phukienma_sodudauky';
				$tablehaodu = 'khosanxuat_phukienhaodu';

				$fromDate = $_GET['fromdays'];
				$toDate = $_GET['todays'];

				if(!empty($fromDate)){
					$showTuNgay = $fromDate;
					$fromDate = explode('/',$fromDate);
					$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
					$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
				} else {
					$fromDate = date("d/m/Y");
					$showTuNgay = $fromDate;
					$fromDate = explode('/',$fromDate);
					$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
					$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
				}
				if(!empty($toDate)){	
					$showDenNgay = $toDate;	
					$toDate = explode('/',$toDate);
					$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
				} else {
					$toDate = date("d/m/Y");
					$showDenNgay = $toDate;	
					$toDate = explode('/',$toDate);
					$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
				}

				if($idphukien > 0 && $idloaivang > 0) {
					
					// Lấy tháng trước của ngày chọn, nếu không chọn thì lấy tháng trước của ngày hiện tại
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					// die($thangtruoc);
		
					//Get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, 
											ROUND(SUM(du), 3) as du, 
											ROUND(SUM(haochenhlech), 3) as haochenhlech, 
											ROUND(SUM(duchenhlech), 3) as duchenhlech 
											from $GLOBALS[db_sp].".$tablehachtoanma." 
											where idloaivang=".$idloaivang." and idphukien=".$idphukien."
											and dated <= '".$thangtruoc."'
									";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
		
					// Get số lượng đầu kỳ (nếu tháng trước có hạch toán thì lấy tháng trước đó, ko thì thấy tháng gần nhất có hạch toán)
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
		
					// Lấy ra số lượng tồn phụ kiện của tháng đó
					$sltonPKsddk = round($rstonsddk['sltonphukien'],3);
		
					// Tính số lượng vàng tồn còn lại dựa trên số dư đầu kỳ hao dư
					$sltonVsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);
					$sltonVsddk = round(round(($sltonVsddk - $rshaodusddk['haochenhlech']),3) + $rshaodusddk['duchenhlech'],3);
						
					$thangdauky = $rstonsddk['dated'];
					
					// Get số lượng hao dư ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
					$sqlhaodutndt = "select ROUND(SUM(hao), 3) as hao, 
											ROUND(SUM(du), 3) as du, 
											ROUND(SUM(haochenhlech), 3) as haochenhlech, 
											ROUND(SUM(duchenhlech), 3) as duchenhlech 
											from $GLOBALS[db_sp].".$tablehaodu." 
											 where idloaivang=".$idloaivang." and idphukien=".$idphukien."
											 and dated < '".$fromDate."'
											 and dated >= '".$datedauthang."'
									";
					$rshaodutndt = $GLOBALS['sp']->getRow($sqlhaodutndt);
					// die($sqlhaodutndt);
		
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3) as slnhapvang, 
										   ROUND(SUM(soluongphukien), 3) as slnhapphukien
										   from $GLOBALS[db_sp].".$table."
										   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
										   and type=1 
										   and typechuyen=2 
										   and dated < '".$fromDate."'
										   and dated >= '".$datedauthang."' 
								   "; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					// die($sqlnhaptndt);
		
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang, 
										   ROUND(SUM(soluongphukien), 3) as slxuatphukien  
										   from $GLOBALS[db_sp].".$table." 
										   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
										   and type=3 
										   and trangthai=2 
										   and datedxuat < '".$fromDate."'
										   and datedxuat >= '".$datedauthang."' 
								   ";
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
		
					// Tính số lượng tồn phụ kiện khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
					$sltonPKtndt = round(($rsnhaptndt['slnhapphukien'] - $rsxuattndt['slxuatphukien']),3);
					$sltonPKsddk = round(($sltonPKsddk + $sltonPKtndt),3);
		
					// Tính số lượng tồn vàng khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
					$sltonVtndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3) + round(($rshaodutndt['du'] - $rshaodutndt['hao']),3);
					$sltonVtndt = round(($sltonVtndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),3)),3); 
					$sltonVsddk = round(($sltonVsddk + $sltonVtndt),3);
		
					// Get số lượng nhập, xuất, hao, dư, tồn từ ngày đến ngày 
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du, 
										ROUND(SUM(haochenhlech), 3) as haochenhlech, 
										ROUND(SUM(duchenhlech), 3) as duchenhlech 
										from $GLOBALS[db_sp].".$tablehaodu."
										where idloaivang=".$idloaivang." and idphukien=".$idphukien."
										and dated >= '".$fromDate."'
										and dated <= '".$toDate."'
								";
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
						
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang,
									   ROUND(SUM(soluongphukien), 3) as slnhapphukien 
									   from $GLOBALS[db_sp].".$table." 
									   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
									   and type=1 
									   and typechuyen=2  
									   and dated >= '".$fromDate."'  
									   and dated <= '".$toDate."' 
								"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
		
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang,
									   ROUND(SUM(soluongphukien), 3) as slxuatphukien
									   from $GLOBALS[db_sp].".$table." 
									   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
									   and type=3
									   and trangthai=2
									   and datedxuat >= '".$fromDate."'  
									   and datedxuat <= '".$toDate."' 
								"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);
		
					// Tính số lượng tồn phụ kiện từ ngày đến ngày
					$sltonPKtndn = round(($rsnhap['slnhapphukien'] - $rsxuat['slxuatphukien']),3);
		
					// Tính số lượng tồn vàng từ ngày đến ngày
					$sltonVtndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3) + round(($rshaodu['du'] - $rshaodu['hao']),3);
					$sltonVtndn = $sltonVtndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),3);
		
					// Tổng số lượng tồn phụ kiện cuối kỳ
					$sltonPK = $sltonPKsddk + $sltonPKtndn;
		
					// Tổng trọng lượng tồn vàng cuối kỳ
					$sltonV = $sltonVsddk + $sltonVtndn;
		
					// Tính tổng Q10
					$tongQ10 = getTongQ10($sltonV, $idloaivang);
					
					$str .= '
                            <tr>
                                <td align="center">
                                    '.$i++.'
                                </td>
                                <td align="left">
                                    '.getMaPhuKienCatalog($item['idphukien']).'
                                </td>

                                <td align="left">
                                    '.getName("loaivang","name_vn",$item['idloaivang']).'
                                </td>
                                
								<td align="right">
									'.number_format($sltonPKsddk,3,".",",").'
                                </td>

                                <td align="right">
                                    '.number_format($sltonVsddk,3,".",",").'
                                </td>
					
                                <td align="right">
                                    '.number_format($rsnhap['slnhapphukien'],3,".",",").'
                                </td>

                                <td align="right">
                                    '.number_format($rsnhap['slnhapvang'],3,".",",").'
                                </td>

                                <td align="right">
                                    '.number_format($rsxuat['slxuatphukien'],3,".",",").'
								</td>
								
								<td align="right">
                                    '.number_format($rsxuat['slxuatvang'],3,".",",").'
								</td>
								
								<td align="right">
                                    '.number_format($sltonPK,3,".",",").'
								</td>
								
								<td align="right">
                                    '.number_format($sltonV,3,".",",").'
								</td>
								
								<td align="right">
                                    '.number_format($rshaodu['hao'],3,".",",").'
								</td>
								
								<td align="right">
                                    '.number_format($rshaodu['du'],3,".",",").'
								</td>
								
								<td align="right">
                                    '.number_format($rshaodu['haochenhlech'],3,".",",").'
								</td>
								
								<td align="right">
                                    '.number_format($rshaodu['duchenhlech'],3,".",",").'
								</td>
								
								<td align="right">
                                    '.number_format($tongQ10,3,".",",").'
                                </td>
                                
                            </tr>
						';	
						$tongtongQ10 = $tongtongQ10 + $tongQ10;
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
										<div class="XuatkhoPrint PrintPhieuchi">KHO PHỤ KIỆN THỐNG KÊ NHẬP XUẤT TỒN PHỤ KIỆN</div> 
										<div class="DatedPrint"> Từ Ngày '.$showTuNgay.' -  Đến Ngày '.$showDenNgay.'</div>
										
									</td>
								</tr>
							</table>
						</td>
					</tr>
			
					<tr>
						<td valign="top" align="left">
							<table width="100%" border="1" cellpadding="0" cellspacing="0">
								<tr bgcolor="#e9e8e8"> 
									<td>
										<strong>STT</strong>
									</td>
									<td>
										<strong>Mã Phụ Kiện</strong>
									</td>
									<td>
										<strong>Loại Vàng</strong>
									</td>
									<td>
										<strong>Số Lượng Tồn Đầu</strong>
									</td>
									<td>
										<strong>Trọng Lượng Tồn Đầu</strong>
									</td>
									<td>
										<strong>Số Lượng Nhập Trong Kỳ</strong>
									</td>
									<td>
										<strong>Trọng Lượng Nhập Trong Kỳ</strong>
									</td>
									<td>
										<strong>Số Lượng Xuất Trong Kỳ</strong>
									</td>
									<td>
										<strong>Trọng Lượng Xuất Trong Kỳ</strong>
									</td>
									<td>
										<strong>Số Lượng Tồn Cuối</strong>
									</td>
									<td>
										<strong>Trọng Lượng Tồn Cuối</strong>
									</td>
									<td>
										<strong>Hao Dẻ</strong>
									</td>
									<td>
										<strong>Dư Kết Dẻ</strong>
									</td>
									<td>
										<strong>Hao Chênh Lệch</strong>
									</td>
									<td>
										<strong>Dư Chênh Lệch</strong>
									</td>
									<td>
										<strong>Trọng Lượng Q10</strong>
									</td>
								</tr>
								'.$str.'
								<tr class="Paging fontSizeTon">
									<td align="right" colspan="15"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
									<td align="right"><strong class="colorXanh">'.number_format($tongtongQ10,3,".",",").'</strong></td>
								</tr>
							</table>
				
						</td>
					</tr>
					
				</table>
			';
		break;

		case "TonPhuKien":
			$sql = "SELECT * FROM $GLOBALS[db_sp].khosanxuat_phukienma_sodudauky 
							WHERE id IN (SELECT max(id) FROM $GLOBALS[db_sp].khosanxuat_phukienma_sodudauky 
							WHERE 1=1 $wh GROUP BY idloaivang,idphukien) 
					";
			$rs = $GLOBALS["sp"]->getAll($sql);
			// print_r($rs); die();

			$i = 1;
			foreach($rs as $item){
				$str .= '
						<tr>
							<td align="center">
								'.$i++.'
							</td>
							<td align="left">
								'.getMaPhuKienCatalog($item['idphukien']).'
							</td>

							<td align="left">
								'.getName("loaivang","name_vn",$item['idloaivang']).'
							</td>
							
							<td align="right">
								'.number_format($item['sltonphukien'],3,".",",").'
							</td>

							<td align="right">
								'.number_format($item['sltonv'],3,".",",").'
							</td>
							
							<td align="right">
								'.number_format(getTongQ10($item['sltonv'],$item['idloaivang']),3,".",",").'
							</td>
							
						</tr>
					';	
					$tongtongQ10 = $tongtongQ10 + getTongQ10($item['sltonv'],$item['idloaivang']);
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
										<div class="XuatkhoPrint PrintPhieuchi">KHO PHỤ KIỆN THỐNG KÊ TỒN PHỤ KIỆN</div> 
										<div class="DatedPrint"> Ngày: '.$datenow.'</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
			
					<tr>
						<td valign="top" align="left">
							<table width="100%" border="1" cellpadding="0" cellspacing="0">
								<tr bgcolor="#e9e8e8"> 
									<td align="center">
										<strong>STT</strong>
									</td>
									<td align="center">
										<strong>Mã Phụ Kiện</strong>
									</td>
									<td align="center">
										<strong>Loại Vàng</strong>
									</td>
									<td align="center">
										<strong>Số Lượng Tồn</strong>
									</td>
									<td align="center">
										<strong>Trọng Lượng Tồn</strong>
									</td>
									<td align="center">
										<strong>Trọng Lượng Q10</strong>
									</td>
								</tr>
								'.$str.'
								<tr class="Paging fontSizeTon">
									<td align="right" colspan="5"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
									<td align="right"><strong class="colorXanh">'.number_format($tongtongQ10,3,".",",").'</strong></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			';
		break;

		default:
			die('Vui lòng liên hệ với admin.');
		break;
	}
	
	?>
	</body>
	</html>
	<?php
	function getNamKhoSanXuat($id){
		$title = '';
		if($id > 0){
			$title = getLinkTitle($id,1);			
		}
		return $title;
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