<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);

$sqlvang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
$rsvang = $GLOBALS["sp"]->getAll($sqlvang);
$smarty->assign("typegold",$rsvang);

switch($act){
	case "dellist":
		if(!checkPermision($_GET["cid"],3)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			////////////////Dung Transaction////////////////
			$GLOBALS["sp"]->BeginTrans();
			try{
				$id=$_POST["iddel"];
				for($i=0;$i<count($id);$i++){
					////////////
					$sql = "select * from $GLOBALS[db_sp].`khosanxuat_khovmnthaodu` where id=".$id[$i];
					$rs = $GLOBALS["sp"]->getRow($sql);				
					hachToanHaoDuDelete($rs['idloaivang'], $rs['hao'], $rs['du'], $rs['haochenhlech'], $rs['duchenhlech'], $rs['dated'], 'khosanxuat_khovmnt_sodudauky');		

					$sql="delete from $GLOBALS[db_sp].khosanxuat_khovmnthaodu  where id=".$id[$i];
					$GLOBALS["sp"]->execute($sql);
					
					if(file_exists($path_dir."/".$rs['img_thumb'])) unlink($path_dir."/".$rs['img_thumb']);
					if(file_exists($path_dir."/".$rs['img'])) unlink($path_dir."/".$rs['img']);
					if(file_exists($path_dir."/".$rs['img1'])) unlink($path_dir."/".$rs['img1']);
				}
				$url = "KhoSanXuat-Kho-Vmnt-Hao-Du.php?cid=".$_GET['cid'];
				page_transfer2($url);
				$GLOBALS["sp"]->CommitTrans();
			} 
			catch (Exception $e){
				$GLOBALS["sp"]->RollbackTrans();
				die($errorTransetion);
			}
		}
	break;
	case "edit":
		if(!checkPermision($idpem,2)){
			$page = $path_url;
			page_transfer2($page);
		}
		else{
			//////////////////
			$id = ceil($_GET["id"]);
			$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnthaodu where id=$id";
			$rs = $GLOBALS["sp"]->getRow($sql);
			$smarty->assign("edit",$rs);
			
			$template = "KhoSanXuat-Kho-Vmnt-Hao-Du/edit.tpl";	
		}
	break;
	case "add":
		if(!checkPermision($_GET["cid"],1)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			$rs['dated'] = date("Y-m-d");
			$sqlmpt = "select max(numphieu)+1 from $GLOBALS[db_sp].khosanxuat_khovmnthaodu";
			$rsmpt = $GLOBALS['sp']->getone($sqlmpt);
			if($rsmpt <= 0)
				$rsmpt = 1;	
			$maso = convertMaso($rsmpt);	
			$rs['maphieu'] = 'HD-PXSNKVMNT'.$maso;
			$smarty->assign("edit",$rs);
			$template = "KhoSanXuat-Kho-Vmnt-Hao-Du/edit.tpl";
		}
	break;
	case "addsm":
	case "editsm":
		if(!checkPermision($_GET["cid"],2) && !checkPermision($_GET["cid"],1) ){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			Editsm();
			$url = "KhoSanXuat-Kho-Vmnt-Hao-Du.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
	break;
	default:
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			include_once("search/KhoSanXuatHaoDuSearch.php");
			$template = "KhoSanXuat-Kho-Vmnt-Hao-Du/list.tpl"; ///////// typechuyen 1 chờ nhập, 2 xác nhận đã nhập
			$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnthaodu where cid=$idpem $wh order by idloaivang asc, dated desc, id desc";
			$sql_sum = "select count(id) from $GLOBALS[db_sp].khosanxuat_khovmnthaodu where cid=$idpem $wh";
			$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = $path_url."/sources/KhoSanXuat-Kho-Vmnt-Hao-Du.php?cid=".$_GET['cid'];
			$link_url = "";
			
			if($num_page > 1 )
				$link_url = paginator($num_page,$page,$iSEGSIZE,$url,$strSearch);
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
			if(checkPermision($idpem,1))
				$smarty->assign("checkPer1","true");
			if(checkPermision($idpem,2))
				$smarty->assign("checkPer2","true");
			if(checkPermision($idpem,3))
				$smarty->assign("checkPer3","true");	
			if(checkPermision($idpem,6))
				$smarty->assign("checkPer6","true");
			if(checkPermision($idpem,8))
				$smarty->assign("checkPer8","true");	
			if(checkPermision($idpem,9))
				$smarty->assign("checkPer9","true");
		}
	break;
}
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");

