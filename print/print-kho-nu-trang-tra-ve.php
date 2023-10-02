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
@page{
	margin:0;
	padding:20px;
	size: auto;
}
</style>
</head>
<body >
<!-- onload="window.print();" -->
<?php
include_once("../#include/config.php");
include_once("../functions/function.php");
CheckLogin();
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"";
$idpem = $_GET["cid"];

include_once("../sources/search/Kho-Nu-Trang-Tra-Ve-Ct-Search.php");
$whereSort = $wh;
if (!empty($fromDate) && !empty($toDate)) {
    $whereSort .= " and datedimport >= '$fromDate' and datedimport <= '$toDate'";
}
$sqlTypeWhere = "type in (0, 1)";
switch($tab) {
    case 'insertedShow':
        $sqlTypeWhere = "type = 1";
        break;
    case 'uninsertShow':
        $sqlTypeWhere = "type = 0";
        break;
}
$sql = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where typeimport = 1 and (phongban = $idpem or phongbanchuyen = $idpem) and $sqlTypeWhere $whereSort order by datednhap desc, timenhap desc";
$phieuCt = $GLOBALS["sp"]->getAll($sql);
$htmlRow = null;
foreach ($phieuCt as $index => $phieu) {
    $styleColorRow = "";
    if (($index +1) % 2 == 0) {
        $styleColorRow = "style='background-color:#f9f9f9;'";
    }
    $htmlRow .= "<tr $styleColorRow><td align='center'>".($index + 1)." </td>
                    <td>
                        ".$phieu['maphieuimport']."
                    </td>
                    <td>
                        ".getName('admin', 'fullname', $phieu['midimport'])."
                    </td>
                    <td>
                        ".date_format($phieu['datedimport'],'%d/%m/%Y')."
                    </td>
                    <td>
                        ".$phieu['timeimport']."
                    </td>
                    <td>
                        ".$phieu['cuahang']."
                    </td>
                    <td>
                        ".$phieu['noiden']."
                    </td>
                    <td>
                        ".date_format($phieu['datedxacnhan'],'%d/%m/%Y')."
                    </td>
                    <td>
                        ".$phieu['sophieu']."
                    </td>
                    <td>
                        ".$phieu['ghichu']."
                    </td>
                    <td>
                        ".getName('loaivang', 'name_vn', $phieu['idloaivang'])."
                    </td>
                    <td>
                        ".$phieu['loainutrang']."
                    </td>
                    <td>
                        ".$phieu['manutrang']."
                    </td>
                    <td>
                        ".$phieu['macu']."
                    </td>
                    <td>
                        ".$phieu['ten']."
                    </td>
                    <td>
                        ".$phieu['slmon']."
                    </td>
                    <td>
                        ".number_format($phieu['cannangvh'],3,'.', ',')."
                    </td> 
                    <td>
                        ".number_format($phieu['cannangh'],3,'.', ',')."
                    </td>
                    <td>
                        ".number_format($phieu['cannangv'],3,'.', ',')."
                    </td>
                    <td>
                        ".number_format($phieu['tienh'])."
                    </td>
                    <td>
                        ".number_format($phieu['tiencong'])."
                    </td>
                    <td>
                        ".number_format($phieu['tiendangoctrai'])."
                    </td>
                    <td>
                        ".((int)$phieu['type'] == 0 ? 'Đang chờ nhập kho' : 'Đã nhập kho')."
                    </td>";
    // if ((int)$phieu['type'] == 1) {
    //     $htmlRow .= "<td>
    //                      ".$phieu['maphieu']."
    //                 </td>
    //                 <td>
    //                     ".getName('admin', 'fullname', $phieu['mid'])."
    //                 </td>
    //                 <td>
    //                     ".date_format($phieu['datednhap'],'%d/%m/%Y')."<br>".$phieu['timenhap']."
    //                 </td>
    //             </tr>";
    // }            
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
                                <div class="XuatkhoPrint PrintPhieuchi">NHẬP KHO</div> 
                                <div class="DatedPrint DatedPhieuchi">Ngày '.date("d").' tháng  '.date("m").'  năm  '.date("Y").'</div>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top" align="left">
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
                        <tr bgcolor="#e9e8e8"> 
                            <td style="min-width:30px">
                                <strong>STT</strong>
                            </td>
                            <td style="min-width:130px">
                                <strong>Mã phiếu import</strong>
                            </td>
                            <td style="min-width:100px">
                                <strong>NV import</strong>
                            </td>
                            <td style="min-width:85px">
                                <strong>Ngày import</strong>
                            </td>
                            <td style="min-width:70px">
                                <strong>Giờ import</strong>
                            </td>
                            <td style="min-width:84px">
                                <strong>Cửa hàng</strong>
                            </td>
                            <td style="min-width:84px">
                                <strong>Nơi đến</strong>
                            </td>
                            <td style="min-width:85px">
                                <strong>Ngày xác nhận</strong>
                            </td>
                            <td style="min-width:100px">
                                <strong>Số phiếu</strong>
                            </td>
                            <td style="min-width:179px">
                                <strong>Ghi chú</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Loại vàng</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Loại nữ trang</strong>
                            </td>
                            <td style="min-width:91px">
                                <strong>Mã nữ trang</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Mã cũ</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Tên</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Số món</strong>
                            </td>
                            <td style="min-width:68px">
                                <strong>Trọng lượng</strong>
                            </td> 
                            <td style="min-width:68px">
                                <strong>TL Hột</strong>
                            </td>
                            <td style="min-width:68px">
                                <strong>TL vàng</strong>
                            </td>
                            <td style="min-width:101px">
                                <strong>Tiền hột</strong>
                            </td>
                            <td style="min-width:101px">
                                <strong>Tiền công</strong>
                            </td>
                            <td style="min-width:101px">
                                <strong>Tiền đá/ngọc trai</strong>
                            </td>
                            <td style="min-width:133px">
                                <strong>Trạng  thái</strong>
                            </td>
                            <td style="min-width:135px">
                                <strong>Số phiếu nhập kho</strong>
                            </td>
                            <td style="min-width:122px">
                                <strong>NV duyệt nhập kho</strong>
                            </td>
                            <td style="min-width:108px">
                                <strong>Ngày/ giờ duyệt nhập kho</strong>
                            </td>
                        </tr>
                        '.$htmlRow.'
                    </table>
                </td>
            </tr>
        </table>'
?>