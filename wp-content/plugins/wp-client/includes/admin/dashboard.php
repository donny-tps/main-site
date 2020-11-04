<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } $current_tab = ! empty( $_REQUEST['tab'] ) ? $_REQUEST['tab'] : 'dashboard'; ?>
<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <?php echo $this->gen_tabs_menu( 'dashboard' ); if( $this->wpc_flags['easy_mode'] ) { ?>
        <div id="message" class="updated wpc_notice fade"><p>
            <?php printf( __( 'Easy Mode Currently Active. You can change it on <a href="$s" target="_blank">General Settings</a>.', WPC_CLIENT_TEXT_DOMAIN ), admin_url( 'admin.php?page=wpclients_settings' ) ) ?>
            </p></div>
    <?php } switch ( $current_tab ) { case "system_status": if ( ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) && !$this->plugin['hide_system_status_tab'] ) { include_once( $this->plugin_dir . 'includes/admin/dashboard_system_status.php' ); } else { do_action( 'wp_client_redirect', admin_url( 'admin.php?page=wpclients' ) ); exit; } break; case "get_started": if ( ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) && !$this->plugin['hide_get_started_tab'] ) { include_once( $this->plugin_dir . 'includes/admin/dashboard_get_started.php' ); } else { do_action( 'wp_client_redirect', admin_url( 'admin.php?page=wpclients' ) ); exit; } break; default: if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { include_once( $this->plugin_dir . 'includes/admin/dashboard_dashboard.php' ); } elseif ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { include_once( $this->plugin_dir . 'includes/admin/dashboard_dashboard.php' ); } else { include_once( $this->plugin_dir . 'includes/admin/dashboard_managers.php' ); } break; } if ( false === get_option( 'whtlwpc_settings' ) ) { ?>
        <div class="wpc_banners">
            <a href="http://wp-client.com"><img src="<?php echo $this->plugin_url . 'images/banners/banner_top.png' ?>" width="250" /></a>
            <a href="http://translate.wp-client.com"><img src="<?php echo $this->plugin_url . 'images/banners/banner_translate.png' ?>" width="250" /></a>
            <a href="http://wp-client.com/support-please-work-through-checklist/"><img src="<?php echo $this->plugin_url . 'images/banners/banner_support.png' ?>" width="250" /></a>
        </div>
    <?php } ?>
</div>