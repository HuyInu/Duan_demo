<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';
$smarty->assign("phongbanchuyen",$idpem);

switch ($act) {
    default:
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url."/sources/main.php";
            page_transfer2($page);
        } else {
            $sqlTypeWhere = "type in (0, 1)";
            switch($act) {
                case 'insertedShow':
                    $sqlTypeWhere = "type = 1";
                    break;
                case 'uninsertShow':
                    $sqlTypeWhere = "type = 0";
                    break;
            }
            $sqlTong = "select sum(slmon) as tongallslmon,
             sum(Round(cannangvh, 3)) as tongallcannangvh,
              sum(Round(cannangh, 3)) as tongallcannangh,
               sum(Round(cannangv, 3)) as tongallcannangv,
                sum(tienh) as tongalltienh,
                 sum(tiencong) as tongalltiencong,
                  sum(tiendangoctrai) as tongalltiendangoctrai from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where typeimport = 1 and (phongban = $idpem or phongbanchuyen = $idpem) and ".$sqlTypeWhere;
            $tongAll = $GLOBALS['sp']->getRow($sqlTong);
            $smarty->assign("tongAll",$tongAll);
            $sql = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where typeimport = 1 and (phongban = $idpem or phongbanchuyen = $idpem) and ".$sqlTypeWhere;
            $sql_sum = "select count(*) from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where typeimport = 1 and (phongban = $idpem or phongbanchuyen = $idpem) and ".$sqlTypeWhere;
            $total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
            $num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = $path_url."/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?cid=".$idpem;
			$link_url = "";

            if($num_page > 1 ) {
                $link_url = paginator($num_page,$page,$iSEGSIZE,$url,$strSearch);
            }
			$sql = $sql." limit $begin,$num_rows_page";
			$rs = $GLOBALS["sp"]->getAll($sql);
			if($page!=1)
            {
                $number=$num_rows_page * ($page-1);
                $smarty->assign("number",$number);
            }
            $smarty->assign("total",$num_page);
			$smarty->assign("link_url",$link_url);
            $smarty->assign("view",$rs);
            if(checkPermision($idpem,2))
				$smarty->assign("checkPer2","true");
            if(checkPermision($idpem,3))
				$smarty->assign("checkPer3","true");
            if(checkPermision($idpem,7))
				$smarty->assign("checkPer7","true");
            if(checkPermision($idpem,8))
				$smarty->assign("checkPer8","true");

            $template = 'Kho-Nu-Trang-Tra-Ve-Nhap-Kho/list.tpl';
        }
        break;
}
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>