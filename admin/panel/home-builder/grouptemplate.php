<?php require('layouts/build-header-group.php'); ?>
        <!-- Display Mode -->
        <label for="tie_home_cats[<?php echo $i ?>][home_group]"><span>Display Group template:</span>
            <select id="tie_home_cats[<?php echo $i ?>][home_group]" name="tie_home_cats[<?php echo $i ?>][home_group]">
                <?php
                for($g=1 ; $g<=2; $g++){
                    $groupVal = 'home_group_'.$g;
                    ?>
                    <option value="home_group_<?= $g ?>" <?php if ($cat['home_group'] == $groupVal) { echo ' selected="selected"' ; } ?>>Group template <?= $g ?></option>
                    <?php
                }
                ?>
            </select>
        </label>
        
<?php require('layouts/build-footer-group.php'); ?>
    