<?php
include("../#include/config.php");
include("../functions/function.php");

$error ="";
$id = trim($_POST['id']);
$username = trim(isset($_POST['username'])?$_POST['username']:""); 
$email = trim(isset($_POST['email'])?$_POST['email']:"");
$table = trim($_POST['table']);
$act = isset($_POST['act'])?$_POST['act']:"";
switch($act){
	case 'resetpmscontent':		
		/////////////// update pmscontent của admin thành rỗng
		$arrsmenu=array();
		//$arrsmenu['pmscontent'] = '';
		vaUpdate('admin',$arrsmenu,' `group`=-1');		
		$error = 'success';		
	break;
	case "permision":
		if(checkPer()){
			$cid = trim($_POST['cid']);
			$uid = trim($_POST['uid']);
			$perm = implode(',',$_POST['perm']);
			if($cid > 0 && $uid > 0){
				//$arrsmenu['pmscontent'] = '';
				vaUpdate('admin',$arrsmenu,' id='.$uid);
			
				$arr['cid'] = $cid;
				$arr['uid'] = $uid;
				$arr['perm'] = $perm;
				$sql = "select * from $GLOBALS[db_sp].permissions where uid=$uid and cid = $cid";
				$rs = $GLOBALS["sp"]->getRow($sql);
				if($rs['uid'] > 0){ // update
					vaUpdate('permissions',$arr,' uid='.$uid.' and cid='.$cid);	
				}
				else{// insert
					vaInsert('permissions',$arr);			
				}
				
				$sql_pms = "select * from $GLOBALS[db_sp].permissions where uid=$uid and cid= $cid ";
				$rs_pms = $GLOBALS["sp"]->getRow($sql_pms);
				
				$listmenu = '';
				if(in_array("5",explode(',',$rs_pms['perm'])))
					$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
				else
					$listmenu .= '<div class="col2"><input type="checkbox"></div>';
					
				if(in_array("1",explode(',',$rs_pms['perm'])))
					$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
				else
					$listmenu .= '<div class="col2"><input type="checkbox"></div>';
					
				if(in_array("2",explode(',',$rs_pms['perm'])))
					$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
				else
					$listmenu .= '<div class="col2"><input type="checkbox"></div>';
				
				if(in_array("3",explode(',',$rs_pms['perm'])))
					$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
				else
					$listmenu .= '<div class="col2"><input type="checkbox"></div>';
				
				if(in_array("6",explode(',',$rs_pms['perm']))) /// chuyển
					$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
				else
					$listmenu .= '<div class="col2"><input type="checkbox"></div>';
					
				if(in_array("8",explode(',',$rs_pms['perm']))) // chuyển chờ chi
					$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
				else
					$listmenu .= '<div class="col2"><input type="checkbox"></div>';
					
				if(in_array("9",explode(',',$rs_pms['perm']))) //chuyển Trả lại
					$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
				else
					$listmenu .= '<div class="col2"><input type="checkbox"></div>';
				
				if(in_array("7",explode(',',$rs_pms['perm']))) // Print
					$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
				else
					$listmenu .= '<div class="col2"><input type="checkbox"></div>';
					
				if(in_array("10",explode(',',$rs_pms['perm']))) // Print
					$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
				else
					$listmenu .= '<div class="col2"><input type="checkbox"></div>';	
					
				if(in_array("4",explode(',',$rs_pms['perm'])))
					$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
				else
					$listmenu .= '<div class="col2"><input type="checkbox"></div>';	
			}
			else{
				$error = 'Lỗi vui lòng nhấn ctrl + f5 làm lại hoặc liên hệ với addmin.';		
			}
		}
		else{
			$error = 'Bạn không có quyền vui liên hệ với addmin.';		
		}
	break;
	
	case "changes":
		$pwold = md5(md5(md5($_POST['pwold'])));
		$id = $_SESSION['admin_qlsxntjcorg_id'];
		$sql = "select * from $GLOBALS[db_sp].admin where password = '$pwold' and id=$id ";
		$count = ceil(count($GLOBALS["sp"]->getAll($sql)));
		if($count == 0){
			$error = "Mật khẩu cũ không tồn tại." ;
		}
		
	break;
	
	default:
		if(empty($id)){
			$sql = "SELECT * FROM $GLOBALS[db_sp].".$table." where BINARY username='$username'";
			//$sql = "SELECT * FROM $GLOBALS[db_sp].".$table." where BINARY email='$email'";
		}
		else{
			$sql = "SELECT * FROM $GLOBALS[db_sp].".$table." where BINARY username='$username' and id<>$id";
			//$sql = "SELECT * FROM $GLOBALS[db_sp].".$table." where BINARY email='$email' and id<>$id";
		}
		
		$rs = $GLOBALS["sp"]->GetAll($sql);
		//$rs_email = $GLOBALS["sp"]->GetAll($sql_email);
		if(ceil(count($rs)) > 0)
			$error .="Tên đăng nhập này đã tồn tại.";
			
		
		//if(ceil(count($rs_email)) > 0)
			//$error .=" Địa chỉ Email này đã tồn tại. ";
	break;
}
die(json_encode(array('status'=>$error, 'listmenu'=>$listmenu)));
?>