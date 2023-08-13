<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
if($act=='changes'){
	if($_POST){
		$pw = md5(md5(md5($_POST['password'])));
		$sql = "UPDATE $GLOBALS[db_sp].admin  SET 
				password = '$pw'
				where id = ".$_SESSION['admin_qlsxntjcorg_id']."
		";
		$GLOBALS["sp"]->execute($sql);
		//$url = $path_url."/categories/menu-cid-2.html";
		$url = "main.php";
		page_transfer2($url);
	}
	$template = "users/changes.tpl";
}
else{
	if(!checkPer()){
		page_permision();
		$url = "main.php";
		page_transfer2($page);
	}
	else
	{
		switch($act){
			case "edit":
				
				$id  = $_GET["id"];
				$sql = "select * from $GLOBALS[db_sp].admin where id=$id";
				$rs = $GLOBALS["sp"]->getRow($sql);
				
				$smarty->assign("edit",$rs);	
				$template = "users/edit.tpl";
			break;
		
			case "add":
				$template = "users/edit.tpl";
			
			break;
		
			case "dellist":
				
				$id=$_POST["iddel"];
				for($i=0;$i<count($id);$i++){
					$sql="delete from $GLOBALS[db_sp].admin  where id=".$id[$i];
					$GLOBALS["sp"]->execute($sql);
				}
				$url = "users.php";
				page_transfer2($url);
			break;
		
			case "addsm":
			case "editsm":
				Editsm();
				$url = "users.php";
				page_transfer2($url);
			break;
		
			default:
				$sql = "select * from $GLOBALS[db_sp].admin where `group` <> '-1' order by id desc";
				$sql_sum = "select count(id) from $GLOBALS[db_sp].admin where `group` <> '-1'";
				$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
				$num_rows_page = $numPageAll;
				$num_page = ceil($total/$num_rows_page);
				$begin = ($page - 1)*$num_rows_page;
			
				$url = $path_url."/sources/users.php?wanid=1";
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

				$smarty->assign("view",$rs);
				
				$template = "users/list.tpl";
			break;
		}
	}
}
$smarty->assign("tabmenu",1);
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
function Editsm()
{
	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
	$arr['fullname'] = trim($_POST["fullname"]);
	$arr['username']= trim($_POST["username"]);
	if(!empty($_POST["password"])){
		$arr['password']= md5(md5(md5($_POST["password"])));
	}
	
	$arr['email'] = trim($_POST["email"]);
	$arr['address'] = trim($_POST["address"]);
	$arr['checkchon'] = $_POST['checkchon']=='checkchon'?'1':'0';
	$arr['group']=1;
	if ($act=="addsm")
	{
		$new_id = vaInsert('admin',$arr);
	}
	else
	{
		$id = ceil(trim($_POST['id']));
		vaUpdate('admin',$arr,' id='.$id);
	}
	
}
?>