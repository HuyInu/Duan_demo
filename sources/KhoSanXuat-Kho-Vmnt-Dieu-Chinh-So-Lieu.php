<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);

$sqlvang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
$rsvang = $GLOBALS["sp"]->getAll($sqlvang);
$smarty->assign("typegold",$rsvang);

switch($act){
	case "edit":
		if(!checkPermision($idpem,2)){
			$page = $path_url;
			page_transfer2($page);
		}
		else{
			//////////////////
			$id = ceil($_GET["id"]);
			$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where id=$id";
			$rs = $GLOBALS["sp"]->getRow($sql);
			$smarty->assign("edit",$rs);
			
			$template = "KhoSanXuat-Kho-Vmnt-Dieu-Chinh-So-Lieu/edit.tpl";	
		}
	break;
	case "editsm":
		if(!checkPermision($_GET["cid"],2) && !checkPermision($_GET["cid"],1) ){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			Editsm();
			$url = "KhoSanXuat-Kho-Vmnt-Dieu-Chinh-So-Lieu.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
	break;
	default:
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			include_once("search/MaPhierChinhSuaSoLieuSearch.php");
			if(empty($maphieus)){
				$strSearch .= '&maphieus='.$maphieus;
				$wh.=' and typechinhsuasolieu=1';
			}
			$template = "KhoSanXuat-Kho-Vmnt-Dieu-Chinh-So-Lieu/list.tpl"; ///////// typechuyen 1 chờ nhập, 2 xác nhận đã nhập: xuất kho type 1 nhập kho type =3 đã xuất kho
			$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where typechuyen in(0,2) and type in(1,3) $wh order by typechinhsuasolieu asc, dated asc, id asc";
			$sql_sum = "select count(id) from $GLOBALS[db_sp].khosanxuat_khovmnt where typechuyen in(0,2) and type in(1,3) $wh";
			$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = $path_url."/sources/KhoSanXuat-Kho-Vmnt-Dieu-Chinh-So-Lieu.php?cid=".$_GET['cid'];
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
			if(checkPermision($idpem,1))
				$smarty->assign("checkPer1","true");
			if(checkPermision($idpem,2))
				$smarty->assign("checkPer2","true");
			if(checkPermision($idpem,3))
				$smarty->assign("checkPer3","true");	
			if(checkPermision($idpem,6))
				$smarty->assign("checkPer6","true");
			if(checkPermision($idpem,7))
				$smarty->assign("checkPer7","true");
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

function Editsm()
{
	global $path_url,$path_dir,$idpem, $errorTransetion;
	$arr = array();
	$dated =  date("Y-m-d");
	$time = date('H:i:s');

	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
	$loaivang = $arr['idloaivang'] = ceil(trim($_POST["idloaivang"]));
	
	$cannangvh = $arr['cannangvh'] =  str_replace(",", "", trim($_POST['cannangvh']));
	$cannangh = $arr['cannangh'] = str_replace(",", "", trim($_POST['cannangh']));
	$arr['cannangv'] = round(($arr['cannangvh'] - $arr['cannangh']),3);
	$arr['ghichueditvang'] = trim($_POST["ghichueditvang"]);
	$arr['ghichuvang'] = trim($_POST["ghichuvang"]);

	$datedieuchinh = explode('/', trim($_POST['datedieuchinh']));
	$arr['datedieuchinh'] = $datedieuchinh[2].'-'.$datedieuchinh[1].'-'.$datedieuchinh[0];
	
	$arr['chonphongbanin'] = ceil(trim($_POST["chonphongbanin"]));
	$arr['madhin'] = ceil(trim($_POST["madhin"]));
	
	////////////////Dung Transaction////////////////
	$GLOBALS["sp"]->BeginTrans();
	try{
		$id = ceil(trim($_POST['id']));
		////////load chi tiết vang hiện tại
		$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where id=$id";
		$rs = $GLOBALS["sp"]->getRow($sql);
		if(($loaivang != $rs['idloaivang']) || ($cannangvh != $rs['cannangvh']) || ($cannangh != $rs['cannangh']) ){
			$arr['typechinhsuasolieu'] = 1; /// có chỉnh sửa loại vàng
			$arr['cannangvhnoedit'] = $rs['cannangvh'];
			$arr['cannanghnoedit'] = $rs['cannangh'];
			$arr['cannangvnoedit'] = $rs['cannangv'];
			editHachToanVangDieuChinhSoLieu($id, $loaivang, $cannangvh, $cannangh, 'khosanxuat_khovmnt',  'khosanxuat_khovmnt_sodudauky'); ////type = 1 nhập kho else xuất kho		
		}
		vaUpdate('khosanxuat_khovmnt',$arr,' id='.$id);
		
		
		$GLOBALS["sp"]->CommitTrans();
	} 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		die($errorTransetion);
	}
}
?>