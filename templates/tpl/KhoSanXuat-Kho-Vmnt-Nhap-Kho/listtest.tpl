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
    <form name="f" id="f" method="post" onsubmit="return searchKhoDauVaoXuatVang('<!--{$path_url}-->/sources/KhoSanXuat-Kho-Nguyen-Lieu-Nhap-Kho.php?cid=<!--{$smarty.request.cid}-->')"> 
        <div class="MainSearch">
        	<!--{include file="./allsearch/tungay-denngay-vang-kim-cuong.tpl"}-->
        </div>
        <div class="MainTable">
            <table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td width="7%">
                        <strong>Ngày nhập</strong>
                    </td>
                    
                    <td width="7%">
                        <strong>Mã phiếu</strong>
                    </td>
					<td width="7%">
                        <strong>Phòng chuyển</strong>
                    </td>
                    <td>
                        <strong>Loại Vàng</strong>
                    </td>
                    
                    <td>
                        <strong>Cân Nặng V+H</strong>
                    </td>
                   
                    <td>
                        <strong>Cân Nặng H</strong>
                    </td>
                    <td>
                        <strong>Cân Nặng V</strong>
                    </td>
                    <td>
                        <strong>Tuổi vàng</strong>
                    </td>
                    <td>
                        <strong>Mã ĐH</strong>
                    </td>
                     <td width="10%">
                        <strong>Ghi chú</strong>
                    </td>
                    <td class="tdShowHide">
                        <strong>Xác Nhận</strong>
                    </td>
                    <td class="tdShowHide">
                        <strong>Trả Lại</strong>
                    </td>
                </tr>
                <tr>
                    <td align="center"></td>
                    <td align="center">
                        <!--{include file="./allsearch/daychungtus.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/codes.tpl"}-->
                    </td>
                    <td align="center"></td>
                    <td align="center">
                        <!--{include file="./allsearch/loaivangs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/cannangvhs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/cannanghs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/cannangvs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/tuoivangs.tpl"}-->
                    </td>
                    <td align="center"></td>
                    <td align="center">
                        <!--{include file="./allsearch/ghichus.tpl"}-->
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <!--{section name=i loop=$viewtest}-->
                    <tr id="g<!--{$viewtest[i].id}-->">
                        <td>
                            <!--{$smarty.section.i.index+1+$number}-->
                        </td>
                        <td>
                            <!--{$viewtest[i].dated|date_format:"%d/%m/%Y"}-->
                        </td>
                        <td>
                            <!--{$viewtest[i].maphieu}-->
                        </td>
                        <td>
                            <!--{$viewtest[i].typekhodau}-->
                        </td>
                        <td>
                            <!--{insert name='getLoaiVangTest' table='loaivang' namevn='name_vn' id=$viewtest[i].idloaivang}-->
                        </td>
                        <td class="text-right">
                            <!--{$viewtest[i].cannangvh|number_format:3:".":","}-->
                        </td>
                        <td class="text-right">
                            <!--{$viewtest[i].cannangh|number_format:3:".":","}-->
                        </td>
                        <td class="text-right">
                            <!--{$viewtest[i].cannangv|number_format:3:".":","}-->
                        </td>
                        <td>
                            <!--{$viewtest[i].tuoivang}-->
                        </td>
                        <td>
                            <!--{if $viewtest[i].madhin gt 0}-->
                                <!--{insert name='getNamMaDonHangCatalog' madhin=$viewtest[i].madhin}--> 
                            <!--{/if}-->
                        </td>
                        <td>
                            <!--{$viewtest[i].ghichuvang}-->
                        </td>
                        <td align="center">
                            <!--{if $viewtest[i].typechuyen eq 1}-->
                                <!--{if $viewtest[i].type eq 1}-->
                                    <!--{if $checkPer8 eq "true" }-->
                                    <a href="javascript:void(0)" onclick="xacnhanchuyenKhoSanXuatTest('xacnhanchuyenKhoSanXuat', <!--{$viewtest[i].cid}-->, <!--{$viewtest[i].id}-->, '<!--{$viewtest[i].typekho}-->')" title="Xác Nhận"> 
                                        <img src="<!--{$path_url}-->/images/xac-nhan.png"/> 
                                    </a>
                                    <!--{else}-->
                                        <img src="<!--{$path_url}-->/images/xac-nhan-no.png"/> 
                                    <!--{/if}--> 
                                <!--{/if}-->
                            <!--{/if}-->
                        </td>
                        <td align="center">
                            <!--{if $viewtest[i].typechuyen eq 1}-->
                                <!--{if $viewtest[i].type eq 1}-->
                                    <!--{if $checkPer8 eq true}-->
                                        <a href="javascript:void(0);" onclick="xacnhanchuyenKhoSanXuatTest('tralaichuyenKhoSanXuat', <!--{$viewtest[i].cid}-->, <!--{$viewtest[i].id}-->, '<!--{$viewtest[i].typekho}-->')" title="Trả lại">
                                            <img src="<!--{$path_url}-->/images/tra-lai.png"/>    
                                        </a>
                                    <!--{else}-->
                                        <img src="<!--{$path_url}-->/images/tra-lai-no.png"/>
                                    <!--{/if}-->
                                <!--{/if}-->
                            <!--{/if}-->
                        </td>
                    </tr>
                    <!--{/section}-->
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