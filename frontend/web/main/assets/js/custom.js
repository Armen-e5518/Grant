$(document).ready(function() {
	$("#show-left-slide").click(function() {
		if ($(".left-slide").hasClass("show-left-slide")) {
			$(".left-slide").removeClass("show-left-slide");
			$(".filter-bar").removeClass("keep-sliding-icons");
			$("#show-left-slide").css("left", "15px");
		}
		else {
			$(".left-slide").addClass("show-left-slide");
			$(".filter-bar").addClass("keep-sliding-icons");
			$("#show-left-slide").css("left", "248px");
		}
	});
	
	$("#show-right-slide").click(function() {
		if ($(".right-slide").hasClass("show-right-slide")) {
			$(".right-slide").removeClass("show-right-slide");
			$(".filter-bar").removeClass("keep-sliding-icons");
			$("#show-right-slide").css("right", "15px");
		}
		else {
			$(".right-slide").addClass("show-right-slide");
			$(".filter-bar").addClass("keep-sliding-icons");
			$("#show-right-slide").css("right", "422px");
		}
	});
});