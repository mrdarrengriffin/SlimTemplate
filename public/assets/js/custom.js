$(document).ready(function(){
	$(".input-clear").click(function(){
		$(this).parent(".clear-control").children("input").val(null);
	});
	parseCharCounts();
});

function parseCharCounts(){
	$(".char-count").each(function(){
	$(this).children('input').after("<span class='help-block char-count-text'><span class='chars-remaining'>"+$(this).data('limit')+"</span> characters remaining</span>");
});
$(".char-count").on('input',function(){
	var input = $(this).children('input');
	$(input).attr('maxlength', $(this).data('limit'));
	$(this).children('span.char-count-text').children('.chars-remaining').html($(this).data('limit') - $(input).val().length);
});
}
