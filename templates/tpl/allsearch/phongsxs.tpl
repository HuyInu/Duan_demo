<div id="siteIDload">
    <select name="phongsxs" id="phongsxs" class="abcd chonphonbanSanXuat">
         <option value="0">Chọn Phòng ban</option>
         <!--{insert name='optionChuyenDen' id='169,708'}-->
         <!--{insert name='optionKhoSanXuatChuyenDenPhong' id=$view[i].id}-->
         <!--{insert name='optionChuyenDen' id='708'}--> 
    </select> 
</div>
<script>
	$(function () {
		$("#siteIDload select").select2();
	});
</script>
