<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<!--{$path_url}-->/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
       <!--{insert name="HearderCat" cid=$smarty.request.cid root=$smarty.request.root act=$smarty.request.act}-->
    </ul>
</div>
<div class="ChonLoaiPhieu">
    <ul>
        <li class="active" id="clickVang" onclick="clickVang('<!--{$path_url}-->/sources/Kho-A9-Thong-Ke.php?cid=<!--{$smarty.request.cid}-->')">
            <a>Vàng</a>
        </li>
        <li id="clickKimCuong" onclick="clickKimCuong('<!--{$path_url}-->/sources/Kho-A9-Thong-Ke.php?cid=<!--{$smarty.request.cid}-->')">
            <a>Kim Cương</a>
        </li>
    </ul>
</div>
<div class="MainContent">
    <form name="f" id="f" method="post" onsubmit="return thongke()"> 
        <div class="MainSearch">
            <!--{include file="./allsearch/tungay-denngay-thong-ke.tpl"}-->
        </div>
        <!--{if $showlist eq 1}-->
            <div class="MainTable">
            <table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT" align="center">
                        <strong>STT</strong>
                    </td>
                    
                    <td align="center">
                        <strong>Thông tin</strong>
                    </td>
                    
                    <td align="center">
                        <strong>Số Lượng</strong>
                    </td>
                    
                    <td align="center">
                        <strong>Đơn Giá</strong>
                    </td>
                </tr>

                <tr class="fontSizeTon">
                    <td>
                       1
                    </td>
                    <td>
                        Tồn đầu ngày
                   </td>
                   <td align="right">
                        <!--{$sltondaungay|number_format:3:".":","}-->
                   </td>
                   <td align="right">
                        <!--{$dongiadaungay|number_format:3:".":","}-->
                   </td>
                    
              	</tr>   
                
                 <tr class="fontSizeTon">
                    <td>
                       2
                    </td>
                    <td>
                        Nhập Kho
                   </td>
                   <td align="right">
                        <!--{$slnhapcuoingay|number_format:3:".":","}-->
                   </td>
                   <td align="right">
                        <!--{$dongianhapcuoingay|number_format:3:".":","}-->
                   </td>
                   
              	</tr>    
                
                <tr class="fontSizeTon">
                    <td>
                       3
                    </td>
                    <td>
                        Xuất Kho
                   </td>
                   <td align="right">
                        <!--{$slxuatcuoingay|number_format:3:".":","}-->
                   </td>
                   <td align="right">
                        <!--{$dongiaxuatcuoingay|number_format:3:".":","}-->
                   </td>
                   
              	</tr>  
                
                <tr class="fontSizeTon">
                    <td>
                       4
                    </td>
                    <td>
                        Tồn Kho
                   </td>
                   <td align="right">
                        <strong class="colorXanh"><!--{$sltontong|number_format:3:".":","}--></strong>
                   </td>
                   <td align="right" class="trheader">
                        <strong class="colorXanh"><!--{$tongdongia|number_format:3:".":","}--></strong>
                   </td>
                   
              	</tr>                                                                 
            </table>
        </div>  
        <!--{/if}--> 
    </form>    
</div>
<link type="text/css" href="<!--{$path_url}-->/calendar/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$path_url}-->/calendar/jquery-ui.js"></script>
<script>
	$(document).ready(function() {
		$("#todays").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
		$("#fromdays").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
	});
</script>