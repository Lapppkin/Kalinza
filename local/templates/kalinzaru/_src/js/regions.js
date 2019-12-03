'use strict';

var regions = {

    bindEvents: function () {

        $(document).on('change', '.js-choose-region', function (e) {
            e.preventDefault();
            var form = $(this)[0].form;

            regions.sendForm(form);

        });

    },

    sendForm: function (form) {
        $.ajax({
            url: '/ajax/choose_region.php',
            method: 'post',
            data: $(form).serialize(),
            dataType: 'json',
        }).done(function (response) {

            if (!response.error) {
                location.reload();
            }

        }).fail(function (error) {
            console.error(error);
        });
    }

};

regions.bindEvents();
