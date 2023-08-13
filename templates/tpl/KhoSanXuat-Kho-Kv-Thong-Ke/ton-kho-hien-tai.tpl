<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<!--{$path_url}-->/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
       <!--{getHearderCat(array(cid=>$smarty.request.cid, root=>$smarty.request.root, act=>$smarty.request.act))}-->
    </ul>
</div>
<div class="MainContent">
    <form name="f" id="f" method="post" onsubmit="return">
        <div class="MainSearch">            
            <!--{include file="./allsearch/print-kho-san-xuat.tpl"}-->
            <input type="hidden" id="getUrlPrintKhoNguonVao" value="act=tonkhohientai&cid=<!--{$phongbanchuyen}-->"  />
       </div>
       <div class="MainTable">
            <table  class="table-bordered">
                <tr class="trheader">
                    <td align="center">
                        <strong>Loại Vàng</strong>
                    </td>
                    <td align="center">
                        <strong>Tồn</strong>
                    </td>
                    <td align="center">
                        <strong>Tổng Trọng Lượng Q10</strong>
                    </td>
                    <td align="center">
                        <strong>Tổng Trọng Lượng Q10 Gia Công</strong>
                    </td>
                </tr>
                <!--{assign var="tongQ10" value=0}-->
                <!--{assign var="tongQ10GiaCong" value=0}-->
                <!--{section name=i loop=$typegoldview}-->
                    <!--{$viewdl = thongKeTonHienTaiKhoSanXuatTest($phongbanchuyen,$typegoldview[i].id)}-->
                    <!--{if $viewdl.idloaivang gt 0}-->
                        <tr class="fontSizeTon">
                            <td align="right">
                                <!--{$typegoldview[i].name_vn}-->
                            </td>
                            <td align="right">
                                <!--{$viewdl.slton|number_format:3:".":","}-->
                            </td>
                            <td align="right">
                                <!--{$viewdl.tongQ10|number_format:3:".":","}-->
                                <!--{assign var="tongQ10" value=$tongQ10+$viewdl.tongQ10}-->
                            </td>
                            <td align="right">
                                <!--{$viewdl.tongQ10GiaCong|number_format:3:".":","}-->
                                <!--{assign var="tongQ10GiaCong" value=$tongQ10GiaCong+$viewdl.tongQ10GiaCong}-->
                            </td>
                        </tr>
                    <!--{/if}-->
                <!--{/section}-->
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="2"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
                    <td align="right"><strong class="colorXanh"><!--{$tongQ10|number_format:3:".":","}--> </strong></td>
                    <td align="right"><strong class="colorXanh"><!--{$tongQ10GiaCong|number_format:3:".":","}--> </strong></td>
                </tr>
            </table>
       </div>
    </form>
</div>