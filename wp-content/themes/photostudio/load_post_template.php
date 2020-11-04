<div class="site-width post-section" data-post-url="<?= get_permalink(); ?>">    
    <!-- this title no longer needed since headers are now added to the content itself. <h1 style="text-align: center;"><?php #the_title(); ?></h1> -->    
    <?php 
        $vccss = get_post_meta(get_the_ID(), '_wpb_shortcodes_custom_css', true);

        if(!empty($vccss)) 
        {
            $vccss = strip_tags($vccss);
            echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
            echo $vccss;
            echo '</style>';
        } 

        the_content(); 
    ?>
    <?php 
        global $withcomments;
        $withcomments = true; 
        comments_template(); 
    ?>
    <?php
        include(locate_template('related_posts_template.php'));
    ?>
</div>