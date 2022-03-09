<?php
$showBox = (isset($cat_data['show_box']) && $cat_data['show_box']) ? $cat_data['show_box'] : 'y';
if($showBox == 'y') {
    $boxTitle = (isset($cat_data['title']) && $cat_data['title']) ? $cat_data['title'] : null;
    $subTitle = (isset($cat_data['subtitle']) && $cat_data['subtitle']) ? $cat_data['subtitle'] : '';
    $showTitle = (isset($cat_data['show_title']) && $cat_data['show_title']) ? $cat_data['show_title'] : 'y';
    $description = (isset($cat_data['description']) && $cat_data['description']) ? $cat_data['description'] : '';
    $showDescription = (isset($cat_data['show_description']) && $cat_data['show_description']) ? $cat_data['show_description'] : 'y';

    $boxContent = (isset($cat_data['box_content']) && $cat_data['box_content']) ? $cat_data['box_content'] : '';
    $showNavigateBtn = (isset($cat_data['show_navigate_btn']) && $cat_data['show_navigate_btn']) ? $cat_data['show_navigate_btn'] : '';
    $boxNavigateText = (isset($cat_data['box_navigate_text']) && $cat_data['box_navigate_text']) ? $cat_data['box_navigate_text'] : '';
    $boxNavigateUrl = (isset($cat_data['box_navigate_url']) && $cat_data['box_navigate_url']) ? $cat_data['box_navigate_url'] : '';

    $boxBackgroundUrl = (isset($cat_data['box_background_url']) && $cat_data['box_background_url']) ? $cat_data['box_background_url'] : '';
    $useBackgroundUrl = tie_get_option('use_background_url');
    $boxID = (isset($cat_data['boxid']) && $cat_data['boxid']) ? $cat_data['boxid'] : '';

    $customStyle = '';
    if($useBackgroundUrl && $boxBackgroundUrl && $boxID){
        $customStyle = '
            style="
                background-image: url('.$boxBackgroundUrl.');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            "
        ';
    }
    ?>
    <div class="vc_custom_1583484295953 home-custom-box" <?= html_entity_decode($customStyle) ?>>
        <div class="container">
            <div class="row">
            <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 offset-md-1">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 left-custom-box animate-fadeInLeft">
                        <?php if($showTitle == 'y'){?>
                        <div class="header-section">
                            <h3> <?= $boxTitle ?>
                                <span class="header-cb-1"><?= $subTitle ?></span>
                            </h3>
                        </div>
                        <?php }?>
                    </div>
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 right-custom-box animate-fadeInRight">
                        <?php if($showDescription == 'y'){?>
                            <div class="custom-box-des"> <?= $description ?> </div>
                        <?php } ?>
                        <div class="row custom-box-des-spirit">
                            <?= html_entity_decode($boxContent) ?>
                        </div>
                        <?php if($showNavigateBtn == 'y') { ?>
                            <div class="custom-box-navigator bt-lemon-container">
                                <a href="<?= $boxNavigateUrl ?>" title="<?= $boxNavigateText ?>">
                                    <svg> <rect rx="20px" ry="20px"></rect> </svg>
                                    <?= $boxNavigateText ?>
                                </a>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php
}
?>