'use strict';

// Модальные окна

$('#modal-register').on('shown.bs.modal', function() {
    $("#modal-login").modal('hide');
    $('body').addClass('modal-open');
});

$('#modal-login').on('shown.bs.modal', function() {
    $("#modal-register").modal('hide');
    $('body').addClass('modal-open');
});

$('#modal-addtocart-done').on('shown.bs.modal', function() {
    $('#modal-addtocart').modal('hide');
});