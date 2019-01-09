<?php 
/*
Template Name:Results
*/
get_header();?>
<section class="main-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 extra-cl">
				<div class="inner-main inner-page">
					<h3>TOURNAMENT RESULTS</h3>
					<div class="cont-main">
						<div class="row">
							
							<?php 
						$paged = get_query_var('paged') ? get_query_var('paged') : 1;
						$args = array('post_type' => 'tournaments', 'posts_per_page' => 3, 'paged' => $paged);
						$my_query = new WP_Query($args);
      							while ($my_query->have_posts()) : $my_query->the_post(); ?>
									<?php $post_id = get_the_ID();
									$start_date = get_field('tournament_start_date',false, false);
                                 $date = new DateTime($start_date);
									?>
							<div class="col-sm-12">
								<div class="inner-box-card">
									<ul>
								   <li><h4><?php the_title();?></h4>
									<p><?php $location =  get_field('tournament_location');
                   echo wordwrap($location,18,"<br>\n"); ?></p>
									<p><?php echo $date->format('F d, Y');?></p></li>
									<?php $Results = get_field('add_more_results');
									if(!empty($Results)){
									foreach($Results as $Result){?>
									<li><h4><?php echo $Result['result_title']; ?></h4>
									<?php echo $Result['result_content']; ?></li>
									<?php 
									}
									}?>
									</ul>
								</div>
							</div>
							<?php 
						
							endwhile;   ?>

							<div class="col-sm-12">
								<div class="pagination-box">
								  <?php wp_pagenavi( array( 'query' => $my_query ) ); 
								  wp_reset_query();?>
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