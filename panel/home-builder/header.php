<div class="widget-head"> <?= $boxTitle ?>
    <a class="toggle-open">+</a>
    <a class="toggle-close">-</a>
</div>

<div class="widget-content">
    <label for="tie_home_cats[<?php echo $i ?>][title]">
        <span><?= __('Box Title') ?> :</span>
        <input id="tie_home_cats[<?php echo $i ?>][title]" 
            name="tie_home_cats[<?php echo $i ?>][title]" 
            value="<?= $boxTitle ?>" 
            type="text" />
    </label>
    <label for="tie_home_cats[<?php echo $i ?>][show_title]">
        <span><?= __('Show Title') ?> :</span>
        <select name="tie_home_cats[<?php echo $i ?>][show_title]" id="tie_home_cats[<?php echo $i ?>][show_title]">
            <option <?php if( isset($cat['show_title']) && $cat['show_title'] == 'y' ) echo 'selected="selected"'; ?> value="y">Yes</option>
            <option <?php if(!isset($cat['show_title']) || (isset($cat['show_title']) && $cat['show_title'] == 'n')) echo 'selected="selected"'; ?> value="n">No</option>
        </select>
    </label>

    