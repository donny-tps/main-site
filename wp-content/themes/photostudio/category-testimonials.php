<?php
get_header();
$bg = wp_get_attachment_url(get_post_thumbnail_id(62));
$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
$custom_css .= ".content-page-header{ background:url('{$bg}') no-repeat center center #ededed;background-size:cover;}";
wp_add_inline_style('custom-style', $custom_css);
?>
<div class="content-page-header blog">
    <div class="site-width">        
        <div class="intro-wrapper blog">
            <?php if (is_category()) { ?>
                <h1 class="archive-title h2">
                    <span><?php single_cat_title(); ?>
                </h1>

            <?php } elseif (is_tag()) { ?>
                <h1 class="archive-title h2">
                    <span><?php single_tag_title(); ?>
                </h1>

                <?php
            } elseif (is_author()) {
                global $post;
                $author_id = $post->post_author;
                ?>
                <h1 class="archive-title h2">

                    <span><?php _e('Posts By:', 'bonestheme'); ?></span> <?php the_author_meta('display_name', $author_id); ?>

                </h1>
            <?php } elseif (is_day()) { ?>
                <h1 class="archive-title h2">
                    <span><?php _e('Daily Archives:', 'bonestheme'); ?></span> <?php the_time('l, F j, Y'); ?>
                </h1>

            <?php } elseif (is_month()) { ?>
                <h1 class="archive-title h2">
                    <span><?php _e('Monthly Archives:', 'bonestheme'); ?></span> <?php the_time('F Y'); ?>
                </h1>

            <?php } elseif (is_year()) { ?>
                <h1 class="archive-title h2">
                    <span><?php _e('Yearly Archives:', 'bonestheme'); ?></span> <?php the_time('Y'); ?>
                </h1>
            <?php } ?>

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
<div class="page-wrapper"> 
    <div class="site-width">
        <div class="blogpost-wrapper">
            <?php
            if (have_posts()) : while (have_posts()) : the_post();

                    $_postTerms = wp_get_post_terms(get_the_ID(), 'category');

                    $terms = '';
                    foreach ($_postTerms as $t) {
                        $terms .= $t->slug . ' ';
                    }
                    ?>
                    <?php
                    if (in_category('testimonials')) {
                        ?>
                        <div class="blogpost-item all <?php echo $terms; ?>">
                            <a href="<?php echo get_permalink(); ?>" class="testimonial">
                                <span class="quote-quote">"</span>
                                <span class="quote-content"><?php echo substr(get_the_content(), 0, 75); ?>....</span>
                                <span class="person-name"><?php the_title(); ?></span>
                            </a>
                        </div>
                        <?php
                        continue;
                    }
                    ?>
                    <div class="blogpost-item  all <?php echo $terms; ?>">                
                        <a href="<?php echo get_permalink(); ?>">                
                            <?php echo the_post_thumbnail('full'); ?>                
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
                <?php endwhile; ?>
                <?php bones_page_navi(); ?>
            <?php else : ?>
                <article id="post-not-found" class="hentry cf">
                    <header class="article-header">
                        <h1><?php _e('Oops, Post Not Found!', 'bonestheme'); ?></h1>
                    </header>
                    <section class="entry-content">
                        <p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'bonestheme'); ?></p>
                    </section>
                    <footer class="article-footer">
                        <p><?php _e('This is the error message in the index.php template.', 'bonestheme'); ?></p>
                    </footer>
                </article>
            <?php endif; ?>

        </div>    
        <?php //echo paginate_links();  ?>
    </div>
</div>  
<?php get_footer(); ?>
