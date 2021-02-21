<?php require('layouts/build-header.php'); ?>
    <!-- Display Mode -->
    <?php
    $isActive = 'active';
    if(isset($cat['display']) && $cat['display'] != 'grid')
        $isActive = 'inactive';
    ?>
    <label for="tie_home_cats[<?php echo $i ?>][display]"><span>Display Mode:</span>
        <select class="display_mode_choosing_js" data-id="<?=$i?>" id="tie_home_cats[<?php echo $i ?>][display]" name="tie_home_cats[<?php echo $i ?>][display]">
            <option value="grid" <?php if ( !isset($cat['display']) || ($cat['display'] == 'grid')) { echo ' selected="selected"' ; } ?>>As Grid</option>
            <option value="list" <?php if ( $cat['display'] == 'list') { echo ' selected="selected"' ; } ?>>As list</option>
        </select>
    </label>

    <label id="display_mode_choosing_show_cols_<?=$i?>" class="display_mode_choosing_show <?=$isActive?>" for="tie_home_cats[<?php echo $i ?>][grid_cols]"><span>Show cols:</span>
        <select id="tie_home_cats[<?php echo $i ?>][grid_cols]" name="tie_home_cats[<?php echo $i ?>][grid_cols]">
            <option value="4" <?php if ( !isset($cat['grid_cols']) || ($cat['grid_cols'] == 4)) { echo ' selected="selected"' ; } ?>>4 cols</option>
            <option value="3" <?php if ( $cat['grid_cols'] == 3) { echo ' selected="selected"' ; } ?>>3 cols</option>
            <option value="6" <?php if ( $cat['grid_cols'] == 6) { echo ' selected="selected"' ; } ?>>6 cols</option>
        </select>
    </label>

    <label for="tie_home_cats[<?php echo $i ?>][number]">
        <span>Number of posts to show :</span>
        <input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" />
    </label>
    
    <p id="display_mode_choosing_show_message_<?=$i?>" class="tie_message_hint display_mode_choosing_show <?=$isActive?>">If you are choosing <i>Display Mode</i> as <strong>Grid</strong>, Please input <strong>Number of posts to show</strong> divisible by [3,4,6] </p>
<?php require('layouts/build-footer.php'); ?>