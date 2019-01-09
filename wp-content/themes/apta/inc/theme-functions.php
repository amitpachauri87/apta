<?php 
// custom functions for the apta theme 

function themeslug_theme_customizer( $wp_customize ) {
    // Fun code will go here
		$wp_customize->add_section( 'themeslug_logo_section' , array(
    'title'       => __( 'Logo', 'themeslug' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
) );
		$wp_customize->add_setting( 'themeslug_logo' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
    'label'    => __( 'Logo', 'themeslug' ),
    'section'  => 'themeslug_logo_section',
    'settings' => 'themeslug_logo',
) ) );
}
add_action( 'customize_register', 'themeslug_theme_customizer' );


/*CPT for slider*/

$labels = array(
		'name'               => _x( 'Slider', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Slider', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Slider', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Slider', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Slider', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Slider', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Slider', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Slider', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Slider', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Slider', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Slider', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Slider:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Slider found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Slider found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,

		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'slider' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,

		'supports'           => array( 'title', 'editor','thumbnail',)
	);
	register_post_type( 'Slider', $args );

/*CPT for rankings*/

$labels = array(
		'name'               => _x( 'Rankings', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Rankings', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Rankings', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Rankings', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Rankings', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Rankings', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Rankings', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Rankings', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Rankings', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Rankings', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Rankings', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Rankings:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Rankings found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Rankings found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,

		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ranking' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,

		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt',)
	);
	register_post_type( 'Rankings', $args );

/*CPT for tournaments*/

$labels = array(
		'name'               => _x( 'Tournaments', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Tournaments', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Tournaments', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Tournaments', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Tournaments', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Tournaments', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Tournaments', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Tournaments', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Tournaments', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Tournaments', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Tournaments', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Tournaments:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Tournaments found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Tournaments found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,

		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'tournament' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,

		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt',)
	);
	register_post_type( 'Tournaments', $args );

/*login logout menu*/

add_filter( 'wp_nav_menu_items', 'my_account_loginout_link', 100, 2 );
/**
 * Add WooCommerce My Account Login/Logout to Registered Menu
 * 
 * @link https://support.woothemes.com/hc/en-us/articles/203106357-Add-Login-Logout-Links-To-The-Custom-Primary-Menu-Area
 */
function my_account_loginout_link( $items, $args ) {
    if (is_user_logged_in() && $args->theme_location == 'primary') { //change your theme registered menu name to suit
    	$items .= '<li><a href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">My Account</a></li>'; 
        //$items .= '<li><a href="'. wp_logout_url( get_permalink( wc_get_page_id( 'shop' ) ) ) .'">Log Out</a></li>'; //change logout link, here it goes to 'shop', you may want to put it to 'myaccount'
    }
    elseif (!is_user_logged_in() && $args->theme_location == 'primary') {//change your theme registered menu name to suit
        $items .= '<li><a href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">Log In</a></li>';
    }
    return $items;
}

 /* Account menu items
 *
 * @param arr $items
 * @return arr
 */
function iconic_account_menu_items( $items ) {
 
    $items['tournaments-order'] = __( 'Tournaments Order', 'iconic' );
 
    return $items;
 
}
 
add_filter( 'woocommerce_account_menu_items', 'iconic_account_menu_items', 10, 15 );

/**
 * Add endpoint
 */
function iconic_add_my_account_endpoint() {

    add_rewrite_endpoint( 'tournaments-order', EP_PAGES );

}

add_action( 'init', 'iconic_add_my_account_endpoint' );

/**
 * Information content
 */
function iconic_information_endpoint_content() {
    include('front_order_tournament.php');
}

add_action( 'woocommerce_account_tournaments-order_endpoint', 'iconic_information_endpoint_content' );

function wpb_woo_my_account_order() {
$myorder = array(
    'dashboard'          => __( 'Dashboard', 'woocommerce' ),
    'orders'             => __( 'Orders', 'woocommerce' ),
    'tournaments-order'    => __( 'Tournaments Orders', 'woocommerce' ),
    'downloads'      => __( 'Downloads', 'woocommerce' ),
    'edit-address'       => __( 'Addresses', 'woocommerce' ),
    'edit-account'       => __( 'Account Details', 'woocommerce' ),
    'customer-logout'    => __( 'Logout', 'woocommerce' ),
);
return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );


/**
* Adds a submenu page under a custom post type parent.
*/
function books_register_ref_page() {
    add_submenu_page('edit.php?post_type=tournaments',__( 'Tournament Order', 'textdomain' ),__( 'Tournament Order', 'textdomain' ),'manage_options','tournament-order','tournament_order_page_callback');
}

/**
* Display callback for the submenu page.
*/
function tournament_order_page_callback() { 
   include('tournaments_order.php');
}

add_action('admin_menu','books_register_ref_page');


/*submenus created for primary menu*/

class subMenu extends Walker_Nav_Menu {
    function end_el(&$output, $item, $depth=0, $args=array()) {

    if( 'Home' == $item->title ){
        $output .= '<ul class="menus">
        <li class="has-submenu"><div class="row">';
		$my_query = new WP_Query('cat=21&posts_per_page=4');
		$i=1; 
	$output .=  '<div class="col-sm-4">';
				while($my_query->have_posts()) : $my_query->the_post();
				$output .= '<div class="menus-details"><a href="'.get_the_permalink().'">'.
				        			get_the_post_thumbnail().'
				        		</a>
				        		<a href="'.get_the_permalink().'">'.get_the_title().'</a>
				        		<p>'.get_the_excerpt().'</p></div>';
				        if($i%2==0){					
				      $output .='</div><div class="col-sm-4">';
				        	}
				        
				        
				                         
$i++;
endwhile;
wp_reset_query();
$output .= '</div>';
$output .='<div class="col-sm-4">
				        	<div class="green-box">
				        		<h2>TIPS</h2>
				        		<h3>FOR YOU</h3>
				        		<p>Improve your tennis game with video tutorials, tips from the pros and more.</p>
				        	</div>
				        </div>';
		$output .= '</div></li></ul>';
    }
   // $output .= "</li>\n";  
    }


}