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
            $dated = date('d-m-Y');
            $sqlMaxNumphieu = "select max(numphieu) + 1 from $GLOBALS[db_sp].khonguonvao_khonutrangtrave where type = 2";
            $maxNumPhieu = $GLOBALS['sp']->getOne($sqlMaxNumphieu);
            if ($maxNumPhieu <= 0) {
                $maxNumPhieu = 1;
            }
            $numphieu = convertMaso($maxNumPhieu);
            $maphieu = 'PXKDCNTV'.$numphieu;
            $sqlGetSophieu = "select DISTINCT sophieu from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where type = 1";
            $sophieu = $GLOBALS['sp']->getCol($sqlGetSophieu); 
            $sqlLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1";
            $typegold = $GLOBALS['sp']->getAll($sqlLoaiVang);
            $viewedit = [
                'dated'=>$dated,
                'maphieu' => $maphieu
            ];
            $smarty->assign("sophieu", $sophieu);
            $smarty->assign("typegold", $typegold);
            $smarty->assign("viewedit", $viewedit);
            $template = "Kho-Nu-Trang-Tra-Ve-Xuat-Kho/edit.tpl";
        }
        break;
    case 'edit':
        if (!checkPermision($_GET["cid"],2) ) {
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		} else {
            $idPhieu = $_GET['id'];
            $sqlPhieu = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtrave where id=$idPhieu";
            $phieu = $GLOBALS['sp']->getRow($sqlPhieu);

            $phieu['dated'] = date('d-m-Y',strtotime($phieu['dated']));
            $sqlLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active = 1";
            $typegold = $GLOBALS['sp']->getAll($sqlLoaiVang);
            $sqlGetSophieu = "select DISTINCT sophieu from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where type = 1";
            $maphieutrakho = $GLOBALS['sp']->getCol($sqlGetSophieu); 

            $sqlPhieuCt = "Select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where sophieu = '".$phieu['maphieutrakho']."' and type = 2 and trangthai = 0 and idctnx in (0,".$phieu['id'].")";
            $phieuCt = $GLOBALS['sp']->getAll($sqlPhieuCt); 
            
            $smarty->assign("sophieu", $maphieutrakho);
            $smarty->assign("typegold", $typegold);
            $smarty->assign("phieuXuat", $phieu);
            $smarty->assign("phieuCt", $phieuCt);
            $template = "Kho-Nu-Trang-Tra-Ve-Xuat-Kho/edit.tpl";
        }
        break;
    case 'loaddulieutrakho':
        try {
            $maphieutrakho = $_POST['sophieu'] ? $_POST['sophieu'] : '';
            $idPhieuXuat = $_POST['idPhieu'] ? $_POST['idPhieu'] : '';
            $sqlPhieu = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where sophieu = '$maphieutrakho' and type = 2 and trangthai = 0 and idctnx in (0,$idPhieuXuat)";
            $phieu = $GLOBALS['sp']->getAll($sqlPhieu);
            $html = null;
            $tongCannangVH = 0;
            $tongCannangV = 0;
            $tongCannangH = 0;
            $tongTienCong = 0;
            foreach($phieu as $data) {
                $tongCannangVH += round($data['cannangvh'], 3);
                $tongCannangV += round($data['cannangv'], 3);
                $tongCannangH += round($data['cannangh'], 3);
                $tongTienCong += round($data['tiencong'], 3);
                $isChecked = (int)$data['idctnx'] !== 0 ? 'checked' : '';
                $html .= "<tr>
                            <td>
                                <input class='check-phieu' type='checkbox' id='check".$data['id']."' name='idPhieuCt[]' value='".$data['id']."' cannangvh='".number_format($data['cannangvh'], 3, '.', ',')."' cannangh='".number_format($data['cannangh'], 3, '.', ',')."' cannangv='".number_format($data['cannangv'], 3, '.', ',')."' onchange='getCell(this)' $isChecked/>
                            </td>
                            <td>
                                ".((int)$data['trangthaixacnhan'] === 1 ? 'Đã xác nhận' : 'Chưa xác nhận')."
                            </td>
                            <td>
                                ".$data['cuahang']."
                            </td>
                            <td>
                                ".$data['noiden']."
                            </td>
                            <td>
                                ".$data['nhanvien']."
                            </td>
                            <td>
                                ".$data['dated']."
                            </td>
                            <td>
                                ".$data['datedxacnhan']."
                            </td>
                            <td>
                                ".$data['sophieu']."
                            </td>
                            <td>
                                ".$data['cuahangtruoc']."
                            </td>
                            <td>
                                ".$data['STT']."
                            </td>
                            <td>
                                ".$data['ghichu']."
                            </td>
                            <td>
                                ".$data['nhacungcap']."
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                ".$data['loainutrang']."
                            </td>
                            <td>
                                ".$data['manutrang']."
                            </td>
                            <td>
                                ".$data['macu']."
                            </td>
                            <td>
                                ".$data['ten']."
                            </td>
                            <td>
                                ".$data['ghichu2']."
                            </td>
                            <td>
                                ".$data['gvh']."
                            </td>
                            <td id='cannangvh".$data['id']."'>
                                ".number_format($data['cannangvh'], 3, '.', ',')."
                            </td>
                            <td>
                                ".number_format($data['cannangh'], 3, '.', ',')."
                            </td>
                            <td>
                                ".number_format($data['cannanghgr'], 3, '.', ',')."
                            </td>
                            <td>
                                ".number_format($data['cannangv'], 3, '.', ',')."
                            </td>
                            <td>
                                ".number_format($data['tienh'])."
                            </td>
                            <td>
                                ".number_format($data['tiencong'])."
                            </td>
                            <td>
                                ".$data['cvsp']."
                            </td>
                            <td>
                                ".number_format($data['tiendangoctrai'])."
                            </td>
                            <td>
                                ".number_format($data['tienconghotban'])."
                            </td>
                            <td>
                                ".number_format($data['thanhtien'])."
                            </td>
                            <td>
                                ".$data['msm']."
                            </td>
                            <td>
                                ".$data['chitiethottam']."
                            </td>
                            <td>
                                ".$data['chitiethottamthucte']."
                            </td>
                            <td>
                                ".$data['kh']."
                            </td>
                            <td>
                                ".$data['catalogue1']."
                            </td>
                            <td>
                                ".$data['catalogue2']."
                            </td>
                            <td>
                                ".number_format($data['giaban'])."
                            </td>
                            <td>
                                ".$data['slmon']."
                            </td>
                            <td>
                                ".$data['makhuyenmai']."
                            </td>
                            <td>
                                ".number_format($data['giatamtinh'])."
                            </td>
                        </tr>";
            }
            $tong = [
                'tongCannangVH' => number_format($tongCannangVH,3, '.', ','), 
                'tongCannangV' => number_format($tongCannangV,3, '.', ','),
                'tongCannangH' => number_format($tongCannangH,3, '.', ','),
                'tongTienCong' => number_format($tongTienCong)
            ];

            $error = 'success';
        } catch (Exception $e) {
            $error = $e;
        }
    
        die(json_encode(array('status'=>$error,
                            'html'=>$html, 
                            'tong'=>$tong
                            )));
        break;
    case 'addsm':
        if(!checkPermision($_GET["cid"],2) && !checkPermision($_GET["cid"],1) ){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		} else {
            Edit();
            $url = "Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php?cid=".$_GET['cid'];
			page_transfer2($url);
        }
        break;
    default:
        if (!checkPermision($idpem,5)) {
            page_permision();
            $page = $path_url."/sources/main.php";
            page_transfer2($page);
        } else {
            $sqlPhieuXuat = "select * from $GLOBALS[db_sp].khonguonvao_khonutrangtrave where type = 2 and trangthai = 0" ;
            $phieuXuat = $GLOBALS['sp']->getAll($sqlPhieuXuat);
            $template = "Kho-Nu-Trang-Tra-Ve-Xuat-Kho/list.tpl";
            $smarty->assign("view", $phieuXuat);
            if(checkPermision($idpem,1))
                $smarty->assign("checkPer1","true");
            if(checkPermision($idpem,2))
				$smarty->assign("checkPer2","true");
            if(checkPermision($idpem,3))
                $smarty->assign("checkPer3","true");
            if(checkPermision($idpem,7))
                $smarty->assign("checkPer3","true");
        }
        break;
}
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");

