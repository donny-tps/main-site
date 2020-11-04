<?php

Class VotingSystem {

    public static function init() {
        // Add Vote Column To listing Screen
        add_filter('manage_event_photos_posts_columns', 'VotingSystem::postsColumn');
        add_action('manage_event_photos_posts_custom_column', 'VotingSystem::postsColumnContent', 10, 2);
        add_filter('manage_edit-event_photos_sortable_columns', 'VotingSystem::sortableColumns');
        add_action('pre_get_posts', 'VotingSystem::preGetPosts', 1);
        // Check if Logged in
        add_action('wp_ajax_nopriv_ajaxcheckloggedin', 'VotingSystem::isLoggedIn');
        add_action('wp_ajax_ajaxcheckloggedin', 'VotingSystem::isLoggedIn');
        // Add Vote
        add_action('wp_ajax_nopriv_ajaxaddvote', 'VotingSystem::addVote');
        add_action('wp_ajax_ajaxaddvote', 'VotingSystem::addVote');

        add_action('wp_ajax_nopriv_ajaxprocessvote', 'VotingSystem::processVote');
        add_action('wp_ajax_ajaxprocessvote', 'VotingSystem::processVote');

        //required to send transactional confirmational email
        require_once( 'campaignmonitor/csrest_transactional_smartemail.php' );
        return;
    }

    public static function addVote() {
        $pid = $_POST['pid'];
        // Check if user has voted on this before
        // if not check if voting is open
        // if it is add vote
        $terms = wp_get_post_terms($pid, 'event_dates');
        $event = $terms[0];
        $votingAllowed = get_field('open_for_voting', 'event_dates_' . $event->term_id);
        if ($votingAllowed == 1) {
            $uid = get_current_user_id();
            // check if user has voted on this post before

            global $wpdb;

            $result = $wpdb->get_results('SELECT * FROM tps_votes WHERE uid=' . $uid . ' AND pid=' . $pid . '');


            if (empty($result)) {
                // VOTE
                $currVotes = get_field('vote_count', $pid);
                update_field('vote_count', $currVotes + 1, $pid);
                $wpdb->insert(
                    'tps_votes', array(
                    'pid' => $pid,
                    'uid' => $uid,
                    )
                );
                die(json_encode(array('success' => 'yes', 'message' => 'Thanks! Please click the link in your email to confirm your vote.')));
            }
            die(json_encode(array('success' => 'no', 'message' => 'You may only vote once per photo.')));
        }
        die(json_encode(array('success' => 'no', 'message' => 'Sorry, this event is not open for voting.')));
    }

    public static function sendTransactional($to, $data, $emailID) {
        $auth = array('api_key' => '53133f274fa32da118be14542dee7e5390bb21cf7599216c');
        $smart_email_id = $emailID;

        $data['x-apple-data-detectors'] = 'x-apple-data-detectorsTestValue';

        # Create a new mailer and define your message
        $wrap = new CS_REST_Transactional_SmartEmail($smart_email_id, $auth);
        $message = array(
            "To" => $to,
            "Data" => $data,
        );

        $result = $wrap->send($message);

        return;
    }

    public static function saveVote() {

    }

    public static function getVoteCount($postid) {

        return;
    }

    public static function isOpenForVoting() {

        return;
    }

    public static function postsColumn($defaults) {

        $defaults['votes'] = 'Votes';
        return $defaults;
    }

    public static function postsColumnContent($column_name, $post_ID) {
        if ($column_name == 'votes') {
            // show content of 'directors_name' column
            $votes = get_field('vote_count', $post_ID);
            echo $votes;
        }
    }

    public static function sortableColumns($sortable_columns) {
        $sortable_columns['votes'] = 'vote_count';
        return $sortable_columns;
    }

    public static function preGetPosts($query) {
        if ($query->is_main_query() && ( $orderby = $query->get('orderby') )) {
            switch ($orderby) {
                case 'vote_count':
                    // set our query's meta_key, which is used for custom fields
                    $query->set('meta_key', 'vote_count');
                    $query->set('orderby', 'meta_value_num');
                    break;
            }
        }
    }

    public static function isLoggedIn() {
        $loggedIn = is_user_logged_in() ? 'yes' : 'no';
        die(json_encode(array('success' => $loggedIn)));
    }

    public static function voteCountUpdate() {
        global $wpdb;
        if (isset($_GET['update-votes']) && $_GET['update-votes'] == true) {
            $votes = $wpdb->get_results('SELECT * FROM tps_votes');
            $arrVote = array();
            foreach ($votes as $v) {
                $arrVote[$v->pid][] = $v;
            }
            foreach ($arrVote as $pid => $vote) {
                $voteCount = 0;
                if (count($vote) > 0) {
                    $voteCount = count($vote);
                }
                update_field('vote_count', count($vote), $pid);
            }
        }
    }

    public static function processVote() {
        check_ajax_referer('ajax-vote-nonce', 'security');
        global $wpdb;
        $email = mysql_escape_string($_POST['email']);
        $pid = mysql_escape_string($_POST['photo']);
        $firstname = mysql_escape_string($_POST['firstname']);
        $lastname = mysql_escape_string($_POST['lastname']);
        $postcode = mysql_escape_string($_POST['postcode']);
        $mobile = mysql_escape_string($_POST['mobile']);
        $shoot = mysql_escape_string($_POST['want-photoshoot']);
        if($email == '' || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            die(json_encode(array('error' => 'Oops, you need to enter your email address.')));
        }
        if($firstname == ''){
            die(json_encode(array('error' => 'Oops, you need to enter your first name.')));
        }
        if($lastname == ''){
            die(json_encode(array('error' => 'Oops, you need to enter your last name.')));
        }
        if($mobile == ''){
            die(json_encode(array('error' => 'Oops, you need to enter your mobile number.')));
        }

        $hasVoted = $wpdb->get_results('SELECT * FROM tps_votes WHERE email = "' . $email . '" AND pid= "' . $pid . '"');
        if ($hasVoted) {
            die(json_encode(array('error' => 'Oops, looks like you have already voted once for this photo.')));
        }

        $events = get_the_terms($pid, 'event_dates');
        $eventName = $events[0]->name;

        $wpdb->insert('tps_votes', array(
            'pid' => $pid,
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'postcode' => $postcode,
            'mobile' => $mobile,
            'want-shoot' => $shoot,
            'eventname' => $eventName,
            'verified' => 0,
        ));
        $vid = $wpdb->insert_id;
//        $votes = get_field('vote_count', $pid);
//        if ($votes == '') {
//            $votes = 0;
//        }
//        $votes = $votes + 1;
//        update_field('field_56e89b20319a1', $votes, $pid);

        // @TODO do something with the persons details


        $link = 'https://thephotostudio.com.au/confirm-vote?photo=' . $pid . '&vote=' . $vid . '&email=' . urlencode($email);

        //send transactional confirmation email
        $data = array(
            'link' => $link,
            'name' => $firstname,
            'event' => $eventName,
        );

        $emailID = '220ce5a7-56b4-44c7-9e12-7221b8fafb3a';
        VotingSystem::sendTransactional($email, $data, $emailID);

        //die(json_encode(array('success' => 'Way to go! Your vote has been added to the tally! Get more votes by sharing with your friends using the share icons below.')));
        die(json_encode(array('success' => 'Thanks for your vote! Check your email for the link to confirm your vote, and use the share icons below to share with your friends.')));
    }

    public static function verifyVote() {
        global $wpdb;

        $pid = $_GET['photo'];
        $vid = $_GET['vote'];
        $email = $_GET['email'];

        $result = $wpdb->get_row('SELECT * FROM tps_votes WHERE id=' . $vid . '');

        if($result->email == $email) {
            if($result->verified == 0) {
                $wpdb->update(
                    'tps_votes',
                    array(
                        'verified' => 1,
                    ),
                    array(
                        'id' => $vid,
                    )
                );

                $votes = get_field('vote_count', $pid);
                if ($votes == '') {
                    $votes = 0;
                }
                $votes = $votes + 1;
                update_field('field_56e89b20319a1', $votes, $pid);
//                update_field('field_56e0ae511aa1f', $votes, $pid); //this is the one for dev, won't work on live

                return '<p>Thanks for your vote! Be sure to come back later to see which photo wins!</p>';
            } else {
                return '<p>This vote has already been verified. Be sure to come back later to see which photo wins!</p>';
            }
        } else {
            return '<p>Sorry, it looks like something went wrong. <a href="/events">Click here</a> to go back to the events page.</p>';
        }
    }
}
