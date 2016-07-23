<?php get_header(); ?>

<div id="content">
	<div class="container">
	
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php 
			//Variables

			$date = get_the_date('m.d.y');

			$id = get_the_author_meta();
			//var_dump("User data" . $id);

			$auth_id = get_the_author_meta();
			//var_dump("Author ID" . $auth_id);
			
			$user_info = get_userdata($id);
			
			$company = get_user_meta($user_info, 'company_name', true);

			//var_dump($company);

			$all_meta = get_user_meta($id);
			//var_dump("Get user meta" . $all_meta);

			
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
				<div class="two columns"><?php the_author(); ?></br> <?php echo $company; ?></div>
			</div>
			<div class="the-content row">
				<?php the_content(); ?>
			</div>
		</div>
		
		<?php comments_template( '', true ); ?>
		
	<?php endwhile; ?>
	</div>
</div><!-- End of Content -->



<?php //get_sidebar(); ?>
<?php get_footer(); ?>