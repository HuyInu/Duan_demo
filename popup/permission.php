<style type="text/css">
	.box-thongin-popup {
		width: 780px;
		margin: 15px 40px 50px 0;
		min-height: 190px;
	}
	.box-thongin {
		border: 1px solid #5794bf;
		border-radius: 5px;
		padding: 10px 0 10px 0;
	}
	.title-thongtin {
		margin:-21px 0 0 20px;
		background: #fff;
		display: inline-block;
		vertical-align: top;
		padding: 0 5px;
		font-size: 16px;
	}
	.brbottom{
		font-size:13px;
	}
	.chonxong {
		font-size: 14px;
	}
	.addRowGirlMain {
		text-align: center;
		width: 100%;
		margin: 50px 0 15px;
	}
	.addRowGirl {
		padding: 5px 8px;
		background: #005EBB;
		color: #FFF;
		border-radius: 5px;
	}
</style>
<?php

	include("../#include/config.php");
	include("../functions/function.php");
	$cid = ceil($_REQUEST['cid']);
	$uid = ceil($_REQUEST['uid']);
	
	$sql_pms = "select * from $GLOBALS[db_sp].permissions where uid=$uid and cid= $cid ";
	$rs_pms = $GLOBALS["sp"]->getRow($sql_pms);
	
	$listmenu = '';
	if(in_array("5",explode(',',$rs_pms['perm'])))
		$listmenu .= '<td align="center"><input name="pmsion" value="5" type="checkbox" checked="checked" /></td>';
	else
		$listmenu .= '<td align="center"><input name="pmsion" value="5" type="checkbox"/></td>';
		
	if(in_array("1",explode(',',$rs_pms['perm'])))
		$listmenu .= '<td align="center"><input name="pmsion" value="1" type="checkbox" checked="checked" /></td>';
	else
		$listmenu .= '<td align="center"><input name="pmsion" value="1" type="checkbox"/></td>';
		
	if(in_array("2",explode(',',$rs_pms['perm'])))
		$listmenu .= '<td align="center"><input name="pmsion" value="2" type="checkbox" checked="checked" /></td>';
	else
		$listmenu .= '<td align="center"><input name="pmsion" value="2" type="checkbox"/></td>';
	
	if(in_array("3",explode(',',$rs_pms['perm'])))
		$listmenu .= '<td align="center"><input name="pmsion" value="3" type="checkbox" checked="checked" /></td>';
	else
		$listmenu .= '<td align="center"><input name="pmsion" value="3" type="checkbox"/></td>';
	
	if(in_array("6",explode(',',$rs_pms['perm']))) /// chuyển
		$listmenu .= '<td align="center"><input name="pmsion" value="6" type="checkbox" checked="checked" /></td>';
	else
		$listmenu .= '<td align="center"><input name="pmsion" value="6" type="checkbox"/></td>';
		
	if(in_array("8",explode(',',$rs_pms['perm']))) // Duyệt
		$listmenu .= '<td align="center"><input name="pmsion" value="8" type="checkbox" checked="checked" /></td>';
	else
		$listmenu .= '<td align="center"><input name="pmsion" value="8" type="checkbox"/></td>';
		
	if(in_array("9",explode(',',$rs_pms['perm']))) //chuyển Trả lại
		$listmenu .= '<td align="center"><input name="pmsion" value="9" type="checkbox" checked="checked" /></td>';
	else
		$listmenu .= '<td align="center"><input name="pmsion" value="9" type="checkbox"/></td>';
	
	if(in_array("7",explode(',',$rs_pms['perm']))) // Print
		$listmenu .= '<td align="center"><input name="pmsion" value="7" type="checkbox" checked="checked" /></td>';
	else
		$listmenu .= '<td align="center"><input name="pmsion" value="7" type="checkbox"/></td>';
		
	if(in_array("10",explode(',',$rs_pms['perm']))) // Print
		$listmenu .= '<td align="center"><input name="pmsion" value="10" type="checkbox" checked="checked" /></td>';
	else
		$listmenu .= '<td align="center"><input name="pmsion" value="10" type="checkbox"/></td>';	
		
	if(in_array("4",explode(',',$rs_pms['perm'])))
		$listmenu .= '<td align="center"><input name="pmsion" value="4" type="checkbox" checked="checked" /></td>';
	else
		$listmenu .= '<td align="center"><input name="pmsion" value="4" type="checkbox"/></td>';			
?>
<div class="box-thongin box-thongin-popup main-permission">
    <div class="title-thongtin">Set quyền mục <?php echo getName('categories', 'name_vn', $cid); ?></div>
    <div class="MainTable">
    	<table  class="table-bordered">
            <tr class="trheader">
                <td align="center">
                  <strong>Xem</strong> 
                </td>
                <td align="center">
                   <strong>Thêm</strong>  
                </td>
                <td align="center">
                    <strong>Sửa</strong>
                </td>                    
                <td align="center">
                   <strong>Xóa</strong>
                </td> 
                 <td align="center">
                  <strong>Chuyển</strong> 
                </td>
                <td align="center">
                   <strong>Duyệt</strong>
                </td>
                <td align="center">
                    <strong>Trả lại</strong>
                </td> 
                                  
                <td align="center">
                    <strong>Print & Export</strong>
                </td>
                 <td align="center">
                    <strong>Import</strong>
                </td> 
                
                <td align="center">
                   <strong>All</strong>
                </td>
            </tr>
            <tr>
				<?php echo $listmenu; ?>
			</tr>   
       </table>
    </div>
     <div class="clear"></div>
    <div class="addRowGirlMain chonxong">
        <a href="javascript:void(0)" onclick="return savePmsion(<?php echo $cid;?>, <?php echo $uid;?>)" class="addRowGirl"> <strong> Save </strong> </a>
    </div>
</div>
<script>
	function savePmsion(cid, uid){
		var checkepmsion = [];
		$("input[name='pmsion']:checked").each(function ()
		{
			checkepmsion.push(parseInt($(this).val()));
		});	
		
		$('#loadajax').show();
		$.post('<?php echo $path_url; ?>/ajax/member.php',{
			uid:uid,
			cid:cid,
			perm:checkepmsion,
			act:'permision'
		},function(data){
		  var obj = jQuery.parseJSON(data);
		  if(obj.status != ''){
			  alert(obj.status);
			  $('#loadajax').hide();
		  }
		  else{
			  $('#showpms'+cid).html(obj.listmenu);
			  $.fancybox.close();
			  $('#loadajax').hide();
		  }
		});	

	}
</script>