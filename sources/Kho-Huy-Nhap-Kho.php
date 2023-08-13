<?php
    include_once("../maininclude.php");
    $act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
    $idpem = $_GET["cid"];
    $smarty->assign("phongbanchuyen",$idpem);
    switch($act){
        default:
        if(checkPermision($idpem,1))
			$smarty->assign("checkPer1","true");
        if(checkPermision($idpem,2))
            $smarty->assign("checkPer2","true");
        if(checkPermision($idpem,3))
            $smarty->assign("checkPer3","true");
        if(checkPermision($idpem,6))
            $smarty->assign("checkPer6","true");
        if(checkPermision($idpem,7))
            $smarty->assign("checkPer7","true");

        $smarty->display('Kho-Huy-Nhap-Kho/list.tpl');
        break;
    }
?>