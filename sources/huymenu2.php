<?php
include_once("../maininclude.php");
$act = (isset($_REQUEST['act']))? $_REQUEST['act'] : '';

$UrlToList = $path_url."/sources/huymenu2.php?cid=".$_REQUEST['cid'];
switch($act) {
    case "add":
        $smarty->display('header.tpl');
        $smarty->display('huytulam/edit.tpl');
        $smarty->display('footer.tpl');
    break;
    case "show":
        updateCategoriesActive(1);
        page_transfer2($UrlToList);     
    break;
    case "hide":
        updateCategoriesActive(0);
        page_transfer2($UrlToList); 
    default:
        $pidSQL;
        if($_REQUEST['cid'] === '2' || $_REQUEST['cid'] === '1856') {
            $pidSQL = 'pid in (2,1856)';
        } 
        else{
            $pidSQL = 'pid = '.$_REQUEST['cid'];
        }
        $sql = "select * from $GLOBALS[db_sp].categories where $pidSQL order by id desc";
        $categoriesList = $GLOBALS['sp']->getAll($sql);

        $smarty->assign('categoriesList', $categoriesList);
        $smarty->display('header.tpl');
        $smarty->display('huytulam/list.tpl');
        $smarty->display('footer.tpl');
    break;
}

function updateCategoriesActive ($active) {
    $checkedItemID = $_POST['checkedItemID'];
    $whereSQl = 'id in (';
    foreach($checkedItemID as $index => $item)
    {
        $whereSQl .= ($index !== count($checkedItemID)-1) ? $item.',' : $item.')';
    }
    $sql = "update $GLOBALS[db_sp].categories set active = $active where ".$whereSQl;
    $GLOBALS["sp"]->execute($sql);
}
?>
