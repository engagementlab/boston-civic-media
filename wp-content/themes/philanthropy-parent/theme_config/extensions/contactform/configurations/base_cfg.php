<?php
$cfg['input_types']=array(
                        array(
                            'name'=>__('Text line', 'tfuse'),
                            'type'=>'text',
                            'size'=>'40',
                            'value'=>'',
                            'id'=>TF_THEME_PREFIX."_%%name%%",
                            'options'=>false,
                            'properties'=>array(
                                'style'=>'width:85%',
                                'class'=>'inputtext input_middle'
                            )
                            ),
                        array(
                            'name'=>__('Text area', 'tfuse'),
                            'type'=>'textarea',
                            'value'=>'',
                            'id'=>TF_THEME_PREFIX."_%%name%%",
                            'cols'=>'40',
                            'rows'=>'10',
                            'options'=>false,
                            'properties'=>array(
                                'style'=>'width:100%',
                                'class'=>'textarea textarea_middle'
                            )
                             ),

                        array(
                             'name'=>__('Radio buttons', 'tfuse'),
                             'type'=>'radio',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'options'=>true
                             ),
                        array(
                             'name'=>__('Checkbox', 'tfuse'),
                             'type'=>'checkbox',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'options'=>false
                             ),
                         array(
                             'name'=>__('Select Box', 'tfuse'),
                             'type'=>'select',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'properties'=>array(
                                 'class'=>'select_styled'
                             ),
                             'options'=>true
                              ),
                         array(
                             'name'=>__('Email', 'tfuse'),
                             'type'=>'text',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'options'=>false,
                             'properties'=>array(
                                 'style'=>'width:85%',
                                 'class'=>'inputtext input_middle'
                             )
                             ),
                         array(
                              'name'=>__('Captcha', 'tfuse'),
                              'type'=>'captcha',
                              'value'=>'',
                              'id'=>"captcha",
                              'options'=>false,
                              'file_name'=>'captcha_gen.php',
                             'properties'=>array(
                                 'style'=>'width:85%'
                             )
                              )
                        );
$cfg['labels']=array(
            'type'=>'tfuse_cf_label',
    array(
        'id'=>'cf_type',
        'html'=>'<label >' . __('Type', 'tfuse') . '</label>',
        'type'=>'raw'
    ),
            array(
                'id'=>'cf_label',
                'html'=>'<label >' . __('Label', 'tfuse') . '</label>',
                'type'=>'raw'
            ),

            array(
                'id'=>'cf_width',
                'html'=>'<label >' . __('Width (%)', 'tfuse') . '</label>',
                'type'=>'raw'
            ),
            array(
                'id'=>'cf_required',
                'html'=>'<label >' . __('Required', 'tfuse') . '</label>',
                'type'=>'raw'
            ),
            array(
                'id'=>'cf_newline',
                'html'=>'<label >' . __('New Line', 'tfuse') . '</label>',
                'type'=>'raw'
            ),
            array(
                'id'=>'cf_column',
                'html'=>'<label >' . __('Column', 'tfuse') . '</label>',
                'type'=>'raw'
            ),
            array(
                'id'=>'cf_shortcode',
                'html'=>'<label >' . __('Shortcode', 'tfuse') . '</label>',
                'type'=>'raw'
            ),
        );