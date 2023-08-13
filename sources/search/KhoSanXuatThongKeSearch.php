<?php
$wh = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));
if($act != 'TonKhoDonHangCT' && $act != 'TonKhoDonHangTong'){
	if(empty($fromDate)){ /// nếu chưa chọn ngày lấy ngày hiện tại
		$fromDate = date("d/m/Y");
	}
	if(empty($toDate)){ /// nếu chưa chọn ngày lấy ngày hiện tại
		$toDate = date("d/m/Y");
	}
}
$codes = trim(striptags($_GET['codes']));
$idpnks = trim(striptags($_GET['idpnks']));
$loaivangs = trim(striptags($_GET['loaivangs']));
$idloaivang = trim(striptags($_GET['idloaivang']));
$cannangvhs = trim(striptags($_GET['cannangvhs']));
$cannanghs = trim(striptags($_GET['cannanghs']));
$cannangvs = trim(striptags($_GET['cannangvs']));
$tuoivangs = trim(striptags($_GET['tuoivangs']));

$phongchuyens = trim(striptags($_GET['phongchuyens']));
$phongsxs = trim(striptags($_GET['phongsxs']));
$madhsxs = trim(striptags($_GET['madhsxs']));
$ghichus = trim(striptags($_GET['ghichus']));
$tlq10s = trim(striptags($_GET['tlq10s']));
$tlq10gcs = trim(striptags($_GET['tlq10gcs']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);

$smarty->assign("codes",$codes);
$smarty->assign("idpnks",$idpnks);
$smarty->assign("loaivangs",$loaivangs);
$smarty->assign("idloaivangs",$idloaivang);
$smarty->assign("cannangvhs",$cannangvhs);
$smarty->assign("cannanghs",$cannanghs);
$smarty->assign("cannangvs",$cannangvs);
$smarty->assign("tuoivangs",$tuoivangs);

$smarty->assign("phongchuyens",$phongchuyens);
$smarty->assign("phongsxs",$phongsxs);
$smarty->assign("madhsxs",$madhsxs);
$smarty->assign("ghichus",$ghichus);
$smarty->assign("tlq10s",$tlq10s);
$smarty->assign("tlq10gcs",$tlq10gcs);

if(!empty($fromDate)){
	$strSearch .= '&fromdays='.$fromDate;
	$fromDate = explode('/',$fromDate);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
}
if(!empty($toDate)){
	$strSearch .= '&todays='.$toDate;				
	$toDate = explode('/',$toDate);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
}

if(!empty($codes)){
	$strSearch .= '&codes='.$codes;
	$wh.=' and maphieu like "%'.$codes.'%" ';
}

if(!empty($idpnks)){
	$strSearch .= '&idpnks='.$idpnks;
	$wh.=' and idpnk in ( select id from '.$GLOBALS['db_sp'].'.khosanxuat_khothanhpham where maphieu like "%'.$idpnks.'%" ) ';
}

if(!empty($loaivangs)){
	$strSearch .= '&loaivangs='.$loaivangs;
	$wh.=' and idloaivang = '.$loaivangs.' ';
}
if(!empty($idloaivang)){
	$strSearch .= '&idloaivang='.$idloaivang;
	$wh.=' and idloaivang =  '.$idloaivang.' ';
}
if(!empty($cannangvhs)){
	$strSearch .= '&cannangvhs='.$cannangvhs;
	$wh.=' and cannangvh  like "%'.$cannangvhs.'%" ';
}
if(!empty($cannanghs)){
	$strSearch .= '&cannanghs='.$cannanghs;
	$wh.=' and cannangh  like "%'.$cannanghs.'%" ';
}
if(!empty($cannangvs)){
	$strSearch .= '&cannangvs='.$cannangvs;
	$wh.=' and cannangv  like "%'.$cannangvs.'%" ';
}
if(!empty($tuoivangs)){
	$strSearch .= '&tuoivangs='.$tuoivangs;
	$wh.=' and tuoivang  like "%'.$tuoivangs.'%" ';
}

if(!empty($phongchuyens)){
	$strSearch .= '&phongchuyens='.$phongchuyens;
	$wh.=' and typekhodau  like "%'.$phongchuyens.'%" ';
}
if(!empty($phongsxs)){
	$strSearch .= '&phongsxs='.$phongsxs;
	$wh.=' and chonphongbanin = '.$phongsxs.' ';
}

if(!empty($madhsxs)){
	$strSearch .= '&madhsxs='.$madhsxs;
	$sqlctl = "select id from $GLOBALS[db_catalog].ordersanxuat where code like '%".$madhsxs."%'  and huydh=0 order by id desc limit 100"; 
	$rsctl = $GLOBALS["catalog"]->getCol($sqlctl);
	$idmadhsx = "-1";
	if(ceil(count($rsctl)) > 0){
		$idmadhsx = implode(',',$rsctl);
	}
	$wh.=' and madhin in ('.$idmadhsx.') ';
}
if(!empty($ghichus)){
	$strSearch .= '&ghichus='.$ghichus;
	$wh.=' and ghichuvang  like "%'.$ghichus.'%" ';
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