<?php get_header();

// The Query
query_posts("post_type=page&orderby=menu_order&order=ASC");

get_template_part('snippets/loop');

get_footer(); ?>
