<?php
include_once("../#include/config.php");
include_once("../functions/function.php");
include_once("../functions/functionVu.php");
include_once("../functions/functionNhom.php");
include_once("../functions/functionkhohao.php"); // A.Vũ thêm 
CheckLogin();
$str = '';
$act = trim($_POST['act']);
$table = trim($_POST['table']);
$queryString = trim($_POST['queryString']);

switch($act){
	case "KhoSanXuatLoadMaDonHangCatalog":
		$cid = trim($_POST['cid']);
		$sql = "select * from $GLOBALS[db_sp].categories where id=".$cid;
		$rs = $GLOBALS["sp"]->getRow($sql);
		if(!empty($rs['phongbancatalog'])){
			if($rs['phongbancatalog'] == 76)
				$phongbancatalog = '76,0';
			else
				$phongbancatalog = $rs['phongbancatalog'];
		}
		else{ ///////// kg có xuất dữ liệu
			$phongbancatalog = ' -1 ';
		}
		
		$sqlctl = "select * from $GLOBALS[db_catalog].ordersanxuat 
					where ( phongban in(".$phongbancatalog.") or id=-1) 
					and code LIKE '%" . $queryString . "%'
					and huydh=0 
					order by id desc limit 20
		"; 
		$rsctl = $GLOBALS["catalog"]->getAll($sqlctl);	
		foreach($rsctl as $item){
			$str .= '
				<a href="javascript:void(0)" onclick="searchMaDonHangCatalog('.$item['id'].',\''.$item['code'].'\')">
					'.$item['code'].'
				</a>
			';
		}
		echo $str;
	break;
	////// * Load Toa hàng Trong SX, Sau SX * /////
	case "KhoSanXuatLoadTHSXCatalog":		
		$sql = "select id from $GLOBALS[db_catalog].categories where pid IN (5637,5638) ";
		$rs = $GLOBALS["catalog"]->getCol($sql);
		$str = '';
		if (!empty($rs)) {
			$phongbancatalog = implode(",",$rs);
			$sqldh = "select id,code from $GLOBALS[db_catalog].ordersanxuat 
						where ( phongban in (".$phongbancatalog.") or id=-1) 
						and code LIKE '%" . $queryString . "%'
						and pid=0 and huydh=0 
						order by id desc limit 20
					"; 
			$rsdh = $GLOBALS["catalog"]->getAll($sqldh);	
			foreach($rsdh as $item){
				$str .= '
					<a href="javascript:void(0)" onclick="searchMaDonHangCatalog('.$item['id'].',\''.$item['code'].'\')">
						'.$item['code'].'
					</a>
				';
			}
		}	
		if (empty($str))
			$str = 'Không tìm thấy..';
		echo $str;
	break;
	
	case "component":
		$sql = "select * from $GLOBALS[db_sp].component
				where active=1
				and name LIKE '%" . $queryString . "%'
				order by id asc limit 30";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick="insertComponent('.$item['id'].',\''.$item['name'].'\')"> 
					<div style="width:100%">
						'.$item['name'].'
					</div>
				</a>
			';
		}
		echo $str;
	break;
	case "danhmuckimcuong":
		$sql = "select * from $GLOBALS[db_sp].loaikimcuonghotchu 
				where active=1 
				and (size LIKE '%" . $queryString . "%' or  name_vn LIKE '%" . $queryString . "%' )
				order by size asc,name_vn asc, id asc limit 100
		";
		$rs = $GLOBALS["sp"]->getAll($sql);
		
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchDMKimCuong('.$item['id'].',"'.$item['name_vn'].'","'.$item['size'].'","'.$item['giavon'].'")\'> 
					<div class="img_search">
						
					</div>
					<div class="FL">
						<span>'.$item["size"].'</span> :: '.$item["name_vn"].' 
					</div>
				</a>
			';
		}
		echo $str;
	break;
	
	case "phieuTongKhoDeCuc": /// trangthai: 2. duyệt xong, 3. số lượng vàng đã dùng hết
		$sql = "select * from $GLOBALS[db_sp].khokhac_khotongdecucct 
				where trangthai=2 
				and (maphieu LIKE '%" . $queryString . "%')
				order by maphieu asc, id asc limit 100
		";
		$rs = $GLOBALS["sp"]->getAll($sql);
		
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchPhieuTongKhoDeCuc('.$item['id'].',"'.$item['maphieu'].'","'.$item['cannangv'].'","'.$item['slcannangvcon'].'","'.$item['tuoivang'].'")\'> 
					<div class="img_search">
						
					</div>
					<div class="FL">
						<span>'.$item["maphieu"].'</span> Tổng SL: '.$item["cannangv"].';  SL Cắt: '.$item["slcannangvcat"].'
					</div>
				</a>
			';
		}
		echo $str;
	break;
	
	case "catalogOrdersanxuat": //and phongban=504 là phòng kho dá
		$sql = "select * from $GLOBALS[db_catalog].ordersanxuat
				where huydh = 0
				and code LIKE '%" . $queryString . "%'
				order by id desc limit 50
		";
		$rs = $GLOBALS["catalog"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchCatalogOrdersanxuat('.$item['id'].',"'.$item['code'].'")\'> 
					<div class="img_search">
						'.$item['code'].'
					</div>
					<div class="FL">
						( '.date('d/m/Y',strtotime($item['dated'])).' ) 
					</div>
				</a>
			';
		}
		echo $str;
	break;
	
	case "KhoSanXuatChinhSuaSoLieu": //and phongban=504 là phòng kho dá
		$sql = "select * from $GLOBALS[db_sp].".$table."
				where typechuyen in(0,2) and type in(1,3) and maphieu LIKE '%" . $queryString . "%'
				order by id desc limit 50
		";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
		}
		echo $str;
	break;
	
	case "KhoNguonVaoChinhSuaSoLieu":
		$sql = "select * from $GLOBALS[db_sp].".$table."
				where typevkc=1 and type in(2) and trangthai in(0,2) and maphieu LIKE '%" . $queryString . "%'
				order by id desc limit 50
		";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
		}
		echo $str;
	break;
	
	case "KhoKhacKhoTongDeCucChinhSuaSoLieu":
		$sql = "select * from $GLOBALS[db_sp].".$table."
				where typevkc=1 and type in(2) and slcannangvcat=0 and maphieu LIKE '%" . $queryString . "%'
				order by id desc limit 50
		";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
		}
		echo $str;
	break;
	
	case "KhoKhacKhoSauCheTacChinhSuaSoLieu":
		$sql = "select * from $GLOBALS[db_sp].".$table."
				where typevkc=1 and typesauchetac=2 and maphieu LIKE '%" . $queryString . "%'
				order by id desc limit 50
		";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
		}
		echo $str;
	break;
	
	case "KhoKhacPhanKimChinhSuaSoLieu": //and phongban=504 là phòng kho dá
		$sql = "select * from $GLOBALS[db_sp].".$table."
				where typechuyen in(0,2) and type in(1,2) and maphieu LIKE '%" . $queryString . "%'
				order by id desc limit 50
		";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
		}
		echo $str;
	break;
	
	case "KhoSanXuatChinhSuaSoLieuKhoThanhPham": 
		$sql = "select * from $GLOBALS[db_sp].khosanxuat_khothanhpham
				where type in(1,3) and typechuyen in(0,2) and maphieu LIKE '%" . $queryString . "%'
				order by id desc limit 50
		";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
		}
		echo $str;

	break;
	
	case "KhoSanXuatChinhSuaSoLieuGiongKhoThanhPham": 
		$sql = "select * from $GLOBALS[db_sp].".$table."
				where type in(1,3) and typechuyen in(0,2) and maphieu LIKE '%" . $queryString . "%'
				order by id desc limit 50
		";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
		}
		echo $str;

	break;

	case "danhmucphukien":
		$sql = "select * from $GLOBALS[db_catalog].products
				WHERE (cid IN (SELECT id FROM $GLOBALS[db_catalog].categories WHERE pid=815))
				and (name_vn LIKE '%" . $queryString . "%' or code LIKE '%" . $queryString . "%')
				order by id desc limit 30
		";
		$rs = $GLOBALS["catalog"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick="insertPhuKien('.$item['id'].',\''.$item['code'].'\',\''.$item['name_vn'].'\')"> 
					'.$item['name_vn'].'
				</a>
			';
		}
		echo $str;
	break;

	case "QuetQRDanhMucPhuKien":
		$sql = "select count(id) as count, id, code, name_vn, namekho, idloaivang from $GLOBALS[db_catalog].phukien
				WHERE ismakho=1 and typedelete=0 
				and (code = '" . $queryString . "')
		";
		$rs = $GLOBALS["catalog"]->getRow($sql);
		
		$count = ceil($rs['count']);
		if($count > 0) {
			// Get name loại vàng
			$sqlGetNameLoaiVang = "select name_vn from $GLOBALS[db_sp].loaivang where id=".$rs['idloaivang'];
			$nameLoaiVang = $GLOBALS['sp']->getOne($sqlGetNameLoaiVang);

			die(json_encode(array('status'=>'success','code'=>$rs['code'],'name_vn'=>$rs['name_vn'],'namekho'=>$rs['namekho'],'idphukien'=>$rs['id'],'idloaivang'=>$rs['idloaivang'],'nameLoaiVang'=>$nameLoaiVang,'count'=>$count)));
		} else {
			$sqlGetSuggestions = "select id, code, name_vn, namekho, idloaivang from $GLOBALS[db_catalog].phukien WHERE ismakho=1 and (code LIKE '%" . $queryString . "%')order by id asc limit 30";
			$rsGetSuggestions = $GLOBALS["catalog"]->getAll($sqlGetSuggestions);
			
			foreach($rsGetSuggestions as $itemSuggestions){
				// Get name loại vàng
				$sqlGetNameLoaiVang = "select name_vn from $GLOBALS[db_sp].loaivang where id=".$itemSuggestions['idloaivang'];
				$nameLoaiVang = $GLOBALS['sp']->getOne($sqlGetNameLoaiVang);

				$str .= '
					<a href="javascript:void(0)" onclick=\'insertPhuKien('.$itemSuggestions['id'].',"'.$itemSuggestions['code'].'","'.$itemSuggestions['namekho'].'","'.$itemSuggestions['idloaivang'].'","'.$nameLoaiVang.'")\'> 
						<div class="img_search">
							
						</div>
						<div class="FL">
							<span>'.$itemSuggestions["code"].'</span> - '.$itemSuggestions["namekho"].' 
						</div>
					</a>
				';
			}
			die(json_encode(array('str'=>$str,'count'=>$count)));
		}
	break;

	//////////////////////////////VŨ THÊM ĐIỀU CHỈNH SỐ LIỆU KHO KHÁC KHO BỘT////////////////////////////////////////////////
	//CSSL phiếu nhập
	case "KhoKhacKhoBotChinhSuaSoLieuPN":
		$sql = "select * from $GLOBALS[db_sp].bot_khobot
				where type=1 and typechuyen=2 and maphieu like '%".$queryString."%' 
				order by id desc limit 50";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
			}
		echo $str;
	break;
	//CSSL phiếu xuất
	//============================VŨ THÊM ĐIỀU CHỈNH SỐ LIỆU KHO KHÁC KHO LƯU MẪU=============================//
	case "KhoKhacLuuMauDCSL":
		$sql = "select * from $GLOBALS[db_sp].khokhac_luumau
				where ((type=1 and typechuyen=2) or ( type=3 and trangthai=2 )) and typevkc=1 and maphieu like '%".$queryString."%' 
				order by id desc limit 50";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
			}
		echo $str;
	break;
	
	//===============Vũ THÊM LOAD MÃ ĐƠN HÀNG KHO KHÁC KHO LƯU MẪU======================//
	case "KhoLuuMauLoadMaDonHangCatalog":
		$idLM = trim($_POST['idLM']);
		$cid = trim($_POST['cid']);
		$sql = "select * from $GLOBALS[db_sp].categories where id=".$cid;
		$rs = $GLOBALS["sp"]->getRow($sql);
		if($rs['phongbancatalog'] == 76)
			$phongbancatalog = '76,0';
		else
			$phongbancatalog = $rs['phongbancatalog'];
		if(!empty($rs['phongbancatalog'])){
			$sqlctl = "select * from $GLOBALS[db_catalog].ordersanxuat 
						where phongban in(".$phongbancatalog.") 
						and code LIKE '%" . $queryString . "%'
						and huydh=0 
						order by id desc limit 20
			"; 
			$rsctl = $GLOBALS["catalog"]->getAll($sqlctl);
			foreach($rsctl as $item){
				$str .= '
					<a href="javascript:void(0)" onclick="searchMaDonHangCatalogLM('.$item['id'].',\''.$item['code'].'\','.$idLM.')">
						'.$item['code'].'
					</a>
				';
			}
		}
		echo $str;
	break;
	/*=======Load List Tên Kim Cương Kho Giám Định Kim Cương==================*/
	case "danhmuckimcuongkhogiamdinhkc":
		$idtennguyenlieukimcuong = ceil(trim($_POST['idtennguyenlieukimcuong']));
		if($idtennguyenlieukimcuong == 88) { // Là kim cương chủ => show nước kim cương (vd:size::name_vn (320::F/REXCO))
			$sql = "select * from $GLOBALS[db_sp].loaikimcuonghotchu 
							where active=1 
							and (size LIKE '%" . $queryString . "%' or  name_vn LIKE '%" . $queryString . "%' )
							order by size asc,name_vn asc, id asc limit 100
					";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'searchDMKimCuongKhoGDKC('.$item['id'].',"'.$item['name_vn'].'","'.$item['size'].'","'.$item['giavon'].'")\'> 
						</div>
						<div class="FL">
							<span>'.$item["size"].'</span> :: '.$item["name_vn"].' 
						</div>
					</a>
				';
			}
		} else if($idtennguyenlieukimcuong == 89) { // Là kim cương tấm => Tên kim cương = Mã đá catalog : Size
			$sql = "select * from $GLOBALS[db_catalog].thongsohottam 
							where active=1 
							and (size LIKE '%" . $queryString . "%') and madacatalog <> ''
							order by madacatalog asc, size asc limit 100
					";
			$rs = $GLOBALS['catalog']->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'searchDMKimCuongKhoGDKC('.$item['id'].',"'.$item['madacatalog'].'","'.$item['size'].'","'.$item['giagocusd_vien'].'")\'> 
						<div class="FL">
							<span>'.$item["madacatalog"].'</span> :: '.$item["size"].' 
						</div>
					</a>
				';
			}
		}
		echo $str;
	break;
	/*=======Load List Tên Kim Cương Kho Giám Định Kim Cương==================*/
	/*=======QUẢN LÝ KHO ĐÁ==================*/
	/*=======Load List Mã Đá Kho Đá Tổng==================*/
	case "loadDanhMucDaKhoDa":
		$str = "";
		$cid = trim($_POST['cid']);
		$idRow = ceil(trim($_POST['idRow']));

		$sqlcat = "select loadtheokhoda from $GLOBALS[db_sp].categories
				where id=".$cid;
		$rscat = $GLOBALS["sp"]->getOne($sqlcat);
		
		$sqlnhomda = "select kituma from $GLOBALS[db_catalog].categories
						where id in ($rscat) ";
		$rsnhomda = $GLOBALS['catalog']->getCol($sqlnhomda);
		$rsStrKTM = implode(",", $rsnhomda);
		$implodeStr = str_replace(",","','", $rsStrKTM);

		$sql = "select id,code,tengoida,donvitinhnhapxuat,pricenhapxuat 
				from $GLOBALS[db_catalog].banggiada 
				where (code like '%".$queryString."%' or tengoida like '%".$queryString."%') and code <> '' and tengoida <> '' 
					   and nhomda in ('".$implodeStr."')	
				order by id asc limit 50";
		$rs = $GLOBALS['catalog']->getAll($sql);
		
		if(count($rs)>0){
			foreach($rs as $item){
				if($item['tengoida'] == ""){
					$tenda = "Mã đá này chưa có tên";
				}
				else{
					$tenda = $item['tengoida'];
				}
				//=======================
				$sqlhottam = "select madacatalog from $GLOBALS[db_catalog].thongsohottam where madacatalog='".$item['code']."'";
				$rshottam = $GLOBALS['catalog']->getOne($sqlhottam);
				//=======================
				if(count($rshottam)==0){
					$str .= '
							<a href="javascript:void(0)" onclick=\'searchDMDaKhoDa('.$item['id'].',"'.$item['code'].'","'.$item['tengoida'].'","'.$item['donvitinhnhapxuat'].'","'.$item['pricenhapxuat'].'",'.$idRow.')\'> 
								<div class="FL">
									<span>'.$item["code"].' - '.$tenda.'</span>
								</div>
							</a>
						';
				}
				else{
					$str .= 'Mã đá này không hợp lệ';
					break;
				}
				//=======================				
			}
		}
		else{
			$str = '
					<div class="FL">
						<span>Mã đá này không có trong danh mục</span>
					</div>					
					';
		}		
		echo $str;
	break;
	//===============================
	case "loadDanhMucDaKhoDaDXBS":
		$str = "";
		$cid = trim($_POST['cid']);
		$idRow = ceil(trim($_POST['idRow']));

		$sqlcat = "select loadtheokhoda from $GLOBALS[db_sp].categories
				where id=".$cid;
		$rscat = $GLOBALS["sp"]->getOne($sqlcat);
		
		$sqlnhomda = "select kituma from $GLOBALS[db_catalog].categories
						where id in ($rscat) ";
		$rsnhomda = $GLOBALS['catalog']->getCol($sqlnhomda);
		$rsStrKTM = implode(",", $rsnhomda);
		$implodeStr = str_replace(",","','", $rsStrKTM);

		$sql = "select id,code,tengoida,donvitinhnhapxuat,pricenhapxuat 
				from $GLOBALS[db_catalog].banggiada 
				where (code like '%".$queryString."%' or tengoida like '%".$queryString."%') and code <> '' and tengoida <> '' 
					   and nhomda in ('".$implodeStr."')	
				order by id asc limit 50";
		$rs = $GLOBALS['catalog']->getAll($sql);
		
		if(count($rs)>0){
			foreach($rs as $item){
				//=======lấy sl tồn kho======
				$viewdl = thongkeDaKhoDaDXBSKCTam($cid,$item['id']);
				//=======
				if($item['tengoida'] == ""){
					$tenda = "Mã đá này chưa có tên";
				}
				else{
					$tenda = $item['tengoida'];
				}
				//=======================
				$sqlhottam = "select madacatalog from $GLOBALS[db_catalog].thongsohottam where madacatalog='".$item['code']."'";
				$rshottam = $GLOBALS['catalog']->getOne($sqlhottam);
				//=======================
				if(count($rshottam)==0){
					$str .= '
							<a href="javascript:void(0)" onclick=\'searchDMDaKhoDa('.$item['id'].',"'.$item['code'].'","'.$item['tengoida'].'","'.$item['donvitinhnhapxuat'].'",'.$item['pricenhapxuat'].','.$viewdl['slton'].','.$idRow.')\'> 
								<div class="FL">
									<span>'.$item["code"].' - '.$tenda.'</span>
								</div>
							</a>
						';
				}
				else{
					$str .= 'Mã đá này không hợp lệ';
					break;
				}				
			}
		}
		else{
			$str = '
					<div class="FL">
						<span>Mã đá này không có trong danh mục</span>
					</div>					
					';
		}		
		echo $str;
	break;
	//===============================
	case "loadKCTamDXBSTheoMaToaHang":
		$str = "";
		$cid = trim($_POST['cid']);
		$idRow = ceil(trim($_POST['idRow']));

		$sql = "select id, code, typeorder, chitiethotdadathang_id
				from $GLOBALS[db_catalog].ordersanxuat 
				where code like '%".$queryString."%' and typeorder = 2 
				order by id asc limit 50";		
		$rs = $GLOBALS['catalog']->getAll($sql);

		if(count($rs)>0){
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'listMaDaTHSXKCTam('.$item['id'].',"'.$item['code'].'","'.$item['chitiethotdadathang_id'].'",'.$idRow.','.$cid.')\'> 
						<div class="FL">
							<span>'.$item["code"].'</span>
						</div>
					</a>
				';
			}			
		}
		else{
			$str = '
					<div class="FL">
						<span>Không tìm thấy mã toa hàng này</span>
					</div>					
					';
		}
		echo $str;
	break;
	//===============================	
	case "loadKCTamKhoDaDXBS":
		$str = "";
		$cid = trim($_POST['cid']);
		$idRow = ceil(trim($_POST['idRow']));

		$sqlcat = "select loadtheokhoda from $GLOBALS[db_sp].categories
				where id=".$cid;
		$rscat = $GLOBALS["sp"]->getOne($sqlcat);
		
		$sqlnhomda = "select kituma from $GLOBALS[db_catalog].categories
						where id in ($rscat) ";
		$rsnhomda = $GLOBALS['catalog']->getCol($sqlnhomda);
		$rsStrKTM = implode(",", $rsnhomda);
		$implodeStr = str_replace(",","','", $rsStrKTM);

		$sql = "select id,code,tengoida,donvitinhnhapxuat,pricenhapxuat 
				from $GLOBALS[db_catalog].banggiada 
				where (code like '%".$queryString."%' or tengoida like '%".$queryString."%') and code <> '' and tengoida <> '' 
					   and nhomda in ('".$implodeStr."')	
				order by id asc limit 50";
		
		$rs = $GLOBALS['catalog']->getAll($sql);	
		
		if(count($rs)>0){
			foreach($rs as $item){
				//=======
				$sqlhottam = "select id, madacatalog, size, giagocusd_vien 
						from $GLOBALS[db_catalog].thongsohottam
						where madacatalog = '".trim($item['code'])."'";
				$rshottam = $GLOBALS['catalog']->getRow($sqlhottam);
				//=======lấy sl tồn kho======
				$viewdl = thongkeDaKhoDaDXBSKCTam($cid,$item['id']);
				//=======
				if($item['tengoida'] == ""){
					$tenda = "Mã đá này chưa có tên";
				}
				else{
					$tenda = $item['tengoida'];
				}
				//=======================
				$sqlcheckht = "select madacatalog from $GLOBALS[db_catalog].thongsohottam where madacatalog='".$item['code']."'";
				$rscheckht = $GLOBALS['catalog']->getOne($sqlcheckht);
				//=======================
				if(count($rscheckht)>0){
					$str .= '
							<a href="javascript:void(0)" onclick=\'searchDMDaKhoDaKCTam('.$item['id'].',"'.$item['code'].'","'.$item['tengoida'].'","'.$rshottam['size'].'","'.$item['donvitinhnhapxuat'].'",'.$rshottam['giagocusd_vien'].','.$viewdl['slton'].','.$idRow.')\'> 
								<div class="FL">
									<span>'.$item["code"].' - '.$tenda.'</span>
								</div>
							</a>
						';
				}
				else{
					$str .= 'Mã đá này không phải kim cương tấm';
					break;
				}				
			}
		}
		else{
			$str = '
					<div class="FL">
						<span>Mã đá này không có trong danh mục</span>
					</div>					
					';
		}
		echo $str;
	break;
	//===============================
	case "loadKCTamKhoDa":
		$str = "";
		$cid = trim($_POST['cid']);
		$idRow = ceil(trim($_POST['idRow']));
		$path_url = trim($_POST['path_url']);

		$sqlcat = "select loadtheokhoda from $GLOBALS[db_sp].categories
				where id=".$cid;
		$rscat = $GLOBALS["sp"]->getOne($sqlcat);
		
		$sqlnhomda = "select kituma from $GLOBALS[db_catalog].categories
						where id in ($rscat) ";
		$rsnhomda = $GLOBALS['catalog']->getCol($sqlnhomda);
		$rsStrKTM = implode(",", $rsnhomda);
		$implodeStr = str_replace(",","','", $rsStrKTM);

		$sql = "select id,code,tengoida,donvitinhnhapxuat,pricenhapxuat 
				from $GLOBALS[db_catalog].banggiada 
				where (code like '%".$queryString."%' or tengoida like '%".$queryString."%') and code <> '' and tengoida <> '' 
					   and nhomda in ('".$implodeStr."')	
				order by id asc limit 50";

		$rs = $GLOBALS['catalog']->getAll($sql);	
		
		if(count($rs)>0){
			foreach($rs as $item){
				//=======
				$sqlhottam = "select id, madacatalog, size, giagocusd_vien 
						from $GLOBALS[db_catalog].thongsohottam
						where madacatalog = '".trim($item['code'])."'";
				$rshottam = $GLOBALS['catalog']->getRow($sqlhottam);
				//=======
				if($item['tengoida'] == ""){
					$tenda = "Mã đá này chưa có tên";
				}
				else{
					$tenda = $item['tengoida'];
				}
				//=======================
				$sqlcheckht = "select madacatalog from $GLOBALS[db_catalog].thongsohottam where madacatalog='".$item['code']."'";
				$rscheckht = $GLOBALS['catalog']->getOne($sqlcheckht);
				//=======================
				if(count($rscheckht)>0){
					$str .= '<a href="javascript:void(0)" onclick="searchDMDaKhoDaKCTam(\''.$path_url.'\','.$item['id'].',\''.$item['code'].'\',\''.$item['tengoida'].'\',\''.$rshottam['size'].'\',\''.$item['donvitinhnhapxuat'].'\','.$rshottam['giagocusd_vien'].','.$idRow.')"> 
								<div class="FL">
									<span>'.$item["code"].' - '.$tenda.'</span>
								</div>
							</a>';
				}
				else{
					$str .= 'Mã đá này không phải kim cương tấm';
					break;
				}
				//=======================				
			}
		}
		else{
			$str = '
					<div class="FL">
						<span>Mã đá này không có trong danh mục</span>
					</div>					
					';
		}
		echo $str;
	break;
	//===============================
	case "getidsizect":
		$id=ceil(trim($_POST['id']));
		$codecatalog = trim(striptags($_POST['codecatalog']));

		$rsid = getOneInAll('id',"thongsohottam"," madacatalog='".$codecatalog."'",$type='getOne','db_catalog',"catalog");
		$rssize = getOneInAll('id,size',"thongsohottam",' pid='.$rsid,$type='getAll','db_catalog',"catalog");

		$str = "";
		if(count($rssize) > 0 ){
			foreach($rssize as $item){
				$str .= "<option value='".$item['id']."'>".$item['size']."</option>";
			}
		}
		else{
			$str .= "<option value='0'>Không có size đá chi tiết</option>";
		}
		echo $str;
	break;
	/*=======End Load List Mã Đá Kho Đá Tổng==================*/
	/*=======Load Nhân Viên Phòng Ban==================*/
	case 'SearchMulNVPB':
		$nameId = trim(striptags($_POST['nameId']));
		$namePB = trim(striptags($_POST['namePB']));
		$idPB = trim(striptags($_POST['idPB']));
		$nameSugges = trim(striptags($_POST['nameSugges']));
		
		$sql = "select id, manv,fullname,phongban from $GLOBALS[db_spns].nhanvien
					where (manv LIKE '%".$queryString."%' or fullname LIKE '%".$queryString."%') and active=1 and status=1
					order by id asc limit 20";
		$rs = $GLOBALS["spns"]->getAll($sql);
		$rsThongTinNVPB = array();
		foreach ($rs as $vl){
			$sqlPB ="select id as idphongban,name_vn 
					from $GLOBALS[db_spns].danhmucphongban 
					where id=".$vl['phongban']."";
			$rsPB = $GLOBALS["spns"]->getRow($sqlPB);
			$vl = array_merge($vl, $rsPB);
			$rsThongTinNVPB[] = $vl;
		}
		foreach($rsThongTinNVPB as $item){
				$str .= '
				<a href="javascript:void(0)" onclick=\'insertMulNVPB("'.$item['id'].'","'.$item['fullname'].'","'.$nameId.'","'.$namePB.'","'.$item['name_vn'].'","'.$idPB.'","'.$item['idphongban'].'","'.$nameSugges.'")\'> 
					'.$item['manv'].'  :  '.$item['fullname'].'
				</a>
			';
		}
		echo $str;
	break;
	/*=======End Load Nhân Viên Phòng Ban==================*/
	case "getSubInfoDaKhoDaId":
		$id = ceil(trim($_POST['id']));
		$i = ceil(trim($_POST['i']));
		echo getSubInfoDaKhoDa($id, $i);
	break;
	/*=======END QUẢN LÝ KHO ĐÁ==================*/
	/*=========================*/
	//////////////////////////////KẾT THÚC VŨ THÊM //////////////////////////////////////
	
	case "KhoSanXuatPhuKienDCSL":
		$sql = "select * from $GLOBALS[db_sp].".$table."
				where type in(1,3) and typechuyen in(0,2) and trangthai in(0,2) and maphieu like '%".$queryString."%' 
				order by id desc limit 50";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
			}
		echo $str;
	break;
	//////////////////////////////KẾT THÚC VŨ THÊM ĐIỀU CHỈNH SỐ LIỆU KHO SẢN XUẤT KHO PHỤ KIỆN 29-10-2019///////////////////////////////////////

	case "KhoSanXuatPhuKienNewDCSL":
		$sql = "select * from $GLOBALS[db_sp].".$table."
						 where type=3 and trangthai=2 and maphieu like '%".$queryString."%' 
						 order by id desc limit 30";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
			}
		echo $str;
	break;
	
	/////////////////////////////////////////XUÂN MAI THÊM TÌM MÃ TEM HỘP VÀ TEM GIẤY////////////////////////////////////////////
	case 'DaMaTemHop':
	case 'DaMaTemGiay':
		$strtypetable = (trim($act) == 'DaMaTemHop') ? 'dm_temhop' : 'dm_temgiay';
		// $strtypetable = "dm_temhop";
		// if (trim($act) != 'DaMaTemHop') $strtypetable = 'dm_temgiay';
		$sql = "select * from $GLOBALS[db_sp].$strtypetable
				where code like '%".$queryString."%' and active=1 
				order by id desc limit 50";
		// die($sql);
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaTemGiayHop("'.$item['code'].'", "'.$item['id'].'", "'.$item['size'].'", '.$item['dongia'].')\'> 
					<div class="img_search">
						'.$item['code'].'
					</div>
					<div class="FL">
						'.$item['size'].'
					</div>
				</a>
			';
			}
		echo $str;
	break;

	//==============VŨ THÊM LOAD MÃ SẢN PHẨM CATALOG KHO ĐỒ CŨ CN KHÁCH ĐẶT==================//
	case "KhoDCCNKGSearchMaSP":
		$sql ="SELECT id, code, typegold, iddmnhomsp, imgrender_vn, imgrenderthumb_vn, img_vn, imgthumb_vn 
				FROM $GLOBAL[db_catalog].products_new 
				WHERE code like '%".$queryString."%' and typeproduct IN (1, 4, 5, 6) and typedelete = 0 order by id desc limit 50";
		$rs = $GLOBALS["catalog"]->getAll($sql);
		$countrs = count($rs);
		if($countrs > 0 ){
			$str = "<p style='color:red;margin:5px 5px'>Bạn vui lòng click chọn Mã SP Catalog muốn nhập đang được hiển thị bên dưới</p>";
			foreach($rs as $item){
				$sql_nhomsp = "SELECT name_vn from $GLOBALS[db_catalog].dmsp_nhomsanpham where id = ".$item['iddmnhomsp'];
				$nhomsp = trim($GLOBALS['catalog']->getOne($sql_nhomsp));

				$piturefill = empty($item['imgrender_vn']) ? "" : $urlCatalog.$item['imgrender_vn'];
				$piturefill_vn = empty($item['imgrenderthumb_vn']) ? "" : $urlCatalog.$item['imgrenderthumb_vn'];
				if (empty($item['imgrender_vn'])){
					$piturefill = empty($item['img_vn']) ? "" : $urlCatalog.$item['img_vn'];
					$piturefill_vn = empty($item['imgthumb_vn']) ? "" : $urlCatalog.$item['imgthumb_vn'];
				}

				$str.='<a onclick="searchMaSPCatalogKDCCNKG('.$item['id'].',\''.$item['code'].'\',\''.$piturefill_vn.'\',\''.$piturefill.'\')"  title="'.$item['code'].'" style="cursor:pointer"> 
							<div class="img_searchDCKG">
								<img class="ImgReponsiveDCKG" src="'.$piturefill_vn.'" alt="'.$item['code'].'" title="'.$item['code'].'" width="50" >
							</div>
							<div class="titlesDCKG">
								+ <strong>'.$item['code'].'</strong> <br>
								+ '.$nhomsp.' <br>
								+ '.getName("loaivang", "name_vn", $item['typegold']).' <br>									
							</div>
						</a>';
			}
		}
		else{
			$str = '<p style="color:red"> Bạn đang nhập vào Mã SP Catalog mới </p>';
		}
		echo $str;
	break;
	/*======VŨ THÊM LOAD LOẠI ĐÁ CHỦ KHO ĐỒ CŨ CN KHÁCH GỬI 06-2020==========*/
	case"loadDaChuCKhoDCCNKG":
		$id = $_POST['id'];
		$col1 = $_POST['col1'];
		$col2 = $_POST['col2'];
		if($table=="banggiada"){
			$sql = "Select id, ".$col1." from $GLOBALS[db_catalog].".$table." where active=1 and ".$col2."=".$id;
		}
		else{
			$sql = "Select id, ".$col1." from $GLOBALS[db_catalog].".$table." where activebanggiada=1 and ".$col2."=".$id;
		}			
		$rs = $GLOBALS["catalog"]->getAll($sql);
		$str = "";
		if(count($rs) > 0 ){
			foreach($rs as $item){
				if($item[$col1] != ""){
					$str .= "<option value='".$item['id']."'>".$item[$col1]."</option>";
				}
			}
		}
		echo $str;
	break;
	/*====================*/
	/*======HOÀNG THÊM LOAD SIZE LOẠI ĐÁ CHỦ TIỀN CÔNG KHÁCH ĐẶT 06-12-2022==========*/
	case"loadDaChu_TienCongKhachDat":
		$id = $_POST['id'];
		$col1 = $_POST['col1'];
		$col2 = $_POST['col2'];
		$dbconn = "catalog";
		if($table=="banggiada"){
			$sql = "Select id, ".$col1." from $GLOBALS[db_catalog].".$table." where active=1 and ".$col2."=".$id;
		}
		elseif ($table=="loaikimcuonghotchu"){
			$sql = "Select id,size,name_vn from $GLOBALS[db_sp].".$table." where active=1 order by size asc,name_vn asc, id asc";
			$dbconn = "sp";
		}
		else{
			$sql = "Select id, ".$col1." from $GLOBALS[db_catalog].".$table." where activebanggiada=1 and ".$col2."=".$id;
		}	
		$rs = $GLOBALS[$dbconn]->getAll($sql);
		$str = "";
		
		if(count($rs) > 0 ){
			foreach($rs as $item){
				if ($table=="loaikimcuonghotchu") {
					$item[$col1] = $item['size'].$item['name_vn'];
				}
				if($item[$col1] != ""){
					$str .= "<option value='".$item['id']."'>".$item[$col1]."</option>";
				}
			}
		}
		
		echo $str;
	break;
	/*====================*/
	case"loadCDNiKhoDCCNKG":
		$id = $_POST['id'];
		if($id != -1){
			$sql1 = "select chieudaini from $GLOBALS[db_sp].docucn_dkxauni where id=".$id;
			$rs1 = $GLOBALS["sp"]->getOne($sql1);
			$sql = "Select id, name from $GLOBALS[db_catalog].thongsoni
					where id in (".$rs1.")";
			$rs = $GLOBALS["catalog"]->getAll($sql);
		}
		else{
			$sql = "Select id, name from $GLOBALS[db_catalog].thongsoni";
			$rs = $GLOBALS["catalog"]->getAll($sql);	
		}
		$str = "";
		if(count($rs) > 0 ){
			foreach($rs as $item){
				if($item['name'] != ""){
					$str .= "<option value='".$item['id']."'>".$item['name']."</option>";
				}
			}
		}
		echo  $str;
	break;
	/*==========VŨ THÊM LOAD MÃ SẢN PHẨM CATALOG KHO QUẢN LÝ SẢN PHẨM BẢO HÀNH KHÁCH HÀNG===========*/
	case "QuanLySPBHKHSearchMaSP":
		$str = "";
		$sql = "select id, code,typegold,imgthumb_vn,thoigiannhanbaohanh_saubosung
				from $GLOBALS[db_catalog].products_new 
				where code like '%".$queryString."%'	  
				order by id desc limit 50";
		$rs = $GLOBALS["catalog"]->getAll($sql);
		$countrs = count($rs);
		if($countrs > 0 ){	
			$str = '<div><p style="color:red"> Bạn vui lòng click chọn Mã Sản Phẩm</p></div>';		
			foreach($rs as $item){
				$str.='<div style="margin:5px 0px 5px 0px">
							<a onclick="searchMaSPBH('.$item['id'].',\''.$item['code'].'\','.$item['thoigiannhanbaohanh_saubosung'].')"  title="'.$item['code'].'" style="cursor:pointer">
								<strong>'.$item['code'].'</strong>
							</a>						
						</div>
						';
			}
		}
		else{
			$str = '<p style="color:red"> Không tìm thấy Mã Sản Phẩm này</p>';
		}
		echo $str;
	break;
	/*========================*/
	case"QuanLySPBHKHLoadPhongChuyen":
		$id = $_POST['id'];
		$str = "";
		if($id == -1){
			$str .= "<option value='1929'>".getLinkTitle(1929,1)."</option>";
		}
		else{			
			$sql = "select id,phongbanchuyen 
					from $GLOBALS[db_sp].quanlyspbhkh_dmsp_phongbanchuyen
					where id=".$id;
			$rs = $GLOBALS["sp"]->getRow($sql);
			$arrStr = array();
			$arrStr = explode(',',$rs['phongbanchuyen']);				
			foreach($arrStr as $item){
				if($item != 0){				
					$str .= "<option value='".$item."'>".getNameKhoTitleShort($item,2)."</option>";
				}
			}
		}
		echo $str;
	break;
	/*========================*/
	case"loadSPBHQLSPBHKH":
		$mid = $_POST['mid'];
		$str = "";
		$sql = "select id,maphieu from $GLOBALS[db_sp].$table where mid=".$mid." and type=1 and typePTC=1 and trangthai=1 and typechon != 1";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= "<option value='".$item['id']."'>".$item['maphieu']."</option>";
		}
		echo $str;
	break;
	//////////////////////////////KẾT THÚC VŨ THÊM //////////////////////////////////////
	
	/////////////////////////////////////XUÂN MAI THÊM TÌM MÃ PHIẾU TEM HỘP GIẤY ĐIỀU CHỈNH SỐ LIỆU//////////////////////////////////////
	case 'MaPhieuDaTemDieuChinhSoLieu':
		$sql = "select * from $GLOBALS[db_sp].".$table."
		where trangthai=2 and maphieu LIKE '%" . $queryString . "%'
		order by id asc limit 50";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){

		$str .= '
			<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
				'.$item['maphieu'].'
			</a>
		';
		}
		echo $str;
	break;
