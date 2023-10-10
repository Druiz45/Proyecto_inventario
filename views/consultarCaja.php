<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php require_once("./../views/includes/barraLateral.php"); ?>
            <!-- top navigation -->
            <?php

            use App\Http\Models\cajaModel;
            use App\Http\Models\carteraModel;
            use App\Http\Models\CompraModel;

            $i = 1;
            $caja = new cajaModel(null, null);
            $cartera = new carteraModel();
            $ordenesCompra = new CompraModel();

            $resumenOrdenesCompra = $ordenesCompra->getResumenOrdenesCompra();

            $rowsCartera = $cartera->getCartera();

            $totalCartera = $rowsCartera[count($rowsCartera) - 1]['valor_restante'];

            // print_r($totalCartera);

            $rowsPedidos = $caja->getCajaPedidos();
            $rowsIngresos = $caja->getCajaIngresos();
            $rowsGastos = $caja->getCajaGastos();
            $rowsOrdenesCompra = $caja->getOrdenesCompra();
            $rowsComisiones = $caja->getComisiones();


            $resumenGastos = $caja->getResumenGastos();

            $totalAbonos = $rowsPedidos[count($rowsPedidos) - 1]['total_abono'];
            $totalIngresos = $rowsIngresos[count($rowsIngresos) - 1]['valor'];
            ?>
            <?php require_once("./../views/includes/barraSuperior.php"); ?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Informacion de cartera<small>Cartera</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <form action="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/caja/consultar/?" method="get">
                            <div class="row justify-content-center">
                                <div class="form-group row col-md-4 col-sm-6">
                                    <label>Fecha incio:</label>
                                    <input class="form-control" type="date" name="startDate" value="<?= isset($_GET["startDate"]) ? $_GET["startDate"] : "" ?>" require>
                                </div>
                                <div class="form-group row col-md-4 col-sm-6">
                                    <label>Fecha Final:</label>
                                    <input class="form-control" type="date" name="finalDate" value="<?= isset($_GET["finalDate"]) ? $_GET["finalDate"] : "" ?>" require>
                                </div>
                                <div class="actionBar">
                                    <a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/caja/consultar/" class="buttonNext btn btn-secondary btn-round"><i class="fa fa-minus"></i> Limpiar</a>
                                    <button class="buttonNext btn btn-success btn-round"><i class="fa fa-filter"></i> Filtrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up" id="block"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">

                                <div class="col-md-6 col-sm-6 ">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box table-responsive">
                                                        <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
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
                                                                    <?php if (is_numeric($row['id_pedido'])) : ?>
                                                                        <tr>
                                                                            <td><?= $i++ ?></td>
                                                                            <td><?= $row["id_pedido"]  ?></td>
                                                                            <td><?= numberFormat($row["total_abono"]) ?></td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                <?php
                                                                endforeach;
                                                                $i = 1;
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="tile_count">
                                                        <div class="col-md-12 col-sm-12  tile_stats_count">
                                                            <h3>Total pedidos: <i class="green"><?= numberFormat($ingresosPedidos = $totalAbonos) ?></i></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                    <?php if (is_numeric($row['id'])) : ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><?= $row["id"] ?></td>
                                                            <td><?= numberFormat($row["valor"]) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach;
                                                $i = 1;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tile_count">
                                        <div class="col-md-12 col-sm-12  tile_stats_count">
                                            <h3>Total ingresos: <i class="green"><?= numberFormat($totalIngresos) ?></i></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <h3>Se registra un ingreso general de: <i class="green"><?= numberFormat($ingresos = $totalAbonos + $totalIngresos) ?></i></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up" id="block"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row justify-content-center">
                                <div class="col-sm-6">
                                    <div class="card-box table-responsive">
                                        <!-- TableManageButtons -->
                                        <table id="datatable3-responsive3" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Codigo gasto</th>
                                                    <th>Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php foreach ($rowsGastos as $row) : ?>
                                                    <?php if (is_numeric($row['id'])) : ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><?= $row["id"]  ?></td>
                                                            <td><?= numberFormat($row["valor"]) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php
                                                endforeach;
                                                $i = 1;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tile_count">
                                        <div class="col-md-12 col-sm-12  tile_stats_count">
                                            <h3>Total gastos: <i class="red"><?= numberFormat($resumenGastos[0]['total_gastos']) ?></i></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-box table-responsive">
                                        <table id="datatable4-responsive4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Codigo orden</th>
                                                    <th>Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php foreach ($rowsOrdenesCompra as $row) : ?>
                                                    <?php if (is_numeric($row['id'])) : ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><?= $row["id"] ?></td>
                                                            <td><?= numberFormat($row["abono"]) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach;
                                                $i = 1;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tile_count">
                                        <div class="col-md-12 col-sm-12  tile_stats_count">
                                            <h3>Total ordenes de compra: <i class="red"><?= numberFormat($resumenGastos[0]['total_abono_ordenes_compra']) ?></i></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-box table-responsive">
                                        <!-- TableManageButtons -->
                                        <table id="datatable5-responsive5" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Codigo comision</th>
                                                    <th>Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php foreach ($rowsComisiones as $row) : ?>
                                                    <?php if (is_numeric($row['id_pedido'])) : ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><?= $row["id_pedido"]  ?></td>
                                                            <td><?= numberFormat($row["valor"]) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php
                                                endforeach;
                                                $i = 1;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tile_count">
                                        <div class="col-md-12 col-sm-12  tile_stats_count">
                                            <h3>Total comisiones: <i class="red"><?= numberFormat($resumenGastos[0]['total_comisiones_pagadas']) ?></i></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <h3>Se registra un gasto general de: <i class="red"><?= numberFormat(
                                                                                    $gastos = ($resumenGastos[0]['total_gastos'] + $resumenGastos[0]['total_abono_ordenes_compra'] + $resumenGastos[0]['total_comisiones_pagadas'])
                                                                                ) ?>
                                </i></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up" id="block"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="justify-content-center">
                                <div class="tile_count">
                                    <div class="col-md-4 col-sm-4  tile_stats_count">
                                        <span class="count_top"><i class="fa fa-money"></i> Total ganancias</span>
                                        <div class="count"><?= numberFormat($ingresos - $gastos) ?></div>
                                    </div>
                                    <div class="col-md-4 col-sm-4  tile_stats_count">
                                        <span class="count_top"><i class="fa fa-money"></i> Total cartera</span>
                                        <div class="count"><?= numberFormat($totalCartera) ?></div>
                                    </div>
                                    <div class="col-md-4 col-sm-4  tile_stats_count">
                                        <span class="count_top"><i class="fa fa-money"></i> Total ordenes de compra</span>
                                        <div class="count"><?= numberFormat($resumenOrdenesCompra[0]['total_ordenes_compra']) ?></div>
                                    </div>
                                    <div class="col-md-4 col-sm-4  tile_stats_count">
                                        <span class="count_top"><i class="fa fa-money"></i> Ganancias pedidos</span>
                                        <div class="count green"> <?= numberFormat(($ingresosPedidos - $resumenGastos[0]['total_abono_ordenes_compra'])) ?> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <h3>Se registra un ganancia total de: <i class="green"><?= numberFormat($totalAbonos + $totalIngresos) ?></i></h3>
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