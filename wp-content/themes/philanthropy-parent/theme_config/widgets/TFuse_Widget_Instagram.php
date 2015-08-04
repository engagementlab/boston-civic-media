<?php
class TF_Widget_Instagram extends WP_Widget {

    function TF_Widget_Instagram() {
        $widget_ops = array('classname' => 'widget_instagram', 'description' => __('Instagram widget','tfuse'));
        $control_ops = array('width' => 400, 'height' => 350);
        $this->WP_Widget('Instagram', __('TFuse - Instagram','tfuse'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $user = apply_filters( 'widget_user', $instance['user'], $instance );
        $follow_button = apply_filters( 'follow_button', $instance['follow_button'], $instance );
        $number = esc_attr($instance['number']);
        if ($number>0) {} else $number = 6;

        $instagram_photos = tfuse_get_instagram_photos($user, $number);

        $before_widget = '<div class="widget widget-instagram">';
        $after_widget = '</div>';
        $before_title = '<h3 class="widget-title">';
        $after_title = '</h3>';

        echo $before_widget;
        $title = tfuse_qtranslate($title);
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>

        <?php if( !empty($instagram_photos) ){ ?>
            <div class="instagram">
                <ul>
                    <?php foreach($instagram_photos as $image){ ?>
                        <li><a href="http://instagram.com/p/<?php echo $image['code']; ?>"><img src="<?php echo $image['link']; ?>"></a></li>
                    <?php } ?>
                </ul>
                <?php if($follow_button != ''){ ?>
                    <a href="http://instagram.com/<?php echo $user; ?>" class="btn btn-transparent btn-instagram"><span><?php echo tfuse_qtranslate($follow_button); ?></span></a>
                <?php } ?>
            </div>
        <?php } ?>
    <?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['user'] = $new_instance['user'];
        $instance['number'] = $new_instance['number'];
        $instance['follow_button'] = $new_instance['follow_button'];

        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'user' => '', 'number' => '', 'follow_button' => '', ) );
        $title = $instance['title'];
        $user = $instance['user'];
        $number = $instance['number'];
        $follow_button = $instance['follow_button'];
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Username:','tfuse'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo esc_attr($user); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of images:','tfuse'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('follow_button'); ?>"><?php _e('Follow button title:','tfuse'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('follow_button'); ?>" name="<?php echo $this->get_field_name('follow_button'); ?>" type="text" value="<?php echo esc_attr($follow_button); ?>" />
        </p>
    <?php
    }
}

register_widget('TF_Widget_Instagram');