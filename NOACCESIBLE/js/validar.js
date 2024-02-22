function mostrarPassword() {
  var cambio = document.getElementById("txtPassword");
  if (cambio.type == "password") {
    cambio.type = "text";
    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
  } else {
    cambio.type = "password";
    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
  }
}

$(document).ready(function () {
  //CheckBox mostrar contraseña
  $('#ShowPassword').click(function () {
    $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
  });
});
$(document).ready(function() {
  $('#example').DataTable( {
      responsive: true,
      "pageLength": 10,
  } );
} );
$('#volver').click(function () {
  $('[name=dpto]').removeAttr('required');
  $('[name=contraseña]').removeAttr('required');
  $('[name=confcontraseña]').removeAttr('required');
  $('[name=coddpto]').removeAttr('required');
  $('[name=nombre]').removeAttr('required');
  $('[name=centro]').removeAttr('required');
  $('[name=dni]').removeAttr('required');
  $('[name=archivo]').removeAttr('required');
});
