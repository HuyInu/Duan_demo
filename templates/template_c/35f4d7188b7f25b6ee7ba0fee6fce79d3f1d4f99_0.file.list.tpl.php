<?php
/* Smarty version 4.1.1, created on 2023-08-12 13:32:49
  from 'C:\wamp64\www\duan_demo\templates\tpl\users\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d727912769b9_35026283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35f4d7188b7f25b6ee7ba0fee6fce79d3f1d4f99' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\users\\list.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64d727912769b9_35026283 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="breadcrumb">
    <ul>
        <li>
        	<a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <li>
        	<span>&raquo;</span>
        	<a title=" QUẢN LÝ ACCOUNT" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/users.php">		
                QUẢN LÝ ACCOUNT
            </a> 
        </li>
    </ul>
</div>
<div class="goAction">
	<ul>
    	<li>
            <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/users.php?act=add');">
                <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/add.png">
            </a> 
        
            <a href="javascript:void(0)" title="Xóa" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/users.php?act=dellist');">
                <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/delete.png">
            </a>     
        </li>
    </ul>
</div>

<div class="MainContent">
    <!--<div class="MainSearch">
    	ádfasd
    </div>-->
    <div class="MainTable">
    	<form name="f" id="f" method="post">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdcheck"></td>
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>

                    <td>
                        <strong>TÊN</strong>
                    </td>
                    
                    <td>
                        <strong>User Name</strong>
                    </td>
                   
                    <td class="tdEdit" align="center">
                        <strong>Permission</strong>
                    </td>                                     
                    <td class="tdEdit">
                        <strong>SỬA</strong>
                    </td>
                </tr>
 				<?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['view']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                    <tr id="g<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['mspid'];?>
">
                       <td>
                            <input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" name="iddel[]" id="check<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>
">
                       </td>
                       <td>
                            <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1+$_smarty_tpl->tpl_vars['number']->value;?>

                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['fullname'];?>

                       </td>                   
                      
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['username'];?>

                        </td>
                        <td align="center">
                       		<a onclick="loadingpage();" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/permission.php?act=permissionOne&id=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" title="permission"> 
                                <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/permission.png" alt="permission"  /> 
                            </a> 
                        </td>
                        <td align="center">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/users.php?act=edit&id=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" title="Sửa"> 
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
</div><?php }
}
