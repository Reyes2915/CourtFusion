<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="icon" href="imagenes/icono.jfif">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <?php
  include 'funciones.php';
  if (isset($_POST['registrarse'])) {
    registrarUsuario();
  }

  if (isset($_POST['registroempresa'])) {
    registrarEmpresa();
  }
  ?>
  <div class="modal fade" id="miModal" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
    <h5 class="modal-title" id="modalHeader" aria-labelledby="modalHeader">Título del modal</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
        <div class="modal-body" id="modalBody">
          <!-- El contenido del modal se llenará dinámicamente con JavaScript -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <?php

  mostrarNavbar();
  ?>
  <div id="contenedor">
    <div id="fondoregistro" class="formulario formulario-usuario">
      <section class="vh-80">
        <div class="container h-80">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black formulario mt-4">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                      <h2 class="mb-4">Registro de Usuario</h2>
                      <div class="text-end align-items-end justify-content-end">
                        <div class="ellipse-button-container mt-2 text-center">
                          <div class="ellipse-button-left" id="botonusuario">Usuario</div>
                          <div class="ellipse-button-right" id="botonempresa">Empresa</div>
                        </div>
                      </div>
                      <form action="" method="post" class="mx-1 mx-md-4">
                        <div class="form-outline flex-fill mb-4">
                          <label class="form-label" for="nombre">Tu Nombre</label>
                          <input type="text" name="nombre" id="nombre" class="form-control" required aria-label="Nombre" aria-describedby="nombreHelp" placeholder="Escribe tu nombre completo" title="Nombre" autocomplete="off" />
                          <small id="nombreHelp" class="form-text text-muted">Por favor, ingresa tu nombre
                            completo.</small>
                        </div>

                        <div class="form-outline flex-fill mb-4">
                          <label class="form-label" for="correo">Tu Correo Electrónico</label>
                          <input type="email" name="correo" id="correo" class="form-control" required aria-label="Correo Electrónico" aria-describedby="correoHelp" placeholder="ejemplo@ejemplo.com" title="Correo Electrónico" autocomplete="off" />
                          <small id="correoHelp" class="form-text text-muted">Por favor, ingresa tu correo electrónico
                            .</small>
                        </div>

                        <div class="mb-4">

                          <label class="form-label" for="contraseña">Contraseña</label>
                          <div class="input-group">
                            <input type="password" name="contraseña" id="contraseña" class="form-control" required aria-label="Contraseña" aria-describedby="contraseñaHelp" placeholder="********" title="Contraseña" autocomplete="off" />
                            <button type="button" id="mostrarContraseñaBoton" class="btn btn-outline-secondary" aria-label="Mostrar Contraseña">
                              <i class="fa fa-eye-slash" id="mostrarContraseña" style="cursor: pointer; line-height: 1;" aria-hidden="true" title="Mostrar Contraseña"></i>
                            </button>
                          </div>
                          <small id="contraseñaHelp" class="form-text text-muted">Introduce tu contraseña.</small>
                        </div>

                        <div class="form-outline flex-fill mb-4">
                          <label class="form-label" for="repetirContraseña">Repite tu Contraseña</label>
                          <input type="password" name="repetirContraseña" id="repetirContraseña" class="form-control" required aria-label="Repetir Contraseña" aria-describedby="repetirContraseñaHelp" placeholder="********" title="Repetir Contraseña" autocomplete="off" />
                          <small id="repetirContraseñaHelp" class="form-text text-muted">Por favor, repite tu contraseña
                            para confirmarla.</small>
                        </div>

                        <div class="form-check d-flex justify-content-center mb-5">
                          <div class="me-2 mt-1">
                            <input class="form-check-input" name="aceptarTerminos" required type="checkbox" value="" id="aceptarTerminos" aria-labelledby="aceptarTerminosLabel" />
                          </div>
                          <label class="form-check-label" for="aceptarTerminos" id="aceptarTerminosLabel">
                            Acepto todas las declaraciones en <a href="terminosycondiciones.html" title="Términos de Servicio">Términos de servicio</a>
                          </label>
                        </div>
                        <div class="d-flex justify-content-center mt-4 mb-3">
                        <label for="captchausuario" class="visually-hidden">Buscar tu pista</label>
                          <div class="g-recaptcha" id="captchausuario" data-sitekey="6Lf2-osoAAAAACGSi-kHI2lKulWNwLAnvw3YlRA1" aria-label="Captcha"></div>
                        </div>

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" name="registrarse" class="btn btn-primary btn-lg" style="background-color: #e86b1c;" id="botonRegistro">Registrarse</button>
                        </div>

                        <div class="text-center mt-3">
                          ¿Ya tienes una cuenta? <a href="perfil.php" title="Iniciar Sesión">Iniciar Sesión</a>
                        </div>

                      </form>
                    </div>

                    <!-- Imagen eliminada para hacerlo simétrico -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Formulario de Registro de Empresa -->
    <div id="registroempresa" class="formulario formulario-empresa d-none">
      <section class="vh-80">
        <div class="container h-80">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black formulario mt-4">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">
                      <h2 class="mb-4">Registro de Empresa</h2>
                      <form action="" method="POST">
                        <div class="ellipse-button-container mt-2 text-center">
                          <div class="ellipse-button-left" id="botonusuario2" title="Registrarse como Usuario">Usuario</div>
                          <div class="ellipse-button-right" id="botonempresa2" title="Registrarse como Empresa">Empresa</div>
                        </div>

                        <div class="row mt-2">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="nombre_empresa">Nombre de la Empresa:</label>
                              <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" required placeholder="Nombre de la Empresa">
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="correo_contacto">Correo de Contacto:</label>
                              <input type="email" class="form-control" id="correo_contacto" name="correo_contacto" required placeholder="Correo de Contacto">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="telefono_contacto">Teléfono de Contacto:</label>
                              <input type="tel" class="form-control" id="telefono_contacto" name="telefono_contacto" required placeholder="Teléfono de Contacto">
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="tipo_pista">Tipo de Pista:</label>
                              <select class="form-control" id="tipo_pista" name="tipo_pista" required placeholder="Tipo de Pista">
                                <option value="Fútbol">Fútbol</option>
                                <option value="Baloncesto">Baloncesto</option>
                                <option value="Tenis">Tenis</option>
                                <option value="Pádel">Pádel</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="nombre_pista">Nombre de la Pista:</label>
                              <input type="text" class="form-control" id="nombre_pista" name="nombre_pista" required placeholder="Nombre de la Pista">
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="comunidad_autonoma">Comunidad Autónoma:</label>
                              <input type="text" class="form-control" id="comunidad_autonoma" name="comunidad_autonoma" required placeholder="Comunidad Autónoma">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="provincia">Provincia:</label>
                              <input type="text" class="form-control" id="provincia" name="provincia" required placeholder="Provincia">
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="municipio">Municipio:</label>
                              <input type="text" class="form-control" id="municipio" name="municipio" required placeholder="Municipio">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="codigo_postal">Código Postal:</label>
                              <input type="text" class="form-control" pattern="^\d{5}$" id="codigo_postal" name="codigo_postal" required placeholder="Código Postal (5 dígitos)">
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="direccion">Dirección:</label>
                              <div class="input-group">
                                <input type="direccion" name="direccion" id="direccion" class="form-control" required placeholder="Dirección" aria-label="Dirección" title="direccion" autocomplete="off" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="contraseñaempresa">Contraseña:</label>
                              <div class="input-group">
                                <input type="password" name="contraseñaempresa" id="contraseñaempresa" class="form-control" required placeholder="Contraseña" aria-label="Contraseña" title="Contraseña" autocomplete="off" />
                                <button type="button" id="mostrarContraseñaBoton" class="btn btn-outline-secondary" title="Mostrar Contraseña" aria-label="Mostrar Contraseña">
                                  <i class="fa fa-eye-slash" id="mostrarContraseña" style="cursor: pointer; line-height: 1;" aria-hidden="true"></i>
                                </button>
                              </div>
                            </div>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="confirmar_contraseña">Confirmar Contraseña:</label>
                              <input type="password" name="confirmar_contraseña" id="confirmar_contraseña" class="form-control" required placeholder="Confirmar Contraseña" aria-label="Confirmar Contraseña" title="Confirmar Contraseña" autocomplete="off" />
                            </div>
                          </div>
                        </div>

                        <!-- Checkbox y captcha comunes para ambos formularios -->
                        <div class="form-group form-check">
                          <input type="checkbox" class="form-check-input" id="terms" name="terms" required title="Aceptar términos y condiciones">
                          <label class="form-check-label" for="terms">Aceptar términos y condiciones</label>
                        </div>
                        <div class="form-group d-flex justify-content-center mt-3">
                        <label for="captchaempresa" class="visually-hidden">Captcha empresa</label>
                          <div class="g-recaptcha" id="captchaempresa" data-sitekey="6Lf2-osoAAAAACGSi-kHI2lKulWNwLAnvw3YlRA1" aria-label="Captcha"></div>
                        </div>
                        <div class="form-group d-flex justify-content-center mt-3">
                          <button type="submit" name="registroempresa" class="btn btn-primary" style="margin-top: 10px;background-color: #e86b1c;"
                          >Registrarse como empresa</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>









  <?

  mostrar_footer();
  ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/script.js">
  </script>
  <script type="text/javascript" src="js/formularios.js">
  </script>
</body>

</html>