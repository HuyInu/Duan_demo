
$('.autoNumeric').autoNumeric('init', {aSep: ',', aDec: '.', mDec: 3});
$(document).ready(function() {
	$("#todays").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
	$("#fromdays").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
	$("#daychungtus").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
 });

function resetsfrsearchdecuc(){
	
	$('#fromdays').val('');
	$('#todays').val('');
	$('#idloaivang').val('');
	
	$('#codes').val('');
	$('#madonhangsxs').val('');
	$('#nhomnguyenlieus').val('');
	$('#tennguyenlieus').val('');
	$('#tuoivangs').val('');
	$('#tienmats').val('');
	$('#ghichus').val('');
	$('#maphukiens').val('');
}
function resetsfrsearch(){
	$('#fromdays').val('');
	$('#todays').val('');
	
	$('#codes').val('');
	$('#sizes').val('');
	$('#daychungtus').val('');
	$('#names').val('');
	$('#namelaps').val('');
	$('#donvilaps').val('');
	$('#nameduyets').val('');
	$('#donviduyets').val('');
	$('#lydos').val('');
	
	$('#ghichus').val('');
	$('#madonhangsxs').val('');
	$('#trongluongvangs').val('');
}
function searchtop(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var codes = $('#codes').val();
	var sizes = $('#sizes').val();
	var daychungtus = $('#daychungtus').val();
	var names = $('#names').val();
	var namelaps = $('#namelaps').val();
	var donvilaps = $('#donvilaps').val();
	var nameduyets = $('#nameduyets').val();
	var donviduyets = $('#donviduyets').val();
	var lydos = $('#lydos').val();
	
	var str = '';
	if(fromdays != '' && fromdays !== undefined)
		str = str + '&fromdays='+fromdays;
	if(todays != '' && todays !== undefined)
		str = str + '&todays='+todays;
	if(codes != '' && codes !== undefined)
		str = str + '&codes='+codes;
	if(sizes != '' && sizes !== undefined)
		str = str + '&sizes='+sizes;
	if(daychungtus != '' && daychungtus !== undefined)
		str = str + '&daychungtus='+daychungtus;
	if(names != '' && names !== undefined)
		str = str + '&names='+names;
	if(namelaps != '' && namelaps !== undefined)
		str = str + '&namelaps='+namelaps;
	if(donvilaps != '' && donvilaps !== undefined)
		str = str + '&donvilaps='+donvilaps;
	if(nameduyets != '' && nameduyets !== undefined)
		str = str + '&nameduyets='+nameduyets;
	if(donviduyets != '' && donviduyets !== undefined)
		str = str + '&donviduyets='+donviduyets;
	if(lydos != '' && lydos !== undefined)
		str = str + '&lydos='+lydos;		
	$(location).attr('href', url+str);
	return false;
}

