<?php if (isMainSidebar()) : ?>
    <?php 
        $sidebarName = 'sidebar-1';
        if (!is_active_sidebar($sidebarName)) {
            return false;
        }
    ?>
    <div id="sidebar" class="<?= isMainSidebar() ?> sidebar-mobile">
        <?php dynamic_sidebar($sidebarName); ?>

        <span id="sidebar-mobile-close" class="sidebar-mobile-close">X</span>
        <span id="sidebar-mobile-open" class="sidebar-mobile-open">
            <i class="fa fa-sliders" aria-hidden="true"></i>
        </span>
    </div>
<?php endif; ?>