<?php
$wh = $strSearch = '';
$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));
$codes = trim(striptags($_GET['codes']));
$daychungtus = trim(striptags($_GET['daychungtus']));
$names = trim(striptags($_GET['names']));
$namelaps = trim(striptags($_GET['namelaps']));
$donvilaps = trim(striptags($_GET['donvilaps']));
$nameduyets = trim(striptags($_GET['nameduyets']));
$donviduyets = trim(striptags($_GET['donviduyets']));
$lydos = trim(striptags($_GET['lydos']));

$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);
$smarty->assign("codes",$codes);
$smarty->assign("daychungtus",$daychungtus);
$smarty->assign("names",$names);
$smarty->assign("namelaps",$namelaps);
$smarty->assign("donvilaps",$donvilaps);
$smarty->assign("nameduyets",$nameduyets);
$smarty->assign("donviduyets",$donviduyets);
$smarty->assign("lydos",$lydos);

if(!empty($fromDate)){
	$strSearch .= '&fromdays='.$fromDate;
	$fromDate = explode('/',$fromDate);
	$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
	$wh.=' and datedchungtu >= "'.$fromDate.'" ';
}
if(!empty($toDate)){
	$strSearch .= '&todays='.$toDate;				
	$toDate = explode('/',$toDate);
	$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
	$wh.=' and datedchungtu <= "'.$toDate.'" ';
}
if(!empty($daychungtus)){
	$strSearch .= '&daychungtus='.$daychungtus;
	$daychungtus = explode('/',$daychungtus);
	$daychungtus = $daychungtus[2].'-'.$daychungtus[1].'-'.$daychungtus[0];
	$wh.=' and datedchungtu = "'.$daychungtus.'" ';
}
if(!empty($codes)){
	$strSearch .= '&codes='.$codes;
	$wh.=' and maphieu like "%'.$codes.'%" ';
}
if(!empty($names)){
	$strSearch .= '&names='.$names;
	$wh.=' and name  like "%'.$names.'%" ';
}
if(!empty($namelaps)){
	$strSearch .= '&namelaps='.$namelaps;
	$wh.=' and nguoilapphieu  like "%'.$namelaps.'%" ';
}
if(!empty($donvilaps)){
	$strSearch .= '&donvilaps='.$donvilaps;
	$wh.=' and donvilapphieu  like "%'.$donvilaps.'%" ';
}
if(!empty($nameduyets)){
	$strSearch .= '&nameduyets='.$nameduyets;
	$wh.=' and nguoiduyetphieu  like "%'.$nameduyets.'%" ';
}
if(!empty($donviduyets)){
	$strSearch .= '&donviduyets='.$donviduyets;
	$wh.=' and donviduyetphieu  like "%'.$donviduyets.'%" ';
}
if(!empty($lydos)){
	$strSearch .= '&lydos='.$lydos;
	$wh.=' and lydo  like "%'.$lydos.'%" ';
}

?>