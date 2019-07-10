    <!-- Footer -->
    <?php require_once ('modules/footer/footer.php')?>
    <div class="copy-right-box">
      <div class="container">  
        <div class="row">      
          <div class="col-lg-12">
            <div class="footer-copyright">
              <span>
                <?= get_theme_mod('setting_copyright') ?>
              </span>
              <?php if ( has_nav_menu ( 'primary' ) ) : ?>
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
    <?php wp_footer()?>


    <!--Call Support-->
    <div class="support-online">
        <div class="support-content-call">
            <a href='tel:<?= get_theme_mod('contact_hotline')?>' class="call-now" rel="nofollow">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <div class="animated infinite zoomIn kenit-alo-circle"></div>
                <div class="animated infinite pulse kenit-alo-circle-fill"></div>
                <span>Hotline: <?= get_theme_mod('contact_hotline')?></span>
            </a>
        <a class="mes" href="https://m.me/__">
            <img src="<?= get_template_directory_uri() ?>/assets/images/messenger.png">
            <span>Nhắn tin facebook</span>
        </a>
        <a class="zalo" href="http://zalo.me/<?= get_theme_mod('contact_hotline')?>">
            <img src="<?= get_template_directory_uri()?>/assets/images/zalo.png">
            <span>Zalo: <?= get_theme_mod('contact_hotline')?></span>
        </a>
        <a class="sms" href="sms:<?= get_theme_mod('contact_hotline')?>?body=<?= get_the_title()?>">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <span>SMS: <?= get_theme_mod('contact_hotline')?></span>
        </a>
        </div>
    </div>
    <!--End Call Support-->
  </body>
</html>
