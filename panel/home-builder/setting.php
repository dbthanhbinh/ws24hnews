<h2>Homepage</h2> <?php echo $save ?>				
    <div class="tiepanel-item">
        <h3>Home page displays</h3>
        <?php
            tie_options(
                array( 	"name" => "Home page displays",
                        "id" => "on_home",
                        "type" => "radio",
                        "options" => array( "latest"=>"Latest posts - Blog Layout" ,
                                            "boxes"=>" News Boxes - use Home Builder" )));
        ?>
    </div>					
    <div id="Home_Builder" style="width:100%;">
        <div class="tiepanel-item"  style=" overflow: visible; ">
            <h3>Home Builder 					<a id="collapse-all">[-] Collapse All</a>
                <a id="expand-all">[+] Expand All</a></h3>
            <div class="option-item">

                <select style="display:none" id="cats_defult">
                    <?php foreach ($categories as $key => $option) { ?>
                    <option value="<?php echo $key ?>"><?php echo $option; ?></option>
                    <?php } ?>
                </select>
            
                
                <div style="clear:both"></div>
                <div class="home-builder-buttons">
                    <a id="add-cat" >News Box</a>
                    <a id="add-slider" >Scrolling Box</a>
                    <a id="add-ads" >Ads / Custom Content</a>
                    <a id="add-news-picture" >News in picture</a>
                    <a id="add-news-videos" >Videos</a>
                    <a id="add-recent" >Recent Posts</a>
                    <a id="add-divider" >Divider</a>
                </div>
                                    
                <ul id="cat_sortable">
                    <?php
                        $cats = get_option( 'tie_home_cats' ) ;
                        $i=0;
                        if($cats){
                            foreach ($cats as $cat) { 
                                $i++;
                                ?>
                                <li id="listItem_<?php echo $i ?>" class="ui-state-default">
        
                            <?php 
                                if( $cat['type'] == 'n' ) :	?>
                                    <div class="widget-head"> News Box : <?php if( !empty($cat['custom_title']) ) echo $cat['custom_title']; else if(!empty($cat['id'])) echo get_the_category_by_ID( $cat['id'] ); ?>
                                        <a class="toggle-open">+</a>
                                        <a class="toggle-close">-</a>
                                    </div>
                                    <div class="widget-content">
                                        <label><span>Box Category : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
                                            <?php foreach ($categories as $key => $option) { ?>
                                            <option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
                                            <?php } ?>
                                        </select></label>
                                        <label><span>Posts Order : </span><select name="tie_home_cats[<?php echo $i ?>][order]" id="tie_home_cats[<?php echo $i ?>][order]"><option value="latest" <?php if( $cat['order'] == 'latest' || $cat['order']=='' ) echo 'selected="selected"'; ?>>Latest Posts</option><option  <?php if( $cat['order'] == 'rand' ) echo 'selected="selected"'; ?> value="rand">Random Posts</option></select></label>
                                        <label><span>Show Title : </span><select name="tie_home_cats[<?php echo $i ?>][show_title]" id="tie_home_cats[<?php echo $i ?>][show_title]"><option value="y" <?php if( $cat['show_title'] == 'y' || $cat['show_title']=='' ) echo 'selected="selected"'; ?>>Yes</option><option  <?php if( $cat['show_title'] == 'n' ) echo 'selected="selected"'; ?> value="n">No</option></select></label>
                                        <label><span>Show excerpt : </span><select name="tie_home_cats[<?php echo $i ?>][show_excerpt]" id="tie_home_cats[<?php echo $i ?>][show_excerpt]"><option value="n" <?php if( $cat['show_excerpt'] == 'n' || $cat['show_excerpt']=='' ) echo 'selected="selected"'; ?>>No</option><option  <?php if( $cat['show_excerpt'] == 'y' ) echo 'selected="selected"'; ?> value="y">Yes</option></select></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][custom_title]"><span>Enter custom title</span><input id="tie_home_cats[<?php echo $i ?>][custom_title]" name="tie_home_cats[<?php echo $i ?>][custom_title]" value="<?php  if( !empty($cat['custom_title']) ) echo $cat['custom_title']  ?>" type="text" /></label>
                                        
                                        <label for="tie_home_cats[<?php echo $i ?>][number]"><span>Number of posts to show :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php  if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
                                        <label>
                                            <span style="float:left;">Box Style : </span>
                                            <ul class="tie-cats-options tie-options">
                                                <li style="margin-right: 5px!important; width: 70px;">
                                                    <input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="11" <?php if( $cat['style'] == '11' || $cat['style']=='' || $cat['style']=='11' ) echo 'checked="checked"' ?> />
                                                    <a class="checkbox-select" href="#"><img style="max-width: 88%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/panel/images/11.png" /></a>
                                                </li>
                                                <li style="margin-right: 5px!important; width: 70px;">
                                                    <input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="12" <?php if( $cat['style'] == '12' ) echo 'checked="checked"'; ?> />
                                                    <a class="checkbox-select" href="#"><img style="max-width: 88%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/panel/images/12.png" /></a>
                                                </li>
                                                <li style="margin-right: 5px!important; width: 70px;">
                                                    <input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="13" <?php if( $cat['style'] == '13' ) echo 'checked="checked"'; ?> />
                                                    <a class="checkbox-select" href="#"><img style="max-width: 88%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/panel/images/13.png" /></a>
                                                </li>
                                                <li style="margin-right: 5px!important; width: 70px;">
                                                    <input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="14" <?php if( $cat['style'] == '14' ) echo 'checked="checked"'; ?> />
                                                    <a class="checkbox-select" href="#"><img style="max-width: 88%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/panel/images/14.png" /></a>
                                                </li>                                                    
                                            </ul>
                                        </label>
                                        
                                        <label>
                                            <?php 
                                            $color_list = ws24h_widget_color();
                                            ?>
                                        
                                            <span>Color Style</span>                                                
                                            <?php 
                                            $t=1;
                                            foreach ($color_list as $color)
                                            {                                                    
                                                $checked = '';
                                                if( isset($cat['color_style']) && $cat['color_style']==$color)
                                                    $checked = 'checked="checked"';                                                       
                                                ?>
                                                <span style="background-color: #<?php echo $color;?>; padding:2px 5px; display: inline-block; width: 10px; height: 15px;"></span>
                                                <input id="tie_home_cats[<?php echo $i ?>][color_style_<?php echo $t;?>]" name="tie_home_cats[<?php echo $i ?>][color_style]" value="<?php echo $color;?>" type="radio"  <?php echo $checked;?>/>
                                                <?php
                                                $t++;
                                            }
                                            ?>    
                                            <span style="background-color: #fff; padding:2px 5px; display: inline-block; width: 10px; height: 15px;"></span>
                                            <input id="tie_home_cats[<?php echo $i ?>][color_style_0]" name="tie_home_cats[<?php echo $i ?>][color_style]" value="fff" type="radio" <?php  if(isset($cat['color_style']) && $cat['color_style']==$color) echo 'checked="checked"';?>/>        
                                        </label>
                                        
                            <?php 
                                elseif( $cat['type'] == 'recent' ) :	?>
                                    <div class="widget-head"> Recent Posts 
                                        <a class="toggle-open">+</a>
                                        <a class="toggle-close">-</a>
                                    </div>
                                    <div class="widget-content">
                                        <label><span style="float:left;">Exclude This Categories : </span><select multiple="multiple" name="tie_home_cats[<?php echo $i ?>][exclude][]" id="tie_home_cats[<?php echo $i ?>][exclude][]">
                                            <?php foreach ($categories as $key => $option) { ?>
                                            <option value="<?php echo $key ?>" <?php if ( @in_array( $key , $cat['exclude'] ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
                                            <?php } ?>
                                        </select></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][title]"><span>Box Title :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php   if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][number]"><span>Number of posts to show :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php   if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][display]"><span>Display Mode:</span>
                                            <select id="tie_home_cats[<?php echo $i ?>][display]" name="tie_home_cats[<?php echo $i ?>][display]">
                                                <option value="default" <?php if ( $cat['display'] == 'default') { echo ' selected="selected"' ; } ?>>Default Style</option>
                                                <option value="blog" <?php if ( $cat['display'] == 'blog') { echo ' selected="selected"' ; } ?>>Blog Style</option>
                                            </select>
                                        </label>
                                        <label for="tie_home_cats[<?php echo $i ?>][pagi]"><span>Show Pagination:</span>
                                            <select id="tie_home_cats[<?php echo $i ?>][pagi]" name="tie_home_cats[<?php echo $i ?>][pagi]">
                                                <option value="n" <?php if ( $cat['pagi'] == 'n') { echo ' selected="selected"' ; } ?>>No</option>
                                                <option value="y" <?php if ( $cat['pagi'] == 'y') { echo ' selected="selected"' ; } ?>>Yes</option>
                                            </select>
                                        </label>
                                        <p class="tie_message_hint">WordPress WARNING: Setting the offset option breaks pagination, set pagination option to "NO" if you want to use the offset option.</p>
                                        <input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
                                    
                                <?php elseif( $cat['type'] == 's' ) : ?>
                                    <div class="widget-head scrolling-box"> Scrolling Box : <?php if( !empty($cat['id']) ) echo get_the_category_by_ID( $cat['id'] ); ?>
                                        <a class="toggle-open">+</a>
                                        <a class="toggle-close">-</a>
                                    </div>
                                    <div class="widget-content">
                                        <label><span>Box Category : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
                                            <?php foreach ($categories as $key => $option) { ?>
                                            <option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
                                            <?php } ?>
                                        </select></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][title]"><span>Box Title :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php   if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][number]"><span>Number of posts to show :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php   if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
                                        <input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
                                <?php elseif( $cat['type'] == 'ads' ) : ?>
                                    <div class="widget-head ads-box"> Ads / Custom Content
                                        <a class="toggle-open">+</a>
                                        <a class="toggle-close">-</a>
                                    </div>
                                    <div class="widget-content">
                                        <textarea cols="36" rows="5" name="tie_home_cats[<?php echo $i ?>][text]" id="tie_home_cats[<?php echo $i ?>][text]"><?php  if( !empty($cat['text']) ) echo stripslashes($cat['text']) ; ?></textarea>
                                        <input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
                                        <small>Supports <strong>Text, HTML and Shortcodes</strong> .</small>

                                    
                                <?php elseif( $cat['type'] == 'news-pic' ) : ?>
                                    <div class="widget-head news-pic-box">  News In Picture
                                        <a class="toggle-open">+</a>
                                        <a class="toggle-close">-</a>
                                    </div>
                                    <div class="widget-content">
                                        <label><span>Box Category : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
                                            <?php foreach ($categories as $key => $option) { ?>
                                            <option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
                                            <?php } ?>
                                        </select></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][title]"><span>Box Title :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
                                        <label>
                                            <span style="float:left;">Box Style : </span>
                                            <ul class="tie-cats-options tie-options">
                                                <li>
                                                    <input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="default" <?php if( $cat['style'] == 'default' || $cat['style']=='' ) echo 'checked="checked"'; ?> />
                                                    <a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/news-in-pic1.png" /></a>
                                                </li>
                                                <li>
                                                    <input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="row" <?php if( $cat['style'] == 'row' ) echo 'checked="checked"' ?> />
                                                    <a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/news-in-pic2.png" /></a>
                                                </li>
                                            </ul>
                                        </label>
                                        <input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
                            
                            <?php elseif( $cat['type'] == 'videos' ) : ?>
                                    <div class="widget-head news-pic-box">Videos
                                        <a class="toggle-open">+</a>
                                        <a class="toggle-close">-</a>
                                    </div>
                                    <div class="widget-content">
                                        <label><span>Box Category : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
                                            <?php foreach ($categories as $key => $option) { ?>
                                            <option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
                                            <?php } ?>
                                        </select></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][title]"><span>Box Title :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php if( !empty($cat['title']) )  echo $cat['title']  ?>" type="text" /></label>
                                        <label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) )  echo $cat['offset']  ?>" type="text" /></label>
                                        <input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
                            
                                <?php elseif( $cat['type'] == 'divider' ) : ?>
                                    <div class="widget-head news-pic-box">  Divider
                                        <a class="toggle-open">+</a>
                                        <a class="toggle-close">-</a>
                                    </div>
                                    <div class="widget-content">
                                        <label for="tie_home_cats[<?php echo $i ?>][height]"><span>Height :</span><input id="tie_home_cats[<?php echo $i ?>][height]" name="tie_home_cats[<?php echo $i ?>][height]" value="<?php  echo $cat['height']  ?>" type="text" style="width:50px;" /> px</label>

                                <?php endif; ?>
                                
                                
                                        <input id="tie_home_cats[<?php echo $i ?>][type]" name="tie_home_cats[<?php echo $i ?>][type]" value="<?php  echo $cat['type']  ?>" type="hidden" />
                                        <a class="del-cat"></a>
                                    
                                    </div>
                                </li>
                        <?php } 
                        } else{?>
                        <?php } ?>
                </ul>

                <script>
                    var nextCell = <?php echo $i+1 ?> ;
                    var templatePath =' <?php echo get_template_directory_uri(); ?>';
                </script>
            </div>	
        </div>



        <div class="tiepanel-item">
            <h3>Categories Tabs Box</h3>            
            <?php
            tie_options(
                array(	"name" => "Show Category Tabs Box",
                        "id" => "home_tabs_box",
                        "type" => "checkbox")); 
                        
                if( tie_get_option('home_tabs') )
                    $tie_home_tabs = tie_get_option('home_tabs') ;
                else 
                    $tie_home_tabs = array();
                
                $tie_home_tabs_new = array();					
                
                foreach ($tie_home_tabs as $key1 => $option1) {
                    if ( array_key_exists( $option1 , $categories) )
                        $tie_home_tabs_new[$option1] = $categories[$option1];
                }
                foreach ($categories as $key2 => $option2) {
                    if ( !in_array( $key2 , $tie_home_tabs) )
                        $tie_home_tabs_new[$key2] = $option2;
                }
            ?>
                
            <div class="option-item">
                <span class="label">Choose Categories : </span>
                <div class="clear"></div> <p></p>
                <ul id="tabs_cats">
                    <?php foreach ($tie_home_tabs_new as $key => $option) { ?>
                    <li><input id="tie_home_tabs" name="tie_options[home_tabs][]" type="checkbox" <?php if ( in_array( $key , $tie_home_tabs) ) { echo ' checked="checked"' ; } ?> value="<?php echo $key ?>">
                    <span><?php echo $option; ?></span></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>