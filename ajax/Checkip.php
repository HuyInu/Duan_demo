<?php
include("../#include/config.php");
include("../functions/function.php");
CheckLogin();
global $path_url,$path_dir;
if(!isset($_SESSION["store_qlsxntjcorg_login"])){
	die('Vui long dang nhap lai');	
}
$arr = array();
$error = "";
$act = isset($_POST['act'])?$_POST['act']:"";
$id =  isset($_POST['id'])?$_POST['id']:"";
switch($act){
	case "updateNgayNhap":
		$arr = array();
		$id = ceil(trim($_POST["id"]));
		$dated = trim($_POST["dated"]);
		$dated = explode('/',$dated);
		$dated = $dated[2].'-'.$dated[1].'-'.$dated[0];
		
		$arr['daynhap']= $dated;
		vaUpdate('kho_giamdockynhan',$arr,' id='.$id);
		$error = 'success';
	break;
	case "checkchonKhoThanhPhamLuuTru":
		$arr = array();
		$error = "success" ;
		$id = ceil(trim($_POST['id']));
		$number = ceil(trim($_POST['number']));
		$arr['checkchon'] = $number;
		vaUpdate('kho_giamdockynhan',$arr,' id='.$id);
		$error = "success" ;
	break;
	case "getLoaiVangOption":
		$idloaivang = ceil(trim($_POST['idloaivang']));
		$sql = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
		$list = '';
		foreach($rs as $item){
			if($item['id'] == $idloaivang)	
				$selected = 'selected="selected"';
			else
				$selected = '';
			$list .= '
				<option value="'.$item['id'].'" '.$selected.'>
					'.$item['name_vn'].'
				</option>
			';
		}
		$error = '
             <option value="">--Chọn loại vàng--</option>
			 '.$list.'
		';
	break;
	case "loadGhichu":
		
		$id = ceil(trim($_POST['id']));
		$sql = "select * from $GLOBALS[db_sp].khokhac_khophankim where id=".$id." limit 1";
		$rs = $GLOBALS["sp"]->getRow($sql);
		$error = $rs['maphieu'].' ('.number_format($rs['cannangv'],3,".",",").') - '.$rs['ghichuvang'] ;
	break;
	
	case "getSLDonHangCatalog":
		$error = "success" ;
		$id = ceil(trim($_POST['id']));
		$sql = "select soluongbandau from $GLOBALS[db_catalog].ordersanxuat where id=".$id; 
		$rs = $GLOBALS["catalog"]->getOne($sql);	
		$name = $rs;
	break;
	
	case "khoSanXuatkiemTraCoLoaiVang":
		$error = "success" ;
		$cid = ceil(trim($_POST['cid']));
		$idloaivang = ceil(trim($_POST['idloaivang']));
		
		$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
		$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
		
		$tablehachtoan = $rsgettable['tablehachtoan'];
		if(!empty($tablehachtoan)){
			$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." limit 1";
			$count = ceil(count($GLOBALS["sp"]->getAll($sql)));
			if($count <= 0){
				$error = "Loại vàng này chưa có nhập vào kho, vui lòng nhập vào kho loại vàng này.";
			}
		}
		else{
			$error = "Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.";		
		}
	break;
	
	case "khoSanXuatkiemTraCoLoaiVangMaPhieuXuat":
		$error = "success" ;
		$id = ceil(trim($_POST['id']));
		$cid = ceil(trim($_POST['cid']));
		$idloaivang = ceil(trim($_POST['idloaivang']));
		$idpx = ceil(trim($_POST['idpx']));
		
		$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
		$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
		
		$tablehachtoan = $rsgettable['tablehachtoan'];
		if(!empty($tablehachtoan)){
			$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." limit 1";
			$count = ceil(count($GLOBALS["sp"]->getAll($sql)));
			if($count <= 0){
				$error = "Loại vàng này chưa có nhập vào kho, vui lòng nhập vào kho loại vàng này." ;
			}
			else{///// kiểm tra file này đã chọn rồi hay chưa
				if($id > 0)
					$sqlpx = "select * from $GLOBALS[db_sp].khosanxuat_khothanhphamhaodu where idpx=".$idpx." and id <> ".$id." limit 1";
				else
					$sqlpx = "select * from $GLOBALS[db_sp].khosanxuat_khothanhphamhaodu where idpx=".$idpx." limit 1";
				$count = ceil(count($GLOBALS["sp"]->getAll($sqlpx)));	
				if($count > 0){
					$error = "Phiếu xuất này đã được chọn rồi, vui lòng chọn phiếu khác." ;
				}
			}
		}
		else{
			$error = "Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.";		
		}
	break;
	
	case "loadLoaivang":
		$idpx = ceil(trim($_POST['idpx']));
		$sqlpx = "select * from $GLOBALS[db_sp].khosanxuat_khothanhpham where id=".$idpx;
		$rspx = $GLOBALS["sp"]->getRow($sqlpx);
		$loaivang = getName('loaivang', 'name_vn', $rspx['idloaivang']);
		
		die(json_encode(array('status'=>'success','maphieu'=>$rspx['maphieu'],'nameloaivang'=>$loaivang,'idloaivang'=>$rspx['idloaivang'])));
	break;
	
	case "UpdateGiaoTho":
		$error = "success" ;
		$id = ceil(trim($_POST['id']));
		$matho = trim($_POST['matho']);
		$table = trim($_POST['table']);
		$arr['matho'] = $matho;
		vaUpdate($table,$arr,' id='.$id);
		$error = "success" ;
	break;
	case "UpdateTTGiaoNhan":
		$error = "success" ;
		$id = ceil(trim($_POST['id']));
		$typegiaonhan = ceil(trim($_POST['typegiaonhan']));
		$arr['typegiaonhan'] = $typegiaonhan;
		vaUpdate('categories',$arr,' id='.$id);
		$error = "success" ;
	break;
	case "updateKimCuongTrangThaiGhiChu":
		$error = "success" ;
		$id = ceil(trim($_POST['id']));
		$trangthaighichu = striptags(trim($_POST['trangthaighichu']));
		$arr['trangthaighichu'] = $trangthaighichu;
		vaUpdate('khokhac_khokimcuongeptemct',$arr,' id='.$id);
		$error = "success" ;
	break;
	case "checkfromtodate":
		$error = "success" ;
		$fromDate = trim($_POST['fromdays']);
		$toDate = trim($_POST['todays']);
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$fromDateshow = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		}
		if(!empty($toDate)){
			$toDate = explode('/',$toDate);
			$toDateshow = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		}
		if(strtotime($fromDateshow) > strtotime($toDateshow)){
			$error = "Từ ngày phải nhỏ hơn hoăc bằng với đến ngày." ;	
		}
	break;
	
	case "checkNameLoaiVang":
		$error = "success" ;
		$name = striptags(trim($_POST['name']));
		$id = ceil(trim($_POST['id']));
		if($id > 0)
			$sql = "select * from $GLOBALS[db_sp].loaivang where name_vn='$name' and id <> $id";
		else
			$sql = "select * from $GLOBALS[db_sp].loaivang where name_vn='$name'";
		$count = ceil(count($GLOBALS["sp"]->getAll($sql)));
		if($count > 0){
			$error = "Tên vàng này đã tồn tại, vui lòng nhập vào Tên khác." ;
		}
	break;
	
	case "checkloaikimcuonghotchu":
		$error = "success" ;
		$name = striptags(trim($_POST['name']));
		$size = striptags(trim($_POST['size']));
		$id = ceil(trim($_POST['id']));
		if($id > 0)
			$sql = "select * from $GLOBALS[db_sp].loaikimcuonghotchu where name_vn='$name' and size='$size' and id <> $id";
		else
			$sql = "select * from $GLOBALS[db_sp].loaikimcuonghotchu where name_vn='$name' and size='$size' ";
		$count = ceil(count($GLOBALS["sp"]->getAll($sql)));
		if($count > 0){
			$error = "Tên và Size này đã tồn tại, vui lòng nhập vào Tên hoặc Size khác." ;
		}
	break;
	
	case "updatedong":
		$error = "success" ;
		$id = ceil(trim($_POST['id']));
		$value = striptags(trim($_POST['str']));
		$cot = striptags(trim($_POST['cot']));
		$table = striptags(trim($_POST['table']));
		
		$arr[$cot] = $value;
		vaUpdate($table,$arr,' id='.$id);
		$error = "success" ;
	break;
	case "gettuoiquydinh":
		$id = ceil(trim($_POST['id']));
		$sql = "select * from $GLOBALS[db_sp].loaivang where id=$id";
		$rs = $GLOBALS["sp"]->getRow($sql);
		$error = $rs['tuoiquydinh'];
		$name = $rs['name_vn'];
	break;
	
	case "checkKhoKhacMaDH":
		$error = "" ;
		$iddhsx = ceil(trim($_POST['iddhsx']));
		if($id > 0)
			$sql = "select count(id) from $GLOBALS[db_sp].khokhac_kholammoi where  iddhsx=$iddhsx and id <> $id";
		else
			$sql = "select count(id) from $GLOBALS[db_sp].khokhac_kholammoi where  iddhsx=$iddhsx";		
		$rs = ceil($GLOBALS["sp"]->getOne($sql));
		if($rs > 0)
			$error = "Mã đơn hàng sản xuất đã được chọn rồi, vui lòng chọn mã đơn hàng khác,";
	break;
	
	case "getKhoKhacKhoLamMoiTheoLVang":
		$idloaivang = ceil(trim($_POST['idloaivang']));
		$list = '';
		$idnumvang = 0;
		$sql = "select * from $GLOBALS[db_sp].khokhac_kholammoict where type=2 and trangthai=0 and idloaivang=$idloaivang order by dated asc, id asc";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$idnumvang = $idnumvang + 1;
			$str .= '
				 <tr>
				 	 <td align="center">
                         <input type="checkbox" value="'.$item['id'].'" name="idctnx[]" id="idctnx" onclick="getTongTLVangTrenSO();">
						 <input type="hidden" name="cannangvang" id="cannangvang'.$item['id'].'" value="'.$item['cannangv'].'" />
						 <input type="hidden" name="idsodong[]"/>
                     </td>
					 <td align="left">
						'.$idnumvang.'
					 </td>
					 <td align="left">
						'.$item['maphieu'].'
					 </td>
					 <td align="left">
						'.getName('categories', 'name_vn', $item['nhomnguyenlieuvang']).'
					 </td>
					 <td align="left">
						 '.getName('categories', 'name_vn', $item['tennguyenlieuvang']).'
					 </td>
					 <td align="left">
						 '.getName('loaivang', 'name_vn', $item['idloaivang']).'
					 </td>
					 <td align="left" class="vang">
					 	 
						 <input type="text" autocomplete="off" id="cannangv'.$idnumvang.'" value="'.number_format($item['cannangv'],3,".",",").'" class="txtdatagirld text-right"/>
					 </td>
					 <td align="right" class="vang">
						 '.number_format($item['tuoivang'],4,".",",").'
					 </td>
					 <td align="left" class="vang">
					 	'.$item['tienmatvang'].'
					 </td>
					 <td align="left" class="vang">
					 	'.$item['ghichuvang'].'
					 </td>				 
				</tr> 
			';		
		}
		if(!empty($str)){
			$str = '
				<tr class="trheader">
					<td width="3%" align="center"> </td>
					<td width="3%" align="center">
						<strong>STT</strong>
					</td> 
					<td width="11%" align="center">
						<strong>Mã phiếu</strong>
					</td>
					<td width="13%" align="center">
						<strong>Nhóm Nguyên Liệu</strong>
					</td>
					<td width="13%" align="center">
						<strong>Tên Nguyên Liệu</strong>
					</td>
					
					<td width="10%" align="center">
						<strong>Loại Vàng</strong>
					</td>
					<td width="10%" align="center">
						<strong>Cân Nặng V</strong>
					</td>
					<td width="10%" align="center">
						<strong>Tuổi Vàng</strong>
					</td>
					<td width="10%" align="center">
						<strong>Tiền Mặt</strong>
					</td>
					<td width="20%" align="center">
						<strong>Ghi Chú</strong>
					</td>
				</tr>        
			'.$str;
		}
		$error = $str;
	break;
	
	// M.Tân thêm 15/07/2019
	case "checkMaVatTu":
		$error = "success" ;
		$mavattu = trim($_POST['mavattu']);
		$cid = ceil(trim($_POST['cid']));
		$id = ceil(trim($_POST['id']));
		if($id > 0)
			$sql = "select * from $GLOBALS[db_sp].loaivattu where mavattu='$mavattu' and cid=$cid and id <> $id";
		else
			$sql = "select * from $GLOBALS[db_sp].loaivattu where mavattu='$mavattu' and cid=$cid";
		$count = ceil(count($GLOBALS["sp"]->getAll($sql)));
		if($count > 0){
			$error = "Mã vật tư này đã tồn tại, vui lòng nhập vào mã khác." ;
		}
	break;

	// M.Tân thêm kiểm tra loại vàng và tồn vàng (số lượng vàng xuất lớn hơn số lượng tồn thì không cho xuất)
	case "KhoPhuKienKiemTraVang":
		$error = "success";
		$cid = ceil(trim($_POST['cid']));
		$idloaivang = ceil(trim($_POST['idloaivang']));
		$cannangv = $_POST['cannangv'];
		// die('cid: '.$cid.' - idloaivang: '.$idloaivang.' - cannangv: '.$cannangv);
		
		$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
		$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
		$tablehachtoan = $rsgettable['tablehachtoan'];

		if(!empty($tablehachtoan)){
			$sql = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." limit 1";
			$count = ceil(count($GLOBALS["sp"]->getAll($sql)));
			
			if($count <= 0){
				$error = "Loại vàng này chưa có nhập vào kho, vui lòng nhập vào kho loại vàng này." ;
			} else {
				$sqlCheckTonVang = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by dated desc limit 1";
				$rsCheckTonVang = $GLOBALS['sp']->getRow($sqlCheckTonVang);

				$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, 
								ROUND(SUM(du), 3) as du, 
								ROUND(SUM(haochenhlech), 3) as haochenhlech, 
								ROUND(SUM(duchenhlech), 3) as duchenhlech 
								from $GLOBALS[db_sp].".$tablehachtoan."
								where idloaivang=".$idloaivang." 
						";
				$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
				// print_r($rshaodu); die();

				$sltonvang = round(round(($rsCheckTonVang['sltonv'] - $rshaodu['hao']),3) + $rshaodu['du'],3);
				$sltonvang = round(round(($sltonvang - $rshaodu['haochenhlech']),3) + $rshaodu['duchenhlech'],3);

				if($cannangv > $sltonvang) {
					$error = "Vàng còn tồn trong kho ít hơn vàng cần xuất nên không thể tạo phiếu xuất kho." ;
				}
			}
		}
		else{
			$error = "Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.";		
		}
	break;

	// M.Tân thêm kiểm tra số lượng tồn của kho vật tư tổng (soluongxuat > soluongton của idmavattu thì không cho xuất)
	case "CheckTonKhoVatTu":
		$error = "success";
		$result = $_POST['result'];
		$cid = ceil(trim($_POST['cid']));
		// print_r($result);

		// Lấy ra table sodudauky dựa trên cid
		$sql = "select * from $GLOBALS[db_sp].categories where id=".$cid;
		$rs = $GLOBALS['sp']->getRow($sql);
		$tablehachtoan = $rs['tablehachtoan'];
		
		if(!empty($tablehachtoan)){
			foreach($result as $itemvattu) {
				if($itemvattu['idmavattu'] > 0) {
					// Lấy ra soluongton ứng với idmavattu
					$sqlTonVatTu = "select soluongton from $GLOBALS[db_sp].".$tablehachtoan." where idmavattu=".$itemvattu['idmavattu']." order by dated desc limit 1";
					$soluongton = $GLOBALS['sp']->getOne($sqlTonVatTu);
					
					if ($itemvattu['soluongxuatkho'] > $soluongton) {
						// Lấy tên vật tư để hiện thông báo
						$getKhoVatTu = getTableRow('loaivattu',' and id='.$itemvattu['idmavattu']);

						$error = "Loại vật tư: ".$getKhoVatTu['name_vn']." có số lượng xuất: ".number_format($itemvattu['soluongxuatkho'],2,".",",")." > số lượng tồn: ".number_format($soluongton,2,".",",");
						
					}
				}
			}
		} else {
			$error = "Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.";		
		}

	break;
	
	case "copyKimCuongKhoNguonVaoChuSon":
		////////////////Dung Transaction////////////////
	$GLOBALS["sp"]->BeginTrans();
	try{
		$idphieulon = implode(',',$_POST['id']);
		$arr = array();
		$datenow = date("Y-m-d");
		$timnow = date('H:i:s');
	
		$sqlmpt = "select max(numphieu)+1 from $GLOBALS[db_sp].khonguonvao_vangchuson";
		$rsmpt = $GLOBALS['sp']->getone($sqlmpt);
		
		if($rsmpt <= 0)
			$rsmpt = 1;	
		$maso = convertMaso($rsmpt);
		
		$arr['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
		$arr['datedhachtoan'] = $datenow;
		$arr['nguoilapphieu'] = getName('admin', 'fullname', $_SESSION['admin_qlsxntjcorg_id']);
		
		$arr['phongban'] = 30;
		$arr['numphieu'] = $maso;
		$arr['maphieu'] = $maphieu = $name = 'PNKVCS'.$maso;
		$arr['lydo'] = "Copy từ kho thành phẩm lưu trữ, kho kim cương nhân hột";
		$arr['type'] = 1; ////type 1.nhập; 2.xuat (Có thay đổi);
		
		$idctnx = vaInsert('khonguonvao_vangchuson',$arr); //1085		
		//$idctnx = 1085;	
		$sql = "select * from $GLOBALS[db_sp].kho_giamdockynhan where id in(".$idphieulon.") order by id asc, dated asc ";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$arrcth = array();
			$arrcth['idctnx'] = $idctnx;
			$arrcth['maphieu'] = $maphieu;
							
			$arrcth['nhomnguyenlieukimcuong'] = $item['nhomnguyenlieukimcuong'];
			$arrcth['tennguyenlieukimcuong'] = $item['tennguyenlieukimcuong'];
			$arrcth['idkimcuong'] = $item['idkimcuong'];
			$arrcth['codegdpnj'] = $item['codegdpnj'];
			$arrcth['codecgta'] = $item['codecgta'];
			$arrcth['kichthuoc'] = $item['kichthuoc'];
			$arrcth['trongluonghot'] = $item['trongluonghot'];
			$arrcth['dotinhkhiet'] = $item['dotinhkhiet'];
			$arrcth['capdomau'] = $item['capdomau'];
			$arrcth['domaibong'] = $item['domaibong'];
			$arrcth['kichthuocban'] = $item['kichthuocban'];
			$arrcth['tienmatkimcuong'] = $item['tienmatkimcuong'];
			$arrcth['dongiaban'] = $item['dongiaban'];
			$arrcth['type'] = 1;
			$arrcth['typevkc'] = 2;
			$arrcth['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
			$arrcth['dated'] = $datenow;
			$arrcth['time'] = $timnow;
			
			vaInsert('khonguonvao_vangchusonct',$arrcth);
		}
		$GLOBALS["sp"]->CommitTrans();
	} 
	catch (Exception $e){
		$GLOBALS["sp"]->RollbackTrans();
		$error = "Lỗi dữ liệu vui lòng liên hệ với admin.";
	}
	break;
	// ================= ANH VŨ THÊM KIỂM TRA TỒN TẠI MÃ TEM HỘP ================= //
	case "checkMaTem":
		$code = trim($_POST['code']);
		$id = trim($_POST['id']);
		$table = trim($_POST['table']);
		if($id > 0){
			$sql = "select * from $GLOBALS[db_sp].$table where code='".$code."' and id <> ".$id;
		}else{
			$sql = "select * from $GLOBALS[db_sp].$table where code='".$code."'";
		}
		$count = ceil(count($GLOBALS["sp"]->getAll($sql)));
		if($count > 0){
			$error = "Mã tem này đã tồn tại, vui lòng nhập vào mã khác.";
		}else{
			$error = 'success';
		}
	break;
	// ================= KẾT THÚC THÊM KIỂM TRA TỒN TẠI MÃ TEM HỘP ================= //
	
	// --- ANH VŨ BEGIN KIỂM TRA TỒN KHO - ĐÁ TEM GIẤY - ĐÁ TEM HỘP ---------------------------------------------- //
	case 'checkTonKhoTemGiayHop':
		$soluongthanhpham = isset($_POST['soluongthanhpham'])?ceil(trim($_POST['soluongthanhpham'])):"";
		$idtemgiay = isset($_POST['idtemgiay'])?trim($_POST['idtemgiay']):"";
		$idtemhop = isset($_POST['idtemhop'])?trim($_POST['idtemhop']):"";

		if($idtemgiay > 0 || $idtemhop > 0){
			// Tồn Kho Tem Giấy
			$sqltemgiay = "select id,soluongton from $GLOBALS[db_sp].da_temgiay_sodudauky where idtemgiay = $idtemgiay order by dated desc limit 1";
			$tontemgiay = $GLOBALS['sp']->getRow($sqltemgiay);
			// Tồn Kho Tem Hộp
			$sqltemhop = "select id,soluongton from $GLOBALS[db_sp].da_temhop_sodudauky where idtemhop = $idtemhop order by dated desc limit 1";
			$tontemhop = $GLOBALS['sp']->getRow($sqltemhop);
			// ------------------------------------------------------------------------------------------------------------
			if($tontemgiay['id'] == '' || $tontemhop['id'] == ''){
				$error = "Tồn Kho Tem Giấy hoặc Tem Hộp hiện tại chưa được thêm!";
			}
			else if($soluongthanhpham > $tontemgiay['soluongton']){
				$error = "Số Lượng Tồn Kho Tem Giấy còn ".$tontemgiay['soluongton']." - Vui lòng nhập tồn kho!";
			}
			else if($soluongthanhpham > $tontemhop['soluongton']){
				$error = "Số Lượng Tồn Kho Tem Hộp còn ".$tontemhop['soluongton']." - Vui lòng nhập tồn kho!";
			}
			else{
				$error = 'success';
			}
		}
		
	break;
	// --- ANH VŨ END KIỂM TRA TỒN KHO - ĐÁ TEM GIẤY - ĐÁ TEM HỘP ------------------------------------------------ //
	// --- ANH VŨ START THÊM MÃ SẢN PHẨM ------------------------------------------------ //
	case 'CheckCodeProduct':
		$quytrinh = $_POST['quytrinh'];
		$dongsp = $_POST['dongsp'];
		$nhomsp = $_POST['nhomsp'];
		$tensp = $_POST['tensp'];
		$mauda = $_POST['mauda'];
		$mauvang = $_POST['mauvang'];

		$wh = " idquytrinh = ".$quytrinh." 
					and iddongsp = ".$dongsp." 
					and idnhomsp = ".$nhomsp." 
					and idtensp = ".$tensp." 
					and idmauda = ".$mauda." 
					and idmauvang = ".$mauvang
		;
		$sql = "select num from $GLOBALS[db_sp].product where $wh order by num desc limit 1";
		$rs = $GLOBALS['sp']->getOne($sql);

		$number = empty($rs)?'A000':$rs;
		$number++;
		if(substr($number, -3) == '000') $number++;

		if($id > 0){
			$sqlkt = "select num from $GLOBALS[db_sp].product where $wh and id = ".$id;
			$rskt = $GLOBALS['sp']->getOne($sqlkt);
			$number = empty($rskt)?$number:$rskt;
		}
		$name = $number;
	break;

	case 'CheckSubmitProduct':
		$name = array();
		$quytrinh = $_POST['quytrinh'];
		$dongsp = $_POST['dongsp'];
		$nhomsp = $_POST['nhomsp'];
		$tensp = $_POST['tensp'];
		$mauda = $_POST['mauda'];
		$mauvang = $_POST['mauvang'];
		$strNum = $_POST['strNum'];
		// Điều kiện tương ứng với mỗi loại id	
		$wh = " idquytrinh = ".$quytrinh." 
					and iddongsp = ".$dongsp." 
					and idnhomsp = ".$nhomsp." 
					and idtensp = ".$tensp." 
					and idmauda = ".$mauda." 
					and idmauvang = ".$mauvang
		;
		// Lấy giá trị từ bảng product
		$sql_pro = "select id,num from $GLOBALS[db_sp].product where $wh and typedelete = 1 order by num asc limit 1";
		$rs_pro = $GLOBALS['sp']->getRow($sql_pro);
		$id_pro = $rs_pro['id'];
		$num_pro = $rs_pro['num'];
		// Lấy giá trị từ bảng product_delete
		$sqldel = "select id,num from $GLOBALS[db_sp].product_delete where $wh order by num asc limit 1";
		$rsdel = $GLOBALS['sp']->getRow($sqldel);
		$iddel = $rsdel['id'];
		$numdel = $rsdel['num'];

		if(!empty($id_pro) || !empty($iddel)){
			if(empty($numdel) || $id_pro > 0 & ($num_pro < $numdel)){
				$name['id'] = $id_pro;
				$name['num'] = $num_pro;
			}
			else{
				$name['id'] = $iddel;
				$name['num'] = $numdel;
			}
		}
		// Kiểm tra giá trị hiện tại nếu trùng không lưu
		if($strNum){
			$sqlkt = "select id from $GLOBALS[db_sp].product where ".$wh." and num = '".$strNum."'";
			$rskt = $GLOBALS['sp']->getOne($sqlkt);
			if($rskt == $id){
				$error = 'success';
			}
		}
	break;
	// --- ANH VŨ END THÊM MÃ SẢN PHẨM ------------------------------------------------ //
}
die(json_encode(array('status'=>$error,'name'=>$name)));
?>