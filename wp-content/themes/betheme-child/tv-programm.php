<?php
/**
 * Template Name: TV Programm
 * Template Post Type: post, page, programma-televisivo
 * Description: Pagina che include il template part hero-tv-programm.
 */

if (!defined('ABSPATH')) {
    exit; // Previene l'accesso diretto
}

error_log('[TV PROGRAMM] Template caricato per post ID: ' . get_the_ID());

// function carica_css_per_template_tv_programm() {
//     // Controlla se la pagina usa il template 'tv-programm.php'
//     if (is_page_template('tv-programm.php')) {
//         // Carica il file CSS per il template
//         wp_enqueue_style('style-tv-programm', get_stylesheet_directory_uri() . '/template-parts/css/hero-tv-programm.css');
//     } else {
//         // Se il CSS non è caricato, logga l'errore
//         error_log('Nessuno stile caricato per il template tv-programm.php, ID pagina: ' . get_the_ID());
//     }
// }
// add_action('wp_enqueue_scripts', 'carica_css_per_template_tv_programm');

function carica_css_per_template_tv_programm() {
    // Controlla se la pagina usa il template 'tv-programm.php'
    if (is_page_template('tv-programm.php')) {
        // Carica il file CSS per il template 'tv-programm.php'
        wp_enqueue_style('style-tv-programm', get_stylesheet_directory_uri() . '/template-parts/css/hero-tv-programm.css');
    }
    
    // Controlla se la pagina usa il template 'mansory-programm-video.php'
    if (is_page_template('tv-programm.php')) {
        // Carica il file CSS per il template 'mansory-programm-video.php'
        wp_enqueue_style('style-mansory-programm', get_stylesheet_directory_uri() . '/template-parts/css/mansory-programm-video.css');
    }

    // Log per verificare quando il CSS non viene caricato
    if (!is_page_template('tv-programm.php') && !is_page_template('mansory-programm-video.php')) {
        error_log('Nessuno stile caricato per i template tv-programm.php o mansory-programm-video.php, ID pagina: ' . get_the_ID());
    }
}
add_action('wp_enqueue_scripts', 'carica_css_per_template_tv_programm');


get_header(); ?>

<main class="tv-programm-page">
    <?php 
    // Verifica se il template part esiste nel percorso corretto
    if (file_exists(get_stylesheet_directory() . '/template-parts/hero-tv-programm.php')) {
        error_log('[TV PROGRAMM] Template part hero-tv-programm trovato e incluso.');
        get_template_part('template-parts/hero-tv-programm');
    } else {
        error_log('[TV PROGRAMM] Errore: Template part hero-tv-programm non trovato.');
        echo '<p>Errore: Template non trovato.</p>';
    }
    get_template_part('template-parts/mansory-programm-video');

    ?>
</main>

<?php get_footer(); ?>
