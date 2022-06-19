(function ($) {
    'use strict';

    // Media breakpoints
    const sm = 576;
    const md = 768;
    const lg = 992;
    const xl = 1200;
    const xxl = 1400;

    // Document ready
    $(function () {
        // Initialize Slick projects-carousel
        $('.projects-carousel').slick({
            dots: true,
            arrows: false,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: lg,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: md,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });
    }); // End document ready
})(jQuery);
