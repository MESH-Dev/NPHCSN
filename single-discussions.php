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
			<div class="row">
				<div class="eleven columns alpha">
					<h2 class="page-title-inner"><?php the_title(); ?></h2>
				</div>
			</div>
			<!-- <p class="postinfo">By <?php the_author(); ?> | Categories: <?php the_category(', '); ?> | <?php comments_popup_link(); ?></p> -->
			<div class="d-info">
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
					<div class="two columns author-info"><p><?php the_author(); ?></p> <?php if($company != ''){ ?> <p> <?php echo $company; ?> <?php } ?></div>
				</div>
			</div>
			<div class="the-content row">
				<div class="eight columns alpha">
					<?php the_content(); ?>
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="nine columns alpha">
				<div class="comments">
				<?php comments_template( '', true ); ?>
				
				</div>
			</div>
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