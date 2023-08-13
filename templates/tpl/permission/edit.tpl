 <div class="conten_body">
   <div class="conten">
        <div class="divtitle">
            <div class="divleft">
                <div class="divright">   
                <span class="subconten">
                	<a title="Admin" href="<!--{$path_url}-->/users/quan-ly-thanh-vien.html">		
						Phân Quyền User
					</a> 
                </span>  
                <span class="subconten"><img style="margin-top:13px" src="<!--{$path_url}-->/images/icon.gif"></span> 
                <span class="subconten">
                    <a>		
                        <!--{$viewuser.username}-->
                    </a> 
                </span>
                               
                </div>
          </div>
        </div>
        
         
      <div class="tbtitle2 link00" >
        <div class="left"></div> 
          <div class="right"></div>
         <form name="allsubmit" id="allsubmit" action="<!--{$path_url}-->/permission/editsm/" method="post" enctype="multipart/form-data">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                        <table class="br1"  style="border-bottom:0px" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td  height="25" align="left" class="brbottom brleft">
                                    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tên</strong>
                                </td>
                                <td  width="8%" height="25"  align="center" class="brbottom brleft">
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" onclick="checkview();"  name="viewcheck"/> <strong>Xem</strong> 
                                </td>
                                <td  width="8%" height="25"  align="center" class="brbottom brleft">
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <input type="checkbox" onclick="checkadd();"  name="addcheck"/> <strong>Thêm</strong>
                                </td>
                                <td width="8%" height="25" align="center" class="brbottom brleft">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="checkedit();"  name="editcheck"/> <strong>Sửa</strong>
                                </td>                    
                                <td width="8%" height="25" align="center" class="brbottom brleft">
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="checkdel();"  name="delcheck"/><strong>Xóa </strong>
                                </td>
                                <td width="8%" height="25" align="center" class="brbottom brleft">
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <input type="checkbox" onclick="checkchuyen();"  name="chuyencheck"/><strong>Chuyển</strong>
                                </td>
                                <td width="8%" height="25" align="center" class="brbottom brleft">
                                   <strong>Chuyển</strong> <input type="checkbox" onclick="checkchuyenchochiall();"  name="checkchuyenchochi"/><strong>Chờ chi</strong>
                                </td>
                                 <td width="8%" height="25" align="center" class="brbottom brleft">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="checktralaiall();"  name="checktralai"/><strong>Trả lại</strong>
                                </td>
                                <td width="8%" height="25" align="center" class="brbottom brleft">
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <input type="checkbox" onclick="checkprintin();"  name="checkprint"/><strong>Print</strong>
                                </td>
                                <td width="8%" height="25" align="center" class="brbottom brleft">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="checkall();"  name="allcheck"/> <strong>All</strong>
                                </td>
                          </tr>                             
                        <!--{$view}-->
                        <!--{$viewOrther}-->                                    
                      </table>
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        
                    </td>
                  </tr>
                </table>
             
      </div>
      
      <div class="tbtitle2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr> 
                  <td valign="top" width="70%" align="center" colspan="2">
                    <div class="divtitle">
                        <div class="divleft">
                            <div class="divright divseo">
                            	<input type="hidden" name="id" value="<!--{$viewuser.id}-->" />
                                 <input type="submit" value="  Save " />
                            </div>
                      </div>
                    </div>
                   
                  </td>
              </tr>
          </table>
        </div> 
        
      <div class="clear"></div>
    </div>
  </form>  
</div>

<script language="javascript">
function SubMit(){
	document.allsubmit.submit();
}
</script>