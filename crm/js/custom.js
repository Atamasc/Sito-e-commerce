/*

Template:  Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template
Author: potenzaglobalsolutions.com
Design and Developed by: potenzaglobalsolutions.com

NOTE: This file contains all scripts for the actual Template.

*/

/*================================================
[  Table of contents  ]
================================================

:: Predefined Variables
:: Tooltip
:: Preloader
:: PHP Contact Form
:: Counter
:: Back to top
:: NiceScroll
:: Mailchimp
:: PieChart
:: DataTable
:: Wow animation on scroll
:: Select
:: Accordion
:: Search
:: Sidebarnav
:: Fullscreenwindow
:: Today date and time
:: Summernote
:: Colorpicker
:: Touchspin
:: Editormarkdown
:: Rating
:: Calendar List View
:: Repeater form
:: Wizard form

======================================
[ End table content ]
======================================*/
//POTENZA var

(function ($) {
    "use strict";
    var POTENZA = {};

    /*************************
     Predefined Variables
     *************************/
    var $window = $(window),
        $document = $(document),
        $body = $('body'),
        $countdownTimer = $('.countdown'),
        $bar = $('.bar'),
        $pieChart = $('.round-chart'),
        $counter = $('.counter'),
        $datetp = $('.datetimepicker');
    //Check if function exists
    $.fn.exists = function () {
        return this.length > 0;
    };

    /*************************
     Tooltip
     *************************/
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    /*************************
     Preloader
     *************************/
    POTENZA.preloader = function () {

        $("#load").fadeOut();
        $('#pre-loader').delay(0).fadeOut('slow');

    };


    /*************************
     counter
     *************************/
    POTENZA.counters = function () {
        var counter = jQuery(".counter");
        if (counter.length > 0) {
            loadScript(plugin_path + 'counter/jquery.countTo.js', function () {
                $counter.each(function () {
                    var $elem = $(this);
                    $elem.appear(function () {
                        $elem.find('.timer').countTo();
                    });
                });
            });
        }
    };

    /*************************
     Back to top
     *************************/
    POTENZA.goToTop = function () {
        var $goToTop = $('#back-to-top');
        $goToTop.hide();
        $window.scroll(function () {
            if ($window.scrollTop() > 100) $goToTop.fadeIn();
            else $goToTop.fadeOut();
        });
        $goToTop.on("click", function () {
            $('body,html').animate({scrollTop: 0}, 1000);
            return false;
        });
    }

    /*************************
     NiceScroll
     *************************/
    POTENZA.pniceScroll = function () {
        loadScript(plugin_path + 'nicescroll/jquery.nicescroll.js', function () {
            $(".scrollbar").niceScroll({
                scrollspeed: 150,
                mousescrollstep: 38,
                cursorwidth: 5,
                cursorborder: 0,
                cursorcolor: 'rgba(0,0,0,0.1)',
                autohidemode: true,
                zindex: 9,
                horizrailenabled: false,
                cursorborderradius: 0,
            });

            // menu scrollbar
            $('.side-menu .collapse').on('shown.bs.collapse', function () {
                $(".side-menu-fixed .scrollbar").getNiceScroll().resize();
            });


            $(".scrollbar-x").niceScroll({
                scrollspeed: 150,
                mousescrollstep: 38,
                cursorwidth: 5,
                cursorborder: 0,
                cursorcolor: 'rgba(0,0,0,0.1)',
                autohidemode: true,
                zindex: 9,
                verticalenabled: false,
                cursorborderradius: 0,
            });
        });
    }

    /*************************
     mailchimp
     *************************/
    POTENZA.mailchimp = function () {
        $(document).on('click', '#mc-embedded-subscribe', function (event) {
            event.preventDefault();
            var email_id = $('#mce-EMAIL').val();
            var val_email_id = validateEmail(email_id);
            if (email_id != "" && val_email_id === true) {
                var failure_message = 'Whoops, looks like there was a problem. Please try again later.';
                var memberid = email_id.toLowerCase();
                var url = memberid;

                $.ajax({
                    type: 'POST',
                    url: 'php/mailchimp-action.php',
                    data: {url: url},
                    dataType: 'json',
                    success: function (data) {
                        $('#msg').html(data);
                    },
                });
            } else {
                $('#msg').html('<p style="color: #EA4335">Enter the E-mail id</p>');
                return false;
            }
            return false;
        });

        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    }

    /****************************************************
     pieChart
     ****************************************************/
    POTENZA.pieChart = function () {
        if ($pieChart.exists()) {
            loadScript(plugin_path + 'easy-pie-chart/easy-pie-chart.js', function () {
                $pieChart.each(function () {
                    var $elem = $(this),
                        pieChartSize = $elem.attr('data-size') || "160",
                        pieChartAnimate = $elem.attr('data-animate') || "2000",
                        pieChartWidth = $elem.attr('data-width') || "6",
                        pieChartColor = $elem.attr('data-color') || "#84ba3f",
                        pieChartTrackColor = $elem.attr('data-trackcolor') || "rgba(0,0,0,0.10)";
                    $elem.find('span, i').css({
                        'width': pieChartSize + 'px',
                        'height': pieChartSize + 'px',
                        'line-height': pieChartSize + 'px'
                    });
                    $elem.appear(function () {
                        $elem.easyPieChart({
                            size: Number(pieChartSize),
                            animate: Number(pieChartAnimate),
                            trackColor: pieChartTrackColor,
                            lineWidth: Number(pieChartWidth),
                            barColor: pieChartColor,
                            scaleColor: false,
                            lineCap: 'square',
                            onStep: function (from, to, percent) {
                                $elem.find('span.percent').text(Math.round(percent));
                            }
                        });
                    });
                });
            });
        }
    }


    /*************************
     DataTable
     *************************/
    POTENZA.datatables = function () {
        if ($('#datatable').exists()) {
            loadScript(plugin_path + 'bootstrap-datatables/jquery.dataTables.min.js', function () {
                loadScript(plugin_path + 'bootstrap-datatables/dataTables.bootstrap4.min.js', function () {
                    $('#datatable').DataTable();
                });
            });
        }
    };

    /*********************************
     Wow animation on scroll
     *********************************/
    POTENZA.wowanimation = function () {
        if ($('.wow').exists()) {
            var wow = new WOW({
                animateClass: 'animated',
                offset: 100,
                mobile: false
            });
            wow.init();
        }
    }


    /*************************
     select
     *************************/
    POTENZA.fancyselect = function () {
        if ($('.fancyselect').exists()) {
            loadScript(plugin_path + 'jquery-nice-select/jquery-nice-select.js', function () {
                $('select.fancyselect:not(.ignore)').niceSelect();
            });
        }
    };

    /*************************
     Accordion
     *************************/
    POTENZA.accordion = function () {

        $('.accordion').each(function (i, elem) {
            var $elem = $(this),
                $acpanel = $elem.find(".acd-group > .acd-des"),
                $acsnav = $elem.find(".acd-group > .acd-heading");
            $acpanel.hide().first().slideDown("easeOutExpo");
            $acsnav.first().parent().addClass("acd-active");
            $acsnav.on('click', function () {
                if (!$(this).parent().hasClass("acd-active")) {
                    var $this = $(this).next(".acd-des");
                    $acsnav.parent().removeClass("acd-active");
                    $(this).parent().addClass("acd-active");
                    $acpanel.not($this).slideUp("easeInExpo");
                    $(this).next().slideDown("easeOutExpo");
                } else {
                    $(this).parent().removeClass("acd-active");
                    $(this).next().slideUp("easeInExpo");
                }
                return false;
            });
        });
    }

    /*************************
     Search
     *************************/
    POTENZA.searchbox = function () {
        if (jQuery('.search').exists()) {
            jQuery('.search-btn').on("click", function () {
                jQuery('.search').toggleClass("search-open");
                return false;
            });
            jQuery("html, body").on('click', function (e) {
                if (!jQuery(e.target).hasClass("not-click")) {

                    jQuery('.search').removeClass("search-open");
                }
            });
        }
    };

    /*************************
     Sidebarnav
     *************************/
    POTENZA.Sidebarnav = function () {
        /*Sidebar Navigation*/
        $(document).on('click', '#button-toggle', function (e) {
            $(".dropdown.open > .dropdown-toggle").dropdown("toggle");
            return false;
        });
        $(document).on('click', '#button-toggle', function (e) {
            $('.wrapper').toggleClass('slide-menu');
            return false;
        });

        $(document).on("mouseenter mouseleave", ".wrapper > .side-menu-fixed", function (e) {
            if (e.type == "mouseenter") {
                $wrapper.addClass("sidebar-hover");
            } else {
                $wrapper.removeClass("sidebar-hover");
            }
            return false;
        });
        $(document).on("mouseenter mouseleave", ".wrapper > .side-menu-fixed", function (e) {
            if (e.type == "mouseenter") {
                $wrapper.addClass("sidebar-hover");
            } else {
                $wrapper.removeClass("sidebar-hover");
            }
            return false;
        });

        $(document).on("mouseenter mouseleave", ".wrapper > .setting-panel", function (e) {
            if (e.type == "mouseenter") {
                $wrapper.addClass("no-transition");
            } else {
                $wrapper.removeClass("no-transition");
            }
            return false;
        });
    };

    /*************************
     Fullscreenwindow
     *************************/

    POTENZA.Fullscreenwindow = function () {
        if ($('#btnFullscreen').exists()) {
            function toggleFullscreen(elem) {
                elem = elem || document.documentElement;
                if (!document.fullscreenElement && !document.mozFullScreenElement &&
                    !document.webkitFullscreenElement && !document.msFullscreenElement) {
                    if (elem.requestFullscreen) {
                        elem.requestFullscreen();
                    } else if (elem.msRequestFullscreen) {
                        elem.msRequestFullscreen();
                    } else if (elem.mozRequestFullScreen) {
                        elem.mozRequestFullScreen();
                    } else if (elem.webkitRequestFullscreen) {
                        elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                    }
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    }
                }
            }

            document.getElementById('btnFullscreen').addEventListener('click', function () {
                toggleFullscreen();
            });
        }
    };

    /*************************
     Today date and time
     *************************/

    POTENZA.todatdayandtime = function () {
        var d = new Date();
        var weekday = new Array(7);
        weekday[0] = "Sunday";
        weekday[1] = "Monday";
        weekday[2] = "Tuesday";
        weekday[3] = "Wednesday";
        weekday[4] = "Thursday";
        weekday[5] = "Friday";
        weekday[6] = "Saturday";
        var n = weekday[d.getDay()];
        $('.today-day').html(n);
        var n = new Date();
        var y = n.getFullYear();
        var m = n.getMonth() + 1;
        var d = n.getDate();
        $('.today-date').html(m + " / " + d + " / " + y);
    };

    /*************************
     Summernote
     *************************/

    POTENZA.summernoteeditor = function () {
        if ($('#summernote').exists()) {
            $('#summernote').summernote({
                height: 300,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                //focus: true                  // set focus to editable area after initializing summernote
            });
        }
    };

    /*************************
     Colorpicker
     *************************/

    POTENZA.colorpicker = function () {
        if ($('#cp1, #cp2, #cp3, #cp4, #cp5, #cp6, #cp17, #cp8, #cp9, #cp10, #cp11, #cp12, #cp13').exists()) {
            $('#cp1').colorpicker();
            $('#cp2, #cp3a, #cp3b').colorpicker();
            $('#cp4').colorpicker({"color": "#16813D"});
            $('#cp5').colorpicker({format: null});
            $('#cp5b').colorpicker({format: "rgba"});
            $('#cp6').colorpicker({horizontal: true});
            $('#cp7').colorpicker({
                color: '#DD0F20',
                inline: true,
                container: true
            });
            $('#cp8').colorpicker({
                color: '#F18A31',
                inline: true,
                container: '#cp8_container'
            });
            $('#cp9').colorpicker({
                useAlpha: false
            });
            $('#cp10').colorpicker({
                useHashPrefix: false
            });
            $('#cp11').colorpicker({
                fallbackColor: 'rgb(48, 90, 162)'
            });
            $('#cp12').colorpicker();
            $('#cp13').colorpicker({
                autoInputFallback: false
            });
        }
    };

    /*************************
     Touchspin
     *************************/

    POTENZA.ptTouchSpin = function () {
        if ($('input.touchspin-input').exists()) {
            $("input[name='demo1'].touchspin-input").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%'
            });
            $("input[name='demo2'].touchspin-input").TouchSpin({
                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '$'
            });
            $("input[name='demo_vertical'].touchspin-input").TouchSpin({
                verticalbuttons: true
            });

            $("input[name='demo_vertical2'].touchspin-input").TouchSpin({
                verticalbuttons: true,
                verticalupclass: 'fa fa-plus',
                verticaldownclass: 'fa fa-minus'
            });
            $("input.touchspin-input").TouchSpin();
            $("input[name='demo3_21'].touchspin-input,input[name='demo3_22'].touchspin-input").TouchSpin({
                initval: 40
            });
            $("input[name='demo4'].touchspin-input").TouchSpin({
                postfix: "a button",
                postfix_extraclass: "btn btn-default"
            });
            $("input[name='demo4_2'].touchspin-input").TouchSpin({
                postfix: "a button",
                postfix_extraclass: "btn btn-default"
            });
        }
    };

    /*************************
     Editormarkdown
     *************************/

    POTENZA.editormarkdown = function () {
        if ($('#editor-markdown-01, #editor-markdown-02, #editor-markdown-03').exists()) {
            new SimpleMDE({
                element: document.getElementById("editor-markdown-01"),
                spellChecker: false,
            });

            new SimpleMDE({
                element: document.getElementById("editor-markdown-02"),
                spellChecker: false,
                autosave: {
                    enabled: true,
                    unique_id: "editor-markdown-02",
                },
            });

            new SimpleMDE({
                element: document.getElementById("editor-markdown-03"),
                status: false,
                toolbar: false,
            });
        }
    };

    /*************************
     Rating
     *************************/

    POTENZA.ptrating = function () {
        $('#default').raty({
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-warning'
        });
        $('#score').raty({
            score: 3,
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-danger'
        });
        $('#score-callback').raty({
            score: function () {
                return $(this).attr('data-score');
            }
        });
        $('#scoreName').raty({
            scoreName: 'entity[score]',
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-warning'
        });
        $('#number').raty({
            number: 10,
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-danger'
        });
        $('#number-callback').raty({
            number: function () {
                return $(this).attr('data-number');
            }
        });
        $('#numberMax').raty({
            numberMax: 5,
            number: 100,
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-purple'
        });
        $('#readOnly').raty({
            readOnly: true,
            score: 3,
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-success'
        });
        $('#readOnly-callback').raty({
            readOnly: function () {
                return 'true becomes readOnly' == 'true becomes readOnly';
            }
        });
        $('#noRatedMsg').raty({
            readOnly: true,
            noRatedMsg: "I'am readOnly and I haven't rated yet!",
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-danger'
        });
        $('#halfShow-true').raty({
            score: 3.26
        });
        $('#halfShow-false').raty({
            halfShow: false,
            score: 3.26,
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-danger'
        });
        $('#round').raty({
            round: {down: .26, full: .6, up: .76},
            score: 3.26,
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-pink'
        });
        $('#half').raty({
            half: true
        });
        $('#starHalf').raty({
            half: true,
            starHalf: 'fa fa-star-half text-danger',
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-danger'
        });
        $('#click').raty({
            click: function (score, evt) {
                alert('ID: ' + $(this).attr('id') + "\nscore: " + score + "\nevent: " + evt.type);
            }
        });
        $('#hints').raty({hints: ['a', null, '', undefined, '*_*']});
        $('#star-off-and-star-on').raty({
            starOff: 'fa fa-bell-o text-muted',
            starOn: 'fa fa-bell text-custom'
        });
        $('#cancel').raty({
            cancel: true,
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-danger'
        });
        $('#cancelHint').raty({
            cancel: true,
            cancelHint: 'My cancel hint!',
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-success'
        });
        $('#cancelPlace').raty({
            cancel: true,
            cancelPlace: 'right',
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-purple'
        });
        $('#cancel-off-and-cancel-on').raty({
            cancel: true,
            cancelOff: 'fa fa-minus-square-o text-muted',
            cancelOn: 'fa fa-minus-square text-danger'
        });
        $('#iconRange').raty({
            iconRange: [
                {range: 1, on: 'fa fa-cloud', off: 'fa fa-circle-o'},
                {range: 2, on: 'fa fa-cloud-download', off: 'fa fa-circle-o'},
                {range: 3, on: 'fa fa-cloud-upload', off: 'fa fa-circle-o'},
                {range: 4, on: 'fa fa-circle', off: 'fa fa-circle-o'},
                {range: 5, on: 'fa fa-cogs', off: 'fa fa-circle-o'}
            ]
        });
        $('#size-md').raty({
            cancel: true,
            half: true
        });
        $('#size-lg').raty({
            cancel: true,
            half: true
        });
        $('#target-div').raty({
            cancel: true,
            target: '#target-div-hint',
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-custom'
        });
        $('#targetType').raty({
            cancel: true,
            target: '#targetType-hint',
            targetType: 'score',
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-warning'
        });
        $('#targetFormat').raty({
            target: '#targetFormat-hint',
            targetFormat: 'Rating: {score}',
            starOff: 'fa fa-star-o text-muted',
            starOn: 'fa fa-star text-danger'
        });
        $('#mouseover').raty({
            mouseover: function (score, evt) {
                alert('ID: ' + $(this).attr('id') + "\nscore: " + score + "\nevent: " + evt.type);
            }
        });
        $('#mouseout').raty({
            width: 150,
            mouseout: function (score, evt) {
                alert('ID: ' + $(this).attr('id') + "\nscore: " + score + "\nevent: " + evt.type);
            }
        });
    };


    /*************************
     Calendar List View
     *************************/

    POTENZA.calendarlist = function () {
        if ($('#calendar-list').exists()) {
            $('#calendar-list').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'listDay,listWeek,month'
                },
                // customize the button names,
                // otherwise they'd all just say "list"
                views: {
                    listDay: {buttonText: 'list day'},
                    listWeek: {buttonText: 'list week'}
                },

                defaultView: 'listWeek',
                defaultDate: '2018-03-12',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    {
                        title: 'All Day Event',
                        start: '2018-03-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2018-03-07',
                        end: '2018-03-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2018-03-09T16:00:00'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2018-03-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2018-03-11',
                        end: '2018-03-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2018-03-12T10:30:00',
                        end: '2018-03-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2018-03-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2018-03-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2018-03-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2018-03-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2018-03-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2018-03-28'
                    }
                ]
            });
        }
    };

    /*************************
     repeater form
     *************************/

    POTENZA.repeaterform = function () {
        if ($('.repeater, .repeater-file, .repeater-add').exists()) {
            $('.repeater, .repeater-file, .repeater-add').repeater({
                show: function () {
                    $(this).slideDown();
                    $(this).find('select').niceSelect();
                }
            });
        }
    };

    /*************************
     wizard form
     *************************/

    POTENZA.wizardform = function () {
        if ($('#example-form, #example-basic, #example-manipulation, #example-vertical, #conferimento-form').exists()) {
            var form = $("#example-form");
            form.validate({
                errorPlacement: function errorPlacement(error, element) {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    }
                }
            });
            form.children("div").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "fade",
                onStepChanging: function (event, currentIndex, newIndex) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                },
                onFinishing: function (event, currentIndex) {
                    form.validate().settings.ignore = ":disabled";
                    return form.valid();
                },
                onFinished: function (event, currentIndex) {
                    alert("Submitted!");
                }
            });

            form = $("#conferimento-form");
            form.validate({
                errorPlacement: function errorPlacement(error, element) {
                    element.before(error);
                }
            });
            form.children("div").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "fade",
                onStepChanging: function (event, currentIndex, newIndex) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                },
                onFinishing: function (event, currentIndex) {
                    form.validate().settings.ignore = ":disabled";
                    return form.valid();
                },
                onFinished: function (event, currentIndex) {

                    $.post(form.attr('action'), form.serialize(), function (result) {

                        window.location.href = result;

                    });

                }
            });

            $("#example-basic").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "fade",
                autoFocus: true
            });

            $("#example-manipulation").steps({
                headerTag: "h3",
                bodyTag: "section",
                enableAllSteps: true,
                enablePagination: false
            });

            $("#example-vertical").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "fade",
                stepsOrientation: "vertical"
            });
        }
    };

    /*************************
     Dynamic active menu
     *************************/

    POTENZA.navactivation = function () {
        var path = window.location.pathname.split("/").pop();
        var target = $('.side-menu-fixed .navbar-nav a[href="' + path + '"]');
        target.parent().addClass('active');
        $('.side-menu-fixed .navbar-nav li.active').parents('li').addClass('active');
        /* FRANCESCO SIDEBAR */
        $('.side-menu-fixed .navbar-nav li.active').parents('ul').addClass('show');
        $('.side-menu-fixed .navbar-nav li.active .pull-right .ti-plus').addClass('ti-minus');
        $('.side-menu-fixed .navbar-nav li.active .pull-right .ti-minus').removeClass('ti-plus');
    }

    /****************************************************
     javascript
     ****************************************************/
    var _arr = {};

    function loadScript(scriptName, callback) {
        if (!_arr[scriptName]) {
            _arr[scriptName] = true;
            var body = document.getElementsByTagName('body')[0];
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = scriptName;
            // then bind the event to the callback function
            // there are several events for cross browser compatibility
            // script.onreadystatechange = callback;
            script.onload = callback;
            // fire the loading
            body.appendChild(script);
        } else if (callback) {
            callback();
        }
    }

    /****************************************************
     POTENZA Window load and functions
     ****************************************************/
    //Window load functions
    $window.on("load", function () {
        POTENZA.preloader(),
            POTENZA.pieChart();
    });
    //Document ready functions
    $document.ready(function () {
        POTENZA.counters(),
            POTENZA.goToTop(),
            POTENZA.pniceScroll(),
            POTENZA.mailchimp(),
            POTENZA.accordion(),
            POTENZA.datatables(),
            POTENZA.wowanimation(),
            POTENZA.fancyselect(),
            POTENZA.searchbox(),
            POTENZA.Sidebarnav(),
            POTENZA.todatdayandtime(),
            POTENZA.summernoteeditor(),
            POTENZA.colorpicker(),
            POTENZA.editormarkdown(),
            POTENZA.ptTouchSpin(),
            POTENZA.ptrating(),
            POTENZA.calendarlist(),
            POTENZA.repeaterform(),
            POTENZA.wizardform(),
            POTENZA.navactivation(),
            POTENZA.Fullscreenwindow();
    });
})(jQuery);

