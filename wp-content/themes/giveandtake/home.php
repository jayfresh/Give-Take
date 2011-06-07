<?php get_header();

wp_nav_menu( array(
	'container' => 'false',
	'theme_location' => 'main_menu', 
	'menu_id' => 'nav'
) );

// The Query
query_posts("post_type=page&orderby=menu_order&order=ASC");

get_template_part('snippets/loop');

get_footer(); ?>
