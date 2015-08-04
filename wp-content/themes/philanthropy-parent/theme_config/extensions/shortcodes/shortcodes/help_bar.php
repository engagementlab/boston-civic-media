<?php

function tfuse_help_bar($atts, $content) {
    global $help_bar;
    
    $help_bar ='';
    extract(shortcode_atts(array('title' => ''), $atts));
    
    $get_help_bar= do_shortcode($content);
    
    $output = '';
    

    $z = 0; $c = 1;
    $output .= '<div class="help-bar">
                    <div class="container">
                        <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-2">
                                    <h1 class="title-help-bar">'.$title.'</h1>
                                </div>';

    while(isset($help_bar['item_title'][$z]))
    {
        if($c < 10) $c = '0'.$c;
        $output .='<div class="col-md-3 col-sm-3 col-xs-3">
                        <a href="'.$help_bar['link'][$z].'" class="link-help-bar">
                                <div class="help-bar-number">'.$c.'</div>
                                <span class="line-help-bar"></span>
                                <div class="title-link-help-bar">'.$help_bar['item_title'][$z].'</div>
                        </a>
                        <img src="'.$help_bar['image'][$z].'" alt="">
                    </div>';
        $z++; $c++;
    }
    
    $output .='</div></div></div>';
    
    return $output;
}

$atts = array(
    'name' => 'Help Bar',
    'desc' => 'Here comes some lorem ipsum description for the shortcode.',
    'category' => 4,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_help_bar_title',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => 'Item Title',
            'desc' => '',
            'id' => 'tf_shc_help_bar_item_title',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Image','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_help_bar_image',
            'value' => '',
           'properties' =>  array('class' => 'tf_shc_addable_1 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => 'Link',
            'desc' => '',
            'id' => 'tf_shc_help_bar_link',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_2 tf_shc_addable tf_shc_addable_last'),
            'type' => 'text'
        )

    )
);

tf_add_shortcode('help_bar', 'tfuse_help_bar', $atts);


function tfuse_help_bar_item($atts, $content = null)
{
    global $help_bar;
    extract(shortcode_atts(array('item_title' => '', 'image' => '', 'link' => ''), $atts));
    $help_bar['item_title'][] = $item_title;
    $help_bar['image'][] = $image;
    $help_bar['link'][] = $link;
}

$atts = array(
    'name' => 'Help Bar',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 3,
    'options' => array(
        array(
            'name' => 'Title',
            'desc' => '',
            'id' => 'tf_shc_help_bar_item_item_title',
            'value' => 'image',
            'type' => 'text'
        ),
        array(
            'name' => 'Image',
            'desc' => '',
            'id' => 'tf_shc_help_bar_item_image',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_help_bar_item_link',
            'value' => '',
            'type' => 'text'
        )
        
    )
);

add_shortcode('help_bar_item', 'tfuse_help_bar_item', $atts);