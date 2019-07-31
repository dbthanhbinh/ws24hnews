<label class="build-home-item">
    <span style="float:left;"><?= __('Select Categories') ?> : </span>
    <select name="tie_home_cats[<?php echo $i ?>][include][]" id="tie_home_cats[<?php echo $i ?>][include][]">
        <?php foreach ($categories as $key => $option) { ?>
            <option value="<?php echo $key ?>" <?php if ( @in_array( $key , $cat['include'] ) ) { echo ' selected="selected"' ; } ?>>
                <?php echo $option; ?>
            </option>
        <?php } ?>
    </select>
</label>
<label class="build-home-item" for="tie_home_cats[<?php echo $i ?>][number]">
    <span><?= __('Number of posts to show') ?> :</span>
    <input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" 
        name="tie_home_cats[<?php echo $i ?>][number]" 
        value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" 
        type="text" />
</label>
<label class="build-home-item">   
    <span style="float:left;">Box layout : </span>
    <ul class="tie-cats-options tie-options">
        <li style="margin-right: 5px!important; width: 70px;">
            <input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="11" <?php if ( $layout =='11' ) echo 'checked="checked"' ?> />
            <a class="checkbox-select" href="#"><img style="max-width: 88%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/panel/images/11.png" /></a>
        </li>
        <li style="margin-right: 5px!important; width: 70px;">
            <input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="12" <?php if ( $layout =='12' ) echo 'checked="checked"'; ?> />
            <a class="checkbox-select" href="#"><img style="max-width: 88%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/panel/images/12.png" /></a>
        </li>
        <li style="margin-right: 5px!important; width: 70px;">
            <input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="13" <?php if ( $layout =='13' ) echo 'checked="checked"'; ?> />
            <a class="checkbox-select" href="#"><img style="max-width: 88%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/panel/images/13.png" /></a>
        </li>
        <li style="margin-right: 5px!important; width: 70px;">
            <input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="14" <?php if ( $layout =='14' ) echo 'checked="checked"'; ?> />
            <a class="checkbox-select" href="#"><img style="max-width: 88%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/panel/images/14.png" /></a>
        </li>                                                    
    </ul>
</label>
<div class="build-home-item" for="tie_home_cats[<?php echo $i ?>][layout_color]">
    <span class="span-item"><?= __('Layout color') ?> :</span>
    <?php $val = '#ffffff'; ?>
    <input type="text" name="tie_home_cats[<?php echo $i ?>][layout_color]" value="<?php   if( !empty($cat['layout_color']) ) echo $cat['layout_color']; else echo $val;  ?>" class="cpa-color-picker" >
</div>