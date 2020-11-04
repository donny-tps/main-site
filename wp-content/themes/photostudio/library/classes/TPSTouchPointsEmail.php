<?php

class TouchPointsEmail {

//    public static function touchPointEmail($emailID, $to, $data) {
//
//        $auth = array('api_key' => '53133f274fa32da118be14542dee7e5390bb21cf7599216c');
//
//        # The unique identifier for this smart email
//        $smart_email_id = $emailID;
//        $data['x-apple-data-detectors'] = 'x-apple-data-detectorsTestValue';
//
//        # Create a new mailer and define your message
//        $wrap = new CS_REST_Transactional_SmartEmail($smart_email_id, $auth);
//        $message = array(
//            "To" => $to,
//            "Data" => $data,
//        );
//
//        # Send the message and save the response
//        $result = $wrap->send($message);
//    }
    
//     public static function sendAnEmail() {
//         $booking = '69';
//         $booker = get_user_meta($booking->booker_id);

//         $to = 'Michael Busuttil <michael.a.busuttil@gmail.com>';
        
// //        $personalisedMessage = '';
// //        if($booking->message != '') {
// //            $personalisedMessage = $booking->message;
// //        }
        
//         //$shootDate = new DateTime($booking->shoot_date);
        
//         $data = array(
//             'from_name' => 'Michael Busuttil',
//             'from_email' => 'info@thephotostudio.com.au',
//             'reply_to' => 'info@thephotostudio.com.au',
//             'guest_name' => Michael1,
//             'shoot_date' => 'Sunday 5th June',
//             'stylist_name' => 'Michael Busuttil',
//             'booker_number' => "0400 000 000",
//             'booker_email' => 'michael@clickersonline.com.au',
//             'booker_name' => 'Michael Busuttil',
//             'message' => 'This is a personalised message.',
//         );
        
//         $auth = array('api_key' => '53133f274fa32da118be14542dee7e5390bb21cf7599216c');

//         # The unique identifier for this smart email
//         $smart_email_id = '926a69e2-30bf-4afc-8a74-3deb48e60708';
//         $data['x-apple-data-detectors'] = 'x-apple-data-detectorsTestValue';

//         # Create a new mailer and define your message
//         $wrap = new CS_REST_Transactional_SmartEmail($smart_email_id, $auth);
//         $message = array(
//             "To" => $to,
//             "Data" => $data,
//         );

// //        debug_dump($id);
// //        debug_dump($emailID);
// //        debug_dump($booking);
// //        debug_dump($data);
// //        debug_dump($auth);
// //        debug_dump($message);
        
//         # Send the message and save the response
//         $result = $wrap->send($message);

//                 debug_dump($id);
//                 debug_dump($result);
//                 die();
//     }
    
    public static function touchPointMaster($id, $emailID) {
        $booking = TouchPoint::getBooking($id);
        $booker = get_user_meta($booking->booker_id);

        # The unique identifier for this smart email
        $to = $booking->first_name . ' <' . $booking->email . '>';
        
        $personalisedMessage = '';
        if($booking->message != '') {
            $personalisedMessage = $booking->message;
        }
        
        $shootDate = new DateTime($booking->shoot_date);
        
        $data = array(
            'from_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
            'from_email' => get_userdata($booking->booker_id)->user_email,
            'reply_to' => get_userdata($booking->booker_id)->user_email,
            'guest_name' => $booking->first_name,
            'shoot_date' => $shootDate->format('l jS F'),
            'stylist_name' => get_user_by('id', $booking->stylist_name)->display_name,
            'booker_number' => $booker['phone_number'][0],
            'booker_email' => get_userdata($booking->booker_id)->user_email,
            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
            'message' => $personalisedMessage,
        );
        
        $auth = array('api_key' => '53133f274fa32da118be14542dee7e5390bb21cf7599216c');

        # The unique identifier for this smart email
        $smart_email_id = $emailID;
        $data['x-apple-data-detectors'] = 'x-apple-data-detectorsTestValue';

        # Create a new mailer and define your message
        $wrap = new CS_REST_Transactional_SmartEmail($smart_email_id, $auth);
        $message = array(
            "To" => $to,
            "Data" => $data,
        );

//        debug_dump($id);
//        debug_dump($emailID);
//        debug_dump($booking);
//        debug_dump($data);
//        debug_dump($auth);
//        debug_dump($message);
        
        # Send the message and save the response
        $result = $wrap->send($message);

        // debug_dump($id);
        // debug_dump($result);
        // die();
        
    }

    // public static function fiveFundamentals($id) {
    //     $booking = TouchPoint::getBooking($id);
    //     $booker = get_user_meta($booking->booker_id);

    //     # The unique identifier for this smart email
    //     $to = $booking->first_name . ' <' . $booking->email . '>';
    //     $emailID = '926a69e2-30bf-4afc-8a74-3deb48e60708';
    //     $data = array(
    //         'guest_name' => $booking->first_name,
    //         'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
    //     );

