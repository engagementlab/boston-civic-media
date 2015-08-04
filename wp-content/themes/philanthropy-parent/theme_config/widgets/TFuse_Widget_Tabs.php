<?php

// =============================== Search widget ======================================

class TFuse_Widget_Tabs extends WP_Widget {

	function TFuse_Widget_Tabs() {
            $widget_ops = array('classname' => 'widget_tabs', 'description' => __( "Game posts","tfuse") );
            $this->WP_Widget('tabs', __('TFuse Tabs','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
            extract($args); $rating = array();
            $numb = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Search','tfuse' ) : $instance['title'], $instance, $this->id_base);
            ?>
            <?php
                $recent_posts  = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'recent',
                                'items' => 5,
                                'image_post' => true,
                                'image_width' => 80,
                                'image_height' => 80,
                                'image_class' => ''
                                ));
        
                $popular_posts = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'popular',
                                'items' => 5,
                                'image_post' => true,
                                'image_width' => 80,
                                'image_height' => 80,
                                'image_class' => ''
                            ));

                $commented_posts = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'commented',
                                'items' => 5,
                                'image_post' => true,
                                'image_width' => 80,
                                'image_height' => 80,
                                'image_class' => ''
                            ));
                
                $return_html = '';
                $return_html .='<div class="widget widget_tabs">
                    <ul class="nav nav-tabs nav-justified clearfix active_bookmark1">
                        <li class="active"><a href="#tab_cont_1_1" data-toggle="tab">'.__('Popular','tfuse').'</a></li>
                        <li><a href="#tab_cont_1_2" data-toggle="tab">'.__('Latest','tfuse').'</a></li>
                        <li><a href="#tab_cont_1_3" data-toggle="tab">'.__('Comments','tfuse').'</a></li>
                    </ul><div class="tab-content clearfix">';

                $return_html .= '<div id="tab_cont_1_1" class="tab-pane fade in active">
                                <ul class="side-postlist">';
                                   $k=0; foreach ($popular_posts as $post_val) { 
                                        if($k == $numb) break;

                                        $return_html .= '<li>';
                                        if(!empty($post_val['post_img']))
                                            $return_html .= ' <a href="' . $post_val['post_link'] . '" class="post-thumbnail">' . $post_val['post_img'] . '</a> ';
                                        $return_html .= '<span class="date">'.$post_val['post_date_post'].'</span>
                                                <h3 class="title"><a href="' . $post_val['post_link'] . '">&nbsp;' . $post_val['post_title'] . '</a></h3>
                                                    ';
                                        $return_html .='<a href="' . $post_val['post_link'] . '" class="right-arrow"><i class="icon-chevron-right"></i></a>';

                                        $k++;
                                    }
                $return_html .='</ul>
                    </div>

                    <div id="tab_cont_1_2" class="tab-pane fade">
                        <ul class="side-postlist">';
                                   $c=0; foreach ($recent_posts as $post_val) {
                                       if($c == $numb) break;

                                        $return_html .= '<li>';
                                        if(!empty($post_val['post_img']))
                                            $return_html .= ' <a href="' . $post_val['post_link'] . '" class="post-thumbnail">' . $post_val['post_img'] . '</a> ';
                                        $return_html .= '<span class="date">'.$post_val['post_date_post'].'</span>
                                                <h3 class="title"><a href="' . $post_val['post_link'] . '">&nbsp;' . $post_val['post_title'] . '</a></h3>
                                                    ';
                                        $return_html .='<a href="' . $post_val['post_link'] . '" class="right-arrow"><i class="icon-chevron-right"></i></a>';

                                        $c++;
                                    }
                 $return_html .= '</ul>
                     </div>';
                 $return_html .= '<div id="tab_cont_1_3" class="tab-pane fade">
                                <ul class="side-postlist">';
                                   $z = 0; foreach ($commented_posts as $post_val) { 
                                        if($z == $numb) break;

                                        $return_html .= '<li>';
                                        if(!empty($post_val['post_img']))
                                            $return_html .= ' <a href="' . $post_val['post_link'] . '" class="post-thumbnail">' . $post_val['post_img'] . '</a> ';
                                        $return_html .= '<span class="date">'.$post_val['post_date_post'].'</span>
                                                <h3 class="title"><a href="' . $post_val['post_link'] . '">&nbsp;' . $post_val['post_title'] . '</a></h3>
                                                    ';
                                        $return_html .='<a href="' . $post_val['post_link'] . '" class="right-arrow"><i class="icon-chevron-right"></i></a>';

                                        $z++;
                                    }
                $return_html .='</ul>
                    </div>
                    </div>
                </div>';
    
                echo $return_html;
    ?>
            <!-- widget sidebar tabs -->
            <?php
        }

	function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
            $instance['title'] = $new_instance['title'];
            return $instance;
	}

	function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, array(  'template' => 'box_white',) );
            $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
            $title = $instance['title'];
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Number of posts:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
	}
}

register_widget('TFuse_Widget_Tabs');
