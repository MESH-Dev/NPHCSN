<?php
/*
Template Name: Login Page
*/
?>
<?php get_header(); ?>

<?php if (! is_user_logged_in()){ ?>

<div class="page-header">
	<div class="container">
		<div class="twelve columns page-title">
			<h1><?php the_title(); ?></h1>
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

<?php } else { 

	$home = get_home_url('/');
	//$home = 'http://localhost:8888/nphcsn';
	$login = $home . '/community-dashboard';

	//header('Location:' . $login);
	wp_redirect($login);

	//auth_redirect();
	//exit();
	}
	?>

<?php get_footer(); ?>
