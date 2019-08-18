'use strict';

let goToSlider = {
    sliderClass: '.js-slider',
    tplControls: `
        <div class="slider-controls">
            <button class="js-slider-control" data-dir="prev"></button>
            <button class="js-slider-control" data-dir="next"></button>
        </div>
                `,
    windowWidth: null,

    init() {
        this.windowWidth = $(document).width();
        this.findWrapper(this);
        this.sliderControl(this);
    },

    findWrapper(obj) {
        $(obj.sliderClass).each(function(i,e) {
            obj.beforeInit(obj, e);
        });
    },

    beforeInit(obj, el) {
        let type = $(el).attr('data-slider');

        // НА ГЛАВНОЙ
        if ($('body').hasClass('index')) {
            // СЛАЙДЕРЫ ПО УМОЛЧАНИЮ
            if(type == 'index-default') {
                if (obj.windowWidth > 576) {
                    obj.sliderAction(el);
                    obj.sliderInit(el, {},
                        function() {
                            $(el).append(obj.tplControls);
                        }
                    );
                }
            }
        }
        // В КАТАЛОГЕ / КАРТОЧКЕ ТОВАРА
        else if ($('body').hasClass('catalog')) {
            let windowWidth = $(document).width();
            // ФОТОГРАФИИ ПРОДУКЦИИ
            if (type == 'card-product') {
                if (windowWidth < 768) {
                    obj.sliderAction(el);
                    obj.sliderInit(el, {
                            bool_dot: true,
                            bool_dotsEach: true
                        },
                        function() {}
                    );
                }
            }
            // ПОСЛЕ КАРТОЧКИ ТОВАРА
            else if (type == 'product-similiar') {
                if (windowWidth > 576) {
                    obj.sliderAction(el);
                    obj.sliderInit(el, {},
                        function() {
                            $(el).append(obj.tplControls);
                        }
                    );
                }
            }
        }
    },

    sliderAction(el) {
        $(el).addClass('owl-carousel owl-theme').children().css('margin-right', 'initial');
    },

    // ИНИЦИАЛИЗАЦИЯ
    sliderInit(el, setting, callback) {
        $(el).owlCarousel({
            items: 4,
            loop: false,
            dots: (setting.bool_dot) ? setting.bool_dot : false,
            dotsEach: (setting.bool_dotsEach) ? setting.bool_dotsEach : false,
            onInitialized: callback,
            responsive:{
                0:{
                    items: 1
                },
                500:{
                    items: 2,
                    margin: 24
                },
                768:{
                    items: 3,
                    margin: 20
                },
                1280:{
                    items:4,
                    margin: 30
                }
            }
        })

    },

    // КНОПКИ-СТРЕЛОЧКИ
    sliderControl(obj){
        $(document).on('click', '.js-slider-control', function() {
            let button = $(this),
                slider = button.closest(obj.sliderClass),
                direction = $(this).data('dir');

            if (direction == 'prev') {
                $(slider).trigger('prev.owl.carousel');
            } else if (direction == 'next') {
                $(slider).trigger('next.owl.carousel');
            }
        })
    }
};

$(document).ready(function() {
    goToSlider.init();
});

$(window).resize(function () {
    goToSlider.init();
});

$(document).ajaxComplete(function () {
    goToSlider.init();
});


// Слайдер на главной

let owlSlider = $('.slider .slide__wrapper');
if (owlSlider.length !== 0) {
    owlSlider.addClass('owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        navContainer: '.slides__nav',
        navElement: 'div',
        dots: false,
        autoplay: true,
        autoplaySpeed: 6000,
        autoplayHoverPause: false,
        lazyLoad: true,
        //lazyLoadEager: 2,
    }).
    on('mouseover', function () {
        owlSlider.trigger('stop.owl.autoplay');
    }).
    on('mouseleave', function () {
        owlSlider.trigger('play.owl.autoplay');
    });
}

// Слайдер филиалов

let owlBranchesSlider = $('.company__branches-wrapper');
if (owlBranchesSlider.length !== 0) {
    owlBranchesSlider.addClass('owl-carousel').owlCarousel({
        items: 6,
        slideBy: 1,
        margin: 36,
        loop: true,
        nav: false,
        dots: true,
        dotsEach: true,
        responsive: {
            1280: {
                items: 5,
            },
            1024: {
                items: 4,
            },
            768: {
                items: 3,
            },
            576: {
                items: 2,
            },
            0: {
                items: 2,
            }
        }
    });
}

// Слайдер партнеров

let owlPartnersSlider = $('.company__partners-wrapper');
if (owlPartnersSlider.length !== 0) {
    owlPartnersSlider.addClass('owl-carousel').owlCarousel({
        items: 6,
        slideBy: 1,
        margin: 36,
        responsive: {
            1280: {
                items: 5,
            },
            1024: {
                items: 4,
            },
            768: {
                items: 3,
            },
            576: {
                items: 2,
            },
            0: {
                items: 2,
            }
        },
        loop: true,
        nav: false,
        dots: true,
        dotsEach: true
    });
}

// Слайдер фото на странице "О компании"

let owlOfficeSlider = $('.company-page__slider-wrapper');
if (owlOfficeSlider.length !== 0) {
    owlOfficeSlider.addClass('owl-carousel').owlCarousel({
        items: 1,
        slideBy: 1,
        margin: 0,
        loop: true,
        nav: false,
        dots: true,
        dotsEach: true,
        onChanged: function(el) {
            $('.company-page__slider-counter').text(((el.page.index === -1) ? 1 : el.page.index + 1) + '/' + el.item.count);
        }
    });
}