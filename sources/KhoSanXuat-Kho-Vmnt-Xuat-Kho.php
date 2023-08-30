<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);


$sqlvang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
$rsvang = $GLOBALS["sp"]->getAll($sqlvang);
$smarty->assign("typegold",$rsvang);

switch($act){
	case "dellist":
		if(!checkPermision($_GET["cid"],3)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			////////////////Dung Transaction////////////////
			$GLOBALS["sp"]->BeginTrans();
			try{
				$id=$_POST["iddel"];
				for($i=0;$i<count($id);$i++){
					////////////
					$sql="delete from $GLOBALS[db_sp].khosanxuat_khovmnt  where id=".$id[$i];
					$GLOBALS["sp"]->execute($sql);
				}
				$url = "KhoSanXuat-Kho-Vmnt-Xuat-Kho.php?cid=".$_GET['cid'];
				page_transfer2($url);
				$GLOBALS["sp"]->CommitTrans();
			} 
			catch (Exception $e){
				$GLOBALS["sp"]->RollbackTrans();
				die($errorTransetion);
			}
		}
	break;
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
			
			$template = "KhoSanXuat-Kho-Vmnt-Xuat-Kho/edit.tpl";	
		}
	break;
	case "add":
		if(!checkPermision($_GET["cid"],1)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			$rs['dated'] = date("Y-m-d");
			$sqlmpt = "select max(numphieu)+1 from $GLOBALS[db_sp].khosanxuat_khovmnt";
			$rsmpt = $GLOBALS['sp']->getone($sqlmpt);
			if($rsmpt <= 0)
				$rsmpt = 1;	
			$maso = convertMaso($rsmpt);	
			$rs['maphieu'] = 'PXSNKVMNT'.$maso;
			$smarty->assign("edit",$rs);
			$template = "KhoSanXuat-Kho-Vmnt-Xuat-Kho/edit.tpl";
		}
	break;
	case "addsm":
	case "editsm":
		if(!checkPermision($_GET["cid"],2) && !checkPermision($_GET["cid"],1) ){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			Editsm();
			$url = "KhoSanXuat-Kho-Vmnt-Xuat-Kho.php?cid=".$_GET['cid'];
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
			include_once("search/KhoNguonVaoXuatKhoVangSearch.php");
			$wh.=' and typevkc = 1 ';
			$template = "KhoSanXuat-Kho-Vmnt-Xuat-Kho/list.tpl"; ///////// typechuyen 1 chờ nhập, 2 xác nhận đã nhập
			$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where cid=$idpem and type = 2 and trangthai=0 $wh order by dated asc, id asc";
			$sql_sum = "select count(id) from $GLOBALS[db_sp].khosanxuat_khovmnt where cid=$idpem and type = 2 and trangthai=0 $wh";
			$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = $path_url."/sources/KhoSanXuat-Kho-Vmnt-Xuat-Kho.php?cid=".$_GET['cid'];
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
	$arr['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
	$arr['iddhsx'] = ceil(trim($_POST["iddhsx"]));
	$arr['idloaivang'] = ceil(trim($_POST["idloaivang"]));
	
	$arr['cannangvh'] =  str_replace(",", "", trim($_POST['cannangvh']));
	$arr['cannangh'] = str_replace(",", "", trim($_POST['cannangh']));
	$arr['cannangv'] = round(($arr['cannangvh'] - $arr['cannangh']),3);
	$arr['tuoivang'] = str_replace(",", "", trim($_POST['tuoivang']));
	
	$arr['ghichuvang'] = trim($_POST["ghichuvang"]);
	
	$arr['chonphongbanin'] = ceil(trim($_POST["chonphongbanin"]));
	$arr['madhin'] = ceil(trim($_POST["madhin"]));
	
	////////////////Dung Transaction////////////////
	$GLOBALS["sp"]->BeginTrans();
	try{
		if ($act=="addsm")
		{
			$sqlmpt = "select max(numphieu)+1 from $GLOBALS[db_sp].khosanxuat_khovmnt";
			$rsmpt = $GLOBALS['sp']->getone($sqlmpt);
			if($rsmpt <= 0)
				$rsmpt = 1;	
			$maso = convertMaso($rsmpt);
			$arr['numphieu'] = $maso;
			$arr['maphieu'] = 'PXSNKVMNT'.$maso;
			
			$arr['phongban'] = $arr['cid'] = trim(($_GET["cid"]));
			$arr['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
			$arr['dated'] = $dated;
			$arr['time'] = $time;
			$arr['type'] = 2; ////type 1.nhập; 2.xuat (Có thay đổi);
			vaInsert('khosanxuat_khovmnt',$arr);
			
		}
		else{
			$id = ceil(trim($_POST['id']));
			
			vaUpdate('khosanxuat_khovmnt',$arr,' id='.$id);		
		}
		$GLOBALS["sp"]->CommitTrans();
	} 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		die($errorTransetion);
	}
}
?>