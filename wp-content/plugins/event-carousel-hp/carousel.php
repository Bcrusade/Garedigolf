<?php

/*
Plugin Name:  MEC Carousel
Version: 1.0
Description: Carousel that return all MEC events.
Author: Stefano
*/

/**
 * [gare_carousel] return all milestones in SWAG.
 * @return string All MEC events
 */


function carousel_MEC() {
    ob_start(); // Inizia l'output buffering

    // Recupera l'ID della pagina attuale
    global $post;
    $post_id = isset($post) ? $post->ID : 0;

    // Recupera l'immagine dal campo ACF
    $img = get_field('img_1_carosello_hp', $post_id);

    // Verifica se c'è un'immagine
    if ($img): ?>
        <div class="owl-carousel home-carousel">
            <div class="item">
                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
            </div>
        </div>
    <?php else: ?>
        <p>Nessuna immagine trovata</p>
    <?php endif;


    return ob_get_clean();
}

add_shortcode('gare_carousel', 'carousel_MEC');


/** Always end your PHP files with this closing tag */


function gare_carousel_init_2() {
    // Aggiungi il shortcode per il carosello
    function carousel_MEC_2() {
        ob_start(); // Inizia l'output buffering

        // Recupera l'ID della pagina attuale
        global $post;
        $post_id = isset($post) ? $post->ID : 0;

        // Recupera le immagini dai campi ACF
        $img_1 = get_field('img_1_carosello_hp', $post_id);
        $img_2 = get_field('img_2_carosello_hp', $post_id);
        $img_3 = get_field('img_3_carosello_hp', $post_id);
        $img_4 = get_field('img_4_carosello_hp', $post_id);
        $img_5 = get_field('img_5_carosello_hp', $post_id);
        $img_6 = get_field('img_6_carosello_hp', $post_id);

        // Verifica se ci sono immagini
        $images = array_filter([$img_1, $img_2, $img_3, $img_4, $img_5, $img_6]);

        if (!empty($images)): ?>
            <div class="owl-carousel home-carousel-2">
                <?php foreach ($images as $img): ?>
                    <div class="item">
                        <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Nessuna immagine trovata</p>
        <?php endif;

        return ob_get_clean();
    }

    add_shortcode('gare_carousel_2', 'carousel_MEC_2');
}

// Esegui la funzione `gare_carousel_init` quando WordPress è completamente inizializzato
add_action('init', 'gare_carousel_init_2');





// $test = get_field('carousel_hp', get_the_ID());
// var_dump($test);

// echo "<br><br>";

// $test2 = get_field('immagine_personalizzata_carosello_hp', 102); 
// var_dump($test2);

// echo "<br><br>";

// $test3 = get_field('immagine_personalizzata_carosello_hp', 'option'); 
// var_dump($test3);

// echo "<br><br><br>";

// global $post;
// $post_id = isset($post) ? $post->ID : 0;

// $test4 = get_field('immagine_personalizzata_carosello_hp', $post_id);
// var_dump($test4);
