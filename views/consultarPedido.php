<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <?php require_once("./../views/includes/barraLateral.php"); ?>
      <!-- top navigation -->
      <?php

        use App\Http\Models\PedidoModel;

        $i = 1;
        $pedido = new PedidoModel();
        $rows = $pedido->getPedidos();
        $reumen = $pedido->getResumenPedidos();
      ?>
      <?php require_once("./../views/includes/barraSuperior.php"); ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Informacion de pedidos<small>Pedidos</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <form action="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/pedido/consultar/?" method="get">
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
                  <button class="buttonNext btn btn-success"><i class="fa fa-filter"></i> Filtrar</button>
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
                          <th>Codigo pedido</th>
                          <th>Producto</th>
                          <th>Cliente</th>
                          <th>Vendedor</th>
                          <th>Fecha limite</th>
                          <th>Comision</th>
                          <th>Estado del pedido</th>
                          <th>Estado de aprobacion</th>
                          <th>Anotacion</th>
                          <th>Valor comision</th>
                          <th>Abono total</th>
                          <th>Valor restante</th>
                          <th>Valor del producto</th>
                          <th>Fecha del pedio</th>
                          <th>Operaciones</th>
                        </tr>
                      </thead>
                      <tbody id="tbody">
                        <?php foreach ($rows as $row) : ?>
                          <?php
                          $infoEstadoComision = getEstadoComision($row["comisionPaga"]);
                          $infoEstadoPedido = getEstadoPedido($row["estadoPedido"]);
                          $infoEstadoAprobacionPedido = getEstadoAprobacionPedido($row["estadoAprobacion"]);
                          ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= base64_encode($row["id"]) . bin2hex($row["id"]) ?></td>
                            <td><?= base64_encode($row["idProducto"]) . bin2hex($row["idProducto"])." - ".$row["producto"] ?></td>
                            <td><?= $row["cliente"] ?></td>
                            <td><?= $row["vendedor"] ?></td>
                            <td><?= getFechaSinHora($row["fechaLimite"]) ?></td>
                            <td bgcolor="<?= $infoEstadoComision['fondo'] ?>"> <?= $infoEstadoComision['estado'] ?> </td>
                            <td bgcolor="<?= $infoEstadoPedido['fondo'] ?>"> <?= $infoEstadoPedido['estado'] ?> </td>
                            <td bgcolor="<?= $infoEstadoAprobacionPedido['fondo'] ?>"> <?= $infoEstadoAprobacionPedido['estado'] ?> </td>
                            <td><?= $row["anotacion"] ?></td>
                            <td><?= numberFormat($row["valorComision"]) ?></td>
                            <td><?= numberFormat($row["abonoTotal"]) ?></td>
                            <td><?= numberFormat($row["valor_restante"]) ?></td>
                            <td><?= numberFormat($row["valorTotal"]) ?></td>
                            <td><?= getFecha($row["fecha"]) ?></td>
                            <td>

                              <?php if ($row["estadoPedido"] == 1) : ?>

                                <a href="./editar/?pedido=<?= $row["id"] ?>"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</button></a>

                                <?php if ($_SESSION["idPerfil"] == 3) : ?>
                                  <button type="button" class="btn btn-dark" id="estadoAprobacion" onclick="return aprobacion(<?= $row['id'] ?>, <?= $row['estadoAprobacion'] ?>)"><i class="fa fa-check"></i> <i class="fa fa-close"></i> Aprobacion</button>
                                <?php endif; ?>

                                <button type="button" class="btn btn-primary" onclick="return estado(<?= $row['id'] ?>, <?= $row['estadoAprobacion'] ?>, <?= ($row['valorTotal'] - $row['abonoTotal']) ?>)"><i class="fa fa-retweet"></i> Estado</button>

                              <?php elseif ($row["comisionPaga"] == 0 && $row["estadoPedido"] == 2 && $_SESSION["idPerfil"] == 3) : ?>
                                <button type="button" class="btn btn-warning" onclick="return pagarComision('<?= $row['id'] ?>', '<?= $row['vendedor'] ?>', <?= $row['idVendedor'] ?>, <?= $row['valorComision'] ?>)">Comision</button>
                              <?php endif; ?>

                              <button type="button" class="btn btn-success" onclick="return abonos(<?= $row['id'] ?>, <?= $row['estadoPedido'] ?>, <?= $row['estadoAprobacion'] ?>, <?= ($row['valorTotal'] - $row['abonoTotal']) ?>)"><i class="fa fa-money"></i> Abonos</button>

                            </td>
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
                  <div class="count"><?= numberFormat($reumen[0]['total_pedidos']) ?></div>
                </div>
                <div class="col-md-3 col-sm-4  tile_stats_count">
                  <span class="count_top"><i class="fa fa-money"></i> Abono total</span>
                  <div class="count"><?= numberFormat($reumen[0]['total_abonos']) ?></div>
                </div>
                <div class="col-md-3 col-sm-4  tile_stats_count">
                  <span class="count_top"><i class="fa fa-money"></i> En cartera</span>
                  <div class="count green"> <?= numberFormat(($reumen[0]['total_pedidos'] - $reumen[0]['total_abonos'] )) ?> </div>
                </div>
                <div class="col-md-3 col-sm-4  tile_stats_count">
                  <span class="count_top"><i class="fa fa-truck"></i> Entregados</span>
                  <div class="count red"><?= numberFormat($reumen[0]['pedidos_entregados']) ?></div>
                </div>
                <div class="col-md-3 col-sm-4  tile_stats_count">
                  <span class="count_top"><i class="fa fa-spinner"></i> Pedientes</span>
                  <div class="count"><?= numberFormat($reumen[0]['pedidos_pendientes']) ?></div>
                </div>
                <div class="col-md-3 col-sm-4  tile_stats_count">
                  <span class="count_top"><i class="fa fa-check"></i> Aprobados</span>
                  <div class="count"><?= numberFormat($reumen[0]['pedidos_aprobados']) ?></div>
                </div>
                <div class="col-md-3 col-sm-4  tile_stats_count">
                  <span class="count_top"><i class="fa fa-close"></i> No aprobados</span>
                  <div class="count"><?= numberFormat($reumen[0]['pedidos_no_aprobados']) ?></div>
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