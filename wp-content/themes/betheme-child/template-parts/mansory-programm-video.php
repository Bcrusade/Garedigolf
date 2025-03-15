<?php
/**
 * Template Part: Mansory TV Programm Video
 * Description: Layout Masonry dei programmi TV con filtro per categorie di secondo livello.
 */

if (!defined('ABSPATH')) {
    exit; // Evita l'accesso diretto.
}

error_log('Inizio del template part "mansory-programm-video.php"');

// Parametri per la query dei post (Custom Post Type 'programma-televisivo')
$args = array(
    'post_type'      => 'programma-televisivo',  // Custom post type 'programma-televisivo'
    'posts_per_page' => 10,                      // Numero di post da visualizzare
    'orderby'        => 'date',                  // Ordina per data
    'order'          => 'DESC',                  // Ordine discendente
);

error_log('Eseguito setup args per la WP_Query: ' . print_r($args, true));

// Esegui la query
$posts_query = new WP_Query($args);

error_log('Eseguito WP_Query, numero di post trovati: ' . $posts_query->found_posts);

if (!$posts_query->have_posts()) {
    error_log('Nessun post trovato.');
    return '<div class="no-posts-found"><h3 class="carousel-item-title">Nessun post trovato</h3></div>';
}

// Recupera tutte le categorie di primo livello per il filtro (tassonomia 'categoria-programma')
$categories = get_terms(array(
    'taxonomy'   => 'categoria-programma',  // Tassonomia personalizzata
    'parent'     => 0,                       // Solo categorie di primo livello
    'hide_empty' => true,
));

error_log('Categorie di primo livello recuperate: ' . print_r($categories, true));

$second_level_categories = array();

foreach ($categories as $category) {
    error_log('Elaborando categoria di primo livello: ' . $category->name);
    $child_categories = get_terms(array(
        'taxonomy'   => 'categoria-programma',
        'parent'     => $category->term_id,
        'hide_empty' => true,
    ));

    error_log('Categorie di secondo livello per ' . $category->name . ': ' . print_r($child_categories, true));
    
    foreach ($child_categories as $child) {
        $second_level_categories[] = $child;
    }
}

if (empty($second_level_categories)) {
    error_log('Nessuna categoria di secondo livello trovata.');
}

?>

<!-- Filtro delle categorie di secondo livello -->
<div id="category-filter" class="filter-button-group">
    <button class="filter-button" data-filter="*">Tutti</button>
    <?php 
    error_log('Numero di categorie di secondo livello: ' . count($second_level_categories));
    foreach ($second_level_categories as $category): 
        error_log('Mostrando categoria: ' . $category->name);
    ?>
        <button class="filter-button" data-filter=".category-<?php echo esc_attr($category->slug); ?>">
            <?php echo esc_html($category->name); ?>
        </button>
    <?php endforeach; ?>
</div>

<!-- Griglia Isotope -->
<div class="grid tv-video-mansory">
    <div class="grid-sizer"></div>
    <?php if ($posts_query->have_posts()) : ?>
        <?php foreach ($posts_query->posts as $post): ?>
            <?php setup_postdata($post); ?>

            <?php
            $post_title = get_the_title($post);
            $post_link = get_permalink($post);
            $post_thumbnail = get_the_post_thumbnail_url($post->ID, 'medium');
            $post_date = get_the_date('d M Y', $post);

            error_log('Elaborando il post: ' . $post_title);

            // Recupera le categorie assegnate al post
            $post_categories = wp_get_post_terms($post->ID, 'categoria-programma');
            $category_class = '';

            if (!empty($post_categories)) {
                foreach ($post_categories as $category) {
                    if ($category->parent != 0) {
                        $category_class .= ' category-' . esc_attr($category->slug);
                    }
                }
            }

            error_log('Categorie del post ' . $post_title . ': ' . print_r($post_categories, true));
            error_log('Classe del post per il filtro: ' . $category_class);
            ?>
            <div class="grid-item<?php echo $category_class; ?>">
                <div class="tv-video-container">
                    <?php if ($post_thumbnail): ?>
                        <div class="tv-video-image-container">
                            <img src="<?php echo esc_url($post_thumbnail); ?>" alt="<?php echo esc_attr($post_title); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="tv-video-info-container">
                        <p class="tv-video-date"><?php echo esc_html($post_date); ?></p>
                        <h3 class="tv-video-title"><?php echo esc_html($post_title); ?></h3>
                        <a href="<?php echo esc_url($post_link); ?>" class="tv-video-book-button">Leggi</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>
</div>

<?php wp_reset_postdata(); ?>

<?php
error_log('Fine del template part "mansory-programm-video.php"');
?>
