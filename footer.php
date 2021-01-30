    <?php
    $customClient = false;
    if($customClient){
      require_once ('modules/owl-carousel/slide-client.php');
    }
    ?>
    <?php
      if(get_theme_mod('show_footer_layout')){
        require_once ('modules/footer/footer.php');
      }
    ?>
    <?php if(get_theme_mod('show_footer_copyright')) {?>
      <div class="copy-right-box">
        <div class="container">  
          <div class="row">      
            <div class="<?= getDefaultFullLayout() ?>">
              <div class="footer-copyright">
                <span>
                  <?= get_theme_mod('setting_copyright') ?>
                </span>
                <?php if ( has_nav_menu ( 'footer-menu' ) ) : ?>
                <?php 
                    $defaults = array(
                        'theme_location'  => 'footer',
                        'container'       => '',
                        'container_class' => 'footer-menu',
                        'container_id'    => 'footer-menu',
                        'menu_class'      => 'footer-navbar',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 2,
                        'walker'          => false // new menu_walker()
                    );
                    wp_nav_menu ($defaults); 
                    ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php }?>
    <?php wp_footer()?>
    <div id="site-over" class=""></div>
  </body>
</html>
