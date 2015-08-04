<?php

function tfuse_projects($atts, $content = null) {

    extract(shortcode_atts(array( 'post' => ''), $atts));
    
    $output = '';
    $uniq = rand(1,100);
    
    $post = explode(',', $post);
    
    
    $query = new WP_Query( array( 'posts_per_page' => -1,'post_type' => 'project','orderby' => 'post__in', 'post__in' => $post ) );
    $posts = $query->get_posts();
        
    if(!empty($posts))
    {
        $output .='<div class="recent-slider">
			<ul id="recent-slider'.$uniq.'">';
        foreach($posts as $post){            
            $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
            
            if(!empty($image))
                $image = TF_GET_IMAGE::get_src_link($image, 285, 326);
            
            $current_post = get_post( $post->ID);
            
            $output .='<li data-recentslider1="1">
                            <div class="recent-slider-text">
                                    <h3 class="title"><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h3>
                                    <div class="line-title-sldier"></div>
                                    <div class="recent-slider-description">';
                                        if ( tfuse_options('post_content') == 'content' ) 
                                        {
                                            $output .= $current_post->post_content; 
                                        }
                                        else
                                        {
                                            $output .= (!empty($current_post->post_excerpt)) ? $current_post->post_excerpt : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150));
                                        }
                        $output .='</div>
                            </div>
                            <div class="recent-slider-image">
                                <a href="'.get_permalink($post->ID).'" class="recent-slider-thumbnail"><span>'.__('More','tfuse').'</span></a>
                                <img src="'.$image.'" >
                            </div>
                        </li>';
        }
        $output .='</ul>
                    <div id="recent-slider'.$uniq.'-controls" class="recent-slider-controls"></div>

                    <a id="recent-slider'.$uniq.'-prev" class="prev" href="#">prev</a>
                    <a id="recent-slider'.$uniq.'-next" class="next" href="#">next</a>

                </div>';
        
        $output .='
                 <script>
                   jQuery(document).ready(function(){
                        
                        function recentsliderInit() {
                                jQuery("#recent-slider'.$uniq.'").carouFredSel({
                                    swipe : {
                                            onTouch: true
                                    },
                                    next : "#recent-slider'.$uniq.'-next",
                                    prev : "#recent-slider'.$uniq.'-prev",
                                    pagination : "#recent-slider'.$uniq.'-controls",
                                    infinite: false,
                                    items: 1,
                                    auto: {
                                            play: false,
                                            timeoutDuration: 0
                                    },
                                    scroll: {
                                            items : 1,
                                            fx: "crossfade",
                                            easing: "linear",
                                            pauseOnHover: true,
                                            duration: 300
                                    }
                                    });
				}

				recentsliderInit();
				jQuery(window).resize(function() {
					recentsliderInit();
				});

				var tControlsHeight = jQuery(".recent-slider-controls").innerHeight();
				jQuery(".recent-slider-controls").css("margin-top" , -tControlsHeight/2);
                                
                        //Script align center the text for two mini slider
                        var caroufredsel_wrapper = jQuery(".caroufredsel_wrapper");
                        var recent_slider_text = jQuery(".recent-slider-text");
                        caroufredsel_wrapper.each(function(){
                            hei1 = jQuery(this).height(); 
                            recent_slider_text.each(function(){
                                hei2 = jQuery(this).height();
                                jQuery(this).css({
                                    "padding-top" :hei1/2-hei2/2
                                });
                            });

                        });

                   });
                </script>
            ';
    }
    return $output;
}

$atts = array(
    'name' => __('Project','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Select Project Post','tfuse'),
            'desc' => __('Select Project Post','tfuse'),
            'id' => 'tf_shc_projects_post',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'project'
        )
    )
);

tf_add_shortcode('projects', 'tfuse_projects', $atts);
