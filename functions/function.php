<?php
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
		$str = 0;
	}
	if (preg_match("/select/i", $str)){ 
		$str = 0;
	}
	if (preg_match("/INSERT/i", $str)){ 
		$str = 0;
	}
	if (preg_match("/DELETE/i", $str)){ 
		$str = 0;
	}
	if (preg_match("/UPDATE/i", $str)){ 
		$str = 0;
	}
	return $str;
}
function CheckLogin(){
	global $path_url;
	if($_SESSION['store_qlsxntjcorg_login']==''){	
		echo"<script type=\"text/javascript\">	
			parent.location.reload();
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

// function vaDemo($table){
// 	global $db,$table_prefix;
// 	$result = $db->query("SHOW TABLES LIKE '{$table}'");
// 	if( $result->num_rows == 1 )
// 	{
// 	        return TRUE;
// 	}
// 	else
// 	{
// 	        return FALSE;
// 	}
// 	$result->free();
// }

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

	// echo $sql; die();

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


////////Phan trang//////
function paginator($num_page,$page,$iSEGSIZE,$url,$strSearch) //pagination.
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
   $alink.="<a href='$url&page=$first_page".$strSearch."'>Đầu trang</a>";
   $alink.="<a href='$url&page=$back".$strSearch."'>Lùi lại</a>";
  }else{
   $alink.="<a class='disabled ActiveNextPre'>Đầu trang</a>";
   $alink.="<a class='disabled ActiveNextPre'>Lùi lại</a>";
  }
  if (count($seg_page)<=0) return;
  foreach ($seg_page as $page){
   if ($page==$cur_page) {
    $alink.="<a class='disabled active'>".$page."</a>";
   } else {
    $alink.="<a href='$url&page=$page".$strSearch."'>$page</a>"; 
    
   }
  }

  //show/hide next
  if ($seg_cur<$seg_num) {$next=$cur_page+1;
   $alink.="<a href='$url&page=$next".$strSearch."'>Tiếp theo</a>";
   $alink.="<a href='$url&page=$last_page".$strSearch."'>Cuối trang</a>";
  }else{
   $alink.="<a class='disabled ActiveNextPre'>Tiếp theo</span>";
   $alink.="<a class='disabled ActiveNextPre'>Cuối trang</a>";
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
			$link = "categories_test.php?cid=".$arr[$i]['id']."&root=".$root;
		}
		else{
			$sql = "select * from $GLOBALS[db_sp].component where id=".$arr[$i]['comp'];
			$r = $GLOBALS["sp"]->getRow($sql);
			$link = $r['do']."?act=".$r['act']."&cid=".$arr[$i]['id'];
		}
		$list.= "
			<li>
				<span>&raquo;</span> <a  href='".$link."' title='".$arr[$i]['name_vn']."' >".$arr[$i]['name_vn']."</a>
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

function getLoaiVangTest($a){
	$name='';
	$id = $a['id'];
	$table = $a['table'];
	$namevn = $a['namevn'];
	if($id>0){
		$sql = "SELECT ".$namevn." FROM $GLOBALS[db_sp].".$table." WHERE id=".$id;
		$name = $GLOBALS['sp']->getOne($sql);
	}
	return $name;
}

function insert_getLoaiVangTest($a){
	$name='';
	$id = $a['id'];
	$table = $a['table'];
	$namevn = $a['namevn'];
	if($id>0){
		$sql = "SELECT ".$namevn." FROM $GLOBALS[db_sp].".$table." WHERE id=".$id;
		$name = $GLOBALS['sp']->getOne($sql);
	}
	return $name;
}

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

function optionChuyenDenTest($a){
	$opt = '';
	$id = $a;//['id'];
	if(!empty($id)){
		$sql = "select * from $GLOBALS[db_sp].categories where id in (".$id.") and active=1 order by id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$opt .= "<option value='".$item['id']."'>".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";	
		}
	}
	return $opt;
}

