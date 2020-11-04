<?php

/*
  Author: Eddie Machado
  URL: htp://themble.com/bones/

  This is where you can drop your custom functions or
  just edit things like thumbnail sizes, header images,
  sidebars, comments, ect.
 */

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
//require_once( 'library/custom-post-type.php' );


require_once( 'library/staff-post-type.php' );
require_once( 'library/gallery-post-type.php' );
require_once( 'library/event-photos-post-type.php' );
require_once( 'library/classes/TPSTouchPoints.php' );
require_once( 'library/classes/TPSTouchPointsEmail.php' );
require_once( 'library/classes/TPSTouchPointsText.php' );
require_once( 'library/classes/TPSReporting.php' );
require_once( 'library/classes/campaignmonitor/csrest_transactional_smartemail.php' );
require_once( 'library/classes/campaignmonitor/csrest_transactional_smartemail.php' );
require_once( 'library/classes/twilio/Services/Twilio.php' );
require_once( 'library/classes/Debug.php' );

// Voting System

require_once( 'library/classes/VotingSystem.php' );


VotingSystem::init();
TPSReporting::init();
Debug::init();

TouchPoint::init();
add_theme_support('yoast-seo-breadcrumbs');

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/* * *******************
  LAUNCH BONES
  Let's get everything up and running.
 * ******************* */

function bones_ahoy() {

    // let's get language support going, if you need it
    load_theme_textdomain('bonestheme', get_template_directory() . '/library/translation');

    // launching operation cleanup
    add_action('init', 'bones_head_cleanup');
    // A better title
    add_filter('wp_title', 'rw_title', 10, 3);
    // remove WP version from RSS
    add_filter('the_generator', 'bones_rss_version');
    // remove pesky injected css for recent comments widget
    add_filter('wp_head', 'bones_remove_wp_widget_recent_comments_style', 1);
    // clean up comment styles in the head
    add_action('wp_head', 'bones_remove_recent_comments_style', 1);
    // clean up gallery output in wp
    add_filter('gallery_style', 'bones_gallery_style');

    // enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'bones_scripts_and_styles', 999);
    // ie conditional wrapper
    // launching this stuff after theme setup
    bones_theme_support();

    // adding sidebars to Wordpress (these are created in functions.php)
    add_action('widgets_init', 'bones_register_sidebars');

    // cleaning up random code around images
    add_filter('the_content', 'bones_filter_ptags_on_images');
    // cleaning up excerpt
    // 
    // code below commented out by Arpan. Was reselting in errors.
//    add_filter('excerpt_more', 'bones_excerpt_more');
}

/* end bones ahoy */

// let's get this party started
add_action('after_setup_theme', 'bones_ahoy');

// Any extra stylesheets or js files required on the site
function styles_js() {
    wp_register_style('layout', get_template_directory_uri() . '/library/css/layout.css?v=1.23');
    wp_register_style('fonts', get_template_directory_uri() . '/library/css/MyFontsWebfontsKit.css');
    wp_register_style('slicknav', get_template_directory_uri() . '/library/css/slicknav.css');
    wp_register_style('mediaelementjs', get_template_directory_uri() . '/library/css/mediaelementjs.css');
    wp_register_script('slicknav-js', get_template_directory_uri() . '/library/js/libs/jquery.slicknav.min.js');
    wp_register_script('isotope-js', get_template_directory_uri() . '/library/js/libs/isotope.pkgd.min.js');
    wp_register_script('loaded', get_template_directory_uri() . '/library/js/libs/imagesloaded.pkgd.min.js');
    wp_register_script('infinite-js', get_template_directory_uri() . '/library/js/libs/jquery.infinitescroll.min.js');
	wp_register_script('services-js',get_template_directory_uri(),'/library/js/services.js');
	wp_register_script('livechatinc-js', get_template_directory_uri() . '/library/js/livechatinc.js');
	wp_register_script('scroll-btn', get_template_directory_uri() . '/library/js/scroll-btn.js');
    wp_enqueue_style('layout');
    wp_enqueue_style('fonts');
    wp_enqueue_style('slicknav');
    wp_enqueue_script('slicknav-js',null,null,null,true);
    wp_enqueue_script('isotope-js',null,null,null,true);
    wp_enqueue_script('loaded',null,null,null,true);
    wp_enqueue_script('infinite-js',null,null,null,true);
	wp_enqueue_script('services-js',null,null,null,true);
	wp_enqueue_script('livechatinc-js',null,null,null,true);
	wp_enqueue_script('scroll-btn',null,null,null,true);
	wp_register_script('resize-script', get_template_directory_uri() . '/library/js/resize-script.js');
	wp_register_script('mediaelemntjs-script', get_template_directory_uri() . '/library/js/libs/mediaelementjs.js');


	if(!is_page('contact-us')) {		
		wp_enqueue_script('resize-script',null,null,null,true);
	}
}

