<?php 
/*
Template Name:sidebar
*/
get_header();?>
<div style="width: 60%" class="left-box">
<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
		the_content();
	} // end while
} // end if
?>
</div>
<div style="width: 35%" class="right-box">
<?php 
dynamic_sidebar();
echo "</div>";
get_footer();?>