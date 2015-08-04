<?php
function tf_contactform_shortcode($atts){
    global $TFUSE;
    wp_register_script( 'contact_forms_js', get_template_directory_uri().'/js/contact_forms.js', array('jquery'), '1.1.0', true );
    wp_enqueue_script( 'contact_forms_js' );
    wp_enqueue_script('jquery-form');
    wp_enqueue_script('jquery');
    wp_register_style( 'contact_forms_css', get_template_directory_uri().'/theme_config/extensions/contactform/static/css/contact_form.css', true, '1.1.0' );
    wp_enqueue_style( 'contact_forms_css' );
    extract(shortcode_atts(array('tf_cf_formid' => '-1'), $atts));
    $out='';
    $form_exists=false;
	$is_preview=false;
    if($tf_cf_formid!='-1'){
		$is_preview=false;
        $forms = get_option(TF_THEME_PREFIX . '_tfuse_contact_forms');
        if(isset($forms[$tf_cf_formid])){
            $form_exists=true;
            $form = $forms[$tf_cf_formid];
        }
    } elseif($TFUSE->request->COOKIE('form_array')){
        $form_exists=true;
        $is_preview = true;
        $form = unserialize($TFUSE->request->COOKIE('form_array'));
        $TFUSE->request->COOKIE('form_array',null);
    }

    if($form_exists){
        $out.='<section class="wrap-contact-form clearfix">
                    <div class="container">
                        <div class="add-comment contact-form" id="addcomments">';
        $out .='<h2 class="title-contact-form" id="header_message">'.urldecode($form['header_message']).'</h2>
            <div id="form_messages" class="submit_message" ></div><div class="clear"></div>';
        $inputs = $TFUSE->get->ext_config('CONTACTFORM', 'base');
        $input_array = $inputs['input_types'];

        if($TFUSE->request->POST('submit')){
            $TFUSE->ext->contactform->sendSmtp($tf_cf_formid);
        }
        $out.='<form id="contactForm" action="" method="post" class="ajax_form contact-form contactForm" name="contactForm">';
        $out.='<input id="this_form_id" type="hidden" value="'. $tf_cf_formid.'" />';
        $fields='';

        $fcount = 1;
        $linewidth = 0;
        $earr=array();
        $linenr = 1;
        $countForm = count($form['input']);
        $dimension=27;
		$lines = array();
		$lines[$linenr] = 0;

        $line1=array();
        $line2=array();
        foreach($form['input'] as $form_input_arr1){
            
            if(isset($form_input_arr1['column']) && $form_input_arr1['column']==0)$line1[]=$form_input_arr1;
            else $line2[]=$form_input_arr1;
        }
        if(isset($line2[0])) $line2[0]['newline']=1;
        $colmuns=array_merge($line1,$line2);

        foreach($colmuns as $form_input_arr){
            $earr[$fcount]['width'] = $form_input_arr['width'];

            $linewidth += $form_input_arr['width'];
            if (isset($form_input_arr['newline'])) {
                $linewidth = $form_input_arr['width'];
                $earr[$fcount]['class'] = ' ';
                if ($fcount>1) {$linenr++;
                    $lines[$linenr] = 0;}
                $earr[$fcount]['line'] = $linenr;
                $lines[$linenr] += $dimension;
            }
            elseif ($linewidth>100) {
                $linewidth = $form_input_arr['width'];
                $linenr++;
                $lines[$linenr] = 0;
                $earr[($fcount-1)]['class'] = ' omega ';
                $earr[$fcount]['class'] = ' ';
                $earr[$fcount]['line'] = $linenr;
                $lines[$linenr] += $dimension;
               
            }
            elseif($linewidth==100) {
                $linewidth = 0;
                $earr[$fcount]['class'] = ' omega ';
                $earr[$fcount]['line'] = $linenr;
                $lines[$linenr] += $dimension;
                $linenr++;
		        $lines[$linenr] = 0;
            }
            else {
                $earr[$fcount]['class'] = ' ';
                $earr[$fcount]['line'] = $linenr;
                $lines[$linenr] += $dimension;
            }

            if ($countForm==$fcount && !isset($form_input_arr['newline'])) {
                $earr[$fcount]['class'] = ' omega ';
            }

            $fcount++;
        }

        $linewidth = 0;
        $fcount = 1;
        $margin=27;
        $out_left = '<div class="column-left">';
        $out_right = '<div class="column-right">';
        foreach($colmuns as $form_input){
            $field='';
            $field_m = '';
            $input=$input_array[$form_input['type']];

            $floating=(isset($form_input['newline']))?'clear:left;':'';
            if (!isset($input['properties']['class']))
                $input['properties']['class'] = '';
            $input['properties']['class'] .=($input['name']=='Email')?' '.TF_THEME_PREFIX.'_email':'';
            $input['properties']['class'] .=(isset($form_input['required']) && $form_input['required'])?' tf_cf_required_input ':'';
            $label_text =(isset($form_input['required']) && $form_input['required'])?trim($form_input['label']).' '.$form['required_text']:trim($form_input['label']);
            $input['id']=str_replace('%%name%%',strtolower(str_ireplace(' ','_',$form_input['shortcode'])),$input['id']);

            $form_input['classes'] = $earr[$fcount]['class'];
            $form_input['floating'] = $floating;
            $form_input['label_text'] = $label_text;

            if($is_preview)
				$sidebar_position = 'full';
            else
				$sidebar_position = tfuse_sidebar_position();

            $element_line = $earr[$fcount]['line'];

            if ($sidebar_position == 'full' || (is_page() && basename( get_page_template() ) == 'template-page-full.php'))
            {
                if($is_preview)
                    $ewidth=275-$lines[$element_line]+$margin;
                else
                {
                    if($form_input["column"] == 0)
                        $ewidth=355-$lines[$element_line]+$margin;
                    else
                        $ewidth=755-$lines[$element_line]+$margin;
                }
            }
            else {
                if($form_input["column"] == 0)
                    $ewidth=212-$lines[$element_line]+$margin;
                else
                    $ewidth=452-$lines[$element_line]+$margin;
            }

            if (isset($form_input['newline'])){
                $linewidth = $form_input['width'];
            }
            else $linewidth += $form_input['width'];


            if ($form_input['width']==100)
            {
                $form_input['ewidthpx'] = $ewidth;
                $linewidth = 0;
            }
            elseif ($linewidth>100 )
            {
                $form_input['ewidthpx'] = (int)($ewidth*$form_input['width']/100);
                $linewidth = 0;
            }
            else
            {
                $form_input['ewidthpx'] = (int)($ewidth*$form_input['width']/100);
            }


            if($lines[$element_line]==$dimension && $form_input['width']>=40 && $form_input['width']<=90){
                $form_input['ewidthpx'] = (int)(($ewidth-$dimension)*$form_input['width']/100);
            }
            elseif($lines[$element_line]==$dimension && $form_input['width']<40 && $form_input['width']>32){
                $form_input['ewidthpx'] = (int)(($ewidth-2*$dimension)*$form_input['width']/100);
            }
            elseif($lines[$element_line]==$dimension && $form_input['width']<33){
                $form_input['ewidthpx'] = (int)(($ewidth-3*$dimension)*$form_input['width']/100);
            }

           // if($is_preview && $input['type'] == 'select') $form_input['ewidthpx'] -=26;

            $input_field=$input['type']($input,$form_input);

            if(stripos('[input]',$form['form_template'])!==false){
            } else {
                if(isset($form_input_arr1['column']) && $form_input["column"]==0) $out_left .= $input_field;
                else $out_right .=$input_field;
            }

            $fcount++;
        }

        $surse=get_template_directory_uri().'/images/ajax-loader.gif';
        $out_left .= '</div>';
        $out_right .= '<div class="clear"></div><span class="btn btn-submit-contact-form">
            <input type="submit" id="sending" class=" btn-send2" style="display: none;" value="'.__('Sending','tfuse').'..." />
            <input type="submit" id="send_form"  name="submit" class="btn-submit2" title="Submit mesage" value="'. $form['submit_mess'].'" />
            <img id="sending_img" src="'.$surse.'" alt="" style="margin-bottom: -25px;display: none; border:0;" /></span>
        </span>';
        $out .= $out_left.$out_right;
        $out .='</form><div class="clear"></div></div></div><div class="clear"></div></section>';

    } else {
        $out="<p>This Form is not defined!!</p>";
    }
	global $wp_query;
    if(!isset($wp_query->queried_object->ID))
        return $out;
    return $out;
}

