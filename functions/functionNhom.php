<?php

// ================ ANH VŨ - BEGIN HẠCH TOÁN KHO ĐÁ - TEM HỘP 
function ghiSoHachToanDaTemHop($table,$tablehachtoan,$id){
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $datedauthang = date("Y").'-'.date("m").'-01';
    // table hiện tại
    $sql = "select soluong, type, idtemhop from $GLOBALS[db_sp].$table where id = ".$id;
    $item = $GLOBALS['sp']->getRow($sql);
    // Đơn giá trong bảng danh mục tương ứng với idtemhop
    $sqldg = "select dongia from $GLOBALS[db_sp].dm_temhop where id = ".$item['idtemhop'];
    $dongia = $GLOBALS['sp']->getOne($sqldg); 
    //
    clearstatcache();
	unset($arr);
	$arr = array();
    $soluongnhap = $soluongxuat = $soluongton = $dongianhap = $dongiaxuat = $dongiaton = $slnhap = $slxuat = $dgnhap = $dgxuat = 0;

    if($item['type'] == 1){ // Type = 1 > Phiếu Nhập : Type = 2 > Phiếu Xuất
        $slnhap = $item['soluong'];
        $dgnhap = round($slnhap * $dongia,3);
    }
    else{
        $slxuat = $item['soluong'];
        $dgxuat = round($slxuat * $dongia,3);
    }
    // Tablehachtoan tháng hiện tại
    $sqldate = "select * from $GLOBALS[db_sp].$tablehachtoan where idtemhop = ".$item['idtemhop']." and dated = '".$datedauthang."'";
    $rsdate = $GLOBALS['sp']->getRow($sqldate);
    if(empty($rsdate['id'])){ // Chưa có tháng hiện tại > Thêm vào
        // Lấy số lượng tồn tháng nhỏ hơn gần nhất
        $sqldatethangnho = "select id, soluongton , dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemhop = ".$item['idtemhop']." and dated < '".$datedauthang."' order by dated desc limit 1"; 
        $rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
        if($rsdatethangnho['id'] > 0){
            $soluongton = $rsdatethangnho['soluongton'];
            $dongiaton = $rsdatethangnho['dongiaton'];
        }
        $soluongnhap = round($soluongnhap + $slnhap,3);
        $soluongxuat = round($soluongxuat + $slxuat,3);
        $soluongton = round(round($soluongton + $slnhap,3) - $slxuat,3);

        $dongianhap = round($dongianhap + $dgnhap,3);
        $dongiaxuat = round($dongiaxuat + $dgxuat,3);
        $dongiaton = round(round($dongiaton + $dgnhap,3) - $dgxuat,3);

        $arr['soluongnhap'] = $soluongnhap;
        $arr['soluongxuat'] = $soluongxuat;
        $arr['soluongton'] = $soluongton;

        $arr['dongianhap'] = $dongianhap;
        $arr['dongiaxuat'] = $dongiaxuat;
        $arr['dongiaton'] = $dongiaton;

        $arr['idtemhop'] = $item['idtemhop'];
        $arr['dated'] = $datedauthang;
        vaInsert($tablehachtoan,$arr);
    }
    else{
        $soluongnhap = round($rsdate['soluongnhap'] + $slnhap, 3);
        $soluongxuat = round($rsdate['soluongxuat'] + $slxuat, 3);
        $soluongton = round(round($rsdate['soluongton'] + $slnhap, 3) - $slxuat, 3);

        $dongianhap = round($rsdate['dongianhap'] + $dgnhap, 3);
        $dongiaxuat = round($rsdate['dongiaxuat'] + $dgxuat, 3);
        $dongiaton = round(round($rsdate['dongiaton'] + $dgnhap, 3) - $dgxuat, 3);

        $arr['soluongnhap'] = $soluongnhap;
        $arr['soluongxuat'] = $soluongxuat;
        $arr['soluongton'] = $soluongton;

        $arr['dongianhap'] = $dongianhap;
        $arr['dongiaxuat'] = $dongiaxuat;
        $arr['dongiaton'] = $dongiaton;
        vaUpdate($tablehachtoan,$arr,' id = '.$rsdate['id']);
    }
}
// ================ ANH VŨ - END HẠCH TOÁN KHO ĐÁ - TEM HỘP 

// ================ ANH VŨ THÊM - BEGIN HẠCH TOÁN KHO TEM GIẤY 
function ghiSoHachToanDaTemGiay($table,$tablehachtoan,$id){
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $datedauthang = date("Y").'-'.date("m").'-01';
    // table hiện tại
    $sql = "select soluong, type, idtemgiay from $GLOBALS[db_sp].$table where id = ".$id;
    $item = $GLOBALS['sp']->getRow($sql);
    // Đơn giá trong bảng danh mục tương ứng với idtemgiay
    $sqldg = "select dongia from $GLOBALS[db_sp].dm_temgiay where id = ".$item['idtemgiay'];
    $dongia = $GLOBALS['sp']->getOne($sqldg); 
    
    clearstatcache();
	unset($arr);
	$arr = array();
    $soluongnhap = $soluongxuat = $soluongton = $dongianhap = $dongiaxuat = $dongiaton = $slnhap = $slxuat = $dgnhap = $dgxuat = 0;

    if($item['type'] == 1){ // Type = 1 > Phiếu Nhập : Type = 2 > Phiếu Xuất
        $slnhap = $item['soluong'];
        $dgnhap = round($slnhap * $dongia,3);
    }
    else{
        $slxuat = $item['soluong'];
        $dgxuat = round($slxuat * $dongia,3);
    }
    // Tablehachtoan tháng hiện tại
    $sqldate = "select * from $GLOBALS[db_sp].$tablehachtoan where idtemgiay = ".$item['idtemgiay']." and dated = '".$datedauthang."'";
    $rsdate = $GLOBALS['sp']->getRow($sqldate);
    
    if(empty($rsdate['id'])){ // Chưa có tháng hiện tại > Thêm vào
        // Lấy số lượng tồn tháng nhỏ hơn gần nhất
        $sqldatethangnho = "select id, soluongton , dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemgiay = ".$item['idtemgiay']." and dated < '".$datedauthang."' order by dated desc limit 1"; 
        $rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
        if($rsdatethangnho['id'] > 0){
            $soluongton = $rsdatethangnho['soluongton'];
            $dongiaton = $rsdatethangnho['dongiaton'];
        }
        $soluongnhap = round($soluongnhap + $slnhap,3);
        $soluongxuat = round($soluongxuat + $slxuat,3);
        $soluongton = round(round($soluongton + $slnhap,3) - $slxuat,3);

        $dongianhap = round($dongianhap + $dgnhap,3);
        $dongiaxuat = round($dongiaxuat + $dgxuat,3);
        $dongiaton = round(round($dongiaton + $dgnhap,3) - $dgxuat,3);

        $arr['soluongnhap'] = $soluongnhap;
        $arr['soluongxuat'] = $soluongxuat;
        $arr['soluongton'] = $soluongton;

        $arr['dongianhap'] = $dongianhap;
        $arr['dongiaxuat'] = $dongiaxuat;
        $arr['dongiaton'] = $dongiaton;

        $arr['idtemgiay'] = $item['idtemgiay'];
        $arr['dated'] = $datedauthang;
        vaInsert($tablehachtoan,$arr);
    }
    else{
        $soluongnhap = round($rsdate['soluongnhap'] + $slnhap, 3);
        $soluongxuat = round($rsdate['soluongxuat'] + $slxuat, 3);
        $soluongton = round(round($rsdate['soluongton'] + $slnhap, 3) - $slxuat, 3);

        $dongianhap = round($rsdate['dongianhap'] + $dgnhap, 3);
        $dongiaxuat = round($rsdate['dongiaxuat'] + $dgxuat, 3);
        $dongiaton = round(round($rsdate['dongiaton'] + $dgnhap, 3) - $dgxuat, 3);

        $arr['soluongnhap'] = $soluongnhap;
        $arr['soluongxuat'] = $soluongxuat;
        $arr['soluongton'] = $soluongton;

        $arr['dongianhap'] = $dongianhap;
        $arr['dongiaxuat'] = $dongiaxuat;
        $arr['dongiaton'] = $dongiaton;
        vaUpdate($tablehachtoan,$arr,' id = '.$rsdate['id']);
    }
}
// ================ ANH VŨ THÊM - END HẠCH TOÁN KHO TEM GIẤY 

