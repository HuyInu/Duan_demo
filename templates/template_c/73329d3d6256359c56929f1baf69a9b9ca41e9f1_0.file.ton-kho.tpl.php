<?php
/* Smarty version 4.1.1, created on 2023-10-02 15:35:54
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Thong-Ke\ton-kho.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_651a80ea6c05e6_19222091',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '73329d3d6256359c56929f1baf69a9b9ca41e9f1' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Thong-Ke\\ton-kho.tpl',
      1 => 1696235753,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_651a80ea6c05e6_19222091 (Smarty_Internal_Template $_smarty_tpl) {
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
	<form name="f" id="f" method="post" onsubmit="return searchKhoKhacKhoTongDeCucThongKe('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Thong-Ke.php?act=<?php echo $_REQUEST['act'];?>
&cid=<?php echo $_REQUEST['cid'];?>
')"> 
        <div class="MainSearch">
            <div class="formsearch">
                <label class="Fl labelsearch"> Từ ngày: </label>
                <input type="text" class="SearchCtrl InputText textsearchdated" placeholder='dd/mm/yy' name="fromdays" id="fromdays" value="<?php echo $_smarty_tpl->tpl_vars['fromdays']->value;?>
" onchange="DateCheck()" autocomplete="off"/>
            </div>
            <div class="formsearch">
                <label class="Fl labelsearch"> Đến ngày: </label>
                <input type="text" class="SearchCtrl InputText textsearchdated" placeholder='dd/mm/yy' name="todays" id="todays" value="<?php echo $_smarty_tpl->tpl_vars['todays']->value;?>
" onchange="DateCheck()" autocomplete="off"/>
            </div>
            <div class="formsearch">
                <select class="selectOption" id="idloaivang" name="idloaivang" >
                    <option value="">--Chọn loại vàng--</option>
                    <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['typegold']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['typegold']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['idloaivang']->value == $_smarty_tpl->tpl_vars['typegold']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id']) {?>selected="selected"<?php }?>>
                            <?php echo $_smarty_tpl->tpl_vars['typegold']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                        </option>
                    <?php
}
}
?>
                </select>
            </div>
            <div class="formsearch"> 
                <input class="btn-save btn-search" value="Tìm kiếm" type="submit"> 
                <input type="button" name="reset" value=" Làm mới " onclick="ResetSearch();" class="btn-save btn-search"/>
            <?php if ($_smarty_tpl->tpl_vars['checkPer10']->value == "true") {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Import.php?act=importexcel&cid=<?php echo $_REQUEST['cid'];?>
" title="Import Excel">
                    <input type="button" name="importexcel" value=" Import Excel " class="btn-save btn-search"/>
                </a>
            <?php }?>
            </div>
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td align="center">
                        <strong>Loại Vàng</strong>
                    </td>
                    <td align="center">
                        <strong>Số Dư Đầu Kỳ</strong>
                    </td>
                    <td align="center">
                        <strong>Số Lượng Nhập</strong>
                    </td>
                    <td align="center">
                        <strong>Số Lượng Xuất</strong>
                    </td>
                    <td align="center">
                        <strong>Hao</strong>
                    </td>
                    <td align="center">
                        <strong>Dư</strong>
                    </td>

                    <td align="center">
                        <strong>Tồn</strong>
                    </td>
                    <td align="center">
                        <strong>Tổng Trọng Lượng Q10</strong>
                    </td>
                </tr>
                <?php $_smarty_tpl->_assignInScope('tongQ10', 0);?>
				<?php
$__section_i_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['typegoldview']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_1_total = $__section_i_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_1_total !== 0) {
for ($__section_i_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_1_iteration <= $__section_i_1_total; $__section_i_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                	<?php $_smarty_tpl->_assignInScope('viewdl', ThongKeKhoNuTrangTraVe($_REQUEST['cid'],$_smarty_tpl->tpl_vars['typegoldview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'],$_smarty_tpl->tpl_vars['fromDate']->value,$_smarty_tpl->tpl_vars['toDate']->value));?>
                    <?php if ($_smarty_tpl->tpl_vars['viewdl']->value['idloaivang'] > 0) {?>
                        <tr class="fontSizeTon">
                            <td align="right">
                                <?php echo $_smarty_tpl->tpl_vars['typegoldview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                           </td>
                           <td align="right">
                                <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['sltonsddk'],3,".",",");?>

                           </td>
                           <td align="right">
                                <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slnhap'],3,".",",");?>

                           </td>
                           <td align="right">
                                <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slxuat'],3,".",",");?>

                           </td>
                           <td align="right">
                                <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slhao'],3,".",",");?>

                           </td>
                           <td align="right">
                                <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['sldu'],3,".",",");?>

                           </td>
                            
                           <td align="right">
                                <strong><?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slton'],3,".",",");?>
</strong>
                           </td>
                           <td align="right">

                                <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['tongQ10'],3,".",",");?>

                                <?php $_smarty_tpl->_assignInScope('tongQ10', $_smarty_tpl->tpl_vars['tongQ10']->value+$_smarty_tpl->tpl_vars['viewdl']->value['tongQ10']);?>
                           </td> 
                        </tr>  
                     <?php }?> 
                <?php
}
}
?>
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="7"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
                    <td align="right"><strong class="colorXanh"><?php echo number_format($_smarty_tpl->tpl_vars['tongQ10']->value,3,".",",");?>
 </strong></td>
                </tr>                                                                        
            </table>
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
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/tim-kiem.js"><?php echo '</script'; ?>
><?php }
}
