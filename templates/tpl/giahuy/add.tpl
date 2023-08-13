<!DOCTYPE html>
<html lang="vi">
<head>

<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/css/giahuy/style.css">
</head>
<body>
<div class='container'>
        <div class='header'>
        </div>
        <div class='MainContent'>
            <form method='post' class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tên</label>
                    <div class="col-sm-6">
                        <input type='text' name='name_vn' value='<!--{$edit.nam_vn}-->'>
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
                        <input type='number' name='typephongban' value='<!--{$edit.typephongban}-->'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mã Phòng Ban (Phân Mềm A.Tuấn)</label>
                    <div class="col-sm-6">
                        <input type='text' name='maphongban' value='<!--{$edit.maphongban}-->'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Số Thứ Tự</label>
                    <div class="col-sm-6">
                        <input type='text' name='num' value='<!--{$edit.num}-->'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">No Permission</label>
                    <div class="col-sm-6">
                        <input type='checkbox' name='nopermission' checked='<!--{($edit.nopermission eq '1')?true:false}-->'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Hiện/Ẩn</label>
                    <div class="col-sm-6">
                        <input type='checkbox' name='active' value='<!--{($edit.active eq '1')?true:false}}-->'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Có Menu Con?</label>
                    <div class="col-sm-6">
                        <input type='checkbox' name='has_child' value='<!--{($edit.has_child eq '1')?true:false}}-->'>
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
            </form>
        </div>
</div>
</body>
<footer>

</footer>
</html>