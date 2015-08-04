<?php
class TFuse_Widget_Recent_Comments extends WP_Widget {

}

function TFuse_Unregister_WP_Widget_Recent_Comments() {
	unregister_widget('WP_Widget_Recent_Comments');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Recent_Comments');

