<div id="panelLeft"	>
		
	<div class="SubTop"></div>
	<div class="SubCenter">
		
		<div class="SubTitle01">
			<img src="images/ImgQt1.png"  /> 
			<span class="SubTitleText">
				<a href="index.php?do=categories&act=list&cid=1&root=1" title="Artseed">Artseed</a>
			</span>
		</div>
		
		<div class="SubTitle01">
			<img src="images/ImgQt2.png"  /> 
			<span class="SubTitleText">
				<a href="index.php?do=users" title="QUẢN LÝ ACCOUNT">QUẢN LÝ ACCOUNT</a>
			</span>
		</div>
		
		<div class="SubTitle01">
			<img src="images/ImgQt3.png"  /> 
			<span class="SubTitleText">
				<a href="index.php?do=maintain" title="BẢO TRÌ">BẢO TRÌ</a>
			</span>
		</div>
		
		<div class="SubTitle01">
			<img src="images/ImgQt4.png"  /> 
			<span class="SubTitleText">
				<a href="index.php?do=login&act=log_out" title="LOG OUT">LOG OUT</a>
			</span>
		</div>
		
		<div class="SubTitle01">
			<img src="images/ImgQt5.png"  /> 
			<span class="SubTitleText">
				<a href="index.php?do=infos" title="THÔNG TIN WEBSITE">THÔNG TIN WEBSITE</a>
			</span>
		</div>
        
        <div class="SubTitle01">
			<img src="images/ImgQt5.png"  /> 
			<span class="SubTitleText">
				<a href="index.php?tinhthanh&cid=0" title="THÔNG TIN WEBSITE">TỈNH THÀNH</a>
			</span>
		</div>
		
		<div class="SubTitle01">
			<img src="images/ImgQt6.png"  />  
			<span class="SubTitleText">
				<a href="javascript:void(0)" onclick="clearCache();" title="XÓA CACHE">XÓA CACHE</a> <span style="margin:0 0 0 10px;position:relative;top:5px" id="loading"></span>
			</span>
		</div>
		
		<div class="Clear"></div>
		
	</div>
	
	
	<div class="SubBottom"></div>
	
	<div class="Clear"></div>
	
	
	<div class="SubTopTk"></div>
	<div class="SubCenter">
		<div class="SubTitle02">
			<span class="SubTitleText">
				TỔNG TRUY CẬP: <!--{$visit}-->
			</span>
		</div>
		
		<div class="SubTitle02">
			
			<span class="SubTitleText">
				ONLINE: <!--{$online}-->
			</span>
		</div>
		
		<div class="Clear"></div>
	</div>
	<div class="SubBottom"></div>
</div>

<script language="javascript">
function clearCache(){ 
	jConfirm('Bạn có muốn thực hiện không ?', '', function(r) {
	jQuery('#loading').html(' <img src="loading.gif" /> ');
		  jQuery.post('ajax/clearCache.php',function(data) {
			  if(data == "ok")
			  	jAlert('Xóa cache thành công.', '');
			 jQuery('#loading').html('');
		 });
	});
}
</script>
