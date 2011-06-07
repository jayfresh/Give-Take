<?php

function givetake_init() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action('init', 'givetake_init');

function the_slug() {
	global $post;
	echo $post->post_name;
}

function address_func() {
     return '<div><img class="map left" src="images/map.jpg" alt="" />' .
		'<div class="adr">' .
			'<div class="street-address">3 Lordship Lane</div>' .
			'<div class="extended-address">East Dulwich</div>' .
			'<div class="locality">London</div>' .
			'<div class="postal-code">SE22 8EW</div>' .
			'</div>' .
		'</div>';
}

add_shortcode('address', 'address_func');

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