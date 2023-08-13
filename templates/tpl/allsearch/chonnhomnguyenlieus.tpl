<select class="selectOption" name="nhomnguyenlieus" id="nhomnguyenlieus" onchange="getTenNguyenLieu(this.value,0)">
    <option value="">---------All---------</option>
    <!--{section name=i loop=$nhomnguyenlieu}-->
    	<option <!--{if $nhomnguyenlieu[i].id eq $nhomnguyenlieus}-->selected="selected" <!--{/if}--> value="<!--{$nhomnguyenlieu[i].id}-->"> <!--{$nhomnguyenlieu[i].name_vn}--> </option>
     <!--{/section}-->
</select>
<script>
	<!--{if $nhomnguyenlieus gt 0}-->
		$(document).ready(function() {
			getTenNguyenLieu('<!--{$nhomnguyenlieus}-->','<!--{$tennguyenlieus}-->');
		});
	<!--{/if}-->

	function getTenNguyenLieu(id,idselect){
		$.post('<!--{$path_url}-->/ajax/loadDanhMucNguyenLieu.php',{act:'searchTenNguyenLieu',id:id,idselect:idselect},function(data) {
			 var obj = jQuery.parseJSON(data);
			 $('#tennguyenlieus').html(obj.status);
		});
	}
</script>