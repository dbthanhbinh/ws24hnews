<?php
add_action( 'wp_footer', 'ws24h_support_online' );
function ws24h_support_online(){
?>
<div class="support-online" rel="nofollow">
    <div class="support-content-call">
        <a href='tel:<?= get_theme_mod(PLUGIN_PREF . 'hotline_number')?>' class="call-now">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <div class="animated infinite zoomIn kenit-alo-circle"></div>
            <div class="animated infinite pulse kenit-alo-circle-fill"></div>
            <span>Call: <?= get_theme_mod(PLUGIN_PREF . 'hotline_number')?></span>
        </a>
        <a class="zalo" href="http://zalo.me/<?= get_theme_mod(PLUGIN_PREF . 'zalo_number')?>">
            <img alt="Zalo" src="<?= plugins_url( '../assets/images/zalo_icon.png', __FILE__ ) ?>">
            <span>Zalo: <?= get_theme_mod(PLUGIN_PREF . 'zalo_number')?></span>
        </a>
        <a class="sms" href="sms:<?= get_theme_mod(PLUGIN_PREF . 'sms_number')?>?body=<?= get_the_title()?>">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <span>SMS: <?= get_theme_mod(PLUGIN_PREF . 'sms_number')?></span>
        </a>
    </div>
</div>
<?php
}