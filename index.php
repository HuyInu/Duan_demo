<?php
include_once("#include/config.php"); 
//////////check ngày hiện tại đúng không
$datenowcheck =  date("Y-m-d");
$sqlcdated = "select * from $GLOBALS[db_sp].check_datenow where id=1";
$rscdated = $GLOBALS["sp"]->getRow($sqlcdated);
$datedatabase = $rscdated['dated'];
if(strtotime($datenowcheck) < strtotime($datedatabase) ){
	header('Content-Type: text/html; charset=utf-8');
	die('Ngày hiện tại: <strong>'.date("d-m-Y").'</strong> không đúng, nên không sử dụng phầm mềm được, vui lòng <strong>liên hệ với admin</strong>');	
}
elseif (strtotime($datenowcheck) > strtotime($datedatabase)){
	$sql = "UPDATE $GLOBALS[db_sp].check_datenow SET dated = '".$datenowcheck."' ";
	$GLOBALS["sp"]->execute($sql);	
}

$do=(isset($_GET['do'])) ? $_GET['do'] : 'main';
if($_SESSION["store_qlsxntjcorg_login"]==''){
	$do="login";
	require("./sources/".$do.".php");
}
else{
	global $act, $do;
	//$do = isset($_GET['do'])?$_GET['do']:"main";
	if (!file_exists("./sources/".$do.".php")){
		die("There is not this function!!!");
	}
	echo '
<!DOCTYPE html>
<html lang="vi">
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="no-cache">
<meta http-equiv="Expires" content="-1">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="NOINDEX, NOFOLLOW" />
<title>Hệ Thống Quản Lý Sản Xuất </title>
<script type="text/javascript">
  var origCols;
  var origRows;
  function resizeLeftFrame(left){
	var framset = document.getElementById("left_frame");
	origCols = framset.cols;
	framset.cols = left+", *";
  }
  function resizeTopFrame(top){
	var mframset = document.getElementById("main_frame");
	origRows = mframset.rows;
	mframset.rows = top+", *";
  }
  function restoreFrame(){
	document.getElementById("main_frame").rows = origRows;
	origRows =null;
	document.getElementById("left_frame").cols = origCols;
	origCols =null;
  }
  function toggleFrame(elem){
	  if(origCols){
		  restoreFrame();
		  elem.innerHTML ="Phóng to";
	  }
	  else{
		  resizeLeftFrame(0);
		  resizeTopFrame(0)
		  elem.innerHTML ="Thu nhỏ";
	  }
  }
</script>
</head>
<frameset id="main_frame" rows="100,*" border="0">
	<frame src="top.html" scrolling="no"  noresize="0" frameborder="0" marginwidth="0" marginheight="0" frameborder="0" >
	<frameset id="left_frame" cols="220,*" bordercolor="#fecd07" border="6">
		<frame  src="allmenu.php" scrolling="auto">
		<frame name="QLSX_content" src="sources/'.$do.'.php" scrolling="auto" frameborder="0" marginwidth="0" marginheight="0">
	</frameset>
</frameset> 
</html>
';
}
?>
