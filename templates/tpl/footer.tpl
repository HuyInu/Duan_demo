<span id="loadingAjax">
    <div class="ajax-loader"></div>
    <div class="loadajax"></div>
</span>
<input type="hidden" name="path_url"  id="path_url" value="<!--{$path_url}-->" />
<button class="btn-resize btn-save" onclick="parent.toggleFrame(this)">Phóng to</button>
<script>
	function searchMaPhierChinhSuaSoLieu(maphieu){
		$('#maphieus').val(maphieu);
		$( "#fMaPhierChinhSuaSoLieu" ).submit(); //document.f.submit();
	}
</script>
<script>
   $(document).ready(function() {		
	$(".table2scroll").each(function(){
	    $(this).each(function () {
            $(this).find('input').on('keyup', function(e) {
                switch (e.which) {
                    case 39:
                        $(this).closest('td').next().find('input').focus(); break;
                    case 37:
                        $(this).closest('td').prev().find('input').focus(); break;
                    case 40:
                        $(this).closest('tr').next().children().eq($(this).closest('td').index()).find('input').focus(); break;
                    case 38:
                        $(this).closest('tr').prev().children().eq($(this).closest('td').index()).find('input').focus(); break;
                }
            });
        });
	});	
});
  

function searchMaDonHangCatalog(id, code) {
	$('#namemadonhang').val(code);
	$('#madhin').val(id);
	return false;	
}                                  
function getSLVaoCotGhiChu(id){
	//// áp dụng chọn đơn hàng sản xuất bên catalog get tổng số lượng đơn hàng đưa vào cột ghi chú
	if(id > 0){
		$('#loadingAjax').show();
		$.post('<!--{$path_url}-->/ajax/Checkip.php',{act:'getSLDonHangCatalog',id:id},function(data) {																				
			 var obj = jQuery.parseJSON(data);
			 if(obj.status == 'success'){
				$('#loadingAjax').hide();
				$("#ghichuvang").val("Số lượng đơn hàng: "+obj.name);
			 }
		});
		
	}
	else{
		$("#ghichuvang").val('');	
	}
}

function exportExcelKhoKhac(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val(); 
	if(fromdays == ''){
		alert('Vui lòng chọn từ ngày');
		return false;
	}
	else if(todays == ''){
		alert('Vui lòng chọn đến ngày');	
		return false;
	}
	else{
		popupwindow(url, 'ExportExcel')
		return false;	
	}
}
</script>

<script>
	function check_file_import()
	{
		var file=document.allsubmit.file;
		var str = file.value;
		var type=",xlsx";
		var ext=str.match(/[\w]*$/);
		if(type.search(ext)==-1)
		{
			file.value='';
			alert('Không đúng định dạng (Chỉ sử Dụng Được File Excel.xlsx)');
			file.focus();
			return false;
		}
		return true;
	}
	
	$(document).ready(function(){
		<!--{if $smarty.cookies.typeVangKimCuong eq 'kimcuong'}-->					   
			clickKimCuong('noajax');
		<!--{else}-->
			clickVang('noajax');
		<!--{/if}-->							   
	});		
	function clickVang(a){
		$("#clickKimCuong").removeClass("active");						   
		$("#clickVang").addClass("active");
		$(".vang").show();	
		$(".kimcuong").hide();
		if(a !='noajax' ){
			createCookie('typeVangKimCuong','vang',1);
			if(a !='' )
				$(location).attr('href',a);
			reload_js('<!--{$path_url}-->/js/colResizable-1.6.js');	
		}
		
	}
	function clickKimCuong(a){
		$("#clickVang").removeClass("active");						   
		$("#clickKimCuong").addClass("active");	
		$(".kimcuong").show();	
		$(".vang").hide();
		if(a!='noajax'){
			createCookie('typeVangKimCuong','kimcuong',1);
			if(a !='' )
				$(location).attr('href',a);	
				
			reload_js('<!--{$path_url}-->/js/colResizable-1.6.js');
		}
		
	}
	 function reload_js(src) {
        $('script[src="' + src + '"]').remove();
        $('<script>').attr('src', src).appendTo('head');
		$(function(){
			$("table").colResizable({liveDrag:true});
			$("table.disabledColumns").colResizable({liveDrag:true, disable: true});
		});
    }
</script>

