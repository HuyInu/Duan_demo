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
	<form name="allsubmit" class="form-horizontal" id="frmEdit" action="loaivang.php?act=<!--{if $smarty.request.act eq 'add' }-->addsm<!--{else}-->editsm<!--{/if}-->&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
    	<div class="form-group">
            <label class="col-sm-3 control-label">Loại vàng</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.name_vn|escape:"html":"UTF-8"}-->" name="name_vn"  id="name_vn"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Tuổi quy định</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.tuoiquydinh}-->" name="tuoiquydinh"  id="tuoiquydinh" placeholder="0.7505"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Hệ số < 20% </label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.hesonho20}-->" name="hesonho20"  id="hesonho20" placeholder="0.0010"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Hệ số > 20% </label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.hesolon20}-->" name="hesolon20"  id="hesonho20" placeholder="0.0020"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">% Kẽm Thêm</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.phatramkemthem}-->" name="phatramkemthem"  id="phatramkemthem" placeholder="20"/>
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
            <input type="submit" class="btn-save" onclick=" return SubmitFromLoaiVang();"  value="Lưu"> 
        </div>
    </form>    
</div>
<script>
function SubmitFromLoaiVang(){
	var name = $('#name_vn');
	var id = $('#id').val();
	if(name.val() == ''){
		alert('Vui lòng nhập vào Tên.');
		name.focus();
		return false;
	}
	else{
		$.post('<!--{$path_url}-->/ajax/Checkip.php',{act:'checkNameLoaiVang',name:name.val(),id:id},function(data) {																				
			 var obj = jQuery.parseJSON(data);
			 if(obj.status == 'success'){
				document.allsubmit.submit();
			 }
			 else{
				alert(obj.status);	
				name.focus();
			 }
		});
		return false;
	}
}
</script>