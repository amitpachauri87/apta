<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/animation.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/style.css">

<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/media.css">
</head>
<body <?php body_class(); ?>>
<!---header!-->
<header>
	<div class="main-head">
		<div class="container">
			<div class="apta-brand">
				 <?php if ( get_theme_mod( 'themeslug_logo' ) ) : ?>
        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'themeslug_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
<?php else : ?>
    <hgroup>
        <h1 class='site-title'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
        <h2 class='site-description'><?php bloginfo( 'description' ); ?></h2>
    </hgroup>
<?php endif; ?>
			</div>
			<div class="apta-nav">
				 <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                 <i class="fa fa-bars"></i>
                 </a>
				<!-- <ul class="nav-menu" id='menu'>
				<li><a class='prett' href="JavaScript:void(0);">Home</a>
				     <ul class='menus'>
				        <li class='has-submenu'>
				        	<div class="row">
				        <div class="col-sm-4">
				        	<div class="menus-details"><a href="JavaScript:void(0);"><img src="<?php echo get_stylesheet_directory_uri();?>/images/sub-img1.jpg" alt=""></a>
				        	<a href="JavaScript:void(0);">TIPS AND INSTRUCTION</a>
				        	<p>Our experts teach you everything from the fundamentals to finessing your game.</p></div>

				        		<div class="menus-details"><a href="JavaScript:void(0);"><img src="<?php echo get_stylesheet_directory_uri();?>/images/sub-img2.jpg" alt=""></a>
				        	<a  href="JavaScript:void(0);">GEAR UP</a>
				        	<p>Learn about the enquipment you need to be your best on court.</p></div>
				        </div>
				        <div class="col-sm-4">
				        	<div class="menus-details"><a href="JavaScript:void(0);"><img src="<?php echo get_stylesheet_directory_uri();?>/images/sub-img3.jpg" alt=""></a>
				        	<a href="JavaScript:void(0);">HEALTH AND FITNESS</a>
				        	<p>Taking care of yourself is key to playing your best game.</p></div>

				        		<div class="menus-details"><a href="JavaScript:void(0);"><img src="<?php echo get_stylesheet_directory_uri();?>/images/sub-img4.jpg" alt=""></a>
				        	<a href="">WHAT's THE CALL?</a>
				        	<p>Stay on top of the rules about official calls and clear up any questions.</p></div>
				        </div>
				        <div class="col-sm-4">
				        	<div class="green-box">
				        		<h2>TIPS</h2>
				        		<h3>FOR YOU</h3>
				        		<p>Improve your tennis game with video tutorials, tips from the pros and more.</p>
				        	</div>
				        </div>
				          </div>
				        </li>
				    
				      </ul>
					</li>
					<li><a href="JavaScript:void(0);">About</a></li>
					<li><a href="JavaScript:void(0);">improve </a></li>
					<li><a href="JavaScript:void(0);">history</a></li>
					<li><a href="JavaScript:void(0);">Results </a></li>
					<li><a href="JavaScript:void(0);">Rankings</a></li>
					<li><a href="JavaScript:void(0);"> Photos</a></li>
					<li><a href="JavaScript:void(0);">upcoming Events</a></li>
					<li><a href="JavaScript:void(0);">Contact </a></li>
					<li><a href="JavaScript:void(0);">Shop  </a></li>                                                                                               
				</ul> -->
				<?php echo wp_nav_menu(array('theme_location'=>'primary','menu_class'=>'nav-menu','menu_id'=>'menu','walker' => new subMenu)); ?>
			</div>
		</div>
	</div>
</header>
<?php if(is_home() || is_front_page()){?>
<section class="banner-sec">
	    <div class="owl-carousel owl-theme bannre-slider">   
	    	<?php $my_query = new WP_Query('post_type=slider&posts_per_page=-1&order=ASC');
      			while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<?php $post_id = get_the_ID();?>
						      <div class="item">
						      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id),'full');?>
						      	  <img src="<?php echo $image[0];?>" alt="" />
						      	  <div class="slid-caption slid-1">
					               <div class="center_block">
					                  <h3 class="bnr-ttl animated fadeInDown"">Welcome to the official website for</h3>
					                  <h2 class="bnr-ttl animated fadeInDown""><?php the_title();?></h2>
					                   <p class="animated fadeInUp"><?php echo get_the_content();?></p>
					                </div>
					              </div>
						      </div>
	      
	     	<?php endwhile;  wp_reset_query(); ?>
	    </div>
    </section> <!--/. End Banner Slider -->
<?php }
 if (is_singular('tournaments') || is_singular('rankings') || is_shop() || is_singular('product')) {
			echo '<img src="'.get_stylesheet_directory_uri().'/images/inner-top-bg.jpg">';
		}
		if(is_page() && ! is_home() && ! is_front_page()){?>
			<section class="inner-top-banar">
				<?php
				global $post; 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full');
				if(empty($image)){?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/images/inner-top-bg.jpg">
				<?php }
				else{?>
				<img src="<?php echo $image[0];?>">
				<?php }?>
					<div class="top-center-text">
						<h2><?php the_title();?></h2>
					</div>
				</section>
		<?php }?>