<script>
function loadingpage(){
	$('#loadingAjax').show();
}
function updateGiaoTho(id,matho,table){
	if(id > 0){
		var answer = confirm("Bạn chất muốn thực hiện không ?");
		if (answer)
		{
			$('#loadingAjax').show();
			$.post('<!--{$path_url}-->/ajax/Checkip.php',{act:'UpdateGiaoTho',id:id,matho:matho,table:table},function(data) {																				
				 var obj = jQuery.parseJSON(data);
				 if(obj.status == 'success'){
					$('#loadingAjax').hide();
					location.reload();
				 }
			});
		}
		else{
			location.reload();	
		}
	}
}

function kimCuongTrangThaiGhiChu(id){//id là phòng chuyển đến
	if(id > 0){
		$('#loadingAjax').show();
		var trangthaighichu = $('#trangthaighichu'+id).val();
		$.post('<!--{$path_url}-->/ajax/Checkip.php',{act:'updateKimCuongTrangThaiGhiChu',id:id,trangthaighichu:trangthaighichu},function(data) {																				
			 var obj = jQuery.parseJSON(data);
			 if(obj.status == 'success'){
				$('#loadingAjax').hide();
			 }
		});	
	}
}

function updatedong(act, str, id, cot,table){//id là phòng chuyển đến
	$('#loadingAjax').show();
	var checkhao = $('#showhao'+id).val();
	var checkdu = $('#showdu'+id).val();
	if(checkhao > 0 && checkdu > 0){
		$('#loadingAjax').hide();
		alert('Vui lòng chỉ nhập duy nhất 1 cột, Hao hoặc Dư.');
		if(cot == 'hao')
			$('#showhao'+id).val('0.000');
		else
			$('#showdu'+id).val('0.000');
		return false;
	}
	else{
		$.post('<!--{$path_url}-->/ajax/Checkip.php',{act:act,id:id,str:str,cot:cot,table:table},function(data) {																				
			 var obj = jQuery.parseJSON(data);
			 if(obj.status == 'success'){
				$('#loadingAjax').hide();
			 }
		});	
	}
}

function chuyenKhoNguonVaogo(act, id, phongban, phongbanchuyen, maphieu){//id là phòng chuyển đến
	if(phongban > 0){
		var answer = confirm("Bạn chất muốn chuyển không ?");
		if (answer)
		{
			$('#loadingAjax').show();
			$.post('<!--{$path_url}-->/ajax/chuyenphong_khonguonvao.php',{act:act,id:id,phongban:phongban,phongbanchuyen:phongbanchuyen,maphieu:maphieu},function(data) {																				
				var obj = jQuery.parseJSON(data);
				 if(obj.status == 'success'){
					$('#loadingAjax').hide();
					$('#g'+id).hide(); 
				 }
				 else{
					$('#loadingAjax').hide();
					$('#chuyenKhoNguonVao'+id).val('');	
					alert(obj.status);	 
				 }
			});
		}
		else{
			$('#chuyenKhoNguonVao'+id).val('');	
		}
	}
}

function chuyenKhoKhacTest(act, cid, id, phongbanchuyen, typeKho){
	if(id>0){
		var msg = confirm("Bạn muốn chuyển không?");
		if(msg){
			$('#loadingAjax').show();
			var path = '<!--{$path_url}-->/ajax/chuyenkhotest.php';
			var newObj = {act:act, cid:cid, id:id, phongbanchuyen:phongbanchuyen, typeKho:typeKho};
			$.post(path,newObj,(data)=>{
				var obj = $.parseJSON(data);
				 if(obj.status == 'success'){
					$('#loadingAjax').hide();
					$('#g'+id).hide(); 
				 }
				 else{
					$('#loadingAjax').hide();
					$('#chuyenkho'+id).val('');	
					alert(obj.status);	 
				 }
			});
		}else $('#chuyenkho'+id).val('');	
	}
}

function chuyenKhoKhac(act, cid, id, phongbanchuyen, typeKho){//id là phòng chuyển đến
	if(id > 0){
		var answer = confirm("Bạn chất muốn chuyển không ?");
		if (answer)
		{
			$('#loadingAjax').show();
			/*
			if(cid == 235){
				act = 'chuyenkhoSauchetacGiamDoc';	
			}
			*/
			$.post('<!--{$path_url}-->/ajax/chuyenkho.php',{act:act,cid:cid,id:id,phongbanchuyen:phongbanchuyen,typeKho:typeKho},function(data) {																				
				 var obj = jQuery.parseJSON(data);
				 if(obj.status == 'success'){
					$('#loadingAjax').hide();
					$('#g'+id).hide(); 
				 }
				 else{
					$('#loadingAjax').hide();
					$('#chuyenkho'+id).val('');	
					alert(obj.status);	 
				 }
			});
		}
		else{
			$('#chuyenkho'+id).val('');	
		}
	}
}

