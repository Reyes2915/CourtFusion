
    var volver = document.getElementById('volver');
    if (volver) {
    document.getElementById('volver').addEventListener('click', function () {
        var archivoInput = document.getElementById('archivoInput');
        if (archivoInput) {
            archivoInput.removeAttribute('required');
        }

        var nombreInput = document.getElementById('nombre');
        if (nombreInput) {
            nombreInput.removeAttribute('required');
        }

        var correoInput = document.getElementById('correo');
        if (correoInput) {
            correoInput.removeAttribute('required');
        }

        var rolInput = document.getElementById('rol');
        if (rolInput) {
            rolInput.removeAttribute('required');
        }

        var contraseñaInput = document.getElementById('contraseña');
        if (contraseñaInput) {
            contraseñaInput.removeAttribute('required');
        }

        var repetirContraseñaInput = document.getElementById('repetirContraseña');
        if (repetirContraseñaInput) {
            repetirContraseñaInput.removeAttribute('required');
        }

        var nombreReservante= document.getElementById('nombreReservante');
        if (nombreReservante) {
            nombreReservante.removeAttribute('required');
        }
        var fecha= document.getElementById('fecha');
        if (fecha) {
            fecha.removeAttribute('required');
        }
    });
}


document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.getElementById("mostrarContraseña");
    const passwordField = document.getElementById("contraseña");
    const botonContraseña = document.getElementById("mostrarContraseñaBoton");

    if (togglePassword && passwordField && botonContraseña) {
        botonContraseña.addEventListener("click", function () {
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);
            console.log(type);

            // Cambia entre las clases de Font Awesome sólidas (fas)
            togglePassword.classList.toggle("fa-eye-slash");
            togglePassword.classList.toggle("fa-eye");
        });
    }

    $(document).ready(function () {
        // Obtener los datos JSON de la URL de provincias
        $.getJSON(
            'https://apiv1.geoapi.es/provincias?type=JSON&key=78f86e16edd8bc80c4708112811783501edebf3a6428aa9055a783fa96541d1a',
            function (data) {
                // Extraer los nombres de las provincias y almacenarlos en un array
                var provinciasArray = data.data.map(function (provincia) {
                    return provincia.PRO;
                });
    
                // Función para normalizar texto (convertir a minúsculas y quitar acentos)
                function normalizeText(text) {
                    return text
                        .toLowerCase()
                        .normalize("NFD")
                        .replace(/[\u0300-\u036f]/g, "");
                }
    
                // Configurar el autocompletado en el input
                $('#barrabusqueda').autocomplete({
                    source: function (request, response) {
                        var term = normalizeText(request.term);
                        var matchingProvincias = [];
    
                        // Filtrar provincias que comienzan con el término ingresado
                        for (var i = 0; i < provinciasArray.length; i++) {
                            var provincia = normalizeText(provinciasArray[i]);
                            if (provincia.startsWith(term)) {
                                matchingProvincias.push(provinciasArray[i]);
                            }
                        }
    
                        response(matchingProvincias);
                    },
                    minLength: 1 // Número mínimo de caracteres para activar el autocompletado
                });
            });
    });
    
      
      $(document).ready(function() {
        $('.btn-star').click(function() {
            var starButton = $(this);
            starButton.toggleClass('star-active');
        });
    });
});

function redirigirABorrarBackup() {
    window.location.href = 'borrarbackup.php';
}
function redirigirARestaurarBackup() {
    window.location.href = 'restaurarbackup.php';
}
function redirigirAModificarBackup() {
    window.location.href = 'modificarbackup.php';
}

// Obtén los elementos y los botones por sus IDs
const botonReservas = document.getElementById("botonreservas");
const botonSaldo = document.getElementById("botonsaldo");
const elementoReservas = document.getElementById("reservas");
const elementoSaldo = document.getElementById("saldo");
const opcionesPerfil = document.getElementById("opcionesperfil");
const volversaldo = document.getElementById("volversaldo");
const volverreservas = document.getElementById("volverreservas");
const borrarreservaboton = document.getElementById("borrarreservaboton");
const añadirSaldo = document.getElementById("añadirsaldo");
// Agrega manejadores de eventos para los botones
botonReservas.addEventListener("click", () => {
    // Muestra el elemento de reservas y oculta el de saldo
    elementoReservas.classList.remove("d-none");
    elementoSaldo.classList.add("d-none");
    opcionesPerfil.classList.add("d-none");
});
añadirSaldo.addEventListener("click", () => {
    console.log('añadir saldo');
    // Muestra el elemento de reservas y oculta el de saldo
    elementoReservas.classList.add("d-none");
    elementoSaldo.classList.remove("d-none");
    opcionesPerfil.classList.add("d-none");
});

botonSaldo.addEventListener("click", () => {
    console.log(añadirSaldo);
    // Muestra el elemento de saldo y oculta el de reservas
    elementoSaldo.classList.remove("d-none");
    elementoReservas.classList.add("d-none");
    opcionesPerfil.classList.add("d-none");
});
volversaldo.addEventListener("click", () => {
    // Muestra el elemento de saldo y oculta el de reservas
    elementoSaldo.classList.add("d-none");
    elementoReservas.classList.add("d-none");
    opcionesPerfil.classList.remove("d-none");
});
volverreservas.addEventListener("click", () => {
    // Muestra el elemento de saldo y oculta el de reservas
    elementoSaldo.classList.add("d-none");
    elementoReservas.classList.add("d-none");
    opcionesPerfil.classList.remove("d-none");
});



  