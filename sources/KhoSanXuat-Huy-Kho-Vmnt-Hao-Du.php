<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);

$sqlvang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
$rsvang = $GLOBALS["sp"]->getAll($sqlvang);
$smarty->assign("typegold",$rsvang);

switch($act) {
    case 'add':
            $rs['dated'] = date("Y-m-d");
			$sqlmpt = "select max(numphieu)+1 from $GLOBALS[db_sp].khosanxuat_khovmnthaodu";
			$rsmpt = $GLOBALS['sp']->getone($sqlmpt);
			if($rsmpt <= 0)
				$rsmpt = 1;	
			$maso = convertMaso($rsmpt);	
			$rs['maphieu'] = 'HD-PXSNKVMNT'.$maso;
			$smarty->assign("edit",$rs);
			$template = "KhoSanXuat-Huy-Kho-Vmnt-Hao-Du/edit.tpl";
        break;
    case 'addsm': case 'editsm':
        edit();
        $url = "KhoSanXuat-Huy-Kho-Vmnt-Hao-Du.php?cid=".$_GET['cid'];
		page_transfer2($url);
        break;
    default:
        include_once("search/KhoSanXuatHaoDuSearch.php");
        $template = "KhoSanXuat-Huy-Kho-Vmnt-Hao-Du/list.tpl";
        $sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnthaodu where cid = $idpem $wh order by idloaivang asc, dated desc, id desc";
        $rs = $GLOBALS["sp"]->getAll($sql);
        $smarty->assign("view",$rs);
        break;
}
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");

function edit () {
    global $errorTransetion;
    $dateNow = date('Y-m-d');
    $timeNow = date('H-i-s');
    $hao = $_POST['hao'];
    $du = $_POST['du'];
    $haochenhlech = $_POST['haochenhlech'];
    $duchenhlech = $_POST['duchenhlech'];
    $idloaivang = $_POST['idloaivang'];
    $GLOBALS["sp"]->BeginTrans();
	try{
        $phieuHaoDu = [];
        $phieuHaoDu['idloaivang'] = $_POST['idloaivang'];
        $phieuHaoDu['hao'] = $hao;
        $phieuHaoDu['du'] = $du;
        $phieuHaoDu['haochenhlech'] = $_POST['haochenhlech'];
        $phieuHaoDu['duchenhlech'] = $_POST['duchenhlech'];
        $phieuHaoDu['ghichu'] = $_POST['ghichu'];

        if ($_GET['act'] == 'addsm') {
            $sqlMaxNumphieu = "select MAX(numphieu) + 1 from $GLOBALS[db_sp].khosanxuat_khovmnthaodu";
            $maxNumPhieu = $GLOBALS["sp"]->getOne($sqlMaxNumphieu);
            if ($maxNumPhieu <= 0) {
                $maxNumPhieu = 1;
            }
            $numPhieu = convertMaso($maxNumPhieu);
            $phieuHaoDu['numphieu'] = $maxNumPhieu;
            $phieuHaoDu['maphieu'] = 'HD-PXSNKVMNT'.$numPhieu;
            $phieuHaoDu['cid'] = $_GET['cid'];
            $phieuHaoDu['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
            $phieuHaoDu['dated'] = $dateNow;
			$phieuHaoDu['time'] = $timeNow;
            //dd($phieuHaoDu);
            vaInsert('khosanxuat_khovmnthaodu', $phieuHaoDu);
            giahuy_hachToanHaoDuAdd($idloaivang, $hao, $du, $haochenhlech, $duchenhlech, '2023-11-05', 'khosanxuat_khovmnt_sodudauky');
        } else {
            $idPhieu = $_POST['id'];
            $sqlPhieu = "select * from $GLOBALS[db_sp].khosanxuat_khovmnthaodu where id = $idPhieu";
            $phieu = $GLOBALS["sp"]->getRow($sqlPhieu);

            if (($idloaivang != $phieu['idloaivang']) || ($hao != $phieu['hao']) || ($du != $phieu['du']) || ($haochenhlech != $phieu['haochenhlech']) || ($duchenhlech != $phieu['duchenhlech'])) {
                giahuy_hachToanHaoDuEdit($idloaivang, $hao, $du, $haochenhlech,$duchenhlech, $phieu['idloaivang'], $phieu['hao'], $phieu['du'], $phieu['haochenhlech'], $phieu['duchenhlech'], $phieu['dated'], 'khosanxuat_khovmnt_sodudauky');
            }
        }
    } 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		die($e);
	}
}

?>