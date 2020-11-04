<?php
get_header();
//Template Name: Confirm Vote
$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
$custom_css .= ".content-page-header{ background: no-repeat center center #ededed;background-size:cover;}";
wp_add_inline_style('custom-style', $custom_css);
?>

<div class="content-page-header blog">
    <div class="site-width">        
        <div class="intro-wrapper blog">
            <h1><?php echo the_title(); ?></h1>              
        </div>
     </div>
</div>

<div class="page-wrapper">
    <div class="site-width">
        <a name="page-content" id="page-content"></a>
        <?php if (have_posts()) : while (have_posts()) : the_post();
                echo VotingSystem::verifyVote();
                echo the_content();
            endwhile; ?>
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
    </div>
</div>


<?php get_footer(); ?>
