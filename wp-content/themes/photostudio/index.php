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
            <h1><?php echo get_the_title(62); ?></h1>
            <div class="intro-text"><?php echo get_field('introduction_text', 62); ?></div>
        </div>                    
    </div>
</div>
<div class="page-wrapper"> 
    <div class="site-width">

        <div class="gallery-wrapper">
            <?php
            $args = array(
                'orderby' => 'post_date',
                'order' => 'ASC',
            );
            $terms = get_terms('category', $args);
            foreach ($terms as $c) {
                $bg = get_field('category_photo', 'category_' . $c->term_id);
                ?>
                <div class="gallery-item" style="background-image:url('<?php echo $bg['sizes']['gallery-thumb']; ?>');">                
                    <a href="<?php echo get_term_link($c); ?>">                                            
                        <div class="post-content">
                            <h3><?php echo $c->name; ?></h3>                                                  
                        </div>
                    </a>                
                </div>             

                <?php
            }
            ?>
        </div>
        <?php //echo paginate_links(); ?>
    </div>
</div>  
<?php get_footer(); ?>
