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
              <h3>Editar Cliente </h3>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <!-- <h2>Perfil</h2> -->
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="col-md-12 col-sm-12">

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
                                      <h2>Datos del cliente</h2>
                                    </div>
                                  </div>
                                  <div class="ln_solid"></div>
                                  <form class="form-label-left input_mask align-items-center" id="form-update-cliente">

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
                                        <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                      </div>

                                      <div class="col-md-3 col-sm-6  form-group has-feedback">
                                        <input type="email" class="form-control has-feedback-left" id="email" name="email" placeholder="Email">
                                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                      </div>
                                    </div>

                                    <div class="form-group row align-items-center justify-content-center">
                                      <div class="col-md-3 col-sm-6  form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="celular" name="celular" placeholder="Celular">
                                        <span class="fa fa-mobile form-control-feedback left" aria-hidden="true"></span>
                                      </div>

                                      <div class="col-md-3 col-sm-6  form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="celularSecundario" name="celularSecundario" placeholder="Celular">
                                        <span class="fa fa-mobile form-control-feedback left" aria-hidden="true"></span>
                                      </div>
                                    </div>

                                    <div class="form-group row align-items-center justify-content-center">
                                      <div class="col-md-3 col-sm-6  form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="direccion" name="direccion" placeholder="Direccion">
                                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                                      </div>
                                    </div>

                                </div>

                                <div class="ln_solid"></div>

                                <div class="form-group row justify-content-end">
                                  <div class="col-md-0 col-sm-0  offset-md-1">
                                    <button type="submit" class="btn btn-xm btn-success"><i class="fa fa-floppy-o"></i> Guardar Cambios</button>
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
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/cliente/index.js" type="module"></script>
</body>