<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } $wpdb->query( "UPDATE {$wpdb->prefix}wpc_client_files_download_log
    SET download_date=UNIX_TIMESTAMP(download_date)
    WHERE STR_TO_DATE(download_date, '%Y-%m-%d %H:%i:%s') IS NOT NULL" );