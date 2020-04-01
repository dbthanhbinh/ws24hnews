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