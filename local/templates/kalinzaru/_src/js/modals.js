'use strict';

// Модальные окна

// $('#modal-register').on('shown.bs.modal', function() {
//     $("#modal-login").modal('hide');
//     $('body').addClass('modal-open');
// });
//
// $('#modal-login').on('shown.bs.modal', function() {
//     $("#modal-register").modal('hide');
//     $('body').addClass('modal-open');
// });
//
// $('#modal-addtocart-done').on('shown.bs.modal', function() {
//     $('#modal-addtocart').modal('hide');
// });


(function () {

    // Старая функция вызова модальных окон
    $(document).on('click', '.js-button-modal', function () {
        var modal = $(this).data('modal');
        $('#' + modal)
            .addClass('active')
            .find('.modal').addClass('active');
    });

    $(document).on('click', '.close-modal', function () {
        $(this)
            .parent().removeClass('active')
            .parent().removeClass('active');
    });

})();

/**
 * Ручное окрытие окна авторизации.
 */
function openAuthModal() {
    $('#modal--auth').modal('show');
}

/**
 * Информационное окно.
 *
 * @param title
 * @param body
 * @param footer
 */
function openInfoModal (title, body, footer) {
    $('#modal--info-title').text(title);
    $('#modal--info-body').html(body);
    $('#modal--info-footer').html(footer);
    $('#modal--info').modal('show').on('hidden.bs.modal', function (e) {
        $('#modal--info-title, #modal--info-body, #modal--info-footer').empty();
    });
}

/**
 * Предпросмотр товара в модальном окне.
 *
 * @param product_id
 */
function openPreviewModal (product_id) {
    $.ajax({
        url: '/ajax/preview.php',
        method: 'post',
        data: {
            product_id: product_id
        },
        dataType: 'html'
    }).done(function (response) {
        $('#preview-body').html(response);
        $('#modal--preview').modal('show');
    }).fail(function (error) {
        console.log(error);
    });
}
