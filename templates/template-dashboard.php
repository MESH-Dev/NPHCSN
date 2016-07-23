<?php
/*
Template Name: Community Dashboard
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

<div class="page-banner">
	<div class="container">
		<div class="six columns">
			<h1 class="page-title"><?php echo get_field('page_title'); ?></h1>
		</div>
		<div class="six columns">
			<?php 
			$id = get_current_user_id();
				//var_dump($id);
				$user_info = get_userdata($id);
				$first_name = $user_info->first_name;
				$last_name = $user_info->last_name;
				$job_title = $user_info->job_title;
				$company = $user_info->company_name;
				$email = $user_info->email;

			?>
			<p class="the-user">Name <?php echo $first_name . ' ' . $last_name ?></p>
			<p class="the-company">Company <?php echo $company; ?></p>
			<p class="the-author-title">Title <?php echo $job_title; ?></p>
			<p class="the-mail">Contact <?php echo $email; ?></p>
		</div>

		<!-- <div class="intro-text">
			<p><?php echo get_field('page_intro_text'); ?></p>
		</div> -->
	</div>
</div>

<div class="container">
	<?php //variables

		$date = get_the_date('m.d.y');

		$line_length = '30';
		$db_intro_text = get_field('db_intro_text');
		$mr_intro_text = get_field('mr_intro_text')
	?>
	<div class="dashboard">
		<?php //Discussion board loop ?>
		<div class="six columns alpha ld">
			<h2 class="page-title-innner">
				Discussion Board
			</h2>
			<div class="intro">
				<p><?php echo $db_intro_text; ?></p>
			</div>
			<p class="title">
				Latest Discussions
			</p>


			<?php //Discussions loop
			
				$args = array(
			      'post_type' => 'discussions',
			      'posts_per_page' => 5,
			      'post_status' => 'publish',
			      'orderby' => 'date',
			      'order' => 'ASC',
			      
			      );

					$the_query = new wp_Query ($args);

				if ($the_query->have_posts()):
					while ($the_query->have_posts()) : $the_query->the_post();
					$short_title = the_title('', '', false);
					$shortened_title = substr($short_title, 0, $line_length);
			?>
			<div class="row list-item">
				<div class="one columns omega">
					<?php echo $date; ?>
				</div>
				<div class="four columns the-title <?php if(strlen($short_title) >= $line_length){echo "overflow";} ?>">
					<?php echo $shortened_title; ?>
				</div>
			</div>

			<?php wp_reset_postdata(); endwhile; endif; ?>

			<p class="more"><a href="#">View All Dicussions on the <span>DISCUSSION BOARD</span></a></p>
			<p class="more"><a href="#"><span>Start a discussion</span> with other members</a></p>
		</div>

		<?php //Member resources loop ?>
		<div class="six columns omega mr">
			<h2 class="page-title-innner">
				Curated Resources
			</h2>
			<div class="intro">
				<p><?php echo $mr_intro_text; ?></p>
				<?php 

					$mr_subsection_title = get_field('mr_subsection_title');
					$mr_subsection_content = get_field('mr_subsection_content');

					if($mr_subsection_title != ''){
				?>
				<h3 class="sub-title"><?php echo $mr_subsection_title; ?></h3>
				<p class="subsection"><?php echo $mr_subsection_content; ?></p>
				<?php } ?>
			</div>
			<p class="title">
				Recently Uploaded Resources
			</p>

			<?php //Discussions loop
				

				$args = array(
			      'post_type' => 'member_resources',
			      'posts_per_page' => 5,
			      'post_status' => 'publish',
			      'orderby' => 'date',
			      'order' => 'ASC'

			      
			      );

					$the_query = new wp_Query ($args);

				if ($the_query->have_posts()):
					while ($the_query->have_posts()) : $the_query->the_post();

					$short_title = the_title('', '', false);
					$shortened_title = substr($short_title, 0, $line_length);
			?>
			<div class="row list-item">
				<div class="one columns omega">
					<?php echo $date;?>
				</div>
				<div class="four columns the-title <?php if(strlen($short_title) >= $line_length){echo "overflow";} ?>">
					<?php echo $shortened_title; ?>
				</div>
			</div>

			<?php wp_reset_postdata(); endwhile; endif; ?>
			<p class="more"><a href="#">See and search our curated <span>COMMUNITY RESOURCES</span></a></p>
		</div>
	</div>

</div>

<?php get_template_part('partials/quicklinks'); ?>


<?php get_footer(); ?>
