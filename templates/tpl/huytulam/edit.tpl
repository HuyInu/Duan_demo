<script type="text/javascript" src="<!--{$path_url}-->/select-checkbox/sol.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/select-checkbox/sol.css" />
<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/js/searchajax/search.css" />
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/jsapi.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/script.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/Giahuy_script.js"></script>

<div class="MainContent">
<form name="allsubmit" class="form-horizontal" id="frmEdit" action="huymenu2.php?act=<!--{if $smarty.request.act === 'add'}-->addsm<!--{else}-->editsm<!--{/if}-->&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
    	<div class="form-group">
            <label class="col-sm-3 control-label">Tên</label>
            <div class="col-sm-6">
                <input type="text" value="" name="name_vn" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Table (lấy tên table khi chuyển kho)</label>
            <div class="col-sm-6">
                <input type="text" value="" name="table" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Table chi tiết</label>
            <div class="col-sm-6">
                <input type="text" value="" name="tablect" />
            </div>
        </div>
        
         <div class="form-group">
            <label class="col-sm-3 control-label">Table hạch toán</label>
            <div class="col-sm-6">
                <input type="text" value="" name="tablehachtoan" />
            </div>
        </div>
        
         <div class="form-group">
            <label class="col-sm-3 control-label">Type phòng ban</label>
            <div class="col-sm-6">
                <input type="text" value="" name="typephongban" class="InputNum"  onkeypress="return onlyNumberKey(event)"/>
            </div>
        </div>
            
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Mã Phòng Ban (Phân Mềm A.Tuấn)</label>
            <div class="col-sm-6">
                <input type="text" value="" name="maphongban" class="InputNum" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Số Thứ Tự</label>
            <div class="col-sm-6">
                <input type="text" value="" name="num" class="InputNum"  onkeypress="return onlyNumberKey(event)"/>
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-3 control-label">No Permission</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox" name="nopermission" value="1"  />    
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Hiện/Ẩn</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox" name="active" value="1" />    
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Có Menu Con?</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox"  value="1" name="has_child" onclick="Giahuy_disable_Componet_TextBox(this)"/>    
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Component</label>
            <div class="col-sm-6">
                <input style="width:60%;" name="namecomp" id="namecomp" autocomplete="off" class="InputText" type="text" value="" onkeyup="Giahuy_componentLookup('<!--{$path_url}-->', 'conponent', this.value)"/>
                <input type="text" name="comp" id="comp" value="" class="InputNum" readonly>
                <div id="suggestions" class="suggestionsCat"></div>
            </div>
        </div>
        <div class="col-xs-9 TextCenter"> 
            <input type="button" class="btn-save" onclick="Giahuy_SubmitFrom(this)"  value="Lưu"> 
        </div>
    </form>    
</div>
<script>

function insertComponent(idcomponent, tencomponent){
    $('#comp').val(idcomponent);
    $('#namecomp').val(tencomponent);
}

</script>