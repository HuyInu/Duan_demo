$('.autoNumeric').autoNumeric('init', {aSep: ',', aDec: '.', mDec: 3});
$('.autoNumeric4').autoNumeric('init', {aSep: ',', aDec: '.', mDec: 4});
$('.autoNumeric0').autoNumeric('init', {aSep: ',', aDec: '.', mDec: 0});
function formatNumberLloat(num){
	return Number.parseFloat(num).toFixed(3);
}
function formatNumberLloat4(num){
	return Number.parseFloat(num).toFixed(4);
}
function formatNumberLloat2(num){
	return Number.parseFloat(num).toFixed(2);
}
function getslcannangv(num){
	var cannangvh = $('#cannangvh'+num).val();
	var cannangh = $('#cannangh'+num).val();
	var cannangv;
	
	cannangvh = cannangvh.split(',').join('');	
	cannangh = cannangh.split(',').join('');
	if(cannangvh == '')
		 cannangvh = 0;	
	if(cannangh == '')
		 cannangh = 0; 	 
	if(parseFloat(cannangh) > parseFloat(cannangvh)){
		alert('Cân nặng V+H  phải lớn hơn cân nặng H');	
		$('#cannangh'+num).val(0);
	}
	else{
		cannangv = parseFloat(cannangvh) - parseFloat(cannangh);
		cannangv =  formatNumber(cannangv);
		$('#cannangv'+num).val(cannangv);
	}
}
function addNewRowGirlVang(path_url,nhomdanhmuc) {
	var idnumvang = $('#idnumvang').val();
	jQuery.post(path_url+'/ajax/addDatagirld.php',{act:'dateGirldNguonVaoVang',nhomdanhmuc:nhomdanhmuc,idnumvang:idnumvang},function(data) {																				
		 var obj = jQuery.parseJSON(data);
		 $("#idnumvang").val(obj.idnumvang);
		 $("#addRowGirlVang").append(obj.status);
		 reload_js(path_url+'/js/colResizable-1.6.js');
	});	
}

function addNewRowGirlKimCuong(path_url,nhomdanhmuc) {
	var idnumkimcuong = $('#idnumkimcuong').val();
	jQuery.post(path_url+'/ajax/addDatagirld.php',{act:'dateGirldNguonVaoKimCuong',nhomdanhmuc:nhomdanhmuc,idnumkimcuong:idnumkimcuong},function(data) {																				
		 var obj = jQuery.parseJSON(data);
		 $("#idnumkimcuong").val(obj.idnumkimcuong);
		 $("#addRowGirlKimCuong").append(obj.status); 
	});	
}

