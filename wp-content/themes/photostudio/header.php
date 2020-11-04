<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
    <head>

        <!--script src="https://cdn.optimizely.com/js/5953682288.js"></script-->
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php wp_title(''); ?></title>
        <?php // mobile meta (hooray!) ?>
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
        <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
        <!--[if IE]>
                <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
        <![endif]-->
        <?php // or, set /favicon.ico for IE10 win ?>
        <meta name="msapplication-TileColor" content="#f01d4f">
        <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
		<!--<meta name="google-site-verification" content="vev6UYFv1BrHETqboPVJ1rn6rl5BJHcsizOph9mpiaE" /> -->
							<!-- arpan's google site verification test temporary -->
			<meta name="google-site-verification" content="Qrx22jk9Rh3EN8rTnfi2N8qW8VEjg-BJhKzUbQdvEas" />
		
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php
            if( is_front_page() ) {

        ?>
                <script>
                    /*
                     * Added url`s for loading Plyr library
                     */
                    var style_url = "<?= get_stylesheet_directory_uri() . '/library/js/libs/plyr/plyr.css'; ?>";
                    var script_url = "<?= get_stylesheet_directory_uri() . '/library/js/libs/plyr/plyr.js'; ?>";
                </script>
        <?php
            }
        ?>
        <?php
        // Add Class to body for magazine-plus page
        if( is_page_template( ['page-magazine-plus.php', 'template-magazine-plus.php'] ) ) {
            add_filter( 'body_class', 'add_body_class_magazine', 10, 2 );
            function add_body_class_magazine( $classes ){
                $classes[] = 'header__autoheight';
                return $classes;
            }
        }
        ?>
		
		<style>
			<?php
				/*
				 * Style to override header video with static image.
                 * DO NOT anything from this style tag at any cost.
                 */
			?>
			
						#homeHeader.desktop {
                                        background-image: none !important;
                                        min-height: 300px;
                                        padding:0;
                                }
                                .plyr__controls{
                                        display:none !important;
                                }

                        @media screen and (max-width: 639px) {
                                        .homepage-video-content{
                                                margin-top:120px !important;
                                        }

                                #homeHeader {
                                                background-image:url('https://thephotostudio.com.au/wp-content/uploads/2017/12/0.jpg');
                                                background-repeat: no-repeat;
                                                background-color: #000;
                                                background-size: cover;
                                                padding:30px 0;
                                                background-position: center;

                                }
                                .home .homepage-video .homepage-video-content .video-buttons a:first-child {
                                        margin-right:0;
                                        margin-bottom:10px;

                                }
                                .home .homepage-video {
                                        background-color: transparent !important;
                                        margin-top:30px;
                                }

                                .home .experienceContainer .mobile {
                                        display: block;
                                }

                                        #js-player-large{
                                        display:none !important;
                                }
                        }
		</style>
		
	  <?php wp_head(); ?>
  
		<style>
			.cqe-message-field{
				
			}
		</style>
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js"></script -->
		<meta name="google-site-verification" content="iYdV2ZCpAY-2zqn6SFn4bxjaAWCWJiBb-MoGUSk2NgY" />

    </head>
    <body <?php body_class(); ?>>

<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
        <header class="header" role="banner">
            <div class="site-width">
                <a href="<?php echo home_url(); ?>" rel="nofollow" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/library/images/ThePhotoStudioLogo.svg" /></a>					      

                    <div class="mobile-nav"></div>
                    <?php if( is_page_template( ['page-magazine-plus.php', 'template-magazine-plus.php'] ) ) : ?>

                        <?php
                        /* Menu with SubCategories */
                        $selected_categories = json_decode( get_option( 'magazine_selected_categories_json' ), true );
                        $top_categories = array_keys( $selected_categories );
                        foreach( $selected_categories['top'] as $cat ) {
                            array_push( $top_categories, $cat );
                        }
                        // It is category All
                        foreach( $selected_categories[117] as $all ) {
                            array_push( $top_categories, $all );
                        }
                        unset( $selected_categories[117] );
                        unset( $selected_categories['top'] );
                        unset( $top_categories[array_search('top', $top_categories)] );
                        unset( $top_categories[array_search(117, $top_categories)] );

                        $categories = get_categories(['include' => $top_categories ]);
                        ?>
                        <ul class="magazine-filter">
                            <?php foreach ( $categories as $category ) : ?>
                                <?php if( isset( $selected_categories[$category->term_id ] ) ) {
                                    $has_child_item = true;
                                } else {
                                    $has_child_item = false;
                                }?>
                                <li class="magazine-filter-item<?= $has_child_item ? ' has-child-item' : ''; ?>">
                                    <span data-slug="<?= $category->slug; ?>"><?= $category->name; ?></span>
                                    <?php if( $has_child_item ) : ?>
                                        <?php $selected_sub_cats = implode(", ", $selected_categories[$category->term_id ]); ?>
                                        <?php $sub_cats = get_categories(['include' => $selected_sub_cats ]); ?>
                                        <ul class="magazine-filter magazine-subfilter">
                                            <?php foreach ( $sub_cats as $sub_cat ) : ?>
                                                <li class="magazine-filter-item magazine-filter-subitem">
                                                    <span data-slug="<?= $sub_cat->slug; ?>"><?= $sub_cat->name; ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach;?>
                        </ul>

                    <?php else : ?>
                        <?php if( function_exists( 'ubermenu' ) ): ?>
                            <?php ubermenu( 'main' , array( 'theme_location' => 'main-nav' ) ); ?>
                        <?php else: ?>
                                <nav role="navigation">
                                <?php
                                wp_nav_menu(array(
                                    'container' => false, // remove nav container
                                    'container_class' => 'menu cf', // class of container (should you choose to use it)
                                    'menu' => __('The Main Menu', 'bonestheme'), // nav name
                                    'menu_class' => 'nav top-nav cf', // adding custom nav class
                                    'theme_location' => 'main-nav', // where it's located in the theme
                                    'before' => '', // before the menu
                                    'after' => '', // after the menu
                                    'link_before' => '', // before each link
                                    'link_after' => '', // after each link
                                    'depth' => 0, // limit the depth of the nav
                                    'fallback_cb' => '' // fallback function (if there is one)
                                ));
                            ?>
                            </nav>
                            <div id="mobile-nav"></div>
                        <?php endif; ?>
                    <?php endif; ?>
            </div>
			

		
			

		
			
			

        </header>
        <div class="header-spacing"></div>