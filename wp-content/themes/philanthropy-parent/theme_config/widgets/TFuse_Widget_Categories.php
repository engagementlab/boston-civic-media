<?php
class TFuse_Widget_Categories extends WP_Widget {

    function TFuse_Widget_Categories() {
        $widget_ops = array( 'classname' => 'widget_categories', 'description' => __( "A list or dropdown of categories" ,"tfuse") );
        $this->WP_Widget('categories', __('TFuse - Categories','tfuse'), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Categories','tfuse' ) : $instance['title'], $instance, $this->id_base);
        $c = @$instance['count'] ? '1' : '0';
        $h = @$instance['hierarchical'] ? '1' : '0';
        $d = @$instance['dropdown'] ? '1' : '0';
        $e = !empty($instance['hide_empty']) ? '0' : '1';
        $p = empty($instance['parent']) ? '1' : '0';
        $sid_pos = tfuse_sidebar_position();
                
        $before_widget = '<div class="widget widget-categories">';
        $after_widget = '</div>';
        $before_title = '<h3 class="widget-title">';
        $after_title = '</h3>';

        echo $before_widget;
        $title = tfuse_qtranslate($title);
        if ( $title )	echo $before_title . $title . $after_title;

        if($p) {
            $cat_ID = get_query_var('cat');
            $the_category= get_category($cat_ID);
            $parent_id = @$the_category->parent;
            if ($parent_id == 0) $parent_id = $cat_ID;
        } else {
            $parent_id = 0;
        }

        $cat_args = array('orderby' => 'parent,name', 'show_count' => $c, 'hierarchical' => $h, 'echo' => 0, 'hide_empty' => $e, 'child_of' => $parent_id );
        if ( $d ) {
            $cat_args['show_option_none'] = __('Select Category','tfuse');
            echo	wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args));



            ?>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var dropdown = document.getElementById("cat");
            function onCatChange() {
                if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
                    location.href = "<?php echo home_url(); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
                }
            }
            dropdown.onchange = onCatChange;
            /* ]]> */
        </script>

        <?php
        } else {
            ?>
        <ul class="side-postlist">
            <?php
            $cat_args['title_li'] = '';
            $list_categories = wp_list_categories(apply_filters('widget_categories_args', $cat_args));
            $intPos = strripos($list_categories,'<a');
            $intPos = $intPos+2;
            printf("%s class=\"last\" %s",
                substr($list_categories,0,$intPos),
                substr($list_categories,$intPos,strlen($list_categories))
            );

            ?>
        </ul>
        <?php
        }

        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['count'] = !empty($new_instance['count']) ? 1 : 0;
        $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
        $instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;
        $instance['hide_empty'] = !empty($new_instance['hide_empty']) ? 1 : 0;
        $instance['parent'] = !empty($new_instance['parent']) ? 1 : 0;

        return $instance;
    }

    function form( $instance ) {
        //Defaults
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = esc_attr( $instance['title'] );
        $count = isset($instance['count']) ? (bool) $instance['count'] :false;
        $hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
        $dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
        $hide_empty = isset( $instance['hide_empty'] ) ? (bool) $instance['hide_empty'] : false;
        $parent = isset( $instance['parent'] ) ? (bool) $instance['parent'] : false;
        ?>
    
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ,'tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

    <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
        <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Show as dropdown','tfuse' ); ?></label><br />
        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
        <label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy','tfuse' ); ?></label><br />

        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hide_empty'); ?>" name="<?php echo $this->get_field_name('hide_empty'); ?>"<?php checked( $hide_empty ); ?> />
        <label for="<?php echo $this->get_field_id('hide_empty'); ?>"><?php _e( 'Show empty categories','tfuse' ); ?></label><br />

        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('parent'); ?>" name="<?php echo $this->get_field_name('parent'); ?>"<?php checked( $parent ); ?> />
        <label for="<?php echo $this->get_field_id('parent'); ?>"><?php _e( 'Show as subcategories menu','tfuse' ); ?></label></p>

    <?php
    }

}




function TFuse_Unregister_WP_Widget_Categories() {
    unregister_widget('WP_Widget_Categories');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Categories');

register_widget('TFuse_Widget_Categories');
?>