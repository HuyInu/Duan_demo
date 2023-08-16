<?php
include_once("maininclude.php");
$datenow = date("d-m-Y");;
$timnow = date('H:i:s');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>

<style>
body{margin:0;padding:0;background: #ffe01c url(images/shattered.png) repeat;}
#cssmenu,
#cssmenu ul,
#cssmenu ul li,
#cssmenu ul li a {
  margin: 0;
  padding: 0;
  border: 0;
  list-style: none;
  line-height: 1;
  display: block;
  position: relative;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
#cssmenu {
  width: 220px;
  font-family: Helvetica, Arial, sans-serif;
  color: #ffffff;
}
#cssmenu ul ul {
  display: none;
}
#cssmenu > ul > li.active > ul {
  display: block;
}
.align-right {
  float: right;
}
#cssmenu > ul > li > a {
  padding: 12px 25px 12px 3px;
  line-height:22px;
  border-left: 1px solid #1682ba;
  border-right: 1px solid #1682ba;
  border-top: 1px solid #1682ba;
  cursor: pointer;
  z-index: 2;
  font-size: 14px;
  font-weight: bold;
  text-decoration: none;
  color: #ffffff;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.35);
  background: #36aae7;
  background: -webkit-linear-gradient(#36aae7, #1fa0e4);
  background: -moz-linear-gradient(#36aae7, #1fa0e4);
  background: -o-linear-gradient(#36aae7, #1fa0e4);
  background: -ms-linear-gradient(#36aae7, #1fa0e4);
  background: linear-gradient(#36aae7, #1fa0e4);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15);
}
#cssmenu > ul > li > a:hover,
#cssmenu > ul > li.active > a,
#cssmenu > ul > li.open > a {
  color: #eeeeee;
  background: #1fa0e4;
  background: -webkit-linear-gradient(#1fa0e4, #1992d1);
  background: -moz-linear-gradient(#1fa0e4, #1992d1);
  background: -o-linear-gradient(#1fa0e4, #1992d1);
  background: -ms-linear-gradient(#1fa0e4, #1992d1);
  background: linear-gradient(#1fa0e4, #1992d1);
}
#cssmenu > ul > li.open > a {
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(0, 0, 0, 0.15);
  border-bottom: 1px solid #1682ba;
}
#cssmenu > ul > li:last-child > a,
#cssmenu > ul > li.last > a {
  border-bottom: 1px solid #1682ba;
}
.holder {
  width: 0;
  height: 0;
  position: absolute;
  top: 0;
  right: 0;
}
.holder::after,
.holder::before {
  display: block;
  position: absolute;
  content: "";
  width: 6px;
  height: 6px;
  right: 20px;
  z-index: 10;
  -webkit-transform: rotate(-135deg);
  -moz-transform: rotate(-135deg);
  -ms-transform: rotate(-135deg);
  -o-transform: rotate(-135deg);
  transform: rotate(-135deg);
}
.holder::after {
  top: 17px;
  border-top: 2px solid #ffffff;
  border-left: 2px solid #ffffff;
}
#cssmenu > ul > li > a:hover > span::after,
#cssmenu > ul > li.active > a > span::after,
#cssmenu > ul > li.open > a > span::after {
  border-color: #eeeeee;
}
.holder::before {
  top: 18px;
  border-top: 2px solid;
  border-left: 2px solid;
  border-top-color: inherit;
  border-left-color: inherit;
}
#cssmenu ul ul li a {
  cursor: pointer;
  border-bottom: 1px solid #32373e;
  border-left: 1px solid #32373e;
  border-right: 1px solid #32373e;
  padding: 8px 23px 8px 10px;
  line-height:22px;
  z-index: 1;
  text-decoration: none;
  font-size: 13px;
  color: #fff;
  background: #50847d;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
  text-transform:uppercase;
}
#cssmenu ul ul li:hover > a,
#cssmenu ul ul li.open > a,
#cssmenu ul ul li.active > a {
  background: #59928a;
  color: #eee;
}

#cssmenu ul ul ul li a {
  padding-left:17px;
  font-size:12px;
  line-height:22px;
  color: #fff;
  background: #5b7395;
  text-transform:none !important;
}
#cssmenu ul ul ul li:hover > a,
#cssmenu ul ul ul li.open > a,
#cssmenu ul ul ul li.active > a {
  background: #8798b0;
  color: #eee;
}
#cssmenu ul ul ul ul li a {
  padding-left:25px;
  font-size:13px;
  line-height:22px;
  color: #fff;
  background: #424852;
  text-transform:capitalize;
}
#cssmenu ul ul ul ul li:hover > a,
#cssmenu ul ul ul ul li.open > a,
#cssmenu ul ul ul ul li.active > a {
  background: #49505a;
  color: #eee;
}


