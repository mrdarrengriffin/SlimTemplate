$(document).ready(function(){
	$(".input-clear").click(function(){
		$(this).parent(".clear-control").children("input").val(null);
	});
});

