<?php
/*
Plugin Name: Easy Google Maps Shortcode
Plugin URI: https://rafael.work/easy-google-maps-shortcode/
Description: Create a Google Maps Shortcode.
Version: 1.0.0
Author: Rafael Business
Author URI: https://rafael.business
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Loads the plugin textdomain
 *
 * @access      private
 * @since       1.2
 * @return      void
*/
function egms_map_textdomain() {

	// Set filter for plugin's languages directory
	$lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$lang_dir = apply_filters( 'egms_map_languages_directory', $lang_dir );

	// Load the translations
	load_plugin_textdomain( 'egms', false, $lang_dir );
}

add_action( 'init', 'egms_map_textdomain' );


/**
 * Displays the map
 *
 * @access      private
 * @since       1.0
 * @return      void
*/
function egms_shortcode( $atts ) {

	$atts = shortcode_atts(
		array(
			'lat'           	=> 0,
			'lng'				=> 0,
			'key'               => '',
			'width'             => '100%',
			'height'            => '400px',
			'enablescrollwheel' => 'true',
			'zoom'              => 15,
			'disablecontrols'   => 'false',
			'title'				=> '',
			'icon'				=> '',
			'link'				=> ''
		),
		$atts
	);

	$lat = $atts['lat'];
	$lng = $atts['lng'];
	$key = $atts['key'];
	$title = $atts['title'];
	$icon = $atts['icon'];
	$link = $atts['link'];

	if( $lat && $lng && $key ) : 

		$map_id = uniqid( 'egms_map_' ); // generate a unique ID for this map

		ob_start(); ?>
		
        <script src="https://maps.google.com/maps/api/js?key=<?php echo sanitize_text_field( $key ); ?>" type="text/javascript"></script>
		<div class="egms_map_canvas" id="<?php echo esc_attr( $map_id ); ?>" style="height: <?php echo esc_attr( $atts['height'] ); ?>; width: <?php echo esc_attr( $atts['width'] ); ?>"></div>
		<script type="text/javascript">
			var map_<?php echo $map_id; ?>;
			function egms_run_map_<?php echo $map_id ; ?>(){
				var location = new google.maps.LatLng("<?php echo $lat; ?>", "<?php echo $lng; ?>");
				var map_options = {
					zoom: <?php echo $atts['zoom']; ?>,
					center: location,
					scrollwheel: <?php echo 'true' === strtolower( $atts['enablescrollwheel'] ) ? '1' : '0'; ?>,
					disableDefaultUI: <?php echo 'true' === strtolower( $atts['disablecontrols'] ) ? '1' : '0'; ?>,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				map_<?php echo $map_id ; ?> = new google.maps.Map(document.getElementById("<?php echo $map_id ; ?>"), map_options);
				var marker = new google.maps.Marker({
				position: location,
				map: map_<?php echo $map_id ; ?>,
				icon: "<?php echo $icon; ?>",
				title: "<?php echo $title; ?>",
				});
				marker.addListener("click", () => {
					window.open('<?php echo $link; ?>', '_blank');
				});
			}
			egms_run_map_<?php echo $map_id ; ?>();
		</script>
		<?php
		return ob_get_clean();
	else :
		return __( 'This Google Map cannot be loaded because the maps API does not appear to be loaded', 'egms' );
	endif;
}

add_shortcode( 'easy-google-maps', 'egms_shortcode' );
