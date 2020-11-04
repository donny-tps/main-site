<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( isset( $_POST['wpc_settings'] ) ) { $settings = $_POST['wpc_settings']; $settings['version'] = 'recaptcha_2'; $settings['publickey_2'] = ( isset( $settings['publickey_2'] ) && '' != $settings['publickey_2'] ) ? $settings['publickey_2'] : ''; $settings['privatekey_2'] = ( isset( $settings['privatekey_2'] ) && '' != $settings['privatekey_2'] ) ? $settings['privatekey_2'] : ''; $settings['theme'] = !empty( $settings['theme'] ) ? $settings['theme'] : 'light'; if ( isset( $settings['enabled'] ) && 'yes' == $settings['enabled'] && 'recaptcha_2' == $settings['version'] && ( empty( $settings['publickey_2'] ) || empty( $settings['privatekey_2'] ) ) ) $this->redirect( $this->settings()->get_current_setting_url() . '&msg=nk' ); do_action( 'wp_client_settings_update', $settings, 'captcha' ); $this->redirect( $this->settings()->get_current_setting_url() . '&msg=u' ); } $wpc_captcha = $this->cc_get_settings( 'captcha' ); $section_fields = array( array( 'type' => 'title', 'label' => __( 'Captcha', WPC_CLIENT_TEXT_DOMAIN ), ), array( 'id' => 'enabled', 'type' => 'checkbox', 'label' => __( 'Use Captcha', WPC_CLIENT_TEXT_DOMAIN ), 'value' => ( isset( $wpc_captcha['enabled'] ) ) ? $wpc_captcha['enabled'] : 'no', 'description' => sprintf( __( 'Use captcha on %s forms', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), ), array( 'id' => 'use_on', 'type' => 'multi-checkbox', 'label' => __( 'Use on', WPC_CLIENT_TEXT_DOMAIN ), 'value' => ( isset( $wpc_captcha['use_on'] ) ) ? $wpc_captcha['use_on'] : '', 'options' => array( 'registration' => __( 'Registration Form', WPC_CLIENT_TEXT_DOMAIN ), 'login' => __( 'Login Form', WPC_CLIENT_TEXT_DOMAIN ), ), 'conditional' => array( 'enabled', '=', 'yes' ), ), array( 'id' => 'publickey_2', 'type' => 'text', 'label' => __( 'Public Key (required)', WPC_CLIENT_TEXT_DOMAIN ), 'value' => ( isset( $wpc_captcha['publickey_2'] ) ) ? $wpc_captcha['publickey_2'] : '', 'description' => sprintf( __( 'Click <a href="%s" target="_blank">here</a> to get your Public and Public Keys', WPC_CLIENT_TEXT_DOMAIN ), 'http://www.google.com/recaptcha' ), 'conditional' => array( 'enabled', '=', 'yes' ), ), array( 'id' => 'privatekey_2', 'type' => 'text', 'label' => __( 'Private Key (required)', WPC_CLIENT_TEXT_DOMAIN ), 'value' => ( isset( $wpc_captcha['privatekey_2'] ) ) ? $wpc_captcha['privatekey_2'] : '', 'description' => sprintf( __( 'Click <a href="%s" target="_blank">here</a> to get your Public and Private Keys', WPC_CLIENT_TEXT_DOMAIN ), 'http://www.google.com/recaptcha' ), 'conditional' => array( 'enabled', '=', 'yes' ), ), array( 'id' => 'theme', 'type' => 'selectbox', 'label' => __( 'Theme', WPC_CLIENT_TEXT_DOMAIN ), 'value' => ( isset( $wpc_captcha['theme'] ) ) ? $wpc_captcha['theme'] : 'light', 'options' => array( 'light' => __( 'Light', WPC_CLIENT_TEXT_DOMAIN ), 'dark' => __( 'Dark', WPC_CLIENT_TEXT_DOMAIN ), ), 'conditional' => array( 'enabled', '=', 'yes' ), ), array( 'id' => 'version', 'type' => 'hidden', 'is_option' => true, 'value' => ( isset( $wpc_captcha['version'] ) ) ? $wpc_captcha['version'] : 'recaptcha_2', ), array( 'id' => 'publickey', 'type' => 'hidden', 'is_option' => true, 'value' => ( isset( $wpc_captcha['publickey'] ) ) ? $wpc_captcha['publickey'] : '', ), array( 'id' => 'privatekey', 'type' => 'hidden', 'is_option' => true, 'value' => ( isset( $wpc_captcha['privatekey'] ) ) ? $wpc_captcha['privatekey'] : '', ), ); $this->settings()->render_settings_section( $section_fields ); ?>
<table class="form-table wpc-settings-section" id="captcha_hiding_settings">
    <tr class="wpc-settings-line">
        <th>
            <label><?php _e( 'Preview', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
        </th>
        <td>
            <img src="" alt="recaptcha_theme" id="recaptcha_preview_theme">
        </td>
    </tr>
</table>


<script type="text/javascript">
    jQuery( document ).ready( function() {
        var plugin_url = '<?php echo $this->plugin_url ?>';

        jQuery('#recaptcha_preview_theme').attr('src', plugin_url + 'images/recaptcha_2_0.png');

        <?php if( isset( $wpc_captcha['theme'] ) && 'dark' == $wpc_captcha['theme'] ) { ?>
        jQuery('#recaptcha_preview_theme').attr('src', plugin_url + 'images/recaptcha_2_0_dark.png');
        <?php } else { ?>
        jQuery('#recaptcha_preview_theme').attr('src', plugin_url + 'images/recaptcha_2_0.png');
        <?php } ?>

        jQuery('#wpc_settings_theme').change(function() {
            var value = jQuery(this).val();
            if( value == 'dark' ) {
                jQuery('#recaptcha_preview_theme').attr('src', plugin_url + 'images/recaptcha_2_0_dark.png');
            } else {
                jQuery('#recaptcha_preview_theme').attr('src', plugin_url + 'images/recaptcha_2_0.png');
            }
        });

        if( 'checked' != jQuery( '#wpc_settings_enabled:last' ).attr( 'checked' )) {
            jQuery('#captcha_hiding_settings').hide();
        } else if( 'checked' == jQuery( '#wpc_settings_enabled:last' ).attr( 'checked' ) ) {
            jQuery('#captcha_hiding_settings').show();
        }

        jQuery('#wpc_settings_enabled').change(function(){
            if( 'checked' != jQuery( '#wpc_settings_enabled:last' ).attr( 'checked' )) {
                jQuery('#captcha_hiding_settings').hide();
            } else if( 'checked' == jQuery( '#wpc_settings_enabled:last' ).attr( 'checked' )) {
                jQuery('#captcha_hiding_settings').show();
            }
        });

        jQuery( '#wpc_update_settings' ).click(function(){
            var errors = 0;
            jQuery( '#wpc_settings_privatekey_2' ).removeClass( 'wpc_error' ) ;
            jQuery( '#wpc_settings_publickey_2' ).removeClass( 'wpc_error' ) ;
            if ( 'checked' == jQuery( '#wpc_settings_enabled:last' ).attr( 'checked' ) ) {
                if ( '' == jQuery( '#wpc_settings_privatekey_2' ).val() ) {
                    jQuery( '#wpc_settings_privatekey_2' ).addClass( 'wpc_error' ).focus();
                    errors++;
                }
                if ( '' == jQuery( '#wpc_settings_publickey_2' ).val() ) {
                    jQuery( '#wpc_settings_publickey_2' ).addClass( 'wpc_error' ).focus();
                    errors++;
                }
            }

            if( errors == 0 ) {
                return true;
            } else {
                return false;
            }
        });

    });
</script>