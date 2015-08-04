<?php

/**
 * Quotes
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * author: e.g. MARISSA DOE
 * profession: e.g. MARKETING MANAGER
 */

function tfuse_blockquote_box($atts, $content = null) {
    return '<div class="frame_quote"><blockquote>' . do_shortcode($content) . '</blockquote></div>';
}

$atts = array(
    'name' => __('Blockquote Box','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_blockquote_box_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('blockquote_box', 'tfuse_blockquote_box', $atts);

function tfuse_reverse_quote($atts, $content = null) {
    return '<blockquote class="blockquote-reverse">' . do_shortcode($content) . '</blockquote>';
}

$atts = array(
    'name' => __('Reverse Quote','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_reverse_quote_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('reverse_quote', 'tfuse_reverse_quote', $atts);

function tfuse_quote_right($atts, $content = null) {
    return '<div class="quote_right"><blockquote>' . do_shortcode($content) . '</blockquote></div>';
}

$atts = array(
    'name' => __('Quote Right','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_quote_right_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_right', 'tfuse_quote_right', $atts);

function tfuse_quote_left($atts, $content = null) {
    return '<div class="quote_left"><blockquote>' . do_shortcode($content) . '</blockquote></div>';
}

$atts = array(
    'name' => __('Quote Left','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' =>__('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_quote_left_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_left', 'tfuse_quote_left', $atts);


function tfuse_blockquote($atts, $content = null)
{
    return '<blockquote>' . do_shortcode($content) . '</blockquote>';
}

$atts = array(
    'name' => __('BlockQuote','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_blockquote_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('blockquote', 'tfuse_blockquote', $atts);
