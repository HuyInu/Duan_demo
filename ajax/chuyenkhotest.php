<?php
include("../#include/config.php");
include("../functions/function.php");
include("../functions/functionVu.php");//Vũ thêm 28-11-19
include("../functions/functionNhom.php");//Anh Vũ Thêm
CheckLogin();
global $path_url,$path_dir, $errorTransetion;
$errorTransetion = 'Lỗi hệ thống dữ liệu, vui lòng liên hệ với addmin để xử lý.'; 
date_default_timezone_set("Asia/Ho_Chi_Minh");
if(!isset($_SESSION["store_qlsxntjcorg_login"])){
	die('Vui long dang nhap lai');	
}
clearstatcache();
unset($arr);
unset($arrnx);
unset($arrch);
$arr = $arrnx = $arrch = array();
$error = "";
$datenow = date("Y-m-d");
$timnow = date('H:i:s');
$timenow = date('H:i:s');
$id = ceil(trim($_POST["id"]));
$cid = isset($_POST['cid'])?ceil(trim($_POST["cid"])):"";
$phongbanchuyen = isset($_POST['phongbanchuyen'])?ceil(trim($_POST["phongbanchuyen"])):"";
$type = isset($_POST['type'])?$_POST['type']:"";
$typeKhoDau = isset($_POST['typeKho'])?$_POST['typeKho']:"";
$act = isset($_POST['act'])?$_POST['act']:"";

