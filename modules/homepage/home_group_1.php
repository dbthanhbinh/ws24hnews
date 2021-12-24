<div class="section home-section animated section-best-features">
    <div class="container">
        <div class="row">
            <div class="<?= getColsLayout(true, 126) ?> animated fadeInLeft">
                <?php if($groupUploadBig){?><img src="<?= $groupUploadBig ?>" title="<?=$boxTitle?>" alt="<?= $boxTitle ?>"><?php }?>
            </div>
            <div class="<?= getColsLayout(true, 126) ?> animated fadeInRight">
                <div class="header-section">
                    <?php if($boxTitle){?>
                        <h3><?= $boxTitle ?> <?php if($subTitle){?><span class="header-cb-1"><?= $subTitle ?></span><?php }?></h3>
                    <?php }?>
                    <?php if($description){?> <p><?= html_entity_decode($description) ?></p> <?php }?>
                </div>
                <div class="row content-section">
                    <?php
                    for($s=1 ; $s<=6 ; $s++){
                        $defaultImageItem = get_template_directory_uri() . '/assets/images/forma'.$s.'.png';
                        $uploadedItem = tie_get_option($homeGroupTemplate.'_upload_item_'.$s);
                        $titleItem = tie_get_option($homeGroupTemplate.'_title_item_'.$s);
                        $urlItem = tie_get_option($homeGroupTemplate.'_url_item_'.$s);
                        $descriptionItem = tie_get_option($homeGroupTemplate.'_description_item_'.$s);
                        if($titleItem && $descriptionItem){
                        ?>
                        <div class="<?= getColsLayout(true, 2) ?> featured-item">
                            <div class="featured-thumb">
                                <div class="icon-wrap">
                                    <div class="type-image">
                                        <img src="<?= $uploadedItem ? $uploadedItem : $defaultImageItem ?>" alt="<?= $titleItem ?>" title="<?= $titleItem ?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="featured-content">
                                <h4 class="featured-box-title"><a href="<?=$urlItem ? $urlItem : '#'?>" title="<?= $titleItem ?>"><?= $titleItem ?></a></h4>
                                <?php if($descriptionItem){?><div class="featured-box-text" ><?= html_entity_decode($descriptionItem) ?></div><?php }?>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>