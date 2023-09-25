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
	<form name="f" id="f" method="post" action="Kho-Nu-Trang-Tra-Ve-Xuat-Kho?act=<!--{if $smarty.request.act eq 'add' }-->addsm<!--{else}-->editsm<!--{/if}-->&cid=<!--{$smarty.request.cid}-->">
        <div class="main-content padding-topfooter">
            <div class="panel-left">
                <div class="box-thongin">
                    <div class="title-thongtin">Thông Tin Phiếu</div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Ngày xuất kho:
                        </div>
                        
                        <div class="SubRight">
                            <input  type="text" value="<!--{$datedxuat}-->" name="datedxuat" class="InputText" readonly/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Mã phiếu xuất kho:
                        </div>
                        
                        <div class="SubRight">
                            <input value="<!--{$maphieu}-->" name="maphieu" class="InputText"  autocomplete="off" readonly/>
                        </div>
                    </div>

                    <div class="SubAll">
                        <div class="SubLeft">
                            Mã phiếu trả kho:
                        </div>
                        
                        <div class="SubRight">
                            <select id="sophieu" name="sophieu" onchange="LoadDuLieuHangTraKho(<!--{$smarty.request.cid}-->)">
                                <option value="0" selected disabled>Chọn mã phiếu trả kho</option>
                                <!--{section i loop=$sophieu}-->
                                <option value="<!--{$sophieu[i]}-->"><!--{$sophieu[i]}--></option>
                                <!--{/section}-->
                            </select>
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                </div>
            </div>
            <div class="panel-right">
                <div class="box-thongin">
                    <div class="title-thongtin">Thông Tin Xuất</div>
                    
                    <div>
                        <div class="panel-left">
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Nhóm Nguyên Liệu:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="hidden" name="nhomnguyenlieuvang" id="nhomnguyenlieuvang" value="<!--{$viewtc[i].nhomnguyenlieuvang}-->" />
                                    <a id="popupNhomDanhMucVang" href="<!--{$path_url}-->/popup/DanhMucNguyenLieu.php?type=vang&idnhomdm=<!--{$nhomdanhmuc.id}-->&idnhomnguyenlieuvang=<!--{$viewtc[i].nhomnguyenlieuvang}-->&idtennguyenlieuvang=<!--{$viewtc[i].tennguyenlieuvang}-->&idshow=<!--{$smarty.section.i.index+1}-->">
                                        <span id="showtennhomnguyenlieuvang">
                                            <!--{if $viewtc[i].nhomnguyenlieuvang gt 0}-->
                                                <!--{insert name='getName' table='categories' names='name_vn' id=$viewtc[i].nhomnguyenlieuvang}-->
                                            <!--{else}-->
                                                Click chọn
                                            <!--{/if}-->    
                                        </span>
                                    </a>
                                    <script type="text/javascript">
                                       $(document).ready(function() {
                                            $("#popupNhomDanhMucVang").fancybox();
                                        }); 
                                    </script>
                                </div>
                            </div>
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Tên Nguyên Liệu:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="hidden" name="tennguyenlieuvang" id="tennguyenlieuvang" value="" />
                                    <span id="showtennguyenlieuvang">
                                        <!--{insert name='getName' table='categories' names='name_vn' id=$viewtc[i].tennguyenlieuvang}-->
                                    </span>
                                </div>
                            </div>
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Loại vàng:
                                </div>
                                
                                <div class="SubRight">
                                    <select class="selectOption" id="idloaivang" name="idloaivang" >
                                        <option value="">--Chọn loại vàng--</option>
                                        <!--{section name=i loop=$typegold}-->
                                        <option value="<!--{$typegold[i].id}-->" <!--{if $viewtc.idloaivang eq $typegold[i].id}-->selected="selected"<!--{/if}-->>
                                            <!--{$typegold[i].name_vn}-->
                                        </option>
                                        <!--{/section}-->
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="panel-right">
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng V+H:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld autoNumeric" autocomplete="off" name="cannangvh" id="cannangvh" value="0.000" onchange="getslcannangv('')"/>
                                </div>
                            </div>

                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng H:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld autoNumeric" autocomplete="off" name="cannangh" id="cannangh" value="0.000" onchange="getslcannangv('')"/>
                                </div>
                            </div>

                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng V:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld autoNumeric" autocomplete="off" name="cannangv" id="cannangv" value="0.000"/>
                                </div>
                            </div>
  
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Ghi chú:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="" autocomplete="off" name="ghichu" id="ghichu"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="box-thongin">
            <div class="title-thongtin">Nội Dung (Dữ liệu chuyển hàng trả kho)</div>
            <div class="MainTable">
                <table class="table-bordered" id="DataTable">
                    <tr id="headTableData" class="trheader" align="center">
                        <td style="min-width:30px"></td>
                        <td style="min-width:64px">
                            <strong>Trạng thái</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Cửa hàng</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Nơi đến</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Nhân viên</strong>
                        </td>
                        <td style="min-width:84px">
                            <strong>Ngày</strong>
                        </td>
                        <td style="min-width:84px">
                            <strong>Ngày xác nhận</strong>
                        </td>
                        <td style="min-width:74px">
                            <strong>Số phiếu</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Cửa hàng trước</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>STT</strong>
                        </td>
                        <td style="min-width:129px">
                            <strong>Ghi chú</strong>
                        </td>
                        <td style="min-width:67px">
                            <strong>Nhà cung cấp</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Loại vàng</strong>
                        </td>
                        <td style="min-width:53px">
                            <strong>Loại nữ trang</strong>
                        </td>
                        <td style="min-width:53px">
                            <strong>Mã nữ trang</strong>
                        </td>
                        <td style="min-width:53px">
                            <strong>Mã cũ</strong>
                        </td>
                        <td style="min-width:53px">
                            <strong>Tên</strong>
                        </td>
                        <td style="min-width:129px">
                            <strong>Ghi chú</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>GVH</strong>
                        </td>
                        <td style="min-width:50px">
                            <strong>TTL</strong>
                        </td>
                        <td style="min-width:50px">
                            <strong>TL Hột</strong>
                        </td>
                        <td style="min-width:50px">
                            <strong>TL Hột(Gr)</strong>
                        </td>
                        <td style="min-width:50px">
                            <strong>TL Vàng</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Tiền hột</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Tiền công</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>CVSP</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Tiền Đá/Ngọc trai</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Tiền công hột bán</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Thành tiền</strong>
                        </td>
                        <td style="min-width:109px">
                            <strong>MSM</strong>
                        </td>
                        <td style="min-width:126px">
                            <strong>Chi tiết hột tấm</strong>
                        </td>
                        <td style="min-width:126px">
                            <strong>Chi tiết hột tấm thực tế</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>KH</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Mã số mẫu Catalogue 1</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Mã số mẫu Catalogue 2</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Giá bán</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Số món</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Khuyến mãi</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Giá tạm tính</strong>
                        </td>
                    </tr>
                    <tr class='trfooter'>
                        <td align="right" colspan="19"> <strong class="colorXanh">Tổng:</strong> </td>
                        <td align="left"><span class="colorXanh" id="tongCannangVH"></span></td>
                        <td align="left"><span class="colorXanh" id="tongCannangH"></span></td>
                        <td></td>
                        <td align="left"><span class="colorXanh" id="tongCannangV"></span></td>
                        <td align="left"></td>
                        <td align="left"><span class="colorXanh" id="tongTienCong"></span></td>
                        <td colspan="14"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="MainContent TextCenter"> 
        	<input type="hidden" name="id" value="<!--{$edit.id}-->" />
            <input type="button" class="btn-save" onclick=" return submitKhoNuTrangTraVe()" value="  Lưu " /> 
        </div>
    </form>
