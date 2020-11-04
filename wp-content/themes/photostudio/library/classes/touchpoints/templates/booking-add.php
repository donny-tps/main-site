<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

    
//TouchPoint::emailsToSend();
?>
<div class="july-2016-wp-pages">
    <section>
        <div class="container">
            <div class="full-width">
                <h3><b>New Booking</b> Add customer details</h3>
            </div>
            <form name="newBooking" onsubmit="return validateForm()" method="POST" action="?page=tps-touch-point&action=add-booking" class="new-booking full-width">
                <div id="new-booking-validation" class="new-booking-validation"></div>

                <halfcol for="fname" class="half-col"><span>First name</span>
                    <input type="text" name="booking-first-name">
                </halfcol>
                <halfcol for="lname" class="half-col"><span>Last name</span>
                    <input type="text" name="booking-last-name">
                </halfcol>
                <col3 for="date" class="col-4"><span>Styling call date</span>
                    <input type="text" name="booking-styling-call-date" class="datepicker">
                </col3>
                <col3 for="time" class="col-4"><span>Styling call time</span>
                    <input type="text" name="booking-styling-call-time">
                </col3>
                <col3 for="date" class="col-4"><span>Shoot date</span>
                    <input type="text" name="booking-shoot-date" class="datepicker">
                </col3>
                <col3 for="stylist" class="col-4"><span>Stylist</span>
                    <div class="select-style1">
                        <select name="booking-stylist-name">
                            <option value="">Please Select</option>
                            <?php
                            $stylists = get_users(array(
                                'role' => 'stylist',
                            ));
                            //debug_dump($stylists);
                            foreach ($stylists as $stylist) {
                                echo '<option value="' . $stylist->ID . '">' . $stylist->display_name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </col3>
                <halfcol for="mobile_num" class="half-col"><span>Mobile number</span>
                    <input type="text" name="booking-mobile">
                </halfcol>
                <halfcol for="email" class="half-col"><span>Email address</span>
                    <input type="text" name="booking-email">
                </halfcol>
                <label for="cust_type" class="full-width"><span>Type of customer (this will determine default set of emails recieved)</span>
                    <div class="select-style1">
                        <select name="booking-type" id="">
                            <option value="">Please select</option>
                            
                            <?php $groups = TouchPoint::getGroups();
                            foreach($groups as $group) {
                                echo '<option value="' . $group->name . '">' . $group->name . '</option>';
                            } ?>
                            
<!--                            <option value="dancers">Dancers</option>
                            <option value="teenFashion">Teen Fashion</option>
                            <option value="ladiesModelling">Ladies Modelling</option>
                            <option value="familyWithKids">Family with Kids</option>
                            <option value="youngLadies">Young Ladies</option>
                            <option value="olderLadies">Older Ladies</option>
                            <option value="guys">Guys</option>
                            <option value="maleModelling">Male Modelling</option>
                            <option value="littleMissFashion">Little Miss Fashion</option>
                            <option value="fitnessLadies">Fitness Ladies</option>
                            <option value="fitnessGuys">Fitness Guys</option>-->
                        </select>
                    </div>
                </label>
                <label for="message" class="full-width"><span>Personalised message (optionally add in a message to be sent in the booking confirmation)</span>
                    <textarea class="full-width" name="message" id="" cols="30" rows="10" ></textarea>
                </label>
                <halfcol class="half-col">
                    <a href="/wp-admin/admin.php?page=tps-touch-point" class="but1">Back to all bookings</a>
                </halfcol>
                <halfcol class="half-col">
                    <button type="submit">Submit booking</button>
                </halfcol>
            </form>
        </div>
    </section>

</div>