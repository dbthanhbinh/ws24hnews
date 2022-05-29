<div class="support-online" rel="nofollow">
    <div class="support-content-call">
        <a href='tel:<?= get_theme_mod('hotline_number')?>' class="call-now">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <div class="animated infinite zoomIn kenit-alo-circle"></div>
            <div class="animated infinite pulse kenit-alo-circle-fill"></div>
            <span>Call: <?= get_theme_mod('hotline_number')?></span>
        </a>
        <a class="zalo" href="http://zalo.me/<?= get_theme_mod('zalo_number')?>">
            <img alt="Zalo" src="<?= get_template_directory_uri() . '/modules/ws24hSupport/assets/images/zalo_icon.png' ?>">
            <span>Zalo: <?= get_theme_mod('zalo_number')?></span>
        </a>
        <a class="sms" href="sms:<?= get_theme_mod('sms_number')?>?body=<?= get_the_title()?>">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <span>SMS: <?= get_theme_mod('sms_number')?></span>
        </a>
    </div>
</div>