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
                <h3><b>Touchpoint Groups</b></h3>
            </div>
            <div class="head-buttons">
                <a class="add-new-booking" href="?page=tps-touch-point">Edit Bookings</a>
                <a class="add-new-booking" href="?page=tps-touch-point&tab=group-add">Add new group</a>
            </div>
            <div class="list-of-bookings groups-list">
                <ul class="list-heading">
                    <li>Group Name</li>
                    <li>Last Modified</li>
                    <li>Actions</li>
                </ul>

                <?php

                $postsPerPage = 10;
                $offset = ($pageNo - 1)*10;
                
                $groups = TouchPoint::getGroupsPaginate($postsPerPage, $offset);
                //debug_dump($groups);
                foreach ($groups as $group) {
                    
                    echo <<<EOT
                    <ul class="list-content">
                        <li><label>Group Name</label><div>{$group->name}</div></li>
                        <li><label>Last Modified</label><div>{$group->modified}</div></li>
                        <li><label>Actions</label><div><a href="?page=tps-touch-point&tab=group-view&id={$group->id}" title="View Booking">View &amp; Edit</a></div></li>
                    </ul>                       
EOT;
                }
                ?>		

            </div> <!-- end of list-of-bookings -->            
            <div class="pagination">
                <?php
                    $lastPage = ceil((TouchPoint::getGroupsCount() / $postsPerPage));

                    $uid = '';
                    if($_GET['uid']) {
                        $uid = "&uid=" . $_GET['uid'];
                    }

                    if($pageNo > 1) {
                        echo '<a href="/wp-admin/admin.php?page=tps-touch-point&tab=group-list' . $uid . '&pageNo=' . ($pageNo - 1) . '"><i class="fa fa-chevron-left"></i></a> ';
                    }
                    echo "Page " . $pageNo . " of " . $lastPage;
                    if($pageNo < $lastPage) {
                        echo ' <a href="/wp-admin/admin.php?page=tps-touch-point&tab=group-list' . $uid . '&pageNo=' . ($pageNo + 1) . '"><i class="fa fa-chevron-right"></i></a>';
                    }
                        ?>
            </div>
        </div> <!-- end of container -->
    </section>
</div>