<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$idpem = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';
$smarty->assign("phongbanchuyen",$idpem);

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
                    $tongtienhot = 0;
                    $tongtiencong = 0;
                    $tongtiendangoctrai = 0;
                    $dateNow = date('Y-m-d');
                    $timeNow = date('H:i:s');
                    $GLOBALS["sp"]->BeginTrans();

                    $sqlMaxNumphieu = "select max(numphieu) + 1 from $GLOBALS[db_sp].khonguonvao_khonutrangtrave";
                    $maxnumphieu = $GLOBALS["sp"]->getOne($sqlMaxNumphieu);
                    if ($maxnumphieu <= 0) {
                        $maxnumphieu = 1;
                    }
                    $numphieu = convertMaso($maxnumphieu);
                    $phieu['maphieu'] = 'IMSPHHTV-23-'.$numphieu;
                    $phieu['numphieu'] = $numphieu;
                    $phieu['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
                    $phieu['phongban'] = $idpem;
                    $phieu['datedimport'] = $dateNow;
                    $phieu['timeimport'] = $timeNow;
                    $phieu['tongslimport'] = $Totalrow - 2;
                    $phieu['tongh'] = number_format(trim($sheet->getCellByColumnAndRow(19,$Totalrow)->getFormattedValue()), 3);
                    $phieu['tongv'] = number_format(trim($sheet->getCellByColumnAndRow(21,$Totalrow)->getFormattedValue()), 3);
                    $phieu['tongvh'] = number_format(($phieu['tongh'] + $phieu['tongv']), 3);
                    $tongtienhotStr = trim($sheet->getCellByColumnAndRow(23,$Totalrow)->getFormattedValue());
                    $tongtiencongStr = trim($sheet->getCellByColumnAndRow(26,$Totalrow)->getFormattedValue());
                    $tongtiendangoctraiStr = trim($sheet->getCellByColumnAndRow(25,$Totalrow)->getFormattedValue());
                    $phieu['tongtienhot'] = (int)str_replace(",","",($tongtienhotStr));
                    $phieu['tongtiencong'] = (int)str_replace(",","",($tongtiencongStr));
                    $phieu['tongtiendangoctrai'] = (int)str_replace(",","",($tongtiendangoctraiStr));
                    $phieu['type'] = 0;
                    $phieuId = vaInsert('khonguonvao_khonutrangtrave', $phieu);
					try {
                        for($i = 2; $i <= $Totalrow - 1; $i++) {
                            $colIndex = 0;
                            $phieuCt = [];
                            $phieuCt['trangthaixacnhan'] = trim($sheet->getCellByColumnAndRow($colIndex++, $i)->getFormattedValue()) === 'Đã xác nhận' ? 1 : 0;
                            $phieuCt['cuahang'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['noiden'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['nhanvien'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $dateStr = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['dated'] = date('Y-m-d', strtotime(str_replace('/', '-', $dateStr)));
                            $datexacnhanStr = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['datedxacnhan'] = date('Y-m-d', strtotime(str_replace('/', '-', $datexacnhanStr)));
                            $phieuCt['sophieu'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['cuahangtruoc'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['STT'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['ghichu'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['nhacungcap'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $loaivang = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $sqlIdLoaiVang = "select id from $GLOBALS[db_sp].loaivang where name_vn = '$loaivang'";
                            $idloaivang = $GLOBALS["sp"]->getOne($sqlIdLoaiVang);
                            $phieuCt['idloaivang'] = $idloaivang;
                            $phieuCt['loainutrang'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['manutrang'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['macu'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['ten'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['ghichu2'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['gvh'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['cannangvh'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['cannangh'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['cannanghgr'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['cannangv'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $tienhStr = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['tienh'] = (int)str_replace(",","",$tienhStr);
                            $tiencongStr = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $cvspStr =  trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $tiendangoctraiStr = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $tienconghotbanStr = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $thanhtienStr =  trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['tiencong'] = (int)str_replace(",","",$tiencongStr);
                            $phieuCt['cvsp'] = (int)str_replace(",","",$cvspStr);
                            $phieuCt['tiendangoctrai'] = (int)str_replace(",","",$tiendangoctraiStr);
                            $phieuCt['tienconghotban'] = (int)str_replace(",","",$tienconghotbanStr);
                            $phieuCt['thanhtien'] = (int)str_replace(",","",$thanhtienStr);
                            $phieuCt['msm'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['chitiethottam'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['chitiethottamthucte'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['kh'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['catalogue1'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['catalogue2'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $giabanStr = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['giaban'] = (int)str_replace(",","",$giabanStr);
                            $phieuCt['slmon'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['makhuyenmai'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['giatamtinh'] = trim($sheet->getCellByColumnAndRow($colIndex++,$i)->getFormattedValue());
                            $phieuCt['maphieuimport'] = 'IMSPHHTV-23';
                            $phieuCt['phongban'] = $pidm;
                            $phieuCt['midimport'] = $_SESSION['admin_qlsxntjcorg_id'];
                            $phieuCt['datedimport'] = $dateNow;
                            $phieuCt['timeimport'] = $timeNow;
                            $phieuCt['idctnx'] = $phieuId;
                            vaInsert('khonguonvao_khonutrangtravect', $phieuCt);
                        }
                        $GLOBALS["sp"]->CommitTrans();
                    } catch (Exception $e) {
                        $GLOBALS["sp"]->RollbackTrans();
						die($e);
                    }
                } else {
                    $url = $path_url."/sources/Kho-Nu-Trang-Tra-Ve-Import.php?cid=".$_GET['cid'];
				    page_transfer2($url);
                }
                $url = $path_url."/sources/Kho-Nu-Trang-Tra-Ve-Import.php?cid=".$_GET['cid'];
				page_transfer2($url);
            } else {
                $template = "Kho-Nu-Trang-Tra-Ve-Import/import.tpl";
            }
        }
        break;
    case 'dellist':
        if(!checkPermision($idpem,3)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		} else {
            $GLOBALS["sp"]->BeginTrans();
			try{
				$idList=$_POST["iddel"];
                $phieuDeleteWhere = implode(",", $idList);
                $sqlGetPhieuCt = "select id from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where idctnx in ($phieuDeleteWhere)";
                $idPhieuCt = $GLOBALS["sp"]->getCol($sqlGetPhieuCt);
                $phieuCtDeleteWhere = implode(",", $idPhieuCt);
                
                vaDelete('khonguonvao_khonutrangtrave', "id in ($phieuDeleteWhere)");
                vaDelete('khonguonvao_khonutrangtravect', "id in ($phieuCtDeleteWhere)");

				$url = $path_url."/sources/Kho-Nu-Trang-Tra-Ve-Import.php?cid=".$_GET['cid'];
				page_transfer2($url);

				$GLOBALS["sp"]->CommitTrans();
			} 
			catch (Exception $e){
				$GLOBALS["sp"]->RollbackTrans();
				die($errorTransetion);
			}
        }
        break;
    case 'view':
        $idPhieu = $_GET['id'];
        $sql = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where idctnx = $idPhieu";
        $phieuCt = $GLOBALS["sp"]->getAll($sql);
        $smarty->assign("view",$phieuCt);
        $template = "Kho-Nu-Trang-Tra-Ve-Import/view.tpl";
        break;
    default:
        if(!checkPermision($idpem,5)){
            page_permision();
            $page = $path_url."/sources/main.php";
            page_transfer2($page);
        } else {
            $sql = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtrave where phongban = $idpem and typeimport = 0 order by datedimport desc, maphieu asc";
            $sql_sum = "select count(*) from $GLOBALS[db_sp].khonguonvao_khonutrangtrave where phongban = $idpem and typeimport = 0";
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
            if(checkPermision($idpem,8))
				$smarty->assign("checkPer8","true");
            if(checkPermision($idpem,10))
				$smarty->assign("checkPer10","true");
        }
        break;
}
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>