<?php
get_header();

$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
$custom_css .= ".content-page-header{ background: no-repeat center center #ededed;background-size:cover;}";
wp_add_inline_style('custom-style', $custom_css);

global $post;
$post_slug = $post->post_name;

if($post_slug === 'top-10-staples-for-a-guys-photo-shoot') {
    wp_enqueue_script('single-script', get_template_directory_uri() . '/library/js/single-script.js', array( 'jquery' ));
}

?>

<script>
    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php', 
        loadMoreIsActive = true,
        shown_posts = [],
        category_id = <?= get_the_category(get_the_ID())[0]->cat_ID ?>,
        post_id = <?= get_the_ID() ?>;
</script>

<div class="content-page-header blog">
    <div class="site-width">        
        <div class="intro-wrapper blog">
            <h1><?php echo the_title(); ?></h1>              
            <span><time class="updated" datetime="<?php echo get_the_time('Y-m-j'); ?>" pubdate><?php
                    echo get_the_time('d/m/Y', get_the_ID());
                    ?></time>                    
            </span></div>
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
    <div class="site-width">
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

<div id="post-preloader">
    <img src="<?= get_theme_directory_uri() . '/library/images/elipsis-preloader.svg'; ?>" alt="post-preloader">
</div>

</div>


<?php get_footer(); ?>
