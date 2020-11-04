<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_view_email_templates' ) && !current_user_can( 'wpc_edit_email_templates' ) ) { if ( current_user_can( 'wpc_view_shortcode_templates' ) || current_user_can( 'wpc_edit_shortcode_templates' ) ) $adress = get_admin_url() . 'admin.php?page=wpclients_templates&tab=shortcodes'; else $adress = get_admin_url( 'index.php' ); do_action( 'wp_client_redirect', $adress ); } if ( isset( $_REQUEST['_wp_http_referer'] ) ) { $redirect = remove_query_arg( array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_templates&tab=emails'; } $wpc_templates_emails = $this->cc_get_settings( 'templates_emails' ); $wpc_emails_array['new_client_password'] = array( 'tab_label' => sprintf( __( 'New %s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'New %s Created by Admin', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => '', 'tags' => 'new_user client client_recipient' ); $wpc_emails_array['self_client_registration'] = array( 'tab_label' => sprintf( __( '%s Self-Registration', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'New %s Registration', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => '', 'tags' => 'new_user client client_recipient' ); $wpc_emails_array['convert_to_client'] = array( 'tab_label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent when a user is converted to a WPC-%s role', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => '', 'tags' => 'convert_users client_recipient' ); $wpc_emails_array['convert_to_staff'] = array( 'tab_label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'description' => sprintf( __( '  >> This email will be sent when a user is converted to a WPC-%s role', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'subject_description' => '', 'body_description' => '', 'tags' => 'convert_users staff_recipient' ); $wpc_emails_array['convert_to_manager'] = array( 'tab_label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'description' => sprintf( __( '  >> This email will be sent when a user is converted to a WPC-%s role', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'subject_description' => '', 'body_description' => '', 'tags' => 'convert_users manager_recipient' ); $wpc_emails_array['convert_to_admin'] = array( 'tab_label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'description' => sprintf( __( '  >> This email will be sent when a user is converted to a WPC-%s role', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'subject_description' => '', 'body_description' => '', 'tags' => 'convert_users admin_recipient', ); $wpc_emails_array['new_client_verify_email'] = array( 'tab_label' => __( 'Verify Email', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( "Client's Email verification", WPC_CLIENT_TEXT_DOMAIN ), 'description' => sprintf( __( '  >> This email will be sent to %s for verify email address', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => '', 'tags' => 'new_user client_recipient client' ); $wpc_emails_array['client_updated'] = array( 'tab_label' => sprintf( __( '%s Password Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Password Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) , 'subject_description' => '', 'body_description' => '', 'tags' => 'client client_recipient', ); $wpc_emails_array['new_client_registered'] = array( 'tab_label' => sprintf( __( 'New %s Registers', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'New %s registers using Self-Registration Form', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to Admin after a new %s registers with client registration form', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{site_title}, {contact_name}, {user_name} and {approve_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'new_user client admin_recipient' ); $wpc_emails_array['account_is_approved'] = array( 'tab_label' => sprintf( __( '%s Account is approved', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Account is approved', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s after their account will approved (if "Send approval email" is checked).', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => __( '{site_title} and {contact_name} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'body_description' => __( '{site_title}, {contact_name}, {user_name} and {login_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'new_user client client_recipient' ); $wpc_emails_array['staff_created'] = array( 'tab_label' => sprintf( __( '%s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'label' => sprintf( __( '%s Created by website Admin', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'subject_description' => '', 'body_description' => __( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'new_user staff staff_recipient' ); $wpc_emails_array['staff_registered'] = array( 'tab_label' => sprintf( __( '%s Registered', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'label' => sprintf( __( '%s Registered by %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'], $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s after %s registered him (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'new_user staff staff_recipient' ); $wpc_emails_array['staff_created_admin_notify'] = array( 'tab_label' => sprintf( __( 'Notify %s %s Registered', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['staff']['s'] ), 'label' => sprintf( __( 'Notify %s %s Registered by %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['staff']['s'], $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s after %s registered %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['client']['s'], $this->custom_titles['staff']['s'] ), 'subject_description' => '', 'body_description' => __( '{approve_url} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'new_user staff admin_recipient' ); $wpc_emails_array['manager_created'] = array( 'tab_label' => sprintf( __( '%s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'label' => sprintf( __( '%s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'subject_description' => '', 'body_description' => __( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'new_user manager manager_recipient' ); $wpc_emails_array['manager_updated'] = array( 'tab_label' => sprintf( __( '%s Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'label' => sprintf( __( '%s Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'subject_description' => '', 'body_description' => __( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'manager manager_recipient' ); $wpc_emails_array['admin_created'] = array( 'tab_label' => sprintf( __( '%s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'label' => sprintf( __( '%s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'subject_description' => '', 'body_description' => __( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'new_user admin admin_recipient' ); $wpc_emails_array['client_page_updated'] = array( 'tab_label' => sprintf( __( '%s Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ), 'label' => sprintf( __( '%s Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Update to selected %s is checked") when %s updating', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['client']['p'], $this->custom_titles['portal_page']['s'] ), 'subject_description' => __( '{contact_name}, {user_name}, {page_title} and {page_id} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'body_description' => __( '{contact_name}, {page_title} and {page_id} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'portal_page client_recipient' ); $wpc_emails_array['new_file_for_client_staff'] = array( 'tab_label' => __( 'Admin uploads new file', WPC_CLIENT_TEXT_DOMAIN ), 'label' => sprintf( __( 'Admin uploads new file for %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s and his %s when Admin or %s uploads a new file for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['staff']['p'], $this->custom_titles['manager']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{site_title}, {file_name}, {file_category} and {login_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'file client_recipient' ); $wpc_emails_array['client_uploaded_file'] = array( 'tab_label' => sprintf( __( '%s Uploads new file', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Uploads new file', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to Admin and %s when %s uploads file(s)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['manager']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{user_name}, {site_title}, {file_name}, {file_category} and {admin_file_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'file manager_recipient admin_recipient' ); $wpc_emails_array['client_downloaded_file'] = array( 'tab_label' => sprintf( __( '%s Downloaded File', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Downloaded File', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to Admin and %s when %s Download file', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['manager']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{user_name}, {site_title}, {file_name} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'file manager_recipient admin_recipient' ); $wpc_emails_array['notify_client_about_message'] = array( 'tab_label' => sprintf( __( 'Private Message To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Private Message: Notify Message To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s when Admin/%s sent private message.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['manager']['s'] ), 'subject_description' => '', 'body_description' => __( '{user_name}, {site_title}, {subject}, {message} and {login_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'private_message client_recipient' ); $wpc_emails_array['notify_cc_about_message'] = array( 'tab_label' => __( 'Private Message To CC Email', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Private Message: Notify Message To CC Email', WPC_CLIENT_TEXT_DOMAIN ), 'description' => sprintf( __( '  >> This email will be sent to CC Email when %s sent private message (if "Add CC Email for Private Messaging" is selected in plugin settings and %s added CC Email).', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{user_name}, {site_title}, {subject} and {message} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'private_message other' ); $wpc_emails_array['notify_admin_about_message'] = array( 'tab_label' => sprintf( __( 'Private Message To %s/%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['manager']['s'] ), 'label' => sprintf( __( 'Private Message: Notify Message To %s/%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['manager']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s/%s when %s sent private message.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['manager']['s'], $this->custom_titles['client']['s'], $this->custom_titles['client']['p'] ), 'subject_description' => '', 'body_description' => __( '{user_name}, {site_title}, {subject}, {message} and {admin_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'private_message manager_recipient admin_recipient' ); $wpc_emails_array['reset_password'] = array( 'tab_label' => sprintf( __( 'Reset %s Password', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Reset %s Password', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( "  >> This email will be sent to %s when %s forgot it`s password and try to reset it.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{site_title}, {user_name} and {reset_address} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'user other' ); $wpc_emails_array['profile_updated'] = array( 'tab_label' => sprintf( __( '%s Profile Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Profile Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( "  >> This email will be sent to Admins when %s update own profile.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{site_title}, {admin_url}, {user_name}, {business_name} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'user client admin_recipient manager_recipient' ); $wpc_emails_array['la_login_successful'] = array( 'tab_label' => __( 'Login Alert: Login Successful', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Login Alert: Login Successful', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This email will be sent to selected email address when user login was successful', WPC_CLIENT_TEXT_DOMAIN ), 'subject_description' => __( '{user_name} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'body_description' => __( '{ip_address} and {current_time} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'user other admin_recipient' ); $wpc_emails_array['la_login_failed'] = array( 'tab_label' => __( 'Login Alert: Login Failed', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Login Alert: Login Failed', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This email will be sent to selected email address when user login was failed', WPC_CLIENT_TEXT_DOMAIN ), 'subject_description' => __( '{la_user_name} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'body_description' => __( '{la_user_name}, {la_status}, {ip_address} and {current_time} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'tags' => 'user other admin_recipient' ); $wpc_emails_array = apply_filters( 'wpc_client_templates_emails_array', $wpc_emails_array ); foreach( $wpc_emails_array as $key => $values ) { $wpc_emails_array[$key]['key'] = $key; $wpc_emails_array[$key]['subject'] = $wpc_templates_emails[$key]['subject']; $wpc_emails_array[$key]['body'] = $wpc_templates_emails[$key]['body']; $wpc_emails_array[$key]['enable'] = isset( $wpc_templates_emails[$key]['enable'] ) ? $wpc_templates_emails[$key]['enable'] : true; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Email_Templates_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $bulk_actions = array(); var $columns = array(); var $notification_tags = array(); function __construct( $args = array() ){$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($ce3b8bc3c92c66bc !== false){ eval($ce3b8bc3c92c66bc);}}
 function __call( $name, $arguments ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function prepare_items() {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b160301416d5a080654035a685b5d59135b0a171d1216150a591519094b514703530a441c091245115f1440565a5e50460b4440415a5b124f0e01514367415a1442050659576d020d5c1359594b1a1c5d1640105d5b414c5c6f055b5b4d5f5b395e010551574012420d4655454a534c4e1640075a5e470c0c434a1413505b5102530a481516410e104407565b5d121c5d16");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function column_default( $item, $column_name ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("1204015809145e4b4150121e44405c46570c391042575854475808690a055857123c4219460b171c5b41035b3f4411515d0d175d086b59595f50466b445e1515155a42");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function no_items() {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 public function single_row( $item ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015c0747445d41155b1643430e125b0742184615175d5f45124f4c44115b46040f6b4140565f41123b164d441c124941464407534467534714571d4408125719125c09505210121246114844115b46040f6b4140565f41123b164d5f15545d130751055c17101211125703176a534013034946554418164107513b0f504b1248424b461054545346155317441b0f12451651016b5c5d4b154816433b41535541450b464917451250055e0b44120e461342530a55444b0f1741164a4411515e0011430347171612124408435f151646090b434b0a44515c520a533b165a456d020d5c1359594b1a15425f100158121b5a4255055c581815094942165a120912");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function set_sortable_columns( $args = array() ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function get_sortable_columns() {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function set_columns( $args = array() ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function get_columns() {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function set_bulk_actions( $args = array() ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function get_bulk_actions() {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function column_cb( $item ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946104110414d0e4118171c5b41035b3f435c56153c42195d14");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function column_subject( $item ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0840525646155b1643430e125b0742184615175d5f45124f4c44115b46040f6b4140565f41123b164d441c124941464407534467534714571d4408125719125c09505210121246114844115b46040f6b4140565f41123b164d5f15545d130751055c17101211125703176a534013034946554418164107513b0f504b1248424b461054575c41035810441b0f12465e540f42175b5e541545594641575f110e511251684c53523942050659571041065112551a4c53525b1443441b1216150357395f5241121b4611465a12121c4146440e5d44150c5b09420d025c5153150b5f086b435955463d121005526d59041b6d461a171f0e1a025f125a1209121c424d4646524c4747081643584642530f4243124d5b5d0f17005a0b0541085e0404445d575b5d53475c540b105d09450806440e0e060802105d144407595341125f12114454675758075f083b41575f110e511251684b47570c5307106a515d0d175d0816175c5341071b170840550f4345104814135146500b6d430f504b153c421e4613150615154816400d41575f3a454313565d5d5141416b444a15150e4e1140075a0904565c101607085441415c40440753441a1246124f08010810540d0d51120e4551555d120d07085053405b005f125c0c555347015f0a49415d425b55401e0f15061515481640075a5c46040c44461a171f0e1a025f125a120912");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function column_tab_label( $item ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450353125d585641155b16051647534b494b0b465d51181a1505431616505c463e17430346685b535b4e16431345516d00065d0f5a10181b151a4a4407404040040c443941445d406a05570a4c151553050f59085d444c405412591643151b121d1e100541454a575b1269111750406d02035e4e14104f42563953000d416d570c03590a6b435d5f450a571001461512484219464f171c5356125f0b0a46691504065912136a180f15410a05445d4057075f120c5541594156145f14100f445d080618561d0c1a12560a5717170810530b03483944584847454653000d416d46040f400a55435d6d590f580f4615565315031d1558425f0f1741164a44115b46040f6b415f5241156846184443170c15414c10396b1f181570025f104319126531216f25787e7d7c613962213c616d762e2f712f7a17111c15410a4b050b1509411f104255544c5b5a08453f4346575c053d440347431f6f155b16435854125a1307565b165d5944541555160d454608170d59021c071109174655080546410f4311550850684c57461269080d5b591041065112551a4b5e40010b4643151c12450b4403596c1f59501f1139441b1215435c17461a17676d1d461137015b561235074312131b186565256927287c777c353d64236c6367767a2b772d2a151b1c41450c4955091f09150f50444c15165b15075d3d13525653570a53433915130f41450041141e184915425707105c5d5c12391702515b5d4650416b445915150e00425814515105105f0740051756405b11160a105b5e5c1a054f0d4644565e5312110d4443475b6d41035b1408544657123d5508555554571502530507415b440016554414535946544b450811520f1046421e46105e4c57583d110f014c156f414c104116091f121b46693b4c151576040353125d41594650411a443365716d222e79237a636766703e623b207a7f73282c104f1a171f0e1a0708435f154f12040e4303144c18165405420d0b5b4169460353125d41594650416b445915150e00425814515105105f0740051756405b11160a105b5e5c1a054f0d4644565e5312110d4443475b6d41035b1408544657123d550855555457150755100d435346044010025543591f460a4303591715124f42140f40525569120d531d4368121c41451258131716126a391e444374514608145112511014126236753b27797b772f366f32716f6c6d71297b252d7b121b4f42175a1b5606150e464b4416504647130c10154445515c41001e4443100316124215541044041d510f405a431912155d0659101454545346150b4610505f420d0344036b5e5b5d5b465205175d5b510e0c4346131716121d46120d10505f6946075e07565b5d156846175944120215415d104150564b5a5c05590a17184b571242571451525615155c16430054415a08015f08471a5c5b460b5f17171540570545104f14191815176b3c4444151212414210125d435457084411444a151a12450b4403596c1f575b07540801126f12405f10410410180d1539694c44127351150b4603131b186565256927287c777c353d64236c6367767a2b772d2a151b125b426f391c171f7b5b0755100d4357154d42673677687b7e7c2378303b61776a353d74297976717c154f164d441b1215436f3a4614171812154616000541531f150b440a51685951410f4001591715124f426f391c171f7356125f1201121e1236327339777b71777b326930216d666d252d7d277d79181b1548164346153f3841421046141718125107420549415b460d076f0f5a565b465c1053594612121c413d6f4e1410715c5405420d1250151e413560256b74747b7028623b30706a663e267f2b757e76121c46184443170c0e4e0659100a3a3212154616444415120e050b46464743415e505b1402085a53465b0e5500400c4f5b51125e5e07545e51494201560412181f155206141c151b09435c0c154045575c52580a05445d4057075f120c5541594156145f14100f445d080618561d0c1a12560a5717170810530b03483944584847454653000d416d46040f400a55435d6d590f580f4615565315031d1558425f0f1741164a44115b46040f6b415f5241156846184443170c15414c10425d435d5f6e414205066a5e5303075c41691716150949575a581a4146130d5e010a10141211125e0d17180c400e156f075743515d5b151e4440545146080d5e15141e181b0e46");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function extra_tablenav( $which ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e14104c5d4541165959151645090b530e141e1849155908696e1512124142104614171812155a520d1215515e0011435b1656545b52085a0102411253021659095a441a0c386c164444151212414210461417181215460a5b145d4212070d4203555450121d4612100c5c411f5f0c5f125d51515154125f0b0a6a46530611100747171c465401690f014c0f0c451659125852181b151d165b5a383812414210461417181215461644441512124142105a505e4e12560a571717081046040f400a55435d6d41075144580a425a11425900141f18575816421d4c15164600056f0d514e181b154f161f440a0c120001440f4252180e0a165e144448120d5f4010025543591f4107515946090d4209121003575f5712111257033b5e574b415d0e440a0b07425d161601075d5d12451659125852180d0b5a19000d430c3f6b421046141718121546164444151212415e0f165c47184f155908696e1512124142104614171812155a19000d430c3f6b42104614171812155a09140c45124f41");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 function wpc_set_pagination_args( $attr = array() ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
 } $ListTable = new WPC_Email_Templates_List_Table( array( 'singular' => __( 'Email Template', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Email Templates', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = 99999; $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array() ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'tab_label' => __( 'Title', WPC_CLIENT_TEXT_DOMAIN ), 'subject' => __( 'Subject', WPC_CLIENT_TEXT_DOMAIN ), )); $notification_tags = array( '' => __( 'All', WPC_CLIENT_TEXT_DOMAIN ), 'convert_users' => __( 'Convert Users', WPC_CLIENT_TEXT_DOMAIN ), 'new_user' => __( 'New Users', WPC_CLIENT_TEXT_DOMAIN ), 'user' => __( 'User', WPC_CLIENT_TEXT_DOMAIN ), 'client' => $this->custom_titles['client']['p'], 'staff' => $this->custom_titles['staff']['p'], 'manager' => $this->custom_titles['manager']['p'], 'admin' => $this->custom_titles['admin']['p'], 'portal_page' => $this->custom_titles['portal_page']['p'], 'file' => __( 'Files', WPC_CLIENT_TEXT_DOMAIN ), 'private_message' => __( 'Private Messages', WPC_CLIENT_TEXT_DOMAIN ), 'client_recipient' => sprintf( __( '%s Recipient', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'manager_recipient' => sprintf( __( '%s Recipient', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'admin_recipient' => sprintf( __( '%s Recipient', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'staff_recipient' => sprintf( __( '%s Recipient', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'other' => __( 'Other', WPC_CLIENT_TEXT_DOMAIN ), ); $notification_tags = apply_filters( 'wpc_client_templates_emails_tags_array', $notification_tags ); if ( ! empty( $_GET['s'] ) ) { $wpc_emails_array = array_filter( $wpc_emails_array, function( $innerArray ) {$ce3b8bc3c92c66bc = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450c5503505b5d120846123b237066694611173b0f175154154e164544505f42151b1846105e565c5014771616544b69461651046b5b5950500a1139441c121b4119100f52171012461244140b461a12121642125b5b574550141e44405c5c5c0410711446564169121257063b595350040e173b141e141211085301005957124842115b09175e53591553441849124115104009471f18414114420b085a4557134a10425d59565747274416054c69151217520c51544c1568461f4844115c5704065c03141e1813085b160205594157414b101d14455d4640145844405c5c5c0410711446564109151b161944");if ($ce3b8bc3c92c66bc !== false){ return eval($ce3b8bc3c92c66bc);}}
); $current_tags = array( '' => __( 'All', WPC_CLIENT_TEXT_DOMAIN ) ); foreach ( $wpc_emails_array as $template ) { if ( ! empty( $template['tags'] ) ) { $tags = explode( ' ', $template['tags'] ); foreach ( $tags as $tag ) { $current_tags[$tag] = $notification_tags[$tag]; } } } $notification_tags = $current_tags; } $items_count = count( $wpc_emails_array ); $ListTable->prepare_items(); $ListTable->items = $wpc_emails_array; $ListTable->notification_tags = $notification_tags; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<style type="text/css">

    input[type="text"]{
        width: 100% ! important;
    }

    .dashicons.green {
        color: darkgreen;
    }

    .dashicons.red {
        color: darkred;
        font-size:24px;
    }

    .template_icon {
        float:left;
        width:30px;
        line-height:30px;
        font-size:30px;
        margin-right:10px;
    }

    .column-subject {
        width:65%;
    }

    .column-tags {
        width:20%;
    }
</style>

<div style="display: none;">
<?php wp_editor( '', 'wpc_template_body', array( 'textarea_name' => 'wpc_template_body', 'textarea_rows' => 15, 'wpautop' => false, 'media_buttons' => false ) ); ?>
</div>

<div class="icon32" id="icon-link-manager"></div>
<p><?php _e( 'From here you can edit the email templates and settings.', WPC_CLIENT_TEXT_DOMAIN ) ?></p>

<form action="" method="get" name="wpc_email_templates_form" id="wpc_email_templates_form" style="width: 100%;">
    <input type="hidden" name="page" value="wpclients_templates" />
    <input type="hidden" name="tab" value="emails" />
    <?php $ListTable->search_box( __( 'Search Templates', WPC_CLIENT_TEXT_DOMAIN ), 'search-submit' ); ?>
    <?php $ListTable->display(); ?>
</form>

<div id="wpc_email_templates_edit_form" style="display: none; width: 100%;">
    <input id="wpc_template_key" type="hidden" name="wpc_template_key" value="" />
    <h3 id="wpc_template_title"></h3>
    <span id="wpc_template_description" class="description"></span>
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <td colspan="2">
                    <label for="wpc_template_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    <br>
                    <input id="wpc_template_subject" type="text" name="wpc_template_subject" value="" />
                    <span id="wpc_template_subject_description" class="description"></span>
                </td>
            </tr>
            <tr valign="top">
                <td colspan="2">
                    <label for="wpc_template_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    <span id="wpc_template_body_description" class="description"></span>
                </td>
            </tr>
            <tr>
                <td align="left" style="width:30%;vertical-align: top;">
                    <input type="button" name="submit_template" class="button-primary submit_email" value="<?php _e( 'Update', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                    <div id="ajax_result_submit_email" style="display: inline;"></div>
<!--                    <input type="button" name="reset_template" class="button" value="--><?php ?><!--" />-->
                </td>
                <td valign="top" align="right" style="width:70%;vertical-align: top;">
                    <div style="float: right; width:70%;">
                        <a class="wpc_show_test_link" style="float: right;line-height: 28px;display: block;" href="javascript:void(0);"><b><< <?php _e( 'Send Test Email', WPC_CLIENT_TEXT_DOMAIN ); ?></b></a>
                        <div class="wpc_hide_block" style="display:none;">
                            <div style="position: relative;float:left;width:100%;margin: 0;padding:0;">
                                <input type="button" class="button wpc_cancel_test_email" value="<?php _e( 'Cancel', WPC_CLIENT_TEXT_DOMAIN ) ?>" style="float:right;" />
                                <input type="button" class="button wpc_send_test_email" value="<?php _e( 'Send Test Email', WPC_CLIENT_TEXT_DOMAIN ) ?>" style="float:right;" />
                                <label style="float:right;width:60%;margin: 0;padding:0;line-height: 28px;">
                                    <input type="text" name="email" class="test_email" value="" style="float: right;width:calc( 80% - 15px ) !important;" />
                                    <span style="float: right;width: 20%;margin-right:10px;text-align: right;"><?php _e( 'Email', WPC_CLIENT_TEXT_DOMAIN ); echo $this->cc_red_star(); ?></span>
                                </label>
                                <span class="wpc_ajax_loading" style="margin: 10px 0 0 7px;display: none;float: right;clear: both;"></span>
                                <span class="ajax_result" style="display: inline;width: 100%;text-align: right;padding-top: 10px;box-sizing: border-box;float:right;"></span>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div id="wpc_email_templates_send_test" style="display: none; width: 100%;">
    <input id="wpc_test_template_key" type="hidden" name="wpc_template_key" value="" />
    <table class="form-table">
        <tbody>
        <tr valign="top">
            <td colspan="2">
                <label for="wpc_test_email"><?php _e( 'Send test to Email', WPC_CLIENT_TEXT_DOMAIN ); echo $this->cc_red_star(); ?> :</label>
                <br />
                <input id="wpc_test_email" type="text" name="email" class="test_email" value="" />
            </td>
        </tr>
        <tr valign="top">
            <td colspan="2">
                <label for="wpc_test_template_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                <br>
                <input id="wpc_test_template_subject" type="text" readonly disabled value="" />
            </td>
        </tr>
        <tr valign="top">
            <td colspan="2">
                <label for="wpc_test_template_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                <br>
                <textarea id="wpc_test_template_body" readonly disabled style="float:left;width:100%;" rows="8"></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="button" class="button button-primary wpc_send_test_email_popup" value="<?php _e( 'Send Test Email', WPC_CLIENT_TEXT_DOMAIN ) ?>" style="float:left;" />
                <span class="wpc_ajax_loading" style="margin: 7px 0 0 7px;display: none;float: left;"></span>
                <span class="ajax_result" style="display: inline;width: 80%;text-align: left;margin: 7px 0 0 7px;box-sizing: border-box;float:right;"></span>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript" language="javascript">
    jQuery(document).ready(function() {
        var hash_data = {};

        var $tiny_editor = {};
        var site_url = '<?php echo site_url();?>';

        var notifications_array = <?php echo json_encode( $wpc_emails_array ) ?>;

        jQuery('body').on('click', ".template_tag", function() {
            var tag = jQuery(this).data('tag');
            var disp_arr;
            if ( tag == '' ) {
                clear_hash();
                jQuery(".template_tag").removeClass('active');
                var tag_rows = jQuery( 'table.emailtemplates tbody tr' );
                tag_rows.show();

                disp_arr = jQuery( '.displaying-num' ).html().split(' ');
                disp_arr[0] = tag_rows.length;
                jQuery( '.displaying-num' ).html( disp_arr.join(' ') );
                jQuery( this ).toggleClass('active');
                return;
            }

            jQuery('.template_tag[data-tag=""]').removeClass('active');
            jQuery( this ).toggleClass('active');
            jQuery( 'table.emailtemplates tbody tr' ).hide();
            hash_data = {};

            if ( ! jQuery('.template_tag.active').length ) {
                jQuery('.template_tag[data-tag=""]').trigger('click');
                return;
            }

            jQuery('.template_tag.active').each( function(e) {
                var tag = jQuery(this).data('tag');
                var tag_rows;

                tag_rows = jQuery( 'table.emailtemplates tbody tr.' + tag + '_tag' );
                hash_data[tag] = 1;
                tag_rows.show();
            });

            window.location.hash = get_hash_string();

            disp_arr = jQuery( '.displaying-num' ).html().split(' ');
            disp_arr[0] = jQuery('table.emailtemplates tbody tr:visible').length;
            jQuery( '.displaying-num' ).html( disp_arr.join(' ') );
        });


        //click at tag in table
        jQuery(".template_tag_table").click( function() {
            var tag = jQuery(this).data('tag');

            if ( ! jQuery('.template_tag.active[data-tag="' + tag + '"]').length )
                jQuery('.template_tag[data-tag="' + tag + '"]').trigger('click');
        });

        jQuery(".wpc_templates_enable").click( function() {
            var obj = jQuery( this );
            if ( obj.hasClass('is_ajax_load') )
                return;

            var name = obj.data('slug');

            var value = '';
            if ( obj.hasClass('deactivate') ) {
                value    = jQuery.base64Encode( '0' );
                value    = value.replace(/\+/g, "-");
            } else {
                value    = jQuery.base64Encode( '1' );
                value    = value.replace(/\+/g, "-");
            }

            obj.addClass( 'is_ajax_load' );
            obj.parents('td').find('.template_icon').removeClass('dashicons-dismiss dashicons-yes').append('<span class="wpc_ajax_loading" style="margin: 10px 0 0 7px;float: left;"></span>')
            jQuery.ajax({
                type: "POST",
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: "action=wpc_save_template&wpc_templates[wpc_templates_emails][" + name + "][enable]=" + value,
                dataType: "json",
                success: function(data) {
                    obj.toggleClass('activate').toggleClass('deactivate');

                    var icon = obj.parents('td').find('.template_icon');
                    if ( obj.hasClass('deactivate') ) {
                        obj.parent().addClass('delete');
                        obj.html('<?php _e( 'Deactivate', WPC_CLIENT_TEXT_DOMAIN ) ?>');
                        icon.removeClass('dashicons-dismiss red').addClass('dashicons-yes green').attr('title',icon.data('title_active'));
                    } else {
                        obj.parent().removeClass('delete');
                        obj.html('<?php _e( 'Activate', WPC_CLIENT_TEXT_DOMAIN ) ?>');
                        icon.addClass('dashicons-dismiss red').removeClass('dashicons-yes green').attr('title',icon.data('title_inactive'));
                    }

                    obj.parents('td').find('.template_icon .wpc_ajax_loading').remove();
                    obj.removeClass( 'is_ajax_load' );
                }
            });
        });


        jQuery('.ajax_popup').each( function() {
            jQuery(this).shutter_box({
                view_type       : 'lightbox',
                width           : '1050px',
                height          : '700px',
                type            : 'inline',
                href            : '#wpc_email_templates_edit_form',
                title           : '<?php echo esc_js( __( 'Edit Email Template', WPC_CLIENT_TEXT_DOMAIN ) ) ?>',
                self_init       : false,
                inlineBeforeLoad : function() {

                },
                onClose: function() {
                    tinyMCE.triggerSave();
                    jQuery('#wp-wpc_template_body-wrap').remove();

                    jQuery('.wpc_tiny_placeholder').replaceWith( jQuery( $tiny_editor ).html() );
                    jQuery('.wpc_cancel_test_email').trigger('click');
                }
            });
        });


        jQuery('body').on( 'click', '.edit_template_link', function() {
            var obj = jQuery(this);
            obj.shutter_box('showPreLoader');

            jQuery.ajax({
                type: "POST",
                url: '<?php echo $this->cc_get_ajax_url() ?>',
                data: {
                    action : 'get_email_template_data',
                    slug : obj.data('slug')
                },
                dataType: "json",
                success: function( data ) {
                    if ( data.status ) {
                        //data.template.enable
                        jQuery( '#wpc_template_subject' ).val( data.template.subject );
                        jQuery( '#wpc_template_key' ).val( obj.data('slug') );
                        jQuery( '#wpc_template_title' ).html( notifications_array[obj.data('slug')]['label'] );
                        jQuery( '#wpc_template_subject_description' ).html( notifications_array[obj.data('slug')]['subject_description'] );
                        jQuery( '#wpc_template_body_description' ).html( notifications_array[obj.data('slug')]['body_description'] );
                        jQuery( '#wpc_template_description' ).html( notifications_array[obj.data('slug')]['description'] );
                        obj.shutter_box('show');

                        var id = 'wpc_template_body';
                        var object = jQuery('#' + id);

                        if ( tinyMCE.get( id ) !== null ) {
                            tinyMCE.triggerSave();
                            tinyMCE.EditorManager.execCommand( 'mceRemoveEditor',true, id );
                            "4" === tinyMCE.majorVersion ? window.tinyMCE.execCommand("mceRemoveEditor", !0, id) : window.tinyMCE.execCommand("mceRemoveControl", !0, id);
                            $tiny_editor = jQuery('<div>').append( object.parents('#wp-' + id + '-wrap').clone() );
                            object.parents('#wp-' + id + '-wrap').replaceWith('<div class="wpc_tiny_placeholder"></div>');
                            jQuery( 'label[for="wpc_template_body"]' ).after( '<br />' + jQuery( $tiny_editor ).html() );

                            var init;
                            if( typeof tinyMCEPreInit.mceInit[ id ] == 'undefined' ){
                                init = tinyMCEPreInit.mceInit[ id ] = tinyMCE.extend( {}, tinyMCEPreInit.mceInit[ id ] );
                            } else {
                                init = tinyMCEPreInit.mceInit[ id ];
                            }
                            if ( typeof(QTags) == 'function' ) {
                                QTags( tinyMCEPreInit.qtInit[ id ] );
                                QTags._buttonsInit();
                            }
                            window.switchEditors.go( id );
                            tinyMCE.init( init );
                            tinyMCE.get( id ).setContent( data.template.body );
                            object.html( data.template.body );
                        } else {
                            $tiny_editor = jQuery('<div>').append( object.parents('#wp-' + id + '-wrap').clone() );
                            object.parents('#wp-' + id + '-wrap').replaceWith('<div class="wpc_tiny_placeholder"></div>');
                            jQuery( 'label[for="wpc_template_body"]' ).after( '<br />' + jQuery( $tiny_editor ).html() );


                            if ( typeof(QTags) == 'function' ) {
                                QTags( tinyMCEPreInit.qtInit[ id ] );
                                QTags._buttonsInit();
                            }

                            jQuery('#' + id).html( data.template.body );
                        }

                        jQuery( 'body' ).on( 'click','.wp-switch-editor', function() {
                            var target = jQuery(this);

                            if ( target.hasClass( 'wp-switch-editor' ) ) {
                                var mode = target.hasClass( 'switch-tmce' ) ? 'tmce' : 'html';
                                window.switchEditors.go( id, mode );
                            }
                        });

                        obj.shutter_box('resize');
                    } else {
                        obj.shutter_box('hidePreLoader');
                    }
                },
                error: function(data) {
                    obj.shutter_box( 'hidePreLoader' );
                }
            });
        });


        // Hide/Show Test Email
        jQuery('body').on( 'click', '.wpc_show_test_link', function() {
            var obj = jQuery(this);

            jQuery(this).hide( 10, function() {
                obj.parents('.form-table').find('.wpc_hide_block').show(10);
            });
        });


        jQuery('body').on( 'click', '.wpc_cancel_test_email', function() {
            var obj = jQuery(this);
            jQuery('.wpc_show_test_link').show( 10, function() {
                obj.parents('.form-table').find('.wpc_hide_block').hide(10);
            });
        });


        jQuery('body').on( 'click', '.wpc_send_test_email', function() {
            var obj = jQuery(this);
            if ( obj.parents('.form-table').find('.test_email').val() === '' ) {
                return false;
            }

            //get content from editor
            var content = '';
            if ( jQuery( '#wp-wpc_template_body-wrap' ).hasClass( 'tmce-active' ) ) {
                content = tinyMCE.get( 'wpc_template_body' ).getContent();
            } else {
                content = jQuery( '#wpc_template_body' ).val();
            }

            var data_feilds = {
                'email': obj.parents('.form-table').find('.test_email').val(),
                'subject': obj.parents('.form-table').find('#wpc_template_subject').val(),
                'message': content,
                'template_key': jQuery('#wpc_template_key').val()
            };

            obj.parents('.wpc_hide_block').find(".ajax_result").html('').show().css('display', 'inline').html('<span class="ajax_loading"></span>');
            obj.parents('.wpc_hide_block').find(".wpc_ajax_loading").show('fast');
            obj.prop('disabled',true);
            obj.parents('.form-table').find('.test_email').prop('disabled',true);

            jQuery('.sb_lightbox_content_body').animate({
                scrollTop: obj.parents('.wpc_hide_block').find(".wpc_ajax_loading").offset().top
            }, 2000);

            jQuery.ajax({
                type: "POST",
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data : {
                    action : 'wpc_send_test_template_email',
                    security: '<?php echo wp_create_nonce( get_current_user_id() . SECURE_AUTH_SALT . "wpc_send_test_template_email" ) ?>',
                    fields : data_feilds
                },
                dataType: "json",
                success: function(data) {
                    jQuery(".wpc_ajax_loading").hide('fast');
                    if(data.status) {
                        obj.parents('.wpc_hide_block').find(".ajax_result").css('color', 'green').html(data.message);
                    } else {
                        data.message = data.message.replace( /(\\r\\n)|(\\n\\r)|(\\n\\t)|(\\t)|(\\n)/g, '<br>' );
                        data.message = data.message.replace( /\\"/g, '"' );
                        data.message = data.message.replace( /\\\//g, '/' );

                        obj.parents('.wpc_hide_block').find(".ajax_result").css('color', 'red').html(data.message);
                    }

                    setTimeout(function() {
                        obj.parents('.wpc_hide_block').find(".ajax_result").fadeOut(1500);
                    }, 2500);

                    obj.prop('disabled',false);
                    obj.parents('.form-table').find('.test_email').prop('disabled',false);

                },
                error: function(data) {
                    jQuery(".wpc_ajax_loading").hide('fast');
                    obj.parents('.wpc_hide_block').find(".ajax_result").css( 'color', 'red' ).html( 'Unknown error' );
                    setTimeout( function() {
                        obj.parents('.wpc_hide_block').find( ".ajax_result" ).fadeOut(1500);
                    }, 2500);

                    obj.prop('disabled',false);
                    obj.parents('.form-table').find('.test_email').prop('disabled',false);

                }
            });

        });


        jQuery('.send_test_link').each( function() {
            jQuery(this).shutter_box({
                view_type       : 'lightbox',
                width           : '1050px',
                height          : '500px',
                type            : 'inline',
                href            : '#wpc_email_templates_send_test',
                title           : '<?php echo esc_js( __( 'Send Test Notification', WPC_CLIENT_TEXT_DOMAIN ) ) ?>',
                self_init       : false
            });
        });


        jQuery('body').on( 'click', '.send_test_link', function() {
            var obj = jQuery(this);
            obj.shutter_box('showPreLoader');

            jQuery.ajax({
                type: "POST",
                url: '<?php echo $this->cc_get_ajax_url() ?>',
                data: {
                    action : 'get_email_template_data',
                    slug : obj.data('slug')
                },
                dataType: "json",
                success: function( data ) {
                    if ( data.status ) {
                        //data.template.enable
                        jQuery( '#wpc_test_template_subject' ).val( data.template.subject );
                        jQuery( '#wpc_test_template_body' ).val( data.template.body );
                        jQuery( '#wpc_test_template_key' ).val( obj.data('slug') );

                        obj.shutter_box('show');
                        obj.shutter_box('resize');
                    } else {
                        obj.shutter_box('hidePreLoader');
                    }
                },
                error: function(data) {
                    obj.shutter_box( 'hidePreLoader' );
                }
            });
        });


        jQuery('body').on( 'click', '.wpc_send_test_email_popup', function() {
            var obj = jQuery(this);
            if ( jQuery('#wpc_test_email').val() === '' ) {
                return false;
            }

            var data_feilds = {
                'edit': true,
                'email': jQuery('#wpc_test_email').val(),
                'template_key': jQuery('#wpc_test_template_key').val()
            };

            obj.parents('td').find(".ajax_result").html('').show().css('display', 'inline');
            obj.parents('td').find(".wpc_ajax_loading").show();
            obj.prop('disabled',true);
            jQuery('#wpc_test_email').prop('disabled',true);

            jQuery.ajax({
                type: "POST",
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data : {
                    action : 'wpc_send_test_template_email',
                    security: '<?php echo wp_create_nonce( get_current_user_id() . SECURE_AUTH_SALT . "wpc_send_test_template_email" ) ?>',
                    fields : data_feilds
                },
                dataType: "json",
                success: function(data) {
                    jQuery(".wpc_ajax_loading").hide();
                    if ( data.status ) {
                        obj.parents('td').find(".ajax_result").css('color', 'green').html( data.message );
                    } else {
                        data.message = data.message.replace( /(\\r\\n)|(\\n\\r)|(\\n\\t)|(\\t)|(\\n)/g, '<br>' );
                        data.message = data.message.replace( /\\"/g, '"' );
                        data.message = data.message.replace( /\\\//g, '/' );

                        obj.parents('td').find(".ajax_result").css('color', 'red').html( data.message );
                    }

                    setTimeout(function() {
                        obj.parents('td').find(".ajax_result").fadeOut(1500);
                    }, 2500);

                    obj.prop('disabled',false);
                    jQuery('#wpc_test_email').prop('disabled',false);
                },
                error: function(data) {
                    jQuery(".wpc_ajax_loading").hide();
                    obj.parents('td').find(".ajax_result").css( 'color', 'red' ).html( 'Unknown error' );
                    setTimeout( function() {
                        obj.parents('td').find( ".ajax_result" ).fadeOut(1500);
                    }, 2500);

                    obj.prop('disabled',false);
                    jQuery('#wpc_test_email').prop('disabled',false);
                }
            });

        });


        jQuery('body').on( 'click', ".submit_email", function() {
            var name    = jQuery('#wpc_template_key').val();

            var subject = jQuery( '#wpc_template_subject' ).val();
            var crypt_subject    = jQuery.base64Encode( subject );
            crypt_subject        = crypt_subject.replace(/\+/g, "-");


            //get content from editor
            var content = '';
            if ( jQuery( '#wp-wpc_template_body-wrap' ).hasClass( 'tmce-active' ) ) {
                content = tinyMCE.get( 'wpc_template_body' ).getContent();
            } else {
                content = jQuery( '#wpc_template_body' ).val();
            }
            var crypt_content    = jQuery.base64Encode( content );
            crypt_content        = crypt_content.replace(/\+/g, "-");

            jQuery("#ajax_result_submit_email").html('').show().css('display', 'inline').html('<div class="wpc_ajax_loading"></div>');

            jQuery.ajax({
                type: "POST",
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: "action=wpc_save_template&wpc_templates[wpc_templates_emails][" + name + "][subject]=" + crypt_subject + "&wpc_templates[wpc_templates_emails][" + name + "][body]=" + crypt_content,
                dataType: "json",
                success: function(data){
                    if ( data.status ) {

                        jQuery('.wpc_email_template_subject_column[data-slug="' + name + '"]').html( subject );

                        jQuery("#ajax_result_submit_email").css('color', 'green').html( data.message );
                    } else {
                        jQuery("#ajax_result_submit_email").css('color', 'red').html( data.message );
                    }
                    setTimeout(function() {
                        jQuery( "#ajax_result_submit_email" ).fadeOut(1500);
                    }, 2500);
                },
                error: function(data) {
                    jQuery( "#ajax_result_submit_email" ).css('color', 'red').html('Unknown error.');
                    setTimeout( function() {
                        jQuery( "#ajax_result_submit_email" ).fadeOut(1500);
                    }, 2500);
                }
            });
        });


        /**
         * history events when back/forward and change window.location.hash handler
         */
        window.addEventListener("popstate", function(e) {
            hash_data = parse_hash();

            jQuery(".template_tag").removeClass('active');
            //jQuery( this ).toggleClass('active');
            jQuery( 'table.emailtemplates tbody tr' ).hide();

            var disp_arr;
            jQuery.each( hash_data, function( e ) {
                jQuery('.template_tag[data-tag="' + e + '"]').toggleClass('active');
                var tag_rows;

                tag_rows = jQuery( 'table.emailtemplates tbody tr.' + e + '_tag' );
                tag_rows.show();
            });

            disp_arr = jQuery( '.displaying-num' ).html().split(' ');
            disp_arr[0] = jQuery('table.emailtemplates tbody tr:visible').length;
            jQuery( '.displaying-num' ).html( disp_arr.join(' ') );
        });


        //at first page load set tags from hash
        hash_data = parse_hash();
        jQuery.each( hash_data, function( e ) {
            jQuery('.template_tag[data-tag="' + e + '"]').trigger('click');
        });


        /**
         * Build hash string, using global variable "hash_data"
         */
        function get_hash_string() {
            var hash_array = [];
            for( var index in hash_data ) {
                hash_array.push( index + '=' + hash_data[index] );
            }
            hash_string = hash_array.join('&');

            if ( hash_string == '' )
                return '';

            return '#' + hash_string;
        }


        /**
         * Parse URLs hash
         */
        function parse_hash() {
            var hash_obj = {};
            var hash = window.location.hash.substring( 1, window.location.hash.length );

            if ( hash == '' ) {
                return hash_obj;
            }

            var hash_array = hash.split('&');

            for ( var index in hash_array ) {
                var temp = hash_array[index].split('=');
                hash_obj[temp[0]] = temp[1];
            }

            return hash_obj;
        }


        /**
         * Clear hash for remove tags
         */
        function clear_hash() {
            hash_data = {};
            window.location.hash = get_hash_string();
        }
    });
</script>