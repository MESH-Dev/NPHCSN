 <div class="container quicklinks">
	 	<h2>Community Quicklinks</h2>
	 	<div class="row">

	 		<?php if (have_rows('quicklinks', 'options')):
	 				while (have_rows('quicklinks', 'options')) : the_row();

	 				$quicklink_text = get_sub_field('quicklink_text', 'options');
	 				$quicklink_link = get_sub_field('quicklink_url', 'options');
	 				?>
		 	<div class="three columns alpha">
		 		<a href="<?php echo $quicklink_link; ?>"><?php echo $quicklink_text; ?>  <img src="<?php bloginfo('template_directory'); ?>/assets/img/right-arrow-orange.png"></a>
	 		</div>
	 		<?php endwhile; endif; ?>
	 		<!-- <div class="three columns">
		 		<a href="#">Start a discussion <img src="<?php bloginfo('template_directory'); ?>/assets/img/right-arrow-orange.png"></a>
	 		</div>
	 		<div class="three columns">
		 		<a href="#">Start a discussion <img src="<?php bloginfo('template_directory'); ?>/assets/img/right-arrow-orange.png"></a>
	 		</div>
	 		<div class="three columns">
		 		<a href="#" class=>Start a discussion <img src="<?php bloginfo('template_directory'); ?>/assets/img/right-arrow-orange.png"></a>
	 		</div> -->
	 	</div>
</div>