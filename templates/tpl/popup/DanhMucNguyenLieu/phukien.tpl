<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/js/searchajax/search.css" />
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/jsapi.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/script.js"></script>
<div class="main-popup">
    <div class="box-thongin box-thongin-popup">
        <div class="title-thongtin ">Vui lòng chọn mã phụ kiện</div>

        <div class="SubAll">
            <div class="SubLeft">
                Nhập chọn mã
            </div>
            <div class="SubRight">
                <input name="maphukien" id="maphukien" autocomplete="off" class="InputText" type="text" placeholder="Nhập tìm kiếm (mã phụ kiện hoặc tên phụ kiện) " onkeyup="lookup('<!--{$path_url}-->','danhmucphukien',this.value);" />
            </div>
            <div id="suggestions"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script>
	function insertPhuKien(idphukien, maphukien, tenphukien){
		$('#idphukien').val(idphukien);
		$('#maphukien').html(maphukien);
		$('#tenphukien').html(tenphukien);
		$.fancybox.close();	
	}
</script>