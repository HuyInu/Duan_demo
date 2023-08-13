<?php
include("../#include/config.php");
include("../functions/function.php");
CheckLogin();
if(!isset($_SESSION["store_qlsxntjcorg_login"])){
	die('Vui long dang nhap lai');	
}
$act = isset($_POST['act'])?$_POST['act']:"";
$error ="";
$id = ceil($_POST['id']);
$idselect = ceil($_POST['idselect']);
$sql = "SELECT * FROM $GLOBALS[db_sp].categories where pid=$id and active=1 order by num asc, id asc";
$rs = $GLOBALS["sp"]->GetAll($sql);
switch($act){
	case "searchTenNguyenLieu":
		foreach($rs as $item)
		{
			if($item['id'] == $idselect)
				$center .= '<option  value="'.$item['id'].'" selected="selected" >'.$item['name_vn'].'</option>';
			else
				$center .= '<option  value="'.$item['id'].'" >'.$item['name_vn'].'</option>';;
		}
		$list =  '<option value="">---------All---------</option>'.$center;
	break;
	
	default:
		foreach($rs as $item)
		{
			if($item['id'] == $idselect)
				$center .= '<option  value="'.$item['id'].';'.$item['name_vn'].'" selected="selected" >'.$item['name_vn'].'</option>';
			else
				$center .= '<option  value="'.$item['id'].';'.$item['name_vn'].'" >'.$item['name_vn'].'</option>';;
		}
		$list =  $center;
	break;
	
}
die(json_encode(array('status'=>$list,'nameshow'=>$nameshow)));

?>