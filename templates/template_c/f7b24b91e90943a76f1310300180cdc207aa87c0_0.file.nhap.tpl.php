<?php
/* Smarty version 4.1.1, created on 2023-09-20 10:36:49
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Huy-Kho-Test-Nhap-Kho\nhap.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650a68d1dd60b7_70810751',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'f7b24b91e90943a76f1310300180cdc207aa87c0' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Huy-Kho-Test-Nhap-Kho\\nhap.tpl',
      1 => 1695179825,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:KhoSanXuat-Huy-Kho-Test-Nhap-Kho/tabMenu.tpl' => 1,
  ),
),false)) {
function content_650a68d1dd60b7_70810751 (Smarty_Internal_Template $_smarty_tpl) {
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
/sources/-.php?act=dellist&cid=<?php echo $_REQUEST['cid'];?>
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
/sources/==.php?cid=<?php echo $_REQUEST['cid'];?>
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
                        <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="Xem" type="button"> 
                    
                    <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="In" type="button"> 
                    <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="Export Excel" type="button"> 
                    </div>
                </div>
            </div>
        </div>
        <?php $_smarty_tpl->_subTemplateRender('file:KhoSanXuat-Huy-Kho-Test-Nhap-Kho/tabMenu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <div class="MainTable fix-max-height">
            <table class="table-bordered">
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
                    <td style="min-width:100px">
                        <strong>Ngày import</strong>
                    </td>
                    <td style="min-width:130px">
                        <strong>Giờ import</strong>
                    </td>
                    <td style="min-width:130px">
                        <strong>Cửa hàng</strong>
                    </td>
                    <td style="min-width:130px">
                        <strong>Nơi đến</strong>
                    </td>
                    <td style="min-width:130px">
                        <strong>Ngày xác nhận</strong>
                    </td>
                    <td style="min-width:100px">
                        <strong>Số phiếu</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>Ghi chú</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>Loại vàng</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>Loại nữ trang</strong>
                    </td>
                    <td style="min-width:50px">
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
                    <td style="min-width:50px">
                        <strong>Trọng lượng</strong>
                    </td> 
                    <td style="min-width:50px">
                        <strong>TL Hột</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>TL vàng</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>Tiền hột</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>Tiền công</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>Tiền đá/ngọc trai</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>Duyệt nhập kho</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>Sửa</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>Trạng  thái</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>Số phiếu nhập kho</strong>
                    </td>
                    <td style="min-width:50px">
                        <strong>NV duyệt nhập kho</strong>
                    </td>
                    <td style="min-width:50px">
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
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="16"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangvh']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangh']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                    <td align="center" colspan="6"></td>
                </tr>
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="16"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangvh']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangh']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                    <td align="center" colspan="6"></td>
                </tr>
            </table>
        </div>
    </form>
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
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/tim-kiem.js"><?php echo '</script'; ?>
><?php }
}
