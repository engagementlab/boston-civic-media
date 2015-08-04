<?php
function tfuse_shortcode_footer_menu($atts, $content = null)
{
    extract(shortcode_atts(array('title' => '','menu' => ''), $atts));
    
    $out = '';
    
    $items = wp_get_nav_menu_items( $menu ); 
   
    
    $out .='<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                <div class="widget widget-footer-menu">
                    <h3 class="widget-title">'.$title.'</h3>'
                 . '<ul>';
                foreach($items as $item)
                {
                    $out.='<li><a href="'.$item->url.'">'.$item->title.'</a></li>';
                }
            $out .='</ul></div>
        </div>';
            
    return $out;
}

$atts = array(
    'name' => __('Footer Menu','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_footer_menu_title',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Select Menu','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_footer_menu_menu',
            'value' => '',
            'options' => tfuse_get_menus(),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('footer_menu', 'tfuse_shortcode_footer_menu', $atts);