add_action('wp_print_styles', 'styles_js');


/* * *********** OEMBED SIZE OPTIONS ************ */

if (!isset($content_width)) {
    $content_width = 640;
}

/* * *********** THUMBNAIL SIZE OPTIONS ************ */

// Thumbnail sizes
add_image_size('bones-thumb-600', 600, 150, true);
add_image_size('bones-thumb-300', 300, 100, true);

add_image_size('gallery-listing', 371, 0, false);

add_image_size('gallery-thumb', 742, 550, true);
/*
  to add more sizes, simply copy a line from above
  and change the dimensions & name. As long as you
  upload a "featured image" as large as the biggest
  set width or height, all the other sizes will be
  auto-cropped.

  To call a different size, simply change the text
  inside the thumbnail function.

  For example, to call the 300 x 300 sized image,
  we would use the function:
  <?php the_post_thumbnail( 'bones-thumb-300' ); ?>
  for the 600 x 100 image:
  <?php the_post_thumbnail( 'bones-thumb-600' ); ?>

  You can change the names and dimensions to whatever
  you like. Enjoy!
 */

add_filter('image_size_names_choose', 'bones_custom_image_sizes');

function bones_custom_image_sizes($sizes) {
    return array_merge($sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ));
}

/*
  The function above adds the ability to use the dropdown menu to select
  the new images sizes you have just created from within the media manager
  when you add media to your content blocks. If you add more image sizes,
  duplicate one of the lines in the array and name it according to your
  new image size.
 */

/* * *********** ACTIVE SIDEBARS ******************* */

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
        'id' => 'sidebar1',
        'name' => __('Sidebar 1', 'bonestheme'),
        'description' => __('The first (primary) sidebar.', 'bonestheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    /*
      to add more sidebars or widgetized areas, just copy
      and edit the above sidebar code. In order to call
      your new sidebar just use the following code:

      Just change the name to whatever your new
      sidebar's id is, for example:

      register_sidebar(array(
      'id' => 'sidebar2',
      'name' => __( 'Sidebar 2', 'bonestheme' ),
      'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
      ));

      To call the sidebar in your template, you can just copy
      the sidebar.php file and rename it to your sidebar's name.
      So using the above example, it would be:
      sidebar-sidebar2.php

     */
}

// don't remove this bracket!


/* * *********** COMMENT LAYOUT ******************** */

