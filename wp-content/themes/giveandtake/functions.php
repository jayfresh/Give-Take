<?php

function givetake_init() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action('init', 'givetake_init');

?>