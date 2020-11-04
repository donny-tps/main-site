<article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/BlogPosting">
    <section itemprop="articleBody">
        <?php
        // the content (pretty self explanatory huh)
        the_content();
        ?>
    </section> <?php // end article section  ?>
</article> <?php
        // end article ?>