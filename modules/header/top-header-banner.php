<?php if(get_theme_mod('show_header_banner', LAYOUT_SHOW_TOP_HEADER_BANNER)): ?>
<div class="container top-side-header top-header-banner">
    <div class="row">
        <div class="col-md-3 col-lg-3 render-logo">
            <?= render_logo() ?>
        </div>
        <div class="top-banner-img col-md-9 col-lg-9 col-sm-9">
            <div class="top-banner-right">
            <a href="#"> <?php echo render_mode_attachment_image('top_banner'); ?> </a>
            </div>
        </div>
    </div>
</div>
<?php endif;?>