function chuyenKhoSanXuat(act, cid, id, phongbanchuyen, typeKho){//id là phòng chuyển đến
	if(id > 0){
		var answer = confirm("Bạn chất muốn chuyển không ?");
		if (answer)
		{
			$('#loadingAjax').show();
			$.post('<!--{$path_url}-->/ajax/chuyenkho.php',{act:act,cid:cid,id:id,phongbanchuyen:phongbanchuyen,typeKho:typeKho},function(data) {																				
				 var obj = jQuery.parseJSON(data);
				 if(obj.status == 'success'){
					$('#loadingAjax').hide();
					$('#g'+id).hide(); 
				 }
				 else{
					$('#loadingAjax').hide();
					$('#chuyenkho'+id).val('');	
					alert(obj.status);	 
				 }
			});
		}
		else{
			$('#chuyenkho'+id).val('');	
		}
	}
}

function chuyenKhoDa(act, cid, id, phongbanchuyen){//id là phòng chuyển đến
	if(id > 0){
		var answer = confirm("Bạn chất muốn chuyển không ?");
		if (answer){
			$('#loadingAjax').show();
			$.post('<!--{$path_url}-->/ajax/chuyenkho.php',{act:act,cid:cid,id:id,phongbanchuyen:phongbanchuyen},function(data) {																				
				 var obj = jQuery.parseJSON(data);
				 if(obj.status == 'success'){
					$('#loadingAjax').hide();
					location.reload();
				 }
				 else{
					$('#loadingAjax').hide();
					$('#chuyenkho'+id).val('');
					alert(obj.status);
				 }
			});
		}
		else{
			$('#chuyenkho'+id).val('');	
		}
	}
}

function xacnhanchuyenKhoSanXuatTest(act,cid,id,type){
	if(id>0){
		var msg = confirm("Bạn muốn thực hiện không?");
		if(msg){
			$('#loadingAjax').show();
			var path = '<!--{$path_url}-->/ajax/chuyenkhotest.php';
			var obj = {act:act,cid:cid,id:id,type:type};
			$.post(path,obj,(data)=>{

// console.log(data);

				var obj = jQuery.parseJSON(data);
				 if(obj.status == 'success'){
					$('#loadingAjax').hide();
					$('#g'+id).hide(); 
				 }
				 else{
					$('#loadingAjax').hide();
					alert(obj.status);	 
				 }
			});
		}
	}
}

function xacnhanchuyenKhoSanXuat(act, cid, id, type){//id là phòng chuyển đến
	if(id > 0){
		var answer = confirm("Bạn chất muốn thực hiện không ?");
		if (answer)
		{
			$('#loadingAjax').show();
			$.post('<!--{$path_url}-->/ajax/chuyenkho.php',{act:act,cid:cid,id:id,type:type},function(data) {																				
				 var obj = jQuery.parseJSON(data);
				 if(obj.status == 'success'){
					$('#loadingAjax').hide();
					$('#g'+id).hide(); 
				 }
				 else{
					$('#loadingAjax').hide();
					alert(obj.status);	 
				 }
			});
		}
	}
}
function xacnhanchuyen(act, cid, id){//id là phòng chuyển đến
	if(id > 0){
		var answer = confirm("Bạn chắc muốn thực hiện không ?");
		if (answer){
			$('#loadingAjax').show();
			$.post('<!--{$path_url}-->/ajax/chuyenkho.php',{act:act,cid:cid,id:id},function(data) {																				
				 var obj = jQuery.parseJSON(data);
				 if(obj.status == 'success'){
					$('#loadingAjax').hide();
					$('#g'+id).hide(); 
				 }
				 else{
					$('#loadingAjax').hide();
					$('#chuyenkho'+id).val('');
					alert(obj.status);	 
				 }
			});
		}
		else{
			$('#chuyenkho'+id).val('');
		}
	}
}


