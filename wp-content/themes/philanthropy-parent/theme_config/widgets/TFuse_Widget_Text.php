<?php
class TFuse_Widget_Text extends WP_Widget {

	function TFuse_Widget_Text() {
		$widget_ops = array('classname' => 'widget_text', 'description' => __('Arbitrary text or HTML','tfuse'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('text', __('TFuse Text','tfuse'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$text = apply_filters( 'widget_text', $instance['text'], $instance );
		$tf_class = ( @$instance['nopadding'] ) ? '' : 'class="widget widget-text "';
		$before_widget = '<div '.$tf_class.'>';
		$after_widget = '</div>';
		$before_title = '<h3 class="widget-title">';
		$after_title = '</h3>';


		echo $before_widget;
		$title = tfuse_qtranslate($title);
		if ( !empty( $title ) ) { ?>
        <?php echo $before_title . $title . $after_title; } ?>
                <p><?php echo $instance['filter'] ? wpautop($text) : $text; ?></p>
                
                <?php if(!empty($instance['fb']) || !empty($instance['tw']) || !empty($instance['pin']) || !empty($instance['adv']) || !empty($instance['in']) ):?>
                <div class="social-links">
                    <span class="social-icons">
                        <?php if(!empty($instance['fb'])):?>
                            <a href="<?php echo $instance['fb'];?>" title="<?php _e('Facebook','tfuse');?>" target="_blank"><i class="tficon-facebook"></i></a>
                        <?php endif;?>
                        <?php if(!empty($instance['tw'])):?>
                            <a href="<?php echo $instance['tw'];?>" title="<?php _e('Twitter','tfuse');?>" target="_blank"><i class="tficon-twitter"></i></a>
                        <?php endif;?>
                        <?php if(!empty($instance['pin'])):?>
                            <a href="<?php echo $instance['pin'];?>" title="<?php _e('Pinterest','tfuse');?>" target="_blank"><i class="tficon-pinterest"></i></a>
                        <?php endif;?>
                        <?php if(!empty($instance['in'])):?>
                            <a href="<?php echo $instance['in'];?>" title="<?php _e('Instagram','tfuse');?>" target="_blank"><i class="tficon-instagram"></i></a>
                        <?php endif;?>
                    </span>
                </div>
                <?php endif;?>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
                $instance['fb'] = $new_instance['fb'];
                $instance['tw'] = $new_instance['tw'];
                $instance['pin'] = $new_instance['pin'];
                $instance['in'] = $new_instance['in'];
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		$instance['nopadding'] = isset($new_instance['nopadding']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '','fb' => '','tw' => '','adv' => '','pin' => '','in' => '', 'nopadding' => '' ) );
		$title = $instance['title'];
                $fb = $instance['fb'];
                $tw = $instance['tw'];
                $pin = $instance['pin'];
                $adv = $instance['adv'];
                $in = $instance['in'];
		$text = format_to_edit($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs','tfuse'); ?></label></p>
		<p><input id="<?php echo $this->get_field_id('nopadding'); ?>" name="<?php echo $this->get_field_name('nopadding'); ?>" type="checkbox" <?php checked(isset($instance['nopadding']) ? $instance['nopadding'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('nopadding'); ?>"><?php _e('No Margin and padding','tfuse'); ?></label></p>
                
                <p><label for="<?php echo $this->get_field_id('fb'); ?>"><?php _e('Facebook Link:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('fb'); ?>" name="<?php echo $this->get_field_name('fb'); ?>" type="text" value="<?php echo esc_attr($fb); ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('tw'); ?>"><?php _e('Twitter link:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('tw'); ?>" name="<?php echo $this->get_field_name('tw'); ?>" type="text" value="<?php echo esc_attr($tw); ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('pin'); ?>"><?php _e('Pinterest Link:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('pin'); ?>" name="<?php echo $this->get_field_name('pin'); ?>" type="text" value="<?php echo esc_attr($pin); ?>" /></p>
               
                <p><label for="<?php echo $this->get_field_id('in'); ?>"><?php _e('Instagram link:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('in'); ?>" name="<?php echo $this->get_field_name('in'); ?>" type="text" value="<?php echo esc_attr($in); ?>" /></p>
<?php
	}
}


function TFuse_Unregister_WP_Widget_Text() {
	unregister_widget('WP_Widget_Text');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Text');

register_widget('TFuse_Widget_Text');