function SubmitFromPT(){
	var name = $('#name');
	var lydo = $('#lydo');
	
	if(name.val()==''){
		alert('Vui lòng nhập vào người lập.');	
		name.focus();
		return false;
	}
	else if(lydo.val()==''){
		alert('Vui lòng nhập vào lý do.');	
		lydo.focus();
		return false;
	}
	else{
		$('#loadingAjax').show();
		document.allsubmit.submit();
	 }
}
function SubmitFromXuatKhoSanXuatHaoDu(){
	var checkNullTungPhieuVang = checkNullTungPhieuKimCuong = '' ;
	var dated  = $('#dated').val();
	var loaivang  = $('#idloaivang').val();
	var hao = $('#hao').val();
	var du  = $('#du').val();
	
	var haochenhlech = $('#haochenhlech').val();
	var duchenhlech  = $('#duchenhlech').val();
	
	if(dated == ''){ 
		checkNullTungPhieuVang = 'Vui lòng chọn ngày .';	/// vui lòng nhập cannangvh
	}
	else if((loaivang != 22) && (loaivang <=0 || loaivang == '')){ 
		checkNullTungPhieuVang = 'Vui lòng nhập vào Loại Vàng .';	/// vui lòng nhập cannangvh
	}
	else if(hao <=0  && du <=0 && haochenhlech <=0 && duchenhlech <=0 ){ 
		checkNullTungPhieuVang = 'Vui lòng nhập vào Hao Kết Dẻ hoặc Dư Kết Dẻ, Hao Chênh Lệch hoặc Dư Chênh Lệch.';	/// vui lòng nhập cannangvh
	}
	else if(hao > 0  && du > 0 && haochenhlech > 0 && duchenhlech > 0){ 
		checkNullTungPhieuVang = 'Vui lòng chỉ nhập Hao Kết Dẻ hoặc Dư Kết Dẻ, Hao Chênh Lệch hoặc Dư Chênh Lệch.';	/// vui lòng nhập cannangvh
	}
	
	else if(hao > 0  && du > 0 ){ 
		checkNullTungPhieuVang = 'Vui lòng chỉ nhập Hao Kết Dẻ hoặc Dư Kết Dẻ.';	/// vui lòng nhập cannangvh
	}
	else if(haochenhlech > 0 && duchenhlech > 0 ){ 
		checkNullTungPhieuVang = 'Vui lòng chỉ nhập Hao Chênh Lệch hoặc Dư Chênh Lệch.';	/// vui lòng nhập cannangvh
	}
	if(checkNullTungPhieuVang != ''){
		alert(checkNullTungPhieuVang);	
		return false;
	}
	else{
		var cid  = $('#cid').val();
		var path_url = $('#path_url').val();
		$('#loadingAjax').show();
		jQuery.post(path_url+'/ajax/Checkip.php',{act:'khoSanXuatkiemTraCoLoaiVang',cid:cid,idloaivang:loaivang},function(data) {																				
			 var obj = jQuery.parseJSON(data);
			 $('#loadingAjax').hide();
			 if(obj.status == 'success'){				
				document.allsubmit.submit();
			 }
			 else{
			 	alert(obj.status);	 
			 }
		});	
		
	 }
}
function SubmitFromXuatKhoSanXuat(isEditDieuChinhSoLieu){
	var checkNullTungPhieuVang = checkNullTungPhieuKimCuong = '' ;
	var nhomnguyenlieuvang = cannangvh = tuoivang = idloaivang = '';
	var cannangvh = $('#cannangvh1').val();
	var loaivang  = $('#idloaivang').val();
	var chonphongbanin  = $('#chonphongbanin').val();
	var madhin = $('#madhin').val(); 
	if(isEditDieuChinhSoLieu=='DieuChinhSoLieu'){
		document.allsubmit.submit();
	}
	else{ ///DieuChinhSoLieu
		if(madhin == ''){/// if là edit điều chỉnh số liệu thì kg kiểm tra phần này
			checkNullTungPhieuVang = 'Vui lòng chọn mã đơn hàng.';	/// vui lòng nhập tuổi vàng	
		}
		// if(chonphongbanin <= 0 && isEditDieuChinhSoLieu != 'DieuChinhSoLieu'){/// if là edit điều chỉnh số liệu thì kg kiểm tra phần này
		// 	checkNullTungPhieuVang = 'Vui lòng chọn phòng ban sản xuất.';	/// vui lòng nhập tuổi vàng	
		// }
		//if((loaivang != 19) && (loaivang != 22) && (cannangvh <=0 || cannangvh == '' || loaivang <=0 || loaivang == '')){ 
		if((loaivang != 4) && (loaivang != 2) && (loaivang != 1) && (loaivang != 22) && (cannangvh <=0 || cannangvh == '' || loaivang <=0 || loaivang == '')){ 
			checkNullTungPhieuVang = 'Vui lòng nhập vào: Loại Vàng và Cân Nặng V+H.';	/// vui lòng nhập cannangvh
		}
		if(checkNullTungPhieuVang != ''){	
			alert(checkNullTungPhieuVang);
			return false;
		}
		else{
			var cid  = $('#cid').val();
			var path_url = $('#path_url').val();
			$('#loadingAjax').show();
			jQuery.post(path_url+'/ajax/Checkip.php',{act:'khoSanXuatkiemTraCoLoaiVang',cid:cid,idloaivang:loaivang},function(data) {																				
				 var obj = jQuery.parseJSON(data);
				 $('#loadingAjax').hide();
				 if(obj.status == 'success'){				
					document.allsubmit.submit();
				 }
				 else{
					alert(obj.status);	 
				 }
			});	
		 }
	}
}

