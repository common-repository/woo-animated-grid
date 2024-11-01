<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings      = array(
  'menu_title' => 'Woo Grid options',
  'menu_type'  => 'add_menu_page',
  'menu_slug'  => 'woo-animated-grid',
  'ajax_save'  => true,
);


// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

// ----------------------------------------
// a option section for options overview  -
// ----------------------------------------
$options[]      = array(
  'name'        => 'overwiew',
  'title'       => 'Grid Options ',
  'icon'        => 'fa fa-gear',

  // begin: fields
  'fields'      => array(

    // begin: a field
    // end: a field

	array(
  'id'             => 'woo-animation',
  'type'           => 'select',
  'title'          => 'Select Animation Effect',
  'options'        => array(
    'grid effect-1'          => 'Fade',
    'grid effect-2'     => 'Slide',
    'grid effect-3'         => 'Zoom In',
	'grid effect-4'         => 'Bottom Flip',
	'grid effect-5'         => 'Roll In',
	'grid effect-6'         => 'Top Flip',
	'grid effect-7'         => 'Horizontal Flip',
	'grid effect-8'         => 'Fast Zoom In',
  ),
  'default_option' => 'Select a animation',
),
	
	array(
  'id'    => 'woo-no-products', // this is must be unique
  'type'  => 'text',
  'title' => 'No.of products to show',
), 

array(
  'id'             => 'woo_product_cat',
  'type'           => 'select',
  'title'          => 'Select Product Categories',
  'options'        => 'categories',
  'query_args'     => array(
    'type'         => 'categories',
    'taxonomy'     => 'product_cat',
    'orderby' => 'name',
    'order' => 'ASC',
  ),
  
  'default_option' => 'All',
),
array(
  'id'    => 'woo_grid_btn',
  'type'  => 'switcher',
  'title' => 'Hide Add to Cart Button',
   'default' => false
),
array(
  'id'    => 'woo_grid_price',
  'type'  => 'switcher',
  'title' => 'Hide Price',
   'default' => false
),


 
  ), // end: fields
);







CSFramework::instance( $settings, $options );
