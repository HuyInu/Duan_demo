<?php
include_once("../maininclude.php");
$act = (isset($_REQUEST['act']))? $_REQUEST['act'] : '';
$template;

$UrlToList = $path_url."/sources/huymenu2.php?cid=".$_REQUEST['cid'];
switch($act) {
    case "add":
        $template = 'huytulam/edit.tpl';
    break;
    case "addsm":
        try{
            $data = requestToArray();
            $data['pid'] = $_REQUEST['cid'];
            $result = Giahuy_Insert('categories',$data);

            //$UrlToList .= getSuccesActResultToUrl();
        } catch(Exception $e) {
            //$UrlToList .= getErrorActResultToUrl();
        }
        page_transfer2($UrlToList); 
    break;
    case "edit":
        $catogID = $_REQUEST['id'];
        $sql = "select * from $GLOBALS[db_sp].categories where id = $catogID";
        $category = $GLOBALS["sp"]->getRow($sql);

        $template = 'huytulam/edit.tpl';
        $smarty->assign('category', $category);
    break;
    case "editsm":
        try {
            $data = requestToArray();
            $result = Giahuy_update('categories',$data, "id='".$data['id']."'");

            //$UrlToList .= getSuccesActResultToUrl();
        } catch (Exception $e) {
            //$UrlToList .= getErrorActResultToUrl();
        }
        page_transfer2($UrlToList); 
    break;
    case "dellist":
        $idarr = $_POST['checkedItemID'];
        if(count($idarr) > 0){
            $id = implode(',',$idarr);
            // $sql="delete from $GLOBALS[db_sp].categories  where id in (".$id.")";
            // $GLOBALS["sp"]->execute($sql);
            //vaDelete('categories', ' id in ('.$id.') ');
            delete_Categories_And_Child($id, $id);
        }
        
        
        // for($i=0;$i<count($id);$i++){
        //     $sql="delete from $GLOBALS[db_sp].categories  where id=".$id[$i];
        //     $GLOBALS["sp"]->execute($sql);
        // }
        //$whereSQL = create_Where_IN_Query_By_ID($itemsID);
        // $sql = "select has_child, id from $GLOBALS[db_sp].categories where $whereSQL";
        // $categories = $GLOBALS["sp"]->getAll($sql);
        // $result = delete_Categories_And_Child($categories);
        if($result === 'success') {
            //$UrlToList .= getSuccesActResultToUrl();
        } else {
            //$UrlToList .= getErrorActResultToUrl();
        }
        page_transfer2($UrlToList);
    break;
    case "show":
        try {
            updateCategoriesActive(1);
            //$UrlToList .= getSuccesActResultToUrl();
        } catch(Exception $e) {
            //$UrlToList .= getErrorActResultToUrl();
        }     
        page_transfer2($UrlToList);     
    break;
    case "hide":
        try{
            updateCategoriesActive(0);
            //$UrlToList .= getSuccesActResultToUrl();
        } catch(Exception $e) {
            //$UrlToList .= getErrorActResultToUrl();
        }
        page_transfer2($UrlToList); 
    break;
    case 'order':
        try{
            $ordersID = $_POST['id'];
            $ordersNum = $_POST['num'];
            foreach($ordersID as $index => $order) {
                $sql = "update $GLOBALS[db_sp].categories set num = '".$ordersNum[$index]."' where id = '$order'";
                $GLOBALS["sp"]->execute($sql);
            }
            //$UrlToList .= getSuccesActResultToUrl();
        } catch(Exception $e) {
            //$UrlToList .= getErrorActResultToUrl();
        }
        page_transfer2($UrlToList);
    break;
    default:
        $pidSQL;
        if($_REQUEST['cid'] === '2' || $_REQUEST['cid'] === '1834') {
            $pidSQL = 'pid in (2,1834)';
        } 
        else{
            $pidSQL = 'pid = '.$_REQUEST['cid'];
        }
        $sql = "select * from $GLOBALS[db_sp].categories where $pidSQL order by num asc";
        $categoriesList = $GLOBALS['sp']->getAll($sql);
        $template = 'huytulam/list.tpl';
        
        //$actResult = getActResultMsg();
        //$smarty->assign('actResult', $actResult);
        $smarty->assign('categoriesList', $categoriesList);   
    break;
}
$smarty->display('header.tpl');
$smarty->display($template);
$smarty->display('footer.tpl');

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

function delete_Categories_And_Child ($idToDelete, $id) {
    $GLOBALS["sp"]->BeginTrans();
    try {
        $sql = "select id from $GLOBALS[db_sp].categories where pid in ($id)";
        $Child_category = $GLOBALS["sp"]->getAll($sql);
        if(count($Child_category) > 0) {
            $childID = implode(',', array_map(function ($category) {
                return $category['id'];
            }, $Child_category));
            $idToDelete .= ','.$childID;
            delete_Categories_And_Child($idToDelete, $childID);
        } else {
            vaDelete('categories', "id in ($idToDelete)");
        }
        
        $GLOBALS["sp"]->CommitTrans();
    } catch(Exception $e) {
        $GLOBALS["sp"]->RollbackTrans();
        return 'error';
    }  
    return 'success';
}

function create_Where_IN_Query_By_ID ($ItemIDArray) {
    $whereSQl = 'id in (';
    foreach($ItemIDArray as $index => $item)
    {
        $whereSQl .= ($index !== count($ItemIDArray)-1) ? $item.',' : $item.')';
    }
    return $whereSQl;
}

function requestToArray () {
    $data = [];
    $data['id'] = isset($_REQUEST['id']) ? $_REQUEST['id'] : ''; 
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
    $data['comp'] = $data['has_child'] === 1 ? 0 : $_POST['comp'];
    
    return $data;
}

function getSuccesActResultToUrl() {
    return '&actResult=1';
}

function getErrorActResultToUrl() {
    return '&actResult=0';
}

function getActResultMsg() {
    $actResult = [];
    if(isset($_REQUEST['actResult'])) {
        $actResult['msg'] = $_REQUEST['actResult'] === '1' ? 'Thao tác thành công!' : 'Thao tác thất bại!';
        $actResult['result'] = $_REQUEST['actResult'] === '1' ? '1' : '0';
    } else {
        return null;
    } 
    return $actResult;
}
?>
