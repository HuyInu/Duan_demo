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
    <form name="f" id="f" method="post" onsubmit="return searchKhoDauVaoXuatVang('<!--{$path_url}-->/sources/KhoSanXuat-Kho-Kv-Nhap-Kho.php?cid=<!--{$smarty.request.cid}-->')">
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
                <!--{section name=i loop=$view}-->
                    <tr id="g<!--{$view[i].id}-->">
                        <td>
                            <!--{$smarty.section.i.index+1+$number}-->
                        </td>
                        <td>
                            <!--{$view[i].dated|date_format:"%d/%m/%Y"}-->
                        </td>
                        <td>
                            <!--{$view[i].maphieu}-->
                        </td>
                        <td>
                            <!--{$view[i].typekhodau}-->
                        </td>
                        <td>
                            <!--{getLoaiVangTest(array(table=>'loaivang', namevn=>'name_vn', id=>$view[i].idloaivang))}-->
                        </td>
                        <td class="text-right">
                            <!--{$view[i].cannangvh|number_format:3:".":","}-->
                        </td>
                        <td class="text-right">
                            <!--{$view[i].cannangh|number_format:3:".":","}-->
                        </td>
                        <td class="text-right">
                            <!--{$view[i].cannangv|number_format:3:".":","}-->
                        </td>
                        <td>
                            <!--{$view[i].tuoivang}-->
                        </td>
                        <td><!--ma don hang--></td>
                        <td>
                            <!--{$view[i].ghichuvang}-->
                        </td>
                        <td align="center">
                            <!--{if $view[i].typechuyen eq 1}-->
                                <!--{if $view[i].type eq 1}-->
                                    <!--{if $checkPer8 eq "true" }-->
                                    <a href="javascript:void(0)" onclick="xacnhanchuyenKhoSanXuatTest('xacnhanchuyenKhoSanXuat', <!--{$view[i].cid}-->, <!--{$view[i].id}-->, '<!--{$view[i].typekho}-->')" title="Xác Nhận"> 
                                        <img src="<!--{$path_url}-->/images/xac-nhan.png"/> 
                                    </a>
                                    <!--{else}-->
                                        <img src="<!--{$path_url}-->/images/xac-nhan-no.png"/> 
                                    <!--{/if}--> 
                                <!--{/if}-->
                            <!--{/if}-->
                        </td>
                        <td align="center">
                            <!--{if $view[i].typechuyen eq 1}-->
                                <!--{if $view[i].type eq 1}-->
                                    <!--{if $checkPer8 eq true}-->
                                    <a href="javascript:void(0);" onclick="xacnhanchuyenKhoSanXuatTest('tralaichuyenKhoSanXuat', <!--{$view[i].cid}-->, <!--{$view[i].id}-->, '<!--{$view[i].typekho}-->')" title="Trả lại">
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
            </table>
        </div>
    </form>
</div>