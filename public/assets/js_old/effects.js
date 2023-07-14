(function($) { "use strict";

	$(function() {
		var header = $(".start-style");
		$(window).scroll(function() {
			var scroll = $(window).scrollTop();

			if (scroll >= 10) {
				header.removeClass('start-style').addClass("scroll-on");
			} else {
				header.removeClass("scroll-on").addClass('start-style bg-transparent');
			}
		});
	});

	//Menu On Hover
	$('body').on('mouseenter mouseleave','.nav-item',function(e){
			if ($(window).width() > 750) {
				var _d=$(e.target).closest('.nav-item');_d.addClass('show');
				setTimeout(function(){
				_d[_d.is(':hover')?'addClass':'removeClass']('show');
				},1);
			}
	});
  })(jQuery);

$('.click-loader').click(function(event){
    // event.preventDefault(); //Essa linha vc coloca caso queira anular o evento do click da tag <a>;
    $('.loading').removeClass('d-none');
});

$('.btn-flip').on('click', function() {
    $('.card-login').addClass('is-flipped');
    timeOutLogin()
    setTimeout(function () {
        $('.card-login').removeClass('is-flipped');
    }, 60000);
});

$('.btn-load').on('click', function() {
    $('.logo-windx').addClass('animate__animated animate__fadeOutUp');
    $('#footer').addClass('animate__animated animate__fadeOutDown');
    $('.card-logon').addClass('animate__animated animate__flipOutX');
    $('.loader').removeClass('d-none');
});

$('a.nav-click').click(function (){
    $('.loading').removeClass('d-none');
});

$('#btn-logout').on('click', function() {
    $('#principal').addClass('animate__animated animate__zoomOut');
    $('#header').addClass('animate__animated animate__fadeOutUp');
    $('#footer').addClass('animate__animated animate__fadeOutDown');
});



