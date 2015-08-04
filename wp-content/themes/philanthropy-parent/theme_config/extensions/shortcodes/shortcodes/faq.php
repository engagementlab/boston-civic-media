<?php

function tfuse_faq($atts, $content = null) {

    extract(shortcode_atts(array( 'post' => ''), $atts));
    
    $output = '';
    
    $post = explode(',', $post);
    
    $query = new WP_Query( array( 'posts_per_page' => -1,'post_type' => 'faq', 'post__in' => $post ) );
    $posts = $query->get_posts();
    
    if(!empty($posts))
    {
        foreach($posts as $post){
            $btn_title = tfuse_page_options('btn_title','',$post->ID);
            
            $output .='<div class="faq-article clearfix">
                            <div class="col-md-8 col-sm-7 col-xs-7 text">
                                <h2>Q: '.$post->post_title.'</h2>
                                <p>'.$post->post_content.'</p>
                            </div>';
                            if(!empty($btn_title))
                                $output .='<div class="col-md-3 col-md-offset-1 col-sm-5 col-xs-5 faq-button">
                                            <a href="'.tfuse_page_options('btn_link','',$post->ID).'" class="btn btn-yellow btn-donate-faq"><span>'.$btn_title.'</span></a>
                                        </div>';
                        $output .='</div>';
        } // End IF Statement
    }
    return $output;
}

$atts = array(
    'name' => __('Faq','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Select FAQ Post','tfuse'),
            'desc' => __('Select FAQ Post','tfuse'),
            'id' => 'tf_shc_faq_post',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'faq'
        )
    )
);

tf_add_shortcode('faq', 'tfuse_faq', $atts);
