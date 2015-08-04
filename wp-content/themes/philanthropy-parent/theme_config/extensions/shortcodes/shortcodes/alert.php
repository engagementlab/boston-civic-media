<?php
function tfuse_shortcode_alert($atts, $content = null)
{
    extract(shortcode_atts(array('class' => ''), $atts));
    
    return '<div class="alert '.$class.'">
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">&#215;</button>' . do_shortcode($content) . '
            </div>';
}

$atts = array(
    'name' => __('Alert Box','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('<b>Predefined classes:</b>alert-success, alert-info, alert-warning, alert-danger','tfuse'),
            'id' => 'tf_shc_alert_class',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter tooltip content','tfuse'),
            'id' => 'tf_shc_alert_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('alert', 'tfuse_shortcode_alert', $atts);
