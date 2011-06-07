<?php get_header();

wp_nav_menu( array(
	'container' => 'false',
	'theme_location' => 'main_menu', 
	'menu_id' => 'nav'
) );

get_template_part('snippets/loop');

get_footer(); ?>
