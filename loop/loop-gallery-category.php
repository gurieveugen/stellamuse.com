<?php /* Loop Name: Gallery */ ?>
<?php
$category_value = single_cat_title( '', false );
$args = array(
		'post_type'        => 'gallery',
		'gallery_categories' => $category_value,
		'meta_key' => '_thumbnail_id',
		'posts_per_page' => -1
		);
$wp_query = new WP_Query($args);

if (have_posts()) : ?>
<section>
    <ul id="gallery" class="row">
	<li id="fullPreview"></li>
<?php while ($wp_query->have_posts()) : $wp_query->the_post();
	
?>
<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
			$image_full = vt_resize( $thumb,'' , 1170, 781, true, 100 );
		?>	
<li class="gal-item span3">
           <a href="<?php echo $image_full['url']; ?>"></a>
			<div class="hider-page"></div>
			<figure class="featured-thumbnail thumbnail large">
            <img data-original="<?php echo $image_full['url']; ?>" src="img/effects/white.gif" alt="<?php the_title(); ?>" />
            </figure>
            <div class="overLayer"></div>
            <div class="infoLayer">
                        <p>
                            <?php the_title(); ?>
                        </p>
            </div>
            
            <div class="projectInfo">
			<h2><?php the_title();?></h2>
                 <?php the_content(); ?>
            </div>
        </li>

<?php endwhile; ?>
    </ul>
</section>
<?php else: ?> 
<div class="no-results">
	<?php echo '<p><strong>' . theme_locals("there_has") . '</strong></p>'; ?>
	<p><?php echo theme_locals("we_apologize"); ?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>"><?php echo theme_locals("return_to"); ?></a> <?php echo theme_locals("search_form"); ?></p>
	<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
</div><!--no-results-->
<?php endif; ?>
