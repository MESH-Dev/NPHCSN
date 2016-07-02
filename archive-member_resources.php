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
		Search
	</div>
	<div class="topic-filter">
		Filter by Topic
		<ul>
			<li data-filter="all">All</li>
		<?php
			$member_topics_filters = get_terms('member_topic');

			foreach ($member_topics_filters as $member_topics_filter){
			
		?>
		<li data-filter="<?php echo $member_topics_filter->slug; ?>">
			<?php echo $member_topics_filter->slug; ?>
		</li>
		<?php } ?>
		</ul>
	</div>
	<div class="content-filter">
		Filter by Content-Type
		<ul>
			<li data-filter="all">All</li>
		<?php
			$content_type_filters = get_terms('content_type');

			foreach ($content_type_filters as $content_type_filter){
			
		?>
		<li data-filter="<?php echo $content_type_filter->slug; ?>">
			<?php echo $content_type_filter->slug; ?>
		</li>
		<?php } ?>
		</ul>
	</div>
</div>

<div class="container resource-listing">
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

		foreach ($member_topics as $member_topic){
			$mt = $member_topic->slug;
			$mt_filter .= $member_topic->slug . ' ';
		}
		foreach ($content_types as $content_type){
			$ct = $content_type->slug;
			$ct_filter .= $content_type->slug . ' ';
		}
	 
	?>
			<div class="three columns member-resource-item <?php echo $ct . ' ' . $mt ?>">
	 		<a href="<?php echo $mr_link;?>" <?php if($external=="true"){ ?> target='_blank'<?php }?>>
	 		<div class=" orange_text">	
				<!-- <div class="resource-img">
					<?php if($external){ ?>
					<div class="external">
						<img src="<?php bloginfo('template_directory');?>/assets/img/arrow.png" alt="">	
					</div>
					<?php } ?>
					<img src="<?php echo $resource_imageURL;?>" alt="<?php echo $resource_imageAlt; ?>">
					
				</div> -->
				<?php the_title();?> 
			</div>
			<!-- <div class="resource-item-right">
				<img src="<?php bloginfo('template_directory');?>/assets/img/right-arrow-orange.png">
			</div>	 -->

			</a>
			<div class="m-topic"><?php echo $mt; ?></div>
			<div class="c-type"><?php echo $ct; ?></div>
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

<?php get_footer(); ?>
