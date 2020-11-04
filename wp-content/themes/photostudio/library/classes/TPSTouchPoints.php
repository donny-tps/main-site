<?php

class TouchPoint {

    public static function init() {
        //$menu = add_menu_page('Bookings', 'Bookings', 'manage_options', 'tps-touch-point', 'TouchPoint::mainPage', 'dashicons-camera', 6);
        $menu = add_menu_page('Bookings', 'Bookings', 'add_tps_booking', 'tps-touch-point', 'TouchPoint::mainPage', 'dashicons-camera', 6);
        add_action('load-' . $menu, 'TouchPoint::load_admin_js');

        $submenu = add_submenu_page( 'tps-touch-point', 'Groups', 'Groups', 'add_tps_booking', 'admin.php?page=tps-touch-point&tab=group-list', 'TouchPoint::mainPage');
        add_action('load-' . $submenu, 'TouchPoint::load_admin_js');
        
        add_action('wp_ajax_ajaxrecalcdates', 'TouchPoint::recalcDates');
        add_action('wp_ajax_ajaxcancelbooking', 'TouchPoint::cancelBooking');
        add_action('wp_ajax_ajaxpausebooking', 'TouchPoint::pauseBooking');
        add_action('wp_ajax_ajaxaddTouchpoint', 'TouchPoint::addTouchpoint');
        
        //TouchPoint::addStylistRole();
        //TouchPoint::addBookerCapability();
        return;
    }

    public static function load_admin_js() {
        add_action('admin_enqueue_scripts', 'TouchPoint::loadAssets');
    }

