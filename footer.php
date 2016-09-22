
<footer>

	<div class="footer-top">
		<div class="container">
			<div class="four columns footer-links">
				<?php if(has_nav_menu('main_nav')){
						$defaults = array(
							'theme_location'  => 'footer_nav',
							'menu'            => 'footer_nav',
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
							'depth'           => 2,
							'walker'          => ''
						); wp_nav_menu( $defaults );
					}else{
						echo "<p><em>main_nav</em> doesn't exist! Create it and it'll render here.</p>";
					} ?>
			</div>
			<div class="eight columns footer-logos">
				<span class="logo-title">
					The National Partnership comprises these organizations:
				</span>
				<a href="http://essentialhospitals.org" target="_blank"><img style="width: 100px;" src="<?php bloginfo('template_directory'); ?>/assets/img/new/AEH_white_logo.png" alt=""></a>
				<a href="http://www.nachc.com/" target="_blank"><img style="width: 150px;" src="<?php bloginfo('template_directory'); ?>/assets/img/new/NACHC.png" alt=""></a>
				<a href="http://publichealth.gwu.edu/" target="_blank"><img style="width: 120px;" src="<?php bloginfo('template_directory'); ?>/assets/img/new/milken_institute_sph.png" alt=""></a>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="eight columns footer-text">
				Funding and support for <span class="bolded">The National Partnership for the Health Care Safety Net</span> have been made possible by <span class="bolded"><a href="http://share.kaiserpermanente.org/total-health/community-benefit/" target="_blank">Kaiser Permanente Community Benefit</a></span> and <span class="bolded"><a href="http://www.ebcf.org" target="_blank">The East Bay Community Foundation</a></span>
			</div>
			<div class="two columns logos">
				 <a href="http://share.kaiserpermanente.org/total-health/community-benefit/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/assets/img/new/Kaiser-Permanente.png" alt="" id="k"></a><a href="http://www.ebcf.org" target="_blank"><img id="eb" src="<?php bloginfo('template_directory'); ?>/assets/img/new/EBCFlogo.png" alt=""></a>
			</div>
			<div class="two columns footer-text mesh">
				 Designed by <a href="http://meshfresh.com" target="_blank">MESH</a>
			</div>
		</div>
	</div>


</footer>

<!--<script src="<?php get_theme_directory_uri ?>/assets/js/NPHCSN.js"></script>-->

<?php wp_footer(); ?>
<script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-47673413-2', 'auto');
 ga('send', 'pageview');

</script>
</body>

</html>