// ======= FRANCESCO ===========

$('.elimina').click(function (e) {
    swal({
        title: 'Sei sicuro di voler procedere?',
        text: "I dati eliminati non potranno essere piu' recuperati!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Elimina',
        cancelButtonText: 'Annulla'
    }).then((result) => {
        if (result.value) {

            if (this.dataset.href !== '') location.href = this.dataset.href;
            else location.href = this.title;

            /*swal(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )*/
        }
    })
});

$('.sincro').click(function (e) {
    swal({
        title: 'Sei sicuro di voler procedere?',
        text: "I prodotti associati a questo marca saranno cancellati e sostituiti!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sincronizza',
        cancelButtonText: 'Annulla'
    }).then((result) => {
        if (result.value) {

            if (this.dataset.href !== '') location.href = this.dataset.href;
            else location.href = this.title;

            /*swal(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )*/
        }
    })
});

$('.alert-link').click(function (e) {
    swal({
        title: 'Sei sicuro di voler procedere?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continua',
        cancelButtonText: 'Annulla'
    }).then((result) => {
        if (result.value) {

            if (this.dataset.href !== '') location.href = this.dataset.href;
            else location.href = this.title;
        }
    })
});

$('.alert-link-ordini-archivio').click(function (e) {
    swal({
        title: 'Sei sicuro di voler procedere?',
        text: "Puoi spostare questo ordine in archivio, potrai sempre recuperarlo dalla lista archivio.",
        //text: this.dataset.text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continua',
        cancelButtonText: 'Annulla'
    }).then((result) => {
        if (result.value) {

            if (this.dataset.href !== '') location.href = this.dataset.href;
            else location.href = this.title;
        }
    })
});

