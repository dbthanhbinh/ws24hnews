<?php
function showLayoutDropdown($i, $cat, $defaultValue = 'n'){
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