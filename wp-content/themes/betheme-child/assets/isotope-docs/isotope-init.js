jQuery.noConflict(); // Aggiungi questa riga per risolvere i conflitti con $.

jQuery(document).ready(function ($) {
  // Inizializza Isotope per la griglia .grid.calendario-mec
  var $gridCalendario = $(".grid.calendario-mec").isotope({
    itemSelector: ".grid-item",
    layoutMode: "masonry",
    masonry: {
      gutter: 40, // Spazio tra gli item, cambia questo valore a seconda delle tue necessità
    },
    filter: "*", // Mostra tutto inizialmente
  });

  // Log per confermare che Isotope è stato inizializzato correttamente per calendario
  console.log("Isotope inizializzato per .grid.calendario-mec");

  // Filtro per location (calendario)
  $("#location-filter").on("click", "button", function () {
    var filterValue = $(this).attr("data-filter");

    // Log per vedere che il valore venga catturato
    console.log("Filtro location applicato:", filterValue);

    // Verifica che il filtro sia valido
    if (filterValue) {
      console.log("Filtrando con:", filterValue);
      // Applica il filtro alla griglia
      $gridCalendario.isotope({ filter: filterValue });

      // Ricalcola la disposizione dopo il filtro
      $gridCalendario.isotope("layout");

      // Log per verificare che il filtro sia stato applicato
      console.log("Filtro location applicato con successo");
    } else {
      console.log("Valore del filtro location non valido");
    }
  });

  // Inizializza Isotope per la griglia .grid.tv-programm-mansory
  var $gridTV1 = $(".grid.tv-programm-mansory").isotope({
    itemSelector: ".grid-item",
    percentPosition: true,
    masonry: {
      columnWidth: ".grid-sizer",
      gutter: 20,
    },
    filter: "*", // Mostra tutto inizialmente
  });

  // Log per confermare che Isotope è stato inizializzato correttamente per programmi TV
  console.log("Isotope inizializzato per .grid.tv-programm-mansory");

  // Filtro per categorie di secondo livello (programmi TV)
  $("#category-filter").on("click", ".filter-button", function () {
    var filterValue = $(this).attr("data-filter");

    // Log per vedere che il valore venga catturato
    console.log("Filtro categoria applicato:", filterValue);

    // Verifica che il filtro sia valido
    if (filterValue) {
      console.log("Filtrando con:", filterValue);
      // Applica il filtro alla griglia
      $gridTV1.isotope({ filter: filterValue });

      // Ricalcola la disposizione dopo il filtro
      $gridTV1.isotope("layout");

      // Log per verificare che il filtro sia stato applicato
      console.log("Filtro categoria applicato con successo");
    } else {
      console.log("Valore del filtro categoria non valido");
    }
  });

  // Inizializza Isotope per la griglia .grid.tv-video-mansory
  var $gridTV2 = $(".grid.tv-video-mansory").isotope({
    itemSelector: ".grid-item",
    percentPosition: true,
    masonry: {
      columnWidth: ".grid-sizer",
      gutter: 15,
    },
    filter: "*", // Mostra tutto inizialmente
  });

  // Log per confermare che Isotope è stato inizializzato correttamente per video
  console.log("Isotope inizializzato per .grid.tv-video-mansory");

  // Filtro per categorie di secondo livello (video)
  $("#category-filter").on("click", ".filter-button", function () {
    var filterValue = $(this).attr("data-filter");

    // Log per vedere che il valore venga catturato
    console.log("Filtro categoria applicato:", filterValue);

    // Verifica che il filtro sia valido
    if (filterValue) {
      console.log("Filtrando con:", filterValue);
      // Applica il filtro alla griglia
      $gridTV2.isotope({ filter: filterValue });

      // Ricalcola la disposizione dopo il filtro
      $gridTV2.isotope("layout");

      // Log per verificare che il filtro sia stato applicato
      console.log("Filtro categoria applicato con successo");
    } else {
      console.log("Valore del filtro categoria non valido");
    }
  });
});
