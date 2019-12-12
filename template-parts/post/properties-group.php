<?php
if(is_single()){
    $customMeta = get_post_custom(get_the_ID());
    if(isset($customMeta)){
        $price = isset($customMeta['price'][0]) ? $customMeta['price'][0] : null;
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
                <?php if($beds) {?><li class="col-md-3 col-sm-3 col-3" title="<?= $beds ?> Phòng"><i class="fa fa-bed" aria-hidden="true"></i><span>Phòng ngủ: <?= $beds ?></span></li> <?php }?>
                <?php if($baths) {?><li class="col-md-3 col-sm-3 col-3" title="<?= $baths ?> Phòng"><i class="fa fa-bath" aria-hidden="true"></i><span>Phòng tắm: <?= $baths ?></span></li><?php }?>
                <?php if($builds) {?><li class="col-md-3 col-sm-3 col-3" title="<?= $builds ?>"><i class="fa fa-building" aria-hidden="true"></i><span>Tầng: <?= $builds ?></span></li><?php }?>
            </ul>
        </div>
    </div>
    <?php
    }
}