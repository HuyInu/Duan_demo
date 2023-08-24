<?php
//include_once("pms-function.php");
function getTableCheckUpdateTonkho($idcheckdated){
	global $datednowcheck;
	$sql = "select * from $GLOBALS[db_sp].check_update_tonkho where id=".$idcheckdated." and (dated < '".$datednowcheck."' OR dated IS NULL) "; 
	$rs = $GLOBALS["sp"]->getRow($sql);
	return $rs;
}
function striptags($str){
	$str = strip_tags(trim($str));
	$str = str_replace(".js","", $str);
	$str = str_replace(".php","", $str);
	$str = str_replace(".asp","", $str);
	$str = str_replace(".aspx","", $str);
	$str = str_replace("#","", $str);
	$str = str_replace("$","", $str);
	$str = str_replace("{","", $str);
	$str = str_replace("}","", $str);
	
	if (preg_match("/DROP/i", $str)){ 
		$str = '';
	}
	if (preg_match("/select/i", $str)){ 
		$str = '';
	}
	if (preg_match("/INSERT/i", $str)){ 
		$str = '';
	}
	if (preg_match("/DELETE/i", $str)){ 
		$str = '';
	}
	if (preg_match("/UPDATE/i", $str)){ 
		$str = '';
	}
	return $str;
}
function CheckLogin(){
	global $path_url;
	if($_SESSION['store_qlsxntjcorg_login']==''){	
		echo"<script type=\"text/javascript\">	
			parent.location.href='$path_url';
		</script>";
		
	}
}
function CheckCountLogin(){
	global $db;
	$sql = "select * from $GLOBALS[db_sp].banned_ip where ip='".$_SERVER['REMOTE_ADDR']."'";
	$r = $GLOBALS["sp"]->getRow($sql);
	if($r){
		echo"<script type=\"text/javascript\">	
			document.location.href= '../index.html'
		</script>";
	}
	$timeoutseconds = 3600;
	$timestamp = time();
	$timeout = $timestamp-$timeoutseconds;
	$sql = "DELETE FROM $GLOBALS[db_sp].banned_ip WHERE timestamp<$timeout";
	$GLOBALS["sp"]->execute($sql);
	
	if(isset($_SESSION['counter_artseed_login']) && $_SESSION['counter_artseed_login']>3){
		$sql = "INSERT INTO $GLOBALS[db_sp].banned_ip(ip,timestamp) VALUES ('".$_SERVER['REMOTE_ADDR']."','$timestamp')";
		//echo $sql;
		$GLOBALS["sp"]->execute($sql);
	}
}

function replacePrice($str){
	$str = str_replace(".", "", $str);	
	return $str;
}

///////////xóa khoản trắng//////
function strSpace($str){
	$str = str_replace(";", "", $str);
	$str = str_replace(",", "", $str);
	$str = str_replace(".", "", $str);
	$str = str_replace(" ", "", $str);
	$str = str_replace("\\", "", $str);
	
	return $str;
}

function page_transfer2($url){
	echo"<script type=\"text/javascript\">	
		document.location.href= '".$url."'
	</script>";
}

function RenameFile($filename){
	$filename = str_replace("& ", "", $filename);
	$filename = str_replace(" &", "", $filename);
	$filename = str_replace("&", "", $filename);
	$filename = str_replace(",", "", $filename);
	$filename = str_replace(" - ", "-", $filename);
	$filename = str_replace(" -", "-", $filename);
	$filename = str_replace("- ", "-", $filename);
	$filename = str_replace(" ", "-", $filename);
	return $filename;
}
function CheckUploadImg($type){
	$type = strtolower($type);
	if($type!=".jpeg" && $type!=".jpg" && $type!=".bmp" && $type!=".gif")
		return false;
	else
		return true;
}
function SubStrEx($str, $length){
	if(strlen($str) <= $length)
		return $str;

	$pos = strpos($str, " " , $length-1);
	if($pos >0 )
		return substr($str, 0, $pos) . '...';
	else
		return $str;
}
/////// them sua xoa/////////

function StripSql($data){
	$str = str_replace("'", "''", $data);
	return str_replace("\''", "''", $str);
}
function vaUpdate($table, $arr, $where=""){

	global $db,$table_prefix;

	if (count($arr) <= 0)

	return false;

	$keys = array_keys($arr);

	$sql = "UPDATE $GLOBALS[db_sp].".$table." SET ";
	$sql .= "`".$keys[0]."`='".StripSql($arr[$keys[0]])."' ";

	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ", `".$keys[$i]."`='".StripSql($arr[$keys[$i]])."' ";
	}
	if ($where) $sql .= " WHERE ".$where;

	// echo $sql; die();

	$GLOBALS["sp"]->execute($sql);

	//echo mysql_error();
}

function vaInsert($table, $arr){

	if (count($arr) <= 0)	return false;

	$keys = array_keys($arr);
	$sql = "INSERT INTO $GLOBALS[db_sp].".$table." ( ";
	$sql .= "`".$keys[0]."`";
	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ",`".$keys[$i]."`";
	}

	$sql .= ") VALUES (";
	$sql .= "'".StripSql($arr[$keys[0]])."'";
	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ",'".StripSql($arr[$keys[$i]])."'";
	}
	$sql .= ");";
	// echo $sql; die();
	$GLOBALS["sp"]->execute($sql);
	$post_id = $GLOBALS["sp"]->Insert_ID();
	return $post_id;
}
function vaDelete($tbl, $where){
	global $db,$table_prefix;
	$sql = "DELETE FROM $GLOBALS[db_sp].`".$tbl."` WHERE $where";
	$GLOBALS["sp"]->execute($sql);
}

///////////////////db trong Catalog
function vaUpdateCatalog($table, $arr, $where=""){

	global $db,$table_prefix;

	if (count($arr) <= 0)

	return false;

	$keys = array_keys($arr);

	$sql = "UPDATE $GLOBALS[db_catalog].".$table." SET ";
	$sql .= "`".$keys[0]."`='".StripSql($arr[$keys[0]])."' ";

	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ", `".$keys[$i]."`='".StripSql($arr[$keys[$i]])."' ";
	}
	if ($where) $sql .= " WHERE ".$where;

	//echo $sql; die();

	$GLOBALS["catalog"]->execute($sql);

	//echo mysql_error();
}

function vaInsertCatalog($table, $arr){

	if (count($arr) <= 0)	return false;

	$keys = array_keys($arr);
	$sql = "INSERT INTO $GLOBALS[db_catalog].".$table." ( ";
	$sql .= "`".$keys[0]."`";
	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ",`".$keys[$i]."`";
	}

	$sql .= ") VALUES (";
	$sql .= "'".StripSql($arr[$keys[0]])."'";
	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ",'".StripSql($arr[$keys[$i]])."'";
	}
	$sql .= ");";

	$GLOBALS["catalog"]->execute($sql);
	$post_id = $GLOBALS["catalog"]->Insert_ID();
	return $post_id;
}
function vaDeleteCatalog($tbl, $where){
	global $db,$table_prefix;
	$sql = "DELETE FROM $GLOBALS[db_catalog].`".$tbl."` WHERE $where";
	$GLOBALS["catalog"]->execute($sql);
}
// 13/02/21 ANH VŨ THÊM DB KẾ TOÁN
function vaInsertKeToan($table, $arr){

	if (count($arr) <= 0)	return false;

	$keys = array_keys($arr);
	$sql = "INSERT INTO $GLOBALS[db_ketoan].".$table." ( ";
	$sql .= "`".$keys[0]."`";
	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ",`".$keys[$i]."`";
	}

	$sql .= ") VALUES (";
	$sql .= "'".StripSql($arr[$keys[0]])."'";
	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ",'".StripSql($arr[$keys[$i]])."'";
	}
	$sql .= ");";
	// echo $sql; die();
	$GLOBALS["ketoan"]->execute($sql);
	$post_id = $GLOBALS["ketoan"]->Insert_ID();
	return $post_id;
}
function vaUpdateKeToan($table, $arr, $where=""){

	global $db,$table_prefix;

	if (count($arr) <= 0)

	return false;

	$keys = array_keys($arr);

	$sql = "UPDATE $GLOBALS[db_ketoan].".$table." SET ";
	$sql .= "`".$keys[0]."`='".StripSql($arr[$keys[0]])."' ";

	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ", `".$keys[$i]."`='".StripSql($arr[$keys[$i]])."' ";
	}
	if ($where) $sql .= " WHERE ".$where;

	//echo $sql; die();

	$GLOBALS["ketoan"]->execute($sql);

	//echo mysql_error();
}

////////Phan trang//////
function paginator($num_page,$page,$iSEGSIZE,$url,$strSearch='') //pagination.
{
  $alink = "";
  $cur_page=$page;
  $lastpage=$num_page;
  $seg_size=$iSEGSIZE;
  $seg_num=ceil($num_page/$seg_size);
  $seg_cur=ceil($page/$seg_size);
 
  $first_page=1;
  $back_page=$page-1;
  
  //so trang tren moi phan doan
  $n=($seg_cur*$seg_size<=$lastpage)?$seg_cur*$seg_size:$lastpage;
  //in ra cac trang trong moi phan doan
  for ($p=($seg_cur-1)*$seg_size+1;$p<=$n;$p++)
  {
   $seg_page[]=$p;
  }
  
  //show/hide back 
  $next_page=$page+1;
  $last_page=$lastpage; 
  
  if ($seg_cur>1) {
   $back=$cur_page-1;
   $alink.="<a onclick='showLoading();' href='$url&page=$first_page".$strSearch."'>Đầu trang</a>";
   $alink.="<a onclick='showLoading();' href='$url&page=$back".$strSearch."'>Lùi lại</a>";
  }else{
   $alink.="<a class='disabled ActiveNextPre'>Đầu trang</a>";
   $alink.="<a class='disabled ActiveNextPre'>Lùi lại</a>";
  }
  if (count($seg_page)<=0) return;
  foreach ($seg_page as $page){
   if ($page==$cur_page) {
    $alink.="<a class='disabled active'>".$page."</a>";
   } else {
    $alink.="<a onclick='showLoading();' href='$url&page=$page".$strSearch."'>$page</a>"; 
    
   }
  }

  //show/hide next
  if ($seg_cur<$seg_num) {$next=$cur_page+1;
   $alink.="<a onclick='showLoading();' href='$url&page=$next".$strSearch."'>Tiếp theo</a>";
   $alink.="<a onclick='showLoading();' href='$url&page=$last_page".$strSearch."'>Cuối trang</a>";
  }else{
   $alink.="<a class='disabled ActiveNextPre'>Tiếp theo</span>";
   $alink.="<a class='disabled ActiveNextPre'>Cuối trang</a>";
  }
 return $alink;
}
// === Phân trang Ajax === //
function paginatorAjax($type,$num_page,$page,$iSEGSIZE,$num_rows_page,$cid) //pagination.
{
  $alink = "";
  $cur_page=$page;
  $lastpage=$num_page;
  $seg_size=$iSEGSIZE;
  $seg_num=ceil($num_page/$seg_size);
  $seg_cur=ceil($page/$seg_size);
 
  $first_page=1;
  $back_page=$page-1;
  
  //so trang tren moi phan doan
  $n=($seg_cur*$seg_size<=$lastpage)?$seg_cur*$seg_size:$lastpage;
  //in ra cac trang trong moi phan doan
  for ($p=($seg_cur-1)*$seg_size+1;$p<=$n;$p++)
  {
   $seg_page[]=$p;
  }
  
  //show/hide back 
  $next_page=$page+1;
  $last_page=$lastpage; 
  
  if ($seg_cur>1) {
   $back=$cur_page-1;
//    $alink.="<a onclick='showLoading();' href='$url&page=$first_page".$strSearch."'>Đầu trang</a>";
   $alink.="<a href='javascript:void(0)' onclick=\"viewpg('".$type."','".$num_page."','".$back."','".$iSEGSIZE."','".$num_rows_page."','".$cid."')\">Lùi lại</a>";
  }else{
//    $alink.="<a class='disabled ActiveNextPre'>Đầu trang</a>";
   $alink.="<a class='disabled ActiveNextPre'>Lùi lại</a>";
  }
  if (count($seg_page)<=0) return;
  foreach ($seg_page as $page){
   if ($page==$cur_page) {
    $alink.="<a class='disabled active'>".$page."</a>";
   } else {
    $alink.="<a href='javascript:void(0)' onclick=\"viewpg('".$type."','".$num_page."','".$page."','".$iSEGSIZE."','".$num_rows_page."','".$cid."')\">$page</a>"; 
    
   }
  }

  //show/hide next
  if ($seg_cur<$seg_num) {$next=$cur_page+1;
   $alink.="<a href='javascript:void(0)' onclick=\"viewpg('".$type."','".$num_page."','".$next."','".$iSEGSIZE."','".$num_rows_page."','".$cid."')\">Tiếp theo</a>";
//    $alink.="<a onclick='showLoading();' href='$url&page=$last_page".$strSearch."'>Cuối trang</a>";
  }else{
   $alink.="<a class='disabled ActiveNextPre'>Tiếp theo</span>";
//    $alink.="<a class='disabled ActiveNextPre'>Cuối trang</a>";
  }
 return $alink;
}

/////////Insert tpl//////////////////
function insert_GetNameComponent($a){
	$comp = $a['comp'];
	$sql = "select * from $GLOBALS[db_sp].component where id=".$comp;
	$rs = $GLOBALS["sp"]->getRow($sql);
	return $rs;
}

function GetNameComponent($comp){
	$rs='main';
	if($comp > 0){
		$sql = "select do from $GLOBALS[db_sp].component where id=".$comp;
		$rs = $GLOBALS["sp"]->getOne($sql);
	}
	return $rs;
}

function insert_HearderCatMenu($a){
	global $path_url;
	$cha = $a['cid'];
	$root = isset($a['root'])?$a['root']:2;
	$act = $a['act'];
	$list = "";
	$str = "";
	$paraString = $a['paraString'] ?? '';
	$arr = array();
	do{
		$sql = "select * from $GLOBALS[db_sp].categories where id=".$cha;
		$r = $GLOBALS["sp"]->getRow($sql);
		$arr[count($arr)] = $r;
		$cha = $r['pid'];
	}while($arr[count($arr)-1]['id'] != $root);
	$j = 0;
	for($i=(count($arr)-1);$i>=0;$i--){
		if($arr[$i]['has_child']=='1'){
			$link = "categories.php?cid=".$arr[$i]['id']."&root=".$root;
		}
		else{
			$sql = "select * from $GLOBALS[db_sp].component where id=".$arr[$i]['comp'];
			$r = $GLOBALS["sp"]->getRow($sql);
			$link = $r['do']."?act=".$r['act']."&cid=".$arr[$i]['id'].$paraString;
		}
		$numpb = '';
		if ( $arr[$i]['numphong'] > 0 ) {
			$numpb = $arr[$i]['numphong'].".";
		}
		if( $arr[$i]['pid'] == 2647 && ($arr[$i]['id'] != 2649 && $arr[$i]['id'] != 2650 && $arr[$i]['id'] != 2651 && $arr[$i]['id'] != 2652)) {
			$numpb = ($arr[$i]['num']+6).".";
		} else if( $arr[$i]['pid'] == 2648 && ($arr[$i]['id'] != 2686 && $arr[$i]['id'] != 2687 && $arr[$i]['id'] != 2688 && $arr[$i]['id'] != 2689)) {
			$numpb = ($arr[$i]['num']+6).".";
		}

		$list.= "
			<li>
				<span>&raquo;</span> <a  href='".$link."' title='".$arr[$i]['name_vn']."' > ".$numpb." ".$arr[$i]['name_vn']." </a>
			</li>
		";
		
	}
	if(!isset($act))
		$list.= '';
	else if($act=='edit')
		$list.= " <li> <span>&raquo;</span> <a class='disabled'>Sửa</a> </li> ";
	elseif($act=='add')
		$list.=" <li> <span>&raquo;</span> <a  class='disabled'>Thêm</a> </li> ";
	else
		$list.= '';                                                    	
	return $list;
}

function insert_HearderCat($a){
	global $path_url;
	$cha = $a['cid'];
	$root = isset($a['root'])?$a['root']:2;
	$act = $a['act'];
	$list = "";
	$str = "";
	$arr = array();
	do{
		$sql = "select * from $GLOBALS[db_sp].categories where id=".$cha;
		$r = $GLOBALS["sp"]->getRow($sql);
		$arr[count($arr)] = $r;
		$cha = $r['pid'];
	}while($arr[count($arr)-1]['id'] != $root);
	$j = 0;
	for($i=(count($arr)-1);$i>=0;$i--){
		
		if(empty($arr[$i]['unique_key_vn']))	
			$unique_key_vn = 'menu';
		else
			$unique_key_vn = $arr[$i]['unique_key_vn'];
			
		if($arr[$i]['has_child']=='1'){
			//$link = $path_url."/categories/".$unique_key_vn."-cid-".$arr[$i]['id'].".html";
		}
		else{
			$sql = "select * from $GLOBALS[db_sp].component where id=".$arr[$i]['comp'];
			$r = $GLOBALS["sp"]->getRow($sql);
			$link = $r['do'].".php?cid=".$arr[$i]['id'];
			$link1 = " href='".$link."'";
		}
		$numpb = '';
		if ( $arr[$i]['numphong'] > 0 ) {
			$numpb = $arr[$i]['numphong'].".";
		} 
		if( $arr[$i]['pid'] == 2647 && ($arr[$i]['id'] != 2649 && $arr[$i]['id'] != 2650 && $arr[$i]['id'] != 2651 && $arr[$i]['id'] != 2652)) {
			$numpb = ($arr[$i]['num']+6).".";
		} else if( $arr[$i]['pid'] == 2648 && ($arr[$i]['id'] != 2686 && $arr[$i]['id'] != 2687 && $arr[$i]['id'] != 2688 && $arr[$i]['id'] != 2689)) {
			$numpb = ($arr[$i]['num']+6).".";
		}

		$list.= "
			<li>
				<span>&raquo;</span> <a class='disabled' title='".$arr[$i]['name_vn']."' > ".$numpb." ".$arr[$i]['name_vn']." </a>
			</li>
		";
		
	}
	if(!isset($act))
		$list.= '';
	else if($act=='edit')
		$list.= " <li> <span>&raquo;</span> <a class='disabled'>Sửa</a> </li> ";
	elseif($act=='add')
		$list.=" <li> <span>&raquo;</span> <a  class='disabled'>Thêm</a> </li> ";
	else
		$list.= '';                                                    	
	return $list;
}

function insert_TheLoai($a){
	$cid = $a['cid'];
	$module = $a['module']; ///1 la tin tuc , 2 san pham .... trong table component
	$checked = "";
	$html = "";
	$sql = "select * from $GLOBALS[db_sp].categories where pid=2 order by num asc, id desc";
	$rs = $GLOBALS["sp"]->getAll($sql);
	$countCat1 = ceil(count($rs));
	if($countCat1 > 0){
		foreach($rs as $item){
			if($item['has_child']==1){
				if(CheckTheLoaiLive2($item['id'],$module)){//ham kiem tra cap 2
					$html .= "<option value='' style='color:#006600;font-weight:bold;' > ".$item['name_vn']." </option>\n ";
					$sql2 = "select * from $GLOBALS[db_sp].categories where pid= ".$item['id']." and comp = ".$module." order by num asc, id desc";
					$rs2 = $GLOBALS["sp"]->getAll($sql2);
					foreach($rs2 as $item2){
						if($cid == $item2['id'])
							$checked = " selected style='color:#005EBB;' ";
						else
							$checked = ""; 
						$html .= "<option value='".$item2['id']."' ".$checked."  > &nbsp;&nbsp;&nbsp;&nbsp;  ".$item2['name_vn']."  </option>\n ";
					}
				
				}
			}
			
			else{ //cap 1
				
				if($item['comp'] == $module){
					if($cid == $item['id'])
						$checked1 = " selected style='color:#005EBB;' ";
					else
						$checked1 = "";

					$html .= "<option value='".$item['id']."' ".$checked1."  > ".$item['name_vn']."  </option>\n ";
				}
				
			}
			
		}
	
	}
	$html = "<select  name='cat' id='cat' >" . $html . "</select>";
	return $html;

}

function CheckTheLoaiLive2($cid,$module){
	$sql = "select * from $GLOBALS[db_sp].categories where pid= ".$cid." and comp = ".$module." order by num asc, id asc";
	$rs = $GLOBALS["sp"]->getAll($sql);
	
	if(ceil(count($rs)) > 0 )
		return true;
	else
		return false;
}


function sendmail($user,$MAIL_FROMNAME,$email,$subj,$mess,$mailreply,$mailcc="",$mailcc1="")
{
	include("../#include/email_config.php");
	$mail = new PHPMailer();
	/////////goi cho gmail	
	$mail->IsSMTP(); // send via SMTP
	$mail->SMTPAuth = true; // turn on SMTP authentication
	
	$mail->SMTPDebug = 1;
	$mail->SMTPSecure = 'tls';
	$mail->Port       = 587;
	$mail->Host = SMTP_SERVER;
	$mail->Username = MAIL_USER; // SMTP username
	$mail->Password = MAIL_PASS; // SMTP password
	$mail->SetFrom($mailreply, $subj);
	$mail->CharSet = "UTF-8"; 
	
	$mail->From = MAIL_FROM;
	$mail->FromName = $MAIL_FROMNAME;

	$mail->AddAddress($email,$user);
	$mail->WordWrap = 50; // set word wrap
	
	$mail->IsHTML(true); // send as HTML
	$mail->Subject = $subj;
	$mail->Body = $mess;

	$send=$mail->Send();
	if ($send) {
		return true;
	}else return false;
}

///////Crop img
function resize_image($method,$image_loc,$new_loc,$width,$height) {
    if (!is_array(@$GLOBALS['errors'])) { $GLOBALS['errors'] = array(); }
 
    if (!in_array($method,array('force','max','crop'))) { $GLOBALS['errors'][] = 'Invalid method selected.'; }
 
    if (!$image_loc) { $GLOBALS['errors'][] = 'No source image location specified.'; }
    else {
        if ((substr(strtolower($image_loc),0,7) == 'http://') || (substr(strtolower($image_loc),0,7) == 'https://')) { /*don't check to see if file exists since it's not local*/ }
        elseif (!file_exists($image_loc)) { $GLOBALS['errors'][] = 'Image source file does not exist.'; }
        $extension = strtolower(substr($image_loc,strrpos($image_loc,'.')));
        if (!in_array($extension,array('.jpg','.jpeg','.png','.gif','.bmp'))) { $GLOBALS['errors'][] = 'Invalid source file extension!'; }
    }
 
    if (!$new_loc) { $GLOBALS['errors'][] = 'No destination image location specified.'; }
    else {
        $new_extension = strtolower(substr($new_loc,strrpos($new_loc,'.')));
        if (!in_array($new_extension,array('.jpg','.jpeg','.png','.gif','.bmp'))) { $GLOBALS['errors'][] = 'Invalid destination file extension!'; }
    }
 
    $width = abs(intval($width));
    if (!$width) { $GLOBALS['errors'][] = 'No width specified!'; }
 
    $height = abs(intval($height));
    if (!$height) { $GLOBALS['errors'][] = 'No height specified!'; }
 
    if (count($GLOBALS['errors']) > 0) { echo_errors(); return false; }
 
    if (in_array($extension,array('.jpg','.jpeg'))) { $image = @imagecreatefromjpeg($image_loc); }
    elseif ($extension == '.png') { $image = @imagecreatefrompng($image_loc); }
    elseif ($extension == '.gif') { $image = @imagecreatefromgif($image_loc); }
    elseif ($extension == '.bmp') { $image = @imagecreatefromwbmp($image_loc); }
 
    if (!$image) { $GLOBALS['errors'][] = 'Image could not be generated!'; }
    else {
        $current_width = imagesx($image);
        $current_height = imagesy($image);
        if ((!$current_width) || (!$current_height)) { $GLOBALS['errors'][] = 'Generated image has invalid dimensions!'; }
    }
    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); echo_errors(); return false; }
 
    if ($method == 'force') { $new_image = resize_image_force($image,$width,$height); }
    elseif ($method == 'max') { $new_image = resize_image_max($image,$width,$height); }
    elseif ($method == 'crop') { $new_image = resize_image_crop($image,$width,$height); }
 
    if ((!$new_image) && (count($GLOBALS['errors'] == 0))) { $GLOBALS['errors'][] = 'New image could not be generated!'; }
    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); echo_errors(); return false; }
 
    $save_error = false;
    if (in_array($extension,array('.jpg','.jpeg'))) { imagejpeg($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.png') { imagepng($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.gif') { imagegif($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.bmp') { imagewbmp($new_image,$new_loc) or ($save_error = true); }
    if ($save_error) { $GLOBALS['errors'][] = 'New image could not be saved!'; }
    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); @imagedestroy($new_image); echo_errors(); return false; }
 
    imagedestroy($image);
    imagedestroy($new_image);
 
    return true;
}
 
function echo_errors() {
    if (!is_array(@$GLOBALS['errors'])) { $GLOBALS['errors'] = array('Unknown error!'); }
    foreach ($GLOBALS['errors'] as $error) { echo '<p style="color:red;font-weight:bold;">Error: '.$error.'</p>'; die(); }
}

function resize_image_crop($image,$width,$height) {
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
    if (($w == $width) && ($h == $height)) { return $image; } //no resizing needed
 
    //try max width first...
    $ratio = $width / $w;
    $new_w = $width;
    $new_h = $h * $ratio;
 
    //if that created an image smaller than what we wanted, try the other way
    if ($new_h < $height) {
        $ratio = $height / $h;
        $new_h = $height;
        $new_w = $w * $ratio;
    }
 
    $image2 = imagecreatetruecolor ($new_w, $new_h);
    imagecopyresampled($image2,$image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
 
    //check to see if cropping needs to happen
    if (($new_h != $height) || ($new_w != $width)) {
        $image3 = imagecreatetruecolor ($width, $height);
        if ($new_h > $height) { //crop vertically
            $extra = $new_h - $height;
            $x = 0; //source x
            $y = round($extra / 2); //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        } else {
            $extra = $new_w - $width;
            $x = round($extra / 2); //source x
            $y = 0; //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        }
        imagedestroy($image2);
        return $image3;
    } else {
        return $image2;
    }
}

function resize_image_max($image,$max_width,$max_height) {
    $w = imagesx($image); //current width
    $h = imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
 
    if (($w <= $max_width) && ($h <= $max_height)) { return $image; } //no resizing needed
 
    //try max width first...
    $ratio = $max_width / $w;
    $new_w = $max_width;
    $new_h = $h * $ratio;
 
    //if that didn't work
    if ($new_h > $max_height) {
        $ratio = $max_height / $h;
        $new_h = $max_height;
        $new_w = $w * $ratio;
    }
 
    $new_image = imagecreatetruecolor ($new_w, $new_h);
    imagecopyresampled($new_image,$image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
    return $new_image;
}

function resize_image_force($image,$width,$height) {
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
    if (($w == $width) && ($h == $height)) { return $image; } //no resizing needed
 
    $image2 = imagecreatetruecolor ($width, $height);
    imagecopyresampled($image2,$image, 0, 0, 0, 0, $width, $height, $w, $h);
 
    return $image2;
}
//Mai thêm up hình 30/07/2020 -- sửa đổi ngày 2/10/2020
function uploadImageAutoConvert($namegetimage, $imagename, $imagesizew, $imagesizeh, $typeresize, $namedatabase, $folderpathdb){
	if (isset($_FILES[$namegetimage]['name']) && $_FILES[$namegetimage]['size'] > 0){
		$folderpath = "../".$folderpathdb;
		$folderarray = explode("/",$folderpathdb);
		$folderchecking = "..";

		// get image
		$img = $_FILES[$namegetimage]['name'];
		$start = strpos($img,".");
		$type = substr($img,$start,strlen($img));
		$filename = time().$type;
		$filename = RenameFile($filename);
		$fileType = pathinfo($filename, PATHINFO_EXTENSION);//lấy type hình
		$converted_filename = time()."converted.jpg";

		// check folder and auto create
		foreach ($folderarray as $folderitem){
			$folderchecking .="/".$folderitem;
			if(!file_exists($folderchecking)){
				mkdir($folderchecking, 0755);
			}
		}
		$arrout = array();
		try{
			//process image
			$filenameget = $filename;
			$allowTypes = array('png','gif');
			copy($_FILES[$namegetimage]['tmp_name'], $folderpath.$filename);
			if(in_array($fileType, $allowTypes)){ // if type file is png or gif then covert
				// convert file
				$filenow = $_FILES[$namegetimage]['tmp_name'];
				convertAnotherToJpg($fileType, $filenow, $folderpath.$converted_filename);
				$filenameget = $converted_filename;
			}
			//up load image
			for($i=0;$i<count($imagename);$i++){
				// delete img available
				$path_name_img = $folderpath.$imagename[$i].".jpg";
				if (file_exists($path_name_img)){
					unlink($path_name_img);
				}

				resize_image($typeresize[$i],$folderpath.$filenameget,$folderpath.$imagename[$i].".jpg",$imagesizew[$i],$imagesizeh[$i]);
				$arrout[$namedatabase[$i]] = $folderpathdb.$imagename[$i].".jpg";
			}

			//end
			$arrout['status'] = true;
		}
		catch (Exception $e){
			$arrout['status'] = false;
			$arrout['error'] = $e;
		}
		finally {
			if(file_exists($folderpath.$filename)){
				unlink($folderpath.$filename);
			}
			if(file_exists($folderpath.$converted_filename)){
				unlink($folderpath.$converted_filename);
			}
		}
		return $arrout;
	}
}
function convertAnotherToJpg($fileType, $fileimage, $dir_converted_filename){
	if ($fileType=="png"){
		$new_pic = imagecreatefrompng($fileimage);
	}
	if ($fileType=="gif"){
		$new_pic = imagecreatefromgif($fileimage);
	}
	if ($fileType == 'jpg'){
		move_uploaded_file($fileimage, $dir_converted_filename);
	}
	else{
		// Create a new true color image with the same size
		$w = imagesx($new_pic);
		$h = imagesy($new_pic);
		$white = imagecreatetruecolor($w, $h);
	
		// Fill the new image with white background
		$bg = imagecolorallocate($white, 255, 255, 255);
		imagefill($white, 0, 0, $bg);
	
		// Copy original transparent image onto the new image
		imagecopy($white, $new_pic, 0, 0, 0, 0, $w, $h);
		$new_pic = $white;
		imagejpeg($new_pic, $dir_converted_filename);
		imagedestroy($new_pic);
	}
}

//// ********* Chuyển chuổi thành mảng 2 chiều và ngược lại ******** /////
// $str = '1267=7.5, 1249=40, 1543=1, 1020=1, 1032=2, 1038=2, 710=25' ///
// $key1, key2 là key mảng muốn truyền vào 							 ///
// VD: StrToArray($str2,'code');                                    ///
function StrToArray($str , $key1='id', $key2='soluong', $delimiter1=',', $delimiter2='=') {
	$arr = explode($delimiter1, trim($str));
	$arrout = array();
	foreach ($arr as $k=>$item ){
		$arrtmp = explode($delimiter2, trim($item));
		$arrout[$k][$key1] = $arrtmp[0];
		$arrout[$k][$key2] = $arrtmp[1];
	}	
	return $arrout;
}
function ArrayToStr($arr , $delimiter1=',', $delimiter2='=') {	
	$arrtmp = array();
	foreach ($arr as $item ){
		$arrtmp[] = implode($delimiter2,$item);		
	}	
	return implode($delimiter1,$arrtmp);	
}
///// *** insert StrToArray *** /////
function insert_StrToArray($a){
	$str = trim($a['str']); 
	$key1= trim($a['key1']);
	$key2 = trim($a['key2']);
	$delimiter1 = trim($a['delimiter1']); 
	$delimiter2 = trim($a['delimiter2']);	
	if ( empty($key1) )
		$key1 = 'id';
	if ( empty($key2) )
		$key2 = 'soluong';
	if ( empty($str) )
		return array();
	if ( !empty($delimiter1) && !empty($delimiter2) )	
		return StrToArray($str , $key1, $key2, $delimiter1, $delimiter2);
	else
		return StrToArray($str, $key1, $key2);
}
/******************************************************

/*==========================*/
function insert_getName($a){
	$id = $a['id'];
	$table = $a['table'];
	$names = $a['names'];
	$name = '';
	if($id > 0){
		$sql = "select ".$names." from $GLOBALS[db_sp].".$table." where id= ".$id;
		$name = $GLOBALS["sp"]->getOne($sql);
	}
	return $name;
}

// M.Tân thêm ngày 22/07/2021 - getName database Kế toán
function insert_getNameKeToan($a){
	$id = $a['id'];
	$table = $a['table'];
	$names = $a['names'];
	$name = '';
	if($id > 0){
		$sql = "select ".$names." from $GLOBALS[db_ketoan].".$table." where id= ".$id;
		$name = $GLOBALS['ketoan']->getOne($sql);
	}
	return $name;
}

function insert_getNameStr($a){
	$table = $a['table'];
	$names = $a['names'];
	$wh = $a['wh'];
	$name = '';
	if(!empty($wh)){
		$sql = "select ".$names." from $GLOBALS[db_sp].".$table." where ".$wh;
		$rs = $GLOBALS["sp"]->getCol($sql);
		if(ceil(count($rs)) > 0){
			$name = implode(', ',$rs);	
		}
	}
	return $name;
}

function insert_getNamePhongBanTho($a){
	$matho = $a['matho'];
	$name = '';
	if($matho != ''){
		$sql = "select TENTHO from $GLOBALS[db_sp].phanmem_tho where MATHO='".$matho."'";
		$name = $GLOBALS["sp"]->getOne($sql);
	}
	return $name;
}

function insert_getNameGiaoNhanNhaXuong($a){
	$id = ceil($a['id']);
	$table = $a['table'];
	$names = $a['names'];
	$name = '';
	
	$sql = "select ".$names." from $GLOBALS[db_sp].".$table." where id= ".$id;
	$name = $GLOBALS["sp"]->getOne($sql);

	return $name;
}
function insert_getviewGiaoNhan($a){
	$cid = ceil($a['cid']);
	
	$sql = "select typegiaonhan from $GLOBALS[db_sp].categories where id= ".$cid;
	$typegiaonhan = $GLOBALS["sp"]->getOne($sql);
	
	$name = getName('trangthai_giaonhan_nhaxuong', 'name_vn', $typegiaonhan);
	return $name;
}


function getName($table, $names, $id){
	$name = '';
	if($id > 0){
		$sql = "select ".$names." from $GLOBALS[db_sp].".$table." where id= ".$id;
		$name = $GLOBALS["sp"]->getOne($sql);
	}
	return $name;
}

// M.Tân thêm ngày 22/07/2021 - getName database Kế toán
function getNameKeToan($table, $names, $id){
	$name = '';
	if($id > 0){
		$sql = "select ".$names." from $GLOBALS[db_ketoan].".$table." where id= ".$id;
		$name = $GLOBALS['ketoan']->getOne($sql);
	}
	return $name;
}


function insert_optionChuyenDen($a){
	$chonphongbanin = ceil($a['chonphongbanin']);
	$id = $a['id'];
	$str = '';
	if(!empty($id)){
		$sql = "select * from $GLOBALS[db_sp].categories where id in (".$id.") and active=1 order by id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$selected = "";
			if($chonphongbanin == $item['id']){
				$selected = "selected";
			}
			$str .= "<option value='".$item['id']."' ".$selected.">".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";		
		}
	}
	return $str;
}

// M.Tân thêm ngày 22/07/2021 - optionChuyenDenKeToan database Kế toán
function insert_optionChuyenDenKeToan($a){
	$id = $a['id'];
	$str = '';
	if(!empty($id)){
		$sql = "select * from $GLOBALS[db_ketoan].categories where id in (".$id.") and active=1 order by id asc";
		$rs = $GLOBALS['ketoan']->getAll($sql);
		foreach($rs as $item){
			$str .= "<option value='".$item['id']."'>".getLinkTitleKeToan($item['id'],1)."</option>";		
		}
	}
	return $str;
}
function insert_optionChuyenDenSelectedGetCid($a){
	$cid = $a['cid'];
	$chonphongbanin = $a['chonphongbanin'];
	$str = '';
	if(!empty($cid)){
		$sql = "select id,pid,name_vn,numphong from $GLOBALS[db_sp].categories where ( pid in (".$cid.") or id=147) and active=1 order by pid asc, num asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($item['id'] == 147){
				$rsid = 307; //  :KHO THÀNH PHẨM LƯU TRỮ » KHO NGUỒN VÀO » KHO NHÀ XƯỞNG GIAO NỮ TRANG (KTP)
			}
			else{
				//$sqlid = "SELECT id FROM $GLOBALS[db_sp].categories WHERE pid IN (SELECT id FROM $GLOBALS[db_sp].categories WHERE pid=". $item['id'] ." AND num=0) AND num=0";
				$sqlid = "SELECT id FROM $GLOBALS[db_sp].categories WHERE pid IN (SELECT id FROM $GLOBALS[db_sp].categories WHERE pid=". $item['id'] ." AND num=0) AND typenx=1";
				$rsid = $GLOBALS["sp"]->getOne($sqlid);	
			}
			if($rsid == $chonphongbanin)
				$selected = "selected";
			else
				$selected = "";
			
			$num = '';	
			if($item['numphong'] > 0)
				$num = '<span class="numpb">'.$item['numphong'].'.</span> ';
			if(!empty($rsid))	
				$str .= "<option ".$selected." value='".$rsid."'>".$num.$item['name_vn']."</option>";		
		}
	}
	return $str;
}

function insert_optionChuyenDenSelected($a){
	$id = $a['id'];
	$chonphongbanin = $a['chonphongbanin'];
	$str = $row = '';
	if(!empty($id)){
		if($id == $chonphongbanin){
			$sql = "SELECT if (numphong>0,concat(numphong,'. ',name_vn),name_vn) as name_vn,pid FROM $GLOBALS[db_sp].categories WHERE id IN (SELECT pid FROM $GLOBALS[db_sp].categories WHERE id IN (SELECT pid FROM $GLOBALS[db_sp].categories WHERE id=". $chonphongbanin ."))";
			$row = $GLOBALS["sp"]->getRow($sql);
		}
		$sql = "select id,maphongban from $GLOBALS[db_sp].categories where id in (".$id.") and active=1 order by id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);		
		foreach($rs as $item){
			if($item['id'] == $chonphongbanin)
				$selected = "selected";
			else
				$selected = "";
			if(!empty($row) && ($row['pid'] == 16 || $row['pid'] == 3168 || $row['pid'] == 3169 || $row['pid'] == 3170 || $row['pid'] == 3171 || $row['pid'] == 3172) )
				$str .= "<option ".$selected." value='".$item['id']."'>".$row['name_vn']."</option>";
			else
				$str .= "<option ".$selected." value='".$item['id']."'>".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";		
		}
	}
	return $str;
}

function insert_optionKhoSanXuatPhongKhacSelected($a){
	$id = $a['id'];
	$type = $a['type'];
	$phongbanchuyen = $a['phongbanchuyen'];
	$chonphongbanin = $a['chonphongbanin'];
	$str = '';
	$idoption = '379, 388, 404, 416, 428, 440, 452, 464, 476, 488, 500, 512, 524, 536, 548, 560, 572, 584, 599, 611, 623, 635, 647, 659, 671, 683, 695, 727, 752, 798, 1776, 1524, 1556, 1569, 1582, 1614, 1689, 1960,2321,2333,2345,2357,2369,2381,2393,2405,2417,2429,2441,2453,2465,2477';
	$sql = "select * from $GLOBALS[db_sp].categories where id in (".$idoption.") and active=1 order by num asc, id asc";
	$rs = $GLOBALS["sp"]->getAll($sql);
	foreach($rs as $item){
		if($item['id'] == $chonphongbanin)
			$selected = "selected";
		else
			$selected = "";
		$str .= "<option ".$selected." value='".$item['id']."'>".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";	
	}
	return $str;
}

function insert_optionKhoSanXuatPhongKhac($a){
	$id = $a['id'];
	$type = $a['type'];
	$phongbanchuyen = $a['phongbanchuyen'];
	$str = '';
	$idoption = '379, 388, 404, 416, 428, 440, 452, 464, 476, 488, 500, 512, 524, 536, 548, 560, 572, 584, 599, 611, 623, 635, 647, 659, 671, 683, 695, 727, 752, 798, 1776, 1524, 1556, 1569, 1582, 1614, 1689, 1960,2321,2333,2345,2357,2369,2381,2393,2405,2417,2429,2441,2453,2465,2477';
	$sql = "select * from $GLOBALS[db_sp].categories where id in (".$idoption.") and active=1 order by num asc, id asc";
	$rs = $GLOBALS["sp"]->getAll($sql);
	foreach($rs as $item){
		$str .= "<option value='".$item['id']."'>".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";	
	}
	return $str;
}

function insert_optionChuyenDenKhSanXuat($a){
	$id = $a['id'];
	$type = $a['type'];
	$phongbanchuyen = $a['phongbanchuyen'];
	$str = '';
	$idoption = '379, 388, 404, 416, 428, 440, 452, 464, 476, 488, 500, 512, 524, 536, 548, 560, 572, 584, 599, 611, 623, 635, 647, 659, 671, 683, 695, 727, 752, 798, 1776, 1524, 1556, 1569, 1582, 1614, 1689, 1960,2321,2333,2345,2357,2369,2381,2393,2405,2417,2429,2441,2453,2465,2477';
	$sql = "select * from $GLOBALS[db_sp].categories where id in (".$idoption.") and active=1 order by num asc, id asc";
	$rs = $GLOBALS["sp"]->getAll($sql);
	foreach($rs as $item){
		$str .= "<option value='".$item['id']."'>".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";		
	}
	$str = '
		<script>
			$(function () {
				$("#siteIDload select").select2();
			});
		</script>
		<div id="siteIDload">
			<select class="chuyenPhonbanSanXuat " id="chuyenkho'.$id.'" onchange="chuyenKhoSanXuat(\'chuyenkhosanxuat\', this.value, '.$id.',\''.$phongbanchuyen.'\',\''.$type.'\')">
				<option value="">--chuyển đến--</option>
				'.$str.'
			</select>
		</div>
	';
	return $str;
}

function insert_optionKhoSanXuatChuyenDenPhong($a){
	$id = $a['id'];
	$noid = $a['noid'];
	$type = $a['type'];
	$phongbanchuyen = $a['phongbanchuyen'];
	$chonphongbanin = ceil($a['chonphongbanin']);
	$str = '';
	$idoption = '379, 388, 404, 416, 428, 440, 452, 464, 476, 488, 500, 512, 524, 536, 548, 560, 572, 584, 599, 611, 623, 635, 647, 659, 671, 683, 695, 727, 752, 798, 1776, 1524, 1556, 1569, 1582, 1614, 1689, 1960,2321,2333,2345,2357,2369,2381,2393,2405,2417,2429,2441,2453,2465,2477,3105,3190';
	$wh = '';
	if(!empty($noid))
		$wh = " and id NOT IN (".$noid.") ";
		$sql = "select * from $GLOBALS[db_sp].categories where id in (".$idoption.") and active=1 $wh order by num asc, id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
	
	foreach($rs as $item){
		$selected = "";
		if($chonphongbanin == $item['id']){
			$selected = "selected";
		}
		$str .= "<option value='".$item['id']."' ".$selected.">".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";		
	}
	return $str;
}

function insert_optionKhoSanXuatChonPhong($a){
	$chonphongbanin = ceil($a['chonphongbanin']);
	$noid = $a['noid'];
	$str = '';
	$idoption = '379,388,404,416,428,440,452,464,476,488,500,512,524,536,548,560,572,584,599,611,623,635,647,659,671,683,695,727,752,798,1776,1524,1556,1569,1582,1614,1689,1786,1960,2321,2333,2345,2357,2369,2381,2393,2405,2417,2429,2441,2453,2465,2477,2795,2812,2830,2862,2913,2935,3059,3093,3105,3190';
	//$idoption = '379, 388, 404, 416, 428, 440, 452, 464, 476, 488, 500, 512, 524, 536, 548, 560, 572, 584, 599, 611, 623, 635, 647, 659, 671, 683, 695, 727, 752, 798, 1776, 1524, 1556, 1569, 1582, 1614, 1689, 1786, 1960';
	$wh = '';
	if(!empty($noid))
		$wh = " and id NOT IN (".$noid.") ";
		
	$sql = "select id,maphongban from $GLOBALS[db_sp].categories where id in (".$idoption.") and active=1 $wh order by num asc, id asc";
	$rs = $GLOBALS["sp"]->getAll($sql);
	foreach($rs as $item){		
		$selected = '';
		if($chonphongbanin == $item['id'])
			$selected = "selected";			
			/*
			$title = getLinkTitle($item['id'],1);
			if(!empty($title)){
				$title = explode('&raquo;',$title);
				$title = $title[1];	
			}
			$str .= "<option value='".$item['id']."' ".$selected."> ".$item['maphongban']." : ".$title."</option>";
			*/
			$str .= "<option value='".$item['id']."' ".$selected."> ".getNameKhoSanXuat($item['id'])."</option>";		
	}
	return $str;
}

function insert_getNamKhoSanXuat($a){
	$title = '';
	if($a['id'] > 0){
		$title = getLinkTitle($a['id'],1);
		/*
		if(!empty($title) && $a['id'] != 708 ){
			$title = explode('&raquo;',$title);
			$title = $title[0];	
		}
		*/
	}
	return $title;
}

function insert_getNamMaDonHangCatalog($a){
	$madhin = trim($a['madhin']);
	$rs = '';
	if ($madhin == -3)
		$rs = 'Điều chỉnh kho vàng';
	else if ($madhin == -2)
		$rs = 'SP bảo hành';
	else if( !empty($madhin) || $madhin == -1 ){
		$sql = "select code from $GLOBALS[db_catalog].ordersanxuat where id IN (".$madhin.") "; 
		$rs = $GLOBALS["catalog"]->getCol($sql);
		if ( !empty ($rs) )
			$rs = implode(', ',$rs);
		else
			$rs = '';
	}
	return $rs;	
}

function getNamMaDonHangCatalog($madhin){
	$rs = '';
	if ($madhin == -3)
		$rs = 'Điều chỉnh kho vàng';
	else if ($madhin == -2)
		$rs = 'SP bảo hành';
	else if($madhin > 0 || $madhin == -1 ){
		//$sql = "select code from $GLOBALS[db_catalog].ordersanxuat where id=".$madhin; 
		//$rs = $GLOBALS["catalog"]->getOne($sql);
		$sql = "select code from $GLOBALS[db_catalog].ordersanxuat where id IN (".$madhin.") "; 
		$rs = $GLOBALS["catalog"]->getCol($sql);
		if ( !empty ($rs) )
			$rs = implode(', ',$rs);
		else
			$rs = '';
	}
	return $rs;	
}

function insert_getRowDonHangCatalog($a){
	$names = trim($a['names']);
	$table = trim($a['table']);
	$getTable = trim($a['getTable']);
	$wh = trim($a['wh']);
	
	$rs = '';
	$sql = "select ".$names." from $GLOBALS[db_catalog].".$table." where ".$wh; 
	$rs = $GLOBALS["catalog"]->$getTable($sql);
	return $rs;	
}
function getRowDonHangCatalog($names, $table, $getTable='getRow', $wh){
	$rs = '';
	$sql = "select ".$names." from $GLOBALS[db_catalog].".$table." where ".$wh; 
	$rs = $GLOBALS["catalog"]->$getTable($sql);
	return $rs;	
}
/////* Cong donhang Limit + Chuyenphong Catalog */////
function insert_optionChoDonHangCatalogLimitChuyen($a){
	$cid = ceil($a['cid']);
	$madhin = $a['madhin'];
	$idNL = $a['idNL'];
	return getoptionChoDonHangCatalogLimitChuyen($madhin,$cid,$idNL);
}

function getoptionChoDonHangCatalogLimitChuyen($madhin,$cid,$idNL=0){
 	$html = '';
	//$arrmadh = array();
	$check = 0;
	if ( $cid > 0 ) {		
		$rsNLXK = getRowName("idnhomnguyenlieu, show_dh, show_kdh","nguyenlieuxuatkho", " FIND_IN_SET(".$cid.", phongban) > 0 and FIND_IN_SET(".$idNL.", idnguyenlieu) > 0 and active=1");
		if ( ( $rsNLXK['idnhomnguyenlieu'] == 43 ) && $cid != 585 && $cid != 684  ) { // id: Nhóm BH
			$rsctl = array(array('id'=>'-2','code'=>'SP bảo hành')); $check = 1;
		}	
		else if ( $rsNLXK['show_dh'] == 1 || $idNL == 0 ) {
			$sql = "select phongbancatalog from $GLOBALS[db_sp].categories where id=".$cid;
			$rs = $GLOBALS["sp"]->getOne($sql);
			
			if(!empty($rs)){
				if($rs == 76)
					$phongbancatalog = '76,0';
				else
					$phongbancatalog = $rs;
			}
			else{ ///////// kg có xuất dữ liệu
				$phongbancatalog = ' -1 ';	
			}
			$wh = " and phongban IN (".$phongbancatalog.") ";
			if ( $rsNLXK['show_kdh'] == 1 || $_SESSION['group_qlsxntjcorg_user'] == -1)
				$wh = " and ( phongban IN (".$phongbancatalog.") or id=-1 ) ";
			if ( $idNL == 122 ) /// Nhóm toa hàng bổ sung
				$wh .= " and midorder = -1 ";
			else if ( $idNL == 126 ) /// Nhóm toa hàng bảo hành
				$wh .= " and midorder = -2 ";
			else
				$wh .= " and midorder NOT IN (-2,-1,0) ";
			if ($cid == 380 && $idNL == 122)
				$sqlctl = "select id, code from $GLOBALS[db_catalog].ordersanxuat where huydh=0 and datechuyen >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY) ".$wh." order by id desc";
			else
				$sqlctl = "select id, code from $GLOBALS[db_catalog].ordersanxuat where active=1 and huydh=0 ".$wh." order by id desc";
			$rsctl = $GLOBALS["catalog"]->getAll($sqlctl);
		}
		else {
			$idnhomNL = getName("danhmuc_nguyenlieu","pid",$idNL);
			if ( $idnhomNL == 87 ){
				$rsctl = array(array('id'=>'-3','code'=>'Điều chỉnh kho vàng')); $check = 1;
			}	
			else{
				$rsctl = array(array('id'=>'-1','code'=>'Không Đơn Hàng')); $check = 1;
			}	
		}
		/*
		if ( !empty($madhin) ){
			$arrmadh = explode(",",$madhin);
		}
		*/
		foreach($rsctl as $item){
			$selected = "";
			if ( $item['id'] == $madhin || $check == 1 )
				$selected = "selected";
			$html .= "<option ".$selected."  value='".$item['id']."' > ".$item['code']." </option>";
		}
	}	
	return  $html;
}

function insert_optionKhoSanXuatChonPhongLimitChuyen($a){
	$chonphongbanin = ceil($a['chonphongbanin']);
	$madhin = $a['madhin'];
	$cid = ceil($a['cid']);
	$id = $a['id']; // ID phòng khác
	$idNL = $a['idNL']; // ID danhmuc_nguyenlieu
	return getoptionKhoSanXuatChonPhongLimitChuyen($madhin,$chonphongbanin,$id,$cid,$idNL);
}

function getoptionKhoSanXuatChonPhongLimitChuyen($madhin,$chonphongbanin,$id,$cid,$idNL=0){ //$id ID phòng đến khác, $cid xuất kho
	$str = '';
	$rsNLXK = array('phongbanden'=>NULL,'chuyen_all'=>0);
	
	if ( $idNL > 0 )
		$rsNLXK = getRowName("phongbanden, chuyen_all","nguyenlieuxuatkho", " FIND_IN_SET(".$cid.", phongban) > 0 and FIND_IN_SET(".$idNL.", idnguyenlieu) > 0 and active=1");
	if ( $madhin > 0 && $_SESSION['group_qlsxntjcorg_user'] != -1 ) {
		$phongbanden = getToSanXuatChuyen( $madhin );
		$rs = array();
			if ( !empty($phongbanden)) {
				//$sql = "select id from $GLOBALS[db_sp].categories where pid IN ( SELECT pid FROM $GLOBALS[db_sp].categories WHERE FIND_IN_SET(phongbancatalog,'".$phongbanden."') > 0  AND num=1 ) and num=0 and active=1 order by num asc, id asc";
				$sql = "select id from $GLOBALS[db_sp].categories where pid IN ( SELECT pid FROM $GLOBALS[db_sp].categories WHERE FIND_IN_SET(phongbancatalog,'".$phongbanden."') > 0  AND typenx=2 ) and typenx=1 and active=1 order by num asc, id asc";
				$rs = $GLOBALS["sp"]->getCol($sql); 
				//if (!empty($row))
					//$rs[] = $row;
			}
			else if ( !empty($rsNLXK['phongbanden']) ) {
				//$sql = "select id from $GLOBALS[db_sp].categories where id IN ( $rsNLXK[phongbanden] ) and num=0 and active=1 order by num asc, id asc";
				$sql = "select id from $GLOBALS[db_sp].categories where id IN ( $rsNLXK[phongbanden] ) and typenx=1 and active=1 order by num asc, id asc";
				$rs = $GLOBALS["sp"]->getCol($sql);
			}
	}
	else if ($cid != 624 && $cid != 696) { // Không chuyển trong KhoSanxuat
		$idoption = '379,388,404,416,428,440,452,464,476,488,500,512,524,536,548,560,572,584,599,611,623,635,647,659,671,683,695,727,752,798,1776,1524,1556,1569,1582,1614,1689,1786,1960,2321,2333,2345,2357,2369,2381,2393,2405,2417,2429,2441,2453,2465,2477,2541,2795,2812,2830,2862,2913,2935,3059,3093,3105,3190';
		//$idoption = getAllChoNhapKho(16); // 16 Kho sản xuất
		$noid = getChoNhapKho_XuatKho($cid);
		$wh = '';
		if(!empty($noid))
			$wh = " and id NOT IN (".$noid.") ";
			
		$sql = "select id from $GLOBALS[db_sp].categories where id IN (".$idoption.") and active=1 $wh order by num asc, id asc";
		$rs = $GLOBALS["sp"]->getCol($sql);
	}
	if ( $chonphongbanin == 0 && $_SESSION['group_qlsxntjcorg_user'] == -1 ) {
		if ( $madhin > 0 ) {
			$phongbanden = getToSanXuatChuyen( $madhin );
			if ( !empty($phongbanden)) {
				//$sql = "select id from $GLOBALS[db_sp].categories where pid IN ( SELECT pid FROM $GLOBALS[db_sp].categories WHERE FIND_IN_SET(phongbancatalog,'".$phongbanden."') > 0  AND num=1 ) and num=0 and active=1 order by num asc, id asc";
				$sql = "select id from $GLOBALS[db_sp].categories where pid IN ( SELECT pid FROM $GLOBALS[db_sp].categories WHERE FIND_IN_SET(phongbancatalog,'".$phongbanden."') > 0  AND typenx=2 ) and typenx=1 and active=1 order by num asc, id asc";
				$chonphongbanin = $GLOBALS["sp"]->getOne($sql); 
			}
		}	
		else if ( !empty($rsNLXK['phongbanden']) ) {
			$chonphongbanin = substr($rsNLXK['phongbanden'],0,strpos($rsNLXK['phongbanden'],','));
		}	
	}
	foreach($rs as $item){
		$selected = '';
		if( $item == $chonphongbanin )
			$selected = "selected";
		// $title = getLinkTitle($item['id'],1);			
		// if(!empty($title)){
			// $title = explode('&raquo;',$title);
			// $title = $title[1];	
		// }
		$str .= "<option value='".$item."' ".$selected.">".getNameKhoSanXuat($item)."</option>";		
	}
	
	if ( ( $rsNLXK['chuyen_all'] == 1 ) && !empty($rsNLXK['phongbanden']) )
		$str .= getoptionChuyenDenSelected($chonphongbanin,$rsNLXK['phongbanden']);	
	
	if ( !empty($id) && empty($str) && ( $_SESSION['group_qlsxntjcorg_user'] != -1 ) ){
		if ( ($cid == 624 || $cid == 696) && !empty($rsNLXK['phongbanden']) )
			$id = $rsNLXK['phongbanden'];
		$str = getoptionChuyenDenSelected($chonphongbanin,$id);
	}
	
	if ( !empty($id) && ( $_SESSION['group_qlsxntjcorg_user'] == -1 )  ){
		if (!empty($idoption))
			$sql = "select group_concat(id) from $GLOBALS[db_sp].categories where id IN ($id) and id NOT IN ($idoption) and active=1 order by FIELD(id,$id) ";
		else
			$sql = "select group_concat(id) from $GLOBALS[db_sp].categories where id IN ($id) and active=1 order by FIELD(id,$id) ";
		$rs = $GLOBALS["sp"]->getOne($sql);
		if (!empty($rs))
			$str .= getoptionChuyenDenSelected($chonphongbanin,$rs);
	}
	return $str;
}
/// Xác định phòng ban tiếp trong QTSX catalog
function getToSanXuatChuyen( $madhin ){// $madhin: madonhang catalog, $id: phong hien tai, idchuyen:phong chuyen den
	$pid = 0;	
	if ( $madhin > 0) {
		$sql = "select midorder,phongban,pbden_index,phongbanchuyen,phongtruocchuyen,phongchuyenbefore,idquytrinhsx,quytrinhbosung from $GLOBALS[db_catalog].ordersanxuat where active=1 and id=".$madhin; 
		$rs = $GLOBALS["catalog"]->getRow($sql);
		if ( !empty($rs) ) {
			if ($rs['idquytrinhsx'] > 0) {
				$sqlqtsx = "select list from $GLOBALS[db_catalog].quytrinhsanxuat where id =".$rs['idquytrinhsx']; 
				$rsqtsx = $GLOBALS["catalog"]->getOne($sqlqtsx);
			}
			else if ($rs['midorder'] == -1 || $rs['midorder'] == -2 || $rs['midorder'] == -3) {
				$rsqtsx = $rs['quytrinhbosung'];
			}
			$id = $rs['phongban'];
			$id_index = $rs['pbden_index'];
			$idchuyen = $rs['phongbanchuyen'];
			$idtruoc = $rs['phongtruocchuyen'];
			$idbefore = $rs['phongchuyenbefore'];
			if ( !empty($rsqtsx) ) {
				$arr = explode(",",$rsqtsx);
				$len = count($arr);
				$key = $temp = $temp1 = $temp2 = -1;
				$flag = $index = 0;
				for ($k=0;(($k<$len)&&($flag==0));$k++){		
					if ( $arr[$k] == $id ){
						$key = $k;
						if ( ($k < ($len-1) &&  ($arr[$k] == $arr[$k+1]) ) )
							$key = $k+1; // Bỏ qua 2 phòng giống nhau liên tiếp
						if ( $temp == -1 )
							$temp = $key; // Giữ lại phần tử đầu tìm thấy				
						if ( ($k > 0) && ($arr[$k-1] == $idchuyen) ){
							if ( $temp1 == -1 )
								$temp1 = $key;
							if ( ($k > 1) && ($arr[$k-2] == $idtruoc) ){					
								if ( $temp2 == -1 )
									$temp2 = $key;
								if ( ($k > 2) && ($arr[$k-3] == $idbefore) )
									$flag = 1;
							}
						}
						if ( $index == $id_index )
							$flag = 1;			
						$index++;
					}
				}
				$temp = ($temp1 > $temp) ? $temp1 : $temp;
				$temp = ($temp2 > $temp) ? $temp2 : $temp;
				if ( ($temp > -1) && ($flag == 0) ) 
					$key = $temp;
				if ( $key < ($len-1) && ($key > -1) ){
					$pid = $arr[$key+1];
				}	
				else if ( $key == ($len-1) ){
					//$mid = getOneInAll('mid','userorder',' id='.$rs['midorder']);
					$pid = getIDphongke($rs['midorder'],$arr[$key]);
				}
				else if ( $key == -1 ){					
					$pid = getIDphongke($rs['midorder'],$rs['phongban']);
				}	
				else{ 
					$pid = 0;
				}
			}
		}	
	}	
	return $pid;
}
function getIDphongke($mid,$idlast){ // $idlast phòng cuối quy trình
	$idpb = 0;
	if($mid > 0 && $idlast > 0){
		$sql = "SELECT idpb FROM $GLOBALS[db_catalog].phongsauqtsx WHERE pid=".$idlast." AND FIND_IN_SET(".$mid.", listorder) > 0 AND active=1";
		$rs = $GLOBALS["catalog"]->getOne($sql);
		if(empty($rs)){
			$sql = "SELECT group_concat(idpb) FROM $GLOBALS[db_catalog].phongsauqtsx WHERE pid=".$idlast." AND active=1";
			$rs = $GLOBALS["catalog"]->getOne($sql);
		}
		$idpb = trim($rs);
	}
	return $idpb;
}
function gettongsoluongDH($iddh){ // $iddh id ordersanxuat
	$soluong = 0;
	if( $iddh > 0 ){
		//$sql = "SELECT SUM(soluong) FROM $GLOBALS[db_catalog].donhangsanxuat WHERE iddh = (SELECT iddh FROM $GLOBALS[db_catalog].ordersanxuat WHERE id=".$iddh." ) ";
		//$rs = $GLOBALS["catalog"]->getOne($sql);
		$sql = "SELECT soluongbandau, soluongdieuchinh FROM $GLOBALS[db_catalog].ordersanxuat WHERE id=".$iddh;
		$rs = $GLOBALS["catalog"]->getRow($sql);
		$soluong = ceil($rs['soluongdieuchinh']) > 0 ? $rs['soluongdieuchinh'] : $rs['soluongbandau'];
	}
	return ceil($soluong);
}
/// Chuyển tổ sản xuất Catalog
function chuyentosanxuatCatalog($iddh ,$phongban, $phongbanchuyen, $soluongchuyen, $chuyentoada=false, $maphieuxk=false, $chuyentoakct=false){
	if ( $iddh > 0 && $phongban > 0 && $phongbanchuyen > 0){	
		$datenow = date('Y-m-d');
		$tinow = date('H:i:s');
		$error = 'Lỗi chuyển toa Web, vui lòng thực hiện lại.';
		$rssx = getRowNameCatalog('midorder,phongbanchuyen,phongtruocchuyen,soluongbandau,idquytrinhsx,quytrinhbosung,trangthaisx,duyetsanxuat,nhapdukien', 'ordersanxuat', " active=1 and id=".$iddh);
		if ( !empty($rssx) ){
			$trangthaisx = $rssx['trangthaisx'];
			$idqtsx = $rssx['idquytrinhsx'];
			$phongtruocchuyen = $rssx['phongbanchuyen'];
			$phongchuyenbefore = $rssx['phongtruocchuyen'];
			$soluongdonhang = gettongsoluongDH($iddh);//$rssx['soluongbandau'];
			$pbchuyen_index = $pbden_index = 0;
			$list = '';
			if ( $idqtsx > 0 ){
				$list = getOneNameCatalog("list","quytrinhsanxuat"," id=".$idqtsx );				
				/*if ($rssx['midorder'] != 7 ){
					$arrcheck = CheckBuocQTSX($iddh,$list);
					if ($arrcheck['numbuoc'] > 1)
						return 'Các SP trong Toa hàng không đồng nhất bước QTSX:\\n'.$arrcheck['mess'];
					else if ($arrcheck['numbuoc'] == 1){
						$arrbp = explode(",",$list);
						$arrbp = array_slice($arrbp, $arrcheck['buocqt']); 
						if ($rssx['nhapdukien'] == 0 && in_array($phongbanchuyen,$arrbp)){
							return 'Bước '.$arrcheck['buocqt'].' Toa hàng chưa nhập dự kiến thực hiện (bắt buộc).';
						}	
					}	
				}*/
			}	
			else if ($idqtsx == 0 && !empty($rssx['quytrinhbosung']) && ($rssx['midorder'] == -1 || $rssx['midorder'] == -2 || $rssx['midorder'] == -3) ){
				$list = $rssx['quytrinhbosung'];
			}
			if ( !empty($list) ){
				$rs = getThutuPhongban($phongban, $phongbanchuyen, $list, $rssx['phongbanchuyen'], $rssx['phongtruocchuyen']);
				$pbchuyen_index = $rs['pbchuyen_index'];
				$pbden_index = $rs['pbden_index'];
			}
			$GLOBALS["catalog"]->BeginTrans();
			try {
					$soluongconlai = 0;
					$arrchuyen = array();
					$wh = " phongbanchuyen=".$phongbanchuyen." AND pbchuyen_index=".$pbchuyen_index." AND idqtsx=".$idqtsx." AND iddh=".$iddh;				
					$soluongphongchuyen = getSoluongDHConlai($phongbanchuyen,$pbchuyen_index,$iddh,$idqtsx); // Số lượng trước chuyển phòng chuyển
					$soluongphongden = getSoluongDHConlai($phongban,$pbden_index,$iddh,$idqtsx);		// Số lượng trước chuyển phòng đến					
					$solanchuyen = getOneNameCatalog("max(solanchuyen)","chuyendonhang_history"," phongbanden=".$phongban." AND pbden_index=".$pbden_index." AND ".$wh );							
					$rsdhda = getRowNameCatalog('id,phongban,pbden_index', 'ordersanxuat', " active=1 and typeorder=1 and pid=".$iddh);
					$rsdhkct = getRowNameCatalog('id,phongban,pbden_index', 'ordersanxuat', " active=1 and typeorder=2 and pid=".$iddh);
					
					///* số lượng còn lại phòng chuyển = '' lấy số lượng trong đơn hàng *///
					if ( ( ($soluongphongchuyen == '') && empty($solanchuyen) ) || ($soluongphongchuyen > $soluongdonhang) ){
						$soluongphongchuyen = ceil($soluongdonhang);
					}
					$arrpbda = $arrpbkc = $arrqtda = $arrqtkc = array();
					if (!empty($list)) {
						$arrtmp = explode(",",$list);
						if (!empty($arrtmp)){
							if (!in_array($phongbanchuyen,$arrtmp))
								$arrtmp[] = $phongbanchuyen;
							if (!in_array($phongban,$arrtmp)){
								if ($phongban != 556)
									$arrtmp[] = $phongban;
								else
									return 'Lỗi chuyển toa Web "Toa Hàng sẽ vô Nguyên Liệu", vui lòng kiểm tra lại.';
							}	
							foreach ($arrtmp as $value){
								$sql = "select id from $GLOBALS[db_catalog].categories where active=1 and idphongbansx=$value and pid=6849"; 
								$rsid = $GLOBALS["catalog"]->getOne($sql);
								$arrpbda[$value] = $arrqtda[] = !empty($rsid) ? $rsid : 0;
								$sql = "select id from $GLOBALS[db_catalog].categories where active=1 and idphongbansx=$value and pid=6851"; 
								$rsid = $GLOBALS["catalog"]->getOne($sql);
								$arrpbkc[$value] = $arrqtkc[] = !empty($rsid) ? $rsid : 0;
							}
						}
					}
					////////***** Chuyen Toa Da *****/////////					
					if ($chuyentoada == 1 && !empty($rsdhda) && !empty($arrqtda)){
						if ($phongban == 80 && $rowda['id'] > 0 ){
							$checkxuatda = getOneInAll("id","khoda_nhapxuat"," iddhsx=$rowda[id] and type=5 and typePTC=2 and phongban=59", "getOne", "db_ketoan", "ketoan");
							if ($checkxuatda <= 0)
								return 'Lỗi chuyển toa Web "Chưa Xuất Kho Đá Kế Toán", vui lòng kiểm tra lại.';
						}						
						
						$phongban_da = getToSanXuatDen($arrqtda, $rsdhda['phongban'], $rsdhda['pbden_index']);
						if ($phongban_da == 0)
							$phongban_da = $arrpbda[$phongban];
						$pbden_index_da = getThutuChuyenDen($arrqtda, $phongban_da, $rsdhda['phongban']);
						if ($phongban_da > 0){
							$sql = "UPDATE $GLOBALS[db_catalog].ordersanxuat  
										SET phongban = ".$phongban_da.",  
											pbden_index = ".$pbden_index_da.", 
											phongbanchuyen = ".$rsdhda['phongban'].", 
											pbchuyen_index = ".$rsdhda['pbden_index'].",
											datechuyen = '".$datenow."',  
											timechuyen = '".$tinow."',
											maphieuxk = '".$maphieuxk."',
											midchuyen = 0
										WHERE  id=".$rsdhda['id'];
							$GLOBALS["catalog"]->execute($sql);
						}						
					}				
					////////***** Chuyen Toa KCT *****/////////					
					if (($chuyentoakct == 1 || $phongban == 80) && !empty($rsdhkct) && !empty($arrqtkc)){
						if ($phongban == 80 && $rsdhkct['id'] > 0 ){
							$checkxuatkct = getOneInAll("id","khoda_nhapxuat"," iddhsx=$rsdhkct[id] and type=5 and typePTC=2 and phongban=290", "getOne", "db_ketoan", "ketoan");
							if ($checkxuatkct <= 0)
								return 'Lỗi chuyển toa Web "Chưa Xuất Kho Đá Kim Cương Tấm", vui lòng kiểm tra lại.';
						}						
						
						if ($rsdhkct['phongban'] == 13706 && $phongban == 80)
							$phongban_kct = 13707;
						else
							$phongban_kct = getToSanXuatDen($arrqtkc, $rsdhkct['phongban'], $rsdhkct['pbden_index']);
						if ($phongban_kct == 0)
							$phongban_kct = $arrpbkc[$phongban];
						$pbden_index_kct = getThutuChuyenDen($arrqtkc, $phongban_kct, $rsdhkct['phongban']);
						
						if ($phongban_kct > 0){
							$sql = "UPDATE $GLOBALS[db_catalog].ordersanxuat  
										SET phongban = ".$phongban_kct.",  
											pbden_index = ".$pbden_index_kct.", 
											phongbanchuyen = ".$rsdhkct['phongban'].", 
											pbchuyen_index = ".$rsdhkct['pbden_index'].",
											datechuyen = '".$datenow."',  
											timechuyen = '".$tinow."',
											maphieuxk = '".$maphieuxk."',
											midchuyen = 0
										WHERE  id=".$rsdhkct['id'];
							$GLOBALS["catalog"]->execute($sql);
						}
					}						
					
					////////**********/////////
					$arrchuyen['iddh'] = $iddh;
					$arrchuyen['idqtsx'] = $idqtsx;
					$arrchuyen['midchuyen'] = trim($_SESSION['admin_qlsxntjcorg_id']);
					$arrchuyen['phongbanchuyen'] = $phongbanchuyen;
					$arrchuyen['pbchuyen_index'] = $pbchuyen_index;
					$arrchuyen['phongbanden'] = $phongban;							
					$arrchuyen['pbden_index'] = $pbden_index;
					$arrchuyen['soluongchuyendi'] = $soluongchuyen;					
					$arrchuyen['soluongconlai'] = $soluongconlai = $soluongphongchuyen-$soluongchuyen; //// Số lượng mới phòng chuyển
					$arrchuyen['soluonghientai'] = $soluonghientai = $soluongphongden+$soluongchuyen;   //// Số lượng mới phòng đến
					$arrchuyen['solanchuyen'] = ceil($solanchuyen)+1;                  // số lần chuyển A->B
					$arrchuyen['datechuyen'] = $datenow;
					$arrchuyen['timechuyen'] = $tinow;
					
					if ( $soluonghientai <= $soluongdonhang ) {
							vaInsertCatalog('chuyendonhang_history', $arrchuyen);		
					}
					
					if ( $soluongconlai == 0 ){ /// chuyển đủ số lượng					
						if ( $trangthaisx == 0 )
							$trangthaisx = getTrangthaiTHSX($rssx['midorder'], $phongban);// Trang thai san xuat
						
						$trangthaidh = getOneNameCatalog("id","cauhoidhsx"," active=1 AND idphong3d=$phongban ORDER BY num ASC LIMIT 1");
						$trangthaidh = ceil($trangthaidh);
						
						$active = 1;
						if ( !empty($rssx['quytrinhbosung']) && ($rssx['midorder'] == -1 || $rssx['midorder'] == -2) ){
							$arrtmp = explode(",",$rssx['quytrinhbosung']);
							$phongcuoiqt = end($arrtmp);
							$arrtmp = array_count_values($arrtmp); 
							if ( $phongcuoiqt == $phongban && $arrtmp[$phongban] == ($pbden_index+1) )
								$active = 2;
						}
						$arrpb = [76,92,93,94,133,146,147,168,680,683,837,850,851,2901,2929,2930,2931,2933,4407,4408,4409,4528,4548,4670];
						if ( !in_array($phongban,$arrpb) && $rssx['duyetsanxuat'] != 2 && $rssx['duyetsanxuat'] != 3 ){
							$active .= ", duyetsanxuat = 2";
						}
						else if ( $phongban == 92 || $phongban == 168 || $phongban == 2929 || $phongban == 680 ){/// Tổ SX thành phẩm, toa hàng sữa chữa
							$active .= ", duyetsanxuat = 3";
						}	
						else if ( $phongban == 4548 ){/// Tổ SX toa hàng HT
							$sql = "UPDATE $GLOBALS[db_catalog].ordersanxuat SET trangthaiswa=4 WHERE typeorder=1 and trangthaiswa=3 and pid=".$iddh;
							$GLOBALS["catalog"]->execute($sql);
						}
						else if ( $phongban == 5721 || $phongban == 167 || $phongban == 80 ){ // Chuyển toa đá
							$rowda = getRowNameCatalog("id,phongban","ordersanxuat", " typeorder=1 and pid=".$iddh);
							
							if ($rowda['id'] > 0)
								$checkxuatda = getOneInAll("id","khoda_nhapxuat"," iddhsx=$rowda[id] and type=5 and phongban=59", "getOne", "db_ketoan", "ketoan");
							else
								$checkxuatda = 0;
							
							if ($phongban == 5721 && $rowda['phongban'] == 6537) 
								$phongbanda = 6539;
							else if ($phongban == 167 && $rowda['phongban'] == 6539)
								$phongbanda = 6540;
							else if ($phongban == 80 && $rowda['phongban'] != 6546 && $checkxuatda > 0)
								$phongbanda = 6546;
							else
								$phongbanda = 0;
							
							if ($phongbanda > 0 && $rowda['id'] > 0){
								$sql = "UPDATE $GLOBALS[db_catalog].ordersanxuat SET phongban=$phongbanda, phongbanchuyen=$rowda[phongban], maphieuxk='".$maphieuxk."' WHERE id=$rowda[id] ";
								$GLOBALS["catalog"]->execute($sql);
							}
						}
						$sqlnew = "UPDATE $GLOBALS[db_catalog].ordersanxuat  
									SET phongban = ".$phongban.",  
										pbden_index = ".$pbden_index.", 
										phongbanchuyen = ".$phongbanchuyen.", 
										pbchuyen_index = ".$pbchuyen_index.", 
										phongtruocchuyen = ".$phongtruocchuyen.", 
										phongchuyenbefore = ".$phongchuyenbefore.", 
										phongbantam = 0, 
										datechuyen = '".$datenow."',  
										timechuyen = '".$tinow."',
										trangthaisx = ".$trangthaisx.",
										trangthaidh = ".$trangthaidh.",
										active = ".$active."
									WHERE  id=".$iddh;
						$GLOBALS["catalog"]->execute($sqlnew);
						///////*Update phongbansx toahang_dukienthuchien*///////
						$sql = "UPDATE $GLOBALS[db_catalog].toahang_dukienthuchien SET phongbansx=$phongban WHERE active=1 and iddh=".$iddh;
						$GLOBALS["catalog"]->execute($sql);
					}
					else if ( $soluongconlai > 0 ){
						///// Thêm phòng ban vào phòng ban tam
						$sql = "UPDATE $GLOBALS[db_catalog].ordersanxuat  
								SET phongbantam = CASE  
													WHEN phongbantam = '' or phongbantam IS NULL THEN '".$phongban."' 
													WHEN phongbantam != '' and FIND_IN_SET($phongban, phongbantam) <= 0 and phongbantam IS NOT NULL THEN CONCAT(phongbantam, ',".$phongban."')															
													ELSE phongbantam
												  END,  
									status = 1, 
									trangthaidh = 0 	  
								WHERE  id=".$iddh;
						$GLOBALS["catalog"]->execute($sql);
					}
					$GLOBALS["catalog"]->CommitTrans(); 
					return true;
				}
			catch(Exception $e){
				$GLOBALS["catalog"]->RollbackTrans();
				return $error;
			}
		}
		else{
			return true;
		}	
	}
	else{
		return true;
	}	
}
///////* Check Toa Đá đã đến tổ theo THSX *///////
function checkPhongbanToaDaTHSX($iddh,$cid,$checkda=1,$checkkc=1){
	$error = 'success';
	if ( $cid > 0 ){
		$sql= "select phongbancatalog from $GLOBALS[db_sp].categories where active=1 and id=$cid";
		$phongbancatalog = $GLOBALS["sp"]->getOne($sql);
		if ( $phongbancatalog > 0 ){
			$sql= "select id,pid,name_vn from $GLOBALS[db_catalog].categories where active=1 and pid IN (6849,6851) and idphongbansx=$phongbancatalog order by pid asc";
			$rs = $GLOBALS["catalog"]->getAll($sql);
			if (!empty($rs) && $iddh > 0 ){
				foreach ($rs as $item){
					if ($item['pid'] == 6849 && $checkda == 1){			
						$sql = "select phongban from $GLOBALS[db_catalog].ordersanxuat where active=1 and typeorder=1 and pid=$iddh";
						$rsda = $GLOBALS["catalog"]->getOne($sql);
						if (!empty($rsda) && ($rsda != $item['id']))
							$error = 'Toa hàng Đá chưa đến "'.$item['name_vn'].'"';
					}
					if ($item['pid'] == 6851 && $checkkc == 1 && $error == 'success'){			
						$sql = "select phongban from $GLOBALS[db_catalog].ordersanxuat where active=1 and typeorder=2 and pid=$iddh";
						$rskc = $GLOBALS["catalog"]->getOne($sql);
						if (!empty($rskc) && ($rskc != $item['id']))
							$error = 'Toa hàng KCT chưa đến "'.$item['name_vn'].'"';
					}
				}
			}	
		}						
	}	
	return $error;	
}
// từ phòng ban chuyển xác định chuyển lên A0,A1,A2
function getThutuPhongban($phongbanden, $phongban, $list, $phongbanchuyen = 0, $phongtruocchuyen = 0){ // Phòng ban đã chuyển cho phongbanchuyen
	$arr = explode(",",$list);
	$rs = array( 'pbden_index' => 0, 'pbchuyen_index' => 0 );
	$skey = getKeyArray($arr, $phongbanden, $phongban, $phongbanchuyen, $phongtruocchuyen);
	if ( ($skey == -1) && !in_array($phongbanden,$arr) ){
		$skey =  count($arr);
		array_push($arr,$phongbanden);		
	}
	$numAllden = getNumPos($arr, $phongbanden, 0);
	$numAll = getNumPos($arr, $phongban, 0);
	if(!empty($skey)){
		$numRightden = getNumPos($arr, $phongbanden, $skey);
		$numRight = getNumPos($arr, $phongban, $skey-1);
	}	
	else{
		$numRightden = $numAllden;
		$numRight = $numAll;
	}
	$rs['pbden_index'] = $numAllden-$numRightden;
	$rs['pbchuyen_index'] = $numAll-$numRight;	
	return $rs;	
}
// trả về số lượng $needle, trong mảng $arr từ start key $skey
function getNumPos($arr, $needle, $skey = 0){ 
	$num = 0;
	$len = count($arr);
	for ($i = $skey; $i< $len; $i++)
		if ($arr[$i] == $needle)
			$num++;
	return $num;	
}
// Trả về key của $needle, cùng $before trước $needle và $front trước $before
function getKeyArray($arr, $needle, $before, $front = 0, $frontbefore = 0){
	$max = count($arr);
	$key = $temp = $temp1 = $temp2 = -1;
	$flag = 0;
	for ($k=0;(($k<$max)&&($flag==0));$k++) {		
		if ( $arr[$k] == $needle ){
			$key = $k;
			if ( $temp == -1 )
				$temp = $key; // Giữ lại phần tử đầu tìm thấy				
			if ( ($k > 0) && ($arr[$k-1] == $before) ) {
				if ( $temp1 == -1 )
					$temp1 = $key;
				if ( ($k > 1) && ($arr[$k-2] == $front) ) {
					if ( $temp2 == -1 )
						$temp2 = $key;
					if ( ($k > 2) && ($arr[$k-3] == $frontbefore) )
						$flag = 1;					
				}				
			}
		}
	}
	$temp = ($temp1 > $temp) ? $temp1 : $temp;
	$temp = ($temp2 > $temp) ? $temp2 : $temp;
	return ( ($temp > -1) && ($flag == 0) ) ? $temp : $key;
}
///// Số lượng còn lại của iddh
function insert_getSoluongDHConlai($a){
	$madhin = $a['madhin'];
	$phongbanden = ceil($a['phongbanden']);	
	if ( $madhin > 0 ) {			
		$sql = "select soluongbandau, phongban, phongbanchuyen, idquytrinhsx from $GLOBALS[db_catalog].ordersanxuat where active=1 and id=".$madhin; 
		$rs = $GLOBALS["catalog"]->getRow($sql);		
	}
	$soluong = !empty($rs) ? $rs['soluongbandau'] : 0;
	if ( $phongbanden  > 0 ) {				
		if ( $rs['idquytrinhsx'] > 0 ) {
			$list = getOneNameCatalog("list","quytrinhsanxuat"," id=".$rs['idquytrinhsx'] );	
			$rsindex = getThutuPhongban($phongbanden, $rs['phongban'], $list, $rs['phongbanchuyen']);
			$soluongconlai = getSoluongDHConlai($rs['phongban'],$rsindex['pbchuyen_index'],$madhin,$rs['idquytrinhsx']);
			if ( $soluongconlai != '' )
				$soluong = $soluongconlai;
		}
	}	
	return $soluong;
}
/// Số lượng còn lại của iddh trong phongban $index > 0 nếu quy trình sx có lặp lại phòng ban 
function getSoluongDHConlai($phongban,$index,$iddh,$idqtsx){
	$soluongconlai = '';
	$wh = " AND iddh=".$iddh." AND idqtsx=".$idqtsx." ORDER BY id DESC LIMIT 1";
	$sql = "SELECT id, soluongconlai FROM $GLOBALS[db_catalog].chuyendonhang_history WHERE phongbanchuyen=".$phongban." AND pbchuyen_index=".$index . $wh;
	$sql1 = "SELECT id, soluonghientai FROM $GLOBALS[db_catalog].chuyendonhang_history WHERE phongbanden=".$phongban." AND pbden_index=".$index . $wh;
	$rs = $GLOBALS["catalog"]->getRow($sql);
	$rs1 = $GLOBALS["catalog"]->getRow($sql1);
	if (!empty($rs) && !empty($rs1)){
		$soluongconlai = (ceil($rs['id']) > ceil($rs1['id'])) ? $rs['soluongconlai'] : $rs1['soluonghientai'];
	}
	else if (!empty($rs)){
		$soluongconlai = $rs['soluongconlai'];
	}
	else if (!empty($rs1)){
		$soluongconlai = $rs1['soluonghientai'];
	}
	return $soluongconlai;
}
function CheckBuocQTSX($iddh,$list=''){	
	$mess = '';
	$buocqt = $numbuoc = 0;
	if ($iddh > 0){
		$sql = "SELECT distinct (buocqtsx-1) AS k,SUBSTRING_INDEX(tosxbuocchonqt,'.',1) AS num FROM $GLOBALS[db_catalog].products_new WHERE id IN (SELECT idpr FROM $GLOBALS[db_catalog].donhangsanxuat WHERE idodsx=$iddh) AND buocqtsx>0";
		$rs = $GLOBALS["catalog"]->getAll($sql);
		$arrqtsx = explode(",",$list);
		if (!empty($rs)){
			foreach ($rs as $item){
				if ($arrqtsx[$item['k']] > 0){
					$sql = "select name_vn from $GLOBALS[db_catalog].categories where id=".$arrqtsx[$item['k']]." and num=$item[num]";
					$rsname = $GLOBALS["catalog"]->getOne($sql);
					if (!empty($rsname)){
						$mess .= "Bước $item[k] - Tổ SX: $rsname \\n";
						$buocqt = $item['k'];
						$numbuoc++;
					}
				}
			} 
		}
	}
	return array('numbuoc'=>$numbuoc,'buocqt'=>$buocqt,'mess'=>$mess);
}
/// trạng thái sản xuất Catalog
function getTrangthaiTHSX($midorder,$phongban){	
	$status=0;
	if ( $midorder>0 ) {
		$sql = "SELECT id FROM $GLOBALS[db_catalog].categories WHERE active=1 AND FIND_IN_SET($midorder,listorder)>0 AND pid=4746";
		$rs = $GLOBALS["catalog"]->getOne($sql);		
		if ( ( ($rs == 4747 || $rs == 5566) && $phongban == 92) || ($rs == 4748 && $phongban == 2929) || ($rs == 4749 && $phongban == 168)|| ($rs == 5567 && $phongban == 556) )
			 $status=1;		
	}
	return $status;
}
/*
function getTrangthaiSX($mid, $phongban) {	
	$status=0;
	if( $mid>0 && $phongban >0 ) {		
		/////load phong ban san xuat
		$sqluid = "select listuser from $GLOBALS[db_catalog].phongkehoachsx where active=1 order by num asc, id asc";
		$rsuid = $GLOBALS["catalog"]->getCol($sqluid);		
		/////load Kho Trang sức phổ thông
		$sqlpt = "select id from $GLOBALS[db_catalog].categories  where active=1 and pid=363 order by num asc, id desc"; 
		$rspt = $GLOBALS["catalog"]->getCol($sqlpt);			
		
		$khsxsi=explode(",",$rsuid[0]); //khsx sỉ
		$khsxcongty=explode(",",$rsuid[1]);//khsx cty
		$khsxcongty=array_diff($khsxcongty,[66]);//tru domau
		
		if((in_array($mid,$khsxsi))&&(in_array($phongban,$rspt))) $status=1;
		if($mid==111 && $phongban==728) $status=1;//Phòng Ép khuôn, 111:khuonmau
		//Đồ nhà
		if($mid==66 && ($phongban==168 || $phongban==680)) $status=1; //66:domau, 168:P.Kho lưu mẫu, 680: Tổ Chờ Đúc Bổ Sung
		if((in_array($mid,$khsxcongty)) && $phongban==92) $status=1;//P.Kho thành phẩm
	}
	return $status;
}
*/
/// END trạng thái sản xuất Catalog

///* Chuyen Toa hang Da *///
function getToSanXuatDen($arr, $id, $id_index=0){ // id: phongban	
	$len = count($arr);
	$key = $temp = -1;
	$flag = $index = 0;
	for ($k=0;($k<$len)&&($flag==0);$k++){		
		if ( $arr[$k] == $id ){
			$key = $k;
			if ( ($k < ($len-1) &&  ($arr[$k] == $arr[$k+1]) ) )
				$key = $k+1; // Bỏ qua 2 phòng giống nhau liên tiếp
			if ( $temp == -1 )
				$temp = $key; // Giữ lại phần tử đầu tìm thấy
			if ( $index == $id_index )
				$flag = 1;			
			$index++;
		}
	}
	if ( ($temp > -1) && ($flag == 0) ) 
		$key = $temp;
	if ( $key < ($len-1) && ($key > -1) ){
		$idden = $arr[$key+1];
	}
	else{ 
		$idden = 0;
	}
	return $idden;
}
function getThutuChuyenDen($arr, $needle, $before){
	$max = count($arr);
	$temp = -1;
	$flag = $index = 0;
	for ($k=0;($k<$max)&&($flag==0);$k++){		
		if ( $arr[$k] == $needle ){			
			if ( $temp == -1 )
				$temp = $index; // Giữ lại phần tử đầu tìm thấy				
			if ( ($k > 0) && ($arr[$k-1] == $before) )		
				$flag = 1;
			$index++;
		}
	}
	return ($temp>-1)&&($flag == 0) ? $temp : (($index>1) ? $index-1 : 0);
}
///////*End Chuyen Toa hang Da*///////

function geturlbarcode($code){
	global $urlCatalog;
	$imgurl = '';
	if(!empty($code)){
		$imgurl = "filetype=PNG&dpi=72&thickness=20&scale=2&rotation=0&font_family=Arial.ttf&font_size=0";
		$imgurl .= "&text=".stripslashes($code)."&code=BCGcode39";
		$imgurl = $urlCatalog."admindir/barcode/html/image.php?".$imgurl;		
	}
	return $imgurl;
}
/////* Cong donhang Limit */////
function insert_optionChoDonHangCatalogLimit($a){
	$cid = ceil($a['cid']);
	$madhin = $a['madhin'];
	$codeNL = $a['codeNL'];
	return getoptionChoDonHangCatalogLimit($madhin,$cid,$codeNL);
}

function getoptionChoDonHangCatalogLimit($madhin,$cid,$codeNL=''){
 	$html = '';
	$arrmadh = array();
	$check = 0;
	if ($cid > 0) {
		if ( $codeNL == 'BH' ){
			$rsctl = array(array('id'=>'-2','code'=>'SP bảo hành')); $check = 1;
		}	
		else if ($codeNL == 'BT' || $codeNL == '' ) {
			$sql = "select phongbancatalog from $GLOBALS[db_sp].categories where id=".$cid;
			$rs = $GLOBALS["sp"]->getOne($sql);
			
			if(!empty($rs)){
				if($rs == 76)
					$phongbancatalog = '76,0';
				else
					$phongbancatalog = $rs;
			}
			else{ ///////// kg có xuất dữ liệu
				$phongbancatalog = ' -1 ';	
			}
			
			$sqlhistory = "SELECT DISTINCT iddh FROM $GLOBALS[db_catalog].donhangsanxuat_history WHERE phongbanden IN (".$phongbancatalog.") AND DATEDIFF(CURDATE(),dated) <= 7 ";
			$rshistory = $GLOBALS["catalog"]->getCol($sqlhistory);
			
			if (!empty($rshistory)){
				$stridhd = implode(",",$rshistory);
				$sqlctl = "select id, code from $GLOBALS[db_catalog].ordersanxuat where active=1 and (( id IN (".$stridhd.") and phongban not IN (".$phongbancatalog.") and datechuyen=CURDATE() ) or id=-1 ) and huydh=0 order by id desc";
			}
			else
				$sqlctl = "select id, code from $GLOBALS[db_catalog].ordersanxuat where id=-1 and huydh=0 order by id desc";
			/*$sqlctl = "select id, code from $GLOBALS[db_catalog].ordersanxuat where ( phongbanchuyen in(".$phongbancatalog.") or id=-1 ) and huydh=0 order by id desc"; */
			$rsctl = $GLOBALS["catalog"]->getAll($sqlctl);
		}
		else{
			$rsctl = array(array('id'=>'-1','code'=>'Không Đơn Hàng')); $check = 1;
		}
		
		if ( !empty($madhin) ){
			$arrmadh = explode(",",$madhin);
		}
		
		foreach($rsctl as $item){
			$selected = "";
			if ( in_array($item['id'], $arrmadh ) || $check == 1 )
				$selected = "selected";
			$html .= "<option ".$selected."  value='".$item['id']."' > ".$item['code']." </option>";
		}
	}	
	return  $html;
}

function insert_optionKhoSanXuatChonPhongLimit($a){
	$chonphongbanin = ceil($a['chonphongbanin']);
	$madhin = $a['madhin'];
	$cid = ceil($a['cid']);
	$id = $a['id']; // ID phòng khác
	return getoptionKhoSanXuatChonPhongLimit($madhin,$chonphongbanin,$id,$cid);
}

function getoptionKhoSanXuatChonPhongLimit($madhin,$chonphongbanin,$id,$cid){ //$id ID phòng đến khác, $cid xuất kho
	
	$str = '';	
	if ( !empty($madhin) && strpos($madhin, '-1') === false && strpos($madhin, '-2') === false ){
		$rs = array();
		$sqlphongban = "select phongbancatalog from $GLOBALS[db_sp].categories where id=".$cid;
		$rsphongban = $GLOBALS["sp"]->getOne($sqlphongban);
		if (!empty($rsphongban)){			
			$sqlphongbanden = "select DISTINCT phongbanden from $GLOBALS[db_catalog].donhangsanxuat_history where iddh IN (". $madhin .") AND phongbanchuyen IN (".$rsphongban.") AND phongbanden NOT IN (".$rsphongban.") AND phongbanden !=0 AND phongbanden !=76";
			$rsphongbanden = $GLOBALS["catalog"]->getCol($sqlphongbanden);
			 if (!empty($rsphongbanden)){
				 foreach ($rsphongbanden as $pb){
					//$sql = "select id, maphongban from $GLOBALS[db_sp].categories where pid IN ( SELECT pid FROM $GLOBALS[db_sp].categories WHERE FIND_IN_SET(".$pb.",phongbancatalog) > 0  AND num=1 ) and num=0 and active=1 order by num asc, id asc";
					$sql = "select id, maphongban from $GLOBALS[db_sp].categories where pid IN ( SELECT pid FROM $GLOBALS[db_sp].categories WHERE FIND_IN_SET(".$pb.",phongbancatalog) > 0  AND typenx=2 ) and typenx=1 and active=1 order by num asc, id asc";
					$row = $GLOBALS["sp"]->getRow($sql); 
					if (!empty($row))
						$rs[] = $row; 
				 }
			 }
		}
	}
	else {
		$idoption = '379,388,404,416,428,440,452,464,476,488,500,512,524,536,548,560,572,584,599,611,623,635,647,659,671,683,695,727,752,798,1776,1524,1556,1569,1582,1614,1689,1786,1960,2321,2333,2345,2357,2369,2381,2393,2405,2417,2429,2441,2453,2465,2477';
		//$idoption = '379,388,404,416,428,440,452,464,476,488,500,512,524,536,548,560,572,584,599,611,623,635,647,659,671,683,695,727,752,798,1776,1524,1556,1569,1582,1614,1689,1786,1960';
		//$idoption = getAllChoNhapKho(16); // 16 Kho sản xuất
		$noid = getChoNhapKho_XuatKho($cid);
		$wh = '';
		if(!empty($noid))
			$wh = " and id NOT IN (".$noid.") ";
			
		$sql = "select id, maphongban from $GLOBALS[db_sp].categories where id IN (".$idoption.") and active=1 $wh order by num asc, id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
	}
	
	foreach($rs as $item){
		$selected = '';
		if($chonphongbanin == $item['id'])
			$selected = "selected";
		$title = getLinkTitle($item['id'],1);			
		if(!empty($title)){
			$title = explode('&raquo;',$title);
			$title = $title[1];	
		}
		$str .= "<option value='".$item['id']."' ".$selected."> ".$item['maphongban']." : ".$title."</option>";		
	}
	
	if(!empty($id)){
		$str .= getoptionChuyenDenSelected($chonphongbanin,$id);
	}	

	return $str;
}

function getoptionChuyenDenSelected($chonphongbanin,$id){ //$chonphongbanin: phòng đã chọn, $id: list ID phòng đến
	$str = '';	
	if (!empty($id)) {
		$sql1 = "select id, maphongban from $GLOBALS[db_sp].categories where id IN (".$id.") and active=1 order by FIELD(id,$id) ";
		$rs1 = $GLOBALS["sp"]->getAll($sql1);
		foreach ($rs1 as $item) {
			$selected = '';
			if ($chonphongbanin == $item['id'])
				$selected = "selected";
			$title = getLinkTitle($item['id'],1);
			$str .= "<option value='".$item['id']."' ".$selected."> ".$item['maphongban']." : ".$title."</option>";		
		}
	}
	return $str;
}

function getNameKhoSanXuat($id){ ///  $id xuatkho, nhapkho
	$rs = '';
	if ($id > 0) {
		$sql = "SELECT if (numphong>0,concat(numphong,'. ',name_vn),name_vn) as name_vn FROM $GLOBALS[db_sp].categories WHERE id IN (SELECT pid FROM $GLOBALS[db_sp].categories WHERE id IN (SELECT pid FROM $GLOBALS[db_sp].categories WHERE id=". $id ."))";
		$rs = $GLOBALS["sp"]->getOne($sql);
	}
	return $rs;
}

function getAllChoNhapKho($id){ /// all id ChoNhapKho to str $id kho chính
	$sqlid = "SELECT id FROM $GLOBALS[db_sp].categories WHERE pid=". $id;
	$rsid = $GLOBALS["sp"]->getCol($sqlid);
	$arrid = array();
	if ( !empty($rsid) ){
		foreach ( $rsid as $item){
			//$sql = "SELECT id FROM $GLOBALS[db_sp].categories WHERE pid IN (SELECT id FROM $GLOBALS[db_sp].categories WHERE pid=" . $item . " AND num=0) AND num=0";
			$sql = "SELECT id FROM $GLOBALS[db_sp].categories WHERE pid IN (SELECT id FROM $GLOBALS[db_sp].categories WHERE pid=" . $item . " AND num=0) AND typenx=1";
			$arrid[] = $GLOBALS["sp"]->getOne($sql);
		}
	}
	return ( !empty($arrid) ) ? implode(",",$arrid): '';
}

function getChoNhapKho_XuatKho($id){ ///  $id xuatkho
	$sqlid = "SELECT id FROM $GLOBALS[db_sp].categories WHERE pid IN (SELECT pid FROM $GLOBALS[db_sp].categories WHERE id=". $id .") AND typenx=1";
	$rsid = $GLOBALS["sp"]->getOne($sqlid);	
	return ceil($rsid);
}
/////* Cong donhang Limit End */////

function insert_optionChoDonHangCatalog($a){
	$cid = ceil($a['cid']);
	$madhin = ceil($a['madhin']);
	/*
	if($madhin == -1)
		$khongdh = "<option selected value='-1' > Không đơn hàng </option>";
	else
		$khongdh = "<option value='-1' > Không đơn hàng </option>";
	/	
	$sql = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rs = $GLOBALS["sp"]->getRow($sql);
	if(!empty($rs['phongbancatalog'])){
		if($rs['phongbancatalog'] == 76)
			$phongbancatalog = '76,0';
		else
			$phongbancatalog = $rs['phongbancatalog'];
	}
	else{ ///////// kg có xuất dữ liệu
		$phongbancatalog = ' -1 ';	
	} 
	$sql = "select phongbancatalog from $GLOBALS[db_sp].categories where id=".$cid;
	$phongbancatalog = $GLOBALS["sp"]->getOne($sql);
	
	if ( $phongbancatalog == 76 ) 
		$phongbancatalog = '76,0';
	else if ( empty($phongbancatalog) )
		$phongbancatalog = ' -1 ';
	*/
	$sql = "select id from $GLOBALS[db_catalog].categories where pid IN (5637,5638) ";
	$rs = $GLOBALS["catalog"]->getCol($sql);
	$html = '';
	if (!empty($rs)) {
		$phongbancatalog = implode(",",$rs);
		$sqlctl = "select id, code from $GLOBALS[db_catalog].ordersanxuat where ( phongban in(".$phongbancatalog.") or id=-1 or id=$madhin ) and pid=0 and huydh=0 order by id desc"; 
		$rsctl = $GLOBALS["catalog"]->getAll($sqlctl);	
		foreach($rsctl as $item){
			$selected = "";
			if($madhin == $item['id'])
				$selected = "selected";
			$html .= "<option ".$selected."  value='".$item['id']."' > ".$item['code']." </option>";
		}
	}
	return $html;
}

function insert_getSelectOptionPhongBan($a){
	$str = $a['str'];

	$sql = "select * from $GLOBALS[db_catalog].categories where pid IN (363,5636,5637,5638,5639,5650) and id NOT IN (535,133,94) and active=1 order by FIELD(pid,5636,5650,5637,5638,5639,363), num asc, id asc"; 
	$rs = $GLOBALS["catalog"]->getAll($sql);
	if($str){
		$str = explode(',',$str);		
		foreach($rs as $item){
			if(in_array($item['id'],$str))
				$selected = "selected";
			else
				$selected = "";
			$html .= "<option ".$selected."  value='".$item['id']."' > ".$item['name_vn']." </option>";
		}
	}
	else{
		foreach($rs as $item){
			$html .= "<option value='".$item['id']."' > ".$item['name_vn']." </option>";
		}	
	}
	return $html;
}
function insert_getSelectOption($a){
	$str = $a['str'];
	$table = $a['table'];
	$value = $a['value'];
	$wh = $a['wh'];
	$get = $a['get'];
	$sql = "select * from $GLOBALS[db_sp].$table where $wh order by $get asc, num asc, id asc";
	$rs = $GLOBALS["sp"]->getAll($sql);
	if($str){
		$str = explode(',',$str);		
		foreach($rs as $item){
			if(in_array($item['id'],$str))
				$selected = "selected";
			else
				$selected = "";
				$html .= "\n<option ".$selected."  value='".$item[$get]."' > ".$item[$value]." </option>\n";
		}
	}
	else{
		foreach($rs as $item){
			$html .= "\n<option value='".$item[$get]."' > ".$item[$value]." </option>\n";
		}
	}
	return $html;
}
function insert_getPhongBan($a){
	global $path_url,$lang;
	$cid = $a['cid'];
	$title =  getLinkTitle($cid ,1);
	if(!empty($title)){
		$title = explode('&raquo;',$title);
		$title = $title[0] .'&raquo;'. $title[1];	
	}
	
	return $title;
	/*
	global $path_url,$lang;
	
	$cid = $a['cid'];
	$live = $a['live'];
	$sql = "select * from $GLOBALS[db_sp].categories where id=$cid";
	$item = $GLOBALS["sp"]->getRow($sql);
	if($item["pid"] == 2)
		$str=$item["name_vn"];

	if($item['pid'] != 2)
		return getPhongBan($item["pid"],2);	
	else
		return $str;	
		*/
}

function getPhongBan($cid,$live){
	global $path_url,$lang;
	$sql = "select * from $GLOBALS[db_sp].categories where id=$cid";
	$item = $GLOBALS["sp"]->getRow($sql);
	if($item["pid"] == 2)
		$str=$item["name_vn"];
	if($item['pid'] != 2)
		return getPhongBan($item["pid"],2);	
	else
		return $str;	
}

function getLinkTitle($cid,$live){
	//global $path_url,$lang;
	$sql = "select pid,name_vn from $GLOBALS[db_sp].categories where id=$cid";
	$item = $GLOBALS["sp"]->getRow($sql);
	/*if($item["pid"] == 2)
		$str=$item["name_vn"];
	else{
		//if($live == 1)
			$str=' &raquo; ' .$item["name_vn"].'';
		//else
			//$str=' => ' .$item["name_vn"];
	}*/
	if ($item['pid'] != 2)
		return getLinkTitle($item["pid"],2).' &raquo; ' .$item["name_vn"];	
	else
		return $item["name_vn"];	
}

// M.Tân thêm ngày 22/07/2021 - getLinkTitleKeToan database Kế toán
function getLinkTitleKeToan($cid,$live){
	global $path_url,$lang;
	$sql = "select * from $GLOBALS[db_ketoan].categories where id=$cid";
	$item = $GLOBALS['ketoan']->getRow($sql);
	if($item["pid"] == 2)
		$str=$item["name_vn"];
	else{
		//if($live == 1)
			$str=' &raquo; ' .$item["name_vn"].'';
		//else
			//$str=' => ' .$item["name_vn"];
	}
	if($item['pid'] != 2)
		return getLinkTitleKeToan($item["pid"],2).$str;	
	else
		return $str;	
}
//====================//
function insert_getLinkTitleKeToan($a){
	global $path_url,$lang;
	$cid = $a['cid'];
	$live = $a['live'];
	$sql = "select * from $GLOBALS[db_ketoan].categories where id=$cid";
	$item = $GLOBALS['ketoan']->getRow($sql);
	if($item["pid"] == 2)
		$str=$item["name_vn"];
	else{
		//if($live == 1)
			$str=' &raquo; ' .$item["name_vn"].'';
		//else
			//$str=' => ' .$item["name_vn"];
	}
	if($item['pid'] != 2)
		return getLinkTitleKeToan($item["pid"],2).$str;	
	else
		return $item["name_vn"];
		
}
//====================//
function insert_getLinkTitle($a){
	$cid = $a['cid'];
	$live = $a['live'];

	//global $path_url,$lang;
	$sql = "select pid,name_vn from $GLOBALS[db_sp].categories where id=$cid";
	$item = $GLOBALS["sp"]->getRow($sql);
	/*if($item["pid"] == 2)
		$str=$item["name_vn"];
	else{
		//if($live == 1)
			$str=' &raquo; ' .$item["name_vn"].'';
		//else
			//$str=' => ' .$item["name_vn"];
	}*/
	if ($item['pid'] != 2) {
		$str = getLinkTitle($item["pid"],2).' &raquo; ' .$item["name_vn"];
		$str = explode('&raquo;',$str);
		$num = count($str);
		if ( $num > 4 )
			$str = $str[1].'&raquo;'.$str[2];
		else
			$str = $str[0].'&raquo;'.$str[1];
		return $str;	
	}
	else {
		//$str = explode('&raquo;',$str);
		//$str = $str[0].'&raquo;'.$str[1];
		return $item["name_vn"];		
	}	
}

function getNameCap1($cid,$live){
	global $path_url,$lang;
	$sql = "select * from $GLOBALS[db_sp].categories where id=$cid";
	$item = $GLOBALS["sp"]->getRow($sql);
	if($item["pid"] == 2)
		$str=$item["name_vn"];
	else{
		//if($live == 1)
			$str=';' .$item["name_vn"];
		//else
			//$str=' => ' .$item["name_vn"];
	}
	
	
	if($item['pid'] != 2)
		return getNameCap1($item["pid"],2).$str;	
	else
		return $str;	
}


function insert_getCountAll($a){
	$table = $a['table'];
	$id = $a['id'];
	$wh = $a['wh'];
	if($id > 0 || !empty($wh)){
		if($wh)
			$sql = "select count(id) from $GLOBALS[db_sp].".$table." where $wh ";
		else
			$sql = "select count(id) from $GLOBALS[db_sp].".$table." where pid= ".$id;
		$rs = $GLOBALS["sp"]->getOne($sql);
	}
	return ceil($rs);
}


function insert_getTinhTrang($a){
	$idphongban = $a['idphongban'];
	if($idphongban > 0){
		$sql = "select * from $GLOBALS[db_sp].categories where id= ".$idphongban;
		$rs = $GLOBALS["sp"]->getRow($sql);
		$nameshow = getName('categories', 'name_vn', $rs['pid']) .' => '. $rs['name_vn'];
	}
	return $nameshow;
}
function getTableAll($table,$wh){
	$sql = "select * from $GLOBALS[db_sp].".$table." where 1=1 $wh";
	$rs = $GLOBALS["sp"]->getAll($sql);
	return $rs;
}

function getTableRow($table,$wh){
	$sql = "select * from $GLOBALS[db_sp].".$table." where 1=1 $wh";
	$rs = $GLOBALS["sp"]->getRow($sql);
	return $rs;
}

function insert_getTableRow($a){
	$table = $a['table'];
	$id = $a['id'];
	$sql = "select * from $GLOBALS[db_sp].".$table." where id=$id";
	$rs = $GLOBALS["sp"]->getRow($sql);
	
	//print_r($rs); die();
	return $rs;
}

function convertMaso($so){
	$leng = strlen($so);
	if($leng==1)
		$so = '00000'.$so;
	elseif($leng==2)
		$so = '0000'.$so;
	elseif($leng==3)
		$so = '000'.$so;
	elseif($leng==4)
		$so = '00'.$so;
	elseif($leng==5)
		$so = '0'.$so;
	else
		$so = $so;	
	return $so;	
}
function convertMahopdong($so){
	$leng = strlen($so);
	if($leng==1)
		$so = '000'.$so;
	elseif($leng==2)
		$so = '00'.$so;
	elseif($leng==3)
		$so = '0'.$so;
	else
		$so = $so;	
	return $so;	
}
function insert_getSelectOptionKimCuong($a){
	$str = $a['str'];
	$otionKimCuong = $a['otionKimCuong'];
	if(!empty($otionKimCuong)){
		$sql = "select * from $GLOBALS[db_sp].loaikimcuonghotchu where active=1 and id in (".$otionKimCuong.") order by name_vn asc, id asc"; 
		$rs = $GLOBALS["sp"]->getAll($sql);
		if($str){
			$str = explode(',',$str);		
			foreach($rs as $item){
				if(in_array($item['id'],$str))
					$selected = "selected";
				else
					$selected = "";
				$html .= "<option ".$selected."  value='".$item['id']."' > ".$item['size']."::".$item['name_vn']." </option>";
			}
		}
		else{
			foreach($rs as $item){
				$html .= "<option value='".$item['id']."' > ".$item['size']."::".$item['name_vn']." </option>";
			}	
		}
	}
	return $html;
}

function insert_loadloaivang($a){
	global $path_url;
	$idloaivang = $a['idloaivang'];
	$checkdisabled = $a['checkdisabled'];
	$idnum = $a['idnum'];
	$limitloaivang = trim($a['limitloaivang']);
	$wh = "";
	if (!empty($limitloaivang)){
		$wh = " and id in ($limitloaivang) ";
	}
	$sql = "select * from $GLOBALS[db_sp].loaivang where active=1 $wh order by num asc, id asc"; 
	$rs = $GLOBALS["sp"]->getAll($sql);
	$disabled = '';
	if($checkdisabled == 1){
		$disabled = 'disabled="disabled"';	
	}
	foreach($rs as $item){
		if($idloaivang == $item['id'])
			$checked = "selected";
		else
			$checked = ""; 
		$html .= "<option ".$checked." value='".$item['id']."' > ".$item['name_vn']."  </option>";
	}
	
	$html = '
		<select class="selectOption" id="idloaivang'.$idnum.'" name="idloaivang[]" onChange="checkLoaiVangInt('.$idnum.', this.value)" >
             <option value="">--Chọn loại vàng--</option>
			 '.$html.'
		</select>
	';
	return $html;
}
function loadloaivang($idloaivang,$checkdisabled,$idnum,$limitloaivang=""){
	global $path_url;
	$wh = "";
	if (!empty($limitloaivang)){
		$wh = " and id in ($limitloaivang) ";
	}
	$sql = "select * from $GLOBALS[db_sp].loaivang where active=1 $wh order by num asc, id asc"; 
	$rs = $GLOBALS["sp"]->getAll($sql);
	$disabled = '';
	if($checkdisabled == 1){
		$disabled = 'disabled="disabled"';	
	}
	foreach($rs as $item){
		if($idnhomda == $item['id'])
			$checked = "selected";
		else
			$checked = ""; 
		$html .= "<option ".$checked." value='".$item['id']."' > ".$item['name_vn']."  </option>";
	}
	
	$html = '
		<select id="idloaivang'.$idnum.'" name="idloaivang[]" onChange="checkLoaiVangInt('.$idnum.', this.value)" >
			<option value="">--Chọn loại vàng--</option>
			'.$html.'
		</select>
	';
	return $html;
}
function getKhoKhacKhoTongDeCucVangton($idmaphieu, $cannangv, $toDate){
	$tongton = 0;
	$wh = '';
	///////////load tuoi vang thu
	$sql = "select sum(tlvangcat) from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac where idmaphieu=".$idmaphieu. $wh; 
	$ttlvangcat = $GLOBALS["sp"]->getOne($sql);
	$tongton = $cannangv - $ttlvangcat; 
	return $tongton;
}
function insert_getKhoKhacKhoTongDeCucVangton($a){
	global $path_url;
	$toDate = $a['todays'];
	$idmaphieu = $a['idmaphieu'];
	$cannangv = $a['cannangv'];
	$tongton = 0;
	$wh = '';
	if(!empty($toDate)){			
		$toDate = explode('/',$toDate);
		$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		$wh.=' and dated <= "'.$toDate.'"  ';
	}

	///////////load tuoi vang thu
	$sql = "select sum(tlvangcat) from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac where idmaphieu=".$idmaphieu. $wh; 
	$ttlvangcat = $GLOBALS["sp"]->getOne($sql);
	$tongton = $cannangv - $ttlvangcat; 
	return $tongton;
}
function getKhoKhacKhoTongDeCucVangxuatkho($idmaphieu, $cannangv, $fromDate, $toDate){
	$tongton = 0;
	$wh = '';
	if(!empty($fromDate)){
		$wh.=' and dated >= "'.$fromDate.'"  ';
	}
	if(!empty($toDate)){			
		$wh.=' and dated <= "'.$toDate.'"  ';
	}
	$sql = "select sum(tlvangcat) from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac where idmaphieu=".$idmaphieu. $wh; 
	$ttlvangcat = $GLOBALS["sp"]->getOne($sql);
	return $ttlvangcat;	
}
function insert_getKhoKhacKhoTongDeCucVangxuatkho($a){
	global $path_url;
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$idmaphieu = $a['idmaphieu'];
	$cannangv = $a['cannangv'];
	$tongton = 0;
	$wh = '';
	if(!empty($fromDate)){
		$fromDate = explode('/',$fromDate);
		$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		$wh.=' and dated >= "'.$fromDate.'"  ';
	}
	if(!empty($toDate)){			
		$toDate = explode('/',$toDate);
		$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		$wh.=' and dated <= "'.$toDate.'"  ';
	}
	$sql = "select sum(tlvangcat) from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac where idmaphieu=".$idmaphieu. $wh; 
	$ttlvangcat = $GLOBALS["sp"]->getOne($sql);
	return $ttlvangcat;
}

function insert_checkKSXKThanhPhamXuatKho($a){
	$id = ceil($a['id']);
	$rs = 0;
	if($id > 0){
		$sql = "select trangthai from $GLOBALS[db_sp].khosanxuat_khothanhpham where id=".$id; 
		$rs = $GLOBALS["sp"]->getOne($sql);
	}
	 return $rs;
}


function insert_checkKhoanTuNgayDenNgayNhapKho($a){
	$dated = $a['dated'];
	$fromdays = $a['fromdays'];
	$todays = $a['todays'];
	$strcheck = 0;
	if(!empty($dated)){
		if(strtotime($dated) >= strtotime($fromdays) and  strtotime($dated) <= strtotime($todays))
			$strcheck = 1;
	}
	if(empty($todays) && empty($fromdays))
		$strcheck = 1;
	 return $strcheck;
}

function insert_getNamPhongBanCatalog($a){
	$str = $a['str'];
	$html = '';
	if(!empty($str)){
		$sql = "select * from $GLOBALS[db_catalog].categories where id in(".$str.") order by num asc, id desc"; 
		$rs = $GLOBALS["catalog"]->getAll($sql);
		foreach($rs as $item){
			$html .= " - ".$item['name_vn']." <br/>";
		}
	}
	return $html;
}



function insert_checkKhoanTuNgayDenNgayXuatKho($a){
	$datedxuat = $a['datedxuat'];
	$fromdays = $a['fromdays'];
	$todays = $a['todays'];
	$strcheck = 0;
	if(!empty($datedxuat)){
		if(strtotime($datedxuat) >= strtotime($fromdays) and  strtotime($datedxuat) <= strtotime($todays))
			$strcheck = 1;
		if(empty($todays) && empty($fromdays))
			$strcheck = 1;
	}
	 return $strcheck;
}

/*==============Thống kê Kho Nguồn Vào Tồn Kho==================*/
function insert_thongKeKhoNguonVaoTonHienTai($a){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['tablect'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
		$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=2 and idloaivang = ".$idloaivang." limit 1";
		$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
		if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
			$datedauthang = date("Y").'-'.date("m").'-01';
			/////////////////////get số lượng hao dư
			$sqlhaodu = "select SUM(hao) as hao, SUM(du) as du from $GLOBALS[db_sp].".$tablehachtoan." 
						 where idloaivang=".$idloaivang." 
						 and dated <= '".$datedauthang."'
			";
			$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

			////////////////get số tồn hiện tại
			$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
			$rston = $GLOBALS['sp']->getRow($sqlton);
			
			$slton = round(($rston['sltonv'] - $rshaodu['hao']),3) + $rshaodu['du'];
			
			$arrlist['slhao'] = $rshaodu['hao'];
			$arrlist['sldu'] = $rshaodu['du'];
			
			$arrlist['slnhap'] = $rston['slnhapv'];
			$arrlist['slxuat'] = $rston['slxuatv'];
			$arrlist['slton'] = $slton;
			$arrlist['idloaivang'] = $idloaivang;	
			$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

function thongKeKhoNguonVaoTonHienTai($cid, $idloaivang){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['tablect'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
		$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=2 and idloaivang = ".$idloaivang." limit 1";
		$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
		if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
			$datedauthang = date("Y").'-'.date("m").'-01';
			/////////////////////get số lượng hao dư
			$sqlhaodu = "select SUM(hao) as hao, SUM(du) as du from $GLOBALS[db_sp].".$tablehachtoan." 
						 where idloaivang=".$idloaivang." 
						 and dated <= '".$datedauthang."'
			";
			$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

			////////////////get số tồn hiện tại
			$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
			$rston = $GLOBALS['sp']->getRow($sqlton);
			
			$slton = round(($rston['sltonv'] - $rshaodu['hao']),3) + $rshaodu['du'];
			
			$arrlist['slhao'] = $rshaodu['hao'];
			$arrlist['sldu'] = $rshaodu['du'];
			
			$arrlist['slnhap'] = $rston['slnhapv'];
			$arrlist['slxuat'] = $rston['slxuatv'];
			$arrlist['slton'] = $slton;
			$arrlist['idloaivang'] = $idloaivang;	
			$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

function insert_thongKeKhoNguonVaoTonKho($a){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$datenow = date("Y-m-d");
	
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['tablect'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=2 and typevkc=1  and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(round(($rston['sltonv'] - $rshaodu['hao']),3) + $rshaodu['du'],3);					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);					
					$thangdauky = $rstonsddk['dated']; 
					
					/////////////////////get số lượng từ ngày đến đầu tháng
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=2
									and typevkc=1
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					var_dump($rshaodu);
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and trangthai = 2 
									and typevkc=1
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					//die($sqlxuattndt);
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=2
									 and typevkc=1
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
					            where idloaivang=".$idloaivang."
								and trangthai=2 
								and typevkc=1
								and datedxuat >= '".$fromDate."'  
								and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					$slton = $sltonsddk + $sltontndn;
					var_dump($rshaodu);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];

					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

function thongKeKhoNguonVaoTonKho($cid, $idloaivang, $fromDate, $toDate){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	//$cid = ceil(trim($a['cid']));
	//$idloaivang = ceil(trim($a['idloaivang']));
	
	//$fromDate = $a['fromdays'];
	//$toDate = $a['todays'];
	$datenow = date("Y-m-d");
	
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['tablect'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=2 and typevkc=1  and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(round(($rston['sltonv'] - $rshaodu['hao']),3) + $rshaodu['du'],3);					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);					
					$thangdauky = $rstonsddk['dated']; 
					
					/////////////////////get số lượng từ ngày đến đầu tháng
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=2 
									and typevkc=1
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and trangthai = 2 
									and typevkc=1
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=2
									 and typevkc=1
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
					            where idloaivang=".$idloaivang."
								and trangthai=2 
								and typevkc=1
								and datedxuat >= '".$fromDate."'  
								and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					$slton = $sltonsddk + $sltontndn;
					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];

					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;	
}
/*==============Thống kê phòng sản xuất Tồn Hiện Tại==================*/
function insert_thongKeTonHienTaiKhoSanXuat($a){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
		$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
		$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
		if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
			$datedauthang = date("Y").'-'.date("m").'-01';
			/////////////////////get số lượng hao dư
			$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech,  ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
						 where idloaivang=".$idloaivang." 
						 and dated <= '".$datedauthang."'
			";
			$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

			////////////////get số tồn hiện tại
			$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
			$rston = $GLOBALS['sp']->getRow($sqlton);
			
			$slton = round(($rston['sltonv'] - $rshaodu['hao']),10) + $rshaodu['du'];
			$slton = round(($slton - $rshaodu['haochenhlech']),10) + $rshaodu['duchenhlech'];
			
			$arrlist['slhao'] = $rshaodu['hao'];
			$arrlist['sldu'] = $rshaodu['du'];
			
			$arrlist['slnhap'] = $rston['slnhapv'];
			$arrlist['slxuat'] = $rston['slxuatv'];
			$arrlist['slton'] = $slton;
			$arrlist['idloaivang'] = $idloaivang;	
			$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

function thongKeTonHienTaiKhoSanXuat($cid,$idloaivang){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	//$cid = ceil(trim($a['cid']));
	//$idloaivang = ceil(trim($a['idloaivang']));
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
		$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
		$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
		if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
			$datedauthang = date("Y").'-'.date("m").'-01';
			/////////////////////get số lượng hao dư
			$sqlhaodu = "select SUM(hao) as hao, SUM(du) as du from $GLOBALS[db_sp].".$tablehachtoan." 
						 where idloaivang=".$idloaivang." 
						 and dated <= '".$datedauthang."'
			";
			$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

			////////////////get số tồn hiện tại
			$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
			$rston = $GLOBALS['sp']->getRow($sqlton);
			
			$slton = round(($rston['sltonv'] - $rshaodu['hao']),3) + $rshaodu['du'];
			
			$arrlist['slhao'] = $rshaodu['hao'];
			$arrlist['sldu'] = $rshaodu['du'];
			
			$arrlist['slnhap'] = $rston['slnhapv'];
			$arrlist['slxuat'] = $rston['slxuatv'];
			$arrlist['slton'] = $slton;
			$arrlist['idloaivang'] = $idloaivang;	
			$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}
function insert_thongKeTonKhoPhanKim($a){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$datenow = date("Y-m-d");
	
	$datenowdauthang = date("Y-m-01");
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					//die($sqlhaodusddk);
					$sltonsddk = $rstonsddk['sltonv'];					
					//$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$datenowdauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(($rston['slnhapv'] -  $rston['slxuatv']),3);
					
					$slton = round(round($sltonsddk + $rston['slnhapv'],3) - $rston['slxuatv'],3);
					// $slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
					// $slton = round(round(($slton - $rshaodu['haochenhlech']),3) + $rshaodu['duchenhlech'],3);
					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = $rstonsddk['sltonv'];
					$thangdauky = $rstonsddk['dated']; 
					
					
				//die($sqlhaodutndt);
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and typechuyen=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang, 
											ROUND(SUM(hao), 3) as hao, 
											ROUND(SUM(du), 3) as du 
											from $GLOBALS[db_sp].".$table." 
											where idloaivang=".$idloaivang." 
											and type in(2,3)
											and datedxuat < '".$fromDate."'  
											and datedxuat >= '".$datedauthang."' 
									"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3);
					
					// Tính tổng số lượng hao dư của các tháng trước tháng chọn
					$sqlsumhaodusddk = "select  ROUND(SUM(hao), 3) as hao, 
												ROUND(SUM(du), 3) as du
												from $GLOBALS[db_sp].".$tablehachtoan." 
												where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."'
										";
					$rssumhaodusddk = $GLOBALS['sp']->getRow($sqlsumhaodusddk);
					
					// Tỉnh tổng số lượng hao dư từ ngày chọn trở về trước (= tổng hao dư của các tháng trước + hao dư từ ngày đến đầu tháng chọn)
					// $slhaosddk =  round(($rssumhaodusddk['hao'] + $rsxuattndt['hao']),3);
					// $sldusddk =  round(($rssumhaodusddk['du'] + $rsxuattndt['du']),3);
					
					// $sltonsddk = round((round((round(($sltonsddk + $sltontndt),3) - $slhaosddk),3) + $sldusddk),3);

					$sltonsddk = round(($sltonsddk + $sltontndt),3);
					
					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=1 
									 and typechuyen=2 
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang, 
										ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du 
										from $GLOBALS[db_sp].".$table." 
										where idloaivang=".$idloaivang."
										and type in(2,3)
										and datedxuat >= '".$fromDate."'  
										and datedxuat <= '".$toDate."' 
								"; 

					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					// $sltontndn = round(round(($sltontndn - $rsxuat['hao']),3) + $rsxuat['du'],3);
					//$sltontndn = round(($sltontndn -  $rsxuat['hao']),3)

					$slton = $sltonsddk + $sltontndn;
					
					$arrlist['slhao'] = $rsxuat['hao'];
					$arrlist['sldu'] = $rsxuat['du'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}
function thongKeTonKhoPhanKim($cid, $idloaivang, $fromDate, $toDate){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$datenow = date("Y-m-d");
	
	$datenowdauthang = date("Y-m-01");
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					//die($sqlhaodusddk);
					$sltonsddk = $rstonsddk['sltonv'];					
					//$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$datenowdauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(($rston['slnhapv'] -  $rston['slxuatv']),3);
					
					$slton = round(round($sltonsddk + $rston['slnhapv'],3) - $rston['slxuatv'],3);
					// $slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
					// $slton = round(round(($slton - $rshaodu['haochenhlech']),3) + $rshaodu['duchenhlech'],3);
					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = $rstonsddk['sltonv'];
					$thangdauky = $rstonsddk['dated']; 
					
					
				//die($sqlhaodutndt);
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and typechuyen=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang, 
											ROUND(SUM(hao), 3) as hao, 
											ROUND(SUM(du), 3) as du 
											from $GLOBALS[db_sp].".$table." 
											where idloaivang=".$idloaivang." 
											and type in(2,3)
											and datedxuat < '".$fromDate."'  
											and datedxuat >= '".$datedauthang."' 
									"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3);
					
					// Tính tổng số lượng hao dư của các tháng trước tháng chọn
					$sqlsumhaodusddk = "select  ROUND(SUM(hao), 3) as hao, 
												ROUND(SUM(du), 3) as du
												from $GLOBALS[db_sp].".$tablehachtoan." 
												where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."'
										";
					$rssumhaodusddk = $GLOBALS['sp']->getRow($sqlsumhaodusddk);
					
					// Tỉnh tổng số lượng hao dư từ ngày chọn trở về trước (= tổng hao dư của các tháng trước + hao dư từ ngày đến đầu tháng chọn)
					// $slhaosddk =  round(($rssumhaodusddk['hao'] + $rsxuattndt['hao']),3);
					// $sldusddk =  round(($rssumhaodusddk['du'] + $rsxuattndt['du']),3);
					
					// $sltonsddk = round((round((round(($sltonsddk + $sltontndt),3) - $slhaosddk),3) + $sldusddk),3);

					$sltonsddk = round(($sltonsddk + $sltontndt),3);
					
					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=1 
									 and typechuyen=2 
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang, 
										ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du 
										from $GLOBALS[db_sp].".$table." 
										where idloaivang=".$idloaivang."
										and type in(2,3)
										and datedxuat >= '".$fromDate."'  
										and datedxuat <= '".$toDate."' 
								"; 

					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					// $sltontndn = round(round(($sltontndn - $rsxuat['hao']),3) + $rsxuat['du'],3);
					//$sltontndn = round(($sltontndn -  $rsxuat['hao']),3)

					$slton = $sltonsddk + $sltontndn;
					
					$arrlist['slhao'] = $rsxuat['hao'];
					$arrlist['sldu'] = $rsxuat['du'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

function insert_thongKeTonKhoSanXuat($a){
	
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];

	return thongKeTonKhoSanXuat($cid, $idloaivang, $fromDate, $toDate);
}

function thongKeTonKhoSanXuat($cid, $idloaivang, $fromDate, $toDate){
	$datenow = date("Y-m-d");
	
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	$sqlgettable = "select `id`, `table`, `tablect`, `tablehachtoan`, `tablegiaonhantho` from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);

	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	$tablegiaonhantho = $rsgettable['tablegiaonhantho'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),10) + $rshaodusddk['du'];
					
					$sltonsddk = round(($sltonsddk - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'];

					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated = '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang."  and dated = '".$datedauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(round($sltonsddk + $rston['slnhapv'],10) - $rston['slxuatv'],10);
					
					$slton = round(round(($slton - $rshaodu['hao']),10) + $rshaodu['du'],10);
					$slton = round(round(($slton - $rshaodu['haochenhlech']),10) + $rshaodu['duchenhlech'],10);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),10) + $rshaodusddk['du'],10);
					
					$sltonsddk = round(round(($sltonsddk - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'],10);
					
					$thangdauky = $rstonsddk['dated']; 
					
					/////////////////////get số lượng hao dư từ ngày đến đầu tháng
					$sqlhaodutndt = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$table."haodu 
								 where idloaivang=".$idloaivang." AND typeduyet=1 
								 and dated < '".$fromDate."'
								 and dated >= '".$datedauthang."'
					";
					$rshaodutndt = $GLOBALS['sp']->getRow($sqlhaodutndt);
					//die($sqlhaodutndt);

					$rsHaoDuTNDTGNT = array('hao' => 0, 'du' => 0, 'haochenhlech' => 0, 'duchenhlech' => 0);
					// Get số lượng hao dư từ ngày đến đầu tháng giao nhận thợ
					if(!empty($tablegiaonhantho)) {
						$sqlHaoDuKetDeTNDT = "select ROUND(SUM(tongtlhao), 3) as hao, 
													ROUND(SUM(tongtldu), 3) as du  
													from $GLOBALS[db_sp].".$tablegiaonhantho." 
													where idloaivang=".$idloaivang." 
													and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 0) 
													and typeduyet = 1 
													and dated < '".$fromDate."'
													and dated >= '".$datedauthang."'
						";
						$rsHaoDuKetDeTNDT = $GLOBALS['sp']->getRow($sqlHaoDuKetDeTNDT);

						$sqlHaoDuChenhLechTNDT = "select ROUND(SUM(tongtlhao), 3) as haochenhlech, 
														ROUND(SUM(tongtldu), 3) as duchenhlech  
														from $GLOBALS[db_sp].".$tablegiaonhantho." 
														where idloaivang=".$idloaivang." 
														and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 1) 
														and typeduyet = 1 
														and dated < '".$fromDate."'
														and dated >= '".$datedauthang."'
						";
						$rsHaoDuChenhLechTNDT = $GLOBALS['sp']->getRow($sqlHaoDuChenhLechTNDT);

						$rsHaoDuTNDTGNT = array_merge($rsHaoDuKetDeTNDT, $rsHaoDuChenhLechTNDT);
					}

					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and typechuyen=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type in(2,3)
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),10) + round((round(($rshaodutndt['du'] + $rsHaoDuTNDTGNT['du']),10) - round(($rshaodutndt['hao'] + $rsHaoDuTNDTGNT['hao']),10)),10);
					$sltontndt = round(($sltontndt + round((round(($rshaodutndt['duchenhlech'] + $rsHaoDuTNDTGNT['duchenhlech']),10)- round(($rshaodutndt['haochenhlech'] + $rsHaoDuTNDTGNT['haochenhlech']),10)),10)),10); 
					$sltonsddk = round(($sltonsddk + $sltontndt),10);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$table."haodu 
								 where idloaivang=".$idloaivang." 
								 and dated >= '".$fromDate."'
								 and dated <= '".$toDate."'
								 and typeduyet = 1
					";
					// die($sqlhaodu);
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					$rsHaoDuGNT = array('hao' => 0, 'du' => 0, 'haochenhlech' => 0, 'duchenhlech' => 0);
					// Get số lượng hao dư từ ngày đến đầu tháng giao nhận thợ
					if(!empty($tablegiaonhantho)) {
						$sqlHaoDuKetDe = "select ROUND(SUM(tongtlhao), 3) as hao, 
												ROUND(SUM(tongtldu), 3) as du  
												from $GLOBALS[db_sp].".$tablegiaonhantho." 
												where idloaivang=".$idloaivang." 
												and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 0) 
												and typeduyet = 1 
												and dated >= '".$fromDate."'
												and dated <= '".$toDate."' 
						";
						$rsHaoDuKetDe = $GLOBALS['sp']->getRow($sqlHaoDuKetDe);
						
						$sqlHaoDuChenhLech = "select ROUND(SUM(tongtlhao), 3) as haochenhlech, 
												ROUND(SUM(tongtldu), 3) as duchenhlech  
												from $GLOBALS[db_sp].".$tablegiaonhantho." 
												where idloaivang=".$idloaivang." 
												and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 1) 
												and typeduyet = 1 
												and dated >= '".$fromDate."'
												and dated <= '".$toDate."' 
						";
						$rsHaoDuChenhLech = $GLOBALS['sp']->getRow($sqlHaoDuChenhLech);

						$rsHaoDuGNT = array_merge($rsHaoDuKetDe, $rsHaoDuChenhLech);
					}
					
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=1 
									 and typechuyen=2 
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
					            where idloaivang=".$idloaivang."
								and type in(2,3)
								and datedxuat >= '".$fromDate."'  
								and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),10) + round((round(($rshaodu['du'] + $rsHaoDuGNT['du']),10) - round(($rshaodu['hao'] + $rsHaoDuGNT['hao']),10)),10);
					$sltontndn = $sltontndn + round((round(($rshaodu['duchenhlech'] + $rsHaoDuGNT['duchenhlech']),10) - round(($rshaodu['haochenhlech'] + $rsHaoDuGNT['haochenhlech']),10)),10);
					$slton = $sltonsddk + $sltontndn;
					
					$arrlist['slhao'] = $rshaodu['hao'] + $rsHaoDuGNT['hao'];
					$arrlist['sldu'] = $rshaodu['du'] + $rsHaoDuGNT['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'] + $rsHaoDuGNT['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'] + $rsHaoDuGNT['duchenhlech'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

function thongKeTonKhoPhuKienNew($cid, $idloaivang, $fromDate, $toDate){
	$datenow = date("Y-m-d");
	
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if($table == 'khosanxuat_phukien_new') {
			$tablehaodu = 'khosanxuat_phukienhaodu_new';
		} else if($table == 'khosanxuat_phukien_dhht') {
			$tablehaodu = 'khosanxuat_phukienhaodu_dhht';
		}
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),10) + $rshaodusddk['du'];
					
					$sltonsddk = round(($sltonsddk - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'];

					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated = '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang."  and dated = '".$datedauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(round($sltonsddk + $rston['slnhapv'],10) - $rston['slxuatv'],10);
					
					$slton = round(round(($slton - $rshaodu['hao']),10) + $rshaodu['du'],10);
					$slton = round(round(($slton - $rshaodu['haochenhlech']),10) + $rshaodu['duchenhlech'],10);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),10) + $rshaodusddk['du'],10);
					
					$sltonsddk = round(round(($sltonsddk - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'],10);
					
					$thangdauky = $rstonsddk['dated']; 
					
					/////////////////////get số lượng hao dư từ ngày đến đầu tháng
					$sqlhaodutndt = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].$tablehaodu  
								 where idloaivang=".$idloaivang." 
								 and dated < '".$fromDate."'
								 and dated >= '".$datedauthang."'
					";
					$rshaodutndt = $GLOBALS['sp']->getRow($sqlhaodutndt);
				//die($sqlhaodutndt);
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and typechuyen=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type in(2,3)
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),10) + round(($rshaodutndt['du'] - $rshaodutndt['hao']),10);
					$sltontndt = round(($sltontndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),10)),10); 
					$sltonsddk = round(($sltonsddk + $sltontndt),10);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].$tablehaodu  
								 where idloaivang=".$idloaivang." 
								 and dated >= '".$fromDate."'
								 and dated <= '".$toDate."'
								 and typeduyet = 1
					";
					// die($sqlhaodu);
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
					
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=1 
									 and typechuyen=2 
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
					            where idloaivang=".$idloaivang."
								and type in(2,3)
								and datedxuat >= '".$fromDate."'  
								and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),10) + round(($rshaodu['du'] - $rshaodu['hao']),10);
					$sltontndn = $sltontndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),10);
					$slton = $sltonsddk + $sltontndn;
					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

function insert_thongKeTonKhoSanXuatTruHaoDuGNT($a) {
	$tablehaodugnt = trim($a['tablehaodugnt']);
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];

	return thongKeTonKhoSanXuatTruHaoDuGNT($tablehaodugnt, $cid, $idloaivang, $fromDate, $toDate);
}

function thongKeTonKhoSanXuatTruHaoDuGNT($tablehaodugnt, $cid, $idloaivang, $fromDate, $toDate) {
	$datenow = date("Y-m-d");
	
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),10) + $rshaodusddk['du'];
					
					$sltonsddk = round(($sltonsddk - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'];

					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated = '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang."  and dated = '".$datedauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(round($sltonsddk + $rston['slnhapv'],10) - $rston['slxuatv'],10);
					
					$slton = round(round(($slton - $rshaodu['hao']),10) + $rshaodu['du'],10);
					$slton = round(round(($slton - $rshaodu['haochenhlech']),10) + $rshaodu['duchenhlech'],10);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),10) + $rshaodusddk['du'],10);
					
					$sltonsddk = round(round(($sltonsddk - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'],10);
					
					$thangdauky = $rstonsddk['dated']; 
					
					/////////////////////get số lượng hao dư từ ngày đến đầu tháng
					$sqlHaoDuKetDeTNDT = "select ROUND(SUM(tongtlhao), 3) as hao, 
												 ROUND(SUM(tongtldu), 3) as du  
												 from $GLOBALS[db_sp].".$tablehaodugnt." 
												 where idloaivang=".$idloaivang." 
												 and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 0) 
												 and typeduyet = 1 
												 and dated < '".$fromDate."'
											 	 and dated >= '".$datedauthang."'
					";
					$rsHaoDuKetDeTNDT = $GLOBALS['sp']->getRow($sqlHaoDuKetDeTNDT);

					$sqlHaoDuChenhLechTNDT = "select ROUND(SUM(tongtlhao), 3) as haochenhlech, 
													 ROUND(SUM(tongtldu), 3) as duchenhlech  
													 from $GLOBALS[db_sp].".$tablehaodugnt." 
													 where idloaivang=".$idloaivang." 
													 and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 1) 
													 and typeduyet = 1 
													 and dated < '".$fromDate."'
													 and dated >= '".$datedauthang."'
					";
					$rsHaoDuChenhLechTNDT = $GLOBALS['sp']->getRow($sqlHaoDuChenhLechTNDT);

					$rshaodutndt = array_merge($rsHaoDuKetDeTNDT, $rsHaoDuChenhLechTNDT);
					// print_r($rshaodutndt); die();
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and typechuyen=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type in(2,3)
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),10) + round(($rshaodutndt['du'] - $rshaodutndt['hao']),10);
					$sltontndt = round(($sltontndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),10)),10); 
					$sltonsddk = round(($sltonsddk + $sltontndt),10);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlHaoDuKetDe = "select ROUND(SUM(tongtlhao), 3) as hao, 
											 ROUND(SUM(tongtldu), 3) as du  
											 from $GLOBALS[db_sp].".$tablehaodugnt." 
											 where idloaivang=".$idloaivang." 
											 and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 0) 
											 and typeduyet = 1 
											 and dated >= '".$fromDate."'
											 and dated <= '".$toDate."' 
					";
					$rsHaoDuKetDe = $GLOBALS['sp']->getRow($sqlHaoDuKetDe);
					
					$sqlHaoDuChenhLech = "select ROUND(SUM(tongtlhao), 3) as haochenhlech, 
											 ROUND(SUM(tongtldu), 3) as duchenhlech  
											 from $GLOBALS[db_sp].".$tablehaodugnt." 
											 where idloaivang=".$idloaivang." 
											 and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 1) 
											 and typeduyet = 1 
											 and dated >= '".$fromDate."'
											 and dated <= '".$toDate."' 
					";
					$rsHaoDuChenhLech = $GLOBALS['sp']->getRow($sqlHaoDuChenhLech);

					$rshaodu = array_merge($rsHaoDuKetDe, $rsHaoDuChenhLech);
					// print_r($rshaodu); die();
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=1 
									 and typechuyen=2 
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
					            where idloaivang=".$idloaivang."
								and type in(2,3)
								and datedxuat >= '".$fromDate."'  
								and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),10) + round(($rshaodu['du'] - $rshaodu['hao']),10);
					$sltontndn = $sltontndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),10);
					$slton = $sltonsddk + $sltontndn;
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

function insert_getTongQ10($a){
	$slton = $a['cannangv'];
	$idloaivang = $a['idloaivang'];
	$tongq10 = 0;
	if($idloaivang > 0){
		$sql = "select tuoiquydinh,tygia,giavang from $GLOBALS[db_sp].loaivang where id=".$idloaivang;
		$rs = $GLOBALS['sp']->getRow($sql);
		if($idloaivang == 22 || $idloaivang == 19){//vnd, usd
			$tongq10 = round(round($slton  * $rs['tygia'],3)/$rs['giavang'],10);
		}
		else{
			$tongq10 = round(round($slton,4)  * round($rs['tuoiquydinh'],4),10);
		}
	}
	return $tongq10;
}

function getTongQ10($slton,$idloaivang){
	$tongq10 = 0;
	if($idloaivang > 0){
		$sql = "select tuoiquydinh,tygia,giavang from $GLOBALS[db_sp].loaivang where id=".$idloaivang;
		$rs = $GLOBALS['sp']->getRow($sql);
		if($idloaivang == 22 || $idloaivang == 19){//vnd, usd
			$tongq10 = round(round($slton  * $rs['tygia'],3)/$rs['giavang'],10);
		}
		else{
			$tongq10 = round(round($slton,4)  * round($rs['tuoiquydinh'],4),10);
		}
	}
	return $tongq10;
}

function insert_getTongQ10Round10($a){
	$slton = $a['cannangv'];
	$idloaivang = $a['idloaivang'];
	$tongq10 = 0;
	if($idloaivang > 0){
		$sql = "select tuoiquydinh,tygia,giavang from $GLOBALS[db_sp].loaivang where id=".$idloaivang;
		$rs = $GLOBALS['sp']->getRow($sql);
		if($idloaivang == 22 || $idloaivang == 19){//vnd, usd
			$tongq10 = round(round($slton  * $rs['tygia'],3)/$rs['giavang'],10);
		}
		else{
			$tongq10 = round(round($slton,4)  * round($rs['tuoiquydinh'],4),10);
		}
	}
	return $tongq10;
}

function getTongQ10Round10($slton,$idloaivang){
	$tongq10 = 0;
	if($idloaivang > 0){
		$sql = "select tuoiquydinh,tygia,giavang from $GLOBALS[db_sp].loaivang where id=".$idloaivang;
		$rs = $GLOBALS['sp']->getRow($sql);
		if($idloaivang == 22 || $idloaivang == 19){//vnd, usd
			$tongq10 = round(round($slton  * $rs['tygia'],3)/$rs['giavang'],10);
		}
		else{
			$tongq10 = round(round($slton,4)  * round($rs['tuoiquydinh'],4),10);
		}
	}
	return $tongq10;
}
/*==============Ghi sổ Hạch toán Hao Dư : hạch toán hao du này, chỉ cộng dồn hao dư trong tháng lại thôi, kg có cộng tồn từ tháng trên xuống tháng dưới==================*/
function hachToanHaoDuAdd($idloaivang, $hao, $du, $haochenhlech, $duchenhlech,  $dated, $tablehachtoan){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day = array();
	$dated = explode('-',$dated);
	$datedauthang = $dated[0].'-'.$dated[1].'-01';

	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang;
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
		$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivang." order by dated desc limit 1";	
		$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
		$tonvhthangnho = $tonhthangnho = 0;
		if($rsdatethangnho['id'] > 0){
			$arrnx1day['sltonvh'] = $rsdatethangnho['sltonvh'];
			$arrnx1day['sltonh'] = $rsdatethangnho['sltonh'];
			$arrnx1day['sltonv'] = round(($arrnx1day['sltonvh'] - $arrnx1day['sltonh']),3);
		}
	
		$arrnx1day['idloaivang'] = $idloaivang; // chỉ có nhập mới inser loại vàng
		$arrnx1day['hao'] = $hao;
		$arrnx1day['du'] = $du;
		
		$arrnx1day['haochenhlech'] = $haochenhlech;
		$arrnx1day['duchenhlech'] = $duchenhlech;
		
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		$arrnx1day['hao'] = round(($rsdate['hao'] + $hao),3);
		$arrnx1day['du'] = round(($rsdate['du'] + $du),3) ;
		
		$arrnx1day['haochenhlech'] = round(($rsdate['haochenhlech'] + $haochenhlech),3);
		$arrnx1day['duchenhlech'] = round(($rsdate['duchenhlech'] + $duchenhlech),3) ;
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}

function hachToanHaoDuEdit($idloaivang, $hao, $du, $haochenhlech, $duchenhlech, $idloaivangedit, $haoedit, $duedit, $haochenhlechedit, $duchenhlechedit, $dated, $tablehachtoan){
	clearstatcache();
	unset($arrnx1day);
	unset($arrkhacloaivang);
	unset($arrupdate);
	$arrnx1day = $arrkhacloaivang = $arrupdate = array();
	$datenow = $dated;
	$dateday = explode('-',$datenow);
	$datedauthang = $dateday[0].'-'.$dateday[1].'-01';
	if($idloaivang != $idloaivangedit){/// thay đổi loại vàng
		////////////cap nhap loại vàng cũ trước
		$sqlupdate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivangedit;
		$rsupdate = $GLOBALS['sp']->getRow($sqlupdate);	
		
		$arrupdate['hao'] = round(($rsupdate['hao'] - $haoedit),3);  
		$arrupdate['du'] = round(($rsupdate['du'] - $duedit),3);
		
		$arrupdate['haochenhlech'] = round(($rsupdate['haochenhlech'] - $haochenhlechedit),3);  
		$arrupdate['duchenhlech'] = round(($rsupdate['duchenhlech'] - $duchenhlechedit),3);
		
		vaUpdate($tablehachtoan,$arrupdate,' id='.$rsupdate['id']);
		
		$sqlrc = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang;
		$rsrc = $GLOBALS['sp']->getRow($sqlrc);	
		if(empty($rsrc['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
			//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
			$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivang." order by dated desc limit 1";	
			$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
			$tonvhthangnho = $tonhthangnho = 0;
			if($rsdatethangnho['id'] > 0){
				$arrkhacloaivang['sltonvh'] = $rsdatethangnho['sltonvh'];
				$arrkhacloaivang['sltonh'] = $rsdatethangnho['sltonh'];
				$arrkhacloaivang['sltonv'] = round(($arrnx1day['sltonvh'] - $arrnx1day['sltonh']),3);
			}
			// insert loại vàng mới
			$arrkhacloaivang['idloaivang'] = $idloaivang; 
			$arrkhacloaivang['hao'] = $hao;
			$arrkhacloaivang['du'] = $du;
			
			$arrkhacloaivang['haochenhlech'] = $haochenhlech;
			$arrkhacloaivang['duchenhlech'] = $duchenhlech;
			
			$arrkhacloaivang['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrkhacloaivang);
		}
		else{// có rồi thi update vào sodudauky			
			$arrkhacloaivang['hao'] = round(($rsrc['hao'] + $hao),3);
			$arrkhacloaivang['du'] = round(($rsrc['du'] + $du),3);
			
			$arrkhacloaivang['haochenhlech'] = round(($rsrc['haochenhlech'] + $haochenhlech),3);
			$arrkhacloaivang['duchenhlech'] = round(($rsrc['duchenhlech'] + $duchenhlech),3);
			
			vaUpdate($tablehachtoan,$arrkhacloaivang,' id='.$rsrc['id']);
		}
	}
	else{
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang;
		$rsdate = $GLOBALS['sp']->getRow($sqldate);	
		if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
			//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
			$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivang." order by dated desc limit 1";	
			$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
			$tonvhthangnho = $tonhthangnho = 0;
			if($rsdatethangnho['id'] > 0){
				$arrnx1day['sltonvh'] = $rsdatethangnho['sltonvh'];
				$arrnx1day['sltonh'] = $rsdatethangnho['sltonh'];
				$arrnx1day['sltonv'] = round(($arrnx1day['sltonvh'] - $arrnx1day['sltonh']),3);
			}
			
			$arrnx1day['idloaivang'] = $idloaivang; // chỉ có nhập mới inser loại vàng
			$arrnx1day['hao'] = $hao;
			$arrnx1day['du'] = $du;
			
			$arrnx1day['haochenhlech'] = $haochenhlech;
			$arrnx1day['duchenhlech'] = $duchenhlech;
			
			$arrnx1day['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrnx1day);
		}
		else{// có rồi thi update vào sodudauky
		 //die(' hao :'.$hao . ' haoedit :'.$haoedit .' duedit :'.$duedit);
			$arrnx1day['hao'] = round(($rsdate['hao'] - $haoedit),3) + $hao;
			$arrnx1day['du'] = round(($rsdate['du'] - $duedit),3) + $du;
			
			$arrnx1day['haochenhlech'] = round(($rsdate['haochenhlech'] - $haochenhlechedit),3) + $haochenhlech;
			$arrnx1day['duchenhlech'] = round(($rsdate['duchenhlech'] - $duchenhlechedit),3) + $duchenhlech;
			
			vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
		}
	}
}

function hachToanHaoDuDelete($idloaivang, $hao, $du, $haochenhlech, $duchenhlech, $dated, $tablehachtoan){
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day = array();
	$datenow = $dated;
	$dateday = explode('-',$datenow);
	$datedauthang = $dateday[0].'-'.$dateday[1].'-01';
	
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang;
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	
	$arrnx1day['hao'] = round(($rsdate['hao'] - $hao),3);
	$arrnx1day['du'] = round(($rsdate['du'] - $du),3) ;
	
	$arrnx1day['haochenhlech'] = round(($rsdate['haochenhlech'] - $haochenhlech),3);
	$arrnx1day['duchenhlech'] = round(($rsdate['duchenhlech'] - $duchenhlech),3) ;
	
	vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
}

/*==============Xóa sổ Hạch toán==================*/
function deleteHachToanVang($id, $idctnx, $idloaivang, $tableedit){
	//die('xxx'.$idloaivang);
	/////lấy table của từng bảng trong cat vd:khonguonvao_khoachin, khonguonvao_khoachinct, khoachin_sodudauky v.v.v.v
	$sql = "select * from $GLOBALS[db_sp].".$tableedit." where id=".$idctnx; //vd khonguonvao_khoachin
	$rs = $GLOBALS["sp"]->getRow($sql);	
	
	$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rs['phongbanchuyen'];	
	$rstc = $GLOBALS['sp']->getRow($sqltc);
	
	$table = $rstc['table'];
	$tablect = $rstc['tablect'];
	$tablehachtoan = $rstc['tablehachtoan'];
	$rsct = getTableRow($tablect,' and id='.$id);
	
	$datetao = explode('-',$rsct['dated']);
	$datedauthang = $datetao[0].'-'.$datetao['1'].'-01';
	///////////////////
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1";	
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	
	clearstatcache();
	unset($arrdatenew);
	$arrdatenew =  array();	
	$arrdatenew['slnhapvh'] = round(($rsdate['slnhapvh'] - $rsct['cannangvh']),3);
	$arrdatenew['sltonvh'] =  round(($rsdate['sltonvh'] - $rsct['cannangvh']),3);
	$arrdatenew['slnhaph'] =  round(($rsdate['slnhaph'] - $rsct['cannangh']),3);
	$arrdatenew['sltonh'] =  round(($rsdate['sltonh'] - $rsct['cannangh']),3);
	$arrdatenew['slnhapv'] = round(($arrdatenew['slnhapvh'] - $arrdatenew['slnhaph']),3);
	$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);	
	vaUpdate($tablehachtoan,$arrdatenew,' id='.$rsdate['id']);
	
	/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
	$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1 order by dated asc";	
	$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
	if(ceil(count($rsdatenewadd)) > 0){
		foreach($rsdatenewadd as $itemnewadd){
			clearstatcache();
			unset($arrdatenewadd);
			$arrdatenewadd =  array();
			$arrdatenewadd['sltonvh'] =  round(($itemnewadd['sltonvh'] - $rsct['cannangvh']),3);
			$arrdatenewadd['sltonh'] = round(($itemnewadd['sltonh'] - $rsct['cannangh']),3);
			$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);	
			vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
		}
	}				
}

function deleteHachToanKimCuong($id, $idctnx, $idkimcuong, $tableedit){
	/////lấy table của từng bảng trong cat vd:khonguonvao_khoachin, khonguonvao_khoachinct, khoachin_sodudauky v.v.v.v
	$sql = "select * from $GLOBALS[db_sp].".$tableedit." where id=".$idctnx; //vd khonguonvao_khoachin
	$rs = $GLOBALS["sp"]->getRow($sql);	
	
	$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rs['phongbanchuyen'];	
	$rstc = $GLOBALS['sp']->getRow($sqltc);
	
	$table = $rstc['table'];
	$tablect = $rstc['tablect'];
	$tablehachtoan = $rstc['tablehachtoan'];
	
	$rsct = getTableRow($tablect,' and id='.$id);
	$datetao = explode('-',$rsct['dated']);
	$datedauthang = $datetao[0].'-'.$datetao['1'].'-01';

	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and typevkc=2";
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	clearstatcache();
	unset($arrdatenew);
	$arrdatenew =  array();	
	$arrdatenew['slnhapkimcuong'] = $rsdate['slnhapkimcuong'] - 1;
	$arrdatenew['sltonkimcuong'] = $rsdate['sltonkimcuong'] - 1;
	
	$arrdatenew['dongianhap'] = round(($rsdate['dongianhap'] - $rsct['dongiaban']),3);
	$arrdatenew['tongdongia'] =  round(($rsdate['tongdongia'] - $rsct['dongiaban']),3);	
	//print_r($arrdatenew); die();
	vaUpdate($tablehachtoan,$arrdatenew,' id='.$rsdate['id']);
	/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
	$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and typevkc=2 order by dated asc";	
	$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
	if(ceil(count($rsdatenewadd)) > 0){
		foreach($rsdatenewadd as $itemnewadd){
			clearstatcache();
			unset($arrdatenewadd);
			$arrdatenewadd =  array();
			$arrdatenewadd['sltonkimcuong'] =  $itemnewadd['sltonkimcuong'] - 1;
			$arrdatenewadd['tongdongia'] =  $itemnewadd['tongdongia'] - $rsct['dongiaban'];
			vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
		}
	}				
}
/*==============Sửa sổ Hạch toán==================*/
function editHachToanVangDieuChinhSoLieuKhoNguonVao($id, $idloaivangedit, $cannangvhedit, $cannanghedit, $table, $tablehachtoan, $typenhapxuat){ 
	////type = 1 nhập kho else xuất kho
	$datetao = $datedauthang = '';
	$rsct = getTableRow($table,' and id='.$id);
	$idloaivang = $rsct['idloaivang'];
	$cannangvh = $rsct['cannangvh'];
	$cannangh = $rsct['cannangh'];
	$cannangv = $rsct['cannangv'];
	if($typenhapxuat == 'nhapkho'){/// nhập kho
		$datetao = explode('-',$rsct['dated']);
		$datedauthang = $datetao[0].'-'.$datetao['1'].'-01';	
	}
	else{/// xuất kho
		$datetao = explode('-',$rsct['datedxuat']);
		$datedauthang = $datetao[0].'-'.$datetao['1'].'-01';		
	}
	
	if($idloaivang != $idloaivangedit){/// thay đổi loại vàng
		clearstatcache();
		unset($arrdateolddau);
		$arrdateolddau =  array();
		
		//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
		$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated desc limit 1";	
		$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
		$tonvhthangnho = $tonhthangnho = 0;
		if($rsdatethangnho['id'] > 0){
			$tonvhthangnho = $rsdatethangnho['sltonvh'];
			$tonhthangnho = $rsdatethangnho['sltonh'];
		}
		//////////////////trừ số dư dầu kỳ trong loại vàng cũ trước////////
		$sqldateolddau = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1 ";	
		$rsdateolddau = $GLOBALS['sp']->getRow($sqldateolddau);
		if($typenhapxuat == 'nhapkho'){/// nhập kho
			$arrdateolddau['slnhapvh'] = round(($rsdateolddau['slnhapvh'] - $cannangvh),3);
			$arrdateolddau['slnhaph'] = round(($rsdateolddau['slnhaph'] - $cannangh),3);
			$arrdateolddau['slnhapv'] = round(($arrdateolddau['slnhapvh'] - $arrdateolddau['slnhaph']),3);	
			
			$arrdateolddau['sltonvh'] =  round(($rsdateolddau['sltonvh'] - $cannangvh),3);
			$arrdateolddau['sltonh'] = round(($rsdateolddau['sltonh'] - $cannangh),3);
		}
		else{//// xuất kho
			$arrdateolddau['slxuatvh'] = round(($rsdateolddau['slxuatvh'] - $cannangvh),3);
			$arrdateolddau['slxuath'] = round(($rsdateolddau['slxuath'] - $cannangh),3);
			$arrdateolddau['slxuatv'] = round(($arrdateolddau['slxuatvh'] - $arrdateolddau['slxuath']),3);
			
			$arrdateolddau['sltonvh'] =  round(($rsdateolddau['sltonvh'] + $cannangvh),3);
			$arrdateolddau['sltonh'] = round(($rsdateolddau['sltonh'] + $cannangh),3);
			
		}
		$arrdateolddau['sltonv'] = round(($arrdateolddau['sltonvh'] - $arrdateolddau['sltonh']),3);
		
		vaUpdate($tablehachtoan,$arrdateolddau,' id='.$rsdateolddau['id']);
		/////////trừ số dư dầu kỳ trong loại vàng cũ những tháng sau đó
		$sqldateold = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1 order by dated asc";	
		$rsdateold = $GLOBALS['sp']->getAll($sqldateold);
		if(ceil(count($rsdateold)) > 0){
			foreach($rsdateold as $itemold){
				clearstatcache();
				unset($arrdateold);
				$arrdateold =  array();
				if($typenhapxuat == 'nhapkho'){/// nhập kho
					$arrdateold['sltonvh'] =  round(($itemold['sltonvh'] - $cannangvh),3);
					$arrdateold['sltonh'] = round(($itemold['sltonh'] - $cannangh),3);
					
				}
				else{//// xuất kho
					$arrdateold['sltonvh'] =  round(($itemold['sltonvh'] + $cannangvh),3);
					$arrdateold['sltonh'] = round(($itemold['sltonh'] + $cannangh),3);
				}
				$arrdateold['sltonv'] = round(($arrdateold['sltonvh'] - $arrdateold['sltonh']),3);
				vaUpdate($tablehachtoan,$arrdateold,' id='.$itemold['id']);
			}
		}		
		
		///////Thêm số dư dầu kỳ trong loại vàng mới đổi
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 ";	
		$rsdate = $GLOBALS['sp']->getRow($sqldate);
		clearstatcache();	
		unset($arrdatenew);
		$arrdatenew =  array();
		if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
			if($typenhapxuat == 'nhapkho'){/// nhập kho
				$arrdatenew['slnhapvh'] = $cannangvhedit;
				$arrdatenew['slnhaph'] = $cannanghedit;
				$arrdatenew['slnhapv'] = round(($arrdatenew['slnhapvh'] - $arrdatenew['slnhaph']),3);
				
				$arrdatenew['sltonvh'] = round(($tonvhthangnho + $cannangvhedit),3);
				$arrdatenew['sltonh'] = round(($tonhthangnho + $cannanghedit),3);
			}
			else{//xuất kho
				$arrdatenew['slxuatvh'] = $cannangvhedit;
				$arrdatenew['slxuath'] = $cannanghedit;
				$arrdatenew['slxuatv'] = round(($arrdatenew['slxuatvh'] - $arrdatenew['slxuath']),3);
				
				$arrdatenew['sltonvh'] = round(($tonvhthangnho - $cannangvhedit),3);
				$arrdatenew['sltonh'] = round(($tonhthangnho - $cannanghedit),3);
			}	
			$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);
			$arrdatenew['dated'] = $datedauthang;
			$arrdatenew['idloaivang'] = $idloaivangedit;
			
			vaInsert($tablehachtoan,$arrdatenew);
			/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
			$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated asc";	
			$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
			if(ceil(count($rsdatenewadd)) > 0){
				foreach($rsdatenewadd as $itemnewadd){
					clearstatcache();
					unset($arrdatenewadd);
					$arrdatenewadd =  array();
					if($typenhapxuat == 'nhapkho'){/// nhập kho
						$arrdatenewadd['sltonvh'] =  round(($itemnewadd['sltonvh'] + $cannangvhedit),3);
						$arrdatenewadd['sltonh'] = round(($itemnewadd['sltonh'] + $cannanghedit),3);
					}
					else{
						$arrdatenewadd['sltonvh'] =  round(($itemnewadd['sltonvh'] - $cannangvhedit),3);
						$arrdatenewadd['sltonh'] = round(($itemnewadd['sltonh'] - $cannanghedit),3);		
					}
					$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);
					vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
				}
			}		
		}
		else{///có dated trong csdl ".$tablehachtoan." update	
		//die('xxx');
			if($typenhapxuat == 'nhapkho'){/// nhập kho
				$arrdatenew['slnhapvh'] = round(($rsdate['slnhapvh'] + $cannangvhedit),3);
				$arrdatenew['slnhaph'] =  round(($rsdate['slnhaph'] + $cannanghedit),3);
				$arrdatenew['slnhapv'] = round(($arrdatenew['slnhapvh'] - $arrdatenew['slnhaph']),3);
				
				$arrdatenew['sltonvh'] =  round(($rsdate['sltonvh'] + $cannangvhedit),3);
				$arrdatenew['sltonh'] =  round(($rsdate['sltonh'] + $cannanghedit),3);
			}
			else{/// xuất kho
				$arrdatenew['slxuatvh'] = round(($rsdate['slxuatvh'] + $cannangvhedit),3);
				$arrdatenew['slxuath'] =  round(($rsdate['slxuath'] + $cannanghedit),3);
				$arrdatenew['slxuatv'] = round(($arrdatenew['slxuatvh'] - $arrdatenew['slxuath']),3);	
				
				$arrdatenew['sltonvh'] =  round(($rsdate['sltonvh'] - $cannangvhedit),3);
				$arrdatenew['sltonh'] =  round(($rsdate['sltonh'] - $cannanghedit),3);
			}
			
			$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);
			
			vaUpdate($tablehachtoan,$arrdatenew,' id='.$rsdate['id']);
			
			/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
			$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated asc";	
			$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
			if(ceil(count($rsdatenewadd)) > 0){
				foreach($rsdatenewadd as $itemnewadd){
					clearstatcache();
					unset($arrdatenewadd);
					$arrdatenewadd =  array();
					if($typenhapxuat == 'nhapkho'){/// nhập kho
						$arrdatenewadd['sltonvh'] =  round(($itemnewadd['sltonvh'] + $cannangvhedit),3);
						$arrdatenewadd['sltonh'] = round(($itemnewadd['sltonh'] + $cannanghedit),3);
					}
					else{
						$arrdatenewadd['sltonvh'] =  round(($itemnewadd['sltonvh'] - $cannangvhedit),3);
						$arrdatenewadd['sltonh'] = round(($itemnewadd['sltonh'] - $cannanghedit),3);
							
					}
					$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);
					vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
				}
			}		
		}
	}
	else{/////không có thay đổi loại vàng
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1";	
		$rsdate = $GLOBALS['sp']->getRow($sqldate);	
		clearstatcache();
		unset($arrdatenew);
		$arrdatenew =  array();
		if($typenhapxuat == 'nhapkho'){/// nhập kho
			$arrdatenew['slnhapvh'] = $rsdate['slnhapvh'] + round(($cannangvhedit - $rsct['cannangvh']),3);
			$arrdatenew['sltonvh'] =  $rsdate['sltonvh'] + round(($cannangvhedit - $rsct['cannangvh']),3);
			$arrdatenew['slnhaph'] =  $rsdate['slnhaph'] + round(($cannanghedit - $rsct['cannangh']),3);
			$arrdatenew['sltonh'] =  $rsdate['sltonh'] + round(($cannanghedit - $rsct['cannangh']),3);
			$arrdatenew['slnhapv'] = round(($arrdatenew['slnhapvh'] - $arrdatenew['slnhaph']),3);
			$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);	
		}
		else{////xuất kho
			$arrdatenew['slxuatvh'] = $rsdate['slxuatvh'] + round(($cannangvhedit - $rsct['cannangvh']),3);
			$arrdatenew['sltonvh'] =  $rsdate['sltonvh'] - round(($cannangvhedit - $rsct['cannangvh']),3);
			$arrdatenew['slxuath'] =  $rsdate['slxuath'] + round(($cannanghedit - $rsct['cannangh']),3);
			$arrdatenew['sltonh'] =  $rsdate['sltonh'] - round(($cannanghedit - $rsct['cannangh']),3);
			$arrdatenew['slxuatv'] = round(($arrdatenew['slxuatvh'] - $arrdatenew['slxuath']),3);
			$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);		
		}
		//print_r($arrdatenew); die();
		vaUpdate($tablehachtoan,$arrdatenew,' id='.$rsdate['id']);
		
		/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
		$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated asc";	
		$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
		if(ceil(count($rsdatenewadd)) > 0){
			foreach($rsdatenewadd as $itemnewadd){
				clearstatcache();
				unset($arrdatenewadd);
				$arrdatenewadd =  array();
				if($typenhapxuat == 'nhapkho'){/// nhập kho
					$arrdatenewadd['sltonvh'] =  $itemnewadd['sltonvh'] + round(($cannangvhedit - $rsct['cannangvh']),3);
					$arrdatenewadd['sltonh'] = $itemnewadd['sltonh'] + round(($cannanghedit - $rsct['cannangh']),3);
					$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);	
				}
				else{
					$arrdatenewadd['sltonvh'] =  $itemnewadd['sltonvh'] - round(($cannangvhedit - $rsct['cannangvh']),3);
					$arrdatenewadd['sltonh'] = $itemnewadd['sltonh'] - round(($cannanghedit - $rsct['cannangh']),3);
					$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);		
				}
				vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
			}
		}		
	}
			
}

function editHachToanVangDieuChinhSoLieu($id, $idloaivangedit, $cannangvhedit, $cannanghedit, $table, $tablehachtoan){ 
	////type = 1 nhập kho else xuất kho
	$datetao = $datedauthang = '';
	$rsct = getTableRow($table,' and id='.$id);
	$idloaivang = $rsct['idloaivang'];
	$cannangvh = $rsct['cannangvh'];
	$cannangh = $rsct['cannangh'];
	$cannangv = $rsct['cannangv'];
	if($rsct['type'] == 1){/// nhập kho
		$datetao = explode('-',$rsct['dated']);
		$datedauthang = $datetao[0].'-'.$datetao['1'].'-01';	
	}
	else{/// xuất kho
		$datetao = explode('-',$rsct['datedxuat']);
		$datedauthang = $datetao[0].'-'.$datetao['1'].'-01';		
	}
	
	if($idloaivang != $idloaivangedit){/// thay đổi loại vàng
		clearstatcache();
		unset($arrdateolddau);
		$arrdateolddau =  array();
		
		//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
		$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated desc limit 1";	
		$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
		$tonvhthangnho = $tonhthangnho = 0;
		if($rsdatethangnho['id'] > 0){
			$tonvhthangnho = $rsdatethangnho['sltonvh'];
			$tonhthangnho = $rsdatethangnho['sltonh'];
		}
		//////////////////trừ số dư dầu kỳ trong loại vàng cũ trước////////
		$sqldateolddau = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1 ";	
		$rsdateolddau = $GLOBALS['sp']->getRow($sqldateolddau);
		if($rsct['type'] == 1){/// nhập kho
			$arrdateolddau['slnhapvh'] = round(($rsdateolddau['slnhapvh'] - $cannangvh),3);
			$arrdateolddau['slnhaph'] = round(($rsdateolddau['slnhaph'] - $cannangh),3);
			$arrdateolddau['slnhapv'] = round(($arrdateolddau['slnhapvh'] - $arrdateolddau['slnhaph']),3);	
			
			$arrdateolddau['sltonvh'] =  round(($rsdateolddau['sltonvh'] - $cannangvh),3);
			$arrdateolddau['sltonh'] = round(($rsdateolddau['sltonh'] - $cannangh),3);
		}
		else{//// xuất kho
			$arrdateolddau['slxuatvh'] = round(($rsdateolddau['slxuatvh'] - $cannangvh),3);
			$arrdateolddau['slxuath'] = round(($rsdateolddau['slxuath'] - $cannangh),3);
			$arrdateolddau['slxuatv'] = round(($arrdateolddau['slxuatvh'] - $arrdateolddau['slxuath']),3);
			
			$arrdateolddau['sltonvh'] =  round(($rsdateolddau['sltonvh'] + $cannangvh),3);
			$arrdateolddau['sltonh'] = round(($rsdateolddau['sltonh'] + $cannangh),3);
			
		}
		$arrdateolddau['sltonv'] = round(($arrdateolddau['sltonvh'] - $arrdateolddau['sltonh']),3);
		
		vaUpdate($tablehachtoan,$arrdateolddau,' id='.$rsdateolddau['id']);
		/////////trừ số dư dầu kỳ trong loại vàng cũ những tháng sau đó
		$sqldateold = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1 order by dated asc";	
		$rsdateold = $GLOBALS['sp']->getAll($sqldateold);
		if(ceil(count($rsdateold)) > 0){
			foreach($rsdateold as $itemold){
				clearstatcache();
				unset($arrdateold);
				$arrdateold =  array();
				if($rsct['type'] == 1){/// nhập kho
					$arrdateold['sltonvh'] =  round(($itemold['sltonvh'] - $cannangvh),3);
					$arrdateold['sltonh'] = round(($itemold['sltonh'] - $cannangh),3);
					
				}
				else{//// xuất kho
					$arrdateold['sltonvh'] =  round(($itemold['sltonvh'] + $cannangvh),3);
					$arrdateold['sltonh'] = round(($itemold['sltonh'] + $cannangh),3);
				}
				$arrdateold['sltonv'] = round(($arrdateold['sltonvh'] - $arrdateold['sltonh']),3);
				vaUpdate($tablehachtoan,$arrdateold,' id='.$itemold['id']);
			}
		}		
		
		///////Thêm số dư dầu kỳ trong loại vàng mới đổi
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 ";	
		$rsdate = $GLOBALS['sp']->getRow($sqldate);
		clearstatcache();	
		unset($arrdatenew);
		$arrdatenew =  array();
		if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
			if($rsct['type'] == 1){/// nhập kho
				$arrdatenew['slnhapvh'] = $cannangvhedit;
				$arrdatenew['slnhaph'] = $cannanghedit;
				$arrdatenew['slnhapv'] = round(($arrdatenew['slnhapvh'] - $arrdatenew['slnhaph']),3);
				
				$arrdatenew['sltonvh'] = round(($tonvhthangnho + $cannangvhedit),3);
				$arrdatenew['sltonh'] = round(($tonhthangnho + $cannanghedit),3);
			}
			else{//xuất kho
				$arrdatenew['slxuatvh'] = $cannangvhedit;
				$arrdatenew['slxuath'] = $cannanghedit;
				$arrdatenew['slxuatv'] = round(($arrdatenew['slxuatvh'] - $arrdatenew['slxuath']),3);
				
				$arrdatenew['sltonvh'] = round(($tonvhthangnho - $cannangvhedit),3);
				$arrdatenew['sltonh'] = round(($tonhthangnho - $cannanghedit),3);
			}	
			$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);
			$arrdatenew['dated'] = $datedauthang;
			$arrdatenew['idloaivang'] = $idloaivangedit;
			
			vaInsert($tablehachtoan,$arrdatenew);
			/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
			$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated asc";	
			$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
			if(ceil(count($rsdatenewadd)) > 0){
				foreach($rsdatenewadd as $itemnewadd){
					clearstatcache();
					unset($arrdatenewadd);
					$arrdatenewadd =  array();
					if($rsct['type'] == 1){/// nhập kho
						$arrdatenewadd['sltonvh'] =  round(($itemnewadd['sltonvh'] + $cannangvhedit),3);
						$arrdatenewadd['sltonh'] = round(($itemnewadd['sltonh'] + $cannanghedit),3);
					}
					else{
						$arrdatenewadd['sltonvh'] =  round(($itemnewadd['sltonvh'] - $cannangvhedit),3);
						$arrdatenewadd['sltonh'] = round(($itemnewadd['sltonh'] - $cannanghedit),3);		
					}
					$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);
					vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
				}
			}		
		}
		else{///có dated trong csdl ".$tablehachtoan." update	
		//die('xxx');
			if($rsct['type'] == 1){/// nhập kho
				$arrdatenew['slnhapvh'] = round(($rsdate['slnhapvh'] + $cannangvhedit),3);
				$arrdatenew['slnhaph'] =  round(($rsdate['slnhaph'] + $cannanghedit),3);
				$arrdatenew['slnhapv'] = round(($arrdatenew['slnhapvh'] - $arrdatenew['slnhaph']),3);
				
				$arrdatenew['sltonvh'] =  round(($rsdate['sltonvh'] + $cannangvhedit),3);
				$arrdatenew['sltonh'] =  round(($rsdate['sltonh'] + $cannanghedit),3);
			}
			else{/// xuất kho
				$arrdatenew['slxuatvh'] = round(($rsdate['slxuatvh'] + $cannangvhedit),3);
				$arrdatenew['slxuath'] =  round(($rsdate['slxuath'] + $cannanghedit),3);
				$arrdatenew['slxuatv'] = round(($arrdatenew['slxuatvh'] - $arrdatenew['slxuath']),3);	
				
				$arrdatenew['sltonvh'] =  round(($rsdate['sltonvh'] - $cannangvhedit),3);
				$arrdatenew['sltonh'] =  round(($rsdate['sltonh'] - $cannanghedit),3);
			}
			
			$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);
			
			vaUpdate($tablehachtoan,$arrdatenew,' id='.$rsdate['id']);
			
			/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
			$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated asc";	
			$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
			if(ceil(count($rsdatenewadd)) > 0){
				foreach($rsdatenewadd as $itemnewadd){
					clearstatcache();
					unset($arrdatenewadd);
					$arrdatenewadd =  array();
					if($rsct['type'] == 1){/// nhập kho
						$arrdatenewadd['sltonvh'] =  round(($itemnewadd['sltonvh'] + $cannangvhedit),3);
						$arrdatenewadd['sltonh'] = round(($itemnewadd['sltonh'] + $cannanghedit),3);
					}
					else{
						$arrdatenewadd['sltonvh'] =  round(($itemnewadd['sltonvh'] - $cannangvhedit),3);
						$arrdatenewadd['sltonh'] = round(($itemnewadd['sltonh'] - $cannanghedit),3);
							
					}
					$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);
					vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
				}
			}		
		}
	}
	else{/////không có thay đổi loại vàng
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1";	
		$rsdate = $GLOBALS['sp']->getRow($sqldate);	
		clearstatcache();
		unset($arrdatenew);
		$arrdatenew =  array();
		if($rsct['type'] == 1){/// nhập kho
			$arrdatenew['slnhapvh'] = $rsdate['slnhapvh'] + round(($cannangvhedit - $rsct['cannangvh']),3);
			$arrdatenew['sltonvh'] =  $rsdate['sltonvh'] + round(($cannangvhedit - $rsct['cannangvh']),3);
			$arrdatenew['slnhaph'] =  $rsdate['slnhaph'] + round(($cannanghedit - $rsct['cannangh']),3);
			$arrdatenew['sltonh'] =  $rsdate['sltonh'] + round(($cannanghedit - $rsct['cannangh']),3);
			$arrdatenew['slnhapv'] = round(($arrdatenew['slnhapvh'] - $arrdatenew['slnhaph']),3);
			$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);	
		}
		else{////xuất kho
			$arrdatenew['slxuatvh'] = $rsdate['slxuatvh'] + round(($cannangvhedit - $rsct['cannangvh']),3);
			$arrdatenew['sltonvh'] =  $rsdate['sltonvh'] - round(($cannangvhedit - $rsct['cannangvh']),3);
			$arrdatenew['slxuath'] =  $rsdate['slxuath'] + round(($cannanghedit - $rsct['cannangh']),3);
			$arrdatenew['sltonh'] =  $rsdate['sltonh'] - round(($cannanghedit - $rsct['cannangh']),3);
			$arrdatenew['slxuatv'] = round(($arrdatenew['slxuatvh'] - $arrdatenew['slxuath']),3);
			$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);		
		}
		//print_r($arrdatenew); die();
		vaUpdate($tablehachtoan,$arrdatenew,' id='.$rsdate['id']);
		
		/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
		$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated asc";	
		$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
		if(ceil(count($rsdatenewadd)) > 0){
			foreach($rsdatenewadd as $itemnewadd){
				clearstatcache();
				unset($arrdatenewadd);
				$arrdatenewadd =  array();
				if($rsct['type'] == 1){/// nhập kho
					$arrdatenewadd['sltonvh'] =  $itemnewadd['sltonvh'] + round(($cannangvhedit - $rsct['cannangvh']),3);
					$arrdatenewadd['sltonh'] = $itemnewadd['sltonh'] + round(($cannanghedit - $rsct['cannangh']),3);
					$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);	
				}
				else{
					$arrdatenewadd['sltonvh'] =  $itemnewadd['sltonvh'] - round(($cannangvhedit - $rsct['cannangvh']),3);
					$arrdatenewadd['sltonh'] = $itemnewadd['sltonh'] - round(($cannanghedit - $rsct['cannangh']),3);
					$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);		
				}
				vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
			}
		}		
	}
			
}

function editHachToanVang($id, $idctnx, $idloaivang, $cannangvh, $cannangh, $idloaivangedit, $cannangvhedit, $cannanghedit, $tableedit){
	/////lấy table của từng bảng trong cat vd:khonguonvao_khoachin, khonguonvao_khoachinct, khoachin_sodudauky v.v.v.v
	$sql = "select * from $GLOBALS[db_sp].".$tableedit." where id=$idctnx"; //vd khonguonvao_khoachin
	$rs = $GLOBALS["sp"]->getRow($sql);	
	
	$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rs['phongbanchuyen'];	
	$rstc = $GLOBALS['sp']->getRow($sqltc);
	
	$table = $rstc['table'];
	$tablect = $rstc['tablect'];
	$tablehachtoan = $rstc['tablehachtoan'];
	
	$rsct = getTableRow($tablect,' and id='.$id);
	$datetao = explode('-',$rsct['dated']);
	$datedauthang = $datetao[0].'-'.$datetao['1'].'-01';
	if($idloaivang != $idloaivangedit){/// thay đổi loại vàng
		clearstatcache();
		unset($arrdateolddau);
		$arrdateolddau =  array();
		//////////////////trừ số dư dầu kỳ trong loại vàng cũ trước////////
		$sqldateolddau = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1";	
		$rsdateolddau = $GLOBALS['sp']->getRow($sqldateolddau);
		$arrdateolddau['slnhapvh'] = round(($rsdateolddau['slnhapvh'] - $cannangvh),3);
		$arrdateolddau['sltonvh'] =  round(($rsdateolddau['sltonvh'] - $cannangvh),3);
		$arrdateolddau['slnhaph'] = round(($rsdateolddau['slnhaph'] - $cannangh),3);
		$arrdateolddau['sltonh'] = round(($rsdateolddau['sltonh'] - $cannangh),3);
		$arrdateolddau['slnhapv'] = round(($arrdateolddau['slnhapvh'] - $arrdateolddau['slnhaph']),3);
		$arrdateolddau['sltonv'] = round(($arrdateolddau['sltonvh'] - $arrdateolddau['sltonh']),3);
		
		vaUpdate($tablehachtoan,$arrdateolddau,' id='.$rsdateolddau['id']);
		/////////trừ số dư dầu kỳ trong loại vàng cũ những tháng sau đó
		$sqldateold = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1 order by dated asc";	
		$rsdateold = $GLOBALS['sp']->getAll($sqldateold);

		if(ceil(count($rsdateold)) > 0){
			foreach($rsdateold as $itemold){
				clearstatcache();
				unset($arrdateold);
				$arrdateold =  array();
				$arrdateold['sltonvh'] =  round(($itemold['sltonvh'] - $cannangvh),3);
				$arrdateold['sltonh'] = round(($itemold['sltonh'] - $cannangh),3);
				$arrdateold['sltonv'] = round(($arrdateold['sltonvh'] - $arrdateold['sltonh']),3);	
				vaUpdate($tablehachtoan,$arrdateold,' id='.$itemold['id']);
			}
		}		
		
		///////Thêm số dư dầu kỳ trong loại vàng mới đổi
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1";	
		$rsdate = $GLOBALS['sp']->getRow($sqldate);	
		clearstatcache();
		unset($arrdatenew);
		$arrdatenew =  array();
		if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
			//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
			$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated < '".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated desc limit 1";	
			$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
			$tonvhthangnho = $tonhthangnho = 0;
			if($rsdatethangnho['id'] > 0){
				$tonvhthangnho = $rsdatethangnho['sltonvh'];
				$tonhthangnho = $rsdatethangnho['sltonh'];
			}
			
			$arrdatenew['slnhapvh'] = $cannangvhedit;
			$arrdatenew['sltonvh'] = round(($tonvhthangnho + $cannangvhedit),3);
			$arrdatenew['slnhaph'] = $cannanghedit;
			$arrdatenew['sltonh'] = round((tonhthangnho + $cannanghedit),3);
			$arrdatenew['slnhapv'] = round(($arrdatenew['slnhapvh'] - $arrdatenew['slnhaph']),3);
			$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);
			
			$arrdatenew['dated'] = $datedauthang;
			$arrdatenew['idloaivang'] = $idloaivangedit;
			//print_r($arrdatenew); die();
			vaInsert($tablehachtoan,$arrdatenew);
			/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
			$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated asc";	
			$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
			if(ceil(count($rsdatenewadd)) > 0){
				foreach($rsdatenewadd as $itemnewadd){
					clearstatcache();
					unset($arrdatenewadd);
					$arrdatenewadd =  array();
					$arrdatenewadd['sltonvh'] =  round(($itemnewadd['sltonvh'] + $cannangvhedit),3);
					$arrdatenewadd['sltonh'] = round(($itemnewadd['sltonh'] + $cannanghedit),3);
					$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);	
					vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
				}
			}		
		}
		else{///có dated trong csdl ".$tablehachtoan." update	
		//die('xxx');
			$arrdatenew['slnhapvh'] = round(($rsdate['slnhapvh'] + $cannangvhedit),3);
			$arrdatenew['sltonvh'] =  round(($rsdate['sltonvh'] + $cannangvhedit),3);
			$arrdatenew['slnhaph'] =  round(($rsdate['slnhaph'] + $cannanghedit),3);
			$arrdatenew['sltonh'] =  round(($rsdate['sltonh'] + $cannanghedit),3);
			$arrdatenew['slnhapv'] = round(($arrdatenew['slnhapvh'] - $arrdatenew['slnhaph']),3);
			$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);	
			
			vaUpdate($tablehachtoan,$arrdatenew,' id='.$rsdate['id']);
			
			/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
			$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated asc";	
			$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
			if(ceil(count($rsdatenewadd)) > 0){
				foreach($rsdatenewadd as $itemnewadd){
					clearstatcache();
					unset($arrdatenewadd);
					$arrdatenewadd =  array();
					$arrdatenewadd['sltonvh'] =  round(($itemnewadd['sltonvh'] + $cannangvhedit),3);
					$arrdatenewadd['sltonh'] = round(($itemnewadd['sltonh'] + $cannanghedit),3);
					$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);	
					vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
				}
			}		
		}
	}
	else{/////không có thay đổi loại vàng
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1";	
		$rsdate = $GLOBALS['sp']->getRow($sqldate);	
		clearstatcache();
		unset($arrdatenew);
		$arrdatenew =  array();	
		$arrdatenew['slnhapvh'] = $rsdate['slnhapvh'] + round(($cannangvhedit - $rsct['cannangvh']),3);
		$arrdatenew['sltonvh'] =  $rsdate['sltonvh'] + round(($cannangvhedit - $rsct['cannangvh']),3);
		$arrdatenew['slnhaph'] =  $rsdate['slnhaph'] + round(($cannanghedit - $rsct['cannangh']),3);
		$arrdatenew['sltonh'] =  $rsdate['sltonh'] + round(($cannanghedit - $rsct['cannangh']),3);
		$arrdatenew['slnhapv'] = round(($arrdatenew['slnhapvh'] - $arrdatenew['slnhaph']),3);
		$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);	
		
		//print_r($arrdatenew); die();
		vaUpdate($tablehachtoan,$arrdatenew,' id='.$rsdate['id']);
		
		/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
		$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivangedit." and typevkc=1 order by dated asc";	
		$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
		if(ceil(count($rsdatenewadd)) > 0){
			foreach($rsdatenewadd as $itemnewadd){
				clearstatcache();
				unset($arrdatenewadd);
				$arrdatenewadd =  array();
				$arrdatenewadd['sltonvh'] =  $itemnewadd['sltonvh'] + round(($cannangvhedit - $rsct['cannangvh']),3);
				$arrdatenewadd['sltonh'] = $itemnewadd['sltonh'] + round(($cannanghedit - $rsct['cannangh']),3);
				$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);	
				vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
			}
		}		
	}
			
}

function editHachToanKimCuong($id, $idctnx, $idkimcuong, $dongiaban, $idkimcuongedit, $dongiabanedit, $tableedit){
	/////lấy table của từng bảng trong cat vd:khonguonvao_khoachin, khonguonvao_khoachinct, khoachin_sodudauky v.v.v.v
	$sql = "select * from $GLOBALS[db_sp].".$tableedit." where id=$idctnx"; //vd khonguonvao_khoachin
	$rs = $GLOBALS["sp"]->getRow($sql);	
	
	$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rs['phongbanchuyen'];	
	$rstc = $GLOBALS['sp']->getRow($sqltc);
	
	$table = $rstc['table'];
	$tablect = $rstc['tablect'];
	$tablehachtoan = $rstc['tablehachtoan'];
	
	$rsct = getTableRow($tablect,' and id='.$id);
	$datetao = explode('-',$rsct['dated']);
	$datedauthang = $datetao[0].'-'.$datetao['1'].'-01';

	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and typevkc=2";
	$rsdate = $GLOBALS['sp']->getRow($sqldate);
	clearstatcache();	
	unset($arrdatenew);
	$arrdatenew =  array();	
	$arrdatenew['dongianhap'] = $rsdate['dongianhap'] + round(($dongiabanedit - $rsct['dongiaban']),3);
	$arrdatenew['tongdongia'] =  $rsdate['tongdongia'] + round(($dongiabanedit - $rsct['dongiaban']),3);	
	//print_r($arrdatenew); die();
	vaUpdate($tablehachtoan,$arrdatenew,' id='.$rsdate['id']);
	/////////Thêm số dư dầu kỳ trong loại vàng cũ những tháng sau đó
	$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and typevkc=2 order by dated asc";	
	$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
	if(ceil(count($rsdatenewadd)) > 0){
		foreach($rsdatenewadd as $itemnewadd){
			clearstatcache();
			unset($arrdatenewadd);
			$arrdatenewadd =  array();
			$arrdatenewadd['tongdongia'] =  $itemnewadd['tongdongia'] + round(($dongiabanedit - $rsct['dongiaban']),3);
			vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
		}
	}				
}
/*==============Ghi sổ Hạch toán==================*/
function ghiSoHachToanKhoSanXuat($tablehachtoan, $tablenhan, $id){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	if($item['type']==1){//số lượng nhập
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
	}
	else{ // số lượng xuất
		$slxuatvhrc = $item['cannangvh'];
		$slxuatvrc = $item['cannangv'];
		$slxuathrc = $item['cannangh'];
	}
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				//////////////////nhập vàng + hột
				$sltonvh = $rstru1day['sltonvh'];
				//////////////////nhập vàng
				$sltonv = $rstru1day['sltonv'];
				//////////////////nhập hot
				$sltonh = $rstru1day['sltonh'];
				
			}
			//////////////////nhập vàng + hột
			$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3);
			
			$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3);
			$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
			$arrnx1day['slxuatvh'] = $slxuatvhrc;
			$arrnx1day['slxuatv'] = $slxuatvrc;
			$arrnx1day['slxuath'] = $slxuathrc;
			
			
			$arrnx1day['idloaivang'] = $item['idloaivang']; // chỉ có nhập mới inser loại vàng, xuất không cần

		}
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
			$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
			$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3);
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
		}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}

function ghiSoHachToanKhoSanXuatPhanKim($tablehachtoan, $tablenhan, $id){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	if($item['type']==1){//số lượng nhập
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
	}
	else{ // số lượng xuất
		$slxuatvhrc = $item['cannangvh'];
		$slxuatvrc = $item['cannangv'];
		$slxuathrc = $item['cannangh'];
	}
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				//////////////////nhập vàng + hột
				$sltonvh = $rstru1day['sltonvh'];
				//////////////////nhập vàng
				$sltonv = $rstru1day['sltonv'];
				//////////////////nhập hot
				$sltonh = $rstru1day['sltonh'];
				
			}
			//////////////////nhập vàng + hột
			$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3);
			
			$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3);
			$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
			$arrnx1day['slxuatvh'] = $slxuatvhrc;
			$arrnx1day['slxuatv'] = $slxuatvrc;
			$arrnx1day['slxuath'] = $slxuathrc;
			
			
			$arrnx1day['idloaivang'] = $item['idloaivang']; // chỉ có nhập mới inser loại vàng, xuất không cần

		}
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
			$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
			$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3);
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
		}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}

function ghiSoHachToanPhanKim($tablehachtoan, $tablenhan, $id, $typehachtoan){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	//print_r($item); die($tablenhan);
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	if($typehachtoan =='nhapkho'){//xác nhận hạch toán table mới luôn là nhập kho
		$item['type'] = 1;
	}
	if($typehachtoan =='xuatkho'){//xác nhận hạch toán table mới luôn là nhập kho
		$item['type'] = 2;
	}	
	
	if($item['type']==1){//số lượng nhập
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
		
		$dongianhaprc = $item['dongiaban'];;
		$slnhapkimcuongrc = 1;	
	}
	else{ // số lượng xuất
		$slxuatvhrc = $item['cannangvh'];
		$slxuatvrc = $item['cannangv'];
		$slxuathrc = $item['cannangh'];	
	}
	$haorc = $item['hao'];
	$durc = $item['du'];
	
	$dongiaxuatrc = $item['dongiaban'];
	$slxuatkimcuongrc = 1;
	//die(' slxuatvh: '.$slxuatvhrc . ' slxuatvrc: '. $slxuatvrc . ' slxuathrc: '. $slxuathrc);
	if($item['typevkc']==1){/// là vàng
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];	
	}
	else{
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and typevkc=".$item['typevkc'];	
	}
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				//////////////////nhập vàng + hột
				$sltonvh = $rstru1day['sltonvh'];
				//////////////////nhập vàng
				$sltonv = $rstru1day['sltonv'];
				//////////////////nhập hot
				$sltonh = $rstru1day['sltonh'];
				
			}
			//////////////////nhập vàng + hột
			$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3) ;
			$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
			$arrnx1day['slxuatvh'] = $slxuatvhrc;
			$arrnx1day['slxuatv'] = $slxuatvrc;
			$arrnx1day['slxuath'] = $slxuathrc;
			
			$arrnx1day['hao'] = $haorc;
			$arrnx1day['du'] = $durc;
			
			$arrnx1day['idloaivang'] = $item['idloaivang']; // chỉ có nhập mới inser loại vàng, xuất không cần

		}
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
			$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			
			$hao = round(($rsdate['hao'] + $haorc),3);
			$du = round(($rsdate['du'] + $durc),3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
			$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3) ;
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
		
			$arrnx1day['hao'] = $hao;
			$arrnx1day['du'] = $du;
		}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}
/*==============Ghi sổ Hạch toán==================*/
function ghiSoHachToanTongKhoDeCucXuat($idloaivang, $cangnangvh,$cangnangv){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day = array();
	$slxuatvhrc = $cangnangvh;
	$slxuatvrc = $cangnangv;
	$slxuathrc = $sltonvh = $sltonv = $sltonh = $slxuatvh = $slxuath = 0;
	$sqldate = $rsdate = $sqltru1day = $rstru1day = '';
	
	$sqldate = "select * from $GLOBALS[db_sp].khokhac_khotongdecuc_sodudauky where dated='".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1";
	$rsdate = $GLOBALS['sp']->getRow($sqldate);

	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
		$sqltru1day = "select * from $GLOBALS[db_sp].khokhac_khotongdecuc_sodudauky where typevkc=1 and idloaivang=".$idloaivang." order by dated desc limit 1"; /// lấy ngày cuối cùng
		$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		if($rstru1day['id'] > 0){
			//////////////////nhập vàng + hột
			$sltonvh = $rstru1day['sltonvh'];
			//////////////////nhập vàng
			$sltonv = $rstru1day['sltonv'];
			//////////////////nhập hot
			$sltonh = $rstru1day['sltonh'];
		}
		//////////////////nhập vàng + hột
		$sltonvh = round(($sltonvh - $slxuatvhrc),3);
		
		$sltonv = round(($sltonv - $slxuatvrc),3);
		$sltonh = round(($sltonh - $slxuathrc),3);
		
		$arrnx1day['sltonvh'] = $sltonvh;
		$arrnx1day['sltonv'] = $sltonv;
		$arrnx1day['sltonh'] = $sltonh;
		
		$arrnx1day['slxuatvh'] = $slxuatvhrc;
		$arrnx1day['slxuatv'] = $slxuatvrc;
		$arrnx1day['slxuath'] = $slxuathrc;
		
		$arrnx1day['idloaivang'] = $idloaivang; 

		$arrnx1day['dated'] = $datedauthang;
		vaInsert('khokhac_khotongdecuc_sodudauky',$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3);
			$sltonvh = round(($rsdate['sltonvh'] - $slxuatvhrc),3);
			
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(($rsdate['sltonv'] - $slxuatvrc),3);
									
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3);
			$sltonh = round(($rsdate['sltonh'] - $slxuathrc),3);
									
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
			vaUpdate('khokhac_khotongdecuc_sodudauky',$arrnx1day,' id='.$rsdate['id']);
	}		
}

function ghiSoHachToan($tablehachtoan, $tablenhan, $id, $typehachtoan){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	//print_r($item); die($tablenhan);
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	if($typehachtoan =='nhapkho'){//xác nhận hạch toán table mới luôn là nhập kho
		$item['type'] = 1;
	}
	if($typehachtoan =='xuatkho'){//xác nhận hạch toán table mới luôn là nhập kho
		$item['type'] = 2;
	}	
	
	if($item['type']==1){//số lượng nhập
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
		
		$dongianhaprc = $item['dongiaban'];;
		$slnhapkimcuongrc = 1;	
	}
	else{ // số lượng xuất
		if($tablenhan == 'kho_giamdockynhan' && $item['idloaivang'] == 12 && $item['typekhodau'] == 'khosanxuat_thanhpham'){/// trường hợp kho sản xuất -> kho thành phẩm chuyển xuống: kho nhập liêun -> kho nguồn vào -> kho nhà xưởng giao nữa trang(KTP), và loai vàng là 12 VT5.85 thì mới vào 
			$rskhothanhpham = getTableRow('khosanxuat_khothanhpham',' and id='.$item['idmaphieukho']); /// table  nxct vd: khonguonvao_khoachinct
			
			$slxuatvhrc = $rskhothanhpham['cannangvh'];
			$slxuatvrc = $rskhothanhpham['cannangv'];
			$slxuathrc = $rskhothanhpham['cannangh'];
		}
		else{
			$slxuatvhrc = $item['cannangvh'];
			$slxuatvrc = $item['cannangv'];
			$slxuathrc = $item['cannangh'];
		}
		
		if($tablenhan == 'khokhac_kholammoi'){
			$haorc = $item['hao'];
			$durc = $item['du'];
		}
		else{
			$haorc = $item['haochuyen'];
			$durc = $item['duchuyen'];		
		}
		$dongiaxuatrc = $item['dongiaban'];
		$slxuatkimcuongrc = 1;
	}
	//die(' slxuatvh: '.$slxuatvhrc . ' slxuatvrc: '. $slxuatvrc . ' slxuathrc: '. $slxuathrc);
	if($item['typevkc']==1){/// là vàng
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];	
	}
	else{
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and typevkc=".$item['typevkc'];	
	}
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				//////////////////nhập vàng + hột
				$sltonvh = $rstru1day['sltonvh'];
				//////////////////nhập vàng
				$sltonv = $rstru1day['sltonv'];
				//////////////////nhập hot
				$sltonh = $rstru1day['sltonh'];
				
			}
			//////////////////nhập vàng + hột
			$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3) ;
			$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
			$arrnx1day['slxuatvh'] = $slxuatvhrc;
			$arrnx1day['slxuatv'] = $slxuatvrc;
			$arrnx1day['slxuath'] = $slxuathrc;
			
			$arrnx1day['hao'] = $haorc;
			$arrnx1day['du'] = $durc;
			
			$arrnx1day['idloaivang'] = $item['idloaivang']; // chỉ có nhập mới inser loại vàng, xuất không cần

		}
		else{ // là kim cương
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
			
			if($rstru1day['id'] > 0){
				$sltonkimcuong = $rstru1day['sltonkimcuong'];
				$tongdongia = $rstru1day['tongdongia'];
			}	
			$sltonkimcuong = round(round(($sltonkimcuong + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3);
			$tongdongia = round(round(($tongdongia + $dongianhaprc),3) - $dongiaxuatrc,3);
			
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuongrc;
			$arrnx1day['slxuatkimcuong'] = $slxuatkimcuongrc;
			
			$arrnx1day['dongianhap'] = $dongianhaprc;
			$arrnx1day['dongiaxuat'] = $dongiaxuatrc;
			$arrnx1day['tongdongia'] = $tongdongia;
		}
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
			$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			
			$hao = round(($rsdate['hao'] + $haorc),3);
			$du = round(($rsdate['du'] + $durc),3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
			$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3) ;
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
		
			$arrnx1day['hao'] = $hao;
			$arrnx1day['du'] = $du;
		}
		else{// là kim cương
			$slnhapkimcuong = round(($rsdate['slnhapkimcuong'] + $slnhapkimcuongrc),3);
			$slxuatkimcuong = round(($rsdate['slxuatkimcuong'] + $slxuatkimcuongrc),3) ;
			$sltonkimcuong = round(round(($rsdate['sltonkimcuong'] + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3) ;
			
			$dongianhap = round(($rsdate['dongianhap'] + $dongianhaprc),3);
			$dongiaxuat = round(($rsdate['dongiaxuat'] + $dongiaxuatrc),3);
			$tongdongia = round(round(($rsdate['tongdongia'] + $dongianhaprc),3) - $dongiaxuatrc,3) ;
			
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuong;
			$arrnx1day['slxuatkimcuong'] = $slxuatkimcuong;
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			
			$arrnx1day['dongianhap'] = $dongianhap;
			$arrnx1day['dongiaxuat'] = $dongiaxuat;
			$arrnx1day['tongdongia'] = $tongdongia;
		}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}

function ghiSoHachToanVang($tablehachtoan, $tablenhan, $id){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	$slnhapvrc = $item['trongluongvang'];
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$sltonv = $slnhapv = 0;
	
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang'];	
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày)
		
		//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
		$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$item['idloaivang']." order by dated desc limit 1"; /// lấy ngày cuối cùng
		$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
	
		if($rstru1day['id'] > 0){
			$sltonv = $rstru1day['sltonv'];
		}
		//////////////////nhập vàng
		$sltonv = round(($sltonv + $slnhapvrc),3);
		$arrnx1day['sltonv'] = $sltonv;
		$arrnx1day['slnhapv'] = $slnhapvrc;
		$arrnx1day['idloaivang'] = $item['idloaivang']; // chỉ có nhập mới inser loại vàng, xuất không cần		
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		//////////////////nhập vàng
		$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
		$sltonv = round(($rsdate['sltonv'] + $slnhapvrc),3);
		$arrnx1day['slnhapv'] = $slnhapv;
		$arrnx1day['sltonv'] = $sltonv;
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}
function ghiSoHachToanSPHu($tablehachtoan, $tablenhan,$sanphamhurc, $id){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	$datetao = explode('-',$item['dated']);
	$datedauthang = $datetao[0].'-'.$datetao['1'].'-01';
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();

	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang'];	
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	//////////////////nhập vàng
	$sanphamhu = round(($rsdate['sanphamhu'] + $sanphamhurc),3);
	$arrnx1day['sanphamhu'] = $sanphamhu;
	vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);		
}


function ghiSoHachToanNhapKho($tablehachtoan, $tablenhan, $id){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$timnow = date('H:i:s');
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	
	$slnhapvhrc = $item['cannangvh'];
	$slnhapvrc = $item['cannangv'];
	$slnhaphrc = $item['cannangh'];
	
	$dongianhaprc = $item['dongiaban'];;
	$slnhapkimcuongrc = 1;	
	
	if($item['typevkc']==1){/// là vàng
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datenow."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];	
	}
	else{
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datenow."' and typevkc=".$item['typevkc'];	
	}
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày)
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				//////////////////nhập vàng + hột
				$sltonvh = $rstru1day['sltonvh'];
				//////////////////nhập vàng
				$sltonv = $rstru1day['sltonv'];
				//////////////////nhập hot
				$sltonh = $rstru1day['sltonh'];
				
			}
			//////////////////nhập vàng + hột
			$sltonvh = round(($sltonvh + $slnhapvhrc),3);
			
			$sltonv = round(($sltonv + $slnhapvrc),3);
			$sltonh = round(($sltonh + $slnhaphrc),3);
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
						
			$arrnx1day['hao'] = $haorc;
			$arrnx1day['du'] = $durc;
			
			$arrnx1day['idloaivang'] = $item['idloaivang']; // chỉ có nhập mới inser loại vàng, xuất không cần

		}
		else{ // là kim cương
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
			
			if($rstru1day['id'] > 0){
				$sltonkimcuong = $rstru1day['sltonkimcuong'];
				$tongdongia = $rstru1day['tongdongia'];
			}	
			$sltonkimcuong = round(($sltonkimcuong + $slnhapkimcuongrc),3);
			$tongdongia = round(($tongdongia + $dongianhaprc),3);
			
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuongrc;
			
			$arrnx1day['dongianhap'] = $dongianhaprc;
			$arrnx1day['tongdongia'] = $tongdongia;
		}
		$arrnx1day['dated'] = $datenow;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$sltonvh = round(($rsdate['sltonvh'] + $slnhapvhrc),3);
			
			$hao = round(($rsdate['hao'] + $haorc),3);
			$du = round(($rsdate['du'] + $durc),3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$sltonv = round(($rsdate['sltonv'] + $slnhapvrc),3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$sltonh = round(($rsdate['sltonh'] + $slnhaphrc),3);
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['sltonh'] = $sltonh;
		
			$arrnx1day['hao'] = $hao;
			$arrnx1day['du'] = $du;
		}
		else{// là kim cương
			$slnhapkimcuong = round(($rsdate['slnhapkimcuong'] + $slnhapkimcuongrc),3);
			$sltonkimcuong = round(($rsdate['sltonkimcuong'] + $slnhapkimcuongrc),3);
			
			$dongianhap = round(($rsdate['dongianhap'] + $dongianhaprc),3);
			$tongdongia = round(($rsdate['tongdongia'] + $dongianhaprc),3);
			
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuong;
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			
			$arrnx1day['dongianhap'] = $dongianhap;
			$arrnx1day['tongdongia'] = $tongdongia;
		}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}


function getListTableKhoKhacKhoTongDeCuc($table, $wh){
	$sql = $list = $str = '';
	$rs = $i = 0;
	///////////load nhập kho Tổng Kho Dẻ Cục
	$sql = "select * from $GLOBALS[db_sp].".$table." 
			$wh 
			order by maphieu asc, id asc
	";
	$rs = $GLOBALS["sp"]->getAll($sql);
	if( ceil(count($rs)) > 0){
		$cannangvh = $cannangh = $cannangv = $hao = $du = 0;
		foreach($rs as $value){
			$i++;
			$cannangvh = round(($cannangvh + $value['cannangvh']),3); 
			$cannangh = round(($cannangh + $value['cannangh']),3); 
			$cannangv = round(($cannangv + $value['cannangv']),3);
			
			$hao = round(($hao + $value['hao']),3); 
			$du = round(($du + $value['du']),3); 
			$list .= '
				<tr>
					<td>
						'.$i.'
					</td>
					<td>
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td>
						'.$value['maphieu'].'
					</td>
					<td>
						'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
					</td> 
				   <td>
					   '.getName("categories","name_vn",$value['tennguyenlieuvang']).'
				   </td> 
				   <td>
						'.getName("loaivang","name_vn",$value['idloaivang']).' 
				   </td> 
				   <td class="text-right">
						'.number_format($value['cannangvh'],3,".",",").'
				   </td> 
				   <td class="text-right">
						'.number_format($value['cannangh'],3,".",",").'
				   </td>
					<td class="text-right">
						'.number_format($value['cannangv'],3,".",",").'
				   </td>
				   <td class="text-right">
						'.number_format($value['tuoivang'],4,".",",").'
				   </td>
				   <td>
						'.$value['tienmatvang'].'
				   </td>
					<td class="text-right">
						'.number_format($value['hao'],3,".",",").'
				   </td>
				   <td class="text-right">
						'.number_format($value['du'],3,".",",").'
				   </td>
				   <td>
					   '.$value['ghichuvang'].'
				   </td> 
				</tr>
			';	
		}
		$str = '
			<table  class="table-bordered">
				<tr class="trheader">
					<td class="tdSTT">
						<strong>STT</strong>
					</td>
					<td>
						<strong>Ngày nhận</strong>
					</td>
	
					<td>
						<strong>Mã Phiếu</strong>
					</td>
					
					<td>
						<strong>Nhóm N Liệu</strong>
					</td>
					
					<td>
						<strong>Tên N Liệu</strong>
					</td>
					
					<td>
						<strong>Loại Vàng</strong>
					</td>
					
					<td>
						<strong>Cân Nặng V+H</strong>
					</td>
				   
					<td>
						<strong>Cân Nặng H</strong>
					</td>
					<td>
						<strong>Cân Nặng V</strong>
					</td>
					<td>
						<strong>Tuổi vàng</strong>
					</td>
					<td>
						<strong>Tiền mặt</strong>
					</td>
					
					<td width="4%">
						<strong>Hao</strong>
					</td>
					<td width="4%">
						<strong>Dư</strong>
					</td> 
					<td>
						<strong>Ghi chú</strong>
					</td>
				</tr>
				'.$list.'
				<tr class="Paging fontSizeTon">
					<td align="right" colspan="6"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
					<td align="right"><span class="colorXanh">'.number_format($cannangvh,3,".",",").'</span></td>
					<td align="right"><span class="colorXanh">'.number_format($cannangh,3,".",",").'</span></td>
					<td align="right"><span class="colorXanh"> '.number_format($cannangvh,3,".",",").'</span></td>
					<td align="center"></td>
					<td align="right"></td>
					<td align="right"> '.number_format($hao,3,".",",").' </td>
					<td align="right"> '.number_format($du,3,".",",").' </td>
					<td align="right"></td>
                </tr>    
			</table>	
		';
	}
	return $str;
}
function getListTableKhoKhacKhoSauCheTac($table, $wh){
	$sql = $list = $str = '';
	$rs = $i = 0;
	///////////load nhập kho Tổng Kho Dẻ Cục
	$sql = "select * from $GLOBALS[db_sp].".$table." 
			$wh 
			order by maphieu asc, id asc
	";
	$rs = $GLOBALS["sp"]->getAll($sql);
	if( ceil(count($rs)) > 0){
		$trongluongvangsauchetac = $hao = $du = 0;
		foreach($rs as $value){
			$i++;
			$trongluongvangsauchetac = $trongluongvangsauchetac + $value['trongluongvangsauchetac']; 			
			$hao = $hao + $value['hao']; 
			$du = $du + $value['du']; 
			$list .= '
				<tr>
					<td>
						'.$i.'
					</td>
					<td>
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td>
						'.$value['maphieu'].'
					</td>
				   <td>
						'.getName("loaivang","name_vn",$value['idloaivang']).' 
				   </td> 
				   <td class="text-right">
						'.number_format($value['trongluongvangsauchetac'],3,".",",").'
				   </td> 
				   <td class="text-right">
						'.number_format($value['tuoivangsauchetac'],4,".",",").'
				   </td>
					<td class="text-right">
						'.number_format($value['hoiche'],3,".",",").'
				   </td>
				   
					<td class="text-right">
						'.number_format($value['hao'],3,".",",").'
				   </td>
				   <td class="text-right">
						'.number_format($value['du'],3,".",",").'
				   </td>
				   <td>
					   '.$value['ghichu'].'
				   </td> 
				</tr>
			';	
		}
		$str = '
			<table  class="table-bordered">
				<tr class="trheader">
                	<td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td width="8%">
                        <strong>Ngày nhận</strong>
                    </td>
                    
                    <td width="10%">
                        <strong>Mã phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Loại Vàng</strong>
                    </td>
                    
                    <td>
                        <strong>Tổng TL vàng sau chế tác</strong>
                    </td>
                   
                    <td>
                        <strong>Tuổi vàng sau chế tác</strong>
                    </td>
                    
                    <td>
                        <strong>Hội chế tác</strong>
                    </td>
                    <td width="4%">
                        <strong>Hao</strong>
                    </td>
                    <td width="4%">
                        <strong>Dư</strong>
                    </td>
                     <td>
                        <strong>Ghi chú</strong>
                    </td>
                    
                </tr>
				'.$list.'
				<tr class="Paging fontSizeTon">
                    <td align="right" colspan="4"> <span class="colorXanh">Tổng Nhập Kho:</span> </td>
                    <td align="right"><strong class="colorXanh"> '.number_format($trongluongvangsauchetac,3,".",",").' </strong></td>
                    <td align="right"></td>
                    <td align="right"></td>
                    <td align="right"><span class="colorXanh"> '.number_format($hao,3,".",",").' </span></td>
                    <td align="right"><span class="colorXanh"> '.number_format($du,3,".",",").' </span></td>
                    <td align="center"></td>
                </tr>         
				
			</table>	
		';
	}
	return $str;
}
function getListTableKhoKhacKhoKimCuongEpTem($table, $wh){
	$sql = $list = $str = '';
	$rs = $i = $soluong = $dongia = 0;
	$sql = "select * from $GLOBALS[db_sp].".$table." 
			$wh 
			order by maphieu asc, id asc
	";
	$rs = $GLOBALS["sp"]->getAll($sql);
	if( ceil(count($rs)) > 0){
		foreach($rs as $value){
			$i++;
			$soluong++;
			$dongia = $dongia + $value['dongiaban'];
			$list .= '
				<tr>
					<td>
						'.$i.'
					</td>
					<td>
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td>
						'.$value['maphieu'].'
					</td>
					<td>
						'.getName("categories","name_vn",$value['nhomnguyenlieukimcuong']).'
					</td> 
				   <td>
					   '.getName("categories","name_vn",$value['tennguyenlieukimcuong']).'
				   </td> 
				   <td>
						'.getName("loaikimcuonghotchu","size",$value['idkimcuong']).'::'.getName("loaikimcuonghotchu","name_vn",$value['idkimcuong']).' 
				   </td> 
				   <td>
						'.$value['codegdpnj'].'
				   </td> 
				   <td>
						'.$value['codecgta'].'
				   </td>
					<td>
						'.$value['kichthuoc'].'
				   </td>
				   <td>
						'.$value['trongluonghot'].'
				   </td>
				   <td>
						'.$value['dotinhkhiet'].'
				   </td>
					<td>
						'.$value['capdomau'].'
				    </td>
					
					<td>
						'.$value['domaibong'].'
				    </td>
					<td>
						'.$value['kichthuocban'].'
				    </td>
					<td class="text-right">
						1
				    </td>
				   <td class="text-right">
						'.number_format($value['dongiaban'],3,".",",").'
				   </td>
				   <td>
						'.$value['ghichu'].'
				    </td>
				</tr>
			';	
		}
		$str = '
			<table  class="table-bordered">
				<tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    <td>
                        <strong>Ngày nhận</strong>
                    </td>

                    <td>
                        <strong>Mã Phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Nhóm N Liệu</strong>
                    </td>
                    
                    <td>
                        <strong>Tên N Liệu</strong>
                    </td>
                    
                    <td width="12%">
                        <strong>Tên Kim Cương</strong>
                    </td>
                    <td>
                        <strong>MS GĐPNJ</strong>
                    </td>
					<td>
                        <strong>MS Cạnh GIAJ</strong>
                    </td>
                    <td>
                        <strong>Kích Thước</strong>
                    </td>
                    <td>
                        <strong>TL Hột</strong>
                    </td>
                    <td>
                        <strong>Độ Tinh Khiết</strong>
                    </td>
                    
                     <td>
                        <strong>Cấp Độ Màu</strong>
                    </td>
                    <td>
                        <strong>Độ Mài Bóng</strong>
                    </td>
                    <td>
                        <strong>Kích Thước Bán</strong>
                    </td>
                    <td width="5%">
                        <strong>Số lượng</strong>
                    </td>
                    <td width="8%">
                        <strong>Giá Vốn</strong>
                    </td>
					<td>
                        <strong>Ghi chú</strong>
                    </td>
                </tr>
				'.$list.'
				<tr class="Paging fontSizeTon">
                    <td align="right" colspan="14"> <strong class="colorXanh">Tổng:</strong> </td>
                    <td align="right"><span class="colorXanh">'.$soluong.'</span></td>
                    <td align="right"><span class="colorXanh">'.number_format($dongia,3,".",",").'</span></td>
					<td align="right"></td>
                </tr>    
			</table>	
		';
	}
	return $str;
}
//==========================================thông kê Print tông kho khác==============================
function getListTableKhoKhacKhoTongDeCucPrint($table, $wh){
	$sql = $list = $str = '';
	$rs = $i = 0;
	///////////load nhập kho Tổng Kho Dẻ Cục
	$sql = "select * from $GLOBALS[db_sp].".$table." 
			$wh 
			order by maphieu asc, id asc
	";
	$rs = $GLOBALS["sp"]->getAll($sql);
	if( ceil(count($rs)) > 0){
		$cannangvh = $cannangh = $cannangv = $hao = $du = 0;
		foreach($rs as $value){
			$i++;
			$cannangvh = round(($cannangvh + $value['cannangvh']),3); 
			$cannangh = round(($cannangh + $value['cannangh']),3); 
			$cannangv = round(($cannangv + $value['cannangv']),3); 
			
			$hao = round(($hao + $value['hao']),3); 
			$du = round(($du + $value['du']),3);
			$list .= '
				<tr>
					<td height="25" align="left">
						'.$i.'
					</td>
					<td  height="25" align="left">
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td  height="25" align="left">
						'.$value['maphieu'].'
					</td>
					<td  height="25" align="left">
						'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
					</td> 
				   <td  height="25" align="left">
					   '.getName("categories","name_vn",$value['tennguyenlieuvang']).'
				   </td> 
				   <td height="25" align="left">
						'.getName("loaivang","name_vn",$value['idloaivang']).' 
				   </td> 
				   <td  height="25" align="right">
						'.number_format($value['cannangvh'],3,".",",").'
				   </td> 
				   <td height="25" align="right">
						'.number_format($value['cannangh'],3,".",",").'
				   </td>
					<td height="25" align="right">
						'.number_format($value['cannangv'],3,".",",").'
				   </td>
				   <td height="25" align="right">
						'.number_format($value['tuoivang'],4,".",",").'
				   </td>
				   <td  height="25" align="left">
						'.$value['tienmatvang'].'
				   </td>
					<td height="25" align="right">
						'.number_format($value['hao'],3,".",",").'
				   </td>
				   <td height="25" align="right">
						'.number_format($value['du'],3,".",",").'
				   </td>
				   <td  height="25" align="left">
						'.$value['ghichuvang'].'
				   </td>
				</tr>
			';	
		}
		$str = '
			<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table-bordered tableMain">
				<tr class="trheader">
					<td>
						<strong>STT</strong>
					</td>
					<td>
						<strong>Ngày nhận</strong>
					</td>
	
					<td>
						<strong>Mã Phiếu</strong>
					</td>
					
					<td>
						<strong>Nhóm N Liệu</strong>
					</td>
					
					<td>
						<strong>Tên N Liệu</strong>
					</td>
					
					<td>
						<strong>Loại Vàng</strong>
					</td>
					
					<td>
						<strong>Cân Nặng V+H</strong>
					</td>
				   
					<td>
						<strong>Cân Nặng H</strong>
					</td>
					<td>
						<strong>Cân Nặng V</strong>
					</td>
					<td>
						<strong>Tuổi vàng</strong>
					</td>
					<td>
						<strong>Tiền mặt</strong>
					</td>
					
					<td>
						<strong>Hao</strong>
					</td>
					<td>
						<strong>Dư</strong>
					</td>
					<td>
						<strong>Ghi Chú</strong>
					</td>
				</tr>
				'.$list.'
				<tr class="Paging fontSizeTon">
					<td align="right" colspan="6"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
					<td align="right"><span class="colorXanh">'.number_format($cannangvh,3,".",",").'</span></td>
					<td align="right"><span class="colorXanh">'.number_format($cannangh,3,".",",").'</span></td>
					<td align="right"><span class="colorXanh"> '.number_format($cannangvh,3,".",",").'</span></td>
					<td align="center"></td>
					<td align="right"></td>
					<td align="right"><span class="colorXanh"> '.number_format($hao,3,".",",").'</span></td>
					<td align="right"><span class="colorXanh"> '.number_format($du,3,".",",").'</span></td>
					<td align="center"></td>
                </tr>    
			</table>	
		';
	}
	return $str;
}
function getListTableKhoKhacKhoSauCheTacPrint($table, $wh){
	$sql = $list = $str = '';
	$rs = $i = 0;
	///////////load nhập kho Tổng Kho Dẻ Cục
	$sql = "select * from $GLOBALS[db_sp].".$table." 
			$wh 
			order by maphieu asc, id asc
	";
	$rs = $GLOBALS["sp"]->getAll($sql);
	if( ceil(count($rs)) > 0){
		$trongluongvangsauchetac = $hao = $du = 0;
		foreach($rs as $value){
			$i++;
			$trongluongvangsauchetac = round(($trongluongvangsauchetac + $value['trongluongvangsauchetac']),3); 			
			$hao = round(($hao + $value['hao']),3); 
			$du = round(($du + $value['du']),3); 
			$list .= '

				<tr>
					<td  height="25" align="left">
						'.$i.'
					</td>
					<td  height="25" align="left">
						'.date("d/m/Y", strtotime($value['datechuyen'])).'
					</td>
					<td  height="25" align="left">
						'.$value['maphieu'].'
					</td>
				   <td  height="25" align="left">
						'.getName("loaivang","name_vn",$value['idloaivang']).' 
				   </td> 
				   <td  height="25" align="right">
						'.number_format($value['trongluongvangsauchetac'],3,".",",").'
				   </td> 
				   <td  height="25" align="right">
						'.number_format($value['tuoivangsauchetac'],4,".",",").'
				   </td>
					<td  height="25" align="right">
						'.number_format($value['hoiche'],3,".",",").'
				   </td>
				   
					<td  height="25" align="right">
						'.number_format($value['hao'],3,".",",").'
				   </td>
				   <td  height="25" align="right">
						'.number_format($value['du'],3,".",",").'
				   </td>
				   <td  height="25" align="left">
					   '.$value['ghichu'].'
				   </td> 
				</tr>
			';	
		}
		$str = '
			
			<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table-bordered tableMain">
				<tr class="trheader">
                	<td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td width="8%">
                        <strong>Ngày nhận</strong>
                    </td>
                    
                    <td width="10%">
                        <strong>Mã phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Loại Vàng</strong>
                    </td>
                    
                    <td>
                        <strong>Tổng TL vàng sau chế tác</strong>
                    </td>
                   
                    <td>
                        <strong>Tuổi vàng sau chế tác</strong>
                    </td>
                    
                    <td>
                        <strong>Hội chế tác</strong>
                    </td>
                    <td width="4%">
                        <strong>Hao</strong>
                    </td>
                    <td width="4%">
                        <strong>Dư</strong>
                    </td>
                     <td>
                        <strong>Ghi chú</strong>
                    </td>
                    
                </tr>
				'.$list.'
				<tr class="Paging fontSizeTon">
                    <td align="right" colspan="4"> <span class="colorXanh">Tổng Nhập Kho:</span> </td>
                    <td align="right"><strong class="colorXanh"> '.number_format($trongluongvangsauchetac,3,".",",").' </strong></td>
                    <td align="right"></td>
                    <td align="right"></td>
                    <td align="right"><span class="colorXanh"> '.number_format($hao,3,".",",").' </span></td>
                    <td align="right"><span class="colorXanh"> '.number_format($du,3,".",",").' </span></td>
                    <td align="center"></td>
                </tr>         
				
			</table>	
		';
	}
	return $str;
}
function getListTableKhoKhacKhoKimCuongEpTemPrint($table, $wh){
	$sql = $list = $str = '';
	$rs = $i = $soluong = $dongia = 0;
	$sql = "select * from $GLOBALS[db_sp].".$table." 
			$wh 
			order by maphieu asc, id asc
	";
	$rs = $GLOBALS["sp"]->getAll($sql);
	if( ceil(count($rs)) > 0){
		foreach($rs as $value){
			$i++;
			$soluong++;
			$dongia = round(($dongia + $value['dongiaban']),3);
			$list .= '
				<tr>
					<td  height="25" align="left">
						'.$i.'
					</td>
					<td  height="25" align="left">
						'.date("d/m/Y", strtotime($value['dated'])).'
					</td>
					<td  height="25" align="left">
						'.$value['maphieu'].'
					</td>
					<td  height="25" align="left">
						'.getName("categories","name_vn",$value['nhomnguyenlieukimcuong']).'
					</td> 
				   <td  height="25" align="left">
					   '.getName("categories","name_vn",$value['tennguyenlieukimcuong']).'
				   </td> 
				   <td  height="25" align="left">
						'.getName("loaikimcuonghotchu","size",$value['idkimcuong']).'::'.getName("loaikimcuonghotchu","name_vn",$value['idkimcuong']).' 
				   </td> 
				   <td height="25" align="left">
						'.$value['codegdpnj'].'
				   </td> 
				   <td height="25" align="left">
						'.$value['codecgta'].'
				   </td>
					<td  height="25" align="left">
						'.$value['kichthuoc'].'
				   </td>
				   <td  height="25" align="left">
						'.$value['trongluonghot'].'
				   </td>
				   <td  height="25" align="left">
						'.$value['dotinhkhiet'].'
				   </td>
					<td  height="25" align="left">
						'.$value['capdomau'].'
				    </td>
					
					<td  height="25" align="left">
						'.$value['domaibong'].'
				    </td>
					<td  height="25" align="left">
						'.$value['kichthuocban'].'
				    </td>
					<td  height="25" align="right">
						1
				    </td>
				   <td  height="25" align="right">
						'.number_format($value['dongiaban'],3,".",",").'
				   </td>
				   <td  height="25" align="left">
						'.$value['ghichukimcuong'].'
				    </td>
				</tr>
			';	
		}
		$str = '
			<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table-bordered tableMain">
				<tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    <td>
                        <strong>Ngày nhập</strong>
                    </td>

                    <td>
                        <strong>Mã Phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Nhóm N Liệu</strong>
                    </td>
                    
                    <td>
                        <strong>Tên N Liệu</strong>
                    </td>
                    
                    <td width="12%">
                        <strong>Tên Kim Cương</strong>
                    </td>
                    <td>
                        <strong>MS GĐPNJ</strong>
                    </td>
					<td>
                        <strong>MS Cạnh GIAJ</strong>
                    </td>
                    <td>
                        <strong>Kích Thước</strong>
                    </td>
                    <td>
                        <strong>TL Hột</strong>
                    </td>
                    <td>
                        <strong>Độ Tinh Khiết</strong>
                    </td>
                    
                     <td>
                        <strong>Cấp Độ Màu</strong>
                    </td>
                    <td>
                        <strong>Độ Mài Bóng</strong>
                    </td>
                    <td>
                        <strong>Kích Thước Bán</strong>
                    </td>
                    <td>
                        <strong>Số lượng</strong>
                    </td>
                    <td>
                        <strong>Đơn Giá</strong>
                    </td>
					<td>
						<strong>Ghi Chú</strong>
					</td>
                </tr>
				'.$list.'
				<tr class="Paging fontSizeTon">
                    <td align="right" colspan="14"> <strong class="colorXanh">Tổng:</strong> </td>
                    <td align="right"><span class="colorXanh">'.$soluong.'</span></td>
                    <td align="right"><span class="colorXanh">'.number_format($dongia,3,".",",").'</span></td>
					<td align="center"></td>
                </tr>    
			</table>	
		';
	}
	return $str;
}
//==========================================End thông kê Print tông kho khác==============================

//==================================Kho nguồn vào===============================================

function getListTableVang($table, $wh){
	$sql = $list = $str = '';
	$rs = $i = 0;
	///////////load nhập kho anh chín Vàng
	$sql = "select * from $GLOBALS[db_sp].$table 
				where typevkc = 1 
				and type=2 
				$wh 
			order by numphieu asc, dated asc
	";
	$rs = $GLOBALS["sp"]->getAll($sql);
	if( ceil(count($rs)) > 0){
		$cannangvh = $cannangh = $cannangv = $hao = $du = 0;
		foreach($rs as $value){
			$i++;
			$cannangvh = round(($cannangvh + $value['cannangvh']),3); 
			$cannangh = round(($cannangh + $value['cannangh']),3); 
			$cannangv = round(($cannangv + $value['cannangv']),3);
			$hao = round(($hao + $value['hao']),3); 
			$du = round(($du + $value['du']),3);
			$list .= '
				<tr>
					<td>
						'.$i.'
					</td>
					<td>
						'.date("d/m/Y", strtotime($value['dated'])).'
					</td>
					<td>
						'.$value['maphieu'].'
					</td>
					<td>
						'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
					</td> 
				   <td>
					   '.getName("categories","name_vn",$value['tennguyenlieuvang']).'
				   </td> 
				   <td>
						'.getName("loaivang","name_vn",$value['idloaivang']).' 
				   </td> 
				   <td class="text-right">
						'.number_format($value['cannangvh'],3,".",",").'
				   </td> 
				   <td class="text-right">
						'.number_format($value['cannangh'],3,".",",").'
				   </td>
					<td class="text-right">
						'.number_format($value['cannangv'],3,".",",").'
				   </td>
				   <td class="text-right">
						'.number_format($value['tuoivang'],4,".",",").'
				   </td>
				   <td>
						'.$value['tienmatvang'].'
				   </td>
					<td class="text-right">
						'.number_format($value['hao'],3,".",",").'
				   </td>
				   <td class="text-right">
						'.number_format($value['du'],3,".",",").'
				   </td>
				   <td>
					   '.$value['ghichuvang'].'
				   </td> 
				   
				</tr>
			';	
		}
		$str = '
			<table  class="table-bordered">
				<tr class="trheader">
					<td class="tdSTT">
						<strong>STT</strong>
					</td>
					<td>
						<strong>Ngày nhập</strong>
					</td>
	
					<td>
						<strong>Mã Phiếu</strong>
					</td>
					
					<td>
						<strong>Nhóm N Liệu</strong>
					</td>
					
					<td>
						<strong>Tên N Liệu</strong>
					</td>
					
					<td>
						<strong>Loại Vàng</strong>
					</td>
					
					<td>
						<strong>Cân Nặng V+H</strong>
					</td>
				   
					<td>
						<strong>Cân Nặng H</strong>
					</td>
					<td>
						<strong>Cân Nặng V</strong>
					</td>
					<td>
						<strong>Tuổi vàng</strong>
					</td>
					<td>
						<strong>Tiền mặt</strong>
					</td>
					
					<td width="4%">
						<strong>Hao</strong>
					</td>
					<td width="4%">
						<strong>Dư</strong>
					</td>
					<td>
						<strong>Ghi chú</strong>
					</td>
				</tr>
				'.$list.'
				<tr class="Paging fontSizeTon">
					<td align="right" colspan="6"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
					<td align="right"><span class="colorXanh">'.number_format($cannangvh,3,".",",").'</span></td>
					<td align="right"><span class="colorXanh">'.number_format($cannangh,3,".",",").'</span></td>
					<td align="right"><span class="colorXanh"> '.number_format($cannangvh,3,".",",").'</span></td>
					<td align="center"></td>
					<td align="right"></td>
					<td align="right"> '.number_format($hao,3,".",",").' </td>
					<td align="right"> '.number_format($du,3,".",",").' </td>
					<td align="right"></td>
                </tr>    
			</table>	
		';
	}
	return $str;
}

function getListTableKimCuong($table, $wh){
	$sql = $list = $str = '';
	$rs = $i = $soluong = $dongia = 0;
	///////////load nhập kho anh chín Vàng
	$sql = "select * from $GLOBALS[db_sp].$table 
				where typevkc = 2 
				and type=2 
				$wh 
			order by numphieu asc, dated asc
	";
	$rs = $GLOBALS["sp"]->getAll($sql);
	if( ceil(count($rs)) > 0){
		foreach($rs as $value){
			$i++;
			$soluong++;
			$dongia = round(($dongia + $value['dongiaban']),3);
			$list .= '
				<tr>
					<td>
						'.$i.'
					</td>
					<td>
						'.date("d/m/Y", strtotime($value['dated'])).'
					</td>
					<td>
						'.$value['maphieu'].'
					</td>
					<td>
						'.getName("categories","name_vn",$value['nhomnguyenlieukimcuong']).'
					</td> 
				   <td>
					   '.getName("categories","name_vn",$value['tennguyenlieukimcuong']).'
				   </td> 
				   <td>
						'.getName("loaikimcuonghotchu","size",$value['idkimcuong']).'::'.getName("loaikimcuonghotchu","name_vn",$value['idkimcuong']).' 
				   </td> 
				   <td>
						'.$value['codegdpnj'].'
				   </td> 
				   <td>
						'.$value['codecgta'].'
				   </td>
					<td>
						'.$value['kichthuoc'].'
				   </td>
				   <td>
						'.$value['trongluonghot'].'
				   </td>
				   <td>
						'.$value['dotinhkhiet'].'
				   </td>
					<td>
						'.$value['capdomau'].'
				    </td>
					
					<td>
						'.$value['domaibong'].'
				    </td>
					<td>
						'.$value['kichthuocban'].'
				    </td>
					<td class="text-right">
						1
				    </td>
				   <td class="text-right">
						'.number_format($value['dongiaban'],3,".",",").'
				   </td>
				   <td>
						'.$value['ghichu'].'
				    </td>
				</tr>
			';	
		}
		$str = '
			<table  class="table-bordered">
				<tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    <td>
                        <strong>Ngày nhập</strong>
                    </td>

                    <td>
                        <strong>Mã Phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Nhóm N Liệu</strong>
                    </td>
                    
                    <td>
                        <strong>Tên N Liệu</strong>
                    </td>
                    
                    <td width="12%">
                        <strong>Tên Kim Cương</strong>
                    </td>
                    <td>
                        <strong>MS GĐPNJ</strong>
                    </td>
					<td>
                        <strong>MS Cạnh GIAJ</strong>
                    </td>
                    <td>
                        <strong>Kích Thước</strong>
                    </td>
                    <td>
                        <strong>TL Hột</strong>
                    </td>
                    <td>
                        <strong>Độ Tinh Khiết</strong>
                    </td>
                    
                     <td>
                        <strong>Cấp Độ Màu</strong>
                    </td>
                    <td>
                        <strong>Độ Mài Bóng</strong>
                    </td>
                    <td>
                        <strong>Kích Thước Bán</strong>
                    </td>
                    <td width="5%">
                        <strong>Số lượng</strong>
                    </td>
                    <td width="8%">
                        <strong>Giá Vốn</strong>
                    </td>
					<td>
                        <strong>Ghi chú</strong>
                    </td>
                </tr>
				'.$list.'
				<tr class="Paging fontSizeTon">
                    <td align="right" colspan="14"> <strong class="colorXanh">Tổng:</strong> </td>
                    <td align="right"><span class="colorXanh">'.$soluong.'</span></td>
                    <td align="right"><span class="colorXanh">'.number_format($dongia,3,".",",").'</span></td>
					<td align="right"></td>
                </tr>    
			</table>	
		';
	}
	return $str;
}

//==========================================thông kê Print tông kho nguon ==============================
function getListTableVangPrint($table, $wh){
	$sql = $list = $str = '';
	$rs = $i = 0;
	///////////load nhập kho anh chín Vàng
	$sql = "select * from $GLOBALS[db_sp].$table 
				where typevkc = 1 
				and type=2 
				$wh 
			order by numphieu asc, dated asc
	";
	$rs = $GLOBALS["sp"]->getAll($sql);
	if( ceil(count($rs)) > 0){
		$cannangvh = $cannangh = $cannangv = $hao = $du = 0;
		foreach($rs as $value){
			$i++;
			$cannangvh = round(($cannangvh + $value['cannangvh']),3); 
			$cannangh = round(($cannangh + $value['cannangh']),3); 
			$cannangv = round(($cannangv + $value['cannangv']),3); 
			
			$hao = round(($hao + $value['hao']),3); 
			$du = round(($du + $value['du']),3);
			$list .= '
				<tr>
					<td height="25" align="left">
						'.$i.'
					</td>
					<td  height="25" align="left">
						'.date("d/m/Y", strtotime($value['dated'])).'
					</td>
					<td  height="25" align="left">
						'.$value['maphieu'].'
					</td>
					<td  height="25" align="left">
						'.getName("categories","name_vn",$value['nhomnguyenlieuvang']).'
					</td> 
				   <td  height="25" align="left">
					   '.getName("categories","name_vn",$value['tennguyenlieuvang']).'
				   </td> 
				   <td height="25" align="left">
						'.getName("loaivang","name_vn",$value['idloaivang']).' 
				   </td> 
				   <td  height="25" align="right">
						'.number_format($value['cannangvh'],3,".",",").'
				   </td> 
				   <td height="25" align="right">
						'.number_format($value['cannangh'],3,".",",").'
				   </td>
					<td height="25" align="right">
						'.number_format($value['cannangv'],3,".",",").'
				   </td>
				   <td height="25" align="right">
						'.number_format($value['tuoivang'],4,".",",").'
				   </td>
				   <td  height="25" align="left">
						'.$value['tienmatvang'].'
				   </td>
					<td height="25" align="right">
						'.number_format($value['hao'],3,".",",").'
				   </td>
				   <td height="25" align="right">
						'.number_format($value['du'],3,".",",").'
				   </td>
				   <td  height="25" align="left">
						'.$value['ghichuvang'].'
				   </td>
				</tr>
			';	
		}
		$str = '
			<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table-bordered tableMain">
				<tr class="trheader">
					<td>
						<strong>STT</strong>
					</td>
					<td>
						<strong>Ngày nhập</strong>
					</td>
	
					<td>
						<strong>Mã Phiếu</strong>
					</td>
					
					<td>
						<strong>Nhóm N Liệu</strong>
					</td>
					
					<td>
						<strong>Tên N Liệu</strong>
					</td>
					
					<td>
						<strong>Loại Vàng</strong>
					</td>
					
					<td>
						<strong>Cân Nặng V+H</strong>
					</td>
				   
					<td>
						<strong>Cân Nặng H</strong>
					</td>
					<td>
						<strong>Cân Nặng V</strong>
					</td>
					<td>
						<strong>Tuổi vàng</strong>
					</td>
					<td>
						<strong>Tiền mặt</strong>
					</td>
					
					<td>
						<strong>Hao</strong>
					</td>
					<td>
						<strong>Dư</strong>
					</td>
					<td>
						<strong>Ghi Chú</strong>
					</td>
				</tr>
				'.$list.'
				<tr class="Paging fontSizeTon">
					<td align="right" colspan="6"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
					<td align="right"><span class="colorXanh">'.number_format($cannangvh,3,".",",").'</span></td>
					<td align="right"><span class="colorXanh">'.number_format($cannangh,3,".",",").'</span></td>
					<td align="right"><span class="colorXanh"> '.number_format($cannangvh,3,".",",").'</span></td>
					<td align="center"></td>
					<td align="right"></td>
					<td align="right"><span class="colorXanh"> '.number_format($hao,3,".",",").'</span></td>
					<td align="right"><span class="colorXanh"> '.number_format($du,3,".",",").'</span></td>
					<td align="center"></td>
                </tr>    
			</table>	
		';
	}
	return $str;
}

function getListTableKimCuongPrint($table, $wh){
	$sql = $list = $str = '';
	$rs = $i = $soluong = $dongia = 0;
	///////////load nhập kho anh chín Vàng
	$sql = "select * from $GLOBALS[db_sp].$table 
				where typevkc = 2 
				and type=2 
				$wh 
			order by numphieu asc, dated asc
	";
	$rs = $GLOBALS["sp"]->getAll($sql);
	if( ceil(count($rs)) > 0){
		foreach($rs as $value){
			$i++;
			$soluong++;
			$dongia = round(($dongia + $value['dongiaban']),3);
			$list .= '
				<tr>
					<td  height="25" align="left">
						'.$i.'
					</td>
					<td  height="25" align="left">
						'.date("d/m/Y", strtotime($value['dated'])).'
					</td>
					<td  height="25" align="left">
						'.$value['maphieu'].'
					</td>
					<td  height="25" align="left">
						'.getName("categories","name_vn",$value['nhomnguyenlieukimcuong']).'
					</td> 
				   <td  height="25" align="left">
					   '.getName("categories","name_vn",$value['tennguyenlieukimcuong']).'
				   </td> 
				   <td  height="25" align="left">
						'.getName("loaikimcuonghotchu","size",$value['idkimcuong']).'::'.getName("loaikimcuonghotchu","name_vn",$value['idkimcuong']).' 
				   </td> 
				   <td height="25" align="left">
						'.$value['codegdpnj'].'
				   </td> 
				   <td height="25" align="left">
						'.$value['codecgta'].'
				   </td>
					<td  height="25" align="left">
						'.$value['kichthuoc'].'
				   </td>
				   <td  height="25" align="left">
						'.$value['trongluonghot'].'
				   </td>
				   <td  height="25" align="left">
						'.$value['dotinhkhiet'].'
				   </td>
					<td  height="25" align="left">
						'.$value['capdomau'].'
				    </td>
					
					<td  height="25" align="left">
						'.$value['domaibong'].'
				    </td>
					<td  height="25" align="left">
						'.$value['kichthuocban'].'
				    </td>
					<td  height="25" align="right">
						1
				    </td>
				   <td  height="25" align="right">
						'.number_format($value['dongiaban'],3,".",",").'
				   </td>
				   <td  height="25" align="left">
						'.$value['ghichukimcuong'].'
				    </td>
				</tr>
			';	
		}
		$str = '
			<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table-bordered tableMain">
				<tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    <td>
                        <strong>Ngày nhập</strong>
                    </td>

                    <td>
                        <strong>Mã Phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Nhóm N Liệu</strong>
                    </td>
                    
                    <td>
                        <strong>Tên N Liệu</strong>
                    </td>
                    
                    <td width="12%">
                        <strong>Tên Kim Cương</strong>
                    </td>
                    <td>
                        <strong>MS GĐPNJ</strong>
                    </td>
					<td>
                        <strong>MS Cạnh GIAJ</strong>
                    </td>
                    <td>
                        <strong>Kích Thước</strong>
                    </td>
                    <td>
                        <strong>TL Hột</strong>
                    </td>
                    <td>
                        <strong>Độ Tinh Khiết</strong>
                    </td>
                    
                     <td>
                        <strong>Cấp Độ Màu</strong>
                    </td>
                    <td>
                        <strong>Độ Mài Bóng</strong>
                    </td>
                    <td>
                        <strong>Kích Thước Bán</strong>
                    </td>
                    <td>
                        <strong>Số lượng</strong>
                    </td>
                    <td>
                        <strong>Đơn Giá</strong>
                    </td>
					<td>
						<strong>Ghi Chú</strong>
					</td>
                </tr>
				'.$list.'
				<tr class="Paging fontSizeTon">
                    <td align="right" colspan="14"> <strong class="colorXanh">Tổng:</strong> </td>
                    <td align="right"><span class="colorXanh">'.$soluong.'</span></td>
                    <td align="right"><span class="colorXanh">'.number_format($dongia,3,".",",").'</span></td>
					<td align="center"></td>
                </tr>    
			</table>	
		';
	}
	return $str;
}
function creaFolder($thumuc){
	mkdir($thumuc, 0755);	
}

function insert_getTonctKSXKhoThanhPham($a){
	$idpnk = $a['idpnk'];
	$slvangcat = $a['slvangcat'];
	$getcannangv = 0;
	if(ceil(trim($idpnk)) > 0){
		$sql = "select * from $GLOBALS[db_sp].khosanxuat_khothanhpham where type in (2,3) and trangthai in (0,1) and idpnk=".$idpnk;
		$rs = $GLOBALS["sp"]->getAll($sql);
		$tongvangcat = 0;
		foreach($rs as $item){
			$tongvangcat = $tongvangcat + $item['cannangv'];				
		}
	}
	$getcannangv = $slvangcat - $tongvangcat;
	return $getcannangv;
}

// M.Tân thêm get số lượng xuât và tồn (TL Vàng + Số lượng TH) dựa trên thông tin phiếu nhập kho
function insert_getXuatTonDonHangTongTheoPhieuNhap($a) {
	$cid = ceil(trim($a['cid']));
	$idpnk = ceil(trim($a['idpnk']));

	return getXuatTonDonHangTongTheoPhieuNhap($cid, $idpnk);
}

function getXuatTonDonHangTongTheoPhieuNhap($cid, $idpnk) {
	$arrlist = array();

	if($cid > 0) {
		$sqlGetTable = "select `table` from $GLOBALS[db_sp].categories where id=".$cid;
		$table = $GLOBALS["sp"]->getOne($sqlGetTable);
		if($idpnk > 0) {
			
			// Get cân nặng vàng và số lượng toa hàng của phiếu nhập
			$sqlNhapKho = "select cannangv, soluongchuyen, slvangcat
						   		  from $GLOBALS[db_sp].$table 
						   		  where id=".$idpnk;
			$rsNhapKho = $GLOBALS["sp"]->getRow($sqlNhapKho);
			
			$sqlXuatKhoChuaDuyet = "select ROUND(SUM(cannangv), 3) as cannangv 
										   from $GLOBALS[db_sp].$table 
										   where type in (2,3) and trangthai in (0,1) and idpnk=".$idpnk;
			$tongCanNangVXuatKhoChuaDuyet = $GLOBALS["sp"]->getOne($sqlXuatKhoChuaDuyet);

			// Get cân nặng vàng và số lượng toa hàng đã xuất kho
			$sqlXuatKho = "select ROUND(SUM(soluongchuyen), 3) as soluongchuyen
						   		  from $GLOBALS[db_sp].$table 
						   		  where type in (2,3) and trangthai = 2 and idpnk=".$idpnk;
			$rsXuatKho = $GLOBALS["sp"]->getRow($sqlXuatKho);

			$arrlist['trongLuongVCatXK'] = round(($rsNhapKho['slvangcat'] - $tongCanNangVXuatKhoChuaDuyet),3);
			$arrlist['trongLuongVXKConLai'] = round(($rsNhapKho['cannangv'] - $arrlist['trongLuongVCatXK']),3);
			$arrlist['soLuongToaHang'] = $rsNhapKho['soluongchuyen'];
			$arrlist['soLuongToaHangXK'] = $rsXuatKho['soluongchuyen'];
			$arrlist['soLuongToaHangConLai'] = round(($rsNhapKho['soluongchuyen'] - $rsXuatKho['soluongchuyen']),0);
		}
	}
	return $arrlist;
}

/// M.Tân thêm ngày 25/07/2019
function ghiSoHachToanKhoVatTu($tablehachtoan, $tablect, $id, $typehachtoan){

	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');

	/////////////////ghi vào sổ đầu kỳ(hạch toán) vattu_khoquanlyvattu_sodudauky////////////////
	$item = getTableRow($tablect,' and id='.$id); 
	unset($arrnx1day);
	$arrnx1day =  array();
	$soluongnhap = $soluongxuat = $soluongton = $slnhap = $slxuat = 0;
	
	// Check type để gán số lượng vào nhập hay xuất
	if($item['type'] == 1){ // 1 = nhập
		$slnhap = $item['soluong'];
	} else { // 2 = xuất
		$slxuat = $item['soluong'];
	}

	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idmavattu=".$item['idmavattu']." and dated='".$datedauthang."'";
	$rsdate = $GLOBALS['sp']->getRow($sqldate);
	
	if(empty($rsdate['id'])){// chưa có dated trong csdl $tablehachtoan thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		
		$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idmavattu=".$item['idmavattu']." order by dated desc limit 1"; // Lấy ngày cuối cùng mà với idmavattu đó có
		
		$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		if($rstru1day['id'] > 0){ // Nếu có tồn tại ngày cuối cùng thì lấy số lượng tồn còn lại của idmavattu đó
			$soluongton = $rstru1day['soluongton'];
		}
		
		$soluongnhap += $slnhap;
		$soluongxuat += $slxuat;
		$soluongton = ($soluongton + $slnhap) - $slxuat;
		
		$arrnx1day['soluongnhap'] = $soluongnhap;
		$arrnx1day['soluongxuat'] = $soluongxuat;
		$arrnx1day['soluongton'] = $soluongton;

		$arrnx1day['idmavattu'] = $item['idmavattu'];
		$arrnx1day['dated'] = $datedauthang;
		
		vaInsert($tablehachtoan, $arrnx1day);
	}
	else{// có rồi thi update vào sodudauky

		$soluongnhap = $rsdate['soluongnhap'] + $slnhap;
		$soluongxuat = $rsdate['soluongxuat'] + $slxuat;
		$soluongton = ($rsdate['soluongton'] + $slnhap) - $slxuat;

		$arrnx1day['soluongnhap'] = $soluongnhap;
		$arrnx1day['soluongxuat'] = $soluongxuat;
		$arrnx1day['soluongton'] = $soluongton;

		vaUpdate($tablehachtoan, $arrnx1day,' id='.$rsdate['id']);
	}
}

// M.Tân thêm ngày 13/08/2019
function insert_getCountChiNhanhVatTu($a) {
	$typephongbanchuyen = $a['typephongbanchuyen'];
	if($typephongbanchuyen > 0) {
		$sql = "select count(id) from $GLOBALS[db_sp].vattu_khoquanlyvattuct where typephongbanchuyen= ".$typephongbanchuyen." and dachon=0";
		$rs = $GLOBALS["sp"]->getOne($sql);
	}
	return ceil($rs);
}

// M.Tân thêm ngày 21/08/2019
function insert_thongKeKhoVatTuTonKho($a){
	
	$arrlist = array();
	$sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlnhaptndt = $sqlnhapdt = $rsnhapdt = $sqlxuatdt = $rsxuatdt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	//$cid = $a['cid'];
	$cid = ceil(trim($a['cid']));
	$idmavattu = ceil(trim($a['idmavattu']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$datenow = date("Y-m-d");
	// die($fromDate);
	// die('xx'.$cid);
	// die($fromDate.' '.$toDate);
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$tablect = $rsgettable['tablect'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		} else {
			$fromDate = date("d/m/Y");
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		} else {
			$toDate = date("d/m/Y");
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		}

		if($idmavattu > 0){
				
			$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
			$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
			// die($thangtruoc);

			// Get số lượng đầu kỳ
			$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idmavattu=".$idmavattu." and dated <= '".$thangtruoc."' order by id desc limit 1";
			$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
			
			$sltonsddk = round($rstonsddk['soluongton'],3);					
			$thangdauky = $rstonsddk['dated']; 

			// Get số lượng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sqlnhapdt = "select ROUND(SUM(soluong), 3)  as soluongnhap from $GLOBALS[db_sp].".$tablect." 
							where idmavattu=".$idmavattu." 
							and type=1
							and trangthai = 2
							and datedhachtoan < '".$fromDate."'  
							and datedhachtoan >= '".$datedauthang."' 
			"; 
			
			$rsnhapdt = $GLOBALS["sp"]->getRow($sqlnhapdt);	
			//die($sqlnhaptndt);
			$sqlxuatdt = "select ROUND(SUM(soluong), 3) as soluongxuat from $GLOBALS[db_sp].".$tablect." 
							where idmavattu=".$idmavattu."
							and type=2
							and trangthai = 2 
							and datedhachtoan < '".$fromDate."'  
							and datedhachtoan >= '".$datedauthang."' 
			"; 
			//die($sqlxuattndt);
			$rsxuatdt = $GLOBALS["sp"]->getRow($sqlxuatdt);	
			
			$sltondt = round(($rsnhapdt['soluongnhap'] - $rsxuatdt['soluongxuat']),3); 
			$sltonsddk = round(($sltonsddk + $sltondt),3);

			// Get số lượng nhập, xuất, tồn từ ngày đến ngày 
			$sqlnhap = "select ROUND(SUM(soluong), 3) as soluongnhap from $GLOBALS[db_sp].".$tablect." 
							where idmavattu=".$idmavattu." 
							and type=1
							and trangthai = 2
							and datedhachtoan >= '".$fromDate."'  
							and datedhachtoan <= '".$toDate."' 
			"; 
			$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
			
			$sqlxuat = "select ROUND(SUM(soluong), 3) as soluongxuat from $GLOBALS[db_sp].".$tablect." 
							where idmavattu=".$idmavattu."
							and type=2
							and trangthai = 2
							and datedhachtoan >= '".$fromDate."'  
							and datedhachtoan <= '".$toDate."' 
			"; 
			$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

			$sltontndn = round(($rsnhap['soluongnhap'] - $rsxuat['soluongxuat']),3);
			$slton = $sltonsddk + $sltontndn;
			
			$arrlist['soluongnhap'] = $rsnhap['soluongnhap'];
			$arrlist['soluongxuat'] = $rsxuat['soluongxuat'];
			
			$arrlist['slton'] = $slton;
			$arrlist['sltonsddk'] = $sltonsddk;

		}
		else{
			$arrlist['idmavattu'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

// M.Tân thêm ngày 29/10/2019
function insert_getPhuKienCatalog($a){
	$table = $a['table'];
	$id = $a['id'];
	$sql = "select * from $GLOBALS[db_catalog].".$table." where id=$id";
	$rs = $GLOBALS["catalog"]->getRow($sql);

	// print_r($rs); die();
	return $rs;
}

function getMaPhuKienCatalog($id) {
	$sql = "select * from $GLOBALS[db_catalog].products where id=$id";
	$rs = $GLOBALS["catalog"]->getRow($sql);
	
	return $maphukien = $rs['code'];
}

// M.Tân thêm ngày 20/08/2021 - Get mã phụ kiện theo table phukien mới
function getMaPhuKienCatalogNew($id) {
	$sql = "select * from $GLOBALS[db_catalog].phukien where id=$id";
	$rs = $GLOBALS["catalog"]->getRow($sql);
	
	return $maphukien = $rs['code'];
}

// M.Tân thêm ngày 08/09/2021 - Inset get mã phụ kiện theo table phukien mới
function insert_getMaPhuKienCatalogNew($a) {
	$id = $a['id'];
	$sql = "select * from $GLOBALS[db_catalog].phukien where id=$id";
	$rs = $GLOBALS["catalog"]->getRow($sql);
	
	return $maphukien = $rs['code'];
}

/*==============VŨ THÊM Ghi sổ Hạch toán KHO SẢN XUẤT PHỤ KIỆN==================*/
function ghiSoHachToanKhoSanXuatPhuKien($tablehachtoan, $tablenhan, $id){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	if($item['type']==1){//số lượng nhập
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
	}
	else{ // số lượng xuất
		$slxuatvhrc = $item['cannangvh'];
		$slxuatvrc = $item['cannangv'];
		$slxuathrc = $item['cannangh'];
	}
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				//////////////////nhập vàng + hột
				$sltonvh = $rstru1day['sltonvh'];
				//////////////////nhập vàng
				$sltonv = $rstru1day['sltonv'];
				//////////////////nhập hot
				$sltonh = $rstru1day['sltonh'];
				
			}
			//////////////////nhập vàng + hột
			$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3);
			
			$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3);
			$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
			$arrnx1day['slxuatvh'] = $slxuatvhrc;
			$arrnx1day['slxuatv'] = $slxuatvrc;
			$arrnx1day['slxuath'] = $slxuathrc;
			
			
			$arrnx1day['idloaivang'] = $item['idloaivang']; // chỉ có nhập mới inser loại vàng, xuất không cần

		}
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
			$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
			$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3);
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
		}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}
///////
function ghiSoHachToanPhuKien($tablehachtoan, $tablenhan, $id, $typehachtoan){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	//print_r($item); die($tablenhan);
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	if($typehachtoan =='nhapkho'){//xác nhận hạch toán table mới luôn là nhập kho
		$item['type'] = 1;
	}
	if($typehachtoan =='xuatkho'){//xác nhận hạch toán table mới luôn là nhập kho
		$item['type'] = 2;
	}	
	
	if($item['type']==1){//số lượng nhập
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
		
		$dongianhaprc = $item['dongiaban'];;
		$slnhapkimcuongrc = 1;	
	}
	else{ // số lượng xuất
		$slxuatvhrc = $item['cannangvh'];
		$slxuatvrc = $item['cannangv'];
		$slxuathrc = $item['cannangh'];
		if($tablenhan == 'khokhac_kholammoi'){
			$haorc = $item['hao'];
			$durc = $item['du'];
		}
		else{
			$haorc = $item['haochuyen'];
			$durc = $item['duchuyen'];		
		}
		$dongiaxuatrc = $item['dongiaban'];
		$slxuatkimcuongrc = 1;
	}
	if($item['typevkc']==1){/// là vàng
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];	
	}
	else{
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and typevkc=".$item['typevkc'];	
	}
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				//////////////////nhập vàng + hột
				$sltonvh = $rstru1day['sltonvh'];
				//////////////////nhập vàng
				$sltonv = $rstru1day['sltonv'];
				//////////////////nhập hot
				$sltonh = $rstru1day['sltonh'];
				
			}
			//////////////////nhập vàng + hột
			$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3) ;
			$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
			$arrnx1day['slxuatvh'] = $slxuatvhrc;
			$arrnx1day['slxuatv'] = $slxuatvrc;
			$arrnx1day['slxuath'] = $slxuathrc;
			
			$arrnx1day['hao'] = $haorc;
			$arrnx1day['du'] = $durc;
			
			$arrnx1day['idloaivang'] = $item['idloaivang']; // chỉ có nhập mới inser loại vàng, xuất không cần

		}
		else{ // là kim cương
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);

			
			if($rstru1day['id'] > 0){
				$sltonkimcuong = $rstru1day['sltonkimcuong'];
				$tongdongia = $rstru1day['tongdongia'];
			}	
			$sltonkimcuong = round(round(($sltonkimcuong + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3);
			$tongdongia = round(round(($tongdongia + $dongianhaprc),3) - $dongiaxuatrc,3);
			
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuongrc;
			$arrnx1day['slxuatkimcuong'] = $slxuatkimcuongrc;
			
			$arrnx1day['dongianhap'] = $dongianhaprc;
			$arrnx1day['dongiaxuat'] = $dongiaxuatrc;
			$arrnx1day['tongdongia'] = $tongdongia;
		}
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
			$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			
			$hao = round(($rsdate['hao'] + $haorc),3);
			$du = round(($rsdate['du'] + $durc),3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
			$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3) ;
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
		
			$arrnx1day['hao'] = $hao;
			$arrnx1day['du'] = $du;
		}
		else{// là kim cương
			$slnhapkimcuong = round(($rsdate['slnhapkimcuong'] + $slnhapkimcuongrc),3);
			$slxuatkimcuong = round(($rsdate['slxuatkimcuong'] + $slxuatkimcuongrc),3) ;
			$sltonkimcuong = round(round(($rsdate['sltonkimcuong'] + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3) ;
			
			$dongianhap = round(($rsdate['dongianhap'] + $dongianhaprc),3);
			$dongiaxuat = round(($rsdate['dongiaxuat'] + $dongiaxuatrc),3);
			$tongdongia = round(round(($rsdate['tongdongia'] + $dongianhaprc),3) - $dongiaxuatrc,3) ;
			
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuong;
			$arrnx1day['slxuatkimcuong'] = $slxuatkimcuong;
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			
			$arrnx1day['dongianhap'] = $dongianhap;
			$arrnx1day['dongiaxuat'] = $dongiaxuat;
			$arrnx1day['tongdongia'] = $tongdongia;
		}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}
///////////////////////////////////KẾT THÚC VŨ THÊM Ghi sổ Hạch toán KHO SẢN XUẤT PHỤ KIỆN//////////////////////////////////////

// M.Tân thêm ngày 29/10/2019
function ghiSoHachToanMaPhuKien($tablehachtoan, $tablect, $id){

	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');

	/////////////////Ghi vào sổ đầu kỳ(hạch toán) khosanxuat_phukienma_sodudauky////////////////
	$item = getTableRow($tablect,' and id='.$id);
	unset($arrnx1day);
	$arrnx1day =  array();
	$soluongnhapphukien = $soluongxuatphukien = $soluongtonphukien = $soluongnhapvang = $soluongxuatvang = $soluongtonvang = $slnhapphukien = $slxuatphukien = $slnhapv = $slxuatv = 0;
	
	// Check type để gán số lượng vào nhập hay xuất
	if($item['type'] == 1){ // 1 = nhập
		$slnhapphukien = $item['soluongphukien'];
		$slnhapv = $item['cannangv'];
	} else { // 2 = xuất
		$slxuatphukien = $item['soluongphukien'];
		$slxuatv = $item['cannangv'];
	}

	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idphukien=".$item['idphukien']." AND idloaivang=".$item['idloaivang']." AND dated='".$datedauthang."'";
	$rsdate = $GLOBALS['sp']->getRow($sqldate);
	
	if(empty($rsdate['id'])){// chưa có dated trong csdl $tablehachtoan thì insert vào // hạch toán trong tháng
		
		$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idphukien=".$item['idphukien']." AND idloaivang=".$item['idloaivang']." order by dated desc limit 1"; // Lấy tháng cuối cùng hạch toán của idphukien ứng với idloaivang đó
		$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);

		if($rstru1day['id'] > 0){ // Nếu tồn tại ngày cuối cùng thì lấy số lượng tồn còn lại của idphukien ứng với idloadvang đó
			$soluongtonphukien = $rstru1day['sltonphukien'];
			$soluongtonvang = $rstru1day['sltonv'];
		}
		
		// Số lượng phụ kiện
		$soluongnhapphukien = round(($soluongnhapphukien + $slnhapphukien),3);
		$soluongxuatphukien = round(($soluongxuatphukien + $slxuatphukien),3);
		$soluongtonphukien = round(round(($soluongtonphukien + $slnhapphukien),3) - $slxuatphukien,3);

		// Số lượng vàng
		$soluongnhapvang = round(($soluongnhapvang + $slnhapv),3);
		$soluongxuatvang = round(($soluongxuatvang + $slxuatv),3);
		$soluongtonvang = round(round(($soluongtonvang + $slnhapv),3) - $slxuatv,3);
		
		$arrnx1day['slnhapphukien'] = $soluongnhapphukien;
		$arrnx1day['slxuatphukien'] = $soluongxuatphukien;
		$arrnx1day['sltonphukien'] = $soluongtonphukien;

		$arrnx1day['slnhapv'] = $soluongnhapvang;
		$arrnx1day['slxuatv'] = $soluongxuatvang;
		$arrnx1day['sltonv'] = $soluongtonvang;

		$arrnx1day['idphukien'] = $item['idphukien'];
		$arrnx1day['idloaivang'] = $item['idloaivang'];

		$arrnx1day['dated'] = $datedauthang;
		
		vaInsert($tablehachtoan, $arrnx1day);

	} else {// có rồi thi update vào sodudauky

		// Số lượng phụ kiện
		$soluongnhapphukien = round(($rsdate['slnhapphukien'] + $slnhapphukien),3);
		$soluongxuatphukien = round(($rsdate['slxuatphukien'] + $slxuatphukien),3);
		$soluongtonphukien = round(round(($rsdate['sltonphukien'] + $slnhapphukien),3) - $slxuatphukien,3);

		// Số lượng vàng
		$soluongnhapvang = round(($rsdate['slnhapv'] + $slnhapv),3);
		$soluongxuatvang = round(($rsdate['slxuatv'] + $slxuatv),3);
		$soluongtonvang = round(round(($rsdate['sltonv'] + $slnhapv),3) - $slxuatv,3);

		$arrnx1day['slnhapphukien'] = $soluongnhapphukien;
		$arrnx1day['slxuatphukien'] = $soluongxuatphukien;
		$arrnx1day['sltonphukien'] = $soluongtonphukien;

		$arrnx1day['slnhapv'] = $soluongnhapvang;
		$arrnx1day['slxuatv'] = $soluongxuatvang;
		$arrnx1day['sltonv'] = $soluongtonvang;

		vaUpdate($tablehachtoan, $arrnx1day,' id='.$rsdate['id']);
	}
}
///////////////////////////////////KẾT THÚC THÊM Ghi sổ Hạch toán KHO SẢN XUẤT PHỤ KIỆN//////////////////////////////////////
/*==============VŨ THÊM Ghi sổ Hạch toán KHO BỘT==================*/
function ghiSoHachToanKhoBot($tablehachtoan, $tablenhan, $id){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	if($item['type']==1){//số lượng nhập
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
	}
	else{ // số lượng xuất
		$slxuatvhrc = $item['cannangvh'];
		$slxuatvrc = $item['cannangv'];
		$slxuathrc = $item['cannangh'];
	}
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				//////////////////nhập vàng + hột
				$sltonvh = $rstru1day['sltonvh'];
				//////////////////nhập vàng
				$sltonv = $rstru1day['sltonv'];
				//////////////////nhập hot
				$sltonh = $rstru1day['sltonh'];
				
			}
			//////////////////nhập vàng + hột
			$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3);
			
			$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3);
			$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
			$arrnx1day['slxuatvh'] = $slxuatvhrc;
			$arrnx1day['slxuatv'] = $slxuatvrc;
			$arrnx1day['slxuath'] = $slxuathrc;
			
			
			$arrnx1day['idloaivang'] = $item['idloaivang']; // chỉ có nhập mới inser loại vàng, xuất không cần

		}
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
			$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
			$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3);
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
		}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}
///////
function ghiSoHachToanBot($tablehachtoan, $tablenhan, $id, $typehachtoan){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	//print_r($item); die($tablenhan);
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	if($typehachtoan =='nhapkho'){//xác nhận hạch toán table mới luôn là nhập kho
		$item['type'] = 1;
	}
	if($typehachtoan =='xuatkho'){//xác nhận hạch toán table mới luôn là nhập kho
		$item['type'] = 2;
	}	
	
	if($item['type']==1){//số lượng nhập
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
		
		$dongianhaprc = $item['dongiaban'];;
		$slnhapkimcuongrc = 1;	
	}
	else{ // số lượng xuất
		$slxuatvhrc = $item['cannangvh'];
		$slxuatvrc = $item['cannangv'];
		$slxuathrc = $item['cannangh'];
		if($tablenhan == 'khokhac_kholammoi'){
			$haorc = $item['hao'];
			$durc = $item['du'];
		}
		else{
			$haorc = $item['haochuyen'];
			$durc = $item['duchuyen'];		
		}
		$dongiaxuatrc = $item['dongiaban'];
		$slxuatkimcuongrc = 1;
	}
	if($item['typevkc']==1){/// là vàng
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];	
	}
	else{
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and typevkc=".$item['typevkc'];	
	}
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				//////////////////nhập vàng + hột
				$sltonvh = $rstru1day['sltonvh'];
				//////////////////nhập vàng
				$sltonv = $rstru1day['sltonv'];
				//////////////////nhập hot
				$sltonh = $rstru1day['sltonh'];
				
			}
			//////////////////nhập vàng + hột
			$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3) ;
			$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
			$arrnx1day['slxuatvh'] = $slxuatvhrc;
			$arrnx1day['slxuatv'] = $slxuatvrc;
			$arrnx1day['slxuath'] = $slxuathrc;
			
			$arrnx1day['hao'] = $haorc;
			$arrnx1day['du'] = $durc;
			
			$arrnx1day['idloaivang'] = $item['idloaivang']; // chỉ có nhập mới inser loại vàng, xuất không cần

		}
		else{ // là kim cương
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);

			
			if($rstru1day['id'] > 0){
				$sltonkimcuong = $rstru1day['sltonkimcuong'];
				$tongdongia = $rstru1day['tongdongia'];
			}	
			$sltonkimcuong = round(round(($sltonkimcuong + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3);
			$tongdongia = round(round(($tongdongia + $dongianhaprc),3) - $dongiaxuatrc,3);
			
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuongrc;
			$arrnx1day['slxuatkimcuong'] = $slxuatkimcuongrc;
			
			$arrnx1day['dongianhap'] = $dongianhaprc;
			$arrnx1day['dongiaxuat'] = $dongiaxuatrc;
			$arrnx1day['tongdongia'] = $tongdongia;
		}
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
			$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			
			$hao = round(($rsdate['hao'] + $haorc),3);
			$du = round(($rsdate['du'] + $durc),3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
			$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3) ;
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
		
			$arrnx1day['hao'] = $hao;
			$arrnx1day['du'] = $du;
		}
		else{// là kim cương
			$slnhapkimcuong = round(($rsdate['slnhapkimcuong'] + $slnhapkimcuongrc),3);
			$slxuatkimcuong = round(($rsdate['slxuatkimcuong'] + $slxuatkimcuongrc),3) ;
			$sltonkimcuong = round(round(($rsdate['sltonkimcuong'] + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3) ;
			
			$dongianhap = round(($rsdate['dongianhap'] + $dongianhaprc),3);
			$dongiaxuat = round(($rsdate['dongiaxuat'] + $dongiaxuatrc),3);
			$tongdongia = round(round(($rsdate['tongdongia'] + $dongianhaprc),3) - $dongiaxuatrc,3) ;
			
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuong;
			$arrnx1day['slxuatkimcuong'] = $slxuatkimcuong;
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			
			$arrnx1day['dongianhap'] = $dongianhap;
			$arrnx1day['dongiaxuat'] = $dongiaxuat;
			$arrnx1day['tongdongia'] = $tongdongia;
		}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}
///////////////////////////////////KẾT THÚC THÊM Ghi sổ Hạch toán KHO BỘT//////////////////////////////////////

// M.Tân thêm ngày 30/10/2019
function hachToanHaoDuPhuKienAdd($idloaivang, $hao, $du, $haochenhlech, $duchenhlech,  $dated, $tablehachtoan){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day = array();
	$dated = explode('-',$dated);
	$datedauthang = $dated[0].'-'.$dated[1].'-01';

	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang;
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
		$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivang." order by dated desc limit 1";	
		$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
		$tonvhthangnho = $tonhthangnho = 0;
		if($rsdatethangnho['id'] > 0){
			$arrnx1day['sltonvh'] = $rsdatethangnho['sltonvh'];
			$arrnx1day['sltonh'] = $rsdatethangnho['sltonh'];
			$arrnx1day['sltonv'] = round(($arrnx1day['sltonvh'] - $arrnx1day['sltonh']),3);
		}
	
		$arrnx1day['idloaivang'] = $idloaivang; // chỉ có nhập mới inser loại vàng
		$arrnx1day['hao'] = $hao;
		$arrnx1day['du'] = $du;
		
		$arrnx1day['haochenhlech'] = $haochenhlech;
		$arrnx1day['duchenhlech'] = $duchenhlech;
		
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		$arrnx1day['hao'] = round(($rsdate['hao'] + $hao),3);
		$arrnx1day['du'] = round(($rsdate['du'] + $du),3) ;
		
		$arrnx1day['haochenhlech'] = round(($rsdate['haochenhlech'] + $haochenhlech),3);
		$arrnx1day['duchenhlech'] = round(($rsdate['duchenhlech'] + $duchenhlech),3) ;
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}

// Hạch toán hao dư của table khosanxuat_phukienma_sodudauky (dựa theo cả idphukien + idloaivang)
function hachToanHaoDuMaPhuKienAdd($idloaivang, $idphukien, $thua, $thieu, $hao, $du, $haochenhlech, $duchenhlech,  $dated, $tablehachtoan){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day = array();
	$dated = explode('-',$dated);
	$datedauthang = $dated[0].'-'.$dated[1].'-01';

	// Dựa trên cả idphukien + idloaivang
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and idphukien=".$idphukien;
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
		$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and (idloaivang=".$idloaivang." and idphukien=".$idphukien.") order by dated desc limit 1";	
		$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
		
		if($rsdatethangnho['id'] > 0){
			$arrnx1day['sltonphukien'] = $rsdatethangnho['sltonphukien'];
			$arrnx1day['sltonv'] = $rsdatethangnho['sltonv'];
		}
	
		// Chỉ có nhập mới insert loại vàng + phụ kiện
		$arrnx1day['idloaivang'] = $idloaivang; 
		$arrnx1day['idphukien'] = $idphukien;

		$arrnx1day['thua'] = $thua;
		$arrnx1day['thieu'] = $thieu;

		$arrnx1day['hao'] = $hao;
		$arrnx1day['du'] = $du;
		
		$arrnx1day['haochenhlech'] = $haochenhlech;
		$arrnx1day['duchenhlech'] = $duchenhlech;
		
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky

		$arrnx1day['thua'] = round(($rsdate['thua'] + $thua),3);
		$arrnx1day['thieu'] = round(($rsdate['thieu'] + $thieu),3);

		$arrnx1day['hao'] = round(($rsdate['hao'] + $hao),3);
		$arrnx1day['du'] = round(($rsdate['du'] + $du),3);
		
		$arrnx1day['haochenhlech'] = round(($rsdate['haochenhlech'] + $haochenhlech),3);
		$arrnx1day['duchenhlech'] = round(($rsdate['duchenhlech'] + $duchenhlech),3);
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}

function hachToanHaoDuPhuKienEdit($idloaivang, $hao, $du, $haochenhlech, $duchenhlech, $idloaivangedit, $haoedit, $duedit, $haochenhlechedit, $duchenhlechedit, $dated, $tablehachtoan){
	clearstatcache();
	unset($arrnx1day);
	unset($arrkhacloaivang);
	unset($arrupdate);
	$arrnx1day = $arrkhacloaivang = $arrupdate = array();
	$datenow = $dated;
	$dateday = explode('-',$datenow);
	$datedauthang = $dateday[0].'-'.$dateday[1].'-01';
	if($idloaivang != $idloaivangedit){/// thay đổi loại vàng
		////////////cap nhap loại vàng cũ trước
		$sqlupdate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivangedit;
		$rsupdate = $GLOBALS['sp']->getRow($sqlupdate);	
		
		$arrupdate['hao'] = round(($rsupdate['hao'] - $haoedit),3);  
		$arrupdate['du'] = round(($rsupdate['du'] - $duedit),3);
		
		$arrupdate['haochenhlech'] = round(($rsupdate['haochenhlech'] - $haochenhlechedit),3);  
		$arrupdate['duchenhlech'] = round(($rsupdate['duchenhlech'] - $duchenhlechedit),3);
		
		vaUpdate($tablehachtoan,$arrupdate,' id='.$rsupdate['id']);
		
		$sqlrc = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang;
		$rsrc = $GLOBALS['sp']->getRow($sqlrc);	
		if(empty($rsrc['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
			//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
			$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivang." order by dated desc limit 1";	
			$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
			$tonvhthangnho = $tonhthangnho = 0;
			if($rsdatethangnho['id'] > 0){
				$arrkhacloaivang['sltonvh'] = $rsdatethangnho['sltonvh'];
				$arrkhacloaivang['sltonh'] = $rsdatethangnho['sltonh'];
				$arrkhacloaivang['sltonv'] = round(($arrnx1day['sltonvh'] - $arrnx1day['sltonh']),3);
			}
			// insert loại vàng mới
			$arrkhacloaivang['idloaivang'] = $idloaivang; 
			$arrkhacloaivang['hao'] = $hao;
			$arrkhacloaivang['du'] = $du;
			
			$arrkhacloaivang['haochenhlech'] = $haochenhlech;
			$arrkhacloaivang['duchenhlech'] = $duchenhlech;
			
			$arrkhacloaivang['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrkhacloaivang);
		}
		else{// có rồi thi update vào sodudauky			
			$arrkhacloaivang['hao'] = round(($rsrc['hao'] + $hao),3);
			$arrkhacloaivang['du'] = round(($rsrc['du'] + $du),3);
			
			$arrkhacloaivang['haochenhlech'] = round(($rsrc['haochenhlech'] + $haochenhlech),3);
			$arrkhacloaivang['duchenhlech'] = round(($rsrc['duchenhlech'] + $duchenhlech),3);
			
			vaUpdate($tablehachtoan,$arrkhacloaivang,' id='.$rsrc['id']);
		}
	}
	else{
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang;
		$rsdate = $GLOBALS['sp']->getRow($sqldate);	
		if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
			//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
			$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivang." order by dated desc limit 1";	
			$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
			$tonvhthangnho = $tonhthangnho = 0;
			if($rsdatethangnho['id'] > 0){
				$arrnx1day['sltonvh'] = $rsdatethangnho['sltonvh'];
				$arrnx1day['sltonh'] = $rsdatethangnho['sltonh'];
				$arrnx1day['sltonv'] = round(($arrnx1day['sltonvh'] - $arrnx1day['sltonh']),3);
			}
			
			$arrnx1day['idloaivang'] = $idloaivang; // chỉ có nhập mới inser loại vàng
			$arrnx1day['hao'] = $hao;
			$arrnx1day['du'] = $du;
			
			$arrnx1day['haochenhlech'] = $haochenhlech;
			$arrnx1day['duchenhlech'] = $duchenhlech;
			
			$arrnx1day['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrnx1day);
		}
		else{// có rồi thi update vào sodudauky
		 //die(' hao :'.$hao . ' haoedit :'.$haoedit .' duedit :'.$duedit);
			$arrnx1day['hao'] = round(($rsdate['hao'] - $haoedit),3) + $hao;
			$arrnx1day['du'] = round(($rsdate['du'] - $duedit),3) + $du;
			
			$arrnx1day['haochenhlech'] = round(($rsdate['haochenhlech'] - $haochenhlechedit),3) + $haochenhlech;
			$arrnx1day['duchenhlech'] = round(($rsdate['duchenhlech'] - $duchenhlechedit),3) + $duchenhlech;
			
			vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
		}
	}
}

// Hạch toán hao dư edit của table khosanxuat_phukienma_sodudauky (dựa theo cả idphukien + idloaivang)
function hachToanHaoDuMaPhuKienEdit($idphukien, $idloaivang, $thua, $thieu, $hao, $du, $haochenhlech, $duchenhlech, $idphukienedit, $idloaivangedit, $thuaedit, $thieuedit, $haoedit, $duedit, $haochenhlechedit, $duchenhlechedit, $dated, $tablehachtoan){
	clearstatcache();
	unset($arrnx1day);
	unset($arrKhacPKVaVang);
	unset($arrKhacVang); 
	unset($arrKhacPK);
	unset($arrupdate);
	$arrnx1day = $arrKhacPKVaVang = $arrKhacVang = $arrKhacPK = $arrupdate = array();
	$datenow = $dated;
	$dateday = explode('-',$datenow);
	$datedauthang = $dateday[0].'-'.$dateday[1].'-01';

	// XẢY RA 4 TRƯỜNG HỢP:
	if($idloaivang != $idloaivangedit && $idphukien != $idphukienedit) { // TH1: Thay đổi cả loại vàng và phụ kiện
		// Cập nhật lại loại vàng + phụ kiện cũ trước đó (trừ ra phần đã thêm vào)
		$sqlupdate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivangedit." and idphukien=".$idphukienedit;
		$rsupdate = $GLOBALS['sp']->getRow($sqlupdate);	

		$arrupdate['thua'] = round(($rsupdate['thua'] - $thuaedit),3);  
		$arrupdate['thieu'] = round(($rsupdate['thieu'] - $thieuedit),3);
		
		$arrupdate['hao'] = round(($rsupdate['hao'] - $haoedit),3);  
		$arrupdate['du'] = round(($rsupdate['du'] - $duedit),3);
		
		$arrupdate['haochenhlech'] = round(($rsupdate['haochenhlech'] - $haochenhlechedit),3);  
		$arrupdate['duchenhlech'] = round(($rsupdate['duchenhlech'] - $duchenhlechedit),3);
		
		vaUpdate($tablehachtoan,$arrupdate,' id='.$rsupdate['id']);

		// Xử lý dữ liệu cho loại vàng + phụ kiện mới
		$sqlrc = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and idphukien=".$idphukien;
		$rsrc = $GLOBALS['sp']->getRow($sqlrc);	
		if(empty($rsrc['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
			//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
			$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivang." and idphukien=".$idphukien." order by dated desc limit 1";	
			$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
			
			if($rsdatethangnho['id'] > 0){
				$arrKhacPKVaVang['sltonphukien'] = $rsdatethangnho['sltonphukien'];
				$arrKhacPKVaVang['sltonv'] = $rsdatethangnho['sltonv'];
			}
			// insert loại vàng + phụ kiện mới
			$arrKhacPKVaVang['idloaivang'] = $idloaivang;
			$arrKhacPKVaVang['idphukien'] = $idphukien; 

			$arrKhacPKVaVang['thua'] = $thua;
			$arrKhacPKVaVang['thieu'] = $thieu;

			$arrKhacPKVaVang['hao'] = $hao;
			$arrKhacPKVaVang['du'] = $du;
			
			$arrKhacPKVaVang['haochenhlech'] = $haochenhlech;
			$arrKhacPKVaVang['duchenhlech'] = $duchenhlech;
			
			$arrKhacPKVaVang['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrKhacPKVaVang);
		}
		else{// có rồi thi update vào sodudauky		
			$arrKhacPKVaVang['thua'] = round(($rsrc['thua'] + $thua),3);
			$arrKhacPKVaVang['thieu'] = round(($rsrc['thieu'] + $thieu),3);

			$arrKhacPKVaVang['hao'] = round(($rsrc['hao'] + $hao),3);
			$arrKhacPKVaVang['du'] = round(($rsrc['du'] + $du),3);
			
			$arrKhacPKVaVang['haochenhlech'] = round(($rsrc['haochenhlech'] + $haochenhlech),3);
			$arrKhacPKVaVang['duchenhlech'] = round(($rsrc['duchenhlech'] + $duchenhlech),3);
			
			vaUpdate($tablehachtoan,$arrKhacPKVaVang,' id='.$rsrc['id']);
		}

	} else if($idloaivang != $idloaivangedit && $idphukien == $idphukienedit) { // TH2: Chỉ thay đổi loại vàng, phụ kiện không thay đổi
		// Cập nhật lại loại vàng + phụ kiện cũ trước đó (trừ ra phần đã thêm vào)
		$sqlupdate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivangedit." and idphukien=".$idphukienedit;
		$rsupdate = $GLOBALS['sp']->getRow($sqlupdate);	

		$arrupdate['thua'] = round(($rsupdate['thua'] - $thuaedit),3);  
		$arrupdate['thieu'] = round(($rsupdate['thieu'] - $thieuedit),3);
		
		$arrupdate['hao'] = round(($rsupdate['hao'] - $haoedit),3);  
		$arrupdate['du'] = round(($rsupdate['du'] - $duedit),3);
		
		$arrupdate['haochenhlech'] = round(($rsupdate['haochenhlech'] - $haochenhlechedit),3);  
		$arrupdate['duchenhlech'] = round(($rsupdate['duchenhlech'] - $duchenhlechedit),3);
		
		vaUpdate($tablehachtoan,$arrupdate,' id='.$rsupdate['id']);

		// Xử lý dữ liệu cho loại vàng mới + phụ kiện cũ
		$sqlrc = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and idphukien=".$idphukienedit;
		$rsrc = $GLOBALS['sp']->getRow($sqlrc);	
		if(empty($rsrc['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
			//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
			$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivang." and idphukien=".$idphukienedit." order by dated desc limit 1";	
			$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
			
			if($rsdatethangnho['id'] > 0){
				$arrKhacVang['sltonphukien'] = $rsdatethangnho['sltonphukien'];
				$arrKhacVang['sltonv'] = $rsdatethangnho['sltonv'];
			}
			// insert loại vàng mới + phụ kiện cũ
			$arrKhacVang['idloaivang'] = $idloaivang;
			$arrKhacVang['idphukien'] = $idphukienedit;
			
			$arrKhacVang['thua'] = $thua;
			$arrKhacVang['thieu'] = $thieu;

			$arrKhacVang['hao'] = $hao;
			$arrKhacVang['du'] = $du;
			
			$arrKhacVang['haochenhlech'] = $haochenhlech;
			$arrKhacVang['duchenhlech'] = $duchenhlech;
			
			$arrKhacVang['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrKhacVang);
		}
		else{// có rồi thi update vào sodudauky	
			$arrKhacVang['thua'] = round(($rsrc['thua'] + $thua),3);
			$arrKhacVang['thieu'] = round(($rsrc['thieu'] + $thieu),3);
			
			$arrKhacVang['hao'] = round(($rsrc['hao'] + $hao),3);
			$arrKhacVang['du'] = round(($rsrc['du'] + $du),3);
			
			$arrKhacVang['haochenhlech'] = round(($rsrc['haochenhlech'] + $haochenhlech),3);
			$arrKhacVang['duchenhlech'] = round(($rsrc['duchenhlech'] + $duchenhlech),3);
			
			vaUpdate($tablehachtoan,$arrKhacVang,' id='.$rsrc['id']);
		}
	} else if($idloaivang == $idloaivangedit && $idphukien != $idphukienedit) { // TH3: Chỉ thay đổi phụ kiện, loại vàng không thay đổi
		// Cập nhật lại loại vàng + phụ kiện cũ trước đó (trừ ra phần đã thêm vào)
		$sqlupdate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivangedit." and idphukien=".$idphukienedit;
		$rsupdate = $GLOBALS['sp']->getRow($sqlupdate);	

		$arrupdate['thua'] = round(($rsupdate['thua'] - $thuaedit),3);  
		$arrupdate['thieu'] = round(($rsupdate['thieu'] - $thieuedit),3);
		
		$arrupdate['hao'] = round(($rsupdate['hao'] - $haoedit),3);  
		$arrupdate['du'] = round(($rsupdate['du'] - $duedit),3);
		
		$arrupdate['haochenhlech'] = round(($rsupdate['haochenhlech'] - $haochenhlechedit),3);  
		$arrupdate['duchenhlech'] = round(($rsupdate['duchenhlech'] - $duchenhlechedit),3);
		
		vaUpdate($tablehachtoan,$arrupdate,' id='.$rsupdate['id']);

		// Xử lý dữ liệu cho loại vàng cũ + phụ kiện mới
		$sqlrc = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivangedit." and idphukien=".$idphukien;
		$rsrc = $GLOBALS['sp']->getRow($sqlrc);	
		if(empty($rsrc['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
			//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
			$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivangedit." and idphukien=".$idphukien." order by dated desc limit 1";	
			$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
			
			if($rsdatethangnho['id'] > 0){
				$arrKhacPK['sltonphukien'] = $rsdatethangnho['sltonphukien'];
				$arrKhacPK['sltonv'] = $rsdatethangnho['sltonv'];
			}
			// insert loại vàng cũ + phụ kiện mới
			$arrKhacPK['idloaivang'] = $idloaivangedit;
			$arrKhacPK['idphukien'] = $idphukien; 

			$arrKhacPK['thua'] = $thua;
			$arrKhacPK['thieu'] = $thieu;
			
			$arrKhacPK['hao'] = $hao;
			$arrKhacPK['du'] = $du;
			
			$arrKhacPK['haochenhlech'] = $haochenhlech;
			$arrKhacPK['duchenhlech'] = $duchenhlech;
			
			$arrKhacPK['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrKhacPK);
		}
		else{// có rồi thi update vào sodudauky	
			$arrKhacPK['thua'] = round(($rsrc['thua'] + $thua),3);
			$arrKhacPK['thieu'] = round(($rsrc['thieu'] + $thieu),3);
			
			$arrKhacPK['hao'] = round(($rsrc['hao'] + $hao),3);
			$arrKhacPK['du'] = round(($rsrc['du'] + $du),3);
			
			$arrKhacPK['haochenhlech'] = round(($rsrc['haochenhlech'] + $haochenhlech),3);
			$arrKhacPK['duchenhlech'] = round(($rsrc['duchenhlech'] + $duchenhlech),3);
			
			vaUpdate($tablehachtoan,$arrKhacPK,' id='.$rsrc['id']);
		}
	} else { // TH4: Không thay dổi loại vàng và phụ kiện
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivangedit." and idphukien=".$idphukienedit;
		$rsdate = $GLOBALS['sp']->getRow($sqldate);	
		if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
			//////////load dữ liệu tồn tháng nhỏ hơn. vd: tháng đâu là tháng 3 thì lấy tháng nhỏ hơn tháng 3 là tháng 2
			$sqldatethangnho = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated <'".$datedauthang."' and idloaivang=".$idloaivangedit." and idphukien=".$idphukienedit." order by dated desc limit 1";	
			$rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
			$tonvhthangnho = $tonhthangnho = 0;
			if($rsdatethangnho['id'] > 0){
				$arrnx1day['sltonphukien'] = $rsdatethangnho['sltonphukien'];
				$arrnx1day['sltonv'] = $rsdatethangnho['sltonv'];
			}
			
			$arrnx1day['idloaivang'] = $idloaivangedit; // chỉ có nhập mới inser loại vàng
			$arrnx1day['idphukien'] = $idphukienedit;

			$arrnx1day['thua'] = $thua;
			$arrnx1day['thieu'] = $thieu;
			
			$arrnx1day['hao'] = $hao;
			$arrnx1day['du'] = $du;
			
			$arrnx1day['haochenhlech'] = $haochenhlech;
			$arrnx1day['duchenhlech'] = $duchenhlech;
			
			$arrnx1day['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrnx1day);
		}
		else{// có rồi thi update vào sodudauky
		 //die(' hao :'.$hao . ' haoedit :'.$haoedit .' duedit :'.$duedit);
			$arrnx1day['thua'] = round((round(($rsdate['thua'] - $thuaedit),3) + $thua),3);
			$arrnx1day['thieu'] = round((round(($rsdate['thieu'] - $thieuedit),3) + $thieu),3);

			$arrnx1day['hao'] = round((round(($rsdate['hao'] - $haoedit),3) + $hao),3);
			$arrnx1day['du'] = round((round(($rsdate['du'] - $duedit),3) + $du),3);
			
			$arrnx1day['haochenhlech'] = round((round(($rsdate['haochenhlech'] - $haochenhlechedit),3) + $haochenhlech),3);
			$arrnx1day['duchenhlech'] = round((round(($rsdate['duchenhlech'] - $duchenhlechedit),3) + $duchenhlech),3);
			
			vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
		}
	}
}


function hachToanHaoDuPhuKienDelete($idloaivang, $hao, $du, $haochenhlech, $duchenhlech, $dated, $tablehachtoan){
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day = array();
	$datenow = $dated;
	$dateday = explode('-',$datenow);
	$datedauthang = $dateday[0].'-'.$dateday[1].'-01';
	
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang;
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	
	$arrnx1day['hao'] = round(($rsdate['hao'] - $hao),3);
	$arrnx1day['du'] = round(($rsdate['du'] - $du),3) ;
	
	$arrnx1day['haochenhlech'] = round(($rsdate['haochenhlech'] - $haochenhlech),3);
	$arrnx1day['duchenhlech'] = round(($rsdate['duchenhlech'] - $duchenhlech),3);
	
	vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
}

// Xóa hạch toán hao dư của table khosanxuat_phukienma_sodudauky (dựa theo cả idphukien + idloaivang)
function hachToanHaoDuMaPhuKienDelete($idloaivang, $idphukien, $thua, $thieu, $hao, $du, $haochenhlech, $duchenhlech, $dated, $tablehachtoan){
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day = array();
	$datenow = $dated;
	$dateday = explode('-',$datenow);
	$datedauthang = $dateday[0].'-'.$dateday[1].'-01';
	
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and idphukien=".$idphukien;
	$rsdate = $GLOBALS['sp']->getRow($sqldate);

	$arrnx1day['thua'] = round(($rsdate['thua'] - $thua),3);
	$arrnx1day['thieu'] = round(($rsdate['thieu'] - $thieu),3);

	$arrnx1day['hao'] = round(($rsdate['hao'] - $hao),3);
	$arrnx1day['du'] = round(($rsdate['du'] - $du),3);
	
	$arrnx1day['haochenhlech'] = round(($rsdate['haochenhlech'] - $haochenhlech),3);
	$arrnx1day['duchenhlech'] = round(($rsdate['duchenhlech'] - $duchenhlech),3) ;
	
	vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
}


// M.Tân thêm ngày 01/11/2019
function insert_thongKeNhapXuatTonMaPhuKien($a){
	
	$arrlist = array();
	$sqlhaodusddk = $rshaodusddk = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt = $sqlhaodu = $rshaodu = $sqlnhap = $rsnhap = $sqlxuat = $rsxuat = '';
	$sltonVsddk = $sltonPKsddk = $sltonPKtndt = $sltonVtndt = $sltonPKtndn = $sltonVtndn = $slnhap = $slxuat = $sltontndt = 0;
	
	$table = trim(striptags($a['table']));
	$tablehachtoanma = trim(striptags($a['tablehachtoanma']));
	$tablehaodu = trim(striptags($a['tablehaodu']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$datenow = date("Y-m-d");

	$idphukien = ceil(trim($a['idphukien']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	if(!empty($table) && !empty($tablehachtoanma)){
		
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		} else {
			$fromDate = date("d/m/Y");
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		} else {
			$toDate = date("d/m/Y");
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		}

		if($idphukien > 0 && $idloaivang > 0) {
			
			// Lấy tháng trước của ngày chọn, nếu không chọn thì lấy tháng trước của ngày hiện tại
			$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
			$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
			// die($thangtruoc);

			//Get số lượng hao dư đầu kỳ
			$sqlhaodusddk = "select ROUND(SUM(thua), 3) as thua, 
									ROUND(SUM(thieu), 3) as thieu, 
									ROUND(SUM(haochenhlech), 3) as haochenhlech, 
									ROUND(SUM(duchenhlech), 3) as duchenhlech 
									from $GLOBALS[db_sp].".$tablehachtoanma." 
									where idloaivang=".$idloaivang." and idphukien=".$idphukien."
									and dated <= '".$thangtruoc."'
							";
			$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);

			// Get số lượng đầu kỳ (nếu tháng trước có hạch toán thì lấy tháng trước đó, ko thì thấy tháng gần nhất có hạch toán)
			$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated <= '".$thangtruoc."' order by id desc limit 1";
			$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
			
			// Lấy ra số lượng tồn phụ kiện của tháng đó
			$sltonPKsddk = round(round(($rstonsddk['sltonphukien'] + $rshaodusddk['thieu']),10) - $rshaodusddk['thua'],10);

			// Tính số lượng vàng tồn còn lại dựa trên số dư đầu kỳ hao dư
			// $sltonVsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);
			$sltonVsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'],10);
			
			$thangdauky = $rstonsddk['dated'];
			
			// Get số lượng hao dư ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sqlhaodutndt = "select ROUND(SUM(thua), 3) as thua, 
									ROUND(SUM(thieu), 3) as thieu, 
									ROUND(SUM(haochenhlech), 3) as haochenhlech, 
									ROUND(SUM(duchenhlech), 3) as duchenhlech 
									from $GLOBALS[db_sp].".$tablehaodu." 
								 	where idloaivang=".$idloaivang." and idphukien=".$idphukien."
								 	and dated < '".$fromDate."'
								 	and dated >= '".$datedauthang."'
							";
			$rshaodutndt = $GLOBALS['sp']->getRow($sqlhaodutndt);
			// die($sqlhaodutndt);

			$sqlnhaptndt = "select ROUND(SUM(cannangv), 3) as slnhapvang, 
								   ROUND(SUM(soluongphukien), 3) as slnhapphukien
								   from $GLOBALS[db_sp].".$table."
								   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
								   and type=1 
								   and typechuyen=2 
								   and dated < '".$fromDate."'
								   and dated >= '".$datedauthang."' 
						   "; 
			$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
			// die($sqlnhaptndt);
			
			$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang, 
								   ROUND(SUM(soluongphukien), 3) as slxuatphukien  
								   from $GLOBALS[db_sp].".$table." 
								   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
								   and type=3 
								   and trangthai=2 
								   and datedxuat < '".$fromDate."'
								   and datedxuat >= '".$datedauthang."' 
						   ";
			$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	

			// Tính số lượng tồn phụ kiện khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sltonPKtndt = round(($rsnhaptndt['slnhapphukien'] - $rsxuattndt['slxuatphukien']),10);
			$sltonPKtndt = round(($sltonPKtndt + round(($rshaodutndt['thieu'] - $rshaodutndt['thua']),10)),10);
			$sltonPKsddk = round(($sltonPKsddk + $sltonPKtndt),10);

			// Tính số lượng tồn vàng khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sltonVtndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),10);
			$sltonVtndt = round(($sltonVtndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),10)),10); 
			$sltonVsddk = round(($sltonVsddk + $sltonVtndt),10);
			
			// Get số lượng nhập, xuất, hao, dư, tồn từ ngày đến ngày 
			$sqlhaodu = "select ROUND(SUM(thua), 3) as thua, 
								ROUND(SUM(thieu), 3) as thieu, 
								ROUND(SUM(haochenhlech), 3) as haochenhlech, 
								ROUND(SUM(duchenhlech), 3) as duchenhlech 
								from $GLOBALS[db_sp].".$tablehaodu."
								where idloaivang=".$idloaivang." and idphukien=".$idphukien."
								and dated >= '".$fromDate."'
								and dated <= '".$toDate."'
						";
			$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
				
			$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang,
							   ROUND(SUM(soluongphukien), 3) as slnhapphukien 
							   from $GLOBALS[db_sp].".$table." 
							   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
							   and type=1 
							   and typechuyen=2  
							   and dated >= '".$fromDate."'  
						       and dated <= '".$toDate."' 
						"; 
			$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	

			$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang,
							   ROUND(SUM(soluongphukien), 3) as slxuatphukien
							   from $GLOBALS[db_sp].".$table." 
							   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
							   and type=3
							   and trangthai=2
							   and datedxuat >= '".$fromDate."'  
							   and datedxuat <= '".$toDate."' 
						"; 
			$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);

			// Tính số lượng tồn phụ kiện từ ngày đến ngày
			$sltonPKtndn = round(($rsnhap['slnhapphukien'] - $rsxuat['slxuatphukien']),10);
			$sltonPKtndn = $sltonPKtndn + round(($rshaodu['thieu'] - $rshaodu['thua']),10);

			// Tính số lượng tồn vàng từ ngày đến ngày
			$sltonVtndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),10);
			$sltonVtndn = $sltonVtndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),10);

			// Tổng số lượng tồn phụ kiện cuối kỳ
			$sltonPK = $sltonPKsddk + $sltonPKtndn;

			// Tổng trọng lượng tồn vàng cuối kỳ
			$sltonV = $sltonVsddk + $sltonVtndn;
			
			// Hiển thị số lượng phụ kiện tồn đầu kỳ
			$arrlist['sltonPKsddk'] = $sltonPKsddk;

			// Hiển thị trọng lượng vàng tồn đầu kỳ
			$arrlist['sltonVsddk'] = $sltonVsddk;

			// Hiển thị số lượng phụ kiện nhập xuất trong kỳ
			$arrlist['slnhapphukien'] = $rsnhap['slnhapphukien'];
			$arrlist['slxuatphukien'] = $rsxuat['slxuatphukien'];

			// Hiển thị trọng lượng vàng nhập xuất trong kỳ
			$arrlist['slnhapvang'] = $rsnhap['slnhapvang'];
			$arrlist['slxuatvang'] = $rsxuat['slxuatvang'];

			// Hiển thị số lượng phụ kiện tồn cuối kỳ
			$arrlist['sltonPK'] = $sltonPK;

			// Hiển thị trọng lượng vàng tồn cuối kỳ
			$arrlist['sltonV'] = $sltonV;

			// Hiển thị số lượng thừa, thiếu, hao chênh lệch, dư chênh lệch
			$arrlist['slthua'] = $rshaodu['thua'];
			$arrlist['slthieu'] = $rshaodu['thieu'];
			$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
			$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
		
			$arrlist['idloaivang'] = $idloaivang;
			$arrlist['idphukien'] = $idphukien;
			
			$arrlist['tongQ10'] = getTongQ10Round10($arrlist['sltonV'], $arrlist['idloaivang']);	
			
		}
		else{
			$arrlist['idphukien'] = 0;
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

// M.Tân thêm ngày 19/01/2020 - Tính tổng hao dư thừa thiếu dựa trên idloaivang và idphukien của kho phụ kiện
function insert_getSumHaoDuThuaThieu($a){
	$idloaivang = ceil(trim($a['idloaivang']));
	$idphukien = ceil(trim($a['idphukien']));

	if($idphukien > 0 && $idloaivang > 0) {
		// Tính tổng hao dư thừa thiếu dựa trên idloaivang và idphukien
		$sqlsumhdtt = "select 	ROUND(SUM(thua), 3) as thua, 
								ROUND(SUM(thieu), 3) as thieu, 
								ROUND(SUM(haochenhlech), 3) as haochenhlech, 
								ROUND(SUM(duchenhlech), 3) as duchenhlech 
								from $GLOBALS[db_sp].khosanxuat_phukienma_sodudauky 
								where idloaivang=".$idloaivang." and idphukien=".$idphukien."
						";
		$rssumhdtt = $GLOBALS['sp']->getRow($sqlsumhdtt);

		$arrlist['tongthua'] = $rssumhdtt['thua'];
		$arrlist['tongthieu'] = $rssumhdtt['thieu'];
		$arrlist['tonghaochenhlech'] = $rssumhdtt['haochenhlech'];
		$arrlist['tongduchenhlech'] = $rssumhdtt['duchenhlech'];
		
		return $arrlist;
	}
}

// M.Tân thêm ngày 20/08/2021 - Tính tổng hao dư thừa thiếu dựa trên idloaivang và idphukien của kho phụ kiện mới
function insert_getSumHaoDuThuaThieuNew($a){
	$idloaivang = ceil(trim($a['idloaivang']));
	$idphukien = ceil(trim($a['idphukien']));
	$tablehachtoanma = trim($a['tablehachtoanma']);

	if($idphukien > 0 && $idloaivang > 0 && !empty($tablehachtoanma)) {
		// Tính tổng hao dư thừa thiếu dựa trên idloaivang và idphukien
		$sqlsumhdtt = "select 	ROUND(SUM(thua), 3) as thua, 
								ROUND(SUM(thieu), 3) as thieu, 
								ROUND(SUM(haochenhlech), 3) as haochenhlech, 
								ROUND(SUM(duchenhlech), 3) as duchenhlech 
								from $GLOBALS[db_sp].".$tablehachtoanma."  
								where idloaivang=".$idloaivang." and idphukien=".$idphukien."
						";
		$rssumhdtt = $GLOBALS['sp']->getRow($sqlsumhdtt);

		$arrlist['tongthua'] = $rssumhdtt['thua'];
		$arrlist['tongthieu'] = $rssumhdtt['thieu'];
		$arrlist['tonghaochenhlech'] = $rssumhdtt['haochenhlech'];
		$arrlist['tongduchenhlech'] = $rssumhdtt['duchenhlech'];
		
		return $arrlist;
	}
}

function getSumHaoDuThuaThieuNew($idphukien, $idloaivang, $tablehachtoanma){
	if($idphukien > 0 && $idloaivang > 0 && !empty($tablehachtoanma)) {
		// Tính tổng hao dư thừa thiếu dựa trên idloaivang và idphukien
		$sqlsumhdtt = "select 	ROUND(SUM(thua), 3) as thua, 
								ROUND(SUM(thieu), 3) as thieu, 
								ROUND(SUM(haochenhlech), 3) as haochenhlech, 
								ROUND(SUM(duchenhlech), 3) as duchenhlech 
								from $GLOBALS[db_sp].".$tablehachtoanma." 
								where idloaivang=".$idloaivang." and idphukien=".$idphukien."
						";
		$rssumhdtt = $GLOBALS['sp']->getRow($sqlsumhdtt);

		$arrlist['tongthua'] = $rssumhdtt['thua'];
		$arrlist['tongthieu'] = $rssumhdtt['thieu'];
		$arrlist['tonghaochenhlech'] = $rssumhdtt['haochenhlech'];
		$arrlist['tongduchenhlech'] = $rssumhdtt['duchenhlech'];

		return $arrlist;
	}
}

// M.Tân thêm ngày 26/11/2019
function thongKeNhapXuatTonMaPhuKien($table, $tablehachtoanma, $tablehaodu, $fromDate, $toDate, $idphukien, $idloaivang){
	
	$arrlist = array();
	$sqlhaodusddk = $rshaodusddk = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt = $sqlhaodu = $rshaodu = $sqlnhap = $rsnhap = $sqlxuat = $rsxuat = '';
	$sltonVsddk = $sltonPKsddk = $sltonPKtndt = $sltonVtndt = $sltonPKtndn = $sltonVtndn = $slnhap = $slxuat = $sltontndt = 0;

	$datenow = date("Y-m-d");
	
	if(!empty($table) && !empty($tablehachtoanma)){
		
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		} else {
			$fromDate = date("d/m/Y");
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		} else {
			$toDate = date("d/m/Y");
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		}

		if($idphukien > 0 && $idloaivang > 0) {
			
			// Lấy tháng trước của ngày chọn, nếu không chọn thì lấy tháng trước của ngày hiện tại
			$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
			$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
			// die($thangtruoc);

			//Get số lượng hao dư đầu kỳ
			$sqlhaodusddk = "select ROUND(SUM(thua), 3) as thua, 
									ROUND(SUM(thieu), 3) as thieu, 
									ROUND(SUM(haochenhlech), 3) as haochenhlech, 
									ROUND(SUM(duchenhlech), 3) as duchenhlech 
									from $GLOBALS[db_sp].".$tablehachtoanma." 
									where idloaivang=".$idloaivang." and idphukien=".$idphukien."
									and dated <= '".$thangtruoc."'
							";
			$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);

			// Get số lượng đầu kỳ (nếu tháng trước có hạch toán thì lấy tháng trước đó, ko thì thấy tháng gần nhất có hạch toán)
			$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated <= '".$thangtruoc."' order by id desc limit 1";
			$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);

			// Lấy ra số lượng tồn phụ kiện của tháng đó
			$sltonPKsddk = round(round(($rstonsddk['sltonphukien'] + $rshaodusddk['thieu']),10) - $rshaodusddk['thua'],10);

			// Tính số lượng vàng tồn còn lại dựa trên số dư đầu kỳ hao dư
			// $sltonVsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);
			$sltonVsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'],10);
				
			$thangdauky = $rstonsddk['dated'];
			
			// Get số lượng hao dư ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sqlhaodutndt = "select ROUND(SUM(thua), 3) as thua, 
									ROUND(SUM(thieu), 3) as thieu, 
									ROUND(SUM(haochenhlech), 3) as haochenhlech, 
									ROUND(SUM(duchenhlech), 3) as duchenhlech 
									from $GLOBALS[db_sp].".$tablehaodu." 
								 	where idloaivang=".$idloaivang." and idphukien=".$idphukien."
								 	and dated < '".$fromDate."'
								 	and dated >= '".$datedauthang."'
							";
			$rshaodutndt = $GLOBALS['sp']->getRow($sqlhaodutndt);
			// die($sqlhaodutndt);

			$sqlnhaptndt = "select ROUND(SUM(cannangv), 3) as slnhapvang, 
								   ROUND(SUM(soluongphukien), 3) as slnhapphukien
								   from $GLOBALS[db_sp].".$table."
								   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
								   and type=1 
								   and typechuyen=2 
								   and dated < '".$fromDate."'
								   and dated >= '".$datedauthang."' 
						   "; 
			$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
			// die($sqlnhaptndt);

			$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang, 
								   ROUND(SUM(soluongphukien), 3) as slxuatphukien  
								   from $GLOBALS[db_sp].".$table." 
								   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
								   and type=3 
								   and trangthai=2 
								   and datedxuat < '".$fromDate."'
								   and datedxuat >= '".$datedauthang."' 
						   ";
			$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);

			// Tính số lượng tồn phụ kiện khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sltonPKtndt = round(($rsnhaptndt['slnhapphukien'] - $rsxuattndt['slxuatphukien']),10);
			$sltonPKtndt = round(($sltonPKtndt + round(($rshaodutndt['thieu'] - $rshaodutndt['thua']),10)),10);
			$sltonPKsddk = round(($sltonPKsddk + $sltonPKtndt),10);

			// Tính số lượng tồn vàng khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sltonVtndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),10);
			$sltonVtndt = round(($sltonVtndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),10)),10); 
			$sltonVsddk = round(($sltonVsddk + $sltonVtndt),10);

			// Get số lượng nhập, xuất, hao, dư, tồn từ ngày đến ngày 
			$sqlhaodu = "select ROUND(SUM(thua), 3) as thua, 
								ROUND(SUM(thieu), 3) as thieu, 
								ROUND(SUM(haochenhlech), 3) as haochenhlech, 
								ROUND(SUM(duchenhlech), 3) as duchenhlech 
								from $GLOBALS[db_sp].".$tablehaodu."
								where idloaivang=".$idloaivang." and idphukien=".$idphukien."
								and dated >= '".$fromDate."'
								and dated <= '".$toDate."'
						";
			$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
				
			$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang,
							   ROUND(SUM(soluongphukien), 3) as slnhapphukien 
							   from $GLOBALS[db_sp].".$table." 
							   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
							   and type=1 
							   and typechuyen=2  
							   and dated >= '".$fromDate."'  
						       and dated <= '".$toDate."' 
						"; 
			$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	

			$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang,
							   ROUND(SUM(soluongphukien), 3) as slxuatphukien
							   from $GLOBALS[db_sp].".$table." 
							   where idloaivang=".$idloaivang." and idphukien=".$idphukien."
							   and type=3
							   and trangthai=2
							   and datedxuat >= '".$fromDate."'  
							   and datedxuat <= '".$toDate."' 
						"; 
			$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);

			// Tính số lượng tồn phụ kiện từ ngày đến ngày
			$sltonPKtndn = round(($rsnhap['slnhapphukien'] - $rsxuat['slxuatphukien']),10);
			$sltonPKtndn = $sltonPKtndn + round(($rshaodu['thieu'] - $rshaodu['thua']),10);

			// Tính số lượng tồn vàng từ ngày đến ngày
			$sltonVtndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),10);
			$sltonVtndn = $sltonVtndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),10);

			// Tổng số lượng tồn phụ kiện cuối kỳ
			$sltonPK = $sltonPKsddk + $sltonPKtndn;

			// Tổng trọng lượng tồn vàng cuối kỳ
			$sltonV = $sltonVsddk + $sltonVtndn;
			
			// Hiển thị số lượng phụ kiện tồn đầu kỳ
			$arrlist['sltonPKsddk'] = $sltonPKsddk;

			// Hiển thị trọng lượng vàng tồn đầu kỳ
			$arrlist['sltonVsddk'] = $sltonVsddk;

			// Hiển thị số lượng phụ kiện nhập xuất trong kỳ
			$arrlist['slnhapphukien'] = $rsnhap['slnhapphukien'];
			$arrlist['slxuatphukien'] = $rsxuat['slxuatphukien'];

			// Hiển thị trọng lượng vàng nhập xuất trong kỳ
			$arrlist['slnhapvang'] = $rsnhap['slnhapvang'];
			$arrlist['slxuatvang'] = $rsxuat['slxuatvang'];

			// Hiển thị số lượng phụ kiện tồn cuối kỳ
			$arrlist['sltonPK'] = $sltonPK;

			// Hiển thị trọng lượng vàng tồn cuối kỳ
			$arrlist['sltonV'] = $sltonV;

			// Hiển thị số lượng hao, dư, hao chênh lệch, dư chênh lệch
			$arrlist['slhao'] = $rshaodu['hao'];
			$arrlist['sldu'] = $rshaodu['du'];
			$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
			$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
		
			$arrlist['idloaivang'] = $idloaivang;
			$arrlist['idphukien'] = $idphukien;
			
			$arrlist['tongQ10'] = getTongQ10Round10($arrlist['sltonV'], $arrlist['idloaivang']);	
			
		}
		else{
			$arrlist['idphukien'] = 0;
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

// hai them
function dieuChinhSoLieuHachToanKhoThanhPhamNew($table, $tablehachtoan ,$idloaivang) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';
		die($dateCuoiThang);
		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=1 and typechuyen=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv,
										ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du 
										from $GLOBALS[db_sp].".$table." 
										where type in(2,3) and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
										and typevkc = 1
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Nếu trong tháng có nhập hoặc xuất idloaivang này thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['cannangv'] != 0 || $rsTongXuatTrongThang['cannangv'] != 0) {

			// Nếu có sai số trong phần nhập kho của idloaivang đó thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
				$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
				$arrUpdateNX['slnhaph'] = $rsTongNhapTrongThang['cannangh'];
				$arrUpdateNX['slnhapvh'] = $rsTongNhapTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất, hao, dư trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatv, hao, du from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$rsXuatSDDKTrongThang = $GLOBALS['sp']->getRow($sqlXuatSDDKTrongThang);

			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongXuatTrongThang['cannangv'] != $rsXuatSDDKTrongThang['slxuatv']){
				$arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
				$arrUpdateNX['slxuath'] = $rsTongXuatTrongThang['cannangh'];
				$arrUpdateNX['slxuatvh'] = $rsTongXuatTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}	

			// So sánh số lượng hao, dư trong sodudauky với tổng số lượng hao,dư của các phiếu xuất cộng lại
			if($rsTongXuatTrongThang['hao'] != $rsXuatSDDKTrongThang['hao'] || $rsTongXuatTrongThang['du'] != $rsXuatSDDKTrongThang['du']) {
				$arrUpdateHD['hao'] = $rsTongXuatTrongThang['hao'];
				$arrUpdateHD['du'] = $rsTongXuatTrongThang['du'];

				vaUpdate($tablehachtoan, $arrUpdateHD, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');
			}

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {

				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonv, sltonh, sltonvh from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
				$sltonhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonh'] + $rsTongNhapTrongThang['cannangh']),3) - $rsTongXuatTrongThang['cannangh'],3);
				$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangvh']),3) - $rsTongXuatTrongThang['cannangvh'],3);

				$arrUpdateNX['sltonv'] = $sltonvTrongThang;
				$arrUpdateNX['sltonh'] = $sltonhTrongThang;
				$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;

				vaUpdate($tablehachtoan, $arrUpdateNX, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];

				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type=1 and typechuyen=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slnhaph'] = $rsTongNhapThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slnhapvh'] = $rsTongNhapThangTiep['cannangvh'];
					}

					$sqlTongXuatThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type in(2,3) and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
													and typevkc = 1
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

					if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slxuath'] = $rsTongXuatThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slxuatvh'] = $rsTongXuatThangTiep['cannangvh']; 
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
					$arrUpdateNXThangTiep['sltonh'] = round(round(($sltonhTrongThang + $rsTongNhapThangTiep['cannangh']),3) - $rsTongXuatThangTiep['cannangh'],3);
					$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangvh']),3) - $rsTongXuatThangTiep['cannangvh'],3);

					vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');

				}
			}

			// Kiểm tra hao dư của tháng tiếp theo xem có sai không
			$dateDauThangTiep = $rs[$i-1]['dated'];

			if(!empty($dateDauThangTiep)){
				// Tính ngày cuối tháng của tháng tiếp theo
				$arrThangTiep = explode('-',$dateDauThangTiep);
				$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

				$sqlHaoDuThangTiep = "select ROUND(SUM(hao), 3) as hao,
											ROUND(SUM(du), 3) as du 
											from $GLOBALS[db_sp].".$table." 
											where type in(2,3) and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											and typevkc = 1
											";
				$rsHaoDuThangTiep = $GLOBALS['sp']->getRow($sqlHaoDuThangTiep);

				// Lấy ra hao, dư trnng bảng sodudauky để so sánh
				$sqlHaoDuSDDKThangTiep= "select hao, du from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTiep."'";
				$rsHaoDuSDDKThangTiep = $GLOBALS['sp']->getRow($sqlHaoDuSDDKThangTiep);

				if($rsHaoDuSDDKThangTiep['hao'] != $rsHaoDuThangTiep['hao'] || $rsHaoDuSDDKThangTiep['du'] != $rsHaoDuThangTiep['du']) {
					$arrUpdateHDThangTiep['hao'] = $rsHaoDuThangTiep['hao'];
					$arrUpdateHDThangTiep['du'] = $rsHaoDuThangTiep['du'];

					vaUpdate($tablehachtoan, $arrUpdateHDThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');
				}
			}
		}
	}
}
// M.Tân thêm Điều chỉnh số liệu hạch toán cho Kho Sản Xuất (và Kho Phân Kim)
function dieuChinhSoLieuHachToan($table,$idloaivang) {

	$sql = "select * from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=1 and typechuyen=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type in(2,3) and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
										and typevkc = 1
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Nếu trong tháng có nhập hoặc xuất idloaivang này thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['cannangv'] != 0 || $rsTongXuatTrongThang['cannangv'] != 0) {

			// Nếu có sai số trong phần nhập kho của idloaivang đó thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
				$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
				$arrUpdateNX['slnhaph'] = $rsTongNhapTrongThang['cannangh'];
				$arrUpdateNX['slnhapvh'] = $rsTongNhapTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatv from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$slxuatvSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongXuatTrongThang['cannangv'] != $slxuatvSDDK){
				$arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
				$arrUpdateNX['slxuath'] = $rsTongXuatTrongThang['cannangh'];
				$arrUpdateNX['slxuatvh'] = $rsTongXuatTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}	

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {

				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonv, sltonh, sltonvh from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
				$sltonhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonh'] + $rsTongNhapTrongThang['cannangh']),3) - $rsTongXuatTrongThang['cannangh'],3);
				$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangvh']),3) - $rsTongXuatTrongThang['cannangvh'],3);

				$arrUpdateNX['sltonv'] = $sltonvTrongThang;
				$arrUpdateNX['sltonh'] = $sltonhTrongThang;
				$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;

				vaUpdate($table.'_sodudauky', $arrUpdateNX, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];

				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type=1 and typechuyen=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slnhaph'] = $rsTongNhapThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slnhapvh'] = $rsTongNhapThangTiep['cannangvh'];
					}

					$sqlTongXuatThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type in(2,3) and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
													and typevkc = 1
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

					if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slxuath'] = $rsTongXuatThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slxuatvh'] = $rsTongXuatThangTiep['cannangvh'];
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
					$arrUpdateNXThangTiep['sltonh'] = round(round(($sltonhTrongThang + $rsTongNhapThangTiep['cannangh']),3) - $rsTongXuatThangTiep['cannangh'],3);
					$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangvh']),3) - $rsTongXuatThangTiep['cannangvh'],3);

					vaUpdate($table.'_sodudauky', $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');

				}
			}
		}
	}
}

// M.Tân thêm ngày 17/11/2020 - Điều chỉnh số liệu hạch toán cả idphukien và idloaivang cho Kho Phụ Kiện
function dieuChinhSoLieuHachToanMaKhoPhuKien($table,$tablehachtoan,$idloaivang,$idphukien) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and idphukien=".$idphukien." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG VÀ IDPHUKIEN ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangv), 3) as cannangv,
										ROUND(SUM(soluongphukien), 3) as soluongphukien
										from $GLOBALS[db_sp].".$table." 
										where type=1 and typechuyen=2 
										and idloaivang=".$idloaivang." and idphukien=".$idphukien."
										and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG VÀ IDPHUKIEN ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(cannangv), 3) as cannangv,
										ROUND(SUM(soluongphukien), 3) as soluongphukien
										from $GLOBALS[db_sp].".$table." 
										where type=3 and trangthai=2 
										and idloaivang=".$idloaivang." and idphukien=".$idphukien."
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
										and typevkc = 1
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang và idphukien (tháng đó) để so sánh
		$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated = '".$dateDauThang."'";
		$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
			$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
			$arrUpdateNX['slnhapphukien'] = $rsTongNhapTrongThang['soluongphukien'];
		}

		// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang và idphukien (tháng đó) để so sánh
		$sqlXuatSDDKTrongThang = "select slxuatv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated = '".$dateDauThang."'";
		$slxuatvSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongXuatTrongThang['cannangv'] != $slxuatvSDDK){
			$arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
			$arrUpdateNX['slxuatphukien'] = $rsTongXuatTrongThang['soluongphukien'];
		}

		// Lấy ngày của tháng trước có hạch toán
		$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated < '".$dateDauThang."' order by dated desc limit 1";
		$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
		
		// Lấy ra số lượng tồn của tháng trước có hạch toán
		$sqlGetSLTonThangTruoc = "select sltonv, sltonphukien from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated = '".$dateDauThangTruoc."'";
		$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
		
		// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
		$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
		$sltonphukienTrongThang = round(round(($rsGetSLTonThangTruoc['sltonphukien'] + $rsTongNhapTrongThang['soluongphukien']),3) - $rsTongXuatTrongThang['soluongphukien'],3);

		$arrUpdateNX['sltonv'] = $sltonvTrongThang;
		$arrUpdateNX['sltonphukien'] = $sltonphukienTrongThang;

		vaUpdate($tablehachtoan, $arrUpdateNX, ' idloaivang='.$idloaivang.' and idphukien='.$idphukien.' and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlTongNhapThangTiep = "select ROUND(SUM(cannangv), 3) as cannangv,
											ROUND(SUM(soluongphukien), 3) as soluongphukien
											from $GLOBALS[db_sp].".$table." 
											where type=1 and typechuyen=2 
											and idloaivang=".$idloaivang." and idphukien=".$idphukien."
											and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
									";
			$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
			
			if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
				$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
				$arrUpdateNXThangTiep['slnhapphukien'] = $rsTongNhapThangTiep['soluongphukien'];
			}

			$sqlTongXuatThangTiep = "select ROUND(SUM(cannangv), 3) as cannangv,
											ROUND(SUM(soluongphukien), 3) as soluongphukien
											from $GLOBALS[db_sp].".$table." 
											where type=3 and trangthai=2  
											and idloaivang=".$idloaivang." and idphukien=".$idphukien."
											and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											and typevkc = 1
									";
			$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

			if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
				$arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
				$arrUpdateNXThangTiep['slxuatphukien'] = $rsTongXuatThangTiep['soluongphukien'];
			}

			// Update soluongton của tháng tiếp theo
			$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
			$arrUpdateNXThangTiep['sltonphukien'] = round(round(($sltonphukienTrongThang + $rsTongNhapThangTiep['soluongphukien']),3) - $rsTongXuatThangTiep['soluongphukien'],3);

			vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and idphukien='.$idphukien.' and dated="'.$dateDauThangTiep.'"');
		}
	}
}

// M.Tân thêm ngày 07/01/2020 - Điều chỉnh số liệu hạch toán Kho Sau Chế Tác
function dieuChinhSoLieuHachToanKhoSauCheTac($table,$tablehachtoan,$idloaivang) {

	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);
	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(trongluongvangsauchetac), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where typesauchetac=2 and idloaivang=".$idloaivang." 
										and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(trongluongvangsauchetac), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where typesauchetac=2 and trangthai=2 and idloaivang=".$idloaivang." 
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Nếu trong tháng có nhập hoặc xuất idloaivang này thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['cannangv'] != 0 || $rsTongXuatTrongThang['cannangv'] != 0) {

			// Nếu có sai số trong phần nhập kho của idloaivang đó thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
				$arrUpdateNX['slnhapvh'] = $arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$slxuatvSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongXuatTrongThang['cannangv'] != $slxuatvSDDK){
				$arrUpdateNX['slxuatvh'] = $arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
				$checkSaiSoNX = 1;
			}	

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {
				
				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonv, sltonvh from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
				$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);

				$arrUpdateNX['sltonv'] = $sltonvTrongThang;
				$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;

				vaUpdate($tablehachtoan, $arrUpdateNX, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];

				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select ROUND(SUM(trongluongvangsauchetac), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where typesauchetac=2 and idloaivang=".$idloaivang." 
													and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapvh'] = $arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
					}

					$sqlTongXuatThangTiep = "select ROUND(SUM(trongluongvangsauchetac), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where typesauchetac=2 and trangthai=2 and idloaivang=".$idloaivang." 
													and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

					if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatvh'] = $arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
					$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);

					vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');
				}
			}
		}
	}
}

// M.Tân thêm ngày 09/01/2020 - Điều chỉnh số liệu hạch toán Kho Tổng Dẻ Cục
function dieuChinhSoLieuHachToanKhoTongDeCuc($table,$tablect,$tablehachtoan,$idloaivang) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);
	
	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										 ROUND(SUM(cannangh), 3) as cannangh, 
										 ROUND(SUM(cannangv), 3) as cannangv 
										 from $GLOBALS[db_sp].".$tablect." 
										 where idloaivang=".$idloaivang." 
										 and type=2 
										 and datechuyen >= '".$dateDauThang."' and datechuyen <= '".$dateCuoiThang."' 
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(sum(tlvangcat), 3) as cannangv 
										from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
										where idmaphieu IN (select id from $GLOBALS[db_sp].khokhac_khotongdecucct 
										where type=2 and idloaivang=".$idloaivang." 
										and id in ( select idmaphieu 
										from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
										where dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."')) 
										and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."' 
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);
		
		// Nếu trong tháng có nhập hoặc xuất idloaivang này thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['cannangv'] != 0 || $rsTongXuatTrongThang['cannangv'] != 0) {

			// Nếu có sai số trong phần nhập kho của idloaivang đó thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapvh, slnhaph, slnhapv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$rsNhapSDDKTrongThang = $GLOBALS['sp']->getRow($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['cannangvh'] != $rsNhapSDDKTrongThang['slnhapvh'] || $rsTongNhapTrongThang['cannangh'] != $rsNhapSDDKTrongThang['slnhaph'] || $rsTongNhapTrongThang['cannangv'] != $rsNhapSDDKTrongThang['slnhapv']) {
				$arrUpdateNX['slnhapvh'] = $rsTongNhapTrongThang['cannangvh'];
				$arrUpdateNX['slnhaph'] = $rsTongNhapTrongThang['cannangh'];
				$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$slxuatvSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongXuatTrongThang['cannangv'] != $slxuatvSDDK){
				$arrUpdateNX['slxuatvh'] = $arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
				$checkSaiSoNX = 1;
			}	

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {
				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonvh, sltonh, sltonv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangvh']),3) - $rsTongXuatTrongThang['cannangv'],3);
				$sltonhTrongThang = round(($rsGetSLTonThangTruoc['sltonh'] + $rsTongNhapTrongThang['cannangh']),3);
				$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);

				$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;
				$arrUpdateNX['sltonh'] = $sltonhTrongThang;
				$arrUpdateNX['sltonv'] = $sltonvTrongThang;

				vaUpdate($tablehachtoan, $arrUpdateNX, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];

				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv 
													from $GLOBALS[db_sp].".$tablect." 
													where idloaivang=".$idloaivang." 
													and type=2 
													and datechuyen >= '".$dateDauThangTiep."' 
													and datechuyen <= '".$dateCuoiThangTiep."' 
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapvh'] = $rsTongNhapThangTiep['cannangvh'];
						$arrUpdateNXThangTiep['slnhaph'] = $rsTongNhapThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
					}

					$sqlTongXuatThangTiep = "select ROUND(sum(tlvangcat), 3) as cannangv 
													from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
													where idmaphieu IN (select id from $GLOBALS[db_sp].khokhac_khotongdecucct 
													where type=2 and idloaivang=".$idloaivang." 
													and id in ( select idmaphieu 
													from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
													where dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."')) 
													and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."' 
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

					if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatvh'] = $arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangvh']),3) - $rsTongXuatThangTiep['cannangv'],3);
					$arrUpdateNXThangTiep['sltonh'] = round(($sltonhTrongThang + $rsTongNhapThangTiep['cannangh']),3);
					$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);

					vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');
				}
			}
		}
	}
}

// M.Tân thêm ngày 10/01/2020 - Điều chỉnh số liệu hạch toán Kho Bột
function dieuChinhSoLieuHachToanKhoBot($table,$tablehachtoan,$idloaivang) {

	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=1 and typechuyen=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."' 
										and typevkc = 1 
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=1 and trangthai=2 and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								"; 
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// TÍNH TỔNG HAO DƯ DỰA TRÊN CÁC PHIẾU XUẤT LỚN ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongHaoDuTrongThang = "select ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du
										from $GLOBALS[db_sp].".$table." 
										where idloaivang=".$idloaivang." and trangthai=2 and type=3
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								"; 
		$rsTongHaoDuTrongThang = $GLOBALS['sp']->getRow($sqlTongHaoDuTrongThang);

		// Nếu trong tháng có nhập hoặc xuất idloaivang này thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['cannangv'] != 0 || $rsTongXuatTrongThang['cannangv'] != 0) {

			// Nếu có sai số trong phần nhập kho của idloaivang đó thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
				$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
				$arrUpdateNX['slnhaph'] = $rsTongNhapTrongThang['cannangh'];
				$arrUpdateNX['slnhapvh'] = $rsTongNhapTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatv, hao, du from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$rsXuatSDDKTrongThang = $GLOBALS['sp']->getRow($sqlXuatSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongXuatTrongThang['cannangv'] != $rsXuatSDDKTrongThang['slxuatv']){
				$arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
				$arrUpdateNX['slxuath'] = $rsTongXuatTrongThang['cannangh'];
				$arrUpdateNX['slxuatvh'] = $rsTongXuatTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}

			// So sánh số lượng hao, dư trong sodudauky với tổng số lượng hao,dư của các phiếu xuất lớn cộng lại
			if($rsTongXuatTrongThang['hao'] != $rsXuatSDDKTrongThang['hao'] || $rsTongXuatTrongThang['du'] != $rsXuatSDDKTrongThang['du']) {
				$arrUpdateHD['hao'] = $rsTongHaoDuTrongThang['hao'];
				$arrUpdateHD['du'] = $rsTongHaoDuTrongThang['du'];

				vaUpdate($tablehachtoan, $arrUpdateHD, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');
			}

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {

				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonv, sltonh, sltonvh from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
				$sltonhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonh'] + $rsTongNhapTrongThang['cannangh']),3) - $rsTongXuatTrongThang['cannangh'],3);
				$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangvh']),3) - $rsTongXuatTrongThang['cannangvh'],3);

				$arrUpdateNX['sltonv'] = $sltonvTrongThang;
				$arrUpdateNX['sltonh'] = $sltonhTrongThang;
				$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;

				vaUpdate($tablehachtoan, $arrUpdateNX, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];

				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type=1 and typechuyen=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
													and typevkc = 1
											"; 
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slnhaph'] = $rsTongNhapThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slnhapvh'] = $rsTongNhapThangTiep['cannangvh'];
					}

					$sqlTongXuatThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type=1 and trangthai=2 and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

					if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slxuath'] = $rsTongXuatThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slxuatvh'] = $rsTongXuatThangTiep['cannangvh'];
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
					$arrUpdateNXThangTiep['sltonh'] = round(round(($sltonhTrongThang + $rsTongNhapThangTiep['cannangh']),3) - $rsTongXuatThangTiep['cannangh'],3);
					$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangvh']),3) - $rsTongXuatThangTiep['cannangvh'],3);

					vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');

				}
			}

			// Kiểm tra hao dư của tháng tiếp theo xem có sai không
			$dateDauThangTiep = $rs[$i-1]['dated'];

			if(!empty($dateDauThangTiep)){
				// Tính ngày cuối tháng của tháng tiếp theo
				$arrThangTiep = explode('-',$dateDauThangTiep);
				$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

				$sqlHaoDuThangTiep = "select ROUND(SUM(hao), 3) as hao,
											ROUND(SUM(du), 3) as du 
											from $GLOBALS[db_sp].".$table." 
											where idloaivang=".$idloaivang." and trangthai=2 and type=3 
											and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."' 
											";
				$rsHaoDuThangTiep = $GLOBALS['sp']->getRow($sqlHaoDuThangTiep);

				// Lấy ra hao, dư trong bảng sodudauky để so sánh
				$sqlHaoDuSDDKThangTiep= "select hao, du from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTiep."'";
				$rsHaoDuSDDKThangTiep = $GLOBALS['sp']->getRow($sqlHaoDuSDDKThangTiep);

				if($rsHaoDuSDDKThangTiep['hao'] != $rsHaoDuThangTiep['hao'] || $rsHaoDuSDDKThangTiep['du'] != $rsHaoDuThangTiep['du']) {
					$arrUpdateHDThangTiep['hao'] = $rsHaoDuThangTiep['hao'];
					$arrUpdateHDThangTiep['du'] = $rsHaoDuThangTiep['du'];

					vaUpdate($tablehachtoan, $arrUpdateHDThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');
				}
			}
		}
	}
}

// M.Tân thêm ngày 14/01/2020 - Điều chỉnh số liệu hạch toán Kho Lưu Mẫu
function dieuChinhSoLieuHachToanKhoLuuMau($table,$idloaivang) {

	$sql = "select * from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=1 and typechuyen=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=3 and trangthai=2 and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
										and typevkc = 1
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Nếu trong tháng có nhập hoặc xuất idloaivang này thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['cannangv'] != 0 || $rsTongXuatTrongThang['cannangv'] != 0) {

			// Nếu có sai số trong phần nhập kho của idloaivang đó thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
				$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
				$arrUpdateNX['slnhaph'] = $rsTongNhapTrongThang['cannangh'];
				$arrUpdateNX['slnhapvh'] = $rsTongNhapTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatv from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$slxuatvSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongXuatTrongThang['cannangv'] != $slxuatvSDDK){
				$arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
				$arrUpdateNX['slxuath'] = $rsTongXuatTrongThang['cannangh'];
				$arrUpdateNX['slxuatvh'] = $rsTongXuatTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}	

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {

				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonv, sltonh, sltonvh from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
				$sltonhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonh'] + $rsTongNhapTrongThang['cannangh']),3) - $rsTongXuatTrongThang['cannangh'],3);
				$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangvh']),3) - $rsTongXuatTrongThang['cannangvh'],3);

				$arrUpdateNX['sltonv'] = $sltonvTrongThang;
				$arrUpdateNX['sltonh'] = $sltonhTrongThang;
				$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;

				vaUpdate($table.'_sodudauky', $arrUpdateNX, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];

				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type=1 and typechuyen=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slnhaph'] = $rsTongNhapThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slnhapvh'] = $rsTongNhapThangTiep['cannangvh'];
					}

					$sqlTongXuatThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type=3 and trangthai=2 and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
													and typevkc = 1
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

					if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slxuath'] = $rsTongXuatThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slxuatvh'] = $rsTongXuatThangTiep['cannangvh'];
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
					$arrUpdateNXThangTiep['sltonh'] = round(round(($sltonhTrongThang + $rsTongNhapThangTiep['cannangh']),3) - $rsTongXuatThangTiep['cannangh'],3);
					$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangvh']),3) - $rsTongXuatThangTiep['cannangvh'],3);

					vaUpdate($table.'_sodudauky', $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');

				} 
			}
		}
	}
}

// M.Tân thêm ngày 18/01/2020 - Điều chỉnh số liệu hạch toán cho Kho Phân Kim
function dieuChinhSoLieuHachToanKhoPhanKim($table,$idloaivang) {
	// Update lại các phiếu nhập có dalaydulieu=1 nhưng typechuyen<>2
	$sqlGetPhieuNhap = "select id from $GLOBALS[db_sp].".$table." 
								  where idloaivang=".$idloaivang." 
								  and dalaydulieu = 1 and typechuyen <> 2
					   ";
	$rsGetPhieuNhap = $GLOBALS['sp']->getCol($sqlGetPhieuNhap);
	
	foreach($rsGetPhieuNhap as $idPhieuNhap) {
		$arrUpdate = array();

		$arrUpdate['typechuyen'] = 2;
		vaUpdate($table,$arrUpdate,' id='.$idPhieuNhap);
	}

	$sql = "select * from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = $arrUpdateHD = $arrUpdateHDThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=1 and typechuyen=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv,
										ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du 
										from $GLOBALS[db_sp].".$table." 
										where type in(2,3) and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
										and typevkc = 1
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Nếu trong tháng có nhập hoặc xuất idloaivang này thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['cannangv'] != 0 || $rsTongXuatTrongThang['cannangv'] != 0) {

			// Nếu có sai số trong phần nhập kho của idloaivang đó thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
				$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
				$arrUpdateNX['slnhaph'] = $rsTongNhapTrongThang['cannangh'];
				$arrUpdateNX['slnhapvh'] = $rsTongNhapTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất, hao, dư trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatv, hao, du from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$rsXuatSDDKTrongThang = $GLOBALS['sp']->getRow($sqlXuatSDDKTrongThang);

			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongXuatTrongThang['cannangv'] != $rsXuatSDDKTrongThang['slxuatv']){
				$arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
				$arrUpdateNX['slxuath'] = $rsTongXuatTrongThang['cannangh'];
				$arrUpdateNX['slxuatvh'] = $rsTongXuatTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}	

			// So sánh số lượng hao, dư trong sodudauky với tổng số lượng hao,dư của các phiếu xuất cộng lại
			if($rsTongXuatTrongThang['hao'] != $rsXuatSDDKTrongThang['hao'] || $rsTongXuatTrongThang['du'] != $rsXuatSDDKTrongThang['du']) {
				$arrUpdateHD['hao'] = $rsTongXuatTrongThang['hao'];
				$arrUpdateHD['du'] = $rsTongXuatTrongThang['du'];

				vaUpdate($table.'_sodudauky', $arrUpdateHD, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');
			}

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {

				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonv, sltonh, sltonvh from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
				$sltonhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonh'] + $rsTongNhapTrongThang['cannangh']),3) - $rsTongXuatTrongThang['cannangh'],3);
				$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangvh']),3) - $rsTongXuatTrongThang['cannangvh'],3);

				$arrUpdateNX['sltonv'] = $sltonvTrongThang;
				$arrUpdateNX['sltonh'] = $sltonhTrongThang;
				$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;

				vaUpdate($table.'_sodudauky', $arrUpdateNX, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];

				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type=1 and typechuyen=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slnhaph'] = $rsTongNhapThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slnhapvh'] = $rsTongNhapThangTiep['cannangvh'];
					}

					$sqlTongXuatThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type in(2,3) and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
													and typevkc = 1
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

					if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slxuath'] = $rsTongXuatThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slxuatvh'] = $rsTongXuatThangTiep['cannangvh']; 
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
					$arrUpdateNXThangTiep['sltonh'] = round(round(($sltonhTrongThang + $rsTongNhapThangTiep['cannangh']),3) - $rsTongXuatThangTiep['cannangh'],3);
					$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangvh']),3) - $rsTongXuatThangTiep['cannangvh'],3);

					vaUpdate($table.'_sodudauky', $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');

				}
			}

			// Kiểm tra hao dư của tháng tiếp theo xem có sai không
			$dateDauThangTiep = $rs[$i-1]['dated'];

			if(!empty($dateDauThangTiep)){
				// Tính ngày cuối tháng của tháng tiếp theo
				$arrThangTiep = explode('-',$dateDauThangTiep);
				$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

				$sqlHaoDuThangTiep = "select ROUND(SUM(hao), 3) as hao,
											ROUND(SUM(du), 3) as du 
											from $GLOBALS[db_sp].".$table." 
											where type in(2,3) and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											and typevkc = 1
											";
				$rsHaoDuThangTiep = $GLOBALS['sp']->getRow($sqlHaoDuThangTiep);

				// Lấy ra hao, dư trnng bảng sodudauky để so sánh
				$sqlHaoDuSDDKThangTiep= "select hao, du from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThangTiep."'";
				$rsHaoDuSDDKThangTiep = $GLOBALS['sp']->getRow($sqlHaoDuSDDKThangTiep);

				if($rsHaoDuSDDKThangTiep['hao'] != $rsHaoDuThangTiep['hao'] || $rsHaoDuSDDKThangTiep['du'] != $rsHaoDuThangTiep['du']) {
					$arrUpdateHDThangTiep['hao'] = $rsHaoDuThangTiep['hao'];
					$arrUpdateHDThangTiep['du'] = $rsHaoDuThangTiep['du'];

					vaUpdate($table.'_sodudauky', $arrUpdateHDThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');
				}
			}
		}
	}
}

// M.Tân thêm ngày 18/01/2020 - Điều chính số liệu hạch toán các Kho của Kho Nguồn Vào
function dieuChinhSoLieuHachToanKhoNguonVao($table,$tablehachtoan,$idloaivang) {

	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and typevkc=1 ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=2 and typevkc = 1 and idloaivang=".$idloaivang." 
										and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";

								
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=2 and trangthai=2 and typevkc = 1 and idloaivang=".$idloaivang." 
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Nếu trong tháng có nhập hoặc xuất idloaivang này thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['cannangv'] != 0 || $rsTongXuatTrongThang['cannangv'] != 0) {
			
			// Nếu có sai số trong phần nhập kho của idloaivang đó thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and typevkc=1 and dated = '".$dateDauThang."'";
			$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
				$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
				$arrUpdateNX['slnhaph'] = $rsTongNhapTrongThang['cannangh'];
				$arrUpdateNX['slnhapvh'] = $rsTongNhapTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and typevkc=1 and dated = '".$dateDauThang."'";
			$slxuatvSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongXuatTrongThang['cannangv'] != $slxuatvSDDK){
				$arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
				$arrUpdateNX['slxuath'] = $rsTongXuatTrongThang['cannangh'];
				$arrUpdateNX['slxuatvh'] = $rsTongXuatTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}	

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {
				
				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and typevkc=1 and dated <= '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonv, sltonh, sltonvh from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and typevkc=1 and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
				$sltonhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonh'] + $rsTongNhapTrongThang['cannangh']),3) - $rsTongXuatTrongThang['cannangh'],3);
				$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangvh']),3) - $rsTongXuatTrongThang['cannangvh'],3);

				$arrUpdateNX['sltonv'] = $sltonvTrongThang;
				$arrUpdateNX['sltonh'] = $sltonhTrongThang;
				$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;

				vaUpdate($tablehachtoan, $arrUpdateNX, ' idloaivang='.$idloaivang.' and typevkc=1 and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];

				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type=2 and typevkc = 1 and idloaivang=".$idloaivang." 
													and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slnhaph'] = $rsTongNhapThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slnhapvh'] = $rsTongNhapThangTiep['cannangvh'];
					}

					$sqlTongXuatThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type=2 and trangthai=2 and typevkc = 1 and idloaivang=".$idloaivang." 
													and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

					if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slxuath'] = $rsTongXuatThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slxuatvh'] = $rsTongXuatThangTiep['cannangvh'];
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
					$arrUpdateNXThangTiep['sltonh'] = round(round(($sltonhTrongThang + $rsTongNhapThangTiep['cannangh']),3) - $rsTongXuatThangTiep['cannangh'],3);
					$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangvh']),3) - $rsTongXuatThangTiep['cannangvh'],3);

					vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and typevkc=1 and dated="'.$dateDauThangTiep.'"');

				}
			}
		}
	}
}

// M.Tân thêm ngày 05/02/2020 - Điều chỉnh số liệu hạch toán kim cương của Kho Khác
function dieuChinhSoLieuHachToanKimCuongKhoKhac($table, $tablehachtoan) {

	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);
	
	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP, TỔNG ĐƠN GIÁ NHẬP KIM CƯƠNG DỰA TRÊN CÁC PHIẾU NHẬP
		$sqlTongNhapTrongThang = "select COUNT(id) as slnhapkimcuong, 
										ROUND(SUM(dongiaban), 3) as dongianhap
										from $GLOBALS[db_sp].".$table." 
										where type=2 
										and datechuyen >= '".$dateDauThang."' and datechuyen <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT, TỔNG ĐƠN GIÁ XUẤT KIM CƯƠNG DỰA TRÊN CÁC PHIẾU XUẤT
		$sqlTongXuatTrongThang = "select COUNT(id) as slxuatkimcuong, 
										ROUND(SUM(dongiaban), 3) as dongiaxuat
										from $GLOBALS[db_sp].".$table." 
										where type=2 and trangthai=2 
										and datechuyen >= '".$dateDauThang."' and datechuyen <= '".$dateCuoiThang."'
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);
		
		// Nếu trong tháng có nhập hoặc xuất kim cương thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['slnhapkimcuong'] != 0 || $rsTongXuatTrongThang['slxuatkimcuong'] != 0) {

			// Nếu có sai số trong phần nhập xuất kho thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapkimcuong from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThang."'";
			$slnhapkcSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập kim cương trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['slnhapkimcuong'] != $slnhapkcSDDK){
				$arrUpdateNX['slnhapkimcuong'] = $rsTongNhapTrongThang['slnhapkimcuong'];
				$arrUpdateNX['dongianhap'] = $rsTongNhapTrongThang['dongianhap'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất trong bảng sodudauky (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatkimcuong from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThang."'";
			$slxuatkcSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
			// So sánh số lượng xuất kim cương trong sodudauky với tổng số lượng xuất của các phiếu cộng lại
			if($rsTongXuatTrongThang['slxuatkimcuong'] != $slxuatkcSDDK){
				$arrUpdateNX['slxuatkimcuong'] = $rsTongXuatTrongThang['slxuatkimcuong'];
				$arrUpdateNX['dongiaxuat'] = $rsTongXuatTrongThang['dongiaxuat'];
				$checkSaiSoNX = 1;
			}	

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {

				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonkimcuong, tongdongia from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonkcTrongThang = round(round(($rsGetSLTonThangTruoc['sltonkimcuong'] + $rsTongNhapTrongThang['slnhapkimcuong']),3) - $rsTongXuatTrongThang['slxuatkimcuong'],3);
				$tongdongiaTrongThang = round(round(($rsGetSLTonThangTruoc['tongdongia'] + $rsTongNhapTrongThang['dongianhap']),3) - $rsTongXuatTrongThang['dongiaxuat'],3);

				$arrUpdateNX['sltonkimcuong'] = $sltonkcTrongThang;
				$arrUpdateNX['tongdongia'] = $tongdongiaTrongThang;

				vaUpdate($tablehachtoan, $arrUpdateNX, ' typevkc=2 and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];
				
				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select COUNT(id) as slnhapkimcuong, 
													ROUND(SUM(dongiaban), 3) as dongianhap
													from $GLOBALS[db_sp].".$table."
													where type=2 
													and datechuyen >= '".$dateDauThangTiep."' and datechuyen <= '".$dateCuoiThangTiep."'
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['slnhapkimcuong'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapkimcuong'] = $rsTongNhapThangTiep['slnhapkimcuong'];
						$arrUpdateNXThangTiep['dongianhap'] = $rsTongNhapThangTiep['dongianhap'];
					}
					
					$sqlTongXuatThangTiep = "select COUNT(id) as slxuatkimcuong, 
													ROUND(SUM(dongiaban), 3) as dongiaxuat
													from $GLOBALS[db_sp].".$table." 
													where type=2 and trangthai=2 
													and datechuyen >= '".$dateDauThangTiep."' and datechuyen <= '".$dateCuoiThangTiep."'
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);
					
					if($rsTongXuatThangTiep['slxuatkimcuong'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatkimcuong'] = $rsTongXuatThangTiep['slxuatkimcuong'];
						$arrUpdateNXThangTiep['dongiaxuat'] = $rsTongXuatThangTiep['dongiaxuat'];
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonkimcuong'] = round(round(($sltonkcTrongThang + $rsTongNhapThangTiep['slnhapkimcuong']),3) - $rsTongXuatThangTiep['slxuatkimcuong'],3);
					$arrUpdateNXThangTiep['tongdongia'] = round(round(($tongdongiaTrongThang + $rsTongNhapThangTiep['dongianhap']),3) - $rsTongXuatThangTiep['dongiaxuat'],3);

					vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' typevkc=2 and dated="'.$dateDauThangTiep.'"');

				}
			}
		}
	}
}

// M.Tân thêm ngày 19/02/2020 - Điều chỉnh số liệu hạch toán kim cương của Kho Lưu Mẫu (Kho Khác)
function dieuChinhSoLieuHachToanKimCuongLuuMau($table, $tablehachtoan) {

	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);
	
	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP, TỔNG ĐƠN GIÁ NHẬP KIM CƯƠNG DỰA TRÊN CÁC PHIẾU NHẬP
		$sqlTongNhapTrongThang = "select COUNT(id) as slnhapkimcuong, 
										ROUND(SUM(dongiaban), 3) as dongianhap
										from $GLOBALS[db_sp].".$table." 
										where type=2 and typevkc = 2 
										and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT, TỔNG ĐƠN GIÁ XUẤT KIM CƯƠNG DỰA TRÊN CÁC PHIẾU XUẤT
		$sqlTongXuatTrongThang = "select COUNT(id) as slxuatkimcuong, 
										ROUND(SUM(dongiaban), 3) as dongiaxuat
										from $GLOBALS[db_sp].".$table." 
										where type=2 and trangthai=2 and typevkc = 2
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);
		
		// Nếu trong tháng có nhập hoặc xuất kim cương thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['slnhapkimcuong'] != 0 || $rsTongXuatTrongThang['slxuatkimcuong'] != 0) {

			// Nếu có sai số trong phần nhập xuất kho thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapkimcuong from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThang."'";
			$slnhapkcSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập kim cương trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['slnhapkimcuong'] != $slnhapkcSDDK){
				$arrUpdateNX['slnhapkimcuong'] = $rsTongNhapTrongThang['slnhapkimcuong'];
				$arrUpdateNX['dongianhap'] = $rsTongNhapTrongThang['dongianhap'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất trong bảng sodudauky (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatkimcuong from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThang."'";
			$slxuatkcSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
			// So sánh số lượng xuất kim cương trong sodudauky với tổng số lượng xuất của các phiếu cộng lại
			if($rsTongXuatTrongThang['slxuatkimcuong'] != $slxuatkcSDDK){
				$arrUpdateNX['slxuatkimcuong'] = $rsTongXuatTrongThang['slxuatkimcuong'];
				$arrUpdateNX['dongiaxuat'] = $rsTongXuatTrongThang['dongiaxuat'];
				$checkSaiSoNX = 1;
			}	

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {

				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonkimcuong, tongdongia from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonkcTrongThang = round(round(($rsGetSLTonThangTruoc['sltonkimcuong'] + $rsTongNhapTrongThang['slnhapkimcuong']),3) - $rsTongXuatTrongThang['slxuatkimcuong'],3);
				$tongdongiaTrongThang = round(round(($rsGetSLTonThangTruoc['tongdongia'] + $rsTongNhapTrongThang['dongianhap']),3) - $rsTongXuatTrongThang['dongiaxuat'],3);

				$arrUpdateNX['sltonkimcuong'] = $sltonkcTrongThang;
				$arrUpdateNX['tongdongia'] = $tongdongiaTrongThang;

				vaUpdate($tablehachtoan, $arrUpdateNX, ' typevkc=2 and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];
				
				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select COUNT(id) as slnhapkimcuong, 
													ROUND(SUM(dongiaban), 3) as dongianhap
													from $GLOBALS[db_sp].".$table."
													where type=2 and typevkc = 2
													and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['slnhapkimcuong'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapkimcuong'] = $rsTongNhapThangTiep['slnhapkimcuong'];
						$arrUpdateNXThangTiep['dongianhap'] = $rsTongNhapThangTiep['dongianhap'];
					}
					
					$sqlTongXuatThangTiep = "select COUNT(id) as slxuatkimcuong, 
													ROUND(SUM(dongiaban), 3) as dongiaxuat
													from $GLOBALS[db_sp].".$table." 
													where type=2 and trangthai=2 and typevkc = 2
													and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);
					
					if($rsTongXuatThangTiep['slxuatkimcuong'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatkimcuong'] = $rsTongXuatThangTiep['slxuatkimcuong'];
						$arrUpdateNXThangTiep['dongiaxuat'] = $rsTongXuatThangTiep['dongiaxuat'];
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonkimcuong'] = round(round(($sltonkcTrongThang + $rsTongNhapThangTiep['slnhapkimcuong']),3) - $rsTongXuatThangTiep['slxuatkimcuong'],3);
					$arrUpdateNXThangTiep['tongdongia'] = round(round(($tongdongiaTrongThang + $rsTongNhapThangTiep['dongianhap']),3) - $rsTongXuatThangTiep['dongiaxuat'],3);

					vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' typevkc=2 and dated="'.$dateDauThangTiep.'"');

				}
			}
		}
	}
}

// M.Tân thêm ngày 13/02/2020 - Điều chỉnh số liệu hạch toán kim cương của Kho Nguồn Vào
function dieuChinhSoLieuHachToanKimCuongKhoNguonVao($table, $tablehachtoan) {

	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);
	
	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP, TỔNG ĐƠN GIÁ NHẬP KIM CƯƠNG DỰA TRÊN CÁC PHIẾU NHẬP
		$sqlTongNhapTrongThang = "select COUNT(id) as slnhapkimcuong, 
										ROUND(SUM(dongiaban), 3) as dongianhap
										from $GLOBALS[db_sp].".$table." 
										where type=2 and typevkc = 2 
										and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT, TỔNG ĐƠN GIÁ XUẤT KIM CƯƠNG DỰA TRÊN CÁC PHIẾU XUẤT
		$sqlTongXuatTrongThang = "select COUNT(id) as slxuatkimcuong, 
										ROUND(SUM(dongiaban), 3) as dongiaxuat
										from $GLOBALS[db_sp].".$table." 
										where type=2 and trangthai=2 and typevkc = 2
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);
		
		// Nếu trong tháng có nhập hoặc xuất kim cương thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['slnhapkimcuong'] != 0 || $rsTongXuatTrongThang['slxuatkimcuong'] != 0) {

			// Nếu có sai số trong phần nhập xuất kho thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapkimcuong from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThang."'";
			$slnhapkcSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập kim cương trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['slnhapkimcuong'] != $slnhapkcSDDK){
				$arrUpdateNX['slnhapkimcuong'] = $rsTongNhapTrongThang['slnhapkimcuong'];
				$arrUpdateNX['dongianhap'] = $rsTongNhapTrongThang['dongianhap'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất trong bảng sodudauky (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatkimcuong from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThang."'";
			$slxuatkcSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
			// So sánh số lượng xuất kim cương trong sodudauky với tổng số lượng xuất của các phiếu cộng lại
			if($rsTongXuatTrongThang['slxuatkimcuong'] != $slxuatkcSDDK){
				$arrUpdateNX['slxuatkimcuong'] = $rsTongXuatTrongThang['slxuatkimcuong'];
				$arrUpdateNX['dongiaxuat'] = $rsTongXuatTrongThang['dongiaxuat'];
				$checkSaiSoNX = 1;
			}	

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {

				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonkimcuong, tongdongia from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonkcTrongThang = round(round(($rsGetSLTonThangTruoc['sltonkimcuong'] + $rsTongNhapTrongThang['slnhapkimcuong']),3) - $rsTongXuatTrongThang['slxuatkimcuong'],3);
				$tongdongiaTrongThang = round(round(($rsGetSLTonThangTruoc['tongdongia'] + $rsTongNhapTrongThang['dongianhap']),3) - $rsTongXuatTrongThang['dongiaxuat'],3);

				$arrUpdateNX['sltonkimcuong'] = $sltonkcTrongThang;
				$arrUpdateNX['tongdongia'] = $tongdongiaTrongThang;

				vaUpdate($tablehachtoan, $arrUpdateNX, ' typevkc=2 and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];
				
				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select COUNT(id) as slnhapkimcuong, 
													ROUND(SUM(dongiaban), 3) as dongianhap
													from $GLOBALS[db_sp].".$table."
													where type=2 and typevkc = 2
													and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['slnhapkimcuong'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapkimcuong'] = $rsTongNhapThangTiep['slnhapkimcuong'];
						$arrUpdateNXThangTiep['dongianhap'] = $rsTongNhapThangTiep['dongianhap'];
					}
					
					$sqlTongXuatThangTiep = "select COUNT(id) as slxuatkimcuong, 
													ROUND(SUM(dongiaban), 3) as dongiaxuat
													from $GLOBALS[db_sp].".$table." 
													where type=2 and trangthai=2 and typevkc = 2
													and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);
					
					if($rsTongXuatThangTiep['slxuatkimcuong'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatkimcuong'] = $rsTongXuatThangTiep['slxuatkimcuong'];
						$arrUpdateNXThangTiep['dongiaxuat'] = $rsTongXuatThangTiep['dongiaxuat'];
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonkimcuong'] = round(round(($sltonkcTrongThang + $rsTongNhapThangTiep['slnhapkimcuong']),3) - $rsTongXuatThangTiep['slxuatkimcuong'],3);
					$arrUpdateNXThangTiep['tongdongia'] = round(round(($tongdongiaTrongThang + $rsTongNhapThangTiep['dongianhap']),3) - $rsTongXuatThangTiep['dongiaxuat'],3);

					vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' typevkc=2 and dated="'.$dateDauThangTiep.'"');

				}
			}
		}
	}
}

// M.Tân thêm ngày 19/02/2020 - Điều chỉnh số liệu hạch toán kim cương của Kho Thành Phẩm (Kho Sản Xuất)
function dieuChinhSoLieuHachToanKimCuongKhoThanhPham($table, $tablehachtoan) {

	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);
	
	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP, TỔNG ĐƠN GIÁ NHẬP KIM CƯƠNG DỰA TRÊN CÁC PHIẾU NHẬP
		$sqlTongNhapTrongThang = "select COUNT(id) as slnhapkimcuong, 
										ROUND(SUM(dongiaban), 3) as dongianhap
										from $GLOBALS[db_sp].".$table." 
										where type=2 and typevkc = 2 
										and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT, TỔNG ĐƠN GIÁ XUẤT KIM CƯƠNG DỰA TRÊN CÁC PHIẾU XUẤT
		$sqlTongXuatTrongThang = "select COUNT(id) as slxuatkimcuong, 
										ROUND(SUM(dongiaban), 3) as dongiaxuat
										from $GLOBALS[db_sp].".$table." 
										where type=2 and trangthai=2 and typevkc = 2
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);
		
		// Nếu trong tháng có nhập hoặc xuất kim cương thì mới tiến hành so sánh và xử lý
		if($rsTongNhapTrongThang['slnhapkimcuong'] != 0 || $rsTongXuatTrongThang['slxuatkimcuong'] != 0) {

			// Nếu có sai số trong phần nhập xuất kho thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapkimcuong from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThang."'";
			$slnhapkcSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập kim cương trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['slnhapkimcuong'] != $slnhapkcSDDK){
				$arrUpdateNX['slnhapkimcuong'] = $rsTongNhapTrongThang['slnhapkimcuong'];
				$arrUpdateNX['dongianhap'] = $rsTongNhapTrongThang['dongianhap'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất trong bảng sodudauky (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatkimcuong from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThang."'";
			$slxuatkcSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
			// So sánh số lượng xuất kim cương trong sodudauky với tổng số lượng xuất của các phiếu cộng lại
			if($rsTongXuatTrongThang['slxuatkimcuong'] != $slxuatkcSDDK){
				$arrUpdateNX['slxuatkimcuong'] = $rsTongXuatTrongThang['slxuatkimcuong'];
				$arrUpdateNX['dongiaxuat'] = $rsTongXuatTrongThang['dongiaxuat'];
				$checkSaiSoNX = 1;
			}	

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {

				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonkimcuong, tongdongia from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonkcTrongThang = round(round(($rsGetSLTonThangTruoc['sltonkimcuong'] + $rsTongNhapTrongThang['slnhapkimcuong']),3) - $rsTongXuatTrongThang['slxuatkimcuong'],3);
				$tongdongiaTrongThang = round(round(($rsGetSLTonThangTruoc['tongdongia'] + $rsTongNhapTrongThang['dongianhap']),3) - $rsTongXuatTrongThang['dongiaxuat'],3);

				$arrUpdateNX['sltonkimcuong'] = $sltonkcTrongThang;
				$arrUpdateNX['tongdongia'] = $tongdongiaTrongThang;

				vaUpdate($tablehachtoan, $arrUpdateNX, ' typevkc=2 and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];
				
				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select COUNT(id) as slnhapkimcuong, 
													ROUND(SUM(dongiaban), 3) as dongianhap
													from $GLOBALS[db_sp].".$table."
													where type=2 and typevkc = 2
													and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['slnhapkimcuong'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapkimcuong'] = $rsTongNhapThangTiep['slnhapkimcuong'];
						$arrUpdateNXThangTiep['dongianhap'] = $rsTongNhapThangTiep['dongianhap'];
					}
					
					$sqlTongXuatThangTiep = "select COUNT(id) as slxuatkimcuong, 
													ROUND(SUM(dongiaban), 3) as dongiaxuat
													from $GLOBALS[db_sp].".$table." 
													where type=2 and trangthai=2 and typevkc = 2
													and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);
					
					if($rsTongXuatThangTiep['slxuatkimcuong'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatkimcuong'] = $rsTongXuatThangTiep['slxuatkimcuong'];
						$arrUpdateNXThangTiep['dongiaxuat'] = $rsTongXuatThangTiep['dongiaxuat'];
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonkimcuong'] = round(round(($sltonkcTrongThang + $rsTongNhapThangTiep['slnhapkimcuong']),3) - $rsTongXuatThangTiep['slxuatkimcuong'],3);
					$arrUpdateNXThangTiep['tongdongia'] = round(round(($tongdongiaTrongThang + $rsTongNhapThangTiep['dongianhap']),3) - $rsTongXuatThangTiep['dongiaxuat'],3);

					vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' typevkc=2 and dated="'.$dateDauThangTiep.'"');

				}
			}
		}
	}
}

// M.Tân thêm ngày 16/12/2019 - Hạch toán lại khi chỉnh sửa số liệu Kho Phụ Kiện (không thay đổi mã phụ kiện và loại vàng)
function editHachToanDCSLKhoPhuKien($id, $cannangvhedit, $cannanghedit, $soluongphukienedit, $table, $tablehachtoan, $tablehachtoanma){ 
	////type = 1 nhập kho else xuất kho
	$datetao = $datedauthang = '';

	// Lấy ra phiếu ứng với id
	$rsct = getTableRow($table,' and id='.$id);
	$idloaivang = $rsct['idloaivang'];
	$idphukien = $rsct['idphukien'];
	$cannangvh = $rsct['cannangvh'];
	$cannangh = $rsct['cannangh'];
	$cannangv = $rsct['cannangv'];
	$soluongphukien = $rsct['soluongphukien'];

	// Lấy ra ngày hạch toán phiếu để lấy ngày đầu tháng
	if($rsct['type'] == 1){/// nhập kho
		$datetao = explode('-',$rsct['dated']);
		$datedauthang = $datetao[0].'-'.$datetao[1].'-01';	
	}
	else{/// xuất kho
		$datetao = explode('-',$rsct['datedxuat']);
		$datedauthang = $datetao[0].'-'.$datetao[1].'-01';		
	}

	$cannangvedit = round(($cannangvhedit - $cannanghedit),3);
	
	// Lấy ra date hạch toán của trong tháng mà phiếu đó cần sửa
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1";
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	

	// Lấy ra date hạch toán mã của trong tháng mà phiếu đó cần sửa
	$sqldatemapk = "select * from $GLOBALS[db_sp].".$tablehachtoanma." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and idphukien=".$idphukien;
	$rsdatemapk = $GLOBALS['sp']->getRow($sqldatemapk);

	clearstatcache();
	unset($arrdatenew);
	unset($arrdatemanew);
	$arrdatemanew = $arrdatenew = array();

	if($rsct['type'] == 1){/// nhập kho
		// Cập nhật lại ở tablehachtoan
		$arrdatenew['slnhapvh'] =  round($rsdate['slnhapvh'] + round(($cannangvhedit - $rsct['cannangvh']),3),3);
		$arrdatenew['sltonvh'] =   round($rsdate['sltonvh'] + round(($cannangvhedit - $rsct['cannangvh']),3),3);
		$arrdatenew['slnhaph'] =  round($rsdate['slnhaph'] + round(($cannanghedit - $rsct['cannangh']),3),3);
		$arrdatenew['sltonh'] =  round($rsdate['sltonh'] + round(($cannanghedit - $rsct['cannangh']),3),3);
		$arrdatenew['slnhapv'] = round(($arrdatenew['slnhapvh'] - $arrdatenew['slnhaph']),3);
		$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);	

		// Cập nhật lại ở tablehachtoanma
		$arrdatemanew['slnhapv'] = round($rsdatemapk['slnhapv'] + round(($cannangvedit - $rsct['cannangv']),3),3);
		$arrdatemanew['sltonv'] = round($rsdatemapk['sltonv'] + round(($cannangvedit - $rsct['cannangv']),3),3);
		$arrdatemanew['slnhapphukien'] = round($rsdatemapk['slnhapphukien'] + round(($soluongphukienedit - $rsct['soluongphukien']),3),3);
		$arrdatemanew['sltonphukien'] = round($rsdatemapk['sltonphukien'] + round(($soluongphukienedit - $rsct['soluongphukien']),3),3);
	}
	else{////xuất kho
		// Cập nhật lại ở tablehachtoan
		$arrdatenew['slxuatvh'] = round($rsdate['slxuatvh'] + round(($cannangvhedit - $rsct['cannangvh']),3),3);
		$arrdatenew['sltonvh'] =  round($rsdate['sltonvh'] - round(($cannangvhedit - $rsct['cannangvh']),3),3);
		$arrdatenew['slxuath'] =  round($rsdate['slxuath'] + round(($cannanghedit - $rsct['cannangh']),3),3);
		$arrdatenew['sltonh'] = round( $rsdate['sltonh'] - round(($cannanghedit - $rsct['cannangh']),3),3);
		$arrdatenew['slxuatv'] = round(($arrdatenew['slxuatvh'] - $arrdatenew['slxuath']),3);
		$arrdatenew['sltonv'] = round(($arrdatenew['sltonvh'] - $arrdatenew['sltonh']),3);	
		
		// Cập nhật lại ở tablehachtoanma
		$arrdatemanew['slxuatv'] = round($rsdatemapk['slxuatv'] + round(($cannangvedit - $rsct['cannangv']),3),3);
		$arrdatemanew['sltonv'] = round($rsdatemapk['sltonv'] - round(($cannangvedit - $rsct['cannangv']),3),3);
		$arrdatemanew['slxuatphukien'] = round($rsdatemapk['slxuatphukien'] + round(($soluongphukienedit - $rsct['soluongphukien']),3),3);
		$arrdatemanew['sltonphukien'] = round($rsdatemapk['sltonphukien'] - round(($soluongphukienedit - $rsct['soluongphukien']),3),3);
	}
	// print_r($arrdatenew); print_r($arrdatemanew); die();
	vaUpdate($tablehachtoan,$arrdatenew,' id='.$rsdate['id']);
	vaUpdate($tablehachtoanma,$arrdatemanew,' id='.$rsdatemapk['id']);
	
	// Cập nhật lại số dư dầu kỳ những tháng sau đó (nếu có) trong tablehachtoan (không thay đổi loại vàng)
	$sqldatenewadd = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated > '".$datedauthang."' and idloaivang=".$idloaivang." and typevkc=1 order by dated asc";	
	$rsdatenewadd = $GLOBALS['sp']->getAll($sqldatenewadd);
	
	if(ceil(count($rsdatenewadd)) > 0){
		foreach($rsdatenewadd as $itemnewadd){
			clearstatcache();
			unset($arrdatenewadd);
			$arrdatenewadd =  array();
			if($rsct['type'] == 1){/// nhập kho
				$arrdatenewadd['sltonvh'] =  round($itemnewadd['sltonvh'] + round(($cannangvhedit - $rsct['cannangvh']),3),3);
				$arrdatenewadd['sltonh'] = round($itemnewadd['sltonh'] + round(($cannanghedit - $rsct['cannangh']),3),3);
				$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);	
			}
			else{
				$arrdatenewadd['sltonvh'] =  round($itemnewadd['sltonvh'] - round(($cannangvhedit - $rsct['cannangvh']),3),3);
				$arrdatenewadd['sltonh'] = round($itemnewadd['sltonh'] - round(($cannanghedit - $rsct['cannangh']),3),3);
				$arrdatenewadd['sltonv'] = round(($arrdatenewadd['sltonvh'] - $arrdatenewadd['sltonh']),3);		
			}
			vaUpdate($tablehachtoan,$arrdatenewadd,' id='.$itemnewadd['id']);
		}
	}
	
	// Cập nhật lại số dư đầu kỳ những tháng sau đó (nếu có) trong tablehachtoanma (không thay đổi loại vàng và phụ kiện)
	$sqldatemapknewadd = "select * from $GLOBALS[db_sp].".$tablehachtoanma." where dated > '".$datedauthang."' and idloaivang=".$idloaivang." and idphukien=".$idphukien." order by dated asc";
	$rsdatemapknewadd = $GLOBALS['sp']->getAll($sqldatemapknewadd);
	if(ceil(count($rsdatemapknewadd)) > 0){
		foreach($rsdatemapknewadd as $itemmapknewadd){
			clearstatcache();
			unset($arrdatemapknewadd);
			$arrdatemapknewadd =  array();
			if($rsct['type'] == 1){/// nhập kho
				$arrdatemapknewadd['sltonv'] =  round($itemmapknewadd['sltonv'] + round(($cannangvedit - $rsct['cannangv']),3),3);
				$arrdatemapknewadd['sltonphukien'] = round($itemmapknewadd['sltonphukien'] + round(($soluongphukienedit - $rsct['soluongphukien']),3),3);
			}
			else{
				$arrdatemapknewadd['sltonv'] =  round($itemmapknewadd['sltonv'] - round(($cannangvedit - $rsct['cannangv']),3),3);
				$arrdatemapknewadd['sltonphukien'] = round($itemmapknewadd['sltonphukien'] - round(($soluongphukienedit - $rsct['soluongphukien']),3),3);	
			}
			vaUpdate($tablehachtoanma,$arrdatemapknewadd,' id='.$itemmapknewadd['id']);
		}
	}	
}

// M.Tân thêm ngày 27/12/2019 - Thống kê tồn kho có chọn ngày Kho Sau Chế Tác
function insert_thongKeTonKhoSauCheTac($a){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$datenow = date("Y-m-d");
	
	$datenowdauthang = date("Y-m-01");
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where typesauchetac=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, 
											ROUND(SUM(du), 3) as du
											from $GLOBALS[db_sp].".$tablehachtoan." 
								 			where idloaivang=".$idloaivang." 
								 			and dated <= '".$thangtruoc."'
									";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					//die($sqlhaodusddk);
					$sltonsddk = $rstonsddk['sltonv'];					
					// $sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du
										from $GLOBALS[db_sp].".$tablehachtoan." 
								 		where idloaivang=".$idloaivang." 
										and dated <= '".$datedauthang."'
								";
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
							
					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$datenowdauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(($rston['slnhapv'] -  $rston['slxuatv']),3);
					$slton = round(round($sltonsddk + $rston['slnhapv'],3) - $rston['slxuatv'],3);
					$slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = $rstonsddk['sltonv'];
					$thangdauky = $rstonsddk['dated']; 
										
					$sqlnhaptndt = "select ROUND(SUM(trongluongvangsauchetac), 3)  as slnhapvang 
									from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and typesauchetac=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
									"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					
					$sqlxuattndt = "select ROUND(SUM(trongluongvangsauchetac), 3) as slxuatvang 
									from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and typesauchetac=2
									and trangthai=2
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
									"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlnhap = "select ROUND(SUM(trongluongvangsauchetac), 3) as slnhapvang 
										from $GLOBALS[db_sp].".$table." 
										where idloaivang=".$idloaivang." 
										and typesauchetac=2
										and dated >= '".$fromDate."'  
										and dated <= '".$toDate."' 
								"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					// die($sqlnhap);
					$sqlxuat = "select ROUND(SUM(trongluongvangsauchetac), 3) as slxuatvang, 
										ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du 				
										from $GLOBALS[db_sp].".$table." 
										where idloaivang=".$idloaivang."
										and typesauchetac=2
										and trangthai=2
										and datedxuat >= '".$fromDate."'  
										and datedxuat <= '".$toDate."' 
								";
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
					
					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					// $sltontndn = round(round(($sltontndn - $rsxuat['hao']),3) + $rsxuat['du'],3);
					
					$slton = $sltonsddk + $sltontndn;
										
					$arrlist['slhao'] = $rsxuat['hao'];
					$arrlist['sldu'] = $rsxuat['du'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}
function thongKeTonKhoSauCheTac($cid, $idloaivang, $fromDate, $toDate){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;

	
	$datenowdauthang = date("Y-m-01");
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where typesauchetac=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, 
											ROUND(SUM(du), 3) as du
											from $GLOBALS[db_sp].".$tablehachtoan." 
								 			where idloaivang=".$idloaivang." 
								 			and dated <= '".$thangtruoc."'
									";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					//die($sqlhaodusddk);
					$sltonsddk = $rstonsddk['sltonv'];					
					// $sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du
										from $GLOBALS[db_sp].".$tablehachtoan." 
								 		where idloaivang=".$idloaivang." 
										and dated <= '".$datedauthang."'
								";
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
							
					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$datenowdauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(($rston['slnhapv'] -  $rston['slxuatv']),3);
					$slton = round(round($sltonsddk + $rston['slnhapv'],3) - $rston['slxuatv'],3);
					$slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = $rstonsddk['sltonv'];
					$thangdauky = $rstonsddk['dated']; 
										
					$sqlnhaptndt = "select ROUND(SUM(trongluongvangsauchetac), 3)  as slnhapvang 
									from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and typesauchetac=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
									"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					
					$sqlxuattndt = "select ROUND(SUM(trongluongvangsauchetac), 3) as slxuatvang 
									from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and typesauchetac=2
									and trangthai=2
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
									"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlnhap = "select ROUND(SUM(trongluongvangsauchetac), 3) as slnhapvang 
										from $GLOBALS[db_sp].".$table." 
										where idloaivang=".$idloaivang." 
										and typesauchetac=2
										and dated >= '".$fromDate."'  
										and dated <= '".$toDate."' 
								"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					// die($sqlnhap);
					$sqlxuat = "select ROUND(SUM(trongluongvangsauchetac), 3) as slxuatvang, 
										ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du 				
										from $GLOBALS[db_sp].".$table." 
										where idloaivang=".$idloaivang."
										and typesauchetac=2
										and trangthai=2
										and datedxuat >= '".$fromDate."'  
										and datedxuat <= '".$toDate."' 
								";
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
					
					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					// $sltontndn = round(round(($sltontndn - $rsxuat['hao']),3) + $rsxuat['du'],3);
					
					$slton = $sltonsddk + $sltontndn;
										
					$arrlist['slhao'] = $rsxuat['hao'];
					$arrlist['sldu'] = $rsxuat['du'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}
// M.Tân thêm ngày 08/01/2020 - Thống kê tồn kho có chọn ngày Kho Tổng Dẻ Cục
function thongKeTonKhoTongDeCuc($cid,$idloaivang,$fromDate,$toDate){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;

	$datenow = date("Y-m-d");
	$datenowdauthang = date("Y-m-01");
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablect = $rsgettable['tablect'];
 	$tablehachtoan = $rsgettable['tablehachtoan'];
	
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$tablect." where type=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, 
											ROUND(SUM(du), 3) as du
											from $GLOBALS[db_sp].".$tablehachtoan." 
								 			where idloaivang=".$idloaivang." 
								 			and dated <= '".$thangtruoc."'
									";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					// die($sqltonsddk);
					$sltonsddk = $rstonsddk['sltonv'];					
					// $sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du
										from $GLOBALS[db_sp].".$tablehachtoan." 
								 		where idloaivang=".$idloaivang." 
										and dated <= '".$datedauthang."'
								";
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
							
					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$datenowdauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(($rston['slnhapv'] -  $rston['slxuatv']),3);
					$slton = round(round($sltonsddk + $rston['slnhapv'],3) - $rston['slxuatv'],3);
					$slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = $rstonsddk['sltonv'];
					$thangdauky = $rstonsddk['dated']; 
										
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$tablect." 
									where idloaivang=".$idloaivang." 
									and type=2
									and datechuyen < '".$fromDate."'  
									and datechuyen >= '".$datedauthang."' 
									"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					
					$sqlxuattndt = "select ROUND(sum(tlvangcat), 3) as slxuatvang 
											from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
											where idmaphieu IN (select id from $GLOBALS[db_sp].khokhac_khotongdecucct
											where type=2 and idloaivang=".$idloaivang." 
											and id in ( select idmaphieu 
											from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
											where dated < '".$fromDate."' and dated >= '".$datedauthang."')) 
											and dated < '".$fromDate."' and dated >= '".$datedauthang."'
									";
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$tablect." 
									where idloaivang=".$idloaivang." 
									and type=2
									and datechuyen >= '".$fromDate."'  
									and datechuyen <= '".$toDate."' 
								"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					// die($sqlnhap);
					$sqlxuat = "select ROUND(sum(tlvangcat), 3) as slxuatvang 
										from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
										where idmaphieu IN (select id from $GLOBALS[db_sp].khokhac_khotongdecucct
										where type=2 and idloaivang=".$idloaivang." 
										and id in ( select idmaphieu 
										from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
										where dated >= '".$fromDate."' and dated <= '".$toDate."')) 
										and dated >= '".$fromDate."' and dated <= '".$toDate."'
								";
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
					
					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					$sltontndn = round(round(($sltontndn - $rsxuat['hao']),3) + $rsxuat['du'],3);
					
					$slton = $sltonsddk + $sltontndn;
										
					$arrlist['slhao'] = $rsxuat['hao'];
					$arrlist['sldu'] = $rsxuat['du'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

function insert_thongKeTonKhoTongDeCuc($a){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$datenow = date("Y-m-d");
	
	$datenowdauthang = date("Y-m-01");
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablect = $rsgettable['tablect'];
 	$tablehachtoan = $rsgettable['tablehachtoan'];
	
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$tablect." where type=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, 
											ROUND(SUM(du), 3) as du
											from $GLOBALS[db_sp].".$tablehachtoan." 
								 			where idloaivang=".$idloaivang." 
								 			and dated <= '".$thangtruoc."'
									";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					// die($sqltonsddk);
					$sltonsddk = $rstonsddk['sltonv'];					
					// $sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du
										from $GLOBALS[db_sp].".$tablehachtoan." 
								 		where idloaivang=".$idloaivang." 
										and dated <= '".$datedauthang."'
								";
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
							
					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$datenowdauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(($rston['slnhapv'] -  $rston['slxuatv']),3);
					$slton = round(round($sltonsddk + $rston['slnhapv'],3) - $rston['slxuatv'],3);
					$slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = $rstonsddk['sltonv'];
					$thangdauky = $rstonsddk['dated']; 
										
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$tablect." 
									where idloaivang=".$idloaivang." 
									and type=2
									and datechuyen < '".$fromDate."'  
									and datechuyen >= '".$datedauthang."' 
									"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					
					$sqlxuattndt = "select ROUND(sum(tlvangcat), 3) as slxuatvang 
											from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
											where idmaphieu IN (select id from $GLOBALS[db_sp].khokhac_khotongdecucct
											where type=2 and idloaivang=".$idloaivang." 
											and id in ( select idmaphieu 
											from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
											where dated < '".$fromDate."' and dated >= '".$datedauthang."')) 
											and dated < '".$fromDate."' and dated >= '".$datedauthang."'
									";
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$tablect." 
									where idloaivang=".$idloaivang." 
									and type=2
									and datechuyen >= '".$fromDate."'  
									and datechuyen <= '".$toDate."' 
								"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					// die($sqlnhap);
					$sqlxuat = "select ROUND(sum(tlvangcat), 3) as slxuatvang 
										from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
										where idmaphieu IN (select id from $GLOBALS[db_sp].khokhac_khotongdecucct
										where type=2 and idloaivang=".$idloaivang." 
										and id in ( select idmaphieu 
										from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac 
										where dated >= '".$fromDate."' and dated <= '".$toDate."')) 
										and dated >= '".$fromDate."' and dated <= '".$toDate."'
								";
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
					
					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					$sltontndn = round(round(($sltontndn - $rsxuat['hao']),3) + $rsxuat['du'],3);
					
					$slton = $sltonsddk + $sltontndn;
										
					$arrlist['slhao'] = $rsxuat['hao'];
					$arrlist['sldu'] = $rsxuat['du'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

////////////////////////////////////////////XUÂN MAI THÊM THỐNG KÊ TỒN KHO CHI TIẾT KHO TEM HỘP////////////////////////////////////////////
function insert_thongKeTonKhoChiTietTemHop($a){
	$cid = ceil(trim($a['cid']));
	$idtemhop = ceil(trim($a['idtemhop']));
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	
	return thongKeTonKhoChiTietTemHop($cid, $idtemhop, $fromDate, $toDate);
}

function thongKeTonKhoChiTietTemHop($cid, $idtemhop, $fromDate, $toDate){
	
	$arrlist = array();
	$whnhap = $sqlktsach = $rskttem = $sqlton = $rston = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$rsgettable = getTableRow("categories", "and id=".$cid);
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$datedfirs = explode('/',$fromDate);
			$datedauthang = $datedfirs[2].'-'.$datedfirs[1].'-01';
			$fromDate = explode("/", $fromDate);
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
		}
		if(!empty($toDate)){
			$toDate = explode("/", $toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];		
			$whnhap.=' and dated <= "'.$toDate.'" ';
		}
		if($idtemhop > 0){
			////////kiểm tra có trong kho hay kg để xuất ra
			$sqlktsach = "select * from $GLOBALS[db_sp].".$table." where idtemhop = ".$idtemhop." limit 1";
			$rskttem = $GLOBALS['sp']->getRow($sqlktsach);
			if(ceil($rskttem['id']) > 0){///////có tồn tại
				//==get đơn giá mã vật dụng
				$sqldongia = "SELECT dongia FROM $GLOBALS[db_catalog].khovatdungdonghe 
									WHERE id=".$idtemhop.
									' limit 1';
				$rsdongia = $GLOBALS['catalog']->getOne($sqldongia);

				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					
					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." 
								where idtemhop=".$idtemhop." 
								and dated = '$datedauthang' 
								order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					////////////////get số tồn tháng trước
					$sql_ttt = "select * from $GLOBALS[db_sp].".$tablehachtoan." 
								where idtemhop=".$idtemhop." 
								and dated < '".$datedauthang."' 
								order by id desc limit 1";
					$rs_ttt = $GLOBALS['sp']->getRow($sql_ttt);
					
					$arrlist['slnhap'] = $rston['soluongnhap'];
					$arrlist['slxuat'] = $rston['soluongxuat'];
					$arrlist['slton'] = $rston['soluongton'];

					$arrlist['tienton'] = round($arrlist['slton'] * $rsdongia,3);
					$arrlist['sltonsddk'] = $rs_ttt['soluongton'];
				}else{// if có chọn ngày
					////////////////get số tồn tháng trước
					$sql_ttt = "select * from $GLOBALS[db_sp].".$tablehachtoan." 
								where idtemhop=".$idtemhop." 
								and dated < '".$datedauthang."' 
								order by id desc limit 1";
					$rs_ttt = $GLOBALS['sp']->getRow($sql_ttt);
					// get số lượng từ ngày đến đầu tháng
					$sqlnhaptndt = "select SUM(soluong) as slnhaptem from $GLOBALS[db_sp].".$table." 
									where idtemhop=".$idtemhop." 
									and type=1 and trangthai=2
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);
					$sqlxuattndt = "select SUM(soluong) as slxuattem from $GLOBALS[db_sp].".$table." 
									where idtemhop=".$idtemhop." 
									and type=2 and trangthai=2
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					";
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);

					$sltontndt = round(($rsnhaptndt['slnhaptem'] - $rsxuattndt['slxuattem']),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);
					$sltonsddk = round($rs_ttt['soluongton'] + $sltonsddk,3);
					// /////////////////////get số lượng nhập, xuất
					$sqlnhap = "select SUM(soluong) as slnhaptem from $GLOBALS[db_sp].".$table." 
									 where idtemhop=".$idtemhop." 
									 and type=1 and trangthai=2
									 and dated >= '".$fromDate."'
									 and dated <= '".$toDate."'
						";
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);
					// print_r($rsnhap);die();
					$sqlxuat = "select SUM(soluong) as slxuattem from $GLOBALS[db_sp].".$table." 
					            where idtemhop=".$idtemhop."
								and type=2 and trangthai=2
								and dated >= '".$fromDate."'  
								and dated <= '".$toDate."'
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
					// die(print_r($rsxuat));
					$sltontndn = round(($rsnhap['slnhaptem'] - $rsxuat['slxuattem']),3);
					$slton = round($sltonsddk + $sltontndn,3);
					// die(print_r($slton));
					$arrlist['slnhap'] = $rsnhap['slnhaptem'];
					$arrlist['slxuat'] = $rsxuat['slxuattem'];
					$arrlist['slton'] = $slton;
					$arrlist['tienton'] = round($slton * $rsdongia,3);
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idtemhop'] = $idtemhop;
			}
		}
		else{
			$arrlist['idtemhop'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}
////////////////////////////////////////XUÂN MAI KẾT THÚC THÊM THỐNG KÊ TỒN KHO CHI TIẾT KHO TEM HỘP////////////////////////////////////////
////////////////////////////////////////////XUÂN MAI THÊM THỐNG KÊ TỒN KHO CHI TIẾT KHO TEM GIẤY////////////////////////////////////////////
function insert_thongKeTonKhoChiTietTemGiay($a){
	$cid = ceil(trim($a['cid']));
	$idtemgiay = ceil(trim($a['idtemgiay']));
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	return thongKeTonKhoChiTietTemGiay($cid, $idtemgiay, $fromDate, $toDate);
}

function thongKeTonKhoChiTietTemGiay($cid, $idtemgiay, $fromDate, $toDate){
	$arrlist = array();
	$whnhap = $sqlktsach = $rskttem = $sqlton = $rston = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$rsgettable = getTableRow("categories", "and id=".$cid);
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$datedfirs = explode('/',$fromDate);
			$datedauthang = $datedfirs[2].'-'.$datedfirs[1].'-01';
			$fromDate = explode("/", $fromDate);
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
		}
		if(!empty($toDate)){			
			$toDate = explode("/", $toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];		
			$whnhap.=' and dated <= "'.$toDate.'" ';
		}
		if($idtemgiay > 0){
			////////kiểm tra có trong kho hay kg để xuất ra
			$sqlktsach = "select * from $GLOBALS[db_sp].".$table." where idtemgiay = ".$idtemgiay." limit 1";
			$rskttem = $GLOBALS['sp']->getRow($sqlktsach);
			if(ceil($rskttem['id']) > 0){///////có tồn tại
				$sqldongia = "SELECT dongia FROM $GLOBALS[db_catalog].khovatdungdonghe 
								WHERE id=".$idtemgiay.
								' limit 1';
				$rsdongia = $GLOBALS['catalog']->getOne($sqldongia);

				$arrlist['dongia'] = $rsdongia;
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					
					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan."
								where idtemgiay=".$idtemgiay."
								order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					////////////////get số tồn tháng trước
					$sql_ttt = "select * from $GLOBALS[db_sp].".$tablehachtoan."
								where idtemgiay=".$idtemgiay."
								and dated < '".$datedauthang."'
								order by id desc limit 1";
					$rs_ttt = $GLOBALS['sp']->getRow($sql_ttt);
					
					$arrlist['slnhap'] = $rston['soluongnhap'];
					$arrlist['slxuat'] = $rston['soluongxuat'];
					$arrlist['slton'] = $rston['soluongton'];
					$arrlist['tienton'] = $rston['dongiaton'];
					$arrlist['sltonsddk'] = $rs_ttt['soluongton'];
				}else{// if có chọn ngày
					////////////////get số tồn tháng trước
					$sql_ttt = "select * from $GLOBALS[db_sp].".$tablehachtoan." 
								where idtemgiay=".$idtemgiay." 
								and dated < '".$datedauthang."' 
								order by id desc limit 1";
					$rs_ttt = $GLOBALS['sp']->getRow($sql_ttt);
					// get số lượng từ ngày đến đầu tháng
					$sqlnhaptndt = "select SUM(soluong) as slnhaptem from $GLOBALS[db_sp].".$table." 
									where idtemgiay=".$idtemgiay." 
									and type=1 and trangthai=2
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);
					$sqlxuattndt = "select SUM(soluong) as slxuattem from $GLOBALS[db_sp].".$table." 
									where idtemgiay=".$idtemgiay." 
									and type=2 and trangthai=2
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					";
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);
					
					$sltontndt = round(($rsnhaptndt['slnhaptem'] - $rsxuattndt['slxuattem']),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);
					$sltonsddk = round($rs_ttt['soluongton'] + $sltonsddk,3);
					// /////////////////////get số lượng nhập, xuất
					$sqlnhap = "select SUM(soluong) as slnhaptem from $GLOBALS[db_sp].".$table." 
									 where idtemgiay=".$idtemgiay."
									 and type=1 and trangthai=2
									 and dated >= '".$fromDate."'
									 and dated <= '".$toDate."'
						";
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);
					// print_r($rsnhap);die();
					$sqlxuat = "select SUM(soluong) as slxuattem from $GLOBALS[db_sp].".$table." 
					            where idtemgiay=".$idtemgiay."
								and type=2 and trangthai=2
								and dated >= '".$fromDate."'
								and dated <= '".$toDate."'
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
					// die(print_r($rsxuat));
					$sltontndn = round(($rsnhap['slnhaptem'] - $rsxuat['slxuattem']),3);
					$slton = round($sltonsddk + $sltontndn,3);
					// die(print_r($slton));
					$arrlist['slnhap'] = $rsnhap['slnhaptem'];
					$arrlist['slxuat'] = $rsxuat['slxuattem'];
					$arrlist['slton'] = $slton;
					
					$arrlist['tienton'] = round($slton * $rsdongia,3);
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idtemgiay'] = $idtemgiay;
			}
		}
		else{
			$arrlist['idtemgiay'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}
////////////////////////////////////////////XUÂN MAI KẾT THÚC THÊM THỐNG KÊ TỒN KHO CHI TIẾT KHO TEM GIẤY////////////////////////////////////////////
function insert_checkiscatcap1($a){
	$pid = $a['pid'];
	$sql = "select pid from $GLOBALS[db_sp].categories where id=".$pid;
	$rs = ceil($GLOBALS["sp"]->getOne($sql));
	if($rs == 2 || $rs == 16){ ////// là con của cấp 1 ok, và con của KHO VÀNG NGUYÊN LIỆU SẢN XUẤT
		return 1;
	}
	else{
		return 0;	
	}
}	

function insert_getTonVangTheoNgayKhoTongDeCuc($a){
	global $path_url;
	$daytons = $a['daytons'];
	$idmaphieu = $a['idmaphieu'];
	
	if(!empty($daytons)){			
		$daytons = explode('/',$daytons);
		$daytons = $daytons[2].'-'.$daytons[1].'-'.$daytons[0];

		if($idmaphieu > 0) {
			// Kiểm tra xem idmaphieu này đã có cắt xuất vàng lần nào chưa => nếu chưa thì Vàng Tồn chính là Vàng Nhập của phiếu luôn
			$sql = "select count(id) from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac where idmaphieu=".$idmaphieu;
			$rs = ceil($GLOBALS["sp"]->getOne($sql));
			
			if($rs == 0) { // Phiếu nhập này chưa xuất vàng => vàng tồn sẽ bằng vàng nhập còn lại
				$sqltonvang = "select slcannangvcon from $GLOBALS[db_sp].khokhac_khotongdecucct where id=".$idmaphieu;
				$vangton = $GLOBALS["sp"]->getOne($sqltonvang);
	
				return $vangton;
			} else { // Nếu phiếu nhập này đã xuất thì tính xem đã xuất bao nhiêu và còn tồn bao nhiêu
	
				// Tính số lượng vàng đã xuất trước ngày chọn để tìm tồn
				$sqlxuatvang = "select round(sum(tlvangcat), 3) from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac where idmaphieu=".$idmaphieu." and dated <= '".$daytons."'";
				$vangxuat = $GLOBALS["sp"]->getOne($sqlxuatvang);
	
				// Lấy ra số lượng nhập của phiếu để tính số lượng tồn
				$sqlvangnhap = "select cannangv from $GLOBALS[db_sp].khokhac_khotongdecucct where id=".$idmaphieu;
				$vangnhap = $GLOBALS["sp"]->getOne($sqlvangnhap);
	
				// Tính số lượng vàng còn tồn
				$vangton = round($vangnhap - $vangxuat,3);
	
				return $vangton;
			}
		}
	}
}

// M.Tân thêm ngày 20/04/2020 thống kê tồn kho SJC Ép Tem
function thongKeTonKhoSJCEpTem($idloaivang, $fromDate, $toDate) {
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	$datenow = date("Y-m-d");
	
	$datenowdauthang = date("Y-m-01");
	
	if(!empty($fromDate)){
		$fromDate = explode('/',$fromDate);
		$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
		
		$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
	
		$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
		$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
	}
	if(!empty($toDate)){			
		$toDate = explode('/',$toDate);
		$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		$whnhap.=' and dated <= "'.$toDate.'" ';
		$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
	}
	if($idloaivang > 0){
		////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
		$sqlktvang = "select * from $GLOBALS[db_sp].khokhac_jsceptep where idloaivang = ".$idloaivang." limit 1";
		$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
		if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
			if(empty($whnhap)){//// ngày không có chọn
				$datedauthang = date("Y").'-'.date("m").'-01';
				$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
				$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
				/////////////////////get số lượng hao dư đầu kỳ
				// $sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, 
				// 						ROUND(SUM(du), 3) as du
				// 						from $GLOBALS[db_sp].".$tablehachtoan." 
				// 						where idloaivang=".$idloaivang." 
				// 						and dated <= '".$thangtruoc."'
				// 				";
				// $rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
				$sqltonsddk = "select * from $GLOBALS[db_sp].khokhac_jsceptep_sodudauky where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
				$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
				// die($sqltonsddk);
				$sltonsddk = $rstonsddk['sltonv'];					
				// $sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
				$arrlist['sltonsddk'] = $sltonsddk;
				/////////////////////get số lượng hao dư
				// $sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
				// 					ROUND(SUM(du), 3) as du
				// 					from $GLOBALS[db_sp].".$tablehachtoan." 
				// 					where idloaivang=".$idloaivang." 
				// 					and dated <= '".$datedauthang."'
				// 			";
				// $rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
						
				////////////////get số tồn hiện tại
				$sqlton = "select * from $GLOBALS[db_sp].khokhac_jsceptep_sodudauky where idloaivang=".$idloaivang." and dated = '".$datenowdauthang."' order by id desc limit 1";
				$rston = $GLOBALS['sp']->getRow($sqlton);
				
				$slton = round(($rston['slnhapv'] -  $rston['slxuatv']),3);
				$slton = round(round($sltonsddk + $rston['slnhapv'],3) - $rston['slxuatv'],3);
				// $slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
				
				// $arrlist['slhao'] = $rshaodu['hao'];
				// $arrlist['sldu'] = $rshaodu['du'];
				
				$arrlist['slnhap'] = $rston['slnhapv'];
				$arrlist['slxuat'] = $rston['slxuatv'];
				$arrlist['slton'] = $slton;
			}
			else{/////// if có chọn ngày
			
				$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
				$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
				
				$sqltonsddk = "select * from $GLOBALS[db_sp].khokhac_jsceptep_sodudauky where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
				$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
				
				$sltonsddk = $rstonsddk['sltonv'];
				$thangdauky = $rstonsddk['dated']; 
									
				$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang 
								from $GLOBALS[db_sp].khokhac_jsceptep 
								where idloaivang=".$idloaivang." 
								and type=1 and trangthai=2
								and dated < '".$fromDate."'  
								and dated >= '".$datedauthang."' 
								"; 
				$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
				
				$sqlxuattndt = "select ROUND(sum(cannangv), 3) as slxuatvang 
										from $GLOBALS[db_sp].khokhac_jsceptep
										where idloaivang=".$idloaivang." 
										and type=2 and trangthai=2
										and datedxuat < '".$fromDate."'  
										and datedxuat >= '".$datedauthang."'
								";
				$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
				
				$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3); 
				$sltonsddk = round(($sltonsddk + $sltontndt),3);

				/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
				$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang 
									from $GLOBALS[db_sp].khokhac_jsceptep
									where idloaivang=".$idloaivang." 
									and type=1 and trangthai=2
									and dated >= '".$fromDate."'  
									and dated <= '".$toDate."' 
							"; 
				$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
				// die($sqlnhap);
				$sqlxuat = "select ROUND(sum(cannangv), 3) as slxuatvang 
									from $GLOBALS[db_sp].khokhac_jsceptep
									where idloaivang=".$idloaivang." 
									and type=2 and trangthai=2
									and datedxuat >= '".$fromDate."'  
									and datedxuat <= '".$toDate."' 
							";
				$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
				
				$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
				// $sltontndn = round(round(($sltontndn - $rsxuat['hao']),3) + $rsxuat['du'],3);
				
				$slton = $sltonsddk + $sltontndn;
									
				$arrlist['slhao'] = $rsxuat['hao'];
				$arrlist['sldu'] = $rsxuat['du'];
				
				$arrlist['slnhap'] = $rsnhap['slnhapvang'];
				$arrlist['slxuat'] = $rsxuat['slxuatvang'];
				
				$arrlist['slton'] = $slton;
				$arrlist['sltonsddk'] = $sltonsddk;
			}
			$arrlist['idloaivang'] = $idloaivang;	
			$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
			
		}
	}
	else{
		$arrlist['idloaivang'] = 0;	
	}
	
	return $arrlist;
}
function insert_thongKeTonKhoSJCEpTem($a) {
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	$idloaivang = ceil(trim($a['idloaivang']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$datenow = date("Y-m-d");
	
	$datenowdauthang = date("Y-m-01");
	
	if(!empty($fromDate)){
		$fromDate = explode('/',$fromDate);
		$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
		
		$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
	
		$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
		$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
	}
	if(!empty($toDate)){			
		$toDate = explode('/',$toDate);
		$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		$whnhap.=' and dated <= "'.$toDate.'" ';
		$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
	}
	if($idloaivang > 0){
		////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
		$sqlktvang = "select * from $GLOBALS[db_sp].khokhac_jsceptep where idloaivang = ".$idloaivang." limit 1";
		$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
		if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
			if(empty($whnhap)){//// ngày không có chọn
				$datedauthang = date("Y").'-'.date("m").'-01';
				$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
				$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
				/////////////////////get số lượng hao dư đầu kỳ
				// $sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, 
				// 						ROUND(SUM(du), 3) as du
				// 						from $GLOBALS[db_sp].".$tablehachtoan." 
				// 						where idloaivang=".$idloaivang." 
				// 						and dated <= '".$thangtruoc."'
				// 				";
				// $rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
				$sqltonsddk = "select * from $GLOBALS[db_sp].khokhac_jsceptep_sodudauky where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
				$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
				// die($sqltonsddk);
				$sltonsddk = $rstonsddk['sltonv'];					
				// $sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
				$arrlist['sltonsddk'] = $sltonsddk;
				/////////////////////get số lượng hao dư
				// $sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
				// 					ROUND(SUM(du), 3) as du
				// 					from $GLOBALS[db_sp].".$tablehachtoan." 
				// 					where idloaivang=".$idloaivang." 
				// 					and dated <= '".$datedauthang."'
				// 			";
				// $rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
						
				////////////////get số tồn hiện tại
				$sqlton = "select * from $GLOBALS[db_sp].khokhac_jsceptep_sodudauky where idloaivang=".$idloaivang." and dated = '".$datenowdauthang."' order by id desc limit 1";
				$rston = $GLOBALS['sp']->getRow($sqlton);
				
				$slton = round(($rston['slnhapv'] -  $rston['slxuatv']),3);
				$slton = round(round($sltonsddk + $rston['slnhapv'],3) - $rston['slxuatv'],3);
				// $slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
				
				// $arrlist['slhao'] = $rshaodu['hao'];
				// $arrlist['sldu'] = $rshaodu['du'];
				
				$arrlist['slnhap'] = $rston['slnhapv'];
				$arrlist['slxuat'] = $rston['slxuatv'];
				$arrlist['slton'] = $slton;
			}
			else{/////// if có chọn ngày
			
				$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
				$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
				
				$sqltonsddk = "select * from $GLOBALS[db_sp].khokhac_jsceptep_sodudauky where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
				$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
				
				$sltonsddk = $rstonsddk['sltonv'];
				$thangdauky = $rstonsddk['dated']; 
									
				$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang 
								from $GLOBALS[db_sp].khokhac_jsceptep 
								where idloaivang=".$idloaivang." 
								and type=1 and trangthai=2
								and dated < '".$fromDate."'  
								and dated >= '".$datedauthang."' 
								"; 
				$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
				
				$sqlxuattndt = "select ROUND(sum(cannangv), 3) as slxuatvang 
										from $GLOBALS[db_sp].khokhac_jsceptep
										where idloaivang=".$idloaivang." 
										and type=2 and trangthai=2
										and datedxuat < '".$fromDate."'  
										and datedxuat >= '".$datedauthang."'
								";
				$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
				
				$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3); 
				$sltonsddk = round(($sltonsddk + $sltontndt),3);

				/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
				$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang 
									from $GLOBALS[db_sp].khokhac_jsceptep
									where idloaivang=".$idloaivang." 
									and type=1 and trangthai=2
									and dated >= '".$fromDate."'  
									and dated <= '".$toDate."' 
							"; 
				$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
				// die($sqlnhap);
				$sqlxuat = "select ROUND(sum(cannangv), 3) as slxuatvang 
									from $GLOBALS[db_sp].khokhac_jsceptep
									where idloaivang=".$idloaivang." 
									and type=2 and trangthai=2
									and datedxuat >= '".$fromDate."'  
									and datedxuat <= '".$toDate."' 
							";
				$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
				
				$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
				// $sltontndn = round(round(($sltontndn - $rsxuat['hao']),3) + $rsxuat['du'],3);
				
				$slton = $sltonsddk + $sltontndn;
									
				$arrlist['slhao'] = $rsxuat['hao'];
				$arrlist['sldu'] = $rsxuat['du'];
				
				$arrlist['slnhap'] = $rsnhap['slnhapvang'];
				$arrlist['slxuat'] = $rsxuat['slxuatvang'];
				
				$arrlist['slton'] = $slton;
				$arrlist['sltonsddk'] = $sltonsddk;
			}
			$arrlist['idloaivang'] = $idloaivang;	
			$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
			
		}
	}
	else{
		$arrlist['idloaivang'] = 0;	
	}
	
	return $arrlist;
}

// M.Tân thêm ngày 21/04/2020 - Điều chỉnh số liệu hạch toán kho SJC Ép Tem
function dieuChinhSoLieuHachToanKhoSJCEpTem($table,$idloaivang) {
	
	$sql = "select * from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = $arrUpdateHD = $arrUpdateHDThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=1 and trangthai=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=2 and trangthai=2 and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Nếu trong tháng có nhập hoặc xuất idloaivang này thì mới tiến hành so sánh và xử lý
		// if($rsTongNhapTrongThang['cannangv'] != 0 || $rsTongXuatTrongThang['cannangv'] != 0) {

			// Nếu có sai số trong phần nhập kho của idloaivang đó thì bật cờ = 1
			$checkSaiSoNX = 0;

			// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
				$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
				$arrUpdateNX['slnhaph'] = $rsTongNhapTrongThang['cannangh'];
				$arrUpdateNX['slnhapvh'] = $rsTongNhapTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}

			// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
			$sqlXuatSDDKTrongThang = "select slxuatv from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
			$rsXuatSDDKTrongThang = $GLOBALS['sp']->getRow($sqlXuatSDDKTrongThang);
			// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
			if($rsTongXuatTrongThang['cannangv'] != $rsXuatSDDKTrongThang['slxuatv']){
				$arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
				$arrUpdateNX['slxuath'] = $rsTongXuatTrongThang['cannangh'];
				$arrUpdateNX['slxuatvh'] = $rsTongXuatTrongThang['cannangvh'];
				$checkSaiSoNX = 1;
			}

			// NẾU XẢY RA SAI SỐ NHẬP HOẶC XUẤT THÌ CẬP NHẬT LẠI SỐ LƯỢNG TỒN VÀ CẬP NHẬT LẠI TẤT CẢ Ở THÁNG TIẾP THEO
			if($checkSaiSoNX == 1) {

				// Lấy ngày của tháng trước có hạch toán
				$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated < '".$dateDauThang."' order by dated desc limit 1";
				$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
				
				// Lấy ra số lượng tồn của tháng trước có hạch toán
				$sqlGetSLTonThangTruoc = "select sltonv, sltonh, sltonvh from $GLOBALS[db_sp].".$table."_sodudauky where idloaivang=".$idloaivang." and dated = '".$dateDauThangTruoc."'";
				$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
				
				// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
				$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
				$sltonhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonh'] + $rsTongNhapTrongThang['cannangh']),3) - $rsTongXuatTrongThang['cannangh'],3);
				$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangvh']),3) - $rsTongXuatTrongThang['cannangvh'],3);

				$arrUpdateNX['sltonv'] = $sltonvTrongThang;
				$arrUpdateNX['sltonh'] = $sltonhTrongThang;
				$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;

				vaUpdate($table.'_sodudauky', $arrUpdateNX, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

				// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
				$dateDauThangTiep = $rs[$i-1]['dated'];

				if(!empty($dateDauThangTiep)){
					// Tính ngày cuối tháng của tháng tiếp theo
					$arrThangTiep = explode('-',$dateDauThangTiep);
					$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

					$sqlTongNhapThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type=1 and trangthai=2 and idloaivang=".$idloaivang." and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											";
					$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
					
					if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slnhaph'] = $rsTongNhapThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slnhapvh'] = $rsTongNhapThangTiep['cannangvh'];
					}

					$sqlTongXuatThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
													ROUND(SUM(cannangh), 3) as cannangh, 
													ROUND(SUM(cannangv), 3) as cannangv
													from $GLOBALS[db_sp].".$table." 
													where type=2 and trangthai=2 and idloaivang=".$idloaivang." and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											";
					$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

					if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
						$arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
						$arrUpdateNXThangTiep['slxuath'] = $rsTongXuatThangTiep['cannangh'];
						$arrUpdateNXThangTiep['slxuatvh'] = $rsTongXuatThangTiep['cannangvh']; 
					}

					// Update soluongton của tháng tiếp theo
					$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
					$arrUpdateNXThangTiep['sltonh'] = round(round(($sltonhTrongThang + $rsTongNhapThangTiep['cannangh']),3) - $rsTongXuatThangTiep['cannangh'],3);
					$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangvh']),3) - $rsTongXuatThangTiep['cannangvh'],3);

					vaUpdate($table.'_sodudauky', $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');

				}
			}
		// }
	}
}

function insert_thongKeTonKhoSanXuatKhoThanhPhamNew($a){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$datenow = date("Y-m-d");
	
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du 
								 from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du
								from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated = '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang."  and dated = '".$datedauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(round($sltonsddk + $rston['slnhapv'],3) - $rston['slxuatv'],3);
					$slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du
								from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);
					$thangdauky = $rstonsddk['dated']; 
					
					
				//die($sqlhaodutndt);
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang 
									from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and typechuyen=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang, ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du 
									from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type in(2,3)
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3) + round(($rsxuattndt['du'] - $rsxuattndt['hao']),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 					
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=1 
									 and typechuyen=2 
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang, ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du from $GLOBALS[db_sp].".$table." 
					            where idloaivang=".$idloaivang."
								and type in(2,3)
								and datedxuat >= '".$fromDate."'  
								and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3) + round(($rsxuat['du'] - $rsxuat['hao']),3);
					$slton = $sltonsddk + $sltontndn;

					$arrlist['slhao'] = $rsxuat['hao'];
					$arrlist['sldu'] = $rsxuat['du'];

					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}
function thongKeKhoSanXuatKhoThanhPhamNew($cid,$idloaivang,$fromDate,$toDate){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	$datenow = date("Y-m-d");
	
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du 
								 from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du
								from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated = '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang."  and dated = '".$datedauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(round($sltonsddk + $rston['slnhapv'],3) - $rston['slxuatv'],3);
					$slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du
								from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);
					$thangdauky = $rstonsddk['dated']; 
					
					
				//die($sqlhaodutndt);
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang 
									from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and typechuyen=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang, ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du 
									from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type in(2,3)
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3) + round(($rsxuattndt['du'] - $rsxuattndt['hao']),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 					
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=1 
									 and typechuyen=2 
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang, ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du from $GLOBALS[db_sp].".$table." 
					            where idloaivang=".$idloaivang."
								and type in(2,3)
								and datedxuat >= '".$fromDate."'  
								and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3) + round(($rsxuat['du'] - $rsxuat['hao']),3);
					$slton = $sltonsddk + $sltontndn;

					$arrlist['slhao'] = $rsxuat['hao'];
					$arrlist['sldu'] = $rsxuat['du'];

					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}
// M.Tân thêm ngày 28/04/2020 load select option chọn loai vàng của Kho Vàng Cũ CN 
function loadLoaiVangKhoVangCuCN($idnhomnguyenlieuvang,$idtennguyenlieuvang,$idloaivang,$idnum){
	global $path_url;
	
	if($idnhomnguyenlieuvang > 0 && $idtennguyenlieuvang > 0) {
		// Load cột loadtheoloaivang để lấy ra text id các loaivang của tên nguyên liệu này
		$sqltextidloaivang = "SELECT loadtheoloaivang from $GLOBALS[db_sp].categories where id=".$idtennguyenlieuvang;
		$textidloaivang = $GLOBALS['sp']->getOne($sqltextidloaivang);

		// Lấy ra danh sách các loaivang thuộc textidloaivang này
		if($textidloaivang == '' || $textidloaivang == NULL) { // Load ra hết tất cả loại vàng
			$sqlloaivang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
			$rsloaivang = $GLOBALS["sp"]->getAll($sqlloaivang);

			foreach($rsloaivang as $item){
				if($idloaivang == $item['id'])
					$checked = "selected";
				else
					$checked = ""; 
				$str .= "<option ".$checked." value='".$item['id']."' > ".$item['name_vn']."  </option>";
			}

			$str = '
					<select style="width: 140px;" id="idloaivang'.$idnum.'" name="idloaivang[]" onChange="checkLoaiVangLoadTuoiVang('.$idnum.', '.$idnhomnguyenlieuvang.')" >
						<option value="">--Chọn loại vàng--</option>
						'.$str.'
					</select>
				';
		} else { // Load ra các loại vàng ứng với textidloaivang của tên nguyên liệu này
			$sqlloaivang = "select * from $GLOBALS[db_sp].loaivang where id in (".$textidloaivang.") and active=1 order by num asc, id asc";
			
			$sqlcountidloaivang = "select count(id) from $GLOBALS[db_sp].loaivang where id in (".$textidloaivang.") and active=1 order by num asc, id asc"; 
			$countidloaivang = ceil($GLOBALS['sp']->getOne($sqlcountidloaivang));
			
			if($countidloaivang > 1) { // Có nhiều hơn 1 loại vàng ứng với tên nguyên liệu này => load ra select của các loaivang này
				$rsloaivang = $GLOBALS["sp"]->getAll($sqlloaivang);
				// print_r($rsloaivang); die();

				foreach($rsloaivang as $item){
					if($idloaivang == $item['id'])
						$checked = "selected";
					else
						$checked = "";  
					$str .= "<option ".$checked." value='".$item['id']."' > ".$item['name_vn']."  </option>";
				}
	
				$str = '
						<select style="width: 140px;" id="idloaivang'.$idnum.'" name="idloaivang[]" onChange="checkLoaiVangLoadTuoiVang('.$idnum.', '.$idnhomnguyenlieuvang.')" >
							<option value="">--Chọn loại vàng--</option>
							'.$str.'
						</select>
					';
			} else { // Chỉ có 1 loại vàng ứng với tên nguyên liệu này => load ra loaivang này luôn, không load select
				$rsloaivang = $GLOBALS["sp"]->getRow($sqlloaivang);
				// print_r($rsloaivang); die();

				$str = '
						'.getName("loaivang","name_vn",$rsloaivang['id']).'
						<input type="hidden" autocomplete="off" name="idloaivang[]" id="idloaivang'.$idnum.'" class="txtdatagirld" value="'.$rsloaivang['id'].'" onChange="checkLoaiVangLoadTuoiVang('.$idnum.', '.$idnhomnguyenlieuvang.')" readonly="readonly" />
					';
			}
		}
	}
	return $str;
}

// M.Tân thêm ngày 05/05/2020 insert load select option chọn loai vàng của Kho Vàng Cũ CN 
function insert_loadLoaiVangKhoVangCuCN($a){
	global $path_url;
	$idnhomnguyenlieuvang = $a['idnhomnguyenlieuvang'];
	$idtennguyenlieuvang = $a['idtennguyenlieuvang'];
	$idloaivang = $a['idloaivang'];
	$idnum = $a['idnum'];

	if($idnhomnguyenlieuvang > 0 && $idtennguyenlieuvang > 0) {
		// Load cột loadtheoloaivang để lấy ra text id các loaivang của tên nguyên liệu này
		$sqltextidloaivang = "SELECT loadtheoloaivang from $GLOBALS[db_sp].categories where id=".$idtennguyenlieuvang;
		$textidloaivang = $GLOBALS['sp']->getOne($sqltextidloaivang);

		// Lấy ra danh sách các loaivang thuộc textidloaivang này
		if($textidloaivang == '' || $textidloaivang == NULL) { // Load ra hết tất cả loại vàng
			$sqlloaivang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
			$rsloaivang = $GLOBALS["sp"]->getAll($sqlloaivang);

			foreach($rsloaivang as $item){
				if($idloaivang == $item['id'])
					$checked = "selected";
				else
					$checked = ""; 
				$str .= "<option ".$checked." value='".$item['id']."' > ".$item['name_vn']."  </option>";
			}

			$str = '
					<select style="width: 140px;" id="idloaivang'.$idnum.'" name="idloaivang[]" onChange="checkLoaiVangLoadTuoiVang('.$idnum.', '.$idnhomnguyenlieuvang.')" >
						<option value="">--Chọn loại vàng--</option>
						'.$str.'
					</select>
				';
		} else { // Load ra các loại vàng ứng với textidloaivang của tên nguyên liệu này
			$sqlloaivang = "select * from $GLOBALS[db_sp].loaivang where id in (".$textidloaivang.") and active=1 order by num asc, id asc";
			
			$sqlcountidloaivang = "select count(id) from $GLOBALS[db_sp].loaivang where id in (".$textidloaivang.") and active=1 order by num asc, id asc"; 
			$countidloaivang = ceil($GLOBALS['sp']->getOne($sqlcountidloaivang));
			
			if($countidloaivang > 1) { // Có nhiều hơn 1 loại vàng ứng với tên nguyên liệu này => load ra select của các loaivang này
				$rsloaivang = $GLOBALS["sp"]->getAll($sqlloaivang);
				// print_r($rsloaivang); die();

				foreach($rsloaivang as $item){
					if($idloaivang == $item['id'])
						$checked = "selected";
					else
						$checked = "";  
					$str .= "<option ".$checked." value='".$item['id']."' > ".$item['name_vn']."  </option>";
				}
	
				$str = '
						<select style="width: 140px;" id="idloaivang'.$idnum.'" name="idloaivang[]" onChange="checkLoaiVangLoadTuoiVang('.$idnum.', '.$idnhomnguyenlieuvang.')" >
							<option value="">--Chọn loại vàng--</option>
							'.$str.'
						</select>
					';
			} else { // Chỉ có 1 loại vàng ứng với tên nguyên liệu này => load ra loaivang này luôn, không load select
				$rsloaivang = $GLOBALS["sp"]->getRow($sqlloaivang);
				// print_r($rsloaivang); die();

				$str = '
						'.getName("loaivang","name_vn",$rsloaivang['id']).'
						<input type="hidden" autocomplete="off" name="idloaivang[]" id="idloaivang'.$idnum.'" class="txtdatagirld" value="'.$rsloaivang['id'].'" onChange="checkLoaiVangLoadTuoiVang('.$idnum.', '.$idnhomnguyenlieuvang.')" readonly="readonly" />
					';
			}
		}
	}
	return $str;
}

// M.Tân thêm load select option danh mục tuổi vàng của vàng khác hiệu
function insert_loadSelectTuoiVangKhacHieu($a) {
	$idloaivang = $a['idloaivang'];
	$idnum = $a['idnum'];
	$tuoivang = $a['tuoivang'];
	
	// Get danh mục tuổi vàng của loại vàng khác hiệu
	$sqldmtuoivangkhachieu = "SELECT * from $GLOBALS[db_sp].loaivangkhachieu where active=1 and idvangkhachieu=".$idloaivang;
	$rsdmtuoivangkhachieu = $GLOBALS['sp']->getAll($sqldmtuoivangkhachieu);

	foreach($rsdmtuoivangkhachieu as $itemtuoivangkhachieu){
		if($tuoivang == $itemtuoivangkhachieu['tuoiquydinh'])
			$checked = "selected";
		else
			$checked = "";
		$html .= "
					<option ".$checked." value='".$itemtuoivangkhachieu['id']."'>
						(".number_format($itemtuoivangkhachieu['tuoiquydinh'],4,".",",").") ".$itemtuoivangkhachieu['loai']."
					</option>
				";		
	}

	$str = '
		<select dir="rtl" style="width: 140px;" name="idtuoivangkhachieu[]" id="idtuoivangkhachieu'.$idnum.'" onchange="insertValueTuoiVangKhacHieu('.$idnum.')">
				<option value="0">--Chọn loại--</option>
				'.$html.'
		</select> 
	';
	return $str;
}

// M.Tân thêm load select option danh mục tuổi vàng của vàng khác hiệu cho edit sau nấu - ngày 01/08/2020
function loadSelectTuoiVangLuuKhacHieuSauNauKhoVangCuCN($id, $idloaivang, $tuoivang, $disabled) {
	// Get danh mục tuổi vàng của loại vàng khác hiệu
	$sqldmtuoivangkhachieu = "SELECT * from $GLOBALS[db_sp].loaivangkhachieu where active=1 and idvangkhachieu=".$idloaivang;
	$rsdmtuoivangkhachieu = $GLOBALS['sp']->getAll($sqldmtuoivangkhachieu);

	foreach($rsdmtuoivangkhachieu as $itemtuoivangkhachieu){
		if($tuoivang == $itemtuoivangkhachieu['tuoiquydinh'])
			$checked = "selected";
		else
			$checked = "";
		$html .= "
					<option ".$checked." value='".$itemtuoivangkhachieu['id']."'>
						(".number_format($itemtuoivangkhachieu['tuoiquydinh'],4,".",",").") ".$itemtuoivangkhachieu['loai']."
					</option>
				";		
	}

	$str = '
		<select dir="rtl" style="width: 140px;" name="idtuoivangkhachieu[]" id="idtuoivangkhachieu'.$id.'" onchange="insertValueTuoiVangLuuKhacHieu('.$id.')" '.$disabled.' >
				<option value="0">--Chọn loại--</option>
				'.$html.'
		</select> 
	';
	return $str;
}

// M.Tân thêm ngày 12/04/2021 - load select option danh mục tuổi vàng của vàng khác hiệu cho template
function insert_loadSelectTuoiVangLuuKhacHieuSauNauKhoVangCuCN($a) {
	$id = ceil(trim($a['id']));
	$idloaivang = $a['idloaivang'];
	$tuoivang = $a['tuoivang'];
	$disabled = $a['disabled'];

	// Get danh mục tuổi vàng của loại vàng khác hiệu
	$sqldmtuoivangkhachieu = "SELECT * from $GLOBALS[db_sp].loaivangkhachieu where active=1 and idvangkhachieu=".$idloaivang;
	$rsdmtuoivangkhachieu = $GLOBALS['sp']->getAll($sqldmtuoivangkhachieu);

	foreach($rsdmtuoivangkhachieu as $itemtuoivangkhachieu){
		if($tuoivang == $itemtuoivangkhachieu['tuoiquydinh'])
			$checked = "selected";
		else
			$checked = "";
		$html .= "
					<option ".$checked." value='".$itemtuoivangkhachieu['id']."'>
						(".number_format($itemtuoivangkhachieu['tuoiquydinh'],4,".",",").") ".$itemtuoivangkhachieu['loai']."
					</option>
				";		
	}

	$str = '
		<select dir="rtl" style="width: 140px;" name="idtuoivangkhachieu[]" id="idtuoivangkhachieu'.$id.'" onchange="insertValueTuoiVangLuuKhacHieu('.$id.')" '.$disabled.' >
				<option value="0">--Chọn loại--</option>
				'.$html.'
		</select> 
	';
	return $str;
}

// M.Tân thêm load select option danh mục tuổi vàng của vàng khác hiệu cho edit sau nấu
function insert_loadSelectTuoiVangKhacHieuSauNau($a) {
	$idloaivang = $a['idloaivang'];
	$tuoivang = $a['tuoivang'];
	$disabled = $a['disabled'];
	$isTuoiVangLuu = $a['isTuoiVangLuu']; // phải tuổi vàng lưu: =1, không phải: =0
	// Get danh mục tuổi vàng của loại vàng khác hiệu
	$sqldmtuoivangkhachieu = "SELECT * from $GLOBALS[db_sp].loaivangkhachieu where active=1 and idvangkhachieu=".$idloaivang;
	$rsdmtuoivangkhachieu = $GLOBALS['sp']->getAll($sqldmtuoivangkhachieu);

	foreach($rsdmtuoivangkhachieu as $itemtuoivangkhachieu){
		if($tuoivang == $itemtuoivangkhachieu['tuoiquydinh'])
			$checked = "selected";
		else
			$checked = "";
		$html .= "
					<option ".$checked." value='".$itemtuoivangkhachieu['id']."'>
						(".number_format($itemtuoivangkhachieu['tuoiquydinh'],4,".",",").") ".$itemtuoivangkhachieu['loai']."
					</option>
				";		
	}

	$str = '
		<select dir="rtl" style="width: 140px;" name="idtuoivangkhachieu[]" id="idtuoivangkhachieu'.$isTuoiVangLuu.'" onchange="insertValueTuoiVangKhacHieu('.$isTuoiVangLuu.')" '.$disabled.' >
				<option value="0">--Chọn loại--</option>
				'.$html.'
		</select> 
	';
	return $str;
}

// M.Tân thêm ngày 18/05/2020 - function hạch toán cho kho Vàng Cũ Chi Nhánh
function ghiSoHachToanKhoVangCuChiNhanh($tablehachtoan, $tablenhan, $id, $typehachtoan){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	//$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table nxct vd: khonguonvao_khoachinct
	//print_r($item); die($tablenhan);
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day = array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	
	if($typehachtoan =='nhapkho'){//xác nhận hạch toán table mới luôn là nhập kho
		$item['type'] = 1;
	}
	if($typehachtoan =='xuatkho'){//xác nhận hạch toán table mới luôn là xuất kho
		$item['type'] = 2;
	}
	
	if($item['type']==1){//số lượng nhập
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
		
		$dongianhaprc = $item['dongiavon'];;
		$slnhapkimcuongrc = 1;	
	}
	else{ // số lượng xuất
		$slxuatvhrc = $item['cannangvh'];
		$slxuatvrc = $item['cannangv'];
		$slxuathrc = $item['cannangh'];
		
		$haorc = $item['haochuyen'];
		$durc = $item['duchuyen'];		
		
		$dongiaxuatrc = $item['dongiavon'];
		$slxuatkimcuongrc = 1;
	}
	//die(' slxuatvh: '.$slxuatvhrc . ' slxuatvrc: '. $slxuatvrc . ' slxuathrc: '. $slxuathrc);
	if($item['typevkc']==1){/// là vàng
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];	
	}
	else{
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and typevkc=".$item['typevkc'];	
	}
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){// chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				//////////////////nhập vàng + hột
				$sltonvh = $rstru1day['sltonvh'];
				//////////////////nhập vàng
				$sltonv = $rstru1day['sltonv'];
				//////////////////nhập hot
				$sltonh = $rstru1day['sltonh'];
				
			}
			//////////////////nhập vàng + hột
			$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3) ;
			$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
			$arrnx1day['slxuatvh'] = $slxuatvhrc;
			$arrnx1day['slxuatv'] = $slxuatvrc;
			$arrnx1day['slxuath'] = $slxuathrc;
			
			$arrnx1day['hao'] = $haorc;
			$arrnx1day['du'] = $durc;
			
			$arrnx1day['idloaivang'] = $item['idloaivang']; // chỉ có nhập mới inser loại vàng, xuất không cần

		}
		else{ // là kim cương
			//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
			
			if($rstru1day['id'] > 0){
				$sltonkimcuong = $rstru1day['sltonkimcuong'];
				$tongdongia = $rstru1day['tongdongia'];
			}	
			$sltonkimcuong = round(round(($sltonkimcuong + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3);
			$tongdongia = round(round(($tongdongia + $dongianhaprc),3) - $dongiaxuatrc,3);
			
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuongrc;
			$arrnx1day['slxuatkimcuong'] = $slxuatkimcuongrc;
			
			$arrnx1day['dongianhap'] = $dongianhaprc;
			$arrnx1day['dongiaxuat'] = $dongiaxuatrc;
			$arrnx1day['tongdongia'] = $tongdongia;
		}
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
			$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			
			$hao = round(($rsdate['hao'] + $haorc),3);
			$du = round(($rsdate['du'] + $durc),3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
			$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3) ;
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
		
			$arrnx1day['hao'] = $hao;
			$arrnx1day['du'] = $du;
		}
		else{// là kim cương
			$slnhapkimcuong = round(($rsdate['slnhapkimcuong'] + $slnhapkimcuongrc),3);
			$slxuatkimcuong = round(($rsdate['slxuatkimcuong'] + $slxuatkimcuongrc),3) ;
			$sltonkimcuong = round(round(($rsdate['sltonkimcuong'] + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3) ;
			
			$dongianhap = round(($rsdate['dongianhap'] + $dongianhaprc),3);
			$dongiaxuat = round(($rsdate['dongiaxuat'] + $dongiaxuatrc),3);
			$tongdongia = round(round(($rsdate['tongdongia'] + $dongianhaprc),3) - $dongiaxuatrc,3) ;
			
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuong;
			$arrnx1day['slxuatkimcuong'] = $slxuatkimcuong;
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			
			$arrnx1day['dongianhap'] = $dongianhap;
			$arrnx1day['dongiaxuat'] = $dongiaxuat;
			$arrnx1day['tongdongia'] = $tongdongia;
		}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}
//Vũ thêm 08/06/2020
function compressImage($source, $destination, $quality) { 
	// Get image info 
	$imgInfo = getimagesize($source); 
	$mime = $imgInfo['mime']; 
	 
	// Create a new image from file 
	switch($mime){ 
		case 'image/jpeg': 
			$image = imagecreatefromjpeg($source); 
		break; 
		case 'image/png': 
			$image = $new_pic = imagecreatefrompng($source); 
			 $w = imagesx($new_pic);
			 $h = imagesy($new_pic);
			 $white = imagecreatetruecolor($w, $h);
			 $bg = imagecolorallocate($white, 255, 255, 255);
			 imagefill($white, 0, 0, $bg);
			 imagecopy($white, $new_pic, 0, 0, 0, 0, $w, $h);
			 $image = $white;
		break; 
		case 'image/gif': 
			$image = imagecreatefromgif($source); 
		break; 
		default: 
			$image = imagecreatefromjpeg($source); 
	} 
	imagejpeg($image, $destination, $quality); 
	return $destination; 
}
// M.Tân thêm ngày 04/06/2020 - Thống kê tồn kho vàng Kho Vàng Cũ CN 
function insert_thongKeTonKhoKhoKhacKhoVangCuCN($a){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];	
	$datenow = date("Y-m-d");	

	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablect = $rsgettable['tablect'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$tablect." where type=1 and trangthai=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng đầu kỳ					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);					
					$sltonsddk = $rstonsddk['sltonv'];
					$arrlist['sltonsddk'] = $sltonsddk;
					
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, 
										ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech 
										from $GLOBALS[db_sp].".$tablehachtoan." 
										where idloaivang=".$idloaivang." 
										and dated <= '".$datedauthang."'";
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = $rston['sltonv'];					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày					
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);			
					//					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = $rstonsddk['sltonv'] ;
					$thangdauky = $rstonsddk['dated']; 					
					// Get số lượng từ ngày đến đầu tháng
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang 
									from $GLOBALS[db_sp].".$tablect." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and trangthai=2 
									and nhomnguyenlieuvang not in (2010,2013,2618,2851) 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang 
									from $GLOBALS[db_sp].".$tablect." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and trangthaixuat=2 
									and nhomnguyenlieuvang not in (2010,2013,2618,2851) 
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3);
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					// Get số lượng từ ngày đến ngày
					// Hao dư từ ngày đến ngày của phiếu xuất lớn
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du 
										from $GLOBALS[db_sp].".$table." 
										where idloaivang=".$idloaivang."
										and type=2 and trangthai=2 and typevkc=1
										and datedxuat >= '".$fromDate."'  
										and datedxuat <= '".$toDate."' ";
					$rshaodu =  $GLOBALS["sp"]->getRow($sqlhaodu);
					
					$sqlnhap = "select  ROUND(SUM(cannangv), 3) as slnhapvang 
										from $GLOBALS[db_sp].".$tablect." 
										where idloaivang=".$idloaivang." 
										and type=1 
										and trangthai=2 
										and nhomnguyenlieuvang not in (2010,2013,2618,2851) 
										and dated >= '".$fromDate."'  
										and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select  ROUND(SUM(cannangv), 3) as slxuatvang 
										from $GLOBALS[db_sp].".$tablect." 
										where idloaivang=".$idloaivang."
										and type=1 
										and trangthaixuat=2
										and nhomnguyenlieuvang not in (2010,2013,2618,2851) 
										and datedxuat >= '".$fromDate."'  
										and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
					
					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					$slton = $sltonsddk + $sltontndn;					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];		
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

// M.Tân thêm ngày 09/06/2020 - Thống kê tồn kho vàng Kho Vàng Cũ CN 
function thongKeTonKhoKhoKhacKhoVangCuCN($cid, $idloaivang, $fromDate, $toDate){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$datenow = date("Y-m-d");	

	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablect = $rsgettable['tablect'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$tablect." where type=1 and trangthai=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng đầu kỳ					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);					
					$sltonsddk = $rstonsddk['sltonv'];
					$arrlist['sltonsddk'] = $sltonsddk;
					
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, 
										ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech 
										from $GLOBALS[db_sp].".$tablehachtoan." 
										where idloaivang=".$idloaivang." 
										and dated <= '".$datedauthang."'";
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = $rston['sltonv'];					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày					
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);			
					//					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = $rstonsddk['sltonv'] ;
					$thangdauky = $rstonsddk['dated']; 					
					// Get số lượng từ ngày đến đầu tháng
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang 
									from $GLOBALS[db_sp].".$tablect." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and trangthai=2 
									and nhomnguyenlieuvang not in (2010,2013,2618,2851) 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang 
									from $GLOBALS[db_sp].".$tablect." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and trangthaixuat=2 
									and nhomnguyenlieuvang not in (2010,2013,2618,2851) 
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3);
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					// Get số lượng từ ngày đến ngày
					// Hao dư từ ngày đến ngày của phiếu xuất lớn
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du 
										from $GLOBALS[db_sp].".$table." 
										where idloaivang=".$idloaivang."
										and type=2 and trangthai=2 and typevkc=1
										and datedxuat >= '".$fromDate."'  
										and datedxuat <= '".$toDate."' ";
					$rshaodu =  $GLOBALS["sp"]->getRow($sqlhaodu);
					
					$sqlnhap = "select  ROUND(SUM(cannangv), 3) as slnhapvang 
										from $GLOBALS[db_sp].".$tablect." 
										where idloaivang=".$idloaivang." 
										and type=1 
										and trangthai=2 
										and nhomnguyenlieuvang not in (2010,2013,2618,2851) 
										and dated >= '".$fromDate."'  
										and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select  ROUND(SUM(cannangv), 3) as slxuatvang 
										from $GLOBALS[db_sp].".$tablect." 
										where idloaivang=".$idloaivang."
										and type=1 
										and trangthaixuat=2 
										and nhomnguyenlieuvang not in (2010,2013,2618,2851) 
										and datedxuat >= '".$fromDate."'  
										and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
					
					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					$slton = $sltonsddk + $sltontndn;					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];		
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

// M.Tân thêm ngày 12/06/2020 - Điều chỉnh số liệu hạch toán vàng table vangcucn_khovangcucn_sodudauky có tính vô tổng tài sản (trừ nhóm nguyên liệu Vàng %) Kho Vàng Cũ Chi Nhánh
function dieuChinhSoLieuHachToanKhoVangCuCN($table,$tablehachtoan,$idloaivang) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and typevkc=1 ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = $arrUpdateHD = $arrUpdateHDThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP (TRỪ NHÓM NGUYÊN LIỆU VÀNG %) ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=1 and trangthai=2 and idloaivang=".$idloaivang." 
										and nhomnguyenlieuvang not in (2010, 2013, 2618, 2851)
										and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."' 
										and typevkc = 1 
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT (TRỪ NHÓM NGUYÊN LIỆU VÀNG %) ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=1 and trangthai=2 and trangthaixuat=2 and idloaivang=".$idloaivang." 
										and nhomnguyenlieuvang not in (2010, 2013, 2618, 2851)
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
										and typevkc = 1
								"; 
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// TÍNH TỔNG HAO DƯ DỰA TRÊN CÁC PHIẾU XUẤT LỚN ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongHaoDuTrongThang = "select ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du
										from $GLOBALS[db_sp].vangcucn_khovangcucn
										where type=2 and trangthai=2 and idloaivang=".$idloaivang." 
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								"; 
		$rsTongHaoDuTrongThang = $GLOBALS['sp']->getRow($sqlTongHaoDuTrongThang);

		// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
		$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
		$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
			$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
			$arrUpdateNX['slnhaph'] = $rsTongNhapTrongThang['cannangh'];
			$arrUpdateNX['slnhapvh'] = $rsTongNhapTrongThang['cannangvh'];
		}

		// Lấy ra tổng số lượng xuất, hao, dư trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
		$sqlXuatSDDKTrongThang = "select slxuatv, hao, du from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
		$rsXuatSDDKTrongThang = $GLOBALS['sp']->getRow($sqlXuatSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongXuatTrongThang['cannangv'] != $rsXuatSDDKTrongThang['slxuatv']){
			$arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
			$arrUpdateNX['slxuath'] = $rsTongXuatTrongThang['cannangh'];
			$arrUpdateNX['slxuatvh'] = $rsTongXuatTrongThang['cannangvh'];
		}

		// So sánh số lượng hao, dư trong sodudauky với tổng số lượng hao,dư của các phiếu xuất lớn cộng lại
		if($rsTongHaoDuTrongThang['hao'] != $rsXuatSDDKTrongThang['hao'] || $rsTongHaoDuTrongThang['du'] != $rsXuatSDDKTrongThang['du']) {
			$arrUpdateHD['hao'] = $rsTongHaoDuTrongThang['hao'];
			$arrUpdateHD['du'] = $rsTongHaoDuTrongThang['du'];

			vaUpdate($tablehachtoan, $arrUpdateHD, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');
		}

		// Lấy ngày của tháng trước có hạch toán
		$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated < '".$dateDauThang."' order by dated desc limit 1";
		$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
		
		// Lấy ra số lượng tồn của tháng trước có hạch toán
		$sqlGetSLTonThangTruoc = "select sltonv, sltonh, sltonvh from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTruoc."'";
		$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
		
		// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
		$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
		$sltonhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonh'] + $rsTongNhapTrongThang['cannangh']),3) - $rsTongXuatTrongThang['cannangh'],3);
		$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangvh']),3) - $rsTongXuatTrongThang['cannangvh'],3);

		$arrUpdateNX['sltonv'] = $sltonvTrongThang;
		$arrUpdateNX['sltonh'] = $sltonhTrongThang;
		$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;
		
		vaUpdate($tablehachtoan, $arrUpdateNX, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlTongNhapThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
											ROUND(SUM(cannangh), 3) as cannangh, 
											ROUND(SUM(cannangv), 3) as cannangv
											from $GLOBALS[db_sp].".$table." 
											where type=1 and trangthai=2 and idloaivang=".$idloaivang." 
											and nhomnguyenlieuvang not in (2010, 2013, 2618, 2851)
											and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											and typevkc = 1
									";
			$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
			
			if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
				$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
				$arrUpdateNXThangTiep['slnhaph'] = $rsTongNhapThangTiep['cannangh'];
				$arrUpdateNXThangTiep['slnhapvh'] = $rsTongNhapThangTiep['cannangvh'];
			}

			$sqlTongXuatThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
											ROUND(SUM(cannangh), 3) as cannangh, 
											ROUND(SUM(cannangv), 3) as cannangv
											from $GLOBALS[db_sp].".$table." 
											where type=1 and trangthai=2 and trangthaixuat=2 and idloaivang=".$idloaivang." 
											and nhomnguyenlieuvang not in (2010, 2013, 2618, 2851)
											and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											and typevkc = 1
									";
			$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

			if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
				$arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
				$arrUpdateNXThangTiep['slxuath'] = $rsTongXuatThangTiep['cannangh'];
				$arrUpdateNXThangTiep['slxuatvh'] = $rsTongXuatThangTiep['cannangvh'];
			}

			// Update soluongton của tháng tiếp theo
			$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
			$arrUpdateNXThangTiep['sltonh'] = round(round(($sltonhTrongThang + $rsTongNhapThangTiep['cannangh']),3) - $rsTongXuatThangTiep['cannangh'],3);
			$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangvh']),3) - $rsTongXuatThangTiep['cannangvh'],3);
			
			vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');

		}

		// Kiểm tra hao dư của tháng tiếp theo xem có sai không
		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlHaoDuThangTiep = "select ROUND(SUM(hao), 3) as hao,
										ROUND(SUM(du), 3) as du 
										from $GLOBALS[db_sp].vangcucn_khovangcucn 
										where type=2 and trangthai=2 and idloaivang=".$idloaivang." 
										and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."' 
								";
			$rsHaoDuThangTiep = $GLOBALS['sp']->getRow($sqlHaoDuThangTiep);

			// Lấy ra hao, dư trong bảng sodudauky để so sánh
			$sqlHaoDuSDDKThangTiep= "select hao, du from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTiep."'";
			$rsHaoDuSDDKThangTiep = $GLOBALS['sp']->getRow($sqlHaoDuSDDKThangTiep);

			if($rsHaoDuSDDKThangTiep['hao'] != $rsHaoDuThangTiep['hao'] || $rsHaoDuSDDKThangTiep['du'] != $rsHaoDuThangTiep['du']) {
				$arrUpdateHDThangTiep['hao'] = $rsHaoDuThangTiep['hao'];
				$arrUpdateHDThangTiep['du'] = $rsHaoDuThangTiep['du'];

				vaUpdate($tablehachtoan, $arrUpdateHDThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');
			}
		}
	}
}

// M.Tân thêm ngày 06/11/2020 - Điều chính số liệu hạch toán vàng table vangcucn_khovangcucn_sodudauky_hangphantram KHÔNG tính vô tổng tài sản (chỉ tính phiếu có nhóm nguyên liệu Vàng %) Kho Vàng Cũ Chi Nhánh
function dieuChinhSoLieuHachToanVangPhanTramKhoVangCuCN($table,$tablehachtoan,$idloaivang) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and typevkc=1 ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP (VỚI NHÓM NGUYÊN LIỆU VÀNG %) ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=1 and trangthai=2 and idloaivang=".$idloaivang." 
										and nhomnguyenlieuvang in (2010, 2013, 2618, 2851)
										and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."' 
										and typevkc = 1 
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT (VỚI NHÓM NGUYÊN LIỆU VÀNG %) ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv
										from $GLOBALS[db_sp].".$table." 
										where type=1 and trangthai=2 and trangthaixuat=2 and idloaivang=".$idloaivang." 
										and nhomnguyenlieuvang in (2010, 2013, 2618, 2851)
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
										and typevkc = 1
								"; 
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
		$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
		$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
			$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
			$arrUpdateNX['slnhaph'] = $rsTongNhapTrongThang['cannangh'];
			$arrUpdateNX['slnhapvh'] = $rsTongNhapTrongThang['cannangvh'];
		}

		// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
		$sqlXuatSDDKTrongThang = "select slxuatv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
		$rsXuatSDDKTrongThang = $GLOBALS['sp']->getRow($sqlXuatSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongXuatTrongThang['cannangv'] != $rsXuatSDDKTrongThang['slxuatv']){
			$arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
			$arrUpdateNX['slxuath'] = $rsTongXuatTrongThang['cannangh'];
			$arrUpdateNX['slxuatvh'] = $rsTongXuatTrongThang['cannangvh'];
		}

		// Lấy ngày của tháng trước có hạch toán
		$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated < '".$dateDauThang."' order by dated desc limit 1";
		$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
		
		// Lấy ra số lượng tồn của tháng trước có hạch toán
		$sqlGetSLTonThangTruoc = "select sltonv, sltonh, sltonvh from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTruoc."'";
		$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
		
		// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
		$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
		$sltonhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonh'] + $rsTongNhapTrongThang['cannangh']),3) - $rsTongXuatTrongThang['cannangh'],3);
		$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangvh']),3) - $rsTongXuatTrongThang['cannangvh'],3);

		$arrUpdateNX['sltonv'] = $sltonvTrongThang;
		$arrUpdateNX['sltonh'] = $sltonhTrongThang;
		$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;

		vaUpdate($tablehachtoan, $arrUpdateNX, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlTongNhapThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
											ROUND(SUM(cannangh), 3) as cannangh, 
											ROUND(SUM(cannangv), 3) as cannangv
											from $GLOBALS[db_sp].".$table." 
											where type=1 and trangthai=2 and idloaivang=".$idloaivang." 
											and nhomnguyenlieuvang in (2010, 2013, 2618, 2851)
											and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
											and typevkc = 1
									";
			$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
			
			if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
				$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
				$arrUpdateNXThangTiep['slnhaph'] = $rsTongNhapThangTiep['cannangh'];
				$arrUpdateNXThangTiep['slnhapvh'] = $rsTongNhapThangTiep['cannangvh'];
			}

			$sqlTongXuatThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
											ROUND(SUM(cannangh), 3) as cannangh, 
											ROUND(SUM(cannangv), 3) as cannangv
											from $GLOBALS[db_sp].".$table." 
											where type=1 and trangthai=2 and trangthaixuat=2 and idloaivang=".$idloaivang." 
											and nhomnguyenlieuvang in (2010, 2013, 2618, 2851)
											and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
											and typevkc = 1
									";
			$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

			if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
				$arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
				$arrUpdateNXThangTiep['slxuath'] = $rsTongXuatThangTiep['cannangh'];
				$arrUpdateNXThangTiep['slxuatvh'] = $rsTongXuatThangTiep['cannangvh'];
			}

			// Update soluongton của tháng tiếp theo
			$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
			$arrUpdateNXThangTiep['sltonh'] = round(round(($sltonhTrongThang + $rsTongNhapThangTiep['cannangh']),3) - $rsTongXuatThangTiep['cannangh'],3);
			$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangvh']),3) - $rsTongXuatThangTiep['cannangvh'],3);

			vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');
		}
	}
}

// M.Tân thêm ngày 15/06/2020 - Điều chỉnh số liệu hạch toán kim cương của Kho Vàng Cũ Chi Nhánh
function dieuChinhSoLieuHachToanKimCuongKhoVangCuCN($table, $tablehachtoan) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);
	
	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP, TỔNG ĐƠN GIÁ NHẬP KIM CƯƠNG DỰA TRÊN CÁC PHIẾU NHẬP
		$sqlTongNhapTrongThang = "select COUNT(id) as slnhapkimcuong, 
										ROUND(SUM(dongiavon), 3) as dongianhap
										from $GLOBALS[db_sp].".$table." 
										where type=1 and trangthai=2 and typevkc = 2 
										and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT, TỔNG ĐƠN GIÁ XUẤT KIM CƯƠNG DỰA TRÊN CÁC PHIẾU XUẤT
		$sqlTongXuatTrongThang = "select COUNT(id) as slxuatkimcuong, 
										ROUND(SUM(dongiavon), 3) as dongiaxuat
										from $GLOBALS[db_sp].".$table." 
										where type=2 and trangthai=2 and typevkc = 2
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Lấy ra tổng số lượng nhập, đơn giá nhập trong bảng sodudauky (tháng đó) để so sánh
		$sqlNhapSDDKTrongThang = "select slnhapkimcuong, dongianhap from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThang."'";
		$rsNhapSDDKTrongThang = $GLOBALS['sp']->getRow($sqlNhapSDDKTrongThang);
		// So sánh số lượng nhập kim cương trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongNhapTrongThang['slnhapkimcuong'] != $rsNhapSDDKTrongThang['slnhapkimcuong'] || $rsTongNhapTrongThang['dongianhap'] != $rsNhapSDDKTrongThang['dongianhap']){
			$arrUpdateNX['slnhapkimcuong'] = $rsTongNhapTrongThang['slnhapkimcuong'];
			$arrUpdateNX['dongianhap'] = $rsTongNhapTrongThang['dongianhap'];
		}

		// Lấy ra tổng số lượng xuất, đơn giá xuất trong bảng sodudauky (tháng đó) để so sánh
		$sqlXuatSDDKTrongThang = "select slxuatkimcuong, dongiaxuat from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThang."'";
		$rsXuatSDDKTrongThang = $GLOBALS['sp']->getRow($sqlXuatSDDKTrongThang);
		// So sánh số lượng xuất kim cương trong sodudauky với tổng số lượng xuất của các phiếu cộng lại
		if($rsTongXuatTrongThang['slxuatkimcuong'] != $rsXuatSDDKTrongThang['slxuatkimcuong'] || $rsTongXuatTrongThang['dongiaxuat'] != $rsXuatSDDKTrongThang['dongiaxuat']){
			$arrUpdateNX['slxuatkimcuong'] = $rsTongXuatTrongThang['slxuatkimcuong'];
			$arrUpdateNX['dongiaxuat'] = $rsTongXuatTrongThang['dongiaxuat'];
		}	

		// Lấy ngày của tháng trước có hạch toán
		$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated < '".$dateDauThang."' order by dated desc limit 1";
		$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
		
		// Lấy ra số lượng tồn của tháng trước có hạch toán
		$sqlGetSLTonThangTruoc = "select sltonkimcuong, tongdongia from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=2 and dated = '".$dateDauThangTruoc."'";
		$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
		
		// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
		$sltonkcTrongThang = round(round(($rsGetSLTonThangTruoc['sltonkimcuong'] + $rsTongNhapTrongThang['slnhapkimcuong']),3) - $rsTongXuatTrongThang['slxuatkimcuong'],3);
		$tongdongiaTrongThang = round(round(($rsGetSLTonThangTruoc['tongdongia'] + $rsTongNhapTrongThang['dongianhap']),3) - $rsTongXuatTrongThang['dongiaxuat'],3);

		$arrUpdateNX['sltonkimcuong'] = $sltonkcTrongThang;
		$arrUpdateNX['tongdongia'] = $tongdongiaTrongThang;

		vaUpdate($tablehachtoan, $arrUpdateNX, ' typevkc=2 and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];
		
		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlTongNhapThangTiep = "select COUNT(id) as slnhapkimcuong, 
											ROUND(SUM(dongiavon), 3) as dongianhap
											from $GLOBALS[db_sp].".$table."
											where type=1 and trangthai=2 and typevkc = 2
											and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
									";
			$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
			
			if($rsTongNhapThangTiep['slnhapkimcuong'] != 0) { // != 0 là tháng tiếp theo có nhập
				$arrUpdateNXThangTiep['slnhapkimcuong'] = $rsTongNhapThangTiep['slnhapkimcuong'];
				$arrUpdateNXThangTiep['dongianhap'] = $rsTongNhapThangTiep['dongianhap'];
			}
			
			$sqlTongXuatThangTiep = "select COUNT(id) as slxuatkimcuong, 
											ROUND(SUM(dongiavon), 3) as dongiaxuat
											from $GLOBALS[db_sp].".$table." 
											where type=2 and trangthai=2 and typevkc = 2
											and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
									";
			$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);
			
			if($rsTongXuatThangTiep['slxuatkimcuong'] != 0) { // != 0 là tháng tiếp theo có xuất
				$arrUpdateNXThangTiep['slxuatkimcuong'] = $rsTongXuatThangTiep['slxuatkimcuong'];
				$arrUpdateNXThangTiep['dongiaxuat'] = $rsTongXuatThangTiep['dongiaxuat'];
			}

			// Update soluongton của tháng tiếp theo
			$arrUpdateNXThangTiep['sltonkimcuong'] = round(round(($sltonkcTrongThang + $rsTongNhapThangTiep['slnhapkimcuong']),3) - $rsTongXuatThangTiep['slxuatkimcuong'],3);
			$arrUpdateNXThangTiep['tongdongia'] = round(round(($tongdongiaTrongThang + $rsTongNhapThangTiep['dongianhap']),3) - $rsTongXuatThangTiep['dongiaxuat'],3);

			vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' typevkc=2 and dated="'.$dateDauThangTiep.'"');
		}
	}
}

// M.Tân thêm ngày 06/11/2020 - Điều chính số liệu hạch toán kim cương tấm Kho Vàng Cũ Chi Nhánh
function dieuChinhSoLieuHachToanKimCuongTamKhoVangCuCN($table,$tablehachtoan,$sizehotkctam,$monthsUpdate) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where sizehotkctam='".$sizehotkctam."' ORDER BY dated DESC LIMIT ".$monthsUpdate;
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI SIZEHOTKCTAM ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select SUM(slhotkctam) as slhotkctam, 
										 ROUND(SUM(cannangctkctam), 3) as cannangctkctam
										 from $GLOBALS[db_sp].".$table." 
										 where type=1 and trangthai=2 and typera=1  
										 and sizehotkctam='".$sizehotkctam."'
										 and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI SIZEHOTKCTAM ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select SUM(slhotkctam) as slhotkctam, 
										 ROUND(SUM(cannangctkctam), 3) as cannangctkctam
										 from $GLOBALS[db_sp].".$table." 
										 where type=1 and trangthai=2 and typera=1 and trangthaixuat=2 
										 and sizehotkctam='".$sizehotkctam."'
										 and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								"; 
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với sizehotkctam (tháng đó) để so sánh
		$sqlNhapSDDKTrongThang = "select soluongnhap from $GLOBALS[db_sp].".$tablehachtoan." where sizehotkctam='".$sizehotkctam."' and dated = '".$dateDauThang."'";
		$soluongnhapSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
		// So sánh số lượng nhập trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongNhapTrongThang['slhotkctam'] != $soluongnhapSDDK){
			$arrUpdateNX['soluongnhap'] = $rsTongNhapTrongThang['slhotkctam'];
			$arrUpdateNX['cannangnhap'] = $rsTongNhapTrongThang['cannangctkctam'];
		}

		// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với sizehotkctam (tháng đó) để so sánh
		$sqlXuatSDDKTrongThang = "select soluongxuat from $GLOBALS[db_sp].".$tablehachtoan." where sizehotkctam='".$sizehotkctam."' and dated = '".$dateDauThang."'";
		$soluongxuatSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
		// So sánh số lượng xuất trong sodudauky với tổng số lượng xuất của các phiếu cộng lại
		if($rsTongXuatTrongThang['slhotkctam'] != $soluongxuatSDDK){
			$arrUpdateNX['soluongxuat'] = $rsTongXuatTrongThang['slhotkctam'];
			$arrUpdateNX['cannangxuat'] = $rsTongXuatTrongThang['cannangctkctam'];
		}

		// Lấy ngày của tháng trước có hạch toán
		$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where sizehotkctam='".$sizehotkctam."' and dated < '".$dateDauThang."' order by dated desc limit 1";
		$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
		
		// Lấy ra số lượng tồn của tháng trước có hạch toán
		$sqlGetSLTonThangTruoc = "select soluongton, cannangton from $GLOBALS[db_sp].".$tablehachtoan." where sizehotkctam='".$sizehotkctam."' and dated = '".$dateDauThangTruoc."'";
		$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
		
		// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
		$soluongtonTrongThang = round(round(($rsGetSLTonThangTruoc['soluongton'] + $rsTongNhapTrongThang['slhotkctam']),3) - $rsTongXuatTrongThang['slhotkctam'],3);
		$cannangtonTrongThang = round(round(($rsGetSLTonThangTruoc['cannangton'] + $rsTongNhapTrongThang['cannangctkctam']),3) - $rsTongXuatTrongThang['cannangctkctam'],3);

		$arrUpdateNX['soluongton'] = $soluongtonTrongThang;
		$arrUpdateNX['cannangton'] = $cannangtonTrongThang;

		vaUpdate($tablehachtoan, $arrUpdateNX, ' sizehotkctam="'.$sizehotkctam.'" and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlTongNhapThangTiep = "select SUM(slhotkctam) as slhotkctam, 
											ROUND(SUM(cannangctkctam), 3) as cannangctkctam
											from $GLOBALS[db_sp].".$table." 
											where type=1 and trangthai=2 and typera=1  
											and sizehotkctam='".$sizehotkctam."'
											and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
									";
			$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
			
			if($rsTongNhapThangTiep['slhotkctam'] != 0) { // != 0 là tháng tiếp theo có nhập
				$arrUpdateNXThangTiep['soluongnhap'] = $rsTongNhapThangTiep['slhotkctam'];
				$arrUpdateNXThangTiep['cannangnhap'] = $rsTongNhapThangTiep['cannangctkctam'];
			}

			$sqlTongXuatThangTiep = "select SUM(slhotkctam) as slhotkctam, 
											ROUND(SUM(cannangctkctam), 3) as cannangctkctam
											from $GLOBALS[db_sp].".$table." 
											where type=1 and trangthai=2 and typera=1 and trangthaixuat=2  
											and sizehotkctam='".$sizehotkctam."'
											and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
									";
			$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

			if($rsTongXuatThangTiep['slhotkctam'] != 0) { // != 0 là tháng tiếp theo có xuất
				$arrUpdateNXThangTiep['soluongxuat'] = $rsTongXuatThangTiep['slhotkctam'];
				$arrUpdateNXThangTiep['cannangxuat'] = $rsTongXuatThangTiep['cannangctkctam'];
			}

			// Update soluongton của tháng tiếp theo
			$arrUpdateNXThangTiep['soluongton'] = round(round(($soluongtonTrongThang + $rsTongNhapThangTiep['slhotkctam']),3) - $rsTongXuatThangTiep['slhotkctam'],3);
			$arrUpdateNXThangTiep['cannangton'] = round(round(($cannangtonTrongThang + $rsTongNhapThangTiep['cannangctkctam']),3) - $rsTongXuatThangTiep['cannangctkctam'],3);

			vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' sizehotkctam="'.$sizehotkctam.'" and dated="'.$dateDauThangTiep.'"');
		}
	}
}

// M.Tân thêm ngày 09/07/2021 - Điều chính số liệu hạch toán kim cương tấm Kho Vàng Cũ Chi Nhánh theo dated phiếu kim cương tấm mục điều chỉnh số liệu
function dieuChinhSoLieuHachToanKimCuongTamDCSLKhoVangCuCN($table,$tablehachtoan,$sizehotkctam,$datedPhieuKCTam) {
	$dateNow = date("Y-m-d");
    $arrDateCal = $arrnx1day = array();

	$arrThangPhieuKCTam = explode('-',$datedPhieuKCTam);
    $dateDauThangKCTam = $arrThangPhieuKCTam[0].'-'.$arrThangPhieuKCTam[1].'-01';
    
	// Get tất cả các tháng từ phiếu edit này đén hiện tại 
    while(strtotime($dateDauThangKCTam) < strtotime($dateNow)) {
        $arrDateCal[] = $dateDauThangKCTam;
        $dateDauThangKCTam = date('Y-m-d', strtotime('+1 month', strtotime($dateDauThangKCTam)));
    }
    // print_r($arrDateCal);
    // die(ceil(count($arrDateCal)));

	for($i=0; $i <= ceil(count($arrDateCal))-1; $i++) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $arrDateCal[$i];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI SIZEHOTKCTAM ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select SUM(slhotkctam) as slhotkctam, 
										 ROUND(SUM(cannangctkctam), 3) as cannangctkctam
										 from $GLOBALS[db_sp].".$table." 
										 where type=1 and trangthai=2 and typera=1  
										 and sizehotkctam='".$sizehotkctam."'
										 and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI SIZEHOTKCTAM ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select SUM(slhotkctam) as slhotkctam, 
										 ROUND(SUM(cannangctkctam), 3) as cannangctkctam
										 from $GLOBALS[db_sp].".$table." 
										 where type=1 and trangthai=2 and typera=1 and trangthaixuat=2 
										 and sizehotkctam='".$sizehotkctam."'
										 and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								"; 
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);
		
		// Kiểm tra xem sizehot này đã có record trong bảng sodudauky của tháng phiếu sửa chưa, nếu chưa thì tạo record = 0 để sau đó update vào record này (Chỉ kiểm tra khi tháng đó có nhập hoặc xuất)
		if(($rsTongNhapTrongThang['slhotkctam'] != 0 && $rsTongNhapTrongThang['cannangctkctam'] != 0) || ($rsTongXuatTrongThang['slhotkctam'] != 0 && $rsTongXuatTrongThang['cannangctkctam'] != 0)) {
			$sqlCheckRecordSizeHotKCTam = "select * from $GLOBALS[db_sp].".$tablehachtoan." where sizehotkctam='".$sizehotkctam."' and dated = '".$dateDauThang."'";
			$rsCheckRecordSizeHotKCTam = $GLOBALS['sp']->getRow($sqlCheckRecordSizeHotKCTam);
			if(ceil(count($rsCheckRecordSizeHotKCTam)) <= 0) {
				$arrnx1day['soluongnhap'] = 0;
				$arrnx1day['soluongxuat'] = 0;
				$arrnx1day['soluongton'] = 0;
				$arrnx1day['cannangnhap'] = 0;
				$arrnx1day['cannangxuat'] = 0;
				$arrnx1day['cannangton'] = 0;
				
				$arrnx1day['sizehotkctam'] = trim($sizehotkctam);
				$arrnx1day['dated'] = $dateDauThang;

				vaInsert($tablehachtoan,$arrnx1day);
			}
		}
		
		// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với sizehotkctam (tháng đó) để so sánh
		$sqlNhapSDDKTrongThang = "select soluongnhap from $GLOBALS[db_sp].".$tablehachtoan." where sizehotkctam='".$sizehotkctam."' and dated = '".$dateDauThang."'";
		$soluongnhapSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
		// So sánh số lượng nhập trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongNhapTrongThang['slhotkctam'] != $soluongnhapSDDK){
			$arrUpdateNX['soluongnhap'] = $rsTongNhapTrongThang['slhotkctam'];
			$arrUpdateNX['cannangnhap'] = $rsTongNhapTrongThang['cannangctkctam'];
		}

		// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với sizehotkctam (tháng đó) để so sánh
		$sqlXuatSDDKTrongThang = "select soluongxuat from $GLOBALS[db_sp].".$tablehachtoan." where sizehotkctam='".$sizehotkctam."' and dated = '".$dateDauThang."'";
		$soluongxuatSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
		// So sánh số lượng xuất trong sodudauky với tổng số lượng xuất của các phiếu cộng lại
		if($rsTongXuatTrongThang['slhotkctam'] != $soluongxuatSDDK){
			$arrUpdateNX['soluongxuat'] = $rsTongXuatTrongThang['slhotkctam'];
			$arrUpdateNX['cannangxuat'] = $rsTongXuatTrongThang['cannangctkctam'];
		}

		if($rsTongNhapTrongThang['slhotkctam'] != 0 || $rsTongXuatTrongThang['slhotkctam'] != 0) {
			// Lấy ngày của tháng trước có hạch toán
			$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where sizehotkctam='".$sizehotkctam."' and dated < '".$dateDauThang."' order by dated desc limit 1";
			$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
			
			// Lấy ra số lượng tồn của tháng trước có hạch toán
			$sqlGetSLTonThangTruoc = "select soluongton, cannangton from $GLOBALS[db_sp].".$tablehachtoan." where sizehotkctam='".$sizehotkctam."' and dated = '".$dateDauThangTruoc."'";
			$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
			
			// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
			$soluongtonTrongThang = round(round(($rsGetSLTonThangTruoc['soluongton'] + $rsTongNhapTrongThang['slhotkctam']),3) - $rsTongXuatTrongThang['slhotkctam'],3);
			$cannangtonTrongThang = round(round(($rsGetSLTonThangTruoc['cannangton'] + $rsTongNhapTrongThang['cannangctkctam']),3) - $rsTongXuatTrongThang['cannangctkctam'],3);

			$arrUpdateNX['soluongton'] = $soluongtonTrongThang;
			$arrUpdateNX['cannangton'] = $cannangtonTrongThang;

			vaUpdate($tablehachtoan, $arrUpdateNX, ' sizehotkctam="'.$sizehotkctam.'" and dated="'.$dateDauThang.'"');
		}

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i+1];

		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlTongNhapThangTiep = "select SUM(slhotkctam) as slhotkctam, 
											ROUND(SUM(cannangctkctam), 3) as cannangctkctam
											from $GLOBALS[db_sp].".$table." 
											where type=1 and trangthai=2 and typera=1  
											and sizehotkctam='".$sizehotkctam."'
											and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
									";
			$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
			
			if($rsTongNhapThangTiep['slhotkctam'] != 0) { // != 0 là tháng tiếp theo có nhập
				$arrUpdateNXThangTiep['soluongnhap'] = $rsTongNhapThangTiep['slhotkctam'];
				$arrUpdateNXThangTiep['cannangnhap'] = $rsTongNhapThangTiep['cannangctkctam'];
			}

			$sqlTongXuatThangTiep = "select SUM(slhotkctam) as slhotkctam, 
											ROUND(SUM(cannangctkctam), 3) as cannangctkctam
											from $GLOBALS[db_sp].".$table." 
											where type=1 and trangthai=2 and typera=1 and trangthaixuat=2  
											and sizehotkctam='".$sizehotkctam."'
											and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."'
									";
			$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

			if($rsTongXuatThangTiep['slhotkctam'] != 0) { // != 0 là tháng tiếp theo có xuất
				$arrUpdateNXThangTiep['soluongxuat'] = $rsTongXuatThangTiep['slhotkctam'];
				$arrUpdateNXThangTiep['cannangxuat'] = $rsTongXuatThangTiep['cannangctkctam'];
			}

			if($rsTongNhapThangTiep['slhotkctam'] != 0 || $rsTongXuatThangTiep['slhotkctam'] != 0) {
				// Update soluongton của tháng tiếp theo
				$arrUpdateNXThangTiep['soluongton'] = round(round(($soluongtonTrongThang + $rsTongNhapThangTiep['slhotkctam']),3) - $rsTongXuatThangTiep['slhotkctam'],3);
				$arrUpdateNXThangTiep['cannangton'] = round(round(($cannangtonTrongThang + $rsTongNhapThangTiep['cannangctkctam']),3) - $rsTongXuatThangTiep['cannangctkctam'],3);

				vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' sizehotkctam="'.$sizehotkctam.'" and dated="'.$dateDauThangTiep.'"');
			}
		}
	}
}

// M.Tân thêm ngày 15/07/2021 - Điều chỉnh số liệu hạch toán hao dư table vangcucn_khovangcucn_sodudauky
function dieuChinhSoLieuHachToanHaoDuKhoVangCuCN($table,$tablehachtoan,$idloaivang) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and typevkc=1 ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateHD = $arrUpdateHDThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG HAO DƯ DỰA TRÊN CÁC PHIẾU XUẤT LỚN ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongHaoDuTrongThang = "select ROUND(SUM(hao), 3) as hao, 
										ROUND(SUM(du), 3) as du
										from $GLOBALS[db_sp].".$table."
										where type=2 and trangthai=2 and idloaivang=".$idloaivang." 
										and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."'
								"; 
		$rsTongHaoDuTrongThang = $GLOBALS['sp']->getRow($sqlTongHaoDuTrongThang);

		// Lấy ra tổng số lượng hao, dư trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
		$sqlHDSDDKTrongThang = "select hao, du from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
		$rsHDSDDKTrongThang = $GLOBALS['sp']->getRow($sqlHDSDDKTrongThang);
		
		// So sánh số lượng hao, dư trong sodudauky với tổng số lượng hao,dư của các phiếu xuất lớn cộng lại
		if($rsTongHaoDuTrongThang['hao'] != $rsHDSDDKTrongThang['hao'] || $rsTongHaoDuTrongThang['du'] != $rsHDSDDKTrongThang['du']) {
			$arrUpdateHD['hao'] = $rsTongHaoDuTrongThang['hao'];
			$arrUpdateHD['du'] = $rsTongHaoDuTrongThang['du'];

			vaUpdate($tablehachtoan, $arrUpdateHD, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');
		}

		// Kiểm tra hao dư của tháng tiếp theo xem có sai không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlHaoDuThangTiep = "select ROUND(SUM(hao), 3) as hao,
										ROUND(SUM(du), 3) as du 
										from $GLOBALS[db_sp].".$table." 
										where type=2 and trangthai=2 and idloaivang=".$idloaivang." 
										and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."' 
								";
			$rsHaoDuThangTiep = $GLOBALS['sp']->getRow($sqlHaoDuThangTiep);

			// Lấy ra hao, dư trong bảng sodudauky để so sánh
			$sqlHDSDDKThangTiep= "select hao, du from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTiep."'";
			$rsHDSDDKThangTiep = $GLOBALS['sp']->getRow($sqlHDSDDKThangTiep);

			if($rsHDSDDKThangTiep['hao'] != $rsHaoDuThangTiep['hao'] || $rsHDSDDKThangTiep['du'] != $rsHaoDuThangTiep['du']) {
				$arrUpdateHDThangTiep['hao'] = $rsHaoDuThangTiep['hao'];
				$arrUpdateHDThangTiep['du'] = $rsHaoDuThangTiep['du'];

				vaUpdate($tablehachtoan, $arrUpdateHDThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');
			}
		}
	}
}

// M.Tân thêm ngày 23/06/2020 - Thống kê tổng nhập từ chi nhánh và nhập vào kho Vàng Cũ CN dựa trên idkybaocaocn
function insert_thongKeTongNhapTuCNVaNhapVaoKhoKhoVangCuCN($a) {
	$arrlist = array();

	$cid = ceil(trim($a['cid']));
	$idkybaocaocn = ceil(trim($a['idkybaocaocn']));
	
	$datenow = date("Y-m-d");
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablect = $rsgettable['tablect'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		if($idkybaocaocn > 0){
			// Tỉnh tổng cannangv/số tiền và tổng qui 10 vàng lưu và nhập kho theo kỳ báo cáo chi nhánh
			$sqltongtheokybcTruocNau = "select ROUND(SUM(cannangvluu), 3) as tongcannangvluu,
											   ROUND(SUM(vangqui10luu), 3) as tongvangqui10luu
											   from $GLOBALS[db_sp].".$tablect." 
											   where idkybaocaocn = ".$idkybaocaocn."  
											   and type=1 and typeduyettruocnau=1 and typevkc=1 and nhomnguyenlieuvang not in (2010,2013,2618,2851) ";
			$rstongtheokybcTruocNau = $GLOBALS['sp']->getRow($sqltongtheokybcTruocNau);

			$sqltongtheokybcSauNau = "select ROUND(SUM(cannangv), 3) as tongcannangv,
									   ROUND(SUM(vangqui10), 3) as tongvangqui10
									   from $GLOBALS[db_sp].".$tablect." 
									   where idkybaocaocn = ".$idkybaocaocn." 
									   and type=1 and trangthai=2 and typevkc=1 and nhomnguyenlieuvang not in (2010,2013,2618,2851) ";
			$rstongtheokybcSauNau = $GLOBALS['sp']->getRow($sqltongtheokybcSauNau);
			
			$arrlist['tongcannangvluu'] = $rstongtheokybcTruocNau['tongcannangvluu'];
			$arrlist['tongvangqui10luu'] = $rstongtheokybcTruocNau['tongvangqui10luu'];	
			$arrlist['tongcannangv'] = $rstongtheokybcSauNau['tongcannangv'];
			$arrlist['tongvangqui10'] = $rstongtheokybcSauNau['tongvangqui10'];

			$ketqua = $rstongtheokybcSauNau['tongvangqui10'] - $rstongtheokybcTruocNau['tongvangqui10luu'];

			if($ketqua > 0){		
				$arrlist['haoqui10'] = 0;		
				$arrlist['duqui10'] = $ketqua;
			}
			else{
				$ketqua = abs($ketqua);
				$arrlist['haoqui10'] = $ketqua;		
				$arrlist['duqui10'] = 0;
			}
		}
		else{
			$arrlist['idkybaocaocn'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;	
}

// M.Tân thêm ngày 02/07/2020 - Load tên phòng ban dựa trên id categories chuyển đến
function insert_loadNamePhongBanKhoVangCuCN($a) {
	$id = ceil(trim($a['id']));
	$namePhongBan = getLinkTitle($id,1);
	return $namePhongBan;
}

// M.Tân thêm ngày 17/07/2020 - Thống kê tổng nhập trên 2 phần mềm kho Vàng Cũ CN dựa trên idkybaocaocn
function insert_thongKeTongNhapTrenHaiPhanMemKhoVangCuCN($a) {
	$arrlist = array();

	$cid = ceil(trim($a['cid']));
	$idkybaocaocn = ceil(trim($a['idkybaocaocn']));
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablect = $rsgettable['tablect'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		if($idkybaocaocn > 0){
			// Get ra id, tongtlthucmua và tongqui10quantri của phiếu import excel ứng với kỳ báo cáo chi nhánh này
			$sqlgetphieuimport = "select id, tongtlthucmua, tongqui10quantri
										 from $GLOBALS[db_sp].".$table." 
										 where idkybaocaocn = ".$idkybaocaocn." 
										 and type=4 and trangthai=2 and typevkc=1 ";
			$rsgetphieuimport = $GLOBALS['sp']->getRow($sqlgetphieuimport);
			// print_r($rsgetphieuimport); die();

			$arrlist['idphieuimport'] = $rsgetphieuimport['id'];
			$arrlist['tongtlthucmua'] = $rsgetphieuimport['tongtlthucmua'];	
			$arrlist['tongqui10quantri'] = $rsgetphieuimport['tongqui10quantri'];

			// Tỉnh tổng cannangv/số tiền và tổng qui 10 vàng lưu nhập kho theo kỳ báo cáo chi nhánh
			$sqltongtheokybc = "select ROUND(SUM(cannangvluu), 3) as tongcannangvluu,
									   ROUND(SUM(vangqui10luu), 3) as tongvangqui10luu
									   from $GLOBALS[db_sp].".$tablect." 
									   where idkybaocaocn = ".$idkybaocaocn." 
									   and type=1 and typeduyettruocnau=1 and typevkc=1 and nhomnguyenlieuvang not in (2010,2013,2618,2851) ";
			$rstongtheokybc = $GLOBALS['sp']->getRow($sqltongtheokybc);
			
			$arrlist['tongcannangvluu'] = $rstongtheokybc['tongcannangvluu'];
			$arrlist['tongvangqui10luu'] = $rstongtheokybc['tongvangqui10luu'];

			$ketquaqui10 = $rstongtheokybc['tongvangqui10luu'] - $rsgetphieuimport['tongqui10quantri'];
			$ketquatlthucmua = $rstongtheokybc['tongcannangvluu'] - $rsgetphieuimport['tongtlthucmua'];

			if($ketquaqui10 > 0){		
				$arrlist['haoqui10'] = 0;		
				$arrlist['duqui10'] = $ketquaqui10;
			}
			else{
				$ketquaqui10 = abs($ketquaqui10);
				$arrlist['haoqui10'] = $ketquaqui10;		
				$arrlist['duqui10'] = 0;
			}

			if($ketquatlthucmua > 0){		
				$arrlist['haotlthuc'] = 0;		
				$arrlist['dutlthuc'] = $ketquatlthucmua;
			}
			else{
				$ketquatlthucmua = abs($ketquatlthucmua);
				$arrlist['haotlthuc'] = $ketquatlthucmua;		
				$arrlist['dutlthuc'] = 0;
			}
		}
		else{
			$arrlist['idkybaocaocn'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;	
}

// M.Tân thêm ngày 31/08/2020 - Thống kê tổng nhập lãi lỗ trên 2 phần mềm kho Vàng Cũ CN dựa trên idkybaocaocn
function insert_thongKeTongNhapLaiLoTrenHaiPhanMemKhoVangCuCN($a) {
	$arrlist = array();

	$cid = ceil(trim($a['cid']));
	$idkybaocaocn = ceil(trim($a['idkybaocaocn']));
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablect = $rsgettable['tablect'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		if($idkybaocaocn > 0){
			// Get ra id, tongtlthucmua và tongqui10lailo của phiếu import excel ứng với kỳ báo cáo chi nhánh này
			$sqlgetphieuimport = "select id, tongtlthucmua, tongqui10lailo
										 from $GLOBALS[db_sp].".$table." 
										 where idkybaocaocn = ".$idkybaocaocn." 
										 and type=4 and trangthai=2 and typevkc=1 ";
			$rsgetphieuimport = $GLOBALS['sp']->getRow($sqlgetphieuimport);
			// print_r($rsgetphieuimport); die();

			$arrlist['idphieuimport'] = $rsgetphieuimport['id'];
			$arrlist['tongtlthucmua'] = $rsgetphieuimport['tongtlthucmua'];	
			$arrlist['tongqui10lailo'] = $rsgetphieuimport['tongqui10lailo'];

			// Tỉnh tổng cannangv/số tiền và tổng qui 10 vàng lưu nhập kho theo kỳ báo cáo chi nhánh
			$sqltongtheokybc = "select ROUND(SUM(cannangvluu), 3) as tongcannangvluu,
									   ROUND(SUM(vangqui10luu), 3) as tongvangqui10luu
									   from $GLOBALS[db_sp].".$tablect." 
									   where idkybaocaocn = ".$idkybaocaocn." 
									   and type=1 and typeduyettruocnau=1 and typevkc=1 and nhomnguyenlieuvang not in (2010,2013,2618,2851) ";
			$rstongtheokybc = $GLOBALS['sp']->getRow($sqltongtheokybc);
			
			$arrlist['tongcannangvluu'] = $rstongtheokybc['tongcannangvluu'];
			$arrlist['tongvangqui10luu'] = $rstongtheokybc['tongvangqui10luu'];

			$ketquaqui10 = $rsgetphieuimport['tongqui10lailo'] - $rstongtheokybc['tongvangqui10luu'];
			$ketquatlthucmua = $rstongtheokybc['tongcannangvluu'] - $rsgetphieuimport['tongtlthucmua'];

			if($ketquaqui10 > 0){		
				$arrlist['haoqui10'] = 0;		
				$arrlist['duqui10'] = $ketquaqui10;
			}
			else{
				$ketquaqui10 = abs($ketquaqui10);
				$arrlist['haoqui10'] = $ketquaqui10;		
				$arrlist['duqui10'] = 0;
			}

			if($ketquatlthucmua > 0){		
				$arrlist['haotlthuc'] = 0;		
				$arrlist['dutlthuc'] = $ketquatlthucmua;
			}
			else{
				$ketquatlthucmua = abs($ketquatlthucmua);
				$arrlist['haotlthuc'] = $ketquatlthucmua;		
				$arrlist['dutlthuc'] = 0;
			}
		}
		else{
			$arrlist['idkybaocaocn'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;	
}

// M.Tân thêm ngày 22/05/2021 - Thống kê tổng nhập lời lỗ trên 2 phần mềm so sánh với số liệu sau nấu kho Vàng Cũ CN dựa trên idkybaocaocn
function insert_thongKeTongNhapLaiLoTrenHaiPhanMemSoVoiSauNauKhoVangCuCN($a) {
	$arrlist = array();

	$cid = ceil(trim($a['cid']));
	$idkybaocaocn = ceil(trim($a['idkybaocaocn']));
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablect = $rsgettable['tablect'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablect']) && !empty($rsgettable['tablehachtoan'])){
		if($idkybaocaocn > 0){
			// Get ra id, tongtlthucmua và tongqui10lailo của phiếu import excel ứng với kỳ báo cáo chi nhánh này
			$sqlgetphieuimport = "select id, tongtlthucmua, tongqui10lailo
										 from $GLOBALS[db_sp].".$table." 
										 where idkybaocaocn = ".$idkybaocaocn." 
										 and type=4 and trangthai=2 and typevkc=1 ";
			$rsgetphieuimport = $GLOBALS['sp']->getRow($sqlgetphieuimport);
			// print_r($rsgetphieuimport); die();

			$arrlist['idphieuimport'] = $rsgetphieuimport['id'];
			$arrlist['tongtlthucmua'] = $rsgetphieuimport['tongtlthucmua'];	
			$arrlist['tongqui10lailo'] = $rsgetphieuimport['tongqui10lailo'];

			// Tỉnh tổng cannangv/số tiền và tổng qui 10 vàng nhập kho theo kỳ báo cáo chi nhánh
			$sqltongtheokybc = "select ROUND(SUM(cannangv), 3) as tongcannangv,
									   ROUND(SUM(vangqui10), 3) as tongvangqui10
									   from $GLOBALS[db_sp].".$tablect." 
									   where idkybaocaocn = ".$idkybaocaocn." 
									   and type=1 and trangthai=2 and typevkc=1 and nhomnguyenlieuvang not in (2010,2013,2618,2851) ";
			$rstongtheokybc = $GLOBALS['sp']->getRow($sqltongtheokybc);
			
			$arrlist['tongcannangv'] = $rstongtheokybc['tongcannangv'];
			$arrlist['tongvangqui10'] = $rstongtheokybc['tongvangqui10'];

			$ketquaqui10 = $rsgetphieuimport['tongqui10lailo'] - $rstongtheokybc['tongvangqui10'];
			$ketquatlthucmua = $rstongtheokybc['tongcannangv'] - $rsgetphieuimport['tongtlthucmua'];

			if($ketquaqui10 > 0){		
				$arrlist['haoqui10'] = 0;		
				$arrlist['duqui10'] = $ketquaqui10;
			}
			else{
				$ketquaqui10 = abs($ketquaqui10);
				$arrlist['haoqui10'] = $ketquaqui10;		
				$arrlist['duqui10'] = 0;
			}

			if($ketquatlthucmua > 0){		
				$arrlist['haotlthuc'] = 0;		
				$arrlist['dutlthuc'] = $ketquatlthucmua;
			}
			else{
				$ketquatlthucmua = abs($ketquatlthucmua);
				$arrlist['haotlthuc'] = $ketquatlthucmua;		
				$arrlist['dutlthuc'] = 0;
			}
		}
		else{
			$arrlist['idkybaocaocn'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;	
}

// M.Tân thêm ngày 04/08/2020 - load select tên nguyên liệu kim cương cho kho Vàng Cũ CN
function loadSelectTenNguyenLieuKimCuongKhoVangCuCN($numdongvanghangkc, $idtennguyenlieukimcuong) {
	// Get tên nguyên liệu thuộc nhóm nguyên liệu kim cương kho Vàng Cũ CN
	$sqltennguyenlieukc = "SELECT * from $GLOBALS[db_sp].categories where pid=1748"; // 1748: nhóm nguyên liệu kim cương của kho Vàng Cũ CN
	$rstennguyenlieukc = $GLOBALS['sp']->getAll($sqltennguyenlieukc);

	foreach($rstennguyenlieukc as $itemtennguyenlieukc){
		if($idtennguyenlieukimcuong == $itemtennguyenlieukc['id'])
			$checked = "selected";
		else
			$checked = "";
		$html .= "
					<option ".$checked." value='".$itemtennguyenlieukc['id']."'>
						".$itemtennguyenlieukc['name_vn']."
					</option>
				";		
	}

	$str = '
		<select style="width: 140px;" name="tennguyenlieukimcuong[]" id="tennguyenlieukimcuong'.$numdongvanghangkc.'" onchange="loadTenKimCuongTheoTenNguyenLieu(this.value, '.$numdongvanghangkc.')" '.$disabled.' >
				<option value="0">--Chọn tên ng.liệu--</option>
				'.$html.'
		</select> 
	';
	return $str;
}

// M.Tân thêm ngày 05/08/2020 - insert load select tên nguyên liệu kim cương cho kho Vàng Cũ CN
function insert_loadSelectTenNguyenLieuKimCuongKhoVangCuCN($a) {
	$numdongvanghangkc = ceil(trim($a['numdongvanghangkc']));
	$idtennguyenlieukimcuong = ceil(trim($a['idtennguyenlieukimcuong']));

	// Get tên nguyên liệu thuộc nhóm nguyên liệu kim cương kho Vàng Cũ CN
	$sqltennguyenlieukc = "SELECT * from $GLOBALS[db_sp].categories where pid=1748"; // 1748: nhóm nguyên liệu kim cương của kho Vàng Cũ CN
	$rstennguyenlieukc = $GLOBALS['sp']->getAll($sqltennguyenlieukc);

	foreach($rstennguyenlieukc as $itemtennguyenlieukc){
		if($idtennguyenlieukimcuong == $itemtennguyenlieukc['id'])
			$checked = "selected";
		else
			$checked = "";
		$html .= "
					<option ".$checked." value='".$itemtennguyenlieukc['id']."'>
						".$itemtennguyenlieukc['name_vn']."
					</option>
				";		
	}

	$str = '
		<select style="width: 140px;" name="tennguyenlieukimcuong[]" id="tennguyenlieukimcuong'.$numdongvanghangkc.'" onchange="loadTenKimCuongTheoTenNguyenLieu(this.value, '.$numdongvanghangkc.')" '.$disabled.' >
				<option value="0">--Chọn tên ng.liệu--</option>
				'.$html.'
		</select> 
	';
	return $str;
}

// M.Tân thêm ngày 27/08/2020 - Thống kê phiếu import Excel Kho Vàng Cũ CN
function insert_thongKePhieuImportExcelKhoVangCuCN($a) {
	$arrlist = array();

	$codes = trim($a['codes']);
	$fromdays = trim($a['fromdays']);
	$todays = trim($a['todays']);
	$idkybaocaocn = ceil(trim($a['idkybaocaocn']));

	if(!empty($fromdays)){
		$fromdays = explode('/',$fromdays);
		$fromdays = $fromdays[2].'-'.$fromdays[1].'-'.$fromdays[0];
		$wh.=' and dated >= "'.$fromdays.'" ';
	}
	if(!empty($todays)){			
		$todays = explode('/',$todays);
		$todays = $todays[2].'-'.$todays[1].'-'.$todays[0];
		$wh.=' and dated <= "'.$todays.'" ';
	}
	if(!empty($codes)){
		$wh.=' and maphieu like "%'.$codes.'%" ';
	}
	
	if($idkybaocaocn > 0){
		$sqlgetphieuimport = "select id, maphieu, dated, fileexcel from $GLOBALS[db_sp].vangcucn_khovangcucn 
									   where idkybaocaocn = ".$idkybaocaocn." 
									   and type=4 and typevkc=1 and trangthai=2 $wh";
		$rsgetphieuimport = $GLOBALS['sp']->getRow($sqlgetphieuimport);
		// print_r($rsgetphieuimport); die($sqlgetphieuimport);

		$arrlist['idphieuimport'] = $rsgetphieuimport['id'];
		$arrlist['maphieu'] = $rsgetphieuimport['maphieu'];
		$arrlist['dated'] = $rsgetphieuimport['dated'];	
		$arrlist['fileexcel'] = $rsgetphieuimport['fileexcel'];
	}
	else{
		$arrlist['idkybaocaocn'] = 0;	
	}
	return $arrlist;	
}
function insert_checkKhoSanXuatTaoPhieuHaoDuRoi($a) {
	$id = ceil(trim($a['id']));
	$table = trim($a['table']);
	$total = 0;
	if($id > 0){
		$sql_sum = "select count(id) from $GLOBALS[db_sp].".$table." where idpnk = ".$id;
		$total = ceil($GLOBALS['sp']->getOne($sql_sum));	
	}
	return $total;
}

// M.Tân thêm ngày 23/09/2020 - load select tên nguyên liệu kim cương tấm cho kho Vàng Cũ CN
function loadSelectTenNguyenLieuKimCuongTamKhoVangCuCN($idtennguyenlieukimcuongtam, $idnhomnguyenlieuvang) {
	if($idnhomnguyenlieuvang == 2616) { // Là nhóm nguyên liệu Hàng % KC Bán Món => Không load tên nguyên liệu SP Làm Đồ Chùi
		$whIdTenNguyenLieuKCTam = " and id not in (2092) ";
	}

	// Get tên nguyên liệu thuộc nhóm nguyên liệu kim cương tấm kho Vàng Cũ CN
	$sqltennguyenlieukctam = "SELECT * from $GLOBALS[db_sp].categories where pid=2022 $whIdTenNguyenLieuKCTam "; // 2022: nhóm nguyên liệu kim cương tấm của kho Vàng Cũ CN
	$rstennguyenlieukctam = $GLOBALS['sp']->getAll($sqltennguyenlieukctam);

	foreach($rstennguyenlieukctam as $itemtennguyenlieukctam){
		if($idtennguyenlieukimcuongtam == $itemtennguyenlieukctam['id'])
			$checked = "selected";
		else
			$checked = "";
		$html .= "
					<option ".$checked." value='".$itemtennguyenlieukctam['id']."'>
						".$itemtennguyenlieukctam['name_vn']."
					</option>
				";		
	}

	$str = '
		<select style="width: 200px;" name="tennguyenlieukimcuongtam" id="tennguyenlieukimcuongtam" onchange="" '.$disabled.' >
				<option value="0">--Chọn tên ng.liệu--</option>
				'.$html.'
		</select> 
	';
	return $str;
}

// M.Tân thêm ngày 23/09/2020 - insert load select tên nguyên liệu kim cương tấm cho kho Vàng Cũ CN
function insert_loadSelectTenNguyenLieuKimCuongTamKhoVangCuCN($a) {
	$idtennguyenlieukimcuongtam = ceil(trim($a['idtennguyenlieukimcuongtam']));
	$idnhomnguyenlieuvang = ceil(trim($a['idnhomnguyenlieuvang']));

	if($idnhomnguyenlieuvang == 2616) { // Là nhóm nguyên liệu Hàng % KC Bán Món => Không load tên nguyên liệu SP Làm Đồ Chùi
		$whIdTenNguyenLieuKCTam = " and id not in (2092) ";
	}

	// Get tên nguyên liệu thuộc nhóm nguyên liệu kim cương tấm kho Vàng Cũ CN
	$sqltennguyenlieukctam = "SELECT * from $GLOBALS[db_sp].categories where pid=2022 $whIdTenNguyenLieuKCTam "; // 2022: nhóm nguyên liệu kim cương tấm của kho Vàng Cũ CN
	$rstennguyenlieukctam = $GLOBALS['sp']->getAll($sqltennguyenlieukctam);

	foreach($rstennguyenlieukctam as $itemtennguyenlieukctam){
		if($idtennguyenlieukimcuongtam == $itemtennguyenlieukctam['id'])
			$checked = "selected";
		else
			$checked = "";
		$html .= "
					<option ".$checked." value='".$itemtennguyenlieukctam['id']."'>
						".$itemtennguyenlieukctam['name_vn']."
					</option>
				";		
	}

	$str = '
		<select style="width: 200px;" name="tennguyenlieukimcuongtam" id="tennguyenlieukimcuongtam" onchange="" '.$disabled.' >
				<option value="0">--Chọn tên ng.liệu--</option>
				'.$html.'
		</select> 
	';
	return $str;
}

// M.Tân thêm ngày 10/09/2020 - load select tên nguyên liệu vàng cho nhóm nguyên liệu Vàng % Dây Ý, Vàng Món, Trả Lại của Kho Vàng Cũ CN
function loadSelectTenNguyenLieuVangDayYBMTLKhoVangCuCN($numdongvanghangdayybmtl, $idtennguyenvang, $idnhomnguyenvang) {
	// Get tên nguyên liệu thuộc nhóm nguyên liệu vàng kho Vàng Cũ CN
	$sqltennguyenlieuvang = "SELECT * from $GLOBALS[db_sp].categories where pid=".$idnhomnguyenvang; 

	// $sqlcounttennguyenlieuvang = "select count(id) from $GLOBALS[db_sp].categories where pid=".$idnhomnguyenvang;  
	// $counttennguyenlieuvang = ceil($GLOBALS['sp']->getOne($sqlcounttennguyenlieuvang));

	// if($counttennguyenlieuvang > 1) { // Có nhiều hơn 1 tên nguyên liệu ứng với nhóm nguyên liệu này  => load ra select của các tên nguyên liệu này
		$rstennguyenlieuvang = $GLOBALS['sp']->getAll($sqltennguyenlieuvang);
		foreach($rstennguyenlieuvang as $itemtennguyenlieuvang){
			if($idtennguyenvang == $itemtennguyenlieuvang['id'])
				$checked = "selected";
			else
				$checked = "";
			$html .= "
						<option ".$checked." value='".$itemtennguyenlieuvang['id']."'>
							".$itemtennguyenlieuvang['name_vn']."
						</option>
					";		
		}

		$str = '
			<select style="width: 140px;" name="tennguyenlieuvangchildhangdayybmtl[]" id="tennguyenlieuvangchildhangdayybmtl'.$numdongvanghangdayybmtl.'" onchange="loadInputTuoiVangHangDayYBanMonTraLai(this.value, '.$idnhomnguyenvang.', '.$numdongvanghangdayybmtl.')" '.$disabled.' >
				<option value="0">--Chọn tên ng.liệu--</option>
				'.$html.'
			</select> 
		';
	// } else { // Chỉ có 1 tên nguyên liệu => load ra tên nguyên liệu này luôn, không load select
	// 	$rstennguyenlieuvang = $GLOBALS["sp"]->getRow($sqltennguyenlieuvang);
	// 	// print_r($rstennguyenlieuvang); die();

	// 	$str = '
	// 		'.getName("categories","name_vn",$rstennguyenlieuvang['id']).'
	// 		<input type="hidden" autocomplete="off" name="tennguyenlieuvangchildhangdayybmtl[]" id="tennguyenlieuvangchildhangdayybmtl'.$numdongvanghangdayybmtl.'" class="txtdatagirld" value="'.$rstennguyenlieuvang['id'].'" onchange="loadInputTuoiVangHangDayYBanMonTraLai('.$rstennguyenlieuvang['id'].', '.$idnhomnguyenvang.', '.$numdongvanghangdayybmtl.')" readonly="readonly" />
	// 	';
	// }
	return $str;
}

// M.Tân thêm ngày 17/11/2021 - load select tên nguyên liệu vàng cho nhóm nguyên liệu Vàng % KC Bán Món của Kho Vàng Cũ CN
function loadSelectTenNguyenLieuVangKCBanMonKhoVangCuCN($numdongvanghangkcbanmon, $idtennguyenvang, $idnhomnguyenvang) {
	// Get tên nguyên liệu thuộc nhóm nguyên liệu vàng kho Vàng Cũ CN
	$sqltennguyenlieuvang = "SELECT * from $GLOBALS[db_sp].categories where pid=".$idnhomnguyenvang; 

	// $sqlcounttennguyenlieuvang = "select count(id) from $GLOBALS[db_sp].categories where pid=".$idnhomnguyenvang;  
	// $counttennguyenlieuvang = ceil($GLOBALS['sp']->getOne($sqlcounttennguyenlieuvang));

	// if($counttennguyenlieuvang > 1) { // Có nhiều hơn 1 tên nguyên liệu ứng với nhóm nguyên liệu này  => load ra select của các tên nguyên liệu này
		$rstennguyenlieuvang = $GLOBALS['sp']->getAll($sqltennguyenlieuvang);
		foreach($rstennguyenlieuvang as $itemtennguyenlieuvang){
			if($idtennguyenvang == $itemtennguyenlieuvang['id'])
				$checked = "selected";
			else
				$checked = "";
			$html .= "
						<option ".$checked." value='".$itemtennguyenlieuvang['id']."'>
							".$itemtennguyenlieuvang['name_vn']."
						</option>
					";		
		}

		$str = '
			<select style="width: 140px;" name="tennguyenlieuvangchildhangkcbanmon[]" id="tennguyenlieuvangchildhangkcbanmon'.$numdongvanghangkcbanmon.'" onchange="loadInputTuoiVangHangKCBanMon(this.value, '.$idnhomnguyenvang.', '.$numdongvanghangkcbanmon.')" '.$disabled.' >
				<option value="0">--Chọn tên ng.liệu--</option>
				'.$html.'
			</select> 
		';
	// } else { // Chỉ có 1 tên nguyên liệu => load ra tên nguyên liệu này luôn, không load select
	// 	$rstennguyenlieuvang = $GLOBALS["sp"]->getRow($sqltennguyenlieuvang);
	// 	// print_r($rstennguyenlieuvang); die();

	// 	$str = '
	// 		'.getName("categories","name_vn",$rstennguyenlieuvang['id']).'
	// 		<input type="hidden" autocomplete="off" name="tennguyenlieuvangchildhangkcbanmon[]" id="tennguyenlieuvangchildhangkcbanmon'.$numdongvanghangkcbanmon.'" class="txtdatagirld" value="'.$rstennguyenlieuvang['id'].'" onchange="loadInputTuoiVangHangKCBanMon('.$rstennguyenlieuvang['id'].', '.$idnhomnguyenvang.', '.$numdongvanghangkcbanmon.')" readonly="readonly" />
	// 	';
	// }
	return $str;
}

// M.Tân thêm ngày 11/09/2020 - insert load các phiếu vàng % Dây Ý, Bán Món, Trả Lại sinh ra từ Hàng % Dây Ý, Bán Món, Trả Lại - Phần nhập kho trước nấu của Kho Vàng Cũ CN
function insert_loadRowVangDayYVangMonTraLaiKhoVangCuCN($a) {
	$idphieuctcha = ceil($a['idphieuctcha']);
	$numdongvanghangdayybmtl = ceil($a['numdongvanghangdayybmtl']);

	// Get phiếu ct con Vàng % Dây Ý,... dựa trên id của phiếu cha là Hàng % Dây Ý,...
	$sqlphieuctvangdayybmtl = "SELECT * from $GLOBALS[db_sp].vangcucn_khovangcucnct where idcthangdayybmtl=".$idphieuctcha;
	$rsphieuctvangdayybmtl = $GLOBALS['sp']->getRow($sqlphieuctvangdayybmtl);

	if($rsphieuctvangdayybmtl['id'] > 0) {
		if($rsphieuctvangdayybmtl['idloaivang'] == 19) { // = 19 => là VNĐ
			$autoNumericFormat = "autoNumeric0";
			$autoNumericFormatTuoiVang = "autoNumeric0";
			$readOnlyTuoiVang = '';
			$pointerClass = '';
		} else {
			$autoNumericFormat = "autoNumeric3";
			$autoNumericFormatTuoiVang = "autoNumeric4";
			$readOnlyTuoiVang = 'readonly="readonly"';
			$pointerClass = 'pointer';
		}
		$str = '
			<tr id="rowvangchildhangdayybmtl'.$numdongvanghangdayybmtl.'">
				<td align="center" class="vang">
					<input type="hidden" name="numdongvangchildhangdayybmtl[]" id="numdongvangchildhangdayybmtl'.$numdongvanghangdayybmtl.'" value="'.$numdongvanghangdayybmtl.'" />
					<input type="hidden" name="idctnxvangchildhangdayybmtl[]" id="idctnxvangchildhangdayybmtl'.$numdongvanghangdayybmtl.'" value="'.$rsphieuctvangdayybmtl['id'].'" />
					<input type="hidden" name="idcthangdayybmtl[]" value="'.$rsphieuctvangdayybmtl['idcthangdayybmtl'].'" readonly="readonly" />
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="noidunghangcuchildhangdayybmtl[]" id="noidunghangcuchildhangdayybmtl'.$numdongvanghangdayybmtl.'" value="'.$rsphieuctvangdayybmtl['noidunghangcu'].'" class="txtdatagirld"/>
				</td>
				<td align="left" class="vang">
					<input type="hidden" name="nhomnguyenlieuvangchildhangdayybmtl[]" id="nhomnguyenlieuvangchildhangdayybmtl'.$numdongvanghangdayybmtl.'" value="'.$rsphieuctvangdayybmtl['nhomnguyenlieuvang'].'" />
					'.getName('categories', 'name_vn', $rsphieuctvangdayybmtl['nhomnguyenlieuvang']).'
				</td>
				<td align="left" class="vang">
					'.loadSelectTenNguyenLieuVangDayYBMTLKhoVangCuCN($numdongvanghangdayybmtl, $rsphieuctvangdayybmtl['tennguyenlieuvang'], $rsphieuctvangdayybmtl['nhomnguyenlieuvang']).'
				</td>
				<td align="left" class="vang" id="cotloaivanghangdayybmtl'.$numdongvanghangdayybmtl.'">
					'.loadLoaiVangDayYBanMonTraLaiKhoVangCuCN($rsphieuctvangdayybmtl['nhomnguyenlieuvang'], $rsphieuctvangdayybmtl['tennguyenlieuvang'], $rsphieuctvangdayybmtl['idloaivang'], $numdongvanghangdayybmtl).'
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannangvhhangdayybmtl[]" id="cannangvhhangdayybmtl'.$numdongvanghangdayybmtl.'" class="txtdatagirld text-right '.$autoNumericFormat.'" value="'.$rsphieuctvangdayybmtl['cannangvhluu'].'" onchange="getCanNangVangDayYBanMonTraLaiKhoVangCuCN('.$numdongvanghangdayybmtl.')"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannanghhangdayybmtl[]" id="cannanghhangdayybmtl'.$numdongvanghangdayybmtl.'" class="txtdatagirld text-right '.$autoNumericFormat.'" value="'.$rsphieuctvangdayybmtl['cannanghluu'].'" onchange="getCanNangVangDayYBanMonTraLaiKhoVangCuCN('.$numdongvanghangdayybmtl.')"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannangvhangdayybmtl[]" id="cannangvhangdayybmtl'.$numdongvanghangdayybmtl.'" class="txtdatagirld text-right pointer '.$autoNumericFormat.'" value="'.$rsphieuctvangdayybmtl['cannangvluu'].'" onchange="getVangQ10DayYBanMonTraLaiKhoVangCuCN('.$numdongvanghangdayybmtl.')" readonly="readonly"/>
				</td>
				<td width="10%" style="text-align: right;" class="vang" id="cottuoivanghangdayybmtl'.$numdongvanghangdayybmtl.'">
					<input type="text" '.$readOnlyTuoiVang.' name="tuoivanghangdayybmtl[]" id="tuoivanghangdayybmtl'.$numdongvanghangdayybmtl.'" value="'.$rsphieuctvangdayybmtl['tuoivangluu'].'" class="txtdatagirld text-right '.$autoNumericFormatTuoiVang.' '.$pointerClass.'" onchange="getVangQ10DayYBanMonTraLaiKhoVangCuCN('.$numdongvanghangdayybmtl.')"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="vangqui10hangdayybmtl[]" id="vangqui10hangdayybmtl'.$numdongvanghangdayybmtl.'" class="txtdatagirld text-right pointer autoNumeric3" value="'.$rsphieuctvangdayybmtl['vangqui10luu'].'" readonly="readonly"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="ghichuvanghangdayybmtl[]" id="ghichuvanghangdayybmtl'.$numdongvanghangdayybmtl.'" value="'.$rsphieuctvangdayybmtl['ghichuvang'].'" class="txtdatagirld"/>
				</td>
			</tr> 
		';
		return $str;				
	}
}

// M.Tân thêm ngày 19/11/2021 - insert load các phiếu vàng % KC Bán Món sinh ra từ Hàng % KC Bán Món - Phần nhập kho trước nấu của Kho Vàng Cũ CN
function insert_loadRowVangKCBanMonKhoVangCuCN($a) {
	$idphieuctcha = ceil($a['idphieuctcha']);
	$numdongvanghangkcbanmon = ceil($a['numdongvanghangkcbanmon']);

	// Get phiếu ct con Vàng % KC Bán Món dựa trên id của phiếu cha là Hàng % KC Bán Món
	$sqlphieuctvangkcbanmon = "SELECT * from $GLOBALS[db_sp].vangcucn_khovangcucnct where idcthangkcbanmon=".$idphieuctcha;
	$rsphieuctvangkcbanmon = $GLOBALS['sp']->getRow($sqlphieuctvangkcbanmon);

	if($rsphieuctvangkcbanmon['id'] > 0) {
		if($rsphieuctvangkcbanmon['idloaivang'] == 19) { // = 19 => là VNĐ
			$autoNumericFormat = "autoNumeric0";
			$autoNumericFormatTuoiVang = "autoNumeric0";
			$readOnlyTuoiVang = '';
			$pointerClass = '';
		} else {
			$autoNumericFormat = "autoNumeric3";
			$autoNumericFormatTuoiVang = "autoNumeric4";
			$readOnlyTuoiVang = 'readonly="readonly"';
			$pointerClass = 'pointer';
		}
		$str = '
			<tr id="rowvangchildhangkcbanmon'.$numdongvanghangkcbanmon.'">
				<td align="center" class="vang">
					<input type="hidden" name="numdongvangchildhangkcbanmon[]" id="numdongvangchildhangkcbanmon'.$numdongvanghangkcbanmon.'" value="'.$numdongvanghangkcbanmon.'" />
					<input type="hidden" name="idctnxvangchildhangkcbanmon[]" id="idctnxvangchildhangkcbanmon'.$numdongvanghangkcbanmon.'" value="'.$rsphieuctvangkcbanmon['id'].'" />
					<input type="hidden" name="idcthangkcbanmon[]" value="'.$rsphieuctvangkcbanmon['idcthangkcbanmon'].'" readonly="readonly" />
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="noidunghangcuchildhangkcbanmon[]" id="noidunghangcuchildhangkcbanmon'.$numdongvanghangkcbanmon.'" value="'.$rsphieuctvangkcbanmon['noidunghangcu'].'" class="txtdatagirld"/>
				</td>
				<td align="left" class="vang">
					<input type="hidden" name="nhomnguyenlieuvangchildhangkcbanmon[]" id="nhomnguyenlieuvangchildhangkcbanmon'.$numdongvanghangkcbanmon.'" value="'.$rsphieuctvangkcbanmon['nhomnguyenlieuvang'].'" />
					'.getName('categories', 'name_vn', $rsphieuctvangkcbanmon['nhomnguyenlieuvang']).'
				</td>
				<td align="left" class="vang">
					'.loadSelectTenNguyenLieuVangKCBanMonKhoVangCuCN($numdongvanghangkcbanmon, $rsphieuctvangkcbanmon['tennguyenlieuvang'], $rsphieuctvangkcbanmon['nhomnguyenlieuvang']).'
				</td>
				<td align="left" class="vang" id="cotloaivanghangkcbanmon'.$numdongvanghangkcbanmon.'">
					'.loadLoaiVangKCBanMonKhoVangCuCN($rsphieuctvangkcbanmon['nhomnguyenlieuvang'], $rsphieuctvangkcbanmon['tennguyenlieuvang'], $rsphieuctvangkcbanmon['idloaivang'], $numdongvanghangkcbanmon).'
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannangvhhangkcbanmon[]" id="cannangvhhangkcbanmon'.$numdongvanghangkcbanmon.'" class="txtdatagirld text-right '.$autoNumericFormat.'" value="'.$rsphieuctvangkcbanmon['cannangvhluu'].'" onchange="getCanNangVangKCBanMonKhoVangCuCN('.$numdongvanghangkcbanmon.')"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannanghhangkcbanmon[]" id="cannanghhangkcbanmon'.$numdongvanghangkcbanmon.'" class="txtdatagirld text-right '.$autoNumericFormat.'" value="'.$rsphieuctvangkcbanmon['cannanghluu'].'" onchange="getCanNangVangKCBanMonKhoVangCuCN('.$numdongvanghangkcbanmon.')"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannangvhangkcbanmon[]" id="cannangvhangkcbanmon'.$numdongvanghangkcbanmon.'" class="txtdatagirld text-right pointer '.$autoNumericFormat.'" value="'.$rsphieuctvangkcbanmon['cannangvluu'].'" onchange="getVangQ10KCBanMonKhoVangCuCN('.$numdongvanghangkcbanmon.')" readonly="readonly"/>
				</td>
				<td width="10%" style="text-align: right;" class="vang" id="cottuoivanghangkcbanmon'.$numdongvanghangkcbanmon.'">
					<input type="text" '.$readOnlyTuoiVang.' name="tuoivanghangkcbanmon[]" id="tuoivanghangkcbanmon'.$numdongvanghangkcbanmon.'" value="'.$rsphieuctvangkcbanmon['tuoivangluu'].'" class="txtdatagirld text-right '.$autoNumericFormatTuoiVang.' '.$pointerClass.'" onchange="getVangQ10KCBanMonKhoVangCuCN('.$numdongvanghangkcbanmon.')"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="vangqui10hangkcbanmon[]" id="vangqui10hangkcbanmon'.$numdongvanghangkcbanmon.'" class="txtdatagirld text-right pointer autoNumeric3" value="'.$rsphieuctvangkcbanmon['vangqui10luu'].'" readonly="readonly"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="ghichuvanghangkcbanmon[]" id="ghichuvanghangkcbanmon'.$numdongvanghangkcbanmon.'" value="'.$rsphieuctvangkcbanmon['ghichuvang'].'" class="txtdatagirld"/>
				</td>
			</tr> 
		';
		return $str;				
	}
}

// M.Tân thêm ngày 01/08/2023 - insert load các phiếu vàng sinh ra từ vàng có Nhóm nguyên liệu mặc định nhập liệu 2 dòng - Phần nhập kho trước nấu của Kho Vàng Cũ CN
function insert_loadRowVangSinh1DongKhoVangCuCN($a) {
	$idphieuctcha = ceil($a['idphieuctcha']);
	$numdongvangsinh1dong = ceil($a['numdongvangsinh1dong']);

	// Get phiếu ct vàng con dựa trên id của phiếu cha là vàng Nhóm nguyên liệu mặc định nhập liệu 2 dòng
	$sqlphieuctvangsinh1dong = "SELECT * from $GLOBALS[db_sp].vangcucn_khovangcucnct where idctvangsinh1dong=".$idphieuctcha;
	$rsphieuctvangsinh1dong = $GLOBALS['sp']->getRow($sqlphieuctvangsinh1dong);

	if($rsphieuctvangsinh1dong['id'] > 0) {
		if($rsphieuctvangsinh1dong['idloaivang'] == 19) { // = 19 => là VNĐ
			$autoNumericFormat = "autoNumeric0";
			$autoNumericFormatTuoiVang = "autoNumeric0";
			// $readOnlyTuoiVang = '';
			// $pointerClass = '';
		} else {
			$autoNumericFormat = "autoNumeric3";
			$autoNumericFormatTuoiVang = "autoNumeric4";
			// $readOnlyTuoiVang = 'readonly="readonly"';
			// $pointerClass = 'pointer';
		}
		$str = '
			<tr id="rowvangchildsinh1dong'.$numdongvangsinh1dong.'">
				<td align="center" class="vang">
					<input type="hidden" name="numdongvangchildsinh1dong[]" id="numdongvangchildsinh1dong'.$numdongvangsinh1dong.'" value="'.$numdongvangsinh1dong.'" />
					<input type="hidden" name="idctnxvangchildsinh1dong[]" id="idctnxvangchildsinh1dong'.$numdongvangsinh1dong.'" value="'.$rsphieuctvangsinh1dong['id'].'" />
					<input type="hidden" name="idctvangsinh1dong[]" value="'.$rsphieuctvangsinh1dong['idctvangsinh1dong'].'" readonly="readonly" />
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="noidunghangcuchildsinh1dong[]" id="noidunghangcuchildsinh1dong'.$numdongvangsinh1dong.'" value="'.$rsphieuctvangsinh1dong['noidunghangcu'].'" class="txtdatagirld"/>
				</td>
				<td align="left" class="vang">
					<input type="hidden" name="nhomnguyenlieuvangchildsinh1dong[]" id="nhomnguyenlieuvangchildsinh1dong'.$numdongvangsinh1dong.'" value="'.$rsphieuctvangsinh1dong['nhomnguyenlieuvang'].'" />
					'.getName('categories', 'name_vn', $rsphieuctvangsinh1dong['nhomnguyenlieuvang']).'
				</td>
				<td align="left" class="vang">
					<input type="hidden" name="tennguyenlieuvangchildsinh1dong[]" id="tennguyenlieuvangchildsinh1dong'.$numdongvangsinh1dong.'" value="'.$rsphieuctvangsinh1dong['tennguyenlieuvang'].'" />
					'.getName('categories', 'name_vn', $rsphieuctvangsinh1dong['tennguyenlieuvang']).'
				</td>
				<td align="left" class="vang" id="cotloaivangsinh1dong'.$numdongvangsinh1dong.'">
					<input type="hidden" autocomplete="off" name="idloaivangsinh1dong[]" id="idloaivangsinh1dong'.$numdongvangsinh1dong.'" class="txtdatagirld" value="'.$rsphieuctvangsinh1dong['idloaivang'].'" readonly="readonly" />
					'.getName("loaivang","name_vn",$rsphieuctvangsinh1dong['idloaivang']).'
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannangvhsinh1dong[]" id="cannangvhsinh1dong'.$numdongvangsinh1dong.'" class="txtdatagirld text-right '.$autoNumericFormat.'" value="'.$rsphieuctvangsinh1dong['cannangvhluu'].'" onchange="getCanNangVangSinh1DongKhoVangCuCN('.$numdongvangsinh1dong.')"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannanghsinh1dong[]" id="cannanghsinh1dong'.$numdongvangsinh1dong.'" class="txtdatagirld text-right '.$autoNumericFormat.'" value="'.$rsphieuctvangsinh1dong['cannanghluu'].'" onchange="getCanNangVangSinh1DongKhoVangCuCN('.$numdongvangsinh1dong.')"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannangvsinh1dong[]" id="cannangvsinh1dong'.$numdongvangsinh1dong.'" class="txtdatagirld text-right pointer '.$autoNumericFormat.'" value="'.$rsphieuctvangsinh1dong['cannangvluu'].'" onchange="getVangQ10Sinh1DongKhoVangCuCN('.$numdongvangsinh1dong.')" readonly="readonly"/>
				</td>
				<td width="10%" style="text-align: right;" class="vang" id="cottuoivangsinh1dong'.$numdongvangsinh1dong.'">
					<input type="text" readonly="readonly" name="tuoivangsinh1dong[]" id="tuoivangsinh1dong'.$numdongvangsinh1dong.'" value="'.$rsphieuctvangsinh1dong['tuoivangluu'].'" class="txtdatagirld text-right '.$autoNumericFormatTuoiVang.' pointer" onchange="getVangQ10Sinh1DongKhoVangCuCN('.$numdongvangsinh1dong.')"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="vangqui10sinh1dong[]" id="vangqui10sinh1dong'.$numdongvangsinh1dong.'" class="txtdatagirld text-right pointer autoNumeric3" value="'.$rsphieuctvangsinh1dong['vangqui10luu'].'" readonly="readonly"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="ghichuvangsinh1dong[]" id="ghichuvangsinh1dong'.$numdongvangsinh1dong.'" value="'.$rsphieuctvangsinh1dong['ghichuvang'].'" class="txtdatagirld"/>
				</td>
			</tr> 
		';
		return $str;				
	}
}

// M.Tân thêm ngày 11/09/2020 load select option chọn loai vàng % Dây Ý, Bán Món, Trả Lại của Kho Vàng Cũ CN 
function loadLoaiVangDayYBanMonTraLaiKhoVangCuCN($idnhomnguyenlieuvang,$idtennguyenlieuvang,$idloaivang,$idnum){
	global $path_url;
	
	if($idnhomnguyenlieuvang > 0 && $idtennguyenlieuvang > 0) {
		// Load cột loadtheoloaivang để lấy ra text id các loaivang của tên nguyên liệu này
		$sqltextidloaivang = "SELECT loadtheoloaivang from $GLOBALS[db_sp].categories where id=".$idtennguyenlieuvang;
		$textidloaivang = $GLOBALS['sp']->getOne($sqltextidloaivang);

		// Lấy ra danh sách các loaivang thuộc textidloaivang này
		if($textidloaivang == '' || $textidloaivang == NULL) { // Load ra hết tất cả loại vàng
			$sqlloaivang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
			$rsloaivang = $GLOBALS["sp"]->getAll($sqlloaivang);

			foreach($rsloaivang as $item){
				if($idloaivang == $item['id'])
					$checked = "selected";
				else
					$checked = ""; 
				$str .= "<option ".$checked." value='".$item['id']."' > ".$item['name_vn']."  </option>";
			}

			$str = '
					<select style="width: 140px;" id="idloaivanghangdayybmtl'.$idnum.'" name="idloaivanghangdayybmtl[]" onChange="checkLoaiVangLoadTuoiVangHangDayYBanMonTraLai('.$idnum.', '.$idnhomnguyenlieuvang.')" >
						<option value="">--Chọn loại vàng--</option>
						'.$str.'
					</select>
				';
		} else { // Load ra các loại vàng ứng với textidloaivang của tên nguyên liệu này
			$sqlloaivang = "select * from $GLOBALS[db_sp].loaivang where id in (".$textidloaivang.") and active=1 order by num asc, id asc";
			
			$sqlcountidloaivang = "select count(id) from $GLOBALS[db_sp].loaivang where id in (".$textidloaivang.") and active=1 order by num asc, id asc"; 
			$countidloaivang = ceil($GLOBALS['sp']->getOne($sqlcountidloaivang));
			
			if($countidloaivang > 1) { // Có nhiều hơn 1 loại vàng ứng với tên nguyên liệu này => load ra select của các loaivang này
				$rsloaivang = $GLOBALS["sp"]->getAll($sqlloaivang);
				// print_r($rsloaivang); die();

				foreach($rsloaivang as $item){
					if($idloaivang == $item['id'])
						$checked = "selected";
					else
						$checked = "";  
					$str .= "<option ".$checked." value='".$item['id']."' > ".$item['name_vn']."  </option>";
				}
	
				$str = '
						<select style="width: 140px;" id="idloaivanghangdayybmtl'.$idnum.'" name="idloaivanghangdayybmtl[]" onChange="checkLoaiVangLoadTuoiVangHangDayYBanMonTraLai('.$idnum.', '.$idnhomnguyenlieuvang.')" >
							<option value="">--Chọn loại vàng--</option>
							'.$str.'
						</select>
					';
			} else { // Chỉ có 1 loại vàng ứng với tên nguyên liệu này => load ra loaivang này luôn, không load select
				$rsloaivang = $GLOBALS["sp"]->getRow($sqlloaivang);
				// print_r($rsloaivang); die();

				$str = '
						'.getName("loaivang","name_vn",$rsloaivang['id']).'
						<input type="hidden" autocomplete="off" name="idloaivanghangdayybmtl[]" id="idloaivanghangdayybmtl'.$idnum.'" class="txtdatagirld" value="'.$rsloaivang['id'].'" onChange="checkLoaiVangLoadTuoiVangHangDayYBanMonTraLai('.$idnum.', '.$idnhomnguyenlieuvang.')" readonly="readonly" />
					';
			}
		}
	}
	return $str;
}

// M.Tân thêm ngày 18/11/2021 load select option chọn loai vàng % KC Bán Món của Kho Vàng Cũ CN 
function loadLoaiVangKCBanMonKhoVangCuCN($idnhomnguyenlieuvang,$idtennguyenlieuvang,$idloaivang,$idnum){
	global $path_url;
	
	if($idnhomnguyenlieuvang > 0 && $idtennguyenlieuvang > 0) {
		// Load cột loadtheoloaivang để lấy ra text id các loaivang của tên nguyên liệu này
		$sqltextidloaivang = "SELECT loadtheoloaivang from $GLOBALS[db_sp].categories where id=".$idtennguyenlieuvang;
		$textidloaivang = $GLOBALS['sp']->getOne($sqltextidloaivang);

		// Lấy ra danh sách các loaivang thuộc textidloaivang này
		if($textidloaivang == '' || $textidloaivang == NULL) { // Load ra hết tất cả loại vàng
			$sqlloaivang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
			$rsloaivang = $GLOBALS["sp"]->getAll($sqlloaivang);

			foreach($rsloaivang as $item){
				if($idloaivang == $item['id'])
					$checked = "selected";
				else
					$checked = ""; 
				$str .= "<option ".$checked." value='".$item['id']."' > ".$item['name_vn']."  </option>";
			}

			$str = '
					<select style="width: 140px;" id="idloaivanghangkcbanmon'.$idnum.'" name="idloaivanghangkcbanmon[]" onChange="checkLoaiVangLoadTuoiVangHangKCBanMon('.$idnum.', '.$idnhomnguyenlieuvang.')" >
						<option value="">--Chọn loại vàng--</option>
						'.$str.'
					</select>
				';
		} else { // Load ra các loại vàng ứng với textidloaivang của tên nguyên liệu này
			$sqlloaivang = "select * from $GLOBALS[db_sp].loaivang where id in (".$textidloaivang.") and active=1 order by num asc, id asc";
			
			$sqlcountidloaivang = "select count(id) from $GLOBALS[db_sp].loaivang where id in (".$textidloaivang.") and active=1 order by num asc, id asc"; 
			$countidloaivang = ceil($GLOBALS['sp']->getOne($sqlcountidloaivang));
			
			if($countidloaivang > 1) { // Có nhiều hơn 1 loại vàng ứng với tên nguyên liệu này => load ra select của các loaivang này
				$rsloaivang = $GLOBALS["sp"]->getAll($sqlloaivang);
				// print_r($rsloaivang); die();

				foreach($rsloaivang as $item){
					if($idloaivang == $item['id'])
						$checked = "selected";
					else
						$checked = "";  
					$str .= "<option ".$checked." value='".$item['id']."' > ".$item['name_vn']."  </option>";
				}
	
				$str = '
						<select style="width: 140px;" id="idloaivanghangkcbanmon'.$idnum.'" name="idloaivanghangkcbanmon[]" onChange="checkLoaiVangLoadTuoiVangHangKCBanMon('.$idnum.', '.$idnhomnguyenlieuvang.')" >
							<option value="">--Chọn loại vàng--</option>
							'.$str.'
						</select>
					';
			} else { // Chỉ có 1 loại vàng ứng với tên nguyên liệu này => load ra loaivang này luôn, không load select
				$rsloaivang = $GLOBALS["sp"]->getRow($sqlloaivang);
				// print_r($rsloaivang); die();

				$str = '
						'.getName("loaivang","name_vn",$rsloaivang['id']).'
						<input type="hidden" autocomplete="off" name="idloaivanghangkcbanmon[]" id="idloaivanghangkcbanmon'.$idnum.'" class="txtdatagirld" value="'.$rsloaivang['id'].'" onChange="checkLoaiVangLoadTuoiVangHangKCBanMon('.$idnum.', '.$idnhomnguyenlieuvang.')" readonly="readonly" />
					';
			}
		}
	}
	return $str;
}

// M.Tân thêm ngày 06/10/2020 - load Edit cho Kim Cương Tấm sau nấu kho Vàng Cũ CN
function insert_loadEditKimCuongTamSauNauKhoVangCuCN($a) {
	$id = ceil(trim($a['id']));

	if($id > 0) {
		// Get phiếu kim cương tấm
		$sqlphieukimcuongtam = "select * from $GLOBALS[db_sp].vangcucn_khovangcucnct where id=".$id;
		$rsphieukimcuongtam = $GLOBALS["sp"]->getRow($sqlphieukimcuongtam);

		$qui10nhaptucn = round(($rsphieukimcuongtam['thanhtienmualaikctam'] / $rsphieukimcuongtam['giachuankctam']),3);
		// $qui10nhapkho = round(($rsphieukimcuongtam['tongthanhtienvonchuarakctam'] / $rsphieukimcuongtam['giachuankctam']),3);

		$str = '
			<div class="table2scroll">
				<table style="width: 100% !important; height: 100%" border="1" id="addRowGirlKimCuongTamSauNau'.$id.'" class="kimcuongtam">
					<tr class="trheader">
						<td align="center" colspan="5" style="border-bottom: none;">
							<strong>Chi Tiết Hột Đã Rã</strong>
						</td>
						<td align="center" rowspan="2">
							<strong>Thành Tiền Vốn (Đã Rã)</strong>
						</td>
						<td align="center" rowspan="2">
							<strong>Giá Mua 9999</strong>
						</td>
						<td align="center" rowspan="2">
							<strong>Qui 10 Vốn (Đã Rã)</strong>
						</td>
						<td align="center" rowspan="2">
							<strong>Chênh Lệch Lỗ (Mua Lại)</strong>
						</td>
					</tr>
					<tr class="trheader">
						<td width="10%" align="center">
							<strong>Size</strong>
						</td>
						<td width="10%" align="center">
							<strong>Số Lượng</strong>
						</td>
						<td width="15%" align="center">
							<strong>Cân Nặng CT Theo Từng Size</strong>
						</td>
						<td width="15%" align="center">
							<strong>Ghi Chú</strong>
						</td>
						<td align="center">
							<strong>Giá Gốc (VNĐ)</strong>
						</td>
					</tr>
					<tr id="rowTongValueKimCuongTamSauNau'.$id.'" class="PagingTong">
						<td align="right"><strong style="color: #307ecc;">TỔNG</strong></td>
						<td align="center">
							<input type="text" autocomplete="off" name="tongslhotdarakctam" id="tongslhotdarakctam'.$id.'" class="txtdatagirld text-right autoNumeric0 pointer" value="'.$rsphieukimcuongtam['tongslhotdarakctam'].'" readonly="readonly"/>
						</td>
						<td align="center">
							<input type="text" autocomplete="off" name="tongcannangctdarakctam" id="tongcannangctdarakctam'.$id.'" class="txtdatagirld text-right autoNumeric3 pointer" value="'.$rsphieukimcuongtam['tongcannangctdarakctam'].'" readonly="readonly"/>
						</td>
						<td align="center"></td>
						<td align="center"></td>
						<td align="center"> 
							<input type="text" autocomplete="off" name="tongthanhtienvondarakctam" id="tongthanhtienvondarakctam'.$id.'" class="txtdatagirld text-right autoNumeric0 pointer" value="'.$rsphieukimcuongtam['tongthanhtienvondarakctam'].'" readonly="readonly"/>
						</td>
						<td align="left">
							<input type="text" autocomplete="off" name="giachuankctam" id="giachuankctam'.$id.'" class="txtdatagirld text-right autoNumeric0 pointer" value="'.$rsphieukimcuongtam['giachuankctam'].'" readonly/>
						</td>
						<td align="left">
							<input type="text" autocomplete="off" name="tongtlqui10vondarakctam" id="tongtlqui10vondarakctam'.$id.'" class="txtdatagirld text-right autoNumeric3 pointer" value="'.$rsphieukimcuongtam['tongtlqui10vondarakctam'].'" onchange="" readonly="readonly"/>
							<input type="hidden" autocomplete="off" name="qui10nhaptucn" id="qui10nhaptucn'.$id.'" class="txtdatagirld text-right autoNumeric3 pointer" value="'.$qui10nhaptucn.'" readonly="readonly"/>
							<input type="hidden" autocomplete="off" name="qui10nhapkho" id="qui10nhapkho'.$id.'" class="txtdatagirld text-right autoNumeric3 pointer" value="'.$qui10nhapkho.'" readonly="readonly"/>
							<input type="hidden" autocomplete="off" name="idmasomaukimcuongtam" id="idmasomaukimcuongtam'.$id.'" class="txtdatagirld text-right pointer" value="'.$rsphieukimcuongtam['idmasomaukimcuongtam'].'" readonly="readonly"/>
						</td>
						<td align="left">
							<input type="text" autocomplete="off" name="chenhlechlomualaikctam" id="chenhlechlomualaikctam'.$id.'" class="txtdatagirld text-right autoNumeric3 pointer" value="'.$rsphieukimcuongtam['chenhlechlokctammualai'].'" onchange="" readonly="readonly"/>
						</td>       
					</tr>
				</table>
				<div class="addRowGirlMain">
					<a href="javascript:void(0)" onclick="addNewRowGirlKimCuongTamSauNauKhoVangCuCN('.$id.')" class="addRowGirl" id="btnAddRowGridKimCuongTam"> 
						<strong>Thêm dòng</strong> 
					</a>
            	</div>
			</div>
		';
		return $str;
	}
}

// M.Tân thêm ngày 13/10/2020 - function hạch toán hột theo size kim cương tấm cho kho Vàng Cũ Chi Nhánh
function ghiSoHachToanHotTheoSizeKCTamKhoVangCuChiNhanh($tablehachtoan, $tablenhan, $id, $typehachtoan){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	
	// Get row hột kim cương tấm này
	$item = getTableRow($tablenhan,' and id='.$id); 
	//print_r($item); die($tablenhan);
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day = array();
	
	$slnhaphotkctamrc = $slxuathotkctamrc = $cannangnhaphotkctamrc = $cannangxuathotkctamrc = 0;
	$slnhaphotkctam = $slxuathotkctam = $sltonhotkctam = $cannangnhaphotkctam = $cannangxuathotkctam = $cannangtonhotkctam = 0;
	
	if($typehachtoan =='nhapkho'){//xác nhận hạch toán table mới luôn là nhập kho
		$item['type'] = 1;
	}
	if($typehachtoan =='xuatkho'){//xác nhận hạch toán table mới luôn là xuất kho
		$item['type'] = 2;
	}
	
	if($item['type']==1){ //số lượng nhập
		$slnhaphotkctamrc = $item['slhotkctam'];
		$cannangnhaphotkctamrc = $item['cannangctkctam'];	
	}
	else{ // số lượng xuất
		$slxuathotkctamrc = $item['slhotkctam'];
		$cannangxuathotkctamrc = $item['cannangctkctam'];
	}
	
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and sizehotkctam='".trim($item['sizehotkctam'])."'";	
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){ // chưa có dated trong csdl ".$tablehachtoan." thì insert vào (kiểm tra từng ngày) // hạch toán trong tháng
		//////////lấy số lượng tồn của ngày cuối cùng lớn nhất vd: khoachin_sodudauky
		$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where sizehotkctam='".trim($item['sizehotkctam'])."' order by dated desc limit 1"; /// lấy ngày cuối cùng
		$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
	
		if($rstru1day['id'] > 0){
			$sltonhotkctam = $rstru1day['soluongton'];
			$cannangtonhotkctam = $rstru1day['cannangton'];
		}
		
		$sltonhotkctam = round(round(($sltonhotkctam + $slnhaphotkctamrc),3) - $slxuathotkctamrc,3);
		$cannangtonhotkctam = round(round(($cannangtonhotkctam + $cannangnhaphotkctamrc),3) - $cannangxuathotkctamrc,3);
		
		$arrnx1day['soluongton'] = $sltonhotkctam;
		$arrnx1day['soluongnhap'] = $slnhaphotkctamrc;
		$arrnx1day['soluongxuat'] = $slxuathotkctamrc;
		$arrnx1day['cannangton'] = $cannangtonhotkctam;
		$arrnx1day['cannangnhap'] = $cannangnhaphotkctamrc;
		$arrnx1day['cannangxuat'] = $cannangxuathotkctamrc;
		
		$arrnx1day['sizehotkctam'] = trim($item['sizehotkctam']);
		$arrnx1day['dated'] = $datedauthang;

		vaInsert($tablehachtoan,$arrnx1day);
	}
	else { // có rồi thi update vào sodudauky
		$slnhaphotkctam = round(($rsdate['soluongnhap'] + $slnhaphotkctamrc),3);
		$slxuathotkctam = round(($rsdate['soluongxuat'] + $slxuathotkctamrc),3);
		$sltonhotkctam = round(round(($rsdate['soluongton'] + $slnhaphotkctamrc),3) - $slxuathotkctamrc,3);
		$cannangnhaphotkctam = round(($rsdate['cannangnhap'] + $cannangnhaphotkctamrc),3);
		$cannangxuathotkctam = round(($rsdate['cannangxuat'] + $cannangxuathotkctamrc),3);
		$cannangtonhotkctam = round(round(($rsdate['cannangton'] + $cannangnhaphotkctamrc),3) - $cannangxuathotkctamrc,3);
								
		$arrnx1day['soluongnhap'] = $slnhaphotkctam;
		$arrnx1day['soluongxuat'] = $slxuathotkctam;
		$arrnx1day['soluongton'] = $sltonhotkctam;
		$arrnx1day['cannangnhap'] = $cannangnhaphotkctam;
		$arrnx1day['cannangxuat'] = $cannangxuathotkctam;
		$arrnx1day['cannangton'] = $cannangtonhotkctam;
	
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
	}		
}

// M.Tân thêm ngày 03/11/2020 - Thống kê tồn kho theo size Kim Cương Tấm Kho Vàng Cũ Chi Nhánh
function insert_thongKeTonKhoKimCuongTamKhoKhacKhoVangCuCN($a){
	$arrlist = array();
	$sqlktsizehotkctam = $rsktsizehotkctam = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt = $sqlnhap = $rsnhap = $sqlxuatkhosx = $rsxuatkhosx = $sqlxuatkhohotxau = $rsxuatkhohotxau = $sqlxuatkhongnhapkho = $rsxuatkhongnhapkho = '';
	$slton = $cannangton = $sltonsddk = $cannangtonsddk = $slnhap = $slxuat = $sltontndt = $cannangtontndt = $sltontndn = $cannangtontndn =  0;

	$sizehotkctam = trim($a['sizehotkctam']);
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];	
	$datenow = date("Y-m-d");

	if(!empty($fromDate)){
		$fromDate = explode('/',$fromDate);
		$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
		$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
	} else {
		$fromDate = date("d/m/Y");
		$fromDate = explode('/',$fromDate);
		$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
		$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
	}
	if(!empty($toDate)){			
		$toDate = explode('/',$toDate);
		$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
	} else {
		$toDate = date("d/m/Y");
		$toDate = explode('/',$toDate);
		$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
	}
	if($sizehotkctam != ''){
		// Kiểm tra sizehotkctam đó có nhập trong kho không
		$sqlktsizehotkctam = "select * from $GLOBALS[db_sp].vangcucn_khovangcucnct_kimcuongtam where type=1 and trangthai=2 and   sizehotkctam='".$sizehotkctam."' limit 1";
		$rsktsizehotkctam = $GLOBALS['sp']->getRow($sqlktsizehotkctam);
		if(ceil($rsktsizehotkctam['id']) > 0){ // Có tồn tại sizehotkctam
			$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
			$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);			
			//					
			$sqltonsddk = "select * from $GLOBALS[db_sp].vangcucn_khovangcucn_sodudauky_hotkctam where sizehotkctam='".$sizehotkctam."' and dated <= '".$thangtruoc."' order by id desc limit 1";
			$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
			
			$sltonsddk = $rstonsddk['soluongton'];
			$cannangtonsddk = $rstonsddk['cannangton'];
			$thangdauky = $rstonsddk['dated'];

			// Get số lượng từ ngày đến đầu tháng
			$sqlnhaptndt = "select 	SUM(slhotkctam) as slnhaphotkctam,
									ROUND(SUM(cannangctkctam), 3) as cannangnhaphotkctam 
									from $GLOBALS[db_sp].vangcucn_khovangcucnct_kimcuongtam 
									where sizehotkctam='".$sizehotkctam."' 
									and type=1 
									and trangthai=2 
									and typera=1
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
			"; 
			$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);
			
			$sqlxuattndt = "select  SUM(slhotkctam) as slxuathotkctam,
									ROUND(SUM(cannangctkctam), 3) as cannangxuathotkctam 
									from $GLOBALS[db_sp].vangcucn_khovangcucnct_kimcuongtam 
									where sizehotkctam='".$sizehotkctam."' 
									and type=1 
									and trangthaixuat=2
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
			"; 
			$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
			
			$sltontndt = round(($rsnhaptndt['slnhaphotkctam'] - $rsxuattndt['slxuathotkctam']),3);
			$cannangtontndt = round(($rsnhaptndt['cannangnhaphotkctam'] - $rsxuattndt['cannangxuathotkctam']),3);
			$sltonsddk = round(($sltonsddk + $sltontndt),3);
			$cannangtonsddk = round(($cannangtonsddk + $cannangtontndt),3);

			// Get số lượng từ ngày đến ngày
			$sqlnhap = "select  SUM(slhotkctam) as slnhaphotkctam,
								ROUND(SUM(cannangctkctam), 3) as cannangnhaphotkctam
								from $GLOBALS[db_sp].vangcucn_khovangcucnct_kimcuongtam 
								where sizehotkctam='".$sizehotkctam."' 
								and type=1 
								and trangthai=2 
								and typera=1
								and dated >= '".$fromDate."'  
								and dated <= '".$toDate."' 
				"; 
			$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
			
			// Load các size hột xuất đến kho Kim Cương Tấm Sản Xuất
			$sqlxuatkhosx = "select SUM(slhotkctam) as slxuathotkctam,
									ROUND(SUM(cannangctkctam), 3) as cannangxuathotkctam 
									from $GLOBALS[db_sp].vangcucn_khovangcucnct_kimcuongtam
									where sizehotkctam='".$sizehotkctam."'
									and type=1 
									and trangthaixuat=2
									and idphieuxuat in (SELECT id FROM $GLOBALS[db_sp].vangcucn_khovangcucn WHERE TYPE=2 AND typevkc=3 AND idlydokctamxk=1)
									and datedxuat >= '".$fromDate."'  
									and datedxuat <= '".$toDate."' 
			"; 
			$rsxuatkhosx = $GLOBALS["sp"]->getRow($sqlxuatkhosx);	
			
			// Load các size hột xuất đến kho Kim Cương Tấm Xấu
			$sqlxuatkhohotxau = "select SUM(slhotkctam) as slxuathotkctam,
										ROUND(SUM(cannangctkctam), 3) as cannangxuathotkctam 
										from $GLOBALS[db_sp].vangcucn_khovangcucnct_kimcuongtam
										where sizehotkctam='".$sizehotkctam."'
										and type=1 
										and trangthaixuat=2
										and idphieuxuat in (SELECT id FROM $GLOBALS[db_sp].vangcucn_khovangcucn WHERE TYPE=2 AND typevkc=3 AND idlydokctamxk=2)
										and datedxuat >= '".$fromDate."'  
										and datedxuat <= '".$toDate."' 
			"; 
			$rsxuatkhohotxau = $GLOBALS["sp"]->getRow($sqlxuatkhohotxau);	

			// Load các size hột xuất không nhập kho, sản phẩm làm đồ chùi
			$sqlxuatkhongnhapkho = "select SUM(slhotkctam) as slxuathotkctam,
										ROUND(SUM(cannangctkctam), 3) as cannangxuathotkctam 
										from $GLOBALS[db_sp].vangcucn_khovangcucnct_kimcuongtam
										where sizehotkctam='".$sizehotkctam."'
										and type=1 
										and trangthaixuat=2
										and idphieuxuat in (SELECT id FROM $GLOBALS[db_sp].vangcucn_khovangcucn WHERE TYPE=2 AND typevkc=3 AND idlydokctamxk=3)
										and datedxuat >= '".$fromDate."'  
										and datedxuat <= '".$toDate."' 
			"; 
			$rsxuatkhongnhapkho = $GLOBALS["sp"]->getRow($sqlxuatkhongnhapkho);

			$sltontndn = round($rsnhap['slnhaphotkctam'] - (round(round($rsxuatkhosx['slxuathotkctam'] + $rsxuatkhohotxau['slxuathotkctam'],3) + $rsxuatkhongnhapkho['slxuathotkctam'],3)),3);
			$cannangtontndn = round($rsnhap['cannangnhaphotkctam'] - (round(round($rsxuatkhosx['cannangxuathotkctam'] + $rsxuatkhohotxau['cannangxuathotkctam'],3) + $rsxuatkhongnhapkho['cannangxuathotkctam'],3)),3);
			$slton = $sltonsddk + $sltontndn;
			$cannangton = $cannangtonsddk + $cannangtontndn;				
					
			$arrlist['slnhap'] = $rsnhap['slnhaphotkctam'];
			$arrlist['cannangnhap'] = $rsnhap['cannangnhaphotkctam'];
			$arrlist['slxuatkhosx'] = $rsxuatkhosx['slxuathotkctam'];
			$arrlist['cannangxuatkhosx'] = $rsxuatkhosx['cannangxuathotkctam'];
			$arrlist['slxuatkhohotxau'] = $rsxuatkhohotxau['slxuathotkctam'];
			$arrlist['cannangxuatkhohotxau'] = $rsxuatkhohotxau['cannangxuathotkctam'];
			$arrlist['slxuatkhongnhapkho'] = $rsxuatkhongnhapkho['slxuathotkctam'];
			$arrlist['cannangxuatkhongnhapkho'] = $rsxuatkhongnhapkho['cannangxuathotkctam'];
			
			$arrlist['slton'] = $slton;
			$arrlist['cannangton'] = $cannangton;
			$arrlist['sltonsddk'] = $sltonsddk;
			$arrlist['cannangtonsddk'] = $cannangtonsddk;
			
			// Get đơn giá vốn USD từ table thongsohottam
			$sqldongiausd = "select giagocusd from $GLOBALS[db_catalog].thongsohottam where size='".$sizehotkctam."'";
			$dongiausd = $GLOBALS['catalog']->getOne($sqldongiausd);
			
			$arrlist['dongiausd'] = $dongiausd;
			$arrlist['sizehotkctam'] = $sizehotkctam;
		}
	}
	else{
		$arrlist['sizehotkctam'] = '';	
	}
	return $arrlist;
}

//Mai thêm lấy categories cấp số 2
function getLoaiVangByCid($cid, &$strLoaiTheoLoaiVang){
	$sql = "select pid, loadtheoloaivang from $GLOBALS[db_sp].categories where id=$cid";
	$item = $GLOBALS["sp"]->getRow($sql);
	if($item['pid'] != 2 && empty($item['loadtheoloaivang'])){
		getLoaiVangByCid($item['pid'], $strLoaiTheoLoaiVang);
	}
	else if ($item['pid'] != 2 && !empty($item['loadtheoloaivang'])){
		$strLoaiTheoLoaiVang = $item['loadtheoloaivang'];
	}
	return $strLoaiTheoLoaiVang;
}

// M.Tân thêm ngày 03/01/2021 - Điều chỉnh số liệu hạch toán hao dư
function dieuChinhSoLieuHachToanHaoDu($tablehaodu,$tablehachtoan,$idloaivang) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateHD = $arrUpdateHDThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG HAO DƯ (CHÊNH LỆCH) DỰA TRÊN CÁC PHIẾU HAO DƯ ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongHaoDuTrongThang = "select ROUND(SUM(hao), 3) as hao, 
										  ROUND(SUM(du), 3) as du, 
										  ROUND(SUM(haochenhlech), 3) as haochenhlech, 
										  ROUND(SUM(duchenhlech), 3) as duchenhlech
										  from $GLOBALS[db_sp].".$tablehaodu." 
										  where idloaivang=".$idloaivang." and typeduyet=1
										  and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongHaoDuTrongThang = $GLOBALS['sp']->getRow($sqlTongHaoDuTrongThang);

		// Lấy ra tổng số lượng hao dư (chênh lệch) trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
		$sqlHDSDDKTrongThang = "select hao, du, haochenhlech, duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
		$rsHDSDDKTrongThang = $GLOBALS['sp']->getRow($sqlHDSDDKTrongThang);
		// So sánh số lượng hao dư (chênh lệch) trong sodudauky với tổng số lượng hao dư (chênh lệch) của các phiếu cộng lại
		if($rsTongHaoDuTrongThang['hao'] != $rsHDSDDKTrongThang['hao'] || $rsTongHaoDuTrongThang['du'] != $rsHDSDDKTrongThang['du'] || $rsTongHaoDuTrongThang['haochenhlech'] != $rsHDSDDKTrongThang['haochenhlech'] || $rsTongHaoDuTrongThang['duchenhlech'] != $rsHDSDDKTrongThang['duchenhlech']){
			$arrUpdateHD['hao'] = $rsTongHaoDuTrongThang['hao'];
			$arrUpdateHD['du'] = $rsTongHaoDuTrongThang['du'];
			$arrUpdateHD['haochenhlech'] = $rsTongHaoDuTrongThang['haochenhlech'];
			$arrUpdateHD['duchenhlech'] = $rsTongHaoDuTrongThang['duchenhlech'];
		}

		vaUpdate($tablehachtoan, $arrUpdateHD, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlTongHaoDuThangTiep = "select ROUND(SUM(hao), 3) as hao, 
											 ROUND(SUM(du), 3) as du, 
											 ROUND(SUM(haochenhlech), 3) as haochenhlech, 
											 ROUND(SUM(duchenhlech), 3) as duchenhlech
											 from $GLOBALS[db_sp].".$tablehaodu." 
											 where idloaivang=".$idloaivang." and typeduyet=1
											 and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
									";
			$rsTongHaoDuThangTiep = $GLOBALS['sp']->getRow($sqlTongHaoDuThangTiep);

			// Lấy ra tổng số lượng hao dư (chênh lệch) trong bảng sodudauky ứng với idloaivang (tháng tiếp theo) để so sánh
			$sqlHDSDDKThangTiep = "select hao, du, haochenhlech, duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTiep."'";
			$rsHDSDDKThangTiep = $GLOBALS['sp']->getRow($sqlHDSDDKThangTiep);
			// So sánh số lượng hao dư (chênh lệch) trong sodudauky với tổng số lượng hao dư (chênh lệch) của các phiếu cộng lại
			if($rsTongHaoDuThangTiep['hao'] != $rsHDSDDKThangTiep['hao'] || $rsTongHaoDuThangTiep['du'] != $rsHDSDDKThangTiep['du'] || $rsTongHaoDuThangTiep['haochenhlech'] != $rsHDSDDKThangTiep['haochenhlech'] || $rsTongHaoDuThangTiep['duchenhlech'] != $rsHDSDDKThangTiep['duchenhlech']){
				$arrUpdateHDThangTiep['hao'] = $rsTongHaoDuThangTiep['hao'];
				$arrUpdateHDThangTiep['du'] = $rsTongHaoDuThangTiep['du'];
				$arrUpdateHDThangTiep['haochenhlech'] = $rsTongHaoDuThangTiep['haochenhlech'];
				$arrUpdateHDThangTiep['duchenhlech'] = $rsTongHaoDuThangTiep['duchenhlech'];
			}

			vaUpdate($tablehachtoan, $arrUpdateHDThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');
		}
	}
}

// M.Tân thêm Điều chỉnh số liệu hạch toán hao dư giao nhận thợ mới
function dieuChinhSoLieuHachToanHaoDuGiaoNhanThoNew($tableHaoDuOld,$tableHachToan,$tableHaoDuGiaoNhanTho,$idloaivang) {
	$sql = "select * from $GLOBALS[db_sp].".$tableHachToan." where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);
	
	$tableHaoDuGiaoNhanThoCT = $tableHaoDuGiaoNhanTho.'ct';
	
	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateHD = $arrUpdateHDThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG HAO DƯ (CHÊNH LỆCH) DỰA TRÊN CÁC PHIẾU HAO DƯ ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ CỦA TABLE HAO DƯ CŨ (NẾU CÓ)
		$sqlTongHaoDuTrongThangOld = "select ROUND(SUM(hao), 3) as hao, 
											 ROUND(SUM(du), 3) as du, 
											 ROUND(SUM(haochenhlech), 3) as haochenhlech, 
											 ROUND(SUM(duchenhlech), 3) as duchenhlech
											 from $GLOBALS[db_sp].".$tableHaoDuOld." 
											 where idloaivang=".$idloaivang." and typeduyet=1
											 and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongHaoDuTrongThangOld = $GLOBALS['sp']->getRow($sqlTongHaoDuTrongThangOld);
		// print_r($rsTongHaoDuTrongThangOld); die();

		// TÍNH TỔNG HAO DƯ (CHÊNH LỆCH) DỰA TRÊN CÁC PHIẾU HAO DƯ ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ CỦA TABLE HAO DƯ GIAO NHẬN THỢ MỚI
		// Get ra tất cả các phiếu hao dư giao nhận thợ lớn đã duyệt
		$sqlGetPhieuHDGNT = "select id, tongtlhao, tongtldu from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." where idloaivang=".$idloaivang." and typeduyet=1 and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'";
		$rsGetPhieuHDGNT = $GLOBALS['sp']->getAll($sqlGetPhieuHDGNT);

		foreach($rsGetPhieuHDGNT as $itemGetPhieuHDGNT) {
			// Tính tổng lại hao dư của các phiếu giao nhận thợ chi tiết của nó
			$sqlTongHaoDuGNTPhieuCT = "select ROUND(SUM(hao), 3) as tongtlhao, 
											  ROUND(SUM(du), 3) as tongtldu 
											  from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanThoCT." 
											  where idpchinh=".$itemGetPhieuHDGNT['id']." 
								";
			$rsTongHaoDuGNTPhieuCT = $GLOBALS['sp']->getRow($sqlTongHaoDuGNTPhieuCT);

			if(($rsTongHaoDuGNTPhieuCT['tongtlhao'] != $itemGetPhieuHDGNT['tongtlhao']) || ($rsTongHaoDuGNTPhieuCT['tongtldu'] != $itemGetPhieuHDGNT['tongtldu'])) {
				$arrUpdateTongHDPhieuGNT = array();

				$arrUpdateTongHDPhieuGNT['tongtlhao'] = $rsTongHaoDuGNTPhieuCT['tongtlhao'];
				$arrUpdateTongHDPhieuGNT['tongtldu'] = $rsTongHaoDuGNTPhieuCT['tongtldu'];

				vaUpdate($tableHaoDuGiaoNhanTho, $arrUpdateTongHDPhieuGNT, ' id='.$itemGetPhieuHDGNT['id']);
			}
		}

		// Tính tổng hao dư kết dẻ
		$sqlTongHaoDuKetDeTrongThangNew = "select ROUND(SUM(tongtlhao), 3) as hao, 
												  ROUND(SUM(tongtldu), 3) as du  
												  from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." 
												  where idloaivang=".$idloaivang." 
												  and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 0) 
												  and typeduyet=1
												  and dated >= '".$dateDauThang."' 
												  and dated <= '".$dateCuoiThang."' 
								";
		$rsTongHaoDuKetDeTrongThangNew = $GLOBALS['sp']->getRow($sqlTongHaoDuKetDeTrongThangNew);

		// Tính tổng hao dư chênh lệch
		$sqlTongHaoDuChenhLechTrongThangNew = "select ROUND(SUM(tongtlhao), 3) as haochenhlech, 
													  ROUND(SUM(tongtldu), 3) as duchenhlech 
													  from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." 
													  where idloaivang=".$idloaivang." 
													  and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 1) 
													  and typeduyet=1
													  and dated >= '".$dateDauThang."' 
													  and dated <= '".$dateCuoiThang."' 
								";
		$rsTongHaoDuChenhLechTrongThangNew = $GLOBALS['sp']->getRow($sqlTongHaoDuChenhLechTrongThangNew);

		$rsTongHaoDuTrongThang['hao'] = round(($rsTongHaoDuTrongThangOld['hao'] + $rsTongHaoDuKetDeTrongThangNew['hao']),3);
		$rsTongHaoDuTrongThang['du'] = round(($rsTongHaoDuTrongThangOld['du'] + $rsTongHaoDuKetDeTrongThangNew['du']),3);
		$rsTongHaoDuTrongThang['haochenhlech'] = round(($rsTongHaoDuTrongThangOld['haochenhlech'] + $rsTongHaoDuChenhLechTrongThangNew['haochenhlech']),3);
		$rsTongHaoDuTrongThang['duchenhlech'] = round(($rsTongHaoDuTrongThangOld['duchenhlech'] + $rsTongHaoDuChenhLechTrongThangNew['duchenhlech']),3);
		
		// Lấy ra tổng số lượng hao dư (chênh lệch) trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
		$sqlHDSDDKTrongThang = "select hao, du, haochenhlech, duchenhlech from $GLOBALS[db_sp].".$tableHachToan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
		$rsHDSDDKTrongThang = $GLOBALS['sp']->getRow($sqlHDSDDKTrongThang);
		// So sánh số lượng hao dư (chênh lệch) trong sodudauky với tổng số lượng hao dư (chênh lệch) của các phiếu cộng lại
		if($rsTongHaoDuTrongThang['hao'] != $rsHDSDDKTrongThang['hao'] || $rsTongHaoDuTrongThang['du'] != $rsHDSDDKTrongThang['du'] || $rsTongHaoDuTrongThang['haochenhlech'] != $rsHDSDDKTrongThang['haochenhlech'] || $rsTongHaoDuTrongThang['duchenhlech'] != $rsHDSDDKTrongThang['duchenhlech']){
			$arrUpdateHD['hao'] = $rsTongHaoDuTrongThang['hao'];
			$arrUpdateHD['du'] = $rsTongHaoDuTrongThang['du'];
			$arrUpdateHD['haochenhlech'] = $rsTongHaoDuTrongThang['haochenhlech'];
			$arrUpdateHD['duchenhlech'] = $rsTongHaoDuTrongThang['duchenhlech'];
		}

		vaUpdate($tableHachToan, $arrUpdateHD, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)) {
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			// TÍNH TỔNG HAO DƯ (CHÊNH LỆCH) DỰA TRÊN CÁC PHIẾU HAO DƯ ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ CỦA TABLE HAO DƯ CŨ (NẾU CÓ)
			$sqlTongHaoDuThangTiepOld = "select ROUND(SUM(hao), 3) as hao, 
												ROUND(SUM(du), 3) as du, 
												ROUND(SUM(haochenhlech), 3) as haochenhlech, 
												ROUND(SUM(duchenhlech), 3) as duchenhlech
												from $GLOBALS[db_sp].".$tableHaoDuOld." 
												where idloaivang=".$idloaivang." and typeduyet=1
												and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
									";
			$rsTongHaoDuThangTiepOld = $GLOBALS['sp']->getRow($sqlTongHaoDuThangTiepOld);
			// print_r($rsTongHaoDuThangTiepOld); die();

			// TÍNH TỔNG HAO DƯ (CHÊNH LỆCH) DỰA TRÊN CÁC PHIẾU HAO DƯ ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ CỦA TABLE HAO DƯ GIAO NHẬN THỢ MỚI
			// Get ra tất cả các phiếu hao dư giao nhận thợ lớn đã duyệt
			$sqlGetPhieuHDGNTThangTiep = "select id, tongtlhao, tongtldu from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." where idloaivang=".$idloaivang." and typeduyet=1 and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'";
			$rsGetPhieuHDGNTThangTiep = $GLOBALS['sp']->getAll($sqlGetPhieuHDGNTThangTiep);
			
			foreach($rsGetPhieuHDGNTThangTiep as $itemGetPhieuHDGNTThangTiep) {
				// Tính tổng lại hao dư của các phiếu giao nhận thợ chi tiết của nó
				$sqlTongHaoDuGNTPhieuCTThangTiep = "select ROUND(SUM(hao), 3) as tongtlhao, 
														   ROUND(SUM(du), 3) as tongtldu 
														   from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanThoCT." 
														   where idpchinh=".$itemGetPhieuHDGNTThangTiep['id']." 
												";
				$rsTongHaoDuGNTPhieuCTThangTiep = $GLOBALS['sp']->getRow($sqlTongHaoDuGNTPhieuCTThangTiep);
				if(($rsTongHaoDuGNTPhieuCTThangTiep['tongtlhao'] != $itemGetPhieuHDGNTThangTiep['tongtlhao']) || ($rsTongHaoDuGNTPhieuCTThangTiep['tongtldu'] != $itemGetPhieuHDGNTThangTiep['tongtldu'])) {
					$arrUpdateTongHDPhieuGNTThangTiep = array();

					$arrUpdateTongHDPhieuGNTThangTiep['tongtlhao'] = $rsTongHaoDuGNTPhieuCTThangTiep['tongtlhao'];
					$arrUpdateTongHDPhieuGNTThangTiep['tongtldu'] = $rsTongHaoDuGNTPhieuCTThangTiep['tongtldu'];

					vaUpdate($tableHaoDuGiaoNhanTho, $arrUpdateTongHDPhieuGNTThangTiep, ' id='.$itemGetPhieuHDGNTThangTiep['id']);
				}
			}

			// Tính tổng hao dư kết dẻ
			$sqlTongHaoDuKetDeThangTiepNew = "select ROUND(SUM(tongtlhao), 3) as hao, 
													 ROUND(SUM(tongtldu), 3) as du  
													 from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." 
													 where idloaivang=".$idloaivang." 
													 and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 0) 
													 and typeduyet=1
													 and dated >= '".$dateDauThangTiep."' 
													 and dated <= '".$dateCuoiThangTiep."' 
									";
			$rsTongHaoDuKetDeThangTiepNew = $GLOBALS['sp']->getRow($sqlTongHaoDuKetDeThangTiepNew);

			// Tính tổng hao dư chênh lệch
			$sqlTongHaoDuChenhLechThangTiepNew = "select ROUND(SUM(tongtlhao), 3) as haochenhlech, 
														 ROUND(SUM(tongtldu), 3) as duchenhlech 
														 from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." 
														 where idloaivang=".$idloaivang." 
														 and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 1) 
														 and typeduyet=1
														 and dated >= '".$dateDauThangTiep."' 
														 and dated <= '".$dateCuoiThangTiep."' 
									";
			$rsTongHaoDuChenhLechThangTiepNew = $GLOBALS['sp']->getRow($sqlTongHaoDuChenhLechThangTiepNew);

			$rsTongHaoDuThangTiep['hao'] = round(($rsTongHaoDuThangTiepOld['hao'] + $rsTongHaoDuKetDeThangTiepNew['hao']),3);
			$rsTongHaoDuThangTiep['du'] = round(($rsTongHaoDuThangTiepOld['du'] + $rsTongHaoDuKetDeThangTiepNew['du']),3);
			$rsTongHaoDuThangTiep['haochenhlech'] = round(($rsTongHaoDuThangTiepOld['haochenhlech'] + $rsTongHaoDuChenhLechThangTiepNew['haochenhlech']),3);
			$rsTongHaoDuThangTiep['duchenhlech'] = round(($rsTongHaoDuThangTiepOld['duchenhlech'] + $rsTongHaoDuChenhLechThangTiepNew['duchenhlech']),3);

			// Lấy ra tổng số lượng hao dư (chênh lệch) trong bảng sodudauky ứng với idloaivang (tháng tiếp theo) để so sánh
			$sqlHDSDDKThangTiep = "select hao, du, haochenhlech, duchenhlech from $GLOBALS[db_sp].".$tableHachToan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTiep."'";
			$rsHDSDDKThangTiep = $GLOBALS['sp']->getRow($sqlHDSDDKThangTiep);
			// So sánh số lượng hao dư (chênh lệch) trong sodudauky với tổng số lượng hao dư (chênh lệch) của các phiếu cộng lại
			if($rsTongHaoDuThangTiep['hao'] != $rsHDSDDKThangTiep['hao'] || $rsTongHaoDuThangTiep['du'] != $rsHDSDDKThangTiep['du'] || $rsTongHaoDuThangTiep['haochenhlech'] != $rsHDSDDKThangTiep['haochenhlech'] || $rsTongHaoDuThangTiep['duchenhlech'] != $rsHDSDDKThangTiep['duchenhlech']){
				$arrUpdateHDThangTiep['hao'] = $rsTongHaoDuThangTiep['hao'];
				$arrUpdateHDThangTiep['du'] = $rsTongHaoDuThangTiep['du'];
				$arrUpdateHDThangTiep['haochenhlech'] = $rsTongHaoDuThangTiep['haochenhlech'];
				$arrUpdateHDThangTiep['duchenhlech'] = $rsTongHaoDuThangTiep['duchenhlech'];
			}

			vaUpdate($tableHachToan, $arrUpdateHDThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');
		}
	}
}

// M.Tân thêm Điều chỉnh số liệu hạch toán hao dư giao nhận thợ KV Tổ Đúc
function dieuChinhSoLieuHachToanHaoDuGiaoNhanThoKhoPhongDuc($tableHaoDuOld,$tableHachToan,$tableHaoDuGiaoNhanTho,$idloaivang) {
	$sql = "select * from $GLOBALS[db_sp].".$tableHachToan." where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);
	
	$tableHaoDuGiaoNhanThoCT = $tableHaoDuGiaoNhanTho.'ct';
	$tableTrongLuongTuoi = $tableHaoDuGiaoNhanTho.'_trongluongtuoi';
	$tableChiTietDuc = $tableHaoDuGiaoNhanThoCT.'_chitietduc';
	
	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateHD = $arrUpdateHDThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG HAO DƯ (CHÊNH LỆCH) DỰA TRÊN CÁC PHIẾU HAO DƯ ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ CỦA TABLE HAO DƯ CŨ (NẾU CÓ)
		$sqlTongHaoDuTrongThangOld = "select ROUND(SUM(hao), 3) as hao, 
											 ROUND(SUM(du), 3) as du, 
											 ROUND(SUM(haochenhlech), 3) as haochenhlech, 
											 ROUND(SUM(duchenhlech), 3) as duchenhlech
											 from $GLOBALS[db_sp].".$tableHaoDuOld." 
											 where idloaivang=".$idloaivang." and typeduyet=1
											 and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongHaoDuTrongThangOld = $GLOBALS['sp']->getRow($sqlTongHaoDuTrongThangOld);
		// print_r($rsTongHaoDuTrongThangOld); die();

		// TÍNH TỔNG HAO DƯ (CHÊNH LỆCH) DỰA TRÊN CÁC PHIẾU HAO DƯ ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ CỦA TABLE HAO DƯ GIAO NHẬN THỢ MỚI
		// Get ra tất cả các phiếu hao dư giao nhận thợ lớn đã duyệt
		$sqlGetPhieuHDGNT = "select id, tldau, tlnhapdetysaunau, tlnhapbotsaunau, tlxuatbtpqlsx, sumtonghottam, sumtonghotchu, tongtlvanggiao, tongtlvangnhan, tongtlhao, tongtldu from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." where idloaivang=".$idloaivang." and typeduyet=1 and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'";
		$rsGetPhieuHDGNT = $GLOBALS['sp']->getAll($sqlGetPhieuHDGNT);

		foreach($rsGetPhieuHDGNT as $itemGetPhieuHDGNT) {
			// Tính lại tổng TL Vàng giao = TL Đầu của mục Thông tin đầu
			$sqlTLDau = "select ROUND(SUM(trongluong), 3) 
								from $GLOBALS[db_sp].".$tableTrongLuongTuoi." 
								where type = 1 and idpchinh=".$itemGetPhieuHDGNT['id']." 
						";
			$tongtlvanggiao = $tLDau = $GLOBALS['sp']->getOne($sqlTLDau);
			
			// Tính lại tổng TL Vàng nhận = (TL Nhập dẻ ty sau nấu + TL Nhập bột sau nấu + TL Xuất BTP trên QLSX) - (Tổng cột Hột tấm + Tổng cột hột chủ tab đúc)
			$sqlTLNhapDeTySauNau = "select ROUND(SUM(trongluong), 3)  
										   from $GLOBALS[db_sp].".$tableTrongLuongTuoi." 
										   where type = 2 and idpchinh=".$itemGetPhieuHDGNT['id']." 
									";
			$tLNhapDeTySauNau = $GLOBALS['sp']->getOne($sqlTLNhapDeTySauNau);
			$sqlTLNhapBotSauNau = "select ROUND(SUM(trongluong), 3)  
										  from $GLOBALS[db_sp].".$tableTrongLuongTuoi." 
										  where type = 3 and idpchinh=".$itemGetPhieuHDGNT['id']." 
									";
			$tLNhapBotSauNau = $GLOBALS['sp']->getOne($sqlTLNhapBotSauNau);
			$sqlSumHotTamHotChu = "select ROUND(SUM(hottam), 3) AS sumtonghottam,
										  ROUND(SUM(hotchu), 3) AS sumtonghotchu
										  from $GLOBALS[db_sp].".$tableChiTietDuc." 
										  WHERE idctgntduc IN (SELECT id FROM $GLOBALS[db_sp].".$tableHaoDuGiaoNhanThoCT." WHERE typeductaohat = 1 and idpchinh=".$itemGetPhieuHDGNT['id']." ) 
									";
			$rsSumHotTamHotChu = $GLOBALS['sp']->getRow($sqlSumHotTamHotChu);

			$tongtlvangnhan = round(((round(($tLNhapDeTySauNau + round(($tLNhapBotSauNau + $itemGetPhieuHDGNT['tlxuatbtpqlsx']),3)),3)) - (round(($rsSumHotTamHotChu['sumtonghottam'] + $rsSumHotTamHotChu['sumtonghotchu']),3))),3);
			$resultMinus = round(($tongtlvanggiao - $tongtlvangnhan),3);
			if($resultMinus > 0) {
				$tongtlhao = round(($tongtlvanggiao - $tongtlvangnhan),3);
				$tongtldu = 0;
			}
			else if($resultMinus == 0) {
				$tongtlhao = 0;
				$tongtldu = 0;
			}
			else if($resultMinus < 0) {
				$tongtlhao = 0;
				$tongtldu = round(($tongtlvangnhan - $tongtlvanggiao),3);
			}
			
			$arrUpdatePhieuGNT = array();
			$flagUpdate = 0;
			if($tLDau != $itemGetPhieuHDGNT['tldau']) {
				$flagUpdate = 1;
				$arrUpdatePhieuGNT['tldau'] = $tLDau;
			}
			if($tLNhapDeTySauNau != $itemGetPhieuHDGNT['tlnhapdetysaunau']) {
				$flagUpdate = 1;
				$arrUpdatePhieuGNT['tlnhapdetysaunau'] = $tLNhapDeTySauNau;
			}
			if($tLNhapBotSauNau != $itemGetPhieuHDGNT['tlnhapbotsaunau']) {
				$flagUpdate = 1;
				$arrUpdatePhieuGNT['tlnhapbotsaunau'] = $tLNhapBotSauNau;
			}
			if($rsSumHotTamHotChu['sumtonghottam'] != $itemGetPhieuHDGNT['sumtonghottam']) {
				$flagUpdate = 1;
				$arrUpdatePhieuGNT['sumtonghottam'] = $rsSumHotTamHotChu['sumtonghottam'];
			}
			if($rsSumHotTamHotChu['sumtonghotchu'] != $itemGetPhieuHDGNT['sumtonghotchu']) {
				$flagUpdate = 1;
				$arrUpdatePhieuGNT['sumtonghotchu'] = $rsSumHotTamHotChu['sumtonghotchu'];
			}
			if(($tongtlvanggiao != $itemGetPhieuHDGNT['tongtlvanggiao']) || ($tongtlvangnhan != $itemGetPhieuHDGNT['tongtlvangnhan'])) {
				$flagUpdate = 1;
				$arrUpdatePhieuGNT['tongtlvanggiao'] = $tongtlvanggiao;
				$arrUpdatePhieuGNT['tongtlvangnhan'] = $tongtlvangnhan;
			}
			if(($tongtlhao != $itemGetPhieuHDGNT['tongtlhao']) || ($tongtldu != $itemGetPhieuHDGNT['tongtldu'])) {
				$flagUpdate = 1;
				$arrUpdatePhieuGNT['tongtlhao'] = $tongtlhao;
				$arrUpdatePhieuGNT['tongtldu'] = $tongtldu;
			}

			if($flagUpdate == 1) {
				vaUpdate($tableHaoDuGiaoNhanTho, $arrUpdatePhieuGNT, ' id='.$itemGetPhieuHDGNT['id']);
			}
		}

		// Tính tổng hao dư kết dẻ
		$sqlTongHaoDuKetDeTrongThangNew = "select ROUND(SUM(tongtlhao), 3) as hao, 
												  ROUND(SUM(tongtldu), 3) as du  
												  from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." 
												  where idloaivang=".$idloaivang." 
												  and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 0) 
												  and typeduyet=1
												  and dated >= '".$dateDauThang."' 
												  and dated <= '".$dateCuoiThang."' 
								";
		$rsTongHaoDuKetDeTrongThangNew = $GLOBALS['sp']->getRow($sqlTongHaoDuKetDeTrongThangNew);

		// Tính tổng hao dư chênh lệch
		$sqlTongHaoDuChenhLechTrongThangNew = "select ROUND(SUM(tongtlhao), 3) as haochenhlech, 
													  ROUND(SUM(tongtldu), 3) as duchenhlech 
													  from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." 
													  where idloaivang=".$idloaivang." 
													  and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 1) 
													  and typeduyet=1
													  and dated >= '".$dateDauThang."' 
													  and dated <= '".$dateCuoiThang."' 
								";
		$rsTongHaoDuChenhLechTrongThangNew = $GLOBALS['sp']->getRow($sqlTongHaoDuChenhLechTrongThangNew);

		$rsTongHaoDuTrongThang['hao'] = round(($rsTongHaoDuTrongThangOld['hao'] + $rsTongHaoDuKetDeTrongThangNew['hao']),3);
		$rsTongHaoDuTrongThang['du'] = round(($rsTongHaoDuTrongThangOld['du'] + $rsTongHaoDuKetDeTrongThangNew['du']),3);
		$rsTongHaoDuTrongThang['haochenhlech'] = round(($rsTongHaoDuTrongThangOld['haochenhlech'] + $rsTongHaoDuChenhLechTrongThangNew['haochenhlech']),3);
		$rsTongHaoDuTrongThang['duchenhlech'] = round(($rsTongHaoDuTrongThangOld['duchenhlech'] + $rsTongHaoDuChenhLechTrongThangNew['duchenhlech']),3);
		
		// Lấy ra tổng số lượng hao dư (chênh lệch) trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
		$sqlHDSDDKTrongThang = "select hao, du, haochenhlech, duchenhlech from $GLOBALS[db_sp].".$tableHachToan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
		$rsHDSDDKTrongThang = $GLOBALS['sp']->getRow($sqlHDSDDKTrongThang);
		// So sánh số lượng hao dư (chênh lệch) trong sodudauky với tổng số lượng hao dư (chênh lệch) của các phiếu cộng lại
		if($rsTongHaoDuTrongThang['hao'] != $rsHDSDDKTrongThang['hao'] || $rsTongHaoDuTrongThang['du'] != $rsHDSDDKTrongThang['du'] || $rsTongHaoDuTrongThang['haochenhlech'] != $rsHDSDDKTrongThang['haochenhlech'] || $rsTongHaoDuTrongThang['duchenhlech'] != $rsHDSDDKTrongThang['duchenhlech']){
			$arrUpdateHD['hao'] = $rsTongHaoDuTrongThang['hao'];
			$arrUpdateHD['du'] = $rsTongHaoDuTrongThang['du'];
			$arrUpdateHD['haochenhlech'] = $rsTongHaoDuTrongThang['haochenhlech'];
			$arrUpdateHD['duchenhlech'] = $rsTongHaoDuTrongThang['duchenhlech'];
		}

		vaUpdate($tableHachToan, $arrUpdateHD, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)) {
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			// TÍNH TỔNG HAO DƯ (CHÊNH LỆCH) DỰA TRÊN CÁC PHIẾU HAO DƯ ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ CỦA TABLE HAO DƯ CŨ (NẾU CÓ)
			$sqlTongHaoDuThangTiepOld = "select ROUND(SUM(hao), 3) as hao, 
												ROUND(SUM(du), 3) as du, 
												ROUND(SUM(haochenhlech), 3) as haochenhlech, 
												ROUND(SUM(duchenhlech), 3) as duchenhlech
												from $GLOBALS[db_sp].".$tableHaoDuOld." 
												where idloaivang=".$idloaivang." and typeduyet=1
												and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
									";
			$rsTongHaoDuThangTiepOld = $GLOBALS['sp']->getRow($sqlTongHaoDuThangTiepOld);
			// print_r($rsTongHaoDuThangTiepOld); die();

			// TÍNH TỔNG HAO DƯ (CHÊNH LỆCH) DỰA TRÊN CÁC PHIẾU HAO DƯ ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ CỦA TABLE HAO DƯ GIAO NHẬN THỢ MỚI
			// Get ra tất cả các phiếu hao dư giao nhận thợ lớn đã duyệt
			$sqlGetPhieuHDGNTThangTiep = "select id, tldau, tlnhapdetysaunau, tlnhapbotsaunau, tlxuatbtpqlsx, sumtonghottam, sumtonghotchu, tongtlvanggiao, tongtlvangnhan, tongtlhao, tongtldu from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." where idloaivang=".$idloaivang." and typeduyet=1 and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'";
			$rsGetPhieuHDGNTThangTiep = $GLOBALS['sp']->getAll($sqlGetPhieuHDGNTThangTiep);
			
			foreach($rsGetPhieuHDGNTThangTiep as $itemGetPhieuHDGNTThangTiep) {
				// Tính lại tổng TL Vàng giao = TL Đầu của mục Thông tin đầu
				$sqlTLDauThangTiep = "select ROUND(SUM(trongluong), 3) 
											 from $GLOBALS[db_sp].".$tableTrongLuongTuoi." 
											 where type = 1 and idpchinh=".$itemGetPhieuHDGNTThangTiep['id']." 
									";
				$tongtlvanggiaoThangTiep = $tLDauThangTiep = $GLOBALS['sp']->getOne($sqlTLDauThangTiep);

				// Tính lại tổng TL Vàng nhận = (TL Nhập dẻ ty sau nấu + TL Nhập bột sau nấu + TL Xuất BTP trên QLSX) - (Tổng cột Hột tấm + Tổng cột hột chủ tab đúc)
				$sqlTLNhapDeTySauNauThangTiep = "select ROUND(SUM(trongluong), 3)  
														from $GLOBALS[db_sp].".$tableTrongLuongTuoi." 
														where type = 2 and idpchinh=".$itemGetPhieuHDGNTThangTiep['id']." 
												";
				$tLNhapDeTySauNauThangTiep = $GLOBALS['sp']->getOne($sqlTLNhapDeTySauNauThangTiep);
				$sqlTLNhapBotSauNauThangTiep = "select ROUND(SUM(trongluong), 3)  
													   from $GLOBALS[db_sp].".$tableTrongLuongTuoi." 
													   where type = 3 and idpchinh=".$itemGetPhieuHDGNTThangTiep['id']." 
												";
				$tLNhapBotSauNauThangTiep = $GLOBALS['sp']->getOne($sqlTLNhapBotSauNauThangTiep);
				$sqlSumHotTamHotChuThangTiep = "select ROUND(SUM(hottam), 3) AS sumtonghottam,
													   ROUND(SUM(hotchu), 3) AS sumtonghotchu
													   from $GLOBALS[db_sp].".$tableChiTietDuc." 
													   WHERE idctgntduc IN (SELECT id FROM $GLOBALS[db_sp].".$tableHaoDuGiaoNhanThoCT." WHERE typeductaohat = 1 and idpchinh=".$itemGetPhieuHDGNTThangTiep['id']." ) 
										";
				$rsSumHotTamHotChuThangTiep = $GLOBALS['sp']->getRow($sqlSumHotTamHotChuThangTiep);

				$tongtlvangnhanThangTiep = round(((round(($tLNhapDeTySauNauThangTiep + round(($tLNhapBotSauNauThangTiep + $itemGetPhieuHDGNTThangTiep['tlxuatbtpqlsx']),3)),3)) - (round(($rsSumHotTamHotChuThangTiep['sumtonghottam'] + $rsSumHotTamHotChuThangTiep['sumtonghotchu']),3))),3);
				$resultMinusThangTiep = round(($tongtlvanggiaoThangTiep - $tongtlvangnhanThangTiep),3);
				if($resultMinusThangTiep > 0) {
					$tongtlhaoThangTiep = round(($tongtlvanggiaoThangTiep - $tongtlvangnhanThangTiep),3);
					$tongtlduThangTiep = 0;
				}
				else if($resultMinusThangTiep == 0) {
					$tongtlhaoThangTiep = 0;
					$tongtlduThangTiep = 0;
				}
				else if($resultMinusThangTiep < 0) {
					$tongtlhaoThangTiep = 0;
					$tongtlduThangTiep = round(($tongtlvangnhanThangTiep - $tongtlvanggiaoThangTiep),3);
				}

				$arrUpdatePhieuGNTThangTiep = array();
				$flagUpdateThangTiep = 0;
				if($tLDauThangTiep != $itemGetPhieuHDGNTThangTiep['tldau']) {
					$flagUpdateThangTiep = 1;
					$arrUpdatePhieuGNTThangTiep['tldau'] = $tLDauThangTiep;
				}
				if($tLNhapDeTySauNauThangTiep != $itemGetPhieuHDGNTThangTiep['tlnhapdetysaunau']) {
					$flagUpdateThangTiep = 1;
					$arrUpdatePhieuGNTThangTiep['tlnhapdetysaunau'] = $tLNhapDeTySauNauThangTiep;
				}
				if($tLNhapBotSauNauThangTiep != $itemGetPhieuHDGNTThangTiep['tlnhapbotsaunau']) {
					$flagUpdateThangTiep = 1;
					$arrUpdatePhieuGNTThangTiep['tlnhapbotsaunau'] = $tLNhapBotSauNauThangTiep;
				}
				if($rsSumHotTamHotChuThangTiep['sumtonghottam'] != $itemGetPhieuHDGNTThangTiep['sumtonghottam']) {
					$flagUpdateThangTiep = 1;
					$arrUpdatePhieuGNTThangTiep['sumtonghottam'] = $rsSumHotTamHotChuThangTiep['sumtonghottam'];
				}
				if($rsSumHotTamHotChuThangTiep['sumtonghotchu'] != $itemGetPhieuHDGNTThangTiep['sumtonghotchu']) {
					$flagUpdateThangTiep = 1;
					$arrUpdatePhieuGNTThangTiep['sumtonghotchu'] = $rsSumHotTamHotChuThangTiep['sumtonghotchu'];
				}
				if(($tongtlvanggiaoThangTiep != $itemGetPhieuHDGNTThangTiep['tongtlvanggiao']) || ($tongtlvangnhanThangTiep != $itemGetPhieuHDGNTThangTiep['tongtlvangnhan'])) {
					$flagUpdateThangTiep = 1;
					$arrUpdatePhieuGNTThangTiep['tongtlvanggiao'] = $tongtlvanggiaoThangTiep;
					$arrUpdatePhieuGNTThangTiep['tongtlvangnhan'] = $tongtlvangnhanThangTiep;
				}
				if(($tongtlhaoThangTiep != $itemGetPhieuHDGNTThangTiep['tongtlhao']) || ($tongtlduThangTiep != $itemGetPhieuHDGNTThangTiep['tongtldu'])) {
					$flagUpdateThangTiep = 1;
					$arrUpdatePhieuGNTThangTiep['tongtlhao'] = $tongtlhaoThangTiep;
					$arrUpdatePhieuGNTThangTiep['tongtldu'] = $tongtlduThangTiep;
				}

				if($flagUpdateThangTiep == 1) {
					vaUpdate($tableHaoDuGiaoNhanTho, $arrUpdatePhieuGNTThangTiep, ' id='.$itemGetPhieuHDGNTThangTiep['id']);
				}
			}

			// Tính tổng hao dư kết dẻ
			$sqlTongHaoDuKetDeThangTiepNew = "select ROUND(SUM(tongtlhao), 3) as hao, 
													 ROUND(SUM(tongtldu), 3) as du  
													 from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." 
													 where idloaivang=".$idloaivang." 
													 and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 0) 
													 and typeduyet=1
													 and dated >= '".$dateDauThangTiep."' 
													 and dated <= '".$dateCuoiThangTiep."' 
									";
			$rsTongHaoDuKetDeThangTiepNew = $GLOBALS['sp']->getRow($sqlTongHaoDuKetDeThangTiepNew);

			// Tính tổng hao dư chênh lệch
			$sqlTongHaoDuChenhLechThangTiepNew = "select ROUND(SUM(tongtlhao), 3) as haochenhlech, 
														 ROUND(SUM(tongtldu), 3) as duchenhlech 
														 from $GLOBALS[db_sp].".$tableHaoDuGiaoNhanTho." 
														 where idloaivang=".$idloaivang." 
														 and idtotho in (select id from $GLOBALS[db_sp].dm_danhsachtotho where ishachtoanhaoduchenhlech = 1) 
														 and typeduyet=1
														 and dated >= '".$dateDauThangTiep."' 
														 and dated <= '".$dateCuoiThangTiep."' 
									";
			$rsTongHaoDuChenhLechThangTiepNew = $GLOBALS['sp']->getRow($sqlTongHaoDuChenhLechThangTiepNew);

			$rsTongHaoDuThangTiep['hao'] = round(($rsTongHaoDuThangTiepOld['hao'] + $rsTongHaoDuKetDeThangTiepNew['hao']),3);
			$rsTongHaoDuThangTiep['du'] = round(($rsTongHaoDuThangTiepOld['du'] + $rsTongHaoDuKetDeThangTiepNew['du']),3);
			$rsTongHaoDuThangTiep['haochenhlech'] = round(($rsTongHaoDuThangTiepOld['haochenhlech'] + $rsTongHaoDuChenhLechThangTiepNew['haochenhlech']),3);
			$rsTongHaoDuThangTiep['duchenhlech'] = round(($rsTongHaoDuThangTiepOld['duchenhlech'] + $rsTongHaoDuChenhLechThangTiepNew['duchenhlech']),3);

			// Lấy ra tổng số lượng hao dư (chênh lệch) trong bảng sodudauky ứng với idloaivang (tháng tiếp theo) để so sánh
			$sqlHDSDDKThangTiep = "select hao, du, haochenhlech, duchenhlech from $GLOBALS[db_sp].".$tableHachToan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTiep."'";
			$rsHDSDDKThangTiep = $GLOBALS['sp']->getRow($sqlHDSDDKThangTiep);
			// So sánh số lượng hao dư (chênh lệch) trong sodudauky với tổng số lượng hao dư (chênh lệch) của các phiếu cộng lại
			if($rsTongHaoDuThangTiep['hao'] != $rsHDSDDKThangTiep['hao'] || $rsTongHaoDuThangTiep['du'] != $rsHDSDDKThangTiep['du'] || $rsTongHaoDuThangTiep['haochenhlech'] != $rsHDSDDKThangTiep['haochenhlech'] || $rsTongHaoDuThangTiep['duchenhlech'] != $rsHDSDDKThangTiep['duchenhlech']){
				$arrUpdateHDThangTiep['hao'] = $rsTongHaoDuThangTiep['hao'];
				$arrUpdateHDThangTiep['du'] = $rsTongHaoDuThangTiep['du'];
				$arrUpdateHDThangTiep['haochenhlech'] = $rsTongHaoDuThangTiep['haochenhlech'];
				$arrUpdateHDThangTiep['duchenhlech'] = $rsTongHaoDuThangTiep['duchenhlech'];
			}

			vaUpdate($tableHachToan, $arrUpdateHDThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');
		}
	}
}

// M.Tân thêm ngày 05/01/2021 - Tách thống kê Kho Phụ Kiện (tính Qui 10 làm tròn 10)
function insert_thongKeTonHienTaiKhoSanXuatKhoPhuKien($a){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
		$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
		$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
		if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
			$datedauthang = date("Y").'-'.date("m").'-01';
			/////////////////////get số lượng hao dư
			$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech,  ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
						 where idloaivang=".$idloaivang." 
						 and dated <= '".$datedauthang."'
			";
			$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

			////////////////get số tồn hiện tại
			$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
			$rston = $GLOBALS['sp']->getRow($sqlton);
			
			$slton = round(($rston['sltonv'] - $rshaodu['hao']),10) + $rshaodu['du'];
			$slton = round(($slton - $rshaodu['haochenhlech']),10) + $rshaodu['duchenhlech'];
			
			$arrlist['slhao'] = $rshaodu['hao'];
			$arrlist['sldu'] = $rshaodu['du'];
			
			$arrlist['slnhap'] = $rston['slnhapv'];
			$arrlist['slxuat'] = $rston['slxuatv'];
			$arrlist['slton'] = $slton;
			$arrlist['idloaivang'] = $idloaivang;	
			$arrlist['tongQ10'] = getTongQ10Round10($arrlist['slton'], $arrlist['idloaivang']);
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

// M.Tân thêm ngày 05/01/2021 - Tách thống kê Kho Phụ Kiện (tính Qui 10 làm tròn 10)
function thongKeTonHienTaiKhoSanXuatKhoPhuKien($cid,$idloaivang){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	
	//$cid = ceil(trim($a['cid']));
	//$idloaivang = ceil(trim($a['idloaivang']));
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
		$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
		$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
		if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
			$datedauthang = date("Y").'-'.date("m").'-01';
			/////////////////////get số lượng hao dư
			$sqlhaodu = "select SUM(hao) as hao, SUM(du) as du from $GLOBALS[db_sp].".$tablehachtoan." 
						 where idloaivang=".$idloaivang." 
						 and dated <= '".$datedauthang."'
			";
			$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

			////////////////get số tồn hiện tại
			$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
			$rston = $GLOBALS['sp']->getRow($sqlton);
			
			$slton = round(($rston['sltonv'] - $rshaodu['hao']),3) + $rshaodu['du'];
			
			$arrlist['slhao'] = $rshaodu['hao'];
			$arrlist['sldu'] = $rshaodu['du'];
			
			$arrlist['slnhap'] = $rston['slnhapv'];
			$arrlist['slxuat'] = $rston['slxuatv'];
			$arrlist['slton'] = $slton;
			$arrlist['idloaivang'] = $idloaivang;	
			$arrlist['tongQ10'] = getTongQ10Round10($arrlist['slton'], $arrlist['idloaivang']);
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

// M.Tân thêm ngày 05/01/2021 - Tách thống kê Kho Phụ Kiện (tính Qui 10 làm tròn 10)
function insert_thongKeTonKhoSanXuatKhoPhuKien($a){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	$tablehaodu = trim(striptags($a['tablehaodu']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$datenow = date("Y-m-d");
	
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),10) + $rshaodusddk['du'];
					
					$sltonsddk = round(($sltonsddk - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'];

					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated = '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang."  and dated = '".$datedauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(round($sltonsddk + $rston['slnhapv'],10) - $rston['slxuatv'],10);
					
					$slton = round(round(($slton - $rshaodu['hao']),10) + $rshaodu['du'],10);
					$slton = round(round(($slton - $rshaodu['haochenhlech']),10) + $rshaodu['duchenhlech'],10);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),10) + $rshaodusddk['du'],10);
					
					$sltonsddk = round(round(($sltonsddk - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'],10);
					
					$thangdauky = $rstonsddk['dated']; 
					
					/////////////////////get số lượng hao dư từ ngày đến đầu tháng
					$sqlhaodutndt = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehaodu."  
								 where idloaivang=".$idloaivang." 
								 and dated < '".$fromDate."'
								 and dated >= '".$datedauthang."'
					";
					$rshaodutndt = $GLOBALS['sp']->getRow($sqlhaodutndt);
					// die($sqlhaodutndt);
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and typechuyen=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type in(2,3)
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),10) + round(($rshaodutndt['du'] - $rshaodutndt['hao']),10);
					$sltontndt = round(($sltontndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),10)),10); 
					$sltonsddk = round(($sltonsddk + $sltontndt),10);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehaodu."  
								 where idloaivang=".$idloaivang." 
								 and dated >= '".$fromDate."'
								 and dated <= '".$toDate."'
								 and typeduyet = 1
					";
					// die($sqlhaodu);
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
					
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=1 
									 and typechuyen=2 
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
					            where idloaivang=".$idloaivang."
								and type in(2,3)
								and datedxuat >= '".$fromDate."'  
								and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),10) + round(($rshaodu['du'] - $rshaodu['hao']),10);
					$sltontndn = $sltontndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),10);
					$slton = $sltonsddk + $sltontndn;
					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10Round10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

function thongKeTonKhoSanXuatKhoPhuKien($cid, $idloaivang, $fromDate, $toDate){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	//$cid = ceil(trim($a['cid']));
	//$idloaivang = ceil(trim($a['idloaivang']));
	
	//$fromDate = $a['fromdays'];
	//$toDate = $a['todays'];
	$datenow = date("Y-m-d");
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];

	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		
		
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				$tablehaodu = '';
				if ($table == 'khosanxuat_phukien_new'){
					$tablehaodu = 'khosanxuat_phukienhaodu_new';
				}
				elseif ($table == 'khosanxuat_phukien_dhht'){
					$tablehaodu = 'khosanxuat_phukienhaodu_dhht';
				}
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					
					$sltonsddk = round(($sltonsddk - $rshaodusddk['haochenhlech']),3) + $rshaodusddk['duchenhlech'];

					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(round(($rston['sltonv'] - $rshaodu['hao']),3) + $rshaodu['du'],3);
					$slton = round(round(($slton - $rshaodu['haochenhlech']),3) + $rshaodu['duchenhlech'],3);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					/////////////////////get số lượng hao dư đầu kỳ
					 $sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);

					$sltonsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);
					$sltonsddk = round(round(($sltonsddk - $rshaodusddk['haochenhlech']),3) + $rshaodusddk['duchenhlech'],3);
					
					$thangdauky = $rstonsddk['dated']; 
					
					/////////////////////get số lượng hao dư từ ngày đến đầu tháng
					$sqlhaodutndt = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehaodu." 
								 where idloaivang=".$idloaivang." 
								 and dated < '".$fromDate."'
								 and dated >= '".$datedauthang."'
					";
					$rshaodutndt = $GLOBALS['sp']->getRow($sqlhaodutndt);
				
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and typechuyen=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type in(2,3)
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3) + round(($rshaodutndt['du'] - $rshaodutndt['hao']),3);
					$sltontndt = round(($sltontndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),3)),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehaodu." 
								 where idloaivang=".$idloaivang." 
								 and dated >= '".$fromDate."'
								 and dated <= '".$toDate."'
					";
					//die($sqlhaodu);
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
					
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=1 
									 and typechuyen=2 
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
					            where idloaivang=".$idloaivang."
								and type in(2,3)
								and datedxuat >= '".$fromDate."'  
								and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3) + round(($rshaodu['du'] - $rshaodu['hao']),3);
					$sltontndn = $sltontndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),3);
					$slton = $sltonsddk + $sltontndn;
					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10Round10($arrlist['slton'], $arrlist['idloaivang']);
				
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

// M.Tân thêm ngày 06/01/2021 - Get phòng ban xuất cho thống kê tồn kho chi tiết (vàng/kim cương tấm) Kho Vàng Cũ Chi Nhánh
function insert_getPhongBanXuatTKTonKhoKhoVangCuCN($a){
	$arrlist = array();
	$id = ceil(trim($a['id']));
	$table = trim($a['table']);

	if(!empty($table)){
		if(!empty($id)){
			// Get id phiếu xuất đã chọn phiếu nhập này
			$sqlgetidphieuxuat = "select idphieuxuat from $GLOBALS[db_sp].".$table." where id=".$id;
			$idphieuxuat = $GLOBALS['sp']->getOne($sqlgetidphieuxuat);

			// Get phòng ban của phiếu xuất đã chọn phiếu nhập này
			$sqlGetPhongBanXuat = "select phongban, idketoan, phongbanketoan from $GLOBALS[db_sp].vangcucn_khovangcucn where id=".$idphieuxuat;
			$rsGetPhongBanXuat = $GLOBALS['sp']->getRow($sqlGetPhongBanXuat);

			if($rsGetPhongBanXuat['idketoan'] > 0) { // Nếu idketoan có tồn tại => xuất qua kế toán
				$namephongbanxuat = $rsGetPhongBanXuat['phongbanketoan'];
			} else if($rsGetPhongBanXuat['phongban'] > 0 && $rsGetPhongBanXuat['idketoan'] == 0 && $rsGetPhongBanXuat['phongban'] != 1735) {
				$namephongbanxuat = getNameKhoShort($rsGetPhongBanXuat['phongban']);
			} else {
				$namephongbanxuat = "Đã chọn/Chưa xuất";
			}
		}
		return $namephongbanxuat;
	}
	else {
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
}

// M.Tân thêm ngày 01/04/2021 - Get phòng ban xuất cho thống kê tồn kho chi tiết Kim Cương Tấm SP Làm Đồ Chùi Kho Vàng Cũ Chi Nhánh
function insert_getPhongBanXuatTKTonKhoKCTamDoChuiKhoVangCuCN($a){
	$arrlist = array();
	$id = ceil(trim($a['id']));
	$table = trim($a['table']);
	
	if(!empty($table)){
		if(!empty($id)){
			// Get phòng ban của phiếu xuất đã chọn phiếu nhập này
			$sqlGetPhongBanXuat = "select phongban, idketoan, phongbanketoan from $GLOBALS[db_sp].vangcucn_khovangcucn where idphieuctkctamxk=".$id;
			$rsGetPhongBanXuat = $GLOBALS['sp']->getRow($sqlGetPhongBanXuat);

			if($rsGetPhongBanXuat['idketoan'] > 0) { // Nếu idketoan có tồn tại => xuất qua kế toán
				$namephongbanxuat = $rsGetPhongBanXuat['phongbanketoan'];
			} else if($rsGetPhongBanXuat['phongban'] > 0 && $rsGetPhongBanXuat['idketoan'] == 0 && $rsGetPhongBanXuat['phongban'] != 1735) {
				$namephongbanxuat = getNameKhoShort($rsGetPhongBanXuat['phongban']);
			} else {
				$namephongbanxuat = "Đã chọn/Chưa xuất";
			}
		}
		return $namephongbanxuat;
	}
	else {
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
}

function insert_loadTableVMTT($a) {
	$timeapply = $a['timeapply'];
	$timedadd = $a['timed'];
	$table = 'nhapdulieuspkhtch_banvmtt';
	$tablect = 'nhapdulieuspkhtch_banvmtt_ct';
	
	$sql = "select $tablect.* from $GLOBALS[db_sp].$tablect INNER JOIN $table ON $table.id = $tablect.idchinhanh 
			where $tablect.timeapply='$timeapply' and $tablect.timed='$timedadd' ORDER BY $table.num asc"; 
	$rs = $GLOBALS["sp"]->getAll($sql);
	$countvmtt = ceil(count($rs));
	if($countvmtt > 0) {
		$rowdong = 1;
		$background = $backgroundmtt = "";
		foreach($rs as $item) {
			$sqlchinhanh = "select machinhanh from $GLOBALS[db_sp].nhapdulieuspkhtch_banvmtt where id='".$item['idchinhanh']."'";
			$chinhanh = $GLOBALS["sp"]->getOne($sqlchinhanh);
			$backgroundnhan = ($item['trangthainhan'] == 1) ? 'style="color: red;"' : "";
			$backgroundmtt = ($item['trangthaimtt'] == 1) ? 'style="color: red;"' : "";
			$item['giabannhan'] = ($item['giabannhan']>0) ? number_format($item['giabannhan'],0,".",",") : '' ;
			$item['giabanmtt'] = ($item['giabanmtt']>0) ? number_format($item['giabanmtt'],0,".",",") : '' ;
				$str .= '
						<tr id="rowTongValueKimCuongTamSauNau'.$id.'" class="PagingTong">
							<td align="center">
								'.$rowdong.'
							</td>               
							<td align="center">
								<strong>'.$chinhanh.'</strong>
							</td>
							<td  align="right" '.$backgroundnhan.'>
								<strong>'.$item['giabannhan'].'</strong>
							</td>
							<td  align="right" '.$backgroundmtt.'>
								<strong>'.$item['giabanmtt'].'</strong>
							</td>
						</tr>
				';
				
				$rowdong = $rowdong + 1;
			}
	
			$strtd ='
				<div class="table2scroll">
					<table style="width: 100% !important; height: 100%" border="1" id="addRowGirlKimCuongTamSauNau'.$id.'" class="table-bordered" >
						<tr class="trheader">
							<td class="tdSTT">
								<strong>STT</strong>
							</td>
							<td>
								<strong>Chi Nhánh</strong>
							</td>
							<td>
								<strong>Giá Bán Nhẫn</strong>
							</td>
							<td>
								<strong>Giá Bán Miếng Thần Tài</strong>
							</td> 
						</tr>
							'.$str.'
					</table>
				</div>
			';
		return $strtd;
	}
}

function DownMoreMenu($id){
	$sql = "select * from $GLOBALS[db_sp].categories where pid=".$id." and active=1 order by num asc, id desc";
	$rs = $GLOBALS["sp"]->getAll($sql);
	$listsubMenu ='';
	if ($id == 3171)
		$listsubMenu .= '<ul style="display: none;" id="phongbanNLSX"><input type="text" style="width:100%;height:24px;font-size:12px;" id="searchPhongbanNLSX" onkeyup="searchList(\'searchPhongbanNLSX\',\'phongbanNLSX\')" placeholder="Nhập để tìm kiếm.." title="Tìm KV Nguyên Liệu SX">';
	else	
		$listsubMenu .= '<ul style="display: none;">';
	foreach($rs as $item){
		$classHasSub = $title = '';
		$filename = pathinfo(GetNameComponent($item["comp"]), PATHINFO_FILENAME);
		$typephongban=(!empty($item['typephongban']))?'&typephongban='.$item['typephongban']:'';
		// new
		$ahref = 'target="QLSX_content" data-name="'.$filename.'" data-cid="'.$item['id'].$typephongban.'" data-extension="'.getName('component', 'front_link', $item["comp"]).'"';
		// old
		// $ahref = 'target="QLSX_content" onclick="loadingpage();" href="sources/'.GetNameComponent($item["comp"]).getName('component', 'front_link', $item["comp"]).'cid='.$item['id'].$typephongban.'"';
		if($item['has_child'] == 1){
			$classHasSub = 'class="has-sub" id="sub'.$item['id'].'"';
			$ahref = '';
		}
		if(checkViewPermision($item['id'])==1){
			$numpb = $styleColorGNT = '';
			if ( $item['numphong'] > 0 ) {
				$numpb = '<span class="numpb">'.$item['numphong'].'. </span>';
			} 
			if( $item['pid'] == 2647 && ($item['id'] != 2649 && $item['id'] != 2650 && $item['id'] != 2651 && $item['id'] != 2652)) {
				$numpb = '<span class="numpb">'.($item['num']+6).'. </span>';
			} else if( $item['pid'] == 2648 && ($item['id'] != 2686 && $item['id'] != 2687 && $item['id'] != 2688 && $item['id'] != 2689)) {
				$numpb = '<span class="numpb">'.($item['num']+6).'. </span>';
			} else if( $item['pid'] == 2117 ){
				$numpb = '<span class="numpb">'.($item['num']).'. </span>';
			}
			if(!empty($item['title_menu'])){
				$title = "title='".$item['title_menu']."'";
			}

			if($item['tablegiaonhantho'] != '' && $item['has_child'] == 1)
				$styleColorGNT = 'style="color: yellow"';
			
			// new
			$listsubMenu .='<li '.$classHasSub.' ><a '.$ahref.' '.$title.'><span '.$styleColorGNT.'>'.$numpb.$item['name_vn'].'</span></a>';
			// old
			// $listsubMenu .='<li '.$classHasSub.' ><a '.$ahref.' onclick="processHasMenu(this);"><span>'.$numpb.$item['name_vn'].'</span></a>';
			// if($item['has_child'] == 1){
			// 	$listsubMenu .=DownMoreMenu($item['id']);         
			// }
			$listsubMenu .='</li>';
		}
	} 
	$listsubMenu .='</ul>';
	return $listsubMenu;
}

// M.Tân thêm ngày 25/02/2021 - Get thông tin phiếu Kim Cương Tấm của phiếu vàng Hàng % TT mà phiếu xuất đã chọn
function insert_getPhieuKimCuongTamHangTTXuatKhoKhoVangCuCN($a){
	$id = ceil(trim($a['id']));

	if($id > 0){
		// Dựa vào phiếu xuất này để lấy ra id phiếu vàng Hàng % TT mà phiếu xuất này chọn
		$sqlgetidphieuhangtt = "select id from $GLOBALS[db_sp].vangcucn_khovangcucnct where idphieuxuat=".$id;
		$idphieuhangtt = $GLOBALS['sp']->getOne($sqlgetidphieuhangtt);

		if($idphieuhangtt > 0) {
			// Dựa vào idphieuhangtt để lấy ra phiếu Kim Cương Tấm của nó
			$sqlgetphieukctam = "select * from $GLOBALS[db_sp].vangcucn_khovangcucnct where idcthangtt=".$idphieuhangtt;
			$rsgetphieukctam = $GLOBALS['sp']->getRow($sqlgetphieukctam);
			$arrlist['thanhtienmualaikctam'] = $rsgetphieukctam['thanhtienmualaikctam'];
			$arrlist['tylephantramkctam'] = $rsgetphieukctam['tylephantramkctam'];
		}
	}
	return $arrlist;
}

// M.Tân thêm ngày 02/03/2021 - Điều chỉnh số liệu hạch toán hao dư theo mã kho Phụ Kiện
function dieuChinhSoLieuHachToanHaoDuMaKhoPhuKien($tablehaodu,$tablehachtoan,$idloaivang,$idphukien) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and idphukien=".$idphukien." ORDER BY dated DESC LIMIT 2";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateHD = $arrUpdateHDThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG HAO DƯ (CHÊNH LỆCH) DỰA TRÊN CÁC PHIẾU HAO DƯ ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongHaoDuTrongThang = "select ROUND(SUM(thua), 3) as thua, 
										  ROUND(SUM(thieu), 3) as thieu, 
										  ROUND(SUM(hao), 3) as hao, 
										  ROUND(SUM(du), 3) as du, 
										  ROUND(SUM(haochenhlech), 3) as haochenhlech, 
										  ROUND(SUM(duchenhlech), 3) as duchenhlech
										  from $GLOBALS[db_sp].".$tablehaodu." 
										  where idloaivang=".$idloaivang." and idphukien=".$idphukien." and typeduyet=1
										  and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongHaoDuTrongThang = $GLOBALS['sp']->getRow($sqlTongHaoDuTrongThang);

		// Lấy ra tổng số lượng hao dư (chênh lệch) trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
		$sqlHDSDDKTrongThang = "select thua, thieu, hao, du, haochenhlech, duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated = '".$dateDauThang."'";
		$rsHDSDDKTrongThang = $GLOBALS['sp']->getRow($sqlHDSDDKTrongThang);
		// So sánh số lượng hao dư (chênh lệch) trong sodudauky với tổng số lượng hao dư (chênh lệch) của các phiếu cộng lại
		if($rsTongHaoDuTrongThang['thua'] != $rsHDSDDKTrongThang['thua'] || $rsTongHaoDuTrongThang['thieu'] != $rsHDSDDKTrongThang['thieu'] || $rsTongHaoDuTrongThang['hao'] != $rsHDSDDKTrongThang['hao'] || $rsTongHaoDuTrongThang['du'] != $rsHDSDDKTrongThang['du'] || $rsTongHaoDuTrongThang['haochenhlech'] != $rsHDSDDKTrongThang['haochenhlech'] || $rsTongHaoDuTrongThang['duchenhlech'] != $rsHDSDDKTrongThang['duchenhlech']){
			$arrUpdateHD['thua'] = $rsTongHaoDuTrongThang['thua'];
			$arrUpdateHD['thieu'] = $rsTongHaoDuTrongThang['thieu'];
			$arrUpdateHD['hao'] = $rsTongHaoDuTrongThang['hao'];
			$arrUpdateHD['du'] = $rsTongHaoDuTrongThang['du'];
			$arrUpdateHD['haochenhlech'] = $rsTongHaoDuTrongThang['haochenhlech'];
			$arrUpdateHD['duchenhlech'] = $rsTongHaoDuTrongThang['duchenhlech'];
		}

		vaUpdate($tablehachtoan, $arrUpdateHD, ' idloaivang='.$idloaivang.' and idphukien='.$idphukien.' and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlTongHaoDuThangTiep = "select ROUND(SUM(thua), 3) as thua, 
											 ROUND(SUM(thieu), 3) as thieu, 
											 ROUND(SUM(hao), 3) as hao, 
											 ROUND(SUM(du), 3) as du, 
											 ROUND(SUM(haochenhlech), 3) as haochenhlech, 
											 ROUND(SUM(duchenhlech), 3) as duchenhlech
											 from $GLOBALS[db_sp].".$tablehaodu." 
											 where idloaivang=".$idloaivang." and idphukien=".$idphukien." and typeduyet=1
											 and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
									";
			$rsTongHaoDuThangTiep = $GLOBALS['sp']->getRow($sqlTongHaoDuThangTiep);

			// Lấy ra tổng số lượng hao dư (chênh lệch) trong bảng sodudauky ứng với idloaivang (tháng tiếp theo) để so sánh
			$sqlHDSDDKThangTiep = "select thua, thieu, hao, du, haochenhlech, duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated = '".$dateDauThangTiep."'";
			$rsHDSDDKThangTiep = $GLOBALS['sp']->getRow($sqlHDSDDKThangTiep);
			// So sánh số lượng hao dư (chênh lệch) trong sodudauky với tổng số lượng hao dư (chênh lệch) của các phiếu cộng lại
			if($rsTongHaoDuThangTiep['thua'] != $rsHDSDDKThangTiep['thua'] || $rsTongHaoDuThangTiep['thieu'] != $rsHDSDDKThangTiep['thieu'] || $rsTongHaoDuThangTiep['hao'] != $rsHDSDDKThangTiep['hao'] || $rsTongHaoDuThangTiep['du'] != $rsHDSDDKThangTiep['du'] || $rsTongHaoDuThangTiep['haochenhlech'] != $rsHDSDDKThangTiep['haochenhlech'] || $rsTongHaoDuThangTiep['duchenhlech'] != $rsHDSDDKThangTiep['duchenhlech']){
				$arrUpdateHDThangTiep['thua'] = $rsTongHaoDuThangTiep['thua'];
				$arrUpdateHDThangTiep['thieu'] = $rsTongHaoDuThangTiep['thieu'];
				$arrUpdateHDThangTiep['hao'] = $rsTongHaoDuThangTiep['hao'];
				$arrUpdateHDThangTiep['du'] = $rsTongHaoDuThangTiep['du'];
				$arrUpdateHDThangTiep['haochenhlech'] = $rsTongHaoDuThangTiep['haochenhlech'];
				$arrUpdateHDThangTiep['duchenhlech'] = $rsTongHaoDuThangTiep['duchenhlech'];
			}

			vaUpdate($tablehachtoan, $arrUpdateHDThangTiep, ' idloaivang='.$idloaivang.' and idphukien='.$idphukien.' and dated="'.$dateDauThangTiep.'"');
		}
	}
}
// M.Tân thêm ngày 09/03/2021 - Get phòng ban xuất cho thống kê tồn kho chi tiết (vàng/kim cương tấm) Kho Vàng Cũ Chi Nhánh
function getPhongBanXuatTKTonKhoKhoVangCuCN($id, $table){
	if(!empty($table)){
		if(!empty($id)){
			// Get id phiếu xuất đã chọn phiếu nhập này
			$sqlgetidphieuxuat = "select idphieuxuat from $GLOBALS[db_sp].".$table." where id=".$id;
			$idphieuxuat = $GLOBALS['sp']->getOne($sqlgetidphieuxuat);

			// Get phòng ban của phiếu xuất đã chọn phiếu nhập này
			$sqlGetPhongBanXuat = "select phongban, idketoan, phongbanketoan from $GLOBALS[db_sp].vangcucn_khovangcucn where id=".$idphieuxuat;
			$rsGetPhongBanXuat = $GLOBALS['sp']->getRow($sqlGetPhongBanXuat);

			if($rsGetPhongBanXuat['idketoan'] > 0) { // Nếu idketoan có tồn tại => xuất qua kế toán
				$namephongbanxuat = $rsGetPhongBanXuat['phongbanketoan'];
			} else if($rsGetPhongBanXuat['phongban'] > 0 && $rsGetPhongBanXuat['idketoan'] == 0 && $rsGetPhongBanXuat['phongban'] != 1735) {
				$namephongbanxuat = getNameKhoShort($rsGetPhongBanXuat['phongban']);
			} else {
				$namephongbanxuat = "Đã chọn/Chưa xuất";
			}
		}
		return $namephongbanxuat;
	}
	else {
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
}

// M.Tân thêm ngày 25/01/2022 - get chi nhánh và kỳ báo cáo dựa trên phiếu nhập kim cương tâm mà phiếu xuất kim cương tấm chọn
function insert_getChiNhanhKyBaoCaoKimCuongTamXuatKhoVangCuCN($a) {
	$idPhieuXuat = ceil(trim($a['idPhieuXuat']));

	$arrlist = array();

	if($idPhieuXuat > 0) {
		// Get chi nhánh và kỳ báo cáo dựa trên phiếu nhập kim cương tấm được phiếu xuất này chọn
		$sqlGetChiNhanhKyBC = "select idchinhanh, idkybaocaocn from $GLOBALS[db_sp].vangcucn_khovangcucnct where id=(select idphieuctkctamxk from $GLOBALS[db_sp].vangcucn_khovangcucn where id=".$idPhieuXuat." ) ";
		$rsGetChiNhanhKyBC = $GLOBALS['sp']->getRow($sqlGetChiNhanhKyBC);

		$arrlist['idchinhanh'] = $rsGetChiNhanhKyBC['idchinhanh'];
		$arrlist['idkybaocaocn'] = $rsGetChiNhanhKyBC['idkybaocaocn'];
	}
	return $arrlist;
}

function funcAsyncThongKeTongQuanTriTrenHaiPhanMemKhoVangCuCN($idkybaocao){
	$totalhaoq10 = $totalduq10 = $totalhaotlthuc = $totaldutlthuc = 0;
	$arr_idkybaocao = explode(',', $idkybaocao);
	foreach($arr_idkybaocao as $_idkybaocao) {
		$sqlgetphieuimport = "select tongtlthucmua, tongqui10quantri
									 from $GLOBALS[db_sp].vangcucn_khovangcucn 
									 where idkybaocaocn = $_idkybaocao 
									 and type=4 and trangthai=2 and typevkc=1 ";
		$rsgetphieuimport = $GLOBALS['sp']->getRow($sqlgetphieuimport);

		$sqltongtheokybc = "select ROUND(SUM(cannangvluu), 3) as tongcannangvluu,
								   ROUND(SUM(vangqui10luu), 3) as tongvangqui10luu
								   from $GLOBALS[db_sp].vangcucn_khovangcucnct 
								   where idkybaocaocn = $_idkybaocao 
								   and type=1 and typeduyettruocnau=1 and typevkc=1 and nhomnguyenlieuvang not in (2010,2013,2618,2851) ";
		$rstongtheokybc = $GLOBALS['sp']->getRow($sqltongtheokybc);

		$ketquaqui10 = $rstongtheokybc['tongvangqui10luu'] - $rsgetphieuimport['tongqui10quantri'];
		$ketquatlthucmua = $rstongtheokybc['tongcannangvluu'] - $rsgetphieuimport['tongtlthucmua'];

		if($ketquaqui10 > 0){		
			$totalduq10 = $totalduq10 + $ketquaqui10;
		}
		else{
			$ketquaqui10 = abs($ketquaqui10);
			$totalhaoq10 = $totalhaoq10 + $ketquaqui10;
		}

		if($ketquatlthucmua > 0){		
			$totaldutlthuc = $totaldutlthuc + $ketquatlthucmua;
		}
		else{
			$ketquatlthucmua = abs($ketquatlthucmua);
			$totalhaotlthuc = $totalhaotlthuc + $ketquatlthucmua;
		}
	}
	$arr_result = array("totalhaoq10" => $totalhaoq10, "totalduq10" => $totalduq10, "totalhaotlthuc" => $totalhaotlthuc, "totaldutlthuc" => $totaldutlthuc);
	return $arr_result;
}

function funcAsyncThongKeTongLoiLoTrenHaiPhanMemKhoVangCuCN($idkybaocao){
	// $sql_stored = $GLOBALS['sp']->PrepareSP("CALL getAllTongLoiLoTrenHaiPhanMem_VangCuCN('$idkybaocao')");
	// $rs_stored = $GLOBALS['sp']->Execute($sql_stored)->fetchRow();
	
	// $totalhaoq10 = $rs_stored['totalhaoq10'];
	// $totalduq10 = $rs_stored['totalduq10'];
	// $totalhaotlthuc = $rs_stored['totalhaotlthuc'];
	// $totaldutlthuc = $rs_stored['totaldutlthuc'];

	$totalhaoq10 = $totalduq10 = $totalhaotlthuc = $totaldutlthuc = 0;
	$arr_idkybaocao = explode(',', $idkybaocao);
	foreach($arr_idkybaocao as $_idkybaocao) {
		$sqlgetphieuimport = "select tongtlthucmua, tongqui10lailo
									 from $GLOBALS[db_sp].vangcucn_khovangcucn 
									 where idkybaocaocn = $_idkybaocao 
									 and type=4 and trangthai=2 and typevkc=1 ";
		$rsgetphieuimport = $GLOBALS['sp']->getRow($sqlgetphieuimport);

		$sqltongtheokybc = "select ROUND(SUM(cannangvluu), 3) as tongcannangvluu,
								   ROUND(SUM(vangqui10luu), 3) as tongvangqui10luu
								   from $GLOBALS[db_sp].vangcucn_khovangcucnct 
								   where idkybaocaocn = $_idkybaocao 
								   and type=1 and typeduyettruocnau=1 and typevkc=1 and nhomnguyenlieuvang not in (2010,2013,2618,2851) ";
		$rstongtheokybc = $GLOBALS['sp']->getRow($sqltongtheokybc);

		$ketquaqui10 = $rsgetphieuimport['tongqui10lailo'] - $rstongtheokybc['tongvangqui10luu'];
		$ketquatlthucmua = $rstongtheokybc['tongcannangvluu'] - $rsgetphieuimport['tongtlthucmua'];

		if($ketquaqui10 > 0){	
			$totalduq10 = $totalduq10 + $ketquaqui10;	
		}
		else{
			$ketquaqui10 = abs($ketquaqui10);
			$totalhaoq10 = $totalhaoq10 + $ketquaqui10;
		}

		if($ketquatlthucmua > 0){		
			$totaldutlthuc = $totaldutlthuc + $ketquatlthucmua;
		}
		else{
			$ketquatlthucmua = abs($ketquatlthucmua);
			$totalhaotlthuc = $totalhaotlthuc + $ketquatlthucmua;
		}
	}
	$arr_result = array("totalhaoq10" => $totalhaoq10, "totalduq10" => $totalduq10, "totalhaotlthuc" => $totalhaotlthuc, "totaldutlthuc" => $totaldutlthuc);
	return $arr_result;
}

function funcAsyncThongKeTongLoiLoTrenHaiPhanMemSoVoiSauNauKhoVangCuCN($idkybaocao){
	$totalhaoq10 = $totalduq10 = $totalhaotlthuc = $totaldutlthuc = 0;
	$arr_idkybaocao = explode(',', $idkybaocao);
	foreach($arr_idkybaocao as $_idkybaocao) {
		$sqlgetphieuimport = "select tongtlthucmua, tongqui10lailo
									 from $GLOBALS[db_sp].vangcucn_khovangcucn 
									 where idkybaocaocn = $_idkybaocao 
									 and type=4 and trangthai=2 and typevkc=1 ";
		$rsgetphieuimport = $GLOBALS['sp']->getRow($sqlgetphieuimport);
		// print_r($rsgetphieuimport); die();

		$sqltongtheokybc = "select ROUND(SUM(cannangv), 3) as tongcannangv,
								   ROUND(SUM(vangqui10), 3) as tongvangqui10
								   from $GLOBALS[db_sp].vangcucn_khovangcucnct 
								   where idkybaocaocn = $_idkybaocao 
								   and type=1 and trangthai=2 and typevkc=1 and nhomnguyenlieuvang not in (2010,2013,2618,2851) ";
		$rstongtheokybc = $GLOBALS['sp']->getRow($sqltongtheokybc);

		$ketquaqui10 = $rsgetphieuimport['tongqui10lailo'] - $rstongtheokybc['tongvangqui10'];
		$ketquatlthucmua = $rstongtheokybc['tongcannangv'] - $rsgetphieuimport['tongtlthucmua'];

		if($ketquaqui10 > 0){	
			$totalduq10 = $totalduq10 + $ketquaqui10;
		}
		else{
			$ketquaqui10 = abs($ketquaqui10);
			$totalhaoq10 = $totalhaoq10 + $ketquaqui10;
		}

		if($ketquatlthucmua > 0){
			$totaldutlthuc = $totaldutlthuc + $ketquatlthucmua;
		}
		else{
			$ketquatlthucmua = abs($ketquatlthucmua);
			$totalhaotlthuc = $totalhaotlthuc + $ketquatlthucmua;
		}
	}
	$arr_result = array("totalhaoq10" => $totalhaoq10, "totalduq10" => $totalduq10, "totalhaotlthuc" => $totalhaotlthuc, "totaldutlthuc" => $totaldutlthuc);
	return $arr_result;
}

// M.Tân thêm ngày 08/09/2021 - get Mã phụ kiện mà phiếu xuất Kho Phụ Kiện mới và đơn hàng hoàn thành đã chọn
function insert_getPhuKienDaChonTheoDonHangKhoPhuKien($a) {
	$idphukien = ceil(trim($a['idphukien']));
	$idphieuxuat = ceil(trim($a['idphieuxuat']));
	$iddh = ceil(trim($a['iddh']));
	$table = trim(striptags($a['table']));

	$arrlist = array();

	if($idphukien > 0 && $idphieuxuat > 0 && $iddh > 0 && $table != '') {
		// Get số lượng còn lại của Mã phụ kiện đối với Mã đơn hàng này
		$sqlGetConLai = "select id, soluongbandau, soluongconlai from $GLOBALS[db_sp].".$table." where iddh=".$iddh." and idphukien=".$idphukien." ORDER BY id desc limit 1";
		$rsGetConLai = $GLOBALS['sp']->getRow($sqlGetConLai);

		if((!empty($rsGetConLai['id']) && $rsGetConLai['soluongconlai'] == 0)) {
			// Get xem có Mã phụ kiện đang được phiếu xuất này chọn không
			$sqlGetIDDangChon = "select id from $GLOBALS[db_sp].".$table." where idphieuxuat=".$idphieuxuat." and iddh=".$iddh." and idphukien=".$idphukien;
			$idDangChon = $GLOBALS['sp']->getOne($sqlGetIDDangChon);
		}

		if((!empty($rsGetConLai['id']) && $rsGetConLai['soluongconlai'] != 0) || empty($rsGetConLai['id']) || $idDangChon > 0) {
			$sqlMaPhuKienCT = "select * from $GLOBALS[db_sp].".$table." where idphieuxuat=".$idphieuxuat." and iddh=".iddh." and idphukien=".$idphukien;
			$rsMaPhuKienCT = $GLOBALS['sp']->getRow($sqlMaPhuKienCT);

			if($rsMaPhuKienCT['id'] > 0) {
				$arrlist['id'] = $rsMaPhuKienCT['id'];
				$arrlist['checked'] = "checked";
				$arrlist['codephukien'] = getMaPhuKienCatalogNew($rsMaPhuKienCT['idphukien']);
				$arrlist['soluongbandau'] = $rsMaPhuKienCT['soluongbandau'];
				$arrlist['soluongxuat'] = $rsMaPhuKienCT['soluongxuat'];
				$arrlist['trongluongxuat'] = $rsMaPhuKienCT['trongluongxuat'];
			} else {
				$arrlist['id'] = 0;
				if(empty($rsGetConLai['id'])) {
					$arrlist['flagHasConLai'] = 0;
				} else {
					$arrlist['flagHasConLai'] = 1;
					$arrlist['soluongxuat'] = $rsGetConLai['soluongconlai'];
				}
			}
			$arrlist['flagHidden'] = 0;
		} else {
			$arrlist['flagHidden'] = 1;
		}
	}
	return $arrlist;
}

// M.Tân thêm ngày 17/10/2021 - get Mã phụ kiện mà phiếu xuất Kho Phụ Kiện mới đã chọn (theo Mã SP Catalog)
function insert_getPhuKienDaChonTheoMaSPDonHangKhoPhuKien($a) {
	$idphukien = ceil(trim($a['idphukien']));
	$idphieuxuat = ceil(trim($a['idphieuxuat']));
	$iddh = ceil(trim($a['iddh']));
	$idpr = ceil(trim($a['idpr']));
	$table = trim(striptags($a['table']));

	$arrlist = array();

	if($idphukien > 0 && $idphieuxuat > 0 && $iddh > 0 && $idpr > 0 && $table != '') {
		// Get số lượng còn lại của Mã phụ kiện đối với Mã đơn hàng này (theo Mã SP Catalog)
		$sqlGetConLai = "select id, soluongbandau, soluongconlai from $GLOBALS[db_sp].".$table." where iddh=".$iddh." and idpr=".$idpr." and idphukien=".$idphukien." ORDER BY id desc limit 1";
		$rsGetConLai = $GLOBALS['sp']->getRow($sqlGetConLai);

		if((!empty($rsGetConLai['id']) && $rsGetConLai['soluongconlai'] == 0)) {
			// Get xem có Mã phụ kiện đang được phiếu xuất này chọn không
			$sqlGetIDDangChon = "select id from $GLOBALS[db_sp].".$table." where idphieuxuat=".$idphieuxuat." and iddh=".$iddh." and idpr=".$idpr." and idphukien=".$idphukien;
			$idDangChon = $GLOBALS['sp']->getOne($sqlGetIDDangChon);
		}

		if((!empty($rsGetConLai['id']) && $rsGetConLai['soluongconlai'] != 0) || empty($rsGetConLai['id']) || $idDangChon > 0) {
			$sqlMaPhuKienCT = "select * from $GLOBALS[db_sp].".$table." where idphieuxuat=".$idphieuxuat." and iddh=".iddh." and idpr=".$idpr." and idphukien=".$idphukien;
			$rsMaPhuKienCT = $GLOBALS['sp']->getRow($sqlMaPhuKienCT);

			if($rsMaPhuKienCT['id'] > 0) {
				$arrlist['id'] = $rsMaPhuKienCT['id'];
				$arrlist['checked'] = "checked";
				$arrlist['codephukien'] = getMaPhuKienCatalogNew($rsMaPhuKienCT['idphukien']);
				$arrlist['namephukien'] = getOneNameCatalog("namekho","phukien"," id=".$rsMaPhuKienCT['idphukien']);
				$arrlist['soluongbandau'] = $rsMaPhuKienCT['soluongbandau'];
				$arrlist['soluongxuat'] = $rsMaPhuKienCT['soluongxuat'];
				$arrlist['trongluongxuat'] = $rsMaPhuKienCT['trongluongxuat'];
			} else {
				$arrlist['id'] = 0;
				if(empty($rsGetConLai['id'])) {
					$arrlist['flagHasConLai'] = 0;
				} else {
					$arrlist['flagHasConLai'] = 1;
					$arrlist['soluongxuat'] = $rsGetConLai['soluongconlai'];
				}
			}
			$arrlist['flagHidden'] = 0;
		} else {
			$arrlist['flagHidden'] = 1;
		}
	}
	return $arrlist;
}

// M.Tân thêm ngày 17/11/2021 - get Mã phụ kiện mà phiếu xuất Kho Phụ Kiện DHHT đã chọn (theo Mã SP Catalog)
function insert_getPhuKienDaChonTheoMaSPDonHangKhoPhuKienDHHT($a) {
	$idphukien = ceil(trim($a['idphukien']));
	$idphieuxuat = ceil(trim($a['idphieuxuat']));
	$iddh = ceil(trim($a['iddh']));
	$idpr = ceil(trim($a['idpr']));
	$table = trim(striptags($a['table']));

	$arrlist = array();

	if($idphukien > 0 && $idphieuxuat > 0 && $iddh > 0 && $idpr > 0 && $table != '') {
		// Get tổng số lượng phụ kiện của idphukien trong iddh này (theo Mã SP Catalog) mà Kho phụ kiện mới đã xuất qua
		$sqlTongNhapFromNewIdPhuKienMaSP = "select sum(soluongxuat) as tongsoluongnhap from $GLOBALS[db_sp].khosanxuat_phukien_new_maphukienct where iddh=".$iddh." and idpr=".$idpr." and idphukien=".$idphukien." and idphieuxuat in ( select id from $GLOBALS[db_sp].khosanxuat_phukien_new where type=3 and trangthai=2 ) ";
		$tongNhapFromNewIdPhuKienMaSP = $GLOBALS['sp']->getOne($sqlTongNhapFromNewIdPhuKienMaSP);
		
		// Get tổng số lượng phụ kiện đã chọn xuất của idphukien trong iddh này (theo Mã SP Catalog)
		$sqlTongChonXuatIdPhuKienMaSP = "select sum(soluongxuat) as tongsoluongxuat from $GLOBALS[db_sp].".$table." where iddh=".$iddh." and idpr=".$idpr." and idphukien=".$idphukien;
		$tongChonXuatIdPhuKienMaSP = $GLOBALS['sp']->getOne($sqlTongChonXuatIdPhuKienMaSP);

		if($tongChonXuatIdPhuKienMaSP == $tongNhapFromNewIdPhuKienMaSP) {
			// Get xem có Mã phụ kiện đang được phiếu xuất này chọn không
			$sqlGetIDDangChon = "select id from $GLOBALS[db_sp].".$table." where idphieuxuat=".$idphieuxuat." and iddh=".$iddh." and idpr=".$idpr." and idphukien=".$idphukien;
			$idDangChon = $GLOBALS['sp']->getOne($sqlGetIDDangChon);
		}

		if(($tongChonXuatIdPhuKienMaSP != $tongNhapFromNewIdPhuKienMaSP) || $idDangChon > 0) {
			$sqlMaPhuKienCT = "select * from $GLOBALS[db_sp].".$table." where idphieuxuat=".$idphieuxuat." and iddh=".iddh." and idpr=".$idpr." and idphukien=".$idphukien;
			$rsMaPhuKienCT = $GLOBALS['sp']->getRow($sqlMaPhuKienCT);

			if($rsMaPhuKienCT['id'] > 0) {
				$arrlist['id'] = $rsMaPhuKienCT['id'];
				$arrlist['checked'] = "checked";
				$arrlist['codephukien'] = getMaPhuKienCatalogNew($rsMaPhuKienCT['idphukien']);
				$arrlist['namephukien'] = getOneNameCatalog("namekho","phukien"," id=".$rsMaPhuKienCT['idphukien']);
				$arrlist['soluongbandau'] = $rsMaPhuKienCT['soluongbandau'];
				$arrlist['soluongxuat'] = $rsMaPhuKienCT['soluongxuat'];
				$arrlist['trongluongxuat'] = $rsMaPhuKienCT['trongluongxuat'];
			} else {
				$arrlist['id'] = 0;
				$arrlist['soluongxuat'] = round(($tongNhapFromNewIdPhuKienMaSP - $tongChonXuatIdPhuKienMaSP),3);
			}
			$arrlist['flagHidden'] = 0;
		} else {
			$arrlist['flagHidden'] = 1;
		}
	}
	return $arrlist;
}

// M.Tân thêm ngày 19/09/2021 - Hạch toán theo cả mã phụ kiện và loại vàng (mã phụ kiện chọn từ đơn hàng trong table tablemaphukienct)
function ghiSoHachToanMaPhuKienTheoDonHang($tablehachtoan, $tablect, $tablemaphukienct, $id, $typehachtoan) {
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');

	/////////////////Ghi vào sổ đầu kỳ(hạch toán) khosanxuat_phukienma_sodudauky////////////////
	$item = getTableRow($tablect,' and id='.$id);
	
	if($typehachtoan =='nhapkho'){
		$item['type'] = 1;
	}
	if($typehachtoan =='xuatkho'){
		$item['type'] = 2;
	}

	// Dựa vào phiếu get ra chi tiết phụ kiện của đơn hàng mà phiếu này chọn
	$sqlGetChiTietPhuKienChon = "select idphukien, soluongxuat, trongluongxuat from $GLOBALS[db_sp].".$tablemaphukienct." where idphieuxuat=".$id;
	$rsGetChiTietPhuKienChon = $GLOBALS['sp']->getAll($sqlGetChiTietPhuKienChon);
	
	foreach($rsGetChiTietPhuKienChon as $itemGetChiTietPhuKienChon) {
		unset($arrnx1day);
		$arrnx1day =  array();
		$soluongnhapphukien = $soluongxuatphukien = $soluongtonphukien = $soluongnhapvang = $soluongxuatvang = $soluongtonvang = $slnhapphukien = $slxuatphukien = $slnhapv = $slxuatv = 0;

		// Check type để gán số lượng vào nhập hay xuất
		if($item['type'] == 1){ // 1 = nhập
			$slnhapphukien = $itemGetChiTietPhuKienChon['soluongxuat'];
			$slnhapv = $itemGetChiTietPhuKienChon['trongluongxuat'];
		} else { // 2 = xuất
			$slxuatphukien = $itemGetChiTietPhuKienChon['soluongxuat'];
			$slxuatv = $itemGetChiTietPhuKienChon['trongluongxuat'];
		}

		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idphukien=".$itemGetChiTietPhuKienChon['idphukien']." AND idloaivang=".$item['idloaivang']." AND dated='".$datedauthang."'";
		$rsdate = $GLOBALS['sp']->getRow($sqldate);
		
		if(empty($rsdate['id'])){// chưa có dated trong csdl $tablehachtoan thì insert vào // hạch toán trong tháng
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idphukien=".$itemGetChiTietPhuKienChon['idphukien']." AND idloaivang=".$item['idloaivang']." order by dated desc limit 1"; // Lấy tháng cuối cùng hạch toán của idphukien ứng với idloaivang đó
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);

			if($rstru1day['id'] > 0){ // Nếu tồn tại ngày cuối cùng thì lấy số lượng tồn còn lại của idphukien ứng với idloadvang đó
				$soluongtonphukien = $rstru1day['sltonphukien'];
				$soluongtonvang = $rstru1day['sltonv'];
			}
			
			// Số lượng phụ kiện
			$soluongnhapphukien = round(($soluongnhapphukien + $slnhapphukien),3);
			$soluongxuatphukien = round(($soluongxuatphukien + $slxuatphukien),3);
			$soluongtonphukien = round(round(($soluongtonphukien + $slnhapphukien),3) - $slxuatphukien,3);

			// Số lượng vàng
			$soluongnhapvang = round(($soluongnhapvang + $slnhapv),3);
			$soluongxuatvang = round(($soluongxuatvang + $slxuatv),3);
			$soluongtonvang = round(round(($soluongtonvang + $slnhapv),3) - $slxuatv,3);
			
			$arrnx1day['slnhapphukien'] = $soluongnhapphukien;
			$arrnx1day['slxuatphukien'] = $soluongxuatphukien;
			$arrnx1day['sltonphukien'] = $soluongtonphukien;

			$arrnx1day['slnhapv'] = $soluongnhapvang;
			$arrnx1day['slxuatv'] = $soluongxuatvang;
			$arrnx1day['sltonv'] = $soluongtonvang;

			$arrnx1day['idphukien'] = $itemGetChiTietPhuKienChon['idphukien'];
			$arrnx1day['idloaivang'] = $item['idloaivang'];

			$arrnx1day['dated'] = $datedauthang;
			
			vaInsert($tablehachtoan, $arrnx1day);

		} else {// có rồi thi update vào sodudauky
			// Số lượng phụ kiện
			$soluongnhapphukien = round(($rsdate['slnhapphukien'] + $slnhapphukien),3);
			$soluongxuatphukien = round(($rsdate['slxuatphukien'] + $slxuatphukien),3);
			$soluongtonphukien = round(round(($rsdate['sltonphukien'] + $slnhapphukien),3) - $slxuatphukien,3);

			// Số lượng vàng
			$soluongnhapvang = round(($rsdate['slnhapv'] + $slnhapv),3);
			$soluongxuatvang = round(($rsdate['slxuatv'] + $slxuatv),3);
			$soluongtonvang = round(round(($rsdate['sltonv'] + $slnhapv),3) - $slxuatv,3);

			$arrnx1day['slnhapphukien'] = $soluongnhapphukien;
			$arrnx1day['slxuatphukien'] = $soluongxuatphukien;
			$arrnx1day['sltonphukien'] = $soluongtonphukien;

			$arrnx1day['slnhapv'] = $soluongnhapvang;
			$arrnx1day['slxuatv'] = $soluongxuatvang;
			$arrnx1day['sltonv'] = $soluongtonvang;

			vaUpdate($tablehachtoan, $arrnx1day,' id='.$rsdate['id']);
		}
	}
}

// M.Tân thêm ngày 26/09/2021 - Thống kê Nhập xuất tồn phụ kiện Kho phụ kiện mới
function insert_thongKeNhapXuatTonMaPhuKienNew($a){
	$arrlist = array();
	$sqlhaodusddk = $rshaodusddk = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt = $sqlhaodu = $rshaodu = $sqlnhap = $rsnhap = $sqlxuat = $rsxuat = '';
	$sltonVsddk = $sltonPKsddk = $sltonPKtndt = $sltonVtndt = $sltonPKtndn = $sltonVtndn = $slnhap = $slxuat = $sltontndt = 0;
	
	$table = trim(striptags($a['table']));
	$tablehachtoanma = trim(striptags($a['tablehachtoanma']));
	$tablehaodu = trim(striptags($a['tablehaodu']));
	$tablemaphukienct = trim(striptags($a['tablemaphukienct']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$datenow = date("Y-m-d");

	$idphukien = ceil(trim($a['idphukien']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	if(!empty($table) && !empty($tablehachtoanma) && !empty($tablemaphukienct)){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		} else {
			$fromDate = date("d/m/Y");
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		} else {
			$toDate = date("d/m/Y");
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		}

		if($idphukien > 0 && $idloaivang > 0) {
			// Lấy tháng trước của ngày chọn, nếu không chọn thì lấy tháng trước của ngày hiện tại
			$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
			$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
			// die($thangtruoc);

			//Get số lượng hao dư đầu kỳ
			$sqlhaodusddk = "select ROUND(SUM(thua), 3) as thua, 
									ROUND(SUM(thieu), 3) as thieu, 
									ROUND(SUM(haochenhlech), 3) as haochenhlech, 
									ROUND(SUM(duchenhlech), 3) as duchenhlech 
									from $GLOBALS[db_sp].".$tablehachtoanma." 
									where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
									and dated <= '".$thangtruoc."' 
							";
			$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);

			// Get số lượng đầu kỳ (nếu tháng trước có hạch toán thì lấy tháng trước đó, ko thì thấy tháng gần nhất có hạch toán)
			$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated <= '".$thangtruoc."' order by id desc limit 1";
			$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
			
			// Lấy ra số lượng tồn phụ kiện của tháng đó
			$sltonPKsddk = round(round(($rstonsddk['sltonphukien'] + $rshaodusddk['thieu']),10) - $rshaodusddk['thua'],10);

			// Tính số lượng vàng tồn còn lại dựa trên số dư đầu kỳ hao dư
			// $sltonVsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);
			$sltonVsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'],10);
			
			$thangdauky = $rstonsddk['dated'];
			
			// Get số lượng hao dư ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sqlhaodutndt = "select ROUND(SUM(thua), 3) as thua, 
									ROUND(SUM(thieu), 3) as thieu, 
									ROUND(SUM(haochenhlech), 3) as haochenhlech, 
									ROUND(SUM(duchenhlech), 3) as duchenhlech 
									from $GLOBALS[db_sp].".$tablehaodu." 
								 	where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
								 	and dated < '".$fromDate."' 
								 	and dated >= '".$datedauthang."' 
							";
			$rshaodutndt = $GLOBALS['sp']->getRow($sqlhaodutndt);
			// die($sqlhaodutndt);

			$sqlnhaptndt = "select ROUND(SUM(cannangv), 3) as slnhapvang, 
								   ROUND(SUM(soluongphukien), 3) as slnhapphukien 
								   from $GLOBALS[db_sp].".$table." 
								   where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
								   and type=1 
								   and typechuyen=2 
								   and dated < '".$fromDate."' 
								   and dated >= '".$datedauthang."' 
						   "; 
			$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
			// die($sqlnhaptndt);
			
			// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất có Đơn hàng phụ kiện
			$sqlxuattndtCoDonHang = "select ROUND(SUM(trongluongxuat), 3) as slxuatvang, 
											ROUND(SUM(soluongxuat), 3) as slxuatphukien 
											from $GLOBALS[db_sp].".$tablemaphukienct." 
											where idphukien=".$idphukien." 
											and idphieuxuat in (select id from $GLOBALS[db_sp].".$table." where type=3 
											and trangthai=2 and idloaivang=".$idloaivang." 
											and datedxuat < '".$fromDate."' 
											and datedxuat >= '".$datedauthang."' ) 
									";
			$rsxuattndtCoDonHang = $GLOBALS["sp"]->getRow($sqlxuattndtCoDonHang);

			// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất Không đơn hàng
			$sqlxuattndtKhongDonHang = "select ROUND(SUM(cannangv), 3) as slxuatvang, 
											   ROUND(SUM(soluongphukien), 3) as slxuatphukien 
											   from $GLOBALS[db_sp].".$table." 
											   where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
											   and madhin=-1 
											   and type=3 and trangthai=2 
											   and datedxuat < '".$fromDate."' 
											   and datedxuat >= '".$datedauthang."' 
										";
			$rsxuattndtKhongDonHang = $GLOBALS["sp"]->getRow($sqlxuattndtKhongDonHang);

			// Tính tổng số lượng phụ kiện, cân nặng vàng xuất tổng (= xuất có đơn hàng + xuất không đơn hàng)
			$soLuongPhuKienXuatTNDN = round(($rsxuattndtCoDonHang['slxuatphukien'] + $rsxuattndtKhongDonHang['slxuatphukien']),10);
			$soLuongVangXuatTNDN = round(($rsxuattndtCoDonHang['slxuatvang'] + $rsxuattndtKhongDonHang['slxuatvang']),10);

			// Tính số lượng tồn phụ kiện khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sltonPKtndt = round(($rsnhaptndt['slnhapphukien'] - $soLuongPhuKienXuatTNDN),10);
			$sltonPKtndt = round(($sltonPKtndt + round(($rshaodutndt['thieu'] - $rshaodutndt['thua']),10)),10);
			$sltonPKsddk = round(($sltonPKsddk + $sltonPKtndt),10);

			// Tính số lượng tồn vàng khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sltonVtndt = round(($rsnhaptndt['slnhapvang'] - $soLuongVangXuatTNDN),10);
			$sltonVtndt = round(($sltonVtndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),10)),10); 
			$sltonVsddk = round(($sltonVsddk + $sltonVtndt),10);
			
			// Get số lượng nhập, xuất, hao, dư, tồn từ ngày đến ngày 
			$sqlhaodu = "select ROUND(SUM(thua), 3) as thua, 
								ROUND(SUM(thieu), 3) as thieu, 
								ROUND(SUM(haochenhlech), 3) as haochenhlech, 
								ROUND(SUM(duchenhlech), 3) as duchenhlech 
								from $GLOBALS[db_sp].".$tablehaodu." 
								where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
								and dated >= '".$fromDate."' 
								and dated <= '".$toDate."' 
						";
			$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
				
			$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang, 
							   ROUND(SUM(soluongphukien), 3) as slnhapphukien 
							   from $GLOBALS[db_sp].".$table." 
							   where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
							   and type=1 
							   and typechuyen=2 
							   and dated >= '".$fromDate."' 
						       and dated <= '".$toDate."' 
						"; 
			$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	

			// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất có Đơn hàng phụ kiện
			$sqlxuatCoDonHang = "select ROUND(SUM(trongluongxuat), 3) as slxuatvang, 
										ROUND(SUM(soluongxuat), 3) as slxuatphukien 
										from $GLOBALS[db_sp].".$tablemaphukienct." 
										where idphukien=".$idphukien." 
										and idphieuxuat in (select id from $GLOBALS[db_sp].".$table." where type=3 
										and trangthai=2 and idloaivang=".$idloaivang." 
										and datedxuat >= '".$fromDate."' 
										and datedxuat <= '".$toDate."' ) 
								";
			$rsxuatCoDonHang = $GLOBALS["sp"]->getRow($sqlxuatCoDonHang);

			// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất Không đơn hàng
			$sqlxuatKhongDonHang = "select ROUND(SUM(cannangv), 3) as slxuatvang, 
										   ROUND(SUM(soluongphukien), 3) as slxuatphukien 
										   from $GLOBALS[db_sp].".$table." 
										   where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
										   and madhin=-1 
										   and type=3 and trangthai=2 
										   and datedxuat >= '".$fromDate."' 
										   and datedxuat <= '".$toDate."'  
									";
			$rsxuatKhongDonHang = $GLOBALS["sp"]->getRow($sqlxuatKhongDonHang);

			// Tính tổng số lượng phụ kiện, cân nặng vàng xuất tổng (= xuất có đơn hàng + xuất không đơn hàng)
			$soLuongPhuKienXuat = round(($rsxuatCoDonHang['slxuatphukien'] + $rsxuatKhongDonHang['slxuatphukien']),10);
			$soLuongVangXuat = round(($rsxuatCoDonHang['slxuatvang'] + $rsxuatKhongDonHang['slxuatvang']),10);

			// Tính số lượng tồn phụ kiện từ ngày đến ngày
			$sltonPKtndn = round(($rsnhap['slnhapphukien'] - $soLuongPhuKienXuat),10);
			$sltonPKtndn = $sltonPKtndn + round(($rshaodu['thieu'] - $rshaodu['thua']),10);

			// Tính số lượng tồn vàng từ ngày đến ngày
			$sltonVtndn = round(($rsnhap['slnhapvang'] -  $soLuongVangXuat),10);
			$sltonVtndn = $sltonVtndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),10);

			// Tổng số lượng tồn phụ kiện cuối kỳ
			$sltonPK = $sltonPKsddk + $sltonPKtndn;

			// Tổng trọng lượng tồn vàng cuối kỳ
			$sltonV = $sltonVsddk + $sltonVtndn;
			
			// Hiển thị số lượng phụ kiện tồn đầu kỳ
			$arrlist['sltonPKsddk'] = $sltonPKsddk;

			// Hiển thị trọng lượng vàng tồn đầu kỳ
			$arrlist['sltonVsddk'] = $sltonVsddk;

			// Hiển thị số lượng phụ kiện nhập xuất trong kỳ
			$arrlist['slnhapphukien'] = $rsnhap['slnhapphukien'];
			$arrlist['slxuatphukien'] = $soLuongPhuKienXuat;

			// Hiển thị trọng lượng vàng nhập xuất trong kỳ
			$arrlist['slnhapvang'] = $rsnhap['slnhapvang'];
			$arrlist['slxuatvang'] = $soLuongVangXuat;

			// Hiển thị số lượng phụ kiện tồn cuối kỳ
			$arrlist['sltonPK'] = $sltonPK;

			// Hiển thị trọng lượng vàng tồn cuối kỳ
			$arrlist['sltonV'] = $sltonV;

			// Hiển thị số lượng thừa, thiếu, hao chênh lệch, dư chênh lệch
			$arrlist['slthua'] = $rshaodu['thua'];
			$arrlist['slthieu'] = $rshaodu['thieu'];
			$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
			$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
		
			$arrlist['idloaivang'] = $idloaivang;
			$arrlist['idphukien'] = $idphukien;
			
			$arrlist['tongQ10'] = getTongQ10Round10($arrlist['sltonV'], $arrlist['idloaivang']);	
			
		}
		else{
			$arrlist['idphukien'] = 0;
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

// M.Tân thêm ngày 28/09/2021 - Thống kê Nhập xuất tồn phụ kiện Kho phụ kiện đơn hàng hoàn thành
function insert_thongKeNhapXuatTonMaPhuKienDHHT($a){
	$arrlist = array();
	$sqlhaodusddk = $rshaodusddk = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndtCoDonHang = $rsxuattndtCoDonHang = $sqlxuattndtKhongDonHang = $rsxuattndtKhongDonHang = $sqlhaodu = $rshaodu = $sqlnhap = $rsnhap = $sqlxuatCoDonHang = $rsxuatCoDonHang = $sqlxuatKhongDonHang = $rsxuatKhongDonHang = '';
	$sltonVsddk = $sltonPKsddk = $soLuongPhuKienXuatTNDN = $soLuongVangXuatTNDN = $sltonPKtndt = $sltonVtndt = $soLuongPhuKienXuat = $soLuongVangXuat = $sltonPKtndn = $sltonVtndn = $slnhap = $slxuat = $sltontndt = 0;
	
	$table = trim(striptags($a['table']));
	$tablehachtoanma = trim(striptags($a['tablehachtoanma']));
	$tablehaodu = trim(striptags($a['tablehaodu']));
	$tablemaphukienct = trim(striptags($a['tablemaphukienct']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];
	$datenow = date("Y-m-d");

	$idphukien = ceil(trim($a['idphukien']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	if(!empty($table) && !empty($tablehachtoanma) && !empty($tablemaphukienct)){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		} else {
			$fromDate = date("d/m/Y");
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		} else {
			$toDate = date("d/m/Y");
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		}

		if($idphukien > 0 && $idloaivang > 0) {
			// Lấy tháng trước của ngày chọn, nếu không chọn thì lấy tháng trước của ngày hiện tại
			$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
			$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
			// die($thangtruoc);

			//Get số lượng hao dư đầu kỳ
			$sqlhaodusddk = "select ROUND(SUM(thua), 3) as thua, 
									ROUND(SUM(thieu), 3) as thieu, 
									ROUND(SUM(haochenhlech), 3) as haochenhlech, 
									ROUND(SUM(duchenhlech), 3) as duchenhlech 
									from $GLOBALS[db_sp].".$tablehachtoanma." 
									where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
									and dated <= '".$thangtruoc."' 
							";
			$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);

			// Get số lượng đầu kỳ (nếu tháng trước có hạch toán thì lấy tháng trước đó, ko thì thấy tháng gần nhất có hạch toán)
			$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated <= '".$thangtruoc."' order by id desc limit 1";
			$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
			
			// Lấy ra số lượng tồn phụ kiện của tháng đó
			$sltonPKsddk = round(round(($rstonsddk['sltonphukien'] + $rshaodusddk['thieu']),10) - $rshaodusddk['thua'],10);

			// Tính số lượng vàng tồn còn lại dựa trên số dư đầu kỳ hao dư
			// $sltonVsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);
			$sltonVsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['haochenhlech']),10) + $rshaodusddk['duchenhlech'],10);
			
			$thangdauky = $rstonsddk['dated'];
			
			// Get số lượng hao dư ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sqlhaodutndt = "select ROUND(SUM(thua), 3) as thua, 
									ROUND(SUM(thieu), 3) as thieu, 
									ROUND(SUM(haochenhlech), 3) as haochenhlech, 
									ROUND(SUM(duchenhlech), 3) as duchenhlech 
									from $GLOBALS[db_sp].".$tablehaodu." 
								 	where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
								 	and dated < '".$fromDate."' 
								 	and dated >= '".$datedauthang."' 
							";
			$rshaodutndt = $GLOBALS['sp']->getRow($sqlhaodutndt);
			// die($sqlhaodutndt);

			$sqlnhaptndt = "select ROUND(SUM(trongluongxuat), 3) as slnhapvang, 
								   ROUND(SUM(soluongxuat), 3) as slnhapphukien 
								   from $GLOBALS[db_sp].khosanxuat_phukien_new_maphukienct 
								   where idphukien=".$idphukien." 
								   and idphieuxuat in (select idmaphieukho from $GLOBALS[db_sp].".$table." where type=1 
								   and typechuyen=2 and idloaivang=".$idloaivang." 
								   and dated < '".$fromDate."' 
								   and dated >= '".$datedauthang."' ) 
						   "; 
			$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
			// die($sqlnhaptndt);
			
			// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất có Đơn hàng phụ kiện
			$sqlxuattndtCoDonHang = "select ROUND(SUM(trongluongxuat), 3) as slxuatvang, 
											ROUND(SUM(soluongxuat), 3) as slxuatphukien 
											from $GLOBALS[db_sp].".$tablemaphukienct." 
											where idphukien=".$idphukien." 
											and idphieuxuat in (select id from $GLOBALS[db_sp].".$table." where type=3 
											and trangthai=2 and idloaivang=".$idloaivang." 
											and datedxuat < '".$fromDate."' 
											and datedxuat >= '".$datedauthang."' ) 
									";
			$rsxuattndtCoDonHang = $GLOBALS["sp"]->getRow($sqlxuattndtCoDonHang);

			// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất Không đơn hàng
			$sqlxuattndtKhongDonHang = "select ROUND(SUM(cannangv), 3) as slxuatvang, 
											   ROUND(SUM(soluongphukien), 3) as slxuatphukien 
											   from $GLOBALS[db_sp].".$table." 
											   where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
											   and madhin=-1 
											   and type=3 and trangthai=2 
											   and datedxuat < '".$fromDate."' 
											   and datedxuat >= '".$datedauthang."' 
										";
			$rsxuattndtKhongDonHang = $GLOBALS["sp"]->getRow($sqlxuattndtKhongDonHang);

			// Tính tổng số lượng phụ kiện, cân nặng vàng xuất tổng (= xuất có đơn hàng + xuất không đơn hàng)
			$soLuongPhuKienXuatTNDN = round(($rsxuattndtCoDonHang['slxuatphukien'] + $rsxuattndtKhongDonHang['slxuatphukien']),10);
			$soLuongVangXuatTNDN = round(($rsxuattndtCoDonHang['slxuatvang'] + $rsxuattndtKhongDonHang['slxuatvang']),10);

			// Tính số lượng tồn phụ kiện khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sltonPKtndt = round(($rsnhaptndt['slnhapphukien'] - $soLuongPhuKienXuatTNDN),10);
			$sltonPKtndt = round(($sltonPKtndt + round(($rshaodutndt['thieu'] - $rshaodutndt['thua']),10)),10);
			$sltonPKsddk = round(($sltonPKsddk + $sltonPKtndt),10);

			// Tính số lượng tồn vàng khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sltonVtndt = round(($rsnhaptndt['slnhapvang'] - $soLuongVangXuatTNDN),10);
			$sltonVtndt = round(($sltonVtndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),10)),10); 
			$sltonVsddk = round(($sltonVsddk + $sltonVtndt),10);
			
			// Get số lượng nhập, xuất, hao, dư, tồn từ ngày đến ngày 
			$sqlhaodu = "select ROUND(SUM(thua), 3) as thua, 
								ROUND(SUM(thieu), 3) as thieu, 
								ROUND(SUM(haochenhlech), 3) as haochenhlech, 
								ROUND(SUM(duchenhlech), 3) as duchenhlech 
								from $GLOBALS[db_sp].".$tablehaodu." 
								where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
								and dated >= '".$fromDate."' 
								and dated <= '".$toDate."' 
						";
			$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
				
			$sqlnhap = "select ROUND(SUM(trongluongxuat), 3) as slnhapvang, 
							   ROUND(SUM(soluongxuat), 3) as slnhapphukien 
							   from $GLOBALS[db_sp].khosanxuat_phukien_new_maphukienct 
							   where idphukien=".$idphukien." 
							   and idphieuxuat in (select idmaphieukho from $GLOBALS[db_sp].".$table." where type=1 
							   and typechuyen=2 and idloaivang=".$idloaivang." 
							   and dated >= '".$fromDate."' 
						       and dated <= '".$toDate."' ) 
						";
			$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	

			// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất có Đơn hàng phụ kiện
			$sqlxuatCoDonHang = "select ROUND(SUM(trongluongxuat), 3) as slxuatvang, 
										ROUND(SUM(soluongxuat), 3) as slxuatphukien 
										from $GLOBALS[db_sp].".$tablemaphukienct." 
										where idphukien=".$idphukien." 
										and idphieuxuat in (select id from $GLOBALS[db_sp].".$table." where type=3 
										and trangthai=2 and idloaivang=".$idloaivang." 
										and datedxuat >= '".$fromDate."' 
										and datedxuat <= '".$toDate."' ) 
								";
			$rsxuatCoDonHang = $GLOBALS["sp"]->getRow($sqlxuatCoDonHang);

			// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất Không đơn hàng
			$sqlxuatKhongDonHang = "select ROUND(SUM(cannangv), 3) as slxuatvang, 
										   ROUND(SUM(soluongphukien), 3) as slxuatphukien 
										   from $GLOBALS[db_sp].".$table." 
										   where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
										   and madhin=-1 
										   and type=3 and trangthai=2 
										   and datedxuat >= '".$fromDate."' 
										   and datedxuat <= '".$toDate."'  
									";
			$rsxuatKhongDonHang = $GLOBALS["sp"]->getRow($sqlxuatKhongDonHang);

			// Tính tổng số lượng phụ kiện, cân nặng vàng xuất tổng (= xuất có đơn hàng + xuất không đơn hàng)
			$soLuongPhuKienXuat = round(($rsxuatCoDonHang['slxuatphukien'] + $rsxuatKhongDonHang['slxuatphukien']),10);
			$soLuongVangXuat = round(($rsxuatCoDonHang['slxuatvang'] + $rsxuatKhongDonHang['slxuatvang']),10);

			// Tính số lượng tồn phụ kiện từ ngày đến ngày
			$sltonPKtndn = round(($rsnhap['slnhapphukien'] - $soLuongPhuKienXuat),10);
			$sltonPKtndn = $sltonPKtndn + round(($rshaodu['thieu'] - $rshaodu['thua']),10);

			// Tính số lượng tồn vàng từ ngày đến ngày
			$sltonVtndn = round(($rsnhap['slnhapvang'] -  $soLuongVangXuat),10);
			$sltonVtndn = $sltonVtndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),10);

			// Tổng số lượng tồn phụ kiện cuối kỳ
			$sltonPK = $sltonPKsddk + $sltonPKtndn;

			// Tổng trọng lượng tồn vàng cuối kỳ
			$sltonV = $sltonVsddk + $sltonVtndn;
			
			// Hiển thị số lượng phụ kiện tồn đầu kỳ
			$arrlist['sltonPKsddk'] = $sltonPKsddk;

			// Hiển thị trọng lượng vàng tồn đầu kỳ
			$arrlist['sltonVsddk'] = $sltonVsddk;

			// Hiển thị số lượng phụ kiện nhập xuất trong kỳ
			$arrlist['slnhapphukien'] = $rsnhap['slnhapphukien'];
			$arrlist['slxuatphukien'] = $soLuongPhuKienXuat;

			// Hiển thị trọng lượng vàng nhập xuất trong kỳ
			$arrlist['slnhapvang'] = $rsnhap['slnhapvang'];
			$arrlist['slxuatvang'] = $soLuongVangXuat;

			// Hiển thị số lượng phụ kiện tồn cuối kỳ
			$arrlist['sltonPK'] = $sltonPK;

			// Hiển thị trọng lượng vàng tồn cuối kỳ
			$arrlist['sltonV'] = $sltonV;

			// Hiển thị số lượng thừa, thiếu, hao chênh lệch, dư chênh lệch
			$arrlist['slthua'] = $rshaodu['thua'];
			$arrlist['slthieu'] = $rshaodu['thieu'];
			$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
			$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
		
			$arrlist['idloaivang'] = $idloaivang;
			$arrlist['idphukien'] = $idphukien;
			
			$arrlist['tongQ10'] = getTongQ10Round10($arrlist['sltonV'], $arrlist['idloaivang']);	
			
		}
		else{
			$arrlist['idphukien'] = 0;
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

// M.Tân thêm ngày 11/10/2021 - Điều chỉnh số liệu hạch toán theo cả idloaivang và idphukien của Kho Phụ kiện mới
function dieuChinhSoLieuHachToanMaKhoPhuKienNew($table,$tablemaphukienct,$tablehachtoanma,$idloaivang,$idphukien,$monthsNeedToUpdate) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." ORDER BY dated DESC LIMIT $monthsNeedToUpdate";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG VÀ IDPHUKIEN ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangv), 3) as cannangv,
										 ROUND(SUM(soluongphukien), 3) as soluongphukien
										 from $GLOBALS[db_sp].".$table." 
										 where type=1 and typechuyen=2 
										 and idloaivang=".$idloaivang." and idphukien=".$idphukien."
										 and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG VÀ IDPHUKIEN ĐANG XỬ LÝ
		$sqlTongXuatTrongThangCoDonHang = "select ROUND(SUM(trongluongxuat), 3) as cannangv,
												  ROUND(SUM(soluongxuat), 3) as soluongphukien 
												  from $GLOBALS[db_sp].".$tablemaphukienct." 
												  where idphukien=".$idphukien." 
												  and idphieuxuat in (select id from $GLOBALS[db_sp].".$table." where type=3 
												  and trangthai=2 and idloaivang=".$idloaivang." 
												  and datedxuat >= '".$dateDauThang."' 
												  and datedxuat <= '".$dateCuoiThang."' ) 
										";
		$rsTongXuatTrongThangCoDonHang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThangCoDonHang);

		// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất Không đơn hàng
		$sqlTongXuatTrongThangKhongDonHang = "select ROUND(SUM(cannangv), 3) as cannangv, 
													 ROUND(SUM(soluongphukien), 3) as soluongphukien 
													 from $GLOBALS[db_sp].".$table." 
													 where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
													 and madhin=-1 
													 and type=3 and trangthai=2 
													 and datedxuat >= '".$dateDauThang."' 
													 and datedxuat <= '".$dateCuoiThang."'  
											";
		$rsTongXuatTrongThangKhongDonHang = $GLOBALS["sp"]->getRow($sqlTongXuatTrongThangKhongDonHang);

		// Tính tổng số lượng phụ kiện, cân nặng vàng xuất tổng (= xuất có đơn hàng + xuất không đơn hàng)
		$soLuongPhuKienXuatTrongThang = round(($rsTongXuatTrongThangCoDonHang['soluongphukien'] + $rsTongXuatTrongThangKhongDonHang['soluongphukien']),3);
		$soLuongVangXuatTrongThang = round(($rsTongXuatTrongThangCoDonHang['cannangv'] + $rsTongXuatTrongThangKhongDonHang['cannangv']),3);

		// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang và idphukien (tháng đó) để so sánh
		$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated = '".$dateDauThang."'";
		$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK) {
			$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
			$arrUpdateNX['slnhapphukien'] = $rsTongNhapTrongThang['soluongphukien'];
		}

		// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang và idphukien (tháng đó) để so sánh
		$sqlXuatSDDKTrongThang = "select slxuatv from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated = '".$dateDauThang."'";
		$slxuatvSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($soLuongVangXuatTrongThang != $slxuatvSDDK) {
			$arrUpdateNX['slxuatv'] = $soLuongVangXuatTrongThang;
			$arrUpdateNX['slxuatphukien'] = $soLuongPhuKienXuatTrongThang;
		}

		// Lấy ngày của tháng trước có hạch toán
		$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated < '".$dateDauThang."' order by dated desc limit 1";
		$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
		
		// Lấy ra số lượng tồn của tháng trước có hạch toán
		$sqlGetSLTonThangTruoc = "select sltonv, sltonphukien from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated = '".$dateDauThangTruoc."'";
		$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
		
		// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
		$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $soLuongVangXuatTrongThang,3);
		$sltonphukienTrongThang = round(round(($rsGetSLTonThangTruoc['sltonphukien'] + $rsTongNhapTrongThang['soluongphukien']),3) - $soLuongPhuKienXuatTrongThang,3);

		$arrUpdateNX['sltonv'] = $sltonvTrongThang;
		$arrUpdateNX['sltonphukien'] = $sltonphukienTrongThang;

		vaUpdate($tablehachtoanma, $arrUpdateNX, ' idloaivang='.$idloaivang.' and idphukien='.$idphukien.' and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlTongNhapThangTiep = "select ROUND(SUM(cannangv), 3) as cannangv,
											ROUND(SUM(soluongphukien), 3) as soluongphukien
											from $GLOBALS[db_sp].".$table." 
											where type=1 and typechuyen=2 
											and idloaivang=".$idloaivang." and idphukien=".$idphukien."
											and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
									";
			$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
			
			if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
				$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
				$arrUpdateNXThangTiep['slnhapphukien'] = $rsTongNhapThangTiep['soluongphukien'];
			}

			$sqlTongXuatThangTiepCoDonHang = "select ROUND(SUM(trongluongxuat), 3) as cannangv,
													 ROUND(SUM(soluongxuat), 3) as soluongphukien 
													 from $GLOBALS[db_sp].".$tablemaphukienct." 
													 where idphukien=".$idphukien." 
													 and idphieuxuat in (select id from $GLOBALS[db_sp].".$table." where type=3 
													 and trangthai=2 and idloaivang=".$idloaivang." 
													 and datedxuat >= '".$dateDauThangTiep."' 
													 and datedxuat <= '".$dateCuoiThangTiep."' ) 
											";
			$rsTongXuatThangTiepCoDonHang = $GLOBALS['sp']->getRow($sqlTongXuatThangTiepCoDonHang);

			// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất Không đơn hàng
			$sqlTongXuatThangTiepKhongDonHang = "select ROUND(SUM(cannangv), 3) as cannangv, 
														ROUND(SUM(soluongphukien), 3) as soluongphukien 
														from $GLOBALS[db_sp].".$table." 
														where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
														and madhin=-1 
														and type=3 and trangthai=2 
														and datedxuat >= '".$dateDauThangTiep."' 
														and datedxuat <= '".$dateCuoiThangTiep."'  
												";
			$rsTongXuatThangTiepKhongDonHang = $GLOBALS["sp"]->getRow($sqlTongXuatThangTiepKhongDonHang);

			// Tính tổng số lượng phụ kiện, cân nặng vàng xuất tổng (= xuất có đơn hàng + xuất không đơn hàng)
			$soLuongPhuKienXuatThangTiep = round(($rsTongXuatThangTiepCoDonHang['soluongphukien'] + $rsTongXuatThangTiepKhongDonHang['soluongphukien']),3);
			$soLuongVangXuatThangTiep = round(($rsTongXuatThangTiepCoDonHang['cannangv'] + $rsTongXuatThangTiepKhongDonHang['cannangv']),3);

			if($soLuongVangXuatThangTiep != 0) { // != 0 là tháng tiếp theo có xuất
				$arrUpdateNXThangTiep['slxuatv'] = $soLuongVangXuatThangTiep;
				$arrUpdateNXThangTiep['slxuatphukien'] = $soLuongPhuKienXuatThangTiep;
			}

			// Update soluongton của tháng tiếp theo
			$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $soLuongVangXuatThangTiep,3);
			$arrUpdateNXThangTiep['sltonphukien'] = round(round(($sltonphukienTrongThang + $rsTongNhapThangTiep['soluongphukien']),3) - $soLuongPhuKienXuatThangTiep,3);

			vaUpdate($tablehachtoanma, $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and idphukien='.$idphukien.' and dated="'.$dateDauThangTiep.'"');
		}
	}
}

// M.Tân thêm ngày 12/10/2021 - Điều chỉnh số liệu hạch toán theo idloaivang của Kho Phụ kiện mới và đơn hàng hoàn thành
function dieuChinhSoLieuHachToanKhoPhuKienNew($table,$tablehachtoan,$idloaivang,$monthsNeedToUpdate) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." ORDER BY dated DESC LIMIT $monthsNeedToUpdate";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										 ROUND(SUM(cannangh), 3) as cannangh, 
										 ROUND(SUM(cannangv), 3) as cannangv
										 from $GLOBALS[db_sp].".$table." 
										 where type=1 and typechuyen=2 and idloaivang=".$idloaivang." 
										 and dated >= '".$dateDauThang."' and dated <= '".$dateCuoiThang."'
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG ĐANG XỬ LÝ
		$sqlTongXuatTrongThang = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										 ROUND(SUM(cannangh), 3) as cannangh, 
										 ROUND(SUM(cannangv), 3) as cannangv
										 from $GLOBALS[db_sp].".$table." 
										 where type=3 and trangthai=2 and idloaivang=".$idloaivang." 
										 and datedxuat >= '".$dateDauThang."' and datedxuat <= '".$dateCuoiThang."' 
								";
		$rsTongXuatTrongThang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThang);

		// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
		$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
		$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK){
			$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
			$arrUpdateNX['slnhaph'] = $rsTongNhapTrongThang['cannangh'];
			$arrUpdateNX['slnhapvh'] = $rsTongNhapTrongThang['cannangvh'];
		}

		// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang (tháng đó) để so sánh
		$sqlXuatSDDKTrongThang = "select slxuatv from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThang."'";
		$slxuatvSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongXuatTrongThang['cannangv'] != $slxuatvSDDK){
			$arrUpdateNX['slxuatv'] = $rsTongXuatTrongThang['cannangv'];
			$arrUpdateNX['slxuath'] = $rsTongXuatTrongThang['cannangh'];
			$arrUpdateNX['slxuatvh'] = $rsTongXuatTrongThang['cannangvh'];
		}

		// Lấy ngày của tháng trước có hạch toán
		$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated < '".$dateDauThang."' order by dated desc limit 1";
		$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
		
		// Lấy ra số lượng tồn của tháng trước có hạch toán
		$sqlGetSLTonThangTruoc = "select sltonv, sltonh, sltonvh from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated = '".$dateDauThangTruoc."'";
		$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
		
		// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
		$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $rsTongXuatTrongThang['cannangv'],3);
		$sltonhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonh'] + $rsTongNhapTrongThang['cannangh']),3) - $rsTongXuatTrongThang['cannangh'],3);
		$sltonvhTrongThang = round(round(($rsGetSLTonThangTruoc['sltonvh'] + $rsTongNhapTrongThang['cannangvh']),3) - $rsTongXuatTrongThang['cannangvh'],3);

		$arrUpdateNX['sltonv'] = $sltonvTrongThang;
		$arrUpdateNX['sltonh'] = $sltonhTrongThang;
		$arrUpdateNX['sltonvh'] = $sltonvhTrongThang;

		vaUpdate($tablehachtoan, $arrUpdateNX, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlTongNhapThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
											ROUND(SUM(cannangh), 3) as cannangh, 
											ROUND(SUM(cannangv), 3) as cannangv
											from $GLOBALS[db_sp].".$table." 
											where type=1 and typechuyen=2 and idloaivang=".$idloaivang." 
											and dated >= '".$dateDauThangTiep."' and dated <= '".$dateCuoiThangTiep."'
									";
			$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
			
			if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
				$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
				$arrUpdateNXThangTiep['slnhaph'] = $rsTongNhapThangTiep['cannangh'];
				$arrUpdateNXThangTiep['slnhapvh'] = $rsTongNhapThangTiep['cannangvh'];
			}

			$sqlTongXuatThangTiep = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
											ROUND(SUM(cannangh), 3) as cannangh, 
											ROUND(SUM(cannangv), 3) as cannangv
											from $GLOBALS[db_sp].".$table." 
											where type=3 and trangthai=2 and idloaivang=".$idloaivang." 
											and datedxuat >= '".$dateDauThangTiep."' and datedxuat <= '".$dateCuoiThangTiep."' 
									";
			$rsTongXuatThangTiep = $GLOBALS['sp']->getRow($sqlTongXuatThangTiep);

			if($rsTongXuatThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có xuất
				$arrUpdateNXThangTiep['slxuatv'] = $rsTongXuatThangTiep['cannangv'];
				$arrUpdateNXThangTiep['slxuath'] = $rsTongXuatThangTiep['cannangh'];
				$arrUpdateNXThangTiep['slxuatvh'] = $rsTongXuatThangTiep['cannangvh'];
			}

			// Update soluongton của tháng tiếp theo
			$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $rsTongXuatThangTiep['cannangv'],3);
			$arrUpdateNXThangTiep['sltonh'] = round(round(($sltonhTrongThang + $rsTongNhapThangTiep['cannangh']),3) - $rsTongXuatThangTiep['cannangh'],3);
			$arrUpdateNXThangTiep['sltonvh'] = round(round(($sltonvhTrongThang + $rsTongNhapThangTiep['cannangvh']),3) - $rsTongXuatThangTiep['cannangvh'],3);

			vaUpdate($tablehachtoan, $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and dated="'.$dateDauThangTiep.'"');

		}
	}
}

// M.Tân thêm ngày 14/10/2021 - Điều chỉnh số liệu hạch toán theo cả idloaivang và idphukien của Kho Phụ kiện đơn hàng hoàn thành
function dieuChinhSoLieuHachToanMaKhoPhuKienDHTT($table,$tablemaphukienct,$tablehachtoanma,$idloaivang,$idphukien,$monthsNeedToUpdate) {
	$sql = "select * from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." ORDER BY dated DESC LIMIT $monthsNeedToUpdate";
	$rs = $GLOBALS['sp']->getAll($sql);

	for($i=ceil(count($rs))-1; $i >= 0; $i--) {
		$arrUpdateNX = $arrUpdateNXThangTiep = array();

		// Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
		$dateDauThang = $rs[$i]['dated'];
		// $lastDay = date('t',strtotime($dateDauThang)); // Tính date cuối tháng ứng với date đầu tháng
		$arrThang = explode('-',$dateDauThang);
		$dateCuoiThang = $arrThang[0].'-'.$arrThang[1].'-31';

		// TÍNH TỔNG SỐ LƯỢNG NHẬP DỰA TRÊN CÁC PHIẾU NHẬP ỨNG VỚI IDLOAIVANG VÀ IDPHUKIEN ĐANG XỬ LÝ
		$sqlTongNhapTrongThang = "select ROUND(SUM(trongluongxuat), 3) as cannangv,
										 ROUND(SUM(soluongxuat), 3) as soluongphukien
										 from $GLOBALS[db_sp].khosanxuat_phukien_new_maphukienct 
										 where idphukien=".$idphukien." 
										 and idphieuxuat in (select idmaphieukho from $GLOBALS[db_sp].".$table." where type=1 
										 and typechuyen=2 and idloaivang=".$idloaivang." 
										 and dated >= '".$dateDauThang."' 
										 and dated <= '".$dateCuoiThang."' ) 
								";
		$rsTongNhapTrongThang = $GLOBALS['sp']->getRow($sqlTongNhapTrongThang);
		
		// TÍNH TỔNG SỐ LƯỢNG XUẤT DỰA TRÊN CÁC PHIẾU XUẤT ỨNG VỚI IDLOAIVANG VÀ IDPHUKIEN ĐANG XỬ LÝ
		$sqlTongXuatTrongThangCoDonHang = "select ROUND(SUM(trongluongxuat), 3) as cannangv,
												  ROUND(SUM(soluongxuat), 3) as soluongphukien 
												  from $GLOBALS[db_sp].".$tablemaphukienct." 
												  where idphukien=".$idphukien." 
												  and idphieuxuat in (select id from $GLOBALS[db_sp].".$table." where type=3 
												  and trangthai=2 and idloaivang=".$idloaivang." 
												  and datedxuat >= '".$dateDauThang."' 
												  and datedxuat <= '".$dateCuoiThang."' ) 
										";
		$rsTongXuatTrongThangCoDonHang = $GLOBALS['sp']->getRow($sqlTongXuatTrongThangCoDonHang);

		// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất Không đơn hàng
		$sqlTongXuatTrongThangKhongDonHang = "select ROUND(SUM(cannangv), 3) as cannangv, 
													 ROUND(SUM(soluongphukien), 3) as soluongphukien 
													 from $GLOBALS[db_sp].".$table." 
													 where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
													 and madhin=-1 
													 and type=3 and trangthai=2 
													 and datedxuat >= '".$dateDauThang."' 
													 and datedxuat <= '".$dateCuoiThang."'  
											";
		$rsTongXuatTrongThangKhongDonHang = $GLOBALS["sp"]->getRow($sqlTongXuatTrongThangKhongDonHang);

		// Tính tổng số lượng phụ kiện, cân nặng vàng xuất tổng (= xuất có đơn hàng + xuất không đơn hàng)
		$soLuongPhuKienXuatTrongThang = round(($rsTongXuatTrongThangCoDonHang['soluongphukien'] + $rsTongXuatTrongThangKhongDonHang['soluongphukien']),3);
		$soLuongVangXuatTrongThang = round(($rsTongXuatTrongThangCoDonHang['cannangv'] + $rsTongXuatTrongThangKhongDonHang['cannangv']),3);

		// Lấy ra tổng số lượng nhập trong bảng sodudauky ứng với idloaivang và idphukien (tháng đó) để so sánh
		$sqlNhapSDDKTrongThang = "select slnhapv from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated = '".$dateDauThang."'";
		$slnhapvSDDK = $GLOBALS['sp']->getOne($sqlNhapSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($rsTongNhapTrongThang['cannangv'] != $slnhapvSDDK) {
			$arrUpdateNX['slnhapv'] = $rsTongNhapTrongThang['cannangv'];
			$arrUpdateNX['slnhapphukien'] = $rsTongNhapTrongThang['soluongphukien'];
		}

		// Lấy ra tổng số lượng xuất trong bảng sodudauky ứng với idloaivang và idphukien (tháng đó) để so sánh
		$sqlXuatSDDKTrongThang = "select slxuatv from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated = '".$dateDauThang."'";
		$slxuatvSDDK = $GLOBALS['sp']->getOne($sqlXuatSDDKTrongThang);
		// So sánh số lượng nhập vàng trong sodudauky với tổng số lượng nhập của các phiếu cộng lại
		if($soLuongVangXuatTrongThang != $slxuatvSDDK) {
			$arrUpdateNX['slxuatv'] = $soLuongVangXuatTrongThang;
			$arrUpdateNX['slxuatphukien'] = $soLuongPhuKienXuatTrongThang;
		}

		// Lấy ngày của tháng trước có hạch toán
		$sqlGetDateDauThangTruoc = "select dated from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated < '".$dateDauThang."' order by dated desc limit 1";
		$dateDauThangTruoc = $GLOBALS['sp']->getOne($sqlGetDateDauThangTruoc);
		
		// Lấy ra số lượng tồn của tháng trước có hạch toán
		$sqlGetSLTonThangTruoc = "select sltonv, sltonphukien from $GLOBALS[db_sp].".$tablehachtoanma." where idloaivang=".$idloaivang." and idphukien=".$idphukien." and dated = '".$dateDauThangTruoc."'";
		$rsGetSLTonThangTruoc = $GLOBALS['sp']->getRow($sqlGetSLTonThangTruoc);
		
		// soluongton(trong tháng) = soluongton(tháng trước) + soluongnhap(trong tháng) - soluongxuat(trong tháng)
		$sltonvTrongThang = round(round(($rsGetSLTonThangTruoc['sltonv'] + $rsTongNhapTrongThang['cannangv']),3) - $soLuongVangXuatTrongThang,3);
		$sltonphukienTrongThang = round(round(($rsGetSLTonThangTruoc['sltonphukien'] + $rsTongNhapTrongThang['soluongphukien']),3) - $soLuongPhuKienXuatTrongThang,3);

		$arrUpdateNX['sltonv'] = $sltonvTrongThang;
		$arrUpdateNX['sltonphukien'] = $sltonphukienTrongThang;

		vaUpdate($tablehachtoanma, $arrUpdateNX, ' idloaivang='.$idloaivang.' and idphukien='.$idphukien.' and dated="'.$dateDauThang.'"');

		// Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
		$dateDauThangTiep = $rs[$i-1]['dated'];

		if(!empty($dateDauThangTiep)){
			// Tính ngày cuối tháng của tháng tiếp theo
			$arrThangTiep = explode('-',$dateDauThangTiep);
			$dateCuoiThangTiep = $arrThangTiep[0].'-'.$arrThangTiep[1].'-31';

			$sqlTongNhapThangTiep = "select ROUND(SUM(trongluongxuat), 3) as cannangv,
											ROUND(SUM(soluongxuat), 3) as soluongphukien
											from $GLOBALS[db_sp].khosanxuat_phukien_new_maphukienct 
											where idphukien=".$idphukien." 
											and idphieuxuat in (select idmaphieukho from $GLOBALS[db_sp].".$table." where type=1 
											and typechuyen=2 and idloaivang=".$idloaivang." 
											and dated >= '".$dateDauThangTiep."' 
											and dated <= '".$dateCuoiThangTiep."' ) 
									";
			$rsTongNhapThangTiep = $GLOBALS['sp']->getRow($sqlTongNhapThangTiep);
			
			if($rsTongNhapThangTiep['cannangv'] != 0) { // != 0 là tháng tiếp theo có nhập
				$arrUpdateNXThangTiep['slnhapv'] = $rsTongNhapThangTiep['cannangv'];
				$arrUpdateNXThangTiep['slnhapphukien'] = $rsTongNhapThangTiep['soluongphukien'];
			}

			$sqlTongXuatThangTiepCoDonHang = "select ROUND(SUM(trongluongxuat), 3) as cannangv,
													 ROUND(SUM(soluongxuat), 3) as soluongphukien 
													 from $GLOBALS[db_sp].".$tablemaphukienct." 
													 where idphukien=".$idphukien." 
													 and idphieuxuat in (select id from $GLOBALS[db_sp].".$table." where type=3 
													 and trangthai=2 and idloaivang=".$idloaivang." 
													 and datedxuat >= '".$dateDauThangTiep."' 
													 and datedxuat <= '".$dateCuoiThangTiep."' ) 
											";
			$rsTongXuatThangTiepCoDonHang = $GLOBALS['sp']->getRow($sqlTongXuatThangTiepCoDonHang);

			// Get số lượng phụ kiện, cân nặng vàng xuất của phiếu xuất Không đơn hàng
			$sqlTongXuatThangTiepKhongDonHang = "select ROUND(SUM(cannangv), 3) as cannangv, 
														ROUND(SUM(soluongphukien), 3) as soluongphukien 
														from $GLOBALS[db_sp].".$table." 
														where idloaivang=".$idloaivang." and idphukien=".$idphukien." 
														and madhin=-1 
														and type=3 and trangthai=2 
														and datedxuat >= '".$dateDauThangTiep."' 
														and datedxuat <= '".$dateCuoiThangTiep."'  
												";
			$rsTongXuatThangTiepKhongDonHang = $GLOBALS["sp"]->getRow($sqlTongXuatThangTiepKhongDonHang);

			// Tính tổng số lượng phụ kiện, cân nặng vàng xuất tổng (= xuất có đơn hàng + xuất không đơn hàng)
			$soLuongPhuKienXuatThangTiep = round(($rsTongXuatThangTiepCoDonHang['soluongphukien'] + $rsTongXuatThangTiepKhongDonHang['soluongphukien']),3);
			$soLuongVangXuatThangTiep = round(($rsTongXuatThangTiepCoDonHang['cannangv'] + $rsTongXuatThangTiepKhongDonHang['cannangv']),3);

			if($soLuongVangXuatThangTiep != 0) { // != 0 là tháng tiếp theo có xuất
				$arrUpdateNXThangTiep['slxuatv'] = $soLuongVangXuatThangTiep;
				$arrUpdateNXThangTiep['slxuatphukien'] = $soLuongPhuKienXuatThangTiep;
			}

			// Update soluongton của tháng tiếp theo
			$arrUpdateNXThangTiep['sltonv'] = round(round(($sltonvTrongThang + $rsTongNhapThangTiep['cannangv']),3) - $soLuongVangXuatThangTiep,3);
			$arrUpdateNXThangTiep['sltonphukien'] = round(round(($sltonphukienTrongThang + $rsTongNhapThangTiep['soluongphukien']),3) - $soLuongPhuKienXuatThangTiep,3);

			vaUpdate($tablehachtoanma, $arrUpdateNXThangTiep, ' idloaivang='.$idloaivang.' and idphukien='.$idphukien.' and dated="'.$dateDauThangTiep.'"');
		}
	}
}

// M.Tân thêm ngày 14/07/2022 - Get danh mục trạng thái DHSX dựa theo phòng ban
function insert_getTrangThaiDHSXCatalog($a){
	$cid = is_numeric($a['cid']) ? ceil($a['cid']) : 0;
	
	$str = '';
	if($cid > 0) {
		$sql = "select id, phongbancatalog from $GLOBALS[db_sp].categories where id=".$cid;
		$rs = $GLOBALS["sp"]->getRow($sql);
		
		if(!empty($rs['phongbancatalog'])){
			if($rs['phongbancatalog'] == 168)
				$phongbancatalog = '168,0';
			else
				$phongbancatalog = $rs['phongbancatalog'];
		}

		$sqlGetTrangThaiDHSX = "select * from $GLOBALS[db_catalog].cauhoidhsx where (idphong3d in (".$phongbancatalog.")) and active=1";
		$rsGetTrangThaiDHSX = $GLOBALS["catalog"]->getAll($sqlGetTrangThaiDHSX);
		foreach($rsGetTrangThaiDHSX as $itemGetTrangThaiDHSX){
			if($itemGetTrangThaiDHSX['id'] == $trangThaiChon)
				$selected = "selected";
			else
				$selected = "";
			
			$str .= "<option ".$selected." value='".$itemGetTrangThaiDHSX['id']."'>".$itemGetTrangThaiDHSX['name_vn']."</option>";		
		}
	}
	return $str;
}

function loaiVangSuaSoLieuHachToan(){
	$sql = "select * from $GLOBALS[db_sp].loaivang where active=1 and pid=0";
	$rs = $GLOBALS["sp"]->getAll($sql);
	return $rs;
}

function autoFormatDateSQLSyntax($inputdate){
	$newdate = str_replace('/', '-', $inputdate);
	$newdate = explode('-', $newdate);
	$whdate = $monthday = $year = '';
	foreach ($newdate as $value) {
		if (!empty($value)){
			if (strlen($value) != 4){
				if (strlen($value) != 2){
					$value = '0' . $value;
				}
				if ((empty($year) && floor($value) <= 12) || (floor($value) <= 12 && !empty($year))){
					$monthday = $value . '-' . $monthday;
				}
				else{
					$monthday .= $value . '-';
				}
			}
			else{
				$year = $value . '-';
			}
		}
	}

	$monthday = substr($monthday, 0, strlen($monthday) - 1);
	$whdate = $year . $monthday;
	return $whdate;
}

// ====== ANH VU THEM CHUYEN DEN - QUAN LY THU CHI - CHON PHAN TU CUOI CUNG SAU &raquo; ============ //
function insert_optionChuyenDenSelectedEnd($a){
	$id = $a['id'];
	$chonphongbanin = $a['chonphongbanin'];
	$str = '';
	if(!empty($id)){
		$sql = "select * from $GLOBALS[db_sp].categories where id in (".$id.") and active=1 order by id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($item['id'] == $chonphongbanin)
				$selected = "selected";
			else
				$selected = "";
			$title = getLinkTitle($item['id'],1);
			if(!empty($title)){
				$title = explode('&raquo;',$title);
				$title = end($title);
			}
			$str .= "<option ".$selected." value='".$item['id']."'>".$item['maphongban'].$title."</option>";		
		}
	}
	return $str;
}
// ====== KET THUC ANH VU THEM CHUYEN DEN - QUAN LY THU CHI - CHON PHAN TU CUOI CUNG SAU &raquo; ============ //
function insert_getNamepmns($a){
	$id = $a['id'];
	$table = $a['table'];
	$names = $a['names'];
	$wh = $a['wh'];
	$name = '';
	if(!empty($wh)){
		$sql = "select ".$names." from $GLOBALS[db_spns].".$table." where ".$wh;
		$name = $GLOBALS["spns"]->getOne($sql);
	}
	return $name;
}

function insert_loadMenuCap2($a){
	$id = $a['id'];
	$name = '';
	if(ceil($id) > 0){
		$sql = "SELECT id, name_vn from $GLOBALS[db_sp].categories where pid=".$id." 
				and istktoantaisanphongban=1 
				and active=1
				and `table`<>'' 
				and tablehachtoan <> ''
				and hamfucntionphongban <> ''   
		order by num asc, id desc";
		$rs = $GLOBALS['sp']->getAll($sql);
		
		foreach($rs as $item){
			$name .= '
				<li>
					<div class="col1 w100pt pmslicap2">
						<input type="checkbox" name="phongban[]" value="'.$item['id'].'" class="cat'.$id.' checkedct'.$item['id'].' checkedremove">&nbsp;&nbsp; '.$item['name_vn'].'
					</div>
				</li>
			';	
		}	
	}
	return $name;
}
function insert_getRowNamepmns($a){
	$table = $a['table'];
	$names = $a['names'];
	$wh = $a['wh'];
	$name = '';
	if(!empty($wh)){
		$sql = "select ".$names." from $GLOBALS[db_spns].".$table." where ".$wh;
		$name = $GLOBALS["spns"]->getRow($sql);
	}
	return $name;
}
function insert_getNgayXuatKhoTongDeCut($a){
	$idmaphieu = $a['idmaphieu']; 
	$fromday = $a['fromday'];
	$today = $a['today'];
	$wh = '';
	
	$fromDate = trim(striptags($_GET['fromday']));
	$toDate = trim(striptags($_GET['today']));
	if(!empty($fromDate)){
		$fromDate = explode('/',$fromDate);
		$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		$wh.=' and dated >= "'.$fromDate.'" ';
	}
	if(!empty($toDate)){				
		$toDate = explode('/',$toDate);
		$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		$wh.=' and dated <= "'.$toDate.'" ';
	}

	$sql = " select dated from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac where idmaphieu=".$idmaphieu." $wh order by dated desc limit 1";
	$datedx = $GLOBALS["sp"]->getOne($sql); 
	return date("d/m/Y", strtotime($datedx) );;
}

function insert_DecodePW($a)
{
	$showpw = base64_decode(base64_decode(base64_decode($a['showpw']))) ;
	return $showpw;
}
function insert_getMemberNhomDuocPhanQuyenNew($a){
	$id = $a['id'];

	$str = '';
	$sql = "select username, fullname from $GLOBALS[db_sp].admin where userpm=".$id." order by id asc ";	
	$rs = $GLOBALS["sp"]->getAll($sql);
	foreach($rs as $item){
		$str .= ' - '.$item['username'].': '.$item['fullname'] . '<br />';	
	}
	return $str;
}

// M.Tân thêm ngày 13/09/2021 - Insert get show phòng ban Phần mềm nhân sự
function insert_getShowPhongBanPMNS($a){
	$idPhongBan = $a['idPhongBan'];

	if($idPhongBan > 0) {
		$sql = "select * from $GLOBALS[db_spns].danhmucphongban where id=$idPhongBan";
		$rs = $GLOBALS["spns"]->getRow($sql);

		if($rs["pid"] == 1)
			$str = $rs["name_vn"];
		else{
			$str=' &raquo; ' .$rs["name_vn"].''; 
		}

		if($rs['pid'] != 1) {
			$str = getShowPhongBanPMNS($rs["pid"]).$str;
			return $str;	
		}
		else {
			return $str;		
		}	
	}
}

// M.Tân thêm ngày 13/09/2021 - Get show phòng ban Phần mềm nhân sự
function getShowPhongBanPMNS($idPhongBan){
	if($idPhongBan > 0) {
		$sql = "select * from $GLOBALS[db_spns].danhmucphongban where id=$idPhongBan";
		$rs = $GLOBALS["spns"]->getRow($sql);

		if($rs["pid"] == 1)
			$str=$rs["name_vn"];
		else{
			$str=' &raquo; ' .$rs["name_vn"].'';
		}
		if($rs['pid'] != 1)
			return getShowPhongBanPMNS($rs["pid"]).$str;	
		else
			return $str;	
	}
}
// A.Hai thêm ngày 21/12/2021
function insert_getNameMadh($a){
	$table = trim($a['table']);
	$idpnk = ceil(trim($a['idpnk']));
	$codedh = '';
	if($idpnk > 0){
		$sqldh = "select madhin from $GLOBALS[db_sp].".$table." where id=".$idpnk;
		$madhin = $GLOBALS["sp"]->getOne($sqldh);
		if($madhin > 0){
			$sql = "select code from $GLOBALS[db_catalog].ordersanxuat where id IN (".$madhin.") "; 
			$codedh = $GLOBALS["catalog"]->getOne($sql);	
		}
	}
	return $codedh;	
}
// === A.VŨ THÊM 01/01/2022 CHUYỂN THEO DANH MỤC QUY TRÌNH - QL THU CHI - QL ĐẶT HÀNG === //
function insert_optionChuyenDenQuyTrinhQLDatHang($a){
	$cid = ceil($a['cid']);
	$id = ceil($a['id']);
	$str = '';
	if($id > 0){
		$sql = "select * from $GLOBALS[db_sp].ketoan_noidung_dathang where id = $id";
		$rs = $GLOBALS["sp"]->getRow($sql);
		$idquytrinh = $rs['idquytrinh'];
		// DM loại quy trình theo cid
		$sqlloaiqtr = "select id from $GLOBALS[db_sp].ketoan_dm_loaiquytrinh where (FIND_IN_SET($cid, cid) > 0)";
		$loaiquytrinh = $GLOBALS["sp"]->getOne($sqlloaiqtr);
		if($idquytrinh > 0){
			$sqlqtr = "select cidchuyen from $GLOBALS[db_sp].ketoan_dm_quytrinhct where idct = $idquytrinh and cid = $loaiquytrinh";
			$idchuyen = $GLOBALS["sp"]->getOne($sqlqtr);
			if($idchuyen > 0){
				$sqlcidchuyen = "select cid from $GLOBALS[db_sp].ketoan_dm_loaiquytrinh where id = $idchuyen";
				$cidchuyen = $GLOBALS["sp"]->getOne($sqlcidchuyen);
			}
		}
		// === DM Tính chất đặt hàng
		$tcdh = getTableRow("ketoan_dm_tinhchatmuahang"," and id = ".$rs['idtinhchatdathang']);
		// === Nếu chọn nhập kho
		if(strpos($tcdh['cid_check'], ',5,') !== false) {
			$get_arr = unserialize($tcdh['checksub']); //get DB tách mảng
			foreach($get_arr as $item){
				if($item['pid'] == 5){
					$sqlkho = "select cid from $GLOBALS[db_sp].ketoan_dm_kho where id =".$item['id_child'];
					$cidkho = $GLOBALS['sp']->getOne($sqlkho);
				}
			}
			if(strpos($cidchuyen,$cidkho) !== false){ // Tìm cid trong DM loại quy trình
				$cidchuyen = $cidkho;
			}
		}
		// === Nếu chọn sửa chữa
		if(strpos($tcdh['cid_check'], ',8,') !== false) {
			$sqlsuachua = "select cid from $GLOBALS[db_sp].ketoan_dm_kho where pid = 0 and type = 8";
			$cidsuachua = $GLOBALS['sp']->getOne($sqlsuachua);
			if(strpos($cidchuyen,$cidsuachua) !== false){ // Tìm cid trong DM loại quy trình
				$cidchuyen = $cidsuachua;
			}
		}
		// === Nếu chọn sử dụng
		if(strpos($tcdh['cid_check'], ',7,') !== false) {
			$sqlsudung = "select cid from $GLOBALS[db_sp].ketoan_dm_kho where pid = 0 and type = 7";
			$cidsudung = $GLOBALS['sp']->getOne($sqlsudung);
			if(strpos($cidchuyen,$cidsudung) !== false){ // Tìm cid trong DM loại quy trình
				$cidchuyen = $cidsudung;
			}
		}
		// === DM Hình thức thanh toán
		if($rs['idhinhthucthanhtoan'] > 0){
			$sqlhttt = "select cid from $GLOBALS[db_sp].ketoan_dm_hinhthucthanhtoan where id = ".$rs['idhinhthucthanhtoan'];
			$cidhttt = $GLOBALS['sp']->getOne($sqlhttt);
			if(strpos($cidchuyen,$cidhttt) !== false){ // Tìm cid trong DM loại quy trình
				$cidchuyen = $cidhttt;
			}
		}
		if(!empty($cidchuyen)){
			$sqlck = "select * from $GLOBALS[db_sp].categories where id in (".$cidchuyen.") and active=1 order by id asc";
			$rsck = $GLOBALS["sp"]->getAll($sqlck);
			foreach($rsck as $item){
				$str .= "<option value='".$item['id']."'>".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";		
			}
		}
		// if($cid != "2120"){
		// 	if(!empty($cidchuyen)){
		// 		$sqlck = "select * from $GLOBALS[db_sp].categories where id in (".$cidchuyen.") and active=1 order by id asc";
		// 		$rsck = $GLOBALS["sp"]->getAll($sqlck);
		// 		foreach($rsck as $item){
		// 			$str .= "<option value='".$item['id']."'>".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";		
		// 		}
		// 	}
		// }
		// else{
		// 	$str = $cidchuyen;
		// }
	}
	return $str;
}
function insert_number_format_str($a){
	$number = $a['number'];
	$separator = $a['separator'];
	$format = $a['format'];
	
	$precision = substr($number, strpos($number, '.'), $format+1); // 3 because . plus 2 precision  
	$new_number = substr($number, 0, strpos($number, $separator)).$precision;
	return $new_number;  
}
function number_format_str($number, $separator = '.', $format = 3 ){
	$precision = substr($number, strpos($number, '.'), $format+1); // 3 because . plus 2 precision  
	$new_number = substr($number, 0, strpos($number, $separator)).$precision;
	return $new_number; 
}
function XuatTinhTienHTKCcatalog($input){
	$arraycthot = explode(',', $input);
	$chitietkcban = array();
	$chitietkcban['tienkctamban'] = 0;
	$chitietkcban['tienkctamvon'] = 0;
	$chitietkcban['tongslhot'] = 0;
	// $chitietkcban['tlkara'] = 0;
	foreach($arraycthot as $value){
		$splipdata = explode('=', trim($value));
		$tenhot = trim($splipdata[0]);
		$slhot = empty($splipdata[1]) ? 0 : trim($splipdata[1]);
		$chitietkcban['tongslhot'] += $slhot;
		if ((strtoupper(substr($tenhot, 0, 1)) == 'T' && is_numeric(substr($tenhot, 1, 1))) || (strtoupper(substr($tenhot, 0, 2)) == 'HV' && is_numeric(substr($tenhot, 2, 1)))){
			$sqltsht = "SELECT giaban, giagocvnd from $GLOBALS[db_catalog].thongsohottam where size='$tenhot'";
			$rstsht = $GLOBALS["catalog"]->getRow($sqltsht);
			$chitietkcban['tienkctamban'] += round(($slhot * $rstsht['giaban']),3);
			$chitietkcban['tienkctamvon'] += round(($slhot * $rstsht['giagocvnd']),3);
		}
		// $chitietkcban['tlkara'] = round($chitietkcban['tlkara'] + round(($slhot * $rstsht['cannangct']),3),3);
	}
	$chitietkcban['tienkctamban'] = roundToThousands($chitietkcban['tienkctamban']);
	$chitietkcban['tienkctamvon'] = roundToThousands($chitietkcban['tienkctamvon']);
	return $chitietkcban;
}
function roundToThousands($number){
	$rightlNum = 0;
	if (ceil($number) > 0){
		$rightlNum = 1;
	}
	$num = 0;
	if (strlen($number) > 3){
		$num = ceil(substr($number, 0, strlen($number) - 3));
		$rightlNum = ceil(substr($number, -3, 3));
	}
	if ($rightlNum > 0){
		$num++;
	}
	if (ceil($num) > 0){
		$num .= '000';
	}
	return $num;
}
function generateCode($characters) {
	/* list all possible characters, similar looking characters and vowels have been removed */
	$possible = '0123456789abc#defghi@jklmnopqrstuvwx#yz@';
	$code = '';
	$i = 0;
	while ($i < $characters) { 
		$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
		$i++;
	}
	$code = strtoupper($code);
	return $code;
}
// === A.VŨ THÊM OPTION PID CẤP 1 === //
function insert_getOptionPidOfCid($a){
	$cid = ceil($a['cid']);
	$pid = ceil($a['pid']);
	$html = '';
	if($cid > 0){
		$sql = "select id,name_vn from $GLOBALS[db_sp].categories where pid in (select pid from $GLOBALS[db_sp].categories where id in ($pid))";
		$rs = $GLOBALS["sp"]->getAll($sql);

		foreach($rs as $item){
			if($item['id'] == $pid)
				$selected = "selected";
			else
				$selected = "";
				$html .= "\n<option ".$selected."  value='".$item['id']."' > ".$item['name_vn']." </option>\n";
		}
	}
	return $html;
}
// === A.VŨ THÊM LOAD LOẠI NỮ TRANG DỰA VÀO ĐƠN HÀNG === //
function insert_loadloainutrang($a){
	$madhin = trim($a['madhin']);
	$rs_loainutrang = '';
	if(!empty($madhin)){
		$sql = "select idmamauvang from $GLOBALS[db_catalog].ordersanxuat where id IN (".$madhin.") "; 
		$rs = $GLOBALS["catalog"]->getCol($sql);
		if(!empty($rs)){
			$rs = implode(', ',$rs);
			// 
			$sql_loainutrang = "select loainutrang from $GLOBALS[db_catalog].dmsp_mauvang where id IN (".$rs.")";
			$rs_loainutrang = $GLOBALS["catalog"]->getCol($sql_loainutrang);
			if(!empty($rs_loainutrang)){
				$rs_loainutrang = implode(', ',$rs_loainutrang);
			}
			else{
				$rs_loainutrang = '';
			}
		}
		else{
			$rs_loainutrang = '';
		}
	}
	return $rs_loainutrang;	
}
function getbarcode($code){	
	$imgurl = '';
	if(!empty($code)){
		$imgurl = "filetype=PNG&dpi=72&thickness=20&scale=2&rotation=0&font_family=Arial.ttf&font_size=0";
		$imgurl .= "&text=".stripslashes($code)."&code=BCGcode39";
		$imgurl = "../barcode/html/image.php?".$imgurl;		
	}
	return $imgurl;
}
function ghisoHachToanKhoDaAcc($tablehachtoan, $tablect, $id){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');

	$sql = "select * from $GLOBALS[db_ketoan].$tablect where idctnx = $id and orderdatetime = '0000-00-00 00:00:00' order by idmada asc, id asc";
	$rs = $GLOBALS['ketoan']->getAll($sql);
	foreach($rs as $item){
		$arrnx1day = $arrnxct = $arrnkhoda = array();
		$soluongton = $soluongnhap = $soluongxuat = $slnhap = $slxuat = 0;
		if($item['typenhapxuat']==1)//số lượng nhập
			$slnhap = $item['soluong'];
		else // số lượng xuất
			$slxuat = $item['soluong'];

		$sqldate = "select * from $GLOBALS[db_ketoan].$tablehachtoan where idmada=".$item['idmada']." and dated='".$datenow."'";
		$rsdate = $GLOBALS['ketoan']->getRow($sqldate);
		if(empty($rsdate['id'])){
			$sqltru1day = "select * from $GLOBALS[db_ketoan].$tablehachtoan where idmada=".$item['idmada']." order by dated desc limit 1"; /// lấy ngày cuối cùng
			$rstru1day = $GLOBALS['ketoan']->getRow($sqltru1day);
			if($rstru1day['id'] > 0){
				$soluongnhap = $rstru1day['soluongnhap'];
				$soluongxuat = $rstru1day['soluongxuat'];
				$soluongton = $rstru1day['soluongton'];
			}
			$soluongnhap = $soluongnhap + $slnhap;
			$soluongxuat = $soluongxuat + $slxuat ;
			$soluongton = ($soluongton + $slnhap) - $slxuat ;
			
			$arrnx1day['soluongton'] = $soluongton;
			
			if($item['typenhapxuat']==1)
				$arrnx1day['soluongnhap'] = $slnhap;
			else
				$arrnx1day['soluongxuat'] = $slxuat;
			
			$arrnx1day['idmada'] = $item['idmada'];
			$arrnx1day['dated'] = $datenow;	
			vaInsertKeToan($tablehachtoan,$arrnx1day);
		}
		else{
			$soluongnhap = $rsdate['soluongnhap'] + $slnhap;
			$soluongxuat = $rsdate['soluongxuat'] + $slxuat;
			$soluongton = ($rsdate['soluongton'] + $slnhap) - $slxuat ;
			
			$arrnx1day['soluongnhap'] = $soluongnhap;
			$arrnx1day['soluongxuat'] = $soluongxuat;
			
			$arrnx1day['soluongton'] = $soluongton;
			vaUpdateKeToan($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
		}
		
		///////update số lượng tồn vào bang kho da
		$arrnkhoda['soluongton'] = $soluongton;
		vaUpdateKeToan('khoda',$arrnkhoda,' id='.$item['idmada']);
		
		/////// cập nhật lại bảng khoda_nhapxuatct soluongton và ngày ghi sổ tại chỗ đó
		//Lây mã số numorder để xuất phần thống kê chi tiết nhập xuất (order by numorder asc)
		$sqlmpt = "select max(numorder)+1 from $GLOBALS[db_ketoan].$tablect";
		$rsmpt = $GLOBALS['ketoan']->getone($sqlmpt);
		if($rsmpt <= 0)
			$rsmpt = 1;
			
			
		$arrnxct['dateghiso'] = $datenow;
		$arrnxct['soluongton'] = $soluongton;
		$arrnxct['numorder'] = $rsmpt;
		$timnowdb = date('H:i:s');
		$arrnxct['orderdatetime'] = $datenow .' '. $timnowdb;
		
		vaUpdateKeToan($tablect,$arrnxct,' id='.$item['id']);
	}	
}
function giaBanVonMoi_TinhBatCapGia($idphieu, $idkimcuong){
	$arr = array();
	//=====check tính bất cập giá coi có nhập tinhbatcapgia chưa
	$sqltbcg = "select tinhbatcapgia from $GLOBALS[db_sp].banggiakimcuong_thietlapbanggiakimcuongct_tinhbatcapgia 
				where idctnx = $idphieu 
				and idkimcuong=$idkimcuong
	";
	$arr['tinhbatcapgia'] = $GLOBALS["sp"]->getOne($sqltbcg);

	//=====check bảng banggiakimcuong_thietlapbanggiakimcuongct coi có dữ liệu hay kg để tô màu lên
	$sql = "select id, giavonmoi_usd, giabanmoi_usd from $GLOBALS[db_sp].banggiakimcuong_thietlapbanggiakimcuongct 
				where idctnx = $idphieu 
				and idkimcuong=$idkimcuong
	";
	$rs = $GLOBALS["sp"]->getRow($sql);
	$arr['idctnx'] = ceil($rs['id']);
	$arr['giavonmoi_usd'] = ceil($rs['giavonmoi_usd']);
	$arr['giabanmoi_usd'] = ceil($rs['giabanmoi_usd']);
	return $arr;
}
function getContent($url){
	$ch=curl_init();
	$User_Agent = 'Mozilla/5.0 (Windows; Windows NT 6.3)  AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b  Chrome/50.0261.94 Safari/537.36';
	$request_headers = array();
	$request_headers[] = 'User-Agent: '. $User_Agent;
	$request_headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
	$request_headers[] = 'Accept-Charset: utf-8';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$request_headers);

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt ($ch, CURLOPT_HEADER, 0);
	curl_setopt ($ch, CURLOPT_NOBODY, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 4);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_ENCODING, "UTF-8" );
	// Get URL content
	if(curl_exec($ch) === false){///////lỗi dữ liệu
		$data='';
	}
	else{
		$data=curl_exec($ch);
	}
	// close handle to release resources
	curl_close($ch);
	return $data;
}
//==de quy tim cid==//
function dequiShareCid_catalog($id, &$str){
	$sql = "select * from $GLOBALS[db_catalog].categories where pid=".$id;
	$rs = $GLOBALS["catalog"]->getAll($sql);
	if( ceil(count($rs)) > 0){
		foreach($rs as $item){
			$str .= $item['id'].',';
			dequiShareCid_catalog($item['id'],$str);
		}
	} 
	return $str;
}
function giahuy_ghiSoHachToan($tablehachtoan, $tablenhan, $id, $typehachtoan) {
	$dateDauThang = date('Y').'-'.date('m').'-01';
	$slnhapvh = $slnhapv = $slnhaph = 0;
	$slxuatvh = $slxuatv = $slxuath = 0;
	$phieu = getTableRow($tablenhan, " and id = $id");
	if($phieu['type'] == '1') {
		$slnhapvh = $phieu['cannangvh'];
		$slnhaph = $phieu['cannangh'];
		$slnhapv = $phieu['cannangv'];	
	} else {
		$slxuatvh = $phieu['cannangvh'];
		$slxuath = $phieu['cannangh'];
		$slxuatv = $phieu['cannangv'];
	}
	$haorc = $phieu['haochuyen'];
	$durc = $phieu['duchuyen'];	

	$sqlHachToan = "select * from $GLOBALS[db_sp].$tablehachtoan where dated = '".$dateDauThang."' and idloaivang= ".$phieu['idloaivang']." and typevkc = 1";
	$hachToanThisMonth = $GLOBALS["sp"]->getRow($sqlHachToan);

	$currentHachToan = [];
	if(empty($hachToanThisMonth['id'])) {
		$sqlhachToanLastMonth = "select * from $GLOBALS[db_sp].$tablehachtoan where idloaivang= '".$phieu['idloaivang']."' and typevkc = 1 order by dated desc limit 1";
		$hachToanLastMonth = $GLOBALS["sp"]->getRow($sqlhachToanLastMonth);

		$currentHachToan['slnhapvh'] = $slnhapvh;
		$currentHachToan['slxuatvh'] = $slxuatvh;
		$currentHachToan['sltonvh'] = ($slnhapvh + $hachToanLastMonth['sltonvh']) - $slxuatvh;
		$currentHachToan['slnhaph'] = $slnhaph;
		$currentHachToan['slxuath'] = $slxuath;
		$currentHachToan['sltonh'] = ($slnhaph + $hachToanLastMonth['sltonh']) - $slxuath;
		$currentHachToan['slnhapv'] = $slnhapv;
		$currentHachToan['slxuatv'] = $slxuatv;
		$currentHachToan['sltonv'] = ($slnhapv + $hachToanLastMonth['sltonv']) - $slxuatv;
		$currentHachToan['hao'] = $haorc;
		$currentHachToan['du'] = $durc;
		$currentHachToan['idloaivang'] = $phieu['idloaivang'];
		$currentHachToan['dated'] = $dateDauThang;
		$currentHachToan['typevkc'] = 1;

		vaInsert($tablehachtoan, $currentHachToan);
	} else {
		$currentHachToan['slnhapvh'] = $slnhapvh + $hachToanThisMonth['slnhapvh'];
		$currentHachToan['slxuatvh'] = $slxuatvh + $hachToanThisMonth['slxuatvh'];
		$currentHachToan['sltonvh'] = ($slnhapvh + $hachToanThisMonth['sltonvh']) - $slxuatvh;
		$currentHachToan['slnhaph'] = $slnhaph + $hachToanThisMonth['slnhaph'];
		$currentHachToan['slxuath'] = $slxuath + $hachToanThisMonth['slxuath'];
		$currentHachToan['sltonh'] = ($slnhaph + $hachToanThisMonth['sltonh']) - $slxuath;
		$currentHachToan['slnhapv'] = $slnhapv + $hachToanThisMonth['slnhapv'];
		$currentHachToan['slxuatv'] = $slxuatv + $hachToanThisMonth['slxuatv'];
		$currentHachToan['sltonv'] = ($slnhapv + $hachToanThisMonth['sltonv']) - $slxuatv;
		$currentHachToan['hao'] = $hachToanThisMonth['hao'] + $haorc;
		$currentHachToan['du'] = $hachToanThisMonth['du'] + $durc;

		vaUpdate($tablehachtoan, $currentHachToan, 'id='.$hachToanThisMonth['id']);
	}
}

function giahuy_ghiSoHachToanKhoSanXuat($tablehachtoan, $tablenhan, $id) {
	$dateDauThang = date('Y').'-'.date('m').'-01';
	$slnhapvh = $slnhapv = $slnhaph = 0;
	$slxuatvh = $slxuatv = $slxuath = 0;

	$sqlPhieu = "select * from $GLOBALS[db_sp].$tablenhan where id=$id";
	$phieu = $GLOBALS['sp']->getRow($sqlPhieu);

	if((int)$phieu['type'] == 1) {
		$slnhapvh = $phieu['cannangvh'];
		$slnhapv = $phieu['cannangv'];
		$slnhaph = $phieu['cannangh'];
	} else {
		$slxuatvh = $phieu['canxuatvh'];
		$slxuatv = $phieu['canxuatv'];
		$slxuath = $phieu['canxuath'];
	}

	$currentHachToan = [];
	$sqlHachToanThisMonth = "select * from $GLOBALS[db_sp].$tablehachtoan where idloaivang=".$phieu['idloaivang']." and dated='$dateDauThang' and typevkc = 1";
	$hachToanThisMonth = $GLOBALS['sp']->getRow($sqlHachToanThisMonth);
	if(empty($hachToanThisMonth['id'])) {
		$sqlHachToanLastMonth = "select * from $GLOBALS[db_sp].$tablehachtoan where idloaivang=".$phieu['idloaivang']." and typevkc = 1 order by dated desc limit 1";
		$hachToanLastMonth = $GLOBALS['sp']->getRow($sqlHachToanLastMonth);

		$currentHachToan['slnhapvh'] = $slnhapvh;
		$currentHachToan['slxuatvh'] = $slxuatvh;
		$currentHachToan['sltonvh'] = ($hachToanLastMonth['sltonvh'] + $slnhapvh) - $slxuatvh;
		$currentHachToan['slnhaph'] = $slnhaph;
		$currentHachToan['slxuath'] = $slxuath;
		$currentHachToan['sltonh'] = ($hachToanLastMonth['sltonh'] + $slnhaph) - $slxuath;
		$currentHachToan['slnhapv'] = $slnhapv;
		$currentHachToan['slxuatv'] = $slxuatv;
		$currentHachToan['sltonv'] = ($hachToanLastMonth['sltonv'] + $slnhapv) - $slxuatv;
		$currentHachToan['idloaivang'] = $phieu['idloaivang'];
		$currentHachToan['dated'] =$dateDauThang;

		vaInsert($tablehachtoan, $currentHachToan);
	} else {
		$currentHachToan['slnhapvh'] = $hachToanThisMonth['slnhapvh'] + $slnhapvh;
		$currentHachToan['slxuatvh'] = $hachToanThisMonth['slxuatvh'] + $slxuatvh;
		$currentHachToan['sltonvh'] = ($hachToanThisMonth['sltonvh'] + $slnhapvh) - $slxuatvh;
		$currentHachToan['slnhaph'] = $hachToanThisMonth['slnhaph'] + $slnhaph;
		$currentHachToan['slxuath'] = $hachToanThisMonth['slxuath'] + $slxuath;
		$currentHachToan['sltonh'] = ($hachToanThisMonth['sltonh'] + $slnhaph) - $slxuath;
		$currentHachToan['slnhapv'] = $hachToanThisMonth['slnhapv'] + $slnhapv;
		$currentHachToan['slxuatv'] = $hachToanThisMonth['slxuatv'] + $slxuatv;
		$currentHachToan['sltonv'] = ($hachToanThisMonth['sltonv'] + $slnhapv) - $slxuatv;

		vaUpdate($tablehachtoan, $currentHachToan, 'id='.$hachToanThisMonth['id']);
	}
}
function checkViewPermision($cid){//gia tri action ( 1 -> add, 2 -> edit , 3 -> delete , 4 -> all, 5 -> view, 6 -> chuyển)
	if($_SESSION["admin_qlsxntjcorg_id"] > 0){
		$showall = 0;
		$sql="select * from $GLOBALS[db_sp].permissions  where cid=$cid and perm <> '' and uid = " .$_SESSION["admin_qlsxntjcorg_id"];
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
		if($cid)
			$sql="select * from $GLOBALS[db_sp].permissions  where ((perm =".$act.") or (perm like '%,".$act.",%') or (perm like '%,".$act."') or (perm like '".$act.",%') or (perm like '%4%')) and cid=$cid and uid = " .$_SESSION["admin_qlsxntjcorg_id"];
		else
			$sql="select * from $GLOBALS[db_sp].permissions  where ((perm like '%".$act."%') or (perm like '%4%'))  and uid = " .$_SESSION["admin_qlsxntjcorg_id"];
	
		$showall = ceil(count($GLOBALS["sp"]->getAll($sql)));
	}
	if( ($showall > 0) || ($_SESSION['group_qlsxntjcorg_user'] == -1))
		return true;
	else
		return false;
}
function getHearderCat($a){
	global $path_url;
	$cha = $a['cid'];
	$root = isset($a['root'])?$a['root']:2;
	$act = $a['act'];
	$list = "";
	$str = "";
	$arr = array();
	do{
		$sql = "select * from $GLOBALS[db_sp].categories where id=".$cha;
		$r = $GLOBALS["sp"]->getRow($sql);
		$arr[count($arr)] = $r;
		$cha = $r['pid'];
	}while($arr[count($arr)-1]['id'] != $root);
	$j = 0;
	for($i=(count($arr)-1);$i>=0;$i--){
		
		if(empty($arr[$i]['unique_key_vn']))	
			$unique_key_vn = 'menu';
		else
			$unique_key_vn = $arr[$i]['unique_key_vn'];
			
		if($arr[$i]['has_child']=='1'){
			//$link = $path_url."/categories/".$unique_key_vn."-cid-".$arr[$i]['id'].".html";
		}
		else{
			$sql = "select * from $GLOBALS[db_sp].component where id=".$arr[$i]['comp'];
			$r = $GLOBALS["sp"]->getRow($sql);
			$link = $r['do'].".php?cid=".$arr[$i]['id'];
			$link1 = " href='".$link."'";
		}
		$list.= "
			<li>
				<span>&raquo;</span> <a class='disabled' title='".$arr[$i]['name_vn']."' >".$arr[$i]['name_vn']."</a>
			</li>
		";
		
	}
	if(!isset($act))
		$list.= '';
	else if($act=='edit')
		$list.= " <li> <span>&raquo;</span> <a class='disabled'>Sửa</a> </li> ";
	elseif($act=='add')
		$list.=" <li> <span>&raquo;</span> <a  class='disabled'>Thêm</a> </li> ";
	else
		$list.= '';                                                    	
	return $list;
}
?>