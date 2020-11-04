<?php
$cats = get_the_category($post->ID);
$slugs = '';
foreach ($cats as $cat) {
    $slugs .= ' ' . $cat->slug;
}
?>
<div class="post-<?= $post->ID; ?> post-item post-link all <?= $slugs; ?>">
    <div class="post-item_cart">
        <a href="<?= get_permalink($post->ID); ?>?ref=tpsmag" class="post-item_cart-front">
            <span class="post-item_cart-open-back">
                flip card
                <!--                <i class="fa fa-arrow-right" aria-hidden="true"></i>-->
            </span>
            <img src="<?= get_the_post_thumbnail_url($post->ID, 'mag_poster') ?>" alt="Thumbnail <?= $post->post_title; ?>">
            <div class="links-container">
                <span class="post-title"><?= $post->post_title; ?></span>
                <?php
                if(count($cats) > 0) :
                    ?>
                <div class="cat-links">
                    <?php
                        $i = 1;
                        foreach($cats as $cat):
                    ?>
                        <object type="lol/wut"><?= $cat->name; ?></object>
                        <?php
                            // category link deleted by arpan.
                        ?>
                        <?php
                            if(count($cats) !== $i):
                                $i++;
                        ?>
                        <span class="divider">,</span>
                        <?php
                            endif;
                        ?>
                    <?php
                        endforeach;
                    ?>
                </div>
                <?php
                    endif;
                ?>
            </div>
        </a>
        <div class="post-item_cart-back">
            <span class="post-item_cart-open-back">
                flip card
<!--                <i class="fa fa-arrow-left" aria-hidden="true"></i>-->
            </span>
            <div class="post-item_cart-back-content post-item_cart-back-content__bottomhide" data-opened="false">
                <?php
                    $no_shortcodes = preg_replace( '~\[[^\]]+\]~', '', $post->post_content );
                    $replace_on_br = preg_replace("(<[^<>]+>)", '<br>', $no_shortcodes);
                    $replace_on_br = preg_replace('/\<br\>\<br\>/', '<br>', $replace_on_br);
                    if( strlen($replace_on_br) > 500 ) {
                        $content = iconv_substr ($replace_on_br, 0 , 500 , 'UTF-8' ) . '...';
                    } else {
                        $content = $replace_on_br;
                    }
                ?>
                <?php echo $content; ?>
                <a href="<?= get_permalink($post->ID); ?>?ref=tpsmag" class="post-item_readmore">
                    Read More
                </a>
                <div class="post-item_share-links">
                    <a href="https://www.facebook.com/sharer.php?u=<?php the_permalink($post->ID); ?>&amp;t=<?php echo $post->post_title; ?>" class="" target="_blank">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>