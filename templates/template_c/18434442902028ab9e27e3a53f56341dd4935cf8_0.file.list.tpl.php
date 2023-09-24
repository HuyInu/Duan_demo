<?php
/* Smarty version 4.1.1, created on 2023-09-23 09:22:26
  from 'C:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Nhap-Kho\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650e4be2e7dd29_77500884',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '18434442902028ab9e27e3a53f56341dd4935cf8' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Nhap-Kho\\list.tpl',
      1 => 1695434854,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:Kho-Nu-Trang-Tra-Ve-Nhap-Kho/tabMenu.tpl' => 1,
  ),
),false)) {
function content_650e4be2e7dd29_77500884 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
    .MainSearch {
        display: flex;
        align-items: center;
    }
    .title-thongtin {
        background: #eff3f8;
    }
    .SubAll {
        margin-top: -21px;
    }
</style>
<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
       <?php echo insert_HearderCat(array('cid' => $_REQUEST['cid'], 'root' => $_REQUEST['root'], 'act' => $_REQUEST['act']),$_smarty_tpl);?>
    </ul>
</div>
<div class="goAction">
	<ul>
    	<li>
            <?php if ($_smarty_tpl->tpl_vars['checkPer3']->value == "true") {?>
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?act=dellist&cid=<?php echo $_REQUEST['cid'];?>
');">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/delete.png">
               	</a> 
            <?php } else { ?>   
               	<a>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/delete-no.png">
               	</a> 
            <?php }?> 
        </li>
   </ul>
</div>
<div class="MainContent">
   <form name="f" id="f" method="post" onsubmit="return searchKhoTemDa('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?cid=<?php echo $_REQUEST['cid'];?>
')"> 
        <div class="MainSearch">
            <div class="formsearch">
                <label class="Fl labelsearch"> Từ ngày: </label>
                <input type="text" class="InputText textsearchdated" placeholder='dd/mm/yy' name="fromdays" id="fromdays" value="<?php echo $_smarty_tpl->tpl_vars['fromdays']->value;?>
" onchange="DateCheck()" autocomplete="off"/>
            </div>
            <div class="formsearch">
                <label class="Fl labelsearch"> Đến ngày: </label>
                <input type="text" class="InputText textsearchdated" placeholder='dd/mm/yy' name="todays" id="todays" value="<?php echo $_smarty_tpl->tpl_vars['todays']->value;?>
" onchange="DateCheck()" autocomplete="off"/>
            </div>
            <div class="formsearch"> 
                <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="Tìm kiếm" type="submit"> 
                <input type="reset" name="reset" value=" Làm mới " onclick=" return resetsfrsearchKeToanThuTien();" class="btn-save btn-search"/>
            </div>
            <div class="formsearch">
                <div class="box-thongin">
                    <div class="title-thongtin">Chi tiết</div>
                    <div class="SubAll">
                        <a href="Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?cid=<?php echo $_REQUEST['cid'];?>
&">
                            <input class="btn-save btn-search" value="Xem" type="button"> 
                        </a>
                    
                    <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="In" type="button"> 
                    <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="Export Excel" type="button"> 
                    </div>
                </div>
            </div>
        </div>
        <?php $_smarty_tpl->_subTemplateRender('file:Kho-Nu-Trang-Tra-Ve-Nhap-Kho/tabMenu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <div class="MainTable fix-max-height">
            <div class="table-scroll">
                <div class="table-wrap">
                    <table  class="table-bordered scroll-table">
                        <tr class="trheader" align="center">
                            <td style="min-width:30px">
                                <input type="checkbox" onclick="checkAll(this.checked);" name="all"/>
                            </td>
                            <td style="min-width:30px">
                                <strong>STT</strong>
                            </td>
                            <td style="min-width:130px">
                                <strong>Mã phiếu import</strong>
                            </td>
                            <td style="min-width:100px">
                                <strong>NV import</strong>
                            </td>
                            <td style="min-width:85px">
                                <strong>Ngày import</strong>
                            </td>
                            <td style="min-width:70px">
                                <strong>Giờ import</strong>
                            </td>
                            <td style="min-width:84px">
                                <strong>Cửa hàng</strong>
                            </td>
                            <td style="min-width:84px">
                                <strong>Nơi đến</strong>
                            </td>
                            <td style="min-width:85px">
                                <strong>Ngày xác nhận</strong>
                            </td>
                            <td style="min-width:100px">
                                <strong>Số phiếu</strong>
                            </td>
                            <td style="min-width:179px">
                                <strong>Ghi chú</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Loại vàng</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Loại nữ trang</strong>
                            </td>
                            <td style="min-width:91px">
                                <strong>Mã nữ trang</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Mã cũ</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Tên</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Số món</strong>
                            </td>
                            <td style="min-width:68px">
                                <strong>Trọng lượng</strong>
                            </td> 
                            <td style="min-width:68px">
                                <strong>TL Hột</strong>
                            </td>
                            <td style="min-width:68px">
                                <strong>TL vàng</strong>
                            </td>
                            <td style="min-width:101px">
                                <strong>Tiền hột</strong>
                            </td>
                            <td style="min-width:101px">
                                <strong>Tiền công</strong>
                            </td>
                            <td style="min-width:101px">
                                <strong>Tiền đá/ngọc trai</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Duyệt nhập kho</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Sửa</strong>
                            </td>
                            <td style="min-width:133px">
                                <strong>Trạng  thái</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Số phiếu nhập kho</strong>
                            </td>
                            <td style="min-width:122px">
                                <strong>NV duyệt nhập kho</strong>
                            </td>
                            <td style="min-width:108px">
                                <strong>Ngày/ giờ duyệt nhập kho</strong>
                            </td>
                        </tr>
                        <tr id="search">
                            <td></td>
                            <td></td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Mã phiếu import..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="NV import..." autocomplete="off" style="width:100% !important" />
                            </td>
                            <td>
                                <input type="text" class="InputText textsearchdated" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Ngày import..." autocomplete="off" style="width:100% !important" />
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Giờ import..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch text-right" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Cửa hàng..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch text-right" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Nơi đến..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Số phiếu..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Ghi chú..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Loại vàng..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Loại nữ trang..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Mã nữ trang..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Mã cũ..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tên..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Số món..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Trọng lượng..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="TL hột..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="TL vàng..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tiền hột..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tiền công..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tiền đá/ngọc trai..." autocomplete="off"/>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Trạng thái..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Số phiếu nhập kho..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="NV duyệt nhập kho..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Ngày/ giờ duyệt nhập kho..." autocomplete="off"/>
                            </td>
                        </tr>
                        <?php $_smarty_tpl->_assignInScope('slmon', 0);?>
                        <?php $_smarty_tpl->_assignInScope('tongCannangvh', 0);?>
                        <?php $_smarty_tpl->_assignInScope('tongCannangv', 0);?>
                        <?php $_smarty_tpl->_assignInScope('tongCannangh', 0);?>
                        <?php $_smarty_tpl->_assignInScope('tongTienHot', 0);?>
                        <?php $_smarty_tpl->_assignInScope('tongTienCong', 0);?>
                        <?php $_smarty_tpl->_assignInScope('tongTienDaNgocTrai', 0);?>
                        <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['view']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                        <tr>
                            <td>
                                <input type="checkbox" id="check<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>
" name="iddel[]" value="<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
"/>
                            </td>
                            <td>
                                <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieuimport'];?>

                            </td>
                            <td>
                                <?php echo getName('admin','fullname',$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['midimport']);?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datedimport'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['timeimport'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cuahang'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['noiden'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datedxacnhan'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['sophieu'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichu'];?>

                            </td>
                            <td>
                                <?php echo getName('loaivang','name_vn',$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang']);?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['loainutrang'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['manutrang'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['macu'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ten'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['slmon'];?>

                            </td>
                            <td>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'],3,".",",");?>

                            </td> 
                            <td>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3,".",",");?>

                            </td>
                            <td>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'],3,".",",");?>

                            </td>
                            <td>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienh']);?>

                            </td>
                            <td>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tiencong']);?>

                            </td>
                            <td>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tiendangoctrai']);?>

                            </td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['type'] == 0) {?>
                                    <?php if ($_smarty_tpl->tpl_vars['checkPer8']->value == 'true') {?>
                                        <a href="javascript:void(0)" onclick="giahuy_chuyenKhoNguonVaogo('nhapkhonutrangtrave', <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
,'1867', <?php echo $_smarty_tpl->tpl_vars['phongbanchuyen']->value;?>
, '')" title="Xác Nhận"> 
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/xac-nhan.png"/> 
                                        </a>
                                    <?php } else { ?>
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/xac-nhan-no.png"/> 
                                    <?php }?>
                                <?php }?>
                            </td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['type'] == 0) {?>
                                    <?php if ($_smarty_tpl->tpl_vars['checkPer2']->value == 'true') {?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?act=edit&cid=<?php echo $_REQUEST['cid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" title="Sửa"> 
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/edit.png"/> 
                                        </a>
                                    <?php } else { ?>
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/edit-no.png"/>
                                    <?php }?>
                                <?php }?>
                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['type'] == '0' ? 'Đang chờ nhập kho' : 'Đã nhập kho';?>

                            </td>
                            <td>
                                <strong>Số phiếu nhập kho</strong>
                            </td>
                            <td>
                                <?php echo getName('admin','fullname',$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['midnhap']);?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datednhap'];?>
<br><?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['timenhap'];?>

                            </td>
                        </tr>
                        <?php $_smarty_tpl->_assignInScope('slmon', $_smarty_tpl->tpl_vars['slmon']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['slmon']);?>
                        <?php $_smarty_tpl->_assignInScope('tongCannangvh', $_smarty_tpl->tpl_vars['tongCannangvh']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh']);?>
                        <?php $_smarty_tpl->_assignInScope('tongCannangv', $_smarty_tpl->tpl_vars['tongCannangv']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv']);?>
                        <?php $_smarty_tpl->_assignInScope('tongCannangh', $_smarty_tpl->tpl_vars['tongCannangh']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh']);?>
                        <?php $_smarty_tpl->_assignInScope('tongTienHot', $_smarty_tpl->tpl_vars['tongTienHot']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienh']);?>
                        <?php $_smarty_tpl->_assignInScope('tongTienCong', $_smarty_tpl->tpl_vars['tongTienCong']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tiencong']);?>
                        <?php $_smarty_tpl->_assignInScope('tongTienDaNgocTrai', $_smarty_tpl->tpl_vars['tongTienDaNgocTrai']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tiendangoctrai']);?>
                        <?php
}
}
?>
                        <tr class="Paging fontSizeTon">
                            <td align="right" colspan="16"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                            <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['slmon']->value;?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangvh']->value,3,".",",");?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangh']->value,3,".",",");?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongTienHot']->value);?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongTienCong']->value);?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongTienDaNgocTrai']->value);?>
 </span></td>
                            <td align="center" colspan="6"></td>
                        </tr>
                        <tr class="Paging fontSizeTon">
                            <td align="right" colspan="16"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                            <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['tongAll']->value['tongallslmon'];?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongAll']->value['tongallcannangvh'],3,".",",");?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongAll']->value['tongallcannangh'],3,".",",");?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongAll']->value['tongallcannangv'],3,".",",");?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongAll']->value['tongalltienh']);?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongAll']->value['tongalltiencong']);?>
 </span></td>
                            <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongAll']->value['tongalltiendangoctrai']);?>
 </span></td>
                            <td align="center" colspan="6"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </form>
    <div class="Paging">
      <div class="pgLeft">Tổng số <?php echo $_smarty_tpl->tpl_vars['total']->value;?>
 trang</div>
      <div class="pgRight">
         <?php echo $_smarty_tpl->tpl_vars['link_url']->value;?>
  
      </div>
   </div>
</div>
<link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.js"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/autoNumeric.js"><?php echo '</script'; ?>
>
<link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/search.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/jsapi.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/script.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/tim-kiem.js"><?php echo '</script'; ?>
><?php }
}
