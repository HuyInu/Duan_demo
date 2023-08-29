<?php
include_once("../maininclude.php");
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";

switch($act) {
    case "SuaSoLieuHachToan":
		$rsGetLoaiVang = loaiVangSuaSoLieuHachToan();
		foreach ($rsGetLoaiVang as $itemLoaiVang) {
			giahuy_dieuChinhSoLieuHachToanKhoSanXuat('khosanxuat_khotest','khosanxuat_khotest_sodudauky' ,$itemLoaiVang['id']);

			// dieuChinhSoLieuHachToanHaoDuGiaoNhanThoNew('khosanxuat_khovmnthaodu','khosanxuat_khovmnt_sodudauky','giaonhanthohangngay_khosanxuat_khovmnt',$itemLoaiVang['id']);
		}
		echo "Điều chỉnh số liệu hạch toán thành công.";
	    break;
}
?>