<?php
$homeTabBox = tie_get_option('home_tabs_box');
// To add first/last to list item
function reBuildListItem($listItems){
  $count = count($listItems);
  if($count > 0){
    $p=1;
    foreach($listItems as $k=>$v){
      if($p==1){
        $listItems[$k]['itemClass'] = 'first';
      } elseif($p==($count)){
        $listItems[$k]['itemClass'] = 'last';
      }else {
        $listItems[$k]['itemClass'] = '';
      }
      $p++;
    }
  }
  return $listItems;
}

function buildListItems($listItems){
  if($listItems && count($listItems) > 0){
    $list1 = reBuildListItem($listItems['left']);
    $list2 = reBuildListItem($listItems['right']);
    $newlistItems = [];
    foreach($list1 as $mK=>$mv){
      $newlistItems[] = $mv;
      if(isset($list2[$mK])) $newlistItems[] = $list2[$mK];
    }

      $pos = 1;
      foreach($newlistItems as $k=>$item){
        $offsetMd = '';
        $itemClass = $item['itemClass'];
        $lrCl = $item['lrclass'];
        $fadeIn = 'fadeInRight';
        if($lrCl == 'left'){
          $fadeIn = 'fadeInLeft';
          $offsetMd = 'offset-md-1';
        }

        $thumbLayout = '
            <div class="thumbnail_item_thumb '.$lrCl.' col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <img src="'.$item['thumbnail'].'" alt="'.$item['name'].'">
            </div>
        ';

        $contentLayout = '
            <div class="thumbnail_item_content '.$lrCl.' col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                <h5 class="head-title truncate-title" title="'.$item['name'].'"><a href="'.$item['permalink'].'">'.$item['name'].'</a></h5>
                <p class="truncate-excerpt-2">'.$item['excerpt'].'</p>
            </div>
        ';
        ?>
        <div class="card_item <?= getColsLayout(true, 157) ?>  <?= $lrCl ?> <?= $fadeIn?> <?= $itemClass ?> <?= $offsetMd ?> animated <?= $item['catslug'] ?>">
            <div class="row">
                <?php
                if($lrCl == 'left'){
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
    // $homeTabOrder = tie_get_option('home_tabs_order');
    $homeTabBoxTitle = tie_get_option('home_tabs_box_title');
    $homeTabBoxSubtitle = tie_get_option('home_tabs_box_subtitle');
    $homeTabDescription = tie_get_option('home_tabs_description');

    $tieHomeTabs = tie_get_option('home_tabs');
    $tieHomePostByCat = [];
?>
<div class="section home-section animated secondary-section section-best-packages">
  <div class="container">
    <div class="row">
      <div class="<?= getDefaultFullLayout() ?> header-section">
          <div class=" title">
              <?php if($homeTabBoxSubtitle){?><h5 class="header-cb-1"><?= $homeTabBoxSubtitle ?></h5><?php }?>
              <?php if($homeTabBoxTitle){?><h4 class="entry-title"><?= $homeTabBoxTitle ?></h4><?php }?>
              <?php if($homeTabDescription){?><p><?= $homeTabDescription ?></p><?php }?>
          </div>
        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
          <?php
          $pos = 1;
          $isFirst = false;
          $postsPerPage = 6;
          $maxCount = $postsPerPage/2; // 3left/3right
          $showOnLoad = '';
          foreach ($tieHomeTabs as $key => $option) {
              $catData = get_category($option);
              $categoryLink = get_category_link($option);
                  
              if($catData->count >= $postsPerPage){
                  if(!$isFirst){
                      $showOnLoad = $catData->slug;
                  }
                  $postQuery = new WP_Query(['category__in' => [$catData->cat_ID], 'posts_per_page' => $postsPerPage]);
                  if($postQuery->have_posts()){
                      $p = 0;
                      while ($postQuery->have_posts()):
                        $postQuery->the_post();
                          $lrKey = 'left';
                          if($p%2 != 0)
                              $lrKey = 'right';

                          $tieHomePostByCat[$catData->slug][$lrKey][] = [
                              'thumbnail' => get_the_post_thumbnail_url(get_the_ID()),
                              'lrclass' => $lrKey,
                              'catslug' => $catData->slug,
                              'name' => get_the_title(),
                              'permalink' => get_the_permalink(get_the_ID()),
                              'excerpt' => get_the_excerpt()
                          ];
                      $p++;
                    endwhile;
                    wp_reset_query();
                  }
                  $myposts = null;
              }

              if($catData->count >= $postsPerPage) {
                  $active = '';
                  if($pos == 1)
                    $active = 'active';
                  ?>
                  <a class="filter btn-lemon <?= $active ?>" id="nav-<?= $catData->slug ?>-tab" data-toggle="tab" href="#nav-<?= $catData->slug ?>" role="tab" aria-controls="nav-<?= $catData->slug ?>" aria-selected="false"><?= $catData->name ?></a>
                  <?php
              }
              $pos++;
          }
          ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tab-content content-section" id="nav-tabContent">
          <?php
          if($tieHomePostByCat && count($tieHomePostByCat)>0){
            $pos = 1;
            foreach($tieHomePostByCat as $k=>$subObj){
              $active = '';
              if($pos == 1)
                $active = 'show active';
              ?>
              <div class="tab-pane row fade <?=$active?>" id="nav-<?=$k?>" role="tabpanel" aria-labelledby="nav-<?=$k?>-tab">
                <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 mix_services_center">
                      <?php if($homeTabBigImage){?>
                          <div class="thumbnail_center offset-md-35 align-self-center col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5">
                              <img src="<?= $homeTabBigImage ?>" alt="<?= $homeTabBoxTitle ?>" title="<?= $homeTabBoxTitle ?>" />
                          </div>
                      <?php }?>

                      <div class="thumbnail_item_left_right col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 offset-md-1">
                        <div class="row">
                            <?php
                            buildListItems($subObj);
                            ?>
                        </div>
                      </div>

                  </div>
                </div>
              </div>
              <?php
              $pos++;
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }?>