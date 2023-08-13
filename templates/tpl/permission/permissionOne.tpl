<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<!--{$path_url}-->/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <li>
        	<span>&raquo;</span>
        	<a title=" QUẢN LÝ ACCOUNT" href="<!--{$path_url}-->/sources/users.php">		
                Phân Quyền User
            </a> 
        </li>
        <li>
        	<span>&raquo;</span>
        	<a>		
                <!--{$viewuser.username}-->
            </a> 
        </li>
    </ul>
</div>
<div class="MainContent main-permission">
	<ul id="pmsHeader">
        <li class="pms-header" >
            <div class="col1"> Tên</div>
            <div class="col2"> Xem </div>	
            <div class="col2"> Thêm </div>
            <div class="col2"> Sửa</div>
            <div class="col2"> Xóa</div>
            <div class="col2"> Chuyển</div>
            <div class="col2"> Duyệt </div>
            <div class="col2"> Trả lại </div>
            <div class="col2"> Print & Export </div>
             <div class="col2"> Import </div>
            <div class="col2"> All </div>
        </li>

    </ul>
    <ul>
        <!--{$viewListmenu}-->
        <!--{section name=i loop=$view}-->
            <!--{insert name='getPmscheck' cid=$view[i].id uid=$uid name_vn=$view[i].name_vn}-->
            <!--{if $view[i].has_child eq 1}-->
                 <!--{insert name='getSubcategory' id=$view[i].id uid=$uid}-->	
            <!--{/if}-->
        <!--{/section}-->
    </ul>
</div>
<script src="<!--{$path_url}-->/fancybox/jquery.fancybox-1.3.1.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/fancybox/jquery.fancybox-1.3.1.css">

<script>
	$(document).ready(function() {
		$(".popupPms").fancybox();
	});
</script>
<script>
	$(window).scroll(function () {
		if($(window).scrollTop() > 50) {
			$('#pmsHeader').addClass("pms-header-fix");
		}
		else{
			$('#pmsHeader').removeClass("pms-header-fix");
		}
	});
</script>