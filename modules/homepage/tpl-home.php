<?php
require ('home-cats.php');
/*-----------------------------------------------------------------------------------*/
# Get Home Cats Boxes
/*-----------------------------------------------------------------------------------*/
function tie_get_home_cats($cat_data) {
    //print_r($cat_data);
	switch( $cat_data['type'] ){
		case 'recent':
			get_home_recent( $cat_data );
			break;
		case 's':
			get_home_scroll( $cat_data );
			break;
			
		case 'news-pic':
			get_home_news_pic( $cat_data );
			break;
			
		case 'videos':
			get_home_news_videos( $cat_data );
			break;		
		case 'homebox':
			get_home_box_top($cat_data);
			break;
        case 'homecatbox':
			get_home_box_cat( $cat_data );
			break; 
        case 'ads12':
			get_home_ads12( $cat_data );
			break;   
                    
		case 'divider': ?>
			<div class="divider" style="height:<?php if( !empty($cat_data['height']) ) echo $cat_data['height'] ?>px"></div>
			<div class="clear"></div>
		<?php
			break;
			
		case 'ads': ?>
			            
                <div class="clear-10"></div>            
                <div class="fbox-ads">
                    <?php if($cat_data['ads_link']):?><a <?php if($cat_data['target']=='y') echo 'target="_blank"';?> href="<?php echo $cat_data['ads_link'];?>"><?php endif;?>
                        <?php if($cat_data['ads_path']):?>
                        <img alt="<?php bloginfo('name');?>" src="<?php echo $cat_data['ads_path'];?>"/>
                        <?php endif;?>
                    <?php if($cat_data['ads_link']):?></a><?php endif;?>
                </div>
                
                <div class="clear-10"></div>            
                <div class="clear"></div>
		<?php
			break;
	}
}