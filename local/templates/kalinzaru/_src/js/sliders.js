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

let owlFrontSlider = $('.slider .slider--wrapper');
if (owlFrontSlider.length !== 0) {
    owlFrontSlider.addClass('owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        navContainer: '.slider--nav',
        navElement: 'div',
        dots: false,
        autoplay: true,
        //autoplaySpeed: 6000,
        //autoplayHoverPause: false,
        lazyLoad: true,
        //lazyLoadEager: 2,
    }).
    on('mouseover', function () {
        owlFrontSlider.trigger('stop.owl.autoplay');
    }).
    on('mouseleave', function () {
        owlFrontSlider.trigger('play.owl.autoplay');
    });
}

// Слайдер популярных товаров на главной

let owlPopularFrontSlider = $('.popular-products--wrapper > div');
if (owlPopularFrontSlider.length !== 0) {
    owlPopularFrontSlider.addClass('owl-carousel').owlCarousel({
        items: 4,
        loop: true,
        nav: true,
        //navContainer: '.slider--nav',
        navElement: 'div',
        dots: true,
        dotsEach: true,
        autoplay: true,
        //autoplaySpeed: 6000,
        //autoplayHoverPause: false,
        lazyLoad: true,
        //lazyLoadEager: 2,
        responsive: {

        }
    }).
        on('mouseover', function () {
            owlPopularFrontSlider.trigger('stop.owl.autoplay');
        }).
        on('mouseleave', function () {
            owlPopularFrontSlider.trigger('play.owl.autoplay');
        });
}
