<?php
include_once("../maininclude.php");

$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";

switch($act){
    case "add":
		if(!checkPermision($_GET["cid"],1)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			//load component
			$sql = "select * from $GLOBALS[db_sp].component where active=1 order by id asc";
			$comps = $GLOBALS["sp"]->getAll($sql);
			$smarty->assign("comps",$comps);
			$smarty->assign("title",'Thêm');
			$template = "giahuy/edit.tpl";
		}
	break;
	case "addsm":
		if(!checkPermision($_GET["cid"],1)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			Editsm();
			$url = $path_url."/sources/thuchanh.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
	break;
	case "editsm":
		if(!checkPermision($_GET["cid"],2)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			Editsm();
			$url = $path_url."/sources/thuchanh.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
		break;
	case "edit":	
		//load component
		if(!checkPermision($_GET["cid"],2)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{	
			$sql = "select * from $GLOBALS[db_sp].component where active=1 order by id asc";
			$comps = $GLOBALS["sp"]->getAll($sql);
			$smarty->assign("comps",$comps);
			$id  = $_GET["id"];
			$sql = "select * from $GLOBALS[db_sp].categories where id=$id";
			$rs = $GLOBALS["sp"]->getRow($sql);
			
			$smarty->assign("edit",$rs);
			$smarty->assign("title",'Sửa');
			$template = "giahuy/edit.tpl";
		}
	break;
	case "dellist":
		if(!checkPermision($_GET["cid"],3)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			
			$id=$_POST["iddel"];		
			for($i=0;$i<count($id);$i++){
				DeleteCat($id[$i]);
			}
			$url = $path_url."/sources/thuchanh.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
	break;
	case "show":
		if(!checkPermision($_GET["cid"],2)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$id = $_POST["iddel"];
			for($i=0;$i<count($id);$i++){
				$sql="update $GLOBALS[db_sp].categories SET active=1 where id=".$id[$i];
				$GLOBALS["sp"]->execute($sql);		
			}
			$url = $path_url."/sources/thuchanh.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
	break;
	case "hide":
		if(!checkPermision($_GET["cid"],2)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$id = $_POST["iddel"];
			for($i=0;$i<count($id);$i++){
				$sql="update $GLOBALS[db_sp].categories SET active=0 where id=".$id[$i];
				$GLOBALS["sp"]->execute($sql);		
			}
			$url = $path_url."/sources/thuchanh.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
	break;
    default:
		if(!checkPermision($_GET["cid"],5)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			if($_GET["cid"] == 2 || $_GET["cid"] == 1828)
			{
				$pidWhereSQL = 'pid in (2,1828)';
			}
			else{
				$pidWhereSQL = 'pid = '.$_GET["cid"];
			}
			$sql = "select * from $GLOBALS[db_sp].categories where ".$pidWhereSQL."  order by num asc, id desc ";
			$sql_sum = "select count(id) from $GLOBALS[db_sp].categories where ".$pidWhereSQL." order by num asc, id desc";
			$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = "categories.php?cid=".$_GET['cid']; //set url for paginator
			$iSEGSIZE=20;
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
		}
		$smarty->assign("view",$rs);
		$template = 'giahuy/list.tpl';
		/////check Perm
		if( $_SESSION['admin_qlsxntjcorg_id'] == 2){
			if(checkPermision($_GET["cid"],1))
				$smarty->assign("checkPer1","true");	
			if(checkPermision($_GET["cid"],2))
				$smarty->assign("checkPer2","true");
			if(checkPermision($_GET["cid"],3))
				$smarty->assign("checkPer3","true");
		}
		///////////////////////////
	break;
}

$smarty->display($template);

function Editsm()
{
	global $path_url,$path_dir, $errorTransetion;
	$arr = array();
	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
	$arr['name_vn'] = trim($_POST["name_vn"]);
	if($_POST["num"] != ''){
		$arr['num'] = $_POST["num"];
	}
	else{
		$arr['num'] = 0;
	}

	$arr['nopermission'] = $_POST['nopermission']=='nopermission'?'1':'0';	
	$arr['has_child'] = $_POST['has_child']=='has_child'?'1':'0';	
	$arr['active'] = $_POST['active']=='active'?'1':'0';	
	$arr['comp'] = ceil($_POST['comp']);

	$typephongban = ceil(trim($_POST['typephongban']));
	$typegiaonhan = trim($_POST['typegiaonhan']);
	// if ($typephongban > 0){
		$arr['typephongban'] = $typephongban ;
	// }
	if ($typegiaonhan != ""){
		$arr['typegiaonhan'] = $typegiaonhan;
	}
	else{
		$arr['typegiaonhan'] = 0;
	}
	// if (trim($_POST["maphongban"]) != ""){
		$arr['maphongban'] = trim($_POST["maphongban"]);
	// }

	$table = isset($_POST['table'])?$_POST['table']:"";
	$tablect = isset($_POST['tablect'])?$_POST['tablect']:"";
	$tablehachtoan = isset($_POST['tablehachtoan'])?$_POST['tablehachtoan']:"";
	
	
		
	if(!empty($table)){
		$arr['table'] = trim($table);	
	}
	if(!empty($tablect)){
		$arr['tablect'] = trim($tablect);	
		$sqlkt = "select table_name from information_schema.tables where table_name = '".$tablect."'";
		$rskt = $GLOBALS['sp']->getOne($sqlkt);
	}
	if(!empty($tablehachtoan)){
		$arr['tablehachtoan'] = trim($tablehachtoan);	
	}
	
	////////////////Dung Transaction////////////////
	$GLOBALS["sp"]->BeginTrans();
	try{
		if ($act=="addsm")
		{
			$arr['pid'] = $_GET['cid'];
			vaInsert('categories',$arr);
		}
		else
		{		
			$id = $_POST['id'];	
			if($r['comp']==3){
				$arr1['name_vn'] = trim($_POST["name_vn"]);
				vaUpdate('intro',$arr1,' cid='.$id);	
			}
			vaUpdate('categories',$arr,' id='.$id);				
		}
		if(!empty($rskt)){
			// sql to create table
			$sqlcreate = "CREATE TABLE ".$tablect." (
				`id` BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
				`mid` BIGINT(20) DEFAULT '0',
				`name_vn` VARCHAR(255),
				`content` LONGTEXT,
				`excel` TEXT,
				`img` TEXT,
				`pdf` TEXT,
				`active` TINYINT(1) DEFAULT '0',
				`dated` DATE 
			) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
			$GLOBALS["sp"]->execute($sqlcreate);
		}
		$GLOBALS["sp"]->CommitTrans();
	} 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		die($errorTransetion);
	}
}
function DeleteCat($id){
	////////////////Dung Transaction////////////////
	global $errorTransetion;
	$GLOBALS["sp"]->BeginTrans();
	try{
		$sql = "select id,has_child,comp from $GLOBALS[db_sp].categories where id=$id";
		$r = $GLOBALS["sp"]->getRow($sql);
		
		if($r['id']){
			if($r['has_child'] != 1){ //khong co con, xoa
				$sql = "select * from $GLOBALS[db_sp].component where id=" .  $r['comp'] ;
				$comp = $GLOBALS["sp"]->getRow($sql);
				if($comp['do'] == "" || $comp['do'] == "main.php" )
					$sql = "delete from $GLOBALS[db_sp].categories where id =" . $r['id']; 
				else{
					$sql = "delete from $GLOBALS[db_sp]." . $comp['do'] . " where " . ($comp['do']=="intro"?"id":"cid") . "=" . $r['id']; 
				}
				@$GLOBALS["sp"]->execute($sql);
			}
			else{ //co con, xoa con no
				$sql = "select id from $GLOBALS[db_sp].categories where pid=$id";
				$arr = $GLOBALS["sp"]->getAll($sql);
				if($arr){
					foreach($arr as $item){
						DeleteCat($item['id']);
					}
				}
			}
			$sql = "delete from $GLOBALS[db_sp].categories where id=".$id;
			@$GLOBALS["sp"]->execute($sql);
			$GLOBALS["sp"]->CommitTrans();
		}
	} 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		die($e->getMessage());
	}	
}
?>