/*function SubmitFromXuatKhoSanXuat(isEditDieuChinhSoLieu){
	var checkNullTungPhieuVang = checkNullTungPhieuKimCuong = '' ;
	var nhomnguyenlieuvang = cannangvh = tuoivang = idloaivang = '';
	var cannangvh = $('#cannangvh1').val();
	var loaivang  = $('#idloaivang').val();
	var chonphongbanin  = $('#chonphongbanin').val();
	var madhin = $('#madhin').val(); 
	if(isEditDieuChinhSoLieu=='DieuChinhSoLieu'){
		document.allsubmit.submit();
	}
	else{ ///DieuChinhSoLieu
		if(madhin == ''){/// if là edit điều chỉnh số liệu thì kg kiểm tra phần này
			checkNullTungPhieuVang = 'Vui lòng chọn mã đơn hàng.';	/// vui lòng nhập tuổi vàng	
		}
		if(chonphongbanin <= 0 && isEditDieuChinhSoLieu != 'DieuChinhSoLieu'){/// if là edit điều chỉnh số liệu thì kg kiểm tra phần này
			checkNullTungPhieuVang = 'Vui lòng chọn phòng ban sản xuất.';	/// vui lòng nhập tuổi vàng	
		}
		//if((loaivang != 19) && (loaivang != 22) && (cannangvh <=0 || cannangvh == '' || loaivang <=0 || loaivang == '')){ 
		if((loaivang != 4) && (loaivang != 2) && (loaivang != 1) && (loaivang != 22) && (cannangvh <=0 || cannangvh == '' || loaivang <=0 || loaivang == '')){ 
			checkNullTungPhieuVang = 'Vui lòng nhập vào: Loại Vàng và Cân Nặng V+H.';	/// vui lòng nhập cannangvh
		}
		if(checkNullTungPhieuVang != ''){	
			alert(checkNullTungPhieuVang);
			return false;
		}
		else{
			var cid  = $('#cid').val();
			var path_url = $('#path_url').val();
			$('#loadingAjax').show();
			jQuery.post(path_url+'/ajax/Checkip.php',{act:'khoSanXuatkiemTraCoLoaiVang',cid:cid,idloaivang:loaivang},function(data) {																				
				 var obj = jQuery.parseJSON(data);
				 $('#loadingAjax').hide();
				 if(obj.status == 'success'){				
					document.allsubmit.submit();
				 }
				 else{
					alert(obj.status);	 
				 }
			});	
			
		 }
	}
}*/

function SubmitFromPTKhoNguonVaoOne(){
	var name = $('#name');
	var lydo = $('#lydo');
	/*==========Check từng dòng nếu có chọn mã phiếu thì cột LV Cắt, Tuổi thực tế, Tuổi quy định, không được rỗng và > 0=========*/
	var checkNullTungPhieuVang = checkNullTungPhieuKimCuong = '' ;
	var nhomnguyenlieuvang = cannangvh = tuoivang = idloaivang = '';
	nhomnguyenlieuvang = $('#nhomnguyenlieuvang1').val();
	cannangvh = $('#cannangvh1').val();
	tuoivang  = $('#tuoivang1').val();
	loaivang  = $('#idloaivang').val();
	if((nhomnguyenlieuvang == 75) || (nhomnguyenlieuvang == 107) || (nhomnguyenlieuvang == 214) || (nhomnguyenlieuvang == 139)){
		if(tuoivang <=0 || tuoivang == ''){
			checkNullTungPhieuVang = 'Vui lòng nhập vào Tuổi Vàng của Dể Cụt';	/// vui lòng nhập tuổi vàng
		}
	}
	if(nhomnguyenlieuvang > 0 && nhomnguyenlieuvang != ''){
		if(tuoivang != ''){
			tuoivang = tuoivang.split(',').join('');
			if(tuoivang == '')
				 tuoivang = 0;	
		}
		if(tuoivang >= 1){
			checkNullTungPhieuVang = 'Vui lòng nhập vào Tuổi Vàng nhỏ hơn 1, vd: 0.9999';	/// vui lòng nhập tuổi vàng	
		}
		//if((loaivang != 19) && (loaivang != 22) && (cannangvh <=0 || cannangvh == '' || loaivang <=0 || loaivang == '')){ 
		if((loaivang != 4) && (loaivang != 2) && (loaivang != 1) && (loaivang != 22) && (cannangvh <=0 || cannangvh == '' || loaivang <=0 || loaivang == '')){ 
			checkNullTungPhieuVang = 'Vui lòng nhập vào: Loại Vàng và Cân Nặng V+H.';	/// vui lòng nhập cannangvh
		}
	}	
	var nhomnguyenlieukimcuong = idkimcuong = '';
	nhomnguyenlieukimcuong = $('#nhomnguyenlieukimcuong1').val();
	tenkimcuong = $('#idkimcuong1').val();
	
	if(nhomnguyenlieukimcuong > 0 && nhomnguyenlieukimcuong != ''){
		if(tenkimcuong <=0 || tenkimcuong == ''){
			checkNullTungPhieuKimCuong = 'Vui lòng chọn Tên Kim Cương.';	/// vui lòng nhập cannangvh
		}
	}	
	if(nhomnguyenlieuvang <= 0 || nhomnguyenlieuvang == '' || nhomnguyenlieukimcuong <= 0 || nhomnguyenlieukimcuong == '' ){
		alert('Vui lòng chọn Nhóm Nguyên Liệu.');	
		return false;
	}
	else if(checkNullTungPhieuVang != ''){
		alert(checkNullTungPhieuVang);	
		return false;
	}
	else if(checkNullTungPhieuKimCuong != ''){
		alert(checkNullTungPhieuKimCuong);	
		return false;
	}
	else{
		$('#loadingAjax').show();
		document.allsubmit.submit();
	 }
}

