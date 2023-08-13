<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/js/searchajax/search.css" />
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/jsapi.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/script.js"></script>
<div class="main-popup">
    <div class="box-thongin box-thongin-popup">
        <div class="title-thongtin ">Vui lòng chọn Mã Phiếu</div>
        <div class="SubAll">
            <div class="SubLeft">
                Nhập chọn mã phiếu 
            </div>
            <div class="SubRight">
                <input autocomplete="off" class="InputText" type="text" placeholder="vd: PXKACHIN000001" onkeyup="lookup('<!--{$path_url}-->','phieuTongKhoDeCuc',this.value);" />
                <input type="hidden" id="numdong" value="<!--{$idshow}-->">
            </div>
            <div id="suggestions"></div>
        </div>
        <div class="clear"></div>
        <div class="addRowGirlMain chonxong">
            <a href="javascript:void(0)" onclick="resetdl()" class="addRowGirl"> <strong> Làm mới </strong> </a>
        </div>
    </div>
</div>
<script>
	function resetdl(){
		var numdong = $('#numdong').val();
		$('#idmaphieudecuc'+numdong).val('');
		$('#showtendecuc'+numdong).html('Click chọn Mã phiếu');
		$('#ttronluongdecuc'+numdong).val('');
		$('#slcannangvcondecuc'+numdong).val('');
		$('#slvangcondecuc'+numdong).val('');
		$('#tuoithuctedecuc'+numdong).val('');
		$('#slcannangvcatdecuc'+numdong).val('');
		$.fancybox.close();	
	}
	function searchPhieuTongKhoDeCuc(idmaphieu, maphieu, cannangv, slcannangvcon, tuoithucte){
		var numdong = $('#numdong').val();
		$('#idmaphieudecuc'+numdong).val(idmaphieu);
		$('#showtendecuc'+numdong).html(maphieu);
		$('#ttronluongdecuc'+numdong).val(formatNumberLloat(cannangv));
		$('#slcannangvcondecuc'+numdong).val(formatNumberLloat(slcannangvcon));
		$('#slvangcondecuc'+numdong).val(formatNumberLloat(slcannangvcon));
		$('#tuoithuctedecuc'+numdong).val(tuoithucte);
		$('#slcannangvcatdecuc'+numdong).val('');
		$.fancybox.close();	
	}
</script>