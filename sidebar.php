<?php
if (isMainSidebar()) : ?>
<?php 
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        return;
    }
    require_once ('modules/ads/services.php');
    require_once ('modules/ads/widget_ads.php');
?>
<div class="<?= isMainSidebar() ?>">
    <div class="" id="sidebar">
        <?php
        if(is_single()){
            $customMeta = get_post_custom(get_the_ID());
            if(isset($customMeta)){
                $price = isset($customMeta[PRICE][0]) ? $customMeta[PRICE][0] : null;
                $acreage = isset($customMeta['acreage'][0]) ? $customMeta['acreage'][0] : null;
                $district = isset($customMeta['district'][0]) ? $customMeta['district'][0] : null;
                if($district)
                    $district  = getDistrictName($district);

                $builds = isset($customMeta[NUMBER_OF_BUILD][0]) ? $customMeta[NUMBER_OF_BUILD][0] : null;
                $beds = isset($customMeta[NUMBER_OF_BED][0]) ? $customMeta[NUMBER_OF_BED][0] : null;
                $baths = isset($customMeta[NUMBER_OF_BATH][0]) ? $customMeta[NUMBER_OF_BATH][0] : null;
            }
            if($price || $acreage || $district || $builds || $beds || $baths){
            ?>
            <div class="single-properties-group">
                <div class="summarys-group" title="Thông tin cơ bản">
                    <i class="fa fa-building" aria-hidden="true"></i><span>THÔNG TIN CƠ BẢN:</span>
                </div>
                <div class="group-price-list">
                    <ul class='price-list'>
                        <?php if($price) ?><li class="item-price"><span class="old-price"><?= $price ?></span></li>
                        <?php if($acreage) ?><li class="item-price"><span class="new-price"><?= $acreage ?> M<span class="sub-item">2</span></li>
                    </ul>
                    <ul class="district-list">
                        <?php if($district) ?><li class="item-price"><span class="district-item"><?= $district ?></span></li>
                    </ul>
                </div>
                <div class="row properties-group">
                    <ul class="properties-list col-md-12">
                        <?php if($beds) {?><li class="col-md-6 col-sm-6 col-6" title="<?= $beds ?> Phòng"><i class="fa fa-bed" aria-hidden="true"></i><span>Phòng ngủ: <?= $beds ?></span></li> <?php }?>
                        <?php if($baths) {?><li class="col-md-6 col-sm-6 col-6" title="<?= $baths ?> Phòng"><i class="fa fa-bath" aria-hidden="true"></i><span>Phòng tắm: <?= $baths ?></span></li><?php }?>
                        <?php if($builds) {?><li class="col-md-6 col-sm-6 col-6" title="<?= $builds ?>"><i class="fa fa-building" aria-hidden="true"></i><span>Tầng: <?= $builds ?></span></li><?php }?>
                    </ul>
                    <div class="col-md-12">
                    <?php if(get_theme_mod('contact_hotline')) {?><div class="col-md-12 call-hotline-bar" title="<?= $builds ?>"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:<?= get_theme_mod('contact_hotline')?>"><?= get_theme_mod('contact_hotline')?></a></div><?php }?>
                    </div>
                </div>
            </div>
            <?php
            }
        }
        else {
            ?>
            <div class="single-properties-group">
                <div class="summarys-group" title="Thông tin cơ bản">
                    <i class="fa fa-building" aria-hidden="true"></i><span>THÔNG TIN CƠ BẢN:</span>
                </div>
                <div class="row properties-group">
                    <div class="col-md-12">
                    <?php if(get_theme_mod('contact_hotline')) {?><div class="col-md-12 call-hotline-bar" title="<?= $builds ?>"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:<?= get_theme_mod('contact_hotline')?>"><?= get_theme_mod('contact_hotline')?></a></div><?php }?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
</div>
<?php endif; ?>