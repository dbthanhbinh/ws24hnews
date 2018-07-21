<?php if (get_second_sidebar()) : ?>
<div class="<?= is_single() ? 'col-lg-3' : 'col-lg-2' ?> second-sidebar">
    <div class="row">
        <?php dynamic_sidebar( 'sidebar-second' ); ?>
    </div>
</div>
<?php endif; ?>