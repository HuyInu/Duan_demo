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
$dateGetnow = date("d-m-Y");
$timnow = date('H:i:s');

// Show từ ngày đến ngày 
$showTuNgay = $_GET['fromdays'];
$showDenNgay = $_GET['todays'];
if(empty($showTuNgay)){
    $showTuNgay = date("d/m/Y");
}
if(empty($showDenNgay)){
    $showDenNgay = date("d/m/Y");
}

$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";	

$cid = ceil(trim($_REQUEST['cid']));
$typephongban = ceil(trim($_REQUEST['typephongban']));

$i=1;

switch($act) {
    case "ThongKeTonKho":
        // Lấy tên kho dựa vào typephongban
        $sqlphongban = "select * from $GLOBALS[db_sp].categories where id=".$typephongban;
        $rsphongban= $GLOBALS['sp']->getRow($sqlphongban);
        $namephongban = $rsphongban['name_vn'];
        $tablehachtoan = $rsphongban['tablehachtoan'];
                
        $tieude = $namephongban.' THỐNG KÊ TỒN KHO';

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

        foreach($rs as $item){

			$str .= '
				<tr>
					<td align="center">
						
					</td>
					<td align="left">
						'.$item['mavattu'].'
					</td>

					<td align="left">
						'.$item['name_vn'].'
					</td>
					
					<td align="left">
						'.$item['donvitinh'].'
					</td>

					<td align="right">
						'.number_format($item['soluongton'],2,".",",").'
					</td>
					
				</tr>
			';
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
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Hình</strong>
                                </td>
                                
                                <td height="25"align="center" class="brbottom brleft">
                                    <strong>Mã Vật Tư</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Tên Vật Tư</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Đơn Vị Tính</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Số Lượng Tồn Kho</strong>
                                </td>
                            </tr>
                            '.$str.' 
                        </table>
                    </td>
                </tr>
            </table>
        ';

    break;

    case "ThongKeNhapXuatTonKho":
        // Lấy tên kho dựa vào typephongban
        $sqlphongban = "select * from $GLOBALS[db_sp].categories where id=".$typephongban;
        $rsphongban= $GLOBALS['sp']->getRow($sqlphongban);
        $namephongban = $rsphongban['name_vn'];
        $tablehachtoan = $rsphongban['tablehachtoan'];

        $tieude = $namephongban.' THỐNG KÊ NHẬP XUẤT TỒN KHO';

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

                    $str .= '
                            <tr>
                                <td align="center">
                                    
                                </td>
                                <td align="left">
                                    '.$item['mavattu'].'
                                </td>

                                <td align="left">
                                    '.$item['name_vn'].'
                                </td>
                                
                                <td align="left">
                                    '.$item['donvitinh'].'
                                </td>

                                <td align="right">
                                    '.number_format($sLTonDauKy,2,".",",").'
                                </td>

                                <td align="right">
                                    '.number_format($soLuongNhap,2,".",",").'
                                </td>

                                <td align="right">
                                    '.number_format($soLuongXuat,2,".",",").'
                                </td>

                                <td align="right">
                                    '.number_format($sLTonCuoiKy,2,".",",").'
                                </td>
                                
                            </tr>
                        ';
                }
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
                                    <div class="DatedPrint DatedPhieuchi"> Từ Ngày '.$showTuNgay.' -  Đến Ngày '.$showDenNgay.'</div>
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
                                    <strong>Hình</strong>
                                </td>
                                
                                <td height="25"align="center" class="brbottom brleft">
                                    <strong>Mã Vật Tư</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Tên Vật Tư</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Đơn Vị Tính</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Số Lượng Tồn Kho Đầu Kỳ</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Số Lượng Nhập Trong Kỳ</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Số Lượng Xuất Trong Kỳ</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Số Lượng Tồn Kho Cuối Kỳ</strong>
                                </td>
                            </tr>
                            '.$str.' 
                        </table>
                    </td>
                </tr>
            </table>
        ';

    break;

    case "ThongKeNhapKho":

        // Lấy tên kho dựa vào typephongban
        $sqlphongban = "select * from $GLOBALS[db_sp].categories where id=".$typephongban;
        $rsphongban= $GLOBALS['sp']->getRow($sqlphongban);
        $namephongban = $rsphongban['name_vn'];
        $tablect = $rsphongban['tablect'];

        $tieude = $namephongban.' THỐNG KÊ NHẬP KHO';

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

        foreach($rs as $item){

            if($item['typephongbanchuyen'] > 0) {
                // Lấy tên phòng ban chuyển phiếu nhập kho đến dựa theo typephongbanchuyen
                $sqlnamephongban = "select name_vn from $GLOBALS[db_sp].categories where id=".$item['typephongbanchuyen'];
                $namephongbanchuyen = $GLOBALS['sp']->getOne($sqlnamephongban);
            }

            $str .= '
                    <tr>
                        <td align="center">
                            '.$i.'
                        </td>
                        <td align="left">
                            '.$item['maphieu'].'
                        </td>

                        <td align="left">
                            '.date("d/m/Y", strtotime($item['datedhachtoan'])).'
                        </td>
                        
                        <td align="left">
                            '.$namephongbanchuyen.'
                        </td>

                        <td align="left">
                            '.$item['mavattu'].'
                        </td>

                        <td align="left">
                            '.$item['name_vn'].'
                        </td>

                        <td align="left">
                            '.$item['donvitinh'].'
                        </td>

                        <td align="right">
                            '.number_format($item['soluong'],2,".",",").'
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
                                    <div class="DatedPrint DatedPhieuchi"> Từ Ngày '.$showTuNgay.' -  Đến Ngày '.$showDenNgay.'</div>
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
                                
                                <td height="25"align="center" class="brbottom brleft">
                                    <strong>Mã Phiếu Nhập Kho</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Ngày</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Phòng Ban Chuyển</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Mã Vật Tư</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Tên Vật Tư</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Đơn Vị Tính</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Số Lượng Nhập Kho</strong>
                                </td>
                            </tr>
                            '.$str.' 
                        </table>
                    </td>
                </tr>
            </table>
        ';
    break;

    case "ThongKeXuatKho":

        // Lấy tên kho dựa vào typephongban
        $sqlphongban = "select * from $GLOBALS[db_sp].categories where id=".$typephongban;
        $rsphongban= $GLOBALS['sp']->getRow($sqlphongban);
        $namephongban = $rsphongban['name_vn'];
        $tablect = $rsphongban['tablect'];

        $tieude = $namephongban.' THỐNG KÊ XUẤT KHO';

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

        foreach($rs as $item){

            if($item['typephongbanchuyen'] > 0) {
                // Lấy tên phòng ban chuyển phiếu nhập kho đến dựa theo typephongbanchuyen
                $sqlnamephongban = "select name_vn from $GLOBALS[db_sp].categories where id=".$item['typephongbanchuyen'];
                $namephongbanchuyen = $GLOBALS['sp']->getOne($sqlnamephongban);
            }

            $str .= '
                    <tr>
                        <td align="center">
                            '.$i.'
                        </td>
                        <td align="left">
                            '.$item['maphieu'].'
                        </td>

                        <td align="left">
                            '.date("d/m/Y", strtotime($item['datedhachtoan'])).'
                        </td>
                        
                        <td align="left">
                            '.$namephongbanchuyen.'
                        </td>

                        <td align="left">
                            '.$item['mavattu'].'
                        </td>

                        <td align="left">
                            '.$item['name_vn'].'
                        </td>

                        <td align="left">
                            '.$item['donvitinh'].'
                        </td>

                        <td align="right">
                            '.number_format($item['soluong'],2,".",",").'
                        </td>

                        <td align="left">
                            '.$item['mucdichsudung'].'
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
                                    <div class="DatedPrint DatedPhieuchi"> Từ Ngày '.$showTuNgay.' -  Đến Ngày '.$showDenNgay.'</div>
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
                                
                                <td height="25"align="center" class="brbottom brleft">
                                    <strong>Mã Phiếu Xuất Kho</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Ngày</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Phòng Ban Chuyển</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Mã Vật Tư</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Tên Vật Tư</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Đơn Vị Tính</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Số Lượng Xuất Kho</strong>
                                </td>
                                <td height="25" align="center" class="brbottom brleft">
                                    <strong>Mục Đích Sử Dụng</strong>
                                </td>
                            </tr>
                            '.$str.' 
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