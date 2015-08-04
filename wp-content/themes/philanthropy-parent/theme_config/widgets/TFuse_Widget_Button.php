<?php

// =============================== Search widget ======================================

class TFuse_Widget_Button extends WP_Widget {

	function TFuse_Widget_Button() {
            $widget_ops = array('classname' => 'widget_button', 'description' => __( "Button Widget","tfuse") );
            $this->WP_Widget('button', __('TFuse Button','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
            extract($args);
            $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Join us','tfuse' ) : $instance['title'], $instance, $this->id_base);
            ?>
            <a href="<?php echo $instance['link'];?>" class="btn btn-transparent btn-join-us"><span><?php echo $title;?></span></a>
			<?php
        }

	function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $new_instance = wp_parse_args((array) $new_instance, array( 'title' => '','link' => ''));
            $instance['title'] = $new_instance['title'];
            $instance['link'] = $new_instance['link'];
            return $instance;
	}

	function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, array() );
            $instance = wp_parse_args( (array) $instance, array( 'title' => '','link' => '') );
            $title = $instance['title'];
            $link = $instance['link'];
?>

            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></label></p>
<?php
	}
}

register_widget('TFuse_Widget_Button');
