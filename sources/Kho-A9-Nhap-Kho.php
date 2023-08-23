<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);
/////////load danh mục kho anh 9
$nhomdanhmuc = getTableRow('categories',' and id=70 and active=1');
$smarty->assign("nhomdanhmuc",$nhomdanhmuc);

switch($act){
	case "edit":
		if(!checkPermision($idpem,2)){
			$page = $path_url;
			page_transfer2($page);
		}
		else{
			//////////////////
			$id = ceil($_GET["id"]);
			$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachin where id=$id";
			$rs = $GLOBALS["sp"]->getRow($sql);
			$smarty->assign("edit",$rs);
			
			/////////////load chi tiet vang//////// type_vang_kimcuong: 1 vàng; 2 kim cươngng
			$sqlcthv = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where idctnx=".$rs['id']." and type=1 and typevkc=1 order by id asc ";
			$rscthv = $GLOBALS["sp"]->getAll($sqlcthv);
			$smarty->assign("viewtcctvang",$rscthv);
			$smarty->assign("coutndongvang",ceil(count($rscthv))+1);
			
			/////////////load chi tiet kim cương//////// type_vang_kimcuong: 1 vàng; 2 kim cươngng
			$sqlcthkc = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where idctnx=".$rs['id']." and type=1 and typevkc=2 order by id asc ";
			$rscthkc = $GLOBALS["sp"]->getAll($sqlcthkc);
			$smarty->assign("viewtcctkimcuong",$rscthkc);
			$smarty->assign("coutndongkimcuong",ceil(count($rscthkc))+1);
			
			$template = "Kho-A9-Nhap-Kho/edit.tpl";
		}
	break;
	
	case "view":
		$id = ceil($_GET["id"]);
		$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachin where id=$id";
		$rs = $GLOBALS["sp"]->getRow($sql);
		$smarty->assign("edit",$rs);
		
		/////////////load chi tiet vang//////// type_vang_kimcuong: 1 vàng; 2 kim cươngng
		$sqlcthv = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where idctnx=".$rs['id']." and type=1 and typevkc=1 order by id asc ";
		$rscthv = $GLOBALS["sp"]->getAll($sqlcthv);
		$smarty->assign("viewtcctvang",$rscthv);
		
		/////////////load chi tiet kim cương//////// type_vang_kimcuong: 1 vàng; 2 kim cươngng
		$sqlcthkc = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where idctnx=".$rs['id']." and type=1 and typevkc=2 order by id asc ";
		$rscthkc = $GLOBALS["sp"]->getAll($sqlcthkc);
		$smarty->assign("viewtcctkimcuong",$rscthkc);
		$template = "Kho-A9-Nhap-Kho/view.tpl";
	break;
	
	case "add":
		if(!checkPermision($_GET["cid"],1)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			$rs['datedchungtu'] = $rs['datedhachtoan'] = date("Y-m-d");;
			$smarty->assign("edit",$rs);

			$sqlmpt = "select max(numphieu)+1 from $GLOBALS[db_sp].khonguonvao_khoachin";
			$rsmpt = $GLOBALS['sp']->getone($sqlmpt);
			if($rsmpt <= 0)
				$rsmpt = 1;	
			$maso = convertMaso($rsmpt);	
			$rs['maphieu'] = 'PNKACHIN'.$maso;
			$smarty->assign("edit",$rs);
			$template = "Kho-A9-Nhap-Kho/edit.tpl";
		}
	break;
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
					$sqlstmt="select * from $GLOBALS[db_sp].`khonguonvao_khoachin` where id=".$id[$i];
					$r = $GLOBALS["sp"]->getRow($sqlstmt);
					if(file_exists($path_dir."/".$r['fileexcel'])) unlink($path_dir."/".$r['fileexcel']);				
					
					$sql="delete from $GLOBALS[db_sp].khonguonvao_khoachinct  where idctnx=".$id[$i];
					$GLOBALS["sp"]->execute($sql);
					
					$sql="delete from $GLOBALS[db_sp].khonguonvao_khoachin  where id=".$id[$i];
					$GLOBALS["sp"]->execute($sql);
				}
				$url = "Kho-A9-Nhap-Kho.php?cid=".$_GET['cid'];
				page_transfer2($url);
				$GLOBALS["sp"]->CommitTrans();
			} 
			catch (Exception $e){
				$GLOBALS["sp"]->RollbackTrans();
				die($errorTransetion);
			}		
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
			$url = "Kho-A9-Nhap-Kho.php?cid=".$_GET['cid'];
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
			include_once("search/KhoNguonVaoSearch.php");
			$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachin where type=1 and phongban=$idpem $wh order by datedchungtu desc, maphieu asc";
			$sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachin where type=1 and phongban=$idpem $wh";
			$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = $path_url."/sources/Kho-A9-Nhap-Kho.php?cid=".$_GET['cid'];
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

			$template = "Kho-A9-Nhap-Kho/list.tpl";
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
		}
	break;
}
$smarty->assign("tabmenu",8);
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");

