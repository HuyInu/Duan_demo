<?php
clearstatcache();
include_once("#include/config.php");
include_once("functions/function.php");
include_once("functions/functionVu.php");
include_once("functions/functionNhom.php");
include_once("functions/functionHuy.php");
include_once("Helper/SQLHelper.php");
include_once("Helper/DebugHelper.php");
global $path_url, $act, $do, $numRowsPage;
date_default_timezone_set("Asia/Ho_Chi_Minh");
CheckLogin();
$do = isset($_GET['do'])?$_GET['do']:"main";
$numPageAll = 50;
$iSEGSIZE = 5;
$errorTransetion = 'Lỗi hệ thống dữ liệu, vui lòng liên hệ với addmin để xử lý.'; 
$page = isset($_GET["page"])?$_GET["page"] : '1';//for paging
if ($page == NULL) $page = 1;
?>