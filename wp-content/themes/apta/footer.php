<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<section class="news-leater">
	<div class="container">
		<?php echo do_shortcode('[mc4wp_form id="46"]');?>
	</div>
</section>
<footer>
	<div class="container">
		<div class="links-footer">
			<?php echo wp_nav_menu(array('theme_location'=>'social','container_class'=>''));?>
		</div>
		<div class="all-rights">
			<ul>
				<li><a href="<?php echo home_url();?>/terms-conditions/">Terms of Service</a></li>
				<li><a href="<?php echo home_url();?>/privacy-policy/">Privacy Policy AM  Copyrights 2018 reserved</a></li>

			</ul>
		</div>
	</div>
</footer>
  
<script src="<?php echo get_stylesheet_directory_uri();?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/js/owl.carousel.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/js/coustom.js"></script>
<script type="text/javascript">
  jQuery('document').ready(function(){
    jQuery('li.home').addClass('prett');
    jQuery('ul.sub-menu').addClass('menus');
  });
</script>
  <script>
jQuery('.icon').click(function() {
  jQuery('.nav-menu').slideToggle('slow');
});
  </script>
  <script type="text/javascript">
  	document.addEventListener('click', function(e) {
  e = e || window.event;
  console.log(e);
  var target = e.target || e.srcElement;
  console.log(target);
  if (target.parentElement.className.indexOf('has-submenu') > -1) {
    e.target.classList.toggle('open');
  }
}, false);
  </script>
  <script type="text/javascript">
  	jQuery( ".prett" ).click(function() {
  jQuery( ".menus" ).slideToggle( "slow", function() {
    // Animation complete.
  });
});
  </script>
<?php wp_footer(); ?>

</body>
</html>