$('.alert-link-ordini-riprisrtina').click(function (e) {
    swal({
        title: 'Sei sicuro di voler procedere?',
        text: "Puoi spostare questo ordine di nuovo in gestione, una volta eseguite le attività, potrai sempre rimetterlo in archivio.",
        //text: this.dataset.text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continua',
        cancelButtonText: 'Annulla'
    }).then((result) => {
        if (result.value) {

            if (this.dataset.href !== '') location.href = this.dataset.href;
            else location.href = this.title;
        }
    })
});

$('.alert-2').click(function (e) {
    swal({

        title: 'Sei sicuro di voler procedere?',
        text: this.dataset.text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continua',
        cancelButtonText: 'Annulla'

    }).then((result) => {

        if (result.value) location.href = this.dataset.href;

    })
});

/*$('.stato').click(function(e) {

    $.ajax({
        url: this.title,
        success: function(result){
           // alert(result);
        }
    });

});*/

$('.alert-errore').click(function (e) {
    swal({
        type: 'error',
        title: 'Attenzione!',
        text: this.title,
    })
});

// ==== FRANCESCO MODALE ===

$(function () {

    $('.modale').each(function () {
        $(this).attr("data-toggle", "modal");
        $(this).attr("data-target", ".modale-custom");
    });

    $('.modale-email').each(function () {
        $(this).attr("data-toggle", "modal");
        $(this).attr("data-target", ".modale-custom-email");
    });

    $('.modale-img').each(function () {
        $(this).attr("data-toggle", "modal");
        $(this).attr("data-target", ".modale-custom-img");
    });

});

