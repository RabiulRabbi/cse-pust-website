$('.carousel').carousel();

$(document).ready(function() {
    var carouselContainer = $('.carousel');
    var slideInterval = 2500;

    $('#carousel').carousel({
        interval: slideInterval
    });

    var clickEvent = false;
    $('#carousel').on('click', '.nav-carousel a', function() {
        clickEvent = true;
        $('.nav-carousel li').removeClass('active');
        $(this).parent().addClass('active');
    }).on('slid.bs.carousel', function(e) {
        if (!clickEvent) {
            var count = $('.nav-carousel').children().length - 1;
            var current = $('.nav-carousel li.active');
            current.removeClass('active').next().addClass('active');
            var id = parseInt(current.data('slide-to'));
            if (count == id) {
                $('.nav-carousel li').first().addClass('active');
            }
        }
        clickEvent = false;
    });

    function toggleCaption() {
        $('.carousel-caption').hide();
        var caption = carouselContainer.find('.active').find('.carousel-caption');
        caption.delay(500).toggle("slide", { direction: "right" }).animate({ duration: "fast", easing: "linear" });
    }

    carouselContainer.carousel({
        interval: slideInterval,
        cycle: true,
        pause: "hover"
    }).on('slid.bs.carousel', function() {
        toggleCaption();
    });
});

/* highlight the top nav as scrolling occurs */
$('body').scrollspy({ target: '#nav' })

$(document).ready(function() {
    var bodyHeight = $("body").height();
    var vwptHeight = $(window).height();
    if (vwptHeight > bodyHeight) {
        $("footer#footer").css("position", "absolute").css("bottom", 0);
    }
});

/* smooth scrolling for scroll to top */
$('.scroll-top').click(function() {
    $('body,html').animate({ scrollTop: 0 }, 1000);
})

// Dropdown Menu Fade    
jQuery(document).ready(function() {
    $(".dropdown").hover(
        function() {
            $('.dropdown-menu', this).fadeIn("fast");
        },
        function() {
            $('.dropdown-menu', this).fadeOut("fast");
        });
});

// Dropdown Menu Fade    
jQuery(document).ready(function() {
    $(".dropdown").hover(
        function() {
            $('.dropdown-menu', this).stop().fadeIn("fast");
        },
        function() {
            $('.dropdown-menu', this).stop().fadeOut("fast");
        });
});

/* affix the Carousel Buttons to Carousel Item on scroll */
$('.nav-carousel').bind({
    offset: {
        top: $('#carousel').height() - $('.nav-carousel').height()
    }
});

/* Popover Declaration */
$('[data-toggle="popover"]').popover();

$('body').click(function(e) {
    //only buttons
    if ($(e.target).data('toggle') !== 'popover' &&
        $(e.target).parents('.popover.in').length === 0) {
        $('[data-toggle="popover"]').popover('hide');
    }

    //buttons and icons within buttons
    /*
    if ($(e.target).data('toggle') !== 'popover'
    && $(e.target).parents('[data-toggle="popover"]').length === 0
    && $(e.target).parents('.popover.in').length === 0)
    {
    	$('[data-toggle="popover"]').popover('hide');
    }
    */
});

//Easing Scroll replace Anchor name in URL and Offset Position
$(function() {
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 60
                }, 1000);
                return false;
            }
        }
    });
});

//Tabs Tooltip function
$(function() {
    $('a[title]').tooltip();
});

//chat

function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}