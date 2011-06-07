<?php

function givetake_init() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action('init', 'givetake_init');

function the_slug() {
	global $post;
	echo $post->post_name;
}

?>