// ================ ANH VŨ THÊM - BEGIN HẠCH TOÁN ĐIỀU CHỈNH SỐ LIỆU KHO TEM GIAY ===========
function editHachToanDieuChinhSoLieuDaTemGiay($id, $idtemgiay, $soluong, $table, $tablehachtoan){
    $datetao = $datedauthang = $sql = $rs = $sqldg = $rsdg = $sqldgOld = $rsdgOld = $sqldateOld = $rsdateOld = $sqldateOldAdd = $rsdateOldAdd = $sqldate = $rsdate = $sqldateAdd = $rsdateAdd = $sqldatethangnho = $rsdatethangnho = '';
    $soluongnhap = $soluongxuat = $soluongton = $dongianhap = $dongiaxuat = $dongiaton = $soluongnhapOld = $soluongxuatOld = $soluongtonOld = $dongianhapOld = $dongiaxuatOld = $dongiatonOld = $soluongtonOldAdd = $dongiatonOldAdd = $soluongtonAdd = $dongiatonAdd = 0;
    clearstatcache();
    unset($arr);
    unset($arrAdd);
    unset($arrOld);
    unset($arrOldAdd);
    $arr = $arrAdd = $arrOld = $arrOldAdd = array();
    // Phiếu hiện tại 
    $sql = "select * from $GLOBALS[db_sp].$table where id = ".$id;
    $rs = $GLOBALS['sp']->getRow($sql);
    $idtemgiayOld = $rs['idtemgiay'];
    $soluongOld = $rs['soluong'];
    $type = $rs['type'];
    if($type == 1){ // type = 1 > Phiếu nhập
        $datetao = explode('-',$rs['dated']);
        $datedauthang = $datetao[0].'-'.$datetao[1].'-01';
    }
    else{ // type = 2 > Phiếu xuất
        $datetao = explode('-',$rs['datexuat']);
        $datedauthang = $datetao[0].'-'.$datetao[1].'-01';
    }
    // Đơn giá mới thay đổi
    $sqldg = "select dongia from $GLOBALS[db_sp].dm_temgiay where id = ".$idtemgiay;
    $rsdg = $GLOBALS['sp']->getOne($sqldg);
    $dongia = round($soluong * $rsdg,3);
    // Đơn giá củ 
    $sqldgOld = "select dongia from $GLOBALS[db_sp].dm_temgiay where id = ".$idtemgiayOld;
    $rsdgOld = $GLOBALS['sp']->getOne($sqldgOld);
    $dongiaOld = round($soluongOld * $rsdgOld,3);

    if($idtemgiay != $idtemgiayOld){ // Thay đổi tem giấy
        // ======= Trừ tem giấy cũ tháng hiện tại ============================================================
        $sqldateOld = "select * from $GLOBALS[db_sp].$tablehachtoan where idtemgiay = ".$idtemgiayOld." and dated = '".$datedauthang."'";
        $rsdateOld = $GLOBALS['sp']->getRow($sqldateOld);
        if($type == 1){
            $soluongnhapOld = round($rsdateOld['soluongnhap'] - $soluongOld,3);
            $soluongtonOld = round($rsdateOld['soluongton'] - $soluongOld,3);
            $dongianhapOld = round($rsdateOld['dongianhap'] - $dongiaOld,3);
            $dongiatonOld = round($rsdateOld['dongiaton'] - $dongiaOld,3);
            $arrOld['soluongnhap'] = $soluongnhapOld;
            $arrOld['dongianhap'] = $dongianhapOld;
        }
        else{
            $soluongxuatOld = round($rsdateOld['soluongxuat'] - $soluongOld,3);
            $soluongtonOld = round($rsdateOld['soluongton'] + $soluongOld,3);
            $dongiaxuatOld = round($rsdateOld['dongiaxuat'] - $dongiaOld,3);
            $dongiatonOld = round($rsdateOld['dongiaton'] + $dongiaOld,3);
            $arrOld['soluongxuat'] = $soluongxuatOld;
            $arrOld['dongiaxuat'] = $dongiaxuatOld;
        }
        $arrOld['soluongton'] = $soluongtonOld;
        $arrOld['dongiaton'] = $dongiatonOld;
        vaUpdate($tablehachtoan,$arrOld,' id = '.$rsdateOld['id']);
        // ======= Trừ tem giấy cũ những tháng sau  ============================================================
        $sqldateOldAdd = "select id, soluongton, dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemgiay = ".$idtemgiayOld." and dated > '".$datedauthang."' order by dated asc";
        $rsdateOldAdd = $GLOBALS['sp']->getAll($sqldateOldAdd);
        if(ceil(count($rsdateOldAdd)) > 0){
            foreach($rsdateOldAdd as $itemOld){
                if($type == 1){
                    $soluongtonOldAdd = round($itemOld['soluongton'] - $soluongOld,3);
                    $dongiatonOldAdd = round($itemOld['dongiaton'] - $dongiaOld,3);
                }
                else{
                    $soluongtonOldAdd = round($itemOld['soluongton'] + $soluongOld,3);
                    $dongiatonOldAdd = round($itemOld['dongiaton'] + $dongiaOld,3);
                }
                $arrOldAdd['soluongton'] = $soluongtonOldAdd;
                $arrOldAdd['dongiaton'] = $dongiatonOldAdd;
                vaUpdate($tablehachtoan,$arrOldAdd,' id='.$itemOld['id']);
            }
        }
        // ======= Thêm tem giấy mới tháng hiện tại ============================================================
        $sqldate = "select * from $GLOBALS[db_sp].$tablehachtoan where idtemgiay = ".$idtemgiay." and dated = '".$datedauthang."'";
        $rsdate = $GLOBALS['sp']->getRow($sqldate);
        if(empty($rsdate['id'])){ // Chưa có giá trị dòng hiện tại
            // Lấy tồn kho tháng nhỏ hơn gần nhất 
            $sqldatethangnho = "select id, soluongton, dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemgiay = ".$idtemgiay." and dated < '".$datedauthang."' order by dated desc limit 1";
            $rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
            if($rsdatethangnho['id'] > 0){ 
                $soluongtonthangtruoc = $rsdatethangnho['soluongton'];
                $dongiatonthangtruoc = $rsdatethangnho['dongiaton'];
            }
            if($type == 1){ // Phiếu Nhập
                $soluongnhap = round($soluongnhap + $soluong,3);
                $dongianhap = round($dongianhap + $dongia,3);
            }
            else{ // Phiếu Xuất
                $soluongxuat = round($soluongxuat + $soluong,3);
                $dongiaxuat = round($dongiaxuat + $dongia,3);
            }
            $soluongton = round(round($soluongtonthangtruoc + $soluongnhap,3) - $soluongxuat,3);
            $dongiaton = round(round($dongiatonthangtruoc + $dongianhap,3) - $dongiaxuat,3);

            $arr['soluongnhap'] = $soluongnhap;
            $arr['soluongxuat'] = $soluongxuat;
            $arr['soluongton'] = $soluongton;
            $arr['dongianhap'] = $dongianhap;
            $arr['dongiaxuat'] = $dongiaxuat;
            $arr['dongiaton'] = $dongiaton;
            $arr['idtemgiay'] = $idtemgiay;
            $arr['dated'] = $datedauthang;
            vaInsert($tablehachtoan,$arr);
            // Lấy tồn kho những tháng tiếp theo
            $sqldateAdd = "select id, soluongton, dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemgiay = ".$idtemgiay." and dated > '".$datedauthang."' order by dated asc";
            $rsdateAdd = $GLOBALS['sp']->getAll($sqldateAdd);
            if(ceil(count($rsdateAdd)) > 0){
                foreach($rsdateAdd as $item){
                    if($type == 1){
                        $soluongtonAdd = round($item['soluongton'] + $soluong,3);
                        $dongiatonAdd = round($item['dongiaton'] + $dongia,3);
                    }
                    else{
                        $soluongtonAdd = round($item['soluongton'] - $soluong,3);
                        $dongiatonAdd = round($item['dongiaton'] - $dongia,3);
                    }
                    $arrAdd['soluongton'] = $soluongtonAdd;
                    $arrAdd['dongiaton'] = $dongiatonAdd;
                    vaUpdate($tablehachtoan,$arrAdd,' id = '.$item['id']);
                }
            }
        }
        else{ // Đã có giá trị dòng hiện tại
            if($type == 1){
                $soluongnhap = round($rsdate['soluongnhap'] + $soluong,3);
                $soluongton = round($rsdate['soluongton'] + $soluong,3);
                $dongianhap = round($rsdate['dongianhap'] + $dongia,3);
                $dongiaton = round($rsdate['dongiaton'] + $dongia,3);
                $arr['soluongnhap'] = $soluongnhap;
                $arr['dongianhap'] = $dongianhap;
            }
            else{
                $soluongxuat = round($rsdate['soluongxuat'] + $soluong,3);
                $soluongton = round($rsdate['soluongton'] - $soluong,3);
                $dongiaxuat = round($rsdate['dongiaxuat'] + $dongia,3);
                $dongiaton = round($rsdate['dongiaton'] - $dongia,3);
                $arr['soluongxuat'] = $soluongxuat;
                $arr['dongiaxuat'] = $dongiaxuat;
            }
            $arr['soluongton'] = $soluongton;
            $arr['dongiaton'] = $dongiaton;
            vaUpdate($tablehachtoan,$arr,' id = '.$rsdate['id']);
            // Lấy tồn kho những tháng tiếp theo
            $sqldateAdd = "select id, soluongton, dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemgiay = ".$idtemgiay." and dated > '".$datedauthang."' order by dated asc";
            $rsdateAdd = $GLOBALS['sp']->getAll($sqldateAdd);
            if(ceil(count($rsdateAdd)) > 0){
                foreach($rsdateAdd as $item){
                    if($type == 1){
                        $soluongtonAdd = round($item['soluongton'] + $soluong,3);
                        $dongiatonAdd = round($item['dongiaton'] + $dongia,3);
                    }
                    else{
                        $soluongtonAdd = round($item['soluongton'] - $soluong,3);
                        $dongiatonAdd = round($item['dongiaton'] - $dongia,3);
                    }
                    $arrAdd['soluongton'] = $soluongtonAdd;
                    $arrAdd['dongiaton'] = $dongiatonAdd;
                    vaUpdate($tablehachtoan,$arrAdd,' id = '.$item['id']);
                }
            }
        }
    }
    else{
        // Lấy giá trị tháng hiện tại
        $sqldate = "select * from $GLOBALS[db_sp].$tablehachtoan where idtemgiay = ".$idtemgiay." and dated = '".$datedauthang."'";
        $rsdate = $GLOBALS['sp']->getRow($sqldate);
        if($type == 1){
            $soluongnhap = round($rsdate['soluongnhap'] + round($soluong - $soluongOld,3),3);
            $soluongton = round($rsdate['soluongton'] + round($soluong - $soluongOld,3),3);
            $dongianhap = round($rsdate['dongianhap'] + round($dongia - $dongiaOld),3);
            $dongiaton = round($rsdate['dongiaton'] + round($dongia - $dongiaOld),3);
            $arr['soluongnhap'] = $soluongnhap;
            $arr['dongianhap'] = $dongianhap;
        }
        else{
            $soluongxuat = round($rsdate['soluongxuat'] + round($soluong - $soluongOld,3),3);
            $soluongton = round($rsdate['soluongton'] - round($soluong - $soluongOld,3),3);
            $dongiaxuat = round($rsdate['dongiaxuat'] + round($dongia - $dongiaOld),3);
            $dongiaton = round($rsdate['dongiaton'] - round($dongia - $dongiaOld),3);
            $arr['soluongxuat'] = $soluongxuat;
            $arr['dongiaxuat'] = $dongiaxuat;
        }
        $arr['soluongton'] = $soluongton;
        $arr['dongiaton'] = $dongiaton;
        vaUpdate($tablehachtoan,$arr,' id = '.$rsdate['id']);
        // Lấy tồn kho những tháng tiếp theo
        $sqldateAdd = "select id, soluongton, dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemgiay = ".$idtemgiay." and dated > '".$datedauthang."' order by dated asc";
        $rsdateAdd = $GLOBALS['sp']->getAll($sqldateAdd);
        if(ceil(count($rsdateAdd)) > 0){
            foreach($rsdateAdd as $item){
                if($type == 1){
                    $soluongtonAdd = round($item['soluongton'] + round($soluong - $soluongOld,3),3);
                    $dongiatonAdd = round($item['dongiaton'] + round($dongia - $dongiaOld,3),3);
                }
                else{
                    $soluongtonAdd = round($item['soluongton'] - round($soluong - $soluongOld),3);
                    $dongiatonAdd = round($item['dongiaton'] - round($dongia - $dongiaOld),3);
                }
                $arrAdd['soluongton'] = $soluongtonAdd;
                $arrAdd['dongiaton'] = $dongiatonAdd;
                vaUpdate($tablehachtoan,$arrAdd,' id = '.$item['id']);
            }
        }
    }
}
// ================ ANH VŨ THÊM - END HẠCH TOÁN ĐIỀU CHỈNH SỐ LIỆU KHO TEM GIAY =============

