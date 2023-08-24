<?php
include("../#include/config.php");
include("../functions/function.php");
CheckLogin();
global $path_url,$path_dir;
if(!isset($_SESSION["store_qlsxntjcorg_login"])){
	die('Vui long dang nhap lai');	
}	
$error = "";
$act = isset($_POST['act'])?$_POST['act']:"";
switch($act){
	case "dateGirldKhoKhacKhoPhanKim":
		$idloaivang = ceil(trim($_POST['idloaivang']));	
		$sql = "select * from $GLOBALS[db_sp].khokhac_khophankim 
				where idloaivang = $idloaivang
				and type=1
				and dalaydulieu = 0 
				order by maphieu asc, id asc
		";
		
		$rs = $GLOBALS["sp"]->getAll($sql);
		foreach($rs as $item){
			$cannangv = str_replace(",", "", $item['cannangv']);
			$tuoivang = str_replace(",", "", $item['tuoivang']);
			$loaivang = getName('loaivang', 'name_vn', $item['idloaivang']);
			if($item['idctnx'] == $idctnx)
				$selected = 'selected="selected"';
			else
				$selected = '';
			$stroption .='
				<option '.$selected.' value="'.$item['id'].','.$cannangv.','.$tuoivang.'" > '.$item['maphieu'].' ('.number_format($item['cannangv'],3,".",",").')</option> 
			';	
		}
		$stroption = '
			<div id="siteIDload">
				<select name="chonmaphieu" id="chonmaphieu" onchange="loadTLVangTuoiVang(this.value)";>
					 <option value="0">Chọn mã phiếu</option>
					 '.$stroption.'
				</select>
				<script>
					$(function () {
						$("#siteIDload select").select2();
					});
				</script>
			</div>	
			
		';
		die(json_encode(array('status'=>$stroption)));
	break;
	case "dateGirldDeCuc":
		$idloaivang = ceil(trim($_POST['idloaivang']));
		$idnumvang = ceil(trim($_POST['idnumvang']));
		$shownameloaivang = trim($_POST['shownameloaivang']);
		$showtuoiquydinh = trim($_POST['showtuoiquydinh']);
		if($idnumvang < 1)
			$idnumvang = 1;	
			
		//////////////////load mã phiếu
		$sql = "select * from $GLOBALS[db_sp].khokhac_khotongdecucct 
				where trangthai <> 3
				and type=2
				and slcannangvcon > 0 
				order by maphieu asc, id asc
		";
		$rs = $GLOBALS["sp"]->getAll($sql);
		
		foreach($rs as $item){
			$cannangv = str_replace(",", "", $item['cannangv']);
			$slcannangvcon = str_replace(",", "", $item['slcannangvcon']);
			$tuoivang = str_replace(",", "", $item['tuoivang']);
			$loaivang = getName('loaivang', 'name_vn', $item['idloaivang']);
			$stroption .='
				<option value="'.$item['id'].','.$cannangv.','.$slcannangvcon.','.$tuoivang.'" > '.$item['maphieu'].' ('.number_format($item['tuoivang'],4,".",",").' :: '.number_format($item['slcannangvcon'],3,".",",").')</option> 
			';	
		}
		$stroption = '
			 <script>
			 	
				$(function () {
					$("#siteIDload'.$idnumvang.' select").select2();
				});
			</script>
			<div id="siteIDload'.$idnumvang.'">
				<select name="siteID" id="siteID" class="abcd" style="width:100%" onchange="searchPhieuTongKhoDeCuc(this.value,'.$idnumvang.');">
					 <option value="0" selected="true">Chọn mã phiếu</option>
					'.$stroption.'
				</select> 
			</div>		
		';	
		
		$tuoiquydinh =' <td align="left">
					 <input type="text" autocomplete="off" name="tuoiquydinhdecuc[]" id="tuoiquydinhdecuc'.$idnumvang.'" value="'.$showtuoiquydinh.'" class="txtdatagirld text-right autoNumeric4" onchange="tinhTLvangchetac('.$idnumvang.')"/>
				 </td> ';	
		/*
		if($idloaivang == 20 || $idloaivang == 4 || $idloaivang == 15 || $idloaivang == 17 || $idloaivang == 18){// là lại vàng vẻ phân thì được sửa tuổi quy định
			$tuoiquydinh =' <td align="left">
					 <input type="text" autocomplete="off" name="tuoiquydinhdecuc[]" id="tuoiquydinhdecuc'.$idnumvang.'" value="'.$showtuoiquydinh.'" class="txtdatagirld text-right autoNumeric4" onchange="tinhTLvangchetac('.$idnumvang.')"/>
				 </td> ';	
		}
		else{
			$tuoiquydinh =' <td align="left">
					 <input type="text" autocomplete="off" name="tuoiquydinhdecuc[]" id="tuoiquydinhdecuc'.$idnumvang.'" value="'.$showtuoiquydinh.'" class="txtdatagirld text-right autoNumeric4" readonly="readonly"/>
				 </td> ';		
		}
		*/
		$str = '
			 <tr>
				 <td align="left">
					'.$idnumvang.'
					<input type="hidden" name="idctnxvang[]" value="0" />
				 </td>
						
				 <td align="left"> 
					<input type="hidden" name="idmaphieudecuc[]" id="idmaphieudecuc'.$idnumvang.'"/>
					'.$stroption.'
				 </td>
				 <td align="left">
					  <input type="text" autocomplete="off" name="ttronluongdecuc[]" id="ttronluongdecuc'.$idnumvang.'" class="txtdatagirld text-right autoNumeric" readonly="readonly"/>
				 </td>
			   
				 <td align="left">
					  <input type="text" autocomplete="off" name="slcannangvcondecuc[]" id="slcannangvcondecuc'.$idnumvang.'" class="txtdatagirld text-right autoNumeric" readonly="readonly"/>
					  <input type="hidden" id="slvangcondecuc'.$idnumvang.'"/>
				 </td>
				 
				 <td align="left">
					 <input type="text" autocomplete="off" name="tlvangcatdecuc[]" id="slcannangvcatdecuc'.$idnumvang.'" class="txtdatagirld text-right autoNumeric" onchange="getslvangcatdecuc('.$idnumvang.',this.value)"/>
					 
				 </td>
				  <td align="left">
					 <input type="text" autocomplete="off" name="tuoithuctedecuc[]" id="tuoithuctedecuc'.$idnumvang.'" class="txtdatagirld text-right autoNumeric4" readonly="readonly"/>
				 </td>
				 <td align="left">
					 <input type="text" autocomplete="off" name="lvchetacdecuc[]" id="lvchetacdecuc'.$idnumvang.'" value="'.$shownameloaivang.'" class="txtdatagirld text-right nameloaivang" readonly="readonly"/>
				 </td>
				 '.$tuoiquydinh.'
				 <td align="left">
					 <input type="text" autocomplete="off" name="tlvangchetacdecuc[]" id="tlvangchetacdecuc'.$idnumvang.'" class="txtdatagirld text-right" readonly="readonly"/>
				 </td>
                 <td align="left">  </td>
                 <td align="left">  </td>
                 <td align="left">  </td>
				 
				<script type="text/javascript" src="'.$path_url.'/js/autoNumeric.js"></script>
				<script>
					$(".autoNumeric").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 3});
					$(".autoNumeric4").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 4});
				</script>
				<script type="text/javascript" src="'.$path_url.'/js/inputFocusKey.js"></script>
			</tr>
			
			
		';
		$idnumvang = $idnumvang + 1;
		die(json_encode(array('status'=>$str, 'idnumvang'=>$idnumvang)));
	break;
	
	case "dateGirldNguonVaoVang":
		$idnumvang = ceil(trim($_POST['idnumvang']));
		if($idnumvang < 1)
			$idnumvang = 1;
		$nhomdanhmuc = ceil(trim($_POST['nhomdanhmuc'])); 
		$str = '
			<tr>
				<td align="left">
				'.$idnumvang.'
				</td>
				<td align="left" class="vang">
				<input type="hidden" name="idctnxvang[]" value="0" />
				<input type="hidden" name="nhomnguyenlieuvang[]" id="nhomnguyenlieuvang'.$idnumvang.'" value="0" />
				<a id="popupNhomDanhMucVang'.$idnumvang.'" href="'.$path_url.'/popup/DanhMucNguyenLieu.php?type=vang&idnhomdm='.$nhomdanhmuc.'&idshow='.$idnumvang.'">
					<span id="showtennhomnguyenlieuvang'.$idnumvang.'">Click chọn</span>
				</a>
				<script type="text/javascript">
					$(document).ready(function() {
						$("#popupNhomDanhMucVang'.$idnumvang.'").fancybox();
					}); 
				</script>
				</td>
				<td align="left" class="vang">
					<input type="hidden" name="tennguyenlieuvang[]" id="tennguyenlieuvang'.$idnumvang.'"/>
					<span id="showtennguyenlieuvang'.$idnumvang.'"></span>
				</td>
				<td align="left" class="vang">
					'.loadloaivang(0,0,$idnumvang).'
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannangvh[]" id="cannangvh'.$idnumvang.'" class="txtdatagirld text-right autoNumeric" onchange="getslcannangv('.$idnumvang.')"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannangh[]" id="cannangh'.$idnumvang.'" class="txtdatagirld text-right autoNumeric" onchange="getslcannangv('.$idnumvang.')"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="cannangv[]" id="cannangv'.$idnumvang.'" class="txtdatagirld text-right autoNumeric"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="tuoivang[]" id="tuoivang'.$idnumvang.'" placeholder="vd: 0.1234" class="txtdatagirld text-right autoNumeric4"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="tienmatvang[]" id="tienmatvang'.$idnumvang.'" class="txtdatagirld"/>
				</td>
				<td align="left" class="vang">
					<input type="text" autocomplete="off" name="ghichuvang[]" id="ghichuvang'.$idnumvang.'" class="txtdatagirld"/>
				</td>
				<script type="text/javascript" src="'.$path_url.'/js/autoNumeric.js"></script>
				<script>
				$(".autoNumeric4").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 4});
				$(".autoNumeric").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 3});
				</script>	
				<script type="text/javascript" src="'.$path_url.'/js/inputFocusKey.js"></script>
			</tr> 
			
			
		';
		$idnumvang = $idnumvang + 1;
		die(json_encode(array('status'=>$str, 'idnumvang'=>$idnumvang)));
	break;
	
	case "dateGirldNguonVaoKimCuong":
		$idnumkimcuong = ceil(trim($_POST['idnumkimcuong']));
		if($idnumkimcuong < 1)
			$idnumkimcuong = 1;
		$nhomdanhmuc = ceil(trim($_POST['nhomdanhmuc'])); 
		$str = '
			<tr>
				<td align="left">
				'.$idnumkimcuong.'
				</td>
				
				<td align="left">
				<input type="hidden" name="idctnxkimcuong[]" value="0" />
				<input type="hidden" name="nhomnguyenlieukimcuong[]" id="nhomnguyenlieukimcuong'.$idnumkimcuong.'" value="0" />
				<a id="popupNhomDanhMucKimCuong'.$idnumkimcuong.'" href="'.$path_url.'/popup/DanhMucNguyenLieu.php?type=kimcuong&idnhomdm='.$nhomdanhmuc.'&idshow='.$idnumkimcuong.'">
					<span id="showtennhomnguyenlieukimcuong'.$idnumkimcuong.'">Click chọn</span>
				</a>
				<script type="text/javascript">
					$(document).ready(function() {
						$("#popupNhomDanhMucKimCuong'.$idnumkimcuong.'").fancybox();
					}); 
				</script>

				</td>
				
				<td align="left">
					<input type="hidden" name="tennguyenlieukimcuong[]" id="tennguyenlieukimcuong'.$idnumkimcuong.'"  value="0"/>
					<span id="showtennguyenlieukimcuong'.$idnumkimcuong.'"></span>
				</td>
				<td align="left">
				<input type="hidden" name="idkimcuong[]" id="idkimcuong'.$idnumkimcuong.'"  value="22"/>
				<a id="popupKimCuongHotChu'.$idnumkimcuong.'" href="'.$path_url.'/popup/KimCuongHotChu.php?idshow='.$idnumkimcuong.'">
					<span id="showtennkimcuong'.$idnumkimcuong.'">Click chọn Tên</span>
				</a>
				<script type="text/javascript">
					$(document).ready(function() {
						$("#popupKimCuongHotChu'.$idnumkimcuong.'").fancybox();
					}); 
				</script>
				</td>
				<td align="left">
					<input type="text" autocomplete="off" name="codegdpnj[]" id="codegdpnj'.$idnumkimcuong.'" class="txtdatagirld"/>
				</td>
				<td align="left">
					<input type="text" autocomplete="off" name="codecgta[]" id="codecgta'.$idnumkimcuong.'" class="txtdatagirld"/>
				</td>
				<td align="left">
					<input type="text" autocomplete="off" name="kichthuoc[]" id="kichthuoc'.$idnumkimcuong.'" class="txtdatagirld"/>
				</td>
				<td align="left">
					<input type="text" autocomplete="off" name="trongluonghot[]" id="trongluonghot'.$idnumkimcuong.'" class="txtdatagirld"/>
				</td>
				<td align="left">
					<input type="text" autocomplete="off" name="dotinhkhiet[]" id="dotinhkhiet'.$idnumkimcuong.'" class="txtdatagirld"/>
				</td>
				<td align="left">
					<input type="text" autocomplete="off" name="capdomau[]" id="capdomau'.$idnumkimcuong.'" class="txtdatagirld"/>
				</td>
				<td align="left">
					<input type="text" autocomplete="off" name="domaibong[]" id="domaibong'.$idnumkimcuong.'" class="txtdatagirld"/>
				</td>
				<td align="left">
					<input type="text" autocomplete="off" name="kichthuocban[]" id="kichthuocban'.$idnumkimcuong.'" class="txtdatagirld"/>
				</td>
				<td align="left">
					<input type="text" autocomplete="off" name="tienmatkimcuong[]" id="tienmatkimcuong'.$idnumkimcuong.'" class="txtdatagirld"/>
				</td>
				<td align="left">
					<input type="text" autocomplete="off" name="dongiaban[]" id="dongiaban'.$idnumkimcuong.'" class="txtdatagirld text-right autoNumeric"/>
				</td>	
				<script type="text/javascript" src="'.$path_url.'/js/autoNumeric.js"></script>
				<script>
				$(".autoNumeric").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 3});
				</script>
				<script type="text/javascript" src="'.$path_url.'/js/inputFocusKey.js"></script>
			</tr> 
		';
		$idnumkimcuong = $idnumkimcuong + 1;
		die(json_encode(array('status'=>$str, 'idnumkimcuong'=>$idnumkimcuong)));
	break;

	// M.Tân thêm ngày 20/07/2019
	case "dateGirldKhoVatTuPNK":
		$idnumvattu = ceil(trim($_POST['idnumvattu']));
		if($idnumvattu < 1)
			$idnumvattu = 1;

		$str = '
			<tr>
				<td align="left" style="text-align: center">
					<input type="hidden" name="idctnxvattu[]" />
					<input type="hidden" name="idmavattu[]" id="idmavattu'.$idnumvattu.'"/>
					'.$idnumvattu.'
				</td>

				<td align="left">
					<link rel="stylesheet" href="'.$path_url.'/fancybox/jquery.fancybox-1.3.1.css">
					<a id="popupLoadMaVatTu'.$idnumvattu.'" href="'.$path_url.'/popup/KhoVatTu.php?act=chonMaVatDung&numdong='.$idnumvattu.'">
						<span id="mavattu'.$idnumvattu.'" style="font-size: 14px"> 
							Click chọn mã vật tư
						</span>
					</a>
					<script type="text/javascript">
					   $(document).ready(function() {
						   $("#popupLoadMaVatTu'.$idnumvattu.'").fancybox();
						}); 
					</script>
				</td>

				<td align="left" id="tenvattu'.$idnumvattu.'">
				</td>
				
				<td align="left" id="nhom'.$idnumvattu.'">
				</td>

				<td align="left" id="donvitinh'.$idnumvattu.'">
				</td>

				<td align="left">
					<input type="text" autocomplete="off" name="soluong[]" id="soluong'.$idnumvattu.'" class="txtdatagirld text-right autoNumeric2" onblur="getSltong()"/>
				</td>       
			</tr>
			<script type="text/javascript" src="'.$path_url.'/js/autoNumeric.js"></script>
			<script>
			$(".autoNumeric2").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 2});
			</script>
		';
		$idnumvattu = $idnumvattu + 1;
		die(json_encode(array('status'=>$str, 'idnumvattu'=>$idnumvattu)));
	break;

	// M.Tân thêm ngày 30/07/2019
	case "dateGirldKhoVatTuPDN":
		$idnumvattu = ceil(trim($_POST['idnumvattu']));
		if($idnumvattu < 1)
			$idnumvattu = 1;

		$str = '
			<tr>
				<td align="left" style="text-align: center">
					<input type="hidden" name="idctnxvattu[]" />
					<input type="hidden" name="idmavattu[]" id="idmavattu'.$idnumvattu.'"/>
					'.$idnumvattu.'
				</td>

				<td align="left">
					<link rel="stylesheet" href="'.$path_url.'/fancybox/jquery.fancybox-1.3.1.css">
					<a id="popupLoadMaVatTu'.$idnumvattu.'" href="'.$path_url.'/popup/KhoVatTu.php?act=chonMaVatDung&numdong='.$idnumvattu.'">
						<span id="mavattu'.$idnumvattu.'" style="font-size: 14px"> 
							Click chọn mã vật tư
						</span>
					</a>
					<script type="text/javascript">
					   $(document).ready(function() {
						   $("#popupLoadMaVatTu'.$idnumvattu.'").fancybox();
						}); 
					</script>
				</td>

				<td align="left" id="tenvattu'.$idnumvattu.'">
				</td>
	
				<td align="left" id="donvitinh'.$idnumvattu.'">
				</td>

				<td align="left">
					<input type="text" autocomplete="off" name="soluongdenghi[]" id="soluongdenghi'.$idnumvattu.'" class="txtdatagirld text-right autoNumeric2" onblur="getSltong()"/>
				</td>     
				
				<td align="left">
					<input type="text" autocomplete="off" name="mucdichsudung[]" id="mucdichsudung'.$idnumvattu.'" class="txtdatagirld text-left"/>
				</td>
			</tr>
			<script type="text/javascript" src="'.$path_url.'/js/autoNumeric.js"></script>
			<script>
			$(".autoNumeric2").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 2});
			</script>
		';
		$idnumvattu = $idnumvattu + 1;
		die(json_encode(array('status'=>$str, 'idnumvattu'=>$idnumvattu)));
	break;

	// M.Tân thêm ngày 08/08/2019
	case "loadPhieuDeNghi":
	    $idphieulon = ceil(trim($_POST['idphieulon']));
		$typephongbanchuyen = ceil(trim($_POST['typephongbanchuyen']));
		$str = '';
		$header = '
			<tr class="trheader">
				<td class="tdcheck"></td>
				<td width="3%" align="center">
					<strong>STT</strong>
				</td> 
				
				<td width="14%" align="center">
					<strong>Mã Vật Tư</strong>
				</td>

				<td width="18%" align="center">
					<strong>Tên Vật Tư</strong>
				</td>
				
				<td width="15%" align="center">
					<strong>Đơn Vị Tính</strong>
				</td>

				<td width="11%" align="center">
					<strong>Số Lượng Xuất Kho</strong>
				</td>

				<td width="40%" align="center">
					<strong>Mục Đích Sử Dụng</strong>
				</td>
            </tr>
		';
		
		if($typephongbanchuyen <= 0) {
			$str = '';
		} else {
			if($idphieulon > 0){ // Kiểm tra xem có phiếu lớn chưa ($idphieulon > 0 tức là đã tồn tại phiếu lớn), nếu:

				// Đã tồn tại phiếu thì sẽ là trường hợp edit: Load tất cả các mã vật tư phòng đó đề nghị để chọn lại
				$sql = "SELECT * FROM $GLOBALS[db_sp].vattu_khoquanlyvattuct WHERE typephongbanchuyen=".$typephongbanchuyen." and trangthai=0 and (idctnx=0 or idctnx=".$idphieulon.")";
			} else {
				// Chưa tồn tại phiếu là trường hợp add: Chỉ load những vật tư mà chưa được chọn ở phiếu khác (dachon=0)
				$sql = "SELECT * FROM $GLOBALS[db_sp].vattu_khoquanlyvattuct WHERE typephongbanchuyen=".$typephongbanchuyen." and type=3 and dachon=0";
			}
			$rs = $GLOBALS['sp']->getAll($sql);
			// print_r($rs);
			// die($sql);
			$i = 1;
			foreach($rs as $item) {
				$sqlvattu = "SELECT mavattu, name_vn, donvitinh FROM $GLOBALS[db_sp].loaivattu WHERE id=".$item['idmavattu'];
				$rsvattu = $GLOBALS['sp']->getRow($sqlvattu);

				if($idphieulon > 0 && $item['idctnx'] ==  $idphieulon){
					$checked = 'checked';
				}
				else {
					$checked = '';
				}
				$str .= '
					<tr>
						<td>
							<input type="hidden" value="'.$item['phongbanchuyen'].'" name="phongbanchuyen[]">
							<input type="hidden" value="'.$item['idmavattu'].'"  id="idmavattu'.$item['id'].'">
							<input type="hidden" value="'.$item['soluongduyet'].'"  id="soluongduyet'.$item['id'].'">
							<input type="checkbox" '.$checked.' value="'.$item['id'].'" name="idchon[]" onclick="getCheckBoxVatTu('.$item['id'].')">
						</td>
						<td align="center">
							'.$i++.'
						</td>
								
						<td align="left">
							'.$rsvattu['mavattu'].'
						</td>
						
						<td align="left">
							'.$rsvattu['name_vn'].'
						</td>
						
						<td align="left">
							'.$rsvattu['donvitinh'].'
						</td>

						<td align="right">
							<input type="hidden" value="'.$item['soluongduyet'].'" id="soluongxuatkho'.$item['id'].'" > 
							'.number_format($item['soluongduyet'],2,".",",").'
						</td>
						
						<td>
							'.$item['mucdichsudung'].'
						</td>
                    </tr>
				';
			}
		}
		die(json_encode(array('status'=>$header.$str)));

	break;

	// M.Tân thêm ngày 19/08/2019
	case "dateGirldKhoVatTuPXK":
		$idnumvattu = ceil(trim($_POST['idnumvattu']));
		if($idnumvattu < 1)
			$idnumvattu = 1;

		$str = '
			<tr>
				<td align="left" style="text-align: center">
					<input type="hidden" name="idctnxvattu[]" />
					<input type="hidden" name="idmavattu[]" id="idmavattu'.$idnumvattu.'"/>
					'.$idnumvattu.'
				</td>

				<td align="left">
					<link rel="stylesheet" href="'.$path_url.'/fancybox/jquery.fancybox-1.3.1.css">
					<a id="popupLoadMaVatTu'.$idnumvattu.'" href="'.$path_url.'/popup/KhoVatTu.php?act=chonMaVatDung&numdong='.$idnumvattu.'">
						<span id="mavattu'.$idnumvattu.'" style="font-size: 14px"> 
							Click chọn mã vật tư
						</span>
					</a>
					<script type="text/javascript">
					   $(document).ready(function() {
						   $("#popupLoadMaVatTu'.$idnumvattu.'").fancybox();
						}); 
					</script>
				</td>

				<td align="left" id="tenvattu'.$idnumvattu.'">
				</td>
	
				<td align="left" id="donvitinh'.$idnumvattu.'">
				</td>

				<td align="left">
					<input type="text" autocomplete="off" name="soluong[]" id="soluong'.$idnumvattu.'" class="txtdatagirld text-right autoNumeric2" onblur="getSltong()"/>
				</td>     
				
				<td align="left">
					<input type="text" autocomplete="off" name="mucdichsudung[]" id="mucdichsudung'.$idnumvattu.'" class="txtdatagirld text-left"/>
				</td>
			</tr>
			<script type="text/javascript" src="'.$path_url.'/js/autoNumeric.js"></script>
			<script>
			$(".autoNumeric2").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 2});
			</script>
		';
		$idnumvattu = $idnumvattu + 1;
		die(json_encode(array('status'=>$str, 'idnumvattu'=>$idnumvattu)));
	break;

	// M.Tân thêm ngày 30/08/2019
	case "loadVatTuPhieuKiemKe":

		$tablekiemkect = striptags(trim($_POST['tablekiemkect']));
		$tablehachtoan = striptags(trim($_POST['tablehachtoan']));

		$idphieulon = ceil(trim($_POST['idphieulon']));
		$mavattu = striptags(trim($_POST['mavattu']));
		$maphieu = striptags(trim($_POST['maphieu']));
		// die('idphieulon: '.$idphieulon.' '.'mavattu: '.' '.$mavattu);

		$maxphieu = ceil(trim($_POST['maxphieu']));

		$str = '';

		if(!empty($tablekiemkect) && !empty($tablehachtoan)) {

			if($idphieulon > 0 && $mavattu != '') {

				// Lấy thông tin vật tư (vd: idmavattu) dựa trên mã vật tư người dùng nhập vào
				$sqlGetVatTu = "SELECT * FROM $GLOBALS[db_sp].loaivattu WHERE mavattu='".$mavattu."'";
				$rsGetVatTu = $GLOBALS['sp']->getRow($sqlGetVatTu);
				$countGetVatTu = ceil(count($rsGetVatTu['id']));
				// die($countGetVatTu);
				
				if($countGetVatTu > 0) {

					// Kiểm tra xem mã vật tư đó đã được kiểm kê chưa

					// $dateDauThang = date("Y").'-'.date("m").'-01';
					// $lastDay = date('t',strtotime('today'));
					// $dateCuoiThang = date("Y").'-'.date("m").'-'.$lastDay;
					$datenow = date("Y-m-d");

					$sqlCountVatTuKiemKe = "SELECT count(id) FROM $GLOBALS[db_sp].".$tablekiemkect."  WHERE idmavattu=".$rsGetVatTu['id']." AND dated = '".$datenow."'";
					$countVatTuKiemKe = ceil($GLOBALS['sp']->getOne($sqlCountVatTuKiemKe));
					// die($countVatTuKiemKe);

					if($countVatTuKiemKe == 0) { // = 0 là chưa kiểm kê vật tư đó
						
						 ////////////////Dung Transaction////////////////
						$GLOBALS["sp"]->BeginTrans();
						try {
							// Lấy số lượng tồn ở table số dư đầu kỳ (lúc kiểm kê bao giờ cũng lây số lượng tồn mới nhất)
							$sqlGetSoLuongTon = "SELECT soluongton FROM $GLOBALS[db_sp].".$tablehachtoan." WHERE idmavattu=".$rsGetVatTu['id']." ORDER BY dated desc limit 1";
							$rsGetSoLuongTon = $GLOBALS['sp']->getOne($sqlGetSoLuongTon);
							// die(gettype($rsGetSoLuongTon));

							// Kiểm tra xem nếu só lượng tồn của vật tư đó không có trong bảng sodudauky thì cho = 0 để hiển thị
							if (empty($rsGetSoLuongTon)) { 
								$rsGetSoLuongTon = 0;
							}
							
							// Insert phiếu chi tiết vào bảng kiểm kê chi tiết
							$arrct['idctnx'] = $idphieulon;
							
							$arrct['idmavattu'] = $rsGetVatTu['id'];

							$datedchungtu = explode('/', trim($_POST['datedchungtu']));
							$arrct['dated'] = $datedchungtu[2].'-'.$datedchungtu[1].'-'.$datedchungtu[0];
							$arrct['time'] = date('H:i:s');

							$arrct['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
							$arrct['type'] = 4; // = 4 là phiếu kiểm kê


							$arrct['soluongtonpm'] = $rsGetSoLuongTon;
							$arrct['maphieu'] = $maphieu;
							
							$arrct['phongban'] = ceil(trim($_POST['phongban']));
							$arrct['typephongban'] = ceil(trim($_POST['typephongban']));

							// Trả về id cùa phiếu chi tiết để sử dụng updateSLTonThucTe vào ngay phiếu đó
							$idphieuct = vaInsert($tablekiemkect, $arrct);

							$GLOBALS["sp"]->CommitTrans(); 
						}
						catch(Exception $e) {
							$GLOBALS["sp"]->RollbackTrans();
							$error = $errorTransetion;
						}

						// Hiển thị các dòng vật tư đã quét ra giao diện
						$counter  = $maxphieu + 1;
						$str .= '
							<tr>
								<td align="center">
									<input type="hidden" class="txtdatagirld" value="'.$idphieuct.'"/>
									<input type="hidden" class="txtdatagirld" value="'.$rsGetVatTu['id'].'"/>
									'.$counter.'
								</td>
										
								<td align="left">
									'.$mavattu.'
								</td>
								
								<td align="left">
									'.$rsGetVatTu['name_vn'].'
								</td>
								
								<td align="left">
									'.$rsGetVatTu['donvitinh'].'
								</td>

								<td align="right">
									<input type="text" readonly class="txtdatagirld text-right autoNumeric2" value="'.$rsGetSoLuongTon.'" id="soluongtonpm'.$counter.'" name="soluongtonpm[]" />
								</td>
									
								<td>
									<input type="text"class="txtdatagirld text-right autoNumeric2" id="soluongtontt'.$counter.'" name="soluongtontt[]" onchange="updateSoLuongKiemKe('.$counter.', '.$idphieuct.', this.value)" value="" />
								</td>

								<td>
									<input type="text" readonly class="txtdatagirld text-right autoNumeric2" id="chenhlechnhap'.$counter.'" name="chenhlechnhap[]"/>
								</td>

								<td>
									<input type="text" readonly class="txtdatagirld text-right autoNumeric2" id="chenhlechxuat'.$counter.'" name="chenhlechxuat[]" />
								</td>
							</tr>
							<script type="text/javascript" src="'.$path_url.'/js/autoNumeric.js"></script>
							<script>
								$(".autoNumeric2").autoNumeric("init", {aSep: ",", aDec: ".", mDec: 2});
							</script>
						';
											
						$error = 'success';

					} else { // > 0 là vật tư đó đã kiểm kê rồi
						$error = "Mã vật tư này đã được kiểm kê rồi, vui lòng kiểm tra lại";
					}
					
				} else {
                    $error = "Vui lòng nhập vào đúng mã vật tư";
                }
			}
		} else {
			$error = 'Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.';	
		}

		die(json_encode(array('status'=>$error,'html'=>$str)));
	break;
	/////////////////////////VŨ THÊM LOAD DÒNG THEO PHÒNG BAN CỦA XUẤT KHO KHO BỘT 15-10-2019/////////////////////////////////
	case"KhoKhacKhoBotLoadPhong":
		$idPhongNo = ceil(trim($_POST['idPhongNo']));
		$idPhongYes = ceil(trim($_POST['idPhongYes']));
		$strPBC = "phongbanchuyen=".$idPhongNo." and";
		if($idPhongNo == 0){
			$strPBC = "";
			}	
		//khác -1 là Edit			
		if($idPhongYes != -1){
			$sql = "SELECT * 
					FROM $GLOBALS[db_sp].bot_khobot
					WHERE type = 1 and typechuyen = 2 and ( idchonphieunhap =".$idPhongYes." or ".$strPBC." typechon = 0 ) 
					ORDER BY typechon DESC, id DESC ";
			}
		//=-i là Add
		else{
			$sql = "SELECT * 
					FROM $GLOBALS[db_sp].bot_khobot
					WHERE ".$strPBC." type=1 and typechuyen=2 and typechon=0 and typevkc = 1
					ORDER BY dated DESC, id DESC ";
			}
						
		$rowsSqlPB = $GLOBALS["sp"]->getAll($sql);
		$str = "";
		$str .= '
				<table width="100%" border="1" >
					<tr class="trheader">
                            <td  align="center">
                                <strong>STT</strong>
                            </td> 
                            
                            <td  align="center">
                                <strong>Chọn </strong>
                            </td>
                            <td align="center">
                                <strong>Mã phiếu</strong>
                            </td>
                            
                            <td  align="center">
                                <strong>Loại vàng</strong>
                            </td>
                            <td align="center">
                                <strong>Cân nặng V+H</strong>
                            </td>
                            <td align="center">
                                <strong>Cân nặng H</strong>
                            </td>
                            <td  align="center">
                                <strong>Cân nặng V</strong>
                            </td> 
                            <td  align="center">
                                <strong>Q10</strong>
                            </td>                           
                            <td  align="center">
                                <strong>Ghi chú</strong>
                            </td>
                        </tr> ';  
		$i = 1;
		$tongQ10 = 0;		
		foreach($rowsSqlPB as $vlRowsPB){
			$tongQ10 = getTongQ10($vlRowsPB['cannangv'],$vlRowsPB['idloaivang']);
			$checked = "";
			if($vlRowsPB["idchonphieunhap"] == $idPhongYes){
				$checked = "checked";
				}
			$str .= '            		
                     	<tr class="colorRowCheked" >
                            <td align="center"> 
								 '.$i.'                          	
                            </td>
                            <td align="center">
                            	<input type="checkbox" name="chonMP[]" value="'.$vlRowsPB['id'].'" onclick="getCheckBoxMP()" '.$checked.'/>
                            </td>
                            <td align="left">     
								  '.$vlRowsPB['maphieu'].'                     	
                            </td>
                            <td class="text-right"> 
								'.getName('loaivang', 'name_vn', $vlRowsPB['idloaivang']).'                           	
                            </td>
                            <td class="text-right autoNumeric">  
							     '.number_format($vlRowsPB["cannangvh"],3,".",",").'                             		 
                            </td>
                            <td class="text-right autoNumeric">  
								'.number_format($vlRowsPB["cannangh"],3,".",",").'                               
                            </td>
                            <td class="text-right">    
								'.number_format($vlRowsPB["cannangv"],3,".",",").'                             
                                <input type="hidden" id="canangv'.$vlRowsPB['id'].'" value="'.number_format($vlRowsPB["cannangv"],3,".",",").'"  />
                            </td>
                            <td class="text-right">  
								'.number_format($tongQ10,3,".",",").'                          	
                                <input type="hidden" id="q10PN'.$vlRowsPB["id"].'" value="'.number_format($tongQ10,3,".",",").'" />
                            </td>
                            <td>       
								'.$vlRowsPB["ghichuvang"].'                  		
                        	</td>      
                        </tr>
					';
			$i++;
			}
		$str .= '</table>';
		die(json_encode(array('status'=>$str, 'sql'=>$sql.'==>'.$idPhongNo)));
	break;
	////////////////////////KẾT THÚC VŨ THÊM/////////////////////////////////

}

?>