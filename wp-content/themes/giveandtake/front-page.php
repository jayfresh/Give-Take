<?php get_header();

// The Query
$front_page_id = $post->ID;
query_posts("post_type=page&orderby=menu_order&order=ASC&post_parent=$front_page_id");

get_template_part('snippets/loop');

get_footer(); ?>
