<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>				
<?php formaticons(); ?>
	<?php 
		$embed = get_post_meta(get_the_ID(), 'tz_video_embed', true);
		//Check for video format
	    $vimeo = strpos($embed, "vimeo");
	    $youtube = strpos($embed, "youtu");
	?>

	
<?php
			if ($embed != '') {?>
			<div class="video-wrap" style="margin: 0px 0px 1.5em;">
			<?php	if($vimeo !== false){

	        //Get ID from video url
	        $video_id = str_replace( 'http://vimeo.com/', '', $embed );
	        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );

	        //Display Vimeo video
	        echo '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0" width="560" height="315" frameborder="0"></iframe>';

	    	} elseif($youtube !== false){

	        //Get ID from video url
	    	$video_id = str_replace( 'http://', '', $embed );
	    	$video_id = str_replace( 'https://', '', $video_id );
	        $video_id = str_replace( 'www.youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtu.be/', '', $video_id );
	        $video_id = str_replace( '&feature=channel', '', $video_id );

	        echo '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="560" height="315" src="http://www.youtube.com/embed/'.$video_id.'?wmode=opaque?rel=0?autoplay=0&html5=1" frameborder="0"></iframe>';

	    	} ?>
				</div>
				<?php } else { ?>

	<?php 
		if (has_post_thumbnail() ):
	?>

	<div class="post-thumb clearfix">		
		<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
			$blog_thumb_width = of_get_option('blog_thumb_width');
			$blog_thumb_height = of_get_option('blog_thumb_height');
			$image = vt_resize( $thumb,'' , $blog_thumb_width, $blog_thumb_height, true, 100 );
			?>
			<figure class="featured-thumbnail thumbnail large">
			<div class="hider-page"></div>
				<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" />
			</figure>
			<div class="clear"></div>			
	</div>
	<?php endif; ?>	
<?php }
		?>
	
			
<div class="row-fluid">
	<div class="span3">
	<?php get_template_part('includes/post-formats/post-meta'); ?>
	</div>
	<div class="span9 leftline">
		<header class="post-header">	
		<?php if(!is_singular()) : ?>
		<?php $blog_author_name = of_get_option('blog_author_name');
              $post_author = of_get_option('post_author');		
		if ($post_author=='yes' || $post_author=='') { ?>
		<span class="post_author"><?php echo $blog_author_name; ?> <?php the_author_posts_link() ?></span>
		<?php } ?>
			<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php echo theme_locals('permalink_to');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<?php else :?>
		<?php $blog_author_name = of_get_option('blog_author_name');
		$post_author = of_get_option('post_author');
		if ($post_author=='yes' || $post_author=='') { ?>
		<span class="post_author"><?php echo $blog_author_name; ?> <?php the_author_posts_link() ?></span>
		<?php } ?>
			<h2 class="post-title"><?php the_title(); ?></h2>
		<?php endif; ?>
	</header>
	<?php $full_content = of_get_option('full_content');
	if(!is_singular() && $full_content!='true') : ?>				
	<!-- Post Content -->
	<div class="post_content">
		<?php $post_excerpt = of_get_option('post_excerpt');
$blog_excerpt = of_get_option('blog_excerpt_count');		?>
		<?php if ($post_excerpt=='true' || $post_excerpt=='') { ?>		
			<div class="excerpt">			
			<?php 
				$content = get_the_content();
				$excerpt = get_the_excerpt();
			if (has_excerpt()) {
				the_excerpt();
			} else {
				if(!is_search()) {
				echo my_string_limit_words($content,$blog_excerpt);
				} else {
				echo my_string_limit_words($excerpt,$blog_excerpt);
				}
			} ?>			
			</div>
		<?php } ?>
		<?php
		$readmore_button = of_get_option('readmore_button');
if ($readmore_button=='yes') { ?>
		<a href="<?php the_permalink() ?>" class="btn22 btn-1 btn-1c"><?php echo theme_locals("read_more"); ?></a>
		<div class="clear"></div>
		<?php } ?>
	</div>
					
	<?php else :?>	
	<!-- Post Content -->
	<div class="post_content">	
		<?php the_content(''); ?>
		<?php wp_link_pages('before=<div class="pagelink">&after=</div>'); ?>
		<div class="clear"></div>
	</div>
	<!-- //Post Content -->	
	<?php endif; ?>
	</div>	 </div>       
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article><!--//.post__holder-->