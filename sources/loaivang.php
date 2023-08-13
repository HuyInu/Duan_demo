<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
switch($act){
	
	case "edit":
		if(!checkPermision($idpem,2)){
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			//////////////////
			$id = ceil($_GET["id"]);
			$sql = "select * from $GLOBALS[db_sp].loaivang where id=$id";
			$rs = $GLOBALS["sp"]->getRow($sql);
			$smarty->assign("edit",$rs);
			$template = "loaivang/edit.tpl";
		}
	break;
	
	case "add":
		if(!checkPermision($idpem,1)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$template = "loaivang/edit.tpl";
		}
	break;
	case "dellist":
		if(!checkPermision($idpem,3)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			////////////////Dung Transaction////////////////
			$GLOBALS["sp"]->BeginTrans();
			try{
				$id=$_POST["iddel"];
				for($i=0;$i<count($id);$i++){
					$sql="delete from $GLOBALS[db_sp].loaivang where id=".$id[$i];
					$GLOBALS["sp"]->execute($sql);
				}
				$url = $path_url."/sources/loaivang.php?cid=".$_GET['cid'];
				page_transfer2($url);
				
				$GLOBALS["sp"]->CommitTrans();
			} 
			catch (Exception $e){
				$GLOBALS["sp"]->RollbackTrans();
				die($errorTransetion);
			}
		}
	break;
	
	case "addsm":
	case "editsm":
		if(!checkPermision($idpem,2) && !checkPermision($idpem,1) ){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			Editsm();
			$url = $path_url."/sources/loaivang.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
	break;
	case "show":
		if(!checkPermision($idpem,2)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$id = $_POST["iddel"];
			for($i=0;$i<count($id);$i++){
				$sql="update $GLOBALS[db_sp].loaivang SET active=1 where id=".$id[$i];
				$GLOBALS["sp"]->execute($sql);		
			}
			$url = $path_url."/sources/loaivang.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
	break;
	case "hide":
		if(!checkPermision($idpem,2)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$id = $_POST["iddel"];
			for($i=0;$i<count($id);$i++){
				$sql="update $GLOBALS[db_sp].loaivang SET active=0 where id=".$id[$i];
				$GLOBALS["sp"]->execute($sql);		
			}
			$url = $path_url."/sources/loaivang.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
	break;
	
	case "order":
		if(!checkPermision($idpem,2)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$id = $_POST["id"];	
			$ordering=$_POST["ordering"];
			//die(print_r($_POST["ordering"]));		
			for($i=0;$i<count($id);$i++){
				$sql="update $GLOBALS[db_sp].loaivang SET num=".$ordering[$i]." where id=".$id[$i];
				$GLOBALS["sp"]->execute($sql);		
			}
			$url = $path_url."/sources/loaivang.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}	
	break;

	default:
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$sql = "select * from $GLOBALS[db_sp].loaivang order by num asc, id asc";
			$sql_sum = "select count(id) from $GLOBALS[db_sp].loaivang ";
			$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = "loaivang.php?cid=".$_GET['cid']; //set url for paginator
			$link_url = "";
			if($num_page > 1 )
				$link_url = paginator($num_page,$page,$iSEGSIZE,$url);
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
			$template = "loaivang/list.tpl";
			
			if(checkPermision($idpem,1))
				$smarty->assign("checkPer1","true");
			if(checkPermision($idpem,2))
				$smarty->assign("checkPer2","true");
			if(checkPermision($idpem,3))
				$smarty->assign("checkPer3","true");
		}
	break;
}
$smarty->assign("tabmenu",8);
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");

function Editsm()
{
	global $path_url,$path_dir,$idpem, $errorTransetion;
	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
	$arr['name_vn'] = striptags(trim($_POST["name_vn"]));
	$arr['tuoiquydinh'] = trim($_POST["tuoiquydinh"]);
	$arr['hesonho20'] = trim($_POST["hesonho20"]);
	$arr['hesolon20'] = trim($_POST["hesolon20"]);
	$arr['phatramkemthem'] = trim($_POST["phatramkemthem"]);
	$arr['num'] = $_POST["num"];	
	$arr['active'] = $_POST['active']=='active'?'1':'0';
	////////////////Dung Transaction////////////////
	$GLOBALS["sp"]->BeginTrans();
	try{
		if ($act=="addsm")
		{
			vaInsert('loaivang',$arr);
		}
		else
		{
			$id = $_POST['id'];
			vaUpdate('loaivang',$arr,' id='.$id);	
		}
		
		$GLOBALS["sp"]->CommitTrans();
	} 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		die($errorTransetion);
	}
}

?>