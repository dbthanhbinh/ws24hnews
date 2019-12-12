<div class="box-footer">
    <div class="row">
        <!-- <div class="col-lg-6">
            <div class="footer-logo">
                <?= render_logo() ?>
            </div>
            <div class="box-contact">
                <h4><?php echo get_theme_mod('company_name')?></h4>
                <?php if (get_theme_mod('contact_address')):?>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo get_theme_mod('contact_address')?></p>
                <?php endif; ?>
                <?php if (get_theme_mod('contact_email')):?>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i><?php echo get_theme_mod('contact_email')?></p>
                <?php endif; ?>
                <?php if (get_theme_mod('contact_phone')):?>
                    <p><i class="fa fa-phone-square" aria-hidden="true"></i><?php echo get_theme_mod('contact_phone')?></p>
                <?php endif; ?>
                <?php if (get_theme_mod('contact_name')):?>
                    <p><i class="fa fa-user" aria-hidden="true"></i><?php echo get_theme_mod('contact_name')?></p>
                <?php endif; ?>
            </div>
        </div> -->
        <div class="col-lg-12 box-fix-max">
            <h4><i class="fa fa-tags" aria-hidden="true"></i>Từ khóa tìm kiếm</h4>
            <div class="scrollbar scrollbar-black bordered-black square thin tag-clouds">
                <div class="force-overflow"> <?= wp_tag_cloud('smallest=10&largest=13') ?> </div>
            </div>
        </div>
    </div>
</div>
