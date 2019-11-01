'use strict';

/**
 * @type {{addtocart: shop.addtocart}}
 */
var shop = {

    /**
     * Add event listeners.
     */
    eventListeners: function () {

        // Add to cart
        $(document).on('click', '.modal .catalog-element-addtocart input', function (e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            var quantity = $(this).data('quantity');
            shop.addtocart(product_id, quantity);
        });

        // Quantity
        $(document).on('click', '.quan', function () {
            let step = $('input#box-1').is(':checked') ? 1 : 2;
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

    },

    /**
     * Добавление товара в корзину.
     *
     * @param product_id
     * @param quantity
     */
    addtocart: function (product_id, quantity) {
        $.ajax({
            url: '/ajax/add_to_cart.php',
            method: 'post',
            data: {
                product_id: product_id,
                quantity: quantity
            },
        }).done(function (response) {
            var title = !response ? 'Корзина' : 'Ошибка';
            var body = !response ? 'Товар добавлен в корзину.' : 'Ошибка при добавлении товара в корзину.';
            openInfoModal(title, body);
        }).fail(function (error) {
            console.error(error);
        });
    },

};

shop.eventListeners();
