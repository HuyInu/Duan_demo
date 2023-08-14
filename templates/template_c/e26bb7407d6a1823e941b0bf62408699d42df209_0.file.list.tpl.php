<?php
/* Smarty version 4.1.1, created on 2023-08-14 13:42:57
  from 'D:\wamp64\www\duan_demo\templates\tpl\categories\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d9ccf1badda9_10537259',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'e26bb7407d6a1823e941b0bf62408699d42df209' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\categories\\list.tpl',
      1 => 1691995358,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64d9ccf1badda9_10537259 (Smarty_Internal_Template $_smarty_tpl) {
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
/sources/categories.php?act=add&cid=<?php echo $_REQUEST['cid'];?>
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
/sources/categories.php?act=dellist&cid=<?php echo $_REQUEST['cid'];?>
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
/sources/categories.php?act=show&cid=<?php echo $_REQUEST['cid'];?>
')" >
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/active.png" />
               	</a> 

                <a href="javascript:void(0)" title="Hide" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/categories.php?act=hide&cid=<?php echo $_REQUEST['cid'];?>
');">
                   	<img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/inactive.png" />
                </a> 
                
                <a href="javascript:void(0)" title="Order" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/categories.php?act=order&cid=<?php echo $_REQUEST['cid'];?>
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
                    <td class="tdcheck">
                        <input type="checkbox" onclick="checkAll();"  name="all"/>                                  
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
                    <?php if ($_REQUEST['cid'] == 79 || $_REQUEST['cid'] == 83) {?>
                        <td width="10%">
                            <strong> TT Giao Nhận </strong>
                        </td>
                    <?php }?>
                    
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
                            <input type="text" name="ordering[]" class="InputOrder"  value="<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['num'];?>
" size="2">
                            <input type="hidden" name="id[]" value="<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" />
                       </td>                   
                       <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['has_child'] == 1) {?>
                       <td>
                           <a href="categories.php?cid=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" border="0">
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                            </a>
                        <?php } else { ?>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                        <?php }?>	
                        </td> 
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['table'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tablect'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tablehachtoan'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['typephongban'];?>

                        </td>
                        <?php if ($_REQUEST['cid'] == 79 || $_REQUEST['cid'] == 83) {?>
                            <td>
                            	<?php if ($_SESSION['group_qlsxntjcorg_user'] == -1) {?>
                                    <select class="chonchuyenphong" onchange="getTTGiaoNhan(<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
, this.value)">
                                <?php } else { ?>
                                	<select class="chonchuyenphong" disabled="disabled">
                                <?php }?>
                                       <?php
$__section_j_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['typegiaonhanload']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_j_1_total = $__section_j_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_j'] = new Smarty_Variable(array());
if ($__section_j_1_total !== 0) {
for ($__section_j_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] = 0; $__section_j_1_iteration <= $__section_j_1_total; $__section_j_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']++){
?>
                                            <option <?php if ($_smarty_tpl->tpl_vars['typegiaonhanload']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] : null)]['id'] == $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['typegiaonhan']) {?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['typegiaonhanload']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] : null)]['id'];?>
">
                                                <?php echo $_smarty_tpl->tpl_vars['typegiaonhanload']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] : null)]['name_vn'];?>

                                            </option>
                                        <?php
}
}
?>	
                                    </select>
                            </td>
                        <?php }?>
                        <td>
                            <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'] == 27) {?>
                                <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['has_child'] == "0") {?>
                                    <?php $_smarty_tpl->assign("comp" , insert_GetNameComponent (array('comp' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['comp']),$_smarty_tpl), true);?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['comp']->value['do'];?>
?cid=0">
                                        <?php echo $_smarty_tpl->tpl_vars['comp']->value['name'];?>
 
                                    </a>
                                <?php }?>
                            <?php } else { ?>
                                <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['has_child'] == "0") {?>
                                    <?php $_smarty_tpl->assign("comp" , insert_GetNameComponent (array('comp' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['comp']),$_smarty_tpl), true);?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['comp']->value['do'];?>
?cid=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
">
                                        <?php echo $_smarty_tpl->tpl_vars['comp']->value['name'];?>

                                    </a>
                                <?php }?>
                            <?php }?>
                        </td>
                        <td align="center">
                           <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphongban'];?>
     
                        </td>
                        <td>
                           <?php echo insert_getNamPhongBanCatalog(array('str' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['phongbancatalog']),$_smarty_tpl);?>     
                        </td>
                        <td align="center">
                           <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nopermission'] == "1") {?>
                                <img width="20" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/active.png" alt="Show\Hide"  />
                             <?php } else { ?> 
                                <img width="20" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/hide.png" alt="Show\Hide"  />
                             <?php }?>
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
/sources/categories.php?act=edit&cid=<?php echo $_REQUEST['cid'];?>
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
</div>
<?php echo '<script'; ?>
>
	function getTTGiaoNhan(id, typegiaonhan){
		var answer = confirm("Bạn chất muốn thực hiện không ?");
		if (answer)
		{
			$('#loadingAjax').show();
			$.post('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/ajax/Checkip.php',{act:'UpdateTTGiaoNhan',id:id,typegiaonhan:typegiaonhan},function(data) {																				
				var obj = jQuery.parseJSON(data);
				$('#loadingAjax').hide();
			});
		}
		else{
			location.reload();	
		}
	}
<?php echo '</script'; ?>
><?php }
}
