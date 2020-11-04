<?php

require_once('../../../../../../wp-load.php');
if (is_user_logged_in()) {
    if (isset($_GET['name'])) {
        TPSReporting::doExport('name', '', '', $_GET['name']);
        return;
    } else {
        TPSReporting::doExport('date', $_GET['start-date'], $_GET['end-date'], '');
    }
} else {
    echo 'Not allowed.';
}
