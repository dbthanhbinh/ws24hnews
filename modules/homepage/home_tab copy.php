<?php
$homeTabBox = tie_get_option('home_tabs_box');

function buildListItems($listItems, $fadeIn, $lrLayout){
    if($listItems && count($listItems) > 0){
        $pos = 1;
        foreach($listItems as $k=>$item){

            $thumbLayout = '
                <div class="thumbnail_item_thumb col-md-4">
                    <img src="http://localhost/saigonbautyonline/wp-content/themes/ws24hnews/assets/images/portfolios/Portfolio02.png" alt="project 2">
                </div>
            ';

            $contentLayout = '
                <div class="thumbnail_item_content  col-md-8">
                    <h5>'.$item['name'].'</h5>
                    <p>'.$item['excerpt'].'</p>
                </div>
            ';
            ?>
            <div class="thumbnail_item mix <?= $item['catslug'] ?> item_tmg <?= $item['itemclass'] ?>  animated <?= $fadeIn ?>">
                <div class="row">
                    <?php
                    if($lrLayout == 'leftLayout'){
                        echo $contentLayout;
                        echo $thumbLayout;
                    } else {
                        echo $thumbLayout;
                        echo $contentLayout;
                    }
                    ?>
                </div>
            </div>
            <?php
            $pos++;   
        }
    }
}

if($homeTabBox){
    $homeTabBox = tie_get_option('home_tabs_box');
    $homeTabBigImage = tie_get_option('home_tabs_big_image');
    $homeTabOrder = tie_get_option('home_tabs_order');
    $homeTabBoxTitle = tie_get_option('home_tabs_box_title');
    $homeTabBoxSubtitle = tie_get_option('home_tabs_box_subtitle');
    $homeTabDescription = tie_get_option('home_tabs_description');

    $tieHomeTabs = tie_get_option('home_tabs');
    $tieHomePostByCat = [];
?>
    <div class="section home-section animated secondary-section section-best-packages" id="portfolio">
        <div class="container">
            <div class="header-section">
                <div class=" title">
                    <?php if($homeTabBoxSubtitle){?><h5 class="header-cb-1"><?= $homeTabBoxSubtitle ?></h5><?php }?>
                    <?php if($homeTabBoxTitle){?><h1><?= $homeTabBoxTitle ?></h1><?php }?>
                    <?php if($homeTabDescription){?><p><?= $homeTabDescription ?></p><?php }?>
                </div>
                <?php if($tieHomeTabs && count($tieHomeTabs)>0){?>
                <ul class="nav-pills">
                    <?php
                    $pos = 1;
                    $isFirst = false;
                    $postsPerPage = 2;
                    $maxCount = $postsPerPage/2;

                    $showOnLoad = '';
                    foreach ($tieHomeTabs as $key => $option) {
                        $catData = get_category($option);
                        $categoryLink = get_category_link($option);
                            
                        if($catData->count >= $postsPerPage){
                            if(!$isFirst){
                                $showOnLoad = $catData->slug;
                            }

                            $myposts = get_posts( array(
                                'posts_per_page' => $postsPerPage,
                                'category'       => $catData->cat_ID
                            ) );

                            if($myposts){
                                $p = 1;
                                foreach ( $myposts as $post ) :
                                    setup_postdata( $post );
                                    $lrKey = 'left';
                                    if($p>$maxCount)
                                        $lrKey = 'right';
                                    $itemCl = '';
                                    if($p%$maxCount == 1)
                                        $itemCl = 'first';
                                    elseif($p%$maxCount == 0)
                                        $itemCl = 'last';

                                    $tieHomePostByCat[$lrKey][] = [
                                        'catslug' => $catData->slug,
                                        'name' => get_the_title(),
                                        'itemclass' => $itemCl,
                                        'excerpt' => get_the_excerpt()
                                    ];
                                $p++;
                                endforeach; 
                                wp_reset_postdata();
                            }
                            $myposts = null;
                        }
                        if($catData->count >= $postsPerPage) {
                            ?>
                            <li class="filter btn-lemon" data-filter="<?= $catData->slug ?>">
                                <a href="#noAction"><?= $catData->name ?></a>
                            </li>
                            <?php
                        }
                        $pos++;
                    }
                    ?>
                </ul>
                <?php }?>
            </div>
            
            <?php if($tieHomeTabs && count($tieHomeTabs)>0){
                ?>
            <ul id="portfolio-grid" class="thumbnails row portfolio-grid">
                <li class="col-md-3">
                </li>
                <li class="col-md-6 mix_services_center">
                    <?php if($homeTabBigImage){?>
                        <div class="thumbnail_center">
                            <img src="<?= $homeTabBigImage ?>" alt="<?= $homeTabBoxTitle ?>" title="<?= $homeTabBoxTitle ?>" />
                        </div>
                    <?php }?>

                    <div class="thumbnail_item_left">
                        <?php
                        buildListItems($tieHomePostByCat['left'], 'fadeInLeft', 'leftLayout');
                        ?>
                    </div>

                    <div class="thumbnail_item_right">
                        <?php
                        buildListItems($tieHomePostByCat['right'], 'fadeInRight', 'rightLayout');
                        ?>
                    </div>

                </li>
                <li class="col-md-3">
                </li>
            </ul>
            <?php }?>
        </div>
    </div>
<?php }?>

<script>
$(document).ready(function() {
    //Initial mixitup, used for animated filtering portgolio.
    var showOnLoad = '<?php echo $showOnLoad; ?>';
    $('#portfolio-grid').mixitup({
        'showOnLoad': showOnLoad
        // 'onMixStart': function (config) {
        //     $('div.toggleDiv').hide();
        // }
    });
});
</script>