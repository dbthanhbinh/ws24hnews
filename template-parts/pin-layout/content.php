<?php
    $customMeta = get_post_custom(get_the_ID());
    if(isset($customMeta)){
        $price = isset($customMeta[PRICE][0]) ? $customMeta[PRICE][0] : null;
        $acreage = isset($customMeta[ACREAGE][0]) ? $customMeta[ACREAGE][0] : null;
        $district = isset($customMeta[DISTRICT][0]) ? $customMeta[DISTRICT][0] : null;
        if($district)
            $district  = getDistrictName($district);

        $builds = isset($customMeta[NUMBER_OF_BUILD][0]) ? $customMeta[NUMBER_OF_BUILD][0] : null;
        $beds = isset($customMeta[NUMBER_OF_BED][0]) ? $customMeta[NUMBER_OF_BED][0] : null;
        $baths = isset($customMeta[NUMBER_OF_BATH][0]) ? $customMeta[NUMBER_OF_BATH][0] : null;
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
        </div>
    </div>
</article>