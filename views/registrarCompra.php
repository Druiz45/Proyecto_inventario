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
                            <h3>Registro orden de compra</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <!-- <form class="form-label-left input_mask" id="formCreateCompra"> -->
                    <div class="row">

                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Informacion del pedido</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="form-group row">
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <img src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/images/logo.png" width="250" height="150">
                                        </div>

                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Pedido" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Orden produccion" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>

                                    <div class="form-group row">
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="date" class="form-control has-feedback-left" id="docCliente" name="docCliente" placeholder="Fecha" autocomplete="off">
                                            <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="date" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Fecha de entrega" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Acta de entrega" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center justify-content-center">
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Fabricante" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Remision" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="docCliente" name="docCliente" placeholder="Direccion" autocomplete="off">
                                            <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Telefono" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Ciudad" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="docCliente" name="docCliente" placeholder="Celular" autocomplete="off">
                                            <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Email" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Vendedor codigo" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>

                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12">
                                            <textarea class="resizable_textarea form-control" id="anotacion" name="anotacion" placeholder="Anotacion: (opcional)"></textarea>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>

                                    <div class="form-group row">
                                        <div class="col-md-4 col-sm-4">
                                            <input type="text" class="form-control has-feedback-left" id="docCliente" name="docCliente" placeholder="Total" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha</th>
                                                <th>Abono</th>
                                                <th>Banco</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="ln_solid"></div>

                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12">
                                            <textarea class="resizable_textarea form-control" id="anotacion" name="anotacion" placeholder="Observacion:"></textarea>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>

                                    <div class="form-group row">
                                        <div class="col-md-2 col-sm-2  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="docCliente" name="docCliente" placeholder="Fabricante" autocomplete="off">
                                            <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-2 col-sm-2  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Vendedor" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-2 col-sm-2  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Recibe" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-2 col-sm-2  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Despacho" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-2 col-sm-2  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Autorizo" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-2 col-sm-2  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="---" autocomplete="off">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-end">
                                <div class="col-md-3 col-sm-3  form-group has-feedback">
                                    <button type="submit" class="btn btn-success btn-round" id="btn-registrar-pedido"><i class="fa fa-arrow-down"></i> Registrar pedido</button>
                                </div>
                            </div>

                        </div>

                        <!-- <div class="col-md-8">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Informacion orden de compra</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="docProveedor" name="docProveedor" placeholder="Documento del proveedor" autocomplete="off">
                                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Nombre del producto" autocomplete="off">
                                                <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="docCliente" name="docCliente" placeholder="Documento del cliente" autocomplete="off">
                                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <select disabled class="select2_single form-control" id="proveedor" name="proveedor" tabindex="-1">
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <select disabled class="select2_single form-control" id="producto" name="producto" tabindex="-1">
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <select disabled class="select2_single form-control" id="cliente" name="cliente" tabindex="-1">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-5 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="valorProducto" name="valorProducto" placeholder="Valor del producto" autocomplete="off">
                                                <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group row">
                                            <div class="col-md-8 col-sm-8  offset-md-0">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-arrow-down"></i> Registrar pedido</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Abono y Anotacion</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-11 col-sm-6  form-group has-feedback">
                                                <select class="select2_single form-control" id="banco" name="banco" tabindex="-1">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="abonoProducto" name="abonoProducto" placeholder="Abono inicial" autocomplete="off">
                                            <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <br>
                                        <div class="col-md-12 col-sm-6  form-group has-feedback">
                                            <label for="fechaLimite">Fecha limite de entrega: </label>
                                            <input type="date" class="form-control has-feedback-left" id="fechaLimite" name="fechaLimite" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12">
                                                <textarea class="resizable_textarea form-control" id="anotacion" name="anotacion" placeholder="Anotacion: (opcional)"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                    </div>
                    <!-- </form> -->
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
    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/compra/index.js" type="module"></script>
</body>