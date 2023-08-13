<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$idpem = $_GET["cid"];
$smarty->assign("phongbanchuyen",$idpem);

$sqlvang = "select * from $GLOBALS[db_sp].loaivang where active=1 order by num asc, id asc"; 
$rsvang = $GLOBALS["sp"]->getAll($sqlvang);
$smarty->assign("typegold",$rsvang);

if(checkPermision($idpem,7))
	$smarty->assign("checkPer7","true");
switch($act){
	case "SuaSoLieuHachToan":
		// Sửa số liệu hạch toán
		$sqlGetLoaiVang = "select * from $GLOBALS[db_sp].loaivang where active=1"; 
		$rsGetLoaiVang = $GLOBALS["sp"]->getAll($sqlGetLoaiVang);

		foreach ($rsGetLoaiVang as $itemLoaiVang) {
			dieuChinhSoLieuHachToan('khosanxuat_khovmnt',$itemLoaiVang['id']);
		}
		echo "Điều chỉnh số liệu hạch toán thành công.";
	break;
	case "NhapKho":
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			include_once("search/KhoSanXuatThongKeSearch.php");
			$template = "KhoSanXuat-Kho-Vmnt-Thong-Ke/nhap-kho.tpl";	
			if(!empty($fromDate) && !empty($toDate)){
				$smarty->assign("showlist",1);
				$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where type=1 and typechuyen=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh order by numphieu asc, dated asc";
				$sql_sum = "select count(id) from $GLOBALS[db_sp].khosanxuat_khovmnt where type=1 and typechuyen=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh";
				
				$sql_tong = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
									ROUND(SUM(cannangh), 3) as cannangh, 
									ROUND(SUM(cannangv), 3) as cannangv
									from $GLOBALS[db_sp].khosanxuat_khovmnt 
									where type=1 and typechuyen=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' $wh
							";

				$rstong = $GLOBALS['sp']->getRow($sql_tong);
				$smarty->assign("gettotal",$rstong);
				
				$sql_tongloaivang = "select idloaivang, ROUND(SUM(cannangvh), 3) as cannangvh, 
									ROUND(SUM(cannangh), 3) as cannangh, 
									ROUND(SUM(cannangv), 3) as cannangv  
									from $GLOBALS[db_sp].khosanxuat_khovmnt 
									where type=1 and typechuyen=2 and dated >= '".$fromDate."' and dated <= '".$toDate."' 
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
				$url = $path_url."/sources/KhoSanXuat-Kho-Vmnt-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
	
	case "XuatKho":
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			$smarty->assign("xuatkho",1);
			include_once("search/KhoSanXuatThongKeSearch.php");
			$template = "KhoSanXuat-Kho-Vmnt-Thong-Ke/nhap-kho.tpl";
			if(!empty($fromDate) && !empty($toDate)){
				$smarty->assign("showlist",1);	
				$wh.=' and typevkc = 1 ';
				$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where type in(2,3) and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh order by numphieu asc, datedxuat asc";
				$sql_sum = "select count(id) from $GLOBALS[db_sp].khosanxuat_khovmnt where type in(2,3) and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh";

				$sql_tong = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
									ROUND(SUM(cannangh), 3) as cannangh, 
									ROUND(SUM(cannangv), 3) as cannangv, 
									ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du  
									from $GLOBALS[db_sp].khosanxuat_khovmnt 
									where type in(2,3) and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' $wh
							";

				$rstong = $GLOBALS['sp']->getRow($sql_tong);
				$smarty->assign("gettotal",$rstong);
				
				$sql_tongloaivang = "select idloaivang, ROUND(SUM(cannangvh), 3) as cannangvh, 
									ROUND(SUM(cannangh), 3) as cannangh, 
									ROUND(SUM(cannangv), 3) as cannangv, 
									ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du  
									from $GLOBALS[db_sp].khosanxuat_khovmnt 
									where type in(2,3) and datedxuat >= '".$fromDate."' and datedxuat <= '".$toDate."' 
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
				$url = $path_url."/sources/KhoSanXuat-Kho-Vmnt-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
	
	case "HaoDu":
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			include_once("search/KhoSanXuatThongKeSearch.php");
			$template = "KhoSanXuat-Kho-Vmnt-Thong-Ke/nhap-hao-du.tpl";	
			if(!empty($fromDate) && !empty($toDate)){
				$smarty->assign("showlist",1);
				$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnthaodu where  dated >= '".$fromDate."' and dated <= '".$toDate."' $wh order by numphieu asc, dated asc";
				$sql_sum = "select count(id) from $GLOBALS[db_sp].khosanxuat_khovmnthaodu where dated >= '".$fromDate."' and dated <= '".$toDate."' $wh";
				
				$sql_tong = "select ROUND(SUM(hao), 3) as hao, 
									ROUND(SUM(du), 3) as du,
									ROUND(SUM(haochenhlech), 3) as haochenhlech, 
									ROUND(SUM(duchenhlech), 3) as duchenhlech
									from $GLOBALS[db_sp].khosanxuat_khovmnthaodu 
									where dated >= '".$fromDate."' and dated <= '".$toDate."' $wh
							";

				$rstong = $GLOBALS['sp']->getRow($sql_tong);
				$smarty->assign("gettotal",$rstong);
				
				
				$total = $count = ceil($GLOBALS['sp']->getOne($sql_sum));
				$num_rows_page = 100;//$numPageAll;
				$num_page = ceil($total/$num_rows_page);
				$begin = ($page - 1)*$num_rows_page;
				$url = $path_url."/sources/KhoSanXuat-Kho-Vmnt-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
	
	case "ChoNhapKho":
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			include_once("search/KhoSanXuatThongKeSearchNoDated.php");
			
			if(!empty($fromDate)){
				$wh.=" and datechuyen >= '".$fromDate."' ";
			}
			if(!empty($toDate)){
				$wh.=" and datechuyen <= '".$toDate."' ";
			}
			$wh.=' and typevkc = 1 ';
			
			$sql = "select * from $GLOBALS[db_sp].khosanxuat_khovmnt where type=3 and trangthai=1 $wh order by numphieu asc, datedxuat asc";
			$sql_sum = "select count(id) from $GLOBALS[db_sp].khosanxuat_khovmnt where type=3 and trangthai=1 $wh";

			$sql_tong = "select ROUND(SUM(cannangvh), 3) as cannangvh, 
								ROUND(SUM(cannangh), 3) as cannangh, 
								ROUND(SUM(cannangv), 3) as cannangv, 
								ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du  
								from $GLOBALS[db_sp].khosanxuat_khovmnt 
								where type=3 and trangthai=1 $wh
						";

			$rstong = $GLOBALS['sp']->getRow($sql_tong);
			$smarty->assign("gettotal",$rstong);
			
			$sql_tongloaivang = "select idloaivang, ROUND(SUM(cannangvh), 3) as cannangvh, 
								ROUND(SUM(cannangh), 3) as cannangh, 
								ROUND(SUM(cannangv), 3) as cannangv, 
								ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du  
								from $GLOBALS[db_sp].khosanxuat_khovmnt 
								where type=3 
								and trangthai=1 
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
			$url = $path_url."/sources/KhoSanXuat-Kho-Vmnt-Thong-Ke.php?act=".$_GET['act']."&cid=".$_GET['cid'];
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
			
			$template = "KhoSanXuat-Kho-Vmnt-Thong-Ke/cho-nhap-kho.tpl";
		}
	break;
	
	case "TonKhoHienTai":
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			$sqlvang1 = "select * from $GLOBALS[db_sp].loaivang where active=1 $wh order by num asc, id asc"; 
			$rsvang1 = $GLOBALS["sp"]->getAll($sqlvang1);
			$smarty->assign("typegoldview",$rsvang1);
			
			$template = "KhoSanXuat-Kho-Vmnt-Thong-Ke/ton-kho-hien-tai.tpl";
		}
	break;
	default:
		if(!checkPermision($idpem,5)){
			page_permision();
			$page = $path_url ;
			page_transfer2($page);
		}
		else{
			include_once("search/KhoSanXuatThongKeTonKho.php");
			$wh = '';
			if(ceil($loaivangs) > 0)
				$wh = " and id = ".$loaivangs." ";
			$sqlvang1 = "select * from $GLOBALS[db_sp].loaivang where active=1 $wh order by num asc, id asc"; 
			$rsvang1 = $GLOBALS["sp"]->getAll($sqlvang1);
			$smarty->assign("typegoldview",$rsvang1);
			
			$template = "KhoSanXuat-Kho-Vmnt-Thong-Ke/ton-kho.tpl";
		}
	break;
}
$smarty->assign("fromdayCheck",$fromDate);
$smarty->assign("todaycheck",$toDate);
$smarty->display("header.tpl");
$smarty->display($template);
$smarty->display("footer.tpl");
?>