/*********************************************************************************

	Template Name: Karbar - Multipurpose Bootstrap 4 Template
	Template URI: https://themeforest.net/user/themes-hub   
	Description: Karbar is a best templete for your corporate/business website which comes with unique design and user friendly code.  
	Author: Themes-Hub
	Author URI: https://hastech.company/
	Version: 1.0

    Note: This is scripts js. All custom scripts here.

**********************************************************************************/

/*===============================================================================

    [ INDEX ]
	|
    |___Body Overlay
    |___Trigger Menu
    |___Button Effect
    |___Trigger Sidemenu
    |___Banner Padding
    |___Mouse Parallax
    |   |___Banner Layers Parallax
    |   |___Banner Content Parallax
    |
    |___Trigger Sidemenu Another
    |___Sticky Header
    |___Last Dropdown Selector
    |___Sidemenu Dropdown
    |___Contact Form Message Popup
    |
	[END INDEX ]

================================================================================*/

(function ($) {
    'use strict';

    /* Body Overlay */
    $('<div class="body-overlay"></div>').appendTo($('.wrapper'));

    function bodyOverlay() {
        $('html').css('overflow-y', 'hidden');
        $('.body-overlay').addClass('is-visible')
            .on('click', function () {
                $(this).removeClass('is-visible');
                $('.header-sidemenu-minimal').removeClass('is-visible');
                $('.sidemenu-header-optional-trigger').removeClass('is-active');
                $('.wrapper').removeClass('left-offset-active');
                $('html').css('overflow-y', 'auto');
            });

    }



    /* Trigger Menu */
    var slideMenu = function (container, trigger) {
        var slideMenuContainer = container;
        var slideMenutrigger = trigger;
        $(slideMenutrigger).on('click', function () {
            $(this).toggleClass('is-active')
                .siblings(slideMenuContainer).toggleClass('is-visible');
        });
    };
    var slidemenu1 = new slideMenu('.slide-menu-inner', '.header-style-2 .trigger-menu-icon');



    /* Button Effect */
    function buttonEffect() {
        $('<b></b>').appendTo('.cr-btn');
        $('.cr-btn')
            .on('mouseenter', function (e) {
                var parentOffset = $(this).offset(),
                    relX = e.pageX - parentOffset.left,
                    relY = e.pageY - parentOffset.top;
                $(this).find('b').css({
                    top: relY,
                    left: relX
                });
            })
            .on('mouseout', function (e) {
                var parentOffset = $(this).offset(),
                    relX = e.pageX - parentOffset.left,
                    relY = e.pageY - parentOffset.top;
                $(this).find('b').css({
                    top: relY,
                    left: relX
                });
            });
        $('[href="#"]').click(function () {
            return false;
        });
    }
    buttonEffect();




    /* Trigger Sidemenu */
    function triggerHeader() {
        var menuContainer = $('.header-sidemenu-triggered');
        $('<button class="header-sidemenu-trigger"><i class="flaticon-signs"></i></button>').appendTo(menuContainer)
            .on('click', function () {
                $(this).find('i').toggleClass('flaticon-close flaticon-signs');
                menuContainer.toggleClass('is-visible');
            });
    }
    triggerHeader();





    /* Banner Padding */
    function fixedHeader() {
        var winWidth = $(window).width();
        if (!$('.sidemenu-wrapper').length) {

            if (winWidth > 991) {
                if ($('.fixed-header').length) {
                    var headerHeight = $('.header').innerHeight();
                    $('.single-banner').css({
                        'min-height': 'calc(100vh - ' + headerHeight + 'px)',
                    });
                    $('.fixed-header').next().css({
                        'margin-top': headerHeight + 'px'
                    });
                }
            }

        }
    }
    fixedHeader();





    /* Mouse Parallax */
    // Banner Layers Parallax
    function mouseParallax() {
        var trigger = $('.banner-layers');
        var container = $('.banner-area');
        container.mousemove(function (e) {
            var leftOffset = e.pageX;
            var topOffset = e.pageY;
            var currentPosLeft = (container.width() / 2) - leftOffset;
            var currentPosTop = (container.height() / 2) - topOffset;

            trigger.css({
                'transform': 'translate(' + currentPosLeft / 50 + 'px, ' + currentPosTop / 50 + 'px)'
            });
        });
    }
    mouseParallax();




    // Banner Content Parallax
    function mouseParallax2() {
        var trigger = $('.single-banner-content-parallax');
        var container = $('.banner-area');
        container.mousemove(function (e) {
            var leftOffset = e.pageX;
            var topOffset = e.pageY;
            var currentPosLeft = (container.width() / 2) - leftOffset;
            var currentPosTop = (container.height() / 2) - topOffset;

            trigger.css({
                'transform': 'translate(' + currentPosLeft / 50 + 'px, ' + currentPosTop / 50 + 'px)'
            });
        });
    }
    mouseParallax2();





    /* Trigger Sidemenu Another */
    function headerSidemenuOptionalTrigger() {
        var trigger = $('.sidemenu-header-optional-trigger');
        var container = $('.header-sidemenu-minimal');
        trigger.on('click', function () {
            container.toggleClass('is-visible');
            $(this).toggleClass('is-active');
            $('.wrapper').toggleClass('left-offset-active');
            bodyOverlay();
        });
    }
    headerSidemenuOptionalTrigger();



    /* Sticky Header */
    $(window).on('scroll', function () {
        var scrollPos = $(this).scrollTop();
        if (scrollPos > 300) {
            $('.sticky-header').addClass('is-sticky');
        } else {
            $('.sticky-header').removeClass('is-sticky');
        }
    });




    /* Last Dropdown Selector */
    function menuDropdownLast() {
        $('nav.menu > ul > li').slice(-3).addClass('last-element');
    }
    menuDropdownLast();




    /* Sidemenu Dropdown */
    function sidemenuDropdown() {
        var $this = $('.header-sidemenu');
        $this.find('nav.menu .cr-dropdown')
            .find('ul').slideUp();
        $this.find('nav.menu li.cr-dropdown > a, nav.menu li.cr-sub-dropdown > a').on('click', function (e) {
            e.preventDefault();

            $(this).next().slideToggle();
        });
    }
    sidemenuDropdown();




    // Contact Form Message Popup
    function contactFormPopup() {
        var trigger = $('#contact-form [type="submit"]'),
            container = $('.cr-contact-message-modal');

        trigger.on('click', function () {
            container.addClass('is-visible');
        });

        $('<button><i class="icofont icofont-close"></i></button>').appendTo(container).on('click', function () {
            container.removeClass('is-visible');
        });
    }
    contactFormPopup();


})(jQuery);