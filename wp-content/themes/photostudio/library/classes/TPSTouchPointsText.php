<?php

class TouchPointsText {

    public static function touchPointText($to, $message) {
        $AccountSid = "AC93b991c75455bbc79934f6d5baaba307";
        $AuthToken = "9ec115656b9ed90ccc6d7f828c430f47";
        $client = new Services_Twilio($AccountSid, $AuthToken);
        $sms = $client->account->messages->sendMessage(
                // Step 6: Change the 'From' number below to be a valid Twilio number 
                // that you've purchased, or the (deprecated) Sandbox number
                "+61481071692",
                // the number we are sending to - Any phone number
                $to,
                // the sms body
                $message
        );

        return;
    }
    
    public static function stylingText1($id) {
        global $wpdb;
        $booking = TouchPoint::getBooking($id);
                
        $to = '+61' . substr($booking->phone, 1);
        //$message = 'NAME: ' . $booking->first_name . ' STYLIST: ' . $booking->stylist_name;
        $message = "Hi " . $booking->first_name . ", We hope you're excited for your photo shoot! Just a heads up that our stylist " . get_user_by('id', $booking->stylist_name)->display_name . " will call you in the next few days to confirm your session time and run over styling ideas for your shoot. It’s a good idea to gather reference shots so that our creative team get a visual of what looks you want to go for in your shoot. Feel free to check out our Pinterest page for some styling inspiration - https://au.pinterest.com/TPSAU/ Love from TPS Gang x";

        touchPointsText::touchPointText($to, $message);
    }

}