<?php
/*==============phân quyền==================*/
function page_permision(){
	echo"<script type=\"text/javascript\">	
		alert('Ban khong co quyen, vui long lien he voi nguoi quan tri.');
	</script>";
	
}

function checkPer(){
	if($_SESSION['group_qlsxntjcorg_user'] == -1)
		return true;
	else
		return false;
}

function insert_checkViewPermision($a){//gia tri action ( 1 -> add, 2 -> edit , 3 -> delete , 4 -> all, 5 -> view, 6 -> chuyển)
	if($_SESSION["admin_qlsxntjcorg_id"] > 0){
		$cid = $a['cid'];
		
		$whpmsNhom = '';
		if(ceil($_SESSION["nhomqlsx_userpms_id"]) > 0)
			$whpmsNhom = " or uid = " .$_SESSION["nhomqlsx_userpms_id"]." ";
			
		$sql="select * from $GLOBALS[db_sp].permissions  where cid=$cid and perm <> '' and ( uid = " .$_SESSION["admin_qlsxntjcorg_id"].$whpmsNhom.") ";
		$showall = ceil(count($GLOBALS["sp"]->getAll($sql)));
		if( ($showall > 0) || ($_SESSION['group_qlsxntjcorg_user'] == -1))
			return 1;
		else
			return 0;
	}
}
function checkViewPermision($cid){//gia tri action ( 1 -> add, 2 -> edit , 3 -> delete , 4 -> all, 5 -> view, 6 -> chuyển)
	if($_SESSION["admin_qlsxntjcorg_id"] > 0){
		$showall = 0;
		$whpmsNhom = '';
		if(ceil($_SESSION["nhomqlsx_userpms_id"]) > 0)
			$whpmsNhom = " or uid = " .$_SESSION["nhomqlsx_userpms_id"]." ";
			$sql="select * from $GLOBALS[db_sp].permissions  where cid=$cid and perm <> '' and ( uid = " .$_SESSION["admin_qlsxntjcorg_id"].$whpmsNhom.") ";
		$showall = ceil(count($GLOBALS["sp"]->getAll($sql)));
		if( ($showall > 0) || ($_SESSION['group_qlsxntjcorg_user'] == -1))
			return 1;
		else
			return 0;
	}
	
}
function checkPermision($cid, $act){//gia tri action ( 1 -> add, 2 -> edit , 3 -> delete , 4 -> all, 5 -> view, 6 -> chuyển)
	if(empty($cid) && empty($act)){
		$showall = 0;		
	}
	else{
		$showall = 0;
		$whpmsNhom = '';
		if(ceil($_SESSION["nhomqlsx_userpms_id"]) > 0)
			$whpmsNhom = " or uid = " .$_SESSION["nhomqlsx_userpms_id"]." ";
		if($cid)
			$sql="select * from $GLOBALS[db_sp].permissions  where ((perm =".$act.") or (perm like '%,".$act.",%') or (perm like '%,".$act."') or (perm like '".$act.",%') or (perm like '%4%')) and cid=$cid and ( uid = " .$_SESSION["admin_qlsxntjcorg_id"].$whpmsNhom.") ";
		else
			$sql="select * from $GLOBALS[db_sp].permissions  where ((perm like '%".$act."%') or (perm like '%4%'))  and ( uid = " .$_SESSION["admin_qlsxntjcorg_id"].$whpmsNhom.") ";
	
		$showall = ceil(count($GLOBALS["sp"]->getAll($sql)));
	}
	if( ($showall > 0) || ($_SESSION['group_qlsxntjcorg_user'] == -1))
		return true;
	else
		return false;
}

