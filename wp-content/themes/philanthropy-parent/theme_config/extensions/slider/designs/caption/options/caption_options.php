<?php
/**
 * Play slider's configurations
 *
 * @since Gamezone 1.0
 */

$options = array(
    'tabs' => array(
        array(
            'name' => __('Slider Settings', 'tfuse'),
            'id' => 'slider_settings', #do no t change this ID
            'headings' => array(
                array(
                    'name' => __('Slider Settings', 'tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Slides Interval', 'tfuse'),
                            'desc' => __('Set slides interval', 'tfuse'),
                            'id' => 'slider_interval',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array('name' => __('Slider Title', 'tfuse'),
                            'desc' => __('Change the title of your slider. Only for internal use (Ex: Homepage)', 'tfuse'),
                            'id' => 'slider_title',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                            ),
                         array('name' => __('Bg Image', 'tfuse'),
                            'desc' => __('Upload Bg Image.', 'tfuse'),
                            'id' => 'slider_bg',
                            'value' => '',
                            'type' => 'upload',
                            'media' => 'image',
                             'divider' => true
                        ),
                        array('name' => __('Resize', 'tfuse'),
                            'desc' => __('Resize Image', 'tfuse'),
                            'id' => 'slider_image_resize',
                            'value' => '',
                            'type' => 'checkbox'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Add/Edit Slides', 'tfuse'),
            'id' => 'slider_setup', #do not change ID
            'headings' => array(
                array(
                    'name' => __('Add New Slide', 'tfuse'), #do not change
                    'options' => array(
                        array('name' => __('Select Type', 'tfuse'),
                            'desc' => __('Select Slide Type', 'tfuse'),
                            'id' => 'slide_type',
                            'value' => '',
                            'options' => array('image' => __('Image','tfuse'),'video' => __('Video','tfuse')),
                            'type' => 'select',
                            'divider' => true),
                        array('name' => __('Title', 'tfuse'),
                            'desc' => __('The Title is displayed on the image and will be visible by the users.', 'tfuse'),
                            'id' => 'slide_title',
                            'value' => '',
                            'type' => 'text'),
                        array('name' => __('Url', 'tfuse'),
                            'desc' => __('Slide Url.', 'tfuse'),
                            'id' => 'slide_url',
                            'value' => '',
                            'type' => 'text'),
                        array('name' => __('Button Text', 'tfuse'),
                            'desc' => __('Button Text.', 'tfuse'),
                            'id' => 'slide_button',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                       
                        array('name' => __('Video', 'tfuse'),
                            'desc' => __('Video link', 'tfuse'),
                            'id' => 'slide_video',
                            'value' => '',
                            'type' => 'textarea'
                            ),
                        array('name' => __('Image', 'tfuse'),
                            'desc' => __('You can upload an image from your hard drive or use one that was already uploaded by pressing  "Insert into Post" button from the image uploader plugin.', 'tfuse'),
                            'id' => 'slide_src',
                            'value' => '',
                            'type' => 'upload',
                            'media' => 'image')
                    )
                )
            )
        )
    )
);
$options['extra_options'] = array();