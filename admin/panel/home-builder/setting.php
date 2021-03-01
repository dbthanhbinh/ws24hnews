<h2>Homepage</h2> <?php echo $save ?>				
    <div class="tiepanel-item">
        <h3>Home page displays</h3>
        <?php
            tie_options(
                array( 	"name" => "Home page displays",
                        "id" => "on_home",
                        "type" => "radio",
                        "std" => "latest",
                        "options" => array( "latest"=>"Latest posts - Blog Layout" ,
                                            "boxes"=>" News Boxes - use Home Builder" )));
        ?>
    </div>					
    <div id="Home_Builder" style="width:100%;">
        <div class="tiepanel-item"  style=" overflow: visible; ">
            <h3>Home Builder <a id="collapse-all">[-] Collapse All</a>
                <a id="expand-all">[+] Expand All</a></h3>
            <div class="option-item">

                <select style="display:none" id="cats_defult">
                    <?php foreach ($categories as $key => $option) { ?>
                    <option value="<?php echo $key ?>"><?php echo $option; ?></option>
                    <?php } ?>
                </select>

                <select style="display:none" id="posttype_defult">
                    <?php foreach ($posttypes as $key => $option) { ?>
                    <option value="<?php echo $key ?>"><?php echo $option; ?></option>
                    <?php } ?>
                </select>
            
                
                <div style="clear:both"></div>
                <div class="home-builder-buttons">
                    <a id="add-recent" >Recent Posts</a>
                    <a id="add-group" >Group template</a>
                    <a id="add-videos" >Video list</a>
                    <a id="add-categories" >Categories Tabs Box</a>
                    <a id="add-custom" >Custom box</a>

                    <!-- <a id="add-cat" >News Box</a>
                    <a id="add-slider" >Scrolling Box</a>
                    <a id="add-ads" >Ads / Custom Content</a>
                    <a id="add-news-picture" >News in picture</a>
                    <a id="add-divider" >Divider</a> -->
                </div>
                                    
                <ul id="cat_sortable">
                    <?php
                        $cats = get_option( 'tie_home_cats' ) ;
                        $i=0;
                        if($cats){
                            // print_r($cats);
                            foreach ($cats as $cat) { 
                                $i++;
                                if( $cat['type'] == 'recent' ) :
                                    require('recent.php');
                                ?>
                                <?php elseif($cat['type'] == 'group-template') :
                                    require('grouptemplate.php');
                                ?>
                                <?php elseif($cat['type'] == 'categories') :
                                    require('categories.php');
                                ?>
                                <?php elseif( $cat['type'] == 'videos' ) :
                                    require('videos.php');
                                ?>
                                <?php elseif( $cat['type'] == 'custom' ) :
                                    require('custom.php');
                                ?>
                                <?php elseif( $cat['type'] == 'divider' ) : ?>
                                    <div class="widget-head news-pic-box">  Divider
                                        <a class="toggle-open">+</a>
                                        <a class="toggle-close">-</a>
                                    </div>
                                    <div class="widget-content">
                                        <label for="tie_home_cats[<?php echo $i ?>][height]"><span>Height :</span><input id="tie_home_cats[<?php echo $i ?>][height]" name="tie_home_cats[<?php echo $i ?>][height]" value="<?php  echo $cat['height']  ?>" type="text" style="width:50px;" /> px</label>

                                <?php endif; ?>
                        <?php } 
                        }
                    ?>
                </ul>

                <script>
                    var nextCell = <?php echo $i+1 ?> ;
                    var templatePath =' <?php echo get_template_directory_uri(); ?>';
                </script>
            </div>	
        </div>
        <?php require('category-tab.php');?>
        
    </div>