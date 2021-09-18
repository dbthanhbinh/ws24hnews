<?php
if (isMainSidebar()) : ?>
    <?php 
        if (!is_active_sidebar('sidebar-1')) {
            return false;
        }
        require_once ('modules/ads/widget_ads.php');
    ?>
    <div id="sidebar" class="<?= isMainSidebar() ?> sidebar-mobile">
        <?php dynamic_sidebar('sidebar-1'); ?>

        <span id="sidebar-mobile-close" class="sidebar-mobile-close">X</span>
        <span id="sidebar-mobile-open" class="sidebar-mobile-open">
            <i class="fa fa-sliders" aria-hidden="true"></i>
        </span>
    </div>
<?php endif; ?>