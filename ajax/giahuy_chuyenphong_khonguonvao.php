<?php
include("../#include/config.php");
include("../functions/function.php");
CheckLogin();
global $path_url,$path_dir;
date_default_timezone_set("Asia/Ho_Chi_Minh");

if(!isset($_SESSION["store_qlsxntjcorg_login"])){
	die('Vui long dang nhap lai');	
}

$dateNow = date('Y-m-d');
$timeNow = date('H:i:s');
$act = isset($_POST['act']) ? $_POST['act'] : '';
$idToa = isset($_POST['id']) ? $_POST['id'] : '';
$phongban= isset($_POST['phongban']) ? $_POST['phongban'] : '';
$phongbanchuyen = $cid = isset($_POST['phongbanchuyen']) ? $_POST['phongbanchuyen'] : '';
$macode = isset($_POST['maphieu'])?$_POST['maphieu']:"";

$ar;
switch($act) {
    case 'TaoPhieuXuatKho':
        $GLOBALS["sp"]->BeginTrans();
        try {
            $sqltc = "select * from $GLOBALS[db_sp].categories where id = '$cid'";
            $rstc = $GLOBALS['sp']->getRow($sqltc);
            $table = $rstc['table'];
            $tablect = $rstc['tablect'];
            $tablehachtoan = $rstc['tablehachtoan'];
            
            $ctToaList = getTableAll($tablect,' and idctnx='.$idToa.' order by id asc');
            if(count($ctToaList) > 0 ) {
                $toa = [];
                $toa['midchuyen'] = $_SESSION['admin_qlsxntjcorg_id'];
                $toa['phongban'] = $phongban;
                $toa['phongbanchuyen'] =  $phongbanchuyen;
                $toa['datechuyen'] = $dateNow;
                $toa['timechuyen'] = $timeNow;
                $toa['type'] = 3;
                vaUpdate('khonguonvao_khoachin', $toa, "id = $idToa");

                $ctToa = [];
                foreach($ctToaList as $item) {
                    $sqlmpt = "select max(numphieu)+1 from $GLOBALS[db_sp].".$tablect."";                 
                    $rsmpt = $GLOBALS['sp']->getone($sqlmpt);
                    if($rsmpt <= 0)
                        $rsmpt = 1;	
                    $maso = convertMaso($rsmpt);

                    $ctToa['idctnx'] = $item['idctnx'];
                    $ctToa['idct'] = $item['id'];
                    $ctToa['mid'] = $_SESSION['admin_qlsxntjcorg_id'];
                    $ctToa['numphieu'] = $maso;
                    $ctToa['maphieu'] = $macode.$maso;
                    $ctToa['nhomdm'] = $item['nhomdm'];
                    $ctToa['nhomnguyenlieuvang'] = $item['nhomnguyenlieuvang'];
                    $ctToa['tennguyenlieuvang'] = $item['tennguyenlieuvang'];
                    $ctToa['idloaivang'] = $item['idloaivang'];
                    $ctToa['cannangvh'] = $item['cannangvh'];
                    $ctToa['cannangh'] = $item['cannangh'];
                    $ctToa['cannangv'] = $item['cannangv'];
                    $ctToa['tuoivang'] = $item['tuoivang'];
                    $ctToa['tienmatvang'] = $item['tienmatvang'];
                    $ctToa['ghichuvang'] = $item['ghichuvang'];
                    $ctToa['type'] = 2;
                    $ctToa['typevkc'] = 1;
                    $ctToa['time'] = $item['time'];
                    $ctToa['dated'] = $item['dated'];

                    vaInsert($tablect, $ctToa);
                    giahuy_ghiSoHachToan($tablehachtoan, $tablect, $item['id'], '');
                }
            }
            $GLOBALS["sp"]->CommitTrans();
        } catch(Exception $e) {
            $GLOBALS["sp"]->RollbackTrans();
            die(json_encode(array('ar'=>0, 'status'=>$e)));
        }
    break;
}
die(json_encode(array('ar'=>0, 'status'=>'good')));

?>