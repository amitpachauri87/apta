<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header();
// Start the loop.
while ( have_posts() ) : the_post();?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.1/css/flag-icon.css">
<section class="main-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 extra-cl">
				<div class="inner-main inner-page">
					<h3>Tournament Details</h3>

          <div class="latest-event">
                <div class="row">
                    <div class="col-sm-6">
                          <div class="img-box1">
                                  <div class="thub-img">
                                  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full');?>
                                    <img src="<?php echo $image[0];?>" alt="">
                                  </div>
                               
                            </div>
                      </div>
                      <div class="col-sm-5">
                         <ul class="list-details">
                         <?php   $start_date = get_field('tournament_start_date',false, false);
                         			   $date = new DateTime($start_date);
                         		       $end_date = get_field( 'tournament_end_date' );	
                         		 $country = get_field('tournament_country_flag');
                         		 $cn = strtolower($country);
                         		 ?>
                                    <li><span>Date:</span><?php echo $date->format('d-m-Y'); ?></li>
                                    <li><span>Tournament:</span> <?php the_field( 'tournament_name' ); ?></li>
                                    <li><span>location:</span> <?php the_field( 'tournament_location' ); ?></li>
                                    <li><span>View Photos:</span> <a href="<?php echo home_url();?>/tournament-photos/?tid=<?php echo $post->ID;?>">View</a></li>
                                    <li><span>Country Flag:</span><span style="width:8%!important;" class="flag-icon flag-icon-<?php echo $cn;?>"></span></li>
                                    <li><span>Price:</span><span><?php echo get_field('tournament_price');?></span></li>
                                    <?php if(is_user_logged_in()){?>
                                    <li><span>Buy Now:</span><a class="btn sign-up" href="<?php home_url();?>/tournament-cart/?slug=<?php echo $post->post_name;?>">Buy Now </a></li>
                                    <?php }
                                    else{?>
                                     <li><span>Buy Now:</span><a class="btn sign-up" href="<?php home_url();?>/my-account">Buy Now </a></li>
                                    <?php }?>
                                </ul>
                      </div>
                </div>
            </div>
            <div class="list-tournament">
              <h4><b><?php echo the_title();?></b></h4>
                <?php the_content();?>
            </div>
<?php endwhile;?> 

                <div class="upcoming-event">
                  <h4><b>Upcoming Tournament</b></h4>

                        <div class="row">
                            
                            <?php 
                            $event1 = current_time('Ymd');
                            $args = array(
                                'post_type' => 'tournaments',
                            'post_status' => 'publish',
                            'posts_per_page' => '4',
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
                            <div class="col-sm-3">
                              <ul class="list-details">
                                  <li><span>Date:</span> <?php echo $date->format('d-m-Y'); ?></li>
                                  <li><span>Tournament:</span> <?php the_field( 'tournament_name' ); ?></li>
                                  <li><span>location:</span> <?php $location =  get_field('tournament_location');
                   echo wordwrap($location,18,"<br>\n"); ?></li>
                                  <li><span>View Details:</span> <a href="<?php the_permalink();?>">View</a></li>
                                  <li><span>View Photos:</span><a href="<?php echo home_url();?>/tournament-photos/?tid=<?php echo $post_id;?>">Photos</a></li>
                                  <li><span>Country Flag:</span> <span style="width:8%!important;" class="flag-icon flag-icon-<?php echo $cn;?>"></span></li>
                              </ul>
                            </div>
                            <?php endwhile;   ?>

                        </div>
                </div>

				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
