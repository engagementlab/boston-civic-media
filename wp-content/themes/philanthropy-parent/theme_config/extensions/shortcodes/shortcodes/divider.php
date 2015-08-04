<?php

/**
 * Divider Styles
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * type: space, space_thin, dots, dots_full, thin  
 */

function tfuse_divider($atts)
{


    return '<div class="divider_line"></div>';
}

$atts = array(
    'name' => __('Dividers', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for this shortcode.', 'tfuse'),
    'category' => 9,
    'before_preview' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
    'after_preview' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
    'options' => array(
    )
);

tf_add_shortcode('divider', 'tfuse_divider', $atts);

