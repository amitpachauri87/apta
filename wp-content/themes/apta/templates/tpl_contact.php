<?php
/*
Template Name:Contact
*/
get_header();?>
<section class="main-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 extra-cl">
				<div class="inner-main inner-page">
					<h3><?php the_title();?></h3>
					<div class="cont-main">
								<div class="contact">
									<h4><?php echo get_field('contact_apta');?></h4>
						             <?php echo get_field('address');?>
								</div>
								<div class="row">
									
								<?php $contacts = get_field('add_more_contacts');
								if(!empty($contacts)){
									foreach($contacts as $contact){?>
									<div class="col-sm-4">
										<div class="user-box"><i class="fa fa-user user-ico" aria-hidden="true"></i>
										<h3><?php echo $contact['contact_name'];?></h3>
										<h5><?php echo $contact['contact_designation'];?></h5>
										<p><?php echo $contact['contact_number'];?></p>
										<a href="mailto:<?php echo $contact['contact_email'];?>"><?php echo $contact['contact_email'];?></a>
										</div>
									</div>
									<?php }
									}?>

								</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</section>
<?php get_footer();?>