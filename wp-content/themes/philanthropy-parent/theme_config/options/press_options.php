<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$options = array(
     array('name' => __('Post Settings','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Article Source Link','tfuse'),
        'desc' => __('Article Source Link.','tfuse'),
        'id' => TF_THEME_PREFIX . '_link',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => __('Article Source','tfuse'),
        'desc' => __('Article Source.','tfuse'),
        'id' => TF_THEME_PREFIX . '_source',
        'value' => '',
        'type' => 'text'
    ),
);