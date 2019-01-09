<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<section class="main-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 extra-cl">
					<div class="inner-main inner-page">
						<h3 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentyfifteen' ); ?></h3>
						<div class="cont-main rank">
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentyfifteen' ); ?></p>

								<?php get_search_form(); ?>
						</div><!-- .page-content -->
			
					</div>
				</div>
			</div>
		</div>
</section>

<?php get_footer(); ?>
