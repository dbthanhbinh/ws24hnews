<div class="tiepanel-item">
    <h3><?= __('Category tabs box', THEMENAME) ?></h3>            
    <?php
    require('defaultVal.php');
    tie_options(
        array(	"name" => __('Big image', THEMENAME),
                "id" => "home_tabs_big_image",
                "help" => "Upload a big image, or enter URL to an image if it is already uploaded. the theme default big image gets applied if the input field is left blank.",
                "type" => "upload",
                "std" => $tabTg,
                "extra_text" => 'size (MAX) : 500px x 500px'));
    tie_options(
        array(	"name" => __('Order', THEMENAME),
                "id" => "home_tabs_order",
                "help" => "e.g. 1,2, ...",
                "std" => 1,
                "type" => "short-text"));
    tie_options(
        array(	"name" => __('Display', THEMENAME),
                "id" => "home_tabs_box",
                "type" => "checkbox")); 
    tie_options(
        array(	"name" => __('Heading', THEMENAME),
                "id" => "home_tabs_box_title",
                "help" => "e.g. Category tab title",
                "std" => $tabTitle,
                "type" => "text"));
    tie_options(
        array(	"name" => __('Sub heading', THEMENAME),
                "id" => "home_tabs_box_subtitle",
                "help" => "e.g. Category tab subtitle",
                "std" => $tabSubTitle,
                "type" => "text"));
    tie_options(
        array(	"name" => __('Description', THEMENAME),
                "id" => "home_tabs_description",
                "help" => "e.g. Category tab description",
                "std" => $tabDes,
                "type" => "textarea"));
                
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
        <span class="label"><?= __('Choose Categories', THEMENAME) ?></span>
        <div class="clear"></div> <p></p>
        <ul id="tabs_cats">
            <?php foreach ($tie_home_tabs_new as $key => $option) { ?>
            <li><input id="tie_home_tabs" name="tie_options[home_tabs][]" type="checkbox" <?php if ( in_array( $key , $tie_home_tabs) ) { echo ' checked="checked"' ; } ?> value="<?php echo $key ?>">
            <span><?php echo $option; ?></span></li>
            <?php } ?>
        </ul>
    </div>
</div>