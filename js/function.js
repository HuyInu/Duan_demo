function checkview(){
	var check=document.allsubmit;
	if(document.allsubmit.viewcheck.checked == true)
	{
		//for(var i=1;i<20;i++)
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkview"+i).checked = true;
		}
	}
	else
	{
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkview"+i).checked = false;
		}
	}
}

function checkadd(){
	var check=document.allsubmit;
	if(document.allsubmit.addcheck.checked == true)
	{
		//for(var i=1;i<20;i++)
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkadd"+i).checked = true;
		}
	}
	else
	{
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkadd"+i).checked = false;
		}
	}
}
function checkedit(){
	var check=document.allsubmit;
	if(document.allsubmit.editcheck.checked == true)
	{
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkedit"+i).checked = true;
		}
	}
	else
	{
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkedit"+i).checked = false;
		}
	}
}
function checkdel(){
	var check=document.allsubmit;
	if(document.allsubmit.delcheck.checked == true)
	{
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkdel"+i).checked = true;
		}
	}
	else
	{
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkdel"+i).checked = false;
		}
	}
}
function checkchuyen(){
	var check=document.allsubmit;
	if(document.allsubmit.chuyencheck.checked == true)
	{
		//for(var i=1;i<20;i++)
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkchuyen"+i).checked = true;
		}
	}
	else
	{
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkchuyen"+i).checked = false;
		}
	}
}
function checkprintin(){
	var check=document.allsubmit;
	if(document.allsubmit.checkprint.checked == true)
	{
		//for(var i=1;i<20;i++)
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkprint"+i).checked = true;
		}
	}
	else
	{
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkprint"+i).checked = false;
		}
	}
}

function checkall(){
	var check=document.allsubmit;
	if(document.allsubmit.allcheck.checked == true)
	{
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkall"+i).checked = true;
		}
	}
	else
	{
		for(var i=1;i<check.length;i++)
		{
			document.getElementById("checkall"+i).checked = false;
		}
	}
}


function CheckHasChild(chk){
	if(chk.checked==false){
		document.getElementById('comp').disabled = false;
	}
	else{
		document.getElementById('comp').selectedIndex  = 0;
	}
}

function checkAll()
{
	if(document.f.all.checked == true)
	{
		for(var i=0;i<200;i++)
		{
			console.log(document.getElementById("check"+i).checked);
			document.getElementById("check"+i).checked = true;
		}
	}
	else
	{
		for(var i=0;i<200;i++)
		{
			
			document.getElementById("check"+i).checked = false;
		}
	}
}

function ChangeAction(url)
{
	
	var answer = confirm("Bạn chất muốn thực hiện không?");
	if (answer)
	{
		document.getElementById('f').action = url;
		document.getElementById('f').submit();
	}
	
}
function Giahuy_ChangeAction(url)
{
	document.getElementById('f').action = url;
	document.getElementById('f').submit();
	
}
function ChangeAdd(url)
{
	document.location.href = url;
}

function SubmitFrom(a,dir_img) {
	var name_vn = document.allsubmit.name_vn;
	
	if(name_vn.value.length == ''){
		alert('Vui lòng nhập vào tên');
		name_vn.focus();
		return false;
	}
	else{
		document.allsubmit.submit();
	}
}

function check_file(name)
{
   if(name == "img_thumb_vn")	
  	 var file = document.allsubmit.img_thumb_vn;
 
   var str = file.value;
   var type=",jpeg,gif,png,jpg,JPEG,JPG,PNG,GIF,bmp,BMP,swf,SWF";
	var ext=str.match(/[\w]*$/);
	if(type.search(ext)==-1)
	{
		file.value='';
		alert('File hình không đúng định dạng.');
		file.focus();
		return false;
	}
	return true;
}

//Tâm thêm - so sánh ngày bắt đầu không cho phép nhỏ hơn ngày kết thúc tìm kiếm
function DateCheck()
{
	var  fromdays = $('#fromdays');
	var  todays = $('#todays');
	if(fromdays.val() != '' &&  todays.val() != ''){
		var StartDate = fromdays.val(); // lấy giá trị ngày bắt đầu
		var sDate_replaced = stringReplace(StartDate,'-','/'); // replace dau - thanh dau /
		var datearray_s = sDate_replaced.split("/"); // cắt thành mảng
		var sDate_f = datearray_s[1]+'/'+datearray_s[0]+'/'+datearray_s[2]; // Chuyển ngày bắt đầu từ dd/mm/yyyy về mm/dd/yyyy
		var sDate = new Date(sDate_f); // Tạo một date
		var sDate_parse = Date.parse(sDate); // parse ra giá trị để so sánh
	
		var EndDate= todays.val(); // Lấy giá trị ngày kết thúc
		var eDate_replaced = stringReplace(EndDate,'-','/'); // replace dau - thanh dau /
		var datearray_e = eDate_replaced.split("/");	//Cắt thành mảng
		var eDate_f = datearray_e[1]+'/'+datearray_e[0]+'/'+datearray_e[2]; // chuyển về mm/dd/yyyy
		var eDate = new Date(eDate_f); //Tạo biến date
		var eDate_parse = Date.parse(eDate); // parse ra giá trị để so sánh
		if(StartDate!= '' && StartDate!= '' && sDate_parse > eDate_parse)
		{
			alert("Từ ngày phải nhỏ hơn hoặc bằng Đến ngày.");
			$('#todays').val('');
			return false;
		}
	}
}  

//Tâm thêm
function stringReplace(str,c1,c2)
{
	//str là chuỗi đầu vào có chứa ký tự cần thay đổi
	//c1 ký tự cần bị thay đổi
	//c2 ký từ thay đổi
	// ví dụ : replace chuổi 10-05-2018 thành 10/05/2018 thì c1 sẽ là ký tự '-' , c2 là '/' 
	var i=0;
	while (i <= str.length) {
    	str=str.replace(c1,c2);
    	i++;
	}
	return str;
}