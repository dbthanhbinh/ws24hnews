<?php if (get_main_sidebar()) : ?>
<?php 
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        return;
    }
    require_once ('modules/ads/services.php');
    require_once ('modules/ads/widget_ads.php');
?>
<div class="<?= get_main_sidebar() ?>">
    <div class="" id="sidebar">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
</div>
<?php endif; ?>