////////////////////////////////////HOÀNG THÊM TÌM SỐ HỘP ĐỒNG & TÌM MÃ KHÁCH HÀNG/////////////////////////////
	case 'MaKhachHang':		
		$where = array();
		$value = array();
		$where = $_POST['where'];
		$value = $_POST['value'];

		$sql = "select * from $GLOBALS[db_sp].".$table." where $where LIKE '%" . $queryString . "%' order by id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'InsertThongtinkhachhang("'.$item['tenkhachhang'].'", "'.$item['diachi'].'","'.$item['masothue'].'")\'> 
						'.$item[$value].'
					</a>
				';
			}
		echo $str;
	break;
	case 'SearchHopDong':
		$where = array();
		$value = array();
		$where = $_POST['where'];
		$value = $_POST['value'];
		$idkh = $_POST['idkh'];
		$idname = $_POST['idname'];
		if ($idkh != "" && $value == "sohopdong") {
			$Gid = " and idkhachhang='$idkh'";
		}
		elseif ($value == "tenkhachhang"){
			$wh = ", idkhachhang, tenkhachhang";
		}
			$sql = "select id, sohopdong $wh from $GLOBALS[db_sp].ql_hopdong_nhap where $where LIKE '%" . $queryString . "%' $Gid GROUP BY $value order by id asc limit 20 ";
			$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){	
			if ($value == "sohopdong") {
				$str .= '
					<a href="javascript:void(0)" onclick=\'insertHopDong("'.$item['id'].'")\'> 
						'.$item[$value].'
					</a>
				';
			}else{	
				$str .= '
					<a href="javascript:void(0)" onclick=\'insertTenKH("'.$item['idkhachhang'].'","'.$item['tenkhachhang'].'")\'> 
						'.$item[$value].'
					</a>
				';
			}
		}
		echo $str;
	break;
	////////////////////////////////HOÀNG KẾT THÚC TÌM SỐ HỘP ĐỒNG & TÌM MÃ KHÁCH HÀNG ////////////////////////
	case 'SearchNhapHopDong':
	case 'SearchNhapHopDongTK':
		$where = array();
		$value = array();
		$where = $_POST['where'];
		$value = $_POST['value'];
		$idname = $_POST['idname'];
		$sql = "select id, $value from $GLOBALS[db_sp].ql_hopdong_nhap
					where $where LIKE '%" . $queryString . "%' GROUP BY $value
					order by id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if ($value == "datednhap" || $value == "datedky" || $value == "datedend") {
				$dated = explode('-',$item[$value]);
				$item[$value] = $dated[2].'/'.$dated[1].'/'.$dated[0];
			}
			elseif ($value == "trigiahopdong") {
				$item[$value] = number_format($item[$value]);
				$right = 'align="right"';
			}
			if ($act == "SearchNhapHopDong") {
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertNhapHopDong("'.$item['id'].'","'.$value.'","'.$idname.'")\'> 
					'.$item[$value].'
				</a>
			';
			}
			elseif ($act == "SearchNhapHopDongTK"){
				$str .= '
					<a href="javascript:void(0)" onclick=\'InsertNhapHopDongTK("'.$item['id'].'","'.$value.'","'.$idname.'")\'> 
						<p '.$right.'>'.$item[$value].'</p>
					</a>
				';
			}
		}
		echo $str;
	break;
	case 'SearchValue':
		$where = array();
		$value = array();
		$where = $_POST['where'];
		$value = $_POST['value'];
		$idname = $_POST['idname'];
		if ($table == "ql_hopdong_nhap") {
			$wh = " and id IN(SELECT DISTINCT idhopdong  from $GLOBALS[db_sp].ql_hopdong_chungtuthanhtoan WHERE active=1)";
		}
		$sql = "select id, $value from $GLOBALS[db_sp].".$table."
					where $where LIKE '%" . $queryString . "%' $wh GROUP BY $value
					order by id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if ($value == "datednhap" || $value == "datedchungtu") {
				$dated = explode('-',$item[$value]);
				$item[$value] = $dated[2].'/'.$dated[1].'/'.$dated[0];
			}
			elseif ($value == "giatrithanhtoan") {
				$item[$value] = number_format($item[$value]);
				$right = 'align="right"';
			}
			if ($table == "ql_hopdong_nhap") {
				$str .= '
				<a href="javascript:void(0)" onclick=\'insertHopDongCT("'.$item['id'].'","'.$value.'","'.$idname.'")\'> 
					<p>'.$item[$value].'</p>
				</a>
			';
			}else{			
				$str .= '
					<a href="javascript:void(0)" onclick=\'insertChungTu("'.$item['id'].'","'.$item['datednhap'].'","'.$item['sochungtu'].'", "'.$item['datedchungtu'].'", "'.$item['diengiaithanhtoan'].'","'.$item['giatrithanhtoan'].'")\'> 
						<p '.$right.'>'.$item[$value].'</p>
					</a>
				';
			}
		}
		echo $str;
	break;
	////////////////////////////////////HOÀNG KẾT THÚC TÌM SỐ HỘP ĐỒNG////////////////////////

	case 'SearchMaKhachHang':	
	case 'SearchTinhChatHopDong':
	case 'SearchNganHang':
			$where = array();
			$value = array();
			$where = $_POST['where'];
			$value = $_POST['value'];
	
			if ($act == "SearchMaKhachHang") {
				$wh = "id, tenkhachhang, ";
				$and = "tenkhachhang";
				$insert = "InsertMaKhachHang";
			}
			elseif ($act == "SearchTinhChatHopDong") {
				$wh = "id, tinhchathopdong, ";
				$and = "tinhchathopdong";
				$insert = "InsertTinhChatHopDong";
			}
			elseif ($act == "SearchNganHang") {
				$wh = "id, tennganhang, ";
				$and = "tennganhang";
				$insert = "InsertNganHang";
				$idname = $_POST['idname'];
			}
			$sql = "select $wh $value from $GLOBALS[db_sp].".$table."
						where $where LIKE '%" . $queryString . "%' and active=1
							or $and LIKE '%" . $queryString . "%' and active=1 GROUP BY $value
							order by num asc, id asc limit 20";
			$rs = $GLOBALS["sp"]->getAll($sql);
			
			foreach($rs as $item){
					$str .= '
					<a href="javascript:void(0)" onclick=\''.$insert.'("'.$item['id'].'","'.$item[$value].'","'.$item[$and].'","'.$idname.'")\'> 
						'.$item[$value].'  :  '.$item[$and].'
					</a>
				';
			}
			echo $str;
		break;
	// ==== Hoàng Bắt Đầu Thêm Search Ngân Hàng Theo Dòng === //
	case 'SearchNganHangDong':
		$idnum = trim($_POST['dong']);
		$sql = "select * from $GLOBALS[db_sp].dm_nganhang
						where ( tennganhang LIKE '%" . $queryString . "%' or tengiaodich LIKE '%" . $queryString . "%' )
							and active=1 
							order by tengiaodich asc, id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertNganHangDong("'.$item['id'].'","'.$item['tennganhang'].'","'.$item['tengiaodich'].'","'.$idnum.'")\'> 
					'.$item['tennganhang'].'  :  '.$item['tengiaodich'].'
				</a>
			';
		}
		echo $str;
	break;
	// ==== Hoàng Kết thúc Thêm Search Ngân Hàng Theo Dòng === //
	case 'SearchDataHopdong':
		$id = array();
		$id = $_POST['id'];
		$value = $_POST['value'];
		
		$sql = "select $value from $GLOBALS[db_sp].ql_hopdong_nhap where id=$id";
		$rs = $GLOBALS["sp"]->getOne($sql);
		if ($value == "noidunghopdong"){
			$rs = trim(strip_tags($rs));
			$rs = str_replace("'","", $rs); 
			$rs = str_replace("\"","", $rs); 
			$rs = str_replace("<p>","", $rs);
			$rs = str_replace("</p>","", $rs);
			$rs = trim(str_replace("&nbsp;","", $rs));
		}
		die(json_encode(array('value'=>$rs)));
	break;
	case 'SearchKHNCC':		
		$where = array();
		$value = array();
		$where = $_POST['where'];
		$value = $_POST['value'];
		$idname = $_POST['idname'];

		$sql = "select id, $value from $GLOBALS[db_sp].".$table." where $where LIKE '%" . $queryString . "%' GROUP BY $value order by id asc limit 20 ";
		$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'insertKHNCC("'.$item['id'].'","'.$value.'","'.$idname.'")\'> 
						<p>'.$item[$value].'</p>
					</a>
				';
			}
		echo $str;
	break;
	case 'SearchDataDMKhachhang':
		$id = array();
		$id = $_POST['id'];
		$value = $_POST['value'];
		
		$sql = "select $value from $GLOBALS[db_sp].dm_khachhang where id=$id";
		$rs = $GLOBALS["sp"]->getOne($sql);
		if ($value == "ghichu"){
			$rs = trim(strip_tags($rs));
			$rs = str_replace("'","", $rs); 
			$rs = str_replace("\"","", $rs); 
			$rs = str_replace("<p>","", $rs);
			$rs = str_replace("</p>","", $rs);
			$rs = trim(str_replace("&nbsp;","", $rs));
		}
		die(json_encode(array('value'=>$rs)));
	break;
	case 'SearchSoHopDong':
			$value = array();
			$value = $_POST['value'];
			$sql = "select id, $value from $GLOBALS[db_sp].ql_hopdong_nhap
						where active=1 and sohopdong LIKE '%" . $queryString . "%' and active=1
						order by id asc limit 20";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
					$str .= '
					<a href="javascript:void(0)" onclick=\'insertSoHopDong("'.$item['id'].'")\'> 
						'.$item[$value].'
					</a>
				';
			}
			echo $str;
	break;
	case 'getDataHopdong':
		$idhopdong = array();
		$idhopdong = $_POST['idhopdong'];
		$selected = $_POST['selected'];
		$sql = "select $selected from $GLOBALS[db_sp].ql_hopdong_nhap where id=$idhopdong";
		$rs = $GLOBALS["sp"]->getRow($sql);
		$noidunghopdong = trim(strip_tags($rs['noidunghopdong']));
		$noidunghopdong = str_replace("'","", $noidunghopdong); 
		$noidunghopdong = str_replace("\"","", $noidunghopdong);
		$noidunghopdong = str_replace("<p>","", $noidunghopdong);
		$noidunghopdong = str_replace("</p>","", $noidunghopdong);
		$noidunghopdong = trim(str_replace("&nbsp;","", $noidunghopdong));
		die(json_encode(array('user'=>$rs['user'],'sohopdong'=>$rs['sohopdong'],'mahopdong'=>$rs['mahopdong'],'noidunghopdong'=>$noidunghopdong,'datedky'=>$rs['datedky'],'datedend'=>$rs['datedend'],'trigiahopdong'=>$rs['trigiahopdong'],'idkhachhang'=>$rs['idkhachhang'],'makhachhang'=>$rs['makhachhang'],'tenkhachhang'=>$rs['tenkhachhang'])));
	break;
