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
	case "testapi": 
		
		$url = 'http://demoqlsx.ntjc.org/API/api.php?key=s966817uy3b92da41&type=select';
		$ch=curl_init($url);
		$data_string = urlencode(json_encode($data));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, array("customer"=>$data_string));
		curl_setopt($ch, CURLOPT_TIMEOUT,300000);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_ENCODING, "UTF-8" );
		curl_close($ch);	
		$result = curl_exec($ch);
		//curl_close($ch);		
		$data = ( urldecode( $result));
		/*
		for($i=0; $i < 10;  $i++){
				sleep(2);
				$rs .= 	$i ."<br/>";
				
			}
		*/	
		$error = $rs;
	break;
	case "chuyenkhosanxuat":
		////////////////Dung Transaction////////////////
		sleep(3);
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sql = $rs = $sqltc = $rstc = $tablenhan = $tablechuyen = $item = $sqlcount = '';
			$idtablenhan = 0;
			///////////Load dữ liệu trong bảng categories để lây table cần insert đưa vô
			$sql = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rs = $GLOBALS['sp']->getRow($sql);
			///////////Load dữ liệu trong bảng categories để lây table chuyển
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$phongbanchuyen;
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			
			if(!empty($rs['table']) && !empty($rstc['tablect'])){
				$tablenhan = $rs['tablect'];
				$tablechuyen = $rstc['tablect'];
				
				$sqlcopy = "select * from $GLOBALS[db_sp].".$tablechuyen." where id=".$id; /// copy table giám đốc ký nhận
				$item = $GLOBALS['sp']->getRow($sqlcopy);
					
				$sqlcount = "select * from $GLOBALS[db_sp].".$tablenhan." where maphieu='".$item['maphieu']."' and cidchuyen=".$phongbanchuyen;
				$count = ceil(count($GLOBALS['sp']->getAll($sqlcount)));
				if($count == 0){
					$cannangvh = $cannangv = 0;
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
					if(!empty($arrayTableNhan['slcannangvcon']))
						$arr['slcannangvcon'] = $cannangv;
					if(!empty($arrayTableNhan['midchuyen']))
						$arr['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
					if(!empty($arrayTableNhan['cidchuyen']))
						$arr['cidchuyen'] = $phongbanchuyen; /// hiển thị phòng chuyển đến vd Kho Sản Xuất -> Kho Nguyên Liệu
					if(!empty($arrayTableNhan['idmaphieukho']))
						$arr['idmaphieukho'] = $item['idmaphieukho'];
					if(!empty($arrayTableNhan['ghichuvang']))
						$arr['ghichuvang'] = $item['ghichuvang'];
					if(!empty($arrayTableNhan['ghichu']))
						$arr['ghichu'] = $item['ghichu'];
					if(!empty($arrayTableNhan['typechuyen']))
						$arr['typechuyen'] = 1; ///////// typechuyen 1 chờ nhập, 2 xác nhận đã nhập
					if(!empty($arrayTableNhan['idmaphieukho']))
						$arr['idmaphieukho'] = $item['id'];
					if(!empty($arrayTableNhan['tuoivang']))
						$arr['tuoivang'] = $item['tuoivang'];
					if(!empty($arrayTableNhan['phongban'])){
						$arr['phongban'] = $cid;
					}
					if(!empty($arrayTableNhan['idpnk'])){
						$arr['idpnk'] = $item['idpnk'];
					}
					if(!empty($arrayTableNhan['madhin']))
						$arr['madhin'] = $item['madhin'];
					if(!empty($arrayTableNhan['chonphongbanin']))
						$arr['chonphongbanin'] = $item['chonphongbanin'];

					if(!empty($arrayTableNhan['idphukien']))
						$arr['idphukien'] = $item['idphukien'];
					if(!empty($arrayTableNhan['soluongphukien']))
						$arr['soluongphukien'] = $item['soluongphukien'];
							
					if($typeKho[1] == 'bot_khobot'){ /// kho khác -> kho bột chuyển đến // Dể cụt, Dể cụt có tuổi
						$arr['nhomnguyenlieuvang'] = 75;	
						$arr['tennguyenlieuvang'] = 82;
					}
					
					$arr['cid'] = $cid;
					$arr['maphieu'] = $item['maphieu'];
					$arr['idloaivang'] = $item['idloaivang'];

					$arr['type'] = 1;
					$arr['dated']= $datenow;
					$arr['time']= $timnow;
					$arr['phongbanchuyen'] = $item['phongbanchuyen'];
					$arr['datechuyen']= $datenow;
					$arr['timechuyen']= $timnow;
					$arr['trangthai'] = 0;
					$cannangvh = $item['cannangvh'];
					$cannangv = $item['cannangv'];

					$arr['mid'] = $item['mid'];
					$arr['cannangvh'] = $cannangvh;
					$arr['cannangh'] = $item['cannangh'];
					$arr['cannangv'] = $cannangv;
					
					/*if($cid == 305 && trim($item['idloaivang']) == 12){//nếu chuyển xuống là phong KHO NHẬP LIỆU » KHO NGUỒN VÀO » KHO NHÀ XƯỞNG GIAO NỮ TRANG (KTP) và loai vàng VT5.58  
						$arr['cannangh'] = 0;
						$arr['cannangv'] = $cannangvh;
					}
					*/
					if($cid == 169){/// chuyển đến kho tổng dẻ cụt, tạo tự động nhóm nguyên liệu và tên nguyên liệu lấy danh  mục kho a chin
						if($typeKhoDau == 'khosanxuat_thuy'){
							$arr['tennguyenlieuvang'] = 84;	 //Dẻ cụt thúy
						}
						else{
								
							$arr['tennguyenlieuvang'] = 82;  //Dẻ cụt có tuổi
						}
						$arr['nhomnguyenlieuvang'] = 75;
						$arr['slcannangvcon'] = $cannangv;
						
						$arr['haochuyen'] = $item['haochuyen'];
						$arr['duchuyen'] = $item['duchuyen'];
					}
					$arr['typevkc'] = $item['typevkc'];	
					$arr['phongbanchuyen'] = $phongbanchuyen; /// hiển thị phòng chuyển đến vd Kho Sản Xuất -> Kho Nguyên Liệu
				
					$arrnx['trangthai']= 1;
					$arrnx['datechuyen']= $datenow;
					$arrnx['timechuyen']= $timnow;
					
					$arrnx['type'] = 3; /// Kho Sản Xuất
					$arrnx['phongban'] = $cid;
					///////////chuyển thẳng xuống kho lưu trữ thành phẩm luôn có hạch toán luôn $cid != 169 là khác kho tổng dể cục mới vào
					if( ($phongbanchuyen == 624 && $cid != 169) || ($cid == 307 && $typeKhoDau=='khosanxuat_thanhpham')){/// Kho Sản Xuất -> Kho Phòng VMNT, Kho thành phẩm
					
						if($phongbanchuyen == 624){	
							  $arr['matho'] = 14;	/// phần mềm -> kho VNT
						}
						else{
							$arr['matho'] = 21; /// phần mềm -> kho thành phẩm
							$arr['idpnk'] = $item['idpnk'];
							//$arr['du'] = $item['duchuyen'];
						}
						//////////phòng nhận
						$arr['type'] = 2;
						$arr['datechuyen'] = $datenow;
						$arr['timechuyen'] = $timnow;
						
						$arr['time'] = $timnow;
						$arr['dated'] = $datenow;
						
						$arr['typegiaonhan'] = 3;
						
						//////// phòng chuyển Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
						
						$arrnx['timexuat'] = $timnow;
						$arrnx['datedxuat'] = $datenow;
						$arrnx['phongban'] = $cid;
						$arrnx['trangthai'] = 2;
					}
					//die($typeKhoDau);
					//print_r($arr); die($tablenhan);
					$idtablenhan = vaInsert($tablenhan,$arr);
					
					///////////////////kho giám đốc xưởng
					vaUpdate($tablechuyen, $arrnx ,' id='.$id);
					
					///////////chuyển thẳng xuống kho lưu trữ thành phẩm luôn có hạch toán luôn
					if( ($phongbanchuyen == 624 && $cid != 169) || ($cid == 307 && $typeKhoDau=='khosanxuat_thanhpham')){/// Kho Sản Xuất -> Kho Phòng VMNT, Kho thành phẩm
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
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}	
	break;
	case "tralaichuyenKhoSanXuat":
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $sqln = $rsn = $sqltc = $rstc = $tablectchuyen = $sqlidmp = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
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
			$sql="delete from $GLOBALS[db_sp].".$tablenhan."  where id = ".$rsn['id'];
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
	
	case "xacnhanchuyenKhoSanXuat":
		////////////////Dung Transaction////////////////
		sleep(3);
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = $tablehachtoanold = $tablectchuyen = $rsmaphieukho = '';
			$idmaphieukho = $idhachtoan = 0;
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
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
	
	case "xacnhanchuyenKhoPhanKim":
		////////////////Dung Transaction////////////////
		sleep(3);
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = $tablehachtoanold = $tablectchuyen = $rsmaphieukho = '';
			$idmaphieukho = $idhachtoan = 0;
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
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
			$idmaphieukho = $rsn['idmaphieukho'];
			$idhachtoan = $idmaphieukho;
			//die('tablehachtoanold: '. $tablehachtoanold . '  : tablehachtoannew: '. $tablehachtoannew . '  : tablectchuyen: '. $tablectchuyen . ' : tablenhan: '. $tablenhan);
			if(!empty($tablehachtoannew) && !empty($tablectchuyen) && !empty($tablenhan)){
				//////// Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho vd: kho_giamdockynhan////////////////////
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
				$arrnx['typechuyen'] = 2; ///////// typechuyen 1 chờ nhập, 2 xác nhận đã nhập
				$arrnx['datechuyen'] = $datenow;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				
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
				//die(' :tablehachtoanold: '.$tablehachtoanold .' :tablectchuyen: '.$tablectchuyen . ' :idhachtoan: '.$idhachtoan . ' :type: '.$type );
				ghiSoHachToanKhoSanXuatPhanKim($tablehachtoannew,$tablenhan, $id);
				//sleep(2);
				ghiSoHachToanPhanKim($tablehachtoanold,$tablectchuyen, $idhachtoan, 'xuatkho');
				$error = 'success';
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
	
	case "xacnhanchuyenKhoKhacKhoThanhPhamVanPhong":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$arr['phongban'] = $cid;
			$arr['type'] = 2;
			
			$arr['timechuyen'] = $timnow;
			$arr['datechuyen'] = $datenow;
			$arr['time'] = $timnow;
			$arr['dated'] = $datenow;
			vaUpdate('khokhac_khothanhphamnhaxuongvanphong', $arr ,' id='.$id);
			
			//////////////////ghi vào sổ đầu kỳ(hạch toán) vào table chuyển đến vd:khoachin_sodudauky
			ghiSoHachToanVang('khokhac_khothanhphamnhaxuongvanphong_sodudauky','khokhac_khothanhphamnhaxuongvanphong', $id);
			$error = 'success';
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}		
	break;
	/*
	case "tralaichuyenKhosauchetac":	
		$arr['phongban'] = $cid; // phòng trả lại 170 Kho Tổng Dẻ Cụt -> Xuất Kho (chế tác)
		$arr['tralai'] = 1; ////// 1 trả lại, 0 bình thường
		$arr['typesauchetac'] = 1;
		vaUpdate('khokhac_khotongdecuc', $arr ,' id='.$id);
		$error = 'success';
	break;
	*/
	case "chuyenkhosauchetac":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			if($cid == 178){/// chuyển đến kho sau chế tác
				$arr['phongban'] = $cid; // kho sau chế tác
				$arr['tralai'] = 0;
				$arr['datechuyen']= $datenow;
				$arr['timechuyen']= $timnow;
				vaUpdate('khokhac_khotongdecuc', $arr ,' id='.$id);
				$error = 'success';
			}
			else{/// chuyển đến kho giám đốc ký nhận
				$sqlcopy = $item = $sqlcount = '';
				$sqlcopy = "select * from $GLOBALS[db_sp].khokhac_khotongdecuc where id=".$id;
				$item = $GLOBALS['sp']->getRow($sqlcopy);
					
				$sqlcount = "select * from $GLOBALS[db_sp].khotongdecuc_giamdockynhan where maphieu='".$item['maphieu']."' and idmaphieukho=".$id." and phongbanchuyen=".$phongbanchuyen;
				$count = ceil(count($GLOBALS['sp']->getAll($sqlcount)));
				if($count == 0){
										
					$arr['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
					$arr['cid'] = $cid;
					$arr['idmaphieukho'] = $id;
					$arr['idctnx'] = $item['idctnx'];
					$arr['maphieu'] = $item['maphieu'];
					
					$arr['idloaivang'] = $item['idloaivang'];
					$arr['trongluongvangsauchetac'] = $item['trongluongvangsauchetac'];
					$arr['tuoivangsauchetac'] = $item['tuoivangsauchetac'];
					$arr['tongtlvangcat'] = $item['tongtlvangcat'];
					$arr['tongtlvangchetac'] = $tongtlvangchetac;
					$arr['hoiche'] = $item['hoiche'];
					//$arr['hao'] = $item['hao'];
					//$arr['du'] = $item['du'];
					$arr['ghichu'] = $item['ghichu'];
					$arr['type'] = 1;
					$arr['dated']= $datenow;
					$arr['time']= $timnow;
					
					$arr['datechuyen']= $datenow;
					$arr['timechuyen']= $timnow;
					$arr['phongbanchuyen'] = $phongbanchuyen;
					$arr['trangthai'] = 0;
					
					vaInsert('khotongdecuc_giamdockynhan',$arr);
					////////////cập nhập xuất kho trang thay đơn hàng đang chờ trangthaichuyen = 1			
					$arrnx['phongban'] = $cid; // kho sau chế tác
					$arrnx['trangthai'] = 1;
					$arrnx['tralai'] = 0;
					$arrnx['datechuyen']= $datenow;
					$arrnx['timechuyen']= $timnow;
					vaUpdate('khokhac_khotongdecuc', $arrnx ,' id='.$id);
					$error = 'success';
				}
				else{
					$error = 'Toa hàng nãy đã được chuyển đến phòng chờ, vui lòng liên hệ với admin để được xử lý.';	
				}
			}
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}	
		
	break;
	case "xacnhanchuyenKhosauchetac":
	/*
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$arr['phongban'] = $cid; // phòng trả lại 190 Kho Sau Chế Tác -> Xuất Kho
			$arr['typesauchetac'] = 2;
			vaUpdate('khokhac_khotongdecuc', $arr ,' id='.$id);
			$error = 'success';
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}
*/		
		////////////////Dung Transaction////////////////
		sleep(3);
		$GLOBALS["sp"]->BeginTrans();
		try{
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = '';
			$tablehachtoanold = $tablectchuyen = $sqlktdcuc = $rsktdcuc = '';
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
			$tablehachtoannew = $rsnow['tablehachtoan'];
			
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);

			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablehachtoanold = $rstc['tablehachtoan'];
			$tablectchuyen = $rstc['tablect'];
			
			//die(' tablehachtoanold:' . $tablehachtoanold .' tablectchuyen:' . $tablectchuyen .' tablenhan:' . $tablenhan . ' tablehachtoannew:' . $tablehachtoannew);
			if(!empty($tablehachtoanold) && !empty($tablectchuyen) && !empty($tablenhan) && !empty($tablehachtoannew)){
				$arr['phongban'] = $cid; // phòng trả lại 190 Kho Sau Chế Tác -> Xuất Kho
				$arr['typesauchetac'] = 2;
				
				$arr['trangthaitongdecuc'] = 2;
				$arr['timexuattongdecuc'] = $timnow;
				$arr['datedxuattongdecuc'] = $datenow;
				
				//print_r($arr); die();
			
				vaUpdate('khokhac_khotongdecuc', $arr ,' id='.$id);
				$error = 'success';
				
				//////////////////ghi vào sổ đầu kỳ(hạch toán) vào table chuyển đến vd:khoachin_sodudauky
				//////hạch toán kho tổng dẻ cực all loại vàng cắt
				$sqlktdcuc = "select * from $GLOBALS[db_sp].khokhac_khotongdecucsauchetac where idctnx=".$id;
				$rsktdcuc = $GLOBALS['sp']->getAll($sqlktdcuc);
				foreach($rsktdcuc as $item){
					$cangnangvh = $cangnangh = $cangnangv = $idloaivang = 0;
					$cangnangvh = $cangnangv = $item['tlvangcat'];
					$idloaivang = $item['idloaivangcat'];
					ghiSoHachToanTongKhoDeCucXuat($idloaivang, $cangnangvh,$cangnangv);
				}

				ghiSoHachToan($tablehachtoannew,$tablenhan, $id, 'nhapkho'); /////xac nhân điều kiệu là nhập kho
				$error = 'success';
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
	case "tralaichuyenKhosauchetac":
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$arr['phongban'] = $cid; // phòng trả lại 170 Kho Tổng Dẻ Cụt -> Xuất Kho (chế tác)
			$arr['tralai'] = 1; ////// 1 trả lại, 0 bình thường
			$arr['typesauchetac'] = 1;
			vaUpdate('khokhac_khotongdecuc', $arr ,' id='.$id);
			$error = 'success';
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}		
	break;
	
	case "xacnhanchuyenGiamDocKyNhanKhoDeCucPhanKim":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqln = $rsn = '';
			//////// Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho vd: kho_giamdockynhan////////////////////
			$sqln = "select * from $GLOBALS[db_sp].khotongdecuc_giamdockynhan where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
			$arrnx['type'] = 2;
			$arrnx['timechuyen'] = $timnow;
			$arrnx['datechuyen'] = $datenow;
			$arrnx['time'] = $timnow;
			$arrnx['dated'] = $datenow;
			vaUpdate('khotongdecuc_giamdockynhan', $arrnx ,' id='.$rsn['id']);
			
			//////// Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
			$arrch['phongban'] = $cid; // phòng trả lại 190 Kho Sau Chế Tác -> Xuất Kho
			$arrch['typesauchetac'] = 2;
			$arrch['trangthai'] = 2;
			$arrch['timexuat'] = $timnow;
			$arrch['datedxuat'] = $datenow;
			vaUpdate('khokhac_khotongdecuc', $arrch ,' id='.$rsn['idmaphieukho']);
			$error = 'success';
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}
	break;
	
	case "tralaiGiamDocKyNhanKhoDeCucPhanKim":
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqln = $rsn = '';
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].khotongdecuc_giamdockynhan where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			////////xóa trong kho đó khi trả về không chấp nhận duyệt
			$sql="delete from $GLOBALS[db_sp].khotongdecuc_giamdockynhan  where id = ".$rsn['id'];
			$GLOBALS["sp"]->execute($sql);
		
			$arrnx['phongban'] = $cid; // phòng trả lại 170 Kho Tổng Dẻ Cụt -> Xuất Kho (chế tác)
			$arrnx['tralai'] = 1; ////// 1 trả lại, 0 bình thường
			$arrnx['typesauchetac'] = 1;
			$arrnx['trangthai'] = 0;
			vaUpdate('khokhac_khotongdecuc', $arrnx ,' maphieu="'.$rsn['maphieu'].'" and id='.$rsn['idmaphieukho']);
			$error = 'success';	
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}	

	break;
	
	case "chuyenkhoSauchetacGiamDoc":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sql = $rs = $sqltc = $rstc = $tablenhan = $tablechuyen = $sqlcopy = $item = $sqlcount = '';
			$count = 0;
			///////////Load dữ liệu trong bảng categories để lây table cần insert đưa vô
			$sql = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rs = $GLOBALS['sp']->getRow($sql);
			
			///////////Load dữ liệu trong bảng categories để lây table chuyển
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$phongbanchuyen;
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			if(!empty($rs['table']) && !empty($rstc['tablect'])){
				$tablenhan = $rs['tablect'];
				$tablechuyen = $rstc['tablect'];
				//die($tablenhan . ' :: '. $tablechuyen);
				$sqlcopy = "select * from $GLOBALS[db_sp].".$tablechuyen." where id=".$id;
				$item = $GLOBALS['sp']->getRow($sqlcopy);
					
				$sqlcount = "select * from $GLOBALS[db_sp].".$tablenhan." where maphieu='".$item['maphieu']."' and idmaphieukho=".$id." and phongbanchuyen=".$phongbanchuyen;
				$count = ceil(count($GLOBALS['sp']->getAll($sqlcount)));
				if($count == 0){
					if(!empty($typeKhoDau)){
						$typeKho = explode('_',$typeKhoDau);
						$arr['typekho'] = $typeKho[0];
					}
					$arr['typekhodau'] = $typeKhoDau;
					
					$arr['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
					$arr['cid'] = $cid;
					$arr['idmaphieukho'] = $id;
					$arr['idctnx'] = $item['idctnx'];
					$arr['maphieu'] = $item['maphieu'];
					
					$arr['idloaivang'] = $item['idloaivang'];
					$arr['cannangvh'] = $item['cannangvh'];
					$arr['cannangh'] = $item['cannangh'];
					$arr['cannangv'] = $item['cannangv'];
					
					if($cid == 169){/// chuyển đến kho tổng dẻ cụt, tạo tự động nhóm nguyên liệu và tên nguyên liệu lấy danh  mục kho a chin
						$arr['nhomnguyenlieuvang'] = 75;
						$arr['tennguyenlieuvang'] = 82;  //Dẻ cụt có tuổi
						$arr['slcannangvcon'] = $arr['cannangv'];
					}
					
					if($typeKhoDau != 'khokhac_khosauchetac' && $arr['typekho'] != 'khosanxuat'){ /// khac 2 kho : kho sau chế tác và kho sản xuất mới lưu những cột này
						$arr['trongluongvangsauchetac'] = $item['trongluongvangsauchetac'];
						$arr['tuoivangsauchetac'] = $item['tuoivangsauchetac'];
						$arr['tongtlvangcat'] = $item['tongtlvangcat'];
						$arr['tongtlvangchetac'] = $tongtlvangchetac;
						$arr['hoiche'] = $item['hoiche'];
						//$arr['hao'] = $item['hao'];
						//$arr['du'] = $item['du'];
					}
					else{
						$arr['tuoivang'] = $item['tuoivangsauchetac'];	
					}
					
					if($cid != 169)
						$arr['typechuyen'] = 1;
						
					$arr['ghichuvang'] = $item['ghichu'];
					$arr['ghichu'] = $item['ghichu'];
					$arr['type'] = 1;
					$arr['dated']= $item['dated'];
					$arr['time']= $timnow;
					
					$arr['datechuyen']= $datenow;
					$arr['timechuyen']= $timnow;
					$arr['phongbanchuyen'] = $phongbanchuyen;
					$arr['trangthai'] = 0;
					
					vaInsert($tablenhan,$arr);
					//print_r($arr); die($tablenhan);
					////////////cập nhập xuất kho trang thay đơn hàng đang chờ trangthaichuyen = 1
					$arrnx['phongban'] = $cid;
					$arrnx['trangthai'] = 1;
					$arrnx['datechuyen']= $datenow;
					$arrnx['timechuyen']= $timnow;
					vaUpdate($tablechuyen, $arrnx ,' id='.$id);
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
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}	
	break;
	
	case "chuyenkhokhac":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
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
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $e->getMessage();;
		}	
	break;

	case "xacnhanchuyen":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $sqln = $rsn = $sqltc = $rstc = $tablehachtoan = $tablectchuyen = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablehachtoan = $rstc['tablehachtoan'];
			$tablectchuyen = $rstc['tablect'];
			
			if(!empty($tablehachtoan) && !empty($tablectchuyen)){
				//////// Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho vd: kho_giamdockynhan////////////////////
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
				$arrnx['type'] = 2;
				$arrnx['datechuyen'] = $datenow;
				$arrnx['timechuyen'] = $timnow;
				
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				if($cid == 149 || $cid == 395 || $cid == 284 || $cid == 305 || $cid == 363 || $cid == 365 || $cid == 366){///// Kho thành phẩm( Kho Giám Đốc Ký Nhận) -> Kho Kim Cương Nhập Hột, Kho Nhà Xưởng Giao Nữ Trang(KTP)
					$arrnx['typegiaonhan'] = 3;	
					$arrnx['matho'] = 21;	
				}
				else if($cid == 282 || $cid == 375){
					$arrnx['typegiaonhan'] = 3;	
					$arrnx['matho'] = 14;		
				}
				//die($tablenhan . '::' . $tablectchuyen);
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				//////// Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;

				vaUpdate($tablectchuyen, $arrch ,' maphieu="'.$rsn['maphieu'].'" and id='.$rsn['idmaphieukho']);
				//////////////////ghi vào sổ đầu kỳ(hạch toán) vào table chuyển đến vd:khoachin_sodudauky
				ghiSoHachToan($tablehachtoan,$tablenhan, $id, '');
				if(trim($rsn['typekhodau']) == 'khosanxuat_nuatrangkimcuong' && trim($rsn['idloaivang']) == 2){
					$arrnx['idloaivang'] = 12; //loai vàng VT5.58 
					$arrnx['cannangv'] = $rsn['cannangvh'];
					vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				}
				
				$error = 'success';
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
	
	case "xacNhanChuyenHachToan2Lan":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = $tablehachtoanold = $tablectchuyen = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
			$tablehachtoannew = $rsnow['tablehachtoan'];
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablehachtoanold = $rstc['tablehachtoan'];
			$tablectchuyen = $rstc['tablect'];
			
			//die($tablectchuyen . '::' .$sqln);
			//die( ' tablehachtoanold: ' .$tablehachtoanold . ' tablectchuyen: ' . $tablectchuyen . ' tablenhan: ' . $tablenhan  . ' tablehachtoannew: ' . $tablehachtoannew);
			if(!empty($tablehachtoanold) && !empty($tablectchuyen) && !empty($tablenhan) && !empty($tablehachtoannew)){
				//////// Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho vd: kho_giamdockynhan////////////////////
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
				$arrnx['type'] = 2;
				$arrnx['datechuyen'] = $datenow;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['typegiaonhan'] = $rsnow['typegiaonhan'];
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				
				//print_r($arrnx); die('xx:'.$rsn['id']);
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				
				//die('xxxx'. $rsn['idmaphieukho']);
				//////// Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;

				vaUpdate($tablectchuyen, $arrch ,' maphieu= "'.$rsn['maphieu'].'" and  id='.$rsn['idmaphieukho']);
				//////////////////ghi vào sổ đầu kỳ(hạch toán) vào table chuyển đến vd:khoachin_sodudauky
				if($tablectchuyen == 'khokhac_khophankim' ){// hach toan kho khác kho phan kim
					ghiSoHachToanPhanKim($tablehachtoanold,$tablectchuyen, $rsn['idmaphieukho'], '');
				}
				else if($tablectchuyen == 'bot_khobot'){
					/////////////select phiêu bột đã xuất
					$sqlkbot = "select * from $GLOBALS[db_sp].bot_khobot where idchonphieunhap=".$rsn['idmaphieukho'];
					$rskbot = $GLOBALS['sp']->getAll($sqlkbot);
					if(ceil(count($rskbot)) > 0){
						foreach($rskbot as $itemkbot){ // hạch toán từng phiếu của kho bột
							clearstatcache();
							unset($arrkbot);
							$arrkbot = array();
							
							$arrkbot['timexuat'] = $timnow;
							$arrkbot['datedxuat'] = $datenow;	
							$arrkbot['trangthai'] = 2;
							vaUpdate('bot_khobot', $arrkbot ,' id='.$itemkbot['id']);
							ghiSoHachToan($tablehachtoanold,$tablectchuyen, $itemkbot['id'], 'xuatkho');
						}
					}
					////////
					hachToanHaoDuAdd(ceil($rsn['idloaivang']), $rsn['haochuyen'], $rsn['duchuyen'], 0, 0, $datenow, 'bot_khobot_sodudauky');	
				}
				else
					ghiSoHachToan($tablehachtoanold,$tablenhan, $id, '');
					
				ghiSoHachToan($tablehachtoannew,$tablenhan, $id, 'nhapkho'); /////xac nhân điều kiệu là nhập kho
				$error = 'success';
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
	
	case "tralaichuyen":
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $rsnow = $sqln = $rsn = $sqltc = $rstc = $tablectchuyen = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
					
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablectchuyen = $rstc['tablect'];

			////////xóa trong kho đó khi trả về không chấp nhận duyệt
			$sql="delete from $GLOBALS[db_sp].".$tablenhan."  where id = ".$rsn['id'];
			$GLOBALS["sp"]->execute($sql);
			
			if($rsn['typekho'] == 'khosanxuat')//////trả  lại kho sản xuất
				$arrnx['type'] = 2;
				
			$arrnx['phongban'] = $rsn['phongbanchuyen'];
			$arrnx['trangthai'] = 0;
			$arrnx['tralai'] = 1;
			//print_r($arrnx); die($rsn['idmaphieukho']);

			vaUpdate($tablectchuyen, $arrnx ,' maphieu="'.$rsn['maphieu'].'" and id='.$rsn['idmaphieukho']);
			$error = 'success';
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}
		
	break;
	
	case "chuyenkholammoi":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sql = $rs = $sqltc = $rstc = $tablenhan = $tablechuyen = $sqlcopy = $item = $sqlcount = '';
			///////////Load dữ liệu trong bảng categories để lây table cần insert đưa vô
			$sql = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rs = $GLOBALS['sp']->getRow($sql);
			
			///////////Load dữ liệu trong bảng categories để lây table chuyển
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$phongbanchuyen;
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			if(!empty($rs['table']) && !empty($rstc['tablect'])){
				$tablenhan = $rs['tablect'];
				$tablechuyen = $rstc['table'];
				$sqlcopy = "select * from $GLOBALS[db_sp].".$tablechuyen." where id=".$id;
				$item = $GLOBALS['sp']->getRow($sqlcopy);
					
				$sqlcount = "select * from $GLOBALS[db_sp].".$tablenhan." where maphieu='".$item['maphieu']."' and idmaphieukho=".$id." and phongbanchuyen=".$phongbanchuyen;
				$count = ceil(count($GLOBALS['sp']->getAll($sqlcount)));
				if($count == 0){
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
					
					$arr['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
					$arr['cid'] = $cid;
					$arr['idmaphieukho'] = $id;
					$arr['maphieu'] = $item['maphieu'];
					$arr['idloaivang'] = $item['idloaivang'];
					$arr['cannangvh'] = $item['cannangvh'];
					$arr['cannangh'] = $item['cannangh'];
					$arr['cannangv'] = $item['cannangv'];
					
					if(!empty($arrayTableNhan['iddhsx']))
						$arr['iddhsx'] = $item['iddhsx'];
					if(!empty($arrayTableNhan['madonhangsx']))
						$arr['madonhangsx'] = $item['madonhangsx'];
					if(!empty($arrayTableNhan['trongluongvangtrenso']))
						$arr['trongluongvangtrenso'] = $item['trongluongvangtrenso'];
					if(!empty($arrayTableNhan['trongluongvangcan']))
						$arr['trongluongvangcan'] = $item['trongluongvangcan'];
					if(!empty($arrayTableNhan['typechuyen']))
						$arr['typechuyen'] = 1;
					$arr['haochuyen'] = $item['hao'];
					$arr['duchuyen'] = $item['du'];
					$arr['ghichu'] = $item['ghichu'];
					$arr['dated'] = $datenow;
			
					$arr['datechuyen']= $datenow;
					$arr['timechuyen']= $timnow;
					$arr['phongbanchuyen'] = $phongbanchuyen;
					$arr['type'] = 1;
					$arr['trangthai'] = 0;
					vaInsert($tablenhan,$arr);
					
					////////////cập nhập xuất kho trang thay đơn hàng đang chờ trangthaichuyen = 1
					$arrnx['phongban'] = $cid;
					$arrnx['trangthai'] = 1;
					$arrnx['datechuyen']= $datenow;
					$arrnx['timechuyen']= $timnow;
					vaUpdate($tablechuyen, $arrnx ,' id='.$id);
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
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}
		
	break;
	
	case "tralaikholammoi":
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $sqln = $rsn = $sqltc = $rstc = $tablectchuyen = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
				
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablectchuyen = $rstc['table'];
			
			////////xóa trong kho đó khi trả về không chấp nhận duyệt
			$sql="delete from $GLOBALS[db_sp].".$tablenhan."  where id = ".$rsn['id'];
			$GLOBALS["sp"]->execute($sql);
			
			$arrnx['phongban'] = $rsn['phongbanchuyen'];
			$arrnx['trangthai'] = 0;
			$arrnx['tralai'] = 1;
			//die($tablectchuyen);
			vaUpdate($tablectchuyen, $arrnx ,' maphieu="'.$rsn['maphieu'].'" and id='.$rsn['idmaphieukho']);
			$error = 'success';
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}
	break;
	case "xacnhanchuyenkholammoi":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $sqln = $rsn = $sqltc = $rstc = $tablehachtoan = $tablectchuyen = $sqlklmsct = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			
			$tablehachtoan = $rstc['tablehachtoan'];
			$tablectchuyen = $rstc['table'];

			if(!empty($tablectchuyen) && !empty($tablectchuyen)){
				//////// Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho vd: kho_giamdockynhan////////////////////
				$arrnx['type'] = 2;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['datechuyen'] = $datenow;
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				$arrnx['typegiaonhan'] = $rsnow['typegiaonhan'];
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				//////// Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;
				vaUpdate($tablectchuyen, $arrch ,' id='.$rsn['idmaphieukho']);
				//die($id .' :: '. $tablenhan);
				//////////////////ghi vào sổ đầu kỳ(hạch toán) vào table chuyển đến vd:khoachin_sodudauky
				ghiSoHachToan($tablehachtoan,$tablenhan, $id, '');
				$error = 'success';
				
				////////////////update trang tháy khokhac_kholammoict
				$sqlklmsct = "select idctnx from $GLOBALS[db_sp].khokhac_kholammoisauct where idct=".$rsn['idmaphieukho'];
				$idctnx = $GLOBALS['sp']->getOne($sqlklmsct);
				if(!empty($idctnx)){
					$sqlklmct = "select * from $GLOBALS[db_sp].khokhac_kholammoict where id in (".$idctnx.") ";
					$rsklmct = $GLOBALS['sp']->getAll($sqlklmct);	
					foreach($rsklmct as $item){
						$arrupdate = array();
						$id = $item['id'];
						$arrupdate['timexuat'] = $timnow;
						$arrupdate['datedxuat'] = $datenow;
						$arrupdate['trangthai'] = 2;
						vaUpdate('khokhac_kholammoict',$arrupdate,' id='.$id);	
					}
				}
				$error = 'success';
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
	
	case "xacnhanchuyenKhoEpTemKimCuong":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = $tablehachtoanold = $tablectchuyen = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
			$tablehachtoannew = $rsnow['tablehachtoan'];
			
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablehachtoanold = $rstc['tablehachtoan'];
			$tablectchuyen = $rstc['tablect'];

			if(!empty($tablehachtoanold) && !empty($tablectchuyen) && !empty($tablenhan) && !empty($tablehachtoannew)){
				//////// Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho vd: kho_giamdockynhan////////////////////
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
				$arrnx['type'] = 2;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['datechuyen'] = $datenow;
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				//////// Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;
				vaUpdate($tablectchuyen, $arrch ,' id='.$rsn['idmaphieukho']);
				
				///////////copy ra thêm 1 abngr vào table khokhac_khokimcuongeptemct
				$arr['nhomnguyenlieukimcuongs'] = $rsn['nhomnguyenlieukimcuong'];
				$arr['tennguyenlieukimcuongs'] = $rsn['tennguyenlieukimcuong'];
				$arr['idkimcuongs'] = $rsn['idkimcuong'];
				$arr['codegdpnjs'] = $rsn['codegdpnj'];
				$arr['codecgtas'] = $rsn['codecgta'];
				$arr['kichthuocs'] = $rsn['kichthuoc'];
				$arr['trongluonghots'] = $rsn['trongluonghot'];
				$arr['dotinhkhiets'] = $rsn['dotinhkhiet'];
				$arr['capdomaus'] = $rsn['capdomau'];
				$arr['domaibongs'] = $rsn['domaibong'];
				$arr['kichthuocbans'] = $rsn['kichthuocban'];
				$arr['tienmatkimcuongs'] = $rsn['tienmatkimcuong'];
				$arr['dongiabans'] = $rsn['dongiaban'];
				$arr['ghichukimcuongs'] = $rsn['ghichukimcuong'];
				vaUpdate('khokhac_khokimcuongeptemct', $arr ,' id='.$rsn['id']);
				
				//////////////////ghi vào sổ đầu kỳ(hạch toán) vào table chuyển đến vd:khoachin_sodudauky
				ghiSoHachToan($tablehachtoanold,$tablenhan, $id, '');
				ghiSoHachToan($tablehachtoannew,$tablenhan, $id, 'nhapkho'); /////xac nhân điều kiệu là nhập kho
				$error = 'success';
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
	
	case "chuyenKhoEpTemKimCuong":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sql = $rs = $sqltc = $rstc = $tablenhan = $tablechuyen = $sqlcopy = $item = $sqlcount = '';
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
					//$sqlcopy = "select * from $GLOBALS[db_sp].".$tablechuyen." where id=".$id;
					//$item = $GLOBALS['sp']->getRow($sqlcopy);
					
					$arr['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
					$arr['cid'] = $cid;
					$arr['idmaphieukho'] = $id;
					$arr['idctnx'] = $item['idctnx'];
					$arr['maphieu'] = $item['maphieu'];
									
					$arr['nhomnguyenlieukimcuong'] = $item['nhomnguyenlieukimcuongs'];
					$arr['tennguyenlieukimcuong'] = $item['tennguyenlieukimcuongs'];
					$arr['idkimcuong'] = $item['idkimcuongs'];
					$arr['codegdpnj'] = $item['codegdpnjs'];
					$arr['codecgta'] = $item['codecgtas'];
					$arr['kichthuoc'] = $item['kichthuocs'];
					$arr['trongluonghot'] = $item['trongluonghots'];
					$arr['dotinhkhiet'] = $item['dotinhkhiets'];
					$arr['capdomau'] = $item['capdomaus'];
					$arr['domaibong'] = $item['domaibongs'];
					$arr['kichthuocban'] = $item['kichthuocbans'];
					$arr['tienmatkimcuong'] = $item['tienmatkimcuongs'];
					$arr['dongiaban'] = $item['dongiabans'];
					$arr['ghichukimcuong'] = $item['ghichukimcuongs'];
					$arr['trangthaighichu'] = $item['trangthaighichu'];
					$arr['type'] = 1;
					$arr['typevkc'] = 2;
					$arr['dated'] = $item['dated'];
					$arr['time']= $timnow;
					
					$arr['datechuyen']= $datenow;
					$arr['timechuyen']= $timnow;
					$arr['phongbanchuyen'] = $phongbanchuyen;
					$arr['phongban'] = $cid;
					$arr['trangthai'] = 0;
					//die('tablenhan: '.$tablenhan .' tablechuyen: '.$tablechuyen);
					vaInsert($tablenhan,$arr);
					////////////cập nhập xuất kho trang thay đơn hàng đang chờ trangthaichuyen = 1
					$arrnx['trangthai'] = 1;
					$arrnx['datechuyen']= $datenow;
					$arrnx['timechuyen']= $timnow;
					vaUpdate($tablechuyen, $arrnx ,' id='.$id);
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
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}
	break;
	
	case "xacnhanchuyenKhoSauCheTacGiamDocKyNhan":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = $tablectchuyen = $tablehachtoanold = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
			$tablehachtoannew = $rsnow['tablehachtoan'];
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablectchuyen = $rstc['tablect'];
			$tablehachtoanold = $rstc['tablehachtoan'];
			//die('  tablectchuyen: '. $tablectchuyen . '  tablehachtoanold: '. $tablehachtoanold . '  tablenhan: '. $tablenhan . '  tablehachtoannew: '. $tablehachtoannew );
			if(!empty($tablectchuyen) && !empty($tablehachtoanold) && !empty($tablenhan)){
				//////// Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho vd: kho_giamdockynhan////////////////////
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
				$arrnx['type'] = 2;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['datechuyen'] = $datenow;
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				$arrnx['typegiaonhan'] = $rsnow['typegiaonhan'];
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				
				//////// Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['dated'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;
				vaUpdate($tablectchuyen, $arrch ,'  maphieu="'.$rsn['maphieu'].'" and id='.$rsn['idmaphieukho']);
				//////////////////ghi vào sổ đầu kỳ(hạch toán) vào table chuyển đến vd:khoachin_sodudauky
				ghiSoHachToan($tablehachtoanold,$tablenhan, $id, '');
				//ghiSoHachToan($tablehachtoannew,$tablenhan, $id, 'nhapkho'); /////xac nhân điều kiệu là nhập kho
				$error = 'success';
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
	
	case "xacnhanchuyenKhoEpTemSauKimCuong":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = $tablectchuyen = $tablehachtoanold = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
			$tablehachtoannew = $rsnow['tablehachtoan'];
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablectchuyen = $rstc['tablect'];
			$tablehachtoanold = $rstc['tablehachtoan'];
			//die('  tablectchuyen: '. $tablectchuyen . '  tablehachtoanold: '. $tablehachtoanold . '  tablenhan: '. $tablenhan . '  tablehachtoannew: '. $tablehachtoannew );
			if(!empty($tablectchuyen) && !empty($tablehachtoanold) && !empty($tablenhan) && !empty($tablehachtoannew)){
				//////// Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho vd: kho_giamdockynhan////////////////////
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
				$arrnx['type'] = 2;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['datechuyen'] = $datenow;
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				$arrnx['typegiaonhan'] = $rsnow['typegiaonhan'];
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				
				//////// Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['dated'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;
				vaUpdate($tablectchuyen, $arrch ,'  maphieu="'.$rsn['maphieu'].'" and id='.$rsn['idmaphieukho']);
				//////////////////ghi vào sổ đầu kỳ(hạch toán) vào table chuyển đến vd:khoachin_sodudauky
				ghiSoHachToan($tablehachtoanold,$tablenhan, $id, '');
				ghiSoHachToan($tablehachtoannew,$tablenhan, $id, 'nhapkho'); /////xac nhân điều kiệu là nhập kho
				$error = 'success';
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
	case "xacnhanchuyenKhoEpTemSauKimCuongGiamDocKyNhan":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $sqln = $sqln = $rsn = $sqltc = $rstc = $tablectchuyen = $tablehachtoanold = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablectchuyen = $rstc['tablect'];
			$tablehachtoanold = $rstc['tablehachtoan'];
			//die('  tablectchuyen: '. $tablectchuyen . '  tablehachtoanold: '. $tablehachtoanold . '  tablenhan: '. $tablenhan . '  tablehachtoannew: '. $tablehachtoannew );
			if(!empty($tablehachtoanold) && !empty($tablenhan)){
				//////// Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho vd: kho_giamdockynhan////////////////////
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
				$arrnx['type'] = 2;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['datechuyen'] = $datenow;
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				$arrnx['typegiaonhan'] = $rsnow['typegiaonhan'];
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				
				//////// Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['dated'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;
				vaUpdate($tablectchuyen, $arrch ,'  maphieu="'.$rsn['maphieu'].'" and id='.$rsn['idmaphieukho']);
				//////////////////ghi vào sổ đầu kỳ(hạch toán) vào table chuyển đến vd:khoachin_sodudauky
				ghiSoHachToan($tablehachtoanold,$tablenhan, $id, '');
				//ghiSoHachToan($tablehachtoannew,$tablenhan, $id, 'nhapkho'); /////xac nhân điều kiệu là nhập kho
				$error = 'success';
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
	
	case "chuyenkhoSauEpTempKimCuong":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sql = $rs = $sqltc = $rstc = $tablenhan = $tablechuyen = $sqlcopy = $item = $sqlcount = '';
			///////////Load Khong có hạch toán kim cương
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
					$arr['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
					$arr['cid'] = $cid;
					$arr['idmaphieukho'] = $id;
					$arr['idctnx'] = $item['idctnx'];
					$arr['maphieu'] = $item['maphieu'];
					
					$arr['typekhodau'] = 'khokhac_khokimcuongsaueptem';
					$arr['typekho'] = 'khokhac';

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
					//$arr['trangthaighichu'] = $item['trangthaighichu'];
					
					$arr['type'] = 1;
					$arr['typevkc'] = $item['typevkc'];
					$arr['dated'] = $item['dated'];
					$arr['time']= $timnow;
					
					$arr['datechuyen']= $datenow;
					$arr['timechuyen']= $timnow;
					$arr['phongbanchuyen'] = $phongbanchuyen;
					$arr['trangthai'] = 0;
					
					vaInsert($tablenhan,$arr);
					//die('xxx');
					////////////cập nhập xuất kho trang thay đơn hàng đang chờ trangthaichuyen = 1
					$arrnx['trangthai'] = 1;
					$arrnx['datechuyen']= $datenow;
					$arrnx['timechuyen']= $timnow;
					vaUpdate($tablechuyen, $arrnx ,' id='.$id);
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
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}	
	break;
	case "tralaichuyenkhokhac":
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $sqln = $rsn = $sqltc = $rstc = $tablectchuyen = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
					
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablectchuyen = $rstc['tablect'];
			
			////////xóa trong kho đó khi trả về không chấp nhận duyệt
			$sql="delete from $GLOBALS[db_sp].".$tablenhan."  where id = ".$rsn['id'];
			$GLOBALS["sp"]->execute($sql);
			$arrnx['tralai'] = 1;
			$arrnx['trangthai'] = 0;
			vaUpdate($tablectchuyen, $arrnx ,' maphieu="'.$rsn['maphieu'].'" and id='.$rsn['idmaphieukho']);
			$error = 'success';
			$GLOBALS["sp"]->CommitTrans();
		}
		catch (Exception $e){
			$GLOBALS["sp"]->RollbackTrans();
			$error = $errorTransetion;
		}	
	break;

	//=========================================VŨ THÊM KHO SẢN XUẤT PHỤ KIỆN=================================================//
	case "xacnhanchuyenKhoSanXuatPhuKien":
		sleep(3);
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = $tablehachtoanold = $tablectchuyen = $rsmaphieukho = '';
			$idmaphieukho = $idhachtoan = 0;
			
			$tablenhan = 'khosanxuat_phukien'; 
			$tablehachtoannew = 'khosanxuat_phukien_sodudauky';			
			
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);

			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablehachtoanold = $rstc['tablehachtoan'];
			$tablectchuyen = $rstc['tablect'];
			
			if($type == 'khosanxuat'){
				$rsmaphieukho = getTableRow($tablectchuyen,' and id='.$rsn['idmaphieukho'].' and maphieu="'.$rsn['maphieu'].'"');
				$idmaphieukho = $rsmaphieukho['id'];
				$idhachtoan = $rsmaphieukho['id'];
			}
			else{
				$idmaphieukho = $rsn['idmaphieukho'];
				$idhachtoan = $idmaphieukho;
			}
			
			if(!empty($tablehachtoannew) && !empty($tablectchuyen) && !empty($tablenhan)){
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
				$arrnx['typechuyen'] = 2; 
				$arrnx['datechuyen'] = $datenow;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;
				
				vaUpdate($tablectchuyen, $arrch ,' id='.$idmaphieukho);
				ghiSoHachToanKhoSanXuatPhuKien($tablehachtoannew,$tablenhan, $id);
				ghiSoHachToanPhuKien($tablehachtoanold,$tablectchuyen, $idhachtoan, 'xuatkho');

				// Hạch toán nhập/ xuất số lượng phụ kiện + cân nặng vàng
				ghiSoHachToanMaPhuKien('khosanxuat_phukienma_sodudauky', $tablenhan, $id);

				$error = 'success';
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
	//=========================================KẾT THÚC KHO SẢN XUẤT PHỤ KIỆN=================================================//
	//=========================================VŨ THÊM KHO BỘT=================================================//
	case "xacnhanchuyenKhoBot":
		sleep(3);
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = $tablehachtoanold = $tablectchuyen = $rsmaphieukho = '';
			$idmaphieukho = $idhachtoan = 0;
			
			$tablenhan = 'bot_khobot'; 
			$tablehachtoannew = 'bot_khobot_sodudauky';			
			
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);

			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablehachtoanold = $rstc['tablehachtoan'];
			$tablectchuyen = $rstc['tablect'];
			
			if($type == 'khosanxuat'){
				$rsmaphieukho = getTableRow($tablectchuyen,' and id='.$rsn['idmaphieukho'].' and maphieu="'.$rsn['maphieu'].'"');
				$idmaphieukho = $rsmaphieukho['id'];
				$idhachtoan = $rsmaphieukho['id'];
			}
			else{
				$idmaphieukho = $rsn['idmaphieukho'];
				$idhachtoan = $idmaphieukho;
			}
			
			if(!empty($tablehachtoannew) && !empty($tablectchuyen) && !empty($tablenhan)){
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
				$arrnx['typechuyen'] = 2; 
				$arrnx['datechuyen'] = $datenow;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;
				
				vaUpdate($tablectchuyen, $arrch ,' id='.$idmaphieukho);
				ghiSoHachToanKhoBot($tablehachtoannew,$tablenhan, $id);				
				ghiSoHachToanBot($tablehachtoanold,$tablectchuyen, $idhachtoan, 'xuatkho');
				$error = 'success';
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
	//========================================KẾT THÚC THÊM KHO BỘT===========================================//
	//==================================VŨ THÊM KHO KHÁC LƯU MẪU==============================================//
	case "xacnhanchuyenVangKhoKhacLuuMau":
		sleep(3);
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = $tablehachtoanold = $tablectchuyen = $rsmaphieukho = '';
			$idmaphieukho = $idhachtoan = 0;
			
			$tablenhan = 'khokhac_luumau'; 
			$tablehachtoannew = 'khokhac_luumau_sodudauky';			
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);

			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablehachtoanold = $rstc['tablehachtoan'];
			$tablectchuyen = $rstc['tablect'];
			
			if($type == 'khosanxuat'){
				$rsmaphieukho = getTableRow($tablectchuyen,' and id='.$rsn['idmaphieukho'].' and maphieu="'.$rsn['maphieu'].'"');
				$idmaphieukho = $rsmaphieukho['id'];
				$idhachtoan = $rsmaphieukho['id'];
			}
			else{
				$idmaphieukho = $rsn['idmaphieukho'];
				$idhachtoan = $idmaphieukho;
			}
			
			if(!empty($tablehachtoannew) && !empty($tablectchuyen) && !empty($tablenhan)){
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
				$arrnx['typechuyen'] = 2; 
				$arrnx['datechuyen'] = $datenow;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;
				
				vaUpdate($tablectchuyen, $arrch ,' id='.$idmaphieukho);
				ghiSoHachToanVangKhoKhacKhoLuuMau($tablehachtoannew,$tablenhan, $id);				
				ghiSoHachToanVangKhoLuuMau($tablehachtoanold,$tablectchuyen, $idhachtoan, 'xuatkho');
				$error = 'success';
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
	//======================//
	case "xacnhanchuyenKimCuongKhoKhacLuuMau":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $tablehachtoannew = $sqln = $rsn = $sqltc = $rstc = $tablehachtoanold = $tablectchuyen = '';			
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
			$tablehachtoannew = $rsnow['tablehachtoan'];
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablehachtoanold = $rstc['tablehachtoan'];
			$tablectchuyen = $rstc['tablect'];			
			
			if(!empty($tablehachtoanold) && !empty($tablectchuyen) && !empty($tablenhan) && !empty($tablehachtoannew)){
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];;
				$arrnx['type'] = 2;
				$arrnx['datechuyen'] = $datenow;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['typegiaonhan'] = $rsnow['typegiaonhan'];
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;

				vaUpdate($tablectchuyen, $arrch ,' maphieu= "'.$rsn['maphieu'].'" and  id='.$rsn['idmaphieukho']);
				ghiSoHachToanKCKhoKhacKhoLuuMau($tablehachtoanold,$tablenhan, $id, 'xuatkho');					
				ghiSoHachToanKCKhoKhacKhoLuuMau($tablehachtoannew,$tablenhan, $id, 'nhapkho'); 
				$error = 'success';
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
	//==================================KẾT THÚC THÊM KHO KHÁC LƯU MẪU==========================================//
	
	
	
	//====================================xác nhân chuyển tách kho từ kho xacnhanchuyen
	case "xacnhanchuyenKhoNhapLieuKhoNguonVao":
		sleep(3);
		////////////////Dung Transaction////////////////
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sqlnow = $rsnow = $tablenhan = $sqln = $rsn = $sqltc = $rstc = $tablehachtoan = $tablectchuyen = '';
			///////////Load dữ liệu trong bảng categories để lây table cần update đưa vô
			$sqlnow = "select * from $GLOBALS[db_sp].categories where id=".$cid;
			$rsnow = $GLOBALS['sp']->getRow($sqlnow);
			$tablenhan = $rsnow['tablect'];
			/////////load table đang thực hiện vd: kho_giamdockynhan
			$sqln = "select * from $GLOBALS[db_sp].".$tablenhan." where id=".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			
			///////////Load dữ liệu trong bảng categories để lây table chi tiết để ghi hạch toán
			$sqltc = "select * from $GLOBALS[db_sp].categories where id=".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablehachtoan = $rstc['tablehachtoan'];
			$tablectchuyen = $rstc['tablect'];
			
			if(!empty($tablehachtoan) && !empty($tablectchuyen)){
				//////// Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho vd: kho_giamdockynhan////////////////////
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
				$arrnx['type'] = 2;
				$arrnx['datechuyen'] = $datenow;
				$arrnx['timechuyen'] = $timnow;
				
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				if($cid == 149 || $cid == 395 || $cid == 284 || $cid == 305 || $cid == 363 || $cid == 365 || $cid == 366){///// Kho thành phẩm( Kho Giám Đốc Ký Nhận) -> Kho Kim Cương Nhập Hột, Kho Nhà Xưởng Giao Nữ Trang(KTP)
					$arrnx['typegiaonhan'] = 3;	
					$arrnx['matho'] = 21;	
				}
				else if($cid == 282 || $cid == 375){
					$arrnx['typegiaonhan'] = 3;	
					$arrnx['matho'] = 14;		
				}
				//die($tablenhan . '::' . $tablectchuyen);
				vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				//////// Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho vd:khonguonvao_khoachinct ////////////////////
				$arrch['timexuat'] = $timnow;
				$arrch['datedxuat'] = $datenow;
				$arrch['phongban'] = $cid;
				$arrch['trangthai'] = 2;

				vaUpdate($tablectchuyen, $arrch ,' maphieu="'.$rsn['maphieu'].'" and id='.$rsn['idmaphieukho']);
				//////////////////ghi vào sổ đầu kỳ(hạch toán) vào table chuyển đến vd:khoachin_sodudauky
				ghiSoHachToan($tablehachtoan,$tablenhan, $id, '');
				if(trim($rsn['typekhodau']) == 'khosanxuat_nuatrangkimcuong' && trim($rsn['idloaivang']) == 2){
					$arrnx['idloaivang'] = 12; //loai vàng VT5.58 
					$arrnx['cannangv'] = $rsn['cannangvh'];
					vaUpdate($tablenhan, $arrnx ,' id='.$rsn['id']);
				}
				
				$error = 'success';
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
	//==================== ANH VŨ THÊM DUYỆT TỒN KHO - ĐÁ TEM HỘP & GIẤY =======
	case 'duyetTonKhoTemGiay':
		sleep(3);
		$GLOBALS["sp"]->BeginTrans();
		try{
			$rstable = getTableRow('categories',' and id='.$cid);
			$table = $rstable['table'];
			$tablehachtoan = $rstable['tablehachtoan'];
			if(!empty($table) && !empty($tablehachtoan)){
				$arr['trangthai'] = 2;
				$arr['midduyet'] = $_SESSION['admin_qlsxntjcorg_id'];
				$arr['time'] = $timenow;
				$arr['dated'] = $datenow;
				vaUpdate($table,$arr,' id='.$id);
				ghiSoHachToanDaTemGiay($table,$tablehachtoan,$id);
				$error = 'success';
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

	case 'xacnhanchuyenkhodatemhop':
		sleep(3);
		$GLOBALS["sp"]->BeginTrans();
		try{
			$sql = "select tablect,tablehachtoan from $GLOBALS[db_sp].categories where id = ".$cid;
			$rs = $GLOBALS['sp']->getRow($sql);
			$tablect = $rs['tablect'];
			$tablehachtoan = $rs['tablehachtoan'];
			if(!empty($tablect) && !empty($tablehachtoan)){
				$arr['midduyet'] = $_SESSION['admin_qlsxntjcorg_id'];
				$arr['time'] = $timenow;
				$arr['dated'] = $datenow;
				$arr['trangthai'] = 2;
				vaUpdate($tablect,$arr,' id='.$id);
				ghiSoHachToanDaTemHop($tablect,$tablehachtoan,$id);
				$error = 'success';
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

	case 'xacnhanchuyenKhoDaTemDa':
		sleep(3);
		$GLOBALS["sp"]->BeginTrans();
		try{
			$rstable = getTableRow('categories',' and id='.$cid);
			$table = $rstable['table'];
			$tablehachtoan = $rstable['tablehachtoan'];
			if(!empty($table) && !empty($tablehachtoan)){
				$arr['trangthai'] = 1;
				$arr['time'] = $timenow;
				$arr['dated'] = $datenow;
				vaUpdate($table,$arr,' id='.$id);
				ghisoHachToanKhoDaTemDa($table,$tablehachtoan,$id);
				$error = 'success';
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
	//==================== KẾT THÚC THÊM DUYỆT TỒN KHO - ĐÁ TEM HỘP & GIẤY =======

	// === ANH VŨ START CHUYỂN KHO TEM ĐÁ ===
	case 'chuyenKhoDaTemDa':
		sleep(3);
		// === Start Transaction ===
		$GLOBALS['sp']->BeginTrans();
		try{
			$sql = $rs = $sqltc = $rstc = $sqlcopy = $item = $sqlcount = '';
			
			$sql = "select tablect from $GLOBALS[db_sp].categories where id = ".$cid;
			$rs = $GLOBALS['sp']->getRow($sql);

			$sqltc = "select tablect from $GLOBALS[db_sp].categories where id = ".$phongbanchuyen;
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablenhan = $rs['tablect'];
			$tablechuyen = $rstc['tablect'];

			$sqlcopy = "select * from $GLOBALS[db_sp].$tablechuyen where id = ".$id;
			$item = $GLOBALS['sp']->getRow($sqlcopy);
			
			$sqlcount = "select id from $GLOBALS[db_sp].$tablenhan where maphieu = '".$item['maphieu']."' and idmaphieukho = ".$id." and phongbanchuyen = ".$phongbanchuyen;
			$count = ceil(count($GLOBALS['sp']->getAll($sqlcount)));
			// === Kiểm tra tồn tại table và tablehachtoan 
			if(!empty($tablenhan) && !empty($tablechuyen)){
				if($count == 0){
					$arr['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
					$arr['mid'] = $item['mid'];
					$arr['cid'] = $cid;
					$arr['phongbanchuyen'] = $phongbanchuyen;
					$arr['idmaphieukho'] = $id;
					$arr['idctnx'] = $item['idctnx'];
					$arr['maphieu'] = $item['maphieu'];
					$arr['cannangvh'] = $item['tongtienda'];
					$arr['cannangv'] = $item['tongtienda'];
					$arr['ghichuvang'] = $item['ghichu'];
					$arr['idloaivang'] = 19;
					$arr['typekhodau'] = 'da_temda';
					$arr['typekho'] = 'da';
					$arr['type'] = 1;
					$arr['typevkc'] = 1;
					$arr['typechuyen'] = 1;
					$arr['trangthai'] = 0;
					$arr['datechuyen'] = $datenow;
					$arr['timechuyen'] = $timenow;
					$arr['dated'] = $datenow;
					$arr['time'] = $timenow;
					if($item['phongbanin'] == 1700){
						$sqltenchinhanh = "select fullname from $GLOBALS[db_sp].admin where id = ".$_SESSION['admin_qlsxntjcorg_id'];
						$tenchinhanh = $GLOBALS['sp']->getOne($sqltenchinhanh);
						$arr['tenchinhanh'] = $tenchinhanh;
					}
					vaInsert($tablenhan,$arr);
					$arrnx['trangthai'] = 1;
					$arrnx['phongban'] = $cid;
					$arrnx['datechuyen'] = $datenow;
					$arrnx['timechuyen'] = $timenow;
					vaUpdate($tablechuyen,$arrnx,' id='.$id);
					$error = 'success';
				}
				else{
					$error = 'Toa hàng nãy đã được chuyển đến phòng chờ, vui lòng liên hệ với admin để được xử lý.';	
				}
				
			}
			else{
				$error = 'Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý';
			}
			$GLOBALS['sp']->CommitTrans();
		}
		catch(Exception $e){
			$GLOBALS['sp']->RollbackTrans();
			$error = $errorTransetion;
		}
		// === End Transaction ===
	break;
	// === ANH VŨ END THÊM DUYỆT TỒN KHO - ĐÁ TEM ĐÁ ===

	// === Anh Vũ start duyet ton kho da tem da ///////////////////////
	case 'xacnhanDuyetDaTemDa':
		sleep(3);
		// === Start Transaction ===
		$GLOBALS['sp']->BeginTrans();
		try{
			// Categories kho nhận
			$sql = "select tablect,tablehachtoan from $GLOBALS[db_sp].categories where id = ".$cid;
			$rs = $GLOBALS['sp']->getRow($sql);
			$tablenhan = $rs['tablect'];
			$tablehachtoannew = $rs['tablehachtoan'];
			// Table kho nhận
			$sqln = "select * from $GLOBALS[db_sp].$tablenhan where id = ".$id;
			$rsn = $GLOBALS['sp']->getRow($sqln);
			// Categories kho chuyển
			$sqltc = "select tablect,tablehachtoan from $GLOBALS[db_sp].categories where id = ".$rsn['phongbanchuyen'];
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablechuyen = $rstc['tablect'];
			$tablehachtoanold = $rstc['tablehachtoan'];
			// Table kho chuyển
			$sqlch = "select * from $GLOBALS[db_sp].$tablechuyen where id = ".$rsn['idmaphieukho'];
			$rsch = $GLOBALS['sp']->getRow($sqlch);

			if(!empty($tablehachtoannew) && !empty($tablechuyen) && !empty($tablenhan)){
				// === Cập nhập table hiện tại trạng thái 2 là đã duyệt chuyển vào kho
				$arrnx['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
				$arrnx['typechuyen'] = 2; // typechuyen 1 chờ nhập, 2 xác nhận đã nhập
				$arrnx['trangthai'] = 2;
				$arrnx['datechuyen'] = $datenow;
				$arrnx['timechuyen'] = $timnow;
				$arrnx['time'] = $timnow;
				$arrnx['dated'] = $datenow;
				vaUpdate($tablenhan, $arrnx ,' id='.$id);
				
				// === Cập nhập table chuyển đến trạng thái 2 là đã duyệt chuyển vào kho
				$arrch['midduyet'] = $_SESSION['admin_qlsxntjcorg_id'];
				$arrch['timexuat'] = $timnow;
				$arrch['datexuat'] = $datenow;
				$arrch['trangthai'] = 2;
				vaUpdate($tablechuyen, $arrch,' id='.$rsn['idmaphieukho']);
				
				if($rsch['phongbanin'] == '811'){
					// === Update Hạch Toán Table tem giấy
					vaUpdate('da_temgiay',$arrch,' id = '.$rsch['idphieutemgiay']);
					ghiSoHachToanDaTemGiay('da_temgiay','da_temgiay_sodudauky',$rsch['idphieutemgiay']);
					// === Update Hạch Toán Table tem hộp
					vaUpdate('da_temhop',$arrch,' id = '.$rsch['idphieutemhop']);
					ghiSoHachToanDaTemHop('da_temhop','da_temhop_sodudauky',$rsch['idphieutemhop']);
				}
				ghisoHachToanKhoDaTemDa($tablechuyen,$tablehachtoanold,$rsn['idmaphieukho']);// === Hạch Toán Kho Chuyển
				
				// === Kiểm tra trangthai = 2 => duyệt phiếu chờ nhập kho trangthai = 2
				$sqlcount = "select count(id) from $GLOBALS[db_sp].$tablechuyen where idctnx = ".$rsn['idctnx']." and trangthai = 2";
				$rscount = $GLOBALS['sp']->getOne($sqlcount);
				if($rscount == 2){
					$arrcount['trangthai'] = 2;
					vaUpdate($tablechuyen,$arrcount,' id='.$rsn['idctnx']);
				}
				$error = 'success';
			}
			else{
				$error = 'Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý';
			}
			$GLOBALS['sp']->CommitTrans();
		}
		catch(Exception $e){
			$GLOBALS['sp']->RollbackTrans();
			$error = $errorTransetion;
		}
	break;

	// === Anh Vũ End duyet ton kho da tem da /////////////////////////


	// === Anh Vũ start trả lại kho tem đá ===
	case 'tralaiKhoDaTemDa':
		sleep(3);
		// === Start Transaction ===
		$GLOBALS['sp']->BeginTrans();
		try{
			$sql = "select tablect from $GLOBALS[db_sp].categories where id = ".$cid;
			$rs = $GLOBALS['sp']->getRow($sql);
			
			$sqltc = "select tablect from $GLOBALS[db_sp].categories where id = ".$phongbanchuyen;
			$rstc = $GLOBALS['sp']->getRow($sqltc);
			$tablenhan = $rs['tablect'];
			$tablechuyen = $rstc['tablect'];
			
			$sqlitem = "select maphieu,idmaphieukho from $GLOBALS[db_sp].$tablechuyen where id = ".$id;
			$item = $GLOBALS['sp']->getRow($sqlitem);
			
			if(!empty($tablenhan) && !empty($tablechuyen)){
				vaDelete($tablechuyen,' id = '.$id);
				$arr['trangthai'] = 0;
				$arr['tralai'] = 1;
				vaUpdate($tablenhan,$arr,' maphieu = "'.$item['maphieu'].'" and id = '.$item['idmaphieukho']);

				$error = 'success';
			}
			else{
				$error = 'Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý';
			}
			
			$GLOBALS['sp']->CommitTrans();
		}
		catch(Exception $e){
			$GLOBALS['sp']->RollbackTrans();
			$error = $errorTransetion;
		}
		// === End Transaction ===	
	break;
	// === Anh Vũ end trả lại kho tem đá ===
}



die(json_encode(array('status'=>$error,'name'=>$name,'soducon'=>$soducon)));

?>