#cssmenu > ul > li > ul > li:last-child > a,
#cssmenu > ul > li > ul > li.last > a {
  border-bottom: 0;
}
#cssmenu > ul > li > ul > li.open:last-child > a,
#cssmenu > ul > li > ul > li.last.open > a {
  border-bottom: 1px solid #32373e;
}
#cssmenu > ul > li > ul > li.open:last-child > ul > li:last-child > a {
  border-bottom: 0;
}
#cssmenu ul ul li.has-sub > a::after {
  display: block;
  position: absolute;
  content: "";
  width: 5px;
  height: 5px;
  right: 20px;
  z-index: 10;
  top: 11.5px;
  border-top: 2px solid #eeeeee;
  border-left: 2px solid #eeeeee;
  -webkit-transform: rotate(-135deg);
  -moz-transform: rotate(-135deg);
  -ms-transform: rotate(-135deg);
  -o-transform: rotate(-135deg);
  transform: rotate(-135deg);
}
#cssmenu ul ul li.active > a::after,
#cssmenu ul ul li.open > a::after,
#cssmenu ul ul li > a:hover::after {
  border-color: #ffffff;
}
.Member{
	padding:10px 10px;
	color:#F00;
	font-size:14px;
	line-height:22px;
}
.Member a{
	color:#F00;
}
.Member a:hover{
	color:#1682ba;
}
</style>
 
<div id="cssmenu">
  <div class="Member">
  	 Hôm nay: <?php echo $datenow .' - '.$timnow; ?>  <br />
      Chào: <?php echo $_SESSION['admin_qlsxntjcorg_username']; ?> | <a href="javascript:void(0)" onclick="resetPmscontent();">Reset Menu</a> <br />
     <a target="QLSX_content" href="sources/login.php?act=log-out">Thoát</a> | <a target="QLSX_content" href="sources/users.php?act=changes">Đổi Mật Khẩu</a> <br />
     <script>
			function resetPmscontent(){
				$.post('ajax/member.php',{act:'resetpmscontent'},function(data){ alert('Reset Menu thành công. ')});					
			}
	 </script>
  </div>
  <ul>
  	<?php
		if(checkViewPermision(2)==1){
			echo '
				<li class="has-sub">
					<a style="text-shadow: 0px 1px 0px rgba(255, 255, 255, 0.35);">
						<span>THƯ MỤC</span> <span class="holder" style="border-color: rgba(255, 255, 255, 0.35);"></span>
					</a>
					<ul style="display: none;">
						<li>
							<a target="QLSX_content" href="sources/categories.php?cid=2"><span>Menu</span></a>
						 
						</li>
					   <li>
							<a target="QLSX_content" href="sources/users.php"><span>Quản lý account</span></a>
					   </li>
					</ul>
				 </li>
			';
		}
		
			$sql = "select * from $GLOBALS[db_sp].categories where pid in (2,1834) and active=1 order by num asc, id desc";
			$rs = $GLOBALS["sp"]->getAll($sql);
			foreach($rs as $item){
				$classHasSub = '';
				if($item['has_child'] == 1){
					$classHasSub = 'class="has-sub"';	
				}			
				if(checkViewPermision($item['id'])==1){
					$listMenu .= '<li '.$classHasSub.'><a style="text-shadow: 0px 1px 0px rgba(255, 255, 255, 0.35);" ><span>'.$item['name_vn'].'</span> <span class="holder" style="border-color: rgba(255, 255, 255, 0.35);"></span> </a>';   // Tra lai tat ca cac Menu cha
						
							if($item['has_child'] == 1){
								$listMenu .=getSubMenu($item['id']);        // neu ton tai cac Menu con thi se duoc hien thi  
							}
						'</li>';
				}	
			}
			

		echo $listMenu;
		
		//Get menu con
		function getSubMenu($id){
			$sql = "select * from $GLOBALS[db_sp].categories where pid=".$id." and active=1 order by num asc, id desc";
			$rs = $GLOBALS["sp"]->getAll($sql);
			$listsubMenu ='';
			$listsubMenu .='<ul style="display: none;">';
			foreach($rs as $item){
				$classHasSub = '';
				$typephongban=(!empty($item['typephongban']))?'&typephongban='.$item['typephongban']:'';
				$ahref = 'target="QLSX_content" onclick="loadingpage();" href="sources/'.GetNameComponent($item["comp"]).getName('component', 'front_link', $item["comp"]).'cid='.$item['id'].$typephongban.'"';
				if($item['has_child'] == 1){
					$classHasSub = 'class="has-sub"';
					$ahref = '';
				}
				if(checkViewPermision($item['id'])==1){
					$listsubMenu .='<li '.$classHasSub.'><a '.$ahref.'><span>'.$item['name_vn'].'</span></a>';
					if($item['has_child'] == 1){
						$listsubMenu .=getSubMenu($item['id']);         
					}
					$listsubMenu .='</li>';
				}
			} 
			$listsubMenu .='</ul>';
			return $listsubMenu;
		}
	?>
  </ul>
</div>
 <script>
$('#cssmenu li.active').addClass('open').children('ul').show(); 
$('#cssmenu li.has-sub>a').on('click', function(){
  $(this).removeAttr('href');
  var element = $(this).parent('li');
  if (element.hasClass('open')) {
    element.removeClass('open');
    element.find('li').removeClass('open');
    element.find('ul').slideUp();
  }
  else {
    element.addClass('open');
    element.children('ul').slideDown();
    element.siblings('li').children('ul').slideUp();
    element.siblings('li').removeClass('open');
    element.siblings('li').find('li').removeClass('open');
    element.siblings('li').find('ul').slideUp();
  }
});
</script>
<script type="text/javascript" src="js/khoa-tab-menu11.js"></script>