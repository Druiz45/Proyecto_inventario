<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <?php require_once("./../views/includes/barraLateral.php"); ?>
      <!-- top navigation -->
      <?php
        use App\Http\Models\ProductoModel;
        $i = 1;
        $producto = new ProductoModel();
        $rows = $producto->getProductos();
      ?>
      <?php require_once("./../views/includes/barraSuperior.php"); ?>
      <!-- /top navigation -->
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Informacion de productos<small>Productos</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
                </li>
              </ul>
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
                          <th>Codigo</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Categoria</th>
                          <th>Descripcion</th>
                          <th>Inventario</th>
                          <th>Fecha</th>
                          <th>Operaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($rows as $row) : ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row["id"]  ?></td>
                            <td><?= $row["producto"] ?></td>
                            <td><?= "$".number_format($row["precio"] , 0, '.', '.') ?></td>
                            <td><?= $row["categoria"] ?></td>
                            <td><?= $row["descripcion"] ?></td>
                            <td><?= $row["estado_inventario"]==0 ? "Sin añadir" : "Añadido" ?></td>
                            <td><?= getFecha($row["fecha"]) ?></td>
                            <td>
                              <?php if ($row["estado"]==1): ?>
                                <button type="button" class="btn btn-danger" onclick="return eliminar(<?= $row['id'] ?>, 'deshabilitar', 'deshabilito')"><i class="fa fa-close"></i> Deshabilitar</button>
                              <?php else: ?>
                                <button type="button" class="btn btn-success" onclick="return eliminar(<?= $row['id'] ?>, 'habilitar', 'habilito')"><i class="fa fa-check"></i> Habilitar</button>
                              <?php endif; ?>
                              <a href="./editar/?producto=<?= $row['id'] ?>"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</button></a>
                              <?php if ($row["estado_inventario"]==0): ?>
                                <button type="button" class="btn btn-dark" onclick="return agregarInventario(<?= $row['id'] ?>, '<?= htmlspecialchars($row['producto']) ?>')"><i class="fa fa-plus"></i> Añadir a inventario</button>
                              <?php endif; ?>
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
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/producto/operaciones.js"></script>

</body>