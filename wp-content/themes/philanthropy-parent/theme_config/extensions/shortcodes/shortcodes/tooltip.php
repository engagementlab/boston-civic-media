<?php
function tfuse_shortcode_tooltip($atts, $content = null)
{
    extract(shortcode_atts(array('pos' => '','toolt' => ''), $atts));
    
    return '<a href="#" data-toggle="tooltip" data-placement="'.$pos.'" title="'.$toolt.'" data-original-title="' . do_shortcode($content) . '">' . do_shortcode($content) . '</a>';
}

$atts = array(
    'name' => __('Tooltip','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Position','tfuse'),
            'desc' => __('Select tooltip position','tfuse'),
            'id' => 'tf_shc_tooltip_pos',
            'value' => 'h2',
            'options' => array(
                'top' => 'Top',
                'boottom' => 'Bottom',
                'right' => 'Right',
                'left' => 'Left'
            ),

            'type' => 'select'
        ),
        array(
            'name' => __('Tooltip','tfuse'),
            'desc' => __('Enter tooltip text','tfuse'),
            'id' => 'tf_shc_tooltip_toolt',
            'value' => '',
            'type' => 'textarea'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter tooltip content','tfuse'),
            'id' => 'tf_shc_tooltip_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('tooltip', 'tfuse_shortcode_tooltip', $atts);
