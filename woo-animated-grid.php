<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://beescripts.com
 * @since             1.0.0
 * @package           Woo_Animated_Grid
 *
 * @wordpress-plugin
 * Plugin Name:       woo animated grid pro
 * Plugin URI:        http://beescripts.com
 * Description:       A simple plugin  for woocommerce to show products with grid loading effects and admin settings .
 * Version:           1.0.0
 * Author:            aumsrini
 * Author URI:        http://beescripts.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-animated-grid-pro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-animated-grid-activator.php
 */
function activate_woo_animated_grid() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-animated-grid-activator.php';
	Woo_Animated_Grid_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-animated-grid-deactivator.php
 */
function deactivate_woo_animated_grid() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-animated-grid-deactivator.php';
	Woo_Animated_Grid_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_animated_grid' );
register_deactivation_hook( __FILE__, 'deactivate_woo_animated_grid' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-animated-grid.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
 
 ///REGISTER STYLE

 function woo_grid_load_scripts() {
    wp_enqueue_style( 'woo-grid-css', plugin_dir_url( __FILE__ ) .'/public/css/woo-animated-grid-public.css' );
    wp_enqueue_script( 'woo-grid-masonry', plugin_dir_url( __FILE__ ) . '/public/js/masonry.pkgd.min.js', array(), '1.0.0', true );
	 wp_enqueue_script( 'woo-grid-modernizr', plugin_dir_url( __FILE__ ) .'/public/js/modernizr.custom.js', array(), '1.0.0', true );
	  wp_enqueue_script( 'woo-grid-images-loader', plugin_dir_url( __FILE__ ) . '/public/js/imagesloaded.js', array(), '1.0.0', true );
	  wp_enqueue_script( 'woo-grid-classie',  plugin_dir_url( __FILE__ ) .'/public/js/classie.js', array(), '1.0.0', true );
	 
	 
	 	
}
add_action( 'wp_enqueue_scripts', 'woo_grid_load_scripts' );

//END STYLE





function run_woo_animated_grid() {

	$plugin = new Woo_Animated_Grid();
	$plugin->run();

}
run_woo_animated_grid();

add_action('woo_before_shop_loop','show_grid_products');
?>
<?php 
function woo_grid_load()
{
    //list terms in a given taxonomy using wp_list_categories (also useful as a widget if using a PHP Code plugin)
?>

<ul class="woocommerce grid <?php echo cs_get_option( 'woo-animation' ); ?> " id="grid">
	<?php
	
	$woo_no_of_products= cs_get_option( 'woo-no-products' );
	$woo_product_cat= cs_get_option( 'woo_product_cat' );
	
	if($woo_product_cat=="")
	{
	$woo_product_cat_name="";
	}
if( $term = get_term_by( 'id', $woo_product_cat, 'product_cat' ) ){
    $woo_product_cat_name= $term->name;
}
		$woo_anim_args = array(
			'post_type' => 'product',
			'product_cat' => $woo_product_cat_name,
			'posts_per_page' => $woo_no_of_products
			);
		$woo_anim_loop = new WP_Query( $woo_anim_args );
		if ( $woo_anim_loop->have_posts() ) {
			while ( $woo_anim_loop->have_posts() ) : $woo_anim_loop->the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
</ul><!--/.products-->
<?
}
add_shortcode( 'woo-loading-grids', 'woo_grid_load' );
//Hide Add to cart Button

$woo_grid_btn= $has_true = cs_get_option( 'woo_grid_btn');



if($woo_grid_btn=='1')

{
function remove_loop_button(){
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

}
add_action('init','remove_loop_button');
}

//Hide Add to cart Button End


//Hide Price

$woo_grid_price= $has_true = cs_get_option( 'woo_grid_price');


if($woo_grid_price=='1')

{
function remove_loop_price(){
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

}
add_action('init','remove_loop_price');
}

///Hide Price End
add_action( 'wp_footer', 'grid_loader_footer');
function grid_loader_footer() {

 wp_enqueue_script( 'woo-grid-AnimOnScroll', plugin_dir_url( __FILE__ ) . '/public/js/AnimOnScroll.js', array(), '1.0.0', true );
?>

<?php
}

