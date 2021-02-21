        <label for="tie_home_cats[<?php echo $i ?>][order]">
            <span>Position order :</span>
            <input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][order]" name="tie_home_cats[<?php echo $i ?>][order]" value="<?= !empty($cat['order']) ? $cat['order'] : 1 ?>" type="text" />
        </label>

        <input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
        <input id="tie_home_cats[<?php echo $i ?>][type]" name="tie_home_cats[<?php echo $i ?>][type]" value="group-template" type="hidden" />
        <a class="del-cat"></a>    
    </div>
</li>