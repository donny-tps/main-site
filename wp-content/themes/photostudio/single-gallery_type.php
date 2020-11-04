<style>
.button-ph {
	margin-top: 17px;		
}	
.btn-ph {
	background-color: #9b204c;
	color: white;
	padding: 10px 20px;
	letter-spacing: 2px;
	transition: background-color 200ms;
	border: 0;
	text-decoration: none;
   }
.btn-ph:hover {
	background-color: #751839;
}
</style>
<?php
get_header();
$bg = get_field('gallery_main_image', get_the_ID());
if (!$bg) {
    $bg = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
} else {
    $bg = $bg['url'];
}
$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
$custom_css .= ".content-page-header{ background:url('{$bg}') no-repeat center center #ededed;background-size:cover;}";
wp_add_inline_style('custom-style', $custom_css);
$intro = get_field('short_description', get_the_ID());
?>
<div class="content-page-header">
    <div class="site-width">
        <div class="intro-wrapper <?php
        if ($intro == '' || $intro == false) {
            echo "no-intro";
        }
        ?>">
            <div class="fancy">
                <h1><?php echo the_title(); ?></h1>
            </div>
			<div class="button-ph"><a href="" class="btn-ph">ENQUIRE NOW</a></div>
            <div class="intro-text">
                <?php echo $intro; ?>
            </div>
        </div>
        <div class="down-button-wrapper">
            <a href="#page-content" class="down-arrow"></a>

        </div>
    </div>
</div>
<div class="overlay"></div>

<div class="carousel-holder" id="carousel">
    <span class="next"></span>
    <span class="prev"></span>
        <span class="loading"><i class="fa fa-circle-o-notch fa-spin"></i> Loading.....</span>
    <span class="close"></span>
    <div class="content-holder">
        <div class="carousel-container">
            <div class="col-two">
                <h2>Book your <span><?php echo the_title(); ?></span> shoot today</h2>
            </div>
            <div class="col-two">
                <div class="button-area">
                    <a href="/contact-us/" class="but1-a">Enquire today</a>
                    <a href="/photo-packages/" class="but1-b">Book online</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-wrapper">
    <div class="site-width">
        <a name="page-content" id="page-content"></a>
        <?php
        if ((isset($_GET['adult-day']) && $_GET['adult-day'] > 0 && $_GET['adult-day'] < 31) && (isset($_GET['adult-month']) && $_GET['adult-month'] <= 12 && $_GET['adult-month'] > 0) && (isset($_GET['adult-year']) > 0)) {
            // Check if they are 18 years old
            $is18 = validateAge($_GET['adult-day'] . '-' . $_GET['adult-month'] . '-' . $_GET['adult-year']);
            if ($is18) {
                $_SESSION['over_18'] = true;
            } else {
                echo '<p class="alert alert-info">Oops, looks like you are too young to view this content.</p>';
            }
        }
		
        // Check if post is only for adults.
        // if so force the user to enter their age.
        if (get_field('adults_only') && !isset($_SESSION['over_18'])) {
            ?>
			
            <p class="dob-text">This page contains material that is not suitable for persons under the age of 18, please verify your age below to proceed.</p>
            <form name="dob" id="dob" action="<?php echo get_permalink(); ?>" method="GET" class="dob-form">
                <label>Date of birth</label> <input type="text" name="adult-day" placeholder="dd" class="adult-day-month" required/> <input type="text" name="adult-month" placeholder="mm" class="adult-day-month" required/> <input type="text" name="adult-year" placeholder="yyyy" class="adult-year" required/> <span>Example: 09 01 1991</span>
                <button type="submit">Verify Age</button>
            </form>
			
            <?php 
        } else {
            ?>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php
                    the_content();					
                    $gallery = get_field('gallery_images');
                    ?>

                    <script>
                        var galleryElements = [];
            <?php
            $i = 0;
			
            foreach ($gallery as $item) {
                if ($i < 24) {
                    $i++;
                    continue;
                }
                ?>
                            galleryElements.push({
                                'title': "<?php echo $item['title']; ?>",
                                'description': "<?php echo $item['description']; ?>",
                                'url': "<?php echo $item['image']['url']; ?>",
                                'listingUrl': "<?php echo $item['image']['sizes']['gallery-listing']; ?>"
                            });
                <?php
                $i++;
            }
            ?>

                    </script>
					
                    <?php
                endwhile;
                ?>
            <?php else : ?>
			
                <article id="post-not-found" class="hentry cf">
                    <header class="article-header">
                        <h1><?php _e('Oops, Post Not Found!', 'bonestheme'); ?></h1>
                    </header>
                    <section class="entry-content">
                        <p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'bonestheme'); ?></p>
                    </section>
                    <footer class="article-footer">
                        <p><?php _e('This is the error message in the single.php template.', 'bonestheme'); ?></p>
                    </footer>
                </article>
            <?php
            endif;
            ?>
			
        </div>
        <div class="gallery-wrapper-listing">
		
            <?php
            $i = 1;
            foreach ($gallery as $g) {
                if ($i >= 24) {
                    continue;
                }
                echo <<<EOT
                            <div class="gallery-item-listing" data-title="{$g['title']}" data-description="{$g['description']}" data-image="{$g['image']['url']}">
                                <img src="{$g['image']['sizes']['gallery-listing']}"/>
                            </div>
EOT;
                $i++;
            }
            ?>
        </div>
        <?php
        if (count($gallery) > 24) {
            echo '<div class="loading-button"><span class="load-button load-more">LOAD MORE</span></div>';
        }


        $prev = get_field( "left_link" );
        //$previmg = get_field('gallery_images', $prev->ID)[0]['image']['url'];
        $previmg = get_field("left_image");
        if (empty($previmg)){
          $previmg = wp_get_attachment_image_src( get_post_thumbnail_id($prev->post_parent), array(951,400) )[0];
        }
        if (!empty($prev)) {
            ?>
            <a class="gallery-link gallery-link-prev" style="background-image: url('<?php echo $previmg; ?>');" href="<?php echo get_permalink($prev->ID); ?>">
                <span class="gallery-link-text">
                    <i class="fa fa-angle-left"></i> View <?php echo $prev->post_title; ?>
                </span>
            </a>

            <?php
        }


        $next = get_field("right_link");
        $nexttitle = get_cat_name($next);
        $nextimg = get_field("right_image");
        if (empty($nextimg)){
          $nextimg = get_field('category_photo', 'category_'.$next)['url'];
        }
        if (!empty($next)) {
            ?>
            <a class="gallery-link gallery-link-next" style="background-image: url('<?php echo $nextimg; ?>');" href="<?php echo get_category_link($next); ?>">
                <span class="gallery-link-text" >
                    <i class="fa fa-angle-right"></i> View <?php echo $nexttitle; ?> Blog
                </span>
            </a>
        <?php
        }
    }
    ?>
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
    <?php } ?>
</div>
<?php get_footer(); ?>
