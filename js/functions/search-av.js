
$('.autoNumeric').autoNumeric('init', {aSep: ',', aDec: '.', mDec: 3});
$(document).ready(function() {
	$("#todays").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
	$("#fromdays").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
	$("#dateds").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
 });
function resetTemHop(){
	$('#fromdays').val('');
	$('#todays').val('');
	$('#dateds').val('');
	$('#midduyets').val('');
	$('#maphieus').val('');
	$('#codetems').val('');
	$('#sizetems').val('');
}
function resetTemGiay(){
	$('#fromdays').val('');
	$('#todays').val('');
	$('#dateds').val('');
	$('#maphieus').val('');
	$('#nguoilaps').val('');
	$('#nguoiduyets').val('');
	$('#sochungtus').val('');
	$('#codetems').val('');
	$('#sizetems').val('');
}
function resetTemDa(){
	$('#fromdays').val('');
	$('#todays').val('');
	$('#maphieus').val('');
	$('#madonhangs').val('');
	$('#masanphams').val('');
	$('#tendas').val('');
	$('#sizedas').val('');
	$('#ghichus').val('');
	$('#tenchinhanhs').val('');
}
function searchTemDa(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var maphieus = $('#maphieus').val();
	var madonhangs = $('#madonhangs').val();
	var masanphams = $('#masanphams').val();
	var tendas = $('#tendas').val();
	var sizedas = $('#sizedas').val();
	var tenchinhanhs = $('#tenchinhanhs').val();
	var ghichus = $('#ghichus').val();
	var phongbanins = $('#phongbanins').val();
	var str = '';
	if(fromdays != '' && fromdays !== undefined)
		str = str + '&fromdays='+fromdays;
	if(todays != '' && todays !== undefined)
		str = str + '&todays='+todays;
	if(maphieus != '' && maphieus !== undefined)
		str = str + '&maphieus='+maphieus;
	if(madonhangs != '' && madonhangs !== undefined)
		str = str + '&madonhangs='+madonhangs;
	if(masanphams != '' && masanphams !== undefined)
		str = str + '&masanphams='+masanphams;
	if(tendas != '' && tendas !== undefined)
		str = str + '&tendas='+tendas;
	if(sizedas != '' && sizedas !== undefined)
		str = str + '&sizedas='+sizedas;
	if(tenchinhanhs != '' && tenchinhanhs !== undefined)
		str = str + '&tenchinhanhs='+tenchinhanhs;
	if(ghichus != '' && ghichus !== undefined)
		str = str + '&ghichus='+ghichus;
	if(phongbanins != '' && phongbanins !== undefined)
		str = str + '&phongbanins='+phongbanins;
	$(location).attr('href', url+str);
	return false;
}
function searchTemHop(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var midduyets = $('#midduyets').val();
	var maphieus = $('#maphieus').val();
	var codetems = $('#codetems').val();
	var sizetems = $('#sizetems').val();
	
	var str = '';
	if(fromdays != '' && fromdays !== undefined)
		str = str + '&fromdays='+fromdays;
	if(todays != '' && todays !== undefined)
		str = str + '&todays='+todays;
	if(midduyets != '' && midduyets !== undefined)
		str = str + '&midduyets='+midduyets;
	if(maphieus != '' && maphieus !== undefined)
		str = str + '&maphieus='+maphieus;
	if(codetems != '' && codetems !== undefined)
		str = str + '&codetems='+codetems;
	if(sizetems != '' && sizetems !== undefined)
		str = str + '&sizetems='+sizetems;
	$(location).attr('href', url+str);
	return false;
}
function searchTemGiay(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var maphieus = $('#maphieus').val();
	var midduyets = $('#midduyets').val();
	var codetems = $('#codetems').val();
	var sizetems = $('#sizetems').val();
	
	var str = '';
	if(fromdays != '' && fromdays !== undefined)
		str = str + '&fromdays='+fromdays;
	if(todays != '' && todays !== undefined)
		str = str + '&todays='+todays;
	if(maphieus != '' && maphieus !== undefined)
		str = str + '&maphieus='+maphieus;
	if(midduyets != '' && midduyets !== undefined)
		str = str + '&midduyets='+midduyets;
	if(codetems != '' && codetems !== undefined)
		str = str + '&codetems='+codetems;
	if(sizetems != '' && sizetems !== undefined)
		str = str + '&sizetems='+sizetems;	
	$(location).attr('href', url+str);
	return false;
}
