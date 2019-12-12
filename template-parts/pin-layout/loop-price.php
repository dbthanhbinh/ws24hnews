<?php
$customMeta = get_post_custom(get_the_ID());
if(isset($customMeta)){
    $price = isset($customMeta['price'][0]) ? $customMeta['price'][0] : null;
    $acreage = isset($customMeta['acreage'][0]) ? $customMeta['acreage'][0] : null;
    $district = isset($customMeta['district'][0]) ? $customMeta['district'][0] : null;
    if($district)
        $district  = getDistrictName($district);
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
}
?>