<?php
$cats = get_the_category($post->ID);
$slugs = '';
foreach ($cats as $cat) {
    $slugs .= ' ' . $cat->slug;
}
?>
<a href="<?= get_permalink($post->ID); ?>" class="post-item post-link all <?= $slugs; ?>">
    <img src="<?= get_the_post_thumbnail_url($post->ID, 'mag_poster') ?>" alt="thumbnail">   
    <div class="links-container">
        <span class="post-title"><?= $post->post_title; ?></span>
        <?php
        if(count($cats) > 0):
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