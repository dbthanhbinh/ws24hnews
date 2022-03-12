<?php
require_once ('commons.php')
?>
<h2><?= __('Home page', THEMENAME) ?></h2> <?php echo $save ?>				
    <div class="tiepanel-item">
        <h3><?= __('Home page settings', THEMENAME) ?></h3>
        <?php
            tie_options(
                array( 	"name" => __('Home page settings', THEMENAME),
                        "id" => "on_home",
                        "type" => "radio",
                        "std" => "latest",
                        "options" => array( "latest"=> __('Latest posts', THEMENAME) . " - Blog Layout" ,
                                            "boxes"=> "Use Home Builder" )));
        ?>
    </div>					
    <div id="Home_Builder" style="width:100%;">
        <div class="tiepanel-item"  style=" overflow: visible; ">
            <h3><?= __('Home Builder', THEMENAME) ?><a id="collapse-all">[-] Collapse All</a>
                <a id="expand-all">[+] Expand All</a></h3>
            <div class="option-item">
                <!-- Hidden variables -->
                <input type="hidden" id="panel_admin_resource_path" name="panel_admin_resource_path" value="<?= get_template_directory_uri() ?>/admin/panel"/>
                
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
                    <a id="add-recent" ><?= __('Recent posts', THEMENAME) ?></a>
                    <a id="add-group" ><?= __('Group template', THEMENAME) ?></a>
                    <a id="add-videos" ><?= __('Video list', THEMENAME) ?></a>
                    <a id="add-categories" ><?= __('Category tabs box', THEMENAME) ?></a>
                    <a id="add-custom" ><?= __('Custom box', THEMENAME) ?></a>
                    <?php
                    // Add appointment
                    if(function_exists('appointment_admin_menu')){
                        ?>
                        <a id="add-appointment" ><?= __('Appointment', THEMENAME) ?></a>
                        <?php
                    }
                    ?>
                </div>
                                    
                <ul id="cat_sortable">
                    <?php
                        $cats = get_option( 'tie_home_cats' ) ;
                        $i=0;
                        if($cats){
                            $defaultLayout = 'n';
                            $isShowLayoutDropdown = false;
                            foreach ($cats as $cat) { 
                                $i++;
                                if( $cat['type'] == 'recent' ) :
                                    $defaultLayout = 'n';
                                    $isShowLayoutDropdown = true;
                                    require('recent.php');
                                ?>
                                <?php elseif($cat['type'] == 'group-template') :
                                    $defaultLayout = 'n';
                                    require('grouptemplate.php');
                                ?>
                                <?php elseif($cat['type'] == 'categories') :
                                    $defaultLayout = 'n';
                                    require('categories.php');
                                ?>
                                <?php elseif( $cat['type'] == 'videos' ) :
                                    $defaultLayout = 'n';
                                    $isShowLayoutDropdown = false;
                                    require('videos.php');
                                ?>
                                <?php elseif(function_exists('appointment_admin_menu') && $cat['type'] == 'appointment' ) :
                                    $defaultLayout = 'n';
                                    $isShowLayoutDropdown = true;
                                    require('appointment.php');
                                ?>
                                <?php elseif( $cat['type'] == 'custom' ) :
                                    $defaultLayout = 'y';
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