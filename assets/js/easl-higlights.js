jQuery.noConflict();

jQuery(function($) {
    $(document).on('click', 'ul.vcex-filter-links li a.theme-button', function (e) {
        e.preventDefault();
        $('.vcex-filter-links li').removeClass('active');
        $(this).parent().addClass('active');
        var element = $('ul.current-filter li.current-active');
        element.removeClass('viral-hepatitis');
        element.removeClass('cirrhosis');
        element.removeClass('metabolic');
        element.removeClass('cholestatic');
        element.removeClass('liver-tumors');
        element.removeClass('general-hepatology');
        element.removeClass('all-topic');

        element.addClass($(this).data('bgclass'));

        $('ul.current-filter li.current-active a:first').html($(this).html());
        
        var filter = $(this).data('filter');

        if (filter !== '*') {
            //$('.easl-staff-list').hide();
            $(filter).show();
        } else {
            //$('.easl-staff-list').show();
        }
    });
});