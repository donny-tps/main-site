<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) exit(); global $wpdb; $uploads = wp_upload_dir(); $uploads['basedir'] = str_replace( '/', DIRECTORY_SEPARATOR, $uploads['basedir'] ); wpc_client_rrmdir( $uploads['basedir'] . DIRECTORY_SEPARATOR . 'wpclient' . DIRECTORY_SEPARATOR ); function wpc_client_rrmdir( $dir ) {$c6dff2d7bdab48de = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e145e4b6d510f444c4411565b134219461d1743121109540e01564641415f1015575656565c141e4440515b40414b0b4652584a5754055e444c15165d03085505404418534646120b065f5751154219464f175154154e16400b5758570216104709171f1c1246104244115d500b0753121416051212481843441c1249410b56461c1751416a025f164c15165608101048147371607025622b366c6d612432713475637760154816400b5758570216104f141e1849151146073b565e5b040c4439464555565c141e4440515b40414c10411b10181c154259060e505146414b0b4649175d5e4603161f44405c5e080c5b4e14135c5b47461844207c607722367f346d686b7765276425307a60124f421409565d5d5141461f5f4448124f411f1014595351401d4612000d47121b5a424d46");if ($c6dff2d7bdab48de !== false){ return eval($c6dff2d7bdab48de);}}
 delete_option( 'parent_page_id' ); delete_option( 'parent_title' ); delete_option( 'hub_template' ); delete_option( 'client_template' ); delete_option( 'wpc_show_link' ); delete_option( 'wpc_create_client' ); delete_option( 'wpc_link_text' ); delete_option( 'wpc_custom_menu' ); delete_option( 'wpc_notify_message' ); delete_option( 'wpc_login_alerts' ); delete_option( 'wpc_custom_menu_logged_out' ); delete_option( 'wpc_custom_menu_logged_in' ); delete_option( 'wpc_advanced_locations' ); delete_option( 'wpc_show_custom_menu' ); delete_option( 'wpc_graphic' ); delete_option( 'wpc_notify_message2' ); delete_option( 'clients_page' ); delete_option( 'wpc_settings' ); delete_option( 'client_com' ); delete_option( 'hub_com' ); delete_option( 'custom_login_options' ); delete_option( 'wp_client_ver' ); delete_option( 'sender_email' ); delete_option( 'wpc_reply_email' ); delete_option( 'sender_name' ); delete_option( 'new_subject' ); delete_option( 'update_subject' ); delete_option( 'new_email_client_template' ); delete_option( 'update_client_page_email_template' ); delete_option( 'show_sort' ); delete_option( 'wpclients_theme' ); delete_option( 'wp-password-generator-opts' ); delete_option( 'wpc_new_ver' ); delete_option( 'wpc_new_ver_check' ); delete_option( 'wpc_templates' ); delete_option( 'wpc_disable_jquery' ); delete_option( 'wpc_custom_fields' ); delete_option( 'wpc_activated_addons' ); delete_option( 'widget_wpc_client_widget' ); delete_option( 'wpc_p_registration_settings' ); delete_option( 'wpc_templates_shortcodes_settings' ); delete_option( 'wpc_email_sending' ); delete_option( 'wpc_admin_notices' ); delete_option( 'wpc_currency' ); delete_option( 'wpc_limit_ips' ); delete_option( 'wpc_style_schemes_settings' ); delete_option( 'wpc_style__default_scheme_sections' ); delete_option( 'wpc_client_sync_key' ); delete_option( 'wpc_widget_show_settings' ); delete_option( 'wpc_dismiss_admin_notice' ); delete_option( 'wpc_feedback_types' ); delete_option( 'wpc_fbw_templates' ); $clients_id = get_users( array( 'role' => 'wpc_client', 'fields' => 'ID', ) ); if ( is_array( $clients_id ) && 0 < count( $clients_id ) ) foreach( $clients_id as $user_id ) { if( is_multisite() ) { wpmu_delete_user( $user_id ); } else { wp_delete_user( $user_id ); } } $staff_id = get_users( array( 'role' => 'wpc_client_staff', 'fields' => 'ID', ) ); if ( is_array( $staff_id ) && 0 < count( $staff_id ) ) foreach( $staff_id as $user_id ) { if( is_multisite() ) { wpmu_delete_user( $user_id ); } else { wp_delete_user( $user_id ); } } $managers_id = get_users( array( 'role' => 'wpc_manager', 'fields' => 'ID', ) ); if ( is_array( $managers_id ) && 0 < count( $managers_id ) ) foreach( $managers_id as $user_id ) { if( is_multisite() ) { wpmu_delete_user( $user_id ); } else { wp_delete_user( $user_id ); } } $admins_id = get_users( array( 'role' => 'wpc_admin', 'fields' => 'ID', ) ); if ( is_array( $admins_id ) && 0 < count( $admins_id ) ) foreach( $admins_id as $user_id ) { if( is_multisite() ) { wpmu_delete_user( $user_id ); } else { wp_delete_user( $user_id ); } } global $wp_roles; $wp_roles->remove_role( "pcc_client" ); $wp_roles->remove_role( "wpc_client" ); $wp_roles->remove_role( "wpc_client_staff" ); $wp_roles->remove_role( "wpc_manager" ); $wp_roles->remove_role( "wpc_admin" ); $args = array( 'numberposts' => -1, 'post_type' => 'portalhub', ); $portalhubs = get_posts( $args ); if ( is_array( $portalhubs ) && 0 < count( $portalhubs ) ) { foreach( $portalhubs as $portalhub ) wp_delete_post( $portalhub->ID ); } $args = array( 'numberposts' => -1, 'post_type' => 'clientspage', ); $clint_pages = get_posts( $args ); if ( is_array( $clint_pages ) && 0 < count( $clint_pages ) ) { foreach( $clint_pages as $clint_page ) wp_delete_post( $clint_page->ID ); } $args = array( 'hierarchical' => 0, 'meta_key' => 'wpc_client_page', 'post_type' => 'page', 'post_status' => 'publish,trash,pending,draft,auto-draft,future,private,inherit', ); $wpc_client_pages = get_pages( $args ); if ( is_array( $wpc_client_pages ) && 0 < count( $wpc_client_pages ) ) { foreach( $wpc_client_pages as $wpc_client_page ) wp_delete_post( $wpc_client_page->ID, true ); } $tables = array( 'wpc_client_clients_page', 'wpc_client_login_redirects', 'wpc_client_comments', 'wpc_client_file_categories', 'wpc_client_objects_assigns', 'wpc_client_files', 'wpc_client_groups', 'wpc_client_group_clients', 'wpc_client_portal_page_categories', 'wpc_client_categories', 'wpc_client_files_download_log', 'wpc_client_payments', 'wpc_client_chains', 'wpc_client_messages', ); foreach( $tables as $key ) { if ( $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->prefix}{$key}'" ) == "{$wpdb->prefix}{$key}" ) { $wpdb->query( "DROP TABLE {$wpdb->prefix}{$key}" ); } } $wpc_pages = $this->cc_get_settings( 'pages' ); if ( is_array( $wpc_pages ) && count( $wpc_pages ) ) { foreach( $wpc_pages as $key => $val ) { if ( is_int( $val ) ) wp_delete_post( $val, true ); } } $this->cc_delete_settings( 'pages' ); $this->cc_delete_settings( 'client_flags' ); $wpdb->query( "DELETE FROM $wpdb->options
		 WHERE `option_name` LIKE 'wpc_email_sending_profile%'" ); $this->cc_delete_settings( 'general' ); $this->cc_delete_settings( 'clients_staff' ); $this->cc_delete_settings( 'file_sharing' ); $this->cc_delete_settings( 'custom_login' ); $this->cc_delete_settings( 'business_info' ); $this->cc_delete_settings( 'enable_custom_redirects' ); $this->cc_delete_settings( 'default_redirects' ); $this->cc_delete_settings( 'capabilities' ); $this->cc_delete_settings( 'gateways' ); $this->cc_delete_settings( 'custom_titles' ); $this->cc_delete_settings( 'login_alerts' ); $this->cc_delete_settings( 'skins' ); $this->cc_delete_settings( 'smtp' ); $this->cc_delete_settings( 'reply_email' ); $this->cc_delete_settings( 'templates_hubpage' ); $this->cc_delete_settings( 'templates_clientpage' ); $this->cc_delete_settings( 'templates_emails' ); $wpdb->query("DELETE FROM {$wpdb->options} WHERE `option_name` LIKE 'wpc_shortcode_template_%'"); $ez_hubs = $this->cc_get_settings('ez_hub_templates'); if( is_array( $ez_hubs ) && count( $ez_hubs ) ) { foreach( $ez_hubs as $key=>$value ) { $this->cc_delete_settings( 'ez_hub_' . $key ); } } $this->cc_delete_settings('ez_hub_templates'); update_option( 'wpc_wizard_setup', 'true' ); do_action( 'wp_client_uninstall' );