<div class="infomation-contact">
    <div class="infomation-contact">
        <?php if (get_theme_mod('company_name')):?>
        <h4><?= get_theme_mod('company_name') ?></h4>
        <?php endif;?>
        <?php if (get_theme_mod('contact_address')):?>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i><?= get_theme_mod('contact_address') ?></p>
        <?php endif;?>
        <?php if (get_theme_mod('contact_email')):?>
            <p><i class="fa fa-envelope" aria-hidden="true"></i><?= get_theme_mod('contact_email') ?></p>
        <?php endif;?>
        <?php if (get_theme_mod('contact_hotline')):?>
            <p><i class="fa fa-phone-square" aria-hidden="true"></i><?= get_theme_mod('contact_hotline') ?></p>
        <?php endif;?>
        <?php if (get_theme_mod('contact_name')):?>
            <p><i class="fa fa-user" aria-hidden="true"></i><?= get_theme_mod('contact_name') ?></p>
        <?php endif;?>
    </div>
</div>