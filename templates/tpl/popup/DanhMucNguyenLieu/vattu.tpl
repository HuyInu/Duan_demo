<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/js/searchajax/search.css" />
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/jsapi.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/script.js"></script>
<div class="main-popup">
    <div class="box-thongin box-thongin-popup">
        <div class="title-thongtin ">Vui lòng chọn mã vật tư</div>

        <div class="SubAll">
            <div class="SubLeft">
                Nhập chọn mã
            </div>
            <div class="SubRight">
                <input name="mavatdung" id="mavatdung" autocomplete="off" class="InputText" type="text" placeholder="Nhập tìm kiếm (mã vật tư hoặc tên vật tư) " onkeyup="lookupmavattu(this.value,'<!--{$numdong}-->','<!--{$path_url}-->');" />
            </div>
            <div id="suggestions"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script>
	function searchMavattu(idmavattu, mavattu, tenvattu, nhom, donvitinh, numdong){
		$('#idmavattu'+numdong).val(idmavattu);
		$('#mavattu'+numdong).html(mavattu);
		$('#tenvattu'+numdong).html(tenvattu);
        $('#nhom'+numdong).html(nhom);
		$('#donvitinh'+numdong).html(donvitinh);
		$.fancybox.close();	
	}
</script>