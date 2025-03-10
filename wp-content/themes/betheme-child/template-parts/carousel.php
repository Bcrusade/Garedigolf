<?php 
ob_start(); // Inizia l'output buffering

// Recupera l'ID della pagina attuale
$post_id = get_the_ID(); // Usa get_the_ID() per ottenere l'ID della pagina corrente

// Recupera gli ID delle immagini dai campi ACF
$img_1 = get_field('img_1_carosello_hp', $post_id);
$img_2 = get_field('img_2_carosello_hp', $post_id);
$img_3 = get_field('img_3_carosello_hp', $post_id);
$img_4 = get_field('img_4_carosello_hp', $post_id);
$img_5 = get_field('img_5_carosello_hp', $post_id);
$img_6 = get_field('img_6_carosello_hp', $post_id);

// // Aggiungi un'istruzione di debug per vedere i valori restituiti da ACF
// echo '<pre>';
// var_dump($img_1, $img_2, $img_3, $img_4, $img_5, $img_6);
// echo '</pre>';

// Se ci sono ID delle immagini, recuperiamo i dettagli
$images = [];
foreach ([$img_1, $img_2, $img_3, $img_4, $img_5, $img_6] as $img) {
    if ($img) {
        // Usa l'array per ottenere i dettagli dell'immagine
        $images[] = [
            'url' => $img['url'], // URL dell'immagine
            'alt' => $img['alt'], // Testo alternativo dell'immagine
        ];
    }
}

// Verifica che ci siano immagini
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

echo 'Carosello caricato correttamente'; // Debug per verificare che il file venga incluso
// ob_start();

// return ob_get_clean(); // Restituisce il contenuto bufferizzato

?>
