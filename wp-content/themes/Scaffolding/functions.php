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


// Use a filter to add a home link to main_menu
//TO-DO : fix line 26- this doesn't seem to work 

function addHomeMenuLink($menuItems, $args)
{
	if('main_menu' == $args->theme_location)
	{
		if ( is_front_page() )
			$class = 'class="current_page_item"';
		else
			$class = '';	

		$homeMenuItem = '<li ' . $class . '>' .
						$args->before .
						'<a href="' . home_url( '/' ) . '" title="Home">' .
							$args->link_before .
							'Home' .
							$args->link_after .
						'</a>' .
						$args->after .
						'</li>';

		$menuItems = $homeMenuItem . $menuItems;
	}

	return $menuItems;
}

add_filter( 'wp_nav_menu_items', 'addHomeMenuLink', 10, 2 );

// JB What are these numbers for?


?>