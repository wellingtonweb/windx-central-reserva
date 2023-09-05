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
    $(document).ready(function () {
        /* Sidebar Menu JS */
        $(".sidebarNavigation .navbar-collapse").hide().clone().appendTo("body").removeAttr("class").addClass("sideMenu").show();
        $("body").append("<div class='overlay'></div>");
        $(".navbar-toggle, .navbar-toggler").on("click", function () {
            $(".sideMenu").addClass($(".sidebarNavigation").attr("data-sidebarClass"));
            $(".sideMenu, .overlay").toggleClass("open");
            $(".overlay").on("click", function () {
                $("div#collapseSidebar").removeClass('show')
                $(this).removeClass("open");
                $(".sideMenu").removeClass("open")
            })
            setTimeout(() => {
                // $("#linkCollapseSidebar").addClass('collapsed').attr('aria-expanded', false)
                $(".overlay").trigger('click')
                // alert('Funciona!')
            }, 6000);
        });
        $("body").on("click", ".sideMenu.open .nav-item", function () {
            if (!$(this).hasClass("dropdown")) {
                $(".sideMenu, .overlay").toggleClass("open")
            }else{
                $("div#collapseSidebar").removeClass('show')
            }
        });
        $(window).resize(function () {
            if ($(".navbar-toggler").is(":hidden")) {
                $("#collapseSidebar").removeClass('show')
                $("div#collapseSidebar").removeClass('show')
            } else {
                $(".sideMenu, .overlay").show()
            }
        })


    })

  })(jQuery);

$('.click-loader').click(function(event){
    // event.preventDefault(); //Essa linha vc coloca caso queira anular o evento do click da tag <a>;
    $('.loading').removeClass('d-none');
});

$(document).ready(function () {
    /* Loading Page */
    $('.loading').addClass('d-none');
});

function press(){
    $(this).addClass('scale-btn');
    setTimeout(() => {
        $(this).removeClass('scale-btn')
    }, 90)
};

$('a.nav-click').click(function (){
    $('.loading').removeClass('d-none');
});

$('#btn-logout').on('click', function() {
    $('#principal').addClass('animate__animated animate__zoomOut');
    $('#header').addClass('animate__animated animate__fadeOutUp');
    $('#footer').addClass('animate__animated animate__fadeOutDown');
});

$('#btn-contact').click(function (){
    $('#card-contact').removeClass('animate__bounceOutDown')
    $('#card-contact').addClass('animate__bounceInUp')
    $('#card-contact').removeClass('d-none')
    setTimeout(() => {
        // closeCard()
        $('#card-contact').addClass('animate__bounceOutDown')
        $('#card-contact').removeClass('animate__bounceInUp')
        setTimeout(() => {
            $('#card-contact').addClass('d-none')
        }, 1000);
    }, 10000);
})

$('#close-contact').click(function (){
    // closeCard()
    $('#card-contact').addClass('animate__bounceOutDown')
    $('#card-contact').removeClass('animate__bounceInUp')
    setTimeout(() => {
        $('#card-contact').addClass('d-none')
    }, 1000);
})
function closeCard(){
    //
}

