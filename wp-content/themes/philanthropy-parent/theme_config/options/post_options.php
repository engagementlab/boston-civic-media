<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */
     /* Post Media */
   array('name' => __('Post Settings','tfuse'),
        'id' => TF_THEME_PREFIX . '_post_settings',
        'type' => 'metabox',
        'context' => 'normal'
    ),
     // Single Image Position
    array('name' => __('Image Alignment', 'tfuse'),
        'desc' => __('Select your preferred image  alignment', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_article_type',
        'value' => '',
        'options' => array(
            'post-style-1' => array(get_template_directory_uri(). '/images/type1.png', __('First Display Type', 'tfuse')),
            'post-style-2' => array(get_template_directory_uri(). '/images/type2.png', __('Second Display Type', 'tfuse')),
            'post-style-3' => array(get_template_directory_uri(). '/images/type3.png', __('Third Display Type', 'tfuse')),
            'post-style-4' => array(get_template_directory_uri(). '/images/type4.png', __('Fourth Display Type', 'tfuse')),
            'post-style-5' => array(get_template_directory_uri(). '/images/type5.png', __('Fifth Display Type', 'tfuse')),
            'post-style-6' => array(get_template_directory_uri(). '/images/type6.png', __('Sixth Display Type', 'tfuse')),
            'post-style-7' => array(get_template_directory_uri(). '/images/type7.png', __('Seventh Display Type', 'tfuse')),
            ),
        'type' => 'images',
        'divider' => true
    ), 
    array('name' => __('Short Description','tfuse'),
        'desc' => __('Post short description.','tfuse'),
        'id' => TF_THEME_PREFIX . '_post_desc',
        'value' => '',
        'type' => 'textarea'
    ),
	/* Content Options */
    array('name' => __('Content Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Shortcodes before Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => __('Shortcodes after Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
);

?>