function resetNguonVaoVangKimCuong(){
	$('#fromdays').val('');
	$('#todays').val('');
	$('#codes').val('');
	$('#idpnks').val('');
	$('#daychungtus').val('');
	$('#nhomnguyenlieus').val('');
	$('#tennguyenlieus').val('');
	$('#idloaivang').val('');
	$('#loaivangs').val('');
	$('#cannangvhs').val('');
	$('#cannanghs').val('');
	$('#cannangvs').val('');
	$('#tuoivangs').val('');
	$('#tienmats').val('');
	$('#ghichus').val('');
	$('#haos').val('');
	$('#dus').val('');
	$('#maphieus').val('');
	
	$('#tenkimcuongs').val('');
	$('#masogdpnjs').val('');
	$('#mscanhgtas').val('');
	$('#kichthuocs').val('');
	$('#trongluonghots').val('');
	$('#dotinhkhiets').val('');
	$('#capdomaus').val('');
	$('#domaibongs').val('');
	$('#kichthuocbans').val('');
	$('#dongias').val('');
	
	$('#tongtlvangsauchetacs').val('');
	$('#tuoivangsauchetacs').val('');
	$('#hoichetacs').val('');
	
	$('#daynhaps').val('');
	$('#checkchons').val('');
		
	//====VŨ THÊM 15-11-19=====//
	$('#phongchuyens').val('');
	$('#madhsxs').val('');
	//======KẾT THÚC VŨ THÊM=====//
}
function searchKhoDauVaoXuatVang(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var codes = $('#codes').val();
	var daychungtus = $('#daychungtus').val();
	var nhomnguyenlieus = $('#nhomnguyenlieus').val();
	var tennguyenlieus = $('#tennguyenlieus').val();
	var loaivangs = $('#loaivangs').val();
	var idloaivang = $('#idloaivang').val();
	var cannangvhs = $('#cannangvhs').val();
	var cannanghs = $('#cannanghs').val();
	var cannangvs = $('#cannangvs').val();
	var tuoivangs = $('#tuoivangs').val();
	var tienmats = $('#tienmats').val();
	var ghichus = $('#ghichus').val();
	var maphieus = $('#maphieus').val();
	var madhsxs = $('#madhsxs').val();
	var maphukiens = $('#maphukiens').val();
	
	var daynhaps = $('#daynhaps').val();
	var checkchons = $('#checkchons').val();
	//==========Vũ thêm 15-11-19=============//
	var phongchuyens = $('#phongchuyens').val();
	var idpnks = $('#idpnks').val();
	//======================================//
	var str = '';
	//==========Vũ thêm 15-11-19=============//
	if(phongchuyens != '' && phongchuyens !== undefined)
		str = str + '&phongchuyens='+phongchuyens;
	if(idpnks != '' && idpnks !== undefined)
		str = str + '&idpnks='+idpnks;
	//======================================//
	if(fromdays != '' && fromdays !== undefined)
		str = str + '&fromdays='+fromdays;
	if(todays != '' && todays !== undefined)
		str = str + '&todays='+todays;
	if(codes != '' && codes !== undefined)
		str = str + '&codes='+codes;
	if(daychungtus != '' && daychungtus !== undefined)
		str = str + '&daychungtus='+daychungtus;
	if(nhomnguyenlieus != '' && nhomnguyenlieus !== undefined)
		str = str + '&nhomnguyenlieus='+nhomnguyenlieus;
	if(tennguyenlieus != '' && tennguyenlieus !== undefined)
		str = str + '&tennguyenlieus='+tennguyenlieus;
	if(loaivangs != '' && loaivangs !== undefined)
		str = str + '&loaivangs='+loaivangs;
	if(idloaivang != '' && idloaivang !== undefined)
			str = str + '&idloaivang='+idloaivang;	
	if(cannangvhs != '' && cannangvhs !== undefined)
		str = str + '&cannangvhs='+cannangvhs;
	if(cannanghs != '' && cannanghs !== undefined)
		str = str + '&cannanghs='+cannanghs;
	if(cannangvs != '' && cannangvs !== undefined)
		str = str + '&cannangvs='+cannangvs;
	if(tuoivangs != '' && tuoivangs !== undefined)
		str = str + '&tuoivangs='+tuoivangs;
	if(tienmats != '' && tienmats !== undefined)
		str = str + '&tienmats='+tienmats;	
	if(ghichus != '' && ghichus !== undefined)
		str = str + '&ghichus='+ghichus;
	if(maphieus != '' && maphieus !== undefined)
		str = str + '&maphieus='+maphieus;
	if(madhsxs != '' && madhsxs !== undefined)
		str = str + '&madhsxs='+madhsxs;
	if(maphukiens != '' && maphukiens !== undefined)
		str = str + '&maphukiens='+maphukiens;
	if(daynhaps != '' && daynhaps !== undefined)
		str = str + '&daynhaps='+daynhaps;
	if(checkchons != '' && checkchons !== undefined)
		str = str + '&checkchons='+checkchons;	
	$(location).attr('href', url+str);
	return false;
}