// Comment Layout
function bones_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
        <article  class="cf">
            <header class="comment-author vcard">
                <?php
                /*
                  this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
                  echo get_avatar($comment,$size='32',$default='<path_to_url>' );
                 */
                ?>
                <?php // custom gravatar call ?>
                <?php
                // create variable
                $bgauthemail = get_comment_author_email();
                ?>
                <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
                <?php // end custom gravatar call ?>
                <?php printf(__('<cite class="fn">%1$s</cite> %2$s', 'bonestheme'), get_comment_author_link(), edit_comment_link(__('(Edit)', 'bonestheme'), '  ', '')) ?>
                <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php comment_time(__('F jS, Y', 'bonestheme')); ?> </a></time>

            </header>
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="alert alert-info">
                    <p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
                </div>
            <?php endif; ?>
            <section class="comment_content cf">
                <?php comment_text() ?>
            </section>
            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </article>
        <?php // </li> is added by WordPress automatically ?>
        <?php
    }

    /* Beginings of a Debug Class */

     function debug_dump($data) {
         echo '<pre>';
         print_r($data);
         echo '</pre>';
     }

    function google_map() {
        extract(
                shortcode_atts(
                        array(
            ''
                        ), $atts
                )
        );
        ?>


        <script type="text/javascript">
            var infowindow = null;
            function initialize()
            {
                var latlng = new google.maps.LatLng(-35.4061938, 147.4921362);
                var myOptions = {
                    zoom: 5,
                    center: latlng,
                    scrollwheel: false,
                };

                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                setMarkers(map, items);
                infowindow = new google.maps.InfoWindow({
                    content: "holding..."
                });
            }

            var items = [
                ['Sydney Studio', '-33.882753', '151.192464', 1],
                ['Melbourne Studio', '-37.7887565', '145.0188728', 1]
            ];

            function setMarkers(map, markers)
            {
                for (var i = 0; i < markers.length; i++)
                {

                    var sites = markers[i];
                    var siteLatLng = new google.maps.LatLng(sites[1], sites[2]);
                    var marker = new google.maps.Marker({
                        position: siteLatLng,
                        map: map,
                        title: sites[0],
                        html: sites[4],
                        icon: "/wp-content/themes/photostudio/library/images/map-marker.png"
                    });
                    google.maps.event.addListener(marker, "click", function ()
                    {
                        infowindow.setContent(this.html);
                        infowindow.open(map, this);
                        jQuery('.map-address-container').parent().addClass('map-details-wrapper');
                    });
                }
            }
        </script>
        <div class="google-map-container">
            <div id="map_canvas"></div>
            <script type="text/javascript">
                initialize();
            </script>



            <?php
        }

        add_shortcode('google_map', 'google_map');



        add_action('pre_get_posts', 'ci_paging_request');

		/*
		 *  START ENQUIRE NOW POPUP BUTTON SHORTCODE
		 * 
		 */
		function enquireNowPopupButton() {
			return '<div class="button-ph" style="display:flex;"><a style="margin:auto;" href="" class="btn-ph">ENQUIRE NOW</a></div>';
		}
		add_shortcode('ENQUIRE NOW POPUP BUTTON', 'enquireNowPopupButton');

		/*
 		*  END ENQUIRE NOW POPUP BUTTON SHORTCODE
 		* 
 		*/

        function ci_paging_request($wp) {
            //We don't want to mess with the admin panel.
            if (is_admin())
                return;

            $num = get_option('posts_per_page', 15);

            if (is_archive()) {
                $num = -1;
            }
            if (!isset($wp->query_vars['posts_per_page']) and is_main_query()) {
                $wp->query_vars['posts_per_page'] = $num;
            }
        }

        function app_output_buffer() {

            ob_start();
        }

        add_action('init', 'app_output_buffer');
        /* DON'T DELETE THIS CLOSING TAG */

        add_action('wp_ajax_nopriv_ajaxlogin', 'ajax_login');

        function ajax_login() {

            // First check the nonce, if it fails the function will break
            check_ajax_referer('ajax-login-nonce', 'security');

            // Nonce is checked, get the POST data and sign user on
            $info = array();
            $info['user_login'] = $_POST['username'];
            $info['user_password'] = $_POST['password'];
            $info['remember'] = true;

            $user_signon = wp_signon($info, false);
            if (is_wp_error($user_signon)) {
                echo json_encode(array('loggedin' => false, 'message' => __('Wrong username or password.')));
            } else {
                echo json_encode(array('loggedin' => true, 'message' => __('Login successful, redirecting...')));
            }

            die();
        }

        add_action('after_setup_theme', 'remove_admin_bar');

        function remove_admin_bar() {
            //admins and bookers can add_tps_booking
            if (!current_user_can('add_tps_booking') && !is_admin()) {
                show_admin_bar(false);
            }
        }

        function tps_pricing_table( $atts ) {
            $a = shortcode_atts( array(
                'img' => '',
                'title' => '',
                'price' => '',
                'value' => '',
                'text1' => '',
                'text2' => '',
                'text3' => '',
                'text4' => '',
                'text5' => '',
                'btntext' => '',
                'btnlink' => '',
                'featured' => '',
            ), $atts );

            $featured = '';
            $featuredBox = '';
            if($a['featured'] == "Yes") {
                $featured = "featured";
                $featuredBox = '<div class="pricing-featured-box">Most Popular</div>';
            }

            $html = '
        <div class="pricing-table-column ' . $featured . '">
            ' . $featuredBox . '
            <div class="pricing-table-header" style="background-image: url(' . $a['img'] . ');">
                <h3>' . $atts['title'] . '</h3>
                <span class="price">' . $a['price'] . '</span>
                <span class="value">' . $a['value'] . '</span>
            </div>
            <div class="pricing-table-body">
                <ul>
                    <li>' . $a['text1'] . '</li>
                    <li>' . $a['text2'] . '</li>
                    <li>' . $a['text3'] . '</li>
                    <li>' . $a['text4'] . '</li>
                    <li>' . $a['text5'] . '</li>
                </ul>
                <a href="' . $a['btnlink'] . '" class="pricing-table-button">' . $a['btntext'] . '</a>
            </div>
        </div>';

            echo $html;
        }
        add_shortcode( 'pricing_table', 'tps_pricing_table');

        function rw_trim_excerpt( $text='' ) {
            $text = strip_shortcodes( $text );
            $text = apply_filters('the_content', $text);
            $text = str_replace(']]>', ']]&gt;', $text);
            $excerpt_length = apply_filters('excerpt_length', 55);
            $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
            return wp_trim_words( $text, $excerpt_length, $excerpt_more );
        }
        add_filter('wp_trim_excerpt', 'rw_trim_excerpt');

        function truncate($string, $length = 100, $append = "&hellip;") {
            $string = trim($string);

            if (strlen($string) > $length) {
                $string = wordwrap($string, $length);
                $string = explode("\n", $string, 2);
                $string = $string[0] . $append;
            }
            return strip_tags($string);
        }

        if(!function_exists('remove_vc_from_excerpt'))  {
          function remove_vc_from_excerpt( $excerpt ) {
            $patterns = "/\[[\/]?vc_[^\]]*\]/";
            $replacements = "";
            return preg_replace($patterns, $replacements, $excerpt);
          }
        }

        function tps_latest_posts( $atts ) {
            $a = shortcode_atts( array(
                'slug' => '',
            ), $atts );

            $cat = $a['slug'];

            $posts = get_posts ( array(
                'posts_per_page' => 3,
                'category_name' => $cat,
            ) );
            foreach($posts as $post) {
                //debug_dump($post);
                //debug_dump(remove_vc_from_excerpt($post->post_content));



                $html .= '
                <a href="' . get_the_permalink($post->ID) . '" class="category_listing">
                    <div class="gallery-item">
                        <img src=' . wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail-size', true)[0] . ' alt="">
                    </div>
                    <div class="post-content">
                        <h3>'. $post->post_title . '</h3>
                        <span class="description">' . truncate(remove_vc_from_excerpt($post->post_content), 140 ) . '</span>
                    </div>
                </a>';
            }
            return $html;
        }
        add_shortcode('latest_posts', 'tps_latest_posts');

        add_action( 'TPS_send_emails', 'TouchPoint::emailsToSend' );
            if (!wp_next_scheduled('TPS_send_emails')) {
                    wp_schedule_event(time(), 'hourly', 'TPS_send_emails');
        }

  function validateAge($birthday, $age = 18) {
            // $birthday can be UNIX_TIMESTAMP or just a string-date.
            if (is_string($birthday)) {
                $birthday = strtotime($birthday);
            }

            // check
            // 31536000 is the number of seconds in a 365 days year.
            if (time() - $birthday < $age * 31536000) {
                return false;
            }

            return true;
        }

        function experience($atts) {
            $a = shortcode_atts(array(
                'heading' => '',
                'subtitle' => '',
                'buttontext' => '',
                'buttonlink' => '',
                'color' => '',
                'image' => '',
                    ), $atts);

            $html = '
            <div class="experienceContainer">
                <div class="experience color-' . $a['color'] . '" style="background-image: url(' . $a['image'] . ')">
                    <div class="desktop">
                        <h2>' . $a['heading'] . '</h2>
                        <h4>' . $a['subtitle'] . '</h4>
                        <a href="' . $a['buttonlink'] . '" class="experienceButton">' . $a['buttontext'] . '</a>
                    </div>
                </div>
                <div class="mobile">
                    <h2>' . $a['heading'] . '</h2>
                    <h4>' . $a['subtitle'] . '</h4>
                    <a href="' . $a['buttonlink'] . '" class="experienceButton">' . $a['buttontext'] . '</a>
                </div>
            </div>';

            return $html;
        }

        add_shortcode('experience', 'experience');

        add_action( 'TPS_check_emails', 'TouchPoint::getEmails' );
            if (!wp_get_schedule('TPS_check_emails')) {
                    wp_schedule_event(time(), 'hourly', 'TPS_check_emails');
        }

        function homeNewPosts() {
            $the_query = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'post',
                'orderby' => 'date',
		        'order' => 'DESC',
            ));

            if ( $the_query->have_posts() ) {
                echo '<div class="blogpost-wrapper">';
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $_postTerms = wp_get_post_terms(get_the_ID($post->ID), 'category');
                    ?>

                    <div class="blogpost-item">
                        <a href="<?php echo get_permalink($post->ID); ?>">
                            <?php echo the_post_thumbnail('medium_large'); ?>                
                            <div class="post-content">
                                <h3><?php the_title(); ?></h3>
                                <div class="excerpt">
                                    <span class="categories"><?php
                                        $i = 0;
                                        foreach ($_postTerms as $t) {
                                            if ($i >= 1) {
                                                echo ', ';
                                            }
                                            echo $t->name;
                                            $i++;
                                        }
                                        ?></span><span class="post-date"></span>

                                    <?php echo get_field('short_description'); ?>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php }
                echo '</div>';
                /* Restore original Post Data */
                wp_reset_postdata();
            } else {
                // no posts found
            }

        }
        add_shortcode('homeNewPosts', 'homeNewPosts');