$('.modale').click(function (e) {

    var link;
    if (this.dataset.href !== '') link = this.dataset.href;
    else link = this.title;

    $.get(link + "&no_cache" + Date.now(), function (data) {
        $("#body-custom-modale").html(data);
    });

});

$('.modale-email').click(function (e) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("body-custom-modale-email").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", this.title, true);
    xhttp.send();

});

$('.modale-img').click(function (e) {

    document.getElementById("img-modale").src = $(this).attr('href');

});

$('.modale-function').click(function (e) {

    var link = this.dataset.href;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("body-custom-modale").innerHTML = this.responseText;

            xhttp.open("GET", link, true);
            xhttp.send();
        }
    };

    xhttp.open("GET", link, true);
    xhttp.send();

});

$('.popup-custom').click(function (e) {

    var w = $(this).data('pop-width') > 0 ? $(this).data('pop-width') : 900;
    var h = $(this).data('pop-height') > 0 ? $(this).data('pop-height') : 600;

    var l = Math.floor((screen.width - w) / 2);
    var t = Math.floor((screen.height - h) / 2);
    window.open(this.dataset.href, "", "width=" + w + ",height=" + h + ",top=" + t + ",left=" + l + ",resizable=no, menubar=no, scrollbars=yes");

});


// === FRANCESCO INPUT ===


