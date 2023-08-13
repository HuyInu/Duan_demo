<!DOCTYPE html>
<html lang="vi">
<head>
<!--{include 'header.tpl'}-->
<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/css/giahuy/style.css">
</head>
<body>
    <div class='header'>
    </div>
    <div class='goAction'>
        <ul>
            <li>
                <!--{if $checkPer1 eq true}-->
                    <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<!--{$path_url}-->/sources/thuchanh.php?act=add&cid=<!--{$smarty.request.cid}-->');">
                        <img src="<!--{$path_url}-->/images/add.png">
                    </a> 
                <!--{else}-->  
                        <a>
                        <img src="<!--{$path_url}-->/images/add-no.png">
                    </a> 	
                <!--{/if}--> 
                
                <!--{if $checkPer3 eq "true" }-->
                    <a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/thuchanh.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
                        <img src="<!--{$path_url}-->/images/delete.png">
                    </a> 
                <!--{else}-->   
                    <a>
                        <img src="<!--{$path_url}-->/images/delete-no.png">
                    </a> 
                <!--{/if}--> 
            </li>
        </ul>
    </div>
    <div class='content'>
        <div class='MainTable'>
            <form name="f" id="f" method="post">
                <div class='table'>
                    <table style='width:100%'>
                        <tr class='tbheader'>
                            <td width='25px' class='tdcheck'><input type='checkbox' onclick="checkAll();" name='all'></th>
                            <th width='50px'>STT</th>
                            <th width='74px'>Thứ tự</th>
                            <th>Tên</th>
                            <th>Table</th>
                            <th>Table chi tiết</th>
                            <th>Table hạch toán</th>
                            <th>Type phòng ban</th>
                            <th>Component</th>
                            <th>Mã phòng ban</th>
                            <th>Phòng ban catalog</th>
                            <th>No permission</th>
                            <th>Hiện ẩn</th>
                            <th>Sửa</th>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</body>
<footer>
<!--{include 'footer.tpl'}-->
</footer>
</html>