//////////////////////////HOÀNG KẾT THÚC TÌM SEARCH MÃ KHÁCH HÀNG & TÍNH CHẤT HỢP ĐỒNG/////////////////////
////////////////////////////HOÀNG THÊM SEARCH MÃ NHÂN VIÊN & TÊN NHÂN VIÊN///////////////////////////
	case 'SearchNhanVien':
		$value = array();
		$value = trim($_POST['value']);
		$name = trim($_POST['name']);
		$and = "fullname";
		
		$sql = "select id, dienthoai, fullname,$value from $GLOBALS[db_spns].nhanvien
					where ( $value LIKE '%" . $queryString . "%' or $and LIKE '%" . $queryString . "%' ) 
						and active=1 
						and status=1
					order by id asc limit 20";
		$rs = $GLOBALS["spns"]->getAll($sql);
		
		foreach($rs as $item){
			$item['dienthoai'] = str_replace("'", '', $item['dienthoai']);
			$item['dienthoai'] = str_replace('"', '', $item['dienthoai']);
				$str .= '
				<a href="javascript:void(0)" onclick=\'insertNhanVien("'.$item['id'].'","'.$item[$value].'","'.$item[$and].'","'.$name.'","'.$item['dienthoai'].'")\'> 
					'.$item[$value].'  :  '.$item[$and].'
				</a>
			';
		}
		echo $str;
	break;
	
	case 'SearchNhanVienTKTTS':
		$type = trim($_POST['type']);
		$sql = "select id, manv, fullname from $GLOBALS[db_spns].nhanvien
				where (manv LIKE '%" . $queryString . "%' or fullname LIKE '%" . $queryString . "%') 
					and active=1 
					and status=1
				order by id asc limit 20
		";
		$rs = $GLOBALS["spns"]->getAll($sql);
		
		foreach($rs as $item){
				$str .= '
				<a href="javascript:void(0)" onclick=\'insertNhanVien("'.$item['id'].'","'.$item['manv'].'","'.$item['fullname'].'","'.$type.'")\'> 
					'.$item['manv'].': '.$item['fullname'].'
				</a>
			';
		}
		echo $str;
	break;
//////////////////////////HOÀNG KẾT THÚC TÌM SEARCH MÃ NHÂN VIÊN & TÊN NHÂN VIÊN/////////////////////
/*===================TRẦN VŨ THÊM SEARCH NHIỀU TEXTBOX MÃ NHÂN VIÊN & TÊN NHÂN VIÊN========================*/
	case 'SearchMulNhanVien':
		$value = array();
		$value = trim($_POST['value']);
		$name = trim($_POST['name']);
		$nameId = trim($_POST['nameId']);
		$nameWarm = trim($_POST['nameWarm']);
		$and = "fullname";
		
		$sql = "select id, fullname,$value from $GLOBALS[db_spns].nhanvien
					where $value LIKE '%" . $queryString . "%' and active=1 and status=1
						or $and LIKE '%" . $queryString . "%' and active=1 and status=1 GROUP BY $value
						order by id asc limit 20";
		$rs = $GLOBALS["spns"]->getAll($sql);
		
		foreach($rs as $item){
				$str .= '
				<a href="javascript:void(0)" onclick=\'insertMulNhanVien("'.$item['id'].'","'.$item[$value].'","'.$item[$and].'","'.$name.'","'.$nameId.'","'.$nameWarm.'")\'> 
					'.$item[$value].'  :  '.$item[$and].'
				</a>
			';
		}
		echo $str;
	break;
	//============
	case 'SearchNhanVienDieuKien':
		$type = trim($_POST['type']);
		$sql = "select id, manv, fullname from $GLOBALS[db_spns].nhanvien
				where (manv LIKE '%" . $queryString . "%' or fullname LIKE '%" . $queryString . "%') 
					and active=1 
					and status=1
				order by id asc limit 20
		";
		$rs = $GLOBALS["spns"]->getAll($sql);
		
		foreach($rs as $item){
				$str .= '
				<a href="javascript:void(0)" onclick=\'insertNhanVienDieuKien("'.$item['id'].'","'.$item['manv'].'","'.$item['fullname'].'","'.$type.'")\'> 
					'.$item['manv'].': '.$item['fullname'].'
				</a>
			';
		}
		echo $str;
	break;
/*===================END TRẦN VŨ THÊM SEARCH NHIỀU TEXTBOX MÃ NHÂN VIÊN & TÊN NHÂN VIÊN========================*/
//////////////////////////HOÀNG THÊM SEARCH DuLieuSPKHTCH///////////////////////////
	case 'SearchDuLieuSPKHTCH':
		$where = $_POST['where'];
		$value = $_POST['value'];
		$idname = $_POST['idname'];
		$sql = "select id, $value from $GLOBALS[db_sp].".$table." where $where LIKE '%" . $queryString . "%' GROUP BY $value order by id asc limit 20 ";
		$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'insertDuLieuSPKHTCH("'.$item['id'].'","'.$item[$value].'","'.$idname.'")\'> 
						<p>'.$item[$value].'</p>
					</a>
				';
			}
		echo $str;
	break;
	/*===================HOÀNG THÊM SEARCH Toa hàng sản xuất 20/12/2022========================*/
	case 'SearchDuLieuSPKHTCH_THSX':
		$where = $_POST['where'];
		$value = $_POST['value'];
		$idname = $_POST['idname'];
		$idodsx = getOneInAll(" GROUP_CONCAT(idodsx) AS idodsx","nhapdulieuspkhtch_tiencongkhachdat","trangthai=2 and typePTC=3 and idodsx>0");
		$sql = "select id, $value from $GLOBALS[db_catalog].".$table." where $where LIKE '%" . $queryString . "%' and id in (".$idodsx.")";
		$rs = $GLOBALS["catalog"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'insertDuLieuSPKHTCH_THSX("'.$item['id'].'","'.$item[$value].'","'.$idname.'")\'> 
						<p>'.$item[$value].'</p>
					</a>
				';
			}
		echo $str;
	break;
	/*===================HOÀNG KẾT THÚC SEARCH Toa hàng sản xuất 20/12/2022========================*/