$forms_name=array(-1=>'Choose Form');
$forms = get_option(TF_THEME_PREFIX . '_tfuse_contact_forms');
if(!empty($forms)){
    foreach($forms as $key=>$value){
        $forms_name[$key]=$value['form_name'];
    }
}
$atts = array(
    'name' => __('Contact Form', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Type', 'tfuse'),
            'desc' => __('Select the form', 'tfuse'),
            'id' => 'tf_cf_formid',
            'value' => '',
            'options' => $forms_name,
            'type' => 'select'
        )
    )
);

tf_add_shortcode('tfuse_contactform', 'tf_contactform_shortcode', $atts);
function text($input,$form_input){
//    if($form_input['classes']!=' omega ')$dist = 12;
//    else $dist = 0;
    
        return "<div class='field-text ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px; ".$form_input['floating']."'>
                <input type='text' style='width:".$form_input['ewidthpx']."px;' class='".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'. trim($form_input['shortcode'])."' value='' placeholder='".$form_input['label_text']."' onblur=' if (this.placeholder == \"\") {this.placeholder = \"".$form_input['label_text']."\";}' onfocus='if (this.placeholder == \"".$form_input['label_text']."\") {this.placeholder = \"\";}'  />
            </div>";
}

function textarea($input,$form_input){
    return "<div class='field-text field-text' style='".$form_input['floating']."'>
                <textarea style='width:".$form_input['ewidthpx']."px;' class='".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."' rows='10' value='' placeholder='".$form_input['label_text']."' onblur=' if (this.placeholder == \"\") {this.placeholder = \"".$form_input['label_text']."\";}' onfocus='if (this.placeholder == \"".$form_input['label_text']."\") {this.placeholder = \"\";}'></textarea>
            </div>";
}

