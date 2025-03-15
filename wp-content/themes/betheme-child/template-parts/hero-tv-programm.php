<?php
/**
 * Template Part: Hero TV Programm
 * Description: Hero con campi dinamici generati con ACF.
 */

if (!defined('ABSPATH')) {
    exit; // Previene l'accesso diretto
}

global $post;
$post_id = $post ? $post->ID : 0;
$slider_found = false;

echo '<div class="hero-slider-tv-programm owl-carousel">';

for ($i = 1; $i <= 5; $i++) {
    $slide = get_field("slide_$i", $post_id);

    if ($slide) {
        $media_url = esc_url($slide['background_video_'.$i] ?? '');
        $categoria = esc_html($slide['categoria_slide_'.$i] ?? '');
        $titolo = esc_html($slide['titolo_slide_'.$i] ?? '');
        $sottotitolo = esc_html($slide['sottotitolo_slide_'.$i] ?? '');
        $testo = wp_kses_post($slide['testo_slide_'.$i] ?? '');
        $bottone = $slide['bottone_slide_'.$i] ?? null;
        //var_dump($bottone);

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
            echo '<div class="slide">';
            
            if (preg_match('/\.mp4$/i', $media_url)) {
                echo "<video autoplay loop muted playsinline class='slide-bg-video'>
                        <source src='$media_url' type='video/mp4'>
                      </video>";
            } else {
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
    }
}

echo $slider_found ? '' : '<p>No slides available.</p>';
echo '</div>'; // Chiudi hero-slider
