'use strict';

(function($) {

    let min = false;
    let nodeFormId = 'bx-soa-order-form';

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

        accordion: function() {
            $('.accordion > li:eq(0) a.ttt333').addClass('active').next().slideDown();

            $('.accordion a.ttt333').click(function (e) {
                var dropDown = $(this).closest('li').find('div.main');

                $(this).closest('.accordion').find('div.main').not(dropDown).slideUp();

                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $(this).closest('.accordion').find('a.ttt333 active').removeClass('active');
                    $(this).addClass('active');
                }
                dropDown.stop(false, true).slideToggle();
                e.preventDefault();
            });
        },

        /**
         * Update shopping cart at header.
         */
        updateHeaderCart: function () {
            let cartCounter = $('.header__cart .count');
            $.ajax({
                url: '/ajax/',
                method: 'post',
                dataType: 'json',
                data: {
                    action: 'getCartItems'
                }
            }).
                done(function (data) {
                    cartCounter.text(data.items);
                });
        },

        /**
         * Remove item from shopping cart.
         *
         * @param id
         */
        removeCartItem: function (id) {
            $.ajax({
                url: '/ajax/',
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'deleteBasketItem',
                    deleteBasketId: id
                }
            }).
                done(function (data) {
                    if (data) {
                        kalinza.updateHeaderCart();
                        BX.Sale.OrderAjaxComponent.sendRequest('refreshOrderAjax');
                    } else {
                        $('#modal-error').modal();
                    }
                });
        },

        /**
         * Change quantity of product.
         *
         * @param op
         * @param id
         * @param quan
         */
        changeQuantity: function (op, id, quan) {
            $.ajax({
                url: '/ajax/',
                type: 'post',
                data: {
                    action: 'basketChangeQuantity',
                    op: op,
                    id: id,
                    quan: quan,
                },
            }).
                done(function (data) {
                    if (data) {
                        kalinza.updateHeaderCart();
                        BX.Sale.OrderAjaxComponent.sendRequest('refreshOrderAjax');
                    }
                    else {
                        $('#modal-error').modal();
                    }
                });
        },

        /**
         * Update shopping cart.
         */
        updateCart: function () {
            kalinza.updateHeaderCart();
            BX.Sale.OrderAjaxComponent.sendRequest('refreshOrderAjax');
        },

        /**
         * Set person type.
         *
         * @param type_id
         */
        setPersonType: function (type_id) {
            $.ajax({
               url: '/ajax/',
               type: 'post',
               data: {
                   action: 'setPersonType',
                   type_id: type_id
               },
            }).
                done(function (data) {
                    let result = BX.Sale.OrderAjaxComponent.result;
                    BX.Sale.OrderAjaxComponent.result.PERSON_TYPE[0].CHECKED = '';
                    BX.Sale.OrderAjaxComponent.result.PERSON_TYPE[1].CHECKED = 'Y';
                    BX.Sale.OrderAjaxComponent.init(BX.Sale.OrderAjaxComponent.params);
                });
        },

        /**
         * Reset filter.
         *
         * @param url
         */
        resetFilter: function (url) {
            $.ajax({
                url: '/ajax/',
                type: 'post',
                data: {
                    action: 'resetFilter',
                    url: url,
                },
            }).
                done(function (data) {
                    window.location.replace(location.pathname);
                });
        },

        /**
         * Add to cart done actions.
         *
         * @param ths
         * @param data
         */
        addToCartDone: function (ths, data) {
            this.updateHeaderCart();
            let res = $.parseJSON(data);
            if (res.error.code === 200) {
                $('#modal-updatecart').modal();
            } else {
                $('#modal-error').modal();
            }
            ths.attr('disabled', false);
        },

        /**
         * Sticky block.
         *
         * @param wrapper
         * @param end
         * @param parent
         */
        stickyblock: function (wrapper, end, parent) {
            let stickyWrapper = wrapper;
            if (stickyWrapper.length > 0) {
                stickyWrapper.stickyBlock({
                    top: 0,
                    end: {
                        element: end,
                        offset: 0
                    },
                    parent: parent
                });
            }
        },

        /**
         * Phone mask on input text field.
         *
         * @param ths
         */
        phoneMask: function (ths) {
            if ($.fn.inputmask) {
                ths.inputmask({
                    mask: '+7 (999) 999-99-99',
                    placeholder: '*'
                });
            }
        },

        /**
         * Email mask for input text field.
         *
         * @param ths
         */
        emailMask: function (ths) {
            if ($.fn.inputmask) {
                new Inputmask('email').mask(ths);
            }
        },

        /**
         * Post index mask on input text field.
         *
         * @param ths
         */
        indexMask: function (ths) {
            if ($.fn.inputmask) {
                ths.inputmask({
                    mask: '999999',
                    placeholder: '_'
                })
            }
        },

        innMask: function (ths) {
            if ($.fn.inputmask) {
                ths.inputmask({
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
                // 'form[name="LEATHER_TO_PRODUCTION"] input[name="form_text_14"]',
                // 'form[name="LEATHER_MAIN"] input[name="form_text_2"]',
                // 'form[name="LEATHER_CALLBACK"] input[name="form_text_8"]',
                // 'form[name="LEATHER_QUESTION"] input[name="form_text_13"]',
                // 'input[name="ORDER_PROP_5"]',
                // 'input[name="ORDER_PROP_13"]',
                // 'input[name="ORDER_PROP_27"]',
            ];
            let emailInputs = [
                // 'form[name="LEATHER_TO_PRODUCTION"] input[name="form_text_10"]',
                // 'form[name="LEATHER_QUESTION"] input[name="form_text_5"]',
                // 'form[name="LEATHER_SUBSCRIBE"] input[name="form_email_3"]',
                // 'input[name="ORDER_PROP_4"]',
                // 'input[name="ORDER_PROP_12"]',
                // 'input[name="ORDER_PROP_26"]',
            ];
            let indexInputs = [
                // 'input[name="ORDER_PROP_2"]',
                // 'input[name="ORDER_PROP_15"]',
            ];
            let innInputs = [
                // 'input[name="ORDER_PROP_23"]',
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
         * Check privacy checkbox and disable order button.
         */
        checkPrivacy: function () {
            document.querySelector('[data-save-button]').disabled = document.getElementById('order-privacy').checked;
        },

        /**
         *
         * @param str
         * @returns {*}
         */
        getAddressFromFullString: function (str) {
            return str.replace(/Адрес:/g, '').replace(/(Телефон:)(.)+/g, '').trim();
        },

        /**
         * Set address to field.
         *
         * @param address
         */
        setAddress: function (address) {
            $('#soa-property-6').val(address).attr('readonly', true).closest('.bx-soa-customer-field').removeClass('has-error');
            $('#soa-property-16').val(address).attr('readonly', true).closest('.bx-soa-customer-field').removeClass('has-error');
        },

        /**
         *
         */
        resetAddress: function () {
            $('#soa-property-6').val('').removeAttr('readonly').closest('.bx-soa-customer-field');
            $('#soa-property-16').val('').removeAttr('readonly').closest('.bx-soa-customer-field');
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

	};

    // Фиксированный хедер
    let fixedHeader = {
        fixed_header: '.js-fixed-header',
        windowWidth: null,
        parentHeight: null,

        init() {
            this.eventHandlers(this);
        },

        eventHandlers(obj) {
            obj.windowWidth = $(window).width();
            obj.parentHeight = $(obj.fixed_header).parent().height();

            $(window).scroll(function () {
                if (obj.windowWidth < 786) {
                    ($(this).scrollTop() >= 100) ? obj.headerHandler(obj, true) : obj.headerHandler(obj, false);
                }
            })
        },

        headerHandler(obj, bool) {
            if (bool) {
                $(obj.fixed_header).parent().css('height', obj.parentHeight);
                $(obj.fixed_header).addClass('is--fixed');
            } else {
                $(obj.fixed_header).parent().css('height', 'initial');
                $(obj.fixed_header).removeClass('is--fixed');
            }

        }

    };
    fixedHeader.init();
    kalinza.accordion();

    // Меню на мобильном
    $(document).on('click', '.js-modal', function () {
        let event = $(this).data('event'),
            modal = $(this).data('modal'),
            jsModal = $('.js-modal-' + modal);
        if (event === 'show') {
            (modal === 'topnav') ? jsModal.addClass('is--active') : jsModal.fadeIn();
            $('html body').css('overflow', 'hidden');
        } else if (event === 'close') {
            $('html body').css('overflow', 'initial');
            (modal === 'topnav') ? jsModal.removeClass('is--active') : jsModal.fadeIn();
        }
    });

    // Ajax Handler
    $(document).on('click', '.js-submit', function (e) {
        e.preventDefault();
        let ths = $(this);
        if (ths.attr('disabled') === true) return;
        ths.attr('disabled', true);
        let form = $('#' + ths[0].form.id);

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize()
        }).
            done(function (data) {
                //kalinza.addToCartDone(ths, data);
                kalinza.updateHeaderCart();
                let res = $.parseJSON(data);
                if (res.error.code === 200) {
                    $('#modal-updatecart').modal();
                } else {
                    $('#modal-error').modal();
                }
                ths.attr('disabled', false);
            });
    });

    // Удаление позиций (товаров) корзины
    $(document).on('click', '.bx-soa-item-remove', function (e) {
        e.preventDefault();
        let ths = $(this),
            id = ths.children('button').data('id');
        let wait = BX.showWait(nodeFormId);
        kalinza.removeCartItem(id);
        BX.closeWait(nodeFormId, wait);
    });

    // Изменение количества в корзине
    $(document).on('click', '.basket-quantity', function (e) {
        e.preventDefault();
        let ths = $(this),
            id = ths.data('id'),
            //pid = ths.data('pid'),
            op = ths.data('op');
        let wait = BX.showWait(nodeFormId);
        kalinza.changeQuantity(op, id, 1);
        BX.closeWait(nodeFormId, wait);
    });

    // Изменение количества в поле ввода в корзине
    $(document).on('change input', '.basket-quantity-value', function (e) {
        e.stopPropagation();
        setTimeout( () => {
            let ths = $(this),
                id = ths.data('id'),
                op = 'add',
                quan = ths.val(),
                min = ths.data('min'),
                max = ths.data('max');
            if (
                quan === ''
                || parseInt(quan) <= min
                || parseInt(quan) > max
                || parseInt(quan) === 0
                || parseInt(quan) > 999999
                || isNaN(parseInt(quan))
            ) {
                $(this).val($(this).data('value'));
                return;
            }
            let wait = BX.showWait(nodeFormId);
            kalinza.changeQuantity(op, id, quan);
            BX.closeWait(nodeFormId, wait);
        }, 1500);
    });

    // Обновление корзины
    $(document).on('click', '.shopping-cart__cart-refresh', function (e) {
        e.preventDefault();
        let wait = BX.showWait(nodeFormId);
        kalinza.updateCart();
        BX.closeWait(nodeFormId, wait);
    });

    // Обработчик поля ввода количества товара
    $(document).on('keyup keypress keydown input focus blur', '#product-quantity', function (e) {
        let ths = $(this);
        let value = parseInt(ths.val());
        let min = parseInt(ths.attr('min'));
        let max = parseInt(ths.data('max'));
        let sendToProd = parseInt(ths.data('sendtoprod'));
        let quanStore = parseInt(ths.data('quanstore'));
        ths.attr('required', true);

        let btn = {
            addToCart: $('#product-addtocart'),
            sendToProd: $('#sendtoproduction--button')
        };
        let info = {
            descProd: $('.product-card__details-desc__prod'),
            descOrder: $('.product-card__details-desc__order')
        };

        // Обработчик кнопки "Добавить в корзину"
        btn.addToCart.attr('disabled', (
               value < min
            || value > max
            || value >= sendToProd
            || value > quanStore
            || isNaN(value)
        ));

        // Обработчик инфо-описаний
        (value < sendToProd) ? info.descProd.addClass('error') : info.descProd.removeClass('error');
        (value < min) ? info.descOrder.addClass('error') : info.descOrder.removeClass('error');

    });

    // Обработчик поля ввода количества товара в модалке
    $(document).on('keyup keypress keydown input focus blur', 'input[name="form_text_11"]', function (e) {
        e.stopPropagation();
        let value = parseInt($(this).val());
        let src = $('#product-quantity');
        let sendToProd = parseInt(src.data('sendtoprod'));
        let price = src.data('price');

        let btn = $('input[name="web_form_submit"]');
        let info = $('.form-group--desc');
        let total = $('.form-group--total .value');

        // Обработчик кнопки "Отправить"
        btn.attr('disabled', (value < sendToProd || isNaN(value)));
        // Обработчик инфо-описания
        (value < sendToProd || isNaN(value)) ? info.addClass('error') : info.removeClass('error');
        // Обработчик общей суммы
        total.html(kalinza.numberFormat(value * price, 2, ',', ' '));
    });

    // Обработчик кнопки "Отправить на производство"
    $(document).on('click', '#sendtoproduction--button', function (e) {
        let min = $(this).data('sendtoprod');
        let unit = $(this).data('unit');
        let inputValue = $('#product-quantity').val();
        let productId = $(this).data('product-id');
        let id = '#modal-sendtoproduction';
        let price = $(this).data('price');

        if (inputValue < min) {
            $(id+'-count').text(min);
            $(id+'-unit').text(unit);
            $(id+'-error').modal('show');
        } else {
            $('input[name="form_hidden_12"]').val(productId);

            $('input[name="form_text_11"]').val(inputValue);
            $('.form-group--measure').text(unit);
            $('.form-group--price').html($('.product__prices-actual.bulk').html());
            $('.form-group--desc').html($('.product-card__details-desc__prod').html());
            $('.form-group--total .value').html(kalinza.numberFormat(inputValue * price, 2, ',', ' '));

            $(id).modal('show');
        }
    });

    // Обработчик кнопки "Задать вопрос о продукте"
    $(document).on('click', 'a[data-target="#modal-product-question"]', function () {
       let pid = $(this).data('pid');
       $('input[name="form_hidden_16"]').val(pid);
    });

    // Обработчик меню из скрытых элементов меню
    function unWrapHiddens() {
        $('.topnav__menu-hiddens li').unwrap();
        $('.topnav__delimiter').insertBefore($('.topnav__menu li').eq(-3));
    }
    function wrapHiddens(obj) {
        obj.wrapAll('<div class="topnav__menu-hiddens">');
    }
    $(document)
    .on('click', '.topnav__dots', function () {
        if ($('.topnav__menu-hiddens').length > 0) {
            unWrapHiddens()
        } else {
            let menuItems = $('.topnav__menu li');
            if (menuItems.length > 0) {
                let arrHiddens = [];
                menuItems.each(function () {
                    if ($(this).css('display') === 'none') {
                        arrHiddens = $.merge(arrHiddens, $(this));
                    }
                });
                wrapHiddens($(arrHiddens));
            }
        }
    })

    // Фильтр / сортировщик
    .on('click', '.filter__action', function(e) {
        let typeClass = '.' + $(this).data('type');
        let div = $('.filter__contents ' + typeClass);
        // Обработка сброса
        if ($(this).hasClass('reset')) {
            e.stopPropagation();
            kalinza.resetFilter(window.location.href);
            return false;
        }
        // активация текущего
        $(this).toggleClass('active');
        div.toggleClass('active');
        // деактивация остальных
        $(this).siblings('.filter__action:not('+typeClass+')').removeClass('active');
        div.siblings(':not('+typeClass+')').removeClass('active');
    })

    // Чекбокс обработки персональных данных
    .on('click', 'label[for="order-privacy"]', function (e) {
        e.stopPropagation();
        kalinza.checkPrivacy();
    })

    // Обработка выбора адреса самовывоза
    .on('click', '.bx-soa-pickup-list-item.bx-selected', function () {
        // Вставка адреса из Самовывоз
        if ($(this).length === 1) {
            kalinza.setAddress(kalinza.getAddressFromFullString($(this).find('.bx-soa-pickup-l-item-desc').text()));
        }
    })
    .on('click', '.bx-soa-pp-company', function () {
        kalinza.resetAddress();
    })

    // Информация об использовании cookie (скрытfие)
    .on('click', '.politics-notice .close-button', function () {
        kalinza.setPoliticsNoticeCookie();
        $('.politics-notice').stop().slideUp();
    })

    // Ajax-пагинация в каталоге
    .on('click', '.bx-pagination ul li a', function (e) {
        e.preventDefault();
        let url = $(this)[0].href;
        $('.catalog-production__wrapper').load(url + ' .catalog-production__products');
    });

    // При изменении размера окна
    window.onresize = function() {
        unWrapHiddens();
        kalinza.scrollToTop();
    };

    // После полной загрузки
    window.onload = function () {

        // Отключение "липкого блока" на мобильных
        let details_wrapper = $('.product-card__details-wholewrapper'),
            details_end = $('.product-card__end'),
            details_parent = $('.product-card__details'),
            details_tab_content = details_parent.find('.details-tab__content'),
            detail_tab_height = 0,
            windowWidth = $(window).width();
        $(details_tab_content).children().each(function (i, e) {
            if ($(e).height() > detail_tab_height) {
                detail_tab_height = $(e).height();
            }
        });
        $(details_tab_content).children().height(detail_tab_height);
        if (windowWidth > 768) {
            kalinza.stickyblock(details_wrapper, details_end, details_parent);
        }

        kalinza.masks();

    };

    // После завершения
    $(document).ajaxComplete(function () {

        // Вставка адреса из Самовывоз
        if ($('#bx-soa-pickup').css('display') !== 'none') {
            var pickupItemSelected = $('.bx-soa-pickup-list-item.bx-selected');
            if (pickupItemSelected.length === 1) {
                kalinza.setAddress(kalinza.getAddressFromFullString(pickupItemSelected.find('.bx-soa-pickup-l-item-desc').text()));
            }
        } else {
            kalinza.resetAddress();
        }

        // Вставка адреса из СДЭК (Самовывоз)
        if (BX('samovivoz') !== null) {
            var addrDiv = BX.findChildByClassName(BX('samovivoz'), 'sdek_pvzAddr');
            if (addrDiv !== null) {
                var address = addrDiv.innerHTML;
                if (address !== '') {
                    kalinza.setAddress(kalinza.getAddressFromFullString(address));
                }
            }
        }

        kalinza.masks();

    });

    // При прокрутке
    $(document).scroll(function () {
        kalinza.scrollToTop();
    });

    // Плавный скролл
    $("[href='#top']").mPageScroll2id();

})(jQuery);
