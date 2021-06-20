<?php
/*
Plugin Name: Easy Google Maps Shortcode
Plugin URI: https://rafael.work/easy-google-maps-shortcode/
Description: Create a Google Maps Shortcode.
Version: 1.0.0
Author: Rafael Business
Author URI: https://rafael.business
*/

if (!defined( 'WPINC' )) {
	die;
}


add_action( 'init', function() {

	$lang_dir = dirname(plugin_basename(__FILE__)) . '/languages/';
	$lang_dir = apply_filters('egms_map_languages_directory', $lang_dir);
	load_plugin_textdomain('egms', false, $lang_dir);
});


add_action( 'wp_head', function() {

    $metas = array(
    	'map_id'			=> uniqid( 'egms_map_' ),
		'lat'           	=> 0,
		'lng'				=> 0,
		'key'               => '',
		'enablescrollwheel' => 'true',
		'zoom'              => 15,
		'disablecontrols'   => 'false',
		'title'				=> '',
		'icon'				=> '',
		'link'				=> ''
	);

	foreach ($metas as $name => $content) {
		
		?>
	    <meta plugin="egms_map" name="<?php echo $name; ?>" content="<?php echo $content; ?>">
	    <?php	
	}
});


add_shortcode( 'easy-google-maps', function($atts) {

	$prop = shortcode_atts(array('id' => ''), $atts);

	if ($prop['id']) {

		ob_start(); ?>
		
		<div class="egms_map" style="height: 400px;"></div>
		<?php
		return ob_get_clean();
	} else {

		return __( 'This Google Map cannot be loaded because the maps API does not appear to be loaded', 'egms' );
	}
});

add_action( 'wp_footer', function() {

	?>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyAVKJ9VnqGmMjelgrjgBEVuIvEDwzNS2cI" type="text/javascript"></script>
	<script src="<?php echo plugin_dir_url(__FILE__); ?>assets/js/map.js" type="text/javascript"></script>
	<?php
});
