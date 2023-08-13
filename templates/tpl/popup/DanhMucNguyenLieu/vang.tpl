<div class="main-popup">
	<div class="box-thongin box-thongin-popup">
    <div class="title-thongtin ">Nhóm Nguyên Liệu</div>
    <h2>Nguyên Liệu Vàng</h2>
    <div class="SubAll">
        <div class="SubLeft">
            Nhóm Nguyên Liệu Vàng
        </div>
        <div class="SubRight">
            <select name='idnhomnguyenlieuvang' id='idnhomnguyenlieuvang' onchange="getTenNguyenLieuVang(this.value)">
                <option value="0">---------Chọn Nhóm Nguyên liệu Vàng---------</option>
                <!--{section name=i loop=$nhomnguyenlieu}-->
                    <option <!--{if $nhomnguyenlieu[i].id eq $nhomnguyenlieuvangactive}-->selected="selected"<!--{/if}-->value="<!--{$nhomnguyenlieu[i].id}-->;<!--{$nhomnguyenlieu[i].name_vn}-->"> <!--{$nhomnguyenlieu[i].name_vn}--></option>
                <!--{/section}-->
            </select>
        </div>
    </div>
    <div class="clear"></div>
    <div class="SubAll">
        <div class="SubLeft">
            Tên Nguyên Liệu vàng
        </div>
        <div class="SubRight">
            <select name='idtennguyenlieuvang' id='idtennguyenlieuvang'>  </select>
        </div>
    </div>
    <div class="clear"></div>
    <div class="addRowGirlMain chonxong">
        <a href="javascript:void(0)" onclick="geteditDataBCTC('<!--{$idshow}-->')" class="addRowGirl"> <strong> Lưu </strong> </a>
        <a href="javascript:void(0)" onclick="resetdl()" class="addRowGirl" style="margin-left:10px;"> <strong> Làm mới </strong> </a>
    </div>
</div>
</div>
<script>
<!--{if $tennguyenlieuvangactive gt 0}-->
	
	$(document).ready(function() {				   
		getTenNguyenLieuVang('<!--{$nhomnguyenlieuvangactive}-->','<!--{$tennguyenlieuvangactive}-->');
	});
<!--{/if}-->
function getTenNguyenLieuVang(id,idselect){
	$.post('<!--{$path_url}-->/ajax/loadDanhMucNguyenLieu.php',{id:id,idselect:idselect},function(data) {
		 var obj = jQuery.parseJSON(data);
		 $('#idtennguyenlieuvang').html(obj.status);
	});
	return false;		
}

function resetdl(){
	var numdong = '<!--{$idshow}-->';
	$('#idnhomnguyenlieuvang').val(0); 
	$('#idtennguyenlieuvang').val(0);
	
	$('#nhomnguyenlieuvang'+numdong).val(0);
	$('#showtennhomnguyenlieuvang'+numdong).html('Click chọn');
	$('#tennguyenlieuvang'+numdong).val(0);
	$('#showtennguyenlieuvang'+numdong).html('');
	$.fancybox.close();	
}
	
function geteditDataBCTC(idshow){
	var nhomnguyenlieuvang = $('#idnhomnguyenlieuvang').val();
	if(nhomnguyenlieuvang != 0){
		var nhomnguyenlieuvangsplit = nhomnguyenlieuvang.split(';');
		var idnhomnguyenlieuvang = nhomnguyenlieuvangsplit[0];
		var showtennhomnguyenlieuvang = nhomnguyenlieuvangsplit[1];
		
		var tennguyenlieuvang = $('#idtennguyenlieuvang').val();
		var tennguyenlieuvangsplit = tennguyenlieuvang.split(';');
		var idtennguyenlieuvang = tennguyenlieuvangsplit[0];
		var showtennguyenlieuvang = tennguyenlieuvangsplit[1];
		
	
		$('#nhomnguyenlieuvang'+idshow).val(idnhomnguyenlieuvang);
		$('#showtennhomnguyenlieuvang'+idshow).html(showtennhomnguyenlieuvang);
		$('#tennguyenlieuvang'+idshow).val(idtennguyenlieuvang);
		$('#showtennguyenlieuvang'+idshow).html(showtennguyenlieuvang);
	}
	else{ //=0
		$('#nhomnguyenlieuvang'+idshow).val(0);
		$('#showtennhomnguyenlieuvang'+idshow).html('click chọn');
		$('#tennguyenlieuvang'+idshow).val(0);
		$('#showtennguyenlieuvang'+idshow).html('');	
	}

	$.fancybox.close();
}
	
</script>