function insert_optionChuyenDenTest($a){
	$opt = '';
	$id = $a['id'];
	if(!empty($id)){
		$sql = "select * from $GLOBALS[db_sp].categories where id in (".$id.") and active=1 order by id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$opt .= "<option value='".$item['id']."'>".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";	
		}
	}
	return $opt;
}
function insert_optionChuyenDen($a){
	$id = $a['id'];
	$str = '';
	if(!empty($id)){
		$sql = "select * from $GLOBALS[db_sp].categories where id in (".$id.") and active=1 order by id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= "<option value='".$item['id']."'>".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";	
		}
	}
	return $str;
}

function optionChuyenDenSelectedTest($a){
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
			$str .= "<option ".$selected." value='".$item['id']."'>".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";		
		}
	}
	return $str;
}

function insert_optionChuyenDenSelected($a){
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
	$idoption = '379, 388, 404, 416, 428, 440, 452, 464, 476, 488, 500, 512, 524, 536, 548, 560, 572, 584, 599, 611, 623, 635, 647, 659, 671, 683, 695, 727, 752, 798, 811, 1524, 1556, 1569, 1582, 1614';
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
	$idoption = '379, 388, 404, 416, 428, 440, 452, 464, 476, 488, 500, 512, 524, 536, 548, 560, 572, 584, 599, 611, 623, 635, 647, 659, 671, 683, 695, 727, 752, 798, 811, 1524, 1556, 1569, 1582, 1614';
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
	$idoption = '379, 388, 404, 416, 428, 440, 452, 464, 476, 488, 500, 512, 524, 536, 548, 560, 572, 584, 599, 611, 623, 635, 647, 659, 671, 683, 695, 727, 752, 798, 811, 1524, 1556, 1569, 1582, 1614';
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
	$str = '';
	$idoption = '379, 388, 404, 416, 428, 440, 452, 464, 476, 488, 500, 512, 524, 536, 548, 560, 572, 584, 599, 611, 623, 635, 647, 659, 671, 683, 695, 727, 752, 798, 811, 1524, 1556, 1569, 1582, 1614';
	$wh = '';
	if(!empty($noid))
		$wh = " and id NOT IN (".$noid.") ";
		$sql = "select * from $GLOBALS[db_sp].categories where id in (".$idoption.") and active=1 $wh order by num asc, id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
	foreach($rs as $item){
		$str .= "<option value='".$item['id']."'>".$item['maphongban']." :".getLinkTitle($item['id'],1)."</option>";		
	}
	return $str;
}

function insert_optionKhoSanXuatChonPhong($a){
	$chonphongbanin = ceil($a['chonphongbanin']);
	$noid = $a['noid'];
	$str = '';
	$idoption = '379, 388, 404, 416, 428, 440, 452, 464, 476, 488, 500, 512, 524, 536, 548, 560, 572, 584, 599, 611, 623, 635, 647, 659, 671, 683, 695, 727, 752, 798, 811, 1524, 1556, 1569, 1582, 1614';
	$wh = '';
	if(!empty($noid))
		$wh = " and id NOT IN (".$noid.") ";
		
	$sql = "select * from $GLOBALS[db_sp].categories where id in (".$idoption.") and active=1 $wh order by num asc, id asc";
	$rs = $GLOBALS["sp"]->getAll($sql);
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
	$madhin = ceil($a['madhin']);
	$rs = '';
	if($madhin > 0 || $madhin == -1){
		$sql = "select code from $GLOBALS[db_catalog].ordersanxuat where id=".$madhin; 
		$rs = $GLOBALS["catalog"]->getOne($sql);
	}
	return $rs;	
}
function getNamMaDonHangCatalog($madhin){
	$rs = '';
	if($madhin > 0 || $madhin == -1 ){
		$sql = "select code from $GLOBALS[db_catalog].ordersanxuat where id=".$madhin; 
		$rs = $GLOBALS["catalog"]->getOne($sql);
	}
	return $rs;	
}