function SubmitFromPTKhoNguonVao(){
	var name = $('#name');
	var lydo = $('#lydo');
	/*==========Check từng dòng nếu có chọn mã phiếu thì cột LV Cắt, Tuổi thực tế, Tuổi quy định, không được rỗng và > 0=========*/
	var checkNullTungPhieuVang = checkNullTungPhieuKimCuong = '' ;
	var checkNhomNguyenLieuVang = checkNhomNguyenLieuKimCuong = 0;
	var idnumvang = $('#idnumvang').val();
	var idnumkimcuong = $('#idnumkimcuong').val();
	var idnum =  Math.round(idnumvang);
	var idnumkimcuong =  Math.round(idnumkimcuong);
	for (i=1; i < idnum; i++) {/// kiểm tra vàng
		var nhomnguyenlieuvang = cannangvh = tuoivang = idloaivang = '';
		nhomnguyenlieuvang = $('#nhomnguyenlieuvang'+i).val();
		cannangvh = $('#cannangvh'+i).val();
		loaivang  = $('#idloaivang'+i).val();
		tuoivang  = $('#tuoivang'+i).val();
		if((nhomnguyenlieuvang == 75) || (nhomnguyenlieuvang == 107) || (nhomnguyenlieuvang == 214) || (nhomnguyenlieuvang == 139)){
			if(tuoivang <=0 || tuoivang == ''){
				checkNullTungPhieuVang = 'Vui lòng nhập vào Tuổi Vàng của Dể Cụt';	/// vui lòng nhập tuổi vàng
			}
		}
		if(nhomnguyenlieuvang > 0 && nhomnguyenlieuvang != ''){
			checkNhomNguyenLieuVang = 1;
			if(tuoivang != ''){
				tuoivang = tuoivang.split(',').join('');
				if(tuoivang == '')
					 tuoivang = 0;	
			}
			if(tuoivang >= 1){
				checkNullTungPhieuVang = 'Vui lòng nhập vào Tuổi Vàng nhỏ hơn 1, vd: 0.9999';	/// vui lòng nhập tuổi vàng	
			}
			
			//if((loaivang != 19) && (loaivang != 22) && (cannangvh <=0 || cannangvh == '' || loaivang <=0 || loaivang == '')){
			if((loaivang != 4) && (loaivang != 2) && (loaivang != 1) && (loaivang != 22) && (cannangvh <=0 || cannangvh == '' || loaivang <=0 || loaivang == '')){
				checkNullTungPhieuVang = 'Vui lòng nhập vào: Loại Vàng và Cân Nặng V+H.';	/// vui lòng nhập cannangvh
			}
		}	
	}
	
	for (j=1; j < idnumkimcuong; j++) {/// kiểm tra kim cương
		var nhomnguyenlieukimcuong = idkimcuong = '';
		
		nhomnguyenlieukimcuong = $('#nhomnguyenlieukimcuong'+j).val();
		tenkimcuong = $('#idkimcuong'+j).val();
		if(nhomnguyenlieukimcuong > 0 && nhomnguyenlieukimcuong != ''){
			checkNhomNguyenLieuKimCuong = 1;
			if(tenkimcuong <=0 || tenkimcuong == ''){
				checkNullTungPhieuKimCuong = 'Vui lòng chọn Tên Kim Cương.';	/// vui lòng nhập cannangvh
			}
		}	
	} 
	if((checkNhomNguyenLieuVang == 0) && (checkNhomNguyenLieuKimCuong == 0)){
		alert('Vui lòng chọn nhóm nguyên liệu');
		return false;
	}
	else if(checkNullTungPhieuVang != ''){
		alert(checkNullTungPhieuVang);	
		return false;
	}
	else if(checkNullTungPhieuKimCuong != ''){
		alert(checkNullTungPhieuKimCuong);	
		return false;
	}
	else if(name.val()==''){
		alert('Vui lòng nhập vào người lập.');	
		name.focus();
		return false;
	}
	else if(lydo.val()==''){
		alert('Vui lòng nhập vào lý do.');	
		lydo.focus();
		return false;
	}
	else{
		$('#loadingAjax').show();
		document.allsubmit.submit();
	}
}

