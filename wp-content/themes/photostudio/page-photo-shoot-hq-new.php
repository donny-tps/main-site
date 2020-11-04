<?php
get_header();
$bg = wp_get_attachment_url(get_post_thumbnail_id(62));
$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
wp_enqueue_style('blog-styles', get_template_directory_uri() . '/library/css/blog-styles.css');
wp_enqueue_style('mCustomScrollbar-styles', get_template_directory_uri() . '/library/css/jquery.mCustomScrollbar.min.css');
wp_enqueue_script('hammer', get_template_directory_uri() . '/library/js/hammer.min.js', array( 'jquery' ));
wp_enqueue_script('blog-scripts', get_template_directory_uri() . '/library/js/blog-scripts.js', array( 'jquery', 'hammer' ));
wp_enqueue_script('mCustomScrollbar-scripts', get_template_directory_uri() . '/library/js/jquery.mCustomScrollbar.concat.min.js', array( 'jquery' ));
$custom_css .= ".content-page-header{ background:url('{$bg}') no-repeat center center #ededed;background-size:cover;}";
wp_add_inline_style('custom-style', $custom_css);

$cats = get_categories(
    array(
            //'parent' => null
            'include' => [102,125,126,127,128,129,130]
        )
);

?>
<style>
    
</style>
<div id="hammer-open">
    <div class="hammer-line"></div>
    <div class="message">
        Filter by category
    </div>
</div>
<div class="content-page-header blog">
    <div class="site-width">        
        <div class="intro-wrapper blog">
            <h1><?php echo get_the_title(); ?></h1>
            <div class="gallery-bar">
                <button id="show-filter">
                    <i class="icon"></i>
                    Filter by category
                </button>
            </div>
<!--            <div class="intro-text">--><?php //echo get_field('introduction_text'); ?><!--</div>-->
        </div>                    
    </div>
</div>
<div class="page-wrapper"> 
    <div id="categories-drawer" class="hidden">
        <div class="drawer-head">
            <h4 class="title">Filter categories</h4>
            <button id="close-drawer-button"></button>
        </div>
        <div class="drawer-container">
            <div id="categories-inputs">
            <?php
                foreach ($cats as $category):
            ?>
                <div class="parent-cat">
                    <?php 
//                        $child_cats = get_categories(
//                            array(
//                                'parent' => $category->term_id,
//                            )
//                        );
                    ?>

                    <input class="checkbox" type="checkbox" id="<?= $category->slug; ?>" name="<?= $category->slug; ?>">
                    <label for="<?= $category->slug; ?>"><?= $category->name; ?></label>
                    
                    <?php
                        if(count($child_cats) > 0): 
                    ?>
                        <div class="child-cats">
                        <?php
                            foreach ($child_cats as $child_category):
                        ?>
                            <div class="child-cat">
                                <input class="checkbox" type="checkbox" id="<?= $child_category->slug; ?>" name="<?= $child_category->slug; ?>">
                                <label for="<?= $child_category->slug; ?>"><?= $child_category->name; ?></label>

                                <?php    
                                    $grand_child_cats = get_categories(
                                        array( 'parent' => $child_category->term_id)
                                    );

                                    if(count($grand_child_cats) > 0): 
                                ?>
                                    <div class="grand-child-cats">
                                    <?php
                                        foreach ($grand_child_cats as $grand_child_category):
                                    ?>
                                    <div class="grand-child-cat">
                                        <input class="checkbox" type="checkbox" id="<?= $grand_child_category->slug; ?>" name="<?= $grand_child_category->slug; ?>">
                                        <label for="<?= $grand_child_category->slug; ?>"><?= $grand_child_category->name; ?></label>
                                    </div>
                                    <?php
                                        endforeach;
                                    ?>
                                    </div>
                                <?php
                                    endif;
                                ?>
                            </div>
                        <?php
                            endforeach;
                        ?>
                        </div>
                    <?php
                        endif;
                    ?>
                </div>
            <?php
                endforeach;
            ?>
            </div>
        </div>
    </div>    
    <div class="site-width">
<!--        <div class="gallery-bar">-->
<!--            <button id="show-filter">-->
<!--                <i class="icon"></i>-->
<!--                show filter-->
<!--            </button>-->
<!--        </div>-->
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
            <div class="post-items-wrapper">
                <?php
                    foreach($posts as $post):
                ?>
                    <?php get_template_part( 'post-item' );  ?>
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
