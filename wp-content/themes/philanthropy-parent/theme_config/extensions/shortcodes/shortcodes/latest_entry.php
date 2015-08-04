<?php
function tfuse_shortcode_latest_entry($atts, $content = null)
{
    
    $out = '';
    
    $recent_post = wp_get_recent_posts( array('numberposts' => 1) );
    
    if(!empty($recent_post))
    {
        foreach ($recent_post as $post) {
            $image = wp_get_attachment_url( get_post_thumbnail_id($post['ID'], 'post-thumbnails'));
            
            $get_image = new TF_GET_IMAGE();
            $img = $get_image->properties(array('class' => '', 'alt' => get_the_title($post['ID'])))->width(210)->height(210)->src($image)->resize(true)->get_img();
            
            $current_post = get_post( $post['ID'] );
            
        $out .= '
            <div class="home-post">
                <div class="inner">
                    <div class="entry-aside">
                        <header class="entry-header">
                            <div class="entry-meta">
                                <div class="cat-links">
                                    <a href="'.get_permalink($post['ID']).'">'.__('Latest blog entry','tfuse').'</a>
                                </div>
                                <time class="entry-date"><i class="icon-circle"></i>'.get_the_time( get_option('date_format'), $post['ID'] ).'</time>
                                <h1 class="entry-title">
                                    <a href="'.get_permalink($post['ID']).'">'.get_the_title($post['ID']).'</a>
                                </h1>
                            </div>
                        </header>';
                        if(!empty($image))
                            $out .= '<a class="post-thumbnail" href="'.get_permalink($post['ID']).'">'.$img.'</a>';
                        $out .='<div class="entry-content">
                            <p>';
                                if ( tfuse_options('post_content') == 'content' ) 
                                {
                                    $out .= $current_post->post_content; 
                                }
                                else
                                {
                                    $out .= (!empty($current_post->post_excerpt)) ? $current_post->post_excerpt : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150));
                                }
                        $out .='</p>
                        </div>
                        <footer class="entry-meta">
                            <a href="'.get_permalink($post['ID']).'" class="btn btn-transparent btn-lets-talk"><span>'.__('Read article','tfuse').' <i class="icon-chevron-right align-right-icon"></i></span></a>
                        </footer>
                    </div>
                </div>
            </div>';
        }
    }
    
    return $out;
}

$atts = array(
    'name' => __('Latest Entry','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        
    )
);

tf_add_shortcode('latest_entry', 'tfuse_shortcode_latest_entry', $atts);
