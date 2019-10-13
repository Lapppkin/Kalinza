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

// Ручное окрытие окна авторизации
function openAuthModal() {
    $('#modal--auth').modal('show');
}
