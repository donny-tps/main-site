<?php

get_header();
$bg = wp_get_attachment_url(get_post_thumbnail_id(62));
$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
wp_enqueue_style('blog-styles', get_template_directory_uri() . '/library/css/blog-styles.css');
wp_enqueue_script('magazine-scripts', get_template_directory_uri() . '/library/js/magazine-scripts.js', array( 'jquery' ));
$custom_css .= ".content-page-header{ background:url('{$bg}') no-repeat center center #ededed;background-size:cover;}";
wp_add_inline_style('custom-style', $custom_css);

?>
<div class="content-page-header blog">
    <div class="site-width">
        <div class="intro-wrapper blog">
            <h1><?php echo get_the_title(); ?></h1>
            <div class="gallery-bar"></div>
        </div>
    </div>
</div>

<div class="page-wrapper">
    <div class="site-width">
        <?php
            $query = new WP_Query(array(
                'orderby' => 'date',
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish'
            ));

            $posts = $query->posts;
            
            if(count($posts) > 0):
        ?>
        <div id="post-items-with-bt">
            <div class="post-items-wrapper post-items-wrapper-plus post-items-wrapper-plus-mobile">
                <?php
                    foreach($posts as $post):
                        $first_page_posts[] .= $post->ID;
                ?>
                    <?php get_template_part( 'post-item-plus' );  ?>
                <?php
                    endforeach;
                ?>
            </div>
            <?php if (  $query->max_num_pages > 1 ) : ?>
                <script>
                    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                    var posts_query = '<?php echo serialize($query->query_vars); ?>';
                    var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                    var max_pages = '<?php echo $query->max_num_pages; ?>';
                    var first_page_posts = '<?php echo serialize($first_page_posts); ?>';
                </script>
                <button id="load-more-button">Load more</button>
            <?php endif; ?>
            <?php
                endif;
            ?>
        </div>        
        <?php //echo paginate_links(); ?>
    </div>
</div>  
<?php get_footer(); ?>
