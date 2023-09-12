<!DOCTYPE html>
<html lang="vi">
<head>
<!--{include 'header.tpl'}-->
<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/css/giahuy/style.css">

<script type="text/javascript" src="<!--{$path_url}-->/select-checkbox/sol.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/select-checkbox/sol.css" />
<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/js/searchajax/search.css" />
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/jsapi.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/script.js"></script>
</head>
<body>
<div class='container'>
        <div class='header'>
        </div>
        <div class='MainContent'>
        <div class='card shadow-box'>
            <div class='card-header'>
                <!--{$title}-->
            </div>
            <div class='card-body'>
                <form name="allsubmit" method='post' class="form-horizontal" id="frmEdit" action="thuchanh.php?act=<!--{if $smarty.request.act eq 'add' }-->addsm<!--{else}-->editsm<!--{/if}-->&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tên</label>
                        <div class="col-sm-6">
                            <input type='text' name='name_vn' value='<!--{$edit.name_vn|escape:"html":"UTF-8"}-->'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Table (lấy tên table khi chuyển kho)</label>
                        <div class="col-sm-6">
                            <input type='text' name='table' value='<!--{$edit.table}-->'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Table chi tiết</label>
                        <div class="col-sm-6">
                            <input type='text' name='tablecb' value='<!--{$edit.tablecb}-->'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Table hạch toán</label>
                        <div class="col-sm-6">
                            <input type='text' name='tablehachtoan' value='<!--{$edit.tablehachtoan}-->'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Type phòng ban</label>
                        <div class="col-sm-6">
                            <input class='short_textbox' type='text' name='typephongban' value='<!--{$edit.typephongban}-->'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Mã Phòng Ban (Phân Mềm A.Tuấn)</label>
                        <div class="col-sm-6">
                            <input class='short_textbox' type='text' name='maphongban' value='<!--{$edit.maphongban}-->'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Số Thứ Tự</label>
                        <div class="col-sm-6">
                            <input class='short_textbox' type='text' name='num' value='<!--{$edit.num}-->'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No Permission</label>
                        <div class="col-sm-6">
                            <input type='checkbox' name='nopermission' value='nopermission'<!--{if $edit.nopermission eq '1'}--> checked <!--{/if}--> >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Hiện/Ẩn</label>
                        <div class="col-sm-6">
                            <input type='checkbox' name='active' value='active' <!--{if $edit.active eq '1' || $smarty.request.act eq 'add'}--> checked <!--{/if}-->>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Có Menu Con?</label>
                        <div class="col-sm-6">
                            <input type='checkbox' name='has_child' value="has_child" <!--{if $edit.has_child eq '1'}--> checked <!--{/if}-->>
                        </div>
                    </div>
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
                        <input type="button" class="btn-save" onclick=" return SubmitFrom('checkForm','');"  value="Lưu"> 
                    </div>
                </form>
            </div>
        </div>    
        </div>
</div>
</body>
<footer>
<!--{include 'footer.tpl'}-->
</footer>
</html>
<script>

function insertComponent(idcomponent, tencomponent){
    $('#comp').val(idcomponent);
    $('#namecomp').val(tencomponent);
}

</script>