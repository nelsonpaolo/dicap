$(document).ready(function() {

	$('#panel a').mouseenter(efecto);

	$('#panel a').mouseleave(normal);

	function efecto() {
		$(this).animate({fontSize:'20px'}, "fast");
	}

	function normal() {
		$(this).animate({fontSize:'14px'}, "fast");
	}
});