<?php
if (isSecondSidebar()) : ?>
    <div class="<?= isSecondSidebar() ?> second-sidebar">
        <div id="second-sidebar" class="row">
            <?php dynamic_sidebar( 'sidebar-second' ); ?>
        </div>
    </div>
<?php endif; ?>