<?php get_header(); ?>

<div class="banner">
	<div class="container">
		<div class="six columns">
			<h1 class="home-callout"><?php the_field('home_callout');?></h1>
			<img id="home-arrow" src="<?php bloginfo('template_directory'); ?>/assets/img/down-arrow-white.png" id="home-arrow" alt="">
		</div>
		<div class="six columns home-img">
			<?php
				$imageArray = get_field('banner_img');
				$imageAlt = $imageArray['alt'];
				$imageURL = $imageArray['sizes']['large'];
				$the_url = $imageArray['url'];
			?>
			<img src="<?php echo $the_url;?>" alt="<?php echo $imageAlt; ?>">
		</div>
	</div>
</div>

<div class="content-callouts" id="callout">
	<div class="container">
	<?php
		$ctr = 1;
		while( have_rows('content_callout') ): the_row();
			$test = get_field('content_callout');
			$content_imageArray = get_sub_field('content_image');
			$content_imageAlt = $content_imageArray['alt'];
			$content_imageURL = $content_imageArray['sizes']['medium'];
			$content_title = get_sub_field('content_title');
			$content = get_sub_field('content');
			$content_read_more = get_sub_field('read_more_text');
			$content_link = get_sub_field('content_link');

			if($ctr%2 == 1){

			?>

			<div class="content-item">
				<div class="four columns">
					<!-- <img src="<?php echo $content_imageURL;?>" alt="<?php echo $content_imageAlt; ?>"> -->
					<div id="Stage1" class="EDGE-151229497">	</div>
				</div>

				<div class="eight columns home-gears">
					<h1><?php echo $content_title;?></h1>
					<?php echo $content; ?>
					<a class="content-read-more" href="<?php echo $content_link;?>"><?php echo $content_read_more; ?></a>
				</div>
				<br class="clear" />
			</div>

			<?php
			}
			else{ ?>
			<div class="content-item">
				<div class="eight columns  ">
					<h1><?php echo $content_title;?></h1>
					<?php echo $content; ?>
					<a class="content-read-more" href="<?php echo $content_link;?>"><?php echo $content_read_more; ?></a>
				</div>

				<div class="four columns weights">
					<!--<img src="<?php echo $content_imageURL;?>" alt="<?php echo $content_imageAlt; ?>">-->
					<div id="Stage" class="EDGE-26294147"></div>
				</div>
				<br class="clear" />
			</div>

			<?php
			}?>



	<?php $ctr++;endwhile;?>
	</div>
</div>

<div class="resources-panel">
	<div class="container">


		<div class="twelve columns resource-header">

			<div class="front face">
				<a href="" id="resource-flip">These <span class="bolded">Helpful Resources</span> are at your finger tips. Click here to see.</a>
			</div>
			<div class="back face">
				 These <span class="bolded">Helpful Resources</span> are here to get you started!
			</div>

		</div>
		<br class="clear" />

		<div id="resource-hidden">
			<?php
			while(the_repeater_field('resources')){

				$resource = get_sub_field('resource');

				$resource_title = $resource->post_title;
				$resource_id = $resource->ID;
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

					<?php echo $resource_title;?>
				</div>
				<div class="resource-item-right">
					<img src="<?php bloginfo('template_directory');?>/assets/img/right-arrow-orange.png">
				</div>


				</a>

			</div>
			<?php } ?>
			<br class="clear" />
			<div class="twelve columns resource-footer">
				<a href="<?php bloginfo('url'); ?>/resources">Visit the <span class="bolded">TOOLS FOR CHANGE</span>
					for <span class="bolded">MORE HELPFUL RESOURCES</span></a><br>


			</div>
			<br class="clear" />
		</div>
		<div class="resource-v">
			<a href="#" id="resource-x"><div id="x-swap" class="resourcearrow"></div></a>
			<img src="<?php bloginfo('template_directory'); ?>/assets/img/angle.png" alt=""></a>
		</div>



	</div>
</div>

<div class="partnerships-panel">
	<div class="container">
		<div class="twelve columns partnerships-header">
			<h1><?php the_field('partnership_header_title');?></h1>
		</div>
		<br class="clear" />
		<?php
		while(the_repeater_field('partnership_items')){
		 	$partnership_imageArray = get_sub_field('partnership_icon');
			$partnership_imageAlt = $partnership_imageArray['alt'];
			$partnership_imageURL = $partnership_imageArray['sizes']['three-col-square'];
			$partnership_item_title = get_sub_field('partnership_item_title');
			$partnership_link = get_sub_field('partnership_link');
			$partnership_text = get_sub_field('partnership_text');
			$partnership_link_text = get_sub_field('partnership_link_text');
		?>

		<div class="three columns partnership-item">
			<div class="partnership-image">
				<img src="<?php echo $partnership_imageURL;?>" alt="<?php echo $partnership_imageAlt; ?>">
			</div>
			<div class="partnership-title">
				<h3><?php echo $partnership_item_title;?></h3>
			</div>
			<div class="partnership-text">
				<?php echo $partnership_text;?>
			</div>
			<div class="partnership-link">
				<a href="<?php echo $partnership_link;?>"><?php echo $partnership_link_text;?> </a>
			</div>

		</div>
		<?php } ?>

	</div>
</div>




<?php get_footer(); ?>
