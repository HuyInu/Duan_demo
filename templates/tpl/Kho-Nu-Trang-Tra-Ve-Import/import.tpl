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
	<form name="allsubmit" class="form-horizontal" id="frmEdit" action="" method="post" enctype="multipart/form-data">
    	<div class="form-group">
            <label class="col-sm-3 control-label">Chọn file excel (.xlsx)</label>
            <div class="col-sm-6">
                <input type="file" name="file" id="file" onchange="check_file_import();"/>
                <input type="hidden" name="abc123" /> 
            </div>
        </div>
        <div class="col-xs-9 TextCenter"> 
            <input type="submit" class="btn-save" onclick=" return SubmitImport();"  value="Lưu"> 
        </div>
    </form>    
</div>
<script>
function SubmitImport(){
    var file = $('#file');
	if (file.val() == '') {
		alert('Chọn file Excel (.xlsx)');
		file.focus();
		return false;
	}
	else{
		document.allsubmit.submit();
	}
}
</script>