<?php
$wh = $strSearch = '';
$fromDate = trim(striptags($_REQUEST['fromdays']));
$toDate = trim(striptags($_REQUEST['todays'])); 
if($act != 'ChiTietTon'){
	if(empty($fromDate)){ /// nếu chưa chọn ngày lấy ngày hiện tại
		$fromDate = date("d/m/Y");
	}
	if(empty($toDate)){ /// nếu chưa chọn ngày lấy ngày hiện tại
		$toDate = date("d/m/Y");
	}
}
$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);
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
$maphieuimports = trim(striptags($_GET['maphieuimports']));
$midimports = trim(striptags($_GET['midimports']));
$cuahangs = trim(striptags($_GET['cuahangs']));
$noidens = trim(striptags($_GET['noidens']));
$datedxacnhans = trim(striptags($_GET['datedxacnhans']));
$sophieus = trim(striptags($_GET['sophieus']));
$ghichus = trim(striptags($_GET['ghichus']));
$loaivangs = trim(striptags($_GET['idloaivangs']));
$macus = trim(striptags($_GET['macus']));
$tens = trim(striptags($_GET['tens']));
$slmons = trim(striptags($_GET['slmons']));
$cannangvhs = trim(striptags($_GET['cannangvhs']));
$cannanghs = trim(striptags($_GET['cannanghs']));
$cannangvs = trim(striptags($_GET['cannangvs']));
$tienhs = trim(striptags($_GET['tienhs']));
$tiencongs = trim(striptags($_GET['tiencongs']));
$tiendangoctrais = trim(striptags($_GET['tiendangoctrais']));
$trangthaiduyets = trim(striptags($_GET['trangthaiduyets']));
$maphieus = trim(striptags($_GET['maphieus']));
$mids = trim(striptags($_GET['mids']));

StringSearch($maphieuimports, 'maphieuimport');
CategorySearch ($midimports, 'midimport', 'admin', 'fullname');
StringSearch($cuahangs, 'cuahang');
StringSearch($noidens, 'noiden');
DateSearch($datedxacnhans, 'datedxacnhan');
StringSearch($sophieus, 'sophieu');
StringSearch($ghichus, 'ghichu');
CategorySearch ($loaivangs, 'idloaivang', 'loaivang', 'name_vn');
StringSearch($macus, 'macu');
StringSearch($tens, 'ten');
NumberSearch($slmons, 'slmon');
NumberSearch($cannangvhs, 'cannangvh');
NumberSearch($cannanghs, 'cannangh');
NumberSearch($cannangvs, 'cannangv');
NumberSearch($tienhs, 'tienh');
NumberSearch($tiencongs, 'tiencong');
NumberSearch($tiendangoctrais, 'tiendangoctrai');
NumberSearch($trangthaiduyets, 'type');
StringSearch($maphieus, 'maphieu');
CategorySearch($mids, 'mid', 'admin', 'fullname');

function StringSearch ($keyWorkSearch, $colSearch) {
    global $wh, $strSearch, $smarty;
    if($keyWorkSearch != ''){
        $strSearch .= "&$colSearch"."s=$keyWorkSearch";
        $wh .=" and $colSearch like '%$keyWorkSearch%'"; 
    }
    $smarty->assign($colSearch."s", $keyWorkSearch);
}
function CategorySearch ($keyWorkSearch, $colSearch, $CategTable, $colName) {
    global $wh, $strSearch, $smarty;
    if($keyWorkSearch != ''){
        $strSearch .= "&$colSearch"."s=$keyWorkSearch";
        $wh .=" and $colSearch in (select id from $GLOBALS[db_sp].$CategTable where $colName like '%$keyWorkSearch%')"; 
    }
    $smarty->assign($colSearch."s", $keyWorkSearch);
}
function NumberSearch ($keyWorkSearch, $colSearch) {
    global $wh, $strSearch, $smarty;
    if (isset($keyWorkSearch) && $keyWorkSearch != '') {
        $strSearch .= "&$colSearch"."s=$keyWorkSearch";
        $wh .=" and ".$colSearch." = ".$keyWorkSearch; 
    }
    $smarty->assign($colSearch."s", $keyWorkSearch);
}
function DateSearch ($keyWorkSearch, $colSearch) {
    global $wh, $strSearch, $smarty;
    if (isset($keyWorkSearch) && $keyWorkSearch != '') {
        $strSearch .= "&$colSearch"."s=$keyWorkSearch";
        $wh .=" and $colSearch = '$keyWorkSearch'"; 
    }
    $smarty->assign($colSearch."s", $keyWorkSearch);
}
?>
