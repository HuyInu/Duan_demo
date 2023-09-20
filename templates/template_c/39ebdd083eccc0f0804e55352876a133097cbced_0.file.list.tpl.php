<?php
/* Smarty version 4.1.1, created on 2023-09-20 13:01:10
  from 'D:\wamp64\www\duan_demo\templates\tpl\loaivang\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650a8aa6525467_79726863',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '39ebdd083eccc0f0804e55352876a133097cbced' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\loaivang\\list.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650a8aa6525467_79726863 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="breadcrumb">
    <ul>
        <li>
        	<a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <?php echo insert_HearderCatMenu(array('cid' => $_REQUEST['cid'], 'root' => $_REQUEST['root'], 'act' => $_REQUEST['act']),$_smarty_tpl);?>
    </ul>
</div>
<div class="goAction">
	<ul>
    	<li>
            <?php if ($_smarty_tpl->tpl_vars['checkPer1']->value == "true") {?>
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/loaivang.php?act=add&cid=<?php echo $_REQUEST['cid'];?>
');">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/add.png">
                </a> 
            <?php } else { ?>  
                <a>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/add-no.png">
                </a> 	
            <?php }?> 
            
            <?php if ($_smarty_tpl->tpl_vars['checkPer3']->value == "true") {?>
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/loaivang.php?act=dellist&cid=<?php echo $_REQUEST['cid'];?>
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
            
            <?php if ($_smarty_tpl->tpl_vars['checkPer2']->value == "true") {?> 
               	<a href="javascript:void(0)" title="Show" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/loaivang.php?act=show&cid=<?php echo $_REQUEST['cid'];?>
')" >
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/active.png" />
               	</a> 

                <a href="javascript:void(0)" title="Hide" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/loaivang.php?act=hide&cid=<?php echo $_REQUEST['cid'];?>
');">
                   	<img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/inactive.png" />
                </a> 
                
                <a href="javascript:void(0)" title="Order" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/loaivang.php?act=order&cid=<?php echo $_REQUEST['cid'];?>
');">
                	<img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/order.png" />
                </a>  
          	<?php } else { ?>  
                <a>
                   <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/active-no.png" />
                </a> 
                <a>
                   <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/inactive-no.png" />
                </a> 
                <a>
                	<img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/order-no.png" /> 
                </a> 
            <?php }?>             
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
                    
                    <td class="tdOrder">
                        <strong>THỨ TỰ</strong>
                    </td>
                    <td>
                        <strong>Mã vàng (Phần Mềm A.Tuấn)</strong>
                    </td>
                    <td>
                        <strong>Loại vàng</strong>
                    </td>
                    
                    <td>
                        <strong>Tuổi quy định</strong>
                    </td>
                    
                    
                    
                    <td class="tdShowHide" align="center">
                        <strong>HIỆN/ẨN</strong>
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
                    <tr>
                       <td>
                            <input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" name="iddel[]" id="check<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>
">
                       </td>
                       <td>
                            <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1+$_smarty_tpl->tpl_vars['number']->value;?>

                       </td>
                       <td>
                            <input type="text" name="ordering[]" class="InputOrder"  value="<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['num'];?>
" size="2">
                            <input type="hidden" name="id[]" value="<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" />
                       </td>                   
                      <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['mavang'];?>
	
                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>
	
                        </td> 
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tuoiquydinh'];?>
	
                        </td> 
                        
                        <td align="center">
                           <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['active'] == "1") {?>
                                <img width="20" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/active.png" alt="Show\Hide"  />
                             <?php } else { ?> 
                                <img width="20" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/hide.png" alt="Show\Hide"  />
                             <?php }?>
                        </td>
                        <td align="center">
                        	<?php if ($_smarty_tpl->tpl_vars['checkPer2']->value == "true") {?>
                        		<a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/loaivang.php?act=edit&cid=<?php echo $_REQUEST['cid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" title="Sửa"> 
                              		<img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/edit.png"/> 
                                </a>
                           	<?php } else { ?>
                                 <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/edit-no.png"/> 
                           	<?php }?>             
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
