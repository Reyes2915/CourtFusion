async function cargarComunidad() {
  // URL de la API de municipios de España
  var apiUrl =
    "https://apiv1.geoapi.es/comunidades?type=JSON&key=78f86e16edd8bc80c4708112811783501edebf3a6428aa9055a783fa96541d1a";

  // Selecciona el elemento <select> con ID "municipios"
  var comunidades = document.getElementById("comunidades");
  /* var resultado = document.getElementById('resultado'); */
  /* resultado.innerHTML = ""; */
  // Realizar una solicitud GET a la API
  fetch(apiUrl)
    .then((response) => response.json())
    .then((data) => {
      data.data.forEach(function (comunidad) {
        var option = document.createElement("option");
        option.value = comunidad.COM;
        option.innerHTML = comunidad.COM;
        option.id = comunidad.CCOM;
        comunidades.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error al obtener los municipios:", error);
    });
}
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
async function peticionCoordenadas(fecha) {
  const municipioSelect = document.getElementById("municipios");
  const municipioIndex = municipioSelect.selectedIndex;
  const municipioName = municipioSelect.options[municipioIndex].text;
  const apiUrl =
    "https://dev.virtualearth.net/REST/v1/Locations?q=" +
    municipioName +
    "&key=MiGtaezrn550Y2zxAanE~fgg0btSeHQ1509aqAVqXlA~Av367PS242wIqVFPQxMOWDApwz4_wZ9pY_JVD5RuXFvB_DPipIU34DQuwQe6C-yT&output=json";

  try {
    const response = await fetch(apiUrl);
    const data = await response.json();
    if (
      data.resourceSets.length > 0 &&
      data.resourceSets[0].resources.length > 0
    ) {
      const coordinates = data.resourceSets[0].resources[0].point.coordinates;
      const latitud = coordinates[0];
      const longitud = coordinates[1];
      return { latitud, longitud };
    } else {
      console.error(
        "No se encontraron coordenadas para el lugar especificado."
      );
      return { latitud: 0, longitud: 0 };
    }
  } catch (error) {
    console.error("Error al obtener coordenadas:", error);
    return { latitud: 0, longitud: 0 };
  }
}

async function peticionTiempo(latitud, longitud, fecha) {
  let apiUrl = "";
  try {
    //Obtener la fecha en formato timestamp
    let fechaTimestamp = new Date(fecha).getTime() / 1000;
    //Si la fecha es anterior a hoy y menor a 6 dias
    if (
      fechaTimestamp < new Date().getTime() / 1000 &&
      fechaTimestamp > new Date().getTime() / 1000 - 5 * 24 * 60 * 60
    ) {
      apiUrl =
        "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=" +
        latitud +
        "&lon=" +
        longitud +
        "&dt=" +
        fechaTimestamp +
        "&units=metric&lang=es&appid=b94f9f198880e633033f0cbd587d9b3d";
    } else {
      apiUrl =
        "https://api.openweathermap.org/data/2.5/onecall?lat=" +
        latitud +
        "&lon=" +
        longitud +
        "&units=metric&dt=" +
        fechaTimestamp +
        "&lang=es&appid=b94f9f198880e633033f0cbd587d9b3d";
      let response = await fetch(apiUrl);
      let data = await response.json();
      if (data.current) {
        let tiempo = data.current.weather[0].description;
        let max = data.daily[0].temp.max;
        let min = data.daily[0].temp.min;
        let icono = data.current.weather[0].icon;
        let iconUrl =
          "https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/" +
          icono +
          ".png";
        let minTemp = min + "°C";
        let maxTemp = max + "°C";
        return { iconUrl, minTemp, maxTemp };
      } else {
        console.error(
          "No se encontraron datos meteorológicos para la fecha especificada."
        );
        return { iconUrl: "", minTemp: "", maxTemp: "" };
      }
    }
  } catch (error) {
    console.error("Error al obtener datos meteorológicos:", error);
    return { iconUrl: "", minTemp: "", maxTemp: "" };
  }
}

async function personalizarCalendario() {
  const calendarEl = document.getElementById("calendario");
  console.log(calendarEl)
  const calendar = new FullCalendar.Calendar(calendarEl, {
    // ... (configuración del calendario)
    initialView: "dayGridMonth",
    locale: "es",
    dayMaxEventRows: true,
    dayMaxEvents: 3,
    dayPopoverFormat: {
      year: "numeric",
      month: "long",
      day: "numeric",
    },
    eventTimeFormat: {
      hour: "numeric",
      minute: "2-digit",
      meridiem: "short",
    },
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    allDayText: "Horas",
    buttonText: {
      today: "Hoy",
      month: "Mes",
      week: "Semana",
      day: "Día",
    },
    dayCellContent: async function () {
      // Obtén la fecha actual
      const today = new Date();
      const currentYear = today.getFullYear();
      const currentMonth = today.getMonth(); // Los meses en JavaScript son 0-indexados
      const currentDay = today.getDate();
    
      // Calcula la fecha límite, que es el último día del mes actual
      const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
    
      // Determina si la fecha actual se encuentra dentro del rango deseado
      if (today >= new Date(currentYear, currentMonth, currentDay - 5) && today <= lastDayOfMonth) {
        let fecha = today.toISOString().split('T')[0];
        console.log(fecha);
        const { latitud, longitud } = await peticionCoordenadas(fecha);
        console.log(latitud);
    
        // Solo realiza la petición de tiempo si la fecha es uno de los 5 días anteriores o igual al día actual
        if (today <= new Date(currentYear, currentMonth, currentDay - 5)) {
          let weatherData = await peticionTiempo(latitud, longitud, fecha);
    
          if (weatherData && weatherData.iconUrl) {
            let { iconUrl, minTemp, maxTemp } = weatherData;
    
            let customContent = document.createElement('div');
            customContent.className = 'custom-content';
            customContent.innerHTML = `
            <div class="row">
            <div class="col-12 text-center">
              <p class="day-of-month">${currentDay}</p>
            </div>
            </div>
            <div class="row">
            <div class="col-4 text-end">
              ${iconUrl ? `<img class="weather-icon" src="${iconUrl}" alt="Weather Icon" style="max-width: 50px;" />` : 'Icon not available'}
            </div>
            <div class="col-8 text-start">
              <p class="temperature">
                <span class="min-temp" style="color: blue;">${minTemp}</span> /
                <span class="max-temp" style="color: red;">${maxTemp}</span>
              </p>
            </div>
            </div>
            `;
    
            return { domNodes: [customContent] };
          }
        } else {
          // Manejar el caso en el que no hay datos de tiempo o la fecha no está dentro del rango deseado
          console.log('No se pudieron obtener los datos del tiempo o la fecha no está en el rango deseado.');
        }
      }else{
        console.log('No se pudieron obtener los datos del tiempo o la fecha no está en el rango deseado.');
      }
    
      // Devolver un arreglo vacío para no mostrar contenido en la celda si no cumple con las condiciones anteriores
      return { domNodes: [] };
    }
    
  });
}
//funcion para el autocomplete
// Llama a la función para cargar los municipios cuando se cargue la págin

document.addEventListener("DOMContentLoaded", () => {
  cargarComunidad();
});
document
    .getElementById("comunidades")
    .addEventListener("change", cargarProvincia);
  document
    .getElementById("provincias")
    .addEventListener("change", cargarMunicipios);
  document
    .getElementById("municipios")
    .addEventListener("change", peticionCoordenadas);
  /* document.addEventListener('DOMContentLoaded', crearCalendario); */
  var boton = document.getElementById("btnEnviar");
  //boton.addEventListener("click", personalizarCalendario);
