<?php
/*
Template Name: Signup Page
*/
?>

<?php get_header(); ?>

<div class="page-header">
	<div class="container">
		<div class="twelve columns page-title">
			<h1>Tools for Change</h1>
		</div>
	</div>
</div>

<div class="container">
	<div class="signup">
		<?php echo FrmFormsController::get_form_shortcode( array( 'id' => 5, 'title' => false, 'description' => false ) ); ?>
	</div>
</div>


<?php get_footer(); ?>
