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
                <!--{section i $phieuNhap}-->
                <tr class="">
                    <td class="tdSTT">
                        <!--{$smarty.section.i.index + 1}-->
                    </td>
                    
                    <td width="7%">
                        <!--{$phieuNhap[i].dated|date_format:'%d/%m/%Y'}-->
                    </td>
                    
                    <td width="7%">
                        <!--{$phieuNhap[i].maphieu}-->
                    </td>
					<td width="7%">
                        <!--{$phieuNhap[i].phongbanchuyen}-->
                    </td>
                    <td>
                        <!--{getName('loaivang','name_vn',<!--{$phieuNhap[i].idloaivang}-->)}-->
                    </td>
                    
                    <td>
                        <!--{$phieuNhap[i].cannangvh|number_format:3:".":","}-->
                    </td>
                   
                    <td>
                        <!--{$phieuNhap[i].cannangh|number_format:3:".":","}-->
                    </td>
                    <td>
                        <!--{$phieuNhap[i].cannangv|number_format:3:".":","}-->
                    </td>
                    <td>
                        <!--{$phieuNhap[i].tuoivang}-->
                    </td>
                    <td>
                        <!--{$phieuNhap[i].madonhangsx}-->
                    </td>
                     <td width="10%">
                         <!--{$phieuNhap[i].ghichuvang}-->
                    </td>
                    <td class="tdShowHide">
                        <!--{if $phieuNhap[i].typechuyen eq 1}-->
                            <!--{if $phieuNhap[i].type eq 1}-->
                                <a href="javascript:void(0)" onclick="giahuy_xacnhanchuyenKhoSanXuat('xacnhanchuyenKhoSanXuat', <!--{$phieuNhap[i].cid}-->, <!--{$phieuNhap[i].id}-->, '<!--{$phieuNhap[i].typekho}-->')" title="Xác Nhận"> 
                                    <img src="<!--{$path_url}-->/images/xac-nhan.png"/> 
                                </a>
                            <!--{/if}-->
                        <!--{/if}-->
                    </td>
                    <td class="tdShowHide">
                        <!--{if $phieuNhap[i].typechuyen eq 1}-->
                            <!--{if $phieuNhap[i].type eq 1}-->
                                <a href="javascript:void(0);" onclick="giahuy_xacnhanchuyenKhoSanXuat('tralaichuyenKhoSanXuat', <!--{$phieuNhap[i].cid}-->, <!--{$phieuNhap[i].id}-->, '<!--{$phieuNhap[i].typekho}-->')" title="Trả lại">
                                    <img src="<!--{$path_url}-->/images/tra-lai.png"/>    
                                </a>
                            <!--{/if}-->
                        <!--{/if}-->
                    </td>
                </tr>
                <!--{/section}-->
            </table>
        </div>
    </form>
</div>