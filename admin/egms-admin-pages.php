<?php

function egms_admin_pages() {

    add_menu_page(
        __( 'Easy Google Maps Shortcode - Options', 'egms' ),
        __( 'Easy G.Maps', 'egms' ),
        'manage_options',
        'easy-google-maps-shortcode/admin/options.php',
        '',
        'dashicons-location',
        81
    );
}

add_action( 'admin_menu', 'egms_admin_pages' );
