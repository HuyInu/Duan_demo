<?php
$loaivangs = isset($_GET['loaivangs']) ? ceil(trim($_GET['loaivangs'])) : '';

$fromDate = isset($_GET['fromdays']) ? trim(striptags($_GET['fromdays'])) : '';
$toDate = isset($_GET['todays']) ? trim(striptags($_GET['todays'])) : '';

$smarty->assign("idloaivang",$loaivangs);
$smarty->assign("fromdays",$fromDate);
$smarty->assign("todays",$toDate);

?>