<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>


<head>
	<meta charset="utf-8">
	<title><?php bloginfo('name'); ?></title>

	<!-- Meta / og: tags -->
	<meta name="description" content="">
	<meta name="author" content="">


	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1">

	<!-- CSS (* with Edge Inspect Fix)
	================================================== -->
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />


  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon-96x96.png" />

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

	<?php wp_head(); ?>
	<script type="text/javascript" charset="utf-8" src="edge_includes/edge.5.0.1.min.js"></script>
    <style>
        .edgeLoad-EDGE-151229497 { visibility:hidden; }
        .edgeLoad-EDGE-26294147 { visibility:hidden; }
 	</style>
	<script>
	   AdobeEdge.loadComposition('Animation_1', 'EDGE-151229497', {
	    scaleToFit: "none",
	    centerStage: "none",
	    minW: "0",
	    maxW: "300px",
	    width: "300px",
	    height: "300px"
	}, {dom: [ ]}, {dom: [ ]});
	</script>
	<script>
	   AdobeEdge.loadComposition('Animation_2', 'EDGE-26294147', {
	    scaleToFit: "none",
	    centerStage: "none",
	    minW: "0",
	    maxW: "undefined",
	    width: "300px",
	    height: "300px"
	}, {dom: [ ]}, {dom: [ ]});
	</script>

</head>

<body>

<?php 

			

			if (is_user_logged_in()){ 

				$id = get_current_user_id();
				//var_dump($id);
				$user_info = get_userdata($id);
				$first_name = $user_info->first_name;
				$last_name = $user_info->last_name;
				$job_title = $user_info->job_title;
				$company = $user_info->company_name;

				?>
		<div class="login-bar">
			<p>Welcome to The National Partnership Community Area, <?php echo $first_name . ' ' . $last_name ?> <span class="login-links"><a href="<?php echo home_url('/'); ?>/community-dashboard">Go to Dashboard</a> | <a href="<?php echo wp_logout_url(); ?>">Log Out</a> <?php if(current_user_can('administrator')){?>| <a href="<?php echo home_url('/')?>/wp-admin">Admin</a><?php } ?></span></p>
		</div>
		<?php } ?>
<header>
	
	<div class="container">
		
		<div class="five columns logo">
			<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/assets/img/new/NPHCSN_logo_Hi.png" alt="The National Partnership for the Health Care Safety Net"></a>
		</div>

		<div class="seven columns navigation">
			<?php if(has_nav_menu('main_nav')){
				$defaults = array(
					'theme_location'  => 'main_nav',
					'menu'            => 'main_nav',
					'container'       => false,
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'menu',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 1,
					'walker'          => ''
				); wp_nav_menu( $defaults );
			}else{
				echo "<p><em>main_nav</em> doesn't exist! Create it and it'll render here.</p>";
			} ?>

			<img id="menu-arrow" src="<?php bloginfo('template_directory'); ?>/assets/img/down-arrow-white.png" width="18" height="9" alt="">
		</div>
		<br class="clear" />


	</div>
	<div class="pushdown">
		<div class="container">
			<div class="four columns">
				<div class="pushdown-callout"><?php the_field('pushdown_callout',4);?></div>
			</div>
			<?php
			 while(the_repeater_field('pushdown_items',4)){ ?>

			 	<div class="two columns pushdown-item">
			 		<a href="<?php the_sub_field('pushdown_link'); ?>">
			 			<?php the_sub_field('pushdown_title'); ?>

			 		</a>
			 		<span class="pushdown-location"><?php the_sub_field('pushdown_location'); ?></span>
			 	</div>

			<?php } ?>
		</div>
	</div>

</header>
