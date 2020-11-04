<?php
get_header();
$bg = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
$custom_css .= ".content-page-header{ background:url('{$bg}') no-repeat center center #ededed;background-size:cover;}";
//if(is_page('female-modelling-m')) {
 	if (class_exists('MultiPostThumbnails')) {
		$bg_second = '';
		$bg_second = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-image', NULL, 'large');
		
 		$custom_css .= "@media only screen and (max-width: 576px) { .content-page-header { background-image: url('{$bg_second}'); } } ";
 	}	
//}
wp_add_inline_style('custom-style', $custom_css);
$intro =  get_field('introduction_text', get_the_ID()); 
$show_bt = false;
?>
<?php // if(is_page('female-modelling-m') || is_page( 'female-modelling' ) || is_page( 'female-modelling-3' )): ?>
<style>
	.image-container .image-block-container {
		padding-right: 15%;
		padding-left: 15%;
		margin-bottom: 20px;
	}	
	
	.image-container .image-block-container > .vc_column-inner .wpb_text_column,
	.image-container .image-block-container > .vc_column-inner .image-content p,
	.image-container .image-block-container > .vc_column-inner .image-title p {
		margin: 0;
	}
	
	.image-container .image-block-container > .vc_column-inner .image-title p {
		text-align: center;
		color: #fff;
		text-transform: uppercase;
		font-size: 21px;
		font-weight: bold;
		text-shadow: 2px 1px 2px rgba(0, 0, 0, 0.6);
	}	
	
	.image-container .image-block-container > .vc_column-inner {
		height: 100%;
		padding-top: 0;
		border-radius: 50%;
		overflow: hidden;
		display: flex;
		align-items: center;
		background-position: center center;
		background-repeat: no-repeat;
		background-size: cover;
		position: relative;
	}
	
	.image-container .image-block-container > .vc_column-inner .wpb_wrapper {
		width: 100%;
	}
	
	.image-container .image-block-container > .vc_column-inner .image-content,
	.image-container .image-block-container > .vc_column-inner .image-title {		
		position: absolute;
		padding: 0 5%;
		display: flex;
		align-items: center;		
		color: #fff;
	}
	
	.image-container .image-block-container > .vc_column-inner .image-title {
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		background-color: rgba(0, 0, 0, 0.25);
	}
	
	.image-container .image-block-container > .vc_column-inner .image-content {
		left: 50%;
		right: 50%;
		top: 50%;
		bottom: 50%;		
		background-color: rgba(0, 0, 0, 0.9);
		opacity: 0;
		visibility: hidden;
		overflow: hidden;
		border-radius: 50%;
		font-size: 12px;
		transition: visibility 0s, all 0.3s ease-in-out;
	}
	
	.image-container .image-block-container > .vc_column-inner .image-content p {
		opacity: 0;
	}
	
	.image-container .image-block-container > .vc_column-inner:hover .image-content p {
		opacity: 1;
	}
	
	.image-container .image-block-container > .vc_column-inner:hover .image-content p {		
		transition: opacity 0.3s ease-in-out 0.3s;
	}
	
	.image-container .image-block-container > .vc_column-inner:not(:hover) .image-content p {		
		transition: opacity 0s;
	}
	
	.image-container .image-block-container > .vc_column-inner:hover .image-content {
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		opacity: 1;
		visibility: visible;
	}
		
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
<script>
	jQuery(document).ready(setImgWidth);
	jQuery(window).resize(setImgWidth);
	
	function setImgWidth() {
		var elems = jQuery('.image-container .image-block-container');
		var elemWidth = elems.width();
		elems.height(elemWidth);
	}
</script>
<?php // endif; ?>
<div class="content-page-header">
    <div class="site-width">   
        <div class="intro-wrapper <?php if($intro == '' || $intro == false){ echo "no-intro";}?>">
            <div class="fancy"><h1><?php echo the_title(); ?></h1></div>
			
            <div class="intro-text"><?php echo $intro; ?></div>
        </div>
        <div class="down-button-wrapper">
            <a href="#page-content" class="down-arrow" id="button-arrow-down"></a>
            <?php if($show_bt): ?>
            <a href="#page-content" 
                    class="down-button"
                    id="button-talk-down"
                    style="color: <?php the_field('button_down_page_text_color') ?>!important; 
                    background-color: <?php the_field('button_down_page_background-color') ?>!important;
                    display: none;"
            >
                <?php the_field('button_down_page_text'); ?>
            </a>
            <?php endif; ?>
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
                    </section> <?php // end article section       ?>
                    <footer class="article-footer cf"></footer>
                    <?php comments_template(); ?>
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
<?php if (get_field('related_posts')) { //
    ?>
    <div class="related-posts">
        <div class="site-width">

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