'use strict';

(function($) {

    let min = false;

    let kalinza = {

        isMobile: {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        },

        /**
         * Аккордеон в контактах
         */
        accordion: function() {
            //$('.accordion > li:eq(0) a.city-dropdown').addClass('active').next().slideDown();
            $(document).on('click', '.accordion a.city-dropdown', function (e) {
                var dropDown = $(this).closest('li').find('div.main');

                $(this).closest('.accordion').find('div.main').not(dropDown).slideUp();

                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $(this).closest('.accordion').find('a.city-dropdown active').removeClass('active');
                    $(this).addClass('active');
                }
                dropDown.stop(false, true).slideToggle();
                e.preventDefault();
            });
        },

        /**
         * Phone mask on input text field.
         *
         * @param el
         */
        phoneMask: function (el) {
            if ($.fn.inputmask && window.innerWidth > 1024) {
                el.inputmask({
                    mask: '+(7|8) 999 999-99-99',
                    placeholder: '_'
                });
            }
        },

        /**
         * Email mask for input text field.
         *
         * @param el
         */
        emailMask: function (el) {
            if ($.fn.inputmask) {
                new Inputmask('email').mask(el);
            }
        },

        /**
         * Post index mask on input text field.
         *
         * @param el
         */
        indexMask: function (el) {
            if ($.fn.inputmask) {
                el.inputmask({
                    mask: '999999',
                    placeholder: '_'
                })
            }
        },

        innMask: function (el) {
            if ($.fn.inputmask) {
                el.inputmask({
                    mask: '9999999999[99]',
                    placeholder: '_'
                })
            }
        },

        /**
         * Маски ввода в формах.
         */
        masks: function () {
            let phoneInputs = [
                'input[name="phone"]',
                'input[name="ORDER_PROP_3"]',
            ];
            let emailInputs = [
                'input[name="email"]',
            ];
            let indexInputs = [
            ];
            let innInputs = [
            ];

            phoneInputs.forEach(function (input) {
                kalinza.phoneMask($(input));
            });
            emailInputs.forEach(function (input) {
                kalinza.emailMask($(input));
            });
            indexInputs.forEach(function (input) {
                kalinza.indexMask($(input));
            });
            innInputs.forEach(function (input) {
                kalinza.innMask($(input));
            });
        },

        /**
         * Number format.
         *
         * @param number - число
         * @param decimals - количество знаков после разделителя
         * @param dec_point - символ разделителя
         * @param separator - разделитель тысячных
         * @returns {string}
         */
        numberFormat: function (number, decimals, dec_point, separator) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            let n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof separator === 'undefined') ? ',' : separator ,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + (Math.round(n * k) / k)
                        .toFixed(prec);
                };
            // Фиксим баг в IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
                .split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '')
                .length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        },

        /**
         * Set BITRIX_POLITICS_NOTICE cookie at 1 year
         */
        setPoliticsNoticeCookie: function () {
            $.cookie('BITRIX_POLITICS_NOTICE', true, {
                expires: 365,
                path: '/',
                secure: true
            });
        },

        /**
         * Scroll to top.
         */
        scrollToTop: function () {
            let scrollingAtTop = $(document).scrollTop();
            if (scrollingAtTop > 480 && !min) {
                $('#scroll-to-top').fadeIn();
                min = true;
            }
            if (scrollingAtTop <= 480 && min) {
                $('#scroll-to-top').fadeOut();
                min = false;
            }
        },

        /**
         * Mobile menu.
         */
        mobileMenu: function () {
            let hamburger = '.header--mobile--menu';
            let menu = '.header--mobile--menu-popup';
            let menuClose = '.mobile-menu--close';
            let menuFolder = '.mobile-menu--menu--folder';

            $(document)
            .on('click', hamburger, function () {
                $(menu).addClass('active');
            })
            .on('click', menuClose, function () {
                $(menu).removeClass('active');
            })
            .on('click', menuFolder, function () {
                $(this).find('.kalinza-icon').toggleClass('active');
                $(this).next('ul').slideToggle();
            })
            // Открытие панели поиска
            .on('click', '.header--mobile--search a', function (e) {
                e.preventDefault();
                $('.header--mobile--search-bar').slideToggle(200);
            });

        },

        /**
         * Mobile smart filter.
         */
        mobileFilter: function () {
            $(document)
            .on('click', '.mobile-filter', function () {
                $('.bx-filter').addClass('wrap');
            })
            .on('click', '.bx-filter-close', function () {
                $('.bx-filter').removeClass('wrap');
            });
        },

        /**
         * Image changer.
         */
        imageChanger: function () {
            $(document).on('click', '.catalog-element-images-more ul li > div', function () {
                let img = $(this).data('img');
                let imgFull = $(this).data('img-full');
                $('.catalog-element-images-main a').attr('href', imgFull);
                $('.catalog-element-images-main a img').attr('src', img);
            });
        },

        /**
         * Topbar menu handler.
         */
        topbarMenu: function () {
            $(document).on('click mouseover', '.header--topbar--left > ul.menu a', function (e) {
                if ($(this).siblings('ul.menu').length > 0) {
                    e.preventDefault();
                    $(this).siblings('ul.menu').toggleClass('active');
                }
            });
            $(document).on('mouseleave', '.header--topbar--left > ul.menu a + ul.menu', function (e) {
                $(this).removeClass('active');
            });
        },

        /**
         * Read more link.
         */
        readmore: function () {
            $(document).on('click', '.about-us--info a.readmore', function (e) {
                e.preventDefault();
                $(this).slideUp(200);
                $(this).closest('.about-us--info--text').find('.more').slideDown(200);
            });
        },

	};

    // При изменении размера окна
    window.onresize = function() {
        kalinza.scrollToTop();
    };

    // После полной загрузки
    window.onload = function () {
        kalinza.masks();
    };

    // После завершения
    $(document).ajaxComplete(function () {
        //kalinza.masks();
    });

    // При прокрутке
    $(document).scroll(function () {
        kalinza.scrollToTop();
    });

    // Плавный скролл
    $("[href='#top']").mPageScroll2id();

    kalinza.accordion();
    kalinza.mobileMenu();
    kalinza.mobileFilter();
    kalinza.imageChanger();
    kalinza.topbarMenu();
    kalinza.readmore();

})(jQuery);
