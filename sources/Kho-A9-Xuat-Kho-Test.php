<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);
/////////load danh mục kho anh 9
$nhomdanhmuc = getTableRow('categories',' and id=70 and active=1');
$smarty->assign("nhomdanhmuc",$nhomdanhmuc);

$sqlvang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
$rsvang = $GLOBALS["sp"]->getAll($sqlvang);
$smarty->assign("typegold",$rsvang);


switch($act){
    default:
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url ;
            page_transfer2($page);
        }
        else{
            include_once("search/KhoNguonVaoXuatKhoVangSearch.php");
            $wh.=' and typevkc = 1 ';
            $template = "Kho-A9-Xuat-Kho/listvangtest.tpl";

            $sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and trangthai=0 $wh order by numphieu asc, id desc";
			$sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and trangthai=0 $wh";
			$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = $path_url."/sources/Kho-A9-Xuat-Kho.php?cid=".$_GET['cid'];
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
			if(checkPermision($idpem,2))
				$smarty->assign("checkPer2","true");
			if(checkPermision($idpem,3))
				$smarty->assign("checkPer3","true");
			if(checkPermision($idpem,6))
				$smarty->assign("checkPer6","true");
			if(checkPermision($idpem,7))
				$smarty->assign("checkPer7","true");
        }
    break;
}
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>