<?php
/*
Plugin Name: Calendario Gare
Version: 1.0
Description: Mansory personalizzato che mostra gli eventi del Modern Events Calendar.
Author: Stefano
*/

// Carica il CSS
function load_calendario_mec_mansory_styles() {
    wp_enqueue_style('calendario-mec-mansory', plugin_dir_url(__FILE__) . 'css/style.css');
}
add_action('wp_enqueue_scripts', 'load_calendario_mec_mansory_styles');

/**
 * Funzione che genera il layout Masonry degli eventi
 * 
 * @return string [calendario_mansory_mec] Il markup HTML per la griglia degli eventi
 */
function calendario_mansory_mec() {
    ob_start();

    // Verifica se il plugin Modern Events Calendar è attivo
    if (!class_exists('MEC')) {
        return '<div class="mec-not-active"><h3 class="carousel-item-title">Il plugin Modern Events Calendar non è attivo.</h3></div>';
    }

    // Parametri per la query degli eventi
    $args = array(
        'post_type'      => 'mec-events', // Tipo di post per gli eventi
        'posts_per_page' => 10,           // Numero di eventi da visualizzare
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_key'       => 'mec_start_date',  // La chiave per la data di inizio evento
        'meta_query'     => array(
            array(
                'key'     => 'mec_start_date',
                'value'   => date('Y-m-d'),
                'compare' => '>=',
                'type'    => 'DATE'
            )
        ),
    );
    
    // Esegui la query
    $events_query = new WP_Query($args);

    // Se non ci sono eventi, mostra un messaggio
    if (!$events_query->have_posts()) {
        return '<div class="no-events-found"><h3 class="carousel-item-title">Nessun evento trovato</h3></div>';
    }

    // Recupera gli eventi
    $events = $events_query->posts;

    // Recupera tutte le location uniche per il filtro (già presente nel codice)
    $locations = array();

    foreach ($events as $event) {
        $event_location_terms = wp_get_post_terms($event->ID, 'golf_location');
        if (!empty($event_location_terms)) {
            foreach ($event_location_terms as $term) {
                $locations[$term->slug] = $term->name; // Salviamo le location uniche
            }
        }
    }

    // Se non ci sono location, mostra un messaggio di errore
    if (empty($locations)) {
        echo '<p>No locations found.</p>';
    }

    ?>
<!-- Filtro delle location -->
<div id="location-filter" class="filter-button-group">
    <button class="filter-button" data-filter="*">Tutti</button>
    <?php foreach ($locations as $slug => $name): ?>
        <button class="filter-button" data-filter=".location-<?php echo esc_attr($slug); ?>">
            <?php echo esc_html($name); ?>
        </button>
    <?php endforeach; ?>
</div>

    <!-- Iniziamo la griglia Isotope -->
    <div class="grid calendario-mec">
        <?php foreach ($events as $event): ?>
            <?php setup_postdata($event); ?>

            <?php
            $event_title    = get_the_title($event);
            $event_link     = get_permalink($event);
            $event_thumbnail = get_the_post_thumbnail_url($event->ID, 'medium');
            $event_date_raw = get_post_meta($event->ID, 'mec_start_date', true);  // La chiave per la data di inizio evento

            // Controllo per evitare errori di variabile non definita
            $event_date = !empty($event_date_raw) ? date('d M Y', strtotime($event_date_raw)) : 'Data non disponibile';
            
            // Recupera la location dell'evento
            $event_location_terms = wp_get_post_terms($event->ID, 'golf_location');
            $event_location = !empty($event_location_terms) ? $event_location_terms[0]->name : 'Località non disponibile';

            // Aggiungi la classe per Isotope basata sulla location
            $event_location_class = !empty($event_location_terms) ? 'location-' . esc_attr($event_location_terms[0]->slug) : 'location-no-location';

            // Prezzo e link di prenotazione
            $event_price    = get_post_meta($event->ID, 'mec_cost', true);  // Chiave per il prezzo
            $booking_url_raw = get_post_meta($event->ID, 'mec_booking', true);  // Chiave per il link di prenotazione

            // Verifica se il valore di $booking_url_raw è un array e prendi il primo elemento (URL)
            $booking_url = is_array($booking_url_raw) ? reset($booking_url_raw) : $booking_url_raw;
            ?>
            <!-- Elemento della griglia con classe di filtro -->
            <div class="grid-item <?php echo $event_location_class; ?>">
                <div class="event-container">
                    <?php if ($event_thumbnail) : ?>
                        <div class="event-image-container">
                            <img src="<?php echo esc_url($event_thumbnail); ?>" alt="<?php echo esc_attr($event_title); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="event-info-container">
                        <p class="event-date"><?php echo esc_html($event_date); ?></p>
                        <div class="event-title-container">
                            <h3 class="event-title"><?php echo esc_html($event_title); ?></h3>
                            <p class="event-location"><?php echo esc_html($event_location); ?></p>
                        </div>
                        <div class="event-button-container">
                            <p class="event-price"><?php echo esc_html($event_price ? $event_price . ' €' : 'Gratis'); ?></p>
                            <a href="<?php echo esc_url($booking_url ? $booking_url : $event_link); ?>" class="event-book-button">PRENOTA</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    wp_reset_postdata();
    
    // Restituisce il contenuto HTML generato
    return ob_get_clean();
}


// Registrazione dello shortcode tramite 'init'
function calendario_mansory_mec_init() {
    add_shortcode('calendario_mansory_mec', 'calendario_mansory_mec');
}
add_action('init', 'calendario_mansory_mec_init');
?>
