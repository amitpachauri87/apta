<?php
/*
Template Name:About
*/
get_header();?>
<section class="main-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 extra-cl">
				<div class="inner-main inner-page">
					<h3><?php the_title();?></h3>
					<div class="cont-main">
						<p class="details">
						<?php
						// Start the loop.
						while ( have_posts() ) : the_post();?>
						<?php echo get_the_content();?>
							<?php endwhile;
						?>
						</p>

							<div class="row">
							<div class="col-sm-6">
								<div class="thum-img">  
								<a href="<?php the_field( 'section_1_link' ); ?>"><div class="img-about">
								<?php if ( get_field( 'section_1_image') ) { ?>
									<img src="<?php the_field( 'section_1_image' ); ?>" />
								<?php } ?>
								</div></a>
							
							<a href="<?php the_field( 'section_1_link' ); ?>"><?php the_field( 'section_1_title' ); ?></a>
							</div>
						</div>

							<div class="col-sm-6">
								<div class="thum-img">
								<a href="<?php the_field( 'section_2_link' ); ?>"><div class="img-about">
									<?php if ( get_field( 'section_2_image') ) { ?>
										<img src="<?php the_field( 'section_2_image' ); ?>" />
									<?php } ?>
								</div></a>
							
							<a href="<?php the_field( 'section_2_link' ); ?>"><?php the_field( 'section_2_title' ); ?></a>
						    </div>
						</div>
							</div>


					</div>


				</div>
			</div>
			
		</div>
	</div>
</section>
<?php get_footer();?>