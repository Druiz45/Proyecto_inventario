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
                            <h3>Editar ingresos</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <form class="form-label-left input_mask" id="formUpdateIngreso">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Editar ingreso<small>Informacion del ingreso</small></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="valorIngreso" name="valorIngreso" placeholder="Valor del ingreso">
                                                <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <select class="select2_single form-control" id="tipoIngreso" name="tipoIngreso" tabindex="-1">
                                                    <option value="">Seleccione el tipo de ingreso</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group row">
                                            <div class="col-md-8 col-sm-8  offset-md-0">
                                                <button type="submit" class="btn btn-success">Editar Ingreso</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Descripcion del ingreso</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="col-md-12 col-sm-6  form-group has-feedback">
                                            <select class="select2_single form-control" id="banco" name="banco" tabindex="-1">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12">
                                                <textarea class="resizable_textarea form-control" id="descripcion" name="descripcion" placeholder="Descripcion..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/ingreso/index.js" type="module"></script>
</body>