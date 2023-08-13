<script type="text/javascript" src="<!--{$path_url}-->/select-checkbox/sol.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/select-checkbox/sol.css" />
<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/js/searchajax/search.css" />
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/jsapi.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/script.js"></script>
<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<!--{$path_url}-->/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <!--{insert name="HearderCatMenu" cid=$smarty.request.cid root=$smarty.request.root act=$smarty.request.act}-->
    </ul>
</div>

<div class="MainContent">
	<form name="allsubmit" class="form-horizontal" id="frmEdit" action="categories.php?act=<!--{if $smarty.request.act eq 'add' }-->addsm<!--{else}-->editsm<!--{/if}-->&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
    	<div class="form-group">
            <label class="col-sm-3 control-label">Tên</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.name_vn|escape:"html":"UTF-8"}-->" name="name_vn" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Table (lấy tên table khi chuyển kho)</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.table}-->" name="table" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Table chi tiết</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.tablect}-->" name="tablect" />
            </div>
        </div>
        
         <div class="form-group">
            <label class="col-sm-3 control-label">Table hạch toán</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.tablehachtoan}-->" name="tablehachtoan" />
            </div>
        </div>
        
         <div class="form-group">
            <label class="col-sm-3 control-label">Type phòng ban</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.typephongban}-->" name="typephongban" class="InputNum" />
            </div>
        </div>
            
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Mã Phòng Ban (Phân Mềm A.Tuấn)</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.maphongban}-->" name="maphongban" class="InputNum" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Số Thứ Tự</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{if $edit.num eq ""}-->0<!--{else}--><!--{$edit.num}--><!--{/if}-->" name="num" class="InputNum" />
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-3 control-label">No Permission</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox" name="nopermission" value="nopermission" <!--{if $edit.nopermission eq 1}-->checked<!--{/if}--> />    
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Hiện/Ẩn</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox" name="active" value="active" <!--{if $edit.active eq 1 || $smarty.request.act eq 'add'}-->checked<!--{/if}--> />    
            </div>
        </div>
       
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Có Menu Con?</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox" onclick="CheckHasChild(this);" value="has_child" name="has_child"  <!--{if $edit.has_child eq 1}-->checked<!--{/if}-->/>    
            </div>
        </div>
        <!--{if $smarty.request.cid eq 79 || $smarty.request.cid eq 83}-->
            <div class="form-group">
                <label class="col-sm-3 control-label">Giao Nhập Nhà Xưởng (Phần Mềm A Tuấn)</label>
                <div class="col-sm-6">
                    <select id="typegiaonhan" name="typegiaonhan">
                        <!--{section name=i loop=$typegiaonhanload}-->
                            <option <!--{if $typegiaonhanload[i].id eq $edit.typegiaonhan }--> selected="selected" <!--{/if}--> value="<!--{$typegiaonhanload[i].id}-->">
                                <!--{$typegiaonhanload[i].name_vn}-->
                            </option>
                        <!--{/section}-->											
                    </select>
                </div>
            </div>
        <!--{/if}-->
        <div class="form-group">
            <label class="col-sm-3 control-label">Component</label>
            <div class="col-sm-6">
                
                <input style="width:60%;" name="namecomp" id="namecomp" autocomplete="off" class="InputText" type="text" value="<!--{insert name='getName' table='component' names='name' id=$edit.comp}-->" placeholder="Nhập tìm kiếm tên component phù hợp " onkeyup="lookup('<!--{$path_url}-->','component',this.value);" />
                <input type="text" name="comp" id="comp" value="<!--{$edit.comp}-->" class="InputNum" readonly>
                <div id="suggestions" class="suggestionsCat"></div>
            </div>
            
        </div>
        <div class="col-xs-9 TextCenter"> 
        	<input type="hidden" name="id" value="<!--{$edit.id}-->" />
            <input type="hidden" name="cat" value="2" />
            <input type="submit" class="btn-save" onclick=" return SubmitFrom('checkForm','');"  value="Lưu"> 
        </div>
    </form>    
</div>

<script>

function insertComponent(idcomponent, tencomponent){
    $('#comp').val(idcomponent);
    $('#namecomp').val(tencomponent);
}

</script>