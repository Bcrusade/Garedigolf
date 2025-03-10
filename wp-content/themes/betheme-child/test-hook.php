<?php
/*
Template Name: Test Hook
Version: 1.0
Description: 
*/

get_header();

/*****************************************/

// echo '<pre>';
// var_dump($img);
// echo '</pre>';


// $post_id = get_the_ID(); // Verifica se get_the_ID() restituisce l'ID corretto


// $img_1_id = get_field('img_1_carosello_hp');

// // Recupera l'ID dell'immagine dal campo ACF
// $img_1_id = get_field('img_1_carosello_hp', $post_id);

// $test_img = get_field('img_1_carosello_hp');
// var_dump($test_img);

// echo '<pre>';
// $img_1 = get_field('img_1_carosello_hp');

// if ($img_1) {
//     // Recupera l'URL dell'immagine grande
//     $img_1_url = $img_1['url'];
//     echo '<img src="' . esc_url($img_1_url) . '" alt="Carosello Immagine">';
// } else {
//     echo "Nessuna immagine trovata per il campo img_1_carosello_hp.";
// }
// echo '</pre>';


// echo '<pre>';
// // Verifica se c'è un'immagine per debug
// if ($img_1_id) {
//     // Ottieni i dettagli dell'immagine
//     $img_1_details = wp_get_attachment_image_src($img_1_id, 'full');
//     var_dump($img_1_details); // Stampa i dettagli dell'immagine (URL, larghezza, altezza)
// } else {
//     echo 'Nessuna immagine trovata per img_1_carosello_hp';
// }

// echo '</pre>';

// echo get_stylesheet_directory() . '/template-parts/carousel.php'; // Verifica il percorso

// echo '<pre>';
// $img_1 = get_field('img_1_carosello_hp', $post_id);
// var_dump($img_1);  // Vedi cosa restituisce il campo ACF
// echo '</pre>';

// $img_1_id = get_field('img_1_carosello_hp');
// echo '<pre>';
// var_dump($img_1_id); // Stampa il valore restituito dal campo ACF
// echo '</pre>';

  if ($img_1_id) {
      $img_1_details = wp_get_attachment_image_src($img_1_id, 'full');
      var_dump($img_1_details); // Questo dovrebbe restituire l'array di dettagli dell'immagine
  } else {
      echo 'Nessuna immagine trovata per img_1_carosello_hp';
  }


echo '<pre>';
if ( file_exists( get_stylesheet_directory() . '/template-parts/carousel.php' ) ) {
    get_template_part('template-parts/carousel');
} else {
    echo 'Il file carousel.php non è stato trovato nel percorso specificato.';
}
echo '</pre>';



//Show the footer of the WordPress site to keep the page in context
get_footer();