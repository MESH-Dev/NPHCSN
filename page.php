<?php get_header(); ?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="page-header">
		<div class="container">
			<div class="twelve columns page-title">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</div>

	<div class="container main-content">
		<div class="four columns sidebar">
			<h2><?php the_field('sidebar_callout');?>	
		</div>

		<div class="eight columns page-content">
			<?php the_content();?>
		</div>

	</div>



	<?php endwhile; ?>
<?php get_footer(); ?>