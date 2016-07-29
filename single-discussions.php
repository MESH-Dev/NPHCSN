<?php get_header(); ?>

<?php if (is_user_logged_in()){ ?>

<div id="content">
	<div class="container">
	
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php 
			//Variables

			$date = get_the_date('m.d.y');

			$id = get_the_author_meta('ID');

			$auth_id = get_the_author_meta();
			
			$company = get_the_author_meta('Company Name');

			

			
		?>
		
		<div class="post single-discussion">
			<h2 class="page-title-inner"><?php the_title(); ?></h2>
			<!-- <p class="postinfo">By <?php the_author(); ?> | Categories: <?php the_category(', '); ?> | <?php comments_popup_link(); ?></p> -->
			<div class="topic row">
				<div class="two columns alpha label">Topic:</div>
				<div class="two columns result">Topic 1</div>
			</div>
			<div class="date row">
				<div class="two columns alpha label">Date:</div>
				<div class="two columns"><?php echo $date ?></div>

			</div>
			<div class="post-author row">
				<div class="two columns alpha label">Posted by:</div>
				<div class="two columns author-info"><?php the_author(); ?></br> <?php echo $company; ?></div>
			</div>
			<div class="the-content row">
				<?php the_content(); ?>
			</div>
		</div>
		<div class="comments">
		<?php comments_template( '', true ); ?>
		
		</div>
		
	<?php endwhile; ?>
	</div>
	
		<?php get_template_part('partials/quicklinks'); ?>

</div><!-- End of Content -->

<?php } else { 

	$home = get_home_url('/');
	//$home = 'http://localhost:8888/nphcsn';
	$login = $home . '/login';

	//header('Location:' . $login);
	wp_redirect($login);

	//auth_redirect();
	//exit();
	}
	?>

<?php get_footer(); ?>