$(function () {

    $('.pattern-number').each(function () {
        $(this).attr("pattern", "[0-9]*");
        $(this).attr("title", "solo valori numerici");
    });

    $('.pattern-price').each(function () {
        $(this).attr("pattern", "^\\d+(.\\d{3})*(\\,\\d{1,2})?$");
        $(this).attr("title", "solo valori numerici (Es. 1.234,56)");
    });

    $('.pattern-anno').each(function () {
        $(this).attr("pattern", "[0-9]{4}");
        $(this).attr("title", "solo valori numerici. Formato: YYYY");
    });

});

$(".pattern-time").attr("maxlength", 5)
    .attr("autocomplete", "off")
    .keyup(function () {

        var value = $(this).val();

        if (value.length < 5) if (value.charAt(1) === ":") value = "0" + value;
        if (value.length === 2) {

            if (value > 23) value = "23";
            value = value + ":";

        }

        if (value.length === 5) {

            var array = value.split(":");
            if (array[0] > 23) array[0] = "23";
            if (array[1] > 59) array[1] = "59";

            value = array[0] + ":" + array[1];

        }

        $(this).val(value.replace(/[^\d:]/g, ''));

    });

// ==== FRANCESCO NEWSLETTER BLOG ====

function checkNewsletterBlog(type) {
    var array = [];
    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
    var radio = document.querySelectorAll('input[type=radio]:checked');
    var count = 0;
    var i = 0;

    if (type === 1) {
        if (radio.length === 0) alert("Devi selezionare un articolo primario.");
        else {
            document.getElementById("nb_tipo").value = "singola";
            document.getElementById("form").submit();
        }
    }

    if (type === 2) {

        for (i = 0; i < checkboxes.length; i++) {
            count++;
        }

        if (count % 2 === 0 && count > 0) {
            document.getElementById("nb_tipo").value = "lista";
            document.getElementById("form").submit();
        } else alert("Devi selezionare un numero pari di articoli.");
    }

    if (type === 3) {

        for (i = 0; i < checkboxes.length; i++) {
            count++;
        }

        if (count === 3) {

            if (radio.length === 0) alert("Devi selezionare un articolo primario.");
            else {
                document.getElementById("nb_tipo").value = "ibrida";
                document.getElementById("form").submit();
            }

        } else alert("Devi selezionare 3 articoli secondari.");
    }
}

