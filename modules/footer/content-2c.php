<div class="row">
    <div class="<?= getColsLayout(true, 126) ?>">
        <?php if (is_active_sidebar( 'footer-1' )) dynamic_sidebar( 'footer-1' );?>
    </div>
    <div class="<?= getColsLayout(true, 126) ?>">
        <?php if (is_active_sidebar( 'footer-2' )) dynamic_sidebar( 'footer-2' );?>
    </div>
</div>