function formatNumber(num) {
	//return num.toLocaleString();
	return num.toFixed(3).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
}
function popupwindow(url, title) {
	w=1400;
	h=800;
    var left = Math.round((screen.width/2)-(w/2));
    var top = Math.round((screen.height/2)-(h/2));
	
    newwindow = window.open(url, title, 'toolbar=no, location=no, directories=no, status=no,scrollbars=1, '
            + 'menubar=no, toolbar=no,status=no,menu=no, directories=no,titlebar=no,location=no,addressbar=no copyhistory=no, width=' + w 
            + ', height=' + h + ', top=' + top + ', left=' + left);
	self.close();
	if (window.focus) { newwindow.focus() }
        return false;
}
function printKhoNguonVao(){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var idloaivang = $('#idloaivang').val();
	var url = $('#getUrlPrintKhoNguonVao').val(); 
	if(fromdays == ''){
		alert('Vui lòng chọn từ ngày');
		return false;
	}
	else if(todays == ''){
		alert('Vui lòng chọn đến ngày');	
		return false;
	}
	else{
		url = '<!--{$path_url}-->/print/print-thong-ke-kho-nguon-vao.php?'+url+'&fromdays='+fromdays+'&todays='+todays+'&idloaivang='+idloaivang;
		popupwindow(url, 'In')
		return false;	
	}
}

function printKhoNguonVaoNoDated(){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var idloaivang = $('#idloaivang').val();
	var url = $('#getUrlPrintKhoNguonVao').val(); 
	
	url = '<!--{$path_url}-->/print/print-thong-ke-kho-nguon-vao.php?'+url+'&fromdays='+fromdays+'&todays='+todays+'&idloaivang='+idloaivang;
	popupwindow(url, 'In')
	return false;	
}

function printKhoKhac(){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var url = $('#getUrlPrintKhoNguonVao').val(); 
	var idloaivang = $('#idloaivang').val();
	/*
	if(fromdays == ''){
		alert('Vui lòng chọn từ ngày');
		return false;
	}
	else if(todays == ''){
		alert('Vui lòng chọn đến ngày');	
		return false;
	}
	else{
		*/
		url = '<!--{$path_url}-->/print/print-kho-khac.php?'+url+'&idloaivang='+idloaivang+'&fromdays='+fromdays+'&todays='+todays;
		popupwindow(url, 'In')
		return false;	
	//}
}
function printKhoSanxuat(){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var todays = $('#todays').val();
	var idloaivang = $('#idloaivang').val();
	
	var url = $('#getUrlPrintKhoNguonVao').val(); 
	/*
	if(fromdays == ''){
		alert('Vui lòng chọn từ ngày');
		return false;
	}
	else if(todays == ''){
		alert('Vui lòng chọn đến ngày');	
		return false;
	}
	else{
		*/
		url = '<!--{$path_url}-->/print/print-thong-ke-kho-san-xuat.php?'+url+'&fromdays='+fromdays+'&todays='+todays+'&idloaivang='+idloaivang;
		popupwindow(url, 'In')
		return false;	
	//}
}
// Anh Vũ thêm
function searchMaPhieuDieuChinhSoLieu(maphieu){
	$('#maphieus').val(maphieu);
	$("#fdcsl").submit(); //document.f.submit();
}
function printKhoTemDa(){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	
	if(fromdays == ''){
		alert('Vui lòng chọn từ ngày');
		return false;
	}
	else if(todays == ''){
		alert('Vui lòng chọn đến ngày');	
		return false;
	}
	else{
		var url = $('#getUrlPrint').val();
		url = '<!--{$path_url}-->/print/print-kho-da.php?'+url+'&fromdays='+fromdays+'&todays='+todays;
		popupwindow(url, 'In');
		return false;
	}
}

