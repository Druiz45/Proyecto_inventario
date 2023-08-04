<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <?php require_once("./../views/includes/barraLateral.php"); ?>
      <!-- top navigation -->
      <?php
        use App\Http\Models\PedidoModel;
        $i = 1;
        $pedido = new PedidoModel();
        $rows = $pedido->getPedidos()
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
                          <th>Valor del producto</th>
                          <th>Abono total</th>
                          <th>Anotacion</th>
                          <th>Estado de aprobacion</th>
                          <th>Estado del pedido</th>
                          <th>Comision paga</th>
                          <th>Valor de la comision</th>
                          <th>Fecha limite</th>
                          <th>Fecha del pedio</th>
                          <th>Operaciones</th>
                        </tr>
                      </thead>
                      <tbody id="tbody">
                        <?php foreach ($rows as $row) : ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row["producto"] ?></td>
                            <td><?= $row["cliente"] ?></td>
                            <td><?= $row["vendedor"] ?></td>
                            <td><?= $row["valorTotal"] ?></td>
                            <td><?= $row["abonoTotal"] ?></td>
                            <td><?= $row["anotacion"] ?></td>
                            <td><?= $row["estadoAprobacion"] ?></td>
                            <td><?= $row["estadoPedido"] ?></td>
                            <td><?= $row["comisionPaga"] ?></td>
                            <td><?= $row["valorComision"] ?></td>
                            <td><?= getFecha($row["fechaLimite"]) ?></td>
                            <td><?= getFecha($row["fecha"]) ?></td>
                            <td><button type="button" class="btn btn-danger">Eliminar</button><button type="button" class="btn btn-info">Editar</button></td>
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