// ================ ANH VŨ THÊM - BEGIN HẠCH TOÁN ĐIỀU CHỈNH SỐ LIỆU KHO TEM HOP ===========
function editHachToanDieuChinhSoLieuDaTemHop($id, $idtemhop, $soluong, $table, $tablehachtoan){
    $datetao = $datedauthang = '';
    clearstatcache();
    unset($arr);
    unset($arrAdd);
    unset($arrOld);
    unset($arrOldAdd);
    $arr = $arrAdd = $arrOld = $arrOldAdd = array();
    $sql = $rs = $sqldg = $rsdg = $sqldgOld = $rsdgOld = $sqldateOld = $rsdateOld = $sqldateOldAdd = $rsdateOldAdd = $sqldate = $rsdate = $sqldateAdd = $rsdateAdd = $sqldatethangnho = $rsdatethangnho = '';
    $soluongnhap = $soluongxuat = $soluongton = $dongianhap = $dongiaxuat = $dongiaton = $soluongtonAdd = $dongiatonAdd = $soluongtonthangtruoc = $dongiatonthangtruoc = 0;
    // Lấy phiếu theo id hiện tại
    $sql = "select idtemhop, soluong, dated, datexuat, type from $GLOBALS[db_sp].$table where id = ".$id;
    $rs = $GLOBALS['sp']->getRow($sql);

    $idtemhopOld = $rs['idtemhop'];
    $soluongOld = $rs['soluong'];
    $type = $rs['type'];
    // Lấy đơn giá mới theo idtemhop
    $sqldg = "select dongia from $GLOBALS[db_sp].dm_temhop where id = ".$idtemhop;
    $rsdg = $GLOBALS['sp']->getOne($sqldg);
    $dongia = round($soluong * $rsdg,3);
    // Lấy đơn giá cũ theo idtemhopOld
    $sqldgOld = "select dongia from $GLOBALS[db_sp].dm_temhop where id = ".$idtemhopOld;
    $rsdgOld = $GLOBALS['sp']->getOne($sqldgOld);
    $dongiaOld = round($soluongOld * $rsdgOld,3);

    if($type == 1){ // type = 1 > Phiếu Nhập : type = 2 > Phiếu Xuất
        $datetao = explode('-',$rs['dated']);
        $datedauthang = $datetao[0].'-'.$datetao[1].'-01';
    }
    else{
        $datetao = explode('-',$rs['datexuat']);
        $datedauthang = $datetao[0].'-'.$datetao[1].'-01';
    }
    
    if($idtemhop != $idtemhopOld){ // Thay đổi idtemhop
        // ======= Trừ idtemhop cũ tháng hiện tại ============================================================
        $soluongnhapOld = $soluongxuatOld = $soluongtonOld = $dongianhapOld = $dongiaxuatOld = $dongiatonOld = $soluongtonOldAdd = $dongiatonOldAdd = 0;
        
        $sqldateOld = "select * from $GLOBALS[db_sp].$tablehachtoan where idtemhop = ".$idtemhopOld." and dated = '".$datedauthang."'";
        $rsdateOld = $GLOBALS['sp']->getRow($sqldateOld);
        if($type == 1){
            $soluongnhapOld = round($rsdateOld['soluongnhap'] - $soluongOld,3);
            $soluongtonOld = round($rsdateOld['soluongton'] - $soluongOld,3);
            $dongianhapOld = round($rsdateOld['dongianhap'] - $dongiaOld,3);
            $dongiatonOld = round($rsdateOld['dongiaton'] - $dongiaOld,3);
            $arrOld['soluongnhap'] = $soluongnhapOld;
            $arrOld['dongianhap'] = $dongianhapOld;
        }
        else{
            $soluongxuatOld = round($rsdateOld['soluongxuat'] - $soluongOld,3);
            $soluongtonOld = round($rsdateOld['soluongton'] + $soluongOld,3);
            $dongiaxuatOld = round($rsdateOld['dongiaxuat'] - $dongiaOld,3);
            $dongiatonOld = round($rsdateOld['dongiaton'] + $dongiaOld,3);
            $arrOld['soluongxuat'] = $soluongxuatOld;
            $arrOld['dongiaxuat'] = $dongiaxuatOld;
        }
        $arrOld['soluongton'] = $soluongtonOld;
        $arrOld['dongiaton'] = $dongiatonOld;
        vaUpdate($tablehachtoan,$arrOld,' id = '.$rsdateOld['id']);
        // ======= Trừ idtemhop cũ những tháng sau  ============================================================
        $sqldateOldAdd = "select id, soluongton, dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemhop = ".$idtemhopOld." and dated > '".$datedauthang."' order by dated asc";
        $rsdateOldAdd = $GLOBALS['sp']->getAll($sqldateOldAdd);
        if(ceil(count($rsdateOldAdd)) > 0){
            foreach($rsdateOldAdd as $itemOld){
                if($type == 1){
                    $soluongtonOldAdd = round($itemOld['soluongton'] - $soluongOld,3);
                    $dongiatonOldAdd = round($itemOld['dongiaton'] - $dongiaOld,3);
                }else{
                    $soluongtonOldAdd = round($itemOld['soluongton'] + $soluongOld,3);
                    $dongiatonOldAdd = round($itemOld['dongiaton'] + $dongiaOld,3);
                }
                $arrOldAdd['soluongton'] = $soluongtonOldAdd;
                $arrOldAdd['dongiaton'] = $dongiatonOldAdd;
                vaUpdate($tablehachtoan,$arrOldAdd,' id='.$itemOld['id']);
            }
        }
        // ======= Thêm idtemhop mới tháng hiện tại ============================================================
        $sqldate = "select * from $GLOBALS[db_sp].$tablehachtoan where idtemhop = ".$idtemhop." and dated = '".$datedauthang."'";
        $rsdate = $GLOBALS['sp']->getRow($sqldate);
        if(empty($rsdate['id'])){ // Chưa có giá trị dòng hiện tại
            // Lấy tồn kho tháng nhỏ hơn gần nhất 
            $sqldatethangnho = "select id, soluongton, dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemhop = ".$idtemhop." and dated < '".$datedauthang."' order by dated desc limit 1";
            $rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
            if($rsdatethangnho['id'] > 0){ 
                $soluongtonthangtruoc = $rsdatethangnho['soluongton'];
                $dongiatonthangtruoc = $rsdatethangnho['dongiaton'];
            }
            if($type == 1){ // Phiếu Nhập
                $soluongnhap = round($soluongnhap + $soluong,3);
                $dongianhap = round($dongianhap + $dongia,3);
            }
            else{ // Phiếu Xuất
                $soluongxuat = round($soluongxuat + $soluong,3);
                $dongiaxuat = round($dongiaxuat + $dongia,3);
            }
            $soluongton = round(round($soluongtonthangtruoc + $soluongnhap,3) - $soluongxuat,3);
            $dongiaton = round(round($dongiatonthangtruoc + $dongianhap,3) - $dongiaxuat,3);

            $arr['soluongnhap'] = $soluongnhap;
            $arr['soluongxuat'] = $soluongxuat;
            $arr['soluongton'] = $soluongton;
            $arr['dongianhap'] = $dongianhap;
            $arr['dongiaxuat'] = $dongiaxuat;
            $arr['dongiaton'] = $dongiaton;
            $arr['idtemhop'] = $idtemhop;
            $arr['dated'] = $datedauthang;
            vaInsert($tablehachtoan,$arr);
            // Lấy tồn kho những tháng tiếp theo
            $sqldateAdd = "select id, soluongton, dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemhop = ".$idtemhop." and dated > '".$datedauthang."' order by dated asc";
            $rsdateAdd = $GLOBALS['sp']->getAll($sqldateAdd);
            if(ceil(count($rsdateAdd)) > 0){
                foreach($rsdateAdd as $item){
                    if($type == 1){
                        $soluongtonAdd = round($item['soluongton'] + $soluong,3);
                        $dongiatonAdd = round($item['dongiaton'] + $dongia,3);
                    }
                    else{
                        $soluongtonAdd = round($item['soluongton'] - $soluong,3);
                        $dongiatonAdd = round($item['dongiaton'] - $dongia,3);
                    }
                    $arrAdd['soluongton'] = $soluongtonAdd;
                    $arrAdd['dongiaton'] = $dongiatonAdd;
                    vaUpdate($tablehachtoan,$arrAdd,' id = '.$item['id']);
                }
            }
        }
        else{ // Đã có giá trị dòng hiện tại
            if($type == 1){
                $soluongnhap = round($rsdate['soluongnhap'] + $soluong,3);
                $soluongton = round($rsdate['soluongton'] + $soluong,3);
                $dongianhap = round($rsdate['dongianhap'] + $dongia,3);
                $dongiaton = round($rsdate['dongiaton'] + $dongia,3);
                $arr['soluongnhap'] = $soluongnhap;
                $arr['dongianhap'] = $dongianhap;
            }
            else{
                $soluongxuat = round($rsdate['soluongxuat'] + $soluong,3);
                $soluongton = round($rsdate['soluongton'] - $soluong,3);
                $dongiaxuat = round($rsdate['dongiaxuat'] + $dongia,3);
                $dongiaton = round($rsdate['dongiaton'] - $dongia,3);
                $arr['soluongxuat'] = $soluongxuat;
                $arr['dongiaxuat'] = $dongiaxuat;
            }
            $arr['soluongton'] = $soluongton;
            $arr['dongiaton'] = $dongiaton;
            vaUpdate($tablehachtoan,$arr,' id = '.$rsdate['id']);
            // Lấy tồn kho những tháng tiếp theo
            $sqldateAdd = "select id, soluongton, dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemhop = ".$idtemhop." and dated > '".$datedauthang."' order by dated asc";
            $rsdateAdd = $GLOBALS['sp']->getAll($sqldateAdd);
            if(ceil(count($rsdateAdd)) > 0){
                foreach($rsdateAdd as $item){
                    if($type == 1){
                        $soluongtonAdd = round($item['soluongton'] + $soluong,3);
                        $dongiatonAdd = round($item['dongiaton'] + $dongia,3);
                    }
                    else{
                        $soluongtonAdd = round($item['soluongton'] - $soluong,3);
                        $dongiatonAdd = round($item['dongiaton'] - $dongia,3);
                    }
                    $arrAdd['soluongton'] = $soluongtonAdd;
                    $arrAdd['dongiaton'] = $dongiatonAdd;
                    vaUpdate($tablehachtoan,$arrAdd,' id = '.$item['id']);
                }
            }
        }
    }
    else{
        // Lấy giá trị tháng hiện tại
        $sqldate = "select * from $GLOBALS[db_sp].$tablehachtoan where idtemhop = ".$idtemhop." and dated = '".$datedauthang."'";
        $rsdate = $GLOBALS['sp']->getRow($sqldate);
        if($type == 1){
            $soluongnhap = round($rsdate['soluongnhap'] + round($soluong - $soluongOld,3),3);
            $soluongton = round($rsdate['soluongton'] + round($soluong - $soluongOld,3),3);
            $dongianhap = round($rsdate['dongianhap'] + round($dongia - $dongiaOld),3);
            $dongiaton = round($rsdate['dongiaton'] + round($dongia - $dongiaOld),3);
            $arr['soluongnhap'] = $soluongnhap;
            $arr['dongianhap'] = $dongianhap;
        }
        else{
            $soluongxuat = round($rsdate['soluongxuat'] + round($soluong - $soluongOld,3),3);
            $soluongton = round($rsdate['soluongton'] - round($soluong - $soluongOld,3),3);
            $dongiaxuat = round($rsdate['dongiaxuat'] + round($dongia - $dongiaOld),3);
            $dongiaton = round($rsdate['dongiaton'] - round($dongia - $dongiaOld),3);
            $arr['soluongxuat'] = $soluongxuat;
            $arr['dongiaxuat'] = $dongiaxuat;
        }
        $arr['soluongton'] = $soluongton;
        $arr['dongiaton'] = $dongiaton;
        vaUpdate($tablehachtoan,$arr,' id = '.$rsdate['id']);
        // Lấy tồn kho những tháng tiếp theo
        $sqldateAdd = "select id, soluongton, dongiaton from $GLOBALS[db_sp].$tablehachtoan where idtemhop = ".$idtemhop." and dated > '".$datedauthang."' order by dated asc";
        $rsdateAdd = $GLOBALS['sp']->getAll($sqldateAdd);
        if(ceil(count($rsdateAdd)) > 0){
            foreach($rsdateAdd as $item){
                if($type == 1){
                    $soluongtonAdd = round($item['soluongton'] + round($soluong - $soluongOld,3),3);
                    $dongiatonAdd = round($item['dongiaton'] + round($dongia - $dongiaOld,3),3);
                }
                else{
                    $soluongtonAdd = round($item['soluongton'] - round($soluong - $soluongOld),3);
                    $dongiatonAdd = round($item['dongiaton'] - round($dongia - $dongiaOld),3);
                }
                $arrAdd['soluongton'] = $soluongtonAdd;
                $arrAdd['dongiaton'] = $dongiatonAdd;
                vaUpdate($tablehachtoan,$arrAdd,' id = '.$item['id']);
            }
        }
    }
}
// ================ ANH VŨ THÊM - END HẠCH TOÁN ĐIỀU CHỈNH SỐ LIỆU KHO TEM HOP =============

