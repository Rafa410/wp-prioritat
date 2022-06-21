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
        // Pause audio/video/iframe when closing modal/accordion
        $('.modal, .accordion-collapse').on('hide.bs.modal hide.bs.collapse', function () {
            $(this)
                .find('audio, video, iframe')
                .each(function () {
                    if (this.tagName == 'IFRAME') {
                        this.contentWindow.postMessage(
                            '{"event":"command","func":"pauseVideo","args":""}',
                            '*'
                        );
                    } else {
                        this.pause();
                    }
                });
        });

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
