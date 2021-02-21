<?php
if (isMainSidebar()) : ?>
<?php 
    if (!is_active_sidebar('sidebar-1')){
        return;
    }

    require_once ('modules/ads/services.php');
    require_once ('modules/ads/widget_ads.php');
?>
<div id="sidebar" class="<?= isMainSidebar() ?> sidebar-mobile">
    <?php dynamic_sidebar('sidebar-1'); ?>

    <a id="sidebar-mobile-close" class="sidebar-mobile-close" href="#">X</a>      
    <a id="sidebar-mobile-open" class="sidebar-mobile-open" href="#"><i class="fa fa-sliders" aria-hidden="true"></i></a>
</div>
<?php endif; ?>