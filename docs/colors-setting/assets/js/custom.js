$(document).ready(function(){
    function ajaxAppointment(options) {
      $.ajax({
          type : "post",
          dataType : "json",
          url : adminAjax,
          data : {
              action: options.action, //Tên action
              background: options.background,
              nonce_action: options.nonce_action
          },
          context: this,
          beforeSend: function(){
          },
          success: function(response) {
            window.location.reload()
          },
          error: function( jqXHR, textStatus, errorThrown ){
              console.log( 'The following error occured: ' + textStatus, errorThrown );
          }
      })
      return false;
    }
  
    $('.colors_setting_form_js').on('click', function() {
        const ref = $(this).attr('data-ref')
        const background = document.getElementById(ref + '_background').value
        const nonce_action = document.getElementById(ref + '_nonce_field').value
        ajaxAppointment({
            action: "colorsSettingForm", //Tên action
            background: background,
            nonce_action: nonce_action
        });
        return false;
    })

    $('.colors_setting_item').on('click', function(){
        const root = $(this).attr('data-root')
        const ref = $(this).attr('data-ref')
        document.getElementById(root + '_background').value = ref

        $('.colors_setting_item').removeClass('active');
        $(this).addClass('active');
    })

    $('.colors-setting-panel_cogs').on('click', function(){
        $(this).toggleClass('active')
        $('.colors-setting-container').toggleClass('active')
    })

    $('.colors-setting-panel_close_btn').on('click', function(){
        $('.colors-setting-panel_cogs, .colors-setting-container').toggleClass('active')
    })

  });