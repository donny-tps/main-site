<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
if (isset($_GET['notification-date'])) {
    $message = TouchPoint::updateNotification($_GET['notification-date'], $_GET['notification-type'], $_GET['id']);
}

$booking = TouchPoint::getBooking($_GET['id']);
$booker = get_user_meta($booking->booker_id);
$notifications = TouchPoint::getAllNotifications($booking->id);
$notes = TouchPoint::getAllNotes($booking->id);
$changes = TouchPoint::getchanges($booking->id);
$message = '';

?>
<div class="july-2016-wp-pages">
    <section>
        <div class="container">
            <div class="full-width">
                <?php 
                    switch ($booking->status) {
                        case 'cancelled':
                            echo '<h3><b><span style="color: #9c2121;">Cancelled Booking</span> for '. $booking->first_name . ' ' . $booking->last_name .'</b> Edit Touchpoint Process</h3>';
                            break;
                        case 'paused':
                            echo '<h3><b><span style="color: #9c2121;">Paused Booking</span> for '. $booking->first_name . ' ' . $booking->last_name .'</b> Edit Touchpoint Process</h3>';
                            break;
                        default: 
                            echo '<h3><b>Edit Booking for '. $booking->first_name . ' ' . $booking->last_name .'</b> Edit Touchpoint Process</h3>';
                            break;
                    }
                ?>
            </div>
            <form name="touchpoint-form" id="touchpoint-form" action="?page=tps-touch-point&tab=booking-view&id=<?php echo $_GET['id']; ?>&action=update-booking" class="list-of-touchpoints" method="POST" onsubmit="return validateBooking()" method="POST">
                <div id="touchpoint-validation" class="touchpoint-validation"></div>
                <ul class="customer-heading">
                    <li>Name</li>
                    <li>Email</li>
                    <li>Phone Number</li>
                </ul>
                <ul class="customer-details">
                    <li><label>First Name</label><div><input type="text" name="booking-first-name" value="<?php echo stripslashes($booking->first_name); ?>"></div></li>
                    <li><label>Last Name</label><div><input type="text" name="booking-last-name" value="<?php echo stripslashes($booking->last_name); ?>"></div></li>
                    <li><label>Email</label><div><input type="email" name="booking-email" value="<?php echo $booking->email; ?>"></div></li>
                    <li><label>Phone</label><div><input type="text" name="booking-mobile" value="<?php echo $booking->phone; ?>"></div></li>
                </ul>

                <ul class="booking-headings">
                    <li>Booked by</li>
                    <li>Styling date</li>
                    <li>Styling time</li>
                    <li>Shoot date</li>
                    <li>Stylist</li>
                    <li>Actions</li>
                </ul>
                <ul class="booking-details">
                    <li class="bookedBy"><label>Booked by</label><div><?php echo get_user_by('id', $booking->booker_id)->display_name; ?></div></li>
                    <li><label>Styling date</label><div><input class="datepicker" type="text" name="booking-styling-call-date" placeholder="<?php echo $booking->styling_call_date ?>" value="<?php $bookingDate = new DateTime($booking->styling_call_date);
