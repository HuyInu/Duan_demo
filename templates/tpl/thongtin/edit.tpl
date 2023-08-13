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
	<form name="allsubmit" class="form-horizontal" id="frmEdit" action="thongtin.php?act=<!--{if $smarty.request.act eq 'add' }-->addsm<!--{else}-->editsm<!--{/if}-->&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
    	<div class="form-group">
            <label class="col-sm-3 control-label">Tên</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.name_vn|escape:"html":"UTF-8"}-->" name="name_vn"  id="name_vn"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Tỷ giá</label>
            <div class="col-sm-6">
                <input type="text" class="autoNumeric" value="<!--{$edit.tygia}-->" name="tygia"  id="tygia"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Giá vàng N24K</label>
            <div class="col-sm-6">
                <input class="autoNumeric" type="text" value="<!--{$edit.giavangn24k}-->" name="giavangn24k"  id="giavangn24k"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Số Thứ Tự</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{if $edit.num eq ""}-->0<!--{else}--><!--{$edit.num}--><!--{/if}-->" name="num" class="InputNum" />
            </div>
        </div>
         
        <div class="form-group">
            <label class="col-sm-3 control-label">Hiện/Ẩn</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox" name="active" value="active" <!--{if $edit.active eq 1 || $smarty.request.act eq 'add'}-->checked<!--{/if}--> />    
            </div>
        </div>
       
        <div class="col-xs-9 TextCenter"> 
        	<input type="hidden" name="id" id="id" value="<!--{$edit.id}-->" />
            <input type="submit" class="btn-save" onclick=" return SubmitFromthongtin();"  value="Lưu"> 
        </div>
    </form>    
</div>
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<script>
$('.autoNumeric').autoNumeric('init', {aSep: ',', aDec: '.', mDec: 0});

function SubmitFromthongtin(){
	var name = $('#name_vn');
	var id = $('#id').val();
	if(name.val() == ''){
		alert('Vui lòng nhập vào Tên.');
		name.focus();
		return false;
	}
	else{
		document.allsubmit.submit();
	}
}
</script>