</div>
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/functions/function.js"></script>
<script src="<!--{$path_url}-->/fancybox/jquery.fancybox-1.3.1.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/fancybox/jquery.fancybox-1.3.1.css">
<link rel="stylesheet" href="<!--{$path_url}-->/popup/dialog.css">
<script>
    function LoadDuLieuHangTraKho (cid) {
        const sophieu = $('#sophieu').val();
        $('#loadingAjax').show();
        $.post('Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php',
            {
                act:'loaddulieutrakho',
                cid:cid,
                sophieu: sophieu
            },
            function(data) {																				
                var obj = jQuery.parseJSON(data);
                if (obj.status == 'success') {
                    let data = null;
                    resetCannang()
                    $('#DataTable tr:not(.trheader):not(.trfooter)').remove();
                    $('#headTableData').after(obj.html);
                    $('#tongCannangVH').html(obj.tong.tongCannangVH)
                    $('#tongCannangH').html(obj.tong.tongCannangH)
                    $('#tongCannangV').html(obj.tong.tongCannangV)
                    $('#tongTienCong').html(obj.tong.tongTienCong)
                    $('#loadingAjax').hide();
                } else {
                    $('#loadingAjax').hide();
                    alert(obj.status);	 
                }
        });
    }
    function getCell (evt) {
        const thisCheckbox = $(evt)
        const cannangvhTbox = $('#cannangvh')
        const cannanghTbox = $('#cannangh')
        const cannangvh = thisCheckbox.attr('cannangvh')
        const cannangh = thisCheckbox.attr('cannangh')
        let cannangvhPlus = 0
        let cannanghPlus = 0
        if (thisCheckbox.prop('checked') == true) {
            cannangvhPlus = parseFloat(cannangvhTbox.val() === '' ? 0 : cannangvhTbox.val()) + parseFloat(cannangvh)
            cannanghPlus = parseFloat(cannanghTbox.val() === '' ? 0 : cannanghTbox.val()) + parseFloat(cannangh)
            
        } else {
            cannangvhPlus = parseFloat(cannangvhTbox.val() === '' ? 0 : cannangvhTbox.val()) - parseFloat(cannangvh)
            cannanghPlus = parseFloat(cannanghTbox.val() === '' ? 0 : cannanghTbox.val()) - parseFloat(cannangh)
        }
        cannangvhTbox.val(number_format(cannangvhPlus, 3, ","))
        cannanghTbox.val(number_format(cannanghPlus, 3, ","))
        getslcannangv('')
    }
    function number_format (number,decimalPosition, thousands_separator) {
        return roundNumber(number, decimalPosition).toFixed(decimalPosition).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, thousands_separator)
    }
    function resetCannang () {
        $('#cannangvh').val('0.000')
        $('#cannangh').val('0.000')
        $('#cannangv').val('0.000')
    }
    function roundNumber(num, scale) {
        if(!("" + num).includes("e")) {
            return +(Math.round(num + "e+" + scale)  + "e-" + scale);
        } else {
            var arr = ("" + num).split("e");
            var sig = ""
            if(+arr[1] + scale > 0) {
            sig = "+";
            }
            return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
        }
    }
    function submitKhoNuTrangTraVe () {
        let tongCanNangVSelected = 0
        const canNangV = roundNumber(parseFloat($('#cannangv').val()), 3)
        $('.check-phieu:checkbox:checked').each(function () {
            tongCanNangVSelected += roundNumber(parseFloat($(this).attr('cannangv')), 3)
        });
        if (canNangV !== tongCanNangVSelected) {
            alert('Tổng cân nặng vàng phiếu được chọn phải bằng với cân nặng vàng trên thông tin xuất.')
            return
        }
        if ($('#sophieu').val() === null) {
            alert('Vui lòng chọn mã phiếu trả kho.')
            return
        }
        document.forms.f.submit()
    }
</script>