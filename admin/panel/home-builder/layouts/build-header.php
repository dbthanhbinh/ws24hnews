<li id="listItem_<?php echo $i ?>" class="ui-state-default">
    <div class="widget-head"> <?=  !empty($cat['title']) ? $cat['title'] : 'Recent Posts' ?>
        <a class="toggle-open">+</a>
        <a class="toggle-close">-</a>
    </div>
    <div class="widget-content">
        <label for="tie_home_cats[<?php echo $i ?>][show_box]">
            <span>Show/Hiden Box :</span>
            <select id="tie_home_cats[<?php echo $i ?>][show_box]" name="tie_home_cats[<?php echo $i ?>][show_box]">
                <option value="y" <?php if (!isset($cat['show_box']) || ($cat['show_box'] == 'y')) { echo ' selected="selected"' ; } ?>>Show</option>
                <option value="n" <?php if(isset($cat['show_box']) && $cat['show_box'] == 'n') { echo ' selected="selected"'; } ?>>Hidden</option>
            </select>
        </label>

        <label for="tie_home_cats[<?php echo $i ?>][title]">
            <span>Box Title :</span>
            <input id="tie_home_cats[<?php echo $i ?>][title]"
                name="tie_home_cats[<?php echo $i ?>][title]"
                value="<?php if( !empty($cat['title']) ) echo $cat['title'] ?>"
                type="text"
            />
        </label>
        <label for="tie_home_cats[<?php echo $i ?>][show_title]">
            <span>Show Box Title :</span>
            <select id="tie_home_cats[<?php echo $i ?>][show_title]" name="tie_home_cats[<?php echo $i ?>][show_title]">
                <option value="n" <?php if ( !isset($cat['show_title']) || ($cat['show_title'] == 'n')) { echo ' selected="selected"' ; } ?>>Hidden</option>
                <option value="y" <?php if ( (isset($cat['show_title']) && $cat['show_title']) == 'y') { echo ' selected="selected"' ; } ?>>Show</option>
            </select>
        </label>
        <label for="tie_home_cats[<?php echo $i ?>][description]">
            <span>Box description :</span>
            <textarea style="direction:ltr; text-align:left"
            id="tie_home_cats[<?php echo $i ?>][description]"
            name="tie_home_cats[<?php echo $i ?>][description]"
            type="textarea" cols="100%" rows="3" tabindex="4"><?php if( !empty($cat['description']) ) echo $cat['description'] ?></textarea>
        </label>
        <label for="tie_home_cats[<?php echo $i ?>][show_description]">
            <span>Show Box description :</span>
            <select id="tie_home_cats[<?php echo $i ?>][show_description]" name="tie_home_cats[<?php echo $i ?>][show_description]">
                <option value="y" <?php if ( !isset($cat['show_description']) || ($cat['show_description'] == 'y')) { echo ' selected="selected"' ; } ?>>Show</option>
                <option value="n" <?php if(isset($cat['show_description']) && $cat['show_description'] == 'n') { echo ' selected="selected"'; } ?>>Hidden</option>
            </select>
        </label>