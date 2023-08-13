<?php
$loaivangs = ceil(trim($_GET['loaivangs']));

$fromDate = trim(striptags($_GET['fromdays']));
$toDate = trim(striptags($_GET['todays']));

$smarty->assign("idloaivang",$loaivangs);
$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);

?>