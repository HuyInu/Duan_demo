<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);

$sqlvang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
$rsvang = $GLOBALS["sp"]->getAll($sqlvang);
$smarty->assign("typegold",$rsvang);

switch($act) {
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
        if($_COOKIE["typeVangKimCuong"] == 'kimcuong'){
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
        if($_COOKIE["typeVangKimCuong"] == 'kimcuong'){
        } else {
            include_once("search/KhoNguonVaoThongKeNhapVangSearch.php");
            $template = 'Kho-A9-Huy-Thong-Ke/nhap-kho-vang.tpl';

            if(!empty($fromDate) && !empty($toDate)){
                $smarty->assign("showlist",1);	
                $sql_sum = "select ROUND(SUM(cannangvh),3) as cannangvh, ROUND(SUM(cannangh),3) as cannangh, ROUND(SUM(cannangv),3) as cannangv, ROUND(SUM(hao),3) as hao, ROUND(SUM(du),3) as du from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai = 2 and typevkc = 1 and dated >= '$fromDate' and dated <= '$toDate'";
                $sum = $GLOBALS['sp']->getRow($sql_sum);

                $sql_sumLoaiVang = "select idloaivang,ROUND(SUM(cannangvh),3) as cannangvh, ROUND(SUM(cannangh),3) as cannangh, ROUND(SUM(cannangv),3) as cannangv, ROUND(SUM(hao),3) as hao, ROUND(SUM(du),3) as du from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai = 2 and typevkc = 1 and dated >= '$fromDate' and dated <= '$toDate' group by idloaivang order by idloaivang asc";
                $sumLoaiVang = $GLOBALS['sp']->getAll($sql_sumLoaiVang);

                $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai=2 and typevkc=1 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh order by numphieu asc, dated asc";

                $sql_count = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai=2 and typevkc = 1 and dated >= '".$fromDate."' and dated <= '".$toDate."'";

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
    default:
        $sqlLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1 order by num asc, id desc";
        $loaiVang = $smarty->assign("typegoldview",$sqlLoaiVang);	

      
        $template = 'Kho-A9-Huy-Thong-Ke/tonvang.tpl';
    break;
}

$smarty->assign("fromdayCheck",$fromDate);
$smarty->assign("todaycheck",$toDate);
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>