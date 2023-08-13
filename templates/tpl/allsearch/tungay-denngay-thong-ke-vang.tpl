<div class="formsearch">
     <label class="Fl labelsearch"> Từ ngày: </label>
     <input type="text" class="InputText textsearchdated" placeholder='dd/mm/yy' name="fromdays" id="fromdays" value="<!--{$fromdays}-->" onchange="DateCheck()" autocomplete="off"/>
</div>
<div class="formsearch">
     <label class="Fl labelsearch"> Đến ngày: </label>
     <input type="text" class="InputText textsearchdated" placeholder='dd/mm/yy' name="todays" id="todays" value="<!--{$todays}-->" onchange="DateCheck()" autocomplete="off"/>
</div>
<div class="formsearch">
     <select class="selectOption" id="idloaivang" name="idloaivang" >
         <option value="">--Chọn loại vàng--</option>
         <!--{section name=i loop=$typegold}-->
            <option value="<!--{$typegold[i].id}-->" <!--{if $idloaivang eq $typegold[i].id}-->selected="selected"<!--{/if}-->>
                <!--{$typegold[i].name_vn}-->
            </option>
         <!--{/section}-->
    </select>
</div>

<div class="formsearch"> 
    <input class="btn-save btn-search" value="Tìm kiếm" type="submit"> 
    <input type="reset" name="reset" value=" Làm mới " class="btn-save btn-search"/>
</div>
<script>
	function thongke(){
		var fromdays = $('#fromdays');	
		var todays = $('#todays');
		var idloaivang = $('#idloaivang');
		if(fromdays.val() == ''){
			alert('Vui lòng chọn từ ngày');
			fromdays.focus();
			return false;
		}
		else if(todays.val() == ''){
			alert('Vui lòng chọn đến ngày');
			todays.focus();	
			return false;
		}
		/*
		else if(idloaivang.val() == ''){
			alert('Vui lòng chọn loại vàng.');
			idloaivang.focus();	
			return false;
		}
		*/
		else{
			return true;	
		}
	}
</script>