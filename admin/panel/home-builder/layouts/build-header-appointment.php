<li id="listItem_<?php echo $i ?>" class="ui-state-default">
    <div class="widget-head"> <?=  !empty($cat['title']) ? $cat['title'] : __('Recent Posts', THEMENAME) ?>
        <a class="toggle-open">+</a>
        <a class="toggle-close">-</a>
    </div>
    <div class="widget-content">
        <label for="tie_home_cats[<?php echo $i ?>][show_box]">
            <span><?= __('Show/Hiden Box :', THEMENAME) ?></span>
            <select id="tie_home_cats[<?php echo $i ?>][show_box]" name="tie_home_cats[<?php echo $i ?>][show_box]">
                <option value="y" <?php if (!isset($cat['show_box']) || ($cat['show_box'] == 'y')) { echo ' selected="selected"' ; } ?>>Show</option>
                <option value="n" <?php if(isset($cat['show_box']) && $cat['show_box'] == 'n') { echo ' selected="selected"'; } ?>>Hidden</option>
            </select>
        </label>

        <label for="tie_home_cats[<?php echo $i ?>][title]">
            <span><?= __('Box Title :', THEMENAME) ?></span>
            <input id="tie_home_cats[<?php echo $i ?>][title]"
                name="tie_home_cats[<?php echo $i ?>][title]"
                value="<?php if( !empty($cat['title']) ) echo $cat['title'] ?>"
                type="text"
            />
        </label>
        <label for="tie_home_cats[<?php echo $i ?>][show_title]">
            <span><?= __('Show Box Title :', THEMENAME) ?></span>
            <select id="tie_home_cats[<?php echo $i ?>][show_title]" name="tie_home_cats[<?php echo $i ?>][show_title]">
                <option value="n" <?php if ( !isset($cat['show_title']) || ($cat['show_title'] == 'n')) { echo ' selected="selected"' ; } ?>>Hidden</option>
                <option value="y" <?php if ( (isset($cat['show_title']) && $cat['show_title']) == 'y') { echo ' selected="selected"' ; } ?>>Show</option>
            </select>
        </label>
        <?php if(isset($isShowLayoutDropdown) && $isShowLayoutDropdown) echo showLayoutDropdownAppointment($i, $cat, $defaultLayout) ?>

        <label for="tie_home_cats[<?php echo $i ?>][description]">
            <span><?= __('Box description :', THEMENAME) ?></span>
            <textarea style="direction:ltr; text-align:left"
            id="tie_home_cats[<?php echo $i ?>][description]"
            name="tie_home_cats[<?php echo $i ?>][description]"
            type="textarea" cols="100%" rows="3" tabindex="4"><?php if( !empty($cat['description']) ) echo $cat['description'] ?></textarea>
        </label>
        <label for="tie_home_cats[<?php echo $i ?>][show_description]">
            <span><?= __('Show Box description :', THEMENAME) ?></span>
            <select id="tie_home_cats[<?php echo $i ?>][show_description]" name="tie_home_cats[<?php echo $i ?>][show_description]">
                <option value="y" <?php if ( !isset($cat['show_description']) || ($cat['show_description'] == 'y')) { echo ' selected="selected"' ; } ?>>Show</option>
                <option value="n" <?php if(isset($cat['show_description']) && $cat['show_description'] == 'n') { echo ' selected="selected"'; } ?>>Hidden</option>
            </select>
        </label>

        <label for="tie_home_cats[<?php echo $i ?>][header]">
            <span><?=  __('Box header :', THEMENAME) ?></span>
            <input id="tie_home_cats[<?php echo $i ?>][header]"
                name="tie_home_cats[<?php echo $i ?>][header]"
                value="<?php if( !empty($cat['header']) ) echo $cat['header'] ?>"
                type="text"
            />
        </label>
        <label for="tie_home_cats[<?php echo $i ?>][summaries]">
            <span><?=  __('Box summaries :', THEMENAME) ?></span>
            <?php
                $content = !empty($cat['summaries']) ? html_entity_decode($cat['summaries']) : '';
                $editor_id = "tie_home_cats_".$i."_summaries";
				$args = array(
					'media_buttons' => false,
					'textarea_rows' => 5,
					'textarea_name' => "tie_home_cats[".$i."][summaries]"
				);
				wp_editor( $content, $editor_id, $args);
            ?>
        </label>
        <label for="tie_home_cats[<?php echo $i ?>][workinghours]">
            <span><?=  __('Working hours :', THEMENAME) ?></span>
            <?php
                $content = !empty($cat['workinghours']) ? html_entity_decode($cat['workinghours']) : '';
                $editor_id = "tie_home_cats_".$i."_workinghours";
				$args = array(
					'media_buttons' => false,
					'textarea_rows' => 5,
					'textarea_name' => "tie_home_cats[".$i."][workinghours]"
				);
				wp_editor( $content, $editor_id, $args);
            ?>
        </label>