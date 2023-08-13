<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);
switch($act){
	default:
		// if(!checkPermision($idpem,5)){
		// 	page_permision();
		// 	$page = $path_url ;
		// 	page_transfer2($page);
		// }
		// else{
		// 	include_once("search/KhoNguonVaoXuatKhoVangSearch.php");
		// 	$wh.=' and typevkc = 1 ';
		// 	$template = "KhoSanXuat-Kho-Vmnt-Nhap-Kho/list.tpl"; ///////// typechuyen 1 chờ nhập, 2 xác nhận đã nhập
		// 	$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where cid=$idpem and type = 1 and typechuyen=1 and trangthai=0 $wh order by typechuyen asc, datechuyen asc, id desc";
		// 	$sql_sum = "select count(id) from $GLOBALS[db_sp].khosanxuat_khovmnt where cid=$idpem and type = 1 and typechuyen=1 and trangthai=0 $wh";
		// 	$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
		// 	$num_rows_page = $numPageAll;
		// 	$num_page = ceil($total/$num_rows_page);
		// 	$begin = ($page - 1)*$num_rows_page;
		// 	$url = $path_url."/sources/KhoSanXuat-Kho-Nguyen-Lieu-Nhap-Kho.php?cid=".$_GET['cid'];
		// 	$link_url = "";
		// 	if($num_page > 1 )
		// 		$link_url = paginator($num_page,$page,$iSEGSIZE,$url,$strSearch);
		// 	$sql = $sql." limit $begin,$num_rows_page";
		// 	$rs = $GLOBALS["sp"]->getAll($sql);
		// 	if($page!=1)
		// 	 {
		// 		$number=$num_rows_page * ($page-1);
		// 		$smarty->assign("number",$number);
		// 	 }
		// 	$smarty->assign("total",$num_page);
		// 	$smarty->assign("link_url",$link_url);	
		// 	$smarty->assign("view",$rs);
		// 	if(checkPermision($idpem,6))
		// 		$smarty->assign("checkPer6","true");
		// 	if(checkPermision($idpem,8))
		// 		$smarty->assign("checkPer8","true");	
		// 	if(checkPermision($idpem,9))
		// 		$smarty->assign("checkPer9","true");
		// }

		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			include_once("search/KhoNguonVaoXuatKhoVangSearch.php");
			$wh.=' and typevkc = 1 ';
			$template = "KhoSanXuat-Kho-Vmnt-Nhap-Kho/listtest.tpl"; ///////// typechuyen 1 chờ nhập, 2 xác nhận đã nhập
			$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where cid=$idpem and type = 1 and typechuyen=1 and trangthai=0 $wh order by typechuyen asc, datechuyen asc, id desc";
			$sql_sum = "select count(id) from $GLOBALS[db_sp].khosanxuat_khovmnt where cid=$idpem and type = 1 and typechuyen=1 and trangthai=0 $wh";
			$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = $path_url."/sources/KhoSanXuat-Kho-Nguyen-Lieu-Nhap-Kho.php?cid=".$_GET['cid'];
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