// Gravity form enable label hiding
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

/* add secondary thumbnail  for PAGES*/

function add_page_secondary_image() {
	if (class_exists('MultiPostThumbnails')) {
		new MultiPostThumbnails(
			array(
				'label' => 'Secondary Image',
				'id' => 'secondary-image',
				'post_type' => 'page'
			)
		);
	}
}

add_action('init', 'add_page_secondary_image');


/* add header image for POST */

function add_post_header_image() {
	if (class_exists('MultiPostThumbnails')) {
		new MultiPostThumbnails(
			array(
				'label' => 'Post Header Image',
				'id' => 'post-header-image',
				'post_type' => 'post'
			)
		);
	}
}

add_action('init', 'add_post_header_image');

/* add mobile header image for post */

function add_mobile_post_header_image() {
	if (class_exists('MultiPostThumbnails')) {
		new MultiPostThumbnails(
			array(
				'label' => 'Mobile Post Header Image',
				'id' => 'mobile-post-header-image',
				'post_type' => 'post'
			)
		);
	}
}

add_action('init', 'add_mobile_post_header_image');

/* add mobile header image for page 

function add_mobile_page_header_image() {
	if (class_exists('MultiPostThumbnails')) {
		new MultiPostThumbnails(
			array(
				'label' => 'Mobile Page Header Image',
				'id' => 'mobile-page-header-image',
				'post_type' => 'page'
			)
		);
	}
}
*/
// disabled add_mobile_page_header_image
//add_action('init', 'add_mobile_page_header_image');


