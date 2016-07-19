<?php
/*
Template Name: Login Page
*/
?>
<?php get_header(); ?>

<div class="page-header">
	<div class="container">
		<div class="twelve columns page-title">
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
</div>

<div class="container intro">
	<h2 class="page-title-inner"><?php echo get_field('login_welcome'); ?></h2>
	<div class="intro-text">
		<p><?php echo get_field('login_welcome_text'); ?></p>
	</div>
</div>

<div class="container">
	<div class="seven columns">
		<div class="community-login">
			
			<?php 
			$args = array(
				'echo'           => true,
				'remember'       => true,
				'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
				'form_id'        => 'loginform',
				'id_username'    => 'user_login',
				'id_password'    => 'user_pass',
				'id_remember'    => 'rememberme',
				'id_submit'      => 'c-submit',
				'label_username' => __( 'Email' ),
				'label_password' => __( 'Password' ),
				'label_remember' => __( 'Remember Me' ),
				'label_log_in'   => __( 'Log In' ),
				'value_username' => '',
				'value_remember' => false
			);

			?>
			<?php wp_login_form( $args ); ?> 
		</div>
	</div>
</div>

<?php get_footer(); ?>
