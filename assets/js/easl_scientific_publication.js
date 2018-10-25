jQuery.noConflict();

jQuery(function($) {
    $(document).on('change', ':input, :selected ', function () {
        $('.publication-filter').submit();
    });
});

