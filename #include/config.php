<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors",1); 
$config = array();
//echo ini_get('session.gc_maxlifetime');
date_default_timezone_set("Asia/Ho_Chi_Minh");
// =============== CONFIGURATION ===================================================================
$config['BASE_DIR']     = $_SERVER['DOCUMENT_ROOT'].'/duan_demo'; 
$config['BASE_URL']     =  "http://".$_SERVER['SERVER_NAME'].'/duan_demo'; 

//=======================Config Database=============================================================

$DBTYPE = 'mysqli';
$DBHOST = 'localhost';
$DBUSER = 'root';
$DBPASSWORD = '';
$DBNAME = 'demo_huy';
//=======================Path to url=============================================================
require_once($config['BASE_DIR'].'/#include/bootstrap.php'); 
?>