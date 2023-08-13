/*
* Author:      Marco Kuiper (http://www.marcofolio.net/)
*/
google.setOnLoadCallback(function()
{
	// Safely inject CSS3 and give the search results a shadow
	var cssObj = { 'box-shadow' : '#888 0px', // Added when CSS3 is standard
		'-webkit-box-shadow' : '#888 0px', // Safari
		'-moz-box-shadow' : '#888 0px'}; // Firefox 3.5+
	$("#suggestions").css(cssObj);
	$("#suggestionsDhsx").css(cssObj);
	
	// Fade out the suggestions box when not active
	 $("input").blur(function(){
	 	$('#suggestions').fadeOut();
		$('#suggestionsDhsx').fadeOut();
		//====Vũ thêm 28-11-19=======//
		$('.suggestionsKKLM').fadeOut();
	 });
	 
});

function lookup(path_url,act,inputString) {
	if(inputString.length == 0) {
		$('#suggestions').fadeOut(); // Hide the suggestions box
	} else {
		$.post(path_url + "/ajax/rpc.php", {queryString: ""+inputString+"",act:""+act+"" }, function(data) { // Do an AJAX call
			$('#suggestions').fadeIn(); // Show the suggestions box
			$('#suggestions').html(data); // Fill the suggestions box
		});
	}
}

function lookupChinhSuaSoLieu(path_url,act,table,inputString) {
	if(inputString.length == 0) {
		$('#suggestions').fadeOut(); // Hide the suggestions box
	} else {
		$.post(path_url + "/ajax/rpc.php", {queryString: ""+inputString+"",table:""+table+"",act:""+act+"" }, function(data) { // Do an AJAX call
			$('#suggestions').fadeIn(); // Show the suggestions box
			// alert(data);
			$('#suggestions').html(data); // Fill the suggestions box
		});
	}
}

function lookupKhoSanXuatLoadMaDonHangCatalog(path_url,act,cid,inputString) {
	if(inputString.length == 0) {
		$('#suggestionsDhsx').fadeOut(); // Hide the suggestions box
	} else {
		$.post(path_url + "/ajax/rpc.php", {queryString: ""+inputString+"",act:""+act+"",cid:""+cid+"" }, function(data) { // Do an AJAX call
			$('#suggestionsDhsx').fadeIn(); // Show the suggestions box
			$('#suggestionsDhsx').html(data); // Fill the suggestions box
		});
	}
}

/// M.Tân thêm ngày 22/07/2019
function lookupmavattu(inputString,numdong,path_url) {
	if(inputString.length == 0) {
		$('#suggestions').fadeOut(); // Hide the suggestions box
	} else {
		$.post(path_url + "/ajax/popupLoadmavattu.php", {queryString: ""+inputString+"", numdong: ""+numdong+""}, function(data) { // Do an AJAX call
			$('#loadingAjax').show();																											  
			$('#suggestions').fadeIn(); // Show the suggestions box
			$('#suggestions').html(data); // Fill the suggestions box
			$('#loadingAjax').hide();
		});
	}
}