// === ANH VŨ BEGIN THÊM HẠCH TOÁN KHO ĐÁ TEM ĐÁ ===
function ghisoHachToanKhoDaTemDa($table,$tablehachtoan,$id){
    date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datedauthang = date('Y').'-'.date('m').'-01';
    clearstatcache();
    unset($arr);
    $arr = array();
    $soluongnhap = $soluongxuat = $soluongton = $dongianhap = $dongiaxuat = $dongiaton = $slnhap = $slxuat = $dgnhap = $dgxuat = $sltontt = $dgtontt = 0;
    // === Phiếu hiện tại ===
    $sql = "select idda, soluongda, tongtienda, type from $GLOBALS[db_sp].$table where id = ".$id;
    $item = $GLOBALS['sp']->getRow($sql);
    if($item['type'] == 1){ // type = 1 > Phiếu nhập 
        $slnhap = $item['soluongda'];
        $dgnhap = $item['tongtienda'];
    }
    else{ // type = 2 > Phiếu xuất 
        $slxuat = $item['soluongda'];
        $dgxuat = $item['tongtienda'];
    }
    // === Lấy dòng tablehachtoan hiện tại ===
    $sqldate = "select * from $GLOBALS[db_sp].$tablehachtoan where idda = ".$item['idda']." and dated = '".$datedauthang."'";
    $rsdate = $GLOBALS['sp']->getRow($sqldate);
    
    if(empty($rsdate['id'])){ // === Chưa có date tablehachtoan hiện tại ===
        // Tháng nhỏ hơn gần nhất 
        $sqldatethangnho = "select id, soluongton, dongiaton from $GLOBALS[db_sp].$tablehachtoan where idda = ".$item['idda']." and dated < '".$datedauthang."' order by dated desc limit 1";
        $rsdatethangnho = $GLOBALS['sp']->getRow($sqldatethangnho);
        if($rsdatethangnho['id'] > 0){
            $sltontt = $rsdatethangnho['soluongton'];
            $dgtontt = $rsdatethangnho['dongiaton'];
        }
        $soluongnhap = round($soluongnhap + $slnhap,3);
        $soluongxuat = round($soluongxuat + $slxuat,3);
        $soluongton = round($sltontt + round($slnhap - $slxuat,3),3);

        $dongianhap = round($dongianhap + $dgnhap,3);
        $dongiaxuat = round($dongiaxuat + $dgxuat,3);
        $dongiaton = round($dgtontt + round($dgnhap + $dgxuat),3);
        
        $arr['soluongnhap'] = $soluongnhap;
        $arr['soluongxuat'] = $soluongxuat;
        $arr['soluongton'] = $soluongton;

        $arr['dongianhap'] = $dongianhap;
        $arr['dongiaxuat'] = $dongiaxuat;
        $arr['dongiaton'] = $dongiaton;
        $arr['idda'] = $item['idda'];
        $arr['dated'] = $datedauthang;
        vaInsert($tablehachtoan,$arr);
    }
    else{ // === Đã có date tablehachtoan hiện tại ===
        $soluongnhap = round($rsdate['soluongnhap'] + $slnhap,3);
        $soluongxuat = round($rsdate['soluongxuat'] + $slxuat,3);
        $soluongton = round($rsdate['soluongton'] + round($slnhap - $slxuat,3),3);

        $dongianhap = round($rsdate['dongianhap'] + $dgnhap,3);
        $dongiaxuat = round($rsdate['dongiaxuat'] + $dgxuat,3);
        $dongiaton = round($rsdate['dongiaton'] + round($dgnhap - $dgxuat,3),3);

        $arr['soluongnhap'] = $soluongnhap;
        $arr['soluongxuat'] = $soluongxuat;
        $arr['soluongton'] = $soluongton;
        
        $arr['dongianhap'] = $dongianhap;
        $arr['dongiaxuat'] = $dongiaxuat;
        $arr['dongiaton'] = $dongiaton;
        vaUpdate($tablehachtoan,$arr,' id='.$rsdate['id']);
    }
}
// === ANH VŨ END THÊM HẠCH TOÁN KHO ĐÁ TEM ĐÁ ===

// ================= Anh Vũ Thêm - Start Tồn Kho Chi Tiết - Đá - Tem Hộp ==================

