'use strict';

/**
 * @type {{addtocart: shop.addtocart}}
 */
var shop = {

    /**
     * Add event listeners.
     */
    bindEvents: function () {

        // Quantity
        $(document).on('click', '.quan', function () {
            let step = $('input#same-eyes') === 'undefined' ? 2 : $('input#same-eyes').is(':checked') ? 1 : 2;
            let input = $(this).siblings('input');
            let value = parseInt(input.val());
            if ($(this).hasClass('quan-plus')) {
                while (step) {
                    value++;
                    step--;
                }
            } else if ($(this).hasClass('quan-minus')) {
                while (step) {
                    value--;
                    step--;
                }
                value = (value <= 0) ? 1 : value;
            } else {
                return false;
            }
            input.val(value);
            $(this).closest('.catalog-element-wrapper').find('.catalog-element-addtocart input').attr('data-quantity', value);
        });

        /*
        $(document).on('click', '.basket-item-amount-btn-plus', function (e) {
            e.preventDefault();
            var propertyItems = $(this).closest('.basket-items-list-item-container').find('.basket-items-list-item-descriptions .basket-item-block-info .basket-item-block-properties .basket-item-property').length;
            if (propertyItems > 1 && propertyItems % 2 === 0) {
                var value = parseInt($(this).siblings('.basket-item-amount-filed-block').find('input.basket-item-amount-filed').val());
                $(this).siblings('.basket-item-amount-filed-block').find('input.basket-item-amount-filed').val(value + 1);
                $(this).siblings('.basket-item-amount-filed-block').find('input.basket-item-amount-filed').data('value', value + 1);
            }
        });
        */

        // Add to cart
        $(document).on('click', '[name="catalog-element-addtocart"]', function (e) {
            e.preventDefault();
            var form = $(this.form);
            shop.addToCart(form);
        });

        // Change #MySelect
        $(document).on('change', '#myselect', function () {
            var value = $(this).val();
            //$('#mydiv').html(value);
            $('#price_t').val(value);
            $('.catalog-element-price .price_new span.value').text(value);
            $('#ob22').val($(this).find('option:selected').text());
        });

        // Отключение ссылки на подарке
        $(document).on('click', '.basket-items-list-item-container[data-product-id="577"] .basket-item-image-link, .basket-items-list-item-container[data-product-id="577"] .basket-item-info-name-link', function () {
            return false;
        });

    },

    /**
     * Добавление товара в корзину.
     *
     * @param form
     */
    addToCart: function (form) {
        $.ajax({
            url: '/ajax/add_to_cart.php',
            method: 'post',
            data: form.serialize(),
            dataType: 'json',
        }).done(function (response) {
            var title = response.error ? 'Ошибка' : 'Корзина';
            var body = response.product
                ? '<div class="product"><div class="product-image"><a href="'+ response.product['url'] +'"><img src="'+ response.product['image'] +'" alt="'+ response.product['name'] +'"></a></div><div class="product-name">'+ response.product['name'] +'</div><div class="product-message">'+ response.message +'</div></div>'
                : response.message;
            var footer = '<a href="/personal/cart/" class="btn btn-primary">Перейти в корзину</a> &nbsp;&nbsp; <button class="btn-transparent" data-dismiss="modal">Вернуться к покупкам</button>'
            openInfoModal(title, body, footer);
            // Обновление корзины в навигации
            $('.navigation .bx-basket').load(window.location.href + ' .navigation .bx-basket');
        }).fail(function (error) {
            console.error(error);
        });

        // Обновление моб.корзины
        var counter = $('.navigation .bx-basket a').text();
        var res = counter.match(/(\d+)/g);
        $('.header--mobile--cart-counter').html(res[0]);

    },

};

shop.bindEvents();
