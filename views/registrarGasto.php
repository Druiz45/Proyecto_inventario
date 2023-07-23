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
                            <h3>Registro de gasto</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Nuevo Gasto<small>Informacion del gasto</small></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form class="form-label-left input_mask">
                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Nombre de producto">
                                                <span class="fa fa-cart-plus form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <select class="select2_single form-control" tabindex="-1">
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="CA">California</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group row">
                                            <div class="col-md-8 col-sm-8  offset-md-0">
                                                <button type="submit" class="btn btn-success">Registrar Gasto</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Descripcion<small>Descripcion del Gasto</small></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <textarea class="resizable_textarea form-control" placeholder="Descripcion..."></textarea>
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
</body>