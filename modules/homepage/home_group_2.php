<div class="section home-section animated section-group-top">
    <div class="container">
        <div class="first-section">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-8 offset-md-2 group-1">
                    <div class="row">
                        <?php
                        $groupSlogan = tie_get_option($homeGroupTemplate.'_groupslogan');
                        $groupTextViewAll = tie_get_option($homeGroupTemplate.'_groupviewall');
                        $groupUrlViewAll = tie_get_option($homeGroupTemplate.'_urlall');

                        for($s=1 ; $s<=3 ; $s++){
                            $defaultImageItem = get_template_directory_uri() . '/assets/images/forma'.$s.'.png';
                            $uploadedItem = tie_get_option($homeGroupTemplate.'_upload_item_'.$s);
                            $titleItem = tie_get_option($homeGroupTemplate.'_title_item_'.$s);
                            $urlItem = tie_get_option($homeGroupTemplate.'_url_item_'.$s);
                            $descriptionItem = tie_get_option($homeGroupTemplate.'_description_item_'.$s);
                            ?>
                            <div class="<?= getColsLayout(true, 3) ?>">
                                <?php if($uploadedItem){?>
                                <div class="item_thumb">
                                    <img class="rounded-corner" src="<?= $uploadedItem ?>" alt="<?= $titleItem ?>" title="<?= $titleItem ?>"/>
                                </div>
                                <?php }?>

                                <div class="item_content">
                                    <?php if($titleItem){?><h3 class="entry-title"><?= $titleItem ?></h3><?php }?>
                                    <?php if($descriptionItem){?><p><?=$descriptionItem?></p><?php }?>
                                    <a class="read-more" href="<?= $urlItem ? $urlItem : '#'?>" title="<?= $titleItem ?>">
                                        <i class="fa fa-long-arrow-right"></i> Xem thêm
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div> <!-- col-md-8 offset-md-2 -->

                <div class="col-12 col-sm-12 col-md-10 offset-md-1 group-2">
                    <div class="row">
                        <div class="<?= getColsLayout(true, 84) ?> group-left">
                            <h4 > <strong><?= $boxTitle ?></strong> <?php if($subTitle){?><i class="raleway-font"><?= $subTitle ?></i><?php }?></h4>
                            <?php if($groupSlogan){?> <h5 class="header-cb-1"><?= $groupSlogan ?></h5><?php }?>
                        </div>

                        <?php if($groupTextViewAll){?>
                        <div class="<?= getColsLayout(true, 48) ?> group-right">
                            <div class="bt-lemon-container">
                                <a href="<?= $groupUrlViewAll ? $groupUrlViewAll : '' ?>" title="<?= $groupTextViewAll ?>">
                                    <svg> <rect rx="20px" ry="20px"></rect> </svg>
                                    <?= $groupTextViewAll?>
                                </a>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>