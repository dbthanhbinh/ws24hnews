<?php if(get_theme_mod('show_top_header', LAYOUT_SHOW_TOP_HEADER)):
    $companyName = get_theme_mod('company_top_name', false);
    $contactHotline = get_theme_mod('contact_hotline', false);
    $openTime = get_theme_mod('setting_open_time', false);
    $topHotlineRight = get_theme_mod('company_top_hotline_right');
    ?>
    <div id="top-header" class="top-header top-side-header">
        <div class="container">
            <ul class="top-hotline-open">
                <?php if($companyName){ ?> <li><span><b><?= $companyName ?></b></span></li><?php }?>
                <?php
                if (!isset($topHotlineRight) || $topHotlineRight != 1) {
                    ?>
                    <?php if($contactHotline){ ?> <li><span><b><a href="tel:<?= $contactHotline ?>"><?= $contactHotline ?></a></b></span></li><?php }?>
                    <?php
                }
                ?>
                <?php if($openTime) {?><li><span><b><?= __('Open_time', THEMENAME) ?></b> <?= $openTime ?></span></li> <?php }?>
            </ul>
            <?php
            if (isset($topHotlineRight) && $topHotlineRight == 1) {
            ?>
            <ul class="top-hotline-right">
                <?php if($contactHotline){ ?> <li><span><b><a href="tel:<?= $contactHotline ?>">Hotline: <?= $contactHotline ?></a></b></span></li><?php }?>
            </ul>
            <?php } ?>
        </div>
    </div>
<?php endif; ?>