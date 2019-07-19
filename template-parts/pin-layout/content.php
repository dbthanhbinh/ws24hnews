<?php
    $customMeta = get_post_custom(get_the_ID());
    if(isset($customMeta)){
        $price = isset($customMeta['price'][0]) ? $customMeta['price'][0] : null;
        $acreage = isset($customMeta['acreage'][0]) ? $customMeta['acreage'][0] : null;
        $district = isset($customMeta['district'][0]) ? $customMeta['district'][0] : null;
        if($district)
            $district  = getDistrictName($district);

        $builds = isset($customMeta['number-of-build'][0]) ? $customMeta['number-of-build'][0] : null;
        $beds = isset($customMeta['number-of-bed'][0]) ? $customMeta['number-of-bed'][0] : null;
        $baths = isset($customMeta['number-of-bath'][0]) ? $customMeta['number-of-bath'][0] : null;
    }

    $tagHeader = 'h5';
    if(isset($p) && $p){
        if($p == 1) $tagHeader = 'h2';
        else if($p <= 5) $tagHeader = 'h3';
        else if($p <= 10) $tagHeader = 'h4';
    }
?>
<article class="pin" id="post-<?= the_ID() ?>">
    <div class="article-pin">
        <?php if(has_post_thumbnail()):?>
            <div class="entry-thumb items-thumb">
                <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                    <?php the_post_thumbnail("medium", ['alt' => get_the_title()]);?>
                </a>
            </div>
        <?php endif;?>
        <div class="entry-content items-body">
            <div class="items-properties-list">
                <?php
                if($price || $acreage){
                    ?>
                    <div class="group-price-list">
                        <ul class='price-list'>
                            <?php if($price) ?><li class="item-price"><span class="old-price"><?= $price ?></span></li>
                            <?php if($acreage) ?><li class="item-price"><span class="new-price"><?= $acreage ?> M<span class="sub-item">2</span></li>
                        </ul>
                        <ul class="district-list">
                            <?php if($district) ?><li class="item-price"><span class="district-item"><?= $district ?></span></li>
                        </ul>
                    </div>
                    <?php
                }
                ?>
            </div>
            <header class="entry-header">
                <<?= $tagHeader ?> class="entry-title items-title"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></<?= $tagHeader ?>>
            </header>
            <div class="entry-excerpt items-excerpt">
                <p class="last-time">Ngày đăng: <?= get_the_date(); ?></p>
                <?php the_excerpt();?>
            </div>
            <div class="entry-readmore items-readmore">
                <div class="row">
                    <ul class='properties-list col-md-12'>
                        <?php if($beds) {?><li class="col-md-4 col-sm-4 col-4" title="<?= $beds ?> Phòng"><i class="fa fa-bed" aria-hidden="true"></i><span><?= $beds ?></span></li> <?php }?>
                        <?php if($baths) {?><li class="col-md-4 col-sm-4 col-4" title="<?= $baths ?> Phòng"><i class="fa fa-bath" aria-hidden="true"></i><span><?= $baths ?></span></li><?php }?>
                        <?php if($builds) {?><li class="col-md-4 col-sm-4 col-4" title="<?= $builds ?>"><i class="fa fa-building" aria-hidden="true"></i><span></span></li><?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</article>