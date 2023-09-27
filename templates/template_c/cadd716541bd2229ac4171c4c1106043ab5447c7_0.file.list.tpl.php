<?php
/* Smarty version 4.1.1, created on 2023-09-27 16:24:15
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Import\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6513f4bfa579d8_72217960',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'cadd716541bd2229ac4171c4c1106043ab5447c7' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Import\\list.tpl',
      1 => 1695806645,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6513f4bfa579d8_72217960 (Smarty_Internal_Template $_smarty_tpl) {
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
            <input type="text" class="SearchCtrl InputText textsearchdated" placeholder='dd/mm/yy' name="fromdays" id="fromdays" value="<?php echo $_smarty_tpl->tpl_vars['fromdays']->value;?>
" onchange="DateCheck()" autocomplete="off"/>
         </div>
         <div class="formsearch">
            <label class="Fl labelsearch"> Đến ngày: </label>
            <input type="text" class="SearchCtrl InputText textsearchdated" placeholder='dd/mm/yy' name="todays" id="todays" value="<?php echo $_smarty_tpl->tpl_vars['todays']->value;?>
" onchange="DateCheck()" autocomplete="off"/>
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
               <td style="min-width:65px">
                  <strong>Tổng số món import</strong>
               </td>
               <td style="min-width:95px">
                  <strong>Tổng Trọng lượng</strong>
               </td>
               <td style="min-width:95px">
                  <strong>Tổng TL Hột</strong>
               </td>
               <td style="min-width:95px">
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
                  <input type="text" class="SearchCtrl InputText textwsearch" name="maphieus" id="maphieus" value="<?php echo $_smarty_tpl->tpl_vars['searchKeyword']->value['maphieus'];?>
" placeholder="Mã phiếu import..."  autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch" name="midNames" id="midNames" value="<?php echo $_smarty_tpl->tpl_vars['searchKeyword']->value['midNames'];?>
" placeholder="NV import..." autocomplete="off" style="width:100% !important" />
               </td>
               <td>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Giờ import..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="slmons" id="slmons" value="<?php echo $_smarty_tpl->tpl_vars['searchKeyword']->value['slmons'];?>
" placeholder="Tổng số món import..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch  autoNumericInt" name="cannangvhs" id="cannangvhs" value="<?php echo $_smarty_tpl->tpl_vars['searchKeyword']->value['cannangvhs'];?>
" placeholder="Tổng Trọng lượng..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannanghs" id="cannanghs" value="<?php echo $_smarty_tpl->tpl_vars['searchKeyword']->value['cannanghs'];?>
" placeholder="Tổng TL Hột..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannangvs" id="cannangvs" value="<?php echo $_smarty_tpl->tpl_vars['searchKeyword']->value['cannangvs'];?>
" placeholder="Tổng TL vàng..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tongtienhots" id="tongtienhots" value="<?php echo $_smarty_tpl->tpl_vars['searchKeyword']->value['tongtienhots'];?>
" placeholder="Tổng tiền hột..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tongtiencongs" id="tongtiencongs" value="<?php echo $_smarty_tpl->tpl_vars['searchKeyword']->value['tongtiencongs'];?>
" placeholder="Tổng tiền công..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tongtiendangoctrais" id="tongtiendangoctrais" value="<?php echo $_smarty_tpl->tpl_vars['searchKeyword']->value['tongtiendangoctrais'];?>
" placeholder="Tổng tiền đá/ngọc trai..." autocomplete="off"/>
               </td>
               <td>
               </td>
            </tr>
            <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['view']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
            <tr ondblclick="popupwindow('Kho-Nu-Trang-Tra-Ve-Import.php?act=view&cid=<?php echo $_REQUEST['cid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
','mywindow')" id="g<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
">
               <td>
                  <input type="checkbox" id="check<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>
" name="iddel[]" value="<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
"/>
               </td>
               <td>
                  <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>

               </td>
               <td>
                  <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieu'];?>

               </td>
               <td>
                  <?php ob_start();
echo $_SESSION['admin_qlsxntjcorg_id'];
$_prefixVariable1 = ob_get_clean();
echo getName('admin','fullname',$_prefixVariable1);?>

               </td>
               <td>
                  <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dated'];?>

               </td>
               <td>
                  <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['time'];?>

               </td>
               <td>
                  <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['slmon'];?>

               </td>
               <td>
                  <?php echo number_format((float)$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'],3);?>

               </td>
               <td>
                  <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3);?>

               </td>
               <td>
                  <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'],3);?>

               </td>
               <td>
                  <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tongtienhot']);?>

               </td>
               <td>
                  <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tongtiencong']);?>

               </td>
               <td>
                  <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tongtiendangoctrai']);?>

               </td>
               <td>
                  <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['typeimport'] == 0) {?>
                     <?php if ($_smarty_tpl->tpl_vars['checkPer8']->value == "true") {?>
                        <a href="javascript:void(0)" onclick="giahuy_chuyenKhoNguonVaogo('duyetchuyenimport', <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
,'1866',<?php echo $_smarty_tpl->tpl_vars['phongbanchuyen']->value;?>
, '') ">
                           Duyệt chuyển
                        </a>
                     <?php }?>
                  <?php }?>
               </td>
            </tr>
            <?php
}
}
?>
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
<?php echo '</script'; ?>
><?php }
}
