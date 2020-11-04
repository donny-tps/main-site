<?php
get_header();

// Template Name: Login
$bg = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
$custom_css .= ".content-page-header{ background:url('{$bg}') no-repeat center center #ededed;background-size:cover;}";
wp_add_inline_style('custom-style', $custom_css);
$intro = get_field('introduction_text', get_the_ID());
?>
<div class="content-page-header">
    <div class="site-width">           
        <div class="intro-wrapper <?php
        if ($intro == '' || $intro == false) {
            echo "no-intro";
        }
        ?>">
            <div class="fancy"><h1><?php echo the_title(); ?></h1></div>
            <div class="intro-text"><?php echo $intro; ?></div>
        </div>
        <div class="down-button-wrapper">
            <a href="#page-content" class="down-arrow"></a>
        </div>
    </div>
</div>
<div class="page-wrapper">
    <div class="site-width">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/BlogPosting">
                    <a name="page-content" id="page-content"></a>
                    <section itemprop="articleBody">
                        <?php
                        // the content (pretty self explanatory huh)
                        the_content();
                        ?>
                        <div class="login-left">
                            <h2>Login</h2>
                            <div class="form-wrapper">
                                <form id="login" action="login" method="post">
                                    <p class="status"></p>
                                    <input id="username" type="text" name="username" class="width100" placeholder="Username">
                                    <input id="password" type="password" name="password" class="width100" placeholder="Password">                               
                                    <input type="submit" value="Login" class="login button black">                        
                                    <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Lost your password?</a>
                                    <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
                                </form>                                
                            </div> 
                        </div>
                        <div class="login-right">
                             <h2>Sign Up</h2>
                            <?php  echo do_shortcode('[gravityform id=7 title=false description=false ajax=true tabindex=100]') ?>

                        </div>


                    </section> <?php // end article section         ?>
                    <footer class="article-footer cf"></footer>                    
                </article>
                <?php
            endwhile;
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
<?php get_footer(); ?>