function insert_getPmscheck($a){
	$uid = $a['uid'];
	$cid = $a['cid'];
	$has_child = $a['has_child'];
	$name_vn = $a['name_vn'];
	$listmenu = getCheckPms($uid,$cid,$name_vn,'class="pmslicap1"',$has_child,0);
	
	 return $listmenu;
}
//// Popup Permission ///
function insert_getSubcategory($a){
	$loaicha = $a['id'];
	$uid = $a['uid'];
	$sql = "select id, name_vn, has_child from $GLOBALS[db_sp].categories where  pid= ".$loaicha." and nopermission=0 order by num asc ";
	$rs = $GLOBALS["sp"]->getAll($sql);
	$has_child = ceil($a['has_child']);
	echo '<ul class="pmscap2">';
	$i=3;
	foreach($rs as $item){
		echo getCheckPms($uid,$item['id'],$item['name_vn'],'class="pmslicap2"');
		if($item['has_child'] ==1 ){
			getSubcategory($item['id'],$i,$uid,$has_child, 0);
		}
		echo '</li>';
	} 
	echo '</ul>';
}

function getSubcategory($loaicha,$i,$uid){
	$sql = "select id, name_vn, has_child from $GLOBALS[db_sp].categories where  pid= ".$loaicha." order by num asc ";
	$rs = $GLOBALS["sp"]->getAll($sql);  
	$i++;
	echo '<ul class="pmschild'.$i.'" style="display: none;">';
	foreach($rs as $item){
		// echo($item['has_child']);
		echo getCheckPms($uid,$item['id'],$item['name_vn'],'', $item['has_child'], $i);
		// if($item['has_child'] ==1 ){
		// 	getSubcategory($item['id'],$i,$uid);
		// }
		echo '</li>';
	} 
	echo '</ul>';
}
//// Popup Permission Parent ///
function getSubcategoryParent($pid,$i,$uid){
	$sql = "select id, name_vn, has_child from $GLOBALS[db_sp].categories where pid=".$pid." order by num asc ";
	$rs = $GLOBALS["sp"]->getAll($sql);	
	$listmenu .= '<ul class="pmschild'.$i.'" >';
	$i++;
	foreach($rs as $item){
		$listmenu .= getCheckPmsParent($uid,$item['id'],$item['name_vn'],'',$item['has_child'], $i).'</li>';	
		// if($item['has_child'] ==1 ){
			// $listmenu .= getSubcategoryParent($item['id'],$i,$uid);
		// }
		//$listmenu .= '</li>';
	}	
	$listmenu .= '</ul>';
	return $listmenu;
}
function getCheckPmsParent($uid, $cid, $name_vn, $class, $has_child, $i = 0){
	$sql_pms = "select perm from $GLOBALS[db_sp].permissions where uid=$uid and cid=".$cid;
	$rs_pms = $GLOBALS["sp"]->getOne($sql_pms);
	$listmenu = '';
	$arr_pms = explode(',',$rs_pms);
	$arr_type = array(5,1,2,3,6,8,9,7,10,11,12,13,4);
	
	
	foreach ( $arr_type as $type ){
		$checked = '';
		if ( in_array($type,$arr_pms) )
			$checked = 'checked="checked"';
		$listmenu .= '<div class="col2"><input name="pmsion" class="pms_'.$type.'" value="'.$type.'" '.$checked.' type="checkbox"></div>';
	}
	
	$i = $i != 0 ? $i : 1;
		
	$stockmargin = 3;
	$entailsmargin = 10;
	if ($i >= 1){
		$entailsmargin = ($entailsmargin * ($i - 1)) + $stockmargin;
	}
	$buttonstyle = 'style="margin-left: '.$entailsmargin.'px;"';
	$exten_button = '';
	if ($has_child == 1){
		$exten_button = '<span class="extend-menu closed-menu" onclick="clickShowPermParent(this);" '.$buttonstyle.'></span>';
	}
	$listmenu = '
		<li '.$class.' id='.$cid.' data-uid='.$uid.' data-i='.$i.'>
			'.$exten_button.'
		 	<div id='.$cid.' class="row">
				<div class="col1"><span>'.$name_vn.'</span></div>
				<span id="showpms'.$cid.'"> '.$listmenu.' </span>
			</div>	
	 ';
	 return $listmenu;
}
//// End popup Permission Parent  ///
function getCheckPms($uid, $cid, $name_vn, $class, $has_child, $i = 0){
	global $path_url;
	$sql_pms = "select * from $GLOBALS[db_sp].permissions where uid=$uid and cid=".$cid;
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
		
	if(in_array("8",explode(',',$rs_pms['perm']))) // Duyệt
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
		
	if(in_array("10",explode(',',$rs_pms['perm']))) // Import
		$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
	else
		$listmenu .= '<div class="col2"><input type="checkbox"></div>';	
		
	if(in_array("11",explode(',',$rs_pms['perm']))) // TKT Tài sản
		$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
	else
		$listmenu .= '<div class="col2"><input type="checkbox"></div>';	
	
	if(in_array("12",explode(',',$rs_pms['perm']))) // TKT Tài sản
		$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
	else
		$listmenu .= '<div class="col2"><input type="checkbox"></div>';
	
	if(in_array("13",explode(',',$rs_pms['perm']))) // Sửa All User Up
		$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
	else
		$listmenu .= '<div class="col2"><input type="checkbox"></div>';
			
	if(in_array("4",explode(',',$rs_pms['perm'])))
		$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
	else
		$listmenu .= '<div class="col2"><input type="checkbox"></div>';

	$i = $i != 0 ? $i : 1;

	$stockmargin = 13;
	$entailsmargin = 10;
	if ($i >= 1){
		$entailsmargin = ($entailsmargin * ($i - 1)) + $stockmargin;
	}
	$buttonstyle = 'style="margin-left: '.$entailsmargin.'px;"';
	$exten_button = '';
	if ($has_child == 1){
		$exten_button = '<span class="extend-menu closed-menu" onclick="clickShowPerm(this);" '.$buttonstyle.'></span>';
	}

	$listmenu = '
		<li '.$class.' id='.$cid.' data-uid='.$uid.' data-i='.$i.'>
			'.$exten_button.'
		 	<a class="popupPms" title="'.$name_vn.'" href="'.$path_url.'/popup/permissionParent.php?uid='.$uid.'&cid='.$cid.'">
				<div class="col1"><span>'.$name_vn.'</span></div>
			</a>
			<a class="popupPms" title="'.$name_vn.'" href="'.$path_url.'/popup/permission.php?uid='.$uid.'&cid='.$cid.'">
				<span id="showpms'.$cid.'"> '.$listmenu.' </span>
			</a>
	';
	return $listmenu;
}

