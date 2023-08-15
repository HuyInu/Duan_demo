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
    case "addsm":
        $data = requestToArray();
        $data['pid'] = $_REQUEST['cid'];

        $result = Giahuy_Insert('categories',$data);

        if($result === 'success') {
            page_transfer2($UrlToList); 
            var_dump('success');
        } else {
            var_dump('error');
            die();
        }
    case "dellist":
        $itemsID = $_POST['checkedItemID'];
        foreach($itemsID as $id) {
            $sql = "select has_child, id from $GLOBALS[db_sp].categories where id = '$id'";
            $item = $GLOBALS["sp"]->getRow($sql);
            delete_Categories_And_Child($item);
        }
        die();
    break;
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

function delete_Categories_And_Child ($item) {
    if($item['has_child'] === '1') {
        Giahuy_delete('catogories', $item['id']);
        $sql
    }
}

function create_Where_IN_Query_By_ID ($ItemIDArray) {
    $whereSQl = 'id in (';
    foreach($ItemIDArray as $index => $item)
    {
        $whereSQl .= ($index !== count($checkedItemID)-1) ? $item.',' : $item.')';
    }
    return $whereSQl;
}

function requestToArray () {
    $data = [];
    $data['id'] = ''; 
    $data['name_vn'] = $_POST['name_vn']; 
    $data['table'] = $_POST['table']; 
    $data['tablect'] = $_POST['tablect']; 
    $data['tablehachtoan'] = $_POST['tablehachtoan']; 
    $data['typephongban'] = $_POST['typephongban'] ? $_POST['typephongban'] : 0;
    $data['maphongban'] = $_POST['maphongban']; 
    $data['num'] = $_POST['num']; 
    $data['nopermission'] = $_POST['nopermission'] === '1' ? 1 : 0;
    $data['active'] = $_POST['active'] === '1' ? 1 : 0;
    $data['has_child'] = $_POST['has_child'] === '1' ? 1 : 0;
    $data['comp'] = $data['has_child'] === 1 ? '' : $_POST['comp'];
    
    return $data;
}

function addCatogery ($data) {

}
?>