function check_file(name)
{
   	if(name == "fileexcel"){	
   		var file = document.allsubmit.fileexcel;
   		input =	document.getElementById('fileexcel');
		var type=",xls,XLS,xlsx,XLSX";
	}
	else{
		var file = document.allsubmit.img;
		input =	document.getElementById('img');
		var type=",jpeg,gif,png,jpg,JPEG,JPG,PNG,GIF,bmp,BMP";
	}
	f =	input.files[0];
   	var str = file.value;
	var ext=str.match(/[\w]*$/);
	if(type.search(ext)==-1)
	{
		file.value='';
		alert('File không đúng định dạng.');
		file.focus();
		return false;
	}
	if(f.size > 2*1024*1024)
	{
		file.value='';
		alert('File lớn hơn kích thước cho phép là 2MB.');
		file.focus();
		return false;
	}	
	return true;
}

// =================== ANH VŨ THÊM CHECK TỒN TẠI - DANH MỤC TEM HỘP ========================== // 
function SubmitFromDMTem(path_url,id,table){
	var code = $('#code').val();
	var dated = $('#dated').val();
	var size = $('#size').val();
	var dongia = ($('#dongia').val()).replace('/,/g',''); // Thay thế dấu , // Chưa được

	var pattern =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/; /* Kiểm tra định dạng d/m/Y */

	if(code == ''){
		alert('Bạn chưa nhập mã tem!');
		$('#code').focus();
		return false;
	}else if(dated == ''){
		alert('Bạn chưa nhập Ngày hiệu lực!');
		$('#dated').focus();
		return false;
	}else if(size == ''){
		alert('Bạn chưa nhập size tem!');
		$('#size').focus();
		return false;
	}else if(dongia == ''){
		alert('Bạn chưa nhập đơn giá!');
		$('#dongia').focus();
		return false;
	}else if(dongia < 1 && dongia > 100000){
		alert('Đơn giá trong khoảng 1 đến 100,000!');
		$('#dongia').focus();
		return false;
	}else if(pattern.test(dated) == false){
		alert('Sai định dạng ngày!');
		$('#dated').focus();
		return false;
	}
	else{
		jQuery.post(path_url+'/ajax/Checkip.php',{act:'checkMaTem',code:code,id:id,table:table},function(data) {																				
			var obj = jQuery.parseJSON(data);
			if(obj.status == 'success'){
				document.allsubmit.submit();
			}
			else{
				alert(obj.status);
				$('#code').focus();
			}
		});
		return false;
	}
}
// =================== KẾT THÚC THÊM CHECK TỒN TẠI - DANH MỤC TEM HỘP ======================== //
