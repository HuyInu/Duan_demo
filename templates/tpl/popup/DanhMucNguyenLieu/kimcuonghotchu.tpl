<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/js/searchajax/search.css" />
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/jsapi.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/script.js"></script>
<div class="main-popup">
    <div class="box-thongin box-thongin-popup">
        <div class="title-thongtin ">Vui lòng chọn Tên Kim Cương</div>
        <div class="SubAll">
            <div class="SubLeft">
                Nhập chọn tên 
            </div>
            <div class="SubRight">
                <input autocomplete="off" class="InputText" type="text" placeholder="Nhập tìm kiếm ( mã đá hoặc tên đá ) " onkeyup="lookup('<!--{$path_url}-->','danhmuckimcuong',this.value);" />
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
		$('#idkimcuong'+numdong).val(0);
		$('#showtennkimcuong'+numdong).html('Click chọn Tên');
		$('#dongiaban'+numdong).val(0);
		$.fancybox.close();	
	}
	function searchDMKimCuong(iddmkc, tenkc, sizekc, giaban){
		var numdong = $('#numdong').val();
		$('#idkimcuong'+numdong).val(iddmkc);
		$('#showtennkimcuong'+numdong).html(sizekc+':'+tenkc);
		$('#dongiaban'+numdong).val(giaban);
		$.fancybox.close();	
	}
</script>