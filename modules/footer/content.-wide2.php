<div class="row">
    <div class="<?= getColsLayout(true, 1633) ?>">
        <?php if (is_active_sidebar( 'footer-1' )) dynamic_sidebar( 'footer-1' );?>
    </div>
    <div class="<?= getColsLayout(true, 1336) ?>">
        <?php if (is_active_sidebar( 'footer-2' )) dynamic_sidebar( 'footer-2' );?>
    </div>
    <div class="<?= getColsLayout(true, 1336) ?>">
        <?php if (is_active_sidebar( 'footer-3' )) dynamic_sidebar( 'footer-3' );?>
    </div>
</div>