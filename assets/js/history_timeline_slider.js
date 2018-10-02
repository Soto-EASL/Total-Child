jQuery.noConflict();

jQuery(function($) {
    $().timelinr({
        arrowKeys: 'true',
        autoPlay: 'false',
        autoPlayDirection: 'forward',
        orientation: 'horizontal'
    });
    $(document).find('.vc_column-inner:has(.EASL-Secretary-Generals)').css('margin-bottom',0);
    $(document).find('.EASL-Secretary-Generals .owl-stage-outer').css('margin-bottom','-20px');
    $(document).find('.EASL-Secretary-Generals .wpex-carousel-entry-media').css('padding-bottom', 0);

    function set_issues_list_width() {
        var wpb_wrapper_width = $('.wpb_wrapper').width();
        if( wpb_wrapper_width >= 768){
            $('#issues li').css('width', wpb_wrapper_width / 2);
        } else {
            $('#issues li').css('width', wpb_wrapper_width);
        }

    }
    set_issues_list_width();
    $( window ).resize(function() {
        setTimeout(function () {
            set_issues_list_width();
        }, 2000);

    });



    var minValue = 1;
    var maxValue = $( ".slider-frame-points" ).size();
    var handle = $( "#custom-handle" );
    var slider = $( "#slider" ).slider({
        min: minValue,
        max: maxValue,
        range: "max",
        value: 1,
        create: function() {
            handle.text('');
        },
        slide: function( event, ui ) {
            document.getElementsByClassName('slider-frame-points')[ui.value - 1].children[0].click();
            var text = '';
            var selected_el = $('#dates a.selected').parent().data('year');
            if( (maxValue !== ui.value) && (minValue !== ui.value) ){
                text = selected_el;
            }
            handle.text( text );
        }
    });

    $(document).on('click', '#next', function(){
        var current_value = slider.slider( "value");
        var next_value = current_value + 1;
        var text = '';
        var selected_el = $('#dates li:eq('+current_value+')').data('year');

        if( next_value !== maxValue){
            text = selected_el;
        }
        $('#custom-handle').text(text);
        slider.slider( "value", next_value );
    });

    $(document).on('click', '#prev', function(){
        var current_value = slider.slider( "value");
        var prev_value = current_value - 1;
        var text = '';
        var selected_el = $('#dates li:eq('+(prev_value-1)+')').data('year');

        if( prev_value !== 1){
            text = selected_el;
        }

        $('#custom-handle').text(text);
        slider.slider( "value", prev_value );
    });

});


