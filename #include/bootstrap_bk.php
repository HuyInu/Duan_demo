<?php
//user smarty
require_once($config['BASE_DIR'].'/libraries/smarty/libs/Smarty.class.php');
//DB Exceptions
require_once($config['BASE_DIR'].'/libraries/adodb5/adodb-exceptions.inc.php');
require_once($config['BASE_DIR'].'/libraries/adodb5/adodb.inc.php');
//multi lang
require_once($config['BASE_DIR'].'/libraries/multilang.class.php');

//===============
$conn = ADONewConnection($DBTYPE);
//print_r($conn); die();
$GLOBALS["db_sp"]=$DBNAME;
$GLOBALS["sp"]=$conn;
//$db = $GLOBALS["db_sp"];
$result = @$conn->Connect($DBHOST, $DBUSER, $DBPASSWORD, $DBNAME);
if (!$result) exit("Can't connect $DBNAME");
$conn->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
//$language=!isset($_COOKIE["language"])?"en":$_COOKIE["language"];

$language="vn";
$_SESSION['language']=$language;

$typeName = !isset($_COOKIE["typeVangKimCuong"])?"vang":$_COOKIE["typeVangKimCuong"];
$_SESSION['typeVangKimCuong'] = $typeName;

$smarty = new SmartyML($language);
$GLOBALS['smarty']=$smarty;
//path smarty
$smarty ->left_delimiter = '<!--{';
$smarty ->right_delimiter = '}-->';
$smarty->caching = false;
$smarty ->compile_dir	= $config['BASE_DIR']."/templates/template_c/";
$smarty ->template_dir	= $config['BASE_DIR']."/templates/tpl/";
$smarty->cache_dir 	=   $config['BASE_DIR']."/templates/cache/";
///
//$path_url=$config['BASE_URL'];
$path_url=$config['BASE_URL'];
$smarty->assign("path_url",$path_url);
$path_dir=$config['BASE_DIR']."/";
$smarty->assign("path_dir",$path_dir);

$smarty->assign("path_url_subdomain","http://shop.thongthang.com");
$lang = $language;
$smarty->assign("lang",$language);


/*========SEO==========*/
/*
$domainAddress = md5(md5(md5($_SERVER['SERVER_NAME'])));
$sqldm = "select * from $GLOBALS[db_sp].admin where id=1";
$rsdm = $GLOBALS["sp"]->getRow($sqldm);
if($rsdm['pw2'] != $domainAddress && $rsdm['pw3'] != $domainAddress){
	die('@@@');	
}
*/
?>