<?php
global $wpdb;
$appointment_key = 'appointment';
$appointment_style = 'default';
$tableName = $wpdb->prefix . 'appointment_options';

function appoitment_clean_options($value) {
    $value = htmlspecialchars(stripslashes($value));
    return $value;
}

if(isset($_POST['action']) && $_POST['action'] == 'appointment-setting'){
    if(check_admin_referer('appointment-setting', 'appointment-setting')){
        $option_value = [
            'header' => appoitment_clean_options($_REQUEST['tag-header']),
            'summaries' => appoitment_clean_options($_REQUEST['tag-summaries']),
            'workinghours' => appoitment_clean_options($_REQUEST['tag-workinghours']),
            'is_active' => 1
        ];
        $data = [
            'key_name' => $appointment_key,
            'option_name' => $appointment_style,
            'option_value' => serialize($option_value),
            'is_active' => 1
        ];

        // Check key is existed
        $results = $wpdb->get_results("SELECT `id` FROM $tableName");
        if($results) {
            // Update
            $wpdb->update($tableName, $data, ['id' => $results[0]->id]);
        } else {
            // Insert new
            $wpdb->insert($tableName, $data);
        }
    }
}

// show data
$results = $wpdb->get_results("SELECT DISTINCT * FROM $tableName WHERE key_name='".$appointment_key."' AND option_name='".$appointment_style."'", OBJECT);
$option_value = null;
if($results){
    $option_value = unserialize($results[0]->option_value);
}
?>
<div id="wpbody" role="main">
    <div id="wpbody-content">
		<div class="wrap">
            <h1>Appointment setting</h1>
            <div class="card">
                <h2 class="title">Appointment setting</h2>
                <form method="post" class="validate">
                    <input type="hidden" name="action" value="appointment-setting">
                    <?php wp_nonce_field('appointment-setting', 'appointment-setting'); ?>

                    <div class="form-field form-required term-header-wrap">
                        <label for="tag-header"> Header </label>
                        <input name="tag-header" id="tag-header" type="text" value="<?= html_entity_decode($option_value['header']) ?>" size="40" aria-required="true">
                    </div>
                    <div class="form-field term-header-wrap">
                        <label for="tag-summaries">Summaries</label>
                        <?php
                            $content   = html_entity_decode($option_value['summaries']);
                            $editor_id = 'tag-summaries';
                            $args = array(
                                'media_buttons' => false,
                                'textarea_rows' => 5
                            );
                            wp_editor( $content, $editor_id, $args);
                        ?>
                    </div>

                    <div class="form-field term-header-wrap">
                        <label for="tag-workinghours">Workinghours</label>
                        <?php
                            $content   = html_entity_decode($option_value['workinghours']);
                            $editor_id = 'tag-workinghours';
                            $args = array(
                                'media_buttons' => false,
                                'textarea_rows' => 5
                            );
                            wp_editor( $content, $editor_id, $args);
                        ?>
                    </div>
                    
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Update">
                        <span class="spinner"></span>
                    </p>
                </form>
            </div>
		</div>
        <div class="clear"></div>
    </div><!-- wpbody-content -->
</div>