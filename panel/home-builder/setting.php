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
                    <?php foreach ($categories as $key => $option) {
                        if($key && $option){
                        ?>
                    <option value="<?php echo $key ?>"><?php echo $option; ?></option>
                    <?php }} ?>
                </select>
            
                
                <div style="clear:both"></div>
                <div class="home-builder-buttons">
                    <!-- <a id="add-cat" >News Box</a>
                    <a id="add-slider" >Scrolling Box</a>
                    <a id="add-ads" >Ads / Custom Content</a>
                    <a id="add-news-picture" >News in picture</a>
                    <a id="add-news-videos" ><?= __('Videos') ?></a> -->
                    <a id="add-recent" ><?= __('Recent Posts')?></a>
                    <!-- <a id="add-divider" >Divider</a> -->
                </div>
                                    
                <ul id="cat_sortable">
                    <?php 
                    $cats = get_option( 'tie_home_cats' ) ;
                    $i=0;
                    if($cats){
                        foreach ($cats as $cat) {
                            $i++; 
                            $layout = (isset($cat['style']) && $cat['style']) ? $cat['style'] : 11;
                            
                            ?>
                                <li id="listItem_<?php echo $i ?>" class="ui-state-default">
                                <?php                 
                                    $boxid = empty($cat['boxid']) ? $cat['type'].'_'.rand(200, 3500) : $cat['boxid'];               
                                    switch ($cat['type']) {
                                        case 'recent':                                        
                                            $boxTitle = (isset($cat['title']) && $cat['title']) ? $cat['title'] : __('Recent post');
                                            require ('header.php');
                                            require ('recent-post.php');
                                        break;
                                        default:

                                        break;
                                    }
                                    require ('footer.php');                                
                                ?>
                                </li>
                            <?php
                        }
                    }
                    ?>
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