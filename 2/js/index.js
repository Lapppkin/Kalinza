(function($) {
    $('.accordion > li:eq(0) a.ttt333').addClass('active').next().slideDown();

    $('.accordion a.ttt333').click(function(j) {
        var dropDown = $(this).closest('li').find('div.main');

        $(this).closest('.accordion').find('div.main').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.accordion').find('a.ttt333 active').removeClass('active');
            $(this).addClass('active');
        }

        dropDown.stop(false, true).slideToggle();

        j.preventDefault();
    });
})(jQuery);