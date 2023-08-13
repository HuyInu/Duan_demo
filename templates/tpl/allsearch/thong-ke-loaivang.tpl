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
    <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="Tìm kiếm" type="submit"> 
</div>