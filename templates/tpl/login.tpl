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
                            <img class="Img" src="<!--{$path_url}-->/php-captcha/captcha_new.php" />
                            <a href=''><img width="25" src="<!--{$path_url}-->/images/rest.png" /></a>
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
