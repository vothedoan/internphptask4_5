<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

function func_child_theme_cart_checkout(){
    
}
add_filter('init','func_child_theme_cart_checkout');
// END ENQUEUE PARENT ACTION

function woocommerce_cart_totals_taxes_total_html_func( $tax_count ) {
    echo $tax_count;
}
add_filter('woocommerce_cart_totals_taxes_total_html', 'woocommerce_cart_totals_taxes_total_html_func');