function searchKhoDauVaoXuatKimCuong(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var codes = $('#codes').val();
	var daychungtus = $('#daychungtus').val();
	var tenkimcuongs = $('#tenkimcuongs').val();
	var masogdpnjs = $('#masogdpnjs').val();
	var mscanhgtas = $('#mscanhgtas').val();
	var kichthuocs = $('#kichthuocs').val();
	var trongluonghots = $('#trongluonghots').val();
	var dotinhkhiets = $('#dotinhkhiets').val();
	var capdomaus = $('#capdomaus').val();
	var domaibongs = $('#domaibongs').val();
	var kichthuocbans = $('#kichthuocbans').val();
	var tienmats = $('#tienmats').val();
	var dongias = $('#dongias').val();
	var ghichus = $('#ghichus').val();

	var daynhaps = $('#daynhaps').val();
	var checkchons = $('#checkchons').val();
	
	var str = '';
	if(fromdays != '' && fromdays !== undefined)
		str = str + '&fromdays='+fromdays;
	if(todays != '' && todays !== undefined)
		str = str + '&todays='+todays;
	if(codes != '' && codes !== undefined)
		str = str + '&codes='+codes;
	if(daychungtus != '' && daychungtus !== undefined)
		str = str + '&daychungtus='+daychungtus;
	if(tenkimcuongs != '' && tenkimcuongs !== undefined)
		str = str + '&tenkimcuongs='+tenkimcuongs;
	if(masogdpnjs != '' && masogdpnjs !== undefined)
		str = str + '&masogdpnjs='+masogdpnjs;
	if(mscanhgtas != '' && mscanhgtas !== undefined)
		str = str + '&mscanhgtas='+mscanhgtas;
	if(kichthuocs != '' && kichthuocs !== undefined)
		str = str + '&kichthuocs='+kichthuocs;
	if(trongluonghots != '' && trongluonghots !== undefined)
		str = str + '&trongluonghots='+trongluonghots;
	if(dotinhkhiets != '' && dotinhkhiets !== undefined)
		str = str + '&dotinhkhiets='+dotinhkhiets;
	if(capdomaus != '' && capdomaus !== undefined)
		str = str + '&capdomaus='+capdomaus;
	if(domaibongs != '' && domaibongs !== undefined)
		str = str + '&domaibongs='+domaibongs;
	
	if(kichthuocbans != '' && kichthuocbans !== undefined)
		str = str + '&kichthuocbans='+kichthuocbans;
	if(tienmats != '' && tienmats !== undefined)
		str = str + '&tienmats='+tienmats;
	if(dongias != '' && dongias !== undefined)
		str = str + '&dongias='+dongias;
	if(ghichus != '' && ghichus !== undefined)
		str = str + '&ghichus='+ghichus;	
	if(daynhaps != '' && daynhaps !== undefined)
		str = str + '&daynhaps='+daynhaps;
	if(checkchons != '' && checkchons !== undefined)
		str = str + '&checkchons='+checkchons;
	$(location).attr('href', url+str);
	return false;
}

function KhoNguonVaoThongKeNhapXuatVang(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var codes = $('#codes').val();
	var idpnks = $('#idpnks').val();
	var nhomnguyenlieus = $('#nhomnguyenlieus').val();
	var tennguyenlieus = $('#tennguyenlieus').val();
	var loaivangs = $('#idloaivang').val();
	var cannangvhs = $('#cannangvhs').val();
	var cannanghs = $('#cannanghs').val();
	var cannangvs = $('#cannangvs').val();
	var tuoivangs = $('#tuoivangs').val();
	
	var phongchuyens = $('#phongchuyens').val();
	var phongsxs = $('#phongsxs').val();
	var madhsxs = $('#madhsxs').val();
	var ghichus = $('#ghichus').val();
	var idpxk = $('#idpxk').val(); 
	var maphukiens = $('#maphukiens').val();
	if(fromdays == ''){
		alert('Vui lòng chọn từ ngày');
		return false;
	}
	else if(todays == ''){
		alert('Vui lòng chọn đến ngày');	
		return false;
	}
	else{
		var str = '';
		if(fromdays != '' && fromdays !== undefined)
			str = str + '&fromdays='+fromdays;
		if(todays != '' && todays !== undefined)
			str = str + '&todays='+todays;
		if(codes != '' && codes !== undefined)
			str = str + '&codes='+codes;
		if(idpnks != '' && idpnks !== undefined)
			str = str + '&idpnks='+idpnks;
		if(nhomnguyenlieus != '' && nhomnguyenlieus !== undefined)
			str = str + '&nhomnguyenlieus='+nhomnguyenlieus;
		if(tennguyenlieus != '' && tennguyenlieus !== undefined)
			str = str + '&tennguyenlieus='+tennguyenlieus;
		if(loaivangs != '' && loaivangs !== undefined)
			str = str + '&loaivangs='+loaivangs;
		if(cannangvhs != '' && cannangvhs !== undefined)
			str = str + '&cannangvhs='+cannangvhs;
		if(cannanghs != '' && cannanghs !== undefined)
			str = str + '&cannanghs='+cannanghs;
		if(cannangvs != '' && cannangvs !== undefined)
			str = str + '&cannangvs='+cannangvs;
		if(tuoivangs != '' && tuoivangs !== undefined)
			str = str + '&tuoivangs='+tuoivangs;	
		if(phongchuyens != '' && phongchuyens !== undefined)
			str = str + '&phongchuyens='+phongchuyens;
		if(phongsxs != '' && phongsxs !== undefined)
			str = str + '&phongsxs='+phongsxs;
		if(madhsxs != '' && madhsxs !== undefined)
			str = str + '&madhsxs='+madhsxs;
		if(ghichus != '' && ghichus !== undefined)
			str = str + '&ghichus='+ghichus;	
		if(idpxk != '' && idpxk !== undefined) {
		str = str + '&idpxk='+idpxk;
		}
		if(maphukiens != '' && maphukiens !== undefined)
			str = str + '&maphukiens='+maphukiens;
		$(location).attr('href', url+str);
		return false;
	}
}

