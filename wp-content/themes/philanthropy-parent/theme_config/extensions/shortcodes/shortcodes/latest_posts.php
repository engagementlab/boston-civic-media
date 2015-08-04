<?php
/**
 * Latest Posts
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * items:
 * title:
 * image_width:
 * image_height:
 * image_class:
 */

function tfuse_latest_post($atts, $content = null)
{
    remove_filter('excerpt_more', 'custom_excerpt_more');
    add_filter( 'excerpt_more', 'custom_excerpt_more_shortcode' );
    $return_html = '';
    extract(shortcode_atts(array(
                                'items' => 5,
                                'title' => 'Recent Posts',
                                'image_width' => 62,
                                'image_height' => 42,
                                'image_class' => 'post-thumbnail'
                           ), $atts));

    $latest_posts = tfuse_shortcode_posts(array(
                                               'sort' => 'recent',
                                               'items' => $items,
                                               'image_post' => true,
                                               'image_width' => $image_width,
                                               'image_height' => $image_height,
                                               'image_class' => $image_class
                                          ));
    $return_html .= '
    <div class="widget widget_recent_entries">';
         $return_html .= !empty($title) ? '<h3 class="widget-title">' . $title . '</h3>' : '';
    $return_html .= '<ul class="side-postlist">';
    foreach ($latest_posts as $post_val):
        $return_html .= '<li>';
        
        $return_html .= '<a href="' . $post_val['post_link'] . '" class="post-thumbnail">' . $post_val['post_img'] . '</a>';
        
        $return_html .= '<a href="' . $post_val['post_link'] . '" class="post-title">' . $post_val['post_title'] . '</a>';
        
        $return_html .= '<span class="comments-link"><a href="'.$post_val['post_link'].'#comments" >'.strtolower(strip_tags($post_val['post_comnt_numb_link'])).'</a></span>';
        
		
        $return_html .= '</li>';
    endforeach;
    $return_html .='</ul></div> ';

    return $return_html;
}

$atts = array(
    'name' => __('Latest Posts','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Specifies the number of the post to show','tfuse'),
            'id' => 'tf_shc_latest_posts_items',
            'value' => '5',
            'type' => 'text'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title for an shortcode','tfuse'),
            'id' => 'tf_shc_latest_posts_title',
            'value' => __('Recent Posts','tfuse'),
            'type' => 'text'
        ),
        array(
            'name' => __('Image Width','tfuse'),
            'desc' => __('Specifies the width of an thumbnail','tfuse'),
            'id' => 'tf_shc_latest_posts_image_width',
            'value' => '70',
            'type' => 'text'
        ),
        array(
            'name' => __('Image Height','tfuse'),
            'desc' => __('Specifies the height of an thumbnail','tfuse'),
            'id' => 'tf_shc_latest_posts_image_height',
            'value' => '70',
            'type' => 'text'
        ),
        array(
            'name' => __('Image Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode. To specify multiple classes,<br /> separate the class names with a space, e.g. <b>"left important"</b>.','tfuse'),
            'id' => 'tf_shc_latest_posts_image_class',
            'value' => 'thumbnail',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('latest_posts', 'tfuse_latest_post', $atts);
