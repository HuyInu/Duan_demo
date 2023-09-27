<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';
$smarty->assign("phongbanchuyen",$idpem);

switch($act) {
    case 'NhapKho':
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url."/sources/main.php";
            page_transfer2($page);
        } else {
            include_once("search/Kho-Nu-Trang-Tra-Ve-Search.php");
            if (!empty($fromDate) && !empty($toDate)) {
                $sqlTong = "select sum(slmon) as tongallslmon,
                sum(Round(cannangvh, 3)) as tongallcannangvh,
                sum(Round(cannangh, 3)) as tongallcannangh,
                sum(Round(cannangv, 3)) as tongallcannangv,
                sum(tienh) as tongalltienh,
                sum(tiencong) as tongalltiencong,
                sum(tiendangoctrai) as tongalltiendangoctrai from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where type = 1 and datednhap >= '$fromDate' and datednhap <= '$toDate'";
                $tongAll = $GLOBALS['sp']->getRow($sqlTong);
                $smarty->assign("tongAll",$tongAll);
                
                $sql = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where type = 1 and datednhap >= '$fromDate' and datednhap <= '$toDate'";
                $sql_sum = "select count(*) from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where type = 1 and datednhap >= '$fromDate' and datednhap <= '$toDate'";
                $total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
                $num_rows_page = $numPageAll;
                $num_page = ceil($total/$num_rows_page);
                $begin = ($page - 1)*$num_rows_page;
                $url = $path_url."/sources/Kho-Nu-Trang-Tra-Ve-Thong-Ke.php?act=$act&cid=".$idpem;
                $link_url = "";

                if($num_page > 1 ) {
                    $link_url = paginator($num_page,$page,$iSEGSIZE,$url,$strSearch);
                }
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
            
            $template = "Kho-Nu-Trang-Tra-Ve-Thong-Ke/nhap-kho.tpl";
        }
        break;
    case 'XuatKho':
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url."/sources/main.php";
            page_transfer2($page);
        } else {

            $template = "Kho-Nu-Trang-Tra-Ve-Thong-Ke/xuat-kho.tpl";
        }
        break;
    default:
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url."/sources/main.php";
            page_transfer2($page);
        } else {
            $template = "Kho-Nu-Trang-Tra-Ve-Thong-Ke/ton-kho.tpl";
        }
        break;
}
$smarty->assign("fromdayCheck",$fromDate);
$smarty->assign("todaycheck",$toDate);
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>