function insert_thongKeTonKhoChiTietDaTemHop($a){
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $datedauthang = date('Y-m-01');
    $arrlist = array();
    $whnhap = $sqlcid = $rscid = $sqldate = $rsdate = $sqlkt = $rskt = $sqltru1day = $rstru1day = $sqlnhaptndt = $sqlxuattndt = $sqlnhap = $sqlxuat = '';
    $soluongnhap = $soluongxuat = $soluongton = $dongiaton = $sltonsddk = $dgtonsddk = 0;

    $cid = ceil(trim($a['cid']));
	$idtemhop = ceil(trim($a['idtemhop']));
	$fromDate = $a['fromdays'];
    $toDate = $a['todays'];
    
    // Lấy cid hiện tại
    $sqlcid = "select tablect, tablehachtoan from $GLOBALS[db_sp].categories where id = ".$cid;
    $rscid = $GLOBALS['sp']->getRow($sqlcid);
    $table = $rscid['tablect'];
    $tablehachtoan = $rscid['tablehachtoan'];

    if(!empty($table) && !empty($tablehachtoan)){
        if(!empty($fromDate)){
            $fromDate = explode('/',$fromDate);
            $datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
            $fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
            $whnhap .= ' and dated >= "'.$fromDate.'"';
        }
        if(!empty($toDate)){
            $toDate = explode('/',$toDate);
            $toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
            $whnhap .= ' and dated <= "'.$toDate.'"';
        }
        if($idtemhop > 0){
            // Lấy tồn kho tháng nhỏ gần nhất tháng hiện tại
            $sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idtemhop = ".$idtemhop." and dated < '".$datedauthang."' order by dated desc limit 1";
            $rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
            if($rstru1day['id'] > 0){
                $sltonsddk = $rstru1day['soluongton'];
                $dgtonsddk = $rstru1day['dongiaton'];
            }
            // Lấy giá trị đơn giá trong danh mục tem hộp tương ứng idtemhop
            $sqldg = "select dongia from $GLOBALS[db_sp].dm_temhop where id = ".$idtemhop;
            $dongia = $GLOBALS['sp']->getOne($sqldg);
            // Kiểm tra tồn tại giá trị
            $sqlkt = "select id from $GLOBALS[db_sp].".$table." where idtemhop = ".$idtemhop." limit 1";
            $rskt = $GLOBALS['sp']->getRow($sqlkt);
            if(!empty($rskt)){ // Kiểm tra có giá trị idtemhop tồn tại trong dữ liệu
                if(empty($whnhap)){ // không có chọn ngày 
                    // Tồn Kho hiện tại
                    $sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idtemhop = ".$idtemhop." and dated = '".$datedauthang."'";
                    $rsdate = $GLOBALS['sp']->getRow($sqldate);

                    $soluongnhap = $rsdate['soluongnhap'];
                    $soluongxuat = $rsdate['soluongxuat'];
                    $dongianhap = $rsdate['dongianhap'];
                    $dongiaxuat = $rsdate['dongiaxuat'];

                    $soluongton = round($sltonsddk + round($soluongnhap - $soluongxuat,3),3);
                    $dongiaton = round($dgtonsddk + round($dongianhap - $dongiaxuat,3),3);

                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                else{
                    // Tổng nhập từ đầu tháng đến fromdate
                    $sqlnhaptndt = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemhop = ".$idtemhop." and type = 1 and trangthai = 2 and dated >= '".$datedauthang."' and dated < '".$fromDate."'";
                    $nhaptndt = $GLOBALS['sp']->getOne($sqlnhaptndt);
                    // Tổng xuất từ đầu tháng đến fromdate
                    $sqlxuattndt = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemhop = ".$idtemhop." and type = 2 and trangthai = 2 and datexuat >= '".$datedauthang."' and datexuat < '".$fromDate."'";
                    $xuattndt = $GLOBALS['sp']->getOne($sqlxuattndt);
                    
                    $sltonsddk = round($sltonsddk + round($nhaptndt - $xuattndt,3),3);
                    // Tổng nhập từ ngày đến ngày
                    $sqlnhap = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemhop = ".$idtemhop." and type = 1 and trangthai = 2 and dated >= '".$fromDate."' and dated <= '".$toDate."'";
                    $soluongnhap = $GLOBALS['sp']->getOne($sqlnhap);
                    // Tổng xuất từ ngày đến ngày
                    $sqlxuat = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemhop = ".$idtemhop." and type = 2 and trangthai = 2 and datexuat >= '".$fromDate."' and datexuat <= '".$toDate."'";
                    $soluongxuat = $GLOBALS['sp']->getOne($sqlxuat);

                    $soluongton = round($sltonsddk + round($soluongnhap - $soluongxuat,3),3);
                    $dongiaton = round($soluongton * $dongia,3);

                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                $arrlist['idtemhop'] = $idtemhop;
            }
        }
        else{
            $arrlist['idtemhop'] = 0;
        }
    }
    else{
        die('Table này chưa được thêm, vui lòng liên hệ admin để được xử lý.');
    }
    return $arrlist;
}

function thongKeTonKhoChiTietDaTemHop($cid, $idtemhop, $fromDate, $toDate){
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $datedauthang = date('Y-m-01');
    $arrlist = array();
    $whnhap = $sqlcid = $rscid = $sqldate = $rsdate = $sqlkt = $rskt = $sqltru1day = $rstru1day = $sqlnhaptndt = $sqlxuattndt = $sqlnhap = $sqlxuat = '';
    $soluongnhap = $soluongxuat = $soluongton = $dongiaton = $sltonsddk = $dgtonsddk = 0;
    // Lấy cid hiện tại
    $sqlcid = "select tablect, tablehachtoan from $GLOBALS[db_sp].categories where id = ".$cid;
    $rscid = $GLOBALS['sp']->getRow($sqlcid);
    $table = $rscid['tablect'];
    $tablehachtoan = $rscid['tablehachtoan'];

    if(!empty($table) && !empty($tablehachtoan)){
        if(!empty($fromDate)){
            $fromDate = explode('/',$fromDate);
            $datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
            $fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
            $whnhap .= ' and dated >= "'.$fromDate.'"';
        }
        if(!empty($toDate)){
            $toDate = explode('/',$toDate);
            $toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
            $whnhap .= ' and dated <= "'.$toDate.'"';
        }
        if($idtemhop > 0){
            // Lấy tồn kho tháng nhỏ gần nhất tháng hiện tại
            $sqltru1day = "select id, soluongton from $GLOBALS[db_sp].".$tablehachtoan." where idtemhop = ".$idtemhop." and dated < '".$datedauthang."' order by dated desc limit 1";
            $rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
            if($rstru1day['id'] > 0){
                $sltonsddk = $rstru1day['soluongton'];
            }
            // Lấy giá trị đơn giá trong danh mục tem hộp tương ứng idtemhop
            $sqldg = "select dongia from $GLOBALS[db_sp].dm_temhop where id = ".$idtemhop;
            $dongia = $GLOBALS['sp']->getOne($sqldg);
            // Kiểm tra tồn tại giá trị
            $sqlkt = "select id from $GLOBALS[db_sp].".$table." where idtemhop = ".$idtemhop." limit 1";
            $rskt = $GLOBALS['sp']->getRow($sqlkt);
            if(!empty($rskt)){ // Kiểm tra có giá trị idtemhop tồn tại trong dữ liệu
                if(empty($whnhap)){ // không có chọn ngày 
                    // Tồn Kho hiện tại
                    $sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idtemhop = ".$idtemhop." and dated = '".$datedauthang."'";
                    $rsdate = $GLOBALS['sp']->getRow($sqldate);

                    $soluongnhap = $rsdate['soluongnhap'];
                    $soluongxuat = $rsdate['soluongxuat'];

                    $soluongton = round($sltonsddk + round($soluongnhap - $soluongxuat,3),3);
                    $dongiaton = round($soluongton * $dongia,3);

                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                else{
                    // Tổng nhập từ đầu tháng đến fromdate
                    $sqlnhaptndt = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemhop = ".$idtemhop." and type = 1 and trangthai = 2 and dated >= '".$datedauthang."' and dated < '".$fromDate."'";
                    $nhaptndt = $GLOBALS['sp']->getOne($sqlnhaptndt);
                    // Tổng xuất từ đầu tháng đến fromdate
                    $sqlxuattndt = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemhop = ".$idtemhop." and type = 2 and trangthai = 2 and datexuat >= '".$datedauthang."' and datexuat < '".$fromDate."'";
                    $xuattndt = $GLOBALS['sp']->getOne($sqlxuattndt);
                    
                    $sltonsddk = round($sltonsddk + round($nhaptndt - $xuattndt,3),3);
                    // Tổng nhập từ ngày đến ngày
                    $sqlnhap = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemhop = ".$idtemhop." and type = 1 and trangthai = 2 and dated >= '".$fromDate."' and dated <= '".$toDate."'";
                    $soluongnhap = $GLOBALS['sp']->getOne($sqlnhap);
                    // Tổng xuất từ ngày đến ngày
                    $sqlxuat = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemhop = ".$idtemhop." and type = 2 and trangthai = 2 and datexuat >= '".$fromDate."' and datexuat <= '".$toDate."'";
                    $soluongxuat = $GLOBALS['sp']->getOne($sqlxuat);

                    $soluongton = round($sltonsddk + round($soluongnhap - $soluongxuat,3),3);
                    $dongiaton = round($soluongton * $dongia,3);

                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                $arrlist['idtemhop'] = $idtemhop;
            }
        }
        else{
            $arrlist['idtemhop'] = 0;
        }
    }
    else{
        die('Table này chưa được thêm, vui lòng liên hệ admin để được xử lý.');
    }
    return $arrlist;
}

// ================= Anh Vũ Thêm - End Tồn Kho Chi Tiết - Đá - Tem Hộp ==================

// ================= Anh Vũ Thêm - Start Tồn Kho Chi Tiết - Đá - Tem Giấy ===============

function insert_thongKeTonKhoChiTietDaTemGiay($a){
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $datedauthang = date('Y-m-01');
    $arrlist = array();
    $whnhap = $sqlcid = $rscid = $sqltru1day = $rstru1day = $sqldate = $rsdate = $sqlnhaptndt = $sqlxuattndt = $sqlnhap = $sqlxuat = '';
    $soluongnhap = $soluongxuat = $soluongton = $dongiaton = $sltonsddk = 0;

    $cid = ceil(trim($a['cid']));
	$idtemgiay = ceil(trim($a['idtemgiay']));
	$fromDate = $a['fromdays'];
    $toDate = $a['todays'];

    $sqlcid = "select tablect, tablehachtoan from $GLOBALS[db_sp].categories where id = ".$cid;
    $rscid = $GLOBALS['sp']->getRow($sqlcid);
    $table = $rscid['tablect'];
    $tablehachtoan = $rscid['tablehachtoan'];
    
    if(!empty($table) && !empty($tablehachtoan)){
        if(!empty($fromDate)){
            $fromDate = explode('/',$fromDate);
            $datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
            $fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
            $whnhap .= ' and dated >= "'.$fromDate.'"';
        }
        if(!empty($toDate)){
            $toDate = explode('/',$toDate);
            $toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
            $whnhap .= ' and dated <= "'.$toDate.'"';
        }
        
        if(!empty($idtemgiay)){
            
            // Lấy giá trị tồn kho tháng nhỏ hơn gần nhất
            $sqltru1day = "select id, soluongton from $GLOBALS[db_sp].".$tablehachtoan." where idtemgiay = ".$idtemgiay." and dated < '".$datedauthang."' order by dated desc limit 1";
            $rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
            if($rstru1day['id'] > 0){
                $sltonsddk = $rstru1day['soluongton'];
            }
            // Lấy đơn giá trong danh mục theo idtemgiay
            $sqldg = "select dongia from $GLOBALS[db_sp].dm_temgiay where id = ".$idtemgiay;
            $dongia = $GLOBALS['sp']->getOne($sqldg);
            // Kiểm tra tồn tại trong table
            $sqlkt = "select id from $GLOBALS[db_sp].".$table." where idtemgiay = ".$idtemgiay." limit 1";
            $rskt = $GLOBALS['sp']->getRow($sqlkt);
            if(!empty($rskt)){
                if(empty($whnhap)){
                    // Lấy giá trị tồn kho hiện tại
                    $sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idtemgiay = ".$idtemgiay." and dated = '".$datedauthang."'";
                    $rsdate = $GLOBALS['sp']->getRow($sqldate);

                    $soluongnhap = $rsdate['soluongnhap'];
                    $soluongxuat = $rsdate['soluongxuat'];
                    $soluongton = round($sltonsddk + round($soluongnhap - $soluongxuat,3),3);
                    $dongiaton = round($soluongton * $dongia,3);

                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                else{
                    // Tổng nhập từ đầu tháng
                    $sqlnhaptndt = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemgiay = ".$idtemgiay." and type = 1 and trangthai = 2 and dated >= '".$datedauthang."' and dated < '".$fromDate."'";
                    $nhaptndt = $GLOBALS['sp']->getOne($sqlnhaptndt);
                    // Tổng xuất từ đầu tháng
                    $sqlxuattndt = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemgiay = ".$idtemgiay." and type = 2 and trangthai = 2 and datexuat >= '".$datedauthang."' and dated < '".$fromDate."'";
                    $xuattndt = $GLOBALS['sp']->getOne($sqlxuattndt);

                    $sltonsddk = round($sltonsddk + round($nhaptndt - $xuattndt,3),3);
                    // Tổng nhập từ ngày đến ngày
                    $sqlnhap = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemgiay = ".$idtemgiay." and type = 1 and trangthai = 2 and dated >= '".$fromDate."' and dated <= '".$toDate."'";
                    $soluongnhap = $GLOBALS['sp']->getOne($sqlnhap);
                    // Tổng xuất từ ngày đến ngày
                    $sqlxuat = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemgiay = ".$idtemgiay." and type = 2 and trangthai = 2 and datexuat >= '".$fromDate."' and dated <= '".$toDate."'";
                    $soluongxuat = $GLOBALS['sp']->getOne($sqlxuat);

                    $soluongton = round($sltonsddk + round($soluongnhap - $soluongxuat,3),3);
                    $dongiaton = round($soluongton * $dongia,3);

                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                $arrlist['idtemgiay'] = $idtemgiay;
            }
        }
        else{
            $arrlist['idtemgiay'] = 0;
        }
    }
    else{
        die('Table này chưa được thêm, vui lòng liên hệ admin để được xử lý.');
    }
    return $arrlist;
}

function thongKeTonKhoChiTietDaTemGiay($cid, $idtemgiay, $fromDate, $toDate){
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $datedauthang = date('Y-m-01');
    $arrlist = array();
    $whnhap = $sqlcid = $rscid = $sqltru1day = $rstru1day = $sqldate = $rsdate = $sqlnhaptndt = $sqlxuattndt = $sqlnhap = $sqlxuat = '';
    $soluongnhap = $soluongxuat = $soluongton = $dongiaton = $sltonsddk = 0;
    // Lấy cid hiện tại
    $sqlcid = "select tablect, tablehachtoan from $GLOBALS[db_sp].categories where id = ".$cid;
    $rscid = $GLOBALS['sp']->getRow($sqlcid);
    $table = $rscid['tablect'];
    $tablehachtoan = $rscid['tablehachtoan'];

    if(!empty($table) && !empty($tablehachtoan)){
        if(!empty($fromDate)){
            $fromDate = explode('/',$fromDate);
            $datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
            $fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
            $whnhap .= ' and dated >= "'.$fromDate.'"';
        }
        if(!empty($toDate)){
            $toDate = explode('/',$toDate);
            $toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
            $whnhap .= ' and dated <= "'.$toDate.'"';
        }
        if($idtemgiay > 0){
            // Lấy tồn kho tháng nhỏ gần nhất tháng hiện tại
            $sqltru1day = "select id, soluongton from $GLOBALS[db_sp].".$tablehachtoan." where idtemgiay = ".$idtemgiay." and dated < '".$datedauthang."' order by dated desc limit 1";
            $rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
            if($rstru1day['id'] > 0){
                $sltonsddk = $rstru1day['soluongton'];
            }
            // Lấy giá trị đơn giá trong danh mục tem giấy tương ứng idtemgiay
            $sqldg = "select dongia from $GLOBALS[db_sp].dm_temgiay where id = ".$idtemgiay;
            $dongia = $GLOBALS['sp']->getOne($sqldg);
            // Kiểm tra tồn tại giá trị
            $sqlkt =  "select id from $GLOBALS[db_sp].".$table." where idtemgiay = ".$idtemgiay." limit 1";
            $rskt = $GLOBALS['sp']->getRow($sqlkt);
            if(!empty($rskt)){
                if(empty($whnhap)){
                    $sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idtemgiay = ".$idtemgiay." and dated = '".$datedauthang."'";
                    $rsdate = $GLOBALS['sp']->getRow($sqldate);

                    $soluongnhap = $rsdate['soluongnhap'];
                    $soluongxuat = $rsdate['soluongxuat'];
                    $soluongton = round($sltonsddk + round($soluongnhap - $soluongxuat,3),3);
                    $dongiaton = round($soluongton * $dongia,3);

                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                else{
                    // Tổng nhập từ đầu tháng
                    $sqlnhaptndt = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemgiay = ".$idtemgiay." and type = 1 and trangthai = 2 and dated >= '".$datedauthang."' and dated < '".$fromDate."'";
                    $nhaptndt = $GLOBALS['sp']->getOne($sqlnhaptndt);
                    // Tổng xuất từ đầu tháng
                    $sqlxuattndt = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemgiay = ".$idtemgiay." and type = 2 and trangthai = 2 and datexuat >= '".$datedauthang."' and datexuat < '".$fromDate."'";
                    $xuattndt = $GLOBALS['sp']->getOne($sqlxuattndt);

                    $sltonsddk = round($sltonsddk + round($nhaptndt - $xuattndt,3),3);
                    // Tổng nhập từ ngày đến ngày
                    $sqlnhap = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemgiay = ".$idtemgiay." and type = 1 and trangthai = 2 and dated >= '".$fromDate."' and dated <= '".$toDate."'";
                    $soluongnhap = $GLOBALS['sp']->getOne($sqlnhap);
                    // Tổng xuất từ ngày đến ngày
                    $sqlxuat = "select ROUND(SUM(soluong),3) from $GLOBALS[db_sp].".$table." where idtemgiay = ".$idtemgiay." and type = 2 and trangthai = 2 and datexuat >= '".$fromDate."' and datexuat <= '".$toDate."'";
                    $soluongxuat = $GLOBALS['sp']->getOne($sqlxuat);

                    $soluongton = round($sltonsddk + round($soluongnhap - $soluongxuat,3),3);
                    $dongiaton = round($soluongton * $dongia,3);

                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                $arrlist['idtemgiay'] = $idtemgiay;
            }
        }
        else{
            $arrlist['idtemgiay'] = 0;
        }
    }
    else{
        die('Table này chưa được thêm, vui lòng liên hệ admin để được xử lý.');
    }
    return $arrlist;
}
// ================= Anh Vũ Thêm - End Tồn Kho Chi Tiết - Đá - Tem Giấy ==================

// === ANH VŨ BEGIN TỒN KHO CHI TIẾT ĐÁ TEM ĐÁ ===

function insert_thongKeTonKhoChiTietDaTemDa($a){
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $datedauthang = date("Y").'-'.date("m").'-01';
    $arrlist = array();
    $whnhap = $sqlcid = $rscid = $sqltru1day = $rstru1day = $sqlkt = $rskt = $sqldate = $rsdate = '';
    $soluongnhap = $soluongxuat = $soluongton = $dongiaton = $sltonsddk = $dgtonsddk = 0;

    $cid = ceil(trim($a['cid']));
	$idda = ceil(trim($a['idda']));
	$fromDate = $a['fromdays'];
    $toDate = $a['todays'];
    
    // Lấy cid hiện tại
    $sqlcid = "select tablect, tablehachtoan from $GLOBALS[db_sp].categories where id = ".$cid;
    $rscid = $GLOBALS['sp']->getRow($sqlcid);
    $table = $rscid['tablect'];
    $tablehachtoan = $rscid['tablehachtoan'];

    if(!empty($table) && !empty($tablehachtoan)){
        if(!empty($fromDate)){
            $fromDate = explode('/',$fromDate);
            $datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
            $fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
            $whnhap .= ' and dated >= "'.$fromDate.'"';
        }
        if(!empty($toDate)){
            $toDate = explode('/',$toDate);
            $toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
            $whnhap .= ' and dated <= "'.$toDate.'"';
        }
        if($idda > 0){
            // Lấy tồn kho tháng nhỏ hơn gần nhất
            $sqltru1day = "select id, soluongton from $GLOBALS[db_sp].".$tablehachtoan." where idda = ".$idda." and dated < '".$datedauthang."' order by dated desc limit 1";
            $rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
            if($rstru1day['id'] > 0){
                $sltonsddk = $rstru1day['soluongton'];
            }
            // Kiểm tra tồn tại giá trị
            $sqlkt = "select id, dongiada from $GLOBALS[db_sp].".$table." where idda = ".$idda." limit 1";
            $rskt = $GLOBALS['sp']->getRow($sqlkt);
            $dongiada = $rskt['dongiada'];
            if(!empty($rskt)){
                if(empty($whnhap)){
                    $sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idda = ".$idda." and dated = '".$datedauthang."' ";
                    $rsdate = $GLOBALS['sp']->getRow($sqldate);

                    $soluongnhap = $rsdate['soluongnhap'];
                    $soluongxuat = $rsdate['soluongxuat'];
                    $soluongton = $rsdate['soluongton'];
                    $dongiaton = $rsdate['dongiaton'];

                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                else{
                    // Tổng nhập từ đầu tháng
                    $sqlnhaptndt = "select ROUND(SUM(soluongda),3) from $GLOBALS[db_sp].".$table." where idda = ".$idda." and type = 1 and trangthai in(1,2) and dated >= '".$datedauthang."' and dated < '".$fromDate."' ";
                    $nhaptndt = $GLOBALS['sp']->getOne($sqlnhaptndt);
                    // Tổng xuất từ đầu tháng
                    $sqlxuattndt = "select ROUND(SUM(soluongda),3) from $GLOBALS[db_sp].".$table." where idda = ".$idda." and type = 2 and trangthai = 2 and datexuat >= '".$datedauthang."' and datexuat < '".$fromDate."' ";
                    $xuattndt = $GLOBALS['sp']->getOne($sqlxuattndt);

                    $sltonsddk = round($sltonsddk + round($nhaptndt - $xuattndt,3),3);

                    // Tổng nhập từ ngày đến ngày
                    $sqlnhap = "select ROUND(SUM(soluongda),3) from $GLOBALS[db_sp].".$table." where idda = ".$idda." and type = 1 and trangthai in(1,2) and dated >= '".$fromDate."' and dated <= '".$toDate."'";
                    $soluongnhap = $GLOBALS['sp']->getOne($sqlnhap);
                    // Tổng xuất từ ngày đến ngày 
                    $sqlxuat = "select ROUND(SUM(soluongda),3) from $GLOBALS[db_sp].".$table." where idda = ".$idda." and type = 2 and trangthai = 2 and datexuat >= '".$fromDate."' and datexuat <= '".$toDate."'";
                    $soluongxuat = $GLOBALS['sp']->getOne($sqlxuat);

                    $soluongton = round($sltonsddk + round($soluongnhap - $soluongxuat,3),3);
                    $dongiaton = round($soluongton * $dongiada,3);
                    
                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                $arrlist['idda'] = $idda;
            }
        }
        else{
            $arrlist['idda'] = 0;
        }
    }
    else{
        die('Table này chưa được thêm, vui lòng liên hệ admin để được xử lý.');
    }
    return $arrlist;
}
// === ANH VŨ END TỒN KHO CHI TIẾT ĐÁ TEM ĐÁ ===

// === ANH VŨ BEGIN PRINT TỒN KHO CHI TIẾT ĐÁ TEM ĐÁ ===
function thongKeTonKhoChiTietDaTemDa($cid, $idda, $fromDate, $toDate){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
    $datedauthang = date("Y").'-'.date("m").'-01';
    $arrlist = array();
    $whnhap = $sqlcid = $rscid = $sqltru1day = $rstru1day = $sqlkt = $rskt = $sqldate = $rsdate = '';
    $soluongnhap = $soluongxuat = $soluongton = $dongiaton = $sltonsddk = $dgtonsddk = 0;

    // $cid = ceil(trim($a['cid']));
	// $idda = ceil(trim($a['idda']));
	// $fromDate = $a['fromdays'];
    // $toDate = $a['todays'];
    
    // Lấy cid hiện tại
    $sqlcid = "select tablect, tablehachtoan from $GLOBALS[db_sp].categories where id = ".$cid;
    $rscid = $GLOBALS['sp']->getRow($sqlcid);
    $table = $rscid['tablect'];
    $tablehachtoan = $rscid['tablehachtoan'];

    if(!empty($table) && !empty($tablehachtoan)){
        if(!empty($fromDate)){
            $fromDate = explode('/',$fromDate);
            $datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
            $fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
            $whnhap .= ' and dated >= "'.$fromDate.'"';
        }
        if(!empty($toDate)){
            $toDate = explode('/',$toDate);
            $toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
            $whnhap .= ' and dated <= "'.$toDate.'"';
        }
        if($idda > 0){
            // Lấy tồn kho tháng nhỏ hơn gần nhất
            $sqltru1day = "select id, soluongton from $GLOBALS[db_sp].".$tablehachtoan." where idda = ".$idda." and dated < '".$datedauthang."' order by dated desc limit 1";
            $rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
            if($rstru1day['id'] > 0){
                $sltonsddk = $rstru1day['soluongton'];
            }
            // Kiểm tra tồn tại giá trị
            $sqlkt = "select id, dongiada from $GLOBALS[db_sp].".$table." where idda = ".$idda." limit 1";
            $rskt = $GLOBALS['sp']->getRow($sqlkt);
            $dongiada = $rskt['dongiada'];
            if(!empty($rskt)){
                if(empty($whnhap)){
                    $sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idda = ".$idda." and dated = '".$datedauthang."' ";
                    $rsdate = $GLOBALS['sp']->getRow($sqldate);

                    $soluongnhap = $rsdate['soluongnhap'];
                    $soluongxuat = $rsdate['soluongxuat'];
                    $soluongton = $rsdate['soluongton'];
                    $dongiaton = $rsdate['dongiaton'];

                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                else{
                    // Tổng nhập từ đầu tháng
                    $sqlnhaptndt = "select ROUND(SUM(soluongda),3) from $GLOBALS[db_sp].".$table." where idda = ".$idda." and type = 1 and trangthai in(1,2) and dated >= '".$datedauthang."' and dated < '".$fromDate."' ";
                    $nhaptndt = $GLOBALS['sp']->getOne($sqlnhaptndt);
                    // Tổng xuất từ đầu tháng
                    $sqlxuattndt = "select ROUND(SUM(soluongda),3) from $GLOBALS[db_sp].".$table." where idda = ".$idda." and type = 2 and trangthai = 2 and datexuat >= '".$datedauthang."' and datexuat < '".$fromDate."' ";
                    $xuattndt = $GLOBALS['sp']->getOne($sqlxuattndt);

                    $sltonsddk = round($sltonsddk + round($nhaptndt - $xuattndt,3),3);

                    // Tổng nhập từ ngày đến ngày
                    $sqlnhap = "select ROUND(SUM(soluongda),3) from $GLOBALS[db_sp].".$table." where idda = ".$idda." and type = 1 and trangthai in(1,2) and dated >= '".$fromDate."' and dated <= '".$toDate."'";
                    $soluongnhap = $GLOBALS['sp']->getOne($sqlnhap);
                    // Tổng xuất từ ngày đến ngày 
                    $sqlxuat = "select ROUND(SUM(soluongda),3) from $GLOBALS[db_sp].".$table." where idda = ".$idda." and type = 2 and trangthai = 2 and datexuat >= '".$fromDate."' and datexuat <= '".$toDate."'";
                    $soluongxuat = $GLOBALS['sp']->getOne($sqlxuat);

                    $soluongton = round($sltonsddk + round($soluongnhap - $soluongxuat,3),3);
                    $dongiaton = round($soluongton * $dongiada,3);
                    
                    $arrlist['sltonsddk'] = $sltonsddk;
                    $arrlist['soluongnhap'] = $soluongnhap;
                    $arrlist['soluongxuat'] = $soluongxuat;
                    $arrlist['soluongton'] = $soluongton;
                    $arrlist['dongiaton'] = $dongiaton;
                }
                $arrlist['idda'] = $idda;
            }
        }
        else{
            $arrlist['idda'] = 0;
        }
    }
    else{
        die('Table này chưa được thêm, vui lòng liên hệ admin để được xử lý.');
    }
    return $arrlist;
}
// === ANH VŨ END PRINT TỒN KHO CHI TIẾT ĐÁ TEM ĐÁ ===

// --- ANH VŨ BEGIN ĐIỀU CHỈNH SỐ LIỆU ĐÁ TEM ĐÁ TỰ ĐỘNG ---------------------------------------

function dieuChinhSoLieuHachToanDaTemDa($table, $idda){
    $sql = "select dated from $GLOBALS[db_sp].".$table."_sodudauky where idda = ".$idda." order by dated desc limit 2";
    $rs = $GLOBALS['sp']->getAll($sql);
    for($i = ceil(count($rs))-1; $i >= 0; $i--){
        $arr = $arrNext = array();
        // Tính date đầu tháng, date cuối tháng ứng với lần chạy $i
        $dateFirst = $rs[$i]['dated'];
        $arrMonth = explode('-',$dateFirst);
        $dateLast = $arrMonth[0].'-'.$arrMonth[1].'-31';

        // Tổng Nhập Table hiện tại
        $sqlNhap = "select ROUND(SUM(soluongda),3) as soluongda, 
                            ROUND(SUM(tongtienda),3) as tongtienda 
                            from $GLOBALS[db_sp].".$table." 
                            where idda = ".$idda." 
                            and dated >= '".$dateFirst."' 
                            and dated <= '".$dateLast."' 
                            and type = 1 
                            and trangthai in(1,2) ";
        $rsNhap = $GLOBALS['sp']->getRow($sqlNhap);
        $soluongnhap = $rsNhap['soluongda'];
        $dongianhap = $rsNhap['tongtienda'];
        // Tổng Xuất Table hiện tại
        $sqlXuat = "select ROUND(SUM(soluongda),3) as soluongda, 
                            ROUND(SUM(tongtienda),3) as tongtienda 
                            from $GLOBALS[db_sp].".$table." 
                            where idda = ".$idda." 
                            and datexuat >= '".$dateFirst."' 
                            and datexuat <= '".$dateLast."' 
                            and type = 2 
                            and trangthai = 2 ";
        $rsXuat = $GLOBALS['sp']->getRow($sqlXuat);
        $soluongxuat = $rsXuat['soluongda'];
        $dongiaxuat = $rsXuat['tongtienda'];

        // Điều kiện tồn tại giá trị 
        if($soluongnhap != 0 || $soluongxuat != 0){
            $checkSaiSoNX = 0;
            // Tablehachtoan hiện tại
            $sqldate = "select * from $GLOBALS[db_sp].".$table."_sodudauky where idda = ".$idda." and dated = '".$dateFirst."'";
            $rsdate = $GLOBALS['sp']->getRow($sqldate);
            if($soluongnhap != $rsdate['soluongnhap'] || $dongianhap != $rsdate['dongianhap']){
                $arr['soluongnhap'] = $soluongnhap;
                $arr['dongianhap'] = $dongianhap;
                $checkSaiSoNX = 1;
            }
            if($soluongxuat != $rsdate['soluongxuat'] || $dongiaxuat != $rsdate['dongiaxuat']){
                $arr['soluongxuat'] = $soluongxuat;
                $arr['dongiaxuat'] = $dongiaxuat;
                $checkSaiSoNX = 1;
            }
            if($checkSaiSoNX == 1){
                // Lấy tồn kho tháng nhỏ hơn gần nhất 
                $sqldatett = "select soluongton, dongiaton from $GLOBALS[db_sp].".$table."_sodudauky where idda = ".$idda." and dated < '".$dateFirst."' order by dated desc limit 1";
                $rstt = $GLOBALS['sp']->getRow($sqldatett);
                $soluongton = round($rstt['soluongton'] + round($soluongnhap - $soluongxuat,3),3);
                $dongiaton = round($rstt['dongiaton'] + round($dongianhap - $dongiaxuat,3),3);
                $arr['soluongton'] = $soluongton;
                $arr['dongiaton'] = $dongiaton;
                vaUpdate($table.'_sodudauky', $arr, ' idda = '.$idda.' and dated = "'.$dateFirst.'"');
                
                //Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
                $dateFirstNext = $rs[$i-1]['dated'];
                if(!empty($dateFirstNext)){
                    // Tính ngày cuối tháng của tháng tiếp theo
					$arrMonthNext = explode('-',$dateFirstNext);
                    $dateLastNext = $arrMonthNext[0].'-'.$arrMonthNext[1].'-31';

                    $sqlNhapNext = "select ROUND(SUM(soluongda), 3) as soluongda, ROUND(SUM(tongtienda), 3) as tongtienda from $GLOBALS[db_sp].".$table." where type = 1 and trangthai > 0 and idda = ".$idda." and dated >= '".$dateFirstNext."' and dated <= '".$dateLastNext."'";
                    $rsNhapNext = $GLOBALS['sp']->getRow($sqlNhapNext);
                    if($rsNhapNext['soluongda'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrNext['soluongnhap'] = $rsNhapNext['soluongda'];
						$arrNext['dongianhap'] = $rsNhapNext['tongtienda'];
                    }
                    $sqlXuatNext = "select ROUND(SUM(soluongda), 3) as soluongda, ROUND(SUM(tongtienda), 3) as tongtienda from $GLOBALS[db_sp].".$table." where type = 2 and trangthai = 2 and idda = ".$idda." and datexuat >= '".$dateFirstNext."' and datexuat <= '".$dateLastNext."'";
                    $rsXuatNext = $GLOBALS['sp']->getRow($sqlXuatNext);
                    if($rsXuatNext['soluongda'] != 0) { // != 0 là tháng tiếp theo có nhập
						$arrNext['soluongnhap'] = $rsXuatNext['soluongda'];
						$arrNext['dongianhap'] = $rsXuatNext['tongtienda'];
                    }
                    // Update soluongton của tháng tiếp theo
                    $arrNext['soluongton'] = round(round(($soluongton + $rsNhapNext['soluongda']),3) - $rsXuatNext['soluongda'],3);
					$arrNext['dongiaton'] = round(round(($dongiaton + $rsNhapNext['tongtienda']),3) - $rsXuatNext['tongtienda'],3);

					vaUpdate($table.'_sodudauky', $arrNext, ' idda='.$idda.' and dated="'.$dateFirstNext.'"');
                }
            }
        }
    }
}
// --- ANH VŨ END ĐIỀU CHỈNH SỐ LIỆU ĐÁ TEM ĐÁ TỰ ĐỘNG ---------------------------------------

// --- ANH VŨ BEGIN ĐIỀU CHỈNH SỐ LIỆU GIẤY TEM ĐÁ TỰ ĐỘNG ---------------------------------------
function dieuChinhSoLieuHachToanDaTemGiay($table,$idtemgiay,$dongia){
    $sql = "select dated from $GLOBALS[db_sp].".$table."_sodudauky where idtemgiay = $idtemgiay order by dated desc limit 2";
    $rs = $GLOBALS['sp']->getAll($sql);
    
    for($i=ceil(count($rs))-1; $i >= 0; $i--){
        $arr = $arrNext = array();
        $soluongtonthangtruoc = $dongiatonthangtruoc = 0;
        
        $dateFirst = $rs[$i]['dated'];
        $arrMonth = explode('-',$dateFirst);
        $dateLast = $arrMonth[0].'-'.$arrMonth[1].'-31';

        $sqlSumNhap = "select ROUND(SUM(soluong),3) as soluong from $GLOBALS[db_sp].$table where type = 1 and trangthai = 2 and idtemgiay = $idtemgiay and dated >= '".$dateFirst."' and dated <= '".$dateLast."'";
        $rsSumNhap = $GLOBALS['sp']->getOne($sqlSumNhap);
        $dongianhap = round($rsSumNhap * $dongia,3);
        
        $sqlSumXuat = "select ROUND(SUM(soluong),3) as soluong from $GLOBALS[db_sp].$table where type = 2 and trangthai = 2 and idtemgiay = $idtemgiay and datexuat >= '".$dateFirst."' and datexuat <= '".$dateLast."'";
        $rsSumXuat = $GLOBALS['sp']->getOne($sqlSumXuat);
        $dongiaxuat = round($rsSumXuat * $dongia,3);
        
        if($rsSumNhap != 0 || $rsSumXuat != 0){
            $checkSaiSoNX = 0;

            $sqlSddk = "select soluongnhap,soluongxuat,dongianhap,dongiaxuat from $GLOBALS[db_sp].".$table."_sodudauky where idtemgiay = $idtemgiay and dated = '".$dateFirst."'";
            $rsSddk = $GLOBALS['sp']->getRow($sqlSddk);
           
            if($rsSumNhap != $rsSddk['soluongnhap'] || $dongianhap != $rsSddk['dongianhap']){
                $arr['soluongnhap'] = $rsSumNhap;
                $arr['dongianhap'] = $dongianhap;
                $checkSaiSoNX = 1;
            }
            if($rsSumXuat != $rsSddk['soluongxuat'] || $dongiaxuat != $rsSddk['dongiaxuat']){
                $arr['soluongxuat'] = $rsSumXuat;
                $arr['dongiaxuat'] = $dongiaxuat;
                $checkSaiSoNX = 1;
            }
            
            if($checkSaiSoNX == 1){
                $sqlSddkThangTruoc = "select soluongton,dongiaton from $GLOBALS[db_sp].".$table."_sodudauky where idtemgiay = ".$idtemgiay." and dated < '".$dateFirst."' order by dated desc limit 1";
                $rsSddkThangTruoc = $GLOBALS['sp']->getRow($sqlSddkThangTruoc);
                if($rsSddkThangTruoc > 0){
                    $soluongtonthangtruoc = $rsSddkThangTruoc['soluongton'];
                    $dongiatonthangtruoc = $rsSddkThangTruoc['dongiaton'];
                }
                $soluongton = round(round($soluongtonthangtruoc + $rsSumNhap,3) - $rsSumXuat,3);
                $dongiaton = round(round($dongiatonthangtruoc + $dongianhap,3) - $dongiaxuat,3);
                $arr['soluongton'] = $soluongton;
                $arr['dongiaton'] = $dongiaton;
                vaUpdate($table.'_sodudauky',$arr,' idtemgiay = '.$idtemgiay.' and dated = "'.$dateFirst.'"');
                // Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
                $dateFirstNext = $rs[$i-1]['dated'];
                
                if(!empty($dateFirstNext)){
                    $arrMonthNext = explode('-',$dateFirstNext);
                    $dateLastNext = $arrMonthNext[0].'-'.$arrMonthNext[1].'-31';

                    // Tổng Nhập Tháng Tiếp Theo
                    $sqlSumNhapNext = "select ROUND(SUM(soluong),3) as soluong from $GLOBALS[db_sp].$table where type = 1 and trangthai = 2 and idtemgiay = $idtemgiay and dated >= '".$dateFirstNext."' and dated <= '".$dateLastNext."'";
                    $rsSumNhapNext = $GLOBALS['sp']->getOne($sqlSumNhapNext);
                    $dongianhapNext = round($rsSumNhapNext * $dongia,3);

                    if($rsSumNhapNext != 0){
                        $arrNext['soluongnhap'] = $rsSumNhapNext;
                        $arrNext['dongianhap'] = $dongianhapNext;
                    }
                    // Tổng Xuất Tháng Tiếp Theo
                    $sqlSumXuatNext = "select ROUND(SUM(soluong),3) as soluong from $GLOBALS[db_sp].$table where type = 2 and trangthai = 2 and idtemgiay = $idtemgiay and dated >= '".$dateFirstNext."' and dated <= '".$dateLastNext."'";
                    $rsSumXuatNext = $GLOBALS['sp']->getOne($sqlSumXuatNext);
                    $dongiaxuatNext = round($rsSumXuatNext * $dongia);

                    if($rsSumXuatNext != 0){
                        $arrNext['soluongxuat'] = $rsSumXuatNext;
                        $arrNext['dongiaxuat'] = $dongiaxuatNext;
                    }
                    $arrNext['soluongton'] = round(round($soluongton + $rsSumNhapNext,3) - $rsSumXuatNext,3);
                    $arrNext['dongiaton'] = round(round($dongiaton + $dongianhapNext,3) - $dongiaxuatNext,3);

                    vaUpdate($table.'_sodudauky',$arrNext,' idtemgiay = '.$idtemgiay.' and dated = "'.$dateFirstNext.'"');
                }
            }
        }
    }
}
// --- ANH VŨ END ĐIỀU CHỈNH SỐ LIỆU ĐÁ TEM GIẤY TỰ ĐỘNG ---------------------------------------

// --- ANH VŨ BEGIN ĐIỀU CHỈNH SỐ LIỆU HỘP TEM ĐÁ TỰ ĐỘNG ---------------------------------------
function dieuChinhSoLieuHachToanDaTemHop($table,$idtemhop,$dongia){
    $sql = "select dated from $GLOBALS[db_sp].".$table."_sodudauky where idtemhop = $idtemhop order by dated desc limit 2";
    $rs = $GLOBALS['sp']->getAll($sql);
    
    for($i=ceil(count($rs))-1; $i >= 0; $i--){
        $arr = $arrNext = array();
        $soluongtonthangtruoc = $dongiatonthangtruoc = 0;

        $dateFirst = $rs[$i]['dated'];
        $arrMonth = explode('-',$dateFirst);
        $dateLast = $arrMonth[0].'-'.$arrMonth[1].'-31';

        $sqlSumNhap = "select ROUND(SUM(soluong),3) as soluong from $GLOBALS[db_sp].$table where type = 1 and trangthai = 2 and idtemhop = $idtemhop and dated >= '".$dateFirst."' and dated <= '".$dateLast."'";
        $rsSumNhap = $GLOBALS['sp']->getOne($sqlSumNhap);
        $dongianhap = round($rsSumNhap * $dongia,3);
        
        $sqlSumXuat = "select ROUND(SUM(soluong),3) as soluong from $GLOBALS[db_sp].$table where type = 2 and trangthai = 2 and idtemhop = $idtemhop and dated >= '".$dateFirst."' and dated <= '".$dateLast."'";
        $rsSumXuat = $GLOBALS['sp']->getOne($sqlSumXuat);
        $dongiaxuat = round($rsSumXuat * $dongia,3);
        
        if($rsSumNhap != 0 || $rsSumXuat != 0){
            $checkSaiSoNX = 0;

            $sqlSddk = "select soluongnhap,soluongxuat,dongianhap,dongiaxuat from $GLOBALS[db_sp].".$table."_sodudauky where idtemhop = $idtemhop and dated = '".$dateFirst."'";
            $rsSddk = $GLOBALS['sp']->getRow($sqlSddk);
           
            if($rsSumNhap != $rsSddk['soluongnhap'] || $dongianhap != $rsSddk['dongianhap']){
                $arr['soluongnhap'] = $rsSumNhap;
                $arr['dongianhap'] = $dongianhap;
                $checkSaiSoNX = 1;
            }
            if($rsSumXuat != $rsSddk['soluongxuat'] || $dongiaxuat != $rsSddk['dongiaxuat']){
                $arr['soluongxuat'] = $rsSumXuat;
                $arr['dongiaxuat'] = $dongiaxuat;
                $checkSaiSoNX = 1;
            }
            
            if($checkSaiSoNX == 1){
                $sqlSddkThangTruoc = "select soluongton,dongiaton from $GLOBALS[db_sp].".$table."_sodudauky where idtemhop = ".$idtemhop." and dated < '".$dateFirst."' order by dated desc limit 1";
                $rsSddkThangTruoc = $GLOBALS['sp']->getRow($sqlSddkThangTruoc);
                if($rsSddkThangTruoc > 0){
                    $soluongtonthangtruoc = $rsSddkThangTruoc['soluongton'];
                    $dongiatonthangtruoc = $rsSddkThangTruoc['dongiaton'];
                }
                $soluongton = round(round($soluongtonthangtruoc + $rsSumNhap,3) - $rsSumXuat,3);
                $dongiaton = round(round($dongiatonthangtruoc + $dongianhap,3) - $dongiaxuat,3);
                $arr['soluongton'] = $soluongton;
                $arr['dongiaton'] = $dongiaton;

                vaUpdate($table.'_sodudauky',$arr,' idtemhop = '.$idtemhop.' and dated = "'.$dateFirst.'"');
                // Kiểm tra Tháng vòng lặp lần 2 (Tháng tiếp theo có hạch toán) có tồn tại không
                $dateFirstNext = $rs[$i-1]['dated'];
                
                if(!empty($dateFirstNext)){
                    $arrMonthNext = explode('-',$dateFirstNext);
                    $dateLastNext = $arrMonthNext[0].'-'.$arrMonthNext[1].'-31';

                    // Tổng Nhập Tháng Tiếp Theo
                    $sqlSumNhapNext = "select ROUND(SUM(soluong),3) as soluong from $GLOBALS[db_sp].$table where type = 1 and trangthai = 2 and idtemhop = $idtemhop and dated >= '".$dateFirstNext."' and dated <= '".$dateLastNext."'";
                    $rsSumNhapNext = $GLOBALS['sp']->getOne($sqlSumNhapNext);
                    $dongianhapNext = round($rsSumNhapNext * $dongia,3);

                    if($rsSumNhapNext != 0){
                        $arrNext['soluongnhap'] = $rsSumNhapNext;
                        $arrNext['dongianhap'] = $dongianhapNext;
                    }
                    // Tổng Xuất Tháng Tiếp Theo
                    $sqlSumXuatNext = "select ROUND(SUM(soluong),3) as soluong from $GLOBALS[db_sp].$table where type = 2 and trangthai = 2 and idtemhop = $idtemhop and dated >= '".$dateFirstNext."' and dated <= '".$dateLastNext."'";
                    $rsSumXuatNext = $GLOBALS['sp']->getOne($sqlSumXuatNext);
                    $dongiaxuatNext = round($rsSumXuatNext * $dongia);

                    if($rsSumXuatNext != 0){
                        $arrNext['soluongxuat'] = $rsSumXuatNext;
                        $arrNext['dongiaxuat'] = $dongiaxuatNext;
                    }
                    $arrNext['soluongton'] = round(round($soluongton + $rsSumNhapNext,3) - $rsSumXuatNext,3);
                    $arrNext['dongiaton'] = round(round($dongiaton + $dongianhapNext,3) - $dongiaxuatNext,3);

                    vaUpdate($table.'_sodudauky',$arrNext,' idtemhop = '.$idtemhop.' and dated = "'.$dateFirstNext.'"');
                }
            }
        }
    }
}
// --- ANH VŨ END ĐIỀU CHỈNH SỐ LIỆU ĐÁ TEM HỘP TỰ ĐỘNG ---------------------------------------
//=============================FUNCTIONS OTHER===============================================//
    //======================//
	function getLinkTitleKhoShort1($id,$type){
		$title = '';
		$title = getLinkTitle($id,$type);
		$title = explode('&raquo;',$title);
		$title = $title[0].' &raquo; '. $title[1];
		return $title;
    }
    
    // === Anh Vũ thêm set trang thai tem da
    function insert_getTrangThaiTemDa($a){
        $idctnx = ceil($a['idctnx']);
        $result = 1;
        if($idctnx > 0){
            $sql = "select SUM(trangthai) from $GLOBALS[db_sp].da_temda where idctnx = ".$idctnx;
            $result = $GLOBALS["sp"]->getOne($sql);
        }
        return $result;
    }
    // === Anh Vũ kết thúc thêm

    function insert_getDm($a){
        $mada = ceil($a['mada']);
        if($mada > 0){
            $sql = "select id from $GLOBALS[db_sp].dm_temgiay where code like '%".$mada."%'";
            $rs = $GLOBALS['sp']->getOne($sql);
        }
        if($rs > 0){
            return $rs;
        }
    }
//==========================KẾT THÚC FUNCTIONS OTHER========================================//
?>