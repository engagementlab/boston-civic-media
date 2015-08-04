<?php

/**
 * Testimonials
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * title:
 * order: RAND, ASC, DESC
 */
function tfuse_testimonials($atts, $content = null) {
    global $testimonials_uniq;
    extract(shortcode_atts(array( 'order ' => 'RAND','type'=> ''), $atts));
    
    if($type == 'boxed') $t = 'quoteBox';
    else $t = '';
    
    $slide = $nav = $single = '';
    $title = $output = '';
    $testimonials_uniq = rand(1, 300);

    if (!empty($order) && ($order == 'ASC' || $order == 'DESC'))
        $order = '&order=' . $order;
    else
        $order = '&orderby=rand';

    $posts = get_posts('post_type=testimonials&posts_per_page=-1' . $order);
    $k = 0;   
    if(!empty($posts))
    {
    foreach($posts as $post){          
            $k++;
            $id = get_the_ID();
            $slide .= '
                <div class="slider-item">
                	<div class="quote-text">'.strip_tags(apply_filters('the_content',$post->post_content)). '</div>
                    <div class="quote-author">' . $post->post_title . '</div>                 
                </div>
        ';
    } // End IF Statement

    $output = '
    <div class="slider slider_quotes '.$t.'">
            <div class="slider_container" id="testimonials'.$testimonials_uniq.'"> 
        ' . $slide . '
        </div>
        <a class="prev" id="testimonials'.$testimonials_uniq.'_prev" href="#"><span class="icon-chevron-left"></span></a>
        <a class="next" id="testimonials'.$testimonials_uniq.'_next" href="#"><span class="icon-chevron-right"></span></a>
    </div> 
    <script>
            jQuery(document).ready(function($) {
                jQuery("#testimonials'.$testimonials_uniq.'").carouFredSel({
                    next : "#testimonials'.$testimonials_uniq.'_next",
                    prev : "#testimonials'.$testimonials_uniq.'_prev",
                    responsive: true,
                    infinite: false,
                    items: 1,
                    auto: false,
                    scroll: {
                        items : 1,
                        fx: "crossfade",
                        easing: "linear",
                        duration: 300
                    }
                });
            });	
    </script>  ';
    }
    return $output;
}

$atts = array(
    'name' => __('Testimonials','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Order','tfuse'),
            'desc' => __('Select display order','tfuse'),
            'id' => 'tf_shc_testimonials_order',
            'value' => 'DESC',
            'options' => array(
                'RAND' => __('Random','tfuse'),
                'ASC' => __('Ascending','tfuse'),
                'DESC' => __('Descending','tfuse')
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Select testimonial type','tfuse'),
            'id' => 'tf_shc_testimonials_type',
            'value' => '',
            'options' => array(
                'simple' => __('Simple','tfuse'),
                'boxed' => __('Boxed','tfuse')
            ),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('testimonials', 'tfuse_testimonials', $atts);
