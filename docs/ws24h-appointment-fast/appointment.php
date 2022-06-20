<?php
global $wpdb;
$appointment_key = 'appointment';
$appointment_style = 'default';
$tableName = $wpdb->prefix . 'appointment_options';

$tableService = $wpdb->prefix . 'appointment_service';
$services = $wpdb->get_results("SELECT * FROM $tableService ORDER BY `ordering` ASC");


function getAppointmentOption(){
  $getOptions = get_option('tie_home_cats');
  if($getOptions){
    foreach($getOptions as $option){
      if($option['type'] == 'appointment')
        return $option;
    }
  }
  return null;
}

// show data
$results = $wpdb->get_results("SELECT DISTINCT * FROM $tableName WHERE key_name='".$appointment_key."' AND option_name='".$appointment_style."'", OBJECT);
$option_value = null;
if($results){
  $option_value = unserialize($results[0]->option_value);
}

$optionData = getAppointmentOption();
$boxTitle = (isset($optionData['title']) && $optionData['title']) ? $optionData['title'] : null;
$showTitle = (isset($optionData['show_title']) && $optionData['show_title']) ? $optionData['show_title'] : 'y';
$subTitle = (isset($optionData['subtitle']) && $optionData['subtitle']) ? $optionData['subtitle'] : '';
$description = (isset($optionData['description']) && $optionData['description']) ? $optionData['description'] : '';
$showDescription = (isset($optionData['show_description']) && $optionData['show_description']) ? $optionData['show_description'] : 'y';
$showLayout = (isset($optionData['show_layout']) && $optionData['show_layout']) ? $optionData['show_layout'] : 'lr';

$header = (isset($optionData['header']) && $optionData['header']) ? $optionData['header'] : '';
$summaries = (isset($optionData['summaries']) && $optionData['summaries']) ? $optionData['summaries'] : '';
$workingHours = (isset($optionData['workinghours']) && $optionData['workinghours']) ? $optionData['workinghours'] : '';

require('templates/index.php');
?>
<!-- =================== -->
<button type="button"
  id="btn-primary-appointment"
  style="display:none"
  data-toggle="modal"
  data-target="#appointmentModal">L</button>

<!-- Modal -->
<div class="modal fade appointmentModal" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-spinner-mark">
        <span class="fa fa-spinner fa-spin fa-3x"></span>
      </div>
      <div class="modal-header">
        <h5 class="modal-title" id="appointmentModalLabel"><?= __('Đặt lịch hẹn')?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="booking-appointment">
                <form>
                    <div class="form-group">
                        <label for="timeset"></label>
                          <i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;<span id="ap_timeset_label"></span>
                        <input type="hidden" name="ap_setdate" id="ap_setdate" value="" />
                        <input type="hidden" name="ap_timeset" id="ap_timeset" value="" />
                    </div>
                    <div class="form-group">
                      <label for="name"><?= __('Tên khách hàng') ?>:</label>
                      <input class="" type="text" placeholder="<?= __('Tên khách hàng') ?>" name="ap_name" id="ap_name" value="" />
                      <span id="ap_name_required" class="required">(*)</span>
                      
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= __('Điện thoại') ?>:</label>
                        <input class="" type="text" name="ap_phone" placeholder="<?= __('Điện thoại') ?>" id="ap_phone" value="" />
                        <span id="ap_phone_required" class="required">(*)</span>
                    </div>
                    <div class="form-group">
                        <label for="message"><?= __('Yêu cầu khác') ?>:</label>
                        <textarea class="" name="ap_message" placeholder="<?= __('Yêu cầu khác') ?>" id="ap_message"></textarea>
                        <span id="ap_message_required" class="required">(*)</span>
                    </div>
                    <div class="form-group">
                        <label for="service"><?= __('Dịch vụ') ?>:</label>
                        <select name="ap_service" class="custom-select" id="ap_service">
                            <option value="0" selected><?=  __('Chọn dịch vụ') ?></option>
                            <?php
                            if($services){
                              foreach($services as $service){
                                ?>
                                <option value="<?= $service->id ?>"><?= $service->name_service ?></option>
                                <?php
                              }
                            }
                            ?>
                        </select>
                        <span id="ap_service_required" class="required">(*)</span>
                    </div>
                    <div class="form-group appointment-form-error"></div>

                </form>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary js-btn-book-appointment"><?= __('Đặt hẹn') ?></button>
      </div>
    </div>
  </div>
</div>