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
                            <h3>Actualizar Contraseña</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Nueva constraseña</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="profile_title">
                                    <div class="col-md-6">
                                        <h2></h2>
                                    </div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form class="form-label-left input_mask align-items-center" id="formPass">
                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="" name="" placeholder="Nueva constraseña">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="" name="" placeholder="Confirmar nueva contraseña">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-3 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="" name="" placeholder="Contraseña actual">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group row justify-content-center">
                                            <div class="col-md-0 col-sm-0  offset-md-0">
                                                <button type="submit" class="btn btn-lg btn-success">Actualizar contraseña</button>
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
    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/user/index.js" type="module"></script>
</body>