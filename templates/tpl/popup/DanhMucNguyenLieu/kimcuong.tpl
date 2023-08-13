<div class="main-popup">
	<div class="box-thongin box-thongin-popup">
    <div class="title-thongtin ">Nhóm Nguyên Liệu</div>
    
    <h2 style="margin-top:20px;">Nguyên Liệu Kim Cương</h2>
    <div class="SubAll">
        <div class="SubLeft">
            Nhóm Nguyên Liệu Kim Cương
        </div>
        <div class="SubRight">
            <select name='idnhomnguyenlieukimcuong' id='idnhomnguyenlieukimcuong' onchange="getTenNguyenLieuKimCuong(this.value)">
                <option value="0">---------Chọn Nhóm Nguyên liệu Kim Cương---------</option>
                <!--{section name=i loop=$nhomnguyenlieu}-->
                    <option <!--{if $nhomnguyenlieu[i].id eq $nhomnguyenlieukimcuongactive}-->selected="selected"<!--{/if}-->value="<!--{$nhomnguyenlieu[i].id}-->;<!--{$nhomnguyenlieu[i].name_vn}-->"> <!--{$nhomnguyenlieu[i].name_vn}--></option>
                <!--{/section}-->
            </select>
        </div>
    </div>
    <div class="clear"></div>
    <div class="SubAll">
        <div class="SubLeft">
            Tên Nguyên Liệu Kim Cương
        </div>
        <div class="SubRight">
            <select name='idtennguyenlieukimcuong' id='idtennguyenlieukimcuong'>  </select>
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
<!--{if $tennguyenlieukimcuongactive gt 0}-->
	$(document).ready(function() {
		getTenNguyenLieuKimCuong('<!--{$nhomnguyenlieukimcuongactive}-->','<!--{$tennguyenlieukimcuongactive}-->');
	});
<!--{/if}-->
function getTenNguyenLieuKimCuong(id,idselect){
	$.post('<!--{$path_url}-->/ajax/loadDanhMucNguyenLieu.php',{id:id,idselect:idselect},function(data) {
		 var obj = jQuery.parseJSON(data);
		 $('#idtennguyenlieukimcuong').html(obj.status);
	});
	return false;		
}

function resetdl(){
	var numdong = '<!--{$idshow}-->';
	$('#idnhomnguyenlieukimcuong').val(0); 
	$('#idtennguyenlieukimcuong').val(0);
	
	$('#nhomnguyenlieukimcuong'+numdong).val(0);
	$('#showtennhomnguyenlieukimcuong'+numdong).html('Click chọn');
	$('#tennguyenlieukimcuong'+numdong).val(0);
	$('#showtennguyenlieukimcuong'+numdong).html('');
	$.fancybox.close();	
}

function geteditDataBCTC(idshow){
	var nhomnguyenlieukimcuong = $('#idnhomnguyenlieukimcuong').val();
	if(nhomnguyenlieukimcuong != 0){
		var nhomnguyenlieukimcuongsplit = nhomnguyenlieukimcuong.split(';');
		var idnhomnguyenlieukimcuong = nhomnguyenlieukimcuongsplit[0];
		var showtennhomnguyenlieukimcuong = nhomnguyenlieukimcuongsplit[1];
		
		var tennguyenlieukimcuong = $('#idtennguyenlieukimcuong').val();
		var tennguyenlieukimcuongsplit = tennguyenlieukimcuong.split(';');
		var idtennguyenlieukimcuong = tennguyenlieukimcuongsplit[0];
		var showtennguyenlieukimcuong = tennguyenlieukimcuongsplit[1];
		
		$('#nhomnguyenlieukimcuong'+idshow).val(idnhomnguyenlieukimcuong);
		$('#showtennhomnguyenlieukimcuong'+idshow).html(showtennhomnguyenlieukimcuong);
		$('#tennguyenlieukimcuong'+idshow).val(idtennguyenlieukimcuong);
		$('#showtennguyenlieukimcuong'+idshow).html(showtennguyenlieukimcuong);
	}
	else{
		$('#nhomnguyenlieukimcuong'+idshow).val(0);
		$('#showtennhomnguyenlieukimcuong'+idshow).html('');
		$('#tennguyenlieukimcuong'+idshow).val(0);
		$('#showtennguyenlieukimcuong'+idshow).html('');	
	}	
	$.fancybox.close();
}
	
</script>