<?php

function tfuse_share_buttons($atts, $content = null) {

    extract(shortcode_atts(array( 'btn' => '','title' => '','link' => ''), $atts));
    
    $output = '';
    
    
    if($btn == 'fb')
    {
        $output .='<div class="facebook-share">
                        <h4>'.$title.'</h4>
                        <a href="'.$link.'" target="_blank"> <i class="icon-facebook"></i> '.__('Share','tfuse').'</a>
                </div>';
    }
    else
    {
        $output .='<div class="twetter-tweet">
                        <h4>'.$title.'</h4>
                        <a href="'.$link.'" target="_blank"> <i class="icon-twitter"></i> '.__('Follow','tfuse').'</a>
                </div>';
    }
    
    return $output;
}

$atts = array(
    'name' => __('Share','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_share_buttons_title',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_share_buttons_link',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('Select Button','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_share_buttons_btn',
            'value' => '',
            'options' => array('fb' => __('Facebook','tfuse'),'tw' => __('Twitter','tfuse')),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('share_buttons', 'tfuse_share_buttons', $atts);
