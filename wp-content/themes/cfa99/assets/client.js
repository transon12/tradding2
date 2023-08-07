(function(jQuery) {
    jQuery(document).on('click','.code',function(){
        console.log('aaa')
        var data=jQuery(this).find('.code_stocks').text();
        jQuery('.showstocks').click();
        setTimeout(function(){
            new FireAnt.QuoteWidget({
                "container_id": "fan-quote-520",
                "symbols": data,
                "locale": "vi",
                "price_line_color": "#71BDDF",
                "grid_color": "#999999",
                "label_color": "#999999",
                "width": "100%",
                "height": "300px"
            });
        
        },1000);
    } )
    jQuery(document).on('click','.item-code-btn', async function(){
        var code = jQuery(this).attr('data-code');
        jQuery('#sidebar-chart iframe').attr('src','https://info.sbsi.vn/chart/?symbol='+code+'&language=vi&theme=light');
        console.log('code ----',code)
        
    });
   

})(jQuery);


jQuery(document).ready(function() {
    var ulNewsWrapperWidth = jQuery(".news-wrapper .inner ul").width();
    var marqueeWidth = ulNewsWrapperWidth + 1000;

        var secondNewsWrapper = parseInt((marqueeWidth - 1000) / 30) + 's';
        jQuery(".news-wrapper .inner ul").css({
            'animation': 'n-carousel ' + secondNewsWrapper + ' linear infinite',
            '-webkit-animation': 'n-carousel ' + secondNewsWrapper + ' linear infinite'
        });
        jQuery.keyframe.define([{
            name: 'n-carousel',
            '100%': {
                '-webkit-transform': "translate3d(-" + marqueeWidth + "px,0,0)",
                'transform': "translate3d(-" + marqueeWidth + "px,0,0)"
            }
        }]);
    
    jQuery(".news-wrapper .inner ul").mouseover(function() {
        jQuery(this).css({
            '-webkit-animation-play-state': 'paused',
            'animation-play-state': 'paused'
        });
    });
    jQuery(".news-wrapper .inner ul").hover(function() {
        jQuery(this).css({
            '-webkit-animation-play-state': 'running',
            'animation-play-state': 'running'
        });
    });
});