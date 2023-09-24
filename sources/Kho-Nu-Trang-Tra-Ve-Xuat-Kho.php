<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';
$smarty->assign("phongbanchuyen",$idpem);

switch($act) {
    case 'add':
        if(!checkPermision($_GET["cid"],1)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		} {
            $sqlMaxNumphieu = "select max(numphieu) + 1 from $GLOBALS[db_sp].khonguonvao_khonutrangtrave where type = 2";
            $maxNumPhieu = $GLOBALS['sp']->getOne($sqlMaxNumphieu);
            if ($maxNumPhieu <= 0) {
                $maxNumPhieu = 1;
            }
            $sqlGetSophieu = "select DISTINCT sophieu from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where type = 1";
            $sophieu = $GLOBALS['sp']->getCol($sqlGetSophieu);
            $numphieu = convertMaso($maxNumPhieu);
            $maphieu = 'PXKDCNTV'.$numphieu;

            $smarty->assign("datedxuat", date('d-m-Y'));
            $smarty->assign("maphieu", $maphieu);
            $smarty->assign("sophieu", $sophieu);
            $template = "Kho-Nu-Trang-Tra-Ve-Xuat-Kho/edit.tpl";
        }
        break;
    case 'loaddulieutrakho':
        try {
            $sophieu = $_POST['sophieu'] ? $_POST['sophieu'] : '';
            $sqlPhieu = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where sophieu = '$sophieu' and type = 1";
            $phieu = $GLOBALS['sp']->getAll($sqlPhieu);

            $error = 'success';
        } catch (Exception $e) {
            $error = $e;
        }
    
        die(json_encode(array('status'=>$error,'phieu'=>$phieu)));
        break;
    default:
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url."/sources/main.php";
            page_transfer2($page);
        } else {
            $template = "Kho-Nu-Trang-Tra-Ve-Xuat-Kho/list.tpl";

            if(checkPermision($idpem,1))
                $smarty->assign("checkPer1","true");
            if(checkPermision($idpem,3))
                $smarty->assign("checkPer3","true");
        }
        break;
}
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>