function insert_optionChoDonHangCatalog($a){
	$cid = ceil($a['cid']);
	$madhin = ceil($a['madhin']);
	/*
	if($madhin == -1)
		$khongdh = "<option selected value='-1' > Không đơn hàng </option>";
	else
		$khongdh = "<option value='-1' > Không đơn hàng </option>";
	*/	
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
	
	$sqlctl = "select * from $GLOBALS[db_catalog].ordersanxuat where ( phongban in(".$phongbancatalog.") or id=-1 ) and huydh=0 order by id desc"; 
	$rsctl = $GLOBALS["catalog"]->getAll($sqlctl);	
	foreach($rsctl as $item){
		$selected = "";
		if($madhin == $item['id'])
			$selected = "selected";
		$html .= "<option ".$selected."  value='".$item['id']."' > ".$item['code']." </option>";
	}
	return  $html;
}

function insert_getSelectOptionPhongBan($a){
	$str = $a['str'];

	$sql = "select * from $GLOBALS[db_catalog].categories where pid in(75,363) and not id in(535,133,94) and active=1  order by num asc, id asc"; 
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
	global $path_url,$lang;
	$sql = "select * from $GLOBALS[db_sp].categories where id=$cid";
	$item = $GLOBALS["sp"]->getRow($sql);
	if($item["pid"] == 2)
		$str=$item["name_vn"];
	else{
		//if($live == 1)
			$str=' <strong> &raquo; ' .$item["name_vn"]."</strong>";
		//else
			//$str=' => ' .$item["name_vn"];
	}
	if($item['pid'] != 2)
		return getLinkTitle($item["pid"],2).$str;	
	else
		return $str;	
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
	if($id > 0){
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
	// die($sql);
	$rs = $GLOBALS["sp"]->getAll($sql);
	return $rs;
}

function getTableRow($table,$wh){
	$sql = "select * from $GLOBALS[db_sp].".$table." where 1=1 $wh";
	// die($sql);
	$rs = $GLOBALS["sp"]->getRow($sql);
	return $rs;
}

function getTableOne($table,$name,$wh){
	$sql = "select ".$name." from $GLOBALS[db_sp].".$table." where 1=1 $wh";
	$rs = $GLOBALS["sp"]->getOne($sql);
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
		$sql="select * from $GLOBALS[db_sp].permissions  where cid=$cid and perm <> '' and uid = " .$_SESSION["admin_qlsxntjcorg_id"];
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

function insert_getSubcategory($a){
	$loaicha = $a['id'];
	$uid = $a['uid'];
	$sql = "select * from $GLOBALS[db_sp].categories where  pid= ".$loaicha." and nopermission=0 order by num asc ";
	$rs = $GLOBALS["sp"]->getAll($sql);  
	echo '<ul class="pmscap2">';
	$i=3;
	foreach($rs as $item){
		echo getCheckPms($uid,$item['id'],$item['name_vn'],'class="pmslicap2"');
		if($item['has_child'] ==1 ){
			getSubcategory($item['id'],$i,$uid);
		}
		
	} 
	echo '</ul>';
}

function getSubcategory($loaicha,$i,$uid){
	$sql = "select * from $GLOBALS[db_sp].categories where  pid= ".$loaicha." order by num asc ";
	$rs = $GLOBALS["sp"]->getAll($sql);  
	echo '<ul class="pmscap'.$i.'">';
	$i++;
	foreach($rs as $item){
		echo getCheckPms($uid,$item['id'],$item['name_vn'],'');
		if($item['has_child'] ==1 ){
			getSubcategory($item['id'],$i,$uid);
		}
	} 
	echo '</ul>';
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
	$sql = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
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
		<select class="selectOption" id="idloaivang'.$idnum.'" name="idloaivang[]" >
             <option value="">--Chọn loại vàng--</option>
			 '.$html.'
		</select>
	';
	return $html;
}
function loadloaivang($idloaivang,$checkdisabled,$idnum){
	global $path_url;
	$sql = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
	$rs = $GLOBALS["sp"]->getAll($sql);
	$disabled = '';
	if($checkdisabled == 1){
		$disabled = 'disabled="disabled"';	
	}
	$html = '';
	foreach($rs as $item){
		if($idloaivang == $item['id'])
			$checked = "selected";
		else
			$checked = ""; 
		$html .= "<option ".$checked." value='".$item['id']."' > ".$item['name_vn']."  </option>";
	}
	
	$html = '
		<select id="idloaivang'.$idnum.'" name="idloaivang[]" >
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

function insert_getPmscheck($a){
	$uid = $a['uid'];
	$cid = $a['cid'];
	$name_vn = $a['name_vn'];
	$listmenu = getCheckPms($uid,$cid,$name_vn,'class="pmslicap1"');
	
	 return $listmenu;
}
function getCheckPms($uid, $cid, $name_vn, $class){
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
		
	if(in_array("10",explode(',',$rs_pms['perm']))) // Print
		$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
	else
		$listmenu .= '<div class="col2"><input type="checkbox"></div>';	
		
	if(in_array("4",explode(',',$rs_pms['perm'])))
		$listmenu .= '<div class="col2"><input checked="checked" type="checkbox"></div>';
	else
		$listmenu .= '<div class="col2"><input type="checkbox"></div>';
	
	$listmenu = '
		 <li '.$class.'>
		 	<a class="popupPms" title="'.$name_vn.'" href="'.$path_url.'/popup/permission.php?uid='.$uid.'&cid='.$cid.'">
				<div class="col1"><span>'.$name_vn.'</span></div>
				<span id="showpms'.$cid.'"> '.$listmenu.' </span>
			</a>
		 </li>  
	 ';
	 return $listmenu;
}
/*==============End phân quyền==================*/
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
			$sqlhaodu = "select SUM(hao) as hao, SUM(du) as du, SUM(haochenhlech) as haochenhlech, SUM(duchenhlech) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
						 where idloaivang=".$idloaivang." 
						 and dated <= '".$datedauthang."'
			";
			$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

			////////////////get số tồn hiện tại
			$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
			$rston = $GLOBALS['sp']->getRow($sqlton);
			
			$slton = round(($rston['sltonv'] - $rshaodu['hao']),3) + $rshaodu['du'];
			$slton = round(($slton - $rshaodu['haochenhlech']),3) + $rshaodu['duchenhlech'];
			
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
function thongKeTonHienTaiKhoSanXuatTest($cid,$idloaivang){
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
			$arrlist['tongQ10'] = getTongQ10Test($arrlist['slton'], $arrlist['idloaivang'],'');
			$arrlist['tongQ10GiaCong'] = getTongQ10Test($arrlist['slton'], $arrlist['idloaivang'],'giacong');
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
					$slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
					$slton = round(round(($slton - $rshaodu['haochenhlech']),3) + $rshaodu['duchenhlech'],3);
					
					
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
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type in(2,3)
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3); 
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

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					$sltontndn = round(round(($sltontndn - $rsxuat['hao']),3) + $rsxuat['du'],3);
					//$sltontndn = round(($sltontndn -  $rsxuat['hao']),3);
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
								 and dated = '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang."  and dated = '".$datedauthang."' order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(round($sltonsddk + $rston['slnhapv'],3) - $rston['slxuatv'],3);
					
					$slton = round(round(($slton - $rshaodu['hao']),3) + $rshaodu['du'],3);
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
					$sqlhaodutndt = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$table."haodu 
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
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3) + round(($rshaodutndt['du'] - $rshaodutndt['hao']),3);
					$sltontndt = round(($sltontndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),3)),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$table."haodu 
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

function thongKeTonKhoSanXuat($cid, $idloaivang, $fromDate, $toDate){
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
		
		//die($toDate);
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
					$sqlhaodutndt = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$table."haodu 
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
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$table."haodu 
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
		$sql = "select tuoiquydinh from $GLOBALS[db_sp].loaivang where id=".$idloaivang;
		$tuoiquydinh = $GLOBALS['sp']->getOne($sql);
		//echo $slton . '::'.$tuoiquydinh;
		$tongq10 = round($slton  * $tuoiquydinh,3);
	}
	return $tongq10;
}

