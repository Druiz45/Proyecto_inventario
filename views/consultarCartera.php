<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php require_once("./../views/includes/barraLateral.php"); ?>
            <!-- top navigation -->
            <?php

            use App\Http\Models\carteraModel;

            $i = 1;
            $cartera = new carteraModel();
            $rows = $cartera->getCartera();
            // $valorAdeudado=0;
            $valorAdeudado = $rows[count($rows) - 1]['valor_restante'];
            // print_r($rows);
            ?>
            <?php require_once("./../views/includes/barraSuperior.php"); ?>

            <div class="right_col" role="main">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Informacion de cartera<small>Cartera</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Codigo pedido</th>
                                                    <th>Valor restante</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php foreach ($rows as $row) : ?>
                                                    <?php #$valorAdeudado+=$row["valor_restante"] 
                                                    ?>
                                                    <?php if ($row['id'] != null) : ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><?= $row["id"] ?></td>
                                                            <td><?= numberFormat($row["valor_restante"]) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display: flexz inline-block;">
                            <div class="tile_count">
                                <div class="col-md-12 col-sm-12  tile_stats_count">
                                    <h3>Se registra un valor adeudado de:</h3>
                                    <h3 class="red"><?= numberFormat($valorAdeudado) ?></h3>
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
    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/pedido/operaciones.js"></script>
</body>