    //     TouchPointsEmail::touchPointEmail($emailID, $to, $data);
    // }
//
//    public static function mumsGuide($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $emailID = 'fd6cd195-6f95-42b8-9ea6-479df03c1c9b';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function bookedDancers($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $shootDate = new DateTime($booking->shoot_date);
//        
//        $emailID = '146765f6-2648-4091-9ef4-ff0a382b3002';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'shoot_date' => $shootDate->format('l jS F'),
//            'stylist_name' => $booking->stylist_name,
//            'booker_number' => $booker['phone_number'][0],
//            'booker_email' => get_userdata($booking->booker_id)->user_email,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function bookedFamilyKids($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $shootDate = new DateTime($booking->shoot_date);
//        
//        $emailID = 'f129b978-3bb3-46c1-97a1-96dd1866f636';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'shoot_date' => $shootDate->format('l jS F'),
//            'booker_email' => get_userdata($booking->booker_id)->user_email,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function bookedFitnessGuys($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $shootDate = new DateTime($booking->shoot_date);
//        
//        $emailID = '785c20ee-d572-4872-b2b7-c54e3e7b0714';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'shoot_date' => $shootDate->format('l jS F'),
//            'booker_email' => get_userdata($booking->booker_id)->user_email,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function bookedFitnessLadies($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $shootDate = new DateTime($booking->shoot_date);
//        
//        $emailID = '7ba05329-8c3b-4c57-b424-62bef0ac43ed';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'shoot_date' => $shootDate->format('l jS F'),
//            'booker_email' => get_userdata($booking->booker_id)->user_email,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function bookedGuys($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $shootDate = new DateTime($booking->shoot_date);
//        
//        $emailID = '79193e09-d6bb-42f1-a6d5-e131433b5cbf';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'shoot_date' => $shootDate->format('l jS F'),
//            'booker_email' => get_userdata($booking->booker_id)->user_email,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function bookedLadiesFashion($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $shootDate = new DateTime($booking->shoot_date);
//        
//        $emailID = '85647542-914d-47da-815b-44e5f5e6b03d';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'shoot_date' => $shootDate->format('l jS F'),
//            'booker_email' => get_userdata($booking->booker_id)->user_email,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function bookedLadiesModelling($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $shootDate = new DateTime($booking->shoot_date);
//        
//        $emailID = '147b1f32-9623-4d69-b965-40394e4dd884';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'shoot_date' => $shootDate->format('l jS F'),
//            'booker_email' => get_userdata($booking->booker_id)->user_email,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function bookedLittleMissFashion($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $shootDate = new DateTime($booking->shoot_date);
//        
//        $emailID = 'd84bbf7f-0d3c-4a27-adee-2e112917d291';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'shoot_date' => $shootDate->format('l jS F'),
//            'booker_email' => get_userdata($booking->booker_id)->user_email,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function bookedMaleModelling($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $shootDate = new DateTime($booking->shoot_date);
//        
//        $emailID = '550c92d6-85ae-43e4-902d-548ca062c8d5';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'shoot_date' => $shootDate->format('l jS F'),
//            'booker_email' => get_userdata($booking->booker_id)->user_email,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function bookedOlderLadies($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $shootDate = new DateTime($booking->shoot_date);
//        
//        $emailID = '16138a84-fbea-403a-933e-bd9ca43a61e7';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'shoot_date' => $shootDate->format('l jS F'),
//            'booker_email' => get_userdata($booking->booker_id)->user_email,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function bookedTeenFashion($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $shootDate = new DateTime($booking->shoot_date);
//        
//        $emailID = '29412a56-688c-4d58-ac33-c0bb6f58f6ed';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'shoot_date' => $shootDate->format('l jS F'),
//            'booker_email' => get_userdata($booking->booker_id)->user_email,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function funPropIdeas($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $emailID = 'd1c70d29-30ef-4b43-ade8-675e7eb7c424';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function modelPoses($id) {
//        $booking = TouchPoint::getBooking($id);
//        //$booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $emailID = '82b504b4-4edb-421c-81c7-4dce76116873';
//        $data = array(
//            'insert name' => $booking->first_name,
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function prepFitness($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $emailID = 'e0524576-77d9-4336-9496-a91fa2322ee8';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function spotDifference($id) {
//        $booking = TouchPoint::getBooking($id);
//        //$booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $emailID = '4579d957-f1ed-48c7-a648-a44cf87a3011';
//        $data = array(
//            'guest_name' => $booking->first_name,
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function staplesGuys($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $emailID = 'd1f6e97a-02e9-48cb-abbd-d978d430c607';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//
//    public static function staplesTeens($id) {
//        $booking = TouchPoint::getBooking($id);
//        $booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $emailID = '3c2b095c-c7b8-46c0-93df-2edba734a0e1';
//        $data = array(
//            'guest_name' => $booking->first_name,
//            'booker_name' => $booker['first_name'][0] . ' ' . $booker['last_name'][0],
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }
//    
//    public static function happiestVideo($id) {
//        $booking = TouchPoint::getBooking($id);
//        //$booker = get_user_meta($booking->booker_id);
//
//        # The unique identifier for this smart email
//        $to = $booking->first_name . ' <' . $booking->email . '>';
//        
//        $emailID = '7c73f6cf-df6e-4fb9-8c48-a1a15ad395b6';
//        $data = array(
//            'guest_name' => $booking->first_name,
//        );
//        
//        TouchPointsEmail::touchPointEmail($emailID, $to, $data);
//    }

}