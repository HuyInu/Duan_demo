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

<div class="formsearch formsearchend">    
    <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="Tìm kiếm" type="submit"> 
    <input type="button" name="reset" value=" Làm mới " onclick=" return resetsfrsearchdecuc();" class="btn-save btn-search"/>
</div>