/* load more handler */

function load_more_posts(){ 
	$args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1; 
    
	$query = new WP_Query($args);

    $posts = $query->posts; 
	
	if(count($posts) > 0): 
        foreach($posts as $post): 
            include(locate_template('post-item.php'));
        endforeach; 
    endif;
    
	die();
} 
 
add_action('wp_ajax_loadmoreplus', 'load_more_posts_plus');
add_action('wp_ajax_nopriv_loadmoreplus', 'load_more_posts_plus');

/* load more item-post-plus handler */

function load_more_posts_plus(){
//	$args = unserialize( stripslashes( $_POST['query'] ) );
    $args = array(
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => $_POST['page']
    );
    $args['post__not_in'] = unserialize( stripslashes( $_POST['first_page_posts'] ) );

	$query = new WP_Query($args);

    $posts = $query->posts;
	if(count($posts) > 0):
        foreach($posts as $post):
            include(locate_template('post-item-plus.php'));
        endforeach;
    endif;

	die();
}

add_action('wp_ajax_loadmore', 'load_more_posts');
add_action('wp_ajax_nopriv_loadmore', 'load_more_posts');

/* load categories posts handler */

function load_cat_posts(){     
	$args = array(
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => 1
    );

    if($_POST['cats']) {
        $args['category_name'] = $_POST['cats']; 
    }

    $query = new WP_Query($args);
    
    $posts = $query->posts; 
    
    ?>

    <div class="post-items-wrapper">
    
    <?php
        if(count($posts) > 0): 
            foreach($posts as $post): 
                include(locate_template('post-item.php'));
            endforeach; 
        endif;
    ?>

    </div>  

    <?php if (  $query->max_num_pages > 1 ) : ?>
        <script>
            window.posts_query = '<?php echo serialize($query->query_vars); ?>';
            window.current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            window.max_pages = '<?php echo $query->max_num_pages; ?>';
        </script>
        <button id="load-more-button">Load more</button>
    <?php 
        endif; 
    die();
} 
 
