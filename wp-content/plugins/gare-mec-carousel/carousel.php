<?php
/*
Plugin Name:  Eventi Gare Carousel
Version: 1.0
Description: Carosello personalizzato che mostra gli eventi del Modern Events Calendar.
Author: Stefano
*/

// Carica il CSS
function load_gare_mec_carousel_styles() {
    wp_enqueue_style('gare-carousel-style', plugin_dir_url(__FILE__) . 'css/style.css');
}
add_action('wp_enqueue_scripts', 'load_gare_mec_carousel_styles');

function gare_carousel_mec() {
    ob_start();

    if (!class_exists('MEC')) {
        return '<div class="mec-not-active"><h3 class="carousel-item-title">Il plugin Modern Events Calendar non è attivo.</h3></div>';
    }

    $args = array(
        'post_type'      => 'mec-events', // <-- CORRETTO!
        'posts_per_page' => 10,
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_key'       => 'mec_start_date',  // <-- La chiave è corretta
        'meta_query'     => array(
            array(
                'key'     => 'mec_start_date',  // <-- La chiave è corretta
                'value'   => date('Y-m-d'),
                'compare' => '>=',
                'type'    => 'DATE'
            )
        ),
    );
    
    // Esegui la query
    $events_query = new WP_Query($args);
    error_log('SQL Query: ' . $events_query->request);
    error_log('Totale eventi trovati: ' . $events_query->found_posts);

    if (!$events_query->have_posts()) {
        error_log('Nessun evento trovato nella query.');
        return '<div class="no-events-found"><h3 class="carousel-item-title">Nessun evento trovato</h3></div>';
    }

    // Recupera gli eventi
    $events = $events_query->posts;
    ?>
    
    <div class="owl-carousel gare-carousel">
        <?php foreach ($events as $event): ?>
            <?php setup_postdata($event); ?>

            <?php
            $event_title    = get_the_title($event);
            $event_link     = get_permalink($event);
            $event_thumbnail = get_the_post_thumbnail_url($event->ID, 'medium');
            $event_date_raw = get_post_meta($event->ID, 'mec_start_date', true);  // La chiave è corretta
            error_log("Evento ID {$event->ID} - Data grezza: " . print_r($event_date_raw, true));

            // Controllo per evitare errori di variabile non definita
            $event_date = !empty($event_date_raw) ? date('d M Y', strtotime($event_date_raw)) : 'Data non disponibile';
            
            // Log della data formattata
            error_log("Evento ID {$event->ID} - Data di inizio: " . $event_date);

            // Recupera i termini della tassonomia golf_location
            $event_location_terms = wp_get_post_terms($event->ID, 'golf_location');
            
            // Se ci sono termini associati, prendi il nome del primo termine
            if (!empty($event_location_terms) && !is_wp_error($event_location_terms)) {
                $event_location = $event_location_terms[0]->name;
            } else {
                $event_location = 'Località non disponibile';
            }

            // Prezzo e link di prenotazione
            $event_price    = get_post_meta($event->ID, 'mec_cost', true);  // Chiave per il prezzo
            $booking_url_raw = get_post_meta($event->ID, 'mec_booking', true);  // Chiave per il link di prenotazione

            // Verifica se il valore di $booking_url_raw è un array e prendi il primo elemento (URL)
            $booking_url = is_array($booking_url_raw) ? reset($booking_url_raw) : $booking_url_raw;
            ?>
            <div class="item">
                <div class="event-container">
                    <?php if ($event_thumbnail) : ?>
                        <div class="carousel-image-container">
                            <img src="<?php echo esc_url($event_thumbnail); ?>" alt="<?php echo esc_attr($event_title); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="carousel-item-container">
                        <p class="carousel-item-date"><?php echo esc_html($event_date); ?></p>
                        <div class="carousel-title-container">
                            <h3 class="carousel-item-title"><?php echo esc_html($event_title); ?></h3>
                            <p class="carousel-item-location"><?php echo esc_html($event_location); ?></p>
                        </div>
                        <div class="carousel-button-container">
                            <p class="carousel-item-price"><?php echo esc_html($event_price ? $event_price . ' €' : 'Gratis'); ?></p>
                            <div class="carousel-book-button-container">
                                <a href="<?php echo esc_url($booking_url ? $booking_url : $event_link); ?>" class="carousel-book-button">PRENOTA <i style='margin-left: 8px;' class='icon-right-open'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

// Registrazione dello shortcode tramite 'init'
function gare_carousel_mec_init() {
    add_shortcode('gare_carousel_mec', 'gare_carousel_mec');
}
add_action('init', 'gare_carousel_mec_init');
?>
