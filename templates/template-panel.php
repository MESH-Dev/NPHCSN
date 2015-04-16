<?php
/*
Template Name: Panel Page
*/
?>

<?php get_header(); ?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


	<div class="page-header">
		<div class="container">
			<div class="twelve columns page-title">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</div>



	<div class="page-banner">
		<div class="container">
			<div class="six columns page-banner-callout">
				<h1><?php the_field('banner_callout'); ?></h1>
			</div>
			<div class="six columns page-banner-text">
				 <?php the_field('banner_text'); ?>
			</div>
		</div>
		<br class="clear" />
	</div>

	<?php
	while(the_repeater_field('page_panels')){
		$section_type = get_sub_field('section_type');

		if($section_type == 'text'){ // ---------------------TEXT PANEL----------------------?>

			<div class="page-content panel">
				<div class="container">
					<div class="twelve columns subheader">
						<h2><?php the_sub_field('section_header'); ?></h2>
					</div>
					<br class="clear" />
					<div class="six columns">
						<?php the_sub_field('left_column'); ?>
					</div>
					<div class="six columns" style="height: 25px;"></div>
					<div class="six columns">
						<?php the_sub_field('right_column'); ?>
					</div>
				</div>
			</div>

		<?php
		}
		if($section_type == 'image'){ // ---------------------IMAGE PANEL----------------------
			$imageArray = get_sub_field('section_image');
			$imageURL = $imageArray['sizes']['page-banner'];

		?>

			<div class="image-panel panel" style="background-image: url('<?php echo $imageURL; ?>'); background-repeat: no-repeat; background-position: center;"></div>

		<?php
		}
		if($section_type == 'four-callouts'){ // ---------------------FOUR UP PANEL----------------------?>
			<div class="partnerships-panel panel">
				<div class="container">
					<div class="twelve columns partnerships-header">
						<h2><?php the_sub_field('section_header');?></h2>
					</div>
					<br class="clear" />
					<?php
					while(the_repeater_field('four_sections')){
					 	$item_imageArray = get_sub_field('item_icon');
						$item_imageAlt = $item_imageArray['alt'];
						$item_imageURL = $item_imageArray['sizes']['three-col-square'];
						$item_title = get_sub_field('item_title');
						$item_link = get_sub_field('item_link');
						$item_text = get_sub_field('item_text');
						$item_link_text = get_sub_field('item_link_text');
					?>

						<div class="three columns partnership-item">
							<div class="partnership-image">
								<img src="<?php echo $item_imageURL;?>" alt="<?php echo $item_imageAlt; ?>">
							</div>
							<div class="partnership-title">
								<h3><?php echo $item_title;?></h3>
							</div>
							<div class="partnership-text">
								<?php echo $item_text;?>
							</div>
							<div class="partnership-link">
								<a href="<?php echo $item_link;?>"><?php echo $item_link_text;?> </a>
							</div>

						</div>
				<?php } ?>
				</div>
			</div>


		<?php
		}
		if($section_type == 'resources'){ // ---------------------RESOURCES PANEL----------------------?>
			<div class="resources-panel panel">
				<div class="container">
					<div class="twelve columns resource-header">
						<?php the_sub_field('section_header');?>
					</div>
					<br class="clear" />


					<div id="resource-hidden">
						<?php

						$category = get_sub_field('resources_topic');

						$args = array(
							'post_type' => 'resources',
							'cat'   => $category,
							'post_per_page'  => -1
						);

						$the_query = new WP_Query( $args );

						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$resource_id = $post->id;
								$resource_imageArray = get_field('resource_icon', $resource_id );
								$resource_imageAlt = $resource_imageArray['alt'];
								$resource_imageURL = $resource_imageArray['sizes']['small'];
								$resource_link = get_field('resource_link', $resource_id );
								$external = get_field('external');
								?>

								<div class="two columns resource-item">
									<a href="<?php echo $resource_link;?>">
									<div class="resource-item-left">
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
							}
						}
						wp_reset_postdata();

						?>
					 	<br class="clear" />
						<div class="twelve columns resource-footer">
							<a href="<?php bloginfo('url'); ?>/resources">
								Visit the <span class="bolded">TOOLS FOR CHANGE</span>
								for <span class="bolded">MORE HELPFUL RESOURCES</span></a>

						</div>
						<br class="clear" />
					</div>
					<div class="resource-v">
						<a href="#" id="resource-x"><img src="<?php bloginfo('template_directory'); ?>/assets/img/down-arrow-orange.png" alt=""></a>
						<img src="<?php bloginfo('template_directory'); ?>/assets/img/angle.png" alt=""></a>
					</div>


				</div>
			</div>















	<?php }
	}
	?>





<?php the_content(); ?>





<?php endwhile; ?>

<?php get_footer(); ?>