function KhoNguonVaoThongKeNhapXuatKimCuong(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var codes = $('#codes').val();
	var nhomnguyenlieus = $('#nhomnguyenlieus').val();
	var tennguyenlieus = $('#tennguyenlieus').val();
	
	var tenkimcuongs = [];
	$("input[name='tenkimcuongs[]']:checked").each(function ()
	{
		tenkimcuongs.push(parseInt($(this).val()));
	});
									
	if(fromdays == ''){
		alert('Vui lòng chọn từ ngày');
		return false;
	}
	else if(todays == ''){
		alert('Vui lòng chọn đến ngày');	
		return false;
	}
	else{
		var str = '';
		if(fromdays != '' && fromdays !== undefined)
			str = str + '&fromdays='+fromdays;
		if(todays != '' && todays !== undefined)
			str = str + '&todays='+todays;
		if(codes != '' && codes !== undefined)
			str = str + '&codes='+codes;
		if(nhomnguyenlieus != '' && nhomnguyenlieus !== undefined)
			str = str + '&nhomnguyenlieus='+nhomnguyenlieus;
		if(tennguyenlieus != '' && tennguyenlieus !== undefined)
			str = str + '&tennguyenlieus='+tennguyenlieus;
		if(tenkimcuongs != '')
			str = str + '&tenkimcuongs='+tenkimcuongs;
		$(location).attr('href', url+str);
		return false;
	}
}

function searchKhoKhacKhoTongDeCuc(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var codes = $('#codes').val();
	var loaivangs = $('#loaivangs').val();
	var idloaivang = $('#idloaivang').val();
	var trongluongvangs = $('#trongluongvangs').val();
	var tongtlvangsauchetacs = $('#tongtlvangsauchetacs').val();
	var tuoivangsauchetacs = $('#tuoivangsauchetacs').val();
	var hoichetacs = $('#hoichetacs').val();
	var ghichus = $('#ghichus').val();
	var madonhangsxs = $('#madonhangsxs').val();
	
	
	var str = '';
	if(fromdays != '' && fromdays !== undefined)
		str = str + '&fromdays='+fromdays;
	if(todays != '' && todays !== undefined)
		str = str + '&todays='+todays;
	if(codes != '' && codes !== undefined)
		str = str + '&codes='+codes;
	if(loaivangs != '' && loaivangs !== undefined)
		str = str + '&loaivangs='+loaivangs;
	if(idloaivang != '' && idloaivang > 0)
		str = str + '&idloaivang='+idloaivang;
	if(trongluongvangs != '' && trongluongvangs !== undefined)
		str = str + '&trongluongvangs='+trongluongvangs;	
	if(tongtlvangsauchetacs != '' && tongtlvangsauchetacs !== undefined)
		str = str + '&tongtlvangsauchetacs='+tongtlvangsauchetacs;
	if(tuoivangsauchetacs != '' && tuoivangsauchetacs !== undefined)
		str = str + '&tuoivangsauchetacs='+tuoivangsauchetacs;
	if(hoichetacs != '' && hoichetacs !== undefined)
		str = str + '&hoichetacs='+hoichetacs;
	if(ghichus != '' && ghichus !== undefined)
		str = str + '&ghichus='+ghichus;	
	if(madonhangsxs != '' && madonhangsxs !== undefined)
		str = str + '&madonhangsxs='+madonhangsxs;	
	$(location).attr('href', url+str);
	return false;

}

