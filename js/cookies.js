// Muestra el modal de cookies automáticamente cuando la página se carga
// por primera vez y el usuario no ha aceptado o rechazado las cookies
// previamente.
// Si el usuario ya ha aceptado las cookies, no se muestra el modal.
// Si el usuario ya ha rechazado las cookies, no se muestra el modal.
// Si el usuario acepta las cookies, se guarda en localStorage que las ha
// aceptado y no se muestra el modal.

$(document).ready(function () {
  // Comprueba si ya se ha aceptado o rechazado el aviso de cookies
  const hasAcceptedCookies = localStorage.getItem('acceptedCookies');
  const modal = $('#cookieModal');

  // Muestra el modal de cookies si aún no se ha aceptado
  if (!hasAcceptedCookies) {
    modal.modal('show');
  }

  // Maneja la acción de aceptar cookies
  $('#btnAcceptCookies').on('click', function () {
    localStorage.setItem('acceptedCookies', 'true');
    modal.modal('hide'); // Oculta el modal
  });

  // Maneja la acción de rechazar cookies (puedes agregar tu lógica aquí)
  $('#btnRejectCookies').on('click', function () {
    modal.modal('hide'); // Opcional: oculta el modal
  });

  // Verifica si la página se ha cargado
  console.log('Página cargada');
});
