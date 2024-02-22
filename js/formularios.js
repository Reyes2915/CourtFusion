var botonUsuario = document.getElementById("botonusuario");
var botonEmpresa = document.getElementById("botonempresa");
var botonUsuario2 = document.getElementById("botonusuario2");
var botonEmpresa2 = document.getElementById("botonempresa2");
var fondoregistro = document.getElementById("fondoregistro");
var registroempresa = document.getElementById("registroempresa");



botonEmpresa.addEventListener("click", function () {
  console.log("hola");
  //Añadimos la clase d-none para que no se vea el formulario de usuario 
  
  fondoregistro.classList.add("d-none");
  fondoregistro.style.position = "absolute"; //Para que no se vea el formulario de usuario
  fondoregistro.classList.remove("animate__animated", "animate__fadeIn", "animate__slow");
fondoregistro.classList.add("animate__animated", "animate__fadeOut", "animate__slow");
  //Quitamos la clase d-none para que se vea el formulario de empresa y le quitamos position absolute 
  //para que no se vea el formulario de empresa
  registroempresa.classList.remove("d-none");
  registroempresa.style.position = "relative";
  registroempresa.classList.remove("animate__animated", "animate__fadeOut", "animate__slow");
  registroempresa.classList.add("animate__animated", "animate__fadeIn", "animate__slow");

 
 
});
 botonUsuario2.addEventListener("click", function () {
  //Añadimos la clase d-none para que no se vea el formulario de empresa 
  registroempresa.classList.add("d-none");
  registroempresa.style.position = "absolute";
  registroempresa.classList.remove("animate__animated", "animate__fadeIn", "animate__slow");
  registroempresa.classList.add("animate__animated", "animate__fadeOut", "animate__slow");
  //Quitamos la clase d-none para que se vea el formulario de usuario y le quitamos position absolute 
  //para que no se vea el formulario de usuario
  fondoregistro.classList.remove("d-none");
  fondoregistro.style.position = "relative";
  fondoregistro.classList.remove("animate__animated", "animate__fadeOut", "animate__slow");
  fondoregistro.classList.add("animate__animated", "animate__fadeIn", "animate__slow");
}
);
  