function insert_getViewPms($a){
	$uid = $a['uid'];
	$arrStrrev = $arrJoin = array();
	$countRow = 0;
	$result = '<div class="viewPms" id="viewPms'.$uid.'">';
	$sql = "select cid from $GLOBALS[db_sp].permissions where uid=".$uid." and ((perm = 5) or (perm like '%,5,%') or (perm like '%,5') or (perm like '5,%') or (perm like '%4%'))";
	$rs = $GLOBALS['sp']->getAll($sql);
	foreach($rs as $item){
		$sqlCat = "select pid, name_vn from $GLOBALS[db_sp].categories where id=".$item['cid']." and has_child = 0";
		$rsCat = $GLOBALS['sp']->getAll($sqlCat);
		foreach($rsCat as $itemCat){
			$string = $itemCat['name_vn'].getViewPms($itemCat['pid'],$itemCat['name_vn']);
			$arrStrrev = array_map('strrev', explode(' - ', strrev($string)));
			$arrJoin[] = implode(' <strong style="color:red">&rarr;</strong> ',$arrStrrev);
			$countRow++;
		}
	}
	array_multisort($arrJoin);
	foreach($arrJoin as $value){
		$result .= '<span style="font-weight: bold;">&#8889;</span> '.$value.'<br>';
	}
	$result .= '</div>';
	if($countRow > 6){
		$result .= '<div class="btnPms" onclick="getMorePms('.$uid.')" id="btnPms'.$uid.'">Xem thêm</div>';
	}
	return $result;
}

function getViewPms($pid,$name_vn){
	$view = $temp = '';
	if($pid){
		$sql = "select pid, name_vn from $GLOBALS[db_sp].categories where id=".$pid;
		$rs = $GLOBALS['sp']->getRow($sql);
		if($rs['pid'] != 2){
			$temp = getViewPms($rs['pid'],$rs['name_vn']);
		}
		$view .= ' - '.$rs['name_vn'].$temp;
	}
	return $view;
}
/*==============End phân quyền==================*/
?>