<?php
/*
Plugin Name: Mansory Programmi tv
Version: 1.0
Description: Mansory dei programmi tv filtrato per categorie di primo livello.
Author: Stefano
*/

// Carica il CSS
function load_tv_programm_mansory_styles() {
    error_log('Funzione load_tv_programm_mansory_styles chiamata');
    if (is_page('test-hero-slider')) {
        wp_enqueue_style('tv-programm-mansory', plugin_dir_url(__FILE__) . 'css/style.css');
    }
}
add_action('wp_enqueue_scripts', 'load_tv_programm_mansory_styles');

/**
 * Funzione che genera il layout Masonry dei programmi TV.
 * 
 * @return string [tv_programm_mansory] Il markup HTML per la griglia dei programmi TV
 */
function tv_programm_mansory() {
    ob_start();
    
    error_log('Inizio della funzione tv_programm_mansory');
    
    // Parametri per la query dei post (Custom Post Type 'programma-televisivo')
    $args = array(
        'post_type'      => 'programma-televisivo',
        'posts_per_page' => 10,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    $posts_query = new WP_Query($args);
    
    if (!$posts_query->have_posts()) {
        error_log('Nessun post trovato.');
        return '<div class="no-posts-found"><h3 class="carousel-item-title">Nessun post trovato</h3></div>';
    }

    // Recupera solo le categorie di primo livello della tassonomia 'categoria-programma'
    $categories = get_terms(array(
        'taxonomy'   => 'categoria-programma',
        'parent'     => 0,  // Solo categorie di primo livello
        'hide_empty' => true,
    ));
    
    error_log('Categorie di primo livello recuperate: ' . print_r($categories, true));
    ?>

<!-- Filtro delle categorie di primo livello -->
<div id="category-filter" class="filter-button-group">
    <button class="filter-button" data-filter="*">Tutti</button>
    <?php foreach ($categories as $category): ?>
    <button class="filter-button" data-filter=".category-<?php echo esc_attr($category->slug); ?>">
        <?php echo esc_html($category->name); ?>
    </button>
    <?php endforeach; ?>
</div>

<!-- Iniziamo la griglia Isotope -->
<div class="grid tv-programm-mansory">
    <div class="grid-sizer"></div>
    <?php foreach ($posts_query->posts as $post): ?>
    <?php setup_postdata($post); ?>
    <?php
                error_log('Elaborando il post: ' . get_the_title($post));
                $post_title = get_the_title($post);
                $post_link = get_permalink($post);
                $post_thumbnail = get_the_post_thumbnail_url($post->ID, 'medium');
                $post_date = get_the_date('d M Y', $post);

                // Recupera le categorie assegnate al post
                $post_categories = wp_get_post_terms($post->ID, 'categoria-programma');

                // Associa ogni post alla sua categoria di primo livello
                $category_class = '';
                if (!empty($post_categories)) {
                    foreach ($post_categories as $category) {
                        // Trova la categoria di primo livello
                        $top_category = $category;
                        while ($top_category->parent != 0) {
                            $top_category = get_term($top_category->parent, 'categoria-programma');
                        }
                        // Aggiunge la classe della categoria di primo livello
                        $category_class .= ' category-' . esc_attr($top_category->slug);
                    }
                }
                error_log('Classe del post per il filtro: ' . $category_class);
            ?>

    <div class="grid-item<?php echo $category_class; ?>">
        <div class="tv-programm-container">
            <?php if ($post_thumbnail): ?>
            <div class="tv-programm-image-container">
                <img src="<?php echo esc_url($post_thumbnail); ?>" alt="<?php echo esc_attr($post_title); ?>">
            </div>
            <?php endif; ?>
            <div class="tv-programm-info-container">
                <p class="tv-programm-date"><?php echo esc_html($post_date); ?></p>
                <div class="tv-programm-title-container">
                    <h3 class="tv-programm-title"><?php echo esc_html($post_title); ?></h3>
                </div>
                <div class="tv-programm-button-container">
                    <a href="<?php echo esc_url($post_link); ?>" class="tv-programm-book-button">Leggi</a>
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

function tv_programm_mansory_init() {
    add_shortcode('tv_programm_mansory', 'tv_programm_mansory');
}
add_action('init', 'tv_programm_mansory_init');
?>