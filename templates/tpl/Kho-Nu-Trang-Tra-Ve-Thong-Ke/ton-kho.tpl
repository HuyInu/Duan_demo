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
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit="return searchKhoKhacKhoTongDeCucThongKe('<!--{$path_url}-->/sources/Kho-A9-Thong-Ke.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')"> 
        <div class="MainSearch">
            <div class="formsearch">
                <label class="Fl labelsearch"> Từ ngày: </label>
                <input type="text" class="SearchCtrl InputText textsearchdated" placeholder='dd/mm/yy' name="fromdays" id="fromdays" value="<!--{$fromdays}-->" onchange="DateCheck()" autocomplete="off"/>
            </div>
            <div class="formsearch">
                <label class="Fl labelsearch"> Đến ngày: </label>
                <input type="text" class="SearchCtrl InputText textsearchdated" placeholder='dd/mm/yy' name="todays" id="todays" value="<!--{$todays}-->" onchange="DateCheck()" autocomplete="off"/>
            </div>
            <div class="formsearch">
                <select class="selectOption" id="idloaivang" name="idloaivang" >
                    <option value="">--Chọn loại vàng--</option>
                    <!--{section name=i loop=$typegold}-->
                        <option value="<!--{$typegold[i].id}-->" <!--{if $idloaivang eq $typegold[i].id}-->selected="selected"<!--{/if}-->>
                            <!--{$typegold[i].name_vn}-->
                        </option>
                    <!--{/section}-->
                </select>
            </div>
            <div class="formsearch"> 
                <input class="btn-save btn-search" value="Tìm kiếm" type="submit"> 
                <input type="button" name="reset" value=" Làm mới " onclick="ResetSearch();" class="btn-save btn-search"/>
            <!--{if $checkPer10 eq "true" }-->
                <a href="<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Import.php?act=importexcel&cid=<!--{$smarty.request.cid}-->" title="Import Excel">
                    <input type="button" name="importexcel" value=" Import Excel " class="btn-save btn-search"/>
                </a>
            <!--{/if}-->
            </div>
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td align="center">
                        <strong>Loại Vàng</strong>
                    </td>
                    <td align="center">
                        <strong>Số Dư Đầu Kỳ</strong>
                    </td>
                    <td align="center">
                        <strong>Số Lượng Nhập</strong>
                    </td>
                    <td align="center">
                        <strong>Số Lượng Xuất</strong>
                    </td>
                    <td align="center">
                        <strong>Hao</strong>
                    </td>
                    <td align="center">
                        <strong>Dư</strong>
                    </td>

                    <td align="center">
                        <strong>Tồn</strong>
                    </td>
                    <td align="center">
                        <strong>Tổng Trọng Lượng Q10</strong>
                    </td>
                </tr>
                <!--{assign var="tongQ10" value=0}-->
				<!--{section name=i loop=$typegoldview}-->
                	<!--{$viewdl = ThongKeKhoNuTrangTraVe($smarty.request.cid, $typegoldview[i].id, $fromDate, $toDate)}-->
                    <!--{if $viewdl.idloaivang gt 0}-->
                        <tr class="fontSizeTon">
                            <td align="right">
                                <!--{$typegoldview[i].name_vn}-->
                           </td>
                           <td align="right">
                                <!--{$viewdl.sltonsddk|number_format:3:".":","}-->
                           </td>
                           <td align="right">
                                <!--{$viewdl.slnhap|number_format:3:".":","}-->
                           </td>
                           <td align="right">
                                <!--{$viewdl.slxuat|number_format:3:".":","}-->
                           </td>
                           <td align="right">
                                <!--{$viewdl.slhao|number_format:3:".":","}-->
                           </td>
                           <td align="right">
                                <!--{$viewdl.sldu|number_format:3:".":","}-->
                           </td>
                            
                           <td align="right">
                                <strong><!--{$viewdl.slton|number_format:3:".":","}--></strong>
                           </td>
                           <td align="right">

                                <!--{$viewdl.tongQ10|number_format:3:".":","}-->
                                <!--{assign var="tongQ10" value=$tongQ10+$viewdl.tongQ10}-->
                           </td> 
                        </tr>  
                     <!--{/if}--> 
                <!--{/section}-->
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="7"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
                    <td align="right"><strong class="colorXanh"><!--{$tongQ10|number_format:3:".":","}--> </strong></td>
                </tr>                                                                        
            </table>
    	</div>   
    </form> 
    <div class="Paging">
        <div class="pgLeft">Tổng số <!--{$total}--> trang</div>
        <div class="pgRight">
            <!--{$link_url}-->  
        </div>
    </div>   
</div>
<link type="text/css" href="<!--{$path_url}-->/calendar/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$path_url}-->/calendar/jquery-ui.js"></script> 
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/tim-kiem.js"></script>