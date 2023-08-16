<?php
/* Smarty version 4.1.1, created on 2023-08-16 16:07:20
  from 'D:\wamp64\www\duan_demo\templates\tpl\huytulam\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64dc91c8abcfa0_69913273',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '630410150bde3228f04cd69e96e9082236ddf7cc' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\huytulam\\list.tpl',
      1 => 1692176814,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:huytulam/sweetAlert.tpl' => 1,
  ),
),false)) {
function content_64dc91c8abcfa0_69913273 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['actResult']->value !== null) {?>
    <?php $_smarty_tpl->_subTemplateRender('file:huytulam/sweetAlert.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
<div class='container'>
    <div class="goAction">
        <ul>
            <li>
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/huymenu2.php?act=add&cid=<?php echo $_REQUEST['cid'];?>
');">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/add.png">
                </a> 
            
                <a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/huymenu2.php?act=dellist&cid=<?php echo $_REQUEST['cid'];?>
');">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/delete.png">
                </a> 
            
                <a href="javascript:void(0)" title="Show" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/huymenu2.php?act=show&cid=<?php echo $_REQUEST['cid'];?>
')" >
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/active.png" />
                </a> 

                <a href="javascript:void(0)" title="Hide" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/huymenu2.php?act=hide&cid=<?php echo $_REQUEST['cid'];?>
');">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/inactive.png" />
                </a> 
                
                <a href="javascript:void(0)" title="Order" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/huymenu2.php?act=order&cid=<?php echo $_REQUEST['cid'];?>
');">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/order.png" />
                </a>               
            </li>
        </ul>
    </div>
    <div class="MainContent">
        <div class="MainTable">
            <form name="f" id="f" method="post">
                <table  class="table-bordered">
                    <tr class="trheader">
                        <td class="tdcheck">
                            <input type="checkbox" id="grandCheck" name="all" onclick="Giahuy_checkdAllCheckBox(<?php echo count($_smarty_tpl->tpl_vars['categoriesList']->value);?>
, event)"/>                                  
                        </td>

                        <td class="tdSTT">
                            <strong>STT</strong>
                        </td>
                        
                        <td class="tdOrder">
                            <strong>THỨ TỰ</strong>
                        </td>
                        
                        <td>
                            <strong>TÊN</strong>
                        </td>
                        
                        <td>
                            <strong>TABLE</strong>
                        </td>
                        
                        <td>
                            <strong>TABLE CHI TIẾT</strong>
                        </td>

                        <td>
                            <strong>TABLE HẠCH TOÁN</strong>
                        </td>

                        <td width="10%">
                            <strong>Type Phòng Ban </strong>
                        </td>

                        <td width="10%">
                            <strong> COMPONENT </strong>
                        </td>
                        <td width="10%">
                            <strong> Mã Phòng Ban(PM A.Tuấn) </strong>
                        </td>
                        <td width="12%">
                            <strong> Phòng Ban Catalog </strong>
                        </td>
                        <td align="center" width="8%">
                            <strong>No Permission</strong>
                        </td>    
                        <td class="tdShowHide" align="center">
                            <strong>HIỆN/ẨN</strong>
                        </td>                                     
                        <td class="tdEdit">
                            <strong>SỬA</strong>
                        </td>
                    </tr>
                    <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['categoriesList']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                    <tr class="">
                        <td class="tdcheck">
                            <input type="checkbox" value='<?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
' name="checkedItemID[]" id="checkbox<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
"/>                                  
                        </td>

                        <td class="tdSTT">
                            <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>

                        </td>
                        
                        <td class="tdOrder">
                            <input type='text' class='InputOrder' name='num[]' value='<?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['num'];?>
' onkeypress="return onlyNumberKey(event)">
                            <input type='hidden' name='id[]' value= '<?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
'>
                        </td>
                        
                        <td>
                            <?php if ($_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['has_child'] === '1') {?>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/huymenu2?cid=<?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                                </a>
                            <?php } else { ?>
                                <?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                            <?php }?>
                        </td>
                        
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['table'];?>

                        </td>
                        
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tablect'];?>

                        </td>

                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tablehachtoan'];?>

                        </td>

                        <td width="10%">
                            <?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['typephongban'];?>

                        </td>
                        <td width="10%">
                            <?php $_smarty_tpl->assign('component',Giahuy_getComponentById($_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['comp']));?>
                            <?php if (count($_smarty_tpl->tpl_vars['component']->value) > 0 && $_smarty_tpl->tpl_vars['component']->value['id'] !== '0') {?>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['component']->value['do'];?>
/?cid=<?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['component']->value['name'];?>
</a>
                            <?php }?>
                            
                        </td>
                        <td width="10%">
                            <?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphongban'];?>

                        </td>
                        <td width="12%">
                            <?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['phongbancatalog'];?>

                        </td>
                        <td align="center" width="8%">
                            <img width="20" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/<?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['phongbancatalog'] === '0' ? 'active.png' : 'hide.png';?>
" alt="Show\Hide"  />
                        </td>    
                        <td class="tdShowHide" align="center">
                            <img width="20" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/<?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['active'] === '1' ? 'active.png' : 'hide.png';?>
" alt="Show\Hide"  />
                        </td>                                     
                        <td class="tdEdit">
                            <a href="huymenu2?act=edit&cid=<?php echo $_REQUEST['cid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['categoriesList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/edit.png"/> 
                            </a>
                        </td>
                    </tr>
                    <?php
}
}
?>
                                                     
                </table>
            </form>
            <div class="Paging">
                <div class="pgLeft">Tổng số <?php echo $_smarty_tpl->tpl_vars['total']->value;?>
 trang</div>
                <div class="pgRight">
                    <?php echo $_smarty_tpl->tpl_vars['link_url']->value;?>
  
                </div>
            </div>   
        </div>
    </div>
</div><?php }
}
