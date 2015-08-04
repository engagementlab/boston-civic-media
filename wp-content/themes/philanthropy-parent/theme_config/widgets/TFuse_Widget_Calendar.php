<?php

class Tfuse_Calendar_Widget extends WP_Widget
{
    function Tfuse_Calendar_Widget() {}
}
function Tfuse_Unregister_WP_Widget_Calendar() {
	unregister_widget('WP_Widget_Calendar');
}
add_action('widgets_init','Tfuse_Unregister_WP_Widget_Calendar');