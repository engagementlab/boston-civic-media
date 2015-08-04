<?php

function tfuse_press($atts, $content = null) {

    extract(shortcode_atts(array( 'post' => ''), $atts));
    
    $output = '';
    
    $post = explode(',', $post);
    
    $query = new WP_Query( array( 'posts_per_page' => -1,'post_type' => 'press', 'post__in' => $post ) );
    $posts = $query->get_posts();
    
    if(!empty($posts))
    {
        $output .='<div class="wrap-press">';
        foreach($posts as $post){
            $link = tfuse_page_options('link','',$post->ID);
            $source = tfuse_page_options('source','',$post->ID);
            
            $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                                   
            $output .='<a href="'.$link.'" class="press-article" style="background: url(\''.$image.'\') no-repeat">
                                <h3>'.$post->post_title.'</h3>
                                <div class="divider"></div>
                                <p>'.$post->post_content.'</p>
                                <span>'.$source.'</span>
                        </a>';
        }
        $output .='</div>';
    }
    return $output;
}

$atts = array(
    'name' => __('Press Posts','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Select Press Post','tfuse'),
            'desc' => __('Select Press Post','tfuse'),
            'id' => 'tf_shc_press_post',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'press'
        )
    )
);

tf_add_shortcode('press', 'tfuse_press', $atts);
