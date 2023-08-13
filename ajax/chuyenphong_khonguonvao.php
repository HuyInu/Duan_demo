<?php
include("../#include/config.php");
include("../functions/function.php");
CheckLogin();
global $path_url,$path_dir;
date_default_timezone_set("Asia/Ho_Chi_Minh");

if(!isset($_SESSION["store_qlsxntjcorg_login"])){
	die('Vui long dang nhap lai');	
}
$arr = array();
$error = "";
$datenow = date("Y-m-d");
$timnow = date('H:i:s');
$act = isset($_POST['act'])?$_POST['act']:"";
$id = $_POST["id"];
$cid = isset($_POST['phongbanchuyen'])?$_POST['phongbanchuyen']:"";
$macode = isset($_POST['maphieu'])?$_POST['maphieu']:"";
switch($act){
	case "TaoPhieuXuaKho":
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			if(!empty($macode)){
				$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$cid;	
				$rstc = $GLOBALS['sp']->getRow($sqltc);
				$table = $rstc['table'];
				$tablect = $rstc['tablect'];
				$tablehachtoan = $rstc['tablehachtoan'];
				
				///////////////tạo phiếu xuất và hach toán/////////
				$mauphieu = getTableAll($tablect,' and idctnx='.$id.' order by id asc');
				if(ceil(count($mauphieu)) > 0){
					$arr['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
					$arr['datechuyen']= $datenow;
					$arr['timechuyen']= $timnow;
					$arr['phongban']= trim($_POST["phongban"]);
					$arr['phongbanchuyen'] = trim($_POST["phongbanchuyen"]);
					$arr['type'] = 3;
					vaUpdate($table,$arr,' id='.$id); /// chuyển toa
					
					foreach($mauphieu as $item){
						/////////////insert phiếu xuất kho
						$arrnx = array();
						$sqlmpt = "select max(numphieu)+1 from $GLOBALS[db_sp].".$tablect."";
						$rsmpt = $GLOBALS['sp']->getone($sqlmpt);
						if($rsmpt <= 0)
							$rsmpt = 1;	
						$maso = convertMaso($rsmpt);
						$arrnx['idct'] = $item['id'];
						$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
						$arrnx['numphieu'] = $rsmpt;
						$arrnx['idctnx'] = $id;
						$arrnx['maphieu'] = $macode.$maso;
						$arrnx['type'] = 2;
						$arrnx['nhomdm'] = $item['nhomdm'];
						$arrnx['nhomnguyenlieuvang'] = $item['nhomnguyenlieuvang'];
						$arrnx['tennguyenlieuvang'] = $item['tennguyenlieuvang'];
						$arrnx['idloaivang'] = $item['idloaivang'];
						$arrnx['cannangvh'] = $item['cannangvh'];
						$arrnx['cannangh'] = $item['cannangh'];
						$arrnx['cannangv'] = $item['cannangv'];
						$arrnx['tuoivang'] = $item['tuoivang'];
						$arrnx['tienmatvang'] = $item['tienmatvang'];
						$arrnx['ghichuvang'] = $item['ghichuvang'];
						$arrnx['nhomnguyenlieukimcuong'] = $item['nhomnguyenlieukimcuong'];
						$arrnx['tennguyenlieukimcuong'] = $item['tennguyenlieukimcuong'];
						$arrnx['idkimcuong'] = $item['idkimcuong'];
						$arrnx['codegdpnj'] = $item['codegdpnj'];
						$arrnx['codecgta'] = $item['codecgta'];
						$arrnx['kichthuoc'] = $item['kichthuoc'];
						$arrnx['trongluonghot'] = $item['trongluonghot'];
						$arrnx['dotinhkhiet'] = $item['dotinhkhiet'];
						$arrnx['capdomau'] = $item['capdomau'];
						$arrnx['domaibong'] = $item['domaibong'];
						$arrnx['kichthuocban'] = $item['kichthuocban'];
						$arrnx['tienmatkimcuong'] = $item['tienmatkimcuong'];
						$arrnx['dongiaban'] = $item['dongiaban'];
						$arrnx['typevkc'] = $item['typevkc'];
						$arrnx['time'] = $timnow;
						$arrnx['dated'] = $datenow;
						vaInsert($tablect,$arrnx); //insert phiếu xuất kho
						
						/////////////////ghi vào sổ đầu kỳ(hạch toán)////////////////
						ghiSoHachToan($tablehachtoan,$tablect, $item['id'], '');
						$error = 'success';
					}
				}
				else{
					$error = 'Toa hàng này chưa có nhập dữ liệu Vàng hoặc Kim Cương.';	
				}
			}
			else{
				$error = 'Vui lòng Nhập vào mã Phiếu.';	
			}
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}
	break;
}
die(json_encode(array('status'=>$error,'name'=>$name,'soducon'=>$soducon)));
?>