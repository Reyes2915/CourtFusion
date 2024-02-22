async function cargarProvincia() {
  //Obtener el valor de la comunidad seleccionada
  var comunidadSelect = document.getElementById("comunidades");
  var comunidadOption = comunidadSelect.options[comunidadSelect.selectedIndex];
  var comunidad = comunidadOption.id;

  console.log(comunidad);

  /* var resultado = document.getElementById('resultado'); */
  /* resultado.innerHTML = ""; */
  // URL de la API de municipios de España
  var apiUrl =
    "https://apiv1.geoapi.es/provincias?type=JSON&key=78f86e16edd8bc80c4708112811783501edebf3a6428aa9055a783fa96541d1a&CCOM=" +
    comunidad;
  var arrayComunidades = document.getElementById("provincias");
  //Le quitamos la propiedad disabled para que se pueda seleccionar
  provincias.disabled = false;
  if (provincias.textContent != "Selecciona una provincia") {
    provincias.innerHTML = "";
    provincias.innerHTML = "<option>Selecciona una provincia</option>";
  }
  // Realizar una solicitud GET a la API
  fetch(apiUrl)
    .then((response) => response.json())
    .then((data) => {
      data.data.forEach(function (provincia) {
        var option = document.createElement("option");
        option.value = provincia.PRO;
        option.textContent = provincia.PRO;
        //Crear el id al option para poder obtenerlo en la función cargarMunicipios
        option.id = provincia.CPRO;
        //Pasar el CPRO sin ser el valor ni el texto
        provincias.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error al obtener las provincias:", error);
    });
}
async function cargarMunicipios() {
  //Obtener el valor de la provincia seleccionada
  var provinciaSelect = document.getElementById("provincias");
  var provinciasOption = provinciaSelect.options[provinciaSelect.selectedIndex];
  var provincia = provinciasOption.id;
  /* var resultado = document.getElementById('resultado'); */
  /* resultado.innerHTML = ""; */
  // URL de la API de municipios de España
  var apiUrl =
    "https://apiv1.geoapi.es/municipios?type=JSON&key=78f86e16edd8bc80c4708112811783501edebf3a6428aa9055a783fa96541d1a&CPRO=" +
    provincia;
  var municipios = document.getElementById("municipios");
  //Le quitamos la propiedad disabled para que se pueda seleccionar
  municipios.disabled = false;
  //Hacer que el select de municipios esté vacío solo si no es la primera vez que se selecciona una provincia
  if (municipios.textContent != "Selecciona un municipio") {
    municipios.innerHTML = "";
    municipios.innerHTML = '<option value="0">Selecciona un municipio</option>';
  }
  // Realizar una solicitud GET a la API
  fetch(apiUrl)
    .then((response) => response.json())
    .then((data) => {
      data.data.forEach(function (municipio) {
        var option = document.createElement("option");
        option.value = municipio.DMUN50;
        option.textContent = municipio.DMUN50;
        municipios.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error al obtener los municipios:", error);
    });
}
document.addEventListener("DOMContentLoaded", function () {
  var searchInput = document.getElementById("search");
  var columns = document.querySelectorAll(".columna-buscar"); // Selecciona los contenedores de columnas
  var alertElement = document.querySelector(".alertfavoritos");
  var alertContainer = document.getElementById("alert-container");
  var modal = document.getElementById("authModal");
  console.log(alertElement);
  if (alertElement && alertContainer) {
    alertContainer.appendChild(alertElement);
    alertElement.style.opacity = 1;

    setTimeout(function () {
      alertElement.style.transition = "opacity 2s ease-in-out";
      alertElement.style.opacity = 0;

      // Agregar un evento de escucha para eliminar el elemento después del fade
      alertElement.addEventListener("transitionend", function () {
        alertElement.remove();
      });
    }, 2000); // 2 segundos de duración para el efecto fade
  }
  if (modal) {
    $("#authModal").modal("show");
    setTimeout(function () {
      window.location.href = "perfil.php"; // Redirigir a la página de inicio de sesión
    }, 5000); // 5 segundos
  }

  searchInput.addEventListener("input", function () {
    var searchValue = searchInput.value.toLowerCase();

    columns.forEach(function (column) {
      var cardTitle = column
        .querySelector(".card-title")
        .textContent.toLowerCase();

      if (searchValue === "" || cardTitle.includes(searchValue)) {
        column.style.display = "block";
        column.classList.add("text-center"); // Agregar la clase text-center al elemento coincidente
        column.classList.add("col-md-4"); // Agregar la clase de Bootstrap para centrar la columna
      } else {
        column.style.display = "none";
        column.classList.remove("text-center"); // Remover la clase text-center de los elementos que no coinciden
        column.classList.remove("col-md-4"); // Remover la clase de Bootstrap cuando no coincide
      }
    });
  });
});
$(document).ready(function () {
  // Obtiene los valores de deporte y municipio de la URL
  // Función para ofuscar un valor
function ofuscarValor(valor) {
  // Lógica de ofuscación (puedes personalizar esto)
  return btoa(valor); // Codifica el valor en Base64
}

// Función para desofuscar un valor
function desofuscarValor(valorOfuscado) {
  // Lógica de desofuscación (debes invertir la operación de ofuscación)
  return atob(valorOfuscado); // Decodifica el valor de Base64
}

// Obtiene los valores de la URL (desofusca si es necesario)
var selectedSportFromURL = new URLSearchParams(window.location.search).get("deporte");
var selectedMunicipioFromURL = new URLSearchParams(window.location.search).get("municipio");
var selectedHoraFromURL = new URLSearchParams(window.location.search).get("horadeseada");
var selectedProvinciaFromURL = new URLSearchParams(window.location.search).get("provincia");

// Función para verificar si un valor está ofuscado
function estaOfuscado(valor) {
  // Verifica si el valor es una cadena de Base64 válida
  function esBase64(str) {
    try {
      return btoa(atob(str)) === str;
    } catch (error) {
      return false;
    }
  }

  // Verifica si el valor está ofuscado
  return esBase64(valor);
}

// Selecciona el deporte y el municipio en los desplegables
if (selectedSportFromURL) {

  
  // Verifica si el valor está ofuscado antes de desofuscar
  if (estaOfuscado(selectedSportFromURL)) {
    console.log("Está ofuscado");
    console.log(desofuscarValor(selectedSportFromURL));
    $("#sport-filter").val(desofuscarValor(selectedSportFromURL));
  } else {
    console.log("No está ofuscado");
    console.log(selectedSportFromURL);
    if(selectedSportFromURL == 'Baloncesto'){
      $("#sport-filter").val('baloncesto');
    }else if(selectedSportFromURL == 'Fútbol'){
      $("#sport-filter").val('futbol');
    }else if(selectedSportFromURL == 'Tenis'){
      $("#sport-filter").val('tenis');
    }else if(selectedSportFromURL == 'Pádel'){
      $("#sport-filter").val('padel');
    }
  }
}
if (selectedMunicipioFromURL) {
  $("#municipios").prop("disabled", false);
  $("#municipios").val(desofuscarValor(selectedMunicipioFromURL));
}
if (selectedHoraFromURL) {
  $("#horadeseada").val(desofuscarValor(selectedHoraFromURL));
}

// Maneja el evento de cambio en el desplegable para ofuscar el valor
$("#sport-filter").change(function () {
  var selectedSport = $(this).val(); // Obtiene el deporte seleccionado
  var url = new URL(window.location.href);
  if (url.search) {
    url.searchParams.set("deporte", ofuscarValor(selectedSport));
    window.location.href = url;
  } else {
    url.searchParams.append("deporte", ofuscarValor(selectedSport));
    window.location.href = url;
  }
});

$("#municipios").change(function () {
  var selectedMunicipio = $(this).val(); // Obtiene el municipio seleccionado
  var selectedProvincia = $('#provincias').val();
  console.log(selectedProvincia);
  var url = new URL(window.location.href);
  if (url.search) {
    url.searchParams.set("municipios", selectedMunicipio);
     url.searchParams.set("provincias", selectedProvincia);
    window.location.href = url;
  } else {
    url.searchParams.append("municipios", selectedMunicipio);
    url.searchParams.append("provincias",selectedProvincia);
    window.location.href = url;
  }
});

$("#horadeseada").change(function () {
  // Añade la hora de apertura a la URL actual
  var horaApertura = $(this).val();
  var url = new URL(window.location.href);
  if (url.search) {
    url.searchParams.set("horadeseada", ofuscarValor(horaApertura));
    window.location.href = url;
  } else {
    url.searchParams.append("horadeseada", ofuscarValor(horaApertura));
    window.location.href = url;
  }
});


  document.addEventListener("DOMContentLoaded", () => {
    cargarProvincia();
  });
  document
    .getElementById("provincias")
    .addEventListener("change", cargarMunicipios);
});
