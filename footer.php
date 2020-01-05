    <!-- Footer -->
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
        <div class="container-fluid">  
          <div class="row">      
            <div class="col-lg-12">
              <div class="footer-copyright" >
                <span>
                  <?= get_theme_mod('setting_copyright') ?>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php }?>
    <?php wp_footer()?>

    <!-- For sticky sidebar -->
    <script type="text/javascript">
      if( $('#sidebar').length ) {
        var sidebar = new StickySidebar('#sidebar', {
            topSpacing: 50,
            bottomSpacing: 50
        });
      }
    </script>
  </body>
</html>
