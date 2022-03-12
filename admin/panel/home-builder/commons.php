<?php
function showLayoutDropdownGroupTemplate($i, $cat, $defaultValue = 'home_group_1'){
    
    if(isset($cat['home_group']) && $cat['home_group'])
        $defaultValue = $cat['home_group'];
        
    $temp1Checked = '';
    $temp2Checked = '';

    if($defaultValue == 'home_group_1'){
        $temp1Checked = 'checked="checked"';
        $temp2Checked = '';
    }
    else {
        $temp2Checked = 'checked="checked"';
        $temp1Checked = '';
    }

    $html = '
        <label for="tie_home_cats['.$i.'][home_group]">
            <span>Show layout :</span><span class="group-item-new-layout">';
            
            $html .= '
            <span class="item-new-layout">
                <input name="tie_home_cats['.$i.'][home_group]" id="tie_home_cats['.$i.'][home_group]" type="radio" value="home_group_1" '.$temp1Checked.'>
                <img src="'.get_template_directory_uri().'/admin/panel/images/group_temp_1_thumb.JPG" />
            </span>
            <span class="item-new-layout">
                <input name="tie_home_cats['.$i.'][home_group]" id="tie_home_cats['.$i.'][home_group]" type="radio" value="home_group_2" '.$temp2Checked.'>
                <img src="'.get_template_directory_uri().'/admin/panel/images/group_temp_2_thumb.JPG" />
            </span>
            ';
            
    $html .= '</span></label>';
    return $html;
}

function showLayoutDropdown($i, $cat, $defaultValue = 'temp-1'){
    if(isset($cat['show_layout']) && $cat['show_layout'])
        $defaultValue = $cat['show_layout'];
        
    $temp1Checked = '';
    $temp2Checked = '';

    if($defaultValue == 'temp-2'){
        $temp2Checked = 'checked="checked"';
        $temp1Checked = '';
    }
    else {
        $temp1Checked = 'checked="checked"';
        $temp2Checked = '';
    }

    $html = '
        <label for="tie_home_cats['.$i.'][show_layout]">
            <span>Show layout :</span><span class="group-item-new-layout">';
            
            $html .= '
            <span class="item-new-layout">
                <input name="tie_home_cats['.$i.'][show_layout]" id="tie_home_cats['.$i.'][show_layout]" type="radio" value="temp-1" '.$temp1Checked.'>
                <img src="'.get_template_directory_uri().'/admin/panel/images/news-temp-1.png" />
            </span>
            <span class="item-new-layout">
                <input name="tie_home_cats['.$i.'][show_layout]" id="tie_home_cats['.$i.'][show_layout]" type="radio" value="temp-2" '.$temp2Checked.'>
                <img src="'.get_template_directory_uri().'/admin/panel/images/news-temp-2.png" />
            </span>
            ';
            
    $html .= '</span></label>';
    return $html;
}

function showLayoutDropdownBk($i, $cat, $defaultValue = 'n'){
    if(isset($cat['show_layout']) && $cat['show_layout'])
        $defaultValue = $cat['show_layout'];
        
    $html = '
        <label for="tie_home_cats['.$i.'][show_layout]">
            <span>Show layout :</span>
            <select id="tie_home_cats['.$i.'][show_layout]" name="tie_home_cats['.$i.'][show_layout]">';
                $selectedYes = '';
                $selectedNo = '';

                if($defaultValue == 'y'){
                    if(!isset($cat['show_layout']) || ($cat['show_layout'] == 'y')){
                        $selectedYes = 'selected="selected"';
                        $selectedNo = '';
                    } else if(isset($cat['show_layout']) || ($cat['show_layout'] == 'n')){
                        $selectedYes = '';
                        $selectedNo = 'selected="selected"';
                    }
                  
                    $html .= '
                        <option value="y" '.$selectedYes.' >Fullwith</option>
                        <option value="n" '.$selectedNo.' >Normal</option>
                    ';

                } else {
                    if(!isset($cat['show_layout']) || ($cat['show_layout'] == 'n')){
                        $selectedYes = '';
                        $selectedNo = 'selected="selected"';
                    } else if(isset($cat['show_layout']) || ($cat['show_layout'] == 'y')){
                        $selectedYes = 'selected="selected"';
                        $selectedNo = '';
                    }

                    $html .= '
                        <option value="n" '.$selectedNo.' >Normal</option>
                        <option value="y" '.$selectedYes.' >Fullwith</option>
                    ';
                }
                $html .= '</select> </label>';
    return $html;
}

function showLayoutDropdownAppointment($i, $cat, $defaultValue = 'lr'){
    if(isset($cat['show_layout']) && $cat['show_layout'])
        $defaultValue = $cat['show_layout'];
        
    $html = '
        <label for="tie_home_cats['.$i.'][show_layout]">
            <span>Show layout :</span>
            <select id="tie_home_cats['.$i.'][show_layout]" name="tie_home_cats['.$i.'][show_layout]">';
                $selectedYes = '';
                $selectedNo = '';

                if($defaultValue == 'lr'){
                    if(!isset($cat['show_layout']) || ($cat['show_layout'] == 'lr')){
                        $selectedYes = 'selected="selected"';
                        $selectedNo = '';
                    } else if(isset($cat['show_layout']) || ($cat['show_layout'] == 'rl')){
                        $selectedYes = '';
                        $selectedNo = 'selected="selected"';
                    }
                  
                    $html .= '
                        <option value="lr" '.$selectedYes.' >Left right</option>
                        <option value="rl" '.$selectedNo.' >Right left</option>
                    ';

                } else {
                    if(!isset($cat['show_layout']) || ($cat['show_layout'] == 'rl')){
                        $selectedYes = '';
                        $selectedNo = 'selected="selected"';
                    } else if(isset($cat['show_layout']) || ($cat['show_layout'] == 'lr')){
                        $selectedYes = 'selected="selected"';
                        $selectedNo = '';
                    }

                    $html .= '
                        <option value="rl" '.$selectedNo.' >Right left</option>
                        <option value="lr" '.$selectedYes.' >Left right</option>
                    ';
                }
                $html .= '</select> </label>';
    return $html;
}