function Editsm()
{
	global $path_url,$path_dir,$idpem, $errorTransetion;
	$arr = array();
	$time = date('H:i:s');
	
	$dated = trim($_POST['dated']);
	if(!empty($dated)){
		$dated = explode('/',$dated);
		$dated = $dated[2].'-'.$dated[1].'-'.$dated[0];
	}
	else{
		$dated =  date("Y-m-d");	
	}
	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
	$arr['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
	$arr['idloaivang'] = $idloaivang = ceil(trim($_POST["idloaivang"]));
	
	$arr['hao'] = $hao = str_replace(",", "", trim($_POST['hao']));
	$arr['du'] = $du = str_replace(",", "", trim($_POST['du']));
	$arr['haochenhlech'] = $haochenhlech = str_replace(",", "", trim($_POST['haochenhlech']));
	$arr['duchenhlech'] = $duchenhlech = str_replace(",", "", trim($_POST['duchenhlech']));
	$arr['ghichu'] = trim($_POST["ghichu"]);

	////////////////Dung Transaction////////////////
	$GLOBALS["sp"]->BeginTrans();
	try{
		/////////////tạo thư mục hình theo tháng đó
		if(( isset($_FILES['img']['name'] ) && $_FILES['img']['size']>0 ) || ( isset($_FILES['img1']['name'] ) && $_FILES['img1']['size']>0 )){
			$day = date("d");
			$moth = date("m");
			$year = date("Y");
			//$numberday = cal_days_in_month(CAL_GREGORIAN, $moth, $year); // lấy tháng đó có bao nhiêu ngày
			$datedFolder = $moth.$year;
			$thumuc = "../upload/khosanxuat/kho-vmnt/".$datedFolder."/";
			$thumucdb = "upload/khosanxuat/kho-vmnt/".$datedFolder."/";
			if(!file_exists($thumuc)){
				creaFolder($thumuc);	
			}	
		}
		if(isset($_FILES['img']['name'] ) && $_FILES['img']['size']>0){
			$img = $_FILES['img']['name'];	
			$start = strpos($img,".");
			$type = substr($img,$start,strlen($img));
			$filename = time().$type;
			$filename = strtolower($filename);
			$filename = RenameFile($filename);
			copy($_FILES['img']['tmp_name'], $thumuc . $filename) ;
			
			$dirpath = $thumuc."/".$filename;
			$dirpathThumb =  $thumuc."thumb_".$filename;
			resize_image('force',$dirpath,$dirpathThumb,50,50);
			
			$arr['img_thumb'] = $thumucdb .'thumb_'. $filename;
			$arr['img'] = $thumucdb . $filename;
		}
		
		if(isset($_FILES['img1']['name'] ) && $_FILES['img1']['size']>0){
			$img = $_FILES['img1']['name'];	
			$start = strpos($img,".");
			$type = substr($img,$start,strlen($img));
			$filename = time().$type;
			$filename = strtolower($filename);
			$filename = RenameFile($filename);
			copy($_FILES['img1']['tmp_name'], $thumuc . 'img1_'.$filename) ;
			$arr['img1'] = $thumucdb . 'img1_' . $filename;
		}
		
		if ($act=="addsm")
		{
			$sqlmpt = "select max(numphieu)+1 from $GLOBALS[db_sp].khosanxuat_khovmnthaodu";
			$rsmpt = $GLOBALS['sp']->getone($sqlmpt);
			if($rsmpt <= 0)
				$rsmpt = 1;	
			$maso = convertMaso($rsmpt);
			$arr['numphieu'] = $maso;
			$arr['maphieu'] = 'HD-PXSNKVMNT'.$maso;
			
			$arr['cid'] = $_GET["cid"];
			$arr['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
			$arr['dated'] = $dated;
			$arr['time'] = $time;
			$id = vaInsert('khosanxuat_khovmnthaodu',$arr);
			hachToanHaoDuAdd($idloaivang, $hao, $du, $haochenhlech, $duchenhlech, $dated, 'khosanxuat_khovmnt_sodudauky');
		}
		else{
			$id = ceil(trim($_POST['id']));
			////////hạch toán hao du này, chỉ cộng dồn hao dư trong tháng lại thôi, kg có cộng tồn từ tháng trên xuống tháng dưới
			$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnthaodu where id=$id";
			$rs = $GLOBALS["sp"]->getRow($sql);
			if (isset($arr['img'])){
				if($arr['img'] != $rs['img']){
					if(file_exists($path_dir."/".$rs['img'])){
						unlink($path_dir."/".$rs['img']);
					    unlink($path_dir."/".$rs['img_thumb']);
					}
				}
			}
			if (isset($arr['img1'])){
				if($arr['img1'] != $rs['img1']){
					if(file_exists($path_dir."/".$rs['img1'])) unlink($path_dir."/".$rs['img1']);
				}
			}
			////Xóa Img khi chon Xoa/////
			if($_POST['del_img']=='del_img'){
				unlink($path_dir."/".$rs['img_thumb']);
				unlink($path_dir."/".$rs['img']);
				unlink($path_dir."/".$rs['img1']);
				
				$arr['img_thumb'] = "";
				$arr['img'] = "";
				$arr['img1'] = "";
			}
			if($_POST['del_img1']=='del_img1'){
				unlink($path_dir."/".$rs['img1']);
				$arr['img1'] = "";
			}
			
			if(($idloaivang != $rs['idloaivang']) || ($hao != $rs['hao']) || ($du != $rs['du']) || ($haochenhlech != $rs['haochenhlech']) || ($duchenhlech != $rs['duchenhlech']) ){
				hachToanHaoDuEdit($idloaivang, $hao, $du, $haochenhlech, $duchenhlech,$rs['idloaivang'], $rs['hao'], $rs['du'], $rs['haochenhlech'], $rs['duchenhlech'], $rs['dated'] ,'khosanxuat_khovmnt_sodudauky');		
			}
			vaUpdate('khosanxuat_khovmnthaodu',$arr,' id='.$id);		
		}
		$GLOBALS["sp"]->CommitTrans();
	} 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		die($errorTransetion);
	}
}
?>