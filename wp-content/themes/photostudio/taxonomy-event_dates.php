<?php
get_header();


$bg = get_field('event_hero_image', 'event_dates_' . get_queried_object()->term_id);

$votingOpen = get_field('open_for_voting', 'event_dates_' . get_queried_object()->term_id);
if(!$bg){
    $bg = get_field('event_photo', 'event_dates_' . get_queried_object()->term_id);
}

$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
$custom_css .= ".content-page-header{ background:url('{$bg['url']}') no-repeat center center #ededed;background-size:cover;}";
wp_add_inline_style('custom-style', $custom_css);
$intro = get_field('introduction_text', get_the_ID());

global $wp_query, $wpdb;

$args = array_merge(
        $wp_query->query, array('post_type' => 'event_photos',
    'posts_per_page' => -1,
    'order_by' => 'vote_count',
    'order' => 'DESC'
        )
);
$count = '';
if (isset($_GET['reference'])) {
    $postid = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $_GET['reference'] . "' AND post_type = 'event_photos'");
    $photos = array(get_post($postid));
    $count = count($photos);
} else {
    $photos = query_posts($args);
}
VotingSystem::voteCountUpdate();

usort($photos, 'sortByVote');

function sortByVote($a, $b) {
    if (get_field('vote_count', $a->ID) > get_field('vote_count', $b->ID)) {
        return -1;
    }
    if (get_field('vote_count', $a->ID) < get_field('vote_count', $b->ID)) {
        return 1;
    }
}
?>
<div class="voting-open" data-isopen="<?php if($votingOpen){echo 'yes';}else{echo 'no';}?>"></div>
<div class="content-page-header">
    <div class="site-width">
        <div class="intro-wrapper <?php
if ($intro == '' || $intro == false) {
    echo "no-intro";
}
?>">
            <div class="fancy"><h1><?php echo single_cat_title(); ?></h1></div>
            <div class="intro-text"><?php echo $intro; ?></div>
        </div>
        <div class="down-button-wrapper">
            <a href="#page-content" class="down-arrow"></a>
        </div>
    </div>
</div>
<div class="overlay"></div>
<div class="event-holder-modal" id="carousel">
    <div class="image-holder"></div>
    <span class="next"></span>
    <span class="prev"></span>
    <span class="loading"><i class="fa fa-circle-o-notch fa-spin"></i> Loading.....</span>
    <span class="close"></span>
    <div class="content-holder">
        <h3>Purchase this print
        </h3>
        <div class="socials">
            <div class="share-icons-wrapper">
                <span>SHARE: </span>
                <a href="http://www.facebook.com/sharer.php?u=<?php echo get_term_link(get_queried_object()); ?>" onclick="window.open(this.href, this.title, 'width=500,height=500,top=300px,left=300px');
                        return false;" rel="nofollow" target="_blank" class="social facebook"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/share?url=<?php echo get_term_link(get_queried_object()); ?>" onclick="window.open(this.href, this.title, 'width=500,height=500,top=300px,left=300px');
                        return false;" rel="nofollow" target="_blank" class="social twitter"><i class="fa fa-twitter"></i></a>
            </div>

        </div>
        <p></p>

    </div>
</div>
<div class="page-wrapper events-wrapper-2">
    <div class="event-grey-box">
        <div class="site-width">
<?php
if (empty($photos) || $photos[0] == '') {
    echo '<div class="alert alert-error">Oops, no photo\'s have been found, please try again.</div>';
} else {
    ?>
                <?php echo get_queried_object()->description; ?>
                <div class="event-search">
                <?php
                if ($count != '') {
                    echo "<p>You're search for photo <strong>#" . $_GET['reference'] . '</strong> has returned <strong>' . $count . '</strong> results</p>';
                }
                ?>
                    <form action="" name="reference" method="GET"><input type="text" name="reference" placeholder="Search for your photo, enter your reference #" /><button type="submit" class="grey-button">SEARCH</button> <?php if ($count != '') { ?><a href="<?php echo get_term_link(get_queried_object()); ?>"  class="grey-button-alt">VIEW ALL</a><?php } ?></form>
                </div>
            </div>
        </div>
        <div class="event-wrapper-listing">
            <script>
                var eventElements = [];
    <?php
    $i = 0;
    foreach ($photos as $g) {

        if ($i < 24) {
            $i++;
            continue;

        }
        ?>
                    eventElements.push({
                        'url': "<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($g->ID), 'full')[0]; ?>",
                        'thumb': "<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($g->ID), 'gallery-listing')[0]; ?>",
                        'reference': '<?php echo esc_html($g->post_title); ?>',
                        'votes': '<?php echo get_field('vote_count', $g->ID); ?>',
                        'pid': '<?php echo $g->ID; ?>',
                    });

        <?php
        $i++;

    }
    ?>

            </script>
    <?php

    $i = 0;
    foreach ($photos as $g) {
        $votes = get_field('vote_count', $g->ID);


        if ($votes == '') {
            $votes = 0;
        }

        if ($i >= 24) {
            continue;
        }
        $bgFull = wp_get_attachment_image_src(get_post_thumbnail_id($g->ID), 'full');
        $bg = wp_get_attachment_image_src(get_post_thumbnail_id($g->ID), 'gallery-listing');

        echo <<<EOT
                            <div class="event-item-listing" data-reference="{$g->post_title}" data-image="{$bgFull[0]}" data-votes="{$votes}" data-pid="{$g->ID}" style="width: 371px;">
                            <span class="vote-count">
                                    <i class="fa fa-heart"></i> {$votes}
                            </span>
                                <img src="{$bg[0]}"/>
                            </div>
EOT;
        $i++;
    }
    ?>

        </div>
            <?php
            if (count($photos) > 24) {
                echo '<div class="loading-button"><span class="load-button load-more-events">LOAD MORE</span></div>';
            }
        }
        ?>