function callExportExcelKhoTemDa(){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	
	if(fromdays == ''){
		alert('Vui lòng chọn từ ngày');
		return false;
	}
	else if(todays == ''){
		alert('Vui lòng chọn đến ngày');	
		return false;
	}
	else{
		var url = $('#getUrlExportExcel').val();
		url = '<!--{$path_url}-->/print/xuat-file-excel-kho-da.php?'+url+'&fromdays='+fromdays+'&todays='+todays;
		popupwindow(url, 'ExportExcel');
		return false;
	}
}
// Anh Vũ thêm
function exportExcelKhoSanXuat(){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val(); 
	var idloaivang = $('#idloaivang').val();
	var url = $('#getUrlExportExcel').val();
	if(fromdays == ''){
		alert('Vui lòng chọn từ ngày');
		return false;
	}
	else if(todays == ''){
		alert('Vui lòng chọn đến ngày');	
		return false;
	}
	else{
		url = '<!--{$path_url}-->/print/xuat-file-excel.php?'+url+'&fromdays='+fromdays+'&todays='+todays+'&idloaivang='+idloaivang;
		popupwindow(url, 'ExportExcel')
		return false;	
	}
}
function printKhoSanxuatXuatKho(url){
	popupwindow(url, 'In')	
}

///////////////////////////////////////////VŨ THÊM KHO PHỤ KIỆN 29-10-19//////////////////////////////////////////////
function callExportExcelKhoKhac(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val(); 	
	url = url+'&fromdays='+fromdays+'&todays='+todays;
	exportExcelKhoKhac(url);
}

function printKhoSanxuatPhuKien(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var idloaivang = $('#idloaivang').val();
	var maphukiens = $('#maphukiens').val();
	url += '&fromdays='+fromdays+'&todays='+todays+'&idloaivang='+idloaivang+'&maphukiens='+maphukiens;
	popupwindow(url, 'In')	
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*============VŨ THÊM KHO LƯU MẪU 15-11-19=============================*/    
function searchMaDonHangCatalogLM(id,code,idLM) {
	$('#namemadonhang'+idLM).val(code);
	$('#madhin'+idLM).val(id);
	updatedongLM('updatedong',code,idLM,'madhin','khokhac_luumau');
	return false;	
}   
function updatedongLM(act,str,id,cot,table){//id là phòng chuyển đến			
	$('#loadingAjax').show();
	if(str > 0 && id > 0){
		$.post('<!--{$path_url}-->/ajax/Checkip.php',{act:act,id:id,str:str,cot:cot,table:table},function(data) {																				
		 var obj = jQuery.parseJSON(data);
		 if(obj.status == 'success'){
			$('#loadingAjax').hide();
			 }
		});	
	}
}  
/*=========================================*/ 
</script>

<script>
	// // M.Tân thêm ngày 23/07/2019
	// function chuyenKhoVatTu(act, cid, id, phongbanchuyen){
    //     if(cid > 0){
    //         var answer = confirm("Bạn có chắc muốn chuyển không?");
    //         if(answer){
    //             $('#loadingAjax').show();
    //             $.post('<!--{$path_url}-->/ajax/vattu_chuyenkho.php', {act:act,cid:cid,id:id,phongbanchuyen:phongbanchuyen},function(data){
                        
    //                     var obj = jQuery.parseJSON(data);
    //                     if(obj.status == 'success'){
    //                         $('#loadingAjax').hide();
    //                         location.reload();
    //                     } 
    //                     else {
    //                         $('#loadingAjax').hide();
    //                         alert(obj.status); 
    //                     }
    //             });
    //         }
    //     }
    // }

	// M.Tân thêm ngày 01/08/2019
	function chuyenKhoVatTu(act, cid, id, phongbanchuyen) {
		//alert(typeof(phongbanchuyen));
		if(id > 0){
			if(act === 'duyetPhieuDeNghi' || act === 'duyetPhieuNhapXuatLuuTru'){
				var answer = confirm("Bạn có chắc muốn duyệt phiếu này không?");
			} else {
				var answer = confirm("Bạn có chắc muốn chuyển không?");
			}

			if (answer)
			{
				$('#loadingAjax').show();
				$.post('<!--{$path_url}-->/ajax/vattu_chuyenkho.php',{act:act,cid:cid,id:id,phongbanchuyen:phongbanchuyen},function(data) {																				
					var obj = jQuery.parseJSON(data);
					if(obj.status == 'success'){
						$('#loadingAjax').hide();
						location.reload();
					}
					else{
						$('#loadingAjax').hide();
						alert(obj.status);	 
					}
				});
			} else {
				location.reload();
			}
		}	
	}

</script>

<script type="text/javascript">
	$(function(){
		$("table").colResizable({liveDrag:true});
		$("table.disabledColumns").colResizable({liveDrag:true, disable: true});
	});
</script>
<script type="text/javascript" src="<!--{$path_url}-->/js/khoa-tab-menu.js"></script>
</body>
</html>