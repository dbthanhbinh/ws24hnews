    <?php
    $customClient = false;
    if($customClient){
      require_once ('modules/owl-carousel/slide-client.php');
    }
    ?>
    <?php
      if(get_theme_mod('show_footer_layout', false)){
        require_once ('modules/footer/footer.php');
      }
    ?>
    <?php
    if(get_theme_mod('show_footer_copyright', LAYOUT_SHOW_FOOTER_COPYRIGHT)) {?>
      <div id="copy-right-box" class="copy-right-box">
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
    <div id="site-over" class=""></div>
    <div class="scrollup"><span><i class="fa fa-eject" aria-hidden="true"></i></span></div>

    <?php wp_footer()?>


    <!-- Fast Appointment -->
    <!-- <script type="text/javascript" src="../lib/jquery-1.11.1.js"></script> -->
    <script type="text/javascript" src="<?= get_theme_file_uri('/assets/fastappointment/jquery.datetimepicker.js')?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var recentSelected = '';

            var timeEntryBlock = '<table><body>';
                timeEntryBlock += '<tr><td class="time-entry"><span data-value="8-10" class="time-entry-block">8:00 -> 10:00</span></td></tr>';
                timeEntryBlock += '<tr><td class="time-entry"><span data-value="10-12" class="time-entry-block">10:00 -> 12:00</span></td></tr>';
                timeEntryBlock += '<tr><td class="time-entry"><span data-value="13-15" class="time-entry-block">13:00 -> 15:00</span></td></tr>';
                timeEntryBlock += '<tr><td class="time-entry"><span data-value="15-15" class="time-entry-block">15:00 -> 17:00</span></td></tr>';
                timeEntryBlock += '</body></table>';

            function addDays(date, days) {
                var result = new Date(date);
                result.setDate(date.getDate() + days);
                return result;
            }

            function entryBlockSelected(recentDate){
              var entryBlockDefault = $('#demo1-1').find('tr.entryBlock')
              recentSelected = recentSelected.toString();
              if((recentSelected === recentDate) && entryBlockDefault && entryBlockDefault.length > 0){
                entryBlockDefault.remove();
                recentSelected = '';
              } else {
                if(entryBlockDefault && entryBlockDefault.length > 0){
                  entryBlockDefault.remove();
                  recentSelected = '';
                }

                recentSelected = recentDate
                $('#demo1-1').find('td.selected').parents('tr')
                .after('<tr class="entryBlock"><td colspan="7"> ' + timeEntryBlock + ' </td></tr>');
              }
            }

            function logEvent(type, date) {
                $("<div class='log__entry'/>").hide().html("<strong>"+type + "</strong>: "+date).prependTo($('#eventlog')).show(200);
            }
            
            $('#clearlog').click(function() {
                $('#eventlog').html('');
            });

            var currentDate = new Date();
            $('#demo1-1').datetimepicker({
                //date: new Date(),
                date: currentDate,
                startDate: currentDate,
                endDate: addDays(currentDate, 60),
                viewMode: 'YMDHMS',
                //date selection event                
                onDateChange: function() {
                    // //logEvent('onDateChange', this.getValue());
                    // $('#date-text1-1').text(this.getText());
                    // $('#date-text-ymd1-1').text(this.getText('YYYY-MM-DD'));
                    // $('#date-value1-1').text(this.getValue());

                    /////
                    // recentSelected = this.getText('YYYY-MM-DD');
                    entryBlockSelected(this.getText('YYYY-MM-DD'));
                },
                //clear button click event
                onClear: function() {
                    logEvent('onClear', this.getValue());
                },
                //ok button click event
                onOk: function() {
                    logEvent('onOk', this.getValue());
                },
                //close button click event
                onClose: function() {
                    logEvent('onClose', this.getValue());
                }
            });
            
            $('#demo1-1').on('click', '.time-entry-block', function(){
              //alert($(this).attr('data-value'))
              var btn = document.getElementById('btn-primary-123');
              btn.click()
            })
        });
    </script>

  </body>
</html>
