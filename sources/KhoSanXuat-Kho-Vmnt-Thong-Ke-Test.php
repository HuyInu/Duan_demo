<?php 
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);

$sqlvang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
$rsvang = $GLOBALS["sp"]->getAll($sqlvang);
$smarty->assign("typegold",$rsvang);

if(checkPermision($idpem,7))
	$smarty->assign("checkPer7","true");

switch($act){
    case "NhapKho":
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url ;
            page_transfer2($page);
        }
        else{
            include_once("search/KhoSanXuatThongKeSearch.php");
            $template = "KhoSanXuat-Kho-Vmnt-Thong-Ke/nhap-kho-test.tpl";	
            if(!empty($fromDate) && !empty($toDate)){
                $smarty->assign("showlist",1);
                $sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where type=1 and typechuyen=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh order by numphieu asc, dated asc";
                $sql_sum = "select count(id) from $GLOBALS[db_sp].khosanxuat_khovmnt where type=1 and typechuyen=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh";
                
                $sql_tong = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
                                    ROUND(SUM(cannangh), 3) as cannangh, 
                                    ROUND(SUM(cannangv), 3) as cannangv
                                    from $GLOBALS[db_sp].khosanxuat_khovmnt 
                                    where type=1 and typechuyen=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh
                            ";

                $rstong = $GLOBALS['sp']->getRow($sql_tong);
                $smarty->assign("gettotal",$rstong);
                
                $sql_tongloaivang = "select idloaivang, ROUND(SUM(cannangvh), 3) as cannangvh, 
                                    ROUND(SUM(cannangh), 3) as cannangh, 
                                    ROUND(SUM(cannangv), 3) as cannangv  
                                    from $GLOBALS[db_sp].khosanxuat_khovmnt 
                                    where type=1 and typechuyen=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' 
                                    $wh
                                    group by idloaivang
                                    order by idloaivang asc
                            ";

                $rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);
                $smarty->assign("totalLoaivang",$rstongloaivang);
                
                $total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
                $num_rows_page = 100;//$numPageAll;
                $num_page = ceil($total/$num_rows_page);
                $begin = ($page - 1)*$num_rows_page;
                $url = $path_url."/sources/KhoSanXuat-Kho-Vmnt-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
                $smarty->assign("viewtest",$rs);	
            }
        }
    break;
}
$smarty->assign("fromdayCheck",$fromDate);
$smarty->assign("todaycheck",$toDate);
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");

?>