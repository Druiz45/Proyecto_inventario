<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php require_once("./../views/includes/barraLateral.php"); ?>
            <!-- top navigation -->
            <?php

                use App\Http\Models\CompraModel;

                $i = 1;
                $compra = new CompraModel();
                $rows = $compra->getCompras();
                $resumen = $compra->getResumenOrdenesCompra();


            ?>
            <?php require_once("./../views/includes/barraSuperior.php"); ?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Informacion orden de compra<small>Ordenes de compra</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <form action="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/compra/consultar/?" method="get">
                            <div class="row justify-content-center">
                                <div class="form-group row col-md-4 col-sm-6">
                                    <label>Fecha incio:</label>
                                    <input class="form-control" type="date" name="startDate" value="<?= isset($_GET["startDate"]) ? $_GET["startDate"] : "" ?>" required>
                                </div>
                                <div class="form-group row col-md-4 col-sm-6">
                                    <label>Fecha Final:</label>
                                    <input class="form-control" type="date" name="finalDate" value="<?= isset($_GET["finalDate"]) ? $_GET["finalDate"] : "" ?>" required>
                                </div>
                                <div class="actionBar">
                                <a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/compra/consultar" class="buttonNext btn btn-secondary btn-round"><i class="fa fa-minus"></i> Limpiar</a>
                                    <button class="buttonNext btn btn-success btn-round"><i class="fa fa-filter"></i> Filtrar</button>
                                </div>
                            </div>
                        </form>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Codigo</th>
                                                    <?php if ($_SESSION["idPerfil"] != 2) : ?>
                                                        <th>Proveedor</th>
                                                        <th>Cliente</th>
                                                    <?php endif; ?>
                                                    <th>Vendedor</th>
                                                    <th>Producto</th>
                                                    <?php if ($_SESSION["idPerfil"] != 2) : ?>
                                                        <th>Se vendera por</th>
                                                    <?php endif; ?>
                                                    <th>Se compro por</th>
                                                    <th>Abono</th>
                                                    <th>Estado orden</th>
                                                    <th>Fecha limite</th>
                                                    <th>Anotacion</th>
                                                    <?php if ($_SESSION["idPerfil"] != 2) : ?>
                                                        <th>Fecha del pedido</th>
                                                        <th>Operaciones </th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php foreach ($rows as $row) : ?>
                                                    <?php
                                                    $infoEstadoOrdenDeCompra = getEstadoOrdenCompra($row["estado_orden"]);
                                                    ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $row["id"] ?></td>
                                                        <?php if ($_SESSION["idPerfil"] != 2) : ?>
                                                            <td><?= $row["proveedor"] ?></td>
                                                            <td><?= $row["cliente"] == 0 ? "No Aplica" : $row["cliente"] ?></td>
                                                        <?php endif; ?>
                                                        <td><?= $row["vendedor"] ?></td>
                                                        <td><?= $row["idProducto"]." - ".$row["producto"] ?></td>
                                                        <?php if ($_SESSION["idPerfil"] != 2) : ?>
                                                            <td><?= numberFormat($row["precio"]) ?></td>
                                                        <?php endif; ?>
                                                        <td><?= numberFormat($row["valor"]) ?></td>
                                                        <td><?= numberFormat($row["abono"]) ?></td>
                                                        <td bgcolor="<?= $infoEstadoOrdenDeCompra['fondo'] ?>"><?= $infoEstadoOrdenDeCompra['estado'] ?></td>
                                                        <td><?= getFechaSinHora($row["fecha_limite"]) ?></td>
                                                        <td><?= $row["anotacion"] ?></td>
                                                        <?php if ($_SESSION["idPerfil"] != 2) : ?>
                                                            <td><?= getFecha($row["fecha_sys"]) ?></td>
                                                            <td>
                                                                <?php if ($row['estado_orden'] == 3) : ?>
                                                                    <button type="button" onclick="return updateEstate(<?= $row['id'] ?>, 'Recibir', 'Recibido' )" class="btn btn-dark"><i class="fa fa-arrow-down"></i> Recibir</button>
                                                                <?php endif; ?>

                                                                <button type="button" onclick="return abonos(<?= $row['id'] ?>, <?= ($row['valor'] - $row['abono']) ?>, <?= $row['estado_orden'] ?>)" class="btn btn-success"><i class="fa fa-money"></i> Abonos</button>

                                                                <?php if ($row['estado_orden'] == 1) : ?>
                                                                    <button type="button" onclick="return updateEstate(<?= $row['id'] ?>, 'Anular', 'Anulado' )" class="btn btn-warning"><i class="fa fa-minus"></i> Anular</button>
                                                                    <a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/compra/edit/?compra=<?= $row["id"] ?>"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</button></a>
                                                                <?php endif; ?>
                                                                <?php if ($row['estado_inventario'] != 1) : ?>
                                                                    <strong style="background-color: red; color:white"> Este poducto no esta disponible en inventario </strong>
                                                                <?php elseif ($row['estado_orden'] == 2 && $row['agregado_stock'] == 0) : ?>
                                                                    <button type="button" class="btn btn-success" onclick="return agregarAlStock('<?= $row['id_producto'] ?>', '<?= $row['id'] ?>')">Añadir al stock</button>
                                                                <?php endif; ?>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display: inline-block;">
                            <div class="tile_count">
                                <div class="col-md-3 col-sm-4  tile_stats_count">
                                    <span class="count_top"><i class="fa fa-money"></i> Valor total</span>
                                    <div class="count"><?= numberFormat($resumen[0]['total_ordenes_compra']) ?></div>
                                </div>
                                <div class="col-md-3 col-sm-4  tile_stats_count">
                                    <span class="count_top"><i class="fa fa-money"></i> Abono total</span>
                                    <div class="count"><?= numberFormat($resumen[0]['total_abonos_ordenes_compra']) ?></div>
                                </div>
                                <div class="col-md-3 col-sm-4  tile_stats_count">
                                    <span class="count_top"><i class="fa fa-money"></i> Por pagar</span>
                                    <div class="count green"> <?= numberFormat( ($resumen[0]['total_ordenes_compra']-$resumen[0]['total_abonos_ordenes_compra']) ) ?> </div>
                                </div>
                                <div class="col-md-3 col-sm-4  tile_stats_count">
                                    <span class="count_top"><i class="fa fa-truck"></i> Recibidos </span>
                                    <div class="count red"><?= numberFormat($resumen[0]['total_recibidos'])  ?></div>
                                </div>
                                <div class="col-md-3 col-sm-4  tile_stats_count">
                                    <span class="count_top"><i class="fa fa-spinner"></i> Pedientes</span>
                                    <div class="count"><?= numberFormat($resumen[0]['total_pendientes']) ?></div>
                                </div>
                                <div class="col-md-3 col-sm-4  tile_stats_count">
                                    <span class="count_top"><i class="fa fa-check"></i> Pagadas</span>
                                    <div class="count"><?= numberFormat($resumen[0]['total_pagadas']) ?></div>
                                </div>
                                <!-- <div class="col-md-3 col-sm-4  tile_stats_count">
                                    <span class="count_top"><i class="fa fa-close"></i> No pagadas</span>
                                    <div class="count"><?php // numberFormat($resumen[0]['total_pagadas']) ?></div>
                                </div> -->
                                <div class="col-md-3 col-sm-4  tile_stats_count">
                                    <span class="count_top"><i class="fa fa-minus"></i> Anuladas</span>
                                    <div class="count"><?= numberFormat($resumen[0]['total_anuladas']) ?></div>
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
    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/compra/operaciones.js"></script>
</body>