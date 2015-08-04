<?php
/**
 * Initializing deafault sidebars
 *
 * @since  Philanthropy 1.0
 */
function sidebar_attachment ($post_types){
    unset($post_types['attachment']);
    return $post_types;
}
add_filter('tfuse_sidebar_posts', 'sidebar_attachment');


function tfuse_ext_sidebars_get_taxonomies_filter($args){
    $args['hierarchical'] = false;
    return $args;
}
add_filter('tf_get_taxonomies', 'tfuse_ext_sidebars_get_taxonomies_filter');


function sidebar_tags_service ($taxonomies){
    unset($taxonomies['tags_service']);
    return $taxonomies;
}
add_filter('tfuse_sidebar_tags_service', 'sidebar_tags_service');

function sidebar_stories ($taxonomies){
    unset($taxonomies['stories']);
    return $taxonomies;
}
add_filter('tfuse_sidebar_stories', 'sidebar_stories');

function sidebar_difficulties ($taxonomies){
    unset($taxonomies['difficulties']);
    return $taxonomies;
}
add_filter('tfuse_sidebar_difficulties', 'sidebar_difficulties');



function tf_sidebar_cfg() {
    static $sidebar_cfg = array();
    #Sidebar options
    $beforeWidget = '<div id="%1$s" class="box %2$s">';
    $afterWidget = '</div>';
    $beforeTitle = '<h3>';
    $afterTitle = '</h3>';
    #End sidebar options
    if (count($sidebar_cfg) == 0) {
        #Sidebar filters
        $beforeWidget = apply_filters('tfuse_filter_before_widget', $beforeWidget);
        $afterWidget = apply_filters('tfuse_filter_after_widget', $afterWidget);
        $beforeTitle = apply_filters('tfuse_filter_before_title', $beforeTitle);
        $afterTitle = apply_filters('tfuse_filter_after_title', $afterTitle);
        #End sidebar filters
        $sidebar_cfg = compact('beforeWidget', 'afterWidget', 'beforeTitle', 'afterTitle');
    }
    return $sidebar_cfg;
}

function tf_sidebars_init() {
    extract(tf_sidebar_cfg());
    register_sidebar(array('name' => __('General Sidebar', 'tfuse'), 'id' => 'sidebar-1', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle, 'description' => ''));

//    register_sidebar(array('name' => __('Footer 1', 'tfuse'), 'id' => 'footer-1', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle));
//    register_sidebar(array('name' => __('Footer 2', 'tfuse'), 'id' => 'footer-2', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle));
//    register_sidebar(array('name' => __('Footer 3', 'tfuse'), 'id' => 'footer-3', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle));
//    register_sidebar(array('name' => __('Footer 4', 'tfuse'), 'id' => 'footer-4', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle));

}

tf_sidebars_init();
