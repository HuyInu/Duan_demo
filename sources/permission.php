<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
if(!checkPer()){
	page_permision();
	$page = $path_url."/sources/main.php";
	page_transfer2($page);
}
else
{
	switch($act){
		case "editsm":
			if($_POST){
				$peroles = isset($_POST)?$_POST:"0";
				$uid = $_POST['id'];
				
				$sql = "DELETE from $GLOBALS[db_sp].permissions where uid=$uid ";
				$GLOBALS["sp"]->execute($sql);
				
				//die(print_r($peroles));
				var_dump($peroles);
				foreach($peroles as $key=>$item)
				{
					if($key != 'id' && $key != 'viewcheck' && $key != 'addcheck' && $key != 'editcheck' && $key != 'delcheck' && $key != 'chuyencheck' && $key != 'checkchuyenchochi' && $key != 'checktralai'  && $key != 'checkprint' && $key != 'allcheck' )
					{
						$perm = implode(",",$item);
						$sql = "
							INSERT INTO $GLOBALS[db_sp].permissions SET 
								 uid = $uid,
								`cid` = ".$key.", 
								`perm` = '".$perm."' 
						";
						$rs = $GLOBALS["sp"]->execute($sql);
						
					}
				}
			}
			$url = $path_url."/sources/permission.php?id=".$uid;
			page_transfer2($url);
		break;
		
		case "permissionOne":
			$sql = "select * from $GLOBALS[db_sp].categories where pid=2 and nopermission=0 order by num asc, id desc";
			$rs = $GLOBALS["sp"]->getAll($sql);
			$smarty->assign("view",$rs);
			$uid  = $_GET["id"];
			
			$sql = "select * from $GLOBALS[db_sp].admin where id=$uid";
			$rs = $GLOBALS["sp"]->getRow($sql);
			$smarty->assign("viewuser",$rs);
			$smarty->assign("uid",$uid);
			
			////////Phân quyền khác//////////////////////////////////////
			$sql_pms = "select * from $GLOBALS[db_sp].permissions where uid=$uid and cid= 2";
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
			
			$listmenu = '
				 <li class="pmslicap1">
				 	<a class="popupPms" title="Menu" href="'.$path_url.'/popup/permission.php?uid='.$uid.'&cid=2">
						<div class="col1"><span>Menu</span></div>
						<span id="showpms2"> '.$listmenu.' </span>
					</a>
				 </li>  
			 '; 			            
			$smarty->assign("viewListmenu",$listmenu);
			$template = "permission/permissionOne.tpl";
		break;
		
		default:
			$uid  = $_GET["id"];
			$sql = "select * from $GLOBALS[db_sp].admin where id=$uid";
			$rs = $GLOBALS["sp"]->getRow($sql);
			$smarty->assign("viewuser",$rs);
			
			$html = '';
			$level = "";
			$str = "";
			
			$str = dequi('1',$html,$level,$uid);
			$smarty->assign("view",$str);
			
			/*		
			////////Phân quyền khác//////////////////////////////////////
			$sql_pms = "select * from $GLOBALS[db_sp].permissions where uid=$uid and cid=-1 ";
			$rs_pms = $GLOBALS["sp"]->getRow($sql_pms);
			$listorther = $listorther1 =  $listorther2 = $listorther3 = $listorther4 = '';
			if(in_array("5",explode(',',$rs_pms['perm'])))
				$listorther .= "<td  align='center' class='brleft pa_t_b  brbottom'><input id='checkview-1' type='checkbox' checked='checked' name='-1[]' value='5' /></td>";
			else
				$listorther .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkview-1' type='checkbox'  name='-1[]' value='5' /></td>";
				
			if(in_array("1",explode(',',$rs_pms['perm'])))
				$listorther .= "<td  align='center' class='brleft pa_t_b  brbottom'><input id='checkadd-1' type='checkbox' checked='checked' name='-1[]' value='1' /></td>";
			else
				$listorther .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkadd-1' type='checkbox'  name='-1[]' value='1' /></td>";
				
			if(in_array("2",explode(',',$rs_pms['perm'])))
				$listorther .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkedit-1' type='checkbox' checked='checked' name='-1[]' value='2' /></td>";
			else
				$listorther .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkedit-1' type='checkbox'  name='-1[]' value='2' /></td>";
			
			if(in_array("3",explode(',',$rs_pms['perm'])))
				$listorther .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkdel-1' type='checkbox' checked='checked' name='-1[]' value='3' /></td>";
			else
				$listorther .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkdel-1' type='checkbox'  name='-1[]' value='3' /></td>";
				
			if(in_array("4",explode(',',$rs_pms['perm'])))
				$listorther .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkall-1' type='checkbox' checked='checked'  name='-1[]' value='4' /></td>";
			else
				$listorther .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkall-1' type='checkbox'  name='-1[]' value='4' /></td>";
			
			$listorther1 = "
				 <tr onmouseout=\"this.className='bgno'\" onmouseover=\"this.className='bgonmose'\" class='bgno'>
					<td align='left' class='pa_t_b brbottom'> <div class='PemissionName'> Thành viên </div></td>
					".$listorther."
				 </tr>  
			 ";  
			$listortherOunt =  $listorther1;           
			$smarty->assign("viewOrther",$listortherOunt);	 
			///////////////////////
			*/		
			$template = "permission/edit.tpl";
		break;
	}
	$smarty->assign("tabmenu",1);
	$smarty->display("header.tpl");
	$smarty->display($template);
	$smarty->display("footer.tpl");
}
function dequi($root,&$html,$level,$uid){
	global $db,$flash;
	$sql = "select * from $GLOBALS[db_sp].categories where  pid=".$root." order by num asc ";
	$all = $GLOBALS["sp"]->getAll($sql);
	if( ceil(count($all)) > 0){
		for($i=0;$i<count($all);$i++){
			$flash++;
			if(($flash % 2) == 0)
				$bg = "bgno";
			else
				$bg = "bgf2";				
			$class = "";
			if( ($all[$i]['has_child'] > 0) && ($level >=1))// co menu con
				$class = "class='PemissionNamec".$level."'";
			else
				$class = "class='PemissionName".$level."'";
			$list_pms = "";
			////load check da phan quyen
			
			$sql_pms = "select * from $GLOBALS[db_sp].permissions where uid=$uid  and cid=".$all[$i]['id'];
			$rs_pms = $GLOBALS["sp"]->getRow($sql_pms);
			
			if(in_array("5",explode(',',$rs_pms['perm'])))
				$list_pms .= "<td  align='center' class='brleft pa_t_b  brbottom'><input id='checkview".$flash."' type='checkbox' checked='checked' name='".$all[$i]['id']."[]' value='5' /></td>";
			else
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkview".$flash."' type='checkbox'  name='".$all[$i]['id']."[]' value='5' /></td>";
				
			if(in_array("1",explode(',',$rs_pms['perm'])))
				$list_pms .= "<td  align='center' class='brleft pa_t_b  brbottom'><input id='checkadd".$flash."' type='checkbox' checked='checked' name='".$all[$i]['id']."[]' value='1' /></td>";
			else
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkadd".$flash."' type='checkbox'  name='".$all[$i]['id']."[]' value='1' /></td>";
				
			if(in_array("2",explode(',',$rs_pms['perm'])))
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkedit".$flash."' type='checkbox' checked='checked' name='".$all[$i]['id']."[]' value='2' /></td>";
			else
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkedit".$flash."' type='checkbox'  name='".$all[$i]['id']."[]' value='2' /></td>";
			
			if(in_array("3",explode(',',$rs_pms['perm'])))
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkdel".$flash."' type='checkbox' checked='checked' name='".$all[$i]['id']."[]' value='3' /></td>";
			else
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkdel".$flash."' type='checkbox'  name='".$all[$i]['id']."[]' value='3' /></td>";
			
			if(in_array("6",explode(',',$rs_pms['perm'])))
				$list_pms .= "<td  align='center' class='brleft pa_t_b  brbottom'><input id='checkchuyen".$flash."' type='checkbox' checked='checked' name='".$all[$i]['id']."[]' value='6' /></td>";
			else
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkchuyen".$flash."' type='checkbox'  name='".$all[$i]['id']."[]' value='6' /></td>";
			
			if(in_array("8",explode(',',$rs_pms['perm'])))/// chuyển chờ chi
				$list_pms .= "<td  align='center' class='brleft pa_t_b  brbottom'><input id='checkchuyenchochi".$flash."' type='checkbox' checked='checked' name='".$all[$i]['id']."[]' value='8' /></td>";
			else
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkchuyenchochi".$flash."' type='checkbox'  name='".$all[$i]['id']."[]' value='8' /></td>";	
			
			if(in_array("9",explode(',',$rs_pms['perm'])))/// chuyển Trả lại
				$list_pms .= "<td  align='center' class='brleft pa_t_b  brbottom'><input id='checktralai".$flash."' type='checkbox' checked='checked' name='".$all[$i]['id']."[]' value='9' /></td>";
			else
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checktralai".$flash."' type='checkbox'  name='".$all[$i]['id']."[]' value='9' /></td>";	
				
			if(in_array("7",explode(',',$rs_pms['perm'])))// Print
				$list_pms .= "<td  align='center' class='brleft pa_t_b  brbottom'><input id='checkprint".$flash."' type='checkbox' checked='checked' name='".$all[$i]['id']."[]' value='7' /></td>";
			else
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkprint".$flash."' type='checkbox'  name='".$all[$i]['id']."[]' value='7' /></td>";	
			
				
			if(in_array("4",explode(',',$rs_pms['perm'])))
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkall".$flash."' type='checkbox' checked='checked'  name='".$all[$i]['id']."[]' value='4' /></td>";
			else
				$list_pms .= "<td align='center' class='brleft pa_t_b  brbottom' ><input id='checkall".$flash."' type='checkbox'  name='".$all[$i]['id']."[]' value='4' /></td>";
					
			$html .= "
				<tr class='".$bg."'  onmouseover=\"this.className='bgonmose'\" onmouseout=\"this.className='".$bg."'\">
				
					<td class='pa_t_b brbottom' align='left'> <div ".$class."> ".$all[$i]['name_vn']."</div></td>
					".$list_pms."
				 </tr>			
			";
			
			dequi($all[$i]['id'],$html,$level+1,$uid);
		}
	}
	return $html;
}
?>