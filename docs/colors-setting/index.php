<?php
/**
 * Plugin Name: Ws24h colors
 * Description: This is my plugin! It makes social support
 * Author: leotrinh
 * Version: 1.0
 */

// Activation
// To set up an activation hook, use the register_activation_hook() function:
register_activation_hook(__FILE__, 'ws24h_colors_setting_activation_hook');
function ws24h_colors_setting_activation_hook(){}

register_deactivation_hook( __FILE__, 'ws24h_colors_setting_deactivation_hook' );
function ws24h_colors_setting_deactivation_hook(){}

define('PLUGIN_NAME', __("Ws24h colors"));
define('PLUGIN_DES', __("Description Custom Ws24h colors Options here"));
define('PLUGIN_PREF', 'ws24h_');

function getActiveClass($currentBg, $inBg) {
    return ($currentBg == $inBg) ? 'active' : '';
}

add_action( 'wp_footer', 'ws24h_colors_setting_new_customizer_settings' );
function ws24h_colors_setting_new_customizer_settings($wp_customize){
    $currentBg = (isset($_SESSION) && isset($_SESSION['background'])) ? $_SESSION['background'] : '#e83e8c';
    ?>
    <div class="colors-setting-panel">
        <div class="colors-setting-panel_cogs active"><i class="fa fa-cogs" aria-hidden="true"></i></div>

        <div class="colors-setting-container">
            <div class="colors-setting-panel_close_btn"><i class="fa fa-times" aria-hidden="true"></i></div>
            <?php wp_nonce_field( 'colors_setting_form_action', 'colors_setting_form_nonce_field' ); ?>
            <input type='hidden' name='colors_setting_form' value='colors_setting'/>
            <input type='hidden' id='colors_setting_form_background' value='#ff0000'/>
            <strong>Default colors</strong>
            <ul>
                <li class="colors_setting_item <?= getActiveClass($currentBg, '#e83e8c') ?>" data-root="colors_setting_form" data-ref="#e83e8c"><span style="background: #e83e8c;"><i class="fa fa-check" aria-hidden="true"></i></span></li>
                <li class="colors_setting_item <?= getActiveClass($currentBg, '#dc3545') ?>" data-root="colors_setting_form" data-ref="#dc3545"><span style="background: #dc3545;"><i class="fa fa-check" aria-hidden="true"></i></span></li>
                <li class="colors_setting_item <?= getActiveClass($currentBg, '#24ca24') ?>" data-root="colors_setting_form" data-ref="#24ca24"><span style="background: #24ca24;"><i class="fa fa-check" aria-hidden="true"></i></span></li>
                <li class="colors_setting_item <?= getActiveClass($currentBg, '#8c1236') ?>" data-root="colors_setting_form" data-ref="#8c1236"><span style="background: #8c1236;"><i class="fa fa-check" aria-hidden="true"></i></span></li>
            </ul> 
            <div>
                <button class="colors_setting_form_js colors_setting_form_btn" data-ref='colors_setting_form'>Áp dụng</button>
            </div>           
        </div>
    </div>
    <?php
}

function ws24h_colors_settingload_styles($hook) {
    wp_register_style('ws24h_colors_settingload_style', plugins_url('assets/css/style.min.css',__FILE__ ));
    wp_enqueue_style('ws24h_colors_settingload_style');
}
add_action('wp_enqueue_scripts', 'ws24h_colors_settingload_styles');

add_action('wp_footer', 'ws24h_colors_settingload_scripts', 100);
function ws24h_colors_settingload_scripts(){
    ?>
        <script type="text/javascript" src="<?= plugin_dir_url(__FILE__) . 'assets/js/custom.js'?>"></script>
    <?php
}

// ===============================================
add_action( 'wp_ajax_colorsSettingForm', 'colorsSettingForm_init' );
add_action( 'wp_ajax_nopriv_colorsSettingForm', 'colorsSettingForm_init' );
function colorsSettingForm_init() {
    ob_start(); //bắt đầu bộ nhớ đệm
    
    $result = '';
    if (isset($_POST) && $_POST['action'] == 'colorsSettingForm') {
        $cssString = file_get_contents(get_theme_file_path( '/assets/css/default.min.css' ));
        $result = str_replace('#e83e8c', $_POST['background'], $cssString);

        file_put_contents(get_theme_file_path( '/assets/css/default.temp.min.css' ), $result);

        $_SESSION['background'] = $_POST['background'];

    }
    $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
    wp_send_json_success($result); // trả về giá trị dạng json

    die();//bắt buộc phải có khi kết thúc
}