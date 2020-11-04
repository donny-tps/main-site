<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } global $wpdb, $wp_roles; $rul_process_submit = ''; $rul_process_submit2 = ''; $rul_process_submit3 = ''; $rul_process_submit4 = ''; if ( !function_exists( 'wpc_client_rul_safe_redirect' ) ) { function wpc_client_rul_safe_redirect( $location ) {$c5df3b82ada7d4fd = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b181647135a3b085a51530d3d5f08584e03125c001e4456150f0f414642135868545d56075a3b0b5b5e4b411e4c460517050f15424411086a5e5d02035c395b59544b154f161f4447574614105e46105b575154125f0b0a0e124f41465c0957564c5b5a0816594442426d12035e0f405e42576a1453000d475751154a140a5b5459465c09584d5f155b54414a101541554b46474e12080b565346080d5e4a14071412074f16595915151d4e45104f144c181659095505105c5d5c415f10415c434c420f41164a44115e5d0203440f5b59031248461210014646125c42184610544d46155b16171047425d124a140a5b5459465c09584844120d15484219460b174b47571542164c15165e0e0151125d58561e15561a4440564746414b105c1413545d5607420d0b5b0912450e4046091748534715533b11475e1a45165515401e03121111461444081242001043036b424a5e1d0153103b5d5d5f043d4514581f111b0e46120508595d4504066f0e5b444c41155b164c05474053184b10074447544b6a005f08105040414945510a58584f5751394401005c405702166f0e5b444c41124a16051647534b49464716446c1f5a5a154243391c1e1208114303401f1c5e453d110c0b4646153c4b1059141354426e415e0b1741156f41581041131e03125c00164c445c414104161842584763155d09451043681b124744104e1416515c6a074416054c1a160d126b415c584b46123b1a4440545e5e0e1555026b5f574141151f44421312160d126b415c584b46123b16455915414613165f0a5b405d401d424114146e155a0e114441691e11121c464d4416504647130c1000555b4b570e464b44015941574119101451434d405b4612080b565346080d5e5d144a18");if ($c5df3b82ada7d4fd !== false){ return eval($c5df3b82ada7d4fd);}}
 } $circles_names = array(); $all_circles = $wpdb->get_results( "SELECT group_id as id, group_name as name FROM {$wpdb->prefix}wpc_client_groups", ARRAY_A ); foreach( $all_circles as $circle ) { $circles_names[$circle['id']] = $circle['name']; } if ( isset( $_POST['update_settings'] ) ) { if ( isset( $_POST['update_all'] ) ) { $wpc_default_redirects = array(); $wpc_default_redirects['first_login'] = ( isset( $_POST['wpc_default_first_login_redirect'] ) && !empty( $_POST['wpc_default_first_login_redirect'] ) ) ? trim( $_POST['wpc_default_first_login_redirect'] ) : ''; $wpc_default_redirects['login'] = ( isset( $_POST['wpc_default_login_redirect'] ) && !empty( $_POST['wpc_default_login_redirect'] ) ) ? trim( $_POST['wpc_default_login_redirect'] ) : ''; $wpc_default_redirects['logout'] = ( isset( $_POST['wpc_default_logout_redirect'] ) && !empty( $_POST['wpc_default_logout_redirect'] ) ) ? trim( $_POST['wpc_default_logout_redirect'] ) : ''; do_action( 'wp_client_settings_update', $wpc_default_redirects, 'default_redirects' ); $this->redirect( $this->settings()->get_current_setting_url() . '&msg=u' ); } elseif ( isset( $_POST['update_roles'] ) ) { $roles = $_POST['rul_role']; $first_addresses = $_POST['rul_first_roleaddress']; $addresses = $_POST['rul_roleaddress']; $logout = $_POST['rul_logout_roleaddress']; $rul_order = 0; $rul_whitespace = '        '; $rul_process_submit2 = '<div id="message" class="updated wpc_notice fade">' . "\n"; $rul_process_close = $rul_whitespace . '</div>' . "\n"; if( $roles && ( $addresses || $first_addresses || $logout ) ) { $rul_submit_success = true; $rul_roles_updated = array(); $rul_role_keys = array_keys($roles); $rul_role_loop = 0; $rul_existing_rolenames = array(); foreach( array_keys( $wp_roles->role_names ) as $role ) { $rul_existing_rolenames[$role] = $role; } $wpdb->query( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_type = 'role'" ); foreach( $roles as $role ) { $i = $rul_role_keys[$rul_role_loop]; if ( isset( $rul_existing_rolenames[$role] ) ) { $first_address = ( isset( $first_addresses[$i] ) ) ? wpc_client_rul_safe_redirect( $first_addresses[$i] ) : ''; $address = ( isset( $addresses[$i] ) ) ? wpc_client_rul_safe_redirect( $addresses[$i] ) : ''; $lgt = ( isset( $logout[$i] ) ) ? wpc_client_rul_safe_redirect( $logout[$i] ) : ''; $rul_ord = ( isset( $rul_order[$i] ) ) ? $rul_order[$i] : 0; if (!$first_addresses && !$address && !$lgt) { $rul_submit_success = false; $rul_process_submit2 .= '<p><strong>****' .__('ERROR: Non-local or invalid URL submitted for role ',WPC_CLIENT_TEXT_DOMAIN) . $role . '****</strong></p>' . "\n"; } else { $sql = "INSERT INTO {$wpdb->prefix}wpc_client_login_redirects SET rul_first_url = '%s', rul_url = '%s', rul_type = 'role', rul_value = '%s', rul_url_logout='%s', rul_order='%s' "; $rul_update_role = $wpdb->query( $wpdb->prepare( $sql, $first_address, $address, $role, $lgt, $rul_ord ) ); if (!$rul_update_role) { $rul_submit_success = false; $rul_process_submit2 .= '<p><strong>' .__('ERROR:',WPC_CLIENT_TEXT_DOMAIN) . $wpdb->last_error . '</strong></p>' . "\n"; } } $rul_roles_updated[] = $role; } elseif ($role != -1) { $rul_submit_success = false; $rul_process_submit2 .= '<p><strong>****' .__('ERROR: Non-existent role submitted ',WPC_CLIENT_TEXT_DOMAIN) .'****</strong></p>' . "\n"; } ++$rul_role_loop; } $rul_roles_notin = "'" . implode( "','", $rul_roles_updated ) . "'"; $wpdb->query( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_type = 'role' AND rul_value NOT IN ( {$rul_roles_notin} )" ); if ($rul_submit_success) { $this->redirect( $this->settings()->get_current_setting_url() . '&msg=u#wpc_roles' ); } } $rul_process_submit2 .= $rul_process_close; } elseif ( isset( $_POST['update_circles'] ) ) { $rul_submit_success = true; $new_circles = ''; $circles = $login = $logout = $order = array(); $rul_existing_circle_ids = $wpdb->get_col( "SELECT group_id FROM {$wpdb->prefix}wpc_client_groups" ); $rul_whitespace = '        '; $rul_process_submit3 = '<div id="message" class="updated wpc_notice fade">' . "\n"; $rul_process_close = $rul_whitespace . '</div>' . "\n"; if( isset( $_POST['rul_circle'] ) ) { $circles = $_POST['rul_circle']; $first_addressin = $_POST['rul_circle_first_address']; $addressin = $_POST['rul_circle_address']; $addressout = $_POST['rul_logout_circle_address']; $rul_order = $_POST['rul_order']; } if ( isset( $_POST['wpc_circles'] ) && '' != $_POST['wpc_circles'] ) { $new_circles = explode( ',', $_POST['wpc_circles'] ); foreach ( $new_circles as $new_circle ) { $circles[] = $new_circle; $first_addressin[] = $_POST['wpc_circle_first_address']; $addressin[] = $_POST['wpc_circle_address']; $addressout[] = $_POST['wpc_logout_circle_address']; $rul_order[] = (int) $_POST['wpc_order']; } } $rul_circles_updated = array(); $wpdb->query( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_type = 'circle'" ); foreach( $circles as $key => $circle ) { if ( in_array( $circle, $rul_existing_circle_ids ) ) { $first_address = ( isset( $first_addressin[$key] ) ) ? wpc_client_rul_safe_redirect( $first_addressin[$key] ) : ''; $address = ( isset( $addressin[$key] ) ) ? wpc_client_rul_safe_redirect( $addressin[$key] ) : ''; $lgt = ( isset( $addressout[$key] ) ) ? wpc_client_rul_safe_redirect( $addressout[$key] ) : ''; $rul_ord = ( isset( $rul_order[$key] ) ) ? $rul_order[$key] : 0; $circle_name = $circles_names[$circle]; if (!$first_address && !$address && !$lgt) { $rul_submit_success = false; $rul_process_submit3 .= '<p><strong>****' .__('ERROR: Non-local or invalid URL submitted for circle ',WPC_CLIENT_TEXT_DOMAIN) . $circle_name . '****</strong></p>' . "\n"; } else { $sql = "INSERT INTO {$wpdb->prefix}wpc_client_login_redirects SET rul_first_url = '%s', rul_url = '%s', rul_type = 'circle', rul_value = '%s', rul_url_logout='%s', rul_order='%s' "; $rul_update_circle = $wpdb->query( $wpdb->prepare( $sql, $first_address, $address, $circle, $lgt, $rul_ord ) ); if (!$rul_update_circle) { $rul_submit_success = false; $rul_process_submit3 .= '<p><strong>****' .__('ERROR: Unknown error updating circle-specific URL for circle ',WPC_CLIENT_TEXT_DOMAIN) . $circle_name . '****</strong></p>' . "\n"; } } $rul_circles_updated[] = $circle; } else { $rul_submit_success = false; $rul_process_submit3 .= '<p><strong>****' .__('ERROR: Non-existent circle submitted ',WPC_CLIENT_TEXT_DOMAIN) .'****</strong></p>' . "\n"; } } $rul_circles_notin = "'" . implode( "','", $rul_circles_updated ) . "'"; $wpdb->query( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_type = 'circle' AND rul_value NOT IN ( {$rul_circles_notin} )" ); if ($rul_submit_success) { $this->redirect( $this->settings()->get_current_setting_url() . '&msg=u#wpc_specific_circles' ); } $rul_process_submit3 .= $rul_process_close; } elseif ( isset( $_POST['update_users'] ) ) { $rul_process_submit = '<div id="message" class="error wpc_notice fade">' . "\n"; $rul_process_close = '        </div>' . "\n"; $usernames = $_POST['rul_username']; $first_addresses = $_POST['rul_username_first_address']; $addresses = $_POST['rul_usernameaddress']; $logout = $_POST['rul_logout_usernameaddress']; if ( $usernames && ( $addresses || $first_addresses ) ) { $rul_submit_success = true; $rul_usernames_updated = array(); $rul_username_keys = array_keys( $usernames ); $rul_username_loop = 0; $wpdb->query( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_type = 'user'" ); foreach( $usernames as $username ) { $i = $rul_username_keys[$rul_username_loop]; if ( username_exists( $username ) ) { $first_address = wpc_client_rul_safe_redirect( $first_addresses[$i] ); $address = wpc_client_rul_safe_redirect( $addresses[$i] ); $lgt = ( isset( $logout[$i] ) ) ? wpc_client_rul_safe_redirect( $logout[$i] ) : ''; if (!$address) { $rul_submit_success = false; $rul_process_submit .= '<p><strong>****' .__('ERROR: Non-local or invalid URL submitted for user ',WPC_CLIENT_TEXT_DOMAIN) . $username . '****</strong></p>' . "\n"; } else { $sql = "INSERT INTO {$wpdb->prefix}wpc_client_login_redirects SET rul_first_url = '%s', rul_url = '%s', rul_type = 'user', rul_value = '%s', rul_url_logout='%s'"; $rul_update_username = $wpdb->query( $wpdb->prepare( $sql, $first_address, $address, $username, $lgt ) ); if ( !$rul_update_username ) { $rul_submit_success = false; $rul_process_submit .= '<p><strong>****' .__('ERROR: Unknown error updating user-specific URL for user ',WPC_CLIENT_TEXT_DOMAIN) . $username . '****</strong></p>' . "\n"; } } } elseif ($username != -1) { $rul_submit_success = false; $rul_process_submit .= '<p><strong>****' .__('ERROR: Non-existent username submitted ',WPC_CLIENT_TEXT_DOMAIN) .'****</strong></p>' . "\n"; } ++$rul_username_loop; } if ( $rul_submit_success ) { $this->redirect( $this->settings()->get_current_setting_url() . '&msg=u#wpc_specific_users' ); } } $rul_process_submit .= $rul_process_close; } elseif ( isset( $_POST['update_non_login'] ) ) { $wpc_default_non_login_redirects = array(); $wpc_default_non_login_redirects['url'] = ( isset( $_POST['wpc_non_login_redirect'] ) && !empty( $_POST['wpc_non_login_redirect'] ) ) ? trim( $_POST['wpc_non_login_redirect'] ) : ''; do_action( 'wp_client_settings_update', $wpc_default_non_login_redirects, 'default_non_login_redirects' ); $this->redirect( $this->settings()->get_current_setting_url() . '&msg=u#wpc_non_login' ); } } $rules_array = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wpc_client_login_redirects ORDER BY rul_type, rul_order, rul_value", "ARRAY_A" ); $users_rul_existing = array(); $roles_rul_existing = array(); $circles_rul_existing = array(); $users_rules_html = ''; $circles_rules_html = ''; $roles_rules_html = ''; if ( is_array( $rules_array ) && count( $rules_array ) ) { $i_user = $i_role = $i_circle = 0; foreach( $rules_array as $rule ) { if ( 'user' == $rule['rul_type'] ) { $rul_first_url = ( isset( $_POST['rul_username_first_address'][$i_user] ) ) ? $_POST['rul_username_first_address'][$i_user] : $rule['rul_first_url']; $rul_url = ( isset( $_POST['rul_usernameaddress'][$i_user] ) ) ? $_POST['rul_usernameaddress'][$i_user] : $rule['rul_url']; $rul_url_logout = ( isset( $_POST['rul_logout_usernameaddress'][$i_user] ) ) ? $_POST['rul_logout_usernameaddress'][$i_user] : $rule['rul_url_logout']; $users_rules_html .= '<tr>'; $users_rules_html .= '    <td><p><input type="checkbox" name="rul_username[' . $i_user . ']" value="' . $rule['rul_value'] . '" checked="checked" /> ' . $rule['rul_value'] . '</p></td>'; $users_rules_html .= '    <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_username_first_address[' . $i_user . ']" value="' . $rul_first_url . '" /> </p></td>'; $users_rules_html .= '    <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_usernameaddress[' . $i_user . ']" value="' . $rul_url . '" /> </p></td>'; $users_rules_html .= '    <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_logout_usernameaddress[' . $i_user . ']" value="' . $rul_url_logout . '" /> </p></td>'; $users_rules_html .= '</tr>'; $users_rul_existing[] = $rule['rul_value']; ++$i_user; } elseif( 'role' == $rule['rul_type'] ) { $roles_rules_html .= '<tr>'; $roles_rules_html .= '   <td><p><input type="checkbox" name="rul_role[' . $i_role . ']" value="' . $rule['rul_value'] . '" checked="checked" /> ' . $rule['rul_value'] . '</p></td>'; $roles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_first_roleaddress[' . $i_role . ']" value="' . $rule['rul_first_url'] . '" /></p></td>'; $roles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_roleaddress[' . $i_role . ']" value="' . $rule['rul_url'] . '" /></p></td>'; $roles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_logout_roleaddress[' . $i_role . ']" value="' . $rule['rul_url_logout'] . '" /></p></td>'; $roles_rules_html .= '</tr>'; $roles_rul_existing[] = $rule['rul_value']; ++$i_role; } elseif( 'circle' == $rule['rul_type'] ) { if( isset( $circles_names[$rule['rul_value']] ) && !empty( $circles_names[$rule['rul_value']] ) ) { $circles_rules_html .= '<tr>'; $circles_rules_html .= '   <td><p><input type="checkbox" name="rul_circle[' . $i_circle . ']" value="' . $rule['rul_value'] . '" checked="checked" /> ' . $circles_names[$rule['rul_value']] . '</p></td>'; $circles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_circle_first_address[' . $i_circle . ']" value="' . $rule['rul_first_url'] . '" /></p></td>'; $circles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_circle_address[' . $i_circle . ']" value="' . $rule['rul_url'] . '" /></p></td>'; $circles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_logout_circle_address[' . $i_circle . ']" value="' . $rule['rul_url_logout'] . '" /></p></td>'; $circles_rules_html .= '   <td><p><input type="number" style="width: 50px;" name="rul_order[' . $i_circle . ']" value="' . $rule['rul_order'] . '" /></p></td>'; $circles_rules_html .= '</tr>'; $circles_rul_existing[] = $rule['rul_value']; ++$i_circle; } } } } else { $i_user = $i_role = $i_circle = 1; } $wpc_enable_custom_redirects = $this->cc_get_settings( 'enable_custom_redirects', 'no' ); $wpc_default_redirects = $this->cc_get_settings( 'default_redirects' ); $wpc_default_non_login_redirects = $this->cc_get_settings( 'default_non_login_redirects' ); $section_fields = array( array( 'type' => 'title', 'label' => __( 'Custom Redirects Settings', WPC_CLIENT_TEXT_DOMAIN ), ), ); $this->settings()->render_settings_section( $section_fields ); ?>

</form>

<form action="<?php echo $this->settings()->get_current_setting_url() ?>" method="post" name="wpc_settings" id="wpc_settings" >
    <p>
        <span style="font-size: 14px; font-weight: bold;"><?php _e( 'Enable custom redirects', WPC_CLIENT_TEXT_DOMAIN ) ?>:</span>
        <select name="wpc_enable_custom_redirects" id="wpc_enable_custom_redirects" style="width: 70px;">
            <option value="no" <?php echo ( isset( $wpc_enable_custom_redirects ) && 'no' == $wpc_enable_custom_redirects ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
            <option value="yes" <?php echo ( isset( $wpc_enable_custom_redirects ) && 'yes' == $wpc_enable_custom_redirects ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
        </select>
        <span id="ajax_result" style="display: inline;"></span>
    </p>
    <br />
    <div class="wpc_clear"></div>
</form>


<div id="redirects_tabs" style="width:100%;float:left;<?php echo ( isset( $wpc_enable_custom_redirects ) && 'yes' == $wpc_enable_custom_redirects ) ? '' : 'display: none;' ?>">
    <?php $tabs = array(); $tabs = array( array( 'label' => __( 'Login/Logout For All<br />(low priority)', WPC_CLIENT_TEXT_DOMAIN ), 'href' => "#wpc_all_user", 'active' => true ), array( 'label' => __( 'Login/Logout For Roles<br />(medium priority)', WPC_CLIENT_TEXT_DOMAIN ), 'href' => "#wpc_roles", 'active' => false ), array( 'label' => sprintf( __( 'Login/Logout For %s<br />(high priority)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ), 'href' => "#wpc_specific_circles", 'active' => false ), array( 'label' => __( 'Login/Logout For Users<br />(highest priority)', WPC_CLIENT_TEXT_DOMAIN ), 'href' => "#wpc_specific_users", 'active' => false ), array( 'label' => __( 'For Non-logged-in', WPC_CLIENT_TEXT_DOMAIN ), 'href' => "#wpc_non_login", 'active' => false ) ); echo $this->gen_vertical_tabs( $tabs, array('width'=>'23%') ); ?>

<!--    <ul style="float:left; width: 23%; margin: 0;">
        <li><a href="#wpc_all_user"><?php ?><br /><?php ?></a></li>
        <li><a href="#wpc_roles"><?php ?><br /><?php ?></a></li>
        <li><a href="#wpc_specific_circles"><?php ?><br /><?php ?></a></li>
        <li><a href="#wpc_specific_users"><?php ?><br /><?php ?></a></li>
        <li><a href="#wpc_non_login"><?php ?></a></li>
    </ul>-->
    <div id="tab-container" style="width: 76%;">
        <div id="wpc_all_user" style="float:left;width:100%;margin: 0;padding:0;" class="tab-content">
            <form action="<?php echo $this->settings()->get_current_setting_url() ?>" method="post" name="wpc_settings1" id="wpc_settings1" >
                <input type="hidden" name="update_settings" value="1" />

                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Manage Default Login/Logout Redirect rules', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <div class="inside">

                        <p>
                            <span class="description"><?php _e( "Low Priority - Will work for any Users who do not have specific Login/Logout Redirect rules.", WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                        </p>

                        <label for="wpc_default_first_login_redirect"><?php _e( 'First Time Login Redirect', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                        <br />
                        <input type="text" id="wpc_default_first_login_redirect" name="wpc_default_first_login_redirect" size="83" maxlength="500" value="<?php echo ( isset( $wpc_default_redirects['first_login'] ) ) ? $wpc_default_redirects['first_login'] : '' ?>"/>
                        <span class="description"><?php _e( 'first time login redirect for all users.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                        <br />
                        <br />

                        <label for="wpc_default_login_redirect"><?php _e( 'Login Redirect', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                        <br />
                        <input type="text" id="wpc_default_login_redirect" name="wpc_default_login_redirect" size="83" maxlength="500" value="<?php echo ( isset( $wpc_default_redirects['login'] ) ) ? $wpc_default_redirects['login'] : '' ?>"/>
                        <span class="description"><?php _e( 'default login redirect for all users.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                        <br />
                        <br />

                        <label for="wpc_default_logout_redirect"><?php _e( 'Logout Redirect', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                        <br />
                        <input type="text" id="wpc_default_logout_redirect" name="wpc_default_logout_redirect" size="83" maxlength="500" value="<?php echo ( isset( $wpc_default_redirects['logout'] ) ) ? $wpc_default_redirects['logout'] : '' ?>"/>
                        <span class="description"><?php _e( 'default logout redirect for all users.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                        <br />
                        <br />

                        <input type="submit" class='button-primary' name="update_all" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" /><br />
                        <br />
                    </div>
                </div>
            </form>
        </div>


        <div id="wpc_roles" style="float:left;width:100%;margin: 0;padding:0;" class="tab-content invisible">
            <form action="<?php echo $this->settings()->get_current_setting_url() . '#wpc_roles' ?>" method="post" name="wpc_settings3" id="wpc_settings3" >
                <input type="hidden" name="update_settings" value="1" />
                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Manage Login/Logout Redirect rules for any role', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <div class="inside">

                        <?php echo $rul_process_submit2 ?>

                        <h4><?php _e( 'Specific roles', WPC_CLIENT_TEXT_DOMAIN ) ?></h4>

                        <p>
                            <span class="description"><?php _e( "Medium Priority - Will work for Users who have these roles and do not have specific Login/Logout Redirect rules.", WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                        </p>

                        <table>
                            <tr>
                                <td><?php _e( 'Add:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <select name="rul_role[<?php echo $i_role ?>]" >
                                        <option value="-1"><?php _e( 'Select a role', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                        <?php
 $roles_name = array(); foreach( array_keys( $wp_roles->role_names ) as $role ) { $roles_name[$role] = $role; } if ( $roles_name ) { foreach( $roles_name as $role_name ) { if ( !in_array( $role_name, $roles_rul_existing ) ) { echo '<option value="' . $role_name . '">' . $role_name . '</option>'; } } } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?php _e( 'First Time Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <input type="text" size="83" maxlength="500" name="rul_first_roleaddress[<?php echo $i_role ?>]" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php _e( 'Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <input type="text" size="83" maxlength="500" name="rul_roleaddress[<?php echo $i_role ?>]" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php _e( 'Logout URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <input type="text" size="83" maxlength="500" name="rul_logout_roleaddress[<?php echo $i_role ?>]" />
                                </td>
                            </tr>
                        </table>

                        <table class="widefat">
                            <tr>
                                <th><?php _e( 'Role', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                                <th><?php _e( 'First Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                                <th><?php _e( 'Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                                <th><?php _e( 'Logout URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            </tr>
                            <?php echo $roles_rules_html ?>
                        </table>
                        <br />
                        <br />
                        <input type="submit" class='button-primary' name="update_roles" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                        <br />
                        <br />
                    </div>
                </div>
            </form>
        </div>


        <div id="wpc_specific_users" style="float:left;width:100%;margin: 0;padding:0;" class="tab-content invisible">
            <form action="<?php echo $this->settings()->get_current_setting_url() . '#wpc_specific_users' ?>" method="post" name="wpc_settings2" id="wpc_settings2" >
                <input type="hidden" name="update_settings" value="1" />

                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Manage Login/Logout Redirect rules for any user', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <div class="inside">

                        <?php echo $rul_process_submit ?>

                        <h4><?php _e( 'Specific users', WPC_CLIENT_TEXT_DOMAIN ) ?></h4>
                        <p>
                            <span class="description"><?php _e( "Highest Priority - Will always work - Does not matter if user has any other Login/Logout Redirect rules.", WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                        </p>

                        <table>
                            <tr>
                                <td><?php _e( 'Add:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <select name="rul_username[<?php echo $i_user ?>]" >
                                        <option value="-1"><?php _e( 'Select a username', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                        <?php
 $exclude_users = "'" . implode( "','", $users_rul_existing ) . "'"; $users = $wpdb->get_results( "SELECT user_login FROM {$wpdb->users} WHERE user_login NOT IN ( {$exclude_users} ) ORDER BY user_login", "ARRAY_A" ); if ( $users ) { foreach( $users as $user ) { echo '<option value="' . $user['user_login'] . '">' . $user['user_login'] . '</option>'; } } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?php _e( 'First Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <input type="text" size="83" maxlength="500" name="rul_username_first_address[<?php echo $i_user ?>]" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php _e( 'Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <input type="text" size="83" maxlength="500" name="rul_usernameaddress[<?php echo $i_user ?>]" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php _e( 'Logout URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <input type="text" size="83" maxlength="500" name="rul_logout_usernameaddress[<?php echo $i_user ?>]" />
                                </td>
                            </tr>
                        </table>

                        <table class="widefat">
                            <tr>
                                <th><?php _e( 'Username', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                                <th><?php _e( 'First Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                                <th><?php _e( 'Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                                <th><?php _e( 'Logout URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            </tr>
                            <?php echo $users_rules_html ?>
                        </table>
                        <br />
                        <br />
                        <input type="submit" class='button-primary' name="update_users" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                        <br />
                        <br />
                    </div>
                </div>
            </form>
        </div>


        <div id="wpc_specific_circles" style="float:left;width:100%;margin: 0;padding:0;" class="tab-content invisible">
            <form action="<?php echo $this->settings()->get_current_setting_url() . '#wpc_specific_circles' ?>" method="post" name="wpc_settings3" id="wpc_settings3" >
                <input type="hidden" name="update_settings" value="1" />

                <div class="postbox">
                    <h3 class='hndle'><span><?php printf( __( 'Manage Login/Logout Redirect rules for any %s', WPC_CLIENT_TEXT_DOMAIN), $this->custom_titles['circle']['s'] ) ?></span></h3>
                    <div class="inside">

                        <?php echo $rul_process_submit3 ?>

                        <h4><?php printf( __( 'Specific %s', WPC_CLIENT_TEXT_DOMAIN), $this->custom_titles['circle']['p'] ) ?></h4>
                        <p>
                            <span class="description"><?php printf( __( "High Priority - Will work for Users who have these %s and do not have specific Login/Logout Redirect rules.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ) ?></span>
                        </p>

                        <table>
                            <tr id="is_choose1">
                                <td colspan="2">
                                    <?php
 $link_array = array( 'title' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $current_page = isset( $_GET['page'] ) ? $_GET['page'] : ''; $this->acc_assign_popup('circle', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                </td>
                            </tr>
                            <tr id="is_choose4">
                                <td><?php _e( 'First Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <input type="text" size="83" maxlength="500" name="wpc_circle_first_address" id="wpc_circle_first_address" />
                                </td>
                            </tr>
                            <tr id="is_choose2">
                                <td><?php _e( 'Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <input type="text" size="83" maxlength="500" name="wpc_circle_address" id="wpc_circle_address" />
                                </td>
                            </tr>
                            <tr id="is_choose3">
                                <td><?php _e( 'Logout URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <input type="text" size="83" maxlength="500" name="wpc_logout_circle_address"  id="wpc_logout_circle_address" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php _e( 'Order:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                                <td>
                                    <input type="number" name="wpc_order" value="0" />
                                </td>
                            </tr>
                        </table>

                        <table class="widefat">
                            <tr>
                                <th><?php printf( __( '%s Name', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) ?></th>
                                <th><?php _e( 'First Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                                <th><?php _e( 'Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                                <th><?php _e( 'Logout URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                                <th><?php _e( 'Order', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            </tr>
                            <?php echo $circles_rules_html ?>
                        </table>
                        <br />
                        <br />
                        <input type="submit" class='button-primary' name="update_circles" id="update_circles" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                        <br />
                        <br />
                    </div>
                </div>
            </form>
        </div>


        <div id="wpc_non_login" style="float:left;width:100%;margin: 0;padding:0;" class="tab-content invisible">
            <form action="<?php echo $this->settings()->get_current_setting_url() . '#wpc_non_login' ?>" method="post" name="wpc_settings4" id="wpc_settings4" >
                <input type="hidden" name="update_settings" value="1" />

                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Default for Non-logged-in Redirects', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <div class="inside">

                        <?php echo $rul_process_submit4 ?>

                        <table>
                            <tr>
                                <td><label for="wpc_non_login_redirect"><?php _e( 'Redirect to:', WPC_CLIENT_TEXT_DOMAIN ) ?></label></td>
                                <td>
                                    <input type="text" size="83" maxlength="500" name="wpc_non_login_redirect" id="wpc_non_login_redirect" value="<?php echo ( isset( $wpc_default_non_login_redirects['url'] ) ) ? $wpc_default_non_login_redirects['url'] : '' ?>" />
                                </td>
                            </tr>
                        </table>
                        <br />
                        <br />
                        <input type="submit" class='button-primary' name="update_non_login" id="update_non_login" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                        <br />
                        <br />
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<div class="wpc_clear"></div>

<form style="display: none">

<script type="text/javascript" language="javascript">
    var site_url = '<?php echo site_url();?>';
    jQuery(document).ready(function() {

        var admin_url = '<?php echo get_admin_url();?>';

        jQuery( '#wpc_enable_custom_redirects' ).change( function() {
            var enable = jQuery( this ).val();

            jQuery( "#redirects_tabs" ).slideToggle( 'slow' );

            jQuery( "#ajax_result" ).html( '' );
            jQuery( "#ajax_result" ).show();
            jQuery( "#ajax_result" ).css( 'display', 'inline' );
            jQuery( "#ajax_result" ).html( '<span class="wpc_ajax_loading"></span>' );

            jQuery.ajax({
                type: "POST",
                url: admin_url+"/admin-ajax.php",
                data: "action=wpc_save_enable_custom_redirects&wpc_enable_custom_redirects=" + enable,
                dataType: "json",
                success: function( data ){
                    if ( data.status ) {
                        jQuery( "#ajax_result" ).css( 'color', 'green' );
                    } else {
                        jQuery( "#ajax_result" ).css( 'color', 'red' );
                    }
                    jQuery( "#ajax_result" ).html( data.message );
                    setTimeout( function() {
                        jQuery( "#ajax_result" ).fadeOut( 1500 );
                    }, 2500 );
                },
                error: function( data ) {
                    jQuery( "#ajax_result" ).css( 'color', 'red' );
                    jQuery( "#ajax_result" ).html( 'Unknown error.' );
                    setTimeout( function() {
                        jQuery( "#ajax_result" ).fadeOut( 1500 );
                    }, 2500 );
                }
            });
        });

        //wpc_client_rul_submit_username( $_POST['rul_username'], $_POST['rul_usernameaddress'], $_POST['rul_logout_usernameaddress'] );

    });

</script>