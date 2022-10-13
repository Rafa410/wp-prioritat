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
        // Initialize wow.js
        const wow = new WOW({
            animateClass: 'animate__animated',
        });
        wow.init();

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
        if ($('.projects-carousel').length) {
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
        }

        // Initialize Slick facts-carousel
        if ($('.facts-carousel').length) {
            $('.facts-carousel').slick({
                dots: true,
                arrows: false,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
            });
        }

        // Initialize Slick partners carousel
        if ($('.socis-list').length) {
            $('.socis-list').slick({
                arrows: false,
                infinite: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                asNavFor: '.socis-list__nav',
            });
        }
        if ($('.socis-list__nav').length) {
            $('.socis-list__nav').slick({
                arrows: true,
                infinite: false,
                slidesToShow: 6,
                slidesToScroll: 1,
                swipeToSlide: true,
                focusOnSelect: true,
                mobileFirst: true,
                asNavFor: '.socis-list',
                responsive: [
                    {
                        breakpoint: lg,
                        settings: {
                            slidesToShow: 8,
                        },
                    },
                    {
                        breakpoint: xl,
                        settings: {
                            slidesToShow: 10,
                        },
                    },
                ],
            });
        }

        // Initialize Twitter feed carousel
        if ($('.ctf-tweets').length) {
            $('.ctf-tweets').slick({
                dots: true,
                arrows: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                adaptiveHeight: true,
                infinite: false,
                responsive: [
                    {
                        breakpoint: xxl,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
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
        }

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

        const timelineTracker = document.getElementById('timeline-tracker');
        if (timelineTracker) {
            gsap.registerPlugin(ScrollTrigger);

            // Track timeline progress
            ScrollTrigger.create({
                trigger: '#timeline',
                start: 'top center',
                end: 'bottom center',
                onUpdate: (self) => {
                    gsap.to(timelineTracker, {
                        height: () => `${self.progress * 100}%`,
                    });
                },
            });

            gsap.utils.toArray('#timeline .event-year').forEach((year) => {
                ScrollTrigger.create({
                    trigger: year,
                    start: 'center center',
                    onEnter: (self) => {
                        year.classList.add('passed');
                    },
                    onLeaveBack: (self) => {
                        year.classList.remove('passed');
                    },
                });
            });
        }

        /**
         * Load more CPT 'mitjans' with ajax button
         */
        let currentMitjansPage = 1;
        $('#load-more-mitjans').on('click', () => {
            currentMitjansPage++; // Do currentPage + 1, because we want to load the next page
            loadMoreMitjans(currentMitjansPage);
        });

        /**
         * Track mailchimp embedded signup form submissions
         */
        const mce_form = document.getElementById('mc-embedded-subscribe-form');
        const mce_successElement = document.getElementById('mce-success-response');

        if (mce_form && mce_successElement) {
            const mce_successEvent = new Event('mceSuccess');
            const mutationConfig = { attributes: true };

            const callback = function (mutationsList, observer) {
                for (const mutation of mutationsList) {
                    if (
                        mutation.type === 'attributes' &&
                        mutation.attributeName == 'style' &&
                        mce_successElement.style.display === ''
                    ) {
                        mce_form.dispatchEvent(mce_successEvent);
                    }
                }
            };

            const observer = new MutationObserver(callback);
            observer.observe(mce_successElement, mutationConfig);
        }

        /**
         * Hide mailchimp embedded signup form after successfull submission
         */
        if (mce_form) {
            mce_form.addEventListener('mceSuccess', () => {
                $('#mce-content').slideUp();
            });
        }
    }); // End document ready

    const loadMoreMitjans = (page) => {
        $.ajax({
            type: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            data: {
                action: 'load_more_mitjans',
                paged: page,
            },
        }).done((res) => {
            if (page >= res.max) {
                $('#load-more-mitjans').fadeOut();
            }
            const $html = $(res.html);
            $('.mitjans-list').append($html).masonry('appended', $html);
        });
    };
})(jQuery);
