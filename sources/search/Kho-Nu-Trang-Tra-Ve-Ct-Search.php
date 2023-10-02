<?php
$wh = $strSearch = '';
$whSubSelect = "";
$fromDate = trim(striptags($_REQUEST['fromdays']));
$toDate = trim(striptags($_REQUEST['todays'])); 
if($act == 'ChiTietTon'){
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
$dateds = trim(striptags($_GET['dateds']));
$datedxacnhans = trim(striptags($_GET['datedxacnhans']));
$sophieus = trim(striptags($_GET['sophieus']));
$cuahangtruocs = trim(striptags($_GET['cuahangtruocs']));
$STTs = trim(striptags($_GET['STTs']));
$nhacungcaps = trim(striptags($_GET['nhacungcaps']));
$ghichus = trim(striptags($_GET['ghichus']));
$loaivangs = trim(striptags($_GET['idloaivangs']));
$macus = trim(striptags($_GET['macus']));
$tens = trim(striptags($_GET['tens']));
$ghichu2s = trim(striptags($_GET['ghichu2s']));
$gvhs = trim(striptags($_GET['gvhs']));
$slmons = trim(striptags($_GET['slmons']));
$cannangvhs = trim(striptags($_GET['cannangvhs']));
$cannanghs = trim(striptags($_GET['cannanghs']));
$cannanghgrs = trim(striptags($_GET['cannanghgrs']));
$cannangvs = trim(striptags($_GET['cannangvs']));
$tienhs = trim(striptags($_GET['tienhs']));
$tiencongs = trim(striptags($_GET['tiencongs']));
$cvsps = trim(striptags($_GET['cvsps']));
$tiendangoctrais = trim(striptags($_GET['tiendangoctrais']));
$tienconghotbans = trim(striptags($_GET['tienconghotbans']));
$thanhtiens = trim(striptags($_GET['thanhtiens']));
$msms = trim(striptags($_GET['msms']));
$chitiethottams = trim(striptags($_GET['chitiethottams']));
$chitiethottamthuctes = trim(striptags($_GET['chitiethottamthuctes']));
$khs = trim(striptags($_GET['khs']));
$catalogue1s = trim(striptags($_GET['catalogue1s']));
$catalogue2s = trim(striptags($_GET['catalogue2s']));
$giabans = trim(striptags($_GET['giabans']));
$slmons = trim(striptags($_GET['slmons']));
$makhuyenmais = trim(striptags($_GET['makhuyenmais']));
$giatamtinhs = trim(striptags($_GET['giatamtinhs']));
$trangthaiduyets = trim(striptags($_GET['trangthaiduyets']));
$maphieus = trim(striptags($_GET['maphieus']));
$mids = trim(striptags($_GET['mids']));

StringSearch($maphieuimports, 'maphieuimport', $wh, 'maphieuimports');
CategorySearch ($midimports, 'midimport', 'admin', 'fullname', $wh, 'midimports');
StringSearch($cuahangs, 'cuahang', $wh, 'cuahangs');
StringSearch($noidens, 'noiden', $wh, 'noidens');
DateSearch($dateds, 'dated', $wh, 'dateds');
DateSearch($datedxacnhans, 'datedxacnhan', $wh, 'datedxacnhans');
StringSearch($sophieus, 'sophieu', $wh, 'sophieus');
StringSearch($cuahangtruocs, 'cuahangtruoc', $wh, 'cuahangtruocs');
StringSearch($STTs, 'STT', $wh, 'STTs');
StringSearch($nhacungcaps, 'nhacungcap', $wh, 'nhacungcaps');
StringSearch($ghichus, 'ghichu', $wh, 'ghichus');
CategorySearch ($loaivangs, 'idloaivang', 'loaivang', 'name_vn', $wh, 'loaivangs');
StringSearch($macus, 'macu', $wh, 'macus');
StringSearch($tens, 'ten', $wh, 'tens');
StringSearch($ghichu2s, 'ghichu2', $wh, 'ghichu2s');
NumberSearch($gvhs, 'gvh', $wh, 'gvhs');
NumberSearch($slmons, 'slmon', $wh, 'slmons');
NumberSearch($cannangvhs, 'cannangvh', $wh, 'cannangvhs');
NumberSearch($cannanghs, 'cannangh', $wh, 'cannanghs');
NumberSearch($cannanghgrs, 'cannanghgr', $wh, 'cannanghgrs');
NumberSearch($cannangvs, 'cannangv', $wh, 'cannangvs');
NumberSearch($tienhs, 'tienh', $wh, 'tienhs');
NumberSearch($tiencongs, 'tiencong', $wh, 'tiencongs');
NumberSearch($cvsps, 'cvsp', $wh, 'cvsps');
NumberSearch($tiendangoctrais, 'tiendangoctrai', $wh, 'tiendangoctrais');
NumberSearch($tienconghotbans, 'tienconghotban', $wh, 'tienconghotbans');
NumberSearch($thanhtiens, 'thanhtien', $wh, 'thanhtiens');
StringSearch($msms, 'msm', $wh, 'msms');
StringSearch($chitiethottams, 'chitiethottam', $wh, 'chitiethottams');
StringSearch($chitiethottamthuctes, 'chitiethottamthucte', $wh, 'chitiethottamthuctes');
StringSearch($khs, 'kh', $wh, 'khs');
StringSearch($catalogue1s, 'catalogue1', $wh, 'catalogue1s');
StringSearch($catalogue2s, 'catalogue2', $wh, 'catalogue2s');
NumberSearch($giabans, 'giaban', $wh, 'giabans');
NumberSearch($slmons, 'slmon', $wh, 'slmons');
StringSearch($makhuyenmais, 'makhuyenmai', $wh, 'makhuyenmais');
NumberSearch($giatamtinhs, 'giatamtinh', $wh, 'giatamtinhs');
NumberSearch($trangthaiduyets, 'type', $wh, 'types');
StringSearch($maphieus, 'maphieu', $wh, 'maphieus');
CategorySearch($mids, 'mid', 'admin', 'fullname', $wh, 'mids');

$maphieusubs = trim(striptags($_GET['maphieusubs']));
$midsubs = trim(striptags($_GET['midsubs']));
$datedimportsubs = trim(striptags($_GET['datedimportsubs']));
$maphieuimportsubs = trim(striptags($_GET['maphieuimportsubs']));
StringSearch($maphieusubs, 'maphieu', $whSubSelect, 'maphieusubs');
CategorySearch($midsubs, 'mid', 'admin', 'fullname', $whSubSelect, 'midsubs');
DateSearch($datedimportsubs, 'datedimport', $whSubSelect, 'datedimportsubs');
StringSearch($maphieuimportsubs, 'maphieuimport', $whSubSelect, 'maphieuimportsubs');

if ($whSubSelect != '') {
    $whSubSelect = "and idct in (select id from $GLOBALS[db_sp].khonguonvao_khonutrangtravect where 1=1 $whSubSelect)";
}  
function StringSearch ($keyWorkSearch, $colSearch, &$where, $smartyPassName) {
    global $strSearch, $smarty;
    if($keyWorkSearch != ''){
        $strSearch .= "&$colSearch"."s=$keyWorkSearch";
        $where .=" and $colSearch like '%$keyWorkSearch%'"; 
    }
    $smarty->assign($smartyPassName, $keyWorkSearch);
}
function CategorySearch ($keyWorkSearch, $colSearch, $CategTable, $colName, &$where, $smartyPassName) {
    global $strSearch, $smarty;
    if($keyWorkSearch != ''){
        $strSearch .= "&$colSearch"."s=$keyWorkSearch";
        $where .=" and $colSearch in (select id from $GLOBALS[db_sp].$CategTable where $colName like '%$keyWorkSearch%')"; 
    }
    $smarty->assign($smartyPassName, $keyWorkSearch);
}
function NumberSearch ($keyWorkSearch, $colSearch, &$where, $smartyPassName) {
    global $strSearch, $smarty;
    if (isset($keyWorkSearch) && $keyWorkSearch != '') {
        $strSearch .= "&$colSearch"."s=$keyWorkSearch";
        $where .=" and ".$colSearch." = ".$keyWorkSearch; 
    }
    $smarty->assign($smartyPassName, $keyWorkSearch);
}
function DateSearch ($keyWorkSearch, $colSearch, &$where, $smartyPassName) {
    global $strSearch, $smarty;
    if (isset($keyWorkSearch) && $keyWorkSearch != '') {
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $keyWorkSearch)));
        $strSearch .= "&$colSearch"."s=$date";
        $where .=" and $colSearch = '$date'"; 
    }
    $smarty->assign($smartyPassName, $keyWorkSearch);
}
?>
