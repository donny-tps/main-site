<?php
if ( ! defined( 'ABSPATH' ) ) exit; $wpc_caps = $this->cc_get_settings( 'capabilities' ); if ( ! empty( $wpc_caps['wpc_manager'] ) ) { if ( isset( $wpc_caps['wpc_manager']['read_portalhub'] ) ) { $wpc_caps['wpc_manager']['wpc_view_portalhubs'] = $wpc_caps['wpc_manager']['read_portalhub']; unset( $wpc_caps['wpc_manager']['read_portalhub'] ); } if ( isset( $wpc_caps['wpc_manager']['edit_portalhub'] ) ) { $wpc_caps['wpc_manager']['wpc_edit_portalhub'] = $wpc_caps['wpc_manager']['edit_portalhub']; unset( $wpc_caps['wpc_manager']['edit_portalhub'] ); } do_action( 'wp_client_settings_update', $wpc_caps, 'capabilities' ); }