<?php get_header(); ?>
<div class="innerpage">
	<div class="innerhero" <?php if (has_post_thumbnail()) { ?> style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);" <?php } ?>>
		<div class="title">
			<h1><?php echo $cat->name; ?></h1>
		</div>
	</div>
	<div class="main">
		<div class="inner-container">
			<div class="articles">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
				the_post();
				$cats = get_the_category($id);
				?>
				<div class="single">
					<h3 class="title"><?php echo the_title(); ?></h3>
					<div class="links">
						<p><?php echo get_the_date('M j'); ?> | <?php foreach ( $cats as $cat ): ?> <a href="<?php echo get_category_link($cat->cat_ID); ?>"><?php echo $cat->name; ?></a><?php endforeach; ?></p>
						<div class="share-icons">
							<a class="twitter" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
							<a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
							<a class="email" href="mailto:?subject=I wanted to share this post with you from <?php bloginfo('name'); ?>&body=<?php the_title('','',true); ?>&#32;&#32;<?php the_permalink(); ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a>
						</div>
					</div>
					<div class="text">
						<?php the_excerpt(); ?>
						<a href="<?php the_permalink(); ?>"><button class="btn-blue">CONTINUE READING</button></a>
					</div>
				</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
?>
