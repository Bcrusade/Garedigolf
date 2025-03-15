<?php
/*
Plugin Name: Hero HP Slider 
Version: 1.0
Description: Slider HP con campi dinamici generati con ACF. Il codice HTML generato per lo slider. [hp_hero_slider]
Author: Stefano
*/

// Carica CSS personalizzato
function load_hp_hero_slider_assets() {
    if (is_page('test-hero-slider')) {
    wp_enqueue_style('hp-hero-slider-style', plugin_dir_url(__FILE__) . 'css/style.css');
    }
}
add_action('wp_enqueue_scripts', 'load_hp_hero_slider_assets');

// Funzione di logging
function hp_log($message) {
    if (WP_DEBUG) {
        error_log('[HP Hero Slider] ' . $message);
    }
}

function hp_hero_slider() {
    ob_start();
    
    global $post;
    $post_id = $post ? $post->ID : 0;
    hp_log("Generazione slider per il post ID: $post_id");

    $slider_found = false;
    echo '<div class="hero-slider owl-carousel">';

    for ($i = 1; $i <= 5; $i++) {
        $slide = get_field("slide_$i", $post_id);

        if ($slide) {
            $media_url = esc_url($slide['background_video_'.$i] ?? '');
            $categoria = esc_html($slide['categoria_slide_'.$i] ?? '');
            $titolo = esc_html($slide['titolo_slide_'.$i] ?? '');
            $sottotitolo = esc_html($slide['sottotitolo_slide_'.$i] ?? '');
            $testo = wp_kses_post($slide['testo_slide_'.$i] ?? '');
            $bottone = $slide['bottone_slide_'.$i] ?? null;
            
            hp_log("Slide_$i - Media URL: $media_url");
            hp_log("Slide_$i - Categoria: $categoria");
            hp_log("Slide_$i - Titolo: $titolo");
            hp_log("Slide_$i - Sottotitolo: $sottotitolo");
            hp_log("Slide_$i - Testo: " . substr($testo, 0, 100) . '...');
            
            if (!empty($bottone)) {
                if (is_array($bottone) && isset($bottone['url'])) {
                    hp_log("Slide_$i - Bottone URL: " . $bottone['url']);
                } elseif (is_string($bottone)) {
                    hp_log("⚠️ Slide_$i - Bottone è una stringa invece di un array: $bottone");
                } else {
                    hp_log("❌ Slide_$i - Errore nel campo bottone.");
                }
            }

            if (!empty($media_url)) {
                $slider_found = true;
                hp_log("Slide_$i - Verifica tipo media...");
                
                echo '<div class="slide">';
                
                // Controllo se è un video MP4
                if (preg_match('/\.mp4$/i', $media_url)) {
                    hp_log("Slide_$i - Media è un video MP4");
                    echo "<video autoplay loop muted playsinline class='slide-bg-video'>
                            <source src='$media_url' type='video/mp4'>
                          </video>";
                } else {
                    hp_log("Slide_$i - Media è un'immagine");
                    // Se non è MP4, assumiamo che sia un'immagine
                    echo "<div class='slide-bg-image' style='background-image: url($media_url);'></div>";
                }
                
                echo '<div class="video-overlay"></div>';  
                echo '<div class="slide-content">';
                echo '<div class="slide-text-container">';
                echo '<div class="slide-text">';
                echo $categoria ? "<h3 class='categoria'>$categoria</h3>" : '';
                echo $titolo ? "<h2 class='titolo'>$titolo</h2>" : '';
                echo $sottotitolo ? "<h4 class='sottotitolo'>$sottotitolo</h4>" : '';
                echo $testo ? "<p class='testo'>$testo</p>" : '';
                
                if (!empty($bottone)) {
                    if (is_array($bottone) && isset($bottone['url'])) {
                        echo "<a href='" . esc_url($bottone['url']) . "' class='slide-button' target='" . esc_attr($bottone['target'] ?? '_self') . "'>" . esc_html($bottone['title'] ?? 'Scopri di più') . "</a>";
                    } elseif (is_string($bottone)) {
                        echo "<a href='" . esc_url($bottone) . "' class='slide-button' target='_self'>Scopri di più</a>";
                    }
                }
                
                echo '</div></div></div></div>';
            }
        } else {
            hp_log("Nessun dato trovato per slide_$i");
        }
    }

    if (!$slider_found) {
        hp_log("Nessuna slide valida trovata.");
        echo '<p>No slides available.</p>';
    }

    echo '</div>'; // Chiudi hero-slider
    return ob_get_clean();
}


// Registrazione dello shortcode
function hp_hero_slider_init() {
    add_shortcode('hp_hero_slider', 'hp_hero_slider');
}
add_action('init', 'hp_hero_slider_init');