<?php
if (!function_exists('tf_callback_select_hour')):

    function tf_callback_select_hour()
    {
        global $post;
        $html = $min = $m = "";
        $saved_time = tfuse_page_options('event_hour_min', false, $post->ID);
        $html .= '<select class="select_hour"  id="'.TF_THEME_PREFIX.'_event_hours" name="'.TF_THEME_PREFIX.'_event_hour" >';
        for($i=1; $i<=12; $i++) {
            if($saved_time['hour'] == $i)
                $html .= '<option selected="selected" value="'.$i.'">'.$i.'</option>';
            else
                $html .= '<option value="'.$i.'">'.$i.'</option>';
        }
        $html .= '</select>
              <select class="select_minute" id="'.TF_THEME_PREFIX.'_event_minute" name="'.TF_THEME_PREFIX.'_event_minute">';
        for($i=0; $i<4; $i++) {
            if($i == 0) $min = '00';
            elseif($i == 1) $min = '15';
            elseif($i == 2) $min = '30';
            else $min = '45';

            if($saved_time['minute'] == $min)
                $html .= '<option selected="selected" value="'.$min.'">'.$min.'</option>';
            else
                $html .= '<option value="'.$min.'">'.$min.'</option>';
        }
        $html .= '</select>
              <select class="select_time" id="'.TF_THEME_PREFIX.'_event_time"  name="'.TF_THEME_PREFIX.'_event_time">';
        for($i=1; $i<=2; $i++) {
            if($i == 1) $m = 'AM';
            else $m = 'PM';

            if($saved_time['time'] == $m)
                $html .= '<option selected="selected" value="'.$m.'">'.$m.'</option>';
            else
                $html .= '<option value="'.$m.'">'.$m.'</option>';
        }
        $html .='</select>';

        return $html;
    }
endif;

if (!function_exists('select_hour_end')):

    function select_hour_end()
    {
        global $post;
        $html = $min = $m = "";
        $saved_time = tfuse_page_options('end_hour_min', false, $post->ID);
        $html .= '<select class="select_hour"  id="'.TF_THEME_PREFIX.'_event_hours_end" name="'.TF_THEME_PREFIX.'_event_hour_end" >';
        for($i=1; $i<=12; $i++) {
            if($saved_time['hour'] == $i)
                $html .= '<option selected="selected" value="'.$i.'">'.$i.'</option>';
            else
                $html .= '<option value="'.$i.'">'.$i.'</option>';
        }
        $html .= '</select>
              <select class="select_minute" id="'.TF_THEME_PREFIX.'_event_minute_end" name="'.TF_THEME_PREFIX.'_event_minute_end">';
        for($i=0; $i<4; $i++) {
            if($i == 0) $min = '00';
            elseif($i == 1) $min = '15';
            elseif($i == 2) $min = '30';
            else $min = '45';

            if($saved_time['minute'] == $min)
                $html .= '<option selected="selected" value="'.$min.'">'.$min.'</option>';
            else
                $html .= '<option value="'.$min.'">'.$min.'</option>';
        }
        $html .= '</select>
              <select class="select_time" id="'.TF_THEME_PREFIX.'_event_time_end"  name="'.TF_THEME_PREFIX.'_event_time_end">';
        for($i=1; $i<=2; $i++) {
            if($i == 1) $m = 'AM';
            else $m = 'PM';

            if($saved_time['time'] == $m)
                $html .= '<option selected="selected" value="'.$m.'">'.$m.'</option>';
            else
                $html .= '<option value="'.$m.'">'.$m.'</option>';
        }
        $html .='</select>';

        return $html;
    }
endif;