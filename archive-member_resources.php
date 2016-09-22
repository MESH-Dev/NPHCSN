<?php get_header(); ?>


<?php if (is_user_logged_in()){ ?>
<div class="page-header">
	<div class="container">
		<div class="twelve columns page-title">
			<h1>Community Resources</h1>
		</div>
	</div>
</div>

<div class="container">
	<?php 
	$title = get_field('mr_page_title', 'options');
	$intro_text = get_field('mr_intro_text', 'options');
	?>

	<h2 class="page-title-inner"><?php echo $title; ?></h2>
	<div class="row">
		<div class="seven columns alpha">
			<div class="intro-text">
				<p><?php echo $intro_text; ?></p>
				<p>Note: <img src="<?php bloginfo('template_directory'); ?>/assets/img/curated.png"> indicates that the resources was produced by The National Partnership</p>
			</div>
		</div>
	</div>
</div>	

<div class="container mr-filters">
	
	<div class="label">
		Filter by:
	</div>

	<!-- Topic -->
	<div class="topic-filter">
		<!-- <p>Topic</p> -->
		<ul>
			<li class="initial"><span class="text">Topic</span><img src="<?php bloginfo('template_directory'); ?>/assets/img/down-arrow-orange.png">
				<ul class="filter-sub topic">
					<li data-filter="">All</li>
		<?php
			$member_topics_filters = get_terms('member_topic');

			foreach ($member_topics_filters as $member_topics_filter){
			
		?>
		<li data-filter="<?php echo $member_topics_filter->slug; ?>">
			<?php echo $member_topics_filter->name; ?>
		</li>
		<?php } ?>
			</ul>
			</li>	
		</ul>
	</div>
	<!-- ============= -->

	<!-- Format -->
	<div class="content-filter">
		<!-- <p>Format</p> -->
		<ul>
			<li class="initial"><span class="text">Format</span><img src="<?php bloginfo('template_directory'); ?>/assets/img/down-arrow-orange.png">
				<ul class="filter-sub type">
					<li data-filter="">All</li>
		<?php
			$content_type_filters = get_terms('content_type');

			foreach ($content_type_filters as $content_type_filter){
			
		?>
		<li data-filter="<?php echo $content_type_filter->slug; ?>">
			<?php echo $content_type_filter->name; ?>
		</li>
		<?php } ?>
		</ul>
		</li>

		</ul>
	</div>
	<!-- ========== -->
	<!-- Search -->
	<div class="mr-search-filter search-filter">
		<form action="<?php home_url() ?>" method="get">
			<label for="search">Search Resources</label>
			<input type="search" name="s" id="search" placeholder="" value="" /><img src="<?php bloginfo('template_directory'); ?>/assets/img/search.png">
		</form>
	</div>
	<!-- ============= -->
	
</div>

<div class="container">
	<div class="filtered">
		<!-- <p class="filtered-title">Resources Showing:</p> -->
		<div class="topic-filtered">Resources Showing:<span>All</span></div>
		<div class="type-filtered">Format Showing:<span>All</span></div>
		<div class="mr-reset reset" data-filter="*">Reset Filters <img src="<?php bloginfo('template_directory'); ?>/assets/img/right-arrow-orange.png"></div>
	</div>
</div>

<div class="container mr-resource-listing">
	
	<div class="row">
		<div class="header">
			<div class="one columns alpha">Date</div>
			<div class="seven columns">Title</div>
			<div class="two columns">Topic</div>
			<div class="two columns omega">Format</div>
		</div>
	<!--<div class="row">-->
	<?php 
	global $query_string;
	query_posts( '&post_type=member_resources' . '&posts_per_page=-1' );
	$ctr = 1;
	while ( have_posts() ) : the_post(); 

		$resource_imageArray = get_field('resource_icon'); 
		$resource_imageAlt = $resource_imageArray['alt'];
		$resource_imageURL = $resource_imageArray['sizes']['small'];
		$mr_link = get_field('mrf_link');
		//$locations = wp_get_post_terms($post->ID, 'location');
		$member_topics= wp_get_post_terms($post->ID, 'member_topic');
		$content_types= wp_get_post_terms($post->ID, 'content_type');
		
		$ct_filter = '';
		$mt_filter = '';
		$curated = get_field('curated'); 

		$date = get_the_date('m.d.y');

		foreach ($member_topics as $member_topic){
			$mt = $member_topic->name;
			$ms = $member_topic->slug;
			$mt_filter .= $member_topic->slug . ' ';
		}
		foreach ($content_types as $content_type){
			$ct = $content_type->name;
			$cs = $content_type->slug;
			$ct_filter .= $content_type->slug . ' ';
		}
	 
	?>
			<div class="member-resource-item <?php echo $cs . ' ' . $ms ?>">
				<div class="row">
					<div class="one columns alpha the-date"><?php echo $date; ?></div>
					<?php 
						$short_title = the_title('', '', false);
						$shortened_title = substr($short_title, 0, 73);
					?>
					<div class="seven columns the-title <?php if(strlen($short_title) >= 73){echo "overflow";} ?>">
			 			<a href="<?php echo $mr_link;?>">
					 		<div class=" orange_text">
					 			<?php if ($curated == "true") { ?>
					 				<img src="<?php bloginfo('template_directory'); ?>/assets/img/curated.png">
					 			<?php } ?>
								<?php


								echo $shortened_title; //echo " ".strlen($shortened_title); //echo " ".strlen($short_title); echo " ".strlen($shortened_title);

								// if( strlen($shortened_title) >= 73){
								// 	echo'<span class="orange ellipses">...</span>';
								// }

								?> 
							</div>
						</a>
					</div>
					<div class="two columns">
						<div class="m-topic"><?php echo $mt; ?></div>
					</div>
					<div class="two columns omega">
						<div class="c-type">.<?php echo $ct; ?></div>
					</div>
				</div>
			
			</div> <!-- end member-resource-item -->
	<?php 
	/*
		if($ctr%6 ==0){
			echo "</div><div class='row'>";
			$ctr = 0;
		}
	$ctr++;*/

	 endwhile; ?>

	 <div class="loader-container hide">
		<div class="loader ">
			<img class="loader-animate" src="<?php bloginfo('template_directory'); ?>/assets/img/Topwheel.svg">
		</div>
	</div>
	</div> <!-- end row -->
	
</div> <!-- end mr-resource-listing -->
	
	<!-- Quicklinks container -->
	<?php get_template_part('partials/quicklinks'); ?>

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
