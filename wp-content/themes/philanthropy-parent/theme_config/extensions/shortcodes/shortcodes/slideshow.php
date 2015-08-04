<?php
/**
 * Slide Show
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 * Optional arguments:
 * width:
 * height:
 *
 * Slides documentation http://slidesjs.com/
 */

function tfuse_slideshow($atts, $content) {
    global $slide;
    $slide='';
    extract(shortcode_atts(array('type_size' => ''), $atts));
    $get_slideshow = do_shortcode($content);
    $uniq = rand(1, 400);
    $i = 0;
    $output = '<div class="slider slider_'.$type_size.'">
        <div class="slider_container clearfix" id="slider'.$uniq.'">';
    while (isset($slide['type'][$i])) {
        if( $slide['type'][$i]=='image' )
        {
            if($type_size=='medium'){
                $width = 600;
                $height = 338;
            }
            elseif($type_size=='small'){
                $width = 430;
                $height = 242;
            }
            else{
                $width = 240;
                $height = 135;
            }
            $output .= '<div class="slider-item" ><img src="'.$slide['content'][$i].'" style="width:'.$width.'px;height:'.$height.'px !important;" /></div>';
        }
        else $output .= ' <div class="slider-item"><div class="inner">'.$slide['content'][$i].'</div></div>';
        $i++;
    }
    $output .= '</div>
            <div class="slider_pagination" id="slider'.$uniq.'_pag"></div>
        </div>
        <script>
            jQuery(document).ready(function($) {
                jQuery("#slider'.$uniq.'").carouFredSel({
                    pagination : "#slider'.$uniq.'_pag",
                        respononsive: true,
                    infinite: false,
                    auto: false,
                    width: "auto",
                    items: 1,
                    scroll: {
                        fx: "fade",
                        duration: 200
                    }
                });
            });
        </script>';
    return $output;
}

$atts = array(
    'name' => 'Slideshow',
    'desc' => 'Here comes some lorem ipsum description for the shortcode.',
    'category' => 4,
    'options' => array(
        array(
            'name' => 'Size Type',
            'desc' => 'Select size of the slideshow',
            'id' => 'tf_shc_slideshow_type_size',
            'value' => 'medium',
            'options' => array(
                'medium' => 'Medium',
                'small' => 'Small',
                'mini' => 'Mini',
            ),
            'type' => 'select'
        ),
        array(
            'name' => 'Type',
            'desc' => '',
            'id' => 'tf_shc_slideshow_type',
            'value' => 'image',
            'options' => array(
                'image' => 'Image',
                'text' => 'Text'
            ),
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'select'
        ),
        array(
            'name' => 'Content',
            'desc' => '',
            'id' => 'tf_shc_slideshow_content',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable tf_shc_addable_last'),
            'type' => 'text'
        )

    )
);

tf_add_shortcode('slideshow', 'tfuse_slideshow', $atts);


function tfuse_slide($atts, $content = null)
{
    global $slide;
    extract(shortcode_atts(array('type' => '', 'content' => ''), $atts));
    $slide['type'][] = $type;
    $slide['content'][] = $content;
}

$atts = array(
    'name' => 'Slide',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 3,
    'options' => array(
        array(
            'name' => 'Type',
            'desc' => '',
            'id' => 'tf_shc_slide_type',
            'value' => 'image',
            'options' => array(
                'image' => 'Image',
                'text' => 'Text'
            ),
            'type' => 'select'
        ),
        array(
            'name' => 'Content',
            'desc' => '',
            'id' => 'tf_shc_slide_content',
            'value' => '',
            'type' => 'text'
        )
    )
);

add_shortcode('slide', 'tfuse_slide', $atts);
