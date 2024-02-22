const imageContainer = document.getElementById('image-container');
const image = document.getElementById('image');
const imageName = document.getElementById('image-name');
const approveButton = document.getElementById('approve');
const rejectButton = document.getElementById('reject');
const imageFolder = 'pistasporvalidar/';
const approvedFolder = 'pistas/';
const rejectedFolder = 'pistas_rechazadas/';
let images = [];
let currentIndex = 0;

// Obtén la lista de imágenes en la carpeta "pistasporvalidar"
fetchImages();

// Cargar la próxima imagen en la galería
function loadNextImage() {
  if (currentIndex < images.length) {
    const imageUrl = images[currentIndex];
    image.src = imageFolder + imageUrl;
    imageName.textContent = imageUrl;
    currentIndex++;
  } else {
    imageContainer.style.animation = 'slide-in 1s ease-in-out';
    imageContainer.style.opacity = 0;
    setTimeout(() => {
      imageContainer.style.animation = 'none';
      imageContainer.style.opacity = 1;
      image.src = '';
      imageName.textContent = 'No hay más imágenes';
    }, 1000);
  }
}

// Aprobar una imagen (moverla a la carpeta "pistas")
approveButton.addEventListener('click', () => {
  if (currentIndex > 0) {
    const imageUrl = images[currentIndex - 1];
    moveImage(imageUrl, approvedFolder);
  }
  loadNextImage();
});

// Rechazar una imagen (moverla a la carpeta "pistas_rechazadas")
rejectButton.addEventListener('click', () => {
  if (currentIndex > 0) {
    const imageUrl = images[currentIndex - 1];
    moveImage(imageUrl, rejectedFolder);
  }
  loadNextImage();
});

// Cargar la lista de imágenes en la carpeta "pistasporvalidar"
function fetchImages() {
  fetch('getImages.php')
    .then((response) => response.json())
    .then((data) => {
      images = data.images;
      loadNextImage();
    });
}

// Mover una imagen a una carpeta específica
function moveImage(imageUrl, destinationFolder) {
  fetch('moveImage.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      source: imageFolder + imageUrl,
      destination: destinationFolder + imageUrl,
    }),
  });
}
