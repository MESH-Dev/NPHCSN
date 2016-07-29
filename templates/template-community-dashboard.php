<?php
/*
Template Name: Community Dashboard
*/
?>

<?php get_header(); ?>

<?php if (is_user_logged_in()){ ?>

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
		<div class="six columns identification">
			<?php 
			$id = get_current_user_id();
				//var_dump($id);
				$user_info = get_userdata($id);
				//var_dump($user_info);
				$first_name = $user_info->first_name;
				$last_name = $user_info->last_name;
				$job_title = get_user_meta($id, 'Job Title', true);
				//var_dump($job_title);
				$company = get_user_meta($id, 'Company Name', true);
				//var_dump($company);
				$email = $user_info->user_email;

			?>

			<div class="the-user the-row">
				<div class="label">Name</div><div class="result"> <?php echo $first_name . ' ' . $last_name ?></div>
			</div>
			<div class="the-company the-row">
				<div class="label">Company</div> 
				<div class="result"><?php echo $company; ?></div>
			</div>
			<div class="the-author-title the-row">
				<div class="label">Title</div> 
				<div class="result"><?php echo $job_title; ?></div>
			</div>
			<div class="the-mail the-row">
				<div class="label">Contact</div> 
				<div class="result"><?php echo $email; ?></div>
			</div>
		</div>

		<!-- <div class="intro-text">
			<p><?php echo get_field('page_intro_text'); ?></p>
		</div> -->
	</div>
</div>

<div class="container">
	<?php //variables

		//$date = get_the_date('m.d.y', $post_id);

		$line_length = '40';
		$line_length_short = '30';
		$db_intro_text = get_field('db_intro_text');
		$mr_intro_text = get_field('mr_intro_text')
	?>
	<div class="dashboard row">
		<?php //Discussion board loop ?>
		<div class="six columns alpha ld">
			<h2 class="page-title-inner">
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
			      'order' => 'DESC',
			      
			      );

					$the_query = new wp_Query ($args);

				if ($the_query->have_posts()):
					while ($the_query->have_posts()) : $the_query->the_post();
					$date = get_the_date('m.d.y');
					$short_title = the_title('', '', false);
					$shortened_title = substr($short_title, 0, $line_length);
			?>
			<div class="row list-item">
				<div class="one columns alpha">
					<?php echo $date; ?>
				</div>
				<div class="five columns alpha the-title <?php if(strlen($short_title) >= $line_length){echo "overflow";} ?>">
					<a href="<?php the_permalink() ?>"><?php echo $shortened_title; ?></a>
				</div>
			</div>

			<?php wp_reset_postdata(); endwhile; endif; ?>

			<p class="more">View All Dicussions on the <a href="<?php echo home_url('/') ?>/discussions"><span>DISCUSSION BOARD</span></a> <img src="<?php bloginfo('template_directory'); ?>/assets/img/right-arrow-orange.png"></p>
			<p class="more"><a href="<?php echo home_url('/') ?>/start-a-discussion"><span>Start a discussion</span></a> with other members <img src="<?php bloginfo('template_directory'); ?>/assets/img/right-arrow-orange.png"></p>
		</div>

		<?php //Member resources loop ?>
		<div class="six columns omega mr">
			<h2 class="page-title-inner">
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
					$shortened_title = substr($short_title, 0, $line_length_short);
					$mr_link = get_field('mrf_link', $post->ID);
					$date = get_the_date('m.d.y');

					$member_topics= wp_get_post_terms($post->ID, 'member_topic');

					foreach ($member_topics as $member_topic){
						$mt = $member_topic->name;
						$ms = $member_topic->slug;
						//$mt_filter .= $member_topic->slug . ' ';
					}	
			?>
			<div class="row list-item">
				<div class="four columns alpha the-title <?php if(strlen($short_title) >= $line_length_short){echo "overflow";} ?>">
					<a href="<?php echo $mr_link; ?>"><?php echo $shortened_title; ?></a>
				</div>
				<div class="two columns omega">
					<?php echo $mt; ?>
				</div>
			</div>

			<?php wp_reset_postdata(); endwhile; endif; ?>
			<p class="more">See and search our curated <a href="<?php echo home_url('/'); ?>/member_resources"><span>COMMUNITY RESOURCES</span></a> <img src="<?php bloginfo('template_directory'); ?>/assets/img/right-arrow-orange.png"></p>
		</div>
	</div>

</div>

<?php //get_template_part('partials/quicklinks'); ?>


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