echo $bookingDate->format('d-m-Y');
?>"></div></li>
                    <li><label>Styling time</label><div><input type="text" name="styling-call-time" value="<?php echo $booking->styling_call_time; ?>"></div></li>
                    <li><label>Shoot date</label><div><input class="datepicker" type="text" name="booking-shoot-date" placeholder="<?php echo $booking->shoot_date ?>" value="<?php $shootDate = new DateTime($booking->shoot_date);
                                                             echo $shootDate->format('d-m-Y'); ?>"></div></li>
                    <li><label>Stylist</label><div>
                            <select name="booking-stylist-name">
                                <option value="<?php echo $booking->stylist_name; ?>"><?php echo get_user_by('id', $booking->stylist_name)->display_name; ?></option>
                                <?php
                                $stylists = get_users(array(
                                    'role' => 'stylist',
                                    'exclude' => array(
                                        $booking->stylist_name,
                                    )
                                ));
                                foreach ($stylists as $stylist) {
                                    echo '<option value="' . $stylist->ID . '">' . $stylist->display_name . '</option>';
                                }
                                ?>
                            </select></div></li>
                    <li><label>Actions</label><div><button type="button" id="pauseBooking">Pause</button> / <button type="button" id="cancelBooking">Cancel</button></div></li>
                </ul>

                <ul class="schedule-heading">
                    <li>Customer notification Name</li>
                    <li>Schedule</li>
                    <li>Actions</li>
                </ul>
                <div id="sortable" class="full-width">

                    <?php
                    $i = 1;
                    foreach ($notifications as $n) {
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
                            case 'paused':
                                $status = "Paused";
                                break;
                        }
                        ?>
                        <ul class="schedule-details ui-state-default" data-index-number="<?php echo $i; ?>" data-touchpoint-id="<?php echo $n->id; ?>">
                            <li><label>Customer notification Name</label><div><?php echo $n->type; ?></div></li>
                            <li><label>Schedule</label><div><span><?php echo $status; ?></span><input type="text" class="datepicker"  name="schedule-date_<?php echo $n->id; ?>" value="<?php $date = new DateTime($n->send_date);
                                                                                                  echo $date->format('d-m-Y');
                                                                                                  ?>" <?php if($n->status != 'pending'){echo "readonly";}?>></div></li>
                            <li><label>Actions</label><div>
                                    <ul class="actions">
                                        <?php if($n->status != 'sent') {?>
                                            <li class="remove" data-touchpoint-id="<?php echo $i; ?>"><input type="checkbox" id="deleted_<?php echo $n->id; ?>" name="deleted_<?php echo $n->id; ?>"><label for="deleted_<?php echo $n->id; ?>"><i class="fa fa-trash-o"></i>Delete</label></li>
                                        <?php }; ?>
                                        <li><i class="fa fa-arrows"></i></li>
                                    </ul></div>
                            </li>
                        </ul>
                        <?php
                        $i++;
                    }
                    ?>
                </div>
                <ul class="touchpoint-calculation">
                    <li>
                        <input type="text" id="addTouchpoint" placeholder="Type in the name of the email that you're looking to add..">
                    </li>
                    <li>
                        <button type="button" id="addTouchpointButton">Add touchpoint</button>
                    </li>
                    <li>
                        <button type="button" class="recalc">Re-calculate dates</button>
                    </li>
                </ul>
                
                <ul class="touchpoint-message">
                    <ul class="customer-heading">
                        <li>Message</li>
                    </ul>
                    <textarea name="message"><?php echo stripslashes($booking->message); ?></textarea>
                </ul>
                
                

                <ul class="touchpoint-buttons-area">
                    <li class="half-col">
                        <button type="button"><a href="/wp-admin/admin.php?page=tps-touch-point">Cancel &amp; go back to bookings</a></button>
                    </li>
                    <li class="half-col">
                        <button type="submit">Save touchpoint process</button>
                    </li>
                </ul>
            </form>
            <div class="history half-width">
                <h3>Booking history</h3>
                <ul class="booking-history">
                    <?php
                    foreach ($changes as $c) {

                        //checking status, setting output - switch case in case of future additions
                        $status = 'edited';
                        switch ($c->kind) {
                            case 'create':
                                $status = "created";
                                break;
                            case 'edit':
                                $status = "edited";
                                break;
                            case 'cancel':
                                $status = "cancelled";
                                break;
                            case 'paused':
                                $status = "paused";
                                break;
                        }

                        //cleaning up date
                        $date = new DateTime($c->date);

                        echo '<li>' . $date->format('d/m/Y g:ia') . ': ' . get_user_by('id', $c->user)->display_name . ' ' . $status . ' the booking.</li>';
                    }
                    ?>

                </ul>
            </div>
            <div class="notes half-width">
                <?php
                if($notes) {
                    echo '<h3>Notes</h3><ul>';
                    foreach($notes as $n) {
                        $date = new DateTime($n->time);
                        echo '<li>"' . $n->message . '" - Client text on ' . $date->format('d/m/y g:ia') . '.</li>';
                    }
                }

                ?>
            </div>
        </div>
    </section>
</div>