<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);

$sqlvang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
$rsvang = $GLOBALS["sp"]->getAll($sqlvang);
$smarty->assign("typegold",$rsvang);

switch($act) {
    case 'SuaSoLieuHachToan':
        $rsGetLoaiVang = loaiVangSuaSoLieuHachToan();
		
		foreach ($rsGetLoaiVang as $itemLoaiVang) {
			giahuy_dieuChinhSoLieuHachToanKhoNguonVao('khonguonvao_khoachinct','khoachin_sodudauky',$itemLoaiVang['id']);
		}
		die("Điều chỉnh số liệu hạch toán thành công.");
        break;
    case 'ChiTietTon':
        $wh = null;
        include_once("search/KhoNguonVaoThongKeNhapVangSearch.php");
		$template = "Kho-A9-Huy-Thong-Ke/chi-tiet-ton-kho-vang.tpl";
        $smarty->assign("showlist",1);
        if(!empty($fromDate)){
            $wh.=' and dated >= "'.$fromDate.'"  ';
        }
        if(!empty($toDate)){
            $wh.=' and dated <= "'.$toDate.'"  ';
        }
        $wh.=' and typevkc = 1 ';
        $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai<>2 and type=2 $wh order by numphieu asc, dated asc";
        $sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai<>2 and type=2 $wh";
        
        $total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
        $num_rows_page = 100;//$numPageAll;
        $num_page = ceil($total/$num_rows_page);
        $begin = ($page - 1)*$num_rows_page;
        $url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
        $link_url = "";
        if($num_page > 1 )
            $link_url = paginator($num_page,$page,$iSEGSIZE,$url,$strSearch);
        $sql = $sql." limit $begin,$num_rows_page";
        $rs = $GLOBALS["sp"]->getAll($sql);
        if($page!=1)
        {
            $number=$num_rows_page * ($page-1);
            $smarty->assign("number",$number);
        }
        
        $smarty->assign("total",$num_page);
        $smarty->assign("link_url",$link_url);	
        $smarty->assign("view",$rs);
    break;
    case 'NhapKho':
        $smarty->assign("checkNhapXuat",1);
        if(isset($_COOKIE["typeVangKimCuong"]) == 'kimcuong'){
        } else {
            include_once("search/KhoNguonVaoThongKeNhapVangSearch.php");
            $template = 'Kho-A9-Huy-Thong-Ke/nhap-kho-vang.tpl';

            if(!empty($fromDate) && !empty($toDate)){
                $smarty->assign("showlist",1);	
                $sql_sum = "select ROUND(SUM(cannangvh),3) as cannangvh, ROUND(SUM(cannangh),3) as cannangh, ROUND(SUM(cannangv),3) as cannangv, ROUND(SUM(hao),3) as hao, ROUND(SUM(du),3) as du from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and typevkc = 1 and dated >= '$fromDate' and dated <= '$toDate'";
                $sum = $GLOBALS['sp']->getRow($sql_sum);

                $sql_sumLoaiVang = "select idloaivang,ROUND(SUM(cannangvh),3) as cannangvh, ROUND(SUM(cannangh),3) as cannangh, ROUND(SUM(cannangv),3) as cannangv, ROUND(SUM(hao),3) as hao, ROUND(SUM(du),3) as du from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and typevkc = 1 and dated >= '$fromDate' and dated <= '$toDate' group by idloaivang order by idloaivang asc";
                $sumLoaiVang = $GLOBALS['sp']->getAll($sql_sumLoaiVang);

                $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and typevkc=1 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh order by numphieu asc, dated asc";

                $sql_count = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and typevkc = 1 and dated >= '".$fromDate."' and dated <= '".$toDate."'";

                $total = $count = ceil($GLOBALS['sp']->getOne($sql_count));
                $num_rows_page = 100;//$numPageAll;
                $num_page = ceil($total/$num_rows_page);
                $begin = ($page - 1)*$num_rows_page;
                $url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
                $link_url = "";
                if($num_page > 1 )
                    $link_url = paginator($num_page,$page,$iSEGSIZE,$url,$strSearch);
                $sql = $sql." limit $begin,$num_rows_page";
                $rs = $GLOBALS["sp"]->getAll($sql);
                if($page!=1) {
                    $number=$num_rows_page * ($page-1);
                    $smarty->assign("number",$number);
                }

                $smarty->assign("gettotal",$sum);
                $smarty->assign("totalLoaivang",$sumLoaiVang);
                $smarty->assign("total",$num_page);
                $smarty->assign("link_url",$link_url);	
                $smarty->assign("view",$rs);
            }
        }
        
    break;
    case 'XuatKho':
        if(isset($_COOKIE["typeVangKimCuong"]) == 'kimcuong'){
        } else {
            include_once("search/KhoNguonVaoThongKeNhapVangSearch.php");
            $template = 'Kho-A9-Huy-Thong-Ke/nhap-kho-vang.tpl';

            if(!empty($fromDate) && !empty($toDate)){
                $smarty->assign("showlist",1);	
                $sql_sum = "select ROUND(SUM(cannangvh),3) as cannangvh, ROUND(SUM(cannangh),3) as cannangh, ROUND(SUM(cannangv),3) as cannangv, ROUND(SUM(hao),3) as hao, ROUND(SUM(du),3) as du from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai = 2 and typevkc = 1 and datedxuat >= '$fromDate' and datedxuat <= '$toDate'";
                $sum = $GLOBALS['sp']->getRow($sql_sum);

                $sql_sumLoaiVang = "select idloaivang,ROUND(SUM(cannangvh),3) as cannangvh, ROUND(SUM(cannangh),3) as cannangh, ROUND(SUM(cannangv),3) as cannangv, ROUND(SUM(hao),3) as hao, ROUND(SUM(du),3) as du from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai = 2 and typevkc = 1 and datedxuat >= '$fromDate' and datedxuat <= '$toDate' group by idloaivang order by idloaivang asc";
                $sumLoaiVang = $GLOBALS['sp']->getAll($sql_sumLoaiVang);

                $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai=2 and typevkc=1 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh order by numphieu asc, datedxuat asc";

                $sql_count = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai=2 and typevkc = 1 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."'";

                $total = $count = ceil($GLOBALS['sp']->getOne($sql_count));
                $num_rows_page = 100;//$numPageAll;
                $num_page = ceil($total/$num_rows_page);
                $begin = ($page - 1)*$num_rows_page;
                $url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
                $link_url = "";
                if($num_page > 1 )
                    $link_url = paginator($num_page,$page,$iSEGSIZE,$url,$strSearch);
                $sql = $sql." limit $begin,$num_rows_page";
                $rs = $GLOBALS["sp"]->getAll($sql);
                if($page!=1) {
                    $number=$num_rows_page * ($page-1);
                    $smarty->assign("number",$number);
                }

                $smarty->assign("gettotal",$sum);
                $smarty->assign("totalLoaivang",$sumLoaiVang);
                $smarty->assign("total",$num_page);
                $smarty->assign("link_url",$link_url);	
                $smarty->assign("view",$rs);
            }
        }
    break;
    case 'NhapXuatKho':
        
        if(isset($_COOKIE["typeVangKimCuong"]) == 'kimcuong'){

        } else {
            include_once("search/KhoNguonVaoThongKeNhapVangSearch.php");
		    $template = "Kho-A9-Huy-Thong-Ke/nhap-xuat-kho-vang.tpl";

            if(!empty($fromDate) && !empty($toDate)){
                $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where type = 2 and typevkc = 1 and dated >= '$fromDate' and dated <= '$toDate' order by numphieu asc, dated asc";

                $sql_count = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where type = 2 and typevkc = 1 and dated >= '$fromDate' and dated <= '$toDate' order by numphieu asc, dated asc";
            
                $sql_tongNhap = "select ROUND(SUM(cannangvh), 3) as cannangvh, ROUND(SUM(cannangh), 3) as cannangh, ROUND(SUM(cannangv), 3) as cannangv, ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du from $GLOBALS[db_sp].khonguonvao_khoachinct where `type`=2 
                and dated >= '".$fromDate."' 
                and dated <= '".$toDate."' and typevkc = 1";

                $sql_tongXuat = "select ROUND(SUM(cannangvh), 3) as cannangvh, ROUND(SUM(cannangh), 3) as cannangh, ROUND(SUM(cannangv), 3) as cannangv, ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du from $GLOBALS[db_sp].khonguonvao_khoachinct where `type`=2 and trangthai = 2
                and datedxuat >= '".$fromDate."' 
                and datedxuat <= '".$toDate."' and typevkc = 1";

                $tongNhap = $GLOBALS['sp']->getRow($sql_tongNhap);
                $tongXuat = $GLOBALS['sp']->getRow($sql_tongXuat);

                $smarty->assign("gettotalnhap",$tongNhap);
                $smarty->assign("gettotalxuat",$tongXuat);

                $total = $count = ceil($GLOBALS['sp']->getOne($sql_count));
                        
                $num_rows_page = 100;//$numPageAll;
                $num_page = ceil($total/$num_rows_page);
                $begin = ($page - 1)*$num_rows_page;
                $url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
                $link_url = "";
                if($num_page > 1 )
                    $link_url = paginator($num_page,$page,$iSEGSIZE,$url,$strSearch);
                $sql = $sql." limit $begin,$num_rows_page";
                $rs = $GLOBALS["sp"]->getAll($sql);
                if($page!=1)
                    {
                    $number=$num_rows_page * ($page-1);
                    $smarty->assign("number",$number);
                    }
                $smarty->assign("total",$num_page);
                $smarty->assign("link_url",$link_url);	
                $smarty->assign("view",$rs);
            }
        }
    break;
    case 'ChoNhapKho':
        if(isset($_COOKIE["typeVangKimCuong"]) == 'kimcuong'){
        } else {
            include_once("search/KhoNguonVaoThongKeNhapVangSearch.php");
			$template = "Kho-A9-Huy-Thong-Ke/cho-nhap-kho-vang.tpl";
            if(!empty($fromDate) && !empty($toDate)){
                $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where typevkc=1 and trangthai=1 and datechuyen>='$fromDate' and datechuyen<='$toDate'";
                $sql_count = "select count(*) from $GLOBALS[db_sp].khonguonvao_khoachinct where typevkc=1 and trangthai=1 and datechuyen>='$fromDate' and datechuyen<='$toDate'";
            
                $total = ceil($GLOBALS['sp']->getOne($sql_count));					
                $num_rows_page = $numPageAll;
                $num_page = ceil($total/$num_rows_page);
                $begin = ($page - 1)*$num_rows_page;
                $url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
                $link_url = "";
                if($num_page > 1 )
                    $link_url = paginator($num_page,$page,$iSEGSIZE,$url,$strSearch);
                $sql = $sql." limit $begin,$num_rows_page";
                $rs = $GLOBALS["sp"]->getAll($sql);
                if($page!=1)
                    {
                    $number=$num_rows_page * ($page-1);
                    $smarty->assign("number",$number);
                    }
                $smarty->assign("total",$num_page);
                $smarty->assign("link_url",$link_url);	
                $smarty->assign("view",$rs);
            }
        }
    break;
    default:
    if( isset($_COOKIE["typeVangKimCuong"])  == 'kimcuong'){
        $slTonFromDate = 0;
        $tongDonGiaFromDate = 0;

        include_once("search/KhoNguonVaoTonKho.php");
        $smarty->assign("showlist",1);
        $dateThangTruoc = strtotime(date("Y-m-d", strtotime($fromDateDauthang).' -1 month'));
        $dateThangTruoc = date('Y-m-d', $dateThangTruoc);
        
        $sqlSlThangTruoc = "select * from $GLOBALS[db_sp].khoachin_sodudauky where typevkc = 2 and dated <= '$dateThangTruoc'";
        $slThangTruoc = $GLOBALS["sp"]->getAll($sqlSlThangTruoc);

        $slTonThangTruoc = $slThangTruoc['sltonkimcuong'];
        $tongDonGiaThangTruoc = $slThangTruoc['tongdongia'];

        if($fromDateDauthang != $fromDate) {
            $sqlNhapFromDate = "select count(id) as soluongnhap, ROUND(SUM(dongiaban),3) as dongiaban from $GLOBALS[db_sp].khonguonvao_khoachinct where typevkc=2 and type=2 and dated >= '$fromDateDauthang' and dated < '$fromDate'";
            $nhapFromDate = $GLOBALS["sp"]->getAll($sqlNhapFromDate);
            
            $sqlXuatFromDate = "select count(id) as soluongxuat, ROUND(SUM(dongiaban),3) as dongiaban from $GLOBALS[db_sp].khonguonvao_khoachinct where typevkc=2 and type=2 and trangthai = 2 and datedxuat >= '$fromDateDauthang' and datedxuat < '$fromDate'";
            $xuatFromDate = $GLOBALS["sp"]->getAll($sqlXuatFromDate);

            $slTonFromDate = round((float)$nhapFromDate['soluongnhap'] - (float)$xuatFromDate['soluongxuat'], 3);
            $tongDonGiaFromDate = round((float)$nhapFromDate['dongiaban'] - (float)$xuatFromDate['dongiaban'], 3);
        }

        $sltondaungay = $slTonThangTruoc + $slTonFromDate;
        $dongiadaungay = $tongDonGiaThangTruoc + $tongDonGiaFromDate;

        $sqlSlNhapToDate = "select count(id) as soluongnhap, ROUND(SUM(dongiaban),3) as dongiaban from $GLOBALS[db_sp].khonguonvao_khoachinct where typevkc=2 and type=2 and dated >= '$fromDate' and dated <= '$toDate'";
        $nhapToDate = $GLOBALS["sp"]->getAll($sqlSlNhapToDate);
        
        $sqlSlXuatToDate = "select count(id) as soluongxuat, ROUND(SUM(dongiaban),3) as dongiaban from $GLOBALS[db_sp].khonguonvao_khoachinct where typevkc=2 and type=2 and trangthai = 2 and datedxuat >= '$fromDate' and datedxuat <= '$toDate'";
        $xuatToDate = $GLOBALS["sp"]->getAll($sqlSlXuatToDate);

        $slnhapcuoingay = $nhapToDate['soluongnhap'];
        $slxuatcuoingay = $xuatToDate['soluongnhap'];
        $dongianhapcuoingay = $nhapToDate['dongiaban'];
        $dongiaxuatcuoingay = $xuatToDate['dongiaban'];
        $slTonToDate = round((float)$nhapToDate['soluongnhap'] - (float)$xuatToDate['soluongxuat'], 3);
        $tongDonGiaToDate = round((float)$nhapToDate['dongiaban'] - (float)$xuatToDate['dongiaban'], 3);
        var_dump($slnhapcuoingay);
        $sltontong = $slTonToDate + $sltondaungay;
        $tongdongia = $tongDonGiaToDate + $dongiadaungay;

        $smarty->assign("sltondaungay",$sltondaungay);
        $smarty->assign("dongiadaungay",$dongiadaungay);
        $smarty->assign("slnhapcuoingay",$slnhapcuoingay);
        $smarty->assign("slxuatcuoingay",$slxuatcuoingay);
        $smarty->assign("dongianhapcuoingay",$dongianhapcuoingay);
        $smarty->assign("dongiaxuatcuoingay",$dongiaxuatcuoingay);
        $smarty->assign("sltontong",$sltontong);
        $smarty->assign("tongdongia",$tongdongia);


        $template = 'Kho-A9-Huy-Thong-Ke/tonkimcuong.tpl';
    } else {
        include_once("search/KhoSanXuatThongKeTonKho.php");

        $sqlLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1 order by num asc, id desc";
        $loaiVang = $GLOBALS["sp"]->getAll($sqlLoaiVang);
        $smarty->assign("typegoldview",$loaiVang);	

        $template = 'Kho-A9-Huy-Thong-Ke/tonvang.tpl';
    }
    break;
}

$smarty->assign("fromdayCheck",$fromDate);
$smarty->assign("todaycheck",$toDate);
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>