add_action('wp_ajax_load_cat_posts', 'load_cat_posts');
add_action('wp_ajax_nopriv_load_cat_posts', 'load_cat_posts');

/* load next post handler */

function load_next_post(){
    global $post;
    $args = array(
        'cat' => $_POST['cat_id'],
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => 1,
        'post__not_in' => $_POST['posts']
    );  

    $query = new WP_Query($args);    
    $posts = $query->posts; 

    if(count($posts) > 0) {
        $post = get_post($posts[0]->ID);
        setup_postdata($post); 
        $post_id = get_the_ID();
        WPBMap::addAllMappedShortcodes();
        
        include(locate_template('load_post_template.php'));

        ?>
            <script>
                window.post_id = <?= $post_id; ?>;
            </script>
        <?php
        wp_reset_postdata();
    }
    
    die();   	
} 
 
add_action('wp_ajax_load_next_post', 'load_next_post');
add_action('wp_ajax_nopriv_load_next_post', 'load_next_post');



//start: performance changes


remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

function do_not_load_wp_embed() {
	if (!is_admin()) {
		wp_deregister_script('wp-embed');
		//wp_deregister_script('jquery');
	}
}
add_action('init', 'do_not_load_wp_embed');
// Remove the REST API endpoint.
remove_action( 'rest_api_init', 'wp_oembed_register_route' );
// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );
// Don't filter oEmbed results.
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
// Remove oEmbed discovery links.
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
// Remove all embeds rewrite rules.
//add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

// end of functions.php edits (performance changes)


//defer all javascript on the site


function defer_js_x ( $url ) {
	if(!is_admin()){
		if ( FALSE === strpos( $url, '.js' ) ) return $url;
		if ( strpos( $url, 'jquery.js' ) ) return $url;
		return "$url' defer='defer" ;	
	}
	return $url;
}
function defer_js($url) {
//Add the files to exclude from defer. Add jquery.js by default
    $exclude_files = array('jquery.js');
//Bypass JS defer for logged in users
    if (!is_admin()) {
        if (false === strpos($url, '.js')) {
            return $url;
        }

        foreach ($exclude_files as $file) {
            if (strpos($url, $file)) {
                return $url;
            }
        }
    } else {
        return $url;
    }
    return "$url' defer='defer";
}

add_filter( 'clean_url', 'defer_js', 11, 1 );

//end defer js

/*
 * Add image size for uber-menu
 */
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'uber-menu-image', 360, 240, false );
}

/*
 * Custom image size for magazine poster
 */
add_action( 'after_setup_theme', 'magazine_poster_size' );
function magazine_poster_size() {
    add_image_size( 'mag_poster', 553 );
}

/*
 * Custom image size for post thumbnails
 */
add_action('after_setup_theme','post_image_size');
function post_image_size() {
	add_image_size( 'post_image', 600 );
}

/*
 *  Required Admin Page Magazine
 */
include_once 'library/magazine_functions.php';

/*
 * Required Visual Composer Module PopUp Download
 */
add_action ( 'vc_before_init', 'vc_before_init_actions');
function vc_before_init_actions () {
    include_once get_template_directory () . '/library/vc_popup_download.php';
}


/*
 * GTM DataLayer for CQE Gravity form_11 
 */

add_action( 'gform_after_submission_11', 'after_submission_11', 10, 2 );

function after_submission_11($entry)
{	
	mail('tps.arpan@gmail.com','gtm debug','<script> dataLayer.push({"cqeform":"'.rgar($entry,"9").'","event":"CQEFormSubmitted"}) </script>');
	echo '<script> dataLayer.push({"cqeform":"'.rgar($entry,"9").'","event":"CQEFormSubmitted"}) </script>';
}

/*
 *  START Disable Glutenberg. --Added by Arpan
 */
//disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);

//disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

/*
 * End Disable Gluenberg
 */ 

?>
