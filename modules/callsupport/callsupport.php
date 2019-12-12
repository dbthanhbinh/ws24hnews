<?php
// add_action( 'wp_footer', 'ws24h_call_support_online' );
function ws24h_call_support_online(){
?>
    <!--Call Support-->
    <div class="support-online">
        <div class="support-content-call">
            <a href='tel:<?= get_theme_mod('contact_hotline')?>' class="call-now" rel="nofollow">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <div class="animated infinite zoomIn kenit-alo-circle"></div>
                <div class="animated infinite pulse kenit-alo-circle-fill"></div>
                <span>Hotline: <?= get_theme_mod('contact_hotline')?></span>
            </a>
        <a class="mes" href="https://m.me/__">
            <img alt="Facebook" src="<?= get_template_directory_uri() ?>/assets/images/messenger.png">
            <span>Facebook</span>
        </a>
        <a class="zalo" href="http://zalo.me/<?= get_theme_mod('contact_hotline')?>">
            <img alt="Zalo" src="<?= get_template_directory_uri()?>/assets/images/zalo.png">
            <span>Zalo: <?= get_theme_mod('contact_hotline')?></span>
        </a>
        <a class="sms" href="sms:<?= get_theme_mod('contact_hotline')?>?body=<?= get_the_title()?>">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <span>SMS: <?= get_theme_mod('contact_hotline')?></span>
        </a>
        </div>
    </div>
    <!--End Call Support-->
<?php
}
?>