function getTongQ10Test($slton,$idloaivang,$tuoichuan = ''){
	$tongq10 = 0;
	if($idloaivang > 0){
		$sql = "select tuoiquydinh from $GLOBALS[db_sp].loaivang where id=".$idloaivang;
		// $tuoiquydinh = $GLOBALS['sp']->getOne($sql);
		$tuoiquydinh = $tuoichuan == 'giacong'?0.77:$GLOBALS['sp']->getOne($sql);
		//echo $slton . '::'.$tuoiquydinh;
		$tongq10 = round($slton  * $tuoiquydinh,3);
	}
	return $tongq10;
}

function getTongQ10($slton,$idloaivang){
	$tongq10 = 0;
	if($idloaivang > 0){
		$sql = "select tuoiquydinh from $GLOBALS[db_sp].loaivang where id=".$idloaivang;
		$tuoiquydinh = $GLOBALS['sp']->getOne($sql);
		//echo $slton . '::'.$tuoiquydinh;
		$tongq10 = round($slton  * $tuoiquydinh,3);
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
                        <strong>Đơn Giá</strong>
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
                        <strong>Đơn Giá</strong>
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
function hachToanHaoDuMaPhuKienAdd($idloaivang, $idphukien, $hao, $du, $haochenhlech, $duchenhlech,  $dated, $tablehachtoan){
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
function hachToanHaoDuMaPhuKienEdit($idphukien, $idloaivang, $hao, $du, $haochenhlech, $duchenhlech, $idphukienedit, $idloaivangedit, $haoedit, $duedit, $haochenhlechedit, $duchenhlechedit, $dated, $tablehachtoan){
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

			$arrKhacPKVaVang['hao'] = $hao;
			$arrKhacPKVaVang['du'] = $du;
			
			$arrKhacPKVaVang['haochenhlech'] = $haochenhlech;
			$arrKhacPKVaVang['duchenhlech'] = $duchenhlech;
			
			$arrKhacPKVaVang['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrKhacPKVaVang);
		}
		else{// có rồi thi update vào sodudauky			
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

			$arrKhacVang['hao'] = $hao;
			$arrKhacVang['du'] = $du;
			
			$arrKhacVang['haochenhlech'] = $haochenhlech;
			$arrKhacVang['duchenhlech'] = $duchenhlech;
			
			$arrKhacVang['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrKhacVang);
		}
		else{// có rồi thi update vào sodudauky			
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

			$arrKhacPK['hao'] = $hao;
			$arrKhacPK['du'] = $du;
			
			$arrKhacPK['haochenhlech'] = $haochenhlech;
			$arrKhacPK['duchenhlech'] = $duchenhlech;
			
			$arrKhacPK['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrKhacPK);
		}
		else{// có rồi thi update vào sodudauky			
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
function hachToanHaoDuMaPhuKienDelete($idloaivang, $idphukien, $hao, $du, $haochenhlech, $duchenhlech, $dated, $tablehachtoan){
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day = array();
	$datenow = $dated;
	$dateday = explode('-',$datenow);
	$datedauthang = $dateday[0].'-'.$dateday[1].'-01';
	
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$idloaivang." and idphukien=".$idphukien;
	$rsdate = $GLOBALS['sp']->getRow($sqldate);
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
			$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, 
									ROUND(SUM(du), 3) as du, 
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
			$sltonPKsddk = round($rstonsddk['sltonphukien'],3);

			// Tính số lượng vàng tồn còn lại dựa trên số dư đầu kỳ hao dư
			$sltonVsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);
			$sltonVsddk = round(round(($sltonVsddk - $rshaodusddk['haochenhlech']),3) + $rshaodusddk['duchenhlech'],3);
				
			$thangdauky = $rstonsddk['dated'];
			
			// Get số lượng hao dư ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sqlhaodutndt = "select ROUND(SUM(hao), 3) as hao, 
									ROUND(SUM(du), 3) as du, 
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
			$sltonPKtndt = round(($rsnhaptndt['slnhapphukien'] - $rsxuattndt['slxuatphukien']),3);
			$sltonPKsddk = round(($sltonPKsddk + $sltonPKtndt),3);

			// Tính số lượng tồn vàng khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sltonVtndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3) + round(($rshaodutndt['du'] - $rshaodutndt['hao']),3);
			$sltonVtndt = round(($sltonVtndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),3)),3); 
			$sltonVsddk = round(($sltonVsddk + $sltonVtndt),3);

			// Get số lượng nhập, xuất, hao, dư, tồn từ ngày đến ngày 
			$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
								ROUND(SUM(du), 3) as du, 
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
			$sltonPKtndn = round(($rsnhap['slnhapphukien'] - $rsxuat['slxuatphukien']),3);

			// Tính số lượng tồn vàng từ ngày đến ngày
			$sltonVtndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3) + round(($rshaodu['du'] - $rshaodu['hao']),3);
			$sltonVtndn = $sltonVtndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),3);

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
			
			$arrlist['tongQ10'] = getTongQ10($arrlist['sltonV'], $arrlist['idloaivang']);	
			
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
			$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, 
									ROUND(SUM(du), 3) as du, 
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
			$sltonPKsddk = round($rstonsddk['sltonphukien'],3);

			// Tính số lượng vàng tồn còn lại dựa trên số dư đầu kỳ hao dư
			$sltonVsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);
			$sltonVsddk = round(round(($sltonVsddk - $rshaodusddk['haochenhlech']),3) + $rshaodusddk['duchenhlech'],3);
				
			$thangdauky = $rstonsddk['dated'];
			
			// Get số lượng hao dư ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sqlhaodutndt = "select ROUND(SUM(hao), 3) as hao, 
									ROUND(SUM(du), 3) as du, 
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
			$sltonPKtndt = round(($rsnhaptndt['slnhapphukien'] - $rsxuattndt['slxuatphukien']),3);
			$sltonPKsddk = round(($sltonPKsddk + $sltonPKtndt),3);

			// Tính số lượng tồn vàng khoảng ngược từ ngày được chọn (nếu không chọn lấy ngày hiện tại) đến đầu tháng đó
			$sltonVtndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3) + round(($rshaodutndt['du'] - $rshaodutndt['hao']),3);
			$sltonVtndt = round(($sltonVtndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),3)),3); 
			$sltonVsddk = round(($sltonVsddk + $sltonVtndt),3);

			// Get số lượng nhập, xuất, hao, dư, tồn từ ngày đến ngày 
			$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
								ROUND(SUM(du), 3) as du, 
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
			$sltonPKtndn = round(($rsnhap['slnhapphukien'] - $rsxuat['slxuatphukien']),3);

			// Tính số lượng tồn vàng từ ngày đến ngày
			$sltonVtndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3) + round(($rshaodu['du'] - $rshaodu['hao']),3);
			$sltonVtndn = $sltonVtndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),3);

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
			
			$arrlist['tongQ10'] = getTongQ10($arrlist['sltonV'], $arrlist['idloaivang']);	
			
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
		$datedauthang = $datetao[0].'-'.$datetao['1'].'-01';	
	}
	else{/// xuất kho
		$datetao = explode('-',$rsct['datedxuat']);
		$datedauthang = $datetao[0].'-'.$datetao['1'].'-01';		
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
										
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and typesauchetac=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
									"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
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
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and typesauchetac=2
									and dated >= '".$fromDate."'  
									and dated <= '".$toDate."' 
								"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					// die($sqlnhap);
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang, ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du 				from $GLOBALS[db_sp].".$table." 
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

function abs_diff($v1, $v2) {
    $diff = $v1 - $v2;
    return $diff < 0 ? (-1) * $diff : $diff;
}








?>


