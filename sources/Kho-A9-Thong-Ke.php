<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);
/////////load danh mục kho anh 9
$nhomdanhmuc = getTableRow('categories',' and id=70 and active=1');
$smarty->assign("nhomdanhmuc",$nhomdanhmuc);

$nhomnguyenlieu = getTableAll('categories',' and pid='.$nhomdanhmuc['id'].' and active=1 ');
$smarty->assign("nhomnguyenlieu",$nhomnguyenlieu);

$sqlvang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
$rsvang = $GLOBALS["sp"]->getAll($sqlvang);
$smarty->assign("typegold",$rsvang);

if(checkPermision($idpem,7))
	$smarty->assign("checkPer7","true");
switch($act){	
	case "SuaSoLieuHachToan":
		// Sửa số liệu hạch toán kim cương
		//dieuChinhSoLieuHachToanKimCuongKhoNguonVao('khonguonvao_khoachinct', 'khoachin_sodudauky');
		// Sửa số liệu hạch toán
		$rsGetLoaiVang = loaiVangSuaSoLieuHachToan();
		
		foreach ($rsGetLoaiVang as $itemLoaiVang) {
			dieuChinhSoLieuHachToanKhoNguonVao('khonguonvao_khoachinct','khoachin_sodudauky',$itemLoaiVang['id']);
		}
		die("Điều chỉnh số liệu hạch toán thành công.");
	break;
	case "NhapXuatKho":
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			if($_COOKIE["typeVangKimCuong"] == 'kimcuong'){
				include_once("search/KhoNguonVaoThongKeNhapKimCuongSearch.php");
				$template = "Kho-A9-Thong-Ke/nhap-xuat-kho-kimcuong.tpl";
				if(!empty($fromDate) && !empty($toDate)){
					$smarty->assign("showlist",1);	
					$wh.=' and typevkc = 2 ';
					
					$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where 
								`type`=2 and
								and dated >= '".$fromDate."' and dated <= '".$toDate."'
								$wh
							order by numphieu asc, dated asc, dated asc
					";
		
					$sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where 
									`type`=2 
									and dated >= '".$fromDate."' and dated <= '".$toDate."'
									$wh
					";
					
					$sql_tongnhap = "select ROUND(count(id), 3) as tongsoluong, 
										ROUND(SUM(dongiaban), 3) as tongdongia 
										from $GLOBALS[db_sp].khonguonvao_khoachinct 
										where `type`=2 
										and dated >= '".$fromDate."' and dated <= '".$toDate."'
										$wh
								";
					
					$rstongnhap = $GLOBALS['sp']->getRow($sql_tongnhap);
					$smarty->assign("gettotalnhap",$rstongnhap);
					
					$sql_tongxuat = "select ROUND(count(id), 3) as tongsoluong, 
										ROUND(SUM(dongiaban), 3) as tongdongia 
										from $GLOBALS[db_sp].khonguonvao_khoachinct 
										where `type`=2 and trangthai=2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' 
										$wh
								";
					
					$rstongxuat = $GLOBALS['sp']->getRow($sql_tongxuat);
					$smarty->assign("gettotalxuat",$rstongxuat);
					
					$total = ceil($GLOBALS['sp']->getOne($sql_sum));
					
					$otionKimCuong = '';
					if($total > 0){
						$sql_lokc = "select idkimcuong from $GLOBALS[db_sp].khonguonvao_khoachinct where type=1 and dated >= '".$fromDate."' and dated <= '".$toDate."'  group by idkimcuong ";
						$rs_lokc = $GLOBALS['sp']->getCol($sql_lokc);
						$otionKimCuong = implode(',',$rs_lokc);
					}
					$smarty->assign("otionKimCuong",$otionKimCuong);
					$num_rows_page = 100;//$numPageAll;
					$num_page = ceil($total/$num_rows_page);
					$begin = ($page - 1)*$num_rows_page;
					$url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
				}
			}
			else{
				include_once("search/KhoNguonVaoThongKeNhapVangSearch.php");
				$template = "Kho-A9-Thong-Ke/nhap-xuat-kho-vang.tpl";
				if(!empty($fromDate) && !empty($toDate)){
					$smarty->assign("showlist",1);	
					$wh.=' and typevkc = 1 ';
					$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where `type`=2  
								and dated >= '".$fromDate."' 
								and dated <= '".$toDate."'
								$wh
							order by numphieu asc, dated asc, dated asc
					";
	
					$sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where `type`=2 
									and dated >= '".$fromDate."' 
									and dated <= '".$toDate."'
									$wh
									
					";
					$sql_tongnhap = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv, 
										ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du  
										from $GLOBALS[db_sp].khonguonvao_khoachinct where `type`=2 
										and dated >= '".$fromDate."' 
										and dated <= '".$toDate."'
										$wh
								";

					$rstongnhap = $GLOBALS['sp']->getRow($sql_tongnhap);
					$smarty->assign("gettotalnhap",$rstongnhap);
					
					$sql_tongxuat = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv, 
										ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du  
										from $GLOBALS[db_sp].khonguonvao_khoachinct 
										where `type`=2 and trangthai=2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' 
										$wh
								";

					$rstongxuat = $GLOBALS['sp']->getRow($sql_tongxuat);
					$smarty->assign("gettotalxuat",$rstongxuat);
					
					$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
					
					$num_rows_page = 100;//$numPageAll;
					$num_page = ceil($total/$num_rows_page);
					$begin = ($page - 1)*$num_rows_page;
					$url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
				}
			}
		}
	break;
	
	case "NhapKho":
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			$smarty->assign("checkNhapXuat",1);
			if($_COOKIE["typeVangKimCuong"] == 'kimcuong'){
				include_once("search/KhoNguonVaoThongKeNhapKimCuongSearch.php");
				$template = "Kho-A9-Thong-Ke/nhap-kho-kimcuong.tpl";
				if(!empty($fromDate) && !empty($toDate)){
					$smarty->assign("showlist",1);	
					$wh.=' and typevkc = 2 ';
					/*code tam 
					$sql = "select *, count(idkimcuong) as soluong from $GLOBALS[db_sp].khonguonvao_khoachinct where type=1 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh group by idkimcuong order by numphieu asc, dated asc";
					 code tam 
					$sql_sum = "  select count(a.sl) from (
									select count(id) as sl from ngocthamqlsx.khonguonvao_khoachinct where 
										type=1 $wh
										group by idkimcuong
									) as a 
					";
					$total = ceil($GLOBALS['sp']->getOne($sql_sum));
					*/
					$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh order by numphieu asc, dated asc";
					
					$sql_sum = "  select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh";
					
					$sql_tong = "select ROUND(count(id), 3) as tongsoluong, 
										ROUND(SUM(dongiaban), 3) as tongdongia 
										from $GLOBALS[db_sp].khonguonvao_khoachinct 
										where type=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh
								";
					
					$rstong = $GLOBALS['sp']->getRow($sql_tong);
					$smarty->assign("gettotal",$rstong);
					$total = ceil($GLOBALS['sp']->getOne($sql_sum));
										
					$otionKimCuong = '';
					if($total > 0){
						$sql_lokc = "select idkimcuong from $GLOBALS[db_sp].khonguonvao_khoachinct where type=1 and dated >= '".$fromDate."' and dated <= '".$toDate."'  group by idkimcuong ";
						$rs_lokc = $GLOBALS['sp']->getCol($sql_lokc);
						$otionKimCuong = implode(',',$rs_lokc);
					}
					$smarty->assign("otionKimCuong",$otionKimCuong);
					$num_rows_page = 100;//$numPageAll;
					$num_page = ceil($total/$num_rows_page);
					$begin = ($page - 1)*$num_rows_page;
					$url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
				}
			}
			else{
				include_once("search/KhoNguonVaoThongKeNhapVangSearch.php");
				$template = "Kho-A9-Thong-Ke/nhap-kho-vang.tpl";
				
				if(!empty($fromDate) && !empty($toDate)){
					$smarty->assign("showlist",1);	
					$wh.=' and typevkc = 1 ';
					$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh order by numphieu asc, dated asc";
					$sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh";
					
					$sql_tong = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv, 
										ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du  
										from $GLOBALS[db_sp].khonguonvao_khoachinct 
										where type=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh
								";

					$rstong = $GLOBALS['sp']->getRow($sql_tong);
					$smarty->assign("gettotal",$rstong);
					
					$sql_tongloaivang = "select idloaivang, ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv, 
										ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du  
										from $GLOBALS[db_sp].khonguonvao_khoachinct 
										where type=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' 
										$wh
										group by idloaivang
										order by idloaivang asc
								";
					$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);
					$smarty->assign("totalLoaivang",$rstongloaivang);
					
					$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
					$num_rows_page = 100;//$numPageAll;
					$num_page = ceil($total/$num_rows_page);
					$begin = ($page - 1)*$num_rows_page;
					$url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
				}
			}
		}
	break;
	
	case "XuatKho":
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			if($_COOKIE["typeVangKimCuong"] == 'kimcuong'){
				include_once("search/KhoNguonVaoThongKeNhapKimCuongSearch.php");
				$template = "Kho-A9-Thong-Ke/nhap-kho-kimcuong.tpl";
				if(!empty($fromDate) && !empty($toDate)){
					$smarty->assign("showlist",1);	
					$wh.=' and typevkc = 2 ';
					/* code tam 
					$sql = "select *, count(idkimcuong) as soluong from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and trangthai=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh group by idkimcuong order by numphieu asc, dated asc";
					
					$sql_sum = "  select count(a.sl) from (
									select count(id) as sl from $GLOBALS[db_sp].khonguonvao_khoachinct where 
										type=2 and trangthai=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh
										group by idkimcuong
									) as a 
					";
					*/
					$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and trangthai=2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh order by numphieu asc, dated asc";
					$sql_sum = " select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and trangthai=2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh";
					$sql_tong = "select ROUND(count(id), 3) as tongsoluong, 
										ROUND(SUM(dongiaban), 3) as tongdongia 
										from $GLOBALS[db_sp].khonguonvao_khoachinct 
										where type=2 and trangthai=2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh
								";
					
					$rstong = $GLOBALS['sp']->getRow($sql_tong);
					$smarty->assign("gettotal",$rstong);
					
					$total = ceil($GLOBALS['sp']->getOne($sql_sum));
					
					$otionKimCuong = '';
					if($total > 0){
						$sql_lokc = "select idkimcuong from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and trangthai=2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."'  group by idkimcuong ";
						$rs_lokc = $GLOBALS['sp']->getCol($sql_lokc);
						$otionKimCuong = implode(',',$rs_lokc);
					}
					$smarty->assign("otionKimCuong",$otionKimCuong);
					$num_rows_page = 100;//$numPageAll;
					$num_page = ceil($total/$num_rows_page);
					$begin = ($page - 1)*$num_rows_page;
					$url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
				}
			}
			else{
				include_once("search/KhoNguonVaoThongKeNhapVangSearch.php");
				$template = "Kho-A9-Thong-Ke/nhap-kho-vang.tpl";
				if(!empty($fromDate) && !empty($toDate)){
					$smarty->assign("showlist",1);	
					$wh.=' and typevkc = 1 ';
					$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and trangthai=2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh order by numphieu asc, dated asc";
					$sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where type=2 and trangthai=2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh";

					$sql_tong = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv, 
										ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du  
										from $GLOBALS[db_sp].khonguonvao_khoachinct 
										where type=2 and trangthai=2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh
								";

					$rstong = $GLOBALS['sp']->getRow($sql_tong);
					$smarty->assign("gettotal",$rstong);
					
					$sql_tongloaivang = "select idloaivang, ROUND(SUM(cannangvh), 3) as cannangvh, 
										ROUND(SUM(cannangh), 3) as cannangh, 
										ROUND(SUM(cannangv), 3) as cannangv, 
										ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du  
										from $GLOBALS[db_sp].khonguonvao_khoachinct 
										where type=2 and trangthai=2 and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' 
										$wh
										group by idloaivang
										order by idloaivang asc
								";
					$rstongloaivang = $GLOBALS['sp']->getAll($sql_tongloaivang);
					$smarty->assign("totalLoaivang",$rstongloaivang);
					
					$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
					$num_rows_page = 100;//$numPageAll;
					$num_page = ceil($total/$num_rows_page);
					$begin = ($page - 1)*$num_rows_page;
					$url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
				}
			}
		}
	break;
	
	case "ChoNhapKho":
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			$smarty->assign("checkNhapXuat",1);
			if($_COOKIE["typeVangKimCuong"] == 'kimcuong'){
				include_once("search/KhoNguonVaoThongKeNhapKimCuongSearch.php");
				$template = "Kho-A9-Thong-Ke/cho-nhap-kho-kimcuong.tpl";
				$smarty->assign("showlist",1);	
				$wh.=' and typevkc = 2 ';
				
				$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai=1 and datechuyen >= '".$fromDate."' and datechuyen <= '".$toDate."' $wh order by numphieu asc, dated asc";
				$sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai=1 and datechuyen >= '".$fromDate."' and datechuyen <= '".$toDate."' $wh";
				
				$total = ceil($GLOBALS['sp']->getOne($sql_sum));					
				$num_rows_page = $numPageAll;
				$num_page = ceil($total/$num_rows_page);
				$begin = ($page - 1)*$num_rows_page;
				$url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
			}
			else{
				include_once("search/KhoNguonVaoThongKeNhapVangSearch.php");
				$template = "Kho-A9-Thong-Ke/cho-nhap-kho-vang.tpl";
				
				$smarty->assign("showlist",1);
				if(!empty($fromDate)){
					$wh.=' and dated >= "'.$fromDate.'"  ';
				}
				if(!empty($toDate)){
					$wh.=' and dated <= "'.$toDate.'"  ';
				}
				$wh.=' and typevkc = 1 ';
				
				$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai=1 $wh order by numphieu asc, dated asc";
				$sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai=1 $wh";
									
				$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
				$num_rows_page = $numPageAll;
				$num_page = ceil($total/$num_rows_page);
				$begin = ($page - 1)*$num_rows_page;
				$url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
			}
		}
	break;
	
	case "ChiTietTon":
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			if($_COOKIE["typeVangKimCuong"] == 'kimcuong'){
				include_once("search/KhoNguonVaoThongKeNhapKimCuongSearch.php");
				$template = "Kho-A9-Thong-Ke/chi-tiet-ton-kho-kimcuong.tpl";	
				$wh.=' and typevkc = 2 ';
				$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct 
						where type=2 
						and trangthai<>2
						$wh 
						order by numphieu asc, dated asc
				";
				$sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct 
							where type=2 
							and trangthai<>2
							$wh
				";
				$sql_tong = "select ROUND(count(id), 3) as tongsoluong, 
						ROUND(SUM(dongiaban), 3) as tongdongia 
						from $GLOBALS[db_sp].khonguonvao_khoachinct 
						where type=2 
						and trangthai<>2
						$wh
				";
				
				$rstong = $GLOBALS['sp']->getRow($sql_tong);
				$smarty->assign("gettotal",$rstong);
				
				$total = ceil($GLOBALS['sp']->getOne($sql_sum));
				$otionKimCuong = '';
				if($total > 0){
					$sql_lokc = "select idkimcuong from $GLOBALS[db_sp].khonguonvao_khoachinct where type=1 and dated >= '".$fromDate."' and dated <= '".$toDate."'  group by idkimcuong ";
					$rs_lokc = $GLOBALS['sp']->getCol($sql_lokc);
					$otionKimCuong = implode(',',$rs_lokc);
				}
				$smarty->assign("otionKimCuong",$otionKimCuong);
				$num_rows_page = 100;//$numPageAll;
				$num_page = ceil($total/$num_rows_page);
				$begin = ($page - 1)*$num_rows_page;
				$url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
				$link_url = "";
				if($num_page > 1 )
					$link_url = paginator($num_page,$page,$iSEGSIZE,$url,''.$strSearch);
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
			}
			else{
				include_once("search/KhoNguonVaoThongKeNhapVangSearch.php");
				$template = "Kho-A9-Thong-Ke/nhap-kho-vang.tpl";
				
				$smarty->assign("showlist",1);
				if(!empty($fromDate)){
					$wh.=' and dated >= "'.$fromDate.'"  ';
				}
				if(!empty($toDate)){
					$wh.=' and dated <= "'.$toDate.'"  ';
				}
				$wh.=' and typevkc = 1 ';
				$sql = "select * from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai<>2 and type=2 $wh order by numphieu asc, dated asc";
				$sql_sum = "select count(id) from $GLOBALS[db_sp].khonguonvao_khoachinct where trangthai<>2 and type=2 $wh";
				
				$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
				$num_rows_page = 100;//$numPageAll;
				$num_page = ceil($total/$num_rows_page);
				$begin = ($page - 1)*$num_rows_page;
				$url = $path_url."/sources/Kho-A9-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
				$template = "Kho-A9-Thong-Ke/chi-tiet-ton-kho-vang.tpl";
			}
		}
	break;
	
	default:
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{ 
			$smarty->assign("showlist",1);
			if($_COOKIE["typeVangKimCuong"] == 'kimcuong'){
				include_once("search/KhoNguonVaoTonKho.php");
				$wh.=' and typevkc = 2 ';
				$template = "Kho-A9-Thong-Ke/tonkimcuong.tpl";
				//////////load số dư đầu kỳ
				$thangtruoc = strtotime(date("Y-m-d", strtotime($fromDateDauthang)) . " -1 month");
				$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);

				$sqlsddk = "select * from $GLOBALS[db_sp].khoachin_sodudauky where dated='".$thangtruoc."' $wh limit 1";
				$rsddk = $GLOBALS['sp']->getRow($sqlsddk);	
				
				$sltonkimcuongdk = $rsddk['sltonkimcuong'];
				$tongdongiadk = $rsddk['tongdongia'];

				////////lấy số dư đầu kỳ trong tháng lớn hơn ngày 1
				if(strtotime($fromDateDauthang) != strtotime($fromDate)){
					
					//////////////nhập kho
					$sqlctnk = "select COUNT(id) as soluongnhap,  
									   ROUND(SUM(dongiaban), 3) as dongiaban
							  from $GLOBALS[db_sp].khonguonvao_khoachinct   
							  where type=2
							  and dated >= '".$fromDateDauthang."' 
							  and dated < '".$fromDate."' 
							  $wh
					";
					$rsctnk = $GLOBALS['sp']->getRow($sqlctnk);
					
					$soluongnhapnk = $rsctnk['soluongnhap'];
					$dongiabannk = $rsctnk['dongiaban'];
					//////////////Xuât kho
					$sqlctxk = "select COUNT(id) as soluongxuat, 
									   ROUND(SUM(dongiaban), 3) as dongiaban
							  from $GLOBALS[db_sp].khonguonvao_khoachinct   
							  where type=2
							  and trangthai=2
							  and datedxuat >= '".$fromDateDauthang."' 
							  and datedxuat < '".$fromDate."' 
							  $wh
					";
					$rsctxk = $GLOBALS['sp']->getRow($sqlctxk);
					
					$soluongxuatxk = $rsctxk['soluongxuat'];
					$dongiabanxk = $rsctxk['dongiaban'];
					/////////
					$sltonhdk = ($sltonhdk - $soluongxuatxk) + $soluongnhapnk;
					$tongdongiadk = ($tongdongiadk - $dongiabanxk) + $dongiabannk;
				}
				//die('xxx:'.$soluongnhapnk);
				$smarty->assign("sltondaungay",$sltonhdk);
				$smarty->assign("dongiadaungay",$tongdongiadk);
				
				///////////////show tông số lượng nhập và xuất từ ngày đến ngày
				
				//////////////nhập kho
					$sqlnk = "select COUNT(id) as soluongnhap, 
									 ROUND(SUM(dongiaban), 3) as dongiaban 
							  from $GLOBALS[db_sp].khonguonvao_khoachinct   
							  where type=2
							  and dated >= '".$fromDate."' 
							  and dated <= '".$toDate."' 
							  $wh
					";
					$rsnk = $GLOBALS['sp']->getRow($sqlnk);
					
					$soluongnhapnkcn = $rsnk['soluongnhap'];
					$dongiabannkcn = $rsnk['dongiaban'];
					
					$smarty->assign("slnhapcuoingay",$soluongnhapnkcn);
					$smarty->assign("dongianhapcuoingay",$dongiabannkcn);
					//////////////Xuât kho
					
					$sqlxk = "select COUNT(id) as soluongxuat, 
									   ROUND(SUM(dongiaban), 3) as dongiaban
							  from $GLOBALS[db_sp].khonguonvao_khoachinct   
							  where type=2
							  and trangthai=2
							  and datedxuat >= '".$fromDate."' 
							  and datedxuat <= '".$toDate."' 
							  $wh
					";
					$rsxk = $GLOBALS['sp']->getRow($sqlxk);
					
					$soluongxuatxkcn = $rsxk['soluongxuat'];
					$dongiabanxkcn = $rsxk['dongiaban'];
											
					$smarty->assign("slxuatcuoingay",$soluongxuatxkcn);
					$smarty->assign("dongiaxuatcuoingay",$dongiabanxkcn);
					
					///////// tổng tồn
					$sltontong = ($sltonhdk + $soluongnhapnkcn) - $soluongxuatxkcn;
					$tongdongia = ($tongdongiadk + $dongiabannkcn) - $dongiabanxkcn;
					
					$smarty->assign("sltontong",$sltontong);
					$smarty->assign("tongdongia",$tongdongia);
					
					/////////////////////////////////////////
			}
			else{
				include_once("search/KhoSanXuatThongKeTonKho.php");
				//////////load số dư đầu kỳ
				$wh = '';
				if(ceil($loaivangs) > 0)
					$wh = " and id = ".$loaivangs." ";
				$sqlvang1 = "select * from $GLOBALS[db_sp].loaivang where active=1 $wh order by num asc, id asc"; 
				$rsvang1 = $GLOBALS["sp"]->getAll($sqlvang1);
				$smarty->assign("typegoldview",$rsvang1);	
				
				$template = "Kho-A9-Thong-Ke/tonvang.tpl";
			}
		}
	break;
}
$smarty->assign("fromdayCheck",$fromDate);
$smarty->assign("todaycheck",$toDate);
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>