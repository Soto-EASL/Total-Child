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
});