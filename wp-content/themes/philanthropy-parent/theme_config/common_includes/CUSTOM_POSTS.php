<?php
/**
 * Create custom posts types
 *
 * @since  Gameszone 1.0
 */

if ( !function_exists('tfuse_create_custom_post_types') ) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_create_custom_post_types()
    {
		//Reservation_form
		        $labels = array(
                        'name' => __('Reservation', 'tfuse'),
                        'singular_name' => __('Reservation', 'tfuse'),
                        'add_new' => __('Add New', 'tfuse'),
                        'add_new_item' => __('Add New Reservation', 'tfuse'),
                        'edit_item' => __('Edit Reservation info', 'tfuse'),
                        'new_item' => __('New Reservation', 'tfuse'),
                        'all_items' => __('All Reservations', 'tfuse'),
                        'view_item' => __('View Reservation info', 'tfuse'),
                        'parent_item_colon' => ''
                );
                $reservationform_rewrite=apply_filters('tfuse_reservationform_rewrite','reservationform_list');
                $res_args = array(
                                'labels' => $labels,
                                'public' => true,
                                'publicly_queryable' => false,
                                'show_ui' => false,
                                'query_var' => true,
                                'exclude_from_search'=>true,
                                //'menu_icon' => get_template_directory_uri() . '/images/icons/doctors.png',
                                'has_archive' => true,
                                'rewrite' => array('slug'=> $reservationform_rewrite),
                                'menu_position' => 6,
                                'supports' => array(null)
                        );
               register_taxonomy('reservations', array('reservations'), array(
                            'hierarchical' => true,
                            'labels' => array(
                                'name' => __('Reservation Forms', 'tfuse'),
                                'singular_name' => __('Reservation Form', 'tfuse'),
                                'add_new_item' => __('Add New Reservation Form', 'tfuse'),
                            ),
                            'show_ui' => false,
                            'query_var' => true,
                            'rewrite' => array('slug' => $reservationform_rewrite)
                        ));
                        register_post_type( 'reservations' , $res_args );
        // Galleries
        $labels = array(
                'name' => __('Galleries', 'tfuse'),
                'singular_name' => __('Gallery', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Gallery', 'tfuse'),
                'edit_item' => __('Edit Galleries info', 'tfuse'),
                'new_item' => __('New Gallery', 'tfuse'),
                'all_items' => __('All Galleries', 'tfuse'),
                'view_item' => __('View Gallery info', 'tfuse'),
                'search_items' => __('Search Galleries', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $gallerylist_rewrite = apply_filters('tfuse_gallerylist_rewrite','all-gallery-list');
        
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $gallerylist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','thumbnail','comments','editor')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $gallerylist_taxonomy_rewrite = apply_filters('tfuse_gallerylist_taxonomy_rewrite','gallery-list');
        register_taxonomy('galleries', array('gallery'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $gallerylist_taxonomy_rewrite)
        ));
     
            
        register_post_type( 'gallery' , $args );
                
        // Projects
        $labels = array(
                'name' => __('Projects', 'tfuse'),
                'singular_name' => __('Project', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Project info', 'tfuse'),
                'new_item' => __('New Project', 'tfuse'),
                'all_items' => __('All Projects', 'tfuse'),
                'view_item' => __('View Project info', 'tfuse'),
                'search_items' => __('Search Project', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $projectlist_rewrite = apply_filters('tfuse_projectlist_rewrite','all-project-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $projectlist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','comments','thumbnail','excerpt')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $projectlist_taxonomy_rewrite = apply_filters('tfuse_projectlist_taxonomy_rewrite','project-list');
        register_taxonomy('projects', array('project'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $projectlist_taxonomy_rewrite)
        )); 
        
        register_post_type( 'project' , $args ); 
        
        // Events
        $labels = array(
                'name' => __('Events', 'tfuse'),
                'singular_name' => __('Event', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Event info', 'tfuse'),
                'new_item' => __('New Event', 'tfuse'),
                'all_items' => __('All Events', 'tfuse'),
                'view_item' => __('View Event info', 'tfuse'),
                'search_items' => __('Search Event', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $eventlist_rewrite = apply_filters('tfuse_eventlist_rewrite','all-event-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $eventlist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $eventlist_taxonomy_rewrite = apply_filters('tfuse_eventlist_taxonomy_rewrite','event-list');
        register_taxonomy('events', array('event'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $eventlist_taxonomy_rewrite)
        )); 
        
        register_post_type( 'event' , $args );
        
        // Press
        $labels = array(
                'name' => __('In the Press', 'tfuse'),
                'singular_name' => __('In the Press', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Article', 'tfuse'),
                'edit_item' => __('Edit Article', 'tfuse'),
                'new_item' => __('New Article', 'tfuse'),
                'all_items' => __('All Articles', 'tfuse'),
                'view_item' => __('View Article', 'tfuse'),
                'search_items' => __('Search Articles', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                //'menu_icon' => get_template_directory_uri() . '/images/icons/testimonials.png',
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','editor','thumbnail')
        ); 

        register_post_type( 'press' , $args );

        // Members
        $labels = array(
                'name' => __('Members', 'tfuse'),
                'singular_name' => __('Member', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Member', 'tfuse'),
                'edit_item' => __('Edit Member', 'tfuse'),
                'new_item' => __('New Member', 'tfuse'),
                'all_items' => __('All Members', 'tfuse'),
                'view_item' => __('View Member', 'tfuse'),
                'search_items' => __('Search Members', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                //'menu_icon' => get_template_directory_uri() . '/images/icons/testimonials.png',
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','thumbnail')
        ); 

        register_post_type( 'member' , $args );
        
        // FAQ
        $labels = array(
                'name' => __('FAQs', 'tfuse'),
                'singular_name' => __('FAQ', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New FAQ', 'tfuse'),
                'edit_item' => __('Edit FAQ', 'tfuse'),
                'new_item' => __('New FAQ', 'tfuse'),
                'all_items' => __('All FAQs', 'tfuse'),
                'view_item' => __('View FAQ', 'tfuse'),
                'search_items' => __('Search FAQs', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                //'menu_icon' => get_template_directory_uri() . '/images/icons/testimonials.png',
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','editor')
        ); 

        register_post_type( 'faq' , $args );

        // TESTIMONIALS
        $labels = array(
                'name' => __('Testimonials', 'tfuse'),
                'singular_name' => __('Testimonial', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Testimonial', 'tfuse'),
                'edit_item' => __('Edit Testimonial', 'tfuse'),
                'new_item' => __('New Testimonial', 'tfuse'),
                'all_items' => __('All Testimonials', 'tfuse'),
                'view_item' => __('View Testimonial', 'tfuse'),
                'search_items' => __('Search Testimonials', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                //'menu_icon' => get_template_directory_uri() . '/images/icons/testimonials.png',
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','editor')
        ); 

        register_post_type( 'testimonials' , $args );

    }
    tfuse_create_custom_post_types();

endif;

add_action('category_add_form', 'taxonomy_redirect_note');
add_action('specialties_add_form', 'taxonomy_redirect_note');
function taxonomy_redirect_note($taxonomy){
    echo '<p><strong>Note:</strong> More options are available after you add the '.$taxonomy.'. <br />
        Click on the Edit button under the '.$taxonomy.' name.</p>';
}
