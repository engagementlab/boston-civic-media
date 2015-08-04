<?php

/**
 * Columns
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * type: 1, 1_2, 1_3, 1_4, 2_3 etc.
 * class:

 */

function tfuse_col($atts, $content = null)
{
    extract(shortcode_atts(array('type' => '1','class' => ''), $atts));
    return '<div class="col-md-' . $type . '  '.$class.'">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => __('Columns','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the button shortcode.','tfuse'),
    'category' => 4,
    'options' => array(
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Select column type','tfuse'),
            'id' => 'tf_shc_col_type',
            'value' => '',
            'options' => array(
                '12' => __('One column','tfuse'),
                '6' => __('One half column (1/2)','tfuse'),
                '4' => __('One third column (1/3)','tfuse'),
                '3' => __('A fourth column (1/4)','tfuse'),
                '8' => __('Two thirds column (2/3)','tfuse'),
                '9' => __('Three fourths column (3/4)','tfuse'),
            ),
            'type' => 'select'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Additional class','tfuse'),
            'id' => 'tf_shc_col_class',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_col_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('col', 'tfuse_col', $atts);
