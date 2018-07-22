<?php
/*
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Archives');    
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');    
    //unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');    
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');    
    unregister_widget('WP_Nav_Menu_Widget');
    */
    
    require_once 'widget-popular.php';
    // require_once 'widget-video.php';

add_filter('get_search_form', 'new_search_button');
function new_search_button($text) {
    $text = str_replace('value="Search"', 'value="Tìm"', $text);    
    return $text;
}

function ws24h_widget_color()
{
    $color_list = array('444','067e8c','cd337c','c32525','ab6706','ff0000','ff3372','5f9f0b','30a5ff','046b5b','0374dc','ff3271');
    return $color_list;
}


function ws24h_widget_color_style()
{
    $color_list = ws24h_widget_color();
    foreach($color_list as $color)
    {
    ?>
    <style type="text/css">
        .ms-block-mid-2 .ms-block-style-<?php echo $color;?>
        {
            background-color: #<?php echo $color;?>;
            color: #fff;
            margin-bottom: 5px;
        }
        
        .ms-block-mid-2 .ms-block-style-<?php echo $color;?> a {
            color: #fff;
        }
        
        .ms-block-mid-2 .ms-block-style-<?php echo $color;?> .ms-box-title
        {
            background: none;
            border: none;
            padding: 8px 0 3px 0;
            border-bottom: 1px dotted #e2e2e3;
            color: #fff;
        }
        .ms-block-mid-2 .ms-block-style-<?php echo $color;?> .ms-box-title h3
        {                
            border: none;
            margin: 0;
            padding: 0;
        }
        
        .ms-block-style-<?php echo $color;?> .ms-box-title 
        {
            border-bottom: 2px solid #<?php echo $color;?>;
            color: #<?php echo $color;?>;
        }
        
        
        .ms-block-style-<?php echo $color;?> .ms-box-title h3 
        {
            border-color: #<?php echo $color;?>;
        }
        
        .ms-block-color-full-<?php echo $color;?> .ms-box-title
        {
            background-color: #<?php echo $color;?>;
            color: #fff;
            border-top-color: #<?php echo $color;?>;
        }
        .ms-block-color-full-<?php echo $color;?> .ms-box-title span{
            display: block;
        }
    </style>    
    <?php
    }
}
// add_action('wp_footer','ws24h_widget_color_style');