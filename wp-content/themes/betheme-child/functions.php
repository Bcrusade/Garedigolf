<?php
/**
 * Betheme Child Theme
 *
 * @package Betheme Child Theme
 * @author Muffin group
 * @link https://muffingroup.com
 */

/**
 * Load Textdomain
 */
add_action('after_setup_theme', 'mfn_load_child_theme_textdomain');
function mfn_load_child_theme_textdomain(){
	load_child_theme_textdomain('betheme', get_stylesheet_directory() . '/languages');
	load_child_theme_textdomain('mfn-opts', get_stylesheet_directory() . '/languages');
}

/**
 * Enqueue Styles
 */
function mfnch_enqueue_styles()
{
	if ( is_rtl() ) {
		wp_enqueue_style('mfn-rtl', get_template_directory_uri() . '/rtl.css');
	}

	wp_dequeue_style('style');
	wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'mfnch_enqueue_styles', 101);

/**
 * Carica Waypoints
 */
function carica_waypoints() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('waypoints', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js', array('jquery'), '4.0.1', true);
}
add_action('wp_enqueue_scripts', 'carica_waypoints');

/**
 * Aggiunta codice nel <head>
 */
add_action('wp_head', 'add_header_code');
function add_header_code() {
    echo "
    <!-- TrustBox script -->
    <script type='text/javascript' src='//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js' async></script>
    <!-- End TrustBox script -->";
}

/**
 * Aggiunta codice nel <footer>
 */
add_action('wp_footer', 'add_footer_code');
function add_footer_code() {
    // Qui puoi aggiungere codice per il footer
}

/**
 * Aggiunta codice solo in Home Page
 */
add_action('wp_head', 'add_hp_header_code');
function add_hp_header_code() {
    if (is_front_page()) {
        // Qui puoi aggiungere codice solo per la home page
    }
}

/**
 * Aggiunta codice per una pagina specifica
 */
add_action('wp_head', 'add_code_specific_page');
function add_code_specific_page() {
    if (is_page(123)) { // Sostituisci 123 con l'ID della pagina
        // Qui puoi aggiungere codice specifico per una pagina
    }
}

/**
 * Carica Owl Carousel
 */
function carica_owl_carousel() {
    wp_enqueue_style('owl-carousel', get_stylesheet_directory_uri() . '/assets/owl-carousel/owl.carousel.min.css', array(), '2.3.4');
    wp_enqueue_style('owl-theme', get_stylesheet_directory_uri() . '/assets/owl-carousel/owl.theme.default.min.css', array(), '2.3.4');

    wp_enqueue_script('jquery');
    wp_enqueue_script('owl-carousel', get_stylesheet_directory_uri() . '/assets/owl-carousel/owl.carousel.min.js', array('jquery'), '2.3.4', true);
    wp_enqueue_script('owl-init', get_stylesheet_directory_uri() . '/assets/owl-carousel/owl-init.js', array('jquery', 'owl-carousel'), null, true);
}
add_action('wp_enqueue_scripts', 'carica_owl_carousel');

/**
 * Carica Isotope
 */
function carica_isotope() {
    //wp_enqueue_style('isotope-css', get_stylesheet_directory_uri() . '/assets/isotope-docs/node_modules/isotope-layout/dist/isotope.min.css');

    wp_enqueue_script('jquery');
    // Carica il file di Isotope
    wp_enqueue_script('isotope', get_stylesheet_directory_uri() . '/assets/isotope-docs/isotope.pkgd.min.js', array('jquery'), null, true);
    // Carica il tuo script di inizializzazione di Isotope
    wp_enqueue_script('isotope-init', get_stylesheet_directory_uri() . '/assets/isotope-docs/isotope-init.js', array('isotope'), null, true);}
add_action('wp_enqueue_scripts', 'carica_isotope');


/**
 * Carica script personalizzati
 */
function carica_script_personalizzato() {
    wp_enqueue_script('jquery');

    // Carica il tuo script personalizzato
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/custom.js', array('jquery', 'waypoints'), null, true);

}
add_action('wp_enqueue_scripts', 'carica_script_personalizzato');

/**
 * Carica svg
 */
function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');