function Edit () {
    global $act, $idpem, $errorTransetion;
    $dateNow = date('Y-m-d');
    $timeNow = date('H:i:s');
    $GLOBALS["sp"]->BeginTrans();
	try{
        $phieuXuat = [];
        $idPhieuCtSelected = $_POST['idPhieuCt'];
        $phieuXuat['slmon'] = count($idPhieuCtSelected);
        $phieuXuat['maphieutrakho'] = $_POST['sophieu'];
        $phieuXuat['idloaivang'] = $_POST['idloaivang'];
        $phieuXuat['cannangvh'] = $_POST['cannangvh'];
        $phieuXuat['cannangh'] = $_POST['cannangh'];
        $phieuXuat['cannangv'] = $_POST['cannangv'];
        $phieuXuat['ghichu'] = $_POST['ghichu'];
        $phieuXuat['type'] = 2;
        if ($act === 'addsm') {
            $phieuXuat['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
            $phieuXuat['phongban'] = $idpem;
            $sqlMaxNumphieu = "select max(numphieu) + 1 from $GLOBALS[db_sp].khonguonvao_khonutrangtrave where type = 2";
            $maxNumPhieu = $GLOBALS['sp']->getOne($sqlMaxNumphieu);
            if ($maxNumPhieu <= 0) {
                $maxNumPhieu = 1;
            }
            $numphieu = convertMaso($maxNumPhieu);
            $maphieu = 'PXKDCNTV'.$numphieu;
            $phieuXuat['maphieu'] = $maphieu;
            $phieuXuat['numphieu'] = $numphieu;
            $phieuXuat['dated'] = $dateNow;
            $phieuXuat['time'] = $timeNow;
            $idPhieuXuat = vaInsert("khonguonvao_khonutrangtrave", $phieuXuat);
        }
        foreach($idPhieuCtSelected as $idPhieu) {
            $phieuXuatCtUpdate = [];
            $phieuXuatCtUpdate['idctnx'] = $idPhieuXuat;
            vaUpdate('khonguonvao_khonutrangtravect', $phieuXuatCtUpdate, "id = $idPhieu");
        }
        $GLOBALS["sp"]->CommitTrans();
    } 
    catch (Exception $e){
        $GLOBALS["sp"]->RollbackTrans();
        die($errorTransetion);
    }
}
?>