<?php 
date_default_timezone_set("Asia/Ho_Chi_Minh");
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];

switch($act){

    case "add":
		if(!checkPermision($idpem,1)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$template = "loaivattu/edit.tpl";
		}
    break;

    case "edit":
		if(!checkPermision($idpem,2)){
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$id = ceil($_GET["id"]);
			$sql = "select * from $GLOBALS[db_sp].loaivattu where id=$id";
			$rs = $GLOBALS["sp"]->getRow($sql);
			$smarty->assign("edit",$rs);
			$template = "loaivattu/edit.tpl";
		}
	break;
    
    case "dellist":
		if(!checkPermision($idpem,3)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$GLOBALS["sp"]->BeginTrans();
			try{
				$id=$_POST["iddel"];
				for($i=0;$i<count($id);$i++){

					$sqlvattu = "select * from $GLOBALS[db_sp].loaivattu where id=".$id[$i];
					$rsvattu = $GLOBALS["sp"]->getRow($sqlvattu);

					$sql="delete from $GLOBALS[db_sp].loaivattu where id=".$id[$i];
					$GLOBALS["sp"]->execute($sql);

					if(file_exists($path_dir."/".$rsvattu['img_thumb'])) unlink($path_dir."/".$rsvattu['img_thumb']);
					if(file_exists($path_dir."/".$rsvattu['img'])) unlink($path_dir."/".$rsvattu['img']);
				}
				$url = $path_url."/sources/loaivattu.php?cid=".$_GET['cid'];
				page_transfer2($url);
				
				$GLOBALS["sp"]->CommitTrans();
			} 
			catch (Exception $e){
				$GLOBALS["sp"]->RollbackTrans();
				die($errorTransetion);
			}
		}
    break;
    
    case "show":
		if(!checkPermision($idpem,2)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$id = $_POST["iddel"];
			for($i=0;$i<count($id);$i++){
				$sql="update $GLOBALS[db_sp].loaivattu SET active=1 where id=".$id[$i];
				$GLOBALS["sp"]->execute($sql);		
			}
			$url = $path_url."/sources/loaivattu.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
    break;
    
    case "hide":
		if(!checkPermision($idpem,2)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$id = $_POST["iddel"];
			for($i=0;$i<count($id);$i++){
				$sql="update $GLOBALS[db_sp].loaivattu SET active=0 where id=".$id[$i];
				$GLOBALS["sp"]->execute($sql);		
			}
			$url = $path_url."/sources/loaivattu.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
    break;
    
    case "order":
		if(!checkPermision($idpem,2)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$id = $_POST["id"];	
			$ordering=$_POST["ordering"];	
			for($i=0;$i<count($id);$i++){
				$sql="update $GLOBALS[db_sp].loaivattu SET num=".$ordering[$i]." where id=".$id[$i];
				$GLOBALS["sp"]->execute($sql);		
			}
			$url = $path_url."/sources/loaivattu.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}	
	break;

    case "addsm":
	case "editsm":
		if(!checkPermision($idpem,2) && !checkPermision($idpem,1) ){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			Editsm();
			$url = $path_url."/sources/loaivattu.php?cid=".$_GET['cid'];
			page_transfer2($url);
		}
	break;

	case "importexcel":
		if(!checkPermision($idpem,10)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			$template = "loaivattu/import.tpl";
			if($_POST)
			{
				if(isset($_FILES['file']['name'] ) && $_FILES['file']['size']>0){
					require_once '../Classes-PHPExcel/PHPExcel.php';
					$file = $_FILES['file']['tmp_name'];
					$objFile = PHPExcel_IOFactory::identify($file);
					$objData = PHPExcel_IOFactory::createReader($objFile);
					$objData->setReadDataOnly(true);
					$objPHPExcel = $objData->load($file);
					$sheet  = $objPHPExcel->setActiveSheetIndex(0);
					//Lấy ra số dòng cuối cùng
					$Totalrow = $sheet->getHighestRow();
					//Lấy ra tên cột cuối cùng
					$LastColumn = $sheet->getHighestColumn();
					//Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
					$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
					$data = [];
				
					//Tiến hành lặp qua từng ô dữ liệu/// cột đầu tiền là 2
					//----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
					$GLOBALS["sp"]->BeginTrans();
					try{
						for($i = 2; $i <= $Totalrow; $i++)
						{
							$mavattu    = trim($sheet->getCellByColumnAndRow(0,$i)->getValue());
							$name_vn    = trim($sheet->getCellByColumnAndRow(1,$i)->getValue());
							$donvitinh  = trim($sheet->getCellByColumnAndRow(2,$i)->getValue());
							$nhom       = trim($sheet->getCellByColumnAndRow(3,$i)->getValue());
							$dongia     = trim($sheet->getCellByColumnAndRow(4,$i)->getValue());
							$nhacungcap = trim($sheet->getCellByColumnAndRow(5,$i)->getValue());
							$noidung    = trim($sheet->getCellByColumnAndRow(6,$i)->getValue());
							if(!empty($mavattu)){
								$arr = array();
								$sql = "SELECT * FROM $GLOBALS[db_sp].loaivattu where mavattu = '$mavattu' ";
								$rs = $GLOBALS['sp']->GetRow($sql);
								
								$dongia = str_replace(",", "", $dongia);
								
								$arr['mavattu'] = trim($mavattu);
								$arr['name_vn'] = trim($name_vn);
								$arr['donvitinh'] = trim($donvitinh);
								$arr['nhom'] = trim($nhom);
								$arr['dongia'] = $dongia;
								$arr['nhacungcap'] = trim($nhacungcap);
								$arr['noidung'] = trim($noidung);
								$arr['num'] = 0;
								$arr['active'] = 1;
								if(ceil($rs['id']) <= 0){ // chưa tồn tại insert vào
									vaInsert('loaivattu',$arr);	
								}
								else{
									vaUpdate('loaivattu',$arr,' id='.$rs['id']);		
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
				$url = $path_url."/sources/loaivattu.php?cid=".$_GET['cid'];
				page_transfer2($url);
			}
			
		}
	break;

    default:
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url."/sources/main.php";
			page_transfer2($page);
		}
		else{
			$wh = $strSearch = '';
			$mavattus = trim(striptags($_GET['mavattus']));
			$tenvattus = trim(striptags($_GET['tenvattus']));
			$nhacungcaps = trim(striptags($_GET['nhacungcaps']));
			$motavattus = trim(striptags($_GET['motavattus']));
			
			
			$smarty->assign("mavattus",$mavattus);
			$smarty->assign("tenvattus",$tenvattus);
			$smarty->assign("nhacungcaps",$nhacungcaps);
			$smarty->assign("motavattus",$motavattus);
			
			if(!empty($mavattus)){
				$strSearch .= '&mavattus='.$mavattus;
				$wh.=' and mavattu like "%'.$mavattus.'%" ';
			}
			if(!empty($tenvattus)){
				$strSearch .= '&tenvattus='.$tenvattus;
				$wh.=' and name_vn like "%'.$tenvattus.'%" ';
			}
			if(!empty($nhacungcaps)){
				$strSearch .= '&nhacungcaps='.$nhacungcaps;
				$wh.=' and nhacungcap like "%'.$nhacungcaps.'%" ';
			}
			if(!empty($motavattus)){
				$strSearch .= '&motavattus='.$motavattus;
				$wh.=' and noidung like "%'.$motavattus.'%" ';
			}
			
			////////////////////////////////////////////////////////////////////////////////////////
			$sql = "select * from $GLOBALS[db_sp].loaivattu where 1=1 $wh order by num asc, id asc";
			$sql_sum = "select count(id) from $GLOBALS[db_sp].loaivattu where 1=1 $wh ";
			$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
			$num_rows_page = $numPageAll;
			$num_page = ceil($total/$num_rows_page);
			$begin = ($page - 1)*$num_rows_page;
			$url = "loaivattu.php?cid=".$_GET['cid']; //set url for paginator
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
			$template = "loaivattu/list.tpl";
			
			if(checkPermision($idpem,1))
				$smarty->assign("checkPer1","true");
			if(checkPermision($idpem,2))
				$smarty->assign("checkPer2","true");
			if(checkPermision($idpem,3))
				$smarty->assign("checkPer3","true");
			if(checkPermision($idpem,10))
				$smarty->assign("checkPer10","true");
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
	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
	
	/////////////tạo thư mục hình theo tháng đó
	if(( isset($_FILES['img']['name'] ) && $_FILES['img']['size']>0 )){
		$day = date("d");
		$moth = date("m");
		$year = date("Y");
		//$numberday = cal_days_in_month(CAL_GREGORIAN, $moth, $year); // lấy tháng đó có bao nhiêu ngày
		$datedFolder = $moth.$year;
		$thumuc = "../upload/kho-vat-tu/".$datedFolder."/";
		$thumucdb = "upload/kho-vat-tu/".$datedFolder."/";
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
	
    $arr['mavattu'] = striptags(trim($_POST["mavattu"]));
    $arr['name_vn'] = striptags(trim($_POST["name_vn"]));
    $arr['donvitinh'] = striptags(trim($_POST["donvitinh"]));
    $arr['nhom'] = striptags(trim($_POST["nhom"]));
	$arr['dongia'] = str_replace(",", "", $_POST["dongia"]);
    $arr['nhacungcap'] = striptags(trim($_POST["nhacungcap"]));
    $arr['noidung'] = striptags(trim($_POST["noidung"]));
	$arr['num'] = $_POST["num"];	
	$arr['active'] = $_POST['active']=='active'?'1':'0';
	////////////////Dung Transaction////////////////
	$GLOBALS["sp"]->BeginTrans();
	try{
		if ($act=="addsm")
		{
			vaInsert('loaivattu',$arr);
		}
		else
		{
			$id = $_POST['id'];

			$sql = "select * from $GLOBALS[db_sp].loaivattu where id=$id";
			$rs = $GLOBALS["sp"]->getRow($sql);

			if (isset($arr['img'])){
				if($arr['img'] != $rs['img']){
					if(file_exists($path_dir."/".$rs['img'])){
						unlink($path_dir."/".$rs['img']);
					    unlink($path_dir."/".$rs['img_thumb']);
					}
				}
			}
			////Xóa Img khi chon Xoa/////
			if($_POST['del_img']=='del_img'){
				unlink($path_dir."/".$rs['img_thumb']);
				unlink($path_dir."/".$rs['img']);
				
				$arr['img_thumb'] = "";
				$arr['img'] = "";
			}

			vaUpdate('loaivattu',$arr,' id='.$id);	
		}
		
		$GLOBALS["sp"]->CommitTrans();
	} 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		die($errorTransetion);
	}
}

?>