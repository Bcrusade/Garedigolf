jQuery(document).ready(function ($) {
  // Inizializza Isotope con filtro che mostra tutto per default
  var $grid = $(".grid.calendario-mec").isotope({
    itemSelector: ".grid-item",
    layoutMode: "masonry",
    masonry: {
      gutter: 40, // Aggiungi lo spazio tra gli item, cambia 20 con il valore che preferisci
    },
    filter: "*", // Mostra tutto inizialmente
  });

  // Log per confermare che Isotope è stato inizializzato correttamente
  console.log("Isotope inizializzato");

  // Filtro per location
  $("#location-filter").on("click", "button", function () {
    var filterValue = $(this).attr("data-filter");

    // Log per vedere che il valore venga catturato
    console.log("Filtro applicato:", filterValue);

    // Verifica che il filtro sia valido
    if (filterValue) {
      console.log("Filtrando con:", filterValue);
      // Applica il filtro alla griglia
      $grid.isotope({ filter: filterValue });

      // Ricalcola la disposizione dopo il filtro
      $grid.isotope("layout");

      // Log per verificare che il filtro sia stato applicato
      console.log("Filtro applicato con successo");
    } else {
      console.log("Valore del filtro non valido");
    }
  });
});

// document.addEventListener("DOMContentLoaded", function () {
//   var grid = document.querySelector(".grid.calendario-mec"); // Usa la combinazione delle due classi

//   if (grid) {
//     // Inizializza Isotope con filtro che mostra tutto per default
//     var iso = new Isotope(grid, {
//       layoutMode: "masonry",
//       itemSelector: ".grid-item",
//       percentPosition: true,
//       filter: "*", // Mostra tutto inizialmente
//     });

//     console.log("Isotope inizializzato");

//     // Filtro per location
//     var locationFilter = document.getElementById("location-filter");

//     locationFilter.addEventListener("click", function (event) {
//       if (event.target.tagName.toLowerCase() === "button") {
//         var filterValue = event.target.getAttribute("data-filter");

//         console.log("Filtro applicato:", filterValue);

//         if (filterValue) {
//           iso.arrange({ filter: filterValue });
//           iso.layout();
//           console.log("Filtro applicato con successo");
//         } else {
//           console.log("Valore del filtro non valido");
//         }
//       }
//     });
//   } else {
//     console.log("Elemento .grid.calendario-mec non trovato.");
//   }
// });