</div>
    <?php if (get_field('related_posts')) {
        ?>
    <div class="related-posts">
        <div class="site-width">
            <h3>RELATED POSTS FROM THE BLOG</h3>
    <?php
    $relatedPosts = get_field('related_posts');
    foreach ($relatedPosts as $p) {

        if (in_category('testimonials', $p)) {
            ?>
                    <div class="blogpost-item">
                        <span class="testimonial related">
                            <span class="quote-quote">"</span>
                            <span class="quote-content"><?php echo $p->post_content; ?></span>
                            <span class="person-name"><?php echo $p->post_title; ?></span>
                        </span>
                    </div>
            <?php
            continue;
        }
        ?>
                <div class="blogpost-item">
                    <a href="<?php echo get_permalink($p->ID); ?>">
                <?php
                $bg = wp_get_attachment_url(get_post_thumbnail_id($p->ID));
                echo '<img src="' . $bg . '">';
                ?>
                        <div class="post-content">
                            <h3><?php echo $p->post_title ?></h3>
                            <div class="excerpt">
        <?php echo get_field('short_description', $p->ID); ?>
                            </div>
                        </div>
                    </a>
                </div>
        <?php
    }
    ?>
        </div>
    </div>
        <?php }
        ?>
<div class="voting-overlay"></div>
<div class="voting-box">
    <span class="close-vote"><i class="fa fa-close"></i></span>
    <div class="inner-vote">
        <div class="message"><p>To submit your vote, please enter your details into the form below.</p></div>
        <div class="social-wrap">
            <div class="socials">
                <div class="share-icons-wrapper">
                    <span>SHARE: </span>
                    <a href="http://www.facebook.com/sharer.php?u=<?php echo get_term_link(get_queried_object()); ?>" onclick="window.open(this.href, this.title, 'width=500,height=500,top=300px,left=300px');
                            return false;" rel="nofollow" target="_blank" class="social facebook"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/share?url=<?php echo get_term_link(get_queried_object()); ?>" onclick="window.open(this.href, this.title, 'width=500,height=500,top=300px,left=300px');
                            return false;" rel="nofollow" target="_blank" class="social twitter"><i class="fa fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <form action="POST" method="" id="voteform">
<?php wp_nonce_field('ajax-vote-nonce', 'security'); ?>
            <input type="hidden" name="photo" id="photo"/>
            <input type="text" name="firstname" placeholder="First Name" class="input"/>
            <input type="text" name="lastname" placeholder="Last Name" class="input"/>
            <input type="email" name="email" placeholder="Email Address" class="input"/>
            <input type="text" name="mobile" placeholder="Mobile Number" class="input"/>
            <input type="text" name="postcode" placeholder="Post Code" class="input"/>
            <!-- <label><input type="checkbox" name="want-photoshoot" value="Yes"> I am interested in a photo shoot.</label><br /> -->
            <label>Which type of photo shoot best fits you:</label>
            <select name="want-photoshoot" class="input">
              <option value="ladies">Ladies Photoshoot</option>
              <option value="guys">Guys Photoshoot</option>
              <option value="teens">Teens Photoshoot</option>
              <option value="glamour">Glamour Photoshoot</option>
              <option value="dancers">Dancers Photoshoot</option>
              <option value="fitness">Fitness Photoshoot</option>
              <option value="family">Family Photoshoot</option>
              <option value="couples">Couples Photoshoot</option>
              <option value="malemodel">Male Modelling Photoshoot</option>
              <option value="femalemodel">Female Modelling Photoshoot</option>
              <option value="childmodel">Child Modelling Photoshoot</option>
            </select>
            <button class="button grey"><i class="fa fa-heart"></i> Submit Vote</button>
        </form>
    </div>
</div>
<?php get_footer(); ?>
