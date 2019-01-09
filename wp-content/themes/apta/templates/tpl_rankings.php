<?php
/*
Template Name:Rankings
*/
get_header();?>
<section class="main-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 extra-cl">
				<div class="inner-main inner-page">
					<h3>RANKINGS</h3>
					<div class="cont-main rank">
						<ul>
						<?php $my_query = new WP_Query('post_type=rankings&posts_per_page=-1&order=ASC');
      							while ($my_query->have_posts()) : $my_query->the_post(); ?>
									<?php $post_id = get_the_ID();?>
									<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
								<?php endwhile;  wp_reset_query(); ?>
						</ul>


					</div>


				</div>
			</div>
			
		</div>
	</div>
</section>
<?php get_footer();?>