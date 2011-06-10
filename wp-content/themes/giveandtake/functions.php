<?php

add_theme_support( 'post-thumbnails' );
add_image_size( 'slideshow-img', 470, 320, true ); 

function givetake_init() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action('init', 'givetake_init');

function add_stylesheets() { ?>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Francois+One' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,bold' rel='stylesheet' type='text/css'>
	<link href='<?php bloginfo( 'stylesheet_directory' ); ?>/css/svwp_style.css' rel='stylesheet' type='text/css'>
<?php }

add_action('wp_head', 'add_stylesheets');

function add_scripts() { ?>
	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.scrollTo-1.4.2-min.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.slideViewerPro.1.0.js"></script>
<?php }

add_action('wp_footer', 'add_scripts');

function the_slug() {
	global $post;
	echo $post->post_name;
}

function slideshow_func() {
	get_template_part('snippets/slideshow');
}

add_shortcode('slideshow', 'slideshow_func');

function date_func() {
	echo '&copy;'.date('Y');
}

add_shortcode('date', 'date_func');


function address_func() {
     return '<div class="location"><a href="http://maps.google.co.uk/maps?f=q&source=s_q&hl=en&geocode=&q=3+LORDSHIP+LANE,+EAST+DULWICH,+SE22+8EW&sll=51.514681,-0.204186&sspn=0.028149,0.077162&ie=UTF8&hq=&hnear=3+Lordship+Ln,+Camberwell,+Greater+London+SE22+8,+United+Kingdom&z=16" target="_blank"><img class="map left marginright" src="'.get_bloginfo('stylesheet_directory').'/images/map.jpg" alt="Link to Google Map showing Give and Take shop location" /></a>' .
		'<div class="adr">' .
			'<div class="street-address">3 Lordship Lane</div>' .
			'<div class="extended-address">East Dulwich</div>' .
			'<div class="locality">London</div>' .
			'<div class="postal-code">SE22 8EW</div>' .
			'</div>' .
		'</div>';
}

add_shortcode('address', 'address_func');

function and_func($atts, $content) {
	if(!$content) {
		$content = "and";
	}
	return '<span class="and">'.$content.'</span>';
}

add_shortcode('and', 'and_func');

function address_fields_init() {
	add_settings_section('address_fields_section', 'Your address', 'address_fields_section_callback', 'general');
	
	add_settings_field( 'address_fields_street_address', 'Street address', 'street_address_input', 'general', 'address_fields_section' );
	add_settings_field( 'address_fields_extended_address', 'Extended address', 'extended_address_input', 'general', 'address_fields_section' );
	add_settings_field( 'address_fields_location', 'City', 'locality_input', 'general', 'address_fields_section' );
	add_settings_field( 'address_fields_postal_code', 'Postcode', 'postal_code_input', 'general', 'address_fields_section' );

	register_setting( 'general', 'address_fields_street_address' );
	register_setting( 'general', 'address_fields_extended_address' );
	register_setting( 'general', 'address_fields_locality' );
	register_setting( 'general', 'address_fields_postal_code' );
}

add_action( 'admin_init', 'address_fields_init' );

function address_fields_section_callback() { ?>
	<p>This lets you setup your address for the [address] shortcode</p>
<?php }

function street_address_input() {
	echo '<input type="text" name="address_fields_street_address" id="address_fields_street_address" value="' . get_option('address_fields_street_address') .'">';
}
function extended_address_input() { ?>
	<input type="text" name="address_fields_extended_address" id="address_fields_extended_address" value="<?php echo get_option('address_fields_extended_address'); ?>">
<?php }
function locality_input() { ?>
	<input type="text" name="address_fields_locality" id="address_fields_locality" value="<?php echo get_option('address_fields_locality'); ?>">
<?php }
function postal_code_input() { ?>
	<input type="text" name="address_fields_postal_code" id="address_fields_postal_code" value="<?php echo get_option('address_fields_postal_code'); ?>">
<?php } ?>