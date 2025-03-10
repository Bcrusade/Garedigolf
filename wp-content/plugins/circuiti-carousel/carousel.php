<?php

/*
Plugin Name:  Circuiti Carousel
Version: 1.0
Description: Carousel that returns all Circuiti events.
Author: Stefano
*/

/**
 * [circuiti_carousel] Shortcode that returns all MEC events.
 * @return string Circuiti in an Owl Carousel
 */

 // Carica il CSS
function load_custom_plugin_styles() {
    wp_enqueue_style('circuiti-carousel-style', plugin_dir_url(__FILE__) . 'css/style.css');
}
add_action('wp_enqueue_scripts', 'load_custom_plugin_styles');

function carousel_circuiti() {
    ob_start(); // Inizia l'output buffering
    ?>
    <div class="owl-carousel circuiti-carousel">
        <?php
        $args = array(
            'post_type'      => 'post', // Se gli eventi MEC hanno un altro post_type, cambialo qui
            'posts_per_page' => '10', // Numero di articoli da mostrare
            'order'          => 'DESC',
            'orderby'        => 'date',
        );
        $query = new WP_Query($args);

        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="item">
                
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="carousel-image-container">
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="carousel-item-container">
                        <h6 class="title">CIRCUITO</h6>
                        <h3 class="carousel-item-title"><?php echo esc_html(get_the_title()); ?></h3>
                        <div class="carousel-item-icon">
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                            <img decoding="async" src="wp-content/uploads/2023/06/ski3-iconarrow.svg" alt="" loading="lazy">
                            </a>
                        </div>
                    </div>

            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>
    <?php
    return ob_get_clean(); // Ritorna l'output
}

add_shortcode('circuiti_carousel', 'carousel_circuiti');
