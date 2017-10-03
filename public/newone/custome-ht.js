$(window).on('load', function() {
		$(".notes-area").each(function() {
				$(this).focus(function(){
				$(this).next(".btn-col").css('display', 'block');
			});
		});
});