    public static function loadAssets() {
        wp_register_style('tps-touchpoints-css', get_stylesheet_directory_uri() . '/library/css/tps-touchpoints.css');
        wp_register_style('tps-touchpoints-jquery-ui', get_stylesheet_directory_uri() . '/library/css/jquery-ui.min.css');
        wp_register_script('tps-touchpoints-datepicker', get_stylesheet_directory_uri() . '/library/js/libs/datepicker.min.js');
        wp_register_script('tps-touchpoint', get_stylesheet_directory_uri() . '/library/js/libs/touchpoint.js');
        wp_register_script('tps-touchpoints', get_stylesheet_directory_uri() . '/library/js/libs/touchpoints.js'); //additions for v 2.0
        wp_register_script('jquery-ui', 'https://code.jquery.com/ui/1.10.4/jquery-ui.js');
        wp_enqueue_style('tps-touchpoints-css');
        wp_enqueue_style('tps-touchpoints-jquery-ui');
        wp_enqueue_script('tps-touchpoints-datepicker');
        wp_enqueue_script('tps-touchpoint');
        wp_enqueue_script('tps-touchpoints');
        wp_enqueue_script('jquery-ui');

        wp_register_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
        wp_enqueue_style('font-awesome');

        wp_localize_script('tps-touchpoints', 'ajax_scripts_object', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'autoOptions' => TouchPoint::getTouchpointNamesAutocomplete(),
            'redirecturl' => '/event/',
            'loadingmessage' => __('Sending user info, please wait...')
        ));
    }

    public static function mainPage() {
//        if (isset($_GET['action']) && $_GET['action'] == 'add-booking') {
//            // add booking
//            $booking = TouchPoint::addBooking();
//
//            // Calculate dates to send emails
//            // Send Welcome Email
//            if ($booking != false) {
//                wp_redirect('/wp-admin/admin.php?page=tps-touch-point&tab=booking-thankyou&id=' . $booking);
//            }
//            return;
//        }
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'add-booking':
                    $booking = TouchPoint::addBooking();
                    wp_redirect(get_site_url() . '/wp-admin/admin.php?page=tps-touch-point&tab=booking-view&id=' . $booking);
                    exit;
                    break;
                case 'update-booking':
                    $booking = TouchPoint::updateBooking();
                    break;
                case 'add-group':
                    $group = TouchPoint::addGroup();
                    wp_redirect(get_site_url() . '/wp-admin/admin.php?page=tps-touch-point&tab=group-view&id=' . $group);
                    break;
                case 'update-group':
                    $group = TouchPoint::updateGroup();
                    break;
            }
        }
        if (isset($_GET['tab'])) {
            switch ($_GET['tab']) {
                case 'booking-add':
                    echo get_template_part('library/classes/touchpoints/templates/booking', 'add');
                    break;
                case 'booking-thankyou':
                    echo get_template_part('library/classes/touchpoints/templates/booking', 'thankyou');
                    break;
                case 'booking-view':
                    echo get_template_part('library/classes/touchpoints/templates/booking', 'view');
                    break;
                case 'group-add':
                    echo get_template_part('library/classes/touchpoints/templates/group', 'add');
                    break;
                case 'group-list':
                    echo get_template_part('library/classes/touchpoints/templates/group', 'list');
                    break;
                case 'group-view':
                    echo get_template_part('library/classes/touchpoints/templates/group', 'view');
                    break;
            }
        } else {
            echo get_template_part('library/classes/touchpoints/templates/index', 'main');
        }
        return;
    }

    public static function addBooking() {
        global $wpdb;
        $uid = get_current_user_id();
        $stylingDate = date('Y-m-d', strtotime($_POST['booking-styling-call-date']));
        $shootDate = date('Y-m-d', strtotime($_POST['booking-shoot-date']));
        $phone = preg_replace("/[^A-Za-z0-9]/", "", $_POST['booking-mobile']);
        $data = array(
            'first_name' => $_POST['booking-first-name'],
            'last_name' => $_POST['booking-last-name'],
            'email' => $_POST['booking-email'],
            'phone' => $phone,
            'styling_call_date' => $stylingDate,
            'styling_call_time' => $_POST['booking-styling-call-time'],
            'shoot_date' => $shootDate,
            'stylist_name' => $_POST['booking-stylist-name'],
            'creation_date' => date('Y-m-d h:i:s'),
            'type' => $_POST['booking-type'], //emails sent need to change based on this
            'booker_id' => $uid,
            'message' => $_POST['message'],
        );

        //debug_dump($data);
        //die();

        $bookingID = $wpdb->insert('wp3_touchpoint_bookings', $data);
        $bookingID = $wpdb->insert_id;

        $updateData = array(
            'booking_ID' => $bookingID,
            'user' => $uid,
            'date' => date("Y-m-d H:i:s"),
            'kind' => 'create',
        );
        $wpdb->insert('wp3_touchpoint_history', $updateData);

        if ($bookingID != 0) {
            TouchPoint::setupNotificationSchedule($bookingID);
            //TouchPoint::sendConfirmationEmail($bookingID);
            return $bookingID;
        }
        return false;
    }
    
    public static function addGroup() {
        global $wpdb;
        $touchpoints = $_POST;
        unset($touchpoints['group-name']);
        
        $t = json_encode(array_values($touchpoints));
        
        $updateData = array(
            'name' => $_POST['group-name'],
            'touchpoints' => $t,
            'deleted' => 0,
            'modified' => date('Y-m-d H:i:s'),
        );
        
        $wpdb->insert('wp3_touchpoint_groups', $updateData);
        $bookingID = $wpdb->insert_id;
        
        if ($bookingID != 0) {
            return $bookingID;
        }
        
        return;
    }
    
    public static function updateGroup() {
        global $wpdb;
        $touchpoints = $_POST;
        unset($touchpoints['group-name']);
        
        $t = json_encode(array_values($touchpoints));
        
        $updateData = array(
            'name' => $_POST['group-name'],
            'touchpoints' => $t,
            'deleted' => 0,
            'modified' => date('Y-m-d H:i:s'),
        );
        
        $where = array('name' => $_POST['group-name']);
        
        $wpdb->update('wp3_touchpoint_groups', $updateData, $where);
        
        return;
    }
    
    public static function getGroup($id) {
        global $wpdb;
        $booking = $wpdb->get_row('SELECT * FROM `wp3_touchpoint_groups` WHERE id = ' . $id);
        return $booking;
    }
    
    public static function getGroups() {
        global $wpdb;
        $groups = $wpdb->get_results('SELECT * FROM `wp3_touchpoint_groups` ORDER BY `name` DESC');
        
        return $groups;
    }
    
    public static function getGroupsPaginate($limit = 1000, $offset = 0) {
        global $wpdb;

        $groups = $wpdb->get_results('SELECT * FROM  `wp3_touchpoint_groups` ORDER BY name DESC LIMIT ' . $limit . ' OFFSET ' . $offset);
        
        return $groups;
    }
    
    public static function getGroupsCount() {
        global $wpdb;
        $groups = $wpdb->get_results('SELECT * FROM `wp3_touchpoint_groups`');
        
        return count($groups);
    }

    public static function updateBooking() {
        global $wpdb;
        $id = $_GET['id'];
        $uid = get_current_user_id();
        
        $stylingDate = date('Y-m-d', strtotime($_POST['booking-styling-call-date']));
        
        $booking = $wpdb->get_results('SELECT styling_call_date FROM  `wp3_touchpoint_bookings` where id = ' . $id);
        if(! $stylingDate == $booking[0]->styling_call_date) {
            $emailID = '53133f274fa32da118be14542dee7e5390bb21cf7599216c';
            TouchPointsEmail::touchPointMaster($id, $emailID);
        }
        
        if (isset($_POST['booking-first-name'])) {

            $phone = preg_replace("/[^A-Za-z0-9]/", "", $_POST['booking-mobile']);
            
            $shootDate = date('Y-m-d', strtotime($_POST['booking-shoot-date']));
            $data = array(
                'first_name' => $_POST['booking-first-name'],
                'last_name' => $_POST['booking-last-name'],
                'email' => $_POST['booking-email'],
                'phone' => $phone,
                'styling_call_date' => $stylingDate,
                'styling_call_time' => $_POST['styling-call-time'],
                'shoot_date' => $shootDate,
                'stylist_name' => $_POST['booking-stylist-name'],
                'message' => $_POST['message'],
            );
            $where = array('id' => $id);
//        debug_dump($data);
//        debug_dump($where);
//        die();

            $wpdb->update('wp3_touchpoint_bookings', $data, $where);

            $notifications = TouchPoint::getAllNotifications($id);
                        
            foreach ($notifications as $notification) {
            	    $sendDate = date('Y-m-d 18:00:00', strtotime($_POST['schedule-date_' . $notification->id]));
                    $notifyData = array(
                        'send_date' => $sendDate,
                    );
                    if (isset($_POST['deleted_' . $notification->id])) {
                        $notifyData['status'] = 'deleted';
                    }
                    $notifyWhere = array('id' => $notification->id);

                    $wpdb->update('wp3_touchpoint_emails', $notifyData, $notifyWhere);
            }
            
            TouchPoint::logUpdate($id, 'edit');
        }
    }
    
    public static function logUpdate($id, $kind, $notes = '') {
        global $wpdb;
        $uid = get_current_user_id();
        if(get_current_user_id()) {
            $uid = get_current_user_id();
        } else {
            $uid = 1;
        }
        
        date_default_timezone_set('Australia/Sydney');
        
        $updateData = array(
            'booking_ID' => $id,
            'user' => $uid,
            'date' => date("Y-m-d H:i:s"),
            'kind' => $kind,
            'notes' => $notes,
        );
        $wpdb->insert('wp3_touchpoint_history', $updateData);
    }

    public static function getBookingCount() {
        global $wpdb;
        $thisMonth = date('n');

        $results = $wpdb->get_results('SELECT id FROM  `wp3_touchpoint_bookings` WHERE booker_id = ' . get_current_user_id() . ' AND MONTH(creation_date) = ' . $thisMonth);
        return count($results);
    }

    public static function getTotalBookings() {
        global $wpdb;
        $uid = $_GET['uid'];
        
        if($uid) {
            if($uid != 'all') {
                $bookings = $wpdb->get_results('SELECT * FROM  `wp3_touchpoint_bookings` WHERE booker_id = ' . get_current_user_id() . ' ORDER BY creation_date DESC');
            } else {
                $bookings = $wpdb->get_results('SELECT * FROM  `wp3_touchpoint_bookings` ORDER BY creation_date DESC');
            }
            
        } else {
            $bookings = $wpdb->get_results('SELECT * FROM  `wp3_touchpoint_bookings` ORDER BY creation_date DESC');
        }
        
        return count($bookings);
    }
    
    public static function getAllBookings($uid = 'all', $limit = 1000, $offset = 0) {
        global $wpdb;
        // if($_GET['uid']) {
        //     $uid = $_GET['uid'];
        // } else {
        //     $uid = 'all';
        // }
        
        if($uid != 'all') {
            $bookings = $wpdb->get_results('SELECT * FROM  `wp3_touchpoint_bookings` WHERE booker_id = ' . $uid . ' ORDER BY creation_date DESC LIMIT ' . $limit . ' OFFSET ' . $offset);
        } else {
            $bookings = $wpdb->get_results('SELECT * FROM  `wp3_touchpoint_bookings` ORDER BY creation_date DESC LIMIT ' . $limit . ' OFFSET ' . $offset);
        }
        
        return $bookings;
    }

    public static function getBooking($id) {
        global $wpdb;
        $booking = $wpdb->get_results('SELECT * FROM `wp3_touchpoint_bookings` WHERE id = ' . $id);
        return $booking[0];
    }

    public static function sendConfirmationEmail($id) {
        global $wpdb;
        $booking = TouchPoint::getBooking($id);
        # Authenticate with your API key
        $auth = array('api_key' => '53133f274fa32da118be14542dee7e5390bb21cf7599216c');

        # The unique identifier for this smart email
        $smart_email_id = 'f0abf7a9-30ec-453f-b38e-e26893292946';

        # Create a new mailer and define your message
        $wrap = new CS_REST_Transactional_SmartEmail($smart_email_id, $auth);
        $message = array(
            "To" => $booking->first_name . ' <' . $booking->email . '>',
            "Data" => array(
                'x-apple-data-detectors' => 'x-apple-data-detectorsTestValue',
                'guest_name' => $booking->first_name,
                'day' => date('l jS F Y', strtotime($booking->styling_call_date)),
                'time' => $booking->styling_call_time,
            ),
        );
        # Send the message and save the response
        $result = $wrap->send($message);

        if (isset($result->response->Status) && $result->response->Status == 'Accepted') {
            $data = array('status' => 'sent');
            $where = array('booking_id' => $id, 'type' => 'Email Confirmation');
            $wpdb->update('wp3_touchpoint_emails', $data, $where);
            return true;
        }
        $data = array('status' => 'failed');
        $where = array('booking_id' => $id, 'type' => 'Email Confirmation');
        $wpdb->update('wp3_touchpoint_emails', $data, $where);

        return false;
    }

    public static function setupNotificationSchedule($id) {
        global $wpdb;
        $booking = TouchPoint::getBooking($id);
        
        $type = $booking->type;
        $group = $wpdb->get_row('SELECT * FROM  `wp3_touchpoint_groups` where `name` = "' . $type . '"');
        
        $emails = json_decode($group->touchpoints, true);
        
//        switch ($booking->type) {
//            case 'normal':
//                $emails = array(
//                    'All - Styling text 1',
//                );
//                break;
//            case 'dancers':
//                $emails = array(
//                    'Booked Dancers',
//                    'Fun Prop Ideas for a Ballet Photo Shoot',
//                    'All - Styling text 1',
//                    'All - Happy Video',
//                );
//                break;
//            case 'teenFashion':
//                $emails = array(
//                    'Booked Teen Fashion',
//                    'Top 10 Trends for a Teen Fashion Shoot',
//                    'All - Styling text 1',
//                    'All - Happy Video',
//                );
//                break;
//            case 'ladiesModelling':
//                $emails = array(
//                    'Booked Ladies Modelling',
//                    'Model Poses to Practice for Your Photo Shoot',
//                    'All - Styling text 1',
//                    'All - Happy Video',
//                );
//                break;
//            case 'familyWithKids':
//                $emails = array(
//                    'Booked Family with Kids',
//                    'A Mums Guide to Styling a Family Photo Shoot',
//                    'All - Styling text 1',
//                    'All - Happy Video'
//                );
//                break;
//            case 'youngLadies':
//                $emails = array(
//                    'Booked Ladies Fashion',
//                    '5 Fundamentals of Photo Shoot Styling',
//                    'All - Styling text 1',
//                    'All - Happy Video'
//                );
//                break;
//            case 'olderLadies':
//                $emails = array(
//                    'Booked Older Ladies',
//                    '5 Fundamentals of Photo Shoot Styling',
//                    'All - Styling text 1',
//                    'All - Happy Video'
//                );
//                break;
//            case 'guys':
//                $emails = array(
//                    'Booked Guys',
//                    'Top 10 Staples for a Guys Photo Shoot',
//                    'All - Styling text 1',
//                    'All - Happy Video'
//                );
//                break;
//            case 'maleModelling':
//                $emails = array(
//                    'Booked Male Modelling',
//                    'Top 10 Staples for a Guys Photo Shoot',
//                    'All - Styling text 1',
//                    'All - Happy Video'
//                );
//                break;
//            case 'littleMissFashion':
//                $emails = array(
//                    'Booked Little Miss Fashion',
//                    'Spot the Difference - Before & After Retouched Photos',
//                    'All - Styling text 1',
//                    'All - Happy Video'
//                );
//                break;
//            case 'fitnessLadies':
//                $emails = array(
//                    'Booked Fitness Ladies',
//                    'Preparation for a fitness photo shoot',
//                    'All - Styling text 1',
//                    'All - Happy Video'
//                );
//                break;
//            case 'fitnessGuys':
//                $emails = array(
//                    'Booked Fitness Guys',
//                    'Preparation for a fitness photo shoot',
//                    'All - Styling text 1',
//                    'All - Happy Video'
//                );
//                break;
//        }
        $emailSchedule = TouchPoint::getSendingDates($booking, count($emails));
        
//        debug_dump($type);
//        debug_dump($group);
//        debug_dump($emails);
//        debug_dump($emailSchedule);
        
        foreach ($emailSchedule as $key => $e) {
            $data = array(
                'booking_id' => $booking->id,
                'send_date' => date('Y-m-d h:i:s', $e),
                'type' => $emails[$key],
                'status' => 'pending',
            );
            $wpdb->insert('wp3_touchpoint_emails', $data);
        }

        return false;
    }

    public static function getSendingDates($booking, $emailCount) {
        $today = strtotime($booking->creation_date) + 36000; //accounting for time zones  
        $book_date = strtotime($booking->styling_call_date);
        
        $emails = array();

        $gap = ($book_date - $today) / ($emailCount - 1);
        
        //send the first email straight away
        $emails[] = $today + 3600;
        
        //next email goes 1 gap from now
        $i = 1;
        
        while($i < ($emailCount)) {
            $emails[] = $today + ($i * $gap);
            $i++;
        }
        
//        $emails[] = $today + $gap;
//        $emails[] = $today + (2 * $gap);
//        $emails[] = $today + (3 * $gap);
//        $emails[] = $today + (4 * $gap);
        //$emails[] = $today + (5 * $gap);
        //$emails[] = $today + (6 * $gap);
        
        // make sure its not setting the date&time to be before 8am or after 8pm
        foreach ($emails as $key => $e) {
            while (date('G', $e) < '08') {
                $e = $e + 3600;
            }
            while (date('G', $e) > '20') {
                $e = $e - 3600;
            }
            $emails[$key] = $e;
        }
        
        return $emails;
    }

    public static function sendSMS($bookings) {
        $AccountSid = "AC85e0831885939dcf296c8049cb064ce0";
        $AuthToken = "c6408ae43be1c6f41329d517014572ab";
        $client = new Services_Twilio($AccountSid, $AuthToken);
        foreach ($bookings as $book) {
            $sms = $client->account->messages->sendMessage(
                    // Step 6: Change the 'From' number below to be a valid Twilio number 
                    // that you've purchased, or the (deprecated) Sandbox number
                    "+61417892301",
                    // the number we are sending to - Any phone number
                    '+61' . substr($book->phone, 1),
                    // the sms body
                    "Hey $book->first_name, Don't forget your Photo Shoot is tomorrow at " . $book->styling_call_time . '. See you soon!'
            );
        }

        return;
    }

    public static function getAllNotifications($id) {
        global $wpdb;
        $notifications = $wpdb->get_results('SELECT * FROM wp3_touchpoint_emails WHERE `status` != "deleted" AND booking_id =' . $id . ' ORDER BY send_date');
        return $notifications;
    }
    
    public static function getAllNotes($id) {
        global $wpdb;
        $notes = $wpdb->get_results('SELECT * FROM wp3_touchpoint_notes WHERE booking_id =' . $id . ' ORDER BY time');
        return $notes;
    }
    
    public static function getAllTouchpoints($id) {
        global $wpdb;
        $touchpoints = $wpdb->get_results('SELECT * FROM wp3_touchpoints');
        return $touchpoints;
    }

    public static function updateNotification($newDate, $type, $bookingID) {
        global $wpdb;

        $data = array('send_date' => date('Y-m-d h:i:s', strtotime($newDate)));
        $where = array('booking_id' => $bookingID, 'type' => $type);
        $update = $wpdb->update('wp3_touchpoint_emails', $data, $where);
        if ($update) {
            return '<div class="alert-success">Your changes have been saved.</div>';
        }
        return '<div class="alert-error">An error has occured, please try again.</div>';
    }

    public static function emailsToSend() {
        global $wpdb;

        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Australia/Sydney'));
        $now->modify('+1 hour');
        //echo $now->format('Y-m-d H');

        $emailsToSend = $wpdb->get_results('SELECT * FROM wp3_touchpoint_emails WHERE status = "pending" AND send_date < "' . $now->format('Y-m-d H:i:s') . '"');

        foreach ($emailsToSend as $email) {
            $type = $email->type;
            //$email->status = 'sent';

            $data = array('status' => 'triggered');
            $where = array('id' => $email->id);
            $update = $wpdb->update('wp3_touchpoint_emails', $data, $where);

//            switch ($type) {
//                case '5 Fundamentals of Photo Shoot Styling':
//                    TouchPointsEmail::fiveFundamentals($email->booking_id);
//                    break;
//                case 'A Mums Guide to Styling a Family Photo Shoot':
//                    TouchPointsEmail::mumsGuide($email->booking_id);
//                    break;
//                case 'All - Happy Video':
//                    TouchPointsEmail::happiestVideo($email->booking_id);
//                    break;
//                case 'All - Styling text 1':
//                    TouchPointsText::stylingText1($email->booking_id);
//                    break;
//                case 'Booked Dancers':
//                    TouchPointsEmail::bookedDancers($email->booking_id);
//                    break;
//                case 'Booked Family with Kids':
//                    TouchPointsEmail::bookedFamilyKids($email->booking_id);
//                    break;
//                case 'Booked Fitness Guys':
//                    TouchPointsEmail::bookedFitnessGuys($email->booking_id);
//                    break;
//                case 'Booked Fitness Ladies':
//                    TouchPointsEmail::bookedFitnessLadies($email->booking_id);
//                    break;
//                case 'Booked Guys':
//                    TouchPointsEmail::bookedGuys($email->booking_id);
//                    break;
//                case 'Booked Ladies Fashion':
//                    TouchPointsEmail::bookedLadiesFashion($email->booking_id);
//                    break;
//                case 'Booked Ladies Modelling':
//                    TouchPointsEmail::bookedLadiesModelling($email->booking_id);
//                    break;
//                case 'Booked Little Miss Fashion':
//                    TouchPointsEmail::bookedLittleMissFashion($email->booking_id);
//                    break;
//                case 'Booked Male Modelling':
//                    TouchPointsEmail::bookedMaleModelling($email->booking_id);
//                    break;
//                case 'Booked Older Ladies':
//                    TouchPointsEmail::bookedOlderLadies($email->booking_id);
//                    break;
//                case 'Booked Teen Fashion':
//                    TouchPointsEmail::bookedTeenFashion($email->booking_id);
//                    break;
//                case 'Fun Prop Ideas for a Ballet Photo Shoot':
//                    TouchPointsEmail::funPropIdeas($email->booking_id);
//                    break;
//                case 'Model Poses to Practice for Your Photo Shoot':
//                    TouchPointsEmail::modelPoses($email->booking_id);
//                    break;
//                case 'Preparation for a fitness photo shoot':
//                    TouchPointsEmail::prepFitness($email->booking_id);
//                    break;
//                case 'Spot the Difference - Before & After Retouched Photos':
//                    TouchPointsEmail::spotDifference($email->booking_id);
//                    break;
//                case 'Top 10 Staples for a Guys Photo Shoot':
//                    TouchPointsEmail::staplesGuys($email->booking_id);
//                    break;
//                case 'Top 10 Trends for a Teen Fashion Shoot':
//                    TouchPointsEmail::staplesTeens($email->booking_id);
//                    break;
//            }
            
            $touchpoint = $wpdb->get_results('SELECT * FROM wp3_touchpoints WHERE `name` = "' . $type . '"');
                        
            if($touchpoint[0]->type == 'email') {
                TouchPointsEmail::touchPointMaster($email->booking_id, $touchpoint[0]->emailID);
                
                $notes = $touchpoint[0]->name;
                TouchPoint::logUpdate($email->booking_id, 'email', $notes);
                
                $data = array('status' => 'sent');
                $where = array('id' => $email->id);
                $update = $wpdb->update('wp3_touchpoint_emails', $data, $where);
            } elseif ($type == 'All - Styling text 1') {
                TouchPointsText::stylingText1($email->booking_id);
            }
            
        }
    }

    public static function addBookerRole() {
        remove_role('booker');
        $result = add_role(
                'booker', __('Booker'), array(
            'read' => true,
            'edit_posts' => false,
            'delete_posts' => false,
                )
        );
        if (null !== $result) {
            echo 'Yay! New role created!';
        } else {
            echo 'Oh... the role already exists.';
        }
    }

    public static function addStylistRole() {
        remove_role('stylist');
        $result = add_role(
                'stylist', __('Stylist'), array(
            'read' => true,
            'edit_posts' => false,
            'delete_posts' => false,
                )
        );
        if (null !== $result) {
            echo 'Yay! New role created!';
        } else {
            echo 'Oh... the role already exists.';
        }
    }

    public static function addBookerCapability() {
        $booker = get_role('booker');
        $booker->add_cap('add_tps_booking');

        $stylist = get_role('stylist');
        $stylist->add_cap('add_tps_booking');

        $admin = get_role('administrator');
        $admin->add_cap('add_tps_booking');
    }

    public static function getChanges($id) {
        global $wpdb;

        $changes = $wpdb->get_results('SELECT * FROM wp3_touchpoint_history WHERE booking_ID =' . $id);
        return $changes;
    }

    public static function recalcDates() {
        global $wpdb;
        
        //get all notifications on page and put into $list array
        $data = $_POST;
        foreach ($data as $key => $value) {
            if (strpos($key, "schedule-date_") === 0) {
                $id = substr($key, 14);
                $list[$id] = $value;
            }
        }
        
        //also get all notifications from database
        $notifications = TouchPoint::getAllNotifications($data['id']);
        foreach($notifications as $n) {
            $master[$n->id] = $n->status;
        }
                
        //check against $notifications to see if it's pending
        //if not, remove from $list
        foreach($list as $key => $value) {
            if($master[$key] != 'pending') {
                unset($list[$key]);
            }
        }

        //count items in list
        $count = count($list);

        //calculate gap
        $today = strtotime("today");
        $book_date = strtotime($data['booking-styling-call-date']);

        $difference = $book_date - $today;
        $gap = $difference / ($count + 1);
                
        //set a $i
        $a = 1;
        //foreach $list as $l
        foreach($list as $key => $value) {
            $updateData = array(
                'send_date' => date('Y-m-d H:i:s', $today + ($a * $gap)),
            );
            $where = array('id' => $key);
            $wpdb->update('wp3_touchpoint_emails', $updateData, $where); 
            $a++;
        }
        
        //start again
        $newNot = TouchPoint::getAllNotifications($data['id']);
        
        $output = '';
        $i = 1;
        foreach ($newNot as $n) {
            switch ($n->status) {
                case 'sent':
                    $status = "Sent";
                    break;
                case 'pending':
                    $status = "Pending";
                    break;
                case 'cancelled':
                    $status = "Cancelled";
                    break;
            }
            $date = new DateTime($n->send_date);
            $dateprint = $date->format('d-m-Y');
            //echo $n->status;
            $readonly = '';
            if($n->status != 'pending'){$readonly = "readonly";} ;
            $output .= '
            <ul class="schedule-details ui-state-default" data-index-number="'. $i .'" data-touchpoint-id="'. $n->id .'">
                <li><label>Customer notification Name</label><div>'. $n->type .'</div></li>
                <li><label>Schedule</label><div><span>'. $status .'</span><input type="text" class="datepicker"  name="schedule-date_'. $n->id .'" value="'. $dateprint .'" ' . $readonly . '></div></li>
                <li><label>Actions</label><div>
                        <ul class="actions">
                            <li class="remove" data-touchpoint-id="'. $i .'"><input type="checkbox" id="deleted_'. $n->id .'" name="deleted_'. $n->id .'"><label for="deleted_'. $n->id .'"><i class="fa fa-trash-o"></i>Delete</label></li>
                            <li><i class="fa fa-arrows"></i></li>
                        </ul></div>
                </li>
            </ul>';
            $i++;
        }
        
        
        die(json_encode(array(
            'success' => 1,
            'data' => $output,
        )));

    }
    
    public static function cancelBooking() {

        global $wpdb;
        $id = $_POST['id'];
        $uid = get_current_user_id();
        
        //send cancellation email
        
        //cancellation email ID from Campaign Monitor
        $emailID = '1a9c5a18-9c2a-4c67-923a-816089bbc756';
        
        //send email function
        TouchPointsEmail::touchPointMaster($id, $emailID);
        
        //update the booking
        $data = array(
            'status' => 'cancelled',
            'styling_call_date' => '',
        );
        $where = array('id' => $id);
        $wpdb->update('wp3_touchpoint_bookings', $data, $where); 
        
        //set all emails for that booking to cancelled
        $emaildata = array(
            'status' => 'cancelled',
            'send_date' => '',
        );
        $emailwhere = array(
            'booking_id' => $id,
            'status' => 'pending',
        );
        $wpdb->update('wp3_touchpoint_emails', $emaildata, $emailwhere); 
        
        TouchPoint::logUpdate($id, 'cancel');
        
        die(json_encode(array(
            'success' => 1,
        )));
    }
    
    public static function pauseBooking() {

        global $wpdb;
        $id = $_POST['id'];
        $uid = get_current_user_id();
        
        //pause email ID from Campaign Monitor
        $emailID = 'e9b209bb-4956-4a07-ac91-6fc5e1383578';
        
        //send email function
        TouchPointsEmail::touchPointMaster($id, $emailID);
        
        //update the booking
        $data = array(
            'status' => 'paused',
            'styling_call_date' => '',
        );
        $where = array('id' => $id);
        $wpdb->update('wp3_touchpoint_bookings', $data, $where); 
        
        //set all emails for that booking to cancelled
        $emaildata = array(
            'status' => 'paused',
        );
        $emailwhere = array(
            'booking_id' => $id,
            'status' => 'pending',
            );
        $wpdb->update('wp3_touchpoint_emails', $emaildata, $emailwhere); 
        
        TouchPoint::logUpdate($id, 'pause');
        
        die(json_encode(array(
            'success' => 1,
        )));
    }

    public static function getTouchpointNames() {
        global $wpdb;
        $touchpoints = $wpdb->get_results('SELECT * FROM  `wp3_touchpoints` ORDER BY name');
        
        $output = array();
        foreach($touchpoints as $t) {
            $output[$t->id] = $t->name;
        }
        
            return $output;
    }
    
    public static function getTouchpointNamesAutocomplete() {
        global $wpdb;
        $touchpoints = $wpdb->get_results('SELECT * FROM  `wp3_touchpoints` ORDER BY name');
        
        $output = array();
        foreach($touchpoints as $t) {
            $output[] = $t->name;
        }
        
        return $output;
    }
 
    public static function addTouchpoint() {
        global $wpdb;
        $data = $_POST;
        
        $updateData = array(
            'booking_id' => $data['id'],
            'send_date' => '',
            'type' => $data['type'],
            'status' => 'pending',
        );
        $wpdb->insert('wp3_touchpoint_emails', $updateData);
        $emailid = $wpdb->insert_id;
        
        die(json_encode(array(
            'success' => 1,
            'data' => $emailid,
        )));
    }
    
    public static function getEmails() {
        global $wpdb;
        
        $auth = array('api_key' => '53133f274fa32da118be14542dee7e5390bb21cf7599216c');
        $wrap = new CS_REST_Transactional_SmartEmail('', $auth);
        $emails = $wrap->get_list(array(
            'status' => 'all',
        ));
        
        foreach($emails->response as $email) {
            $exists = $wpdb->get_results('SELECT id FROM  `wp3_touchpoints` where emailID = "' . $email->ID . '"');
            if(empty($exists)) {                
                $updateData = array(
                    'name' => $email->Name,
                    'shortname' => preg_replace("/[^a-zA-Z]+/", "", $email->Name),
                    'type' => 'email',
                    'emailID' => $email->ID,
                    'lastModified' => date('Y-m-d H:i:s'),
                );
                $wpdb->insert('wp3_touchpoints', $updateData);                                
            }
        }        
    }
    
}