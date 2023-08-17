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
            ?>
            <?php require_once("./../views/includes/barraSuperior.php"); ?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Informacion orden de compra<small>Ordenes de compra</small></h2>
                            <!-- <ul class="nav navbar-right panel_toolbox">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                    </ul> -->
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <!-- <p class="text-muted font-13 m-b-30">
                      Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                    </p> -->

                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <?php if ($_SESSION["idPerfil"] != 2) : ?>
                                                        <th>Proveedor</th>
                                                    <?php endif; ?>
                                                    <th>Vendedor</th>
                                                    <th>Producto</th>
                                                    <th>Valor producto</th>
                                                    <th>Valor compra</th>
                                                    <th>Abono</th>
                                                    <th>Anotacion</th>
                                                    <th>Fecha limite</th>
                                                    <th>Estado orden</th>
                                                    <?php if ($_SESSION["idPerfil"] != 2) : ?>
                                                        <th>Fecha del pedido</th>
                                                        <th>Operaciones</th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php foreach ($rows as $row) : ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <?php if ($_SESSION["idPerfil"] != 2) : ?>
                                                            <td><?= $row["proveedor"] ?></td>
                                                        <?php endif; ?>
                                                        <td><?= $row["vendedor"] ?></td>
                                                        <td><?= $row["producto"] ?></td>
                                                        <td><?= "$" . number_format($row["precio"], 0, '.', '.') ?></td>
                                                        <td><?= "$" . number_format($row["valor"], 0, '.', '.') ?></td>
                                                        <td><?= "$" . number_format($row["abono"], 0, '.', '.') ?></td>
                                                        <td><?= $row["anotacion"] ?></td>
                                                        <td><?= getFechaSinHora($row["fecha_limite"]) ?></td>
                                                        <td><?= $row["estado_orden"] == 1 ? "Pendiente" : ($row["estado_orden"] == 2 ? "Recibido" : ($row["estado_orden"] == 3 ? "Pagado" : "Anulado")) ?></td>
                                                        <?php if ($_SESSION["idPerfil"] != 2) : ?>
                                                            <td><?= getFecha($row["fecha_sys"]) ?></td>
                                                            <td>
                                                                <?php if ($row['estado_orden']==3) : ?>
                                                                    <button type="button" onclick="return updateEstate(<?= $row['id'] ?>, 'Recibir', 'Recibido' )" class="btn btn-success">Recibir</button>
                                                                <?php endif; ?>
                                                                
                                                                <button type="button" onclick="return abonos(<?= $row['id'] ?>)" class="btn btn-dark">Abonos</button>

                                                                <?php if ($row['estado_orden']==1) : ?>
                                                                    <button type="button" onclick="return updateEstate(<?= $row['id'] ?>, 'Anular', 'Anulado' )" class="btn btn-warning">Anular</button>
                                                                    <a href="./edit/?compra=<?= $row["id"] ?>"><button type="button" class="btn btn-info">Editar</button></a>
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