function sendBlogEmail() {

    document.getElementById("error").innerText = "";
    var ns_id = document.getElementById("ns_id").value;
    var nb_id = document.getElementById("nb_id").value;

    if (ns_id === "") {
        document.getElementById("error").innerText = "Devi selezionare una lista.";
        return 0;
    }

    document.getElementById("modal-body").innerHTML =
        "Il server sta eseguendo l'invio, attendere...\n" +
        "\n" +
        "                <p class=\"text-center\">\n" +
        "                    <i class=\"fa fa-spinner fa-spin fa-5x\"></i>\n" +
        "                </p>";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("body-custom-modale").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "newsletter-blog-send-do.php?nb_id=" + nb_id + "&ns_id=" + ns_id, true);
    xhttp.send();

}


// js dell'input[type="file"] personalizzato da noi ///////////////////////////////

'use strict';

(function (document, window, index) {
    var inputs = document.querySelectorAll('.inputfile');
    Array.prototype.forEach.call(inputs, function (input) {
        var label = input.nextElementSibling,
            labelVal = label.innerHTML;

        input.addEventListener('change', function (e) {
            var fileName = '';
            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            else
                fileName = e.target.value.split('\\').pop();

            if (fileName)
                label.querySelector('span').innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });

        // Firefox bug fix
        input.addEventListener('focus', function () {
            input.classList.add('has-focus');
        });
        input.addEventListener('blur', function () {
            input.classList.remove('has-focus');
        });
    });
}(document, window, 0));

$('.custom-file-input').on('change', function () {

    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);

});

// fine del js dell'input[type="file"] personalizzato da noi ///////////////////////////////

// numero progressivo a label e id dell'input file quando c'è il repeater /////////////////

$('.prog-numb-id').on('click', function () {
    setTimeout(delayedProgNumb, 100);
});

function delayedProgNumb() {

    $('input.inputfile').each(function (progNum) {

        var OldIdInput = $(this).attr('id');
        $(this).attr('id', OldIdInput + '-' + progNum);
        $(this).next().attr('for', OldIdInput + '-' + progNum);

        $(this).on('change', function (e) {
            var fileName = '';
            if ($(this).files && $(this).files.length > 1)
                fileName = ($(this).attr('data-multiple-caption') || '').replace('{count}', $(this).files.length);
            else
                fileName = e.target.value.split('\\').pop();

            var label = $(this).next();
            var labelVal = label.find('span').html();
            if (fileName)
                label.find('span').text(fileName);
            else
                label.find('span').text(labelVal);
        });
    });

}