function radio($input,$form_input){
//    if($form_input['classes']!=' omega ')$dist = 12;
//    else $dist = 0;
    $checked='checked="checked"';
    $output="<div class='field-text radio ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px;".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'>".$form_input['label_text']."</label>";

    if(is_array($form_input['options'])){
        foreach ($form_input['options'] as $key => $option) {
            $output .= '<div class=rowRadio"><input '.$checked.' id="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '_'.$key.'"  type="radio" name="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '"  value="' .$option. '" /><label class="radiolabel" for="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '_'.$key.'">' . urldecode($option) . '</label></div>';
            $checked='';
        }
    }

    $output .= "</div>";
    return $output;
}
function checkbox($input,$form_input){
//    if($form_input['classes']!=' omega ')$dist = 12;
//    else $dist = 0;
    $checked = ($input['value'] == 'true') ? 'checked="checked"' : '';
    $output = "<div class='field-text checkbox ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px;".$form_input['floating']."'>
                <div class='rowCheckbox'><input class='".$input['properties']['class']."' style='width:15px; float:left;' type='checkbox' name='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' id='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' value='".$form_input['label']."'" . $checked . "/></div>
                <label class='label_title' for='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "'>".$form_input['label_text']."</label>
            </div>";
    return $output;
}
function captcha($input,$form_input){
    $input['properties']['class']="tfuse_captcha_input";
    $out="<div class='field-text captcha ' style='".$form_input['floating']."'>
            <img  src='".TFUSE_EXT_URI."/contactform/library/".$input['file_name']."?form_id=".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."&ver=".rand(0, 15)."' class='tfuse_captcha_img' >
            <input type='button' class='tfuse_captcha_reload' /><br>
            <input style='width:".$form_input['ewidthpx']."px;' id='".trim($input['id'])."' type='text' class='inputtext ".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."' placeholder='".$form_input['label_text']."' onblur=' if (this.placeholder == \"\") {this.placeholder = \"".$form_input['label_text']."\";}' onfocus='if (this.placeholder == \"".$form_input['label_text']."\") {this.placeholder = \"\";}'/>
         </div>";
    return $out;
}

function select($input,$form_input){
//    if($form_input['classes']!=' omega ')$dist = 12;
//    else $dist = 0;
    $input['properties']['class'].=' tfuse_option';
    $out = "<div class='field-text ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px; ".$form_input['floating']."'>
                <select  style='width:".($form_input['ewidthpx'])."px;' class='".$input['properties']['class']."' name='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' >";
    if(is_array($form_input['options'])){
        foreach ($form_input['options'] as $key => $option) {
            $out .= "<option value='" . $option . "'>";
            $out .= $option;
            $out .= "</option>\r\n";
        }
    }
    $out .= '</select></div>';
    return $out;
}