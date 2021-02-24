<?php if(get_theme_mod('show_top_header', LAYOUT_SHOW_TOP_HEADER)):
    $companyName = get_theme_mod('company_name', false);
    $contactHotline = get_theme_mod('contact_hotline', false);
    $openTime = get_theme_mod('setting_open_time', false);
    ?>
    <div id="top-header" class="top-header top-side-header">
        <div class="container">
            <ul>
                <?php if($companyName){ ?> <li><span><b><?= $companyName ?></b></span></li><?php }?>
                <?php if($contactHotline){ ?> <li><span><b><a href="tel:<?= $contactHotline ?>"><?= $contactHotline ?></a></b></span></li><?php }?>
                <?php if($openTime) {?><li><span><b><?= getTranslateByKey('open_time') ?></b> <?= $openTime ?></span></li> <?php }?>
            </ul>
        </div>
    </div>
<?php endif; ?>