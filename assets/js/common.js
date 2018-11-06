jQuery.noConflict();

jQuery(function($) {
    $(document).on('click', '.sign-up-news', function () {
        console.log('test');
       $(document).find('.footer-newsletter').show();
    });
    $(document).on('click', '.footer-newsletter .fa-times-circle', function () {
        $(document).find('.footer-newsletter').hide();
    });
    function setCardBlockHeight(){
        var $this = $(document).find('.easl-card-block');
        var w = $this.width();
        $this.height( (w * 0.5625) + 'px');
    }
    setCardBlockHeight();
    $(window).resize(function () {
        setTimeout(function () {
            setCardBlockHeight();
        }, 1000);

    });

    $(document).on('click', '.easl-mentors-table-show-more.unshown', function (e) {
        e.preventDefault();
        $('.easl-mentors-table-row.old-rows').removeClass('hidden');
        $('.easl-mentors-table-show-more.unshown').removeClass('unshown').addClass('shown');
        $('.easl-mentors-table-show-more').find('.theme-button-inner').text('Show less');

    });
    $(document).on('click', '.easl-mentors-table-show-more.shown', function (e) {
        e.preventDefault();
        $('.easl-mentors-table-row.old-rows').addClass('hidden');
        $('.easl-mentors-table-show-more.unshown').removeClass('shown').addClass('unshown');
        $('.easl-mentors-table-show-more').find('.theme-button-inner').text('Show more');
    });

    $(document).on('click', '.national-associations-menu-item', function (e) {
        e.preventDefault();
        var cat = $(this).data('term');
        $('.national-associations-menu-item').removeClass('current-country');
        $(this).addClass('current-country');
        $.post(ajaxurl.ajaxurl, {
            'action': 'get_national_associations_func',
            'category': cat
        }, function (response) {
            $('.associations-content-block-response').html(response);
        });
    });

});