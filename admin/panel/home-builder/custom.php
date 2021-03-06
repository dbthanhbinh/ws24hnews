<?php require('layouts/build-header-group.php'); ?>
    <label for="tie_home_cats[<?php echo $i ?>][box_content]">
        <span>Box content/Html content :</span>
        <textarea style="direction:ltr; text-align:left"
        id="tie_home_cats[<?php echo $i ?>][box_content]"
        name="tie_home_cats[<?php echo $i ?>][box_content]"
        type="textarea" cols="100%" rows="10" tabindex="4"><?php if( !empty($cat['box_content']) ) echo $cat['box_content'] ?></textarea>
    </label>

    <label for="tie_home_cats[<?php echo $i ?>][show_navigate_btn]">
        <span>Show Box Button Navigator:</span>
        <select id="tie_home_cats[<?php echo $i ?>][show_navigate_btn]" name="tie_home_cats[<?php echo $i ?>][show_navigate_btn]">
            <option value="y" <?php if (!isset($cat['show_navigate_btn']) || ($cat['show_navigate_btn'] == 'y')) { echo ' selected="selected"' ; } ?>>Show</option>
            <option value="n" <?php if(isset($cat['show_navigate_btn']) && $cat['show_navigate_btn'] == 'n') { echo ' selected="selected"'; } ?>>Hidden</option>
        </select>
    </label>

    <label for="tie_home_cats[<?php echo $i ?>][box_navigate_text]">
        <span>Box Button Navigator text:</span>
        <input id="tie_home_cats[<?php echo $i ?>][box_navigate_text]"
        name="tie_home_cats[<?php echo $i ?>][box_navigate_text]"
        placeholder="More features"
        value="<?php if(!empty($cat['box_navigate_text'])) {echo $cat['box_navigate_text'];} else {echo 'More feature';} ?>"
        type="text" />
    </label>

    <label for="tie_home_cats[<?php echo $i ?>][box_navigate_url]">
        <span>Box Button Navigator Url:</span>
        <input id="tie_home_cats[<?php echo $i ?>][box_navigate_url]"
        name="tie_home_cats[<?php echo $i ?>][box_navigate_url]"
        placeholder="http://abc.com"
        value="<?php   if( !empty($cat['box_navigate_url']) ) echo $cat['box_navigate_url']  ?>"
        type="text" />
    </label>

    <label for="tie_home_cats[<?php echo $i ?>][box_background_url]">
        <span>Box custom background Url:</span>
        <input id="tie_home_cats[<?php echo $i ?>][box_background_url]"
        name="tie_home_cats[<?php echo $i ?>][box_background_url]"
        placeholder="http://abc.com/images/a.png"
        value="<?php   if( !empty($cat['box_background_url']) ) echo $cat['box_background_url']  ?>"
        type="text" />
        <p class="tie_message_hint">Get Url by access <a target="_blank" href="<?= site_url() ?>/wp-admin/media-new.php">Media</a> and upload image(1920x600)px</p>
    </label>
    <?php
    tie_options(
        array(	"name" => "Use custom background",
                "id" => "use_background_url",
                "type" => "checkbox"));
    ?>
        
<?php require('layouts/build-footer-group.php'); ?>