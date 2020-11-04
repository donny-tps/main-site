<?php
//if (!defined('ABSPATH'))
//    exit; // Exit if accessed directly
define('WP_USE_THEMES', false);
require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
/* debug: send post data to email */
//$message = '';
//foreach($_POST as $key => $value) {
//    $message .= '<strong>' . $key . '</strong>: ' . $value . '<br>';
//}
//
//mail('michael@clickersonline.com.au', 'text data', $message);

global $wpdb;

$phone = $_POST['From'];
//strip out country code
$phoneSearch = substr($phone, 4);
$message = $_POST['Body'];

//use GET to test without sending texts - add ?From=&Body= to URL
/*$phone = $_GET['From'];
//strip out country code
$phoneSearch = substr($phone, 4);
$message = $_GET['Body'];*/

$booking = $wpdb->get_row('SELECT * FROM  `wp3_touchpoint_bookings` where phone LIKE "%' . $phoneSearch . '"');

//log message in database
$data = array(
    'booking_id' => $booking->id,
    'time' => date("Y-m-d H:i:s"),
    'source' => 'text',
    'message' => $message,
);
$wpdb->insert('wp3_touchpoint_notes', $data);

//send email to booker
$bookerEmail = get_userdata($booking->booker_id)->user_email;
$subject = "Text reply from " . $booking->first_name . ' ' . $booking->last_name;
$email = $booking->first_name . ' ' . $booking->last_name . ' replied to an automated text message with the following: "' . $message . '" at ' . date("Y-m-d H:i:s") . '. View the booking at https://thephotostudio.com.au/wp-admin/admin.php?page=tps-touch-point&tab=booking-view&id=' . $booking->id . '.';

mail($bookerEmail, $subject, $email)
?>
<?php
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; ?>
<Response>
    <Message>Your booking consultant has been notified and will get in touch soon.</Message>
</Response>