function searchKhoKhacKhoTongDeCucThongKe(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var codes = $('#codes').val();
	var nhomnguyenlieus = $('#nhomnguyenlieus').val();
	var tennguyenlieus = $('#tennguyenlieus').val();
	var loaivangs = $('#idloaivang').val();
	// var idloaivang = $('#idloaivang').val();
	var cannangvhs = $('#cannangvhs').val();
	var cannanghs = $('#cannanghs').val();
	var cannangvs = $('#cannangvs').val();
	var tienmats = $('#tienmats').val();
	var tuoivangs = $('#tuoivangs').val();
	var ghichus = $('#ghichus').val();
	var maphukiens = $('#maphukiens').val();
	
	var str = '';
	if(fromdays != '' && todays == ''){
		alert('Vui lòng chọn đến ngày');
		return false;
	}
	else if(fromdays == '' && todays != ''){
		alert('Vui lòng chọn từ ngày');	
		return false;
	}
	else{
		if(fromdays != '' && fromdays !== undefined)
			str = str + '&fromdays='+fromdays;
		if(todays != '' && todays !== undefined)
			str = str + '&todays='+todays;
		if(codes != '' && codes !== undefined)
			str = str + '&codes='+codes;
		if(nhomnguyenlieus != '' && nhomnguyenlieus !== undefined)
			str = str + '&nhomnguyenlieus='+nhomnguyenlieus;
		if(tennguyenlieus != '' && tennguyenlieus !== undefined)
			str = str + '&tennguyenlieus='+tennguyenlieus;
		if(loaivangs != '' && loaivangs !== undefined)
			str = str + '&loaivangs='+loaivangs;
		if(idloaivang != '' && idloaivang !== undefined)
			str = str + '&idloaivang='+idloaivang;
		if(cannangvhs != '' && cannangvhs !== undefined)
			str = str + '&cannangvhs='+cannangvhs;
		if(cannanghs != '' && cannanghs !== undefined)
			str = str + '&cannanghs='+cannanghs;
		if(cannangvs != '' && cannangvs !== undefined)
			str = str + '&cannangvs='+cannangvs;
		if(tuoivangs != '' && tuoivangs !== undefined)
			str = str + '&tuoivangs='+tuoivangs;
		if(tienmats != '' && tienmats !== undefined)
			str = str + '&tienmats='+tienmats;
		if(ghichus != '' && ghichus !== undefined)
			str = str + '&ghichus='+ghichus;
		if(maphukiens != '' && maphukiens !== undefined)
			str = str + '&maphukiens='+maphukiens;
		$(location).attr('href', url+str);
	}
	return false;
}

function searchKhoKhacKhoLamMoi(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var codes = $('#codes').val();
	var madonhangsxs = $('#madonhangsxs').val();
	var idloaivang = $('#idloaivang').val();
	var ghichus = $('#ghichus').val();
	
	var str = '';
	if(fromdays != '' && fromdays !== undefined)
		str = str + '&fromdays='+fromdays;
	if(todays != '' && todays !== undefined)
		str = str + '&todays='+todays;
	if(codes != '' && codes !== undefined)
		str = str + '&codes='+codes;
	if(madonhangsxs != '' && madonhangsxs !== undefined)
		str = str + '&madonhangsxs='+madonhangsxs;
	if(idloaivang != '' && idloaivang > 0)
		str = str + '&idloaivang='+idloaivang;
	if(ghichus != '' && ghichus !== undefined)
		str = str + '&ghichus='+ghichus;
	$(location).attr('href', url+str);
	return false;

}

function searchKhoSanXuatHaoDu(url){
	var fromdays = $('#fromdays').val();
	var todays = $('#todays').val();
	var codes = $('#codes').val();
	var daychungtus = $('#daychungtus').val();
	var loaivangs = $('#loaivangs').val();
	var idloaivang = $('#idloaivang').val();
	var haos = $('#haos').val();
	var dus = $('#dus').val();
	var ghichus = $('#ghichus').val();
	var maphukiens = $('#maphukiens').val();
	//====Vũ thêm=====//
	var idpnks = $('#idpnks').val();
	var str = '';
	//======Vũ thêm========//
	if(idpnks != '' && idpnks !== undefined)
       str = str + '&idpnks='+idpnks;
	//=============//
	if(fromdays != '' && fromdays !== undefined)
		str = str + '&fromdays='+fromdays;
	if(todays != '' && todays !== undefined)
		str = str + '&todays='+todays;
	if(codes != '' && codes !== undefined)
		str = str + '&codes='+codes;
	if(daychungtus != '' && daychungtus !== undefined)
		str = str + '&daychungtus='+daychungtus;
	if(loaivangs != '' && loaivangs !== undefined)
		str = str + '&loaivangs='+loaivangs;
	if(idloaivang != '' && idloaivang !== undefined)
		str = str + '&idloaivang='+idloaivang;
	if(haos != '' && haos !== undefined)
		str = str + '&haos='+haos;
	if(dus != '' && dus !== undefined)
		str = str + '&dus='+dus;
	if(ghichus != '' && ghichus !== undefined)
		str = str + '&ghichus='+ghichus;
	if(maphukiens != '' && maphukiens !== undefined)
		str = str + '&maphukiens='+maphukiens;
	$(location).attr('href', url+str);
	return false;
}
