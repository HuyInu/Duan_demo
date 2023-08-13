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
//die($sql);
	$GLOBALS["sp"]->execute($sql);
	$post_id = $GLOBALS["sp"]->Insert_ID();
	return $post_id;
}
function vaDelete($tbl, $where){
	global $db,$table_prefix;
	$sql = "DELETE FROM $GLOBALS[db_sp].`".$tbl."` WHERE $where";
	$GLOBALS["sp"]->execute($sql);
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
			$link = "categories.php?cid=".$arr[$i]['id']."&root=".$root;
		}
		else{
			$sql = "select * from $GLOBALS[db_sp].component where id=".$arr[$i]['comp'];
			$r = $GLOBALS["sp"]->getRow($sql);
			$link = $r['do'].".php?act=".$r['act']."&cid=".$arr[$i]['id'];
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

function getName($table, $names, $id){
	$name = '';
	if($id > 0){
		$sql = "select ".$names." from $GLOBALS[db_sp].".$table." where id= ".$id;
		$name = $GLOBALS["sp"]->getOne($sql);
	}
	return $name;
}


function insert_optionChuyenDen($a){
	$id = $a['id'];
	$str = '';
	if(!empty($id)){
		$sql = "select * from $GLOBALS[db_sp].categories where id in (".$id.") order by id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= "<option value='".$item['id']."'>".getLinkTitle($item['id'],1)."</option>";		
		}
	}
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
		$sql="select * from $GLOBALS[db_sp].permissions  where cid=$cid and uid = " .$_SESSION["admin_qlsxntjcorg_id"];
		$showall = ceil(count($GLOBALS["sp"]->getAll($sql)));
		if( ($showall > 0) || ($_SESSION['group_qlsxntjcorg_user'] == -1))
			return 1;
		else
			return 0;
	}
}
function checkViewPermision($cid){//gia tri action ( 1 -> add, 2 -> edit , 3 -> delete , 4 -> all, 5 -> view, 6 -> chuyển)
	if($_SESSION["admin_qlsxntjcorg_id"] > 0){
		$sql="select * from $GLOBALS[db_sp].permissions  where cid=$cid and uid = " .$_SESSION["admin_qlsxntjcorg_id"];
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
			$sql="select * from $GLOBALS[db_sp].permissions  where ((perm like '%".$act."%') or (perm like '%4%')) and cid=$cid and uid = " .$_SESSION["admin_qlsxntjcorg_id"];
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
		<select class="selectOption" id="idloaivang" name="idloaivang[]" >
             <option value="">--Chọn loại vàng--</option>
			 '.$html.'
		</select>
	';
	return $html;
}
function loadloaivang($idloaivang,$checkdisabled){
	global $path_url;
	$sql = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
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
		<select id="idloaivang" name="idloaivang[]" >
             <option value="">--Chọn loại vàng--</option>
			 '.$html.'
		</select>
	';
	return $html;
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

/*==============Ghi sổ Hạch toán==================*/
function ghiSoHachToan($tablehachtoan, $tablenhan, $id){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$arrDay = getdate();
	$datenow = $arrDay['year'].'-'.$arrDay['mon'].'-'.$arrDay['mday'];
	$timnow = date('H:i:s');
	$i = 0;
	/////////////////ghi vào sổ đầu kỳ(hạch toán) vd: khoachin_sodudauky////////////////
	$item = getTableRow($tablenhan,' and id='.$id); /// table  nxct vd: khonguonvao_khoachinct
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	if($item['type']==1){//số lượng nhập
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
		
		$dongianhaprc = $item['dongiaban'];;
		$slnhapkimcuongrc = 1;
		/// table vd: khoachin_sodudauky
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datenow."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];
	}
	else{ // số lượng xuất
		$slxuatvhrc = $item['cannangvh'];
		$slxuatvrc = $item['cannangv'];
		$slxuathrc = $item['cannangh'];
		
		$haorc = $item['hao'];
		$durc = $item['du'];
		
		$dongiaxuatrc = $item['dongiaban'];
		$slxuatkimcuongrc = 1;
		
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
			$sltonvh = ($sltonvh + $slnhapvhrc) - $slxuatvhrc ;
			
			$sltonv = ($sltonv + $slnhapvrc) - $slxuatvrc ;
			$sltonh = ($sltonh + $slnhaphrc) - $slxuathrc ;
			
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
			$sltonkimcuong = ($sltonkimcuong + $slnhapkimcuongrc)-$slxuatkimcuongrc;
			$tongdongia = ($tongdongia + $dongianhaprc)-$dongiaxuatrc;
			
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuongrc;
			$arrnx1day['slxuatkimcuong'] = $slxuatkimcuongrc;
			
			$arrnx1day['dongianhap'] = $dongianhaprc;
			$arrnx1day['dongiaxuat'] = $dongiaxuatrc;
			$arrnx1day['tongdongia'] = $tongdongia;
		}
		$arrnx1day['dated'] = $datenow;
		
		echo $i++ .'<br />';
		vaInsert($tablehachtoan,$arrnx1day);
	}
	else{// có rồi thi update vào sodudauky
		if($item['typevkc']==1){/// là vàng
			//////////lấy số lượng tồn của nó
			//////////////////nhập vàng + hột
			$slnhapvh = $rsdate['slnhapvh'] + $slnhapvhrc;
			$slxuatvh = $rsdate['slxuatvh'] + $slxuatvhrc ;
			$sltonvh = ($rsdate['sltonvh'] + $slnhapvhrc) - $slxuatvhrc ;
			
			$hao = $rsdate['hao'] + $haorc;
			$du = $rsdate['du'] + $durc ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			//////////////////nhập vàng
			$slnhapv = $rsdate['slnhapv'] + $slnhapvrc;
			$slxuatv = $rsdate['slxuatv'] + $slxuatvrc ;
			$sltonv = ($rsdate['sltonv'] + $slnhapvrc) - $slxuatvrc;
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			//////////////////nhập hột
			$slnhaph = $rsdate['slnhaph'] + $slnhaphrc;
			$slxuath = $rsdate['slxuath'] + $slxuathrc ;
			$sltonh = ($rsdate['sltonh'] + $slnhaphrc) - $slxuathrc ;
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
		
			$arrnx1day['hao'] = $hao;
			$arrnx1day['du'] = $du;
			
			echo $i++ .'<br />';
			
			print_r($arrnx1day);
		}
		else{// là kim cương
			$slnhapkimcuong = $rsdate['slnhapkimcuong'] + $slnhapkimcuongrc;
			$slxuatkimcuong = $rsdate['slxuatkimcuong'] + $slxuatkimcuongrc ;
			$sltonkimcuong = ($rsdate['sltonkimcuong'] + $slnhapkimcuongrc) - $slxuatkimcuongrc ;
			
			$dongianhap = $rsdate['dongianhap'] + $dongianhaprc;
			$dongiaxuat = $rsdate['dongiaxuat'] + $dongiaxuatrc;
			$tongdongia = ($rsdate['tongdongia'] + $dongianhaprc) - $dongiaxuatrc ;
			
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
?>

