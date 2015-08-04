<?php
function tfuse_shortcode_latest_post($atts, $content = null)
{
    
    $out = '';
    
    $recent_post = wp_get_recent_posts( array('numberposts' => 1) );
    
    if(!empty($recent_post))
    {
        foreach ($recent_post as $post) {
            $image = wp_get_attachment_url( get_post_thumbnail_id($post['ID'], 'post-thumbnails'));
            
            $get_image = new TF_GET_IMAGE();
            $img = $get_image->properties(array('class' => '', 'alt' => get_the_title($post['ID'])))->width(210)->height(82)->src($image)->resize(true)->get_img();
            
            $current_post = get_post( $post['ID'] );
            $user_data = get_user_by('id',$current_post->post_author);
            
            
        $out .= '<article class="post">
                    <h2 class="entry-title"><a href="'.get_permalink($post['ID']).'">'.get_the_title($post['ID']).'</a></h2>
                    <div class="entry-meta">
                        <time class="entry-date" datetime="">'.get_the_time( get_option('date_format'), $post['ID'] ).'</time>
                        <span class="author"> '.__('by','tfuse').' <a href="'.get_author_posts_url( $current_post->post_author, $user_data->data->user_nicename ).'">'.$user_data->data->user_nicename.'</a></span>
                    </div>
                    <span class="post-thumbnail">';
                        if(!empty($image))
                            $out .= $img;
                    $out .='</span>
                    <div class="entry-content"><p>';
                        if ( tfuse_options('post_content') == 'content' ) 
                        {
                            $out .= $current_post->post_content; 
                        }
                        else
                        {
                            $out .= (!empty($current_post->post_excerpt)) ? $current_post->post_excerpt : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150));
                        }
                    $out .='</p></div>
                    <footer class="entry-meta">
                        <a href="'.get_permalink($post['ID']).'" class="btn btn-yellow"><span>'.__('find out more','tfuse').'</span></a>
                    </footer>
                </article>';
        }
    }
    
    return $out;
}

$atts = array(
    'name' => __('Latest Post','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        
    )
);

tf_add_shortcode('latest_post', 'tfuse_shortcode_latest_post', $atts);
