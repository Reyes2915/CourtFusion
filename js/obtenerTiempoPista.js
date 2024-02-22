async function peticionCoordenadas() {
  let municipioSelect = document.getElementById("muniprueba");
  let municipioName = municipioSelect.textContent;
  let direccion = document.getElementById("direccion");
  direccion.textContent = municipioName;
  let apiUrl =
    "https://dev.virtualearth.net/REST/v1/Locations?q=" +
    municipioName +
    "&key=MiGtaezrn550Y2zxAanE~fgg0btSeHQ1509aqAVqXlA~Av367PS242wIqVFPQxMOWDApwz4_wZ9pY_JVD5RuXFvB_DPipIU34DQuwQe6C-yT&output=json";

  try {
    let response = await fetch(apiUrl);
    let data = await response.json();
    if (
      data.resourceSets.length > 0 &&
      data.resourceSets[0].resources.length > 0
    ) {
      let coordinates = data.resourceSets[0].resources[0].point.coordinates;
      let latitud = coordinates[0];
      let longitud = coordinates[1];
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

async function peticionTiempo(latitud, longitud) {
  let apiUrl = "";
  try {
    apiUrl =
      `https://api.openweathermap.org/data/2.5/onecall?lat=${latitud}&lon=${longitud}` +
      `&units=metric&exclude=current,minutely,hourly&lang=es&appid=b94f9f198880e633033f0cbd587d9b3d`;
    let response = await fetch(apiUrl);
    let data = await response.json();
    if (data.daily.length > 0) {
      // Aquí puedes acceder a los datos diarios
      let pronosticoDiario = data.daily;

      // Itera a través de los datos diarios para obtener pronósticos para cada día
      pronosticoDiario.forEach((dia, index) => {
        let iconCode = dia.weather[0].icon;
        let iconUrl = "http://openweathermap.org/img/w/" + iconCode + ".png";
        let minTemp = dia.temp.min;
        let maxTemp = dia.temp.max;
      });
      return data;
    } else {
      console.error(
        "No se encontraron datos meteorológicos para el lugar especificado."
      );
      return [];
    }
  } catch (error) {
    console.error("Error al obtener datos meteorológicos:", error);
    return [];
  }
}
var mymap; // Declara mymap como variable global

function inicializarMapa() {
  // Configura un mapa y define su ubicación inicial con un mayor zoom
  mymap = L.map("map").setView(["40.4167", "-3.70325"], 13); // Madrid

  // Agrega una capa de mapa base (tile layer) de OpenStreetMap
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution:
      'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(mymap);
}

async function peticionMapa(latitud, longitud) {
  if (!mymap) {
    // Si el mapa no se ha inicializado, inicialízalo primero
    inicializarMapa();
  }

  var direccion = document.getElementById("direccion").value;
  var comunidad= document.getElementById("comunidad").value;
  var provincia= document.getElementById("provincia").value;
  var municipio= document.getElementById("municipio").value;
  var cp= document.getElementById("cp").value;

  try {
    const response = await fetch(
      `https://nominatim.openstreetmap.org/search?q=${direccion},${municipio},${provincia},${comunidad},${cp},España&format=json&polygon=1&addressdetails=1&limit=1`
    );
    const data = await response.json();

    if (data.length > 0) {
      console.log("Direccion encontrada");
      const latitud = parseFloat(data[0].lat);
      const longitud = parseFloat(data[0].lon);
      const direccion = data[0].display_name;
      const partesdireccion = direccion.split(",");
      const nombredireccion = partesdireccion[0];
      const municipio = partesdireccion[1];
      const provincia = partesdireccion[3];
      const cp = partesdireccion[5];
      const direccioncompleta =
        nombredireccion + "," + municipio + "," + provincia + "," + cp;
      mymap.setView([latitud, longitud], 18);
      L.marker([latitud, longitud]).addTo(mymap).bindPopup(direccioncompleta).openPopup();
      document.getElementById("direccion").textContent = direccioncompleta;
    } else {
      console.log("No se ha encontrado la direccion");
      //Si no se encuentra la direccion mostramos el puntero en las coordenadas
      mymap.setView([latitud, longitud], 18);
      L.marker([latitud, longitud]).addTo(mymap).bindPopup(direccion+','+municipio+','+cp).openPopup();
      document.getElementById("direccion").textContent = direccion;
    }
  } catch (error) {
    console.error("Error de geocodificación:", error);
  }
}

async function obtenerCoordenadasYTiempo(fecha) {
  try {
    // Obtener las coordenadas una vez (puedes ajustar esto según tus necesidades)
    let coordenadas = await peticionCoordenadas();

    //Obtenemos el mapa con la direccion
    let mapa = await peticionMapa(coordenadas.latitud, coordenadas.longitud);

    // Obtener datos meteorológicos para la semana completa
    let datosTiempo = await peticionTiempo(
      coordenadas.latitud,
      coordenadas.longitud
    );

    // Array para almacenar los pronósticos de los próximos 7 días
    let pronosticoSemanal = [];

    for (let i = 0; i < 7; i++) {
      let fechaDia = new Date(fecha);
      fechaDia.setDate(fechaDia.getDate() + i); // Incrementa en un día

      let datosDia = datosTiempo.daily[i];
      let iconCode = datosDia.weather[0].icon;
      let iconUrl = "http://openweathermap.org/img/w/" + iconCode + ".png";
      let minTemp = datosDia.temp.min;
      let maxTemp = datosDia.temp.max;

      let diaSemana = fechaDia.toLocaleDateString("es-ES", { weekday: "long" });
      //Convertir la primera letra en mayúscula
      diaSemana = diaSemana.charAt(0).toUpperCase() + diaSemana.slice(1);
      pronosticoSemanal.push({
        fecha: fechaDia,
        iconUrl,
        minTemp,
        maxTemp,
        diaSemana,
      });
    }

    // Ahora pronosticoSemanal contiene el pronóstico para los próximos 7 días en el mismo lugar
    // Añadir todo al id="tiempo"  crear una fila y añadir 7 columnas con el nombre del día, la imagen del tiempo y la temperatura máxima en rojo y la minima en azul
    let tiempo = document.getElementById("tiempo");
    console.log(tiempo);
    // Crea una fila para los nombres de los días
    const trNombresDias = document.createElement("tr");

    // Crea una fila para los datos de los días
    const trDias = document.createElement("tr");

    pronosticoSemanal.forEach((dia) => {
      // Celda para el nombre del día de la semana
      let thDiaSemana = document.createElement("th");
      thDiaSemana.textContent = dia.diaSemana;
      trNombresDias.appendChild(thDiaSemana);

      // Celda para el icono y temperaturas
      let tdIconoTemperaturas = document.createElement("td");

      // Crea una imagen para el icono
      let imagen = document.createElement("img");
      imagen.src = dia.iconUrl;
      tdIconoTemperaturas.appendChild(imagen);

      // Agrega la temperatura mínima en azul
      let minTemp = document.createElement("span");
      minTemp.textContent = dia.minTemp + "°C/";
      minTemp.style.color = "blue";
      tdIconoTemperaturas.appendChild(minTemp);
      // Agrega la temperatura máxima en rojo
      let maxTemp = document.createElement("span");
      maxTemp.textContent = dia.maxTemp + "°C";
      maxTemp.style.color = "red";
      tdIconoTemperaturas.appendChild(maxTemp);

      // Agrega la celda de icono y temperaturas a la fila de datos de los días
      trDias.appendChild(tdIconoTemperaturas);
    });

    // Agrega la fila de nombres de los días al cuerpo de la tabla
    tiempo.appendChild(trNombresDias);
   

    // Agrega la fila de datos de los días al cuerpo de la tabla
    tiempo.appendChild(trDias);
  } catch (error) {
    console.error("Error:", error);
  }
}

let fecha = new Date(); // Establece la fecha deseada (hoy)
document.addEventListener("DOMContentLoaded", function () {
  obtenerCoordenadasYTiempo(fecha);
});
