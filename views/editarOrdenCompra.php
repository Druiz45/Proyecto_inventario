<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php require_once("./../views/includes/barraLateral.php"); ?>
            <!-- top navigation -->

            <?php

            use App\Http\Models\AbonoCompraModel;
            use App\Http\Models\CompraModel;

            $i = 1;
            $abonosCompra = new AbonoCompraModel();
            $compra = new CompraModel();
            $abonos = $abonosCompra->getAbonos($_GET['compra']);
            $ordenCompra = $compra->getCompra($_GET['compra']);
            $totalAbonos = 0;

            // print_r($ordenCompra);

            // $compra = new CompraModel();
            // $rows = $compra->getCompras();
            // $resumen = $compra->getResumenOrdenesCompra();
            ?>

            <?php require_once("./../views/includes/barraSuperior.php"); ?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3 class="dark"><strong>Editar orden de compra</strong></h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <form class="form-label-left input_mask" id="formUpdateCompra">
                        <div class="row align-items-center justify-content-center">

                            <div class="col-md-10">

                                <div class="x_panel">
                                    <div class="x_title">
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-green" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2 class="dark"><strong>Informacion orden de compra</strong></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <img src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/images/logo.png" width="250" height="150">
                                            </div>

                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="pedido">Pedido: </label>
                                                <input type="text" class="form-control has-feedback-left" id="pedido" name="pedido" placeholder="Pedido" autocomplete="off" value="<?= $ordenCompra[0]['pedido'] ?>">
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="orden de produccion">Orden de produccion: </label>
                                                <input type="text" class="form-control has-feedback-left" id="orden-produccion" name="orden-produccion" placeholder="Orden produccion" autocomplete="off" value="<?= $ordenCompra[0]['id'] ?>" readonly>
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>

                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="fecha">Fecha: </label>
                                                <input type="date" class="form-control has-feedback-left" id="fecha" name="fecha" value="<?= $ordenCompra[0]['fecha'] ?>">
                                            </div>

                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="fecha-entrega">Fecha entrega: </label>
                                                <input type="date" class="form-control has-feedback-left" id="fecha-entrega" name="fecha-entrega" value="<?= $ordenCompra[0]['fecha_entrega'] ?>">
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="acta-entrega">Acta de entrega: </label>
                                                <input type="text" class="form-control has-feedback-left" id="acta-entrega" name="acta-entrega" placeholder="Acta de entrega" autocomplete="off" value="<?= $ordenCompra[0]['acta_entrega'] ?>">
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                        </div>

                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="fabricante">Fabricante: </label>
                                                <input type="text" class="form-control has-feedback-left" id="fabricante" name="fabricante" placeholder="Fabricante" autocomplete="off" value="<?= $ordenCompra[0]['fabricante'] ?>" list="proveedores">
                                                <datalist id="proveedores">
                                                    <!-- <option value="Prueba"></option> -->
                                                </datalist>
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="remision">Remision: </label>
                                                <input type="text" class="form-control has-feedback-left" id="remision" name="remision" placeholder="Remision" autocomplete="off" value="<?= $ordenCompra[0]['remision'] ?>">
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="direccion">Direccion: </label>
                                                <input type="text" class="form-control has-feedback-left" id="direccion" name="direccion" placeholder="Direccion" autocomplete="off" value="<?= $ordenCompra[0]['direccion'] ?>" readonly>
                                                <!-- <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="telefono">Telefono: </label>
                                                <input type="text" class="form-control has-feedback-left" id="telefono" name="telefono" placeholder="Telefono" autocomplete="off" value="<?= $ordenCompra[0]['telefono'] ?>" readonly>
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="ciudad">Ciudad: </label>
                                                <input type="text" class="form-control has-feedback-left" id="ciudad" name="ciudad" placeholder="Ciudad" autocomplete="off" value="<?= $ordenCompra[0]['ciudad'] ?>">
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="celular">Celular: </label>
                                                <input type="text" class="form-control has-feedback-left" id="celular" name="celular" placeholder="Celular" autocomplete="off" value="<?= $ordenCompra[0]['celular'] ?>" readonly>
                                                <!-- <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="email">Email: </label>
                                                <input type="text" class="form-control has-feedback-left" id="email" name="email" placeholder="Email" autocomplete="off" value="<?= $ordenCompra[0]['email'] ?>" readonly>
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                <label for="vendedor-codigo">Codigo del vendedor: </label>
                                                <input type="text" class="form-control has-feedback-left" id="vendedor-codigo" name="vendedor-codigo" placeholder="Vendedor codigo" autocomplete="off" value="<?= $ordenCompra[0]['vendedor_codigo'] ?>" readonly>
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>

                                        <div class="form-group row">
                                            <div class="col-md-12 col-sm-12">
                                                <label for="anotacion">Descripcion: </label>
                                                <textarea class="resizable_textarea form-control" id="anotacion" name="anotacion" placeholder="Anotacion: (opcional)">
                                                    <?= $ordenCompra[0]['descripcion'] ?>
                                                </textarea>
                                            </div>
                                        </div>

                                        <!-- <div class="ln_solid"></div> -->

                                        <!-- <div class="form-group row">
                                            <div class="col-md-4 col-sm-4">
                                                <input type="text" class="form-control has-feedback-left" id="total" name="total" placeholder="Total" autocomplete="off">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div> -->

                                        <div class="ln_solid"></div>

                                        <div class="form-group row">
                                            <!-- <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <select class="select2_single form-control" id="banco" name="banco" tabindex="-1">
                                                </select>
                                            </div> -->
                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <label for="total">Total: </label>
                                                <input type="text" class="form-control has-feedback-left" id="total" name="total" placeholder="Total" autocomplete="off" value="<?= number_format($ordenCompra[0]['total'], 0, '.', '.') ?>">
                                                <!-- <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <label for="abono">Abono: </label>
                                                <input type="text" class="form-control has-feedback-left" id="abono" name="abono" placeholder="Abono" autocomplete="off" value="<?= number_format($ordenCompra[0]['abono'], 0, '.', '.') ?>" readonly>
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <!-- <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="saldo" name="saldo" placeholder="Saldo" autocomplete="off" value="">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div> -->
                                        </div>

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha</th>
                                                    <th>Abono</th>
                                                    <th>Banco</th>
                                                    <!-- <th>Banco</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($abonos as $abono) : ?>
                                                    <?php $totalAbonos += $abono['abono'];  ?>
                                                    <tr>
                                                        <th scope="row"><?= $i++ ?></th>
                                                        <td><?= getFecha($abono['fecha_sys']) ?></td>
                                                        <td><?= number_format($abono['abono'], 0, '.', '.') ?></td>
                                                        <td><?= $abono['banco'] ?></td>
                                                        <!-- <td>Nequi</td> -->
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                        <div class="form-group row align-items-center justify-content-center">
                                            <div class="col-md-3 col-sm-3  form-group has-feedback">
                                                <label for="heard">Saldo: </label>
                                                <input type="text" class="form-control" id="saldo" name="saldo" value="<?= number_format(($ordenCompra[0]['total'] - $totalAbonos), 0, '.', '.') ?>" placeholder="Saldo" autocomplete="off" readonly>
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>

                                        <div class="form-group row">
                                            <div class="col-md-12 col-sm-12">
                                                <label for="observacion">Observacion: </label>
                                                <textarea class="resizable_textarea form-control" id="observacion" name="observacion" placeholder="Observacion:">
                                                    <?= $ordenCompra[0]['observacion'] ?>
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>

                                        <div class="form-group row">
                                            <div class="col-md-2 col-sm-2  form-group has-feedback">
                                                <label for="fabricante">Fabricante: </label>
                                                <input type="text" class="form-control has-feedback-left" id="Fabricante2" name="Fabricante2" placeholder="Fabricante" autocomplete="off" value="<?= $ordenCompra[0]['fabricante2'] ?>">
                                                <!-- <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <div class="col-md-2 col-sm-2  form-group has-feedback">
                                                <label for="vendedor">Vendedor: </label>
                                                <input type="text" class="form-control has-feedback-left" id="vendedor" name="vendedor" placeholder="Vendedor" autocomplete="off" value="<?= $ordenCompra[0]['vendedor'] ?>" readonly>
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <div class="col-md-2 col-sm-2  form-group has-feedback">
                                                <label for="recibe">Recibe: </label>
                                                <input type="text" class="form-control has-feedback-left" id="recibe" name="recibe" placeholder="Recibe" autocomplete="off" value="<?= $ordenCompra[0]['recibe'] ?>">
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <div class="col-md-2 col-sm-2  form-group has-feedback">
                                                <label for="despacho">Despacho: </label>
                                                <input type="text" class="form-control has-feedback-left" id="despacho" name="despacho" placeholder="Despacho" autocomplete="off" value="<?= $ordenCompra[0]['despacho'] ?>">
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <div class="col-md-2 col-sm-2  form-group has-feedback">
                                                <label for="autorizo">Autorizo: </label>
                                                <input type="text" class="form-control has-feedback-left" id="autorizo" name="autorizo" placeholder="Autorizo" autocomplete="off" value="<?= $ordenCompra[0]['autorizo'] ?>">
                                                <!-- <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> -->
                                            </div>
                                            <!-- <div class="col-md-2 col-sm-2  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="nombreProducto" name="nombreProducto" placeholder="---" autocomplete="off" value="<?= $ordenCompra[0]['fecha_entrega'] ?>">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div> -->
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row align-items-center justify-content-end">
                                    <div class="col-md-3 col-sm-3  form-group has-feedback">
                                        <button type="submit" class="btn btn-primary btn-round" id="btn-editar-orden-compra"><i class="fa fa-arrow-down"></i> Editar orden de compra</button>
                                    </div>
                                </div>

                            </div>
                            <!-- </form> -->

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
                    </form>
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
    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/compra/index.js" type="module"></script>
</body>