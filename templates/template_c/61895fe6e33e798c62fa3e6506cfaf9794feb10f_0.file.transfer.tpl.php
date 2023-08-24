<?php
/* Smarty version 4.1.1, created on 2023-08-24 07:35:35
  from 'D:\wamp64\www\duan_demo\templates\tpl\transfer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e6a5d7753628_11081283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '61895fe6e33e798c62fa3e6506cfaf9794feb10f' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\transfer.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e6a5d7753628_11081283 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="NOINDEX, NOFOLLOW" />
<style type="text/css">
html, body {
	height: 100% !important;
}
body {
	text-align: center;
	background-color: #EEEEEE;
	background-image: url(images/admin_login.gif);
	background-repeat: no-repeat;
	background-position: center center;
}
div.box {
	border: 1px dashed #AAAAAA;
	padding: 15px 2px;
	background: #FFFFFF;
	font-family: "Times New Roman", Times, serif;
	font-size: 14px;
    width: 550px;
	min-height:60px;
}
.Text{
	font-family: "Times New Roman", Times, serif;
	font-size: 18px;
}
</style>
<title>Adminitrator</title>
<meta http-equiv="REFRESH" content="2; url=<?php echo $_smarty_tpl->tpl_vars['pagelink']->value;?>
">
</head>
<body>
<table style="width: 100%; height: 100%;" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
           
            <div class="box">
                <p class="Text"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</p>
				
			</div>
            
        </td>
    </tr>
</table>
<?php }
}
