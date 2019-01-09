<?php 
/*
Template Name:Tournament Listing
*/
get_header();?>
<section class="main-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 extra-cl">
				<div class="inner-main inner-page">
					<h3><?php the_title();?></h3>
					<div class="cont-main photos">
						<ul>
						<?php 
						$paged = get_query_var('paged') ? get_query_var('paged') : 1;
						$args = array('post_type' => 'tournaments', 'posts_per_page' => 3, 'paged' => $paged);
						$my_query = new WP_Query($args);
      							while ($my_query->have_posts()) : $my_query->the_post(); ?>
									<?php $post_id = get_the_ID();?>
							<li>
							 <div class="img-box">
							 	<div class="thub-img">
							 	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id),'full');
							 	if(empty($image)){?>
							 		<img src="<?php echo get_stylesheet_directory_uri();?>/images/sub-img1.jpg" alt="">
							 		<?php }
							 		else{?>
							 		<img src="<?php echo get_bloginfo('stylesheet_directory');?>/timthumb.php?src=<?php echo $image[0];?>&amp;h=85&amp;w=255&amp;zc=1"/>
							 		<?php }?>
							 	</div>
								     <h3><?php 
								     $date = DateTime::createFromFormat('d/m/Y', get_field('tournament_start_date'));
										echo $date->format('F d, Y'); ?></h3>
									<h4><?php echo the_title();?></h4>
									<p><?php $location =  get_field('tournament_location');
									 echo wordwrap($location,18,"<br>\n"); ?></p>
									<a href="<?php echo the_permalink();?>" class="btn sign-up">SIGN UP</a>
								</div>
							</li>
						<?php endwhile;   ?>
							</ul>
						</div>
				</div>
			<div class="col-sm-12">
					<div class="pagination-box">
			  <?php wp_pagenavi( array( 'query' => $my_query ) ); 
			  wp_reset_query();?>
		</div>
			</div>
			</div>
		</div>

		
	</div>
</section>
<?php get_footer();?>