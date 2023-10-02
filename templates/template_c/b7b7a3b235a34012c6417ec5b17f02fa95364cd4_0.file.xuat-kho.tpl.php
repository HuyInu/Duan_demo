<?php
/* Smarty version 4.1.1, created on 2023-09-29 11:49:24
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Thong-Ke\xuat-kho.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_65165754ecba46_42096135',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'b7b7a3b235a34012c6417ec5b17f02fa95364cd4' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Thong-Ke\\xuat-kho.tpl',
      1 => 1695798935,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65165754ecba46_42096135 (Smarty_Internal_Template $_smarty_tpl) {
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
        <div class="MainTable">
            <div class="table-scroll">
                <div class="table-wrap">
                    <table class="table-bordered scroll-table">
                        <tr class="trheader" align="center">
                            <td style="min-width:30px">
                                <strong>STT</strong>
                            </td>
                            <td style="min-width:108px">
                                <strong>Ngày xuất kho</strong>
                            </td>
                            <td style="min-width:130px">
                                <strong>Mã phiếu xuất kho</strong>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
   </from>
</div><?php }
}
