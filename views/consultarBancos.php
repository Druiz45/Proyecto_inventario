<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php require_once("./../views/includes/barraLateral.php"); ?>
            <!-- top navigation -->
            <?php

            use App\Http\Models\BancoModel;

            $i = 1;
            $banco = new BancoModel();
            $rows = $banco->getBancos();
            ?>
            <?php require_once("./../views/includes/barraSuperior.php"); ?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Informacion de bancos<small>Bancos</small></h2>
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
                                                    <th>Banco</th>
                                                    <th>Fecha registro</th>
                                                    <th>Operaciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php foreach ($rows as $row) : ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $row["banco"] ?></td>
                                                        <td><?= getFecha($row["fecha_sys"]) ?></td>
                                                        <td>
                                                            <?php if($row["estado"]==1): ?>
                                                                <button type="button" class="btn btn-danger btn-round" onclick="return updateEstate('Deshabilitar',<?= $row['id'] ?>)"><i class="fa fa-close"></i> Deshabilitar</button>
                                                            <?php else: ?>
                                                                <button type="button" class="btn btn-success btn-round" onclick="return updateEstate('Habilitar',<?= $row['id'] ?>)"><i class="fa fa-close"></i> Habilitar</button>
                                                            <?php endif; ?>
                                                            <button type="button" class="btn btn-info" onclick="return updateBanco('<?= $row['banco'] ?>',<?= $row['id'] ?>)"><i class="fa fa-pencil"></i> Editar</button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <div class="col-md-3 col-sm-6  form-group has-feedback">
                                        <button type="button" class="btn btn-success" id="addBanco"><i class="fa fa-plus"></i> Añadir banco</button>
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
    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/banco/index.js" type="module"></script>
    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/banco/operaciones.js"></script>
</body>