//////////////////////////HOÀNG KẾT THÚC SEARCH DuLieuSPKHTCH/////////////////////
	case "select2ajax-spkhtch-masomau":
		$page = ceil(trim($_POST['page']));
		$page = $page > 1 ? $page - 1 : 0;
		$limit = 20;
		$wh = "";

		if(!empty($_POST['search'])){
			$search = $_POST['search'];
			$wh = "and code like '%".$search."%'";
		}

		$sqltotal = "SELECT count(id) from $GLOBALS[db_catalog].products 
					WHERE cid NOT IN (SELECT id  FROM $GLOBALS[db_catalog].categories WHERE pid=314) 
					$wh";
		$total = $GLOBALS['catalog']->getOne($sqltotal);
		$begin = ($page)*$limit;
		$total_page = ceil($total/$limit);

		$sql = "SELECT  id, code,typegold, typepr, img_thumb_vn, img_vn
			from $GLOBALS[db_catalog].products 
			WHERE cid NOT IN (SELECT id  FROM $GLOBALS[db_catalog].categories WHERE pid=314) 
			$wh	order by id desc 
			limit $begin,$limit";
		$rs = $GLOBALS["catalog"]->getAll($sql);

		$data = array();

		if (empty($rs)){
			$data['item'][] = array("id"=>"", "picture"=>"", "text"=>"", "text2"=>"");
		}else{
			foreach ($rs as $row) {
				if ($row['code'] != ""){
					$piturefill = empty($row['img_vn']) ? "" : $urlCatalog.$row['img_vn'];
					$piturefill_vn = empty($row['img_thumb_vn']) ? "" : $urlCatalog.$row['img_thumb_vn'];
					$typepr = getTypeprCatalog("typepr","name_vn",$row['typepr']);
					$loaivang = getName("loaivang","name_vn",$row['typegold']);
					$data['item'][] = array("id"=>"$row[id],$row[code],$piturefill,$piturefill_vn", "picture"=>$piturefill_vn, "text"=>$row['code'], "text2"=>$typepr, "text3"=>$loaivang);
				}
			}
		}
		
		$data['total_page'] = $total_page;
		// die($sql);
		echo json_encode($data);
	break;
	case "select2ajax-spkhtch-masomau-new":
		$page = ceil(trim($_POST['page']));
		$page = $page > 1 ? $page - 1 : 0;
		$limit = 20;
		$wh = "";

		if(!empty($_POST['search'])){
			$search = $_POST['search'];
			$wh = "and code like '%".$search."%'";
		}
		
		$sqltotal = "SELECT count(id) from $GLOBALS[db_catalog].products_new WHERE typeproduct IN (1, 4, 5, 6) and typedelete = 0 $wh";
		$total = $GLOBALS['catalog']->getOne($sqltotal);
		$begin = ($page)*$limit;
		$total_page = ceil($total/$limit);

		$sql = "SELECT  id, code, typegold, iddmnhomsp, imgrender_vn, imgrenderthumb_vn, img_vn, imgthumb_vn
			from $GLOBALS[db_catalog].products_new 
			WHERE typeproduct IN (1, 4, 5, 6) and typedelete = 0 
			$wh	order by id desc 
			limit $begin,$limit";
		$rs = $GLOBALS["catalog"]->getAll($sql);

		$data = array();

		if (empty($rs)){
			$data['item'][] = array("id"=>"", "picture"=>"", "text"=>"", "text2"=>"");
		}else{
			foreach ($rs as $row) {
				$piturefill = empty($row['imgrender_vn']) ? "" : $urlCatalog.$row['imgrender_vn'];
				$piturefill_vn = empty($row['imgrenderthumb_vn']) ? "" : $urlCatalog.$row['imgrenderthumb_vn'];
				if (empty($row['imgrender_vn'])){
					$piturefill = empty($row['img_vn']) ? "" : $urlCatalog.$row['img_vn'];
					$piturefill_vn = empty($row['imgthumb_vn']) ? "" : $urlCatalog.$row['imgthumb_vn'];
				}
				$sql_nhomsp = "SELECT name_vn, kituma from $GLOBALS[db_catalog].dmsp_nhomsanpham where id = $row[iddmnhomsp]";
				$nhomsp = trim($GLOBALS['catalog']->getOne($sql_nhomsp));

				$loaivang = getName("loaivang", "name_vn", $row['typegold']);
				$data['item'][] = array("id"=>"$row[id],$row[code],$piturefill,$piturefill_vn", "picture"=>$piturefill_vn, "text"=>$row['code'], "text2"=>$nhomsp, "text3"=>$loaivang);
			}
		}
		
		$data['total_page'] = $total_page;
		// die($sql);
		echo json_encode($data);
	break;

	//=======================M.TÂN THÊM CỦA KHO VÀNG CŨ CHI NHÁNH=======================================//
	// M.Tân thêm ngày 05/08/2020 - Load list kim cương cho kho Vàng Cũ CN ứng với idtennguyenlieukimcuong
	case "danhmuckimcuongkhovangcucn":
		$idtennguyenlieukimcuong = ceil(trim($_POST['idtennguyenlieukimcuong']));
		if($idtennguyenlieukimcuong == 1757) { // Là kim cương tem => show nước kim cương (vd: (F/REXCO))
			$sql = "select * from $GLOBALS[db_sp].loaikimcuonghotchu 
							where active=1 
							and (size LIKE '%" . $queryString . "%' or  name_vn LIKE '%" . $queryString . "%' )
							order by size asc,name_vn asc, id asc limit 100
					";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'searchDMKimCuong('.$item['id'].',"'.$item['name_vn'].'","'.$item['size'].'","'.$item['giavon'].'","'.$item['giaban'].'")\'> 
						<div class="img_search">
							
						</div>
						<div class="FL">
							<span>'.$item["size"].'</span> :: '.$item["name_vn"].' 
						</div>
					</a>
				';
			}
		} else if($idtennguyenlieukimcuong == 1945) { // Là kim cương rời => thay nước kim cương bằng chữ kim cương rời
			$sql = "select * from $GLOBALS[db_sp].loaikimcuonghotchu 
							where active=1 
							and (size LIKE '%" . $queryString . "%')
							group by size
							order by size asc, name_vn asc, id asc limit 100
					";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'searchDMKimCuong('.$item['id'].',"'.$item['name_vn'].'","'.$item['size'].'","'.$item['giavon'].'","'.$item['giaban'].'")\'> 
						<div class="img_search">
							
						</div>
						<div class="FL">
							<span>'.$item["size"].'</span> :: Kim Cương Rời 
						</div>
					</a>
				';
			}
		}
		echo $str;
	break;

	// Tìm kiếm Mã Số Mẫu (table products catalog) Kho Vàng Cũ CN
	case "searchMaSoMauKimCuongTamKhoVangCuCN":
		$numdongvanghangttkimcuongtam = ceil(trim($_POST['numdongvanghangttkimcuongtam']));
		$str .= '
			<a href="javascript:void(0)" onclick=\'InsertMaSoMauKhoVangCuCN("'.$numdongvanghangttkimcuongtam.'", 0, "", "", "", "")\'> 
				Không Mã số mẫu
			</a>
		';
		$sql = "select * from $GLOBALS[db_catalog].products_new where kytumamauvang IN ('KC', 'KV') AND typeproduct IN (1,4,5,6) AND active = 1 AND typedelete = 0 and code LIKE '%" . $queryString . "%' order by id asc limit 20";
		$rs = $GLOBALS['catalog']->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertMaSoMauKhoVangCuCN("'.$numdongvanghangttkimcuongtam.'", "'.$item['id'].'", "'.$item['code'].'","'.$item['chitiethot'].'", "'.$item['imgthumb_vn'].'", "'.$item['img_vn'].'")\'> 
					'.$item["code"].' - '.$item["chitiethot"].'
				</a>
			';
		}
		echo $str;
	break;

	case "searchHotTamKhoVangCuCN":
		$idnumkctam = ceil(trim($_POST['idnumkctam']));
		$idphieuctkimcuongtam = ceil(trim($_POST['idphieuctkimcuongtam'])); // num dòng kim cương tấm

		$sql = "select * from $GLOBALS[db_catalog].thongsohottam where size LIKE '%" . $queryString . "%' order by id asc limit 20";
		$rs = $GLOBALS['catalog']->getAll($sql);
		foreach($rs as $item){
			if($idphieuctkimcuongtam == '' || $idphieuctkimcuongtam == 0) {
				$str .= '
					<a href="javascript:void(0)" onclick=\'InsertSizeHotTamKhoVangCuCN("'.$idnumkctam.'", "'.$idphieuctkimcuongtam.'", "'.$item['id'].'", "'.$item['size'].'","'.$item['giaban'].'","'.$item['giagocvnd'].'")\'> 
						'.$item["size"].' - '.number_format($item["giaban"],0).'
					</a>
				';
			} else {
				$str .= '
					<a href="javascript:void(0)" onclick=\'InsertSizeHotTamKhoVangCuCN("'.$idnumkctam.'", "'.$idphieuctkimcuongtam.'", "'.$item['id'].'", "'.$item['size'].'","'.$item['giaban'].'","'.$item['giagocvnd'].'")\'> 
						'.$item["size"].' - '.number_format($item["giagocvnd"],0).'
					</a>
				';
			}
		}
		echo $str;
	break;

	case 'searchMaPhieuKimCuongDieuChinhSoLieuKhoVangCuCN':
		$sql = "select * from $GLOBALS[db_sp].".$table."
						 where type=1 and trangthai=2 and typevkc = 2 and maphieu LIKE '%" . $queryString . "%'
						 order by id asc limit 50";
		$rs = $GLOBALS["sp"]->getAll($sql);

		foreach($rs as $item) {
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
		}
		echo $str;
	break;

	case 'searchMaPhieuVangDieuChinhSoLieuKhoVangCuCN':
		$sql = "select * from $GLOBALS[db_sp].".$table."
						 where type=1 and trangthai=2 and typevkc = 1 and maphieu LIKE '%" . $queryString . "%'
						 order by id asc limit 50";
		$rs = $GLOBALS["sp"]->getAll($sql);

		foreach($rs as $item) {
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
		}
		echo $str;
	break;

	case 'searchMaPhieuKimCuongTamDieuChinhSoLieuKhoVangCuCN':
		$sql = "select * from $GLOBALS[db_sp].".$table."
						 where type=1 and trangthai=2 and typevkc = 3 and maphieu LIKE '%" . $queryString . "%'
						 order by id asc limit 50";
		$rs = $GLOBALS["sp"]->getAll($sql);

		foreach($rs as $item) {
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchMaPhierChinhSuaSoLieu("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
		}
		echo $str;
	break;

	// TIm chi tiết hột tấm theo Mã đá catalog
	case "getChiTietHotTamTheoMaDa":		
		$num = !empty($_POST['num']) ? trim($_POST['num']) : 0;
		$maDaCatalog = !empty($_POST['maDaCatalog']) ? trim($_POST['maDaCatalog']) : '';
		$arrsel = !empty($queryString) ? StrToArray($queryString,"size") : array();
		$str = '';
		
		if(!empty($maDaCatalog)) {			
			$sql = "select id, size from $GLOBALS[db_catalog].thongsohottam where active=1 and pid IN (SELECT id FROM $GLOBALS[db_catalog].thongsohottam WHERE madacatalog='$maDaCatalog') order by size asc";
			$rs = $GLOBALS['catalog']->getAll($sql);				
			foreach($rs as $item) {
				$val = '';
				foreach($arrsel as $sel) {
					if ($item['size'] == $sel['size'])
						$val = $sel['soluong'];
				}
				$str .= '<a>
							<div class="titles">
								<input name="size" class="size" value="'.$item['size'].'" />
								<input type="hidden" name="idhottamct" value="'.$item['id'].'" />
							</div>
							<input name="soluong" autocomplete="off" class="soluong InputText autoNumeric0" value="'.$val.'" />
						</a>
					';
			}
		}
		if( $str == '' )
			$str  = 'Không tìm thấy.';
		else
			$str = '<div id="thongtinhottam'.$num.'">
						'.$str.'
						<a class="luulai" onclick="addChiTietHot('.$num.')" href="javascript:void(0)" title="Thêm" class="clear">
							<strong>Chọn</strong>
						</a>
					</div>	
				';
		echo $str;
	break;
	//==========================KẾT THÚC M.TÂN THÊM CỦA KHO VÀNG CŨ CHI NHÁNH===================================//
	// ==== 8/1/2021 BAT DAU A.VU THEM SEARCH DANH MUC KHACH HANG === //
	case 'SearchDanhMucKhachHang':
		$sql = "select * from $GLOBALS[db_sp].dm_khachhang
					where ( makhachhang LIKE '%" . $queryString . "%' or tenkhachhang LIKE '%" . $queryString . "%' ) 
						and active=1 
						order by num asc, id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$nganhang = getName('dm_nganhang','tengiaodich',$item['idnganhang']).' :: '.getName('dm_nganhang','tennganhang',$item['idnganhang']);
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertDanhMucKhachHang("'.$item['id'].'","'.$item['makhachhang'].'","'.$item['tenkhachhang'].'","'.$item['chutaikhoan'].'","'.$item['sotaikhoannganhang'].'","'.$nganhang.'","'.$item['masothue'].'")\'> 
					'.$item['makhachhang'].'  :  '.$item['tenkhachhang'].'
				</a>
			';
		}
		echo $str;
	break;
	// ==== 8/1/2021 KET THUC A.VU THEM SEARCH DANH MUC KHACH HANG === //
	// ==== BAT DAU HOÀNG THEM SEARCH - CATALOG - KHO VAT DUNG DO NGHE - DANH MUC KHACH HANG=== //
	case 'SearchKeToanKhoVatDungDoNgheDM':
		$idnum = trim($_POST['dong']);
		$sql = "select * from $GLOBALS[db_catalog].khovatdungdonghe
						where ( code_muahang LIKE '%" . $queryString . "%' or name_muahang LIKE '%" . $queryString . "%' )
							and active=1 
							order by code_muahang asc, id asc limit 20";
		$rs = $GLOBALS["catalog"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertKeToanKhoVatDungDoNghe("'.$item['id'].'","'.$item['code_muahang'].'","'.$item['name_muahang'].'","'.$item['donvi_muahang'].'","'.$item['dongia_muahang'].'","'.$idnum.'")\'> 
					'.$item['code_muahang'].'  :  '.$item['name_muahang'].'
				</a>
			';
		}
		echo $str;
	break;	
	// ==== KET THUC A.VU THEM SEARCH - CATALOG - KHO VAT DUNG DO NGHE - DANH MUC KHACH HANG=== //
	// ==== BAT DAU A.VU THEM SEARCH - CATALOG - KHO VAT DUNG DO NGHE === //
	case 'SearchKeToanKhoVatDungDoNghe':
		$wh_kho = '';
		$idnum = ceil($_POST['dong']);
		$idkho = ceil($_POST['idkho']);
		$idtinhchatdathang = ceil($_POST['idtinhchatdathang']);
		if($idkho > 0){
			$sqlkho = "select table_catalog,cid_catalog from $GLOBALS[db_sp].ketoan_dm_kho where id=$idkho";
			$rskho = $GLOBALS["sp"]->getRow($sqlkho);
			$table_catalog = $rskho['table_catalog'];
			$cid_catalog = $rskho['cid_catalog'];
		}
		if($table_catalog == "khovatdungdonghe"){
			if($idtinhchatdathang > 0){
				$sql_tcdh = "select * from $GLOBALS[db_sp].ketoan_dm_tinhchatmuahang where id = $idtinhchatdathang";
				$rs_tcdh = $GLOBALS["sp"]->getRow($sql_tcdh);
				// Lấy id child tu pid = 5
				if(strpos($rs_tcdh['cid_check'],',5,')){
					$arrsub = unserialize($rs_tcdh['checksub']);
					foreach($arrsub as $sub){
						if($sub['pid'] == 5)
							$id_child = $sub['id_child'];
					}
					if($id_child > 0){
						$sql_dm_kho = "select cid from $GLOBALS[db_sp].ketoan_dm_kho where id = $id_child";
						$cid_dm_kho = $GLOBALS["sp"]->getOne($sql_dm_kho);
						if($cid_dm_kho == 2221){ // Không thay đổi mã hàng mua
							$wh_kho = "and code_muahang = masp";
						}
						else if($cid_dm_kho == 2222){ // Có thay đổi mã hàng mua
							$wh_kho = "and code_muahang <> masp";
						}
					}
				}
			}
			$sql = "select * from $GLOBALS[db_catalog].khovatdungdonghe where  ( code_muahang LIKE '%" . $queryString . "%' or name_muahang LIKE '%" . $queryString . "%' ) $wh_kho and active=1 order by code_muahang asc, id asc limit 20";
		}
		else if($table_catalog == "banggiada"){
			$sql = "select * from $GLOBALS[db_catalog].banggiada where cid in (select id from $GLOBALS[db_catalog].categories where pid in(select id from $GLOBALS[db_catalog].categories where pid in (".$cid_catalog."))) and ( code_muahang LIKE '%" . $queryString . "%' or name_muahang LIKE '%" . $queryString . "%' ) and active=1 order by code_muahang asc, id asc limit 20";
		}
		$rs = $GLOBALS["catalog"]->getAll($sql);
		foreach($rs as $item){
			if($table_catalog == "khovatdungdonghe")
				$makho = $item['masp'];
			else if($table_catalog == "banggiada")
				$makho = $item['code'];

			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertKeToanKhoVatDungDoNghe("'.$item['id'].'","'.$item['code_muahang'].'","'.$item['name_muahang'].'","'.$item['donvi_muahang'].'","'.$item['dongia_muahang'].'","'.$idnum.'")\'> 
					'.$item['code_muahang'].'  :  '.$item['name_muahang'].'<br><span style="color:#990000">Mã kho: '.$makho.'</span>
				</a>
			';
		}
		echo $str;
	break;
	// ==== KET THUC A.VU THEM SEARCH - CATALOG - KHO VAT DUNG DO NGHE === //
	// ==== BAT DAU A.VU THEM SEARCH - KE TOAN DAT HANG === //
	case 'searchKeToanDatHang':
		$cid = $_POST['cid'];
		$where = $_POST['where'];
		$value = $_POST['value'];
		$idname = $_POST['idname'];

		if($cid == '2227'){
			$where .= " idquytrinh IN (select id from $GLOBALS[db_sp].ketoan_dm_quytrinh where cidkho = 2224) and cid = 2225 and trangthai = 1 and $value"; // cidkho = 2224 > DangSuaChua
		}


		if($value == 'soluongtong' || $value == 'thanhtientong' || $value == 'thanhtienthuetong'){
			$queryString = str_replace(",", "", $queryString);
		}
		if($value == 'mid')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_noidung_dathang where $where in (select id from $GLOBALS[db_sp].admin where fullname LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else if($idname == 'makhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_noidung_dathang where $where in (select id from $GLOBALS[db_sp].dm_khachhang where makhachhang LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else if($idname == 'tenkhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_noidung_dathang where $where in (select id from $GLOBALS[db_sp].dm_khachhang where tenkhachhang LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else if($idname == 'iddiadiemnhanhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_noidung_dathang where $where in (select id from $GLOBALS[db_sp].ketoan_dm_hinhthucnhanhang where diadiemnhanhang LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else if($idname == 'idnhanviens' || $idname == 'idnhanviennhanhangsudungs' || $idname == 'idnhanviennghiemthus' || $idname == 'idnhanviennhanhangsuachuas'){
			$sqlnv = "select id from $GLOBALS[db_spns].nhanvien where fullname LIKE '%" . $queryString . "%'";
			$rsnv = $GLOBALS['spns']->getCol($sqlnv);
			$strnv = implode(',', $rsnv);
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_noidung_dathang where $where in ($strnv) group by $value order by id asc limit 20 ";
		}
		else
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_noidung_dathang where $where LIKE '%" . $queryString . "%' group by $value order by id asc limit 20 ";

		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($value == 'mid'){
				$itemStr = getName('admin','fullname',$item[$value]);
			}
			else if($idname == 'tenkhachhangs'){
				$itemStr = getName('dm_khachhang','tenkhachhang',$item[$value]);
			}
			else if($idname == 'makhachhangs'){
				$itemStr = getName('dm_khachhang','makhachhang',$item[$value]);
			}
			else if($idname == 'iddiadiemnhanhangs'){
				$itemStr = getName('ketoan_dm_hinhthucnhanhang','diadiemnhanhang',$item[$value]);
			}
			else if($idname == 'idnhanviens' || $idname == 'idnhanviennhanhangsudungs' || $idname == 'idnhanviennghiemthus' || $idname == 'idnhanviennhanhangsuachuas'){
				$sqlnhanvien = "select fullname from $GLOBALS[db_spns].nhanvien where id = ".$item[$value];
				$itemStr = $GLOBALS['spns']->getOne($sqlnhanvien);
			}
			else if($value == 'soluongtong'){
				$itemStr = number_format($item[$value],2);
				$right = 'align="right"';
			}
			else if($value == 'thanhtientong' || $value == 'thanhtienthuetong'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanDatHang("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	// ==== KET THUC A.VU THEM SEARCH - KE TOAN DAT HANG === //
	// ==== BAT DAU A.VU THEM SEARCH - KE TOAN CÔNG NỢ === //
	case 'searchKeToanCongNo':
		//$cid = $_POST['cid'];
		$where = $_POST['where'];
		$value = $_POST['value'];
		$idname = $_POST['idname'];

		//$where = "idloaicongno in (select id from $GLOBALS[db_sp].ketoan_congno_dm where cid_danhsachcongno = $cid) and $where";

		if($idname == 'sotiendukiens' || $idname == 'sotientongs'){
			$queryString = str_replace(",", "", $queryString);
		}
		if($idname == 'makhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_congno where $where in (select id from $GLOBALS[db_sp].dm_khachhang where makhachhang LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else if($idname == 'tenkhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_congno where $where in (select id from $GLOBALS[db_sp].dm_khachhang where tenkhachhang LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else if($idname == 'idquanlyhopdongs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_congno where $where in (select id from $GLOBALS[db_sp].ql_hopdong_nhap where mahopdong LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_congno where $where LIKE '%" . $queryString . "%' group by $value order by id asc limit 20 ";

		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($idname == 'tenkhachhangs'){
				$itemStr = getName('dm_khachhang','tenkhachhang',$item[$value]);
			}
			else if($idname == 'makhachhangs'){
				$itemStr = getName('dm_khachhang','makhachhang',$item[$value]);
			}
			else if($idname == 'idquanlyhopdongs'){
				$itemStr = getName('ql_hopdong_nhap','mahopdong',$item[$value]);
			}
			else if($idname == 'sotiendukiens' || $idname == 'sotientongs'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanCongNo("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;

	case 'searchKeToanCongNoDukien':
		$where = $_POST['where'];
		$value = $_POST['value'];
		$idloaicongno = ceil($_POST['idloaicongno']);
		$idname = $_POST['idname'];
		if(!empty($idloaicongno) && $idloaicongno > 0){
			$wh_lcn = " and idloaicongno = ".$idloaicongno;
		}
		if($idname == 'sotiendukiens' || $idname == 'sotientongs' || $idname == 'sotiens'){
			$queryString = str_replace(',', '', $queryString);
		}
		if($idname == 'makhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_congno where 1=1 $wh_lcn and $value in (select id from $GLOBALS[db_sp].dm_khachhang where makhachhang LIKE '%" . $queryString . "%') and id in (select idct from $GLOBALS[db_sp].ketoan_congno_dukien where $where) group by $value order by id asc limit 20 ";
		else if($idname == 'tenkhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_congno where 1=1 $wh_lcn and $value in (select id from $GLOBALS[db_sp].dm_khachhang where tenkhachhang LIKE '%" . $queryString . "%') and id in (select idct from $GLOBALS[db_sp].ketoan_congno_dukien where $where) group by $value order by id asc limit 20 ";
		else if($idname == 'sotiens' || $idname == 'sochungtukhacs' || $idname == 'maphieudks' || $idname == 'noidungchitiens')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_congno_dukien where idct IN (select id from $GLOBALS[db_sp].ketoan_congno where 1=1 $wh_lcn) and $value LIKE '%" . $queryString . "%' and $where group by $value order by id asc limit 20 ";
		else if($idname == 'sophieuchis')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_congno where 1=1 $wh_lcn and $value in (select id from $GLOBALS[db_sp].ketoan_chitien where maphieu LIKE '%" . $queryString . "%') and id in (select idct from $GLOBALS[db_sp].ketoan_congno_dukien where $where) group by $value order by id asc limit 20 ";
		else
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_congno where 1=1 $wh_lcn and $value LIKE '%" . $queryString . "%' and id in (select idct from $GLOBALS[db_sp].ketoan_congno_dukien where $where) group by $value order by id asc limit 20 ";
		
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($idname == 'tenkhachhangs'){
				$itemStr = getName('dm_khachhang','tenkhachhang',$item[$value]);
			}
			else if($idname == 'makhachhangs'){
				$itemStr = getName('dm_khachhang','makhachhang',$item[$value]);
			}
			else if($idname == 'sophieuchis'){
				$itemStr = getName('ketoan_chitien','maphieu',$item[$value]);
			}
			else if($idname == 'sotiendukiens' || $idname == 'sotientongs' || $idname == 'sotiens'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanCongNo("'.$item['id'].'",`'.$itemStr.'`,"'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	// ==== KET THUC A.VU THEM SEARCH - KE TOAN CÔNG NỢ === //
	// ==== HOÀNG THÊM LOAD GIỜ ÁP DỤNG IN === //
	case"LoadTimeapplyIn":
		$str = "";
		$datedapply = $_POST['datedapply'];
		if(!empty($datedapply)){
			$datedapply = explode('/',$datedapply);
			$datedin = $datedapply[2].'-'.$datedapply[1].'-'.$datedapply[0];	
		}
		$sql = "select id,timeapply from $GLOBALS[db_sp].nhapdulieuspkhtch_banvmtt_ct where idchinhanh=1 and datedapply='$datedin'";
		$rs = $GLOBALS["sp"]->getAll($sql);

		foreach($rs as $item){
			$timeapply = explode(':',$item['timeapply']);
			$timeapply = $timeapply[0].':'.$timeapply[1];

			$str .= "<option value='".$item['id']."'>".$timeapply."</option>";
		}
		echo $str;
	break;
	// ==== HOÀNG KẾT THÚC LOAD GIỜ ÁP DỤNG IN === //
	// ==== MAI THÊM GET MENU ĐỘNG == //
	case "LookMoreMenu":
		$id = trim($_POST['id']);
		
		echo DownMoreMenu($id);
	break;
	// ==== KẾT THÚC GET MENU ĐỘNG == //
	case "select2ajax-getnhanvien-pmns":
		$page = ceil(trim($_POST['page']));
		$page = $page > 1 ? $page - 1 : 0;
		$limit = 20;
		$wh = "";

		if(!empty($_POST['search'])){
			$search = $_POST['search'];
			$wh = "and fullname like '%".$search."%' or manv like '%".$search."%'";
		}

		$sqltotal = "SELECT count(id) from $GLOBALS[db_spns].nhanvien 
					WHERE active=1 and status < 4 $wh";
		$total = $GLOBALS['spns']->getOne($sqltotal);
		$begin = ($page)*$limit;
		$total_page = ceil($total/$limit);

		$sql = "SELECT id, manv, fullname, chucdanh from $GLOBALS[db_spns].nhanvien 
				WHERE active=1 and status < 4 $wh 
				order by id asc limit $begin,$limit";
		$rs = $GLOBALS["spns"]->getAll($sql);

		$data = array();

		if (empty($rs)){
			$data['item'][] = array("id"=>"", "text"=>"");
		}else{
			foreach ($rs as $row) {
				$sqlchucdanh = "SELECT name_vn from $GLOBALS[db_spns].loaichucdanh where id=$row[chucdanh]";
				$chucdanh = trim($GLOBALS['spns']->getOne($sqlchucdanh));
				$data['item'][] = array("id"=>"$row[id],$row[manv],$row[fullname],$chucdanh", "text"=>"$row[manv] | $row[fullname]");
			}
		}
		
		$data['total_page'] = $total_page;
		// die($sql);
		echo json_encode($data);
	break;
	case "select2ajax-ksdtnx-phieudenghi":
		$page = ceil(trim($_POST['page']));
		$page = $page > 1 ? $page - 1 : 0;
		$limit = 20;
		$wh = "where type=1";

		if(!empty($_POST['search'])){
			$search = $_POST['search'];
			$wh .= " and code like '%".$search."%' ";
		}

		$sqltotal = "SELECT count(id) from $GLOBALS[db_sp].kiemsoatdetonnx_lapdenghiktdt $wh";
		$total = $GLOBALS['sp']->getOne($sqltotal);
		$begin = ($page)*$limit;
		$total_page = ceil($total/$limit);

		$sql = "SELECT id, code, idnvkiemtrahangton_pmns, phongbankiemtra from $GLOBALS[db_sp].kiemsoatdetonnx_lapdenghiktdt $wh 
				order by id asc limit $begin,$limit";
		$rs = $GLOBALS["sp"]->getAll($sql);

		$data = array();

		if (empty($rs)){
			$data['item'][] = array("id"=>null, "text"=>null);
		}else{
			foreach ($rs as $row) {
				$sqlnv = "SELECT fullname from $GLOBALS[db_spns].nhanvien where id=$row[idnvkiemtrahangton_pmns]";
				$nv = $GLOBALS['spns']->getOne($sqlnv);
				$data['item'][] = array("id"=>"$row[id],$row[code],$nv,$row[phongbankiemtra]", "text"=>"$row[code]");
			}
		}
		
		$data['total_page'] = $total_page;
		// die($sql);
		echo json_encode($data);
	break;
	case 'search-kxdtnx-lapdn':
		$id = trim($_POST['id']);
		$type = trim($_POST['type']);
		$table = trim($_POST['table']);
		$select = $type;
		$manv = '';
		$wh = " and $type like '%$queryString%' and $type <> '' ";
		if ($type == 'dated' || $type == 'datekiemtra'){
			$select = " DATE_FORMAT($type, '%d/%m/%Y') as $type";
			if (!empty(trim($queryString))){
				$whdate = autoFormatDateSQLSyntax($queryString);
				$wh = " and $type like '%$whdate%' ";
			}
		}

		if ($table == 'nhanvien'){
			$wh .= " or manv like '%$queryString%' ";
			$sql = "SELECT manv, $select from $GLOBALS[db_spns].$table where active = 1 and status <> 4 $wh limit 20";
			$rs = $GLOBALS["spns"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'InsertNhapDL("'.$item[$type].'", "'.$id.'")\'> 
						<p>'.$item['manv'].' : '.$item[$type].'</p>
					</a>
				';
			}
		}
		else{
			$sql = "SELECT DISTINCT $select from $GLOBALS[db_sp].$table where 1=1 $wh order by id desc limit 20";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'InsertNhapDL("'.$item[$type].'", "'.$id.'")\'> 
						<p>'.$item[$type].'</p>
					</a>
				';
			}
		}

		echo $str;
	break;
	case 'search-kxdtnx-nhapdl':
		$id = trim($_POST['id']);
		$type = trim($_POST['type']);
		$table = trim($_POST['table']);
		$select = $type;
		$manv = '';
		$wh = " and $type like '%$queryString%' ";
		if ($type == 'datethucte'){
			$select = " DATE_FORMAT($type, '%d/%m/%Y') as $type";
			if (!empty(trim($queryString))){
				$whdate = autoFormatDateSQLSyntax($queryString);
				$wh = " and $type like '%$whdate%' ";
			}
		}
		elseif ($type == 'phongbankiemtra'){
			$wh .= " and id in (select idlapdenghi from $GLOBALS[db_sp].kiemsoatdetonnx_nhapdulieuktdt) ";
		}

		if ($table == 'nhanvien'){
			$wh .= " or manv like '%$queryString%' ";
			$sql = "SELECT manv, $select from $GLOBALS[db_spns].$table where active = 1 and status <> 4 $wh limit 20";
			$rs = $GLOBALS["spns"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'InsertNhapDL("'.$item[$type].'", "'.$id.'")\'> 
						<p>'.$item['manv'].' : '.$item[$type].'</p>
					</a>
				';
			}
		}
		else if ($type == 'tongvangthucte' || $type == 'tongvangbaocao' || $type == 'haoduthucte' || $type == 'haoduhangngay' || $type == 'haodulechcan' || $type == 'haodusaiso'){
			$sql = "SELECT DISTINCT $select from $GLOBALS[db_sp].$table where 1=1 $wh order by id desc limit 20";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a style="text-align:right" href="javascript:void(0)" onclick=\'InsertNhapDL("'.$item[$type].'", "'.$id.'")\'> 
						<p>'.number_format($item[$type], 3).'</p>
					</a>
				';
			}
		}
		else{
			$sql = "SELECT DISTINCT $select from $GLOBALS[db_sp].$table where 1=1 $wh order by id desc limit 20";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				$str .= '
					<a href="javascript:void(0)" onclick=\'InsertNhapDL("'.$item[$type].'", "'.$id.'")\'> 
						<p>'.$item[$type].'</p>
					</a>
				';
			}
		}

		echo $str;
	break;
	// ==== BAT DAU A.VU THEM SEARCH - KE TOAN DAT HANG - ĐHM XUAT HOA DON === //
	case "KeToanDatHangXuatHoaDon": // cid = 2225 la ĐHM KẾT THÚC
		$sql = "select * from $GLOBALS[db_sp].".$table."
				where cid = 2225 and maphieu LIKE '%" . $queryString . "%'
				order by id desc limit 50
		";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'searchKeToanXuatHoaDon("'.$item['maphieu'].'")\'> 
					'.$item['maphieu'].'
				</a>
			';
		}
		echo $str;
	break;
	case 'SearchKeToanDMKhachHang':
		$path_url = $_POST['path_url'];
		$sql = "select * from $GLOBALS[db_sp].dm_khachhang
						where ( makhachhang LIKE '%" . $queryString . "%' or tenkhachhang LIKE '%" . $queryString . "%' )
							and active=1 
							order by num asc, id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$khachhangct = getTableRow('dm_khachhangct',' and idct = '.$item['id'].' and idstk > 0'); 
			$nganhang = getName('dm_nganhang','tengiaodich',$khachhangct['idnganhang']);
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertKeToanDMKhachHang("'.$item['id'].'","'.$item['makhachhang'].'","'.$item['tenkhachhang'].'","'.$khachhangct['chutaikhoan'].'","'.$khachhangct['sotaikhoannganhang'].'","'.$nganhang.'","'.$item['masothue'].'","'.$item['diachi'].'","'.$path_url.'")\'> 
					'.$item['makhachhang'].'  :  '.$item['tenkhachhang'].'
				</a>
			';
		}
		echo $str;
	break;
	case 'SearchKeToanDatHangMuaHangDMKhachHang':
		$path_url = $_POST['path_url'];
		$sql = "select * from $GLOBALS[db_sp].dm_khachhang
						where ( makhachhang LIKE '%" . $queryString . "%' or tenkhachhang LIKE '%" . $queryString . "%' )
							and active=1 
							order by num asc, id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			// $khachhangct = getTableRow('dm_khachhangct',' and idct = '.$item['id'].' and idstk > 0'); 
			// $nganhang = getName('dm_nganhang','tengiaodich',$khachhangct['idnganhang']);
			$khachhangct = array();
			$nganhang = '';
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertKeToanDatHangMuaHangDMKhachHang("'.$item['id'].'","'.$item['makhachhang'].'","'.$item['tenkhachhang'].'","","","","'.$item['masothue'].'","","'.$path_url.'")\'> 
					'.$item['makhachhang'].'  :  '.$item['tenkhachhang'].'
				</a>
			';
		}
		echo $str;
	break;
	case 'SearchKeToanThuTienDMKhachHang':
		$path_url = $_POST['path_url'];
		$sql = "select * from $GLOBALS[db_sp].dm_khachhang
						where ( makhachhang LIKE '%" . $queryString . "%' or tenkhachhang LIKE '%" . $queryString . "%' )
							and active=1 
							order by num asc, id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$khachhangct = getTableRow('dm_khachhangct',' and idct = '.$item['id'].' and idstk > 0'); 
			$nganhang = getName('dm_nganhang','tengiaodich',$khachhangct['idnganhang']);
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertKeToanThuTienDMKhachHang("'.$item['id'].'","'.$item['makhachhang'].'","'.$item['tenkhachhang'].'","'.$path_url.'")\'> 
					'.$item['makhachhang'].'  :  '.$item['tenkhachhang'].'
				</a>
			';
		}
		echo $str;
	break;
	
	case 'SearchKeToanCongNoDMKhachHang':
		$sql = "select * from $GLOBALS[db_sp].dm_khachhang
						where ( makhachhang LIKE '%" . $queryString . "%' or tenkhachhang LIKE '%" . $queryString . "%' )
							and active=1 
							order by num asc, id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$khachhangct = getTableRow('dm_khachhangct',' and idct = '.$item['id'].' and idstk > 0'); 
			$nganhang = getName('dm_nganhang','tengiaodich',$khachhangct['idnganhang']);
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertKeToanCongNoDMKhachHang("'.$item['id'].'","'.$item['makhachhang'].'","'.$item['tenkhachhang'].'")\'> 
					'.$item['makhachhang'].'  :  '.$item['tenkhachhang'].'
				</a>
			';
		}
		echo $str;
	break;
	case 'SearchKeToanCongNoSoHopDong':
		$where = $_POST['where'];
		$sql = "select id,mahopdong,sohopdong,noidunghopdong,datedend from $GLOBALS[db_sp].ql_hopdong_nhap
					where $where (mahopdong LIKE '%" . $queryString . "%' 
								or sohopdong LIKE '%" . $queryString . "%' 
								or noidunghopdong LIKE '%" . $queryString . "%')
					order by id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){

			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanCongNoSoHopDong("'.$item['id'].'","'.$item['mahopdong'].'","'.$item['datedend'].'")\'> 
					'.$item["mahopdong"].' ('.$item["sohopdong"].') <br><span style="color:#990000"> '.$item['noidunghopdong'].'</span>
				</a>
			';
		}
		echo $str;
	break;
	// ==== KET THUC A.VU THEM SEARCH - KE TOAN DAT HANG - ĐHM XUAT HOA DON === //

	// M.Tân thêm search mã Đơn hàng phụ kiện Catalog
	case "loadMaDonHangPhuKienCatalog":
		$madhinChon = ceil(trim($_POST['madhinChon']));
		$fromKhoPhuKien = trim(striptags($_POST['fromKhoPhuKien']));
		$userGroup = ceil(trim($_POST['userGroup']));
		
		if($fromKhoPhuKien == 'khosanxuat_phukien_dhht') { // => từ kho Phụ Kiện Đơn Hàng Hoàn Thành
			$whShowKhongDonHang = " or id=-1 ";
			$whTrangThaiDHPhuKien = " and (trangthaidhphukien=2 or trangthaidhphukien=1) "; // Sửa tạm ngày 20/10
			$whTrangThaiXuatPhuKien = " and trangthaixuatpk=1 ";
			$tablemaphukienct = 'khosanxuat_phukien_dhht_maphukienct';
		} else { // => từ kho Phụ Kiện Mới
			// if($userGroup == -1) {
				$whShowKhongDonHang = " or id=-1 ";
			// }
			$whTrangThaiDHPhuKien = " and trangthaidhphukien=1 ";
			$whTrangThaiXuatPhuKien = " ";
			$tablemaphukienct = 'khosanxuat_phukien_new_maphukienct';
		}

		$sqlGetDHPK = "select * from $GLOBALS[db_catalog].ordersanxuat 
								where ((typeorder=3 and pid > 0) $whTrangThaiDHPhuKien $whTrangThaiXuatPhuKien and code LIKE '%" . $queryString . "%' ) 
								$whShowKhongDonHang 
								order by id=-1 desc, id desc limit 10
					";
		$rsGetDHPK = $GLOBALS["catalog"]->getAll($sqlGetDHPK);
		
		foreach($rsGetDHPK as $itemGetDHPK){
			$flagHidden = 1;

			if($itemGetDHPK['id'] != -1 && $itemGetDHPK['chitietphukien_id'] != '') {
				$chiTietPhuKienArr = StrToArray($itemGetDHPK['chitietphukien_id']);
				foreach($chiTietPhuKienArr as $itemChiTietPhuKien) {
					// Get tổng số lượng phụ kiện đã chọn xuất của idphukien trong iddh này
					$sqlTongChonXuatIdPhuKien = "select sum(soluongxuat) as tongsoluongxuat from $GLOBALS[db_sp].".$tablemaphukienct." where iddh=".$itemGetDHPK['id']." and idphukien=".$itemChiTietPhuKien['id'];
					$tongChonXuatIdPhuKien = $GLOBALS['sp']->getOne($sqlTongChonXuatIdPhuKien);
					
					// Nếu tổng số lượng xuất này không bằng với tổng số lượng của đơn hàng phụ kiện => idphukien thuộc đơn hàng này chưa xuất hết
					if($tongChonXuatIdPhuKien != $itemChiTietPhuKien['soluong']) {
						$flagHidden = 0;
					}
				}
			}
			
			if (($itemGetDHPK['id'] != -1 && $flagHidden == 0) || $madhinChon == $itemGetDHPK['id'] || $itemGetDHPK['id'] == -1) {
				if($itemGetDHPK['id'] != -1) {
					// Get name loại vàng
					$sqlGetNameLoaiVang = "select name_vn from $GLOBALS[db_sp].loaivang where id=".$itemGetDHPK['idloaivang'];
					$nameLoaiVang = $GLOBALS['sp']->getOne($sqlGetNameLoaiVang);

					$str .= '
						<a href="javascript:void(0)" onclick="insertDonHangPhuKienCatalog('.$itemGetDHPK['id'].',\''.$itemGetDHPK['code'].'\',\''.$itemGetDHPK['idloaivang'].'\',\''.$nameLoaiVang.'\')">
							'.$itemGetDHPK['code'].'
						</a>
					';
				} else {
					$str .= '
						<a href="javascript:void(0)" onclick="insertDonHangPhuKienCatalog('.$itemGetDHPK['id'].',\''.$itemGetDHPK['code'].'\',0,\'\')">
							'.$itemGetDHPK['code'].'
						</a>
					';
				}
			}
		}
		echo $str;
	break;

	// M.Tân thêm search mã Đơn hàng phụ kiện Catalog - Điều chỉnh số liệu -> Show mã đơn hàng đang chọn vì đang điều chỉnh
	case "loadMaDonHangPhuKienCatalogDCSL":
		$madhinChon = ceil(trim($_POST['madhinChon']));
		$fromKhoPhuKien = trim(striptags($_POST['fromKhoPhuKien']));
		
		if($fromKhoPhuKien == 'khosanxuat_phukien_dhht') { // => từ kho Phụ Kiện Đơn Hàng Hoàn Thành
			$whShowKhongDonHang = " or id=-1 ";
			$whTrangThaiDHPhuKien = " and trangthaidhphukien=2 ";
			$tablemaphukienct = 'khosanxuat_phukien_dhht_maphukienct';
		} else { // => từ kho Phụ Kiện Mới
			$whTrangThaiDHPhuKien = " and trangthaidhphukien=1 ";
			$tablemaphukienct = 'khosanxuat_phukien_new_maphukienct';
		}

		$sqlGetDHPK = "select * from $GLOBALS[db_catalog].ordersanxuat 
								where id = ".$madhinChon." 
								or ( ((typeorder=3 and pid > 0) $whTrangThaiDHPhuKien and code LIKE '%" . $queryString . "%' ) 
								$whShowKhongDonHang ) 
								order by id=-1 desc, id desc limit 10
					";
		$rsGetDHPK = $GLOBALS["catalog"]->getAll($sqlGetDHPK);
		
		foreach($rsGetDHPK as $itemGetDHPK){
			$flagHidden = 1;

			if($itemGetDHPK['id'] != -1 && $itemGetDHPK['chitietphukien_id'] != '') {
				$chiTietPhuKienArr = StrToArray($itemGetDHPK['chitietphukien_id']);
				foreach($chiTietPhuKienArr as $itemChiTietPhuKien) {
					// Get tổng số lượng phụ kiện đã chọn xuất của idphukien trong iddh này
					$sqlTongChonXuatIdPhuKien = "select sum(soluongxuat) as tongsoluongxuat from $GLOBALS[db_sp].".$tablemaphukienct." where iddh=".$itemGetDHPK['id']." and idphukien=".$itemChiTietPhuKien['id'];
					$tongChonXuatIdPhuKien = $GLOBALS['sp']->getOne($sqlTongChonXuatIdPhuKien);
					
					// Nếu tổng số lượng xuất này không bằng với tổng số lượng của đơn hàng phụ kiện => idphukien thuộc đơn hàng này chưa xuất hết
					if($tongChonXuatIdPhuKien != $itemChiTietPhuKien['soluong']) {
						$flagHidden = 0;
					}
				}
			}
			
			if (($itemGetDHPK['id'] != -1 && $flagHidden == 0) || $madhinChon == $itemGetDHPK['id'] || $itemGetDHPK['id'] == -1) {
				if($itemGetDHPK['id'] != -1) {
					// Get name loại vàng
					$sqlGetNameLoaiVang = "select name_vn from $GLOBALS[db_sp].loaivang where id=".$itemGetDHPK['idloaivang'];
					$nameLoaiVang = $GLOBALS['sp']->getOne($sqlGetNameLoaiVang);

					$str .= '
						<a href="javascript:void(0)" onclick="insertDonHangPhuKienCatalog('.$itemGetDHPK['id'].',\''.$itemGetDHPK['code'].'\',\''.$itemGetDHPK['idloaivang'].'\',\''.$nameLoaiVang.'\')">
							'.$itemGetDHPK['code'].'
						</a>
					';
				} else {
					$str .= '
						<a href="javascript:void(0)" onclick="insertDonHangPhuKienCatalog('.$itemGetDHPK['id'].',\''.$itemGetDHPK['code'].'\',0,\'\')">
							'.$itemGetDHPK['code'].'
						</a>
					';
				}
			}
		}
		echo $str;
	break;

	// M.Tân thêm load các Mã SP Catalog thuộc đơn hàng
	case "loadOptionSelectMaSPThuocDonHang":
		$idDonHang = ceil(trim($_POST['idDonHang']));
		$idProductChon = ceil(trim($_POST['idProductChon']));
		$tablemaphukienct = trim(striptags($_POST['tablemaphukienct']));

		if($idDonHang > 0) {
			// Get list id sản phẩm thuộc đơn hàng này
			$sqlGetIDProduct = "select idpr from $GLOBALS[db_catalog].donhangsanxuat where idodsx = ( select pid from $GLOBALS[db_catalog].ordersanxuat where id=".$idDonHang." ) ";
			$rsIDProduct = $GLOBALS["catalog"]->getCol($sqlGetIDProduct);
			// print_r($rsIDProduct); die();

			if(count($rsIDProduct) !== count(array_unique($rsIDProduct))) {
				$error = "Đơn hàng này có mã sản phẩm Catalog trùng nhau trong đơn hàng nên không thể tạo phiếu. Vui lòng liên hệ với admin.";
			} else {
				foreach($rsIDProduct as $idProduct){
					$flagHidden = 1;

					// Get soluongphukien_id để kiểm tra xem Mã SP Catalog này đã xuất hết chưa
					$sqlGetChiTietPhuKienMaSP = "select soluongphukien_id from $GLOBALS[db_catalog].donhangsanxuat where idpr=".$idProduct." and idodsx = ( select pid from $GLOBALS[db_catalog].ordersanxuat where id=".$idDonHang." ) ";
					$chiTietPhuKienMaSP = $GLOBALS["catalog"]->getOne($sqlGetChiTietPhuKienMaSP);
					// die($chiTietPhuKienMaSP);

					if($chiTietPhuKienMaSP != '') {
						$chiTietPhuKienMaSPArr = StrToArray($chiTietPhuKienMaSP);
						foreach($chiTietPhuKienMaSPArr as $itemChiTietPhuKienMaSP) {
							// Get tổng số lượng phụ kiện đã chọn xuất của idphukien trong iddh này (theo Mã SP Catalog)
							$sqlTongChonXuatIdPhuKienMaSP = "select sum(soluongxuat) as tongsoluongxuat from $GLOBALS[db_sp].".$tablemaphukienct." where iddh=".$idDonHang." and idpr=".$idProduct." and idphukien=".$itemChiTietPhuKienMaSP['id'];
							$tongChonXuatIdPhuKienMaSP = $GLOBALS['sp']->getOne($sqlTongChonXuatIdPhuKienMaSP);
							
							// Nếu tổng số lượng xuất này không bằng với tổng số lượng của mã sản phẩm => idphukien thuộc mã sản phẩm này chưa xuất hết
							if($tongChonXuatIdPhuKienMaSP != $itemChiTietPhuKienMaSP['soluong']) {
								$flagHidden = 0;
							}
						}
					}
					
					if($idProductChon == $idProduct)
						$checked = "selected";
					else
						$checked = "";
					
					if($checked != '' || $flagHidden == 0) {
						// Get mã sản phẩm catalog
						$sqlGetCodeSPCatalog = "select code from $GLOBALS[db_catalog].products_new where id=".$idProduct;
						$codeSPCatalog = $GLOBALS["catalog"]->getOne($sqlGetCodeSPCatalog);
		
						$html .= "<option ".$checked." value='".$idProduct."'>".$codeSPCatalog."</option>";	
					}	
				}
	
				$str = '
					<option value="0">--Chọn Mã SP Catalog--</option>
					'.$html.'
				';
	
				$error = "success";
			}
			die(json_encode(array('status'=>$error,'str'=>$str)));
		}
	break;

	// M.Tân thêm load các Mã SP Catalog thuộc đơn hàng phụ kiện mà Kho phụ kiện mới đã chọn xuất qua
	case "loadOptionSelectMaSPThuocDonHangKhoPhuKienDHHT":
		$idDonHang = ceil(trim($_POST['idDonHang']));
		$idProductChon = ceil(trim($_POST['idProductChon']));
		$tablemaphukienct = trim(striptags($_POST['tablemaphukienct']));

		if($idDonHang > 0) {
			// Get list id sản phẩm thuộc đơn hàng này mà Kho phụ kiện mới đã chọn xuất qua
			$sqlGetIDProduct = "select distinct idpr from $GLOBALS[db_sp].khosanxuat_phukien_new_maphukienct where iddh=".$idDonHang." and idphieuxuat in ( select id from $GLOBALS[db_sp].khosanxuat_phukien_new where type=3 and trangthai=2 ) ";
			$rsIDProduct = $GLOBALS['sp']->getCol($sqlGetIDProduct);
			// print_r($rsIDProduct); die($sqlGetIDProduct);

			foreach($rsIDProduct as $idProduct){
				$flagHidden = 1;

				// Get list idphukien thuộc id Mã SP này mà Kho phụ kiện mới đã chọn xuất qua để kiểm tra xem Kho Phụ Kiện DHHT xuất hết chưa
				$sqlGetIDPhuKienMaSP = "select distinct idphukien from $GLOBALS[db_sp].khosanxuat_phukien_new_maphukienct where iddh=".$idDonHang." and idpr=".$idProduct." and idphieuxuat in ( select id from $GLOBALS[db_sp].khosanxuat_phukien_new where type=3 and trangthai=2 ) ";
				$rsGetIDPhuKienMaSP = $GLOBALS['sp']->getCol($sqlGetIDPhuKienMaSP);

				foreach($rsGetIDPhuKienMaSP as $idPhuKienMaSP) {
					// Get tổng số lượng phụ kiện của idphukien trong iddh này (theo Mã SP Catalog) mà Kho phụ kiện mới đã xuất qua
					$sqlTongNhapFromNewIdPhuKienMaSP = "select sum(soluongxuat) as tongsoluongnhap from $GLOBALS[db_sp].khosanxuat_phukien_new_maphukienct where iddh=".$idDonHang." and idpr=".$idProduct." and idphukien=".$idPhuKienMaSP." and idphieuxuat in ( select id from $GLOBALS[db_sp].khosanxuat_phukien_new where type=3 and trangthai=2 ) ";
					$tongNhapFromNewIdPhuKienMaSP = $GLOBALS['sp']->getOne($sqlTongNhapFromNewIdPhuKienMaSP);
					
					// Get tổng số lượng phụ kiện đã chọn xuất của idphukien trong iddh này (theo Mã SP Catalog)
					$sqlTongChonXuatIdPhuKienMaSP = "select sum(soluongxuat) as tongsoluongxuat from $GLOBALS[db_sp].".$tablemaphukienct." where iddh=".$idDonHang." and idpr=".$idProduct." and idphukien=".$idPhuKienMaSP;
					$tongChonXuatIdPhuKienMaSP = $GLOBALS['sp']->getOne($sqlTongChonXuatIdPhuKienMaSP);
					
					// Nếu tổng số lượng xuất này không bằng với tổng số lượng nhập vô từ Kho Phụ Kiện mới => idphukien thuộc mã sản phẩm này chưa xuất hết
					if($tongChonXuatIdPhuKienMaSP != $tongNhapFromNewIdPhuKienMaSP) {
						$flagHidden = 0;
					}
				}
				
				if($idProductChon == $idProduct)
					$checked = "selected";
				else
					$checked = "";
				
				if($checked != '' || $flagHidden == 0) {
					// Get mã sản phẩm catalog
					$sqlGetCodeSPCatalog = "select code from $GLOBALS[db_catalog].products_new where id=".$idProduct;
					$codeSPCatalog = $GLOBALS["catalog"]->getOne($sqlGetCodeSPCatalog);
	
					$html .= "<option ".$checked." value='".$idProduct."'>".$codeSPCatalog."</option>";	
				}	
			}

			$str = '
				<option value="0">--Chọn Mã SP Catalog--</option>
				'.$html.'
			';

			$error = "success";

			die(json_encode(array('status'=>$error,'str'=>$str)));
		}
	break;

	case 'getMorePermMenu':
		$id = ceil(trim($_POST['id']));
		$uid = ceil(trim($_POST['uid']));
		$i = ceil(trim($_POST['i']));
		echo getSubcategory($id, $i, $uid);
	break;
	case 'getMorePermMenuParent':
		$id = ceil(trim($_POST['id']));
		$uid = ceil(trim($_POST['uid']));
		$i = ceil(trim($_POST['i']));
		echo getSubcategoryParent($id, $i, $uid);
	break;
	// === BẮT ĐẦU A.VU THÊM GET QL THU CHI - QL CÔNG NỢ === //
	case 'getKeToanCongNoSoTaiKhoan':
		$idkhachhang = ceil($_POST['idkhachhang']);
		if($idkhachhang > 0){
			$sql = "select id,sotaikhoannganhang from $GLOBALS[db_sp].dm_khachhangct where idct = $idkhachhang and active = 1 and idstk > 0 order by num asc, id asc";
			$rs = $GLOBALS["sp"]->getAll($sql);
		}
		die(json_encode(array('status'=>$rs)));
	break;
	case 'getKeToanCongNoThongTinNganHang':
		$idsotaikhoan = ceil($_POST['idsotaikhoan']);
		if($idsotaikhoan > 0){
			$sql = "select * from $GLOBALS[db_sp].dm_khachhangct where id = $idsotaikhoan";
			$rs = $GLOBALS["sp"]->getRow($sql);
			if($rs['idnganhang'] > 0){
				$rs['nganhang'] = getName('dm_nganhang','tengiaodich',$rs['idnganhang']);
			}
		}
		die(json_encode(array('status'=>$rs)));
	break;
	case 'getKeToanCongNoCoCauToChuc':
		$whnv = $name = '';
		$rs = array();
		$id = ceil($_POST['id']);
		$idphong = ceil($_POST['idphong']);
		$idbophan = ceil($_POST['idbophan']);
		$idto = ceil($_POST['idto']);
		$idname = trim($_POST['idname']);
		if($id > 0 && !empty($idname)){
			$sql = "select id,name_vn from $GLOBALS[db_spns].danhmucphongban where pid = $id and active = 1";
			$rs = $GLOBALS["spns"]->getAll($sql);
		}
		if(!empty($idphong) || !empty($idbophan) || !empty($idto)){
			if(!empty($idphong))
				$whnv .= " and idphongban in ($idphong)";
			if(!empty($idbophan))
				$whnv .= " and idbophan in ($idbophan)";
			if(!empty($idto))
				$whnv .= " and idnhomto in ($idto)";
					
			$sqlnv = "select id,fullname from $GLOBALS[db_spns].nhanvien where active = 1 $whnv";
			$rsnv = $GLOBALS["spns"]->getAll($sqlnv);
			$name = '<option value="">--Chọn cá nhân--</option>';
			foreach($rsnv as $nv){
				$name .= "<option value='".$nv['id']."'>".$nv['fullname']."</option>";
			}
		}

		die(json_encode(array('status'=>$rs,'name'=>$name)));
	break;
	case 'getKeToanThongKeQuyChiTienCoCauToChuc':
		$str_name = "";
		$rs = array();
		$id = ceil($_POST['id']);
		$idname = trim(striptags($_POST['idname']) ?? '');
		if($id > 0){
			if($idname == "canhan")
				$sql = "select id, fullname as name_vn from $GLOBALS[db_spns].nhanvien where phongban = $id";
			else
				$sql = "select id,name_vn from $GLOBALS[db_spns].danhmucphongban where pid = $id and active = 1";

			$rs = $GLOBALS["spns"]->getAll($sql);

			$sql_level = "select level from $GLOBALS[db_spns].danhmucphongban where id = $id";
			$level = $GLOBALS["spns"]->getOne($sql_level);
			if($level == 2)	
				$str_name = "bộ phận";
			else if($level == 3) 
				$str_name = "tổ";
			else if($level == 4) 
				$str_name = "cá nhân";
		}
		die(json_encode(array('status'=>$rs,'name'=>$str_name)));
	break;
	case 'getKeToanCongNoCidNguonCongNo':
		$rs = array();
		$id = ceil($_POST['id']);
		$cidchitien = trim($_POST['cidchitien'] ?? '');
		$ciddonhangmua = trim($_POST['ciddonhangmua'] ?? '');
		$idloaicongno = ceil($_POST['idloaicongno']);
		if($id > 0 && $idloaicongno > 0){
			// ============== Danh mục Công Nợ ================= //
			$sql = "select * from $GLOBALS[db_sp].ketoan_congno_dm where id = $id";
			$rs = $GLOBALS["sp"]->getRow($sql);

			$cidnguoncongno = $rs['cidnguoncongno'];
			if(strpos($cidnguoncongno,$ciddonhangmua) !== false) {
				// ============== Get Col Id ĐHM Chờ Thanh Toán trong ketoan_congno ===== //
				$sqlInIdChoThanhToan = "select id from $GLOBALS[db_sp].ketoan_noidung_dathang where cid = 2218";
				$sqlColIdDHM = "select iddonhangmua from $GLOBALS[db_sp].ketoan_congno where ciddonhangmua = $ciddonhangmua and iddonhangmua in ($sqlInIdChoThanhToan)";
				$rsColIdDHM = $GLOBALS["sp"]->getCol($sqlColIdDHM);
				if(!empty($rsColIdDHM)){
					$ColIdDHM = implode(',', $rsColIdDHM);
					$whColIdDHM = "and id not in ($ColIdDHM)";
				}
				$sqldhm = "select id,maphieu from $GLOBALS[db_sp].ketoan_noidung_dathang where cid = $ciddonhangmua and trangthai = 1 $whColIdDHM and idloaimuahang in (select id from $GLOBALS[db_sp].ketoan_dm_loaimuahang where idloaicongno = $idloaicongno) order by dated desc, id desc";
				$rs['donhangmua'] = $GLOBALS["sp"]->getAll($sqldhm);
			}
			if(strpos($cidnguoncongno,$cidchitien) !== false) {
				$sqlInIdct = "select id from $GLOBALS[db_sp].ketoan_chitien where cid = $cidchitien and trangthai = 0";
				$sqlcolct = "select DISTINCT idchitien from $GLOBALS[db_sp].ketoan_congno where cidchitien = $cidchitien and trangthaichitien = 0 and idchitien in ($sqlInIdct)";
				$rscolct = $GLOBALS["sp"]->getCol($sqlcolct);
				if(!empty($rscolct)){
					$colct = implode(',', $rscolct);
					$whcolct = "and id not in ($colct)";
				}
				$sqlct = "select id,maphieu from $GLOBALS[db_sp].ketoan_chitien where cid = $cidchitien and trangthai = 0 $whcolct order by dated desc, id desc";
				$rs['chitien'] = $GLOBALS["sp"]->getAll($sqlct);
			}
		}
		die(json_encode(array('status'=>$rs)));
	break;
	case 'getKeToanCongNoHinhThucThanhToan':
		$id = ceil($_POST['id']);
		$idkhachhang = ceil($_POST['idkhachhang']);
		if($id > 0){
			$sql = "select * from $GLOBALS[db_sp].ketoan_dm_hinhthucthanhtoan where id = $id";
			$rs = $GLOBALS["sp"]->getRow($sql);
			if($idkhachhang > 0){
				$sql = "select id,sotaikhoannganhang from $GLOBALS[db_sp].dm_khachhangct where idct = $idkhachhang and active = 1 and idstk > 0 order by num asc, id asc";
				$rs['stk'] = $GLOBALS["sp"]->getAll($sql);
			}
		}
		die(json_encode(array('status'=>$rs)));
	break;
	// === KẾT THÚC A.VU THÊM GET QL THU CHI - QL CÔNG NỢ === //
	// === BẮT ĐẦU A.VŨ THÊM - GET ĐƠN HÀNG MUA CHỜ THANH TOÁN - QL CÔNG NỢ - DANH SÁCH CÔNG NỢ === //
	case 'getKeToanCongNoGetDonHangMua':
		$rs = array();
		$iddonhangmua = ceil($_POST['iddonhangmua']);
		$idloaicongno = ceil($_POST['idloaicongno']);
		//$idnum = ceil($_POST['idnum']);
		$str = '';
		if($iddonhangmua > 0){
			$sql = "select * from $GLOBALS[db_sp].ketoan_noidung_dathang where id = $iddonhangmua";
			$rs = $GLOBALS["sp"]->getRow($sql);
			if($idloaicongno > 0){
				$dmcongno = getRowName('*','ketoan_congno_dm',"id = $idloaicongno");
				$loaiphongban = $dmcongno['idloaiphongban'];
				$cidtinhchatcp = $dmcongno['cidtinhchatcp'];
				$cidchiphi = $dmcongno['cidchiphi'];
				$whloaipb = "and id in ($loaiphongban)";
			}
			// ĐHM chi tiết ============================================ //
			$sqlct = "select * from $GLOBALS[db_sp].ketoan_noidung_dathangct where idct = $iddonhangmua";
			$rsct = $GLOBALS["sp"]->getAll($sqlct);	
			$idnum = 1;
			foreach($rsct as $item){
				$str .= '
					<tr>
						<td align="center">'.$idnum.'</td>
						<td>
							<input style="width:550px !important" value="'.$item['name_muahang'].'" type="text" name="diengiai[]" id="diengiai'.$idnum.'" class="txtdatagirld diengiai" />
						</td>
						<td>
							<input style="width:100px !important" value="'.$item['dvt'].'" type="text" name="dvt[]" id="dvt'.$idnum.'" class="txtdatagirld" />
						</td>
						<td>
							<input style="width:100px !important" value="'.$item['soluong'].'" type="text" name="soluong[]" id="soluong'.$idnum.'" onchange="tongSoTien('.$idnum.')" class="txtdatagirld text-right sotien autoNumericAm" value="0" />
						</td>
						<td>
							<input style="width:100px !important" value="'.$item['dongiathue'].'" type="text" name="dongia[]" id="dongia'.$idnum.'" onchange="tongSoTien('.$idnum.')" class="txtdatagirld text-right sotien autoNumericAm" value="0" />
						</td>
						<td>
							<input style="width:100px !important" value="'.$item['thanhtienthue'].'" type="text" name="sotien[]" id="sotien'.$idnum.'" onchange="tongSoTien()" class="txtdatagirld text-right sotien autoNumericAm" value="0" />
						</td>
						<td id="siteIDload">
							<select style="width:160px" class="idtinhchatcp" id="idtinhchatcp'.$idnum.'" name="idtinhchatcp[]">
								<option value="">--Chọn tính chất CP--</option>
								'.getSelectOption("ketoan_congno_dm","id,name_vn","cid in ($cidtinhchatcp) and active=1").'
							</select>
						</td>
						<td id="siteIDload">
							<select style="width:160px" class="idchiphi" id="idchiphi'.$idnum.'" name="idchiphi[]">
								<option value="">--Chọn chi phí--</option>
								'.getSelectOption("ketoan_congno_dm","id,name_vn","cid in ($cidchiphi) and active=1").'
							</select>
						</td>
						<td id="siteIDload">
							<select style="width:160px" class="idloaiphongban" id="idloaiphongban'.$idnum.'" name="idloaiphongban[]" onchange="getdongPhongBan(`'.$path_url.'`,this.value,'.$idnum.',`idphong`)">
								<option value="">--Chọn loại phòng ban--</option>
								'.getSelectOption("ketoan_congno_dm","id,name_vn","cid = 3255 and active=1 $whloaipb").'
							</select>
						</td>
						<td id="siteIDload">
							<select style="width:160px" class="idphong" id="idphong'.$idnum.'" name="idphong[]" onchange="getdongPhongBan(`'.$path_url.'`,this.value,'.$idnum.',`idbophan`)">
								<option value="">--Chọn phòng--</option>
							</select>
						</td>
						<td id="siteIDload">
							<select style="width:160px" class="idbophan" id="idbophan'.$idnum.'" name="idbophan[]" onchange="getdongPhongBan(`'.$path_url.'`,this.value,'.$idnum.',`idto`)">
								<option value="">--Chọn bộ phận--</option>
							</select>
						</td>
						<td id="siteIDload">
							<select style="width:160px" class="idto" id="idto'.$idnum.'" name="idto[]" onchange="getdongPhongBan(`'.$path_url.'`,this.value,'.$idnum.',``)">
								<option value="">--Chọn tổ--</option>
							</select>
						</td>
						<td id="tdcanhan'.$idnum.'">
							<input type="hidden" name="idcanhan[]" id="idcanhan'.$idnum.'" class="idcanhan" />
							<input type="text" name="canhan[]" id="canhan'.$idnum.'" onkeyup="lookupNhanVienPMNS(this.id,`'.$path_url.'`,`SearchNhanVienPMNS`,this.value,`'.$whnv.'`)" onfocus="lookupNhanVienPMNS(this.id,`'.$path_url.'`,`SearchNhanVienPMNS`,` `,`'.$whnv.'`)" placeholder="Tìm Mã nhân viên / Tên nhân viên..." style="width:160px !important" autocomplete="off" class="txtdatagirld canhan" />
						</td>
					</tr>
					<script type="text/javascript" src="'.$path_url.'/js/autoNumeric.js"></script>
					<script>
						$(".autoNumeric").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 0});
						$(".autoNumericAm").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 0, vMin:"-9999999999999999999.99"});
						$("#siteIDload select").select2();
					</script>
				';
				$idnum++;
			}
			$rs['idnum'] = $idnum;
			$rs['chitiet'] = $str;
			// === DANH MỤC KHÁCH HÀNG === //
			if($rs['idkhachhang'] > 0){
				$sqlkh = "select makhachhang,tenkhachhang from $GLOBALS[db_sp].dm_khachhang where id = ".$rs['idkhachhang'];
				$rs['khachhang'] = $GLOBALS['sp']->getRow($sqlkh);
			}
			// === Type_sotaikhoan === //
			if($rs['idhinhthucthanhtoan'] > 0){
				$sqlhttt = "select type_sotaikhoan from $GLOBALS[db_sp].ketoan_dm_hinhthucthanhtoan where id = ".$rs['idhinhthucthanhtoan'];
				$rs['type_sotaikhoan'] = $GLOBALS['sp']->getOne($sqlhttt);
			}
			// == DANH MỤC TÍNH CHẤT ĐẶT HÀNG ==== //
			$sqldm = "select * from $GLOBALS[db_sp].ketoan_dm_tinhchatmuahang where id = ".$rs['idtinhchatdathang'];
			$rsdm = $GLOBALS["sp"]->getRow($sqldm);
			// === HỢP ĐỒNG === //
			$idhopdong = getOneName('id','ketoan_dm_kho',' type = 1');
			$rs['idhopdong'] = strpos($rsdm['cid_check'],',1,')?$idhopdong:"-1";
			// === HÓA ĐƠN === //
			$idhoadon = getOneName('id','ketoan_dm_kho',' type = 2');
			$rs['idhoadon'] = strpos($rsdm['cid_check'],',2,')?$idhoadon:"-1";
			// === NHẬP KHO === //
			$idnhapkho = getOneName('id','ketoan_dm_kho',' type = 5');
			$rs['idnhapkho'] = $idnhapkho = strpos($rsdm['cid_check'],',5,')?$idnhapkho:"-1";

			if($idnhapkho > 0){
				$arrsub = unserialize($rsdm['checksub']);
				foreach($arrsub as $sub){
					if($sub['pid'] == 5)
						$rs['idloainhapkho'] = $sub['id_child'];
				}
			}
			// === CID KHO QUY TRÌNH - CÓ CHỌN SỬA CHỮA === //
			if($rs['idquytrinh'] > 0){
				$cidkhoquytrinh = getOneName('cidkho','ketoan_dm_quytrinh',' id = '.$rs['idquytrinh']);
				if($cidkhoquytrinh == '2224'){
					$idsuachua = getOneName('id','ketoan_congno_dm',' cid = '.$cidtinhchatcp.' and cidkhoquytrinh = '.$cidkhoquytrinh);
					$rs['idsuachua'] = $idsuachua;
				}
			}
		}
		die(json_encode(array('status'=>$rs)));
	break;
	case 'getKeToanCongNoGetDeNghiChiTien':
		$idchitien = $_POST['idchitien'];
		$idloaicongno = ceil($_POST['idloaicongno']);
		$rs = array();
		$idnum = 1;
		if($idchitien > 0){
			$sql = "select *, 
						DATE_FORMAT(datedthoihanhopdong, '%d/%m/%Y') as datedthoihanhopdong, 
						DATE_FORMAT(fromdateddukien, '%d/%m/%Y') as fromdateddukien, 
						DATE_FORMAT(todateddukien, '%d/%m/%Y') as todateddukien, 
						DATE_FORMAT(datedketthuc, '%d/%m/%Y') as datedketthuc
						from $GLOBALS[db_sp].ketoan_chitien 
						where id = $idchitien
					";
			$rs = $GLOBALS['sp']->getRow($sql);
			
			$rs['idhoadon'] = $rs['idhoadon'] > 0 ? $rs['idhoadon'] : "-1"; 
			if($idloaicongno > 0){
				$dmcongno = getRowName('*','ketoan_congno_dm',"id = $idloaicongno");
				$loaiphongban = $dmcongno['idloaiphongban'];
				$cidtinhchatcp = $dmcongno['cidtinhchatcp'];
				$cidchiphi = $dmcongno['cidchiphi'];
				$whloaipb = "and id in ($loaiphongban)";
			}
			// === Chi tiết phiếu === //
			$sqlct = "select * from $GLOBALS[db_sp].ketoan_chitienct where idct = $idchitien";
			$rsct = $GLOBALS['sp']->getAll($sqlct);
			if(!empty($rsct)){
				foreach($rsct as $item){
					$opt_tinhchatcp = getSelectOptionKeToanCongNoNguonCongNo("ketoan_congno_dm","name_vn","cid in ($cidtinhchatcp) and active=1",$item['idtinhchatcp']); // functionkhohao
				
					$opt_chiphi = getSelectOptionKeToanCongNoNguonCongNo("ketoan_congno_dm","name_vn","cid in ($cidchiphi) and active=1",$item['idchiphi']); // functionkhohao

					$opt_loaiphongban = getSelectOptionKeToanCongNoNguonCongNo("ketoan_congno_dm","name_vn","cid = 3255 and active=1 $whloaipb",$item['idloaiphongban']); // functionkhohao

					$rs_opt = getSelectOptionKeToanTheoDanhMucLoaiPhongBan($item['idloaiphongban'],$item['idphong'],$item['idbophan'],$item['idto'],$item['idcanhan']);

					$opt_phong = $rs_opt['phongban'];
					$opt_bophan = $rs_opt['bophan'];
					$opt_to = $rs_opt['nhomto'];
					$opt_canhan = $rs_opt['nhanvien'];
					$whnv = $rs_opt['whnv'];

					$str .= '
						<tr>
							<td align="center">'.$idnum.'</td>
							<td>
								<input style="width:550px !important" value="'.$item['diengiai'].'" type="text" name="diengiai[]" id="diengiai'.$idnum.'" class="txtdatagirld" />
							</td>
							<td>
								<input style="width:100px !important" value="'.$item['dvt'].'" type="text" name="dvt[]" id="dvt'.$idnum.'" class="txtdatagirld" />
							</td>
							<td>
								<input style="width:100px !important" value="'.$item['soluong'].'" type="text" name="soluong[]" id="soluong'.$idnum.'" onchange="tongSoTien('.$idnum.')" class="txtdatagirld text-right sotien autoNumericAm" />
							</td>
							<td>
								<input style="width:100px !important" value="'.$item['dongia'].'" type="text" name="dongia[]" id="dongia'.$idnum.'" onchange="tongSoTien('.$idnum.')" class="txtdatagirld text-right sotien autoNumericAm" />
							</td>
							<td>
								<input style="width:100px !important" value="'.$item['sotien'].'" type="text" name="sotien[]" id="sotien'.$idnum.'" onchange="tongSoTien('.$idnum.')" class="txtdatagirld text-right sotien autoNumericAm" />
							</td>
							<td id="siteIDload">
								<select style="width:160px" class="idtinhchatcp" id="idtinhchatcp'.$idnum.'" name="idtinhchatcp[]">
									<option value="">--Chọn tính chất CP--</option>
									'.$opt_tinhchatcp.'
								</select>
							</td>
							<td id="siteIDload">
								<select style="width:160px" class="idchiphi" id="idchiphi'.$idnum.'" name="idchiphi[]">
									<option value="">--Chọn chi phí--</option>
									'.$opt_chiphi.'
								</select>
							</td>
							<td id="siteIDload">
								<select style="width:160px" class="idloaiphongban" id="idloaiphongban'.$idnum.'" name="idloaiphongban[]" onchange="getdongPhongBan(`'.$path_url.'`,this.value,'.$idnum.',`idphong`)">
									<option value="">--Chọn loại phòng ban--</option>
									'.$opt_loaiphongban.'
								</select>
							</td>
							<td id="siteIDload">
								<select style="width:160px" class="idphong" id="idphong'.$idnum.'" name="idphong[]" onchange="getdongPhongBan(`'.$path_url.'`,this.value,'.$idnum.',`idbophan`)">
									<option value="">--Chọn phòng--</option>
									'.$opt_phong.'
								</select>
							</td>
							<td id="siteIDload">
								<select style="width:160px" class="idbophan" id="idbophan'.$idnum.'" name="idbophan[]" onchange="getdongPhongBan(`'.$path_url.'`,this.value,'.$idnum.',`idto`)">
									<option value="">--Chọn bộ phận--</option>
									'.$opt_bophan.'
								</select>
							</td>
							<td id="siteIDload">
								<select style="width:160px" class="idto" id="idto'.$idnum.'" name="idto[]" onchange="getdongPhongBan(`'.$path_url.'`,this.value,'.$idnum.',``)">
									<option value="">--Chọn tổ--</option>
									'.$opt_to.'
								</select>
							</td>
							<td id="tdcanhan'.$idnum.'">
								<input type="hidden" name="idcanhan[]" id="idcanhan'.$idnum.'" value="'.$item['idcanhan'].'" class="idcanhan" />
								<input type="text" name="canhan[]" id="canhan'.$idnum.'" value="'.$item['canhan'].'" onkeyup="lookupNhanVienPMNS(this.id,`'.$path_url.'`,`SearchNhanVienPMNS`,this.value,`'.$whnv.'`)" onfocus="lookupNhanVienPMNS(this.id,`'.$path_url.'`,`SearchNhanVienPMNS`,` `,`'.$whnv.'`)" placeholder="Tìm Mã nhân viên / Tên nhân viên..." style="width:160px !important" autocomplete="off" class="txtdatagirld canhan" />
							</td>
						</tr>
						<script type="text/javascript" src="'.$path_url.'/js/autoNumeric.js"></script>
						<script>
							$(".autoNumeric").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 0});
							$(".autoNumericAm").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 0, vMin:"-9999999999999999999.99"});
							$("#siteIDload select").select2();
						</script>
					';
					$idnum++;
				}
				$rs['idnum'] = $idnum;
			}
			$rs['chitiet'] = $str;
			// === dm_khachhang === //
			if($rs['idkhachhang'] > 0){
				$sqlkh = "select makhachhang,tenkhachhang from $GLOBALS[db_sp].dm_khachhang where id = ".$rs['idkhachhang'];
				$rskh = $GLOBALS['sp']->getRow($sqlkh);
				$rs['makhachhang'] = $rskh['makhachhang'];
				$rs['tenkhachhang'] = $rskh['tenkhachhang'];
			}
			// === ql_hopdong_nhap === //
			if($rs['idquanlyhopdong'] > 0){
				$sqlqlhd = "select mahopdong from $GLOBALS[db_sp].ql_hopdong_nhap where id = ".$rs['idquanlyhopdong'];
				$rs['mahopdong'] = $GLOBALS['sp']->getOne($sqlqlhd);
			}
			// === Type_sotaikhoan === //
			if($rs['idhinhthucthanhtoan'] > 0){
				$sqlhttt = "select type_sotaikhoan from $GLOBALS[db_sp].ketoan_dm_hinhthucthanhtoan where id = ".$rs['idhinhthucthanhtoan'];
				$rs['type_sotaikhoan'] = $GLOBALS['sp']->getOne($sqlhttt);
			}
		}
		die(json_encode(array('status'=>$rs)));
	break;
	// === KẾT THÚC A.VŨ THÊM - GET ĐƠN HÀNG MUA CHỜ THANH TOÁN - QL CÔNG NỢ - DANH SÁCH CÔNG NỢ === //
	// === A.VU THÊM SEARCH NHÂN VIÊN - QL ĐẶT HÀNG - LẬP PHIẾU NHẬP KHO ĐÁ === //
	case 'SearchKeToanDatHangLapPhieuNhanVienPMNS':
		$value = array();
		$idname = trim($_POST['idname'] ?? '');
		$idnamephongban = trim($_POST['idnamephongban'] ?? '');
		
		$sql = "select id,manv,fullname,phongban from $GLOBALS[db_spns].nhanvien where ( manv LIKE '%" . $queryString . "%' or fullname LIKE '%" . $queryString . "%' ) and active=1 and status=1 order by id asc limit 20";
		$rs = $GLOBALS["spns"]->getAll($sql);
		
		foreach($rs as $item){
			if($item['phongban'] > 0){
				$sqlphongban = "select name_vn from $GLOBALS[db_spns].danhmucphongban where id = ".$item["phongban"];
				$phongban = $GLOBALS["spns"]->getOne($sqlphongban);
			}

			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanDatHangLapPhieuNhanVienPMNS("'.$item['id'].'","'.$item['manv'].'","'.$item['fullname'].'","'.$idname.'","'.$idnamephongban.'","'.$item["phongban"].'","'.$phongban.'")\'> 
					'.$item["manv"].' | '.$item["fullname"].'
				</a>
			';
		}
		echo $str;
	break;
	// === A.VU THÊM SEARCH KHO ĐÁ CATALOG - QL ĐẶT HÀNG - LẬP PHIẾU NHẬP KHO ĐÁ === //
	case 'SearchKeToanDatHangLapPhieuKhoDa':
		$idnum = trim($_POST['idnum'] ?? '');
		$sql = "select * from $GLOBALS[db_catalog].banggiada where ( code LIKE '%" . $queryString . "%' or tengoida LIKE '%" . $queryString . "%' ) and active=1 order by id asc limit 20";
		$rs = $GLOBALS["catalog"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertKeToanDatHangLapPhieuKhoDa("'.$item['id'].'","'.$item['code'].'","'.$item['tengoida'].'","'.$item['donvitinhnhapxuat'].'","'.number_format($item['pricenhapxuat']).'","'.$idnum.'")\'> 
					'.$item['code'].'  :  '.$item['tengoida'].'
				</a>
			';
		}
		echo $str;
	break;
	// === A.VU THÊM SELECT CƠ CẤU TỔ CHỨC - QL ĐẶT HÀNG === //
	case 'getKeToanDatHangCoCauToChuc':
		$rs = array();
		$id = ceil($_POST['id']);
		if($id > 0){
			$sql = "select id,name_vn from $GLOBALS[db_spns].danhmucphongban where pid = $id and active = 1";
			$rs = $GLOBALS["spns"]->getAll($sql);
		}
		die(json_encode(array('status'=>$rs)));
	break;
	// ==== A.VU THEM SEARCH - KE TOAN THU TIỀN === //
	case 'searchKeToanThuTien':
		$where = trim($_POST['where'] ?? '');
		$value = trim($_POST['value'] ?? '');
		$idname = trim($_POST['idname'] ?? '');
		if($idname == 'tongthanhtiens'){
			$queryString = str_replace(',', '', $queryString);
		}
		if($idname == 'makhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_thutien where $where in (select id from $GLOBALS[db_sp].dm_khachhang where makhachhang LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else if($idname == 'tenkhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_thutien where $where in (select id from $GLOBALS[db_sp].dm_khachhang where tenkhachhang LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_thutien where $where LIKE '%" . $queryString . "%' group by $value order by id asc limit 20 ";
		
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($idname == 'tenkhachhangs'){
				$itemStr = getName('dm_khachhang','tenkhachhang',$item[$value]);
			}
			else if($idname == 'makhachhangs'){
				$itemStr = getName('dm_khachhang','makhachhang',$item[$value]);
			}
			else if($idname == 'tongthanhtiens'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanThuTien("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	case 'searchKeToanNhapTienQuyQuanTri':
		$where = trim($_POST['where'] ?? '');
		$value = trim($_POST['value'] ?? '');
		$idname = trim($_POST['idname'] ?? '');
		$trangthai = trim($_POST['trangthai'] ?? '');

		if($idname == 'soluongs' || $idname == 'dongias' || $idname == 'thanhtiens'){
			$queryString = str_replace(',', '', $queryString);
		}

		if($idname == 'makhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyquantri where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhang where makhachhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'tenkhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyquantri where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhang where tenkhachhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'chutaikhoans')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyquantri where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhangct where chutaikhoan LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'sotaikhoannganhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyquantri where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhangct where sotaikhoannganhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'tennganhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyquantri where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_nganhang where tennganhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'noidungs' || $idname == 'dvts' || $idname == 'soluongs' || $idname == 'dongias' || $idname == 'thanhtiens')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyquantrict where idct in (select id from $GLOBALS[db_sp].ketoan_quyquantri where $trangthai) and $where LIKE '%" . $queryString . "%' group by $value order by id desc limit 20 ";
		else
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyquantri where $trangthai and $where LIKE '%" . $queryString . "%' group by $value order by id desc limit 20 ";
			
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($idname == 'tenkhachhangs'){
				$itemStr = getName('dm_khachhang','tenkhachhang',$item[$value]);
			}
			else if($idname == 'makhachhangs'){
				$itemStr = getName('dm_khachhang','makhachhang',$item[$value]);
			}
			else if($idname == 'chutaikhoans'){
				$itemStr = getName('dm_khachhangct','chutaikhoan',$item[$value]);
			}
			else if($idname == 'sotaikhoannganhangs'){
				$itemStr = getName('dm_khachhangct','sotaikhoannganhang',$item[$value]);
			}
			else if($idname == 'tennganhangs'){
				$itemStr = getName('dm_nganhang','tennganhang',$item[$value]);
			}
			else if($idname == 'soluongs' || $idname == 'dongias' || $idname == 'thanhtiens'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanNhapTienQuyQuanTri("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	case 'searchKeToanNhapTienQuyKeToan':
		$where = trim($_POST['where'] ?? '');
		$value = trim($_POST['value'] ?? '');
		$idname = trim($_POST['idname'] ?? '');
		$trangthai = trim($_POST['trangthai'] ?? '');

		if($idname == 'soluongs' || $idname == 'dongias' || $idname == 'thanhtiens'){
			$queryString = str_replace(',', '', $queryString);
		}

		if($idname == 'makhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyketoan where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhang where makhachhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'tenkhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyketoan where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhang where tenkhachhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'chutaikhoans')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyketoan where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhangct where chutaikhoan LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'sotaikhoannganhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyketoan where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhangct where sotaikhoannganhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'tennganhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyketoan where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_nganhang where tennganhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'noidungs' || $idname == 'dvts' || $idname == 'soluongs' || $idname == 'dongias' || $idname == 'thanhtiens')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyketoanct where idct in (select id from $GLOBALS[db_sp].ketoan_quyketoan where $trangthai) and $where LIKE '%" . $queryString . "%' group by $value order by id desc limit 20 ";
		else
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quyketoan where $trangthai and $where LIKE '%" . $queryString . "%' group by $value order by id desc limit 20 ";
		
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($idname == 'tenkhachhangs'){
				$itemStr = getName('dm_khachhang','tenkhachhang',$item[$value]);
			}
			else if($idname == 'makhachhangs'){
				$itemStr = getName('dm_khachhang','makhachhang',$item[$value]);
			}
			else if($idname == 'chutaikhoans'){
				$itemStr = getName('dm_khachhangct','chutaikhoan',$item[$value]);
			}
			else if($idname == 'sotaikhoannganhangs'){
				$itemStr = getName('dm_khachhangct','sotaikhoannganhang',$item[$value]);
			}
			else if($idname == 'tennganhangs'){
				$itemStr = getName('dm_nganhang','tennganhang',$item[$value]);
			}
			else if($idname == 'soluongs' || $idname == 'dongias' || $idname == 'thanhtiens'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanNhapTienQuyKeToan("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	case 'searchKeToanNhapTienQuyGiaDinh':
		$where = trim($_POST['where'] ?? '');
		$value = trim($_POST['value'] ?? '');
		$idname = trim($_POST['idname'] ?? '');
		$trangthai = trim($_POST['trangthai'] ?? '');

		if($idname == 'soluongs' || $idname == 'dongias' || $idname == 'thanhtiens'){
			$queryString = str_replace(',', '', $queryString);
		}

		if($idname == 'makhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quygiadinh where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhang where makhachhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'tenkhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quygiadinh where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhang where tenkhachhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'chutaikhoans')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quygiadinh where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhangct where chutaikhoan LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'sotaikhoannganhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quygiadinh where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_khachhangct where sotaikhoannganhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'tennganhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quygiadinh where $trangthai and $where in (select id from $GLOBALS[db_sp].dm_nganhang where tennganhang LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'noidungs' || $idname == 'dvts' || $idname == 'soluongs' || $idname == 'dongias' || $idname == 'thanhtiens')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quygiadinhct where idct in (select id from $GLOBALS[db_sp].ketoan_quygiadinh where $trangthai) and $where LIKE '%" . $queryString . "%' group by $value order by id desc limit 20 ";
		else
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_quygiadinh where $trangthai and $where LIKE '%" . $queryString . "%' group by $value order by id desc limit 20 ";
		
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($idname == 'tenkhachhangs'){
				$itemStr = getName('dm_khachhang','tenkhachhang',$item[$value]);
			}
			else if($idname == 'makhachhangs'){
				$itemStr = getName('dm_khachhang','makhachhang',$item[$value]);
			}
			else if($idname == 'chutaikhoans'){
				$itemStr = getName('dm_khachhangct','chutaikhoan',$item[$value]);
			}
			else if($idname == 'sotaikhoannganhangs'){
				$itemStr = getName('dm_khachhangct','sotaikhoannganhang',$item[$value]);
			}
			else if($idname == 'tennganhangs'){
				$itemStr = getName('dm_nganhang','tennganhang',$item[$value]);
			}
			else if($idname == 'soluongs' || $idname == 'dongias' || $idname == 'thanhtiens'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanNhapTienQuyGiaDinh("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	// ==== A.VU THEM SEARCH - KE TOAN QŨY TIỀN === //
	case 'searchKeToanQuyTienThuTien':
		$where = trim($_POST['where'] ?? '');
		$value = trim($_POST['value'] ?? '');
		$idname = trim($_POST['idname'] ?? '');
		$table = trim($_POST['table'] ?? '');

		if($idname == 'tongthanhtiens'){
			$queryString = str_replace(',', '', $queryString);
		}

		if($idname == 'idnvnoptiens')
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where in (select id from $GLOBALS[db_spns].nhanvien where fullname LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'iddiachinoptiens')
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where in (select id from $GLOBALS[db_spns].danhmucphongban where name_vn LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'makhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where in (select id from $GLOBALS[db_sp].dm_khachhang where makhachhang LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else if($idname == 'tenkhachhangs')
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where in (select id from $GLOBALS[db_sp].dm_khachhang where tenkhachhang LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where LIKE '%" . $queryString . "%' group by $value order by id desc limit 20 ";
		
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($idname == 'idnvnoptiens'){
				$itemStr = getOneNameNhansu('fullname','nhanvien','id = '.$item[$value]);
			}
			else if($idname == 'iddiachinoptiens'){
				$itemStr = getOneNameNhansu('name_vn','danhmucphongban','id = '.$item[$value]);
			}
			else if($idname == 'tenkhachhangs'){
				$itemStr = getName('dm_khachhang','tenkhachhang',$item[$value]);
			}
			else if($idname == 'makhachhangs'){
				$itemStr = getName('dm_khachhang','makhachhang',$item[$value]);
			}
			else if($idname == 'tongthanhtiens'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanQuyTienThuTien("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	case 'searchKeToanQuyTienChiTien':
		$where = trim($_POST['where'] ?? '');
		$value = trim($_POST['value'] ?? '');
		$idname = trim($_POST['idname'] ?? '');
		$table = trim($_POST['table'] ?? '');

		if($idname == 'tongthanhtiens'){
			$queryString = str_replace(',', '', $queryString);
		}

		if($idname == 'idnvnhantiens')
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where in (select id from $GLOBALS[db_spns].nhanvien where fullname LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'iddiachinhantiens')
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where in (select id from $GLOBALS[db_spns].danhmucphongban where name_vn LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else if($idname == 'donhangmuas')
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where in (select id from $GLOBALS[db_sp].ketoan_noidung_dathang where maphieu LIKE '%" . $queryString . "%') group by $value order by id desc limit 20 ";
		else
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where LIKE '%" . $queryString . "%' group by $value order by id desc limit 20 ";
		
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($idname == 'idnvnhantiens'){
				$itemStr = getOneNameNhansu('fullname','nhanvien','id = '.$item[$value]);
			}
			else if($idname == 'iddiachinhantiens'){
				$itemStr = getOneNameNhansu('name_vn','danhmucphongban','id = '.$item[$value]);
			}
			else if($idname == 'tongthanhtiens'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else if($idname == 'donhangmuas'){
				$itemStr = getName('ketoan_noidung_dathang','maphieu',$item[$value]);
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanQuyTienChiTien("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	// === A.VU THÊM SEARCH - KẾ TOÁN - CHI TIỀN === //
	case 'SearchKeToanChiTienDMKhachHang': // === DM KHÁCH HÀNG === //
		$sql = "select * from $GLOBALS[db_sp].dm_khachhang
						where ( makhachhang LIKE '%" . $queryString . "%' or tenkhachhang LIKE '%" . $queryString . "%' )
							and active=1 
							order by num asc, id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertKeToanChiTienDMKhachHang("'.$item['id'].'","'.$item['makhachhang'].'","'.$item['tenkhachhang'].'")\'> 
					'.$item['makhachhang'].'  :  '.$item['tenkhachhang'].'
				</a>
			';
		}
		echo $str;
	break;
	case 'SearchKeToanChiTienSoHopDong': // === SỐ HỢP ĐỒNG === //
		$idkhachhang = ceil($_POST['idkhachhang']);
		$wh = '';
		if($idkhachhang > 0){
			$wh.=' and idkhachhang = '.$idkhachhang;
		}
		$sql = "select id,mahopdong,sohopdong,noidunghopdong,datedend from $GLOBALS[db_sp].ql_hopdong_nhap
					where (mahopdong LIKE '%" . $queryString . "%' 
						or sohopdong LIKE '%" . $queryString . "%' 
						or noidunghopdong LIKE '%" . $queryString . "%') $wh
					order by id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanChiTienSoHopDong("'.$item['id'].'","'.$item['mahopdong'].'","'.$item['datedend'].'")\'> 
					'.$item["mahopdong"].' ('.$item["sohopdong"].') <br><span style="color:#990000"> '.$item['noidunghopdong'].'</span>
				</a>
			';
		}
		echo $str;
	break;
	case 'getChiTienHinhThucThanhToan': // === SỐ TÀI KHOẢN === //
		$idkhachhang = ceil($_POST['idkhachhang']);
		if($idkhachhang > 0){
			$sql = "select id,sotaikhoannganhang from $GLOBALS[db_sp].dm_khachhangct where idct = $idkhachhang and active = 1 and idstk > 0 order by num asc, id asc";
			$rs = $GLOBALS["sp"]->getAll($sql);
		}
		die(json_encode(array('status'=>$rs)));
	break;
	case 'getKeToanChiTienThongTinNganHang': // === THÔNG TIN NGÂN HÀNG === //
		$idsotaikhoan = ceil($_POST['idsotaikhoan']);
		if($idsotaikhoan > 0){
			$sql = "select * from $GLOBALS[db_sp].dm_khachhangct where id = $idsotaikhoan";
			$rs = $GLOBALS["sp"]->getRow($sql);
			if($rs['idnganhang'] > 0){
				$rs['nganhang'] = getName('dm_nganhang','tengiaodich',$rs['idnganhang']);
			}
		}
		die(json_encode(array('status'=>$rs)));
	break;
	// ==== A.VU THÊM SEARCH - KẾ TOÁN CHI TIỀN === //
	case 'searchKeToanChiTien':
		$where = $_POST['where'];
		$value = $_POST['value'];
		$idname = $_POST['idname'];
		if($idname == 'sotiendukiens'){
			$queryString = str_replace(',', '', $queryString);
		}

		if($idname == 'makhachhangs')
			$whInLike = "in (select id from $GLOBALS[db_sp].dm_khachhang where makhachhang LIKE '%" . $queryString . "%')";
		else if($idname == 'tenkhachhangs')
			$whInLike = "in (select id from $GLOBALS[db_sp].dm_khachhang where tenkhachhang LIKE '%" . $queryString . "%')";
		else if($idname == 'idquanlyhopdongs')
			$whInLike = "in (select id from $GLOBALS[db_sp].ql_hopdong_nhap where mahopdong LIKE '%" . $queryString . "%')";
		else if($idname == 'mids')
			$whInLike = "in (select id from $GLOBALS[db_sp].admin where fullname LIKE '%" . $queryString . "%')";
		else
			$whInLike = "LIKE '%" . $queryString . "%'";

		$sql = "select id, $value from $GLOBALS[db_sp].ketoan_chitien where $where $whInLike group by $value order by id asc limit 20 ";
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($idname == 'tenkhachhangs'){
				$itemStr = getName('dm_khachhang','tenkhachhang',$item[$value]);
			}
			else if($idname == 'makhachhangs'){
				$itemStr = getName('dm_khachhang','makhachhang',$item[$value]);
			}
			else if($idname == 'idquanlyhopdongs'){
				$itemStr = getName('ql_hopdong_nhap','mahopdong',$item[$value]);
			}
			else if($idname == 'mids'){
				$itemStr = getName('admin','fullname',$item[$value]);
			}
			else if($idname == 'sotiendukiens'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else if($idname == 'thongtinnganhangs'){
				$itemStr = str_replace("|","",$item[$value]);
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanChiTien("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	case 'getKeToanListDeNghiChiTien':
		$cid = $_POST['cid'];
		if($cid > 0){
			$sql = "select id,maphieu from $GLOBALS[db_sp].ketoan_chitien where cid = $cid and trangthai = 0 order by dated desc, id desc";
			$rs = $GLOBALS['sp']->getAll($sql);
		}
		die(json_encode(array('status'=>$rs)));
	break;
	case 'getKeToanGetRow':
		$id = ceil($_POST['id']);
		$table = trim($_POST['table'] ?? '');
		$names = trim($_POST['names'] ?? '');
		$rs = array();
		if($id > 0){
			$sql = "select $names from $GLOBALS[db_sp].$table where id = $id";
			$rs = $GLOBALS['sp']->getRow($sql);
		}
		die(json_encode(array('status'=>$rs)));
	break;
	
	// MAI THÊM LẤY TÊN SẢN PHẨM
	case "selectvalue-products-tensp":
		$idnhomsp = trim($_POST['idnhomsp']);
		$idtensp = trim($_POST['idtensp']);
		$name = trim($_POST['name']);
		$str = "";
		$arr = array();
		if (!empty($idnhomsp)){
			$sqlnhomsp = "SELECT id, name_vn, kituma from $GLOBALS[db_catalog].dmsp_tensanpham where idnhomsanpham=$idnhomsp and active=1";
			$rsnhomsp = $GLOBALS['catalog']->getAll($sqlnhomsp);

			foreach ($rsnhomsp as $key => $value) {
				$selected = "";
				if ($idtensp > 0) {
					$selected = ($idtensp == $value['id']) ? 'selected="selected"' : "" ;
				}
				$str .= "
				<option $selected value='$value[id],$value[kituma],$value[name_vn]'>
					$value[kituma] : $value[name_vn]
				</option>";
			}
			$strarr = $str;
		}
		$arr = '
			<option value="0,0">--Chọn Tên sản phẩm--</option>
				'.$strarr.'
		';
		
		if ($name == 'view') {
			$arr = $strarr;
		}

		echo $arr;
	break;
	// === A.VŨ THÊM QL THU CHI - QL ĐẶT HÀNG, MUA HÀNG - CHỌN TÍNH CHẤT ĐẶT HÀNG - CHỌN DANH MỤC KHO === //
	case 'getKeToanDatHangTinhChatDatHangChonKho':
		$id = ceil($_POST['id']);
		$rs = array();
		if($id > 0){
			$sql = "select cidnhap_khoda from $GLOBALS[db_sp].ketoan_dm_kho where id = $id";
			$rs = $GLOBALS['sp']->getRow($sql);
		}
		die(json_encode(array('status'=>$rs)));
	break;
	// ==== A.VU THEM SEARCH - QL THU CHI - LẬP PHIẾU KHO KIM CUO === //
	case 'SearchKeToanLapPhieuKimCuongTam':
		$idnum = ceil($_POST['dong']);
		$idnumct = ceil($_POST['dongct']);
		$sql = "select * from $GLOBALS[db_catalog].thongsohottam where size LIKE '%" . $queryString . "%' and pid > 0 and active=1 order by pid asc, id asc limit 20";
		$rs = $GLOBALS["catalog"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'InsertKeToanLapPhieuKimCuongTam("'.$item['id'].'","'.$item['size'].'","'.$idnum.'","'.$idnumct.'")\'> 
					'.$item['size'].'
				</a>
			';
		}
		echo $str;
	break;
	// === A.VŨ THÊM SEARCH - QL THU CHI - THỐNG KÊ QUỸ TIỀN - CHI TIỀN === //
	case 'searchKeToanThongKeQuyTienChiTien':
		$where = trim($_POST['where'] ?? '');
		$value = trim($_POST['value'] ?? '');
		$idname = trim($_POST['idname'] ?? '');
		$table = trim($_POST['table'] ?? '');
		$tablect = trim($_POST['tablect'] ?? '');

		if($idname == 'thanhtiens' || $idname == 'dongias' || $idname == 'soluongs')
			$queryString = str_replace(',', '', $queryString);
		
		if($idname == 'thanhtiens' || $idname == 'dongias' || $idname == 'soluongs' || $idname == 'chiphis' || $idname == 'ghichus' || $idname == 'noidungs' || $idname == 'dvts')
			$sql = "select id, $value from $GLOBALS[db_sp].$tablect where $where and $value LIKE '%".$queryString."%' group by $value order by id desc limit 20";
		else if($idname == 'donhangmuas'){
			$wh_dhm = "select id from $GLOBALS[db_sp].ketoan_noidung_dathang where maphieu LIKE '%".$queryString."%'";
			$wh_ct = "select id from $GLOBALS[db_sp].ketoan_chitien where maphieu LIKE '%".$queryString."%'";
			$sql = "select id, $value, idchitien from $GLOBALS[db_sp].$table where $where and ($value IN ($wh_dhm) or idchitien IN ($wh_ct))";
		}
		else if($idname == 'tenkhachhangs'){
			$wh = "select id from $GLOBALS[db_sp].dm_khachhang where tenkhachhang LIKE '%".$queryString."%'";
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where and $value IN ($wh)";
		}
		else if($idname == 'sohopdongs'){
			$wh = "select id from $GLOBALS[db_sp].ketoan_noidung_dathang where sohopdong LIKE '%".$queryString."%'";
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where and $value IN ($wh)";
		}
		else if($idname == 'sohoadons'){
			$wh = "select id from $GLOBALS[db_sp].ketoan_noidung_dathang where sohoadon LIKE '%".$queryString."%'";
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where and $value IN ($wh)";
		}
		else
			$sql = "select id, $value from $GLOBALS[db_sp].$table where $where and $value LIKE '%".$queryString."%' group by $value order by id desc limit 20";
		
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($idname == 'donhangmuas'){
				if($item['idchitien'] > 0)
					$itemStr = getName('ketoan_chitien','maphieu',$item['idchitien']);
				if($item['iddonhangmua'] > 0)
					$itemStr = getName('ketoan_noidung_dathang','maphieu',$item['iddonhangmua']);
			}
			else if($idname == 'thanhtiens' || $idname == 'dongias' || $idname == 'soluongs'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else if($idname == 'tenkhachhangs'){
				$itemStr = getName('dm_khachhang','tenkhachhang',$item[$value]);
			}
			else if($idname == 'sohopdongs'){
				$itemStr = getName('ketoan_noidung_dathang','sohopdong',$item[$value]);
			}
			else if($idname == 'sohoadons'){
				$itemStr = getName('ketoan_noidung_dathang','sohoadon',$item[$value]);
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanThongKeQuyTienChiTien("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	// === A.VŨ THÊM SEARCH - CHỌN NHÂN VIÊN TỪ PHẦN MỀM NHÂN SỰ === //
	case 'SearchNhanVienPMNS':
		$idname = trim($_POST['idname']);
		$wh = trim($_POST['wh']);
		
		$sql = "select id,manv,fullname from $GLOBALS[db_spns].nhanvien where (manv LIKE '%" . $queryString . "%' or fullname LIKE '%" . $queryString . "%') $wh and active=1 and status=1 order by id asc limit 20";
		$rs = $GLOBALS["spns"]->getAll($sql);
		
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertNhanVienPMNS("'.$item['id'].'","'.$item['manv'].'","'.$item['fullname'].'","'.$idname.'")\'> 
					'.$item['manv'].' | '.$item['fullname'].'
				</a>
			';
		}
		echo $str;
	break;
	// === A.VŨ THÊM SEARCH - CHỌN PHÒNG BAN TỪ PHẦN MỀM NHÂN SỰ === //
	case 'SearchPhongBanPMNS':
		$idname = trim($_POST['idname']);

		$sql = "select id,name_vn from $GLOBALS[db_spns].danhmucphongban where pid=1 and name_vn LIKE '%" . $queryString . "%' and active=1 order by id asc limit 20";
		$rs = $GLOBALS["spns"]->getAll($sql);

		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertPhongBanPMNS("'.$item['id'].'","'.$item['name_vn'].'","'.$idname.'")\'> 
					'.$item['name_vn'].'
				</a>
			';
		}
		echo $str;
	break;
	// === A.VŨ THÊM OPTION NỘI DUNG SỬA CHỮA - QL THU CHI - QL ĐẶT HÀNG MUA HÀNG === //
	case 'getKeToanDatHangNoiDungSuaChuaChild':
		$rs = array();
		$id = ceil($_POST['id']);
		if($id > 0){
			$sql = "select id,name_vn from $GLOBALS[db_sp].ketoan_dm_kho where pid = $id and active = 1 order by num asc, id asc";
			$rs = $GLOBALS["sp"]->getAll($sql);
		}
		die(json_encode(array('status'=>$rs)));
	break;
	// === A.VŨ THÊM SEARCH QL CÔNG NỢ - CÔNG NỢ CHI TIẾT === //
	case 'searchKeToanCongNoChiTiet':
		$col = trim($_POST['col']);
		$idname = trim($_POST['idname']);
		$table = trim($_POST['table']);
		
		if($idname == 'sotiendukiens' || $idname == 'sotiens'){
			$queryString = str_replace(',', '', $queryString);
		}
		
		$sql = "select id, $col from $GLOBALS[db_sp].$table where $col like '%" . $queryString . "%' group by $col order by id asc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);

		foreach($rs as $item){
			if($idname == 'sotiendukiens' || $idname == 'sotiens'){
				$itemStr = number_format($item[$col]);
				$right = 'align="right"';
			}
			else
				$itemStr = $item[$col];

			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanCongNoChiTiet("'.$item['id'].'",`'.$itemStr.'`,"'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	// === A.VŨ THÊM SEARCH QL CÔNG NỢ - THỐNG KÊ CÔNG NỢ CHUYỂN KHOẢN NGÂN HÀNG === //
	case 'searchKeToanCongNoThongKeChuyenKhoan':
		$col = trim($_POST['col']);
		$idname = trim($_POST['idname']);
		$table = trim($_POST['table']);
		$where = trim($_POST['where']);
		
		if($idname == 'sotiens' || $idname == 'phinganhang_chuyenkhoans'){
			$queryString = str_replace(',', '', $queryString);
		}

		$sql_httt = "select id from $GLOBALS[db_sp].ketoan_dm_hinhthucthanhtoan where type_sotaikhoan = 1";
		$where.= " and trangthai = 1 and idct in (select id from $GLOBALS[db_sp].ketoan_congno where idhinhthucthanhtoan in ($sql_httt))";
		
		if($table == 'ketoan_congno'){
			$sql_congno = "select id from $GLOBALS[db_sp].ketoan_congno where $col like '%" . $queryString . "%' group by $col";
			$rs_congno = $GLOBALS["sp"]->getCol($sql_congno);
			$rs_congno = implode(',',$rs_congno);
		}
		else if($table == 'dm_khachhang'){
			$sql_khachhang = "select id from $GLOBALS[db_sp].dm_khachhang where $col like '%" . $queryString . "%'";
			$sql_congno = "select id from $GLOBALS[db_sp].ketoan_congno where idkhachhang in (".$sql_khachhang.") group by idkhachhang";
			$rs_congno = $GLOBALS["sp"]->getCol($sql_congno);
			$rs_congno = implode(',',$rs_congno);
		}
		else if($table == 'ketoan_chitien'){
			$sql_chitien = "select id from $GLOBALS[db_sp].ketoan_chitien where $col like '%" . $queryString . "%'";
			$sql_congno = "select id from $GLOBALS[db_sp].ketoan_congno where idchitien in (".$sql_chitien.") group by idchitien";
			$rs_congno = $GLOBALS["sp"]->getCol($sql_congno);
			$rs_congno = implode(',',$rs_congno);
		}

		if(!empty($rs_congno))
			$sql = "select id, idct from $GLOBALS[db_sp].ketoan_congno_dukien where $where and idct in ( ".$rs_congno." ) order by id asc limit 20";
		else
			$sql = "select id, $col from $GLOBALS[db_sp].ketoan_congno_dukien where $where and $col like '%" . $queryString . "%' group by $col order by id asc limit 20";
		
		$rs = $GLOBALS["sp"]->getAll($sql);

		foreach($rs as $item){
			if($idname == 'sotiens' || $idname == 'phinganhang_chuyenkhoans'){
				$itemStr = number_format($item[$col]);
				$right = 'align="right"';
			}
			else if($table == 'ketoan_congno'){
				$itemStr = getName('ketoan_congno',$col,$item['idct']);
			}
			else if($table == 'dm_khachhang'){
				$idkh = getName('ketoan_congno','idkhachhang',$item['idct']);
				$itemStr = getName('dm_khachhang',$col,$idkh);
			}
			else if($table == 'ketoan_chitien'){
				$idchitien = getName('ketoan_congno','idchitien',$item['idct']);
				$itemStr = getName('ketoan_chitien',$col,$idchitien);
			}
			else
				$itemStr = $item[$col];
			
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanCongNoThongKeChuyenKhoan("'.$item['id'].'",`'.$itemStr.'`,"'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	case "maDaCatalog":
		$cid = 854; //KHO ĐÁ CATALOG -. KHO ĐÁ TEM SWAROVKI 
		$listId = '';
		$list = array();
		recursiveListCategoriesByID($cid, $list);
		$listId = implode(',', $list);
		$sql = "select id, code, tengoida from $GLOBALS[db_catalog].banggiada
				where active=1
				and code LIKE '%" . $queryString . "%' 
				and cid in (".$listId.")
				order by id asc limit 50";
		$rs = $GLOBALS["catalog"]->getAll($sql);
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick="insertMaDaCatalog('.$item['id'].',\''.$item['code'].'\',\''.$item['tengoida'].'\')"> 
					<div style="width:100%">
						'.$item['code'].'
					</div>
				</a>
			';
		}
		echo $str;
	break;
	// === ANH VŨ THÊM SEARCH KẾ TOÁN QUỸ TIỀN THỐNG KÊ NHẬP XUẤT TỒN === // 
	case 'searchKeToanQuyTienThongKeNhapXuatTon':
		$value = trim($_POST['value'] ?? '');
		$idname = trim($_POST['idname'] ?? '');
		$table = trim($_POST['table'] ?? '');
		$fromDate = trim($_POST['fromdays'] ?? '');
		$toDate = trim($_POST['todays'] ?? '');

		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			$wh_date.=' and dateduyet >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$wh_date.=' and dateduyet <= "'.$toDate.'" ';
		}

		if($idname == 'tienthus' || $idname == 'tienchis'){
			$queryString = str_replace(',', '', $queryString);
		}
		// ĐIỀU KIỆN SEARCH
		if($idname == 'maphieuthuchis'){
			$wh_search = "(maphieuthu LIKE '%" . $queryString . "%' or maphieuchi LIKE '%" . $queryString . "%')";
		}
		else{
			$wh_search = "$value LIKE '%" . $queryString . "%'";
		}

		$sql = "select id,type,$value from $GLOBALS[db_sp].$table where trangthai = 2 and $wh_search $wh_date group by $value order by id asc limit 20 ";
		$rs = $GLOBALS["sp"]->getAll($sql);

		foreach($rs as $item){
			if($idname == 'tienthus' || $idname == 'tienchis'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else if($idname == 'maphieuthuchis'){
				if($item['type'] == 1){
					$itemStr = $item['maphieuthu'];
				}
				else{
					$itemStr = $item['maphieuchi'];
				}
			}
			else{
				$itemStr = $item[$value];
			}
			
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanQuyTienThongKeNhapXuatTon("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	// === ANH VŨ THÊM GET BỘ PHẬN THEO PHÒNG BAN CHỌN - QL THU CHI - QL CÔNG NỢ - BÁO CÁO CHI TIỀN === //
	case 'getOptBoPhanTheoPhongBanChonCongNoBaoCaoChiTien':
		$idphong = $_POST['idphong'];
		$idphong = implode(",",$idphong);
		$str = '';
		$idkhongbophan = 0;
		if(!empty($idphong)){
			$sql = "select id,name_vn,pid from $GLOBALS[db_spns].danhmucphongban where level = 3 and active = 1 and pid in ($idphong)";
			$rs = $GLOBALS["spns"]->getAll($sql);
			if(strpos($idphong,"-1") !== false){
				$arrnew = array();
				$arrnew = [
					'id' => '-1',
					'name_vn' => 'KHÔNG CÓ BỘ PHẬN',
				];
				array_unshift($rs,$arrnew); // hàm thêm vào đầu mảng
			}
			foreach($rs as $item){
				$str .= '<option value="'.$item['id'].'">'.$item['name_vn'].'</option>';
			}
			$error = $rs;
		}
		$name['html'] = $str;
		die(json_encode(array('status'=>$error,'name'=>$name)));
	break;
	// === ANH VŨ THÊM GET CƠ CẤU TỔ CHỨC THEO DANH MỤC GIA ĐÌNH > PHÒNG BAN - QL THU CHI === //
	case 'getKeToanCongNoCoCauToChucGiaDinh':
		$str_name = "";
		$rs = array();
		$id = ceil($_POST['id']);
		$idname = trim(striptags($_POST['idname']) ?? '');
		if($id > 0){
			$sql = "select id,name_vn from $GLOBALS[db_sp].ketoan_congno_dm where pid = $id and active = 1";
			$rs = $GLOBALS["sp"]->getAll($sql);

			$sql_level = "select level from $GLOBALS[db_sp].ketoan_congno_dm where id = $id";
			$level = $GLOBALS["sp"]->getOne($sql_level);
			if($level == 2)	
				$str_name = "bộ phận";
			else if($level == 3) 
				$str_name = "tổ";
			else if($level == 4) 
				$str_name = "cá nhân";
		}
		die(json_encode(array('status'=>$rs,'name'=>$str_name)));
	break;
	// === A.VŨ THÊM SEARCH - CHỌN NHÂN VIÊN TỪ PHẦN MỀM NHÂN SỰ - CÔNG NỢ - PHIẾU THU QUỸ N00 TỪ NGUỒN KHÁC === //
	case 'SearchNhanVienPMNSThuTienQuyN00':
		$idname = trim($_POST['idname'] ?? '');
		
		$sql = "select id,manv,fullname,idphongban,idbophan from $GLOBALS[db_spns].nhanvien where (manv LIKE '%" . $queryString . "%' or fullname LIKE '%" . $queryString . "%') and active=1 and status=1 order by id asc limit 20";
		$rs = $GLOBALS["spns"]->getAll($sql);
		
		foreach($rs as $item){
			$phongban = $bophan = '';
			if($item['idphongban'] > 0)
				$phongban = getOneNameNhansu('name_vn', 'danhmucphongban', 'id = '.$item['idphongban']);
			if($item['idbophan'] > 0)
				$bophan = getOneNameNhansu('name_vn', 'danhmucphongban', 'id = '.$item['idbophan']);

			$str .= '
				<a href="javascript:void(0)" onclick=\'insertNhanVienPMNSThuTienQuyN00("'.$item['id'].'","'.$item['manv'].'","'.$item['fullname'].'","'.$idname.'","'.$item['idphongban'].'","'.$phongban.'","'.$item['idbophan'].'","'.$bophan.'")\'> 
					'.$item['manv'].' | '.$item['fullname'].'
				</a>
			';
		}
		echo $str;
	break;
	// === A.VŨ THÊM SEARCH - CHỌN PHÒNG BAN TỪ PHẦN MỀM NHÂN SỰ - CÔNG NỢ - PHIẾU THU QUỸ N00 TỪ NGUỒN KHÁC === //
	case 'SearchPhongBanPMNSThuTienQuyN00':
		$idname = trim($_POST['idname'] ?? '');
		$level = trim($_POST['level'] ?? '');
		
		$sql = "select * from $GLOBALS[db_spns].danhmucphongban where name_vn LIKE '%" . $queryString . "%' and level = $level and active=1 order by id asc limit 20";
		$rs = $GLOBALS["spns"]->getAll($sql);
		
		foreach($rs as $item){
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertPhongBanPMNSThuTienQuyN00("'.$item['id'].'","'.$item['name_vn'].'","'.$idname.'")\'> 
					'.$item['name_vn'].'
				</a>
			';
		}
		echo $str;
	break;
	// ==== A.VU THEM SEARCH - KE TOAN THU TIỀN QUỸ N00 TỪ NGUỒN KHÁC === //
	case 'searchKeToanThuTienQuyN00TuNguonKhac':
		$where = trim($_POST['where']);
		$value = trim($_POST['value']);
		$idname = trim($_POST['idname']);
		
		if($idname == 'tongthanhtiens'){
			$queryString = str_replace(',', '', $queryString);
		}

		if($idname == 'idnvnoptiens')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_thutien_quyn00 where $where in (select id from $GLOBALS[db_spns].nhanvien where fullname LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else if($idname == 'idphongs' || $idname == 'idbophans')
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_thutien_quyn00 where $where in (select id from $GLOBALS[db_spns].danhmucphongban where name_vn LIKE '%" . $queryString . "%') group by $value order by id asc limit 20 ";
		else
			$sql = "select id, $value from $GLOBALS[db_sp].ketoan_thutien_quyn00 where $where LIKE '%" . $queryString . "%' group by $value order by id asc limit 20 ";
		
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			if($idname == 'idnvnoptiens'){
				$itemStr = getOneNameNhansu('fullname','nhanvien','id='.$item[$value]);
			}
			else if($idname == 'idphongs' || $idname == 'idbophans'){
				$itemStr = getOneNameNhansu('name_vn','danhmucphongban','id='.$item[$value]);
			}
			else if($idname == 'tongthanhtiens'){
				$itemStr = number_format($item[$value]);
				$right = 'align="right"';
			}
			else{
				$itemStr = $item[$value];
			}
			$str .= '
				<a href="javascript:void(0)" onclick=\'insertKeToanThuTienQuyN00TuNguonKhac("'.$item['id'].'","'.$itemStr.'","'.$idname.'")\'> 
					<p '.$right.'>'.$itemStr.'</p>
				</a>
			';
		}
		echo $str;
	break;
	// ==== A.VU THÊM CHỌN PHÒNG BAN THEO LOẠI PHÒNG BAN - KẾ TOÁN CÔNG NỢ === //
	case 'getKeToanCongNoCoCauToChucTheoLoaiPhongBan':
		$wh = $whnv = $name = '';
		$rs = array();
		$id = ceil($_POST['id']);
		$idphong = ceil($_POST['idphong']);
		$idbophan = ceil($_POST['idbophan']);
		$idto = ceil($_POST['idto']);
		$idname = trim($_POST['idname']);
		$idloaiphongban = ceil($_POST['idloaiphongban']);

		if($idloaiphongban > 0){
			$loaipb = getRowName('table_loaiphongban,cid_loaiphongban,idloaiphongban','ketoan_congno_dm','id = '.$idloaiphongban);

			if($loaipb['table_loaiphongban'] == 'danhmucphongban'){
				if($id > 0 && !empty($idname)){
					if($idname == 'idphong') $wh = "and pid = 1 and level = 2";
					if($idname == 'idbophan') $wh = "and pid = $id and level = 3";
					if($idname == 'idto') $wh = "and pid = $id and level = 4";

					$sql = "select id,name_vn from $GLOBALS[db_spns].danhmucphongban where active = 1 $wh";
					$rs = $GLOBALS["spns"]->getAll($sql);
				}
				if(!empty($idphong) || !empty($idbophan) || !empty($idto)){
					if(!empty($idphong))
						$whnv .= " and idphongban in ($idphong)";
					if(!empty($idbophan))
						$whnv .= " and idbophan in ($idbophan)";
					if(!empty($idto))
						$whnv .= " and idnhomto in ($idto)";
				}
			}
			else if($loaipb['table_loaiphongban'] == 'ketoan_congno_dm'){
				if($id > 0 && !empty($idname)){
					if($idname == 'idphong') $wh = "and pid = 0 and level = 1 and cid = ".$loaipb['cid_loaiphongban'];
					if($idname == 'idbophan') $wh = "and pid = $id and level = 2 and cid = ".$loaipb['cid_loaiphongban'];
					if($idname == 'idto') $wh = "and pid = $id and level = 3 and cid = ".$loaipb['cid_loaiphongban'];

					$sql = "select id,name_vn from $GLOBALS[db_sp].ketoan_congno_dm where active = 1 $wh";
					$rs = $GLOBALS["sp"]->getAll($sql);
				}
			}

			$sqlnv = "select id,fullname from $GLOBALS[db_spns].nhanvien where active = 1 $whnv";
			$rsnv = $GLOBALS["spns"]->getAll($sqlnv);
			$name = '<option value="">--Chọn cá nhân--</option>';
			foreach($rsnv as $nv){
				$name .= "<option value='".$nv['id']."'>".$nv['fullname']."</option>";
			}
		}

		die(json_encode(array('status'=>$rs,'name'=>$name,'whnv'=>$whnv)));
	break;
	// === A.VU THÊM SEARCH SUPER SELECT - QL THU CHI - QL ĐẶT HÀNG MUA HÀNG - ĐHM XUẤT HÓA ĐƠN === //
	case "superselectKeToanXuatHoaDon":
		$wh = '';
		$where = trim($_POST['where']);
		$seleted_value = $_POST['seleted_value'] ?? '';
		$seleted_value = empty($seleted_value) ? '' : "'".str_replace(",", "','", $seleted_value)."'";
        if(!empty(trim($_POST['search']))){
			$queryString = addslashes($_POST['search']);
            $wh = " and maphieu like '%".$queryString."%' ";
		}
		else {
			$wh .= " and maphieu != '' ";
		}

		if ($seleted_value != '') {
			$wh .= " and ( id not in ($seleted_value) ) ";
		}
		
		$data = array();
		$data['datatype'] = 'html';
		$data['html'] = array();

		if ($seleted_value != '') {
			$sql_seleted = "select id,maphieu from $GLOBALS[db_sp].ketoan_noidung_dathang where cid = 2225 $where and id in ($seleted_value) order by dated desc";
			$rs_seleted = $GLOBALS["sp"]->getAll($sql_seleted);
			if (!empty($rs_seleted)){
				foreach ($rs_seleted as $row) {
					$data['html'][] = "<option value='$row[id]' selected>$row[maphieu]</option>";
				}
			}
		}

		$sql = "select id,maphieu from $GLOBALS[db_sp].ketoan_noidung_dathang where cid = 2225 $where $wh order by dated desc limit 20";
		$rs = $GLOBALS["sp"]->getAll($sql);
		if (!empty($rs)){
            foreach ($rs as $row) {
				$data['html'][] = "<option value='$row[id]'>$row[maphieu]</option>";			
            }
        }
		echo json_encode($data);
	break;
	// === ANH VŨ THÊM GET BỘ PHẬN THEO PHÒNG BAN CHỌN - QL THU CHI - QL CÔNG NỢ - BÁO CÁO CHI TIỀN - CHI TIẾT THEO TỪNG BỘ PHẬN === //
	case 'getOptPhongBanTheoLoaiPhongBanChonCongNoBaoCaoChiTienTheoTungBoPhan':
		$idloaiphongban = ceil($_POST['idloaiphongban']);
		$arrnew = $rs = array();
		$str = $wh = '';
		if($idloaiphongban > 0){
			$sql_loaiphongban = "select * from $GLOBALS[db_sp].ketoan_congno_dm where id = $idloaiphongban";
			$rs_loaiphongban = $GLOBALS['sp']->getRow($sql_loaiphongban);
			
			$cid = $rs_loaiphongban['cid_loaiphongban'];
			$table = $rs_loaiphongban['table_loaiphongban'];
			$db = $rs_loaiphongban['db_loaiphongban'];
			$conn = $rs_loaiphongban['conn_loaiphongban'];

			if($table == 'danhmucphongban')
				$wh = "and level = 2";
			else
				$wh = "and level = 1 and cid = $cid";

			$sql = "select id,name_vn from $GLOBALS[$db].$table where active = 1 $wh order by id asc";
			$rs = $GLOBALS[$conn]->getAll($sql);
		}
		else{
			$arrnew = ['id' => '-1','name_vn' => 'KHÔNG PHÒNG BAN'];
			array_unshift($rs,$arrnew);
		}

		if(!empty($rs)){
			foreach($rs as $item){
				$str .= '<option value="'.$item['id'].'">'.$item['name_vn'].'</option>';
			}
		}
		$error = $rs;
		$name['html'] = $str;
		die(json_encode(array('status'=>$error,'name'=>$name)));
	break;
	case 'getOptBoPhanTheoPhongBanChonCongNoBaoCaoChiTienTheoTungBoPhan':
		$idloaiphongban = $_POST['idloaiphongban'];
		$idphong = implode(",",$_POST['idphong']);
		$arrnew = $rs = array();
		$arrnew = [
			'id' => '-1',
			'name_vn' => 'KHÔNG BỘ PHẬN',
		];
		$str = '';
		if(!empty($idloaiphongban) && !empty($idphong) && strpos($idphong,"-1") === false){
			$loaipb = getRowName('table_loaiphongban,cid_loaiphongban,idloaiphongban','ketoan_congno_dm','id = '.$idloaiphongban);

			if($loaipb['table_loaiphongban'] == 'danhmucphongban'){
				$sql = "select id,name_vn from $GLOBALS[db_spns].danhmucphongban where active = 1 and pid in ($idphong) and level = 3";
				$rs = $GLOBALS["spns"]->getAll($sql);
			}
			else if($loaipb['table_loaiphongban'] == 'ketoan_congno_dm'){
				$sql = "select id,name_vn from $GLOBALS[db_sp].ketoan_congno_dm where active = 1 and pid in ($idphong) and level = 2 and cid = ".$loaipb['cid_loaiphongban'];
				$rs = $GLOBALS["sp"]->getAll($sql);
			}
		}
		if(strpos($idphong,"-1") !== false){
			array_unshift($rs,$arrnew);
		}
		foreach($rs as $item){
			$str .= '<option value="'.$item['id'].'">'.$item['name_vn'].'</option>';
		}
		$error = $rs;
		$name['html'] = $str;
		die(json_encode(array('status'=>$error,'name'=>$name)));
	break;
	case 'getOptToTheoBoPhanChonCongNoBaoCaoChiTienTheoTungBoPhan':
		$idloaiphongban = ceil($_POST['idloaiphongban']);
		$idphong = implode(",",$_POST['idphong']);
		$idbophan = implode(",",$_POST['idbophan']);
		$arrnew = $rs = array();
		$arrnew = [
			'id' => '-1',
			'name_vn' => 'KHÔNG TỔ',
		];
		$str = '';
		if(!empty($idloaiphongban) && !empty($idphong) && !empty($idbophan)){
			$loaipb = getRowName('table_loaiphongban,cid_loaiphongban,idloaiphongban','ketoan_congno_dm','id = '.$idloaiphongban);

			if($loaipb['table_loaiphongban'] == 'danhmucphongban'){
				$sql = "select id,name_vn from $GLOBALS[db_spns].danhmucphongban where active = 1 and pid in ($idbophan) and level = 4";
				$rs = $GLOBALS["spns"]->getAll($sql);
			}
			else if($loaipb['table_loaiphongban'] == 'ketoan_congno_dm'){
				$sql = "select id,name_vn from $GLOBALS[db_sp].ketoan_congno_dm where active = 1 and pid in ($idbophan) and level = 3 and cid = ".$loaipb['cid_loaiphongban'];
				$rs = $GLOBALS["sp"]->getAll($sql);
			}
			if(strpos($idbophan,"-1") !== false){
				array_unshift($rs,$arrnew);
			}
			foreach($rs as $item){
				$str .= '<option value="'.$item['id'].'">'.$item['name_vn'].'</option>';
			}
			$error = $rs;
		}
		$name['html'] = $str;
		die(json_encode(array('status'=>$error,'name'=>$name)));
	break;
	// === GET OPTION TÍNH CHẤT CHI PHÍ - QL THU CHI - DANH MỤC QUY TRÌNH === //
	case 'getOptTinhChatCPKeToanDMQuyTrinh':
		$cidtinhchatcp = implode(",",$_POST['cidtinhchatcp']);
		$rs = array();
		$str = '';
		if(!empty($cidtinhchatcp)){
			$sql = "select id,name_vn from $GLOBALS[db_sp].ketoan_congno_dm where cid in ($cidtinhchatcp) and active = 1";
			$rs = $GLOBALS['sp']->getAll($sql);

			if(!empty($rs)){
				foreach($rs as $item) {
					$str .= '<option value="'.$item['id'].'">'.$item['name_vn'].'</option>';	
				}
			}
		}
		$error = $str;
		die(json_encode(array('status'=>$error)));
	break;
	// === GET CID KHO QUY TRÌNH TỪ TÍNH CHẤT CP - QL THU CHI - THỐNG KÊ QUỸ TIỀN - CHI TIẾT CHI TIỀN === //
	case 'getTinhChatCPThongKeQuyTienChiTietChiTien':
		$id = ceil($_POST['id']);
		$cidkhoquytrinh = '';
		if($id > 0){
			$sql = "select cidkhoquytrinh from $GLOBALS[db_sp].ketoan_congno_dm where id = $id";
			$cidkhoquytrinh = $GLOBALS['sp']->getOne($sql);
		}
		echo $cidkhoquytrinh;
	break;
	// === GET LÝ DO THU TIỀN THEO HÌNH THỨC THU TIỀN - QL THU CHI - QL CÔNG NỢ THỰC TẾ PHÁT SINH === //
	case 'getLyDoThuTienTheoHinhThucThuTienCongNoThucTePhatSinh':
		$datednow = date('d/m/Y');
		$id = ceil($_POST['id']);
		$idloaicongno = ceil($_POST['idloaicongno']);
		$lydothutien = '';
		if($id > 0){
			$sql = "select lydothutien from $GLOBALS[db_sp].ketoan_thutien_dm_hinhthucthutien where id = $id and (FIND_IN_SET(".$idloaicongno.",idloaicongno) > 0)";
			$rs = $GLOBALS['sp']->getRow($sql);
			if(!empty($rs)){
				$sql_lcn = "select lydophieuchuyen from $GLOBALS[db_sp].ketoan_congno_dm where id = $idloaicongno";
				$rs_lcn = $GLOBALS['sp']->getRow($sql_lcn);
	
				$lydothutien = $rs_lcn['lydophieuchuyen'].' '.$rs['lydothutien'].' ngày '.$datednow;
			}
		}
		echo $lydothutien;
	break;
}

?>