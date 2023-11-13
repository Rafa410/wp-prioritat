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
                infinite: false,
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

        /**
         * Handle ajax forms
         */
        const ajaxForms = document.querySelectorAll('.ajax-form');
        ajaxForms.forEach((form) => {
            const formSuccess = form.querySelector('.form-success');
            const formError = form.querySelector('.form-error');

            form.addEventListener('submit', (e) => {
                e.preventDefault();

                const formData = new FormData(form);
                const formAction = form.getAttribute('action');
                const formMethod = form.getAttribute('method');

                // Check if all required fields are filled
                const requiredFields = form.querySelectorAll('[required]');
                let allRequiredFieldsFilled = true;
                requiredFields.forEach((field) => {
                    if (!field.value) {
                        allRequiredFieldsFilled = false;
                        field.classList.add('error');
                        form.querySelector('.form-error').innerHTML = 'Please fill all required fields';
                    } else {
                        field.classList.remove('error');
                    }
                });

                if (!allRequiredFieldsFilled) {
                    return;
                }

                $.ajax({
                    type: formMethod,
                    url: formAction,
                    data: formData,
                    processData: false,
                    contentType: false,
                })
                    .done((response) => {
                        console.debug('RAW response', response);
                        response = JSON.parse(response);
                        console.log(response);
                        if (response.response?.code === 200) {
                            form.reset();
                            formError.innerHTML = '';
                            form.classList.add('success');
                            console.log(response.body);
                            formSuccess.innerHTML = response.body;

                            // Parse iCal file
                            var cal = ICAL.parse(response.body);
                            console.log(cal);

                            const tasksTable = generateTasksTable(cal);
                            console.log(tasksTable);
                        } else {
                            formSuccess.innerHTML = '';
                            form.classList.add('error');
                            formError.innerHTML =
                                response.response?.message ?? 'Something went wrong, please double check the form fields and try again.';
                        }
                    })
                    .fail((error) => {
                        console.debug('RAW error', error);
                        error = JSON.parse(error);
                        console.log(error);
                        form.classList.add('error');
                        formError.innerHTML =
                            error.error?.message ?? 'Something went wrong, please double check the form fields and try again.';
                        formSuccess.innerHTML = '';
                    });
            });

        });
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

    /**
     * 
     * @see https://github.com/kewisch/ical.js/wiki
     */
    const generateTasksTable = (cal) => {
        // // BEGIN:VCALENDAR
        // // VERSION:2.0
        // // CALSCALE:GREGORIAN
        // // PRODID:-//SabreDAV//SabreDAV//EN
        // // X-WR-CALNAME:Test
        // // X-APPLE-CALENDAR-COLOR:#F1DB50
        // // REFRESH-INTERVAL;VALUE=DURATION:PT4H
        // // X-PUBLISHED-TTL:PT4H
        // // BEGIN:VTODO
        // // UID:1ae4b616-42de-44e0-a643-26b447a0db00
        // // CREATED:20230504T130326
        // // LAST-MODIFIED:20230504T130503
        // // DTSTAMP:20230504T130503
        // // SUMMARY:Project 1
        // // STATUS:NEEDS-ACTION
        // // PRIORITY:1
        // // CATEGORIES:siurana
        // // DESCRIPTION:Lorem ipsum dolor sit amet
        // // DTSTART:20220504T140000
        // // DUE:20240504T140000
        // // END:VTODO
        // // BEGIN:VTODO
        // // UID:bfe1aaf4-9b5b-4bbc-a31a-843ebb50e465
        // // CREATED:20230504T130414
        // // LAST-MODIFIED:20230504T130505
        // // DTSTAMP:20230504T130505
        // // SUMMARY:Tasca 1.1
        // // RELATED-TO:1ae4b616-42de-44e0-a643-26b447a0db00
        // // STATUS:NEEDS-ACTION
        // // CATEGORIES:bug
        // // PRIORITY:6
        // // DTSTART:20230504T140000
        // // DUE:20230704T150000
        // // END:VTODO
        // // BEGIN:VTODO
        // // UID:62460ffa-e3ef-49ee-b22c-1d32e7651f92
        // // CREATED:20230504T130508
        // // LAST-MODIFIED:20230504T130549
        // // DTSTAMP:20230504T130549
        // // SUMMARY:Project 2
        // // CATEGORIES:montsant
        // // PERCENT-COMPLETE:100
        // // STATUS:COMPLETED
        // // PRIORITY:2
        // // COMPLETED:20230504T130537
        // // DTSTART:20220504T140000
        // // DUE:20230504T100000
        // // END:VTODO
        // // BEGIN:VTODO
        // // UID:45af594c-f3bc-44bc-9276-fbc0dc6f81cd
        // // CREATED:20230504T130529
        // // LAST-MODIFIED:20230504T130532
        // // DTSTAMP:20230504T130532
        // // SUMMARY:Tasca 2.1
        // // RELATED-TO:62460ffa-e3ef-49ee-b22c-1d32e7651f92
        // // STATUS:COMPLETED
        // // PERCENT-COMPLETE:100
        // // COMPLETED:20230504T130532
        // // END:VTODO
        // // END:VCALENDAR

        // // Example parsed cal:
        
        // 0: Array(3)
        // // 0: "vtodo"
        // // 1: Array(11)
        // // // 0: (4) ['uid', {…}, 'text', '1ae4b616-42de-44e0-a643-26b447a0db00']
        // // // 1: (4) ['created', {…}, 'date-time', '2023-05-04T13:03:26']
        // // // 2: (4) ['last-modified', {…}, 'date-time', '2023-05-04T13:05:03']
        // // // 3: (4) ['dtstamp', {…}, 'date-time', '2023-05-04T13:05:03']
        // // // 4: (4) ['summary', {…}, 'text', 'Project 1']
        // // // 5: (4) ['status', {…}, 'text', 'NEEDS-ACTION']
        // // // 6: (4) ['priority', {…}, 'integer', 1]
        // // // 7: (4) ['categories', {…}, 'text', 'siurana']
        // // // 8: (4) ['description', {…}, 'text', 'Lorem ipsum dolor sit amet']
        // // // 9: (4) ['dtstart', {…}, 'date-time', '2022-05-04T14:00:00']
        // // // 10: (4) ['due', {…}, 'date-time', '2024-05-04T14:00:00']
        // // 2: Array(0) []

        // 1: Array(3)
        // // 0: "vtodo"
        // // 1: Array(11)
        // // // 0: (4) ['uid', {…}, 'text', 'bfe1aaf4-9b5b-4bbc-a31a-843ebb50e465']
        // // // 1: (4) ['created', {…}, 'date-time', '2023-05-04T13:04:14']
        // // // 2: (4) ['last-modified', {…}, 'date-time', '2023-05-04T13:05:05']
        // // // 3: (4) ['dtstamp', {…}, 'date-time', '2023-05-04T13:05:05']
        // // // 4: (4) ['summary', {…}, 'text', 'Tasca 1.1']
        // // // 5: (4) ['related-to', {…}, 'text', '1ae4b616-42de-44e0-a643-26b447a0db00']
        // // // 6: (4) ['status', {…}, 'text', 'NEEDS-ACTION']
        // // // 7: (4) ['categories', {…}, 'text', 'bug']
        // // // 8: (4) ['priority', {…}, 'integer', 6]
        // // // 9: (4) ['dtstart', {…}, 'date-time', '2023-05-04T14:00:00']
        // // // 10: (4) ['due', {…}, 'date-time', '2023-07-04T15:00:00']            


    }
})(jQuery);
