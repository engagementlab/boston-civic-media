<?php

// =============================== Search widget ======================================

class TFuse_Widget_Search extends WP_Widget {

	function TFuse_Widget_Search() {
            $widget_ops = array('classname' => 'widget_search', 'description' => __( "A search form for your site","tfuse") );
            $this->WP_Widget('search', __('TFuse Search','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
            extract($args);
            $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Search','tfuse' ) : $instance['title'], $instance, $this->id_base);
            $template = empty( $instance['template'] ) ? '' : $instance['template'];
            $b = $instance['b'] = empty( $instance['b'] ) ? '' : $instance['b'];
            ?>
                    <div class="widget widget-search">
                        <form method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
                            <input type="text" value=""  name="s" id="s" placeholder="<?php echo $title; ?>"/>
                            <button type="submit" class="btn btn-search"><span><i class="tficon-search"></i></span></button>
                        </form>
                    </div>
			<?php
        }

	function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
            $instance['title'] = $new_instance['title'];
            $instance['template'] = strip_tags($new_instance['template']);
            return $instance;
	}

	function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, array(  'template' => 'box_white',) );
            $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
            $title = $instance['title'];
            $template = esc_attr( $instance['template'] );
?>

            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
	}
}

function TFuse_Unregister_WP_Widget_Search() {
	unregister_widget('WP_Widget_Search');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Search');

register_widget('TFuse_Widget_Search');
