/**
 * Отзывы.
 *
 * @author deadie
 */

// Открытие модалки
$(document).on('click', '.js-add-review', function () {
    var productNameDiv = $('.modal-product-name');
    var productId = $('.catalog-element-reviews').data('product-id');
    var form = $('#review-form');
    var modalW = $('#modal--review');

    productNameDiv.html($('h1').html());
    form.find('input[name="product_id"]').val(productId);
    modalW.modal('show').on('hide.bs.modal', function () {
        form.find('input[name="product_id"]').val('');
        productNameDiv.html('');
        form[0].reset();
        modalW.find('.modal-errors').slideUp().empty().removeClass('error, success');
    });
});

// Добавление отзыва
$(document).on('click', '#modal--review input[type="submit"]', function (e) {
    e.preventDefault();
    e.stopPropagation();
    var form = $(this)[0].form;
    $.ajax({
        url: '/ajax/add_review.php',
        method: 'post',
        data: $(form).serialize(),
        dataType: 'json'
    }).done(function (response) {
        var err = response.error != 'Y';
        var errClass = err ? 'success' : 'error';
        $('#modal--review .modal-errors').addClass(errClass).slideDown().html(response.message);
        if (err) form.reset();
    });
});
