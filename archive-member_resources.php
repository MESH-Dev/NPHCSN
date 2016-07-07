<?php get_header(); ?>

<div class="page-header shaun">
	<div class="container">
		<div class="twelve columns page-title">
			<h1>Member Resources</h1>
		</div>
	</div>
</div>

<!-- <div class="filters">
	<div class="container">
		<div class="twelve columns filter-header">
			<h3>Filter by TOPIC</h3>
		</div>
		<div class="twelve columns filter-row" >
 
			<?php 
			$args = array( 'orderby' => 'name',  'parent' => 0  );
			$categories = get_categories( $args );
			foreach ( $categories as $category ) {

				$icon_url = get_field('icon_image', $category);
 
				echo '<a href="#" data-filter="'.  $category->slug  . '"><span class="img-cont"><img src="'.$icon_url .'" /></span><br>'  . $category->name . '</a> ';
			}
			?>
			
		</div> -->

		<!-- <div class="twelve columns filter-row">
			 
			<?php 
			$locations = get_terms( 'location', array(
			 	'orderby'    => 'name',
			 	'parent' => 0,
			) );
			foreach ( $locations as $location ) {
				$icon_url = get_field('icon_image', $location);
				echo '<a href="#" data-filter="'.  $location->slug  . '"><span class="img-cont"><img src="'.$icon_url .'" /></span><br>' . $location->name . '</a> ';
			}?>


		</div> -->
	<!-- </div>
</div> -->

<!-- <div class="container resource-listing-header">
	<div class="six columns"><h3>Resources Showing: <span id="filter">EVERYTHING</span></h3></div>
	<div class="six columns right"><a href="#" id="reset" data-filter="Everything">RESET Results</a></div>
</div> -->

<div class="container">
	<?php $title = get_field('mr_page_title', 'options');?>

	<h2><?php echo $title; ?></h2>
</div>

<div class="container mr-filters">
	<div class="search-filter">
		<form action="<?php home_url() ?>" method="get">
			<label for="search">Search Resources</label>
			<input type="search" name="s" id="search" placeholder="" value="" />
		</form>
	</div>
	<div class="topic-filter">
		<p>Filter by Topic</p>
		<ul>
			<li class="selected initial" data-filter="*">All
				<ul class="filter-sub">
		<?php
			$member_topics_filters = get_terms('member_topic');

			foreach ($member_topics_filters as $member_topics_filter){
			
		?>
		<li data-filter="<?php echo $member_topics_filter->slug; ?>">
			<?php echo $member_topics_filter->slug; ?>
		</li>
		<?php } ?>
			</ul>
			</li>	
		</ul>
	</div>
	<div class="content-filter">
		<p>Filter by Content Type</p>
		<ul>
			<li class="selected initial" data-filter="*">All
				<ul class="filter-sub">
		
		<?php
			$content_type_filters = get_terms('content_type');

			foreach ($content_type_filters as $content_type_filter){
			
		?>
		<li data-filter="<?php echo $content_type_filter->slug; ?>">
			<?php echo $content_type_filter->slug; ?>
		</li>
		<?php } ?>
		</ul>
		</li>

		</ul>
	</div>
	<div class="reset" data-filter="*">Reset</div>
</div>

<div class="container mr-resource-listing">
	<div class="row">
	<div class="header">
		<div class="one columns">Date</div>
		<div class="seven columns">Title</div>
		<div class="two columns">Topic</div>
		<div class="two columns">Format</div>
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
		$external = get_field('link_type'); 

		$date = get_the_date('m.d.y');

		foreach ($member_topics as $member_topic){
			$mt = $member_topic->slug;
			$mt_filter .= $member_topic->slug . ' ';
		}
		foreach ($content_types as $content_type){
			$ct = $content_type->slug;
			$ct_filter .= $content_type->slug . ' ';
		}
	 
	?>
			<div class="member-resource-item <?php echo $ct . ' ' . $mt ?>">
				<div class="row">
					<div class="one columns the-date"><?php echo $date; ?></div>
					<?php 
						$short_title = the_title('', '', false);
						$shortened_title = substr($short_title, 0, 73);
					?>
					<div class="seven columns the-title <?php if(strlen($short_title) >= 73){echo "overflow";} ?>">
			 			<a href="<?php echo $mr_link;?>" <?php if($external=="true"){ ?> target='_blank'<?php }?>>
					 		<div class=" orange_text">	
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
					<div class="two columns">
						<div class="c-type"><?php echo $ct; ?></div>
					</div>
				</div>
			</div>
	<?php 
	/*
		if($ctr%6 ==0){
			echo "</div><div class='row'>";
			$ctr = 0;
		}
	$ctr++;*/

	 endwhile; ?>
	</div>
	</div>
</div>

<?php get_footer(); ?>
