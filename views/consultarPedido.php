<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <?php require_once("./../views/includes/barraLateral.php"); ?>
      <!-- top navigation -->
      <?php

      use App\Http\Models\PedidoModel;

      $i = 1;
      $pedido = new PedidoModel();
      date_default_timezone_set('America/Bogota');

      $rows = $pedido->getPedidos(
        isset($_GET["startDate"]) ? $_GET["startDate"] : date('Y-m-d'),
        isset($_GET["finalDate"]) ? $_GET["finalDate"] : date('Y-m-d')
      );
      // $reumen = $pedido->getResumenPedidos();
      ?>
      <?php require_once("./../views/includes/barraSuperior.php"); ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <div class="title_left">
                <h3 class="dark"><strong>Consultar pedidos</strong></h3>
              </div>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <form action="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/pedido/consultar/?" method="get">
              <div class="row justify-content-center">
                <div class="form-group row col-md-4 col-sm-6">
                  <label>Fecha inicio:</label>
                  <input class="form-control" type="date" name="startDate" value="<?= isset($_GET["startDate"]) ? $_GET["startDate"] : "" ?>" required>
                </div>
                <div class="form-group row col-md-4 col-sm-6">
                  <label>Fecha final:</label>
                  <input class="form-control" type="date" name="finalDate" value="<?= isset($_GET["finalDate"]) ? $_GET["finalDate"] : "" ?>" required>
                </div>
                <div class="actionBar">
                  <a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/pedido/consultar" class="buttonNext btn btn-secondary btn-round"><i class="fa fa-minus"></i> Limpiar</a>
                  <button class="buttonNext btn btn-success btn-round"><i class="fa fa-filter"></i> Filtrar</button>
                </div>
              </div>
            </form>
            <div class="x_content">
              <div class="row">
                <div class="col-md-12 col-sm-12 ">
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
                                  <th>Codigo de orden</th>
                                  <th>fecha</th>
                                  <!-- <th>Vendedor</th> -->
                                  <!-- <th>Fecha limite</th> -->
                                  <th>Comision</th>
                                  <th>Estado del pedido</th>
                                  <th>Estado de aprobacion</th>
                                  <!-- <th>Anotacion</th>
                                  <th>Valor comision</th>
                                  <th>Abono total</th>
                                  <th>Valor restante</th>
                                  <th>Banco</th>
                                  <th>Valor del producto</th> -->
                                  <!-- <th>Fecha del pedio</th> -->
                                  <th>Operaciones</th>
                                </tr>
                              </thead>
                              <tbody id="tbody">
                                <?php foreach ($rows as $row) : ?>
                                  <?php
                                  $infoEstadoComision = getEstadoComision($row["comision_pagada"]);
                                  $infoEstadoPedido = getEstadoPedido($row["estado_pedido"]);
                                  $infoEstadoAprobacionPedido = getEstadoAprobacionPedido($row["estado_aprobado"]);
                                  ?>
                                  <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row["id"] ?></td>
                                    <td><?= $row["id_orden"] ?></td>
                                    <!-- <td><?= $row["idProducto"] . " - " . $row["producto"] ?></td>
                                    <td><?= $row["cliente"] ?></td>
                                    <td><?= $row["vendedor"] ?></td>
                                    <td><?= getFechaSinHora($row["fechaLimite"]) ?></td> -->
                                    <td><?= getFecha($row["fecha"]) ?></td>
                                    <td bgcolor="<?= $infoEstadoComision['fondo'] ?>"> <?= $infoEstadoComision['estado'] ?> </td>
                                    <td bgcolor="<?= $infoEstadoPedido['fondo'] ?>"> <?= $infoEstadoPedido['estado'] ?> </td>
                                    <td bgcolor="<?= $infoEstadoAprobacionPedido['fondo'] ?>"> <?= $infoEstadoAprobacionPedido['estado'] ?> </td>
                                    <!-- <td><?= $row["anotacion"] ?></td>
                                    <td><?= numberFormat($row["valorComision"]) ?></td>
                                    <td><?= numberFormat($row["abonoTotal"]) ?></td>
                                    <td><?= numberFormat($row["valor_restante"]) ?></td>
                                    <td><?= $row["banco"] ?></td>
                                    <td><?= numberFormat($row["valorTotal"]) ?></td> -->
                                    <td>

                                      <a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/pedido/resumen/?pedido=<?= $row['id'] ?>"><button type="button" class="btn">Ver mas</button></a>

                                      <?php if ($row["estado_pedido"] == 1) : ?>

                                        <a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/pedido/editar/?pedido=<?= $row["id"] ?>"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</button></a>

                                        <?php if ($_SESSION["idPerfil"] == 3) : ?>
                                          <button type="button" class="btn btn-dark" id="estadoAprobacion" onclick="return aprobacion(<?= $row['id'] ?>, <?= $row['estado_aprobado'] ?>)"><i class="fa fa-check"></i> <i class="fa fa-close"></i> Aprobacion</button>
                                        <?php endif; ?>

                                        <button type="button" class="btn btn-primary" onclick="return estado(<?= $row['id'] ?>, <?= $row['estado_aprobado'] ?>, <?= ($row['total'] - $row['abono_total']) ?>)"><i class="fa fa-retweet"></i> Estado</button>

                                      <?php elseif ($row["comision_pagada"] == 0 && $row["estado_pedido"] == 2 && $_SESSION["idPerfil"] == 3) : ?>
                                        <button type="button" class="btn btn-warning" onclick="return pagarComision('<?= $row['id'] ?>', '<?= $row['vendedor'] ?>', <?= $row['id_usuario_vendedor'] ?>, <?= $row['valor_comision'] ?>)"><i class="fa fa-usd"></i> Comision</button>
                                      <?php endif; ?>

                                      <button type="button" class="btn btn-success" onclick="return abonos(<?= $row['id'] ?>, <?= $row['estado_pedido'] ?>, <?= $row['estado_aprobado'] ?>, <?= ($row['total'] - $row['abono_total']) ?>)"><i class="fa fa-money"></i> Abonos</button>

                                    </td>
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
            </div>
            <!-- <div class="row" style="display: inline-block;">
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
                  <div class="count green"> <?= numberFormat(($reumen[0]['total_pedidos'] - $reumen[0]['total_abonos'])) ?> </div>
                </div>
                <div class="col-md-3 col-sm-4  tile_stats_count">
                  <span class="count_top"><i class="fa fa-truck"></i> Entregados</span>
                  <div class="count red"><?= number_format($reumen[0]['pedidos_entregados'], 0, '.', '.') ?></div>
                </div>
                <div class="col-md-3 col-sm-4  tile_stats_count">
                  <span class="count_top"><i class="fa fa-spinner"></i> Pedientes</span>
                  <div class="count"><?= number_format($reumen[0]['pedidos_pendientes'], 0, '.', '.') ?></div>
                </div>
                <div class="col-md-3 col-sm-4  tile_stats_count">
                  <span class="count_top"><i class="fa fa-check"></i> Aprobados</span>
                  <div class="count"><?= number_format($reumen[0]['pedidos_aprobados'], 0, '.', '.') ?></div>
                </div>
                <div class="col-md-3 col-sm-4  tile_stats_count">
                  <span class="count_top"><i class="fa fa-close"></i> No aprobados</span>
                  <div class="count"><?= number_format($reumen[0]['pedidos_no_aprobados'], 0, '.', '.') ?></div>
                </div>
              </div>
            </div> -->
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