// fine numero progressivo a label e id dell'input file quando c'è il repeater /////////////////

$('.stato').click(function (e) {
    $.ajax({
        url: this.title,
        success: function (result) {
            //alert(result);
        }
    });
});

function getSottocategorie() {

    var ct_id = document.getElementById('ct_id').value;
    var st_id = document.getElementById('st_id').value;

    $.ajax({

        url: "ajax/select-sottocategorie.php?ct_id=" + ct_id + "&st_id=" + st_id,

        success: function (data) {

            //document.getElementById('st_id').options[0].selected = '';
            $("#st_id").html(data);

        },

        error: function (richiesta, stato, errori) {

            alert("E' evvenuto un errore. Il stato della chiamata: " + errori);

        }

    });
}

function getMarche() {

    var mr_id = document.getElementById('mr_id').value;
    var md_tipo = document.getElementById('md_tipo').value;

    $.ajax({

        url: "ajax/select-marche.php?mr_id=" + mr_id + "&md_id=" + md_id + "&md_tipo=" + md_tipo,

        success: function (data) {

            //document.getElementById('md_id').options[0].selected = '';
            $("#mr_id").html(data);

        },

        error: function (richiesta, stato, errori) {

            alert("E' evvenuto un errore. Il stato della chiamata: " + errori);

        }

    });
}

function getModelli() {

    var mr_id = document.getElementById('mr_id').value;
    var md_id = document.getElementById('md_id').value;
    var md_tipo = document.getElementById('md_tipo').value;

    $.ajax({

        url: "ajax/select-modelli.php?mr_id=" + mr_id + "&md_id=" + md_id + "&md_tipo=" + md_tipo,

        success: function (data) {

            //document.getElementById('md_id').options[0].selected = '';
            $("#md_id").html(data);

        },

        error: function (richiesta, stato, errori) {

            alert("E' evvenuto un errore. Il stato della chiamata: " + errori);

        }

    });
}

function getPrezzoByCodice() {

    var pr_codice_produttore = document.getElementById('pr_codice_produttore').value;

    if (pr_codice_produttore === '') {

        swal({
            type: 'error',
            title: 'Attenzione!',
            text: 'Devi inserire prima un codice produttore.',
        });

    }

    $.ajax({

        url: "ajax/get-prezzo.php?pr_codice_produttore=" + pr_codice_produttore,

        success: function (data) {

            var controll = parseFloat(data);

            if (controll > 0) $("#pr_prezzo_consigliato").val(data);
            else {

                swal({
                    type: 'error',
                    title: 'Attenzione!',
                    text: 'Non è stato trovato nessun prodotto associato a questo codice produttore.',
                });

            }

        },

        error: function (richiesta, stato, errori) {

            alert("E' evvenuto un errore. Il stato della chiamata: " + errori);

        }

    });
}

$('.popover-img').each(function () {
    $(this).data('trigger', 'hover');
    $(this).data('toggle', 'popover');
    $(this).data('placement', 'bottom');
    $(this).data('html', true);

    let src = $(this).attr('src');
    src = src.length > 0 ? src : $(this).data('src');
    let content = "<img src='" + src + "' height='200' width='200'>";

    $(this).data('content', content);
    $(this).popover();
});

$(function () {

    if ($('#example-form').exists()) $('input[required]').addClass("required");

    if ($('#chart-scadenze').exists()) {

        let config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: $('#chart-scadenze').data('value'),
                    backgroundColor: [
                        window.chartColors.red,
                        window.chartColors.orange,
                        window.chartColors.yellow
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    "Scadute",
                    "In scadenza 7 giorni",
                    "In scadenza 30 giorni"
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: false,
                    text: 'Doughnut Chart'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };

        let chart = document.getElementById("chart-scadenze").getContext("2d");
        window.myLine3 = new Chart(chart, config);

    }

});


$('.alert-link-ordini-eliminato').click(function (e) {
    swal({
        title: 'Sei sicuro di voler procedere?',
        text: "Puoi settare questo ordine come eliminato, potrai sempre recuperarlo dalla lista eliminati.",
        //text: this.dataset.text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continua',
        cancelButtonText: 'Annulla'
    }).then((result) => {
        if (result.value) {

            if (this.dataset.href !== '') location.href = this.dataset.href;
            else location.href = this.title;
        }
    })
});

$(".btn-print").click(function () {

    $(".btn-print").hide();
    window.print();
    $(".btn-print").show();

});

// ==== AUTOCOMPLETAMENTO ====
$.expr[":"].contains_ci = $.expr.createPseudo(function (arg) {
    return function (elem) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});

$(function () {

    $(".lw-ac-input input[type='text']").attr("autocomplete", "off")
        .attr("placeholder", "Digita del testo per visualizzare i suggerimenti");

});

$(".lw-ac-input input[type='text']").on('keypress change keyup', function () {

    let searchInputValue = $(this).val();

    if (searchInputValue.length > 0) {

        $('.lw-ac-list p').hide();
        $('.lw-ac-list').show().find('p:contains_ci(' + searchInputValue + ')').show();

    } else {

        $('.lw-ac-list').hide();

    }

});

