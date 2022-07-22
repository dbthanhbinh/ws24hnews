$(document).ready(function(){
  var recentSelected = '';
  
  function appointmentCheckEmpty(str){
    if(!str || str.length < 1)
      return true;
    return false;
  }

  function appointmentCheckDropdownValid(value){
    if(!value || value < 1)
      return true;
    return false;
  }

  function appointmentValidString(str, key){
    var flag = false;
    if(appointmentCheckEmpty(str)){
      document.getElementById(key).classList.add('error');
      document.getElementById(key + '_required').classList.add('error');
      flag = true;
    } else {
      document.getElementById(key).classList.remove('error');
      document.getElementById(key + '_required').classList.remove('error');
    }

    return flag;
  }

  function appointmentValidDropdown(value, key){
    var flag = false;
    if(appointmentCheckDropdownValid(value)){
      document.getElementById(key).classList.add('error');
      document.getElementById(key + '_required').classList.add('error');
      flag = true;
    } else {
      document.getElementById(key).classList.remove('error');
      document.getElementById(key + '_required').classList.remove('error');
    }

    return flag;
  }

  function ajaxGet(recentSelected = '') {
    $.ajax({
        type : "post",
        dataType : "json",
        url : adminAjax,
        data : {
          action: "loadtimeset", //Tên action
          setDate: recentSelected
        },
        context: this,
        beforeSend: function(){
            // ...
        },
        success: function(response) {
            if(response.success) {
              var data = (response && response.data) ? response.data : []
              var entryBlock = '';
              if(data?.length > 0){
                entryBlock += '<table><body>';
                data.forEach((item) => {
                  var availableCl = 'available';
                  var available = true;
                  var availableIcon = '<i class="fa fa-check" aria-hidden="true"></i>'; 

                  if(!item.available) {
                    available = false;
                    availableIcon = '<i class="fa fa-times" aria-hidden="true"></i>';
                    availableCl = 'not-available';
                  }

                  entryBlock += '<tr><td class="time-entry ' + availableCl + '">';
                  entryBlock += '<span data-available="'+ available +'" data-setdate="'+ recentSelected +'" data-timesetlabel="'+item.range_name+'" data-value="'+ item.id +'" class="time-entry-block"><i class="fa fa-clock-o" aria-hidden="true"></i> '+ item.range_name +'&nbsp;&nbsp;|&nbsp;&nbsp;'+ availableIcon +'</span>';
                  entryBlock += '</td></tr>';
                })
                entryBlock += '</body></table>';
              }

              $('#demo1-1').find('td.selected').parents('tr')
                .after('<tr class="entryBlock"><td colspan="7"> ' + entryBlock + ' </td></tr>');
              
            }
            else {
                alert('Đã có lỗi xảy ra');
            }
        },
        error: function( jqXHR, textStatus, errorThrown ){
            console.log( 'The following error occured: ' + textStatus, errorThrown );
        }
    })
  }

  function ajaxAppointment(options) {
    $.ajax({
        type : "post",
        dataType : "json",
        url : adminAjax,
        data : {
            action: options.action, //Tên action
            fullName: options.fullName,
            phone: options.phone,
            customNote: options.customNote,
            setDate: options.setDate,
            timeSetId: options.timeSetId,
            serviceId: options.serviceId,
            coupon: options.coupon
        },
        context: this,
        beforeSend: function(){
          /////$('.js-btn-book-appointment').attr('disabled', true);

          $('.modal-spinner-mark').removeClass('close');
          $('.modal-spinner-mark').addClass('open');

          $('.appointment-form-error').html('Xử lý ...');
          $('.appointment-form-error').removeClass('close');
          $('.appointment-form-error').addClass('open');
        },
        success: function(response) {
          console.log('=====: ', response);
          if(response.success) {
            //$('.loadpost_result').html(response.data);
            $('.modal-spinner-mark').removeClass('open');
            $('.modal-spinner-mark').addClass('close');

            if(response.data?.error) {
              $('.appointment-form-error').html(response.data.errorMsg);
            } else {
              $('.appointment-form-error').html('Thành công ...');
            }
            
            // $('.appointment-form-error').removeClass('open');
            // $('.appointment-form-error').addClass('close');

            // resetForm();
          }
          else {
            $('.modal-spinner-mark').removeClass('open');
            $('.modal-spinner-mark').addClass('close');

            // if(response.data?.error) {
            //   $('.appointment-form-error').html(response.data.errorMsg);
            // }
            
            // $('.appointment-form-error').removeClass('close');
            // $('.appointment-form-error').addClass('open');
          }

          /////$('.js-btn-book-appointment').removeAttr('disabled');
        },
        error: function( jqXHR, textStatus, errorThrown ){
            console.log( 'The following error occured: ' + textStatus, errorThrown );
        }
    })
    return false;
  }

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

      // Load timeset
      ajaxGet(recentSelected)

      // $('#demo1-1').find('td.selected').parents('tr')
      // .after('<tr class="entryBlock"><td colspan="7"> ' + renderTimeEntryBlock(recentSelected) + ' </td></tr>');
    }
  }

  function logEvent(type, date) {
      $("<div class='log__entry'/>").hide().html("<strong>"+type + "</strong>: "+date).prependTo($('#eventlog')).show(200);
  }
  
  $('#clearlog').click(function() {
      $('#eventlog').html('');
  });

  var currentDate = new Date();

  var time = currentDate.getHours();
  var validStartDate  = time > 12 ? addDays(currentDate, 0) : currentDate;
  $('#demo1-1').datetimepicker({
      // date: new Date(),
      // date: validStartDate,
      date: validStartDate,
      startDate: validStartDate,
      endDate: addDays(currentDate, 30),
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
    document.getElementById('ap_setdate').value = $(this).attr('data-setdate');
    document.getElementById('ap_timeset').value = $(this).attr('data-value');
    var dateTimeset = '&nbsp;' + $(this).attr('data-setdate') + '&nbsp; &nbsp;|&nbsp;&nbsp;' + $(this).attr('data-timesetlabel');
    document.getElementById('ap_timeset_label').innerHTML = dateTimeset;

    var available = $(this).attr('data-available') === 'true';
    if(available) {
      var btn = document.getElementById('btn-primary-appointment');
      btn.click();
    }
  })

  $('.js-btn-book-appointment').on('click', function() {
    var apSetdate = document.getElementById('ap_setdate').value;
    var apTimesetId = document.getElementById('ap_timeset').value;

    var apName = document.getElementById('ap_name').value;
    var apPhone = document.getElementById('ap_phone').value;
    var apMessage = document.getElementById('ap_message').value;
    var apServiceOptionId = document.getElementById('ap_service').value;

    var flag = 0;
    if(appointmentValidString(apName, 'ap_name')) flag++;
    if(appointmentValidString(apPhone, 'ap_phone')) flag++;
    if(appointmentValidString(apMessage, 'ap_message')) flag++;
    if(appointmentValidDropdown(parseInt(apServiceOptionId), 'ap_service')) flag++;

    if(flag > 0)
      return false;

    ajaxAppointment({
      action: "addappointment", //Tên action
      fullName: apName,
      phone: apPhone,
      customNote: apMessage,
      setDate: apSetdate,
      timeSetId: apTimesetId,
      serviceId: apServiceOptionId,
      coupon: ''
    });
    return false;
  })

  function resetForm() {
    document.getElementById('ap_setdate').value = '';
    document.getElementById('ap_timeset').value = '';
    document.getElementById('ap_name').value = '';
    document.getElementById('ap_phone').value = '';
    document.getElementById('ap_message').value = '';
    document.getElementById('ap_service').value = '';
  }
});