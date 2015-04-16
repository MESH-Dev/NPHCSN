<?php get_header(); ?>

<div class="page-header">
	<div class="container">
		<div class="twelve columns page-title">
			<h1>Tools for Change</h1>
		</div>
	</div>
</div>

<div class="filters">
	<div class="container">
		<div class="twelve columns filter-header">
			<h3>Filter by TOPIC or LOCATION</h3>
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
			
		</div>

		<div class="twelve columns filter-row">
			 
			<?php 
			$locations = get_terms( 'location', array(
			 	'orderby'    => 'name',
			 	'parent' => 0,
			) );
			foreach ( $locations as $location ) {
				$icon_url = get_field('icon_image', $location);
				echo '<a href="#" data-filter="'.  $location->slug  . '"><span class="img-cont"><img src="'.$icon_url .'" /></span><br>' . $location->name . '</a> ';
			}?>


		</div>
	</div>
</div>

<div class="container resource-listing-header">
	<div class="six columns"><h3>Resources Showing: <span id="filter">EVERYTHING</span></h3></div>
	<div class="six columns right"><a href="#" id="reset" data-filter="Everything">RESET Results</a></div>
</div>

<div class="container resource-listing">
	<!--<div class="row">-->
	<?php 
	global $query_string;
	query_posts( $query_string . '&posts_per_page=-1' );
	$ctr = 1;
	while ( have_posts() ) : the_post(); 

		$resource_imageArray = get_field('resource_icon'); 
		$resource_imageAlt = $resource_imageArray['alt'];
		$resource_imageURL = $resource_imageArray['sizes']['small'];
		$resource_link = get_field('resource_link');
		$locations = wp_get_post_terms($post->ID, 'location');
		$topics = wp_get_post_terms($post->ID, 'category');
		$loc_filter = '';
		$topic_filter = '';
		$external = get_field('external'); 
		//$ext = $external[0];  
		foreach ($locations as $location) {
			$loc_filter .= $location->slug . ' ';
		}
		foreach ($topics as $topic) {
			$topic_filter .= $topic->slug . ' ';
		}
	 
	?>
	
		<div class="two columns resource-item <?php echo $loc_filter . ' ' . $topic_filter; ?>">
	 		<a href="<?php echo $resource_link;?>" <?php if($external){ ?> target='_blank'<?php }?>>
	 		<div class="resource-item-left purple_text">	
				<div class="resource-img">
					<?php if($external){ ?>
					<div class="external">
						<img src="<?php bloginfo('template_directory');?>/assets/img/arrow.png" alt="">	
					</div>
					<?php } ?>
					<img src="<?php echo $resource_imageURL;?>" alt="<?php echo $resource_imageAlt; ?>">
					
				</div>
				<?php the_title();?> 
			</div>
			<div class="resource-item-right">
				<img src="<?php bloginfo('template_directory');?>/assets/img/right-arrow-orange.png">
			</div>	

			</a>
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
