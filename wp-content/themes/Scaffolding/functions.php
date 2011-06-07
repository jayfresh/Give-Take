<?php 

// Custom header constants
define( 'HEADER_IMAGE_WIDTH', apply_filters( 'scaffolding_header_image_width', 220 ) );
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'scaffolding_header_image_height', 220 ) );
define( 'NO_HEADER_TEXT', true );

// Allow for a custom header
add_custom_image_header();

// Allow for a custom background
add_custom_background();


// Register Main and Footer Menu
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'main_menu', 'Main Menu' );
}


?>