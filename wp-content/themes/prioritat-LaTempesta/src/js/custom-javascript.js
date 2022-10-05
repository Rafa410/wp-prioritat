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
         * Ajax search for blog posts, news and events
         */
        const $searchform = $(
            '.searchform-post, .searchform-noticies, .searchform-agenda_events'
        ).children('.search-form');
        const $postsList = $('.post-list, .post-noticies-list, .post-agenda_events-list');

        $searchform.on('submit', function (event) {
            event.preventDefault();
            ajaxSearch($(this).serialize(), $postsList);
        });

        // Reset search results when empty searchform for more than 1 second
        let typingTimer;
        $searchform.on('input', '.search-field', function (event) {
            clearTimeout(typingTimer);
            const s = event.currentTarget.value;
            if (s === '') {
                typingTimer = setTimeout(() => {
                    ajaxSearch($searchform.serialize(), $postsList);
                }, 750);
            }
        });
    }); // End document ready

    /**
     * Ajax Search
     *
     * @param {string} data The serialized search form data
     * @param {object} $postsList The jQuery object of the posts list
     *
     */
    function ajaxSearch(data, $postsList) {
        const $loadingIcon = $('.loading-icon');
        const $searchIcon = $('.search-icon');

        $.ajax({
            method: 'GET',
            url: ajaxUrl,
            data: `action=prt_search&${data}`,
            beforeSend: function () {
                $searchIcon.fadeOut('fast');
                $loadingIcon.fadeIn();
            },
        })
            .done(function (data) {
                // Show results
                $postsList.html(data);

                // TODO: Pass filters to search query
                // // Filter results
                // const filterId = $('.category-filters > button, .resource-filters > button')
                //     .filter('.active')
                //     .attr('data-category');
                // if (filterId) {
                //     $('article').each(function () {
                //         filterPosts($(this), filterId);
                //     });
                // }

                // TODO: Pass sort by to search query
                // // Sort results
                // const sortBy = $('#sortBy').val();
                // if (sortBy) {
                //     $postsList
                //         .children('.post, .resource')
                //         .sort(compareFn[sortBy])
                //         .appendTo($postsList);
                // }

                // Scroll to results
                window.location.hash = 'resultats-cerca';

                // Remove input focus
                $('.searchform-post, .searchform-noticies, .searchform-agenda_events')
                    .find('.search-field')
                    .blur();
            })
            .fail(function () {
                console.error('Search failed, please try again later');
            })
            .always(function () {
                $searchIcon.fadeIn();
                $loadingIcon.fadeOut('fast');

                // TODO: Hide pagination when search query is not ''
            });
    }
})(jQuery);
