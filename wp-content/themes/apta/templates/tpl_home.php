<?php 
/*
Template Name:Home
*/
get_header();?>
<section class="main-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 extra-cl">
				<div class="inner-main mainpage">
					<h3><?php the_field( 'about_us_title' ); ?></h3>
					<div class="cont-main main-page-cont">
						<p><?php the_field( 'about_us_cotnent' ); ?></p>

							<div class="row">
							<div class="col-sm-6">
							<div class="thum-img">
							<a href="<?php the_field( 'about_us_link1' ); ?>"><div class="img-about">
							<?php if ( get_field( 'about_us_image_1') ) { ?>
										<img src="<?php the_field( 'about_us_image_1' ); ?>" />
							<?php } ?>
						</div></a>
							<a href="<?php the_field( 'about_us_link1' ); ?>"><?php the_field( 'about_us_title_1' ); ?></a>
							</div>
						</div>

							<div class="col-sm-6">
								<div class="thum-img">
							<a href="<?php the_field( 'about_us_link2' ); ?>"><div class="img-about">
							<?php if ( get_field( 'about_us_image2') ) { ?>
								<img src="<?php the_field( 'about_us_image2' ); ?>" />
							<?php } ?>

						</div></a>
							<a href="<?php the_field( 'about_us_link2' ); ?>"><?php the_field( 'about_us_title_2' ); ?></a>
						    </div>
						</div>
							</div>


					</div>


				</div>
			</div>
			<div class="col-sm-6 extra-cl">
				<div class="inner-main mainpage">
					<h3>Upcoming Events</h3>
					<div class="cont-main main-page-cont">
						<ul>
							<?php 
                            $event1 = current_time('Ymd');
                            $args = array(
                                'post_type' => 'tournaments',
                            'post_status' => 'publish',
                            'posts_per_page' => '3',
                            'post__not_in' => array (get_the_ID()),
                            'meta_query' => array(
                                array(
                                    'key' => 'tournament_start_date',
                                    'compare' => '>=',
                                    'value' => $event1,
                                    )
                                    ),
                            'meta_key' => 'tournament_start_date',
                            'orderby' => 'meta_value',
                            'order' => 'ASC',
                        );
                            $query = new WP_Query($args);
                            //echo "<pre>";
                            //print_r($query);
                            //echo "</pre>";
                            while ($query->have_posts()) : $query->the_post(); ?>
                            <?php $post_id = get_the_ID();?>
                            <?php $start_date = get_field('tournament_start_date',false, false);
                                 $date = new DateTime($start_date);
                                 $country = get_field('tournament_country_flag');
                             $cn = strtolower($country);?>

							<li>
								<a href="<?php echo the_permalink();?>"><div class="image-list">
									<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail');?>
                                    <img src="<?php echo $image[0];?>" alt="">
								</div></a>
								<div class="detail-list">
									<h4><?php echo $date->format('F d, Y');?></h4>
									<a href="<?php echo the_permalink();?>"><p><?php the_title();?></p></a>
									<p><?php $location =  get_field('tournament_location');
                   echo wordwrap($location,18,"<br>\n"); ?></p>
								</div>
							</li>

							<?php endwhile;   ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer();?>