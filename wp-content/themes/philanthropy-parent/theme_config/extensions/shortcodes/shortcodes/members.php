<?php

function tfuse_members($atts, $content = null) {

    extract(shortcode_atts(array( 'post' => ''), $atts));
    
    $output = '';
    
    $post = explode(',', $post);
    
    $query = new WP_Query( array( 'posts_per_page' => -1,'post_type' => 'member', 'post__in' => $post ) );
    $posts = $query->get_posts();
    
    if(!empty($posts))
    {
        $output .='<div class="our-team">';
        foreach($posts as $post){
            $job = tfuse_page_options('job','',$post->ID);
            
            $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
            
            if(!empty($image))
                $image = TF_GET_IMAGE::get_src_link($image, 270, 270);
            
            $output .='<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="image-our-team">
                                <img src="'.$image.'" alt="'.$post->post_title.'">
                            </div>
                            <h3>'.$post->post_title.'</h3>
                            <span class="function">'.$job.'</span>
                        </div>';
        }
        $output .='</div>';
    }
    return $output;
}

$atts = array(
    'name' => __('Members','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Select Member Post','tfuse'),
            'desc' => __('Select Member Post','tfuse'),
            'id' => 'tf_shc_members_post',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'member'
        )
    )
);

tf_add_shortcode('members', 'tfuse_members', $atts);
