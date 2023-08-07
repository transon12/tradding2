<?php

function readmore_ux_builder_element() {

    $options =  array(
        'heading'    =>  array(
            'type' => 'textfield',
            'heading' => 'Tiêu đề',
            'default' => '',       
        ),
        'content_readmore' => array(
            'type'       => 'textarea',
            'heading' => 'Nội dung',
          ),
    );

    add_ux_builder_shortcode('readmore_stocks_shortcode', array(
        'name' => __('Xem thêm nội dung'),
        'category' => __('A2Z Content'),
        'priority' => 1,
        'options' => $options,
    ));
}

add_action('ux_builder_setup', 'readmore_ux_builder_element');


function readmore_stocks_shortcode($atts)
{
    extract(shortcode_atts(array(
        'heading'          => '',
        'content_readmore' => '',
      ), $atts));
   
    ob_start();
    
    ?>
    <script>
        (function($){
            $(document).ready(function(){
                $(".content-faq a.readmore").click(function(){
                    $(this).parent('p.more').first().hide();
                    $(this).parent().next().show();
                });
                $(".content-faq a.readmore-1").click(function(){
                    $(this).parent('p.full').first().hide();
                    $(this).parent().prev().show();
                });
            });
        })(jQuery);
    </script>
        <?php
            if($heading){
                echo '<h3 class="title-faq">';
                    echo $heading;
                echo '</h3>';
            } 
            if($content_readmore){
                $length = strlen($content_readmore);
                if($length > 120){
                    $more = '<a class="readmore" data-id>Xem thêm</a>';
                    $full = '<a class="readmore-1" >Rút gọn</a>';
                }
                echo '<div class="content-faq">';
                    echo '<p class="more">'.substr_replace($content_readmore, "...", 120).'.'.$more.'</p>';
                    echo '<p class="full" style="display:none;">'.$content_readmore.' '.$full.'</p>';
                echo '</div>';
            } 
            
        ?>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('readmore_stocks_shortcode', 'readmore_stocks_shortcode');