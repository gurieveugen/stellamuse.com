<?php /* Loop Name: Loop page */ ?>  
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div id="post-separate" <?php post_class('page'); ?>>
        <?php the_content(); ?>
        <?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?><!--.pagination-->
    </div><!--#post-->
<?php endwhile; ?>