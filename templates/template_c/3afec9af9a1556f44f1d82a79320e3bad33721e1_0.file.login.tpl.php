<?php
/* Smarty version 4.1.1, created on 2023-05-09 07:25:35
  from 'D:\wamp64\www\duan_demo\templates\tpl\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_645992ff455eb9_57006457',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3afec9af9a1556f44f1d82a79320e3bad33721e1' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\login.tpl',
      1 => 1682384139,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_645992ff455eb9_57006457 (Smarty_Internal_Template $_smarty_tpl) {
?><html><head>
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
    width: 600px;
	min-height:60px;
}
td.login {
	font-family: "Times New Roman", Times, serif;
	font-size: 14px;
}


input.text {
	font-family: arial, tahoma, verdana, serif;
	font-size: 12px; 
	
}
</style>


<title>Administrator</title>
</head>
<body>
<table style="width: 100%; height: 100%;" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
           <form name="login" method="post" action="index.php?do=login&act=sm">
            <div class="box">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="login">
                        	USERNAME: &nbsp;
                        </td>
                        <td class="login">
                        	<input class="text" name="username" id="username" maxlength="50" type="text"> &nbsp;
                        </td>
                        <td class="login">
                        	PASSWORD: &nbsp;
                        </td>
                        <td class="login" colspan="2">
                        	<input class="text" name="password" id="password" maxlength="50" type="password"> &nbsp;
                        </td>
                        
                       
                    </tr>
                   <tr> <td class="login">&nbsp;</td></tr>
                     <tr>
                        <td class="login">
                        	SECURITY: &nbsp;
                        </td>
                        <td class="login">
                        	<input class="text" name="security_code" id="security_code" maxlength="50" type="text"> &nbsp;
                            
                        </td>
                       
                       <td class="img">
                            <img class="Img" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/php-captcha/captcha_new.php" />
                            <a href=''><img width="25" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/rest.png" /></a>
                        </td>
                        <td class="login">
                        
                        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input value="Login" type="submit"  >
                        </td>
                    </tr>
                    
                    
                </table>
               
			</div>
            </form>
        </td>
    </tr>
</table>
<?php }
}
