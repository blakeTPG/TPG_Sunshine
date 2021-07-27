<?php get_header(); ?>
<div class="innerpage">
	<div class="innerhero" <?php if (has_post_thumbnail()) { ?> style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);" <?php } ?>>
		<div class="title">
			<h1><?php echo the_title(); ?></h1>
		</div>
	</div>
	<div class="main">
		<div class="inner-container">
			<?php echo the_content(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>