<div class="related-posts" style="float: none;">
    <h3>RELATED POSTS FROM THE BLOG</h3>
    <div class="blogpost-items">
    <?php
        //$relatedPosts = get_field('related_posts');

        if(empty($relatedPosts)) {
            $categories = get_the_category( get_the_id() );
            foreach($categories as $c) {
                $cats[] = $c->term_id;
            }
            $args = array(
                'category' => implode(', ', $cats),
                'post_type' => 'post',
                'orderby' => 'rand',
//                'order' => 'ASC',
                'posts_per_page' => -1
            );

            $relatedPosts = get_posts( $args );
        }
        shuffle($relatedPosts);
        foreach ($relatedPosts as $key => $p):
            if( $key >= 6 ) {
                break;
            }
            if (in_category('testimonials', $p)):
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
            endif;
        ?>

            <div class="blogpost-item">

                <a href="<?php echo get_permalink($p->ID); ?>">
                <?php
                    $bg = get_the_post_thumbnail_url($p->ID, 'mag_poster');
                ?>
                    <div class="img-container">
                        <img src="<?= $bg; ?>" alt="<?= $p->post_title; ?>">
                    </div>
                    <div class="post-content">
                        <h3><?php echo $p->post_title ?></h3>
                        <div class="excerpt">
                            <?php echo get_field('short_description', $p->ID); ?>
                        </div>
                    </div>
                </a>
            </div>
    <?php
        endforeach;
    ?>
    </div>
    <div class="related-posts_footer">
        <a href="<?= get_page_link(53341); ?>" class="related-posts_magazine-link">View Magazine</a>
    </div>
</div>
