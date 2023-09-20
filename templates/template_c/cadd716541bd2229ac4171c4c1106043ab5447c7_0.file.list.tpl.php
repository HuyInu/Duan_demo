<?php
/* Smarty version 4.1.1, created on 2023-09-20 14:59:21
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Import\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650aa6593dd950_03258057',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'cadd716541bd2229ac4171c4c1106043ab5447c7' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Import\\list.tpl',
      1 => 1695196681,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650aa6593dd950_03258057 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="goAction">
	<ul>
    	<li>
            <?php if ($_smarty_tpl->tpl_vars['checkPer3']->value == "true") {?>
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Import.php?act=dellist&cid=<?php echo $_REQUEST['cid'];?>
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
   <form name="f" id="f" method="post" onsubmit="return searchKhoNuTrangTraVe('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Import.php?cid=<?php echo $_REQUEST['cid'];?>
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
            <input type="reset" name="reset" value=" Làm mới " onclick=" return resetsfrsearch();" class="btn-save btn-search"/>
            <?php if ($_smarty_tpl->tpl_vars['checkPer10']->value == "true") {?>
               <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Import.php?act=importexcel&cid=<?php echo $_REQUEST['cid'];?>
" title="Import Excel">
                  <input type="button" name="importexcel" value=" Import Excel " class="btn-save btn-search"/>
               </a>
            <?php }?>
         </div>
      </div>
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
                  <strong>Tổng số món import</strong>
               </td>
               <td style="min-width:130px">
                  <strong>Tổng Trọng lượng</strong>
               </td>
               <td style="min-width:130px">
                  <strong>Tổng TL Hột</strong>
               </td>
               <td style="min-width:100px">
                  <strong>Tổng TL vàng</strong>
               </td>
               <td style="min-width:50px">
                  <strong>Tổng tiền hột</strong>
               </td>
               <td style="min-width:50px">
                  <strong>Tổng tiền công</strong>
               </td>
               <td style="min-width:50px">
                  <strong>Tổng tiền đá/ngọc trai</strong>
               </td>
               <td style="min-width:50px">
                  <strong>Duyệt chuyển đến chờ nhập kho</strong>
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
                  <input type="text" class="InputText textwsearch text-right autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tổng số món import..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="InputText textwsearch text-right autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tổng Trọng lượng..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="InputText textwsearch text-right autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tổng TL Hột..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="InputText textwsearch text-right autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tổng TL vàng..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="InputText textwsearch text-right autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tổng tiền hột..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="InputText textwsearch text-right autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tổng tiền công..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="InputText textwsearch text-right autoNumericInt" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tổng tiền đá/ngọc trai..." autocomplete="off"/>
               </td>
               <td>
               </td>
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
>
<?php echo '<script'; ?>
>
   $(function() {
      $(".textsearchdated").datepicker({changeMonth: true,changeYear: true,dateFormat:"dd/mm/yy"});	
   });

   function resetsfrsearch () {

   }
   function searchKhoNuTrangTraVe (url) {
      var str = null;
      $(location).attr('href', url+str);
		return false;
   }
<?php echo '</script'; ?>
><?php }
}
