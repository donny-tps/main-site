<?php
get_header();
$bg = wp_get_attachment_url(get_post_thumbnail_id(59));

$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
$custom_css .= ".content-page-header{ background:url('{$bg}') no-repeat center center #ededed;background-size:cover;}";
wp_add_inline_style('custom-style', $custom_css);
?>
<div class="content-page-header">
    <div class="site-width">        
        <div class="intro-wrapper no-intro">
            <div class="fancy"><h1><?php echo get_the_title(59); ?></h1></div>
            <div class="intro-text"><?php echo get_field('introduction_text', 59); ?></div>
        </div>        
    </div>
</div>
<div class="page-wrapper"> 
    <div class="site-width">
        <div class="gallery-wrapper">
            <?php
            if (have_posts()) : while (have_posts()) : the_post();            
            $bg = wp_get_attachment_image_src( get_post_thumbnail_id(), $size='gallery-thumb' );
            ?>
                    <div class="gallery-item" style="background-image:url('<?php echo $bg[0]; ?>');">                
                        <a href="<?php echo get_permalink(); ?>">                                            
                            <div class="post-content">
                                <h3><?php the_title(); ?></h3>                                                  
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
        <?php //echo paginate_links(); ?>
    </div>
</div>  
<?php get_footer(); ?>
