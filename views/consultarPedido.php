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
      ?>
      <?php require_once("./../views/includes/barraSuperior.php"); ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Informacion de pedidos<small>Pedidos</small></h2>
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
                          <th>Producto</th>
                          <th>Cliente</th>
                          <th>Vendedor</th>
                          <th>Fecha limite</th>
                          <th>Comision</th>
                          <th>Estado del pedido</th>
                          <th>Estado de aprobacion</th>
                          <th>Anotacion</th>
                          <th>Abono total</th>
                          <th>Valor comision</th>
                          <th>Valor del producto</th>
                          <th>Fecha del pedio</th>
                          <th>Operaciones</th>
                        </tr>
                      </thead>
                      <tbody id="tbody">
                        <?php foreach ($rows as $row): ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row["producto"] ?></td>
                            <td><?= $row["cliente"] ?></td>
                            <td><?= $row["vendedor"] ?></td>
                            <td><?= getFechaSinHora($row["fechaLimite"]) ?></td>
                            <td><?= $row["comisionPaga"] == 0 ? "En espera" : "Paga" ?></td>
                            <td><?= $row["estadoPedido"] == 1 ? "En espera" : ($row["estadoPedido"] == 2 ? "Entregado" : "Anulado")  ?></td>
                            <td><?= $row["estadoAprobacion"] == 1 ? "En espera" : ($row["estadoPedido"] == 2 ? "Aprobado" : "No aprobado") ?></td>
                            <td><?= $row["anotacion"] ?></td>
                            <td><?= "$".number_format($row["abonoTotal"] , 0, '.', '.') ?></td>
                            <td><?= "$".number_format($row["valorComision"] , 0, '.', '.') ?></td>
                            <td><?= "$".number_format($row["valorTotal"] , 0, '.', '.') ?></td>
                            <td><?= getFecha($row["fecha"]) ?></td>
                            <td> <button type="button" class="btn btn-danger">Eliminar</button> <a href="./editar/?pedido=<?= $row["id"]?>"><button type="button" class="btn btn-info">Editar</button></a> </td>
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
</body>