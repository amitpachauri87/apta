<?php
// Same as error_reporting(E_ALL);
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
//include("file_with_errors.php");
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	/*
	 * Enable support for custom logo.
	 *
	 * @since Twenty Fifteen 1.5
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.

	/**
	 * Filter Twenty Fifteen custom-header support arguments.
	 *
	 * @since Twenty Fifteen 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-color     		Default color of the header.
	 *     @type string $default-attachment     Default attachment of the header.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	//add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your header menu.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

/*if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
/*function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
/*	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
/*	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
/*	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;*/

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	//wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	//wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	//wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	//wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	//wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	//wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	//wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	//wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	/*if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );*/
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Fifteen 1.7
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
/*function twentyfifteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyfifteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyfifteen_resource_hints', 10, 2 );*/

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Fifteen 1.9
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyfifteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 22;
	$args['smallest'] = 8;
	$args['unit']     = 'pt';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentyfifteen_widget_tag_cloud_args' );


/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * custom functions additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/theme-functions.php';

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// Function to convert NTP string to an array
function NVPToArray($NVPString)
{
    $proArray = array();
    while(strlen($NVPString))
    {
        // name
        $keypos= strpos($NVPString,'=');
        $keyval = substr($NVPString,0,$keypos);
        // value
        $valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
        $valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
        // decoding the respose
        $proArray[$keyval] = urldecode($valval);
        $NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
    }
    return $proArray;
}
add_action( 'wp_ajax_submit_review', '_submit_review' );    // If called from admin panel
    add_action( 'wp_ajax_nopriv_submit_review', '_submit_review' );    // If called from front end
    function _submit_review() {
    	update_user_meta(get_current_user_id(),'billing_first_name',$_POST['first_name']);
    	update_user_meta(get_current_user_id(),'billing_last_name',$_POST['last_name']);
    	update_user_meta(get_current_user_id(),'billing_country',$_POST['country_code']);
    	update_user_meta(get_current_user_id(),'billing_state',$_POST['state']);
    	update_user_meta(get_current_user_id(),'billing_address_1',$_POST['street']);
    	update_user_meta(get_current_user_id(),'billing_city',$_POST['city']);
    	update_user_meta(get_current_user_id(),'billing_postcode',$_POST['zip_code']);
    	$api_version = '85.5';
$sandbox_api_username = get_field('sanbox_api_username','option');
$sandbox_api_password = get_field('sanbox_api_password','option');
$sandbox_api_endpoint = get_field('sandbox_api_endpoint','option');
$sandbox_api_signature = get_field('sanbox_api_signature','option');

$live_api_endpoint = get_field('live_api_endpoint','option');
$live_api_username = get_field('live_api_username','option');
$live_api_password = get_field('live_api_password','option');
$live_api_signature = get_field('live_api_signature','option');


$api_endpoint = $sandbox ?  $sandbox_api_endpoint: $live_api_endpoint;
$api_username = $sandbox ?  $sandbox_api_username : $live_api_username;
$api_password = $sandbox ?  $sandbox_api_password : $live_api_password;
$api_signature = $sandbox ? $sandbox_api_signature : $live_api_signature;

 $slug = $_POST['slug'];
 $mypost = get_page_by_path($slug, '', 'tournaments');
 $id = $mypost->ID;
 $title = get_the_title($id);
$price = get_post_meta($id,'tournament_price',true);
$location = get_post_meta($id,'tournament_location',true);
$start_date = get_field($id,'tournament_start_date',false, false);
$date = new DateTime($start_date);
$currency = 'USD';
$request_params = array
                    (
                    'METHOD' => 'DoDirectPayment', 
                    'USER' => $sandbox_api_username, 
                    'PWD' => $sandbox_api_password, 
                    'SIGNATURE' => $sandbox_api_signature, 
                    'VERSION' => $api_version, 
                    'PAYMENTACTION' => 'Sale',                   
                    'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
                    'CREDITCARDTYPE' => 'MasterCard', 
                    'ACCT' => $_POST['card_number'],                        
                    'EXPDATE' => $_POST['expiration_date'],           
                    'CVV2' => $_POST['cvv_number'], 
                    'FIRSTNAME' => $_POST['first_name'], 
                    'LASTNAME' => $_POST['last_name'], 
                    'STREET' => $_POST['street'], 
                    'CITY' => $_POST['city'], 
                    'STATE' => $_POST['state'],                     
                    'COUNTRYCODE' => $_POST['country_code'], 
                    'ZIP' => $_POST['zip_code'], 
                    'AMT' => $price, 
                    'CURRENCYCODE' => $currency, 
                    'DESC' => $title,
                    'custom'=>get_current_user_id().'@@'.$id,
                    );
$nvp_string = '';
foreach($request_params as $var=>$val)
{
    $nvp_string .= '&'.$var.'='.urlencode($val);    
}
//print_r($nvp_string);                    

$curl = curl_init();
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_URL, $sandbox_api_endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);
 
$result = curl_exec($curl);     
curl_close($curl);

$nvp_response_array = parse_str($result);

$output = NVPToArray($result);
if($output['ACK']=="Success")
{
	    $current_user = wp_get_current_user();
	    $user_email = $current_user->user_email; 
	$message  = 'Hello ';
	$message .= '<br>';
	$message .= 'Thanks for booking the tournament';
	$message .= '<br>';
	$message .= 'Tournament Name : '.$title;
	$message .= '<br>';
	$message .= 'Tournament Location : '.$location;
	$message .= '<br>';
	$message .= 'Tournament Start Date : '.get_field('tournament_start_date',$id);
	$message .= '<br>';
	$message .= 'Tournament Price : '.$price;
	$message .= '<br>';
	$message .= '<br>';
	$message .= 'Thanks<br>';
	$message .= 'APTA Team';
	$admin_email = get_option('admin_email');

	mail($user_email,'Tournament Booking',$message);
	mail($admin_email,'Tournament Booking',$message);
	echo 'success';
}
else{
	echo 'error';
}

    	die();
    }

/*Redirect back to the tournament page*/

function redirect_user_back_to_product() {
	// check for a referer
	$referer = wp_get_referer();
	// if there was a referer.. 
	if( $referer ) {
		$post_id = url_to_postid( $referer );
		$post_data = get_post( $post_id );
		if( $post_data ) {
			// if the refering page was a single product, let's append a hidden field to reidrect the user to
			if( isset( $post_data->post_type ) && $post_data->post_type == 'tournaments' ) {
				?>
					<input type="hidden" name="redirect-user" value="<?php echo $referer; ?>">
				<?php
			}
		}
	}
}
add_action( 'woocommerce_login_form', 'redirect_user_back_to_product' );
/*
*	Redirect the user back to the passed in referer page
*	- Which should be the URL to the last viewed product before logging
*/
function custom_woocommerce_login_redirect_back_to_product_page( $redirect, $user ) {
	if( isset( $_POST['redirect-user'] ) ) {
		$redirect = esc_url( $_POST['redirect-user'] );
	}
	return $redirect;
}
add_filter( 'woocommerce_login_redirect', 'custom_woocommerce_login_redirect_back_to_product_page' );