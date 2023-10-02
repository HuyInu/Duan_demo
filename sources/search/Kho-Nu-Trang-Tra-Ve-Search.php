<?php
$wh = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));
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


$maPhieu = trim(striptags($_GET['maphieus']));
$midNames = trim(striptags($_GET['midNames']));
$slmon = trim(striptags($_GET['slmons']));
$cannangvh = trim(striptags($_GET['cannangvhs']));
$cannangh = trim(striptags($_GET['cannanghs']));
$cannangv = trim(striptags($_GET['cannangvs']));
$tongtienhot = trim(striptags($_GET['tongtienhots']));
$tongtiencong = trim(striptags($_GET['tongtiencongs']));
$tongtiendangoctrai = trim(striptags($_GET['tongtiendangoctrais']));
if(!empty($maPhieu)){
	$strSearch .= "&maphieus=$maPhieu";
    $wh .=" and maphieu like '%$maPhieu%'"; 
}
if(!empty($midNames)){
	$strSearch .= "&maphieus=$maPhieu";
    $wh .=" and mid in (select id from $GLOBALS[db_sp].admin where fullname like '%$midNames%')";
}
if(!empty($slmon)){
	$strSearch .= "&slmon=$slmon";
    $wh .=" and slmon = $slmon";
}
if(!empty($cannangvh)){
	$strSearch .= "&cannangvh=$cannangvh";
    $wh .=" and cannangvh = $cannangvh";
}
if(!empty($cannangh)){
	$strSearch .= "&cannangh=$cannangh";
    $wh .=" and cannangh = $cannangh";
}
if(!empty($cannangv)){
	$strSearch .= "&cannangv=$cannangv";
    $wh .=" and cannangv = $cannangv";
}
if(!empty($tongtienhot)){
	$strSearch .= "&tongtienhot=$tongtienhot";
    $wh .=" and tongtienhot = $tongtienhot";
}
if(!empty($tongtiencong)){
	$strSearch .= "&tongtiencong=$tongtiencong";
    $wh .=" and tongtiencong = $tongtiencong";
}
if(!empty($tongtiendangoctrai)){
	$strSearch .= "&tongtiendangoctrai=$tongtiendangoctrai";
    $wh .=" and tongtiendangoctrai = $tongtiendangoctrai";
}
$searchKeyword = [
    'maphieus' =>  $maPhieu,
    'midNames' =>  $midNames,
    'slmons' =>  $slmon,
    'cannangvhs' =>  $cannangvh,
    'cannanghs' =>  $cannangh,
    'cannangvs' =>  $cannangv,
    'tongtienhots' =>  $tongtienhot,
    'tongtiencongs' =>  $tongtiencong,
    'tongtiendangoctrais' =>  $tongtiendangoctrai,
];
$smarty->assign("searchKeyword",$searchKeyword);
?>