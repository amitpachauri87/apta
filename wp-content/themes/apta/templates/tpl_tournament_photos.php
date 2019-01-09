<?php 
/*
Template Name:Tournament Photos
*/
get_header();
$id = $_GET['tid'];
$date = DateTime::createFromFormat('d/m/Y', get_field('tournament_start_date',$id));
$address = get_field('tournament_location',$id);
$photos = get_field('tournament_photos',$id);										
										?>
<section class="main-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 extra-cl">
				<div class="inner-main inner-page">
					<h3>Tournament Photos</h3>
					<div class="cont-main photos">
						<div class="details-box">
						<h4><?php echo get_the_title($id);?></h4>
					    <p><strong><?php echo $date->format('F d, Y');?></strong></p>
					    <p><strong><?php echo $address;?></strong></p>
					    <!-- <p><strong>Jon Pardoen hosted the tournament.</strong></p>
					     <p><strong>Matt and Dora represented the APTA. Doug McClintock represented the OCPTA.</strong></p>
					      <p><strong>Matt Denoff & Rod Woods defeated Paul Fisher & Doug McClintock in the Finals.</strong></p>
					      <p><strong>[Click on thumbnails below to view larger photos.]</strong></p> -->
						</div>

					   
						  <?php echo do_shortcode(get_field('tournament_photos',$id));?>
					



					</div>


				</div>
			</div>
			
		</div>
	</div>
</section>
<?php get_footer();?>