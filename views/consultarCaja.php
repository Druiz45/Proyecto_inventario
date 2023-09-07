<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php require_once("./../views/includes/barraLateral.php"); ?>
            <!-- top navigation -->
            <?php

            use App\Http\Models\cajaModel;

            $i = 1;
            $caja = new cajaModel(null, null);

            // $rowsPedidos = $caja->getCajaPedidos();
            $rowsIngresos = $caja->getCajaIngresos();

            // $totalAbonos = $rowsPedidos[count($rowsPedidos) - 1]['total_abono'];
            $totalIngresos = $rowsIngresos[count($rowsIngresos) - 1]['valor'];
            // print_r($rowsPedidos);
            ?>
            <?php require_once("./../views/includes/barraSuperior.php"); ?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Informacion de cartera<small>Cartera</small></h2>
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
                                <div class="col-sm-6">
                                    <div class="card-box table-responsive">
                                        <!-- TableManageButtons -->
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Codigo pedido</th>
                                                    <th>Total Abonado</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php foreach ($rowsPedidos as $row) : ?>
                                                    <?php #$valorAdeudado+=$row["valor_restante"] 
                                                    ?>
                                                    <?php if ( is_numeric($row['id_pedido']) ) : ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><?= base64_encode($row["id_pedido"]) . bin2hex($row["id_pedido"]) ?></td>
                                                            <td><?= numberFormat($row["total_abono"]) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php 
                                                    endforeach;
                                                    $i=1; 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tile_count">
                                        <div class="col-md-12 col-sm-12  tile_stats_count">
                                            <h3>Se registra un valor en caja (pedidos):</h3>
                                            <h3 class="green"><?= numberFormat($totalAbonos) ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-box table-responsive">
                                        <table id="datatable2-responsive2" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Codigo ingreso</th>
                                                    <th>Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php foreach ($rowsIngresos as $row) : ?>
                                                    <?php #$valorAdeudado+=$row["valor_restante"] 
                                                    ?>
                                                    <?php if ( is_numeric($row['id']) ) : ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><?= base64_encode($row["id"]) . bin2hex($row["id"]) ?></td>
                                                            <td><?= numberFormat($row["valor"]) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tile_count">
                                        <div class="col-md-12 col-sm-12  tile_stats_count">
                                            <h3>Se registra en caja un valor de (Ingresos):</h3>
                                            <h3 class="green"><?= numberFormat($totalIngresos) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center justify-content-center">
                                <h3>Se registra en caja un valor total de: </h3>
                                <h3 class="green"><?= numberFormat($totalAbonos+$totalIngresos) ?></h3>
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
    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/pedido/operaciones.js"></script>
</body>