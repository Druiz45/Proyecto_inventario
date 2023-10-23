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
                            <h3>Registro de pedido</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <form class="form-label-left input_mask" id="form-create-pedido">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">

                                <div class="x_panel">
                                    <div class="x_title">
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Informacion del pedido</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <div class="form-group row">
                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <img src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/images/logo.png" width="250" height="150">
                                            </div>

                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="remision" name="remision" placeholder="Remision" autocomplete="off">
                                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="orden" name="orden" placeholder="Orden de produccion" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="pedido" name="pedido" placeholder="Pedido" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>

                                        <div class="form-group row align-items-center justify-content-end">
                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="factura" name="factura" placeholder="Factura" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>

                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="date" class="form-control has-feedback-left" id="fecha" name="fecha" placeholder="Fecha" autocomplete="off">
                                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="date" class="form-control has-feedback-left" id="fechaEntrega" name="fechaEntrega" placeholder="Fecha de entrega" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="actaEntrega" name="actaEntrega" placeholder="Acta de entrega" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="nombreCliente" name="nombreCliente" placeholder="Nombre cliente" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="doc" name="doc" placeholder="NIT/CC" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="direccion" name="direccion" placeholder="Direccion" autocomplete="off">
                                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="telefono" name="telefono" placeholder="Telefono" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="ciudad" name="ciudad" placeholder="Ciudad" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="celular" name="celular" placeholder="Celular" autocomplete="off">
                                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="email" name="email" placeholder="Email" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="codigoVendedor" name="codigoVendedor" placeholder="Vendedor codigo" autocomplete="off">
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
                                            <div class="col-md-12 col-sm-12">

                                                <div class="form-group row">
                                                    <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                        <div class="checkbox">
                                                            <label class="">
                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" id="stock" name="stock" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Stock
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                        <div class="checkbox">
                                                            <label class="">
                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" id="almacen" name="almacen" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Almacen
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                        <div class="checkbox">
                                                            <label>
                                                                <div class="icheckbox_flat-green disabled" style="position: relative;"><input type="checkbox" id="fabrica" name="fabrica" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Fabrica
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                        <div class="checkbox">
                                                            <label>
                                                                <div class="icheckbox_flat-green checked disabled" style="position: relative;"><input type="checkbox" id="bandeja" name="bandeja" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Bandeja
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                        <div class="checkbox">
                                                            <label class="">
                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" id="braker" name="braker" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Braker´s
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                        <div class="checkbox">
                                                            <label class="">
                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" id="otros" name="otros" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Otros
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                        <div class="checkbox">
                                                            <label>
                                                                <div class="icheckbox_flat-green disabled" style="position: relative;"><input type="checkbox" id="efectivo" name="efectivo" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Efectivo
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                        <div class="checkbox">
                                                            <label>
                                                                <div class="icheckbox_flat-green checked disabled" style="position: relative;"><input type="checkbox" id="cheque" name="cheque" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Cheque
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-1 col-sm-1  form-group has-feedback">
                                                        <div class="radio">
                                                            <strong>IVA</strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-1  form-group has-feedback">
                                                        <div class="radio">
                                                            <label class="">
                                                                <div class="iradio_flat-green" style="position: relative;"><input type="radio" class="flat" id="iva" name="iva" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Si
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-1  form-group has-feedback">
                                                        <div class="radio">
                                                            <label class="">
                                                                <div class="iradio_flat-green" style="position: relative;"><input type="radio" class="flat" id="iva" name="iva" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>

                                        <div class="form-group row">
                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <select class="select2_single form-control" id="banco" name="banco" tabindex="-1">
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="total" name="total" placeholder="Total" autocomplete="off">
                                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="abono" name="abono" placeholder="Abono" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="saldo" name="saldo" placeholder="Saldo" autocomplete="off">
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
                                                    <td>2023-10-18 00:00:00</td>
                                                    <td>$500.000</td>
                                                    <td>Nequi</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="ln_solid"></div>

                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="vendedor" name="vendedor" placeholder="Vendedor" autocomplete="off">
                                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="autorizo" name="autorizo" placeholder="Autorizo" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="verifico" name="verifico" placeholder="Verifico" autocomplete="off">
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
                                        <h2>Informacion del pedido</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="form-group row">
                                            <div class="col-md-5 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="docCliente" name="docCliente" placeholder="Documento del cliente" autocomplete="off">
                                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-5 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="Nombre del producto" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-5 col-sm-6  form-group has-feedback">
                                                <select disabled class="select2_single form-control" id="cliente" name="cliente" tabindex="-1">
                                                </select>
                                            </div>
                                            <div class="col-md-5 col-sm-6  form-group has-feedback">
                                                <select disabled class="select2_single form-control" id="producto" name="producto" tabindex="-1">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-5 col-sm-6  form-group has-feedback">
                                                <span class="form-control has-feedback-left" id="valor-producto">Valor del producto:</span>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group row">
                                            <div class="col-md-8 col-sm-8  offset-md-0">
                                                <button type="submit" class="btn btn-success btn-round" id="btn-registrar-pedido"><i class="fa fa-arrow-down"></i> Registrar pedido</button>
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
                                            <label for="fecha-limite">Fecha limite de entrega: </label>
                                            <input type="date" class="form-control has-feedback-left" id="fecha-limite" name="fecha-limite" autocomplete="off">
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
    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/pedido/index.js" type="module"></script>
</body>