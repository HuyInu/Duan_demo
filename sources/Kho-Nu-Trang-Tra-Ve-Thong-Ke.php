<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';
$smarty->assign("phongbanchuyen",$idpem);

switch($act) {
    case 'DieuChinhHachToan':
        $GLOBALS["sp"]->BeginTrans();
        try{
            $loaivang = [0, 1];
            foreach($loaivang as $idloaivang) {
                giahuy_dieuChinhSoLieuHachToanKhoNuTrangTraVe('khonguonvao_khonutrangtravect','khonguonvao_khonutrangtrave_sodudauky',$idloaivang);
            }
            $GLOBALS["sp"]->CommitTrans();
            die("Điều chỉnh số liệu hạch toán thành công.");
        }
        catch (Exception $e){
            $GLOBALS["sp"]->RollbackTrans();
            die($e);
        }
        break;
    case 'ChiTietTon':
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url."/sources/main.php";
            page_transfer2($page);
        } else {
            include_once("search/Kho-Nu-Trang-Tra-Ve-Ct-Search.php");
            $whereSort = $wh;
            $trangthaiPhieu = '0';
            if ($_GET['tab'] == 'daxuatkho') {
                $trangthaiPhieu = '2';
            }
            $sql = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where type = 2 and trangthai = $trangthaiPhieu $whereSort $whSubSelect order by idct desc";
            $sql_sum = "select count(*) from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where type = 2 and trangthai = $trangthaiPhieu $whereSort $whSubSelect order by idct desc";
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
            if ($page!=1) {
                $number=$num_rows_page * ($page-1);
                $smarty->assign("number",$number);
            }
            if (count($rs) > 0) {
                $idPhieuNhap = [];
                $idPhieuNhapWhere = '';
                foreach($rs as $index => $item) {
                    array_push($idPhieuNhap, $item['idct']);
                }
                
                $idPhieuNhapWhere = implode(",", $idPhieuNhap);
                $sqlPhieuNhap = "select id,maphieu, mid, datednhap, timenhap, maphieuimport, midimport, datedimport, timeimport from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where id in ($idPhieuNhapWhere) order by id desc";
                $phieuNhap = $GLOBALS["sp"]->getAll($sqlPhieuNhap);
            }
            // dd($phieuNhap);
            $smarty->assign("total",$num_page);
            $smarty->assign("link_url",$link_url);
            $smarty->assign("view",$rs);
            $smarty->assign("phieuNhap",$phieuNhap);
            $smarty->assign("dbName","$GLOBALS[db_sp]");

            $template = "Kho-Nu-Trang-Tra-Ve-Thong-Ke/ton-kho-chi-tiet.tpl";
        }
        break;
    case 'NhapKho':
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url."/sources/main.php";
            page_transfer2($page);
        } else {
            include_once("search/Kho-Nu-Trang-Tra-Ve-Ct-Search.php");
            $whereSort = $wh;
            if (!empty($fromDate) && !empty($toDate)) {
                $sqlTong = "select sum(slmon) as tongallslmon,
                sum(Round(cannangvh, 3)) as tongallcannangvh,
                sum(Round(cannangh, 3)) as tongallcannangh,
                sum(Round(cannangv, 3)) as tongallcannangv,
                sum(tienh) as tongalltienh,
                sum(tiencong) as tongalltiencong,
                sum(tiendangoctrai) as tongalltiendangoctrai from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where type = 1 and datednhap >= '$fromDate' and datednhap <= '$toDate' $whereSort";
                $tongAll = $GLOBALS['sp']->getRow($sqlTong);
                $smarty->assign("tongAll",$tongAll);
                
                $sql = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where type = 1 and datednhap >= '$fromDate' and datednhap <= '$toDate' $whereSort";
                $sql_sum = "select count(*) from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where type = 1 and datednhap >= '$fromDate' and datednhap <= '$toDate' $whereSort";
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
            $wh = '';
            // $sqlvang1 = "select * from $GLOBALS[db_sp].loaivang where active=1 $wh order by num asc, id asc"; 
            // = $GLOBALS["sp"]->getAll($sqlvang1);
            $rsvang1 = [
                ['id' => 0, 'name_vn' => 'A'],
                ['id' => 1, 'name_vn' => 'B'],
            ];
            $smarty->assign("typegoldview",$rsvang1);
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