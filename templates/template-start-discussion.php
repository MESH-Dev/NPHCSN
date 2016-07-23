<?php
/*
Template Name:  Start a discussion
*/
?>
<?php get_header(); ?>

<div class="page-header">
	<div class="container">
		<div class="twelve columns page-title">
			<h1><?php echo the_title(); ?></h1>
		</div>
	</div>
</div>

<div class="container intro">
	<h2 class="page-title-inner"><?php echo get_field('page_title'); ?></h2>
	<div class="intro-text">
		<p><?php echo get_field('page_intro_text'); ?></p>
	</div>
</div>

<div class="container">
	<div class="start-discussion">
		<?php echo FrmFormsController::get_form_shortcode( array( 'id' => 6, 'title' => false, 'description' => false ) ); ?>
	</div>
</div>

<?php get_footer(); ?>