$('.lw-ac-list p').click(function () {

    if ($(this)[0].hasAttribute("disabled")) return 0;

    $(".lw-ac-input input[type='text']").val($(this).text());
    $(".lw-ac-input input[type='hidden']").val($(this).data('value'));

    $('.lw-ac-list').hide();

});

$('.ac-lotti p').click(function () {

    $("#lt_prezzo").val($(this).data('prezzo'));
    $("#lb_lt_quantita").show().text($(this).data('um'));

});

$('.ac-distribuzione p').click(function () {

    if ($(this)[0].hasAttribute("disabled")) return 0;

    $.get("ajax/select-giacenze.php?pr_id=" + $(this).data('value'), function (data) {
        $("#dp_gi_id").html(data);
    });

    $("#lb_dp_quantita").show().text($(this).data('um'));

});

$('.ac-ordine p').click(function () {

    if ($(this)[0].hasAttribute("disabled")) return 0;

    $.get("ajax/select-giacenze.php?pr_id=" + $(this).data('value'), function (data) {
        $("#or_gi_id").html(data);
    });

    $("#or_prezzo").val($(this).data('price'));
    $("#lb_or_quantita").show().text($(this).data('um'));

});

$('.ac-ordine-operatore p').click(function () {

    if ($(this)[0].hasAttribute("disabled")) return 0;

    let gi_id = $(this).data('giacenza');

    if (gi_id > 0) $("#or_gi_id").val(gi_id);
    else {

        $.get("ajax/select-giacenze.php?pr_id=" + $(this).data('value'), function (data) {
            $("#or_gi_id").html(data);
        });

    }

    $("#or_prezzo").val($(this).data('price'));
    $("#lb_or_quantita").show().text($(this).data('um'));

});

$('.btn-cart-mail').click(function () {

    let link = $(this).data('href');
    let icon = $(this).find("i");

    icon.addClass("fa fa-spinner fa-spin");
    $.get(link, function (data) {
        icon.removeClass("fa-spinner fa-spin");
        icon.addClass("fa-check");
    });

});
//==== ====

$('.detail-show').click(function () {
    $(this).parent().parent().next().toggle();
    // $(this).parent().parent().next().next().toggle()
});

$('.ajax-select').change(function () {

    let value = $(this).val();
    let target = $(this).data('target');
    let href = $(this).data('href');

    $.get(href + value, function (data) {

        $(target).html(data);

    });

});


$('.varianti-show').click(function () {

    let capofile = $(this).data("capofila");
    $("tr[data-capofila='" + capofile + "']").toggle();

    //var num = $(this).data("num");

    //$("#"+num).toggle();


});


// ==== CHECK FILE ====
$(function () {

    $("input[type='file']").bind('change', function () {

        var file_size = this.files[0].size, input = $(this);
        if (file_size > 2097152) {

            alert("Il file non può essere più grande di 2MB.");
            $(this).val("").parent("div").find("label").html("Seleziona un file");
            return 0;

        }

        var file, img,
            max_width = parseInt($(this).data('max-width')), max_height = parseInt($(this).data('max-height')),
            width = parseInt($(this).data('width')), height = parseInt($(this).data('height')),
            ratio = $(this).data('ratio');

        if (max_width > 0 || max_height > 0) {

            if ((file = this.files[0])) {

                img = new Image();
                img.onload = function () {

                    if (this.width > max_width && max_width > 0) {

                        alert("L'immagine supera la larghezza massima (" + max_width + "px)");
                        input.val("").parent("div").find("label").html("Seleziona un file");
                        return 0;

                    } else if (this.height > max_height && max_height > 0) {

                        alert("L'immagine supera l'altezza massima (" + max_height + "px)");
                        input.val("").parent("div").find("label").html("Seleziona un file");
                        return 0;

                    }

                };
                img.src = URL.createObjectURL(file);

            }

        }

        if (width > 0 || height > 0) {

            if ((file = this.files[0])) {

                img = new Image();
                img.onload = function () {

                    if (this.width !== width && width > 0) {

                        alert("L'immagine non corrisponde alla larghezza obbligatoria (" + width + "px)");
                        input.val("").parent("div").find("label").html("Seleziona un file");
                        return 0;

                    } else if (this.height !== height && height > 0) {

                        alert("L'immagine non corrisponde all'altezza obbligatoria (" + height + "px)");
                        input.val("").parent("div").find("label").html("Seleziona un file");
                        return 0;

                    }

                };
                img.src = URL.createObjectURL(file);

            }

        }

        if (ratio.length > 0) {

            if ((file = this.files[0])) {

                var ratio_arr = ratio.split(":");

                img = new Image();
                img.onload = function () {

                    if ((this.width / ratio_arr[0]) !== (this.height / ratio_arr[1])) {

                        alert("L'immagine deve essere in proporzione (" + ratio + ")");
                        input.val("").parent("div").find("label").html("Seleziona un file");
                        return 0;

                    }

                };
                img.src = URL.createObjectURL(file);

            }

        }

    });

});

function PrintElem(elem) {
    var mywindow = window.open('', 'PRINT', 'height=500,width=800');

    mywindow.document.write('<html><head><title>' + document.title + '</title>');
    mywindow.document.write('</head><body >');
    //mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close();
    mywindow.focus();

    mywindow.print();
    mywindow.close();

    return true;
}