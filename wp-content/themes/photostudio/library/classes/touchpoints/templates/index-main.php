<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $current_user;
get_currentuserinfo();

$pageNo = 1;
if($_GET['pageNo']) {
    $pageNo = $_GET['pageNo'];
}
?>

<div class="july-2016-wp-pages">
    <section>
        <div class="container">
            <div class="heading">
                <h3>Hi, <b><?php echo $current_user->user_firstname; ?></b>. You've booked<b class="count"><?php echo TouchPoint::getBookingCount(); ?></b>jobs this month.</h3>
            </div>
            <div class="head-buttons">
                <a class="add-new-booking" href="?page=tps-touch-point&tab=group-list">Edit Groups</a>
                <a class="add-new-booking" href="?page=tps-touch-point&tab=booking-add">Add new booking</a>

                <div class="select-container">
                    <span>Viewing:</span>
                    <select name="viewing" id="viewing">
                        <?php
                            if($_GET['uid'] != 'all' ) { ?>
                                <option value="/wp-admin/admin.php?page=tps-touch-point&uid=<?php echo get_current_user_id(); ?>&pageNo=1">Just my bookings</option>
                                <option value="/wp-admin/admin.php?page=tps-touch-point&uid=all&pageNo=1">All bookings</option>
                            <?php } else { ?>
                                <option value="/wp-admin/admin.php?page=tps-touch-point&uid=all&pageNo=1">All bookings</option>
                                <option value="/wp-admin/admin.php?page=tps-touch-point&uid=<?php echo get_current_user_id(); ?>&pageNo=1">Just my bookings</option>
                            <?php }
                        ?>
                        
                    </select>
                </div>
            </div>
            <div class="list-of-bookings">
                <ul class="list-heading">
                    <li>Customer Name</li>
                    <li>Styling Call</li>
                    <li>Date Booked</li>
                    <li>Booked by</li>
                    <li>Actions</li>
                </ul>

                <?php

                $postsPerPage = 10;
                $offset = ($pageNo - 1)*10;
                
                if($_GET['uid'] == 'all') {
                    $bookingId = 'all';
                } else {
                    $bookingId = get_current_user_id();
                }
                
                $bookings = TouchPoint::getAllBookings($bookingId, $postsPerPage, $offset);
                foreach ($bookings as $book) {
                    
                    $theDate = new DateTime($book->creation_date);
                    
                    switch($book->status) {
                        case "cancelled":
                            $callDate = 'Cancelled';
                            break;
                        case "paused":
                            $callDate = 'Paused';
                            break;
                        default:
                            $callDate0 = new DateTime($book->styling_call_date);
                            $callDate = $callDate0->format('Y-m-d');
                            break;
                    }
                    
                    $bookedBy = get_user_by('id', $book->booker_id);
                    echo <<<EOT
                    <ul class="list-content">
                        <li><label>Customer Name</label><div>{$book->first_name} {$book->last_name}</div></li>
                        <li><label>Styling call</label><div>{$callDate}</div></li>
                        <li><label>Date Booked</label><div>{$theDate->format('Y-m-d')}</div></li>
                        <li><label>Booked by</label><div>{$bookedBy->display_name}</div></li>
                        <li><label>Actions</label><div><a href="?page=tps-touch-point&tab=booking-view&id={$book->id}" title="View Booking">View &amp; Edit</a></div></li>
                    </ul>                       
EOT;
                }
                ?>		

            </div> <!-- end of list-of-bookings -->            
            <div class="pagination">
                <?php
                    $lastPage = ceil((TouchPoint::getTotalBookings() / $postsPerPage));

                    $uid = '';
                    if($_GET['uid']) {
                        $uid = "&uid=" . $_GET['uid'];
                    }

                    if($pageNo > 1) {
                        echo '<a href="/wp-admin/admin.php?page=tps-touch-point' . $uid . '&pageNo=' . ($pageNo - 1) . '"><i class="fa fa-chevron-left"></i></a> ';
                    }
                    echo "Page " . $pageNo . " of " . $lastPage;
                    if($pageNo < $lastPage) {
                        echo ' <a href="/wp-admin/admin.php?page=tps-touch-point' . $uid . '&pageNo=' . ($pageNo + 1) . '"><i class="fa fa-chevron-right"></i></a>';
                    }
                        ?>
            </div>
        </div> <!-- end of container -->
    </section>
</div>
