<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } $args = array( 'role' => 'wpc_client', 'fields' => array( 'ID' ), ); $clients = get_users( $args ); if ( is_array( $clients ) && 0 < count( $clients ) ) { foreach( $clients as $client ) { $contact_name = get_user_meta( $client->ID, 'nickname', true ); if ( $contact_name ) { $wpdb->query( "UPDATE {$wpdb->users} SET display_name = '{$contact_name}' WHERE ID = '{$client->ID}' " ); } } }