<?
session_start();
//Si no existe la sesión, redirecciona a la página index.php
if (!isset($_SESSION['isAdmin'])) {
    header("location: index.php");
  }


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validar Imágenes</title>
    <link rel="icon" href="imagenes/icono.jfif" alt="Icono de la página">
    <link rel="stylesheet" href="css/validarimagenes.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="card" id="image-card">
                <div class="card-body">
                    <h2 class="card-title">Información de la Pista</h2>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID de la Pista:</strong> <span id="id-pista-info"></span></li>
                        <li class="list-group-item"><strong>Tipo de la Pista:</strong> <span id="tipo-pista-info"></span></li>
                        <li class="list-group-item"><strong>Comunidad:</strong> <span id="comunidad-info"></span></li>
                        <li class="list-group-item"><strong>Provincia:</strong> <span id="provincia-info"></span></li>
                        <li class="list-group-item"><strong>Municipio:</strong> <span id="municipio-info"></span></li>
                        <li class="list-group-item"><strong>Correo:</strong> <span id="correo-info"></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div id="gallery">
                <div id="image-container">
                    <div id="nombre-pista-info" class="h1 text-center"></div>
                    <img id="image" src="" alt="">
                </div>
                <div id="buttons" class="d-flex justify-content-center">
                    <!-- Botones debajo de la imagen -->
                    <button id="approve" class="action-button">✅</button>
                    <div class="back-button-container">
                    <button class="action-button" id="pausa" onclick="window.location.href='gestionpistas.php'">&#9208</button>
                </div>
                    <button id="reject" class="action-button">❌</button>
                </div>
               
            </div>
        </div>
    </div>
</div>



    <?php
    $imageFolder = 'imagenes/pistasporvalidar/';
    $approvedFolder = 'imagenes/pistas/';
    $images = array_diff(scandir($imageFolder), array('..', '.'));
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        const imageContainer = document.getElementById('image-container');
        const image = document.getElementById('image');
        const approveButton = document.getElementById('approve');
        const rejectButton = document.getElementById('reject');
        let currentIndex = 0;
        const imagesObject = <?php echo json_encode($images); ?>;
        const images = Object.keys(imagesObject);
        const imageFolder = '<?php echo $imageFolder; ?>';
        const approvedFolder = '<?php echo $approvedFolder; ?>';
        let email;
        let idPista;

        // Cargar la próxima imagen en la galería
        function loadNextImage() {
            if (currentIndex < images.length) {
                const key = images[currentIndex];
                const imageUrl = imagesObject[key];
                image.src = imageFolder + imageUrl;
                const nameParts = imageUrl.match(/^(.*?)\(/);
                const pistaName = nameParts && nameParts[1] ? nameParts[1] : imageUrl;

                // Mostrar el nombre en la tarjeta
                document.getElementById('nombre-pista-info').textContent = pistaName;

                // Actualiza la información de la pista
                updatePistaInfo(imageUrl);

                currentIndex++;
            } else {
                document.getElementById('nombre-pista-info').textContent = 'No hay más imágenes para validar.';
                //Ocultar los botones
                approveButton.style.display = 'none';
                rejectButton.style.display = 'none';
                image.style.display = 'none'; // Ocultar la imagen cuando no hay más

                // Cambiar el emoji en el botón de pausa
                const pausaEmoji = document.getElementById('pausa');
                pausaEmoji.innerHTML = '←'; // Establece el emoji en lugar del texto
            }
        }

        // Función para actualizar la información de la pista
        function updatePistaInfo(imageUrl) {
            const match = imageUrl.match(/\(([^)]+)\)/);
            if (match) {
                const pistaInfo = match[1]; // Obtiene el texto dentro de los paréntesis
                const nombrePistaInfo = document.getElementById('nombre-pista-info');
                const tipoPistaInfo = document.getElementById('tipo-pista-info');
                const comunidadInfo = document.getElementById('comunidad-info');
                const provinciaInfo = document.getElementById('provincia-info');
                const municipioInfo = document.getElementById('municipio-info');
                const correoInfo = document.getElementById('correo-info');
                const idPistaInfo = document.getElementById('id-pista-info');
                const infoArray = pistaInfo.split('-');
                if (infoArray.length >= 5) {
                    tipoPistaInfo.textContent = infoArray[0];
                    comunidadInfo.textContent = infoArray[1];
                    provinciaInfo.textContent = infoArray[2];
                    municipioInfo.textContent = infoArray[3];
                    correoInfo.textContent = infoArray[4];
                    idPistaInfo.textContent = infoArray[5];
                    email = infoArray[4];
                    idPista = infoArray[5];
                }
            }
        }

        // Función para mover o eliminar una imagen
        function moveImage(imageUrl, destinationFolder, action,emailUser,idPista) {
            const formData = new FormData();
            formData.append('image', imageUrl);
            formData.append('action', action); // Pasa la acción ("move" o "delete");
            formData.append('email', email);
            formData.append('idPista', idPista);

            fetch('moverimagen.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                console.log(result); // Maneja la respuesta del servidor
            })
            .catch(error => console.error('Error:', error));
        }

        function approveImage() {
            if (currentIndex > 0) {
                const key = images[currentIndex - 1];
                const imageUrl = imagesObject[key];
                moveImage(imageUrl, approvedFolder, 'move',email,idPista); // Establece la acción "move"
            }
            loadNextImage();
        }

        // Función para rechazar una imagen
        function rejectImage() {
            if (currentIndex > 0) {
                const key = images[currentIndex - 1];
                const imageUrl = imagesObject[key];
                moveImage(imageUrl, imageFolder, 'delete',email,idPista); // Establece la acción "delete"
            }
            loadNextImage();
        }

        // Asignar las funciones a los botones
        approveButton.addEventListener('click', approveImage);
        rejectButton.addEventListener('click', rejectImage);

        // Cargar la primera imagen
        loadNextImage();
    </script>
</body>
</html>

