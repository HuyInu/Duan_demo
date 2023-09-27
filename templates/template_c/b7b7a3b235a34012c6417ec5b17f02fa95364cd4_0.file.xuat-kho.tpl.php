<?php
/* Smarty version 4.1.1, created on 2023-09-27 14:10:18
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Thong-Ke\xuat-kho.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6513d55a03a499_08601028',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'b7b7a3b235a34012c6417ec5b17f02fa95364cd4' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Thong-Ke\\xuat-kho.tpl',
      1 => 1695798466,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6513d55a03a499_08601028 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="breadcrumb">
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
<div class="MainContent">
   <form name="f" id="f" method="post" onsubmit="return searchKhoNuTrangTraVe('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Thong-Ke.php?act=<?php echo $_REQUEST['act'];?>
&cid=<?php echo $_REQUEST['cid'];?>
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
                <input class="btn-save btn-search" value="Tìm kiếm" type="submit"> 
                <input type="reset" name="reset" value=" Làm mới " onclick=" return resetsfrsearchKeToanThuTien();" class="btn-save btn-search"/>
                <input type="button" name="print" value="     In     " class="btn-save btn-search"/>
                <input type="button" name="print" value="Export Excel" onclick=" return ExportExcelVangNguyenLieuCongTyTabNhapKho('ExportExcelChiTiet',<?php echo $_REQUEST['cid'];?>
,'<?php echo $_smarty_tpl->tpl_vars['fromdays']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['todays']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['strSearch']->value;?>
');" class="btn-save btn-search"/>
            </div>
        </div>
   </from>
</div><?php }
}
