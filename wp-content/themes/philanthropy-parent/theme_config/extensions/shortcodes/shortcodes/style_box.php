<?php
//Style Box
function tfuse_styled_box($atts, $content = null) {

    //extract short code attr
    extract(shortcode_atts(array(
        'title' => '',
        'class' => '',
        'footer' => '',
        'icon' => ''
    ), $atts));

    $return_html = '<div class="panel '.$class.'">';
        if(!empty($title))
            $return_html .= '<div class="panel-heading"><i class="'.$icon.'"></i>'.$title.'</div>';
    $return_html.= '<div class="panel-body">'.html_entity_decode(do_shortcode($content)).'</div>';
        if(!empty($footer))
            $return_html .= '<div class="panel-footer">'.$footer.'</div>';
    $return_html .= '</div>';

    return $return_html;
}

$atts = array(
    'name' => __('Styled Box','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 7,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Text to display above the box','tfuse'),
            'id' => 'tf_shc_styled_box_title',
            'value' => __('Styled box', 'tfuse'),
            'type' => 'text'
        ),
        array(
            'name' => __('Footer text','tfuse'),
            'desc' => __('Text to display beneath the box','tfuse'),
            'id' => 'tf_shc_styled_box_footer',
            'value' => __('', 'tfuse'),
            'type' => 'text'
        ),
        array(
            'name' => __('Icon Class','tfuse'),
            'desc' => __('Specify a class for icon, ex:icon-home , icon-thumbs-up','tfuse'),
            'id' => 'tf_shc_styled_box_icon',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Specify a class for an shortcode, ex:panel-default, panel-primary, panel-success, panel-info,
                        panel-warning, panel-danger, panel-pink, panel-teal, panel-purple, panel-orange, panel-brown,
                          panel-black','tfuse'),
            'id' => 'tf_shc_styled_box_class',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_styled_box_content',
            'value' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','tfuse'),
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('styled_box', 'tfuse_styled_box', $atts);

?>