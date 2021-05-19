<nav id="main-navbar" data-ref="<?= getHeaderClassConfigVersion() ?>" <?php echo (isset($customBg) && $customBg) ? 'style="background: ' . $customBg . '"' : ''; ?> class="navbar navbar-expand-lg <?= getHeaderClassConfigVersion() ?>">
    <div class="container">
        <?php
        if(get_theme_mod('header_version', LAYOUT_HEADER_VERSION) == LAYOUT_HEADER_VERSION){
            ?>
            <div class="render-logo">
                <?= render_logo() ?>
            </div>
            <?php
        } else {
            if(!get_theme_mod('show_header_banner')){
                ?>
                <div class="render-logo">
                    <?= render_logo() ?>
                </div>
                <?php
            }
            else {
            ?>
            <a class="navbar-brand" href="<?= site_url() ?>"><i class="fa fa-home" aria-hidden="true"></i></a>
            <?php
            }
        }
        ?>

        <div class="small-render-logo"> <?= render_logo() ?></div>
        
        <button class="navbar-toggler" type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </span>
        </button>

        <?php if ( has_nav_menu ( 'primary' ) ) : ?>
        <?php 
            $defaults = array(
                'theme_location'  => 'primary',
                'container'       => 'div',
                'container_class' => 'menu-primary-container collapse navbar-collapse',
                'container_id'    => 'navbarResponsive',
                'menu_class'      => 'navbar-nav ml-auto',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 2,
                'walker'          => new menu_walker()
            );
            wp_nav_menu ($defaults);
            ?>
        <?php endif; ?>
    </div>
</nav>