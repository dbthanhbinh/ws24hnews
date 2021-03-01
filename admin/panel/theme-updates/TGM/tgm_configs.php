<?php
require_once('class-tgm-plugin-activation.php');
if(function_exists('my_plugin_activation'))
	add_action( 'tgmpa_register', 'my_plugin_activation' );

function my_plugin_activation() {
    $plugins = array(
        // Gọi một plugin nào đó ở bên ngoài
        array(
            'name'               => 'ws24h support', // Tên của plugin
            'slug'               => 'ws24h-support', // Tên thư mục plugin
            'source'             => dirname( __FILE__ ).'\plugins\ws24h-support.zip', // Link tải plugin - direct link
            'required'           => true, // Nếu đặt là true thì plugin này sẽ không bắt buộc phải cài mà chỉ ở dạng Recommend.
            // 'external_url'       => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // Nếu bạn cài plugin ở bên ngoài, không phải từ WordPress.Org thì thêm URL của trang plugin vào.
        ),
        array(
            'name'               => 'ws24h contact', // Tên của plugin
            'slug'               => 'ws24h-contact', // Tên thư mục plugin
            'source'             => dirname( __FILE__ ).'\plugins\ws24h-contact.zip', // Link tải plugin - direct link
            'required'           => true, // Nếu đặt là true thì plugin này sẽ không bắt buộc phải cài mà chỉ ở dạng Recommend.
            // 'external_url'       => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // Nếu bạn cài plugin ở bên ngoài, không phải từ WordPress.Org thì thêm URL của trang plugin vào.
        ),
        array(
            'name'               => 'WWP Gmail SMTP', // Tên của plugin
            'slug'               => 'wp-gmail-smtp', // Tên thư mục plugin
            'source'             => dirname( __FILE__ ).'\plugins\wp-gmail-smtp.zip', // Link tải plugin - direct link
            'required'           => true, // Nếu đặt là true thì plugin này sẽ không bắt buộc phải cài mà chỉ ở dạng Recommend.
            // 'external_url'       => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // Nếu bạn cài plugin ở bên ngoài, không phải từ WordPress.Org thì thêm URL của trang plugin vào.
        )
    );
    // end $plugins
 
    $config = array(
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Có hiển thị thông báo hay không
        'dismissable'  => true,                    // Nếu đặt false thì người dùng không thể hủy thông báo cho đến khi cài hết plugin.
        'dismiss_msg'  => '',                      // Nếu 'dismissable' là false, thì tin nhắn ở đây sẽ hiển thị trên cùng trang Admin.
        'is_automatic' => false,                   // Nếu là false thì plugin sẽ không tự động kích hoạt khi cài xong.
        'message'      => '',
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    // end $config
    tgmpa( $plugins, $config );
}