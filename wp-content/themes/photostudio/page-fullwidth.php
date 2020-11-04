<?php get_header(); 
// Template Name: Fullwidth
?>
<div class="site-width">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/BlogPosting">
                <section itemprop="articleBody">
                    <?php
                    // the content (pretty self explanatory huh)
                    the_content();
                    ?>
                </section> <?php // end article section   ?>

                <footer class="article-footer cf"></footer>
            </article>
        <?php endwhile;
    else :
        ?>

        <article id="post-not-found" class="hentry cf">
            <header class="article-header">
                <h1><?php _e('Oops, Post Not Found!', 'bonestheme'); ?></h1>
            </header>
            <section class="entry-content">
                <p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'bonestheme'); ?></p>
            </section>
            <footer class="article-footer">
                <p><?php _e('This is the error message in the page.php template.', 'bonestheme'); ?></p>
            </footer>
        </article>

<?php endif; ?>
</div>
<?php get_footer(); ?>