function Editsm()
{
	global $path_url,$path_dir,$idpem, $errorTransetion;
	$datenow =  date("Y-m-d");
	$timnow = date('H:i:s');
	
	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
	$arr['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
	$arr['nguoilapphieu'] = striptags(trim($_POST["nguoilapphieu"]));
	$arr['donvilapphieu'] = striptags(trim($_POST["donvilapphieu"]));
	$arr['nguoiduyetphieu'] = striptags(trim($_POST["nguoiduyetphieu"]));
	$arr['donviduyetphieu'] = striptags(trim($_POST["donviduyetphieu"]));
	$arr['lydo'] = striptags(trim($_POST["lydo"]));
	$datedchungtu = explode('/',trim($_POST["datedchungtu"]));
	$arrcth['dated'] = $arr['datedchungtu'] = $datedchungtu[2].'-'.$datedchungtu[1].'-'.$datedchungtu[0];
	$datedhachtoan = explode('/',trim($_POST["datedhachtoan"]));
	$arr['datedhachtoan'] = $datedhachtoan[2].'-'.$datedhachtoan[1].'-'.$datedhachtoan[0];
	$arr['type'] = 1; ////type 1.nhập; 2.xuat (Có thay đổi);  
	if(isset($_FILES['fileexcel']['name'] ) && $_FILES['fileexcel']['size']>0){
		$img = $_FILES['fileexcel']['name'];	
		$start = strpos($img,".");
		$type = substr($img,$start,strlen($img));
		$filename = 'file-kho-NL-chi-nhanh-'.time().$type;
		$filename = strtolower($filename);
		$filename = RenameFile($filename);
		copy($_FILES['fileexcel']['tmp_name'], "../upload/kho-nguyen-lieu-chi-nhanh/" . $filename) ;
		$arr['fileexcel'] = "upload/kho-nguyen-lieu-chi-nhanh/" . $filename;
	}
	////////////////Dung Transaction////////////////
	$GLOBALS["sp"]->BeginTrans();
	try{
		if ($act=="addsm")
		{
			$sqlmpt = "select max(numphieu)+1 from $GLOBALS[db_sp].khonguonvao_khoachin";
			$rsmpt = $GLOBALS['sp']->getone($sqlmpt);
			if($rsmpt <= 0)
				$rsmpt = 1;	
			$maso = convertMaso($rsmpt);	
			$arr['phongban'] = $idpem;
			$arr['numphieu'] = $maso;
			$arr['maphieu'] = 'PNKACHIN'.$maso;
			$idctnx = vaInsert('khonguonvao_khoachin',$arr);
		}
		else
		{
			$idctnx = $id = $_POST['id'];
			/* xoa file */
			$sqlstmt="select * from $GLOBALS[db_sp].`khonguonvao_khoachin` where id=$id";
			$r = $GLOBALS["sp"]->getRow($sqlstmt);
			
			if (isset($arr['fileexcel'])){
				if($arr['fileexcel'] != $r['fileexcel'])
					if(file_exists($path_dir."/".$r['fileexcel'])) unlink($path_dir."/".$r['fileexcel']);
			}	
			$arr['maphieu'] = striptags(trim($_POST["maphieu"]));
			vaUpdate('khonguonvao_khoachin',$arr,' id='.$id);	
		}
		//////////////////thêm vào bảng khonguonvao_khoachinct/////
		$maphieu = striptags(trim($_POST["maphieu"]));
		
		$idctnxvangct = $_POST["idctnxvang"]; // id của datagirld khonguonvao_khoachinct
		$nhomdm = ceil($_POST["nhomdm"]);
		$nhomnguyenlieuvangct = $_POST["nhomnguyenlieuvang"];
		$tennguyenlieuvangct = $_POST["tennguyenlieuvang"];
		$idloaivangct = $_POST["idloaivang"];
		$cannangvhct = $_POST["cannangvh"];
		
		$cannanghct = $_POST["cannangh"];
		$cannangvct = $_POST["cannangv"];
		$tuoivangct = $_POST["tuoivang"];
		$tienmatvangct = $_POST["tienmatvang"];
		$ghichuvangct = $_POST["ghichuvang"];
		
		//Insert vàng
		$i=0;
		for($i=0;$i<=count($idctnxvangct);$i++){
			$arrcth = array();
			$arrcth['maphieu'] = $maphieu;		
			$idctnxvang = $idctnxvangct[$i];
			$nhomnguyenlieuvang = trim($nhomnguyenlieuvangct[$i]);
			$tennguyenlieuvang = trim($tennguyenlieuvangct[$i]);
			$idloaivang = ceil(trim($idloaivangct[$i]));
			$cannangvh = str_replace(",", "", trim($cannangvhct[$i]));
			$cannangh = str_replace(",", "", trim($cannanghct[$i]));
			$cannangv = str_replace(",", "", trim($cannangvct[$i]));
			$tuoivang = str_replace(",", "", trim($tuoivangct[$i]));
			$tienmatvang = trim($tienmatvangct[$i]);
			$ghichuvang = trim($ghichuvangct[$i]);
			if($nhomnguyenlieuvang > 0 && $tennguyenlieuvang > 0 && $idloaivang > 0){// xóa bang kg có dữ liệu
				$arrcth['idctnx'] = $idctnx;
				$arrcth['nhomdm'] = $nhomdm;
				$arrcth['nhomnguyenlieuvang'] = $nhomnguyenlieuvang;
				$arrcth['tennguyenlieuvang'] = $tennguyenlieuvang ;
				$arrcth['idloaivang'] = $idloaivang;
				$arrcth['cannangvh'] = $cannangvh;
				$arrcth['cannangh'] = $cannangh;
				$arrcth['cannangv'] = $cannangvh - $cannangh;
				$arrcth['tuoivang'] = $tuoivang;
				$arrcth['tienmatvang'] = $tienmatvang;
				$arrcth['ghichuvang'] = $ghichuvang;
				$arrcth['type'] = 1; ////type 1.nhập; 2.xuat; 3.tồn kho 
				$arrcth['typevkc'] = 1; ////typevkc 1.Vàng; 2.Kim Cương;
				if($idctnxvang > 0) // update datagirld có rồi
					vaUpdate('khonguonvao_khoachinct',$arrcth,' id='.$idctnxvang);
				else{ // insert datagirld chưa có
					$arrcth['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
					$arrcth['dated'] = $datenow;
					$arrcth['time'] = $timnow;
					vaInsert('khonguonvao_khoachinct',$arrcth);
				}	
			}
			else{
				if($idctnxvang > 0){ // update datagirld có rồi
					$sql="delete from $GLOBALS[db_sp].khonguonvao_khoachinct where id=".$idctnxvang;
					$GLOBALS["sp"]->execute($sql);
				}	
			}
		}
		//Insert Kim Cương 
		///////////kim cuong 
		$i=0;
		$idctnxkimcuongct = $_POST["idctnxkimcuong"]; // id của datagirld khonguonvao_khoachinct
		$nhomnguyenlieukimcuongct = $_POST["nhomnguyenlieukimcuong"];
		$tennguyenlieukimcuongct = $_POST["tennguyenlieukimcuong"];
		$idkimcuongct = $_POST["idkimcuong"];
		$codegdpnjct = $_POST["codegdpnj"];
		$codecgtact = $_POST["codecgta"];
		$kichthuocct = $_POST["kichthuoc"];
		$trongluonghotct = $_POST["trongluonghot"];
		$dotinhkhietct = $_POST["dotinhkhiet"];
		$capdomauct = $_POST["capdomau"];
		$domaibongct = $_POST["domaibong"];
		$kichthuocbanct = $_POST["kichthuocban"];
		$tienmatkimcuongct = $_POST["tienmatkimcuong"];
		$dongiabanct = $_POST["dongiaban"];
		for($i=0;$i<=count($idctnxkimcuongct);$i++){
			$arrcthkc = array();
			$arrcthkc['maphieu'] = $maphieu;
			$idctnxkimcuong = $idctnxkimcuongct[$i];
			$nhomnguyenlieukimcuong = trim($nhomnguyenlieukimcuongct[$i]);
			$tennguyenlieukimcuong = trim($tennguyenlieukimcuongct[$i]);
			$idkimcuong = ceil(trim($idkimcuongct[$i]));
			$codegdpnj = trim($codegdpnjct[$i]);
			$codecgta = trim($codecgtact[$i]);
			$kichthuoc = trim($kichthuocct[$i]);
			$trongluonghot = trim($trongluonghotct[$i]);
			$dotinhkhiet = trim($dotinhkhietct[$i]);
			$capdomau = trim($capdomauct[$i]);
			$domaibong = trim($domaibongct[$i]);
			$kichthuocban = trim($kichthuocbanct[$i]);
			$tienmatkimcuong = trim($tienmatkimcuongct[$i]);
			$dongiaban = str_replace(",", "", trim($dongiabanct[$i]));
	
			if($nhomnguyenlieukimcuong > 0 && $tennguyenlieukimcuong > 0 && $idkimcuong > 0){
				$arrcthkc['idctnx'] = $idctnx;
				$arrcthkc['nhomdm'] = $nhomdm;
				$arrcthkc['nhomnguyenlieukimcuong'] = $nhomnguyenlieukimcuong;
				$arrcthkc['tennguyenlieukimcuong'] = $tennguyenlieukimcuong;
				$arrcthkc['idkimcuong'] = $idkimcuong;
				$arrcthkc['codegdpnj'] = $codegdpnj;
				$arrcthkc['codecgta'] = $codecgta;
				$arrcthkc['kichthuoc'] = $kichthuoc;
				$arrcthkc['trongluonghot'] = $trongluonghot;
				$arrcthkc['dotinhkhiet'] = $dotinhkhiet;
				$arrcthkc['capdomau'] = $capdomau;
				$arrcthkc['domaibong'] = $domaibong;
				$arrcthkc['kichthuocban'] = $kichthuocban;
				$arrcthkc['tienmatkimcuong'] = $tienmatkimcuong;
				$arrcthkc['dongiaban'] = $dongiaban;
				$arrcthkc['type'] = 1; ////type 1.nhập; 2.xuat; 
				$arrcthkc['typevkc'] = 2; ////typevkc 1.Vàng; 2.Kim Cương;
				if($idctnxkimcuong > 0) // update datagirld có rồi
					vaUpdate('khonguonvao_khoachinct',$arrcthkc,' id='.$idctnxkimcuong);
				else{ // insert datagirld chưa có
					$arrcthkc['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
					$arrcthkc['dated'] = $datenow;
					$arrcthkc['time'] = $timnow;
					vaInsert('khonguonvao_khoachinct',$arrcthkc);
				}	
			}
			else{
				if($idctnxkimcuong > 0){ // update datagirld có rồi
					$sql="delete from $GLOBALS[db_sp].khonguonvao_khoachinct where id=".$idctnxkimcuong;
					$GLOBALS["sp"]->execute($sql);
				}	
			}
	
		}
		$GLOBALS["sp"]->CommitTrans();
	} 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		die($errorTransetion);
	}	
}

?>