<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';

switch ($act) {
    case 'importexcel':
        if(!checkPermision($idpem,10)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		} else {
            if ($_POST) {
                if (isset($_FILES['file']['name'] ) && $_FILES['file']['size'] > 0) {
                    require_once("../Classes-PHPExcel/PHPExcel.php");
                    $file = $_FILES['file']['tmp_name'];

                    $objFile = PHPExcel_IOFactory::identify($file);
					$objData = PHPExcel_IOFactory::createReader($objFile);
                    $objPHPExcel = $objData->load($file);
					$sheet  = $objPHPExcel->setActiveSheetIndex(0);
                    $Totalrow = $sheet->getHighestRow();
                    $LastColumn = $sheet->getHighestColumn();
                    $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
                    $phieu = [];
                    $phieuCt = [];
                    $tongv = 0;
                    $tongh = 0;
                    $itemAmount = 0;
                    $GLOBALS["sp"]->BeginTrans();
					try {
                        for($i = 2; $i <= $Totalrow - 1; $i++) {
                            $tongh += number_format(trim($sheet->getCellByColumnAndRow(19,$i)->getFormattedValue()), 3);
                            $tongv += number_format(trim($sheet->getCellByColumnAndRow(21,$i)->getFormattedValue()), 3);
                        }
                        dd($tongv);
                        $sqlMaxNumphieu = "select max(numphieu) + 1 from $GLOBALS[db_sp].khonguonvao_khonutrangtrave";
                        $maxnumphieu = $GLOBALS["sp"]->getOne($sqlMaxNumphieu);
                        if ($maxnumphieu <= 0) {
                            $maxnumphieu = 1;
                        }
                        $numphieu = convertMaso($maxnumphieu);
                        $phieu['maphieu'] = 'IMSPHHTV-23-'.$numphieu;
                        $phieu['numphieu'] = $numphieu;
                        $phieu['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
                        $phieu['dated'] = date('Y-m-d');
                        $phieu['time'] = date('H:i:s');
                        $phieu['tongslimport'] = $itemAmount;
                        
                        $GLOBALS["sp"]->CommitTrans();
                    } catch (Exception $e) {
                        $GLOBALS["sp"]->RollbackTrans();
						die($errorTransetion);
                    }
                } else {
                    $url = $path_url."/sources/Kho-Nu-Trang-Tra-Ve-Import.php?cid=".$_GET['cid'];
				    page_transfer2($url);
                }   
            } else {
                $template = "Kho-Nu-Trang-Tra-Ve-Import/import.tpl";
            }
        }
        break;
    default:
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url."/sources/main.php";
            page_transfer2($page);
        } else {
            $sql = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtrave where phongban = $idpem order by dated desc, maphieu asc";
            $sql_sum = "select count(*) from $GLOBALS[db_sp].khonguonvao_khonutrangtrave where phongban = $idpem";
            $total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
            $num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = $path_url."/sources/Kho-Nu-Trang-Tra-Ve-Import.php?cid=".$idpem;
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

            $template = 'Kho-Nu-Trang-Tra-Ve-Import/list.tpl';
            if(checkPermision($idpem,3))
				$smarty->assign("checkPer3","true");
            if(checkPermision($idpem,10))
				$smarty->assign("checkPer10","true");
        }
        break;
}
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>