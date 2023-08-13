var result = ($(window).width() - $("#searchDonHang").offset().left) - 430;
if(result <= 0)
	result =  0;
$("#suggestionsDhsx").css("right", +result);