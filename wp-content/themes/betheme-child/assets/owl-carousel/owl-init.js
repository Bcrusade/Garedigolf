jQuery(document).ready(function (jQuery) {
  jQuery(".home-carousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    dots: true,
    autoplay: true,
    autoplayTimeout: 3000,
    responsive: {
      0: { items: 1 },
      600: { items: 2 },
      1000: { items: 3 },
    },
  });
});

jQuery(document).ready(function (jQuery) {
  jQuery(".circuiti-carousel").owlCarousel({
    autoWidth: false,
    rtl: false,
    center: false,
    loop: true,
    margin: 40,
    stagePadding: 60,
    nav: false,
    dots: true,
    autoplay: true,
    autoplayTimeout: 5000,
    responsive: {
      0: { items: 1, margin: 30, stagePadding: 0 },
      600: { items: 2 },
      1000: { items: 2.7 },
    },
    onInitialized: function () {
      // Aggiunge la classe solo dopo che Owl ha inizializzato gli elementi
      jQuery(".owl-carousel .owl-item").addClass("custom-box");
    },
  });
});

jQuery(document).ready(function (jQuery) {
  jQuery(".gare-carousel").owlCarousel({
    margin: 70,
    nav: true,
    center: false,
    dots: false,
    autoplay: false,
    autoplayTimeout: 5000,
    navText: [
      "<span style='padding: 15px 30px 15px 30px; margin-right:10px' class='button the-icon slider_prev slick-arrow' aria-label='previous slide'><i class='icon-left-open-big'></i></span>",
      "<span style='padding: 15px 30px 15px 30px;' class='button the-icon slider_next slick-arrow' aria-label='next slide'><i class='icon-right-open-big'></i></span>",
    ],
    responsive: {
      0: { items: 1, center: false },
      600: { items: 2, center: false },
      1000: { items: 2.8, center: true },
    },
    onInitialized: function () {
      // Aggiunge la classe solo dopo che Owl ha inizializzato gli elementi
      jQuery(".owl-carousel .owl-item").addClass("custom-box");
    },
  });
});

jQuery(document).ready(function (jQuery) {
  jQuery(".home-carousel-2").owlCarousel({
    margin: 10, // Margine 10
    items: 2, // Mostra 1 immagine alla volta
    loop: true, // Loop infinito
    autoplay: true, // Autoplay attivato
    autoplayTimeout: 3000, // Ogni 3 secondi
    autoplayHoverPause: true, // Pausa se il mouse è sopra
    nav: true, // Mostra i controlli di navigazione
    dots: true, // Mostra i puntini di navigazione
    autoHeight: true,
    responsive: {
      0: { items: 1 },
      600: { items: 2 },
      1000: { items: 2 },
    },
  });

  // Impostare una larghezza e altezza massima delle immagini dopo che Owl è stato inizializzato
  jQuery(".owl-carousel .item img").each(function () {
    jQuery(this).css({
      "max-width": "100%", // Adatta alla larghezza del contenitore
      "max-height": "600px", // Imposta un'altezza massima
      "object-fit": "cover", // Rende l'immagine coprente senza deformarla
      "object-position": "top center", // Posizione centrata in alto
    });
  });
});
