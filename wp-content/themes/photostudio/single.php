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

$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
$custom_css .= ".content-page-header{ background: no-repeat center center #ededed;background-size:cover;}#post-preloader{text-align:center;display:none;}#post-preloader>img{width:80px;}li.post{position:relative;}li.post>p{position:absolute;bottom:0;left:20px;right:20px;background-color:#d0d0d0;font-size:20px;padding-top:15px;padding-bottom:15px;text-transform:uppercase;letter-spacing:2px;color:#63666a;}";
wp_add_inline_style('custom-style', $custom_css);

global $post;
$post_slug = $post->post_name;


wp_enqueue_script('single-script', get_template_directory_uri() . '/library/js/single-script.js', array( 'jquery' ));
wp_enqueue_style('single-style', get_template_directory_uri() . '/library/css/single-styles.css');
$cat_name = get_query_var('category_name');
$div_pos = strrpos($cat_name, '/');
$cat_name = $div_pos > -1 ? substr($cat_name, $div_pos + 1) : $cat_name;
$cat_id = get_category_by_slug($cat_name)->term_id;

// Get background image and save urls in JS variables
if( class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('post', 'post-header-image', get_the_ID() ) ) {
    $desktop_image_id = MultiPostThumbnails::get_post_thumbnail_id('post', 'post-header-image', get_the_ID() );
    $desktop_background = wp_get_attachment_image_src($desktop_image_id, 'full')[0];
} else {
    $desktop_background = '';
}
if( class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('post', 'mobile-post-header-image', get_the_ID() ) ) {
    $mobile_image_id = MultiPostThumbnails::get_post_thumbnail_id('post', 'mobile-post-header-image', get_the_ID() );
    $mobile_background = wp_get_attachment_image_src($mobile_image_id, 'full')[0];
} else {
    $mobile_background = '';
}
?>
<script>
    var desktopBackground = "<?= $desktop_background; ?>";
    var mobileBackground = "<?= $mobile_background; ?>";
</script>
<script>
    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php',
        loadMoreIsActive = true,
        shown_posts = [],
        category_id = <?= $cat_id ? $cat_id : ''; ?>,
        post_id = <?= get_the_ID() ?>;
</script>
<div class="content-page-header blog blog-background">
    <div class="site-width">
        <div class="intro-wrapper blog">

			
        </div>
    </div>
    <div class="blog-filters">
        <a href="/blog/" class="filter-item">All</a>
        <?php
        $args = array(
            'orderby' => 'name',
            'order' => 'ASC',
        );
        $terms = get_terms('category', $args);
        foreach ($terms as $t) {
            echo '<a href="' . get_term_link($t, 'category') . '" class="filter-item">' . $t->name . '</a>';
        }
        ?>
    </div>
</div>
</div>

<div class="page-wrapper" id="content-container">
    <div class="site-width post-section" data-post-url="<?= get_permalink(); ?>">
        <a name="page-content" id="page-content"></a>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php
            get_template_part('post-formats/format', get_post_format());
            ?>
        <?php endwhile; ?>
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
        <?php endif; ?>
        <?php comments_template(); ?>
    </div>

    <?php if (get_field('related_posts')) {
        //include(locate_template('set_related_posts.php'));
        //commented out the above code because it was throwing php errors. -Arpan
    }
    ?>

    <div id="post-preloader">
        <img src="<?= get_template_directory_uri() . '/library/images/elipsis-preloader.svg'; ?>" alt="post-preloader" >
    </div>

</div>


<?php get_footer(); ?>
