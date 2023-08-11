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
                            <h3>Registro de cliente</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Nuevo cliente<small>Informacion del cliente</small></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form class="form-label-left input_mask align-items-center" id="form-create-cliente">
                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="nombres" name="nombres" placeholder="Nombres">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="apellidos" name="apellidos"  placeholder="Apellidos">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="documento" name="documento"  placeholder="Documento">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <input type="email" class="form-control has-feedback-left" id="email" name="email"  placeholder="Email">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="celular" name="celular"  placeholder="Celular">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="direccion" name="direccion"  placeholder="Direccion">
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

                                        <!-- <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <select class="select2_single form-control" tabindex="-1" id="select-perfiles" name="select-perfiles">
                                                    <option value="">Seleccione el rol del usuario</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="CA">California</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="ln_solid"></div>
                                        <div class="form-group row justify-content-end">
                                            <div class="col-md-2 col-sm-3  offset-md-0">
                                                <button type="submit" class="btn btn-lg btn-success">Registrar Usuario</button>
                                            </div>
                                        </div>
                                    </form>
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