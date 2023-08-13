<?php
	$wh = $whdatechuyen = $strSearch = '';
	$fromDate = trim(striptags($_GET['fromdays']));
	$toDate = trim(striptags($_GET['todays']));
	$codes = trim(striptags($_GET['codes']));	
	$idpnks = trim(striptags($_GET['idpnks']));
	$daychungtus = trim(striptags($_GET['daychungtus']));	
	$nhomnguyenlieus = trim(striptags($_GET['nhomnguyenlieus']));
	$tennguyenlieus = trim(striptags($_GET['tennguyenlieus']));
	$loaivangs = trim(striptags($_GET['loaivangs']));
	$idloaivang = trim(striptags($_GET['idloaivang']));
	$cannangvhs = trim(striptags($_GET['cannangvhs']));
	$cannanghs = trim(striptags($_GET['cannanghs']));
	$cannangvs = trim(striptags($_GET['cannangvs']));
	$tuoivangs = trim(striptags($_GET['tuoivangs']));
	$tienmats = trim(striptags($_GET['tienmats']));
	$phongchuyens = trim(striptags($_GET['phongchuyens']));
	$madhsxs = trim(striptags($_GET['madhsxs']));
	$ghichus = trim(striptags($_GET['ghichus']));
	$maphieus = trim(striptags($_GET['maphieus']));

	$tlq10s = trim(striptags($_GET['tlq10s']));
	$tlq10gcs = trim(striptags($_GET['tlq10gcs']));
	//====Không chọn ngày nếu là Nghiệp Vụ và Thống Kê Chờ Nhập Kho=========//
	if($act != "" && $actCNK == 0 && $act != 'TonKhoDonHangTong' && $act != 'TonKhoDonHangCT'){
		if(empty($fromDate)){
			$fromDate = date("d/m/Y");
		}
		if(empty($toDate)){
			$toDate = date("d/m/Y");
		}
	}
	
	//============//
	$smarty->assign("fromdays",$fromDate);
	$smarty->assign("todays",$toDate);
	$smarty->assign("codes",$codes);	
	$smarty->assign("daychungtus",$daychungtus);	
	$smarty->assign("nhomnguyenlieus",$nhomnguyenlieus);
	$smarty->assign("tennguyenlieus",$tennguyenlieus);
	$smarty->assign("loaivangs",$loaivangs);
	$smarty->assign("idloaivang",$idloaivang);
	$smarty->assign("cannangvhs",$cannangvhs);
	$smarty->assign("cannanghs",$cannanghs);
	$smarty->assign("cannangvs",$cannangvs);
	$smarty->assign("tuoivangs",$tuoivangs);
	$smarty->assign("tienmats",$tienmats);
	$smarty->assign("phongchuyens",$phongchuyens);
	$smarty->assign("madhsxs",$madhsxs);
	$smarty->assign("ghichus",$ghichus);
	$smarty->assign("idpnks",$idpnks);
	$smarty->assign("maphieus",$maphieus);
	$smarty->assign("tlq10s",$tlq10s);
	$smarty->assign("tlq10gcs",$tlq10gcs);
	//=============//
	if(!empty($fromDate)){
		$strSearch .= '&fromdays='.$fromDate;
		$fromDate = explode('/',$fromDate);
		$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
		$wh.=' and dated >= "'.$fromDate.'" ';
		$whdatechuyen.=' and datedxuat >= "'.$fromDate.'" ';
		}
	//=============//
	if(!empty($toDate)){
		$strSearch .= '&todays='.$toDate;				
		$toDate = explode('/',$toDate);
		$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
		$wh.=' and dated <= "'.$toDate.'" ';
		$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
	//=============//
	if(!empty($daychungtus)){
		$strSearch .= '&daychungtus='.$daychungtus;
		$daychungtus = explode('/',$daychungtus);
		$daychungtus = $daychungtus[2].'-'.$daychungtus[1].'-'.$daychungtus[0];
		$wh.=' and dated = "'.$daychungtus.'" ';
		$whdatechuyen.=' and dated = "'.$daychungtus.'" ';
		}
	//=============//
	if(!empty($codes)){
		$strSearch .= '&codes='.$codes;
		$wh.=' and maphieu like "%'.$codes.'%" ';
		$whdatechuyen.=' and maphieu like "%'.$codes.'%" ';
		}
	//=============//
	if(!empty($nhomnguyenlieus)){
		$strSearch .= '&nhomnguyenlieus='.$nhomnguyenlieus;
		$wh.=' and nhomnguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$nhomnguyenlieus.'%" ) ';
		$whdatechuyen.=' and nhomnguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$nhomnguyenlieus.'%" ) ';
		}
	//=============//
	if(!empty($tennguyenlieus)){
		$strSearch .= '&tennguyenlieus='.$tennguyenlieus;
		$wh.=' and tennguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$tennguyenlieus.'%" ) ';
		$whdatechuyen.=' and tennguyenlieuvang in ( select id from '.$GLOBALS['db_sp'].'.categories where active=1 and name_vn like "%'.$tennguyenlieus.'%" ) ';
		}	
	//=============//
	if(!empty($loaivangs)){
		$strSearch .= '&idloaivang='.$loaivangs;
		$wh.=' and idloaivang ='.$loaivangs;
		$whdatechuyen.=' and idloaivang ='.$loaivangs;
		}
	//=============//
	if(!empty($idloaivang)){
		$strSearch .= '&idloaivang='.$idloaivang;
		$wh.=' and idloaivang ='.$idloaivang;
		$whdatechuyen.=' and idloaivang ='.$idloaivang;
		}
	//=============//
	if(!empty($cannangvhs)){
		$strSearch .= '&cannangvhs='.$cannangvhs;
		$wh.=' and cannangvh  like "%'.$cannangvhs.'%" ';
		$whdatechuyen.=' and cannangvh  like "%'.$cannangvhs.'%" ';
		}
	//=============//
	if(!empty($cannanghs)){
		$strSearch .= '&cannanghs='.$cannanghs;
		$wh.=' and cannangh  like "%'.$cannanghs.'%" ';
		$whdatechuyen.=' and cannangh  like "%'.$cannanghs.'%" ';
		}
	//=============//
	if(!empty($cannangvs)){
		$strSearch .= '&cannangvs='.$cannangvs;
		$wh.=' and cannangv  like "%'.$cannangvs.'%" ';
		$whdatechuyen.=' and cannangv  like "%'.$cannangvs.'%" ';
		}
	//=============//
	if(!empty($tuoivangs)){
		$strSearch .= '&tuoivangs='.$tuoivangs;
		$wh.=' and tuoivang  like "%'.$tuoivangs.'%" ';
		$whdatechuyen.=' and tuoivang  like "%'.$tuoivangs.'%" ';
		}
	//=============//
	if(!empty($tienmats)){
		$strSearch .= '&tienmats='.$tienmats;
		$wh.=' and tienmatvang  like "%'.$tienmats.'%" ';
		$whdatechuyen.=' and tienmatvang  like "%'.$tienmats.'%" ';
		}
	//=============//
	if(!empty($phongchuyens)){
		$strSearch .= '&phongchuyens='.$phongchuyens;
		$wh.=' and typekhodau  like "%'.$phongchuyens.'%" ';
		$whdatechuyen.=' and typekhodau  like "%'.$phongchuyens.'%" ';
		}
	//==============//
	if(!empty($madhsxs)){
		$strSearch .= '&madhsxs='.$madhsxs;
		$sqlctl = "select id from $GLOBALS[db_catalog].ordersanxuat where code like '%".$madhsxs."%'  and huydh=0 order by id desc limit 100"; 
		$rsctl = $GLOBALS["catalog"]->getCol($sqlctl);
		$idmadhsx = "-1";
		if(ceil(count($rsctl)) > 0){
			$idmadhsx = implode(',',$rsctl);
			}
		$wh.=' and madhin in ('.$idmadhsx.') ';
		$whdatechuyen.=' and madhin in ('.$idmadhsx.') ';
		}
	//=============//
	if(!empty($ghichus)){
		$strSearch .= '&ghichus='.$ghichus;
		$wh.=' and ghichuvang  like "%'.$ghichus.'%" ';
		$whdatechuyen.=' and ghichuvang  like "%'.$ghichus.'%" ';
		}
	//============//
	if(!empty($idpnks)){
		$strSearch = '&idpnks='.$idpnks;
		$wh.=' and idpnk in (select id from '.$GLOBALS[db_sp].'.'.$tbidpnks.' where maphieu like "%'.$idpnks.'%") ';
		$whdatechuyen.=' and idpnk in (select id from '.$GLOBALS[db_sp].'.'.$tbidpnks.' where maphieu like "%'.$idpnks.'%") ';
		}
	//==========//
	if(!empty($maphieus)){
		$strSearch .= '&maphieus='.$maphieus;
		$wh.=' and maphieu  like "%'.$maphieus.'%" ';
		}
	if(!empty($tlq10s)){
		$strSearch .= '&tlq10s='.$tlq10s;
		$wh.=' and ROUND(cannangv*tuoivang,3) like "%'.$tlq10s.'%" ';
	}
	if(!empty($tlq10gcs)){
		$strSearch .= '&tlq10gcs='.$tlq10gcs;
		$wh.=' and ROUND(cannangv*0.77,3) like "%'.$tlq10gcs.'%" ';
	}
?>