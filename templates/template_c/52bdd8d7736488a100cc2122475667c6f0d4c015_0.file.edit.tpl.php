<?php
/* Smarty version 4.1.1, created on 2023-09-20 08:22:15
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-A9-Huy-Nhap-Kho\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650a494779e563_03809254',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '52bdd8d7736488a100cc2122475667c6f0d4c015' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-A9-Huy-Nhap-Kho\\edit.tpl',
      1 => 1694575936,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tabVangKimcuong.tpl' => 1,
  ),
),false)) {
function content_650a494779e563_03809254 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\wamp64\\www\\duan_demo\\libraries\\smarty4\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.js"><?php echo '</script'; ?>
>

<div class="MainContent">
    <form method='post' enctype="multipart/form-data">
        <input type='file' id='excel'>
        <button type="button" id='import' onclick="importExcel(<?php echo $_REQUEST['cid'];?>
)">Import</button>
    </form>
	<form name="allsubmit" id="frmEdit" action="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Huy-Nhap-Kho.php?act=<?php if ($_REQUEST['act'] == 'add') {?>addsm<?php } else { ?>editsm<?php }?>&cid=<?php echo $_REQUEST['cid'];?>
" method="post" enctype="multipart/form-data">
        <div class="main-content padding-topfooter">
            <div class="panel-left">
                <div class="box-thongin">
                    <div class="title-thongtin">Thông Tin Phiếu Nhập Kho</div>                   
                    <div class="SubAll">
                        <div class="SubLeft">
                            Người Lập Phiếu
                        </div>
                        
                        <div class="SubRight">
                            <input name="nguoilapphieu" id="nguoilapphieu" value="<?php echo $_smarty_tpl->tpl_vars['toa']->value['nguoilapphieu'];?>
" class="InputText" type="text"/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Đơn Vị
                        </div>
                        
                        <div class="SubRight">
                            <input name="donvilapphieu" id="donvilapphieu" value="<?php echo $_smarty_tpl->tpl_vars['toa']->value['donvilapphieu'];?>
" class="InputText" type="text" />
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Người Duyệt Phiếu
                        </div>
                        
                        <div class="SubRight">
                            <input name="nguoiduyetphieu" id="nguoiduyetphieu" value="<?php echo $_smarty_tpl->tpl_vars['toa']->value['nguoiduyetphieu'];?>
" class="InputText" type="text"/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Đơn Vị
                        </div>
                        
                        <div class="SubRight">
                            <input name="donviduyetphieu" id="donviduyetphieu" value="<?php echo $_smarty_tpl->tpl_vars['toa']->value['donviduyetphieu'];?>
" class="InputText" type="text"/>
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Lý Do
                        </div>
                        
                        <div class="SubRight">
                            <input name="lydo" id="lydo" value="<?php echo $_smarty_tpl->tpl_vars['toa']->value['lydo'];?>
" class="InputText" type="text" autocomplete="off" />
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="panel-right">
                <div class="box-thongin">
                    <div class="title-thongtin">Chứng từ</div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Mã phiếu
                        </div>
                        <div class="SubRight">
                            <input readonly="readonly" name="maphieu" id="maphieu" value="<?php echo $_smarty_tpl->tpl_vars['toa']->value['maphieu'];?>
" class="InputText" type="text"  />
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Ngày nhập
                        </div>
                        
                        <div class="SubRight">
                            <input type="text" class="InputText" name="datedchungtu" id="datedchungtu" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['toa']->value['datedchungtu'],'%d/%m/%Y');?>
"  readonly="readonly" />
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Ngày hạch toán
                        </div>
                        
                        <div class="SubRight">
                            <input type="text" class="InputText" name="datedhachtoan" id="datedhachtoan" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['toa']->value['datedhachtoan'],'%d/%m/%Y');?>
" readonly="readonly" />
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Upload File Excel
                        </div>
                        <div class="SubRight">
                        	<input type="file" name="fileexcel" id="fileexcel" onchange="check_file('fileexcel');" />
                            <?php if ($_smarty_tpl->tpl_vars['toa']->value['fileexcel'] != '') {?>
                            	<a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['toa']->value['fileexcel'];?>
" title="Tải file"> 
                                	<img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/down-load.png">
                                </a>
                            <?php }?>                           
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="box-thongin">
        	<div class="title-thongtin">Nội dung</div>
            <div class="MainTable">
                <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tabVangKimcuong.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <div class="table2scroll">
                    <table width="100%" border="1" id="addRowGirlVang" class="vang">
                        <tr class="trheader">
                            <td width="3%" align="center">
                                <strong>STT</strong>
                            </td> 
                            <td width="13%" align="center">
                                <strong>Nhóm Nguyên Liệu</strong>
                            </td>
                            <td width="13%" align="center">
                                <strong>Tên Nguyên Liệu</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Loại Vàng</strong>
                            </td>
                            <td width="10%" align="center">
                                <strong>Cân Nặng V+H</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Cân Nặng H</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Cân Nặng V</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Tuổi Vàng</strong>
                            </td>
                            <td width="12%" align="center">
                                <strong>Tiền Mặt</strong>
                            </td>
                            <td width="17%" align="center">
                                <strong>Ghi Chú</strong>
                            </td>
                        </tr>
                        <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['ctToaVang']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                        <tr>
                            <td width="3%" align="center">
                                 <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
 
                                 <input type="hidden" name="idctnxvang[]" value="<?php echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" />
                            </td> 
                            <td width="13%" align="center">
                                <input type="hidden" name="nhomnguyenlieuvang[]" id="nhomnguyenlieuvang<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieuvang'];?>
" />
                                <a id="popupNhomDanhMucVang<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/popup/DanhMucNguyenLieu.php?type=vang&idnhomdm=<?php echo $_smarty_tpl->tpl_vars['nhomdanhmuc']->value['id'];?>
&idnhomnguyenlieuvang=<?php echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieuvang'];?>
&idtennguyenlieuvang=<?php echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieuvang'];?>
&idshow=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
">
                                    <span id="showtennhomnguyenlieuvang<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
">
                                        <?php if ($_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieuvang'] > 0) {?>
                                            <?php ob_start();
echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieuvang'];
$_prefixVariable1 = ob_get_clean();
echo getName('categories','name_vn',$_prefixVariable1);?>

                                        <?php } else { ?>
                                            Click chọn
                                        <?php }?>    
                                    </span>
                                </a>
                                <?php echo '<script'; ?>
 type="text/javascript">
                                    $(document).ready(function() {
                                        $("#popupNhomDanhMucVang<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
").fancybox();
                                    }); 
                                <?php echo '</script'; ?>
>
                            </td>
                            <td width="13%" align="center">
                                <input type="hidden" name="tennguyenlieuvang[]" id="tennguyenlieuvang<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieuvang'];?>
" />
                                <span id="showtennguyenlieuvang<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
">
                                    <?php ob_start();
echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieuvang'];
$_prefixVariable2 = ob_get_clean();
echo getName('categories','name_vn',$_prefixVariable2);?>

                                </span>
                            </td>
                            <td width="8%" align="center">
                                <?php echo loadloaivang($_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang'],'',(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1);?>

                            </td>
                            <td width="10%" align="center">
                                <input type="text" autocomplete="off" name="cannangvh[]" id="cannangvh<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'];?>
" class="txtdatagirld text-right autoNumeric" onkeyup="getslcannangv(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
)"/>
                            </td>
                            <td width="8%" align="center">
                                <input type="text" autocomplete="off" name="cannangh[]" id="cannangh<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'];?>
" class="txtdatagirld text-right autoNumeric" onkeyup="getslcannangv(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
)"/>
                            </td>
                            <td width="8%" align="center">
                                <input type="text" autocomplete="off" name="cannangv[]" id="cannangv<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'];?>
" class="txtdatagirld text-right autoNumeric"/>
                            </td>
                            <td width="8%" align="center">
                                <input type="text" autocomplete="off" name="tuoivang[]" id="tuoivang<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tuoivang'];?>
" class="txtdatagirld text-right autoNumeric"/>
                            </td>
                            <td width="12%" align="center">
                                <input type="text" autocomplete="off" name="tienmatvang[]" id="tienmatvang<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienmatvang'];?>
" class="txtdatagirld text-right autoNumeric"/> 
                            </td>
                            <td width="17%" align="center">
                                <input type="text" autocomplete="off" name="ghichuvang[]" id="ghichuvang<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ctToaVang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichuvang'];?>
" class="txtdatagirld text-right"/>
                            </td>
                        </tr>
                        <?php
}
}
?>
                    </table>
                </div>
                <div class="table2scroll">         
                   <table width="100%" border="1" id="addRowGirlKimCuong" class="kimcuong">
                        <tr class="trheader">
                            <td width="3%" align="center">
                                <strong>STT</strong>
                            </td> 
                            <td width="9%" align="center">
                                <strong>Nhóm Nguyên Liệu</strong>
                            </td>
                            <td width="9%" align="center">
                                <strong>Tên Nguyên Liệu</strong>
                            </td>
                             <td width="7%" align="center">
                                <strong>Tên Kim Cương</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>MS GĐPNJ</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>MS Cạnh GIA</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Kích Thước</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Trọng Lượng Hột</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Độ Tinh Khiết</strong>
                            </td>
                            
                             <td width="7%" align="center">
                                <strong>Cấp Độ Màu</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Độ Mài Bóng</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Kích Thước Bán</strong>
                            </td>
                            
                            <td width="9%" align="center">
                                <strong>Tiền Mặt</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Đơn Giá</strong>
                            </td>  
                        </tr>
                         <?php
$__section_i_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['viewtcctkimcuong']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_1_total = $__section_i_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_1_total !== 0) {
for ($__section_i_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_1_iteration <= $__section_i_1_total; $__section_i_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                            <tr>
                                 <td align="left">
                                    <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1+$_smarty_tpl->tpl_vars['number']->value;?>

                                    <input type="hidden" name="idctnxkimcuong[]" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" />
                                 </td>
                          
                                 <td align="left" class="kimcuong">
                                    <input type="hidden" name="nhomnguyenlieukimcuong[]" id="nhomnguyenlieukimcuong<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieukimcuong'];?>
" />
                                    <a id="popupNhomDanhMucKimCuong<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/popup/DanhMucNguyenLieu.php?type=kimcuong&idnhomdm=<?php echo $_smarty_tpl->tpl_vars['nhomdanhmuc']->value['id'];?>
&idnhomnguyenlieukimcuong=<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieukimcuong'];?>
&idtennguyenlieukimcuong=<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieukimcuong'];?>
&idshow=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
">
                                       <span id="showtennhomnguyenlieukimcuong<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
">
                                            <?php if ($_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieukimcuong'] > 0) {?>
                                                <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieukimcuong']),$_smarty_tpl);?>
                                            <?php } else { ?>
                                                Click chọn
                                            <?php }?>
                                       </span>
                                    </a>
                                    <?php echo '<script'; ?>
 type="text/javascript">
                                       $(document).ready(function() {
                                            $("#popupNhomDanhMucKimCuong<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
").fancybox();
                                        }); 
                                    <?php echo '</script'; ?>
>
    
                                 </td>
                                 
                                 <td align="left" class="kimcuong">
                                     <input type="hidden" name="tennguyenlieukimcuong[]" id="tennguyenlieukimcuong<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieukimcuong'];?>
" />
                                      <span id="showtennguyenlieukimcuong<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
">
                                            <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieukimcuong']),$_smarty_tpl);?>
                                      </span>
                                 </td>
                                 <td align="left" class="kimcuong">
                                    <input type="hidden" name="idkimcuong[]" id="idkimcuong<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" value="222" /><!--$viewtcctkimcuong[i].idkimcuon}-->
                                    {* <a id="popupKimCuongHotChu<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/popup/KimCuongHotChu.php?idkimcuong=<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idkimcuong'];?>
&idshow=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
">
                                       <span id="showtennkimcuong<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
">
                                            <?php if ($_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idkimcuong'] > 0) {?>
                                                <?php echo insert_getName(array('table' => 'loaikimcuonghotchu', 'names' => 'size', 'id' => $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idkimcuong']),$_smarty_tpl);?>::<?php echo insert_getName(array('table' => 'loaikimcuonghotchu', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idkimcuong']),$_smarty_tpl);?>
                                            <?php } else { ?>
                                                Click chọn tên
                                            <?php }?>
                                       </span>
                                    </a> 
                                    <?php echo '<script'; ?>
 type="text/javascript">
                                       $(document).ready(function() {
                                            $("#popupKimCuongHotChu<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
").fancybox();
                                        }); 
                                    <?php echo '</script'; ?>
>*}
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="codegdpnj[]" id="codegdpnj<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['codegdpnj'];?>
"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="codecgta[]" id="codecgta<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['codecgta'];?>
"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="kichthuoc[]" id="kichthuoc<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['kichthuoc'];?>
"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="trongluonghot[]" id="trongluonghot<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['trongluonghot'];?>
"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="dotinhkhiet[]" id="dotinhkhiet<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dotinhkhiet'];?>
"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="capdomau[]" id="capdomau<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['capdomau'];?>
"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="domaibong[]" id="domaibong<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['domaibong'];?>
"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="kichthuocban[]" id="kichthuocban<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['kichthuocban'];?>
"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="tienmatkimcuong[]" id="tienmatkimcuong<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienmatkimcuong'];?>
"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text"  autocomplete="off" name="dongiaban[]" id="dongiaban<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dongiaban'];?>
"/>
                                 </td>
                            </tr>
                        <?php
}
}
?> 
                    </table>
                </div>
            </div>
            <div class="addRowGirlMain">
                <a href="javascript:void(0)" onclick="addNewRowGirlVang('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
',<?php echo $_smarty_tpl->tpl_vars['nhomdanhmuc']->value['id'];?>
)" class="addRowGirl vang"> <strong>Thêm dòng</strong> </a>
                <a href="javascript:void(0)" onclick="addNewRowGirlKimCuong('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
',<?php echo $_smarty_tpl->tpl_vars['nhomdanhmuc']->value['id'];?>
)" class="addRowGirl kimcuong"> <strong>Thêm dòng</strong> </a>
            </div>
        </div>
        <div class="MainContent TextCenter"> 
        	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['toa']->value['id'];?>
" />
            <input type="hidden" name="idnumvang" id="idnumvang" value="<?php echo $_smarty_tpl->tpl_vars['coutndongvang']->value;?>
" />
            <input type="hidden" name="idnumkimcuong" id="idnumkimcuong" value="<?php echo $_smarty_tpl->tpl_vars['coutndongkimcuong']->value;?>
" />
            <input type="button" class="btn-save" onclick=" return SubmitFromPTKhoNguonVao();" value="  Lưu " /> 
        </div>
   </form>
</div>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/autoNumeric.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/functions/function.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/fancybox/jquery.fancybox-1.3.1.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/fancybox/jquery.fancybox-1.3.1.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/popup/dialog.css">
<?php echo '<script'; ?>
>
$(document).ready(function() {
	$("#datedchungtu").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
 });
<?php echo '</script'; ?>
>	<?php }
}
