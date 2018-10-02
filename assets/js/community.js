jQuery.noConflict();

jQuery(function($) {
    $(document).on('click', '.easl-staff-list-block .vcex-staff-filter a', function (e) {
        e.preventDefault();
        var filter = $(this).data('filter');
        if(filter !== '*'){
            $('.easl-staff-list-block .vcex-staff-filter li').removeClass('active');
            $(this).parent().addClass('active');

            $('.easl-staff-list').hide();
            $(filter).show();
        } else {
            $('.easl-staff-list').show();
        }
    });

    $(document).on('click', '.staff-entry-media-link, .staff-entry-title.entry-title a', function (e) {
        e.preventDefault();
        var staff_id = $(this).data('target');
        $.post(ajaxurl.ajaxurl, {
            'action': 'get_staff_profile',
            'staff_id': staff_id
        }, function (response) {
            $('.easl-msc-content-wrap-inner').html(response);
        });
    });

    function get_governing_board_intro_para(item){
        $.post(ajaxurl.ajaxurl, {
            'action': 'get_intro_para_func',
            'category': item
        }, function (response) {
            $(document).find('.intro-para-wrapper').html(response);
        });

    }

    $(document).on('click', '#menu-community li a', function (e) {
        e.preventDefault();
        // $('#menu-community').find('li').each(function () {
        //    $(this).removeClass('current-menu-item');
        // });
        //$(this).closest('li.menu-item').addClass('current-menu-item');
        var item = $(this).data('item');
        get_governing_board_intro_para(item);
        if($(this).attr('href') !== '#'){
            window.location.href = $(this).attr('href');
        }




    });

    get_governing_board_intro_para($('.current-menu-item a').data('item'));


});