<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);
/////////load danh mục kho anh 9
$nhomdanhmuc = getTableRow('categories',' and id=70 and active=1');
$smarty->assign("nhomdanhmuc",$nhomdanhmuc);

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
			$id=$_POST["iddel"];
			////////////////Dung Transaction////////////////
			$GLOBALS["sp"]->BeginTrans();
			try{
				for($i=0;$i<count($id);$i++){
					$sql = "select * from $GLOBALS[db_sp].`khonguonvao_khoachinct` where id=".$id[$i];
					$rs = $GLOBALS["sp"]->getRow($sql);	

					if($rs['typevkc'] == 1){//vàng 
						deleteHachToanVang($id[$i], $rs['idctnx'], $rs['idloaivang'], 'khonguonvao_khoachin');		
					}
					else{
						deleteHachToanKimCuong($id[$i], $rs['idctnx'], $rs['idkimcuong'], 'khonguonvao_khoachin');	
					}
					
					$sqldel = "delete from $GLOBALS[db_sp].khonguonvao_khoachinct  where id=".$id[$i];
					$GLOBALS["sp"]->execute($sqldel);
					
					$sqldel = "delete from $GLOBALS[db_sp].khonguonvao_khoachinct  where id=".$rs['idct'];
					$GLOBALS["sp"]->execute($sqldel);
					
				}
				
				$GLOBALS["sp"]->CommitTrans();
			}
			catch (Exception $e){
				$GLOBALS["sp"]->RollbackTrans();
				die($errorTransetion);
			}
			$url = "Kho-A9-Xuat-Kho.php?cid=".$_GET['cid'];
			page_transfer2($url);
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
			$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where id=$id";
			$rs = $GLOBALS["sp"]->getRow($sql);
			$smarty->assign("edit",$rs);
			if($rs['typevkc']==1){////load vàng
				$template = "Kho-A9-Xuat-Kho/editvang.tpl";	
			}
			else{
				$template = "Kho-A9-Xuat-Kho/editkimcuong.tpl";	
			}
		}
	break;
	case "editsmVang":
		if(!checkPermision($_GET["cid"],2)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			EditsmVang();
			$url = "Kho-A9-Xuat-Kho.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
	break;
	case "editsmKimcuong":
		if(!checkPermision($_GET["cid"],2)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			EditsmKimCuong();
			$url = "Kho-A9-Xuat-Kho.php?cid=".$_GET['cid'];
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
			if($_COOKIE["typeVangKimCuong"] == 'kimcuong'){
				include_once("search/KhoNguonVaoXuatKhoKimCuongSearch.php");
				$wh.=' and typevkc = 2 ';
				$template = "Kho-A9-Xuat-Kho/listkimcuong.tpl";
			}
			else{
				include_once("search/KhoNguonVaoXuatKhoVangSearch.php");
				$wh.=' and typevkc = 1 ';
				$template = "Kho-A9-Xuat-Kho/listvang.tpl";
			}
			$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and trangthai=0 $wh order by numphieu asc, id desc";
			$sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and trangthai=0 $wh";
			$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = $path_url."/sources/Kho-A9-Xuat-Kho.php?cid=".$_GET['cid'];
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
			if(checkPermision($idpem,2))
				$smarty->assign("checkPer2","true");
			if(checkPermision($idpem,3))
				$smarty->assign("checkPer3","true");
			if(checkPermision($idpem,6))
				$smarty->assign("checkPer6","true");
			if(checkPermision($idpem,7))
				$smarty->assign("checkPer7","true");	
		}
	break;
}
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
function EditsmVang()
{
	global $path_url,$path_dir,$idpem, $errorTransetion;
	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
	$id = ceil(trim($_POST["id"]));
	$idct = ceil(trim($_POST["idct"]));
	
	unset($arrvangxuatkho);
	unset($arrvangnhapkho);
	$arrvangxuatkho = $arrvangnhapkho = array();
	
	$arrvangxuatkho['midedit'] = $arrvangnhapkho['midedit'] = $_SESSION['admin_qlsxntjcorg_id'];
	$arrvangxuatkho['chonphongbanin'] = ceil(trim($_POST["chonphongbanin"]));
	
	/*
	
	//Update vàng
	$arrvangxuatkho['nhomnguyenlieuvang'] = $arrvangnhapkho['nhomnguyenlieuvang'] = striptags(trim($_POST["nhomnguyenlieuvang"]));
	$arrvangxuatkho['tennguyenlieuvang'] = $arrvangnhapkho['tennguyenlieuvang'] = striptags(trim($_POST["tennguyenlieuvang"]));
	$loaivang = $arrvangxuatkho['idloaivang'] = $arrvangnhapkho['idloaivang'] = striptags(trim($_POST["idloaivang"]));
	$cannangvh = $arrvangxuatkho['cannangvh'] = $arrvangnhapkho['cannangvh'] =  str_replace(",", "", trim($_POST["cannangvh"]));
	$cannangh = $arrvangxuatkho['cannangh'] = $arrvangnhapkho['cannangh'] = str_replace(",", "", trim($_POST["cannangh"]));
	$arrvangxuatkho['cannangv'] = $arrvangnhapkho['cannangv'] = $cannangvh - $cannangh;
	$arrvangxuatkho['tuoivang'] = $arrvangnhapkho['tuoivang'] = str_replace(",", "", trim($_POST["tuoivang"]));
	$arrvangxuatkho['tienmatvang'] = $arrvangnhapkho['tienmatvang'] = striptags(trim($_POST["tienmatvang"]));
	*/
	$arrvangxuatkho['ghichuvang'] = $arrvangxuatkho['ghichueditvang'] = $arrvangnhapkho['ghichueditvang'] = $arrvangnhapkho['ghichuvang'] = striptags(trim($_POST["ghichueditvang"]));
	
	//die('xxx:'.$arrvangxuatkho['chonphongbanin']);
	////////////////Dung Transaction////////////////
	$GLOBALS["sp"]->BeginTrans();
	try{
		////////load chi tiết vang hiện tại
		/*
		$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where id=$id";
		$rs = $GLOBALS["sp"]->getRow($sql);
		if(($loaivang != $rs['idloaivang']) || ($cannangvh != $rs['cannangvh']) || ($cannangh != $rs['cannangh']) ){
			editHachToanVang($id, $rs['idctnx'], $rs['idloaivang'], $rs['cannangvh'], $rs['cannangh'], $loaivang, $cannangvh, $cannangh, 'khonguonvao_khoachin');		
		}
		*/
		vaUpdate('khonguonvao_khoachinct',$arrvangxuatkho,' id='.$id);
		vaUpdate('khonguonvao_khoachinct',$arrvangnhapkho,' id='.$idct);
		$GLOBALS["sp"]->CommitTrans();
	} 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		die($errorTransetion);
	}	
}

