<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/css/huytulam/sweet-alert.css">
<div class='sweet_alert <!--{($actResult['result'] eq '1') ? 'success' : 'error'}-->'>
    <img class='icon' src="<!--{$path_url}-->/images/<!--{($actResult['result'] eq '1') ? 'active' : 'delete'}-->.png" />
    <!--{$actResult['msg']}-->
</div>
