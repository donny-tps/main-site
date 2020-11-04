<?php

Class TPSReporting {

    public static function init() {
        // Create back end menu
        $menu = add_menu_page('Vote Export', 'Vote Export', 'manage_options', 'vote-export.php', 'TPSReporting::mainPage', 'dashicons-chart-line', '3.5');
        add_action('load-' . $menu, 'TPSReporting::load_admin_js');
        // Store Product Date when order is completed
        //add_action('woocommerce_checkout_order_processed', 'TPSReporting::addToOrder', 1);
        return;
    }

    public static function load_admin_js() {
        add_action('admin_enqueue_scripts', 'TPSReporting::loadAssets');
    }

    public static function loadAssets() {
        wp_register_style('transform-reporting-css', get_stylesheet_directory_uri() . '/library/css/tps-reporting.css');
        wp_enqueue_style('transform-reporting-css');
    }

    public static function mainPage() {
        echo get_template_part('library/classes/reporting/templates/reporting', 'main');
        return;
    }

    public static function getOrdersDate($startDate = '', $endDate = '') {
        if ($startDate == '') {
            $startDate = date('Y-m-d');
        }
        if ($endDate == '') {
            $endDate = date('Y-m-d');
        }

        global $wpdb;
        $voteitems = $wpdb->get_results('SELECT * FROM tps_votes WHERE verified = 1 AND date_voted BETWEEN "' . $startDate . '" AND "' . $endDate . '"');
        
        return $voteitems; 
    }

    public static function getOrdersName($eventName) {
        global $wpdb;
                
        $voteitems = $wpdb->get_results('SELECT * FROM tps_votes WHERE eventname = "' . $eventName . '" AND verified = 1');
        
        return $voteitems; 
    }
    
    public static function doExport($type, $startDate, $endDate, $eventName) {
        if($type == "name") {
            $getOrders = TPSReporting::getOrdersName($eventName);
        } else {
            $getOrders = TPSReporting::getOrdersDate($startDate, $endDate);
        }
        
        $exportArray = array(
            array('Event', 'Vote ID', 'Photo Name', 'Photo ID', 'Date Voted', 'Email', 'First Name', 'Last Name', 'Mobile', 'Postcode', 'Want Shoot'),
        );

        foreach ($getOrders as $item) {
            $i = 1;
            $p = '';
            $q = '';
            $exportArray[] = array($item->eventname, $item->id, get_the_title($item->pid), $item->pid, $item->date_voted, $item->email, $item->firstname, $item->lastname, $item->mobile, $item->postcode, $item->{'want-shoot'});

        }

        TPSReporting::download_send_headers("vote_export" . date("Y-m-d") . ".csv");
        echo TPSReporting::array2csv($exportArray);
        die();
    }
    
    public static function array2csv(array &$array) {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }

    function download_send_headers($filename) {
// disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

// force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

// disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

}
