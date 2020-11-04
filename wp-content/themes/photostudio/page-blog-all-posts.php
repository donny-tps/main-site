<?php
// Template Name: All Blog Posts
get_header();
$bg = wp_get_attachment_url(get_post_thumbnail_id(62));
$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
$custom_css .= ".content-page-header{ background:url('{$bg}') no-repeat center center #ededed;background-size:cover;}";
wp_add_inline_style('custom-style', $custom_css);
?>

<div class="content-page-header blog">

</div>
<div class="page-wrapper"> 
    <div class="site-width">
        <div class="blogpost-wrapper">
             <script>var blogPosts = [];</script>
            <?php $i = 0; ?>
        <script>
            <?php             
            if (have_posts()) : while (have_posts()) : the_post(); 
            ?>
            <?php                
                if($i > 4){

                    $_postTerms = wp_get_post_terms(get_the_ID(), 'category');
                    $terms = '';
                    foreach ($_postTerms as $t) {
                        $terms .= $t->slug . ' ';
                    } ?>
                    blogPosts.push({
<?php

                    if (in_category('testimonials')) { 
                        echo "'isTestimonial': true,";
                    }
                    else {
                        echo "'isTestimonial': false,";
                    }
?>

                        'terms': '<?php echo $terms; ?>',
                        'url': '<?php echo get_permalink(); ?>',
                        'thumbnail': '<?php echo the_post_thumbnail("full"); ?>',
                        'title': '<?php echo get_the_title(); ?>',
                        'excerpt': '<?php
                                        $ia = 0;
                                        foreach ($_postTerms as $t) {
                                            if ($ia >= 1) {
                                                echo ", ";
                                            }
                                            echo $t->name;
                                            $ia++;
                                        } ?>',
                        'description': '<?php echo trim(preg_replace('/\s+/', ' ', strip_tags(get_field("short_description")))); ?>',

                        'content': "<?php //echo substr(get_the_content(), 0, 75); ?>",

                    });   


                    <?php 
                }                   
                $i++;             
                endwhile;                
            endif;
            
        ?>
</script>
<?php
$ii = 0;
            if (have_posts()) : while (have_posts()) : the_post();
if($ii > 4){
    $ii++;
    continue;
}


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

                <?php
$ii++;
                endwhile;         
         ?>

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
            <?php endif;?>

        </div>    

        <?php //echo paginate_links();
        $queried_object = get_queried_object();

            if ($queried_object->category_count > 5) {
                echo '<div class="loading-button"><span class="load-button load-more-posts">LOAD MORE</span></div>';
            }

        ?>
    </div>
</div>  
<script>
    console.log(blogPosts);
    console.log('dddd');
    </script>
<?php get_footer(); ?>