switch($act){
    case "chuyenkhokhac":
        sleep(3);
        $GLOBALS['sp']->BeginTrans();
        try{
            $sql = $rs = $sqltc = $rstc = $tablenhan = $tablechuyen = $tablechuyen = $item = $sqlcount = '';
			///////////Load dữ liệu trong bảng categories để lây table cần insert đưa vô
			$sql = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rs = $GLOBALS['sp']->getRow($sql);
			///////////Load dữ liệu trong bảng categories để lây table chuyển
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$phongbanchuyen;
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			if(!empty($rs['table']) && !empty($rstc['tablect'])){
				$tablenhan = $rs['tablect'];
				$tablechuyen = $rstc['tablect'];
				
				$sqlcopy = "select * from $GLOBALS[db_sp].".$tablechuyen." where id=".$id;	
				$item = $GLOBALS['sp']->getRow($sqlcopy);
				$sqlcount = "select * from $GLOBALS[db_sp].".$tablenhan." where maphieu='".$item['maphieu']."' and idmaphieukho=".$id." and phongbanchuyen=".$phongbanchuyen;
				$count = ceil(count($GLOBALS['sp']->getAll($sqlcount)));
				if($count == 0){
					$cannangvh = $cannangv =0;
					//////////////kiểm tra những cột trong table nhận có tồn tại hay kg
					$sqlcheckTableNhan = "SHOW COLUMNS FROM $GLOBALS[db_sp].".$tablenhan." ";
					$rscheckTableNhan = $GLOBALS["sp"]->getAll($sqlcheckTableNhan);
					$arrayTableNhan = array();
					$i=0;
					foreach($rscheckTableNhan as $value){
						$arrayTableNhan[$value['Field']] = $value['Field'];
					}
					//die('xxx'.$arrayTableNhan['midchuyen']);
					if(!empty($typeKhoDau)){
						$typeKho = explode('_',$typeKhoDau);
						$arr['typekho'] = $typeKho[0];
					}
					$arr['typekhodau'] = $typeKhoDau;
					$cannangvh = ($item['cannangvh'] + $item['du']) - $item['hao'];
					$cannangv = ($item['cannangv'] + $item['du']) - $item['hao'];
					$arr['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
					$arr['mid'] = $item['mid'];
					$arr['cid'] = $cid;
					$arr['idctnx'] = $item['idctnx'];
					$arr['maphieu'] = $item['maphieu'];	
					$arr['idmaphieukho'] = $id;
					if($item['typevkc'] == 1){//// loai vàng
						if(!empty($arrayTableNhan['cidchuyen']))
							$arr['cidchuyen'] = $phongbanchuyen;
						if(!empty($arrayTableNhan['typechuyen']))
							$arr['typechuyen'] = 1; ///////// typechuyen 1 chờ nhập, 2 xác nhận đã nhập cho kho sản xuất
						if(!empty($arrayTableNhan['nhomnguyenlieuvang']))	
							$arr['nhomnguyenlieuvang'] = $item['nhomnguyenlieuvang'];
						if(!empty($arrayTableNhan['tennguyenlieuvang']))	
							$arr['tennguyenlieuvang'] = $item['tennguyenlieuvang'];
						if(!empty($arrayTableNhan['slcannangvcon']))
							$arr['slcannangvcon'] = $cannangv;
						if(!empty($arrayTableNhan['tuoivang']))
							$arr['tuoivang'] = $item['tuoivang'];
						if(!empty($arrayTableNhan['tienmatvang']))
							$arr['tienmatvang'] = $item['tienmatvang'];
						if(!empty($arrayTableNhan['ghichuvang']))
							$arr['ghichuvang'] = $item['ghichuvang'];
						if(!empty($arrayTableNhan['ghichu']))
							$arr['ghichu'] = $item['ghichu'];
						$arr['nhomdm'] = $item['nhomdm'];	
						$arr['idloaivang'] = $item['idloaivang'];
						if($typeKho[1] == 'phankim'){ /// kho phan kim chuyển đến
							$arr['tuoivang'] = $item['tuoivangmoi'];
							$arr['cannangvh'] =  $arr['cannangv'] =  $item['cannangvmoi'];
							$arr['cannangh'] = 0;
							$arr['slcannangvcon'] = $item['cannangvmoi'];
							
							$arr['nhomnguyenlieuvang'] = 75;	
							$arr['tennguyenlieuvang'] = 82;
						}
						else{
							$arr['cannangvh'] = $cannangvh;
							$arr['cannangh'] = $item['cannangh'];
							$arr['cannangv'] = $cannangv;
							$arr['haochuyen'] = $item['hao'];
							$arr['duchuyen'] = $item['du'];
						}
					}
					else{
						$arr['nhomnguyenlieukimcuong'] = $item['nhomnguyenlieukimcuong'];
						$arr['tennguyenlieukimcuong'] = $item['tennguyenlieukimcuong'];
						$arr['idkimcuong'] = $item['idkimcuong'];
						$arr['codegdpnj'] = $item['codegdpnj'];
						$arr['codecgta'] = $item['codecgta'];
						$arr['kichthuoc'] = $item['kichthuoc'];
						$arr['trongluonghot'] = $item['trongluonghot'];
						$arr['dotinhkhiet'] = $item['dotinhkhiet'];
						$arr['capdomau'] = $item['capdomau'];
						$arr['domaibong'] = $item['domaibong'];
						$arr['kichthuocban'] = $item['kichthuocban'];
						$arr['tienmatkimcuong'] = $item['tienmatkimcuong'];
						$arr['dongiaban'] = $item['dongiaban'];
						$arr['ghichukimcuong'] = $item['ghichukimcuong'];
					}
					$arr['type'] = 1;
					$arr['typevkc'] = $item['typevkc'];
					$arr['dated']= $datenow;
					$arr['time']= $timnow;
					
					$arr['datechuyen']= $datenow;
					$arr['timechuyen']= $timnow;
					$arr['phongbanchuyen'] = $phongbanchuyen;
					$arr['trangthai'] = 0;
					
					$arrnx['trangthai'] = 1;
					$arrnx['phongban']= $cid;
					$arrnx['datechuyen']= $datenow;
					$arrnx['timechuyen']= $timnow;
					///////////chuyển thẳng xuống kho lưu trữ thành phẩm luôn có hạch toán luôn
					if(($cid == 285 && $typeKhoDau=='khosanxuat_thanhpham')){/// KSX Kho Sản Xuất -> Kho Phòng Thành Phẩm chuyển xuất kho lưu trữ kho thành phẩm
						//////////phòng nhận
						$arr['type'] = 2;
						$arr['datechuyen'] = $datenow;
						$arr['timechuyen'] = $timnow;
						
						$arr['time'] = $timnow;
						$arr['dated'] = $datenow;
						
						$arr['typegiaonhan'] = 3;	
						$arr['matho'] = 21;	
						
						//////// phòng chuyển Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
						
						$arrnx['timexuat'] = $timnow;
						$arrnx['datedxuat'] = $datenow;
						$arrnx['phongban'] = $cid;
						$arrnx['trangthai'] = 2;
					}
					$idtablenhan = 0;
					$idtablenhan = vaInsert($tablenhan,$arr);
					////////////cập nhập xuất kho trang thay đơn hàng đang chờ trangthaichuyen = 1
					vaUpdate($tablechuyen, $arrnx ,' id='.$id);
					
					///////////chuyển thẳng xuống kho lưu trữ thành phẩm luôn có hạch toán luôn
					if(($cid == 285 && $typeKhoDau=='khosanxuat_thanhpham')){/// KSX Kho Sản Xuất -> Kho Phòng Thành Phẩm chuyển xuất kho lưu trữ kho thành phẩm
						$tablehachtoan = $rstc['tablehachtoan'];
						ghiSoHachToan($tablehachtoan,$tablenhan, $idtablenhan, '');	
					}
					$error = 'success';
				}
				else{
					$error = 'Toa hàng nãy đã được chuyển đến phòng chờ, vui lòng liên hệ với admin để được xử lý.';	
				}
			}
			else{
				$error = 'Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.';	
			}
			$GLOBALS["sp"]->CommitTrans();
        }catch(Exception $e){
            $GLOBALS["sp"]->RollbackTrans();
            $error = $e->getMessage();
        }
    break;  
    case "xacnhanchuyenKhoSanXuat":
        sleep(3);
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = $tablehachtoanold = $tablectchuyen = $rsmaphieukho = '';
			$idmaphieukho = $idhachtoan = 0;
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select tablect,tablehachtoan from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
			$tablehachtoannew = $rsnow['tablehachtoan'];
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);

			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablehachtoanold = $rstc['tablehachtoan'];
			$tablectchuyen = $rstc['tablect'];
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			if($type == 'khosanxuat'){
				//die('tablectchuyen='.$tablectchuyen .' idmaphieukho: '. $rsn['idmaphieukho']);
				$rsmaphieukho = getTableRow($tablectchuyen,' and id='.$rsn['idmaphieukho'].' and maphieu="'.$rsn['maphieu'].'"');
				$idmaphieukho = $rsmaphieukho['id'];
				$idhachtoan = $rsmaphieukho['id'];
			}
			else{
				$idmaphieukho = $rsn['idmaphieukho'];
				$idhachtoan = $idmaphieukho;
			}

			// die('tablehachtoanold: '. $tablehachtoanold . '  : tablehachtoannew: '. $tablehachtoannew . '  : tablectchuyen: '. $tablectchuyen . ' : tablenhan: '. $tablenhan);
			if(!empty($tablehachtoannew) && !empty($tablectchuyen) && !empty($tablenhan)){
				////
				//
				$typechuyen = $rsn["typechuyen"];
				$datechuyen = $rsn["datechuyen"];
				$timechuyen = $rsn["timechuyen"];
				$rs1 = getTableRow($tablectchuyen,' and id='.$rsn['idmaphieukho'].' and maphieu="'.$rsn['maphieu'].'"');
				if(count($rs1) > 0){
					$timexuat = $rs1["timexuat"];
					$datedxuat = $rs1["datedxuat"];
					$phongban = $rs1["phongban"];
					$trangthai = $rs1["trangthai"];
				}
				if($typechuyen == 2 && $trangthai == 2 && $timexuat != null && $datedxuat != null)
					$error = 'Toa hàng nãy đã được xác nhận, vui lòng liên hệ với admin để được xử lý.';
				else{
					//////// Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho vd: kho_giamdockynhan////////////////////
					$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
					$arrnx['typechuyen'] = 2; ///////// typechuyen 1 chờ nhập, 2 xác nhận đã nhập
					$arrnx['datechuyen'] = $datenow;
					$arrnx['timechuyen'] = $timnow;
					$arrnx['time'] = $timnow;
					$arrnx['dated'] = $datenow;
					
					if($cid == 811 || $cid == 727 || $cid == 1614 ){ //// xác nhân từ kho kho sản xuât -> thành phẩm, kho sản xuât -> kho phòng xi , kho khác ->kho lưu mẫu
						$arrnx['slvangcon'] = $rsn['cannangv'];	
					}
					//$arrnx['dated'] = $datenow;
					vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
					//////// Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
					$arrch['timexuat'] = $timnow;
					$arrch['datedxuat'] = $datenow;
					$arrch['phongban'] = $cid;
					$arrch['trangthai'] = 2;
					//sleep(1);
					vaUpdate($tablectchuyen, $arrch ,' id='.$idmaphieukho);
					//sleep(1);
					//////////////////ghi vào sổ đầu kỳ(hạch toán) vào table chuyển đến vd:khoachin_sodudauky
					// die(' :tablehachtoanold: '.$tablehachtoanold .' :tablectchuyen: '.$tablectchuyen . ' :idhachtoan: '.$idhachtoan . ' :type: '.$type );
					ghiSoHachToanKhoSanXuat($tablehachtoannew,$tablenhan, $id);
					//sleep(2);
					ghiSoHachToan($tablehachtoanold,$tablectchuyen, $idhachtoan, 'xuatkho');
					////////Kiểm tra để hạch toán số lượng và vàng của theo loại vàng và mã phụ kiện 
					if($rsn['typekhodau'] == 'khosanxuat_phukien'){
						// Lấy ra id của phiếu phụ kiện chuyển trước đó
						$idphukien = ceil($rsn['idmaphieukho']);
						if($idphukien > 0){
							// Tiến hành hạch toán dựa trên id phiếu của kho phụ kiện
							ghiSoHachToanMaPhuKien('khosanxuat_phukienma_sodudauky', 'khosanxuat_phukien', $idphukien);
						}
					}
					$error = 'success';
				}
			}
			else{
				$error = 'Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.';	
			}
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}
    break;
	case "tralaichuyenKhoSanXuat":
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $sqln = $rsn = $sqltc = $rstc = $tablectchuyen = $sqlidmp = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select tablect from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
					// die('xxx');
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			// die($rsn['phongbanchuyen']);
			if($type == 'khosanxuat'){
				$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['cidchuyen'];
				$arrnx['type'] = 2;
			}
			else{
				$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
				$arrnx['phongban'] = $rsn['phongbanchuyen'];
			}
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			// die(print_r($rstc));
			$tablectchuyen = $rstc['tablect'];
			// die($tablectchuyen);
			//die("tablectchuyen: " .$tablectchuyen . "  :tablenhan: " .$tablenhan);
			////////xóa trong kho đó khi trả về không chấp nhận duyệt
			$sql="delete from $GLOBALS[db_sp].".$tablenhan." where id = ".$rsn['id'];
			$GLOBALS["sp"]->execute($sql);
			$arrnx['trangthai'] = 0;
			$arrnx['tralai'] = 1;
			/////////load id ma phieu kho để lấy id cập nhận lại phiếu đó
			$sqlidmp = "select id from $GLOBALS[db_sp].".$tablectchuyen." where maphieu='".$rsn['maphieu']."' and id=".$rsn['idmaphieukho'];
			$idphieu = $GLOBALS['sp']->getOne($sqlidmp);
			// die(print_r($arrnx));
			vaUpdate($tablectchuyen, $arrnx ,' id='.$idphieu);
			// die('xxx'.$idphieu);
			$error = 'success';
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}
	break;
}
die(json_encode(array('status'=>$error)));
?>