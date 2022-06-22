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

        // Zoom images animation
        $('.zoom').on('click', function (event) {
            const $this = $(this);
            const $img = $this.children('img');

            $this.toggleClass('zooming');

            if ($this.hasClass('zooming')) {
                let scale = $this.data('scale') || 2;

                $img.css({
                    transform: `scale(${scale})`,
                    transformOrigin: `${event.offsetX}px ${event.offsetY}px`,
                });

                $this
                    .on('mouseover', function () {
                        $img.css({
                            transform: `scale(${scale})`,
                        });
                    })
                    .on('mouseout', function () {
                        $img.css({
                            transform: 'scale(1)',
                        });
                    })
                    .on('mousemove', function (e) {
                        $img.css({
                            transformOrigin: `${e.offsetX}px ${e.offsetY}px`,
                        });
                    });
            } else {
                $img.css({
                    transform: 'scale(1)',
                });
                $this.off('mouseover mouseout mousemove');
            }
        });
    }); // End document ready
})(jQuery);
