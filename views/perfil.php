<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <?php require_once("./../views/includes/barraLateral.php"); ?>

      <!-- top navigation -->

      <?php require_once("./../views/includes/barraSuperior.php"); ?>

      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">

        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Perfil usuario</h3>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Perfil</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="col-md-3 col-sm-3">
                    <div class="row align-items-center justify-content-center">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/images/picture.jpg" alt="Avatar" title="Change the avatar">
                        </div>
                        <br>
                        <input type="file">
                      </div>
                    </div>
                    <br>
                    <!-- <input type="file" name="" id=""> -->

                    <ul class="list-unstyled user_data">
                      <li>
                        <i class="fa fa-map-marker user-profile-icon"></i> <span id="info-perfil">Perfil:</span>
                      </li>

                      <li>
                        <i class="fa fa-map-marker user-profile-icon"></i> <span id="info-ultimo-log">Ultimo inicio de sesion: <?= getFecha($_SESSION['ultimoLog']) ?></span>
                      </li>

                      <li>
                        <i class="fa fa-map-marker user-profile-icon"></i> <span id="info-fecha-creacion">Fecha de creacion: <?= getFecha($_SESSION['fechaCreacion']) ?></span>
                      </li>
                      <li class="media event">
                        <div class="media-body">
                          <a class="title" href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/usuario/editPass">Actualizar Contraseña</a>
                        </div>
                      </li>
                    </ul>

                    <br />

                    <!-- start skills -->
                    <!-- end of skills -->

                  </div>
                  <div class="col-md-9 col-sm-9">


                    <!-- start of user-activity-graph -->

                    <!-- end of user-activity-graph -->

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">

                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                          <div class="row align-items-center justify-content-center">
                            <div class="col-md-12">
                              <div class="">
                                <div class="">
                                  <br />
                                  <div class="profile_title">
                                    <div class="col-md-6">
                                      <h2>Datos del usuario</h2>
                                    </div>
                                  </div>
                                  <div class="ln_solid"></div>
                                  <form class="form-label-left input_mask align-items-center" id="form-update-user">
                                    <div class="form-group row align-items-center justify-content-center">
                                      <div class="col-md-3 col-sm-6  form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="nombres" name="nombres" placeholder="Nombres">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                      </div>

                                      <div class="col-md-3 col-sm-6  form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="apellidos" name="apellidos" placeholder="Apellidos">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                      </div>
                                    </div>

                                    <div class="form-group row align-items-center justify-content-center">
                                      <div class="col-md-3 col-sm-6  form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="documento" name="documento" placeholder="Documento">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                      </div>

                                      <div class="col-md-3 col-sm-6  form-group has-feedback">
                                        <input type="email" class="form-control has-feedback-left" id="email" name="email" placeholder="Email">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                      </div>
                                    </div>

                                    <div class="form-group row align-items-center justify-content-center">
                                      <div class="col-md-3 col-sm-6  form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="celular" name="celular" placeholder="Celular">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                      </div>

                                      <div class="col-md-3 col-sm-6  form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="direccion" name="direccion" placeholder="Direccion">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                      </div>
                                    </div>

                                    <!-- <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <input type="password" class="form-control has-feedback-left" id="pass" name="pass"  placeholder="Contraseña">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <input type="password" class="form-control has-feedback-left" id="confirmPass" name="confirmPass" placeholder="Confirmar Contraseña">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div> -->

                                </div>

                                <div class="ln_solid"></div>

                                <div class="form-group row justify-content-end">
                                  <div class="col-md-0 col-sm-0  offset-md-1">
                                    <button type="submit" class="btn btn-xm btn-success">Guardar Cambios</button>
                                  </div>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- /page content -->

    <!-- footer content -->
    <?php require_once("./../views/includes/footer.php"); ?>
    <!-- /footer content -->
  </div>
  </div>
  <?php require_once("./../views/includes/scripts.php"); ?>
  <script>
    const url = JSON.parse('<?= json_encode(getUrl($_SERVER['SERVER_NAME'])) ?>');
  </script>
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>//assets/build/js/user/index.js" type="module"></script>
</body>