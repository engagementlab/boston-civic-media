<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$options = array(
     array('name' => __('Content Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Button Title','tfuse'),
        'desc' => __('Button Title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_btn_title',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => __('Button Link','tfuse'),
        'desc' => __('Button Link','tfuse'),
        'id' => TF_THEME_PREFIX . '_btn_link',
        'value' => '',
        'type' => 'text'
    )
   
);

?>