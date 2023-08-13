<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);
switch($act){
    default:
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url ;
            page_transfer2($page);
        }
        else{
            include_once("search/KhoNguonVaoXuatKhoVangSearch.php");
            $template = "KhoSanXuat-Kho-Kv-Nhap-Kho/list.tpl";
            $sql ="SELECT * FROM $GLOBALS[db_sp].khosanxuat_khokv WHERE cid=$idpem AND type=1 AND typechuyen=1 AND trangthai=0 AND typevkc=1 ORDER BY typechuyen ASC, datechuyen ASC, id DESC";
            $sql_sum = "SELECT COUNT(id) from $GLOBALS[db_sp].khosanxuat_khokv WHERE cid=$idpem AND type=1 AND typechuyen=1 AND trangthai=0 AND typevkc=1";
            $total = ceil($GLOBALS['sp']->getOne($sql_sum));
            $num_rows_page =  $numPageAll;
            $num_page = ceil($total/$num_rows_page);
            $begin = ($page-1)*$num_rows_page;
            $url = $path_url."/sources/KhoSanXuat-Kho-kv-Nhap-Kho.php?cid=".$_GET['cid'];
			$link_url = "";
			if($num_page > 1 )
				$link_url = paginator($num_page,$page,$iSEGSIZE,$url,$strSearch);

            $sql = $sql." LIMIT $begin,$num_rows_page";
            $rs = $GLOBALS['sp']->getAll($sql);
            if($page != 1){
                $number = $num_rows_page*($page-1);
                $smarty->assign("number",$number);
            }
            $smarty->assign("total",$num_page);
            $smarty->assign("link_url",$link_url);
            $smarty->assign("view",$rs);
            if(checkPermision($idpem,6))
				$smarty->assign("checkPer6","true");
			if(checkPermision($idpem,8))
				$smarty->assign("checkPer8","true");	
			if(checkPermision($idpem,9))
				$smarty->assign("checkPer9","true");

        }
    break;
}
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>