function EditsmKimCuong()
{
	global $path_url,$path_dir,$idpem, $errorTransetion;
	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
	$id = ceil(trim($_POST["id"]));
	$idct = ceil(trim($_POST["idct"]));
	
	unset($arrvangxuatkho);
	unset($arrvangnhapkho);
	$arrvangxuatkho = $arrvangnhapkho = array();
	
	$arrvangxuatkho['midedit'] = $arrvangnhapkho['midedit'] = $_SESSION['admin_qlsxntjcorg_id'];
	/*	
	//Update kim cuong
	$arrvangxuatkho['nhomnguyenlieukimcuong'] = $arrvangnhapkho['nhomnguyenlieukimcuong'] = striptags(trim($_POST["nhomnguyenlieukimcuong"]));
	$arrvangxuatkho['tennguyenlieukimcuong'] = $arrvangnhapkho['tennguyenlieukimcuong'] = striptags(trim($_POST["tennguyenlieukimcuong"]));
	$idkimcuong = $arrvangxuatkho['idkimcuong'] = $arrvangnhapkho['idkimcuong'] = striptags(trim($_POST["idkimcuong"]));;
	$arrvangxuatkho['codegdpnj'] = $arrvangnhapkho['codegdpnj'] = striptags(trim($_POST["codegdpnj"]));
	$arrvangxuatkho['codecgta'] = $arrvangnhapkho['codecgta'] = striptags(trim($_POST["codecgta"]));
	$arrvangxuatkho['kichthuoc'] = $arrvangnhapkho['kichthuoc'] = striptags(trim($_POST["kichthuoc"]));
	$arrvangxuatkho['trongluonghot'] = $arrvangnhapkho['trongluonghot'] = striptags(trim($_POST["trongluonghot"]));
	$arrvangxuatkho['dotinhkhiet'] = $arrvangnhapkho['dotinhkhiet'] = striptags(trim($_POST["dotinhkhiet"]));
	
	$arrvangxuatkho['capdomau'] = $arrvangnhapkho['capdomau'] = striptags(trim($_POST["capdomau"]));
	$arrvangxuatkho['domaibong'] = $arrvangnhapkho['domaibong'] = striptags(trim($_POST["domaibong"]));
	$arrvangxuatkho['kichthuocban'] = $arrvangnhapkho['kichthuocban'] = striptags(trim($_POST["kichthuocban"]));
	$arrvangxuatkho['tienmatkimcuong'] = $arrvangnhapkho['tienmatkimcuong'] = striptags(trim($_POST["tienmatkimcuong"]));
	$dongiaban = $arrvangxuatkho['dongiaban'] = $arrvangnhapkho['dongiaban'] = str_replace(",", "", trim($_POST["dongiaban"])); 
	*/
	$arrvangxuatkho['ghichukimcuong'] = $arrvangxuatkho['ghichueditkimcuong'] = $arrvangnhapkho['ghichueditkimcuong'] =  $arrvangnhapkho['ghichukimcuong'] = striptags(trim($_POST["ghichueditkimcuong"]));
	
	////////////////Dung Transaction////////////////
	$GLOBALS["sp"]->BeginTrans();
	try{
		/*
		////////load chi tiết vang hiện tại
		$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where id=$id";
		$rs = $GLOBALS["sp"]->getRow($sql);
		if($idkimcuong != $rs['idkimcuong']){
			editHachToanKimCuong($id, $rs['idctnx'], $rs['idkimcuong'], $rs['dongiaban'], $idkimcuong, $dongiaban, 'khonguonvao_khoachin');		
		}
		*/
		vaUpdate('khonguonvao_khoachinct',$arrvangxuatkho,' id='.$id);
		vaUpdate('khonguonvao_khoachinct',$arrvangnhapkho,' id='.$idct);
		
		$GLOBALS["sp"]->CommitTrans();
	} 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		die($errorTransetion);
	}	
}
?>