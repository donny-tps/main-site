<div class="white-wrap">
    <h1>Vote Export</h1>
    <h2>Export by date</h2>
    <div class="export-form">
        <form method="GET" action="/wp-content/themes/photostudio/library/classes/reporting/order-export.php">
            <label>Start Date</label>
            <input type="date" name="start-date" value="<?php echo date('Y-m-j'); ?>" placeholder="<?php echo date('Y-m-j'); ?>">
            <label>End Date</label>
            <input type="date" name="end-date" value="<?php echo date('Y-m-j'); ?>" placeholder="<?php echo date('Y-m-j'); ?>">
            <button type="submit">Export Votes</button>
        </form>
    </div>
    <h2>or export by event</h2>
    <div class="export-form">
        <form method="GET" action="/wp-content/themes/photostudio/library/classes/reporting/order-export.php">
            <select name="name">
                <?php
                global $wpdb;
                $events = $wpdb->get_results('SELECT DISTINCT eventname FROM tps_votes');

                foreach ($events as $event) {
                    if (!$event->eventname == '') {
                        echo '<option value="' . $event->eventname . '">' . $event->eventname . '</option>';
                    }
                };
                ?>
            </select>
            <button type="submit">Export Votes</button>
        </form>
    </div>
</div>